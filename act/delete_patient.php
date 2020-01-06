<?php
	include('../db/config.php'); 
	
	$id = $_GET['id'];

    $query = $conn->query("SELECT * FROM `itr` WHERE `itr_no` = '$id' ") or die(mysqli_error());
	while($fetch = $query->fetch_array()){
        $date = date("Y-m-d h:i:sa");
		$itr_no = $id;
		$firstname = $fetch['firstname'];
		$lastname = $fetch['lastname'];
		$age = $fetch['age'];
		$address = $fetch['address'];
		$gender = $fetch['gender'];
		$phone = $fetch['phone']; 

		$conn->query("INSERT INTO `itrbackup` VALUES('','$itr_no', '$firstname', '$lastname', '$age', '$address', '$gender', '$phone', '$date')") or die(mysqli_error());	
	}

	$conn->query("DELETE FROM `itr` WHERE `itr_no` = '$id'") or die(mysqli_error());
	echo "<script>window.location = 'patient.php'</script>";
