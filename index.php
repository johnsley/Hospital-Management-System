<!DOCTYPE html>
<html lang = "eng">
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>CHALIANA MEDICAL CENTRE</title>
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style type="text/css">
    	body{
    		background: #e9eaed;
    	}
    </style>
	</head>
<body>
	<div class="container">
        <div class="row">
	   <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-4 col-sm-offset-4" style="padding-top:0px">
	   	<div class="text-center" style="margin-top: 20%">
	   		<a href="index.php"><img src="images/logo.png"></a>
	   	</div>
			<div class = "panel panel-default" style="margin-top: 5%">
			<div class = "panel-heading">
				<div class="text-center">
                    <h3>User Login</h3>
                </div>
			</div>
			<div class = "panel-body">
			<form action = "login.php" enctype = "multipart/form-data" method = "POST" >
				<div class = "form-group">
					<input class = "form-control" placeholder="Username" type = "text" name = "username"  required = "required"/>
				</div>
				<div class = "form-group">
					<input class = "form-control" placeholder="Password" type = "password" name = "password" required = "required" />
				</div>
				<div class = "form-group">
					<button class  = "btn btn-success form-control" type = "submit" name = "login" style="border-radius:0" ><span class = "glyphicon glyphicon-log-in"></span> Login</button>
				</div>
			</form>
            <div class="text-center">
                <hr>
                <a href="#">Forgot Password</a>
            </div>
		    </div>
		    </div>
		</div>
       </div>
     </div>

	<script src="vendor/jquery/jquery.min.js"></script>
   <!--  <script src = "js/script.js"></script> -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/metisMenu/metisMenu.min.js"></script>
    <script src="dist/js/sb-admin-2.js"></script>
</body>
</html>