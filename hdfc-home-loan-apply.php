<?php
	ob_start( 'ob_gzhandler' );
	require 'scripts/session_check.php';
	require 'scripts/functions.php';

	$name = $_SESSION['Temp_Name'] ;
	$mobile = $_SESSION['Temp_mobile'] ;
	$Email=	$_SESSION['Temp_email'] ;
	$loan_type = $_SESSION['Temp_loan_type'] ;
	$last_id = $_SESSION['Temp_Last_Inserted'] ;
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/hdfc-hl-apply-styles.css" rel="stylesheet" type="text/css">
<title>HDFC Ltd | HDFC Ltd Loan | HDFC Home Loan</title>
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read and apply online for home loans & Get, Compare and Choose deals from all the leading loan providers / banks. Know the interest rates, EMIs, Loan amount etc choose 
the Best Deal.">

<meta name="keywords" content="HDFC Ltd Home loans India, Apply HDFC Home Loans, Compare HDFC Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
 <script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true
				
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
	</script>
<style  >
body{
	margin:0px;
	padding:0px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:16px;
	color:#292323;

}

input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;

}
.orgtext{
	color:#d75b10;
	line-height:16px;
	font-weight:bold;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:10px;
}

.nrmltxt{
	line-height:16px;
	color:#5e5e5e;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}

.nrmltxt span{
	font-weight:bold;
	color:#a9643a;
	font-size:12px;

}

.bldtxt{
	font-weight:bold;
	line-height:16px;
	color:#5e5e5e;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
}

/* START CSS NEEDED ONLY IN DEMO */
	
#mainContainer{
	width:660px;
	margin:0 auto;
	text-align:left;
	height:100%;		
	border-left:3px double #000;
	border-right:3px double #000;
	}
#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
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
	z-index:100;
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
	position:absolute;
	z-index:5;
	}
	
form{
	display:inline;
	}
 
#slider{
	width:590px;
	margin:0 0 0 50px;
 }	

#slider ul, #slider li{
	margin:0;
	padding:0;
	list-style:none;
}

#slider li{ 
	/* 
	define width and height of list item (slide)
	entire slider area will adjust according to the parameters provided here
	*/ 
	width:590px;
	height:65px;

	overflow:hidden; 
}
		
	
#slider li div{
	display:block;
	float:left;
	width:143px;
 }

p#controls{
	margin:-76px 0 0 15;
	position:relative;
	width:650px;
} 
	
		
#prevBtn, #nextBtn{ 
	display:block;
	overflow:hidden;
	text-indent:-8000px;		
	width:36px;
	height:80px;
	position:absolute;
}	

#nextBtn{ 
	left:605px;
}														
#prevBtn a, #nextBtn a{  
	display:block;
	width:36px;
	height:84px;
	background: url(new-images/hl/slider/prv-btn.jpg) no-repeat left center;
 
}	

#nextBtn a{ 
	background: url(new-images/hl/slider/nxt-btn.jpg) no-repeat left center;
}												
 </style>
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
	function Decoration(strPlan)
{
       if (document.getElementById('plantype') != undefined)  
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='Beige';  
       }

       return true;
}
function Decoration1(strPlan)
{
       if (document.getElementById('plantype') != undefined) 
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='';  
			     
               
       }

       return true;
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


function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
	{
      document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";		
		Form.Name.focus();	return false;	
	}
	else if(containsdigit(Form.Name.value)==true)
	{
	//	alert("Name contains numbers!");
        document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Name contains number</span>";		
		Form.Name.focus();
		return false;
	}
	  for (var i = 0; i < Form.Name.value.length; i++) {
		if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
		//alert ("Name has special characters.\n Please remove them and try again.");
		      document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Contains special characters!</span>";		
		Form.Name.focus();
		return false;
		}
	  }
	  
	if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
//	alert("Kindly fill in your Mobile Number!");
	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
	Form.Phone.focus();
	return false;
	}
	
		  if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
			{
//				  alert("Enter numeric value");
				  document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
				  Form.Phone.focus();
				  return false;  
			}
			if (Form.Phone.value.length < 10 )
			{
//					alert("Please Enter 10 Digits"); 
					document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill 10 digits!</span>";
					 Form.Phone.focus();
					return false;
			}
			if ((Form.Phone.value.charAt(0)!="9") && (Form.Phone.value.charAt(0)!="8") && (Form.Phone.value.charAt(0)!="7"))
			{
				//alert("The number should start only with 9 or 8 or 7");
				document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";
				Form.Phone.focus();
				return false;
			}	
		  if(Form.Email.value=="")
	  {		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	Form.Email.focus();		return false;	}
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter  Email Address!</span>";	Form.Email.focus();		return false;	}
	else if(bb==-1)
	{		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter  Email Address!</span>";	Form.Email.focus();		return false;	}
	
	if(Form.City.selectedIndex==0)
	{			document.getElementById('cityVal').innerHTML = "<span class='hintanchor'>Enter City to Continue!</span>";		Form.City.focus();		return false;	}
	else if((Form.City.value=='Others')  && ((Form.City_Other.value=='')||!isNaN(Form.City_Other.value)||(Form.City_Other.value=="Other City")))
	{	document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";	Form.City_Other.focus();	return false;	}
	if((Form.IncomeAmount.value=='')||(Form.IncomeAmount.value=="Annual Income"))
	{		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";		Form.IncomeAmount.focus();		return false;	}
	if((Form.Loan_Amount.value=='')||(Form.Loan_Amount.value=="Loan Amount"))
	{	//alert("Kindly fill in your Loan Amount (Numeric Only)!");	
		document.getElementById('loanVal').innerHTML = "<span  class='hintanchor'>Fill Numeric Value!</span>";
		Form.Loan_Amount.focus();	return false;	}
	else if(containsalph(Form.Loan_Amount.value)==true)
	{			document.getElementById('loanVal').innerHTML = "<span  class='hintanchor'>Fill Numeric Value!</span>";	Form.Loan_Amount.focus();	return false;	}
	if(!Form.accept.checked)
	{ document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";	Form.accept.focus(); return false;	}
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

function othercity1()
{
	var ni1 = document.getElementById('othCitDiv');
	var ni2 = document.getElementById('othCitvalDiv');
	if(document.home_loan.City.value=='Others')
	{
		ni1.innerHTML = 'Other City';
		ni2.innerHTML = '<input value="Other City" name="City_Other" id="City_Other" style="width: 140px;" onBlur="onBlurDefault(this,\'Other City\');"  onfocus="onFocusBlank(this,\'Other City\');" onKeyUp="searchSuggest();" /><div id="CityOLayer"></div><div id="othercityVal"></div>';
	}
	else	
	{
		ni1.innerHTML = '';
		ni2.innerHTML = '';
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

function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}

function addhdfclife()
{
	var ni1 = document.getElementById('hdfclife');
	var cit = document.home_loan.City.value;
	var otrcit = document.home_loan.City_Other.value;
	//alert(cit);	
	if(cit =="Ahmedabad" || otrcit =="Allahabad" || cit =="Bangalore" || cit =="Baroda" || cit =="Chandigarh" || cit =="Chennai" || cit =="Cochin" || cit =="Cuttack" || cit =="Gurgaon" || cit =="Guwahati" || cit =="Indore" || cit =="Kanpur" || cit =="Kochi" || cit =="Kolkata" || cit =="Lucknow" || cit =="Mumbai" || cit =="Pune" || 
cit =="Surat" || cit =="Vizag" )
	{
		//alert("ranjana");
		ni1.innerHTML = '<table  style="border:1px solid #000000; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#0572B5; font-weight:normal; " height="20"><span style="color:#FF0000;">(Optional) </span>Special service only for Deal4loans customers:</td></tr> <tr><td width="23"><input type="checkbox"  name="hdfclife" id="hdfclife" value="1"/></td> <td width="611" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#0572B5; font-weight:normal; line-height:16px;"> Make sure that your cherished home is always protected from uncertainties. Cover your home loan today with HDFC Life Click2Protect. To know more, please tick here</td>		 </tr>	 </table>';	
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}
</script>
  		
			
   
  <script>
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}


function addtooltip()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
		
			//if(document.loan_form.Phone.value!="")
			//{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = 'Please give correct Mobile Number to Activate your Loan Request';
			//}
		}
		
		return true;

	}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}
function removetooltip()
{
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML!="")
		{
		
//			if(document.loan_form.Phone.value!="")
	//		{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
		//	}
		}
		
		return true;

	}
		function insertData()
		{
			var get_full_name = document.getElementById('Name').value;
			//var get_full_name = document.getElementById('full_name').value;
			
			var get_email = document.getElementById('Email').value;
			//var get_email = document.getElementById('email').value;		
			
			var get_mobile_no = document.getElementById('Phone').value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_city = document.getElementById('City').value;
			
			var get_id = document.getElementById('Activate').value;
			//alert();
			var get_product ="2";

				var queryString = "?get_Mobile=" + get_mobile_no +"&get_City=" + get_city + "&get_Full_Name=" + get_full_name +"&get_Email=" + get_email +"&get_product=" + get_product +"&get_Id=" + get_id ;
				
				//alert(queryString); 
				ajaxRequest.open("GET", "insert-incomplete-data.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						document.getElementById('Activate').value=ajaxRequest.responseText;
					}
				}

				ajaxRequest.send(null); 
			 
		}

	window.onload = ajaxFunction;


</script>
</head>

<body>
<table cellpadding="0" cellspacing="0" width="1024" align="center"><tr><td>
<div id="pagewrap">

  <div id="hdfc_header1">
<div id="site-logo"><img src="images/logo.gif"></div>
  </div>
  <div style="clear:both;"></div>
<div id="hdfc_content">
  <table width="99%"  border="0"   cellpadding="0" cellspacing="0">
    <tr>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td height="25"  style=" padding-left:10px; " ><div style="color:#5e5e5e; font-size:13px; font-weight:bold;line-height:24px;  ">Features &amp; Benefits of HDFC Ltd Home Loan | HDFC Home Loan</div></td>
    </tr>
    <tr>
      <td height="25"  style="padding-left:15px; " ><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #def3f8; ">
        <tr>
          <td ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="34" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
              <td width="0"><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Online loan application facility.</div></td>
            </tr>
            <tr>
              <td width="34" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
              <td width="0"><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Loan from any office for purchase of home anywhere in India.</div></td>
            </tr>
            <tr>
              <td width="34" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
              <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Loan approval even before a property is selected.</div></td>
            </tr>
            <tr>
              <td width="34" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
              <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Online excess for existing customers. </div></td>
            </tr>
            <tr>
              <td width="34" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
              <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Dual rate home loans - partly fixed and partly floating.</div></td>
            </tr>
            <tr>
              <td width="34" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
              <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Maximum loan is 85% of the cost of the property (including the cost of the land).</div></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="115" valign="top" id="logo_hide"  background="new-images/landing-prtnr-bg.jpg" style="background-repeat:no-repeat; padding-top:42px; "><div id="slider">
        <ul>
          <li>
            <div align="center" class="orgtext"><img   src="new-images/hl/slider/icici-bank-h.jpg" alt="ICICI Bank Home Loan" width="128" height="47" style="border:none;"/><br />
              ICICI Bank Home Loan</div>
            <div align="center" class="orgtext"><img  src="new-images/hl/slider/hdrc-ltd.jpg" alt="HDFC Ltd" width="128" height="47"  style="border:none;"/><br />
              HDFC Ltd</div>
            <div align="center" class="orgtext"><img  src="new-images/hl/slider/axis.jpg" alt="Axis Bank" width="128" height="47"  style="border:none;"/><br />
              Axis Bank</div>
            <div align="center" class="orgtext"><img  src="new-images/thumb/stanchart.jpg" alt="Standard Chartered" width="128" height="47"  style="border:none;"/><br />
              Standard Chartered</div>
          </li>
        </ul>
      </div></td>
    </tr>
    <tr>
      <td class="bldtxt1" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; " >&nbsp;</td>
    </tr>
    </table>
</div>
<div id="hdfc_sidebar">
<div class="widget_b"><img src="new-images/hl/frm-hdng-new121.gif" /></div>  
<div class="widget_hdfc" >


<div class="right-box-b"><form name="home_loan" action="home-loan-apply-continue.php" onSubmit="return submitform(document.home_loan);" method="post">
<input type="hidden" name="referrer" value="<? echo $_REQUEST['referrer'] ?>">
<input type="hidden" name="Type_Loan" value="Req_Loan_Home">
<input type="hidden" name="creative" value="<? echo $_REQUEST['creative'] ?>">
<input type="hidden" name="section" value="self">
<input type="hidden" name="source" value="HH5DL">
<input type="hidden" name="last_id" value="<? echo $last_id; ?>">
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="42%" height="35" class="bldtxt">First Name</td>
    <td width="58%"><INPUT TYPE="hidden" NAME="onCloseValue" id="onCloseValue" value="1">
								<input type="text" name="Name" id="Name" style="width:140px;" onKeyDown="validateDiv('nameVal');" tabindex="1" /><div id="nameVal" class="alert_msg" ></div></td>
  </tr>
  <tr>
    <td height="28" class="bldtxt">Mobile No.</td>
    <td> <span class="form_text_pl">+91</span>
     <input type="text"  style="width:113px;" maxlength="10"  name="Phone" id="Phone"  onChange="intOnly(this); tosendsms(); insertData();" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="addtooltip();" onKeyDown="validateDiv('phoneVal');"  tabindex="2"/><div id="phoneVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td height="28" class="bldtxt">Email</td>
    <td><input class="style4" style="width:140px;" name="Email" id="Email" onBlur="onBlurDefault(this,'Email Id');"  onFocus="removetooltip();"  onChange="insertData();" onKeyDown="validateDiv('emailVal');" tabindex="3" /><div id="emailVal" class="alert_msg"></div>  </td>
  </tr>
  <tr>
    <td height="28" class="bldtxt">City</td>
    <td><select size="1" align="left" style="width:140"  name="City" id="City" onChange="othercity1(this); insertData(); addhdfclife(); validateDiv('cityVal'); " />
                                
                                    <?=getCityList1($City)?>
                                    </select><div id="cityVal" class="alert_msg"></div></td>
  </tr>
  <tr>
    <td class="form_text_pl" id="othCitDiv"></td>
    <td id="othCitvalDiv"></td>
  </tr>
  <tr>
    <td height="28" class="bldtxt" valign="top">Annual Income</td>
    <td><input   name="IncomeAmount" id="IncomeAmount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" onKeyPress="intOnly(this); getDigitToWords('IncomeAmount','formatedIncome','wordIncome');" style="width:140px;" onBlur="getDigitToWords('IncomeAmount', 'formatedIncome', 'wordIncome');"  onKeyDown="validateDiv('netSalaryVal');" tabindex="6" ><div id="netSalaryVal" class="alert_msg"></div></td>
  </tr>
              <tr>
                                <td width="166" align="left" valign="middle" class="bldtxt" colspan="2"><span id='formatedIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordIncome' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> </td>
                              </tr>
  <tr>
    <td height="28" align="left" valign="top" class="bldtxt">Loan Amount</td>
    <td><input name="Loan_Amount"  id="Loan_Amount" onFocus="this.select();" onChange="intOnly(this);"  onKeyUp="intOnly(this); getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedlA','wordloanAmount');" style="width:140px;" onKeyDown="getDigitToWords('Loan_Amount','formatedlA','wordloanAmount');  validateDiv('loanVal');" onBlur="getDigitToWords('Loan_Amount', 'formatedlA', 'wordloanAmount'); " tabindex="7" /><div id="loanVal"  class="alert_msg"></div> </td>
  </tr>
  <tr>
                                <td colspan="2" align="left" valign="middle" class="bldtxt"><span id='formatedlA' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordloanAmount' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> </td>
                              </tr>
  <tr>
    <td height="0" colspan="2"align="center" class="form_text_pl" style="font-size:10px; text-align:left;"><input type="hidden" name="Activate" id="Activate" >
								<input type="checkbox" name="accept" style="border:none;" checked> 
I authorize Deal4loans.com & its partnering Banks to call me with reference to my loan application  & Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank">Terms and Conditions</a>.<div id="acceptVal" class="alert_msg"></div><br></td>
  </tr>
  <tr>
    <td height="0" colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="image" name="Submit"  src="new-images/hl/pl-quote.gif"  style="width:117px; height:29px; border:none; " /></td>
    </tr>
          </table></form></div>
          
         

</div>
 <div class="widget_c"><img src="new-images/hl/step-ban.gif"></div>
</div>
<div style="clear:both;"></div>
<div class="hdfc_why"><div class="why_b"><span style="padding-left:10px; "><img src="new-images/hl/why-d4l.gif" width="173" height="21" /></span></div>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:2px solid #def3f8; ">
    <tr>
      <td ><table width="98%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
          <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Over 6 lakh customers have taken quote at Deal4loans.com</div></td>
        </tr>
        <tr>
          <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
          <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Home Loan Quotes are free for customers.</div></td>
        </tr>
        <tr>
          <td width="35" height="35" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="20" height="22" /></td>
          <td><div style="color:#5e5e5e; font-size:13px; font-weight:bold; background-color:#f6fcfd; line-height:24px;  ">Deal4loans.com has tie ups with all Home loan Banks in India.</div></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>

</div>
</td></tr>  </table>
</body>
</html>