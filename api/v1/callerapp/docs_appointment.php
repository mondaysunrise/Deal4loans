<?php
//ini_set("display_errors", "1");
error_reporting(E_ALL);

define('API_URL', 'http://www.deal4loans.com/api/v1/callerapp');
define('PAGESIZE', '20');
require '../../../scripts/db_init.php';

// Required values, BidderID, Product, Feedback Filter, Date range, DatacCountLIMIT

function authcheck($AuthUsername,$AuthPassword)
{
 // Check Authentication 
	$authCurl = curl_init();
    $data = array(
        "auth_username" => $AuthUsername,
        "auth_password" => $AuthPassword,
       );
    $data_string = json_encode($data);
	$AURL = API_URL."/bidder-login.php";
    curl_setopt($authCurl, CURLOPT_URL, $AURL);
    curl_setopt($authCurl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($authCurl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($authCurl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($authCurl, CURLOPT_RETURNTRANSFER, true);
    $authOutput = curl_exec($authCurl);
    $err = curl_error($authCurl);
	curl_close($authCurl);
	
	$authOutputDecode = json_decode($authOutput, TRUE);
	if($authOutputDecode["validation_message"]=='')
	{
    $_SESSION['access_token'] = $authOutputDecode['AuthVerified'];
    $_SESSION['expire_tme'] = $authOutputDecode['expire_tme'];
    $_SESSION['set'] = true;
    // set expire time
    $_SESSION['expire'] = time() + $_SESSION['expire_tme']; // static expire
    }

	return($authOutputDecode);
}

$fp = fopen('php://input', 'r');
$rawData = stream_get_contents($fp);

$BiddersObj = json_decode($rawData, true);
$AuthUsername = $BiddersObj["auth_username"];
$AuthPassword = $BiddersObj["auth_password"];
$CustomerID = $BiddersObj["customerid"];
$BidderID = $BiddersObj["bidderid"];
$BidderProduct = $BiddersObj["product"];

$authOutputDecode=authcheck($AuthUsername,$AuthPassword);

$AuthVerified = $authOutputDecode['AuthVerified'];

if($AuthVerified=="verified")
{
	if($BidderID>0)
	{
		if($BidderProduct>0)
		{
		// for date range
		if(isset($MinDate) && isset($MaxDate))
			{
				$min_date=$MinDate." 00:00:00";
				$max_date=$MaxDate." 23:59:59";
			}
			else
			{
				$min_date=date('Y-m-d')." 00:00:00";
				$max_date=date('Y-m-d')." 23:59:59";
			}
		
			$getApptDetailsSql = "select * from zexternal_appointment_docs where RequestID='".$CustomerID."' and caller_id='".$BidderID."' order by id asc";
			$getApptDetailsResult = d4l_ExecQuery($getApptDetailsSql);
			$apptnum_rows = d4l_mysql_num_rows($getApptDetailsResult);
			$apptrow = d4l_mysql_fetch_assoc($getApptDetailsResult);
			//print_r($apptrow);
			if($apptnum_rows>0){$docsarray=$apptrow;}else{$docsarray="";}
			if($apptrow["docpickerid"]>0)
			{
				$getFEDetailsSql = "select Name as FE_Name, Mobile_Number as FE_Mobile from zexternal_appointment_users where id='".$apptrow["docpickerid"]."'";
				$getFEDetailsQry = d4l_ExecQuery($getFEDetailsSql);
				$fenum_rows = d4l_mysql_num_rows($getFEDetailsQry);
				$ferow = d4l_mysql_fetch_assoc($getFEDetailsQry);
				if($fenum_rows>0)
				{
					$fearray =$ferow;
				}
				else
				{
					$fearray="";
				}
			}
			$responseArray=array("status"=>"true", "doc_details"=>$docsarray, "spoc_details"=>$fearray);
			echo $responsefinal = json_encode($responseArray);
		}
	else 
		{
			$responseArray=array("status"=>"false", "validation_message"=>"Product Missing");
			$responsefinal = json_encode($responseArray);
			echo $responsefinal;
		}
	}
	else
	{
		$responseArray=array("status"=>"false", "validation_message"=>"BidderID Missing");
			$responsefinal = json_encode($responseArray);
			echo $responsefinal;
	}
}
else
{
	//echo "3:";
	$extraarray=array("status"=>"false");
	$responseArray=array_merge($extraarray,$authOutputDecode);
	echo $responsefinal = json_encode($responseArray);
}


//array Allocation table
function getProductName($pKey)
{
    $titles = array(
        1=> 'PL',
        2=> 'HL',
        3=> 'CL',
        4=> 'CC',
        5=> 'LAP'
     );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
}
//  End of allocation table mapping


// add tag
//echo $responsfinal;

