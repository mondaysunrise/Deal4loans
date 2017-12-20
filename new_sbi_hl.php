<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Housing Loan | Apply For Home Loans | Online Home Loan | Apply Housing Loan</title>
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India, apply Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Housing Loan: Apply for home loans Online and get quotes from all home loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi, Pune etc.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<!--<script type="text/javascript" src="js/jquery.js"></script>
 --><script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true
				
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
	</script>



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
  
	<div id="txt"><h1  >State Bank Of India Home Loan</h1>
   The Most Preferred  Home Loan provider SBI Bank offers a <a href="http://www.deal4loans.com/home-loans.php" title="Home Loan">Home Loan</a> with Attractive Interest Rates with Latest Schemes and Benefits. <a href="http://www.deal4loans.com/loans/banks/sbi-state-bank-of-india-loan/">SBI</a> also  provides a <a href="http://www.deal4loans.com/home-loans.php" title="Housing loan">Housing loan</a> with different schemes. Schemes Are:- <br>
1. SBI Easy Home Loan<br>
2. SBI Advantage Home Loan<br>
3. SBI Housing Finance Scheme<br>
4. SBI Happy Home Loans<br>
5. SBI Life Style Loan<br>
6. SBI Green Home Loan<br>
7. SBI Home Plus<br>
8. SBI Home Line<br>
9. SBI MY HOME CAMPAIGN<br>

 
<div id="lftbar" style="padding-top:5px; width:100%; ">
 	  <font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?></strong></font>
 <form name="loan_form" method="post" action="new_sbi_hl_continue.php" onSubmit="return chkform();">
 <input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="SEO 1">
 
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
<b>Current Rate of Interest</b>
 <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
   <tr>
     <td height="25" align="center" bgcolor="#494949" class="tblwt_txt">Loan Schemes </td>
     <td align="center" bgcolor="#494949" class="tblwt_txt">1st Year </td>
	  <td align="center" bgcolor="#494949" class="tblwt_txt">2nd and 3rd year
</td>
   <td align="center" bgcolor="#494949" class="tblwt_txt">After 3rd Year
</td>
   </tr>
   <tr>
     <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">SBI HI-FIVE Loan <br /> 
       Loan Amount upto Rs. 5 Lacs     </td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">8.00% (p.a.)<br />
       Fixed interest rate
</td>
	 <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">9.00% (p.a.)<br />
	   Floating Interest Rates<br />
	   <b>OR</b><br />
	   10.50% (p.a.)<br />
	   Fixed Interest Rates

</td>
   <td align="center" valign="top"  bgcolor="#FFFFFF" class="tbl_txt">9.00% (p.a.)<br />
     Floating Interest Rates<br />
     <b>OR</b><br />
10.50% (p.a.)<br />
Fixed Interest Rates </td>
   </tr>
   <tr>
     <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">SBI Easy Home Loan <br />
    Loan Amount upto Rs. 50 Lacs </td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">8.00% (p.a.)<br /> 
       Fixed interest rate
</td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">8.50% (p.a.)<br />
       Fixed Interest Rate
</td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">9.00% (p.a.)<br />
     Floating Interest Rate
<br />
<b>OR</b><br />
10.50% (p.a.)<br />
Fixed Interest Rate

</td>
   </tr>
   <tr>
     <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">SBI Advantage Home Loan <br />
    Loan Amount Above Rs. 50 Lacs </td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">8.00% (p.a.)<br /> 
       Fixed interest rate </td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">9.00% (p.a.)<br />
       Fixed Interest Rates </td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">10.00% (p.a.)<br />
     Floating Interest Rate
<br />
     <b>OR</b><br />
11.00% (p.a.)<br />
Fixed Interest Rate
 </td>
   </tr>
</table> 
<font color="#FF0000">Note:- Interest rate after three years may be Fixed or Floating as per the borrower’s choice made at the time of sanction.</font><br />
<br />

       <b>Features & Benefits of <a href="sbi-home-loan.php">SBI Home Loan</a></b> <br>
&bull; Purchase/ Construction of House/ Flat<br>
&bull; Purchase of a plot of land for construction of House<br>
&bull; Lowest <a href="http://www.deal4loans.com/home-loans-interest-rates.php" title="Home Loan Interest Rate">Home Loan Interest Rate</a>..<br>

&bull; Extension/ repair/ renovation/ alteration of an existing House/ Flat<br>
&bull; Purchase of Furnishings and Consumer Durables as a part of the project cost.<br>
&bull; Takeover of an existing loan from other Banks/ <a href="home-loan-banks.php">Housing Finance Companies</a>.<br>
&bull; Interest charged on the daily reducing balance<br>
&bull; No penalty on prepayments of <a href="home-loans.php">home loan</a><br>
&bull; No hidden costs<br>
&bull; Option to club income of your spouse and children to compute eligible loan &nbsp;&nbsp;&nbsp;amount<br>
&bull; Provision to club depreciation, expected rent accruals from property proposed  to compute eligible loan amount<br>
&bull; Provision to finance cost of furnishing and consumer durables as part of  project cost<br />
<br />
</p> 


<b>Eligibility Criteria  &amp; Documentation required for <a href="sbi-home-loan.php">SBI Home Loan</a></b>
 <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
   <tr>
     <td height="25" bgcolor="#494949" class="tblwt_txt">&nbsp;</td>
     <td align="center" bgcolor="#494949" class="tblwt_txt">Salaried</td>
	  <td align="center" bgcolor="#494949" class="tblwt_txt">Self employed</td>
   </tr>
   <tr>
     <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Age</td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">21years to 60years</td>
	 <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">21years    to 70years</td>
   </tr>
   <tr>
   <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Income</td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">Rs.1,20,000    (p.a.)</td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">Rs.2,00,000 (p.a.)</td>
   </tr>
   <tr>
    <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Loan    Amount Offered</td>
	<td align="center"  bgcolor="#FFFFFF" class="tbl_txt">5,00,000    - 1,00,00000</td>
	<td align="center"  bgcolor="#FFFFFF" class="tbl_txt">5,00,000 - 2,00,00000</td>
   </tr>
     <tr>
    <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Tenure</td>
   <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">5years-20years</td>
	<td align="center"  bgcolor="#FFFFFF" class="tbl_txt">5years-20years</td>
   </tr>
   <tr>
     <td height="22" align="center"  bgcolor="#FFFFFF" class="tbl_txt">Current Experience </td>
     <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">2years</td>
	 <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">3years</td>
   </tr>
   
   <tr>
    <td align="center"  bgcolor="#FFFFFF" class="tbl_txt">Documentation</td>
     <td align="left"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:left; ">1) Application form with photograph<br>
2) Identity &amp; residence proof<br>
3) Last 3 months salary slip <br>
4) Form 16<br>
5) Last 6 months bank salaried credit statements<br> 
6) Processing fee cheque</td>
     <td align="left"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:left; "> 1) Application  form with photograph<br>
       2) Identity &amp; residence proof<br>
       3) Education qualifications certificate &amp; proof of business existence<br>
       4) Business  profile,<br>
       5) Last 3 years profit/loss &amp; balance sheet<br>
       6) Last 6 months bank statements<br>
       7) Processing fee cheque</td>
   </tr>
</table></p>
<b>Other Products from SBI (State bank of India)</b>
<br>
1. <a href="http://www.deal4loans.com/sbi-home-loan.php" title="SBI Home Loan">SBI  Home Loan</a><br>
2. <a href="http://www.deal4loans.com/personal-loan-sbi.php" title="SBI Personal Loan">SBI  Personal Loan</a><br>
3. <a href="http://www.deal4loans.com/home-loan-sbi.php" title="SBI Housing Loan">SBI  Housing Loan</a> <br>
4. <a href="http://www.deal4loans.com/loans/banks/sbi-credit-cards/" title="SBI Card">SBI Card</a> <br>
<br>
<b>Information on deposits & Loan Schemes and services also available. Call 1800112211<br /> 
(Tollfree from BSNL/MTNL)</b>
<br />

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
</html>