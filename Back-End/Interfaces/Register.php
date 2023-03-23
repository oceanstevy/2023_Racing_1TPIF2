<!--Created by Jann-->
<?php
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
		?>
<!--		<script>-->
<!--			alert('Name does not have the right Length')-->
<!--		</script>-->
		<?php

		exit();
	}

	// Check if UserName exists
	$dbc = db_Connect();

	$checkExistingUser = $dbc->prepare(checkUsername());
	$checkExistingUser->bind_param('s', $email);

	if ($checkExistingUser->execute() === false){

        echo json_encode (["errorCode" => "error!"]);

		$dbc->close();
		exit();
	}

	// Check password: minlength, maxlength
	if (strlen($password) < 5 || strlen($password) > 50) {

        echo json_encode (["errorCode" => "error!"]);

		$dbc->close();
		exit();
	}
	// Check retypePassword: minlength, maxlength
	if (strlen($retypePassword) < 5 || strlen($retypePassword) > 50) {

        echo json_encode (["errorCode" => "error!"]);

		$dbc->close();
		exit();
	}

	if ($password !== $retypePassword){

        echo json_encode (["errorCode" => "error!"]);

		$dbc->close();
		exit();
	}
	$dbc = db_Connect();
	$hashedPassword = hashPassword($password);
    echo $hashedPassword;
	$statement = $dbc->prepare(registerUser());
	$statement->bind_param('ss', $Playerame, $hashedPassword);

	if ($statement->execute() === false) {

        echo json_encode (["errorCode" => "error!"]);

		$dbc->close();
		exit();
	} else {

        echo json_encode (["errorCode" => "success!"]);
        $_SESSION['user'] = $Playerame;

		$dbc->close();
	}

?>