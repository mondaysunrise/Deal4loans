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


if($Reference_Code == $Activation_Code)
	{

	//$updatecont_det=ExecQuery("Update Req_Loan_Personal set Mobile_Number='".$Phone."',Updated_Date=Now() where RequestID=".$custid);
		$Dated = ExactServerdate();
		$dataInsert = array('RequestID'=>$custid, 'Mobile_Number'=>$oldmobile_no,'NewMobile_number'=>$Phone,'ProductID'=>'1','Dated'=>$Dated,'lead_dated'=>$lead_date);
		$insert = Maininsertfunc ('Duplicate_Lead_Update', $dataInsert);
	}
echo "<script language=javascript>"." location.href='Contents_Personal_Loan_Mustread.php'"."</script>";
}


?>

