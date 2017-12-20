<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';



if(isset($_POST['submit']))
{
	$rm_name=$_POST['rm_name'];
	
	
	$sql="update telecaller_fullerton  set name= '".$rm_name."' where id = '".$id."'";
 	
	$query=ExecQuery($sql);
//echo $sql;
header("Location: view_tc.php");
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
    <td height="40" align="center"  ><h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">TeleCaller Details</h1></td>
  </tr>
  <tr>
    <td align="center"  >
<?php
$post = $_GET['id'];
  $getData = "select * from telecaller_fullerton where 1=1 and id='".$post."'";
  $getDataQuery = ExecQuery($getData);
  $recordcount = mysql_num_rows($getDataQuery);
  $rmname = mysql_result($getDataQuery,0,'name');

  ?>
  <form name="rm_insert" action="update_fullerton_tc.php" method="post" onSubmit="return validate(document.rm_insert)">
  <table width="50%" height="100" border="0" cellpadding="5" cellspacing="0" align="center">

<tr>
      <td colspan="2"><b>Name: * </b></td>
      <td colspan="2">
	  <input type="hidden" name="id" value="<?php echo $post; ?>" >
	  <input type="text" name="rm_name" value="<?php echo $rmname; ?>" >       </td>
    </tr>
        
    <tr>
      <td colspan="2">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
<tr ><td colspan="2"></td>
<td colspan="2"> 
   <input type="submit" name="submit" value="Submit"></td>
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
