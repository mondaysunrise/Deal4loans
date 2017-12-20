<?php
require_once("includes/application-top-inner.php");

if ($_FILES[csv][size] > 0) { 
	//get the csv file 
	$file = $_FILES[csv][tmp_name]; 
	$handle = fopen($file,"r"); 
	//loop through the csv file and insert into database 
do { 
		if ($data[0] && strlen($data[2]>5)) { 

			if($data[0]==1)
			{
				$tblname="Req_Loan_Personal";
			}
			elseif($data[0]==2)
			{
				$tblname="Req_Loan_Home";
			}
			else
			{
				echo "Product code is Empty! ";
			}
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
$days30date=date('Y-m-d',$tomorrow);
$days30datetime = $days30date." 00:00:00";
$currentdate= date('Y-m-d');
$currentdatetime = date('Y-m-d')." 23:59:59";

 $getdetails="select RequestID From ".$tblname." Where ( Mobile_Number not in (9811215138) and Mobile_Number='".$data[2]."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
$checkavailability = $obj->fun_db_query($getdetails);
$alreadyExist = $obj->fun_db_get_num_rows($checkavailability);
			if($alreadyExist>0)
			{					}
			else
			{
			
			   $insertleadqry=("INSERT INTO ".$tblname." (Name, Mobile_Number, City, Net_Salary, source, Employment_Status , Dated, Updated_Date) VALUES 
				( 
					'".FixString($data[1])."', 
					'".FixString($data[2])."', 
					'".FixString($data[3])."',
					'".FixString($data[4])."',
					'SMS_Lead',
					'1',
					Now(),     
					Now()               ) 
			"); 
			$insertleadresult = $obj->fun_db_query($insertleadqry);

			$ProductValue = mysql_insert_id();
		} 
	}
	} while ($data = fgetcsv($handle,1000,",","'"));            // 
	//redirect 
	if($ProductValue>0)
	{
		$message=1;
	}
	else
	{
		$message=0;
	}
	//header('Location: customer_feedback_verifiedview.php?success=1'); die; 
} 
            ?> 
<html>
		<head>
		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
		<title>Login</title>
		<script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
		<link href="../includes/style1.css" rel="stylesheet" type="text/css">
		<link href="../style.css" rel="stylesheet" type="text/css" />
		<script language="javascript" type="text/javascript" src="../scripts/datetime.js"></script>
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
<div style="clear:both;"></div>
</div>
<div align="center" style="text-decoration:none; font-size:12px;"><a href="smsleadli_upload.php" target="_blank"><b>Life Insurance</b></a>&nbsp;|&nbsp;<a href="smsleadfbli_upload.php" target="_blank"><b>Life Insurance for Facebook</b></a>&nbsp;|&nbsp;<a href="smslead_cc_upload.php" target="_blank"><b>Credit Card</b></a>&nbsp;&nbsp;</div><br>
<div align="center" style="text-decoration:none; font-size:12px;"><b>To upload for Credit Card - </b> <a href="smslead_cc_upload_amex.php" target="_blank">AMEX</a> | <a href="smslead_cc_upload_scb.php" target="_blank">SCB</a> <a href="smslead_cc_upload_icici.php" target="_blank">ICICI</a> <a href="smslead_cc_upload_sbi.php" target="_blank">SBI</a> <a href="smslead_cc_upload_rbl.php" target="_blank">RBL</a> </div><br>
<div align="center" style="text-decoration:none; font-size:12px;"><a href="smsleadext_upload.php" target="_blank"><b>External sms</b></a>&nbsp;|&nbsp;<a href="smsleadspl_upload.php" target="_blank"><b>pl sms appointment model</b></a>&nbsp;|&nbsp;<a href="smsleadhdfcli_upload.php" target="_blank"><b>HDFC LIFE</b></a>&nbsp;|&nbsp;<a href="smsleadicicili_upload.php" target="_blank"><b>ICICIPRU LIFE</b></a>&nbsp;|&nbsp;<a href="smsleadrelianceli_upload.php" target="_blank"><b>REliance LIFE</b></a>&nbsp;|&nbsp;<a href="smsleadICICIAndro_plupload.php" target="_blank"><b>ICICI ANDRO</b></a>&nbsp;|&nbsp;<a href="smslead_foricici.php" target="_blank"><b>ICICI (salary account)</b></a>&nbsp;|&nbsp;<a href="smslead_cc_upload_new.php" target="_blank"><b>Credit Card Process(Internal)</b></a>&nbsp;|&nbsp;<a href="smslead_cc_upload_iccs.php" target="_blank"><b>Credit Card Process (ICCS)</b></a>&nbsp;|&nbsp;<a href="smsleadmonster_upload.php" target="_blank"><b>Monster sms</b></a></div><br>
<div align="center" style="text-decoration:none; font-size:12px;"><a href="smsleadfb_upload.php" target="_blank"><b>for facebook sms</b></a>&nbsp;|&nbsp;<a href="smsleadfbself_upload.php" target="_blank"><b>facebook Self employed sms</b></a> &nbsp; |&nbsp;<a href="smslead_forbl.php" target="_blank"><b>BL Upload(Ankit)</b></a> |&nbsp;<a href="scb_data_lead_upload.php" target="_blank"><b>SCB PL Upload</b></a> |&nbsp;<a href="hdb_data_lead_upload.php" target="_blank"><b>HDB PL Upload</b></a> |&nbsp;<a href="bfl_data_lead_upload.php" target="_blank"><b>BFL PL Upload</b></a></div><br>
<div align="center"><b>UPLOAD FOR PERSONAL LOAN & HOME LOAN</b></div>
<div style="clear:both; height:15px;"></div>
  <table align="center">
				<tr> <td><?php if ($message==1) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> </td></tr>
				<tr><td>
				<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
				Choose your file: <br /> 
				<table align="center">
				<tr><td height="50">
				<input name="csv" type="file" id="csv" /> </td></tr>
				<tr><td>
                                        <input type="submit" name="Submit" value="Submit" /></td> </tr>
				
				
			</table> 
                                </form></td></tr>
  </table>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script> 
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>