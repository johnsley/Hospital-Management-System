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
         <div class="row">
            <div class="col-lg-12">
            	<br />
            	<div class = "panel panel-success">	
				<div class = "panel-heading">
					<label>PATIENT INFORMATION / EDIT</label>
					<a style = "float:right; margin-top:-4px;" href = "patient.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
				</div>
				<div class = "panel-body">
				<?php
					include('../db/config.php'); 
					$q = $conn->query("SELECT * FROM `itr` WHERE `itr_no` = '$_GET[id]' && `lastname` = '$_GET[lastname]'") or die(mysqli_error());
					$f = $q->fetch_array();
				?>
					<form method = "POST" enctype = "multipart/form-data">
						<div class = "form-inline">
							<label for = "firstname">Firstname:</label>
							<input class = "form-control" name = "firstname" value = "<?php echo $f['firstname']?>" type = "text" required = "required">
							&nbsp;&nbsp;&nbsp;
							<label for = "lastname">Lastname:</label>
							<input class = "form-control" name = "lastname" value = "<?php echo $f['lastname']?>" type = "text" required = "required">
						</div>
						<br />
						<div class = "form-inline">
							<label for = "phone">Phone:</label>
							<input class = "form-control" name = "phone" type = "text" value = "<?php echo $f['phone']?>" required="required">
	                        &nbsp;&nbsp;&nbsp;
							<label for = "age">Age:</label>
							<input class = "form-control" value = "<?php echo $f['age']?>" name = "age" type = "text">
						</div>
						<br>
						<div class = "form-inline">
							<label for = "address">Address:</label>
							<input class = "form-control" name = "address" type = "text" value = "<?php echo $f['address']?>" required = "required">
							&nbsp;&nbsp;&nbsp;
							<label for = "gender">Gender:</label>
							<select class = "form-control" name = "gender" required = "required">
								<option value = "<?php echo $f['gender']?>"><?php echo $f['gender']?></option>
								<option value = "">--Please select an option--</option>
								<option value = "Male">Male</option>
								<option value = "Female">Female</option>
							</select>
						</div>
						<br />
						<div class = "form-inline">
							<button class = "btn btn-warning" name = "edit_patient"><span class = "glyphicon glyphicon-pencil"></span> SAVE</button>
						</div>
						<?php require_once 'edit_query.php';?>
					</form>
				</div>	
			</div>
            </div>
         </div>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src = "../js/script.js"></script>
</body>
</html>
