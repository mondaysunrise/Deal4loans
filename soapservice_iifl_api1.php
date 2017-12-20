<?php


$json='{  
   "head": {
    "requestCode": "PLRQCL01",
    "key": "35c20976a9c152515310ef7209dfcc22",
    "appVer": "1.0",
    "osName": "WebAPI",
    "appName": "ALLIANCE",
    "source":"Deal4Loans"
  },
 "body": {"ApplicantType":"Applicant","CompanyName":"RELIANCE INDS LTD","OtherCompanyName":"","Domain":"Automobiles","MonthlySalary":"40000","MonthlyObligation":"8000","PersonalEmailID":"Madan.Gonda@relianceada.com","MobileNo":"9821080348","AlternateMobileNo":"","City":"Mumbai","AadhaarNumber":"866166203234","FName":"Madan","MName":"","LName":"Gonda","Gender":"M","PAN":"AHRPA1434B","CurrentWorkExp":"26","TotalWorkExp":"30","DOB":"20051987","PermanentAddress1":"H-990,","PermanentAddress2":"Poddar Apartment, S.V.Road","PermanentAddress3":"Mahim","PermanentState":"MH","PermanentCity":"BOM","PermanentPin":"400067","CurrentAddress1":"14-B,","CurrentAddress2":"Poddar Apartment, S.V.Road","CurrentAddress3":"Kandivali","CurrentState":"MH","CurrentCity":"BOM","CurrentPin":"400067","AppliedLoanamount":"500000","ROI":"18","Tenure":"25","Processingfee":"2500","Emi":"24500","TotalPayableAmount":"65000","CoapplicantFlag":"1","Source":"Deal4Loans","Residencetype":"1","ResidenceStability":"60","Education":"PGRAD", "MaritalStatus":"N","PurposeofLoan":"LH21","OfficeEmailID":"susanta.nag@gmail.com","CompanyAddress1":"Santacruz East","CompanyAddress2":"Road No - 4,Behind SAI mandir","CompanyAddress3":"400021","CompanyState":"MH","CompanyCity":"BOM","CompanyPin":"400021","EKYCFlag":"0"
  }
}
';
$url ="http://ttavatar.iifl.in/PLApi_Alliance/PLApi_Alliance.svc/ApplyLoan";// UAT
// cURL's initialization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_FAILONERROR, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
$result = curl_exec($ch);


echo "For Referred prod: ".$result."<br>";
?>