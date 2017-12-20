<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$page_Name = "LandingPage_HL";

$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	

	function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'personal',
		'Req_Loan_Home' => 'home',
		'Req_Loan_Car' => 'car',
		'Req_Credit_Card' => 'cc',
		'Req_Loan_Against_Property' => 'property',
		'Req_Life_Insurance' => 'insurance'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$Name = $_POST['Name'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$DOB= $year."-".$month."-".$day;
	$Activate = $_POST['Activate'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$Pincode = $_POST['Pincode'];
	$City_Other = $_POST['City_Other'];
	$IncomeAmount = $_POST['IncomeAmount'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$Employment_Status = $_POST['Employment_Status'];
	$source = $_POST['source'];
	$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	$Referrer=$_REQUEST['referrer'];
	$Property_Value = $_POST['Property_Value'];
	$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");
	$IsPublic = 1;


	function InsertTataAig($RequestID, $ProductName)
	{
	//	echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = ExecQuery("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		$RowGetDate = mysql_fetch_array($GetDateSql);
		
		$TDated = $RowGetDate['Dated'];
		$TCity = $RowGetDate['City'];
		$Mobile = $RowGetDate['Mobile_Number'];
		$Product_Name = "5";
		
		$Sql = "INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, `Mobile_Number`, `T_Dated` ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";
		$query = mysql_query($Sql);
		echo "tataaig:".$Sql."<br>";
		//exit();

	}
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where RequestID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}
	
		$crap = " ".$Name." ".$Email." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			$CheckQuery = ExecQuery($CheckSql);
			//echo "<br>".$CheckSql;
			$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = mysql_result($CheckQuery, 0, 'UserID');
				$InsertProductSql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance,Property_Value,Pincode,DOB,Employment_Status) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$IncomeAmount', '$Loan_Amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(),'$Accidental_Insurance','$Property_Value','$Pincode','$DOB','$Employment_Status' )"; 
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID = mysql_insert_id();
				$InsertProductSql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance,Property_Value,Pincode,DOB,Employment_Status) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$IncomeAmount', '$Loan_Amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(),'$Accidental_Insurance','$Property_Value','$Pincode','$DOB','$Employment_Status' )";
				//echo "<br>else".$InsertProductSql;
			}
//echo "<br>else".$InsertProductSql."<br><br>";
			$InsertProductQuery = ExecQuery($InsertProductSql);
			$ProductValue = mysql_insert_id();
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Against_Property");
				}
			//exit();
			
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get banks contacts & quotes. And help us serve you better.";
			if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($FName)
				$SubjectLine = $FName.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			

			
echo "<script language=javascript>location.href='thank_loanproperty.php?r_url=Contents_Loan_Against_Property_Mustread.php'"."</script>";
		}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
	
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="css/homeloan.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<?
if($_SESSION['Temp_loan_type'] == "Req_Loan_Against_Property")
		$file_name = "closedby_lap.php";
	

?>

<?php include '~Top.php';?>

<div id="dvMainbanner">
   <?php include '~Upper.php';?>

    <div id="dvbannerContainer"> <img src="images/main_banner1.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">

<table width="500"  border="0" cellspacing="0" cellpadding="0">
		<tr><td width="30">&nbsp;</td><td>&nbsp;</td></tr>
		<tr>
		<td width="30">&nbsp;</td>
            <td>
 
 <p><b><font color="#3366CC">Thank you Your Request has been added Successfully.........</font></b></p>

     &nbsp;</td>
     </tr>
	 
            </table>
			</div>
	  <?php include '~Right1.php';?>
	
	  </div>
    <?php include '~Bottom.php';?>
	</body></html>

<!-- Google Code for lead Conversion Page -->


<script language="JavaScript" type="text/javascript">

<!--
var google_conversion_id = 1056387586;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "FFFFFF";
if (1) {
  var google_conversion_value = 1;
}

var google_conversion_label = "lead";
//-->
</script>

<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1056387586/imp.gif?value=1&label=lead&script=0">
</noscript>

<SCRIPT language="JavaScript" type="text/javascript">
<!-- Yahoo!
window.ysm_customData = new Object();
window.ysm_customData.conversion = "transId=,currency=,amount=";
var ysm_accountid  = "135AHO229GAA5G7GKVUE46C65OO";
document.write("<SCR" + "IPT language='JavaScript' type='text/javascript' " 
+ "SRC=//" + "srv1.wa.marketingsolutions.yahoo.com" + "/script/ScriptServlet" + "?aid=" + ysm_accountid 
+ "></SCR" + "IPT>");
// -->
</SCRIPT>

</body>
</html>

