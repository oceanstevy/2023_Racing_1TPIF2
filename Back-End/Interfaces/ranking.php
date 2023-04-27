<?php
require_once "../Functions/Credentials.php";
require_once "../Functions/Functions.php";
require_once "../Query/Querys.php";
// Created by Xu
header('Content-Type: application/json; charset=utf-8');

    $connect = db_Connect();

    $query = createRank();

    $result = mysqli_query($connect, $query);

    $arrayFeed = [];

    for ($i = 1; $i <= mysqli_num_rows($result); $i++){
        if ($i <= 10){
            $row = mysqli_fetch_assoc($result);

            $arrayFeed[] = array (
                "Rank" => $i ,
                "Name" => $row[ 'dtName' ] ,
                "Score" => $row[ 'dtScore' ],
            );
        }
    }

    echo json_encode ($arrayFeed);




