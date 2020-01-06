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
					<label>ADD SERVICE CHARGE</label>
					<button id = "hide_itr" style = "float:right; margin-top:-4px;" class = "btn btn-danger"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
				</div>
				<div class = "panel-body">
					<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
						<div class = "col-sm-12" style="padding:0px;padding-top: 1%">
							<?php
								$a = $conn->query("SELECT * FROM `user` WHERE `user_id`='$_SESSION[user_id]' ") or die(mysqli_error());
								$aa = $a->fetch_array();
							?>
							<div class="col-sm-6">
							<input name = "category" type = "hidden"  value = "dental">
							<input name = "cashier" type = "hidden"  value = "<?php echo $aa['lastname']?>">
							<label for = "firstname">Patient Name:</label>
							<input size="30" type="text" name="patient" class="patient" placeholder="Please Enter number or name" required="required">
						    </div>
							<div class="col-sm-3">
							<label for = "firstname">Doctor:</label>
							<select name = "doc" required = "required"  style="padding: 5px">
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
						    </div>
	                        <div class="col-sm-3  text-right">
							<label for = "bp">Payment Mode</label>
						    <select name = "payment" required = "required" style="padding: 5px">
								<option value = "">Select</option>
	                            <option value = "Cash">Cash</option>
	                            <option value = "mpesa">Mpesa</option>
	                            <option value = "Bank_Transfer">Bank Transfer</option>
							</select>
						    </div>
						</div>
					    <br><br>
					    <div class="col-sm-12" style="padding:0px;padding-top: 2%">
					    	<div class="col-sm-5">
					    		<label for = "firstname">ITEM</label><br>
								<select id="item" name = "item" required = "required" style="width:100%;padding: 5px">
									<option value = "">Select item</option>
		                            <?php
										$query = $conn->query("SELECT * FROM `item` WHERE `type`='dental' ") or die(mysqli_error());
										while($row = $query->fetch_array()){
										$item_id = $row['item_id'];
										?>
										<option value = "<?php echo $item_id;?>"><?php echo $row['name']; ?></option>
										<?php
									    }
									?>
								</select>
					    	</div>
					    	<div class="col-sm-1">
					    		<label for = "temp">Qty</label><br>
							    <input id="qty" name = "qty" type = "text" required = "required" onkeyup="myFunction(this.value)"  value="1" style="width:100%;padding: 3px">
					    	</div>
					    	<div class="col-sm-2">
					    		<label for = "pr">Price</label>
							    <input id="price" name = "price" type = "text" required = "required" onkeyup="myPrice(this.value)" style="width:100%;padding: 3px">
					    	</div>
					    	<div class="col-sm-2">
					    		<label for = "rr">Amt</label>
							    <input id="amount" name = "amount" type = "text"  required = "required" readonly="readonly" style="width:100%;padding: 3px">
					    	</div>
					    	<div class="col-sm-2">
					    		<label for = "rr">Paid</label>
							    <input id="paid" name = "paid" type = "text"  required="required" style="width:100%;padding: 3px">
					    	</div>
					    </div>
						
						<div class="hidden">
						<br /><br />
						<div class="col-sm-12" style="padding:0px;padding-top: 2%">
					    	<div class="col-sm-5">
								<select id="item2" name = "item2" style="width:100%;padding: 5px">
									<option value = "">Select item</option>
		                            <?php
										$query = $conn->query("SELECT * FROM `item` WHERE `type`='dental' ") or die(mysqli_error());
										while($row = $query->fetch_array()){
										$item_id = $row['item_id'];
										?>
										<option value = "<?php echo $item_id;?>"><?php echo $row['name']; ?></option>
										<?php
									    }
									?>
								</select>
					    	</div>
					    	<div class="col-sm-1">
							    <input id="qty2" name = "qty2" type = "text" onkeyup="myFunction2(this.value)"  value="1" style="width:100%;padding: 3px">
					    	</div>
					    	<div class="col-sm-2">
							    <input id="price2" name = "price2" type = "text" onkeyup="myPrice2(this.value)" style="width:100%;padding: 3px">
					    	</div>
					    	<div class="col-sm-2">
							    <input id="amount2" name = "amount2" type = "text" readonly="readonly" style="width:100%;padding: 3px">
					    	</div>
					    	<div class="col-sm-2">
							    <input id="paid2" name = "paid2" type = "text"  style="width:100%;padding: 3px">
					    	</div>
					    </div>
					    <br><br>

					    <div class="col-sm-12" style="padding:0px;padding-top: 2%">
					    	<div class="col-sm-5">
								<select id="item3" name = "item3" style="width:100%;padding: 5px">
									<option value = "">Select item</option>
		                            <?php
										$query = $conn->query("SELECT * FROM `item` WHERE `type`='dental' ") or die(mysqli_error());
										while($row = $query->fetch_array()){
										$item_id = $row['item_id'];
										?>
										<option value = "<?php echo $item_id;?>"><?php echo $row['name']; ?></option>
										<?php
									    }
									?>
								</select>
					    	</div>
					    	<div class="col-sm-1">
							    <input id="qty3" name = "qty3" type = "text" onkeyup="myFunction3(this.value)"  value="1" style="width:100%;padding: 3px">
					    	</div>
					    	<div class="col-sm-2">
							    <input id="price3" name = "price3" type = "text" onkeyup="myPrice3(this.value)" style="width:100%;padding: 3px">
					    	</div>
					    	<div class="col-sm-2">
							    <input id="amount3" name = "amount3" type = "text" readonly="readonly" style="width:100%;padding: 3px">
					    	</div>
					    	<div class="col-sm-2">
							    <input id="paid3" name = "paid3" type = "text" style="width:100%;padding: 3px">
					    	</div>
					    </div>
						</div>
					    <br><br>

						<div class = "col-am-12" style="padding-top: 9%">
							<div class="col-sm-12">
							<button class = "btn btn-primary" name = "save_charges"><span class = "glyphicon glyphicon-save"></span> SAVE</button></div>
						</div>
					</form>
				</div>	
			</div>

			<?php require '../add_patient.php';?>

			<div class="panel panel-warning text-center" style="font-size:1.2em;padding: 10px">
			<a id = "show_itr">&nbsp;<img src="images/patient.jpg" style="width: 50px;height: 50px"> <strong>Add Patient Dental</strong></a>
			</div>
			<div  id = "a_table" class="panel panel-default">
				<div class = "panel-body">
					<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>Date</th>
								<th>ITR No</th>
								<th>Name</th>
								<th>Age</th>
								<th>Doctor</th>
								<th>Service</th>
								<th>Cashier</th>
								<th><center>Select</center></th>
							</tr>
						</thead>
						<tbody>
						<?php
	                        $query = $conn->query("SELECT * FROM `service` WHERE `category` = 'dental' ORDER BY `date` DESC") or die(mysqli_error());
	                        while($fetch = $query->fetch_array()){
	                        	$patient_id = $fetch['patient_id'];
	                        	$doc_id = $fetch['doctor_id'];
	                        	$item_id = $fetch['item_id'];
	                        	$service_id = $fetch['service_id'];
	                            $p1 = $conn->query("SELECT * FROM `itr` WHERE `itr_no`='$patient_id' ") or die(mysqli_error());
	                            $p11 = $p1->fetch_array();
	                            $d1 = $conn->query("SELECT * FROM `doctors` WHERE `doc_id`='$doc_id' ") or die(mysqli_error());
	                            $d11 = $d1->fetch_array();
	                            $t1 = $conn->query("SELECT * FROM `item` WHERE `item_id`='$item_id' ") or die(mysqli_error());
	                            $t11 = $t1->fetch_array();
	                            $xquery = $conn->query("SELECT * FROM `dentalreps` WHERE `service_id`='$service_id' ") or die(mysqli_error());
	                            $xfetch = $xquery->num_rows;              
	                         ?>
							<tr>
								<?php
                                if($fetch['reversal'] == 'R'){
                                ?>
                                <td style="color:red"><?php echo $fetch['date']?></td>
								<td style="color:red"><?php echo $p11['itr_no']?></td>
								<td style="color:red"><?php echo  $p11['firstname']." ".$p11['lastname']?></td>
								<td style="color:red"><?php echo $p11['age']?></td>				
								<td style="color:red"><?php echo $d11['name']?></td>				
								<td style="color:red"><?php echo $t11['name']?></td>
								<td style="color:red"><?php echo $fetch['cashier']?></td>
								<td style="color:red"><center>Reversed</center></td>
                                <?php
                                }else{
                                ?>
                                <td><?php echo $fetch['date']?></td>
								<td><?php echo $p11['itr_no']?></td>
								<td><?php echo  $p11['firstname']." ".$p11['lastname']?></td>
								<td><?php echo $p11['age']?></td>				
								<td><?php echo $d11['name']?></td>				
								<td><?php echo $t11['name']?></td>
								<td><?php echo $fetch['cashier']?></td>
								<td><center>
								<a href = "service_mid_print.php?itr_no=<?php echo $fetch['patient_id'];?>&ser_id=<?php echo $fetch['service_id'];?>" class = "btn btn-sm btn-default" target="_blank">RECEIPT</a>
								<a onclick = "reverse(this); return false;" href = "reversal.php?id=<?php echo $fetch['service_id']?>" class = "btn btn-sm btn-default">REVERSE</a>
                                <?php
                                 if($xfetch > 0){
                                  ?>
                                   <a href = "edit_dental.php?id=<?php echo $fetch['service_id']?>" class = "btn btn-sm btn-default" style="color:red;border:2px solid red;font-size: 0.9em">EDIT</a>
                                  <?php
                                 }else{
                                   ?>
                                  <a href = "edit_dental.php?id=<?php echo $fetch['service_id']?>" class = "btn btn-sm btn-default" title="Adjust">EDIT</a>
                                  <?php
                                 }
                                 ?>
                                <a href = "dentalreport.php?id=<?php echo $fetch['service_id']?>" class = "btn btn-sm btn-default">REPORT</a>
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
    <script type = "text/javascript">
		function reverse(that){
			var delete_func = confirm("Proceede with Transaction Reversal?")
			if(delete_func){
				window.location = anchor.attr("href");
			}
		}
	</script>
</body>
</html>
