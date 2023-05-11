<?php
	//@author Scheer Nicolas
	
	
	//Logout Button
	
	if (isset($_GET['SeesionID'])) {
		$_COOKIE['PHPSESSID'] = $_GET['SeesionID'];
		session_start();
		session_unset();
		session_destroy();
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