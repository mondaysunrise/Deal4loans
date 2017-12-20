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
		$Age = FixString($Age);
		$DOB=$Year."-".$Month."-".$Day;
		$last_id = FixString($last_id);
		$Phone = FixString($Phone);
		$Email = FixString($Email);
		$Activate = FixString($Activate);
		$City = FixString($City);
		$Car_Type = FixString($Car_Type);
		$Employment_Status = FixString($Employment_Status);
		$Car_Insurance = FixString($Car_Insurance);
		$City_Other = FixString($City_Other);
		$Pincode = FixString($Pincode);
		$Net_Salary = FixString($Net_Salary);
		$Ibibo_compaign = FixString($Ibibo_compaign);
		$Car_Model = FixString($Car_Model);
		$Car_Varient = FixString($Car_Varient);
		$Loan_Tenure = FixString($Loan_Tenure);
		$Car_Booked = FixString($Car_Booked);
		$Loan_Amount = FixString($Loan_Amount);
		$cpp_card_protect = FixString($cpp_card_protect);
		$hdfclife = FixString($hdfclife);
		$bajaj_Allianz = FixString($bajaj_Allianz);
		$accept = FixString($accept);
		$cldelivery_date = FixString($cldelivery_date);
		$From_Product = $_REQUEST['From_Product'];
		$Net_Salary_Monthly = $Net_Salary / 12;
		$IsPublic = 1;
		$Referrer=FixString($referrer);
		$source=FixString($source);
		$Reference_Code = generateNumberNEWc(5); 
		$IP = getenv("REMOTE_ADDR");
		$IP= $_SERVER['HTTP_X_REAL_IP'];
		$QArequestid = FixString($QArequestid);
		$ABMMU_flag = FixString($adty_brl);
		$Dated = ExactServerdate();
		
		$n       = count($From_Product);
		$i      = 0;
		//echo $n."<br>";
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
		  
		  if(strlen($Age)>0)
		{
			$date=date('m-d');
			$year = date('Y')-$Age;
			$DOB = $year."-".$date;
		}
		else
		{
			$DOB=$Year."-".$Month."-".$Day;
		}
$final_url=FixString($HTTP_REFERER);
$_SESSION['final_url'] = $final_url;
$_SESSION['Net_Salary'] = $Net_Salary;
$_SESSION['City']= $City;
$_SESSION['City_Other']= $City_Other;
$QArequestid = $_SESSION['Temp_Last_Inserted'];

$Type_Loan="Req_Loan_Car";


if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}

	function  bajaj_allianz($ProductValue, $Name, $Email, $City, $Phone, $DOB, $Income, $Car_Type )
	{
		
		//exit();
		$dataInsert = array('requestid'=>$ProductValue, 'name'=>$Name, 'email'=>$Email, 'city'=>$City, 'phone'=>$Phone, 'dob'=>$DOB, 'income'=>$Income, 'car_type'=>$Car_Type, 'dated'=>$Dated);
		$insert = Maininsertfunc ('bajajallianz_carloancomp', $dataInsert);
	}

		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		/*if($crapValue=='Put')
		{*/
			$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
if(($validMobile==1) && ($Name!=""))
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Car Where ( Mobile_Number not in (9555060388,9999570210,9811215138,9811555306,9873678914,9311773341,9999047207) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	//echo $getdetails."<br>";
	//exit();
list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
	if($alreadyExist>0 && $source!="CLQuickapply")
	{
		$ProductValue = $myrow[$myrowcontr]["RequestID"];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-car-loan-lead.php'"."</script>";
	}
	else
	{
		if($source=="CLQuickapply")
		{
			$ProductValue=$myrow['RequestID'];
			$dataUpdate = array('Employment_Status'=>$Employment_Status, 'City'=>$City, 'City_Other'=>$City_Other, 'Loan_Amount'=>$Loan_Amount, 'IP_Address'=>$IP, 'DOB'=>$DOB, 'Pincode'=>$Pincode, 'Dated' => $Dated,'Car_Type'=>$Car_Type, 'Car_Model'=>$Car_Model);
			$wherecondition = "(RequestID =".$QArequestid.")";
			Mainupdatefunc ('Req_Loan_Car', $dataUpdate, $wherecondition);
			 $lastInserted = $QArequestid;
			$_SESSION['Temp_LID'] = $lastInserted;
			$client_transaction_id = $lastInserted."_CL";
		
			//$zipdimage = mobile_verify($Phone,$client_transaction_id);
			
			if($City=="Others")
		{
			$strCity = $City_Other;
		}
		else
		{
			$strCity = $City;
		}

			if($lastInserted>0)
		{
			list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Car",$lastInserted,$strCity);
		}
			
		}
		else
		{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
		list($alreadyExist,$Arrrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($Arrrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $Arrrow[$myrowcontr]["UserID"];
				
			//	echo "<br>if".$InsertProductSql;
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Car_Type'=>$Car_Type, 'Dated'=>$Dated, 'source'=>$source, 'Pincode'=>$Pincode, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'DOB'=>$DOB, 'Car_Insurance'=>$Car_Insurance, 'Car_Varient'=>$Car_Varient, 'Car_Model'=>$Car_Model, 'Updated_Date'=>$Dated, 'Email'=>$Email, 'Loan_Tenure'=>$Loan_Tenure, 'Cpp_Compaign'=>$cpp_card_protect, 'Car_Booked'=>$Car_Booked, 'Reference_Code'=>$Reference_Code, 'Delivery_Date'=>$cldelivery_date, 'Privacy'=>$accept);
			//print_r($dataInsert); die;
			
			
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Car_Type'=>$Car_Type, 'Dated'=>$Dated, 'source'=>$source, 'Pincode'=>$Pincode, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'DOB'=>$DOB, 'Car_Insurance'=>$Car_Insurance, 'Car_Varient'=>$Car_Varient, 'Car_Model'=>$Car_Model, 'Updated_Date'=>$Dated, 'Email'=>$Email, 'Loan_Tenure'=>$Loan_Tenure, 'Cpp_Compaign'=>$cpp_card_protect, 'Car_Booked'=>$Car_Booked, 'Reference_Code'=>$Reference_Code, 'Delivery_Date'=>$cldelivery_date, 'Privacy'=>$accept);
			
			}
			
				$ProductValue = Maininsertfunc('Req_Loan_Car', $dataInsert);	
				
			 //Send SMS
			ProductSendSMStoRegis($Phone);
		
			
		}
			
			$lastInserted = $ProductValue;
			$_SESSION['Temp_LID'] = $ProductValue;
			$client_transaction_id = $lastInserted."_CL";

if($lastInserted>0)
		{
			list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Car",$lastInserted,$strCity);
		}


	if(count($finalBidderName)>0)
		{
			$SMSMessage = "Please use this code: ".$Reference_Code."  to activate you loan request at deal4loans.com";

			if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMSMessage, $Phone);
			//$zipdimage = mobile_verify($Phone,$client_transaction_id);
		}

		if($bajaj_Allianz==1)
		{
			bajaj_allianz ($ProductValue, $Name, $Email, $City, $Phone, $DOB, $Net_Salary, $Car_Type); 	
		}

if($City=="Others")
		{
			$strCity = $City_Other;
		}
		else
		{
			$strCity = $City;
		}
			
		if($hdfclife==1)
		{
			$Product=3;
			Insert_HdfcLife($Name, $strCity, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}


		
		if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
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
				$SubjectLine = $Name.", Learn to get Best Deal on Car Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Car Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
		
	if(count($finalBidderName)==0)
		{
		
		if(strlen($Email)>0)
			{
			$Message="<table width='700' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'> <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr>     <td width='40%' valign='top'></td>        <td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />          <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td>      </tr>    </table></td>  </tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:14px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><b>Dear $Name,</b><p>As per your profile, no bank is associated with us to serve your <b>Car loan</b> requirement. We will not be able to service your request and hence we are not sharing your details with any bank.</p><p>&nbsp; <br />
  Regards</p>
Team Deal4loans.com <br /><br /></td></tr><tr><td style=' font-family:Verdana; font-size:14px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:14px; color:#ffffff;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:14px; color:#ffffff;'>Loan Quiz</a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:14px; color:#ffffff;'>Loan Guru </a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.in?source=d4l-noteligi' style=' font-family:Verdana; font-size:14px; color:#ffffff;'>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-noteligi' style=' font-family:Verdana; font-size:14px; color:#ffffff;'>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-noteligi' style=' font-family:Verdana; font-size:14px; color:#ffffff;'>Askamitoj.com</a> </td></tr></table></td></tr></table>";
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= "Bcc: testthankuse@gmail.com"."\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($Email,'Thanks for Registering for Car Loan on deal4loans.com', $Message, $headers);
			}

			header("Location: thank_cl.php?Name=".$Name);
				exit();
		}

	}

		}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}
}
echo $Reference_Code;
//$Reference_Code=1101;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<title>Car Loans | Apply Car Loans online | Compare Car Loans</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India.">
<link href="css/personal-loan-sbi-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript">
var bustcachevar=1 //bust potential caching of external pages after initial request? (1=yes, 0=no)
var loadedobjects=""
var rootdomain="http://"+window.location.hostname
var bustcacheparameter=""

function ajaxpage(url, containerid){
var containerid = 'contentarea';	
var carmanufacturer = document.car_loan_verify.car_manufacturer.value;
var url;
url = "getCarValue.php?carmanufacturer=" + carmanufacturer;
//alert(url);
	
var page_request = false
if (window.XMLHttpRequest) // if Mozilla, Safari etc
page_request = new XMLHttpRequest()
else if (window.ActiveXObject){ // if IE
try {
page_request = new ActiveXObject("Msxml2.XMLHTTP")
} 
catch (e){
try{
page_request = new ActiveXObject("Microsoft.XMLHTTP")
}
catch (e){}
}
}
else
return false
page_request.onreadystatechange=function(){
loadpage(page_request, containerid)
}
if (bustcachevar) //if bust caching of external page
bustcacheparameter=(url.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
page_request.open('GET', url+bustcacheparameter, true)
page_request.send(null)
}

function loadpage(page_request, containerid){
if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1))
document.getElementById(containerid).innerHTML=page_request.responseText
}

function loadobjs(){
if (!document.getElementById)
return
for (i=0; i<arguments.length; i++){
var file=arguments[i]
var fileref=""
if (loadedobjects.indexOf(file)==-1){ //Check to see if this object has not already been added to page before proceeding
if (file.indexOf(".js")!=-1){ //If object is a js file
fileref=document.createElement('script')
fileref.setAttribute("type","text/javascript");
fileref.setAttribute("src", file);
}
else if (file.indexOf(".css")!=-1){ //If object is a css file
fileref=document.createElement("link")
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", file);
}
}
if (fileref!=""){
document.getElementsByTagName("head").item(0).appendChild(fileref)
loadedobjects+=file+" " //Remember this object as being already added to page
}
}
}
</script>
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
if(document.car_loan_verify.activation_code.value!="")
	{
		if(document.car_loan_verify.activation_code.value!=document.car_loan_verify.Reference_Code.value)
		{
			alert("Please fill the correct activation code.");
			document.car_loan_verify.activation_code.focus();
			return false;
		}
	}
if (document.car_loan_verify.Residence_Status.selectedIndex==0)
{
	//document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";
	alert("Enter Residence Status");		
	document.car_loan_verify.Residence_Status.focus();
	return false;
}

if(document.car_loan_verify.Resi_Stability.value=="")
{
	//document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
	alert("Enter Residence Stability");
	document.car_loan_verify.Resi_Stability.focus();
	return false;
}
if (document.car_loan_verify.car_manufacturer.selectedIndex==0)
{
	//document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
	alert("Enter Car Manufacturer");
	document.car_loan_verify.car_manufacturer.focus();
	return false;
}	
if (document.car_loan_verify.car_model.selectedIndex==0)
{
	//document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
	alert("Enter Car Model");
	document.car_loan_verify.car_model.focus();
	return false;
}
if(document.car_loan_verify.total_experience.value=="")
{
	//document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
	alert("Enter Total Experience");
	document.car_loan_verify.total_experience.focus();
	return false;
}

}


function addMagma()
{
	var carName = document.car_loan_verify.car_model.value;
	var ni1 = document.getElementById('showMagmaNano');
	if(carName==553 || carName==554 || carName==555)
	{
	    ni1.innerHTML = '**Exclusive offer on Tata Nano from Magma Fincorp <br />&nbsp;&nbsp;&nbsp;Apply with Magma Fincorp and get 100% Loan on Tata Nano @ 6.99% for 3 years<br /><br />';
	}
	else
	{
		ni1.innerHTML ='';
	}
	return true;
}	
</script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="pl_sbi_wrapper">
  <div style="clear:both;"></div>
  <div class="common-bread-crumb" style="margin:auto; margin-top:70px;"><a href="index.php"  class="text12" style="color:#0080d6; font-size:14px;">Home</a> <strong style="font-size:14px; font-weight:normal; color:#0080d6;" class="text12"> » </strong> <span style="color:#4c4c4c; font-size:14px;"><a href="car-loans.php"  class="text12" style="color:#0080d6;">Car Loan</a> <strong style="font-size:14px; font-weight:normal; color:#4c4c4c;" class="text12"> » </strong>Apply Car Loan</span> </div>
  <div style="clear:both; height:15px;"></div>
  <div class="text12" style="margin:auto; width:100%;">
    <? if($source=="CLQuickapply")
	  {$lastInserted = $QArequestid; }?>
    <form name="car_loan_verify" action="thank_cl080416.php" method="post" onSubmit="return chkform();" >
      <input type="hidden" name="RequestID" id="RequestID"  value="<? echo $lastInserted; ?>" >
      <input type="hidden" name="Name" id="name"  value="<? echo $Name; ?>" >
      <input type="hidden" name="Phone" id="Phone"  value="<?php echo $_REQUEST['Phone'];?>" >
      <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
      <input type="hidden" name="Reference_Code" id="Reference_Code" value="<? echo $Reference_Code; ?>">
      <div class="hl_emi_cal_form" style="background-color:#0e79b9 !important;">
        <div class="pl_emi_cal_text">
          <div class="text3" style=" background-color:#0e79b9; color:#FFF; font-size:15px; text-transform:none; font-weight:bold; line-height:25px; width:95%"> To get quotes and Compare offers from all Banks and <span style="font-size:18px;"> Save Upto Rs. 25000* by comparison on your EMI</span>. Please verify your Mobile Number <?php echo $_REQUEST['Phone'];?>. <br />
            We have sent an activation code on <span style="font-size:18px;"><?php echo $_REQUEST['Phone'];?></span></div>
        </div>
        <div class="inser_cl_input">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="36%"><span class="text" style=" float:left;  height:auto; color:#FFF; font-size:14px; text-transform:none;">Activation Code</span></td>
              <td width="64%" align="left"><input name="activation_code" id="activation_code" type="text" style="width:100px; height:18px;" onkeydown="validateDiv('nameVal');"  maxlength="5"/></td>
            </tr>
          </table>
        </div>
        <div class="inser_cl_input">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="42%"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:14px; text-transform:none;">Residence Status</span></td>
              <td width="58%"><select name="Residence_Status" id="Residence_Status" style="width:175px; height:25px;" class="inputtext" tabindex="10">
                  <option value="0">Please Select</option>
                  <option value="4">Owned By Self/Spouse</option>
                  <option value="1">Owned By Parent/Sibling</option>
                  <option value="3">Company Provided</option>
                  <option value="5">Rented - With Family</option>
                  <option value="6">Rented - With Friends</option>
                  <option value="2">Rented - Staying Alone</option>
                  <option value="7">Paying Guest</option>
                  <option value="8">Hostel</option>
                </select></td>
            </tr>
          </table>
        </div>
        <div class="inser_cl_input">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="60%"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:14px; text-transform:none;">Years at current residence:</span></td>
              <td width="40%" align="left"><input type="text" name="Resi_Stability" id="Resi_Stability"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" style="width:100px; height:18px;" /></td>
            </tr>
          </table>
        </div>
        <div style="clear:both;"></div>
        <div class="inser_cl_input">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="36%"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:14px; text-transform:none;">Car Make</span></td>
              <td width="64%" align="left"><select name="car_manufacturer" id="car_manufacturer"  onChange="ajaxpage();" style="height:25px; width:170px;">
                  <option value="">Select Car Brand</option>
                  <?php

$getCarNameSql = "SELECT hdfc_car_manufacturer FROM hdfc_car_list_category WHERE 1 GROUP BY hdfc_car_manufacturer";
list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());

for($cN=0;$cN<$numRowsCarName;$cN++)
{
	$hdfc_car_manufacturer = $getCarNameQuery[$cN]['hdfc_car_manufacturer'];
	?>
                  <option value="<?php echo $hdfc_car_manufacturer; ?>"><?php echo $hdfc_car_manufacturer; ?></option>
                  <?php
}
?>
                </select></td>
            </tr>
          </table>
        </div>
        <div class="inser_cl_input">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="36%"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:14px; text-transform:none;">Car Model:</span></td>
              <td width="64%"><div class="text" style=" float:left; height:auto; color:#FFF; font-size:14px; text-transform:none;" id="contentarea">
                  <select name="car_model" id="car_model"  style="height:25px;" onChange="return addMagma();">
                    <option value="">Select Car Model</option>
                  </select>
                </div></td>
            </tr>
          </table>
        </div>
        <div class="inser_cl_input">
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="60%"><span class="text" style=" float:left; height:auto; color:#FFF; font-size:14px; text-transform:none;">Total Work Experience:</span></td>
              <td width="40%" align="left"><input type="text" name="total_experience" id="total_experience"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" style="width:100px; height:18px;" /></td>
            </tr>
          </table>
        </div>
        <div style="clear:both;"></div>
        <div class="inser__btn_box">
          <input type="submit" value="Get Quote" style=" background: #06b2a0;
width: 110px; border:solid 2px #FFF; height:39px; border-radius:5px; color:#FFF; font-size:16px; margin-right:63px; margin-bottom:5px; float: right;">
        </div>
      </div>
    </form>
  </div>
  <div style="clear:both; height:15px;"></div>
  <div style="width:100%;"> <span class="frmbldtxt" style="font-weight:bold; color:#D02037;">
    <div id="showMagmaNano"></div>
    </span> <span class="frmbldtxt" style="font-weight:normal; color:#000000; font-size:14px;">1) Get call back assistance on <span style="color: #D02037;">verified mobile number</span> directly from all the comparable banks within 24 hours. <br />
    2) Compare EMI and <span style="color: #D02037;">save Upto Rs. 25000 on interest</span> .<br />
    3) Provides you with the best suitable offers.<br />
    4) Help in processing your loan faster. </span></div>
</div>
<div style="clear:both; height:15px;"></div>
</div>
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

	$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
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