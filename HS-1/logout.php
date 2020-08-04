<?php session_start(); ?>

<?php
include "main/addons/db_conn.php";
$_SESSION['username'] = null; //cancel session
$_SESSION['password'] = null;


session_destroy();

$servername = "";
$dbusername = "";
$dbpassword = "";
$dbname = "";

header("Location: index.php");


?>