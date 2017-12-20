<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-list-clhdfc.js"></script>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
 
-->
</style>
<style type="text/css">
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>
<Script Language="JavaScript">
function cityother()
{
	if(document. creditcard_form.City.value=="Others")
	{
		document.creditcard_form.City_Other.disabled = false;
	}
	else
	{
		document.creditcard_form.City_Other.disabled = true;
	}
} 

function ckhcreditcard(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
 
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
		
	if(document.creditcard_form.day.value=="" || document.creditcard_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.creditcard_form.day.focus();
		return false;
	}
	if(document.creditcard_form.day.value!="")
	{
		if((document.creditcard_form.day.value<1) || (document.creditcard_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.creditcard_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.creditcard_form.day, 'Day', 2))
		return false;
	
	if(document.creditcard_form.month.value=="" || document.creditcard_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.creditcard_form.month.focus();
		return false;
	}
	if(document.creditcard_form.month.value!="")
	{
		if((document.creditcard_form.month.value<1) || (document.creditcard_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.creditcard_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.creditcard_form.month, 'month', 2))
		return false;

	if(document.creditcard_form.year.value=="" || document.creditcard_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.creditcard_form.year.focus();
		return false;
	}
	if(document.creditcard_form.year.value!="")
	{
		if((document.creditcard_form.year.value < "<?php echo $maxage;?>") || (document.creditcard_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.creditcard_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.creditcard_form.year, 'Year', 4))
		return false;
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
		
	if (document.creditcard_form.City.selectedIndex==0)
	{
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
		document.creditcard_form.City.focus();
		return false;
	}
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
  
	if (document.creditcard_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.creditcard_form.Pincode.focus();
		return false;
	}
	if (document.creditcard_form.Pincode.value!="")
	{
		if(document.creditcard_form.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.creditcard_form.Pincode.focus();
			return false;
		}
	}
  

if((document.creditcard_form.Company_Name.value=="") || (document.creditcard_form.Company_Name.value=="Company Name")|| (Trim(document.creditcard_form.Company_Name.value))==false)
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

  if (document.creditcard_form.Employment_Status.selectedIndex==0)
	{
		alert("Please enter Employment Status to Continue");
		document.creditcard_form.Employment_Status.focus();
		return false;
	}
		
	if(document.creditcard_form.Net_Salary.value=="")
	{
		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	
		document.creditcard_form.Net_Salary.focus();
		return false;
	}

		
	if(!document.creditcard_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms and Condition!</span>";	
		document.creditcard_form.accept.focus();
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


function addElement()
{
		var ni = document.getElementById('myDiv');
		
			//alert(document.creditcard_form.CC_Holder.value);
				ni.innerHTML = '<div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:15px;">                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Bank Name: </div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select size="1" name="No_of_Banks" id="No_of_Banks" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><option value="0">Please select</option> <option value="HDFC Bank">HDFC Bank</option> <option value="Standard Chartered">Standard Chartered</option> <option value="Kotak Bank">Kotak Bank</option><option value="Other">Other</option></select></div></div>';
		
		
		
		return true;
	}

function removeElement()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
			if(document.creditcard_form.CC_Holder.value="0")
			{
				ni.innerHTML = '';
			}
		}
		
		return true;

	}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.creditcard_form.City.value;
	var otrcit = document.creditcard_form.City_Other.value;
	//alert(cit);	
	if(cit =="Ahmedabad" || otrcit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}
</script>
<div style="float:right; clear:right;  width:290px; height:auto; margin-top:18px;">
<div class="text3" style="width:290px; margin:auto; height:auto; font-size:11px; color:#88a943; margin-top:0px;">
<form name="creditcard_form"  action="get_cc_eligiblebank.php" method="POST" onSubmit="return ckhcreditcard(document.creditcard_form); ">
<input type="hidden" name="source" value="<? echo $newsource; ?>">
<input type="hidden" name="PostURL" value="/get_cc_eligiblebank.php">
<table width="290" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="10" align="left" valign="top"><img src="images/bgtop.jpg" width="290" height="10" /></td>
</tr>
<tr>
	<td align="left" valign="top" bgcolor="#21405F"><table border="0" cellpadding="0" cellspacing="0">
<tr>
	<td width="28" align="left" valign="top">&nbsp;</td>
	<td  align="left" valign="top" width="279">
		<table width="285" border="0" cellpadding="3" cellspacing="3">
		<tr>
			<td align="left" valign="top" colspan="2" style=" color:#FFF; font-size:15px;  text-align:center; height:30; ">
				<strong>Select best Credit Card</strong>			</td>
		</tr>
        <tr>
			<td align="left" valign="top" colspan="2" style=" color:#FFF; font-size:11px; height:30; text-transform:capitalize; ">
 Annual Fee from Rs 0-5000<span style="color:#FF0000; font-weight:bold;">*</span> <br /> Cashback &  Reward Offers<span style="color:#FF0000; font-weight:bold;">*</span><br /> Free Airlines tickets on Usage<span style="color:#FF0000; font-weight:bold;">*</span>
 <hr style="color:#CCCCCC;" />
 </td>
		</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
Full Name</td><td width="161" class="text" style="  color:#FFF; font-size:11px;  " height="23">
<input name="Full_Name" id="Full_Name" type="text" style="width:150px; height:22px;" onKeyDown="validateDiv('nameVal');" tabindex="1" />
<div id="nameVal"></div>    
</td>
</tr>
<tr>
<td width="99" height="23" class="text" style="  color:#FFF; font-size:11px; ">
Mobile</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
+91 
<input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" style="width:128px; height:22px;" onkeydown="validateDiv('phoneVal');" tabindex="2"  />
            <div id="phoneVal"></div>    
</td>
</tr>
<tr>
<td width="99" height="23" class="text" style="  color:#FFF; font-size:11px; ">
Email ID </td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
<input name="Email" id="Email" type="text" style="width:150px; height:22px;" onkeydown="validateDiv('emailVal');" tabindex="3"  />
          <div id="emailVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
City</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
    <select name="City" id="City" style="width:150px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" onchange="cityother(); addhdfclife(); validateDiv('cityVal');" tabindex="4">
                            <? //=plgetCityList($City)?>
                        </select>
                         <div id="cityVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
City</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
    <input name="City_Other" id="City_Other" type="text" style="width:150px; height:22px;" disabled onKeyUp="searchSuggest();" onkeydown="validateDiv('othercityVal');"  tabindex="5" />
                        <div id="othercityVal"></div>   
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
Pincode</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
    <input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" type="text" style="width:150px; height:22px;" tabindex="6" />
         <div id="pincodeVal"></div>
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
DOB</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
   <div class="text" style=" float:left; clear:right; padding-right:6px;">
        <input name="day" id="day" type="text" style="width:42px; height:22px;" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="7" />
        </div>
      <div class="text" style=" float:left; clear:right; padding-right:6px;">
		<input name="month" id="month" type="text" style="width:42px; height:22px;" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="8" />
      </div>
      <div class="text" style=" float:left; clear:right;">
	<input name="year" id="year" type="text" style="width:52px; height:22px;" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="9" />
      </div>
         <div id="dobVal"></div>
</td>
</tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
Occupation</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
    <select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');"  style="width:150px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" tabindex="10" >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                     </select>
                       <div id="empStatusVal"></div>
</td>
</tr>

<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="  color:#FFF; font-size:11px; ">
Company Name</td>
<td width="161" class="text" style="  color:#FFF; font-size:11px;  ">
      <input name="Company_Name" id="Company_Name" type="text"  style="width:150px; height:22px;" onkeydown="validateDiv('companyNameVal');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" tabindex="11" />
                        <div id="companyNameVal"></div>
</td>
</tr>

<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;">
Annual Income</td>
<td width="161" class="text" style="color:#FFF; font-size:11px;  ">
  <input type="text" name="Net_Salary" id="Net_Salary" style="width:150px; height:22px;"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');"  tabindex="12" />
 <div id="netSalaryVal"></div>  
</td>
</tr>
<tr><td colspan="2"> <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
<tr>
<td width="99" height="23" align="left" valign="top" class="text" style="color:#FFF; font-size:11px;  padding-right:2px;">
Credit Card Holder?</td>
<td width="161" class="text" style="color:#FFF; font-size:11px;  ">
  <div style=" float:left; width:15px; height:auto; clear:right; margin-left:0px; margin-top:5px; ">
                  <input type="radio" value="1" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="addElement();" tabindex="13">
                    </div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:8px; margin-top:8px; "> Yes</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:13px; margin-top:5px; ">
                     <input type="radio" value="2" name="CC_Holder" id="CC_Holder" style="border:none;" checked onClick="removeElement();" tabindex="14">
                    </div>
                    <div style=" float:left; width:10px; height:auto; clear:right; margin-left:5px; margin-top:8px; "> No</div>
                     <div id="ccholderVal"></div>   
</td>
</tr>
<tr><td colspan="2"> <span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
<tr>
<tr>
<td align="left" valign="top" colspan="2" class="text9" style=" color:#FFF; font-size:8px; margin-top:0px; ">
  <input name="accept" type="checkbox" onclick="validateDiv('acceptVal');" tabindex="15"/>  
     I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style="font-size:8px;  color:#88a943; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" class="text" style=" color:#88a943; font-size:8px; text-decoration:underline;">Terms and Conditions</a> of deal4loans.com.
     <div id="acceptVal"></div>
</td>
</tr>
<tr>
<td>&nbsp;</td><td  align="center" valign="top"  style= "margin-left:0px;">
<input type="submit" style="border: 0px none ; background-image: url(images/get_quot.jpg); width: 94px; height: 27px; margin-bottom: 0px;" value="" tabindex="16"/>
</td>
</tr> 
<tr>
<td align="left" valign="top" colspan="2" class="text9" style=" color:#FFF; font-size:9px; margin-top:0px; text-transform:capitalize;">
<span style="color:#FF0000; font-weight:bold;">*</span> All Credit Cards and offers on sole discretion of banks.
</td>
</tr> 
</table>
        </td>
</tr>
</table></td>
</tr>
<tr>
<td height="15" align="left" valign="top"><img src="images/bgbottom.jpg" width="290" height="10" /></td>
</tr>
</table>
</form>
</div>
</div>