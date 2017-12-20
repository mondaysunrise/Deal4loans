<?php
ini_set('max_execution_time', 600);
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'webservice/nusoap.php';
	 $wsdl = "http://www.deal4loans.com/webservice/lnihome.php?wsdl"; 
	 $client=new nusoap_client($wsdl, true); 
print_r($client);	 
$param ='';	 
$param['Loan_Amount'] => 500000.00;
$param['Employment_Status'] = 1; 
$param['Net_Salary'] = 252000.00;
$param['Name'] = "Sarojini";
$param['City'] = "Coimbatore"
$param['Phone'] = 9344482283;
$param['Email'] = "jeusssarovinu@gmail.com";
$param['IP'] = "61.11.121.144";
$param['bldReqID'] = 63663; 
$param['source'] = "sbi_loansninsur" ;
$param['year'] ="";
$param['month'] = "";
$param['day'] = "";
$param['obligations'] = 0;
$param['co_name'] ="";
$param['co_appli'] =""; 
$param['co_day'] =""; 
$param['co_year'] = "";
$param['co_month'] = "";
$param['co_monthly_income'] = 0;
$param['co_obligations'] = 0; 
$param['property_value'] = 0; 
$param['Property_Identified'] = 0 ;
$param['Pincode'] = "";
$param['Property_loc'] = "";
$param['City_Other'] ="";

print_r($param);
	 $result = $client->call('HomeLoanLeads', $param); 
	 echo "<br>";
	 print_r($result);

?>