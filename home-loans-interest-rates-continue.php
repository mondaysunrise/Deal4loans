<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';
//	require 'getlistofeligiblebidders1.php';
//cho "uh";

function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
		$City = $_POST['City'];
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$Net_Salary = $_POST['IncomeAmount'];
		$monthly_income = ($Net_Salary /12);
		$Type_Loan = "Req_Loan_Home";
		$IP = getenv("REMOTE_ADDR");
		$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$source = $_POST['source'];		
	    $accept = $_POST['accept'];		
		$crap = " ".$Name." ".$Email;
		$validMobile = is_numeric($Phone);
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();

if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1 || preg_match("/@/", $Name)==1)
{
	$validname=0;
}
else
		{
	$validname=1;
		}



		if($crapValue=='Put' && $City!='Please Select' && $validname==1 && $validMobile==1)
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From ".$Type_Loan."  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9891118553','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$CheckQuery)=MainselectfuncNew($CheckSql,$array = array());
			$CheckQuerycontr=count($CheckQuery)-1;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $CheckQuery[$CheckQuerycontr]['UserID'];
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>'1', 'DOB'=>$dateofbirth, '	Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Privacy'=>$accept);
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>'1', 'DOB'=>$dateofbirth, '	Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Privacy'=>$accept);
			}
			
			$ProductValue = Maininsertfunc ("Req_Loan_Home", $dataArray);
			$_SESSION['Temp_LID'] = $ProductValue;
			$_SESSION['ProductValue'] = $ProductValue;
			$_SESSION['strcity'] = $City;
			$_SESSION['Name'] = $Name;

			if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}
/*if($hdfclife==1)
		{
			$Product=2;
			Insert_HdfcLife($Name, $City, $Phone, $dateofbirth, $Email, $Net_Salary, $Product, $ProductValue );
		}*/

			list($First,$Last) = split('[ ]', $Name);

			
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan";
			
			if(strlen(trim($Phone)) > 0)
			{
				//SendSMS($SMSMessage, $Phone);
				NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
			}
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: testthankuse@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$FName=$Name;
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Home Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Home Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			
			}
		}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
}

$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply Home Loan - Compare interest Rates, Eligibility, Banks and Apply Home Loans online</title>
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<style type="text/css"></style>
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India,">
<meta name="description" content="Home Loan apply : Apply for home loans Online and get quotes from all home loan provider of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad, Pune etc.">
<link rel="canonical" href="http://www.deal4loans.com/apply-home-loans.php"/>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/hl-intrrates-cont.css" rel="stylesheet" type="text/css" />
<link href="source.css" rel="stylesheet" type="text/css" />

  <link href="css/slider.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
 <script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true
				
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
	</script>
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

<script language="javascript">
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

function cityother()
{
	if(document.loan_form_hl.City.value=="Others")
	{
		document.loan_form_hl.City_Other.disabled = false;
	}
	else
	{
		document.loan_form_hl.City_Other.disabled = true;
	}
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


function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	//var i;
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
		
	if(document.loan_form_hl.day.value=="" || document.loan_form_hl.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.loan_form_hl.day.focus();
		return false;
	}
	if(document.loan_form_hl.day.value!="")
	{
		if((document.loan_form_hl.day.value<1) || (document.loan_form_hl.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.loan_form_hl.day.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form_hl.day, 'Day', 2))
		return false;
	
	if(document.loan_form_hl.month.value=="" || document.loan_form_hl.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.loan_form_hl.month.focus();
		return false;
	}
	if(document.loan_form_hl.month.value!="")
	{
		if((document.loan_form_hl.month.value<1) || (document.loan_form_hl.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.loan_form_hl.month.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form_hl.month, 'month', 2))
		return false;

	if(document.loan_form_hl.year.value=="" || document.loan_form_hl.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.loan_form_hl.year.focus();
		return false;
	}
	if(document.loan_form_hl.year.value!="")
	{
		if((document.loan_form_hl.year.value < "<?php echo $maxage;?>") || (document.loan_form_hl.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.loan_form_hl.year.focus();
			return false;
		}
	}
	
	if(!checkData(document.loan_form_hl.year, 'Year', 4))
		return false;

<?php
if($City == "Others")
{
?>
	if( ((document.loan_form_hl.City_Other.value=="" || document.loan_form_hl.City_Other.value=="Other City"  ) || !isNaN(document.loan_form_hl.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form_hl.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form_hl.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form_hl.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.loan_form_hl.City_Other.focus();
  		return false;
  	}
  }
<?php
}
?>		
	if (document.loan_form_hl.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form_hl.Loan_Amount.focus();
		return false;
	}	

	if (document.loan_form_hl.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.loan_form_hl.Pincode.focus();
		return false;
	}
	if (document.loan_form_hl.Pincode.value!="")
	{
		if(document.loan_form_hl.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.loan_form_hl.Pincode.focus();
			return false;
		}
	}

	if (document.loan_form_hl.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form_hl.Employment_Status.focus();
		return false;
	}

	for(j=0; j<document.loan_form_hl.Property_Identified.length; j++) 
	{
        if(document.loan_form_hl.Property_Identified[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		document.getElementById('propEditifiedVal').innerHTML = "<span  class='hintanchor'>Select Property identified or not!</span>";	
		return false;
	}
	if(cnt ==0)
	{ 
		if(document.loan_form_hl.Property_Loc.selectedIndex==0)
		{
			document.getElementById('propEditifiedVal').innerHTML = "<span  class='hintanchor'>Select Property Location!</span>";	
			document.loan_form_hl.Property_Loc.focus();
			return false;
		}
	}

	
}  


function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
	{
		if(d==j)
		{
			if(eval(document.getElementById("divfaq"+j)).style.display=='none')
			{
				eval(document.getElementById("divfaq"+j)).style.display=''
			}
			else
			{
				eval(document.getElementById("divfaq"+j)).style.display='none'
			}
		}
			
	}
}

function addIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	var ni2 = document.getElementById('myDiv2');
	 ni1.innerHTML = 'Property Location';
	 ni2.innerHTML = '<select name="Property_loc" id="Property_loc" style="width:140px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><?=getCityList1($City)?></select><div id="vintageVal"></div>';

		
		return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	var ni2 = document.getElementById('myDiv2');
	ni1.innerHTML = '';
	ni2.innerHTML = '';				
	return true;

}	

function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}




  </script>
<style>

</style>
</head>
<body>
<div class="hli_rates_header"><?php include "top-menu.php"; include "main-menu.php"; ?>
<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")); $currentdate=date('d F Y',$tomorrow); ?></div>

<div style="clear:both;"></div>
<div class="intrl_txt">	
<div class="hli_rates_logo"><img src="images/logo.gif" width="243" height="90" /></div>
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Home Loan </span></div>
<div style="clear:both;"></div><form name="loan_form_hl" method="post" action="insert_home_loan_interest_rate_stage2.php" onSubmit="return chkform();">
 <input type="hidden" value="<? echo $Net_Salary;?>" name="Net_Salary" />
        <input type="hidden" value="<? echo $_SESSION['Temp_LID'];?>" name="leadid" />
            <input type="hidden" value="<? echo $Name;?>" name="Name" />
			 <input type="hidden" value="<? echo $City;?>" name="city" />
			  <input type="hidden" value="<? echo $Phone;?>" name="mobile" />
			  			  <input type="hidden" value="<? echo $$Email;?>" name="Email" />
   <div class="hli_form_box_continue">
	  <div class="hli_form_title" style=" text-align:left; margin-left:10px;"><span style="color:#8dae48;">Step 2</span> - To get online quotes from all Banks-Please Input further details<br />
  </div>
  <div class="hli_input_section">
    <table width="99%" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">DOB:</span></td>
        </tr>
      <tr>
        <td>
            <input name="day" id="day" type="text"  class="hli_dd_contine" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="1" />&nbsp;
            <input name="month" id="month" type="text" class="hli_dd_contine" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="2" />&nbsp;
            <input name="year" id="year" type="text" class="hli_yy_contine" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="3" />
            <div id="dobVal"></div>   
            </td>
      </tr>
      </table>
  </div>
   <div class="hli_input_section">
     <table width="99%" border="0" cellspacing="5">
       <tr>
         <td><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</span></td>
         </tr>
       <tr>
         <td>   <input name="Loan_Amount" id="Loan_Amount" type="text" class="hli_input_text_contine" onkeydown="validateDiv('LoanAmtVal');" tabindex="4" /> <div id="LoanAmtVal"></div></td>
       </tr>
       </table>
   </div>
   <div class="hli_input_section">
     <table width="99%" border="0" cellspacing="5">
       <tr>
         <td><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pincode:</span></td>
         </tr>
       <tr>
         <td><input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" type="text" class="hli_input_text_contine" tabindex="5" />
         <div id="pincodeVal"></div></td>
         </tr>
      </table>
   </div>
   <div class="hli_input_section">
     <table width="99%" border="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Property Value:</span></td>
         </tr>
       <tr>
         <td> <input  name="property_value"  id="property_value" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" class="hli_input_text_contine" onkeydown="validateDiv('propertyValueVal');"  tabindex="7" />
         <div id="propertyValueVal"></div>  </td>
         </tr>
     </table>
   </div>
   <div style="clear:both;"></div>
   <div class="hli_input_section" style="margin-top:5px;">
  
    <table width="99%" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Total Monthly EMI for all running 
          loans : </span>            </td>
      </tr>
      </table>
  </div>
  <div class="hli_input_section" style="margin-top:5px;">
  
    <table width="99%" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td><input  name="obligations" id="obligations" onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" class="hli_input_text_contine" tabindex="7" />  </td>
      </tr>
      </table>
  </div>
  
  <div class="hli_input_section" style="margin-top:5px;">
  
    <table width="99%" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Occupation: </span> </td>
      </tr>
      <tr>
        <td><select name="Employment_Status" id="Employment_Status" class="hli_select_contine"  onchange="validateDiv('empStatusVal');"  style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" tabindex="6" >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                     </select>
                       <div id="empStatusVal"></div></td>
      </tr>
      </table>
  </div>
  
  <div class="hli_input_section" style="margin-top:5px;">
  
    <table width="99%" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td width="48%"><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Property Identified:</span> </td>
        <td width="52%" class="text" style="color:#FFF; font-size:12px; text-transform:none;"><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="return addIdentified();" style="border:none;" tabindex="8"/>
        Yes <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;"  />
        No</td>
      </tr>
        <tr>
        <td width="48%" class="text" style="color:#FFF; font-size:12px; text-transform:none;" id="myDiv1"></td>
        <td width="52%" class="text" style="color:#FFF; font-size:12px; text-transform:none;" id="myDiv2"></td>
      </tr>
      </table>
  </div>
   <div style="clear:both;"></div>
   <div style="display:none; " id="divfaq1">
   <div class="hli_input_section">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Co-applicant Name:</span></td>
       </tr>
       <tr>
         <td><input name="co_name" id="co_name" type="text" class="hli_input_text_contine" /></td>
       </tr>
     </table>
   </div>
   
   <div class="hli_input_section">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Co-applicant DOB:</span></td>
       </tr>
       <tr>
         <td><input name="co_day" id="co_day" type="text" class="hli_dd_contine" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);"/>
         <input name="co_month" id="co_month" type="text" class="hli_dd_contine" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
         <input name="co_year" id="co_year" type="text" class="hli_yy_contine" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />   <div id="co_dobVal"></div></td>
       </tr>
     </table>
   </div>
   
   <div class="hli_input_section">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Gross Annual Salary:</span></td>
       </tr>
       <tr>
         <td>  <input type="text" name="co_monthly_income" id="co_monthly_income"  class="hli_input_text_contine"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" /></td>
       </tr>
     </table>
   </div>
   <div class="hli_input_section">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Monthly EMIs :</span></td>
       </tr>
       <tr>
         <td>  <input name="co_obligations" id="co_obligations" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this);" type="text" class="hli_input_text_contine" /></td>
       </tr>
     </table>
   </div>
   </div>
   
   <div class="hli_input_section">
     <table width="99%" border="0" cellpadding="0" cellspacing="5">
       <tr>
         <td><span class="text" style="color:#FFF; font-size:12px; text-transform:none;"> <input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" >
                                Co - applicant</span></td>
       </tr>
       </table>
   </div>

   <div class="getquote_btn"><input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; " value=""/></div>
</div>
  </form>
<div style="clear:both;"></div> 
 
  <div class="continer_boxes">

<div class="text11" id="logo_hide" style="margin:auto; width:96%; height:auto; margin-top:0px; color:#88a943; font-size:17px; font-weight:bold;">Quotes available from following Banks - Maximum Home loan Bank Tie ups in online space</div>
<div style="clear:both;"></div>
  </div></div>


</div>
<div style="clear:both;"></div>
<div class="logos_hide" >
<div class="sldrpnl" >
	<div id="slider">
		<ul>				
			        <li>
<div><img src="new-images/slider/thumb/hdfc-h.jpg" alt="HDFC" width="126" height="52"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/axis.jpg" alt="Axis Bank" width="140" height="42"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/hfc_logo.jpg" alt="ICICI HFC" width="147" height="37"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/fblue.gif" alt="First Blue" width="126" height="41"  style="border:none;"/></div>

            </li>
            <li>
<div><img src="new-images/slider/thumb/hdfc-h.jpg" alt="HDFC" width="126" height="52"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/axis.jpg" alt="Axis Bank" width="140" height="42"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/hfc_logo.jpg" alt="ICICI HFC" width="147" height="37"  style="border:none;"/></div>
<div><img src="new-images/slider/thumb/fblue.gif" alt="First Blue" width="126" height="41"  style="border:none;"/></div>     </li>
		</ul>
	</div>
</div>
</div>

<div class="hli_rates_footer"><div class="responsive_ad" align="center"><br />
<script type="text/javascript"><!--
google_ad_client = "ca-pub-6880092259094596";
/* Mobile Ad */
google_ad_slot = "5395826842";
google_ad_width = 234;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
</div>
<div class="hli_rates_footer">
<?php include "footer1.php"; ?></div>
</body>
</html>