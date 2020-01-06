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

                <div style = "display:none;" id = "add_itr" class = "panel panel-success">	
				<div class = "panel-heading">
					<label>ADD STOCK</label>
					<button id = "hide_itr" style = "float:right; margin-top:-4px;" class = "btn btn-sm btn-danger"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
				</div>
				<div class = "panel-body">
					<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
						<div class = "form-inline">
							<label>Item:</label>
							<input class = "form-control" name = "item" type = "text" required = "required">
							&nbsp;&nbsp;&nbsp;
							<label for = "lastname">BP:</label>
							<input class = "form-control" name = "bp" type = "number" required = "required">
							&nbsp;&nbsp;&nbsp;
							<label for = "phone">SP:</label>
						    <input class = "form-control" name = "sp" type = "number" required = "required">
						    &nbsp;&nbsp;&nbsp;
						    <label for = "phone">Qty:</label>
							<input class = "form-control" name = "gty" type = "number" required = "required">
							&nbsp;&nbsp;&nbsp;
							<button class = "btn btn-primary" name = "save_medicine"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
						</div>
					</form>
				</div>	
			</div>	

			<?php require '../add_patient.php';?>

			<div  id = "a_table" class="panel panel-default">
				<div class = "panel-heading">
				<label>Stock List</Label>
			    </div>
				<div class = "panel-body">
					<button id = "show_itr" class = "btn btn-info"><span class = "glyphicon glyphicon-plus"></span> ADD STOCK</button>
					<br />
					<br />
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Date</th>
								<th>Item</th>
								<th>BP</th>
								<th>*</th>
								<th>SP</th>
								<th>*</th>
								<th>ExPro</th>
								<th>Stock</th>
								<th>Used</th>
								<th>Rem</th>
								<th><center>Action</center></th>
							</tr>
						</thead>
						<tbody>
						<?php
						$totalbp = 0;
						$totalsp = 0;
						$totaldiff = 0;
						$query = $conn->query("SELECT * FROM `stock` ORDER BY `id` DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){

                            $totalbp += $fetch['bp'] * $fetch['quantity'];
                            $totalsp += $fetch['sp'] * $fetch['quantity'];
						?>
							<tr>
								<td><?php echo $fetch['date']?></td>
								<td><?php echo $fetch['item']?></td>
								<td><?php echo $fetch['bp']?></td>
								<td><?php echo "<b>".$fetch['bp'] * $fetch['quantity']."</b>"?></td>
								<td><?php echo $fetch['sp']?></td>
								<td><?php echo "<b>".$fetch['sp'] * $fetch['quantity']."</b>"?></td>
								<td>
								<?php 
                                $sptotal = $fetch['sp'] * $fetch['quantity'];
                                $bptotal = $fetch['bp'] * $fetch['quantity'];
                                $diff = $sptotal - $bptotal;
                                $totaldiff += $diff; 
								echo "<b>".$diff."</b>";
								?></td>
								<td><?php echo $fetch['quantity']?></td>				
								<td><?php echo $fetch['used']?></td>				
								<td><?php echo $fetch['rem']?></td>
								<td><center>
								<a href = "minus_stock.php?id=<?php echo $fetch['id']?>" class = "btn btn-primary" title="Add Used">Add used</a>
								<a href = "edit_stock.php?id=<?php echo $fetch['id']?>" class = "btn btn-warning" title="Update"><span class = "glyphicon glyphicon-pencil"></span></a>
								<a href = "delete_stock.php?id=<?php echo $fetch['id']?>" class = "btn btn-sm btn-danger"><span class = "glyphicon glyphicon-trash"></span></a>
							    </center></td>
							</tr>
						<?php
							}
							$conn->close();
						?>
							
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3" style="font-weight:bold">Total</td>
								<td style="font-weight:bold"><?php echo $totalbp?></td>
								<td></td>
								<td style="font-weight:bold"><?php echo $totalsp?></td>
								<td style="font-weight:bold"><?php echo $totaldiff?></td>
								<td colspan="4"></td>
							</tr>
						</tfoot>
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
