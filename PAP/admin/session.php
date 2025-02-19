<?php
include('../conDB/con_db.php');
session_start();

$login_session = $_SESSION['login_session'];

$query = $con->query("SELECT * FROM users WHERE id = '$login_session'");
$result = $query->fetch_all();

$id = $result[0][0];
$username = $result[0][1];
$cargo = $result[0][5];

if(!isset($_SESSION ['login_session'])){
    header("location:login.php");
    die();
}
?>