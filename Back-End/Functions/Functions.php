<?php
$path = $_SERVER['HTTP_HOST'] . "/Github/2023_Racing_1TPIF2/";

function db_Connect(){

    $connect = mysqli_connect(DB_HOST,DB_USER,DB_PW,DB_NAME);

    if (mysqli_connect_errno()){
        echo mysqli_errno($connect);
    }
    return $connect;
}

?>