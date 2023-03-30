<?php
header('Content-Type: application/json; charset=utf-8');

$_GET['SeesionID'] = 1;
$_GET['CarID'] = 1;
$_COOKIE['PHPSESSID'] = $_GET['SeesionID'];

session_start();

include_once "./../Functions/Credentials.php";
include_once "./../Functions/Functions.php";

$connect = db_Connect();

$car = [];

$query = "SELECT idCar, dtWidth, dtHeight, dtMaxSpeed, dtMaxBackSpeed, dtSpeedControl, dtMaxAchse, dtXAchsControl
                  FROM tblCar
                  WHERE idCar = ".$_GET['CarID'];

$result = mysqli_query($connect, $query);

if (mysqli_errno($connect)) {
    echo 'Error ' . mysqli_errno($connect) . 'Error : ' . mysqli_error($connect);
}

if (mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);

    $car = [
        "maxspeed" => $row['dtMaxSpeed'],
        "maxbackspeed" => $row['dtMaxBackSpeed'],
        "speedcontrol" => $row['dtSpeedControl'],
        "maxxAchse" => $row['dtMaxAchse'],
        "xAchseControl" => $row['dtXAchsControl'],
        "carwidth" => $row['dtWidth'],
        "carheight" => $row['dtHeight']
    ];

} else {
    // Default Fahrzeug, wenn das Fahrzeug von der DatenBank fehlt

    $car = [
        "maxspeed" => 150,
        "maxbackspeed" => -25,
        "speedcontrol" => 3,
        "maxxAchse" => 50,
        "xAchseControl" => 3,
        "carwidth" => 50,
        "carheight" => 100
    ];

}

unset($_COOKIE);

echo json_encode($car);

?>
