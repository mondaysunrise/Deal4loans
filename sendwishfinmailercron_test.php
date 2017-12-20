<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

$url = "https://www.wishfin.com";
//$url = "https://beta.wishfin.com";
$product_type = 'PL';

$currentDate = date("Y-m-d").":00:00";
//echo $getMailerCountSQl = "select * from wishfin_mailer_send where status=0";
echo $getMailerCountSQl = "select * from wishfin_mailer_send where dated>'".$currentDate."'";

//echo $getMailerCountSQl = "select * from wishfin_mailer_send where id=1337";
$getMailerCountQuery = ExecQuery($getMailerCountSQl);
$getMailerCountNumRows = mysql_num_rows($getMailerCountQuery);
$CustomerName='';
$CustomerEmail ='';
$source ='';
$product_type = '';

for($i=0;$i<$getMailerCountNumRows;$i++)
{
	$CustomerName='';
	$CustomerEmail ='';
	$source ='';
	$product_type = '';
	$RequestID=mysql_result($getMailerCountQuery,$i,'RequestID');
	$BidderID=mysql_result($getMailerCountQuery,$i,'BidderID');
	$AgentID=mysql_result($getMailerCountQuery,$i,'AgentID');
	$id=mysql_result($getMailerCountQuery,$i,'id');
	
	//Customer Details
	$getCustomerDetailsSql = "select Name, wishfin_id, Email,source from Req_Loan_Personal where RequestID='".$RequestID."'";
	$getCustomerDetailsQuery = ExecQuery($getCustomerDetailsSql);
	$CustomerName = mysql_result($getCustomerDetailsQuery,0,'Name');
	$lead_id = mysql_result($getCustomerDetailsQuery,0,'wishfin_id');
	$CustomerEmail = mysql_result($getCustomerDetailsQuery,0,'Email');
	$source = mysql_result($getCustomerDetailsQuery,0,'source');
	if($source=='')
	{
		$product_type = 'FBPL';
	}
	else
	{
		$product_type = 'PL';
	}
	//$CustomerEmail = 'askupendra@gmail.com';
	//echo $getCustomerDetailsSql."<br>";
	//Bank Name
	$sql1 = "select Bidder_Name from Bidders_List where BidderID='".$BidderID."'";
	$query1 = ExecQuery($sql1);
	$bankName= mysql_result($query1,0,'Bidder_Name');
	$emailerStatus = getExpertEmailer($AgentID,$CustomerName,$url, $lead_id,$bankName,$product_type,$CustomerEmail, $sessioncookie);

	if($emailerStatus=='Sent')
	{
		//$updateSql = "update wishfin_mailer_send set status=1 where RequestID= '".$RequestID."' and AgentID='".$AgentID."' and BidderID='".$BidderID."'";
		$updateSql = "update wishfin_mailer_send set status=1 where id= '".$id."'";	
		ExecQuery($updateSql);	
		//echo "<br>".$updateSql;	
	}
}


function getWishfinAPI($data, $urlExtension, $url)
{
	$ch = curl_init();
	$url = $url."/api/".$urlExtension;
	$data_string = json_encode($data);                
	$apiUser = 'deal4loans';
	//$apiPwd =  '8X7DjqpL';//Beta
	$apiPwd =  '7Z6XbNfs';//Production
	
	//password - 7Z6XbNfs
//	$apiKey = 'ZGVhbDRsb2Fuc3w4WDdEanFwTA';Beta
	$apiKey = 'ZGVhbDRsb2Fuc3w3WjZYYk5mcw';//Production

	$header = array();
	$header[] = 'Content-length: '. strlen($data_string);
	$header[] = 'Content-type: application/json';
	$header[] = 'Api_password:'.$apiPwd;
	$header[] = 'Api_user: '.$apiUser;
	$header[] = 'Api_key: '.$apiKey;
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$output=curl_exec($ch);
	curl_close($ch);
	$json = json_decode($output, true);
	return $json;
}

function getExpertEmailer($AgentCode,$CustomerName,$url, $lead_id,$bankName,$product_type,$Toemailid,$sessioncookie)
{
	$data = array("where" => array("d4l_agent_code" => $AgentCode));
	$urlExtension = 'relationshipManagerList';
	$json = getWishfinAPI ($data,$urlExtension, $url);
	//print_r($json['result'][0]);
	$rmArray = $json['result'][0];
	$relationshipManagerName = $rmArray['first_name']." ".$rmArray['last_name'];
	$relationshipManagerinitial_customers_handled = $rmArray['initial_customers_handled'];
	$relationshipManagerinitial_rating = $rmArray['initial_rating'];
	$relationshipManagerprofile_pic_path = $rmArray['profile_pic_path'];
	if(strlen($relationshipManagerprofile_pic_path)>0)
	{} else { $relationshipManagerprofile_pic_path= "http://www.deal4loans.com/emailer/images/expert-icon.png"; }
	$relationshipManagerwhatsapp_number = $rmArray['whatsapp_number'];
	
	if(strlen($relationshipManagerName)>3)
	{
	
	$RateImg ='';
 	for($x=1;$x<=$relationshipManagerinitial_rating;$x++) {
       $RateImg .= "http://www.deal4loans.com/emailer/images/star-rate.png+";
    }
    if (strpos($relationshipManagerinitial_rating,'.')) {
       $RateImg .= "http://www.deal4loans.com/emailer/images/half-star-rate.png+";
        $x++;
    }
    while ($x<=5) {
        $RateImg .= "http://www.deal4loans.com/emailer/images/no-star-rate.png+";
        $x++;
    }
//echo "<br>rating image<br>".$RateImg."<br><br>";
	$ratingimgarr=explode("+",$RateImg);
//print_R($ratingimgarr);
	$dataBankCode = array("where" => array( 'status' => 1, 'bank_name' => array('op' => 'like', 'val' => "%$bankName%")));
	$urlExtension = 'bankList';
	$bankCodeJson = getWishfinAPI($dataBankCode,$urlExtension,$url);
	$bankcodeArray = $bankCodeJson['result'][0];
//	print_r($bankCodeJson['result'][0]);
	$bank_code = $bankcodeArray['bank_code'];
	
	$expertURL = $url."/rating?product_type=".base64_encode($product_type)."&lead_id=".base64_encode($lead_id)."&bank_code=".base64_encode($bank_code)."&agent_code=".base64_encode($AgentCode)."";
	
	preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', triggeredlogin() , $matches);
	$cookies = array();
	foreach($matches[1] as $item) {
	    parse_str($item, $cookie);
	    $cookies = array_merge($cookies, $cookie);
	}
	$sessioncookie = $cookies["PubAuth1"];
	
	
	$param = "";
	$param["aid"] = 2103064721;
	$param["email"] = $Toemailid;
	$param["eid"] = 298330;
	$param["PROFILE_PIC"] = $relationshipManagerprofile_pic_path;
	$param["CUSTOMER_NAME"] = $CustomerName;
	$param["MANAGER_NAME"] = $relationshipManagerName;
	$param["LOAN_SERVICED"] = $relationshipManagerinitial_customers_handled;
	$param["RATING1"] = $ratingimgarr[0];
	$param["RATING2"] = $ratingimgarr[1];
	$param["RATING3"] = $ratingimgarr[2];
	$param["RATING4"] = $ratingimgarr[3];
	$param["RATING5"] = $ratingimgarr[4];
	$param["PRODUCT_TYPE"] = base64_encode($product_type);
	$param["LEAD_ID"] = base64_encode($lead_id);
	$param["BANK_CODE"] = base64_encode($bank_code);
	$param["AGENT_CODE"] = base64_encode($AgentCode);
	$requestPost = "";
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
  		$requestPost.= $key."=".urlencode($val); //we have to urlencode the values
  		$requestPost.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$requestPost= substr($requestPost, 0, strlen($requestPost)-1); //remove the final ampersand sign from the request
	echo $requestPost;

	//$url = "https://ebm.cheetahmail.com/ebm/ebmtrigger1?aid=2103064721&email=".$Toemailid."&eid=298330&PROFILE_PIC=".$relationshipManagerprofile_pic_path."&CUSTOMER_NAME=".$CustomerName."&MANAGER_NAME=".$relationshipManagerName."&LOAN_SERVICED=".$relationshipManagerinitial_customers_handled."&RATING1=".$ratingimgarr[0]."&RATING2=".$ratingimgarr[1]."&RATING3=".$ratingimgarr[2]."&RATING4=".$ratingimgarr[3]."&RATING5=".$ratingimgarr[4]."&PRODUCT_TYPE=".base64_encode($product_type)."&LEAD_ID=".base64_encode($lead_id)."&BANK_CODE=".base64_encode($bank_code)."&AGENT_CODE=".base64_encode($AgentCode);
	$url = "https://ebm.cheetahmail.com/ebm/ebmtrigger1";
	
	
echo "<br><br>".$url;
	$strCookie = "PubAuth1=".urlencode($sessioncookie)."; path=/; ";
	session_write_close();

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
//	curl_setopt($ch, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded','Content-Length:'. strlen($request)));
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIE, $strCookie);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $requestPost);
	$content = curl_exec ($ch);
	echo "<br><br>";
print_r($content);
	curl_close ($ch);  

	echo "<br><br>";

	
	$param1 = "";
	$param1["aid"] = 2103064721;
	$param1["email"] = "upendra@wishfin.com";
	$param1["eid"] = 298330;
	$param1["PROFILE_PIC"] = $relationshipManagerprofile_pic_path;
	$param1["CUSTOMER_NAME"] = $CustomerName;
	$param1["MANAGER_NAME"] = $relationshipManagerName;
	$param1["LOAN_SERVICED"] = $relationshipManagerinitial_customers_handled;
	$param1["RATING1"] = $ratingimgarr[0];
	$param1["RATING2"] = $ratingimgarr[1];
	$param1["RATING3"] = $ratingimgarr[2];
	$param1["RATING4"] = $ratingimgarr[3];
	$param1["RATING5"] = $ratingimgarr[4];
	$param1["PRODUCT_TYPE"] = base64_encode($product_type);
	$param1["LEAD_ID"] = base64_encode($lead_id);
	$param1["BANK_CODE"] = base64_encode($bank_code);
	$param1["AGENT_CODE"] = base64_encode($AgentCode);
	$requestPost1 = "";
	foreach($param1 as $key=>$val) //traverse through each member of the param array
	{ 
  		$requestPost1.= $key."=".urlencode($val); //we have to urlencode the values
  		$requestPost1.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$requestPost1= substr($requestPost1, 0, strlen($requestPost1)-1); //remove the final ampersand sign from the request
	echo $requestPost1;

	$ch1 = curl_init();
	curl_setopt($ch1, CURLOPT_URL, $url);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch1, CURLOPT_HEADER, 1);
//	curl_setopt($ch1, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded','Content-Length:'. strlen($request)));
	curl_setopt($ch1, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch1, CURLOPT_COOKIE, $strCookie);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, $requestPost1);
	$content1 = curl_exec ($ch1);
echo "<br><br>";
print_r($content1);
	curl_close ($ch1); 
		return "Sent";
	}
	else
	{
		return "NotSent";
	}
	

}

function triggeredlogin()
{
	
	$strCookie1 = "sessionId=".session_id()."; path=".session_save_path();
	session_write_close();
	
	$url = "https://ebm.cheetahmail.com/api/login1?name=deal4loans_API&cleartext=login@135";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	//	curl_setopt($ch, CURLOPT_HTTPHEADER, array('application/x-www-form-urlencoded','Content-Length:'. strlen($request)));
	curl_setopt($ch, CURLOPT_COOKIESESSION, true);
	curl_setopt($ch, CURLOPT_COOKIE, $strCookie1);
	$returnvalue= curl_exec ($ch);
	return($returnvalue);
}
	
?>