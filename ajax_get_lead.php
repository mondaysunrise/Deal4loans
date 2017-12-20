<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
$pdo = db_connect_PDO();

$loan_amount = $_REQUEST['loan_amount'];
$tenure = $_REQUEST['tenure'];
$Interest_Rate_Emi = $_REQUEST['Interest_Rate_Emi'];
$full_name_emi = $_REQUEST['full_name_emi'];
$mobile_emi = $_REQUEST['mobile_emi'];
$email_emi = $_REQUEST['email_emi'];
$city_emi = $_REQUEST['city_emi'];
$source = $_REQUEST['source'];

$loanAmountEmi = FixString($loan_amount);
$loanTenure = FixString($tenure);
$Name = FixString($full_name_emi);
$Phone = FixString($mobile_emi);
$Email = FixString($email_emi);
$City = FixString($city_emi);

$IP = getenv("REMOTE_ADDR");
$IP = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];

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
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9891118553,9999570210) and Mobile_Number= :Phone and Updated_Date between :days30datetime and :currentdatetime and source not in('PL-EMI-Ccalc-Jan2015','PL main page')) order by RequestID DESC ";
	//echo $getdetails."<br>";
	$stmt = $pdo->prepare($getdetails);
	$stmt->execute(array('Phone' => $Phone, 'days30datetime' => $days30datetime, 'currentdatetime'=> $currentdatetime));
	$checkavailability = $stmt->rowCount();
	$myrow = $stmt->fetch(PDO::FETCH_ASSOC);

	if($alreadyExist<=0 || $alreadyExist="")
	{
		echo "hello";
		$insertEmiSql = "INSERT INTO Req_Loan_Personal SET Name=:Name, Email=:Email, City=:City, Mobile_Number=:Phone, Loan_Amount=:loanAmountEmi, Dated=Now(), Updated_Date=Now(), source=:source, IP_Address=:IP";
		$q = $pdo->prepare($insertEmiSql);
		//$q->execute(array('Name'=>$Name,'Email'=>$Email,'City'=>$City,'Phone'=>$Phone,'loanAmountEmi'=>$loanAmountEmi,'source'=>$source,'IP'=>$IP));
		$leadid = $pdo->lastInsertId();
		$_SESSION['leadid'] = $leadid;
	}
}
echo "Thank you for visiting Deal4loans.com<br /> Our representative will contact you soon.";
?>