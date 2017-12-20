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
		$product = FixString($product);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Loan_Amount= FixString($Loan_Amount);
		$Pincode = FixString($Pincode);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Employment_Status = FixString($Employment_Status);
		$Card_Vintage = FixString($Card_Vintage);
		$Email = FixString($Email_id);
		$Type_Loan = FixString($Type_Loan);
		$Company_Name = FixString($Company_Name);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$City = FixString($City);
		$From_Product = $_REQUEST['From_Product'];
		$City_Other = FixString($City_Other);
		$Net_Salary = $_REQUEST['IncomeAmount'];
		$CC_Holder = FixString($CC_Holder);
		$hdfclife = $_POST['hdfclife'];
		$Card_Vintage = FixString($Card_Vintage);
		$_SESSION['Temp_CC_Holder'] = $CC_Holder;
		$Annual_Turnover = FixString($Annual_Turnover);
		if($product=="Req_Loan_Personal")
		{
		if($Net_Salary<=239000)
		{
		$Direct_Allocation =1;
		$IsProcessed=1;
		}
		else
		{
			$Direct_Allocation =0;
			$IsProcessed=0;
		}

		}

		if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}

$_SESSION['Temp_mobile']= $mobile ;
$_SESSION['Temp_net_salary'] = $Net_Salary;
$_SESSION['Temp_mobile']= $mobile ;
$_SESSION['Temp_loan_amount']= $Loan_Amount ;
$_SESSION['Temp_city']= $City ;
$_SESSION['Temp_city_other']= $City_Other ;
	

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


$Type_Loan=$product;


if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery=Maindeletefunc($DeleteIncompleteSql,$array = array());
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
	
	$getdetails="select RequestID From ".$product." Where (Mobile_Number not in (9971396361,9811215138,9811555306,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;

	if($alreadyExist>0)
	{
if($product=="Req_Loan_Personal")
				{

		$ProductValue = $myrow[$myrowcontr]["RequestID"];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";
		}
		else
		{
			$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
		}

	}
	else
	{
	
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				if($product=="Req_Loan_Personal")
				{
					$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$source, 'CC_Bank'=>$From_Pro, 'Card_Vintage'=>$Card_Vintage, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance, 'Reference_Code'=>$Reference_Code, 'Direct_Allocation'=>$Direct_Allocation, 'IsProcessed'=>$IsProcessed, 'Annual_Turnover'=>$Annual_Turnover);
					$table = 'Req_Loan_Personal';
				}
				else
				{
					$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Annual_Turnover'=>$Annual_Turnover);
					$table = 'Req_Loan_Home';
				}
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$dataUserInsert = array('Email'=>$Email,'FName'=>$Name,'Phone'=>$Phone,'Join_Date'=>$Dated,'IsPublic'=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $dataUserInsert);
				if($product=="Req_Loan_Personal")
				{
					$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$source, 'CC_Bank'=>$From_Pro, 'Card_Vintage'=>$Card_Vintage, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance, 'Reference_Code'=>$Reference_Code, 'Direct_Allocation'=>$Direct_Allocation, 'IsProcessed'=>$IsProcessed, 'Annual_Turnover'=>$Annual_Turnover);
					$table = 'Req_Loan_Personal';
				}
				else
				{
					$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Annual_Turnover'=>$Annual_Turnover);
					$table = 'Req_Loan_Home';
				}
				//echo "<br>else".$InsertProductSql;
				
				
			}
			$ProductValue = Maininsertfunc ($table, $dataInsert);
		
			
			$_SESSION['Temp_LID'] = $ProductValue;
			list($First,$Last) = split('[ ]', $Name);

if($hdfclife==1)
		{
	if($product=="Req_Loan_Personal")
				{
			$Product=1;
				}
				else
			{
				$Product=2;
			}
			Insert_HdfcLife($Name, $City, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}
	if($product=="Req_Loan_Personal")
				{
if($Net_Salary<=239000)
		{

			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan.";
		}
		else
		{
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan.";
		}
		}
		else
		{
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan.";
		}
		if($product=="Req_Loan_Personal")
				{
			$proval=1;
				}
				else
		{
			$proval=2;
		}
			
			
		
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailtocommonproduct.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: newtestthankuse@gmail.com"."\n";
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
if($product=="Req_Loan_Personal")
				{
if($Net_Salary<=239000)
		{

			echo "<script language=javascript>"." location.href='apply-personal-loan-less.php'"."</script>";	
		}
		else
			{
			if((strlen(strpos($finalurl, "apply-personal-loans.php")) > 0))
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
				else
		{
			echo "<script language=javascript>"." location.href='home_loan_second_step.php'"."</script>";	
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