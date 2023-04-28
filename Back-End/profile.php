
<!--Created by Jann-->

<?php
	session_start ();
	
	require_once "Functions/Credentials.php";
	require_once "Functions/Functions.php";
	require_once "Query/Querys.php";

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
<div id="PROFILE_Div">
<label for="DATA_Password" class="PROFILE_Label">Passwort</label><br>
<input type="text" id="DATA_Password" class="PROFILE_Input"><br><br>
<label for="DATA_RePassword" class="PROFILE_Label">Passwort bestätigen</label><br>
<input type="text" id="ReDATA_Password" class="PROFILE_Input"><br><br>
<button type="button" id="CONFIRM_Info" class="PROFILE_Button">Save</button>
<button type="button" id="BACK_Home" class="PROFILE_Button">Back</button>
</div>

<script>
	//if button is pressed
	$("#CONFIRM_Info").click(() => {
		const data = {
			DATA_Password: $("#DATA_Password").val(),
			ReDATA_Password: $("#ReDATA_Password").val()
		};
		$.get("../Back-End/profilePWCheck.php", data, (response) => {
		
			
		});
		const jsonData = JSON.stringify(data);
		alert("login succhessfull");
		GetMenuPage()
	});
	
	$("#BACK_Home").click(() => {
		GetMenuPage()
	});
</script>

<?php

	
// ----------------------- FREE -----------------------
	mysqli_free_result($result);
// ----------------------- CLOSE -----------------------
	mysqli_close($dbc);
	
	
	