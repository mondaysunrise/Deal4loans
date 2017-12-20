<?php
session_start();
ob_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';
//print_r($_POST);

//Array ( [creative] => Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36 [source] => lowestrateLPNW [PostURL] => /wishbank/personal-loan.php [Loan_Amount] => 100000 [Employment_Status] => 1 [Company_Name] => sssss [IncomeAmount] => 670000 [City] => Gaziabad [Name] => upendra [day] => 12 [month] => 12 [year] => 1980 [Phone] => 9971396361 [Email] => askupendra@gmail.com [CC_Holder] => 1 [Card_Vintage] => 4 [accept] => on [Submit_x] => 63 [Submit_y] => 21 ) 
$biddt = FixString($_POST['biddt']);
$Loan_Amount = FixString($_POST['Loan_Amount']);//
$Employment_Status = FixString($_POST['Employment_Status']);//
$Company_Name = FixString($_POST['Company_Name']);//
$IncomeAmount = FixString($_POST['IncomeAmount']);//
$Name = FixString($_POST['Name']);//
$City = FixString($_POST['City']);//
$City_Other = FixString($_POST['City_Other']);//
$Phone = FixString($_POST['Phone']);//
$Email = FixString($_POST['Email']);
$day = FixString($_POST['day']);
$month = FixString($_POST['month']);
$year = FixString($_POST['year']);
$DOB = $year."-".$month."-".$day;
$CC_Holder = FixString($_POST['CC_Holder']);
$Card_Vintage = FixString($_POST['Card_Vintage']);
$accept = FixString($_POST['accept']);
$IP = FixString($_SERVER['REMOTE_ADDR']);
$source = FixString($_POST['source']);//
$Annual_Turnover = FixString($_POST['Annual_Turnover']);
$PostURL = FixString($_POST['PostURL']);
$dated = ExactServerdate();
//$Reference_Code = generateNumberNEWc(5);
$Reference_Code = 12131;

	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9891118553,9999570210,9555060388,9311773341) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	
	if($alreadyExist>0)
	{
		$ProductValue=$myrow['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		header("Location :personal-loan-chatapp.php?msg=1");
	}
	else
	{
		$data = array("Name" => $Name, "Email" => $Email,  "Employment_Status" => $Employment_Status,  "Company_Name" => $Company_Name,  "City" => $City,  "City_Other" => $City_Other,  "Mobile_Number" => $Phone, "Net_Salary" => $IncomeAmount,  "CC_Holder" => $CC_Holder,  "Loan_Amount" => $Loan_Amount,  "DOB" => $DOB, "source" => $source, "Card_Vintage" => $Card_Vintage, "IP_Address" => $IP, "Reference_Code" =>$Reference_Code, "Annual_Turnover" => $Annual_Turnover,  "Privacy" => $accept, "Dated"=>$dated,"Updated_Date"=>$dated);		
//	print_r($data);
	}
$ProductValue = Maininsertfunc("Req_Loan_Personal", $data);
$ID = $ProductValue;
$_SESSION['RequestID'] = $ProductValue;
$_SESSION['ID'] = $ID;
$_SESSION['leadid'] = $ID;


	$dataPL = array("AllRequestID" => $ID, "BidderID" => $biddt,  "Reply_Type" => 1, "Allocated"=>'0', "Allocation_Date"=> $dated);
	$aaa =  Maininsertfunc("lead_allocate", $dataPL);
//	print_r($dataPL);
	//echo "<br>";
//	print_r($aaa);
//exit();

header("Location: personalloan_smsleaddetails.php?postid=".$ID."&biddt=".$biddt);

exit();
?>