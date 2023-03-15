<?php
//login.php created by Xu
    require_once "Functions/Credentials.php";
    require_once "Functions/Functions.php";

    $connect = db_Connect();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
</head>
<body>
<h1>Login</h1>
<form method="post">
    <label for="loginName">Name: </label>
    <input id="loginName" name="loginName" type="text"><br><br>
    <label for="loginPassword">Passwort: </label>
    <input id="loginPassword" name="loginPassword" type="password"><br><br>
    <button id="loginButton" name="loginButton">Login</button>
</form>
<?php

if (isset($_POST['loginButton'])){
    $query = $connect->prepare("SELECT idPlayer,dtName,dtPassword FROM tblPlayer
                      WHERE dtName = ?");

    $query->bind_param('s',$_POST['loginName']);

    $query->execute();

    $result = $query->get_result();

    $row = mysqli_fetch_assoc($result);

    $verify = password_verify($_POST['loginPassword'], $row['dtPassword']);

    if ($verify){
        $_SESSION['user'] = $row['dtName'];
        $_SESSION['userID'] = $row['idPlayer'];
        //header("location:index.php?page=home");
    }
    else{
        $_SESSION['user'] = "";
        $_SESSION['userID'] = "";
        echo 'nope';
    }

}
?>
</body>
</html>