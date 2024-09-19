<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function delete_img(){
		extract($_POST);
		if(is_file($path)){
			if(unlink($path)){
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['error'] = 'failed to delete '.$path;
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = 'Unkown '.$path.' path';
		}
		return json_encode($resp);
	}
	function save_team(){
		$_POST['members'] = addslashes(htmlspecialchars($_POST['members']));
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `team_list` where `code` = '{$code}' and delete_flag = 0 ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Team Code already exists.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `team_list` set {$data} ";
		}else{
			$sql = "UPDATE `team_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$aid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['aid'] = $aid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Team successfully saved.";
			else
				$resp['msg'] = " Team successfully updated.";
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_team(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `team_list` set `delete_flag` = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Team successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}

	function save_request() {
		// Sanitize input
		if (isset($_POST['message'])) {
			$_POST['message'] = addslashes(htmlspecialchars($_POST['message']));
		}
	
		// Generate a unique code if id is empty
		if (empty($_POST['id'])) {
			$datePrefix = date("Ymd");  // Use the current date in YYYYMMDD format
			$sequenceNumber = 1;       // Start with an initial sequence number
	
			while (true) {
				// Generate a candidate code using a sequence number
				$candidateCode = sprintf("%s-%04d", $datePrefix, $sequenceNumber);
				
				// Check if the candidate code already exists in the database
				$check = $this->conn->query("SELECT id FROM `request_list` WHERE `code` = '{$candidateCode}'")->num_rows;
				
				if ($check > 0) {
					// If the code exists, increment the sequence number and try again
					$sequenceNumber++;
				} else {
					// If the code does not exist, set it and break the loop
					$_POST['code'] = $candidateCode;
					break;
				}
			}
		}
	
		// Handle file upload
		$image_path = null;
		if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
			$fileTmpPath = $_FILES['image']['tmp_name'];
			$fileName = $_FILES['image']['name'];
			$fileSize = $_FILES['image']['size'];
			$fileType = $_FILES['image']['type'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));
	
			$allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
			if (in_array($fileExtension, $allowedfileExtensions)) {
				$uploadFileDir = '../uploads/';
				if (!is_dir($uploadFileDir)) {
					mkdir($uploadFileDir, 0777, true);
				}
				$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
				$dest_path = $uploadFileDir . $newFileName;
	
				if (move_uploaded_file($fileTmpPath, $dest_path)) {
					$_POST['image'] = $dest_path;
				} else {
					$resp['status'] = 'failed';
					$resp['err'] = 'Failed to move uploaded file.';
					return json_encode($resp);
				}
			} else {
				$resp['status'] = 'failed';
				$resp['err'] = 'Invalid file extension.';
				return json_encode($resp);
			}
		}
	
		// Prepare data for insertion or update
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			// Exclude the 'id' and 'location' fields
			if (!in_array($k, array('id', 'location'))) {
				if (!empty($data)) $data .= ",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
	
		// Insert or update data in the database
		if (empty($id)) {
			$sql = "INSERT INTO `request_list` SET {$data}";
		} else {
			$sql = "UPDATE `request_list` SET {$data} WHERE id = '{$id}'";
		}
	
		$save = $this->conn->query($sql);
		if ($save) {
			$tid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['tid'] = $tid;
			$resp['status'] = 'success';
			if (empty($id)) {
				$this->settings->set_flashdata('request_sent', $code);
			} else {
				$resp['msg'] = "Request successfully updated.";
				$this->settings->set_flashdata('success', "Request has been updated successfully.");
			}
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error . "[{$sql}]";
		}
	
		return json_encode($resp);
	}

	function delete_request(){
		extract($_POST);
		
		// Mark the request as deleted by setting the 'deleted_reports' column
		$del = $this->conn->query("UPDATE `request_list` SET `deleted_reports` = NOW() WHERE id = '{$id}'");
		
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Request successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		
		return json_encode($resp);
	}
	
	function request_restore(){
		extract($_POST);
	
		// Restore the request by setting 'deleted_reports' to NULL
		$restore = $this->conn->query("UPDATE `request_list` SET `deleted_reports` = NULL WHERE id = '{$id}'");
		
		if($restore){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Request successfully restored.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		
		return json_encode($resp);
	}
	
	function assign_team(){
		extract($_POST);
		$update = $this->conn->query("UPDATE `request_list` set `status`  = 1, team_id = '{$team_id}' where id = '{$id}'");
		if($update){
			$history = $this->conn->query("INSERT INTO `history_list` set `request_id` ='{$id}', `status` = 1, `remarks` = 'Request has been assign to a fire control team.' ");
			if($history){
				$this->settings->set_flashdata("success", 'Request has been assign to a team.');
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = $this->conn->error;
			}
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function take_action(){
		extract($_POST);
		$remarks = addslashes(htmlspecialchars($remarks));
		$update = $this->conn->query("UPDATE `request_list` set `status`  = {$status} where id = '{$id}'");
		if($update){
			$history = $this->conn->query("INSERT INTO `history_list` set `request_id` ='{$id}', `status` = {$status}, `remarks` = '{$remarks}' ");
			if($history){
				$this->settings->set_flashdata("success", 'Request\'s Status has been updated successfully.');
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = $this->conn->error;
			}
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_inquiry(){
		$_POST['message'] = addslashes(htmlspecialchars($_POST['message']));
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string($v);
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `inquiry_list` set {$data} ";
		}else{
			$sql = "UPDATE `inquiry_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$cid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success'," Your Inquiry has been sent successfully. Thank you!");
			else
				$this->settings->set_flashdata('success'," Inquiry successfully updated");
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_inquiry(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `inquiry_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Inquiry has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'delete_img':
		echo $Master->delete_img();
	break;
	case 'save_team':
		echo $Master->save_team();
	break;
	case 'delete_team':
		echo $Master->delete_team();
	break;
	case 'save_request':
		echo $Master->save_request();
	break;
	case 'delete_request':
		echo $Master->delete_request();
	break;
	case 'assign_team':
		echo $Master->assign_team();
	break;
	case 'take_action':
		echo $Master->take_action();
	break;
	case 'save_inquiry':
		echo $Master->save_inquiry();
	break;
	case 'delete_inquiry':
		echo $Master->delete_inquiry();
	break;
	default:
		// echo $sysset->index();
		break;
}