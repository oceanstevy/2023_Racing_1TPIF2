<?php
	
	session_start ();
	
	require_once "Functions/Credentials.php";
	require_once "Functions/Functions.php";
	require_once "Query/Querys.php";
	
				if (isset($_GET['DATA_Password'], $_GET['ReDATA_Password'])) {
					$dbc = db_Connect();
					$password_u = $_GET[ 'DATA_Password' ];
					$retypePassword_u = $_GET[ 'ReDATA_Password' ];
				
				if ( $password_u !== $retypePassword_u ) {
					echo "Password does not match";
					$dbc -> close ();
					exit();
				}
				$hashedPassword_u = password_hash ( $password_u , PASSWORD_DEFAULT );
				$queryUpdatePW = $dbc -> prepare ( updatePassword () );
				$queryUpdatePW -> bind_param ( 'ss' , $hashedPassword_u , $_SESSION[ 'user' ] );
				$queryUpdatePW -> execute ();
				$dbc ->close ();
			}
