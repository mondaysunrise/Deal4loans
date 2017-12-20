<?php 
$sql2 = "SELECT * FROM " . TABLE_SALESMAN." WHERE s_id='".$_SESSION['session_admin_userid']."'";
		$result2 = $obj->fun_db_query($sql2);
		$rowsCon2 = $obj->fun_db_fetch_rs_object($result2);

?>
<div class="content_left">
        <h1><a href="agentdashboard.php"><img src="<?php echo SITE_IMAGES;?>dash_icon.png"  border="none" />&nbsp;&nbsp;DASHBOARD</a></h1>
       
        
                  <hr />
                  <div class="nav"><img src="<?php echo SITE_IMAGES;?>nav_icon.png" /><a href="#">Manage Agent LMS</a>
          <ul>
            <li><a href="edit_diallercallerccpredictive.php">Edit diallercallerccpredictive</a></li>
            <li><a href="edit_diallerleadccsmsnew.php">Edit diallerleadccsmsnew</a></li>
            <li><a href="edit_blmainlms.php">Edit blmainlms</a></li>
            <li><a href="edit_blmainlmsothermetros.php">Edit blmainlmsothermetros</a></li>
            <li><a href="edit_CallerAccountICICI.php">Edit CallerAccountICICI</a></li>
            <li><a href="edit_CallerAccountOICICI.php">Edit CallerAccountOICICI</a></li>
            <li><a href="edit_ConsolidateCallerAccount.php">Edit ConsolidateCallerAccount</a></li>
            <li><a href="edit_agent_othermetros.php">Edit agent_othermetros</a></li>
            <li><a href="edit_selmsbl.php">Edit selmsbl</a></li>
            <li><a href="edit_diallerleadcc.php">Edit diallerleadcc</a></li>
          </ul>
        </div>
       
        <div class="nav"><img src="<?php echo SITE_IMAGES;?>nav_icon.png" /><a href="#">General</a>
          <ul>
               <li><a href="agentlogout.php">Logout</a></li>
          </ul>
        </div>
      </div>