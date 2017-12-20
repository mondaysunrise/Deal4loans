<?php
//	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//print_r($_POST);
	$AgentID = $_REQUEST['AgentID'];
	$Reply_Type = $_REQUEST['Reply_Type'];
	$RequestID = $_REQUEST['RequestID'];
	$PropertyID = $_REQUEST['PropertyID'];
	
	if($PropertyID>0)
	{
		$checkSql = "select * from Req_Property_Bidder where AllRequestID='".$RequestID."' and Reply_Type = '".$Reply_Type."' and PropertyID='".$PropertyID."'";
		list($alreadyExist,$myrow)=MainselectfuncNew($checkSql,$array = array());
		$numRows = $alreadyExist;
		if($numRows>0)
		{
			$msg = "You have already selected the Property.";
		}
		else
		{
			$Dated = ExactServerdate();
			$data = array("AllRequestID"=>$RequestID, "BidderID"=>$AgentID, "Reply_Type"=>$Reply_Type, "PropertyID"=>$PropertyID, "Allocated"=>'2', "Allocation_Date"=>$Dated);
		
			$table = 'Req_Property_Bidder';
			$insert = Maininsertfunc ($table, $data);
		
			$hllddt="Select Name,Mobile_Number From Req_Loan_Home Where (RequestID=".$RequestID.")";
			list($alreadyExist,$myrow)=MainselectfuncNew($hllddt,$array = array());
			$myrowcontr=count($myrow)-1;
			$Name = $myrow[$myrowcontr]["Name"];
			$Phone = $myrow[$myrowcontr]["Phone"];
			
			$pptysms = "select * from  Req_Compaign_Property Where (BidderID=".$AgentID." and Sms_Flag=1)";
			list($alreadyExist,$myrow)=MainselectfuncNew($pptysms,$array = array());
			$currentdate=date('d-m-Y');
			$message ="Your Leads for hl on (".$currentdate.") : ";
			$SMSMessage=$SMSMessage."Name - ".$Name.", Mobile - ".$Phone." Property Lead";
			
			for($i=0;$i<$alreadyExist;$i++)
			{
				$Mobile_no = $myrow[$i]["Mobile_no"];	
				if(strlen(trim($Mobile_no)) > 0)
					 SendSMSforLMS($message.$SMSMessage, $Mobile_no);						
			}
			$msg = "Thanks for selecting the Property through Deal4loans.com";
		
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Property Details - Deal4loans.com</title>
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
 <script type="text/javascript" src="scripts/common.js"></script>
<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>


</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->


<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.html" class="text12" style="color:#0080d6;" >Home</a></u> > <span class="text12" style="color:#4c4c4c;">> Property Details</span></div>
<div style="clear:both; height:1px;"></div>

<div style="clear:both; width:960px; margin:auto;  margin-top:2px;">

<div id="container">

  <div id="txt"  style="padding-top:15px; height:60px;">
   <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; padding-left:20px;" align="center"><?php echo $msg; ?></h1>
  
</div>
</div>
<div style="clear:both; height:80px; width:964px; margin:auto; margin-top:10px;"></div>
</div>
<?php include "footer1.php"; ?>

</body>
</html>