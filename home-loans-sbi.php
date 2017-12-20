<?php
//header("Location: home-loans.php");
//exit();
ob_start( 'ob_gzhandler' );
	require 'scripts/functions.php';
	session_start();
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
 <title>SBI Home Loan</title>
<meta name="keywords" content="SBI Bank, Documents for SBI Home Loan, EMI of SBI home Loan, SBI Loans, Home Loan SBI, SBI Home Loans, SBI Home Loan Documents">
<meta name="robots" content="noindex,nofollow" />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/sbi-home-loan-styles.css" type="text/css" rel="stylesheet" />
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>
<style type="text/css">
<!--
.style1 {font-family: 'Droid Sans', sans-serif}
.style2 {font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);font-family: 'Droid Sans', sans-serif;}
-->
</style>
<script src='/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<Script Language="JavaScript">


function getEligibleBidders()
{

	var bank_name_all = document.loan_form.bank_name_all.value;
	if(document.loan_form.bank_name_all.checked)
	{
		chkvaluer=document.loan_form.elements['bank_name[]'];
		for (r=0;r<chkvaluer.length;r++)
		{
			chkvaluer[r].disabled = true;
		}
	} else
	{
		chkvaluer=document.loan_form.elements['bank_name[]'];
		for (r=0;r<chkvaluer.length;r++)
		{
			chkvaluer[r].disabled = false;
		}
		//document.health_insurance_form.txtmusic.disabled = false;
	}
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
function cityother()
{
	if(document.loan_form.City.value=="Others")
	{
		document.loan_form.City_Other.disabled = false;
	}
	else
	{
		document.loan_form.City_Other.disabled = true;
	}
} 
function validmobile(mobile) 
{
	
	atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.loan_form.Phone, 'Mobile number', 10))
		return false;

return true;
}

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function chkform()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
//var i;
var cnt;
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
	}

	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.loan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.loan_form.Name.focus();
			return false;
		}
  }
	
	if(document.loan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.loan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.loan_form.Phone.focus();
		return false;  
	}
	if (document.loan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
		
	if(document.loan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
/*		if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.loan_form.City_Other.focus();
  		return false;
  	}
  }
*/
	
	if (document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	
	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms and Condition!</span>";	

		document.loan_form.accept.focus();
		return false;
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

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
	var otrcit = document.loan_form.City_Other.value;
	//alert(cit);	
	if(cit =="Ahmedabad" || otrcit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}


function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
</script>
<Script Language="JavaScript">
var ajaxRequestMain;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequestMain = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

		function insertData()
		{
			var get_full_name = document.getElementById('Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="2";

				var queryString = "?get_Mobile=" + get_mobile_no +"&get_City=" + get_city + "&get_Full_Name=" + get_full_name +"&get_Email=" + get_email +"&get_product=" + get_product +"&get_Id=" + get_id ;
				
				//alert(queryString); 
				ajaxRequestMain.open("GET", "insert-incomplete-data.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequestMain.onreadystatechange = function(){
					if(ajaxRequestMain.readyState == 4)
					{
						document.getElementById('Activate').value=ajaxRequestMain.responseText;
					}
				}

				ajaxRequestMain.send(null); 
			 
		}

	window.onload = ajaxFunctionMain;

</script>
</head>
<body>
<div class="sbi-hl_header"><div style="position:absolute; top:0px; left:0px; width:100%; height:30px; background-image:url(images/top_bg.gif); background-position:center top; z-index:1;">

<div style="width:970px; height:auto; margin:auto;">

<div class="text4" style="width:600px; height:auto; float:left; padding-left:260px; margin-top:10px; clear:right;">

</div>
<div class="text4" style="width:101px; height:auto; float:right; margin-left:; margin-top:5px; clear:right;"></div>
</div>
</div>
<div style="margin:auto; width:970px; height:105px; padding-top:28px;">
<div style="float:left; clear:right; width:243px; height:94px;"><a href="http://www.deal4loans.com/index.php"><img src="images/logo.gif" width="243" height="90" border="0" /></a></div>
<div style="float:left; clear:right; width:714px; height:94px; margin-top:13px; text-align:right;">
<div style="float:right; clear:right;  width:240px; height:37px; ">
  &nbsp;
 </div>

</div>
<div class="line_ad" style="margin:auto; width:970px; height:3px;  margin-top:1px;"><img src="images/point6.gif" width="970" height="3" /></div>
</div>

</div>

</div>
 


<div class="sbi-hl_wraper_box">
<div class="sbi-hl_logo"><img src="images/logo.gif" width="243" height="90" /></div>
<div style="clear:both;"></div>

<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loan-banks.php"  class="text12" style="color:#4c4c4c;">Compare Home loan Banks</a></u> >  <span  class="text12" style="color:#4c4c4c;"> Home Loan from SBI</span></div>

<div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;">

<div class="sbi-hl_left_box">
<div class="sbi-hl_headin_title">SBI Home Loan</div>
<div><span class="text11" style="color:#4c4c4c; ">Most Preferred Home Loan provider SBI Bank  offers a&nbsp;<a href="http://www.deal4loans.com/home-loans.php" title="Home Loan">Home Loan</a>&nbsp;with Attractive Interest Rates with Latest  Schemes and Benefits.&nbsp;SBI&nbsp;also  provides a&nbsp;<a href="http://www.deal4loans.com/home-loans.php" title="Housing loan">Housing loan</a>&nbsp;with different schemes - <br />
 SBI       Easy Home Loan &nbsp; <b>|</b> &nbsp; SBI Advantage Home Loan &nbsp; <b>|</b> &nbsp; SBI Home Plus &nbsp; <b>|</b> &nbsp;  SBI MY HOME CAMPAIGN &nbsp; <b>|</b> &nbsp;SBI Housing Finance Scheme
<p><strong>Features &amp; Benefits of&nbsp;SBI Home Loan</strong><br />
  • Purchase/ Construction of House/ Flat.<br />
  • Purchase of a plot of land for construction of House.<br />
  • Lowest&nbsp;<a href="http://www.deal4loans.com/home-loans-interest-rates.php" title="Home Loan Interest Rates">Home Loan Interest Rates</a>.<br />
  • Extension/ repair/ renovation/ alteration of an existing House/ Flat.<br />
  • Takeover of an existing loan from other Banks/&nbsp;<a href="http://www.deal4loans.com/home-loan-banks.php">Housing Finance Companies</a>.<br />
  • Interest charged on the daily reducing balance<br />
  • No penalty on prepayments of&nbsp;home loan<br />
  • No hidden costs<br />
  • Option to club income of your spouse and children to compute eligible loan amount. <br />
  • Home Loan Quotes are free for customers. It's a totally free service for customers.<br />
  • All loans repayment period are over 6 months. No short term loans.
</p>
</span>
  <div style="clear:both; height:5px;"></div>
</div>

</div>
<div class="sbi-hl_right_box_b">
<?php
$newsource="SEM SBI";
$subjectLine="for Best Home Loan from Deal4loans Associated Banks";
?>
<form name="loan_form" method="post" action="home-loans-sbi-continue1.php" onSubmit="return chkform();">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<?php echo $newsource; ?>">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="Type_Loan" id="Type_Loan" value="Req_Loan_Home">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="left" valign="middle" colspan="2" height="25" style=" color:#FFF; font-size:11px; font-family:Verdana, Geneva, sans-serif;  text-align:center; text-transform: uppercase; "><strong>Compare Home loan Rates &amp; Eligibility</strong></td>
    </tr>
    <tr>
      <td width="124" height="33" align="left" valign="middle" class="text" style="  color:#FFF; font-size:11px; ">&nbsp;&nbsp;
        Full Name</td>
      <td width="178" class="text" style="  color:#FFF; font-size:11px;  " height="23"><input name="Name" id="Name" type="text" style="width:150px; height:18px;" onkeydown="validateDiv('nameVal');" />
        <div id="nameVal"></div></td>
    </tr>
    <tr>
      <td width="124" height="33" class="text" valign="middle"  style="  color:#FFF; font-size:11px; ">&nbsp;&nbsp;
        Mobile</td>
      <td width="178" class="text" style="  color:#FFF; font-size:11px;  "> +91
        <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" style="width:128px; height:18px;" onkeydown="validateDiv('phoneVal');"  />
        <div id="phoneVal"></div></td>
    </tr>
    <tr>
      <td width="124" height="33" class="text" style="  color:#FFF; font-size:11px; ">&nbsp;&nbsp;Email ID </td>
      <td width="178" class="text" style="  color:#FFF; font-size:11px;  "><input name="Email" id="Email" type="text" style="width:150px; height:18px;" onkeydown="validateDiv('emailVal');"  />
        <div id="emailVal"></div></td>
    </tr>
    <tr>
      <td width="124" height="33" align="left" valign="middle" class="text" style="  color:#FFF; font-size:11px; ">&nbsp;&nbsp;City</td>
      <td width="178" class="text" style="  color:#FFF; font-size:11px;  "><select name="City" id="City" style="width:154px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange="validateDiv('cityVal');" tabindex="7">
        <?=plgetCityList($City)?>
      </select>
        <div id="cityVal"></div></td>
    </tr>
    <!--<tr>
<td width="124" height="33" align="left" valign="middle" class="text" style="  color:#FFF; font-size:11px; ">
&nbsp;&nbsp;Other City</td>
<td width="178" class="text" style="  color:#FFF; font-size:11px;  ">
       <input name="City_Other" id="City_Other" type="text" style="width:150px; height:18px;" disabled onKeyUp="searchSuggest();" onKeyDown="validateDiv('othercityVal');"  />
                        <div id="othercityVal"></div>   
</td>
</tr> -->
    <tr>
      <td width="124" height="33" align="left" valign="middle" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;">&nbsp;&nbsp;Annual Income</td>
      <td width="178" class="text" style="color:#FFF; font-size:11px;  "><input type="text" name="Net_Salary" id="Net_Salary" style="width:150px; height:18px;"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');"  />
        <div id="netSalaryVal"></div></td>
    </tr>
    <tr>
      <td colspan="2"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
    <tr>
      <td width="124" height="33" align="left" valign="middle" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;">&nbsp;&nbsp;Loan Amount </td>
      <td width="178" class="text" style="color:#FFF; font-size:11px;  "><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" style="width:150px; height:18px;" onkeydown="validateDiv('loanAmtVal');" />
        <div id="loanAmtVal"></div></td>
    </tr>
    <tr>
      <td colspan="2"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
    </tr>
    <tr></tr>
    <tr>
      <td width="300" height="33" align="left" valign="middle" class="text" style="  color:#FFF; font-size:11px; " colspan="2"><table width="98%" border="0" class="bldtxt" style="font-weight:normal;">
        <tr>
          <td colspan="2"><strong>Your Preference for Banks for Interest Rate Quotes</strong></td>
        </tr>
        <tr>
          <td width="103"><input type="checkbox" name="bank_name_all" id="bank_name_all" value="All" onclick="return getEligibleBidders(); " checked="checked" />
            Any Top 4</td>
          <td width="189"><input type="checkbox" name="bank_name[]" id="bank_name" value="SBI"  onclick="return validate();"  disabled="disabled" />
            SBI </td>
        </tr>
        <tr>
          <td><input type="checkbox" name="bank_name[]" id="bank_name" value="HDFC" onclick="return validate();"  disabled="disabled" />
            HDFC </td>
          <td><input type="checkbox" name="bank_name[]" id="bank_name" value="LIC Housing" onclick="return validate();"  disabled="disabled" />
            LIC Housing</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="bank_name[]" id="bank_name" value="ICICI" onclick="return validate();"  disabled="disabled" />
            ICICI Bank</td>
          <td><input type="checkbox" name="bank_name[]" id="bank_name" value="Axis Bank" onclick="return validate();"  disabled="disabled" />
            Axis Bank </td>
        </tr>
        <tr>
          <td><input type="checkbox" name="bank_name[]" id="bank_name" value="Punjab National Bank"  onclick="return validate();" disabled="disabled" />
            PNB</td>
          <td><input type="checkbox" name="bank_name[]" id="bank_name" value="Standard Chartered" onclick="return validate();"  disabled="disabled" />
            Standard Chartered </td>
        </tr>
        <tr>
          <td colspan="2"><input type="checkbox" name="bank_name[]" id="bank_name" value="First Blue Home Finance" onclick="return validate();"  disabled="disabled" />
            First Blue Home Finance </td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td align="left" valign="top" colspan="2"  height="33" class="text9" style=" color:#FFF; font-size:8px; margin-top:0px; "><input name="accept" type="checkbox" tabindex="7" onclick="validateDiv('acceptVal');" />
        I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style="font-size:8px;  color:#88a943; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#88a943; font-size:8px; text-decoration:underline;">Terms and Conditions</a> of deal4loans.com.
        <div id="acceptVal"></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td  align="center" valign="top"  height="33"  style= "margin-left:0px;"><input type="submit" style="border: 0px none ; background-image: url(images/get_quot.jpg); width: 94px; height: 27px; margin-bottom: 0px;" value="" tabindex="8"/></td>
    </tr>
    <tr>
      <td align="left" valign="top" colspan="2" class="text9" style=" color:#FFF; font-size:9px; margin-top:0px; text-transform:capitalize;"><span style="color:#FF0000; font-weight:bold;">*</span> All loans and offers on sole discretion of banks. </td>
    </tr>
    <tr>
      <td align="left" valign="top" colspan="2" class="text9" style=" color:#FFF; font-size:9px; margin-top:0px; text-transform:capitalize;">&nbsp;</td>
    </tr>
  </table></form>
</div>
<div style="clear:both;"></div>
<div class="sbi-hl_content_box_b">
<div><strong>Current Floating Home Loan Interest Rates of SBI </strong></div>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
   <tr>
     <td width="11%" align="center" bgcolor="#88a943" class="tblwt_txt">Bank Name</td>
     <td width="29%" align="center" bgcolor="#88a943" class="tblwt_txt">Up to 30 Lacs</td>
	  <td width="27%" align="center" bgcolor="#88a943" class="tblwt_txt"> From 30 lacs to 75 Lacs</td>
   <td width="33%" align="center" bgcolor="#88a943" class="tblwt_txt"> Above 75 lacs </td>
      </tr>
   <tr>
     <td height="72" align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>SBI</b> </td>
     <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>10% p.a. <br />
</b></td>
	 <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>10.15% p.a.<br /></b></td>
   <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>10.15% p.a.<br />
   </b></td>
   </tr>
</table></div>
<div style="clear:both;"></div>
<div class="sbi-hl_eligcri_box">
<div><b>Eligibility Criteria  &amp; Documentation required for SBI Home Loan</b>
  </p>
</div>
<table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
   <tr>
     <td height="25" bgcolor="#88a943" class="tblwt_txt">&nbsp;</td>
     <td align="center" bgcolor="#88a943" class="tblwt_txt">Salaried</td>
	  <td align="center" bgcolor="#88a943" class="tblwt_txt">Self employed</td>
   </tr>
   <tr>
     <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Age</td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">21years to 60years</td>
	 <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">21years    to 70years</td>
   </tr>
   <tr>
   <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Income</td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">Rs.1,20,000    (p.a.)</td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">Rs.2,00,000 (p.a.)</td>
   </tr>
   <tr>
    <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Loan    Amount Offered</td>
	<td align="center"  bgcolor="#FFFFFF" class="tbl_txt">5,00,000    - 1,00,00000</td>
	<td align="center"  bgcolor="#FFFFFF" class="tbl_txt">5,00,000 - 2,00,00000</td>
   </tr>
     <tr>
    <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Tenure</td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">5years-20years</td>
	<td align="center"  bgcolor="#FFFFFF" class="tbl_txt">5years-20years</td>
   </tr>
   <tr>
     <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Current Experience </td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">2years</td>
	 <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">3years</td>
   </tr>
   <tr>
    <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">Documentation</td>
     <td align="left"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:left; ">1) Application form with photograph<br>
2) Identity &amp; residence proof<br>
3) Last 3 months salary slip <br>
4) Form 16<br>
5) Last 6 months bank salaried credit statements<br> 
6) Processing fee cheque</td>
     <td align="left"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:left; "> 1) Application  form with photograph<br>
       2) Identity &amp; residence proof<br>
       3) Education qualifications certificate &amp; proof of business existence<br>
       4) Business  profile,<br>
       5) Last 3 years profit/loss &amp; balance sheet<br>
       6) Last 6 months bank statements<br>
       7) Processing fee cheque</td>
   </tr>
</table></div>

</div>
<div style="clear:both; height:15px;"></div>
<?php include "responsive_footer.php"; ?>
</div>

<div class="sbi-hl_header">
<?php include "footer_hl.php"; ?></div>
</body>
</html>