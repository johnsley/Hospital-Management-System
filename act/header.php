<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span celass="icon-bar"></span>
    <span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="../index.php" style="font-weight:bold;padding: 0"><img src="../images/logo.png" height="50px"></a>
</div>
<!-- /.navbar-header -->
<ul class="nav navbar-top-links navbar-left">
<li>
	<a href="#"> 
	<strong><img src="../assets/loggedin.png" style="width:20px;height:20px">&nbsp;<?php $name = ISSET($_SESSION['firstname']) ? $_SESSION['firstname']:"";echo $name ?></strong> | <strong><img src="../assets/clock.png" style="width:20px;height:20px">&nbsp;<?php $date = $date = date("Y-m-d h:i:sa", time() + 7200); echo $date;?></strong>
    </a>
</li>
</ul>
<ul class="nav navbar-top-links navbar-right">
<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
        </li>
</ul>
