<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';

	$urltype=$_REQUEST["urltype"];
	if($urltype=="httpsurl")
	{	require 'scripts/functionshttps.php'; }
	else
	{	require 'scripts/functions.php'; }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

	$pl_requestid = FixString($pl_requestid);
	$pl_bank_name = FixString($pl_bank_name);
	$bidderid = FixString($bidderid);
	$Dated=ExactServerdate();


if (strlen($pl_bank_name)>1 && $pl_requestid>1)
{
	$selqry="select RequestID,PL_Bank, City, Name, Mobile_Number, City_Other from Req_Loan_Home Where RequestID=".$pl_requestid;
	list($getRatesNumRows,$plrow)=MainselectfuncNew($selqry,$array = array());
		$myrowcontr=count($plrow)-1;
	
	 $pl_banks=$plrow[0]["PL_Bank"];
	 $City=$plrow[0]["City"];
	 $Name=$plrow[0]["Name"];
	$arrName= explode(" ", $Name);
	$firstname= $arrName[0];
	$lastname= $arrName[1];
	$Mobile_Number=$plrow[$myrowcontr]['Mobile_Number'];
	$City_Other=$plrow[$myrowcontr]['City_Other'];
	$RequestID=$plrow[$myrowcontr]['RequestID'];

if(strlen($pl_banks)>1)
	{
		$newpl_banks= $pl_banks.",".$pl_bank_name;
		$DataArray = array("PL_Bank" =>$newpl_banks);
		$wherecondition ="(Req_Loan_Home.RequestID=".$pl_requestid.")";	
	}
	else
	{
		//$plupdate= "Update Req_Loan_Home  set PL_Bank='".$pl_bank_name."' Where (Req_Loan_Home.RequestID=".$pl_requestid.")";
		$DataArray = array("PL_Bank" =>$pl_bank_name);
		$wherecondition ="(Req_Loan_Home.RequestID=".$pl_requestid.")";
	
	}
	Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);

	$qrydt= array("leadid" => $RequestID, "product" => '4' ,"feedback" => 'verification',"bidderid" => '5651', "doe" => $Dated, "cust_requestid" => $RequestID);
	$ProductValue = Maininsertfunc("webservice_bidder_details", $qrydt);

// insert lead for axis
/*if($bidderid==5651 && $pl_requestid>0)
	{
		$getdetails="select AllRequestID From Req_Feedback_Bidder_HL Where ( AllRequestID ='".$RequestID."' and BidderID=5651)";
		list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		if($alreadyExist>0)
		{}
		else
		{
		$leadentryqry= array("AllRequestID" => $RequestID, "BidderID" => '5651' ,"Reply_Type" => '2',"Allocation_Date" => $Dated);
		$Feedback_ID = Maininsertfunc("Req_Feedback_Bidder_HL", $leadentryqry);
		}
	}*/

//webservice
$CustToken = "hdpw23b";
$UDF1 = "0;".$City.";".$City;
$UDF2 = $firstname.";".$lastname.";".$Mobile_Number; 

if($lastname=="")
	{
	$lastname="K";
	}
/*if($Dated <'2016-02-29 19:00:00')
	{
$url="https://c4c.phonon.in/Click2TalkForm/CallMePage.jsp?CustToken=hdpw23b&UDF1=0;".$City.";".$City."&UDF2=".$firstname.";".$lastname.";".$Mobile_Number."&UDF5=hl&UDF7=shortform&UDF8=Deal4loans&byPassForm=true";
header("Location:".$url);
exit();
	}*/
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"> 
<title>Housing Loan | Apply For Home Loans | Online Home Loan | Apply Housing Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India, apply Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Housing Loan: Apply for home loans Online and get quotes from all home loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi, Pune etc.">
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
 <script type="text/javascript" src="scripts/common.js"></script>
<style type="text/css">
<!--
.red {
	color: #F00;
}
-->
</style>

</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.html" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Home Loan</span></div>
<div style="clear:both; height:25px;"></div>

<div style="clear:both; width: margin:auto;  margin-top:2px;">

<div id="container">

  <div id="txt"  style="padding-top:15px; height:60px;">
   <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:16px !important; line-height:22px; padding-left:20px;" align="center"> Thanks for applying Home Loan from <? echo $pl_bank_name; ?> through Deal4loans.com </h1>
  
</div>
</div>
<div style="clear:both; height:80px; width:964px; margin:auto; margin-top:10px;"></div>
</div>
</div>
<?php include("footer_sub_menu.php"); ?>

</body>
</html>

 	