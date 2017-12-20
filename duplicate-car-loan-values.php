<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$custid= $_POST['custid'];
	$Phone = $_POST['Phone'];
	$oldmobile_no = $_POST['oldmobile_no'];
	$lead_date = $_POST['lead_date'];
	$Reference_Code = $_POST['Reference_Code'];
	$Activation_Code = $_POST['Activation_Code'];
	$Dated = ExactServerdate();

if($Reference_Code == $Activation_Code)
	{

	//$updatecont_det=ExecQuery("Update Req_Loan_Car set Mobile_Number='".$Phone."',Dated=Now(), Updated_Date=Now() where RequestID=".$custid);

 
$DataArray = array("Mobile_Number"=>$Phone, "Dated"=>$Dates, "Updated_Date"=>$Dated);
$wherecondition ="RequestID=".$custid;
Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);

//$InsertProductSql = ExecQuery("INSERT INTO  Duplicate_Lead_Update (RequestID, Mobile_Number,NewMobile_number,ProductID,Dated,lead_dated) 
//VALUES ('".$custid."','".$oldmobile_no."','".$Phone."','3',Now(),'".$lead_date."' )"); 
$dataInsert = array("RequestID"=>$custid, "Mobile_Number"=>$oldmobile_no, "NewMobile_number"=>$Phone, "ProductID"=>3, "Dated"=>$Dated, "lead_dated"=>$lead_date);
$table = 'Duplicate_Lead_Update';
$insert = Maininsertfunc ($table, $dataInsert);
	
	}
echo "<script language=javascript>"." location.href='Contents_Car_Loan_Mustread.php'"."</script>";
}


?>

