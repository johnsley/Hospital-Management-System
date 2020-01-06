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
						<label>Patient Diagnosis and Treatment</label>
						<a href = "consultation.php" class = "btn btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
					</div>
					<div class = "panel-body">
					<?php
                    $a = $conn->query("SELECT * FROM `user` WHERE `user_id`='$_SESSION[user_id]' ") or die(mysqli_error());
					$aa = $a->fetch_array();

					$query = $conn->query("SELECT * FROM `service` WHERE `service_id`='$_GET[id]' ") or die(mysqli_error());
					$fetch = $query->fetch_array();
					$service_id = $fetch['service_id'];
                    $patient_id = $fetch['patient_id'];
                    $doc_id = $fetch['doctor_id'];
                    $item_id = $fetch['item_id'];
                    $tquery = $conn->query("SELECT * FROM `triage` WHERE `service_id`='$_GET[id]' ") or die(mysqli_error());
                    $tfetch = $tquery->fetch_array();

                    $q = $conn->query("SELECT * FROM `itr` WHERE `itr_no`='$patient_id' ") or die(mysqli_error());
					$f = $q->fetch_array();

					$d = $conn->query("SELECT * FROM `doctors` WHERE `doc_id`= '$doc_id' ") or die(mysqli_error());
					$doc = $d->fetch_array();

					$i = $conn->query("SELECT * FROM `item` WHERE `item_id`='$item_id' ") or die(mysqli_error());
					$item = $i->fetch_array();
					?>
		            <form method="post" onkeypress="return event.keyCode!=13" enctype="multipart/form-data" action="savtriage.php" >
                    <center>
                    <table cellspacing="10px" id="regaddbox">
                    <tr><td align="left" style="width:200px;padding:5px"><label for="pname">Patient Name &nbsp; </label></td>
						<td><input type="text" id="pname" name="pname" readonly="readonly" value= "<?php echo $f['firstname'].' '.$f['lastname']; ?>" size="40"/> &nbsp; &nbsp; Age : <?php echo $f['age']; ?>
						<input type="hidden" id="patient_id" value="<?php echo $patient_id; ?>" name="patient_id" />
						<input type="hidden" id="service_id" value="<?php echo $service_id; ?>" name="service_id" />
					</td>
                    </tr>
					<tr><td align="left" style="padding:5px"><label for="dob"> Doctor &nbsp;</label></td>
                    <td>
                    <input type="text" id="doctor" name="doctor" readonly="readonly" value="<?php echo $doc['name']; ?>"/>  
                    <input type="hidden" id="doctor_id" name="doctor_id"  value="<?php echo  $doc_id; ?>"/>
                    <input type="hidden" id="item_id" name="item_id"  value="<?php echo  $item_id; ?>"/>  
                    </td>
                    </tr>
					
					<tr><td align="left" style="padding:5px"><label for="tempr"> Temperature &nbsp;</label></td>
						<td><input type="text" id="tempr" name="tempr" value="<?php echo $tfetch['tempr']; ?>" size="20"/> &nbsp;&nbsp;&nbsp; <input type="text" id="tptime" name="tptime" value="<?php echo $tfetch['tptime']; ?>" size="7" placeholder="00:00"/></td>
                    </tr>
					
					<tr><td align="left" style="padding:5px"><label for="hr"> Pulse Rate &nbsp;</label></td>
						<td><input type="text" id="pr" name="pr" value="<?php echo $tfetch['pr']; ?>" size="20"/> &nbsp;&nbsp;&nbsp; <input type="text" id="prtime" name="prtime" value="<?php echo $tfetch['prtime']; ?>" size="7" placeholder="00:00"/></td>
                    </tr>
					<tr><td align="left" style="padding:5px"><label for="bp"> BP Rate &nbsp;</label> </td>
						<td><input type="text" id="bp" name="bp" value="<?php echo $tfetch['bp']; ?>" size="20"/> &nbsp;&nbsp;&nbsp; <input type="text" id="bptime" name="bptime" value="<?php echo $tfetch['bptime']; ?>" size="7" placeholder="00:00"/> </td>
                    </tr>
					
					<tr><td align="left" style="padding:5px"><label for="inves"> Investigations &nbsp;</label></td>
                    <td colspan="2"><input type="text" id="inves" name="inves"  value="<?php echo $tfetch['inves']; ?>" size="60"/> </td>
                    </tr>
					<tr><td align="left" style="padding:5px"><label for="icdc"> ICD Classification &nbsp;</label></td>
                    <td><input type="text" id="icdc" name="icdc"  value="<?php echo $tfetch['icdc']; ?>" size="60"/>  </td>
                    </tr>
					<tr><td colspan="2"></td></tr>
					<tr><td align="left" style="padding:5px"><label for="cond"> Clinical Findings &nbsp;</label></td>
                    <td><input type="text" id="clinicalf" name="clinicalf" value="<?php echo $tfetch['clincfind']; ?>" size="60"/> </td>
                    </tr>
					<tr><td align="left" style="padding:5px"><label for="diag"> Diagnosis &nbsp;</label></td>
                    <td><input type="text" id="diag" name="diag"  value="<?php echo $tfetch['diog']; ?>" size="60"/> </td>
                    </tr>
                    <tr><td colspan="2" align="center" style="padding:5px">
						<input type="submit" class="text ui-widget-content ui-corner-all" style="width:190px;font-weight:bold;" id="btnaddtriage" name="btnaddtriage" value=" Save Details "/>
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
