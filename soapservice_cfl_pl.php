<?php
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

function cflfirstserv($City,$name,$pincode,$gender,$marriedstat,$dob,$email,$pan,$resiaddress, $Mobile_Number)
{
	$City = strtoupper($City);
	list($year, $month, $day) = split('[-]', $dob);
	$strdob= $day."/".$month."/".$year;
	list($first,$last) = split('[ ]', $name);

	$strresiadd = round((strlen($resiaddress)/2));
 	$resiadd = str_split($resiaddress, $strresiadd);
	//print_R($resiadd);
	$access_token = cflgettoken();
	$url = "https://ap4.salesforce.com/services/apexrest/CreateLoan/";
	$content='{"loanAppWrapper": 
	 { 
	 "location":"'.$City.'", 
	 "lob":"PL",      
	 "createdBy":"Customer",   
	"partnerName":"DealForLoans_PL", 
	 "firstName":"'.trim($first).'", 
	 "lastName":"'.trim($last).'", 
	 "middleName":"", 
	 "loanSource":"PLOnline",    
	 "gender":"Male",     
	 "maritalStatus":"'.$marriedstat.'",     
	 "dateOfBirth":"'.$strdob.'", 
	 "mobileNumber":"'.$Mobile_Number.'", 
	 "emailId":"'.$email.'", 
	 "PAN":"'.$pan.'",  
	 "voterId":"", 
	 "passportNumber":"",    
	 "listAddress": 
	  [{"addressLine1":"'.strip_tags($resiadd[0]).'",
	"addressLine2":"'.strip_tags($resiadd[1]).'",
	"pincode":"'.$pincode.'",
	"addressType":"RESIDENCE ADDRESS",
	"landmark":""}]
	}}';

//echo $content."<br><br>";
$curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: Bearer $access_token",
                "Content-type: application/json", "Accept: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
   
   $response = json_decode($json_response, true);
print_r($response);
  $responsetag = str_replace("success:", "", $response);
    curl_close($curl);

return($responsetag);
}
?>