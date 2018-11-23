<?php 
	$id = 1;
	require 'database-connection.php';
	$sql = "";
	$sql .= "SELECT * FROM hoi_thao_db.Participants ";
	$sql .= "WHERE id=".$id;

	$result = $GLOBALS["conn"]->query($sql);
	if (! $result ){
		trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
	} else {
		if ($result->num_rows < 1) echo "nothing";
		else {
			if ($row = $result->fetch_assoc()){
				$info['id'] = $row['id'];
				$info['username'] = $row['username'];
				$info['fullname'] = $row['fullname'];
				$info['age'] = $row['age'];
				$info['tel'] = $row['tel'];
				$info['job'] = $row['job'];
				$info['company'] = $row['company'];
				$info['position'] = $row['position'];
				$info['role'] = $row['role'];
				$info['img'] = $row['img'];
				$info['intro'] = $row['intro'];
				echo $info;
			}
		}
	}
?>