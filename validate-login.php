<?php 
	require "database-connection.php";

	if (isset($_POST["login"])){
		$username = $_POST["username"];
		$password = $_POST["password"];		
		if (check_login($username, $password)){		
			echo "pretty";	
			setcookie('username', $username, time()+86400*7);
			setcookie('password', $password, time()+86400*7);
			header("location: index.php");
		} else {
			echo "Wrong";
			setcookie('alert', 'login-failed', time()+5*60);
			header("location: login.php#login");
		}		
	} else {
		echo "no post";
		header("location: login.php#login");
	}
 ?>