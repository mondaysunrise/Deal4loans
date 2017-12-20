<?php session_start(); ?>
<HTML>
<HEAD>
<TITLE>Marriage Loans</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<Script Language="JavaScript">
 function checkData(data, msg, reqLen){
	if((data.value == "") || (data.value.length < reqLen)) {
		alert('Please enter '+msg+' with atleast '+reqLen+' characters.');
		data.focus();
		return false;
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



function chkform()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	

	
	//if(document.marriage_loan_form.Reference_Code1.value=="")
//	{
		
	//	alert("Please fill your Reference Code.");
		//document.marriage_loan_form.Reference_Code1.focus();
	//	return false;
	//}

	//if(document.marriage_loan_form.validate.value="on")
//	{
		//if(document.marriage_loan_form.RePhone.value=="")
		//{
		//	alert("Please fill your Mobile Number.");
		//	//document.marriage_loan_form.RePhone.focus();
		//	return false;
		//}
	//return false;
//	}

 
	if(document.marriage_loan_form.Primary_Acc.value=="")
	{
		alert("Please fill Primary Account Bank.");
		document.marriage_loan_form.Primary_Acc.focus();
		return false;
	}
	
	if(document.marriage_loan_form.Total_Experience.value=="")
	{
		alert("Please fill Total Years of Experience.");
		document.marriage_loan_form.Total_Experience.focus();
		return false;
	}
	
	if(document.marriage_loan_form.Years_In_Company.value=="")
	{
		alert("Please fill No. Years Experience in Current Organisation.");
		document.marriage_loan_form.Years_In_Company.focus();
		return false;
	}
	
	if(document.marriage_loan_form.LoanAny.value=="")
	{
		alert("Please fill If any Loan Running.");
		document.marriage_loan_form.LoanAny.focus();
		return false;
	}
	
	
	
}

function Decoration(strPlan)
{
       if (document.getElementById('plantype') != undefined)  
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='Beige';  
       }

       return true;
}
function Decoration1(strPlan)
{
       if (document.getElementById('plantype') != undefined) 
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='';  
			       
       }

       return true;
}
function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.marriage_loan_form.validate.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr><td align="left" class="style1" width="210" height="20"><font class="style1">Re-confirm Mobile No.</font></td>	<td colspan="3" align="left" width="196" height="20" ><input size="18" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" name="RePhone" ></td></tr></table>';
			}
			
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		return true;
		}



function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			if(document.marriage_loan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr> <td align="left" class="style4" width="250" height="20" valign="top"><font class="style1">Type of loan(s) running? </font></td> <td colspan="3" class="bodyarial11" width="250" ><table border="0"><tr><td class="style1" width="60" height="20" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td><td class="style1"  width="60" height="20"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td><tr><td  width="60" height="20" class="style1"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" id="Loan_Any" value="cl" >Car</td><td class="style1" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap">Property</td></tr><tr><td class="style1" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other">Other</td></tr> </table></td></tr><tr><td width="400" height="5" colspan="4">&nbsp;	 </td> </tr> <tr>    <td align="left"  class="style4" width="250" height="20" ><font class="style1">How many EMI paid? </font>  </td>   <td colspan="3" align="left" width="250" height="18"><select name="EMI_Paid"  style="float: left" class="style1"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option </select>  </td>	</tr></table>';
			}
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			if(document.marriage_loan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

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

</HEAD>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>

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
		
    <TD COLSPAN=2 WIDTH=447 HEIGHT=30 bgcolor="B2541E">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FFFFFF" face="Arial" size="+2">Personal 
      Loan Request - Step 2 of 2</font> </TD>
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
		<table cellpadding="6" >
		<tr><td valign="top">
		<form action="Marriage_Loan_Submit.php" name="marriage_loan_form" method="post" onSubmit="return chkform();"	 >
		<table bgcolor="C0D8F0" WIDTH=429 HEIGHT=381  cellpadding="5">
		<tr><td height="2">&nbsp;</td></tr>
		<tr>
				    <td align="left"  class="style1" width="230" height="20" ><font class="style1">Activation Code? <?php //echo $_SESSION['last_inserted'];?></font>
				   </td>
				   <td colspan="3" align="left" width="270" height="18">
				   <input size="10"  maxlength="10" name="Reference_Code1" class="style4" style="float: left" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your loan request and to get the bidder contacts.')" style="float: left" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute;font-size:10px;width:120px;text-align:center;font-family:verdana;" ></div>
				   </td>
				</tr>
				<tr>
				    <td colspan="4" align="left"  class="style1"  height="20" ><input  class="noBrdr" type="checkbox"  name="confirm" onclick="addElement();" value="hello" id="validate">
				   <font class="style1">if you havent received activation code sms</font>
				  </td>
				</tr>
				<tr><td colspan="4" id="myDiv" ></td></tr>
				<tr>
					<td align="left"  class="style4" width="230" height="20"><font class="style1">Primary Account in which bank? 					</td>
					<td  align="left" colspan="3" width="270" height="20"><input type="text" size="18"  name="Primary_Acc"  class="style4" style="float: left" >
					</td>
				</tr>	
				<tr>
					<td align="left" class="style4" width="230" height="20"><font class="style1">Total Experience(Years)/
					 Total Years in Business</font></td>
					 <td align="left" colspan="3" width="270" height="20"><input size="18" class="style4" name="Total_Experience" onfocus="this.select();" style="float: left">
					</td>
			   </tr>
			
				 <tr>
					<td align="left" class="style4" width="230" height="20"><font class="style1">No. of years in Current Company</font></td>
					 <td align="left" colspan="3" width="270" height="20">
					<input type="text" name="Years_In_Company" class="style4" size="18" maxlength="15" ></td>
				</tr>
				
				
				</tr>
				
					<tr>
					<td align="left" class="style4" width="280" height="20"><font class="style1">Any Loan running?</font></td>
					<td align="left" width="20" height="20">
					
					<input type="radio"  class="NoBrdr"  value="1"  name="LoanAny" class="NoBrdr" onclick="addElementLoan();"><font class="style4">Yes</font></td>
					<td align="left" width="50" height="18"  >
					<input size="10" type="radio" class="NoBrdr"  name="LoanAny" class="NoBrdr" onclick="removeElementLoan();" value="0" ><font class="style4">No</font></td><td >&nbsp;</td>
				</tr>
				<tr><td colspan="4" id="myDivLoan"></td></tr>

				
				
					<tr>
						<td colspan="2" align="center" width="276"> <input name="submit" type="submit" class="bluebutton" value="Submit" >
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