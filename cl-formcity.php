<?php 
$_SERVER['REQUEST_URI'];
?>
<script>
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
function HandleOnClose(filename) {
if ((event.clientY < 0)) {

myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
myWindow.document.bgColor=""
myWindow.document.close() 
}
}
function chkcarloan(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var j;
	var cnt=-1;
	var curr_dt = '';
	curr_dt = new Date().getFullYear();
 	var maxage = curr_dt - 62;
	var minage = curr_dt - 18;
	
 	if (document.carloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.carloan_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.carloan_form.Loan_Amount, 'Loan Amount',0))
		return false;
		
	if (document.carloan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span class='hintanchor'>Please enter Employment Status!</span>";	
		document.carloan_form.Employment_Status.focus();
		return false;
	}
 		
	if(document.carloan_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.carloan_form.Net_Salary.focus();
		return false;
	}
if (document.carloan_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.carloan_form.City.focus();
		return false;
	}
 
if((document.carloan_form.Name.value=="") || (Trim(document.carloan_form.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.carloan_form.Name.focus();
		return false;
	}

	if(document.carloan_form.Name.value!="")
	{
		if(containsdigit(document.carloan_form.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.carloan_form.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.carloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.carloan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.carloan_form.Name.focus();
			return false;
		}
  }
		if(document.carloan_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.carloan_form.Phone.focus();
		return false;
	}
	if(isNaN(document.carloan_form.Phone.value)|| document.carloan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.carloan_form.Phone.focus();
		return false;  
	}
	if (document.carloan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.carloan_form.Phone.focus();
		return false;
	}
	if ((document.carloan_form.Phone.value.charAt(0)!="9") && (document.carloan_form.Phone.value.charAt(0)!="8") && (document.carloan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.carloan_form.Phone.focus();
		return false;
	}
	
	if(document.carloan_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.carloan_form.Email.focus();
		return false;
	}
	
	var str=document.carloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.carloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.carloan_form.Email.focus();
		return false;
	}
	
	if(document.carloan_form.Age.value=="")
	{
		document.getElementById('AgeVal').innerHTML = "<span  class='hintanchor'>Please select Age!</span>";
		document.carloan_form.Age.focus();
		return false;
	}
	
	if((document.carloan_form.City.value=="Others") && ((document.carloan_form.City_Other.value=="" || document.carloan_form.City_Other.value=="Other City"  ) || !isNaN(document.carloan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.carloan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.carloan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.carloan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.carloan_form.City_Other.focus();
  		return false;
  	}
  }
  
  
 

if((document.carloan_form.Company_Name.value=="") || (document.carloan_form.Company_Name.value=="Company Name")|| (Trim(document.carloan_form.Company_Name.value))==false)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.carloan_form.Company_Name.focus();
		return false;
	}
	else if(document.carloan_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.carloan_form.Company_Name.focus();
		return false;
	}


	
			for(j=0; j<document.carloan_form.Car_Booked.length; j++) 
	{
		 if(document.carloan_form.Car_Booked[j].checked)
		{
			 if(j==0)
				{
				if (document.carloan_form.cldelivery_date.value=="" || document.carloan_form.cldelivery_date.value=="DD-MM-YYYY")
				{
						document.getElementById('delivry_dtVal').innerHTML = "<span  class='hintanchor'>Enter valid delivery date</span>";	
						document.carloan_form.cldelivery_date.focus();
						return false;
				}

				}

			 cnt= j;
		}
	}
	
		if(cnt == -1) 
		{
			document.getElementById('carbukedVal').innerHTML = "<span  class='hintanchor'> select car Booked or not</span>";	
			return false;
		}
		
	if(!document.carloan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.carloan_form.accept.focus();
		return false;
	}
}
function adddel_dt()
{
	var ni = document.getElementById('myDivdel_dt');
	if(ni.innerHTML=="")
	{
		ni.innerHTML = '<table cellpadding="0" cellspacing="0"><tr><td height="28" class="frm_text_tp">Delivery Date</td></tr><tr><td class="text" style="color:#FFF; font-size:12px; text-transform:none;"><input type="text" name="cldelivery_date" id="cldelivery_date" value="DD-MM-YYYY" onblur="onBlurDefault(this,\'DD-MM-YYYY\');" onfocus="onFocusBlank(this,\'DD-MM-YYYY\');" class="iput_box_new2" onkeydown="validateDiv(\'delivry_dtVal\');"/></div><div id="delivry_dtVal"></div></td></tr></table>';
	}
	return true;
}

function removedel_dt()
{
	var ni = document.getElementById('myDivdel_dt');
	if(ni.innerHTML!="")	{			ni.innerHTML = '';	}
	return true;
}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.carloan_form.City.value;
		ni1.innerHTML = '';
	if(cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		ni1.innerHTML = '<table  style="border:1px solid #FFF; padding:2px; width:100%;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#ff0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else	{	ni1.innerHTML = '';	}
	return true;
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni5 = document.getElementById('buttn_box');
	var ni2 = document.getElementById('Employment_Status').value;
	
	ni5.innerHTML="";
	ni1.innerHTML = '<div class="body_inner_tptxt"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td  align="left" ><strong>Personal Details</strong></td></tr>    <tr><td  align="left" class="termtext" ><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td>    </tr></table></div><div style="clear:both;"></div>    <div class="cl_input-box_wrapper"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Full Name:</td></tr><tr><td><input name="Name" class="iput_box_new2" id="Name" type="text"  onKeyDown="validateDiv(\'nameVal\');" /><div id="nameVal"></div></td></tr></table></div> <div class="cl_input-box_wrapper"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Mobile:</td></tr><tr><td class="frm_text_tp">+91<input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" class="mob_iput_box_new2" onKeyDown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div> </td></tr></table><div id="phoneVal"></div></div><div class="cl_input-box_wrapper"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Email ID :</td></tr><tr><td><input name="Email" id="Email" type="text" class="iput_box_new2" onKeyDown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td></tr></table></div><div class="cl_input-box_wrapper"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Age:</td></tr><tr><td><select onchange="validateDiv(\'AgeVal\');" class="select_box_new" name="Age" id="Age"><option value="">Select Age</option><?php for($a=18;$a<=65;$a++) {?><option value="<?php echo $a;?>"><?php echo $a;?></option><?php }?></select><div id="AgeVal"></div></td></tr></table></div><div style="clear:both;"></div>     <div class="cl_input-box_wrapper" id="chnge_empstst">  <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Company Name: </td></tr><tr><td><input name="Company_Name" id="Company_Name" type="text"  autocomplete="off" class="iput_box_new2" onKeyDown="validateDiv(\'companyNameVal\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event)"  onblur="onBlurDefault(this,\'Type slowly to autofill\');"  value="Type slowly to autofill" onfocus="onFocusBlank(this,\'Type slowly to autofill\');"/><div id="companyNameVal"></div></td></tr></table></div><div class="cl_input-box_wrapper"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Car Type:</td></tr><tr><td class="frm_text_tp"><select  class="select_box_new" name="Car_Type" onchange="validateDiv(\'carTypeVal\');" tabindex="12"><option selected value="-1">Interested In</option>	<option  value="1">New Car</option>	<option value="0">UsedCar</option></select><div id="carTypeVal"></div> </td></tr></table></div><div class="cl_input-box_wrapper"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Car Booked:</td></tr><tr><td class="frm_text_tp">     <table cellpadding="0" cellspacing="0"><tr><td><input type="radio" value="2" name="Car_Booked" id="Car_Booked" style="border:none;" onClick="adddel_dt();" onkeydown="validateDiv(\'carbukedVal\'); " tabindex="13" > Yes </td><td><input type="radio" value="1" name="Car_Booked" id="Car_Booked" style="border:none;" onClick="removedel_dt();" onkeydown="validateDiv(\'carbukedVal\'); " tabindex="14" > No  <div id="carbukedVal"></div></td></tr></table> </td></tr></table></div><div class="cl_input-box_wrapper" id="myDivdel_dt"></div><div style="clear:both;"></div>  <div class="second_trm_box termtext"><input type="checkbox"  name="accept" style="border:none;" tabindex="15" > I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal"></div></div>  <div class="second_btn_box">			<input type="submit" name="Submit" value="Get Quote" class="cl-get-quotebtn2" tabindex="16" />	</div><div style="clear:both;"></div>';
}
	
function othercity1()
{
	var citydiv2 = document.getElementById('otherCityName');
	if(document.loan_form.City.value=='Others')	
	{
		citydiv2.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr> <td height="24" class="frm_text_tp">Other City:</td></tr>    <tr>  <td>  <input type="text" class="iput_box_new" name="City_Other" id="City_Other" onKeyDown="validateDiv(\'othercityVal\');" tabindex="1"  autocomplete="off" /> </td></tr></table> <div id="othercityVal"></div>';	
	}
	else	{		citydiv2.innerHTML = '';	}
}
function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

</script>
<form name="carloan_form" method="post" action="/insert-car-loan-values.php" onSubmit="return chkcarloan(document.carloan_form);">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $retrivesource; ?>">
<div style="clear:both;"></div> 
   <div class="cl_form_wrapper">
<div class="body_inner_tptxt"><h2 class="cl-h2-from">Apply for Best <?php echo $subjectLine; ?></h2></div>
<div class="body_inner2"><strong>Professional Details</strong></div>
<div class="cl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Loan Amount:</td>
    </tr>
    <tr>
      <td>
        <input type="text" class="iput_box_new" name="Loan_Amount" id="Loan_Amount" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyDown="validateDiv('loanAmtVal');" tabindex="1"  autocomplete="off" />
		<div id="loanAmtVal"></div><span id='formatedlA'></span><span id='wordloanAmount'></span>
     </td>
    </tr>
  </table>
</div>
<div class="cl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Occupation:</td>
    </tr>
    <tr>
      <td>
        <select name="Employment_Status" id="Employment_Status" class="select_box_new" onchange="validateDiv('empStatusVal');change_empstst();" tabindex="2">
       <option value="-1">Please Select</option>
<option value="1">Salaried</option>
<option value="0">Self Employed</option>
        </select>
        <div id="empStatusVal"></div>
     </td>
    </tr>
  </table>
</div>
<div class="cl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">City:</td>
    </tr>
    <tr>
      <td><select name="City" id="City" class="select_box_new" onchange="addhdfclife(); othercity1(); validateDiv('cityVal');" tabindex="3">
       <?=plgetCityList($City)?>
<option value="Vapi">Vapi</option>
<option value="Ankleshwar">Ankleshwar</option>
<option value="Anand">Anand</option>
<option value="Anand">Dahod</option>
<option value="Anand">Navsari</option>
      </select><div id="cityVal"></div></td>
    </tr>
  </table>
</div>
<div class="cl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Annual Income:</td>
    </tr>
    <tr>
      <td><input type="text" class="iput_box_new" name="Net_Salary" id="Net_Salary" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');" onKeyPress=" addPersonalDetails(); intOnly(this); "  onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary'); addPersonalDetails();" onKeyDown="validateDiv('netSalaryVal');" tabindex="4"  autocomplete="off"/><div id="dialog-modal" > </div>
<div id="netSalaryVal"></div> <span id='formatedIncome'></span> <span id='wordIncome'></span></td>
    </tr>
  </table>
</div>
<div class="button_box_new" id="buttn_box">
<input type="submit" name="Submit" value="Get Quote" class="cl-get-quotebtn2" tabindex="16"></div>
<div style="clear:both;"></div><div class="cl_input-box_wrapper" id="otherCityName"></div>
<div style="clear:both;"></div>
<div style="width:100%;" id="personalDetails"></div>
<div style="clear:both; padding-top:10px;"></div>
<div id="hdfclife"></div>
<div style="clear:both;"></div>
</div>
</form>