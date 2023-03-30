<?php
$_COOKIE['PHPSESSID'] = $_GET['SeesionID'];
session_start();

session_destroy();
?>