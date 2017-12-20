<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

function cflgettoken()
{
		$grant_type = "password";
		$LoginURL   =  "https://login.salesforce.com/services/oauth2/token";
		$ClientID   =  "3MVG9Nvmjd9lcjRl7QX6KnT1Z0gF1_.J0J42kruiO9U280gZ3HZ5I3q7jeNvnUoISYkwh8DHaQYhqQQtipMOa";
		$ClientSecret  =  "8635149191249287880";
		$UserName      =  "reporting.manager.misuser@capfirst.com";
		$Password      =  "New#1234";
		$param="";
		$param["grant_type"] = $grant_type;
		$param["client_id"] = $ClientID;
		$param["client_secret"] = $ClientSecret;
		$param["username"] = $UserName;
		$param["password"] = $Password;
	
		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		
		 $request = substr($request, 0, strlen($request)-1);
		
		 $ch = curl_init($LoginURL);
		  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
			$result = curl_exec($ch);
		  curl_close($ch); 	
		$obj = json_decode($result);
		$access_token = $obj->{'access_token'}; 
		$instance_url = $obj->{'instance_url'}; 
		$token_type = $obj->{'token_type'}; 
		$issued_at =  $obj->{'issued_at'}; 
		$signature = $obj->{'signature'}; 

		return($access_token);
	}

function cflsecondserv($applicationNo, $OfficeAddress, $OfficePincode, $Occupation, $CompanyName, $Income)
{
	$Occupation = strtoupper($Occupation);
	$strofficeadd = round((strlen($OfficeAddress)/2));
 	$officeadd = str_split($OfficeAddress, $strofficeadd);
	list($Annualincome,$lastpart) = split('[.]', $Income);
	$access_token = cflgettoken();
	$url = "https://ap4.salesforce.com/services/apexrest/UpdateLoan/";
	$content='{
	"loanAppWrapper": {
		"ApplicationNo": "'.trim($applicationNo).'",
		"listAddress": [{
			"addressLine1": "'.strip_tags($officeadd[0]).'",
			"addressLine2": "'.strip_tags($officeadd[1]).'",
			"pincode": "'.trim($OfficePincode).'",
			"landmark": "Near XYZ Store",
			"addressType": "OFFICE ADDRESS"
		}],
		"listEmploymentDetails": [{
			"customerCategory": "'.trim($Occupation).'",
			"companyName": "'.trim($CompanyName).'",
			"annualGrossIncome": "'.trim($Annualincome).'"
		}]
	}
}';
//echo $content;
  $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: Bearer $access_token",
                "Content-type: application/json", "Accept: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    $json_response = curl_exec($curl);
    $responsetag = json_decode($json_response, true);
	 curl_close($curl);
//Loan Application Updated successfully: 2585963
return($responsetag);
}

function cflthirdserv($applicationNo)
{
	$access_token = cflgettoken();
	$url = "https://ap4.salesforce.com/services/apexrest/GetLoanDetails/";
	$content='{"loanAppWrapper": 
 { 
 "ApplicationNo":"'.trim($applicationNo).'" 
}  
}';
//echo $content;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: Bearer $access_token",
                "Content-type: application/json", "Accept: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    $json_response = curl_exec($curl);
	$responsetag = json_decode($json_response, true);
	 curl_close($curl);
	//Application No : 54838434 ,Max Allowed Loan Amount :400000 
return($responsetag);
}

function applicationservice2()
{	
	$today = Date('Y-m-d');
	$min_date = $today." 00:00:00"; 
	$max_date = ExactServerdate();	
	echo $webquery="Select * from apply_pl_capitalfirst Where ((DATE_SUB( NOW() , INTERVAL '00:15' HOUR_MINUTE ) >= first_webdated) and first_webservice like '%Loan Application Number%' and (second_webservice='' or second_webservice IS NULL))";
	$webqueryresult = ExecQuery($webquery);
	while($row=mysql_fetch_array($webqueryresult))
	{	
		//$applicationNo, $OfficeAddress, $OfficePincode, $Occupation, $CompanyName, $Income
		$capitalfirstid = $row["capitalfirstid"];
		$first_webservice = $row["first_webservice"];
		$capitalfirst_office_address = $row["capitalfirst_office_address"];
		$capitalfirst_officepincode = $row["capitalfirst_officepincode"];
		$capitalfirst_occupation = $row["capitalfirst_occupation"];
		$capitalfirst_company_name = $row["capitalfirst_company_name"];
		$capitalfirst_annual_income = $row["capitalfirst_annual_income"];

		$string=trim($first_webservice);
		list($firstpart,$laststatus) = split('[-]', $string);
		if($laststatus>0)
		{
			$secondstatus=cflsecondserv($laststatus, $capitalfirst_office_address, $capitalfirst_officepincode, $capitalfirst_occupation, $capitalfirst_company_name, $capitalfirst_annual_income);

			if(strlen($secondstatus)>0 && $capitalfirstid>0)
			{
				$secondupdate="Update apply_pl_capitalfirst set second_webservice='".$secondstatus."', second_webdated=Now() Where capitalfirstid=".$capitalfirstid;
				$secondupdateresult = ExecQuery($secondupdate);
			}
		}
	}
}

function applicationservice3()
{	
	$today = Date('Y-m-d');
	$min_date = $today." 00:00:00"; 
	$max_date = ExactServerdate();	
	$webquery="Select capitalfirstid,first_webservice from apply_pl_capitalfirst Where ((DATE_SUB( NOW() , INTERVAL '00:30' HOUR_MINUTE ) >= second_webdated)  and first_webservice like '%Loan Application Number%' and second_webservice like '%Loan Application Updated successfully%' and (third_webservice='' or third_webservice IS NULL))";
	$webqueryresult = ExecQuery($webquery);
	while($row=mysql_fetch_array($webqueryresult))
	{	
		$capitalfirstid = $row["capitalfirstid"];
		$first_webservice = $row["first_webservice"];	

		$string=trim($first_webservice);
		list($firstpart,$laststatus) = split('[-]', $string);
		if($laststatus>0)
		{
			$thirdstatus=cflthirdserv($laststatus);

			if(strlen($thirdstatus)>0 && $capitalfirstid>0)
			{
				$thirdupdate="Update apply_pl_capitalfirst set third_webservice='".$thirdstatus."', third_webdated=Now() Where capitalfirstid=".$capitalfirstid;
				$thirdupdateresult = ExecQuery($thirdupdate);
			}
		}
	}
}

main();

function main()
{
	applicationservice3();
	applicationservice2();
	
}

?>