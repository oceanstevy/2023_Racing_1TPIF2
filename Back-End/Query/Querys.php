<?php
	
	function checkUsername() {
		return "
    SELECT dtName
    FROM tblPlayer
    WHERE dtName = ?
    ";
	}
	function registerUser() {
		return"
   INSERT INTO tblPlayer (dtName, dtPassword)
    VALUES (?, ?)
    ";
	}
	function hashPassword($password) {
		return crypt($password, '42');
	}