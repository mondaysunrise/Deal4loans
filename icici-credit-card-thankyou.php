<?php
ini_set('max_execution_time', 1000);
require 'scripts/db_init.php';
//print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$requestID = $_POST["requestID"];
	$card_name = $_POST["card_name"];
	$card_id = $_POST["card_id"];
	$first_name = $_POST["first_name"];
	$middle_name = $_POST["middle_name"];
	$last_name = $_POST["last_name"];
	$Gender = $_POST["Gender"];
	$panno = $_POST["panno"];
	$resiaddress1 = $_POST["resiaddress1"];
	$strresiadd = round((strlen($resiaddress1)/2));
	$resiadd = str_split($resiaddress1, $strresiadd);
	$ResidenceAddress1 = substr(trim($resiadd[0]),0,40);
	$ResidenceAddress2 = substr(trim($resiadd[1]),0,40);
	$resiCity = $_POST["City"];
	$resistate=GetStateName($resiCity);
	$Stdcode = GetStdCode($resiCity);
	$pincode = $_POST["pincode"];
	$companyname = $_POST["companyname"];
	$relation_with_bank = $_POST["ICICIBankRelationship"];
	$total_exp = $_POST["total_exp"];
	$billing_preference = $_POST["SalaryAccountOpened"];
	$pincode= $_POST["pincode"];
	$full_name=$first_name."".$middle_name."".$last_name;
	$page_name = $_POST['page_name'];
	if($page_name=="LMS")
	{
		$page_name="LMS";
	}
	else
	{
		$page_name="Direct";
	}

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
		$last=$first_name;
	}
		$InsertProductSql= array("Name"=>$full_name, "Gender" => $Gender, "Pancard" => $panno, "Residence_Address" => $resiaddress1, "Pincode"=>$pincode, "Total_Experience"=>$total_exp);
		$wherecondition ="(RequestID='".$requestID."')";
		Mainupdatefunc("Req_Credit_Card", $InsertProductSql, $wherecondition);

		$getdetails="select id From credit_card_banks_apply Where ( cc_requestid='".$requestID."') order by id DESC";
		list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
		$id=$myrow['id'];
		if($alreadyExist>0)
		{
		$duplicatepush=1;
		$DataArray = array("cc_requestid"=>$requestID,"relation_with_bank"=>$relation_with_bank, "lead_source" =>$page_name, "applied_bankname"=> "ICICI Bank", "billing_preference"=> $billing_preference);
			$wherecondition ="(id='".$id."')";
		//print_r($DataArray);
		Mainupdatefunc ('credit_card_banks_apply', $DataArray, $wherecondition);
		}
		else
		{
			$duplicatepush=0;
			$InsertProductSql= array("relation_with_bank"=>$relation_with_bank, "lead_source" =>$page_name, "applied_bankname"=> "ICICI Bank", "billing_preference"=> $billing_preference);
			$ProductValue = Maininsertfunc("credit_card_banks_apply", $InsertProductSql);
		}
		$slct="select Email,DOB,Company_Name,Net_Salary,Mobile_Number,Employment_Status,City from Req_Credit_Card Where (RequestID='".$requestID."')";
		list($Getnum,$row)=Mainselectfunc($slct,$array = array());
		$pagesource = $row["source"];
		$DOB = $row["DOB"];
		list($year,$month,$day) = explode("-",$DOB);
		$dobstr= $day."/".$month."/".$year;
		$CompanyName = $row["Company_Name"];
		$Email = $row["Email"];
		//$CompanyName = substr(trim($CompanyName),0,99);
		$Net_Salary = $row["Net_Salary"];
//		list($AnnIncome,$extrapt) = explode(".",$Net_Salary);
		$AnnIncome = intval($Net_Salary);
		$monthlyincome = round($AnnIncome/12);
		$Mobile_Number = $row["Mobile_Number"];
		$Employment_Status = $row["Employment_Status"];
		$City = $row["City"];
		
		if($Employment_Status==0)
		{
			$EmpType="Selfemployed";
		}else {$EmpType="Salaried";}
		

	if($relation_with_bank=="Norelationship")
	{
		$SalaryAccountWithOtherBank="Yes";
	}
	else
	{
		$SalaryAccountWithOtherBank="No";
	}

	if($relation_with_bank=="Salary" || $relation_with_bank=="Saving")
	{
		$ICICIRelationshipNumber="ICICI".$requestID;
	}
	else
	{
		$ICICIRelationshipNumber="";
	}

	$jsonurl='{"UserID": "ehj8bmnI+ML6/loUxYHxOQy/bYqCe5depANl4020mVq03TlUM3jt+hsCiQsEF+lPz33zds1tfUXAsqcgHPHT2SAHzZDVdVu/5A9IIYyV30JwRNZRfZM/i7rver3vbMpfM30O7gc577eQZqJvYjg0AfXm959kfUii760L2LAzF6g=",   "Password": "D/3TLsXOYPQyYc6ynjW8hPYycLy/3ucicv4y55s8xRnVOvG3079trwMHKEa5CS1sb6qikGzpV/1Tj/Knr4V5cwrLMkc7iaJ7utKNKg9fgG4d8On8mtlrK34YLbncwNc3ix6AsjOB6bb5oGUn1iYGeBVWXwQd+SLLWJmL0eMz18s=",
	"ChannelType":"Deal4loans", 
	"ApplicantFirstName":"'.$first_name.'", 
	"ApplicantMiddleName":"'.$middle_name.'", 
	"ApplicantLastName":"'.$last_name.'", 
	"Gender":"'.$Gender.'", 
	"DateOfBirth":"'.$dobstr.'",
	"ResidenceAddress1":"'.$ResidenceAddress1.'", 
	"ResidenceAddress2":"'.$ResidenceAddress2.'", 
	"ResidenceAddress3":"", 
	"City":"'.$resiCity.'", 
	"ResidencePincode":"'.$pincode.'", 
	"ResidenceState":"'.$resistate.'", 
	"STDCode":"'.$Stdcode.'" ,
	"ResidencePhoneNumber":"", 
	"ResidenceMobileNo":"'.$Mobile_Number.'", 
	"PanNo":"'.$panno.'", 
	"ICICIBankRelationship":"'.$relation_with_bank.'", 
	"ICICIRelationshipNumber":"'.$ICICIRelationshipNumber.'", 
	"CustomerProfile":"'.$EmpType.'", 
	"CompanyName":"'.$companyname.'", 
	"SalaryAccountWithOtherBank":"'.$SalaryAccountWithOtherBank.'", 
	"Total_Exp":"'.$total_exp.'", 
	"Income":"'.$monthlyincome.'", 
	"SalaryAccountOpened":"'.$billing_preference.'"}';

	//echo $jsonurl."<br><br>";
	$url ="https://www.dc.transuniondecisioncentre.co.in/DC/TU.DC.GenericAPI/API/ICICICCEAS/NewApplication/";// Prod
	// cURL's initialization
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonurl);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
	$response_data = curl_exec($ch);
	//print_R($result);
	//echo "<br><br>";
	//$response_data=$result;
	$DataArray = array("request_data" =>$jsonurl, "response_data" =>$response_data, "cc_requestid"=>$requestID);
	$wherecondition ="(id='".$ProductValue."')";
	//print_r($DataArray);
	Mainupdatefunc ('credit_card_banks_apply', $DataArray, $wherecondition);
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
<div class="common-bread-crumb" style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span style="color:#4c4c4c;">> ICICI Bank Credit Card</span></div>
<div style="clear:both; height:10px;"></div>
<div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px; padding-top:10px; font-size:18px; color:#000; height:400px;">
Thank you for applying  for <? echo $card_name; ?>  through deal4loans, we will get back to you soon.
</div>
</div>
</div>
<div style="clear:both; height:100px;"></div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>
<?php
function GetStateName($pKey){
    $titles = array(
	'Mumbai'=>'MAHARASHTRA',
	'Thane'=>'MAHARASHTRA',
	'Navi Mumbai'=>'MAHARASHTRA',
	'Delhi'=>'DELHI',
	'Noida'=>'UTTAR PRADESH',
	'Gurgaon'=>'HARYANA',
	'Gaziabad'=>'UTTAR PRADESH',
	'Faridabad'=>'HARYANA',
	'Pune'=>'MAHARASHTRA',
	'Chennai'=>'TAMIL NADU',
	'Hyderabad'=>'ANDHRA PRADESH',
	'Bangalore'=>'KARNATAKA',
	'Kolkata'=>'WEST BENGAL',
	'Ahmedabad'=>'GUJARAT',
	'Jaipur'=>'RAJASTHAN',
	'Chandigarh'=>'PUNJAB'
	   	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function GetStdCode($pKey){
    $titles = array(
	'Mumbai'=>'724',
	'Thane'=>'22',
	'Navi Mumbai'=>'22',
	'Delhi'=>'11',
	'Noida'=>'120',
	'Gurgaon'=>'124',
	'Gaziabad'=>'120',
	'Faridabad'=>'129',
	'Pune'=>'724',
	'Chennai'=>'44',
	'Hyderabad'=>'40',
	'Bangalore'=>'80',
	'Kolkata'=>'33',
	'Ahmedabad'=>'79',
	'Jaipur'=>'141',
	'Chandigarh'=>'172'
		   	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }
?>