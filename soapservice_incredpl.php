<?php
@set_time_limit(2000);

function incredapi1()
{
	$incredjson='{  
	"MOBILE":"9876543210",
	"LOAN_TYPE":"PL",
	"LOAN_AMOUNT":1,
	"LOAN_TENURE":12,
	"EXISTING_EMI":1000,
	"FNAME":"MIKA",
	"LNAME":"SINGH",
	"GENDER":"M",
	"DOB":"19/11/1990",
	"ADDRESS":"46, Jangpura Road, Bhopal",
	"LOCALITY":"Delhi",
	"PINCODE":"795002",
	"STATE":"7",
	"PAN":"AAAPA1112A",
	"FATHER_NAME":"SHARMA FATHER",
	"EMPLOYMENT":{  
	  "ADDRESS":"D09 FIRST STREET",
	  "LOCALITY":"ELECTRONIC CITY",
	  "PINCODE":"789123",
	  "STATE":"7",
	  "COMPANY":"father and son",
	  "COMPANY_CATEGORY":"ASSOCIATIO",
	  "INDUSTRY":"25",
	  "NATURE_OF_BUSINESS":"231",
	  "EMPLOYMENT_TYPE":"SALARIED",
	  "DESIGNATION":"SALESMAN",
	  "EMAIL":"SALESMAN@GTESTTEST.COM",
	  "FROM_DATE":"02/2016",
	  "SALARY":{  
		 "MONTHLY":60000,
		 "NET_MONTHLY":60000,
		 "TYPE":"NEFT"
	  }
	}
	}';

	$headers = array("Content-type: application/json",
					  "api-key:f02e00f8ac3e1c13adf578f5e9db478ec84733fbcb2b1bf53b203708e4b845", 
					   ); // your op URL

	$url ='https://uat-api.incred.com/applicationCreate';
	$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "$incredjson");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch); 

		print_R($output);
}


incredapi2();


function incredapi2()
{
	
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://uat-api.incred.com/financialProfileCreate",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"ACCOUNT_HOLDER_NAME\"\r\n\r\nYAswant chauhan\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"ACCOUNT_NUM\"\r\n\r\n231235648566\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"ACCOUNT_TYPE\"\r\n\r\nCURRENT\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"BANK_CODE\"\r\n\r\n101\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"DATA_ENTRY_TYPE\"\r\n\r\nPDF\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"OPERATING_SINCE\"\r\n\r\n02/2013\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"PRIMARY_FLAG\"\r\n\r\nYES\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"APPLICATION_ID\"\r\n\r\n7352852666941090A\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"FILE\"; filename=\"http:\\www.deal4loans.com\\incred2.pdf\"\r\nContent-Type: application/pdf\r\n\r\n\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"BANK_STATEMENT_PASSWORDS\"\r\n\r\n1234\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "api-key: f02e00f8ac3e1c13adf578f5e9db478ec84733fbcb2b1bf53b203708e4b845",
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
}
?>