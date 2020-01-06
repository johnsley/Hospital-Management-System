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
                <div style = "display:none;" id = "add_doc" class = "panel panel-success">	
				<div class = "panel-heading">
					<label>ADD DOCTOR INFORMATION</label>
					<button id = "hide_doc" style = "float:right; margin-top:-4px;" class = "btn btn-danger"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
				</div>
				<div class = "panel-body">
					<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
					
						<div class = "form-inline">
							<label for = "firstname">Firstname:</label>
							<input class = "form-control" name = "firstname" type = "text" required = "required">
							&nbsp;&nbsp;&nbsp;
							<label for = "lastname">Lastname:</label>
							<input class = "form-control" name = "lastname" type = "text" required = "required">
							&nbsp;&nbsp;&nbsp;
							<label for = "lastname">Phone:</label>
							<input class = "form-control" name = "phone" type = "text" required = "required">
						</div>
						<br /><br>
						<div class = "form-inline">
							<button class = "btn btn-primary" name = "save_doctor"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
						</div>
					</form>
				</div>	
			</div>	

			<?php require 'add_script.php';?>

			<div  id = "a_table" class="panel panel-default">
				<div class = "panel-heading">
					<label>DOCTORS LIST</Label>
						 <a href = "master.php" class = "btn btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
				</div>
				<div class = "panel-body">
					<button id = "show_doc" class = "btn btn-info"><span class = "glyphicon glyphicon-plus"></span> ADD DOCTOR</button>
					<br />
					<br />
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>phone</th>
								<th>Level</th>
								<th><center>Action</center></th>
							</tr>
						</thead>
						<tbody>
						<?php
						include('../db/config.php'); 
						$query = $conn->query("SELECT * FROM `doctors` ORDER BY `doc_id` DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
						$id = $fetch['doc_id'];
						?>
							<tr>
								<td><?php echo $fetch['doc_id']?></td>
								<td><?php echo $fetch['name']?></td>							
								<td><?php echo $fetch['mob']?></td>
								<td><?php echo $fetch['us']?></td>
								<td><center>
								<!-- <a href = "" class = "btn btn-info"><span class="glyphicon glyphicon-pencil"></span></a>  -->
								<?php
                                if(isset($_SESSION['user_id']) && $_SESSION['user_group'] ==1){
                                ?>
                                <a href = "delete_doc.php?id=<?php echo $id?>" class = "btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                <?php
                                }
								?>
							    </center></td>
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
</body>
</html>
