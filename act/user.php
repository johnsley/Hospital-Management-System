<?php
    require_once 'session.php';
    require_once '../db/config.php';
    if($_SESSION['user_group'] != 1){
    	echo "<script>window.location = 'logout.php'</script>";
    }
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
                <div id = "add_itr" class = "panel panel-success" style="display: none">	
				<div class = "panel-heading">
					<label>ADD USER</label>
					<button id = "hide_itr" class = "btn btn-danger" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
				</div>
				<div class = "panel-body">
					<form id = "form_user" method = "POST" enctype = "multi-part/form-data">
						<div class = "panel panel-default" style = "width:60%; margin:auto;">
						<div class = "panel-heading">
						</div>
						<div class = "panel-body">
							<div class = "form-group">
								<label for = "username">Username: </label>
								<input class = "form-control" name = "username" type = "text" required = "required">
							</div>
							<div class = "form-group">	
								<label for = "password">Password: </label>
								<input class = "form-control" name = "password" maxlength = "12" type = "password" required = "required">
							</div>
							<div class = "form-group">
								<label for = "firstname">Firstname: </label>
								<input class = "form-control" type = "text" name = "firstname" required = "required">
							</div>
							<div class = "form-group">
								<label for = "middlename">Middlename: </label>
								<input class = "form-control" type = "text" name = "middlename" placeholder = "(Optional)">
							</div>
							<div class = "form-group">
								<label for = "lastname">Lastname: </label>
								<input class = "form-control" type = "text" name = "lastname" required = "required">
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
								<button class = "btn btn-primary" name = "save_user" ><span class = "glyphicon glyphicon-save"></span> SAVE</button>
								<br />
						</div>	
						<?php require 'add_user.php';?>
						</div>
					</form>			
				</div>	
			</div>	
			<div  id = "a_table" class="panel panel-default">
				<div class = "panel-heading">
					<label>ACCOUNTS / USER</Label>
					<a href = "master.php" class = "btn btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
				</div>
				<div class = "panel-body">
					<button id = "show_itr" class = "btn btn-info"><span class = "glyphicon glyphicon-plus"></span> ADD USER</button>
					<br /><br />
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Username</th>
								<th>Password</th>
								<th>Name</th>
								<th>Section</th>
								<th><center>Action</center></th>
							</tr>
						</thead>
						<tbody>
						<?php
						include('../db/config.php'); 
						$query = $conn->query("SELECT * FROM `user` ORDER BY `user_id` DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
						?>
							<tr>
								<td><?php echo $fetch['username']?></td>
								<td><?php echo $fetch['password'];?></td>
								<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
								<td><?php echo $fetch['section']?></td>
								<td><center><a href = "edit_user.php?id=<?php echo $fetch['user_id']?>&lastname=<?php echo $fetch['lastname']?>"class = "btn btn-warning"><i class = "glyphicon glyphicon-edit"></i> Update</a> <a onclick = "delete_user(this); return false;"  href = "delete_user.php?id=<?php echo $fetch['user_id']?>&lastname=<?php echo $fetch['lastname']?>" class = "btn btn-danger"><i class = "glyphicon glyphicon-remove"></i> Delete</a></center></td>
							</tr>
						<?php
							}
							$conn->close();
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

	<script type = "text/javascript">
		function delete_user(that){
			var delete_func = confirm("Are you sure you want to delete this record?")
			if(delete_func){
				window.location = anchor.attr("href");
			}
		}
	</script>	
</body>
</html>