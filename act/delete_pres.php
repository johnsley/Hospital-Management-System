<?php
	include('../db/config.php'); 
	$conn->query("DELETE FROM `prescription` WHERE `id` = '$_GET[id]'") or die(mysqli_error());
	echo "<script>window.location = 'prescription.php'</script>";
