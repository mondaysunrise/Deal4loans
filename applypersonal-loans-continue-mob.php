<?php  require 'scripts/db_init.php';
	require 'scripts/functions.php';
//print_r($_POST);
//exit();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		$Name = $_POST['Name2'];
		$Phone= $_POST['Phone2'];
		$source = $_POST['source2'];
		$IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
		
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9891118553,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	if($alreadyExist>0)
	{
		$ProductValue=$myrow['RequestID'];
		echo $_SESSION['Temp_LID'] = $ProductValue;
	/*	echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";*/
		$message = "Thanks you for sharing your mobile number with us. <br>You are already registered with us.	";
	}
	else
	{
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Employment_Status'=>'1', 'City'=>'', 'City_Other'=>'', 'Mobile_Number'=>$Phone, 'Dated'=>$Dated, 'source'=>$source, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Net_Salary'=>'360000');
		echo $ProductValue = Maininsertfunc ("Req_Loan_Personal", $dataInsert);
		//$message = "Thanks you for sharing your mobile number with us. <br>Our representative will get back to you shortly.	";
	}		
		}
?>