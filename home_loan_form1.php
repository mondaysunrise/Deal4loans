<?php $_SERVER['REQUEST_URI'];
if($_SERVER['REQUEST_URI']=='/lic-housing-home-loan.php')
{
	$newsource="LI SEO 1";
	$subjectLine="for Best Home Loan from Deal4loans Associated Banks";
}
else if($_SERVER['REQUEST_URI']=='/home-loan-citibank.php')
{
	$newsource="CI SEO 1";
	$subjectLine="for Best Home Loan from Deal4loans Associated Banks";
}
else if($_SERVER['REQUEST_URI']=='/home-loan-axis-bank.php')
{
	$newsource="AX SEO 1";
	$subjectLine="Axis Bank Home Loan";
}
else if($_SERVER['REQUEST_URI']=='/home-loan-citifinancial.php')
{
	$newsource="CITI SEO 1";
	$subjectLine="for Best Home Loan from Deal4loans Associated Banks";
}
else if($_SERVER['REQUEST_URI']=='/home-loan-kotak-mahindra-bank.php')
{
	//$newsource="KO SEO 1";
	//$subjectLine="Kotak Home Loan";
}
else if(($_SERVER['REQUEST_URI']=='/hdfc-bank-home-loan.php') || ($_SERVER['REQUEST_URI']=='/hdfc-ltd-home-loan.php'))
{
	$newsource="HD SEO 1";
	$subjectLine="HDFC Ltd Home Loan";
}
else if($_SERVER['REQUEST_URI']=='/dhfl.php')
{
	$newsource="DH SEO 1";
	$subjectLine="for Best Home Loan from Deal4loans Associated Banks";
}
else if($_SERVER['REQUEST_URI']=='/icici-hfc-home-loan.php')
{
	$newsource="IH SEO 1";
	$subjectLine="ICICI Bank Home Loan";
}
else if($_SERVER['REQUEST_URI']=='/home-loan-emi-calculator1.php')
{
	$newsource="Hl emi calc";
	$subjectLine="To know your Eligibility/Emi/Rate of interest at current rate from all Banks-Apply Now";
}
else if($_SERVER['REQUEST_URI']=='/home-loan-lic-housing.php')
{
	$newsource="LIC SEO 1";
	$subjectLine="for Best Home Loan from Deal4loans Associated Banks";
}
else if($_SERVER['REQUEST_URI']=='/home-loan-idbi-homefinance.php')
{
	$newsource="IDBI homefinance SEO 1";
	$subjectLine="for Best Home Loan from Deal4loans Associated Banks";
}
else if($_SERVER['REQUEST_URI']=='/home-loan-ingvysya-bank.php')
{
	$newsource="Ingvysya bank SEO 1";
	$subjectLine="Best Home Loan from Deal4loans Associated Banks";
}
else if($_SERVER['REQUEST_URI']=='/home-loan-standard-chartered-bank.php')
{
	$newsource="Standard Chartered bank SEO 1";
	$subjectLine="Standard Chartered Home Loan";
}
else if($_SERVER['REQUEST_URI']=='/deutsche-bank-home-loan.php')
{
$newsource="Deutsche Bank SEO 1";
	$subjectLine="for Best Home Loan from Deal4loans Associated Banks";
}
else if($_SERVER['REQUEST_URI']=='/home-loan-reliance.php')
{
$newsource="Reliance SEO 1";
	$subjectLine="for Best Home Loan from Deal4loans Associated Banks";
}
?>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="scripts/common.js"></script>
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


function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '<table width="100%" align="left" border="0"><tr><td height="20"  align="left" valign="middle" class="frmbldtxt"><b style="color:#373737;">Property Location</b></td>	<td colspan="3" align="left" height="20" >&nbsp;&nbsp;&nbsp;<select style="width:150px;" name="Property_Loc" id="Property_Loc" tabindex="16"><?=getCityList1($City)?></select></td></tr></table>';
			
		return true;
}	
	
function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		ni.innerHTML = '';
			
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
	if((document.loan_form.Name.value=="") || (Trim(document.loan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
	}

	if(document.loan_form.Name.value!="")
	{
		if(containsdigit(document.loan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.loan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.loan_form.Name.focus();
			return false;
		}
  }
	
	if(document.loan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.loan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.loan_form.Phone.value)|| document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.loan_form.Phone.focus();
		return false;  
	}
	if (document.loan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
		
	if(document.loan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	
	if (document.loan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.loan_form.City.focus();
		return false;
	}
		if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.loan_form.City_Other.focus();
  		return false;
  	}
  }

	
	if (document.loan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.loan_form.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Net_Salary, 'Annual Income',0))
		return false;

	if (document.loan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.loan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.loan_form.Loan_Amount, 'Loan Amount',0))
		return false;
	
	if(!document.loan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	

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

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.loan_form.City.value;
	var otrcit = document.loan_form.City_Other.value;
	//alert(cit);	
	if(cit =="Ahmedabad" || otrcit =="Allahabad" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag")
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else if(cit =="Cochin" || cit =="Chennai" || cit =="Bangalore" || cit =="Mangalore" || cit =="Madurai" || cit =="Salem" || cit =="Trivandrum" || cit =="Kochi" || cit =="Coimbatore" || cit =="Erode" || cit =="Trichy" || cit =="Thrissur" || cit =="Pondicherry")
	{
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="mahindra_life" id="mahindra_life" value="2"/></td> <td width="660" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> If you are also interested in a Mahindra Lifespaces-Iris Court Chennai Property, Please tick here, we will get in touch with you.</td></tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}


function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
</script>

<form name="loan_form" method="post" action="insert_home_loan_step_value1.php" onSubmit="return chkform();">
 <input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<?php echo $newsource; ?>">
 <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
 <input type="hidden" name="Type_Loan" id="Type_Loan" value="Req_Loan_Home">
 <div class="hdfc_ltd_form">
<div class="pl_form_title"><h2 class="text3" style=" color:#FFF; font-size:24px; text-transform:none; "><strong>Compare HDFC Ltd Home Loan</strong></h2>
</div>

<div class="pl_blink_text"><img src="images/animated_cc.gif"  /></div>
<div style="clear:both;"></div>


<div class="ac_input_box">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</span></td>
    </tr>
    <tr>
      <td height="25">   <input name="Name" id="Name" type="text" class="pl_input_b" onKeyDown="validateDiv('nameVal');" />
        <div id="nameVal"></div>   </td>
    </tr>
    <tr>
      <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></td>
    </tr>
    <tr>
      <td height="25" style="color:#FFF; font-size:12px;"><em>+91</em>
       <input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" class="pl_mobo_b" onKeyDown="validateDiv('phoneVal');"  />
            <div id="phoneVal"></div>  
      
      </td>
    </tr>
  </table>
</div>

<div class="ac_input_box">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</span></td>
    </tr>
    <tr>
      <td height="25">  <select name="City" id="City" class="pl_select_b" style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="cityother(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
                            <?=plgetCityList($City)?>
                                       </select>
                         <div id="cityVal"></div>     </td>
    </tr>
    <tr>
      <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City :</span></td>
    </tr>
    <tr>
      <td height="25">  <input name="City_Other" id="City_Other" type="text" class="pl_input_b" disabled onKeyUp="searchSuggest();" onKeyDown="validateDiv('othercityVal');"  />
        <div id="othercityVal"></div>
        
        </td>
      
    </tr>
    </table>
</div>
<div class="ac_input_box">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</span></td>
    </tr>
    <tr>
      <td height="25"> <input name="Email" id="Email" type="text" class="pl_input_b" onKeyDown="validateDiv('emailVal');"  />
          <div id="emailVal"></div> </td>
    </tr>
    <tr>
      <td height="25"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Gross Annual Salary: </span></td>
    </tr>
    <tr>
      <td height="25"> <input type="text" name="Net_Salary" id="Net_Salary" class="pl_input_b"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onKeyDown="validateDiv('netSalaryVal');"  />
        <div id="netSalaryVal"></div>
        <span id='formatedIncome' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span>        </td>
    </tr>
    </table>
</div>

<div class="ac_input_box">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Loan Amount:</span></td>
      </tr>
    <tr>
      <td  height="48">
       <input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  type="text" class="pl_input_b" onKeyDown="validateDiv('loanAmtVal');" />

     <div id="loanAmtVal"></div>
     <span id='formatedlA' style='font-size:11px; font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span>
     </td>
      </tr>
  </table>
</div>
<div style="clear:both;"></div>
<div class="ac_terms_box" style="font-size:11px; font-family:Verdana, Geneva, sans-serif;"> <input name="accept" type="checkbox" /> 
  <em>I Agree to</em>&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> <em>and</em>&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.
  <div id="acceptVal"></div></div>
  
  <div class="hdfc_get_btn_box"><input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div>
<div style="clear:both;"></div>
<div id="hdfclife"></div>






</div>
	</form>