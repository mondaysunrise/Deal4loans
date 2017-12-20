<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<Script Language="JavaScript">
function cityother()
{
	if(document. goldloanapplication_form.City.value=="Others")
	{
		document.goldloanapplication_form.City_Other.disabled = false;
	}
	else
	{
		document.goldloanapplication_form.City_Other.disabled = true;
	}
}


function CheckGoldLoanApplicationValidate()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if(document.goldloanapplication_form.Name.value=="") 
	{
        document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";		
		document.goldloanapplication_form.Name.focus();
		return false;
	}
	
	if(document.goldloanapplication_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Email Address!</span>";	
		document.goldloanapplication_form.Email.focus();
		return false;
	}

	var str=document.goldloanapplication_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.goldloanapplication_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.goldloanapplication_form.Email.focus();
		return false;
	}


	if(document.goldloanapplication_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.goldloanapplication_form.Phone.focus();
		return false;
	}
	if(isNaN(document.goldloanapplication_form.Phone.value)|| document.goldloanapplication_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.goldloanapplication_form.Phone.focus();
		return false;  
	}
	if (document.goldloanapplication_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.goldloanapplication_form.Phone.focus();
		return false;
	}
	if ((document.goldloanapplication_form.Phone.value.charAt(0)!="9") && (document.goldloanapplication_form.Phone.value.charAt(0)!="8") && (document.goldloanapplication_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.goldloanapplication_form.Phone.focus();
		return false;
	}
	

	if (document.goldloanapplication_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.goldloanapplication_form.City.focus();
		return false;
	}
	if((document.goldloanapplication_form.City.value=="Others") && ((document.goldloanapplication_form.City_Other.value=="" || document.goldloanapplication_form.City_Other.value=="Other City"  ) || !isNaN(document.goldloanapplication_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.goldloanapplication_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.goldloanapplication_form.City_Other.value.length; i++) {
		if (iChars.indexOf(document.goldloanapplication_form.City_Other.value.charAt(i)) != -1) {
			document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
			document.goldloanapplication_form.City_Other.focus();
			return false;
		}
	}

	
	if(document.goldloanapplication_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";
		document.goldloanapplication_form.Pincode.focus();
		return false;
	}
	if(isNaN(document.goldloanapplication_form.Pincode.value)|| document.goldloanapplication_form.Pincode.value.indexOf(" ")!=-1)
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.goldloanapplication_form.Pincode.focus();
		return false;  
	}
	if (document.goldloanapplication_form.Pincode.value.length < 6 )
	{
	  	document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter 6 Digits!</span>";	
		document.goldloanapplication_form.Pincode.focus();
		return false;
	}
	
	if (document.goldloanapplication_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.goldloanapplication_form.Loan_Amount.focus();
		return false;
	}	
	if(!checkNum(document.goldloanapplication_form.Loan_Amount, 'Loan Amount',0))
		return false;
		
	if(!document.goldloanapplication_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms and Condition!</span>";	
		document.goldloan_form.accept.focus();
		return false;
	}
	

}

function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
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

function Trim(strValue) 
{
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

</script>

<div class="gold-form-wrapper">
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="35"><h2 class="gold-h2-from"><?php echo $TagLine;?></h2></td>
  </tr>
</table>
<form name="goldloanapplication_form" action="insert-gold-loan.php" method="POST"  onSubmit="return CheckGoldLoanApplicationValidate();"> 
<input type="hidden" name="Type_Loan" value="Req_Loan_Gold">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="<? echo $_REQUEST['section'] ?>">
<input type="hidden" name="source" value="<? echo $source; ?>"> 
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>"> 
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<div class="new-input-box">
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="gold-form-text">Name:</td>
    </tr>
    <tr>
      <td><input name="Name" id="Name" type="text" class="d4l-input" onkeydown="validateDiv('nameVal');" tabindex="1" autocomplete="off" />
   <div id="nameVal"></div> </td>
    </tr>
  </table>
</div>
<div class="new-input-box">
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="gold-form-text">Email ID :</td>
    </tr>
    <tr>
      <td><input name="Email" id="Email" type="text" class="d4l-input" onkeydown="validateDiv('emailVal');" tabindex="2" autocomplete="off" />
   <div id="emailVal"></div> </td>
    </tr>
  </table>
</div>
<div class="new-input-box">
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="gold-form-text">Age:</td>
    </tr>
    <tr>
      <td>
      <select name="Age" class="d4l-select" tabindex="3">
      <option value="">Select Age</option>
      <?php 
	  for($a=18; $a<=65;$a++)
	  {
	  ?>
      <option value="<?php echo $a;?>"><?php echo $a;?></option>
      <?php }?>
      </select>
      <div id="dobVal"></div></td>
    </tr>
  </table>
</div>
<div class="new-input-box">
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="gold-form-text">Mobile:</td>
    </tr>
    <tr>
      <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="12%" class="gold-form-text">+91</td>
          <td width="88%"><input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="d4l-input" onkeydown="validateDiv('phoneVal');" autocomplete="off" tabindex="4" />
            <div id="phoneVal"></div> </td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
<div style="clear:both; height:15px;"></div>
<div class="new-input-box">
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="gold-form-text">City:</td>
    </tr>
    <tr>
      <td><select name="City" id="City" class="d4l-select" onchange="cityother(); validateDiv('cityVal');" tabindex="5">
			<?=plgetCityList($City)?>
		</select>
      <div id="cityVal"></div> </td>
    </tr>
  </table>
</div>
<div class="new-input-box">
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="gold-form-text">Other City:</td>
    </tr>
    <tr>
      <td><input name="City_Other" id="City_Other" type="text" class="d4l-input" disabled onKeyUp="searchSuggest();" onkeydown="validateDiv('othercityVal');" tabindex="6" autocomplete="off" />
		<div id="othercityVal"></div> </td>
    </tr>
  </table>
</div>
<div class="new-input-box">
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="gold-form-text">Pincode:</td>
    </tr>
    <tr>
      <td><input name="Pincode" id="Pincode" maxlength="6" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="d4l-input" onkeydown="validateDiv('pincodeVal');" tabindex="7" autocomplete="off" />
		<div id="pincodeVal"></div> 
	  </td>
    </tr>
  </table>
</div>
<div class="new-input-box">
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td class="gold-form-text">Loan Amount:</td>
    </tr>
    <tr>
      <td><input name="Loan_Amount" id="Loan_Amount" maxlength="8" onKeyPress="intOnly(this);" onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');"  onblur="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" type="text" class="d4l-input" onKeyDown="validateDiv('loanAmtVal');" autocomplete="off" tabindex="8" />
    <div id="loanAmtVal"></div>
    <span id='formatedlA'></span>
    <span id='wordloanAmount'></span>
	  </td>
    </tr>
  </table>
</div>
<div style="clear:both; height:15px;"></div>
<div class="termtext" style="color:#FFF;"><input name="accept" type="checkbox" checked="checked" /> I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="color:#FFF;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="color:#FFF;">Terms and Conditions</a>.<div id="acceptVal"></div></div>
<div style="clear:both; height:15px;"></div>
<div class="gold_bnt_b"><input type="submit" class="gold-get-quotebtn" value="Submit" tabindex="9" /></div>
<div style="clear:both; height:15px;"></div>
</form>
</div>
