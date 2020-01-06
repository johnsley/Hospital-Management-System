<?php
require_once 'session.php';
include('../db/config.php'); 
    $id = $_GET['id'];
    $shier = $_SESSION['firstname'];
    $query = $conn->query("SELECT * FROM `service` WHERE `service_id`='$id' ") or die(mysqli_error());
	$fetch = $query->fetch_array();
	$service_id = $fetch['service_id'];
	$patient_id = $fetch['patient_id'];
	$doctor_id = $fetch['doctor_id'];
	$payment = $fetch['payment'];
	$item_id = $fetch['item_id'];
	$qty = $fetch['qty'];
	$price = $fetch['price'];
	$amount = $fetch['amount'];
	$paid = $fetch['paid'];
	$balance = $fetch['balance'];
	$date = $fetch['date'];
	$cashier = $fetch['cashier'];
	$category = $fetch['category'];

	$sql = "INSERT INTO `reversal` VALUES('', '$service_id', '$patient_id', '$doctor_id', '$payment', '$item_id', '$qty', '$price', '$amount', '$paid', '$balance', '$date', '$cashier', '$category','R')";
	if ($conn->query($sql) === TRUE) {
    	$conn->query("UPDATE `service` SET `price` = 0, `amount` = 0, `paid` = 0, `balance` = 0, `cashier` = '$shier', `reversal` = 'R' WHERE `service_id` = '$id' ") or die(mysqli_error());
		echo "<script>window.history.back();</script>";
	}
?>