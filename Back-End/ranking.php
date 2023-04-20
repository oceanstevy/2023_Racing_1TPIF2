<?php
require_once "Functions/Credentials.php";
require_once "Functions/Functions.php";
// Xu Yang
if ($_GET['Action'] = "ranking"){
    $connect = db_Connect();

    $query = "SELECT * FROM tblScore ORDER BY dtScore";

    $result = mysqli_query($connect, $query);

    $arrayFeed = [];

    for ($i = 1; $i <= mysqli_num_rows($result); $i++){
        if ($i >= 10){
            $row = mysqli_fetch_assoc($result);

            $arrayFeed[$i] = array (
                "Rank" => $i ,
                "Name" => $row[ 'fiPlayer' ] ,
                "Score" => $row[ 'dtScore' ],
            );
        }
    }

    json_encode ($arrayFeed);
}



