<?php
require __DIR__.'/api/vendor/autoload.php';
$settings = (require __DIR__.'/api/src/settings.php')["settings"];
require_once __DIR__."/cron_helpers.php";

$pdo = new PDO($settings["database"]["dsn"], $settings["database"]["user"], $settings["database"]["pass"]);
$stmtstate = $pdo->prepare("INSERT INTO `server_state` (`server`,`timestamp`,`state`,`name`) VALUES (?,NOW(),?,?);");
$stmtreply = $pdo->prepare("INSERT INTO `server_replies` (`server`,`timestamp`,`ping`,`msg`) VALUES (?,NOW(),?,?);");
$stmtsetonline = $pdo->prepare("UPDATE `server` SET `last_state` = 'online', `last_ping` = ?, last_name = ?, last_packet=? WHERE `id` = ?;");
$stmtsetoffline = $pdo->prepare("UPDATE `server` SET `last_state` = 'offline' WHERE `id` = ?;");
$deleteserver = $pdo->prepare("DELETE FROM `server` WHERE `id` = ?;");

foreach ($pdo->query("SELECT * FROM `server`;") as $row) {
    $res = check_host($row["hostname"]);
    if($res["state"] == "online") {
        if($row["last_state"] != $res["state"] || $row["last_name"] != $res["name"]) {
            $stmtsetonline->execute([$res["ping"], $res["name"], $res["msg"], $row["id"]]);
            $stmtstate->execute([$row["id"], $res["state"], $res["name"]]);
        } else if($row["last_ping"] != $res["ping"]) {
            $stmtsetonline->execute([$res["ping"], $res["name"], $res["msg"], $row["id"]]);
        }
        $stmtreply->execute([$row["id"], $res["ping"], $res["msg"]]);
    } else {
        if($row["last_state"] != $res["state"] && (time() - strtotime($row["updated"])) >= 90) {
            $stmtsetoffline->execute([$row["id"]]);
            $stmtstate->execute([$row["id"], $res["state"], ""]);
            if($row["persistent"] == 0) {
                $deleteserver->execute([$row["id"]]);
                if($row["fcm_id"] != null)
                    sendFCM("Server offline", "Your server has been detected offline and was removed from the listing.", $row["fcm_id"]);
            } else {
                if($row["fcm_id"] != null)
                    sendFCM("Server offline", "Your server has been detected offline.", $row["fcm_id"]);
            }
        }
    }
}