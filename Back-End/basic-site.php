<?php
	$_SESSION["user"] = "Johnny";
	
	//@author Scheer Nicolas
	
	if (isset($_SESSION["user"])) {
		
		//Logout Button
		
		if (isset($_GET['logout'])) {
			
			if ($_GET['logout'] == true) {
				
				logout();
				
			}
			
			//Logout END
			//Settings Button
		} else if (isset($_GET['settings'])) {
			
			if ($_GET["settings"] == true) {
				
				settings();
				
			}
			
			//Settings Button End
			
		} else if ($_GET['play']) {
			
			if ($_GET['play'] == true) {
				
				play();
				
			}
			
		} else {
			
			error();
			
		}
	}
	
	//	Function for logging out button
	//	@author Scheer Nicolas
	function logout()
	{
		echo json_encode(["errorCode" => "success!"]);
		
		session_destroy();
		session_unset();
		
		
	}
	
	//Function for Settingsbutton
	//	@author Scheer Nicolas
	function settings()
	{
	
	
	}
	
	//Function for Playbutton
	//	@author Scheer Nicolas
	function play()
	{
	
	
	}
	
	//Function for Errors
	//	@author Scheer Nicolas
	function error()
	{
		
		echo json_encode(["errorCode" => "Error!"]);
		
	}