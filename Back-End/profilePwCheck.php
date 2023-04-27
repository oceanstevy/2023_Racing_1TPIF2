<?php
	
				if (isset($_GET['DATA_Password'], $_GET['ReDATA_Password'])) {
					$dbc = db_Connect();
				$password_u = $_GET[ 'DATA_Password' ];
				$retypePassword_u = $_GET[ 'DATA_Re-Password' ];
				
				if ( $password_u !== $retypePassword_u ) {
					echo "Password does not match";
					$dbc -> close ();
					exit();
				}
				$hashedPassword_u = password_hash ( $password_u , PASSWORD_DEFAULT );
				
				$queryUpdatePW = $dbc -> prepare ( updatePassword () );
				$queryUpdatePW -> bind_param ( 'ss' , $hashedPassword_u , $_SESSION[ 'User' ] );
				$dbc ->close ();
			}
