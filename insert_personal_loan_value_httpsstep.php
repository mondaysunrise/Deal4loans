<?php
ob_start();
	require 'scripts/db_init.php';
	require 'scripts/functionshttps.php';
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
$_SESSION['Temp_LID']="";
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
		$Age=FixString($Age);
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
		$edelweiss = FixString($edelweiss);
		$cpp_card_protect = FixString($cpp_card_protect);
		$Ibibo_compaign = FixString($Ibibo_compaign);
		$Annual_Turnover = FixString($Annual_Turnover);
		$REFERER_URL = $_POST["REFERER_URL"];
		$hdfclife = FixString($hdfclife);
		$EMI_Paid = FixString($EMI_Paid);
		$accept = FixString($accept);
		$Dated=ExactServerdate();
		$Updated_Date=ExactServerdate();
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
		
		if((strlen(strpos($finalurl, "apply-personal-loans-bnrcamp.php")) > 0))
		{
			$Reference_Code = generateNumber(4);
	
		}
		else
		{
		if($Net_Salary<=270000)
		{		
		$Reference_Code = generateNumber(4);
		$Direct_Allocation =1;
		$IsProcessed=1;
		
		}
	else
		{
			$Reference_Code = "";
			$Direct_Allocation =0;
			$IsProcessed=0;
		}
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
		//$IP = getenv("REMOTE_ADDR");
		//$IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
                $IP=ExactCustomerIP();
	$_SESSION['Temp_LID']="";
	$Type_Loan="Req_Loan_Personal";

	if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1)
	{
		$validname=0;
	}
	else
		{
	$validname=1;
		}

		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
if(($validMobile==1) && ($Name!="") && strlen($City)>0 && $validname==1)
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9873678915,9891118553,9999570210,9555060388) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());

	if($alreadyExist>0)
	{
		$ProductValue=$myrow['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";
	}
	else
	{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$myrow1)=Mainselectfunc($CheckSql,$array = array());
			if($CheckNumRows>0)
			{
				$UserID = $myrow1["UserID"];
				$pldata=array("UserID" => $UserID,  "Name" => $Name,  "Email" => $Email,  "Employment_Status" => $Employment_Status,  "Company_Name" => $Company_Name,  "City" => $City,  "City_Other" => $City_Other,  "Mobile_Number" => $Phone,  "Std_Code" => $Std_Code1,  "Landline" => $Phone1,  "Net_Salary" => $Net_Salary,  "CC_Holder" => $CC_Holder,  "Loan_Amount" => $Loan_Amount,  "DOB" => $DOB,  "Dated" => $Dated,  "Pincode" => $Pincode,  "source" => $source,  "CC_Bank" => $From_Pro,  "Card_Vintage" => $Card_Vintage,  "Referrer" => $REFERER_URL,  "Creative" => $Creative,  "Section" => $Section,  "Updated_Date" => $Updated_Date,  "IP_Address" => $IP,  "Accidental_Insurance" => $Accidental_Insurance,  "Reference_Code" => $Reference_Code,  "Direct_Allocation" => $Direct_Allocation,  "IsProcessed" => $IsProcessed,  "Edelweiss_Compaign" => $edelweiss,  "Cpp_Compaign" => $cpp_card_protect,  "Annual_Turnover" => $Annual_Turnover,  "Privacy" => $accept,  "EMI_Paid" =>$EMI_Paid);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID1 = Maininsertfunc("wUsers", $wUsersdata);
				
				$pldata=array("UserID" => $UserID1,  "Name" => $Name,  "Email" => $Email,  "Employment_Status" => $Employment_Status,  "Company_Name" => $Company_Name,  "City" => $City,  "City_Other" => $City_Other,  "Mobile_Number" => $Phone,  "Std_Code" => $Std_Code1,  "Landline" => $Phone1,  "Net_Salary" => $Net_Salary,  "CC_Holder" => $CC_Holder,  "Loan_Amount" => $Loan_Amount,  "DOB" => $DOB,  "Dated" => $Dated,  "Pincode" => $Pincode,  "source" => $source,  "CC_Bank" => $From_Pro,  "Card_Vintage" => $Card_Vintage,  "Referrer" => $REFERER_URL,  "Creative" => $Creative,  "Section" => $Section,  "Updated_Date" => $Updated_Date,  "IP_Address" => $IP,  "Accidental_Insurance" => $Accidental_Insurance,  "Reference_Code" => $Reference_Code,  "Direct_Allocation" => $Direct_Allocation,  "IsProcessed" => $IsProcessed,  "Edelweiss_Compaign" => $edelweiss,  "Cpp_Compaign" => $cpp_card_protect,  "Annual_Turnover" => $Annual_Turnover,  "Privacy" => $accept,  "EMI_Paid" =>$EMI_Paid);
				//echo "<br>else".$InsertProductSql;
				}
			 $ProductValue = Maininsertfunc("Req_Loan_Personal", $pldata);
			

//Send SMS
			ProductSendSMStoRegis($Phone);

			// exit();
			
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
			$Product=1;
			Insert_HdfcLife_nw($Name, $strcity, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue, $source );
		}

			$_SESSION['Temp_LID'] = $ProductValue;
			list($First,$Last) = split('[ ]', $Name);

	if($Net_Salary<=270000)//changed on 20Jan14
		{
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan.";
		
		}
		else
		{		
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan. ";
		}
		
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailtocommonproduct.php";
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);		

		$headers = "From: deal4loans <no-reply@deal4loans.com>";
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: newtestthankuse@gmail.com"."\n";
	    $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $Message2 . "\n\n";

			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $message, $headers);
			}

if($Net_Salary<=270000 && $Employment_Status==1 )//changed on 20jan14
		{
		if((strlen(strpos($finalurl, "apply-personal-loans1-new.php")) > 0))
			{
		echo "<script language=javascript>"." location.href=apply-personal-loans1-new-continue.php'"."</script>";
			}
		else
			{
				echo "<script language=javascript>"." location.href='apply-personal-loan-htpsless.php'"."</script>";
			}
		}
		else
			{
			if((strlen(strpos($finalurl, "apply-personal-loans1-new.php")) > 0))
			{		
			echo "<script language=javascript>"." location.href='apply-personal-loans1-newcontinue.php'"."</script>";	
			}
			else
				{
				echo "<script language=javascript>"." location.href='apply-for-personal-loans-httpscontinue.php'"."</script>";
				}
		}
	}
		}
		else
		{
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}
}
?>