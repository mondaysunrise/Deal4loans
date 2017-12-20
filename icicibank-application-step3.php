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
Mainupdatefunc ('icici_exclusive_application', $DataArray, $wherecondition);
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
<link href="app-second-styles.css" type="text/css" rel="stylesheet" />
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

	if(document.loan_form.ResidenceAddress1.value=="")
	{
		//document.getElementById('pAddVal').innerHTML = "<span  class='hintanchor'>Fill Present Address!</span>";
		alert("Fill Residence Address");
		document.loan_form.ResidenceAddress1.focus();
		return false;
	}
	if(document.loan_form.ResidenceAddress2.value=="")
	{
		//document.getElementById('pAddVal').innerHTML = "<span  class='hintanchor'>Fill Present Address!</span>";
		alert("Fill Residence Address");
		document.loan_form.ResidenceAddress2.focus();
		return false;
	}
	if(document.loan_form.ResidencePinCode.value=="")
	{
		//document.getElementById('pAddVal').innerHTML = "<span  class='hintanchor'>Fill Present Address!</span>";
		alert("Fill Residence Pincode");
		document.loan_form.ResidencePinCode.focus();
		return false;
	}
	
	/*if (document.loan_form.p_City.selectedIndex==0)
	{
		document.getElementById('pcityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.p_City.focus();
		return false;
	}*/
	if(document.loan_form.ResidenceState.value=="")
	{
		//document.getElementById('pstateVal').innerHTML = "<span  class='hintanchor'>Enter State!</span>";
		alert("Fill Residence State");
		document.loan_form.ResidenceState.focus();
		return false;
	}
	if(document.loan_form.DurationofStayMonth.value=="")
	{
	//	document.getElementById('ppin').innerHTML = "<span  class='hintanchor'>Fill Pincode!</span>";
		alert("Duration of Stay (Months)");
		document.loan_form.DurationofStayMonth.focus();
		return false;
	}
	if(document.loan_form.DurationofStayYear.value=="")
	{
	//	document.getElementById('ppin').innerHTML = "<span  class='hintanchor'>Fill Pincode!</span>";
		alert("Duration of Stay (Years)");
		document.loan_form.DurationofStayYear.focus();
		return false;
	}
	if(document.loan_form.IndustrySector.value=="")
	{
	//	document.getElementById('ppin').innerHTML = "<span  class='hintanchor'>Fill Pincode!</span>";
		alert("Select Industry Sector");
		document.loan_form.IndustrySector.focus();
		return false;
	}
	if(document.loan_form.TotalworkExperience.value=="")
	{
	//	document.getElementById('ppin').innerHTML = "<span  class='hintanchor'>Fill Pincode!</span>";
		alert("Select Total Work Experience");
		document.loan_form.TotalworkExperience.focus();
		return false;
	}
	if(document.loan_form.CurrentEmployerMonth.value=="")
	{
	//	document.getElementById('ppin').innerHTML = "<span  class='hintanchor'>Fill Pincode!</span>";
		alert("Select Current Employment Duration (Months)");
		document.loan_form.CurrentEmployerMonth.focus();
		return false;
	}
	if(document.loan_form.CurrentEmployerYear.value=="")
	{
	//	document.getElementById('ppin').innerHTML = "<span  class='hintanchor'>Fill Pincode!</span>";
		alert("Select Current Employment Duration (Years)");
		document.loan_form.CurrentEmployerYear.focus();
		return false;
	}
	

}  

function addDetailsA()
{
	var ni1 = document.getElementById('getDetails');
	ni1.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="formbodytext">Industry Sector</td><td class="formbodytext" style="font-size:11px;"><span class="formbodytext" style="font-size:11px;"><select name="IndustrySector" id="IndustrySector" class="select-bx12" tabindex="10"><option value="">Select</option><option value="Others">Others</option></select></span></td><td class="formbodytext">Total work Experience</td><td class="formbodytext" style="font-size:11px;"><span class="formbodytext" style="font-size:11px;"><select name="TotalworkExperience" id="TotalworkExperience" class="select-bx12" tabindex="11"><option value="">Select</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>             </select></span></td></tr><tr><td colspan="2" class="formbodytext" style="font-size:11px;"  height="10"></td></tr><tr><td class="formbodytext">Working since with<br> Current Employer (Month)</td><td class="formbodytext" style="font-size:11px;"><span class="formbodytext" style="font-size:11px;"><select name="CurrentEmployerMonth" id="CurrentEmployerMonth" class="select-bx12" tabindex="12"><option value="">Select</option><option value="Jan">January</option><option value="Feb">Feburary</option><option value="Mar">March</option><option value="Apr">April</option><option value="May">May</option><option value="Jun">June</option><option value="Jul">July</option><option value="Aug">August</option><option value="Sep">September</option><option value="Oct">October</option><option value="Nov">November</option><option value="Dec">December</option>             </select></span></td><td class="formbodytext">Working since with<br> Current Employer (Years)</td><td class="formbodytext" style="font-size:11px;" valign="top"><span class="formbodytext" style="font-size:11px;"><select name="CurrentEmployerYear" id="CurrentEmployerYear" class="select-bx12" tabindex="13"><option value="">Select</option><option value="2007">2007</option><option value="2008">2008</option><option value="2009">2009</option><option value="2010">2010</option><option value="2011">2011</option><option value="2012">2012</option><option value="2013">2013</option><option value="2014">2014</option>             </select></span></td></tr><tr><td colspan="2" class="formbodytext" style="font-size:11px;">&nbsp;</td></tr><tr><td colspan="2" class="formbodytext" style="font-size:11px;">&nbsp;</td></tr><tr><td colspan="2" class="formbodytext"></td></tr><tr><td colspan="4" align="center" class="formbodytext"><input type="submit" style="border: 0px none ; background:url(images/submit-app.png); width: 135px; height: 40px; margin-bottom: 0px;" value="" tabindex="18"/></td></tr></table>';
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
		.input-bx12 {
width: 200px;
height: 28px;
border: #eb7f10 solid thin;
border-radius: 5px;
font-family: Verdana, Geneva, sans-serif;
}
.select-bx12 {
width: 200px;
height: 32px;
padding: 5px;
border: #eb7f10 thin solid;
border-radius: 5px;
font-family: Verdana, Geneva, sans-serif;
}
	</style>
</head>
<body>
<header>
<div class="header">
<div class="header-inner">
<div class="logo" style="font-family:Arial, Helvetica, sans-serif; color:#06396b; font-size:22px; font-weight:bold; width:600px !important;">Input your details and Get Instant Eapproval  in 2 minutes</div>
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


     <div class="form-wrapper-app" style="width:890px;">
     <form id="myform" onSubmit="return chkpersonalloan();" action="icicibank-step4.php" method="post" name="loan_form">
  <input type="hidden" name="iciciappid" id="iciciappid" value="<? echo $ProductValue; ?>">
  <input name="Name" id="Name" type="hidden" class="input-bx12" tabindex="1"  onKeyDown="validateDiv('nameVal');" value="<? echo $icici_name; ?>" autocomplete="off" />
  <input type="hidden" name="Phone" id="Phone" class="input-bx12" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="2" onKeyDown="validateDiv('phoneVal');" value="<? echo $icici_mobile; ?>" maxlength="10" autocomplete="off"  />
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td colspan="4" align="left" class="formbodytext" style="font-size:18px; color:#000;">
           
          <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">Loan Amount</td>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">Interest Rate</td>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">EMI</td>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">Tenure (in Yrs)</td>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">Processing Fee</td>
    </tr> 
		<tr><td align="center" bgcolor="#fe9820" class="tble-text padding-td" ><input type="text" id="loan_amt" value="<?  echo $loan_amt;  ?>" name="loan_amt" style="background:#fe9820; text-align:center; border:none; width:95%;color:#FFFFFF;  width:100px;"></td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td" >
	  <input type="text" value="<? echo $interest_rate;  ?>" id="interest_rate" name="interest_rate" style="background:#fe9820;text-align:right; border:none; width:95%; color:#FFFFFF; width:35px;">%
	</td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td" >
	  <input type="text" value="<? echo $emi; ?>" id="emi" name="emi" style="background:#fe9820; text-align:center; border:none; width:95%; color:#FFFFFF; width:100px;">
	 </td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td">
	  <input type="text" value="<? echo $term;?>" id="term" name="term" style="background:#fe9820; text-align:right; border:none; color:#FFFFFF; width:30px;">Yrs
	 </td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td"><input type="text" value="<? echo $proc_fee; ?>" id="proc_fee" name="proc_fee" style="background:#fe9820; width:95%; border:none; color:#FFFFFF; text-align:center; width:50px;">  
          
      </td></tr>
		
  </table> 
           
           </td>
         </tr>
         <tr>
           <td align="left" class="formbodytext">&nbsp;</td>
           <td align="left" class="formbodytext">&nbsp;</td>
         </tr>
       
         <tr>
           <td colspan="2" align="left" class="formbodytext" style="font-size:18px; color:#000;">Personal Details</td>
         </tr>
         <tr>
           <td align="left" class="formbodytext">&nbsp;</td>
           <td align="left" class="formbodytext">&nbsp;</td>
         </tr>
         <tr>
           <td align="left" class="formbodytext">Pan Card</td>
           <td class="formbodytext"><input type="text" name="Pancard" id="Pancard" class="input-bx12" onKeyDown="validateDiv('panVal');" maxlength="10" tabindex="1" autocomplete="off"  />
           <div id="panVal" class="alert_msg"></div></td>
		 <td class="formbodytext">Gender </td>
           <td class="formbodytext">             <input type="radio" name="gender" id="gender" value="male" tabindex="2" checked>

             Male 
              <input type="radio" name="gender" id="gender" value="female" tabindex="3"> 
              Female</td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" style="font-size:11px;" height="10"></td>
         </tr>
         <tr>
           <td class="formbodytext">Residence Address Line 1</td>
           <td class="formbodytext" style="font-size:11px;"><input  type="text" class="input-bx12" name="ResidenceAddress1" id="ResidenceAddress1"  value=""  onkeydown="validateDiv('pStateVal');" tabindex="4"><div id="pStateVal" class="alert_msg"></div></td>
         
           <td class="formbodytext">Residence Address Line 2</td>
           <td class="formbodytext" style="font-size:11px;"><span class="formbodytext" style="font-size:11px;">
             <input  type="text" class="input-bx12" name="ResidenceAddress2" id="ResidenceAddress2"  value=""  onkeydown="validateDiv('pStateVal');" tabindex="5">
           </span></td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext"  height="10"></td>
           </tr>
         <tr>
           <td class="formbodytext">Residence Pincode</td>
           <td class="formbodytext" style="font-size:11px;"><span class="formbodytext" style="font-size:11px;">
             <input  type="text" class="input-bx12" name="ResidencePinCode" id="ResidencePinCode"  value="" maxlength="6" onKeyPress="intOnly(this);" onkeydown="validateDiv('pStateVal');" tabindex="6">
           </span></td>
        
           <td class="formbodytext">Residence State</td>
           <td class="formbodytext" style="font-size:11px;"><label><span class="formbodytext" style="font-size:11px;">
            <select name="ResidenceState" id="ResidenceState" class="select-bx12" tabindex="7">
            <option value="">Select</option>
            <?php 
		   
		   $stateArr = array('Rajasthan', 'Madhya Pradesh', 'Maharashtra', 'Andhra Pradesh', 'Uttar Pradesh', 'Jammu and Kashmir', 'Gujarat', 'Karnataka', 'Odisha', 'Chhattisgarh', 'Tamil Nadu', 'Bihar', 'West Bengal', 'Arunachal Pradesh', 'Jharkhand', 'Assam', 'Himachal Pradesh', 'Uttarakhand', 'Punjab', 'Haryana', 'Kerala', 'Meghalaya', 'Manipur', 'Mizoram', 'Nagaland', 'Tripura', 'Andaman and Nicobar Islands', 'Sikkim', 'Goa', 'Delhi', 'Puducherry', 'Dadra and Nagar Haveli', 'Chandigarh', 'Daman and Diu', 'Lakshadweep');
		   for($stat=0;$stat<count($stateArr);$stat++)
			 {
			 	echo "<option value='".$stateArr[$stat]."'>".$stateArr[$stat]."</option>";
			 }
		   ?>
           </label></td>
         </tr>
         <tr>
           <td colspan="2" class="formbodytext" style="font-size:11px;"  height="10"></td>
         </tr>
         <tr>
           <td class="formbodytext">Duration of Stay <br>on current address (Month)</td>
           <td class="formbodytext" style="font-size:11px;" valign="top"><span class="formbodytext" style="font-size:11px;">
             <select name="DurationofStayMonth" id="DurationofStayMonth" class="select-bx12" tabindex="8">
             <option value="">Select</option>
             <?php
			 $monthAll = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
			 $monthAllFull = array("January","Feburary","March","April","May","June","July","August","September","October","November","December");			 
			 for($mon=0;$mon<12;$mon++)
			 {
			 	echo "<option value='".$monthAll[$mon]."'>".$monthAllFull[$mon]."</option>";
			 }
			 ?>
             </select>
           </span></td>
        
           <td class="formbodytext">Durationof Stay<br>on current address (Years)</td>
           <td class="formbodytext" style="font-size:11px;" valign="top"><span class="formbodytext" style="font-size:11px;">
             <select name="DurationofStayYear" id="DurationofStayYear" class="select-bx12" tabindex="9" onChange="addDetailsA();" onFocus="addDetailsA();">
              <option value="">Select</option>
             <?php
			 for($mon=2007;$mon<2015;$mon++)
			 {
			 	echo "<option value='".$mon."'>".$mon."</option>";
			 }
			 ?>
             </select>
           </span></td>
         </tr>
         <tr>
           <td colspan="4" class="formbodytext" style="font-size:11px;"  height="10"></td>
         </tr>
  
         <tr>
           <td colspan="4" class="formbodytext" style="font-size:10px;" id="getDetails"><table width="100%" border="0" cellpadding="0" cellspacing="0"> <tr>
           <td colspan="2" class="formbodytext" style="font-size:11px;"  height="10"></td>
         </tr> <tr>
           <td colspan="2" class="formbodytext" style="font-size:11px;"  height="10"></td>
         </tr> <tr>
           <td class="formbodytext" style="font-size:10px;">&nbsp;</td>
           <td align="center" class="formbodytext" style="font-size:10px;"><img src="images/submit-application-btn.jpg" width="220" height="40" border="0" >  </td>
         </tr></table></td>
         </tr>
         <tr>
           <td colspan="4" class="formbodytext" style="font-size:10px;"><strong>Disclaimer: </strong>All loans are on sole discretion on the  banks</td>
         </tr>
       </table>
    
     
    </form>
    </div></div></div>
</div>
</body>
</html>