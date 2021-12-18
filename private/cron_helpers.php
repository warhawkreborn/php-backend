<?php

function check_host($ip) {
    $port = 10029;
    // Discovery message
    $str = hex2bin("c381b800001900b6018094004654000005000000010000000000020307000000c0a814ac000000002d27000000000000010000005761726861776b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000002801800ffffffff00000000000000004503d7e0000000000000005a");
    assert(strlen($str)==188);
    
    $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP); 
    socket_set_option($sock, SOL_SOCKET, SO_BROADCAST, 1);
    socket_set_option($sock, SOL_SOCKET, SO_RCVTIMEO, array("sec"=>1, "usec"=>0));
    $start = (int)(microtime(TRUE)*1000);
    socket_sendto($sock, $str, strlen($str), 0, $ip, $port);
    
    $ret = @socket_recvfrom($sock, $buf, 1024, 0, $ip, $port);
    $time = (int)(microtime(TRUE)*1000) - $start;
    if($ret !== 372) return [
        "state"=>"offline"
    ];
    socket_close($sock);

    $name = trim(unpack("a32", substr($buf, 180, 32))[1]);
    $map = trim(unpack("a24", substr($buf, 212, 24))[1]);

    return [
        "msg" => bin2hex($buf),
        "state" => "online",
        "ping" => $time,
        "name" => $name,
        "map" => $map
    ];
}

function sendFCM($title, $message, $id) {
    $key = "AAAA-ivSwWI:APA91bEpox0Dt27ClwKjb4rHUjhQKVQt1GMvSqC-w6rBOkZSE4wZbQBFz8Y6sAm6mYkltDM5dj89ECLkTRMRfZ5zUuCb1I7bNxsO9J4w9vbpjkLPgCv7RKyFDTguOy6t6SEFxQMaY51c";
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = json_encode([
        'to' => $id,
        'notification' => [
            "title" => $title,
            "body" => $message,
            "sound" => "default",
            "channelId" => "serverinfo"
        ]
    ]);

    $headers = [
        'Authorization: key='.$key,
        'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url );
    curl_setopt($ch, CURLOPT_POST, true );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec($ch);
    curl_close($ch);
}
