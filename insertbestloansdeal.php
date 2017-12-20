<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

$returnArr = '';
//print_r($_GET);
$Loan_Amount = FixString($_REQUEST['Loan_Amount']);//
$Employment_Status = FixString($_REQUEST['Employment_Status']);//
$plcompanyid = FixString($_REQUEST['plcompanyid']);//
$Net_Salary = FixString($_REQUEST['Net_Salary']);//
$Name = FixString($_REQUEST['Name']);//
$City = FixString($_REQUEST['City']);//
$Phone = FixString($_REQUEST['Phone']);//
$Email = FixString($_REQUEST['Email']);//
$accept = FixString($_REQUEST['accept']);
$IP = FixString($_REQUEST['IP']);
$Source = FixString($_REQUEST['Source']);//
$lastId = FixString($_REQUEST['lastId']);//
$Annual_Turnover = FixString($_REQUEST['Annual_Turnover']);
$panel = FixString($_REQUEST['panel']);
$Dated=ExactServerdate();
$getCompanySql = "select company_name from pl_company_list where plcompanyid= '".$plcompanyid."'";
list($getCompanyNumRows,$getCompanyQuery)=Mainselectfunc($getCompanySql,$array = array());
if($getCompanyNumRows>0)
{
	$Company_Name = $getCompanyQuery[0]['company_name'];
}
else
{
	$Company_Name = $plcompanyid;
}	
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9911940202,9891118553,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	//echo $getdetails."<br>";
	//exit();
	list($recordcount,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$countr=count($myrow)-1;
	if($alreadyExist>0)
	{

		$ProductValue=$myrow[$countr]['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		header('Location: http://www.bestloansdeal.com/get-personal-loan.php?'.$request);

	}
	else
	{

		$returnArr[] = $lastId;
		$data = array('Name'=>$Name , 'Email'=>$Email , 'Employment_Status'=>$Employment_Status , 'Company_Name'=>$Company_Name, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary,  'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$Source, 'IP_Address'=>$IP,'Updated_Date'=>$Dated,'Privacy'=>'on', 'Annual_Turnover'=>$Annual_Turnover,'panel'=>$panel);

	 	$lastInsertedId = Maininsertfunc("Req_Loan_Personal", $data);

	
		$returnArr[] = $lastInsertedId;
		$param["RequestID"] = $lastInsertedId;
		$param["ID"] = $lastId;
		$request = '';
		foreach($param as $key=>$val)
		{
		  $request.= $key."=".urlencode($val);
		  $request.= "&";
		}
		$request = substr($request, 0, strlen($request)-1);
			
		if($Net_Salary>240000)
		{	
			header('Location: http://www.bestloansdeal.com/mid_personalloanscontinue.php?'.$request);
		}
		else
		{
			header('Location: http://www.bestloansdeal.com/mid_personalloancontinue.php?'.$request);
		}
	exit();
}

?>