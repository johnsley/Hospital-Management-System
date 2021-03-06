<?php
    require_once 'session.php';
    require_once '../db/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CHALIANA MEDICAL CENTRE</title>
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/sley.css" rel="stylesheet" type="text/css">
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src = "../vendor/js/typeahead.js"></script>
    <script>
    $(document).ready(function() {
        $('input.patient').typeahead({
            name: 'patient',
            remote: 'query.php?query=%QUERY'
        });
    })
    </script>
</head>
<body>
 <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background: #fff">
            <?php include 'header.php'?>
            <!-- /.navbar-top-links -->
            <?php include 'sidebar.php'?>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
           <br>
           <div class="row">
           <div class="col-lg-12">
			<div  id = "a_table" class="panel panel-default">
				<div class = "panel-heading">
				    <label>CASH REPORT</Label>
					<a style = "float:right; margin-top:-4px;" href = "report_select.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
				</div>
				<div class = "panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Date</th>
								<th>Name</th>
								<th>Doctor</th>
								<th>Service</th>
								<th>Qty</th>
								<th>Price</th>
								<th>Amount</th>
								<th>Paid</th>
								<th>Balance</th>
								<th>Mode</th>
								<th>Cashier</th>
							</tr>
						</thead>
						<tbody>
						<?php
							include('../db/config.php');
							$fromdate = $_POST['fromdate']; 
							$date = date_create($_POST['fromdate']);
							date_sub($date,date_interval_create_from_date_string("1 days"));
							$date2 = date_format($date,"Y-m-d");
							$amt = 0;
							$paid = 0;
							$bal = 0;

	                        $query = $conn->query("SELECT * FROM `service` WHERE `date` LIKE '%{$fromdate}%' ORDER BY `date` DESC ") or die(mysqli_error());
	                        $c1 = $query->num_rows;
							
							$cash = $conn->query("SELECT SUM(paid) as total FROM `service` WHERE `date` LIKE '%{$fromdate}%' AND `payment`='Cash' ") or die(mysqli_error());
							$fcash = $cash->fetch_array();
							if($fcash['total'] > 0){$fcash = $fcash['total'];}else{$fcash = 0;}
							
							$mpesa = $conn->query("SELECT SUM(paid) as total FROM `service` WHERE `date` LIKE '%{$fromdate}%' AND `payment`='mpesa' ") or die(mysqli_error());
							$fmpesa = $mpesa->fetch_array();
							if($fmpesa['total'] > 0){$fmpesa = $fmpesa['total'];}else{$fmpesa = 0;}
	              
	                        while($fetch = $query->fetch_array()){
	                        	$service_id = $fetch['service_id'];
	                        	$patient_id = $fetch['patient_id'];
	                        	$doc_id = $fetch['doctor_id'];
	                        	$item_id = $fetch['item_id'];

	                        	 $q = $conn->query("SELECT * FROM `service_backup` WHERE `service_id` = '$service_id' AND `date` LIKE '%{$date2}%' ORDER BY id LIMIT 1 ") or die(mysqli_error());
	                        	 $c = $q->num_rows;
	                        	 if($c > 0){
	                                $f = $q->fetch_array();
	                                $paidt = $fetch['paid'] - $f['paid'];  
	                                $paid += $paidt; 
	                        	 }else{
	                                  $paid += $fetch['paid'];  
	                        	 }
	                        	 $amt += $fetch['amount'];
	                        	 $bal += $fetch['balance']; 

	                            $p1 = $conn->query("SELECT * FROM `itr` WHERE `itr_no`='$patient_id' ") or die(mysqli_error());
	                            $p11 = $p1->fetch_array();
	                            $d1 = $conn->query("SELECT * FROM `doctors` WHERE `doc_id`='$doc_id' ") or die(mysqli_error());
	                            $d11 = $d1->fetch_array();
	                            $t1 = $conn->query("SELECT * FROM `item` WHERE `item_id`='$item_id' ") or die(mysqli_error());
	                            $t11 = $t1->fetch_array(); 

	                            $outcash = $conn->query("SELECT SUM(price) as total FROM `outpatient` WHERE `date` LIKE '%{$fromdate}%' AND `payment`='cash' ") or die(mysqli_error());
		                        $foutcash = $outcash->fetch_array();
	                            if($foutcash['total'] > 0){$foutcash = $foutcash['total'];}else{$foutcash = 0;}

	                            $outmpesa = $conn->query("SELECT SUM(price) as total FROM `outpatient` WHERE `date` LIKE '%{$fromdate}%' AND `payment`='mpesa' ") or die(mysqli_error());
		                        $foutmpesa = $outmpesa->fetch_array();
	                            if($foutmpesa['total'] > 0){$foutmpesa = $foutmpesa['total'];}else{$foutmpesa = 0;}

		                        $pay = $conn->query("SELECT SUM(amount) as total FROM `payment` WHERE `date` LIKE '%{$fromdate}%' ") or die(mysqli_error());
		                        $fpay = $pay->fetch_array();  
								if($fpay['total'] > 0){$fpay = $fpay['total'];}else{$fpay = 0;}
	                         ?>
							<tr>
								<td><?php echo ($fetch['reversal'] == 'R' ? '<span style="color:red">'.$fetch['date'].'</span>':$fetch['date']) ;?></td>
								<td><?php echo ($fetch['reversal'] == 'R' ? '<span style="color:red">'.$p11['firstname'].' '.$p11['lastname'].'</span>':$p11['firstname'].' '.$p11['lastname']) ;?></td>
								<td><?php echo ($fetch['reversal'] == 'R' ? '<span style="color:red">'.$d11['name'].'</span>':$d11['name']);?></td>
								<td><?php echo ($fetch['reversal'] == 'R' ? '<span style="color:red">'.$t11['name'].'</span>':$t11['name']);?></td>				
								<td><?php echo ($fetch['reversal'] == 'R' ? '<span style="color:red">'.$fetch['qty'].'</span>':$fetch['qty']);?></td>				
								<td><?php echo ($fetch['reversal'] == 'R' ? '<span style="color:red">'.$fetch['price'].'</span>':$fetch['price']);?></td>
								<td><?php echo ($fetch['reversal'] == 'R' ? '<span style="color:red">'.$fetch['amount'].'</span>':$fetch['amount']);?></td>
								<td><?php echo ($fetch['reversal'] == 'R' ? '<span style="color:red">'.$fetch['paid'].'</span>':$fetch['paid']);?></td>
								<td><?php echo ($fetch['reversal'] == 'R' ? '<span style="color:red">'.$fetch['balance'].'</span>':$fetch['balance']);?></td>
								<td><?php echo ($fetch['reversal'] == 'R' ? '<span style="color:red">'.$fetch['payment'].'</span>':$fetch['payment']);?></td>
								<td><?php echo ($fetch['reversal'] == 'R' ? '<span style="color:red">'.$fetch['cashier'].'</span>':$fetch['cashier']);?></td>
							</tr>
						<?php
							}
						?>
						</tbody>
						</table>
						<br>
						<?php
	                    if($c1 > 0){
	                    	?>
	                         <div class="col-sm-12" style="padding: 0px">
								<div class="col-sm-12" style="padding: 0px"><hr></div>
								<div class="col-sm-12" style="padding: 0px">
									<div class="col-sm-4"  style="padding: 0px">
										<label>Total Balance</label>
									</div>
									<div class="col-sm-2">
										<?php echo "KES ".$bal?>
									</div>
								</div>
								<div class="col-sm-12" style="padding: 0px"><hr></div>
								<div class="col-sm-12" style="padding: 0px">
									<div class="col-sm-4"  style="padding: 0px">
										<label>InPatient Cash Amount </label>
									</div>
									<div class="col-sm-2">
										<?php echo "KES ".$fcash?>
									</div>
								</div>
								<div class="col-sm-12" style="padding: 0px">
									<div class="col-sm-4"  style="padding: 0px">
										<label>InPatient Mpesa Amount </label>
									</div>
									<div class="col-sm-2">
										<?php echo "KES ".$fmpesa?>
									</div>
								</div>
								<div class="col-sm-12" style="padding: 0px">
									<div class="col-sm-4"  style="padding: 0px">
										<label>OutPatient Cash Amount </label>
									</div>
									<div class="col-sm-2">
										<?php echo "KES ".$foutcash?>
									</div>
								</div>
								<div class="col-sm-12" style="padding: 0px">
									<div class="col-sm-4"  style="padding: 0px">
										<label>OutPatient Mpesa Amount </label>
									</div>
									<div class="col-sm-2">
										<?php echo "KES ".$foutmpesa?>
									</div>
								</div>
								<div class="col-sm-12"  style="padding: 0px">
									<div class="col-sm-4"  style="padding: 0px">
										<label>Expenses </label>
									</div>
									<div class="col-sm-2">
										<?php echo "KES ".$fpay?>
									</div>
								</div>
								<div class="col-sm-12" style="padding: 0px"><hr></div>
								<div class="col-sm-12"  style="padding: 0px">
									<div class="col-sm-4"  style="padding: 0px">
				                    <label>Total <span style="font-size: 1.5em">Cash</span> Available</label>
									</div>
									<div class="col-sm-2">
										<?php 
										$cashsum = $fcash + $foutcash;
										$cashavail = $cashsum - $fpay;
										echo "<strong>KES <span style='font-size:1.5em'>".$cashavail."</span></strong>";
										?>
									</div>
								</div>
								<div class="col-sm-12"  style="padding: 0px">
									<div class="col-sm-4"  style="padding: 0px">
										<label>Total <span style="font-size: 1.5em">Mpesa</span> Available</label>
									</div>
									<div class="col-sm-2">
										<?php 
										$mpesasum = $fmpesa + $foutmpesa;
										echo "<strong>KES <span style='font-size:1.5em'>".$mpesasum."</span></strong>";
										?>
									</div>
								</div>
								<div class="col-sm-12" style="padding: 0px"><hr></div>
								<div class="col-sm-12"  style="padding: 0px">
									<div class="col-sm-4"  style="padding: 0px">
										<label>Total <span style="font-size: 1.5em">Day</span> Amount </label>
									</div>
									<div class="col-sm-2">
										<?php 
										$avail = $cashavail + $mpesasum;
										echo "<strong>KES <span style='font-size:1.5em'>".$avail."</span></strong>";
										?>
									</div>
								</div>
						    </div>
	                    	<?php
	                     }

	                     $conn->close();
						?>	
				    </div>
			      </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src = "../js/script.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            "ordering": false
        });
       })
    </script>	
</body>
</html>