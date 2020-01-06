<?php
    require_once 'session.php';
    require_once '../db/config.php';
   if(isset($_SESSION['user_id']) && $_SESSION['user_group'] <=2 || $_SESSION['user_group'] == 4){
     }else{
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
               <div class = "well">
				<br>
				<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
					<!-- <input type="text" name="city" size="30" class="city" placeholder="Please Enter City or ZIP code"> -->
					<div class = "form-inline">
					
						<label for = "firstname">Patient Name:</label>
						<input class="form-control" type="text" name="patient">
						&nbsp;&nbsp;&nbsp;
						<label for = "firstname">Phone Number:</label>
						<input class="form-control" type="text" name="phone">
						&nbsp;&nbsp;&nbsp;
						<label for = "firstname">Service:</label>
						<input class="form-control" type="text" name="service">
					    <br><br>
					    <label for = "bp">Price:</label>
					    <input class="form-control" type="text" name="price">
					    &nbsp;&nbsp;&nbsp;
					    <label for = "bp">Payment Mode</label>
					    <select class="form-control" name = "payment" required = "required" style="padding: 5px">
							<option value = "">---Select Mode---</option>
	                        <option value = "cash">Cash</option>
	                        <option value = "mpesa">Mpesa</option>
						</select>
						&nbsp;&nbsp;&nbsp;
						<select class="form-control" id="category" name="category" required="required">
			                <option value="">---Select Department---</option>
			                <option value = "consultation">Consultation</option>
			                <option value = "radiology">Radiology</option>
			                <option value = "pharmacy">Pharmacy</option>
			                <option value = "physiotherapy">Physiotherapy</option>
			                <option value = "maternity">Maternity</option>
			                <option value = "laboratory">Laboratory</option>   
			             </select>
					     &nbsp;&nbsp;&nbsp;
					    <button class = "btn btn-primary" name = "save_outpatient"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
					</div>
				</form> 
				<br>
			</div>	
			
			<?php require '../add_patient.php';?>

			<div  id = "a_table" class="panel panel-default">
				<div class = "panel-heading">
					<label>PATIENT LIST</Label>
				</div>
				<div class = "panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Date</th>
								<th>Name</th>
								<th>Phone</th>
								<th>Service</th>
								<th>Price</th>
								<th>Mode</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
						include('../db/config.php'); 
                        $query = $conn->query("SELECT * FROM `outpatient` ORDER BY `date` DESC") or die(mysqli_error());
                        while($fetch = $query->fetch_array()){                     
                         ?>
						<tr>
							<td><?php echo $fetch['date']?></td>
							<td><?php echo $fetch['name']?></td>
							<td><?php echo $fetch['phone']?></td>
							<td><?php echo $fetch['service']?></td>
							<td><?php echo $fetch['price']?></td>
							<td><?php echo $fetch['payment']?></td>
							<td>
							<a href = "outpatient_print.php?id=<?php echo $fetch['id'];?>" class = "btn btn-primary" ><span class = "glyphicon glyphicon-print"></span> RECEIPT </span></a>
							<?php
                                if(isset($_SESSION['user_id']) && $_SESSION['user_group'] ==1){
                                ?>
                                <a href = "edit_outpatient.php?id=<?php echo $fetch['id'];?>" class = "btn btn-warning"><span class = "glyphicon glyphicon-pencil"></span> EDIT</a>
                                <?php
                                }
								?>
							
							</td>	
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
            responsive: true,
            "ordering": false
        });
       })
    </script>	
</body>
</html>
