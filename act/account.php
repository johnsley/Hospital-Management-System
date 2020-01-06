<?php
    require_once 'session.php';
    require_once '../db/config.php';
    if(isset($_SESSION['user_id']) && $_SESSION['user_group'] <=2){
     }else{
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
       
			<div class="panel panel-warning text-left" style="font-size:1.2em;padding: 10px">

			<ul style="text-decoration: none;list-style: none">
				<li style="padding: 10px"><a href = "report_select.php"><img src="../assets/repo.png" style="width:20px;height:20px"> Management Reports</a></li>
                <li style="padding: 10px"><a href = "patient_report.php"><img src="../assets/regs.png" style="width:20px;height:20px"> Patient Reports</a></li>
                <?php
                if(isset($_SESSION['user_id']) && $_SESSION['user_group'] ==1){
                ?>
               <li style="padding: 10px"><a href = "reversed.php"><img src="../assets/user1.png" style="width:20px;height:20px"> Reversed List</a></li>
                <li style="padding: 10px"><a href = "adjustment.php"><img src="../assets/user1.png" style="width:20px;height:20px"> Adjustments List</a></li>
                <?php
                }
                ?>
			</ul>

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
