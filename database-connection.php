<?php
	header('Content-Type: text/html; charset=utf-8');
	// Create connection
	$conn = new mysqli("localhost", "root", "");

	mysqli_set_charset($conn,"utf8");
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	function check_login($username, $password){
		$sql = "SELECT id FROM hoi_thao_db.Participants " . 
			"WHERE username='".$username."' AND ".
			"password='".$password."'";

		$result = $GLOBALS["conn"]->query($sql);
		if (! $result ){
			trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
		} else {
			if ($result->num_rows > 0) return TRUE;
			else return FALSE;
		}
		
	}

	function get_participant_info($username){
		$sql = "";
		$sql .= "SELECT * FROM hoi_thao_db.Participants ";
		$sql .= "WHERE username='".$username."'";

		$result = $GLOBALS["conn"]->query($sql);
		if (! $result ){
			trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
		} else {
			if ($result->num_rows < 1) return NULL;
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
					return $info;
				}
			}
		}
	}

	function get_all_presentations(){
		$sql = "";
		$sql .= "SELECT * FROM hoi_thao_db.Presentations
		 INNER JOIN hoi_thao_db.Participants ON 
		 hoi_thao_db.Presentations.speaker_id = hoi_thao_db.Participants.id";

		$result = $GLOBALS["conn"]->query($sql);
		if (! $result ){
			trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
		} else {
			if ($result->num_rows < 1) return NULL;
			else {
				$arr = array();
				while ($row = $result->fetch_assoc()){
					array_push($arr, $row);
				}
				return $arr;
			}
		}
	}

	function get_participant_info_by_id($id){
		$sql = "";
		$sql .= "SELECT * FROM hoi_thao_db.Participants ";
		$sql .= "WHERE id=".$id;

		$result = $GLOBALS["conn"]->query($sql);
		if (! $result ){
			trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
		} else {
			if ($result->num_rows < 1) return NULL;
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
					return $info;
				}
			}
		}
	}

	function get_presentation_by_id($id){
		$sql = "";
		$sql .= "SELECT * FROM hoi_thao_db.Presentations ";
		$sql .= "INNER JOIN hoi_thao_db.Participants ";
		$sql .= "ON hoi_thao_db.Participants.id=hoi_thao_db.Presentations.speaker_id ";
		$sql .= "WHERE pre_id=".$id;

		$result = $GLOBALS["conn"]->query($sql);
		if (! $result ){
			trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
		} else {
			if ($result->num_rows < 1) return NULL;
			else {
				if ($row = $result->fetch_assoc()){
					return $row;
				}
			}
		}
	}

	function get_presentations_by_speaker_id($speaker_id){
		$sql = "";
		$sql .= "SELECT * FROM hoi_thao_db.Presentations ";
		$sql .= "INNER JOIN hoi_thao_db.Participants ";
		$sql .= "ON hoi_thao_db.Participants.id=hoi_thao_db.Presentations.speaker_id ";
		$sql .= "WHERE speaker_id=".$speaker_id;

		$result = $GLOBALS["conn"]->query($sql);
		if (! $result ){
			trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
		} else {
			if ($result->num_rows < 1) return NULL;
			else {
				$arr = array();
				while ($row = $result->fetch_assoc()){
					array_push($arr, $row);
				}
				return $arr;
			}
		}
	}

	function get_presentation_info($pre_id){
		$sql = "";
		$sql .= "SELECT * FROM hoi_thao_db.Presentations ";
		$sql .= "INNER JOIN hoi_thao_db.Participants ";
		$sql .= "ON hoi_thao_db.Participants.id=hoi_thao_db.Presentations.speaker_id ";
		$sql .= "WHERE spre_id=".$pre_id;

		$result = $GLOBALS["conn"]->query($sql);
		if (! $result ){
			trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
		} else {
			if ($result->num_rows < 1) return NULL;
			else {
				if ($row = $result->fetch_assoc()){
					return $row;
				} else return NULL;
			}
		}
	}

	function get_all_speakers(){
		$sql = "";
		$sql .= "SELECT * FROM hoi_thao_db.Participants ";
		$sql .= "WHERE role='Speaker'";

		$result = $GLOBALS["conn"]->query($sql);
		if (! $result ){
			trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
		} else {
			if ($result->num_rows < 1) return NULL;
			else {
				$arr = array();
				while ($row = $result->fetch_assoc()){
					array_push($arr, $row);
				}
				return $arr;
			}
		}
	}

	function get_seats($pre_id, $area_name, $row){
		$sql = "";
		$sql .= "SELECT * FROM hoi_thao_db.Seats ";
		$sql .= "WHERE pre_id=".$pre_id." ";
		$sql .= "AND area='".$area_name."' ";
		$sql .= "AND row=".$row;

		$result = $GLOBALS["conn"]->query($sql);
		if (! $result ){
			trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
		} else {
			if ($result->num_rows < 1) return NULL;
			else {
				$arr = array();
				while ($row = $result->fetch_assoc()){
					array_push($arr, $row);
				}
				return $arr;
			}
		}
	}

	function get_seats_json($pre_id, $area_name, $row){
		$sql = "";
		$sql .= "SELECT * FROM hoi_thao_db.Seats ";
		$sql .= "WHERE pre_id=".$pre_id." ";
		$sql .= "AND area='".$area_name."' ";
		$sql .= "AND row=".$row;

		$result = $GLOBALS["conn"]->query($sql);
		if (! $result ){
			trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
		} else {
			if ($result->num_rows > 0) {
				$seatss = mysqli_fetch_all($result, MYSQLI_ASSOC);
				return json_encode($seatss);
			} else return "Result 0";
		}
	}

	function get_seat_areas($pre_id){
		$sql = "";
		$sql .= "SELECT area FROM hoi_thao_db.Seats ";
		$sql .= "WHERE pre_id=".$pre_id." ";
		$sql .= "GROUP BY area";

		$result = $GLOBALS["conn"]->query($sql);
		if (! $result ){
			trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
		} else {
			if ($result->num_rows < 1) return NULL;
			else {
				$arr = array();
				while ($row = $result->fetch_assoc()){
					array_push($arr, $row['area']);
				}
				return $arr;
			}
		}
	}

	function get_seat_area_row_num($pre_id, $area){
		$sql = "";
		$sql .= "SELECT * FROM hoi_thao_db.Seats ";
		$sql .= "WHERE pre_id=".$pre_id." ";
		$sql .= "AND area='".$area."' ";
		$sql .= "GROUP BY row";

		$result = $GLOBALS["conn"]->query($sql);
		if (! $result ){
			trigger_error("Invalid query: ".$GLOBALS["conn"]->error);
		} else {
			return $result->num_rows ; 
		}
	}

	function insert_seats($pre_id, $num_rows, $num_cols, $area){
		
		for ($i = 1; $i <= $num_rows; $i++){
			for ($j = 1; $j <= $num_cols; $j++){
				$stmt = $GLOBALS["conn"]->prepare("INSERT INTO hoi_thao_db.Seats (pre_id, row, col, area) VALUES (?, ?, ?, ?)");
				$stmt->bind_param("iiis", $pre_id, $i, $j, $area);
				if (!$stmt->execute()) return false;
			}
		}
		return true;
	}
	
?>