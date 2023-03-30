<?php
require_once "Functions/Credentials.php";
require_once "Functions/Functions.php";
// Xu Yang
if ($_GET['Action'] = "ranking"){
    $connect = db_Connect();

    $query = "SELECT * FROM tblScore ORDER BY dtScore";

    $result = mysqli_query($connect, $query);

    $row = mysqli_fetch_assoc($result);

    $output = "<table border='1px black solid'>
            <tr><th>Rank</th><th>Spieler</th><th>Punkte</th></tr>";

    for ($i = 1; $i <= 10; $i++){

        $output .= "<tr><td>{$i}</td><td>{$row['fiPlayer']}</td><td>{$row['dtScore']}</td></tr>";

    }

    $output .= "</table>";

    echo json_encode (["errorCode" => "success!"]);
}



