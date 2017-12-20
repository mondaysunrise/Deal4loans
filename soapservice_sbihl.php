<?php
error_reporting(E_ALL);
require 'scripts/db_init.php';
require 'errorLogReporting.php';
define("PRODUCT_TYPE_ID", "2");

SBiHLwithoutASM();
SBiHLwithASM();
SBiHLwithFeedback();
// Without ASm for 6168

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


function SBiHLwithoutASM()
{
	$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
	$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

	$query1="Select RequestID from Req_Compaign Where (Reply_Type='2' and Bank_Name='SBI HL' and BidderID=6168)";
	$result1 = ExecQuery($query1);

	while($row1 = mysql_fetch_array($result1))
	{
		$requestid= $row1["RequestID"];
	}
	//$requestid="433598";
	
	$queryresult=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6319)");
	$BidderIDarr="";
	while($rowbid = mysql_fetch_array($queryresult))
	{
		$BidderIDarr[]= $rowbid["BidderID"];
	}
	$strbidders=implode(",",$BidderIDarr);

	If((strlen(trim($requestid))<=0))
	{
		$query="SELECT Name,DOB,Pancard,Mobile_Number,Email,Residence_Address,City,City_Other,Loan_Amount,Feedback_ID,AllRequestID,BidderID,Allocation_Date FROM client_lead_allocate,Req_Loan_Home  WHERE (client_lead_allocate.sbitelecaller=1 and client_lead_allocate.BidderID in (".$strbidders.") and client_lead_allocate.Reply_Type=2 and client_lead_allocate.AllRequestID=`Req_Loan_Home`.RequestID and (client_lead_allocate.Allocation_Date Between '".($mindate)."' and '".($maxdate)."')) order by leadid ASC";
	}
	else
	{
		$query="SELECT Name,DOB,Pancard,Mobile_Number,Email,Residence_Address,City,City_Other,Loan_Amount,Feedback_ID,AllRequestID,BidderID,Allocation_Date FROM client_lead_allocate,Req_Loan_Home  WHERE (client_lead_allocate.sbitelecaller=1 and client_lead_allocate.BidderID in (".$strbidders.") and client_lead_allocate.Reply_Type=2 and client_lead_allocate.AllRequestID=`Req_Loan_Home`.RequestID and (client_lead_allocate.Allocation_Date Between '".($mindate)."' and '".($maxdate)."') and client_lead_allocate.Feedback_ID>'".$requestid."') order by leadid ASC";
	}
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

		//$url = "https://app.sbismart.com/bo/ContactManagerApi/RealtyData";//UAT
		$url = "https://app.sbismart.com/bo/ContactManagerApi/RealtyData";//LIVE
		//echo $url;
		echo "<br>";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
		$result = curl_exec($ch);
		curl_close($ch); 	

		print_r($result); 
		$outputstr=$result;
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

		if($Feedback_ID>0)
		{
			$update =ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type='2' and Bank_Name='SBI HL' and BidderID=6168)");
		}

		$qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,request_xml,feedback,bidderid,doe, cust_requestid, cust_city) VALUES('".$Feedback_ID."','2','".$request."','".$outputstr."','".$mainBidderID."',NOW(),'".$AllRequestID."','".$location."')");
	}
}

function SBiHLwithASM()
{
	$today=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
	$currentdate=date('Y-m-d',$tomorrow);

	$mindate=$currentdate." 00:00:00";
	$maxdate=$today." 23:59:59";

	$query1="Select RequestID,Dated from Req_Compaign Where (Reply_Type='2' and Bank_Name='SBI HL' and BidderID=6254)";
	$result1 = ExecQuery($query1);

	while($row1 = mysql_fetch_array($result1))
	{
		$requestid= $row1["RequestID"];
		$Dated= $row1["Dated"];
	}
	//$requestid="433598";

	$queryresult=ExecQuery("Select BidderID from Bidders Where (Global_Access_ID=6319)");
	$BidderIDarr="";
	while($rowbid = mysql_fetch_array($queryresult))
	{
		$BidderIDarr[]= $rowbid["BidderID"];
	}
	$strbidders=implode(",",$BidderIDarr);

	If((strlen(trim($requestid))<=0))
	{
		$query="SELECT AsmID,Name,DOB,Pancard,Mobile_Number,Email,Residence_Address,City,City_Other,Loan_Amount,Feedback_ID,AllRequestID,BidderID,Allocation_Date FROM client_lead_allocate,Req_Loan_Home  WHERE (client_lead_allocate.sbitelecaller=2 and client_lead_allocate.AsmID>0 and client_lead_allocate.BidderID in (".$strbidders.") and client_lead_allocate.Reply_Type=2 and client_lead_allocate.AllRequestID=`Req_Loan_Home`.RequestID and (client_lead_allocate.asm_allocation_date Between '".($Dated)."' and '".($maxdate)."')) order by leadid ASC LIMIT 0,4";
	}
	else
	{
		$query="SELECT AsmID,Name,DOB,Pancard,Mobile_Number,Email,Residence_Address,City,City_Other,Loan_Amount,Feedback_ID,AllRequestID,BidderID,Allocation_Date FROM client_lead_allocate,Req_Loan_Home  WHERE (client_lead_allocate.sbitelecaller=2 and client_lead_allocate.AsmID>0 and client_lead_allocate.BidderID in (".$strbidders.") and client_lead_allocate.Reply_Type=2 and client_lead_allocate.AllRequestID=`Req_Loan_Home`.RequestID and (client_lead_allocate.asm_allocation_date Between '".($Dated)."' and '".($maxdate)."') ) order by leadid ASC LIMIT 0,4";
	}
	echo $query."<br>";
	$tataplqryresult = ExecQuery($query);
	while($row=mysql_fetch_array($tataplqryresult))
	{
		$AsmID = $row["AsmID"];
		if($AsmID>0)
		{
			$asmquery="Select asm_code,asm_name from sbihl_6168_asmlist Where (bidderid=".$AsmID.")";
			$asmresult = ExecQuery($asmquery);
			$asm = mysql_fetch_array($asmresult);
			$asm_code = $asm["asm_code"];
			$asm_name = $asm["asm_name"];
		}
		$Name = $row["Name"];
		$DOB = $row["DOB"];
		list($year,$month,$day) = explode("-",$DOB);
		$dobstr = $month."/".$day."/".$year;
		$Pancard = $row["Pancard"];
		$Mobile_Number = $row["Mobile_Number"];
		$Email = $row["Email"];
		$Residence_Address = $row["Residence_Address"];
		$City = $row["City"];
		$City_Other = $row["City_Other"];
		$Loan_Amount = $row["Loan_Amount"];
		list($Amount,$decimal) = explode(".",$Loan_Amount);
		$Feedback_ID = $row["Feedback_ID"];
		$Allocation_Date = $row["Allocation_Date"];
		//check lead already exist
		$chkquery="Select websrvid from webservice_bidder_details Where (bidderid in (6307,6308,6309,6310,6311,6312,6313,6314,6315,6316,6317,6318) and leadid='".$Feedback_ID."')";
		$chkresult = ExecQuery($chkquery);
		$chk = mysql_fetch_array($chkresult);
		if($chk["websrvid"]>0)
		{
			$alreadyexistlead=1;
		}
		else
		{
			$alreadyexistlead=0;
		}

		$AllRequestID = $row["AllRequestID"];
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
		$param["Product"] = "HomeLoan";
		$param["EntryBy"] = "Web";
		$param["ASMCode"] = $asm_code;
		$param["ASMName"] = $asm_name;
		$param["ApplicationNo"]="D4L".$Feedback_ID;

		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
		}
		echo $request = substr($request, 0, strlen($request)-1);
		if($alreadyexistlead<1)
		{
			//$url = "https://app.sbismart.com/bo/ContactManagerApi/RealtyData";//UAT
			$url = "https://app.sbismart.com/bo/ContactManagerApi/RealtyDataASM";//LIVE
			echo $url;
			echo "<br>";
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
			$result = curl_exec($ch);
			curl_close($ch); 	

			print_r($result); 
			$outputstr=$result;
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


			if($Feedback_ID>0)
			{
				$update =ExecQuery("Update Req_Compaign set RequestID='".$Feedback_ID."',Dated=Now() where (Reply_Type='2' and Bank_Name='SBI HL' and BidderID=6254)");
			}

			$qrydt= ExecQuery("INSERT INTO webservice_bidder_details (leadid, product, request_xml, feedback, bidderid, doe, cust_requestid, cust_city) VALUES('".$Feedback_ID."','2', '".$request."', '".$outputstr."', '".$mainBidderID."', NOW(), '".$AllRequestID."', '".$location."')");
		}
	}
}

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

	$query1="Select websrvid,cust_requestid,doe,feedback from webservice_bidder_details Where (product='2' and bidderid in (".$strbidders.") and final_feedback='' and doe Between '".($mindate)."' and '".($maxdate)."')";
	$result1 = ExecQuery($query1);
	
	while($row=mysql_fetch_array($result1))
	{
		$data = $row["feedback"];
		$expires = preg_split('/LeadID/', trim($data));
		$leadValue = str_replace(":","",str_replace('"}]','',$expires[1]));

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

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$request);
		$result = curl_exec($ch);
		curl_close($ch); 	
		//print_r($result); 
		$outputstr=$result;

		if($row["websrvid"]>0)
		{
			if(strlen($outputstr)>0)
			{
				$StrRepFirstBracket = str_replace("[", "", $outputstr);
				$StrRepFinal = str_replace("]", "", $StrRepFirstBracket);
				$obj = json_decode(trim($StrRepFinal));
				$CurrentStatus = $obj->{'CurrentStatus'};
			}
			echo "here"; 
			$update =ExecQuery("Update webservice_bidder_details set final_feedback='".$outputstr."',sbi_current_status='".$CurrentStatus."', final_feedback_date=Now() where (websrvid='".$row["websrvid"]."')");
		}
	}
}

?>
