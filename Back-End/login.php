<?php
//login.php created by Xu
    require_once "Functions/Credentials.php";
    require_once "Functions/Functions.php";

    $connect = db_Connect();
?>


<?php

if (isset($_GET['loginName']) && isset($_GET['loginPassword'])){
    if ($_GET['loginName'] != "" && $_GET['loginPassword'] != ""){
        $query = $connect->prepare("SELECT dtName,dtPassword FROM tblPlayer WHERE dtName = ?");

        $query->bind_param('s',$_GET['loginName']);

        $query->execute();

        $result = $query->get_result();

        $row = mysqli_fetch_assoc($result);

        $verify = password_verify($_GET['loginPassword'], $row['dtPassword']);

        if (mysqli_num_rows($result) != 0){
            if ($verify){
                echo json_encode (["errorCode" => "success!"]);
                $_SESSION['user'] = $row['dtName'];
                header("location:RacingGame.html");
            }
            else{
                echo 'Falsches Passwort';
            }
        }
        else{
            echo 'Falscher Benutzername';
        }

    }
    else{
        echo 'Sie haben den Namen und/oder Passwort nicht eingegeben.';
    }
}
?>