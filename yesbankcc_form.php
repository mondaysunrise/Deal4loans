<?php
session_start();
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';


//$servertype='uat';


$_SESSION['servertype']='production';
//$_SESSION['servertype']='uat';
$servertype=$_SESSION['servertype'];
$dated = date("Y-m-d");
$nowdated = ExactServerdate();
$ip_address=ExactCustomerIP();

$requestid = $_REQUEST['requestid'];

$ccdetails = "select Gender,Pancard_No, Pancard,Employment_Status,Dated,DOB,Name, Email,Company_Name,City,City_Other, Mobile_Number,Net_Salary, Loan_Amount,Pincode,IP_Address, Add_Comment,Residence_Address,applied_card_name,Updated_Date,State  from Req_Credit_Card Where (RequestID=".$requestid.")";
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
$Feedback= $ccrow["Feedback"];
$CompanyName= $ccrow["Company_Name"];
$followup_date= $ccrow["Followup_Date"];
$comment_section= $ccrow["comment_section"];
$needle = 'Yes';
if (strpos($applied_card_name,$needle) !== false) {
    echo '<center><b>SELECTED Yes Bank CARD</b></center>';
}
$City = $ccrow["City"];
$City_Other = $ccrow["City_Other"];
if($City=="Others")
{
	$calcity=$City_Other;
}
else
{
	$calcity=$City;
}
$IP_Address = $ccrow["IP_Address"];




$ccba_result = d4l_ExecQuery("select * from credit_card_banks_apply where (cc_requestid=".$requestid." and applied_bankname like '%Yes%') order by id DESC");
$ccba_row=d4l_mysql_fetch_array($ccba_result);
$resi_address = $ccba_row["resi_address"];
$unserializeAddress = unserialize($resi_address);
$flatno = $unserializeAddress['flat'];
$buildingName = $unserializeAddress['building'];
$road = $unserializeAddress['road'];


	try{
			$errMsg = "";
			$flag = 0;
			
			if(empty($first_name)){
				$errMsg .= 'FirstName is empty'.'<br/>';
				$flag = 1;
			}elseif(strlen($first_name) > 15){
				$errMsg .= 'FirstName: Max length is 15 chars'.'<br/>';
				$flag = 1;
			}

			if(empty($last_name)){
				$errMsg .= 'LastName is empty'.'<br/>';
				$flag = 1;
			}elseif(strlen($last_name) < 2){
				$errMsg .= 'LastName: Min length is 2 chars'.'<br/>';
				$flag = 1;
			}elseif(strlen($last_name) > 15){
				$errMsg .= 'LastName: Max length is 15 chars'.'<br/>';
				$flag = 1;
			}
			
			if(empty($DOB)){
				$errMsg .= 'DOB is empty'.'<br/>';
				$flag = 1;
			}
			
			if(empty($Gender)){
				$errMsg .= 'Gender is empty'.'<br/>';
				$flag = 1;
			}
			
			if(empty($Mobile_Number)){
				$errMsg .= 'Mobile Number is empty'.'<br/>';
				$flag = 1;
			}elseif(!preg_match('/^[1-9][0-9]*$/', $Mobile_Number)) {
				$errMsg .= 'Mobile Number: Please enter only numbers'.'<br/>';
				$flag = 1;
			}elseif(strlen($Mobile_Number) != 10){
				$errMsg .= 'Mobile Number should be of 10 numbers'.'<br/>';
				$flag = 1;
			}elseif(substr($Mobile_Number,0,1) != 9 && substr($Mobile_Number,0,1) != 8 && substr($Mobile_Number,0,1) != 7){
				$errMsg .= 'Mobile Number should should start with 9,8 or 7'.'<br/>';
				$flag = 1;
			}
			
			if(empty($Email)){
				$errMsg .= 'Email is empty'.'<br/>';
				$flag = 1;
			}elseif(!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
				$errMsg .= 'Email format is invalid'.'<br/>';
				$flag = 1;
			}
			
					
			if(empty($City)){
				$errMsg .= 'City is empty'.'<br/>';
				$flag = 1;
			}
			if(empty($State)){
				$errMsg .= 'State is empty'.'<br/>';
				$flag = 1;
			}
			if(empty($Pincode)){
				$errMsg .= 'Pincode is empty'.'<br/>';
				$flag = 1;
			}elseif(strlen($Pincode) != 6){
				$errMsg .= 'Pincode should be of 6 numbers'.'<br/>';
				$flag = 1;
			}elseif(!preg_match('/^[1-9][0-9]*$/', $Pincode)) {
				$errMsg .= 'Pincode: Please enter only numbers'.'<br/>';
				$flag = 1;
			}

		
			
			if(empty($Pancard)){
				$errMsg .= 'PAN is empty'.'<br/>';
				$flag = 1;
			}elseif(strlen($Pancard) != 10){
				$errMsg .= 'PAN should be of 10 numbers'.'<br/>';
				$flag = 1;
			}elseif(!preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $Pancard)) {
				$errMsg .= 'PAN is invalid'.'<br/>';
				$flag = 1;
			}
			
			
		
			
			
			if($flag){
				throw new Exception($errMsg);
			}
		}catch(Exception $e){
			echo $e->getMessage().'<br/>'.'<strong>Please fill all required fields</strong>';
			exit;
		}

	
	$mobile_code = generateNumber(4);
	$email_code = generateNumber(6);
	
	
	$getdetails="select id, counter From experian_initial_details WHERE mobileNo not in (9971396361,9811215138) AND ( mobileNo='".$Mobile_Number."') AND (dated > DATE_SUB(NOW(), INTERVAL 100 DAY)) AND cibil_score!=0";
	//echo "<br>".$getdetails."<br>";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
		if($alreadyExist>0)
		{
			$verify=0;	
			$insertID = $myrow[$myrowcontr]["id"];
			$counter = $myrow[$myrowcontr]["counter"];
			$counter = $counter +1;
			$dataInsert= array("counter"=>$counter, 'email_code'=> Fixstring($email_code), 'mobile_code'=>Fixstring($mobile_code), 'dated'=>Fixstring($nowdated), 'mobile_verified'=>$verify, 'email_verified'=>$verify);
			$wherecondition =" (id=".$insertID.")";
			$insertSql = array('step'=> 'Duplicate', 'status'=> 'First Step', 'message'=> 'First Step', 'requestid'=>Fixstring($insertID), 'Dated'=>$nowdated);
			Maininsertfunc ('experian_log', $insertSql);
			header("Location: https://www.deal4loans.com/yesbankcc_result.php?insertID=".$insertID);
			exit();
		//	Mainupdatefunc ('experian_initial_details', $dataInsert, $wherecondition);
			//Redirect 
		}
		else
		{
			$counter=1;
			$product='CC';
			$dataInsert = array('firstName'=> Fixstring($first_name), 'middleName'=> Fixstring($middle_name), 'surName'=>Fixstring($last_name), 'mobileNo'=> Fixstring($Mobile_Number), 'email'=> Fixstring($Email), 'email_code'=> Fixstring($email_code), 'mobile_code'=>Fixstring($mobile_code), 'counter'=>$counter, 'dated'=>Fixstring($nowdated), 'ip_address'=>Fixstring($IP_Address), 'requestid'=>Fixstring($requestid), 'flatno'=>Fixstring($flatno), 'buildingName'=>Fixstring($buildingName), 'road'=>Fixstring($road), 'pincode'=>Fixstring($Pincode), 'pan'=>Fixstring($Pancard), 'product'=>Fixstring($product), 'state'=>Fixstring($State), 'city'=>Fixstring($City), 'dob'=>Fixstring($DOB));

			$insertID = Maininsertfunc ('experian_initial_details', $dataInsert);
		}
		
		//print_r($dataInsert);
	
		
		if(strlen(trim($Mobile_Number)) > 0)
		{
			$SMSMessage = "The OTP for verifying your mobile number at Deal4loans.com is ".$mobile_code.". This password is valid for one transaction or 30 mins from the time it is generated, whichever is early.";		
			//echo "<br>Send SMS";
			SendSMSforLMS($SMSMessage, $Mobile_Number);
		}
	
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
		$Message = '<table align="center" style="max-width:600px; margin:auto;" width="100%" cellpadding="0" cellspacing="0"><tr><td colspan="3" bgcolor="#0c60b6">&nbsp;</td></tr><tr><td colspan="3" align="right" bgcolor="#0c60b6"><img src="http://www.deal4loans.com/images/cc/crdt-crd-logo.gif" style="margin-right:25px;" /></td></tr><tr><td colspan="3" bgcolor="#0c60b6">&nbsp;</td></tr><tr><td width="5%" bgcolor="#0C60B6">&nbsp;</td><td width="90%" rowspan="5" valign="top" style="border-radius:5px 5px;"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3" style="color:#171717; font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold;">Dear '.$first_name.',</td></tr><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3" style="color:#4c4c4c; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:21px;">Thank you for considering <strong style="color:#292929;">Deal4loans</strong> for Comparing Loan and credit card deals. We are India\'s Largest Financial Comparative platform with an association with India\'s Top Banks/NBFC\'s for Loan &amp; Credit card.</td></tr><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3" style="color:#4c4c4c; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:21px;">We are continuously working towards getting you the best deal on your  requirement basis your profile/eligibility.</td></tr><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3" style="color:#4c4c4c; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:21px;">In this endeavor we have facilitated you with a free of charge  Experian credit score check  to make the appropriate choice. This will help your application process faster as  lenders  do consider  your Credit score in decision making process.</td></tr><tr><td colspan="3">&nbsp;</td></tr><tr><td height="30" colspan="3"  style="font-family:Arial, Helvetica, sans-serif; font-size:14px;">By Successfully verifying your email id with the below OTP , you  authorize deal4loans to fetch your Credit score on your behalf and hereby agree to the <a href="http://www.deal4loans.com/terms-of-use.php">Terms & Conditions</a>  and	<a href="http://www.deal4loans.com/Privacy.php">Privacy Policy</a></td></tr><tr><td colspan="3" style="color:#4c4c4c; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:21px;">Please enter the below mentioned One time password (OTP)  to verify your email id:</td></tr><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3"><table width="191" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="51" align="center" bgcolor="#0C60B6" style="color:#ebf1f6; font-size:22px; font-family:Arial, Helvetica, sans-serif;">'.$email_code.'</td></tr></table></td></tr><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3" bgcolor="#DCE8F4">&nbsp;</td></tr><tr><td height="25" colspan="3" style="color:#010101; font-family:Arial, Helvetica, sans-serif; font-size:14px;">Regards</td></tr><tr><td colspan="3" style="color:#010101; font-family:Arial, Helvetica, sans-serif; font-size:14px;">Team Deal4loans.com</td></tr><tr><td colspan="3" style="color:#010101; font-size:10px; font-family:Arial, Helvetica, sans-serif;">Loans by choice not by chance!!</td></tr><tr><td colspan="3">&nbsp;</td></tr></table></td><td width="5%" bgcolor="#0C60B6">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td valign="top" bgcolor="#BDD8EF">&nbsp;</td><td bgcolor="#bdd8ef">&nbsp;</td></tr><tr><td bgcolor="#bdd8ef">&nbsp;</td><td valign="top" bgcolor="#BDD8EF">&nbsp;</td><td bgcolor="#bdd8ef">&nbsp;</td></tr></table>';			
		$SubjectLine = $first_name .", Verify your Cibil Score Request on Deal4loans.com";
		mail($Email, $SubjectLine, $Message, $headers);




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="css/apply-personal-loans-lp-styles-new2-11-2015.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="css/pl_apply-tab_styles-new11-2-2015.css" />
<link href="css/personal-loans-new-lp-11-2-2015.css" type="text/css" rel="stylesheet" />
<title>Check Credit Score</title>
<meta name="keywords" content="Check Credit Score" />
<meta name="description" content="Check Credit Score" />
<link href="css/personal-loan-styles.css" type="text/css" rel="stylesheet"  />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="javascript">
function Trim(strValue) 
{
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}

function containsdigit(param)
{
	mystrLen = param.length;
	for(i=0;i<mystrLen;i++)
	{
		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
		{
			return true;
		}
	}
	return false;
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
</script>
</head>
<body>
<?php include "middle-menu.php";
 ?>
<div class="d4l_inner_wrapper">
<div style="margin-top:70px;"></div>
<div  class="common-bread-crumb"><a href="index.php">Home</a> > Credit Score </div>
<div style="margin:auto;">
  <div class="left-wrapper">
    <div>
      <h1 class="pl-h1">Credit Score</h1>
      <div style="clear:both;"></div>
      <div style="clear:both; height:15px;"></div>
      <!--class="lfttxtbar" -->
      <div id="txt">
        <div class="pl-bank-leftinn inner-body-plbanks" style="padding:10px;">
<form name="creditscore_form" action="yesbankcc_update.php" method="POST" onSubmit="return chkcreditscore(document.creditscore_form);">
<input name="insertID" id="insertID" type="hidden"  value="<?php echo $insertID; ?>" />
<input type="hidden" name="servertype" value="<?php echo $servertype; ?>"  />
<table width="100%" border="0" cellpadding="3" cellspacing="2">
<?php if(strlen($_SESSION['msg'])>0) {?>
  <tr>
    <td colspan="2" class="personal_text" style="font-weight:bold; color:#900;"><?php echo $_SESSION['msg']; ?></td>
  </tr>
  <?php } ?>
  <?php if(strlen($_GET['msg'])>0 ) {?>
  <tr>
    <td colspan="2" class="personal_text" style="font-weight:bold; color:#900;"><?php echo $_GET['msg']; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="2" class="personal_text">Please validate the mobile number for <?php ?></td>
  </tr>
    
<tr>    <td height="45" class="form_text">Mobile Verification Code</td>    <td class="alert_msg"><input name="mobile_code" id="mobile_code" type="text"  value="<?php echo $mobile_code; ?>"  class="input" /><!--<div id="flatnoVal">Mobile Code - <?php //echo $mobile_code; ?></div>--> </td>  </tr>

<tr>    <td height="45" class="form_text">Email Verification Code</td>    <td class="alert_msg"><input name="email_code" id="email_code" type="text" value="<?php echo $email_code; ?>" class="input" /><!--<div id="buildingNameVal">Email Code - <?php //echo $email_code; ?></div>--></td>  </tr>

  <tr>    <td height="45" colspan="2" align="center">
 	<input type="hidden" name="reason" value="Find out my credit score" /> 
  <input type="image" name="Submit" src="images/login-form-lgn-sbtn.gif" width="119" height="45" tabindex="25" /></td>    </tr>   
  <tr>
    <td height="20" colspan="2" align="center" class="form_text">&nbsp;</td>
  </tr>
</table>
		  </form>
        </div>
      </div>
     
    </div>
  </div>
  <div class="right-panel">
    <?php //include "right-widget.php"; ?>
  </div>
</div>
<div></div>
</div>

<?php include("footer_sub_menu.php"); ?>
<?php //print_r($_GET); ?>
</body>
</html>