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
						<label>Lab Report</label>
						<a href = "laboratory.php" class = "btn btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
					</div>
					<div class = "panel-body">

					<form id="regform" method="post" onkeypress="return event.keyCode!=13" enctype="multipart/form-data" action="savlab.php" >
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

                    <div><label>Patient Name:</label>&nbsp;<?php echo $f['firstname'].' '.$f['lastname']; ?>
                    &nbsp;&nbsp;<label>Gender</label>&nbsp;<?php echo $f['gender']; ?>
                    &nbsp;&nbsp;<label>Test Type:</label>&nbsp;<?php echo $item['name']; ?>
                    &nbsp;&nbsp;<label>Age:</label>&nbsp;<?php echo $f['age']; ?>
                    </div>

                    <input type="hidden" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>"/><input type="hidden" id="service_id" name="service_id" value="<?php echo $service_id; ?>"/>
                    <input type="hidden" id="item_id" name="item_id" value="<?php echo $item_id; ?>"/> <input type="hidden" id="doctor_id" name="doctor_id" value="<?php echo $doc_id; ?>"/>
					
					<table cellspacing="7px" id="mytable" style="width: 100%">
					<th>Matter</th> <th>Result</th> <th>Limits</th> <th>Class</th> <th>State</th>
					<tr><td colspan=5><hr/></td></tr>
					<tr>
                        <td>
                        <select id="matter[]" name = "matter[]" required = "required" style="padding: 5px">
                            <option value = "">Select Matter</option>
                            <?php
                                $query = $conn->query("SELECT `matter` FROM `labtemplatedets`") or die(mysqli_error());
                                while($row = $query->fetch_array()){
                                $matter = $row['matter'];
                                ?>
                                <option value = "<?php echo $matter;?>"><?php echo $row['matter']; ?></option>
                                <?php
                                }
                            ?>
                        </select>
                        </td>
                        <td><input type="text" id="result[]" name="result[]"></td>
                        <td><input type="text" id="limits[]" name="limits[]"></td>
                        <td><input type="text" id="class[]" name="class[]"></td>
                        <td><input type="text" id="state[]" name="state[]"></td>
                    </tr>
					    <br />
					</table>
                    <br>
                    <textarea id="comment" name="comment" placeholder="Comment" style="padding: 5px"></textarea>
					<br /><br />
                   
					<button type="button" class="text ui-widget-content ui-corner-all" href="#" id="insert-more"> Add New Row </button>
					<input type="submit" class="text ui-widget-content ui-corner-all" style="width:180px;font-weight:bold;" id="btnaddrep" name="btnaddrep" value=" Save Details " />
                   
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

     $("#insert-more").click(function () {
     $("#mytable").each(function () {
         var tds = '<tr>';
         jQuery.each($('tr:last td', this), function () {
             tds += '<td>' + $(this).html() + '</td>';
         });
         tds += '</tr>';
         if ($('tbody', this).length > 0) {
             $('tbody', this).append(tds);
         } else {
             $(this).append(tds);
         }
     });
});

       })
    </script>
</body>
</html>
