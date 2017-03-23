<?php
session_start();
require_once '../libs/Admin.php';
$admin = new Admin();
if (!empty($_POST)) {
    $username = $_POST['username'];
    $password = $_POST['password'];
       $login = $admin->checkLogin($username, $password);
    if (!empty($login)) {
        echo "welcome user";
        $_SESSION['CMS_ADMIN'] = 'admin';
        header('location:../home.php');
    } else {
        echo "Login failed ! Please try again";
        header('location:../index.php');
    }
} else {
    
}

