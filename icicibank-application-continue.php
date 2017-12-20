<?php
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
//print_r($_SERVER);

//print_r($_POST);
function DetermineAgeGETDOB ($YYYYMMDD_In) {  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;   if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }	

function generateNumberNEWc($plength)
{
	if(!is_numeric($plength) || $plength <= 0)	{	    $plength = 8;	}	if($plength > 32)	{	    $plength = 32;	}	$chars = '123456789';	mt_srand(microtime() * 1000000);
	for($i = 0; $i < $plength; $i++)	{	   $key = mt_rand(0,strlen($chars)-1);	   $pwd = $pwd . $chars{$key};	}
	for($i = 0; $i < $plength; $i++) { $key1 = mt_rand(0,strlen($pwd)-1);  $key2 = mt_rand(0,strlen($pwd)-1);  $tmp = $pwd{$key1}; $pwd{$key1} = $pwd{$key2}; $pwd{$key2} = $tmp; }
	return $pwd;
}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$cust_loan = $_POST['cust_loan'];
		$relationship = $_POST["relationship"];
		$City = $_POST["City"];
		$Email = $_POST["Email"];		
		$Employment_Status = $_POST["Employment_Status"];
		$Company_Name = $_POST["Company_Name"];
		$Net_Salary = $_POST["Net_Salary"] * 12;
		
		$total_emi = $_POST["total_emi"];
		$other_emi = $_POST["other_emi"];
		$Phone = $_POST["Phone"];
		$source = $_POST["source"];
		$Name = $_POST["Name"];
		$Reference_Code = generateNumberNEWc(5);
		$stat_code = $Reference_Code;
		
		$getDOB = str_replace("-","", $DOB);
		//$age = DetermineAgeGETDOB($getDOB);
		$age = $_POST['age'];
		$year = date("Y") - $age;
		$DOB =$year."-".date("m")."-".date("d");
		$Company_Type=0;
//		$IP = getenv("REMOTE_ADDR");
		$IP = $_SERVER['HTTP_X_REAL_IP'];
		if(strlen($IP)>4)
		{} else {
			$IP = getenv("REMOTE_ADDR");
		}
		$monthly_income= $Net_Salary/12;

		if($relationship=="SALARY_ACCOUNT" || $relationship=="SAVINGS_ACCOUNT" || $relationship=="CURRENT_ACCOUNT")
		{
			$Primary_Acc="ICICI";
		}

		$getcompany='select org_type from  icici_organisation_list where organisation_name="'.$Company_Name.'"';
		list($recordcount,$grow)=Mainselectfunc($getcompany,$array = array());

		$org_type = $grow["org_type"];
if($Employment_Status==1)
{

$checkld=("select `iciciappid` From icici_exclusive_app Where (iciciapp_mobile_number=".$Phone.")");
list($recordcount,$chkld)=Mainselectfunc($checkld,$array = array());

		$chkld=mysql_fetch_array($checkld);
if($chkld["iciciappid"]>0)
		{
			header('Location: https://www.deal4loans.com/icici-bankstep4.php');
			exit();
		}
		else
		{
		$SMSMessage = "Please use this code: ".$Reference_Code."  to activate you loan request at deal4loans.com";
		if(strlen(trim($Phone)) > 0)
		{
			SendSMSforLMS($SMSMessage, $Phone);
		}

		$Dated = ExactServerdate();
		$data = array('iciciapp_relation'=>$relationship, 'iciciapp_city'=>$City, 'iciciapp_dob'=>$DOB, 'iciciapp_occupation'=>$Employment_Status, 'iciciapp_company_name'=>$Company_Name, 'iciciapp_salary'=>$Net_Salary, 'iciciapp_secure_emi'=>$total_emi, 'iciciapp_unsecure_emi'=>$other_emi, 'iciciapp_ipaddress'=>$IP, 'iciciapp_dated'=>$Dated, 'customer_loan_amt'=>$cust_loan, 'iciciapp_name'=>$Name, 'iciciapp_mobile_number'=>$Phone, 'source'=>$source, 'age'=>$age, 'Reference_Code'=>$stat_code, 'Is_Valid'=>$Is_Valid, 'iciciapp_email'=>$Email);
		$table = 'icici_exclusive_app';
		$ProductValue = Maininsertfunc ($table, $data);

	$Message2 = "<table width='660' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td width='660' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='660' height='101' /></td></tr><tr><td><table width='660' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td><td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Dear $Name</b>,<br />Thanks for applying for ICICI Bank Personal Loan through Deal4loans.com. Kindly verify your email address by clicking the link below. This will confirm your personal loan request.<br /><br /><a href='http://www.deal4loans.com/pliciciev.php?id=".$ProductValue."'>http://www.deal4loans.com/pliciciev.php?id=".$ProductValue."</a></td></tr><tr><td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; width:300px;'><br /></td></tr><tr>  <td width='307' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>&nbsp;</td><td width='243' align='right' valign='top'>&nbsp;</td></tr><tr><td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Regards</b> <br />Team Deal4loans.com<br />Loans by choice not by chance!!<br /><div style='text-align:center;'></div></td><td width='1'></td></tr></table></td><td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td></tr></table></td></tr><tr><td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='660' height='20' /></td></tr></table>";
			$headers = "From: deal4loans <no-reply@deal4loans.com>";
			$semi_rand = md5( time() ); 
        	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
	        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
			$headers .= "Bcc: testthankuse@gmail.com"."\n";
		    $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
             $Message2 . "\n\n";
		$SubjectLine = "Email Verification on Deal4loans.com";
				mail($Email, $SubjectLine, $message, $headers);

}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan</title>
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link href="newicici-pl-styles-12.css" type="text/css" rel="stylesheet" />
 <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
        <script type="text/javascript" src="scripts/common.js"></script>
	<!-- jQuery and the Poshy Tip plugin files -->
	<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="jquery.poshytip.js"></script>
<script src="javascript-browser.js" type="text/javascript"></script>
<script type="text/javascript">
		//<![CDATA[
		$(function(){

			$('#comp-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#sal-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#rela-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#obli-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#emi-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#occupa-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#te-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#dob-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#city-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
		});
				//]]>




function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

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

function chkpersonalloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	if (document.loan_form.cust_loan.value=="" || document.loan_form.cust_loan.value=="Enter the amount")
	{
		document.getElementById('custLoanVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.cust_loan.focus();
		return false;
	}	
}  
	</script>
   
    <style type="text/css">

		.flickr-thumbs {
			overflow:hidden;
		}
		.flickr-thumbs a {
			float:left;
			display:block;
			margin:0 3px;
			border:1px solid #333;
		}
		.flickr-thumbs a:hover {
			border-color:#eee;
		}
		.flickr-thumbs img {
			display:block;
			width:60px;
			height:60px;
		}
		.alert_msg{color:#FF0000; font-weight:bold; font-size:12px; font-family: Verdana, Geneva, sans-serif;}
		.input-bx1{ width:100px; height:28px; border:#eb7f10 solid thin; border-radius:5px; font-family:Verdana, Geneva, sans-serif;}
	</style>
</head>
<body>	
<hr>
<div class="header">
<div class="header-inner">
<div class="logo" style="font-family:Arial, Helvetica, sans-serif; color:#06396b; font-size:22px; font-weight:bold; width:600px !important;">Get Instant Quote on ICICI Bank Personal Loans</div><!--<div class="logo"><img src="images/icici-app-logo.jpg" width="189" height="47"></div>-->
<div class="right-box-app"><span class="text-a">Powered by</span> <br>
<span class="text-a" style="color:#0f8eda; font-size:18px;">Deal4loans.com</span></div>
<div style="clear:both;"></div>
</div>
</div>
<div class="wrapper">
<div class="left-container">
<div style="clear:both"></div>
<div id="wrapper">
   <div id="container">
<?php 
if($Employment_Status==1)
{
?>
<form id="myform" onSubmit="return chkpersonalloan('document.loan_form');" action="icicibank-application-second-page.php" method="post" name="loan_form">
<input type="hidden" name="Employment_Status" id="Employment_Status" value="<?php echo $Employment_Status; ?>">
<input type="hidden" name="Company_Name" id="Company_Name" value="<?php echo $Company_Name; ?>">
<input type="hidden" name="Net_Salary" id="Net_Salary" value="<?php echo $Net_Salary; ?>">
<input type="hidden" name="total_emi" id="total_emi" value="<?php echo $total_emi; ?>">
<input type="hidden" name="other_emi" id="other_emi" value="<?php echo $other_emi; ?>">
<input type="hidden" name="Phone" id="Phone" value="<?php echo $Phone; ?>">
<input type="hidden" name="source" id="source" value="<?php echo $source; ?>">
<input type="hidden" name="Name" id="Name" value="<?php echo $Name; ?>">
<input type="hidden" name="age" id="age" value="<?php echo $age; ?>">
<input type="hidden" name="ProductValue" id="ProductValue" value="<?php echo $ProductValue; ?>">
<input type="hidden" name="cust_loan" id="cust_loan" value="<?php echo $cust_loan; ?>">
<input type="hidden" name="relationship" id="relationship" value="<?php echo $relationship; ?>">
<input type="hidden" name="City" id="City" value="<?php echo $City; ?>">
<input type="hidden" name="stat_code" id="stat_code" value="<?php echo $stat_code; ?>">

<div class="form-wrapper-app">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td colspan="2" align="left" class="formbodytext" style="font-size:18px; color:#000;">Validate your Mobile Number</td>
         </tr>
         <tr>
           <td width="51%" align="left" class="formbodytext">&nbsp;</td>
           <td width="49%" align="left" class="formbodytext">&nbsp;</td>
         </tr>
       <tr><td colspan="2" height="15"></td></tr><tr><td width="51%" valign="top" class="formbodytext">Activation Code (Sent on your Mobile)</td>
       <td width="49%" valign="top" class="formbodytext"><input type="text" name="activation_code" id="activation_code" class="input-bx1"  onKeyPress="intOnly(this);" maxlength="5" tabindex="11" autocomplete="off" />  <div id="verifyVal" class="alert_msg"></div> </td></tr>
         <tr>
           <td colspan="2" class="formbodytext" height="19"></td>
         </tr>
      
         <tr>
           <td colspan="2" class="formbodytext" height="10"><table width="100%" border="0" cellpadding="0" cellspacing="0"> <tr>
           <td width="37%" class="formbodytext" style="font-size:10px;">&nbsp;</td>
           <td width="63%" align="center" class="formbodytext" style="font-size:10px;"><input type="submit" style="border: 0px none ; background: url(images/submit-app.png); width: 135px; height: 40px; margin-bottom: 0px; font-size:1px;" tabindex="13"/> </td>
         </tr></table></td>
         </tr>
         
         <tr>
           <td colspan="2" >&nbsp;                 </td></tr>
        
         <tr>
           <td colspan="2" class="formbodytext" ><p class="formbodytext" style="font-size:18px; color:#000;">Or </p>
             <p>Give a missed call from <strong><?php echo $Phone; ?></strong> to xxxxxxxxxx for verify your mobile number.</p><br>
             <br>
Verify your email address<br>
<span style="font-weight:normal; font-size:13px;">A confirmation email has been sent to <strong><?php echo $Email; ?></strong>. <br>Click on the confirmation link in the email to complete your application</span></td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" style="font-size:10px;"><!--<strong>Disclaimer: </strong>All loans are on sole discretion on the banks --></td>
         </tr>
       </table>
   </div>
  
   
   
    </form>
   <?php
   }
   else
   {
   ?>
   <div class="form-wrapper-app">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td colspan="2" align="left" class="formbodytext" style="font-size:18px; color:#000;">We're sorry.<br> Our engine could not locate an offer for you at this time.</td>
         </tr>
         </table></div>
   <?php
   }
   ?>
    </div>
  </div>

</div>
<div class="right-panel">
<div class="box-right"><img src="images/instant-banner.jpg" width="100%" height="278"></div>

</div>
</div>
</body>
</html>