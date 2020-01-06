<?php
	include('../db/config.php'); 
	$conn->query("DELETE FROM `user` WHERE `user_id` = '$_GET[id]' && `lastname` = '$_GET[lastname]'") or die(mysqli_error());
	echo "<script>window.location = 'user.php'</script>";

