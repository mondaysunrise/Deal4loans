<? 
require 'scripts/db_init.php';
require 'scripts/functions.php';

	$last_inserted_id = $_POST['last_inserted_id'];
	$pay = $_POST['pay'];
	$tot_amount = $_POST['tot_amount'];;
	$tot_interest = $_POST['tot_interest'];;

	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$Pancard = $_POST['Pancard'];
	$City = $_POST['City'];
	$dd = $_POST['dd'];
	$mm = $_POST['mm'];
	$yyyy = $_POST['yyyy'];
 	$DOB = $yyyy."-".$mm."-".$dd;
	$residence_address = $_POST['residence_address'];
	$residence1_address = $_POST['residence1_address'];
	$residence = $residence_address.", ".$residence1_address;
	$pincode = $_POST['pincode'];
	$home_phone_std = $_POST['home_phone_std'];
	$home_phone = $_POST['home_phone'];
	
	$getDataSql = "Select * from hdfc_car_loan_leads where RequestID = '".$last_inserted_id."'";
	list($getDatanumRewards,$getDataQuery)=MainselectfuncNew($getDataSql,$array = array());

	$getName = $getDataQuery[0]['Name'];
	if(strlen($Name)>0) { } else { $Name = $getName ;}
	$getPhone = $getDataQuery[0]['Mobile_Number'];
	if(strlen($Phone)>0) { } else { $Phone = $getPhone ;}
	$getEmail = $getDataQuery[0]['Email'];
	if(strlen($Email)>0) { } else { $Email = $getEmail ;}
	$getCity = $getDataQuery[0]['City'];
	if(strlen($City)>0) { } else { $City = $getCity ;}


	
	$Company_Name = $getDataQuery[0]['Company_Name'];
	$Net_Salary = $getDataQuery[0]['Net_Salary'];

	$dataUpdate = array('Name'=>$Name, 'Mobile_Number'=>$Phone, 'Email'=>$Email, 'City'=>$City, 'DOB'=>$DOB, 'Pancard'=>$Pancard, 'Residence_Address'=>$residence, 'Residence_Pincode'=>$pincode, 'Resi_Std'=>$home_phone_std, 'Resi_Telephone'=>$home_phone);
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

function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
		
	if(Form.Net_Salary.value=="" || Form.Net_Salary.value=="0")
	{
		alert("Please enter Annual income to Continue");
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
  <form  method="POST" action="hdfc-car-loan-app-continue4.php" name="loan_form"  onSubmit="return submitform(document.loan_form);" >
 <input type="hidden" name="last_inserted_id" id="last_inserted_id" value="<?php echo $last_inserted_id; ?>" readonly="readonly" />
  <input type="hidden" name="pay" id="pay" value="<?php echo round($pay); ?>" />
  <input type="hidden" name="tot_interest" id="tot_interest" value="<?php echo round($tot_interest); ?>" />
  <input type="hidden" name="tot_amount" id="tot_amount" value="<?php echo round($tot_amount); ?>" />
  <table cellpadding="0" cellspacing="0" border="0">
<tr><td class="text9" colspan="2" style="padding-left:5px; padding-bottom:4px;"><div style=" color:#333333; padding-bottom:4px;border-bottom:#000000 2px solid;width:585px;"><span  > Your occupational details</span></div> </td></tr>
<tr >
	<td class="text8" >
     <table width="275" border="0" >
      <tr><td width="275" class="text8">Annual Income</td>
      </tr><tr>
    <td width="275"><input name="Net_Salary" id="Net_Salary" type="text" style="width:250px;" class="inputtext" value="<?php echo $Net_Salary; ?>" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td></tr></table>
   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">Company</td>
      </tr>
      
      <tr>
    <td width="275"><input name="Company_Name" id="Company_Name" type="text"  style="width:250px;" class="inputtext"  value="<?php echo $Company_Name; ?>" readonly="readonly" ></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" ><table width="275" border="0" >
      <tr><td width="275" class="text8">Primary Account in which bank?</td>
      </tr><tr>
    <td width="275"><input type="text"  style="width:250px;" name="Primary_Acc" id="Primary_Acc" class="inputtext" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event,'http://www.deal4loans.com/ajax-list-bankname.php'); " ></td></tr></table>
   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">Credit Card</td>
      </tr><tr>
    <td width="275" class="text8">
     <input type="radio" name="CC_Holder" id="CC_Holder" value="1" style="border:none;" /> Yes   <input type="radio" name="CC_Holder" id="CC_Holder" value="0" style="border:none;" /> No
    </td></tr></table></td>
</tr>
<tr><td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Office Address Line 1</td>
      </tr><tr>
    <td width="375"><input name="off_address" id="off_address" type="text" class="inputtext" style="width:250px;" /></td></tr></table>
   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">Office Address Line 2</td>
      </tr><tr>
    <td width="275"><input name="off1_address" id="off1_address" type="text" class="inputtext" style="width:250px;" /></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Pincode</td>
      </tr><tr>
    <td width="375"><input name="pincode_o" id="pincode_o" type="text" style="width:250px;" maxlength="6" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td></tr></table>
   </td>
	<td>  <table width="275" border="0" >
      <tr><td width="275" class="text8">Office Telephone</td>
      </tr><tr>
    <td width="275"><input style="width:50px; "  name="office_std" id="office_std" value="Std" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;<input class="inputtext" style="width:110px; "  name="office_phone" id="office_phone" value="Number" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;<input style="width:50px; " class="inputtext"  name="office_ext" id="office_ext" value="Ext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td></tr></table></td>
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