<? require 'scripts/db_init.php';
require 'scripts/functions.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="ajax.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="ajax-dynamic-stages.js"></script>
	<script src="ICICI_CL/jquery-1.4.4.js"></script>
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
	form{
		display:inline;
	}
	</style>
<script>
//validations
function frm_validation()
{
	if (document.hdfc_calc.City.selectedIndex==0)
	{
		alert("Kindly select current city you live in!");
		document.hdfc_calc.City.focus();
		return false;
	}
	if (document.hdfc_calc.income.value=="")
	{
		alert("Kindly enter monthly gross salary!");	
		document.hdfc_calc.income.focus();
		return false;
	}	
if(document.hdfc_calc.day.value=="" || document.hdfc_calc.day.value=="DD")
	{
		alert("Kindly enter Date of birth!");	
		document.hdfc_calc.day.focus();
		return false;
	}
	if(document.hdfc_calc.day.value!="")
	{
		if((document.hdfc_calc.day.value<1) || (document.hdfc_calc.day.value>31))
		{
			alert("Kindly enter Date of birth!");	
			document.hdfc_calc.day.focus();
			return false;
		}
	}
	if(!checkData(document.hdfc_calc.day, 'Day', 2))
		return false;
	
	if(document.hdfc_calc.month.value=="" || document.hdfc_calc.month.value=="MM")
	{
		alert("Kindly enter Mopnth of birth!");	
		document.hdfc_calc.month.focus();
		return false;
	}
	if(document.hdfc_calc.month.value!="")
	{
		if((document.hdfc_calc.month.value<1) || (document.hdfc_calc.month.value>12))
		{
			alert("Kindly enter Month of birth!");	
			document.hdfc_calc.month.focus();
			return false;
		}
	}
	if(!checkData(document.hdfc_calc.month, 'month', 2))
		return false;

	if(document.hdfc_calc.year.value=="" || document.hdfc_calc.year.value=="YYYY")
	{
		alert("Kindly enter Year of birth!");	
		document.hdfc_calc.year.focus();
		return false;
	}
	if(document.hdfc_calc.year.value!="")
	{
		if((document.hdfc_calc.year.value < "<?php echo $maxage;?>") || (document.hdfc_calc.year.value >"<?php echo $minage;?>"))
		{
			alert("Age between 18 -62!");
			document.hdfc_calc.year.focus();
			return false;
		}
	}
	if(!checkData(document.hdfc_calc.year, 'Year', 4))
		return false;

if((document.hdfc_calc.car_name.value=="") || document.hdfc_calc.car_name.value=="Type slowly for autofill")
	{
		alert("Kindly enter Name of car you want!");	
		document.hdfc_calc.car_name.focus();
		return false;
	}

if((document.hdfc_calc.company_name.value=="") || (document.hdfc_calc.company_name.value=="Type slowly for autofill"))
	{
		alert("Kindly enter company name!");	
		document.hdfc_calc.company_name.focus();
		return false;
	}

	if((document.hdfc_calc.company_name.value!=""))
	{
		if(document.hdfc_calc.full_name.value=="")
	{
		alert("Kindly enter your namet!");	
		document.hdfc_calc.full_name.focus();
		return false;
		}
	if(document.hdfc_calc.Phone.value=="")
	{
		alert("Kindly enter your mobile no!");	
		document.hdfc_calc.Phone.focus();
		return false;
	}
	if(isNaN(document.hdfc_calc.Phone.value)|| document.hdfc_calc.Phone.value.indexOf(" ")!=-1)
	{
		alert("Enter numeric value!");	
		document.hdfc_calc.Phone.focus();
		return false;  
	}
	if (document.hdfc_calc.Phone.value.length < 10 )
	{
	  	alert("Kindly enter Enter 10 Digits! mobile no!");		
		document.hdfc_calc.Phone.focus();
		return false;
	}
	if ((document.hdfc_calc.Phone.value.charAt(0)!="9") && (document.hdfc_calc.Phone.value.charAt(0)!="8") && (document.hdfc_calc.Phone.value.charAt(0)!="7"))
	{
	  alert("should start with 9 or 8 or 7!");	
		document.hdfc_calc.Phone.focus();
		return false;
	}
	
	var str=document.hdfc_calc.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		alert("Enter Valid Email Address!");	
		document.hdfc_calc.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Enter Valid Email Address!");	
		document.hdfc_calc.Email.focus();
		return false;
	}
	}

	if(document.hdfc_calc.otp_code.value!="" && document.hdfc_calc.otp_code.value.length<5)
	{
		alert("Enter Valid OTP code!");	
		document.hdfc_calc.otp_code.focus();
		return false;
	}

	if(!document.hdfc_calc.accept.checked)
	{
		alert("Accept terms and conditions!");
		document.hdfc_calc.accept.focus();
		return false;
	}	
}
//end of validations

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

function swtchToNextTab_dd()
{
	if(document.hdfc_calc.day.value!="" && (document.hdfc_calc.day.value.length==2))
	{
		document.hdfc_calc.month.focus();
	}
}

function swtchToNextTab_mm()
{
	if(document.hdfc_calc.month.value!="" && (document.hdfc_calc.month.value.length==2))
	{
		document.hdfc_calc.year.focus();
	}

}

function swtchToNextTab_yyyy()
{
	if(document.hdfc_calc.year.value!="" && (document.hdfc_calc.year.value.length==4))
	{
		document.hdfc_calc.car_name.focus();
	}

}

function swtchToNextTab_crmdl()
{
	if(document.hdfc_calc.car_name.value!="" && (document.hdfc_calc.car_name.value.length>8))
	{
		document.hdfc_calc.company_name.focus();
	}

}


function addcompfilled()
{

var ni1 = document.getElementById('myDiv1');
if((document.hdfc_calc.company_name.value!="") && (document.hdfc_calc.company_name.value!="Type slowly for autofill"))
	{
		ni1.innerHTML ='<table width="100%" cellpadding="2" cellspacing="2" border="0" style="background-color:#E6E6E6;"><tr><td colspan="2" style="background-color:#F7F7F7;" height="30"><table width="90%" align="center"><tr><td width="66%" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#333333;">Personal Information</td><td width="34%" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;  color:#333333;"><img src="new-images/locked-privacy.jpg" width="12" height="14"/> We keep this secure</td></tr></table></td></tr>	<tr style="background-color:#E6E6E6;">		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; border-bottom:1px solid #ffffff; border-right:1px solid #ffffff;"><div align="right">Mobile&nbsp;</div></td>		<td>&nbsp;<input name="std" id="std" type="text" value="+91" size="3" readonly/>&nbsp;<input name="Phone" id="Phone" type="text" style="width:95px;" maxlength="10" tabindex=8 onchange="insertstat_code();"/></td></tr>	<tr style="background-color:#D8D4D4;">		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; border-bottom:1px solid #ffffff; border-right:1px solid #ffffff;" width="290"><div align="right">Name&nbsp;</div></td>		<td style="border-bottom:1px solid #ffffff;">&nbsp;<input name="full_name" id="full_name" type="text" tabindex=9 /></td>	</tr><tr style="background-color:#E6E6E6;">		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; border-right:1px solid #ffffff;"><div align="right">Email ID&nbsp;</div></td>		<td>&nbsp;<input name="Email" id="Email" type="text" tabindex=10 onchange="insertstat_code();"/></td>	</tr><tr style="background-color:#D8D4D4;">		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; border-right:1px solid #ffffff;"><div align="right">Enter Validation Code sent on your Mobile No. </div></td>		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">&nbsp;  <input name="otp_code" id="otp_code" type="text"  tabindex=11  maxlength="5" style="width:70px;"/>(Verify your Mobile Number)</td>	</tr></table>';
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}	



	

$(function() {
$("#car_price_pop").mouseover(function(){
	//alert("hello");
 $.post("get-car-price.php",
  {
    car_name: $("#car_name").val(),
    city:$("#City").val()
  },
  function(data,status){
//    alert("Data: " + data + "\nStatus: " + status);
	 $('#car_price_pop').html(data);
  });
});
});

$(function() {
$("#company_name").focus(function(){
	//alert("hello");
 $.post("get-car-price.php",
  {
    car_name: $("#car_name").val(),
    city:$("#City").val()
  },
  function(data,status){
//    alert("Data: " + data + "\nStatus: " + status);
	 $('#car_price_pop').html(data);
  });
});
});

/*$(function() {
$("#Email").focus(function(){
	//alert("hello");
 $.post("activate_hdfccl.php",
  {
    get_Mobile: $("#Phone").val(),
	stat_code : $("#stat_code").val()
  },
  function(data){
   //alert("Data: " + data);
$('#stat_code').val(data);
	 });
});
});

$(function() {
$("#Email").click(function(){
	//alert("hello");
 $.post("activate_hdfccl.php",
  {
    get_Mobile: $("#Phone").val(),
	stat_code : $("#stat_code").val()
  },
  function(data){
   //alert("Data: " + data);
$('#stat_code').val(data);
	 });
});
});*/

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

<body bgcolor="#f2f2f2" style="margin:0px; padding:0px;">
<table style="background: url(new-images/bckgrnd-hdfccl.gif) no-repeat; background-color:#F7F7F7;" width="929" height="560" align="center" border="0">
<tr><td height="60" colspan="2"></td></tr>
<tr><td height="55" colspan="2" align="right"><img src="new-images/car-pic-hdfccl.jpg" width="920" height="70" /></td></tr>
<tr>
<td align="right" width="270" valign="middle">
	<table width="250" height="365" align="right" cellpadding="5" cellspacing="2" style="border:1px solid #999999;"><tr><td align="center" style="background-color:#F7F7F7; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#333333;" height="30">What people say</td></tr>
	<tr>
	  <td style="background-color:#E6E6E6; font-family:Arial, Helvetica, sans-serif; font-size:12px;">Online application procedure helped me choose the right car & made the entire loan procedure as fast & simple.From start to finish the online procedure & approval process was completely satisfying. Highly recommended for those who are looking for the best deal in no time...<br />
Mr Balbir<br />Sr. Relationship Manager <br /></td></tr>
<tr>
  <td style="background-color:#E6E6E6; font-family:Arial, Helvetica, sans-serif; font-size:12px;">The online application forms are very simple and user-friendly; don't require too much information and one can get a decision almost instantly within the budget ! Good experience, worth giving a  try.<br />
Mrs Afsana<br />IT Consultant<br /></td></tr>
</table></td>
<td width="630"><table width="95%"  align="center" cellpadding="0" cellspacing="0" style="border:1px solid #999999; background-color:#F7F7F7; ">
  <tr>
    <td colspan="2" align="center" style="background-color:#F7F7F7; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#333333;" height="35">Instant Car Loan Eligibility</td>
  </tr>
  <tr>
    <td height="10" style="background-color:#F7F7F7;"><table width="500" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td style="border:1px solid #CCCCCC;"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><form name="hdfc_calc" method="POST" action="hdfc-car-loan-app-continue-offers1.php" onSubmit="return frm_validation();">
	<input type="hidden" name="stat_code" id="stat_code" tabindex=11>
      <table align="center" cellpadding="6"  width="100%">
        <tr style="background-color:#E6E6E6;">
          <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><div align="right">In which city you live currently ?</div></td>
          <td><select name="City" id="City" style="font-family:Verdana, Geneva, sans-serif; " tabindex=1>
            <?=plgetCityList($City)?>
          </select></td>
        </tr>
        <tr style="background-color:#D8D4D4;">
          <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><div align="right">Gross Monthly Salary</div></td>
          <td><input name="income" id="income" type="text" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" tabindex=2 /></td>
        </tr>
        <tr style="background-color:#E6E6E6;">
          <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><div align="right">Date of Birth</div></td>
          <td><input name="day" id="day" type="text" size="4" maxlength=2 value="DD" onblur="onBlurDefault(this,'DD'); " onfocus="onFocusBlank(this,'DD');" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_dd();" onKeyPress="intOnly(this);" tabindex=3/>
            /
            <input name="month" id="month" type="text" size="4" maxlength=2 value="MM" onblur="onBlurDefault(this,'MM');" onfocus="onFocusBlank(this,'MM');" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_mm();" onKeyPress="intOnly(this);" tabindex=4/>
            /
            <input name="year" id="year" type="text" size="7" maxlength=4 value="YYYY" onblur="onBlurDefault(this,'YYYY');" onfocus="onFocusBlank(this,'YYYY');" onChange="intOnly(this);" onKeyUp="intOnly(this); swtchToNextTab_yyyy();" onKeyPress="intOnly(this);" tabindex=5/>          </td>
        </tr>
        <tr style="background-color:#D8D4D4;">
          <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><div align="right">Make & model of car (ex. Nissan Micra)</div></td>
          <td><input name="car_name" id="car_name" type="text"  style="width:200px;" onkeyup="ajax_showOptions(this,'getCarNameByLetters',event, 'http://www.deal4loans.com/hdfcajax-carnlist-cl.php')" value="Type slowly for autofill" onblur="onBlurDefault(this,'Type slowly for autofill'); " onfocus="onFocusBlank(this,'Type slowly for autofill');" tabindex=6 /></td>
        </tr>
        <tr style="background-color:#E6E6E6;">
          <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;" align="right">Ex-showroom price of car (indicative prices) </td>
          <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666666;"><div id="car_price_pop">Based on selected car</div></td>
        </tr>
        <tr style="background-color:#D8D4D4;">
          <td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><div align="right">Company <b>(Pick from our list for best offers)</b></div></td>
          <td width="51%"><input name="company_name" id="company_name" type="text"  style="width:280px;" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/hdfcajax-cmplist-cl.php')" value="Type slowly for autofill" onblur="onBlurDefault(this,'Type slowly for autofill');" onfocus="onFocusBlank(this,'Type slowly for autofill');" onchange="addcompfilled();" tabindex=7/></td>
        </tr>
        <tr>
          <td  id="myDiv1" colspan="2" style="background-color:#E6E6E6;"></td>
        </tr>
		<tr style="background-color:#D8D4D4;">
          <td colspan="2"  align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><input type="checkbox" name="accept" id="accept"> I agree to <a href="">terms and conditions.</a></td>
        </tr>
        <tr style="background-color:#E6E6E6;">
          <td colspan="2" align="right" height="60" style="padding-right:30px;"><input name="submit" type="submit" style="border: 0px none ; background-image: url(new-images/calc_eligibile.gif); width: 220px; height: 49px; margin-bottom: 0px;" value=""/></td>
        </tr>
      </table>
    </form>    </td>
  </tr>
</table>
</tr></td></table>
</body>
</html>
