<script>
function containsdigit(param){	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{	if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))	{	return true;	}	} }
function Trim(strValue) {var j=strValue.length-1;i=0;while(strValue.charAt(i++)==' ');while(strValue.charAt(j--)==' ');return strValue.substr(--i,++j-i+1);}
function cityother(){	if(document.homeloan_calculator.City.value=="Others")	{		document.homeloan_calculator.City_Other.disabled = false;	}	else	{		document.homeloan_calculator.City_Other.disabled = true;	} } 
function validmobile(mobile) 
{		atPos = mobile.indexOf("0")// there must be one "@" symbol
	if (atPos == 0) 
	{		alert("Mobile number cannot start with 0.");		return false;	}
	if(!checkData(document.homeloan_calculator.Phone, 'Mobile number', 10))
		return false;
return true;
}

function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined) { document.getElementById('plantype2').innerHTML = strPlan;			   document.getElementById('plantype2').style.background='Beige';         }
       return true;
}
function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined)        {               document.getElementById('plantype2').innerHTML = strPlan;			   document.getElementById('plantype2').style.background='';  			                          }
       return true;
}
function validateDiv(div){	var ni1 = document.getElementById(div);	ni1.innerHTML = ''; }

function checkhlcalc()
{

var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var cnt;
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

if (document.homeloan_calculator.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.homeloan_calculator.Loan_Amount.focus();
		return false;
	}	
	if (document.homeloan_calculator.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status!</span>";	
		document.homeloan_calculator.Employment_Status.focus();
		return false;
	}
	if (document.homeloan_calculator.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.homeloan_calculator.Net_Salary.focus();
		return false;
	}	
	if(!checkNum(document.homeloan_calculator.Net_Salary, 'Annual Income',0))
		return false;
	
	

	
	if (document.homeloan_calculator.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.homeloan_calculator.City.focus();
		return false;

	}
	if((document.homeloan_calculator.Name.value=="") || (Trim(document.homeloan_calculator.Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.homeloan_calculator.Name.focus();
		return false;
	}
	if(document.homeloan_calculator.Name.value!="")
	{
		if(containsdigit(document.homeloan_calculator.Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.homeloan_calculator.Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.homeloan_calculator.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.homeloan_calculator.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.homeloan_calculator.Name.focus();
			return false;
		}
  }
		
	if(document.homeloan_calculator.Age.value=="")
	{
		document.getElementById('AgeVal').innerHTML = "<span  class='hintanchor'>Please select Age!</span>";
		document.homeloan_calculator.Age.focus();
		return false;
	}
	

	if(document.homeloan_calculator.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.homeloan_calculator.Phone.focus();
		return false;
	}
	if(isNaN(document.homeloan_calculator.Phone.value)|| document.homeloan_calculator.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.homeloan_calculator.Phone.focus();
		return false;  
	}
	if (document.homeloan_calculator.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.homeloan_calculator.Phone.focus();
		return false;
	}
	if ((document.homeloan_calculator.Phone.value.charAt(0)!="9") && (document.homeloan_calculator.Phone.value.charAt(0)!="8") && (document.homeloan_calculator.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.homeloan_calculator.Phone.focus();
		return false;
	}
	
	if(document.homeloan_calculator.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.homeloan_calculator.Email.focus();
		return false;
	}
	
	var str=document.homeloan_calculator.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.homeloan_calculator.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.homeloan_calculator.Email.focus();
		return false;
	}
		
	/*if((document.homeloan_calculator.City.value=="Others") && ((document.homeloan_calculator.City_Other.value=="" || document.homeloan_calculator.City_Other.value=="Other City"  ) || !isNaN(document.homeloan_calculator.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.homeloan_calculator.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.homeloan_calculator.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.homeloan_calculator.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.homeloan_calculator.City_Other.focus();
  		return false;
  	}

  }
  */
  if(document.homeloan_calculator.Property_Value.value=="")
	{
		document.getElementById('propertyValueVal').innerHTML = "<span  class='hintanchor'>Enter Property Value!</span>";	
		document.homeloan_calculator.Property_Value.focus();
		return false;
	}
	
	if(!document.homeloan_calculator.accept.checked)
	{
	//alert("Read and Accept Terms and Condition!");
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.homeloan_calculator.accept.focus();
		return false;
	}
	return true;
}

function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni5 = document.getElementById('buttn_box');
	
		ni5.innerHTML="";
		ni1.innerHTML = '<div class="body_inner_tptxt"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td  align="left"><strong>Personal Details</strong></td></tr>    <tr>   <td  align="left" class="termtext"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16"> Your Information is secure with us and will not be shared without your consent</td>    </tr></table></div><div style="clear:both;"></div>    <div class="hl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Full Name:</td></tr><tr><td><input name="Name" class="iput_box_new2" id="Name" type="text"  onKeyDown="validateDiv(\'nameVal\');" /><div id="nameVal"></div></td></tr></table></div><div class="hl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Age:</td></tr><tr><td><select onchange="validateDiv(\'AgeVal\');" class="select_box_new" name="Age" id="Age"><option value="">Select Age</option><?php for($a=18;$a<=65;$a++) {?><option value="<?php echo $a;?>"><?php echo $a;?></option><?php }?></select><div id="AgeVal"></div></td></tr></table></div> <div class="hl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Mobile:</td></tr><tr><td class="frm_text_tp">+91<input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" class="mob_iput_box_new2" onKeyDown="validateDiv(\'phoneVal\');"  /><div id="phoneVal"></div> </td></tr></table><div id="phoneVal"></div></div> <div class="hl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Email ID :</td></tr><tr><td><input name="Email" id="Email" type="text" class="iput_box_new2" onKeyDown="validateDiv(\'emailVal\');"  /><div id="emailVal"></div></td></tr></table></div><div style="clear:both;"></div><div class="hl_input-box_wrapper2"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Property Value:</td></tr><tr><td><input name="Property_Value" id="Property_Value" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); " type="text"  class="iput_box_new2" onKeyDown="validateDiv(\'propertyValueVal\');" /><div id="propertyValueVal"></div><div id="pincodeVal"></div></td></tr></table></div> <div class="hl_input-box_wrapper2" id="chnge_empstst">  <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td height="24" class="frm_text_tp">Total EMI of All Loans: </td></tr><tr><td><input name="total_obligation" id="total_obligation" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); "   type="text"  class="iput_box_new2" onKeyDown="validateDiv(\'obligationVal\');" /><div id="obligationVal"></div></td></tr></table></div><div style="clear:both;"></div>  <div class="second_trm_box termtext" ><input name="accept" type="checkbox"  /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.<div id="acceptVal"></div></div>  <div class="second_btn_box">		<input type="submit" name="Submit" class="hl-get-quotebtn2" value="Get Quote"/></div>   <div style="clear:both;"></div>';
	
}
	
	function othercity1()
{
//alert(document.personalloan_form.City.value);
	//var citydiv1 = document.getElementById('otherCityName');
	var citydiv2 = document.getElementById('otherCityName');
	if(document.loan_form.City.value=='Others')	
	{
//	alert(document.personalloan_form.City.value);
		citydiv2.innerHTML = '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr> <td height="24" class="frm_text_tp">Other City:</td></tr>    <tr>  <td>  <input type="text" class="iput_box_new" name="City_Other" id="City_Other" onKeyDown="validateDiv(\'othercityVal\');" tabindex="1"  autocomplete="off" /> </td></tr></table> <div id="othercityVal"></div>';	
	}
	else
	{
		citydiv2.innerHTML = '';
	}
}

</script>
<form name="homeloan_calculator" method="post" action="/apply-home-loanscontinue1.php" onSubmit="return checkhlcalc();">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<input type="hidden" name="Activate" id="Activate" ><input type="hidden" name="source" value="<? echo $newsource; ?>">
<div style="clear:both;"></div> 
   <div class="hl_form_wrapper">
<div class="body_inner_tptxt">
<strong class="hl-h2-new">Get Eligibility, Interest Rates Quote on Home loans in <?php echo $City; ?></strong>
</div>
<div class="body_inner2"><strong>Professional Details</strong></div>
<div class="hl_input-box_wrapper">
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
<div class="hl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Occupation:</td>
    </tr>
    <tr>
      <td>
        <select name="Employment_Status" id="Employment_Status" class="select_box_new" onchange="change_empstst();" tabindex="2">
       <option value="-1">Please Select</option>
<option value="1">Salaried</option>
<option value="0">Self Employed</option>
        </select>
        <div id="empStatusVal"></div>
     </td>
    </tr>
  </table>
</div>
<div class="hl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">City:</td>
    </tr>
    <tr>
      <td><select name="City" id="City" class="select_box_new" onchange=" othercity1(); addhdfclife(); validateDiv('cityVal');" tabindex="3">
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
<div class="hl_input-box_wrapper">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td height="24" class="frm_text_tp">Annual Income:</td>
    </tr>
    <tr>
      <td><input type="text" class="iput_box_new" name="Net_Salary" id="Net_Salary" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress=" addPersonalDetails(); intOnly(this); "  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary'); addPersonalDetails();" onKeyDown="validateDiv('netSalaryVal');" tabindex="4"  autocomplete="off"/><div id="dialog-modal" > </div>
<div id="netSalaryVal"></div> <span id='formatedIncome'></span> <span id='wordIncome'></span></td>
    </tr>
  </table>
</div>
<div id="buttn_box">
  <input type="submit" name="Submit" class="hl-get-quotebtn2" value="Get Quote"/>
</div>
<div style="clear:both;"></div><div class="hl_input-box_wrapper" id="otherCityName"></div>
<div style="clear:both;"></div>
<div style="width:100%; padding-left:12px;" id="personalDetails"></div>
<div style="clear:both; padding-top:10px;"></div>
<div id="hdfclife"></div>
<div style="clear:both;"></div>
</div>
</form>