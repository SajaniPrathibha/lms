<?php 
session_start();
session_destroy();
unset($_SESSION['uid']);

header('Location:login.php');


?>