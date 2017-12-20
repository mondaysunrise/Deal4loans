<?php
require 'scripts/session_check.php';
	require 'scripts/functions.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deal4loans</title>

<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script language="javascript" type="text/javascript">

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


function SendData()
{
document.form1.submit();
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

if((Form.refid.value=="") || (Form.refid.value=="Full Name")|| (Trim(Form.refid.value))==false)
{
alert("Kindly fill in your Name!");
Form.refid.select();
return false;
}
else if(containsdigit(Form.refid.value)==true)
{
alert("Name contains numbers!");
Form.refid.select();
return false;
}
  for (var i = 0; i < Form.refid.value.length; i++) {
  	if (iChars.indexOf(Form.refid.value.charAt(i)) != -1) {
  	alert ("Name has special characters.\n Please remove them and try again.");
	Form.refid.select();
  	return false;
  	}
  }


	if(Form.mobno.value=="")
	{
		alert("Please Enter Mobile Number");
		Form.mobno.focus();
		return false;
	}

if(isNaN(Form.mobno.value)|| Form.mobno.value.indexOf(" ")!=-1)
	{
		  alert("Enter numeric value");
		  Form.mobno.focus();
		  return false;  
	}
	if (Form.mobno.value.length < 10 )
	{
			alert("Please Enter 10 Digits"); 
			 Form.mobno.focus();
			return false;
	}
	if (Form.mobno.value.charAt(0)!="9" && Form.mobno.value.charAt(0)!="8")
	{
			alert("The number should start only with 9 or 8");
			 Form.mobno.focus();
			return false;
	}
	
	if(Form.amt.value=="")
	{
		alert("Please enter Payment Amount");
		Form.amt.focus();
		return false;
	}


}

</script>
</head>

<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<?php include'../~sml-hdr.php';?>
<div class="lfttxtbar">

	
  <div id="txt">	
<form action="payment_cellnext_continue.php" method="post" name="cellpay" onSubmit="return submitform(document.cellpay);">

 <table width="458" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="110" valign="bottom" background="new-images/cell.jpg" style="background-repeat:no-repeat;"><h1 >Purchase your Package here</h1></td>
  </tr>
  <tr>
    <td class="aplfrm"><table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td width="30%" height="35" class="frmtxt">Your Name</td>
        <td width="70%"> <input id="refid" name="refid" type="text" /></td>
      </tr>
      <tr>
        <td height="35" class="frmtxt">Contact No</td>
        <td>  <input id="mobno" name="mobno" type="text" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; /></td>
      </tr>
      <tr>
        <td height="35" valign="middle" class="frmtxt">Give Amount</td>
        <td><input id="amt" name="amt" type="text" onKeyUp="intOnly(this);" maxlength="10" onKeyPress="intOnly(this)"; /> <br />
		<span class="style19"><span class="alertbox"><strong>Rs </strong></span> <span class="style2">
                (Enter amount in values like 100, 1000 etc)</span></span></td>
      </tr>
	  
      <tr>
        <td colspan="2" align="center"><br />
           <input name="submit" id="Submit" type="submit" width="184" height="37" value="Submit..." /></td>
      </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
          <td width="458" height="26"><img src="new-images/apl-bt.gif" width="458" height="26" /></td>
  </tr>
</table>
	
 </form>	
	
</div>
</div>
</div>
 <? if(!isset($_SESSION['UserType'])) 
  {
  include '~Right-new.php';
  }
  ?>
<?php include '~Bottom-new.php';?>
</div>
</body>
</html>

