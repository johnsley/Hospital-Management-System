<?php
require_once 'session.php';
include('../db/config.php'); 
    $id = $_GET['id'];

    $query = $conn->query("SELECT * FROM `payment` WHERE `id`='$id' ") or die(mysqli_error());
	$fetch = $query->fetch_array();
	$name = $fetch['name'];
	$description = $fetch['description'];
	$amount = $fetch['amount'];
	$date = $fetch['date'];
	$amount2 = -$amount;

	$sql = "INSERT INTO `payment` VALUES('', '$name', '$description', '$amount2', '$date', 'R')";
	if ($conn->query($sql) === TRUE) {
     $conn->query("UPDATE `payment` SET `reversed` = 'R' WHERE `id` = '$id' ") or die(mysqli_error());
	 echo "<script>window.location = 'payment.php'</script>";
	}	
?>