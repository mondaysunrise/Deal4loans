<?php
	require 'scripts/session_check.php';
	require 'scripts/functions.php';

	$retrivesource = $_SESSION['source'];
       $page_Name = "CarLoan";
$maxage=date('Y')-62;
$minage=date('Y')-18;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Car Loans | Apply Car Loans online | Compare Car Loans</title>
<meta name="keywords" content="apply car loan, car loans online, apply online car loans, Car Motor loans India, Apply Car Motor Loans, Compare Car Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Car Loans – Compare and Choose Best car loans schemes from all loan provider banks of India.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
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
	if(document. loan_form.City.value=="Others")
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
function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

 
 
	if(document.loan_form.Name.value=="")
	{
		alert("Please fill your first name.");
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
	if(document.loan_form.day.value=="" ||  document.loan_form.day.value=="DD")
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
	  if((document.loan_form.year.value < "<?php echo $maxage;?>") || (document.loan_form.year.value >"<?php echo $minage;?>"))
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
        if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
		{
                alert("The number should start only with 9 or 8 or 7");
				 document.loan_form.Phone.focus();
                return false;
        }

	if(document.loan_form.Email.value=="")
	{
		alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
			
		}
	if(document.loan_form.Email.value!="")
	{
		if (!validmail(document.loan_form.Email.value))
		{
			//alert("Please enter your valid email address!");
			document.loan_form.Email.focus();
			return false;
		}	
	}

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
 	if(!checkData(document.loan_form.Company_Name, 'Company Name', 3))
		return false;
		
	
if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		alert("Please enter Employment Status to Continue");
		document.loan_form.Employment_Status.focus();
		return false;
	}
	
if(document.loan_form.Net_Salary.value=="")
	{
		alert("Please enter Annual income to Continue");
		document.loan_form.Net_Salary.focus();
		return false;
	}
	
	if (document.loan_form.Loan_Tenure.value=="")
	{
		alert("Please enter Loan Tenure.");
		document.loan_form.Loan_Tenure.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Tenure, 'Loan Tenure',0))
		return false;
		
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

function addibibo()
{
	var ni1 = document.getElementById('getibibo');
	var cit = document.loan_form.City.value;
	//alert(cit);	
	if(cit!="Please Select")
	{
		//alert("ranjana");
		ni1.innerHTML = ' <table  style="border:1px solid #999999; padding:2px;"> <tr> <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal; "> <u>Special offer for Deal4loans customers</u></td>		 </tr>	  <tr>	 <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal;"> Take  a Free Test  Drive for New Maruti  and <b>Win a Branded Laptop</b></td> </tr>	 <tr> <td style="font-family:verdana; font-size:10px; color:#666666; font-weight:normal; "> <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" style="border:none;" value="Estillo"/> Estillo <input type="radio" style="border:none;" value="WagonR" name="Ibibo_compaign" id="Ibibo_compaign"/> WagonR <input type="radio" name="Ibibo_compaign" id="Ibibo_compaign" value="A-Star" style="border:none;"/> A-Star</td>	 </tr>	</table>	';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}


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
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;					
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="3";

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

<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="car-loans.php">Car Loan</a> > Apply Car Loan</span>
 
  <div id="lftbar" style="padding-top:15px; width:100%; ">

 <font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?></strong></font>

     <form name="loan_form" method="post" action="/insert-car-loan-values-test.php" onSubmit="return chkform();">
	 <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
	 <input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
	 <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
	 
     <tr>
       <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0" >
          
         <tr>
           <td colspan="5" style="padding:12px;" ><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
               <tr>
                 <td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;">Apply Car Loan</h1></td>
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
                       <td height="28" class="frmbldtxt"  style="padding-top:3px; "><input type="text" name="Name" id="Name" style="width:150px;" maxlength="30"  onchange="insertData();" tabindex="1" /></td>
                       <td width="19%" height="28" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                       <td width="31%" height="28" class="frmbldtxt"  style="padding-top:3px; "><select name="City" id="City" style="width:154px;" onchange="cityother();  insertData();" tabindex="7">
                           <?=getCityList($City)?>
                       </select></td>
                     </tr>
                     <tr valign="middle">
                       <td height="28" class="frmbldtxt">DOB :</td>
                       <td height="28" class="frmbldtxt"><input name="day" type="text" id="day"  value="DD" style="  width:35px; " onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="2"/>
                           <input  name="month" type="text" id="month" style="width:35px; " value="MM" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="3"/>
                           <input name="year" type="text" id="year" style="width:63px; " value="YYYY" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onchange="insertData();" tabindex="4"/></td>
                       <td height="28" align="left" class="frmbldtxt">Other City :</td>
                       <td height="28" class="frmbldtxt"><input type="text" name="City_Other" disabled  value="Other City" onfocus="this.select();" style="width:148px;" tabindex="8" /></td>
                     </tr>
                     <tr valign="middle">
                       <td height="28" class="frmbldtxt">Mobile :</td>
                       <td height="28" class="frmbldtxt">+91
                           <input type="text" style="width:122px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);insertData();" onblur="return Decorate1(' ')" onfocus="addtooltip();" tabindex="5"/></td>
                       <td height="28" class="frmbldtxt">Company Name :</td>
                       <td height="28" class="frmbldtxt"><input type="text" name="Company_Name" style="width:148px;" onfocus="addrest();"    tabindex="9"/>                       </td>
                     </tr>
                     <tr valign="middle">
                       <td width="19%" height="28" class="frmbldtxt">Email ID :</td>
                       <td width="31%" height="28" class="frmbldtxt"><input type="text" name="Email" id="Email"  style="width:149px;" onchange="insertData();" tabindex="6" /></td>
                       <td width="19%" height="28" class="frmbldtxt">Occupation :</td>
                       <td width="31%" height="28" class="frmbldtxt"><select   name="Employment_Status"  id="Employment_Status" style="width:154px;" tabindex="10" >
                           <option value="-1">Employment Status</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                       </select></td>
                     </tr>
                    
                 </table></td>
                 <td width="310" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                     <tr>
                       <td height="28" class="frmbldtxt">Annual Income :</td>
                       <td class="frmbldtxt"><input type="text" name="Net_Salary" id="Net_Salary" style="width:148px;" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="11" />                       </td>
                     </tr>
                     <tr>
                       <td   colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
                     </tr>
                     <tr>
                       <td height="28" class="frmbldtxt">Car Type :</td>
                       <td class="frmbldtxt"><select style="width:154px;" name="Car_Type" tabindex="12">
                          <option selected value="-1">Interested In</option>
				<option  value="1">New Car</option>
				<option value="0">UsedCar</option>
                       </select></td>
                     </tr>
                     <tr>
                       <td height="28" class="frmbldtxt" style="font-weight:normal; "><b>Loan Tenure</b><br />
                  (in years)</td>
                       <td class="frmbldtxt"><input type="text" name="Loan_Tenure" style="width:148px;" value="" tabindex="13" /></td>
                     </tr>
                     <tr>
                       <td height="28" class="frmbldtxt">Loan Amount :</td>
                       <td class="frmbldtxt"><input name="Loan_Amount" id="Loan_Amount" tabindex="14" type="text" style="width:148px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />                       </td>
                     </tr>
                     <tr>
                       <td colspan="2" class="frmbldtxt"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
                     </tr>
                     
                 </table></td>
               </tr>
           </table></td>
         </tr>
        
         <tr>
         <td height="25"  colspan="4" align="left" class="frmbldtxt" style="font-weight:normal; "><input type="checkbox" name="accept" style="border:none;" checked />
     I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a>.</td>
           <td width="25%" rowspan="2">&nbsp;&nbsp;<input type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
         </tr>
		 <tr>
		  <td colspan="4" align="left" style="padding:5px;"> <div id="getibibo"></div></td>
		 </tr>
		 <tr>
		  <td colspan="4" align="left">&nbsp;</td>
		 </tr>
		 
       </table></td>
     </tr>
	 
       </table></td>
     </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>
	 
    </form><br />
 <table width="100%"  border="0" cellpadding="1" cellspacing="1" bgcolor="#d5cfb1">
      <tr bgcolor="#E8F0F6">
        <td width="172"   align="center" bgcolor="#494949" class="tblwt_txt" ><b>Banks/Rates</b></td>
     
        <td width="238"  height="30" align="center" bgcolor="#494949" class="tblwt_txt">ICICI Bank</td>
        <td width="127"  height="30" align="center" bgcolor="#494949" class="tblwt_txt">HDFC Bank </td>
        <td width="119" align="center" bgcolor="#494949" class="tblwt_txt">Kotak
</td>
      <td width="117" align="center" bgcolor="#494949" class="tblwt_txt">Axis Bank</td>
      <td width="168" align="center" bgcolor="#494949" class="tblwt_txt">State Bank of India (SBI)</td>
      </tr>
	  <tr  >
        <td height="35" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b>New Car Loan</b> (Reducing)</td>
        <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b> 11 % – 12.75% <br />
          </b>(From 36 – 60 months)<br />
		   <b>13.25 to 14.25%<br />
          </b>(From 24 – 35 months),<br />
		  <b> 15.25% <br />
          </b>(Upto 23 months)<br />
         
          </td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>11.50% -15.50%</b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>11.50% - 13.50%</b></td>
      <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>11.50% - 14.50%</b></td>
	  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>11.50%</b></td>
	  </tr>
	  <tr  >
        <td height="35" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b> Used Car Loan</b> (Reducing)</td>
        <td height="35" align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>16.00 - 17.50%</b>
</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>17% - 19%</b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>17% - 20%</b></td>
      <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>16.50% - 18%</b></td>
	  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt"><b>16.50%</b> (up to 3 years)<br />
<b> 16.75% </b>(above 3 years)</td>
	  </tr>
	  
	  <tr  >
        <td height="35" align="left" bgcolor="#FFFFFF" class="tbl_txt"><b>Processing Fee</b></td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">Rs.2500/- to  
        Rs.5000/-</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">Rs 2950/- to<br /> 
        Rs. 3950/-</td>
        <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">Rs.3300/- to Rs.4750/- </td>
      <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">Rs.3000/- to<br /> 
        Rs.3500/-</td>
	  <td align="center" valign="middle" bgcolor="#FFFFFF" class="tbl_txt">0.5% of<br /> 
	    Loan Amount</td>
	  </tr>
    </table>
 </div>
 <?php include '~Bottom-new.php';?>
</div>
</body>
</html>