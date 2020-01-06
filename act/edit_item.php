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
						<label>EDIT ITEM</label>
						<a href = "service.php" class = "btn btn-sm btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
					</div>
					<div class = "panel-body">
		            <?php
					include('../db/config.php'); 
					$q = $conn->query("SELECT * FROM `item` WHERE `item_id` = '$_GET[id]'") or die(mysqli_error());
					$f = $q->fetch_array();
					?>
					<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
						<div class = "form-inline">
							<input  name = "item_id" type = "hidden" value="<?php echo $f['item_id']?>">
							<label for = "firstname">Name:</label>
							<input class = "form-control" name = "name" type = "text" value="<?php echo $f['name']?>">
							&nbsp;&nbsp;&nbsp;
							<label for = "lastname">Price:</label>
							<input class = "form-control" name = "price" type = "text" value="<?php echo $f['price']?>">
						</div>
						<br />
						<div class = "form-inline">
							<label for = "gender">Type:</label>
							<select class = "form-control" name = "type" required = "required">
								<option value = "<?php echo $f['type']?>"><?php echo $f['type']?></option>
								<option value = "">--Please select an option--</option>
								<option value = "consultation">Consultation</option>
								<option value = "radiology">Radiology</option>
								<option value = "pharmacy">Pharmacy</option>
								<option value = "physiotherapy">Physiotherapy</option>
								<option value = "maternity">Maternity</option>
								<option value = "laboratory">Laboratory</option>
							</select>
						</div>
						<br />
						<div class = "form-inline">
							<button class = "btn btn-primary" name = "edit_service_item"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
						</div>
					</form>
					<?php require_once 'edit_query.php';?>

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