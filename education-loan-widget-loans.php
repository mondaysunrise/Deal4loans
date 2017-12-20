<script Language="JavaScript" Type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script>
<script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

<Script Language="JavaScript">

function chkeducaionloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
 
if((document.eduloan_form.Name.value=="") || (Trim(document.eduloan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.eduloan_form.Name.focus();
		return false;
	}

	if(document.eduloan_form.Name.value!="")
	{
		if(containsdigit(document.eduloan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.eduloan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.eduloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.eduloan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.eduloan_form.Name.focus();
			return false;
		}
  }

	if(document.eduloan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.eduloan_form.Email.focus();
		return false;
	}
	
	var str=document.eduloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.eduloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.eduloan_form.Email.focus();
		return false;
	}
	if(document.eduloan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.eduloan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.eduloan_form.Phone.value)|| document.eduloan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.eduloan_form.Phone.focus();
		return false;  
	}
	if (document.eduloan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.eduloan_form.Phone.focus();
		return false;
	}
	if ((document.eduloan_form.Phone.value.charAt(0)!="9") && (document.eduloan_form.Phone.value.charAt(0)!="8") && (document.eduloan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.eduloan_form.Phone.focus();
		return false;
	}
		

	if (document.eduloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.eduloan_form.City.focus();
		return false;
	}
	if((document.eduloan_form.City.value=="Others") && ((document.eduloan_form.City_Other.value=="" || document.eduloan_form.City_Other.value=="Other City"  ) || !isNaN(document.eduloan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.eduloan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.eduloan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.eduloan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.eduloan_form.City_Other.focus();
  		return false;
  	}
  }
    
if(Form.Course.selectedIndex==0)
{
	document.getElementById('courseVal').innerHTML = "<span  class='hintanchor'>Enter Course of Study!</span>";	
	//alert("Please enter Course of Study to Continue");
	Form.Course.focus();
	return false;
}
else if((Form.Course.value>1)  && ((Form.Course_Name.value=='')||!isNaN(Form.Course_Name.value) ||(Form.Course_Name.value=="Course Name")))
{
document.getElementById('courseNameVal').innerHTML = "<span  class='hintanchor'>Fill in Course Name!</span>";	
Form.Course_Name.focus();
return false;
}

  if (document.eduloan_form.Employment_Status.selectedIndex==0)
  {
	document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Employment Status!</span>";	
	document.eduloan_form.Employment_Status.focus();
	return false;
  }

if (document.eduloan_form.Loan_Amount.value=="")
{
	document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
	document.eduloan_form.Loan_Amount.focus();
	return false;
}
if(!document.eduloan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms and Condition!</span>";	
		document.eduloan_form.accept.focus();
		return false;
	}
}  


function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
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

function getcourse_nme()
{
if(document.eduloan_form.Course.value==2 || document.eduloan_form.Course.value==3 || document.eduloan_form.Course.value==4)
{
document.eduloan_form.Course_Name.disabled=false;
}
else
{document.eduloan_form.Course_Name.disabled=true;
}
}

function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
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

function addhdfclife(cit)
{
	var ni1 = document.getElementById('hdfclifeD');
	
		ni1.innerHTML = '';
	//var cit = document.eduloan_form.City.value;
if(cit=="Others")
{
	var cit = document.eduloan_form.City_Other.value;
}	
//alert(cit);
	if(cit =="Ahmedabad" || otrcit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" || cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
	//alert("Upendra");
		ni1.innerHTML = '';
	}
	return true;
}

function othercity1()
{
	if(document.eduloan_form.City.value=='Others')
	{
		document.eduloan_form.City_Other.disabled=false;
		document.getElementById('otherCityDisp').style.display="block";
	}
	else
	{
		document.eduloan_form.City_Other.disabled=true;
	}
}
</script>

<div class="edu-form-wrapper">
<form name="eduloan_form"  action="/insert_education_loan_value.php" method="POST" onSubmit="return chkeducaionloan(document.eduloan_form);"> 
<input type="hidden" name="source" value="<?php echo $newsource; ?>" />
<h2 class="edu-h2-from"><?php echo $TagLine;?></h2>
<div style="clear:both;"></div>
<div class="new-input-box" >
<table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25" class="edu-form-text">Full Name:</td>
      </tr>
      <tr>
        <td height="30"> <input name="Name" id="Name" type="text" class="d4l-input" onkeydown="validateDiv('nameVal');" autocomplete="off" />
   <div id="nameVal"></div>  </td>
      </tr>
    </table>
</div>
<div class="new-input-box" >
<table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25" class="edu-form-text">Country of Study:</td>
      </tr>
      <tr>
        <td height="30"><select name="Country" id="Country" class="d4l-select"  onchange="validateDiv('cityVal');" tabindex="7">
                          <option value="1">India</option>
						<option value="2">UK</option>
						<option value="3">USA</option>
						<option value="4">Other Country</option>
                 
                        </select>
                         <div id="countryVal"></div>  </td>
      </tr>
    </table>
</div>
<div class="new-input-box" >
<table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25" class="edu-form-text">Course of Study: </td>
      </tr>
      <tr>
        <td height="30"><select name="Course" id="Course" onchange="getcourse_nme(); validateDiv('courseVal');" class="d4l-select">
                          	<option value="">Please Select</option>
						<option value="3">Graduation Courses</option>
						<option value="2">Post Graduation Courses</option>
						<option value="4">Other Courses</option>
                     </select>
          <div id="courseVal"></div>  </td>
      </tr>
    </table>
</div>
<div class="new-input-box" >
<table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25" class="edu-form-text">Co-borrower's* Income:</td>
      </tr>
      <tr>
        <td height="30">
        <input name="Coborrower_Income" id="Coborrower_Income"  type="text" class="d4l-input"  maxlength="10" onFocus="this.select();" onChange="ShowHide('loanShow','Coborrower_Income');"  onkeyup="intOnly(this);getDigitToWords('Coborrower_Income','formatedEdu','wordloanAmountEdu');"  onkeydown="getDigitToWords('Coborrower_Income','formatedEdu','wordloanAmountEdu'); validateDiv('loanAmtVal');" onKeyPress="intOnly(this); getDigitToWords('Coborrower_Income','formatedEdu','wordloanAmountEdu');" onBlur="getDigitToWords('Coborrower_Income','formatedEdu','wordloanAmountEdu');" autocomplete="off" />
              <span id='formatedEdu'></span><span id='wordloanAmountEdu'></span></td>
      </tr>
    </table>
</div>
<div style="clear:both; height:15px;"></div>
<div class="new-input-box" >
<table width="98%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="25" class="edu-form-text">Email ID :</td>
      </tr>
      <tr>
        <td height="30"><input name="Email" id="Email" type="text" class="d4l-input" onkeydown="validateDiv('emailVal');" autocomplete="off" />
          <div id="emailVal"></div></td>
      </tr>
    </table>
</div>
<div class="new-input-box">
  <table width="98%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" class="edu-form-text">Residence City:</td>
    </tr>
    <tr>
      <td height="30"><select name="City" id="City" class="d4l-select" onChange="othercity1(this.value); validateDiv('cityVal'); addhdfclife(this.value);" tabindex="7">
		<?=getCityList($City)?>
        </select>
                         <div id="cityVal"></div></td>
    </tr>
  </table>
</div>
<div class="new-input-box" >
  <table width="98%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" class="edu-form-text">Course Name:</td>
    </tr>
    <tr>
      <td height="30"><input name="Course_Name" id="Course_Name" type="text" class="d4l-input" disabled  onkeydown="validateDiv('courseNameVal');" onclick="validateDiv('courseNameVal');" onblur="validateDiv('courseNameVal');" autocomplete="off" />
                        <div id="courseNameVal"></div></td>
    </tr>
  </table>
</div>
<div class="new-input-box">
  <table width="98%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" class="edu-form-text">Required Loan Amount: </td>
    </tr>
    <tr>
      <td height="30"><input name="Loan_Amount" id="Loan_Amount" tabindex="11" type="text" class="d4l-input" maxlength="10" onfocus="this.select();" onchange="ShowHide('loanShow','Loan_Amount'); validateDiv('loanAmtVal');"  onkeyup="intOnly(this);getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanAmtVal');"  onkeydown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanAmtVal');" onkeypress="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanAmtVal');" onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount'); validateDiv('loanAmtVal');" autocomplete="off" />
                                     <span id='formatedlA'></span><span id='wordloanAmount'></span></td>
    </tr>
  </table>
</div>
<div style="clear:both; height:15px;"></div>
<div class="new-input-box" >
  <table width="98%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" class="edu-form-text">Mobile:</td>
    </tr>
    <tr>
      <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="12%" class="edu-form-text">+91</td>
          <td width="88%"> <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="d4l-input" onkeydown="validateDiv('phoneVal');" autocomplete="off" />
            <div id="phoneVal"></div>  </td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>

<div class="new-input-box" id="otherCityDisp" style="display:none;">
  <table width="98%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" class="edu-form-text">Other City:</td>
    </tr>
    <tr>
      <td height="30"><input name="City_Other" id="City_Other" onChange="addhdfclife(this.value);" type="text" class="d4l-input"  onKeyUp="searchSuggest();" onkeydown="validateDiv('othercityVal');" autocomplete="off"  disabled />
                        <div id="othercityVal"></div> </td>
    </tr>
  </table>
</div>

<div class="new-input-box" >
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="25" class="edu-form-text">Applicant's Income Status :</td>
    </tr>
    <tr>
      <td height="30"><select name="Employment_Status" id="Employment_Status" class="d4l-select" onchange="validateDiv('netSalaryVal');" tabindex="9"><option>Please Select</option><option value="1">Salaried</option><option value="2">Self Employed</option><option value="3">Not Earning</option></select>
        <div id="netSalaryVal"></div>
        <span id='formatedIncome'></span> 
        <span id='wordIncome'></span>
        </td>
    </tr>
  </table>
</div>

<div style="clear:both; height:15px;"></div>
<div>
<div style="float:left;" class="termtext"><input name="accept" type="checkbox" checked="checked" />
I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.
	</div>
<div style="float:right; margin-right:10px; margin-top:10px;">
<input type="submit" class="edu-get-quotebtn" value="Get Quote" />
</div>
</div>
<div style="clear:both; height:15px;"></div>
<div class="termtext">* Co-borrower : Relative with good income who can support your education loan application. Typically it can be your Father, Mother, Brother, Sister, Spouse, Cousin, Paternal Uncle (Chacha), Paternal Aunt (Chachi), Maternal Uncle (Mama), Maternal Aunt (Mami), Grandfather, Grandmother</div>
</form>
</div>