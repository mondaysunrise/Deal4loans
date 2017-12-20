<?php

require_once ('force-phptoolkit/soapclient/SforceEnterpriseClient.php');
require_once ('force-phptoolkit/soapclient/SforceHeaderOptions.php');

 
try {
    //Login to salesforce
    $mySforceConnection = new SforceEnterpriseClient();
    $mySoapClient = $mySforceConnection->createConnection('wsdl.jsp.xml');
    $loginResponse = $mySforceConnection->login('wishfin@dmifinance.in', 'wf@dmi01');

    var_dump($loginResponse);

    //Create lead
    $sObject = new stdclass();
    $sObject->Aadhaar_Number__c = '683555524653';
    $sObject->Application_Id__c = 'IS12345';
    $sObject->Borrower_Photo_URL__c = 'www.google.com';
    $sObject->Business_Type__c = 'Consumer Loan';
    $sObject->City = 'Bangalore';
    $sObject->Country_Name__c = 'India';
    $sObject->Industry = 'Consumer';
    $sObject->LastName = 'Sharma';
    $sObject->LeadSource = 'a0dN000000B0Bwi';
    $sObject->Loan_Tenor_in_Month__c = 12;
    $sObject->Net_Salary_Monthly__c = 60000;
    $sObject->PAN__c = 'DWPPS6679B';
    $sObject->RecordType_List__c = 'Retial Borrower Account';
    $sObject->Sector__c = 'Salaried';
    $sObject->State = 'Karnataka';
    $sObject->Street = 'Basil Moneta, 80 Feet Main Rd';
    $sObject->User_Id__c = '1';
    $sObject->PostalCode = '560095';
    $createResponse = $mySforceConnection->create(array($sObject), 'Lead');

    var_dump($createResponse);
} catch (\Exception $e) {
    echo $mySforceConnection->getLastRequest();
    echo $mySforceConnection->getLastResponse();
}


?>

