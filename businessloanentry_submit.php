<?php
require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
if(isset($_POST['submit']))
{
		$Email = $_POST['Email'];
		$FName = $_POST['FName'];//New
		$LName = $_POST['LName'];//New
		$Name = $FName." ".$LName; 
		$Day=$_POST['day'];
		$Month=$_POST['month'];
		$Year=$_POST['year'];
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = $_POST['Phone'];
		$City = $_POST['City'];
		$City_Other = $_POST['City_Other'];
		$Pincode = $_POST['Pincode'];
		$Residence_Address = $_POST['Residence_Address'];//New
		$Employment_Status = $_POST['Employment_Status'];
		$Company_Name = $_POST['Company_Name'];
		//$Occupation = $_POST['Occupation'];//New
		$Company = $_POST['Company'];//New
		$Experience = $_POST['Experience'];

		$Industry = $_POST['Industry'];
		$Constitution = $_POST['Constitution'];
		$Year_Of_Establishment = $_POST['Year_Of_Establishment'];
		$Net_Salary = $_POST['Net_Salary'];
		$Annual_Turnover = $_POST['Annual_Turnover'];
		$Loan_Amount = $_POST['Loan_Amount'];

		$CCbusiness = $_POST['CCbusiness'];
		$Card_Vintage = $_POST['Card_Vintage'];

		$From_Product = $_POST['From_Product'];
		$n       = count($From_Product);
	    $i      = 0;
	    while ($i < $n)
	    {
		  $From_Pro .= "$From_Product[$i], ";
		  $i++;
	    }
	
		$LoanAny = $_POST['LoanAny'];
		$Loan_Any = $_POST['Loan_Any'];
	
		$n       = count($Loan_Any);
	    $i      = 0;
	    while ($i < $n)
	    {
		  $Loan_Any_Pro .= "$Loan_Any[$i], ";
		  $i++;
	    }
	
		$Std_Code1 = $_POST['Std_Code1'];
		$Phone1 = $_POST['Phone1'];
		
		$EMI_Paid = $_POST['EMI_Paid'];
		$source = $_POST['source'];

				
		$Dated = ExactServerdate();
		
		$dataInsert = array("Name"=>$Name , "Email"=>$Email , "DOB"=>$DOB , "City"=>$City , "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Industry"=>$Industry, "Constitution"=>$Constitution, "Year_Of_Establishment"=>$Year_Of_Establishment, "Loan_Amount"=>$Loan_Amount, "Pincode"=>$Pincode, "CC_Holder"=>$CCbusiness, "Card_Vintage"=>$Card_Vintage, "CC_Bank"=>$From_Pro, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_Any_Pro, "Annual_Turnover"=>$Annual_Turnover,  "Dated"=>$Dated, "source"=>$source,  "Is_Valid"=>1, "Company_Name"=>$Company, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Experience"=>$Experience, "IsPublic"=>1 );
		$table = 'Req_Business_Loan';
		$insert = Maininsertfunc ($table, $dataInsert);
		
		//echo mysql_insert_id();
		header("Location: businessloanentry.php?msg=$Name");
		exit();
}
		
?>