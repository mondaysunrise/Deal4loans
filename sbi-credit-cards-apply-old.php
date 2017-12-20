<?php
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Credit Cards</title>
<link rel="stylesheet" href="css/creditcards1.css" type="text/css" />
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<Script Language="JavaScript" Type="text/javascript">
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
	if(creditcard_form.City.value=="Others")
	{
		creditcard_form.City_Other.disabled = false;
	}
	else
	{
		creditcard_form.City_Other.disabled = true;
	}
}   

function valButton2() {
		var cnt = -1;
		var i;
		for(i=0; i<document.creditcard_form.Pancard.length; i++) 
		{
			if(document.creditcard_form.Pancard[i].checked)
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

function ckhcreditcard(Form)
{	
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
var myOption;
/* if(document.loan_form.Email.value!="Email Id")
{
	if (!validmail(document.loan_form.Email.value))
	{
		document.loan_form.Email.focus();
		return false;
	}
}*/
if((Form.Full_Name.value=="") || (Form.Full_Name.value=="Full Name")|| (Trim(Form.Full_Name.value))==false)
{
alert("Kindly fill in your Name!");
Form.Full_Name.focus();
return false;
}
else if(containsdigit(Form.Full_Name.value)==true)
{
alert("Name contains numbers!");
Form.Full_Name.focus();
return false;
}
  for (var i = 0; i < Form.Full_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Full_Name.value.charAt(i)) != -1) {
  	alert ("Name has special characters.\n Please remove them and try again.");
	Form.Full_Name.focus();
  	return false;
  	}
  }
if((space.test(Form.day.value)) || (Form.day.value=="dd")  )
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


if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
{
alert("Kindly fill in your Mobile Number!");
Form.Phone.focus();
return false;
}
else if(Form.Phone.value.length < 10)
{
alert("Kindly fill in your Correct Mobile Number!");
Form.Phone.focus();
return false;
}
else if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 Form.Phone.focus();
                return false;
        }
else if(containsalph(Form.Phone.value)==true)
{
alert("Kindly fill in your Correct Mobile Number(Numeric Only)!");
Form.Phone.focus();
return false;
}
 if(Form.Email.value!="Email Id")
{
	if (!validmail(Form.Email.value))
	{
		Form.Email.focus();
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
if((Form.Pincode.value=='Mobile') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
{
alert("Kindly fill in your Pincode!");
Form.Pincode.focus();
return false;
}
else if(Form.Pincode.value.length < 6)
{
alert("Kindly fill in your Correct Pincode!");
Form.Pincode.focus();
return false;
}
if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select employment status ");
	Form.Employment_Status.focus();
	return false;
}
if((Form.Company_Name.value=="") || (Form.Company_Name.value=="Company Name")|| (Trim(Form.Company_Name.value))==false)
{
alert("Kindly fill in your Company Name!");
Form.Company_Name.focus();
return false;
}
else if(Form.Company_Name.value.length < 3)
{
alert("Kindly fill in your Company Name!");
Form.Company_Name.focus();
return false;
}
for (var i = 0; i < Form.Company_Name.value.length; i++) {
  	if (iChars.indexOf(Form.Company_Name.value.charAt(i)) != -1) {
  	alert ("Company Name has special characters.\n Please remove them and try again.");
	Form.Company_Name.focus();
  	return false;
  	}
  }
if((Form.Net_Salary.value=='')||(Form.Net_Salary.value=="Annual Income"))
{
	alert("Please enter Annual income to Continue");
	Form.Net_Salary.focus();
	return false;
}
/*var btn = valButton2();
   if (!btn)
   {
		alert('Please select you have pancard or not.');
				return false;
   }*/
 myOption = -1;
		for (i=Form.CC_Holder.length-1; i > -1; i--) {
			if(Form.CC_Holder[i].checked) {
				if(i==0)
				{
					if(Form.Card_Vintage.selectedIndex==0)
					{
						alert('Card Held since.');
						Form.Card_Vintage.focus();
						return false;
					}

					
				}
					myOption = i;

				
			}
		}
	
		if (myOption == -1) 
		{
			alert("Please select you are credit card holder or not");
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

function othercity1()
{
if(document.creditcard_form.City.value=='Others')
{
document.creditcard_form.City_Other.disabled=false;
}
else
{document.creditcard_form.City_Other.disabled=true;
}
}

function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}
function HandleOnClose(filename) { if ((event.clientY < 0)) {	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}
function addElementCC()
{
		var ni = document.getElementById('myDivCC');
		 var newdivCC = document.createElement('div');
					
				ni.innerHTML = 'Cards held since?                 <select size="1" name="Card_Vintage" id="Card_Vintage" style="margin-left:20px;valign:bottom;"><option value="0">Please select</option><option value="1">Less than 6 months</option><option value="2">6 to 9 months</option><option value="3">9 to 12 months</option><option value="4">more than 12 months</option></select><br />';
				

			
		
		ni.appendChild(newdivCC);
		

	}


function removeElementCC()
{
		var ni = document.getElementById('myDivCC');
		
		if(ni.innerHTML!="")
		{
		
			
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			
		}
		
		return true;

	}
	
/* function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.creditcard_form.City.value=="Delhi" || document.creditcard_form.City.value=='Delhi' || document.creditcard_form.City.value=='Noida'  ||  document.creditcard_form.City.value=='Gurgaon'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Gaziabad'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Greater Noida'  || document.creditcard_form.City.value=='Chennai'  ||  document.creditcard_form.City.value=='Mumbai'  ||  document.creditcard_form.City.value=='Thane'  ||  document.creditcard_form.City.value=='Navi mumbai'  ||  document.creditcard_form.City.value=='Kolkata'  ||  document.creditcard_form.City.value=='Kolkota'  ||  document.creditcard_form.City.value=='Hyderabad'  ||  document.creditcard_form.City.value=='Pune'  || document.creditcard_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" > Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.creditcard_form.City.value=="Delhi" || document.creditcard_form.City.value=='Delhi' || document.creditcard_form.City.value=='Noida'  ||  document.creditcard_form.City.value=='Gurgaon'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Gaziabad'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Greater Noida'  || document.creditcard_form.City.value=='Chennai'  ||  document.creditcard_form.City.value=='Mumbai'  ||  document.creditcard_form.City.value=='Thane'  ||  document.creditcard_form.City.value=='Navi mumbai'  ||  document.creditcard_form.City.value=='Kolkata'  ||  document.creditcard_form.City.value=='Kolkota'  ||  document.creditcard_form.City.value=='Hyderabad'  ||  document.creditcard_form.City.value=='Pune'  || document.creditcard_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" > Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}*/

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

</script>
<Script Language="JavaScript" Type="text/javascript">
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
			var get_full_name = document.getElementById('Full_Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="4";

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
<table width="892" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td width="574" valign="top" style="padding-left:1px;"><table width="65%" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
 <td width="573" height="60" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#8A3712; text-decoration:none; padding-left:10px;"><img src="images/cc/crdt-crd-logo.gif" width="155" height="44" align="absmiddle" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cards by Choice not by Chance !</td>     
     </tr>
     <tr>
       <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td width="255" height="113" align="left" valign="top"><img src="images/cc/crdt-crd-hdr-lft.jpg" width="255" height="113" /></td>
           <td width="318" height="113" align="left" valign="top" background="images/cc/crdt-crd-hdr-rgt.jpg" style="background-repeat:no-repeat; width:318px; height:113px;"><div id="hdng-txt" >3 Easy Steps</div>
		   <div id="sbhdng-txt" >Apply for credit card.<br />
Get & compare  offers.<br />
		   Get the best deal.</div></td>
         </tr>
         <tr>
           <td width="255" height="90" align="left" valign="top"><img src="images/cc/crdt-crd-hdr-lft-bt.jpg" width="255" height="90" /></td>
           <td width="318" height="90" align="left" valign="top"><img src="images/cc/crdt-crd-hdr-rgt-bt.jpg" width="318" height="90" /></td>
         </tr>
		  <tr>
  <td height="75" colspan="2" valign="middle" id="txt"><b>Features of Sbi Credit Card</b><br />
 1) Joining gift of Kingfisher Airline return Ticket Absolutely Free.<br />
2) Access to 600 luxury airport lounges with elite priority pass membership.<br />
3) 5X Cash Points on Dining, Departmental Store and International Spends.<br />
</td>         
         </tr>
         <tr>
  <td height="75" colspan="2" valign="middle" id="txt"><b>www.deal4loans.com</b><br />
The one-stop shop for best on all Credit Card Requirements<br />
      Now get Offers from <strong>ICICI, HDFC Bank, Barclays, Citibank and SBI</strong>
    and Choose the Best Card!</td>         
         </tr>
         <tr>
           <td colspan="2" align="left" valign="top" id="panel">Safety Tips for using a Credit Card.</td>
           </tr>
         <tr>
           <td colspan="2" align="left" valign="top" id="txt-brdr"><font  color="#05394A">&bull;</font> Sign your card as soon as you receive it.<br />
             <font  color="#05394A">&bull;</font> You will also receive the PIN number after a few days. Keep your
             PIN/account number safe.<br />
             <font  color="#05394A">&bull;</font> Every time you use your card, be aware when your card is being swiped
             by the cashier so as to ensure no misuse of your card takes place.<br />
             <font  color="#05394A">&bull;</font> When making payment with your card, make sure you check if it is your credit card that the cashier has returned.<br />
             <font  color="#05394A">&bull;</font> Do not forget to verify your purchases with your billing statements.<br />
             <font  color="#05394A">&bull;</font> After using your card at an ATM, do not throw your receipt behind.<br />
 
             <div id="panel-bot"><a href="http://www.deal4loans.com/Contents_Credit_Card_Mustread.php" style="color:#FFFFFF" target="_blank">More</a>...</div></td>
         </tr>
		<tr>
        <td colspan="2" valign="middle" id="txt"><b>Testimonial</b><br />
          The security tips and the regular updates about
          credit card offers, has helped me drive more
          mileage out of the plastics in my wallet.
          <div style="float:right; margin:0px;"><b>Swati</b></div></td>
      </tr>
 
         
       </table></td>
     </tr>
   </table></td>
    <td width="328" valign="top" style=" padding-left:5px; padding-top:20px;"><table width="327" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td  ><div id="form-top-lft">&nbsp;</div>
            <div id="form-top-bg"><img src="images/cc/spacer.gif" height="29" width="1" />Apply Sbi Credit Card</div>
          <div id="form-top-rgt">&nbsp;</div></td>
      </tr>
      <tr>
        <td id="form-brdr"><div id="fom-txt">
           <!--<form  name="creditcard_form" id="creditcard_form" action="credit-cards-apply-continue.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >-->
		   <form  name="creditcard_form" id="creditcard_form" action="get_cc_eligiblebank.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
			<input type="hidden" name="Type_Loan" value="Req_Credit_Card">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="source" value="sbi credit card"> 
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div align="center"><font face="Verdana, Arial, Helvetica, sans-serif;" color="#FF0000"><strong><?php if(isset($_GET['msg'])) echo "Kindly give Valid Details"; ?></strong></font></div>
	
              <div style="padding:12px 0px 20px 20px; text-align:left; ">Full Name
                  <input name="Full_Name" id="Full_Name" type="text" value="Full Name" style="margin-left:60px; width:148px; padding-left:5px;" onBlur="onBlurDefault(this,'Full Name');" onFocus="onFocusBlank(this,'Full Name');" onChange="insertData();"/>
                 
                  <br />
                Date of Birth
                <input name="day" type="text" id="day"  value="dd" style="margin-left:43px; width:32px; padding-left:5px;" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);"/>&nbsp;&nbsp;
                <input  name="month" type="text" id="month" style="width:29px; padding-left:5px;" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);"/>&nbsp;&nbsp;
                <input name="year" type="text" id="year" style="width:49px; padding-left:5px;" value="yyyy" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onChange="insertData();"/>
                <br />
                Mobile &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;+91
                <input name="Phone" id="Phone" type="text" value="Mobile No." maxlength="10" style="width:119px; margin-left:10px; padding-left:5px;" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onChange="insertData();" onFocus="return Decorate('Please give correct Mobile number, to activate your card request.')"  onBlur="return Decorate1(' ')"><div id="plantype2" style="position:absolute;font-size:10px;width:105px;text-align:center;font-family:verdana; float:right;"></div>
                <br />
                Email Id
                <input name="Email" type="text" id="Email" value="Email Id" style="margin-left:72px; width:147px; padding-left:5px;" onBlur="onBlurDefault(this,'Email Id');" onFocus="onFocusBlank(this,'Email Id');" onChange="insertData();"/>
                <br />
                City
                <select name="City" id="City" style="margin-left:102px; width:153px;" onchange="othercity1(this); insertData();">
                  <?=getCityList($City)?>
                  
                </select>
                <br />
                Other City
                <input name="City_Other" id="City_Other" value="Other City"  disabled type="text" style="margin-left:63px; width:151px;" onBlur="onBlurDefault(this,'Other City');" onFocus="onFocusBlank(this,'Other City');"/>
                <br />
				Pincode
                <input name="Pincode" id="Pincode" type="text" style="margin-left:77px; width:151px;" onBlur="onBlurDefault(this,'Pincode');" onFocus="onFocusBlank(this,'Pincode');"/>
                <br />
                Employment Status
                <select   name="Employment_Status"  id="Employment_Status" style="width:153px; margin-left:2px;" >
                  <option value="-1">Employment Status</option>
                  <option value="1">Salaried</option>
                  <option value="0">Self Employment</option>
                </select>
             <br />
                Company Name
                <input name="Company_Name" value="Company Name" type="text" style="margin-left:27px; width:148px;padding-left:5px;" onBlur="onBlurDefault(this,'Company Name');" onFocus="onFocusBlank(this,'Company Name');" /> 
                <br />
                Annual Income
                <input name="Net_Salary" id="Net_Salary" value="Annual Income" type="text" style="margin-left:30px;padding-left:5px; width:148px;" onchange="intOnly(this);"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome'); onBlurDefault(this,'Annual Income');" onFocus="onFocusBlank(this,'Annual Income');"/>                
                <br />
				<span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span>
                                                 <br/>
               <!-- Do you have a Pancard?<br />
                <input type="radio"   name="Pancard" value="Yes" checked="checked" style="margin-left:151px; border:none;" />
                Yes
                <input type="radio"   name="Pancard" value="No" style=" border:none;" />
                No<br />-->
                Are you a Credit card holder?<br />
                <input type="radio"   name="CC_Holder" value="1" style="margin-left:151px; border:none;" onClick="addElementCC();" />
                Yes
                <input type="radio" value="0"  name="CC_Holder" style="border:none;"  onClick="removeElementCC();"/>
                No<br />
                <div id="myDivCC"></div>
<!-- Any type of loan(s) running?<br /> 
                <input type="checkbox" id="Loan_Any" name="Loan_Any[]" style="margin-left:151px; border:none;"  value="hl">Home<input type="checkbox" id="Loan_Any" name="Loan_Any[]" value="pl" style=" border:none;" >Personal<br /><input type="checkbox" id="Loan_Any" name="Loan_Any[]" style="margin-left:151px; border:none;"  value="cl" >Car<input type="checkbox" name="Loan_Any[]" id="Loan_Any"  value="lap" style="margin-left:15px; border:none;">Property<input type="checkbox" name="Loan_Any[]" id="Loan_Any" style="margin-left:151px; border:none;" value="other">Other<br />-->
				<!--<input type="radio"   name="Loan_Any" value="1" style="margin-left:151px; border:none;" />
                Yes
                <input type="radio" value="0"  name="Loan_Any" style="border:none;"  />
                No<br />

				<div id="tataaig_compaign"></div> -->
				<input  name="accept" id="accept" type="checkbox" checked="checked" style="border:none; margin-top:10px; "/>
                <span style="font-weight:normal; color:#000000; font-size:9px;">I have read the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and agree to the <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms And Condition</a>.</span><br />
                <br />
                <div align="center">
                  <input type="image" name="Submit" src="images/cc/crdt-submit.gif"  style="width:125px; height:31px; border:none; padding-right:30px;" />
                </div>
              </div>
            </form>
        </div></td>
      </tr>
      <tr>
        <td valign="top"><div id="form-l-cor"></div>
            <div id="form-mid-b"></div>
          <div id="form-r-cor"></div></td>
      </tr>
         </table></td>
  </tr>

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
