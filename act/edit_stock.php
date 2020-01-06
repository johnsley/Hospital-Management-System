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
                <br />
				<div class = "panel panel-success">	
					<div class = "panel-heading">
						<label>STOCK INFORMATION / EDIT</label>
						<a style = "float:right; margin-top:-4px;" href = "stock.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
					</div>
					<div class = "panel-body">
					<?php
						$q = $conn->query("SELECT * FROM `stock` WHERE `id` = '$_GET[id]' ") or die(mysqli_error());
						$f = $q->fetch_array();
					?>
					<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
						<div class = "form-inline">
							<label>Item:</label>
							<input class = "form-control" name = "item" type = "text" value = "<?php echo $f['item']?>">
                            <input class = "hidden" name = "item_id" type = "item_id" value = "<?php echo $f['id']?>">
                             &nbsp;&nbsp;&nbsp;
							<label for = "lastname">BP:</label>
							<input class = "form-control" name = "bp" type = "text" value = "<?php echo $f['bp']?>">
							&nbsp;&nbsp;&nbsp;
							<label for = "phone">SP:</label>
						    <input class = "form-control" name = "sp" type = "text" value = "<?php echo $f['sp']?>">
						    &nbsp;&nbsp;&nbsp;
						    <label for = "phone">Stock:</label>
							<input class = "form-control" name = "gty" type = "text" value = "<?php echo $f['quantity']?>">
							<br><br>
                            <label for = "phone">Used:</label>
                            <input class = "form-control" name = "used" type = "text" value = "<?php echo $f['used']?>">
                            &nbsp;&nbsp;&nbsp;
                            <label for = "phone">Rem:</label>
                            <input class = "form-control" name = "rem" type = "text" value = "<?php echo $f['rem']?>">
                            &nbsp;&nbsp;&nbsp;
							<button class = "btn btn-primary" name = "edit_save_medicine"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
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
