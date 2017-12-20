<?php
ini_set('max_execution_time', 1000);
error_reporting(E_ALL);
require 'scripts/db_init.php';

SBiHLwithFeedbackDaily();


function SBiHLwithFeedbackDaily()
{
	$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-90, date("Y"));
	$currentdate=date('Y-m-d',$tomorrow);
	$mindate=$currentdate." 00:00:00";
	$maxdate=date('Y-m-d')." 23:59:59";
	$queryresult=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6319)");
	$BidderIDarr="";
	while($rowbid = mysql_fetch_array($queryresult))
	{
		$BidderIDarr[]= $rowbid["BidderID"];
	}
	$strbidders=implode(",",$BidderIDarr);

	echo $query1="Select websrvid,cust_requestid,doe,feedback from webservice_bidder_details Where (product='2' and bidderid in (".$strbidders.") AND leadid = '773424')";
	$result1 = ExecQuery($query1);
	
	while($row=mysql_fetch_array($result1))
	{	
		$data = $row["feedback"];
		$expires = preg_split('/LeadID/', trim($data));
		$leadValue = str_replace(":","",str_replace('"}]','',$expires[1]));
		
		//LeadID= HL834&PanCard= AAAPA1111A&ContactNo= 8802562036
		//to get details
		$chkquery="Select Mobile_Number,Pancard from Req_Loan_Home Where (RequestID=".$row["cust_requestid"].")";
		$chkresult = ExecQuery($chkquery);
		$chk = mysql_fetch_array($chkresult);
		
		$param["LeadID"] = trim($leadValue);
		$param["PanCard"] = trim($chk["Pancard"]);
		$param["ContactNo"] = trim($chk["Mobile_Number"]);
		echo '<pre>';print_r($param); 

		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		$request = substr($request, 0, strlen($request)-1);
		$url = "https://app.sbismart.com/bo/ContactManagerApi/RealtyDataShow";
		//echo $url;
		//echo "<br>";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
		$result = curl_exec($ch);
		curl_close($ch); 	
		echo '<pre>';print_r($result); 
		//echo "<br>";
		$outputstr=$result;

		if($row["websrvid"]>0)
		{	
			if(strlen($outputstr)>0)
			{
				$StrRepFirstBracket = str_replace("[", "", $outputstr);
				$StrRepFinal = str_replace("]", "", $StrRepFirstBracket);
				$obj = json_decode($StrRepFinal);
				$CurrentStatus = $obj->{'CurrentStatus'};
			}
			
			$outputstr = addslashes($outputstr);
		
			echo $updateqry = "Update webservice_bidder_details set final_feedback='".$outputstr."',sbi_current_status='".$CurrentStatus."', final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')";
			$update =ExecQuery($updateqry);
		}
	}
}
?>
