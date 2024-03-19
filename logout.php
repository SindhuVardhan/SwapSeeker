<?php
session_start();
session_unset();
session_destroy();

unset($_SESSION['uid']);
unset($_SESSION['username']);
unset($_SESSION['useremail']);
unset($_SESSION['usertype']);
unset($_SESSION['logged_in']);

header('location:index.php');
?>