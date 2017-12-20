<?php
require 'scripts/db_init.php';

//print_r($_REQUEST);
//echo "<br><br>";
$Keyword	= $_REQUEST["Keyword"];
$senddate	= $_REQUEST["senddate"];
$FromNumber	= $_REQUEST["FromNumber"];
$ToNumber	= $_REQUEST["ToNumber"];
$text	= $_REQUEST["text"];
$operator	= $_REQUEST["operator"];
$City	= $_REQUEST["circle"];
$source =  $_REQUEST["leadsource"];

//http://www.deal4loans.com/deal4loans_leadcampaign.php?leadsource=whitedwarf&FromNumber=$FromNumber&text=$Message_Text&senddate=$Time_Stamp&ToNumber=VMN&circle=$circle&operator=$op

if(strlen($FromNumber)==12)
{
	$mobile_number=substr($FromNumber, 2);
}
else
{
	$mobile_number=$FromNumber;
}

if(strlen($FromNumber)>9 && strlen($City)>3)
{
	//echo "hello";
	//echo "<br><br>";
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";

	$smscampaign="Select d4lcampid from d4l_smscampaign_leads Where(sms_FromNumber='".$mobile_number."' and sms_DOE between '".$days30datetime."' and '".$currentdatetime."')";
	list($alreadyExist,$checkavailability)=MainselectfuncNew($smscampaign,$array = array());
	$myrowcontr = count($myrow)-1;
	if($alreadyExist>0)
	{	}
	else
	{
		$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9811215138,9999047207,9891118553,9999570210) and Mobile_Number='".$mobile_number."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
		list($alreadyExistpl,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr = count($myrow)-1;
			$Dated=ExactServerdate();
			if($alreadyExistpl>0)
		{
		}
		else
		{
			$dataInsert = array('Name'=>'Customer 1', 'City'=>$City, 'Mobile_Number'=>$mobile_number, 'Employment_Status'=>'1', 'Net_Salary'=>'360000', 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'source'=>$source);
			$insert = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
		}
	}
//echo "<br><br>";
		
		$Dated=ExactServerdate();
		$dataIns = array('sms_Keyword'=>$Keyword, 'sms_senddate'=>$senddate, 'sms_FromNumber'=>$FromNumber, 'sms_ToNumber'=>$ToNumber, 'sms_text'=>$text, 'sms_operator'=>$operator, 'sms_City'=>$City, 'sms_source'=>$source, 'sms_DOE'=>$Dated);
		$ProductValue = Maininsertfunc ('d4l_smscampaign_leads', $dataIns);
		if($ProductValue>0)
		{
			echo "Lead Inserted";
		}
}
//echo "<br><br>";
//http://www.deal4loans.com/deal4loans_leadcampaign.php?leadsource=whitedwarf&FromNumber=919811215138&text=hello&senddate=2,26,2015 14:35&ToNumber=56161&circle=Delhi&operator=Vodafone
?>