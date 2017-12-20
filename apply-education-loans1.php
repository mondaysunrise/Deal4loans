<?php
	//require 'scripts/session_check.php';
	require 'scripts/functions.php';

	$name = $_SESSION['Temp_Name'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
	
	$maxage=date('Y')-62;
	$minage=date('Y')-18;

	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Education Loan | Education Loan India</title>
<meta name="keywords" content="Apply Education Loans, Compare Education Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Apply Online Education Loans through Deal4loans.com Get instant information on education loans from all education provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>

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
font-family:arial;
font-weight:bold;
font-size:12px;
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
/* START CSS NEEDED ONLY IN DEMO */
	
	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
	/* Big box with list of options */
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
		z-index:100;
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
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
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


function chkeducaionloan(Form)
{
	
	var myOption;
	var i;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";


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

if(Form.Email.value!="Email Id")
{
	if (!validmail(Form.Email.value))
	{
		//alert("Please enter your valid email address!");
		Form.Email.focus();
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


if(Form.Course.selectedIndex==0)
{
	alert("Please enter Course of Study to Continue");
	Form.Course.focus();
	return false;
}
else if((Form.Course.value>1)  && ((Form.Course_Name.value=='')|| !isNaN(Form.Course_Name.value) ||(Form.Course_Name.value=="Course Name")))
{
alert("Kindly fill in Course Name!");
Form.Course_Name.focus();
return false;
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

if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
{
alert("Kindly fill in your Loan Amount (Numeric Only)!");
Form.Loan_Amount.focus();
return false;
}
else if(containsalph(Form.Loan_Amount.value)==true)
{
alert("Loan Amount contains characters!");
Form.Loan_Amount.focus();
return false;
}
if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please enter Income Status to Continue");
	Form.Employment_Status.focus();
	return false;
}
if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition");
		Form.accept.focus();
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

function othercity1()
{
if(document.eduloan_form.City.value=='Others')
{
document.eduloan_form.City_Other.disabled=false;
}
else
{document.eduloan_form.City_Other.disabled=true;
}
}

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

function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined)  
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='Beige';  
       }

       return true;
}
function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined) 
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='';  
	   }

       return true;
}

function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.eduloan_form.Course.value >1)
			{
				
				ni.innerHTML = '<table  width="100%" border="0" cellspacing="0" cellpadding="0"><tr align="left">				<Td width="38%" class="bldtxt">Course Name </Td> 				<Td width="62%"><input type="text" name="Course_Name" id="Course_Name"  style="width:138px;" tabindex="8" ></Td>				</tr></table>';
				

			}
			else
			{
				ni.innerHTML = '';
			}
		}
		else
	{
		if(document.eduloan_form.Course.value >1)
			{
				
				ni.innerHTML = '<table  width="100%" border="0" cellspacing="0" cellpadding="0"><tr align="left">				<Td width="38%" class="bldtxt">Course Name </Td> 				<Td width="62%"><input type="text" name="Course_Name" id="Course_Name"  style="width:138px;" tabindex="8" ></Td>				</tr></table>';
				

			}
			else
			{
				ni.innerHTML = '';
			}
	}
		
		return true;

	}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.eduloan_form.City.value;
	var otrcit = document.eduloan_form.City_Other.value;
	//alert(cit);	
	if(cit =="Ahmedabad" || otrcit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #999999; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal; " height="20">Special service for Deal4loans customers:</td></tr> <tr><td width="23" valign="top"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by Insurance & Investment experts from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}


</script>


</head>

<body>
<table width="1004" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="161" height="169" align="left" valign="top"><img src="new-images/el/el-1.jpg" /></td>
            <td width="158" height="169" align="left" valign="top"><img src="new-images/el/el-2.jpg" /></td>
            <td width="177" height="169" align="left" valign="top"><img src="new-images/el/el-3.gif" /></td>
            <td width="186" height="169" align="left" valign="top"><img src="new-images/el/el-4.jpg" /></td>
          </tr>
          <tr>
            <td height="167" align="left" valign="top"><img src="new-images/el/el-5.jpg" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/el/el-6.jpg" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/el/el-7.jpg" /></td>
            <td height="167" align="left" valign="top"><img src="new-images/el/el-8.jpg" /></td>
          </tr>
          <tr>
            <td colspan="4"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; " >&nbsp;</td>
              </tr>
              <tr>
                <td height="30" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; font-weight:bold;" >Why Deal4loans.com</td>
              </tr>
              <tr>
                <td  align="center" valign="middle">
               <table width="650" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #def3f8; ">
                  <tr>
                    <td style="padding-left:15px; "><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="35" height="40" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Over 6 lakh customers have taken quote at Deal4loans.com</div></td>
                      </tr>
                                          <tr>
                        <td width="30" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Education loan  Offers are free for customers. It's a totally free service for customers</div></td>
                      </tr>
                      <tr>
                        <td width="30" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Deal4loans.com has tie ups with major Education loan Banks in India.</div></td>
                      </tr>
                       <tr>
                        <td width="30" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Your details will not be shared with any bank unless you opt for it.</div></td>
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
                <td align="center" valign="middle">&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="100" class="bldtxt">Loan Partners</td>
                    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><img src="new-images/pl/logo_credila.gif" width="96" height="25" /></td>
                          <td><img src="new-images/pl/hdfc.jpg" width="99" height="29" /></td>
                          <td><img src="new-images/pl/sbi.gif" width="97" height="24" /></td>
                          <td><img src="new-images/pl/bob.jpg" width="97" height="24" /></td>
                         	
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
                <td width="289" height="88" align="left" valign="top"><img src="new-images/el/edu-loan-reqst.jpg" width="289" height="88" /></td>
              </tr>
              <tr>
                <td valign="top" style="border-left:1px solid #c2c2c2; border-right:1px solid #c2c2c2;">
				 <form name="eduloan_form"  action="apply-education-loan-continue.php" method="POST" onSubmit="return chkeducaionloan(document.eduloan_form);"> 
<input type="hidden" name="Type_Loan" value="Req_Loan_Education">
<input type="hidden" name="source" value="apply-education-loan1"> 
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table width="97%"  border="0" align="right" cellpadding="0" cellspacing="0">
				<tr align="left">
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				  </tr>
				<tr align="left">
				<Td width="38%" class="bldtxt">Full Name </Td>
 				<Td width="62%"><input name="Name" type="text" <? if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? }else {?>value=""<? }?> id="Name" style=" width:138px;" onBlur="onBlurDefault(this,'Name');"  onFocus="onFocusBlank(this,'Name');" onchange="insertData();"/></Td>
				</tr>
				                  
				<tr align="left">
				  <Td height="26" class="bldtxt">Email Id </Td>
				  <Td><input name="Email" id="Email" type="text" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? }else { ?>value=""<? } ?> style="width:138px; "  onblur="onBlurDefault(this,'Email Id');" onFocus="removetooltip();"  onChange="insertData();"/></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Mobile No. </Td>
				  <Td class="bldtxt">+91 
	  <input name="Phone" id="Phone" type="text"  <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? }else {?>value="" <? }?>style="width:108px; " onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();" maxlength="10"  /></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Country of study </Td>
				  <Td><select   style="width:138px;"  name="Country" id="Country" >
        <option selected value="0">India</option>
        <option  value="1">UK</option>
        <option value="2">USA</option>
		<option value="3">Other City</option>
      </select></Td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Course of study </Td>
				  <Td><select   style="width:138px;"  name="Course" id="Course" onchange="addElement();">
                    <option  value="">Please Select</option>
                   <option value="3">Graduation Courses</option>
						<option value="2">Post Graduation Courses</option>
						<option value="4">Other Courses</option>
                  </select></Td>
				  </tr>
				  <tr>
				  <td class="bldtxt" colspan="2"><div id="myDiv"></div></td>
				  </tr>
				<tr align="left">
				  <Td height="26" class="bldtxt">Residence City </Td>
				  <Td><select name="City" id="City" style="width:138px;" onchange="othercity1(); addhdfclife();" tabindex="11">
                  <?=getCityList1($City)?>
                </select></Td>
				  </tr>
				
				<tr align="left">
				  <Td height="26" class="bldtxt">Other City </Td>
				  <Td><input name="City_Other" id="City_Other" type="text" value="Other City" style="width:138px; " onblur="onBlurDefault(this,'Other City');"  onfocus="onFocusBlank(this,'Other City');" disabled="disabled"></Td>
				  </tr>
				
				  <tr align="left">
				  <Td height="26" class="bldtxt">Loan Amount </Td>
				  <Td><input name="Loan_Amount" id="Loan_Amount" tabindex="12" type="text" style="width:138px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" /></Td>
				</tr>
				  <tr>
				  <td colspan="2" align="left"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span> </td>
				  </tr>
                <tr>
				<td class="bldtxt">Applicant's Income Status</td>
				<td><select name="Employment_Status" id="Employment_Status" style="width:138px;" tabindex="9"><option>Please Select</option><option value="1">Salaried</option><option value="2">Self Employed</option><option value="3">Not Earning</option></select></td>
				</tr>
				<tr>
				<td class="bldtxt">Co-borrower's* Income</td>
				<td><input type="text" name="Coborrower_Income" id="Coborrower_Income" onkeypress="intOnly(this);" onkeyup="intOnly(this);" tabindex="10" style="width:138px;" maxlength="10" /></td>
				</tr>
				<tr align="left">
				  <Td height="50" colspan="2" class="bldtxt" style="font-weight:normal; font-size:11px;"><input type="checkbox"  name="accept" style="border:none; " checked  >
				  I authorize Deal4loans.com & its partnering banks to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</Td>
				  </tr>
				 <tr>
	   <td  colspan="2" align="left" style="padding:5px;"> <div id="hdfclife"></div></td>
		 </tr>
				
				<tr align="center">
				  <Td colspan="2"><br /><input type="image" name="Submit"  src="new-images/el/get-quote.jpg"  style="width:115px; height:29px; border:none; " /></Td>
				  </tr>
                </table>
				</form></td>
              </tr>
              <tr>
                <td valign="top"><img src="images/cl/frm-btm.gif" width="289"   height="21"></td>
              </tr>
              </table></td>
            <td width="33" height="336" align="right" valign="top"><img src="new-images/el/right-bg.jpg" /></td>
          </tr>
		  
        </table></td>
      </tr>
    </table></td>
  </tr>
  <Tr>
  <td height="10" align="center" valign="middle" ><?php include 'footer_landingpage.php'; ?></td>
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
