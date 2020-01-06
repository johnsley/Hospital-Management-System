<?php
session_start();
include('db/config.php'); 
if(isset($_POST['login'])){
$username = $_POST['username'];
$password = $_POST['password'];
$query = $conn->query("SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password' ") or die(mysqli_error());
$fetch = $query->fetch_array();
$valid = $query->num_rows;
$section = $fetch['section'];	
	if($valid > 0){
	    $_SESSION['firstname'] = $fetch['firstname'];
	    $_SESSION['lastname'] = $fetch['lastname'];
		$_SESSION['user_id'] = $fetch['user_id'];
		$_SESSION['user_group'] = $fetch['user_group'];
	    echo "<script>window.location = 'act/patient.php'</script>";
	}else{
		echo "<script>alert('Account Does Not Exist!')</script>";
		echo "<script>window.location = 'index.php'</script>";
	}
}
else{
    echo "OOPS, SOMETHING IS WRONG. PLEASE CONTACT YOUR TECHNICIAN.";
}
$conn->close();
