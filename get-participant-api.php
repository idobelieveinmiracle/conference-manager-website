<?php 
	require 'database-connection.php';
	if (isset($_GET['id'])){
		echo json_encode(get_participant_info_by_id($_GET['id']));
	} else echo "Result 0";
 ?>