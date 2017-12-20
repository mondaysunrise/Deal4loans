<?php
		require 'scripts/functions.php';

	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Apply Home Loans | Housing Loan</title>
<meta name="description" content="Apply for Home Loan, online information on home loan and housing finance schemes from all home loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi, Pune etc.">
<meta name="keywords" content="Apply Home Loans, Housing Loan, Home loans India, Compare Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script language="JavaScript" type="text/javascript" src="images/rollovers.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<Script Language="JavaScript">
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
	if(document.loan_form.City.value=="Others")
	{
		document.loan_form.City_Other.disabled = false;
	}
	else
	{
		document.loan_form.City_Other.disabled = true;
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
function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.Property_Identified.value="on")
			{
				ni1.innerHTML = '';
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0"><tr><td height="20"  align="left" valign="middle" class="formtext"><span class="form-text"><b>Property Location</b></span></td>	<td colspan="3" align="left" height="20" >&nbsp;&nbsp;&nbsp;<select style="width:140px;" name="Property_Loc" id="Property_Loc"><?=getCityList1($City)?></select></td></tr></table>';
			}
			
		}
			
		return true;
}	
	
function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if((ni.innerHTML!="")|| (ni1.innerHTML==""))
		{
		
			if(document.loan_form.Property_Identified.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				ni1.innerHTML = '<table border="0"><tr><td height="20" colspan="2" align="left" valign="center" class="subheading"><input type="checkbox" name="updateProperty" class="noBrdr" ><span class="form-text">&nbsp;Can we tell you about some properties</font></td></tr></table>';
			}
		}
		
		return true;

}	

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function chkform()
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
//var i;
var cnt;
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
<?	if (($_SESSION['flag']==1) || ($_REQUEST['flag']==1))
	{?>
	if(document.loan_form.Email.value=="")
	{
		alert("Please fill your Email.");
		document.loan_form.Email.focus();
		return false;
	}
	<? } ?>
<?
if($_SESSION['UserType']=="") 
{
?>

	
	 if(document.loan_form.Email.value!="")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}
		
	
	}
	
<?
}
?>
	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{
		alert("Please fill your Full Name.");
		document.loan_form.Name.focus();
		return false;
	}
	if(document.loan_form.Name.value!="")
	{
	 if(containsdigit(document.loan_form.Name.value)==true)
	{
	alert("First Name contains numbers!");
	document.loan_form.Name.focus();
	return false;
	}
	}
  for (var i = 0; i <document.loan_form.Name.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) {
  	alert ("First Name has special characters.\n Please remove them and try again.");
	document.loan_form.Name.focus();
 	return false;
  	}
  }
	
	
	if(document.loan_form.day.value=="" || document.loan_form.day.value=="DD")
	{
		alert("Please fill your day of birth.");
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
	 if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	document.loan_form.day.focus();
	return false;
	}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="" || document.loan_form.month.value=="MM")
	{
		alert("Please fill your month of birth.");
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
	if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	document.loan_form.month.focus();
	return false;
	}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;

	if(document.loan_form.year.value=="" || document.loan_form.year.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		document.loan_form.year.focus();
		return false;
	}
		if(document.loan_form.year.value!="")
	{
	  if((document.loan_form.year.value < "1945") || (document.loan_form.year.value >"1989"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		document.loan_form.year.focus();
		return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;
	if(document.loan_form.Phone.value=="")
	{
		alert("Please fill your mobile number.");
		document.loan_form.Phone.focus();
		return false;
	}
	 if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  document.loan_form.Phone.focus();
			  return false;  
		}
        if (document.loan_form.Phone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.loan_form.Phone.focus();
				return false;
        }
        if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8"))
		{
                alert("The number should start only with 9 or 8");
				 document.loan_form.Phone.focus();
                return false;
        }
	/*if(document.loan_form.Phone.value!="")
	{
		if (!validmobile(document.loan_form.Phone.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Phone.focus();
			return false;
		}
	}
	*/
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		alert("Please select Employment Status to Continue");
		document.loan_form.Employment_Status.focus();
		return false;
	}
	
	/*if(document.loan_form.Residence_Address.value=="")
	{
		alert("Please fill your Residence Address.");
		document.loan_form.Residence_Address.focus();
		return false;
	}*/
	if (document.loan_form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		document.loan_form.City.focus();
		return false;
	}
	if((document.loan_form.City.value=="Others") && (document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value))
	{
		alert("Kindly fill your Other City!");
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
  	alert ("Other city has special characters.\n Please remove them and try again.");
	document.loan_form.City_Other.focus();
  	return false;
  	}
  }
	if (document.loan_form.Pincode.value=="")
	{
		alert("Please enter Pincode.");
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
	{
		alert("Kindly fill in your Pincode(6 Digits)!");
		document.loan_form.Pincode.focus();
		return false;
	}
	}
		
	if (document.loan_form.Net_Salary.value=="")
	{
		alert("Please enter Annual Income.");
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;


for(j=0; j<document.loan_form.Property_Identified.length; j++) 
	{
	//alert(document.loan_form.Property_Identified.length);
        if(document.loan_form.Property_Identified[j].checked)
		{
   	 		cnt= j;
		}
	}
		if(cnt == -1) 
		{
			alert("please select you have identified any property or not");
			return false;
		}
		if(cnt ==0)
		{ 
			if(document.loan_form.Property_Loc.selectedIndex==0)
			{
				alert("Plese select city where property is located");
				document.loan_form.Property_Loc.focus();
				return false;
			}
		}
		
	if (document.loan_form.Loan_Amount.value=="")
	{
		alert("Please enter Loan Amount.");
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;


		if(!document.loan_form.accept.checked)
	{
	alert("Accept the Terms and Condition");
	document.loan_form.accept.focus();
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

function tataaig_comp()
{
	//alert("hello");
	var ni = document.getElementById('tataaig_compaign');
		
		if(ni.innerHTML=="")
		{
			if(document.loan_form.City.value=="Delhi" || document.loan_form.City.value=='Delhi' || document.loan_form.City.value=='Noida'  ||  document.loan_form.City.value=='Gurgaon'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Gaziabad'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Greater Noida'  || document.loan_form.City.value=='Chennai'  ||  document.loan_form.City.value=='Mumbai'  ||  document.loan_form.City.value=='Thane'  ||  document.loan_form.City.value=='Navi mumbai'  ||  document.loan_form.City.value=='Kolkata'  ||  document.loan_form.City.value=='Kolkota'  ||  document.loan_form.City.value=='Hyderabad'  ||  document.loan_form.City.value=='Pune'  || document.loan_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1">&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" class="style4"> Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		else if(ni.innerHTML!="")
		{
			if(document.loan_form.City.value=="Delhi" || document.loan_form.City.value=='Delhi' || document.loan_form.City.value=='Noida'  ||  document.loan_form.City.value=='Gurgaon'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Gaziabad'  ||  document.loan_form.City.value=='Faridabad'  ||  document.loan_form.City.value=='Greater Noida'  || document.loan_form.City.value=='Chennai'  ||  document.loan_form.City.value=='Mumbai'  ||  document.loan_form.City.value=='Thane'  ||  document.loan_form.City.value=='Navi mumbai'  ||  document.loan_form.City.value=='Kolkata'  ||  document.loan_form.City.value=='Kolkota'  ||  document.loan_form.City.value=='Hyderabad'  ||  document.loan_form.City.value=='Pune'  || document.loan_form.City.value=='Bangalore')
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<input type="checkbox"  class="NoBrdr" name="Accidental_Insurance" id="Accidental_Insurance" value="1" checked>&nbsp;<a href="tata-aig-personal-accident-cover.php" target="_blank" class="style4" > Get free personal accident insurance from TATA AIG</a>';
			}
			else 
			{
			//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			}
			
		}
		return true;
}

function addtooltip()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.loan_form.Phone.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
				

			}
		}
		
		return true;

	}


function removetooltip()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
			if(document.loan_form.Phone.value!="")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}



	  function showdetailsFaq(d,e)
			{			
				for(j=1;j<=e;j++)
					{
						if(d==j)
							{
								if(eval(document.getElementById("divfaq"+j)).style.display=='none')
									{
									
										eval(document.getElementById("divfaq"+j)).style.display=''
										//eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
									}
								else
									{
										
										eval(document.getElementById("divfaq"+j)).style.display='none'
										//eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
									}
							}
						
					}
			}
							//window.onload=showdetailsFaq

</script>
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
			var get_full_name = document.getElementById('Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="2";

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

/*function OnloadCalls()
	{
		ajaxFunction();
		
		
	}
	window.onload = OnloadCalls;*/
</script>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="home-loans.php">Home Loan</a> > Apply Home Loan</span>
 
  <div id="txt">	

  <font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?></strong></font>

 <form name="loan_form" method="post" action="apply-home-loans-continue1.php" onSubmit="return chkform();">
 <input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
<table width="458" border="0" cellspacing="0" align="center" cellpadding="0">
  <tr>
          <td valign="middle" style="background-repeat:no-repeat;">&nbsp;</td>
        </tr>
        <tr>
          <td height="74" valign="middle" background="new-images/apl-tp.gif" style="background-repeat:no-repeat;"><h1 >Apply Home Loan</h1></td>
      </tr>
  <tr>
          <td class="aplfrm"><table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
   
	<tr>
       <td height="30" class="frmtxt" ><b>First Name</b></td>
       <td class="frmtxt"><input type="text" name="Name" id="Name" style="width:150px;" maxlength="30"  onChange="insertData();"></td>
     </tr>
   <? if(!isset($_SESSION['UserType'])) {?>
   <tr>
     <td width="46%" height="30" class="frmtxt"><b>Your Email Address</b></td>
     <td width="70%" class="frmtxt">
     <input type="text" name="Email" id="Email"  style="width:150px;" onChange="insertData();"></td>
   </tr>
  
   <? }?>
   
    
     <tr>
       <td height="30" class="frmtxt"><b>DOB</b></td>
       <td class="frmtxt"><input onFocus="insertData();" name="day" type="text" id="day" style="width:40px;" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; value="DD">
         <input name="month" type="text" id="month" style="width:40px;" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; value="MM">
         <input name="year" type="text" id="year" style="width:55px;" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; value="YYYY"></td>
     </tr>
     <tr>
       <td height="30" class="frmtxt"><b>Mobile</b> (For SMS Alerts)</td>
       <td class="frmtxt">+91 <!--<input type="text" name="Zero" size="1" maxlength="1" value="0" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>-->
	   <input type="text" name="Phone" id="Phone" style="width:123px;" maxlength="10"   onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);insertData();" onBlur="return Decorate1(' ')" onFocus="addtooltip();">
       </td>
     </tr>
		   <tr>
		  <td colspan="2"><div id="myDiv" style="color:#671212; font-family:Verdana; font-size:11px;"></div></td>
		  </tr>
     <tr>
     <td height="30" class="frmtxt"><b>Employment Status</b></td>
     <td width="70%" class="frmtxt"><select size="1" name="Employment_Status" style="width:154px;" onChange="insertData();" onfocus="removetooltip();">
		<option value="-1">Please Select</option>
     	<option value="1">Salaried</option>
     	<option value="0">Self Employed</option>
     </select></td>
   </tr>
   
   <tr>
     <td height="30" class="frmtxt"><b>City Name</b></td>
	 <td width="70%" class="frmtxt"><select style="width:154px;" id="City" name="City" onChange="cityother(); insertData(); tataaig_comp();">
     <?=getCityList($City)?>
	 </select></td>
   </tr>
   <tr>
     <td height="30" class="frmtxt"><b>Others</b></td>
     <td width="70%" class="frmtxt"><input type="text" name="City_Other" disabled value="Other City" onFocus="this.select();" style="width:150px;"></td>
   </tr>
    <tr>
     <td height="30" class="frmtxt"><b>Pincode</b></td>
     <td width="70%" class="frmtxt"><input type="text" name="Pincode" onFocus="this.select();" style="width:150px;" maxlength="6" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"></td>
   </tr>
 
			 <tr>
     <td height="30" class="frmtxt"><b>Net Salary</b>(Yearly)</td>
     <td width="70%" class="frmtxt">
       <input type="text" name="Net_Salary" id="Net_Salary" style="width:150px;" onBlur="getDigitToWords('Net_Salary','formatedSalary','wordSalary');" onKeyUp="getDigitToWords('Net_Salary','formatedSalary','wordSalary'); intOnly(this);" onKeyPress="intOnly(this);"></td>
   </tr>
    <tr>
  <td colspan="2" align="left" class="frmtxt"> <span id='formatedSalary' style='font-size:11px; font-weight:bold;color:#671212;font-Family: Verdana, Arial, Helvetica, sans-serif;'></span><span id='wordSalary' style='font-size:11px;
font-weight:bold;color:#671212;font-Family: Verdana, Arial, Helvetica, sans-serif;text-transform: capitalize;'></span></td>
   </tr>
    <tr>
     <td height="30" class="frmtxt"><b>Monthly Obligations</b></td>
     <td width="70%" class="frmtxt">
        <input type="text" name="obligations" id="obligations" style="width:130px;"   onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" > </td>
   </tr>
   <tr>
     <td height="30" class="frmtxt"><b>Property Identified</b></td>
     <td width="70%" class="frmtxt">
       <input type="radio" name="Property_Identified" id="Property_Identified" value="1" onClick="addIdentified();" style="border:none;" /> Yes&nbsp;&nbsp;<input type="radio"  name="Property_Identified" id="Property_Identified" onClick="removeIdentified();" value="0" style="border:none;" /> No</td>
   </tr>
   	<tr><td colspan="2" id="myDiv1"></td></tr>
						<tr><td colspan="2" id="myDiv2"></td></tr>
     <tr>
     <td height="30" class="frmtxt"><b>Property Value</b></td>
     <td width="70%" class="frmtxt">
       <input type="text" name="property_value" id="property_value" style="width:130px;" maxlength="30"   onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" ></td>
   </tr>
 
  

  
   <tr>
     <td height="30" class="frmtxt"><b>Loan Amount Required</b></td>
     <td width="70%" class="frmtxt">
    <input type="text"  id="Loan_Amount" name="Loan_Amount" style="width:150px;" maxlength="30" onBlur="getDigitToWords('Loan_Amount','formatedIncome','wordIncome');" onKeyUp="getDigitToWords('Loan_Amount','formatedIncome','wordIncome'); intOnly(this);" onKeyPress="intOnly(this);"></td>
   </tr>
   <tr>
  <td colspan="2" class="frmtxt" align="left">
   <span id='formatedIncome' style='font-size:11px; font-weight:bold;color:#671212;font-Family: Verdana, Arial, Helvetica, sans-serif;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:#671212;font-Family: Verdana, Arial, Helvetica, sans-serif;text-transform: capitalize;'></span>  </td>
  </tr>

    <tr>
                <td height="30" class="frmtxt"><input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" style="border:none;">&nbsp; Co- Applicant</td>
                <td width="70%" class="frmtxt">&nbsp;</td>
               </tr>
      
		      <tr>
                <td colspan="2"    class="frmtxt"><div style="display: none;" id="divfaq1">
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td width="42%" class="formtext" height="30"><b> Name</b></td>
          <td width="58%" align="left"><span class="formtext">
            <input type="text" name="co_name" id="co_name" style="width:130px;" maxlength="30" value="<?php echo $co_name; ?>" >
            </span></td>
        </tr>
                    <tr>
                      <td class="formtext" height="30"><b> Date of Birth </b></td>
          <td align="left"><input onFocus="insertData();" name="co_day" type="text" id="co_day" style="width:40px;" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; value="DD">
         <input name="co_month" type="text" id="co_month" style="width:40px;" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="MM">
         <input name="co_year" type="text" id="co_year" style="width:55px;" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="YYYY">
		
			</td>
        </tr>
                    <tr>
                      <td class="formtext" height="30"><b> Net Monthly Income </b></td>
          <td align="left"><span class="formtext">
            <input type="text" name="co_monthly_income" id="co_monthly_income" style="width:130px;" value="<?php echo $income; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">
            </span></td>
        </tr>
                    <tr>
                      <td class="formtext" height="30"><b> Obligations</b></td>
          <td align="left"><span class="formtext">
            <input type="text" name="co_obligations" id="co_obligations" style="width:130px;" value="<?php echo $obligations; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">
            </span></td>
        </tr>
		</table>
      
													 
      </div></td>
               </tr>
              

   
   
   
     <tr><td colspan="2" id="tataaig_compaign"></td></tr>
	  <tr>
    <td colspan="2"><input type="checkbox" name="accept" style="border:none;">
    I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and
     agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a>.</td>
  </tr>
   <tr>
     <td colspan="2" align="center" valign="top">
	<!--	 <input name="image"  value="Submit" type="image" src="images/sbmt-btn.gif" width="64" height="30" style="border:0px;" /> -->

	  <input name="submit" type="submit" class="btnclr" value="Submit" ></td>
          </table></td>
      </tr>
        <tr>
          <td width="458" height="26"><img src="new-images/apl-bt.gif" width="458" height="26" /></td>
      </tr>
      </table>
 
  </form>
 </div>
 
<? if(!isset($_SESSION['UserType'])) 
  {
 // include '~Right-new1.php';
  }
  ?>
<?php include '~Bottom-new.php';?>
</div>
</body>
</html>