<?php
require_once 'session.php';
include('../db/config.php'); 

$service_id = $_POST['service_id'];
$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$item_id = $_POST['item_id'];
$exam = $_POST['exam'];
$summ = $_POST['summ'];
$find = $_POST['find'];
$conc = $_POST['conc'];
$dater = date('Y-m-d');


    $query = $conn->query("SELECT * FROM `radioreps` WHERE `service_id`='$service_id' ") or die(mysqli_error());
    $row = $query->num_rows;
	if($row > 0){
		$conn->query("UPDATE `radioreps` SET `patient_id` = '$patient_id', `doctor_id` = '$doctor_id', `item_id` = '$item_id', `exam` = '$exam', `summ` = '$summ', `find` = '$find', `conc` = '$conc' WHERE `service_id` = '$service_id'") or die(mysqli_error());
		echo "<script>window.location ='xray.php'</script>";
	}else{

		$sql = "INSERT INTO `radioreps` VALUES('', '$service_id', '$patient_id', '$doctor_id', '$item_id', '$exam', '$summ', '$find', '$conc', '$dater')";
		if ($conn->query($sql) === TRUE) { 
            echo "<script>window.location ='xray.php'</script>";
		}
	}	
?>