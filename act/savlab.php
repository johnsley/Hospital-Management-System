<?php
require_once 'session.php';
include('../db/config.php'); 
$service_id = $_POST['service_id'];
$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$item_id = $_POST['item_id'];
$date = date('Y-m-d');
$matter = $_POST['matter'];
$result = $_POST['result'];
$limits = $_POST['limits'];
$class = $_POST['class'];
$state = $_POST['state'];
$comment = $_POST['comment'];
foreach( $matter as $key => $m ) {
	$sql = "INSERT INTO `labreps` VALUES('', '$service_id', '$patient_id', '$doctor_id', '$item_id', '$m', '$result[$key]', '$limits[$key]', '$class[$key]', '$state[$key]', '$date', '$comment')";
	if ($conn->query($sql) === TRUE) { 
	    echo "<script>window.location ='laboratory.php'</script>";
	}
}	
?>