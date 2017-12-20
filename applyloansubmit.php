<?php
require "scripts/db_init.php";
//require 'scripts/functions.php';

$Dated = ExactServerdate();

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Business_Loan' => 'Business Loan',
		);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

function getProductCode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

   function InsertTataAig($RequestID, $ProductName)
	{
	//echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		//$RowGetDate = mysql_fetch_array($GetDateSql);
		 list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;

		
		
		$TDated = $RowGetDate[$cntr]['Dated'];
		$TCity = $RowGetDate[$cntr]['City'];
		$Mobile = $RowGetDate[$cntr]['Mobile_Number'];
		$Product_Name = getProductCode("$ProductName");
		 $Dated = ExactServerdate();
			
		$dataInsert = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
		
		//echo $Sql;
		//exit();

	}
 //  print_r($_POST);
 //  exit();
$Residence_Address = $_POST['Residence_Address'];
$Product_Type = $_POST['Product_Type'];
$FName = $_POST['FName'];
$LName = $_POST['LName'];
$Name=$FName." ".$LName;
$Day = $_POST['day'];
$Month = $_POST['month'];
$Year = $_POST['year'];
$DOB=$Year."-".$Month."-".$Day;
$Std_Code1 = $_POST['Std_Code'];
$Phone1 = $_POST['Phone1'];
$Std_Code2 = $_POST['Std_Code_O'];
$Phone2 = $_POST['Landline_O'];
$Phone = $_POST['Phone'];
$Card_Vintage = $_POST['Card_Vintage'];
$Card_Limit = $_POST['Card_Limit'];
$Email = $_POST['Email'];
$City = $_POST['City'];
$Company_Name = $_POST['Company_Name'];
$City_Other = $_POST['City_Other'];
$Pincode = $_POST['Pincode'];
$Employment_Status = $_POST['Employment_Status'];
$Net_Salary = $_POST['IncomeAmount'];
$Loan_Amount = $_POST['Loan_Amount'];
$CC_Holder = $_POST['CC_Holder'];
$Pancard = $_POST['Pancard'];
$From_Product = $_POST['From_Product'];
$EnteredDate = $_POST['EnteredDate'];
$Loan_Time = $_POST['Loan_Time'];
$Accidental_Insurance = $_POST['Accidental_Insurance'];
$Annual_Turnover = $_POST['Annual_Turnover'];
$Year_Of_Establishment = $_POST['Year_Of_Establishment'];
$IP = getenv("REMOTE_ADDR");

$n = count($From_Product);
$i = 0;
 while ($i < $n)
{
  $From_Pro .= "$From_Product[$i], ";
  $i++;
}

$Residential_Status = $_POST['Residential_Status'];
$Years_In_Company = $_POST['Years_In_Company'];
$Total_Experience = $_POST['Total_Experience'];
$LoanAny = $_POST['LoanAny'];
$Loan_Any = $_POST['Loan_Any'];
$n1       = count($Loan_Any);
$i1      = 0;
 while ($i1 < $n1)
{
  $From_Loan_Any .= "$Loan_Any[$i1], ";
  $i1++;
}

$EMI_Paid = $_POST['EMI_Paid'];



$Property_Identified = $_POST['Property_Identified'];
$Property_Loc = $_POST['Property_Loc'];

$Car_Type = $_POST['Car_Type'];

$Budget = $_POST['Budget'];



if($Product_Type=="Req_Loan_Personal")
{ 
	 
	$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Std_Code_O'=>$Std_Code2, 'Landline_O'=>$Phone2, 'Years_In_Company'=>$Years_In_Company, 'Total_Experience'=>$Total_Experience, 'Net_Salary'=>$Net_Salary, 'Residential_Status'=>$Residential_Status, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>'sms', 'Loan_Any'=>$From_Loan_Any, 'EMI_Paid'=>$EMI_Paid, 'Is_Valid'=>'1', 'IsPublic'=>'1', 'Card_Vintage'=>$Card_Vintage, 'Card_Limit'=>$Card_Limit, 'Accidental_Insurance'=>$Accidental_Insurance, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP);

}

elseif($Product_Type=="Req_Credit_Card")
{ 
	$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Std_Code_O'=>$Std_Code2, 'Landline_O'=>$Phone2, 'Total_Experience'=>$Total_Experience, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'No_of_Banks'=>$From_Pro, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>'sms', 'Loan_Any'=>$From_Loan_Any, 'Is_Valid'=>'1', 'IsPublic'=>'1', 'Pancard'=>$Pancard, 'Card_Vintage'=>$Card_Vintage, 'Credit_Limit'=>$Credit_Limit, 'Accidental_Insurance'=>$Accidental_Insurance, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated);
}
						
else if($Product_Type=="Req_Loan_Home")
{
	$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Std_Code_O'=>$Std_Code2, 'Landline_O'=>$Phone2, 'Total_Experience'=>$Total_Experience, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>'sms', 'Loan_Any'=>$From_Loan_Any, 'Property_Identified'=>$Property_Identified, 'Property_Loc'=>$Property_Loc, 'Residence_Address'=>$Residence_Address, 'Is_Valid'=>'1', 'IsPublic'=>'1', 'Loan_Time'=>$Loan_Time, 'Accidental_Insurance'=>$Accidental_Insurance, 'Updated_Date'=>$Dated);


}
else if($Product_Type=="Req_Loan_Car")
{
	$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Std_Code_O'=>$Std_Code2, 'Landline_O'=>$Phone2, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>'sms', 'Loan_Any'=>$From_Loan_Any, 'Car_Type'=>$Car_Type, 'Is_Valid'=>'1', 'IsPublic'=>'1', 'Car_Insurance'=>$Car_Insurance, 'Accidental_Insurance'=>$Accidental_Insurance);
}
else if($Product_Type=="Req_Loan_Against_Property")
{
	$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Std_Code_O'=>$Std_Code2, 'Landline_O'=>$Phone2, 'Total_Experience'=>$Total_Experience, 'Net_Salary'=>$Net_Salary, 'Residential_Status'=>$Residential_Status, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>'sms', 'Loan_Any'=>$From_Loan_Any, 'Property_Value'=>$Budget, 'Is_Valid'=>'1', 'Residence_Address'=>$Residence_Address, 'IsPublic'=>'1', 'Accidental_Insurance'=>$Accidental_Insurance);
}
elseif($Product_Type=="Req_Business_Loan")
{ 
	$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Mobile_Number'=>$Phone, 'City'=>$City, 'City_Other'=>$City_Other, 'Pincode'=>$Pincode, 'Industry'=>$Industry, 'Year_Of_Establishment'=>$Year_Of_Establishment, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$Loan_Amount, 'IsPublic'=>$IsPublic, 'DOB'=>$DOB, 'Dated'=>$Dated, 'source'=>'sms', 'Reference_Code'=>$Reference_Code, 'Annual_Turnover'=>$Annual_Turnover, 'Std_Code'=>$Std_Code, 'Landline'=>$Phone1, 'Accidental_Insurance'=>$Accidental_Insurance, 'Residential_Status'=>$Residential_Status, 'Office_Status'=>$Office_Status, 'CC_Holder'=>$CC_Holder, 'Company_Name'=>$Company_Name, 'Constitution'=>$Constitution, 'Card_Vintage'=>$Card_Vintage, 'CC_Bank'=>$From_Pro, 'Card_Limit'=>$Card_Limit, 'Loan_Any'=>$From_Loan_Any, 'Is_Valid'=>'1', 'EMI_Paid'=>$EMI_Paid);
}

	$LastID = Maininsertfunc ($Product_Type, $dataInsert);

if($Accidental_Insurance==1)
			{
				$RequestID = $LastID;
				$ProductName = $Product_Type;
			InsertTataAig($RequestID, $ProductName);
			}
$Email = trim($Email);
$WUsersSQL = "SELECT UserID FROM wUsers WHERE Email='".$Email."'";
 list($WUsers_NumRows,$WUsersRows)=MainselectfuncNew($WUsersSQL,$array = array());
		$cntr=0;

if($WUsers_NumRows>0)
{
	$UserID = $WUsersRows[0];
	$dataUpdate = array('UserID'=>$UserID);
	$wherecondition = "(RequestID =".$LastID.")";
	Mainupdatefunc ($Product_Type, $dataUpdate, $wherecondition);
}
else 
{
	
$dataInsert = array("Email"=>$Email , "FName"=>$FName , "LName"=>$LName , "Phone"=>$Phone , "DOB"=>$DOB, "Join_Date"=>$Dated );
$table = 'wUsers';
$LastInsertedID = Maininsertfunc ($table, $dataInsert);
	
	$dataUpdate = array('UserID'=>$LastInsertedID);
	$wherecondition = "(RequestID =".$LastID.")";
	Mainupdatefunc ($Product_Type, $dataUpdate, $wherecondition);

	// echo $UpdateUserID;
}
//exit();

$msg = "Inserted";
$Prod = getProductName($Product_Type);
header("Location:justdial.php?msg=$Prod");


?>