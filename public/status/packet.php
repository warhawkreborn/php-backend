<?php

function analyse_packet($data) {
    $modes = ["DM", "TDM", "Ctf", "Zones", "Hero", "Collect"];
    $maps = [
        "multi01" => "Eucadia",
        "multi02" => "Island Outpost",
        "multi03" => "The Badlands",
        "multi04" => "Unreleased, not in the game",
        "multi05" => "Destroyed Capitol",
        "multi06" => "Omega Factory",
        "multi07" => "Archipelago",
        "multi08" => "Vaporfield Glacier",
        "multi09" => "Tau Crater"
    ];

    $buf = hex2bin($data);
    $name = trim(unpack("a32", substr($buf, 180, 32))[1]);
    $map = trim(unpack("a24", substr($buf, 212, 24))[1]);
    $mode = trim(unpack("C", substr($buf, 237, 1))[1]);
    $max_players = trim(unpack("C", substr($buf, 239, 1))[1]);
    $current_players = trim(unpack("C", substr($buf, 242, 1))[1]);
    $time_eclapsed = trim(unpack("C", substr($buf, 251, 1))[1]);
    $mode_str = trim(unpack("a16", substr($buf, 256, 16))[1]);
    $time_limit = trim(unpack("C", substr($buf, 279, 1))[1]);
    $min_players = trim(unpack("C", substr($buf, 280, 1))[1]);
    $start_wait = trim(unpack("C", substr($buf, 282, 1))[1]);
    $spawn_wait = trim(unpack("C", substr($buf, 283, 1))[1]);
    $rounds_played = trim(unpack("C", substr($buf, 315, 1))[1]);

    $point_limit = trim(unpack("n", substr($buf, 272, 2))[1]);
    $points_current = trim(unpack("n", substr($buf, 274, 2))[1]);

    if($mode>=0 && $mode <=5) $mode = $modes[$mode];
    if(array_key_exists($map, $maps)) $map = $maps[$map];
    return [
        "map" => $map,
        "name" => $name,
        "mode" => $mode,
        "max_players" => $max_players,
        "current_players" => $current_players,
        "time_eclapsed" => $time_eclapsed,
        "mode_str" => $mode_str,
        "time_limit" => $time_limit,
        "min_players" => $min_players,
        "start_wait" => $start_wait,
        "spawn_wait" => $spawn_wait,
        "rounds_played" => $rounds_played,
        "point_limit" => $point_limit,
        "points_current" => $points_current
    ];
}