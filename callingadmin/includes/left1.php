<?php 
$sql2 = "SELECT * FROM " . TABLE_SALESMAN." WHERE s_id='".$_SESSION['session_admin_userid']."'";
		$result2 = $obj->fun_db_query($sql2);
		$rowsCon2 = $obj->fun_db_fetch_rs_object($result2);

?>
<div class="content_left">
        <h1><a href="dashboard1.php"><img src="<?php echo SITE_IMAGES;?>dash_icon.png"  border="none" />&nbsp;&nbsp;DASHBOARD</a></h1>
        <hr />
        <div class="nav"><img src="<?php echo SITE_IMAGES;?>nav_icon.png" /><a href="#">Appointment LMS</a>
          <ul>
            <li><a href="edit_appt.php">Edit Options</a></li>
          </ul>
        </div>
        <hr />
       
        <div class="nav"><img src="<?php echo SITE_IMAGES;?>nav_icon.png" /><a href="#">General</a>
          <ul>
               <li><a href="logout_appt.php">Logout</a></li>
          </ul>
        </div>
      </div>