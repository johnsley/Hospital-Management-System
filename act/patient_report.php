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
    <script src="../vendor/js/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src = "../vendor/js/typeahead.js"></script>
    <script src=  "../vendor/js/datetimepicker/moment.min.js"></script>
    <script src=  "../vendor/js/datetimepicker/bootstrap-datetimepicker.js"></script>

    <script>
    $(document).ready(function() {
        $('input.patient').typeahead({
            name: 'patient',
            remote: 'query.php?query=%QUERY'
        });
    })
    </script>

    <script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker3').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker4').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker5').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker6').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    });
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
	           <div class="col-sm-12">
					<div class = "panel panel-default">
					<div class = "panel-heading">
						<label>PATIENT REGISTERED</label>
                        <a style = "float:right; margin-top:-4px;" href = "account.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
					</div>
					<div class = "panel-body" style="padding: 20px">
							<div>
							<form  method = "POST" enctype = "multipart/form-data" action="monthly_patient_report.php">
								<div class = "form-inline">
									<span class='input-group date' id='datetimepicker2'>
										<input class = "form-control" name = "mindate" type = "text" placeholder="From" required = "required">
										<span class="input-group-addon">
					                        <span class="glyphicon glyphicon-calendar"></span>
					                    </span>
								    </span>
                                     &nbsp;&nbsp;&nbsp;
								    <span class='input-group date' id='datetimepicker3'>
									    <input class = "form-control" name = "maxdate" type = "text" placeholder="To" required = "required">
									    <span class="input-group-addon">
						                        <span class="glyphicon glyphicon-calendar"></span>
						                </span>
								    </span>
		                            <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>
                                    <span class="visible-xs"><br></span>
								    <button class = "btn btn-primary">View</button>
							    </div>
							</form>
						   </div>
					</div>
				  </div>
                  <div class = "panel panel-default">
                    <div class = "panel-heading">
                        <label>TOTAL PATIENT TREATED</label>
                    </div>
                    <div class = "panel-body" style="padding: 20px">
                            <div>
                            <form  method = "POST" enctype = "multipart/form-data" action="patient_treated.php">
                                <div class = "form-inline">
                                    <span class='input-group date' id='datetimepicker4'>
                                        <input class = "form-control" name = "mindate" type = "text" placeholder="From" required = "required">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </span>
                                     &nbsp;&nbsp;&nbsp;
                                    <span class='input-group date' id='datetimepicker5'>
                                        <input class = "form-control" name = "maxdate" type = "text" placeholder="To" required = "required">
                                        <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </span>
                                    <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>
                                    <span class="visible-xs"><br></span>
                                    <button class = "btn btn-primary">View</button>
                                </div>
                            </form>
                           </div>
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