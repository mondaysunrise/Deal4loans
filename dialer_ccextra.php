<?php
//5657
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
define("TABLE_REQ_CC", "Req_Credit_Card");
$feedback_tble="lead_allocate";
$getBiddersSql = "select BidderID from Bidders where leadidentifier='diallerleadcc'";
$getBiddersQuery = ExecQuery($getBiddersSql);
$getBiddersNum = mysql_num_rows($getBiddersQuery);
$getBiddersArr = '';
for($i=0;$i<$getBiddersNum;$i++)
{
	$getBiddersArr[] = mysql_result($getBiddersQuery,$i,'BidderID');
}
$getBiddersStr = implode(',', $getBiddersArr);

$BidderIDstatic = "(".$getBiddersStr.")";

$query1="select RequestID, Dated from Req_Compaign Where (Compaign_ID=6620 and Reply_Type=4)";

$result = ExecQuery($query1);
$qrow = mysql_fetch_array($result);
$RequestID = $qrow['RequestID'];
$Dated = $qrow['Dated'];
$Reply_Type=1;

$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));

$currentdate = date('Y-m-d');
$currentdate = "2016-04-10";

$todaydate = date('Y-m-d');

if($RequestID>0)
{
	$qrysql="SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_CC." LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=".TABLE_REQ_CC.".RequestID AND Req_Feedback_CC.BidderID in ".$BidderIDstatic." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_CC.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=4 and ( ".$feedback_tble.".Allocation_Date Between '".($Dated)."' and '".$todaydate." 23:59:59' or Req_Feedback_CC.Followup_Date Between '".($Dated)."' and '".$todaydate." 23:59:59') and ".TABLE_REQ_CC.".RequestID >'".$RequestID."' ";
	
}
else
{
	$qrysql="SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_CC." LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID=".TABLE_REQ_CC.".RequestID AND Req_Feedback_CC.BidderID in ".$BidderIDstatic." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_CC.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=4 and ( ".$feedback_tble.".Allocation_Date Between '".$currentdate." 00:00:00' and '".$todaydate." 23:59:59' or Req_Feedback_CC.Followup_Date Between '".$currentdate." 00:00:00' and '".$todaydate." 23:59:59')";
	
	//$qrysql="SELECT Name,RequestID,Mobile_Number FROM ".$feedback_tble.",".TABLE_REQ_CC." WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_CC.".RequestID and ".$feedback_tble.".BidderID in ".$BidderIDstatic." and ".$feedback_tble.".Reply_Type=4 and ( ".$feedback_tble.".Allocation_Date Between '".$currentdate." 00:00:00' and '".$todaydate." 23:59:59')  and ".TABLE_REQ_CC.".RequestID ='842448' ";
	
}

$qrysql="SELECT Name, RequestID, Mobile_Number, Feedback
FROM lead_allocate, Req_Credit_Card
LEFT OUTER JOIN Req_Feedback_CC ON Req_Feedback_CC.AllRequestID = Req_Credit_Card.RequestID
AND Req_Feedback_CC.BidderID
IN ( 5658 )
WHERE lead_allocate.AllRequestID = Req_Credit_Card.RequestID
AND lead_allocate.BidderID
IN ( 5658 )
AND lead_allocate.Reply_Type =4
AND (
lead_allocate.Allocation_Date
BETWEEN '2016-04-01 00:00:00'
AND '2016-04-13 23:59:59'
OR Req_Feedback_CC.Followup_Date
BETWEEN '2016-04-01 00:00:00'
AND '2016-04-13 23:59:59'
)
AND (Req_Feedback_CC.Feedback IS NULL OR Req_Feedback_CC.Feedback='' OR Req_Feedback_CC.Feedback='No Feedback')";//842640,842745,842749


echo $qrysql."<br>";
//$qrysql="SELECT Name,RequestID,Mobile_Number FROM ".TABLE_REQ_CC." where RequestID in (1989001,1996669) ";//1996314
//echo $qrysql."<br>";//echo $countRows = mysql_num_rows($qrysql);
//die();

$qrysqlresult = ExecQuery($qrysql);
//exit();

$param = '';
while($plrow = mysql_fetch_array($qrysqlresult))
{
	//c_name=Jitendra&p_number=9694666974&list_id=2001&unique_id=testing&product_id=10&leadidentifier=my
	$lastID = $plrow["id"];
	$param = '';
	$param["c_name"] = trim($plrow["Name"]);
	$param["p_number"] = $plrow["Mobile_Number"];
	$param["unique_id"] = $plrow["RequestID"];
	$param["list_id"] = 1501;
	$param["product_id"] = 4;
	$param["leadidentifier"] = "diallerleadcc";
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

	$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated,dialer_camp_id) VALUES ('4', '".$param["unique_id"]."', '".$param["c_name"]."', '".$param["p_number"]."', '', '".$dated."', '1501')";
	$InsertQuery = ExecQuery($InsertSQl);
	$lastID =mysql_insert_id();

	//echo $request."<br><br>";
	//https://192.168.1.250/webclient/reports/deal4loan.php?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
  	echo  $url = "https://122.176.122.134/vicidial/dialer_lead.php?".$request;
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
	
	$ReqservID = $explodeVal[0];
	$list_id = $explodeVal[1];
	$ReqID = $explodeVal[2];
	$status = $explodeVal[3];
	
	echo "<br>";
	echo $UpdateSQl = "update Req_Dialer_Records_PL set Feedback = '".$status."', DialerID = '".$ReqservID."' where ID = '".$lastID."' and RequestID='".$ReqID."'";
	ExecQuery($UpdateSQl);
	
	//echo $InsertSQl;
	$updateSql = "update Req_Compaign set RequestID='".$ReqID."', Dated=Now() where (Compaign_ID=6620 and Reply_Type=4)";
	//ExecQuery($updateSql);
	echo "<br>";
	//  print_r($content); 
	curl_close ($ch);
}			
?>	
