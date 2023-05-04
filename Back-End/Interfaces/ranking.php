<?php
require_once "../Functions/Credentials.php";
require_once "../Functions/Functions.php";
require_once "../Query/Querys.php";
// Created by Xu
header('Content-Type: application/json; charset=utf-8');

$connect = db_Connect();
    if ($_GET['rank'] == "top10"){

        $query = createRank();

        $result1 = mysqli_query($connect, $query);

        $arrayFeed = [];

        for ($i = 1; $i <= mysqli_num_rows($result1); $i++){
            if ($i <= 10){
                $row = mysqli_fetch_assoc($result1);

                $arrayFeed[] = array (
                    "Rank" => $i ,
                    "Name" => $row[ 'dtName' ] ,
                    "Score" => $row[ 'dtScore' ],
                );
            }
        }

        echo json_encode ($arrayFeed);
    }
    if ($_GET['rank'] == "personal"){

        $query = personalBest();

        $result2 = mysqli_query($connect, $query);

        $arrayFeed2 = [];

        for ($i = 1; $i <= mysqli_num_rows($result2); $i++){
            if ($i <= 5){
                $row = mysqli_fetch_assoc($result2);

                $arrayFeed2[] = array (
                    "Rank" => $i ,
                    "Name" => $row[ 'dtName' ] ,
                    "Score" => $row[ 'dtScore' ],
                );
            }
        }

        echo json_encode ($arrayFeed2);
    }





