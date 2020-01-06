<?php 
session_start();
include('../db/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/jquery-ui.css" />
	<link rel="stylesheet" href="../css/normalize.css" />
	<script src="../js/jquery.js"></script>
	<script src="../js/jquery-ui.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	</script>
	<style>
	@media print {  
		@page {
			size:8.5in 11in;
			max-width:8.5in;
		}
      }
		#print{
			width:500px;
			height:600px;
			overflow:hidden;
			margin:auto;
			border:2px solid #000;
			padding: 10px;
		}
			table, td, th {
			border: 1px solid black;
		}
	</style>
</head> 
<body>

<button onclick="printContent('print')">Print Content</button>
<button onclick="goBack()">Back</button>
<br />
<br />
	<div id="print">
	    <div style="font-size:0.9em;padding-right:10px">
		<center>	
			<center><h3 style="margin: 5px">CHALIANA MEDICAL CENTRE</h3></center>
			<center>Bamburi Kiembeni Rd, <br>Opp Kiembeni Baptist Church</center>
			<center>P.O.Box 91279, Mombasa</center>
			<center>Tel: +254700221512</center>
			<center>Email: chalianamedicalcentre@gmail.com</center>
			<center><h4 style="margin: 5px">REPORT</h4></center>

			<?php
				$query = $conn->query("SELECT * FROM `dentalreps` WHERE `service_id`='$_GET[id]' ") or die(mysqli_error());
				$fetch = $query->fetch_array();
                $patient_id = $fetch['patient_id'];
                $doc_id = $fetch['doctor_id'];
                $item_id = $fetch['item_id'];
                $service_id = $fetch['service_id'];

                $q = $conn->query("SELECT * FROM `itr` WHERE `itr_no`='$patient_id' ") or die(mysqli_error());
				$f = $q->fetch_array();

				$d = $conn->query("SELECT * FROM `doctors` WHERE `doc_id`= '$doc_id' ") or die(mysqli_error());
				$doc = $d->fetch_array();

				$i = $conn->query("SELECT * FROM `item` WHERE `item_id`='$item_id' ") or die(mysqli_error());
				$item = $i->fetch_array();
			?>
			
		    <div style="text-align: left">Patient Name : <?php echo  $f['firstname']." ".$f['lastname']?> </div>
		    <div style="text-align: left">Patient No: <?php echo  $f['itr_no']?></div>
		    <div style="text-align: left">Gender: <?php echo  $f['gender']?></div>
		    <div style="text-align: left">Age: <?php echo  $f['age']?></div>
			<br />
			
			<center>
				<table width="100%" cellspacing="0">
				<tr>
					<td colspan="5"><br>
						<p><b>Findings: <?php echo $fetch['find']; ?></b></p>
						<p><b>Notes: <?php echo $fetch['notes']; ?></b></p>
					</td>
				</tr>
				</table>
			</center>
            <br>
			<div style="text-align: left;padding-top: 5px">Served By: 
			<?php 
			$staff = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : ''; 
			echo $staff;?>
			</div>
			<div style="text-align: left">Date : <?php echo date("Y-m-d");?></div>
			<hr>
			<div style="text-align: center"><i>Huduma Bora, Afya Bora</i></div>
			<hr>
		</center>
		</div>
	</div>
<script>
function goBack() {
    window.history.back();
}
</script>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
</html>