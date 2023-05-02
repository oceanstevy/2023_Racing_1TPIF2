<?php
header('Content-Type: application/json; charset=utf-8');

$output = [];

if(isset($_GET['up'])){
    $output += [
        "maprequest" => "up"
    ];
}
if(isset($_GET['right'])){
    $output += [
        "maprequest" => "right"
    ];
}
if(isset($_GET['down'])){
    $output += [
        "maprequest" => "down"
    ];
}
if(isset($_GET['left'])){
    $output += [
        "maprequest" => "left"
    ];
}

$output += [
    "mapid" => $_GET['newmapid'],
    "mapname" => "map01"
];

$file = file_get_contents("../Maps/map01.json");


echo json_encode(array_merge($output, json_decode($file, true)))
?>
