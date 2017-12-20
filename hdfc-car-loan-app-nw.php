<? require 'scripts/db_init.php';
require 'scripts/functions.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-stages.js"></script>
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

function addcompfilled()
{
	
	//alert("kjo");
var ni1 = document.getElementById('myDiv1');
if((document.hdfc_calc.company_name.value!="") && (document.hdfc_calc.company_name.value!="Type slowly for autofill"))
	{
		ni1.innerHTML ='<table width="100%" cellpadding="2" cellspacing="2" border="0" style="background-color:#E6E6E6;"><tr><td colspan="2" style="background-color:#F7F7F7;" height="30"><table width="90%" align="center"><tr><td width="66%" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#333333;">Personal Information</td><td width="34%" align="right" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;  color:#333333;"><img src="new-images/locked-privacy.jpg" width="12" height="14"/> We keep this secure</td></tr></table></td></tr><tr style="background-color:#E6E6E6;">		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; border-bottom:1px solid #ffffff; border-right:1px solid #ffffff;" width="285"><div align="right">Name&nbsp;</div></td>		<td style="border-bottom:1px solid #ffffff;">&nbsp;<input name="full_name" id="full_name" type="text" /></td>	</tr>	<tr style="background-color:#D8D4D4;">		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; border-bottom:1px solid #ffffff; border-right:1px solid #ffffff;"><div align="right">Mobile&nbsp;</div></td>		<td>&nbsp;<input name="income" id="income" type="text" value="+91" size="3"/>&nbsp;<input name="income" id="income" type="text" style="width:95px;"/></td>	</tr>	<tr style="background-color:#E6E6E6;">		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; border-right:1px solid #ffffff;"><div align="right">EmailIID&nbsp;</div></td>		<td>&nbsp;<input name="income" id="income" type="text" /></td>	</tr></table>';
	}
	else
	{
		ni1.innerHTML = '';
	}
	return true;
}	


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

	function insertcpData()
		{
			var get_car_name = document.getElementById('car_name').value;
			var get_city = document.getElementById('City').value;
			
				var queryString = "?car_name=" + get_car_name + "&city=" + get_city;
				//alert(queryString);
				ajaxRequestMain.open("GET", "get-car-price.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequestMain.onreadystatechange = function(){
					if(ajaxRequestMain.readyState == 4)
					{
						//alert(ajaxRequestMain.responseText);
						document.getElementById('car_price_pop').innerHTML=ajaxRequestMain.responseText;
					}
				}
			ajaxRequestMain.send(null); 
		}
	window.onload = ajaxFunctionMain;
</script>
</head>

<body >
<table style="background: url(new-images/bckgrnd-hdfccl.gif) no-repeat; background-color:#F7F7F7;" width="929" height="520" align="center" border="0">
<tr><td height="55" colspan="2">&nbsp;</td></tr>
<tr>
<td align="right" width="270" valign="middle">
	<table width="250" height="365" align="right" cellpadding="5" cellspacing="2" style="border:1px solid #999999;"><tr><td align="center" style="background-color:#F7F7F7; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#333333;" height="30">What people say</td></tr>
	<tr>
	  <td style="background-color:#E6E6E6; font-family:Arial, Helvetica, sans-serif; font-size:12px;">Making the Home Loan acquisition process faster, simpler and more refreshing the HDFC way! Offering a full range of contemporarily fixed and variable interest rate Car loan schemes, which are competitive with the best in the market. <br />
Mr...<br />designation..<br /></td></tr>
<tr><td style="background-color:#E6E6E6; font-family:Arial, Helvetica, sans-serif; font-size:12px;">Making the Home Loan acquisition process faster, simpler and more refreshing the HDFC way! Offering a full range of contemporarily fixed and variable interest rate Car loan schemes, which are competitive with the best in the market. <br />
Mr...<br />designation..<br /></td></tr>
</table>
</td>
<td width="630">
	<table width="95%"  align="center" cellpadding="0" cellspacing="0" style="border:1px solid #999999; background-color:#F7F7F7; ">
	<tr><td colspan="2" align="center" style="background-color:#F7F7F7; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; color:#333333;" height="35">Instant Car Loan Eligibility</td></tr>
	<tr><td height="10" style="background-color:#F7F7F7;"><table width="500" cellpadding="0" cellspacing="0" align="center"><tr><td style="border:1px solid #CCCCCC;"></td></tr></table></td></tr>
	<tr><td align="center">
	<form name="hdfc_calc" method="POST" action="hdfc-car-loan-app-continue-nw.php" >
	<table align="center" cellpadding="6"  width="100%">
	<tr style="background-color:#E6E6E6;">
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><div align="right">In which city you live currently ?</div></td>
		<td><select name="City" id="City" style="font-family:Verdana, Geneva, sans-serif; " >
								<?=plgetCityList($City)?>
								</select></td>
	</tr>
	<tr style="background-color:#D8D4D4;">
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><div align="right">Gross Monthly Salary</div></td>
		<td><input name="income" id="income" type="text" /></td>
	</tr>
	<tr style="background-color:#E6E6E6;">
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><div align="right">Date of Birth</div></td>
		<td><input name="dd" id="dd" type="text" size="4" maxlength=2 value="DD" onblur="onBlurDefault(this,'DD');" onfocus="onFocusBlank(this,'DD');"/>	/ <input name="mm" id="mm" type="text" size="4" maxlength=2 value="MM" onblur="onBlurDefault(this,'MM');" onfocus="onFocusBlank(this,'MM');"/>  / <input name="yyyy" id="yyyy" type="text" size="7" maxlength=4 value="YYYY" onblur="onBlurDefault(this,'YYYY');" onfocus="onFocusBlank(this,'YYYY');"/> </td>
	</tr>
	<tr style="background-color:#D8D4D4;">
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><div align="right">Make & model of car (ex. Nissan Micra)</div></td>
		<td><input name="car_name" id="car_name" type="text"  style="width:200px;" onKeyUp="ajax_showOptions(this,'getCarNameByLetters',event, 'http://www.deal4loans.com/hdfcajax-carnlist-cl.php')" value="Type slowly for autofill" onblur="onBlurDefault(this,'Type slowly for autofill'); insertcpData();" onfocus="onFocusBlank(this,'Type slowly for autofill');"  onmouseup="insertcpData();" /></td>
	</tr>
	<tr style="background-color:#E6E6E6;"><td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;" align="right">Ex-showroom price of car (indicative prices) </td><td style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#666666;"><div id="car_price_pop">Based on selected car</div></td></tr>
	<tr style="background-color:#D8D4D4;">
		<td style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"><div align="right">Company <b>(Pick from our list for best offers)</b></div></td>
		<td width="51%"><input name="company_name" id="company_name" type="text"  style="width:280px;" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/hdfcajax-cmplist-cl.php')" value="Type slowly for autofill" onblur="onBlurDefault(this,'Type slowly for autofill');" onfocus="onFocusBlank(this,'Type slowly for autofill');" onChange="addcompfilled();"/></td>
	</tr>
	 <tr>
                <td  id="myDiv1" colspan="2" style="background-color:#E6E6E6;">
          </td>
		  </tr>
	<tr style="background-color:#E6E6E6;"><td colspan="2" align="right" height="60" style="padding-right:30px;"><input type="submit" style="border: 0px none ; background-image: url(new-images/calc_eligibile.gif); width: 220px; height: 49px; margin-bottom: 0px;" value=""/></td></tr>
	</table>
	</form>
	</td></tr></table>
</tr></td></table>
</body>
</html>
