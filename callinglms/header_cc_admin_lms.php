<style type="text/css">
		.lms-top-container{ margin:auto; width:1170px;}
		.lms-text-wrapper{ float:left; width:29%; text-align:left; font-size:30px;}
		.lms-btn-wrapper{ float:right; text-align:right; width:71%;}
		.logout-btn{ float:left; margin-left:5px; margin-right:5px; padding:10px; color:#FFF; text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:14px; border-radius:5px; background:#F00; text-decoration:none;}
		.logout-btn1{ float:left; margin-left:2px; margin-right:2px; padding:4px; color:#FFF; text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; border-radius:5px; background:#F00; text-decoration:none; vertical-align:baseline;}
</style>
<!-- End Main Banner Menu Panel -->
<div style="width:100%; background: #CCC; padding:15px 0px 10px 0px;">
	<div class="lms-top-container"> 
		<div class="lms-text-wrapper"> Credit Card Admin <span style="font-size:12px;"><?php echo $showHeader ?></span></div>
		<div class="lms-btn-wrapper">
			<a href="cc_lms_dashboard.php" class="logout-btn1">Dashboard</a>
			<a href="cc_lms_dashboard_sbi.php" class="logout-btn1">SBI Status</a>
			<a href="cc_lms_dashboard_amex.php" class="logout-btn1">AMEX Status</a>
			<a href="cc_lms_dashboard_rbl.php" class="logout-btn1">RBL Status</a>
			<a href="cc_lead_feedback_index.php" class="logout-btn1">No Feedback Leads</a>
			<a href="cc_lead_reassigning_index.php" class="logout-btn1">Re-churning</a>
			<a href="cc_lms_sms_admin_list.php" class="logout-btn1">Detailed Report</a>
			<a href="cc_sbi_agents_status_index.php" class="logout-btn1">SBI Agents Status</a>
		</div>
		<div style="clear:both;"></div>
		<div class="lms-btn-wrapper">
			<a href="cc_lms_sbi_blank_leads.php" class="logout-btn1">SBI Blank Leads</a>
			<a href="../getNoResponseSBI.php" class="logout-btn1">SBI Blank Leads Repunch</a>
			<a href="../getUserDetailsSBI.php" class="logout-btn1">SBI Leads Info</a>
			<a href="../getUserDetailsRBL.php" class="logout-btn1">RBL Leads Info</a>
			<a href="../getUserDetailsAMEX.php" class="logout-btn1">AMEX Leads Info</a>
			<a href="logout.php" class="logout-btn1">Logout</a>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>
