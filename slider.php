<?php
require 'scripts/db_init.php';
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Sliders</title>
	<link href="icici_car/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="ICICI_CL/base/jquery.ui.all.css">
	<script src="scripts/common.js"></script>
	<script src="ICICI_CL/jquery-1.4.4.js"></script>
	<script src="ICICI_CL/jquery.ui.core.js"></script>
	<script src="ICICI_CL/jquery.ui.widget.js"></script>
	<script src="ICICI_CL/jquery.ui.mouse.js"></script>
	<script src="ICICI_CL/jquery.ui.slider.js"></script>
    <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
	<Script Language="JavaScript">
function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}

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
	
function newcomplete_div()
{
	var get_roi = document.getElementById('get_roi').value;
	var get_tenure = document.getElementById('amount1').value;
	var get_amount_invest = document.getElementById('amount_invest').value;		
	var get_day = document.getElementById('day').value;		
	var get_month = document.getElementById('month').value;		
	var get_year = document.getElementById('year').value;			
			
	var queryString = "?get_roi=" + get_roi +"&get_tenure=" + get_tenure +"&get_amount_invest=" + get_amount_invest +"&get_day=" + get_day +"&get_month=" + get_month  +"&get_year=" + get_year ;
	//alert(queryString);
			
  $('#complete_div').html('<p style="position:absolute; z-index:100; left:550px; top:130px;"><img src="new-images/new-ajax-loader.gif" /></p>');
  $('#complete_div').load("get_slider_info.php" + queryString);
}

window.onload = ajaxFunctionMain;
	
</script>
	<script>
	$(function() {
		$( "#slider-range-min" ).slider({
			range: "min",
			value: 8.25,
			min: 5.5,
			step: .25,
			max:  11,
			slide: function( event, ui ) {
				$( "#get_roi" ).val( "" + ui.value + "" );
			}
		});
		$( "#get_roi" ).val( "" + $( "#slider-range-min" ).slider( "value" ) );
	});
	</script>

	<script>
	$(function() {
		$( "#slider-range-min1" ).slider({
			range: "min",
			value: 13,
			step: 1,
			min: 0,
			max: 120,
			slide: function( event, ui ) {
				$( "#amount1" ).val( "" + ui.value );
			}
		});
		$( "#amount1" ).val( "" + $( "#slider-range-min1" ) .slider( "value" ) );
	});

	</script>
</head><body>

<table width="370" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td>
<form name="icici_form" action="slider.php" onSubmit="return submitform(document.icici_form);" method="post">
<table width="100%" cellpadding="0" border="0">
 <tr>
   <td height="30" rowspan="2">&nbsp;</td>
   <td width="57%" rowspan="2" align="right" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td align="left" >&nbsp;</td>
       <td align="right">&nbsp;</td>
     </tr>
     <tr>
       <td align="left" class="verdred12" >Name</td>
       <td align="right" style="padding-bottom:10px;"><input type="text" name="full_name" id="full_name" /></td>
     </tr>
      <tr>
       <td align="left" class="verdred12" >Email</td>
       <td align="right" style="padding-bottom:10px;"><input type="text" name="email" id="email" /></td>
     </tr>
      <tr>
       <td align="left" class="verdred12" >Mobile</td>
       <td align="right" style="padding-bottom:10px;"><input type="text" name="mobile" id="mobile" /></td>
     </tr>
     <tr>
       <td align="left" class="verdred12" >Date of Birth</td>
       <td align="right" style="padding-bottom:10px;"> <input name="day" type="text" id="day"  value="dd" style="width:32px;" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;&nbsp;
                <input  name="month" type="text" id="month" style="width:32px;" value="mm" onBlur="onBlurDefault(this,'mm');" onFocus="onFocusBlank(this,'mm');" maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;&nbsp;
                <input name="year" type="text" id="year" style="width:49px;" value="yyyy" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onChange="insertData();"/></td>
     </tr>
     <tr>
       <td align="left" class="verdred12" >Amount to Invest</td>
       <td align="right" style="padding-bottom:10px;"><input type="text" name="amount_invest" id="amount_invest" onChange="intOnly(this);"  onkeyup="intOnly(this); getDigitToWords('amount_invest','formatedIncome','wordIncome');" onKeyPress="intOnly(this);"  onblur="getDigitToWords('amount_invest','formatedIncome','wordIncome');" maxlength="10" value="500000"  /></td>
     </tr>
      <tr align="left">
		 <td colspan="2"><span id='formatedIncome' style='font-size:11px; color:666699; '></span><span id='wordIncome' style='font-size:11px; color:666699; capitalize;'></span></td>
	 </tr>
     <tr>
       <td width="54%" align="left"  class="verdred13">Rate of Interest:</td>
       <td width="46%" align="right"  class="verdred13"><input type="text" id="get_roi" style="border:0px; width:65px; text-align:right;" readonly class="verdred13" /> %</td>
     </tr>
   </table></td>
   <td align="left" style="font-size:9px; "></td>
 </tr>
 <tr>
   <td align="left" style="font-size:9px; "></td>
 </tr>
 <tr><td width="19%"></td><td height="15">
<div id="slider-range-min" onClick="newcomplete_div();" onChange="newcomplete_div();" onMouseUp="newcomplete_div();"></div>
</td><td width="24%" align="right"></td></tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="2" align="left" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
      <td width="57%" class="verdblk9"><b>Min:</b> 5.5%</td>
      <td width="43%" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b "><b>Max:</b> 11%</td>
     </tr>
  </table></td>
  </tr>
<tr>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td align="right">&nbsp;</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="50%" align="left"  class="verdred13">Tenure:</td>
      <td width="50%" align="right" class="verdred13"><input type="text" id="amount1" style="border:0;width:65px; text-align:right;" class="verdred13" readonly /> months</td>
    </tr>
  </table></td>
  <td align="right">&nbsp;</td>
</tr>
<tr><td width="19%">&nbsp;</td><td>
<div id="slider-range-min1" onClick="newcomplete_div();" onChange="newcomplete_div();" onMouseUp="newcomplete_div();"></div>
</td><td width="24%" align="right">&nbsp;</td></tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="2" align="left" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif;  color:#5b5b5b "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="55%" class="verdblk9"><b>Min:</b> 0 Months</td>
      <td width="45%" class="verdblk9"><b>Max:</b> 120 Months</td>
    </tr>
  </table></td>
  </tr>
  <tr><td>&nbsp;</td><td width="370"> <div style=" float:left; width:360px;" id="complete_div">
  <?php
  $fields = "1_2yrabove50 as rate";
  $valuables = " 1_2yrabove50 = '8.25'" ; 
  $sql = "select ".$fields.",fd_bankID from fd_interestrates where ".$valuables." and status=1"; 
	 list($num,$query)=MainselectfuncNew($sql,$array = array());
	$print = '<table width="350" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td style="border:1px solid #666666;" >';
	$print .= "<table cellpadding='0' cellspacing='0' border='0' width='100%'>";
	for($i=0;$i<$num;$i++)
	{
		$rate ='';
		$fd_bankID = $query[$i]['fd_bankID'];
		$rate = $query[$i]['rate'];
		$bankNameSql = "select * from fd_interestrate_bank where fd_bankID='".$fd_bankID."'";
		 list($num1,$bankNameQuery)=MainselectfuncNew($bankNameSql,$array = array());
		$bankName = $bankNameQuery[0]['fd_bank'];
		$banklogo = $bankNameQuery[0]['logo'];
		
		$print .= "<tr><td style='padding:2px;'>";
		$print .= "<img src='".$banklogo."' border='0'>"; 
		$print .= "</td>";
		$print .= "<td class='verdred12' style='padding:2px;' valign='bottom'>";
		$print .= $bankName; 
		$print .= "</td>";
		$print .= "<td class='verdred12' style='padding:2px;' valign='bottom'>";
		$print .= $rate;
		$print .= " %</td></tr>";
	
	}
	$print .= "</table>";
	$print .= "</td></tr>";
	$print .= "</table>";	
	echo $print;	?></div></td><td >&nbsp;</td></tr>
  <tr><td>&nbsp;</td><td align="right"><input type="submit" name="Submit" value="submit"></td><td>&nbsp;</td></tr>
</table>
</form></td></tr></table>
</td>
</tr>
</table>
</td>
</tr>
<tr>
    <td height="71" colspan="2" align="center" background="icici_car/quote-bg.gif" style="background-repeat:no-repeat; background-position:center; ">

   </td>
</tr>
</table>

</body></html>