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
//Update Pw
	function updatePassword(){
		return "
    UPDATE tblPlayer
    SET dtPassword = ?
    WHERE dtName = ?
    ";
	}
//	--------------------------------------------------

// XU:
    function createRank(){
        return "SELECT * FROM tblScore LEFT JOIN tblPlayer ON fiPlayer = idPlayer ORDER BY dtScore DESC";
    }
    function personalBest(){
        return "SELECT * FROM tblScore 
                LEFT JOIN tblPlayer ON fiPlayer = idPlayer 
                WHERE dtName =  '{$_SESSION['user']}'   
                ORDER BY dtScore DESC";
    }
	
	//Nicolas : checks if current User is Admin

	function checkIfAdmin() {
		
		return "SELECT * FROM tblPlayer
				WHERE fiPermissionGroup = ?
				AND dtName = ?";
		
	}
	
	//Nicolas : get all Users
	
	function getAllUsers() {
		
		return "SELECT * FROM tblPlayer";
		
	}

