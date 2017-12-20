<?php
//This file is incomplete 
require 'scripts/db_init.php';
require 'scripts/functions.php';
require_once ("lib/nusoap.php");

function hdfchomeloan()
{


	$query="SELECT Feedback_ID AS REF_ID, Name AS CUST_NAME, Email AS CUST_EMAIL, Mobile_Number AS CUST_MOBILE, DOB AS CUST_DOB, City AS CUST_CITY,City_Other AS Cust_OtherCity,Pincode AS CUST_PINCODE,Employment_Status AS CUST_OCCUPATION, TRUNCATE(Net_Salary,0) AS CUST_INCOME,TRUNCATE(Loan_Amount,0) AS CUST_LOANAMT,TRUNCATE(Property_Value,0) AS CUST_PROPERTYVALUE,Company_Name AS CUST_EMPLOYER ,Property_Loc AS CUST_PROPLOCATION FROM Req_Feedback_Bidder1,Req_Loan_Home LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Home.RequestID AND Req_Feedback.BidderID=1329 WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Home.RequestID and Req_Feedback_Bidder1.BidderID = 1329 and Req_Feedback_Bidder1.Feedback_ID in (867484,867540,867543,867545,867549,867551,867555,867567,867570,867572,867574,867576,867591,867594,867596,867599,867647,867648,867670,867674,867685,867688,867689,867690,867713,867717,867719,867723,867725,867726,867844,867861,867863,867893,867913,867942,867963,867965,867982,867983,867984,867985,867987,867989,867992,867994,867996,868022,868066,868069,868075,868079,868080,868082,868085,868088,868100,868101,868102,868104,868114,868117,868119,868124)";

// fetch leads from database

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
					
					}
					$xmlstr.='</'.$key.'>';
					
				}
				
			}
			

		//}
		$xmlstr.='</Deal4loans>';

echo $xmlstr."<br><br>";
if(strlen($xmlstr)>0 && ($recordcount)>0)
	{

	ExecQuery("insert hdfc_homeloan_lead_data (Serial_No,Name,Mobile,Reference_id,Dated ) Values ('','".$value['CUST_NAME']."','".$value['CUST_MOBILE']."','".$value["REF_ID"]."',Now())");
	
	//https://jogint0.hdfcindia.com/Push_Portal_Leads/Service.asmx?WSDL
	//https://121.240.20.24/Push_Portal_Leads/Service.asmx?WSDL

	//end to fetch data from database

        $soapClient = new soapclient("https://jogint0.hdfcindia.com/Push_Portal_Leads/Service.asmx?WSDL", true);
   
       
			$ap_param=array('sXML'=>"".$xmlstr."",'sUid'=>"DEAL4LOANS",'sPwd'=>"DEAL4LOANS");
                
				
        // Call RemoteFunction ()
             
           $info = $soapClient->call("SendPortalLeads", array($ap_param), "https://jogint0.hdfcindia.com/Push_Portal_Leads/Service.asmx" );
			   
			print_r($info);

		echo $sendResponse = $info['SendPortalLeadsResult'];

if(($recordcount)>0)
		{
				
				$Feedback_ID = $value["REF_ID"];

		ExecQuery("insert hdfc_response_data (hdfcresid,hdfc_response,hdfc_req_id,hdfc_reponse_date) Values ('','".$sendResponse."','".$Feedback_ID."', Now())");
		//echo "insert hdfc_response_data (hdfcresid,hdfc_response,hdfc_req_id) Values ('','".$sendResponse."','".$Feedback_ID."')";

	//	ExecQuery("update Req_Compaign set RequestID='".$Feedback_ID."' where Reply_Type='2' and Bank_Name Like'%hdfcbank%' and BidderID=1329");	


			//echo "update Req_Compaign set RequestID='".$Feedback_ID."' where Reply_Type='2' and Bank_Name Like'%hdfcbank%' and BidderID=1329";
			if($sendResponse!='Success')
			{
				$SMSMessage="HDFC Webservice Error";
				$Phone =9811215138;
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
				//SendSMS($SMShdfcMessage, $hdfcPhone);
				//SendSMS($SMShdfcMessage, $hdfc1Phone);
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