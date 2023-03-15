<?php
function db_Connect(){

    $connect = mysqli_connect(DB_HOST,DB_USER,DB_PW,DB_NAME);

    if (mysqli_connect_errno()){
        echo mysqli_errno($connect);
    }
    return $connect;
}

?>