<?php
require 'scripts/functions.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Credit Card Rewards | Debit Card Rewards | Discounts offers on Credit Cards | Compare Credit Debit Card Rewards Points</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="Credit Card Rewards, Rewards on Credit cards, various rewards on credit cards, credit cards, rewards, card rewards points, rewards points, Discount offers on credit cards, Debit Cards offers">
<meta name="Description" content="Credit Card Rewards: Compare rewards points on credit cards and Debit Cards. Check Discount Offers on various Credit and Debit Cards in India. SBI Card, Barclays Credit Cards, CITIBank credit cards, Kotak Credit Cards, Debit cards">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<!--
<link href="style/glowing.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
-->
<script Language="JavaScript" Type="text/javascript">
function ccofferform(Form)
{
	if(document.CC_offers_mailer.name.value=="") 
			{
				alert("Please fill your name.");
				document.CC_offers_mailer.name.focus();
				return false;
			}
			if(document.CC_offers_mailer.mobile.value=="") 
			{
				alert("Please fill your mobile.");
				document.CC_offers_mailer.mobile.focus();
				return false;
			}
			
	 if(isNaN(document.CC_offers_mailer.mobile.value)|| document.CC_offers_mailer.mobile.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value in mobile no");
			  document.CC_offers_mailer.mobile.focus();
			  return false;  
		}
        if (document.CC_offers_mailer.mobile.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.CC_offers_mailer.mobile.focus();
				return false;
        }
        if ((document.CC_offers_mailer.mobile.value.charAt(0)!="9") && (document.CC_offers_mailer.mobile.value.charAt(0)!="8") && (document.CC_offers_mailer.mobile.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.CC_offers_mailer.mobile.focus();
                return false;
        }

		if(document.CC_offers_mailer.email.value=="") 
			{
				alert("Please fill your Email.");
				document.CC_offers_mailer.email.focus();
				return false;
			}
			
		if(document.CC_offers_mailer.email.value!="")
		{
			if (!validmail(document.CC_offers_mailer.email.value))
			{
				//alert("Please enter your valid email address!");
				document.CC_offers_mailer.email.focus();
				return false;
			}
		}
	if (document.CC_offers_mailer.city.selectedIndex==0)
	{
		alert("Please select city to Continue");
		document.CC_offers_mailer.city.focus();
		return false;
	}
}

function validmail(email1) 
{
	invalidChars = " :,;/";
	if (email1 == "")
	{
		// cannot be empty
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
	{		
		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
	}
	return true;
}</script>
</head>
<body>
<?php include 'middle-menu.php';?>
<div id="container" style="margin-top:70px;">
  <!--<div id="lftbar">-->
  <table width="695"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="695" align="center" valign="top" background="new-images/earn-hdng-new.gif" style=" color:#02568e; font-weight: bold; font-size:13px; background-repeat:no-repeat; line-height:34px; " height="50">Know your Credit/Debit Card Rewards and Discount Offers </td>
      </tr>
      <tr>
        <td background="new-images/earn-bg-new.gif"><table width="99%"  border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td width="663" height="30" valign="middle"> <div style="background-color:#f1faff; color:#000a10;  line-height:20px; padding-left:5px; font-size:12px; width:590px;">Do you know from the stack of Cards you hold which one Offers maximum Cash Back for you?</div></td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"> <div style="background-color:#f1faff; color:#000a10; line-height:20px; padding-left:5px; font-size:12px; width:640px; ">Are you using right Card to avail Maximum Discount, Cash Back to book Airline Ticket, Buying Grocery</div></td>
          </tr>
          <tr>
            <td height="20" align="left" valign="middle">&nbsp;</td>
            <td height="30"> <div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:250px; ">or Clothes from your preferred Brand?</div></td>
          </tr>
  <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"> <div style="background-color:#f1faff; color:#000a10; line-height:20px; padding-left:5px; font-size:12px; width:640px; ">All Quotes are free for customers. It's a totally free service for customers.</div></td>
          </tr>
		  <tr><td colspan="2">&nbsp;</td></tr>
		  <tr><td colspan="2"><table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
	 <tr>
        <td style=" padding:6px;"><table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="32"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;">Register here for latest Discounts, Offers & Reward information on Credit Card & Debit Cards </h1></td>
  </tr>
</table></td>
 </tr>
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0"  id="frm">
         
          <tr>
            <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
			<form  name="CC_offers_mailer" action="credit-card-archives-continue.php" method="POST" ONsubmit="return ccofferform(document.CC_offers_mailer);"><input type="hidden" name="source"  value="ccndcsite">
               <tr>
                 <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td width="19%" height="28" class="frmbldtxt" style="padding-top:3px; ">Full Name :</td>
                     <td width="32%" height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="name" id="name" style="width:150px;" maxlength="30"  onchange="insertData();" tabindex="1" /></td>
                     <td width="18%" height="28" class="frmbldtxt" style="padding-top:3px; ">Email Id</td>
                     <td width="31%" height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="email" style="width:150px;" maxlength="70" tabindex="2"/></td>
                   </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt" style="padding-top:3px; " colspan="2" align="center">Want Offers, Discounts &  Reward <br>&nbsp;&nbsp;&nbsp;&nbsp;information On</td>
					 <td height="28" class="frmbldtxt" style="padding-top:3px; " >City :</td>
                     <td height="28" class="frmbldtxt"  style="padding-top:3px; "><select name="city" style="width:150px;" tabindex="5">
<option value="Please Select">Please Select</option>
  <option value="Ahmedabad">Ahmedabad</option>
                                <option value="Aurangabad">Aurangabad</option>
                                <option value="Bangalore">Bangalore</option>
                                <option value="Baroda">Baroda</option>
                                <option value="Bhopal">Bhopal</option>
                                <option value="Bhubneshwar">Bhubneshwar</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Chennai">Chennai</option>
                                <option value="Cochin">Cochin</option>
                                <option value="Coimbatore">Coimbatore</option>
                                <option value="Cuttack">Cuttack</option>
                                <option value="Dehradun">Dehradun</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Faridabad">Faridabad</option>
                                <option value="Gaziabad">Gaziabad</option>
                                <option value="Gurgaon">Gurgaon</option>
                                <option value="Guwahati">Guwahati</option>
                                <option value="Hosur">Hosur</option>
                                <option value="Hyderabad">Hyderabad</option>
                                <option value="Indore">Indore</option>
                                <option value="Jabalpur">Jabalpur</option>
                                <option value="Jaipur">Jaipur</option>
                                <option value="Jamshedpur">Jamshedpur</option>
                                <option value="Kanpur">Kanpur</option>
                                <option value="Kochi">Kochi</option>
                                <option value="Kolkata">Kolkata</option>
                                <option value="Lucknow">Lucknow</option>
                                <option value="Ludhiana">Ludhiana</option>
                                <option value="Madurai">Madurai</option>
                                <option value="Mangalore">Mangalore</option>
                                <option value="Mysore">Mysore</option>
                                <option value="Mumbai">Mumbai</option>
                                <option value="Nagpur">Nagpur</option>
                                <option value="Nasik">Nasik</option>
                                <option value="Navi Mumbai">Navi 
                                  Mumbai</option>
                                <option value="Noida">Noida</option>
                                <option value="Patna">Patna</option>
                                <option value="Pune">Pune</option>
                                <option value="Ranchi">Ranchi</option>
                                <option value="Sahibabad">Sahibabad</option>
                                <option value="Surat">Surat</option>
                                <option value="Thane">Thane</option>
                                <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                <option value="Trivandrum">Trivandrum</option>
                                <option value="Trichy">Trichy</option>
                                <option value="Vadodara">Vadodara</option>
                                <option value="Vishakapatanam">Vishakapatanam</option>
                                <option value="Others">Others</option>
	 </select></td>
                   </tr>
				   
				    <tr valign="middle">
                     <td width="19%" height="28" class="frmbldtxt" style="padding-top:3px; " colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td  ><input type="checkbox" value="1" name="card_type_cc" id="card_type_cc" style="border:none;" tabindex="4"/></td>
            <td class="frmtxt"><b>Credit Card</b></td>
            <td ><input type="checkbox" value="2" name="card_type_dc" id="card_type_dc"  style="border:none;" tabindex="4"/></td>
            <td class="frmtxt"><b>Debit Card</b></td>
          </tr>
      </table></td>
                     <td width="18%" height="28" class="frmbldtxt" style="padding-top:3px; " colspan="2">&nbsp;</td>
                   </tr>
                 </table></td>
                 <td width="310" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td height="28" class="frmbldtxt">Mobile :</td>
                <td class="frmbldtxt">+91
        <input type="text" name="mobile" style="width:150px;" maxlength="10" tabindex="3" /></td>
              </tr>
			  <tr>
                <td height="28" class="frmbldtxt" colspan="2">&nbsp;</td>
              </tr>
			   <tr>
                <td height="28"  colspan="2" align="center"><input name="Submit" class="btnclr" type="Submit" value="Get Offers" /></td>
              </tr>
			   
			    
          
              
            </table></td>
               </tr>
			   
			   </form>
             </table></td>
          </tr>
              
			  
          <tr>
            <td width="76%" align="left" class="frmbldtxt"  style="font-weight:normal;">&nbsp;</td>
            <td width="24%">&nbsp;</td>
          </tr>
         

          </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table></td></tr>
 <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:620px; ">Disclaimer : All repayment period are over 6 months. No short term loans.</div>
</td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:545px; ">Do you know your Credit Card also Attracts Cash Back which alternate in off season?</div>

</td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:490px; ">Do you know which Credit Card/Debit Card can can Earn extra Fuel  for you ?</div>
</td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:490px; ">Know where to redeem your points to avail those "Handbags of Goodies" ?</div>

</td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:525px; ">Do you know your Debit Cards can Get you 3-10% Discounts at Major Restaurants.</div>
</td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:620px; ">Do you know by using your Credit Card at normal grocery purchases can add to your Travel Points </div>
</td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle">&nbsp;</td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:210px; ">and can get you Free Air Tickets.</div></td>          </tr>

        </table></td>
      </tr>
      <tr>
        <td width="960" height="14" align="left" valign="top"><img src="new-images/earn-bt-bg-new.gif" width="960" height="14" /></td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">&nbsp;</td>
      </tr>
      <tr>
        <td height="45" align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">To know all these updates and to ensure that your normal spends at          <a href="http://www.deal4loans.com/credit-cards.php" style=" color:#2a2200;" title="Credit Cards">Credit Cards</a> and Debit Cards can earn you more than 1% minimum and can go upto 10% in some cases,    <font style="font-size:13px; font-weight:bold; color:#70240a;">come Sign Up with us</font></td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; "><b>How I will get these Offers?</b></td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">These Offers will be sent to you on a monthly basis on your mail ID.</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; "><b>Customer Testimonial</b></td>
      </tr>
      <tr>
        <td height="42" align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">Quite interesting to know. For me Credit Card was only a 45 day free credit period but with these offers I could save Rs.500/- through discounts available on various cards</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle" style="font-size:13px; color:#70240a; line-height:18px; ">          <b>Here are Top Offers of Credit Card &amp; Debit Card</b></td>
      </tr>
      <tr>
        <td height="30" align="left" valign="middle"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; font-size:12px; width:610px; font-weight:bold;"> Credit Cards</div></td>
      </tr>
      <tr>
        <td height="25" align="left" valign="bottom" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold; padding-bottom:2px; ">Citibank Credit Card        </td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">          Use you IndianOil Citibank Titanium Credit Card to save up to 5% when you Fuel up your vehicle.</td>
      </tr>
      <tr>
        <td height="10"></td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold; "><a href="http://www.deal4loans.com/loans/credit-card/barclays-credit-card-eligibility-documents-apply/" style=" color:#70240a;" title="Barclays Credit Card">Barclays Credit Card</a></td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">Yatra Barclaycard Platinum Card Offers 50% Discount on weekend stays and 50% Discount on buffet Lunch(maximum 4 persons at a time) Fortune Hotels. </td>
      </tr>
      <tr>
        <td height="10"></td>      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold; "><a href="http://www.deal4loans.com/loans/credit-card/hdfc-credit-card-eligibility-apply/"  style=" color:#70240a;" title="HDFC Credit Card">HDFC Credit Card</a></td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">Book your traveling through akbartravelsonline.com and Get 15% off on Spicejet, 10% on Paramount Airways, 15% off on all domestic Hotel bookings and many more.</td>
      </tr>
      <tr>
        <td height="10"></td>      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold;"><a href="http://www.deal4loans.com/loans/credit-card/kotak-mahindra-credit-cards-eligibility-offers-documents-apply/"  style=" color:#70240a;" title="Kotak Credit Card">Kotak Credit Card</a></td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">Enjoy following Offers when you book your Travel through Makemytrip.com<br /> 
	a) Flat Rs.5000 Cash Back on Europe/US packages.<br />
	b) Flat Rs.2000 Cash Back on South East Asia Packages.<br />
	c) 10% Cash Back on Fly Free Summer Holiday Packages.
		

		
</td>
      </tr>
      <tr>
        <td height="10"></td>      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold;"><a href="http://www.deal4loans.com/loans/banks/sbi-credit-cards/"  style=" color:#70240a; " title="SBI Credit Card">SBI Credit Card</a></td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; "> Get Exclusive Discount at Fortis network hospital across the country<br />
 
          a) Get up to 50% Discount on special Health Check package.<br />
b) 10% Discount on preventive Health Check package, OPD consultations, pathological investigations & radiological diagnostics.<br />
	c) 10% Discount on In-hospital charges like room rent.
     </td>
      </tr>
      <tr>
        <td height="10"></td>
      </tr>
      <tr>
        <td height="25" style="font-size:12px; color:#2a2200; line-height:18px; ">Click to know Latest <a href="http://www.deal4loans.com/credit-card-n-debit-card-offers.php" style=" color:#2a2200; " title="Credit Card Offers">Credit Card Offers</a></td>
      </tr>
      <tr>
        <td height="10"></td>      </tr>
      <tr>
        <td height="30" align="left" valign="middle"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; font-size:12px; width:610px; font-weight:bold;">Debit Card</div></td>
      </tr>
      <tr>
        <td height="25" align="left" valign="bottom" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold; padding-bottom:2px; ">Axis Bank Debit Card

</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; "> Get flat 15% off on Pizzas &amp; Garlic Breads at Dominos</td>
      </tr>
      <tr>
        <td height="10"></td>      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold; ">Barclays Debit Card

</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">Barclays Platinum Debit Card holders can get 6% Off* on Studded Diamond Jewellery and 15% Off* on making charges of plain gold jewellery bought from  Tanishq</td>
      </tr>
      <tr>
        <td height="10"></td>      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold; ">HDFC Debit Card</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">Get 15% Discount* on booking a ticket through www.goindigo.in. Use the coupon code FLYHDFC3 while booking the Ticket .</td>
      </tr>
      <tr>
        <td height="10"></td>      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold;">ICICI Debit Card </td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px;"> MakemyTrip Offers flat 30% cash back on Hotel bookings, use the deal code "ICICIHOTEL" to avail this offer </td>
      </tr>
    <tr> 
        <td height="10"></td>      
    </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold;">SBI Debit Card </td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">  On every spent of Rs.100 at  Fun Cinemas , get 20 FreedomPoints. </td>
      </tr>
      <tr>
        <td height="10"></td>
      </tr>
      <tr>
        <td height="25" style="font-size:12px; color:#2a2200; line-height:18px; ">Click to know Latest <a href="http://www.deal4loans.com/credit-card-n-debit-card-offers.php" style=" color:#2a2200; " title="Debit Card Offers">Debit Card Offers</a></td>
      </tr>
      <tr>
        <td height="10"></td>      
      </tr>
    </table>      
	<div align="right"><a href="#pg_up" style="color:#1C50B0; text-decoration:none; ">Top<img width="12" height="18" border="0" alt="Top" src="new-images/top.gif"/></a></div>
<!--</div>--><?php //include '~Right-new-card1.php'; ?>
<? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php #include '~Bottom-new.php';?> <? } ?>

</div>
<?php include 'footer_sub_menu.php';?>
</body>
</html>

