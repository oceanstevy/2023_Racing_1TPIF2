<?php
//Created by Jann
header('Content-Type: application/json; charset=utf-8');

$_COOKIE['PHPSESSID'] = $_GET['SeesionID'];
session_start();

    require_once "../Functions/Credentials.php";
    require_once "../Functions/Functions.php";
	require_once "../Query/Querys.php";

	$Playerame = $_GET['RegisterName'];
	$password = $_GET['RegisterPassword'];
	$retypePassword = $_GET['RegisterRePassword'];
		
	// Check email: minlength, maxlength
	if (strlen($Playerame) < 5 || strlen($Playerame) > 50) {

        echo json_encode (["errorCode" => "Der Name ist nicht groß genug!"]);

		exit();
	}

	// Check if UserName exists
	$dbc = db_Connect();

	$checkExistingUser = $dbc->prepare(checkUsername());
	$checkExistingUser->bind_param('s', $Playerame);
    $checkExistingUser->execute();
    $result = $checkExistingUser->get_result();

    if (mysqli_num_rows($result) != 0){

        echo json_encode (["errorCode" => "Es gibt schon ein Benuzer mit dem Namen!"]);

		$dbc->close();
		exit();
	}

	// Check password: minlength, maxlength
	if (strlen($password) < 5 || strlen($password) > 50) {

        echo json_encode (["errorCode" => "Das Passwort ist nicht groß genug!"]);

		$dbc->close();
		exit();
	}
	// Check retypePassword: minlength, maxlength
	if (strlen($retypePassword) < 5 || strlen($retypePassword) > 50) {

        echo json_encode (["errorCode" => "Das Passwort ist nicht groß genug!!"]);

		$dbc->close();
		exit();
	}

	if ($password !== $retypePassword){

        echo json_encode (["errorCode" => "Die Passworter sind nicht gleich!"]);

		$dbc->close();
		exit();
	}
	$dbc = db_Connect();
	$hashedPassword = hashPassword($password);
	$statement = $dbc->prepare(registerUser());
	$statement->bind_param('ss', $Playerame, $hashedPassword);

	if ($statement->execute()) {
        echo json_encode (["errorCode" => "success!"]);
        $_SESSION['user'] = $Playerame;

        $dbc->close();
	} else {
        echo json_encode (["errorCode" => "Ein Fehler ist aufgetreten!"]);

        $dbc->close();
        exit();
	}

?>