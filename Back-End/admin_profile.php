<?php
	
	//Author: Nicolas
	
	session_start();
	if (!isset($_SESSION["user"])) {
	
	
	
	}
	
	require_once "Functions/Credentials.php";
	require_once "Functions/Functions.php";
	require_once "Query/Querys.php";
	
	$dbc = db_Connect();
//	echo $usernameProfile;
	$permGroup = 2;
	echo $_SESSION["user"];
	$checkAdmin = $dbc->prepare(checkIfAdmin());
	$checkAdmin->bind_param('is',$permGroup, $_SESSION["user"]);
	$checkAdmin->execute();

	$result = $checkAdmin->get_result();
	
		if (mysqli_num_rows ($result) == 1) {
		
		
		
		} else {
			header("Refresh: 1");
			
//			header("Location: Github/2023_racing_1TPIF2/Front-End/basic-site.html");
//			header("Refresh: 1");
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
