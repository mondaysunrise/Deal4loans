<? 
require 'scripts/db_init.php';
require 'scripts/functions.php';
$car_name = $_REQUEST['car_name'];
if($car_name=='Input Make & Model of car (ex. Nissan Micra)')
{
	$car_name = 'Renault Duster 1.5 Rxe';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="navy-color-HDFC-Bank-offers-styles.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-stages.js"></script>
 <script>
/*$(function() {
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
});*/

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
<body><div class="navy-main-continer">
<div class="navy-header"><div style=" padding:20px 0px 0px 0px;"><span class="navy-body_text_a">HDFC Bank offers you complete package of timely service,</span>
    <br />
    <span class="navy-body_text_b">Competitive rates & Competent guidance </span><span class="navy-body_text_c">along with 100% finance on select models.</span></div>	</div>
    <div class=" chhose-car"><div class="chhose-car-bg"></div>
    </div>
    <div class="form-section">
	<form  method="POST" action="hdfc-car-loan-app-offers_nw_continue.php" name="hdfc_calc"  onSubmit="return submitform(document.hdfc_calc);" >
<input type="hidden" name="stat_code" id="stat_code" tabindex=15>
    <table width="668" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td class="form_body_text">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="43">&nbsp;</td>
    <td width="20" align="left"><img src="new-images/hdfcapp/navy-blue-bullet.png" width="15" height="15" /></td>
    <td width="488" align="left" class="form_body_text">Make &amp; Model of car</td>
    <td width="117">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	
<input type="text" name="car_name" id="car_name" style="width:245px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; "  value="<?php echo $car_name; ?>" readonly="readonly" tabindex="1"/>
	 
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td>
    <td height="25" align="left" valign="middle" class="form_body_text" id="show_rumprice">Ex-showroom price of car (indicative prices)</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td height="35" class="form_body_text" valign="top"><label>
              <div id="car_price_pop" class="inputtext" style="width:300px;"><? $sql = "Select hdfc_car_price_delhi,hdfc_car_price from hdfc_car_list_category Where hdfc_car_name='".$car_name."'";
		$result = ExecQuery($sql);
		$row=@mysql_fetch_array($result);
		if($city=="Delhi")
	{
		$car_price =$row["hdfc_car_price_delhi"];
	}
		else
	{
		$car_price =$row["hdfc_car_price"];
	}
	
	echo "Rs. ".number_format($car_price);	?></div>
              </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>    <td >&nbsp;</td>    <td colspan="2" align="left" class="form_head_text" id="plz_show_price" >Share your employment details to get quote</td>    <td>&nbsp;</td>  </tr> 
  <tr align="left">    <td colspan="4" class="lining">&nbsp;</td> </tr> 
  
  <tr> <td colspan="4" align="center"><table width="668" border="0" align="center" cellpadding="0" cellspacing="0"> <tr>     <td width="44">&nbsp;</td>   <td width="20" align="left"><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td> <td width="302" align="left" class="form_body_text">Occupation
    </td>  <td width="24"><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td>   <td width="278" align="left" class="form_body_text">Company Name</td>  </tr> 
  
  <tr>  
  <td>&nbsp;</td>  <td>&nbsp;</td>  <td align="left"><select name="Employment_Status" id="Employment_Status" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" class="inputtext" tabindex="2"><option value="">Please Select</option>
	<option value="1">Salaried</option>
	<option value="2">Self Employed</option>
    </select></td>        
  <td>&nbsp;</td>   <td align="left"><input type="text" name="Company_Name" id="Company_Name" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; "  value="Type slowly for autofill" onblur="onBlurDefault(this,'Type slowly for autofill'); "  onfocus="onFocusBlank(this,'Type slowly for autofill');" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/hdfcajax-cmplist-cl.php')" tabindex="3"/></td> </tr> 
  <tr> <td>&nbsp;</td>        <td>&nbsp;</td>  <td>&nbsp;</td>  <td>&nbsp;</td>  <td>&nbsp;</td>  </tr>
  <tr>     <td width="44">&nbsp;</td>   <td width="20" align="left"><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td> <td width="302" align="left" class="form_body_text">Annual Income</td>  <td width="24"><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td>   <td width="278" align="left" class="form_body_text">Total Experience</td>  </tr>
<tr>  
	<td>&nbsp;</td> 
	<td>&nbsp;</td>
	<td align="left"> <input type="text" name="Net_Salary" id="Net_Salary" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>       
	<td>&nbsp;</td>  
	<td align="left"><input type="text" name="Experience" id="Experience" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; "   onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="5"/></td> 
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
	    <td colspan="4" >
		<table width="100%" border="0" cellpadding="0" cellspacing="0">  
		 <tr>    	
		        <td width="53%" align="left" class="form_head_text"> Personal information</td> <td width="4%" valign="middle"><img src="new-images/hdfcapp/personal-security.png" width="14" height="16" /></td>     <td width="43%" align="left" class="form_body_text">We keep this secure</td>    </tr>    </table></td> </tr>
  <tr>     <td colspan="5" class="lining">&nbsp;</td>  </tr>    <tr> 
   <td>&nbsp;</td>    <td ><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td>   <td align="left" class="form_body_text" >Name</td>  <td align="left" ><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td>   <td align="left" ><span class="form_body_text">Mobile Number</span></td>   </tr> 
<tr> 
	<td>&nbsp;</td> 
	<td >&nbsp;</td>  
	<td align="left" >		<input type="text" name="Name" id="Name" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " tabindex="6"/></td>   
	<td >&nbsp;</td>     
	<td align="left"><table width="80%" border="0" cellpadding="0" cellspacing="0" align="left"> 
<tr> 
<td width="15%">			<div style="width:20px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; font-size:12px; font-family:Arial, Helvetica, sans-serif;">+91</div></td>       
 <td width="85%" align="left"><input type="text" name="Phone" id="Phone" style="width:125px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; " maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="7" onchange="intOnly(this); insertstat_code();" /></td>     
  </tr>    
    </table> 
	         </td> 
			    </tr>
	<tr>     
	<td>&nbsp;</td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>  
	<td >&nbsp;</td>        
	<td >&nbsp;</td>   
</tr> 
<tr>     
	<td>&nbsp;</td>    
	<td ><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td>   
	<td align="left" class="form_body_text" >E-mail</td>     
	<td align="left" ><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td>   
	<td align="left" ><span class="form_body_text">City</span></td>  
</tr>
<tr> 
	<td>&nbsp;</td> 
	<td >&nbsp;</td> 
	<td align="left" ><input type="text" name="Email" id="Email" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" tabindex="8" onchange="insertstat_code();" /> 	</td>  
	<td >&nbsp;</td>    <td align="left" ><select name="City" id="City" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" class="inputtext" tabindex="9">        <?=plgetCityList($City)?>       </select></td>
</tr>  
<tr>     
	<td>&nbsp;</td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>  
	<td >&nbsp;</td>        
	<td >&nbsp;</td>   
</tr> 
  <tr>     
<td>&nbsp;</td>  
	<td ><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td>   
	<td align="left" class="form_body_text" >DOB</td>     
	<td ><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td>  
	<td class="form_body_text" >Residence Status</td> 
</tr> 
  
<tr> 
	<td>&nbsp;</td> 
	<td >&nbsp;</td>      
	<td><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr> 
	<td width="14%"><input name="dd" id="dd" type="text" maxlength="2" class="inputtext" onblur="onBlurDefault(this,'DD');" onfocus="onFocusBlank(this,'DD');" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_dd();" onKeyPress="intOnly(this);" tabindex="10" style="width:35px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" value="DD"></td>
	<td width="15%" align="left"><input name="mm" id="mm" type="text" maxlength="2" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_mm();" onKeyPress="intOnly(this);" onblur="onBlurDefault(this,'MM');" onfocus="onFocusBlank(this,'MM');" tabindex="11" style="width:35px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" value="MM"/></td>   
	<td width="71%" align="left">	<input name="yyyy" id="yyyy" type="text" maxlength="4" class="inputtext" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_yyyy();" onKeyPress="intOnly(this);" onblur="onBlurDefault(this,'YYYY');" onfocus="onFocusBlank(this,'YYYY');" tabindex="12" style="width:75px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" value="YYYY"/></td>  
</tr>    
</table></td>  
<td >&nbsp;</td>   
<td ><select name="Residence_Status" id="Residence_Status" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" class="inputtext" tabindex="13">        <option value="0">Please Select</option>
		  	<option value="4">Owned By Self/Spouse</option>
			<option value="1">Owned By Parent/Sibling</option>
			<option value="3">Company Provided</option>
			<option value="5">Rented - With Family</option>
			<option value="6">Rented - With Friends</option>
			<option value="2">Rented - Staying Alone</option>
			<option value="7">Paying Guest</option>
			<option value="8">Hostel</option>      </select></td>      </tr>  
<tr>     
	<td>&nbsp;</td>
	<td >&nbsp;</td>
	<td >&nbsp;</td>  
	<td >&nbsp;</td>        
	<td >&nbsp;</td>   
</tr> 
<tr>     
	<td>&nbsp;</td>       
	<td align="left" ><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td>  
	<td align="left" ><span class="form_body_text">Resi Stability</span></td> 
	<td ><img src="new-images/hdfcapp/navy-blue-bullet.png" alt="" width="15" height="15" /></td>     
	<td class="form_body_text" >Enter Validation Code sent on ur Mobile No.</td>    
	 
</tr>
<tr> 
	<td>&nbsp;</td>  
	<td >&nbsp;</td>  
	<td align="left" ><input type="text" name="Resi_Stability" id="Resi_Stability" style="width:175px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid; "   onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex="14"/></td>
	
	<td >&nbsp;</td>  
	<td ><table width="100%" border="0" cellpadding="0" cellspacing="0">     <tr>            <td width="31%"><input type="text" name="otp_code" id="otp_code"  style="width:75px; height:20px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;" maxlength="5" tabindex="15"/>	</td>            <td width="69%" class="form_body_text"><em>(Verify your Mobile Number)</em></td>    </tr>      </table></td>  
	
</tr>  
  <tr>   
   <td>&nbsp;</td> 
   <td >&nbsp;</td>      
   <td >&nbsp;</td>    
   <td >&nbsp;</td>  
    <td >&nbsp;</td>   
	 </tr>
<tr>       
<td>&nbsp;</td>    
<td>  </td>      
<td class="form_body_text" ><table width="100%" border="0" cellpadding="0" cellspacing="0">     
<tr>            <td width="11%" align="center"><input type="checkbox" name="checkbox" id="checkbox" /></td>    
<td width="89%" align="left">I read &amp; agree to terms and conditions </td> 
</tr>  
</table></td>    
<td colspan="2" align="left" >		<input type="image" name="Submit"  src="new-images/hdfcapp/get-quote.jpg"  style="width:146px; height:50px; border:none; " />		</td></tr>    </table></td>    </tr>  <tr>    <td colspan="4">&nbsp;</td>    </tr>
 </table>
 </form>
    </div>
    <div class="navy-right_panel">
    <div class="navy-testimonials-box">
    <div class="navy-testimonials-box2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
          <td>&nbsp;</td>
        </tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>


<tr>
  <td align="center"><table width="200" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" class="navy-body_text_testimonials">The online application forms are very simple and user-friendly; don't require too much information and one can get a decision almost instantly within the budget ! <br /></td>
    </tr>
  </table></td>
</tr>

<tr>
  <td height="50" class="navy-body_text_testimonials"><strong>Mrs Afsana<br />
    IT Consultant</strong></td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
      </table>
     
    </div>
    </div>
    <div class="navy-features-box" style="margin-top:5px;">
    <p style="padding-top:8px;">Features & Benefits</p>
    <div  class="features_bullet" >
    <ul>
    <li style="margin-top:7px;"><a href="#">Covers the widest range of cars in India.</a></li>
           <li><a href="#">Upto 100% finance on ur favourite car.</a></li>
           <li><a href="#">Repay with easy EMIs. </a></li>
           <li><a href="#">Attractive Interest rates.</a></li>
           <li><a href="#">Hassle-free documentation.</a></li>
    </ul>
    </div>
    </div>
    <div class="navy_features_shadow"></div>
    <div class="navy-welcome-rewards-box">
    <div style="width:100%; height:35px; background:url(new-images/hdfcapp/navy-welcome-rewards-top-bg.gif) repeat-x; text-align:center"><p style="padding-top:8px;text-align:center">Welcome Rewards</p></div>
    <div class="navy-welcome-rewards-img">
      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="55%">&nbsp;</td>
          <td width="45%">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><img src="new-images/hdfcapp/image1.jpg" width="110" height="85" /></td>
          <td valign="bottom"><a href="#"><img src="new-images/hdfcapp/navy-know-more.jpg" width="83" height="26" border="0" /></a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    </div>
    
    </div>
    <div style="clear:both;"></div>
<div class="navy-footer"></div>
</div>
</body>
</html>
