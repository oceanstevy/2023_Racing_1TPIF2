<?php
//      --  Joni - Begin     --
$_COOKIE['PHPSESSID'] = $_GET['SeesionID'];

$r = [];

if (isset($_SESSION['user'])){
    $r = [
        "check" => true
    ];
} else {
    $r = [
        "check" => false
    ];
}

unset($_COOKIE);

echo json_encode($r);

