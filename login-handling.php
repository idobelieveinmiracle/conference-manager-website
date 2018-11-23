<?php 
	require "database-connection.php";

	$sql = "SELECT id FROM Participants WHERE username='" . $_POST["username"] . "' AND password='" . $_POST["password"] ."'";
    $result = $conn->query($sql);

    if ( $result->num_rows > 0) {
      echo "<script>console.log('login success')</script>";
      $username = $_POST["username"];
      setcookie("username", $username, time()+(86400*30), "/");
    } else echo "<script>console.log('login not success')</script>";
 ?>