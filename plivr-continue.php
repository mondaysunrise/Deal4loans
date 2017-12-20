<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/db_init_in.php';
		require 'trynew_ivr.php';
//print_r($_POST);

//Array ( [Name] => Full Name [Mobile_No] => 9897778575 [City] => Bangalore [Submit] => Submit )
//exit();

if(isset($_POST['Submit']))
{
	$Name = $_POST['full_name'];
	$mobile_no = $_POST['mobile_no'];
	$city = $_POST['city'];

 	$full_name = $_POST['full_name'];
		
		if(isset($_POST['city']))
		{
			$city = $_POST['city'];
		}
		else
		{
			$city = $_SESSION['city'];
		}

		$mobile_no = $_POST['mobile_no'];
		
        $mobile_no = "0".$mobile_no;
		$SmsMobileNo = $_POST['mobile_no'];
		
		$Activate = $_POST['Activate'];

		$Source = $_POST['Source'];
		$Section = $_POST['Section'];
		$Sms_Activate = $_POST['Sms_Activate'];
		/*
		$ShowDate = $_POST['ShowDate'];
		$StartTime = $_POST['StartTime'];
		$EndTime = $_POST['EndTime'];
		*/
			$ShowDate = date("H:i:s");
	$StartTime = "08:20:00";
	$EndTime = "23:25:01";
		
		
		$Source = $_POST['Source'];
	
		$validMobile = is_numeric($mobile_no);

	if(($validMobile==1) && ($full_name!="" || $full_name!="NULL" || $full_name!="Full Name" ) )
	{

	
		if($city =='Delhi' || $city =='Gaziabad' || $city =='Gurgaon' || $city =='Noida' || $city =='Faridabad' || $city =='Mumbai' || $city =='Thane' || $city =='Navi Mumbai' || $city =='Chennai' || $city =='Kolkata' || $city =='Bangalore' || $city =='Hyderabad' || $city =='Pune')
		{
	
	if($ShowDate > $StartTime && $ShowDate < $EndTime)			
		{
		
			$incrementedTime  = mktime(date("H"), date("i")+1, date("i"), date("m")  , date("d"), date("Y"));
			$defineDate = date("Y-m-d H:i:s", $incrementedTime);
			$currentDate = date("Y-m-d H:i:s");
			
			//$sql = "INSERT INTO Req_Personal_Loan_ivr (Name, Email, Phone, City, Dated, Net_Salary ,Source, Section, Incremented_Time ) VALUES ('$full_name', '$email', '$mobile_no','$city', '$currentDate', '$Net_Salary', '$Source','$Section', '$defineDate')";
			//echo $sql;
			$dataInsert = array("Name"=>$full_name, "Email"=>$email, "Phone"=>$mobile_no, "City"=>$city, "Dated"=>$currentDate, "Net_Salary"=>$Net_Salary, "Source"=>$Source, "Section"=>$Section, "Incremented_Time"=>$defineDate);
$table = 'Req_Personal_Loan_ivr';
$insert = Maininsertfunc ($table, $dataInsert);
			
			//$result = ExecQuery($sql);
	
			$Customerid = mysql_insert_id();
			//Put the actual logic for selecting bidders and calling 
			//$Customerid = $Activate;
			$City = $city;
			$SMSMessage = "Get call from 011-43009300.Once you have spoken to 1 Company press 0 goto the Main-Menu.";
			if(strlen(trim($mobile_no)) > 0)
			{
				//SendSMS($SMSMessage, $SmsMobileNo);
			}
			//echo "<br>".Test;

			getBiddersList(1, $Customerid, $City, $mobile_no);
			
		}
		else
		{
			//$sql = "INSERT INTO Req_Personal_Loan_ivr (Name, Email, Phone, City, Dated, Net_Salary, Reference, Source, Section ) VALUES ('$full_name', '$email', '$mobile_no','$city', '$currentDate', '$Net_Salary', 'Other time','$Source','$Section' )";
			
		//	$result = ExecQuery($sql);
		$dataInsert = array("Name"=>$full_name, "Email"=>$email, "Phone"=>$mobile_no, "City"=>$city, "Dated"=>$currentDate, "Net_Salary"=>$Net_Salary, "Reference"=>'Other time', "Source"=>$Source, "Section"=>$Section);
		$table = 'Req_Personal_Loan_ivr';
		$insert = Maininsertfunc ($table, $dataInsert);
		
		}
		
	//	exit();
		}
		else 
		{
			//$sql = "INSERT INTO Req_Personal_Loan_ivr (Name, Email, Phone, City, Dated, Net_Salary, Reference, Source, Section ) VALUES ('$full_name', '$email', '$mobile_no','$city', '$currentDate', '$Net_Salary', 'Other','$Source','$Section' )";
	
		//$result = ExecQuery($sql);
		
		$dataInsert = array("Name"=>$full_name, "Email"=>$email, "Phone"=>$mobile_no, "City"=>$city, "Dated"=>$currentDate, "Net_Salary"=>$Net_Salary, "Reference"=>'Other', "Source"=>$Source, "Section"=>$Section);
		$table = 'Req_Personal_Loan_ivr';
		$insert = Maininsertfunc ($table, $dataInsert);
		
//echo "hello".$sql;		
		}
		//echo "<br>".$sql."<br>";
	}
	else 
	{
		$msg = "NotAuthorised";
		$PostURL = $_POST["URL"]."?msg=".$msg;
		header("Location: $PostURL");
	}
	
}	
echo "Thank You Page";
?>