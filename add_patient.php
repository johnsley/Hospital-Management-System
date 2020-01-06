<?php
    include('db/config.php');
    date_default_timezone_set('Europe/Berlin'); 
	if(ISSET($_POST['save_patient'])){
		$date = date("Y-m-d h:i:sa", time() + 7200);
		$itr_no = "";
		$family_no = "";
		$firstname = $_POST['firstname'];
		$middlename = "";
		$lastname = $_POST['lastname'];
		$birthdate = "";
		$age = $_POST['age'];
		$phil_health_no = "";
		$address = $_POST['address'];
		$civil_status = "";
		$gender = $_POST['gender'];
		$email =  ""; 
		$phone = $_POST['phone'];
		$nhif = $_POST['nhif'];
		$q1 = $conn->query("SELECT * FROM `itr` WHERE `itr_no` = '$itr_no'") or die(mysqli_error());
		$c1 = $q1->num_rows;
		if($c1 > 0){
			echo "<script>alert('ITR No. must not be the same!')</script>";
		}else{
			$conn->query("INSERT INTO `itr` VALUES('$itr_no', '$family_no', '$phil_health_no', '$firstname', '$middlename', '$lastname', '$birthdate', '$age', '$address', '$civil_status', '$gender', '$email', '$phone', '', '', '', '', '', '', '$date', '$nhif')") or die(mysqli_error());
			echo "<script>window.location = 'patient.php'</script>";	
		}
	}

	if(ISSET($_POST['save_checkup'])){
		$itr_no = $_POST['id'];
		$lastname = $_POST['lastname'];
		$bp = $_POST['bp'];
		$temp = $_POST['temp']."&deg;C";
		$pr = $_POST['pr'];
		$rr = $_POST['rr'];
		$wt= $_POST['wt']."kg";
		$ht = $_POST['ht'];
		$conn->query("UPDATE `itr` SET BP='$bp', TEMP='$temp', PR='$pr', RR='$rr', WT='$wt', HT='$ht' WHERE `itr_no` = '$itr_no'") or die(mysqli_error());
		echo "<script>window.location = 'patient_detail.php?id=".$itr_no."&lastname=".$lastname."'</script>";	
	}

	if(ISSET($_POST['save_charges'])){
		$patient_id = $_POST['patient'];
		$doc_id = $_POST['doc'];
		$payment = $_POST['payment'];
		$item_id = $_POST['item'];
		$qty = $_POST['qty'];
		$price = $_POST['price'];
		$amount = $_POST['amount'];
		$paid = $_POST['paid'];
		$balance = $paid - $amount;
		$date = date("Y-m-d h:i:sa", time() + 7200);
		$cashier = $_POST['cashier'];
		$category = $_POST['category'];
	    $conn->query("INSERT INTO `service` VALUES('', '$patient_id', '$doc_id', '$payment', '$item_id', '$qty', '$price', '$amount', '$paid', '$balance', '$date', '$cashier', '$category','')") or die(mysqli_error());

        if(!empty($_POST['item2']) && !empty($_POST['qty2']) && !empty($_POST['price2']) && !empty($_POST['amount2']) && !empty($_POST['paid2']))
        {
        $item_id2 = $_POST['item2'];
		$qty2 = $_POST['qty2'];
		$price2 = $_POST['price2'];
		$amount2 = $_POST['amount2'];
		$paid2 = $_POST['paid2'];
		$balance2 = $paid2 - $amount2;
		$conn->query("INSERT INTO `service` VALUES('', '$patient_id', '$doc_id', '$payment', '$item_id2', '$qty2', '$price2', '$amount2', '$paid2', '$balance2', '$date', '$cashier', '$category')") or die(mysqli_error());
        }

        if(!empty($_POST['item3']) && !empty($_POST['qty3']) && !empty($_POST['price3']) && !empty($_POST['amount3']) && !empty($_POST['paid3']))
        {
        $item_id3 = $_POST['item3'];
		$qty3 = $_POST['qty3'];
		$price3 = $_POST['price3'];
		$amount3 = $_POST['amount3'];
		$paid3 = $_POST['paid3'];
		$balance3 = $paid3 - $amount3;
		$conn->query("INSERT INTO `service` VALUES('', '$patient_id', '$doc_id', '$payment', '$item_id3', '$qty3', '$price3', '$amount3', '$paid3', '$balance3', '$date', '$cashier', '$category')") or die(mysqli_error());
        }
        
		echo "<script>alert('Success!')</script>";	
	}

	if(ISSET($_POST['save_service_item'])){
		$name = $_POST['name'];
		$price = $_POST['price'];
		$type = $_POST['type'];
	    $conn->query("INSERT INTO `item` VALUES('', '$name', '$price', '$type')") or die(mysqli_error());
		echo "<script>alert('Item successfully added!')</script>";
		echo "<script>window.location = 'service.php'</script>";	
	}

	if(ISSET($_POST['save_medicine'])){
		$date = date("Y-m-d h:i:sa", time() + 7200);
		$item = $_POST['item'];
		$bp = $_POST['bp'];
		$sp = $_POST['sp'];
		$gty = $_POST['gty'];
        $conn->query("INSERT INTO `stock` VALUES('', '$date', '$item', '$bp', '$sp', '$gty', 0, '$gty')") or die(mysqli_error());
		    echo "<script>window.location = 'stock.php'</script>";	
		}

	if(ISSET($_POST['save_prescription'])){
		$date = date("Y-m-d h:i:sa", time() + 7200);
		$med_id = $_POST["med_id"];
		$patient_id = $_POST['patient_id'];
		$doc_id = $_POST['doc_id'];
        $query = $conn->query("SELECT `status` FROM `stock` WHERE `item_id` = '$med_id' ");
        $f = $query->fetch_array();
        $newstatus = $f['status'] - 1;
        $conn->query("UPDATE `stock` SET `status` = '$newstatus' WHERE `item_id` = '$med_id' ") or die(mysqli_error());
		$conn->query("INSERT INTO `prescription` VALUES('', '$med_id', '$patient_id', '$doc_id', '$date')") or die(mysqli_error());
		echo "<script>window.location = 'prescription.php'</script>";	
	}

	if(ISSET($_POST['save_outpatient'])){
		$date = date("Y-m-d h:i:sa", time() + 7200);
		$patient = $_POST["patient"];
		$phone = $_POST["phone"];
		$service = $_POST['service'];
		$category = $_POST['category'];
		$price = $_POST['price'];
		$payment = $_POST['payment'];
        $sql = "INSERT INTO `outpatient` VALUES('', '$patient', '$phone', '$service', '$price', '$date', '$payment', '$category')";
		if ($conn->query($sql) === TRUE) {
        	echo "<script>window.location = 'outpatient.php'</script>";
		}	
	}

	if(ISSET($_POST['save_payment'])){
		$date = $_POST["date"];;
		$name = $_POST["payee"];
		$desc= $_POST['desc'];
		$amount = $_POST['amount'];
        $conn->query("INSERT INTO `payment` VALUES('', '$name', '$desc', '$amount', '$date','')") or die(mysqli_error());
		echo "<script>window.location = 'payment.php'</script>";
	}
	