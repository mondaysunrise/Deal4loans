<? 
require 'scripts/db_init.php';
require 'scripts/functions.php';
	
	$last_inserted_id = $_POST['last_inserted_id'];
	$pay = $_POST['pay'];
	$tot_amount = $_POST['tot_amount'];;
	$tot_interest = $_POST['tot_interest'];;

	$Net_Salary = $_POST['Net_Salary'];

	$Company_Name = $_POST['Company_Name'];
	$Primary_Acc = $_POST['Primary_Acc'];
	$CC_Holder = $_POST['CC_Holder'];
	$off_address = $_POST['off_address'];
	$off1_address = $_POST['off1_address'];
	$office = $off_address.", ".$off1_address;
	$pincode_o = $_POST['pincode_o'];
	$office_std = $_POST['office_std'];
	$office_phone = $_POST['office_phone'];
	$office_ext = $_POST['office_ext'];
	
	$getDataSql = "Select * from hdfc_car_loan_leads where RequestID = '".$last_inserted_id."'";
	list($getDatanumRewards,$getDataQuery)=MainselectfuncNew($getDataSql,$array = array());
	$getNet_Salary = $getDataQuery[0]['Net_Salary'];
	if(strlen($Net_Salary)>0) { } else { $Net_Salary = $getNet_Salary ;}
	$getCompany_Name = $getDataQuery[0]['Company_Name'];
	if(strlen($Company_Name)>0) { } else { $Company_Name = $getCompany_Name ;}
		
	$Car_Model = $getDataQuery[0]['Car_Model'];

	$dataUpdate = array('Net_Salary'=>$Net_Salary, 'Company_Name'=>$Company_Name, 'Primary_Acc'=>$Primary_Acc, 'CC_Holder'=>$CC_Holder, 'Off_Landline'=>$office_phone, 'office_std'=>$office_std, 'Off_Address'=>$office, 'off_pincode'=>$pincode_o, 'office_ext'=>$office_ext);
	$wherecondition ="(RequestID = '".$last_inserted_id."')";
	Mainupdatefunc ('hdfc_car_loan_leads', $dataUpdate, $wherecondition);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HDFC BANK | Deal4loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<style type="text/css"> 
<!-- 
body  {
	font: 100% Verdana, Arial, Helvetica, sans-serif;
	margin: 0;
	padding: 0;
	text-align: center; 
	color: #000000;
}
.twoColLiqRtHdr #container { 
	width: 90%;  
	background: #FFFFFF;
	margin: 0 auto; 
	border: 1px solid #000000;
	text-align: left; 
} 
.twoColLiqRtHdr #header { 
	background: #DDDDDD; 
	padding: 0 10px;
} 
.twoColLiqRtHdr #header h1 {
	margin: 0; 
	padding: 10px 0;
}
.twoColLiqRtHdr #sidebar1 {
	float: right; 
	width: 30%; 
	padding-top: 15px; 
	padding-left: 15px; 
}
.twoColLiqRtHdr #sidebar1 h3, .twoColLiqRtHdr #sidebar1 p {
	margin-left: 10px; 
	margin-right: 10px;
}
.twoColLiqRtHdr #mainContent { 
	margin: 0 0 0 10px;
	width:610px;
} 

.twoColLiqRtHdr #footer { 
	padding:10px; 
	background:#DDDDDD; 
} 
.twoColLiqRtHdr #footer p {
	margin: 0; 
	padding: 10px 0; 
}
.fltrt { 
	float: right;
	margin-left: 8px;
}
.fltlft {
	float: left;
	margin-right: 8px;
}
.clearfloat {
	clear:both;
    height:0;
    font-size: 1px;
    line-height: 0px;
}
.text8 {
	font-family: 'Carrois Gothic', serif;
	font-size: 13px;
	font-weight: bold;
	font-variant: normal;
	text-decoration: none;
	@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
}

.text9 {
	font-family: 'Carrois Gothic', serif;
	font-size: 20px;
	font-weight: bold;
	font-variant: normal;
	text-decoration: none;
	@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
}
.inputtext
{
	-moz-border-radius: 10px;
	border-radius: 10px;
    border:solid 1px #e6e6e6;
    padding:5px;
	background-color:#e6e6e6; 
	height:20px;
}
.design2{
background-color:#ff1552;
border:1px solid #ff1552;
padding:5px;
-webkit-border-radius:10px;
-moz-border-radius:10px;
width:150px;
text-align:left;
height:37px;
font-size:15px;
color:#FFFFFF;
font-family: 'Carrois Gothic', serif;
@import url(http://fonts.googleapis.com/css?family=Carrois+Gothic);
font-weight:bolder;
}
select {
    width:250px;
	height:27px;
     border:solid 1px #e6e6e6;
	 background-color:#e6e6e6; 
    -webkit-border-top-right-left-radius: 10px;
    -webkit-border-bottom-right-left-radius: 1px;
    -moz-border-radius: 10px;
    -moz-border-radius: 10px;
    padding:2px;
}
#emi_sum { background: none repeat scroll 0pt 0pt #fcfcfc; clear: both; float: left; width: 200px; margin: 0pt 0px 0px 0pt;  height: 195px; }
#emi_sum div { margin: 0pt 0pt 0px; padding: 10px 0px 0pt; text-align: center; width: 200px; border-top: 1px dotted rgb(147, 79, 79); }
#emi_sum h4 { color: #934f4f; font-weight: bold; }
#emi_sum p { font-size: 18px; font-weight: bold; margin: 0pt auto; }
#emi_sum span { padding-left: 5px; }

#emiamount { border-top: 0pt none ! important; }
#emiamount p { font-size: 24px; }
.showintr  { margin: 0; padding: 0; border: 0; outline: 0; font: 13px Arial, Helvetica, sans-serif;    color: #00000;}
--> 
</style><!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColLiqRtHdr #sidebar1 { padding-top: 30px; }
.twoColLiqRtHdr #mainContent { zoom: 1; padding-top: 15px; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->
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
<script>
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

</script>
</head>
<body class="twoColLiqRtHdr">
<div id="container">
  <div id="header" >
    <div align="left" style="height:45px; padding-top:6px;"><img src="new-images/hdfc_cl_logo.gif" width="184" height="34" border="0"/></div>
  <!-- end #header --></div>
  <div id="sidebar1" style="padding-top:30px;">
  <table cellpadding="0" cellspacing="0" border="0"   class="inputtext" style="width:230px; height:220px; ">
<tr><td class="text9" style="color:#4c4c4c; size:18px; height:37px; padding-left:70px;"  ><span >Results</span></td></tr>
  <tr><td valign="top" align="center" style="padding-left:9px; background-color:#e6e6e6;">
  <div id="emipaymentdetails" style="background-color:#e6e6e6;" class="showintr" >
	<div  id="emi_sum" style="background-color:#e6e6e6;" class="showintr">
		<div id="emiamount" style="background-color:#e6e6e6;" class="showintr">
		  <h4 class="showintr">Monthly Instalment (EMI)</h4>
		  <p style="font-size:12px;" class="showintr">Rs. <span><?php echo number_format(round($pay)); ?></span></p>
		  <p style="font-size:12px;" class="showintr">&nbsp;</p>
		</div>
        <div id="emitotalinterest" class="showintr" style="background-color:#e6e6e6;"><h4 class="showintr">Total Interest Amount</h4><p style="font-size:12px;" class="showintr">Rs. <span><?php echo number_format(round($tot_interest)); ?></span></p>
          <p style="font-size:12px;" class="showintr">&nbsp;</p>
        </div>
        <div id="emitotalamount" class="showintr" style="background-color:#e6e6e6;"><h4 class="showintr">Total Amount<br/>(Principal + Interest)</h4><p style="font-size:12px;" class="showintr">Rs. <span><?php echo number_format(round($tot_amount)); ?></span></p></div>
    </div>

</div>

  </td></tr>
  
  </table>
  
  </div>
  <div id="mainContent" style="padding-top:6px; padding-bottom:60px; " >
  <form  method="POST" action="hdfc-car-loan-app-continue5.php" name="loan_form"  onSubmit="return submitform(document.loan_form);" >
   <input type="hidden" name="last_inserted_id" id="last_inserted_id" value="<?php echo $last_inserted_id; ?>" readonly="readonly" />
  <input type="hidden" name="pay" id="pay" value="<?php echo round($pay); ?>" />
  <input type="hidden" name="tot_interest" id="tot_interest" value="<?php echo round($tot_interest); ?>" />
  <input type="hidden" name="tot_amount" id="tot_amount" value="<?php echo round($tot_amount); ?>" />
<table cellpadding="0" cellspacing="0" border="0">
<tr><td class="text9" colspan="2" style="padding-left:5px; padding-bottom:4px;"><div style=" color:#333333; padding-bottom:4px;border-bottom:#000000 2px solid;width:585px;"><span  > Additional details</span></div> </td></tr>
<tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Make & model of car</td>
      </tr><tr>
    <td width="375"><input name="car_name" id="car_name" type="text"  style="width:250px;" class="inputtext" value="<?php echo $Car_Model; ?>" readonly="readonly" /></td></tr></table>
   </td>
	<td>&nbsp; </td>
</tr>
<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" colspan="2" >
Select one document in each section below that you will provide as proof</td></tr>
<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" colspan="2" >
	<table width="553" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td width="143" align="left" valign="top" class="text8">Proof of Income</td>
	<td width="410" ><select name="Income_Proof" id="Income_Proof" style="width:210px;" >
    <option value="">Select</option>
    <option value="Latest ITR">Latest ITR</option>
    <option value="Form 16">Form 16</option>
    <option value="Salary ceritificate for last 3 months">Salary ceritificate for last 3 months</option>
    <option value="Pay slip - last 3 months">Pay slip - last 3 months</option>
</select>
</td>
</tr>

</table>
	</td>
</tr>
<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" colspan="2" >
	<table width="553" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td width="143" align="left" valign="top" class="text8">Proof of Address</td>
	<td width="410" >
    <select name="Address_Proof" id="Address_Proof" style="width:210px;">
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
	</select>
</td>
</tr>

</table>
	</td>
</tr>
<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" colspan="2" >
	<table width="553" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td width="143" align="left" valign="top" class="text8">Proof of Identity</td>
	<td width="410" ><select name="Identity_Proof" id="Identity_Proof"  style="width:210px;">
        <option value="">Select</option>
        <option value="Passport">Passport</option>
        <option value="Election ID card">Election ID card</option>
        <option value="Driving License">Driving License</option>
        <option value="Photo Credit/Debit/ATM Card">Photo Credit/Debit/ATM Card</option>
        <option value="Government organisation ID card with signature and photo">Government organisation ID card with signature and photo</option>
        <option value="PAN Card">PAN Card</option>
        <option value="Company ID card">Company ID card</option>
        <option value="Insurance / Mediclaim Photo Card">Insurance / Mediclaim Photo Card</option>
        <option value="Ration Card">Ration Card</option>
        <option value="Home property papers (registered deed">Home property papers (registered deed</option>
        <option value="Registration certificate (RC) of vehicle in applicant's name">Registration certificate (RC) of vehicle in applicant's name</option>
	</select>
	</td>
	</tr>
	</table>
</td>
</tr>
<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" colspan="2" >
	<table width="553" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td width="143" align="left" valign="top" class="text8">Bank Statement</td>
	<td width="410">
    <select name="Bank_Statement" id="Bank_Statement"  style="width:210px;" >
    <option value="">Select</option>
    <option value="Salary account bank statement - last 6 months">Salary account bank statement - last 6 months</option>
	</select>
    </td>
    </tr>
    </table>
	</td>
</tr>


<tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:45px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" align="left" style="padding-left:6px;" >
<input class="design2" type="submit" name="Submit" value=">> SUBMIT "   />    
   </td>
	<td>&nbsp; </td>
</tr>
</table>
</form>
</div>
<br class="clearfloat" />
<div id="footer">
</div>
</div>
</body>
</html>