<?php
session_start();
#Ends session and kicks back to login page
session_destroy();
header('Location: index.php');
die;
?>
