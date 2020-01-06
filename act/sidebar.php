<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu" style="margin-top: 5%">

                <li><a href = "patient.php"><img src="../assets/regs.png" style="width:20px;height:20px"> Registration</a></li>
                <?php
                 if(isset($_SESSION['user_id']) && $_SESSION['user_group'] <=2 || $_SESSION['user_group'] == 4 || $_SESSION['user_group'] == 11){
                     echo '<li><a href = "consultation.php"><img src="../assets/cons.png" style="width:20px;height:20px"> Consultation</a></li>';
                 }
                 if(isset($_SESSION['user_id']) && $_SESSION['user_group'] <=2 || $_SESSION['user_group'] == 4 ){
                     echo '<li><a href = "pharmacy.php"><img src="../assets/pharma.png" style="width:20px;height:20px"> Pharmacy Issues</a>
                      </li>';
                 }
                 if(isset($_SESSION['user_id']) && $_SESSION['user_group'] <=2 || $_SESSION['user_group'] == 4 || $_SESSION['user_group'] == 9){
                     echo '<li><a href = "xray.php"><img src="../assets/radio.png" style="width:20px;height:20px"> Radiology</a></li>';
                 }
                 if(isset($_SESSION['user_id']) && $_SESSION['user_group'] <=2 || $_SESSION['user_group'] == 4 || $_SESSION['user_group'] == 10){
                     echo '<li><a href = "dental.php"><img src="../assets/dental.png" style="width:20px;height:20px"> Dental Clinic</a></li>';
                 }
                 if(isset($_SESSION['user_id']) && $_SESSION['user_group'] <=2 || $_SESSION['user_group'] == 4 || $_SESSION['user_group'] == 6){
                     echo '<li><a href = "rehabilitation.php"><img src="../assets/physio.png" style="width:20px;height:20px"> Physiotherapy</a></li>';
                 }
                 if(isset($_SESSION['user_id']) && $_SESSION['user_group'] <=2 || $_SESSION['user_group'] == 4 || $_SESSION['user_group'] == 5){
                     echo '<li><a href = "laboratory.php"><img src="../assets/labtests.png" style="width:20px;height:20px"> Laboratory</a></li>';
                 }
                  if(isset($_SESSION['user_id']) && $_SESSION['user_group'] <=2 || $_SESSION['user_group'] == 4 || $_SESSION['user_group'] == 12){
                     echo '<li><a href = "maternity.php"><img src="../assets/mat.png" style="width:20px;height:20px"> Maternity</a></li>';
                 }
                 if(isset($_SESSION['user_id']) && $_SESSION['user_group'] <=2 || $_SESSION['user_group'] == 4){
                     echo '<li><a href = "outpatient.php"><img src="../assets/appmts.png" style="width:20px;height:20px">  Out-patient</a></li>';
                 }
                 if(isset($_SESSION['user_id']) && $_SESSION['user_group'] <=2 || $_SESSION['user_group'] == 4){
                     echo '<li><a href = "payment.php"><img src="../assets/paym.jpg" style="width:20px;height:20px"> Expenses</a></li>';
                 }
                 if(isset($_SESSION['user_id']) && $_SESSION['user_group'] <=2){
                     echo '<li><a href = "account.php"><img src="../assets/accounts.png" style="width:20px;height:20px"> Accountant</a></li>';
                 }
                 if(isset($_SESSION['user_id']) && $_SESSION['user_group'] ==1){
                     echo '<li><a href = "master.php"><img src="../assets/sysa.png" style="width:20px;height:20px"> Master Files</a></li>';
                 }
                ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>