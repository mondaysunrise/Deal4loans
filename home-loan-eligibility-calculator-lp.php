<?php
ob_start( 'ob_gzhandler' );
require 'scripts/functions.php';
require 'scripts/db_init.php';
require 'scripts/home_loan_eligibility_function.php';
session_start();

function DetermineAgeFromDOB ($YYYYMMDD_In){  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;  if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }
$maxage=date('Y')-62;
$minage=date('Y')-18;
/*
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$Net_Salary = $_POST['Net_Salary'];
	$getnetAmount = ($Net_Salary /12);
	$loan_amount = $_POST['Loan_Amount'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$dateofbirth = $year."-".$month."-".$day;
	$dateofbirth = 
	$DOB = str_replace("-","", $dateofbirth);
	$age = DetermineAgeFromDOB($DOB);
	$total_obligation = $_POST['total_obligation'];
	$netAmount=($getnetAmount - $total_obligation);
	$strCity = "Delhi";
	$property_value = $_POST['Property_Value'];
	$_SESSION['property_value'] = $property_value;
	$_SESSION['loan_amount'] = $loan_amount;
	$_SESSION['Net_Salary'] = $Net_Salary;
	$_SESSION['day'] = $day;
	$_SESSION['month'] = $month;
	$_SESSION['year'] = $year;
	$_SESSION['total_obligation'] = $total_obligation;
}
function money_F($number)
{
	setlocale(LC_ALL, 'en_IN');
 	$strnumber=money_format('%i', $number);
	list($First_num,$Last_num) = split('[ ]', $strnumber);
	$money_strnum = substr(trim($Last_num), 0, strlen(trim($Last_num))-3);
	$getmoney_term[]= $money_strnum;
	return($getmoney_term);
}
*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home Loan Eligibility Calculator </title>
<META NAME="ROBOTS" CONTENT="NOINDEX, FOLLOW">
<link href="css/home-loan-eligibility-calculator-lp-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript">
function containsdigit(param){	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{	if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))	{	return true;	}	} }
function Trim(strValue) {var j=strValue.length-1;i=0;while(strValue.charAt(i++)==' ');while(strValue.charAt(j--)==' ');return strValue.substr(--i,++j-i+1);}
function cityother(){	if(document.homeloan_calculator.City.value=="Others")	{		document.homeloan_calculator.City_Other.disabled = false;	}	else	{		document.homeloan_calculator.City_Other.disabled = true;	} } 
function validmobile(mobile) 
{		atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{		alert("Mobile number cannot start with 0.");		return false;	}
	if(!checkData(document.homeloan_calculator.Phone, 'Mobile number', 10))
		return false;
return true;
}

function Decorate(strPlan)
{
	if (document.getElementById('plantype2') != undefined) { 
		document.getElementById('plantype2').innerHTML = strPlan; 
		document.getElementById('plantype2').style.background='Beige'; 
	}
	return true;
}
function Decorate1(strPlan)
{
	if(document.getElementById('plantype2') != undefined){               
		document.getElementById('plantype2').innerHTML = strPlan;			   
		document.getElementById('plantype2').style.background='';  			                          
	}
	return true;
}

function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}

function checkhlcalc()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(document.homeloan_calculator.Property_Value.value=="" || document.homeloan_calculator.Property_Value.value=="e.g. 1000000")
	{
		alert("Please enter property value!");
		document.homeloan_calculator.Property_Value.focus();
		return false;
	}
	if (document.homeloan_calculator.Employment_Status.selectedIndex==0)
	{
		alert("Please select your occupation!");
		document.homeloan_calculator.Employment_Status.focus();
		return false;
	}
	if (document.homeloan_calculator.Net_Salary.value=="" || document.homeloan_calculator.Net_Salary.value=="e.g. 10 lacs")
	{
		alert("Please enter Annual Income!");
		document.homeloan_calculator.Net_Salary.focus();
		return false;
	}	
	if (document.homeloan_calculator.City.selectedIndex==0 || document.homeloan_calculator.City.value=="")
	{
		alert("Please select city to continue!");
		document.homeloan_calculator.City.focus();
		return false;
	}
	
	//addPersonalDetails();
	if((document.homeloan_calculator.Name.value=="") || (document.homeloan_calculator.Name.value=="Full Name") || (Trim(document.homeloan_calculator.Name.value))==false)
	{
		alert("Please enter your name!");
		document.homeloan_calculator.Name.focus();
		return false;
	}
	/*
	if(document.homeloan_calculator.Name.value!="")
	{
		if(containsdigit(document.homeloan_calculator.Name.value)==true)
		{
			alert("Please enter first name contains numbers!");
			document.homeloan_calculator.Name.focus();
			return false;
		}
	}
	for (var i = 0; i <document.homeloan_calculator.Name.value.length; i++) 
	{
		if (iChars.indexOf(document.homeloan_calculator.Name.value.charAt(i)) != -1) 
		{
			alert("Contains special characters!");
			document.homeloan_calculator.Name.focus();
			return false;
		}
	}
	*/
	if(document.homeloan_calculator.Phone.value=="" || document.homeloan_calculator.Phone.value=="0000000000")
	{
		alert("Fill Mobile Number!");
		document.homeloan_calculator.Phone.focus();
		return false;
	}
	if(isNaN(document.homeloan_calculator.Phone.value)|| document.homeloan_calculator.Phone.value.indexOf(" ")!=-1)
	{
		alert("Enter numeric value!");
		document.homeloan_calculator.Phone.focus();
		return false;  
	}
	if (document.homeloan_calculator.Phone.value.length < 10 )
	{
		alert("Enter 10 Digits!");
		document.homeloan_calculator.Phone.focus();
		return false;
	}
	if ((document.homeloan_calculator.Phone.value.charAt(0)!="9") && (document.homeloan_calculator.Phone.value.charAt(0)!="8") && (document.homeloan_calculator.Phone.value.charAt(0)!="7"))
	{
		alert("Should start with 9 or 8 or 7!");
		document.homeloan_calculator.Phone.focus();
		return false;
	}
	
	if(document.homeloan_calculator.Email.value=="" || document.homeloan_calculator.Email.value=="abc@xyz.com")
	{
		alert("Enter Email Address!");
		document.homeloan_calculator.Email.focus();
		return false;
	}
	
	var str=document.homeloan_calculator.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		alert("Enter Valid Email Address!");
		document.homeloan_calculator.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Enter Valid Email Address!");
		document.homeloan_calculator.Email.focus();
		return false;
	}
	if(!document.homeloan_calculator.accept.checked)
	{
		alert("Read and Accept Terms & Conditions!");
		document.homeloan_calculator.accept.focus();
		return false;
	}
	return true;
}

function addPersonalDetails(){
	//alert("Hi");
	document.getElementById("calculate_btn_one").style.display='none';
	document.getElementById("personal_details_area").style.display='block';
}

function getDOB(age){
	
	var date = new Date();
	var current_year = date.getFullYear();
	var dob_year = current_year - age;
	//alert(dob_year);
	document.getElementById("year").value=dob_year;
}
</script>

<style type="text/css">
body{ padding:0px 0px 0px 0px; margin:0px 0px 0px 0px; background:url(images/body-bg-hl-eligibility-calculator.jpg) repeat;}
</style>
</head>
<body>
<div class="header-hl_ec">
<div class="header">
<div class="logo_hlec"><img src="images/d4l-logo-new-home-loan.png" width="152" height="65" alt="Logo"></div>
<div class="topnumbers_bx"><strong style="color:#f76d07; font-size:28px;">53,</strong><strong style="color:#239d9e; font-size:28px;">50,</strong><strong style="color:#ffa308; font-size:28px;">642</strong> quotes taken till now</div>
</div>
</div>
<div class="banner_a">
<div class="banner_b">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <th scope="row">&nbsp;</th>
      <td>&nbsp;</td>
      <td valign="bottom">&nbsp;</td>
    </tr>
    <form name="homeloan_calculator" method="post" action="apply-home-loans-calc-continue1.php" onSubmit="return checkhlcalc();">
    <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <input type="hidden" name="Activate" id="Activate">
    <input type="hidden" name="source" value="Calc Display">
    <tr>
      <th width="11%" valign="top" scope="row" class="image_show_hide"><img src="images/hand-bag.png" width="108" height="113"></th>
      <td width="75%" class="tablw_widht" valign="top">
      <p>Calculate My eligibility from 5 Nationalized & 7 Private Banks where </p>
      <p><div class="colum1">Value of My Property is 
      <input type="text" name="Property_Value" id="Property_Value" maxlength="8" class="input" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Property_Value','formatedPropVal','wordPropertyValue');" onFocus="if(this.value=='e.g. 1000000'){ this.value=''; }" onBlur="if(this.value==''){ this.value='e.g. 1000000'; } getDigitToWords('Property_Value','formatedPropVal','wordPropertyValue');" value="e.g. 1000000" />
     <div class="clearfix_div"></div>
     <div class="error_display">
         <span id='formatedPropVal' style='font-size:11px; font-weight:normal; font-Family:Verdana;'></span>
         <span id='wordPropertyValue' style='font-size:11px; font-weight:normal; font-Family:Verdana;text-transform:capitalize;'></span>
     </div>
     </div>
            
     <div class="colum2"> My Occupation is <select name="Employment_Status" id="Employment_Status" onChange="validateDiv('empStatusVal');" class="select">
          <option value="-1">Please Select</option>
          <option value="1">Salaried</option>
          <option value="0">Self Employed</option>
      </select>
      </div>
      <div class="clearfix_div"></div>
      
      <p> 
      <div class="wrapper_second-new">
      <div class="colum3">
      My Annual Income is 
      <input name="Net_Salary" id="Net_Salary" maxlength="8" onKeyUp="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onFocus="if(this.value=='e.g. 10 lacs'){ this.value=''; }" onKeyPress="intOnly(this);" onBlur="if(this.value==''){ this.value='e.g. 10 lacs'; } getDigitToWords('Net_Salary','formatedIncome','wordIncome');" value="e.g. 10 lacs" class="input" />
     
     <div class="clearfix_div"></div>
      <div class="error_display">

      <span id='formatedIncome' style='font-size:11px; font-weight:normal; font-Family:Verdana;'></span>
      <span id='wordIncome' style='font-size:11px; font-weight:normal; font-Family:Verdana;text-transform: capitalize;'></span> 
     
      </div>     
      </div>
	  <div class="colum4">& I live in <select name="City" id="City" class="select" onChange="addPersonalDetails();"><?=getCityList($City)?></select></div>
      </div>  
      </p>
	 
      <div class="clearfix_div"></div>
      <p id="calculate_btn_one"><a href="javascript: void(0);" onClick="checkhlcalc();"><img src="images/calculate-now-bluebtn.png" height="41" width="168" /></a></p>
      
      <div id="personal_details_area" style="display:none;">      
      <p style="font-size:12px;"><img src="images/lock-image.png" width="9" height="13"> We keep your personal information secure </p>
      <p> 
      <div class="wrapper_third-new">
	    <div class="colum5"> I <input name="Name" id="Name" type="text" class="input_name" value="Full Name" onFocus="if(this.value=='Full Name'){ this.value=''; }" onBlur="if(this.value==''){ this.value='Full Name'; }" /></div> 
      </div>
      <div class="colum6"> want Complete details at My Contact Number +91 <input type="text" name="Phone" id="Phone" class="input_name" maxlength="10" value="0000000000" onFocus="if(this.value=='0000000000'){ this.value=''; }" onBlur="if(this.value==''){ this.value='0000000000'; }" /> </div>
       </p>
       <div class="clearfix_div"></div>
       <p>and My E-mail Id <input name="Email" id="Email" type="text" class="input" value="abc@xyz.com" onFocus="if(this.value=='abc@xyz.com'){ this.value=''; }" onBlur="if(this.value==''){ this.value='abc@xyz.com'; }" /></p>
       <p>My age is <select id="Age" name="Age" class="select-age" onChange="getDOB(this.value)">
       <?php
	   for($age=23;$age<=70;$age++){
	   		echo "<option value=".$age.">".$age."</option>";
	   }
	   ?>
       </select> 
       <input type="hidden" id="day" name="day" value="<?php echo date('d'); ?>" /><input type="hidden" id="month" name="month" value="<?php echo date('m'); ?>" /><input type="hidden" id="year" name="year" value="" />
       and my Total EMI of All Loans <input type="text" name="total_obligation" id="total_obligation" value="" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);" class="input" onKeyDown="validateDiv('obligationVal');" />
       </p>
       <p style="font-size:11px;"> <input name="accept" type="checkbox" checked />I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms and Conditions</a>.</p>
       <p><input name="calculate" type="image" src="images/calculate-now-bluebtn.png" height="41" width="168"></p>
       </div>
      </td>
      <td width="14%" align="right" valign="bottom" class="td"><img src="images/hand-bag2.png" width="140" height="96" class="image_show_hide"></td>
    </tr>
    </form>
  </table>
<div class="clearfix_div"></div>
</div>
</div>
<div class="second_wrapper">
<h1>List of top Home Loans Banks in India</h1>
<div class="sbi_text">SBI (State Bank of India),</div>
<div class="sbi_text" style="color:#da251c; border-bottom:#da251c thick solid;">Hdfc Ltd,</div>
<div class="sbi_text" style="color:#1a5b9b; border-bottom:#1a5b9b thick solid;">LIC Housing,</div>
<div class="sbi_text" style="color:#1a5b9b; border-bottom:#0b2e6f thick solid;">ICICI Bank,</div>
<div class="sbi_text" style="color:#aa2a5d; border-bottom:#aa2a5d thick solid;">Axis Bank,</div>
<div class="sbi_text" style="color:#1c689a; border-bottom:#1c689a thick solid;">Bajaj Finserv,</div>
<div class="sbi_text" style="color:#951e3e; border-bottom:#951e3e thick solid;">PNB Home Finance,</div>
<div class="sbi_text" style="color:#027861; border-bottom:#027861 thick solid;">IDBI </div>
<div class="clearfix_div" style="height:15px;"></div>
<div class="sbi_text" style="color:#007838; border-bottom:#007838 thick solid;">India Bulls,</div>
<div class="sbi_text" style="color:#234090; border-bottom:#234090 thick solid;">DHFL,</div>
<div class="sbi_text" style="color:#054a9e; border-bottom:#f4a321 thick solid;">Federal Bank</div>
</div>
<div class="clearfix_div"></div>
<div class="bottom"><a href="http://www.deal4loans.com/" target="_blank">Home</a> | <a href="http://www.deal4loans.com/About_Us.php" target="_blank">About Us</a> | <a href="http://www.deal4loans.com/mediarelease.php" target="_blank">Media coverage</a> | <a href="http://www.deal4loans.com/Contact_Us.php" target="_blank">Contact us</a> 
<div style="font-size:11px; margin-top:5px;">Disclaimer: All loans repayment period are over 6 months. No short term loans</div>
</div>

</body>
</html>