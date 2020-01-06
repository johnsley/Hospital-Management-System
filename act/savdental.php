<?php
require_once 'session.php';
include('../db/config.php'); 

$service_id = $_POST['service_id'];
$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$item_id = $_POST['item_id'];
$find = $_POST['find'];
$notes = $_POST['notes'];
$dater = date('Y-m-d');


    $query = $conn->query("SELECT * FROM `dentalreps` WHERE `service_id`='$service_id' ") or die(mysqli_error());
    $row = $query->num_rows;
	if($row > 0){
		$conn->query("UPDATE `dentalreps` SET `patient_id` = '$patient_id', `doctor_id` = '$doctor_id', `item_id` = '$item_id', `find` = '$find', `notes` = '$notes' WHERE `service_id` = '$service_id'") or die(mysqli_error());
		echo "<script>window.location ='dental.php'</script>";
	}else{

		$sql = "INSERT INTO `dentalreps` VALUES('', '$service_id', '$patient_id', '$doctor_id', '$item_id', '$find', '$notes', '$dater')";
		if ($conn->query($sql) === TRUE) { 
            echo "<script>window.location ='dental.php'</script>";
		}
	}	
?>