<?php
$_COOKIE['PHPSESSID'] = $_GET['SeesionID'];
session_start();

//login.php created by Xu
    require_once "../Functions/Credentials.php";
    require_once "../Functions/Functions.php";

    $connect = db_Connect();

//Abfrage, ob login gedrückt wurde
if (isset($_GET['loginName']) && isset($_GET['loginPassword'])){
    //Kontrolle ob etwas eingegeben wurde
    if ($_GET['loginName'] != "" && $_GET['loginPassword'] != ""){
        //Query wird vorbereitet um vor Injections zu schützen
        $query = $connect->prepare("SELECT dtName,dtPassword FROM tblPlayer WHERE dtName = ?");

        $query->bind_param('s',$_GET['loginName']);

        $query->execute();

        $result = $query->get_result();
        //Kontrolle, ob der Benutzer existiert
        if (mysqli_num_rows($result) != 0){

            $row = mysqli_fetch_assoc($result);
            //Passwort wird entschlüsselt
            $verify = password_verify($_GET['loginPassword'], $row['dtPassword']);
            //Kontrolle ob das Passwort richtig ist
            if ($verify){
                //Falls alles richtig ist, wird der Benutzer eingeloggt
                echo json_encode (["errorCode" => "success!"]);
                $_SESSION['user'] = $row['dtName'];
				echo $_SESSION["user"];
            }
            else{
                //Falsches Passwort
                echo json_encode (["errorCode" => "error!"]);
            }
        }
        else{
            //Benutzer existiert nicht
            echo json_encode (["errorCode" => "error!"]);
        }

    }
    else{
        //Es fehlt mindestens etwas beim logi
        echo json_encode (["errorCode" => "error!"]);
    }
}

?>