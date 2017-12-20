<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
$get_fulnm = $_REQUEST['get_fulnm']; 
$get_email = $_REQUEST['get_email'];
$get_moblno = $_REQUEST['get_moblno']; 
$get_dob = $_REQUEST['get_dob']; 
$get_city = $_REQUEST['get_city']; 
$get_pinid = $_REQUEST['get_pinid']; 
$get_emp_s = $_REQUEST['get_emp_s'];
$get_sal = $_REQUEST['get_sal'];
$get_la = $_REQUEST['get_la'];
$get_cmp_n = $_REQUEST['get_cmp_n'];
$pro = $_REQUEST['pro'];
$Dated = ExactServerdate();

if($pro==1)
{
	$Type_Loan="Req_Loan_Personal";
}
else
{
	$Type_Loan="Req_Loan_Home";
}

if (($pro)>0)
	{
		
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From ".$Type_Loan."  Where (Mobile_Number='".$get_moblno."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			//echo $getdetails."<br>";
			//exit();
			 list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$cntr=0;
			
			//$checkavailability = ExecQuery($getdetails);
			//$alreadyExist = mysql_num_rows($checkavailability);
			//$myrow = mysql_fetch_array($checkavailability);
		
			if($alreadyExist>0)
			{
				echo "Already exist";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
		
		 list($CheckNumRows,$Arrrow)=MainselectfuncNew($CheckSql,$array = array());
		$i=0;
			//$CheckQuery = ExecQuery($CheckSql);
			//echo "<br>".$CheckSql;
			//$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = $Arrrow[$i]['UserID'];
				//$InsertProductSql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source, Employment_Status,DOB, Pincode,Company_Name,Updated_date) VALUES ( '$UserID', '$get_fulnm', '$get_email', '$get_city', '$City_Other', '$get_moblno', '$get_sal', '$get_la', Now(), 'From LMS', '$get_emp_s','$get_dob', '".$get_pinid."', '".$get_cmp_n."', Now())"; 
			//	echo "<br>if".$InsertProductSql;
			
			$dataInsert = array("UserID"=>$UserID, "Name"=>$get_fulnm, "Email"=>$get_email, "City"=>$get_city, "City_Other"=>$City_Other, "Mobile_Number"=>$get_moblno, "Net_Salary"=>$get_sal, "Loan_Amount"=>$get_la, "Dated"=>$Dated, "source"=>'From LMS', "Employment_Status"=>$get_emp_s, "DOB"=>$get_dob, "Pincode"=>$get_pinid, "Company_Name"=>$get_cmp_n, "Updated_date"=>$Dated);
$table = $Type_Loan;

			
			}
			else
			{
				//$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$get_email', '$get_fulnm', '$get_moblno', Now(), '$IsPublic')";			
			$dataInsert2 = array("Email"=>$get_email, "FName"=>$get_fulnm, "Phone"=>$get_moblno, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
			$table2 = 'wUsers';
			$insert2 = Maininsertfunc ($table2, $dataInsert2);
			
				//$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID = mysql_insert_id();
				//$InsertProductSql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source, Employment_Status,DOB, Pincode,Company_Name,Updated_date) VALUES ( '$UserID', '".$get_fulnm."', '".$get_email."', '".$get_city."', '".$City_Other."', '$get_moblno', '$get_sal', '$get_la', Now(), 'From LMS', '$get_emp_s','$get_dob', '".$get_pinid."', '".$get_cmp_n."', Now())";
				//echo "<br>else".$InsertProductSql;
			$dataInsert = array("UserID"=>$UserID, "Name"=>$get_fulnm, "Email"=>$get_email, "City"=>$get_city, "City_Other"=>$City_Other, "Mobile_Number"=>$get_moblno, "Net_Salary"=>$get_sal, "Loan_Amount"=>$get_la, "Dated"=>$Dated, "source"=>'From LMS', "Employment_Status"=>$get_emp_s, "DOB"=>$get_dob, "Pincode"=>$get_pinid, "Company_Name"=>$get_cmp_n, "Updated_date"=>$Dated);
			$table = $Type_Loan;
			}
				$insert = Maininsertfunc ($table, $dataInsert);
				
				//$InsertProductQuery = ExecQuery($InsertProductSql);
			
			echo "Entered in HL";
	}
	}
?>