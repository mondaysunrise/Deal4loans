<?php
	require 'scripts/functions.php';
	if(strlen($_REQUEST['source'])>0)
{
	$retrivesource=$_REQUEST['source'];
}
else
{
	$retrivesource="HR Initiative";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Loans - Compare Lowest Rates</title>
<meta name="keywords" content="personal loan,personal loans,personal loans india,low interest personal loan"/>
<meta name="description" content="Compare personal loans from Sbi,Hdfc,Citibank,Standard Chartered bank and get lowest EMI & Rates."/>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/pldigittowordconverter.js' type='text/javascript' language='javascript'></script>
<style type="text/css">
body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#292323;

}

input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;

}

.bldtxt{
font-weight:bold;
line-height:16px;
color:#4f4d4d;
}


.txt ul{
	margin:0px 0px 0px 2px;
	padding:0px 0px 0px 2px;
}

.txt ul li{
	background: url(images/cl/arrow.gif) no-repeat 0px 4px;
	list-style-type:none;
	color:#292323;
	padding-left:15px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px 
}

 </style>
<script Language="JavaScript" Type="text/javascript">

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

function chkpersonalloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

if (document.allloan_form.Type_Loan.selectedIndex==0)
	{
		alert("Please enter the Type of product you are looking for");
		document.allloan_form.Type_Loan.focus();
		return false;
	}

if((Form.Name.value=="") || (Form.Name.value=="Name")|| (Trim(Form.Name.value))==false)
{
alert("Kindly fill in your Name!");
Form.Name.focus();
return false;
}
else if(containsdigit(Form.Name.value)==true)
{
alert("Name contains numbers!");
Form.Name.focus();
return false;
}
  for (var i = 0; i < Form.Name.value.length; i++) {
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
  	alert ("Name has special characters.\n Please remove them and try again.");
	Form.Name.focus();
  	return false;
  	}
  }

if((Form.Phone.value=='Mobile No') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
alert("Kindly fill in your Mobile Number!");
Form.Phone.focus();
return false;
}
 else if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value in ");
			  Form.Phone.focus();
			  return false;  
		}
        else if (Form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 Form.Phone.focus();
				return false;
        }
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 Form.Phone.focus();
                return false;
        }

if(document.allloan_form.Email.value!="Email Id")
{
	if (!validmail(document.allloan_form.Email.value))
	{
		//alert("Please enter your valid email address!");
		document.allloan_form.Email.focus();
		return false;
	}
	
}
if(Form.City.selectedIndex==0)
{
	alert("Please enter City Name to Continue");
	Form.City.focus();
	return false;
}
else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
alert("Kindly fill in your other City!");
Form.City_Other.focus();
return false;
}

 if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select emplyment status ");
	Form.Employment_Status.focus();
	return false;
}

if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income") || (Form.IncomeAmount.value=="Net Take Home(Montly Salary)"))
{
	alert("Please enter Income to Continue");
	Form.IncomeAmount.focus();
	return false;
}
	if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.accept.focus();
		return false;
	}
	
	
if(Form.Email.value=="Email Id")
{
	Form.Email.value=" ";
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
function containsalph(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
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
function validateemailv2(email)
{
// a very simple email validation checking.
// you can add more complex email checking if it helps
var splitted = email.match("^(.+)@(.+)$");
if(splitted == null) return false;
if(splitted[1] != null )
{
var regexp_user=/^\"?[\w-_\.]*\"?$/;
if(splitted[1].match(regexp_user) == null) return false;
}
if(splitted[2] != null)
{
var regexp_domain=/^[\w-\.]*\.[a-za-z]{2,4}$/;
if(splitted[2].match(regexp_domain) == null)
{
var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
if(splitted[2].match(regexp_ip) == null) return false;
}// if
return true;
}
return false;
}



function addcty_oth()
{
	var nioc= document.getElementById('myDivOC');
		if(nioc.innerHTML=="")
		{
			if(document.allloan_form.City.value=="Others")
			{
				nioc.innerHTML = '<Table cellpadding="0" cellspacing="0" width="100%"><tr align="left">				  <Td height="26" class="bldtxt" width="110">Other City </Td>				  <Td><input name="City_Other" id="City_Other" type="text" style="width:140px; " /></Td>				  </tr></table>';
			}
		}
		else
	{
		nioc.innerHTML="";
	}
		return true;

	}
</script>

</head>

<body>
<table width="1004" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="161" height="169" align="left" valign="top"><img src="new-images/pl/hdr1_hr.gif" width="161" height="169" /></td>
            <td width="158" height="169" align="left" valign="top"><img src="new-images/pl/hdr2_hr.gif" width="158" height="169" /></td>
            <td width="177" height="169" align="left" valign="top"><img src="new-images/pl/hdr3.gif" width="177" height="169" /></td>
            <td width="186" height="169" align="left" valign="top"><img src="new-images/pl/hdr4.gif" width="186" height="169" /></td>
          </tr>
          <tr>
            <td height="167" align="left" valign="top"><img src="new-images/pl/hdr5.gif" width="161" height="167" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/pl/hdr6.gif" width="158" height="167" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/pl/hdr7.gif" width="177" height="167" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/pl/hdr8.gif" width="186" height="167" /></td>
          </tr>
          <tr>
            <td colspan="4"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; " >&nbsp;</td>
              </tr>
              <tr>
                <td height="30" class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; " >Why Deal4loans.com - Widest Choice of Banks</td>
              </tr>
              <tr>
                <td><table width="650" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #def3f8; ">
                  <tr>
                    <td width="100%" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="30" height="40" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td width="616"><div style="color:#7e5a09; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Get best deals on Loans and Credit Cards.</div></td>
                      </tr>
                                          <tr>
                        <td width="30" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Get Cash back on each loan  booked from Rs 500 to Rs 10000.</div></td>
                      </tr>
                      <tr>
                        <td width="30" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Special rate offers</div></td>
                      </tr>
					   <tr>
                        <td width="30" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Best service and Loan guru consulting.</div></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="100" height="25px"><b>Loan Partners : </b></td><td></td>
					</tr>
					<tr>
                    <td colspan="2"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
						  <td width="17%"><img src="new-images/pl/icici_lgo.jpg" width="98" height="26" /></td>
                          <td width="17%"><img src="new-images/pl/hdfc.jpg" width="98" height="28" /></td>
						  <td width="15%"><img src="new-images/pl/ing_vlgo.jpg" width="80" height="24" /></td>
						  <td width="20%"><img src="new-images/pl/bajj_flgo.jpg" width="109" height="23" /></td>
                          <td width="15%"><img src="new-images/pl/fultrn_n1.jpg" width="90" height="25" /></td>
                          <td width="16%"><img src="new-images/pl/sbi.gif" width="96" height="23" /></td>
                                </tr>
                    </table></td>
                  </tr>
                </table>                  </td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        <td width="322" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="289" height="88" align="left" valign="top" style="background-image:url('new-images/pl/hr-hdng1.gif'); width:289px; height:88px; padding-top:10px; padding-left:60px; font-family:Georgia, 'Times New Roman', Times, serif; color:#0a71d9; font-size:14px; font-weight:bold;" >HR Initiative for <br /> <?php if(strlen($_REQUEST['source'])>0) echo $retrivesource; ?> Employees&nbsp;</td>
              </tr>
              <tr>
                <td valign="top" style="border-left:1px solid #c2c2c2; border-right:1px solid #c2c2c2;">
				<form name="allloan_form"  action="insert_common_form_step1.php" method="POST" onSubmit="return chkpersonalloan(document.allloan_form);">
<input type="hidden" name="source" value="<?php echo strtolower($retrivesource); ?>"> 
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif;" color="#FF0000"><strong><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font></div><table width="95%"  border="0" align="right" cellpadding="0" cellspacing="0">
				<tr align="left">
				  <Td>&nbsp;</Td>
				  <Td>&nbsp;</Td>
				  </tr>
				  <tr align="left">
				  <Td height="26" class="bldtxt">Product</Td>
				  <Td><select  style="width:140px;"  name="Type_Loan" id="Type_Loan" >
        <option selected value="-1">Please select</option>
        <option  value="Req_Loan_Personal">Personal Loan</option>
        <option value="Req_Loan_Home">Home Loan</option>
		<option value="Req_Loan_Car">Car Loan</option>
		<option value="Req_Credit_Card">Credit Card</option>
      </select></Td>
				  </tr>
				<tr align="left">
				<Td width="40%" class="bldtxt">Full Name </Td>
 				<Td width="60%"><input name="Name" type="text" id="Name" style=" width:140px;" /></Td>
				</tr>
				
				
				<tr align="left">
				  <Td height="26" class="bldtxt">Mobile No. </Td>
				  <Td>+91 
	  <input name="Phone" id="Phone" type="text"  style="width:110px; " onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();" maxlength="10"  /></Td>
				  </tr>
				   <tr>
		  <td colspan="2"><div id="myDiv1" style="color:#7d0606; font-family:Verdana; font-size:11px;"></div></td>
		  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Email Id </Td>
				  <Td><input name="Email" id="Email" type="text" style="width:140px; " /></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">City</Td>
				  <Td>
<!--                  <select style="width:142px; height:18px;"  name="City" id="City" onchange="addcty_oth();"  > -->
                  <select style="width:142px; height:18px;"  name="City" id="City" >
        <?=plgetCityList($City)?>
      </select>
 
	  </Td>
				  </tr>
			<tr align="left">
				  <Td colspan="2" width="100%" id="myDivOC"></Td>
		  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Occupation</Td>
				  <Td><select   style="width:140px;"  name="Employment_Status" id="Employment_Status" >
        <option selected value="-1">Employment Status</option>
        <option  value="1">Salaried</option>
        <option value="0">Self Employed</option>
      </select></Td>
				  </tr>
				
				<tr align="left">
				  <Td height="26" class="bldtxt"><div id="chgtxt">Annual Income </div></Td>
				  <Td><input name="IncomeAmount" id="IncomeAmount" type="text"  style="width:140px; " onFocus="this.select();"  onChange="intOnly(this); addDiv();"  onKeyUp="intOnly(this);PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); addDiv();" onKeyPress="intOnly(this); PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onBlur="PlgetDigitToWords('IncomeAmount','formatedIncome','wordIncome'); "/>
				  </Td>
				  </tr>
				  <tr>
				  <td colspan="2" align="left">	<span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span>
	<span id='wordIncome' style='font-size:11px;font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;   margin-left:10px; margin-bottom:5px;'></span></td>
				  </tr>
				
								<tr align="left">
				  <Td  Height="30" colspan="2" style="font-size:9px;"><input type="checkbox"  name="accept" style="border:none;" checked  > I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</Td>
				  </tr>
				 
				 <tr>
	   <td  colspan="2" align="left" style="padding:5px;"> <div id="hdfclife"></div></td>
		 </tr>
				<tr align="center">
				  <Td colspan="2"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " /></Td>
				  </tr>
                </table>
				</form></td>
              </tr>
              <tr>
                <td valign="top"><img src="images/cl/frm-btm.gif" width="289"   height="21"></td>
              </tr>
              <tr>
                <td valign="middle" height="120"><img src="new-images/pl/step-ban.gif" width="289" height="108" /></td>
              </tr>
            </table></td>
            <td width="33" height="336" align="right" valign="top"><img src="new-images/pl/frm-rgt.gif" width="33" height="336" /></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <Tr>
  <td>&nbsp;</td>
  </Tr>
</table>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
