
<!--Created by Jann-->

<?php

function db_Connect() {

    require_once "credentials.php";

    $dbc = new mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME);

    //Auf fehlerhafte Verbindung überprüfen
    if(mysqli_connect_errno())
        die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());

    mysqli_set_charset($dbc, "utf8");

    return $dbc;

};








