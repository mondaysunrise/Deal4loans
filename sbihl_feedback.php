<?php
error_reporting(E_ALL);
require 'scripts/db_init.php';
require 'errorLogReporting.php';
define("PRODUCT_TYPE_ID", "2");


SBiHLwithFeedback();


function SBiHLwithFeedback()
{
	$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$currentdate=date('Y-m-d',$tomorrow);
	$mindate=$currentdate." 00:00:00";
	$maxdate=$currentdate." 23:59:59";
	$queryresult=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6319)");
	 $BidderIDarr="";
	while($rowbid = mysql_fetch_array($queryresult))
		{
		 $BidderIDarr[]= $rowbid["BidderID"];
		 }
		 $strbidders=implode(",",$BidderIDarr);

	//$query1="Select websrvid,cust_requestid,doe,feedback from webservice_bidder_details Where (product='2' and bidderid in (".$strbidders.") and final_feedback='' and doe Between '".($mindate)."' and '".($maxdate)."')";

	$query1="SELECT * FROM `webservice_bidder_details` WHERE ( (doe Between '2017-02-01 00:00:00' and '2017-02-15 23:59:59') and BidderID in (6307,6308,6309,6310,6311,6312,6313,6314,6315,6316,6317,6318,6560,6561,6562))";	//674318,670903,670607,669768,669646,669644,669509,668834,667655,666352,665705,664423
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
		
		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		$request = substr($request, 0, strlen($request)-1);
		$url = "https://app.sbismart.com/bo/ContactManagerApi/RealtyDataShow";
		//echo $url;
		echo "<br>";
		 $ch = curl_init($url);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
			$result = curl_exec($ch);
		  curl_close($ch); 	
		//print_r($result); 
		echo "<br>";
		echo $outputstr=$result;

		if($row["websrvid"]>0)
		{	
			if(strlen($outputstr)>0)
			{
				$StrRepFirstBracket = str_replace("[{", "{", $outputstr);
				$StrRepFinal = str_replace("}]", "}", $StrRepFirstBracket);
				$obj = json_decode($StrRepFinal);
				$CurrentStatus = $obj->{'CurrentStatus'};
			}
			echo "here"; 
		$update =ExecQuery("Update webservice_bidder_details set final_feedback='".$outputstr."',sbi_current_status='".$CurrentStatus."', final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')");
echo "<br><br>";
		echo "Update webservice_bidder_details set final_feedback='".$outputstr."',sbi_current_status='".$CurrentStatus."', final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')";

			//echo "Update webservice_bidder_details set final_feedback='".$outputstr."',final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')";
		}
	}
}


?>