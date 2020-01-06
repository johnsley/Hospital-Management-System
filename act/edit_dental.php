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
                   
				<div class = "panel panel-success">	
					<div class = "panel-heading">
						<label>Dental Report</label>
						<a href = "dental.php" class = "btn btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
					</div>
					<div class = "panel-body">

					<form id="regform" method="post" onkeypress="return event.keyCode!=13" enctype="multipart/form-data" action="savdental.php" >
					<?php
						$query = $conn->query("SELECT * FROM `service` WHERE `service_id`='$_GET[id]' ") or die(mysqli_error());
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
                    <center>
                    <table cellspacing="10px" id="regaddbox">
                    <tr><td align="left">Patient Name: &nbsp; </td> <td><strong> <?php echo $f['firstname'].' '.$f['lastname']; ?>  </strong></td>
						<td align="left"> Gender:&nbsp; <input type="hidden" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>"/><input type="hidden" id="service_id" name="service_id" value="<?php echo $service_id; ?>"/></td> <td><strong><?php echo $f['gender']; ?></strong></td>
                    </tr>
                    <tr><td align="left"> Test Type: &nbsp; </td> <td> <strong><?php echo $item['name']; ?></strong> <input type="hidden" id="item_id" name="item_id" value="<?php echo $item_id; ?>"/> <input type="hidden" id="doctor_id" name="doctor_id" value="<?php echo $doc_id; ?>"/></td>
						<td align="left"> &nbsp;&nbsp;&nbsp; Age:&nbsp; </td> <td><strong> <?php echo $f['age']; ?></strong></td>
					</tr></table>
					
					<table cellspacing="7px" id="regaddbox">
					<th></th><th>Narration</th> 
					<tr><td colspan="2"><hr/></td></tr>
					<?php 

					    $query = $conn->query("SELECT * FROM dentalreps WHERE `service_id` = '$service_id' ") or die(mysqli_error());
					    $f = ''; 	$n=''; 
						while($row = $query->fetch_array()){
							$f = $row['find'];
							$n = $row['notes'];
						}
						echo '<tr><td style="vertical-align:top;"><label>Findings: </label></td> <td><textarea rows="4" cols="53" name="find" id="find">'.$f.'</textarea></td></tr>'; 
						echo '<tr><td style="vertical-align:top;"><label>Notes: </label></td> <td><textarea rows="4" cols="53" name="notes" id="notes">'.$n.'</textarea></td></tr>';
					    ?>
					    <tr><td> </td></tr><br />
					    <tr><td align="center" colspan="2">
								<input type="submit" class="text ui-widget-content ui-corner-all" style="width:180px;font-weight:bold;" id="btnaddrep" name="btnaddrep" value=" Save Details " />
							</td></tr>
					</table></center>
					</form> 
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
