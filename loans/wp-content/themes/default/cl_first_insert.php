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
		$UpdateSql = "update Req_Loan_Car set Name='".$Full_Name."', Email = '".$Email."', Mobile_Number = '".$Mobile_No."',City = '".$city."', Net_Salary='".$net_salary."' where  RequestID=".$UID;		
		$QueryUser = ExecQuery($UpdateSql);
			
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
	//echo $getdetails."<br>";
	//exit();
	$checkavailability = ExecQuery($getdetails);
	$alreadyExist = mysql_num_rows($checkavailability);
	$myrow = mysql_fetch_array($checkavailability);

	if($alreadyExist>0)
	{
		echo "already";
	}
	else
	{
		$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			$CheckQuery = ExecQuery($CheckSql);
			$CheckNumRows = mysql_num_rows($CheckQuery);
if($CheckNumRows>0)
			{
	$UserID = mysql_result($CheckQuery, 0, 'UserID');
		$sql = "INSERT INTO Req_Loan_Car (UserID, Name, Email, Mobile_Number, City, Net_Salary, Dated) VALUES ('".$UserID."','".$Full_Name."', '".$Email."', '".$Mobile_No."','".$city."', '".$net_salary."', Now())";
		$result = ExecQuery($sql);
		$last_inserted_id = mysql_insert_id();
			}
			else
		{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID1 = mysql_insert_id();

				$sql = "INSERT INTO Req_Loan_Car (UserID, Name, Email, Mobile_Number, City, Net_Salary, Dated) VALUES ('".$UserID1."','".$Full_Name."', '".$Email."', '".$Mobile_No."','".$city."', '".$net_salary."', Now())";
		$result = ExecQuery($sql);
		$last_inserted_id = mysql_insert_id();


		}

		echo $last_inserted_id;
	}

	
	}
	
			
}
?>
