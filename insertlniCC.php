<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//require 'getlistofeligiblebidders.php';
	error_reporting();
	
//	print_r($_REQUEST);
	
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


	
	$UserID = $_SESSION['UserID'];
	$Full_Name = $_REQUEST["Full_Name"];
	//$LName = $_REQUEST["LName"];
	$Name= $Full_Name;
	$Email = $_REQUEST["Email"];
	$Phone = $_REQUEST["Phone"];
	$Pancard = $_REQUEST["Pancard"];
	$CC_Holder = $_REQUEST["CC_Holder"];
	$Card_Vintage = $_REQUEST["Card_Vintage"];
	$City = $_REQUEST["City"];
	$City_Other = $_REQUEST["City_Other"];
	$Company_Name = $_REQUEST["Company_Name"];
	if(is_numeric($Company_Name))
	{
		$getCompanySql = "select company_name from cl_company_list_hdfc where clcomplistid= '".$plcompanyid."'";
		list($alreadyExist,$getCompanyQuery)=MainselectfuncNew($getCompanySql,$array = array());
		$Company_Name = $getCompanyQuery[0]['company_name'];
	}
		
	
	$Net_Salary =$_REQUEST["Net_Salary"];
	$IsPublic =1;
	$Day=$_REQUEST["day"];
	$Month=$_REQUEST["month"];
	$Year=$_REQUEST["year"];
	$DOB=$Year."-".$Month."-".$Day;
	$Type_Loan = "CreditCard";
	$source = $_REQUEST["source"];
	$Reference_Code = $_REQUEST["Reference_Code"];
	$Employment_Status = $_REQUEST["Employment_Status"];
	$Accidental_Insurance = $_REQUEST["Accidental_Insurance"];
	$cpp_card_protect = $_REQUEST["cpp_card_protect"];
	$Ibibo_compaign = $_REQUEST["Ibibo_compaign"];
	$hdfclife = $_REQUEST["hdfclife"];
	$Referrer = $_REQUEST['referrer'];
	$source = $_REQUEST['Source'];
	$Section = $_REQUEST['section'];
	$Creative = $_REQUEST['creative'];
	$Pincode = $_REQUEST["Pincode"];
	$Reference_Code = generateNumber(4);
	$No_of_Banks = $_REQUEST["No_of_Banks"];
	$ABMMU_flag = $_REQUEST["adty_brl"];
	$Salary_Account = $_REQUEST["Salary_Account"];
	$accept = $_REQUEST["accept"];

	$getDOB = $Year."".$Month."".$Day;
	$Age = DetermineAgeFromDOB($getDOB);
	
	$checkPincodeSql = "select * from barclays_pincode_list where pincode='".$Pincode."' and status=1"; 
	list($checkPincode,$checkPincodeQuery)=MainselectfuncNew($checkPincodeSql,$array = array());
	$gethdfccccompany='select company_category from HDFC_CC_Company_List where hdfc_company_name="'.$Company_Name.'"';
	list($recordcounthdfccc,$grow)=Mainselectfunc($gethdfccccompany,$array = array());
if($recordcounthdfccc>0)
	{
$hdfc_cccategory = $grow["company_category"];
	}

if($hdfc_cccategory=="Cat AB" || $hdfc_cccategory=="ELITE" || $hdfc_cccategory=="PREFERRED" || $hdfc_cccategory=="SUPERPRIME")
	{
		$Company_HDFC_Cat=1;
	}
	else
	{
		$Company_HDFC_Cat=0;
	}
	

	if($_SESSION=="")
	{
		$_SERVER['Temp_Type'] = "CreditCard";
		$_SERVER['Temp_Type_Loan']="Req_Credit_Card";
		$_SERVER['Temp_Name'] = $Name;
		$_SERVER['Temp_FName'] = $Name;
		$_SERVER['Temp_Phone'] = $Phone;
		$_SERVER['Temp_Pancard'] = $Pancard;
		$_SERVER['Temp_DOB'] = $DOB;
		$_SERVER['Temp_Email'] = $Email;
		$_SERVER['Temp_Company_Name'] = $Company_Name;
		$_SERVER['Temp_Employment_Status'] = $Employment_Status;
		$_SERVER['Temp_City'] = $City;
		$_SERVER['Temp_City_Other'] = $City_Other;
		$_SERVER['Temp_Net_Salary'] = $Net_Salary;
		$_SERVER['Temp_IsPublic'] = $IsPublic;
		$_SERVER['Temp_CC_Holder'] = $CC_Holder;
		$_SERVER['Temp_Reference_Code'] = $Reference_Code;
		$_SERVER['Temp_Phone'] = $Phone;
	
	}
	else
	{
		$_SESSION['Temp_Type'] = "CreditCard";
		$_SESSION['Temp_Type_Loan']="Req_Credit_Card";
		$_SESSION['Temp_Name'] = $Name;
		$_SESSION['Temp_Pancard'] = $Pancard;
		$_SESSION['Temp_FName'] = $Name;
		$_SESSION['Temp_Phone'] = $Phone;
		$_SESSION['Temp_DOB'] = $DOB;
		$_SESSION['Temp_Employment_Status'] = $Employment_Status;
		$_SESSION['Temp_Email'] = $Email;
		$_SESSION['Temp_Company_Name'] = $Company_Name;
		$_SESSION['Temp_City'] = $City;
		$_SESSION['Temp_City_Other'] = $City_Other;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		$_SESSION['Temp_CC_Holder'] = $CC_Holder;
		$_SESSION['Temp_Reference_Code'] = $Reference_Code;
		$_SESSION['Temp_Phone'] = $Phone;
	}
	
	$IP = getenv("REMOTE_ADDR");
	
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
	function  Insertcpp($ProductValue, $Name,$City, $Phone, $DOB, $Email, $CC_Holder )
	{
		$Dated = ExactServerdate();	
		$dataInsert = array('CPP_RequestID'=>$ProductValue, 'CPP_Product'=>'4', 'CPP_Name'=>$Name, 'CPP_City'=>$City, 'CPP_Mobile_Number'=>$Phone, 'CPP_DOB'=>$DOB, 'CPP_Dated'=>$Dated, 'CPP_Email'=>$Email, 'CPP_CC_Holder'=>$CC_Holder);
		$table = 'cpp_card_protection_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
	}
	function  Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email )
	{
	$Dated = ExactServerdate();		
		$dataInsert = array("ibibo_product"=>'4' , "ibibo_requestid"=>$ProductValue , "ibibo_name"=>$Name , "ibibo_city"=>$City , "ibibo_mobile"=>$Phone, "ibibo_dob"=>$DOB , "ibibo_car_name"=>$Ibibo_compaign , "ibibo_dated"=>$Dated , "ibibo_email"=>$Email );
		$table = 'ibibo_compaign_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
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
		
		if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
		{		
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Credit_Card Where (Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9971396361','9811215138','9999047207','9891601984') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr = count($myrow)-1;
			
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-credit-card-lead.php'"."</script>";
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
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Cpp_Compaign'=>$cpp_card_protect, 'Pincode'=>$Pincode, 'No_of_Banks'=>$No_of_Banks, 'Company_HDFC_Cat'=>$Company_HDFC_Cat, 'ABMMU_flag'=>$ABMMU_flag, 'Company_ICICI_Cat'=>$Company_ICICI_Cat, 'Salary_Account'=>$Salary_Account, 'Privacy'=>$accept);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Cpp_Compaign'=>$cpp_card_protect, 'Pincode'=>$Pincode, 'No_of_Banks'=>$No_of_Banks, 'Company_HDFC_Cat'=>$Company_HDFC_Cat, 'ABMMU_flag'=>$ABMMU_flag, 'Company_ICICI_Cat'=>$Company_ICICI_Cat, 'Salary_Account'=>$Salary_Account, 'Privacy'=>$accept);
				
				$SMSMessage = "Thanks for your Credit Card Application.Please apply at the choices given to you .If any chance you are busy, the offers have been sent to your email.Keep your Pan Number handy when you apply.";
				
				//if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
				
			}
			$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);	
			
			if($cpp_card_protect=="1" && $CC_Holder==1)
			{
				Insertcpp($ProductValue, $Name,$City, $Phone, $DOB,$Email, $CC_Holder);
			}
			if($City=="Others")
			{
				$strcity=$City_Other;
			}
			else
			{
				$strcity=$City;
			}
			
			if($hdfclife==1)
		{
			$Product=4;
			Insert_HdfcLife($Name, $strcity, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}

			if(strlen($Ibibo_compaign)>0)
			{
				Insert_ibibo($ProductValue, $Name, $strcity, $Phone, $DOB, $Ibibo_compaign, $Email);
			}
			
			$_SESSION['Temp_LID'] = $ProductValue;
			//echo $Net_Salary; 
			if($Net_Salary<100)
			{
				//header ("Location: apply-credit-card-salary-correction.php");
//				exit();
			}
			if($Net_Salary>=300000)
			{
				$SMSMessage = "Thanks for your Credit Card Application.Please apply at the choices given to you .If any chance you are busy, the same offers have been sent to your email. Keep your Pan Number handy when you apply.";
			//	if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			}
		}
		}
		
		
		
		//Code Added to mailtocommonscript.php
		$FName = $Name;
		$Checktosend="getthank_individual";
		include "scripts/mailatcommonscript.php";
		
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		if($Name)
		$SubjectLine = $Name.", Learn to get Best Deal on Credit Card";
		else
		$SubjectLine = "Learn to get Best Deal on Credit Card";
		//echo $Type_Loan;
		if(isset($Type_Loan))
		{
		//	mail($Email, $SubjectLine, $Message2, $headers);
		}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com/".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}
	}//$crap Check

header('Location: http://www.loansninsurances.com/get-credit-card-thank.php');
	exit();
?>
