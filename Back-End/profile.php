
<!--Created by Jann-->

<?php
	session_start ();
	
	require_once "Functions/Credentials.php";
	require_once "Functions/Functions.php";
	require_once  "Query/Querys.php";
	
	echo  "You are logged in as: " .  $_SESSION['user'] . "<br><br>";

//shows the Profile information for the user who is currently logged in.
	
	$dbc = db_Connect();
	$usernameProfile = $_SESSION['user'];
	
	$showProfile = $dbc->prepare(showProfile());
	$showProfile->bind_param('s',$usernameProfile);
	$showProfile->execute();
	
	$result = $showProfile->get_result();
	
	
	echo "<table>";
	echo "<tr><th>Email</th>";
	echo "<tr></tr>";
	
	$row = mysqli_fetch_assoc($result);
	echo "<tr>";
	echo    "<td>" . $row["dtName"] . "</td>";
	echo "</tr>";
	
	echo "</table><br>";
	
	?>
<label for="DATA_Password"></label>
<input type="text" id="DATA_Password"><br>
<label for="DATA_RePassword"></label>
<input type="text" id="ReDATA_Password"><br>
<button type="button" id="CONFIRM_Info">Save</button>



<?php
	if (isset($_POST['CONFIRM_Info'])) {
		if ( $_POST[ 'DATA_Password' ] !== "" || $_POST[ 'DATA_Re-Password' ] !== "" ) {
			
			$password_u = $_POST[ 'DATA_Password' ];
			$retypePassword_u = $_POST[ 'DATA_Re-Password' ];
			
			if ( $password_u !== $retypePassword_u ) {
				echo "Password does not match";
				$dbc -> close ();
				exit();
			}
			$hashedPassword_u = password_hash ( $password_u , PASSWORD_DEFAULT );
			
			$queryUpdatePW = $dbc -> prepare ( updatePassword () );
			$queryUpdatePW -> bind_param ( 'ss' , $hashedPassword_u , $_SESSION[ 'User' ] );
			echo "<br>";
		}
	}
	
// ----------------------- FREE -----------------------
	mysqli_free_result($result);
// ----------------------- CLOSE -----------------------
	mysqli_close($dbc);
	
	
	