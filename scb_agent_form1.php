<?php 
	error_reporting(0);
	require 'scripts/functions.php';
	require 'scripts/db_init.php';

	$custid = $_REQUEST["cust_id"];
	$RequestID = $custid;

	$slct="select applied_card_name,Pancard, Name,DOB,City,Pincode from Req_Credit_Card Where (RequestID='".$RequestID."')";
	list($Getnum,$row)=Mainselectfunc($slct,$array = array());
	$Name = $row['Name'];
	list($first,$middle,$last) = split('[ ]',$Name);
	$City = $row['City'];
	$Pincode = $row['Pincode'];
	$Pancard = $row['Pancard'];
	$DOB = date("d/m/Y", strtotime($row['DOB']));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SCB</title>
<link href="http://www.deal4loans.com/ccmobile/css/creditcard-lp-mobile-ui-new.css" type="text/css" rel="stylesheet">
<link href="http://www.deal4loans.com/css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="http://www.deal4loans.com/ccmobile/css/font-awesome.css" type="text/css" rel="stylesheet" >
<link rel="stylesheet" href="http://www.deal4loans.com/ccmobile/css/cc-bootstrap.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<style type="text/css">
.hintanchor {
	color: #CC0000;
}

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
	if (Form.pincode.selectedIndex==0)
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Please Select Pincode!</span>";
		Form.pincode.focus();
		return false;
	}
	if (Form.Qualification.selectedIndex==0)
	{
		document.getElementById('QualificationVal').innerHTML = "<span  class='hintanchor'>Select Qualification!</span>";
		Form.Qualification.focus();
		return false;
	}
	if((Form.Designation.value==""))
	{
        document.getElementById('DesignationVal').innerHTML = "<span  class='hintanchor'>Please Enter Your Designation</span>";		
		Form.Designation.focus();
		return false;
	}
	
	if((Form.STD.value==""))
	{
        document.getElementById('STDVal').innerHTML = "<span  class='hintanchor'>Please Enter STD Code</span>";		
		Form.STD.focus();
		return false;
	}
	
	if((Form.Phone_Number.value==""))
	{
        document.getElementById('Land_linenumberVal2').innerHTML = "<span  class='hintanchor'>Select Landline Number!</span>";		
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
}

function ShowPostPaidField(evt)
{
	document.getElementById("landLineNumber").style.display="none";
}

function validateDiv(div) {	var ni1 = document.getElementById(div); 	ni1.innerHTML = ''; }
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
<div class="mobile-main-wrapper">
  <div class="mobile-form-left">
    <div class="head_2 heading-margin-bottom">Confirm Details as per PAN Card</div>
    <div class="product-listing-new"> </div>
    <div style="clear:both;"></div>
	<!--<form method="post" name="ccstep2frm" id="ccstep2frm" action="scb-credit-card-agent_thankyou.php"  onSubmit="return Checkvalidateccstep2frm(document.ccstep2frm); ">-->
    <form method="post" name="ccstep2frm" id="ccstep2frm" action="scb-credit-card-agent_thankyou.php" >
      <input type="hidden" name="requestID" id="requestID" value="<? echo $RequestID; ?>">
      <div class="pancardbox">
        <div class="pan-form">
          <div class="pan-name">
            <div class="nametextpan">First Name</div>
            <input name="first_name" id="first_name" type="text" class="pan-inputname" value="<?php if($first) {echo $first; } else {echo 'First Name';}?>" onFocus="if(this.value=='First Name')this.value=''" onBlur="if(this.value=='')this.value='First Name'" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('FirstnameVal');" maxlength="12">
            <div style="clear:both; height:15px;"></div>
            <div id="FirstnameVal"></div>
          </div>
          <div class="pan-name margin-a-left">
            <div class="nametextpan">Middle Name</div>
            <input name="middle_name" id="middle_name" type="text" class="pan-inputname"  value="<?php if(strlen($middle)>0 && strlen($last)>0) { echo $middle;} else {echo ''; }?>" onFocus="if(this.value=='Middle Name')this.value=''" onBlur="if(this.value=='')this.value=''" onKeyPress="return isCharsetKey(event);">
          </div>
          <div class="pan-name margin-a-left">
            <div class="nametextpan">Last Name</div>
            <input name="last_name" id="last_name" type="text" class="pan-inputname" value="<?php if(strlen($last)>0) { echo $last;} elseif(strlen($middle)>0 && $last==""){ echo $middle;} else {echo 'Last Name';}?>" onFocus="if(this.value=='Last Name')this.value=''" onBlur="if(this.value=='')this.value='Last Name'" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('LastnameVal');">
            <div style="clear:both; height:15px;"></div>
            <div id="LastnameVal"></div>
          </div>
          <div class="clearfix"></div>
          <div class="pan-name">
            <input name="DOB" id="DOB" type="text" class="pan-inputname" value="<?php if($DOB) {echo $DOB; } else {echo 'DD/MM/YYYY';}?>"  onFocus="if(this.value=='DD/MM/YYYY')this.value=''" onBlur="if(this.value=='')this.value='DD/MM/YYYY'" onkeydown="validateDiv('DOBVal');">
            <div style="clear:both;"></div>
            <div id="DOBVal"></div>
          </div>
          <div style="clear:both;"></div>
          <br />
          <div class="account-no">Permanent Account Number</div>
          <div style="clear:both; height:5px;"></div>
          <div class="pannumberdigit" style="background:#FFF; opacity:0.5;">
            <input  name="panno" id="panno" type="text" class="pan-inputname" placeholder="BOUPR9012L" value="<?php echo $Pancard; ?>" onkeydown="validateDiv('pannoVal');" style="border:none; width:100%;">
            <div style="clear:both;"></div>
            <div id="pannoVal"></div>
          </div>
        </div>
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <div class="gender-box"> <strong>Gender</strong>
          <div class="form-required">
            <label for="radio-one">
              <input type="radio" name="Gender" id="radio-one" value="1" onclick="return ShowCityField(event)"/>
              <i></i> <span>Male</span> </label>
            <label for="radio-two">
              <input type="radio" name="Gender" id="radio-two" value="2" onclick="return ShowCityField(event)"/>
              <i></i> <span>Female</span> </label>
          </div>
        </div>
      </div>
      <div style="clear:both;"></div>
      <span id="ShowCityAddr" style="display:none;">
      <input name="resiaddress1" id="resiaddress1" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="Complete Residential address" onkeydown="validateDiv('resiaddressVal');"  maxlength="120" >
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
        <input name="pincode" id="pincode" type="text"  class="annual-income-ui-input pancard-icon float-left" placeholder="Pincode" tabindex=3 autocomplete="off" onkeydown="validateDiv('pincodeVal');" value="<?php echo $Pincode; ?>" />
		 <div style="clear:both;"></div>
        <div id="pincodeVal"></div>
      </div>
      </span>
      <div style="clear:both;"></div>
      <hr>
      <span id="ShowProfDetails">
      <div style="clear:both;"></div>
      <div class="head_2">Professional Details</div>
      <p class="smalltext"><img src="ccmobile/images/privacy-lock.png" width="9" height="10" alt="lock"> Your Information is secure with us and will not be shared without your consent</p>
      <select name="Qualification" id="Qualification" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('QualificationVal');">
        <option value="">Select Qualification</option>
		<option value="20">Architect</option>
		<option value="24">CA</option>
		<option value="9">Diploma</option>
		<option value="25">Doctor</option>
		<option value="26">Engineer</option>
        <option value="10">Graduate</option>
		<option value="13">Graduate</option>
        <option value="15">Professional</option>
        <option value="27">MBA/MMS</option>
        <option value="19">Others</option>
      </select>
      <div style="clear:both;"></div>
      <div id="QualificationVal"></div>
      <div style="clear:both;"></div>
		<select name="Designation" id="Designation" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('DesignationVal');">
        <option value="">Select Designation</option>
		<option value="10">Non Management</option>
		<option value="20">Junior Management</option>
		<option value="30">Middle Management</option>
		<option value="40">Senior Management</option>
		<option value="50">Other</option>
      </select>
      <div style="clear:both;"></div>
      <div id="DesignationVal"></div>
        <div style="clear:both;"></div>
      Office Landline
      <div style="clear:both; height:10px;"></div>
      <div class="annual-income-ui-input-wrapper">
        <select name="Land_linenumber" id="Land_linenumber" class="mobile-ui-input landline-icon input-bottom-margin" onchange="validateDiv('Land_linenumberVal');">
          <option value="">Select Landline</option>
          <option value="Office" selected>Office</option>
          </select>
        <div style="clear:both;"></div>
        <div id="Land_linenumberVal"></div>
      </div>
      <div class="annual-income-ui-input-wrapper  margin-a-left">
        <div class="mobile-ui-input landline-icon input-bottom-margin">
          <div class="stdlandlinewrapper">
            <input name="STD" type="text" class="stdtext" placeholder="STD" onkeydown="validateDiv('STDVal');" maxlength="6" onKeyPress="return numOnly(event);">
            <input name="Phone_Number" type="text" class="stdnumbertext " placeholder="Number"  onkeydown="validateDiv('Land_linenumberVal2');" onKeyPress="return numOnly(event);" maxlength="8">
            <div id="STDVal"></div>
            <div style="clear:both;"></div>
            <div id="Land_linenumberVal2"></div>
          </div>
          <div style="clear:both;"></div>
        </div>
      </div>
       </span>
       <div style="clear:both;"></div>
		Select Your Card<div style="clear:both; height:10px;"></div>
        <select name="card_id" id="card_id" class="mobile-ui-input location-icon input-bottom-margin" >
          <option value="">Select Your Card</option>
        <?php 
		$getcitySql = " SELECT * FROM `credit_card_banks_eligibility` WHERE `cc_bank_name` like '%standard%' and `cc_bank_flag`=1";
		list($numRowscity,$getcityQuery)=MainselectfuncNew($getcitySql,$array = array());
		for($cN=0;$cN<$numRowscity;$cN++)
		{
		$ccbankid = $getcityQuery[$cN]['cc_bankid'];
		$cc_bank_name =ucwords(strtolower($getcityQuery[$cN]['cc_bank_name']));
		?>
			<option value="<?php echo $ccbankid; ?>" <? if($cityalias==$City) echo "selected";?>><?php echo $cc_bank_name;  ?></option>
		<?php
		}
		?>
        </select>
        <div style="clear:both;"></div>
      <div style="clear:both;"></div>
      Any relation with Standard Chartered Bank?      <div style="clear:both; height:10px;"></div>
	  <select name="relation_with_bank" id="relation_with_bank" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('relationwithbankVal');">
        <option value="">Please select</option>
		 <option value="0">No Relation</option>
		<option value="2">Savings Account</option>
		<option value="5">Current Account (Personal)</option>
		<option value="11">Current Account (Business)</option>
		<option value="13">Term Deposit</option>
		<option value="14">Credit Card</option>
		<option value="18">Personal Loan</option>
		<option value="20">Home Loan</option>
		<option value="26">Business Loan</option>
      </select>
      <div style="clear:both;"></div>
      <div id="relationwithbankVal"></div>
        <div style="clear:both;"></div>
      </span>
      <div class="app-counting bg-success"><span class="app-wow">Wow!</span> You are almost done</div>
      <div style="clear:both; margin-top:15px;"></div>
      <button class="submit-btn" type="submit">Instant Online Approval</button>
    </form>
  </div>
  <div style="clear:both; margin-top:15px;"></div>
</div>
</body>
</html>
