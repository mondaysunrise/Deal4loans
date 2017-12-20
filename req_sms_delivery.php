<?php
//Commented To and CC
//changed on 30july13

	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

function getTableName($pKey)
{
    $titles = array(
        1=> 'Req_Loan_Personal',
        2=> 'Req_Loan_Home',
        3=> 'Req_Loan_Car',
        4=> 'Req_Credit_Card',
        5=> 'Req_Loan_Against_Property',
        6=> 'Req_Business_Loan',
		7=> 'Req_Loan_Gold',
		9=> 'Req_Loan_Education'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
}

function getforsms($pKey){
    $titles = array(
        'Req_Loan_Personal' => 'pl',
        'Req_Loan_Home' => 'hl',
        'Req_Loan_Car' => 'cl',
        'Req_Credit_Card' => 'cc',
        'Req_Loan_Against_Property' => 'lap',
        'Req_Business_Loan' => 'bl',
		'Req_Loan_Gold' => 'gl',
		'Req_Loan_Education' => 'el'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function getleadbysms ($strreply_type, $strbidderid, $requestid, $strmobile_no, $City_Wise, $Reqsmsid)
{
		$append = "";
		
	$City = trim($City_Wise);
	$oldcity = explode(",", $City);
	$newcity = implode ("','",$oldcity) ;
	$reply_type=getTableName($strreply_type);
	$getforsms = getforsms($reply_type);
	$propercity="('".$newcity."')";
	 $SMSMessage="";
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$sms_senddate=date('Y-m-d',$tomorrow);

	 $ctr=1;
if($strreply_type==1)
	{
	$fldssms="Name,Email,City,Mobile_Number,Net_Salary,Company_Name,Loan_Amount,Add_Comment,Employment_Status,Primary_Acc,Loan_Any,CC_Holder";
	}
	elseif($strreply_type==3)
	{
		$fldssms="Name,Email,City,Mobile_Number,Net_Salary,Company_Name,Loan_Amount,Add_Comment,Employment_Status,Car_Model,Car_Type";
	}
	else
	{
$fldssms="Name,Email,City,Mobile_Number,Net_Salary,Company_Name,Loan_Amount,Add_Comment,Employment_Status";
	}

if($strreply_type==1)
	{ $tblminname="Req_Feedback_Bidder_PL";}

elseif($strreply_type==2)

	{$tblminname="Req_Feedback_Bidder_HL";}
elseif($strreply_type==3)

	{$tblminname="Req_Feedback_Bidder_CL";}

elseif($strreply_type==4)
	{ $tblminname="Req_Feedback_Bidder_CC";}

elseif($strreply_type==5)
	{$tblminname="Req_Feedback_Bidder_LAP";}
else
	{
$tblminname="Req_Feedback_Bidder1";
	}


$selreq=d4l_ExecQuery("Select AllRequestID From ".$tblminname." Where (Feedback_ID=".$requestid." and Allocation_Date between '".$sms_senddate." 19:30:00' and '".$sms_senddate." 23:59:59')");
$row1=d4l_mysql_fetch_array($selreq);
$CustrequestID = $row1["AllRequestID"];

	if((strlen(trim($CustrequestID))>0))
	{
		$search_query="SELECT ".$fldssms." FROM ".$reply_type." WHERE (RequestID=".$CustrequestID.")";
	}
	
	echo "query2::".$search_query."<br>";
	$result = d4l_ExecQuery($search_query);
	$recorcount = d4l_mysql_num_rows($result);
	//echo "get bidder no::".$strmobile_no."<br>";

	 $currentdate=date('d-m-Y');
	
if ($myrow = d4l_mysql_fetch_array($result))
	{
	$SMSMessage="";
	$SMSMessageCiti="";
	 $SMSMessagecitifin="";
	 $SMSMessage1596="";
	 $SMSMessagecitibank="";
			
		do
		{
			//$SMSMessage="";
			$request=$requestid;
			$Name=trim($myrow["Name"]);
			$Email=trim($myrow["Email"]);
			$City=trim($myrow["City"]);
			$Phone=trim($myrow["Mobile_Number"]);
			$Net_Salary=trim($myrow["Net_Salary"]);
			$Company_Name =trim($myrow["Company_Name"]);
			$Loan_Amount=trim($myrow["Loan_Amount"]);
			
			$Add_Comment=trim($myrow["Add_Comment"]);
			
			if($reply_type=="Req_Loan_Personal")
			{
				$Primary_Acc=trim($myrow["Primary_Acc"]);
				$Employment_Status =trim($myrow["Employment_Status"]);
				if($Employment_Status==1)
				{
					$emp_stat="Salaried";
				}
				else
				{
					$emp_stat="Self Emp";
				}
				$Loan_Any=trim($myrow["Loan_Any"]);
				if(strlen($Loan_Any)>0)
				{
					$loan_any="Loan";
				}


				$CC_Holder=trim($myrow["CC_Holder"]);
				if($CC_Holder==1)
				{
					$cc="CC";
				}
			}
			if($reply_type=="Req_Loan_Car")
			{
				$Car_Model=trim($myrow["Car_Model"]);
				$Car_Type=trim($myrow["Car_Type"]);
				if(trim($myrow["Car_Booked"])==1)
				{
					$Car_Booked="yes";
				}
				else
				{
					$Car_Booked="no";
				}

				if($Car_Type==1)
				{
					$CarType="New Car";
				}
				else
				{
					$CarType="Used Car";
			}
			}

if($reply_type=="Req_Loan_Personal")
			{
	
		$message ="Your Personal loan Leads on (".$currentdate.") : ";
	$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc;

		$SMSMessage1596=$SMSMessage1596."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",city-".$City;

		$SMSMessagecitibank=$SMSMessagecitibank."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",LA- ".$Loan_Amount.",".$City;

			}
			elseif($reply_type=="Req_Loan_Home")
			{
				
				$message ="Your Home loan Leads on (".$currentdate.") : ";
				echo $SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.", sal- ".$Net_Salary.", loan amt- ".$Loan_Amount.", property type flat";

				$SMSMessagecitifin=$SMSMessagecitifin."(".$ctr.") ".$Name."-".$Phone." sal- ".$Net_Salary." loan amt- ".$Loan_Amount." ".$Add_Comment."city-".$City;

			}
			else
			{
				

if($strbidderid=="1825")
				{
				$message ="Your Leads for ".$getforsms." on (".$currentdate.") : ";
				echo $SMSMessage=$SMSMessage."Name - ".$Name.", Mobile - ".$Phone.",carbd - ".$Car_Booked.", cartype - ".$CarType;
				
				}
				else
				{
					$message ="Your Leads for ".$getforsms." on (".$currentdate.") : ";
				echo $SMSMessage=$SMSMessage."Name - ".$Name.", Mobile - ".$Phone;

				
				}
						
			}
			
			$SMSMessage = $SMSMessage.$append;
			$SMSMessagecitifin = $append.$SMSMessagecitifin;
			
$SMSMessageCiti=$SMSMessageCiti."(".$ctr.") ".$Name."-".$Phone." | ".$Company_Name." | ".$Primary_Acc;

$SMSMessageCiti = $SMSMessageCiti.$append;

			$ctr=$ctr+1;
	  }while ($myrow = d4l_mysql_fetch_array($result));
		  d4l_mysql_free_result($result);
	}
	//$mobile_no="9811215138";
	if($strbidderid=="1053" || $strbidderid=="1054" || $strbidderid=="1055" || $strbidderid=="1056" || $strbidderid=="1057" || $strbidderid=="1058" || $strbidderid=="2072" || $strbidderid=="2073")
	{
		$selcqry=d4l_ExecQuery("Select last_allocated_to,total_no_agents from lead_allocation_table Where BidderID=1053");
		$slcrow = d4l_mysql_fetch_array($selcqry);
		$last_allocated_to = $slcrow['last_allocated_to'];
		$total_no_agents = $slcrow['total_no_agents'];
$squnce1 = $total_no_agents - $last_allocated_to;

		if($squnce1 >0)
		{
			$nsequence = $last_allocated_to+1;
			
			$squnce = "TC - ".$nsequence;

			$citimap=d4l_ExecQuery("update lead_allocation_table set last_allocated_to='".$nsequence."', total_lead_count='".$request."' where ( BidderId=1053)");
		}
		else
		{     $nsequence=1;
				$squnce =  "TC - 1";
				$n2citimap=d4l_ExecQuery("update lead_allocation_table set last_allocated_to='".$nsequence."', total_lead_count='".$request."' where ( BidderId=1053)");
		}

			if(strlen(trim($SMSMessagecitibank))>0)
		{
				$SMSMessagecitibank=$SMSMessagecitibank.", ".$squnce;


			if(strlen(trim($strmobile_no)) > 0)
			SendSMSforLMS($message.$SMSMessagecitibank, $strmobile_no);
			

		}

	}
	
	elseif($strbidderid=="1110" || $strbidderid=="1111" || $strbidderid=="1112" || $strbidderid=="1113" || $strbidderid=="1114" || $strbidderid=="1115" || $strbidderid=="1116" || $strbidderid=="1482" || $strbidderid=="1483" || $strbidderid=="1477" || $strbidderid=="1476" || $strbidderid=="1447" || $strbidderid=="1466" || $strbidderid=="1631" )
	{
		if(strlen(trim($SMSMessagecitifin))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			  SendSMSforLMS($message.$SMSMessagecitifin, $strmobile_no);
		}
	}
		
	elseif($strbidderid=="2422"  || $strbidderid=="2423" || $strbidderid=="2424" || $strbidderid=="2425" || $strbidderid=="2426" || $strbidderid=="2427" || $strbidderid=="2428" || $strbidderid=="2429" || $strbidderid=="2450" || $strbidderid=="2476" || $strbidderid=="2451")
	{
		if(strlen(trim($SMSMessage1596))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				  SendSMSforLMS($message.$SMSMessage1596, $strmobile_no);
			}
	}
	
	elseif($strbidderid=="2650" || $strbidderid=="2651" || $strbidderid=="2652" || $strbidderid=="2653" || $strbidderid=="2654" || $strbidderid=="2655" || $strbidderid=="2656" || $strbidderid=="2657" || $strbidderid=="2658")
	{
		if(strlen(trim($SMSMessage1596)) > 0)
				 SendSMSforLMS($message.$SMSMessage1596, $strmobile_no);
		
	}
	else
	{ if($reply_type=="Req_Loan_Home")
		{
				if(strlen(trim($strmobile_no)) > 0)
			 	 SendSMSforLMS($message.$SMSMessage, $strmobile_no);
		}
		else
		{
		if(strlen(trim($SMSMessage))>0)
		{
			echo "<br>////FinalMessage////// ".$message."-".$SMSMessage."      ///////////<br>";
			if(strlen(trim($strmobile_no)) > 0)
			 	 SendSMSforLMS($message.$SMSMessage, $strmobile_no);
				
		}
		}
	}
	
	if(($recorcount)>0)
	{
if($requestid>1)
		{
 d4l_ExecQuery("update Req_Compaign set RequestID='".$requestid."' where (Reply_Type=".$strreply_type." and BidderID=".$strbidderid." and City_Wise='".$City_Wise."' and Sms_Flag=1)" );
		
// echo "update Req_Compaign set RequestID='".$requestid."' where (Reply_Type=".$strreply_type." and Bank_Name='".$strbank_name."' and BidderID=".$strbidderid." and City_Wise='".$City_Wise."' and Sms_Flag=1)";
 d4l_ExecQuery("Update Req_Sms_Delivery set smsflag=1 Where (Reqsmsid=".$Reqsmsid." and Sms_Dated between '".$sms_senddate." 00:00:00' and '".$sms_senddate." 23:59:59')");
 }

	}

}

main();

function main()
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$Today=date('Y-m-d',$tomorrow);
	$min_date=$Today." 00:00:00";
	$current=date('Y-m-d');
	$max_date=$current." 23:59:59";

	$selvldsms="select * from Req_Sms_Delivery Where (smsflag=0 and Sms_Dated between '".$min_date."' and '".$max_date."')";
	//$selvldsms="select * from Req_Sms_Delivery Where (Reqsmsid >910)";
	$selvldsmsresult= d4l_ExecQuery($selvldsms);
while($row=d4l_mysql_fetch_array($selvldsmsresult))
	{
	$Reqsmsid = $row["Reqsmsid"];
	$strreply_type = $row["Reply_Type"];
	$strbidderid = $row["BidderID"];
	$requestid = $row["RequestID"];
	$strmobile_no = $row["Mobile_Number"];
	$City_Wise = $row["City_Wise"];
echo	$strreply_type.",".$strbidderid.",".$requestid.",".$strmobile_no.",".$City_Wise.",".$Reqsmsid."<br>";
	echo "<br>";
getleadbysms ($strreply_type, $strbidderid, $requestid,$strmobile_no,$City_Wise, $Reqsmsid);
	}

}
?>