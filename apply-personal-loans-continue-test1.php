<?php
	require 'scripts/session_check.php';
	require 'scripts/functions.php';
//cho "uh";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/tooltip.js"></script>

<style type="text/css">

.font10 {
font-size:10px;
line-height:13px;
}
.fontbld10 {
font-size:10px;
font-weight:bold;
line-height:12px;
}

#dhtmltooltip{
position: absolute;
left: -300px;
width: 320px;
border: 1px solid black;
padding: 2px;
background-color: #fff3be;
visibility: hidden;
z-index: 100;
/*Remove below line to remove shadow. Below line should always appear last within this CSS*/
filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);
}
 


</style>
<script Type="text/javascript">
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

		function taxinsertData()
		{
			var get_netSalary = document.getElementById('netSalary').value;
			var get_DOB = document.getElementById('DOB').value;
			var get_agecalc = document.getElementById('agecalc').value;
			
			
			if(get_netSalary!='')
			{
				var queryString = "?netSalary=" + get_netSalary + "&dob=" + get_DOB + "&agecalc=" + get_agecalc ;
			}
			
			//alert(queryString); 
				ajaxRequest.open("GET", "insert_pension_premimum.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
					
						var ajaxDisplay = document.getElementById('calculate');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					   

				
					}
				}

				ajaxRequest.send(null); 
			 
		}

		window.onload = ajaxFunction;
		</script>

</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" >
 
<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Personal Loan through Deal4loans.com. You will soon receive a call from us.</h1>
<div align="center"><b>Your EMI and Rates quotes for the Personal Loan from partner Banks are listed Below.

</b></div>

<table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#dbf2ff" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" background="new-images/pl-thnk-hdr2.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
            <td width="140" height="35" class="fontbld10">Bank Name</td>
            <td width="101" class="fontbld10">Interest
Rate</td>
            <td width="204" class="fontbld10">EMI (Per Lac) </td>
            <td width="170" class="fontbld10">Maximum Loan Eligibility</td>
            <td width="112" class="fontbld10">EMI (Per month)</td>
            <td width="69" class="fontbld10">Tenure</td>
            <td width="164" class="fontbld10">Pending Documents</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="57" align="center" background="new-images/pl-thnk-bnkbg2.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
            <td width="140" height="30" ><img src="new-images/hl-thnk-hdfc.gif" width="105" height="35" /><br />
HDFC Bank</td>
            <td width="99" class="fontbld10">22%</td>
            <td width="204"  >Rs. 852.07 (Upto Mar 31,2011) Rs.915.87 (from Apr 1,2011 -<br />
Mar 31,2012), Then Rs.899.73</td>
            <td width="173"  >75000</td>
            <td width="112" >2864</td>
            <td width="64" >4</td>
            <td width="168" ><a href="/term-plan-quote.php" onMouseover="ddrivetip('Driving License/Passport/Telephone Bill/Electricity Bill/LIC Policy (Any one of these) and Form16/Appointment Letter (Any one of these) and Latest 3 months salary slip | 6 months bank statement')"; onMouseout="hideddrivetip()">Pending Document</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="57" background="new-images/pl-thnk-bnkbg2.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
            <td width="140" height="30" ><img src="new-images/hl-thnk-hdfc.gif" width="105" height="35" /><br />
      HDFC Bank</td>
            <td width="99" class="fontbld10">22%</td>
            <td width="204"  >Rs. 852.07 (Upto Mar 31,2011) Rs.915.87 (from Apr 1,2011 -<br />
      Mar 31,2012), Then Rs.899.73</td>
            <td width="173"  >75000</td>
            <td width="112" >2864</td>
            <td width="64" >4</td>
            <td width="168" ><a href="/term-plan-quote.php" onmouseover="ddrivetip('Driving License/Passport/Telephone Bill/Electricity Bill/LIC Policy (Any one of these) and Form16/Appointment Letter (Any one of these) and Latest 3 months salary slip | 6 months bank statement')"; onmouseout="hideddrivetip()">Pending Document</a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="57" background="new-images/pl-thnk-bnkbg2.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
            <td width="141" height="30"><img src="new-images/hl-thnk-citibnk.jpg" width="105" height="35" /><br />
Citibank</td>
            <td   bgcolor="#FFFFFF" height="53" colspan="6"><b>Get Quote on call from Bank</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="959" height="11" valign="top"><img src="new-images/hl-thnk-btm.jpg" width="959" height="11" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<br />


  </div>
</div> 
 

</body>
</html>

