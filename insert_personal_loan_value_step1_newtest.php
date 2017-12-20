<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
$Dated = ExactServerdate();

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

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		$UserID = $_SESSION['UserID'];
		$finalurl=$_POST["PostURL"];
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Loan_Amount= FixString($Loan_Amount);
		$Pincode = FixString($Pincode);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Employment_Status = FixString($Employment_Status);
		$Card_Vintage = FixString($Card_Vintage);
		$Email = FixString($Email);
		$Type_Loan = FixString($Type_Loan);
		$Company_Name = FixString($Company_Name);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$City = FixString($City);
		$From_Product = $_REQUEST['From_Product'];
		$bnkID = $_REQUEST['bnkID'];
		$City_Other = FixString($City_Other);
		$Net_Salary = $_REQUEST['IncomeAmount'];
		$insID_All = $_REQUEST['insID_All'];
		$accept = $_REQUEST['accept'];
		$CC_Holder = FixString($CC_Holder);
		$Card_Vintage = FixString($Card_Vintage);
		$_SESSION['Temp_CC_Holder'] = $CC_Holder;
		$edelweiss = FixString($edelweiss);
		$cpp_card_protect = FixString($cpp_card_protect);
		$Dated = ExactServerdate();
		if($Net_Salary<=239000)
		{
		//$Reference_Code = generateNumber(4);
		$Direct_Allocation =1;
		$IsProcessed=1;
		}
		else
		{
			$Reference_Code = "";
			$Direct_Allocation =0;
			$IsProcessed=0;
		}

		$IsPublic = 1;
		if(count($bnkID)==0 && $insID_All=="All")
		{
			$bank_id="All";
		}
		else
		{
			$bank_id="";
		$j       = count($bnkID);
		   $l      = 0;
		   while ($l < $j)
		   {
			  $bank_id .= "$bnkID[$l], ";
			 $l++;
			 }
			 echo $bank_id;
		  }
		
		$n       = count($From_Product);
		   $i      = 0;
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$Section=$_REQUEST['section'];
		$Creative=$_REQUEST['creative'];
		$IP = getenv("REMOTE_ADDR");


$Type_Loan="Req_Loan_Personal";


if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	

function  InsertEdelweiss($ProductValue, $Name,$City, $Phone, $DOB, $Pincode )
	{
$Dated = ExactServerdate();
			$dataInsert = array("T_RequestID"=>$ProductValue, "E_Product"=>1, "E_Name"=>$Name, "E_City"=>$City, "E_Mobile_Number"=>$Phone, "E_DOB"=>$DOB, "E_Pincode"=>$Pincode, "E_Dated"=>$Dated);
$table = 'edelweiss_leads';
$insert = Maininsertfunc ($table, $dataInsert);
	
	}

function  Insertcpp($ProductValue, $Name,$City, $Phone, $DOB, $Email )
	{
		$Dated = ExactServerdate();
		$dataInsert = array("CPP_RequestID"=>$ProductValue, "CPP_Product"=>1, "CPP_Name"=>$Name, "CPP_City"=>$City, "CPP_Mobile_Number"=>$Phone, "CPP_DOB"=>$DOB, "CPP_Dated"=>$Dated, "CPP_Email"=>$Email);
$table = 'cpp_card_protection_leads';
$insert = Maininsertfunc ($table, $dataInsert);
		
	}

		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Personal Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9891118553','9911940202','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	 list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		$cntr=0;
	
	if($alreadyExist>0)
	{

		$ProductValue=$myrow[$cntr]['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";

	}
	else
	{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			 list($CheckNumRows,$Arrrow)=MainselectfuncNew($CheckSql,$array = array());
		$cntr=0;
			
			if($CheckNumRows>0)
			{
				$UserID = $Arrrow[$cntr]['UserID'];
			
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Dated"=>$Dated, "Pincode"=>$Pincode, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance, "Reference_Code"=>$Reference_Code, "Direct_Allocation"=>$Direct_Allocation, "IsProcessed"=>$IsProcessed, "Edelweiss_Compaign"=>$edelweiss, "Cpp_Compaign"=>$cpp_card_protect, "Is_Permit"=>$accept);
			
			
			}
			else
			{
				
				$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
			$table = 'wUsers';
			$UserID1 = Maininsertfunc ($table, $dataInsert);
				
				$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Dated"=>$Dated, "Pincode"=>$Pincode, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance, "Reference_Code"=>$Reference_Code, "Direct_Allocation"=>$Direct_Allocation, "IsProcessed"=>$IsProcessed, "Edelweiss_Compaign"=>$edelweiss, "Cpp_Compaign"=>$cpp_card_protect, "Is_Permit"=>$accept);
				
				}
				$table = 'Req_Loan_Personal';
				$ProductValue = Maininsertfunc ($table, $dataInsert);
			
			if($edelweiss=="1")
				{
				 InsertEdelweiss($ProductValue, $Name,$City, $Phone, $DOB,$Pincode  );
				}

				if($cpp_card_protect=="1")
				{
				 Insertcpp($ProductValue, $Name,$City, $Phone, $DOB,$Email);
				}

			$_SESSION['Temp_LID'] = $ProductValue;
			$_SESSION['bank_id'] = $bank_id;
			$_SESSION['city'] = $City;
			list($First,$Last) = split('[ ]', $Name);

	
if($Net_Salary<=239000)
		{

			$SMSMessage = "Dear $First,your activation code is: $Reference_Code.Use it in 2nd step to get bidder contacts & quotes. And help us serve you better";
		}
		else
		{
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan. You will get a call from us to give you quotes & information to get you best deal for loans.";
		}
			//if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
		
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}

//echo $finalurl."<br>";

if($Net_Salary<=239000)
		{
echo "<script language=javascript>"." location.href='personal-loans-second-step.php'"."</script>";
			echo "<script language=javascript>"." location.href='apply-personal-loan-less.php'"."</script>";	
		}
		else
			{
		if((strlen(strpos($finalurl, "apply-personal-loans.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "personal-loans-apply.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='personal-loans-apply-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loans2.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-sbi-personal-loans.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-sbi-personal-loans-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "personal-loan-apply.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='personal-loan-apply-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "personal-loan-application.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='personal-loan-application-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loan-continue2.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-continue2-test.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loan-continue-test.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='personal-loans-second-step.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "Youmint_Mailer")) > 0))
		{

echo "<script language=javascript>"." location.href='thank_youmint.php'"."</script>";	
		}
		else
		{
			echo "<script language=javascript>"." location.href='apply-for-personal-loans-continue.php'"."</script>";	
		}
	}

	}
		}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}


}
?>