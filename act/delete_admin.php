<?php
	include('../db/config.php'); 
	$conn->query("DELETE FROM `admin` WHERE `admin_id` = '$_GET[id]'") or die(mysqli_error());
	echo "<script>window.location = 'admin.php'</script>";
