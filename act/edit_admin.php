<?php require_once 'header.php';?>
	<div id = "content">
		<br />
		<br />
		<div class = "panel panel-success">	
		<?php
			include('../db/config.php'); 
			$query = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = '$_GET[id]'") or die(mysqli_error());
			$fetch = $query->fetch_array();
		?>
			<div class = "panel-heading">
				<label>EDIT ADMINISTRATOR</label>
				<a href = "admin.php" class = "btn btn-sm btn-info" style = "float:right; margin-top:-5px;"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
			</div>
			<div class = "panel-body">
				<form action="edit_query.php" id = "form_admin" method = "POST" enctype = "multi-part/form-data" >
					<div class = "panel panel-default" style = "width:60%; margin:auto;">
					<div class = "panel-heading">
					</div>
					<div class = "panel-body">
						<div class = "form-group">
							<label for = "username">Username: </label>
							<input class = "form-control" name = "username" value = "<?php echo $fetch['username'] ?>" type = "text" required = "required">
						</div>
						<div class = "form-group">	
							<label for = "password">Password: </label>
							<input class = "form-control" name = "password" value = "<?php echo $fetch['password']?>" maxlength = "12" type = "password" required = "required">
						</div>
						<div class = "form-group">
							<label for = "firstname">Firstname: </label>
							<input class = "form-control" type = "text" name = "firstname" value = "<?php echo $fetch['firstname'] ?>" required = "required">
						</div>
						<div class = "form-group">
							<label for = "middlename">Middlename: </label>
							<input class = "form-control" type = "text" name = "middlename" value = "<?php echo $fetch['middlename'] ?>">
						</div>
						<div class = "form-group">
							<label for = "lastname">Lastname: </label>
							<input class = "form-control" type = "text" name = "lastname" value = "<?php echo $fetch['lastname'] ?>">
						</div>
							<button  class = "btn btn-warning" name = "edit_admin" ><span class = "glyphicon glyphicon-edit"></span> SAVE</button>
							<br />
					</div>			
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
    });
</script>	
</body>
</html>