<?php
require 'scripts/functions.php';
require 'scripts/db_init.php';

//print_R($_REQUEST);
$cc_bankid = $_REQUEST["cc_bankid"];
$RequestID = $_REQUEST["RequestID"];
$cc_name = $_REQUEST["cc_name"];

$strcrd_nme="";
if((strlen(trim($cc_name))>0) && $cc_bankid >1)
{
	$slct="select applied_card_name,Name,DOB,City from Req_Credit_Card Where (RequestID='".$RequestID."')";
	//$row=mysql_fetch_array($slct);
	list($Getnum,$row)=Mainselectfunc($slct,$array = array());
	$Name = $row['Name'];
	list($first,$middle,$last) = split('[ ]',$Name);

	if(strlen($row['applied_card_name'])>0)
	{
	$strcrd_nme=$row['applied_card_name'].",".$cc_name;
	}
	else
	{
		$strcrd_nme=$cc_name;
	}

	$DataArray = array("applied_card_name" =>$strcrd_nme);
	$wherecondition ="(RequestID='".$RequestID."')";
	Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);

	$slctcrd="select card_image from credit_card_banks_eligibility Where (cc_bankid='".$cc_bankid."')";
	//$row=mysql_fetch_array($slct);
	list($Getnum,$ccrow)=Mainselectfunc($slctcrd,$array = array());

	$Name = $row['Name'];
	$City = $row['City'];
	$DOB = date("d/m/Y", strtotime($row['DOB']));
	list($first,$middle,$last) = split('[ ]',$Name);
	$retrivesource = "American Express cards page";

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instant E Apply Credit Cards Online in India</title>
<meta name="keywords" content="online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application" />
<meta name="description" content="Fill Application form for credit cards. Instant Apply & get Approval for Credit cards such as HDFC, ICICI, Citibank, Standard Chartered, SBI and American express Online in India." />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
<link href="http://www.deal4loans.com/ccmobile/css/creditcard-lp-mobile-ui-new.css" type="text/css" rel="stylesheet">
<link href="http://www.deal4loans.com/css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
<link href="http://www.deal4loans.com/ccmobile/css/font-awesome.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="http://www.deal4loans.com/ccmobile/css/cc-bootstrap.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="application/javascript" src="http://www.deal4loans.com/ccmobile/js/validate.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-sbicclist.js"></script>
<style type="text/css">
.hintanchor {
	color: #CC0000;
}
.submitMainAmex {width: 100%;float: left;height: 110px;overflow-y: scroll;margin: 10px 0 10px 0;}
.submittingAmexWrapper {float: left;width: 100%;margin: 15px 0 10px 0;}
.submittingAmexWrapper label {display: block;float: left;width: 100%;color: #858585;font-size: 12px;font-family: Arial, Helvetica, sans-serif;}
.submittingAmexWrapper label input[type=checkbox] {float: left;display: block;width: auto;margin: 2px 10px 0 0;}
.submittingAmexWrapper label a {color: #116abd;}
.verifyWrap {float: left;width: 100%;}
.submitMainAmex ol {margin: 0 6px;}
.verifyWrap ol {list-style: decimal;}
.verifyWrap ol li {float: left;width: auto;color: #858585;font-size: 12px;font-family: Arial, Helvetica, sans-serif;padding: 0 1%;margin: 0 0 10px 2%;}
.terms-wrapper{ width:100%; height:150px; overflow:scroll;  overflow-x: hidden; margin-bottom:25px;}
.check{display: inherit; float: left; margin-right: 5px;}

</style>
<script type="text/javascript">

function Checkvalidateccstep2frm(Form)
{
	var j;
	var l;
	var r;
	var k;
	var cntr=-1;
	var cnt=-1;
	var cntl=-1;
	var cntlb=-1;
	var cntSa=-1;
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	//var cit=document.creditcard_form.City.value;
	//var sal=document.creditcard_form.Net_Salary.value;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if((Form.first_name.value=="") || (Form.first_name.value=="First Name"))
	{
        document.getElementById('FirstnameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your First Name</span>";		
		Form.first_name.focus();
		return false;
	}
	if((Form.last_name.value=="") || (Form.last_name.value=="Last Name"))
	{
        document.getElementById('LastnameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Last Name</span>";		
		Form.last_name.focus();
		return false;
	}
	if((Form.last_name.value.length < 2))
	{
        document.getElementById('LastnameVal').innerHTML = "<span  class='hintanchor'>Last Name must have min. 2 characters</span>";		
		Form.last_name.focus();
		return false;
	}
	if((Form.DOB.value=="")||(Form.DOB.value=="DD/MM/YYYY"))
	{
        document.getElementById('DOBVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Date of Birth</span>";		
		Form.DOB.focus();
		return false;
	}
	
	var a=Form.panno.value;
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	 	document.getElementById('pannoVal').innerHTML = "<span  class='hintanchor'>Please enter valid pan number</span>";	
		 Form.panno.focus();
		 return false;
	}
	if (Form.panno.value.charAt(3)!="P" && Form.panno.value.charAt(3)!="p")
	{
			document.getElementById('pannoVal').innerHTML = "<span  class='hintanchor'>Please enter valid pan number</span>";	
			Form.panno.focus();
			return false;
	}
	
	if((Form.panno.value==""))
	{
        document.getElementById('pannoVal').innerHTML = "<span  class='hintanchor'>Please Enter Pan Card Number</span>";		
		Form.panno.focus();
		return false;
	}
	
	
	for(j=0; j<document.ccstep2frm.Gender.length; j++) 
	{
        if(document.ccstep2frm.Gender[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		alert("Select Gender!");
		return false;
	}
	
	var txtRes = document.getElementById("resiaddress1").value;
	var reRes = /^[ A-Za-z0-9(',./#)+-]*$/
	
	if((Form.resiaddress1.value==""))
	{
        document.getElementById('resiaddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Resi Address</span>";		
		Form.resiaddress1.focus();
		return false;
	}
	
	if (!reRes.test(txtRes)) {
 		document.getElementById('resiaddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Resi Address</span>";		
		Form.resiaddress1.focus();
		return false;
	}
	
	if (Form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Please Select your Residence City!</span>";
		Form.City.focus();
		return false;
	}
	if (Form.pincode.value=="" || Form.pincode.value.length != 6)
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Pincode!</span>";
		Form.pincode.focus();
		return false;
	}
	if (Form.Qualification.selectedIndex==0)
	{
		document.getElementById('QualificationVal').innerHTML = "<span  class='hintanchor'>Select Qualification!</span>";
		Form.Qualification.focus();
		return false;
	}
	
	var txt = document.getElementById("OfficeAddress1").value;
	var re = /^[ A-Za-z0-9(',./#)+-]*$/
	if((Form.OfficeAddress1.value==""))
	{
        document.getElementById('OfficeAddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Office Address</span>";		
		Form.OfficeAddress1.focus();
		return false;
	}
	
	if (!re.test(txt)) {
	
 		document.getElementById('OfficeAddressVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Address</span>";		
		Form.OfficeAddress1.focus();
		return false;
	}
	
	if((Form.OfficeCity.value==""))
	{
        document.getElementById('OfficeCityVal').innerHTML = "<span  class='hintanchor'>Please Select Your office City</span>";		
		Form.OfficeCity.focus();
		return false;
	}
	if (Form.OfficePin.value=="")
	{
		document.getElementById('OfficePinVal').innerHTML = "<span  class='hintanchor'>Please Enter Valid Pincode!</span>";
		Form.OfficePin.focus();
		return false;
	}
	
	if((Form.Phone_Number.value==""))
	{
        document.getElementById('Land_linenumberVal2').innerHTML = "<span  class='hintanchor'>Please Enter Valid Landline Number!</span>";		
		Form.Phone_Number.focus();
		return false;
	}
	if(Form.Phone_Number.value.length!="11" || Form.Phone_Number.value.toString().indexOf("0") != 0)
	{
        document.getElementById('Land_linenumberVal2').innerHTML = "<span  class='hintanchor'>Phone Number must be 11 digits and STD code must start with 0!</span>";		
		Form.Phone_Number.focus();
		return false;
	}
	
	}

function ShowCityField(evt)
{
document.getElementById("ShowCityAddr").style.display="block";
}
function showProfDetails(evt)
{
document.getElementById("ShowProfDetails").style.display="block";
}


function ShowLandlineField(evt)
{
	document.getElementById("landLineNumber").style.display="block";
	document.getElementById("PostPaidNumber").style.display="none";
}

function ShowPostPaidField(evt)
{
	document.getElementById("PostPaidNumber").style.display="block";
	document.getElementById("landLineNumber").style.display="none";
}


</script>
<style>
#ajax_listOfOptions{position:absolute;width:500px;height:160px;overflow:auto;border:1px solid #317082;background-color:#FFF;color:#000;font-family:Verdana,'Raleway';text-align:left;font-size:10px;z-index:100}
#ajax_listOfOptions div{cursor:pointer;font-size:10px;margin:1px;padding:1px}
#ajax_listOfOptions .optionDivSelected{background-color:#2375CB;color:#FFF}
#ajax_listOfOptions_iframe{background-color:red;position:absolute;z-index:5}

.hintanchor { font-size:12px; font-weight:bold; color:#F00;}
#wordloanAmount{ padding-bottom:15px;}
#wordIncome{ padding-bottom:15px;}
.alert_msg{ margin-bottom:15px;}
#nameVal{ padding-bottom:15px;}
#mobileVal{ padding-bottom:15px;}
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<!--<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:90px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> SBI Credit Card</span></div>-->
<div style="clear:both; height:70px;"></div>

<div class="bank-logos"><img src="/new-images/american-express-logo.jpg" /></div>
<div class="bank-text">Get Instant Online Approval for <? echo $cc_name; ?> In 30 seconds.<br />Receive Approval online and on Sms.<br />
100% data security with American Express online Approval systems.
</div>
<div class="card-image"><img src="/<? echo $ccrow["card_image"]; ?>" border="0" /></div> 
<div class="clearfix"></div>
<div class="app-counting bg-success"><strong>12,541</strong> Applications approved and counting .</div>
<div class="clearfix"></div>

<div class="mobile-main-wrapper">
  <div class="mobile-form-left">
    <div class="head_2 heading-margin-bottom">Confirm Details as per PAN Card</div>
    <div class="product-listing-new"> </div>
    <div style="clear:both;"></div>
    <form method="post" name="ccstep2frm" id="ccstep2frm" action="amex-credit-card-thankyou.php"  onSubmit="return Checkvalidateccstep2frm(document.ccstep2frm); ">
      <input type="hidden" name="requestID" id="requestID" value="<? echo $RequestID; ?>">
      <input type="hidden" name="card_name" id="card_name" value="<? echo $cc_name; ?>" />
      <input type="hidden" name="card_id" id="card_id" value="<? echo $cc_bankid; ?>" />
      <div class="pancardbox">
        <div class="pan-form">
          <div class="pan-name">
            <div class="nametextpan">First Name</div>
            <input name="first_name" id="first_name" type="text" class="pan-inputname" value="<?php if($first) {echo $first; } else {echo 'First Name';}?>" onFocus="if(this.value=='First Name')this.value=''" onBlur="if(this.value=='')this.value='First Name'" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('FirstnameVal');" maxlength="12" />
            <div style="clear:both; height:15px;"></div>
            <div id="FirstnameVal"></div>
          </div>
          <div class="pan-name margin-a-left">
            <div class="nametextpan">Middle Name</div>
            <input name="middle_name" id="middle_name" type="text" class="pan-inputname"  value="<?php if(strlen($middle)>0 && strlen($last)>0) { echo $middle;} else {echo ''; }?>" onFocus="if(this.value=='Middle Name')this.value=''" onBlur="if(this.value=='')this.value=''" onKeyPress="return isCharsetKey(event);" />
          </div>
          <div class="pan-name margin-a-left">
            <div class="nametextpan">Last Name</div>
            <input name="last_name" id="last_name" type="text" class="pan-inputname" value="<?php if(strlen($last)>0) { echo $last;} elseif(strlen($middle)>0 && $last==""){ echo $middle;} else {echo 'Last Name';}?>" onFocus="if(this.value=='Last Name')this.value=''" onBlur="if(this.value=='')this.value='Last Name'" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('LastnameVal');" />
            <div style="clear:both; height:15px;"></div>
            <div id="LastnameVal"></div>
          </div>
          <div class="clearfix"></div>
          <div class="pan-name">
            <input name="DOB" id="DOB" type="text" class="pan-inputname" value="<?php if($DOB) {echo $DOB; } else {echo 'DD/MM/YYYY';}?>"  onFocus="if(this.value=='DD/MM/YYYY')this.value=''" onBlur="if(this.value=='')this.value='DD/MM/YYYY'" onkeydown="validateDiv('DOBVal');" />
            <div style="clear:both;"></div>
            <div id="DOBVal"></div>
          </div>
          <div style="clear:both;"></div>
          <br />
          <div class="account-no">Permanent Account Number</div>
          <div style="clear:both; height:5px;"></div>
          <div class="pannumberdigit" style="background:#FFF; opacity:0.5;">
            <input  name="panno" id="panno" type="text" class="pan-inputname" placeholder="BOUPR9012L" onkeydown="validateDiv('pannoVal');" style="border:none; width:100%;" />
            <div style="clear:both;"></div>
            <div id="pannoVal"></div>
          </div>
        </div>
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <div class="gender-box"> <strong>Gender</strong>
          <div class="form-required">
            <label for="radio-one">
              <input type="radio" name="Gender" id="radio-one" value="Male" onclick="return ShowCityField(event)"/>
              <i></i> <span>Male</span> </label>
            <label for="radio-two">
              <input type="radio" name="Gender" id="radio-two" value="Female" onclick="return ShowCityField(event)"/>
              <i></i> <span>Female</span> </label>
          </div>
        </div>
      </div>
      <div style="clear:both;"></div>
      <span id="ShowCityAddr" style="display:none;">
      <input name="resiaddress1" id="resiaddress1" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="Complete Residential address" onkeydown="validateDiv('resiaddressVal');"  maxlength="120" />
      <div style="clear:both;"></div>
      <div id="resiaddressVal"></div>
      <div style="clear:both;"></div>
      <div class="annual-income-ui-input-wrapper">
        <select name="City" id="City" class="mobile-ui-input location-icon input-bottom-margin" onchange="showPinCode(this.value);  validateDiv('cityVal');" >
          <option value="">Select Your Residence City</option>
          <?php 
		$getcitySql = "SELECT * FROM creditcard_citylist WHERE status=1 GROUP BY cityname";
		list($numRowscity,$getcityQuery)=MainselectfuncNew($getcitySql,$array = array());
		for($cN=0;$cN<$numRowscity;$cN++)
		{
		$cityname = ucwords(strtolower($getcityQuery[$cN]['cityname']));
		$cityalias =ucwords(strtolower($getcityQuery[$cN]['cityalias']));
		?>
			  <option value="<?php if(strlen($cityalias)>2) { echo $cityalias; } else { echo $cityname; } ?>" <? if($cityname==$City || $cityalias==$City) echo "selected";?>><?php if(strlen($cityalias)>2) { echo $cityalias; } else { echo $cityname; } ?></option>
			  <?php
		}
		?>
        </select>
        <div style="clear:both;"></div>
        <div id="cityVal"></div>
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <input name="pincode" id="pincode" type="text"  class="annual-income-ui-input pancard-icon float-left" maxlength="6" placeholder="Pincode" tabindex=3 autocomplete="off" onKeyPress="return numOnly(event);" onkeydown="return showProfDetails(event); validateDiv('pincodeVal');" />
        <div style="clear:both;"></div>
        <div id="pincodeVal"></div>
      </div>
      </span>
      <div style="clear:both;"></div>
      <hr />
      <span id="ShowProfDetails" style="display:none;">
      <div style="clear:both;"></div>
      <div class="head_2">Professional Details</div>
      <p class="smalltext"><img src="ccmobile/images/privacy-lock.png" width="9" height="10" alt="lock" /> Your Information is secure with us and will not be shared without your consent</p>
	     <select name="Qualification" id="Qualification" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('QualificationVal');">
        <option value="">Select Qualification</option>
		<option  value="U">Under Graduate</option>
        <option value="B">Graduate / Diploma</option>
        <option value="D">Post Graduate</option>
        <option value="O">Others</option>
      </select>
      <div style="clear:both;"></div>
      <div id="QualificationVal"></div>
       <input name="OfficeAddress1" id="OfficeAddress1" type="text" class="mobile-ui-input input-bottom-margin location-icon" placeholder="Complete Office Address" onkeydown="validateDiv('OfficeAddressVal');"  maxlength="120" />
      <div style="clear:both;"></div>
      <div id="OfficeAddressVal"></div>
      <div style="clear:both;"></div>
      <div class="annual-income-ui-input-wrapper">
        <select name="OfficeCity" id="OfficeCity" class="mobile-ui-input location-icon input-bottom-margin" onchange="showUser(this.value); validateDiv('OfficeCityVal');">
          <option value="">Select Your Office City</option>
         <?php 
		$getcitySql = "SELECT * FROM creditcard_citylist WHERE status=1 GROUP BY cityname";
		list($numRowscity,$getcityQuery)=MainselectfuncNew($getcitySql,$array = array());
		for($cN=0;$cN<$numRowscity;$cN++)
		{
		$cityname = ucwords(strtolower($getcityQuery[$cN]['cityname']));
		$cityalias =ucwords(strtolower($getcityQuery[$cN]['cityalias']));
		?>
			  <option value="<?php if(strlen($cityalias)>2) { echo $cityalias; } else { echo $cityname; } ?>" <? if($cityname==$City || $cityalias==$City) echo "selected";?>><?php if(strlen($cityalias)>2) { echo $cityalias; } else { echo $cityname; } ?></option>
			  <?php
		}
		?>
        </select>
        <div style="clear:both;"></div>
        <div id="OfficeCityVal"></div>
        <div style="clear:both;"></div>
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
	  <input name="OfficePin" id="txtHint" type="text"  class="annual-income-ui-input pancard-icon float-left" placeholder="Pincode" maxlength="6" tabindex=3 autocomplete="off" onKeyPress="return numOnly(event);" onkeydown="return showProfDetails(event); validateDiv('pincodeVal');" />
        <div style="clear:both;"></div>
        <div id="OfficePinVal"></div>
      </div>
        <div style="clear:both;"></div>
      Residence Landline Number with StdCode
      <div style="clear:both; height:10px;"></div>
        <div class="annual-income-ui-input-wrapper">
        <div class="mobile-ui-input landline-icon input-bottom-margin">
          <div class="stdlandlinewrapper">
            <!--<input name="STD" type="text" class="stdtext" placeholder="STD" onkeydown="validateDiv('STDVal');" maxlength="4" onKeyPress="return numOnly(event);">-->
            <input name="Phone_Number" type="text" class="stdnumbertext " placeholder="Number"  onkeydown="validateDiv('Land_linenumberVal2');" onKeyPress="return numOnly(event);" maxlength="11">
            <div id="Land_linenumberVal2"></div>
            <div style="clear:both;"></div>
          </div>
          <div style="clear:both;"></div>
        </div>
      </div>
	<select name="BillingPrefernce" id="BillingPrefernce" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('BillingPrefernceal');">
        <option value="">Select Billing Preference</option>
		 <option  value="0">Beginning of the Month</option>
        <option value="5">Middle of the Month</option>
        <option value="9">End of the Month</option>
          </select>
      <div style="clear:both;"></div>
      <div id="BillingPrefernceal"></div>
      </span>      
      <div style="clear:both;"></div>
      </span>
            <div style="clear:both; margin-top:15px;"></div>
      <!-- scroll content for instant online approval-->
      <?php
      if ($cc_bankid==47){ ?>
      <div class="submitMainWrap" tabindex="5000" style="">   
      <div class="terms-wrapper"> 
          <label style="font-weight:normal; line-height: 22px; !important"><input type="checkbox" id="disclaimer" name="disclaimer" style="display:inherit; float:left; margin-right:5px;"  value="i agree" checked />
 By submitting this application, I certify that I have read, met, and agreed to all of the terms, conditions and disclosures provided in the <a href="https://www.americanexpressindia.co.in/amex-website/credit-card-single-form/offer-tnc-platinum-travel.pdf">Cardmember undertaking</a>. I request that an <strong>American Express®  Platinum Travel Credit Card</strong> account(s) be opened for me and for <strong>American Express Platinum Travel Credit Card</strong> to be issued as requested.</label> <ol> <li>I / We confirm that I / supplementary card applicant/s is a Resident Indian as defined under the Income Tax Act of India and hereby declare that I/We will notify American Express Banking Corp. if there is a change in the residential status.</li>       <li>I authorize American Express Banking Corp. (AEBC) to verify information in this application and to receive and exchange information about me including requesting reports from my bank, consumer credit, social media, reference schemes or credit information companies/bureaus and CIBIL. I authorize AEBC and its affiliates/representatives/agents to contact the aforesaid sources for information pertaining to me at any time, to use information from this application and information obtained from aforesaid sources for operational, administrative and marketing purposes and to service the card account(s) and to share such information with each other.  I declare and undertake that the card(s) issued to me, if used overseas shall be used strictly in accordance with the extant Exchange Control Regulations issued by the Reserve Bank of India (RBI).</li>       <li>In the event that I exceed my entitlements as per the Exchange Control Guidelines of the RBI, I undertake to bring the same immediately to the notice of AEBC, in writing. Obtaining any approval from RBI for excess foreign exchange spending shall be my responsibility.</li>       <li>I understand that the basic cardmember will be liable for all charges incurred on the basic card, any additional card and any supplementary card. The Supplementary Cardmember accepts joint and several responsibility for all charges incurred on the supplementary card issued to him/her.</li>       <li>I agree to be bound by the cardmember terms and conditions of use which will accompany the card. I confirm that American Express® has shared the <a href="https://www.americanexpress.com/in/content/mitc.html">Most Important Terms and Conditions (MITC)</a> for the <strong>American Express®  Platinum Travel Credit Card</strong> with me in compliance of the RBI master circular on credit card operations of banks and I have read understood and accept the MITC and agree to sign this undertaking.</li>       <li>I understand that AEBC may decline this application at its absolute and sole discretion. We would like to assure you that American Express® strongly respects and honours customer privacy. If you wish to view the American Express® Privacy policy please log on to <a href="https://www.americanexpress.com/in/content/privacy-statement" target="_blank">https://www.americanexpress.com/in/content/privacy-statement</a>.html I accept that the additional factor of authentication is mandated by RBI vide letter DPSS.PDCONO223/02.14.003/2011-12 dates August 4, 2011 and use such cards for travel and related CNP Transactions without such additional factor of authentication carries security risk and such cards are vulnerable to frauds.</li>       <li>I understand that in the event of changes in correspondence address due to relocation or any other reason, I will intimate my new address to the bank within two weeks of such a change. I understand that in the event of change in the address mentioned as per proof of address, I will submit fresh proof of address to the bank within a period of three months of such a change.</li>       <li>I Authorize American Express® Banking Corp. to use the information/details provided earlier for the purpose of processing my card application. I Confirm that the information/details provided earlier are true and correct as of date. This Application form is intended only for card members who were in receipt of the original solicitation email.</li>       <li>I provide my consent to be contacted on the email and mobile number shared by me, even if I am registered with the National Customer Preference Register (NCPR) and opted out of receiving all promotional calls and messages. I understand that my personal and sensitive information shall be used and shared by AEBC in accordance with its Privacy Policy as updated on the website. For details of Privacy Principles please log on to <a href="http://www.americanexpress.com/india/pdfs/privacy_statement.pdf" target="_blank">http://www.americanexpress.com/india/pdfs/privacy_statement.pdf</a></li><li>I understand and agree that the first payment made on my Amex card will be made via a Know Your Customer (KYC)-complied account as maintained by me with another Scheduled Commercial Bank in India. I also understand that in the event I make the first payment via cash towards my Amex Card, my card account will be permanently cancelled without any further notice and will not be eligible for reinstatement.</li>    </ol>   </div>   <!--<div class='offerTncNew'><a href='offer-tnc-platinum-travel.pdf' target='_blank'>*Offer Terms and Conditions</a></div>--> </div>
      <?php } 
     else if ($cc_bankid==46) { ?>
     <div class="submitMainWrap" tabindex="5000" style="">   
      <div class="terms-wrapper"> 
      <label style="font-weight:normal; line-height: 22px; !important"><input type="checkbox" id="disclaimer" name="disclaimer" class="check" style="display:inherit; float:left; margin-right:5px;"  value="i agree" checked />By submitting this application, I certify that I have read, met, and agreed to all of the terms, conditions and disclosures provided in the <a href="https://www.americanexpressindia.co.in/amex-website/credit-card-single-form/offer-tnc-gold.pdf" target="_blank">Cardmember undertaking</a>. I request that an <strong>American Express® Gold Card</strong> account(s) be opened for me and for <strong>American Express® Gold Card</strong> to be issued as requested.</label><ol> <li>I / We confirm that I / supplementary card applicant/s is a Resident Indian as defined under the Income Tax Act of India and hereby declare that I/We will notify American Express Banking Corp. if there is a change in the residential status. </li>       <li>I authorize American Express Banking Corp. (AEBC) to verify information in this application and to receive and exchange information about me including requesting reports from my bank, consumer credit, social media, reference schemes or credit information companies/bureaus and CIBIL. I authorize AEBC and its affiliates/representatives/agents to contact the aforesaid sources for information pertaining to me at any time, to use information from this application and information obtained from aforesaid sources for operational, administrative and marketing purposes and to service the card account(s) and to share such information with each other.  I declare and undertake that the card(s) issued to me, if used overseas shall be used strictly in accordance with the extant Exchange Control Regulations issued by the Reserve Bank of India (RBI).</li>       <li>In the event that I exceed my entitlements as per the Exchange Control Guidelines of the RBI, I undertake to bring the same immediately to the notice of AEBC, in writing. Obtaining any approval from RBI for excess foreign exchange spending shall be my responsibility.</li>       <li>I understand that the basic cardmember will be liable for all charges incurred on the basic card, any additional card and any supplementary card. The Supplementary Cardmember accepts joint and several responsibility for all charges incurred on the supplementary card issued to him/her.</li>       <li>I agree to be bound by the cardmember terms and conditions of use which will accompany the card. I confirm that American Express® has shared the <a href="https://www.americanexpress.com/in/content/mitc.html">Most Important Terms and Conditions (MITC)</a> for the American Express® Gold Card with me in compliance of the RBI master circular on credit card operations of banks and I have read understood and accept the MITC and agree to sign this undertaking.</li>       <li>I understand that AEBC may decline this application at its absolute and sole discretion. We would like to assure you that American Express® strongly respects and honours customer privacy. If you wish to view the American Express® Privacy policy please log on to <a href="https://www.americanexpress.com/in/content/privacy-statement.html">https://www.americanexpress.com/in/content/privacy-statement.html</a> I accept that the additional factor of authentication is mandated by RBI vide letter DPSS.PDCONO223/02.14.003/2011-12 dates August 4, 2011 and use such cards for travel and related CNP Transactions without such additional factor of authentication carries security risk and such cards are vulnerable to frauds.</li>       <li>I understand that in the event of changes in correspondence address due to relocation or any other reason, I will intimate my new address to the bank within two weeks of such a change. I understand that in the event of change in the address mentioned as per proof of address, I will submit fresh proof of address to the bank within a period of three months of such a change.</li>       <li>I Authorize American Express® Banking Corp. to use the information/details provided earlier for the purpose of processing my card application. I Confirm that the information/details provided earlier are true and correct as of date. This Application form is intended only for card members who were in receipt of the original solicitation email.</li>       <li>I provide my consent to be contacted on the email and mobile number shared by me, even if I am registered with the National Customer Preference Register (NCPR) and opted out of receiving all promotional calls and messages. I understand that my personal and sensitive information shall be used and shared by AEBC in accordance with its Privacy Policy as updated on the website. For details of Privacy Principles please log on to <a href="http://www.americanexpress.com/india/pdfs/privacy_statement.pdf" target="_blank">http://www.americanexpress.com/india/pdfs/privacy_statement.pdf</a></li> <li>I understand and agree that the first payment made on my Amex card will be made via a Know Your Customer (KYC)-complied account as maintained by me with another Scheduled Commercial Bank in India. I also understand that in the event I make the first payment via cash towards my Amex Card, my card account will be permanently cancelled without any further notice and will not be eligible for reinstatement.</li>    </ol>   </div>   <!--<<div class='offerTncNew'>a href='offer-tnc-gold.pdf' target='_blank'>*Offer Terms and Conditions</a></div>  --> </div>
       <? } else if ($cc_bankid==50) { ?>
      <div class="submitMainWrap" tabindex="5000" style="">   
      <div class="terms-wrapper">    
      <label style="font-weight:normal; line-height: 22px; !important"><input type="checkbox" id="disclaimer" name="disclaimer" style="display:inherit; float:left; margin-right:5px;" value="i agree" checked />By submitting this application, I certify that I have read, met, and agreed to all of the terms, conditions and disclosures provided in the <a href="https://www.americanexpressindia.co.in/amex-website/credit-card-single-form/offer-tnc-mmt.pdf" target="_blank">Cardmember undertaking</a>. I request that an <strong>American Express®  MakeMyTrip Credit Card</strong> account(s) be opened for me and for <strong>American Express®  MakeMyTrip Credit Card</strong> to be issued as requested. </label> <ol> <li>I / We confirm that I / supplementary card applicant/s is a Resident Indian as defined under the Income Tax Act of India and hereby declare that I/We will notify American Express Banking Corp. if there is a change in the residential status.</li>       <li>I authorize American Express Banking Corp. (AEBC) to verify information in this application and to receive and exchange information about me including requesting reports from my bank, consumer credit, social media, reference schemes or credit information companies/bureaus and CIBIL. I authorize AEBC and its affiliates/representatives/agents to contact the aforesaid sources for information pertaining to me at any time, to use information from this application and information obtained from aforesaid sources for operational, administrative and marketing purposes and to service the card account(s) and to share such information with each other.  I declare and undertake that the card(s) issued to me, if used overseas shall be used strictly in accordance with the extant Exchange Control Regulations issued by the Reserve Bank of India (RBI).</li>       <li>In the event that I exceed my entitlements as per the Exchange Control Guidelines of the RBI, I undertake to bring the same immediately to the notice of AEBC, in writing. Obtaining any approval from RBI for excess foreign exchange spending shall be my responsibility.</li>       <li>I understand that the basic cardmember will be liable for all charges incurred on the basic card, any additional card and any supplementary card. The Supplementary Cardmember accepts joint and several responsibility for all charges incurred on the supplementary card issued to him/her.</li>       <li>I agree to be bound by the cardmember terms and conditions of use which will accompany the card. I confirm that American Express® has shared the <a href="https://www.americanexpress.com/in/content/mitc.html">Most Important Terms and Conditions (MITC)</a> for the <strong>American Express®  MakeMyTrip Credit Card</strong> with me in compliance of the RBI master circular on credit card operations of banks and I have read understood and accept the MITC and agree to sign this undertaking.</li>       <li>I understand that AEBC may decline this application at its absolute and sole discretion. We would like to assure you that American Express® strongly respects and honours customer privacy. If you wish to view the American Express® Privacy policy please log on to <a href="https://www.americanexpress.com/in/content/privacy-statement.html" target="_blank">https://www.americanexpress.com/in/content/privacy-statement.html</a> I accept that the additional factor of authentication is mandated by RBI vide letter DPSS.PDCONO223/02.14.003/2011-12 dates August 4, 2011 and use such cards for travel and related CNP Transactions without such additional factor of authentication carries security risk and such cards are vulnerable to frauds.</li>       <li>I understand that in the event of changes in correspondence address due to relocation or any other reason, I will intimate my new address to the bank within two weeks of such a change. I understand that in the event of change in the address mentioned as per proof of address, I will submit fresh proof of address to the bank within a period of three months of such a change.</li>       <li>I Authorize American Express® Banking Corp. to use the information/details provided earlier for the purpose of processing my card application. I Confirm that the information/details provided earlier are true and correct as of date. This Application form is intended only for card members who were in receipt of the original solicitation email.</li>       <li>I provide my consent to be contacted on the email and mobile number shared by me, even if I am registered with the National Customer Preference Register (NCPR) and opted out of receiving all promotional calls and messages. I understand that my personal and sensitive information shall be used and shared by AEBC in accordance with its Privacy Policy as updated on the website. For details of Privacy Principles please log on to <a href="http://www.americanexpress.com/india/pdfs/privacy_statement.pdf" target="_blank">http://www.americanexpress.com/india/pdfs/privacy_statement.pdf</a></li> <li>I understand and agree that the first payment made on my Amex card will be made via a Know Your Customer (KYC)-complied account as maintained by me with another Scheduled Commercial Bank in India. I also understand that in the event I make the first payment via cash towards my Amex Card, my card account will be permanently cancelled without any further notice and will not be eligible for reinstatement.</li>    </ol>   </div>   <!--<div class='offerTncNew'><a href='offer-tnc-mmt.pdf' target='_blank'>*Offer Terms and Conditions</a></div> --> </div> 
<? } else if ($cc_bankid==71) { ?>
      <div class="submitMainWrap" tabindex="5000" style="">   
      <div class="terms-wrapper">    
      <label style="font-weight:normal; line-height: 22px; !important"><input type="checkbox" id="disclaimer" name="disclaimer" style="display:inherit; float:left; margin-right:5px;" value="i agree" checked /> By submitting this application, I certify that I have read, met, and agreed to all of the terms, conditions and disclosures provided in the <a href="https://www.americanexpressindia.co.in/assets/pdf/card-undertaking-platinum-reserve.pdf" target="_blank">Cardmember undertaking</a>. I request that an <strong>The American Express Membership Rewards® Credit Card</strong> account(s) be opened for me and for <strong>The American Express Membership Rewards® Credit Card</strong> to be issued as requested. </label> <ol> <li>I / We confirm that I / supplementary card applicant/s is a Resident Indian as defined under the Income Tax Act of India and hereby declare that I/We will notify American Express Banking Corp. if there is a change in the residential status.</li>       <li>I authorize American Express Banking Corp. (AEBC) to verify information in this application and to receive and exchange information about me including requesting reports from my bank, consumer credit, social media, reference schemes or credit information companies/bureaus and Credit Information Companies (CIC) as authorised by Reserve Bank of India. I authorize AEBC and its affiliates/representatives/agents to contact the aforesaid sources for information pertaining to me at any time, to use information from this application and information obtained from aforesaid sources for operational, administrative and marketing purposes and to service the card account(s) and to share such information with each other.  I declare and undertake that the card(s) issued to me, if used overseas shall be used strictly in accordance with the extant Exchange Control Regulations issued by the Reserve Bank of India (RBI).</li>       <li>In the event that I exceed my entitlements as per the Exchange Control Guidelines of the RBI, I undertake to bring the same immediately to the notice of AEBC, in writing. Obtaining any approval from RBI for excess foreign exchange spending shall be my responsibility.</li>       <li>I understand that the basic cardmember will be liable for all charges incurred on the basic card, any additional card and any supplementary card. The Supplementary Cardmember accepts joint and several responsibility for all charges incurred on the supplementary card issued to him/her.</li>       <li>I agree to be bound by the cardmember terms and conditions of use which will accompany the card. I confirm that American Express® has shared the Most Important Terms and Conditions (MITC) for the American Express®  Platinum ReserveSM Credit Card with me in compliance of the RBI master circular on credit card operations of banks and I have read understood and accept the MITC and agree to sign this undertaking.</li>       <li>I understand that AEBC may decline this application at its absolute and sole discretion. We would like to assure you that American Express® strongly respects and honours customer privacy. If you wish to view the American Express® Privacy policy please log on to <a href="https://www.americanexpress.com/in/content/privacy-statement.html" target="_blank">https://www.americanexpress.com/in/content/privacy-statement.html</a> I accept that the additional factor of authentication is mandated by RBI vide letter DPSS.PDCONO223/02.14.003/2011-12 dates August 4, 2011 and use such cards for travel and related CNP Transactions without such additional factor of authentication carries security risk and such cards are vulnerable to frauds.</li>       <li>I understand that in the event of changes in correspondence address due to relocation or any other reason, I will intimate my new address to the bank within two weeks of such a change. I understand that in the event of change in the address mentioned as per proof of address, I will submit fresh proof of address to the bank within a period of three months of such a change.</li>       <li>I Authorize American Express® Banking Corp. to use the information/details provided earlier for the purpose of processing my card application. I Confirm that the information/details provided earlier are true and correct as of date. This Application form is intended only for card members who were in receipt of the original solicitation email.</li>       <li>I provide my consent to be contacted on the email and mobile number shared by me, even if I am registered with the National Customer Preference Register (NCPR) and opted out of receiving all promotional calls and messages. I understand that my personal and sensitive information shall be used and shared by AEBC in accordance with its Privacy Policy as updated on the website. For details of Privacy Principles please log on to <a href="https://www.americanexpress.com/india/pdfs/privacy_statement.pdf" target="_blank">https://www.americanexpress.com/india/pdfs/privacy_statement.pdf</a></li> 
<li>I understand and agree that the first payment made on my Amex card will be made via a Know Your Customer (KYC)-complied account as maintained by me with another Scheduled Commercial Bank in India. I also understand that in the event I make the first payment via cash towards my Amex Card, my card account will be permanently cancelled without any further notice and will not be eligible for reinstatement.</li>    </ol>   </div>   <!--<div class='offerTncNew'><a href='offer-tnc-mmt.pdf' target='_blank'>*Offer Terms and Conditions</a></div> --> </div> 
<? } ?>

<div class="app-counting bg-success"><span class="app-wow">Wow!</span> You are almost done</div>
      
      <div style="clear:both; margin-top:15px;"></div>
      <button class="submit-btn" type="submit">Instant Online Approval</button>
    </form>
  </div>
  <div style="clear:both; margin-top:15px;"></div>
</div>

 <div style="clear:both;"></div>

</div>
</div>
<div style="clear:both; height:15px;"></div>
<div class="hide-top"><?php include "footer_sub_menu.php"; ?></div></body>
</html>