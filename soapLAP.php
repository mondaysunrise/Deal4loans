<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require_once ("lib/nusoap.php");

function hdfchomeloan()
{

$query="Select RequestID from Req_Compaign Where (Reply_Type='5' and Bank_Name like'%hdfcbank%' and BidderID=2245)";
echo $query;
list($rowcount,$row1)=Mainselectfunc($query,$array = array());
	 $requestid= $row1["RequestID"];
	 //echo "hello".$requestid;
	if((strlen(trim($requestid))<=0))
	{
	
		$query="SELECT Feedback_ID AS REF_ID, Name AS CUST_NAME, Email AS CUST_EMAIL, Mobile_Number AS CUST_MOBILE, DOB AS CUST_DOB, City AS CUST_CITY,City_Other AS Cust_OtherCity,Pincode AS CUST_PINCODE,Employment_Status AS CUST_OCCUPATION, TRUNCATE(Net_Salary,0) AS CUST_INCOME,TRUNCATE(Loan_Amount,0) AS CUST_LOANAMT,TRUNCATE(Property_Value,0) AS CUST_PROPERTYVALUE,Company_Name AS CUST_EMPLOYER ,Property_Loc AS CUST_PROPLOCATION FROM Req_Feedback_Bidder1,Req_Loan_Against_Property LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Against_Property.RequestID AND Req_Feedback.BidderID=2245 WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Against_Property.RequestID and Req_Feedback_Bidder1.BidderID = 2245 and (Req_Feedback_Bidder1.Allocation_Date >='2011-09-08 00:00:00' and Req_Loan_Against_Property.Dated >='2011-09-08 00:00:00')";
	}
	else
	{
	
	
	$query="SELECT Feedback_ID AS REF_ID, Name AS CUST_NAME, Email AS CUST_EMAIL, Mobile_Number AS CUST_MOBILE, DOB AS CUST_DOB, City AS CUST_CITY,City_Other AS Cust_OtherCity,Pincode AS CUST_PINCODE,Employment_Status AS CUST_OCCUPATION, TRUNCATE(Net_Salary,0) AS CUST_INCOME,TRUNCATE(Loan_Amount,0) AS CUST_LOANAMT,TRUNCATE(Property_Value,0) AS CUST_PROPERTYVALUE,Company_Name AS CUST_EMPLOYER ,Property_Loc AS CUST_PROPLOCATION FROM Req_Feedback_Bidder1,Req_Loan_Against_Property LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Against_Property.RequestID AND Req_Feedback.BidderID=2245 WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Against_Property.RequestID and Req_Feedback_Bidder1.BidderID = 2245 and Req_Feedback_Bidder1.Feedback_ID in (931447,932684,935684,935737,937267,938078,938123,938135,938145,938231,938406,938427,938474,938532,938612,938673,938773,938776,938799,938801,938811,938819,938822,938825,938827,938835,938840,938850,938866,938875,938895,940022,940251,940349,940456,945988) and (Req_Feedback_Bidder1.Allocation_Date >='2011-09-08 00:00:00' and Req_Loan_Against_Property.Dated >='2011-09-08 00:00:00')";
	

	}
	

// fetch leads from database

	list($recordcount,$posts)=MainselectfuncNew($query,$array = array());
//$xmlstr="";
$i="";
$post="";
$posts="";
	/* create one master array of the records */
	$posts = array();
	
		
		echo count($posts)."<br>";
if($recordcount>0)
{	
	/*if(count($posts)==1)
	{
		$arrpost=count($posts);
	}
	else
	{
		$arrpost=count($posts)-1;
	}*/
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
						$xmlstr.='<CUST_CATEGORY>LAP</CUST_CATEGORY>';					
					}   

					$xmlstr.='</'.$key.'>';
					
				}
				
			}
			

		//}
		$xmlstr.='</Deal4loans>';

echo $xmlstr."<br><br>";

if(strlen($xmlstr)>0 && ($recordcount)>0)
	{

	//https://jogint0.hdfcindia.com/Push_Portal_Leads/Service.asmx?WSDL
	//https://121.240.20.24/Push_Portal_Leads/Service.asmx?WSDL

	//end to fetch data from database

        $soapClient = new soapclient("https://online.hdfc.com/Push_Portal_Leads/Service.asmx?WSDL", true);
   
       
			$ap_param=array('sXML'=>"".$xmlstr."",'sUid'=>"DEAL4LOANS",'sPwd'=>"DEAL4LOANS");
                
				
        // Call RemoteFunction ()
             
           $info = $soapClient->call("SendPortalLeads", array($ap_param), "https://online.hdfc.com/Push_Portal_Leads/Service.asmx" );
			   
			print_r($info);

		echo $sendResponse = $info['SendPortalLeadsResult'];

if(($recordcount)>0)
		{
				
				$Feedback_ID = $value["REF_ID"];

	
			if($sendResponse!='Success')
			{
				$SMSMessage="HDFC Webservice Error";
				$Phone =9971396361;
				//$sPhone =9891118553;
				
				if(strlen(trim($Phone)) > 0)
				{
				//	SendSMS($SMSMessage, $Phone);
				//SendSMS($SMSMessage, $sPhone);
				}


				$SMShdfcMessage="Deal4Loans webservice getting Error. Reason: ".$sendResponse;
				$hdfcPhone =9833930403;
				$hdfc1Phone =9890516567;


				if(strlen(trim($hdfcPhone)) > 0)
				{
				//SendSMS($SMShdfcMessage, $hdfcPhone);
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
	




}



main();

function main()
{
	hdfchomeloan();

}
   
?>