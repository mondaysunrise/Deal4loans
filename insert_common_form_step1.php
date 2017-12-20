<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$Employment_Status = $_POST['Employment_Status'];
	$Net_Salary = $_POST['IncomeAmount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	$IP = getenv("REMOTE_ADDR");
	$Reference_Code = generateNumber(4);
	
if($Type_Loan=="Req_Loan_Personal")
{
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9911940202,9891118553,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
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
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Dated'=>$Dated, 'source'=>$source, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Creative'=>'2');
		$ProductValue = Maininsertfunc ("Req_Loan_Personal", $dataInsert);
	}
}
else if($Type_Loan=="Req_Loan_Home")
{
	$getdetails="select RequestID From ".$Type_Loan."  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9891118553','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
		
	if($alreadyExist>0)
	{
		$ProductValue = $myrow[$myrowcontr]["RequestID"];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
	}
	else
	{			
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Dated'=>$Dated, 'source'=>$source, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Creative'=>'2');
		$ProductValue = Maininsertfunc ("Req_Loan_Home", $dataInsert);
	}
}
else if($Type_Loan=="Req_Loan_Car")
{
	$getdetails="select RequestID From Req_Loan_Car Where ( Mobile_Number not in (9971396361,9811215138,9911940202,9891118553) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
		
	if($alreadyExist>0)
	{
		$ProductValue = $myrow[$myrowcontr]["RequestID"];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-car-loan-lead.php'"."</script>";
	}
	else
	{
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Dated'=>$Dated, 'source'=>$source, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Creative'=>'2');
		$ProductValue = Maininsertfunc ("Req_Loan_Car", $dataInsert);
	}
}
else if($Type_Loan=="Req_Credit_Card")
{
	$getdetails="select RequestID From Req_Credit_Card Where (Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9971396361','9811215138') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
		
	if($alreadyExist>0)
	{
		$ProductValue = $myrow[$myrowcontr]["RequestID"];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-credit-card-lead.php'"."</script>";
	}
	else
	{
		$ProductValue = mysql_insert_id();
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Dated'=>$Dated, 'source'=>$source, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Creative'=>'2');
		$ProductValue = Maininsertfunc ("Req_Credit_Card", $dataInsert);
	}
}

//echo $InsertProductSql;
$_SESSION['Temp_LID'] = $ProductValue;
$_SESSION['Net_Salary'] = $Net_Salary;
$_SESSION['City'] = $City;


if($Type_Loan=="Req_Loan_Personal")
{
		echo "<script language=javascript>"." location.href='apply-for-plloans.php'"."</script>";
}
else if($Type_Loan=="Req_Loan_Home")
{
		echo "<script language=javascript>"." location.href='apply-for-hlloans.php'"."</script>";
}
else if($Type_Loan=="Req_Loan_Car")
{
		echo "<script language=javascript>"." location.href='apply-for-clloans.php'"."</script>";
}
else if($Type_Loan=="Req_Credit_Card")
{
		echo "<script language=javascript>"." location.href='apply-for-cc.php'"."</script>";
}

?>