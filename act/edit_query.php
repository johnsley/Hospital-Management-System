<?php
    include('../db/config.php'); 
	$id = ISSET($_GET['id']) ? $_GET['id'] : null;
	$last = ISSET($_GET['lastname']) ? $_GET['lastname'] : null;
	if(ISSET($_POST['edit_patient'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$phone = $_POST['phone'];
		$age = $_POST['age'];
		$address = $_POST['address'];
		$gender = $_POST['gender'];
		$conn->query("UPDATE `itr` SET `firstname` = '$firstname', `lastname` = '$lastname', `age` = '$age', `address` = '$address', `gender` = '$gender', `phone` = '$phone' WHERE `itr_no` = '$id' && `lastname` = '$last'") or die(mysqli_error());
		echo "<script>window.location = 'patient.php'</script>";
	}
	if(ISSET($_POST['edit_admin'])){
			$username = $_POST['username'];
			$password = $_POST['password'];
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$conn->query("UPDATE `admin` SET `username` = '$username', `password` = '$password', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname' WHERE `admin_id` = '$id'") or die(mysqli_error());
			header('location:admin.php');
			// echo "<script>window.location = 'admin.php'</script>";
		}
	if(ISSET($_POST['edit_user'])){
		    $id = $_POST['id'];
			$username = $_POST['username'];
			$password = $_POST['password'];
			$firstname = $_POST['firstname'];
			$middlename = $_POST['middlename'];
			$lastname = $_POST['lastname'];
			$section = $_POST['section'];
			$conn->query("UPDATE `user` SET `username` = '$username', `password` = '$password', `firstname` = '$firstname', `middlename` = '$middlename', `lastname` = '$lastname', `user_group` = '$section' WHERE `user_id` = '$id'") or die(mysqli_error());
			// header('location:user.php');
			echo "<script>window.location = 'user.php'</script>";
		}	

	if(ISSET($_POST['edit_appointment'])){
		    $id = $_POST['id']; 
		    $ap_date = $_POST['dat']; 
		    $doc_id = $_POST['doc']; 
		    $patient_id = $_POST['patient']; 
			$conn->query("UPDATE `appointment` SET `appointment_timestamp` = '$ap_date', `doc_id` = '$doc_id', `patient_id` = '$patient_id' WHERE `appointment_id` = '$id'") or die(mysqli_error());
			header('location:appointment.php');
			// echo "<script>window.location = ''</script>";
		}	

		if(ISSET($_POST['edit_service_item'])){
			$id = $_POST['item_id'];
		    $name = $_POST['name']; 
		    $price = $_POST['price']; 
		    $type = $_POST['type']; 
		    
			$conn->query("UPDATE `item` SET `name` = '$name', `price` = '$price', `type` = '$type' WHERE `item_id` = '$id'") or die(mysqli_error());
			echo "<script>alert('Item updated success!')</script>";
			echo "<script>window.location = 'service.php'</script>";
		}	

		if(ISSET($_POST['edit_consultation'])){

            $id = $_POST['service_id'];
            $old_id = $_POST['old_service_id'];

            $query = $conn->query("SELECT * FROM `service` WHERE `service_id`='$old_id' ") or die(mysqli_error());
			$fetch = $query->fetch_array();
			$service_id = $fetch['service_id'];
			$patient_id = $fetch['patient_id'];
			$doctor_id = $fetch['doctor_id'];
			$payment = $fetch['payment'];
			$item_id = $fetch['item_id'];
			$qty = $fetch['qty'];
			$price = $fetch['price'];
			$amount = $fetch['amount'];
			$paid = $fetch['paid'];
			$balance = $fetch['balance'];
			$date = $fetch['date'];
			$cashier = $fetch['cashier'];
			$category = $fetch['category'];

			$sql = "INSERT INTO `service_backup` VALUES('', '$id', '$patient_id', '$doctor_id', '$payment', '$item_id', '$qty', '$price', '$amount', '$paid', '$balance', '$date', '$cashier', '$category')";
			if ($conn->query($sql) === TRUE) {
	        	$patient_id = $_POST['patient'];
				$doc_id = $_POST['doc'];
				$payment = $_POST['payment'];
				$item_id = $_POST['item'];
				$qty = $_POST['qty'];
				$price = $_POST['price'];
				$amount = $_POST['amount'];
				$paid = $_POST['paid'];
				$balance = $paid - $amount;
				$date = date("Y-m-d h:i:sa");
				$cashier = $_POST['cashier'];
				$conn->query("UPDATE `service` SET `patient_id` = '$patient_id', `doctor_id` = '$doc_id', `payment` = '$payment', `item_id` = '$item_id', `qty` = '$qty', `price` = '$price', `amount` = '$amount', `paid` = '$paid', `balance` = '$balance', `date` = '$date', `cashier` = '$cashier' WHERE `service_id` = '$id'") or die(mysqli_error());
				echo "<script>window.location ='consultation.php'</script>";
			}	

			
		}	

		if(ISSET($_POST['edit_save_medicine'])){
			$id = $_POST['item_id'];
			$date = date("Y-m-d h:i:sa");
            $item = $_POST['item'];
            $bp = $_POST['bp'];
			$sp = $_POST['sp'];
			$gty = $_POST['gty'];
			$used = $_POST['used'];
			$rem = $_POST['rem'];
			$conn->query("UPDATE `stock` SET `date` = '$date', `item` = '$item', `bp` = '$bp', `sp` = '$sp', `quantity` = '$gty', `used` = '$used', `rem` = '$rem' WHERE `id` = '$id' ") or die(mysqli_error());
	        echo "<script>window.location ='stock.php'</script>";	
		}

		if(ISSET($_POST['edit_save_prescription'])){
			$id = $_POST['presid'];
			$date = date("Y-m-d h:i:sa");
		    $med_id = $_POST["med_id"];
		    $patient_id = $_POST['patient_id'];
		    $doc_id = $_POST['doc_id'];
			$conn->query("UPDATE `prescription` SET `med_id` = '$med_id', `patient_id` = '$patient_id', `doctor_id` = '$doc_id', `date` = '$date' WHERE `id` = '$id' ") or die(mysqli_error());
			echo "<script>window.location ='prescription.php'</script>";
		}	

		if(ISSET($_POST['edit_xray'])){

            $id = $_POST['service_id'];
            $old_id = $_POST['old_service_id'];
            $query = $conn->query("SELECT * FROM `service` WHERE `service_id`='$old_id' ") or die(mysqli_error());
			$fetch = $query->fetch_array();
			$service_id = $fetch['service_id'];
			$patient_id = $fetch['patient_id'];
			$doctor_id = $fetch['doctor_id'];
			$payment = $fetch['payment'];
			$item_id = $fetch['item_id'];
			$qty = $fetch['qty'];
			$price = $fetch['price'];
			$amount = $fetch['amount'];
			$paid = $fetch['paid'];
			$balance = $fetch['balance'];
			$date = $fetch['date'];
			$cashier = $fetch['cashier'];
			$category = $fetch['category'];

			$sql = "INSERT INTO `service_backup` VALUES('', '$id', '$patient_id', '$doctor_id', '$payment', '$item_id', '$qty', '$price', '$amount', '$paid', '$balance', '$date', '$cashier', '$category')";
			if ($conn->query($sql) === TRUE) {
				$patient_id = $_POST['patient'];
				$doc_id = $_POST['doc'];
				$payment = $_POST['payment'];
				$item_id = $_POST['item'];
				$qty = $_POST['qty'];
				$price = $_POST['price'];
				$amount = $_POST['amount'];
				$paid = $_POST['paid'];
				$balance = $paid - $amount;
				$date = date("Y-m-d h:i:sa");
				$cashier = $_POST['cashier'];
				$conn->query("UPDATE `service` SET `patient_id` = '$patient_id', `doctor_id` = '$doc_id', `payment` = '$payment', `item_id` = '$item_id', `qty` = '$qty', `price` = '$price', `amount` = '$amount', `paid` = '$paid', `balance` = '$balance', `date` = '$date', `cashier` = '$cashier' WHERE `service_id` = '$id'") or die(mysqli_error());
				echo "<script>window.location ='xray.php'</script>";
			}
		}	

		if(ISSET($_POST['edit_pharmacy'])){
            $id = $_POST['service_id'];
            $old_id = $_POST['old_service_id'];
            $query = $conn->query("SELECT * FROM `service` WHERE `service_id`='$old_id' ") or die(mysqli_error());
			$fetch = $query->fetch_array();
			$service_id = $fetch['service_id'];
			$patient_id = $fetch['patient_id'];
			$doctor_id = $fetch['doctor_id'];
			$payment = $fetch['payment'];
			$item_id = $fetch['item_id'];
			$qty = $fetch['qty'];
			$price = $fetch['price'];
			$amount = $fetch['amount'];
			$paid = $fetch['paid'];
			$balance = $fetch['balance'];
			$date = $fetch['date'];
			$cashier = $fetch['cashier'];
			$category = $fetch['category'];

			$sql = "INSERT INTO `service_backup` VALUES('', '$id', '$patient_id', '$doctor_id', '$payment', '$item_id', '$qty', '$price', '$amount', '$paid', '$balance', '$date', '$cashier', '$category')";
			if ($conn->query($sql) === TRUE) {
				$patient_id = $_POST['patient'];
				$doc_id = $_POST['doc'];
				$payment = $_POST['payment'];
				$item_id = $_POST['item'];
				$qty = $_POST['qty'];
				$price = $_POST['price'];
				$amount = $_POST['amount'];
				$paid = $_POST['paid'];
				$balance = $paid - $amount;
				$date = date("Y-m-d h:i:sa");
				$cashier = $_POST['cashier'];
				$conn->query("UPDATE `service` SET `patient_id` = '$patient_id', `doctor_id` = '$doc_id', `payment` = '$payment', `item_id` = '$item_id', `qty` = '$qty', `price` = '$price', `amount` = '$amount', `paid` = '$paid', `balance` = '$balance', `date` = '$date', `cashier` = '$cashier' WHERE `service_id` = '$id'") or die(mysqli_error());
				echo "<script>window.location ='pharmacy_charges.php'</script>";
			}	
		}	

		if(ISSET($_POST['edit_physiotherapy'])){
            $id = $_POST['service_id'];
            $old_id = $_POST['old_service_id'];
            $query = $conn->query("SELECT * FROM `service` WHERE `service_id`='$old_id' ") or die(mysqli_error());
			$fetch = $query->fetch_array();
			$service_id = $fetch['service_id'];
			$patient_id = $fetch['patient_id'];
			$doctor_id = $fetch['doctor_id'];
			$payment = $fetch['payment'];
			$item_id = $fetch['item_id'];
			$qty = $fetch['qty'];
			$price = $fetch['price'];
			$amount = $fetch['amount'];
			$paid = $fetch['paid'];
			$balance = $fetch['balance'];
			$date = $fetch['date'];
			$cashier = $fetch['cashier'];
			$category = $fetch['category'];

			$sql = "INSERT INTO `service_backup` VALUES('', '$id', '$patient_id', '$doctor_id', '$payment', '$item_id', '$qty', '$price', '$amount', '$paid', '$balance', '$date', '$cashier', '$category')";
			if ($conn->query($sql) === TRUE) {
				$patient_id = $_POST['patient'];
				$doc_id = $_POST['doc'];
				$payment = $_POST['payment'];
				$item_id = $_POST['item'];
				$qty = $_POST['qty'];
				$price = $_POST['price'];
				$amount = $_POST['amount'];
				$paid = $_POST['paid'];
				$balance = $paid - $amount;
				$date = date("Y-m-d h:i:sa");
				$cashier = $_POST['cashier'];
				$conn->query("UPDATE `service` SET `patient_id` = '$patient_id', `doctor_id` = '$doc_id', `payment` = '$payment', `item_id` = '$item_id', `qty` = '$qty', `price` = '$price', `amount` = '$amount', `paid` = '$paid', `balance` = '$balance', `date` = '$date', `cashier` = '$cashier' WHERE `service_id` = '$id'") or die(mysqli_error());
				echo "<script>window.location ='rehabilitation.php'</script>";
			}	
		}	

		if(ISSET($_POST['edit_mat'])){
            $id = $_POST['service_id'];
            $old_id = $_POST['old_service_id'];
            $query = $conn->query("SELECT * FROM `service` WHERE `service_id`='$old_id' ") or die(mysqli_error());
			$fetch = $query->fetch_array();
			$service_id = $fetch['service_id'];
			$patient_id = $fetch['patient_id'];
			$doctor_id = $fetch['doctor_id'];
			$payment = $fetch['payment'];
			$item_id = $fetch['item_id'];
			$qty = $fetch['qty'];
			$price = $fetch['price'];
			$amount = $fetch['amount'];
			$paid = $fetch['paid'];
			$balance = $fetch['balance'];
			$date = $fetch['date'];
			$cashier = $fetch['cashier'];
			$category = $fetch['category'];

			$sql = "INSERT INTO `service_backup` VALUES('', '$id', '$patient_id', '$doctor_id', '$payment', '$item_id', '$qty', '$price', '$amount', '$paid', '$balance', '$date', '$cashier', '$category')";
			if ($conn->query($sql) === TRUE) {
				$patient_id = $_POST['patient'];
				$doc_id = $_POST['doc'];
				$payment = $_POST['payment'];
				$item_id = $_POST['item'];
				$qty = $_POST['qty'];
				$price = $_POST['price'];
				$amount = $_POST['amount'];
				$paid = $_POST['paid'];
				$balance = $paid - $amount;
				$date = date("Y-m-d h:i:sa");
				$cashier = $_POST['cashier'];
				$conn->query("UPDATE `service` SET `patient_id` = '$patient_id', `doctor_id` = '$doc_id', `payment` = '$payment', `item_id` = '$item_id', `qty` = '$qty', `price` = '$price', `amount` = '$amount', `paid` = '$paid', `balance` = '$balance', `date` = '$date', `cashier` = '$cashier' WHERE `service_id` = '$id'") or die(mysqli_error());
				echo "<script>window.location ='maternity.php'</script>";	
			}
		}


		if(ISSET($_POST['edit_laboratory'])){
            $id = $_POST['service_id'];
            $old_id = $_POST['old_service_id'];
            $query = $conn->query("SELECT * FROM `service` WHERE `service_id`='$old_id' ") or die(mysqli_error());
			$fetch = $query->fetch_array();
			$service_id = $fetch['service_id'];
			$patient_id = $fetch['patient_id'];
			$doctor_id = $fetch['doctor_id'];
			$payment = $fetch['payment'];
			$item_id = $fetch['item_id'];
			$qty = $fetch['qty'];
			$price = $fetch['price'];
			$amount = $fetch['amount'];
			$paid = $fetch['paid'];
			$balance = $fetch['balance'];
			$date = $fetch['date'];
			$cashier = $fetch['cashier'];
			$category = $fetch['category'];

			$sql = "INSERT INTO `service_backup` VALUES('', '$id', '$patient_id', '$doctor_id', '$payment', '$item_id', '$qty', '$price', '$amount', '$paid', '$balance', '$date', '$cashier', '$category')";
			if ($conn->query($sql) === TRUE) {
				$patient_id = $_POST['patient'];
				$doc_id = $_POST['doc'];
				$payment = $_POST['payment'];
				$item_id = $_POST['item'];
				$qty = $_POST['qty'];
				$price = $_POST['price'];
				$amount = $_POST['amount'];
				$paid = $_POST['paid'];
				$balance = $paid - $amount;
				$date = date("Y-m-d h:i:sa");
				$cashier = $_POST['cashier'];
				$conn->query("UPDATE `service` SET `patient_id` = '$patient_id', `doctor_id` = '$doc_id', `payment` = '$payment', `item_id` = '$item_id', `qty` = '$qty', `price` = '$price', `amount` = '$amount', `paid` = '$paid', `balance` = '$balance', `date` = '$date', `cashier` = '$cashier' WHERE `service_id` = '$id'") or die(mysqli_error());
				echo "<script>window.location ='laboratory.php'</script>";
			}	
		}
		if(ISSET($_POST['edit_outpatient'])){
		    $id = $_POST['id']; 
		    $name = $_POST['name']; 
		    $service = $_POST['service']; 
		    $price = $_POST['price']; 
		    $payment = $_POST['payment'];
			$conn->query("UPDATE `outpatient` SET `name` = '$name', `service` = '$service', `price` = '$price', `payment` = '$payment'  WHERE `id` = '$id'") or die(mysqli_error());
			echo "<script>window.location ='outpatient.php'</script>";
		}	




