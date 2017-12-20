<?php
session_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
$dated = date("Y-m-d");
$nowdated = ExactServerdate();
$ip_address=ExactCustomerIP();

$insertID = $_REQUEST['id'];
/*
$pincode = 400106;
$pan = 'BUQPT2352R';
$flatno = 'SWMARG02';
$buildingName = 'MALAD';
*/
//echo $insertID;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW" />
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
	
	
	if(Form.day.selectedIndex==0)
	{
		//alert(Form.Employment_Status.selectedIndex);
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Select Day of DOB!</span>";
		Form.day.focus();
		return false;
	}
	if(Form.month.selectedIndex==0)
	{
		//alert(Form.Employment_Status.selectedIndex);
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Select Month of DOB!</span>";
		Form.month.focus();
		return false;
	}
	if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
	{
	//	alert("Kindly enter your Year of Birth");
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Year of Birth</span>";
		Form.year.select();
		return false;
	}
	else if(!num.test(Form.year.value))
	{
	//	alert("Kindly enter your Year of Birth(numbers Only) !");
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Enter Year of Birth</span>";
		Form.year.select();
		return false;
	}	
	
	if((Form.flatno.value==''))
	{
	//	alert("Kindly fill in your Loan Amount (Numeric Only)!");
		document.getElementById('flatnoVal').innerHTML = "<span  class='hintanchor'>Enter Your Address!</span>";
		Form.flatno.focus();
		return false;
	}
	
	if(Form.city.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Select City!</span>";		
		Form.city.focus();
		return false;
	}
	
	if(Form.state.selectedIndex==0)
	{
		document.getElementById('stateVal').innerHTML = "<span  class='hintanchor'>Select State!</span>";		
		Form.state.focus();
		return false;
	}
	if((Form.pincode.value==''))
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";
		Form.pincode.focus();
		return false;
	}
	
	if((Form.pan.value==''))
	{
		document.getElementById('panVal').innerHTML = "<span  class='hintanchor'>Enter Pancard!</span>";
		Form.pan.focus();
		return false;
	}
	
	var a=Form.pan.value;
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	 	document.getElementById('pannoVal').innerHTML = "<span  class='hintanchor'>Please enter valid Pancard number</span>";	
		 Form.pan.focus();
		 return false;
	}
	
	if(Form.passport.value!='')
	{
		var regsaid = /[a-zA-Z]{2}[0-9]{7}/;
        if(regsaid.test(passport) == false)
        {
            document.getElementById("passportVal").innerHTML = "Passport is not yet valid.";
			 return false;
        }
	}
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

</script>
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
<form name="creditscore_form" action="cibil-check-continue.php" method="POST" onSubmit="return chkcreditscore(document.creditscore_form);">
<input name="insertID" id="insertID" type="hidden"  value="<?php echo $insertID; ?>" />
<input name="servertype" id="servertype" type="hidden"  value="<?php echo $servertype; ?>" />
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
     <tr>    <td height="45" class="form_text">DOB</td>    <td  class="alert_msg">

     <select name="day" id="day" class="month"  onChange="validateDiv('dobVal');" tabindex="4" >
     <option value="">DAY</option>
     <?php
		 $selected = "";
	 for($i=1;$i<=31;$i++)
	 {
		 $selected = "";
		 $day = str_pad($i, 2, '0', STR_PAD_LEFT); 
		// if($i==30) { $selected = "selected";}
//		 if($i==27) { $selected = "selected";}
		 if($i==25) { $selected = "selected";}		 
		 echo "<option value='".$day."' ".$selected.">".$day."</option>";
	 }
	 ?>
     </select>
     <select name="month" id="month" class="month"  onChange="validateDiv('dobVal');" tabindex="5" >
     <option value="">MONTH</option>

     <?php 
	 $monthArr = array("1"=>"Jan", "2"=>"Feb", "3"=>"Mar", "4"=>"Apr", "5"=>"May", "6"=>"Jun", "7"=>"Jul", "8"=>"Aug", "9"=>"Sep", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec", );
	 $selected = "";
	 for($i=1;$i<=count($monthArr);$i++)
	 {
		 $selected = "";
		 $monthVal = str_pad($i, 2, '0', STR_PAD_LEFT); 
 		 //if($i==6) { $selected = "selected";}
//		 if($i==9) { $selected = "selected";}	
		 if($i==7) { $selected = "selected";}			 	 
		 echo "<option value='".$monthVal."' ".$selected.">".$monthArr[$i]."</option>";
	 }
	 
	 
	 ?>
     </select>     
     
       <input name="year" type="text" class="year" id="year" tabindex=6  onFocus="onFocusBlank(this,'yyyy');"   onBlur="onBlurDefault(this,'yyyy');" onChange="intOnly(this); insertData();" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" value="1978" maxlength="4" onKeyDown="validateDiv('dobVal');" /><div id="dobVal"></div></td>  </tr>
   <tr>
    <td width="209" height="45" class="form_text">Gender</td>
    <td width="291" height="30"><input type="radio"  name="gender" id="gender" value="1" tabindex="7" style="border:none;" onClick=" validateDiv('genderVal');" checked="checked" /> Male <input type="radio"  name="gender" id="gender" style="border:none;" tabindex="8" value="2" onClick="validateDiv('genderVal'); " /> Female  <div id="genderVal" class="alert_msg" ></div> </td>
  </tr>
 
<tr>    <td height="45" class="form_text">Flat No</td>    <td class="alert_msg"><input name="flatno" id="flatno" type="text"     tabindex=13 onKeyDown="validateDiv('flatnoVal');" class="input"  value="<?php echo $flatno; ?>" /><div id="flatnoVal"></div></td>  </tr>

<tr>    <td height="45" class="form_text">Building Name</td>    <td class="alert_msg"><input name="buildingName" id="buildingName" type="text"  value="<?php echo $buildingName; ?>" tabindex=14 onKeyDown="validateDiv('buildingNameVal');" class="input" /><div id="buildingNameVal"></div></td>  </tr>

<tr>    <td height="45" class="form_text">Road</td>    <td class="alert_msg"><input name="road" id="road" type="text"  value=""    tabindex=15 onKeyDown="validateDiv('roadVal');" class="input" /><div id="roadVal"></div></td>  </tr>

<tr>    <td height="45" class="form_text">City</td>    <td class="alert_msg">
<select  name="city" class="select" id="city"  tabindex="16" onChange="validateDiv('cityVal');" ><option value="Select Your City">Select your City</option><option value="ADIPUR" selected="selected">ADIPUR</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="NEWDELHI">Delhi</option><option value="Faridabad">Faridabad</option><option value="GANDHIDHAM">GANDHIDHAM</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad" >Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Mumbai" selected="selected">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Noida">Noida</option><option value="Patna">Patna</option><option value="Pune">Pune</option><option value="Ranchi">Ranchi</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Vadodara">Vadodara</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Others">Others</option></select><div id="cityVal" class="alert_msg"></div>
</td>  </tr>
    <tr><td height="45" class="form_text">State </td><td> <select  name="state" class="select" id="state"  tabindex="17" onChange="validateDiv('stateVal');" ><option value="">Select State</option><?php
	$stateArr = array(1=>'JAMMU and KASHMIR', 2=>'HIMACHAL PRADESH', 3=>'PUNJAB',4=>'CHANDIGARH', 5=>'UTTRANCHAL', 6=>'HARAYANA', 7=>'DELHI', 8=>'RAJASTHAN', 9=>'UTTAR PRADESH', 10=>'BIHAR', 11=>'SIKKIM', 12=>'ARUNACHAL PRADESH', 13=>'NAGALAND', 14=>'MANIPUR', 15=>'MIZORAM', 16=>'TRIPURA', 17=>'MEGHALAYA', 18=>'ASSAM', 19=>'WEST BENGAL', 20=>'JHARKHAND', 21=>'ORRISA', 22=>'CHHATTISGARH', 23=>'MADHYA PRADESH', 24=>'GUJRAT', 25=>'DAMAN and DIU', 26=>'DADARA and NAGAR HAVELI', 27=>'MAHARASHTRA', 28=>'ANDHRA PRADESH', 29=>'KARNATAKA', 30=>'GOA', 31=>'LAKSHADWEEP', 32=>'KERALA', 33=>'TAMIL NADU ', 34=>'PONDICHERRY', 35=>'ANDAMAN and NICOBAR ISLANDS', 36=>'TELANGANA');
$selected = "";
for($i=1;$i<=count($stateArr);$i++)
{
	$selected = "";
	$stateValue = str_pad($i, 2, '0', STR_PAD_LEFT); 	
	if($i==27) { $selected = "selected";}
	
	echo "<option value='".$stateValue."' ".$selected." >".$stateArr[$i]."</option>";
	
}
	?>
</select>
<div id="stateVal" class="alert_msg"></div>
</td></tr>
<tr><td height="45" class="form_text">Pincode</td><td class="alert_msg"><input name="pincode" id="pincode" type="text"  tabindex=18 onKeyDown="validateDiv('pincodeVal');" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" maxlength="6" class="input" value="<?php echo $pincode; ?>" /><div id="pincodeVal"></div></td>  </tr>
<tr>    <td height="45" class="form_text">Pancard</td>    <td class="alert_msg"><input name="pan" id="pan" type="text"  tabindex=19 onKeyDown="validateDiv('panVal');" class="input" maxlength="10" value="<?php echo $pan; ?>" /><div id="panVal"></div></td>  </tr>
  <tr>    <td height="45" colspan="2" align="center">
 	<input type="hidden" name="reason" value="Find out my credit score" /> 
  <input type="image" name="Submit" src="images/login-form-lgn-sbtn.gif" width="119" height="45" tabindex="25" /></td>    </tr>   
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