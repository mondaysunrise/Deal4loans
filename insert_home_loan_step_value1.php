<?php
	//require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	
	$page_Name = "LandingPage_HL";

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
	$finalurl=$_POST["PostURL"];
	$Activate = $_POST['Activate'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	$Net_Salary = $_POST['Net_Salary'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	//$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Referrer=$_REQUEST['referrer'];
	//$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");
	$hdfclife = $_POST["hdfclife"];
	$mahindra_life = $_REQUEST["mahindra_life"];
	$IsPublic = 1;
	$accept = $_POST['accept'];

	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
			$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());

	}
	function Insert_clientlead($ProductValue, $Name, $City, $Phone, $Email, $mahindra_life)
	{
		$Dated = ExactServerdate();
		$dataInsert = array('product_type'=>'2', 'requestid'=>$ProductValue, 'clientld_name'=>$Name, 'clientld_email'=>$Email, 'clientld_mobile'=>$Phone, 'clientld_city'=>$City, 'client_name'=>'mahindra_lifespace', 'clientld_date'=>$Dated, 'client_splcondition'=>$mahindra_life);
		$table = 'client_campaign_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
	}

	$crap = " ".$Name." ".$Email." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From ".$Type_Loan."  Where (Mobile_Number not in (9971396361,9999570210,9811215138,9911940202,9811555306,9873678914) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
				list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$CheckQuery)=MainselectfuncNew($CheckSql,$array = array());
			$CheckQuerycontr=count($CheckQuery)-1;
				$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $CheckQuery[$CheckQuerycontr]['UserID'];
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance, "Employment_Status"=>$Employment_Status, 'Privacy'=>$accept);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance, "Employment_Status"=>$Employment_Status, 'Privacy'=>$accept);
			}
			
				$ProductValue = Maininsertfunc ($Type_Loan, $data);

			$_SESSION['Temp_LID'] = $ProductValue;			
			$_SESSION['Temp_Phone'] = $Phone;
$_SESSION['Temp_City'] = $City;
$_SESSION['Temp_Net_Salary'] = $Net_Salary; 
$_SESSION['Temp_Loan_Amount'] = $Loan_Amount; 
$_SESSION['Temp_City_Other'] = $City_Other;

	if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}

if($hdfclife==1)
		{
			$Product=2;
			Insert_HdfcLife($Name, $City, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}

if(strlen($mahindra_life)>0)
		{
			Insert_clientlead($ProductValue, $Name, $strcity, $Phone, $Email, $mahindra_life);
		}
			//exit ();
			list($First,$Last) = split('[ ]', $Name);

			//echo "heelo";
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan.";
			if(strlen(trim($Phone)) > 0)
				NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
			
			
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
			
			}
		
	 if((strlen(strpos($finalurl, "lic-housing-home-loan.php")) > 0))
		{

echo "<script language=javascript>"." location.href='lic-housing-home-loan-continue.php'"."</script>";	
		}
else if((strlen(strpos($finalurl, "lic-housing-home-loan1.php")) > 0))
		{

echo "<script language=javascript>"." location.href='lic-housing-home-loan-continue1.php'"."</script>";	
		}
else if((strlen(strpos($finalurl, "home-loan-citibank.php")) > 0))
	{
	echo "<script language=javascript>"." location.href='home-loan-citibank-continue.php'"."</script>";	
	}
else if((strlen(strpos($finalurl, "home-loan-axis-bank.php")) > 0))
	{
	echo "<script language=javascript>"." location.href='home-loan-axis-bank-continue.php'"."</script>";	
	}
else if((strlen(strpos($finalurl, "home-loan-axis-bank.php")) > 0))
{
echo "<script language=javascript>"." location.href='home-loan-axis-bank-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "home-loan-citifinancial.php")) > 0))
{
echo "<script language=javascript>"." location.href='home-loan-citifinancial-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "home-loan-kotak-mahindra-bank.php")) > 0))
{
echo "<script language=javascript>"." location.href='home-loan-kotak-mahindra-bank-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "dhfl.php")) > 0))
{
echo "<script language=javascript>"." location.href='dhfl-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "icici-hfc-home-loan.php")) > 0))
{
echo "<script language=javascript>"." location.href='icici-hfc-home-loan-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "home-loan-lic-housing.php")) > 0))
{
echo "<script language=javascript>"." location.href='home-loan-lic-housing-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "home-loan-idbi-homefinance.php")) > 0))
{
echo "<script language=javascript>"." location.href='home-loan-idbi-homefinance-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "deutsche-bank-home-loan.php")) > 0))
{
echo "<script language=javascript>"." location.href='deutsche-bank-home-loan-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "home-loan-standard-chartered-bank.php")) > 0))
{
echo "<script language=javascript>"." location.href='home-loan-standard-chartered-bank-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "home-loan-gemoney.php")) > 0))
{
echo "<script language=javascript>"." location.href='home-loan-gemoney-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "home-loan-ingvysya-bank.php")) > 0))
{
echo "<script language=javascript>"." location.href='home-loan-ingvysya-bank-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "home-loan-idbi-bank.php")) > 0))
{
echo "<script language=javascript>"." location.href='home-loan-idbi-bank-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "home-loan-reliance.php")) > 0))
{
echo "<script language=javascript>"." location.href='home-loan-reliance-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "sbi-home-loan.php")) > 0))
{
echo "<script language=javascript>"." location.href='sbi-home-loan-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "sbi-home-loan1.php")) > 0))
{
echo "<script language=javascript>"." location.href='sbi-home-loan-continue1.php'"."</script>";	
}

else if((strlen(strpos($finalurl, "home-loan-sbi.php")) > 0))
{
echo "<script language=javascript>"." location.href='home-loan-sbi-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "hdfc-ltd-home-loan.php")) > 0))
{
echo "<script language=javascript>"." location.href='hdfc-ltd-home-loan-continue.php'"."</script>";	
}
else if((strlen(strpos($finalurl, "hdfc-ltd-home-loan1.php")) > 0))
{
echo "<script language=javascript>"." location.href='hdfc-ltd-home-loan-continue1.php'"."</script>";	
}
else
			{
echo "<script language=javascript>"." location.href='home_loan_second_step_n.php'"."</script>";	
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

?>