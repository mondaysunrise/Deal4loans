<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

	$msg = "Yours Loan Query Request is added.";
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$From_Name = $_REQUEST['From_Name'];
		$From_EMail = $_REQUEST['From_Email'];
		$From_Ph = $_REQUEST['From_Ph'];
		$From_Product = $_REQUEST['From_Product'];
		$From_City = $_REQUEST['From_City'];
		$From_Query = $_REQUEST['From_Query'];
		
		$From_Name = FixString($From_Name);
		$From_EMail = FixString($From_EMail);
		$From_Ph = FixString($From_Ph);
//		$From_Product = FixString($From_Product);
		$From_City = FixString($From_City);
		$From_Query = FixString($From_Query);

	   $n        = count($From_Product);
	   $i        = 0;

	   while ($i < $n)
	   {
		  $From_Pro .= "$From_Product[$i], ";
		  $i++;
	   }

		$Message  = "";
		$Message .= "New Loan Query Details"."\r\n";
		$Message .= "Name = ".$From_Name."\n";
		$Message .= "Email = ".$From_EMail."\n";
		$Message .= "Phone Number = ".$From_Ph."\n";
		$Message .= "Product = ".$From_Pro."\n";
		$Message .= "City = ".$From_City."\n";
		$Message .= "Query = ".$From_Query."\n";

		$headers  = 'From: Deal4loans <loan.query@gmail.com>' . "\r\n";
		$headers .= "Return-Path: <loan.query@gmail.com>\r\n";  // Return path for errors
//		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		mail('loan.query@gmail.com', "New Loan Query - $From_Email", $Message, $headers);
		db_connect();
		$sql = "INSERT INTO LoanQuery (Name, EMail, Phone, Products, City, Query, RequestDate) VALUES ('$From_Name','$From_EMail','$From_Ph','$From_Pro','$From_City','$From_Query',Now())";
		$result = mysql_query($sql);
		if ($result == 1)
		{
			echo "<script language=javascript>alert('".$msg."');"." location.href='index.php'"."</script>";
		}
		else
		{
			$Msg = "** There was a problem inserting your request. Please try again. !! ";
			echo "<script language=javascript>alert('".$Msg."');"." location.href='index.php'"."</script>";
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Loan Query - Deal4loans</title>
<meta name="keywords" content="Loan Query, Credit Card Query, Home Loan Query, Personal Loan Query, Ask Amitoj">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
 <script language="JavaScript" type="text/javascript">
   function validateMe(theFrm){
	if(!checkData(theFrm.From_Name, 'Name', 5))
	{
		return false;
	}

	if(!checkData(theFrm.From_Email, 'Email', 6))
	{
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
	if(!checkData(theFrm.From_Ph, 'Phone/Mobile Number', 8))
		return false;
	if(!checkData(theFrm.From_City, 'City', 5))
		return false;
	if(!checkData(theFrm.From_Query, 'Query Details', 10))
		return false;
		return true
    }
                                            </script>
</head>

<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<div class="lfttxtbar">
  <span><a href="index.php">Home</a> > Loan Query</span>
	
<div id="txt">	
	 <form action="<? echo $_SERVER['PHP_SELF'] ?>" method="post" name="frmLoanQuery" id="frmLoanQuery" onSubmit="return validateMe(this);">
 <table width="458" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="middle"  >&nbsp;</td>
  </tr>
  <tr>
    <td height="74" valign="middle" background="new-images/apl-tp.gif" style="background-repeat:no-repeat;"><h1 >Loan Query</h1></td>
  </tr>
  <tr>
    <td class="aplfrm"><table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td width="30%" height="35" class="frmtxt"><b>Name</b></td>
        <td width="70%"><input name="From_Name" type="text"  size="40" /></td>
      </tr>

	<tr>
	  <td class="frmtxt"><b>Email ID</b></td>
	  <td><input name="From_Email" type="text" class="form" size="40" /></td>
	</tr>
	<tr>
	  <td class="frmtxt"><b>Phone/Mobile Number</b></td>
	  <td><input name="From_Ph" type="text" class="form" size="0" /></td>
	</tr>
	<tr>
	  <td class="frmtxt"><b>Product</b></td>
	  <td><input type="checkbox" name="From_Product[]"  value="Personal Loan" class="NoBrdr"/>
		  <span class="frmtxt">Personal Loan<br />
		  <input type="checkbox" name="From_Product[]"  value="Home Loan" class="NoBrdr" />
			Home Loan<br />
			<input type="checkbox" name="From_Product[]"  value="Car Loan" class="NoBrdr" />
			Car Loan<br />
			<input type="checkbox" name="From_Product[]"  value="Loan Against Property" class="NoBrdr" />
			Loan Againt Property<br />
			<input type="checkbox" name="From_Product[]"  value="Credit Card" class="NoBrdr"/>
			Credit Card<br />
		</span> </td>
	</tr>
	<tr>
	  <td class="frmtxt"><b>City</b></td>
	  <td><input name="From_City" type="text" class="form" size="0" /></td>
	</tr>
	<tr>
	  <td class="frmtxt"><b>Query Details</b></td>
	  <td><textarea name="From_Query" cols="35" rows="4" class="form"></textarea></td>
	</tr>
	<tr>
        <td colspan="2" align="center"><br />
            <input name="submit" type="submit" class="btnclr" value="Submit..." /></td>
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

