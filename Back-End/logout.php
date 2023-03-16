<?php

	function logout() {
		
		session_destroy();
		session_unset();
		
		echo json_encode (["errorCode" => "success!"]);
		
	}

?>

	