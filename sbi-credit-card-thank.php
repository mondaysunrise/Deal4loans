<?php
ini_set('max_execution_time', 1000);
require 'scripts/db_init.php';

function GetStatecCode($pKey){
    $titles = array(
	'Andhra Pradesh' => 'APR',
	'Arunachal Pradesh' => 'AR',
	'Assam' => 'AS',
	'Bihar' => 'BIH',
	'Chhattisgarh' => 'CT',
	'Chandigarh' => 'CHD',
	'Delhi' => 'DEL',
	'Goa' => 'GA',
	'Gujarat' => 'GUJ',
	'Haryana' => 'HAR',
	'Himachal Pradesh' => 'HP',
	'Jammu and Kashmir' => 'JK',
	'Jharkhand' => 'JH',
	'Karnataka' => 'KTK',
	'Kerala' => 'KER',
	'Madhya Pradesh' => 'MAD',
	'Maharashtra' => 'MAH',
	'Manipur' => 'MN',
	'Meghalaya' => 'ML',
	'Mizoram' => 'MZ',
	'Nagaland' => 'NL',
	'Odisha' => 'ORI',
	'Punjab' => 'PUN',
	'Rajasthan' => 'RAJ',
	'Sikkim' => 'SK',
	'Tamil Nadu' => 'TMN',
	'Telangana' => 'TG',
	'Tripura' => 'TR',
	'Uttar Pradesh' => 'UP',
	'Uttarakhand' => 'UT',
	'West Bengal' => 'WBG'
	  );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function GetSourceCode($pKey){
    $titles = array(
	 'Ahmedabad' => 'AI01',
	'Baroda' => 'AE01',
	'Coimbatore' => 'AQ01',
	'Indore' => 'AU01',
	'Jaipur' => 'AG01',
	'Lucknow' => 'AL01',
	'Nagpur' => 'AS11',
	'Pune' => 'AN21',
	'Surat' => 'AS12',
	'Bangalore' => 'BANEAP',
	'Chennai' => 'CHENEAP',
	'Faridabad' => 'DELHIEAP',
	'Gaziabad' => 'DELHIEAP',
	'Gurgaon' => 'DELHIEAP',
	'Hyderabad' => 'HYDEAP',
	'Kolkata' => 'KOLEAP',
	'Mumbai' => 'MUMTEMP',
	'Delhi' => 'DELHIEAP',
	'Noida' => 'DELHIEAP',
	'Chandigarh' => 'AJ01',
	'Ludhiana' => 'AO01',
	'Jalandhar' => 'AM01',
	'Aurangabad' => 'BJ01',
	'Tirupur' => 'AQ01'
		);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function GetCityStatecCode($pKey){
    $titles = array(
	'AHMEDABAD' => 'GUJ',
	'AURANGABAD' => 'MAH',
	'BANGALORE' => 'KTK',
	'BARODA' => 'GUJ',
	'BHOPAL' => 'MAD',
	'BHUBANESHWAR' => 'ORI',
	'CALCUTTA' => 'WGB',
	'CHANDIGARH' => 'CHD',
	'CHENNAI' => 'TMN',
	'COIMBATORE' => 'KTK',
	'FARIDABAD' => 'HAR',
	'GHAZIABAD' => 'UP',
	'GURGAON' => 'HAR',
	'HYDERABAD' => 'APR',
	'INDORE' => 'MAD',
	'JAIPUR' => 'RAJ',
	'JALANDHAR' => 'PUN',
	'JAMNAGAR' => 'MAD',
	'LUCKNOW' => 'UP',
	'LUDHIANA' => 'PUN',
	'MUMBAI' => 'MAH',
	'NAGPUR' => 'MAH',
	'NASIK' => 'MAD',
	'NEW DELHI' => 'DEL',
	'NOIDA' => 'UP',
	'PATNA' => 'BIH',
	'PUNE' => 'MAH',
	'RAJKOT' => 'MAD',
	'SURAT' => 'GUJ',
	'TIRUPUR' => 'TMN',
	'TRIVANDRUM' => 'KER'
);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$requestID = $_POST["requestID"];
	$CompanyName = $_POST["Company_Name"];
	$OfficeAddress1 = $_POST["OfficeAddress1"];
	$OfficeAddress2 = $_POST["OfficeAddress2"];
	$OfficeAddress3 = $_POST["OfficeAddress3"];
	$OfficePin = $_POST["OfficePin"];
	$Land_linenumber = $_POST["Land_linenumber"];
	$OfficeCity = $_POST["OfficeCity"];
	$Phone_Number = $_POST["Phone_Number"];	
	$OfficeState = GetCityStatecCode($OfficeCity);
	$Qualification = $_POST["Qualification"];
	$Designation = $_POST["Designation"];	
	$card_name = $_POST["card_name"];
	$STD = "0".$_POST["STD"];
	$first_name = $_POST["first_name"];
	$middle_name = $_POST["middle_name"];
	$last_name = $_POST["last_name"];
if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
	{
		$last= $middle_name;
		$middle_name="";
	}
	else
	{
		$last= "Kumar";
	}
	
if($middle_name=="Middle Name")
	{
		$middle_name="";
	}
	$day = $_POST["day"];
	if(strlen($day)==1)
	{
		$dd="0".$day;
	}
	else
	{
		$dd=$day;
	}
	$month = $_POST["month"];
	if(strlen($month)==1)
	{
		$mm="0".$month;
	}
	else
	{
		$mm=$month;
	}
	$year = $_POST["year"];
	
	$DOB = $year."-".$mm."-".$dd;

	$card_id = $_POST["card_id"];
	$Dated=ExactServerdate();

 $InsertProductSql= array("RequestID" => $requestID, "CompanyName" => $CompanyName, "OfficeAddress1" => $OfficeAddress1 , "OfficeAddress2" => $OfficeAddress2 , "OfficeAddress3" => $OfficeAddress3, "OfficePin" => $OfficePin, "TypeOfLandline" => $Land_linenumber, "OfficeCity" => $OfficeCity, "LandlineNo" => $Phone_Number, "OfficeState"=> $OfficeState, "Qualification"=> $Qualification, "CardName" => $card_name, "Designation" => $Designation, "Dated" =>$Dated);
$ProductValue = Maininsertfunc("sbi_credit_card_5633", $InsertProductSql);
}

$slct="select * from Req_Credit_Card Where (RequestID='".$requestID."')";
list($Getnum,$row)=Mainselectfunc($slct,$array = array());

$Gender = $row["Gender"];
if($Gender=="Male")
{
	$strgender="M";
}
elseif($Gender=="Female")
{
	$strgender="F";
}
else
{
	$strgender="M";
}
$Mobile = $row["Mobile_Number"];
$Email = $row["Email"];
$City = $row["City"];
$City_Other = $row["City_Other"];
if($City=="Others" && Strlen($City_Other)>0)
{
	$strcity=$City_Other;
}
else
{
	$strcity=$City;
}
$State = $row["State"];
$Pancard = $row["Pancard"];
$CompanyName = substr(trim($CompanyName),0,30);
$ResiAddress3 = str_replace("@", "", $Email);
$Pincode = $row["Pincode"];
$Employment_Status = $row["Employment_Status"];
if($Employment_Status==1)
{
	$OccupationType = "S";
}
else
{
	$OccupationType = "E";
}
//$ResiPhone = $Phone_Number;//mandatory


$Residence_Address = $row["Residence_Address"];
list($resiaddress1,$resiaddress2,$resiaddress3) = split('[|]',$Residence_Address);
if($Land_linenumber=="Residence")
	{
		$resistd = $STD;
		$offslct="select std from sbi_cc_city_state_list Where (city='".strtoupper($OfficeCity)."') group by city Limit 0,1";
		list($Getnumoff,$offrow)=Mainselectfunc($offslct,$array = array());
		$offstd = "0".$offrow["std"];
		$ResiPhone = $Phone_Number;//mandatory
	}
	else
	{
		
		$offstd = $STD;
		if($strcity=="Kolkata")
		{
			$resislct="select std from sbi_cc_city_state_list Where (city like'%CALCUTTA%') group by city Limit 0,1";
		}
		else
		{
		$resislct="select std from sbi_cc_city_state_list Where (city like'%".strtoupper($strcity)."%') group by city Limit 0,1";
		}
		list($Getnumresi,$resirow)=Mainselectfunc($resislct,$array = array());
		$resistd = "0".$resirow["std"];
		$OfficePhone = $Phone_Number;//mandatory
	}

if($card_id==52) { $card_type="SSU2"; $PromoCode="SCEA";} elseif($card_id==53){ $card_type="VPTL"; $PromoCode="SCEA";} elseif($card_id==54){ $card_type="SMCW"; $PromoCode="SCEA";} elseif($card_id==59){ $card_type="SCU2"; $PromoCode="SCEA";} elseif($card_id==60){ $card_type="AIPU"; $PromoCode="SCEA"; } elseif($card_id==61){ $card_type="AISU"; $PromoCode="SCEA";} elseif($card_id==62){ $card_type="SCU2";  $PromoCode="SCEA";} elseif($card_id==64){ $card_type="IRCP";  $PromoCode="IREA";} elseif($card_id==65){ $card_type="MMSU";  $PromoCode="SCEA";} elseif($card_id==66){ $card_type="SYT1"; $PromoCode="YAEA"; }
echo $strcity;
echo $SourceCode = GetSourceCode($strcity);
$CardType = $card_type;
$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$DateSpareField=date('m/d/Y',$yesterday);
list($year,$month,$day) = split('[-]',$DOB);
$strdob = $day."/".$month."/".$year;
$FirstName = substr($first_name,0,12);//mandatory 
$MiddleName = substr($middle_name,0,10);//mandatory
$LastName = substr($last_name,0,16);//mandatory
$Mobile = $Mobile;//mandatory
$Qualification = $Qualification;
$PAN = $Pancard;//mandatory
$ResiAddress1 = trim($resiaddress1);//mandatory
$ResiAddress2 = trim($resiaddress2);//mandatory
$ResiAddress3 = trim($resiaddress3);//mandatory
$EmailAddress = $Email;//mandatory
$ResiCity = $strcity;//mandatory
$ResiState = GetStatecCode($State);//mandatory
$ResiPin = $Pincode;//mandatory
$OccupationType = $OccupationType;//mandatory
$CompanyName = $CompanyName;
$OfficeAddress1 =$OfficeAddress1;//mandatory
$OfficeAddress2 =$OfficeAddress2;//mandatory
$EmployeePFNumber="";
$BranchManagerPFNumber="";

 $xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:qde="http://qde.service.los" xmlns:xsd="http://to.service.los/xsd">
   <soapenv:Header/>
   <soapenv:Body>
      <qde:invoke>         
         <qde:losRequest>           
            <xsd:data>
<![CDATA[
<ApplicationIngestionRequest>
<LeadRefNo></LeadRefNo>
<BranchCode></BranchCode>
<SourceCode>'.$SourceCode.'</SourceCode>
<SECode>DEAl4LOANS</SECode>
<PromoCode>'.$PromoCode.'</PromoCode>
<CardType>'.$CardType.'</CardType>
<PromoGroup>EA</PromoGroup>
<ChannelCode>EAPL</ChannelCode>
<Salutation>1</Salutation>
<FirstName>'.strtoupper($FirstName).'</FirstName>
<MiddleName>'.strtoupper($MiddleName).'</MiddleName>
<LastName>'.strtoupper($LastName).'</LastName>
<DOB>'.$strdob.'</DOB>
<Mobile>'.$Mobile.'</Mobile>
<Gender>'.$strgender.'</Gender>
<Qualification>'.strtoupper($Qualification).'</Qualification>
<PAN>'.$PAN.'</PAN>
<EmailAddress>'.trim($EmailAddress).'</EmailAddress>
<ResiAddress1>'.strtoupper($ResiAddress1).'</ResiAddress1>
<ResiAddress2>'.strtoupper($ResiAddress2).'</ResiAddress2>
<ResiAddress3></ResiAddress3>
<ResiCity>'.$ResiCity.'</ResiCity>
<ResiState>'.$ResiState.'</ResiState>
<ResiPin>'.$ResiPin.'</ResiPin>
<ResiPhone>'.$ResiPhone.'</ResiPhone>
<ResiStdCode>'.$resistd.'</ResiStdCode>
<OccupationType>'.$OccupationType.'</OccupationType>
<AlternateCardNo></AlternateCardNo>
<Designation>'.$Designation.'</Designation>
<CompanyName>'.trim($CompanyName).'</CompanyName>
<NatureOfBusiness>A</NatureOfBusiness>
<OfficeAddress1>'.strtoupper($OfficeAddress1).'</OfficeAddress1>
<OfficeAddress2>'.strtoupper($OfficeAddress2).'</OfficeAddress2>
<OfficeAddress3></OfficeAddress3>
<OfficePhone>'.$OfficePhone.'</OfficePhone>
<OfficeStdCode>'.$offstd.'</OfficeStdCode>
<OfficeState>'.$OfficeState.'</OfficeState>
<OfficeCity>'.$OfficeCity.'</OfficeCity>
<YearsOfCurrentEmployment>2</YearsOfCurrentEmployment>
<OfficePin>'.$OfficePin.'</OfficePin>
<TextSpareField1>'.$RequestID.'</TextSpareField1>
<TextSpareField2>1</TextSpareField2>
<TextSpareField3>1</TextSpareField3>
<TextSpareField4>1</TextSpareField4>
<TextSpareField5>1</TextSpareField5>
<NumericSpareField1>1</NumericSpareField1>
<NumericSpareField2>1</NumericSpareField2>
<NumericSpareField3>1</NumericSpareField3>
<NumericSpareField4>1</NumericSpareField4>
<NumericSpareField5>1</NumericSpareField5>
<DateSpareField1>'.$DateSpareField.'</DateSpareField1>
<DateSpareField2>'.$DateSpareField.'</DateSpareField2>
<DateSpareField3>'.$DateSpareField.'</DateSpareField3>
<DateSpareField4>'.$DateSpareField.'</DateSpareField4>
<DateSpareField5>'.$DateSpareField.'</DateSpareField5>
<EmployeePFNumber></EmployeePFNumber>
<BranchManagerPFNumber></BranchManagerPFNumber>
<PriorityFlag>1</PriorityFlag>
<DateOfPickup></DateOfPickup>
<TimeOfPickup></TimeOfPickup>
<StatementPreference>E</StatementPreference>
<LoyaltyChannel></LoyaltyChannel>
<LoyaltyNumber></LoyaltyNumber>
<ActualFulfillmentDeviation>N</ActualFulfillmentDeviation>
<PhysicalAlreadyReceived>N</PhysicalAlreadyReceived>
<FathersName></FathersName>
<MothersMaidenName></MothersMaidenName>
<ResiLandmark></ResiLandmark>
<OfficeLandmark></OfficeLandmark>
</ApplicationIngestionRequest>
]]>
</xsd:data>
           <xsd:requestid></xsd:requestid>            
            <xsd:userCtx>               
               <xsd:password>de@l4loan5</xsd:password>              
               <xsd:userId>79584822</xsd:userId>
            </xsd:userCtx>
         </qde:losRequest>
      </qde:invoke>
   </soapenv:Body>
</soapenv:Envelope>'; 
		//echo $xmlstr."<br>";
		//echo "<br><br>";
		//$username=555555555;UAT
		//$password="Los@555";UAT
		$username=79584822;
		$password="de@l4loan5";
	//$url = 'http://servicetest.gecapital1.glb.gemoney.in/DevWebService/LOSWebApp/services/ApplicationIngestionService?wsdl';
	$url ='https://napsservices.originations.gecapital.in/LOSWebApp/services/ApplicationIngestionService?wsdl';
		$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$xmlstr");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch); 

//echo $output;
//print_r($output);
$xml_string =  str_replace("<?xml version='1.0' encoding='UTF-8'?>", '<?xml version="1.0" encoding="UTF-8"?>', $output);
$xml_string =  str_replace("&lt;", "<", $xml_string);
$xml_string = str_ireplace('<?xml version="1.0" encoding="UTF-8"?><soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"><soapenv:Body><qde:invokeResponse xmlns:qde="http://qde.service.los"><qde:return><ns1:data xmlns:ns1="http://to.service.los/xsd">',"", $xml_string );
//$xml_string = str_ireplace('</ns1:data>',"", $xml_string );
$xml_string = str_ireplace('</qde:return></qde:invokeResponse></soapenv:Body></soapenv:Envelope>',"", $xml_string );
list($firstxml, $secondxml)= split ("</ns1:data>", $xml_string);
$xml = simplexml_load_string($firstxml);
$LeadRefNumber = $xml->LeadRefNumber;
$ApplicationNumber = $xml->ApplicationNumber;
$StatusCode = $xml->StatusCode;
$ProcessingStatus = $xml->ProcessingStatus;
$CreditLimit = $xml->CreditLimit;
$Message = $xml->Messages->Message;
$code = $xml->code;
$message = $xml->message;

 $DataArray = array("request_xml" =>$xmlstr, "response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message);
	$wherecondition ="(sbiccid='".$ProductValue."')";
	//print_r($DataArray);
	Mainupdatefunc ('sbi_credit_card_5633', $DataArray, $wherecondition);

$insertDataArray = array("cc_requestid"=>$requestID, "request_xml" =>$xmlstr, "response_xml" =>$output, "LeadRefNumber" =>$LeadRefNumber, "ApplicationNumber" =>$ApplicationNumber, "StatusCode" =>$StatusCode, "ProcessingStatus" =>$ProcessingStatus, "CreditLimit" =>$CreditLimit, "Messages" =>$Message, "code"=>$code, "message"=>$message, "sbiccid"=>$ProductValue, "first_other"=>$secondxml, "first_dated"=>$Dated );
	//print_r($DataArray);
	$ProductValuelog = Maininsertfunc("sbi_credit_card_5633_log", $insertDataArray);
	$ProductValuedirect = Maininsertfunc("sbi_credit_card_5633_log_direct", $insertDataArray);
	?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instant E Apply Credit Cards Online in India</title>
<meta name="keywords" content="online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application" />
<meta name="description" content="Fill Application form for credit cards. Instant Apply & get Approval for Credit cards such as HDFC, ICICI, Citibank, Standard Chartered, SBI and American express Online in India." />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/credit-card-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> SBI Credit Card</span></div>
<div style="clear:both; height:10px;"></div>
<div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px; padding-top:10px; font-size:18px; color:#000; height:400px;">
<? if($ProcessingStatus==1 || $ProcessingStatus==2)
{ ?>
Thank you for applying  for <? echo $card_name; ?> through deal4loans. Your application reference no.<? echo $ApplicationNumber; ?> for <? echo $card_name; ?> Credit Card has been approved in principle with a credit limit of <? echo $CreditLimit; ?> basis the information provided by you. The final credit limit assigned would be subject to submission of requisite documents & their verification. SBI Card representative will contact you shortly.<br><br>
SBI Cards reserves the right to change the approved card type or credit limit at its sole discretion.
 <? }
else if($ProcessingStatus==4 || $ProcessingStatus==5 || $ProcessingStatus==6)
{ ?>
Thank you for applying  for <? echo $card_name; ?>  through deal4loans. Your application for SBI Card is under process. We will contact you shortly
 <?
}
else if($ProcessingStatus==3)
{ ?>
Thank you for applying  for <? echo $card_name; ?>  through deal4loans. Your application for <? echo $card_name; ?> Card has been approved in principle subject to submission of requisite documents & their verification. SBI Card representative will contact you shortly.<br><br>   
SBI Cards reserves the right to change the approved card type or credit limit at its sole discretion.
 <?
}
else if($ProcessingStatus==7)
{ ?>
Thank you for applying  for <? echo $card_name; ?>  through deal4loans. We are unable to process your request further as the details furnished do not meet the policies set forth for issuance of the <? echo $card_name; ?> Card .
 <?
}
else
{ ?>
Thank you for applying  for <? echo $card_name; ?>  through deal4loans, we will get back to you soon.
<? } ?>
</div>
</div>
</div>
<div style="clear:both; height:100px;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
</body>
</html>
	