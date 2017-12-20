<?php
$CUSTOMER_NAME = "Upendra Kumar";
$MOBILE_NO = 9971396361;
$PRODUCT = "HL"; 
$CITY = "Delhi";
$LOAN_AMOUNT='100000';
$SOURCE = "Deal4loans";
$EMAIL = "upendra@deal4loans.com";
$DOB = "1978-06-09";
$PINCODE = "201301";
$ANNUALINCOME =500000;
$OCCUPATION = "Salaried";
$PROPERTY_VALUE = 2000000;
$OFFER = 'Testing';
$REMARKS = 'Testing';


//$func = indiaBullsLeads($CUSTOMER_NAME, $MOBILE_NO, $PRODUCT, $CITY, $LOAN_AMOUNT, $SOURCE, $EMAIL, $DOB, $PINCODE, $ANNUALINCOME, $OCCUPATION, $PROPERTY_VALUE, $OFFER, $REMARKS);
//echo $func;
//function indiaBullsLeads($CUSTOMER_NAME, $MOBILE_NO, $PRODUCT, $CITY, $LOAN_AMOUNT, $SOURCE, $EMAIL, $DOB, $PINCODE, $ANNUALINCOME, $OCCUPATION, $PROPERTY_VALUE, $OFFER, $REMARKS)
//{

  $param['CUSTOMER_NAME'] = $CUSTOMER_NAME; //     VARCHAR2(100),  mandatory 
  $param['MOBILE_NO'] = $MOBILE_NO; //         VARCHAR2(10),  mandatory 
  $param['PRODUCT'] = $PRODUCT; //           VARCHAR2(100), mandatory  Please provide "HL" 
  $param['CITY'] = $CITY; //              VARCHAR2(100),  mandatory 
  $param['LOAN_AMOUNT'] = $LOAN_AMOUNT; //       VARCHAR2(15), mandatory 
  $param['SOURCE'] = $SOURCE; //            VARCHAR2(50), mandatory 
  $param['EMAIL'] = $EMAIL; //             VARCHAR2(200),
  $param['DOB'] = $DOB; //               DATE,
  $param['PINCODE'] = $PINCODE; //           NUMBER(20),
  $param['ANNUALINCOME'] = $ANNUALINCOME; //      FLOAT(20),
  $param['OCCUPATION'] = $OCCUPATION; //        VARCHAR2(50),
  $param['PROPERTY_VALUE'] = $PROPERTY_VALUE; //    FLOAT(20),
  $param['OFFER'] = $OFFER; //             VARCHAR2(200), mandatory  "DEAL4LOANS" 

  $param['REMARKS'] = $REMARKS;//     VARCHAR2(200)

print_r($param);
echo "<br><br>";

	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

//http://125.21.181.73:83/IB_SalesTrak/SalesTrakLeads.asmx  
	//First prepare the info that relates to the connection
	$host = "125.21.181.73";
	$script = "/IB_SalesTrak/SalesTrakLeads.asmx";
	$request_length = strlen($request);
	$method = "POST"; // must be POST if sending multiple messages
	if ($method == "POST") 
	{
	  $script .= "?$request";
	}

	//Now comes the header which we are going to post. 
	$header = "$method $script HTTP/1.1\r\n";
	$header .= "Host: $host\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: $request_length\r\n";
	$header .= "Connection: close\r\n\r\n";
	$header .= "$request\r\n";

	//Now we open up the connection
	$socket = @fsockopen($host, 83, $errno, $errstr); 
	if ($socket) //if its open, then...
	{ 
	
	  fputs($socket, $header); // send the details over
	  while(!feof($socket))
	  {
		$output[] = fgets($socket); //get the results 
	  }
	  print_r($output);
	  fclose($socket); 
	}
//}

/*

//Web Service Name - IB_SalesTrak

//Class name- SalesTrakLeads

//Method Name- GenerateOutSourcedLeadForLoans

require_once ("lib/nusoap.php");

$ap_param = array('PARAMS'=> array( 'CUSTOMER_NAME' => $CUSTOMER_NAME, 'MOBILE_NO' => $MOBILE_NO, 'PRODUCT' => $PRODUCT, 'CITY' =>$CITY, 'LOAN_AMOUNT' =>$LOAN_AMOUNT, 'SOURCE' =>$SOURCE, 'EMAIL' =>$EMAIL, 'DOB' =>$DOB, 'PINCODE' =>$PINCODE, 'ANNUALINCOME' =>$ANNUALINCOME, 'OCCUPATION' =>$OCCUPATION, 'PROPERTY_VALUE' =>$PROPERTY_VALUE, 'OFFER' =>$OFFER, 'REMARKS' =>$REMARKS));

$soapClient = new soapclient("http://125.21.181.73:83/IB_SalesTrak/SalesTrakLeads.asmx", true);

$soapClient = new soapclient("http://125.21.181.73:83/IB_SalesTrak/SalesTrakLeads.asmx", true);
$info = $soapClient->call("GenerateOutSourcedLeadForLoans", array($ap_param), "http://125.21.181.73:83/IB_SalesTrak/SalesTrakLeads.asmx" );
	
	print_r($info);
*/
?>