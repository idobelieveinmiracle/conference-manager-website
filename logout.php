<?php 
	setcookie("username", "", time()-1);
	setcookie("password", "", time()-1);
	header("location: index.php");
 ?>