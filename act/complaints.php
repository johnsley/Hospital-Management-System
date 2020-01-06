<?php require_once 'header.php';?>
	<div id = "content">
		<br />
		<br />
		<div style = "display:none;" id = "com" class = "panel panel-success">	
			<div class = "panel-heading" style="border-radius: 0px">
				<label>PATIENT / COMPLAINTS</label>
				<button class = "btn btn-danger" id = "hide_com" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-remove"></span>CLOSE</button>
			</div>
			<div class = "panel-body">
			<?php
				include('../db/config.php'); 
				$q = $conn->query("SELECT * FROM `itr` WHERE `itr_no` = '$_GET[id]' && `lastname` = '$_GET[lastname]'") or die(mysqli_error());
				$f = $q->fetch_array();
			?>
				<form method = "POST" enctype = "multipart/form-data">
					<div style = "float:left;" class = "form-inline">
						<label for = "itr_no">ITR No:</label>
						<input class = "form-control" value = "<?php echo $f['itr_no'] ?>" disabled = "disabled" size = "3" type = "number" name = "itr_no">
					</div>
					<div style = "float:right;" class = "form-inline">
						<label for = "family_no">Family no:</label>
						<input class = "form-control" size = "3" value = "
							<?php 
								if($f['family_no'] == "0"){
									echo "";
								}else{
									echo $f['family_no'];
								}	
							?>" disabled = "disabled" type = "number" name = "family_no">
					</div>
					<br />
					<br />
					<br />
					<div class = "form-inline">
						<label for = "firstname">Firstname:</label>
						<input class = "form-control" name = "firstname" value = "<?php echo $f['firstname']?>" disabled = "disabled" type = "text" required = "required">
						&nbsp;&nbsp;&nbsp;
						<label for = "middlename">Middle Name:</label>
						<input class = "form-control" name = "middlename" value = "<?php echo $f['middlename']?>" disabled = "disabled" type = "text" required = "required">
						&nbsp;&nbsp;&nbsp;
						<label for = "lastname">Lastname:</label>
						<input class = "form-control" name = "lastname" value = "<?php echo $f['lastname']?>" disabled = "disabled" type = "text" required = "required">
					</div>
					<br />
					<div class = "form-group">
						<label>Complaints:</label>
						<textarea style = "resize:none;" name = "complaints" class = "form-control"></textarea>
						<br />
						<label>Remarks:</label>
						<textarea style = "resize:none;" name = "remarks" class = "form-control"></textarea>
						<br />
						<label>Section:</label>
						<select name = "section" class = "form-control" required = "required">
								<option value = "">--Please select an option--</option>
								<option value = "Dental">Dental</option>
								<option value = "Fecalysis">Fecalysis</option>
								<option value = "Hematology">Hematology</option>
								<option value = "Prenatal">Prenatal</option>
								<option value = "Xray">Xray</option>
								<option value = "Rehabilitation">Rehabilitation</option>
								<option value = "Sputum">Sputum</option>
								<option value = "Urinalysis">Urinalysis</option>
								<option value = "Maternity">Maternity</option>
							</select>
					</div>
					<br />
					<div class = "form-inline">
						<button class = "btn btn-primary" name = "save_complaints"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
					</div>
					<?php require_once 'add_complaints.php';?>
				</form>
			</div>	
		</div>	
		<?php
			include('../db/config.php'); 
			$query = $conn->query("SELECT * FROM `itr` WHERE `itr_no` = '$_GET[id]' && `lastname` = '$_GET[lastname]'") or die(mysqli_error());
			$fetch = $query->fetch_array();
		?>
		<div class = "panel panel-info">
			<div class = "panel-heading">
				<label style = "font-size:16px;">COMPLAINTS / <?php echo $fetch['firstname']." ".$fetch['lastname']?></label>
				<a style = "float:right; margin-top:-5px;" id = "add_complaints" class = "btn btn-success" href = "patient.php"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
		</div>
		<!-- <button class = "btn btn-primary" id = "show_com"><i class = "glyphicon glyphicon-plus">ADD</i></button> -->
		<div class = "panel-body">
			<?php
				$q1 = $conn->query("SELECT * FROM `itr` WHERE `itr_no` = '$_GET[id]'") or die(mysqli_error());
				$f1 = $q1->fetch_array();
				$q = $conn->query("SELECT * FROM `complaints` WHERE `itr_no` = '$_GET[id]' ORDER BY `status` DESC") or die(mysqli_error());	
					while($f = $q->fetch_array()){
						if($f['status'] == "Done"){
							echo "<label style = 'color:#3399f3;'>".$f['section']."</label>"."<textarea  style = 'resize:none;' disabled = 'disabled' class = 'form-control'>".$f['remark']."</textarea>".$f['date']."<label style = 'float:right; color:red;'>Done</label><br /><br /><hr style = 'border:1px solid #eee;' />";
						}
						if($f['status'] == "Pending"){
							echo "<label style = 'color:#3399f3;'>".$f['section']."</label>"."<textarea  style = 'resize:none;' disabled = 'disabled' class = 'form-control'>".$f['remark']."</textarea>".$f['date']."<br /><br /><hr style = 'border:1px solid #eee;' />";
						}
					}
				?>
		</div>
	</div>
	<?php include 'footer.php';?>

</body>
</html>