<?php
require_once 'session.php';
include('../db/config.php'); 

$service_id = $_POST['service_id'];
$patient_id = $_POST['patient_id'];
$doctor_id = $_POST['doctor_id'];
$item_id = $_POST['item_id'];

$ccomp = $_POST['ccomp'];
$phist = $_POST['phist'];
$exam = $_POST['exam'];
$find = $_POST['find'];
$imp = $_POST['imp'];
$tmt = $_POST['tmt'];
$conc = $_POST['conc'];
$dater = date('Y-m-d');


    $query = $conn->query("SELECT * FROM `rehabreps` WHERE `service_id`='$service_id' ") or die(mysqli_error());
    $row = $query->num_rows;
	if($row > 0){
		$conn->query("UPDATE `rehabreps` SET `patient_id` = '$patient_id', `doctor_id` = '$doctor_id', `item_id` = '$item_id', `ccomp` = '$ccomp', `phist` = '$phist', `exam` = '$exam', `find` = '$find', `imp` = '$imp', `tmt` = '$tmt', `conc` = '$conc' WHERE `service_id` = '$service_id'") or die(mysqli_error());
		echo "<script>window.location ='rehabilitation.php'</script>";
	}else{

		$sql = "INSERT INTO `rehabreps` VALUES('', '$service_id', '$patient_id', '$doctor_id', '$item_id', '$ccomp', '$phist', '$exam', '$find', '$imp', '$tmt', '$conc', '$dater')";
		if ($conn->query($sql) === TRUE) { 
            echo "<script>window.location ='rehabilitation.php'</script>";
		}
	}	
?>