<?php
ini_set('max_execution_time', 1000);
require 'scripts/db_init.php';

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}


if($IP=="122.176.122.134")
{
	print_r($_POST);

}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$requestID = $_POST["requestID"];
	$card_id = $_POST["card_id"];
	$getcitySql = " SELECT * FROM `credit_card_banks_eligibility` WHERE cc_bankid='".$card_id."' and `cc_bank_flag`=1";
	list($numRowscity,$getcityQuery)=MainselectfuncNew($getcitySql,$array = array());
	$card_name =ucwords(strtolower($getcityQuery[0]['cc_bank_name']));
	$first_name = $_POST["first_name"];
	$middle_name = $_POST["middle_name"];
	$last_name = $_POST["last_name"];
	$Gender = $_POST["Gender"];
	$panno = $_POST["panno"];
	$resiaddress1 = $_POST["resiaddress1"];
	$Residence_Address = substr(trim($resiaddress1),0,38);
	$Qualification = $_POST["Qualification"];
	$Designation = $_POST["Designation"];
	$STD = $_POST["STD"];
	$Phone_Number = $_POST["Phone_Number"];
	$pincode= $_POST["pincode"];
	$relation_with_bank = $_POST["relation_with_bank"];
	$full_name=$first_name."".$middle_name."".$last_name;

	if(strlen($middle_name)>0 && $middle_name!="Middle Name" && $last_name=="")
	{
		$last= $middle_name;
		$middle_name="";
	}
	else
	{
		$last= $last_name;
	}
	if($last=="")
	{
		$last="kumar";
	}

	$InsertProductSql= array("Name"=>$full_name, "Gender" => $Gender, "Pancard" => $panno, "Residence_Address" => $Residence_Address, "Std_Code_O"=>$Std_Code_O, "Landline_O"=>$Landline_O, "Pincode"=>$pincode, "applied_card_name"=>$card_name);
	$wherecondition ="(RequestID='".$requestID."')";
	Mainupdatefunc("Req_Credit_Card", $InsertProductSql, $wherecondition);

	$getdetails="select id From credit_card_banks_apply Where ( cc_requestid='".$requestID."') order by id DESC";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	$id=$myrow['id'];
	if($alreadyExist>0)
	{
		$duplicatepush=1;
		$DataArray = array("qualification" => $Qualification , "designation" => $Designation, "cc_requestid"=>$requestID,"relation_with_bank"=>$relation_with_bank);
		$wherecondition ="(id='".$id."')";
		Mainupdatefunc ('credit_card_banks_apply', $DataArray, $wherecondition);
		$ProductValue = $id;
	}
	else
	{
		$duplicatepush=0;
		$InsertProductSql= array("qualification" => $Qualification , "designation" => $Designation);
		$ProductValue = Maininsertfunc("credit_card_banks_apply", $InsertProductSql);
	}

	if($card_id==13) { $card_type=13;} elseif($card_id==19){ $card_type=9;} elseif($card_id==21){ $card_type=10;} elseif($card_id==67){ $card_type=7;}else{ $card_type=7;}
	
	//Update applied_cardname in credit_card_banks_apply table
	$cardnameArray = array("applied_cardname" =>$card_type);
	$cardnamecondition ="(id='".$ProductValue."')";
	Mainupdatefunc ('credit_card_banks_apply', $cardnameArray, $cardnamecondition);

	$slct="select Email,DOB,Company_Name,Net_Salary,Mobile_Number,Employment_Status,City from Req_Credit_Card Where (RequestID='".$requestID."')";
	list($Getnum,$row)=Mainselectfunc($slct,$array = array());
	$pagesource = $row["source"];
	$DOB = $row["DOB"];
	list($year,$month,$day) = explode("-",$DOB);
	$dobstr= $day."-".$month."-".$year;
	$CompanyName = $row["Company_Name"];
	$Email = $row["Email"];
	$CompanyName = substr(trim($CompanyName),0,99);
	$Net_Salary = $row["Net_Salary"];
	$AnnIncome = intval($Net_Salary);
	$monthlyincome = round($AnnIncome/12);

	$Mobile_Number = $row["Mobile_Number"];
	$Employment_Status = $row["Employment_Status"];
	$City = $row["City"];
	
	$citycode=GetCityCode($City);
	if($Employment_Status==0)
	{
		$EmpType=2;
	}
	else
	{
		$EmpType=1;
	}
	
	if($row_result["No_of_Banks"]=="Standard Chartered")
	{
		$HasExistingScbCC="Y";
	}
	else
	{
		$HasExistingScbCC="N";
	}
	
	if($relation_with_bank>0) { $IsExtngScbCust="Y"; } else { $IsExtngScbCust="N"; }

	if(strlen($first_name)>1 && strlen($CompanyName)>2 && $Mobile_Number>0 && strlen($Email)>2 && $AnnIncome>0)
	{
		$ConUniqRefCode="scbcards".$requestID;

		$auth = array("Authentication"=>array("UserId"=>"cc_connector_4", "Password"=>"d4l@pd!!osJ20C5*)1"));
		$cust_details = array("CreditCard"=>array("Version"=>3, "ConUniqRefCode"=>$ConUniqRefCode, "CreditCardApplied"=>$card_type, "HasExistingScbCC"=>$HasExistingScbCC, "IsExtngScbCust"=>$IsExtngScbCust, "CustReltnType"=>$relation_with_bank, "FirstName"=>$first_name, "MiddleName"=>$middle_name, "LastName"=>$last, "Gender"=>$Gender, "DOB"=>$dobstr, "Qualification"=>$Qualification, "ResAddress1"=>$Residence_Address, "ResAddress2"=>$City, "ResCity"=>$citycode, "ResPIN"=>$pincode, "Email"=>$Email, "Mobile"=>$Mobile_Number, "EmpType"=>$EmpType, "SalaryBankAcc"=>340, "AnnIncome"=>$AnnIncome, "GMI"=>$monthlyincome, "CompanyName"=>$CompanyName, "Designation"=>40, "IncomeProof"=>1,"IncomeProofValue"=>$AnnIncome, "PAN"=>$panno));
		$request_data = implode(",",$cust_details["CreditCard"]);
		$request_arr = array("RPRequest"=>array_merge($auth, $cust_details));
		$ws_ur = 'https://apply.standardchartered.co.in/connector/RPCreditCardConnector.wsdl?wsdl';

		$client = new SoapClient($ws_ur);
		$result = $client->__soapCall('creditCard', $request_arr);
		$Status = $result->Status;
		$ReferenceCode = $result->ReferenceCode;
		$Errorcode = $result->Errorcode;
		$Errorinfo = $result->Errorinfo;
		$RequestIP = $result->RequestIP;
		$response_data = "Status -".$Status.", ReferenceCode -".$ReferenceCode.", Errorcode -".$Errorcode.",Errorinfo -".$Errorinfo.",RequestIP -".$RequestIP;
		$DataArray = array("request_data" =>$request_data, "response_data" =>$response_data, "cc_requestid"=>$requestID, "applied_bankname"=>"Standard Chartered");
		$wherecondition ="(id='".$ProductValue."')";
		Mainupdatefunc ('credit_card_banks_apply', $DataArray, $wherecondition);
	}
}
?>
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
<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> Standard Chartered Credit Card</span></div>
<div style="clear:both; height:10px;"></div>
<div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px; padding-top:10px; font-size:18px; color:#000; height:400px;">

<?php
if(strlen($first_name)>1 && strlen($CompanyName)>2 && $Mobile_Number>0 && strlen($Email)>2 && $AnnIncome>0)
{
?>
	Thank you for applying  for <? echo $card_name; ?>  through deal4loans, we will get back to you soon.
<? 
	if($Status>0 || strlen($Errorinfo)>2)
	{
		echo "Status : ";
		$Status = $result->Status;
		if($Status==0)
		{
			echo "FAILURE/ERROR";
		}
		elseif($Status==1)
		{
			echo "AIP APPROVED";
		}
		elseif($Status==2)
		{
			echo "AIP REFER";
		}
		elseif($Status==3)
		{
			echo "AIP REJECT";
		}
		echo "<br>";
		$ReferenceCode = $result->ReferenceCode;
		$Errorcode = $result->Errorcode;
		echo "Error Info: ".$Errorinfo = $result->Errorinfo;
		echo "<br>";
	}
}
else
{
	echo "Missing Fields - Name - ".$first_name." or Company Name - ".$CompanyName." or Mobile Number - ". $Mobile_Number." or Email - ".$Email." or Annual Income - ".$AnnIncome;
}
?>
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
<?php
function GetCityCode($pKey){
    $titles = array(
	'Gurgaon' => '7',
	'Chandigarh' => '9',
	'Hyderabad' => '15',
	'Bangalore' => '19',
	'Chennai' => '21',
	'Ahmedabad ' => '22',
	'Mumbai' => '25',
	'Pune' => '26',
	'Kolkata' => '64',
	'CALCUTTA' => '64',
	'Coimbatore' => '69',
	'Noida' => '78',
	'Secunderabad' => '94',
	'Jaipur' => '100',
	'Indore' => '106',
	'Nagpur' => '135',
	'Navi Mumbai' => '163',
	'Surat' => '190',
	'Cochin' => '241',
	'Delhi' => '318',
	'New Delhi' => '318',
	'Bhopal' => '623',
	'Thane' => '640',
	'Greater Noida' => '704',
	'Baroda' => '707',
	'Rajkot' => '1035',
    	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }
?>
	
