<?php 
$sql2 = "SELECT * FROM " . TABLE_SALESMAN." WHERE s_id='".$_SESSION['session_admin_userid']."'";
		$result2 = $obj->fun_db_query($sql2);
		$rowsCon2 = $obj->fun_db_fetch_rs_object($result2);

?>
<div class="content_left">
        <h1><a href="dashboard.php"><img src="<?php echo SITE_IMAGES;?>dash_icon.png"  border="none" />&nbsp;&nbsp;DASHBOARD</a></h1>
        <hr />
        <div class="nav"><img src="<?php echo SITE_IMAGES;?>nav_icon.png" /><a href="view-bank.php">Manage Bank</a>
          <ul>
            <li><a href="add-bank.php">Add Bank</a></li>
            <li><a href="view-bank.php">View Bank List</a></li>
         
          </ul>
        </div>
        <hr />
          <div class="nav"><img src="<?php echo SITE_IMAGES;?>nav_icon.png" /><a href="view-city.php">Manage City</a>
          <ul>
            <li><a href="add-city.php">Add City</a></li>
            <li><a href="view-city.php">View City List</a></li>
         
          </ul>
        </div>
          <hr />
          <div class="nav"><img src="<?php echo SITE_IMAGES;?>nav_icon.png" /><a href="view-location.php">Manage Location</a>
          <ul>
            <li><a href="add-location.php">Add Location</a></li>
            <li><a href="view-location.php">View Location List</a></li>
         
          </ul>
        </div>
          <hr />
          <!--<div class="nav"><img src="<?php echo SITE_IMAGES;?>nav_icon.png" /><a href="view-branch.php">Manage Branch</a>
          <ul>
            <li><a href="add-branch.php">Add Branch</a></li>
            <li><a href="view-branch.php">View Branch List</a></li>
         
          </ul>
        </div>
        <hr />-->
        <div class="nav"><img src="<?php echo SITE_IMAGES;?>nav_icon.png" /><a href="#">General</a>
          <ul>
         <!--
            <li><a href="change-password.php">Change Password</a></li>
            <li><a href="feedback.php">Feedback</a></li>-->
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>