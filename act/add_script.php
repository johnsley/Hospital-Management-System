<?php
    include('../db/config.php'); 
	if(ISSET($_POST['save_doctor'])){	
		$docno = ""; 
		$spec = ""; 
		$name = $_POST['firstname']." ".$_POST['lastname']; 
		$dep = ""; 
		$phone = $_POST['phone']; 
		$as = "user"; 
		$conn->query("INSERT INTO `doctors` VALUES('', '$spec', '$name', '$dep', '$phone', '$as', '$docno')");
	}
	if(ISSET($_POST['save_appointment'])){	
		$ap_date = $_POST['dat']; 
		$doc_id = $_POST['doc']; 
		$patient_id = $_POST['patient']; 
		$conn->query("INSERT INTO `appointment` VALUES('', '$ap_date', '$doc_id', '$patient_id')");
	}
		
		
