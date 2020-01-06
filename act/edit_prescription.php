<?php require_once 'header.php';?>
	<div id = "content">
		<br />
		<br />
		<div class = "panel panel-success">	
			<div class = "panel-heading">
				<label>PRESCRIPTION INFORMATION / EDIT</label>
				<a style = "float:right; margin-top:-4px;" href = "prescription.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
			<div class = "panel-body">
			<?php
				include('../db/config.php'); 
				$q = $conn->query("SELECT * FROM `prescription` WHERE `id` = '$_GET[id]' ") or die(mysqli_error());
				$f = $q->fetch_array();
				$itr_no = $f['patient_id'];
                $doc_id = $f['doctor_id'];
                $med_id = $f['med_id'];


                $p = $conn->query("SELECT * FROM `itr` WHERE `itr_no` = '$itr_no' ") or die(mysqli_error());
                $pp = $p->fetch_array();

                $d = $conn->query("SELECT * FROM `doctors` WHERE `doc_id` = '$doc_id'") or die(mysqli_error());
                $dd = $d->fetch_array();

                $m = $conn->query("SELECT * FROM `item` WHERE `item_id` = '$med_id'") or die(mysqli_error());
                $mm = $m->fetch_array();
			?>


			<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
					<div class = "form-inline">
						<label for = "firstname">Drugs:</label>
						<input name = "presid" type = "hidden" value = "<?php echo $_GET['id']?>">
						<select class = "form-control" name = "med_id" required = "required">
							<option value="<?php echo $mm['item_id']?>"><?php echo $mm['name']?></option>
							<option value="">Select drugs</option>
							<?php
								include('../db/config.php'); 
								$query = $conn->query("SELECT * FROM `item` WHERE `type` = 'medicine' ") or die(mysqli_error());
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
						<label for = "lastname">Patient:</label>
						<select class = "form-control" name = "patient_id" required = "required">
							<option value="<?php echo $pp['itr_no']?>"><?php echo $pp['firstname'].' '.$pp['lastname']?></option>
							<option value="">Select patient</option>
							<?php
								include('../db/config.php'); 
								$query = $conn->query("SELECT * FROM `itr` ") or die(mysqli_error());
								while($row = $query->fetch_array()){
								$itr_no = $row['itr_no'];
								?>
								<option value = "<?php echo $itr_no?>"><?php echo $row['firstname'].' '.$row['lastname']; ?></option>
								<?php
							    }
							    $conn->close();
							?>
						</select>
						&nbsp;&nbsp;&nbsp;
						<label for = "lastname">Doctor:</label>
						<select class = "form-control" name = "doc_id" required = "required">
							<option value="<?php echo $dd['doc_id']?>"><?php echo $dd['name']?></option>
							<option value="">Select doctor</option>
							<?php
								include('../db/config.php'); 
								$query = $conn->query("SELECT * FROM `doctors` ") or die(mysqli_error());
								while($row = $query->fetch_array()){
								$doc_id = $row['doc_id'];
								?>
								<option value = "<?php echo $doc_id; ?>"><?php echo $row['name']; ?></option>
								<?php
							    }
							    $conn->close();
							?>
						</select>
						
					</div>
					<br />
					<div class = "form-inline">
						<button class = "btn btn-primary" name = "edit_save_prescription"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
					</div>
				</form>
			<?php require_once 'edit_query.php';?>
			</div>	
		</div>	
	</div>
	<?php include 'footer.php';?> 
	<script type = "text/javascript"> 
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }
    });
</script>	
</body>
</html>