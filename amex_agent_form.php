<?php
require 'scripts/functions.php';
require 'scripts/db_init.php';

//error_reporting(E_ALL);
//ini_set('display_errors',1);

$custid = $_REQUEST["cust_id"];

$getInitialDetailsSql = "select * from Req_Credit_Card_Sms where RequestID = '".$custid."'";
$getInitialDetailsQuery = d4l_ExecQuery($getInitialDetailsSql);

$UserID = d4l_mysql_result($getInitialDetailsQuery,0,'UserID');
$Name = d4l_mysql_result($getInitialDetailsQuery,0,'Name');
$Mobile_Number = d4l_mysql_result($getInitialDetailsQuery,0,'Mobile_Number');
$City = d4l_mysql_result($getInitialDetailsQuery,0,'City');
$Net_Salary = d4l_mysql_result($getInitialDetailsQuery,0,'Net_Salary');
$source = d4l_mysql_result($getInitialDetailsQuery,0,'source');
$Employment_Status = d4l_mysql_result($getInitialDetailsQuery,0,'Employment_Status');
$Dated = d4l_mysql_result($getInitialDetailsQuery,0,'Dated');
$Updated_Date = d4l_mysql_result($getInitialDetailsQuery,0,'Updated_Date');
$DOB = d4l_mysql_result($getInitialDetailsQuery,0,'DOB');
$Company_Name = d4l_mysql_result($getInitialDetailsQuery,0,'Company_Name');
$Std_Code = d4l_mysql_result($getInitialDetailsQuery,0,'Std_Code');
$Landline = d4l_mysql_result($getInitialDetailsQuery,0,'Landline');
$Email = d4l_mysql_result($getInitialDetailsQuery,0,'Email');
$Gender = d4l_mysql_result($getInitialDetailsQuery,0,'Gender');

$Residence_Address = d4l_mysql_result($getInitialDetailsQuery,0,'Residence_Address');
$State = d4l_mysql_result($getInitialDetailsQuery,0,'State');
$Office_Address = d4l_mysql_result($getInitialDetailsQuery,0,'Office_Address');
$Pancard = d4l_mysql_result($getInitialDetailsQuery,0,'Pancard');
$Pincode = d4l_mysql_result($getInitialDetailsQuery,0,'Pincode');
$Email = d4l_mysql_result($getInitialDetailsQuery,0,'Email');
$City_Other = d4l_mysql_result($getInitialDetailsQuery,0,'City_Other');
$CC_Holder = d4l_mysql_result($getInitialDetailsQuery,0,'CC_Holder');
$IsPublic = d4l_mysql_result($getInitialDetailsQuery,0,'IsPublic');
$IP_Address = d4l_mysql_result($getInitialDetailsQuery,0,'IP_Address');
$Pancard = d4l_mysql_result($getInitialDetailsQuery,0,'Pancard');
$applied_card_name = d4l_mysql_result($getInitialDetailsQuery,0,'applied_card_name');
$Pancard = d4l_mysql_result($getInitialDetailsQuery,0,'Pancard');
$Privacy = 1;

if($UserID>0)
{
	//Update
	$insertMainTableSql = "update Req_Credit_Card set Name= '".$Name."', Mobile_Number= '".$Mobile_Number."', City= '".$City."', Net_Salary= '".$Net_Salary."', Employment_Status= '".$Employment_Status."', Dated= '".$Dated."', DOB= '".$DOB."', Company_Name= '".$Company_Name."', Std_Code= '".$Std_Code."', Landline= '".$Landline."', Email= '".$Email."', Gender= '".$Gender."', Residence_Address= '".$Residence_Address."', State= '".$State."', Office_Address= '".$Office_Address."', Pancard= '".$Pancard."', Pincode= '".$Pincode."', City_Other= '".$City_Other."', CC_Holder= '".$CC_Holder."', IsPublic= '".$IsPublic."' where RequestID = '".$UserID."'";
	$updateQuery = d4l_ExecQuery($insertMainTableSql);	
	$RequestID = $UserID;
}
else
{
	//Insert
	$insertMainTableSql = "insert into Req_Credit_Card (Name, Mobile_Number, City, Net_Salary, source, Employment_Status, Dated, Updated_Date, DOB, Company_Name, Std_Code, Landline, Email, Gender, Residence_Address, State, Office_Address, Pancard, Pincode, City_Other, CC_Holder, IsPublic, IP_Address, applied_card_name, Privacy) VALUES ('".$Name."' , '".$Mobile_Number."' , '".$City."' , '".$Net_Salary."' , '".$source."' , '".$Employment_Status."' , '".$Dated."' , '".$Updated_Date."' , '".$DOB."' , '".$Company_Name."' , '".$Std_Code."' , '".$Landline."' , '".$Email."' , '".$Gender."' , '".$Residence_Address."' , '".$State."' , '".$Office_Address."' , '".$Pancard."' , '".$Pincode."' , '".$City_Other."' , '".$CC_Holder."' , '".$IsPublic."' , '".$IP_Address."' , '".$applied_card_name."' , '".$Privacy."') ";

	$insertMainTableQuery = d4l_ExecQuery($insertMainTableSql);
	$RequestID = d4l_mysql_insert_id();
	$updateSql = "update Req_Credit_Card_Sms set UserID='".$RequestID."' where RequestID = '".$custid."'";
	$updateQuery = d4l_ExecQuery($updateSql);
}

$slct="select applied_card_name,Name,DOB,City from Req_Credit_Card Where (RequestID='".$RequestID."')";
list($Getnum,$row)=Mainselectfunc($slct,$array = array());

$Name = $row['Name'];
$City = $row['City'];
$DOB = date("d/m/Y", strtotime($row['DOB']));
list($first,$middle,$last) = split('[ ]',$Name);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instant E Apply Credit Cards Online in India</title>
<meta name="keywords" content="online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application" />
<meta name="description" content="Fill Application form for credit cards. Instant Apply & get Approval for Credit cards such as HDFC, ICICI, Citibank, Standard Chartered, SBI and American express Online in India." />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="http://www.deal4loans.com/ccmobile/css/creditcard-lp-mobile-ui-new.css" type="text/css" rel="stylesheet">
<link href="http://www.deal4loans.com/css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="http://www.deal4loans.com/ccmobile/css/font-awesome.css" type="text/css" rel="stylesheet" >
<link rel="stylesheet" href="http://www.deal4loans.com/ccmobile/css/cc-bootstrap.css" type="text/css">
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

</style>
<script type="text/javascript">

	function Checkvalidateccstep2frm(Form)
	{
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
		if((Form.last_name.value.length <= 2))
		{
			document.getElementById('LastnameVal').innerHTML = "<span  class='hintanchor'>Last Name should be greater than 2 chars</span>";
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
			document.getElementById('pannoVal').innerHTML = "<span  class='hintanchor'>Please Enter Pan number</span>";
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

		if (Form.City.value=="")
		{
			document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Please Select your Residence City!</span>";
			Form.City.focus();
			return false;
		}

		if (Form.pincode.value=="")
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Please Enter Pincode!</span>";
			Form.pincode.focus();
			return false;
		}
		if((Form.pincode.value.length != 6))
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Pincode should be equal to 6  chars</span>";
			Form.pincode.focus();
			return false;
		}

		if (Form.Qualification.value == "")
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
		if (!re.test(txt))
		{
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
			document.getElementById('OfficePinVal').innerHTML = "<span  class='hintanchor'>Please enter Office Pincode!</span>";
			Form.OfficePin.focus();
			return false;
		}
		if((Form.OfficePin.value.length != 6))
		{
			document.getElementById('OfficePinVal').innerHTML = "<span  class='hintanchor'>Pincode should be equal to 6  chars</span>";
			Form.OfficePin.focus();
			return false;
		}
		
		if (Form.Phone_Number.value=="")
		{
			document.getElementById('PhoneNumberVal').innerHTML = "<span  class='hintanchor'>Please enter Landline Number!</span>";
			Form.Phone_Number.focus();
			return false;
		}
		
		if (Form.Phone_Number.value.length != 11)
		{
			document.getElementById('PhoneNumberVal').innerHTML = "<span  class='hintanchor'>Landline Number should be equal to 11 chars!</span>";
			Form.Phone_Number.focus();
			return false;
		}

		if (Form.BillingPrefernce.value=="")
		{
			document.getElementById('BillingPrefernceVal').innerHTML = "<span  class='hintanchor'>Select Billing Preference!</span>";
			Form.BillingPrefernce.focus();
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

	function validateDiv(div)
	{
		var ni1 = document.getElementById(div);
		ni1.innerHTML = '';
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
<div style="clear:both; height:70px;"></div>
<div class="mobile-main-wrapper">
  <div class="mobile-form-left">
    <div class="head_2 heading-margin-bottom">Confirm Details as per PAN Card</div>
    <div class="product-listing-new"> </div>
    <div style="clear:both;"></div>
    <form method="post" name="ccstep2frm" id="ccstep2frm" action="amex_agent_form_thankyou.php"  onSubmit="return Checkvalidateccstep2frm(document.ccstep2frm); ">
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
              <input type="radio" name="Gender" id="radio-one" value="Male" <?php if($Gender=="Male")  {echo 'checked="checked"';} ?>  onclick="return ShowCityField(event)"/>
              <i></i> <span>Male</span> </label>
            <label for="radio-two">
              <input type="radio" name="Gender" id="radio-two" value="Female" <?php if($Gender=="Female")  {echo 'checked="checked"';} ?> onclick="return ShowCityField(event)"/>
              <i></i> <span>Female</span> </label>
          </div>
        </div>
      </div>
      <div style="clear:both;"></div>
      <span id="ShowCityAddr">
      <input name="resiaddress1" id="resiaddress1" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="Complete Residential address" onkeydown="validateDiv('resiaddressVal');"  maxlength="120"  value="<?php echo $Residence_Address = str_ireplace('|','',$Residence_Address); ?>">
      <div style="clear:both;"></div>
      <div id="resiaddressVal"></div>
      <div style="clear:both;"></div>
      <div class="annual-income-ui-input-wrapper">
        <select name="City" id="City" class="mobile-ui-input location-icon input-bottom-margin" onchange="showPinCode(this.value);  validateDiv('cityVal');" >
			<option value="">Select Your Residence City</option>
        <?php 
		$getcitySql = "select City from Bidders_List where BidderID = 5596";
		list($numRowscity,$getcityQuery)=MainselectfuncNew($getcitySql,$array = array());
		$getCityArr = explode(",", $getcityQuery[0]['City']);
		foreach($getCityArr as $key=>$val)
		{
			$cityname = ucwords(strtolower($val));
		?>
			<option value="<?php echo $cityname; ?>" <? if($cityname==$City) echo "selected";?>><?php echo $cityname; ?></option>
		<?php
		}
		?>
        </select>
        <div style="clear:both;"></div>
        <div id="cityVal"></div>
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <input name="pincode" id="pincode" type="text"  class="annual-income-ui-input pancard-icon float-left" placeholder="Pincode" tabindex=3 autocomplete="off" onkeydown="showProfDetails(event); validateDiv('pincodeVal');" />
        <div style="clear:both;"></div>
        <div id="pincodeVal"></div>
      </div>
      </span>
	<div style="clear:both;"></div>
		Select Your Card<div style="clear:both; height:10px;"></div>
	<select name="card_id" id="card_id" class="mobile-ui-input location-icon input-bottom-margin" >
			<option value="">Select Your Card</option>
			<?php 
			$getcitySql = " SELECT * FROM `credit_card_banks_eligibility` WHERE `cc_bank_name` like '%American%' and `cc_bank_flag`=1";
			list($numRowscity,$getcityQuery)=MainselectfuncNew($getcitySql,$array = array());
			for($cN=0;$cN<$numRowscity;$cN++)
			{
				$ccbankid = $getcityQuery[$cN]['cc_bankid'];
				$cc_bank_name =ucwords(strtolower($getcityQuery[$cN]['cc_bank_name']));
			?>
			<option value="<?php echo $ccbankid;?>" <? if($cityalias==$City) echo "selected";?>><?php echo $cc_bank_name; ?></option>
			<?php
			}
			?>
	</select>
	<div style="clear:both;"></div>
      <div style="clear:both;"></div>
      <hr>
      <span id="ShowProfDetails">
      <div style="clear:both;"></div>
      <div class="head_2">Professional Details</div>
      <p class="smalltext"><img src="ccmobile/images/privacy-lock.png" width="9" height="10" alt="lock"> Your Information is secure with us and will not be shared without your consent</p>
	<select name="Qualification" id="Qualification" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('QualificationVal');">
        <option value="">Select Qualification</option>
		<option value="U">Under Graduate</option>
        <option value="B">Graduate / Diploma</option>
        <option value="M">Post Graduate</option>
		<option value="D">Professional</option>
        <option value="O">Others</option>
      </select>
      <div style="clear:both;"></div>
      <div id="QualificationVal"></div>
       <input name="OfficeAddress1" id="OfficeAddress1" type="text" class="mobile-ui-input input-bottom-margin location-icon" placeholder="Complete Office Address" onkeydown="validateDiv('OfficeAddressVal');"  maxlength="120" value="<?php echo $Office_Address; ?>">
      <div style="clear:both;"></div>
      <div id="OfficeAddressVal"></div>
      <div style="clear:both;"></div>
      <div class="annual-income-ui-input-wrapper">
        <select name="OfficeCity" id="OfficeCity" class="mobile-ui-input location-icon input-bottom-margin" onchange="showUser(this.value); validateDiv('OfficeCityVal');">
			<option value="">Select Your Office City</option>
		<?php 
		$getcitySql = "select City from Bidders_List where BidderID = 5596";
		list($numRowscity,$getcityQuery)=MainselectfuncNew($getcitySql,$array = array());
		$getCityArr = explode(",", $getcityQuery[0]['City']);
		foreach($getCityArr as $key=>$val)
		{
			$cityname = ucwords(strtolower($val));
		?>
			<option value="<?php echo $cityname; ?>" <? if($cityname==$City) echo "selected";?>><?php echo $cityname; ?></option>
		<?php
		}
		?>
        </select>
        <div style="clear:both;"></div>
        <div id="OfficeCityVal"></div>
        <div style="clear:both;"></div>
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
	  <input name="OfficePin" id="txtHint" type="text"  class="annual-income-ui-input pancard-icon float-left" placeholder="Pincode" tabindex=3 autocomplete="off" onkeydown="showProfDetails(event); validateDiv('OfficePinVal');" />
      	<div style="clear:both;"></div>
	<div id="OfficePinVal"></div>
      </div>
      <div style="clear:both;"></div>
      Residence Landline Number with StdCode
      <div style="clear:both; height:10px;"></div>
      <div class="annual-income-ui-input-wrapper">
        <div class="mobile-ui-input landline-icon input-bottom-margin">
          <div class="stdlandlinewrapper">
           <input name="Phone_Number" type="text" class="stdnumbertext " placeholder="Number"  onkeydown="validateDiv('PhoneNumberVal');" onKeyPress="return numOnly(event);" maxlength="11">
            <div id="STDVal"></div>
            <div style="clear:both;"></div>
            <div id="PhoneNumberVal"></div>
          </div>
          <div style="clear:both;"></div>
        </div>
      </div>
	<select name="BillingPrefernce" id="BillingPrefernce" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('BillingPrefernceVal');">
        <option value="">Select Billing Preference</option>
		<option  value="0">Beginning of the Month</option>
        <option value="5">Middle of the Month</option>
        <option value="9">End of the Month</option>
      </select>
      <div style="clear:both;"></div>
      <div id="BillingPrefernceVal"></div>
      </span>
      <div style="clear:both;"></div>
      </span>
      <!--<div class="app-counting bg-success"><span class="app-wow">Wow!</span> You are almost done</div>-->
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
