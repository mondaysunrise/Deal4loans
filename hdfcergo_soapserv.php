<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require_once ("lib/nusoap.php");

$soapClient = new soapclient("http://203.199.22.139/ExternalWebSiteCaptureLeads/Service.asmx?WSDL", true);
   
       
	    $sh_param = array(
                    'USER_NAME'    =>    'HdfcErgo',
                    'PASSWORD'    =>    'Hdfc1234');

print_r($sh_param);
        $headers = new SoapHeader('http://203.199.22.139/ExternalWebSiteCaptureLeads/Service.asmx', 'UserCredentials', $sh_param);
print_r($headers);

		 $soapClient->__setSoapHeaders(array($headers)); 
    
			$ap_param=array(
				'Product_Name'=>"Health",
				'Customer_Name'=>"testlead",
				'City'=>"Delhi",
			'Telephone_No'=>"22374185",
			'Mobile_No'=>"9876543210",
			'Additional_Info'=>"Bimadeals",
			'Vendor_ID'=>"DL0001",
			'User_Name'=>"Deal4Loans",
			'Password'=>"Deal4Loans"		
			);
			

               				
        // Call RemoteFunction ()
             
           $info = $soapClient->call("CaptureLeadsFromExternalWebSites", array($ap_param), "http://203.199.22.139/ExternalWebSiteCaptureLeads/Service.asmx");
			   
			print_r($info);

		echo $sendResponse = $info['CaptureLeadsFromExternalWebSitesResult'];

		?>