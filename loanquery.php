<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';


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
		 $Dated = ExactServerdate();

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

		$headers  = 'From: Deal4loans <loanqueries@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <loanqueries@deal4loans.com>\r\n";  // Return path for errors
//		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		mail('loanqueries@deal4loans.com', "New Loan Query - $From_Email", $Message, $headers);
		db_connect();
		$sql = "INSERT INTO LoanQuery (Name, EMail, Phone, Products, City, Query, RequestDate) VALUES ('$From_Name','$From_EMail','$From_Ph','$From_Pro','$From_City','$From_Query',Now())";
		$result = mysql_query($sql);
		
		$dataInsert = array("Name"=>$From_Name, "EMail"=>$From_EMail, "Phone"=>$From_Ph, "Products"=>$From_Pro, "City"=>$From_City, "Query"=>$From_Query, "RequestDate"=>$Dated);
$table = 'LoanQuery';
$insert = Maininsertfunc ($table, $dataInsert);
		
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

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Loan Query</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div align="center">
 <center>
 <table border="0" cellspacing="1" width="100%" cellpadding="0">
   <tr>
     <td width="" valign="top" align=center>
	<p>&nbsp;</p>
<Script Language="JavaScript">
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
    </Script>
 <form name="frmLoanQuery" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
 <table width="450" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   <tr>
     <td colspan="2" class="head1">Loan Query</td>
   </tr>
      <tr>
                <td colspan="2">&nbsp;</td>
     </tr>
      <tr>
                <td>Name</td>
     <td><input type="text" name="From_Name" size="30"></td>
   </tr>
   <tr>
                <td>Email ID</td>
     <td>
     <input type="text" name="From_Email" size="30"></td>
   </tr>
   <tr>
                <td>Phone/Mobile Number</td>
     <td>
     <input type="text" name="From_Ph" size="30"></td>
   </tr>
   <tr>
                <td>Product</td>
     <td>
	   <input type=checkbox name="From_Product[]"  value="Personal Loan">Personal Loan<BR>
	   <input type=checkbox name="From_Product[]"  value="Home Loan">Home Loan<BR>
	   <input type=checkbox name="From_Product[]"  value="Car Loan">Car Loan<BR>
	   <input type=checkbox name="From_Product[]"  value="Loan Against Property">Loan Againt Property<BR>
	   <input type=checkbox name="From_Product[]"  value="Credit Card">Credit Card<BR>
   </tr>


   <tr>
                <td>City</td>
     <td>
     <input type="text" name="From_City" size="30"></td>
   </tr>
   <tr>
                <td>Query Details</td>
     <td>
     <textarea rows="4" name="From_Query" cols="35"></textarea></td>
   </tr>
   <tr>
     <td colspan="2" align="center"><br>
     <input type="submit" value="Submit Query"></td>
   </tr>
  </table>
 </form>
	<p>&nbsp;</p>
     </td>
   </tr>
 </table>
</center>
</div>
</body>
</html>
