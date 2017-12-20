<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

if(!empty($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR']!='192.124.249.12' && $_SERVER['REMOTE_ADDR']!='185.93.228.12')
{
      exit; 
} 
else
{
	sbiccmain();
	//capitalfirstmain();
}

//main();
function sbiccmain()
{
$Content="";
$todaydate=date('Y-m-d');
$min_date = $todaydate." 00:00:00";
$max_date = $todaydate." 23:59:59";
$ccqry ="Select count(RequestID) as sbicount From Req_Credit_Card Where (Updated_Date between '".$min_date."' and '".$max_date."' and applied_card_name like '%SBI%')";
$ccresult = ExecQuery($ccqry);
$row=mysql_fetch_array($ccresult);
$sbicount = $row["sbicount"];
$Content.= "Total number of application : ".$sbicount."<br>";
$sbicclogresult= ExecQuery("Select sbicclogid from sbi_credit_card_5633_log_direct Where (first_dated between '".$min_date."' and '".$max_date."') group by cc_requestid order by sbicclogid DESC ");
$recordcount = mysql_num_rows($sbicclogresult);
$sbiccqry="Select count(DISTINCT cc_requestid) as sbicountcc,ProcessingStatus from sbi_credit_card_5633_log_direct Where (first_dated between '".$min_date."' and '".$max_date."') group by ProcessingStatus order by sbicclogid DESC ";
$sbiccresult = ExecQuery($sbiccqry);
//$recordcount = mysql_num_rows($sbiccresult);
$finalerror="";
$finalerrorcount="";
while($sbirow=mysql_fetch_array($sbiccresult))
{

	$processingstat = $sbirow["ProcessingStatus"];
	if($processingstat==1)
	{
		$finalapprove= "Approved : ".$sbirow["sbicountcc"]."<br>";
	}
	elseif($processingstat==7)
	{
		$finaldecline= "Final Decline : ".$sbirow["sbicountcc"]."<br>";
	}
	else
	{
		$finalerror.= "Error : ".$sbirow["sbicountcc"]."<br>";
	}
}
//echo $finalerrorcount;
//$recordcount = $finalapprovecount + $finaldeclinecount + $finalerrorcount;
$Content.= "Total number of customers filled SBI application  form: ".$recordcount."<br>";
$Content.=$finalapprove."".$finaldecline."".$finalerror;

//echo $Content;
		$Email="rishi@deal4loans.com,ranjana@deal4loans.com";
		//$Email="ranjana5chauhan@gmail.com";
		$headers  = 'From: Dealoans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//echo $Type_Loan;

			if($recordcount)
			{
				mail($Email,'SBI CC Report - d4l', $Content, $headers);
			}
}

function capitalfirstmain()
{
$Content="";
$todaydate=date('Y-m-d');
$min_date = $todaydate." 00:00:00";
$max_date = $todaydate." 23:59:59";
 $ccqry ="Select capitalfirstid From apply_pl_capitalfirst Where (first_webdated between '".$min_date."' and '".$max_date."' and direct_webserviceflag=1) group by capitalfirst_requestid";
$ccresult = ExecQuery($ccqry);
$recordcountpl = mysql_num_rows($ccresult);
$appcountpl = $recordcountpl;
$Content.= "Total number of applications : ".$appcountpl."<br>";
$sbicclogresult= ExecQuery("Select capitalfirstid from apply_pl_capitalfirst Where (first_webdated between '".$min_date."' and '".$max_date."' and direct_webserviceflag=1 and 	first_webservice like '%Loan Application Number%') group by capitalfirst_requestid order by capitalfirstid DESC ");
$recordcount = mysql_num_rows($sbicclogresult);
$Content.= "Successful applications: ".$recordcount."<br>";
 $sbiccqry="Select count(DISTINCT capitalfirst_requestid) as appcount,first_webservice from apply_pl_capitalfirst Where (first_webdated between '".$min_date."' and '".$max_date."' and first_webservice not like '%Loan Application Number%') group by first_webservice order by capitalfirstid DESC ";
$sbiccresult = ExecQuery($sbiccqry);
//$recordcount = mysql_num_rows($sbiccresult);
$finalerror="";
$finalerrorcount="";
$Content.= "<br>leads with error:<br>";
while($sbirow=mysql_fetch_array($sbiccresult))
{

	$appcountcapfirst = $sbirow["appcount"];
	$first_webservice = $sbirow["first_webservice"];
	$Content.= $first_webservice." - ".$appcountcapfirst."<br>";
}
//echo $finalerrorcount;
//$recordcount = $finalapprovecount + $finaldeclinecount + $finalerrorcount;

//$Content.=$finalapprove."".$finaldecline."".$finalerror;

//echo $Content;
		$Email="rishi@deal4loans.com,ranjana@deal4loans.com,shweta.sharma@deal4loans.com";
		//$Email="ranjana5chauhan@gmail.com";
		$headers  = 'From: Dealoans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//echo $Type_Loan;

			if($recordcount)
			{
				mail($Email,'Capital First PL Report - d4l', $Content, $headers);
			}
}
?>

