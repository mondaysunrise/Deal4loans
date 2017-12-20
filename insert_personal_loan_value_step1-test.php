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
		$City_Other = FixString($City_Other);
		$Net_Salary = $_REQUEST['IncomeAmount'];
		$CC_Holder = FixString($CC_Holder);
		$Card_Vintage = FixString($Card_Vintage);
		$_SESSION['Temp_CC_Holder'] = $CC_Holder;
		$Dated = ExactServerdate();
		if($Net_Salary<=240000)
		{
		$Reference_Code = generateNumber(4);
		$Direct_Allocation =1;
		}
		else
		{
			$Reference_Code = "";
			$Direct_Allocation =0;
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
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}
	

function InsertTataAig($RequestID, $ProductName)
	{
		$GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		//$RowGetDate = mysql_fetch_array($GetDateSql);
		list($GetDateSql,$myrow)=MainselectfuncNew($GetDateSql,$array = array());
		
		$TDated = $RowGetDate[$cntr]['Dated'];
		$TCity = $RowGetDate[$cntr]['City'];
		$Mobile = $RowGetDate[$cntr]['Mobile_Number'];
		$Product_Name = "1";
		
		//$Sql = "INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, `Mobile_Number`, `T_Dated` ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";
		//$query = mysql_query($Sql);
		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
		$table = 'tataaig_leads';
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
	
	$getdetails="select RequestID From Req_Loan_Personal Where (Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	//echo $getdetails."<br>";
	//exit();
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		$i=0;
	//$checkavailability = ExecQuery($getdetails);
	//$alreadyExist = mysql_num_rows($checkavailability);
	//$myrow = mysql_fetch_array($checkavailability);

	if($alreadyExist>0)
	{

		$ProductValue=$myrow[$i]['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";

	}
	else
	{
	
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			$CheckQuery = ExecQuery($CheckSql);
			list($CheckNumRows,$Arrrow)=MainselectfuncNew($CheckSql,$array = array());
			$j=0;
			
			//echo "<br>".$CheckSql;
			//$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = $Arrrow[$j]['UserID'];
				//$InsertProductSql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Dated, Pincode,  source, CC_Bank, Card_Vintage,Referrer,Creative,Section, Updated_Date, IP_Address,Accidental_Insurance,Reference_Code, Direct_Allocation)
				//VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', Now(), '$Pincode','$source','$From_Pro','$Card_Vintage','$Referrer','$Creative','$Section', Now(),'$IP','$Accidental_Insurance','".$Reference_Code."', '".$Direct_Allocation."')";
			
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Dated"=>$Dated, "Pincode"=>$Pincode, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance, "Reference_Code"=>$Reference_Code, "Direct_Allocation"=>$Direct_Allocation);
			
			
			
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				//$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				///$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				
			$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
			$table = 'wUsers';
			$insert = Maininsertfunc ($table, $dataInsert);
				
				//$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				//$UserID1 = mysql_insert_id();
				
				
				$UserID1 = mysql_insert_id();
				//$InsertProductSql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Dated, Pincode, source, CC_Bank, Card_Vintage,Referrer,Creative,Section, Updated_Date, IP_Address,Accidental_Insurance, Reference_Code,Direct_Allocation)
//VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', Now(), '$Pincode', '$source','$From_Pro','$Card_Vintage','$Referrer','$Creative','$Section', Now(),'$IP','$Accidental_Insurance','".$Reference_Code."','".$Direct_Allocation."')";
				//echo "<br>else".$InsertProductSql;
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Dated"=>$Dated, "Pincode"=>$Pincode, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance, "Reference_Code"=>$Reference_Code, "Direct_Allocation"=>$Direct_Allocation);	
				
			}
			//echo "hello>".$InsertProductSql."<br>";
			//$InsertProductQuery = ExecQuery($InsertProductSql);
			$table = 'Req_Loan_Personal';
			$insert = Maininsertfunc ($table, $dataInsert);
			$ProductValue = mysql_insert_id();
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Personal");
				}
			$_SESSION['Temp_LID'] = $ProductValue;
			list($First,$Last) = split('[ ]', $Name);

	
if($Net_Salary<=240000)
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

if($Net_Salary<=240000)
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