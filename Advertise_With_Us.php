<?php
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	session_start();
	
	$msg = "Thank You, You will be soon Informed by our Executives";
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$From_Name = $_REQUEST['From_Name'];
		$From_Email = $_REQUEST['From_Email'];
		$Message = $_REQUEST['Message'];
		$From_Contact = $_REQUEST['From_Contact'];
		//$reference_captcha = $_REQUEST['reference_captcha'];
		//$From_captcha = $_REQUEST['From_captcha'];
		
		$From_Name = FixString($From_Name);
		$From_Email = FixString($From_Email);
		$Message = FixString($Message);
		$From_Contact = FixString($From_Contact);
	//	$reference_captcha = FixString($reference_captcha);
		//$From_captcha = FixString($From_captcha);

		$IP=ExactCustomerIP();

	if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
		$_SESSION['captcha_msg'] = "<span style='color:red'>The Validation code does not match!</span>";// Captcha verification is incorrect.
		/*echo '<script>window.history.go(-1);</script>';*/
	}
	else
	{

		//QUERY
		/*if(strlen($From_Name)>0 && strlen($From_Email)>0 && strlen($Message)>0 && strlen($From_Contact)>0)
		{
		$Dated = ExactServerdate();
		$dataInsert = array('from_name'=>$From_Name, 'from_email'=>$From_Email, 'from_contact'=>$From_Contact, 'from_content'=>$Message, 'ip_address'=>$IP, 'dated'=>$Dated);
		$insert = Maininsertfunc ('Advertise_with_us', $dataInsert);
		}*/

		$Subject = 'Advertise with us...';
		$Content = '<table border="0" cellspacing="0" width="350" bgcolor="#529BE4" style="border-collapse: collapse" bordercolor="#529BE4"><tr><td valign="top" align=center><table width="440" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm" bgcolor="FFFFFF"><tr>                <td colspan="2">&nbsp;</td>     </tr> <tr>                <td colspan="2" align="center"><strong>Advertise with Us</strong></td></tr>          <tr>                <td width="40%" class="bodyarial11"><strong>Name</strong></td>  <td width="60%">'.$From_Name.'</td></tr><tr><td class="bodyarial11"><strong>Email ID</strong></td>         <td> '.$From_Email.'</td></tr><tr>   <td class="bodyarial11"><strong>Contact No</strong></td>         <td> '.$From_Contact.'</td>   </tr><tr>   <td class="bodyarial11"><strong>Comment</strong></td>         <td> '.$Message.'</td>   </tr> <tr>   <td class="bodyarial11"><strong>IP Address</strong></td>         <td> '.$IP.'</td>   </tr>  </table></td>   </tr><tr><td bgcolor="#529BE4">&nbsp;</td></tr></table>';

		$headers = 'From: '.$From_Name.' <'.$From_Email.'>' . "\r\n";
		$headers .= "Return-Path: <".$Email.">\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$to = 'contactus@deal4loans.com,shweta.sharma@deal4loans.com,mehra3@gmail.com';
		//$to ="ranjana5chauhan@gmail.com";
		if(strlen($From_Name)>2 && strlen($From_Email)>5 && strlen($Message)>3)
		{
			//echo "OK !";
			mail($to,$Subject, $Content, $headers);
			echo "<script language=javascript>alert('".$msg."');"." location.href='index.php'"."</script>";
		}
	}
	/*else
	{
		echo "<script language=javascript>alert('".$msg."');"." location.href='index.php'"."</script>";
	}*/
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css' />  
<title>Advertise With Us - Deal4loans</title>
<meta name="keywords" content="Loan Query, Credit Card Query, Home Loan Query, Personal Loan Query" />
<meta name="Description" content="Looking for hassle free loans at attractive interest rates and flexible repayment option; Deal4Loans provides you an online information services on flexible loan schemes available with best loan provider banks in India." />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/scripts/common.js"></script>
<!--<link href="http://www.deal4loans.com/captcha/css/style.css" rel="stylesheet">-->
<script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
<Script Language="javascript">
function validateMe(theFrm){
	if(!checkData(theFrm.From_Name, 'Your Name', 5))
	return false;
	
	if(theFrm.From_Email.value=="")
	{
		alert("Please enter  Email Address");
		theFrm.From_Email.focus();
		return false;
	}
	var str=theFrm.From_Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	
	if(aa==-1)
	{
		alert("Please enter the valid Email Address");
		theFrm.From_Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Please enter the valid Email Address");
		theFrm.From_Email.focus();
		return false;
	}
	if(theFrm.From_Contact.value=="")
	{
		alert("Please enter the Contact No");
		theFrm.From_Contact.focus();
		return false;
	}
	if(theFrm.captcha_code.value=="")
	{
		alert("Please enter Captcha Code");
		theFrm.captcha_code.focus();
		return false;
	}
	return true;
}
</Script>
        <style>
    .aplfrm{
	border-left:5px solid #a2d7f6;
	border-right:5px solid #a2d7f6;
	background:#f6fcff;
}

.btnclr{
	background-color:#1273ab;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	font-weight:bold;
	color:#FFFFFF;
	width:90px;
	height:30px;
	border:none;
}

.frmtxt{	
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	font-weight:normal;
	text-align:left;
	color:#000000;
}


.frmbldtxt{	
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	font-weight:bold;
	text-align:left;
}
    </style>
	<!--<link href="http://www.deal4loans.com/captcha/css/style.css" rel="stylesheet">-->
<script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#4c4c4c;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > Advertise With Us</div>
<div style="clear:both; height:15px;"></div>
<div class="intrl_txt">
 <div class="text11" style="color:#4c4c4c; width:100%;  margin-top:10px;">
     <form name="friend_frm" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onsubmit="return validateMe(this);">
<div class="agent-form"> 

<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="35" colspan="2" align="center" bgcolor="#FFFFFF"><h1 >Advertise With Us</h1></td>
      </tr>
      <tr>
        <td width="30%" height="35" class="frmtxt">Your Name</td>
        <td width="70%"><input name="From_Name" type="text"  size="40" class="emi_input" /></td>
      </tr>
      <tr>
        <td height="35" class="frmtxt">Your Email ID</td>
        <td><input name="From_Email" type="text"  size="40"  class="emi_input" /></td>
      </tr>
      <tr>
        <td height="35" class="frmtxt">Contact No</td>
        <td><input name="From_Contact" type="text"  size="40" maxlength="15"  class="emi_input" /></td>
      </tr>
      <tr>
        <td height="95" valign="middle" class="frmtxt">Comments</td>
        <td><textarea name="Message"  rows="5"  style="width:90%;"></textarea></td>
      </tr>
      <?php if(isset($_SESSION['captcha_msg'])){?>
      <tr>
        <td colspan="2" align="center" valign="top" style="font-size:13px;"><?php echo $_SESSION['captcha_msg']; ?></td>
      </tr>
      <?php } unset($_SESSION['captcha_msg']); ?>
      <tr>
        <td height="50" class="frmtxt"> Validation code:</td>
        <td ><img src="http://www.deal4loans.com/captcha/captcha1.php?rand=<?php echo rand();?>" id='captchaimg' /></td>
      </tr>
	  <tr>	  
	  <td colspan="2">
	  <table width="100%" border="0">	  
      <tr>
        <td width="45%" class="frmtxt"><label for='message'>Enter the above code here: </label></td>
        <td width="55%"><input id="captcha_code" name="captcha_code" type="text" /></td>
      </tr>
      <tr>
        <td colspan="2" class="frmtxt">Can't read the image? <a href='javascript: refreshCaptcha();'>click here</a> to refresh.</td>
      </tr>    	
    </table>
    </td>	  
    </tr>
      <tr>
        <td colspan="2" align="center"><br />
            <input name="submit" type="submit" class="btnclr" value="Submit..." /></td>
      </tr>
      <tr>
        <td height="25">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
</div>
    </form>
<p style="color:#1273ab; font-size:13px;"><br />For National level tie-ups write @ <strong>shweta.sharma@deal4loans.com</strong></p>   
</div>
</div></div>
<?php include("footer_sub_menu.php"); ?>
</body>
</html>