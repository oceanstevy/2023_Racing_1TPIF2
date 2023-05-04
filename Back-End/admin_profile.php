<?php
	
	//Author: Nicolas
	
	session_start();
	
	require_once "Functions/Credentials.php";
	require_once "Functions/Functions.php";
	require_once "Query/Querys.php";
	
	$dbc = db_Connect();
	$usernameProfile = $_SESSION['user'];
//	echo $usernameProfile;
	$permGroup = 2;

	$checkAdmin = $dbc->prepare(checkIfAdmin());
	$checkAdmin->bind_param('is',$permGroup, $usernameProfile);
	$checkAdmin->execute();

	$result = $checkAdmin->get_result();

	for($i = 0; $i < mysqli_num_rows ($result); $i++) {

		$row = mysqli_fetch_assoc ($result);

		if ($row["fiPermissionGroup"] === 2) {
		
		
		
		} else {
		
			
		
		}
		
	}
	
?>

<main>

<!--	<form method="post">-->
<!--		-->
<!--		label-->
<!--	-->
<!--	</form>-->

</main>
<h1 class="h1"></h1>
