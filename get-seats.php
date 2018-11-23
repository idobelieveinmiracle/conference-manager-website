<?php 
	require 'database-connection.php';
	if (isset($_GET['pre_id']) && isset($_GET['area']) && isset($_GET['row'])){
		echo get_seats_json($_GET['pre_id'], $_GET['area'], $_GET['row']);
	}
 ?>