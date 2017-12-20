<? 
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_POST);

	$hdfc_carprice = round($_POST['hdfc_carprice']);
	$Loan_Amt = $_POST['Loan_Amt'];
	$loan_intr = $_POST['loan_interest'];
	$loan_interest = $_POST['loan_interest'] / 1200;
	$max_tenure = $_POST['max_tenure'] * 12;
	$tenure = $_POST['max_tenure']; 

	$pay = $Loan_Amt * $loan_interest / (1 - (pow(1/(1 + $loan_interest), $max_tenure)));
 	$tot_amount = $pay * $max_tenure;
	$tot_interest = $tot_amount - $Loan_Amt;


	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$Company_Name = $_POST['Company_Name'];
	$City = $_POST['City'];
	$Annual_Salary = $_POST['Annual_Salary'];
	$dd = $_POST['dd'];
	$mm = $_POST['mm'];
	$yyyy = $_POST['yyyy'];
	$Car_Model = $_POST['Car_Model'];
	$DOB = $yyyy."-".$mm."-".$dd;
	$Loan_Amount = $Loan_Amt;
	$Source = "hdfc_car_loan";
	$IP = getenv("REMOTE_ADDR");
	//$Employment_Status = $_POST['Employment_Status'];
	$Employment_Status = 1;
	$Reference_Code = generateNumber(4);
	$app_code = date('dmy')."".$Reference_Code;
	
	
	$Dated = ExactServerdate();	
	$data = array('Name'=>$Name, 'Mobile_Number'=>$Phone, 'Email'=>$Email, 'City'=>$City, 'DOB'=>$DOB, 'Net_Salary'=>$Annual_Salary, 'Company_Name'=>$Company_Name, 'Dated'=>$Dated, 'IP'=>$IP, 'Source'=>$Source, 'Loan_Amount'=>round($Loan_Amount), 'Car_Model'=>$Car_Model, 'Car_Price'=>$hdfc_carprice, 'intr_rate'=>$loan_intr, 'Tenure'=>$tenure, 'Employment_Status'=>$Employment_Status, 'AppID'=>$app_code);
	$last_inserted_id = Maininsertfunc ('hdfc_car_loan_leads', $data);
	
//	echo "<br>dfdsfds - ".$last_inserted_id."<br>";
	//echo $insertSQl;
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

function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")	{	alert("Invalid E-mail ID.");	return false;		}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 	{	return false;	}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 	{	alert("Invalid E-mail ID.");	return false;	}
	if (email1.indexOf("@",atPos+1) != -1) 	{ 	alert("Invalid E-mail ID.");	return false;	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 	{ 	alert("Invalid E-mail ID.");	return false;	}
	if (periodPos+3 > email1.length)		{		alert("Invalid E-mail ID.");	return false;	}
	return true;
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
	
	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
	{
		alert("Kindly fill in your Name!");
		Form.Name.select();
		return false;
	}
	else if(containsdigit(Form.Name.value)==true)
	{
		alert("Name contains numbers!");
		Form.Name.select();
		return false;
	}
	for (var i = 0; i < Form.Name.value.length; i++) {
		if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
			alert ("Name has special characters.\n Please remove them and try again.");
			Form.Name.select();
			return false;
		}
	  }
	
	if(Form.Phone.value=="")
	{
		alert("Please Enter Mobile Number");
		Form.Phone.focus();
		return false;
	}

	if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
	{
		  alert("Enter numeric value");
		  Form.Phone.focus();
		  return false;  
	}
	if (Form.Phone.value.length < 10 )
	{
			alert("Please Enter 10 Digits"); 
			 Form.Phone.focus();
			return false;
	}

	if (Form.Phone.value.charAt(0)!="9" && Form.Phone.value.charAt(0)!="8" && Form.Phone.value.charAt(0)!="7")
	{
			alert("The number should start only with 9 or 8");
			Form.Phone.focus();
			return false;
	}
	
	if(Form.Email.value=="")
	{
		alert("Please enter  Email Address");
		Form.Email.focus();
		return false;
	}
	if(Form.Email.value!="")
	{
		if (!validmail(Form.Email.value))
		{
			//alert("Please enter your valid email address!");
			Form.Email.focus();
			return false;
		}	
	}
	
	
	if(Form.dd.value=="" ||  Form.dd.value=="DD")
	{
		alert("Please fill your day of birth.");
		Form.dd.focus();
		return false;
	}
	if(Form.dd.value!="")
	{
		if((Form.dd.value<1) || (Form.dd.value>31))
		{
			alert("Kindly Enter your valid Date of Birth(Range 1-31)");
			Form.dd.focus();
			return false;
		}
	}
	
	if(Form.mm.value=="" || Form.mm.value=="MM")
	{
		alert("Please fill your month of birth.");
		Form.mm.focus();
		return false;
	}
	if(Form.mm.value!="")
	{
		if((Form.mm.value<1) || (Form.mm.value>12))
		{
			alert("Kindly Enter your valid Month of Birth(Range 1-12)");
			Form.mm.focus();
			return false;
		}
	}
	
	if(Form.yyyy.value=="" || Form.yyyy.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		Form.yyyy.focus();
		return false;
	}
	if(Form.yyyy.value!="")
	{
		if(Form.yyyy.value > parseInt(mdate-18) || Form.yyyy.value < parseInt(mdate-62))
		{
			alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
			Form.yyyy.focus();
			return false;
		}
	}


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
		alert("Kindly fill in your Pincode!");
		Form.pincode.focus();
		return false;
	}

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
  <form  method="POST" action="hdfc-car-loan-app-continue3.php" name="loan_form"  onSubmit="return submitform(document.loan_form);" >
  <input type="hidden" name="last_inserted_id" id="last_inserted_id" value="<?php echo $last_inserted_id; ?>" readonly="readonly" />
  <input type="hidden" name="pay" id="pay" value="<?php echo round($pay); ?>" />
  <input type="hidden" name="tot_interest" id="tot_interest" value="<?php echo round($tot_interest); ?>" />
  <input type="hidden" name="tot_amount" id="tot_amount" value="<?php echo round($tot_amount); ?>" />
  <table cellpadding="0" cellspacing="0" border="0">
  <tr><td class="text9" colspan="2" style="padding-left:5px; padding-bottom:4px;"><div style=" color:#333333; padding-bottom:4px;border-bottom:#000000 2px solid;width:585px;"><span  > Your personal details</span></div> </td></tr>
   <tr>
	<td width="325"  class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Name</td>
      </tr><tr>
    <td width="375"><input type="text" name="Name" id="Name" style="width:250px;" class="inputtext" value="<?php echo $Name; ?>" /></td></tr></table>
   </td>
	<td width="325"> <table width="275" border="0" >
      <tr><td width="275" class="text8">Mobile No.</td>
      </tr><tr>
    <td width="275"><input type="text" name="Phone" id="Phone" class="inputtext" style="width:250px; height:20px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $Phone; ?>" /></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
 <tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Email</td>
      </tr><tr>
    <td width="375"><input type="text" name="Email" id="Email" class="inputtext" style="width:250px; height:20px;" value="<?php echo $Email; ?>" /></td></tr></table>
   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">City</td>
      </tr><tr>
    <td width="275"><input type="text" name="City" id="City" class="inputtext" style="width:250px; height:20px;" value="<?php echo $City; ?>" readonly="readonly" /></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr>
        <td width="325" class="text8">DOB</td>
      </tr><tr>
    <td width="375"><input name="dd" id="dd" type="text" size="4" maxlength="2" class="inputtext" value="<?php echo $dd; ?>" onblur="onBlurDefault(this,'DD');" onfocus="onFocusBlank(this,'DD');"/ onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">	/ <input name="mm" id="mm" type="text" size="4" maxlength="2" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $mm; ?>" onblur="onBlurDefault(this,'MM');" onfocus="onFocusBlank(this,'MM');"/>  / <input name="yyyy" id="yyyy" type="text" size="7" maxlength="4" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="<?php echo $yyyy; ?>" onblur="onBlurDefault(this,'YYYY');" onfocus="onFocusBlank(this,'YYYY');"/></td></tr></table>
   </td>
	<td>
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Pancard No</td>
      </tr><tr>
    <td width="375"><input name="Pancard" id="Pancard" type="text" class="inputtext" style="width:250px;" maxlength="10" /></td></tr></table>
  </td>
</tr>
<tr><td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Resi Address Line 1</td>
      </tr><tr>
    <td width="375"><input name="residence_address" id="residence_address" type="text" class="inputtext" style="width:250px;" /></td></tr></table>
   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">Resi Address Line 2</td>
      </tr><tr>
    <td width="275"><input name="residence1_address" id="residence1_address" type="text" class="inputtext" style="width:250px;" /></td></tr></table></td>
</tr>
 <tr >	<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; height:15px;" >&nbsp;</td></tr>
<tr >
	<td class="text8" >
    <table width="325" border="0" >
      <tr><td width="325" class="text8">Pincode</td>
      </tr><tr>
    <td width="375"><input name="pincode" id="pincode" type="text" style="width:250px;" maxlength="6" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td></tr></table>
   </td>
	<td> <table width="275" border="0" >
      <tr><td width="275" class="text8">Resi Telephone</td>
      </tr><tr>
    <td width="275"><input style="width:50px; "  name="home_phone_std" id="home_phone_std" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;<input style="width:180px; " class="inputtext" name="home_phone" id="home_phone" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td></tr></table></td>
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