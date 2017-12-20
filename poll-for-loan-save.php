<?php
include("scripts/db_init.php");

$return_url = $_SERVER['HTTP_REFERER'];

if($_POST['employment_status']!="" && $_POST['annual_income']!="" && $_POST['loan_type']!="" && $_POST['loan_amount']!="" && $_POST['full_name']!="" && $_POST['mobile']!="" && $_POST['email']!="" && $_POST['city']!=""){

	$employment_status = $_POST['employment_status'];
	$annual_income = $_POST['annual_income'];
	$loan_type = $_POST['loan_type'];
	$loan_amount = $_POST['loan_amount'];
	if(strlen($_POST['preferred_bank']) > 0){
		$preferred_banks = implode(",",$_POST['preferred_bank']);
	}
	
	if(strlen($preferred_banks) >2 )
	{
		$preferred_banks = $preferred_banks;
	}
	else
	{
		if($_POST['other_bank']=='Other Bank'){
			$other_bank = '';
		}else{
			$preferred_banks = 'Other Bank';
			$other_bank = $_POST['other_bank'];
		}
	}
	
	$full_name = $_POST['full_name'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$city = $_POST['city'];
	$currDateTime = date('Y-m-d h:i:s');
	$dataInsert = array('employment_status'=>$employment_status, 'annual_income'=>$annual_income, 'loan_type'=>$loan_type, 'loan_amount'=>$loan_amount, 'preferred_banks'=>$preferred_banks, 'other_bank'=>$other_bank, 'name'=>$full_name, 'email'=>$email, 'mobile'=>$mobile, 'city'=>$city, 'datetime'=>$currDateTime);
	$insert = Maininsertfunc ('poll_for_loan', $dataInsert);

	$_SESSION['city'] = $city;
	echo "<script>document.location.href='".$return_url."'</script>";

}else{
	echo "<script>document.location.href='".$return_url."'</script>";
}

?>

