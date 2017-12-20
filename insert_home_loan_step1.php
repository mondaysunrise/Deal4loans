<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';


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
		$finalurl=$_POST["PostURL"];
		$City = $_POST['City'];
		$Property_Identified= $_POST['Property_Identified'];
		$Property_Loc= $_POST['Property_Loc'];
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$dob_arr[] = $_POST['year'];
		$dob_arr[] = $_POST['month'];
		$dob_arr[] = $_POST['day'];
		$dateofbirth = implode("-", $dob_arr);
		$company_name = $_POST['company_name'];
		$Employment_Status = $_POST['Employment_Status'];
		$Net_Salary = $_POST['Net_Salary'];
		$monthly_income = ($Net_Salary /12);
		$obligations = $_POST['obligations'];
		$loan_amount = $_POST['Loan_Amount'];
		$co_appli = $_POST['co_appli'];
		$co_name = $_POST['co_name'];
		$dob_arr_co[] = $_POST['co_year'];
		$dob_arr_co[] = $_POST['co_month'];
		$dob_arr_co[] = $_POST['co_day'];
		$DOB_co = implode("-", $dob_arr_co);
		$co_monthly_income = $_POST['co_monthly_income'];
		$co_obligations = $_POST['co_obligations'];
		$property_value = $_POST['property_value'];
		$Pincode = $_POST['Pincode'];
		$insID_All = $_REQUEST['insID_All'];
		$accept = $_REQUEST['accept'];
		$bnkID = $_REQUEST['bnkID'];
		$Activate = $_POST['Activate'];
		$Type_Loan = "Req_Loan_Home";
		$source = $_POST['source'];
		$Creative = $_POST['creative'];
		$Section = $_POST['section'];
		$Accidental_Insurance = $_POST['Accidental_Insurance'];
		$Referrer=$_REQUEST['referrer'];
		$IP = getenv("REMOTE_ADDR");
		$edelweiss = $_POST["edelweiss"];
		
		
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
		
	 }
 //echo $bank_id;
	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}
	
function  InsertEdelweiss($ProductValue, $Name,$City, $Phone, $DOB , $Pincode)
	{
		$Sql = "INSERT INTO edelweiss_leads ( `E_RequestID` , `E_Product` , `E_Name`, `E_City`, `E_Mobile_Number`, `E_DOB`,  E_Pincode ,`E_Dated` ) VALUES ('".$ProductValue."', '2','".$Name."','".$City."', '".$Phone."' ,'".$DOB."','".$Pincode."', Now())";
		$query = mysql_query($Sql);
		//echo "Edelweiss:".$Sql."<br>";
		//exit();
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
			
			$getdetails="select RequestID From ".$Type_Loan."  Where (Mobile_Number='".$Phone."' and Mobile_Number not in ('9891118553','9911940202','9811215138','9971396361') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			//echo $getdetails."<br>";
			//exit();
			$checkavailability = ExecQuery($getdetails);
			$alreadyExist = mysql_num_rows($checkavailability);
			$myrow = mysql_fetch_array($checkavailability);
		
			if($alreadyExist>0)
			{
				$ProductValue=$myrow['RequestID'];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
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
				$InsertProductSql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance,Property_Identified,Employment_Status,DOB,  	  Property_Loc,Co_Applicant_Name,Co_Applicant_DOB,Co_Applicant_Income,Co_Applicant_Obligation,Property_Value, Total_Obligation, Edelweiss_Compaign, Pincode,Is_Permit) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$Net_Salary', '$loan_amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(),'$Accidental_Insurance','$Property_Identified','$Employment_Status','$dateofbirth','$Property_Loc','$co_name','$DOB_co','$co_monthly_income','$co_obligations','$property_value','$obligations','".$edelweiss."' , '".$Pincode."','".$accept."' )"; 
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID = mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance,Property_Identified,Employment_Status,DOB,  	  Property_Loc,Co_Applicant_Name,Co_Applicant_DOB,Co_Applicant_Income,Co_Applicant_Obligation,Property_Value, Total_Obligation, Edelweiss_Compaign, Pincode,Is_Permit) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$Net_Salary', '$loan_amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(),'$Accidental_Insurance','$Property_Identified','$Employment_Status','$dateofbirth','$Property_Loc','$co_name','$DOB_co','$co_monthly_income','$co_obligations','$property_value','$obligations', '".$edelweiss."','".$Pincode."','".$accept."' )";
				//echo "<br>else".$InsertProductSql;
			}
			
			//echo $InsertProductSql."<br>";
			$InsertProductQuery = ExecQuery($InsertProductSql);
			//exit();
			$ProductValue = mysql_insert_id();
			$_SESSION['Temp_LID'] = $ProductValue;
			$_SESSION['bank_id'] = $bank_id;
			$_SESSION['city'] = $City;

		if($edelweiss=="1")
				{
				 InsertEdelweiss($ProductValue, $Name,$City, $Phone, $dateofbirth, $Pincode );
				}
			
			list($First,$Last) = split('[ ]', $Name);

			
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan. You will get a call from us to give you quotes & information to get you best deal for loans.";
			//if(strlen(trim($Phone)) > 0)
			//SendSMS($SMSMessage, $Phone);
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$FName=$Name;
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
		if((strlen(strpos($finalurl, "apply-home-loans-test.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-home-loans-continue1-test.php'"."</script>";	
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