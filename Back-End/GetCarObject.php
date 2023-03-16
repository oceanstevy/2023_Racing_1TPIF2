<?php
session_start();

include_once "/Functions/Credentials.php";
include_once "/Functions/Functions.php";


$connect = db_Connect();

$query = "SELECT idCar, dtWidth, dtHeight, dtMaxSpeed, dtMaxBackSpeed, dtSpeedControl, dtMaxAchse, dtXAchsControl
                  FROM tblCar
                  WHERE idCar = ".$_GET['CarID'];

$result = mysqli_query($connect, $query);

if (mysqli_errno($connect)) {
    echo 'Error ' . mysqli_errno($connect) . 'Error : ' . mysqli_error($connect);
}

if (mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    echo "let maxspeed = " . $row['dtMaxSpeed'] . ";\n";
    echo "let maxbackspeed = " . $row['dtMaxBackSpeed'] . ";\n";
    echo "let speedcontrol = " . $row['dtSpeedControl'] . ";\n";
    echo "let maxxAchse = " . $row['dtMaxAchse'] . ";\n";
    echo "let xAchseControl = " . $row['dtXAchsControl'] . ";\n";
    echo "let carwidth = " . $row['dtWidth'] . ";\n";
    echo "let carheight = " . $row['dtHeight'] . ";";
} else {
    // Default Fahrzeug, wenn das Fahrzeug von der DatenBank fehlt
    echo "let maxspeed = 150";
    echo "let maxbackspeed = -25";
    echo "let speedcontrol = 3";
    echo "let maxxAchse = 50";
    echo "let xAchseControl = 3";
    echo "let carwidth = 50";
    echo "let carheight = 100";
}

?>
