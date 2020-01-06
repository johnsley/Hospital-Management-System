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
                <div style = "display:none;" id = "add_itr" class = "panel panel-success">	
				<div class = "panel-heading">
					<label>ADD SERVICE ITEM</label>
					<button id = "hide_itr" style = "float:right; margin-top:-4px;" class = "btn btn-danger"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
				</div>
				<div class = "panel-body">
					<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
						<div class = "form-inline">
							<label for = "firstname">Name:</label>
							<input class = "form-control" name = "name" type = "text" required = "required">
							&nbsp;&nbsp;&nbsp;
							<label for = "lastname">Price:</label>
							<input class = "form-control" name = "price" type = "text" required = "required">
						</div>
						<br />
						<div class = "form-inline">
							<label for = "gender">Type:</label>
							<select class = "form-control" name = "type" required = "required">
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
							<button class = "btn btn-primary" name = "save_service_item"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
						</div>
					</form>
				</div>	
			</div>	

			<?php require '../add_patient.php';?>

			<div  id = "a_table" class="panel panel-default">
				<div class = "panel-heading">
					<label>SERVICE ITEM LIST</Label>
					<a href = "master.php" class = "btn btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
				</div>
				<div class = "panel-body">
					<button id = "show_itr" class = "btn btn-info"><span class = "glyphicon glyphicon-plus"></span> ADD SERVICE ITEM</button>
					<br />
					<br />
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Item ID</th>
								<th>Name</th>
								<th>Price</th>
								<th>Type</th>
								<th><center>Action</center></th>
							</tr>
						</thead>
						<tbody>
						<?php
						include('../db/config.php'); 
						$query = $conn->query("SELECT * FROM `item` ORDER BY `item_id` DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
						$id = $fetch['item_id'];
						?>
							<tr>
								<td><?php echo $fetch['item_id']?></td>
								<td><?php echo $fetch['name']?></td>
								<td><?php echo $fetch['price']?></td>
								<td><?php echo $fetch['type']?></td>				
								<td><center>
								<a href = "edit_item.php?id=<?php echo $fetch['item_id']?>" class = "btn btn-warning" title="Update"><span class = "glyphicon glyphicon-pencil"></span></a>
								
								<a href = "delete_item.php?id=<?php echo $fetch['item_id']?>" class = "btn btn-danger" title="Delete"><span class = "glyphicon glyphicon-trash"></span></a> 	
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
