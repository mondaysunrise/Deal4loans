<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
define("TABLE_REQ_LOAN_PERSONAL", "Req_Loan_Personal");
$feedback_tble="lead_allocate";
$getBiddersSql = "select BidderID from Bidders where leadidentifier='smsplleads'";
$getBiddersQuery = ExecQuery($getBiddersSql);
$getBiddersNum = mysql_num_rows($getBiddersQuery);
$getBiddersArr = '';
for($i=0;$i<$getBiddersNum;$i++)
{
	$getBiddersArr[] = mysql_result($getBiddersQuery,$i,'BidderID');
}
$getBiddersStr = implode(',', $getBiddersArr);

$BidderIDstatic = "(".$getBiddersStr.")";

$query1="select RequestID, Dated from Req_Compaign Where ( Bank_Name='Dialer' and Compaign_ID=4101 and Reply_Type=1)";

$result = ExecQuery($query1);
$qrow = mysql_fetch_array($result);
$RequestID = $qrow['RequestID'];
$Dated = $qrow['Dated'];
$Reply_Type=1;

$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));

$currentdate = date('Y-m-d');

$todaydate = date('Y-m-d');

if($RequestID>0)
{
	$qrysql="SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID AND Req_Feedback_PL.BidderID in ".$BidderIDstatic." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".($Dated)."' and '".$todaydate." 23:59:59' or Req_Feedback_PL.Followup_Date Between '".($Dated)."' and '".$todaydate." 23:59:59') and ".TABLE_REQ_LOAN_PERSONAL.".RequestID >'".$RequestID."' ";
	
}
else
{
	$qrysql="SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID AND Req_Feedback_PL.BidderID in ".$BidderIDstatic." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".$currentdate." 00:00:00' and '".$todaydate." 23:59:59' or Req_Feedback_PL.Followup_Date Between '".$currentdate." 00:00:00' and '".$todaydate." 23:59:59') ";
}

echo $qrysql."<br>";
$qrysql="SELECT Name, RequestID, Mobile_Number, Updated_Date FROM Req_Loan_Personal WHERE ( source IN ( 'SMS_Lead_Appointment_Model',  'mywishbankPL',  'mywishbankchat',  'wishfinPL',  'wishfinchat' ) AND ( Updated_Date BETWEEN  '2016-03-05 00:00:00' AND  '2016-03-05 23:00:00' ) and RequestID not in (2024392,2024393,2024394,2024395,2024396,2024397,2024398,2024399,2024400,2024401,2024402,2024403,2024404,2024405,2024406,2024407,2024408,2024409,2024410,2024411,2024412,2024413,2024414,2024415,2024416,2024417,2024418,2024419,2024425,2024426,2024427,2024428,2024429,2024430,2024431,2024432,2024433,2024434,2024435,2024436,2024437,2024438,2024439,2024440,2024441,2024442,2024443,2024444,2024445,2024446,2024447,2024448,2024449,2024450,2024451,2024452,2024453,2024454,2024455,2024456,2024457,2024458,2024459,2024460,2024461,2024462,2024463,2024464,2024465,2024466,2024467,2024468,2024469,2024470,2024471,2024472,2024473,2024720,2024721,2024722,2024723,2024724,2024725,2024726,2024727,2024728,2024729,2024730,2024731,2024732,2024733,2024734,2024735,2024736,2024737,2024738,2024739,2024740,2024741,2024742,2024743,2024744,2024745,2024746,2024747,2024748,2024749,2024750,2024751,2024752) )";//1996314
echo $qrysql."<br>";
$qrysqlresult = ExecQuery($qrysql);
echo $countRows = mysql_num_rows($qrysqlresult);
//die();


$param = '';
while($plrow = mysql_fetch_array($qrysqlresult))
{
		//?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
	$param["Name"] = trim($plrow["Name"]);
	$param["Mobile_Number"] = "0".$plrow["Mobile_Number"];
	$param["UniqueID"] = $plrow["RequestID"];
	$param["LeadIdentifier"] = "smsplleads";
	$param["campaignId"] = 1001;
	$param["feedback"] = "No feedback";
	$dated = ExactServerdate();
	echo "<br>";
	print_r($param);
	echo "<br>";
 
	$request = '';
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

	$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated) VALUES ('".$Reply_Type."', '".$param["UniqueID"]."', '".$param["Name"]."', '".$param["Mobile_Number"]."', '', '".$dated."')";
	$InsertQuery = ExecQuery($InsertSQl);
	$lastID =mysql_insert_id();

	//echo $request."<br><br>";
	//https://192.168.1.250/webclient/reports/deal4loan.php?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
  	echo  $url = "https://122.176.122.134/webclient/reports/deal4loan.php?".$request;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt ($ch, CURLOPT_POST, 1);
	$content = curl_exec ($ch);
	echo "<br>";
	echo "<br>";
	print_r($content);
	echo "<br>";
	$explodeVal = explode(',',$content);
	$ReqID = $explodeVal[0];
	$ReqservID = $explodeVal[1];
	$status = $explodeVal[2];
	
	echo "<br>";
	echo $UpdateSQl = "update Req_Dialer_Records_PL set Feedback = '".$status."', DialerID = '".$ReqservID."' where ID = '".$lastID."' and RequestID='".$ReqID."'";
	ExecQuery($UpdateSQl);
	
	//echo $InsertSQl;
	$updateSql = "update Req_Compaign set RequestID='".$ReqID."', Dated=Now() where ( Bank_Name='Dialer' and Compaign_ID=4101 and Reply_Type=1)";
//	ExecQuery($updateSql);
	echo "<br>";
	//  print_r($content); 
	curl_close ($ch);
}			
?>	
