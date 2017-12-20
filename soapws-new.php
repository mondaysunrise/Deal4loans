<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
require 'errorLogReporting.php';
require_once ("lib/nusoap.php");

//changed on 26 Feb 2015 1.20pm
function hdfchomeloan()
{
	$today=Date('Y-m-d');
	//$today="2014-05-03";
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

$instquery=ExecQuery("INSERT INTO hdfc_hlnlap_cronlog (hdfcstart_time, hdfc_bidderid,	hdfc_product, run_date) VALUES (NOW(),'1329', '2', NOW() )");
$instid = mysql_insert_id();

$query1="Select RequestID from Req_Compaign Where (Reply_Type='2' and Bank_Name like'%hdfcbank%' and BidderID=1329)";

	$result1 = ExecQuery($query1);
	while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
//	 $requestid="459503";
	 }
	 //echo "hello".$requestid;
	if((strlen(trim($requestid))<=0))
	{
	$query="SELECT Feedback_ID AS REF_ID, Name AS CUST_NAME, Email AS CUST_EMAIL, Mobile_Number AS CUST_MOBILE, DOB AS CUST_DOB, City AS CUST_CITY,City_Other AS Cust_OtherCity,Pincode AS CUST_PINCODE,Employment_Status AS CUST_OCCUPATION, TRUNCATE(Net_Salary,0) AS CUST_INCOME,TRUNCATE(Loan_Amount,0) AS CUST_LOANAMT,TRUNCATE(Property_Value,0) AS CUST_PROPERTYVALUE,Company_Name AS CUST_EMPLOYER ,Property_Loc AS CUST_PROPLOCATION FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID = 1329 and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') LIMIT 0,4";
	}
	else
	{
	
	$query="SELECT Feedback_ID AS REF_ID, Name AS CUST_NAME, Email AS CUST_EMAIL, Mobile_Number AS CUST_MOBILE, DOB AS CUST_DOB, City AS CUST_CITY,City_Other AS Cust_OtherCity,Pincode AS CUST_PINCODE,Employment_Status AS CUST_OCCUPATION, TRUNCATE(Net_Salary,0) AS CUST_INCOME,TRUNCATE(Loan_Amount,0) AS CUST_LOANAMT,TRUNCATE(Property_Value,0) AS CUST_PROPERTYVALUE,Company_Name AS CUST_EMPLOYER ,Property_Loc AS CUST_PROPLOCATION FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID = 1329 and Req_Feedback_Bidder_HL.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') LIMIT 0,4";
}
// fetch leads from database
echo $query."<br>";
$result = ExecQuery($query,$link) or die('Errant query:  '.$query);
$recordcount = mysql_num_rows($result);

//$xmlstr="";
$i="";
$post="";
$posts="";
	/* create one master array of the records */
	$posts = array();
	if(mysql_num_rows($result)) {
		while($post = mysql_fetch_assoc($result)) {
			$posts[] = array('post'=>$post);
			 //print_r($posts);
		}
	}
		
		echo count($posts)."<br>";
if($recordcount>0)
{		
	for($i=0;$i<count($posts);$i++)
	{
		echo "for";
		$post=$posts[$i];
		//print_r($posts[$i]);
		$xmlstr='<Deal4loans>';
		//foreach($posts[$i] as $index => $post) {

			if(is_array($post)) {
				//echo "for";
				foreach($post as $key => $value) {
				
					$key="ROW";
					$xmlstr.='<'.$key.'>';
					if(is_array($value)) {
						
						foreach($value as $tag => $val) {
							
							if($tag=="CUST_OCCUPATION" && $val==1)
							{
								$val="Salaried";	
							}
							elseif($tag=="CUST_OCCUPATION" && $val==0)
							{
								$val="Self Employed";
							}
							if($tag=="CUST_CITY" && $val=="Others")
							{
								$val=$value["Cust_OtherCity"];	
							}
							if($tag=="CUST_CITY" && ($val=="Haridwar" || $val=="haridwar"))
							{
								$val="Hardwar";	
							}
							if($tag=="CUST_CITY" && $val=="Bhubneshwar")
							{
								$val="Bhubaneshwar";	
							}
							if($tag=="CUST_EMPLOYER" && strlen($val)>60)
							{
								list($First,$Last) = split('[ ]', $val);
								$val=$First;	
							}
							if($tag=="CUST_DOB" && strlen($val)<9)
							{
								$val="1980-01-01";	
							}							
									
						if(strlen(htmlentities($val))>0 && ($tag!="Cust_OtherCity"))
							{

							$xmlstr.='<'.$tag.'>'.htmlentities($val).'</'.$tag.'>';
							}
						}

						$xmlstr.='<CUST_RESIDENTTYPE>RES</CUST_RESIDENTTYPE>';
						$xmlstr.='<CUST_SOURCE>Web</CUST_SOURCE>';
						$xmlstr.='<CUST_SUB_SOURCE>DEAL4LOANS</CUST_SUB_SOURCE>';
						$xmlstr.='<CUST_ADDR_INFO1>NULL</CUST_ADDR_INFO1>';
						$xmlstr.='<CUST_ADDR_INFO2>NULL</CUST_ADDR_INFO2>';
						$xmlstr.='<CUST_ADDR_INFO3>NULL</CUST_ADDR_INFO3>';
						$xmlstr.='<CUST_ADDR_INFO4>NULL</CUST_ADDR_INFO4>';
						$xmlstr.='<CUST_REF_TYPE>DEAL4LOANS</CUST_REF_TYPE>';
						$xmlstr.='<CUST_CATEGORY>HL</CUST_CATEGORY>';		
						$xmlstr.='<CUST_PRODUCT>LOAN</CUST_PRODUCT>';
						$xmlstr.='<URL_NAME>Name of WEB PAGE URL</URL_NAME>';					
					}
					$xmlstr.='</'.$key.'>';					
				}
			}
			
		//}
		$xmlstr.='</Deal4loans>';
echo $xmlstr."<br><br>";
if(strlen($xmlstr)>0 && ($recordcount)>0)
	{
	//end to fetch data from database
        $soapClient = new nusoap_client("http://121.240.20.24/Push_Portal_Leads/Service.asmx?WSDL", true);      
			$ap_param=array('sXML'=>"".$xmlstr."",'sUid'=>"DEAL4LOANS",'sPwd'=>"DEAL4LOANS");                			
        // Call RemoteFunction ()             
           $info = $soapClient->call("SendPortalLeads", array($ap_param), "http://121.240.20.24/Push_Portal_Leads/Service.asmx" );			   
			print_r($info);
		echo $sendResponse = $info['SendPortalLeadsResult'];

if(($recordcount)>0)
		{				
				$Feedback_ID = $value["REF_ID"];
				$IP = $_SERVER['REMOTE_ADDR'];

$getAllocDateSql = "select Allocation_Date, AllRequestID from Req_Feedback_Bidder_HL where Feedback_ID='".$Feedback_ID."'";
$getAllocDateQuery = ExecQuery($getAllocDateSql);
$Allocation_Date = mysql_result($getAllocDateQuery,0,'Allocation_Date');
$AllRequestID = mysql_result($getAllocDateQuery,0,'AllRequestID');
if ($sendResponse == "Success")
{
	$iWebServiceStatus = WEBSERVICE_STATUS_SUCCESS;
}
else if ($sendResponse == "failure")
{
	$iWebServiceStatus = WEBSERVICE_STATUS_FAILED_DATA_ISSUE;
}
else
{
	$iWebServiceStatus = WEBSERVICE_STATUS_FAILED;
}

$errorLogReporting = new errorLogReporting();
$errorLogReporting->errorReportInsertion($iWebServiceStatus, $sendResponse, $ClientName, $product=2, $BidderID=1329, $AllRequestID, $webServiceID=6, $Allocation_Date);

$sendResponse =$sendResponse."".$IP;

		ExecQuery("insert hdfc_response_data (hdfcresid, hdfc_response_arr, hdfc_response, hdfc_req_id, hdfc_reponse_date, BidderID) Values ('', '".$xmlstr."', '".$sendResponse."','".$Feedback_ID."', Now(), '1329')");
		//echo "insert hdfc_response_data (hdfcresid,hdfc_response,hdfc_req_id) Values ('','".$sendResponse."','".$Feedback_ID."')";

		ExecQuery("update Req_Compaign set RequestID='".$Feedback_ID."' where Reply_Type='2' and Bank_Name Like'%hdfcbank%' and BidderID=1329");	

			if($sendResponse!='Success')
			{				
				echo $IP."<br>";
				$SMSMessage="HDFC Webservice Error - ".$IP;
				$Phone =9811215138;
						
				$SMShdfcMessage="Deal4Loans webservice getting Error. Reason: ".$sendResponse;
				$hdfcPhone =9833930403;
				$hdfc1Phone =9890516567;

				if(strlen(trim($hdfcPhone)) > 0)
				{
				//SendSMS($SMShdfcMessage, $hdfcPhone);
				//SendSMS($SMShdfcMessage, $hdfc1Phone);
				}
			}
		}
	}		
		}
		//echo $xmlstr."<br>";
		}
	$getendtime=date("H:i:s");

if(count($posts)>25)
	{
	$Content ="Total Leads pushed in : ".count($posts);
	$Email="mehra3@gmail.com,shweta.sharma@deal4loans.com";
	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		mail($Email,'HDFC HL report -Deal4loans', $Content, $headers);
	}
	
$updtequery=ExecQuery("Update hdfc_hlnlap_cronlog set hdfc_leadcount='".count($posts)."',hdfcend_time=Now() Where hdfc_logid=".$instid);
} // hdfc func

function hdfchomeloanReach()
{
	$today=Date('Y-m-d');
	//$today="2014-05-03";
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

$instquery=ExecQuery("INSERT INTO hdfc_hlnlap_cronlog (hdfcstart_time, hdfc_bidderid,hdfc_product, run_date) VALUES (NOW(),'6730', '2', NOW() )");
$instid = mysql_insert_id();

$query1="Select RequestID from Req_Compaign Where (Reply_Type='2' and Bank_Name like'%hdfcbank%' and BidderID=6730)";

	$result1 = ExecQuery($query1);
	while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
//	 $requestid="459503";
	 }
	 //echo "hello".$requestid;
	if((strlen(trim($requestid))<=0))
	{
	$query="SELECT Feedback_ID AS REF_ID, Name AS CUST_NAME, Email AS CUST_EMAIL, Mobile_Number AS CUST_MOBILE, DOB AS CUST_DOB, City AS CUST_CITY,City_Other AS Cust_OtherCity,Pincode AS CUST_PINCODE,Employment_Status AS CUST_OCCUPATION, TRUNCATE(Net_Salary,0) AS CUST_INCOME,TRUNCATE(Loan_Amount,0) AS CUST_LOANAMT,TRUNCATE(Property_Value,0) AS CUST_PROPERTYVALUE,Company_Name AS CUST_EMPLOYER ,Property_Loc AS CUST_PROPLOCATION FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID = 6730 and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') LIMIT 0,4";
	}
	else
	{
	
	$query="SELECT Feedback_ID AS REF_ID, Name AS CUST_NAME, Email AS CUST_EMAIL, Mobile_Number AS CUST_MOBILE, DOB AS CUST_DOB, City AS CUST_CITY,City_Other AS Cust_OtherCity,Pincode AS CUST_PINCODE,Employment_Status AS CUST_OCCUPATION, TRUNCATE(Net_Salary,0) AS CUST_INCOME,TRUNCATE(Loan_Amount,0) AS CUST_LOANAMT,TRUNCATE(Property_Value,0) AS CUST_PROPERTYVALUE,Company_Name AS CUST_EMPLOYER ,Property_Loc AS CUST_PROPLOCATION FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE Req_Feedback_Bidder_HL.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID = 6730 and Req_Feedback_Bidder_HL.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_HL.Allocation_Date between '".$mindate."' and '".$maxdate."') LIMIT 0,4";
}

// fetch leads from database
echo $query."<br>";
$result = ExecQuery($query,$link) or die('Errant query:  '.$query);
$recordcount = mysql_num_rows($result);

//$xmlstr="";
$i="";
$post="";
$posts="";
	/* create one master array of the records */
	$posts = array();
	if(mysql_num_rows($result)) {
		while($post = mysql_fetch_assoc($result)) {
			$posts[] = array('post'=>$post);
			 //print_r($posts);
		}
	}
		
		echo count($posts)."<br>";
if($recordcount>0)
{		
	for($i=0;$i<count($posts);$i++)
	{
		echo "for";
		$post=$posts[$i];
		//print_r($posts[$i]);
		$xmlstr='<Deal4loans>';
		//foreach($posts[$i] as $index => $post) {

			if(is_array($post)) {
				//echo "for";
				foreach($post as $key => $value) {
				
					$key="ROW";
					$xmlstr.='<'.$key.'>';
					if(is_array($value)) {
						
						foreach($value as $tag => $val) {
							
							if($tag=="CUST_OCCUPATION" && $val==1)
							{
								$val="Salaried";	
							}
							elseif($tag=="CUST_OCCUPATION" && $val==0)
							{
								$val="Self Employed";
							}
							if($tag=="CUST_CITY" && $val=="Others")
							{
								$val=$value["Cust_OtherCity"];	
							}
							if($tag=="CUST_CITY" && ($val=="Haridwar" || $val=="haridwar"))
							{
								$val="Hardwar";	
							}
							if($tag=="CUST_CITY" && $val=="Bhubneshwar")
							{
								$val="Bhubaneshwar";	
							}
							if($tag=="CUST_EMPLOYER" && strlen($val)>60)
							{
								list($First,$Last) = split('[ ]', $val);
								$val=$First;	
							}
							if($tag=="CUST_DOB" && strlen($val)<9)
							{
								$val="1980-01-01";	
							}							
									
						if(strlen(htmlentities($val))>0 && ($tag!="Cust_OtherCity"))
							{

							$xmlstr.='<'.$tag.'>'.htmlentities($val).'</'.$tag.'>';
							}
						}

						$xmlstr.='<CUST_RESIDENTTYPE>RES</CUST_RESIDENTTYPE>';
						$xmlstr.='<CUST_SOURCE>Web</CUST_SOURCE>';
						$xmlstr.='<CUST_SUB_SOURCE>DEAL4LOANS-REACH</CUST_SUB_SOURCE>';
						$xmlstr.='<CUST_ADDR_INFO1>NULL</CUST_ADDR_INFO1>';
						$xmlstr.='<CUST_ADDR_INFO2>NULL</CUST_ADDR_INFO2>';
						$xmlstr.='<CUST_ADDR_INFO3>NULL</CUST_ADDR_INFO3>';
						$xmlstr.='<CUST_ADDR_INFO4>NULL</CUST_ADDR_INFO4>';
						$xmlstr.='<CUST_REF_TYPE>DEAL4LOANS</CUST_REF_TYPE>';
						$xmlstr.='<CUST_CATEGORY>HL_REACH</CUST_CATEGORY>';		
						$xmlstr.='<CUST_PRODUCT>LOAN</CUST_PRODUCT>';
						$xmlstr.='<URL_NAME>Name of WEB PAGE URL</URL_NAME>';					
					}
					$xmlstr.='</'.$key.'>';					
				}
			}
			
		//}
		$xmlstr.='</Deal4loans>';
echo $xmlstr."<br><br>";
if(strlen($xmlstr)>0 && ($recordcount)>0)
	{
	//end to fetch data from database
        $soapClient = new nusoap_client("http://121.240.20.24/Push_Portal_Leads/Service.asmx?WSDL", true);      
			$ap_param=array('sXML'=>"".$xmlstr."",'sUid'=>"DEAL4LOANS",'sPwd'=>"DEAL4LOANS");                			
        // Call RemoteFunction ()             
           $info = $soapClient->call("SendPortalLeads", array($ap_param), "http://121.240.20.24/Push_Portal_Leads/Service.asmx" );			   
			print_r($info);
		echo $sendResponse = $info['SendPortalLeadsResult'];

if(($recordcount)>0)
		{				
				$Feedback_ID = $value["REF_ID"];
				$IP = $_SERVER['REMOTE_ADDR'];

$getAllocDateSql = "select Allocation_Date, AllRequestID from Req_Feedback_Bidder_HL where Feedback_ID='".$Feedback_ID."'";
$getAllocDateQuery = ExecQuery($getAllocDateSql);
$Allocation_Date = mysql_result($getAllocDateQuery,0,'Allocation_Date');
$AllRequestID = mysql_result($getAllocDateQuery,0,'AllRequestID');
if ($sendResponse == "Success")
{
	$iWebServiceStatus = WEBSERVICE_STATUS_SUCCESS;
}
else if ($sendResponse == "failure")
{
	$iWebServiceStatus = WEBSERVICE_STATUS_FAILED_DATA_ISSUE;
}
else
{
	$iWebServiceStatus = WEBSERVICE_STATUS_FAILED;
}

$errorLogReporting = new errorLogReporting();
$errorLogReporting->errorReportInsertion($iWebServiceStatus, $sendResponse, $ClientName, $product=2, $BidderID=6730, $AllRequestID, $webServiceID=12, $Allocation_Date);
echo "<br>";	

$sendResponse =$sendResponse."".$IP;

		ExecQuery("insert hdfc_response_data (hdfcresid, hdfc_response_arr, hdfc_response, hdfc_req_id, hdfc_reponse_date, BidderID) Values ('', '".$xmlstr."', '".$sendResponse."','".$Feedback_ID."', Now(), '6730')");
		//echo "insert hdfc_response_data (hdfcresid,hdfc_response,hdfc_req_id) Values ('','".$sendResponse."','".$Feedback_ID."')";

		ExecQuery("update Req_Compaign set RequestID='".$Feedback_ID."' where Reply_Type='2' and Bank_Name Like'%hdfcbank%' and BidderID=6730");	

		}
	}		
		}
		//echo $xmlstr."<br>";
		}
	$getendtime=date("H:i:s");

$updtequery=ExecQuery("Update hdfc_hlnlap_cronlog set hdfc_leadcount='".count($posts)."',hdfcend_time=Now() Where hdfc_logid=".$instid);
} // hdfc reach func


function hdfchomeloanAgainst()
{
$today=Date('Y-m-d');
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

$instquery=ExecQuery("INSERT INTO hdfc_hlnlap_cronlog (hdfcstart_time, hdfc_bidderid,	hdfc_product, run_date) VALUES (NOW(),'2245', '5', NOW() )");
$instid = mysql_insert_id();

$query1="Select RequestID from Req_Compaign Where (Reply_Type='5' and Bank_Name like'%hdfcbank%' and BidderID=2245)";
echo $query;
	$result1 = ExecQuery($query1);
	
	while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
	// $requestid="1442999";
	 }
	 //echo "hello".$requestid;
	if((strlen(trim($requestid))<=0))
	{	
		$query="SELECT Feedback_ID AS REF_ID, Name AS CUST_NAME, Email AS CUST_EMAIL, Mobile_Number AS CUST_MOBILE, DOB AS CUST_DOB, City AS CUST_CITY,City_Other AS Cust_OtherCity,Pincode AS CUST_PINCODE,Employment_Status AS CUST_OCCUPATION, TRUNCATE(Net_Salary,0) AS CUST_INCOME,TRUNCATE(Loan_Amount,0) AS CUST_LOANAMT,TRUNCATE(Property_Value,0) AS CUST_PROPERTYVALUE,Company_Name AS CUST_EMPLOYER ,Property_Loc AS CUST_PROPLOCATION FROM Req_Feedback_Bidder_LAP,Req_Loan_Against_Property WHERE Req_Feedback_Bidder_LAP.AllRequestID= Req_Loan_Against_Property.RequestID and Req_Feedback_Bidder_LAP.BidderID = 2245 and (Req_Feedback_Bidder_LAP.Allocation_Date between '".$mindate."' and '".$maxdate."') LIMIT 0,3";
	}
	else
	{	
	$query="SELECT Feedback_ID AS REF_ID, Name AS CUST_NAME, Email AS CUST_EMAIL, Mobile_Number AS CUST_MOBILE, DOB AS CUST_DOB, City AS CUST_CITY,City_Other AS Cust_OtherCity,Pincode AS CUST_PINCODE,Employment_Status AS CUST_OCCUPATION, TRUNCATE(Net_Salary,0) AS CUST_INCOME,TRUNCATE(Loan_Amount,0) AS CUST_LOANAMT,TRUNCATE(Property_Value,0) AS CUST_PROPERTYVALUE,Company_Name AS CUST_EMPLOYER ,Property_Loc AS CUST_PROPLOCATION FROM Req_Feedback_Bidder_LAP,Req_Loan_Against_Property WHERE Req_Feedback_Bidder_LAP.AllRequestID= Req_Loan_Against_Property.RequestID and Req_Feedback_Bidder_LAP.BidderID = 2245 and Req_Feedback_Bidder_LAP.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder_LAP.Allocation_Date between '".$mindate."' and '".$maxdate."') LIMIT 0,3";
		}
	// fetch leads from database
echo $query."<br>";
	$result = ExecQuery($query,$link) or die('Errant query:  '.$query);
$recordcount = mysql_num_rows($result);

//$xmlstr="";
$i="";
$post="";
$posts="";
	/* create one master array of the records */
	$posts = array();
	if(mysql_num_rows($result)) {
		while($post = mysql_fetch_assoc($result)) {
			$posts[] = array('post'=>$post);
			 //print_r($posts);
		}
	}		
		echo count($posts)."<br>";
if($recordcount>0)
{	
	for($i=0;$i<count($posts);$i++)
	{
		echo "for";
		$post=$posts[$i];
		//print_r($posts[$i]);
		$xmlstr='<Deal4loans>';
		

			if(is_array($post)) {
				//echo "for";
				foreach($post as $key => $value) {
				
					$key="ROW";
					$xmlstr.='<'.$key.'>';
					if(is_array($value)) {
						
						foreach($value as $tag => $val) {
							
							if($tag=="CUST_OCCUPATION" && $val==1)
							{
								$val="Salaried";	
							}
							elseif($tag=="CUST_OCCUPATION" && $val==0)
							{
								$val="Self Employed";
							}
							if($tag=="CUST_CITY" && $val=="Others")
							{
								$val=$value["Cust_OtherCity"];	
							}
							if($tag=="CUST_CITY" && ($val=="Haridwar" || $val=="haridwar"))
							{
								$val="Hardwar";	
							}
							if($tag=="CUST_CITY" && $val=="Bhubneshwar")
							{
								$val="Bhubaneshwar";	
							}
																
						if(strlen(htmlentities($val))>0 && ($tag!="Cust_OtherCity"))
							{

							$xmlstr.='<'.$tag.'>'.htmlentities($val).'</'.$tag.'>';
							}
						}
						$xmlstr.='<CUST_RESIDENTTYPE>RES</CUST_RESIDENTTYPE>';
						$xmlstr.='<CUST_SOURCE>Web</CUST_SOURCE>';
						$xmlstr.='<CUST_SUB_SOURCE>DEAL4LOANS-LAP</CUST_SUB_SOURCE>';
						$xmlstr.='<CUST_TERM_SOURCE></CUST_TERM_SOURCE>';						 
						$xmlstr.='<CUST_ADDR_INFO1>NULL</CUST_ADDR_INFO1>';
						$xmlstr.='<CUST_ADDR_INFO2>NULL</CUST_ADDR_INFO2>';
						$xmlstr.='<CUST_ADDR_INFO3>NULL</CUST_ADDR_INFO3>';
						$xmlstr.='<CUST_ADDR_INFO4>NULL</CUST_ADDR_INFO4>';
						$xmlstr.='<CUST_REF_TYPE>DEAL4LOANS</CUST_REF_TYPE>';
						$xmlstr.='<CUST_CATEGORY>LAP</CUST_CATEGORY>';		
						$xmlstr.='<CUST_PRODUCT>LOAN</CUST_PRODUCT>';
						$xmlstr.='<URL_NAME>Name of WEB PAGE URL</URL_NAME>';
					}   
					$xmlstr.='</'.$key.'>';					
				}				
			}

		$xmlstr.='</Deal4loans>';

echo $xmlstr."<br><br>";

if(strlen($xmlstr)>0 && ($recordcount)>0)
	{
	//end to fetch data from database

        $soapClient = new nusoap_client("http://121.240.20.24/Push_Portal_Leads/Service.asmx?WSDL", true);   
       
			$ap_param=array('sXML'=>"".$xmlstr."",'sUid'=>"DEAL4LOANS",'sPwd'=>"DEAL4LOANS");                
				
        // Call RemoteFunction ()
             
           $info = $soapClient->call("SendPortalLeads", array($ap_param), "http://121.240.20.24/Push_Portal_Leads/Service.asmx" );
			   
			print_r($info);

		echo $sendResponse = $info['SendPortalLeadsResult'];

if(($recordcount)>0)
		{		
		$Feedback_ID = $value["REF_ID"];		
			
			$getAllocDateSql = "select Allocation_Date, AllRequestID from Req_Feedback_Bidder_LAP where Feedback_ID='".$Feedback_ID."'";
			$getAllocDateQuery = ExecQuery($getAllocDateSql);
			$Allocation_Date = mysql_result($getAllocDateQuery,0,'Allocation_Date');
			$AllRequestID = mysql_result($getAllocDateQuery,0,'AllRequestID');			
			if ($sendResponse == "Success")
			{
				$iWebServiceStatus = WEBSERVICE_STATUS_SUCCESS;
			}
			else if ($sendResponse == "failure")
			{
				$iWebServiceStatus = WEBSERVICE_STATUS_FAILED_DATA_ISSUE;
			}
			else
			{
				$iWebServiceStatus = WEBSERVICE_STATUS_FAILED;
			}
			
			$errorLogReporting = new errorLogReporting();
			$errorLogReporting->errorReportInsertion($iWebServiceStatus, $sendResponse, $ClientName, $product=5, $BidderID=2245, $AllRequestID, $webServiceID=7, $Allocation_Date);
			echo "<br>";	
				
		

		ExecQuery("insert hdfc_response_data_lap (hdfcresid,hdfc_response,hdfc_req_id,hdfc_reponse_date, hdfc_response_arr) Values ('','".$sendResponse."','".$Feedback_ID."', Now(), '".$xmlstr."')");
		//echo "insert hdfc_response_data (hdfcresid,hdfc_response,hdfc_req_id) Values ('','".$sendResponse."','".$Feedback_ID."')";

		ExecQuery("update Req_Compaign set RequestID='".$Feedback_ID."' where Reply_Type='5' and Bank_Name Like'%hdfcbank%' and BidderID=2245");	

			//echo "update Req_Compaign set RequestID='".$Feedback_ID."' where Reply_Type='2' and Bank_Name Like'%hdfcbank%' and BidderID=2245";
			if($sendResponse!='Success')
			{
				$SMSMessage="HDFC Webservice Error";
				$Phone =9971396361;
				//$sPhone =9891118553;
				
				if(strlen(trim($Phone)) > 0)
				{
					SendSMS($SMSMessage, $Phone);
				//SendSMS($SMSMessage, $sPhone);
				}

				$SMShdfcMessage="Deal4Loans webservice getting Error. Reason: ".$sendResponse;
				$hdfcPhone =9833930403;
				$hdfc1Phone =9890516567;

				if(strlen(trim($hdfcPhone)) > 0)
				{
			//	SendSMS($SMShdfcMessage, $hdfcPhone);
				//SendSMS($SMShdfcMessage, $hdfc1Phone);
				}
			}
			else
			{
				$SMSMessage="HDFC Webservice accepted";
			//	$Phone =9971396361;
				//$sPhone =9891118553;
				
				if(strlen(trim($Phone)) > 0)
				{
				//	SendSMS($SMSMessage, $Phone);
				//SendSMS($SMSMessage, $sPhone);
				}
			}
		}
	}		
		}
		//echo $xmlstr."<br>";
}
	if(count($posts)>25)
	{
	$Content ="Total Leads pushed in : ".count($posts);
	$Email="mehra3@gmail.com,shweta.sharma@deal4loans.com";
	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		mail($Email,'HDFC LAP report -Deal4loans', $Content, $headers);
	}
	
$updtequery=ExecQuery("Update hdfc_hlnlap_cronlog set hdfc_leadcount='".count($posts)."',hdfcend_time=Now() Where hdfc_logid=".$instid);
}

function hdfchomeBT()
{
	$today=Date('Y-m-d');
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

$instquery=ExecQuery("INSERT INTO hdfc_hlnlap_cronlog (hdfcstart_time, hdfc_bidderid, hdfc_product, run_date) VALUES (NOW(),'1', '52', NOW() )");
$instid = mysql_insert_id();

$query1="Select RequestID from Req_Compaign Where (Reply_Type='2' and Bank_Name like'%hdfchlbt%' and BidderID=52)";
echo $query;
	$result1 = ExecQuery($query1);
	
	while($row1 = mysql_fetch_array($result1))
	{
	 $requestid= $row1["RequestID"];
	 //$requestid="600622";
	 }
	 //echo "hello".$requestid;
	if((strlen(trim($requestid))<=0))
	{
		$query="SELECT hdfchlbt_id AS REF_ID, hdfchlbt_name AS CUST_NAME, hdfchlbt_mobile AS CUST_MOBILE ,	hdfchlbt_city AS CUST_CITY,	TRUNCATE(hdfchlbt_outstandingloan,0) AS CUST_LOANAMT FROM  HDFC_homeloanBT  WHERE (hdfchlbt_date between '".$mindate."' and '".$maxdate."') LIMIT 0,2";
	}
	else
	{
		$query="SELECT hdfchlbt_id AS REF_ID, hdfchlbt_name AS CUST_NAME, hdfchlbt_mobile AS CUST_MOBILE, 	hdfchlbt_city AS CUST_CITY,	TRUNCATE(hdfchlbt_outstandingloan,0) AS CUST_LOANAMT FROM  HDFC_homeloanBT  WHERE  (hdfchlbt_id>'".$requestid."' and (hdfchlbt_date between '".$mindate."' and '".$maxdate."')) LIMIT 0,2";
}

// fetch leads from database
echo $query."<br>";
	$result = ExecQuery($query,$link) or die('Errant query:  '.$query);
$recordcount = mysql_num_rows($result);

//$xmlstr="";
$i="";
$post="";
$posts="";
	/* create one master array of the records */
	$posts = array();
	if(mysql_num_rows($result)) {
		while($post = mysql_fetch_assoc($result)) {
			$posts[] = array('post'=>$post);
			 //print_r($posts);
		}
	}
		
		echo count($posts)."<br>";
if($recordcount>0)
{	
	for($i=0;$i<count($posts);$i++)
	{
		echo "for";
		$post=$posts[$i];
		//print_r($posts[$i]);
		$xmlstr='<Deal4loans>';
		//foreach($posts[$i] as $index => $post) {

			if(is_array($post)) {
				//echo "for";
				foreach($post as $key => $value) {
				
					$key="ROW";
					$xmlstr.='<'.$key.'>';
					if(is_array($value)) {
						
						foreach($value as $tag => $val) {
							
							
							if($tag=="CUST_CITY" && ($val=="Haridwar" || $val=="haridwar"))
							{
								$val="Hardwar";	
							}
							if($tag=="CUST_CITY" && $val=="Bhubneshwar")
							{
								$val="Bhubaneshwar";	
							}
							
									
						if(strlen(htmlentities($val))>0 && ($tag!="Cust_OtherCity"))
							{

							$xmlstr.='<'.$tag.'>'.htmlentities($val).'</'.$tag.'>';
							}
						}

						$xmlstr.='<CUST_EMAIL>NULL</CUST_EMAIL>';
						$xmlstr.='<CUST_DOB>NULL</CUST_DOB>';
						$xmlstr.='<CUST_PINCODE>0</CUST_PINCODE>';
						$xmlstr.='<CUST_OCCUPATION>NULL</CUST_OCCUPATION>';
						$xmlstr.='<CUST_INCOME>0</CUST_INCOME>';
						$xmlstr.='<CUST_PROPERTYVALUE>NULL</CUST_PROPERTYVALUE>';
						$xmlstr.='<CUST_EMPLOYER>NULL</CUST_EMPLOYER>';
						$xmlstr.='<CUST_PROPLOCATION>Mumbai</CUST_PROPLOCATION>';
						$xmlstr.='<CUST_RESIDENTTYPE>RES</CUST_RESIDENTTYPE>';
						$xmlstr.='<CUST_SOURCE>Web</CUST_SOURCE>';
						$xmlstr.='<CUST_SUB_SOURCE>DEAL4LOANS</CUST_SUB_SOURCE>';
						$xmlstr.='<CUST_ADDR_INFO1>NULL</CUST_ADDR_INFO1>';
						$xmlstr.='<CUST_ADDR_INFO2>NULL</CUST_ADDR_INFO2>';
						$xmlstr.='<CUST_ADDR_INFO3>NULL</CUST_ADDR_INFO3>';
						$xmlstr.='<CUST_ADDR_INFO4>NULL</CUST_ADDR_INFO4>';
						$xmlstr.='<CUST_REF_TYPE>DEAL4LOANS-BT</CUST_REF_TYPE>';
						$xmlstr.='<CUST_CATEGORY>BT</CUST_CATEGORY>';		
						$xmlstr.='<CUST_PRODUCT>LOAN</CUST_PRODUCT>';
						$xmlstr.='<URL_NAME>Name of WEB PAGE URL</URL_NAME>';
					}  
					$xmlstr.='</'.$key.'>';
					
				}				
			}
			
		//}
		$xmlstr.='</Deal4loans>';

echo $xmlstr."<br><br>";

if(strlen($xmlstr)>0 && ($recordcount)>0)
	{

	//end to fetch data from database

        $soapClient = new nusoap_client("http://121.240.20.24/Push_Portal_Leads/Service.asmx?WSDL", true);
   
       
			$ap_param=array('sXML'=>"".$xmlstr."",'sUid'=>"DEAL4LOANS",'sPwd'=>"DEAL4LOANS");
                
				
        // Call RemoteFunction ()
             
           $info = $soapClient->call("SendPortalLeads", array($ap_param), "http://121.240.20.24/Push_Portal_Leads/Service.asmx" );
			   
			print_r($info);

		echo $sendResponse = $info['SendPortalLeadsResult'];

if(($recordcount)>0)
		{
				
				$Feedback_ID = $value["REF_ID"];

		ExecQuery("insert hdfc_response_data_lap (hdfcresid,hdfc_response,hdfc_req_id,hdfc_reponse_date) Values ('','".$sendResponse."','".$Feedback_ID."', Now())");
		

		ExecQuery("update Req_Compaign set RequestID='".$Feedback_ID."' where Reply_Type='2' and Bank_Name Like'%hdfchlbt%' and BidderID=52");	

			if($sendResponse!='Success')
			{
				$SMSMessage="HDFC Webservice Error";
				$Phone =9971396361;
				//$sPhone =9891118553;
				
				if(strlen(trim($Phone)) > 0)
				{
					//SendSMS($SMSMessage, $Phone);
				//SendSMS($SMSMessage, $sPhone);
				}


				$SMShdfcMessage="Deal4Loans webservice getting Error. Reason: ".$sendResponse;
				$hdfcPhone =9833930403;
				$hdfc1Phone =9890516567;


				if(strlen(trim($hdfcPhone)) > 0)
				{
			//	SendSMS($SMShdfcMessage, $hdfcPhone);
				//SendSMS($SMShdfcMessage, $hdfc1Phone);
				}
			}
			else
			{
				$SMSMessage="HDFC Webservice accepted";
			//	$Phone =9971396361;
				//$sPhone =9891118553;
				
				if(strlen(trim($Phone)) > 0)
				{
				//	SendSMS($SMSMessage, $Phone);
				//SendSMS($SMSMessage, $sPhone);
				}
			}
		}
	}		
		}
		//echo $xmlstr."<br>";
}
	if(count($posts)>25)
	{
	$Content ="Total Leads pushed in : ".count($posts);
	$Email="mehra3@gmail.com,shweta.sharma@deal4loans.com";
	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		//mail($Email,'HDFC LAP report -Deal4loans', $Content, $headers);
	}
	
$updtequery=ExecQuery("Update hdfc_hlnlap_cronlog set hdfc_leadcount='".count($posts)."',hdfcend_time=Now() Where hdfc_logid=".$instid);
}
main();

function main()
{
	hdfchomeloan();
	hdfchomeloanReach();
	hdfchomeloanAgainst();
	hdfchomeBT();
}
   
?>