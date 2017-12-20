<?php
session_start();
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
//echo "Session - ".$_SESSION['coupon_code'];
function getCityField($field_name,$class_name,$selectedValue='')
{
	$options = "<select name=\'".$field_name."\' id=\'".$field_name."\' class=\'".$class_name."\'>";
	$options .= "<option value=\'\'>Select</option>";
	$options .= "<option value=\'\' disabled=\'disabled\'>States</option>";
	$selectCitySql = "select * from states_in_india where status='state' order by name asc";
	$selectCityQuery = ExecQuery($selectCitySql);
	$numselectCity = mysql_num_rows($selectCityQuery);
	$selected ='';
	for($numCity=0;$numCity<$numselectCity;$numCity++)
	{
		$name_state = mysql_result($selectCityQuery,$numCity,'name');
		if($selectedValue==$name_state) $selected = 'selected';
		$options .= "<option value=\'".$name_state."\' ".$selected.">".$name_state."</option>";
	}
	$selected ='';
	if($selectedValue=="Delhi") $selected = 'selected';
	$options .= "<option value=\'\' disabled=\'disabled\'>National Unoin Territory</option>";
	$options .= "<option value=\'Delhi\' ".$selected." >Delhi</option>";
	$options .= "<option value=\'\' disabled=\'disabled\'>Unoin Territory</option>";
	$selectCitySql = "select * from states_in_india where status='ut' order by name asc";
	$selectCityQuery = ExecQuery($selectCitySql);
	$numselectCity = mysql_num_rows($selectCityQuery);
	$selected ='';
	for($numCity=0;$numCity<$numselectCity;$numCity++)
	{
		$name_state = mysql_result($selectCityQuery,$numCity,'name');
		if($selectedValue==$name_state) $selected = 'selected';
		$options .= "<option value=\'".$name_state."\' ".$selected.">".$name_state."</option>";
	}
	$options .= "</select>";
	return($options);
}

function getCityFieldSession($field_name,$class_name,$selectedValue='')
{
	$options = "<select name='".$field_name."' id='".$field_name."' class='".$class_name."'>";
	$options .= "<option value=''>Select</option>";
	$options .= "<option value='' disabled=\'disabled\'>States</option>";
	$selectCitySql = "select * from states_in_india where status='state' order by name asc";
	$selectCityQuery = ExecQuery($selectCitySql);
	$numselectCity = mysql_num_rows($selectCityQuery);
	$selected ='';
	for($numCity=0;$numCity<$numselectCity;$numCity++)
	{
		$name_state = mysql_result($selectCityQuery,$numCity,'name');
		if($selectedValue==$name_state) $selected = 'selected';
		$options .= "<option value='".$name_state."' ".$selected.">".$name_state."</option>";
	}
	$selected ='';
	if($selectedValue=="Delhi") $selected = 'selected';
	$options .= "<option value='' disabled='disabled'>National Unoin Territory</option>";
	$options .= "<option value='Delhi' ".$selected." >Delhi</option>";
	$options .= "<option value='' disabled='disabled'>Unoin Territory</option>";
	$selectCitySql = "select * from states_in_india where status='ut' order by name asc";
	$selectCityQuery = ExecQuery($selectCitySql);
	$numselectCity = mysql_num_rows($selectCityQuery);
	$selected ='';
	for($numCity=0;$numCity<$numselectCity;$numCity++)
	{
		$name_state = mysql_result($selectCityQuery,$numCity,'name');
		if($selectedValue==$name_state) $selected = 'selected';
		$options .= "<option value='".$name_state."' ".$selected.">".$name_state."</option>";
	}
	$options .= "</select>";
	return($options);
}
//print_r($_REQUEST);
$car_name = $_REQUEST['car_name'];
$car_name = 'Mercedes%20Slk%20Class%20Slk%20200%20Kompressor';

$getCarSql = "select * from hdfc_car_list_category where hdfc_car_name='".$car_name."'";
$getCarQuery = ExecQuery($getCarSql);
$getCarNumRows = mysql_num_rows($getCarQuery);
$Overall_Length = mysql_result($getCarQuery,0,'Overall_Length');
$Power = mysql_result($getCarQuery,0,'Power');
$Torque = mysql_result($getCarQuery,0,'Torque');
$Seating_Capacity = mysql_result($getCarQuery,0,'Seating_Capacity');
$Mileage = mysql_result($getCarQuery,0,'Mileage');
$Top_Speed  = mysql_result($getCarQuery,0,'Top_Speed');
$hdfc_car_name = mysql_result($getCarQuery,0,'hdfc_car_name');
$hdfc_car_segment  = mysql_result($getCarQuery,0,'hdfc_car_segment');
$hdfc_car_price = mysql_result($getCarQuery,0,'hdfc_car_price');
$Fuel_Capacity = mysql_result($getCarQuery,0,'Fuel_Tank_Capacity');
$Fuel_Type = mysql_result($getCarQuery,0,'Fuel_Type');
$Gears  = mysql_result($getCarQuery,0,'Gears_Speeds');
$Displacement = mysql_result($getCarQuery,0,'Displacement');

$hdfc_car_manufacturer = mysql_result($getCarQuery,0,'hdfc_car_manufacturer');
$hdfc_car_manufacturer_first = explode(" ", $hdfc_car_manufacturer);
$model = strtolower($hdfc_car_manufacturer_first[0]);
if($model=="land"){	$model = "landrover"; }
if($model=="force"){	$model = "landrover"; }
if($model=="isuzu"){	$model = "landrover"; }


//http://www.deal4loans.com/carloan/id/A123456
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="images/car_hdfc/maruti_csshttps.css" type="text/css" rel="stylesheet" />
<title>Deal4loans</title>
<link href="https://www.deal4loans.com/css/hdfccl-style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="https://www.deal4loans.com/scripts/common.js"></script>
<script src='https://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
 <script src="https://code.jquery.com/jquery-1.8.2.js"></script>
<link rel="stylesheet" href="https://www.deal4loans.com/css/jquery-ui.css" />
<script src="https://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="https://www.deal4loans.com/ajax-dynamic-https.js"></script>
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
.hdtext-address-car {
font-family: Arial, Helvetica, sans-serif;
font-size: 12px;
color: #171616;
font-weight: normal;
width: 92%;
height: 20px;
border: #bebebf solid thin;
border-radius: 5px;
text-indent: 5px;
}
		
	.oneline_inputwrapper{ width:345px; height:24px; background:#FFF; border:#bebebf solid thin; border-radius:5px; margin-left:5px;}} 
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
function inputFocus(i){
    if(i.value==i.defaultValue){ i.value=""; i.style.color="#000"; }
}
function inputBlur(i){
    if(i.value==""){ i.value=i.defaultValue; i.style.color="#888"; }
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


	if((Form.FName.value=="") || (Form.FName.value=="first name") || (Form.FName.value=="firstname")|| (Trim(Form.FName.value))==false)
	{
		alert("Kindly fill in your First Name!");
		Form.FName.select();
		return false;
	}
	else if(containsdigit(Form.FName.value)==true)
	{
		alert("First Name contains numbers!");
		Form.FName.select();
		return false;
	}
	for (var i = 0; i < Form.FName.value.length; i++) {
		if (iChars.indexOf(Form.FName.value.charAt(i)) != -1) {
			alert ("First Name has special characters.\n Please remove them and try again.");
			Form.FName.select();
			return false;
		}
	 }

	/*if((Form.MName.value=="") || (Form.MName.value=="middle name")|| (Trim(Form.MName.value))==false)
	{
		alert("Kindly fill in your Middle Name!");
		Form.MName.select();
		return false;
	}
	else if(containsdigit(Form.MName.value)==true)
	{
		alert("Middle Name contains numbers!");
		Form.MName.select();
		return false;
	}
	for (var i = 0; i < Form.MName.value.length; i++) {
		if (iChars.indexOf(Form.MName.value.charAt(i)) != -1) {
			alert ("Middle Name has special characters.\n Please remove them and try again.");
			Form.MName.select();
			return false;
		}
	 }
*/
if((Form.LName.value=="") || (Form.LName.value=="last name")|| (Form.LName.value=="lastname")|| (Trim(Form.LName.value))==false)
	{
		alert("Kindly fill in your Last Name!");
		Form.LName.select();
		return false;
	}
	else if(containsdigit(Form.LName.value)==true)
	{
		alert("Last Name contains numbers!");
		Form.LName.select();
		return false;
	}
	for (var i = 0; i < Form.LName.value.length; i++) {
		if (iChars.indexOf(Form.LName.value.charAt(i)) != -1) {
			alert ("Last Name has special characters.\n Please remove them and try again.");
			Form.LName.select();
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
	if(Form.Net_Salary.value=="" || Form.Net_Salary.value=="0")
	{
		alert('Please enter Annual Income to Continue');
		Form.Net_Salary.focus();
		return false;
	}
	if(Form.Loan_Amount.value=="" || Form.Loan_Amount.value=="0")
	{
		alert('Please enter Loan Amount to Continue');
		Form.Loan_Amount.focus();
		return false;
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
	
	
	if(Form.Education.selectedIndex==0)
	{
		alert("Please select Education");
		Form.Education.focus();
		return false;
	
	}
	if(Form.no_dependents.value=="")
	{
		alert("Please Enter No of Dependents");
		Form.no_dependents.focus();
		return false;
	}

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

 if (Form.Pancard.value == "") {
               alert("Invalid Pan No");
		Form.Pancard.focus();
}
   if (Form.Pancard.value != "") {
            ObjVal = Form.Pancard.value;
            var panPat = /^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/;
            if (ObjVal.search(panPat) == -1) {
                alert("Invalid Pan No");
                Form.Pancard.focus();
                return false;
            }
        }


	
	if(Form.Tenure.selectedIndex==0)
	{
		alert("Please select Tenure");
		Form.Tenure.focus();
		return false;
	
	}

	if(Form.customer_id.value=="" || Form.customer_id.value=="0")
	{
		alert('Please enter Customer Id/Account No to Continue');
		Form.Loan_Amount.focus();
		return false;
	}

	if(Form.off_add_line1.value=="")
	{
		alert("Please Enter office address");
		Form.off_add_line1.focus();
		return false;
	}
/*	if(Form.off_landmark.value=="")
	{
		alert("Please Enter office landmark");
		Form.off_landmark.focus();
		return false;
	}
*/
	if(Form.off_State.selectedIndex==0)
	{
		alert("Please select Office State");
		Form.off_State.focus();
		return false;
	}
	if(Form.off_City.selectedIndex==0)
	{
		alert("Please select Office City");
		Form.off_City.focus();
		return false;
	}


	if(Form.coupon_code.value=="")
	{
		alert("Please select Coupon Code");
		Form.coupon_code.focus();
		return false;
	}

/*if(Form.City.value=="Others")
{
	if(Form.OtherCity.value=="Others")
	{
		alert("Please enter Other City");
		Form.OtherCity.focus();
		return false;
	}
}*/
	if(Form.captcha0.value=="")
	{
			alert("please enter captcha!");
			Form.captcha0.focus();
				return false;
	}	

	
	if(Form.otp_code.value=="")
	{
		alert("Please fill validatiion code.");
		Form.otp_code.focus();
		return false;
	} 

/*else if(Form.otp_code.value!="")
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
*/
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
		ni12.innerHTML ='<input type="text" name="Company_Name" id="Company_Name" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;"  tabindex="2" autocomplete="off"/>';
	}
	else
	{
		ni12.innerHTML ='<input type="text" name="Company_Name" id="Company_Name" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" value="Type slowly for autofill" onBlur="onBlurDefault(this,\'Type slowly for autofill\'); "  onfocus="onFocusBlank(this,\'Type slowly for autofill\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/hdfcajax-cmplist-cl.php\')" tabindex="2" autocomplete="off" />';
	}
	
		return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('showIncomeDiv');
	ni1.innerHTML = '';
	return true;

}	

function addOtherCity()
{
	var ni1 = document.getElementById('otherCityF');
	var ni2 = document.getElementById('otherCityL');
	var ni3 = document.getElementById('otherCityA');

	if(document.getElementById('City').value=="Others")
	{
		ni2.innerHTML ="<div style='padding-top:10px;'>Other City</div>";
		ni1.innerHTML ='<div style="padding-bottom:10px;"><input type="text" name="OtherCity" id="OtherCity" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="8"/></div>';	
		ni3.innerHTML ='<div style="padding-top:10px;"><img src="images/<?php echo $model; ?>-bullet.png" alt="" width="15" height="15"></div>';
	}
	else
	{
		ni3.innerHTML ='';
		ni1.innerHTML ='';
		ni2.innerHTML ='';
	}
}



function addAddressValue()
{
	//alert(Form.selectAddVal.value);
// alert(document.getElementById("selectAddVal").checked);
	if(document.getElementById("selectAddVal").checked==true)
	{
		document.getElementById('off_add_line1').value = document.getElementById('resi_add_line1').value;
		document.getElementById('off_add_line2').value = document.getElementById('resi_add_line2').value;
		document.getElementById('off_add_line3').value = document.getElementById('resi_add_line3').value;
		document.getElementById('off_landmark').value = document.getElementById('resi_landmark').value;
		document.getElementById('off_landline').value = document.getElementById('resi_landline').value;
		var City = document.getElementById('off_City').value;
		var State = document.getElementById('off_State').value;
		var ni2 = document.getElementById('checkOffSate');
		var ni3 = document.getElementById('checkOffCity');
		ni3.innerHTML = City;
		ni2.innerHTML = State;	
	}
	else	
	{
		document.getElementById('off_add_line1').value='';
		document.getElementById('off_add_line2').value='';
		document.getElementById('off_add_line3').value='';
		document.getElementById('off_landmark').value='';
		document.getElementById('off_landline').value='';
		var ni2 = document.getElementById('checkOffSate');
		var ni3 = document.getElementById('checkOffCity');
		ni3.innerHTML = '<select name="resi_City" id="resi_City" class="hdtext-select-car" tabindex="31"><option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Guntur">Guntur</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Noida">Noida</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option><option value="Others">Others</option></select>';
		ni2.innerHTML = '<select name="resi_State" id="resi_State" class="hdtext-select-car"><option value="">Select</option><option value="" disabled="disabled">States</option><option value="Andhra Pradesh">Andhra Pradesh</option><option value="Arunachal Pradesh">Arunachal Pradesh</option><option value="Assam">Assam</option><option value="Bihar">Bihar</option><option value="Chhattisgarh">Chhattisgarh</option><option value="Goa">Goa</option><option value="Gujarat">Gujarat</option><option value="Haryana">Haryana</option><option value="Himachal Pradesh">Himachal Pradesh</option><option value="Jammu and Kashmir">Jammu and Kashmir</option><option value="Jharkhand">Jharkhand</option><option value="Karnataka">Karnataka</option><option value="Kerala">Kerala</option><option value="Madhya Pradesh">Madhya Pradesh</option><option value="Maharashtra">Maharashtra</option><option value="Manipur">Manipur</option><option value="Meghalaya">Meghalaya</option><option value="Mizoram">Mizoram</option><option value="Nagaland">Nagaland</option><option value="Odisha">Odisha</option><option value="Punjab">Punjab</option><option value="Rajasthan">Rajasthan</option><option value="Sikkim">Sikkim</option><option value="Tamil Nadu">Tamil Nadu</option><option value="Tripura">Tripura</option><option value="Uttar Pradesh">Uttar Pradesh</option><option value="Uttarakhand">Uttarakhand</option><option value="West Bengal">West Bengal</option><option value="" disabled="disabled">National Unoin Territory</option><option value="Delhi">Delhi</option><option value="" disabled="disabled">Unoin Territory</option><option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option><option value="Chandigarh">Chandigarh</option><option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option><option value="Daman and Diu">Daman and Diu</option><option value="Lakshadweep">Lakshadweep</option><option value="Puducherry">Puducherry</option></select>';
	}
}

function checkAccField()
{
	//var select_acc = document.getElementById('select_acc').value;

	var ni1 = document.getElementById('checkcustIDLabel');
	var ni2 = document.getElementById('checkcustIDName');
	ni1.innerHTML ='';
	ni2.innerHTML ='';
	//alert(select_acc);
	ni1.innerHTML = 'Account Number';
	ni2.innerHTML = '<input type="text" name="customer_id" id="customer_id" class="hdtext-input-car" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" maxlength="14" tabindex="19"  value="<?php echo  $_SESSION['customer_id'];?>" onfocus="addResiField2();" />'
}

function checkAccField1()
{
	//var select_acc = document.getElementById('select_acc').value;
	var ni1 = document.getElementById('checkcustIDLabel');
	var ni2 = document.getElementById('checkcustIDName');
	ni1.innerHTML ='';
	ni2.innerHTML ='';
//	alert(select_acc);
	ni1.innerHTML = ' HDFC Cust ID' ;
	ni2.innerHTML = '<input type="text" name="customer_id" id="customer_id" class="hdtext-input-car" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" maxlength="8" tabindex="19"  value="<?php echo  $_SESSION['customer_id'];?>" onfocus="addResiField2();" />'
}



function addResiField1()
{
		var ni3 = document.getElementById('addMoreFields1');
		ni3.innerHTML = '<table width="525" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td colspan="5" class="hdtext-formsub" height="45">Professional Details</td></tr>      <tr><td width="15">&nbsp;</td><td width="4">&nbsp;</td><td width="85" class="hdtext-car-formsub" >Profession</td><td width="158"><select name="Employment_Status" id="Employment_Status" class="hdtext-select-car" tabindex="1" ><option value="">Profession</option><option value="1"  >Salaried</option><option value="2" >Self Employed</option></select></td><td width="263"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="15">&nbsp;</td><td width="4">&nbsp;</td><td width="95" class="hdtext-car-formsub">Company Name</td><td width="149"><input type="text" name="Company_Name" id="Company_Name" style="color:#888;" class="hdtext-input-car"  value="Type slowly for autofill" onBlur="inputBlur(this); onBlurDefault(this,\'Type slowly for autofill\'); "  onfocus="inputFocus(this); onFocusBlank(this,\'Type slowly for autofill\');" onKeyUp="ajax_showOptions(this,\'getCountriesByLetters\',event, \'https://www.deal4loans.com/hdfcajax-cmplist-cl.php\')" autocomplete="off" tabindex="2"/></td></tr></table></td></tr><tr><td colspan="5" height="10"></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td class="hdtext-car-formsub">PAN Card no.<span style="color:#FF0000;">*</span> </td><td><input type="text" name="Pancard" id="Pancard" class="hdtext-input-car" maxlength="10" tabindex="3" /></td><td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="15">&nbsp;</td><td width="4">&nbsp;</td><td width="95" class="hdtext-car-formsub">HDFC Cust ID or A/C no<span style="color:#FF0000;">*</span></td><td width="149" class="hdtext-car-formsub"><input type="radio" name="select_acc" id="select_acc" value="custid" onclick="checkAccField();"  checked /> Customer ID<br /><input type="radio" name="select_acc" id="select_acc" value="accno" onclick="checkAccField1();" /> Account Number</td></tr></table></td></tr><tr><td colspan="5" height="5"></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td class="hdtext-car-formsub">Tenure</td><td> <select name="Tenure" id="Tenure" class="hdtext-select-car" tabindex="6" ><option value="">Select</option><option value="1" >12 Months</option><option value="2" >24 Months</option><option value="3" >36 Months</option><option value="4" >48 Months</option><option value="5" >60 Months</option><option value="6" >72 Months</option><option value="7" >84 Months</option></select></td><td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="15">&nbsp;</td><td width="4">&nbsp;</td><td width="95" class="hdtext-car-formsub" id="checkcustIDLabel">HDFC Cust ID</td><td width="149"  id="checkcustIDName"><input type="text" name="customer_id" id="customer_id" class="hdtext-input-car" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" maxlength="14" tabindex="19" onfocus="addResiField2();"  /></td></tr></table></td></tr><tr><td colspan="5" height="5"></td></tr></table>';
}

function addResiField2()
{
//	alert("sasda");
	var ni3 = document.getElementById('addMoreFields2');
		ni3.innerHTML = '<table width="530" border="0" cellspacing="0" cellpadding="0"><tr><td height="45" colspan="2" class="hdtext-formsub">Correspondance Address<span style="color:#FF0000;">*</span></td></tr><tr><td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="3%" >&nbsp;</td><td width="2%" >&nbsp;</td><td width="15%" valign="middle" class="hdtext-car-formsub" >Address</td><td width="80%" valign="middle" class="hdtext-car-formsub" ><input type="checkbox" name="chk_address[]" id="chk_address" value="office" checked="checked" />Office<input type="checkbox" name="chk_address[]" id="chk_address" value="residence" />Residence <input type="checkbox" name="chk_address[]" id="chk_address" value="offcumresi" />Office cum Residence</td></tr></table></td></tr><tr><td colspan="2" height="10"></td></tr><tr><td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="3%" >&nbsp;</td><td width="2%" >&nbsp;</td><td width="15%" class="hdtext-car-formsub" >Address</td><td width="80%" ><span class="hdtext-car-formsub"><input type="text" name="off_add_line1" id="off_add_line1" class="hdtext-address-car"   autocomplete="off" tabindex="32"/></span></td></tr></table></td></tr><tr><td colspan="2" height="10"></td></tr><tr><td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="6%" >&nbsp;</td><td width="3%" >&nbsp;</td><td width="32%" class="hdtext-car-formsub" >City</td><td width="59%" ><select name="off_City" id="off_City" class="hdtext-select-car" tabindex="31" onchange="addOtherCity();  "><?=plgetCityList($_SESSION["off_City"])?></select></td></tr></table></td><td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="7%" >&nbsp;</td><td width="1%" >&nbsp;</td><td width="31%" class="hdtext-car-formsub" >State</td><td width="58%" ><?php echo getCityField("off_State","hdtext-select-car",$_SESSION["off_State"]); ?></td></tr></table></td></tr><tr><td colspan="2" height="10"></td></tr><tr><td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="7%" >&nbsp;</td><td width="1%" >&nbsp;</td><td width="31%" class="hdtext-car-formsub" >PIN Code </td><td width="58%" ><input type="text" name="pincode" id="pincode" class="hdtext-input-car" onFocus="addResiField3();"  autocomplete="off" tabindex="27"/></td></tr></table></td><td>&nbsp;</td></tr></table>';
	return true;
}	

function addResiField3()
{
//	alert("sasda");
	var ni3 = document.getElementById('addMoreFields3');
		ni3.innerHTML = '<table width="530" border="0" cellspacing="0" cellpadding="0"><tr><td colspan="2" height="10"></td></tr><tr><td colspan="2" height="25" class="hdtext-formsub">Verification/Authentication</td></tr><tr><td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="7%" >&nbsp;</td><td width="1%" >&nbsp;</td><td width="31%" class="hdtext-car-formsub" >Coupon Code</td><td width="58%" ><input type="text" name="coupon_code" id="coupon_code" class="hdtext-input-car" maxlength="8" autocomplete="off" tabindex="34"  /></td></tr></table></td><td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="7%" >&nbsp;</td><td width="1%" >&nbsp;</td><td width="31%" class="hdtext-car-formsub" >Enter the Code</td><td width="58%" >&nbsp;</td></tr><tr><td >&nbsp;</td><td >&nbsp;</td><td class="hdtext-car-formsub" valign="middle"  height="40"><img src="/captchahttps.php" alt=""></td><td class="hdtext-car-formsub" valign="middle" height="40"><input type="text" name="captcha0" id="captcha0" class="hdtext-captcha-car" autocomplete="off" maxlength="4" tabindex="35"  /></td></tr></table></td></tr><tr><td colspan="2" height="5"></td></tr><tr><td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td width="7%" >&nbsp;</td><td width="2%" >&nbsp;</td><td width="53%" class="hdtext-car-formsub" >Verify you mobile No.</td><td width="38%" ><input type="text" name="otp_code" id="otp_code" class="hdtext-varify-car" autocomplete="off" tabindex="36" maxlength="6" /></td></tr></table></td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td class="hdtext-car-formsub"><input type="checkbox" name="accept" id="accept" tabindex="38" />I read &amp; agree to <a href="https://www.deal4loans.com/hdfc-termsconditions.php" style="text-decoration:none;" target="_blank">terms and conditions</a></td><td><input type="submit" style="border: 0px none ; background-image: url(images/<?php echo $model; ?>-get-quote-btn.png); width: 142px; height: 45px; margin-bottom: 0px;" tabindex="39" value=""/></td></tr></table>';
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
				ajaxRequestMain.open("GET", "activate_hdfchttscl.php" + queryString, true);
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

<link href="https://www.deal4loans.com/hdfc-car-loan-form-styles.css" type="text/css"  rel="stylesheet" />

<!--[if lt IE 8]>
<link href="https://www.deal4loans.com/hdfc-car-loan-form-styles-ie.css" type="text/css"  rel="stylesheet" />

<![endif]-->
</head>
<body>
<div class="main-wrapper">
<div align="left" style="padding-left:5px;"><img src="images/newimages/hdfc-logo-white.jpg" border="0" height="85" width="193"></div>
<div style="float:right; width:800px; margin-top:-55px;"><div style="vertical-align:bottom;  padding-left:5px;" ><span class="<?php echo $model; ?>-heading_A" style="font-size:20px;">HDFC Bank offers you complete package of <span class="<?php echo $model; ?>-heading_B" style="font-size:20px;">timely service</span>,</span>
  <span style="color:#CCCCCC">  
  <h1 class="<?php echo $model; ?>-heading_B" style="font-size:20px;">Competitive rates &amp; Competent guidance <span class="<?php echo $model; ?>-heading_A" style="font-size:20px;">along with 100% finance on select models.  </span></h1>
  </span></div></div>
<div style="clear:both;"></div>
<div class="<?php echo $model; ?>-vehicle_box_left">
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td class="vehicle_heading_text" valign="top" style="height:30px;"><?php echo $hdfc_car_name; ?></td>
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
<form  method="POST" action="car-loan-hdfc-bank-step3.php" name="hdfc_calc" onSubmit="return submitform(document.hdfc_calc);" >
<input type="hidden" name="stat_code" id="stat_code" readonly>
<input type="hidden" name="car_name" id="car_name" value="<?php echo $hdfc_car_name; ?>">
<input type="hidden" name="Source" id="Source" value="car-loan-hdfc">
  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="35" valign="middle" class="hdtext-form"><strong>Share your details to get quote</strong></td>
    </tr>
   
    <tr>
      <td height="7"></td>
    </tr>
    <tr>
      <td><table width="525" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
      <td height="45" colspan="5" class="hdtext-formsub">Personal Details</td>
    </tr>  
      <tr>
          <td width="15">&nbsp;</td>
          <td width="4">&nbsp;</td>
          <td width="85" class="hdtext-car-formsub">Name</td>
          <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="12%"><table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td><select name="name_abbr" class="hdtext-mrs-car" id="name_abbr" tabindex="7">
                    <option value="Mr" <?php if($_SESSION['name_abbr']=="Mr") echo "selected"; ?>>Mr.</option>
                    <option value="Ms" <?php if($_SESSION['name_abbr']=="Ms") echo "selected"; ?>>Ms.</option>
                    <option value="Mrs" <?php if($_SESSION['name_abbr']=="Mrs") echo "selected"; ?>>Mrs.</option>
                    <option value="Dr" <?php if($_SESSION['name_abbr']=="Dr") echo "selected"; ?>>Dr.</option>
                  </select></td>
                </tr>
              </table></td>
              <td width="88%"><div class="oneline_inputwrapper"><table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input type="text" name="FName" id="FName" style="color:#888; border:none;" class="hdtext-mrs-inputb-car" onblur="inputBlur(this); onBlurDefault(this,'firstname');" onfocus="inputFocus(this); onFocusBlank(this,'firstname');" value="<?php if(strlen($_SESSION['FName'])>0) { echo $_SESSION['FName']; } else {?>firstname<?php } ?>" tabindex="8" /></td>
    <td><input type="text" name="MName" id="MName" style="color:#888; border:none;" class="hdtext-mrs-input-car" onfocus="inputFocus(this); onFocusBlank(this,'middlename');" onblur="inputBlur(this); " value="<?php if(strlen($_SESSION['MName'])>0) { echo $_SESSION['MName']; } else {?>middlename<?php } ?>" tabindex="9"  /></td>
    <td><input type="text" name="LName" id="LName" style="color:#888; border:none;" class="hdtext-mrs-inputb-car" onblur="inputBlur(this); onBlurDefault(this,'lastname');" onfocus="inputFocus(this); onFocusBlank(this,'lastname');" value="<?php if(strlen($_SESSION['LName'])>0) { echo $_SESSION['LName']; } else {?>lastname<?php } ?>" tabindex="10" /></td>
  </tr>
</table></div></td>
            </tr>
          </table>          
            </tr>
        <tr>
          <td colspan="5" height="10"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td class="hdtext-car-formsub">Mobile No.<span style="color:#FF0000;">*</span></td>
          <td width="158" class="hdtext-car-formsub"><input type="text" name="Phone" id="Phone" class="hdtext-input-car" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="16" onChange="intOnly(this); insertstat_code();"  autocomplete="off" value="<?php echo $_SESSION['Phone'];?>"  />
            </td> 
          <td width="263"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="15">&nbsp;</td>
              <td width="4">&nbsp;</td>
              <td width="92" class="hdtext-car-formsub">Email </td>
              <td width="152">
<input type="text" name="Email" id="Email" class="hdtext-input-car" tabindex="18" onChange="insertstat_code();" autocomplete="off" value="<?php echo $_SESSION['Email'];?>" />
</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="5" height="10"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td class="hdtext-car-formsub">Net Salary<span style="color:#FF0000;">*</span> </td>
          <td><input type="text" name="Net_Salary" id="Net_Salary" class="hdtext-input-car" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" autocomplete="off" tabindex="19" onFocus="addResi();" value="<?php echo $_SESSION['Net_Salary'];?>"  /></td>
          <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="15">&nbsp;</td>
              <td width="4">&nbsp;</td>
              <td width="93" class="hdtext-car-formsub">Loan Amount</td>
              <td width="151"><input type="text" name="Loan_Amount" id="Loan_Amount" class="hdtext-input-car" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="4"  value="<?php echo $_SESSION['Loan_Amount'];?>" /></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="5" height="10" ></td>
          </tr>
        <tr>
          <td><strong>&nbsp;</strong></td>
          <td>&nbsp;</td>
          <td class="hdtext-car-formsub" >DOB </td>
          <td>
<input name="dd" id="dd" type="text" maxlength="2" style="color:#888;" class="hdtext-dd-inputb-car" onBlur="inputBlur(this); onBlurDefault(this,'DD');" onFocus="inputFocus(this); onFocusBlank(this,'DD');" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_dd();" onKeyPress="intOnly(this);" tabindex="13"  value="<?php if(strlen($_SESSION['dd'])>0) { echo $_SESSION['dd']; } else {?>DD<?php } ?>">	

<input name="mm" id="mm" type="text" maxlength="2" style="color:#888;" class="hdtext-dd-inputb-car" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_mm();" onKeyPress="intOnly(this);" onBlur="inputBlur(this); onBlurDefault(this,'MM');" onFocus="inputFocus(this); onFocusBlank(this,'MM');" tabindex="14" value="<?php if(strlen($_SESSION['mm'])>0) { echo $_SESSION['mm']; } else {?>MM<?php } ?>"/> <input name="yyyy" id="yyyy" type="text" maxlength="4" style="color:#888;" class="hdtext-yy-inputb-car" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_yyyy();" onKeyPress="intOnly(this);" onBlur="inputBlur(this); onBlurDefault(this,'YYYY');" onFocus="inputFocus(this); onFocusBlank(this,'YYYY');" tabindex="15" value="<?php if(strlen($_SESSION['yyyy'])>0) { echo $_SESSION['yyyy']; } else {?>YYYY<?php } ?>"/>
       </td>
          <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="15">&nbsp;</td>
              <td width="4">&nbsp;</td>
              <td width="93" class="hdtext-car-formsub">Gender</td>
              <td width="151" class="hdtext-car-formsub"><input type="radio" name="Gender" id="Gender" value="Male" checked tabindex="11" /> Male 
            <input type="radio" name="Gender" id="Gender" value="Female" tabindex="12" /> Female</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td colspan="5" height="10" ></td>
          </tr>
        <tr>
          <td ><strong>&nbsp;</strong></td>
          <td >&nbsp;</td>
          <td class="hdtext-car-formsub" >Educational Qualification </td>
          <td ><strong>
            <select name="Education" class="hdtext-select-car" tabindex="19">
<option value="">Select</option>
<option value="PhD" <?php if($_SESSION['Education']=="PhD") echo "selected"; ?>>PhD</option>
<option value="Master" <?php if($_SESSION['Education']=="Master") echo "selected"; ?>>Master</option>
<option value="Bachelor" <?php if($_SESSION['Education']=="Bachelor") echo "selected"; ?>>Bachelor</option>
<option value="College" <?php if($_SESSION['Education']=="College") echo "selected"; ?>>College</option>
<option value="High School" <?php if($_SESSION['Education']=="High School") echo "selected"; ?>>High School</option>
<option value="School" <?php if($_SESSION['Education']=="School") echo "selected"; ?>>School</option>
</select>
          </strong></td>
          <td ><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="15">&nbsp;</td>
              <td width="4">&nbsp;</td>
              <td width="106" class="hdtext-car-formsub">No of Dependents </td>
              <td width="138"><input type="text" name="no_dependents" id="no_dependents" onfocus="addResiField1();" class="hdtext-dependents-inputb-car" maxlength="3" tabindex="17" autocomplete="off"  value="<?php echo $_SESSION['no_dependents'];?>" /></td>
            </tr>
          </table></td>
        </tr>
      <tr>
          <td colspan="5" height="10" ></td>
          </tr>
       </table></td>
    </tr>
    <tr>
      <td><table width="529" border="0" align="center" cellpadding="0" cellspacing="0">

<tr>
          <td colspan="5" id="addMoreFields1" ><table width="530" border="0" cellspacing="0" cellpadding="0"><tr>
          <td colspan="5" height="10" ></td>
        </tr> <tr><td height="35" class="hdtext-formsub" colspan="5" style="background-color:#CCCCCC; color:#000; padding:3px; ">Professional Details</td></tr><tr>
          <td colspan="5" height="10"></td>
        </tr></table></td></tr>

<tr>
          <td colspan="5" id="addMoreFields2" ><table width="530" border="0" cellspacing="0" cellpadding="0"><tr>
          <td colspan="5" height="10" ></td>
        </tr> <tr><td height="35" class="hdtext-formsub" colspan="5" style="background-color:#CCCCCC; color:#000; padding:3px; ">Correspondance Address</td></tr><tr>
          <td colspan="5" height="10"></td>
        </tr></table></td></tr>


<tr>
          <td colspan="5" id="addMoreFields3" ><table width="530" border="0" cellspacing="0" cellpadding="0"><tr>
          <td colspan="2" height="10" ></td>
        </tr><tr><td colspan="2" height="10"></td></tr><tr><td colspan="2" height="35" class="hdtext-formsub"  style="background-color:#cccccc; color:#000000; padding:3px;">Verification/Authentication</td></tr><tr>
          <td colspan="2" height="30" >&nbsp;</td>
        </tr><tr>
              <td class="hdtext-car-formsub">
                <input type="checkbox" name="checkbox" id="checkbox" tabindex="38"  />
              
                I read &amp; agree to <a href="https://www.deal4loans.com/hdfc-termsconditions.php" style="text-decoration:none;" target="_blank">terms and conditions</a></td>
              <td><img src="images/<?php echo $model; ?>-get-quote-btn.png" width="142" height="45" border="0" /></td>
            </tr></table>
</td></tr>        

        <tr>
          <td colspan="5" height="10" ></td>
        </tr>
      </table></td>
    </tr>
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
<div align="right"><img src="images/newimages/powered_by_deal4loans_text.png" height="18" width="186" border="0"></div>
</div>
</div>
</body>
</html>