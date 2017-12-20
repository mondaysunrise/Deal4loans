<?php 
//@set_time_limit(800);
require 'scripts/db_init.php';
echo"hello";
//for cardekho.com
		$PassCode = "CLCamp$D4l";
	if($PassCode=="CLCamp$D4l")
	{
		echo "d im";
		 $Name = $_POST["FullName"];
		 $Mobile_Number = $_POST["MobileNo"];
		 $Email = $_POST["EmailID"];
		 $DOB = $_POST["DateOfBirth"];
		 $City = $_POST["City"];
		 $Car_Type = $_POST["CarType"];
		 $Car_Booked = $_POST["CarBooked"];
		 $Car_Make = $_POST["CarMake"];
		 $Car_Model = $_POST["CarModel"];
		 $Loan_Amount = $_POST["LoanAmount"];
		 $Employment_Status = $_POST["EmploymentStatus"];
		 $Company_Name = $_POST["CompanyName"];
		 $Net_Salary = $_POST["AnnualIncome"];
		 $Total_Experience = $_POST["TotalExperience"];
		 $Residence_Status = $_POST["ResidenceStatus"];
		 $Residence_Stability = $_POST["ResidenceStability"];
		 $Is_Valid =  $_POST["Verified"];
		 $source =  $_POST["Leadsource"];

		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!="") && strlen($City)>1)
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Car Where ( Mobile_Number not in (9999570210,9811215138,9811555306,9873678915,9999047207) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	//echo $getdetails."<br>";
	//exit();
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;

	if($alreadyExist>0)
	{
		echo "Duplicate Lead";
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
			//	echo "<br>if".$InsertProductSql;
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Mobile_Number'=>$Mobile_Number, 'Email'=>$Email, 'DOB'=>$DOB, 'City'=>$City, 'Car_Type'=>$Car_Type, 'Car_Booked'=>$Car_Booked, 'Car_Make'=>$Car_Make, 'Car_Model'=>$Car_Model, 'Loan_Amount'=>$Loan_Amount, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'Net_Salary'=>$Net_Salary, 'Total_Experience'=>$Total_Experience, 'Residence_Status'=>$Residence_Status, 'Residence_Stability'=>$Residence_Stability, 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'source'=>$source, 'Is_Valid'=>$Is_Valid);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Mobile_Number'=>$Mobile_Number, 'Email'=>$Email, 'DOB'=>$DOB, 'City'=>$City, 'Car_Type'=>$Car_Type, 'Car_Booked'=>$Car_Booked, 'Car_Make'=>$Car_Make, 'Car_Model'=>$Car_Model, 'Loan_Amount'=>$Loan_Amount, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'Net_Salary'=>$Net_Salary, 'Total_Experience'=>$Total_Experience, 'Residence_Status'=>$Residence_Status, 'Residence_Stability'=>$Residence_Stability, 'Dated'=>$Dated, 'Updated_Date'=>$Dated, 'source'=>$source, 'Is_Valid'=>$Is_Valid);
			}
			echo $InsertwUsersSql."<br>";
			$ProductValue = Maininsertfunc ("Req_Loan_Car", $dataArray);		
			
		//Delhi/Mumbai and Bangalore 	
		if(($City=="Delhi" || $City=="Noida" || $City=="Gurgaon" || $City=="Gaziabad" || $City=="Faridabad" || $City=="Mumbai" || $City=="Thane" || $City=="Navi Mumbai" || $City=="Bangalore") && $ProductValue>0)
		{
			echo "Valid lead";
		}
		else
		{
			echo "Not Correct City";
		}

			}

		}
		else
		{
			echo "insert values";
		}
	}
	else
	{
		echo "Wrong PassCode";	
	}

 ?>