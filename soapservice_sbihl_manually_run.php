<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require 'scripts/db_init.php';
require 'errorLogReporting.php';
define("PRODUCT_TYPE_ID", "2");

SBiHLLeadsRePush();

function checkresponse($response)
{
	$responsestring = trim($response);
	$responsearray=explode(",",$responsestring);
	$forleadid=explode(":",trim($responsearray[0]));
	$forstatus=explode(":",trim($responsearray[2]));

	if(count($forstatus)>0)
	{
		$responsestr=trim($forstatus[1]);
	}

	return($responsestr);
}


function SBiHLLeadsPush()
{
	$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
	$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

	
	$queryresult=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6319)");
	$BidderIDarr="";
	while($rowbid = mysql_fetch_array($queryresult))
	{
		$BidderIDarr[]= $rowbid["BidderID"];
	}
	$strbidders=implode(",",$BidderIDarr);


	$query="SELECT Name,DOB,Pancard,Mobile_Number,Email,Residence_Address,City,City_Other,Loan_Amount,Feedback_ID,AllRequestID,BidderID,Allocation_Date FROM client_lead_allocate,Req_Loan_Home  WHERE (client_lead_allocate.sbitelecaller=1 and client_lead_allocate.BidderID in (".$strbidders.") and client_lead_allocate.Reply_Type=2 and client_lead_allocate.AllRequestID=`Req_Loan_Home`.RequestID and (client_lead_allocate.Allocation_Date Between '".($mindate)."' and '".($maxdate)."') and client_lead_allocate.Feedback_ID = '802733') order by leadid ASC";

	echo "yy".$query."<br>";

	$tataplqryresult = ExecQuery($query);
	while($row=mysql_fetch_array($tataplqryresult))
	{
		$Name = $row["Name"];
		$DOB = $row["DOB"];
		list($year,$month,$day) = explode("-",$DOB);
		$dobstr = $month."/".$day."/".$year;
		$Pancard = $row["Pancard"];
		$Mobile_Number = $row["Mobile_Number"];
		$Email = trim($row["Email"]);
		$Residence_Address = trim($row["Residence_Address"]);
		$City = $row["City"];
		$City_Other = $row["City_Other"];
		$Loan_Amount = $row["Loan_Amount"];
		list($Amount,$decimal) = explode(".",$Loan_Amount);
		$Feedback_ID = $row["Feedback_ID"];
		$AllRequestID = $row["AllRequestID"];
		$Allocation_Date = $row["Allocation_Date"];
		$BidderID = $row["BidderID"];
		$mainBidderID = $row["BidderID"];
		if($City=="Others" && strlen($City_Other)>0)
		{
			$location=$City_Other;
		}
		else
		{
			$location=$City;
		}
		if($BidderID==6562)
		{
			$location="Chandigarh";
		}
		if($Pancard=="")
		{
			$strPancard="AAAPA1111A";
		}
		else
		{
			$strPancard=$Pancard;
		}

		if(strlen($Residence_Address)>2)
		{
			$Address=$Residence_Address;
		}
		else
		{
			$Address=$location;
		}

		$param["Name"]= $Name;
		$param["DOB"] = $dobstr;
		$param["PanCard"] = $strPancard;
		$param["ContactNo"] = $Mobile_Number;
		$param["EmailId"] = trim($Email);
		$param["Address"] =  trim($Address);
		$param["Location"] = $location;
		$param["Amount"] = $Amount;
		$param["LeadSource"] = "Deal4loans";
		$param["Product"] = "Home Loan";
		$param["EntryBy"] = "Web";
		$param["ApplicationNo"]="D4L".$Feedback_ID;

		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		$request = substr($request, 0, strlen($request)-1);

		$url = "https://app.sbismart.com/bo/ContactManagerApi/RealtyData";//LIVE
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
		$result = curl_exec($ch);
		curl_close($ch); 	

		print_r($result); 
		echo "<br>";
		echo $outputstr=$result;
		$output=checkresponse($outputstr);

		if(strlen(strpos($output, "SUCCESS")) > 0)
		{
			$iWebServiceStatus = WEBSERVICE_STATUS_SUCCESS;
		}
		elseif(strlen(strpos($output, "FAIL")) > 0)
		{
			$iWebServiceStatus = WEBSERVICE_STATUS_FAILED_DATA_ISSUE;
		}
		else
		{
			$iWebServiceStatus = WEBSERVICE_STATUS_BLANK;
		}
		$errorLogReporting = new errorLogReporting();
		$errorLogReporting->errorReportInsertion($iWebServiceStatus, $output, $ClientName='', PRODUCT_TYPE_ID, $BidderID, $AllRequestID, $webServiceID=11, $Allocation_Date);

		$qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,request_xml,feedback,bidderid,doe, cust_requestid, cust_city) VALUES('".$Feedback_ID."','2','".$request."','".$outputstr."','".$mainBidderID."',NOW(),'".$AllRequestID."','".$location."')");
	}
}


function SBiHLLeadsRePush()
{
	$queryresult=d4l_ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6319)");
	$BidderIDarr=array();
	while($rowbid = d4l_mysql_fetch_array($queryresult))
	{
		$BidderIDarr[]= $rowbid["BidderID"];
	}
	$strbidders=implode(",",$BidderIDarr);

	$leadidrecordsresult=d4l_ExecQuery("Select * from webservice_bidder_details Where leadid IN ('843704')");
	while($leadidrecordsrow = d4l_mysql_fetch_array($leadidrecordsresult))
	{
		$leadid=$leadidrecordsrow["leadid"];

		$query="SELECT Name,DOB,Pancard,Mobile_Number,Email,Residence_Address,City,City_Other,Loan_Amount,Feedback_ID,AllRequestID,BidderID,Allocation_Date FROM client_lead_allocate,Req_Loan_Home  WHERE client_lead_allocate.BidderID in (".$strbidders.") and client_lead_allocate.Reply_Type=2 and client_lead_allocate.AllRequestID=`Req_Loan_Home`.RequestID and client_lead_allocate.Feedback_ID ='".$leadid."' order by leadid ASC";
		echo $query."<br>";

		$tataplqryresult = d4l_ExecQuery($query);
		while($row=d4l_mysql_fetch_array($tataplqryresult))
		{
			$Name = $row["Name"];
			$DOB = $row["DOB"];
			list($year,$month,$day) = explode("-",$DOB);
			$dobstr = $month."/".$day."/".$year;
			$Pancard = $row["Pancard"];
			$Mobile_Number = $row["Mobile_Number"];
			$Email = trim($row["Email"]);
			$Residence_Address = trim($row["Residence_Address"]);
			$City = $row["City"];
			$City_Other = $row["City_Other"];
			$Loan_Amount = $row["Loan_Amount"];
			list($Amount,$decimal) = explode(".",$Loan_Amount);
			$Feedback_ID = $row["Feedback_ID"];
			$AllRequestID = $row["AllRequestID"];
			$Allocation_Date = $row["Allocation_Date"];
			$BidderID = $row["BidderID"];
			$mainBidderID = $row["BidderID"];
			if($City=="Others" && strlen($City_Other)>0)
			{
				$location=$City_Other;
			}
			else
			{
				$location=$City;
			}
			if($BidderID==6562)
			{
				$location="Chandigarh";
			}
			if($Pancard=="")
			{
				$strPancard="AAAPA1111A";
			}
			else
			{
				$strPancard=$Pancard;
			}

			if(strlen($Residence_Address)>2)
			{
				$Address=$Residence_Address;
			}
			else
			{
				$Address=$location;
			}


			$param["Name"]= $Name;
			$param["DOB"] = $dobstr;
			$param["PanCard"] = $strPancard;
			$param["ContactNo"] = $Mobile_Number;
			$param["EmailId"] = trim($Email);
			$param["Address"] =  trim($Address);
			$param["Location"] = $location;
			$param["Amount"] = $Amount;
			$param["LeadSource"] = "Deal4loans";
			$param["Product"] = "Home Loan";
			$param["EntryBy"] = "Web";
			$param["ApplicationNo"]="D4L".$Feedback_ID;

			$request = '';
			foreach($param as $key=>$val) //traverse through each member of the param array
			{
			  $request.= $key."=".urlencode($val); //we have to urlencode the values
			  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
			}
			$request = substr($request, 0, strlen($request)-1);
			$url = "https://app.sbismart.com/bo/ContactManagerApi/RealtyData";//LIVE

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
			$result = curl_exec($ch);
			curl_close($ch); 	

			$outputstr=$result;
			echo '<pre>';print_r($outputstr);
		
			$qrydt= d4l_ExecQuery("UPDATE webservice_bidder_details SET feedback = '".$outputstr."' WHERE leadid = '".$leadid."'");
		}
	}
}


?>
