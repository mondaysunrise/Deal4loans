<?php
require 'scripts/db_init.php';
require 'scripts/session_check.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;

$get_reqid = $_REQUEST['get_reqid'];

if($get_reqid>0)
{
}
else
{
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

			$userid = $_POST['get_reqid'];
			$email = $_POST['email'];
			$full_name = $_POST['full_name'];
			$pancard_no = $_POST['pancard_no'];
			$mobile = $_POST['mobile'];
			$office_address = $_POST['mobile'];
			$residence_address = $_POST['residence_address'];


			
if($userid>0)
	{
//$icici_clquery="Update icici_car_loan_calc set icici_name='$full_name', icici_mobile='$mobile', icici_email='$email', icici_pan_no='$pancard_no', icici_office_address='$office_address', icici_resi_address ='$residence_address'  Where icici_clid=".$userid;

$DataArray = array("icici_name"=>$full_name, "icici_mobile"=>$mobile, "icici_email"=>$email, "icici_pan_no"=>$pancard_no, "icici_office_address"=>$office_address, "icici_resi_address"=>$residence_address);
$wherecondition ="icici_clid=".$userid;
Mainupdatefunc ('icici_car_loan_calc', $DataArray, $wherecondition);

//$result = ExecQuery($icici_clquery);
//echo $icici_clquery;
			
			}
}
}

?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ICICI Bank Car Loan</title>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="icici_car/Functions.js"></script>
<script src="icici_car/AC_ActiveX.js" type="text/javascript"></script>
<script src="icici_car/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="javascript" src="icici_car/Functions_002.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript" src="icici_car/FormCheck.js"></script>
<script src="icici_car/Default.htm" type="text/javascript"></script>
<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />

<script>
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
function chkcarloan_frm()
{
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	

	if((document.getElementById('full_name').value=="") || (document.getElementById('full_name').value=="Name")|| (Trim(document.getElementById('full_name').value))==false)
	{
		alert("Kindly fill in your Name!");
		document.getElementById('full_name').focus();
		return false;
	}
	else if(containsdigit(document.getElementById('full_name').value)==true)
	{
		alert("Name contains numbers!");
		document.getElementById('full_name').focus();
		return false;
	}
	  for (var i = 0; i < document.getElementById('full_name').value.length; i++) {
		if (iChars.indexOf(document.getElementById('full_name').value.charAt(i)) != -1) {
		alert ("Name has special characters.\n Please remove them and try again.");
		document.getElementById('full_name').focus();
		return false;
		}
	  }
	if((document.getElementById('mobile').value=='Mobile No') || (document.getElementById('mobile').value=='') || Trim(document.getElementById('mobile').value)==false)
		{
			alert("Kindly fill in your Mobile Number!");
			document.getElementById('mobile').focus();
			return false;
		}
	else if(isNaN(document.getElementById('mobile').value)|| document.getElementById('mobile').value.indexOf(" ")!=-1)
		{
			alert("Enter numeric value in ");
			document.getElementById('mobile').focus();
			return false;  
		}
	else if (document.getElementById('mobile').value.length < 10 )
		{
			alert("Please Enter 10 Digits"); 
			document.getElementById('mobile').focus();
			return false;
		}
	else if ((document.getElementById('mobile').value.charAt(0)!="9") && (document.getElementById('mobile').value.charAt(0)!="8") && (document.getElementById('mobile').value.charAt(0)!="7"))
		{
			alert("The number should start only with 9 or 8 or 7");
			document.getElementById('mobile').focus();
			return false;
		}

	  if(document.getElementById('email').value=="")
	{
		alert("Please enter your valid email address!");
			document.getElementById('email').focus();
			return false;
			
		}
	if(document.getElementById('email').value!="")
	{
		if (!validmail(document.getElementById('email').value))
		{
			//alert("Please enter your valid email address!");
			document.getElementById('email').focus();
			return false;
		}	
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

</head><body>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="886">
  <tbody><tr>
    <td background="icici_car/main_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="872">
      <tbody><tr>
        <td><img src="icici_car/top_logo.gif" height="104" width="872"></td>
      </tr>
     
      <tr>
        <td height="13"></td>
      </tr>
      <tr>
        <td><img src="icici_car/body_top.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td background="icici_car/body_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="96%">
          <tbody><tr>
           
            <td valign="top" align="center"><table border="0" cellpadding="0" cellspacing="0" width="300">
              <tr>
                <td><img src="icici_car/form_title.gif" height="76" width="300"></td>
              </tr>
              <tr>
                <td background="icici_car/form_bg.gif" height="206" valign="top" align="center">
				<? if($userid>0)
				{
					?>
					<div style="font-family:Verdana; font-size: 12px; font-weight: bold;"> Thank You for Registering,<br> Will Contact You Soon.</div>
				<? }
				else
				{
				?>
				<form name="icici_car_loan" method="post" action="icici-carloan-thanks.php">
				<input type="hidden" name="get_reqid" id="get_reqid" value="<? echo $_REQUEST['get_reqid']; ?>"/>
								<table style="height: 150px;" align="right" border="0" cellpadding="0" cellspacing="0" width="96%">
                  <tbody>
				 <tr>
                    <td colspan="2" height="5" ></td>
                  </tr>
                <tr>
                    <td class="form_txt" align="left" valign="middle" width="39%"><b>Name</b></td>
                    <td class="form_txt" align="left" valign="middle" width="61%">
					<input type="text" name="full_name" id="full_name" style="width:130px;"  class="txtbox" tabindex="1"/></td>
                  </tr> <tr>
                    <td colspan="2" height="5" ></td>
                  </tr>
                <tr>
                    <td class="form_txt" align="left" valign="middle"><b>Mobile No.</b></td>
                    <td class="form_txt" align="left" valign="middle"><input gtbfieldid="6" name="mobilestd" class="txtbox" id="mobilestd" value="91" style="width: 20px; background-color: rgb(229, 229, 229); text-align: center;" readonly="readonly" type="text"><input type="text" name="mobile" id="mobile" maxlength="10"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" style="width:110px;"  class="txtbox" tabindex="2"/></td>
                  </tr> 

                <tr>
                    <td class="form_txt" align="left" valign="middle" width="39%"><b>Email</b></td>
                    <td class="form_txt" align="left" valign="middle" width="61%">
					<input type="text" name="email" id="email" style="width:130px;"  class="txtbox" tabindex="3"/></td>
                  </tr> <tr>
                    <td colspan="2" height="5" ></td>
                  </tr>
                  <tr>
				 <td colspan="2" class="form_txt" align="center" height="40" valign="bottom">
	  				 <input src="icici_car/but_apply.gif" name="Submit" onClick="return chkcarloan_frm();"  type="image" tabindex="4">
				
				 </td>
                  </tr>
                </table></form>
				<? } ?>
				</td>
              </tr>
              <tr>
                <td><img src="icici_car/form_btmimg.gif" height="15" width="300"></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><img src="icici_car/body_btm.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td height="35"><table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
          <tbody><tr>
            <td class="disclaimer" height="10"></td>
          </tr>
           <tr>
             <td class="cnbc" height="103" valign="bottom" width="850"><table border="0" cellpadding="0" cellspacing="6" width="100%">
               <tbody>
                 <tr>
                   <td width="500">&nbsp;</td>
                   <td class="cnbc_link">www.consumerawards.moneycontrol.com/categories.php</td>
                 </tr>
               </tbody>
             </table></td>
           </tr>
          <tr>
            <td class="disclaimer"><a href="javascript:void(0);" onClick="javascript:showHideDiv(0);" class="disclaimer"><b><u>Disclaimer</u></b></a></td>
          </tr>
          <tr>
            <td class="disclaimer">&nbsp;</td>
          </tr>
        </tbody></table></td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>

<div id="disclaimer" class="disclaimerdiv">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody><tr>
    <td align="left" height="10" valign="top" width="1%"><img src="icici_car/tl.png" height="10" width="10"></td>
    <td align="left" background="icici_car/b.png" valign="top" width="98%"></td>
    <td align="right" height="10" valign="top" width="1%"><img src="icici_car/tr.png" height="10" width="10"></td>
  </tr>
  <tr>
    <td align="left" background="icici_car/b.png" valign="top">&nbsp;</td>
    <td align="center" bgcolor="#ffffff" valign="top"><table bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" width="100%">
  <tbody><tr>
    <td class="disctxt" align="left" valign="top"><b><u>Disclaimer</u></b>:<br>
          The information provided herein is on the website of  
Communicate 2 at http://www.loanforcar.in/,  which is neither owned, 
controlled nor endorsed by ICICI Bank. The use of this information is 
subject to the terms and conditions governing such products, services 
and offers as specified by ICICI Bank at www.icicibank.com; and third 
party from time to time. All Loans are offered at the sole discretion of
 ICICI Bank, subject to submission of documentation and fulfillment of 
such requisites to the sole and absolute satisfaction of ICICI Bank. 
Associated benefits / features / interest rates / applicable fees and 
charges / application process mentioned herein are as on date and may be
 subject to change/ modification from time to time. Eligibility criteria
 and Documentation are indicative and not exhaustive. Nothing contained 
herein shall constitute
or be deemed to constitute an advice, invitation or solicitation to 
purchase any products or services of ICICI Bank or such other third 
party. ICICI Bank does not accept any responsibility for the details, 
accuracy, completeness or correct sequence of any content or information
 provided on the website of the third party; and/ or any errors whether 
caused by negligence or otherwise; and/ or for any loss or damage 
incurred by anyone in reliance on anything set out herein. "ICICI Bank" 
and "I-man" logos are trademark and property of ICICI Bank Ltd. Misuse 
of any intellectual property, or any other content displayed herein is 
strictly prohibited.<br>
          <br>
          <b>EMI Calculator</b><br>This application ("the 
"Application") is for your personal information, education and 
communication of an estimation of equated monthly installment ("EMI") 
and expected changes in it as well as tenure in case of floating rate of
 interest, and is not an offer; invitation or solicitation of any kind 
to avail the facility is not intended to create any rights or 
obligations. Please note that the equated monthly installment ("EMI") 
calculated through this calculator is rounded off to the nearest upper 
integer. Further, the EMI calculated is indicative based solely on the 
data fed by you on the screen and does not envisage any changes that 
might occur due to any discounts, schemes or other promotional 
activities introduced by ICICI Bank from time to time through its own 
channel or in association with a third party.
<p>No reliance may be placed for any purpose whatsoever on the 
information contained in this presentation or on its completeness. The 
information set out herein may be subject to updating, completion, 
revision, verification and amendment and such information may change 
materially. Such information is provided only for the convenience of the
 customers and ICICI Bank does not undertake any liability or 
responsibility for the details, accuracy, completeness or correct 
sequence of any content or information provided through the application.</p>
          <p>The intellectual property in respect of the Application 
belongs to ICICI Bank and any form of reproduction, dissemination, 
copying, disclosure, modification, and/or publication of this document 
is strictly prohibited. The contents of this document are solely meant 
to provide information and ICICI Bank is not representing or giving you 
any assurance that your expectations, objectives, needs and wishes will 
be met with the facility availed and ICICI Bank disclaims all 
responsibility and accepts no liability for the consequences of any 
person acting, or refraining from acting, on such information. ICICI 
Bank Group or any of its officers, employees, personnel, directors shall
 not be liable for any loss, damage, liability whatsoever for any direct
 or indirect loss arising from the use or access of any information that
 may be displayed in through this Application.</p>
          The information provided hereinabove is for information 
purposes only and is subject to Terms and Conditions which are uploaded 
on www.icicibank.com and all applicable laws. By accessing and browsing 
the Application, you accept, without limitation or qualification, the 
Terms and Conditions and acknowledge that any other agreement between 
you and ICICI Bank are superseded and of no force or effect.
          <div align="right"><img src="icici_car/closelabel.gif" onClick="javascript:showHideDiv(1);" style="cursor: pointer;"></div>          </td>
  </tr>
</tbody></table></td>
    <td align="right" background="icici_car/b.png" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="bottom"><img src="icici_car/bl.png" height="10" width="10"></td>
    <td align="left" background="icici_car/b.png" valign="top"></td>
    <td align="right" valign="bottom"><img src="icici_car/br.png" height="10" width="10"></td>
  </tr>
</tbody></table>
</div>
<!--</form>-->

</body></html>