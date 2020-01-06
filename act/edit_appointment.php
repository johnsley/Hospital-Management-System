<?php require_once 'header.php';?>
	<div id = "content">
		<br />
		<br />
		<div class = "panel panel-success">	
			<div class = "panel-heading">
				<label>APPOINTMENT INFORMATION / EDIT</label>
				<a style = "float:right; margin-top:-4px;" href = "Appointment.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
			<div class = "panel-body">
			<?php
				include('../db/config.php'); 
				$q = $conn->query("SELECT * FROM `appointment` WHERE `appointment_id` = '$_GET[id]'") or die(mysqli_error());
				$f = $q->fetch_array();
			?>
			<form action="edit_query.php" id = "form_dental" method = "POST" enctype = "multipart/form-data">
				<br>
				<div class = "form-inline">
					<label for = "middlename">Appointment Date:</label>
					<span class='input-group date' id='datetimepicker1'>
						<input name = "id" type = "hidden" value = "<?php echo $f['appointment_id']?>">
	                    <input class = "form-control" name = "dat" type = "text" required = "required">
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                </span>
					
					&nbsp;&nbsp;&nbsp;
					<label for = "firstname">Doctor:</label>
					<select name = "doc" class = "form-control" required = "required">
						<option value = "">Select doctor</option>
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
					&nbsp;&nbsp;&nbsp;
					<label for = "firstname">Patient:</label>
					<select name = "patient" class = "form-control" required = "required">
						<option value = "">Select patient</option>
                        <?php
							include('../db/config.php'); 
							$query = $conn->query("SELECT * FROM `itr` ") or die(mysqli_error());
							while($row = $query->fetch_array()){
							$itr_no = $row['itr_no'];
							$name = $row['firstname']." ".$row['lastname'];
							?>
							<option value = "<?php echo $itr_no; ?>"><?php echo $name; ?></option>
							<?php
						    }
						    $conn->close();
						?>
					</select>
				</div>
				<br><br>

				<div class = "form-inline">
					<button class = "btn btn-primary" name = "edit_appointment"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
				</div>
			</form>
			</div>
				
		</div>	
	</div>
	<?php include 'footer.php';?> 

	<script type = "text/javascript"> 
    $(document).ready(function() {
        function disableBack() { window.history.forward() }

        window.onload = disableBack();
        window.onpageshow = function(evt) { if (evt.persisted) disableBack() }

        $('#datetimepicker1').datetimepicker();
    });
</script>	
</body>
</html>