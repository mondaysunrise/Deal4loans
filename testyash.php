<?php 

require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$selqy="Select * from bajaj_cibildetails Where bajajcibilid in  (2175,2174,2186,2117,2115,2187,2139,2155,2144,2159)";

list($recordcount,$row)=MainselectfuncNew($selqy,$array = array());

$cntr=0;
            if($recordcount>0)
            {
            while($cntr<count($row))
            {
		echo $loan_amount = $row[$cntr]["bajajf_loan_amt"];
	$name = $row[$cntr]["bajajf_name"];
	$dob = $row[$cntr]["bajajf_dob"];
	$City = $row[$cntr]["bajajf_city"];
	$Mobile_Number = $row[$cntr]["bajajf_mobile"];
	$gender = $row[$cntr]["bajajf_gender"];
	$panno = $row[$cntr]["bajajf_panno"];
	$caddress = $row[$cntr]["bajajf_caddress"];
	$state = $row[$cntr]["bajajf_cstate"];
	$pincode = $row[$cntr]["bajajf_cpincode"];
	$paddress = $row[$cntr]["bajajf_paddress"];
	$pstate = $row[$cntr]["bajajf_pstate"];
	$ppincode = $row[$cntr]["bajajf_ppincode"];
	$company_name = $row[$cntr]["bajajf_company_name"];
	$net_salary = $row[$cntr]["bajajf_salary"];
	$salary = $net_salary;
	
	if($gender==2)
		{
			$gendr="Female";
		}
		else
		{
			$gendr="Male";
		}
			$cntr=$cntr+1;
			}
			}

?>