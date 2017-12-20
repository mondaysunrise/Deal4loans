<?php session_start(); ?>
<HTML>
<HEAD>
<TITLE>Marriage Loans</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<Script Language="JavaScript">
/* function checkData(data, msg, reqLen){
	if((data.value == "") || (data.value.length < reqLen)) {
		alert('Please enter '+msg+' with atleast '+reqLen+' characters.');
		data.focus();
		return false;
	}
	return true;
   }*/
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
	if(marriage_loan_form.City.value=="Others")
	{
		marriage_loan_form.City_Other.disabled = false;
	}
	else
	{
		marriage_loan_form.City_Other.disabled = true;
	}
}
function validmobile(mobile_no)
{

	atPos = mobile_no.indexOf("0")// there must be one "@" symbol
	if (atPos == 0)
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.marriage_loan_form.mobile_no, 'Mobile number', 10))
		return false;

return true;
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

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}


function chkform()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	

	if(document.marriage_loan_form.full_name.value=="")
	{
		alert("Please fill your Full name.");
		document.marriage_loan_form.full_name.focus();
		return false;
	}
	if(document.marriage_loan_form.full_name.value!="")
	{
		 if(containsdigit(document.marriage_loan_form.full_name.value)==true)
		{
			alert("Full Name contains numbers!");
			document.marriage_loan_form.full_name.focus();
			return false;
		}
	}
  for (var i = 0; i <document.marriage_loan_form.full_name.value.length; i++) {
  	if (iChars.indexOf(document.marriage_loan_form.full_name.value.charAt(i)) != -1) {
  	alert ("Full Name has special characters.\n Please remove them and try again.");
	document.marriage_loan_form.full_name.focus();

  	return false;
  	}
  }
  
  if(document.marriage_loan_form.Birth_Date.selectedIndex==0)
	{
		alert("Please enter Day of Date of Birth to Continue");
		document.marriage_loan_form.Birth_Date.focus();
		return false;
	}
  if(document.marriage_loan_form.Birth_Month.selectedIndex==0)
	{
		alert("Please enter Month of Date of Birth to Continue");
		document.marriage_loan_form.Birth_Month.focus();
		return false;
	}
  if(document.marriage_loan_form.Birth_Year.value=="" || document.marriage_loan_form.Birth_Year.value=="Year")
	{
		alert("Please enter Year Date of Birth to Continue");
		document.marriage_loan_form.Birth_Year.focus();
		return false;
	}

		
	if(document.marriage_loan_form.mobile_no.value=="")
	{
		alert("Please fill your mobile number.");
		document.marriage_loan_form.mobile_no.focus();
		return false;
	}
	if(!checkData(document.marriage_loan_form.mobile_no, 'Mobile number', 10))
		return false;
	
	if(document.marriage_loan_form.email.value=="")
	{
		alert("Please fill your Email Id.");
		document.marriage_loan_form.email.focus();
		return false;
	}
	
	if(document.marriage_loan_form.email.value!="")
	{
		if (!validmail(document.marriage_loan_form.email.value))
		{
			//alert("Please enter your valid email address!");
			document.marriage_loan_form.email.focus();
			return false;
		}
	}
if (document.marriage_loan_form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		document.marriage_loan_form.City.focus();
		return false;
	}
	if((document.marriage_loan_form.City.value=="Others") && (document.marriage_loan_form.City_Other.value=="" || document.marriage_loan_form.City_Other.value=="Other City"  ) || !isNaN(document.marriage_loan_form.City_Other.value))
	{
		alert("Kindly fill your Other City!");
		document.marriage_loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.marriage_loan_form.City_Other.value.length; i++)
	{
		if (iChars.indexOf(document.marriage_loan_form.City_Other.value.charAt(i)) != -1) {
			alert ("Other city has special characters.\n Please remove them and try again.");
			document.marriage_loan_form.City_Other.focus();
			return false;
		}
    }
	
	if(document.marriage_loan_form.Pincode.value=="")
	{
		alert("Please fill PinCode.");
		document.marriage_loan_form.Pincode.focus();
		return false;
	}
	
	if(document.marriage_loan_form.Company_Name.value=="")
	{
		alert("Please fill Company Name.");
		document.marriage_loan_form.Company_Name.focus();
		return false;
	}
	
	
	if(document.marriage_loan_form.Annual_Income.selectedIndex==0)
	{
		alert("Please enter Annual income range to Continue");
		document.marriage_loan_form.Annual_Income.focus();
		return false;
	}
	if(document.marriage_loan_form.Net_Salary.value=="")
	{
		alert("Please enter Annual income to Continue");
		document.marriage_loan_form.Net_Salary.focus();
		return false;
	}
	else if(document.marriage_loan_form.Annual_Income.selectedIndex==1)
	{
		if((parseInt(document.marriage_loan_form.Net_Salary.value) < 50000) || (parseInt(document.marriage_loan_form.Net_Salary.value) > 100000))
		{
			alert("Your exact Annual income should be between the range you have selected");
			document.marriage_loan_form.Net_Salary.select();
			return false;
		}

	}
	else if(document.marriage_loan_form.Annual_Income.selectedIndex==2)
	{
		if((parseInt(document.marriage_loan_form.Net_Salary.value) < 100000) || (parseInt(document.marriage_loan_form.Net_Salary.value) >200000))
		{
			alert("Your exact Annual income should be between the range you have selected");
			document.marriage_loan_form.Net_Salary.select();
			return false;
		}
	
	}
	else if(document.marriage_loan_form.Annual_Income.selectedIndex==3)
	{
		if((parseInt(document.marriage_loan_form.Net_Salary.value) < 200000) || (parseInt(document.marriage_loan_form.Net_Salary.value) >300000))
		{
			alert("Your exact Annual income should be between the range you have selected");
			document.loan_form.Net_Salary.select();
			return false;
		}
	
	}
	else if(document.marriage_loan_form.Annual_Income.selectedIndex==4)
	{
		if((parseInt(document.marriage_loan_form.Net_Salary.value) < 300000) || (parseInt(document.marriage_loan_form.Net_Salary.value) >400000))
		{
			alert("Your exact Annual income should be between the range you have selected");
			document.marriage_loan_form.Net_Salary.select();
			return false;
		}
	
	}
	else if(document.marriage_loan_form.Annual_Income.selectedIndex==5)
	{
		if(parseInt(document.marriage_loan_form.Net_Salary.value) <= 400000)
		{
			alert("Your exact Annual income should be, as per the range you have selected");
			document.marriage_loan_form.Net_Salary.select();
			return false;
		}
	
	}
	if(document.marriage_loan_form.Loan_Amount.value=="")
	{
		alert("Please fill Loan Amount.");
		document.marriage_loan_form.Loan_Amount.focus();
		return false;
	}
	
	
}
</script>
<style>
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	background-color: #529BE4;
	border: 1px solid #529BE4;
	font-weight: bold;
}
.style1{
font-size:12px;
line-height:150%;
color:68718A;
font-weight:normal;
font-Family:Verdana;
}

.style4{
font-size:10px;
font-weight:bold;
color:666699;
font-Family:Verdana;
}
.style3{
font-size:11px;
line-height:150%;
color:68718A;
font-weight:normal;
font-Family:Verdana;
}
.style2{
font-size:14.5px;
color:blue;
font-Family:Verdana;
font-weight:bolder;
}
input, select {font:12px Arial; padding:2px; margin:0px; border: 1px solid #68718A;}
input.NoBrdr	{font:12px Arial; padding:0px; margin:0px; border: 0px}
</style>
<script language="javascript">
function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}

</script>

</HEAD>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 onbeforeunload="HandleOnClose('closedby_pl.php')">

<TABLE WIDTH=850 BORDER=0 CELLPADDING=0 CELLSPACING=0 align="center" >
	<TR>
		<TD COLSPAN=2>
			<IMG SRC="images/index_01.gif" WIDTH=180 HEIGHT=63 ALT=""></TD>
		<TD COLSPAN=3>
			<IMG SRC="images/index_02.gif" WIDTH=274 HEIGHT=63 ALT=""></TD>
		<TD ROWSPAN=3>
			<IMG SRC="images/index_03.gif" WIDTH=396 HEIGHT=269 ALT=""></TD>
	</TR>
	<TR>
		<TD>
			<IMG SRC="images/index_04.gif" WIDTH=145 HEIGHT=175 ALT=""></TD>
		<TD COLSPAN=2>
			<IMG SRC="images/index_05.gif" WIDTH=255 HEIGHT=175 ALT=""></TD>
		<TD ROWSPAN=2>
			<IMG SRC="images/index_06.gif" WIDTH=3 HEIGHT=206 ALT=""></TD>
		<TD>
			<IMG SRC="images/index_07.gif" WIDTH=51 HEIGHT=175 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=3>
			<IMG SRC="images/index_08.gif" WIDTH=400 HEIGHT=31 ALT=""></TD>
		<TD>
			<IMG SRC="images/index_09.gif" WIDTH=51 HEIGHT=31 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=6>
			<IMG SRC="images/index_10.gif" WIDTH=850 HEIGHT=59 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=6>
			<IMG SRC="images/index_11.gif" WIDTH=850 HEIGHT=1 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=3 WIDTH=400 HEIGHT=4>&nbsp;
			</TD>
		<TD ROWSPAN=7  WIDTH=3 HEIGHT=419>
			<IMG SRC="images/index_13.gif" WIDTH=3 HEIGHT=419 ALT=""></TD>
		<TD COLSPAN=2 WIDTH=447 HEIGHT=4>&nbsp;
			</TD>
	</TR>
	<TR>
		<TD COLSPAN=3 bgcolor="B2541E" WIDTH=400 HEIGHT=30 >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF" face="Arial" size="+2">Just 3 easy steps!</font></TD>
		<TD COLSPAN=2 WIDTH=447 HEIGHT=30 bgcolor="B2541E">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF" face="Arial" size="+2">Personal Loan Request - Step 1 of 2</font>
		</TD>
	</TR>
	<TR>
		
<TD COLSPAN=3 bgcolor="E0ECF8" WIDTH=400 HEIGHT=223 valign="top"><table cellpadding="8"><tr><td><img src="images/spacer.gif" width="11" height=".5"></td></tr><tr><td width="2"></td><td width="356" valign="top"><font class="style1"><img src="images/button_image.gif" width="11" height="12">&nbsp;&nbsp;Post your loan 
      requirement<br>
  <img src="images/button_image.gif" width="11" height="12">&nbsp;&nbsp;Get &amp; compare offers from all Banks<br>
  <img src="images/button_image.gif" width="11" height="12">&nbsp;&nbsp;Go with the lowest bidder</style> </td></tr><tr><td></td>
          <td > <font class="style2">
		  <strong>www.deal4loans.com</strong></style><br>
<font class="style1">The one-stop shop for best on all loan requirements. Now get offers from 
  <strong>ICICI</strong>, <strong>HDFC</strong>, <strong>Deutsche</strong>, <strong>Citibank</strong>, <strong>HSBC</strong>, <strong>Kotak</strong>, <strong>Standard Chartered</strong>, and <strong>IDBI</strong> 
  and choose the best deal!</style></td></tr></table>
      </TD>
		<TD COLSPAN=2 ROWSPAN=5 bgcolor="E0ECF8" WIDTH=447 HEIGHT=381 >
		<table cellpadding="6" ><tr><td valign="top">
		<form action="index-step2.php" name="marriage_loan_form" method="post" onSubmit="return chkform();">
		<table bgcolor="C0D8F0" WIDTH=429 HEIGHT=381 >
		<tr>
                  <td class="style1">Full Name</td>
                  <td><input name="full_name" type="text" size="30"></td></tr>
		<tr>
                  <td class="style1">DOB</td>
                  <td>
				  <select name="Birth_Date" size="1" class="style1">
                    <option selected value="-1">Date</option>
					<?php 
					for($i=1;$i<=31;$i++)
						echo "<option value=".$i.">".$i."</option>";
					?>
					</select>
					<select name="Birth_Month" size="1" class="style1">
                    <option selected value="-1">Month</option>
					<?php 
					$month_array = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");
					for($i=1;$i<=12;$i++)
						echo "<option value=".$i.">".$month_array[$i-1]."</option>";
					?>
					</select>
				  
				  <input name="Birth_Year" type="text" size="4" maxlength="4"  onblur="onBlurDefault(this,'Year');" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";/></td></tr>
		<tr>
                  <td class="style1">Mobile No.</td>
                  <td><span class="style1">+91</span> 
                    <input name="mobile_no" type="text" size="24" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td></tr>
		<tr>
                  <td class="style1">Email ID</td>
                  <td><input name="email" type="text" size="30"></td></tr>
		<tr>
                  <td class="style1">City</td>
                  <td><select size="1" name="City" onChange="cityother()">
   <Option value="Please Select">Please Select</Option><Option value="Ahmedabad">Ahmedabad</Option><Option value="Aurangabad">Aurangabad</Option><Option value="Bangalore">Bangalore</Option><Option value="Baroda">Baroda</Option><Option value="Bhopal">Bhopal</Option><Option value="Bhubneshwar">Bhubneshwar</Option><Option value="Chandigarh">Chandigarh</Option><Option value="Chennai">Chennai</Option><Option value="Cochin">Cochin</Option><Option value="Coimbatore">Coimbatore</Option><Option value="Cuttack">Cuttack</Option><Option value="Dehradun">Dehradun</Option><Option value="Delhi">Delhi</Option><Option value="Faridabad">Faridabad</Option><Option value="Gaziabad">Gaziabad</Option><Option value="Gurgaon">Gurgaon</Option><Option value="Guwahati">Guwahati</Option><Option value="Hosur">Hosur</Option><Option value="Hyderabad">Hyderabad</Option><Option value="Indore">Indore</Option><Option value="Jabalpur">Jabalpur</Option><Option value="Jaipur">Jaipur</Option><Option value="Jamshedpur">Jamshedpur</Option><Option value="Kanpur">Kanpur</Option><Option value="Kochi">Kochi</Option><Option value="Kolkata">Kolkata</Option><Option value="Lucknow">Lucknow</Option><Option value="Ludhiana">Ludhiana</Option><Option value="Madurai">Madurai</Option><Option value="Mangalore">Mangalore</Option><Option value="Mysore">Mysore</Option><Option value="Mumbai">Mumbai</Option><Option value="Nagpur">Nagpur</Option><Option value="Nasik">Nasik</Option><Option value="Navi Mumbai">Navi Mumbai</Option><Option value="Noida">Noida</Option><Option value="Patna">Patna</Option><Option value="Pune">Pune</Option><Option value="Ranchi">Ranchi</Option><Option value="Sahibabad">Sahibabad</Option><Option value="Surat">Surat</Option><Option value="Thane">Thane</Option><Option value="Thiruvananthapuram">Thiruvananthapuram</Option><Option value="Trivandrum">Trivandrum</Option><Option value="Trichy">Trichy</Option><Option value="Vadodara">Vadodara</Option><Option value="Vishakapatanam">Vishakapatanam</Option><Option value="Others">Others</Option>	
	 </select></td>
   </tr>
   <tr>
                  <td class="style1" >Other City</td>
     <td ><input type="text" name="City_Other" disabled value="Other City" onFocus="this.select();" size="30"></td></tr>
	 
		<tr>
                  <td class="style1">Pincode</td>
                  <td><input name="Pincode" type="text" size="30" maxlength="6" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td></tr>
		<tr>
                  <td class="style1">Employment Status</td>
                  <td><select name="Employment_Status" size="1" class="style1">
                      <option selected value="1">Salaried</option>
     	<option value="0">Self Employed</option>
     </select></td></tr>
		<tr>
                  <td class="style1">Company Name</td>
                  <td><input name="Company_Name" type="text" size="30"></td></tr>
		<tr>
                  <td class="style1">Annual Income Range(Rs.)</td>
                  <td><select name="Annual_Income" class="style1">
                      <OPTION value="-1" selected>Please select</OPTION>
		<OPTION value="1">50,000-1,00,000</OPTION>
		<OPTION value="2">1,00,000-2,00,000</OPTION>
		<OPTION value="3">2,00,000-3,00,000</OPTION>
		<OPTION value="4">3,00,000-4,00,000</OPTION>
		<OPTION value="5">Above4,00,000</OPTION></SELECT></td></tr>
		<tr>
                  <td class="style1">Annual Income</td>
                  <td><input name="Net_Salary" type="text" size="30" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td></tr>
		<tr>
                  <td class="style1">Loan Amount</td>
                  <td><input name="Loan_Amount" type="text" size="30" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td></tr>
		<tr>
                  <td class="style1">Are you a Credit card holder?</td>
                  <td><input type="radio"  name="CC_Holder" class="NoBrdr"  value="1" checked><font class="style4">Yes</font><input type="radio" class="NoBrdr" name="CC_Holder" value="0"><font class="style4">No</font></td></tr>
		<tr><td></td>
		<td   >
		<input type="hidden"  name="Type_Loan" value="personal">
		 <input name="submit" type="submit" class="bluebutton" value="Submit" >
   &nbsp;
   <input type="reset" class="bluebutton" value="Reset" ></td>
	</tr>
		</table>
		</form>
		</td></tr></table>
		
			</TD>
	</TR>
	<TR>
		<TD COLSPAN=3 WIDTH=400 HEIGHT=27>&nbsp;</TD>
	</TR>
	<TR>
		<TD COLSPAN=3>
			<IMG SRC="images/index_20.gif" WIDTH=400 HEIGHT=1 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=3 WIDTH=400 HEIGHT=30 bgcolor="B2541E">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF" face="Arial" size="+2">Testimonials</font></TD>
	</TR>
	<TR>
		
    <TD COLSPAN=3 WIDTH=400 HEIGHT=100 bgcolor="E0ECF8"><table cellpadding="6"><tr><td><font class="style1"> I think that launch 
      of a service like <font color="#0000FF"><strong>www.deal4loans.com</strong></font> will ease the loan 
      seeking and deal hunting process for the likes of me. I wish u guys all 
      the success.</font></td></tr><tr><td align="right"><font class="style1">- Divya</font></td></tr></table>
  </TD>
	</TR>
	<TR>
		<TD COLSPAN=6 WIDTH=850 HEIGHT=14></TD>
	</TR>
	<TR>
		<TD COLSPAN=6 WIDTH=850 HEIGHT=32 bgcolor="B2541E">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF" face="Arial" size="+2">Helpful tips to look/compare/apply for loans to get the best deal.</font>
			</TD>
	</TR>
	<TR>
		
<TD COLSPAN=6 WIDTH=850 HEIGHT=226 bgcolor="E0ECF8" valign="top"><table cellpadding="6"><tr><td><font class="style1"><p >Personal loans are 
	provided on the basis of your income, mainly estimation given by banks 
	is on the basis of your income &amp; most of loans are happening on the 
	basis of the track record of the customer with any bank. Credit Card usage/payments 
	also impact your personal loan eligibility &amp; rates as it is an unsecured 
	loan so banks try guaging your intention to pay loan. Customers tend to 
	make mistakes while entering into deals, which may not be beneficial for 
	them, so better compare all the variables before signing a loan aggrement 
	by different banks. The varios parameters that you need to compare on 
	Personal Loan are :</p></font></td></tr><tr>
          <td><font class="style1"> <p><img src="images/spacer.gif" width="21" height="12"><img src="images/button_image.gif" width="11" height="12"> 
              Eligibility. <br>
              <img src="images/spacer.gif" width="21" height="12"><img src="images/button_image.gif" width="11" height="12"> 
              Interest rates bet suited.<br>
              <img src="images/spacer.gif" width="21" height="12"><img src="images/button_image.gif" width="11" height="12"> 
              Processing fees. <br>
              <img src="images/spacer.gif" width="21" height="12"><img src="images/button_image.gif" width="11" height="12"> 
              Pre-payment/Foreclosure charges.<br>
              <img src="images/spacer.gif" width="21" height="12"><img src="images/button_image.gif" width="11" height="12"> 
              Document required.<br>
              <img src="images/spacer.gif" width="21" height="12"><img src="images/button_image.gif" width="11" height="12"> 
              Turn Around Time.</p></font>
</td></tr></table>
  </TD>
	</TR>
	<TR>
		<TD COLSPAN=6 WIDTH=850 HEIGHT=9 bgcolor="B2541E" >
		</TD>
	</TR>
	<TR>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=145 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=35 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=220 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=3 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=51 HEIGHT=1 ALT=""></TD>
		<TD>
			<IMG SRC="images/spacer.gif" WIDTH=396 HEIGHT=1 ALT=""></TD>
	</TR>
</TABLE>
</BODY>
</HTML>