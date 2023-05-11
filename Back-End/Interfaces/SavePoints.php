<?php
$_COOKIE['PHPSESSID'] = $_GET['SeesionID'];

session_start();

$output = [];

include_once "./../Functions/Credentials.php";
include_once "./../Functions/Functions.php";

$dbc = db_Connect();

$query = "SELECT IdPlayer FROM tblPlayer 
                WHERE dtName = '".$_SESSION['user']."';";

$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result);

    $query = "INSERT INTO tblScore(dtScore, fiPlayer)
                                  VALUES(?,?);";

    $statement = mysqli_prepare($dbc,$query);
    mysqli_stmt_bind_param($statement, "is" ,$_GET['Points'] , $row['IdPlayer']);

    mysqli_stmt_execute($statement);

    $output = [
        "error" => "no"
    ];

} else {
    $output = [
        "error" => "yes"
    ];
}

echo json_encode($output);

?>
