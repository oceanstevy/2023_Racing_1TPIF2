<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<body>
<h1>Login</h1><br>
        <label for='loginName'>Name: </label>
        <input id='loginName' name='loginName' type='text'><br><br>
        <label for='loginPassword'>Passwort: </label>
        <input id='loginPassword' name='loginPassword' type='password'><br><br>
        <button id='loginButton' name='loginButton'>Login</button>
<br>
<script>
    $("#loginButton").click(() => {

        let name = $("#loginName").val();
        let pw = $("#loginPassword").val();

        path += "Back-End/login.php";

        $.getJSON(path, "loginName=" + name + "&loginPassword=" + pw, (data) => {

            if (data.errorCode === "success!") {

                alert("success");

            }

        });

    })
</script>
<h1>Register</h1><br>
<?php
    require_once 'Include_Functions/functions.js';
    require_once '../Back-End/login.php';
    require_once '../Back-End/Register.php';
?>