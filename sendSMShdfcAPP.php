<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

$Today = date("Y-m-d"); 
$min_date=$Today." 00:00:00";
//$min_date="2013-01-01 00:00:00";
$max_date=$Today." 23:59:59";

$getforsms = 'cl';
$currentdate=date('d-m-Y');

$query1="select RequestID from Req_Compaign Where ( Bank_Name='HDFCApp' and Compaign_ID=3266)";
//echo "<br>";
$result = ExecQuery($query1);
$qrow = mysql_fetch_array($result);
$RequestID = $qrow['RequestID'];

 $qryCity = ExecQuery("SELECT * FROM Bidders_List WHERE Reply_Type='3' and BidderID=1825");
 $strCity = mysql_result($qryCity,0,'City');
 $cityList = str_replace(",", "','", $strCity);
 
 //$appendSql = " and (((DOB!='' and DATE_SUB(CURDATE(),INTERVAL 21 YEAR) >= DOB) and Employment_Status=1) or ((DOB!='' and DATE_SUB(CURDATE(),INTERVAL 25 YEAR) >= DOB) and Employment_Status=0)) and Net_Salary>=200000";
 
if($RequestID>0)
{

	$qry="SELECT * from hdfc_car_loan_leads where `Source` in ('car-loan-hdfc','hdfc_car_loan') and Loan_Amount>0 and Name!='' and (Dated Between '".($min_date)."' and '".($max_date)."') and City in ('".$cityList."') and RequestID>'".$RequestID."'";
}
else
{
	$qry = "SELECT * from hdfc_car_loan_leads where `Source` in ('car-loan-hdfc','hdfc_car_loan') and Loan_Amount>0 and Name!='' and (Dated Between '".($min_date)."' and '".($max_date)."') and City in ('".$cityList."')";
	
}
echo $qry;
echo "<br>";
	$result = ExecQuery($qry);
	$recordcount = mysql_num_rows($result);
echo "<br>";
$SMSMessage = '';
for($i=0;$i<$recordcount;$i++)
{
	$SMSMessage ='';
	$RequestID = mysql_result($result,$i,'RequestID');
	$Name = mysql_result($result,$i,'Name');
	$Phone = mysql_result($result,$i,'Mobile_Number');
	$Car_Booked="no";
	$Car_Type = mysql_result($result,$i,'Car_Type');
	$City = mysql_result($result,$i,'City');
	$Net_Salary = mysql_result($result,$i,'Net_Salary');
	$Company_Name = mysql_result($result,$i,'Company_Name');
	
	if($Car_Type==1)
	{
		$CarType="New Car";
	}
	else
	{
		$CarType="Used Car";
	}
	if($Phone>0)
	{
		$message ="Your Leads for ".$getforsms." on (".$currentdate.") : ";
		$SMSMessage=$message."Name - ".$Name.", Mobile - ".$Phone.",carbd - ".$Car_Booked.", cartype - ".$CarType.", Exclusive Lead";
		// Your Spcl Exclusive CL Lead on (07-02-13): Name- abc,Mob - 9000000000, Company name-xyz, sal - 100000
		$message1 ="Your Spcl Exclusive CL Lead on (".$currentdate.") : ";
		$SMSMessage1=$message1."Name - ".$Name.", Mob - ".$Phone.", Company name-".$Company_Name.", sal - ".$Net_Salary;

		$sqlSMS = "SELECT * FROM Req_Compaign WHERE Reply_Type='3' and BidderID=1825 and City_Wise='".$City."' and Sms_Flag=1";
		//echo "<br>";
//		echo $sqlSMS;
//		echo "<br>";
		$qrySMS = ExecQuery($sqlSMS);
		$countSMS = mysql_num_rows($qrySMS);
		for($j=0;$j<$countSMS;$j++)
		{
			$strBank_Name = mysql_result($qrySMS,$j,'Bank_Name');
			$strmobile_no = mysql_result($qrySMS,$j,'Mobile_no');
			
			if(strlen(trim($strmobile_no)) > 0)
			{
				$str_mobile_no = 9971396361;
				SendSMSforLMS($SMSMessage1, $str_mobile_no);
			 	SendSMSforLMS($SMSMessage1, $strmobile_no);
				echo "<br>/////////////////////////////////////////<br>";
				echo "SMS To: ".$strmobile_no.", ".$strBank_Name;
				echo "<br>";
				echo $SMSMessage;
				echo "<br>/////////////////////////////////////////<br>";
				
			}
		}

	}
	echo "<br>";
	echo $updateSql = "update Req_Compaign set RequestID='".$RequestID."' where (Compaign_ID=3266)";
	ExecQuery($updateSql);
	echo "<br>";
	echo $updateSMSsent =  "update hdfc_car_loan_leads set sms_sent = 1, sms_number = '".$strmobile_no."', sms_to='".$strBank_Name."' where RequestID='".$RequestID."'";
	ExecQuery($updateSMSsent);	
				
}
?>