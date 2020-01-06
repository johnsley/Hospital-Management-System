<?php
        include('../db/config.php'); 

        if(isset($_POST['itemid'])){
        	$item_id = $_POST['itemid'];  
		    $q1 = $conn->query("SELECT price FROM `item` WHERE `item_id` = '$item_id'") or die(mysqli_error());
		    $f1 = $q1->fetch_array();
		    echo $f1['price'];
        }
		
		
		
		
