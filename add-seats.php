<?php 
	require 'database-connection.php';
	if (isset($_POST['area']) && isset($_POST['row']) && $_POST['col'] && $_POST['pre_id']){
		$pre_id = $_POST['pre_id'];
		$area = $_POST['area'];
		$row = $_POST['row'];
		$col = $_POST['col'];

		if (insert_seats($pre_id,  $row, $col, $area)) echo "success";
		else echo "failed";;
	}
 ?>