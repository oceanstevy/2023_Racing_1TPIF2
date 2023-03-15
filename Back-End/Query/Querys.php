<?php
	
	function checkUsername() {
		return "
    SELECT dtName
    FROM tblplayer
    WHERE dtName = ?
    ";
	}
	function registerUser() {
		return"
   INSERT INTO tblplayer (dtName, dtPassword)
    VALUES (?, ?)
    ";
	}
	function hashPassword($password) {
		return crypt($password, '42');
	}