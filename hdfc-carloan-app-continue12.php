<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

$submitMainForm = $_REQUEST['submitMainForm'];
$last_inserted_id = $_REQUEST['last_inserted_id'];
$model = $_REQUEST['model'];
$city = $_REQUEST['city'];
$untouched_la = $_REQUEST['untouched_la_'.$submitMainForm];
$untouched_ten = $_REQUEST['untouched_ten_'.$submitMainForm];
$rate_category = $_REQUEST['rate_category_'.$submitMainForm];
$hdfc_carprice = $_REQUEST['hdfc_carprice_'.$submitMainForm];

$nwLA = $_REQUEST['nwLA_'.$submitMainForm];
$nwtenu = $_REQUEST['nwtenu_'.$submitMainForm];
$roi = $_REQUEST['roi_'.$submitMainForm];
$final_emiPerLac = $_REQUEST['final_emiPerLac_'.$submitMainForm];
$final_Loan_Amount = $_REQUEST['final_Loan_Amount_'.$submitMainForm];
$Tenure = $nwtenu/12;
$car_name = $_REQUEST['car_name_'.$submitMainForm];

$first_car_name = $_REQUEST['car_name_0'];
$getCarSql = "select hdfc_car_manufacturer,hdfc_car_name ,hdfc_car_price , hdfc_car_price_delhi  from hdfc_car_list_category where hdfc_clid='".$car_name."'";
list($getCarNumRows,$getCarQuery)=MainselectfuncNew($getCarSql,$array = array());

$hdfc_car_name = $getCarQuery[0]['hdfc_car_name'];
$hdfc_car_price = $getCarQuery[0]['hdfc_car_price'];
if($hdfc_car_price=='delhi')
{
	$hdfc_car_price = $getCarQuery[0]['hdfc_car_price_delhi'];
}

$dataUpdate = array('Car_Model'=>$hdfc_car_name, 'Car_Price'=>$hdfc_car_price, 'intr_rate'=>$roi, 'Tenure'=>$Tenure, 'Loan_Amount'=>$final_Loan_Amount);
$wherecondition = "(RequestID='".$last_inserted_id."')";
Mainupdatefunc ('hdfc_car_loan_leads', $dataUpdate, $wherecondition);

$getfirstCarSql = "select hdfc_car_manufacturer,hdfc_car_name ,hdfc_car_price , hdfc_car_price_delhi  from hdfc_car_list_category where hdfc_clid='".$first_car_name."'";
list($getfirstCarNumRows,$getfirstCarQuery)=MainselectfuncNew($getfirstCarSql,$array = array());
$hdfc_car_manufacturer = $getfirstCarQuery[0]['hdfc_car_manufacturer'];
$hdfc_car_manufacturer_first = explode(" ", $hdfc_car_manufacturer);
$model = strtolower($hdfc_car_manufacturer_first[0]);
if($model=="land"){	$model = "landrover"; }
//$model = "tata";
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="images/car_hdfc/maruti_css.css" type="text/css" rel="stylesheet" />
<title>Deal4loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/hdfccl-style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-stages.js"></script>
<style type="text/css">
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
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
	
	
	form{
		display:inline;
	}
	
	
	</style>

<script language="javascript">

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
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

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	

	var a=Form.Pancard.value;
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	  alert('Please enter valid pan number');
	  Form.Pancard.focus();
	  return false;
	}
	if (Form.Pancard.value.charAt(3)!="P" && Form.Pancard.value.charAt(3)!="p")
	{
			alert("Please enter valid pan number");
			Form.Pancard.focus();
			return false;
	}
	
	if(Form.residence_address.value=="")
	{
		alert("Kindly fill in your Residence Address!");
		Form.residence_address.focus();
		return false;
	}
	if(Form.pincode.value=="")
	{
		alert('Kindly fill in your Pincode!');
		Form.pincode.focus();
		return false;
	}

	if(Form.Net_Salary.value=="" || Form.Net_Salary.value=="0")
	{
		alert('Click on "Your occupational details". Please enter Annual income to Continue');
		Form.Net_Salary.focus();
		return false;
	}
	if(Form.Company_Name.value=="")
	{
		alert("Please enter Company Name to Continue");
		Form.Company_Name.focus();
		return false;
	}
	if(Form.Primary_Acc.value=="")
	{
		alert("Please enter Primary Account to Continue");
		Form.Primary_Acc.focus();
		return false;
	}
	if(Form.off_address.value=="")
	{
		alert("Kindly fill in your Office Address!");
		Form.off_address.focus();
		return false;
	}
	if(Form.pincode_o.value=="")
	{
		alert("Kindly fill in your Pincode!");
		Form.pincode_o.focus();
		return false;
	}

	return true;
	
	

}
</script>

<style>
.rightboxspecification{ width:100%; padding:0px 2px 0px 2px;  margin:auto; border:#e4ddf9 solid thin; background: #FFFFFF; height:auto;} 
</style>
</head>
<body>
<div class="main-wrapper">
<!--<div class="header-box"><span class="<?php echo $model; ?>-heading_A">HDFC Bank offers you complete package of <span class="<?php echo $model; ?>-heading_B">timely service</span>,</span>
  <span style="color:#CCCCCC">  
  <h1 class="<?php echo $model; ?>-heading_B">Competitive rates &amp; Competent guidance <span class="<?php echo $model; ?>-heading_A">along with 100% finance on select models.  </span></h1>
  </span></div> -->
  
<div style="clear:both; padding-top:7px;"></div>
<div class="<?php echo $model; ?>-vehicle_box_left">
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td class="vehicle_heading_text" valign="top" style="height:45px;"><?php echo $hdfc_car_name; ?></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><span class="vehicle_heading_text"><?php 	echo "Rs. ".number_format($hdfc_car_price); ?>/-</span></td>

    </tr>
    <tr>
      <td class="vehicle_sub_heading_text">Ex-showroom price</td>

    </tr>
  </table>
</div>
<div class="<?php echo $model; ?>-form-box">
<form  method="POST" action="hdfc-carloan-app-continue13.php" name="hdfc_calc"  onSubmit="return submitform(document.hdfc_calc);" >
<input type="hidden" name="stat_code" id="stat_code" tabindex=15>
<input type="hidden" name="model" id="model" value="<?php echo $model; ?>">
<input type="hidden" name="car_name" id="car_name" value="<?php echo $hdfc_car_name; ?>">
<input type="hidden" name="last_inserted_id" id="last_inserted_id" value="<?php echo $last_inserted_id; ?>">
<input type="hidden" name="final_emiPerLac" id="final_emiPerLac" value="<?php echo $final_emiPerLac; ?>">
<input type="hidden" name="Loan_Amt" id="Loan_Amt" value="<?php echo $nwLA; ?>">
<input type="hidden" name="Tenure" id="Tenure" value="<?php echo $nwtenu/12; ?>">
<input type="hidden" name="roi" id="roi" value="<?php echo $roi; ?>">

  <table width="534" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>    <td width="43" >&nbsp;</td>    
<td width="508" align="left" class="maruti-heading_text" id="plz_show_price" style="font-size:20px; padding-top:3px;"  >Complete your application process</td>    <td >&nbsp;</td>  </tr> 
<tr align="left">    <td colspan="3" class="lining">&nbsp;</td> </tr> 
<tr> 
<td colspan="3" align="center">
<table width="520" border="0" align="center" cellpadding="0" cellspacing="0"> 
<tr>     
<td width="44">&nbsp;</td>   <td width="20" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td> 
<td width="302" align="left" class="<?php echo $model; ?>-heading_body-text">Pancard No</td>  <td width="24"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td>   <td width="278" align="left" class="<?php echo $model; ?>-heading_body-text">Resi Address Line 1</td>  </tr> 
<tr>  
<td>&nbsp;</td>  <td>&nbsp;</td>  <td align="left"> <input type="text" name="Pancard" id="Pancard" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="2"  /></td>        <td>&nbsp;</td>   <td align="left"><input type="text" name="residence1_address" id="residence1_address" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="3"/></td> </tr> 
<tr> 
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td width="44">&nbsp;</td>   <td width="20" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td> 
<td width="302" align="left" class="<?php echo $model; ?>-heading_body-text">Pincode</td>  <td width="24"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td>   <td width="278" align="left" class="<?php echo $model; ?>-heading_body-text">Resi Address Line 2</td>  </tr> 
<tr>  
<td>&nbsp;</td>  <td>&nbsp;</td>  <td align="left"> <input type="text" name="pincode" id="pincode" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>        <td>&nbsp;</td>   <td align="left"><input type="text" name="residence1_address" id="residence1_address" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="3"/></td> </tr> 
<tr> 
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>  
<tr><td width="44">&nbsp;</td>   <td width="20" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td> 
<td width="302" align="left" class="<?php echo $model; ?>-heading_body-text">Resi Telephone</td>  <td width="24"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td>   <td width="278" align="left" class="<?php echo $model; ?>-heading_body-text">Primary Account in which bank?</td>  </tr> 
<tr>  
<td>&nbsp;</td>  <td>&nbsp;</td>  <td align="left"> 
<input style="width:50px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;"  name="home_phone_std" id="home_phone_std" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;<input style="width:120px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" class="inputtext" name="home_phone" id="home_phone" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this); "/>
</td>        <td>&nbsp;</td>   <td align="left"><input type="text" name="Primary_Acc" id="Primary_Acc" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="3" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event,'http://www.deal4loans.com/ajax-list-bankname.php'); "/></td> </tr> 
<tr> 
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td width="44">&nbsp;</td>   <td width="20" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td> 
<td width="302" align="left" class="<?php echo $model; ?>-heading_body-text">Credit Card Holder ?</td>  <td width="24"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td>   <td width="278" align="left" class="<?php echo $model; ?>-heading_body-text">Office Address Line 1</td>  </tr> 
<tr>  
<td>&nbsp;</td>  <td>&nbsp;</td>  <td align="left" class="<?php echo $model; ?>-heading_body-text"> 
<input type="radio" name="CC_Holder" id="CC_Holder" value="1" style="border:none;" /> Yes   <input type="radio" name="CC_Holder" id="CC_Holder" value="0" style="border:none;" /> No
</td>        <td>&nbsp;</td>   <td align="left"><input type="text" name="off_address" id="off_address" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="3"/></td> </tr> 
<tr> 
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>  
<tr><td width="44">&nbsp;</td>   <td width="20" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td> 
<td width="302" align="left" class="<?php echo $model; ?>-heading_body-text">Office Telephone</td>  <td width="24"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td>   <td width="278" align="left" class="<?php echo $model; ?>-heading_body-text">Office Address Line 1</td>  </tr> 
<tr>  
<td>&nbsp;</td>  <td>&nbsp;</td>  <td align="left" class="<?php echo $model; ?>-heading_body-text"> 
<input style="width:50px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;"  name="office_std" id="office_std" value="Std" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;<input class="inputtext" style="width:110px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;"  name="office_phone" id="office_phone" value="Number" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;<input style="width:50px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" class="inputtext"  name="office_ext" id="office_ext" value="Ext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>
</td>        <td>&nbsp;</td>   <td align="left"><input type="text" name="off1_address" id="off1_address" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="3"/></td> </tr> 
<tr> 
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

<tr>  
<tr><td width="44">&nbsp;</td>   <td width="20" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td> 
<td width="302" align="left" class="<?php echo $model; ?>-heading_body-text">Promotion Code</td>  <td width="24"></td>   <td width="278" align="left" class="<?php echo $model; ?>-heading_body-text"></td>  </tr> 
<tr>  
<td>&nbsp;</td>  <td>&nbsp;</td>  <td align="left" class="<?php echo $model; ?>-heading_body-text"> 
<input type="text" name="promotion_code" id="promotion_code" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="3"/></td>        <td>&nbsp;</td>   <td align="left"></td> </tr> 
<tr> 
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td width="44">&nbsp;</td>   <td width="20" align="left"></td> 
<td align="left" class="<?php echo $model; ?>-heading_body-text" colspan="3">Select one document in each section below that you will provide as proof</td>     <td align="left" class="<?php echo $model; ?>-heading_body-text"></td>  </tr> 
<tr>  
<td>&nbsp;</td>  <td>&nbsp;</td>  <td align="left" class="<?php echo $model; ?>-heading_body-text"> 
</td>        <td>&nbsp;</td>   <td align="left"></td> </tr>

<tr><td width="44">&nbsp;</td>   <td width="20" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td> 
<td colspan="3" align="left" class="<?php echo $model; ?>-heading_body-text"><table width="416">
  <tr><td width="172">Proof of Income</td>
  <td width="232"><select name="Income_Proof" id="Income_Proof" style="width:210px;" >
    <option value="">Select</option>
    <option value="Latest ITR">Latest ITR</option>
    <option value="Form 16">Form 16</option>
    <option value="Salary ceritificate for last 3 months">Salary ceritificate for last 3 months</option>
    <option value="Pay slip - last 3 months">Pay slip - last 3 months</option>
</select></td></tr></table></td>   <td  align="left" class="<?php echo $model; ?>-heading_body-text"></td>  </tr> 
<tr> 
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td width="44">&nbsp;</td>   <td width="20" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td> 
<td colspan="3" align="left" class="<?php echo $model; ?>-heading_body-text"><table width="416">
  <tr><td width="172">Proof of Address</td>
  <td width="232"> <select name="Address_Proof" id="Address_Proof" style="width:210px;">
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
	</select></td></tr></table></td>   <td  align="left" class="<?php echo $model; ?>-heading_body-text"></td>  </tr>
<tr>  
<td>&nbsp;</td>  <td>&nbsp;</td>  <td align="left" class="<?php echo $model; ?>-heading_body-text"> 
</td>        <td>&nbsp;</td>   <td align="left"></td> </tr>

<tr><td width="44">&nbsp;</td>   <td width="20" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td> 
<td colspan="3" align="left" class="<?php echo $model; ?>-heading_body-text"><table width="416">
  <tr><td width="172">Proof of Identity</td>
  <td width="232"><select name="Identity_Proof" id="Identity_Proof" style="width:210px;" >
    <option value="">Select</option>
    <option value="Latest ITR">Latest ITR</option>
    <option value="Form 16">Form 16</option>
    <option value="Salary ceritificate for last 3 months">Salary ceritificate for last 3 months</option>
    <option value="Pay slip - last 3 months">Pay slip - last 3 months</option>
</select></td></tr></table></td>   <td  align="left" class="<?php echo $model; ?>-heading_body-text"></td>  </tr>
<tr>  
<td>&nbsp;</td>  <td>&nbsp;</td>  <td align="left" class="<?php echo $model; ?>-heading_body-text">&nbsp;</td>        
<td>&nbsp;</td>   <td align="left"></td> </tr>

<tr><td width="44">&nbsp;</td>   <td width="20" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15" /></td> 
<td colspan="3" align="left" class="<?php echo $model; ?>-heading_body-text"><table width="416">
  <tr><td width="172">Bank Statement</td>
  <td width="232"> <select name="Bank_Statement" id="Bank_Statement"  style="width:210px;" >
    <option value="">Select</option>
    <option value="Salary account bank statement - last 6 months">Salary account bank statement - last 6 months</option>
	</select></td></tr></table></td>   <td  align="left" class="<?php echo $model; ?>-heading_body-text"></td>  </tr>

<tr>     <td>&nbsp;</td>   <td >&nbsp;</td><td >&nbsp;</td>  <td >&nbsp;</td>        <td >&nbsp;</td>    </tr>   <tr>        <td>&nbsp;</td>     <td >  </td>        <td class="<?php echo $model; ?>-heading_body-text" ><table width="100%" border="0" cellpadding="0" cellspacing="0">     <tr>            
<td width="11%" align="center"></td>          </tr>        </table></td>        <td colspan="2" align="left" >	<input type="submit" style="border: 0px none ; background-image: url(images/newimages/<?php echo $model; ?>-get-quote-btn.png); width: 142px; height: 45px; margin-bottom: 0px;" value=""/>		</td>        </tr>    </table></td>    </tr>  <tr>    <td colspan="3">&nbsp;</td>    </tr>
</table>
  </form>
</div>
<div class="right-box">
<div class="rightboxspecification"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td height="40" colspan="2" style="border-bottom: thin solid #e4ddf9;"><h2 class="<?php echo $model; ?>-heading_B" style="font-size:20px;">Loan Offer Summary</h2>	</td>
  </tr>  
  <tr>
    <td width="51%" height="26" class="maruti-heading_body-text" >Loan Amount</td>
    <td width="49%" height="26" align="right" class="heading_body-text_sub"><img src="images/rupees.gif" > <?php echo $nwLA; ?> /-</td>
  </tr>
  <tr>
    <td height="25" class="maruti-heading_body-text">Tenure</td>
    <td height="25" align="right" class="heading_body-text_sub"> <?php echo $nwtenu/12; ?> Years</td>
  </tr>
  <tr>
    <td height="26" class="maruti-heading_body-text">ROI</td>
    <td height="26" align="right" class="heading_body-text_sub"><?php echo $roi; ?> %</td>
  </tr>
  <tr>
    <td height="26" class="maruti-heading_body-text">EMI per lac</td>
    <td height="26" align="right" class="heading_body-text_sub"><img src="images/rupees.gif" > <?php echo $final_emiPerLac; ?> /-</td>
  </tr>
</table>
</div>
<div style=" background:url(images/form-buttom-shadow-rightside.jpg) no-repeat; height:11px;"></div>
<?php
$getRewardsSql = "select reward_selected from hdfc_car_loan_leads where RequestID='".$last_inserted_id."'";
list($numRewards,$getRewardsQuery)=MainselectfuncNew($getRewardsSql,$array = array());

$reward_selected = $getRewardsQuery[0]['reward_selected'];
if($numRewards>0)
{
?>


<div class="rightboxspecification" style="padding-top:4px;">
<?php
$getGiftsSql = "SELECT * FROM hdfc_car_loan_gifts WHERE id= '".$reward_selected."'";		
list($giftsnumRewards,$getGiftsQuery)=MainselectfuncNew($getGiftsSql,$array = array());
$id = $getGiftsQuery[0]['id'];
$Name = $getGiftsQuery[0]['Name'];
$image = $getGiftsQuery[0]['image'];

?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td height="40" colspan="2" style="border-bottom: thin solid #e4ddf9;"><h2 class="<?php echo $model; ?>-heading_B">Selected Reward</h2>	</td>
  </tr>  
  <tr>
    <td class="maruti-heading_body-text" align="center" ><img src="/images/brochure/<?php echo $image; ?>" border="0"></td>
  </tr>
  <tr>
    <td class="maruti-heading_body-text" align="center" ><?php echo $Name;?></td>
  </tr>

</table>
</div>
<div style=" background:url(images/form-buttom-shadow-rightside.jpg) no-repeat; height:11px;"></div>
<?php
}
?>

</div>
</div>
</body>
</html>
