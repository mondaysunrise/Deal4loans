<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$Mobile_No = $_REQUEST['get_Mobile'];
	$Full_Name = $_REQUEST['get_Full_Name'];
	$Email = $_REQUEST['get_Email'];
	$city = $_REQUEST['get_City'];
	$UID = $_REQUEST['get_Id'];
	$net_salary = $_REQUEST['get_net_salary'];


if((strlen($Mobile_No)>9) && (strlen($Email)>0) && (strlen($Full_Name)>0) && (strlen($city) >0) && strlen($net_salary)>0)
{
	
	if($UID>0)
	{
		//update 
		$DataArray = array("Name"=>$Full_Name , "Email"=>$Email , "Mobile_Number"=>$Mobile_No, "City"=>$city, "Net_Salary"=>$net_salary );
		$wherecondition ="(RequestID=".$UID.")";
		Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);
		$last_inserted_id = $UID;

		echo $last_inserted_id;
		//echo $UpdateSql;
	}
	else
	{
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Car Where ( Mobile_Number not in (9971396361,9811215138,9811555306) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
		list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
				$myrowcontr = count($myrow)-1;
			$checkNum = $alreadyExist;

			if($alreadyExist>0)
		{
		echo "already";
	}
	else
	{
		$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
		list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Full_Name, 'Email'=>$Email, 'Mobile_Number'=>$Mobile_No, 'City'=>$city, 'Net_Salary'=>$net_salary, 'Dated'=>$Dated, 'Updated_Date'=>$Dated);
			}
			else
		{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Full_Name, 'Email'=>$Email, 'Mobile_Number'=>$Mobile_No, 'City'=>$city, 'Net_Salary'=>$net_salary, 'Dated'=>$Dated, 'Updated_Date'=>$Dated);
		}
	$last_inserted_id = Maininsertfunc ("Req_Loan_Car", $dataInsert);		
		echo $last_inserted_id;
	}

	
	}
	
			
}
?>
