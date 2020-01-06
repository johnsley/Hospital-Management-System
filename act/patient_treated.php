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
					<label>TOTAL PATIENT TREATED - FROM: <span style="color:green"><?php echo $_POST['mindate'];?></span> TO: <span style="color:green"><?php echo $_POST['maxdate'];?></span></Label>
					<a style = "float:right; margin-top:-4px;" href = "patient_report.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
				</div>
				<div class = "panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Date</th>
								<th>Name</th>
								<th>Doctor</th>
								<th>Service</th>
								<th>Cashier</th>
							</tr>
						</thead>
						<tbody>
						<?php
							include('../db/config.php');
							$mindate = $_POST['mindate']; 
							$maxdate = $_POST['maxdate']; 
							
							$min = date_create($_POST['mindate']);
							date_sub($min,date_interval_create_from_date_string("1 days"));
							$min2 = date_format($min,"Y-m-d");

							$max = date_create($_POST['maxdate']);
							date_sub($max,date_interval_create_from_date_string("1 days"));
							$max2 = date_format($max,"Y-m-d");

	                        $query = $conn->query("SELECT * FROM `service` WHERE `date` >= '$mindate' AND `date` < '$maxdate' ") or die(mysqli_error());

	                        $c1 = $query->num_rows;
	              
	                        while($fetch = $query->fetch_array()){
	                        	$service_id = $fetch['service_id'];
	                        	$patient_id = $fetch['patient_id'];
	                        	$doc_id = $fetch['doctor_id'];
	                        	$item_id = $fetch['item_id'];
	                            $p1 = $conn->query("SELECT * FROM `itr` WHERE `itr_no`='$patient_id' ") or die(mysqli_error());
	                            $p11 = $p1->fetch_array();
	                            $d1 = $conn->query("SELECT * FROM `doctors` WHERE `doc_id`='$doc_id' ") or die(mysqli_error());
	                            $d11 = $d1->fetch_array();
	                            $t1 = $conn->query("SELECT * FROM `item` WHERE `item_id`='$item_id' ") or die(mysqli_error());
	                            $t11 = $t1->fetch_array(); 
	                         ?>
							<tr>
								<td><?php echo $fetch['date']?></td>
								<td><?php echo $p11['firstname'].' '.$p11['lastname']?></td>
								<td><?php echo $d11['name']?></td>
								<td><?php echo $t11['name']?></td>				
								<td><?php echo $fetch['cashier']?></td>
							</tr>
						<?php
							}
						?>
						</tbody>
						</table>
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
            responsive: true
        });
       })
    </script>	
</body>
</html>