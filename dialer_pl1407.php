<?php
require_once 'dialer_constant.php';
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


//$qrysql="SELECT Name,RequestID,Mobile_Number,Req_Feedback_PL.Feedback, lead_allocate.Allocation_Date  FROM lead_allocate,Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback_PL.BidderID in (5929,5930,5931,5959,5960,5973) WHERE lead_allocate.AllRequestID=Req_Loan_Personal.RequestID and lead_allocate.BidderID in (5929,5930,5931,5959,5960,5973) and lead_allocate.Reply_Type=1 and ( lead_allocate.Allocation_Date Between '2016-04-04 00:00:03' and '2016-04-08 23:59:59' or Req_Feedback_PL.Followup_Date Between '2016-04-08 13:00:03' and '2016-04-08 23:59:59') and Req_Loan_Personal.RequestID >'2031854' and Req_Feedback_PL.Feedback='Ringing'";


echo $qrysql."<br>";
$qrysql="SELECT Name,RequestID,Mobile_Number FROM ".TABLE_REQ_LOAN_PERSONAL." where RequestID in (2428215,2428216,2428217,2428218,2428219) ";//1996314
//echo $qrysql."<br>";
//echo $countRows = mysql_num_rows($qrysql);
//die();
$qrysqlresult = ExecQuery($qrysql);
$param = '';
while($plrow = mysql_fetch_array($qrysqlresult))
{
	//c_name=Jitendra&p_number=9694666974&list_id=2001&unique_id=testing&product_id=10&leadidentifier=my
	$lastID = $plrow["id"];
	$param = '';
	$param["c_name"] = trim($plrow["Name"]);
	$param["p_number"] = $plrow["Mobile_Number"];
	$param["unique_id"] = $plrow["RequestID"];
	$param["list_id"] = 1500;
	$param["product_id"] = 1;
	$param["leadidentifier"] = "smsplleads";
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

	$InsertSQl = "INSERT INTO Req_Dialer_Records_PL (Reply_Type, RequestID, Name, Mobile_Number, Feedback, Dated) VALUES ('1', '".$param["unique_id"]."', '".$param["c_name"]."', '".$param["p_number"]."', '', '".$dated."')";
	$InsertQuery = ExecQuery($InsertSQl);
	$lastID =mysql_insert_id();

	//echo $request."<br><br>";
	//https://192.168.1.250/webclient/reports/deal4loan.php?Name=Upendra+Kumar&Mobile_Number=9971396363&UniqueID=1997361&list_id=1000
  	echo  $url = "https://".DIALLERIP."/vicidial/dialer_lead.php?".$request;
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
	//$updateSql = "update Req_Compaign set RequestID='".$ReqID."', Dated=Now() where ( Bank_Name='Dialer' and Compaign_ID=4101 and Reply_Type=1)";
//	ExecQuery($updateSql);
	echo "<br>";
	//  print_r($content); 
	curl_close ($ch);
}	
//http://goautodial.org/projects/goautodialce/wiki/Goautodial_Getting_Started_Guide		
?>	
