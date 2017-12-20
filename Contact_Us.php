<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	$msg = "Thank You, You will be soon contacted by our Executives";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
			$Name =$_REQUEST['Name'];
			$Email =$_REQUEST['Email'];
			$mobile =$_REQUEST['mobile'];
			$reqtype = $_REQUEST['reqtype'];
			$message = $_REQUEST['message'];
			$IP_Remote = getenv("REMOTE_ADDR");
//$IP_Remote = $_SERVER["REMOTE_ADDR"];
//if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
//else { $IP= $IP_Remote;	}
$IP=ExactCustomerIP();
if($reqtype=="advertisement")
		{
			$Subject = 'Advertise With Us';
			$Content = '<table border="0" cellspacing="0" width="350" bgcolor="#529BE4" style="border-collapse: collapse" bordercolor="#529BE4"><tr><td valign="top" align=center><table width="440" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm" bgcolor="FFFFFF"><tr>                <td colspan="2">&nbsp;</td>     </tr> <tr>                <td colspan="2" align="center"><strong>Advertise with Us</strong></td>     </tr>          <tr>                <td width="40%" class="bodyarial11"><strong>Name</strong></td>  <td width="60%">'.$Name.'</td>   </tr>   <tr>                <td class="bodyarial11"><strong>Email ID</strong></td>         <td> '.$Email.'</td></tr><tr>   <td class="bodyarial11"><strong>Contact No</strong></td>         <td> '.$mobile.'</td>   </tr>  <tr>   <td class="bodyarial11"><strong>IP Address</strong></td>         <td> '.$IP.'</td>   </tr> </table></td>   </tr><tr><td bgcolor="#529BE4">&nbsp;</td></tr></table>';
		}
	else 
		{
			$Subject = 'Suggestions or Complaints';
			$Content = '<table border="0" cellspacing="0" width="350" bgcolor="#529BE4" style="border-collapse: collapse" bordercolor="#529BE4"><tr><td valign="top" align=center><table width="440" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm" bgcolor="FFFFFF"><tr>                <td colspan="2">&nbsp;</td>     </tr> <tr>                <td colspan="2" align="center"><strong>Advertise with Us</strong></td>     </tr>          <tr>                <td width="40%" class="bodyarial11"><strong>Name</strong></td>  <td width="60%">'.$Name.'</td>   </tr>   <tr>                <td class="bodyarial11"><strong>Email ID</strong></td>         <td> '.$Email.'</td></tr><tr>   <td class="bodyarial11"><strong>Contact No</strong></td>         <td> '.$mobile.'</td>   </tr> <tr>                <td class="bodyarial11"><strong>Message</strong></td>         <td> '.$message.'</td></tr> <tr>   <td class="bodyarial11"><strong>IP Address</strong></td>         <td> '.$IP.'</td>   </tr>  </table></td>   </tr><tr><td bgcolor="#529BE4">&nbsp;</td></tr></table>';		
		}
			
if(strlen($Content)>10 && strlen($Name)>2 && strlen($Email)>5)
		{
	$headers = 'From: '.$Name.' <'.$Email.'>' . "\r\n";
	$headers .= "Return-Path: <".$Email.">\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$to = 'contactus@deal4loans.com,mehra3@gmail.com';
	//$to="ranjana5chauhan@gmail.com";
	mail($to,$Subject, $Content, $headers);
	echo "<script language=javascript>alert('".$msg."');"." location.href='index.php'"."</script>";
	}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css' />  
<title>For information on loans and hassle free loans contact - Deal4Loans</title>
<meta name="keywords" content="hassle free loans, loans india, best loan providers, loans interest rate, low interest loan, compare loans, online loan information" />
<meta name="Description" content="Looking for hassle free loans at attractive interest rates and flexible repayment option; Deal4Loans provides you an online information services on flexible loan schemes available with best loan provider banks in India." />
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/common.js"></script>
<Script language="javascript">
function addElement()
{
		var ni = document.getElementById('myDiv');
		var ni2 = document.getElementById('myDiv2');
		
		if(ni.innerHTML=="")
		{
			ni.innerHTML = "<table bgcolor='#DAEAF9'  style='border:1px dotted #9C9A9C;' width=500><tr><td >&nbsp;<b>Name</b></td><td ><input type='text' name='Name'></td><td><a  onclick='removeElement();' style='cursor:pointer;'>close</a></td></tr><tr><td >&nbsp;<b>Email id</b></td><td ><input type='text' name='Email'></td></tr><tr><td >&nbsp;<b>Mobile No</b></td><td ><input type='text' name='mobile'></td></tr><tr><td colspan='2' align='center' height='40'> <input type='submit' value='submit' class='btnclr'></td></tr></table>";
			}

		if(ni2.innerHTML!="")
	{
			ni2.innerHTML = '';
	}		
		return true;
	}

function removeElement()
{
		var ni = document.getElementById('myDiv');		
		if(ni.innerHTML!="")
		{
			ni.innerHTML = '';			
		}
		return true;
	}

	function addElement1()
{
		var ni2 = document.getElementById('myDiv2');
		var ni = document.getElementById('myDiv');
		if(ni2.innerHTML=="")
		{
			ni2.innerHTML = "<table bgcolor='#DAEAF9'  style='border:1px dotted #9C9A9C;' width='60%'><tr><td ><b>Name</b></td><td ><input type='text' name='Name'></td><td><a  onclick='removeElement1();' style='cursor:pointer;'>close</a></td></tr><tr><td ><b>Email id</b></td><td ><input type='text' name='Email'></td></tr><tr><td ><b>Mobile No</b></td><td ><input type='text' name='mobile'></td></tr><tr><td ><b>Message</b></td><td ><textarea name='message' cols='35' rows='4'></textarea></td></tr><tr><td colspan='2' align='center' height='40'> <input type='submit' value='submit' class='btnclr'></td></tr></table></body>";			
		}

		if(ni.innerHTML!="")
	{
			ni.innerHTML = '';
	}	
		
		return true;
	}

function removeElement1()
{
		var ni2 = document.getElementById('myDiv2');
		if(ni2.innerHTML!="")
		{		
			ni2.innerHTML = '';			
		}
		
		return true;
		}

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

function chktesti(form)
{  
		if(formm.Name.value=="")
	{
			alert("please enter your Name!");
			formm.Name.focus();
				return false;
	}
		if(formm.Email.value=="")
	{
			alert("please enter your email id!");
			formm.Email.focus();
				return false;
	}
	if(form.Email.value!="")
	{
		if (!validmail(form.Email.value))
		{
			//alert("Please enter your valid email address!");
			form.Email.focus();
			return false;
		}
	}		
	}
    </Script>
<link href="css/personal-loan-sbi-styles121.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="menu-style.css">
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; max-width:970px; height:11px; margin-top:70px; color:#4c4c4c;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > Contact Us</div>
<div style="clear:both; height:15px;"></div>
<div class="intrl_txt">
<table><tr><td width="72%">
<div class="text3" style="width:100%; margin-left:20px; max-width:200px; height:33; margin-top:0px;font-size:28px; text-transform:none;"><strong>Contact Us</strong></div></td><td width="28%"></td>
   </tr></table>
 <div class="text11" style="width:100%; max-width:950px; margin-left:20px; margin-top:10px;">
 <p>Thank you for showing interest in Deal4loans.com.We are eager to serve you at deal4loans.com.<br />
    We are based out of the following locations.</p>
    <p >
    <b>Address :</b><br />
    <b>WRS Info India Pvt. Ltd.</b><br />
<span style="font-size:13px; font-weight:bold;" >E-32, Ground Floor,<br /> Sector - 8, Noida - 201301<br />Uttar Pradesh, India<br />          Call at +91 8447912081<br/>			</span></p>

  <tr><td>
      <b>Advertise with us :</b><br />
	  </td>
	  </tr>
	  <tr>
	  <td>
    If you wish to advertise with us, please <a href="http://www.deal4loans.com/Advertise_With_Us.php">Click Here</a> .<br />
	</td></tr> 
	<tr>
                <td  class="frmbldtxt"><form name="form1" method="POST" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chktesti(document.form1);"><div id="myDiv"></div><input type="hidden" name="reqtype" value="advertisement"></form> <br /></td>
              </tr>
			  </tr>
  <tr><td>&nbsp;</td></tr>
   
  <tr><td><b>Suggestions/Complaints :</b></td></tr>
  <tr>
  <td>
    If you have   issues regarding your  application with deal4loans.com, please <a onclick="addElement1();" style="cursor:pointer;">Click Here</a>.</td>
	</tr>
	<tr>
                <td class="frmbldtxt"><form name="form2" method="POST" action="<? echo $_SERVER['PHP_SELF'] ?>"><div id="myDiv2"></div><input type="hidden" name="reqtype" value="Suggestions_Complaints"></form> </td>
              </tr>

<tr><td>
  We at Deal4loans.com are not a broker or Dsa of any Bank. We do not sell loans through our teams and we do not deal with the customer directly. We act as online comparison engine and pass the customer request to the bank which he opts in. We have no offline sales team and do not do any sales activity for any bank. We do not charge any fee from the customer and act as online advertising platform for Banks.<br />
  </td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td></tr>
  <tr><td>&nbsp;</td></tr>
  </table>
      
</div></div>
<?php include("footer_sub_menu.php"); ?>
</div>
</body>
</html>