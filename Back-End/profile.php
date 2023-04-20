
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
<label for="DATA_Password">Passwort</label><br>
<input type="text" id="DATA_Password"><br>
<label for="DATA_RePassword">Passwort bestätigen</label><br>
<input type="text" id="ReDATA_Password"><br>
<button type="button" id="CONFIRM_Info">Save</button>



<?php

	
// ----------------------- FREE -----------------------
	mysqli_free_result($result);
// ----------------------- CLOSE -----------------------
	mysqli_close($dbc);
	
	
	