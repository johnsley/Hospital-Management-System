<?php
require_once 'session.php';
include('../db/config.php'); 

$service_id = $_POST['service_id'];
$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$item_id = $_POST['item_id'];
$tempr = $_POST['tempr'];
$tptime = $_POST['tptime'];
$pr = $_POST['pr'];
$prtime = $_POST['prtime'];
$bp = $_POST['bp'];
$bptime = $_POST['bptime'];
$inves = $_POST['inves'];
$icdc = $_POST['icdc'];
$clinicalf = $_POST['clinicalf'];
$diag = $_POST['diag'];
$dater = date('Y-m-d');


    $query = $conn->query("SELECT * FROM `triage` WHERE `service_id`='$service_id' ") or die(mysqli_error());
    $row = $query->num_rows;
	if($row > 0){
		$conn->query("UPDATE `triage` SET `patient_id` = '$patient_id', `doctor_id` = '$doctor_id', `item_id` = '$item_id', `tempr` = '$tempr', `tptime` = '$tptime', `pr` = '$pr', `prtime` = '$prtime', `bp` = '$bp', `bptime` = '$bptime', `inves` = '$inves', `icdc` = '$icdc', `clincfind` = '$clinicalf', `diog` = '$diag' WHERE `service_id` = '$service_id'") or die(mysqli_error());
		echo "<script>window.location ='consultation.php'</script>";
	}else{

		$sql = "INSERT INTO `triage` VALUES('', '$service_id', '$patient_id', '$doctor_id', '$item_id', '$tempr', '$tptime', '$pr', '$prtime', '$bp', '$bptime', '$inves', '$icdc', '$clinicalf', '$diag', '$dater')";
		if ($conn->query($sql) === TRUE) { 
            echo "<script>window.location ='consultation.php'</script>";
		}
	}	
?>