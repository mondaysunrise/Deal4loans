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
		$ExistingLoan_Amount= FixString($ExistingLoan_Amount);
		$Existing_Rate= FixString($Existing_Rate);
		$Existing_Bank= FixString($Existing_Bank);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Employment_Status = FixString($Employment_Status);
		$Email = FixString($Email);
		$Type_Loan = FixString($Type_Loan);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$From_Product = $_REQUEST['From_Product'];
		$City_Other = FixString($City_Other);
		$Net_Salary = FixString($IncomeAmount);
		$Annual_Turnover = FixString($Annual_Turnover);
		$REFERER_URL = $_POST["REFERER_URL"];
		$accept = FixString($accept);
		$Existing_EMI = FixString($Existing_EMI);
		$IsPublic = 1;
		$n       = count($From_Product);
		   $i      = 0;
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
		$Referrer=FixString($referrer);
		$source=FixString($source);
		$Section=FixString($section);
		$Creative=FixString($creative);
		$IP_Remote = getenv("REMOTE_ADDR");
		if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
		else { $IP=$IP_Remote;	}

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
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9811555306,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
	if($alreadyExist>0)
	{
		$ProductValue = $myrow[$myrowcontr]["RequestID"];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";
	}
	else
	{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$ExistingLoan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$source,'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP,  'Annual_Turnover'=>$Annual_Turnover, 'Privacy'=>$accept, 'Existing_Bank'=>$Existing_Bank, 'Existing_Loan'=>$ExistingLoan_Amount, 'Existing_ROI'=>$ExistingLoan_Amount, 'PL_EMI_Paid'=>$Existing_EMI);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$ExistingLoan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Annual_Turnover'=>$Annual_Turnover, 'Privacy'=>$accept, 'Existing_Bank'=>$Existing_Bank, 'Existing_Loan'=>$ExistingLoan_Amount, 'Existing_ROI'=>$ExistingLoan_Amount , 'PL_EMI_Paid'=>$Existing_EMI);
			}
		
		$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
		
		if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}
		
		if($ProductValue>0)
		{
			$bidqry="select BidderID From Bidders_List where (BidderID in 
			(1888,2627,4648,2628,2626,5934,2629,5313,1891,1957,5454,1950) and City like '%".$strcity."%' and Restrict_Bidder=1 and Reply_Type=1)";
		list($alreadybowExist,$bow)=MainselectfuncNew($bidqry,$array = array());

		if($alreadybowExist>0)
		{
			$bidderID=$bow[0]["BidderID"];

			$getcompany='select * from pl_company_list where ((company_name="'.$company.'") or (company_name="'.$Company_Name.'"))';
			list($getcompanyExist,$how)=MainselectfuncNew($getcompany,$array = array());
			$hdfccategory= $how[0]["hdfc_bank"];
		}

		$hdfcsource="EML_HDFC_PLBT";
		$str1= strrev($source);
		$str2= strrev($hdfcsource);
			
		if((strncmp ($str1, $str2, 13)==0) && $bidderID>0 && (($Existing_Bank=="Bajaj Finserv" && $Existing_EMI>=1) or ($Existing_EMI>=6)) && $Net_Salary>=300000 && $hdfccategory!='' && $Employment_Status==1)
		{
			$DataArray = array("Allocated" =>'2', "Bidderid_Details" =>$bidderID);
			$wherecondition ="(Req_Loan_Personal.RequestID=".$ProductValue.")";
			Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
		}
		}

		$_SESSION['Temp_LID'] = $ProductValue;
			list($First,$Last) = split('[ ]', $Name);

		if(strlen($Email)>0)
		{
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailtocommonproduct.php";
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
		}

		$headers = "From: deal4loans <no-reply@deal4loans.com>";
		$semi_rand = md5( time() ); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
		$headers .= "\nMIME-Version: 1.0\n" . 
		"Content-Type: multipart/mixed;\n" . 
		" boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: testthankuse@gmail.com"."\n";
		$message = "This is a multi-part message in MIME format.\n\n" . 
		"--{$mime_boundary}\n" . 
		"Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
		"Content-Transfer-Encoding: 7bit\n\n" . 
		$Message2 . "\n\n";
	
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $message, $headers);
			}

			echo "<script language=javascript>"." location.href='apply-personal-loan-btthanks.php'"."</script>";
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