<?php include 'script.php';?>
<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css" />
<style>
input[type="checkbox"]{
  width: 20px; /*Desired width*/
  height: 20px; /*Desired height*/
}
table {
	border-collapse: collapse;
	}

table, td, th {
	border: 1px solid #ccc;
}
</style>
<br><br>
<center>
<form action="service_print.php" method="POST">
<table style="font-size:1.2em">
<tr>
	<th style = "padding-right:20px;padding-left:20px;"><center>Select item to print</center></th>
	<th style = "padding-right:70px;padding-left:70px;"><center>Service Name</center></th>
</tr>
<?php
include('../db/config.php'); 
$ser_id = $_GET['ser_id'];
$q = $conn->query("SELECT * FROM `service` WHERE `patient_id` = '$_GET[itr_no]' ") or die(mysqli_error());
$c = $q->num_rows;
$total = 0;
while($f = $q->fetch_array()){
	$item_id = $f['item_id'];
    $t1 = $conn->query("SELECT * FROM `item` WHERE `item_id`='$item_id' ") or die(mysqli_error());
    $t11 = $t1->fetch_array();
    $total += $f['amount'];
?>
<tr>
	<td>
	<center>
		 <input type="hidden" class="chekbx" name="p_id" id="p_id" value="<?php echo $_GET['itr_no'];?>">
		<?php
         if($ser_id == $f['service_id']){
           ?>
             <input type="checkbox" name="selector[]" id="selector[]" value="<?php echo $f['service_id'];?>" checked>
           <?php
         }else{
         	?>
         	<input type="checkbox" name="selector[]" id="selector[]" value="<?php echo $f['service_id'];?>">
         	<?php
         }
		?>
	</center></td>
	<td><span style="padding-left: 10px"><?php echo $t11['name'];?></span></td>
</tr>
<?php
	}
	$conn->close();
?>
</table>
<br>
<center><button class="btn btn-primary" type="submit" id="submit" name="submit">Continue</button></center>
</form>
</center>

