<?php
	include('../db/config.php'); 
	$conn->query("DELETE FROM `item` WHERE `item_id` = '$_GET[id]'") or die(mysqli_error());
	echo "<script>window.location = 'service.php'</script>";
