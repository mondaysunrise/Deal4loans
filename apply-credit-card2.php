<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	if(strlen($_REQUEST['source'])>0){	$retrivesource=$_REQUEST['source'];} else {	$retrivesource="CC Site Page"; }
	$maxage=date('Y')-62;
	$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply Credit Cards Online | Online Credit card Apply Application</title>
<meta name="keywords" content="Credit cards, online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application">
<meta name="description" content="Online Credit Card Apply?? Compare Credit cards and apply for Various Banks such as SBI, HDFC, ICICI, Citibank, Standard Chartered and Many more.">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-list-clhdfc.js"></script>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<link href="source.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.crdtext ul li {
	background: url(../new-images/bt-arrow.gif) no-repeat 5px 5px !important;
	list-style-type:none; 
	padding-left:12px; 
	margin-right:5px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:15px;
	text-align:left;
	color: #492704;
}
ul li{
	list-style-type:none; 
	padding-left:15px; 
	padding-right:0; 
	padding-top:0; 
	padding-bottom:4px 
}
.crdtext  ul {
	margin:2px 0px 0px 0px;
	padding:2px 0px 0px 0px;
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
function cityother() { 	if(document. creditcard_form.City.value=="Others")	{	document.creditcard_form.City_Other.disabled = false;	}	else	{		document.creditcard_form.City_Other.disabled = true;	} } 
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
{        document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name</span>";				document.creditcard_form.Full_Name.focus();		return false;	}
if(document.creditcard_form.Full_Name.value!="")
{
	if(containsdigit(document.creditcard_form.Full_Name.value)==true)
	{			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";			document.creditcard_form.Full_Name.focus();			return false;		}
}
   for (var i = 0; i <document.creditcard_form.Full_Name.value.length; i++) 
   {
		if (iChars.indexOf(document.creditcard_form.Full_Name.value.charAt(i)) != -1) 
		{			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";			document.creditcard_form.Full_Name.focus();			return false;		}
  }
	if(document.creditcard_form.day.value=="" || document.creditcard_form.day.value=="dd")
	{		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";		document.creditcard_form.day.focus();		return false;	}
	if(document.creditcard_form.day.value!="")
	{
		if((document.creditcard_form.day.value<1) || (document.creditcard_form.day.value>31))
		{			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";			document.creditcard_form.day.focus();			return false;		}
	}
	if(!checkData(document.creditcard_form.day, 'Day', 2))
		return false;
	
	if(document.creditcard_form.month.value=="" || document.creditcard_form.month.value=="mm")
	{		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";		document.creditcard_form.month.focus();		return false;	}
	if(document.creditcard_form.month.value!="")
	{
		if((document.creditcard_form.month.value<1) || (document.creditcard_form.month.value>12))
		{			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";			document.creditcard_form.month.focus();			return false;		}
	}
	if(!checkData(document.creditcard_form.month, 'month', 2))
		return false;

	if(document.creditcard_form.year.value=="" || document.creditcard_form.year.value=="yyyy")
	{		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";		document.creditcard_form.year.focus();		return false;	}
	if(document.creditcard_form.year.value!="")
	{
		if((document.creditcard_form.year.value < "<?php echo $maxage;?>") || (document.creditcard_form.year.value >"<?php echo $minage;?>"))
		{			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";			document.creditcard_form.year.focus();			return false;		}
	}
	if(!checkData(document.creditcard_form.year, 'Year', 4))
		return false;
	if(document.creditcard_form.Phone.value=="")
	{		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";		document.creditcard_form.Phone.focus();		return false;	}
	if(isNaN(document.creditcard_form.Phone.value)|| document.creditcard_form.Phone.value.indexOf(" ")!=-1)
	{		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";		document.creditcard_form.Phone.focus();		return false;  	}
	if (document.creditcard_form.Phone.value.length < 10 )
	{	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";			document.creditcard_form.Phone.focus();		return false;	}
	if ((document.creditcard_form.Phone.value.charAt(0)!="9") && (document.creditcard_form.Phone.value.charAt(0)!="8") && (document.creditcard_form.Phone.value.charAt(0)!="7"))
	{	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";			document.creditcard_form.Phone.focus();		return false;	}
	if(document.creditcard_form.Email.value=="")
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";			document.creditcard_form.Email.focus();		return false;	}
	var str=document.creditcard_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";			document.creditcard_form.Email.focus();		return false;	}
	else if(bb==-1)
	{		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";			document.creditcard_form.Email.focus();		return false;	}
	if (document.creditcard_form.City.selectedIndex==0)
	{		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";			document.creditcard_form.City.focus();		return false;	}
	if((document.creditcard_form.City.value=="Others") && ((document.creditcard_form.City_Other.value=="" || document.creditcard_form.City_Other.value=="Other City"  ) || !isNaN(document.creditcard_form.City_Other.value)))
	{		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";				document.creditcard_form.City_Other.focus();		return false;	}
	for (var i = 0; i <document.creditcard_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.creditcard_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.creditcard_form.City_Other.focus();
  		return false;
  	}
  }
	if (document.creditcard_form.Pincode.value=="")
	{		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";			document.creditcard_form.Pincode.focus();		return false;	}
	if (document.creditcard_form.Pincode.value!="")
	{
		if(document.creditcard_form.Pincode.value.length < 6)
		{			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";				document.creditcard_form.Pincode.focus();			return false;		}
	}
if((document.creditcard_form.Company_Name.value=="") || (document.creditcard_form.Company_Name.value=="Company Name")|| (Trim(document.creditcard_form.Company_Name.value))==false)
	{		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";			document.creditcard_form.Company_Name.focus();		return false;	}
	else if(document.creditcard_form.Company_Name.value.length < 3)
	{
		document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
		document.creditcard_form.Company_Name.focus();
		return false;
	}

  if (document.creditcard_form.Employment_Status.selectedIndex==0)
	{		alert("Please enter Employment Status to Continue");		document.creditcard_form.Employment_Status.focus();		return false;	}
		
	if(document.creditcard_form.Net_Salary.value=="")
	{		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";			document.creditcard_form.Net_Salary.focus();		return false;	}
	if(!document.creditcard_form.accept.checked)
	{		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Accept Terms and Condition!</span>";			document.creditcard_form.accept.focus();		return false;	}
}  
function validateDiv(div)
{	var ni1 = document.getElementById(div);	ni1.innerHTML = ''; }
function onFocusBlank(element,defaultVal){	if(element.value==defaultVal){		element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){		element.value = defaultVal;	} }
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function containsdigit(param){	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false;}
function addElement()
{
		var ni = document.getElementById('myDiv');
		ni.innerHTML = '<div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:15px;">                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Bank Name: </div><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select size="1" name="No_of_Banks" id="No_of_Banks" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><option value="0">Please select</option> <option value="HDFC Bank">HDFC Bank</option> <option value="Standard Chartered">Standard Chartered</option> <option value="Kotak Bank">Kotak Bank</option><option value="Other">Other</option></select></div></div>';
		return true;
	}
function removeElement()
{
	var ni = document.getElementById('myDiv');
	if(ni.innerHTML!="")
	{
		if(document.creditcard_form.CC_Holder.value="0")
		{				ni.innerHTML = '';			}
	}
	return true;
}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.creditcard_form.City.value;
	var otrcit = document.creditcard_form.City_Other.value;
	ni1.innerHTML = '';
	if(cit =="Ahmedabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Bhubaneshwar" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Delhi" || cit =="Faridabad" || cit =="Gaziabad" || otrcit =="Greater Noida" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Hyderabad" || cit =="Indore" || cit =="Jaipur" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Noida" || cit =="Pune" || cit =="Sahibabad" ||
cit =="Surat" || cit =="Thane" || cit =="Vadodara" || cit =="Vijaywada" || cit =="Vishakapatanam" || cit =="Vizag" )
	{
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#ffffff; font-weight:normal; "> I would like to avail of <b>FREE </b>financial planning services by <b>Insurance & Investment experts</b> from HDFC Life.</td>		 </tr>	 </table>';	
	}
	else
	{
	ni1.innerHTML = '';
		/*ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " colspan="2"> You are now a step closer to selecting the right Card for yourself! All you need is a complete picture of all your finances from MyUniverse!. <br><b>30 days free trial of MyUniverse</b></td></tr> <tr><td width="21"><input type="radio" name="adty_brl" id="adty_brl" value="1" checked/></td><td style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " width="611">Yes, Please register me in MyUniverse</td></tr><tr><td width="21"><input type="radio" name="adty_brl" id="adty_brl" value="2"/></td><td style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " width="611">No, Thank you</td></tr>	 </table>';*/
	}
	return true;
}
</script>
</head>
<body >
<?php include "top-menu.php";  include "main-menu.php"; ?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span  class="text12" style="color:#4c4c4c;">> Apply Credit Card</span></div>
<div class="intrl_txt">
<div style="clear:both; height:15px;"></div>
<form  name="creditcard_form" id="creditcard_form" action="get_cc_eligiblebank.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="source" value="<? echo $retrivesource; ?>">
<table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="14" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="14" /></td>
      </tr>
      <tr>
        <td height="55" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24">&nbsp;</td>
            <td width="735"><div class="text3" style=" color:#FFF; font-size:24px; text-transform:none; "><strong>Apply Credit Card</strong></div></td>            <td width="196" rowspan="2" valign="top">&nbsp;</td>          </tr>
           <tr>            <td>&nbsp;</td>            <td><span class="text3" style="float:left; width:575px; font-size:24px; color:#FFF; text-transform:none; margin-top:11px"><img src="images/animated_cc.gif"  /></span></td>          </tr>
          </table></td>
      </tr>
      <tr>
        <td  align="center" valign="top" bgcolor="#21405F"><table width="943" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="25" rowspan="2" align="left" valign="top">&nbsp;</td>
            <td width="201" align="left" valign="top"><table width="201" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="201" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Full Name:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                        <input name="Full_Name" id="Full_Name" type="text" style="width:180px; height:18px;" onkeydown="validateDiv('nameVal');" />
   <div id="nameVal"></div>   
                      </div>
                  </div></td>
                </tr>
                <tr>
                  <td height="55" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                        <div class="text" style=" float:left; clear:right;">
                        <input name="day" id="day" type="text" style="width:43px; height:18px;" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" />&nbsp;&nbsp;
                        </div>
                      <div class="text" style=" float:left; clear:right;">
                        <input name="month" id="month" type="text" style="width:43px; height:18px;" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" />&nbsp;&nbsp;
                        </div>
                      <div class="text" style=" float:left; clear:right;">
                        	<input name="year" id="year" type="text" style="width:60px; height:18px;" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" />
                        </div>
                           <div id="dobVal"></div>   
                    </div>
                  </div></td>
                </tr>
                <tr>
                  <td height="58"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Mobile:</span></div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                        <div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; margin-top:3px; "> +91</div>
                      <div class="text" style=" float:left; width:26px; height:auto; color:#FFF; font-size:12px; text-transform:none; clear:right; ">
                        <input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" style="width:153px; height:18px;" onkeydown="validateDiv('phoneVal');"  />
            <div id="phoneVal"></div>  
                        </div>
                    </div>
                  </div></td>
                </tr>
               
            </table></td>
            <td width="26" align="left" valign="top">&nbsp;</td>
            <td width="185" align="left" valign="top"><table width="185" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="192" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">City:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">                   <select name="City" id="City" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="cityother(); addhdfclife(); insertData(); validateDiv('cityVal');" tabindex="7">
                            <?=plgetCityList($City)?>
                 
                        </select>
                         <div id="cityVal"></div>   
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                       <input name="City_Other" id="City_Other" type="text" style="width:180px; height:18px;" disabled onKeyUp="searchSuggest();" onkeydown="validateDiv('othercityVal');"  />
                        <div id="othercityVal"></div>   
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="58"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Email ID :</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                  <input name="Email" id="Email" type="text" style="width:180px; height:18px;" onkeydown="validateDiv('emailVal');"  />
          <div id="emailVal"></div> 
                    </div>
                </div></td>
              </tr>
              
            </table></td>
            <td width="50" align="left" valign="top">&nbsp;</td>
            <td width="186" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
             
              <tr>
                <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                 <select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');"  style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                     </select>
                       <div id="empStatusVal"></div>
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="58"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Company Name: </span></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                   <input name="Company_Name" id="Company_Name" type="text"  style="width:180px; height:18px;" onkeydown="validateDiv('companyNameVal');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" />
                        <div id="companyNameVal"></div>
                    </div>
                </div></td>
              </tr>
                   <tr>
                  <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Annual Income:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                       <input type="text" name="Net_Salary" id="Net_Salary" style="width:180px; height:18px;"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');"  />
              
        <div id="netSalaryVal"></div>   
                      </div>
                  </div>  <span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
                </tr>
           
            </table></td>
            <td width="56" align="left" valign="top">&nbsp;</td>
            <td width="214" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pincode:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                  <input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" type="text" style="width:180px; height:18px;" />
     <div id="pincodeVal"></div>
                      </div>
                  </div><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
                </tr>
                 <tr>
                <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:17px;">
                    <div style=" float:left; width:70px; height:auto; clear:right; ">Credit Card Holder?</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:0px; margin-top:5px; ">
                  <input type="radio" value="1" name="CC_Holder" id="CC_Holder" style="border:none;" onClick="addElement();">
                    </div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:8px; margin-top:8px; "> Yes</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:13px; margin-top:5px; ">
                     <input type="radio" value="2" name="CC_Holder" id="CC_Holder" style="border:none;" checked onClick="removeElement();">
                    </div>
                    <div style=" float:left; width:10px; height:auto; clear:right; margin-left:5px; margin-top:8px; "> No</div>
                     <div id="ccholderVal"></div>   
                  </div>
                </div></td>
              </tr>
              <tr>
                <td height="58" id="myDiv" align="left" valign="top">
                </td>
              </tr>
                                       
            </table></td>
          </tr>
          <tr>
            <td height="40" colspan="7" align="left" valign="top"><table width="923" border="0" cellspacing="0" cellpadding="0">
              <tr>
               
                <td width="792" align="left" valign="top"><div class="text" style=" float:left; width:790px; height:auto; color:#FFF; font-size:11px; text-transform:none; margin-top:5px;">
                                 <input name="accept" type="checkbox" checked="checked" /> I authorize Deal4loans.com &amp; its partnering banks to contact me to explain the product &amp; I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.
                </div></td>
                <td width="131" align="right" valign="top"><div style=" float:right; width:114px; height:47px; margin-top:0px; margin-left:0px; margin-right:23px;">  <input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></td>
              </tr>
              <tr>
              
                <td align="left" valign="top" colspan="2">
                <div id="hdfclife"></div>
                </td></tr>
            </table>              </td>
            </tr>
            
        </table></td>
      </tr>
      <tr>
        <td height="14" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="14" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
<br />
</form>
<div style="clear:both; ">
  <table width="970" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">Standard Chartered <br />
              Platinum Rewards Card </td>
          </tr>
          <tr>
            <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/stanc_palitinum.jpg" width="150" height="94"/></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>Fee- Nil</li>
              <br />
            </ul></td>
          </tr>
          <tr> </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>3.10%</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>5 points on every 100 spent on dining, hotels and fuel</li>
              <li>base rewards: of 2 points per 100 spent across other categories </li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Other Features</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" ><ul>
                <li>Visa Platinum offers across movies, dining and travel</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>Nil</li>
            </ul></td>
          </tr>
      </table></td>
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">HDFC Bank Gold Card </td>
          </tr>
          <tr>
            <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/hdfc-gold-crd.jpg" width="150" height="94" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>Fee-Rs 199</li>
              <li>No Fee-If you spend more than 5000 in first three month.</li>
            </ul></td>
          </tr>
          <tr> </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>3.25%</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>1 Reward Point per Rs.150 spent</li>
              <li>50% more Reward Points on incremental spends above Rs. 20,000 per statement cycle</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Other Features</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" ><ul>
                <li><b>Revolving Credit Facility </b><br />
                  Pay a minimum Amount, which is 5% of your total bill amount or any higher amount whichever is convenient and carry forward the balance to a better financial month.  + Free add-on cards + Zero liability on lost card.</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" ><ul>
                <li>Nil</li>
            </ul></td>
          </tr>
      </table></td>
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">HDFC Bank <br />
              Solitaire Women's Card </td>
          </tr>
          <tr>
            <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/hdfc_solitaire_crd.jpg" width="156" height="102"/></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>Fee- 999</li>
              <br />
            </ul></td>
          </tr>
          <tr> </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>3.15%</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>3 Reward Points per Rs. 150</li>
              <li>50% additional Reward Points on Grocery & dining spends</li>
              <li>1000 Reward Point benefits on card Renewal </li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Other Features</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" ><ul>
                <li>One-time free Wellness package from Thyrocare</li>
              <li>Reward Point redemption across Multiple domestic airlines</li>
              <li>Get a shopping voucher from Shoppers Stop worth Rs. 1000 on cumulative spends of Rs. 75,000 every six months</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" ><ul>
                <li>Fuel surcharge waiver of 2.5% across any petrol pump in India </li>
            </ul></td>
          </tr>
      </table></td>
      <td valign="top"  class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">American Express<br /> Platinum Travel Credit Card</td>
          </tr>
         <tr>
          <td align="center" valign="bottom" style="padding-top:10px;"><input name="image25" type="image" style="background-image:url(/new-images/amex_plttrvlcrd_160x600.jpg); background-repeat:no-repeat; width:160px; height:600px; border:none; outline:none;" src="/new-images/amex_plttrvlcrd_160x600.jpg"onclick="javascript:window.open('http://americanexpressindia.co.in/platinumTravel.aspx?siteid=Deal4loanPlatinumTravelCard&adunit=160x600&banner=160x600_Sept&campaign=PlatinumTravelCard&marketingagency=interactive')" />
           </td>
         </tr>
         
      </table></td>
    </tr>
    <tr>
     
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">HDFC Bank <br />
              Superia Credit Card</td>
          </tr>
          <tr>
            <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/hdfc-superia-crd.jpg" width="139" height="91" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>Fee- 3499</li>
              <br />
            </ul></td>
          </tr>
          <tr> </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>3.05%</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>Welcome Benefit of 3500 Points + Renewal Benefit of 1,000 points</li>
              <li>3 Points per Rs.150 spent + 50% more Reward Points on Dining spends </li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Other Features</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" ><ul>
                <li>Reward Points redemption against airlines tickets booked</li>
              <li>zero liability on any fraudulent transactions on your card</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" height="132"><ul>
                <li>No fuel surcharge on fuel purchase between Rs.400 - Rs5000 across all fuel stations. </li>
            </ul></td>
          </tr>
      </table></td>
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">HDFC Bank <br />
              Platinum Plus Credit Card </td>
          </tr>
          <tr>
            <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/hdfc_plt_plus.jpg" width="150" height="94"/></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>Fee-Rs 399</li><br />
            </ul></td>
          </tr>
          <tr> </tr>
        <tr>
            <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
        </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>3.15%</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>2 Reward Points per Rs.150 spent</li>
              <li>50% more Reward Points on incremental spends above Rs.50,000 per statement cycle</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Other Features</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" ><ul>
                <li> Revolving Credit facility + Free add-on cards + Zero liability on lost card</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" height="161"><ul>
                <li>Fuel surcharge waiver of 2.5% across any petrol pump in India </li>
            </ul></td>
          </tr>
      </table></td>
	   <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">Standard Chartered <br />
              Manhattan Platinum Card</td>
          </tr>
          <tr>
            <td height="135" align="center" ><img src="/new-images/manhattanplatinum-card.png" width="120" height="75" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>Fee- 999</li>
              <br />
            </ul></td>
          </tr>
          <tr> </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>3.10%</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>5 points per 100 spent on all your other purchases </li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Other Features</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" ><ul>
                <li>5% Cashback on all supermarket and department store spends</li>
              <li>Visa Platinum offers across movies, dining and travel</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>Nil </li>
            </ul></td>
          </tr>
      </table></td>
	   <td valign="top"  class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">Standard Chartered <br />
              Super Value Titanium Card</td>
          </tr>
          <tr>
            <td height="135" align="center"  ><img src="http://www.deal4loans.com/new-images/supervalue-titanium-card.png" width="120" height="75" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>Fee- 750</li>
              <br />
            </ul></td>
          </tr>
          <tr> </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>3.10%</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Reward Points</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext"><ul>
                <li>Nil</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Other Features</td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" ><ul>
                <li>5% Cashback on all fuel spends at any petrol pump</li>
              <li>5% Cashback on mobile and telephone bills</li>
              <li>5% Cashback on utility bill payments</li>
            </ul></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
          </tr>
          <tr>
            <td valign="top" class="crdtext" height="177"><ul>
                <li>2.5% surcharge reversal on all petrol pumps </li>
            </ul></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
 

<div style="clear:both; height:15px;"></div>
<div style="clear:both; height:20px; width:964px; margin:auto; margin-top:10px;"><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></div></div>
<?php include "footer1.php"; ?>

</body>
</html>
