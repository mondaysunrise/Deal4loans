<?php
//require 'scripts/functions.php';
require 'scripts/db_init.php';
require 'scripts/session_check.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ICICI Bank Home Loan</title>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/common.js"></script>
<!--<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script> -->
<script src='scripts/icicihldigittoword.js' type='text/javascript' language='javascript'></script>
<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>

<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<link href="style/pl-hl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script language="JavaScript" type="text/javascript" src="images/rollovers.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<!--<script type="text/javascript" src="js/jquery.js"></script>
 --><script type="text/javascript" src="js/easySlider1.5.js"></script>
<link rel="stylesheet" href="home_style.css" type="text/css" />

<style type="text/css">
	
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
	
.loginboxdiv{
margin:0px;
height:21px;
width:172px;
background:url(login_bg1.jpg) no-repeat bottom;
}
/* attributes of the input box */
.loginbox
{
background:none;
border:none;
width:160px;
height:15px;
margin:0;
padding: 2px 7px 0px 7px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;
}
	</style>
<Script Language="JavaScript">
var ajaxRequestMain;  // The variable that makes Ajax possible!
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				//ajaxRequestMain = new XMLHttpRequest();
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					//ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						//ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

	

	window.onload = ajaxFunctionMain;
</script>
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
function Trim(strValue)
	{
		var j=strValue.length-1;i=0;
		while(strValue.charAt(i++)==' ');
		while(strValue.charAt(j--)==' ');

		return strValue.substr(--i,++j-i+1);
	}
</script>

<script language="javascript">
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

function check_form(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if(Form.City.selectedIndex==0)
	{
		alert("Please enter City");
		Form.City.focus();
		return false;
	}
	if(Form.propertyConstruction_Type.value=="")
	{
		alert('Please enter Property Details');
		Form.propertyConstruction_Type.focus();
		return false;
	}

	if(Form.Employment_Status.selectedIndex==0)
	{
		alert("Please enter your Occupation");
		Form.Employment_Status.focus();
		return false;
	}

	if(Form.Employment_Status.value==1)
	{
		if(Form.company_name.value=="")
		{
			alert('Please enter Company Name');
			Form.company_name.focus();
			return false;
		}
	
		if(Form.monthly_income.value=="")
		{
			alert('Please enter Monthly Income');
			Form.monthly_income.focus();
			return false;
		}
	}
	else if(Form.Employment_Status.value==2)
	{
		if(Form.company_name.value=="")
		{
			alert('Please enter Business Name');
			Form.company_name.focus();
			return false;
		}
	
		if(Form.monthly_income.value=="")
		{
			alert('Please enter Annual Income');
			Form.monthly_income.focus();
			return false;
		}
	}

	if(Form.month.selectedIndex==0)
	{
		alert("Please enter DOB Month");
		Form.month.focus();
		return false;
	}
	if(Form.day.selectedIndex==0)
	{
		alert("Please enter DOB Day");
		Form.day.focus();
		return false;
	}
	if(Form.year.selectedIndex==0)
	{
		alert("Please enter DOB Year");
		Form.year.focus();
		return false;
	}
	
	
	
	
	
	if((Form.loan_amount.value==""))
	{
		alert('Please enter Loan Amount');
		Form.loan_amount.focus();
		return false;
	}
	if((Form.loan_amount.value!=""))
	{
		if((Form.loan_amount.value <500000))
		{
			alert('Please enter Loan Amount greater then 500000');
			Form.loan_amount.focus();
			return false;
		}
	}
	
	if((Form.property_value.value==""))
	{
		alert('Please enter Property Value');
		Form.property_value.focus();
		return false;
	}
	
	
	if(Form.co_appli.checked)
	{

		if((Form.co_name.value=="") || (Form.co_name.value=="Full Name")|| (Trim(Form.co_name.value))==false)
		{
			alert("Kindly fill in Co Applicant Name!");
			Form.co_name.focus();
			return false;
		}
		else if(containsdigit(Form.co_name.value)==true)
		{
			alert("Name contains numbers!");
			Form.co_name.focus();
			return false;
		}
	    for (var i = 0; i < Form.co_name.value.length; i++) 
	    {
			if (iChars.indexOf(Form.co_name.value.charAt(i)) != -1) 
			{
				alert ("Name has special characters.\n Please remove them and try again.");
				Form.co_name.focus();
				return false;
			}
		}
		if(Form.co_month.selectedIndex==0)
		{
			alert("Please enter DOB Month");
			Form.co_month.focus();
			return false;
		}
		if(Form.co_day.selectedIndex==0)
		{
			alert("Please enter DOB Day");
			Form.co_day.focus();
			return false;
		}
		if(Form.co_year.selectedIndex==0)
		{
			alert("Please enter DOB Year");
			Form.co_year.focus();
			return false;
		}
		if(Form.co_monthly_income.value=="")
		{
			alert('Please enter Co Applicant Monthly Income.');
			Form.co_monthly_income.focus();
			return false;
		}
		
		
	}
	
		
}
</script>
<script language="JavaScript">

function addCompany()

{

		var ni = document.getElementById('getcomp');

		if(document.loancalc.Employment_Status.value=="1")

		{

			ni.innerHTML = '<table align="right" border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>&nbsp;</td></tr><tr><td class="fldtxt" align="left" valign="middle"  width="163"><b>Company Name <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></b></td><td class="fldtxt" align="left" valign="middle"><div class="loginboxdiv">  <input class="loginbox"  type="text" name="company_name" id="company_name"  style="width:170px;" tabindex="4" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event)" /><div></td></tr><tr><td>&nbsp;</td></tr><tr><td class="fldtxt" align="left" valign="middle"  width="163"><b>Monthly Income <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></b></td><td class="fldtxt" align="left" valign="middle"><div class="loginboxdiv">  <input class="loginbox" type="text" name="monthly_income" id="monthly_income" style="width:150px;" onkeyup="intOnly(this); getDigitToWordsMonthlySal(\'monthly_income\',\'formatedI\',\'wordIn\');" onkeypress="intOnly(this); getDigitToWordsMonthlySal(\'monthly_income\',\'formatedI\',\'wordIn\');"  onblur="getDigitToWordsMonthlySal(\'monthly_income\',\'formatedIncome\',\'wordIncome\');"  /><div></td></tr><tr><td>&nbsp;</td></tr></table>';	

		}

		else if(document.loancalc.Employment_Status.value=="2")

		{

			ni.innerHTML = '<table align="right" border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>&nbsp;</td></tr><tr><td class="fldtxt" align="left" valign="middle"  width="163"><b>Business Name <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></b></td><td class="fldtxt" align="left" valign="middle"><div class="loginboxdiv">  <input class="loginbox"  type="text" name="company_name" id="company_name"  style="width:170px;" tabindex="4" /><div></td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td class="fldtxt" align="left" valign="middle"  width="163"><b>Annual Income <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></b></td><td class="fldtxt" align="left" valign="middle"><div class="loginboxdiv">  <input class="loginbox" type="text" name="monthly_income" id="monthly_income" style="width:150px;" onkeyup="intOnly(this); getDigitToWords(\'monthly_income\',\'formatedI\',\'wordIn\');" onkeypress="intOnly(this); getDigitToWords(\'monthly_income\',\'formatedI\',\'wordIn\');"  onblur="getDigitToWords(\'monthly_income\',\'formatedIncome\',\'wordIncome\');"  /><div></td></tr><tr><td>&nbsp;</td></tr></table>';	

		}

		else

		{

			ni.innerHTML = '';

		}

		return true;

	}


function addElement()
{

	var ni = document.getElementById('myDivRS');
	if(document.loancalc.propertyConstruction_Type.value=="CONSTRUCTED")
	{
		ni.innerHTML = '<table align="right" border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>&nbsp;</td></tr><tr><td class="fldtxt" align="left" valign="middle"  width="163"><b>Name of builder</b></td><td class="fldtxt" align="left" valign="middle"><div class="loginboxdiv"><input class="loginbox" type="text" name="builder_name" id="builder_name" style="width:150px;" /><div></td></tr><tr><td>&nbsp;</td></tr></table>';
	}
	else if(document.loancalc.propertyConstruction_Type.value=="UNDER_CONSTRUCTION")
	{
		ni.innerHTML = '<table align="right" border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>&nbsp;</td></tr><tr><td class="fldtxt" align="left" valign="middle"  width="163"><b>Name of builder</b></td><td class="fldtxt" align="left" valign="middle"><div class="loginboxdiv"><input class="loginbox" type="text" name="builder_name" id="builder_name" style="width:150px;" /><div></td></tr><tr><td>&nbsp;</td></tr></table>';
	}
	else
	{
		ni.innerHTML ='';
	}

	return true;

}
  function showdetailsFaq(d,e)
			{			
				for(j=1;j<=e;j++)
					{
						if(d==j)
							{
								if(eval(document.getElementById("divfaq"+j)).style.display=='none')
									{
									
										eval(document.getElementById("divfaq"+j)).style.display=''
										//eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
									}
								else
									{
										
										eval(document.getElementById("divfaq"+j)).style.display='none'
										//eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
									}
							}
						
					}
			}
							window.onload=showdetailsFaq
</script>
<style>
		.black_overlay{
			display: none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			background-color: black;
			z-index:1001;
			-moz-opacity: 0.8;
			opacity:.80;
			filter: alpha(opacity=80);
		}
		.white_content {
			display: none;
			position: absolute;
			top: 25%;
			left: 25%;
			width: 50%;
			height: 50%;
			padding: 16px;
			border: 16px solid orange;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
	</style>
<link href="images_hl/DHL_style.css" rel="stylesheet" type="text/css">
<link href="images_hl/facebox.css" media="screen" rel="stylesheet" type="text/css">

</head><body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">

	
<center>
<table width="903" align="center" border="0" cellpadding="0" cellspacing="0">
  <tbody><tr>
    <td background="images_hl/main_bg.gif"><table width="901" align="center" border="0" cellpadding="0" cellspacing="0">
        <tbody><tr>
          <td valign="top" align="left" background="images_hl/top_bg.gif"><img src="images_hl/logo.gif"></td>
        </tr>
        
        <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tbody><tr>
                <td width="500" valign="top"><table width="94%" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td background="images_hl/tab_topbg.gif"><img src="images_hl/tab_topbg.gif" width="1" height="5"></td>
                    </tr>
                    <tr>
                      <td>
                      <img src="images_hl/img.jpg" />
                      </td>
                    </tr>
                    <tr>
                      <td><table width="96%" align="center" border="0" cellpadding="0" cellspacing="0">
                          <tbody>
                          <tr>
                            <td valign="top" height="360">
                             <div id="div6" name="div6" style="width: 100%; height: 360px; overflow: auto; display: block;">
                                 <table width="96%" border="0" cellpadding="0" cellspacing="0">
                                  <tbody><tr>
                                    <td class="normal_txt" valign="top">
                                      <p><span class="highlight" style="color:#0000FF; font-size:13px;">Get best deals &amp; finance your perfect home with ICICI Home Loans</span><br />
                                          <br />
                                      <span class="highlight">ICICI Bank Home Loan  Benefits:</span>
                                      </p>
                                      <ul class="bulletstyle2">
                                        <li>Guidance throughout  the process making home buying hassle free</li>
                                        <li>Doorstep service at  your comfort</li>
                                        <li>Simplified  documentation</li>
                                        <li>Sanction approval  without having selected a property</li>
                                        <li>Flexible repayment  options</li>
                                        <li>With a network of 2500  branches we are always close to you</li>
                                        <li>Over 900 Bank Branches  pan India for servicing of your loans</li>
                                        <li>Free Personal Accident  Insurance</li>
                                        <li>Insurance options for your home loan at attractive premium</li>
                                      </ul></td>
                                  </tr>
                                </tbody></table>
                              </div>
                              </td>
                          </tr>
						   <tr>
                            <td><span style="text-align:center;"> <marquee style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#990000; font-weight:bold">ICICI Bank Home Loan launches one year and two year Fixed rate product</marquee></span></td>
                          </tr>
                            <tr>
                            <td align="center"><img src="images_hl/home-loans.jpg" border="0" width="400"  /></td>
                          </tr>
 						
						   <tr>
                            <td><a href="http://www.icicibank.com/privacy.html" style="font-size: 11px;" target="_blank">Privacy Policy</a> </td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                        </tbody></table></td>
                    </tr>
                  </tbody></table></td>
                <td valign="top" width="401" align="left"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                      <td style="background-repeat:no-repeat; background-image:url(images_hl/bg1.png); font-size:18px; color:#FFFFFF; font-weight:bold; height:45px;" align="center" valign="bottom" >Get Free e-Quote </td>
                    </tr>
                    <tr>
                      <td valign="top" align="center" bgcolor="#efefe0">
               <form name="loancalc" id="loancalc" method="post" action="icici-home-loan-get-rates.php" onSubmit="return check_form(document.loancalc);" >
                      <table width="90%" border="0" cellpadding="0" cellspacing="0">
                  <tbody><tr>
                    <td colspan="2" class="fldtxt" valign="middle" align="center" height="20">&nbsp;</td>
                    </tr>
                  <tr>
                    <td class="fldtxt" valign="middle" width="45%" align="left" height="30"><b>City<sup> <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></sup></b></td>
                    <td valign="middle" width="55%" align="left">
                      
                      <select size="1" name="City" id="City" style="width:170px;"  class="txtbox">
                        <option value="-1">Please Select</option>
                        <? $getlocationlist=("Select * From icici_hfc_location_list order by location_name ASC");
                   list($recordcount,$row)=MainselectfuncNew($getlocationlist,$array = array());
					$cntr=0;
				   
				   while($cntr<count($row))
							{
                        $location_name = $row[$cntr]['location_name'];
                        echo  "<option value='".$location_name."'>".ucfirst(strtolower($location_name))."</option>";
                    $cntr = $cntr +1; }
                    ?>
                        <option value="Others">Others</option>
                      </select>
                   </td>
                  </tr>
                   <tr>
                    <td class="fldtxt" valign="middle" align="left" height="30"><b>Property Detail</b>s <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
                    <td valign="middle" align="left"><span class="fldtxt">
                      <select name="propertyConstruction_Type" id="propertyConstruction_Type"  class="txtbox" style="width:172px;" onchange="addElement();">
                        <option value="">Select</option>
                        <option value="CONSTRUCTED">Already built home/flat</option>
                        <option value="UNDER_CONSTRUCTION">Home/flat under construction by builder</option>
                        <option value="CONSTRUCT_ON_OWN_LAND">Construction on land you own</option>
                        <option value="PURCHASE_LAND_AND_CONSTRUCT">Construction on land you wish to purchase</option>
                        <option value="PURCHASE_LAND">Purchase a plot</option>
                      </select>
                    </span></td>
                  </tr>
                  
                   <tr>
                    <td class="fldtxt" valign="middle" align="left" id="myDivRS" colspan="2"></td></tr>
                    
                                   
                  <tr>
                    <td class="fldtxt" valign="middle" align="left" height="30"><b>Occupation <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></b></td>
                    <td valign="middle" align="left"><span class="fldtxt">
                      <select name="Employment_Status" id="Employment_Status" style="width:172px;"  class="txtbox" tabindex="5"  onChange="addCompany();">
                        <option value="">Please Select</option>
                        <option value="1">Salaried</option>
                        <option value="2">Self Employed</option>
                      </select>
                    </span></td>
                  </tr>
                  
         <tr>                    <td class="fldtxt" valign="middle" align="left" colspan="2" id="getcomp" ></td></tr>                  
    <tr><td class="fldtxt" valign="middle" align="left"colspan="2"><span id='formatedI' style='font-size:11px; font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordIn' style='font-size:11px; font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
                    <tr>
                    <td class="fldtxt" valign="middle" align="left" height="30"><b>DOB<sup> <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></sup></b></td>
                    <td valign="middle" align="left"><?php
                    $month_arr = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                    ?>
                    <select name="month" id="month" style="width:55px;" class="txtbox">
                    <option value="">mon</option>
                    <?php
                    for($i=0;$i<count($month_arr);$i++)
                    {
                        $count = $i+1;
                        echo "<option value='".$count."'>".$month_arr[$i]."</option>";
                    }
                    ?>
                    </select>
                    <span id="">
                    <select name="day" style="width:53px;" class="txtbox">
                    <option value="">day</option>
                    <?php
                    for($i=1;$i<=31;$i++)
                    {
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select>
                    </span>
                    <select name="year" style="width:56px;" class="txtbox">
                    <option value="">year</option>
                    <?php
                    for($i=1988;$i>=1949;$i--)
                    {
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select></td>
                  </tr>
                
                  <tr>
                    <td class="fldtxt" valign="middle" align="left" height="30"><strong>Total EMIs <br />
                      you currently pay per month. (if any)</strong></td>
                    <td valign="middle" align="left"><span class="fldtxt">
                       <div class="loginboxdiv">
                      <input class="loginbox" type="text" name="obligations" id="obligations" style="width:150px;" value="<?php echo $obligations; ?>"  onkeyup="intOnly(this);" onkeypress="intOnly(this);" /></div>
                    </span></td>
                  </tr>
                  <tr>
                    <td class="fldtxt" valign="middle" align="left" height="30"><b>Loan Amount <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></b></td>
                    <td valign="middle" align="left"><span class="fldtxt">
                       <div class="loginboxdiv">
                      <input class="loginbox" type="text" name="loan_amount" id="loan_amount" style="width:150px;" maxlength="30" value="<?php echo $loan_amount; ?>"  onkeyup="intOnly(this);getDigitToWords('loan_amount','formatedl_A','wordloanAmoun_t');"  onkeydown="getDigitToWords('loan_amount','formatedl_A','wordloanAmoun_t');" onkeypress="intOnly(this); getDigitToWords('loan_amount','formatedl_A','wordloanAmoun_t');" onblur="getDigitToWords('loan_amount','formatedl_A','wordloanAmoun_t');" /></div>
                    </span></td>
                  </tr>
                   <tr><td class="fldtxt" valign="middle" align="left"colspan="2">
                   <span id='formatedl_A' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmoun_t' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span>

</td></tr>
                  
<tr>
                    <td class="fldtxt" valign="middle" align="left" height="30"><b>Property Value <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></b></td>
                    <td valign="middle" align="left"><span class="fldtxt">
                      <div class="loginboxdiv">
                      <input class="loginbox" type="text" name="property_value" id="property_value" style="width:150px;" maxlength="30" value="<?php echo $property_value; ?>"onkeyup="intOnly(this);getDigitToWords('property_value','formatedlA','wordloanAmount');"  onkeydown="getDigitToWords('property_value','formatedlA','wordloanAmount');" onkeypress="intOnly(this); getDigitToWords('property_value','formatedlA','wordloanAmount');" onblur="getDigitToWords('property_value','formatedlA','wordloanAmount');" /></div>
                    </span></td>
                  </tr>
                    <tr><td class="fldtxt" valign="middle" align="left"colspan="2"><span id='formatedlA' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span><span id='wordloanAmount' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td></tr>
                  <tr>
                    <td class="fldtxt" valign="middle" align="left" height="30" colspan="2">
                      <input type="checkbox" name="co_appli" id="co_appli" value="1" onclick="return showdetailsFaq(1,12);" style="border:none;" />
                      <b>Co- Applicant</b></td>

                  </tr>
                  <tr><td colspan="2">
                     <div style="display: none;" id="divfaq1">
                    <table align="right" border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td class="fldtxt" align="left" height="5" valign="middle"></td>
                    <td class="fldtxt" align="left" height="5" valign="middle"></td>
                  </tr>  
                      <tr>
                    <td class="fldtxt" align="left" valign="middle"><b>Date of Birth</b></td>
                    <td class="fldtxt" align="left" valign="middle" width="55%">
     <?php
                    $month_arr = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                    ?>
                    <select name="co_month" id="co_month" style="width:57px;">
                    <option value="">mon</option>
                    <?php
                    for($i=0;$i<=count($month_arr);$i++)
                    {
                        $count = $i+1;
                        echo "<option value='".$count."'>".$month_arr[$i]."</option>";
                    }
                    ?>
                    </select>
                    <span id="">
                    <select name="co_day" style="width:53px;">
                    <option value="">day</option>
                    <?php
                    for($i=1;$i<=31;$i++)
                    {
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select>
                    </span>
                    <select name="co_year" style="width:55px;">
                    <option value="">year</option>
                    <?php
                    for($i=1988;$i>=1949;$i--)
                    {
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select> 
                    </td>
                  </tr>    
                   <tr>
                    <td class="fldtxt" align="left" height="5" valign="middle"></td>
                    <td class="fldtxt" align="left" height="5" valign="middle"></td>
                  </tr>  
                    <tr>
                    <td class="fldtxt" align="left" valign="middle"><b>Net Monthly Income</b></td>
                    <td class="fldtxt" align="left" valign="middle">
                    <div class="loginboxdiv">
                      <input class="loginbox" type="text" name="co_monthly_income" id="co_monthly_income" style="width:150px;" value="<?php echo $income; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></div></td>
                  </tr>    
                   <tr>
                    <td class="fldtxt" align="left" height="5" valign="middle"></td>
                    <td class="fldtxt" align="left" height="5" valign="middle"></td>
                  </tr>  
                    <tr>
                    <td class="fldtxt" align="left" valign="middle"><b>Obligations</b></td>
                    <td class="fldtxt" align="left" valign="middle">
                    <div class="loginboxdiv">
                      <input class="loginbox" type="text" name="co_obligations" id="co_obligations" style="width:150px;" value="<?php echo $obligations; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></div></td>
                  </tr>    
                    
                    </table>
                    </div>
                  
                  </td></tr>
                  
                  <tr>
                    <td colspan="2" valign="bottom" align="center" style="padding-top:3px;"><input src="images_hl/but_submit.gif" name="Submit" onclick="return formcheck();" tabindex="8" vspace="5" type="image" border="0" style="border:none;" ></td>
                    </tr>
                </tbody></table>
                </form>
                
                </td>
                    </tr>
<!--                    <tr>
                      <td><img src="images_hl/form_btmimg.gif" width="395" height="23"></td>
                    </tr>
 -->                  </tbody></table></td>
              </tr>
            </tbody></table></td>
        </tr>
        <tr>
          <td class="footer" align="center" bgcolor="#a41c2b" height="18">
          All loans at the sole discretion of ICICI Bank. Terms and 
Conditions apply. * Nothing contained herein shall constitute or be 
deemed to constitute an advice, invitation, solicitation or endorsement 
to purchase any products/ services / projects of Builders/ third party 
and ICICI Bank disclaims all responsibility.
          </td>
        </tr>
      </tbody></table></td>
  </tr>
</tbody></table>
</form>
</center>

<div id="CalculateEligibility" style="display: none;" class="bodytext">


<div id="mobMessage" style="padding: 5px; display: none; font-size: 11px; left: 220px; width: 350px; border: 1px solid rgb(195, 142, 199); position: absolute; top: 735px; background-color: rgb(252, 223, 255); font-family: Arial,Helvetica,sans-serif;">You
 will recieve an verification code on your mobile no. Please enter this 
on submission of the form. In case of network delay, you have to wait up
 to 5 mins.</div>
  <div id="facebox" style="display: none;">     <div class="popup">       <table>         <tbody>           <tr>             <td class="tl"></td><td class="b"></td><td class="tr"></td>           </tr>           <tr>             <td class="b"></td>             <td class="body">               <div class="content">               </div>               <div class="footer">                 <a href="#" class="close">                   <img src="images_hl/closelabel.gif" title="close" class="close_image">                 </a>               </div>             </td>             <td class="b"></td>           </tr>           <tr>             <td class="bl"></td><td class="b"></td><td class="br"></td>           </tr>         </tbody>       </table>     </div>   </div>
</body></html>