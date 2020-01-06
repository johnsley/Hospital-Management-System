<?php
	include('../db/config.php'); 
	$conn->query("DELETE FROM `appointment` WHERE `appointment_id` = '$_GET[id]'") or die(mysqli_error());
	header('location:appointment.php');

