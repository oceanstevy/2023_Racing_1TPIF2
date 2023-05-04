<?php
	
	//Author: Nicolas
	
	session_start();
	
	require_once "Functions/Credentials.php";
	require_once "Functions/Functions.php";
	require_once "Query/Querys.php";
	
	$dbc = db_Connect();
	$usernameProfile = $_SESSION['user'];
	$permGroup = 2;
	
	$checkAdmin = $dbc->prepare(checkIfAdmin());
	$checkAdmin->bind_param('si',$usernameProfile, $permGroup);
	$checkAdmin->execute();
	
	$result = $checkAdmin->get_result();
	
	print_r($result);

?>

<main>

<!--	<form method="post">-->
<!--		-->
<!--		label-->
<!--	-->
<!--	</form>-->

</main>
<h1 class="h1"></h1>
