<? 
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/hdfccl-style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
 <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-stages.js"></script>
  <script>
$(function() {
$("#car_name").keyup(function(){
	//alert("hello");
 $.post("jquery_carlist.php",
  {
    car_name: $("#car_name").val()
    },
  function(data,status){
		var temp = new Array();
temp = data.split(",");
//var availableTag = [data];
  $( "#car_name" ).autocomplete({
            source: temp
        });
  });
});
});

</script>
 <style type="text/css">
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
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

	display:inline;
	}
	
</style>
<script>
$(function() {
$("#plz_show_price").mouseover(function(){
	//alert("hello");
 $.post("get-car-price.php",
  {
    car_name: $("#car_name").val(),
    city:'Others'
  },
  function(data,status){
   // alert("Data: " + data + "\nStatus: " + status);
	 $('#car_price_pop').html(data);
  });
});
});

$(function() {
$("#Net_Salary").focus(function(){
	//alert("hello");
 $.post("get-car-price.php",
  {
    car_name: $("#car_name").val(),
    city:'Others'
  },
  function(data,status){
   // alert("Data: " + data + "\nStatus: " + status);
	 $('#car_price_pop').html(data);
  });
});
});

$(function() {
$("#show_rumprice").mouseover(function(){
	//alert("hello");
 $.post("get-car-price.php",
  {
    car_name: $("#car_name").val(),
    city:'Others'
  },
  function(data,status){
   // alert("Data: " + data + "\nStatus: " + status);
	 $('#car_price_pop').html(data);
  });
});
});
</script>
<script>

function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";

	}
}

function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")	{	alert("Invalid E-mail ID.");	return false;		}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 	{	return false;	}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 	{	alert("Invalid E-mail ID.");	return false;	}
	if (email1.indexOf("@",atPos+1) != -1) 	{ 	alert("Invalid E-mail ID.");	return false;	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 	{ 	alert("Invalid E-mail ID.");	return false;	}
	if (periodPos+3 > email1.length)		{		alert("Invalid E-mail ID.");	return false;	}
	return true;
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
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

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}

function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if((Form.car_name.value=="") || Form.car_name.value=="Type slowly for autofill")
	{
		alert("Kindly enter Name of car you want!");	
		Form.car_name.focus();
		return false;
	}

if(Form.Net_Salary.value=="" || Form.Net_Salary.value=="0")
	{
		alert('Please enter Annual income to Continue');
		Form.Net_Salary.focus();
		return false;
	}
	if(Form.Company_Name.value=="" || Form.Company_Name.value=="Type slowly for autofill")
	{
		alert("Please enter Company Name to Continue");
		Form.Company_Name.focus();
		return false;
	}

	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
	{
		alert("Kindly fill in your Name!");
		Form.Name.select();
		return false;
	}
	else if(containsdigit(Form.Name.value)==true)
	{
		alert("Name contains numbers!");
		Form.Name.select();
		return false;
	}
	for (var i = 0; i < Form.Name.value.length; i++) {
		if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
			alert ("Name has special characters.\n Please remove them and try again.");
			Form.Name.select();
			return false;
		}
	  }
	
	if(Form.Phone.value=="")
	{
		alert("Please Enter Mobile Number");
		Form.Phone.focus();
		return false;
	}

	if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
	{
		  alert("Enter numeric value");
		  Form.Phone.focus();
		  return false;  
	}
	if (Form.Phone.value.length < 10 )
	{
			alert("Please Enter 10 Digits"); 
			 Form.Phone.focus();
			return false;
	}

	if (Form.Phone.value.charAt(0)!="9" && Form.Phone.value.charAt(0)!="8" && Form.Phone.value.charAt(0)!="7")
	{
			alert("The number should start only with 9 or 8 or 7");
			Form.Phone.focus();
			return false;
	}
	
	if(Form.Email.value=="")
	{
		alert("Please enter  Email Address");
		Form.Email.focus();
		return false;
	}
	if(Form.Email.value!="")
	{
		if (!validmail(Form.Email.value))
		{
			//alert("Please enter your valid email address!");
			Form.Email.focus();
			return false;
		}	
	}
		
	if(Form.dd.value=="" ||  Form.dd.value=="DD")
	{
		alert("Please fill your day of birth.");
		Form.dd.focus();
		return false;
	}
	if(Form.dd.value!="")
	{
		if((Form.dd.value<1) || (Form.dd.value>31))
		{
			alert("Kindly Enter your valid Date of Birth(Range 1-31)");
			Form.dd.focus();
			return false;
		}
	}
	
	if(Form.mm.value=="" || Form.mm.value=="MM")
	{
		alert("Please fill your month of birth.");
		Form.mm.focus();
		return false;
	}
	if(Form.mm.value!="")
	{
		if((Form.mm.value<1) || (Form.mm.value>12))
		{
			alert("Kindly Enter your valid Month of Birth(Range 1-12)");
			Form.mm.focus();
			return false;
		}
	}
	
	if(Form.yyyy.value=="" || Form.yyyy.value=="YYYY")
	{
		alert("Please fill your year of birth.");
		Form.yyyy.focus();
		return false;
	}
	if(Form.yyyy.value!="")
	{
		if(Form.yyyy.value > parseInt(mdate-18) || Form.yyyy.value < parseInt(mdate-62))
		{
			alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
			Form.yyyy.focus();
			return false;
		}
	}
	
	/*if(Form.otp_code.value=="")
	{
			alert("Please fill validatioin code.");
		Form.otp_code.focus();
		return false;
	}*/

	return true;
}

function swtchToNextTab_dd()
{
	if(document.hdfc_calc.dd.value!="" && (document.hdfc_calc.dd.value.length==2))
	{
		document.hdfc_calc.mm.focus();
	}
}

function swtchToNextTab_mm()
{
	if(document.hdfc_calc.mm.value!="" && (document.hdfc_calc.mm.value.length==2))
	{
		document.hdfc_calc.yyyy.focus();
	}

}


function displayResult()
{
if(document.hdfc_calc.car_name.value!='' && document.hdfc_calc.car_name.value!="Type slowly for autofill")
{
document.getElementById("show_details").innerHTML='<table width="100%" cellpadding="0" cellspacing="0" align="center">	<tr>      <td align="right" style="border-bottom:#ece9db thin solid;" width="12%">&nbsp;</td>      <td class="body_text_b_nw" style="border-bottom:#ece9db thin solid; height:35px;" width="87%" id="plz_show_price">Share your employment details to get quote</td>      <td style="border-bottom:#ece9db thin solid; height:2px;">&nbsp;</td>    </tr>	<tr>	<td></td>	<td width="87%"> 	<table width="90%" cellpadding="0" cellspacing="0">	<tr><td width="50%" >	<table width="94%" border="0" cellpadding="0" cellspacing="0">   <tr>  <td width="9%"><img src="new-images/green-tick.png" width="15" height="15" /></td>     <td width="91%" height="30" class="body_text_nw" align="left">Annual Income</td>         </tr>        <tr>          <td>&nbsp;</td>          <td height="35" class="body_text_nw">              <label>              <input type="text" name="Net_Salary" id="Net_Salary" style="border:2px solid #88bbd0; width:200px; height:25px;" tabindex="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>              </label>         </td>  </tr>   </table>	  </td><td width="50%" ><table width="100%" border="0" cellpadding="0" cellspacing="0">        <tr>          <td width="9%"><img src="new-images/green-tick.png" width="15" height="15" /></td>          <td width="91%" height="30" class="body_text_nw" align="left">Company Name</td>         </tr>        <tr>          <td>&nbsp;</td>          <td height="35" class="body_text_nw">           <label>     <input type="text" name="Company_Name" id="Company_Name" style="border:2px solid #88bbd0; width:200px; height:25px;"  value="Type slowly for autofill" onblur="onBlurDefault(this,\'Type slowly for autofill\'); "  onfocus="onFocusBlank(this,\'Type slowly for autofill\');" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/hdfcajax-cmplist-cl.php\')" tabindex="3"/>   </label>      </td>        </tr>      </table></td></tr></table>	  </td>	  <td></td>	</tr>	<tr><td colspan="3">&nbsp;</td></tr>	 <tr>      <td width="12%" align="right" style="border-bottom:#ece9db thin solid;">&nbsp;</td>      <td width="87%" height="35" style="border-bottom:#ece9db thin solid; "><table width="548">        <tr><td width="327" class="body_text_b_nw" >Personal Information</td>      <td width="207" class="body_text_b_nw1"><img src="new-images/locked-privacy.jpg" width="12" height="14"/> We keep this secure</td>      </tr></table></td>      <td width="1%" style="border-bottom:#ece9db thin solid;">&nbsp;</td>    </tr>	 	<tr><td></td>	<td width="87%"> 	<table width="90%" cellpadding="0" cellspacing="0">	<tr><td>	<table width="94%" border="0" cellpadding="0" cellspacing="0">     <tr>          <td width="9%"><img src="new-images/green-tick.png" width="15" height="15" /></td>          <td width="91%" height="30" class="body_text_nw" align="left">Name</td>     </tr>  <tr>   <td>&nbsp;</td>          <td height="35" class="body_text_nw">     <label>     <input type="text" name="Name" id="Name" style="border:2px solid #88bbd0; width:200px; height:25px;" tabindex="4"/>  </label>  </td>   </tr>      </table>	  </td><td ><table width="100%" border="0" cellpadding="0" cellspacing="0">    <tr>  <td width="9%"><img src="new-images/green-tick.png" width="15" height="15" /></td> <td width="91%" height="30" class="body_text_nw" align="left">Mobile Number</td>   </tr>  <tr><td>&nbsp;</td>          <td height="35" class="body_text_nw">		  <table>		  <tr><td> <div style="border:2px solid #88bbd0; width:25px; height:20px; padding-top:5px;">+91</div></td><td> <label> &nbsp;<input type="text" name="Phone" id="Phone" style="border:2px solid #88bbd0; width:165px; height:25px;" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="5" onchange="intOnly(this); insertstat_code();" />    </label>         </td></tr></table></td>   </tr>    </table></td></tr></table>	  </td>	  <td></td>	</tr>	<tr>	<td></td>	<td width="87%"> 	<table width="90%" cellpadding="0" cellspacing="0">	<tr><td width="50%">	<table width="94%" border="0" cellpadding="0" cellspacing="0">        <tr>          <td width="9%"><img src="new-images/green-tick.png" width="15" height="15" /></td>      <td width="91%" height="30" class="body_text_nw" align="left">Email</td>     </tr>     <tr>     <td>&nbsp;</td>    <td height="35" class="body_text_nw">         <label>         <input type="text" name="Email" id="Email" style="border:2px solid #88bbd0; width:200px; height:25px;" tabindex="6" onchange="insertstat_code();" />      </label> </td>   </tr>     </table> </td><td width="50%" ><table width="100%" border="0" cellpadding="0" cellspacing="0">    <tr>          <td width="9%"><img src="new-images/green-tick.png" width="15" height="15" /></td>     <td width="91%" height="35" class="body_text_nw" align="left">City</td>     </tr>     <tr>     <td>&nbsp;</td>    <td height="35" class="body_text_nw">        <label> <select name="City" id="City" style="border:2px solid #88bbd0; width:200px; height:30px;" class="inputtext" tabindex="7">        <?=plgetCityList($City)?>       </select>   </label>  </td>       </tr>   </table></td></tr></table>	  </td> <td></td></tr><tr>	<td></td>	<td width="87%"> <table width="100%" cellpadding="0" cellspacing="0">	<tr><td width="45%">	<table width="94%" border="0" cellpadding="0" cellspacing="0">        <tr>          <td width="9%"><img src="new-images/green-tick.png" width="15" height="15" /></td>          <td width="91%" height="30" class="body_text_nw" align="left">DOB</td>         </tr>        <tr>  <td>&nbsp;</td> <td height="35" class="body_text_nw">   <label>			  <input name="dd" id="dd" type="text" maxlength="2" class="inputtext" onblur="onBlurDefault(this,\'DD\');" onfocus="onFocusBlank(this,\'DD\');" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_dd();" onKeyPress="intOnly(this);" tabindex="8" style="border:2px solid #88bbd0; height:25px; width:40px; text-align:center;" value="DD">	/ <input name="mm" id="mm" type="text" maxlength="2" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_mm();" onKeyPress="intOnly(this);" onblur="onBlurDefault(this,\'MM\');" onfocus="onFocusBlank(this,\'MM\');" tabindex="9" style="border:2px solid #88bbd0; height:25px; width:40px; text-align:center;" value="MM"/>  / <input name="yyyy" id="yyyy" type="text" maxlength="4" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_yyyy();" onKeyPress="intOnly(this);" onblur="onBlurDefault(this,\'YYYY\');" onfocus="onFocusBlank(this,\'YYYY\');" tabindex="10" style="border:2px solid #88bbd0; height:25px; width:65px; text-align:center;" value="YYYY"/>          </label>         </td>       </tr>      </table>	  </td><td width="55%" ><table width="100%" border="0" cellpadding="0" cellspacing="0">       <tr>          <td width="8%"><img src="new-images/green-tick.png" width="15" height="15" /></td>          <td width="92%" height="35" class="body_text_nw" align="left">Enter Validation Code sent on ur Mobile No.</td>         </tr>        <tr>          <td>&nbsp;</td>          <td height="35" class="body_text_nw">              <label>              <input type="text" name="otp_code" id="otp_code"  style="border:2px solid #88bbd0; width:70px; height:25px;" maxlength="5" tabindex="11"/>&nbsp;(Verify your Mobile Number)           </label>        </td>       </tr>     </table></td></tr></table>	  </td>	  <td></td>	</tr>	<tr><td></td>	<td width="87%"> 	<table width="100%" cellpadding="0" cellspacing="0" height="70">	<tr><td width="54%" class="body_text_b_nw1"><input type="checkbox" name="accept" id="accept"> I read & agree to <a href="#">terms and conditions</a></td>	<td width="46%" align="center"><input class="design2" type="submit" name="Submit" value=">> Get Quote "   /></td>	</tr></table></td>	  <td></td>	</tr>	</table>';
}
else
	{
document.getElementById("show_details").innerHTML="";
	}

}
</script>
<script>
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

	function insertstat_code()
		{
			var get_phone = document.getElementById('Phone').value;
			var get_code = document.getElementById('stat_code').value;
			if(get_code=="" && get_phone.length==10){
				var queryString = "?get_Mobile=" + get_phone + "&stat_code=" + get_code;
				//alert(queryString);
				ajaxRequestMain.open("GET", "activate_hdfccl.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequestMain.onreadystatechange = function(){
					if(ajaxRequestMain.readyState == 4)
					{
					document.getElementById('stat_code').value=ajaxRequestMain.responseText;
					}
				}
		}
			ajaxRequestMain.send(null); 
		}
	window.onload = ajaxFunctionMain;
</script>

</head>
<body><div class="main-continer">
<div class="header" align="center">
    <br /><span class="body_text_b" style="padding-bottom:10px; !important">HDFC Bank offers fastest loan processing for wide range of Car Models.</span>
   </div>
<div style="clear:both;"></div>
<div class="leftpanel">
<form  method="POST" action="hdfc-carloan-app-offers-nw-continue.php" name="hdfc_calc"  onSubmit="return submitform(document.hdfc_calc);" >
<input type="hidden" name="stat_code" id="stat_code" tabindex=15>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="right" style="border-bottom:#ece9db thin solid; height:2px;"><span class="body_text_b" ><img src="new-images/van-ico.png" width="30" height="26" /></span></td>
      <td class="body_text_b" style="border-bottom:#ece9db thin solid; height:35px;">Choose your car</td>
      <td style="border-bottom:#ece9db thin solid; height:2px;">&nbsp;</td>
    </tr>
       
    <tr>
      <td>&nbsp;</td>
      <td><table width="92%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="5%"><img src="new-images/green-tick.png" width="15" height="15" /></td>
          <td width="95%" height="40" class="body_text" align="left">Make &amp; Model of car (ex. Nissan Micra)</td>
         </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="30" class="body_text">
              <label>
              <input type="text" name="car_name" id="car_name" style="border:2px solid #88bbd0; width:288px; height:25px;"  value="Type slowly for autofill" onblur="onBlurDefault(this,'Type slowly for autofill'); " onKeyDown="displayResult();" onfocus="onFocusBlank(this,'Type slowly for autofill');" onChange="displayResult();"  tabindex="1"/>
              </label>         </td>
        </tr>
      </table></td>
      <td>&nbsp;</td>
    </tr>
	<tr><td>&nbsp;</td><td >
	<table width="94%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="5%"><img src="new-images/green-tick.png" width="15" height="15" /></td>
          <td width="95%" height="35" class="body_text_nw" align="left" id="show_rumprice">Ex-showroom price of car (indicative prices) </td>
         </tr>
        <tr>
          <td>&nbsp;</td>
          <td height="35" class="body_text_nw">
              <label>
              <div id="car_price_pop" class="inputtext" style="width:300px;">Based on selected car</div>
              </label>         </td>
        </tr>
      </table>
	  </td></tr>
	<tr><td colspan="3">&nbsp;</td></tr>
	<tr><td colspan="3" width="100%" align="center" id="show_details">
	
	</td></tr>
  </table>
  </form>
</div>
<div class="rightpanel"><div class="clientsay">
<div style="margin:auto; height:265px; background:url(new-images/clientsay-sec-bg.jpg) 10px;">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="white_text">&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center"><span class="white_text">What People say</span></div></td>
    </tr>
    <tr>
      <td class="body">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="body"><table width="165" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>The online application forms are very simple and user-friendly; don't require too much information and one can get a decision almost instantly within the budget ! <br />
            <em><strong>Mrs Afsana<br />
IT Consultant</strong></em></td>
        </tr>
      </table></td>
    </tr>
  </table>
 </div>

</div>
 <div class="clietnsay_bg"></div>
 <div class="clientsay">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td class="body_text_b" style="padding-top:5px;">Features &amp; Benefits</td>
     </tr>
     <tr>
       <td align="left" valign="top"><table width="260" border="0" align="right" cellpadding="0" cellspacing="0">
         <tr>
           <td width="20"><img src="new-images/green-tick.png" width="15" height="15" /></td>
           <td width="240" height="20" class="body_C"><a href="#">Covers the widest range of cars in India.</a><br /></td>
         </tr>
         <tr>
           <td><img src="new-images/green-tick.png" width="15" height="15" /></td>
           <td class="body_C"><a href="#">Upto 100% finance on ur favourite car.</a><br /></td>
         </tr>
         <tr>
           <td><img src="new-images/green-tick.png" width="15" height="15" /></td>
           <td class="body_C"><a href="#">Repay with easy EMIs. </a><br /></td>
         </tr>
         <tr>
           <td><img src="new-images/green-tick.png" alt="" width="15" height="15" /></td>
           <td class="body_C"><a href="#">Attractive Interest rates.</a><br /></td>
         </tr>
         <tr>
           <td><img src="new-images/green-tick.png" width="15" height="15" /></td>
           <td class="body_C"><a href="#">Hassle-free documentation.</a></td>
         </tr>
       </table></td>
     </tr>
     
     <tr>
       <td>&nbsp;</td>
     </tr>
     <tr>
       <td>&nbsp;</td>
     </tr>
   </table>
 </div>
 <div class="clietnsay_bg"></div>
 <div class="reward-gallery">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">

     <tr>
       <td height="25" bgcolor="#618C9D" class="white_text">Welcome Rewards</td>
     </tr>
     <tr>
       <td align="center"><img src="new-images/bluetooth-device.gif" width="257" height="146" /></td>
     </tr>
     <tr>
       <td align="right" bordercolor="#FFFFFF"><img src="new-images/more-btn.png" width="85" height="26" border="0" /></td>
     </tr>
   </table>
 </div>
 </div>

</div>
</body>
</html>
