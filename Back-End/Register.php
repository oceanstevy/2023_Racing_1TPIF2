
<!--Created by Jann-->

<form method="post">
	
	<label>
		Name
		
		<input type="text" maxlength="50" name="DATA_PlayerName" required >
	</label>
	
	<label>
		Password
		
		<input type="password" maxlength="50" name="DATA_Password" required >
	</label>
	
	<label>
		Retype password
		
		<input type="password" maxlength="50" name="DATA_RE_Password" required >
	</label>
	
	<button class="button-register" type="submit" name="BUTTON_Register">Register</button>
</form>

<?php
	
	require_once $_SERVER['DOCUMENT_ROOT'] . 'ConnectDB.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/Query/Querys.php';
	
	if (isset($_POST['BUTTON_Register'])) {
		$Playerame = $_POST['DATA_PlayerName'];
		$password = $_POST['DATA_Password'];
		$retypePassword = $_POST['DATA_RE_Password'];
		
		// Check email: minlength, maxlength
		if (strlen($Playerame) < 5 || strlen($Playerame) > 50) {
			?>
			<script>
				alert('Name does not have the right Length')
			</script>
			<?php
			
			exit();
		}
		
		// Check if UserName exists
		$dbc = db_Connect();
		
		$checkExistingUser = $dbc->prepare(checkUsername());
		$checkExistingUser->bind_param('s', $email);
		
		if ($checkExistingUser->execute() === false){
			?>
				<script>
					alert('User already exists')
				</script>
			<?php
			
			$dbc->close();
			exit();
		}
		
		// Check password: minlength, maxlength
		if (strlen($password) < 5 || strlen($password) > 50) {
			
			?>
			<script>
                alert('Password does not have the right length')
			</script>
			<?php
			
			$dbc->close();
			exit();
		}
		// Check retypePassword: minlength, maxlength
		if (strlen($retypePassword) < 5 || strlen($retypePassword) > 50) {
			?>
			<script>
                alert('Re-Password does not have the right length')
			</script>
			<?php
			$dbc->close();
			exit();
		}
		
		if ($password !== $retypePassword){
			?>
			<script>
                alert('Password does not match')
			</script>
			<?php
			$dbc->close();
			exit();
		}
		$dbc = db_Connect();
		$hashedPassword = hashPassword($password);
		
		$statement = $dbc->prepare(registerUser());
		$statement->bind_param('ss', $Playerame, $hashedPassword);
		
		if ($statement->execute() === false) {
			?>
			<script>
                alert('Something went wrong')
			</script>
			<?php
			
			$dbc->close();
			exit();
		} else {
			?>
			<script>
                alert('User Succesfully created!')
			</script>
			<?php
			
			$dbc->close();
		}
	}

?>