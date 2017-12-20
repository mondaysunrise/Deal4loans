<?php
require 'scripts/functionshttps.php';
require 'scripts/db_init.php';
//print_R($_REQUEST);
$cc_bankid = $_REQUEST["cc_bankid"];
$RequestID = $_REQUEST["RequestID"];
$cc_name = $_REQUEST["cc_name"];
$insertID = $_REQUEST["insertID"];

if((strlen(trim($cc_name))>0) && $cc_bankid >1)
{
	$slct="select applied_card_name,Name,DOB,City,Company_Name from Req_Credit_Card Where (RequestID='".$RequestID."')";
	$row=mysql_fetch_array($slct);
	list($Getnum,$row)=Mainselectfunc($slct,$array = array());
	$Name = $row['Name'];
	list($first,$middle,$last) = split('[ ]',$Name);
	$Company_Name=$row['Company_Name'];
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
<link href="https://www.deal4loans.com/ccmobile/css/creditcard-lp-mobile-ui-new.css" type="text/css" rel="stylesheet">
<link href="https://www.deal4loans.com/css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" /> 
<link href="https://www.deal4loans.com/ccmobile/css/font-awesome.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://www.deal4loans.com/ccmobile/css/cc-bootstrap.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="application/javascript" src="https://www.deal4loans.com/ccmobile/js/validate.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-sbicclist.js"></script>
<script Language="JavaScript" Type="text/javascript" src="https://www.deal4loans.com/scripts/common.js"></script>
<style type="text/css">
.hintanchor {
	color: #CC0000;
	
}
#show{ color:#06C; cursor:pointer;}
.term_text{ font-size:12px;}
.tc-show{ margin-top:10px; margin-bottom:10px; font-size:12px; border:thin solid #CCC; padding:10px; height:250px; overflow-x: hidden; background:#FFF; border-radius:5px;}
.cross{font-size:12px; line-height:22px; width:20px; margin-bottom:5px; height:20px; float:right; cursor:pointer; text-align:center; background:red; border-radius:50px; color: #FFF;}
</style>
<script type="text/javascript">

function Checkvalidateccstep2frm(Form)
{
	var j;
	var l;
	var r;
	var k;
	var m;
	var cnt=-1;
	var dt,mdate;dt=new Date();

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

	if((Form.panno.value==""))
	{
        document.getElementById('pannoVal').innerHTML = "<span  class='hintanchor'>Please Enter Pan Card Number</span>";		
		Form.panno.focus();
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

	if(Form.flatno.value == '') {
		document.getElementById('flatnoVal').innerHTML = "<span  class='hintanchor'>Please fill Flat No.</span>";		
		Form.flatno.focus();
		return false;
	}

	if (Form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Please Select your Residence City!</span>";
		Form.City.focus();
		return false;
	}
	if (Form.State.selectedIndex==0)
	{
		document.getElementById('stateVal').innerHTML = "<span  class='hintanchor'>Please Select State!</span>";
		Form.State.focus();
		return false;
	}

	if (Form.pincode.selectedIndex==0)
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Please fill Pincode!</span>";
		Form.pincode.focus();
		return false;
	}
	if(Form.mobile_code.value == '') {
		document.getElementById('mobile_codeVal').innerHTML = "<span  class='hintanchor'>Please fill Mobile Code.</span>";		
		Form.mobile_code.focus();
		return false;
	}

	if(!document.ccstep2frm.accept.checked)
	{
		document.getElementById('acceptRVal').innerHTML = "<span class='hintanchorqa'>Accept the Terms and Condition!</span>";	
		document.ccstep2frm.accept.focus();
		return false;
	}
	if(!document.ccstep2frm.accept_exp.checked)
	{
		document.getElementById('acceptExpVal').innerHTML = "<span class='hintanchorqa'>Accept  Terms and Condition!</span>";	
		document.ccstep2frm.accept_exp.focus();
		return false;
	}
}

function declineFunction()
{
	document.getElementById('declineVal').innerHTML = "<span  class='hintanchor'>By Declining the Terms And Conditions, we shall not be able to process your application with Yes Bank. You can still explore other <a href='http://www.deal4loans.com/credit-card-continue_UAT.php?rqid=<?php echo $RequestID; ?>'>credit card options</a>.</span>";	
	return false;
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

.mobileanchor {
    font-size: 10px;
    font-weight: bold;
    color: #0000FF;
}
.credit_card_exp .annual-income-ui-input-wrapper{ width:47%;}

	.credit_card_exp-wrapper {width:1000px;
    background: #FFF;
    border-radius: 10px;
	margin:auto;
    border: #dcdcdc solid thin;
    padding: 15px 15px 25px 15px;}
	.consent-wrapper-new {
    width:400px;
    margin: 10px auto;
}

.accept-box{width: 150px;
    padding:5px 5px 5px 5px;
    background: none;
    color: #097de4;
    line-height:30px;
    border-radius: 5px;
    border: solid thin #097de4;
    margin-right: 5px;
    float: left;}
	
	label {
    display: inline-block;
    max-width: 100%;
    /* margin-bottom: 5px; */
    font-weight: 700;
}
.accept-box label {
    display: block;
    position: relative;
    float: left;
    padding: 0.3rem 1rem;
	margin-bottom:0px;
    font-weight: normal;
    cursor: pointer;
    -webkit-tap-highlight-color: transparent;
}
.mobile-verification .annual-income-ui-input-wrapper{width:85% !important; float: left;}

.tooltip_d4l {
    position: relative;
    display: inline-block;
    margin-left: 7px;
    cursor: pointer;
    width: 16px;
    height: 16px;
    text-align: center;
    font-size: 12px;
    border-radius: 50px;
    background: #f5f5f5;
    border: solid 1px #ececec;
    color: #cacaca;
}

.tooltip_d4l .tooltiptext {
    visibility: hidden;
    color:#000;
	width:250px;
    text-align: center;
    padding:5px;
	background:#FFF;
    border-radius: 6px;
	border:#CCC solid thin;
    position: absolute;
    z-index: 1;
}
.tooltip_d4l:hover .tooltiptext {
    visibility: visible;
}

.verification-main-box{ width:50%; margin:auto;}

 
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div style="clear:both; height:70px;"></div>

<div class="bank-logos">Yes Bank Credit Card</div>
<div class="bank-text">Get Instant Online Approval for <? echo $cc_name; ?>.<br />
</div>
<div class="card-image"><img src="/<? echo $ccrow["card_image"]; ?>" border="0" /></div> 
<div class="clearfix"></div>
<?php
$cc_bankid = $_REQUEST["cc_bankid"];
$RequestID = $_REQUEST["RequestID"];
$cc_name = $_REQUEST["cc_name"];
$Name = $row['Name'];
$City = $row['City'];
$Pincode = $row['Pincode'];
$DOB = date("d/m/Y", strtotime($row['DOB']));
list($first,$middle,$last) = split('[ ]',$Name);
?>
<style type="text/css">
.full-width-box{ width:100%;}
.highlight-box{padding:0px; font-size: 11.5px; margin-bottom: 10px;}
.check-labled-text{font-weight: normal; line-height: 18PX;}
.consent-wrapper{ width:300px; margin:10px auto;}
.accept_btn{ display:inline; width:135px; padding:12px 5px 12px 5px; background:#097de4; color:#FFF; text-align:center; border-radius:5px; border:none;}
.decline_btn{ display:inline; width:135px; padding:12px 5px 12px 5px; background:#FFF; color:#f8472a; text-align:center; border-radius:5px; border:#f8472a solid thin;}
.credit-score-text{ font-size:1rem; color:#117ed2;}
.nomargin_btm{ margin-bottom:3px !important;}
</style>
<div class="mobile-main-wrapper">
  <div class="mobile-form-left">
  <div class="credit_card_exp">
    <div class="head_2 heading-margin-bottom">Confirm Details as per PAN Card</div>
    <div class="product-listing-new"> </div>
    <div style="clear:both;"></div>
    <form method="post" name="ccstep2frm" id="ccstep2frm" action="https://www.deal4loans.com/yes-credit-card-thankyou.php"  onSubmit="return Checkvalidateccstep2frm(document.ccstep2frm); ">
      <input type="hidden" name="requestID" id="requestID" value="<? echo $RequestID; ?>" />
      <input type="hidden" name="card_name" id="card_name" value="<? echo $cc_name; ?>" />
      <input type="hidden" name="card_id" id="card_id" value="<? echo $cc_bankid; ?>" />
	  <input type="hidden" name="insertID" id="insertID" value="<? echo $insertID; ?>" />
      <div class="pancardbox">
        <div class="pan-form">
          <div class="pan-name">
            <div class="nametextpan">First Name</div>
            <input name="first_name" id="first_name" type="text" class="pan-inputname" value="<?php if($first) {echo $first; } else {echo 'First Name';}?>" onFocus="if(this.value=='First Name')this.value=''" onBlur="if(this.value=='')this.value='First Name'" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('FirstnameVal');" maxlength="26">
            <div style="clear:both; height:15px;"></div>
            <div id="FirstnameVal"></div>
          </div>
          <div class="pan-name margin-a-left">
            <div class="nametextpan">Middle Name</div>
            <input name="middle_name" id="middle_name" type="text" class="pan-inputname"  value="<?php if(strlen($middle)>0 && strlen($last)>0) { echo $middle;} else {echo ''; }?>" onFocus="if(this.value=='Middle Name')this.value=''" onBlur="if(this.value=='')this.value=''" onKeyPress="return isCharsetKey(event);"  maxlength="26" />
          </div>
          <div class="pan-name margin-a-left">
            <div class="nametextpan">Last Name</div>
            <input name="last_name" id="last_name" type="text" class="pan-inputname" value="<?php if(strlen($last)>0) { echo $last;} elseif(strlen($middle)>0 && $last==""){ echo $middle;} else {echo 'Last Name';}?>" onFocus="if(this.value=='Last Name')this.value=''" onBlur="if(this.value=='')this.value='Last Name'" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('LastnameVal');"  maxlength="26" />
            <div style="clear:both; height:15px;"></div>
            <div id="LastnameVal"></div>
          </div>
          <div class="clearfix"></div>
          <div class="pan-name">
            <input name="DOB" id="DOB" type="text" class="pan-inputname" value="<?php if($DOB) {echo $DOB; } else {echo 'DD/MM/YYYY';}?>"  onFocus="if(this.value=='DD/MM/YYYY')this.value=''" onBlur="if(this.value=='')this.value='DD/MM/YYYY'" onkeydown="validateDiv('DOBVal');"  />
            <div style="clear:both;"></div>
            <div id="DOBVal"></div>
          </div>
          <div style="clear:both;"></div>
          <br />
          <div class="account-no">Permanent Account Number</div>
          <div style="clear:both; height:5px;"></div>
          <div class="pannumberdigit" style="background:#FFF; opacity:0.5;">
            <input  name="panno" id="panno" type="text" class="pan-inputname" placeholder="BOUPR9012L" onkeydown="validateDiv('pannoVal');" style="border:none; width:100%;"   maxlength="10" />
            <div style="clear:both;"></div>
            <div id="pannoVal"></div>
          </div>
        </div>
      </div>
	    <div style="clear:both;"></div>
        <div class="gender-box" id="ShowGender" > <strong>Gender</strong>
          <div class="form-required">
            <label for="radio-one">
              <input type="radio" name="Gender" id="radio-one" value="Male" onclick="return ShowCityField(event)"/>
              <i></i> <span>Male</span> </label>
            <label for="radio-two">
              <input type="radio" name="Gender" id="radio-two" value="Female" onclick="return ShowCityField(event)"/>
              <i></i> <span>Female</span> </label>
          </div>
		  <div style="clear:both;"></div>
		   <div id="genderVal"></div>
        </div>
           <div style="clear:both;"></div>
       <div class="annual-income-ui-input-wrapper margin-a-left">
      <input name="flatno" id="flatno" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="Flat No" onkeydown="validateDiv('flatnoVal');"  maxlength="40" >
      <div id="flatnoVal"></div>
      </div>
   <div class="annual-income-ui-input-wrapper margin-a-left">
      <input name="buildingName" id="buildingName" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="Building Name" onkeydown="validateDiv('buildingNameVal');"  maxlength="40" ></div>
      <div style="clear:both;"></div>
      <div id="buildingNameVal"></div>
      <div style="clear:both;"></div>
       <div class="annual-income-ui-input-wrapper margin-a-left">
      <input name="road" id="road" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="road" onkeydown="validateDiv('roadVal');"  maxlength="40" ></div>
      <div id="roadVal"></div>
	<div class="annual-income-ui-input-wrapper margin-a-left">
        <select name="City" id="City" class="mobile-ui-input location-icon input-bottom-margin">
          <option value="">Please Select</option>
			<?php
			$getYesCitySql = "SELECT GROUP_CONCAT(City) As City FROM Bidders_List WHERE Bidder_Name LIKE '%Yes Bank%' AND Reply_Type=4";
			list($citynumrows,$CityArr)=MainselectfuncNew($getYesCitySql,$array = array());
			$CityArrNew = explode(',', $CityArr[0]['City']);
			foreach($CityArrNew as $key=>$cityval)
			{
				//Check if pincode exists for city
				$getYesCityPinSql = "SELECT * FROM yes_cc_city_state_list WHERE city = '".$cityval."'";
				list($citypinrows,$CityPinArr)=MainselectfuncNew($getYesCityPinSql,$array = array());
				if($citypinrows){
			?>
				<option value="<?php echo $cityval; ?>" <?php if($cityval==$City) { echo "selected"; }?>><?php echo $cityval; ?></option>
			<?php
				}
			}
			?>
       </select>
        <div style="clear:both;"></div>
        <div id="cityVal"></div>
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
		<select size="1" name="State" id="State"  class="mobile-ui-input location-icon input-bottom-margin"  onchange="validateDiv('stateVal');">
			<option value="">Please Select</option>
		<?php	
		$stateArr = array(1=>'JAMMU and KASHMIR', 2=>'HIMACHAL PRADESH', 3=>'PUNJAB',4=>'CHANDIGARH', 5=>'UTTRANCHAL', 6=>'HARAYANA', 7=>'DELHI', 8=>'RAJASTHAN', 9=>'UTTAR PRADESH', 10=>'BIHAR', 11=>'SIKKIM', 12=>'ARUNACHAL PRADESH', 13=>'NAGALAND', 14=>'MANIPUR', 15=>'MIZORAM', 16=>'TRIPURA', 17=>'MEGHALAYA', 18=>'ASSAM', 19=>'WEST BENGAL', 20=>'JHARKHAND', 21=>'ORRISA', 22=>'CHHATTISGARH', 23=>'MADHYA PRADESH', 24=>'GUJRAT', 25=>'DAMAN and DIU', 26=>'DADARA and NAGAR HAVELI', 27=>'MAHARASHTRA', 28=>'ANDHRA PRADESH', 29=>'KARNATAKA', 30=>'GOA', 31=>'LAKSHADWEEP', 32=>'KERALA', 33=>'TAMIL NADU ', 34=>'PONDICHERRY', 35=>'ANDAMAN and NICOBAR ISLANDS', 36=>'TELANGANA');
$selected = "";
for($i=1;$i<=count($stateArr);$i++)
{
	$selected = "";
	$stateValue = str_pad($i, 2, '0', STR_PAD_LEFT); 	
	if($i==27) { $selected = "selected";}
	
	echo "<option value='".$stateValue."' ".$selected." >".$stateArr[$i]."</option>";
	
}
/*		$getStateSql = "SELECT state FROM yes_cc_city_state_list GROUP BY state ORDER BY state ASC";
		list($statenumrows,$statelist)=MainselectfuncNew($getStateSql,$array = array());
		foreach($statelist as $key=>$stateval)
		{
*/	
	?>
		<!--	<option value="<?php //echo $stateval['state']; ?>" <? //if($stateval['state']==$State) {echo "selected";} ?> ><?php //echo $stateval['state']; ?></option>   -->
		<?php
	//	}
		?>
		</select>
        <div id="stateVal"></div>
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <select size="1" name="pincode" id="pincode" class="mobile-ui-input location-icon input-bottom-margin" onchange="validateDiv('pincodeVal');">
			<?
			$getPinSql = "SELECT pincode FROM yes_cc_city_state_list WHERE city = '".$City."' ORDER BY pincode ASC";
			list($pincodenumrows,$pincodelist)=MainselectfuncNew($getPinSql,$array = array());
			foreach($pincodelist as $key=>$pinval)
			{
			?>
				<option value="<?php echo $pinval['pincode']; ?>" <? if($pinval['pincode']==$Pincode) {echo "selected";} ?> ><?php echo $pinval['pincode']; ?></option>   
			<?php
			}
			?>
			<option value="">Select City first</option>
		</select>
		<div style="clear:both;"></div>
		<div id="pincodeVal"></div>
      </div>
	<div style="clear:both;"></div>	  
	</div>
	<div style="clear:both;"></div>
	<div id="acceptRVal"></div>
</div>			  
<div style="clear:both; margin-top:5px;"></div>
  </div>
  <div style="clear:both; margin-top:10px;"></div>
</div>
</div>
<div class="credit_card_exp-wrapper mobile-verification">
<div class="verification-main-box">
<div class="annual-income-ui-input-wrapper margin-a-left"><input name="mobile_code" id="mobile_code" type="text" class="annual-income-ui-input nomargin_btm pancard-icon float-left" placeholder="Mobile Verification Code" onkeydown="validateDiv('mobile_codeVal');" maxlength="5">
<div id="mobile_codeVal"></div>
</div>
<div class="tooltip_d4l">?
  <span class="tooltiptext">This is required  to fetch your Experian Credit  score for processing your credit card application</span>
</div>
</div>
<div style="clear:both; padding-bottom:5px;"></div>
<div><label for="check" class="check-labled-text">
<input type="checkbox" name="accept" id="accept" value="1" checked=""><i></i>  </label>
YOU HEREBY APPOINT DEAL4LOANS AS YOUR AUTHORISED REPRESENTATIVE TO RECEIVE YOUR CREDIT INFORMATION FROM EXPERIAN. YOU HEREBY UNCONDITIONALLY CONSENT TO SUCH CREDIT INFORMATION BEING PROVIDED BY EXPERIAN AT YOUR REGISTERED EMAIL ID AND ALSO THROUGH YOUR DEAL4LOANS ACCOUNT AS PER YOUR INDEPENDENT REGISTRATION WITH DEAL4LOANS SUBJECT TO <span id="show">TERMS AND CONDITIONS</span>.</div>
<div class="tc-show" style="display:none;">
<div class="cross" id="hide">X</div>
<p>This End User Agreement (the "Agreement") is made between you (the "User" or "You") and   ("MMPL "), a private limited company .MMPL " "Us" or "We", which term shall include its successors and permitted assigns). The User and MMPL shall be collectively referred to as the "Parties" and individually as a "Party"</p>
<p>YOU HEREBY APPOINT MMPL AS YOUR AUTHORISED REPRESENTATIVE TO RECEIVE YOUR CREDIT INFORMATION FROM EXPERIAN.</p>
<p>BY EXECUTING THIS AGREEMENT 1 CONSENT FORM, YOU ARE EXPRESSLY AGREEING TO ACCESS THE EXPERIAN CREDIT INFORMATION REPORT AND CREDIT SCORE, AGGREGATE SCORES, INFERENCES, REFERENCES AND DETAILS (AS DEFINED REFERRED AS "CREDIT INFORMATION"). YOU HEREBY ALSO IRREVOCABLY AND UNCONDITIONALLY CONSENT TO SUCH CREDIT INFORMATION BEING PROVIDED BY EXPERIAN TO you AND MMPL BY USING EXPERIAN TOOLS, ALGORITHMS AND DEVICES AND YOU HEREBY AGREE, ACKNOWLEDGE AND ACCEPT THE TERMS AND CONDITIONS SET FORTH HEREIN.</p>
<p style="text-decoration:underline;">Terms and Conditions:</p>
<p>Information Collection, Use, Confidentiality, No-Disclosure and Data Purging</p>
<p>MMPL shall access your Credit Information as your authorized representative and MMPL shall use the Credit Information for limited end use purpose consisting of and in relation to the services proposed to be availed by you from MMPL. We shall not aggregate, retain, store, copy, reproduce, republish, upload, post, transmit, sell or rent the Credit Information to any other person and the same cannot be copied or reproduced other than as agreed herein.</p>
<p>The Parties agree to protect and keep confidential the Credit Information both online and offline. The Credit Information shared by you, or received on by us on your behalf shall be destroyed, purged, erased promptly upon the completion of the transaction for which the Credit Information report was procured.</p>
<p>Governing Law and Jurisdiction</p>
<p>The relationship between you and MMPL shall be governed by laws of India and all claims or disputes arising there from shall be subject to the exclusive jurisdiction of the courts of Mumbai.</p>
<p>Definitions:</p>
<p>Capitalised terms used herein but not defined above shall have the following meanings:</p>
<p>"Business Day" means a day (other than a public holiday) on which banks are open for general business in Mumbai.</p>
<p>"Credit Information Report" means the credit information / scores/ aggregates I variables / inferences or reports which shall be generated by Experian;</p>
<p>Credit Score" means the score which shall be mentioned on the Credit Information Report which shall be computed by Experian.</p>
<p>"CICRA" shall mean the Credit Information Companies (Regulation) Act, 2005 read with the Credit Information Companies Rules, 2006 and the Credit Information Companies Regulations, 2006, and shall include any other rules and regulations prescribed thereunder.</p>
<p>PLEASE READ THE ABOVEMENTIONED IMPORTANT INFORMATION AND CLICK ON "ACCEPT" FOLLOWED BY THE LINK BELOW TO COMPLETE THE AUTHORISATION PROCESS FOR SHARING OF YOUR CREDIT INFORMATION BY EXPERIAN WITH YOU AND MMPL , IN ITS CAPACITY AS YOUR AUTHORISED REPRESENTATIVE.</p>
<p>BY CLICKING "ACCEPT" YOU AGREE AND ACCEPT THE DISCLAIMERS AND TERMS AND CONDITIONS SET OUT HEREIN.</p>
</div>
<div style="clear:both;"></div>
<div class="consent-wrapper">
	 <div class="accept-box"> <label for="accept_exp" class="check-labled-text">
<input type="checkbox" name="accept_exp" id="accept_exp" value="1" checked><i></i>  </label> Accept</div>
 <div id="acceptExpVal"></div>
 <input name="Decline" type="button" class="decline_btn" value="Decline" onclick="declineFunction();">
 <div id="declineVal"></div>
</div>
</div>
<div style="clear:both; margin-top:10px;"></div>
<div class="credit_card_exp-wrapper">
<button class="submit-btn" type="submit">Instant Online Approval</button>
</div>
 </div>
</div>
 </form>
</div>
</div>
<div style="clear:both; height:15px;"></div>
<div class="hide-top"><?php include "footer_sub_menu.php"; ?></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#show").click(function(){
		$(".tc-show").show();
	});
	$("#hide").click(function(){
		$(".tc-show").hide();
	});
});
</script>
<script>
$(document).ready(function(){
	$('#City').on('change',function(){
		validateDiv('cityVal');
		
		var city = $(this).val();
		
		$.ajax({
			type: 'POST',
			url: 'getyesbank-pincode.php',
			data: {
				city: city,
				dataType:'html',
			},
			success: function (response) {
				//console.log(response);
				$('#pincode').html(response);
			}
		});
	});
});
</script>
</body>
</html>
