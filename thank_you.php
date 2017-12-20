<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/htmlMimeMail.php';
	require 'scripts/SMTP.class';
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Mail sending</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div align="center">
 <center>
 <?php include '~Top.php'; ?>
<table border="0" cellspacing="1" width="100%" cellpadding="0"  bgcolor="#F9FAF5">
   <tr>
     <td width="200" align="center" valign="top" bgcolor="#DEE3CE">
<?php if(isset($_SESSION['UserType']))
	{
	include '~Left.php';
	}
	else
	{
	include '~Login.php';
	}
	$to_name = $_REQUEST['to_name'];
	$to_email = $_REQUEST['to_email'];
	$from_name = $_REQUEST['from_name'];
	$from_email = $_REQUEST['from_email'];
	$subject = $_REQUEST['subject'];
	//$message = $_REQUEST['message'];

	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$address = $_REQUEST['address'];
	$dob_dd = $_REQUEST['dob_dd'];
	$dob_mm = $_REQUEST['dob_mm'];
	$dob_yy = $_REQUEST['dob_yy'];
	$telephoneoffice = $_REQUEST['telephoneoffice'];
	$telephoneresidence = $_REQUEST['telephoneresidence'];
	$mobile = $_REQUEST['mobile'];
	$pincode = $_REQUEST['pincode'];
	$other_city = $_REQUEST['other_city'];

$message = "
<html>

<head>
<title>New Page 2</title>
</head>
<body>
<FORM name=campaignform action=http://www.deal4loans.com/site1/response.php method=post target=_new>
  <p><INPUT type=hidden value=Incoming_Web name=referrer>
<INPUT type=hidden value=Mediaturf name=creative>
<INPUT type=hidden value=Mailer name=section>
<INPUT type=hidden value=Naukri name=leadsrc>
<INPUT type=hidden value=Lifetime_Icecream name=level5>
</p>
  <div align='center'>
    <center>
<table width='50%' height='50%' border='1' cellpadding='0' cellspacing='0' bordercolor='#990000'>
<tr> 
<td width='548' height='50%'> 
<div align='center'>
  <center> 
<table border='0' cellspacing='0' cellpadding='0' height='257'>
<tr> 
<td width='100%' align='center' bgcolor='F48321' height='185'>&nbsp;<table width='99%' border='1' align='left' cellpadding='1' cellspacing='2' bordercolor='F48321' bgcolor='F48321'>
<tr> 
<td colspan='3' class='textfont'> <div align='center'><b>
  <font color='#000000' face='Zurich BT'>If 
you would like to meet with our Financial Advisor, please 
enter your details</font></b></div></td>
</tr>
<tr> 
<td width='96'> <input name=name class=box1 onFocus=this.select() value=Name size='15' maxlength=50> 
</td>
<td class='textfont'><input class=box1 onFocus=this.select() size=6 value=Address name=address></td>
<td width='90' align='center' class='textfont'> <input name=email class=box1 onFocus=this.select() value=Email size='15' maxlength=99> 
</td>
</tr>
<tr> 
<td width='96' align='center' class='textfont'><font color='#000000' size='2' face='Zurich BT'>Date 
of birth</font></td>
<td colspan='2' class='textfont'><table width='99%' border='0' cellspacing='0' cellpadding='0'>
<tr> 
<td width='5%'>&nbsp;</td>
<td width='33%' class='textfont'><select class=box2 name=dob_dd>
<option value=-1 selected>Date 
<option value=01>1 
<option value=02>2 
<option value=03>3 
<option value=04>4 
<option value=05>5 
<option value=06>6 
<option value=07>7 
<option value=08>8 
<option value=09>9 
<option value=10>10 
<option value=11>11 
<option value=12>12 
<option value=13>13 
<option value=14>14 
<option value=15>15 
<option value=16>16 
<option value=17>17 
<option value=18>18 
<option value=19>19 
<option value=20>20 
<option value=21>21 
<option value=22>22 
<option value=23>23 
<option value=24>24 
<option value=25>25 
<option value=26>26 
<option value=27>27 
<option value=28>28 
<option value=29>29 
<option value=30>30 
<option value=31>31</option>
</select></td>
<td width='34%' class='textfont'><select class=box2 name=dob_mm>
<option value=-1 selected>Month 
<option value=01>Jan 
<option value=02>Feb 
<option value=03>Mar 
<option value=04>Apr 
<option value=05>May 
<option value=06>Jun 
<option value=07>Jul 
<option value=08>Aug 
<option value=09>Sep 
<option value=10>Oct 
<option value=11>Nov 
<option value=12>Dec</option>
</select></td>
<td width='27%' class='textfont'><select class=box2 name=dob_yy>
<option value=-1 selected>Year 
<option value=1954>1954 
<option value=1955>1955 
<option value=1956>1956 
<option value=1957>1957 
<option value=1958>1958 
<option value=1959>1959 
<option value=1960>1960 
<option value=1961>1961 
<option value=1962>1962 
<option value=1963>1963 
<option value=1964>1964 
<option value=1965>1965 
<option value=1966>1966 
<option value=1967>1967 
<option value=1968>1968 
<option value=1969>1969 
<option value=1970>1970 
<option value=1971>1971 
<option value=1972>1972 
<option value=1973>1973 
<option value=1974>1974 
<option value=1975>1975 
<option value=1976>1976 
<option value=1977>1977 
<option value=1978>1978 
<option value=1979>1979 
<option value=1980>1980 
<option value=1981>1981 
<option value=1982>1982 
<option value=1983>1983 
<option value=1984>1984 
<option value=1985>1985</option>
</select></td>
<td width='1%' class='textfont'>&nbsp;</td>
</tr>
</table></td>
</tr>
<tr> 
<td> <select class=box1 onChange=othercity1() name=city>
<option value=-1 selected>City</option>
<option value=73>New Delhi</option>
<option value=67>Mumbai </option>
<option value=24>Chennai</option>
<option value=20>Kolkata</option>
<option value=11>Bangalore</option>
<option value=43>Hyderabad</option>
<option value=80>Pune</option>
<option value=22>Chandigarh</option>
<option value=3>Ahmedabad</option>
<option value=230>Kochi</option>
<option value=48>Jaipur</option>
<option value=26>Coimbatore</option>
<option value=80>Chinchwad</option>
<option value=73>Faridabad</option>
<option value=73>Ghaziabad</option>
<option value=73>Gurgaon</option>
<option value=73>Noida</option>
<option value=67>Navi Mumbai</option>
<option value=67>Dombivili</option>
<option value=67>Thane</option>
<option value=67>Ulhasnagar</option>
<option value=67>Vasai</option>
<option value=0>Others</option>
</select> </td>
<td width='96'> 
<input class=box1 onFocus=this.select() maxlength=6 size=8 value=Pincode name=pincode> 
</td>
<td> <input name=other_city disabled class=box1 onFocus=this.select() value='Other City' size='15' maxlength=14> 
</td>
</tr>
<tr> 
<td> <input name=telephoneresidence class=box1 onFocus=this.select() value=Ph.(R) size='15' maxlength=14> 
</td>
<td> <input name=telephoneoffice class=box1 onFocus=this.select() value=Ph.(O) size='15' maxlength=14> 
</td>
<td> <input name=mobile class=box1 onFocus=this.select() value=Mobile size='15' maxlength=14> 
</td>
</tr>
<tr> 
<td colspan='3'><div align='center'> </div>
<div align='center'> </div>
<div align='center'> 
<INPUT name='image' type=image src='http://www.deal4loans.com/site1/images/submit_test.gif'>
</div></td>
</tr>
</table></td>
</tr>
<tr bgcolor='EFEFE0'> 
<td height='6'></td>
</tr>
<tr bgcolor='EFEFE0'> 
<td height='1'></td>
</tr>
<tr> 
<td class='textfont' height='1'></td>
</tr>
<tr> 
<td height='3' align='center'></td>
</tr>
</table></center>
</div>
</td>
</tr>
</table>
    </center>
  </div>
</FORM>
</body>
</html>
";
//echo $to_name.'<br>';
//echo $to_email.'<br>';
//echo $subject."<br>";
//echo $message."<br>";
send_mail_new('Abhishek',$to_email,'ICICI','Admin@deal4loans.com','Bidder Reply',$message);	
//mail($to_email,$subject,$message,"mail sending");
//dev_mail('srivas_abhi@rediffmail.com','hello from phpdev5','justatesting','FROM:admin@deal4loans.com');
//if(send_mail_new($to_name,$to_email,$from_name,$from_email,$subject,$message))
//echo "E-mail has been sent successfully";
//else
//echo "Error Sending Message";
?>
</td>
</tr>
</table>
<?php include '~Bottom.php';?>
</center>
</div>
</body>
</html>