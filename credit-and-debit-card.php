<?php
	header("Location: credit-card-n-debit-card-offers.php");
	require 'scripts/functions.php';
	session_start();
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Credit Cards| Credit Cards India| Credit Cards Apply| Credit Cards Compare | Deal4Loans - Compare Apply</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="credit cards online information, credits cards schemes, credit card benefits, discounts on credits cards, compare credit cards in india, best credit card providers, apply online for credit cards, credit cards, credit card plans, online credit card, convenient credit card, Co branded credit cards, free credit cards">
<meta name="Description" content="Get online information on best credit cards in India. We also provide information on different credit card schemes. This information will help you to compare credit card features like service charges, annual fees, add on cards, interest free credit period, zero liability on lost cards, free insurance coverage etc.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
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
        if ((document.CC_offers_mailer.mobile.value.charAt(0)!="9") && (document.CC_offers_mailer.mobile.value.charAt(0)!="8"))
		{
                alert("The number should start only with 9 or 8");
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
/**AJAX SCRIPT**************************************************************/


var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
		
		function getdivdetailsdc()
		{
			//alert('hello');
			//alert(document.getElementById('card_type').value);
			var card_type=document.getElementById('card_type').value;		
			if((card_type!=""))
			{
				var queryString = "?card_type=" + card_type;
		//alert(queryString); 
				ajaxRequest.open("GET", "get_ccdetails.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{				
						// alert(ajaxRequest.responseText);
						var ajaxDisplay = document.getElementById('myDiv1');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					  

					   
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}

	window.onload = ajaxFunction;
/***********************************************************/

function addElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.CC_offers_mailer.card_type.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<tr>                       <td width="75" height="26" align="left" class="frmtxt">Credit Card</td>                        <td align="left"><select name="city" style="width:135px; font-size:11px;"><option>Please Select</option> <option>CC Card</option></select></td></tr>';
				

			}
		}
		
		return true;

	}
	function addDCElement()
{
		var ni = document.getElementById('myDCDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.CC_offers_mailer.card_type.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<tr>                       <td width="75" height="26" align="left" class="frmtxt">Debit Card</td>                        <td align="left"><select name="city" style="width:135px; font-size:11px;"><option>Please Select</option> <option>CC Card</option></select></td></tr>';
				

			}
		}
		
		return true;

	}


function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.CC_offers_mailer.CC_Holder.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}


	
function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.CC_offers_mailer.city.value=="Delhi" || document.CC_offers_mailer.city.value=='Delhi' || document.CC_offers_mailer.city.value=='Noida'  ||  document.CC_offers_mailer.city.value=='Gurgaon'  ||  document.CC_offers_mailer.city.value=='Faridabad'  ||  document.CC_offers_mailer.city.value=='Gaziabad'  ||  document.CC_offers_mailer.city.value=='Faridabad'  ||  document.CC_offers_mailer.city.value=='Greater Noida'  || document.CC_offers_mailer.city.value=='Chennai'  ||  document.CC_offers_mailer.city.value=='Mumbai'  ||  document.CC_offers_mailer.city.value=='Thane'  ||  document.CC_offers_mailer.city.value=='Navi mumbai'  ||  document.CC_offers_mailer.city.value=='Kolkata'  ||  document.CC_offers_mailer.city.value=='Kolkota'  ||  document.CC_offers_mailer.city.value=='Hyderabad'  ||  document.CC_offers_mailer.city.value=='Pune'  || document.CC_offers_mailer.city.value=='Bangalore')
			{
				//alert(document.CC_offers_mailer.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked /> <a href="http://www.deal4loans.com/tata-aig-personal-accident-cover.php" target="_blank" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#472516; font-weight:normal; padding-left:2px;"> Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.CC_offers_mailer.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.CC_offers_mailer.city.value=="Delhi" || document.CC_offers_mailer.city.value=='Delhi' || document.CC_offers_mailer.city.value=='Noida'  ||  document.CC_offers_mailer.city.value=='Gurgaon'  ||  document.CC_offers_mailer.city.value=='Faridabad'  ||  document.CC_offers_mailer.city.value=='Gaziabad'  ||  document.CC_offers_mailer.city.value=='Faridabad'  ||  document.CC_offers_mailer.city.value=='Greater Noida'  || document.CC_offers_mailer.city.value=='Chennai'  ||  document.CC_offers_mailer.city.value=='Mumbai'  ||  document.CC_offers_mailer.city.value=='Thane'  ||  document.CC_offers_mailer.city.value=='Navi mumbai'  ||  document.CC_offers_mailer.city.value=='Kolkata'  ||  document.CC_offers_mailer.city.value=='Kolkota'  ||  document.CC_offers_mailer.city.value=='Hyderabad'  ||  document.CC_offers_mailer.city.value=='Pune'  || document.CC_offers_mailer.city.value=='Bangalore')
			{
				//alert(document.CC_offers_mailer.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked /> <a href="http://www.deal4loans.com/tata-aig-personal-accident-cover.php" target="_blank" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#472516; font-weight:normal; padding-left:2px;"> Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.CC_offers_mailer.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}
</script>
<script language="JavaScript" type="text/javascript" src="scripts/rollovers.js"></script>
	<script language="JavaScript">
	  function showdetailsFaq(d,e)
			{			
				for(j=1;j<=e;j++)
					{
						if(d==j)
							{
								if(eval(document.getElementById("divfaq"+j)).style.display=='none')
									{
									
										eval(document.getElementById("divfaq"+j)).style.display=''
										eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
									}
								else
									{
										
										eval(document.getElementById("divfaq"+j)).style.display='none'
										eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
									}
							}
						else
							{
								
								//eval(document.getElementById("divfaq"+j)).style.display="none"
								//eval(document.getElementById("imgfaq"+j)).src='/images/plus.gif'
							}
					}
			}
							//window.onload=showdetailsFaq
</script>
<script type="text/javascript">
function addBankdetails1()
{
        var ni = document.getElementById('myDiv1');
            if(ni.innerHTML=="")
        {
                  
				   ni.innerHTML = '<table width="230" border="0" align="right" cellspacing="0" cellpadding="0" style="border-top:1px dashed #2a84da; border-bottom:1px dashed #2a84da;"><tr><td class="frmtxt" valign="middle"> <img src="images/plus2.gif" alt="" onClick="showdetailsFaq(1,12)" id="imgfaq1"  height="13" width="12" style="cursor:pointer;"> <span  onclick="showdetailsFaq(1,12)" style="cursor:pointer; font-weight:bold;" >ABN AMRO </span><div style="display: none;" id="divfaq1">';

        }
    return true;
    }


function removeBankdetails1()
{
        var ni = document.getElementById('myDiv1');
       
       
        if(ni.innerHTML!="")
        {
        ni.innerHTML = '';
        }
        return true;

    }
</script>
</head>
<body>

<div id="dvtpbg">
<div id="logo">
	<img src="http://www.deal4loans.com/new-images/d4l-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>	 
	
</div>

<div id="container">
  <div id="lftbar">
  <table width="695"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="695"><img src="new-images/earn-hdng.gif" width="695" height="50" /></td>
      </tr>
      <tr>
        <td background="new-images/earn-bg.gif" style="padding-top:10px; "><table width="99%"  border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td width="663" height="30" valign="middle"> <div style="background-color:#f1faff; color:#000a10;  line-height:20px; padding-left:5px; font-size:12px; width:590px;">Do you know from the stack of cards you hold which one offers maximum cash back for you?</div></td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"> <div style="background-color:#f1faff; color:#000a10; line-height:20px; padding-left:5px; font-size:12px; width:640px; ">Are you using right card to avail maximum discount, cash back to book Airline Ticket, Buying Grocery</div></td>
          </tr>
          <tr>
            <td height="20" align="left" valign="middle">&nbsp;</td>
            <td height="30"> <div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:250px; ">or Clothes from your preferred Brand?</div></td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:505px; ">Do you know your Card also attracts Cash Back which alternate in off season?</div>

</td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:490px; ">Do you know which Credit Card/Debit Card can can earn extra fuel  for you ?</div>
</td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:490px; ">Know where to redeem your points to avail those "Handbags of Goodies" ?</div>

</td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:525px; ">Do you know your debit cards can get you 3-10% discounts at major restaurants.</div>
</td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle"><img src="new-images/earn-arrow.gif" width="18" height="20" /></td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:620px; ">Do you know by using your credit card at normal grocery purchases can add to your travel points </div>
</td>
          </tr>
          <tr>
            <td width="25" height="20" align="left" valign="middle">&nbsp;</td>
            <td height="30"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; padding-left:5px; font-size:12px; width:210px; ">and can get you free air tickets.</div></td>          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="695" height="10" align="left" valign="top"><img src="new-images/earn-bt-bg.gif" width="695" height="10" /></td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">&nbsp;</td>
      </tr>
      <tr>
        <td height="45" align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">To know all these updates and to ensure that your normal spends at credit cards and debit cards can earn you more than 1% minimum and can go upto 10% in some cases,    <font style="font-size:13px; font-weight:bold; color:#70240a;">come sign up with us</font></td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; "><b>How I will get these Offers?</b></td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">These offers will be sent to you on a monthly basis on your mail ID.</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">&nbsp;</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; "><b>Customer Testimonial</b></td>
      </tr>
      <tr>
        <td height="42" align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">Quite interesting to know. For me credit card was only a 45 day free credit period but with these offers I could save Rs.500/- through discounts available on various cards</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" align="left" valign="middle" style="font-size:13px; color:#70240a; line-height:18px; ">          <b>Here are Top offers of Credit Card &amp; Debit Card</b></td>
      </tr>
      <tr>
        <td height="30" align="left" valign="middle"><div style="background-color:#f1faff; color:#2a2200; line-height:20px; font-size:12px; width:610px; font-weight:bold;">Credit Card</div></td>
      </tr>
      <tr>
        <td height="25" align="left" valign="bottom" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold; padding-bottom:2px; ">Citibank Credit Card        </td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">          Use you IndianOil Citibank Titanium Credit card to save up to 5% when you fuel up your vehicle.</td>
      </tr>
      <tr>
        <td height="10"></td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold; ">Barclays Credit Card

</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">Yatra Barclaycard Platinum Card offers 50% discount on weekend stays and 50% discount on buffet lunch(maximum 4 persons at a time) Fortune Hotels. </td>
      </tr>
      <tr>
        <td height="10"></td>      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold; ">HDFC Credit Card</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">Book your traveling through akbartravelsonline.com and get 15% off on Spicejet, 10% on Paramount Airways, 15% off on all domestic hotel bookings and many more.</td>
      </tr>
      <tr>
        <td height="10"></td>      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold;">Kotak Credit Card

</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">Enjoy following offers when you book your travel through Makemytrip.com<br /> 
	a) Flat Rs.5000 cash back on Europe/US packages.<br />
	b) Flat Rs.2000 cash back on South East Asia Packages.<br />
	c) 10% cash back on Fly Free Summer Holiday Packages.
		

		
</td>
      </tr>
      <tr>
        <td height="10"></td>      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold;">SBI Credit Card

</td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; "> Get Get exclusive discount at Fortis network hospital across the country<br />
 
          a) Get up to 50% discount on special health check package.<br />
b) 10% discount on preventive health check package, OPD consultations, pathological investigations & radiological diagnostics.<br />
	c) 10% discount on In-hospital charges like room rent.
     </td>
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
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">Get 15% discount* on booking a ticket through www.goindigo.in. Use the coupon code FLYHDFC3 while booking the ticket .</td>
      </tr>
      <tr>
        <td height="10"></td>      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold;">ICICI Debit Card </td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; " > MakemyTrip offers flat 30% cash back on hotel bookings, use the deal code "ICICIHOTEL" to avail this offer </td>
      </tr>
    <tr> <td height="10"></td>      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#70240a; line-height:18px; font-weight:bold;">SBI Debit Card </td>
      </tr>
      <tr>
        <td align="left" valign="middle" style="font-size:12px; color:#2a2200; line-height:18px; ">  On every spent of Rs.100 at  Fun Cinemas , get 20 FreedomPoints. </td>
      </tr>
      <tr>
        <td height="10"></td>      </tr>
    </table>

<!-- 		<div align="right"><a href="#pg_up" style="color:#1C50B0; text-decoration:none; ">Top<img width="12" height="18" border="0" alt="Top" src="new-images/top.gif"/></a></div> -->



  </div>
  <div style="float:right; "><table width="250" border="0" cellpadding="0" cellspacing="0" id="bgclr">
    <tr>
      <td align="center" valign="middle" id="frmbgtp" >Register here for latest Discounts, Offers & Reward information on Credit Card & Debit Cards</td>
    </tr>
	 
	 <tr>
	 
	 <td valign="top" style="padding-top:10px;">
<form  name="CC_offers_mailer" action="credit-card-archives-continue.php" method="POST" ONsubmit="return ccofferform(document.CC_offers_mailer);"><input type="hidden" name="source"  value="<? echo $_REQUEST['source'];?>">
  <table width="95%" border="0" align="right" cellpadding="0" cellspacing="0"  >
    <tr>
      <td width="83" align="left" valign="middle" class="frmtxt"><b>Name</b></td>
      <td width="145"  align="left" valign="middle"><input type="text" name="name" style="width:133px;" maxlength="30" /></td>
    </tr>
    <tr>
      <td width="83" height="26" align="left" valign="middle" class="frmtxt"><b>Mobile</b></td>
      <td align="left" valign="middle"  class="frmtxt">+91
        <input type="text" name="mobile" style="width:103px;" maxlength="10" /></td>
    </tr>
    <tr>
      <td width="83" height="26" align="left" valign="middle" class="frmtxt"><b>Email Id</b></td>
      <td align="left" valign="middle"><input type="text" name="email" style="width:133px;" maxlength="60" /></td>
    </tr>
    <tr>
      <td width="83" height="26" align="left" valign="middle" class="frmtxt"><b>City</b></td>
      <td align="left" valign="middle"><select name="city" style="width:138px;" onchange="tataaig_comp();">
          <option value="-1" selected="selected">Please Select</option>
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

    <tr>
      <td height="45" colspan="2" align="center" valign="middle" class="frmtxt" style="text-align:center;"><b>Want Offers, Discounts &amp; Reward information On</b></td>
    </tr>
    <tr>
      <td height="25" colspan="2" align="center" valign="middle"  ><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td  ><input type="checkbox" value="1" name="card_type_cc" id="card_type_cc" onclick="getdivdetailsdc();" style="border:none;" /></td>
            <td class="frmtxt"><b>Credit Card</b></td>
            <td ><input type="checkbox" value="2" name="card_type_dc" id="card_type_dc" onclick="getdivdetailsdc();"  style="border:none;"/></td>
            <td class="frmtxt"><b>Debit Card</b></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td colspan="2" class="nrmltxt"><div id="myDiv1" name="myDiv1"></div></td>
    </tr>
    <tr>
      <td colspan="2" class="nrmltxt"><div id="tataaig_compaign" name="tataaig_compaign"></div></td>
    </tr>

    <tr>
      <td height="35" colspan="2" align="center" valign="middle"><input type="submit" value="" class="qcksbscrb"  /></td>
    </tr>
  </table>
</form></td></tr>
	  <tr>
          <td height="13" ><div id="frmbt"></div></td>
      </tr>
  </table></div>
</div>
</body>
</html>

