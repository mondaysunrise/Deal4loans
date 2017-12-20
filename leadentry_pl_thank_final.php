<? 
require 'scripts/db_init.php';
$IP_Remote = getenv("REMOTE_ADDR");
if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
else { $IP=$IP_Remote;	}

if(($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" ))
{
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$leadid = $_POST["leadid"];
$FinalBidder_mcl = $_REQUEST['FinalBidder_mcl'];
$Final_Bidder = $_REQUEST['Final_Bidder'];

$Final_Bid = "";
		while (list ($key,$val) = @each($Final_Bidder)) { 
			$Final_Bid = $Final_Bid."$val,"; 
		} 
		
$Final_Bid_mcl = "";
		while (list ($key,$val) = @each($FinalBidder_mcl)) { 
			$Final_Bid_mcl = $Final_Bid_mcl."$val,"; 
		} 


$Final_Bid = substr($Final_Bid, 0, strlen($Final_Bid)-1); //remove the final comma sign from the final array
$Final_Bid_mcl = substr($Final_Bid_mcl, 0, strlen($Final_Bid_mcl)-1);


if(strlen($Final_Bid_mcl)>2 && strlen($Final_Bid)>2)
{
	$finalstr=$Final_Bid.",".$Final_Bid_mcl;
}
else if(strlen($Final_Bid_mcl)>2 && strlen($Final_Bid)==0)
{
	$finalstr=$Final_Bid_mcl;
}
else
{
	$finalstr=$Final_Bid;
}

//echo $finalstr."<br>";

if(strlen($finalstr)>0)
	{
	$Allocated=2;
	}
	else 
	{
		$Allocated=0;
	}

$dataUpdate = array('Allocated'=>$Allocated, 'Bidderid_Details'=>$finalstr);
$wherecondition = "(RequestID=".$leadid.")";
Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
//echo "Update Req_Loan_Personal set Allocated=".$Allocated." , Bidderid_Details=".$finalstr." Where (RequestID=".$leadid.")";

}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>

<table cellpadding="6" cellspacing="0" border="1">
<tr><td>Lead has been successfully Entered</td></tr>

</table>

</body>
</html>
