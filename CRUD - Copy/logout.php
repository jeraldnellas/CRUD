<?php
include_once "db/db_con.php";
session_start();
unset($_SESSION['user_id']);
session_destroy();
header ('location: login.php');
?>