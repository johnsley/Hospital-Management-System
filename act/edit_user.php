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
					<?php
						include('../db/config.php'); 
						$query = $conn->query("SELECT * FROM `user` WHERE `user_id` = '$_GET[id]'") or die(mysqli_error());
						$fetch = $query->fetch_array();
					?>
					<div class = "panel-heading">
						<label>ADD USER</label>
						<a href = "user.php" class = "btn btn-sm btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
					</div>
					<div class = "panel-body">
		               <form action="edit_query.php" id = "form_user" method = "POST" enctype = "multi-part/form-data">
						<div class = "panel panel-default" style = "width:60%; margin:auto;">
						<div class = "panel-heading">
						</div>
						<div class = "panel-body">
							<div class = "form-group">
								<label for = "username">Username: </label>
								<input value = "<?php echo $_GET['id']?>" name = "id" type = "hidden" >
								<input class = "form-control" value = "<?php echo $fetch['username']?>" name = "username" type = "text" required = "required">
							</div>
							<div class = "form-group">	
								<label for = "password">Password: </label>
								<input class = "form-control" name = "password" maxlength = "12" value = "<?php echo $fetch['password']?>" type = "password" required = "required">
							</div>
							<div class = "form-group">
								<label for = "firstname">Firstname: </label>
								<input class = "form-control" type = "text" value = "<?php echo $fetch['firstname']?>" name = "firstname" required = "required">
							</div>
							<div class = "form-group">
								<label for = "middlename">Middlename: </label>
								<input class = "form-control" type = "text" value = "<?php echo $fetch['middlename']?>" name = "middlename" placeholder = "(Optional)">
							</div>
							<div class = "form-group">
								<label for = "lastname">Lastname: </label>
								<input class = "form-control" type = "text" value = "<?php echo $fetch['lastname']?>" name = "lastname" required = "required">
							</div>
							<div class = "form-group">
								<label for = "section">Section: </label>
								<select name = "section" class = "form-control" required = "required">
									<option value = "">--Please select an option--</option>
									<option value = "1">Admin</option>
									<option value = "2">Accountant</option>
									<option value = "4">Reception</option>
									<option value = "5">Laboratory</option>
									<option value = "11">Doctor</option>
									<option value = "9">Radiology</option>
									<option value = "10">Dental clinic</option>
									<option value = "6">Physiotherapy</option>
									<option value = "12">Maternity</option>
								</select>
							</div>
								<button class = "btn btn-warning" name = "edit_user" ><span class = "glyphicon glyphicon-edit"></span> SAVE</button>
								<br />
						</div>	
						
						</div>
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
