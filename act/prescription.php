<?php require_once 'header.php';?>
	<div id = "content">
		<br />
		<br />
		<div style = "display:none;" id = "add_itr" class = "panel panel-success">	
			<div class = "panel-heading">
				<label>ADD PRESCRIPTION</label>
				<button id = "hide_itr" style = "float:right; margin-top:-4px;" class = "btn btn-sm btn-danger"><span class = "glyphicon glyphicon-remove"></span> CLOSE</button>
			</div>
			<div class = "panel-body">
				<form id = "form_dental" method = "POST" enctype = "multipart/form-data">
					<div class = "form-inline">
						<label for = "firstname">Drugs:</label>
						<select class = "form-control" name = "med_id" required = "required">
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
						<button class = "btn btn-primary" name = "save_prescription"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
					</div>
				</form>
			</div>	
		</div>	
		<?php require '../add_patient.php';?>
		<div class = "panel panel-primary">
			<div class = "panel-heading">
				<label>VIEW PRESCRIPTION LIST</Label>
			</div>
			<div class = "panel-body">
				<button id = "show_itr" class = "btn btn-info"><span class = "glyphicon glyphicon-plus"></span> ADD PRESCRIPTION</button>
				<br />
				<br />
				<table id = "table" class = "display" width = "100%" cellspacing = "0">
					<thead>
						<tr>
							<th>ID</th>
							<th>Date</th>
							<th>Name</th>
							<th>Patient</th>
							<th>Doctor</th>
							<th><center>Action</center></th>
						</tr>
					</thead>
					<tbody>
					<?php
						include('../db/config.php'); 
						$query = $conn->query("SELECT * FROM `prescription` ORDER BY `id` DESC") or die(mysqli_error());
						while($fetch = $query->fetch_array()){
                        $itr_no = $fetch['patient_id'];
                        $doc_id = $fetch['doctor_id'];
                        $med_id = $fetch['med_id'];

						$p = $conn->query("SELECT * FROM `itr` WHERE `itr_no` = '$itr_no' ") or die(mysqli_error());
                        $pp = $p->fetch_array();

                        $d = $conn->query("SELECT * FROM `doctors` WHERE `doc_id` = '$doc_id'") or die(mysqli_error());
                        $dd = $d->fetch_array();

                        $m = $conn->query("SELECT * FROM `item` WHERE `item_id` = '$med_id'") or die(mysqli_error());
                        $mm = $m->fetch_array();
					?>
						<tr>
							<td><?php echo $fetch['id']?></td>
							<td><?php echo $fetch['date']?></td>
							<td><?php echo $mm['name']?></td>
							<td><?php echo $pp['firstname'].' '.$pp['lastname']?></td>				
							<td><?php echo $dd['name']?></td>				
							<td><center>
							<a href = "edit_prescription.php?id=<?php echo $fetch['id']?>" class = "btn btn-sm btn-warning" title="Update"><span class = "glyphicon glyphicon-pencil"></span> UPDATE</a>
							<a href = "delete_pres.php?id=<?php echo $fetch['id']?>" class = "btn btn-sm btn-danger"><span class = "glyphicon glyphicon-trash"></span> DELETE</a>
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