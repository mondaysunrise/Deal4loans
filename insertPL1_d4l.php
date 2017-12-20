<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

$returnArr = '';
//print_r($_GET);
$Loan_Amount = $_REQUEST['Loan_Amount'];//
$Employment_Status = $_REQUEST['Employment_Status'];//
$Company_Name = $_REQUEST['Company_Name'];//
$Net_Salary = $_REQUEST['IncomeAmount'];//
$Name = $_REQUEST['Name'];//
$City = $_REQUEST['City'];//
$Phone = $_REQUEST['Phone'];//
$Email = $_REQUEST['Email'];//
$accept = $_REQUEST['accept'];
$IP = $_SERVER['REMOTE_ADDR'];
$Source = $_REQUEST['Source'];//
$lastId = $_REQUEST['lastId'];//
$url = $_REQUEST['url'];//
$Annual_Turnover = $_REQUEST['Annual_Turnover'];

	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9911940202,9891118553,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($checkDupNum,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;

	if($checkDupNum>0)
	{
		$ProductValue = $myrow[$myrowcontr]['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		$param["dup"] = "Already Applied";
	//	$param["ID"] = $lastId;
		$request = '';
		foreach($param as $key=>$val)
		{
		  $request.= $key."=".urlencode($val);
		  $request.= "&";
		}
		header('Location: http://www.deal4loans.com/get-personal-loan.php?'.$request);

	}
	else
	{
$Dated = ExactServerdate();
		$returnArr[] = $lastId;
	 	$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$Source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'Privacy'=>'on', 'Annual_Turnover'=>$Annual_Turnover);

		$table = 'Req_Loan_Personal';
		$lastInsertedId = Maininsertfunc ($table, $dataInsert);
		$returnArr[] = $lastInsertedId;
		$param["RequestID"] = $lastInsertedId;
	//	$param["ID"] = $lastId;
		$request = '';
		foreach($param as $key=>$val)
		{
		  $request.= $key."=".urlencode($val);
		  $request.= "&";
		}
		$request = substr($request, 0, strlen($request)-1);
			
		if($url=='get-personal-loan1.php')
		{
			if($Net_Salary>240000)
			{	
				header('Location: http://www.deal4loans.com/get-personalloanscontinue1.php?'.$request);
			}
			else
			{
				header('Location: http://www.deal4loans.com/get-personalloancontinue1.php?'.$request);
			}
		}
		else
		{
			if($Net_Salary>240000)
			{	
				header('Location: http://www.deal4loans.com/get-personalloanscontinue.php?'.$request);
			}
			else
			{
				header('Location: http://www.deal4loans.com/get-personalloancontinue.php?'.$request);
			}
		}
	exit();
}

?>