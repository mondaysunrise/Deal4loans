<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET'){
		foreach($_POST as $a=>$b)
			$$a=$b;
	
		$Name = $_REQUEST["Name"];
		$Day=$_REQUEST["day"];
		$Month=$_REQUEST["month"];
		$Year=$_REQUEST["year"];
		$Phone = $_REQUEST["Phone"];
		$Email = $_REQUEST["Email"];
		$City = $_REQUEST["City"];
		$Company_Name = $_REQUEST["Company_Name"];
		$Net_Salary = $_REQUEST["Net_Salary"];
		$DOB = $Year."-".$Month."-".$Day;
		$Type_Loan="Req_Loan_Personal";
		$source=$_REQUEST["source"];
		$IP = getenv("REMOTE_ADDR");
		$Dated = ExactServerdate();
		
if($Net_Salary<=239000)
		{
		$Reference_Code = generateNumber(4);
		$Direct_Allocation =1;
		$IsProcessed=1;
		$Employment_Status=1;
		}
		else
		{
			$Reference_Code = "";
			$Direct_Allocation =0;
			$IsProcessed=0;
			$Employment_Status=1;
		}



$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Personal Where (Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		$cntr=0;
	

	if($alreadyExist>0)
	{

		$ProductValue=$myrow[$cntr]['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";

	}
	else
	{
		$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			
			list($CheckNumRows,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			if($CheckNumRows>0)
			{
				$UserID = mysql_result($CheckQuery, 0, 'UserID');
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Dated"=>$Dated, "Pincode"=>$Pincode, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance, "Reference_Code"=>$Reference_Code, "Direct_Allocation"=>$Direct_Allocation, "IsProcessed"=>$IsProcessed, "Edelweiss_Compaign"=>$edelweiss);
			
			
			}
			else
			{
	$dataInsert = array("Email"=>$Email, "Name"=>$Product_Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
	$table = 'wUsers';
	$insert = Maininsertfunc ($table, $dataInsert);
				
				$UserID1 = mysql_insert_id();
				$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Dated"=>$Dated, "Pincode"=>$Pincode, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance, "Reference_Code"=>$Reference_Code, "Direct_Allocation"=>$Direct_Allocation, "IsProcessed"=>$IsProcessed, "Edelweiss_Compaign"=>$edelweiss);
				
				}
$table = 'Req_Loan_Personal';
$insert = Maininsertfunc ($table, $dataInsert);
$ProductValue = mysql_insert_id();
			
			$_SESSION['Temp_LID'] = $ProductValue;
			list($First,$Last) = split('[ ]', $Name);

	if($Net_Salary<=239000)
		{
		$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan.";
		}
		else
		{
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan.";
		}
		

			if(strlen(trim($Phone)) > 0)
		{
				NewAir2webSendSMS($SMSMessage, $Phone, 1 , $ProductValue);
		}
				//SendSMS($SMSMessage, $Phone);
		
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Personal Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Personal Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}

if($Net_Salary<=239000)
		{

			echo "<script language=javascript>"." location.href='personal-loans-apply-less.php'"."</script>";	
		}
		
	}
}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/tooltip.js"></script>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Personal Loan through Deal4loans.com. You will soon receive a call from us.</h1>

 </div>
     
  <?php include '~Bottom-new.php';?>
</div>

<script type='text/javascript'><!--//<![CDATA[

    var OA_p=location.protocol=='https:'?'https:':'http:';
    var OA_r=Math.floor(Math.random()*999999);
    document.write ("<" + "script language='JavaScript' ");
    document.write ("type='text/javascript' src='"+OA_p);
    document.write ("//n.admagnet.net/panda/www/delivery/tjs.php");
    document.write ("?trackerid=10&amp;r="+OA_r+"'><" + "/script>");
//]]>--></script><noscript><div id='m3_tracker_10' style='position: absolute; left: 0px; top: 0px; visibility: hidden;'><img src='http://n.admagnet.net/panda/www/delivery/ti.php?trackerid=10&amp;adid=&amp;sname=%%SNAME_VALUE%%&amp;Order_ID=%%ORDER_ID_VALUE%%&amp;OrderID=%%ORDERID_VALUE%%&amp;Quantity=%%QUANTITY_VALUE%%&amp;Value=%%VALUE_VALUE%%&amp;Transactionid=%%TRANSACTIONID_VALUE%%&amp;cb=%%RANDOM_NUMBER%%' width='0' height='0' alt='' /></div></noscript>
   
</body>
</html>
