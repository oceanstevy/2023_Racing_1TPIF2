<?php
	
	//	@author Scheer Nicolas
	
	
	if (isset($_GET['logout'])) {
		
		if ($_GET['logout'] == true) {
			
			logout();
			
		}
		
	}
	
	//	Function for logging out
	//	@author Scheer Nicolas
	function logout()
	{
		
		session_destroy();
		session_unset();
		
		echo json_encode(["errorCode" => "success!"]);
		
	}

?>

	