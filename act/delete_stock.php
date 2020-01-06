<?php
	include('../db/config.php'); 
	$conn->query("DELETE FROM `stock` WHERE `id` = '$_GET[id]'") or die(mysqli_error());
	echo "<script>window.location = 'stock.php'</script>";
