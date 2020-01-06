<?php session_start()?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<script src="js/jquery.js"></script>
	<script src="js/jquery-ui.js"></script>
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
<a href="outpatient.php"><button>Back</button></a>
<?php
	include('../db/config.php'); 
	$q = $conn->query("SELECT * FROM `outpatient` WHERE `id` = '$_GET[id]' ") or die(mysqli_error());
	$f = $q->fetch_array();
?> 
<br />
<br />
	<div id="print">
	    <div style="font-size:0.6em;padding-right:10px">
		<center>	
			<center><h3 style="margin: 5px">CHALIANA MEDICAL CENTRE</h3></center>
			<center>Bamburi Kiembeni Rd, <br>Opp Kiembeni Baptist Church</center>
			<center>P.O.Box 91279, Mombasa</center>
			<center>Tel: +254700221512</center>
			<center>Email: chalianamedicalcentre@gmail.com</center>
			<center><h4 style="margin: 5px">RECEIPT</h4></center>
		    <div style="text-align: left">Name : <?php echo  $f['name']?> </div>
			<br />
			
			<center>
				<table width="100%" cellspacing="0">
						<tr>
							<th><center>Date</center></th>
							<th><center>Service</center></th>
							<th><center>Price</center></th>
						</tr>
				<?php
				include('../db/config.php'); 
				$q = $conn->query("SELECT * FROM `outpatient` WHERE `id` = '$_GET[id]' ") or die(mysqli_error());
				$total = 0;
				while($f = $q->fetch_array()){

				$total += $f['price'];
                echo "<tr>";
                echo "<td><center>".$f['date']."</center></td>";
                echo "<td><center>".$f['service']."</center></td>";
                echo "<td><center>".$f['price']."</center></td>";
                echo "</tr>";
			    }
			    $conn->close();
				?>
				<tr>
					<td colspan="5"><br>
						<center><b>Total: <?php echo "KES ". $total;?></b></center>
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
			<div style="text-align: left">Date : <?php echo date("Y-m-d h:i:sa");?></div>
			<hr>
			<div style="text-align: center"><i>Huduma Bora, Afya Bora</i></div>
			<hr>
		</div>
	</center>
	</div>
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