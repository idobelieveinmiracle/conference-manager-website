<?php 
	require 'database-connection.php';
	if (isset($_GET['pre_id']) && isset($_GET['area'])){
		echo  get_seat_area_row_num($_GET['pre_id'], $_GET['area']);
	}
 ?>