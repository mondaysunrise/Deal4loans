<?php
error_reporting(E_ALL);
require 'scripts/db_init.php';

SBiHLwithFeedbackDaily();
SBiHLwithFeedback3Days();
//SBiHLwithFeedbackNewleads();
SBiHLwithFeedback4sundays();
//SBiHLwithFeedbackv2();

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

	$query1="Select websrvid,cust_requestid,doe,feedback from webservice_bidder_details Where (product='2' and bidderid in (".$strbidders.") and doe Between '".$mindate."' and '".$maxdate."') and sbi_current_status not in ('Sanctioned','Not Contactable','Not Eligible','Not Interested','Wrong Number')";
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
		//echo "<br>";
		 $ch = curl_init($url);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
			$result = curl_exec($ch);
		  curl_close($ch); 	
		//print_r($result); 
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
		
			$update =ExecQuery("Update webservice_bidder_details set final_feedback='".$outputstr."',sbi_current_status='".$CurrentStatus."', final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')");
			//echo "Update webservice_bidder_details set final_feedback='".$outputstr."',final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')";
		}
	}
}

function SBiHLwithFeedbackNewleads()
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

	echo $query1="Select websrvid,cust_requestid,doe,feedback from webservice_bidder_details Where (product='2' and bidderid in (".$strbidders.") and final_feedback_date Between '".$mindate."' and '".$maxdate."') and sbi_current_status='New Leads')";
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
		echo $url;
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
				$StrRepFirstBracket = str_replace("[", "", $outputstr);
				$StrRepFinal = str_replace("]", "", $StrRepFirstBracket);
				$obj = json_decode($StrRepFinal);
				$CurrentStatus = $obj->{'CurrentStatus'};
			}
		
		$update =ExecQuery("Update webservice_bidder_details set final_feedback='".$outputstr."',sbi_current_status='".$CurrentStatus."', final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')");
		//echo "Update webservice_bidder_details set final_feedback='".$outputstr."',final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')";
		}
	}
}
function SBiHLwithFeedback3Days()
{
	$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-3, date("Y"));
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

	echo $query1="Select websrvid,cust_requestid,doe,feedback from webservice_bidder_details Where (product='2' and bidderid in (".$strbidders.") and finalpush_date between '".$mindate."' and '".$maxdate."') and sbi_current_status in ('Case Sent to RACPC','LOS Login/ Generation','New LOS','PushToAQM','Sanctioned')";
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
		echo $url;
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
				$StrRepFirstBracket = str_replace("[", "", $outputstr);
				$StrRepFinal = str_replace("]", "", $StrRepFirstBracket);
				$obj = json_decode($StrRepFinal);
				$CurrentStatus = $obj->{'CurrentStatus'};
			}
			
		$update =ExecQuery("Update webservice_bidder_details set final_feedback='".$outputstr."',sbi_current_status='".$CurrentStatus."', final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')");
		}
	}
} // for 3 days

function SBiHLwithFeedback4sundays()
{	
	$day=Date('D');
	if($day=="Sun")
	{
	$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-28, date("Y"));
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

	echo $query1="Select websrvid,cust_requestid,doe,feedback from webservice_bidder_details Where (product='2' and bidderid in (".$strbidders.") and final_feedback_date>'".$maxdate."') and sbi_current_status in ('Not Contactable','Not Eligible','Not Interested','Wrong Number')";
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
		echo $url;
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
				$StrRepFirstBracket = str_replace("[", "", $outputstr);
				$StrRepFinal = str_replace("]", "", $StrRepFirstBracket);
				$obj = json_decode($StrRepFinal);
				$CurrentStatus = $obj->{'CurrentStatus'};
			}
			
		$update =ExecQuery("Update webservice_bidder_details set final_feedback='".$outputstr."',sbi_current_status='".$CurrentStatus."', final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')");
		}
	}
	}
} // for 4 sundays
/*function SBiHLwithFeedbackv2()
{
	echo $query1="Select websrvid,final_feedback from webservice_bidder_details Where (product='2' and final_feedback!='' and bidderid in (6307,6308,6309,6310,6311,6312,6313,6314,6315,6316,6317,6318) and doe Between '2016-11-04 00:00:00' and '2016-11-25 23:59:59')";
	$result1 = ExecQuery($query1);
	
	while($row=mysql_fetch_array($result1))
	{	
		$outputstr = $row["final_feedback"];
		$websrvid = $row["websrvid"];
	
		if($row["websrvid"]>0)
		{	
			if(strlen($outputstr)>0)
			{
				$StrRepFirstBracket = str_replace("[", "", $outputstr);
				$StrRepFinal = str_replace("]", "", $StrRepFirstBracket);
				$obj = json_decode($StrRepFinal);
				$CurrentStatus = $obj->{'CurrentStatus'};
			}
			echo "here"; 
		$update =ExecQuery("Update webservice_bidder_details set sbi_current_status='".$CurrentStatus."', finalpush_date=Now() where (websrvid='".$row["websrvid"]."')");

			//echo "Update webservice_bidder_details set final_feedback='".$outputstr."',final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')";
		}
	}
}*/

?>
