<?php 
session_start();
unset($_SESSION['CMS_ADMIN']);
header('location:index.php');
 ?>