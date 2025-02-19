<?php
session_start();

if(session_destroy()){
    header ("location:/PAP/login/login.php");
}
?>