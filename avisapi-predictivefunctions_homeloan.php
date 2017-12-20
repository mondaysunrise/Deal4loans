<?php
ini_set('max_execution_time', 1500);
require 'scripts/db_init.php';

$startprocess="Select total_lead_count From lead_allocation_table Where (Citywise='homeloancallingapi' and lead_allocation_logic=185)";
echo $startprocess."<br>";
$startprocessresult = ExecQuery($startprocess);
$recordcount = mysql_num_rows($startprocessresult);
$row=mysql_fetch_array($startprocessresult);
//print_r($row);
echo $total_lead_count = $row["total_lead_count"];
if($total_lead_count>0)
{
	
	$pastDate  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$days1date=date('Y-m-d',$pastDate);
	$currentdate=Date('Y-m-d');
	
	$min_date = $days1date." 00:00:00";
	$max_date = $currentdate." 23:59:59";

	$qry = "SELECT RequestID,Name,Mobile_Number,Section FROM Req_Loan_Home JOIN hlverifylms_allocation ON hlverifylms_allocation.AllRequestID=Req_Loan_Home.RequestID WHERE (RequestID>'".$total_lead_count."' and hlverifylms_allocation.BidderID=7429 and (Req_Loan_Home.Section IS NULL OR Req_Loan_Home.Section='') and (Req_Loan_Home.Dated  >'".$min_date."')) group by AllRequestID";
}

echo $qry."<br>";
$select4mcardsresult = ExecQuery($qry);
$recordcount1 = mysql_num_rows($select4mcardsresult);
$CampId='HLCALLING';
$listname=1005;
$skillname='HLCALLING';
$Section='';
//exit();
for($i=0;$i<$recordcount1;$i++)
{
	$Section='';
	$RequestID = mysql_result($select4mcardsresult,$i,'RequestID');
	$Name = mysql_result($select4mcardsresult,$i,'Name');
	$MobileNum = mysql_result($select4mcardsresult,$i,'Mobile_Number');
	$Section = mysql_result($select4mcardsresult,$i,'Section');
	if($Section!='Success')
	{
		$callApi = funMakeCall($RequestID, $MobileNum, $CampId, $listname, $skillname);
		$updateProductTbl = "Update Req_Loan_Home set Section='".$callApi."' where RequestID='".$RequestID."'";
		$updateProductTblResult = ExecQuery($updateProductTbl);
		echo $updateProductTbl."<br>";
		$updateqry= "Update lead_allocation_table set total_lead_count='".$RequestID."' Where (Citywise='homeloancallingapi' and lead_allocation_logic=185)";
		$updateqryresult = ExecQuery($updateqry);
		echo $updateqry."<br>";
	}
	else 
	{
		$Section='';
	}
	
}

function funMakeCall($RequestID, $MobileNum, $CampId, $listname, $skillname)
{
	//http://192.168.1.201/wishfin.ajax?do=manualUpload&domainname=wishfin&username=test&password=1234&campname=INSURANCE&phone1=9311022194&skillname=INSURANCE&listname=INSURANCE&leadidn=7010
	//http://192.168.1.32/wishfin.ajax?do=manualCallBackUpload&domainname=avis&username=admin&password=1234&campname=Cargil&skillname=ENGLISH&listname=Cargil_list&phone1=9953729072&callbackdate=1992-12-22 04:33:24&agentname=niraj
	
//	$callUrl = "http://122.176.100.27/wishfin.ajax";
	$callUrl = "http://1.22.91.57/wishfin.ajax";

	//Replace Non-breakable space (nbsp)
	//$Name = utf8_encode($Name);
	//$Name = preg_replace('/\xc2\xa0/', ' ', $Name);

	$param = '';
	$param['do']='manualUpload';
//	$param['do']='manualCallBackUpload';
	$param['domainname']='wishfin';
	$param['username']='test';
	$param['password']='1234';//1234
	$param['campname']=$CampId;
	$param["phone1"] = $MobileNum;
	$param["skillname"] = $skillname;
	$param["listname"] = $listname;
	$param["leadidn"] = $RequestID;

	$request = '';
	foreach($param as $key=>$val) //traverse through each member of the param array
	{
		$request.= $key."=".urlencode($val); //we have to urlencode the values
		$request.= "&"; 
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
	$url = $callUrl."?".$request;
	echo $url;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$content = curl_exec ($ch);
	$result = $content;
	if(is_numeric($result))
	{
		$status = 'Success';
	}
	else
	{
		$status = 'Failure';
	}
	return $status;
}
?>
