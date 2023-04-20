<?php
	//Created by Jann
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
	
	//Profile
	function showProfile() {
		return"
    SELECT dtName
        FROM tblPlayer
        WHERE dtName = ?
    ";
	}

	function updatePassword(){
		return "
    UPDATE tblBenutzer
    SET dtPasswort = ?
    WHERE idEMail = ?
    ";
	}
//	--------------------------------------------------

// XU:
    function createRank(){
        return "SELECT * FROM tblScore ORDER BY dtScore";
    }

