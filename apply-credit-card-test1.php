<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Credit Cards | Credit Cards Online Application | Credit Cards Comparison Chart India</title>
<meta name="keywords" content="Apply credit card, Apply credit cards online, Credit Cards online Application, Apply Credit Cards, Compare online Credit Cards offers in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Apply Credit Cards online: Get online facility to apply credit cards directly in all banks. Get information about credit cards offers from all credit card provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi, pune etc.">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<Script Language="JavaScript">
function othercity1()
{
	if(document.creditcard_form.City.value=='Others')
	{
		document.creditcard_form.City_Other.disabled=false;
	}
	else
	{
		document.creditcard_form.City_Other.disabled=true;
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
	if(document.creditcard_form.City.value=="Others")
	{
		document.creditcard_form.City_Other.disabled = false;
	}
	else
	{
		document.creditcard_form.City_Other.disabled = true;
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
function retain(strPlan)
{
	if(document.loan_form.Email.value!="")
	{
	   if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }
	}
       return true;
	}
function Decoration(strPlan)
{
       if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}
function Decoration1(strPlan)
{
       if ((document.getElementById('plantype') != undefined)  && (document.getElementById('plantype1') != undefined))
       {
               document.getElementById('plantype').innerHTML = strPlan;
			     document.getElementById('plantype1').innerHTML = strPlan;
       }

       return true;
}
function Decorate(strPlan,i)
{
       if (document.getElementById('plantype2_'+i) != undefined)  
       {
               document.getElementById('plantype2_'+i).innerHTML = strPlan;
			   document.getElementById('plantype2_'+i).style.background='#ddf3f9'; 
			   document.getElementById('plantype2_'+i).style.border=' 1px dashed #99bec9'; 
       }

       return true;
}
function Decorate1(strPlan,i)
{
       if (document.getElementById('plantype2_'+i) != undefined) 
       {
               document.getElementById('plantype2_'+i).innerHTML = strPlan;
			   document.getElementById('plantype2_'+i).style.background='';  
			    document.getElementById('plantype2_'+i).style.border=''; 
			     
               
       }

       return true;
}
	
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
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

function addElementCC()
{
		var ni = document.getElementById('myDivCC');
		 var newdivCC = document.createElement('div');
		
		//if(ni.innerHTML=="")
		//{
		
			
				ni.innerHTML = '<table border="0" width="100%"><tr> <td width="40%" class="formtext">Cards held since?</td><td width="70%" class="formtext" ><select size="1" name="Card_Vintage" id="Card_Vintage" style="width:152px;"><option value="0">Please select</option><option value="1">Less than 6 months</option><option value="2">6 to 9 months</option><option value="3">9 to 12 months</option><option value="4">more than 12 months</option></select></td></tr></table>';
				

			
		//}
		ni.appendChild(newdivCC);
		//return true;

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

/*	 function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.creditcard_form.City.value=="Delhi" || document.creditcard_form.City.value=='Delhi' || document.creditcard_form.City.value=='Noida'  ||  document.creditcard_form.City.value=='Gurgaon'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Gaziabad'  ||  document.creditcard_form.City.value=='Faridabad'  ||  document.creditcard_form.City.value=='Greater Noida'  || document.creditcard_form.City.value=='Chennai'  ||  document.creditcard_form.City.value=='Mumbai'  ||  document.creditcard_form.City.value=='Thane'  ||  document.creditcard_form.City.value=='Navi mumbai'  ||  document.creditcard_form.City.value=='Kolkata'  ||  document.creditcard_form.City.value=='Kolkota'  ||  document.creditcard_form.City.value=='Hyderabad'  ||  document.creditcard_form.City.value=='Pune'  || document.creditcard_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  style="border:none;" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" style="font-weight:normal; text-decoration:underline;" >Get free personal accident insurance from TATA AIG</a>';
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
				ni.innerHTML = '<input type="checkbox" style="border:none;" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" style="font-weight:normal; text-decoration:underline;">Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}*/

function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}

</Script>
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
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="credit-cards.php">Credit Card</a> > Apply Credit Card</span>
  <div id="txt" style="padding-top:15px;">
  
 

  <font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?></strong></font>
  
<form  name="creditcard_form" id="creditcard_form" action="get_cc_eligiblebank.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
<input type="hidden" name="Activate" id="Activate" >
              
              <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
			  
			  <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
	 
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0" >
          <tr>
            <td colspan="5" align="center" ></td>
	    </tr>
          
          <tr>
            <td colspan="5" style="padding:12px;" ><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;"><a name="frm"></a>Apply Credit Card</h1></td>
  </tr>
</table></td>
            </tr>

          <tr>
            <td colspan="5" valign="top" class="frmbldtxt"></td>
            </tr>
           <tr>
             <td  colspan="5" align="left" class="frmbldtxt"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt" style="padding-top:3px; ">Full Name :</td>
                     <td height="28" class="frmbldtxt"  style="padding-top:3px; "><input name="Full_Name" id="Full_Name" type="text" <?
				  if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? } else { ?>value="Full Name"<? } ?>
				   style=" width:150px; " onBlur="onBlurDefault(this,'Full Name');" onFocus="onFocusBlank(this,'Full Name');" onChange="insertData();" tabindex="1"/></td>
                     <td height="28" class="frmbldtxt">Email ID :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="Email" id="Email"  style="width:149px;" onchange="insertData();" tabindex="6" /></td>
                   </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt">DOB :</td>
                     <td height="28" class="frmbldtxt"><input name="day" type="text" id="day"  value="DD" style="  width:35px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="2"/>
                         <input  name="month" type="text" id="month" style="width:35px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="3"/>
                         <input name="year" type="text" id="year" style="width:63px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="4"/></td>
                     <td width="17%" height="28" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                     <td width="31%" height="28" class="frmbldtxt"  style="padding-top:3px; "><select name="City" id="City" style="width:154px;" onchange="cityother(); insertData();" tabindex="7">
                         <?=getCityList($City)?>
                     </select></td>
                   </tr>
                   <tr valign="middle">
                     <td height="28" class="frmbldtxt">Mobile :</td>
                     <td height="28" class="frmbldtxt">+91
                         <input type="text" style="width:120px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);insertData();" onblur="return Decorate1(' ')" onfocus="addtooltip();" tabindex="5"/></td>
                     <td height="28" align="left" class="frmbldtxt">Other City :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="City_Other" disabled  value="Other City" onfocus="this.select();" style="width:148px;" tabindex="8" /></td>
                   </tr>
                   <tr valign="middle">
                     <td width="21%" height="28" class="frmbldtxt">Credit Card Holder?</td>
                     <td width="31%" height="28" class="frmbldtxt"> <input type="radio" name="CC_Holder" class="NoBrdr"  value="1" onClick="addElementCC();" style="border:none;" />Yes &nbsp;&nbsp;
		         <input type="radio" name="CC_Holder" class="NoBrdr" value="0" onClick="removeElementCC();" style="border:none;" />No</td>
                     <td width="17%" height="28" class="frmbldtxt">Pancard</td>
                     <td width="31%" height="28" class="frmbldtxt"><input type="radio" name="Pancard" id="Pancard" class="NoBrdr"  value="Yes" checked  style="border:none;" />Yes &nbsp;&nbsp;
           <input type="radio" name="Pancard" id="Pancard" class="NoBrdr" value="No" style="border:none;" />No</td>
                   </tr>
                   <tr valign="top">
                     <td colspan="2"  class="frmbldtxt" ><div id="myDivCC"></div></td>
                     <td   class="frmbldtxt">&nbsp;</td>
					 <td   class="frmbldtxt">&nbsp;</td>
                   </tr>
                 </table></td>
                 <td width="310" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr valign="middle">
                <td height="28" class="frmbldtxt">Occupation :</td>
                <td height="28" class="frmbldtxt"><select   name="Employment_Status"  id="Employment_Status" style="width:150px;" tabindex="9" >
                    <option value="-1">Employment Status</option>
                    <option value="1">Salaried</option>
                    <option value="0">Self Employment</option>
                </select></td>
              </tr>
               <tr>
                <td height="28" class="frmbldtxt">Company Name </td>
                <td class="frmbldtxt"><input name="Company_Name" value="Company Name" type="text" style="width:154px;" onBlur="onBlurDefault(this,'Company Name');" onFocus="onFocusBlank(this,'Company Name');" tabindex="10" /></td>
              </tr>
			   <tr>
                <td height="28" class="frmbldtxt">Annual Income :</td>
                <td class="frmbldtxt"><input type="text" name="Net_Salary" id="Net_Salary" style="width:154px;" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="11" />
                </td>
              </tr>
              <tr>
                <td   colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt">&nbsp;</td>
              </tr>
            </table></td>
               </tr>
             </table></td>
           </tr>
           <tr>
           <td class="frmbldtxt" colspan="5" align="left"> <div  id="tataaig_compaign" ></div></td>
           </tr>
           <tr>
           <td height="22"  colspan="4" align="left" class="frmbldtxt" style="font-weight:normal; "><input type="checkbox" name="accept" style="border:none;" checked>
              I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and
              agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a>.</td>
			  <td width="25%"><input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
           </tr>


          
          </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table><br />

			  
<!-- <table width="650"  border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
     <td width="650" class="aplfrm"><table width="96%" border="0" align="right" cellpadding="0" cellspacing="0" >
          <tr>
            <td colspan="3" align="center" ></td>
	    </tr>
          
          <tr>
            <td height="30" class="formtext"><input name="Full_Name" id="Full_Name" type="text" <?
				  if(isset($loan_type)) { ?>value="<? echo $name; ?>" <? } else { ?>value="Full Name"<? } ?>
				   style=" width:157px; " onBlur="onBlurDefault(this,'Full Name');" onFocus="onFocusBlank(this,'Full Name');" onChange="insertData();"/></td>
           <td class="formtext"><input name="day" type="text" id="day"  value="dd" style="  width:40px; " onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>             
                <input  name="month" type="text" id="month" style="width:40px; " value="mm" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> 
                <input name="year" type="text" id="year" style="width:63px; " value="yyyy" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="insertData();"/></td>
           <td class="formtext">+91 <input name="Phone" id="Phone" type="text"  maxlength="10" style="width:132px; " onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="insertData();" <? if(isset($loan_type)) { ?>value="<? echo $mobile; ?>" <? } else {?> value="Mobile No" <?}?>  ></td>
          </tr>
          <? if(!isset($_SESSION['UserType'])) {?>
          <tr>
            <td width="36%" height="30" class="formtext"><input name="Email" type="text" id="Email" <? if(isset($loan_type)) { ?>value="<? echo $Email; ?>" <? } else { ?>value="Email Id"<? } ?>  style=" width:157px; " onBlur="onBlurDefault(this,'Email Id');" onFocus="onFocusBlank(this,'Email Id');" onChange="insertData();"/></td>
         <td width="34%" class="formtext"><select   name="Employment_Status"  id="Employment_Status" style="width:163px;" >
                  <option value="-1">Employment Status</option>
                  <option value="1">Salaried</option>
                  <option value="0">Self Employment</option>
                </select></td>
         <td width="30%" class="formtext"><input name="Company_Name" value="Company Name" type="text" style="width:158px;" onBlur="onBlurDefault(this,'Company Name');" onFocus="onFocusBlank(this,'Company Name');" /></td>
          </tr>
          
          <? }?>
          
          
          
          <tr>
            <td height="30" align="left" class="formtext"><select name="City" id="City" style="width:163px;" onChange="othercity1(); tataaig_comp(); insertData();">
                  <?=getCityList($City)?>
                  
                </select></td>
            <td class="formtext"> <input name="City_Other" id="City_Other" value="Other City"  disabled type="text" style="width:159px;" onblur="onBlurDefault(this,'Other City');" onfocus="onFocusBlank(this,'Other City');"/></td>
            <td class="formtext"><input name="Net_Salary" id="Net_Salary" value="Annual Income" type="text" style=" width:157px;" onChange="intOnly(this);"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome'); onBlurDefault(this,'Annual Income');" onFocus="onFocusBlank(this,'Annual Income');"/>                </td>
          </tr>
		 
          <tr><td height="30" valign="top" class="formtext"> Credit card holder?&nbsp;&nbsp;
                    <input type="radio" name="CC_Holder" class="NoBrdr"  value="1" onClick="addElementCC();" style="border:none;" />Yes
		         <input type="radio" name="CC_Holder" class="NoBrdr" value="0" onClick="removeElementCC();" style="border:none;" />No</td>
         <td valign="top" class="formtext"> pancard?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <input type="radio" name="Pancard" id="Pancard" class="NoBrdr"  value="Yes" checked  style="border:none;" />Yes
           <input type="radio" name="Pancard" id="Pancard" class="NoBrdr" value="No" style="border:none;" />No</td>
         <td  ><span id='formatedIncome' style='font-size:10px;color: #333333;;font-Family: Verdana, Arial, Helvetica, sans-serif;'></span><span id='wordIncome' style='font-size:10px;color:#333333;font-Family:Verdana, Arial, Helvetica, sans-serif;text-transform: capitalize;'></span> </td>
          </tr>
           <tr>
            <td class="formtext" colspan="2" align="left"><div id="myDivCC"></div></td><td>&nbsp;</td>
          </tr>
          <tr>
            <td class="formtext" colspan="3" align="left"><div id="tataaig_compaign"></div></td>
          <tr>
            <td colspan="2" style="font-weight:normal; text-align:left;"><input type="checkbox" name="accept" style="border:none;">
              I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and
              agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a>.</td>
			  <td><input value="" type="submit" style=" background-image:url(images/sbmt-butn.gif); border:0px; width:99px; height:29px; margin-bottom:0px;"  /> </td>
      </tr>
          
      
          </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table> -->
	</form>
<div style="clear:both;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top" class="crdbg"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">IndianOil Citibank Titanium Card</td>
          </tr>
          <tr>
            <td height="255" align="center" valign="bottom"><a href="https://www.online.citibank.co.in/products-services/credit-cards/apply-online.htm?category=fuel&amp;site=DEAL4LOANS&amp;creative=BANNER&amp;section=D4LBFBIO&amp;agencyCode=IAPL&amp;campaignCode=CARDSO&amp;productCode=CARDS&amp;eOfferCode=D4LBFBIO" target="_blank"><img src="new-images/IOC_150x244.gif" width="150" height="244" border="0" /></a></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Features</td>
          </tr>
          <tr>
            <td height="325" valign="top" class="crdtext"><ul>
                <li><b>Completely Online Application Process</b></li>
                <li><b>No First year / Renewal fees.</b></li>
                <li>Minimum yearly Income required <br />
                Rs. 3.5 Lacs.</li>
                <li>Save up to 5% every time you fill fuel*</li>
                <li>Earn 4 Turbo Reward Points for Rs 150 of fuel purchased  at IndianOil Outlets</li>
                <li>Earn 1 Turbo Reward Point for Rs. 150 spent on your Card</li>
                <li>Redeem your Turbo Points for free fuel at select IndianOil @ 1:1</li>
            </ul></td>
          </tr>
          <tr>
            <td align="center" valign="bottom"><a href="https://www.online.citibank.co.in/products-services/credit-cards/apply-online.htm?category=fuel&amp;site=DEAL4LOANS&amp;creative=BANNER&amp;section=D4LBFBIO&amp;agencyCode=IAPL&amp;campaignCode=CARDSO&amp;productCode=CARDS&amp;eOfferCode=D4LBFBIO" target="_blank"><img src="new-images/crds-apply.gif" width="141" height="65" border="0" /></a>
                <!--  <div id="plantype2_1" style="position:relative;font-size:11px; width:215px; font-weight:bold; height:30px; color:#FFFFFFF;" ></div> --></td>
          </tr>
      </table></td>
      <td valign="top" class="crdbg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">Citibank Titanium Cash Reward Card</td>
          </tr>
          <tr>
            <td height="255" align="center" valign="bottom"><a href="https://www.online.citibank.co.in/products-services/credit-cards/apply-online.htm?category=shopping&amp;site=DEAL4LOANS&amp;creative=BANNER&amp;section=D4LBFBCR&amp;agencyCode=IAPL&amp;campaignCode=CARDSO&amp;productCode=CARDS&amp;eOfferCode=D4LBFBCR" target="_blank"><img src="new-images/piggycoinR_150x244.gif" width="150" height="244" border="0" /></a></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Features</td>
          </tr>
          <tr>
            <td height="325" valign="top" class="crdtext" style="padding-left:2px;"><ul>
                <li><b>Completely Online Application Process</b></li>
                <li><b>Annual fee of Rs.500.</b></li>
                <li>Minimum yearly Income required<br />
                Rs. 3.5 Lac.</li>
                <li>Interest rate charges 2.5% p.m</li>
                <li>Fabulous offers on Retail shopping, Dining and Lifestyle brands</li>
                <li>On every spend of Rs.200, earn 1 reward point from Monday to Friday</li>
                <li>Earn 5 times Cash Reward Points for all your weekend spends</li>
            </ul></td>
          </tr>
          <tr>
            <td align="center" valign="bottom"><a href="https://www.online.citibank.co.in/products-services/credit-cards/apply-online.htm?category=shopping&amp;site=DEAL4LOANS&amp;creative=BANNER&amp;section=D4LBFBCR&amp;agencyCode=IAPL&amp;campaignCode=CARDSO&amp;productCode=CARDS&amp;eOfferCode=D4LBFBCR" target="_blank"><img src="new-images/crds-apply.gif" border="0" /></a>
                <!-- <div id="plantype2_2" style="position:relative;font-size:11px; width:215px; font-weight:bold; height:30px; color:#FFFFFFF;" ></div> --></td>
          </tr>
      </table></td>
      <td align="center" valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">American Express Card</td>
          </tr>
          <tr>
            <td height="163" align="center" valign="bottom"><a href="https://www152.americanexpress.com/EformsWeb/un/viewLeadGenHandler.do?loc_str=en_IN&sitename=D4loans&adunit=180x150&channel=ROS&campaign=amex_kf_aug10" target="_blank"><img src="new-images/ebay_180x150.jpg" width="180" height="150" /></a></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Features</td>
          </tr>
          <tr>
            <td height="415" valign="top" class="crdtext"><ul>
                <li>Annual Fee of Rs 5000 Only</li>
                <li>Get 2 Or More Kingfisher Tickets free every year<br />
                </li>
                <li>Offers From Kingfisher Airlines<br />
                </li>
                <li>2 upgrade Vouchers<br />
                </li>
                <li>Free Lounge Access at Airports<br />
                </li>
                <li>Air accident insurance of Rs 1 Cr<br />
                </li>
                <li>Online fraud protection Guaranteed<br />
                </li>
                <li>Zero Transaction charges at Hpcl<br />
</li>
            </ul>
            </td>
          </tr>
          <tr>
            <td align="center" valign="bottom"><a href="#pg_up"><img src="new-images/crds-apply.gif" onmouseover="return Decorate('To Apply please Fill your Details in above Form.',3);"  onmouseout="return Decorate1('',3);" border="0"/></a>
                <div id="plantype2_3" style="position:relative;font-size:11px; width:215px; font-weight:bold; height:30px; color:#FFFFFFF;" ></div></td>
          </tr>
      </table></td>
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">Kotak Bank Fortune Gold Card</td>
          </tr>
          <tr>
            <td height="135" align="center" valign="bottom" ><img src="new-images/kotk-fortune.jpg" width="73" height="119" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Features</td>
          </tr>
          <tr>
            <td height="444" valign="top" class="crdtext"><ul>
                <li><b>Apply online application and basic documents required.</b></li>
                <li><b>No interest, no fee in first 3 months.</b></li>
                <li><b>Free for Life time.</b></li>
                <li>Minimum yearly income required Rs.3lac (for Businessmen only).</li>
                <li>Interest rate charges 3.30% p.m.</li>
                <li>Enjoy higher cash limit upto 50% of your credit limit upto 48 days.</li>
                <li>2.5% fuel surcharge wavier across all petrol pumps.</li>
                <li>Flat 1.8 % surcharge waiver on rail bookings made at makemytrip.</li>
                <li>Book your air ticket and hotels through yatra.com and getRs.199 off on all domestic airline tickets, Rs.499 off on all international airlines tickets, Rs.499 off on all domestic hotel bookings.
</li>
            </ul></td>
          </tr>
          <tr>
            <td align="center" valign="bottom"><a href="#pg_up"><img src="new-images/crds-apply.gif" onmouseover="return Decorate('To Apply please Fill your Details in above Form.',4);"  onmouseout="return Decorate1('',4);" border="0"/></a>
                <div id="plantype2_4" style="position:relative;font-size:11px; width:215px; font-weight:bold; height:30px; color:#FFFFFFF;" ></div>
            </td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="20"></td>
      <td height="20"></td>
      <td height="20"></td>
      <td height="20"></td>
    </tr>
    <tr>
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">Kotak Trump Card</td>
          </tr>
          <tr>
            <td height="135" align="center" valign="bottom" ><img src="new-images/kotk-trump.jpg" width="74" height="119" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Features</td>
          </tr>
          <tr>
            <td height="444" valign="top" class="crdtext"><ul>
                <li><b>Apply online and basic documents required.</b></li>
                <li><b>No interest, no fee in first 3 months.</b></li>
                <li><b>Free for Life time.</b></li>
                <li>Minimum yearly Income - Rs.3 Lacs.</li>
                <li>Interest rate charges 3.30% p.m.</li>
                <li> Enjoy 10% Cash back across all restaurants, movies &amp; plays. </li>
                <li>Get 25% off on making charges of Gold jewellery and 3% off on MRP of Diamond jewellery at Tribhovandas Bhimji Zaveri (TBZ)</li>
                <li>Book your air ticket and hotels through yatra.com and getRs.199 off on all domestic airline tickets, Rs.499 off on all international airlines tickets, Rs.499 off on all domestic hotel bookings.
</li>
                <li>Enjoy higher cash limit upto 50% of your credit limit upto 48 days.</li>
                <li>2.5% fuel surcharge wavier across all petrol pumps. </li>
                <li>1.8% railway surcharge wavier on offline and online railway transaction.</li>
            </ul></td>
          </tr>
          <tr>
            <td align="center" valign="bottom"><a href="#pg_up"><img src="new-images/crds-apply.gif" onmouseover="return Decorate('To Apply please Fill your Details in above Form.',6);"  onmouseout="return Decorate1('',6);"  border="0" /></a>
                <div id="plantype2_6" style="position:relative;font-size:11px; width:215px; font-weight:bold; height:30px; color:#FFFFFFF;" ></div></td>
          </tr>
      </table></td>
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">Kotak League Platinum Card</td>
          </tr>
          <tr>
            <td height="135" align="center" valign="bottom" ><img src="new-images/kotk-league.jpg" width="73" height="119" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Features</td>
          </tr>
          <tr>
            <td height="444" valign="top" class="crdtext"><ul>
                <li><b>Apply online and basic documents required.</b></li>
                <li><b>Lost or Stolen Card fraudulent charges cover of Rs. 50,000/-, upto 12 hours pre-reporting.</b></li>
                <li><b>Joining fee Rs. 3,000 / Rs. 8,500 or Rs. 12,000.</b></li>
                <li>Minimum yearly income required Rs.15lac.</li>
                <li>Interest rate charges 3.10% p.m.</li>
                <li>On spend of Rs.100 get 1 reward points and 1 point = 1 rupees.</li>
                <li>10% savings on spends at Taj Restaurants and Bars</li>
                <li>Flat 4 % instant discount on the HCL exclusive price on purchase of any HCL product at www.hclstore.in.</li>
                <li>Enjoy following offers when you book your travel through Makemytrip.com:- Flat Rs.5000 cash back on Europe/US packages, Flat Rs.2000 cash back on South East Asia Packages, 10% cash back on Fly Free Summer Holiday Packages</li>
                <li>2.5% fuel surcharge wavier across all petrol pumps. </li>
             </ul></td>
          </tr>
          <tr>
            <td align="center" valign="bottom"><a href="#pg_up"><img src="new-images/crds-apply.gif" onmouseover="return Decorate('To Apply please Fill your Details in above Form.',7);"  onmouseout="return Decorate1('',7);" border="0"/></a>
                <div id="plantype2_7" style="position:relative;font-size:11px; width:215px; font-weight:bold; height:30px; color:#FFFFFFF;" ></div></td>
          </tr>
      </table></td>
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">Kotak Royale Signature Card</td>
          </tr>
          <tr>
            <td height="135" align="center" valign="bottom" ><img src="new-images/kotk-royal.jpg" width="73" height="118" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Features</td>
          </tr>
          <tr>
            <td height="444" valign="top" class="crdtext"><ul>
                <li><b>Apply online and basic documents required.</b></li>
                <li><b>Lost or Stolen Card fraudulent charges cover of Rs. 50,000/-, upto 12 hours pre-reporting.</b></li>
                <li><b>Joining fee Rs. 25,000.</b></li>
                <li>Minimum yearly income required Rs. 25lac.</li>
                <li>Interest rate charges 3.10% p.m.</li>
                <li>On spend of Rs.100 get 1 reward points and 1 point = 1 rupees.</li>
                <li>25% savings on spends at Taj Restaurants and Bars</li>
                <li>Get 25% off on making charges of Gold jewellery and 3% off on MRP of Diamond jewellery at Tribhovandas Bhimji Zaveri (TBZ)</li>
                <li>Enjoy following offers when you book your travel through Makemytrip.com:- Flat Rs.5000 cash back on Europe/US packages, Flat Rs.2000 cash back on South East Asia Packages, 10% cash back on Fly Free Summer Holiday Packages</li>
                <li>2.5% fuel surcharge wavier across all petrol pumps.</li>
             </ul></td>
          </tr>
          <tr>
            <td align="center" valign="bottom"><a href="#pg_up"><img src="new-images/crds-apply.gif" onmouseover="return Decorate('To Apply please Fill your Details in above Form.',8);"  onmouseout="return Decorate1('',8);" border="0"/></a>
                <div id="plantype2_8" style="position:relative;font-size:11px; width:215px; font-weight:bold; height:30px; color:#FFFFFFF;" ></div>
            </td>
          </tr>
      </table></td>
<td align="center" valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">HDFC Gold Card </td>
          </tr>
          <tr>
            <td height="135" align="center" valign="bottom"><img src="new-images/hdfc-gold-crd.jpg" width="160" height="119" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Features</td>
          </tr>
          <tr>
            <td height="444" valign="top" class="crdtext"><ul><li><b>Free for Life time.</b></li>
                <li><b>Earn 1 reward point per Rs. 150 spent </b></li>
                <li><b>5% cash back on Domestic Flights and Rail Tickets* </b></li>
                <li><b>Redeem points for rewards including air miles.</b></li>
                <li><b>Revolving Credit Facility </b><br />
Pay a minimum Amount, which is 5% (subject to a minimum amount of Rs.200) of your total bill amount or any higher amount whichever is convenient and carry forward the balance to a better financial month. For this facility you pay a nominal charge of just 3.25% per month (39.0% annually).</li>
            <li><b>Free Add-on Card</b><br />
You can share these wonderful features with your loved ones too - we offer the facility of an add-on card for your spouse, children or parents. Allow us to offer add-on cards to you FREE OF COST with our compliments.</li>
            </ul></td>
          </tr>
          <tr>
            <td align="center" valign="bottom"><a href="#pg_up"><img src="new-images/crds-apply.gif" onmouseover="return Decorate('To Apply please Fill your Details in above Form.',9);" onmouseout="return Decorate1('',9);" border="0" /></a>
			 <div id="plantype2_9" style="position:relative;font-size:11px; width:215px; font-weight:bold; height:30px; color:#FFFFFFF;" ></div>
			</td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
 

  </div>
      <?
  //include '~Right2.php';

  ?>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>