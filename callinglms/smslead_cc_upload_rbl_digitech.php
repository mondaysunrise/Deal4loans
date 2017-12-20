<?php
require_once("includes/application-top-inner.php");

if ($_FILES[csv][size] > 0) {
	//get the csv file 
	$file = $_FILES[csv][tmp_name]; 
	$handle = fopen($file,"r"); 
	//loop through the csv file and insert into database 
	do {
		if (strlen($data[1]>5)) {
			$tblname="Req_Credit_Card";
			$leadsource="SMS_Digi_Lead_RBL";

			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";

			$getdetails="select RequestID From ".$tblname." Where ( Mobile_Number not in (9811215138) and Mobile_Number='".$data[1]."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			$checkavailability = $obj->fun_db_query($getdetails);
			$alreadyExist = $obj->fun_db_get_num_rows($checkavailability);
			if($alreadyExist>0)
			{}
			else
			{
				//Replace Non-breakable space (nbsp)
				$Name = utf8_encode($data[0]);
				$Name = preg_replace('/\xc2\xa0/', ' ', $Name);
				$Name = trim($Name);
				
				$insertleadqry=("INSERT INTO ".$tblname." (Name, Mobile_Number, City, Net_Salary, source, Employment_Status , Dated, Updated_Date) VALUES 
				(
					'".FixString($Name)."', 
					'".FixString($data[1])."', 
					'".FixString($data[2])."',
					'".FixString($data[3])."',
					'".$leadsource."',
					'1',
					Now(),     
					Now()
				) 
				"); 
				$insertleadresult = $obj->fun_db_query($insertleadqry);
				$ProductValue = mysql_insert_id();
			}
		}
	} while ($data = fgetcsv($handle,1000,",","'"));
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
<!-- End Main Banner Menu Panel -->
<div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;">
	<div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;">
		<a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a>
	</div>
	<div style="clear:both;"></div>
	<?php include "smslead_header.php"; ?>
	<div style="clear:both;"></div>
</div>
<div align="center"><b>UPLOAD FOR CREDIT CARD FOR RBL</b></div>
<div style="clear:both; height:15px;"></div>
<table align="center">
	<tr>
		<td><?php if ($message==1) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> </td>
	</tr>
	<tr>
		<td>
			<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
				Choose your file: <br /> 
				<table align="center">
					<tr><td height="50">
						<input name="csv" type="file" id="csv" /> </td>
					</tr>
					<tr><td>
					<input type="submit" name="Submit" value="Submit" />
				</tr>
			</form> 
		</td>
	</tr>
</table>    
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script> 
<script type="text/javascript">
try {
	var pageTracker = _gat._getTracker("UA-1312775-1");
	pageTracker._trackPageview();
} catch(err) {}
</script>
</body>
</html>
