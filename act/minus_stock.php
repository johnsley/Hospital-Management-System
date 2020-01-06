<?php
require_once 'session.php';
require_once '../db/config.php';

if(ISSET($_POST['save_used_stock'])){
        $id = $_POST['item_id'];
        $date = date("Y-m-d h:i:sa");
        $itemRem = $_POST['itemRem'];
        $item_stock = $_POST['item_stock'];
        $item_gty = $_POST['item_gty'];
        $used = $_POST['used'];
        $newqty = $used + $item_gty;
        $rem = $item_stock - $newqty;
        if($item_gty > $itemRem){
            echo "<script>alert('The used Qty cannot Exceed Remaining Qty')</script>";
        }else{
          $sql = "UPDATE `stock` SET `date` = '$date', `used` = '$newqty', `rem` = '$rem' WHERE `id` = '$id' ";
          if ($conn->query($sql) === TRUE) {
          echo "<script>window.location ='stock.php'</script>";
         }
    }   
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
						<label>REDUCE STOCK</label>
						<a style = "float:right; margin-top:-4px;" href = "stock.php" class = "btn btn-info"><span class = "glyphicon glyphicon-hand-right"></span> BACK</a>
					</div>
					<div class = "panel-body">
					<?php
						$q = $conn->query("SELECT * FROM `stock` WHERE `id` = '$_GET[id]' ") or die(mysqli_error());
						$f = $q->fetch_array();
					?>
					<form action="#" method = "POST" enctype = "multipart/form-data">
						<div class = "form-inline">
							<label>Item:</label>
							<input class = "form-control" name = "item" type = "text" value = "<?php echo $f['item']?>" readonly/>
                            <input class = "hidden" id="used" name="used" type = "text" value = "<?php echo $f['used']?>" >
                            <input class = "hidden" id="item_id" name="item_id" type = "text" value = "<?php echo $f['id']?>">
							<input class = "hidden" id="item_stock" name="item_stock" type = "text" value = "<?php echo $f['quantity']?>" />
							&nbsp;&nbsp;&nbsp;
                            <label for = "phone">Rem:</label>
                            <input class = "form-control" id="itemRem" name="itemRem" type = "text" value = "<?php echo $f['rem'];?>" readonly/>
                            &nbsp;&nbsp;&nbsp;
						    <label for = "phone">Used:</label>
							<input class = "form-control" id="item_gty" name="item_gty" type = "number" placeholder="Enter quantity used" required="required">
							&nbsp;&nbsp;&nbsp;
							<input type="submit" class = "btn btn-primary submit" name = "save_used_stock" value="SAVE">
						</div>
					</form>
					
					</div>	
				</div>
                </div>
            </div>
        </div>
    </div>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script src = "../js/script.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    // $(document).ready(function() {
    //     $(document).on('click', '.submit', function(){
    //         var used = $('#itemRem').val();
    //         alert(used)
    //         var rem = $('#item_rem').val();

    //         if(used > rem){
    //             alert('The used Qty cannot Exceed Remaining Qty');
    //             $('#item_gty').focus();
    //             return false;  
    //         }
    //     });
    //    })
    </script>	
</body>
</html>
