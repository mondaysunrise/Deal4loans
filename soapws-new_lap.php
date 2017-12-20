<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require_once ("lib/nusoap.php");

function hdfchomeloan()
{
$today=Date('Y-m-d');
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

$Dated = ExactServerdate();
$data = array("hdfcstart_time"=>$Dated , "hdfc_bidderid"=>'1' , "hdfc_product"=>'52', "run_date"=>$Dated );
$table = 'hdfc_hlnlap_cronlog';
$instid = Maininsertfunc ($table, $data);
$query1="Select RequestID from Req_Compaign Where (Reply_Type='5' and Bank_Name like'%hdfcbank%' and BidderID=2245)";
echo $query;
	list($rowcount,$row1)=Mainselectfunc($query1,$array = array());
	 $requestid= $row1["RequestID"];

	 //echo "hello".$requestid;
	if((strlen(trim($requestid))<=0))
	{
	
		$query="SELECT Feedback_ID AS REF_ID, Name AS CUST_NAME, Email AS CUST_EMAIL, Mobile_Number AS CUST_MOBILE, DOB AS CUST_DOB, City AS CUST_CITY,City_Other AS Cust_OtherCity,Pincode AS CUST_PINCODE,Employment_Status AS CUST_OCCUPATION, TRUNCATE(Net_Salary,0) AS CUST_INCOME,TRUNCATE(Loan_Amount,0) AS CUST_LOANAMT,TRUNCATE(Property_Value,0) AS CUST_PROPERTYVALUE,Company_Name AS CUST_EMPLOYER ,Property_Loc AS CUST_PROPLOCATION FROM Req_Feedback_Bidder1,Req_Loan_Against_Property LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Against_Property.RequestID AND Req_Feedback.BidderID=2245 WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Against_Property.RequestID and Req_Feedback_Bidder1.BidderID = 2245 and (Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";
	}
	else
	{
	
	
	$query="SELECT Feedback_ID AS REF_ID, Name AS CUST_NAME, Email AS CUST_EMAIL, Mobile_Number AS CUST_MOBILE, DOB AS CUST_DOB, City AS CUST_CITY,City_Other AS Cust_OtherCity,Pincode AS CUST_PINCODE,Employment_Status AS CUST_OCCUPATION, TRUNCATE(Net_Salary,0) AS CUST_INCOME,TRUNCATE(Loan_Amount,0) AS CUST_LOANAMT,TRUNCATE(Property_Value,0) AS CUST_PROPERTYVALUE,Company_Name AS CUST_EMPLOYER ,Property_Loc AS CUST_PROPLOCATION FROM Req_Feedback_Bidder1,Req_Loan_Against_Property LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Against_Property.RequestID AND Req_Feedback.BidderID=2245 WHERE Req_Feedback_Bidder1.AllRequestID= Req_Loan_Against_Property.RequestID and Req_Feedback_Bidder1.BidderID = 2245 and Req_Feedback_Bidder1.Feedback_ID>'".$requestid."' and (Req_Feedback_Bidder1.Allocation_Date between '".$mindate."' and '".$maxdate."')";
	

	}
	

// fetch leads from database
echo $query."<br>";
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
	$Email="mehra3@gmail.com,ranjana@deal4loans.com";
	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		mail($Email,'HDFC LAP report -Deal4loans', $Content, $headers);
	}
	


}



main();

function main()
{
	hdfchomeloan();

}
   
?>