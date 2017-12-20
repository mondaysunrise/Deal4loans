<?php
//ob_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		$UserID = $_SESSION['UserID'];
		$finalurl=$_POST["PostURL"];
		$Age= FixString($_REQUEST["Age"]);
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Loan_Amount= FixString($Loan_Amount);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Pincode= FixString($Pincode);
		$Email = FixString($Email);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Net_Salary = FixString($_REQUEST['IncomeAmount']);
		$cpp_card_protect = FixString($cpp_card_protect);
		$Referrer=FixString($_REQUEST['referrer']);
		$source=FixString($_REQUEST['source']);
		$Section=FixString($_REQUEST['section']);
		$Creative=FixString($_REQUEST['creative']);
		//$IP = getenv("REMOTE_ADDR");
                $IP=ExactCustomerIP();
		if(strlen($Age)>0)
		{
			$date=date('m-d');
			$year = date('Y')-$Age;
			$DOB = $year."-".$date;
		}
		else
		{
			$DOB=$Year."-".$Month."-".$Day;
		}

$Type_Loan="Req_Loan_Gold";


if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		$validMobile = is_numeric($Phone);
		
			
	function  Insertcpp($ProductValue, $Name,$City, $Phone, $DOB, $Email )
	{
		
		$dataInsert = array("CPP_RequestID"=>$ProductValue, "CPP_Product"=>7, "CPP_Name"=>$Name, "CPP_City"=>$City, "CPP_Mobile_Number"=>$Phone, "CPP_DOB"=>$DOB, "CPP_Dated"=>$Dated, "CPP_Email"=>$Email);
		$table = 'cpp_card_protection_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
		
		//$query = mysql_query($Sql);
		//echo "Edelweiss:".$Sql."<br>";
		//exit();
	}

if(($validMobile==1) && ($Name!=""))
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Gold Where (Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC"; 
	//echo "Deal4loans"; die;
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		//echo $alreadyExist;
		$Cnr=0;
	if($alreadyExist>0)
	{
		$ProductValue=$myrow[$Cnr]['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-gold-loan-lead.php'"."</script>";

	}
	else
	{
	//echo "test"; die;
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Cpp_Compaign'=>$cpp_card_protect, 'Pincode'=>$Pincode);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Cpp_Compaign'=>$cpp_card_protect, 'Pincode'=>$Pincode);
				
				}
			$ProductValue = Maininsertfunc ("Req_Loan_Gold", $dataInsert);
			
			if($source!= "application-for-gold-loan")
			{
				 //Send SMS
				ProductSendSMStoRegis($Phone);
			}
			
			$_SESSION['Temp_LID'] = $ProductValue;

			if($cpp_card_protect=="1")
				{
				 //Insertcpp($ProductValue, $Name,$City, $Phone, $DOB,$Email);
				}
			list($First,$Last) = split('[ ]', $Name);
if($City=="Delhi")	    {	$contact="011-30513051";}
if($City=="Chennai")	{	$contact="9382391119";}
if($City=="Kerala")	    {	$contact="9847091119";}
if($City=="Bangalore")	{	$contact="9379591119";}
if($City=="Hyderabad")	{	$contact="9393191119";}
if($City=="Mumbai")	    {	$contact="022-26840615, 26841326, 26848124";}
if($City=="Kolkata")	{	$contact="033-24809739/ 44 / 46";}
if($City=="Ahmedabad")	{	$contact="079 - 27499952/53";}

if(strlen($contact)>0)
		{
			$SMSMessage = "Dear $First, Thanks for applying at Deal4loans for Gold loan. Following are the contact details for your Request : Muthoot Finance - $contact ";
		}
		else
		{	

			$SMSMessage = "Dear $First, Thanks for applying at Deal4loans for Gold loan.";
		}
	
			if(strlen(trim($Phone)) > 0)
			{
				//SendSMS($SMSMessage, $Phone);
			}
			//Code Added to mailtocommonscript.php
			/*
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
			{
				$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			}
			else
			{
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			}
			*/
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				//mail($Email, $SubjectLine, $Message2, $headers);
			}


	header("Location: thank-apply-gold-loans.php");
				exit();	
/*	echo "<script language=javascript>"." location.href='thank-apply-gold-loans.php'"."</script>";	*/
	

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