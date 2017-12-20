<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//require 'getlistofeligiblebidders.php';
	error_reporting();
	$page_Name = "LandingPage_PL";
function DetermineAgeFromDOB ($YYYYMMDD_In)
	{
	  $yIn=substr($YYYYMMDD_In, 0, 4);
	  $mIn=substr($YYYYMMDD_In, 4, 2);
	  $dIn=substr($YYYYMMDD_In, 6, 2);
	  $ddiff = date("d") - $dIn;
	  $mdiff = date("m") - $mIn;
	  $ydiff = date("Y") - $yIn;
	  if ($mdiff < 0)
	  {
		$ydiff--;
	  } elseif ($mdiff==0)
	  {
		if ($ddiff < 0)
		{
		  $ydiff--;
		}
	  }
	  return $ydiff;
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


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
	$$a=$b;
	
	$UserID = $_SESSION['UserID'];
	$Full_Name = FixString($Full_Name);
	//$LName = FixString($LName);
	$Name= $Full_Name;
	$Email = FixString($Email);
	$Phone = FixString($Phone);
	$Pancard = FixString($Pancard);
	$CC_Holder = FixString($CC_Holder);
	$Card_Vintage = FixString($Card_Vintage);
	$City = FixString($City);
	$City_Other = FixString($City_Other);
	$Company_Name = FixString($Company_Name);
	$Net_Salary =FixString($Net_Salary);
	$Credit_Limit =FixString($Credit_Limit);	
	$IsPublic =1;
	$Day=FixString($day);
	$Month=FixString($month);
	$Year=FixString($year);
	$DOB=$Year."-".$Month."-".$Day;
	$Age = $_POST['Age'];
	if($Age>20)
	{
	//print_r($_POST);
		$Yr = date("Y") - $Age;
		$dobTime  = mktime(date("H"), date("i"), 0, date("m")  , date("d"), $Yr);
		$DOB = date("Y-m-d", $dobTime);
	}
	$Type_Loan = "CreditCard";
	$source = FixString($source);
	$Reference_Code = FixString($Reference_Code);
	$Employment_Status = FixString($Employment_Status);
	$Accidental_Insurance = FixString($Accidental_Insurance);
	$cpp_card_protect = FixString($cpp_card_protect);
	$Ibibo_compaign = FixString($Ibibo_compaign);
	$hdfclife = FixString($hdfclife);
	$Referrer = $_REQUEST['referrer'];
	$source = $_REQUEST['source'];
	$Section = $_REQUEST['section'];
	$Creative = $_REQUEST['creative'];
	$Pincode = FixString($Pincode);
	$Loan_Any = $_REQUEST["Loan_Any"];
		$nn = count($Loan_Any);
	 $ii  = 0;
	while ($ii < $nn)
	{
	  $Loan_A .= "$Loan_Any[$ii], ";
	 $ii++;
	 }
	
		$Salary_Account = $_REQUEST["salary_account"];
		 $n = count($Salary_Account);
				 $i  = 0;
				while ($i < $n)
				{
				  $Salary_Arr .= "$Salary_Account[$i], ";
				 $i++;
				 }

	if(count($Salary_Account)>0)
	{
		$Salary_A = $Salary_Arr;
	}
	else
	{
		$Salary_A = $_REQUEST["salary_account"];
	}
	$loanbank_name = $_REQUEST["loanbank_name"];	// 	Applied_With_Banks
	$u = count($loanbank_name);
	 $p  = 0;
	while ($p < $u)
	{
	  $loanbank_n .= "$loanbank_name[$p], ";
	 $p++;
	 }

	$No_of_Banks = $_REQUEST["No_of_Banks"];
	$ABMMU_flag = $_REQUEST["adty_brl"];
		$accept = $_REQUEST["accept"];

	$getDOB = $Year."".$Month."".$Day;
	$Age = DetermineAgeFromDOB($getDOB);
	
	$checkPincodeSql = "select * from barclays_pincode_list where pincode='".$Pincode."' and status=1"; 
	$checkPincodeQuery = ExecQuery($checkPincodeSql);
	$checkPincode = mysql_num_rows($checkPincodeQuery);
	
	$gethdfccccompany='select company_category from HDFC_CC_Company_List where hdfc_company_name="'.$Company_Name.'"';
// echo $getcompany;
$getcccompanyresult = ExecQuery($gethdfccccompany);
$grow=mysql_fetch_array($getcccompanyresult);
$recordcounthdfccc = mysql_num_rows($getcccompanyresult);
if($recordcounthdfccc>0)
	{
$hdfc_cccategory = $grow["company_category"];
	}

if($hdfc_cccategory=="Cat AB" || $hdfc_cccategory=="PREFERRED" )
	{
		$Company_HDFC_Cat=1;
	}
	else if($hdfc_cccategory=="ELITE" || $hdfc_cccategory=="SUPERPRIME")
	{
		$Company_ICICI_Cat=1;
		$Company_HDFC_Cat=1;
	}
	else
	{
		$Company_ICICI_Cat=0;
		$Company_HDFC_Cat=0;
	}
	
	
	$IP = getenv("REMOTE_ADDR");
	$IP= $_SERVER['HTTP_X_REAL_IP'];
	
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}
	
	
	$crap = " ".$Name." ".$Email." ".$Company_Name;
	$crapValue = validateValues($crap);
	$_SESSION['crapValue'] = $crapValue;
	if($crapValue=='Put')
	{
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
		
		if(($validMobile==1) && ($Name!=""))
		{		
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Credit_Card Where (Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9971396361','9811215138','9999047207','9873678914','9999570210') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			//echo $getdetails."<br>";
			//exit();
			$checkavailability = ExecQuery($getdetails);
			$alreadyExist = mysql_num_rows($checkavailability);
			$myrow = mysql_fetch_array($checkavailability);
		
			if($alreadyExist>0)
			{
				$ProductValue=$myrow['RequestID'];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-credit-card-lead.php'"."</script>";
			}
			else
			{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			$CheckQuery = ExecQuery($CheckSql);
			//echo "<br>".$CheckSql;
			$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = mysql_result($CheckQuery, 0, 'UserID');
				$InsertProductSql = "INSERT INTO Req_Credit_Card( UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, DOB, IsPublic, Dated,  Reference_Code, source, Pancard, CC_Holder,Card_Vintage,IP_Address,Referrer,Creative,Section,Updated_Date,Accidental_Insurance, Cpp_Compaign, Pincode, No_of_Banks,Company_HDFC_Cat,ABMMU_flag,Company_ICICI_Cat,Salary_Account,Privacy,Credit_Limit, Loan_Any, Applied_With_Banks,Allocated)	VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Net_Salary', '$DOB', '$IsPublic', Now(), '$Reference_Code', 'test lead', '$Pancard','$CC_Holder','$Card_Vintage','$IP','$Referrer','$Creative','$Section',Now(),'$Accidental_Insurance','".$cpp_card_protect."', '".$Pincode."','".$No_of_Banks."','".$Company_HDFC_Cat."','".$ABMMU_flag."','".$Company_ICICI_Cat."','".$Salary_A."','".$accept."','".$Credit_Limit."', '".$Loan_A."','".$loanbank_n."','1' )"; 
					//echo "<br>if".$InsertProductSql;
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID1 = mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Credit_Card( UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, DOB, IsPublic, Dated,  Reference_Code, source, Pancard, CC_Holder,Card_Vintage,IP_Address,Referrer,Creative,Section, Updated_Date, Accidental_Insurance, Cpp_Compaign, Pincode, No_of_Banks, Company_HDFC_Cat, ABMMU_flag, Salary_Account,Privacy, Company_ICICI_Cat,Credit_Limit, Loan_Any, Applied_With_Banks,Allocated)			VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Net_Salary', '$DOB', '$IsPublic', Now(), '$Reference_Code', 'test lead', '$Pancard','$CC_Holder','$Card_Vintage','$IP','$Referrer','$Creative','$Section',Now(),'$Accidental_Insurance','".$cpp_card_protect."','".$Pincode."' ,'".$No_of_Banks."','".$Company_HDFC_Cat."', '".$ABMMU_flag."', '".$Salary_A."','".$accept."','".$Company_ICICI_Cat."','".$Credit_Limit."', '".$Loan_A."','".$loanbank_n."','1')";
									
			}
			
			$InsertProductQuery = ExecQuery($InsertProductSql);
			$ProductValue = mysql_insert_id();
			
			
			if($City=="Others")
			{
				$strcity=$City_Other;
			}
			else
			{
				$strcity=$City;
			}
						
			$_SESSION['Temp_LID'] = $ProductValue;
			
			
		

		
				$ProductValueencode = urlencode($ProductValue);
				header("Location: apply-credit-card-testcontinue.php?id=".$ProductValueencode);
				exit();
		}
		}	
		

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
//exit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<META HTTP-EQUIV="Refresh" CONTENT="8;URL=credit-card-thank.php">-->
<title>Credit Card Processing</title>

</head>
<body style="margin:0px; padding:0px;">

 <? if((strlen(strpos($_SERVER['HTTP_REFERER'], "sbi-credit-cards-apply.php")) > 0))
	 {?>
	 
<!-- Google Code for SBi Credit Card Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "SPFnCIXr0wEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=SPFnCIXr0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


	 <?  }
 elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "credit-cards-apply.php")) > 0))
	 {?>

 <script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "p-B1CLH8iAEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=p-B1CLH8iAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<? } ?>
<? if($source=="apply-for-cc-new")
{ ?>
<!-- Google Code for Deal4loans Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "jeuMCI2c2QEQh8-3_AM";
var google_conversion_value = 0;
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1066264455/?value=0&amp;label=jeuMCI2c2QEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<? } ?>	 
</body>
</html>




