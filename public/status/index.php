<?php
require_once("packet.php");
$settings = [
    'user' => "<mysqluser>",
    'pass' => "<mysqlpass>",
    'dsn' => "mysql:host=localhost;dbname=<mysqldb>"
];
$pdo = new PDO($settings["dsn"], $settings["user"], $settings["pass"]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Warhawk&trade; Reborn</title>
    <meta name="description" content="We won't let our favorite game die. Warhawk for PS3 will live on.">
    <meta name="author" content="Dominik Thalhammer">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="theme-color" content="#000000"/>
    <style>
        body {
            background-color: black;
            color: white;
        }

        .container {
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
        }

        .container .row {
            width: 100%;
            display: flex;
        }

        .row .cell {
            flex-grow: 1;
            flex-basis: 0;
        }

        .cell {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <a class="cell" href="/">
                <img src="/img/logo.png" width="100%" alt="Logo"/>
            </a>
        </div>
        <div class="row">
            <div class="cell">
                <p>We are currently in the process of setting up infrastructure to provide you with high quality, always on Warhawk servers.</p>
                <p>While we already have a working prove of concept to provide servers without the need to put your playstation in a VPN network.</p>
                <p>Once we are done and have working version you will be able to view stats and information here.</p>
            </div>
        </div>
        <div class="row">
            <div class="cell">
                <h3>Server list</h3>
                <table width="100%">
                    <tr><th>Name</th><th>State</th><th>Last ping</th><th>Info</th></tr>
                    <?php
                        foreach ($pdo->query("SELECT `last_state`,`last_ping`,`last_name`,`last_packet` FROM `server`;") as $row) {
                            echo("<tr style=\"background-color:");
                            if($row["last_state"] == "online") echo("green");
                            else echo("red");
                            echo(";\"><td>");
                            echo($row["last_name"]);
                            echo("</td><td>");
                            echo($row["last_state"]);
                            echo("</td><td>");
                            echo($row["last_ping"]);
                            echo(" ms</td><td>");
                            if($row["last_state"] == "online") {
                                $info = analyse_packet($row["last_packet"]);
                                echo("Mode: ".$info["mode"]."</br>");
                                echo("Map: ".$info["map"]."</br>");
                                echo("Maximum Players: ".$info["max_players"]."</br>");
                                echo("Minimum Players: ".$info["min_players"]."</br>");
                                echo("Current Players: ".$info["current_players"]."</br>");
                                echo("Time limit: ".$info["time_limit"]."</br>");
                                echo("Time eclapsed: ".$info["time_eclapsed"]."</br>");
                                echo("Start wait: ".$info["start_wait"]." s</br>");
                                echo("Spawn wait: ".$info["spawn_wait"]." s</br>");
                                echo("Rounds played: ".$info["rounds_played"]."</br>");
                                echo("Point limit: ".$info["point_limit"]."</br>");
                                echo("Points current: ".$info["points_current"]."</br>");
                            }
                            echo("</td></tr>");
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>