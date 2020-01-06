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
            format: 'YYYY-MM-DD hh:mm'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker3').datetimepicker({
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
	           <div class="col-lg-12">
	            <div style = "display:none;" id = "add_itr" class = "panel panel-success">	
				<div class = "panel-heading">
					<label>MAKE PAYMENT</label>
					<button id = "hide_itr" style = "float:right; margin-top:-4px;" class = "btn btn-sm btn-danger"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
				</div>
				<div class = "panel-body">
					<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
						<div class = "form-inline">
							<label>Payment to:</label>
							<input class = "form-control" name = "payee" type = "text" placeholder="Enter name" required = "required">
							&nbsp;&nbsp;&nbsp;
							<label>Paid on:</label>
							<span class='input-group date' id='datetimepicker'>
								<input class = "form-control" name = "date" type = "text" placeholder="Enter date" required = "required">
								<span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
							</span>
							&nbsp;&nbsp;&nbsp;
							<label>Paid Amount:</label>
							<input class = "form-control" name = "amount" type = "text" placeholder="Enter amount" required = "required">
						</div>
						<br />
						<label>Payment Description:</label>
						<input class = "form-control" name = "desc" type = "text" placeholder="Payment for">
						<br>
						<div class = "form-inline">
							<button class = "btn btn-primary" name = "save_payment"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
						</div>
					</form>
				</div>	
			</div>

			<?php require '../add_patient.php';?>

			<div  id = "a_table" class="panel panel-default">
				<div class = "panel-body">
					<button id = "show_itr" class = "btn btn-info" style="float:left">ADD PETTY CASH</button>
					<br /><br /><br />
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Paid on</th>
								<th>Paid to</th>
								<th>Description</th>
								<th>Amount</th>
								<th><center>Action</center></th>
							</tr>
						</thead>
						<tbody>
						<?php
						include('../db/config.php'); 
						$query = $conn->query("SELECT * FROM `payment` ORDER BY `date` DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
						$id = $fetch['id'];
						?>
							<tr>
								<td><?php echo ($fetch['reversed'] == 'R' ? '<span style="color:red">'.$fetch['date'].'</span>':$fetch['date']) ;?></td>
								<td><?php echo ($fetch['reversed'] == 'R' ? '<span style="color:red">'.$fetch['name'].'</span>':$fetch['name']) ;?></td>
								<td><?php echo ($fetch['reversed'] == 'R' ? '<span style="color:red">'.$fetch['description'].'</span>':$fetch['description']) ;?></td>
								<td><?php echo ($fetch['reversed'] == 'R' ? '<span style="color:red">'.$fetch['amount'].'</span>':$fetch['amount']) ;?></td>
								<?php
                                if($fetch['reversed'] == 'R'){
                                	echo "<td></td>";
                                }else{
                                ?>
                                <td><center>
								<a onclick = "reverse(this); return false;" href = "payreversal.php?id=<?php echo $fetch['id']?>" class = "btn btn-primary">REVERSE</a>	
							    </center></td>
                                <?php
                                }
								?>				
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
