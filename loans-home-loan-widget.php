<?php 
require 'scripts/functions.php';
?><link href="/css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
<script src='/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>

<!-- CSS for top to jump starts -->
<!-- CSS for top to jump ends -->
<script type="text/javascript">
jQuery.noConflict(); </script>
<script language="javascript">
function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }
function cityother() {	if(document.loan_form.City.value=="Others")	{		document.loan_form.City_Other.disabled = false;	}	else	{		document.loan_form.City_Other.disabled = true;	}} 
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param) {	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false;}
function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var cnt=-1;
	var i;

	if (document.loan_form.Loan_Amount.value=="")
	{ document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>"; document.loan_form.Loan_Amount.focus();		return false;	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}	
		
	if (document.loan_form.Net_Salary.value=="")	{		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";			document.loan_form.Net_Salary.focus();		return false;	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;

	if (document.loan_form.City.selectedIndex==0)
	{		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";			document.loan_form.City.focus();		return false;	}
	
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}

	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";				document.loan_form.Name.focus();		return false;	}

	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";			document.loan_form.Name.focus();			return false;		}
	}
   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";			document.loan_form.Name.focus();			return false;		}
  }
	if(document.loan_form.Email.value=="")
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter Valid Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	else if(bb==-1)
	{		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter Valid Email Address!</span>";			document.loan_form.Email.focus();		return false;	}
	
	if(document.loan_form.Phone.value=="")
	{		document.getElementById('phoneVal').innerHTML = "<span class='hintanchor'>Fill Mobile Number!</span>";		document.loan_form.Phone.focus();		return false;	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{		document.getElementById('phoneVal').innerHTML = "<span class='hintanchor'>Enter numeric value!</span>";		document.loan_form.Phone.focus();		return false;  	}
	if (document.loan_form.Phone.value.length < 10 )
	{	  	document.getElementById('phoneVal').innerHTML = "<span class='hintanchor'>Enter 10 Digits!</span>";			document.loan_form.Phone.focus();		return false;	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{	  	document.getElementById('phoneVal').innerHTML = "<span class='hintanchor'>should start with 9 or 8 or 7!</span>";			document.loan_form.Phone.focus();		return false;	}

if(document.loan_form.Age.value=="")
	{
		document.getElementById('AgeVal').innerHTML = "<span class='hintanchor'>Fill Day of Birth!</span>";
		document.loan_form.Age.focus();
		return false;
	}
		
	if (document.loan_form.property_value.value=="")
	{ document.getElementById('propertyValueVal').innerHTML = "<span  class='hintanchor'>Enter Property Value!</span>"; document.loan_form.property_value.focus();		return false;	}

	for(i=0; i<document.loan_form.Property_Identified.length; i++) 
	{
        if(document.loan_form.Property_Identified[i].checked)
		{
   	 		cnt= i;
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
				Form.Property_Loc.focus();
				return false;
			}
		}

	if(!document.loan_form.accept.checked)
	
	{		alert("Read and Accept Terms & Conditions!");				document.loan_form.accept.focus();		return false;	}	
}  

function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
	{
		if(d==j)
		{
			if(eval(document.getElementById("divfaq"+j)).style.display=='none')
			{				eval(document.getElementById("divfaq"+j)).style.display=''			}
			else			{				eval(document.getElementById("divfaq"+j)).style.display='none'			}
		}
			
	}
}

function validateDiv(div) {	var ni1 = document.getElementById(div); 	ni1.innerHTML = ''; }
function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
var txtview = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style=" font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
hdfclifecamp(ni1,cit,txtview);
}
function addIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	 ni1.innerHTML = '<div class="new-input-box"><div>Property Location</div>    <div><select name="Property_loc" id="Property_loc" class="d4l-select"><?=getCityList1($City)?></select></div><div id="vintageVal"></div></div>';		
		return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';				
		return true;
}	

function othercity1()
{
	var citydiv2 = document.getElementById('otherCityName');
	if(document.loan_form.City.value=='Others')	
	{
//	alert(document.personalloan_form.City.value);
		citydiv2.innerHTML = '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td height="25"><span>Other City:</span></td></tr><tr><td height="25"><input name="City_Other" id="City_Other" type="text" class="d4l-input" onKeyUp="searchSuggest();" onkeydown="validateDiv(\'othercityVal\');"  /><div id="othercityVal"></div></td></tr></table>';	
	}
	else
	{
		citydiv2.innerHTML = '';
	}
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addPadding');
	var ni3 = document.getElementById('addSubmit');
	var ni5 = document.getElementById('getImageScroll');
	
	ni1.innerHTML = '<div class="p-details"><div><strong>Personal Details</strong></div><div class="termtext"><img src="images/security.png" width="14" height="16">Your Information is secure with us and will not be shared without your consent</div></div> <div style="clear:both;"></div><div class="new-input-box"> <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25">Full Name:</td>    </tr>    <tr>      <td height="25">   <input name="Name" id="Name" type="text"  class="d4l-input" onkeydown="validateDiv(\'nameVal\');" autocomplete="off" />   <div id="nameVal"></div>  </td>    </tr>    </table></div><div class="new-input-box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25">Email ID :</td>    </tr>    <tr>      <td height="25">  <input name="Email" id="Email" type="text" class="d4l-input" onkeydown="validateDiv(\'emailVal\');" autocomplete="off" />          <div id="emailVal"></div>   </td>    </tr>      </table></div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25">Mobile:</td>    </tr>        <tr>      <td height="25"><table width="100%" border="0" cellspacing="0" cellpadding="0">  <tr>    <td width="3%">+91</td>    <td width="97%"> <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="d4lmob" onkeydown="validateDiv(\'phoneVal\');" autocomplete="off" />            <div id="phoneVal"></div></td>  </tr></table>   </td>    </tr>  </table></div><div class="new-input-box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25">Age:</td></tr><tr><td height="25"><select onchange="validateDiv(\'AgeVal\');" class="d4l-select" name="Age" id="Age"><option value="">Select Age</option><?php for($a=18;$a<=65;$a++) {?><option value="<?php echo $a;?>"><?php echo $a;?></option><?php }?></select><div id="AgeVal"></div></td>    </tr>    </table></div><div style="clear:both;"></div><div class="new-input-box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25">Property Value:</td>    </tr>    <tr>      <td height="25"><input  name="property_value"  id="property_value" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" class="d4l-input" onkeydown="validateDiv(\'propertyValueVal\');"  tabindex="6" autocomplete="off" /><div id="propertyValueVal"></div></td>    </tr>      </table></div><div class="new-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25">Monthly EMI for all running loans :</td>    </tr>        <tr>      <td height="25"><input  name="obligations" id="obligations" onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" class="d4l-input" tabindex="7" autocomplete="off" /></td>    </tr>  </table></div><div class="new-input-box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25">Property Identified:</td></tr><tr><td height="25"><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="return addIdentified();" style="border:none;" /> Yes   <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;"  /> No <div id="propEditifiedVal"></div></td>    </tr>    </table></div><div style="clear:both;"></div><div class="pl_input_box" id="myDiv1"></div><div style="clear:both;"></div>';

	ni3.innerHTML = '<div class="new_terms_box"><div class="">  <input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" >      <span>Co - applicants</span></div><span class="termtext">  <input name="accept" type="checkbox" id="accept" /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#3671d5; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  style=" color:#3671d5; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#3671d5; text-decoration:underline;">Terms and Conditions</a>.                 <div id="acceptVal"></div></span></div>     <div style="clear:both;"></div> <div class="loan-quotewrap"><div class="loan-quote"><strong style="background:#e29500; color:#FFF; font-size:25px; font-weight:normal;">54</strong>  ,<strong style="background:#043eac;  color:#FFF; font-size:25px; font-weight:normal;">02 </strong>,  <strong style="background:#44cbbe;  color:#FFF; font-size:25px; font-weight:normal;">013</strong> Loan quotes taken till now</div><div class="Hl-Quote-Btn"><input type="submit" class="hl-get-quotebtn" value="Get Quote" onClick="ga(\'send\', \'event\', \'Get Quote\', \'Get Quote Home\');"/></div></div>                    <div style="clear:both;"></div>                   <div id="hdfclife"></div>                    <div style="clear:both;"></div>';
	ni5.innerHTML = '<img src="images/animated_hl.gif" width="100%" height="21" />';
}	
</script>
<script type="text/javascript">
function processtogetHl()
{
	var nitxt1 = document.getElementById('sectnwise_TXTDiv');
	nitxt1.innerHTML ='<div class="form-head-text-white">Get Eligibility Quote from 5 PSU and 7 Private Banks </div>';
	var ni1 = document.getElementById('Hl_mainDiv');
	ni1.innerHTML ='<div style="width:100%;" id="HL_processDIV">    <div class="body-text-new-h2"><a name="Process-get-Home-Loan"><strong>Home Loan –</strong> Lets us Explain how this will go about and what are the Steps</a></div>      <p><span class="body-text-new-hl" style="color:#4c4c4c; ">The first step involved in the process is to find your property which is followed by the verification of property documents, post that the documents are examined &amp; simultaneously you can start searching for the lender who can offer the BEST Home Loan Deal after checking your eligibility criteria.<br />        <br />        <strong>Know the Home Loan Eligibility:</strong> Banks offer the loan amount based on your Income and the property value .They will give you max amount  in which your emi of Home loan and others loans  is  50-60% of your income.<br />        Other factor is that value of property.<br />        <br />        <strong>Select the Best Home Loan after evaluation:</strong> Comparing home loan interest rates is the primary feature in the home loan selection, however other fees &amp; charges like Application fees, processing fees, legal charges should not be neglected when comparing various loan offers. To check the interest rates &amp; other charges incurred by various banks, Deal4Loans has brought in a Home Loan Comparison Chart across various Banks.Banks offer Fixed and Floating rates in Home loans.<br />        <br />        <strong>Most customers choose Floating rates</strong><br />      </span></p>      <p><span class="body-text-new-hl" style="color:#4c4c4c; "><strong>Applying for the Loan :</strong> After you have selected your lender, you have to fill in the application form wherein the lender requires complete information about your financial assets &amp; liabilities; other personal &amp; professional details together with the property details &amp; its costs.<br />        <strong><br />        Documentation &amp; Verification Process: </strong>You are required to submit the necessary documents to the bank which will be verified together with the details in the application.<br />        <br />        <strong>Credit &amp; default check:</strong> Bank checks out the borrower&rsquo;s loan eligibility (through repayment capacity) &amp; the amount of loan is confirmed. The borrower&rsquo;s repayment capacity is reached which is based on the income, salary, age, experience &amp; nature of business etc. Bank also checks credit history through the Cibil Score which plays a critical role in deciding &amp; approving your loan application. Low Credit Score implies that the bank upfront rejects your application on the basis of earlier credit defaults; on the other hand high credit score gives a green signal to your application.<br /> <strong><br />        Bank sanctions Loan &amp; Offer letter to the borrower:</strong> After the credit appraisal of the borrower bank decides the final amount &amp; sanctions the loan, the bank further sends an offer letter to the borrower which constitutes the details like rate of interest, loan tenure &amp; repayment options etc.<br />        <br />        <strong>Acceptance Copy to the Bank: </strong>The borrower needs to send an acceptance copy to the bank after the borrower agrees with the terms &amp; conditions in the offer letter.<br />      </span></p>      <p><span class="body-text-new-hl" style="color:#4c4c4c; "><strong>Bank checks the legal documents:</strong> The bank further asks the legal documents of property from the borrower to check its authenticity so as to keep them as a security for the loan amount given. The next step involved is the valuation of the property by the bank which determines the loan amount sanctioned by the bank. <br />        <br /><strong>Signing of agreement &amp; the loan disbursal: </strong>The borrower signs the loan agreement &amp; the bank disburses the loan amount.<br /><br />        <div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;">Documents required in Home Loan</h3></div><div class="body-text-new-hl" style="color:#4c4c4c; ">Generally the documents required to processing your loan application are almost similar across all the banks; however they may differ with various banks depending upon specific requirement etc. Following documents are required by financial institutions to process the loan application:<ul style="margin-left:35px; margin-top:10px;"><li>Income</li><li>Age Proof</li><li>Address Proof</li><li>Income Proof of the applicant & co-applicant</li><li>Last 6 months bank A/C statement</li><li>Passport size photograph of the applicant & co-applicant</li></ul><div style="clear:both;"></div><div class="hl-newform-wrapper-new" style="margin-top:15px;">  <table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#bfbfbf">  <tr>    <td scope="row"><table border="0" cellspacing="1" cellpadding="5" width="100%">  <tr>    <td width="484" height="40"  align="center" bgcolor="#FFFFFF" ><strong>In case of Salaried</strong></td>    <td width="453" height="40" align="center" bgcolor="#FFFFFF"><strong>In case of Self-employed</strong></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Employment certificate from the employer, </span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Copy of audited financial statements for the last 2 years </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Copies of pay slips for last few months and TDS certificate </span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Copy of partnership deed if it is a partnership firm or copy of memorandum of association and articles of association if it is a company </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td rowspan="2" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Latest Form 16 issued by employer Bank statements</span><span class="th-new2-text"></span></td>    <td height="40" align="left" bgcolor="#FFFFFF" ><span class="th-new2-text">Profit and loss account for the last few years </span><span class="th-new2-text"></span></td>    </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" >Income tax assessment order</td>  </tr>    </table></td>  </tr></table></div></div>      </div><br>';
}

function bestIrHl()
{
	var d = new Date();
var n = d.getDate(); 
var m= d.getMonth();
var y= d.getFullYear();
var month;
if(m==0) {month="January ";} else if(m==1) {month="February";} else if(m==2) {month="March";} else if(m==3) {month="April";} else if(m==4) {month="May";} else if(m==5) {month="June";} else if(m==6) {month="July";} else if(m==7) {month="August";} else if(m==8) {month="September";} else if(m==9) {month="October";} else if(m==10) {month="November";} else if(m==11) {month="December";}
var dt= n + " " + month+ " " + y;

	var nitxt2 = document.getElementById('sectnwise_TXTDiv');
	nitxt2.innerHTML ='<div class="form-head-text-white">Get Interest Rates of 10 Banks - Apply Online with Lowest</div>';
	var ni2 = document.getElementById('Hl_mainDiv');
	    ni2.innerHTML ='<div id="Hl_InterRateDIV"><div class="body-text-new-h2"><a name="Best-Bank" id="Best-Bank"><strong>Interest Rates of Banks</strong></a></div>(Last updated on ' + dt + ')<div style="clear:both;"></div>   <div class="hl-newform-wrapper-new">  <table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#bfbfbf">  <tr>    <td scope="row"><table border="0" cellspacing="1" cellpadding="5" width="100%">  <tr>    <td width="166" height="40"  align="center" bgcolor="#FFFFFF"><strong>Banks</strong></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF"><strong>Loan    to Property Value</strong></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF"><strong>Interest Rates</strong></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF"><strong>Apply</strong></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">State Bank of India (SBI)</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% -90%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">9.85% - 9.90%</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/sbi-home-loan.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'SBI Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">HDFC Ltd</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% -80%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">9.90% - 10.40%</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/hdfc-ltd-home-loan.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'HDFC Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">LIC Housing Finance</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% -80%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">10.15% (Fixed for 2 Years)</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/lic-housing-home-loan.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'LIC Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Axis Bank Home Loan</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">75% - 85%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">10.15% - 11.75%</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/home-loan-axis-bank.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'Axis Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">ICICI Bank Home Loan</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">Upto 85%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" >9.85% - 9.90%</td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="http://www.deal4loans.com/icici-hfc-home-loan.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'ICICI Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td width="166" height="40" align="left" bgcolor="#FFFFFF"><span class="th-new2-text">Fedbank Home Loan</span></td>    <td width="186" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">Upto 85%</span></td>    <td width="142" height="40" align="center" bgcolor="#FFFFFF" ><span class="th-new2-text">10.35% - 10.70%</span></td>    <td width="159" height="40" align="center" bgcolor="#FFFFFF" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'Fedbank Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">PNB Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 11.00%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'PNB Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">PNB Housing Finance</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.15% - 11.75%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'PNBHF Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">IDBI Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 11.00%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'IDBI Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">ING Vysya Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.75% - 11.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank" onClick="ga(\'send\', \'event\', \'Apply Button\', \'Misc. Apply Button\');"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">DHFL Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >80% - 85%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >9.90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Indiabulls Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.15% (Upto 25Lacs), then 11%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Allahabad Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 10.50%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Bank of India Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 85%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.20% - 10.45%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Union Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >65% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">United Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 10.50%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Uco Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.20%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Bank of Baroda Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >75% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Kotak Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >up to 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Vijaya Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >Upto 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.30%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Standard Chart Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >Upto 80%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.15%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>  <tr>    <td height="40" align="left" bgcolor="#FFFFFF" class="th-new2-text">Indian Bank Home Loan</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >80% - 90%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" >10.25% - 12.25%</td>    <td height="40" align="center" bgcolor="#FFFFFF" class="th-new2-text" ><a href="https://www.deal4loans.com/apply-home-loans.php" target="_blank"><img src="images/home-loan-apply-new-btn-new.png" alt="" width="98" height="39" border="0" /></a></td>  </tr>    </table></td>  </tr></table></div></div><br><br>';
}
function hleligibility()
{
	var nitxt3 = document.getElementById('sectnwise_TXTDiv');
	nitxt3.innerHTML ='<div class="form-head-text-white">Get Eligibility Quote from 5 PSU and 7 Private Banks and Apply Online</div>';
var ni3 = document.getElementById('Hl_mainDiv');
	    ni3.innerHTML ='<div id="Hl_eligibilityDIV"><div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;"><div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;"><a name="Hl2">How is my Home loan Eligibility Calculated</a></h3></div><div class="body-text-new-hl">  The borrower eligibility of getting a housing loan depend upon his/her repayment capacity & the banks establish this repayment capacity by considering various factors such income, spouse&rsquo;s income, age, number of dependants qualifications , assets, liabilities, stability and continuity of occupation and savings history. Eligibility Factors in Housing loan Your Home Loan eligibility is determined by your repayment capacity and the value of the Property <br /><ul style="margin-left:35px; margin-top:10px;"><li>Income</li><li>Qualifications</li><li>Age</li><li>Spouse&rsquo;s income</li><li> No. of dependants</li><li>Stability and continuity of occupation</li><li>Assets/LiabilitiesM.</li><li>Savings history.</li></ul><br /><br />The most important concern of banks in determining your loan eligibility is that whether or not you are contentedly able to pay off the amount you borrow.<br /><br />The Second factor is the value of the Property<br /><br />Banks are okay to fund 75-85% of property value but with the condition that you have income capacity that you can pay its Emi each month.                      <br /><br />   </div></div>       </div>';
}

function Hlnoworwait()
{
	var nitxt4 = document.getElementById('sectnwise_TXTDiv');
	nitxt4.innerHTML ='<div class="form-head-text-white">Quick Apply and Get Instant Quotes from 5 PSU and 7 Private Banks.</div>';
	var ni4 = document.getElementById('Hl_mainDiv');
	    ni4.innerHTML ='<div id="HlnownwaitDIV"> <div style=" float:left; width:100%; height:auto; margin-top:5px; text-align:justify;"><div class="body-text-new-h2"><h3 class="body-text-new-h2" style=" color:#343434;"> <a name="Home-Loan-Now-n-Wait">Should I take Home loan now or wait ?</a></h3></div><div class="body-text-new-hl">Home loan is a long term loan and is taken by customers on floating rates .Rates keep changing and timing on 20 year loan is impossible.<br>The Home loan rates will change in 20 years so thinking to start a loan at a lower rate has no relevance.<br>The right time to take a Home loan is when:<ul style="margin-left:35px; margin-top:10px;"><li>The Property you intend to buy is good and cannot be missed or it is expected that the price of property will rise.</li><li>The Emi that you have to pay per month is above your monthly expense budgets etc.</li></ul><br><strong>Jan 2015- Home loan Trend</strong><br><br><ul style="margin-left:35px; margin-top:10px;"><li>Rbi has reduced rates and some Banks have already announced  rate cuts.</li><li>The Home loan rates will come to single digits in times to come.</li><li>Expect rates to come down further after March 2015, when the flow of funds is better in Banks.</li><li>We expect Home loans to stay under 10% for most part of 2015.</li><li>Rates can hit as low as 9% if RBI pushes for it.</li></ul><br></div> </div></div>';
}
</script>
<script>
function fornValidate()
{
	if (document.loan_form.Loan_Amount.value=="")
	{ document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>"; document.loan_form.Loan_Amount.focus();		return false;	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}	
		
	if (document.loan_form.Net_Salary.value=="")	{		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";			document.loan_form.Net_Salary.focus();		return false;	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;

	if (document.loan_form.City.selectedIndex==0)
	{		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";			document.loan_form.City.focus();		return false;	}
	
}
</script>

<div class="hl-form-wrapper">
  <form name="loan_form" method="post" action="/apply-home-loanscontinue1.php" onSubmit="return chkform();">
    <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <input type="hidden" name="Activate" id="Activate" >
    <input type="hidden" name="source" value="<? echo $newsource; ?>">
    <div>
      <h2 class="hl-h2" style="float:left;"><?php echo $subjectLine;?></h2>
      <?php if($subjectLine2!=""){?>
      <div style="padding-top:10px;  float:left;"><strong>&nbsp;<?php echo $subjectLine2;?></strong>&nbsp;</div>
      <?php }?>
      <?php if($subjectLine3!=""){?> <div style="padding-top:10px;"><?php echo $subjectLine3;?></div><?php }?>
    </div>
    <div style="clear:both;"></div>
    <div id="addPadding"><img src="http://www.deal4loans.com/images/spacer.gif" style="height:10px;"></div>
    <div style="clear:both;"></div>
    <div class="p-details"><strong>Professional Details</strong></div>
    <div style="clear:both;"></div>
    <div class="new-input-box">
      <div>Loan Amount</div>
      <div >
        <input name="Loan_Amount" id="Loan_Amount" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="d4l-input" onkeydown="validateDiv('loanAmtVal');" autocomplete="off" />
      </div>
      <div id="loanAmtVal"></div>
      <span id='formatedlA'></span><span id='wordloanAmount'></span> </div>
    <div class="new-input-box">
      <div>Occupation</div>
      <select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');"   class="d4l-select" tabindex="8" >
        <option value="-1">Select Occupation</option>
        <option value="1">Salaried</option>
        <option value="0">Self Employed</option>
      </select>
      <div id="empStatusVal"></div>
    </div>
    <div class="new-input-box">
      <div>Annual Income</div>
      <div>
        <input type="text" name="Net_Salary" id="Net_Salary" class="d4l-input" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome', 'wordIncome');" onkeypress="intOnly(this);"  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');"  autocomplete="off" />
      </div>
      <div id="netSalaryVal"></div>
      <span id='formatedIncome'></span> <span id='wordIncome'></span> </div>
    <div class="new-input-box">
      <div>City</div>
      <select name="City" id="City" class="d4l-select" onchange=" othercity1(); addPersonalDetails(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
        <?=getCityList($City)?>
      </select>
      <div id="cityVal"></div>
      <div>
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="right" id="otherCityName"></td>
          </tr>
        </table>
      </div>
    </div>
    <div style="clear:both;"></div>
    
    <div id="personalDetails">
     <div class="loan-quotewrap"><div class="loan-quote"><strong style="background:#e29500; color:#FFF; font-size:25px; font-weight:normal;">54</strong> ,<strong style="background:#043eac; font-size:25px; font-weight:normal; color:#FFF;">02 </strong>, <strong style="background:#44cbbe; color:#FFF; font-size:25px; font-weight:normal;">013</strong> Loan quotes taken till now</div>
          
     <div class="Hl-Quote-Btn"><input type="button" class="hl-get-quotebtn" value="Get Quote" onclick="return fornValidate(); "/></div></div>
    </div>
    <div style="clear:both;"></div>
    <div style="display:none; " id="divfaq1">
      <div class="new-input-box">
        <table width="99%" border="0" cellpadding="0" cellspacing="5">
          <tr>
            <td><span>Co-applicant Name:</span></td>
          </tr>
          <tr>
            <td><input name="co_name" id="co_name" type="text" class="d4l-input" /></td>
          </tr>
        </table>
      </div>
      <div class="new-input-box">
        <table width="99%" border="0" cellpadding="0" cellspacing="5">
          <tr>
            <td><span>Co-applicant DOB:</span></td>
          </tr>
          <tr>
            <td><select onkeydown="validateDiv('AgeVal');" class="d4l-select" name="CoAge" id="CoAge">
                <option value="">Select Age</option>
                <?php for($a=18;$a<=65;$a++) {?>
                <option value="<?php echo $a;?>"><?php echo $a;?></option>
                <?php }?>
              </select>
              <div id="co_AgeVal"></div></td>
          </tr>
        </table>
      </div>
      <div class="new-input-box">
        <table width="99%" border="0" cellpadding="0" cellspacing="5">
          <tr>
            <td><span>Gross Annual Salary:</span></td>
          </tr>
          <tr>
            <td><input type="text" name="co_monthly_income" id="co_monthly_income"  class="d4l-input"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" /></td>
          </tr>
        </table>
      </div>
      <div class="new-input-box">
        <table width="99%" border="0" cellpadding="0" cellspacing="5">
          <tr>
            <td>Monthly EMIs :</td>
          </tr>
          <tr>
            <td><input name="co_obligations" id="co_obligations" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this);" type="text" class="d4l-input" /></td>
          </tr>
        </table>
      </div>
    </div>
    <div id="addSubmit"> </div>
  </form>
  
  <div class="termtext" style="margin-left:25px;">
  <ul>
    <li>54 lakh customers serviced to get &nbsp;best  Loan deals with deal4loans. Deal4loans views  Published @ yourstory .com </li>
    <li> As RBI cuts rate, should you go for fixed home loan Deal4loans views Published @ Economic Times online </li>
  </ul>
</div>
<br />
</div>
