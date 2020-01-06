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
                   
				<div class = "panel panel-success">	
					<div class = "panel-heading">
						<label>EDIT SERVICE CHARGE</label>
						<a href = "consultation.php" class = "btn btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
					</div>
					<div class = "panel-body">
		            <form id = "form_dental" method = "POST" enctype = "multipart/form-data">
							<!-- <input type="text" name="city" size="30" class="city" placeholder="Please Enter City or ZIP code"> -->
							<div class = "form-inline">
								<?php
									$a = $conn->query("SELECT * FROM `user` WHERE `user_id`='$_SESSION[user_id]' ") or die(mysqli_error());
									$aa = $a->fetch_array();

									$query = $conn->query("SELECT * FROM `service` WHERE `service_id`='$_GET[id]' ") or die(mysqli_error());
									$fetch = $query->fetch_array();
		                            $patient_id = $fetch['patient_id'];
		                            $doc_id = $fetch['doctor_id'];
		                            $item_id = $fetch['item_id'];

		                            $q = $conn->query("SELECT * FROM `itr` WHERE `itr_no`='$patient_id' ") or die(mysqli_error());
									$f = $q->fetch_array();

									$d = $conn->query("SELECT * FROM `doctors` WHERE `doc_id`= '$doc_id' ") or die(mysqli_error());
									$doc = $d->fetch_array();

									$i = $conn->query("SELECT * FROM `item` WHERE `item_id`='$item_id' ") or die(mysqli_error());
									$item = $i->fetch_array();
								?>
								<input name = "service_id" type = "hidden"  value = "<?php echo $fetch['service_id']?>">
								<input name = "old_service_id" type = "hidden"  value = "<?php echo $_GET['id']?>">
								<input class = "form-control" name = "cashier" type = "hidden"  value = "<?php echo $aa['lastname']?>">
								<label for = "firstname">Patient No:</label>
								<input size="30" type="text" name="patient" class="patient" placeholder="Please Enter number or name" required="required" value="<?php echo $patient_id?>">
								&nbsp;&nbsp;&nbsp;
								<label for = "firstname">Doctor:</label>
								<select name = "doc" class = "form-control" required = "required" style="margin-top:7px">
									<option value = "<?php echo $doc['doc_id']; ?>"><?php echo $doc['name'];?></option>
									<option value = "">Select doctor</option>
		                            <?php
										$query = $conn->query("SELECT * FROM `doctors` ") or die(mysqli_error());
										while($row = $query->fetch_array()){
										$doc_id = $row['doc_id'];
										?>
										<option value = "<?php echo $doc_id; ?>"><?php echo $row['name']; ?></option>
										<?php
									    }		
									?>
								</select>
		                        &nbsp;&nbsp;&nbsp;
								<label for = "bp">Payment:</label>
							    <select name = "payment" class = "form-control" required = "required" style="margin-top:7px">
							    	<option value = "<?php echo $fetch['payment']?>"><?php echo $fetch['payment']?></option>
									<option value = "">Select mode</option>
		                            <option value = "Cash">Cash</option>
		                            <option value = "Cheque">Cheque</option>
		                            <option value = "Bank_Transfer">Bank Transfer</option>
								</select>
							</div>
						    <br><br>
							<div class = "form-inline">
								<label for = "firstname">ITEM:</label>
								<select id="item" name = "item" class = "form-control" required = "required">
									<option value = "<?php echo $item['item_id']?>"><?php echo $item['name']?></option>
									<option value = "">Select item</option>
		                            <?php
										$query = $conn->query("SELECT * FROM `item` WHERE `type`='consultation' ") or die(mysqli_error());
										while($row = $query->fetch_array()){
										$item_id = $row['item_id'];
										?>
										<option value = "<?php echo $item_id?>"><?php echo $row['name']; ?></option>
										<?php
									    }
									    $conn->close();
									?>
								</select>
								&nbsp;&nbsp;&nbsp;
								<label for = "temp">Qty:</label>
								<input class = "form-control" id="qty" name = "qty" type = "text" required = "required" onkeyup="myFunction(this.value)"  value="<?php echo $fetch['qty']?>" style="width:6%">
								&nbsp;&nbsp;&nbsp;
								<label for = "pr">Price:</label>
								<input class = "form-control" id="price" name = "price" type = "text" required = "required" onkeyup="myPrice(this.value)"  value="<?php echo $fetch['price']?>"  style="width:10%">
								&nbsp;&nbsp;&nbsp;
								<label for = "rr">Amt:</label>
								<input class = "form-control" id="amount" name = "amount" type = "text"  required = "required"   value="<?php echo $fetch['amount']?>" style="width:10%" readonly="readonly">
								&nbsp;&nbsp;&nbsp;
								<label for = "rr">Paid:</label>
								<input class = "form-control" id="paid" name = "paid" type = "text"  required="required"  value="<?php echo $fetch['paid']?>" style="width:10%">
							</div>
							<br /><br />
							<div class = "form-inline">
								<button class = "btn btn-primary" name = "edit_consultation"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
							</div>
							<?php require_once 'edit_query.php';?>
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
