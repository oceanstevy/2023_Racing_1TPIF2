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

define('DB_HOST', '89.58.47.144');
define('DB_USER', '2023_1TPIF_CarGame');
define('DB_PW', '.5(fTAPJ1w)D)d7V');
define('DB_NAME', 'db_2023_1TPIF2_CARGAME');

$connect = mysqli_connect(DB_HOST,DB_USER,DB_PW,DB_NAME);

if (mysqli_connect_errno()){
    echo mysqli_errno($connect);
}

if (isset($_POST['loginButton'])){
    $query = "SELECT idPlayer,dtName,dtPassword,dtDisplayName FROM tblPlayer
                      WHERE dtName = '" . $_POST['loginName'] ."'";

    $result = mysqli_query($connect,$query);

    $row = mysqli_fetch_assoc($result);

    $verify = password_verify($_POST['loginPassword'], $row['dtPassword']);

    if ($verify){
        $_SESSION['user'] = $row['dtName'];
        $_SESSION['userID'] = $row['idPlayer'];
        header("location:index.php?page=home");
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