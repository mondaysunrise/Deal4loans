<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_REQUEST);
$car_name = $_REQUEST['car_name'];
$getCarSql = "select * from hdfc_car_list_category where hdfc_car_name='".$car_name."'";
list($getCarNumRows,$getCarQuery)=MainselectfuncNew($getCarSql,$array = array());

$Overall_Length = $getCarQuery[0]['Overall_Length'];
$Power = $getCarQuery[0]['Power'];
$Torque = $getCarQuery[0]['Torque'];
$Seating_Capacity = $getCarQuery[0]['Seating_Capacity'];
$Mileage = $getCarQuery[0]['Mileage'];
$Top_Speed  = $getCarQuery[0]['Top_Speed'];
$hdfc_car_name = $getCarQuery[0]['hdfc_car_name'];
$hdfc_car_segment  = $getCarQuery[0]['hdfc_car_segment'];
$hdfc_car_price = $getCarQuery[0]['hdfc_car_price'];
$Fuel_Capacity = $getCarQuery[0]['Fuel_Tank_Capacity'];
$Fuel_Type = $getCarQuery[0]['Fuel_Type'];
$Gears  = $getCarQuery[0]['Gears_Speeds'];
$Displacement = $getCarQuery[0]['Displacement'];

$hdfc_car_manufacturer = $getCarQuery[0]['hdfc_car_manufacturer'];
$hdfc_car_manufacturer_first = explode(" ", $hdfc_car_manufacturer);
$model = strtolower($hdfc_car_manufacturer_first[0]);
if($model=="land"){	$model = "landrover"; }

?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="images/car_hdfc/maruti_css.css" type="text/css" rel="stylesheet" />
<title>Deal4loans</title>
<link href="css/hdfccl-style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
 <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-stages.js"></script>
<script>
/*
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
*/
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
	var myOption= -1;
	var i;

if(Form.Employment_Status.selectedIndex==0)
{
	alert("Please select Occupation ");
	Form.Employment_Status.focus();
	return false;

}
if(Form.Company_Name.value=="" || Form.Company_Name.value=="Type slowly for autofill")
	{
		alert("Please enter Company Name to Continue");
		Form.Company_Name.focus();
		return false;
	}

if(Form.Employment_Status.selectedIndex>0)
{
	if(Form.Net_Salary.value=="" || Form.Net_Salary.value=="0")
	{
		alert('Please enter Annual Income to Continue');
		Form.Net_Salary.focus();
		return false;
	}

	if(Form.Experience.value=="" || Form.Experience.value=="0")
	{
		alert('Please enter Total Experience to Continue');
		Form.Experience.focus();
		return false;
	}
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
	
	if(Form.City.selectedIndex==0)
{
	alert("Please select City ");
	Form.City.focus();
	return false;

}
if(Form.Residence_Status.selectedIndex==0)
{
	alert("Please select Residence Status ");
	Form.Residence_Status.focus();
	return false;

}
if(Form.Employment_Status.value==1)
	{
myOption = -1;
		for (i=Form.salary_account.length-1; i > -1; i--) {
			if(Form.salary_account[i].checked) {
					myOption = i;
			}
		}
		if (myOption == -1) 
		{
			alert("Please select you have salary Account in HDFC Bank or not");
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
	
	if(Form.otp_code.value=="")
	{
		alert("Please fill validatioin code.");
		Form.otp_code.focus();
		return false;
	}
	if(Form.otp_code.value!="")
	{
		var initialVal = Form.stat_code.value;
		var finalVal = Form.otp_code.value;
		if(initialVal != finalVal)
		{
			alert("Validatioin Code is not correct.");
			Form.otp_code.focus();
			return false;
		}
	}
	
	if(!Form.accept.checked)
	{
		alert("Accept the Terms and Condition!");
		Form.accept.focus();
		return false;
	}

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

function addIdentified()
{
		var ni1 = document.getElementById('showIncomeDiv');
var ni12 = document.getElementById('repl_cmpnme');

	    ni1.innerHTML = '<table><tr>                <td width="5">&nbsp;</td>                <td width="18" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td width="234" align="left" class="<?php echo $model; ?>-heading_body-text">Annual Income</td>                <td width="18"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td width="249" align="left" class="<?php echo $model; ?>-heading_body-text">Total Experience</td>              </tr>              <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td align="left"><input type="text" name="Net_Salary" id="Net_Salary" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="3" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>                <td>&nbsp;</td>                <td align="left">  <input type="text" name="Experience" id="Experience" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="4"/></td>              </tr>              </table>';

if(document.getElementById('Employment_Status').value==2)
	{
		ni12.innerHTML ='<input type="text" name="Company_Name" id="Company_Name" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;"  tabindex="2"/>';
	}
	else
	{
		ni12.innerHTML ='<input type="text" name="Company_Name" id="Company_Name" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" value="Type slowly for autofill" onBlur="onBlurDefault(this,\'Type slowly for autofill\'); "  onfocus="onFocusBlank(this,\'Type slowly for autofill\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/hdfcajax-cmplist-cl.php\')" tabindex="2"/>';
	}
	
		return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('showIncomeDiv');
	ni1.innerHTML = '';
	return true;

}	

function addResi()
{
		var ni1 = document.getElementById('showResi');
	if(ni1.innerHTML =="")
	{
		if(document.getElementById('Employment_Status').value==2)
		{
			ni1.innerHTML = '<table width="534" ><tr>                <td width="7">&nbsp;</td>                <td width="15"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td align="left" class="<?php echo $model; ?>-heading_body-text" width="217">Years at current residence </td>                <td align="right"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td class="<?php echo $model; ?>-heading_body-text" align="left">Residence Status</td>              </tr>              <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td align="left"><input type="text" name="Resi_Stability" id="Resi_Stability" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="9"/> </td>                <td>&nbsp;</td>                <td align="left">                <select name="Residence_Status" id="Residence_Status" style="width:175px; height:25px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" class="inputtext" tabindex="10">        <option value="0">Please Select</option>		  	<option value="4">Owned By Self/Spouse</option>			<option value="1">Owned By Parent/Sibling</option>			<option value="3">Company Provided</option>			<option value="5">Rented - With Family</option>			<option value="6">Rented - With Friends</option>			<option value="2">Rented - Staying Alone</option>			<option value="7">Paying Guest</option>			<option value="8">Hostel</option>      </select>                                </td>              </tr></table>';
		}
		else
		{
	    ni1.innerHTML = '<table width="534" ><tr>                <td width="7">&nbsp;</td>                <td width="15"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td align="left" class="<?php echo $model; ?>-heading_body-text" width="217">Years at current residence </td>                <td align="right"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td class="<?php echo $model; ?>-heading_body-text" align="left">Residence Status</td>              </tr>              <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td align="left"><input type="text" name="Resi_Stability" id="Resi_Stability" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="9"/> </td>                <td>&nbsp;</td>                <td align="left">                <select name="Residence_Status" id="Residence_Status" style="width:175px; height:25px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" class="inputtext" tabindex="10">        <option value="0">Please Select</option>		  	<option value="4">Owned By Self/Spouse</option>			<option value="1">Owned By Parent/Sibling</option>			<option value="3">Company Provided</option>			<option value="5">Rented - With Family</option>			<option value="6">Rented - With Friends</option>			<option value="2">Rented - Staying Alone</option>			<option value="7">Paying Guest</option>			<option value="8">Hostel</option>      </select>                                </td>              </tr>                                      <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>&nbsp;</td>               <td>&nbsp;</td>                <td>&nbsp;</td>              </tr>             <tr>                <td>&nbsp;</td>                <td><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td align="left" class="<?php echo $model; ?>-heading_body-text" colspan="3">Salary Account in HDFC Bank ?</td>                         </tr>              <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td class="<?php echo $model; ?>-heading_body-text" align="left"><input type="radio" name="salary_account" id="salary_account"  value="1" tabindex="11" /> Yes &nbsp; &nbsp;<input type="radio" name="salary_account" id="salary_account"  value="2" tabindex="11"/> No </td>                <td>&nbsp;</td>                <td>            &nbsp;                    </td>              </tr></table>  ';
	}	
	}
	else
	{
		if(document.getElementById('Employment_Status').value==2)
		{
			ni1.innerHTML = '<table width="534" ><tr>                <td width="7">&nbsp;</td>                <td width="15"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td align="left" class="<?php echo $model; ?>-heading_body-text" width="217">Years at current residence </td>                <td align="right"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td class="<?php echo $model; ?>-heading_body-text" align="left">Residence Status</td>              </tr>              <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td align="left"><input type="text" name="Resi_Stability" id="Resi_Stability" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="9"/> </td>                <td>&nbsp;</td>                <td align="left">                <select name="Residence_Status" id="Residence_Status" style="width:175px; height:25px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" class="inputtext" tabindex="10">        <option value="0">Please Select</option>		  	<option value="4">Owned By Self/Spouse</option>			<option value="1">Owned By Parent/Sibling</option>			<option value="3">Company Provided</option>			<option value="5">Rented - With Family</option>			<option value="6">Rented - With Friends</option>			<option value="2">Rented - Staying Alone</option>			<option value="7">Paying Guest</option>			<option value="8">Hostel</option>      </select>                                </td>              </tr></table>';
		}
		else
		{
	    ni1.innerHTML = '<table width="534" ><tr>                <td width="7">&nbsp;</td>                <td width="15"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td align="left" class="<?php echo $model; ?>-heading_body-text" width="217">Years at current residence </td>                <td align="right"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td class="<?php echo $model; ?>-heading_body-text" align="left">Residence Status</td>              </tr>              <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td align="left"><input type="text" name="Resi_Stability" id="Resi_Stability" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="9"/> </td>                <td>&nbsp;</td>                <td align="left">                <select name="Residence_Status" id="Residence_Status" style="width:175px; height:25px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" class="inputtext" tabindex="10">        <option value="0">Please Select</option>		  	<option value="4">Owned By Self/Spouse</option>			<option value="1">Owned By Parent/Sibling</option>			<option value="3">Company Provided</option>			<option value="5">Rented - With Family</option>			<option value="6">Rented - With Friends</option>			<option value="2">Rented - Staying Alone</option>			<option value="7">Paying Guest</option>			<option value="8">Hostel</option>      </select>                                </td>              </tr>                                      <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td>&nbsp;</td>               <td>&nbsp;</td>                <td>&nbsp;</td>              </tr>             <tr>                <td>&nbsp;</td>                <td><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>                <td align="left" class="<?php echo $model; ?>-heading_body-text" colspan="3">Salary Account in HDFC Bank ?</td>                         </tr>              <tr>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td class="<?php echo $model; ?>-heading_body-text" align="left"><input type="radio" name="salary_account" id="salary_account"  value="1" tabindex="11"/> Yes &nbsp; &nbsp;<input type="radio" name="salary_account" id="salary_account"  value="2" tabindex="11"/> No </td>                <td>&nbsp;</td>                <td>            &nbsp;                    </td>              </tr></table>  ';
	}	
	}
		return true;
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
<body>
<div class="main-wrapper">
<div class="header-box"><span class="<?php echo $model; ?>-heading_A">HDFC Bank offers you complete package of <span class="<?php echo $model; ?>-heading_B">timely service</span>,</span>
  <span style="color:#CCCCCC">  
  <h1 class="<?php echo $model; ?>-heading_B">Competitive rates &amp; Competent guidance <span class="<?php echo $model; ?>-heading_A">along with 100% finance on select models.  </span></h1>
  </span></div>
<div style="clear:both;"></div>
<div class="<?php echo $model; ?>-vehicle_box_left">
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td class="vehicle_heading_text" valign="top" style="height:45px;"><?php echo $hdfc_car_name; ?></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><span class="vehicle_heading_text"><?php 	echo "Rs. ".number_format($hdfc_car_price); ?>/-</span></td>

    </tr>
    <tr>
      <td class="vehicle_sub_heading_text">Ex-showroom price</td>

    </tr>
  </table>
</div>
<div class="<?php echo $model; ?>-form-box">
<!--<form  method="POST" action="hdfc-car-loan-app-offers-nw-continue.php" name="hdfc_calc"  onSubmit="return submitform(document.hdfc_calc);" >-->
<form  method="POST" action="hdfc_carloan_app_continue11.php" name="hdfc_calc"  onSubmit="return submitform(document.hdfc_calc);" >
<input type="hidden" name="stat_code" id="stat_code" tabindex=15 readonly>
<input type="hidden" name="car_name" id="car_name" value="<?php echo $hdfc_car_name; ?>">
  <table width="534" border="0" align="center" cellpadding="0" cellspacing="0">
    <tbody>      
      
      <tr align="left">
        <td width="14" height="50" class="maruti-heading_text">&nbsp;</td>
        <td width="520" class="maruti-heading_text">Share your employment details to get quote</td>
      </tr>
      <tr>
        <td colspan="2" align="center"><table width="534" border="0" align="center" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td width="15">&nbsp;</td>
                <td width="18" align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td width="234" align="left" class="<?php echo $model; ?>-heading_body-text">Occupation</td>
                <td width="18"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td width="249" align="left" class="<?php echo $model; ?>-heading_body-text">Company Name</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="left">
                <select name="Employment_Status" id="Employment_Status" style="width:175px; height:25px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" class="inputtext" tabindex="1" onChange="addIdentified();"><option value="">Please Select</option>
	<option value="1">Salaried</option>
	<option value="2">Self Employed</option>
    </select>
    			</td>
                <td>&nbsp;</td>
                <td align="left" id="repl_cmpnme"> <input type="text" name="Company_Name" id="Company_Name" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" value="Type slowly for autofill" onBlur="onBlurDefault(this,'Type slowly for autofill'); "  onfocus="onFocusBlank(this,'Type slowly for autofill');" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/hdfcajax-cmplist-cl.php')" tabindex="2"/> </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
               <tr><td colspan="5" id="showIncomeDiv" align="left"></td></tr>
              <tr>
                <td class="<?php echo $model; ?>-heading_body-text">&nbsp;</td>
                <td colspan="4"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                      <tr>
                        <td width="53%" align="left" class="<?php echo $model; ?>-heading_text"> Personal information</td>
                        <td width="4%" valign="middle"><img src="images/newimages/security.png" width="14" height="16"></td>
                        <td width="43%" align="left" class="<?php echo $model; ?>-heading_body-text">We keep this secure</td>
                      </tr>
                    </tbody>
                </table></td>
              </tr>
              <tr>
                <td colspan="5" class="lining">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td align="left" class="<?php echo $model; ?>-heading_body-text">Name</td>
                <td align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td align="left"><span class="<?php echo $model; ?>-heading_body-text">Mobile Number</span></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="left">  <input type="text" name="Name" id="Name" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="5"/></td>
                <td>&nbsp;</td>
                <td align="left"><table width="80%" border="0" cellpadding="0" cellspacing="0" align="left">
                    <tbody>
                      <tr>
                        <td width="15%"><div style="width:22px; height:19px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; font-size:12px; font-family:Arial, Helvetica, sans-serif; background-color:#FFFFFF; padding-top:4px;">+91</div></td>
                        <td width="85%" align="left"><input type="text" name="Phone" id="Phone" style="width:143px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="6" onChange="intOnly(this); insertstat_code();"  autocomplete="off"  />  </td>
                      </tr>
                    </tbody>
                </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td align="left" class="<?php echo $model; ?>-heading_body-text">E-mail</td>
                <td align="left"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td align="left"><span class="<?php echo $model; ?>-heading_body-text">City</span></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="left"><input type="text" name="Email" id="Email" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="7" onChange="addResi();" onFocus="addResi();"  />             </td>
                <td>&nbsp;</td>
                <td align="left"><select name="City" id="City" style="width:175px; height:25px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" class="inputtext" tabindex="8" onChange="addResi(); insertstat_code();">        <?=plgetCityList($City)?>       </select></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="5" id="showResi"></td>
             </tr>
              <tr>
                <td>&nbsp;</td>
                <td><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td align="left" class="<?php echo $model; ?>-heading_body-text">DOB</td>
                <td><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></td>
                <td class="<?php echo $model; ?>-heading_body-text" align="left">Enter Validation Code sent on ur Mobile No.</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td align="left"><input name="dd" id="dd" type="text" maxlength="2" class="inputtext" onBlur="onBlurDefault(this,'DD');" onFocus="onFocusBlank(this,'DD');" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_dd();" onKeyPress="intOnly(this);" tabindex="12" style="width:35px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" value="DD">	/ <input name="mm" id="mm" type="text" maxlength="2" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_mm();" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'MM');" onFocus="onFocusBlank(this,'MM');" tabindex="13" style="width:35px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" value="MM"/>  / <input name="yyyy" id="yyyy" type="text" maxlength="4" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_yyyy();" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'YYYY');" onFocus="onFocusBlank(this,'YYYY');" tabindex="14" style="width:75px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" value="YYYY"/>        </td>
                <td>&nbsp;</td>
                <td>
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                      <tr>
                        <td width="35%"><input type="text" name="otp_code" id="otp_code"  style="width:75px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" maxlength="5" tabindex="15"/>                        </td>
                        <td width="65%" class="form_body_text"><em style="font-family:Arial, Helvetica, sans-serif; font-size:12px;"> (Verify your Mobile Number)</em></td>
                      </tr>
                    </tbody>
                </table>
                </td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
             </tr>
             
             
              <tr>
                <td>&nbsp;</td>
                <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tbody>
                    <tr>
                      <td width="11%" align="center"><input type="checkbox" name="accept" id="accept" tabindex="16"></td>
                      <td width="89%" align="left" class="<?php echo $model; ?>-terms_condition-text">I read &amp; agree to terms and conditions </td>
                    </tr>
                  </tbody>
                </table></td>
                <td colspan="2" align="left">
                <input type="submit" style="border: 0px none ; background-image: url(images/<?php echo $model; ?>-get-quote-btn.png); width: 142px; height: 45px; margin-bottom: 0px;" value=""/>
                
               </td>
              </tr>
            </tbody>
        </table></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
    </tbody>
  </table>
  </form>
</div>
<div class="right-box">
<div class="right-box-specification"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td height="50" colspan="2" style="border-bottom: thin solid #e4ddf9;"><h2 class="<?php echo $model; ?>-heading_B">Specifications</h2>	</td>
  </tr>
  
  <tr>
    <td width="51%" height="36" class="maruti-heading_body-text" >Overall Length</td>
    <td width="49%" height="36" align="right" class="heading_body-text_sub"><?php echo $Overall_Length; ?></td>
  </tr>
  <tr>
    <td height="35" class="maruti-heading_body-text">Power</td>
    <td height="35" align="right" class="heading_body-text_sub"><?php echo $Power; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Torque</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Torque; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Seating Capacity</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Seating_Capacity; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Mileage</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Mileage; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Fuel Tank Capacity</td>
    <td height="36" align="right"class="heading_body-text_sub"><?php echo $Fuel_Capacity; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Fuel Type</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Fuel_Type; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Top Speed</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Top_Speed; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Gears/Speeds</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Gears; ?></td>
  </tr>
  <tr>
    <td height="36" class="maruti-heading_body-text">Displacement</td>
    <td height="36" align="right" class="heading_body-text_sub"><?php echo $Displacement; ?></td>
  </tr>
</table>
</div>
<div style=" background:url(images/form-buttom-shadow-rightside.jpg) no-repeat; height:11px;"></div>

</div>
</div>
</body>
</html>
