<?php
//login.php created by Xu
    require_once "Functions/Credentials.php";
    require_once "Functions/Functions.php";

    $connect = db_Connect();
?>

<form method="post">
    <label for="loginName">Name: </label>
    <input id="loginName" name="loginName" type="text"><br><br>
    <label for="loginPassword">Passwort: </label>
    <input id="loginPassword" name="loginPassword" type="password"><br><br>
    <button id="loginButton" name="loginButton">Login</button>
</form>

<?php

if (isset($_POST['loginButton'])){
    if ($_POST['loginName'] != "" && $_POST['loginPassword'] != ""){
        $query = $connect->prepare("SELECT dtName,dtPassword FROM tblPlayer WHERE dtName = ?");

        $query->bind_param('s',$_POST['loginName']);

        $query->execute();

        $result = $query->get_result();

        $row = mysqli_fetch_assoc($result);

        $verify = password_verify($_POST['loginPassword'], $row['dtPassword']);

        if (mysqli_num_rows($row) != 0){
            if ($verify){
                $_SESSION['user'] = $row['dtName'];
                header("location:RacingGame.html");
            }
            else{
                echo 'nope';
            }
        }
        else{
            echo 'Falscher Benutzername oder falsches Passwort.';
        }

    }
    else{
        echo 'Sie haben den Namen und/oder Passwort nicht eingegeben.';
    }

}
?>