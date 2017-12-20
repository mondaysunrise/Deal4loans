<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
$checkCity = '';
for($i=3696;$i<3859;$i++)
{
	$last_inserted_id = $i;
	$getotherSql = "select * from ingvyasya_pl_calc_leads  where (ingvyasyaplid ='".$last_inserted_id."')";
	$getotherQuery = ExecQuery($getotherSql);
	//echo $getotherSql."<br>";
	$Net_Salary = mysql_result($getotherQuery,0,'net_salary');
	$city = mysql_result($getotherQuery,0,'city');
	$primary_acc = mysql_result($getotherQuery,0,'primary_acc');
	$Company_Name = mysql_result($getotherQuery,0,'company_name');
	$company_name = $Company_Name;
	$age = mysql_result($getotherQuery,0,'age');
	$other_emi = mysql_result($getotherQuery,0,'clubbed_emi');
	$Residential_Status = mysql_result($getotherQuery,0,'residence_status');
	$Employment_Status = mysql_result($getotherQuery,0,'Employment_Status'); 
	
	if($Residential_Status==6)
	{
		$Residential_Status= "RENTED_AND_STAYING_WITH_FRIENDS";
	}
	else if($Residential_Status==7)
	{
		$Residential_Status="PAYING_GUEST";
	}
	else if($Residential_Status==8)
	{
		$Residential_Status="HOSTEL";
	}
	
	if($primary_acc=="Ingvyasya Bank")
	{
		$account_holder = 1;
	}
		$getcompany='select * from pl_company_list where company_name="'.$Company_Name.'"';
		$getcompanyresult = ExecQuery($getcompany);
		$grow=mysql_fetch_array($getcompanyresult);
		$recordcount = mysql_num_rows($getcompanyresult);
		 $ingvyasyacategory = $grow["ingvyasya"]; 
		 
		$checkCity = $city;
		$cityList = 'Greater Noida,Noida,Faridabad,Sahibabad,Gaziabad,Gurgaon,Delhi,Pune,Mumbai,Bangalore,Chennai,Hyderabad';
		$arrCity = explode(",", $cityList); 
	
	list($interestrate,$getloanamout,$get_emi,$getterm,$Processing_Fee)= ingVyasyaLoans ($ingvyasyacategory, $Net_Salary, $account_holder,$age,$other_emi,$Loan_Amount,$company_name);
	
	//$a = ingVyasyaLoans ($ingvyasyacategory, $Net_Salary, $account_holder,$age,$other_emi,$Loan_Amount,$company_name);
	
	//echo "<br>";
//	echo "ingvyasyacategory---".$ingvyasyacategory."-Net_Salary-".$Net_Salary."-account_holder-".$account_holder."-age-".$age."-other_emi-".$other_emi."-Loan_Amount-".$Loan_Amount."-company_name-".$company_name."-Employment_Status-".$Employment_Status."-Residential_Status-".$Residential_Status;
//	echo "<br>";
//	print_r($a);
	//echo "<br>";
	
	if($Employment_Status==1 && ( $Residential_Status!="RENTED_AND_STAYING_WITH_FRIENDS" && $Residential_Status!="PAYING_GUEST" && $Residential_Status!="HOSTEL" ) && (in_array($checkCity, $arrCity)))
	{
	
		if($getloanamout>0 && $Employment_Status ==1)
		{
			 $updateSql = "update ingvyasya_pl_calc_leads set eligible_loanAmt ='".$getloanamout."', eligible_interestRate ='".$interestrate."',  eligible_emi ='".$get_emi."', eligible_term ='".$getterm."' where ingvyasyaplid ='".$last_inserted_id."'";
			//$updateQuery = ExecQuery($updateSql);
			echo $updateSql.";<br>";
		}
	}
	
//	echo "<br>--------------------------------------------------------------------<br>";
}
?>