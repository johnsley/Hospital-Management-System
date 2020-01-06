<?php session_start()?>
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
			width:850px;
			height:1100px;
			overflow:hidden;
			margin:auto;
			border:2px solid #000;
		}
			table, td, th {
			border: 1px solid black;
		}
	</style>
</head> 
<body>

<button onclick="printContent('print')">Print Content</button>
<button onclick="goBack()">Back</button>
<?php
	include('../db/config.php'); 
	$itr_no = $_POST['p_id'];
	$q = $conn->query("SELECT * FROM `itr` WHERE `itr_no` = '$itr_no'") or die(mysqli_error());
	$c = $q->num_rows;
	$f = $q->fetch_array();
?> 

<br />
<br />
	<div id="print">
	    <div style="font-size:0.6em;padding:10px;border: 1px solid #000;">
		<center>	
			<center><h3 style="margin: 5px">CHALIANA MEDICAL CENTRE</h3></center>
			<center>Bamburi Kiembeni Rd, <br>Opp Kiembeni Baptist Church</center>
			<center>P.O.Box 91279, Mombasa</center>
			<center>Tel: +254700221512</center>
			<center>Email: chalianamedicalcentre@gmail.com</center>
			<center><h4 style="margin: 5px">RECEIPT</h4></center>
			<div style="text-align: left">Recepit No : 
			<?php
				include('../db/config.php'); 
				$r = $conn->query("SELECT * FROM `receipt`") or die(mysqli_error());
				$rr = $r->fetch_array();
				echo $rr['number'];
				$newnumber = $rr['number'] + 1;
				$conn->query("UPDATE `receipt` SET `number`='$newnumber' ") or die(mysqli_error());
			?> 
		    </div>
		    <div style="text-align: left">Patient Name : <?php echo  $f['firstname']." ".$f['lastname']?> </div>
		    <div style="text-align: left">Patient No: <?php echo  $f['itr_no']?></div>
			<br />
			
			<center>
				<table width="100%" cellspacing="0">
						<tr>
							<th><center>Description</center></th>
							<th><center>Qty</center></th>
							<th><center>Amount</center></th>
							
							
						</tr>
				<?php
				include('../db/config.php'); 
				if(isset($_POST['selector'])){
				    $listid = $_POST['selector'];
					$key = COUNT($listid);
					$total = 0;
					$paid = 0;
					$bal = 0;
					for($i=0;$i<$key;$i++){

						$q = $conn->query("SELECT * FROM `service` WHERE `service_id` = '$listid[$i]' ") or die(mysqli_error());
						while($f = $q->fetch_array()){
						$item_id = $f['item_id'];
					    $t1 = $conn->query("SELECT * FROM `item` WHERE `item_id`='$item_id' ") or die(mysqli_error());
					    $t11 = $t1->fetch_array();

					    $total += $f['amount']; 
					    $paid += $f['paid'];
					    $bal += $f['balance'];

                        echo "<tr>";
                        echo "<td><center>".$t11['name']."</center></td>";
                        echo "<td><center>".$f['qty']."</center></td>";
                        echo "<td><center>".$f['amount']."</center></td>";
                      
                       
                        echo "</tr>";
					  }
				     }
					}
					$conn->close();
				?>
				<tr>
					<td colspan="5"><br>
						<center><b>Total: <?php echo "KES ". $total;?></b></center>
						<center><b>Paid: <?php echo "KES ". $paid;?></b></center>
						<center><hr style="border: 1px dotted"></center>
						<center><b>Balance: <?php echo "KES ".$bal;?></b></center>
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