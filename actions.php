<?php 
session_start();
require_once('libs/Admin.php');

$admin = new Admin();

if(empty($_POST)){
	die("From data required !");
}

if(!empty($_POST['action'])){
$action = filter_input(INPUT_POST, 'action');

switch ($action) {
	case 'login_check':
		$username = filter_input(INPUT_POST, 'username');
		$password = filter_input(INPUT_POST, 'password');
		if($admin->checkLogin($username,$password)){
			echo "welcome user";
			$_SESSION['CMS_ADMIN'] = 'admin';
			header('location:home.php');
		}else{
			echo "Login failed ! Please try again";
			header('location:index.php');
		}
		break;
	
	default:
		# code...
		break;
}

}else{
header("location:index.php");
}






 ?>