<?php
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	require 'hdfcplMails.php';	
	
	$Now = date("Y-m-d H:i:s");
	
	$lastday = mktime(0, 0, 0, date("m"), date("d")-2,   date("Y"));
	$startTime = date("Y-m-d", $lastday)." 17:00:01";
	$endTime = date("Y-m-d")." 17:14:59";
	
	 $sql = "select * from hdfc_pl_calc_leads where ((Dated between '".$startTime."' and '".$endTime."') and MAIL_SENT='' and   	  eligible='Yes')";
	$query = ExecQuery($sql);
	$numrows = mysql_num_rows($query);
	for($i=0;$i<$numrows;$i++)
	{
		$city = mysql_result($query,$i,'city');
		$hdfcplid = mysql_result($query,$i,'hdfcplid');
	//	$sendMailsBidders = getCityMails($city,$hdfcplid);	
		$updateSql = "update hdfc_pl_calc_leads set MAIL_SENT='Sent' where hdfcplid ='".$hdfcplid."'";
		$updateQuery = ExecQuery($updateSql);	
	}
?>