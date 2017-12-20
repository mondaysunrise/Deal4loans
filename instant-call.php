<?php
	$ShowDate = date("H:i:s");
	$StartTime = "10:00:00";
	$EndTime = "17:40:59";	
//	$EndTime = "17:59:59";
	$Day = date("l");
	
	if($ShowDate > $StartTime && $ShowDate < $EndTime && $Day!='Sunday')			
	{
		$TimePreference = 1;	
	}
	else
	{
		$TimePreference = 0;
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Persoanl Loan Instant Call</title>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
	<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="javascript">
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

//var btn2=valButton2();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(document.ivr_form.full_name.value=="" || document.ivr_form.full_name.value=="Full Name" )
	{
		alert("Please fill your Full name.");
		document.ivr_form.full_name.focus();
		return false;
	}
	if(document.ivr_form.full_name.value!="" || document.ivr_form.full_name.value=="Full Name" )
	{
		 if(containsdigit(document.ivr_form.full_name.value)==true)
		{
			alert("Full Name contains numbers!");
			document.ivr_form.full_name.focus();
			return false;
		}
	}
  for (var i = 0; i <document.ivr_form.full_name.value.length; i++) {
  	if (iChars.indexOf(document.ivr_form.full_name.value.charAt(i)) != -1) {
  	alert ("Full Name has special characters.\n Please remove them and try again.");
	document.ivr_form.full_name.focus();

  	return false;
  	}
  }

	if(document.ivr_form.mobile_no.value=="")
	{
		alert("Please fill your mobile number.");
		document.ivr_form.mobile_no.focus();
		return false;
	}
		if(isNaN(document.ivr_form.mobile_no.value)|| document.ivr_form.mobile_no.value.indexOf(" ")!=-1)
	{
		  alert("Enter numeric value");
		  document.ivr_form.mobile_no.focus();
		  return false;  
	}
	if (document.ivr_form.mobile_no.value.length < 10 )
	{
			alert("Please Enter 10 Digits"); 
			 document.ivr_form.mobile_no.focus();
			return false;
	}
	if (document.ivr_form.mobile_no.value.charAt(0)!="9")
	{
			alert("The number should start only with 9");
			 document.ivr_form.mobile_no.focus();
			return false;
	}

 	if(document.ivr_form.email.value!="")
	{
		if (!validmail(document.ivr_form.email.value))
		{
			//alert("Please enter your valid email address!");
			document.ivr_form.email.focus();
			return false;
		}
	}
	if (document.ivr_form.city.value=="Select City" )
	{
		alert("Please enter City Name to Continue");
		document.ivr_form.city.focus();
		return false;
	}


	
if (document.ivr_form.day.selectedIndex==0)
	{
		alert("Please enter Day to Continue");
		document.ivr_form.day.focus();
		return false;
	}
	
	if (document.ivr_form.month.selectedIndex==0)
	{
		alert("Please enter Month to Continue");
		document.ivr_form.month.focus();
		return false;
	}
	
	if (document.ivr_form.year.selectedIndex==0)
	{
		alert("Please enter Year to Continue");
		document.ivr_form.year.focus();
		return false;
	}

	if(document.ivr_form.Net_Salary.value=="")
	{
		alert("Please fill your Annual Income.");
		document.ivr_form.Net_Salary.focus();
		return false;
	}

	
	if (document.ivr_form.Employement_Status.selectedIndex==0)
	{
		alert("Please select Employement Status.");
		document.ivr_form.Employement_Status.focus();
		return false;
	}

		if(!document.ivr_form.accept.checked)
		{
			alert("Accept the Terms and Condition");
			document.ivr_form.accept.focus();
			return false;
		}
}


</script>

<link href="ivr-personal-loan.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="443" height="142" align="left" valign="top"><img src="images/ivr-pl-logo.gif" width="443" height="142" /></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="26" height="154" align="left" valign="top"><img src="images/ivr-pl-left-big-shadow.gif" width="26" height="154" /></td>
                <td width="113" height="154" align="left" valign="top"><img src="images/ivr-stop-watch.gif" width="113" height="154" /></td>
                <td width="304" height="154" align="left" valign="top"><img src="images/ivr-pl-blue-cont.gif" width="304" height="154" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="62" align="left" valign="top" background="images/ivr-pl-easy-img.gif" style="background-repeat:no-repeat; background-position:top;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="8" background="images/ivr-pl-lft-shadow.gif" style="background-repeat:repeat-y; background-position:top;">&nbsp;</td>
                <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="45" align="left" valign="top" style="background-repeat:no-repeat; height:80px; background-position:right top; "><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="left" valign="top" background="images/ivr-pl-bot-bg.gif"  style="background-repeat:repeat-x; height:14px; background-position:bottom; padding-top:30px;"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
                              <tr>
                                <td width="18" height="153" align="right" valign="top"><img src="images/ivr-pl-lft-brkt.gif" width="14" height="153" /></td>
                                <td valign="top"><ol>
                                    <li>Apply &amp; Get Instant Call from 43009300</li>
                                  <li>Speak to Banks Directly (<font color="#872600">Deutsche, Citibank, 
                                    
                                    ABN-AMRO, ICICI, HDFC &amp; Many more...</font>)</li>
                                  <li>Get Instant Approval from Banks</li>
                                  <li>Compare Offers from all the Banks &amp; Choose the Best Deal!</li>
                                </ol></td>
                              </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td  valign="middle" class="bdytext" style="padding:6px 0px 8px 18px;" ><b class="heading-text"  >Benefits to Customers 
 
</b>						 							 </td>
                        </tr>
                        <tr>
                          <td valign="top" class="bdytext" style="padding-left:25px; font-weight:bold; font-size:12px; padding-top:0px; padding-bottom:0px; color:#4F3C01; line-height:22px;">1. Quick Reply: <span style="font-weight:normal; font-size:11px;">No Wait for Calls</span><br />
2.	Rate Comparison: <span style="font-weight:normal; font-size:11px;">Stand Chance to Compare Rates during the Same Call</span><br />
3.	Status of Loan: <span style="font-weight:normal; font-size:11px;">Get Approved/Rejected for Loan in 10 minutes with 4 Banks</span><br />
4.	Documentation: <span style="font-weight:normal; font-size:11px;">Appointment Fixation with Bank right away</span><br />
5.	Cash: <span style="font-weight:normal; font-size:11px;">Quicker Loan Disbursement</span><br />
  </td>
                        </tr>
                        
                        
                    </table></td>
                  </tr>
                  
                </table></td>
              </tr>
            </table></td>
          </tr>
          
          
        </table></td>
        <td width="325" valign="top"  background="images/ivr-pl-rgt-shadow.gif" style="background-repeat:repeat-y; background-position:right bottom;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="337" height="142" align="right" valign="top"><img src="images/ivr-pl-rgt-img.gif" width="337" height="142" /></td>
          </tr>
          <tr>
            <td width="337" height="133" align="right" valign="top"><img src="images/ivr-pl-wmn-rgt.gif" width="337" height="133" /></td>
          </tr>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="tble-border" align="center" valign="top"><table width="95%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="14" height="36" align="left" valign="top"><img src="images/ivr-pl-tp-lft-curv.gif" width="14" height="36" /></td>
                              <td bgcolor="#CCA600" class="wht-text">Know Your EMIs</td>
                              <td width="14" height="36"><img src="images/ivr-pl-tp-rgt-curv.gif" width="14" height="36" /></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td align="center" valign="top">
						
						<!--<form id="ivr_form" name="ivr_form" method="post" action="instant-call-continue.php" onsubmit="return chkform();">-->
                        
						<form id="ivr_form" name="ivr_form" method="post" action="instant-call-continue.php" onsubmit="return chkform();">
						    <table width="98%" border="0" align="right" cellpadding="2" cellspacing="3" class="form-text">
                              <tr>
                                <td colspan="2" height="8"  ></td>
                              </tr>
                              <tr>
                                <td width="44%"  ><strong>
                                  <label for="full_name">Name</label>
                                </strong></td>
                                <td width="56%"  ><strong>
                                  <input type="text" name="full_name" tabindex="1" id="full_name" style="width:140px;" />
                                </strong></td>
                              </tr>
                              <tr>
                                <td  ><strong>
                                  <label for="Mobile">Mobile No. </label>
                                </strong></td>
                                <td  ><strong>
                                  <input type="text" name="mobile_no" id="mobile_no" maxlength="10" onchange="intOnly(this);" onkeypress="intOnly(this)" onkeyup="intOnly(this);"  style="width:140px;" tabindex="2" />
                                </strong></td>
                              </tr>
                              <tr>
                                <td  ><strong>
                                  <label for="email">Email ID </label>
                                </strong></td>
                                <td  ><strong>
                                  <input type="text" name="email" id="email" style="width:140px;" tabindex="3" />
                                </strong></td>
                              </tr>
                              <tr >
                                <td  ><strong>
                                  <label for="City">City</label>
                                </strong></td>
                                <td  ><strong>
                                  <select name="city" id="city"  style="width:140px;" tabindex="5" >
                                    <option value="Select City">Please Select</option>
                                    <option value="Ahmedabad">Ahmedabad</option>
                                    <option value="Bangalore">Bangalore</option>
                                    <option value="Chennai">Chennai</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Faridabad">Faridabad</option>
                                    <option value="Ghaziabad">Ghaziabad</option>
                                    <option value="Gurgaon">Gurgaon</option>
                                    <option value="Hyderabad">Hyderabad</option>
                                    <option value="Mumbai">Mumbai</option>
                                    <option value="Navi Mumbai">Navi Mumbai</option>
                                    <option value="Pune">Pune</option>
                                    <option value="Thane">Thane</option>
                                  </select>
                                  <!--<input type="text" name="city" tabindex="3" id="city" />-->
                                </strong></td>
                              </tr>
                              <tr >
                                <td  ><strong>
                                  <label for="textfield">DOB</label>
                                </strong></td>
                                <td  ><strong>
                                  <select id='day' name='day' class="dob" tabindex="6" style="width:40px;" >
                                    <option value='-1'>DD</option>
                                    <?php
for($i=1;$i<=31;$i++)
{
	echo "<option value='".$i."'>".$i."</option>";
}
?>
                                  </select>
                                  <select id='month' name='month' class="dob" tabindex="7"  style="width:40px;" >
                                    <option value='-1'>MM</option>
                                    <?php
$MonthArray = array("Jan", "Feb","Mar","Apr", "May", "Jun","Jul","Aug","Sep","Oct","Nov","Dec");
for($i=0;$i<count($MonthArray);$i++)
{
	$MonthValue = $i+1;
	echo "<option value='".$MonthValue."'>".$MonthArray[$i]."</option>";
}
?>
                                  </select>
                                  <select id='year' name='year' class="dob" tabindex="8"  style="width:50px;" >
                                    <option value=''>YY</option>
                                    <?php
for($i=1987;$i>=1950;$i--)
{
	echo "<option value='".$i."'>".$i."</option>";
}
?>
                                  </select>
                                </strong></td>
                              </tr>
                              <tr >
                                <td  ><strong>
                                  <label for="Net_Salary">Annual Income </label>
                                </strong></td>
                                <td  ><strong>
                                  <input  style="width:140px;" name="Net_Salary" id="Net_Salary" onfocus="this.select();" onchange="intOnly(this);"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');" tabindex="9" />
                                </strong></td>
                              </tr>
                              <tr >
                                <td colspan="2" >
<span id='formatedIncome' style='font-size:11px; color:#4A3D02;font-Family:Verdana; font-weight:normal;'></span>
<span id='wordIncome' style='font-size:11px; color:#4A3D02; font-Family:Verdana; font-weight:normal;'></span></td>
                              </tr>
                              <tr >
                                <td  ><strong>
                                  <label for="Employement_Status">Employment Status </label>
                                </strong></td>
                                <td  ><strong>
                                  <select name="Employement_Status" size="1" id="Employement_Status" style="width:140px;" tabindex="10" >
                                    <option value="0">Please Select</option>
                                    <option value="Salaried">Salaried</option>
                                    <option value="Self Employed">Self Employed</option>
                                  </select>
                                </strong></td>
                              </tr>
							  <?php
							  if($TimePreference != 1)
							  {
							  ?>
							  <tr >
                                <td  colspan="2"><strong>
                                  <label for="TimeSlab">Preferable Time for Next Working Day</label>
                                </strong></td></tr>
								<tr>
								<td>&nbsp;</td>
                                <td  ><strong>
                                  <select name="TimeSlab" size="1" id="TimeSlab" style="width:140px;" tabindex="11" >
                                  <!--  <option value="0">Select Time </option>-->
                                    <option value="1">10 AM -11 AM</option>
                                    <option value="2">11 AM - 12PM</option>
									<option value="3">12 PM - 1 PM</option>
                                    <option value="4">1 PM - 2 PM</option>
									<option value="5">2 PM - 3 PM</option>
                                    <option value="6">3 PM - 4 PM</option>
									<option value="7">4 PM - 5 PM</option>
                                    <option value="8">5 PM - 6 PM</option>
                                  </select>
                                </strong></td>
                              </tr>
							  <?php
							  }
							  ?>
                              <tr >
                                <td colspan="2" style="font-weight:normal; font-size:11px;"><input type="checkbox" name="accept" id="accept" style="border:none;" />
								<input type="hidden" name="StartTime" id="StartTime" value="<?php echo $StartTime; ?>" />
								<input type="hidden" name="EndTime" id="EndTime" value="<?php echo $EndTime; ?>" />
									               I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and agree to the Terms And Condition.</td>
                              </tr>
                              <tr >
                                <td height="40" colspan="2" align="center" valign="middle"><input type="submit" name="Submit" value="Submit" class="sbmt-btn" /></td>
                              </tr>
                            </table>
                        </form></td>
                      </tr>
                  </table></td>
                  <td  width="8" align="center" valign="top"  background="images/ivr-pl-rgt-shadow.gif" style="background-repeat:repeat-y; background-position:top; width:8px;">&nbsp;</td>
                </tr>
                
                
                
            </table></td>
          </tr>
         <!--   <tr>
            <td  class="heading-text">Testimonials </td>
          </tr>
        <tr>
            <td  class="bdytext" style="padding-right:15px;">Loan Taking process was never so easy!
                It&rsquo;s as easy as withdrawing cash from ATMs! Good Job<div style="float:right;  font-weight:bold;">Kirti</div> </td>
          </tr>-->
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top" style="background-repeat:no-repeat; background-position:left top;"><table width="100%" border="0" align="right" cellpadding="0" cellspacing="0">
	<tr>
	<td width="8" background="images/ivr-pl-lft-shadow.gif" style="background-repeat:repeat-y; background-position:top;">&nbsp;</td>
	    <td valign="top"  background="images/ivr-pl-bot-bg.gif"  style="background-repeat:repeat-x; height:14px; background-position:top;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          
		   <tr>
		     <td valign="bottom" class="heading-text" style="padding:0px;" >&nbsp;</td>
		     <td height="38"   colspan="2" valign="bottom" class="heading-text" style="padding:0px;" >Testimonials</td>
		     </tr>
		   <tr>
		     <td valign="top" class="bdytext" style="padding:0px;" >&nbsp;</td>
		     <td colspan="2" valign="top" class="bdytext" style="padding:0px;" >Loan Taking process was never so easy! It’s as easy as withdrawing cash from ATMs! Good Job<div style="float:right; padding-right:175px; font-weight:bold;">Kirti</div></td>
		     </tr>
		   <tr>
		     <td valign="bottom"  background="images/ivr-pl-bot-bg.gif" class="heading-text"  style="background-repeat:repeat-x;   background-position:top; padding:0px;" >&nbsp;</td>
		     <td height="38" colspan="2" valign="bottom"  background="images/ivr-pl-bot-bg.gif" class="heading-text"  style="background-repeat:repeat-x;   background-position:top; padding:0px;" >Helpful Tips for Personal Loan</td>
		     </tr>
		   <tr>
		     <td valign="top" class="bdytext">&nbsp;</td>
<td valign="top" colspan="2" class="bdytext" style="padding-left:0px;">Your eligibility &amp; rates for Personal loans are provided on the basis of income, track record with any bank, credit card usage/payments and many more. To get the critical information for personal loan, Apply Now!<br />
 <img src="http://www.deal4loans.com/images/spacer.gif" width="728" height="5" align="center" />
                        As it is an unsecured loan so banks try gauging your intention to pay loan. Customers tend to make mistakes while entering into deals, which is not beneficial to them, so its better to compare all the variables given by different banks before signing a loan agreement. The parameters on the basis of which you can compre a Personal Loan are: <br />
                        <div style="padding-left:25px; padding-top:10px; font-weight:bold;" >1.	Eligibility. <br />
                          2.	Interest rates best suited. <br />
                          3.	Processing Fees. <br />
                          4.	Pre-payment/Foreclosure charges. <br />
                          5.	Document required. <br />
              6.	Turn Around Time.</div></td>            </tr>
          
          <tr>
            <td width="17" bgcolor="#A7A110"></td>
            <td width="747"  height="3" colspan="2" bgcolor="#A7A110"></td>
            </tr>
        </table></td>
        <td width="8" background="images/ivr-pl-rgt-shadow.gif" style="background-repeat:repeat-y; background-position:top; width:8px;">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<script src="http://www.google-analytics.com/urchin.js"  
type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1312775-1";
urchinTracker();
</script>
</body>
</html>
