<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
require_once ("lib/nusoap.php");


function hdfchomeBT()
{
	$today=Date('Y-m-d');
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";

$Dated = ExactServerdate();
$data = array("hdfcstart_time"=>$Dated , "hdfc_bidderid"=>'1' , "hdfc_product"=>'52', "run_date"=>$Dated );
$table = 'hdfc_hlnlap_cronlog';
$instid = Maininsertfunc ($table, $data);

$query1="Select RequestID from Req_Compaign Where (Reply_Type='2' and Bank_Name like'%hdfchlbt%' and BidderID=52)";
echo $query;
	list($rowcount,$row1)=Mainselectfunc($query1,$array = array());
	 $requestid= $row1["RequestID"];
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

	list($recordcount,$posts)=MainselectfuncNew($result,$array = array());

//$xmlstr="";
$i="";
$post="";
$posts="";
	
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
						$xmlstr.='<CUST_REF_TYPE>DEAL4LOANS</CUST_REF_TYPE>';
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

        $soapClient = new soapclient("http://121.240.20.24/Push_Portal_Leads/Service.asmx?WSDL", true);
   
       
			$ap_param=array('sXML'=>"".$xmlstr."",'sUid'=>"DEAL4LOANS",'sPwd'=>"DEAL4LOANS");
                
				
        // Call RemoteFunction ()
             
           $info = $soapClient->call("SendPortalLeads", array($ap_param), "http://121.240.20.24/Push_Portal_Leads/Service.asmx" );
			   
			print_r($info);

		echo $sendResponse = $info['SendPortalLeadsResult'];

if(($recordcount)>0)
		{
				
				$Feedback_ID = $value["REF_ID"];

			
$data = array("hdfc_response"=>$sendResponse , "hdfc_req_id"=>$Feedback_ID, "hdfc_reponse_date"=>$Dated );
$table = 'hdfc_response_data_lap';
$instid = Maininsertfunc ($table, $data);
		$DataArray = array("RequestID"=>$Feedback_ID);
		$wherecondition ="(Reply_Type='2' and Bank_Name Like'%hdfchlbt%' and BidderID=52)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
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
	$Email="mehra3@gmail.com,ranjana@deal4loans.com";
	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		//mail($Email,'HDFC LAP report -Deal4loans', $Content, $headers);
	}
	


}

main();

function main()
{
	
	hdfchomeBT();

}
   

?>