<?php
	$dbc = db_Connect();
	
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
