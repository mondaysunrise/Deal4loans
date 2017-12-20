<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

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
	if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		$UserID = $_SESSION['UserID'];
		$finalurl=$_POST["PostURL"];
		$Name = $_REQUEST["Name"];
		$Day=$_REQUEST["day"];
		$Month=$_REQUEST["month"];
		$Year=$_REQUEST["year"];
		$Loan_Amount= FixString($Loan_Amount);
		$Pincode = FixString($Pincode);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = $_REQUEST["Phone"];
		$Employment_Status = FixString($Employment_Status);
		$Card_Vintage = FixString($Card_Vintage);
		$Email = $_REQUEST["Email"];
		$Type_Loan = $_REQUEST["Type_Loan"];
		$Company_Name = FixString($Company_Name);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$City = $_REQUEST["City"];
		$From_Product = $_REQUEST['From_Product'];
		$City_Other = FixString($City_Other);
		$Net_Salary = $_REQUEST['IncomeAmount'];
		$CC_Holder = FixString($CC_Holder);
		$Card_Vintage = FixString($Card_Vintage);
		$_SESSION['Temp_CC_Holder'] = $CC_Holder;
		$edelweiss = FixString($edelweiss);
		$cpp_card_protect = FixString($cpp_card_protect);
		$Ibibo_compaign = FixString($Ibibo_compaign);
		$accept = $_REQUEST["accept"];

$_SESSION['day'] = $Day;
$_SESSION['month'] = $Month;
$_SESSION['year'] = $Year;


		if($Net_Salary<=239000)
		{
		if((strlen(strpos($finalurl, "apply-personal-loans-new.php")) > 0) || (strlen(strpos($finalurl, "apply-personal-loan-quote.php")) > 0))
		{
				$Reference_Code = "";
			$Direct_Allocation =0;
			$IsProcessed=0;
		}
		else
			{
		$Reference_Code = generateNumber(4);
		$Direct_Allocation =1;
		$IsProcessed=1;
			}
		}
		
		else
		{
			$Reference_Code = "";
			$Direct_Allocation =0;
			$IsProcessed=0;
		}

		$IsPublic = 1;
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
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	


		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
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
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( (Mobile_Number not in ('9971396361','9811215138','9811555306')) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr = count($myrow)-1;
	$checkNum = $alreadyExist;

			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
		$_SESSION['City'] = $City;
		echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";

	}
	else
	{
	
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$source, 'CC_Bank'=>$From_Pro, 'Card_Vintage'=>$Card_Vintage, 'Referrer'=>$REFERER_URL, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance, 'Reference_Code'=>$Reference_Code, 'Direct_Allocation'=>$Direct_Allocation, 'IsProcessed'=>$IsProcessed, 'Edelweiss_Compaign'=>$edelweiss, 'Cpp_Compaign'=>$cpp_card_protect, 'Annual_Turnover'=>$Annual_Turnover, 'Privacy'=>$accept);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$source, 'CC_Bank'=>$From_Pro, 'Card_Vintage'=>$Card_Vintage, 'Referrer'=>$REFERER_URL, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance, 'Reference_Code'=>$Reference_Code, 'Direct_Allocation'=>$Direct_Allocation, 'IsProcessed'=>$IsProcessed, 'Edelweiss_Compaign'=>$edelweiss, 'Cpp_Compaign'=>$cpp_card_protect, 'Annual_Turnover'=>$Annual_Turnover, 'Privacy'=>$accept);
				//echo "<br>else".$InsertProductSql;
				}
	//		echo "hello>".$InsertProductSql."<br>";
				$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);		
			if($edelweiss=="1")
				{
				 //InsertEdelweiss($ProductValue, $Name,$City, $Phone, $DOB,$Pincode  );
				}

				if($cpp_card_protect=="1")
				{
				// Insertcpp($ProductValue, $Name,$City, $Phone, $DOB,$Email);
				}

			$strcity=$City;


		if(strlen($Ibibo_compaign)>0)
		{
			Insert_ibibo($ProductValue, $Name, $strcity, $Phone, $DOB, $Ibibo_compaign, $Email);
		}

			$_SESSION['Temp_LID'] = $ProductValue;
			list($First,$Last) = split('[ ]', $Name);

	
if($Net_Salary<=239000)
		{
			$SMSMessage = "Dear $First,your activation code is: $Reference_Code.Use it in 2nd step to get bidder contacts & quotes. And help us serve you better";
		}
		else
		{
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan. You will get a call from us to give you quotes & information to get you best deal for loans.";
		}
			if(strlen(trim($Phone)) > 0 && strlen(trim($SMSMessage)) > 0 )
				SendSMS($SMSMessage, $Phone);
		
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailtocommonproduct.php";

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
			if((strlen(strpos($finalurl, "personal-loan-interest-rate")) > 0) )
					{
					echo "<script language=javascript>"." location.href='personal-loan-interest-rate-lessstage2.php'"."</script>";
				}
			else if((strlen(strpos($finalurl, "personal-loans2")) > 0) )
				{
				echo "<script language=javascript>"." location.href='personal-loans-stage-21.php'"."</script>";	
				}	
			else
			{
				echo "<script language=javascript>"." location.href='personal-loans-stage-2.php'"."</script>";	
			}	
		}
		else
			{
			if((strlen(strpos($finalurl, "personal-loan-interest-rate")) > 0) )
				{
echo "<script language=javascript>"." location.href='personal-loan-interest-rate-stage2.php'"."</script>";	
				}
				else if((strlen(strpos($finalurl, "personal-loans2")) > 0) )
				{
				echo "<script language=javascript>"." location.href='personal-loans-stage21.php'"."</script>";	
				}	
				else
				{
			echo "<script language=javascript>"." location.href='personal-loans-stage2.php'"."</script>";	
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