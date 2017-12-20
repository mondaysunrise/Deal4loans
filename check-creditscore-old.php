<?php
session_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
/*
$firstName = 'HARSHA';
$surName = 'DILIP';
$mobileNo = 9228103392;
$email = 'askupendra@gmail.com';
$pincode = 500011;
$pan = 'BUQPD1336A';
$flatno = 'CDX-A-68';


$firstName = 'JAMNA';
$surName = 'G';
$mobileNo = 9228103393;
$email = 'askupendra@gmail.com';
$pincode = 500085;
$pan = 'BUQPD1337A';
$flatno = 'PLOT';
*/

$firstName = 'DATTATRAYA';
$surName = 'RAUT';
//$mobileNo = 9003170682;
$mobileNo = 9971396361;
$email = 'askupendra@gmail.com';
$pincode = 400106;
$pan = 'BUQPT2352R';
$flatno = 'SWMARG02';
$buildingName = 'MALAD';
//$road = '';

	//	25-07-1978	1	BUQPT2352R	9003170682	SWMARG02	MALAD	MUMBAI	Maharashtra	27	400106


//echo $firstName.' - '.$surName.' - '.$mobileNo.' - '.$email.' - '.$pincode.' - '.$pan.' - '.$flatno;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
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
function chkcreditscore(Form)
{
	
	var i;
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	 var pat1= "/^([0-9](6,6)+$/";
	
	if((Form.firstName.value=="") || (Form.firstName.value=="Name")|| (Trim(Form.firstName.value))==false)
	{
		//alert("Kindly fill in your Name!");
		document.getElementById('fNameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		Form.firstName.focus();
		return false;
	}
	else if(containsdigit(Form.firstName.value)==true)
	{
		document.getElementById('fNameVal').innerHTML = "<span  class='hintanchor'>Name Contains Numbers</span>";		
	//	alert("Name contains numbers!");
		Form.firstName.focus();
		return false;
	}
	for (var i = 0; i < Form.firstName.value.length; i++) 
	{
		if (iChars.indexOf(Form.firstName.value.charAt(i)) != -1) 
		{
	//		alert ("Name has special characters.\n Please remove them and try again.");
			document.getElementById('fNameVal').innerHTML = "<span  class='hintanchor'>Name has special characters</span>";		
			Form.firstName.focus();
			return false;
		}
	}		
	if((Form.surName.value=="") || (Form.surName.value=="Name")|| (Trim(Form.surName.value))==false)
	{
		//alert("Kindly fill in your Name!");
		document.getElementById('lNameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Last Name</span>";		
		Form.surName.focus();
		return false;
	}
	else if(containsdigit(Form.surName.value)==true)
	{
		document.getElementById('lNameVal').innerHTML = "<span  class='hintanchor'>Last Name Contains Numbers</span>";		
	//	alert("Name contains numbers!");
		Form.surName.focus();
		return false;
	}
	for (var i = 0; i < Form.surName.value.length; i++) 
	{
		if (iChars.indexOf(Form.surName.value.charAt(i)) != -1) 
		{
	//		alert ("Last Name has special characters.\n Please remove them and try again.");
			document.getElementById('lNameVal').innerHTML = "<span  class='hintanchor'>Last Name has special characters</span>";		
			Form.surName.focus();
			return false;
		}
	}
	
	if((Form.mobileNo.value=='Mobile No') || (Form.mobileNo.value=='') || Trim(Form.mobileNo.value)==false)
	{
		//alert("Kindly fill in your Mobile Number!");
		document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Enter Mobile Number</span>";
		Form.mobileNo.focus();
		return false;
	}
	 else if(isNaN(Form.mobileNo.value)|| Form.mobileNo.value.indexOf(" ")!=-1)
	{
	  //alert("Enter numeric value in ");
	  document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Enter Numeric Value</span>";
	  Form.mobileNo.focus();
	  return false;  
	}
	else if(Form.mobileNo.value.length < 10 )
	{
		//alert("Please Enter 10 Digits"); 
	  document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Enter 10 Digits</span>";
	  Form.mobileNo.focus();
	  return false;
	}
	else if((Form.mobileNo.value.charAt(0)!="9") && (Form.mobileNo.value.charAt(0)!="8") && (Form.mobileNo.value.charAt(0)!="7"))
	{
		alert("The number should start only with 9 or 8 or 7");
		document.getElementById('mobileVal').innerHTML = "<span class='hintanchor'>Start with 9 or 8 or 7</span>";
		Form.mobileNo.focus();
		return false;
	}
	if(Form.email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";
		Form.email.focus();
		return false;
	}
	
	var str=Form.email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		Form.email.focus();
		return false;
	}
	
	
	if(!Form.accept.checked)
	{
	document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms & Condition!</span>";	
		Form.accept.focus();
		return false;
	}
	
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

function declineFunction()
{
	document.getElementById('declineVal').innerHTML = "<span  class='hintanchor'>Accept Terms & Condition to Proceed!</span>";	
	return false;
}

</script>
<style>.consent-wrapper{ width:300px; margin:10px auto;}
.accept_btn{ display:inline; width:135px; padding:12px 5px 12px 5px; background:#097de4; color:#FFF; text-align:center; border-radius:5px; border:none;}
.decline_btn{ display:inline; width:135px; padding:12px 5px 12px 5px; background:#f8472a; color:#FFF; text-align:center; border-radius:5px; border:none;}
</style>
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
<form name="creditscore_form" action="cibil-checkcontinue.php" method="POST" onSubmit="return chkcreditscore(document.creditscore_form);">
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
    <td colspan="2" class="personal_text">Details</td>
  </tr>
  <tr>
    <td width="209" height="45" class="form_text">First Name  <?php //echo $firstName.' - '.$surName.' - '.$mobileNo.' - '.$email.' - '.$pincode.' - '.$pan.' - '.$flatno;
?></td>
    <td width="291" height="30"><input  name="firstName" class="input"  id="firstName"  tabindex="1" onFocus="this.select();" onKeyDown="validateDiv('fNameVal');" value="<?php echo $firstName; ?>" /><div id="fNameVal"  class="alert_msg"></div></td>
  </tr>
  <tr>
    <td width="209" height="45" class="form_text">Middle Name</td>
    <td width="291" height="30"><input  name="middleName" class="input"  id="middleName" tabindex="2" onFocus="this.select();" onKeyDown="validateDiv('mNameVal');" /><div id="mNameVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td width="209" height="45" class="form_text">Last Name</td>
    <td width="291" height="30"><input  name="surName" class="input"  id="surName"  tabindex="3" onFocus="this.select();" onKeyDown="validateDiv('lNameVal');"  value="<?php echo $surName; ?>" /><div id="lNameVal"  class="alert_msg"></div></td>
  </tr>
    
  <tr>   <td height="45" class="form_text">Mobile No.</td>    <td  class="form_text"  >+91 <input name="mobileNo" type="text" class="mobile" id="mobileNo"  tabindex=9 onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" maxlength="10"   onKeyDown="validateDiv('mobileVal');"  value="<?php echo $mobileNo; ?>" /><div id="mobileVal" class="alert_msg"></div></td>  </tr>
<tr>    <td height="45" class="form_text">Email Id</td>    <td class="alert_msg"><input name="email" id="email" type="text" tabindex=12 onKeyDown="validateDiv('emailVal');" class="input"  value="<?php echo $email; ?>" /><div id="emailVal"></div></td>  </tr>

  <tr>    <td height="45" colspan="2">
 <input type="checkbox"  name="accept" style="border:none;"  /> I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:13px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/tandc.php" target="_blank" rel="nofollow" class="text" style=" color:#88a943; font-size:13px; text-decoration:underline;">Terms and Conditions</a>.<div id="acceptVal"></div></td>    </tr>   

  <tr>    <td height="45" colspan="2" align="center">
 	<input type="hidden" name="reason" value="test" /> 
 	<div class="consent-wrapper">
<input name="Submit" type="submit" class="accept_btn" value="Accept"  />

 <input name="Decline" type="button" class="decline_btn" value="Decline" onclick="declineFunction();" /> <div id="declineVal"></div>
</div>
</td>    </tr>   
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
<?php print_r($_GET); ?>
</body>
</html>