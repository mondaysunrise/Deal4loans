<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/ajax.js"></script>
<script type="text/javascript" src="/ajax-dynamic-httpscclist.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script>
 $(function() {
$( "#salary_account" )
.change(function() {
var count= $("#salary_account :selected").length;
$( "#salAccountVal" ).text( count + " Options selected" );
});

});

</script>
<style type="text/css">
<!--
-->
</style>
<style type="text/css">
/* Big box with list of options */

#ajax_listOfOptions {
	position: absolute;	/* Never change this one */
	width: 250px;	/* Width of box */
	height: 160px;	/* Height of box */
	overflow: auto;	/* Scrolling features */
	border: 1px solid #317082;	/* Dark green border */
	background-color: #FFF;	/* White background color */
	color: black;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	text-align: left;
	font-size: 10px;
	z-index: 50;
}
#ajax_listOfOptions div {	/* General rule for both .optionDiv and .optionDivSelected */
	margin: 1px;
	padding: 1px;
	cursor: pointer;
	font-size: 10px;
}
#ajax_listOfOptions .optionDivSelected { /* Selected item in the list */
	background-color: #2375CB;
	color: #FFF;
}
#ajax_listOfOptions_iframe {
	background-color: #F00;
	position: relative;
	z-index: 5;
}
form {
	display: inline;
}
.css_tool_tip {
	display: block;
}
.css_tool_tip a:hover {
	display: block;
	background: #FF0000;
	width: 100px;
	height: 25px;
}
/*.............tool tip by prabhat......*/
a.tooltip {
	outline: none;
}
a.tooltip:hover {
	text-decoration: none;
}
a.tooltip span {
	text-align: left;
	z-index: 10;
	display: none;
	padding: 5px;
	margin-top: -50px;
	width: 150px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
a.tooltip:hover span {
	display: inline;
	position: absolute;
	color: #111;
	border: 1px solid #DCA;
	background: #fffAF0;
}
.callout {
	z-index: 20;
	position: absolute;
	top: 30px;
	border: 0;
	left: -12px;
}
/*CSS3 extras*/
a.tooltip span {
	border-radius: 4px;
}
a.tooltiploan {
	outline: none;
}
a.tooltiploan:hover {
	text-decoration: none;
}
a.tooltiploan span {
	text-align: left;
	z-index: 10;
	display: none;
	padding: 5px;
	margin-top: -40px;
	width: 150px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
}
a.tooltiploan:hover span {
	display: inline;
	position: absolute;
	color: #111;
	border: 1px solid #DCA;
	background: #fffAF0;
}
.callout {
	z-index: 20;
	position: absolute;
	top: 30px;
	border: 0;
	left: -12px;
}
/*CSS3 extras*/
a.tooltiploan span {
	border-radius: 4px;
}
   
   /*...................end tool tip.......*/
</style>
<Script Language="JavaScript">
function cityother() { 	if(document. creditcard_form.City.value=="Others")	{	document.creditcard_form.City_Other.disabled = false;	}	else	{		document.creditcard_form.City_Other.disabled = true;	} } 

function ckhcreditcard(Form)
{
	var j;
	var l;
	var r;
	var cntr=-1;
	var cnt=-1;
	var cntl=-1;
	var cntlb=-1;
	var cntSa=-1;
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cit=document.creditcard_form.City.value;
	var sal=document.creditcard_form.Net_Salary.value;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
 		
	if(document.creditcard_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.creditcard_form.Net_Salary.focus();
		return false;
	}
	if (document.creditcard_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Enter Employment Status!</span>";
		document.creditcard_form.Employment_Status.focus();
		return false;
	}
	if (document.creditcard_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.creditcard_form.City.focus();
		return false;
	}
	
	if(document.creditcard_form.City.value=="Others")
	{
	
	if((document.creditcard_form.City.value=="Others") && ((document.creditcard_form.City_Other.value=="" || document.creditcard_form.City_Other.value=="Other City"  ) || !isNaN(document.creditcard_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.creditcard_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.creditcard_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.creditcard_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.creditcard_form.City_Other.focus();
  		return false;
  	}
  }
	}
	
	var saselect = document.getElementById('salary_account');
			 for(var Sa=0; Sa<saselect.options.length; Sa++) 
			{
				if(saselect.options[Sa].selected)
				{
					cntSa= Sa;
				}
			}
			if(cntSa == -1) 
			{
				alert("Salary or Cuurent account Bank!");	
				return false;
			}

	/*if (document.creditcard_form.salary_account.selectedIndex==0)
	{		
	  	document.getElementById('salAccountVal').innerHTML = "<span  class='hintanchor'>Select Salary Account!</span>";
   		document.creditcard_form.salary_account.focus();		return false;	
	}*/
   
	if((document.creditcard_form.Full_Name.value=="") || (Trim(document.creditcard_form.Full_Name.value))==false)
	{
        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";		
		document.creditcard_form.Full_Name.focus();
		return false;
	}

	if(document.creditcard_form.Full_Name.value!="")
	{
		if(containsdigit(document.creditcard_form.Full_Name.value)==true)
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";
			document.creditcard_form.Full_Name.focus();
			return false;
		}
	}
   for (var i = 0; i <document.creditcard_form.Full_Name.value.length; i++) 
   {
		if (iChars.indexOf(document.creditcard_form.Full_Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.creditcard_form.Full_Name.focus();
			return false;
		}
  }
  
  	if(document.creditcard_form.Phone.value=="")
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
		document.creditcard_form.Phone.focus();
		return false;
	}
	if(isNaN(document.creditcard_form.Phone.value)|| document.creditcard_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.creditcard_form.Phone.focus();
		return false;  
	}
	if (document.creditcard_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.creditcard_form.Phone.focus();
		return false;
	}
	if ((document.creditcard_form.Phone.value.charAt(0)!="9") && (document.creditcard_form.Phone.value.charAt(0)!="8") && (document.creditcard_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.creditcard_form.Phone.focus();
		return false;
	}
	
	if(document.creditcard_form.Email.value=="")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
	
	var str=document.creditcard_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.creditcard_form.Email.focus();
		return false;
	}
		
	if(document.creditcard_form.Age.value=="")
	{
		document.getElementById('AgeVal').innerHTML = "<span class='hintanchor'>Fill Day of Birth!</span>";
		document.creditcard_form.Age.focus();
		return false;
	}
		
	

	/*add validation for loan existing*/
	if(document.creditcard_form.Employment_Status.value==0)
	{
		 for(l=0; l<document.creditcard_form.Loan_Any_sel.length; l++) 
		{
			if(document.creditcard_form.Loan_Any_sel[l].checked)
			{
				cntl= l;
			}
		}
		if(cntl == -1) 
		{
			alert("Select Any Existing Loan or not!");	
			return false;
		}
		if(cntl ==0)
		{ 
			 for(r=0; r<document.creditcard_form.Loan_Any.length; r++) 
			{
				if(document.creditcard_form.Loan_Any[r].checked)
				{
					cntr= r;
				}
			}
			if(cntr == -1) 
			{
				alert("Type of Existing loan!");	
				return false;
			}
			var laselect = document.getElementById('loanbank_name');
			 for(var lb=0; lb<laselect.options.length; lb++) 
			{
				if(laselect.options[lb].selected)
				{
					cntlb= lb;
				}
			}
			if(cntlb == -1) 
			{
				alert("Bank of Existing Loan!");	
				return false;
			}

		}
	}
	else
	{
		if((document.creditcard_form.Company_Name.value=="") || (document.creditcard_form.Company_Name.value=="Type Slowly for Autofill")|| (Trim(document.creditcard_form.Company_Name.value))==false)
		{
			document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
			document.creditcard_form.Company_Name.focus();
			return false;
		}
		else if(document.creditcard_form.Company_Name.value.length < 3)
		{
			document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
			document.creditcard_form.Company_Name.focus();
			return false;
		}
	}
 for(j=0; j<document.creditcard_form.CC_Holder.length; j++) 
	{
        if(document.creditcard_form.CC_Holder[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		alert("Select Card holder or not!");	
		return false;
	}
	if(cnt ==0)
	{ 
		if(document.creditcard_form.No_of_Banks.selectedIndex==0)
		{
			document.getElementById('ccbnknmeVal').innerHTML = "<span  class='hintanchor'>Select card from which Bank!</span>";	
			document.creditcard_form.No_of_Banks.focus();
			return false;
		}
		if(document.creditcard_form.City.selectedIndex >0)
		{
	if((cit=="Bangalore" || cit=="Chennai" || cit=="Delhi" || cit=="Hyderabad" || cit=="Jaipur" || cit=="Kolkata" || cit=="Mumbai" || cit=="Pune" || cit=="Ahmedabad" || cit=="Chandigarh" || cit=="Indore" || cit=="Cochin" || cit=="Bhopal") && sal < 360000)
			{
		if(document.creditcard_form.Card_Vintage.selectedIndex==0)
		{
			document.getElementById('ccvintageVal').innerHTML = "<span  class='hintanchor'>Please select since how long you holding credit card.</span>";	
			document.creditcard_form.Card_Vintage.focus();
			return false;
		}
		if(document.creditcard_form.Credit_Limit.selectedIndex==0)
		{
			document.getElementById('cclimitVal').innerHTML = "<span  class='hintanchor'>Please select Card Credit Limit.</span>";	
			document.creditcard_form.Credit_Limit.focus();
			return false;
		}
			}
		}
		
	}
		
	if(!document.creditcard_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	
		document.creditcard_form.accept.focus();
		return false;
	}
}

function validateDiv(div)
{	var ni1 = document.getElementById(div);	ni1.innerHTML = ''; }
function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param){	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false;}

</script>
<script>
function fornValidate()
{
	if(document.creditcard_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.creditcard_form.Net_Salary.focus();
		return false;
	}
	if (document.creditcard_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Enter Employment Status!</span>";
		document.creditcard_form.Employment_Status.focus();
		return false;
	}
	if (document.creditcard_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.creditcard_form.City.focus();
		return false;
	}
	
	var saselect = document.getElementById('salary_account');
			 for(var Sa=0; Sa<saselect.options.length; Sa++) 
			{
				if(saselect.options[Sa].selected)
				{
					cntSa= Sa;
				}
			}
			if(cntSa == -1) 
			{
				alert("Salary or Cuurent account Bank!");	
				return false;
			}
	
}
</script>

<div class="cc-form-wrapper">
  <div class="cc_terms_box">
    <h2 class="text3" style=" color:#FFF; font-size:24px; text-transform:none; "><strong><? echo $subjectLine;?></strong></h2>
  </div>
  <div class="animmated-margin" id="getImageScroll"> </div>
  <div style="clear:both;"></div>
  <form  name="creditcard_form" id="creditcard_form" action="get_cc_eligiblebank_under.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
    <input type="hidden" name="Activate" id="Activate" >
    <input type="hidden" name="source" value="<? echo $retrivesource; ?>">
    <div style="clear:both;"></div>
    <div class="p-details"><strong>Professional Details</strong></div>
    <div style="clear:both;"></div>
    <div class="new-input-box14">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">Office Address </td>
        </tr>
        <tr>
          <td height="25"><input type="text" class="d4l-input" value="Line 1" name="OfficeAddress1"  onfocus="(this.value == 'Line 1') && (this.value = '')"
       onblur="(this.value == '') && (this.value = 'Line 1')" id="line1"  />
           </td>
        </tr>
      </table>
    </div>
    <div class="new-input-box14">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">Pin code</td>
        </tr>
        <tr>
          <td height="25"><input type="text" class="d4l-input" id="OfficePin" name="OfficePin" /></td>
        </tr>
      </table>
    </div>
        <div class="new-input-box14" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">Landline number </td>
        </tr>
        <tr>
          <td height="25"><select name="Land_linenumber" id="Land_linenumber" class="d4l-select" style="height:24px;" onchange="addothercity(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
		  <option value="">Please Select</option>
           <option value="Office">Office</option>
              <option value="Residence">Residence</option>
          </select></td>
        </tr>
      </table>
    </div>
    <div style="clear:both;"></div>
    <div class="new-input-box14">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">Office Address </td>
        </tr>
        <tr>
          <td height="25"><div id="cityVal">
            <input type="text" name="OfficeAddress2" value="Line 2"  class="d4l-input" onfocus="(this.value == 'Line 2') && (this.value = '')"
       onblur="(this.value == '') && (this.value = 'Line 2')" id="line2" />
          </div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box14">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">City</td>
        </tr>
        <tr>
          <td height="25"><div id="cityVal">
            <select name="OfficeCity" id="OfficeCity" class="d4l-select" style="height:24px;" onchange="addothercity(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
              <?=plgetCityList($City)?>
            </select>
          </div></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box14">
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">Number </td>
        </tr>
        <tr>
          <td height="25"><div id="cityVal">
            <input type="text" class="std"  name="STD" value="STD" onfocus="(this.value == 'STD') && (this.value = '')"   onblur="(this.value == '') && (this.value = 'STD')" id="STD"/>
            <input type="text" class="stdnumber" id="Phone_Number" name="Phone_Number" value="Number" onfocus="(this.value == 'Number') && (this.value = '')"   onblur="(this.value == '') && (this.value = 'Number')"/>
          </div></td>
        </tr>
      </table>
    </div>
    
    <div style="clear:both; height:5px;"></div>
    <div class="new-input-box14" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">Office Address </td>
        </tr>
        <tr>
          <td height="25"><input  type="text" class="d4l-input" name="OfficeAddress3" value="Line 3" onfocus="(this.value == 'Line 3') && (this.value = '')"
       onblur="(this.value == '') && (this.value = 'Line 3')" id="line3" /></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box14" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">State</td>
        </tr>
        <tr>
          <td height="25"><select name="OfficeState" id="OfficeState" class="d4l-select" style="height:24px;" onchange="addothercity(); addhdfclife(); validateDiv('cityVal');" tabindex="7">
		  <option value="">Please Select</option>
            <option value="AP">Andhra Pradesh</option>
			<option value="AR">Arunachal Pradesh</option>
			<option value="AS">Assam</option>
			<option value="BR">Bihar</option>
			<option value="CT">Chhattisgarh</option>
			<option value="GA">Goa</option>
			<option value="GJ">Gujarat</option>
			<option value="HR">Haryana</option>
			<option value="HP">Himachal Pradesh</option>
			<option value="JK">Jammu and Kashmir</option>
			<option value="JH">Jharkhand</option>
			<option value="KA">Karnataka</option>
			<option value="KL">Kerala</option>
			<option value="MP">Madhya Pradesh</option>
			<option value="MH">Maharashtra</option>
			<option value="MN">Manipur</option>
			<option value="ML">Meghalaya</option>
			<option value="MZ">Mizoram</option>
			<option value="NL">Nagaland</option>
			<option value="OR">Odisha</option>
			<option value="PB">Punjab</option>
			<option value="RJ">Rajasthan</option>
			<option value="SK">Sikkim</option>
			<option value="TN">Tamil Nadu</option>
			<option value="TG">Telangana</option>
			<option value="TR">Tripura</option>
			<option value="UP">Uttar Pradesh</option>
			<option value="UT">Uttarakhand</option>
			<option value="WB">West Bengal</option>
          </select></td>
        </tr>
      </table>
    </div>
    <div class="new-input-box14" >
      <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="25" class="cc-form-text">Qualification </td>
        </tr>
        <tr>
          <td height="25"><select name="Qualification" id="Qualification" class="d4l-select">
			<option value="">Please Select</option>
            <option  value="10 or below">Metric or below</option>
            <option value="Plus 2 or below">Higher secondary </option>
            <option value="Graduate">Graduation</option>
            <option value="Post graduate">Postgraduate and above</option>
          </select></td>
        </tr>
      </table>
    </div>
      
    <div style="clear:both; height:5px;"></div>
    
    <div id="Othercity"> </div>
    <div style="clear:both; height:5px;"></div>
    <div >
      <table border="0" cellpadding="0" width="94%" align="right">
        <tr>
          <td style="padding-left:25px;" align="right"><input type="submit" class="cc-get-quotebtn" value="Get Quote" style="float:none;" onclick="return fornValidate();" /></td>
        </tr>
      </table>
    </div>
    <div id="addSubmit"></div>
  </form>
  <div style="clear:both; height:10px;"></div>
  
</div>