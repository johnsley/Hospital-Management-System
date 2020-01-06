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
          <!--  -->
            <div class="row">
                <div class="col-lg-12">
                	<!-- hidden table -->
                	<div style = "display:none;" id = "add_itr" class = "panel panel-success">	
						<div class = "panel-heading">
							<label>ADD PATIENT INFORMATION</label>
							<button id = "hide_itr" style = "float:right; margin-top:-4px;" class = "btn btn-danger"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
						</div>
						<div class = "panel-body">
							<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
								<div class = "form-inline">
									<label for = "firstname">Firstname:</label>
									<input class = "form-control" name = "firstname" type = "text" required = "required">
									&nbsp;&nbsp;&nbsp;
									<label for = "lastname">Lastname:</label>
									<input class = "form-control" name = "lastname" type = "text" required = "required">
								</div>
								<br />
								<div class = "form-inline">
									<label for = "phone">Phone No:</label>
									<input class = "form-control" name = "phone" type = "text">
									&nbsp;&nbsp;&nbsp;
									<label for = "age">Age:</label>
									<input class = "form-control" name = "age" type = "text">
								</div>
								<br>
								<div class = "form-inline">
									<label for = "address">Address:</label>
									<input class = "form-control" name = "address" type = "text">
									<label for = "gender">Gender:</label>
									<select class = "form-control" name = "gender" required = "required">
										<option value = "">--Please select an option--</option>
										<option value = "Male">Male</option>
										<option value = "Female">Female</option>
									</select>
										<label for = "address">NHIF No.:</label>
									<input class = "form-control" name = "nhif" type = "text">
								</div>
								<br />
								<div class = "form-inline">
									<button class = "btn btn-primary" name = "save_patient"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
								</div>
							</form>
						</div>	
					</div>	
					<?php require '../add_patient.php';?>
                    <!-- end of hidden table -->
                    <div  id = "a_table" class="panel panel-default">
                        <div class="panel-heading">
                           Accounts / Patients List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<button id = "show_itr" class = "btn btn-info"><span class = "glyphicon glyphicon-plus"></span> ADD PATIENT</button>
							<br />
							<br />
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Date</th>
										<th>ITR No</th>
										<th>Name</th>
										<th>Phone</th>
										<th>Age</th>
										<th>NHIF No.</th>
										<th>Address</th>
										<th><center>Action</center></th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
						
										$query = $conn->query("SELECT * FROM `itr` ORDER BY `date` DESC") or die(mysqli_error());
										while($fetch = $query->fetch_array()){
										$id = $fetch['itr_no'];
										$q = $conn->query("SELECT COUNT(*) as total FROM `complaints` where `itr_no` = '$id' && `status` = 'Pending'") or die(mysqli_error());
										$f = $q->fetch_array();
									?>
										<tr>
											<td><?php echo $fetch['date']?></td>
											<td><?php echo $fetch['itr_no']?></td>
											<td><?php echo $fetch['firstname']." ".$fetch['lastname']?></td>
											<td><?php echo $fetch['phone']?></td>				
											<td><?php echo $fetch['age']?></td>
											<td><?php echo $fetch['nhif']?></td>
											<td><?php echo $fetch['address']?></td>
											<td><center>
											<a href = "edit_patient.php?id=<?php echo $fetch['itr_no']?>&lastname=<?php echo $fetch['lastname']?>" class = "btn btn-warning" title="Update"><span class = "glyphicon glyphicon-pencil"></span></a>

                                            <?php
                                            if(isset($_SESSION['user_id']) && $_SESSION['user_group'] ==1){
                                            ?>
                                            <a href = "delete_patient.php?id=<?php echo $fetch['itr_no']?>" class = "btn btn-danger" title="Delete"><span class = "glyphicon glyphicon-trash"></span></a>
                                            <?php
                                            }
                                            ?>	
										    </center></td>
										</tr>
									<?php
										}
										
									?>
                                 
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                </div>
                <!-- /.col-lg-12 -->
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
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true,
            "ordering": false
        });

        $('.activity_id').on('click', function(){
            $activity_id = $(this).attr('name');
            $('.delete_activity').on('click', function(){
                window.location = 'delete_activity.php?activity_id=' + $activity_id;
            });
        })
    });
    </script>
</body>
</html>
