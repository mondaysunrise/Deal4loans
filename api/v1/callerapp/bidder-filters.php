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
$BidderID = $BiddersObj["bidderid"];
$BidderProduct = $BiddersObj["product"];
$BidderFeedback = $BiddersObj["feedback"];
$MinDate = $BiddersObj["min_date"];
$MaxDate = $BiddersObj["max_date"];
$DataLimit = $BiddersObj["datalimit"];
$filter_type = $BiddersObj["filter_type"];
$filter_value = $BiddersObj["filter_value"];

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

		$checkFiltersQry = "Select * From lms_attributes where (BidderID='".$BidderID."' and app_active=1)";
		list($alreadyExistfilter,$filterrow)=MainselectfuncNew($checkFiltersQry,$array = array());
		if($alreadyExistfilter>0){
			$product_tbl = $filterrow[0]["product_tbl"];
			$allocation_tbl = $filterrow[0]["allocation_tbl"];
			$feedback_tbl = $filterrow[0]["feedback_tbl"];
			$pro_code = $filterrow[0]["productid"];
			$lead_edit_page = $filterrow[0]["lead_edit_page"];

			$productname=getProductName($pro_code);
		
		//search for reference id:
		if($filter_type=="referenceid")
			{
				$refernce_no=$filter_value;
				if(strlen($refernce_no)>3)
				{	$appdtxt=$productname;
					list($requestidno, $bidderid) = explode('S', $refernce_no);
					//echo $appdtxt."-".$requestidno."<br>";
					$refernce_no_section = str_replace($appdtxt, "",$requestidno);
					$refernce_no_clause = " AND `".$allocation_tbl."`.Feedback_ID = '".$refernce_no_section."' ";
				}
			}
				// For feedback filter
		if (strlen(trim($BidderFeedback)) == 0 || $BidderFeedback == "No Feedback") 
			{
				$FeedbackClause = " AND (".$feedback_tbl.".Feedback IS NULL OR ".$feedback_tbl.".Feedback='' OR ".$feedback_tbl.".Feedback='No Feedback') ";
			} else if ($BidderFeedback == "All") {
				$FeedbackClause = " ";
			} else {
				$FeedbackClause = " AND ".$feedback_tbl.".Feedback='" . $BidderFeedback . "' ";
				}
		// feedback filter end
		if($allocation_tbl==$feedback_tbl)
			{
	$BiddersFiltersQry = "SELECT 
	* FROM " . $allocation_tbl . ",`" . $product_tbl . "` WHERE " . $allocation_tbl . ".AllRequestID=`" . $product_tbl . "`.RequestID and " . $allocation_tbl . ".BidderID = '" . $BidderID . "' and " . $allocation_tbl . ".Reply_Type=" . $pro_code . " and (" . $allocation_tbl . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or ".$feedback_tbl.".Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') ";
	$BiddersFiltersQry = $BiddersFiltersQry . $FeedbackClause." ".$refernce_no_clause;
	$BiddersFiltersQry = $BiddersFiltersQry . "group by " . $product_tbl . ".Mobile_Number";
	$BiddersFiltersQry = $BiddersFiltersQry . " LIMIT $DataLimit, ".PAGESIZE;
			}
			else
			{
	$BiddersFiltersQry = "SELECT 
	* FROM " . $allocation_tbl . ",`" . $product_tbl . "` LEFT OUTER JOIN ".$feedback_tbl." ON ".$feedback_tbl.".AllRequestID=" . $product_tbl . ".RequestID AND ".$feedback_tbl.".BidderID= '" . $BidderID . "' WHERE " . $allocation_tbl . ".AllRequestID=`" . $product_tbl . "`.RequestID and " . $allocation_tbl . ".BidderID = '" . $BidderID . "' and " . $allocation_tbl . ".Reply_Type=" . $pro_code . " and (" . $allocation_tbl . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or ".$feedback_tbl.".Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') ";
	$BiddersFiltersQry = $BiddersFiltersQry . $FeedbackClause." ".$refernce_no_clause;
	$BiddersFiltersQry = $BiddersFiltersQry . "group by " . $product_tbl . ".Mobile_Number";
	$BiddersFiltersQry = $BiddersFiltersQry . " LIMIT $DataLimit, ".PAGESIZE;
			}
		//echo $BiddersFiltersQry;
	list($alreadyExist,$Biddersrow)=MainselectfuncNew($BiddersFiltersQry,$array = array());
	if($alreadyExist>0){

		$responseArray=array("status"=>"true","lead_edit_page"=>$lead_edit_page,"filters"=>$Biddersrow);
		//$responseArray=array_merge($extraarray,$Biddersrow);
		echo $responsefinal = json_encode($responseArray);
	}
	else
		{
		//echo "2:";
			$responseArray=array("status"=>"false", "validation_message"=>"No DATA Found");
			$responsefinal = json_encode($responseArray);
			echo $responsefinal;
		}
			//
		}
	else
		{
			$responseArray=array("status"=>"false", "validation_message"=>"Not Active for App");
			$responsefinal = json_encode($responseArray);
			echo $responsefinal;
		}

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

