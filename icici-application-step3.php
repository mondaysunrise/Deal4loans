<?php
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';


$maxage=date('Y')-62;
$minage=date('Y')-18;

$iciciappid = $_REQUEST["iciciappid"];
$ProductValue = $_REQUEST["iciciappid"];
$loan_amt = $_REQUEST["loan_amt"];
$interest_rate = $_REQUEST["interest_rate"];
$emi = $_REQUEST["emi"];
$term = $_REQUEST["term"];
$proc_fee = $_REQUEST["proc_fee"];
$icici_name = $_REQUEST["icici_name"];
$icici_mobile = $_REQUEST["icici_mobile"];
$City = $_REQUEST['City'];

$DataArray = array("icici_loan_amount"=>$loan_amt, "icici_interest_rate"=>$interest_rate, "icici_emi"=>$emi, "icici_tenure"=>$term, "icici_proc_fee"=>$proc_fee);
$wherecondition ="(iciciappid='".$iciciappid."')";
Mainupdatefunc ('icici_exclusive_app', $DataArray, $wherecondition);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ICICI Personal Loan</title>
<link href="icici-app-styles.css" type="text/css" rel="stylesheet" />
<link href="newicici-pl-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href='progression.min.css' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="tip-yellow.css" type="text/css" />
	   <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
        <script type="text/javascript" src="scripts/common.js"></script>

	<!-- jQuery and the Poshy Tip plugin files -->
	<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="jquery.poshytip.js"></script>
<script src="javascript-browser.js" type="text/javascript"></script>
<script type="text/javascript">
		//<![CDATA[
		$(function(){

			$('#name-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#mobile-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#pancard-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#present-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#pcity-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#pstate-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#ppin-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#address-basic').poshytip();
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
			$('#state-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#pincode-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
		
			$('#income-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#address-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#identity-basic').poshytip();
			$('#demo-tip-yellow').poshytip();
			$('#demo-tip-violet').poshytip({
				className: 'tip-violet',
				bgImageFrameSize: 9
			});
			$('#bank-basic').poshytip();
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
/*
	if(document.loan_form.Name.value=="")
	{
		document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Enter Name to Continue!</span>";	
		document.loan_form.Name.focus();
		return false;
	}
	
if(document.loan_form.Phone.value=="")
	{
//		alert("Please Enter Mobile Number");
    	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter Mobile Number!</span>";
		document.loan_form.Phone.focus();
		return false;
	}

	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
//		  alert("Enter numeric value");
	   	  document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		  document.loan_form.Phone.focus();
		  return false;  
	}
	if (document.loan_form.Phone.value.length < 10 )
	{
//			alert("Please Enter 10 Digits"); 
	    	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";
			 document.loan_form.Phone.focus();
			return false;
	}

	if (document.loan_form.Phone.value.charAt(0)!="9" && document.loan_form.Phone.value.charAt(0)!="8" && document.loan_form.Phone.value.charAt(0)!="7")
	{
//			alert("The number should start only with 9 or 8 or 7");
	    	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Start with 9 or 8 or 7!</span>";
			document.loan_form.Phone.focus();
			return false;
	}
	*/
	
	 if (document.loan_form.Pancard.value == "") {
    	document.getElementById('panVal').innerHTML = "<span  class='hintanchor'>Fill Valid Pan No.!</span>";
		document.loan_form.Pancard.focus();
		return false;
}
   if (document.loan_form.Pancard.value != "") {
            ObjVal = document.loan_form.Pancard.value;
            var panPat = /^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/;
            if (ObjVal.search(panPat) == -1) {
               // alert("Invalid Pan No");
		    	document.getElementById('panVal').innerHTML = "<span  class='hintanchor'>Fill Valid Pan No.!</span>";
	            document.loan_form.Pancard.focus();
                return false;
            }
        }

	if(document.loan_form.p_address.value=="")
	{
		document.getElementById('pAddVal').innerHTML = "<span  class='hintanchor'>Fill Present Address!</span>";
		document.loan_form.p_address.focus();
		return false;
	}
	
	if (document.loan_form.p_City.selectedIndex==0)
	{
		document.getElementById('pcityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.p_City.focus();
		return false;
	}
	if(document.loan_form.p_state.value=="")
	{
		document.getElementById('pstateVal').innerHTML = "<span  class='hintanchor'>Enter State!</span>";
		document.loan_form.p_state.focus();
		return false;
	}
	if(document.loan_form.p_pincode.value=="")
	{
		document.getElementById('ppin').innerHTML = "<span  class='hintanchor'>Fill Pincode!</span>";
		document.loan_form.p_pincode.focus();
		return false;
	}

}  
	</script>
    <style type="text/css">
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
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
	</style>
</head>
<body>
<header>
<div class="header">
<div class="header-inner">
<div class="logo" style="font-family:Arial, Helvetica, sans-serif; color:#06396b; font-size:22px; font-weight:bold; width:600px !important;">Get Instant Quote on ICICI Bank Personal Loans</div>
<!--<div class="logo"><img src="images/icici-app-logo.jpg" width="189" height="47"></div>-->
<div class="right-box-app"><span class="text-a">Powered by</span> <br>
<span class="text-a" style="color:#0f8eda; font-size:18px;">Deal4loans.com</span></div>
<div style="clear:both;"></div>
</div>
</div>
</header>
</div>
<div style="clear:both;"></div>
<div class="wrapper"><div class="left-container">
<div style="clear:both"></div>
<div id="wrapper">
   <div id="container">
 <section role="main">

<div class="left-app_wrapper">
<div class="details_box-active"><img src="images/personal-icon.png" width="54" height="57">
<div style=" text-align:left !important;">Personal Details</div>
</div>
</div>
     <div class="form-wrapper-app">
     <form id="myform" onSubmit="return chkpersonalloan();" action="icici-bankstep4.php" method="post" name="loan_form">
  <input type="hidden" name="iciciappid" id="iciciappid" value="<? echo $ProductValue; ?>">
  <input name="Name" id="Name" type="hidden" class="input-bx" tabindex="1"  onKeyDown="validateDiv('nameVal');" value="<? echo $icici_name; ?>" autocomplete="off" />
  <input type="hidden" name="Phone" id="Phone" class="input-bx" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="2" onKeyDown="validateDiv('phoneVal');" value="<? echo $icici_mobile; ?>" maxlength="10" autocomplete="off"  />
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td colspan="2" align="left" class="formbodytext" style="font-size:18px; color:#000;">Personal Details</td>
         </tr>
         <tr>
           <td align="left" class="formbodytext">&nbsp;</td>
           <td align="left" class="formbodytext">&nbsp;</td>
         </tr>
         <tr>
           <td align="left" class="formbodytext">Pan Card</td>
           <td class="formbodytext">Present Address</td>
         </tr>
         <tr>
           <td colspan="2" height="3"></td>
         </tr>
         <tr>
           <td class="formbodytext"><input type="text" name="Pancard" id="Pancard" class="input-bx" tabindex="2" onKeyDown="validateDiv('panVal');" maxlength="10" autocomplete="off"  />
     <div id="panVal" class="alert_msg"></div> </td>
           <td class="formbodytext"><textarea name="p_address" onKeyDown="validateDiv('pAddVal');" class="select-bx" ></textarea>
               <div id="pAddVal" class="alert_msg"></div></td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" height="10"></td>
         </tr>
         <tr>
           <td class="formbodytext" >City</td>
           <td class="formbodytext">State</td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" style="font-size:11px;" height="3"></td>
         </tr>
         <tr>
           <td class="formbodytext" style="font-size:11px;"><select name="p_City" id="p_City" class="select-bx" onChange="validateDiv('pcityVal');" tabindex="2">
<?=plgetCityList($City)?>
                   <option value="Vapi">Vapi</option>
				   <option value="Ankleshwar">Ankleshwar</option>
				    <option value="Anand">Anand</option>
					 <option value="Anand">Dahod</option>
					  <option value="Anand">Navsari</option>		 </select>
                         <div id="pcityVal" class="alert_msg"></div></td>
           <td class="formbodytext" style="font-size:11px;"><input  type="text" class="input-bx" name="p_state" id="p_state"  value=""  onkeydown="validateDiv('pStateVal');" tabindex="11"><div id="pStateVal" class="alert_msg"></div></td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" height="10"></td>
         </tr>
         <tr>
           <td class="formbodytext">Pincode</td>
           <td class="formbodytext" style="font-size:11px;">&nbsp;</td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" height="3"></td>
           </tr>
         <tr>
           <td class="formbodytext"><input  type="text" class="input-bx" name="p_pincode" id="p_pincode" onKeyUp="intOnly(this);" autocomplete="off"  onKeyPress="intOnly(this);"  value=""  onkeydown="validateDiv('pPinVal');" tabindex="11"><div id="pPinVal" class="alert_msg"></div></td>
           <td class="formbodytext" style="font-size:11px;">&nbsp;</td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" style="font-size:11px;">&nbsp;</td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" style=" font-weight:bold; font-size:12px;">Select one document in each section below that you will provide as proof</td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" >&nbsp;</td>
           </tr>
         <tr>
           <td class="formbodytext" >Proof of Income</td>
           <td class="formbodytext">Proof of Address</td>
         </tr>
         <tr>
           <td colspan="2" height="3"></td>
           </tr>
         <tr>
           <td class="formbodytext"><select name="Income_Proof" id="Income_Proof"  class="select-bx">
    <option value="">Select</option>
    <option value="Latest ITR">Latest ITR</option>
    <option value="Form 16">Form 16</option>
    <option value="Salary ceritificate for last 3 months">Salary ceritificate for last 3 months</option>
    <option value="Pay slip - last 3 months">Pay slip - last 3 months</option>
</select></td>
           <td class="formbodytext"><select name="Address_Proof" id="Address_Proof" class="select-bx">
    <option value="">Select</option>
    <option value="Ration Card">Ration Card</option>
    <option value="Telephone, electricity, water or gas bill less than 2 months old (incl downloaded)">Telephone, electricity, water or gas bill less than 2 months old (incl downloaded)</option>
    <option value="Latest Life Insurance policy premium receipts (paid)">Latest Life Insurance policy premium receipts (paid)</option>
    <option value="Post-paid mobile phone bill in your name">Post-paid mobile phone bill in your name</option>
    <option value="Letter from Employer certifying current mailing address">Letter from Employer certifying current mailing address</option>
    <option value="Passport">Passport</option>
    <option value="Election ID card">Election ID card</option>
    <option value="Registered Rental / Lease Agreement">Registered Rental / Lease Agreement</option>
    <option value="Property Registration documents/Ownership proof copy">Property Registration documents/Ownership proof copy</option>
    <option value="Passbook">Passbook</option>
    <option value="Bank statement (last 3 months)">Bank statement (last 3 months)</option>
    <option value="Driving License">Driving License</option>
    <option value="Loan repayment track record">Loan repayment track record</option>
    <option value=" Registration certificate (RC) of 4-wheeler in applicant's name"> Registration certificate (RC) of 4-wheeler in applicant's name</option>
	</select></td>
         </tr>
         <tr>
           <td colspan="2" height="10"></td>
           </tr>
         <tr>
           <td class="formbodytext">Proof of Identity</td>
           <td class="formbodytext" >Bank Statement</td>
         </tr>
         <tr>
           <td colspan="2"></td>
           </tr>
         <tr>
           <td colspan="2"></td>
           </tr>
         <tr>
           <td colspan="2" class="formbodytext" height="3"></td>
           </tr>
         <tr>
           <td class="formbodytext" style="font-size:11px;"><select name="Identity_Proof" id="Identity_Proof" class="select-bx" >
    <option value="">Select</option>
    <option value="Latest ITR">Latest ITR</option>
    <option value="Form 16">Form 16</option>
    <option value="Salary ceritificate for last 3 months">Salary ceritificate for last 3 months</option>
    <option value="Pay slip - last 3 months">Pay slip - last 3 months</option>
</select></td>
           <td class="formbodytext" style="font-size:11px;"><select name="Bank_Statement" id="Bank_Statement" class="select-bx">
    <option value="">Select</option>
    <option value="Salary account bank statement - last 6 months">Salary account bank statement - last 6 months</option>
	</select></td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" style="font-size:11px;">&nbsp;</td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext"></td>
         </tr>
         <tr>
           <td colspan="2" align="center" class="formbodytext"><input type="submit" style="border: 0px none ; background:url(images/submit-app.png); width: 135px; height: 40px; margin-bottom: 0px;" value=""/></td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" style="font-size:10px;">&nbsp;</td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" style="font-size:10px;"><strong>Disclaimer: </strong>All loans are on sole discretion on the  banks</td>
         </tr>
       </table>
    
     
    </form>
    </div></div></div>

</div><div class="right-panel">
<div class="box-right"><img src="images/personal-banner1.png" width="250" height="262"></div>

</div>
</body>
</html>