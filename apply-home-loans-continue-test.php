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
<style type="text/css">

.tbl_txt {
	color:#373737;
	font-family:Verdana,Arial,Helvetica,sans-serif;
	font-size:11px;
	text-align:center !important;
	padding:2px;
}
.tbl_txt1 {	color:#373737;
	font-family:Verdana,Arial,Helvetica,sans-serif;
	font-size:11px;
	text-align:center !important;
	padding:2px;
}
.style1 {color: #373737; font-family: Verdana,Arial,Helvetica,sans-serif; font-size: 11px; text-align: center; padding: 2px; font-weight: bold; }
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
  <div id="txt" style="padding-top:15px;">
 
<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;"> Thanks for applying Home Loan through Deal4loans.com. You will soon receive a Call from us.<br />
Following Banks are interested in your profile, will get back to you & give you the best Deal..</div>

<table width="959"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#dbf2ff" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="45" background="new-images/hl-thnk-hdr.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
            <td width="157" height="30"><b>Bank Name</b></td>
            <td width="204"><b>ROI</b></td>
            <td width="210"><b>EMI (Per Lac)</b></td>
            <td width="63"><b>Tenure</b></td>
            <td width="96"><b>Eligible Loan Amount</b></td>
            <td width="230"><b>EMI (Per Month)</b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="117" background="new-images/hl-thnk-bnk.jpg" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr align="center">
              <td width="157" height="30"><img src="new-images/hl-thnk-icici.jpg" width="129" height="54" /></td>
              <td width="204"><b>8.25%<br />
              </b> (Upto Mar 31,2011),<br />
              <b>9.25%</b><br />
(from Apr 1,2011 - Mar 31,2012),<br />
<b>Then 9 %</b></td>
              <td width="210"><span class="tbl_txt1"><b>Rs. 852.07</b><br />
(Upto Mar 31,2011),<br />
<b> Rs.915.87</b><br />
(from Apr 1,2011 - Mar 31,2012),<br />
<b>Then Rs.899.73</b></span></td>
              <td width="63"><span class="style1">20 yrs.</span></td>
              <td width="96"><span class="style1">Rs. 2500000</span></td>
              <td width="230"><span class="tbl_txt1"><b>Rs 21301.64</b><br />
(Upto Mar 31,2011)<br />
(from Apr 1,2011 - Mar 31,2012),<br />
<b>then 22493.15</b></span></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="117" background="new-images/hl-thnk-bnk.jpg" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr align="center">
              <td width="157" height="30"><img src="new-images/hl-thnk-hdfc-h.jpg" width="129" height="54" /></td>
              <td width="204"><b>8.25%<br />
                </b> (Upto Mar 31,2011),<br />
                <b>9.25%</b><br />
          (from Apr 1,2011 - Mar 31,2012),<br />
          <b>Then 9 %</b></td>
              <td width="210"><span class="tbl_txt1"><b>Rs. 852.07</b><br />
          (Upto Mar 31,2011),<br />
          <b> Rs.915.87</b><br />
          (from Apr 1,2011 - Mar 31,2012),<br />
          <b>Then Rs.899.73</b></span></td>
              <td width="63"><span class="style1">20 yrs.</span></td>
              <td width="96"><span class="style1">Rs. 2500000</span></td>
              <td width="230"><span class="tbl_txt1"><b>Rs 21301.64</b><br />
          (Upto Mar 31,2011)<br />
          (from Apr 1,2011 - Mar 31,2012),<br />
          <b>then 22493.15</b></span></td>
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


<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#d5cfb1">
  <tr>
    <td width="12%" height="25" align="center" valign="middle" bgcolor="#494949"><b style=" color:#FFFFFF;">Bank Name</b></td>
	<td width="25%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">ROI</b></td>
	<td width="23%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">EMI 
	  (Per Lac)</b></td>
	
	<td width="6%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">Tenure</b></td>
	<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">Eligible Loan Amount</b></td>
	<td width="23%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">EMI 
	  (Per Month)</b></td>
	<!--<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">Total Interest Amt</b></td>-->
  </tr>
  
   
 
  <tr>
    <td height="22" align="center" bgcolor="#FFFFFF" class="tbl_txt" ><img src="new-images/slider/thumb/icici.jpg" width="137" height="41" /></td>
	 
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" > 	<b>8.25%<br />
	</b> (Upto Mar 31,2011),<br />
    <b>9.25%</b><br /> 
(from Apr 1,2011 - Mar 31,2012),<br />
 <b>Then 9 %</b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><b>Rs. 852.07</b><br />
(Upto Mar 31,2011),<br />
<b> Rs.915.87</b><br />
(from Apr 1,2011 - Mar 31,2012),<br />
<b>Then Rs.899.73</b></td>
	<td align="center" bgcolor="#FFFFFF" class="style1" >20 yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="style1" >Rs. 2500000</td>

	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><b>Rs 21301.64</b><br />
 (Upto Mar 31,2011)<br />
 (from Apr 1,2011 - Mar 31,2012),<br />
<b>then 22493.15</b></td>
	 
  </tr>
  <tr>
    <td height="22" align="center" bgcolor="#FFFFFF" class="tbl_txt" ><img src="new-images/slider/thumb/idbi.jpg" width="126" height="41" /></td>
    <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="tbl_txt1"> <b>8.25%<br />
    </b> (Upto Mar 31,2011),<br />
    <b>9.25%</b><br />
(from Apr 1,2011 - Mar 31,2012),<br />
<b>Then 9 %</b></span></td>
    <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="tbl_txt1"><b>Rs. 852.07</b><br />
(Upto Mar 31,2011),<br />
<b> Rs.915.87</b><br />
(from Apr 1,2011 - Mar 31,2012),<br />
<b>Then Rs.899.73</b></span></td>
    <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="style1">20 yrs.</span></td>
    <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="style1">Rs. 2500000</span></td>
    <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="tbl_txt1"><b>Rs 21301.64</b><br />
(Upto Mar 31,2011)<br />
(from Apr 1,2011 - Mar 31,2012),<br />
<b>then 22493.15</b></span></td>
  </tr>

	<tr>
    <td colspan="11" align="right" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
    </tr>
  </table>
  

		  

 </div>
      
</div> 
 

</body>
</html>

