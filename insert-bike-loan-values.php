<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'eligiblebidderfuncCL.php';
	session_start();
	
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$last_id = FixString($last_id);
		$Phone = FixString($Phone);
		$Email = FixString($Email);
		$Activate = FixString($Activate);
		$City = FixString($City);
		$Employment_Status = FixString($Employment_Status);
		$City_Other = FixString($City_Other);
		$Pincode = FixString($Pincode);
		$Net_Salary = FixString($Net_Salary);
		$bike_manufacturer = FixString($bike_manufacturer);
		$bike_model = FixString($bike_model);
		$Loan_Tenure = FixString($Loan_Tenure);
		$Loan_Amount = FixString($Loan_Amount);
		$accept = FixString($accept);
		$Net_Salary_Monthly = $Net_Salary / 12;
		$IsPublic = 1;
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$Reference_Code = generateNumberNEWc(5);

		$IP=ExactCustomerIP();

		$QArequestid = $_REQUEST["QArequestid"];
		$ABMMU_flag = $_REQUEST["adty_brl"];
		$sbiCCOffer = FixString($_REQUEST["sbiCCOffer"]);
		$Company_Name = FixString($_REQUEST["Company_Name"]);
		
		$n       = count($From_Product);
		$i      = 0;
		//echo $n."<br>";
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
		  
$final_url=$_SERVER['HTTP_REFERER'];
$_SESSION['final_url'] = $final_url;
$_SESSION['Net_Salary'] = $Net_Salary;
$_SESSION['City']= $City;
$_SESSION['City_Other']= $City_Other;
$QArequestid = $_SESSION['Temp_Last_Inserted'];
$Dated = ExactServerdate();
	$Type_Loan="Req_Loan_Bike";

		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		/*if($crapValue=='Put')
		{*/
			$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
	function  Insert_SBICCOffers($Employment_Status, $Net_Salary, $City, $Name, $Phone, $Email, $DOB,  $Product, $ProductValue,$IP )
	{
		$Dated = ExactServerdate();
		if($Net_Salary>=210000)
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			$Dated = ExactServerdate();
			$getdetailsCC = "select sbiccoffersid as RequestID From sbi_ccoffers_directonsite Where ( sbicc_mobile not in (9971396361,9999570210,9811215138,9811555306,9873678914,9555060388,9311773341) and sbicc_mobile='".$Phone."' and sbicc_dated between '".$days30datetime."' and '".$currentdatetime."') order by sbiccoffersid DESC";
			list($alreadyExistCC,$myrowCC)=MainselectfuncNew($getdetailsCC,$array = array());

			if($alreadyExistCC>0)
			{
			}
			else
			{
				$dataInsert = array('sbicc_name'=>$Name, 'sbicc_dob'=>$DOB, 'sbicc_email'=>$Email, 'sbicc_mobile'=>$Phone, 'sbicc_occupation'=>$Employment_Status, 'sbicc_net_salary'=>$Net_Salary, 'sbicc_city'=>$City, 'sbicc_product'=>'10', 'sbicc_requestid'=>$ProductValue, 'sbicc_dated'=>$Dated, 'IP_Address'=>$IP);
				//print_r($dataInsert);
				$ProductValue = Maininsertfunc ('sbi_ccoffers_directonsite', $dataInsert);
				// exit();
			}
		}
	}

if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	$Dated = ExactServerdate();
	$getdetails="select RequestID From Req_Loan_Bike Where ( Mobile_Number not in (9971396361,9999570210,9811215138,9811555306,9873678914,9555060388,9311773341) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
	if($alreadyExist>0 && $source!="CLQuickapply")
	{
		$ProductValue = $myrow[$myrowcontr]["RequestID"];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-bike-loan-lead.php'"."</script>";
	//Already Applied

	}
	else
	{
		//		echo "<br>if".$InsertProductSql;
		$dataInsert = array('UserID'=>0, 'Name'=>$Name, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Bike_Type'=>'New', 'Dated'=>$Dated, 'source'=>$source, 'Pincode'=>$Pincode, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'DOB'=>$DOB,  'Bike_Model'=>$bike_model, 'Updated_Date'=>$Dated, 'Email'=>$Email, 'Loan_Tenure'=>$Loan_Tenure, 'Reference_Code'=>$Reference_Code, 'Privacy'=>$accept);	
		$ProductValue = Maininsertfunc ('Req_Loan_Bike', $dataInsert);
		
		//Send SMS
		ProductSendSMStoRegis($Phone);
		
			$lastInserted = $ProductValue;
			$_SESSION['Temp_LID'] = $ProductValue;
			$client_transaction_id = $lastInserted."_CL";
			$SMSMessage = "Please use this code: ".$Reference_Code."  to activate you loan request at deal4loans.com";

			if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMSMessage, $Phone);
			//$zipdimage = mobile_verify($Phone,$client_transaction_id);
			//sbi CC Offers
			if($sbiCCOffer==1)
			{
				//echo "dd";
				Insert_SBICCOffers($Employment_Status, $Net_Salary, $City, $Name, $Phone, $Email, $DOB,  $Product, $ProductValue,$IP);
			}

			list($First,$Last) = split('[ ]', $Name);

			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: newtestthankuse@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Two Wheeler";
			else
				$SubjectLine = "Learn to get Best Deal on Two Wheeler";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
		
	if(count($finalBidderName)==0) 
		{
		if(strlen($Email)>0)
			{
			$Message="<table width='700' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'> <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr>     <td width='40%' valign='top'></td>        <td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />          <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td>      </tr>    </table></td>  </tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><b>Dear $Name,</b><p>As per your profile, no bank is associated with us to serve your <b>Two Wheeler</b> requirement. We will not be able to service your request and hence we are not sharing your details with any bank.</p><p>&nbsp; <br />
  Regards</p>
Team Deal4loans.com <br /><br /></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Loan Quiz</a></td><td align='center' valign='middle'></td><td align='center' valign='middle'></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Bimadeals.com </a></td><td align='center' valign='middle'>  </td></tr></table></td></tr></table>";
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= "Bcc: testthankuse@gmail.com"."\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//mail($Email,'Thanks for Registering for Two Wheeler Loan on deal4loans.com', $Message, $headers);
			}
		//	header("Location: thank_bike-loan.php");
			//	exit();
		}
	}

		}
		else
		{	//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}
}
$Reference_Code;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<title>Two Wheelers | Apply Two Wheelers online | Compare Two Wheelers</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="apply Two Wheeler, Two Wheelers online, apply online Two Wheelers, Car Motor loans India, Apply Car Motor Loans, Compare Two Wheelers in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Two Wheelers – Compare and Choose Best Two Wheelers schemes from all loan provider banks of India.">
<link href="css/personal-loan-sbi-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="source.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var j;
	var cnt=-1;
	
	if(document.car_loan_verify.activation_code.value=="")
	{
		//document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		alert("Enter Activation Code");
		document.car_loan_verify.activation_code.focus();
		return false;
	}
	else if(document.car_loan_verify.activation_code.value!='<?php echo $Reference_Code; ?>')
	{
		alert("Please Enter correct Activation Code");
		document.car_loan_verify.activation_code.focus();
		return false;
	}
	return true;
}
</script>
</head>
<body><?php include "middle-menu.php"; ?>
<div class="pl_sbi_wrapper">
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <u>Two Wheeler Loan</u> </div>
<div style="clear:both; height:25px;"></div>
<div class="text12" style="margin:auto; width:100%;"> 
<? if($source=="CLQuickapply")
	  {$lastInserted = $QArequestid; }?>
	  <form name="car_loan_verify" action="thank_bike-loan.php" method="post" onSubmit="return chkform();" >
         <input type="hidden" name="RequestID" id="RequestID"  value="<? echo $lastInserted; ?>" >
	 <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
	 <input type="hidden" name="Reference_Code" id="Reference_Code" value="<? echo $Reference_Code; ?>">
<div class="hl_emi_cal_form">
 <div class="pl_emi_cal_text">
   <div class="text3" style=" color:#FFF; font-size:15px; text-transform:none; font-weight:bold; line-height:25px; width:95%">
 Please verify your Mobile Number.  We have sent an activation code on <span style="font-size:18px;"><? echo $_REQUEST['Phone']; ?>
 <br />
 Based on your mobile number validation we will be giving you comparison from HDFC Bank &amp; others </span></div>
  </div>

<div class="inser_cl_input">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="36%"><span class="text" style=" float:left;  height:auto; color:#FFF; font-size:12px; text-transform:none;">Activation Code</span></td>
      <td width="64%" align="left"><input name="activation_code" id="activation_code" type="text" style="width:100px; height:18px;" onkeydown="validateDiv('nameVal');"  maxlength="5"/></td>
    </tr>
  </table>
</div>
<div class="inser__btn_box">  <input type="submit" class="pls-get-quotebtn" value="Get Quote"/></div>
</div></form>
</div>
<div style="clear:both; height:15px;"></div>
<div style="width:100%;">
<span class="frmbldtxt" style="font-weight:bold; color:#D02037;">
<div id="showMagmaNano"></div>
</span>
<span class="frmbldtxt" style="font-weight:normal; font-size:14px; color:#000000;">1) Get call back assistance on <span style="color: #D02037;">verified mobile number</span> directly from all the comparable banks within 24 hours. <br />
2) Provides you with the best suitable offers.<br />
3) Help in processing your loan faster. </span></div>
</div>

<div style="clear:both; height:15px;"></div></div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>
<? function generateNumberNEWc($plength)
{
	if(!is_numeric($plength) || $plength <= 0)
	{
	    $plength = 8;
	}
	if($plength > 32)
	{
	    $plength = 32;
	}

	$chars = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	mt_srand(microtime() * 1000000);
	for($i = 0; $i < $plength; $i++)
	{
	   $key = mt_rand(0,strlen($chars)-1);
	   $pwd = $pwd . $chars{$key};
	}
	   for($i = 0; $i < $plength; $i++)
	{
	    $key1 = mt_rand(0,strlen($pwd)-1);
	    $key2 = mt_rand(0,strlen($pwd)-1);

	    $tmp = $pwd{$key1};
	    $pwd{$key1} = $pwd{$key2};
	    $pwd{$key2} = $tmp;
	}

	return $pwd;
}
?>