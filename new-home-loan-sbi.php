<?php
	//require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SBI Home Loans | Eligibility | Documents| Apply</title>
<meta name="keywords" content="SBI Home Loans, SBI Loans, SBI Home Loans Eligibility, SBI Home Loans documents, Apply SBI Home Loan">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>

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
		ni.innerHTML = '<table width="100%" align="left" border="0"><tr><td height="20"  align="left" valign="middle" class="frmbldtxt"><b style="color:#373737;">Property Location</b></td>	<td colspan="3" align="left" height="20" >&nbsp;&nbsp;&nbsp;<select style="width:150px;" name="Property_Loc" id="Property_Loc" tabindex="16"><?=getCityList1($City)?></select></td></tr></table>';
			
		return true;
}	
	
function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '<table border="0"><tr><td height="20" colspan="2" align="left" valign="center" class="subheading"><input type="checkbox" name="updateProperty" style="border:none;" ><span class="form-text">&nbsp;Can we tell you about some properties</font></td></tr></table>';
			
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
	  if (document.loan_form.Phone.value=="" )
		{
                alert("Please Enter Mobile no"); 
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
		alert("Please fill your Email.");
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
	
		
	if (document.loan_form.Net_Salary.value=="")
	{
		alert("Please enter Annual Income.");
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
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
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="home-loans.php">Home Loan</a> > Apply Home Loan</span>
  
	<div id="txt"><h1  >Home Loan from State Bank of India (SBI) Bank</h1>
 <a href="http://www.deal4loans.com/sbi-home-loan.php" title="SBI Home Loans">SBI  Home Loans</a> come to you on the solid foundation of trust and transparency  built in the tradition of State Bank of India. SBI provides a Two <a href="http://www.deal4loans.com/home-loans.php" title="Home Loan">Home Loan</a> With Different benefits and Schemes.
	<ol  >
      <li>SBI Easy Home Loan - For Loan       amount upto Rs. 30 Lacs.</li>
	  <li><a href="http://www.deal4loans.com/loans/banks/sbi-state-bank-of-india-loan/">SBI</a> Advantage       Home Loan &ndash; For Loan amount above Rs.30 Lacs. </li>
	  </ol>
 
<div id="lftbar" style="padding-top:5px; width:100%; ">
 	  <font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?></strong></font>
 <form name="loan_form" method="post" action="home-loan-sbi-continue.php" onSubmit="return chkform();">
 <input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="SEO SBI 2">
 
 <input type="hidden" name="Type_Loan" id="Type_Loan" value="Req_Loan_Home">
              <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
	 
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0" >
         
          <tr>
            <td colspan="5" style="padding:2px;" ><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;">Apply For SBI Home Loan</h1></td>
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
                     <td width="17%" height="28" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                     <td width="31%" height="28" class="frmbldtxt"  style="padding-top:3px; "><select name="City" id="City" style="width:154px;" onchange="cityother(); insertData();" tabindex="7">
                         <?=getCityList($City)?>
                     </select></td>
                   </tr>
                   <tr valign="middle">
                      <td height="28" class="frmbldtxt">Mobile :</td>
                     <td height="28" class="frmbldtxt">+91
                         <input type="text" style="width:122px;" name="Phone" id="Phone" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);insertData();" onblur="return Decorate1(' ')" onfocus="addtooltip();" tabindex="5"/></td>
                     <td height="28" align="left" class="frmbldtxt">Other City :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="City_Other" disabled  value="Other City" onfocus="this.select();" style="width:148px;" tabindex="8" /></td>
                   </tr>
                   <tr valign="middle">
                    <td width="19%" height="28" class="frmbldtxt">Email ID :</td>
                     <td width="33%" height="28" class="frmbldtxt"><input type="text" name="Email" id="Email"  style="width:149px;" onchange="insertData();" tabindex="6" /></td>
                     <td height="28" class="frmbldtxt">&nbsp;</td>
                     <td height="28" class="frmbldtxt">&nbsp;</td>
                   </tr>
                  
                 </table></td>
                 <td width="310" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="28" class="frmbldtxt">Gross Annual Salary :</td>
                <td class="frmbldtxt"><input type="text" name="Net_Salary" id="Net_Salary" style="width:148px;" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="11" />                </td>
              </tr>
              <tr>
                <td   colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span>
<span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Loan Amount :</td>
                <td class="frmbldtxt"><input name="Loan_Amount" id="Loan_Amount" tabindex="12" type="text" style="width:148px;" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" />                </td>
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
    </table>
	</form>
	</div>
  For Checking  interest rates on SBI Home Loan Click <a href="http://www.deal4loans.com/home-loans-interest-rates.php" title="Home Loan Interest Rate">Home Loan Interest Rate</a>.<br>
      <br>
<b>Purpose :</b><br>
&bull; Purchase/ Construction of House/ Flat<br>
&bull; Purchase of a plot of land for construction of House<br>
&bull; Extension/ repair/ renovation/ alteration of an existing House/ Flat<br>
&bull; Purchase of Furnishings and Consumer Durables as a part of the project cost.<br>
&bull; Takeover of an existing loan from other Banks/ <a href="http://www.deal4loans.com/home-loan-banks.php" title="Housing Finance Companies">Housing Finance Companies</a><br>
   	  <br>
      <strong>Features:</strong><br>
  • Interest charged on the daily 
    reducing balance<br>
  • No penalty for prepayments made<br>
  • No hidden costs<br>
  • All the features of our product, including interest rates, are in the 
    public domain.<br>
  • <a href="http://www.deal4loans.com/" title="Loan">Loan</a>  sanctioned within 6 days of submission of required documents. <br>
  • Option to club income of your spouse and children to compute eligible 
    loan amount<br>
  • Provision to club depreciation, expected rent accruals from property proposed 
    to compute eligible loan amount<br>
  • Provision to finance cost of furnishing and consumer durables as part 
    of project cost<br>
  • Repayment permitted upto 70 years of age<br>
  • Free personal accident insurance cover upto Rs.40 Lac.<br>
  • Optional Group Insurance from SBI Life at concessional premium (Upfront 
    premium financed as part of project cost) <br>
  • ‘Plus’ schemes which offer attractive packages with concessional interest 
    rates to Govt. Employees, Teachers, Employees in Public Sector Oil Companies.<br>
  • Special scheme to grant loans to finance Earnest Money Deposits to be 
    paid to Urban Development Authority/ Housing Board, etc. in respect of allotment 
    of sites/ house/ flat</font>	<br>

	<br>
	
      <strong>Eligibility </strong><br>
• Minimum age 18 years as on the date of sanction<br>
• Maximum age limit for a <a href="http://www.deal4loans.com/home-loans.php" title="Home Loan">Home Loan</a> borrower is fixed at 70 years, i.e. 
      the age by which the loan should be fully repaid.
<p>Availability of sufficient, regular 
      and continuous source of income for servicing the loan repayment.</p>
     <strong>Loan Amount</strong>
    <br/>
    • 40 to 60 times of NMI, depending on repayment capacity as % of NMI as 
      under –</p>
     <table width="510" border="1" cellspacing="0" cellpadding="5">
      <tr> 
        <td align="center"><strong>Net Annual Income </strong></td>
        <td align="center"><strong>EMI/NMI Ratio </strong></td>
      </tr>
      <tr> 
        <td> Upto Rs.2 lacs</td>
        <td align="center">40%</td>
      </tr>
      <tr> 
        <td>Above Rs.2 lac to Rs. 5 lac</td>
        <td align="center">50%</td>
      </tr>
      <tr> 
        <td>Above Rs. 5 lacs</td>
        <td align="center">55%</td>
      </tr>
    </table>
   <br/>
    <!--<table width="510" border="1" cellspacing="0" cellpadding="5">
      <tr> 
        <td colspan="4"><div align="center"><strong>Floating interest rates </strong></div></td>
      </tr>
      <tr> 
        <td width="11%">Loan Tenor</td>
        <td width="20%"> Upto 5 years. i.e. 12.75% </td>
        <td width="35%">Above 5 years and upto 15 years i.e. 12.75%</td>
        <td width="34%">Above 15 years and upto 20 years i.e. 2.75%</td>
      </tr>
      <tr> 
        <td> Upto Rs.20 Lacs</td>
        <td>2.75% below SBAR, <br>
          i.e. 10.00% p.a.<br></td>
        <td> 2.50% below SBAR,<br>
          i.e. 10.25% p.a.<br></td>
        <td> 2.25% below SBAR, <br>
          i.e. 10.50% p.a<br></td>
      </tr>
      <tr> 
        <td>Above Rs.20 Lacs</td>
        <td>2.50% below SBAR, i.e.10.25% p.a.</td>
        <td> 2.25% below SBAR, 
          i.e. 10.50% p.a.</td>
        <td>2% below SBAR,
          i.e. 10.75% p.a. </td>
      </tr>
    </table>
<br/>

	<table width="510" border="1" color="black" cellspacing="0" cellpadding="5">
      <tr> 
        <td colspan="2"><div align="center"><strong>Fixed interest rates</strong></div></td>
      </tr>
      <tr> 
        <td>Tenure: upto 10Years<br>
          Upto 10 years<br></td>
        <td>Rate of Interest (p.a.): 12.75%</td>
      </tr>
    </table><br/>
    </p> 
    <p><font face="Arial, Helvetica, sans-serif" size="2" color="#0F74D4"><strong>Processing Fee</strong> 
      </font><br/>
    <font face="Arial, Helvetica, sans-serif">0.25% of Loan amount with a cap 
      of Rs.5,000/-(including Service Tax)</font><br/>
	  -->
	  <strong>Pre-closure Penalty</strong><br>
      No penalty if the loan is precolsed from own savings/windfall gains for 
      which documentary evidence is produced by the customer.<br>
      In case, such proof is not produced by the borrower, penalty @2% on the 
      amount prepaid in excess of normal EMI dues shall be levied if the loan 
      is preclosed within 3 years from the date of commencement of repayment.<br>
      Maximum Repayment Period<br>
• for applicants upto 45 years of age: 20 years<br>
• for applicants over 45 years of age: 15 years <br>
      <br>

      <strong>Documents</strong><br>
• Completed application form<br>
• Passport size photograph<br>
• Proof of Identity – PAN Card/ Voters ID/ Passport/ Driving License<br>
• Proof of Residence – Recent Telephone Bill/ Electricity Bill/ Property 
      tax receipt/ Passport/ Voters ID<br>
• Proof of business address in respect of businessmen/ industrialists<br>
• Sale Deed, Agreement of Sale, Letter of Allotment, Non encumbrance certificate, 
      Land/ Building Tax paid receipt etc. (as applicable and subject to satisfaction 
      report from our empanelled lawyer)<br>
• Copy of approved plan and approval from the Local Body<br>
• Statement of Bank Account/ Pass Book for last 6 months<br>
<br>
Check Other Products of SBI (State Bank of India)
    <ol>
       <li><a href="http://www.deal4loans.com/personal-loan-sbi.php" title="SBI Personal Loan">SBI  Personal Loan</a> </li>
      <li><a href="http://www.deal4loans.com/sbi-home-loan.php" title="SBI Home Loan">SBI Home Loan</a> </li>
      <li><a href="http://www.deal4loans.com/loans/banks/sbi-credit-cards/" title="SBI Credit Card">SBI Credit Card</a></li>
    </ol>
 
<p><b>Registered Office-</b>State Bank of India<br>
State Bank Bhavan Central Office 8th Floor, <br>
Madame Cama Marg, Nariman Point,<br>
Mumbai - 400021<br>
Maharashtra - India<br>
<br/>
<table width="100%" cellpadding="0"cellspacing="0" align="center" border="0" valign="bottom">
	     <tr><td>
	  <a name="rating">
	  <?
include "Rating/rating-code.php";
?>
</a>
</td></tr><tr><td align="right"><a href="rate-your-banks.php"><b>Rate More Banks</b></a></td></tr></table>
<br>
<b>Disclaimer :</b> Please note that the interest rates and  eligibility criteria given here are based on the market research. To enable the  comparisons certain set of data has been reorganized / restructured / tabulated  .Users are advised to recheck the same with the individual companies /  organizations. This site does not take any responsibility for any sudden /  uninformed changes in interest rates.<br />
<br />
<a href="home-loans-interest-rates.php"  class="blue-text" style="text-decoration:underline;"><b>Compare Home Loan Rate of interest</b></a><br/>
      <br>   
  
		<div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" alt="Top" src="new-images/top.gif"/></a></div>

	</div>



  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>
