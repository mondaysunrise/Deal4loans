<?php
session_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
$dated = date("Y-m-d");
$nowdated = ExactServerdate();
$ip_address=ExactCustomerIP();


$cc_bankid = $_REQUEST["cc_bankid"];
$RequestID = $_REQUEST["RequestID"];
$requestid = $_REQUEST["RequestID"];
$cc_name = $_REQUEST["cc_name"];

$updateArr = array("applied_card_name"=>$cc_name);
$UpdateWhereCond ="(RequestID='".$requestid."')";
Mainupdatefunc("Req_Credit_Card", $updateArr, $UpdateWhereCond);	


$ccdetails = "select Gender,Pancard_No, Pancard,Employment_Status,Dated,DOB,Name, Email,Company_Name,City,City_Other, Mobile_Number,Net_Salary, Loan_Amount,Pincode,IP_Address, Add_Comment,Residence_Address,applied_card_name,Updated_Date,State,Reference_Code  from Req_Credit_Card Where (RequestID=".$requestid.")";
//echo $ccdetails."<br>";
$ccdetailsresult = d4l_ExecQuery($ccdetails);
$ccrow=d4l_mysql_fetch_array($ccdetailsresult);
$applied_card_name = $ccrow["applied_card_name"];
list($first_name,$middle_name,$last_name) = explode(" ",$ccrow["Name"]);
if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
{
	$last_name= $middle_name;
	$middle_name="";
}
else
{
	if($last_name=="")
	{
		$last_name= "Kumar";
	}
}
if($middle_name=="Middle Name")
{
	$middle_name="";
}
$State= $ccrow["State"];
$Gender = $ccrow["Gender"];
$DOB = $ccrow["DOB"];
list($year,$mm,$dd) = explode("-",$ccrow["DOB"]);
$Residence_Address = $ccrow["Residence_Address"];
$Pincode = $ccrow["Pincode"];
$Email = $ccrow["Email"];
$Mobile_Number = $ccrow["Mobile_Number"];
$Employment_Status = $ccrow["Employment_Status"];
$Net_Salary = $ccrow["Net_Salary"];
$monthlyincome = round($ccrow["Net_Salary"]/12);
$Pancard = $ccrow["Pancard"];


$mobile_code = $ccrow["Reference_Code"];
$email_code = generateNumber(6);
	
	
	//$getdetails="select id, counter From experian_initial_details WHERE mobileNo not in (9971396361,9811215138) AND ( mobileNo='".$Mobile_Number."') AND (dated > DATE_SUB(NOW(), INTERVAL 100 DAY)) AND cibil_score!=0";
	$getdetails="select id, counter From experian_initial_details WHERE ( mobileNo='".$Mobile_Number."') AND product='CC' AND (dated > DATE_SUB(NOW(), INTERVAL 100 DAY)) AND cibil_score!=0";
	//echo "<br>".$getdetails."<br>";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
		if($alreadyExist>0)
		{
			$verify=0;	
			$insertID = $myrow[$myrowcontr]["id"];
			$updateReqIDArr = array("requestid"=>$RequestID);
			$UpdateReqIDWhereCond ="(id='".$insertID."')";
			Mainupdatefunc("experian_initial_details", $updateReqIDArr, $UpdateReqIDWhereCond);	
			$insertSql = array('step'=> 'Duplicate', 'status'=> 'First Step', 'message'=> 'First Step', 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
			Maininsertfunc ('experian_log', $insertSql);
			header("Location: https://www.deal4loans.com/yes-bank-credit-card-result.php?insertID=".$insertID);
			exit();
			//Redirect Already in Queue
		}
		else
		{
			$counter=1;
			$product='CC';
			$dataInsert = array('firstName'=> Fixstring($first_name), 'middleName'=> Fixstring($middle_name), 'surName'=>Fixstring($last_name), 'mobileNo'=> Fixstring($Mobile_Number), 'email'=> Fixstring($Email), 'email_code'=> Fixstring($email_code), 'mobile_code'=>Fixstring($mobile_code), 'counter'=>$counter, 'dated'=>Fixstring($nowdated), 'ip_address'=>Fixstring($IP_Address), 'requestid'=>Fixstring($requestid), 'flatno'=>Fixstring($flatno), 'buildingName'=>Fixstring($buildingName), 'road'=>Fixstring($road), 'pincode'=>Fixstring($Pincode), 'pan'=>Fixstring($Pancard), 'product'=>Fixstring($product), 'state'=>Fixstring($State), 'city'=>Fixstring($City), 'dob'=>Fixstring($DOB));

			$insertID = Maininsertfunc ('experian_initial_details', $dataInsert);
			
			$insertSql = array('step'=> 'Step 1', 'status'=> 'Data Inserted', 'message'=> '1st Stage Form', 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
			Maininsertfunc ('experian_log', $insertSql);
			
			if(strlen(trim($Mobile_Number)) > 0)
			{
				$SMSMessage = "The OTP for verifying your mobile number at Deal4loans.com is ".$mobile_code.". This password is valid for one transaction or 30 mins from the time it is generated, whichever is early.";		
				//echo "<br>Send SMS";
				SendSMSforLMS($SMSMessage, $Mobile_Number);
			}
			//header
			 header("Location: https://www.deal4loans.com/yes-bank-credit-card-continue.php?RequestID=". $requestid."&insertID=".$insertID."&cc_bankid=".$cc_bankid."&cc_name=".$cc_name);
             exit();
		}
		