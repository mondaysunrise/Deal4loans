<?php
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ask Amitoj Loan Queries | Loan Guru | Debt Consolidation| Deal4loans</title>
<!--<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">-->
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="Debt Consolidation Solutions, Ask Amitoj, Loan Guru, Deal4loans Guru, Loan Queries">
<meta name="description" content="Get loan advice, loan eligibility and EMI calculators and other tips for your car, personal loans & credit card from experts on Deal4loans.com." />

<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

 <script type='text/javascript' language='javascript'>
function othercity1()
{
	if(document.ask_amitoj_form.City.value=='Others')
	{
		document.ask_amitoj_form.City_Other.disabled=false;
	}
	else
	{
		document.ask_amitoj_form.City_Other.disabled=true;
	}

}
 function validemail(email1) 
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

function valButton3() {
    var cnt = -1;
	var i;
    for(i=0; i<document.ask_amitoj_form.Loan_Any.length; i++) 
	{
        if(document.ask_amitoj_form.Loan_Any[i].checked)
		{
			cnt=i;
			
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}		
function validmobileno(phone) 
{
	
	atPos = phone.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{
		alert("Mobile number cannot start with 0.");
		return false;
	}
	if(!checkData(document.ask_amitoj_form.custPhone, 'Mobile number', 10))
		return false;

return true;
}
function askamitoj(Form)
{
	var myOption;		
	var myOptionCC;
	var i;
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";


	if(Form.custName.value=="")
	{
		alert("Please fill your name.");
		Form.custName.focus();
		return false;
	}
 if(Form.custEmail.value=="")
	{
		alert("Please fill your email id.");
		Form.custEmail.focus();
		return false;
	}
	 if(Form.custEmail.value!="")
	{
		if (!validemail(Form.custEmail.value))
		{
			//alert("Please enter your valid email address!");
			Form.custEmail.focus();
			return false;
		}
		
	
	}
	
	if((space.test(Form.day.value)) || (Form.day.value=="dd"))
{
alert("Kindly enter your Date of Birth");
Form.day.select();
return false;
}

else if(!num.test(Form.day.value))
{
alert("Kindly enter your Date of Birth(numbers Only)");
Form.day.select();
return false;
}

else if((Form.day.value<1) || (Form.day.value>31))
{
alert("Kindly Enter your valid Date of Birth(Range 1-31)");
Form.day.select();
return false;
}

else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
{
alert("Kindly enter your Month of Birth");
Form.month.select();
return false;
}

else if(!num.test(Form.month.value))
{
alert("Kindly enter your Month of Birth(numbers Only)");
Form.month.select();
return false;
}

else if((Form.month.value<1) || (Form.month.value>12))
{
alert("Kindly Enter your valid Month of Birth(Range 1-12)");
Form.month.select();
return false;
}

else if((Form.month.value==2) && (Form.day.value>29))
{
alert("Month February cannot have more than 29 days");
Form.day.select();
return false;
}

else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
{
alert("Kindly enter your Year of Birth");
Form.year.select();
return false;
}

else if(!num.test(Form.year.value))
{
alert("Kindly enter your Year of Birth(numbers Only) !");
Form.year.select();
return false;
}

else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
{
alert("February cannot have more than 28 days.");
Form.day.select();
return false;
}

else if(Form.year.value.length != 4)
{
alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
Form.year.select();
return false;
}
else if((Form.year.value < "1945") || (Form.year.value >"1989"))
{
alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
Form.year.select();
return false;
}
else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
{
alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
Form.year.select();
return false;
}

else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
{
alert("Cannot have 31st Day");Form.day.select();
return false;
}

if(Form.custCity.selectedIndex==0)
{
	alert("Please enter City Name to Continue");
	Form.custCity.focus();
	return false;
}

/*else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
{
alert("Kindly fill in your other City!");
Form.City_Other.focus();
return false;
}
*/
if(Form.custEmployment_Status.selectedIndex==0)
{
	alert("Please select employment status ");
	Form.custEmployment_Status.focus();
	return false;
}
	 if(Form.custPhone.value=="")
	{
		alert("Please fill your Mobile No.");
		Form.custPhone.focus();
		return false;
	}
  	  if(isNaN(Form.custPhone.value)|| Form.custPhone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  Form.custPhone.focus();
			  return false;  
		}
        if (Form.custPhone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 Form.custPhone.focus();
				return false;
        }
        if (Form.custPhone.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 Form.custPhone.focus();
                return false;
		}
  
	/*if(Form.custDependants.selectedIndex==0)
	{
		alert("Please select No of Dependents");
		Form.custDependants.focus();
		return false;
	}
*/	
	if(Form.custEarningMembers.selectedIndex==0)
	{
		alert("Please select Number of Earning Members");
		Form.custEarningMembers.focus();
		return false;
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
</script>

<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>
<div id="dvMainbanner">
<? if ((($_REQUEST['flag'])!=1))
	{ ?>
    <?php include '~Upper.php';?><? } ?> 
    <div id="dvbannerContainer"><table width="777" height="161" border="0" Background="images/plain copy.gif" >
      <tr><td width="30%" align="center"><img src="images/amitojsir.gif"></td><td width="70%" align="left" valign="top"><font style="font-size:20px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#FFFFFF;">Ask Amitoj</font>
      <p style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#FFFFFF;"><b>Profile :- </b> Masters in Marketing from JBIMS, Amitoj has worked with Citibank
for more than 9 years in the areas of Operations, Credit, Sales and
Marketing. He has more than 4 years of exposure to Personal Loans and more
than 3 years to Credit Cards in the areas of product development,
acquisition channel enhancement and credit underwriting.</p>
</td>
</tr>
<tr>
<td align="center"  style="font-size:12px;font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-weight:bold;">Amitoj Sethi (Director)</td>
<td align="right" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; color:#FFFFFF;">Loans by choice not by chance!!</td>
</tr></table> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
    <div id="dvMaincontent">
	 
	<h2 class="head2" style="margin-bottom:0px; margin-top:0px; padding-left:150px;">Caught in a debt trap ?</h2>
	<h1 class="head2">Ask Amitoj for your Loan Query</h1> 
	  <p>
		<font face="Verdana" size="1" color="0F74D4">•</font>  Are you finding a way to control your ever increasing credit card bills?<br>
		<font face="Verdana" size="1" color="0F74D4">•</font>  Do you want to pay single EMI for your currently running loans?<br>
		<font face="Verdana" size="1" color="0F74D4">•</font>  Are you a victim of heavy credit card bills and your EMIs on personal loan etc?<br>
	<font face="Verdana" size="1" color="0F74D4">•</font>  Do you have any product related query?</p>
		<p>
			If your answers to above given questions is YES, then you need a <font color="0F74D4"><b>Personalised Debt Consolidation</b></font> plan from our loan and credit card guru.
<br><br>

			<b><font color="0F74D4">A Debt consolidation</font></b> Plan basically looks for ways to reduce your total debt servicing out flow by combining your various loans and credit card outstanding and repaying them using the cheapest available funding option best suited for the individual. This single payment is typically lower than the sum of the payments on the individual debts. This is often done to secure a lower interest rate, secure a fixed interest rate or for the convenience of servicing only one loan.</p>
			<p>
<font color="0F74D4"> Hurry fill the form now and get an Expert's Advice on your query!!</font> </p>
		<table width="380" border="0" align="left" cellpadding="0" cellspacing="0" style="padding-left:50px;">
          <tr>
            <td align="center"><table width="300" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="10" height="26" align="left" valign="top"><img src="images/frm-lft-bg.gif" width="10" height="26"></td>
                  <td align="center" bgcolor="#3178BB"  class="head2" style="color:#FFFFFF; ">Personal Details (Step 1)</td>
                  <td width="10" height="26" align="right" valign="top"><img src="images/frm-rgt-bg.gif" width="10" height="26"></td>
                </tr>
              </table>          </tr>
          <tr>
            <td><table width="380" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#F2F6FA"   style="border:1px solid #6B9ECE;">
                <tr>
                  <td><table border="0" width="95%"cellpadding="4" cellspacing="0" id="frm" align="center">
                      <form name="ask_amitoj_form"  method="post" action="ask-amitoj-c.php" onSubmit="return askamitoj(document.ask_amitoj_form);">
                        <tr>
                          <td width="46%">First Name<font size="1" color="#FF0000">*</font></td>
                          <td width="54%" ><input type="text" name="custName" style="width:150px;" maxlength="30"></td>
                        </tr>
                        <tr>
                          <td>Email Id<font size="1" color="#FF0000">*</font></td>
                          <td ><input type="text" name="custEmail" style="width:150px;" maxlength="30"></td>
                        </tr>
                        <tr>
                          <td>Date of Birth </td>
     <td class="formtext"><input name="day" value="dd" type="text" id="day" size="4" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" onBlur="onBlurDefault(this,'dd');"  onFocus="onFocusBlank(this,'dd');">
			<input name="month" id="month" size="4" maxlength="2" onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" class="style4" onBlur="onBlurDefault(this,'mm');"  onFocus="onFocusBlank(this,'mm');">
			<input name="year" type="text" id="year" value="yyyy" size="4" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; class="style4" onBlur="onBlurDefault(this,'yyyy');"  onFocus="onFocusBlank(this,'yyyy');">
         </td>                        </tr>
                        <tr>
                          <td>City Name</td>
                          <td ><select style="width:150px;" name="custCity" id="custCity" >
                              <?=getCityList($City)?>
                            </select>                          </td>
                        </tr>
                        <tr>
                          <td>Employment Status<font size="1" color="#FF0000">*</font></td>
                          <td ><select style="width:150px;" name="custEmployment_Status" id="custEmployment_Status">
                            <option selected value="-1">Please select</option>
							  <option value="1">Salaried</option>
                              <option value="0">Self Employed</option>
                            </select>                          </td>
                        </tr>
                        <tr>
                          <td>Mobile No.</td>
                          <td >+91
                            <input type="text" name="custPhone" id="custPhone" style="width:123px;" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" ></td>
                        </tr>
                        <tr>
                        <tr>
                          <td>No. of  Dependants</td>
                          <td ><select style="width:150px;" name="custDependants">
                              <option selected value="-1">Please select</option>
                              <option  value="0">0</option>
							  <option  value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                          </select></td>
                        </tr>
                                                
                        <tr>
                          <td>No. of earning members</td>
                          <td><select style="width:150px;" name="custEarningMembers">
                              <option selected value="-1">Please select</option>
                              <option  value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                          </select></td>
                        </tr>
                        
                        <tr>
                          <td colspan="2" align="center" ><br>
                              <input value="" type="submit" style=" background-image:url(images/sbmt-btn.gif); border:0px; width:64px; height:30px; margin-bottom:0px;"  /></td>
                        </tr>
                      </form>
                  </table></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
    </div>
    <?
  include '~Right2.php';

  ?>
  </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom.php';?><? } ?>
  </body>
</html>