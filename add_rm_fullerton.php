<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';


if(isset($_POST['submit']))
{
	$rm_name=$_POST['rm_name'];
	$rm_contact=$_POST['mobile'];
	$rm_email=$_POST['email'];
	$rm_email_cc=$_POST['email_cc'];
	$rm_city=$_POST['city'];
	$sql="INSERT INTO `rm_detail_fullerton` (`rm_name` , `rm_contact` , `rm_email` , `rm_city`,dated, rm_email_cc) VALUES ('".$rm_name."', '".$rm_contact."', '".$rm_email."', '".$rm_city."',Now(), '".$rm_email_cc."')";
 	$query=ExecQuery($sql);

	header("Location: view_fullerton.php");
	exit();
}

	$cityList = array(
        '1' => '996',
		'2' => '997',
		'3' => '998',
		'4' => '1000',
		'5' => '1012',
		'6' => '1015',
		'7' => '1037',
		'8' => '1050',
		);


function getReqValue1($pKey){
	$titles = array(
        '1' => '996',
		'2' => '997',
		'3' => '998',
		'4' => '1000',
		'5' => '1012',
		'6' => '1015',
		'7' => '1037',
		'8' => '1050',
		);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
		}

?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?php 
	if(isset($_SESSION['UserType']))
	{
		include "callingFullertonTop.php";
	}
?>


  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->

<style>
.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
}
.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
	color:#084459;
}
.style2 {
	font-family: verdana;
	font-size: 11px;
	font-weight: bold;
	color:#084459;
}

.style3 {
	font-family: verdana;
	font-size: 11px;
	font-weight: normal;
	color:#084459;
	text-decoration:none;
}


.bluebtn{
font-family:Verdana, Arial, Helvetica, sans-serif; 
font-size:12px;
font-weight:bold;
color:#084459;
border:1px solid #084459;
background-color:#FFFFFF;
}

</style>
 <script type="text/javascript">
function validate(Form)
{
	
	if(Form.rm_name.value=="")
	{
		alert('Please enter name');
		Form.rm_name.focus();
		return false;
	}
	
	if(Form.mobile.value=="")
	{
		alert("Please Enter Your Mobile!");
		Form.mobile.focus();
		return false;
	}
	if (Form.mobile.value.length < 10 )
	{
		alert("Please Enter 10 Digits"); 
		Form.mobile.focus();
		return false;
	}

	if (Form.mobile.value.charAt(0)!="9")
	{
		alert("The number should start only with 9");
		Form.mobile.focus();
		return false;
	}    

	if(Form.email.value=="")
	{
		alert('Please enter email');
		Form.email.focus();
		return false;
	}

	if(Form.email.value!="")
	{
		if (!validmail(Form.email.value))
		{
			//alert("Please enter your valid email address!");
			Form.email.focus();
			return false;
		}
	}
	
	if(Form.city.selectedIndex==0)
	{
		alert('plz select city');
		Form.city.focus();
		return false;
	}


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
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
	}
	return true;
}

  



</script>

</head><body>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>

    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
	  <td style="padding-top:15px;"><table  width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#5BBEE0" >
		
				<tr>
				  <td width="669" align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" ><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="40" align="center"  ><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Relationship Manager Details</h1></td>
  </tr>
  <tr>
    <td align="center"  >
 
  <form name="rm_insert" action="add_rm_fullerton.php" method="post" onSubmit="return validate(document.rm_insert)">
  <table width="50%" height="100" border="0" cellpadding="5" cellspacing="0" align="center">

<tr>
      <td colspan="2"><b>Name: * </b></td>
      <td colspan="2"><input type="text" name="rm_name" >
       </td>
    </tr>
    <tr>
      <td colspan="2"><b>Contact No: *</b></td>
      <td colspan="2"><input type="text" name="mobile"  ></td>
    </tr>
    <tr>
      <td colspan="2"><b>Email Id: *</b></td>
      <td colspan="2"><input type="text" name="email" ></td>
    </tr>
    <tr>
      <td colspan="2"><b>Email Id (CC): </b></td>
      <td colspan="2"><input type="text" name="email_cc" ></td>
    </tr>
    <tr>
      <td colspan="2"><b>City: *</b></td>
      <td colspan="2">	 <!--<select name="city">
        <option value="">Select City</option>
		<?php
		/*for($i=1;$i<=count($cityList);$i++)
		{
			$getCitySql = "select City from Bidders where BidderID='".$cityList[$i]."'";
			//echo $getCitySql."<br>";
			$getCityQuery = ExecQuery($getCitySql);
			$getCity = mysql_result($getCityQuery,0,'City');
			*/
		?>
			<option value="<? //echo $cityList[$i]; ?>"><? //echo $getCity; ?><?php //echo "[".$cityList[$i]."]"; ?></option>
		<?php
		//}
		?>

		</select> -->
		<select name="city">
		<option value="">Select City</option>
		<option value="Tushal">Pune [Tushal]</option>
		<option value="Samadan Kale">Pune [Samadan kale]</option>
		<option value="Asaf Ali">Delhi [Asaf Ali]</option>
		<option value="Nehru P">Delhi [Nehru P]</option>
		<option value="Hyderabad">Hyderabad</option>
		<option value="Mumbai">Mumbai</option>
		<option value="Chennai">Chennai</option>
		<option value="Bangalore">Bangalore</option>
		</select>
		</td>
    </tr>
<tr ><td colspan="2"></td>
<td colspan="2">    <input type="submit" name="submit" value="Submit"></td>
</tr>
</table>
</form>
 </td>
 </tr>
 
</table>
</td>
			  </tr>
		  </table></td>
     
	</tr>
	<tr><td>&nbsp;</td></tr>
 
 </table>
 </td></tr></table>
 
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>

</html>
