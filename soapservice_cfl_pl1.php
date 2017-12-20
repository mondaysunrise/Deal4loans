<?php
function cflgettoken()
{
		$grant_type = "password";
		$LoginURL   =  "https://test.salesforce.com/services/oauth2/token";
		$ClientID   =  "3MVG9Se4BnchkASky48PDFhRdaKqZFbXyi5Ap869pbVr8eaNVLCOD8ze3XFoeQ.v1buh4pQBOlrrFxRUfRBXi";
		$ClientSecret  =  "2950331567982633593";
		$UserName      =  "reporting.manager.misuser@capfirst.com.uat2";
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

function cflfirstserv($access_token)
{
	$access_token = cflgettoken();
	$url = "https://cs31.salesforce.com/services/apexrest/CreateLoan/";
	$content='{"loanAppWrapper": 
	 { 
	 "location":"GHAZIABAD", 
	 "lob":"PL",      
	 "createdBy":"Customer",   
	"partnerName":"DealForLoans_PL", 
	 "firstName":"customer test", 
	 "lastName":"kumar", 
	 "middleName":"", 
	 "loanSource":"PLOnline",    
	 "gender":"Male",     
	 "maritalStatus":"Married",     
	 "dateOfBirth":"08/06/1978", 
	 "mobileNumber":"9971396361", 
	 "emailId":"upendra@gmail.com", 
	 "PAN":"ATDPK2777Q",  
	 "voterId":"", 
	 "passportNumber":"",    
	 "listAddress": 
	  [{"addressLine1":"flatno -28",
	"addressLine2":"vishwas nagar",
	"pincode":"201301",
	"addressType":"RESIDENCE ADDRESS",
	"landmark":""}]
	}}';

//$access_token="00Dp00000000Tmb!AQwAQL3wXeBoIBVoyjhwW6RXXfkc6MBcUyaAbWw72PTBU8GhzeliyxbtATl7zZKVeuWX87i6mL6cjM0vHMqFRXM.iyJ1zlLT";
$curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Authorization: Bearer $access_token",
                "Content-type: application/json", "Accept: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    echo $json_response = curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

//print_R($json_response);

$json_response='"success: Loan Application Number - 804322827"';
  echo  $response = json_decode($json_response, true);
  // Provides: <body text='black'>
  echo "<br><br>";
echo $bodytag = str_replace("success:", "", $response);

    //if ( $status != 201 ) {
        //die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
   // }
    curl_close($curl);


}

function cflsecondserv()
{
	echo "token".$access_token = cflgettoken();
	$url = "https://cs31.salesforce.com/services/apexrest/UpdateLoan/";
	$content='{
	"loanAppWrapper": {
		"ApplicationNo": "804324808",
		"listAddress": [{
			"addressLine1": "addressLine1",
			"addressLine2": "addressLine2",
			"pincode": "400001",
			"landmark": "Near XYZ Store",
			"addressType": "OFFICE ADDRESS"
		}],
		"listEmploymentDetails": [{
			"customerCategory": "SALARIED",
			"companyName": "XYZ",
			"annualGrossIncome": "50000"
		}]
	}
}';

echo "<br><br>";
//$access_token="00Dp00000000Tmb!AQwAQL3wXeBoIBVoyjhwW6RXXfkc6MBcUyaAbWw72PTBU8GhzeliyxbtATl7zZKVeuWX87i6mL6cjM0vHMqFRXM.iyJ1zlLT";
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

    if ( $status != 201 ) {
        die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }

    curl_close($curl);
}

function cflthirdserv()
{
	echo "3 token".$access_token = cflgettoken();
	$url = "https://cs31.salesforce.com/services/apexrest/GetLoanDetails/";
	$content='{"loanAppWrapper": 
 { 
 "ApplicationNo":"804324808" 
}  
}';

echo "<br><br>";
//$access_token="00Dp00000000Tmb!AQwAQL3wXeBoIBVoyjhwW6RXXfkc6MBcUyaAbWw72PTBU8GhzeliyxbtATl7zZKVeuWX87i6mL6cjM0vHMqFRXM.iyJ1zlLT";
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

    if ( $status != 201 ) {
        die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }

    curl_close($curl);
}


main();

function main()
{
	//cflfirstserv();
	//cflsecondserv();
	cflthirdserv();
}

?>