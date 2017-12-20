<?php
require_once("includes/application-top-inner.php");

if ($_FILES[csv][size] > 0) { 
	//get the csv file 
	$file = $_FILES[csv][tmp_name]; 
	$handle = fopen($file,"r"); 
	$saveStatus='';
	//loop through the csv file and insert into database 
do { 
		if ($data[0]) { 

		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";
		$tblname = "cards_curing_queue";
		$getdetails="select RequestID From ".$tblname." Where ( LeadRefNumber ='".$data[0]."' and dated between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
		$checkavailability = $obj->fun_db_query($getdetails);
		$alreadyExist = $obj->fun_db_get_num_rows($checkavailability);
		if($alreadyExist>0)
		{ 
			$saveStatus[]= $data[0]." Already Exists.";
		 }
		else
			{
				$AgentID='';
				$sbiSql = "select * from sbi_credit_card_5633 where LeadRefNumber='".$data[0]."'";
				$sbiQuery = $obj->fun_db_query($sbiSql);
				$rowSbi = $obj->fun_db_fetch_rs_object($sbiQuery);
				$bankname = "sbi";
				$identifier = "curing queue";
				$process = $rowSbi->productflag;//from DB
				$RequestID = $rowSbi->RequestID;//from DB
				if($process==44)
				{
					$getRefRequestIDRow=   $obj->fun_db_fetch_rs_object($obj->fun_db_query("SELECT RequestID as RefRequestID , UserID as Requestidf FROM  Req_Credit_Card_Sms WHERE (UserID='".$RequestID."' or RequestID='".$RequestID."')"));
					$getRefRequestID = $getRefRequestIDRow->RefRequestID;
					$RequestID = $getRefRequestIDRow->Requestidf;
					$getAgentRow =$obj->fun_db_fetch_rs_object($obj->fun_db_query("select BidderID from lead_allocate where AllRequestID = '".$getRefRequestID."'"));
					$AgentID = $getAgentRow->BidderID;										
				}
				else if($process==4 || $process==0)
				{
					$getRefRequestID = $RequestID;
					$getAgentRow =$obj->fun_db_fetch_rs_object($obj->fun_db_query("select BidderID from lead_allocate where AllRequestID = '".$getRefRequestID."'"));
					$AgentID = $getAgentRow->BidderID;
				}
				else if($process==10)
				{
					$AgentID = 5924;	
					$getRefRequestID = $RequestID;
				}
			
				if($AgentID>0)
				{
					$saveStatus[]= $data[0]." Inserted.";
				}
				else
				{
					$saveStatus[]= $data[0]." Agent ID Not Found.";
				}
	
				$insertleadqry=("INSERT INTO ".$tblname." (bankname, identifier, process, RequestID,RefRequestID, AgentID, dated, modified_date, LeadRefNumber, code, insert_status) VALUES ('".$bankname."', '".$identifier."','".$process."', '".$RequestID."','".$getRefRequestID."', '".$AgentID."', Now(), Now(), '".($data[0])."' , '".($data[1])."', '".$insert_status."')"); 
				$insertleadresult = $obj->fun_db_query($insertleadqry);
				$ProductValue =  $obj->fun_db_last_inserted_id();

$AgentID='';
		} 
	}
	} while ($data = fgetcsv($handle,50,",","'"));            // 
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
<?php include 'header_cc.php'; ?>
<div align="center"><b>UPLOAD FOR SBI Curing Queue</b></div>
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
				<input type="submit" name="Submit" value="Submit" /> 				
				</td></tr>
			</table>   </form>  
<div style="clear:both; height:15px;"></div>
			<div align="center">
<?php  if ($_FILES[csv][size] > 0) { 
for($i=0;$i<count($saveStatus);$i++)
{
	echo $saveStatus[$i];
	echo "<br>";

}

} 	?>		
</div>
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