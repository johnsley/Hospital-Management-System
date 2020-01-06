<?php
	include('../db/config.php'); 
	$conn->query("DELETE FROM `doctors` WHERE `doc_id` = '$_GET[id]'") or die(mysqli_error());
	header('location:doctors.php');

