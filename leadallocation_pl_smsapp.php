<?php
function filter_blank($var) 
{
        return !(empty($var) || is_null($var));
}

/***********************************************
This function is used to get the name of the 
database table when we provide Product Code
***********************************************/
//function getTableName Start
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
//function getTableName End
//
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
//
//function for email
function getforemailer($pKey){
    $titles = array(
        '1' => 'Personal Loan',
        '2' => 'Home Loan',
        '3' => 'Car Loan',
        '4' => 'Credit Card',
        '5' => 'Loan Against Property',
        '6' => 'Business Loan',
		'7' => 'Gold Loan',
		'9' => 'Education Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function leadallocation($LeadID, $Customer_City, $allocatesource)
{
	//echo $LeadID."----".$Customer_City;
	//echo "<br>";
	$today = date('Y-m-d');
if($allocatesource=="SMS_Lead_Appointment_Model")
	{
	$qry2= "select * from Req_Feedback_Bidder_PL1 Where (Consent=1 and AllRequestID='".$LeadID."') order by Allocation_Date DESC Limit 0,1";
	}
	else
	{
$qry2= "select * from Req_Feedback_Bidder_PL1 Where (Consent=1 and AllRequestID='".$LeadID."') order by Allocation_Date DESC Limit Limit 0,1";
	}
$result2 = ExecQuery($qry2);
//echo "<br><br>";
$recordcount2 = mysql_num_rows($result2);
$GetBidderID = '';
$BankNameID='';
	if($recordcount2>0)
	{
	while($cust2=mysql_fetch_array($result2))
		{
			$AllRequestID = $cust2["AllRequestID"];
			$BidderID = $cust2["BidderID"];
			$ProductType = $cust2["Reply_Type"];
			$Feedback_ID = $cust2["Feedback_ID"];
			$checkfinal_alocate=ExecQuery("select AllRequestID from Req_Feedback_Bidder1 where (Reply_Type=1 and AllRequestID='".$AllRequestID."' and BidderID='".$BidderID."' and Allocation_Date between '".$today." 00:00:00' and '".$today." 23:59:59')");
			$recordcount_alocate = mysql_num_rows($checkfinal_alocate);
			//echo "<br>select AllRequestID from Req_Feedback_Bidder1 where (AllRequestID='".$AllRequestID."' and BidderID='".$BidderID."' and Allocation_Date between '".$today." 00:00:00' and '".$today." 23:59:59')<br>";
			
			if($recordcount_alocate>0)
			{}
			else
			{
				$InsertFeedBackSql = "Insert into Req_Feedback_Bidder1 (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('".$AllRequestID."', '".$BidderID."','".$ProductType."', Now())";
			
			$InsertFeedBackResult = ExecQuery($InsertFeedBackSql);
			 $final_allocation="INSERT Req_Feedback_Bidder_PL (AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$AllRequestID."','".$BidderID."','".$ProductType."', Now())";
			$final_allocationresult = ExecQuery($final_allocation);
			$recordLastInserted = mysql_insert_id();
			$recordcountA[] = $recordLastInserted;
			
			$final_allocation_comments ="INSERT into Req_Feedback_Comments_PL (Feedback_ID,AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUES ('".$recordLastInserted."', '".$AllRequestID."','".$BidderID."','".$ProductType."', Now())";
			$final_allocation_commentsresult = ExecQuery($final_allocation_comments);
	
		 $updateFeedbackSql = "Update Req_Compaign set RequestID='".$Feedback_ID."' Where Bank_Name='PersonalLoan' and Compaign_ID=4037";
		//$updateFeedbackQuery = ExecQuery($updateFeedbackSql);
		$updateFinalAllocate = "Update Req_Feedback_Bidder_PL1 set final_allocate=1 Where (AllRequestID='".$AllRequestID."' and BidderID='".$BidderID."')";
		ExecQuery($updateFinalAllocate);

			$UpdateBidders = "UPDATE `Bidders_List` SET `Last_allocation` = '1', `Last_set_select` = '1' WHERE `BidderID` = '".$BidderID."' and Reply_Type=".$ProductType;
			//echo "<br><br>";			
			ExecQuery($UpdateBidders);
			$getConflictBidderSql = ExecQuery("select Conflict_Bidder, BankID from Bidders_List where  BidderID ='".$BidderID."'and Reply_Type='".$ProductType."'");
			
			$getConflictBidderFetch = mysql_fetch_array($getConflictBidderSql);   
		 
			$getConflictBidder = $getConflictBidderFetch[0];
			$getBankNameID = $getConflictBidderFetch[1];
		   
			$arrayConflictBidder = explode(",",$getConflictBidder);
		   
			for($i=0;$i<count($arrayConflictBidder);$i++)
			{
				 $SqlConflictUpdate = "UPDATE `Bidders_List` SET `Last_allocation` = '0', `Last_set_select` = '1' WHERE `BidderID` = '".$arrayConflictBidder[$i]."' and Reply_Type='".$ProductType."'";
				  ExecQuery($SqlConflictUpdate);
				//  echo "<br><br>";
			}

$getValidBiddersForSmsCityWise=ExecQuery("Select City_Wise from req_plcompaign_smscontact Where Sms_Flag=1 and Reply_Type=".$ProductType." and BidderID='".$BidderID."'");
$citwisesms=mysql_fetch_array($getValidBiddersForSmsCityWise);
$strcitywise= $citwisesms['City_Wise'];
if(strlen($strcitywise)>0)
			{
	//echo "I M INSIDE CITY WISE IF BLOCK";
	$getValidBiddersForSms="Select * from req_plcompaign_smscontact Where Sms_Flag=1 and Reply_Type=".$ProductType." and BidderID='".$BidderID."'and City_Wise like '%".$Customer_City."%'";

			}
else
			{
	//echo "I M INSIDE CITY WISE IN ELSE BLOCK";
 $getValidBiddersForSms="Select * from req_plcompaign_smscontact Where Sms_Flag=1 and Reply_Type=".$ProductType." and BidderID='".$BidderID."' and City_Wise='' ";
// echo "<br><br>";
			}

	$getbidderresult=ExecQuery($getValidBiddersForSms);
	$Bidderrecorcount = mysql_num_rows($getbidderresult);
	if($Bidderrecorcount>0)
	{
		$ShowDate = date("H:i:s");
		$StartTime = "08:00:00";
		$EndTime = "19:30:00";	

		for($i=0;$i<$Bidderrecorcount;$i++)
		{
			 $Reply_Type = mysql_result($getbidderresult,$i,'Reply_Type');
			 $Bank_Name = mysql_result($getbidderresult,$i,'Bank_Name');
			 $BidderID = mysql_result($getbidderresult,$i,'BidderID');
			 $RequestID = mysql_result($getbidderresult,$i,'RequestID');
			 $Start_Date = mysql_result($getbidderresult,$i,'Start_Date');
			 $Mobile_no = mysql_result($getbidderresult,$i,'Mobile_no');
			 $City_Wise = mysql_result($getbidderresult,$i,'City_Wise');
			 	
			if($ShowDate > $StartTime && $ShowDate < $EndTime)			
			{
				//echo "<br>".$Reply_Type."--".$Bank_Name."--".$BidderID."--".$RequestID."--".$Start_Date."--".$Mobile_no."--".$City_Wise."--".$BiddersList."<br>";
				getleadbysms($Reply_Type,$Bank_Name,$BidderID,$RequestID,$Start_Date,$Mobile_no,$City_Wise,$BiddersList);

			}
			else
			{
				$getsmslead="INSERT INTO Req_Sms_Delivery (Reply_Type, BidderID, RequestID, Mobile_Number, City_Wise, Sms_Dated) VAlues ('".$Reply_Type."', '".$BidderID."', '".$recordLastInserted."', '".$Mobile_no."', '".$City_Wise."', Now())";
				ExecQuery($getsmslead);
			}
		}
	}

	/*if($BidderID==3417 || $BidderID==3431)
				{
					sendleadintimate($BidderID,$Customer_City,$LeadID);
				}*/

			}
$BankNameID[] = $BidderID; 
		}
	}
$BankNameID = array_filter($BankNameID, "filter_blank"); 
$GetBidderID = implode(',',$BankNameID);
	if(count($BankNameID)>0 && $BankNameID[0]>0)
	{
		if($ProductType ==2 || $ProductType ==1 || $ProductType ==5 || $ProductType ==4 || $ProductType ==3 )
		{
			$GetBidderID = implode(',',$BankNameID);
			if(strlen($GetBidderID)>0)
			{
				//echo $getBankNameID." - ".$Mobile_no."<br><br>";
				//echo "249 -  - ".$GetBidderID."--".$LeadID."--".$ProductType;
				getBidderContactDetailsToCustomers($ProductType,$GetBidderID,$LeadID, $getBankNameID,$Mobile_no);
				SendMailToCustomers($GetBidderID,$LeadID,$ProductType,$getBankNameID,$Mobile_no);
			}
		}	
	}
	$RecordCount = count($BankNameID);
	updateBidderCountinProduct($ProductType, $RecordCount, $LeadID);
}

//function updateBidderCountinProduct Start
function updateBidderCountinProduct($ProductType, $RecordCount, $LeadID)
{	   
	$Table = getTableName($ProductType);	
	
	$updateBidderCount= "update ".$Table." set Allocated='1', Bidder_Count=Bidder_Count+1 where RequestID='".$LeadID."'";
	//echo "bidder count: ".$updateBidderCount."<br><br>";
    ExecQuery($updateBidderCount);
}
//function updateBidderCountinProduct End


function getleadbysms ($strreply_type, $strbank_name, $strbidderid, $requestid, $strstart_date, $strmobile_no,$City_Wise,$BiddersList)
{
	//echo "sms sent";
	//$strmobile_no = 9971396361;
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$sms_senddate=date('Y-m-d',$tomorrow);

		$append = "";
		$all_BiddersSet = explode(",", $BiddersList);
		$allBidders_Set = array_filter($all_BiddersSet, "filter_blank"); 	
		if((count($allBidders_Set)==1) && $allBidders_Set[0]>0)
		{
			//$append = " [Exclusive Lead] ";
			$append = "";
		}
		else
		{
			$append = "";
		}
			
	$City = trim($City_Wise);
		
		$oldcity = explode(",", $City);
		$newcity = implode ("','",$oldcity) ;
			//echo $newcity."<br>";
			$propercity="('".$newcity."')";
	//getleadbysms($Reply_Type,$Bank_Name,$BidderID,$RequestID,$Start_Date,$Mobile_no);
	$reply_type=getTableName($strreply_type);
	$getforsms=getforsms($reply_type);
	
	 $SMSMessage="";
	
	 $ctr=1;
if($strreply_type==1)
	{
	$fldssms="source,Existing_Loan,Feedback_ID,Name,Email,City,Mobile_Number,Net_Salary,Company_Name,Loan_Amount,Add_Comment,Employment_Status,Primary_Acc,Loan_Any,CC_Holder";
	}
	elseif($strreply_type==3)
	{
		$fldssms="Feedback_ID,Name,Email,City,Mobile_Number,Net_Salary,Company_Name,Loan_Amount,Add_Comment,Employment_Status,Car_Model,Car_Type";
	}
	else
	{
$fldssms="Feedback_ID,Name,Email,City,Mobile_Number,Net_Salary,Company_Name,Loan_Amount,Add_Comment,Employment_Status";
	}

if($strreply_type==4)
			{
				$feedback_tble="Req_Feedback_Bidder_CC";
			}
			else
			{
				$feedback_tble="Req_Feedback_Bidder1";
			}

	if((strlen(trim($requestid))<=0))
	{
		if(strlen($City)>0)
		{
			$search_query="SELECT ".$fldssms." FROM ".$feedback_tble.",".$reply_type." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$reply_type.".RequestID AND Req_Feedback.BidderID= ".$strbidderid." WHERE ".$feedback_tble.".AllRequestID= ".$reply_type.".RequestID and ".$feedback_tble.".BidderID = ".$strbidderid." and ".$reply_type.".City in ".$propercity." and (".$feedback_tble.".Allocation_Date >='".$sms_senddate." 00:00:00' and ".$reply_type.".Dated >='".$sms_senddate." 00:00:00') ";

		}
		else{	
		$search_query="SELECT ".$fldssms." FROM ".$feedback_tble.",".$reply_type."  WHERE ".$feedback_tble.".AllRequestID= ".$reply_type.".RequestID and ".$feedback_tble.".BidderID = ".$strbidderid." and (".$feedback_tble.".Allocation_Date >='".$sms_senddate." 00:00:00') ";
		}
	}
	else
	{
		if(strlen($City)>0)
		{
			$search_query="SELECT ".$fldssms." FROM ".$feedback_tble.",".$reply_type." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$reply_type.".RequestID AND Req_Feedback.BidderID= ".$strbidderid." WHERE ".$feedback_tble.".Feedback_ID>'$requestid' and ".$feedback_tble.".AllRequestID= ".$reply_type.".RequestID and ".$feedback_tble.".BidderID = ".$strbidderid." and ".$reply_type.".City in ".$propercity." and (".$feedback_tble.".Allocation_Date >='".$sms_senddate." 00:00:00' and ".$reply_type.".Dated >='".$sms_senddate." 00:00:00') ";
		}
		else
		{
		$search_query="SELECT ".$fldssms." FROM ".$feedback_tble.",".$reply_type." WHERE ".$feedback_tble.".Feedback_ID>'$requestid' and ".$feedback_tble.".AllRequestID= ".$reply_type.".RequestID and ".$feedback_tble.".BidderID = ".$strbidderid." and (".$feedback_tble.".Allocation_Date >='".$sms_senddate." 00:00:00') ";
		}
	}
	//echo "query2::".$search_query."<br>";
	$result = ExecQuery($search_query);
	$recorcount = mysql_num_rows($result);
	//echo "get bidder no::".$strmobile_no."<br>";

	 $currentdate=date('d-m-Y');
	
if ($myrow = mysql_fetch_array($result))
	{
	$SMSMessage="";
	$SMSMessageCiti="";
	$smsforbidderid1160="";
	 $SMSMessagecitifin="";
	 $SMSMessagefullteron="";
	 $SMSMessagefor1512="";
	 $SMSMessage1596="";
	 $SMSMessage1705="";
	 $SMSMessage1537="";
	 $SMSMessagecitibank="";
	 $SMSMessage2843="";
	 $SMSMessage2917="";
	 $SMSMegWidBankName="";
	 $appendMsg = ""; 
	 $SMSMessageplbt = "";
	 $SMSMessagehdfc = "";
	 $SMSMsghdfcsmallcity = "";
			
		do
		{
			//$SMSMessage="";
			$source=trim($myrow["source"]);
			$request=trim($myrow["Feedback_ID"]);
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
				$Existing_Loan=trim($myrow["Existing_Loan"]);
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
			
if($reply_type=="Req_Loan_Personal")
			{
			$message ="Your Personal loan Leads on (".$currentdate.") : ";
		$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc;
		$SMSMessagehdfc=$SMSMessagehdfc."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.", Code : 88152";

		$SMSMsghdfcsmallcity=$SMSMsghdfcsmallcity."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc- 88152,city-".$City;

		$SMSMessagefullsp=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-Login Code MA002";

			$SMSMessageful=$SMSMessageful."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",city-".$City.",".$emp_stat;

				$SMSMessagefullteron=$SMSMessagefullteron."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",".$emp_stat;

				$SMSMessage1596=$SMSMessage1596."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",city-".$City;

				$SMSMessage1705=$SMSMessage1705."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",".$strbank_name;

				$SMSMessage1537=$SMSMessage1537."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc."LA-".$Loan_Amount;

				$SMSMessagecitibank=$SMSMessagecitibank."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",LA- ".$Loan_Amount.",".$City;

			$SMSMessageplbt=$SMSMessageplbt."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",LA- ".$Existing_Loan.",".$City." BT";

				$SMSMessage2917=$SMSMessage2917."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",LA-".$Loan_Amount;

				$SMSMegWidBankName=$SMSMegWidBankName."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.", ".$strbank_name;

if($strbidderid=="3003" || $strbidderid=="3002" || $strbidderid=="5566")				{	$cde="TC1";			}
	if($strbidderid=="3801" || $strbidderid=="3654" || $strbidderid=="5203")			{					$cde="TC2";				}
				$SMSMsgforkotak=$SMSMsgforkotak."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",Acc-".$Primary_Acc.",".$cde;
			}
			else
			{
				$message ="Your Leads for ".$getforsms." on (".$currentdate.") : ";
				$SMSMessage=$SMSMessage."Name - ".$Name.", Mobile - ".$Phone;
				$SMSMessage1688=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.", ".$CarType.", ".$Car_Model;
				$SMSMessagefor1512=$SMSMessagefor1512."(".$ctr.") ".$Name."-".$Phone."-".$Email;
			}
			$SMSMessage = $SMSMessage.$append;
			$SMSMessagecitifin = $append.$SMSMessagecitifin;
			//$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone;
			//echo $SMSMessage;

$SMSMessageCiti=$SMSMessageCiti."(".$ctr.") ".$Name."-".$Phone." | ".$Company_Name." | ".$Primary_Acc;
$smsforbidderid1160=$smsforbidderid1160."(".$ctr.") ".$Name."-".$Phone.",sal- ".$Net_Salary.",loan amt- ".$Loan_Amount.",barclays";
$SMSMessageCiti = $SMSMessageCiti.$append;

			$ctr=$ctr+1;
	  }while ($myrow = mysql_fetch_array($result));
		  mysql_free_result($result);
	}
	//$mobile_no="9811215138";
	if($strbidderid=="1053" || $strbidderid=="1054" || $strbidderid=="1055" || $strbidderid=="1056" || $strbidderid=="1057" || $strbidderid=="1058" || $strbidderid=="2072" || $strbidderid=="2073")
	{
		$selcqry=ExecQuery("Select last_allocated_to,total_no_agents from lead_allocation_table Where BidderID=1053");
		$slcrow = mysql_fetch_array($selcqry);
		$last_allocated_to = $slcrow['last_allocated_to'];
		$total_no_agents = $slcrow['total_no_agents'];
$squnce1 = $total_no_agents - $last_allocated_to;

		if($squnce1 >0)
		{
			$nsequence = $last_allocated_to+1;
			$squnce = "TC - ".$nsequence;
			$citimap=ExecQuery("update lead_allocation_table set last_allocated_to='".$nsequence."', total_lead_count='".$request."' where ( BidderId=1053)");
		}
		else
		{     $nsequence=1;
				$squnce =  "TC - 1";
				$n2citimap=ExecQuery("update lead_allocation_table set last_allocated_to='".$nsequence."', total_lead_count='".$request."' where ( BidderId=1053)");
		}
		if(strlen(trim($SMSMessagecitibank))>0)
		{
			$SMSMessagecitibank=$SMSMessagecitibank.", ".$squnce;
			if(strlen(trim($strmobile_no)) > 0)
			{
			 SendSMSforLMS($message.$SMSMessagecitibank, $strmobile_no);
			}
		}
	}
	elseif($strbidderid=="4174" || $strbidderid=="4173" || $strbidderid=="4175" || $strbidderid=="4178")
	{	if(strlen(trim($strmobile_no)) > 0)
			{
			 SendSMSforLMS($message.$SMSMessageplbt, $strmobile_no);
			}
	}
	elseif(($strbidderid=="3558") && $source=="fullertonmlr")
	{
		$ccstrmobile_no=9004682240;
		$cc2strmobile_no=9987500420;
		if(strlen(trim($strmobile_no)) > 0)
			 {
				SendSMSforLMS($message.$SMSMessage, $strmobile_no);
				SendSMSforLMS($message.$SMSMessage, $ccstrmobile_no);
				SendSMSforLMS($message.$SMSMessage, $cc2strmobile_no);
			 }
	}
	elseif(($strbidderid=="3574") && $source=="fullertonmlr")
	{
		$ccstrmobile_no=9810400223;
		$cc2strmobile_no=9871500466;
		if(strlen(trim($strmobile_no)) > 0)
			 {
				SendSMSforLMS($message.$SMSMessage, $strmobile_no);
				SendSMSforLMS($message.$SMSMessage, $ccstrmobile_no);
				SendSMSforLMS($message.$SMSMessage, $cc2strmobile_no);
			 }
	}
	elseif($strbidderid=="1160")
	{
		if(strlen(trim($smsforbidderid1160))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
			 SendSMSforLMS($message.$smsforbidderid1160, $strmobile_no);
			}
			//if(strlen(trim($mobile_no)) > 0)
			// SendSMS($message.$SMSMessageCiti, $mobile_no);
		}
	}
	elseif ($strbidderid=="1888" || $strbidderid=="2627" || $strbidderid=="3036" || $strbidderid=="4648" || $strbidderid=="2628" || $strbidderid=="2626" || $strbidderid=="1950" || $strbidderid=="4403" || $strbidderid=="4804" || $strbidderid=="2629" || $strbidderid=="5313" || $strbidderid=="1891" || $strbidderid=="1958" || $strbidderid=="5315" || $strbidderid=="1959" || $strbidderid=="5317" || $strbidderid=="1957" || $strbidderid=="5314" || $strbidderid=="1960" || $strbidderid=="5316")
	{
		if(strlen(trim($SMSMessagehdfc))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 {
				SendSMSforLMS($message.$SMSMessagehdfc, $strmobile_no);
			}
		}
	}
	elseif ($strbidderid=="4931" || $strbidderid=="4932" || $strbidderid=="4933" || $strbidderid=="4934" || $strbidderid=="4935" || $strbidderid=="4936" || $strbidderid=="4940" || $strbidderid=="4948" || $strbidderid=="4950" || $strbidderid=="4952" || $strbidderid=="4957" || $strbidderid=="4963" || $strbidderid=="4966" || $strbidderid=="4971" || $strbidderid=="4977" || $strbidderid=="4980" || $strbidderid=="4990" || $strbidderid=="5001" || $strbidderid=="5003" || $strbidderid=="5015" || $strbidderid=="5016" || $strbidderid=="5023" || $strbidderid=="5024" || $strbidderid=="5025" || $strbidderid=="5027" || $strbidderid=="5029" || $strbidderid=="5033" || $strbidderid=="5047" || $strbidderid=="5061" || $strbidderid=="5063" || $strbidderid=="5374" || $strbidderid=="4939" || $strbidderid=="4962" || $strbidderid=="4937" || $strbidderid=="5066" || $strbidderid=="4943" || $strbidderid=="4949" || $strbidderid=="4951" || $strbidderid=="4967" || $strbidderid=="5508" || $strbidderid=="4954" || $strbidderid=="4960" || $strbidderid=="4971" || $strbidderid=="5008" || $strbidderid=="5064" || $strbidderid=="5058" || $strbidderid=="5057" || $strbidderid=="5056" || $strbidderid=="5055" || $strbidderid=="5046" || $strbidderid=="5042" || $strbidderid=="5034" || $strbidderid=="5002" || $strbidderid=="4959" || $strbidderid=="4976" || $strbidderid=="4972" || $strbidderid=="4970" || $strbidderid=="4964" || $strbidderid=="5006" || $strbidderid=="5009" || $strbidderid=="5012" || $strbidderid=="5021" || $strbidderid=="5028" || $strbidderid=="5031" || $strbidderid=="5038" || $strbidderid=="4995" || $strbidderid=="4946" || $strbidderid=="5791")
	{
		if(strlen(trim($SMSMsghdfcsmallcity))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 {
				SendSMSforLMS($message.$SMSMsghdfcsmallcity, $strmobile_no);
			}
		}
	}	
	elseif ($strbidderid=="2422" || $strbidderid=="2423" || $strbidderid=="2424" || $strbidderid=="2425" || $strbidderid=="3645" || $strbidderid=="2426" || $strbidderid=="2427" || $strbidderid=="2428" || $strbidderid=="2429" || $strbidderid=="3335" || $strbidderid=="2430" || $strbidderid=="2431" || $strbidderid=="2432" || $strbidderid=="2433" || $strbidderid=="2434" || $strbidderid=="2435" || $strbidderid=="2436" || $strbidderid=="2437" || $strbidderid=="2438" || $strbidderid=="2439" || $strbidderid=="2440" || $strbidderid=="2441" || $strbidderid=="2442" || $strbidderid=="2443" || $strbidderid=="2444" || $strbidderid=="2445" || $strbidderid=="2446" || $strbidderid=="2447" || $strbidderid=="2449" || $strbidderid=="2450" || $strbidderid=="2451" || $strbidderid=="2476" || $strbidderid=="3629" || $strbidderid=="3842" || $strbidderid=="3953" || $strbidderid=="3966" || $strbidderid=="3967" || $strbidderid=="4466" || $strbidderid=="4467" || $strbidderid=="1675" || $strbidderid=="4468" || $strbidderid=="4469" || $strbidderid=="4470" || $strbidderid=="4471" || $strbidderid=="4472"  || $strbidderid=="4912"  || $strbidderid=="4911")
	{
		if($strbidderid=="3967")
			{$asmname=" Ash";} elseif($strbidderid=="3966"){$asmname=" NY";}elseif($strbidderid=="2423"){$asmname=" San";}elseif($strbidderid=="2425"){$asmname=" VS";}elseif($strbidderid=="3842"){$asmname=" SB";}elseif($strbidderid=="2429"){$asmname=" KD";}elseif($strbidderid=="3335"){$asmname=" SN";}

if($strbidderid=="3966" || $strbidderid=="3967" || $strbidderid=="2423" || $strbidderid=="2425" || $strbidderid=="3335" || $strbidderid=="3842" || $strbidderid=="2429")
		{
	if(strlen(trim($strmobile_no)) > 0)
		{
			 SendSMSforLMS($message.$SMSMessagecitibank.$asmname, $strmobile_no);
		}
		}
		else
		{
		if(strlen(trim($strmobile_no)) > 0)
		{
			 SendSMSforLMS($message.$SMSMessagecitibank, $strmobile_no);
		}
		}
		if($strbidderid==2425 || $strbidderid==3645 || $strbidderid==3842 || $strbidderid==2428 || $strbidderid==2429 ||  $strbidderid==3335 || $strbidderid==3953 || $strbidderid==2433 ||  $strbidderid==2435 || $strbidderid==2444)
		{
			$strRMmobile_no=9822116091;
			SendSMSforLMS($message.$SMSMessagecitibank, $strRMmobile_no);
		}
	}
	elseif($strbidderid=="1110" || $strbidderid=="1111" || $strbidderid=="1112" || $strbidderid=="1113" || $strbidderid=="1114" || $strbidderid=="1115" || $strbidderid=="1116" || $strbidderid=="1482" || $strbidderid=="1483" || $strbidderid=="1477" || $strbidderid=="1476" || $strbidderid=="1447" || $strbidderid=="1466" || $strbidderid=="1631" || $strbidderid=="2943")
	{
		if(strlen(trim($SMSMessagecitifin))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
			 SendSMSforLMS($message.$SMSMessagecitifin, $strmobile_no);
			}
		}
	}
	else if ($strbidderid=="2917" || $strbidderid=="3254" || $strbidderid=="3255" || $strbidderid=="2962" || $strbidderid=="3256" || $strbidderid =="3257" || $strbidderid =="2983" || $strbidderid =="2984" || $strbidderid =="4815" || $strbidderid =="3258" || $strbidderid =="3259" || $strbidderid=="3061" || $strbidderid =="3132" || $strbidderid =="3133" || $strbidderid =="3134" || $strbidderid=="3195" ||  $strbidderid=="3196" ||  $strbidderid=="3197" ||  $strbidderid=="3198" || $strbidderid=="3199" || $strbidderid=="3216" || $strbidderid=="3241" ||  $strbidderid=="2919" || $strbidderid=="2963" || $strbidderid=="3364" ||  $strbidderid=="3371" || $strbidderid=="3372" || $strbidderid=="3381" || $strbidderid=="3380" || $strbidderid=="3382" || $strbidderid=="3383" || $strbidderid=="2995" || $strbidderid=="3407" || $strbidderid=="3449" || $strbidderid=="3450" || $strbidderid=="3451" || $strbidderid=="3452" || $strbidderid=="3532" || $strbidderid=="3533" || $strbidderid=="3537" || $strbidderid=="3553" || $strbidderid=="3554" || $strbidderid=="3576" || $strbidderid=="3581" || $strbidderid=="3595" || $defrow['BidderID']=="3658" || $strbidderid=="3754" || $strbidderid=="3753" || $strbidderid=="3868" || $strbidderid=="3944" || $strbidderid=="3945" || $strbidderid=="4032" || $strbidderid=="4156" || $strbidderid=="2917" || $strbidderid=="4242" || $strbidderid=="4292" || $strbidderid=="4293" || $strbidderid=="4299" || $strbidderid=="4300" || $strbidderid=="4301" || $strbidderid=="4352" || $strbidderid=="4353" || $strbidderid=="4354" || $strbidderid=="4399" || $strbidderid=="4398" || $strbidderid=="4354" || $strbidderid=="4459" || $strbidderid=="4460" || $strbidderid=="4461" || $strbidderid=="4668" || $strbidderid=="4669" || $strbidderid=="4670" || $strbidderid=="4671" || $strbidderid=="4672" || $strbidderid=="4316" || $strbidderid=="4712" || $strbidderid=="4713" || $strbidderid=="4701" || $strbidderid=="4798" || $strbidderid=="4807" || $strbidderid=="4889" || $strbidderid=="5322")
	{
		if(strlen(trim($SMSMessage2917))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
			 	$appendMsg = " For ICICI Bank Only";
				SendSMSforLMS($message.$SMSMessage2917.$appendMsg, $strmobile_no);
			} 
			 
		}
		
	}
	else if($strbidderid=="3724" || $strbidderid=="3726" || $strbidderid=="3725" || $strbidderid=="3787" || $strbidderid=="3788" || $strbidderid=="4054" || $strbidderid=="4056" || $strbidderid=="4055")
	{
		if(strlen(trim($SMSMessage))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
			 	$appendMsg =" For SCB Only";
				SendSMSforLMS($message.$SMSMessage.$appendMsg, $strmobile_no);
			} 
			 
		}
	}
	else if($strbidderid=="3003" || $strbidderid=="3654" || $strbidderid=="3002" || $strbidderid=="3801"  || $strbidderid=="5203" || $strbidderid=="5566")
	{	
			if(strlen(trim($strmobile_no)) > 0)
			{
			  	SendSMSforLMS($message.$SMSMsgforkotak, $strmobile_no);
			}
	}
	else if ($strbidderid=="2843" || $strbidderid=="2844" || $strbidderid=="2845" || $strbidderid=="2846" || $strbidderid=="3758" || $strbidderid=="3759")
	{
		if(strlen(trim($SMSMessage2843))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
			  	$appendMsg = " For PNB Bank Only";
				SendSMSforLMS($message.$SMSMessage2843.$appendMsg, $strmobile_no);
			}
		}

	}
	elseif(($strbidderid=="1510" || $strbidderid=="2941" || $strbidderid=="1930" || $strbidderid=="3650" || $strbidderid=="2790" || $strbidderid=="3698" || $strbidderid=="3692" || $strbidderid=="3691" || $strbidderid=="3433" || $strbidderid=="3652" || $strbidderid=="3716" || $strbidderid=="2986" || $strbidderid=="3828" || $strbidderid=="3169" || $strbidderid=="2864" || $strbidderid=="4264" || $strbidderid=="3811" || $strbidderid=="4192") && ($reply_type=="Req_Loan_Personal") )
	{
		if(strlen(trim($SMSMegWidBankName))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
			 SendSMSforLMS($message.$SMSMegWidBankName, $strmobile_no);
			 }
		}
	}
	elseif($strbidderid=="1537")
	{
		if(strlen(trim($SMSMessage1537))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
			 SendSMSforLMS($message.$SMSMessage1537, $strmobile_no);
			 }
		}
	}
	elseif($strbidderid=="1037" || $strbidderid=="3118")
	{
		if(strlen(trim($SMSMessageful))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
			 SendSMSforLMS($message.$SMSMessageful, $strmobile_no);
			}
		}
	}
	elseif($strbidderid=="996" || $strbidderid=="997" || $strbidderid=="998" || $strbidderid=="1000" || $strbidderid=="1012" || $strbidderid=="1015" || $strbidderid=="1050")
	{
		if(strlen(trim($SMSMessagefullteron))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
			 SendSMSforLMS($message.$SMSMessagefullteron, $strmobile_no);
			 }
		}
	}
	elseif($strbidderid=="1512")
	{
		if(strlen(trim($SMSMessagefor1512))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				{
				 	SendSMSforLMS($message.$SMSMessagefor1512, $strmobile_no);
				 }
			}
	} 

	elseif($strbidderid=="2973" || $strbidderid=="2974" || $strbidderid=="2975" || $strbidderid=="2932" || $strbidderid=="2930" || $strbidderid=="2896" || $strbidderid=="2933" || $strbidderid=="2929" || $strbidderid=="4031" || $strbidderid=="4035" || $strbidderid=="4036" || $strbidderid=="3994" || $strbidderid=="3995" || $strbidderid=="3996" || $strbidderid=="3997" || $strbidderid=="3998" || $strbidderid=="3999" || $strbidderid=="4030" || $strbidderid=="2927" || $strbidderid=="4075" || $strbidderid=="4076" || $strbidderid=="4754" ||  $strbidderid=="4755" ||  $strbidderid=="4756" ||  $strbidderid=="1958" ||  $strbidderid=="1959" ||  $strbidderid=="1960" ||  $strbidderid=="1957" || $strbidderid=="5226")
	{
		if(strlen(trim($SMSMessage1596))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
				SendSMSforLMS($message.$SMSMessage1596, $strmobile_no);
			}
		}
	}
	elseif($strbidderid=="1688")
	{
		if(strlen(trim($SMSMessage1688))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 {
				 	SendSMSforLMS($message.$SMSMessage1688, $strmobile_no);
				 }
			}
	}
	elseif($strbidderid=="2650" || $strbidderid=="2651" || $strbidderid=="2652" || $strbidderid=="2653" || $strbidderid=="2654" || $strbidderid=="2655" || $strbidderid=="2656" || $strbidderid=="2657" || $strbidderid=="2658")
	{
		if(strlen(trim($SMSMessage1596)) > 0)
				{
				 SendSMSforLMS($message.$SMSMessage1596, $strmobile_no);
				}
		
	}
	elseif($strbidderid=="1697")
	{
		if(strlen(trim($SMSMessage1697))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				{
				 SendSMSforLMS($message.$SMSMessage1697, $strmobile_no);
				}
			}
	}
	elseif($strbidderid=="1705")
	{
		if(strlen(trim($SMSMessage1705))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				{
				 SendSMSforLMS($message.$SMSMessage1705, $strmobile_no);
				}
			}
	}
	elseif($strbidderid=="2721" || $strbidderid=="2722" || $strbidderid=="2809" || $strbidderid=="2723" || $strbidderid=="2830" || $strbidderid=="2937" || $strbidderid=="3208" || $strbidderid=="3359" || $strbidderid=="3376" || $strbidderid=="3390" || $strbidderid=="3579" || $strbidderid=="3601" || $strbidderid=="3600" || $strbidderid=="3602" || $strbidderid=="3722")// added by Upendra 010912
	{
		if(strlen(trim($SMSMessage))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			{
				$appendMsg = " For Citibank Only";
				SendSMSforLMS($message.$SMSMessage.$appendMsg, $strmobile_no);
			}
		}
	}	
	elseif($strbidderid=="2718" || $strbidderid=="2730" || $strbidderid=="2719" || $strbidderid=="2852" || $strbidderid=="2958" || $strbidderid=="2720" || $strbidderid=="3082" || $strbidderid=="3129" || $strbidderid=="2835" || $strbidderid=="3291" || $strbidderid=="3299")// added by Upendra 010912
	{
		if(strlen(trim($strmobile_no)) > 0)
		{
			$appendMsg = " For Axis Bank Only";
			SendSMSforLMS($message.$SMSMessage.$appendMsg, $strmobile_no);
		}
	}
	elseif(($strbidderid==1360 || $strbidderid==1361 || $strbidderid==1362 || $strbidderid==1363 || $strbidderid==1372 || $strbidderid==1375 || $strbidderid==1523 || $strbidderid==1524 || $strbidderid==1359 || $strbidderid==1364 || $strbidderid==1365 || $strbidderid==1519 || $strbidderid==1520 || $strbidderid==1521 || $strbidderid==1522 || $strbidderid==1366 || $strbidderid==1367 || $strbidderid==1368 || $strbidderid==1369 || $strbidderid==1515 || $strbidderid==1516 || $strbidderid==1517 || $strbidderid==1371 || $strbidderid==1373 || $strbidderid==1374 || $strbidderid==1376 || $strbidderid==1525 || $strbidderid==1527 || $strbidderid==1029 || $strbidderid==1215 || $strbidderid==1221 || $strbidderid==1222 || $strbidderid==1642 || $strbidderid==1871 || $strbidderid==1872 || $strbidderid==1873 || $strbidderid==1875 || $strbidderid==1876 || $strbidderid==1877 || $strbidderid==1292 || $strbidderid==1432 || $strbidderid==1436 || $strbidderid==1439 || $strbidderid==1204 || $strbidderid==1223 || $strbidderid==1424 || $strbidderid==1425 || $strbidderid==1429 || $strbidderid==1433 || $strbidderid==1435 || $strbidderid==1293 || $strbidderid==1427 || $strbidderid==1428 || $strbidderid==1431 || $strbidderid==1294 || $strbidderid==1423 || $strbidderid==1426 || $strbidderid==1430 || $strbidderid==1434 || $strbidderid==1438 || $strbidderid==1470 || $strbidderid==1471 || $strbidderid==1473 || $strbidderid==1480 || $strbidderid==2295 || $strbidderid==1095 || $strbidderid==1096 || $strbidderid==1098 || $strbidderid==1106 || $strbidderid==1102 || $strbidderid==1105 || $strbidderid==1163 || $strbidderid==1100 || $strbidderid==1103 || $strbidderid==1104 || $strbidderid==1107 || $strbidderid==1379 || $strbidderid==1381 || $strbidderid==1387 || $strbidderid==1384 || $strbidderid==1386 || $strbidderid==1125 || $strbidderid==1378 || $strbidderid==1383 || $strbidderid==1377 || $strbidderid==1686 || $strbidderid==1284 || $strbidderid==1295 || $strbidderid==1287 || $strbidderid==1546 || $strbidderid==1547 || $strbidderid==1548 || $strbidderid==1549 || $strbidderid==1550 || $strbidderid==1551 || $strbidderid==1552 || $strbidderid==1553 || $strbidderid==1554 || $strbidderid==1555 || $strbidderid==1556 || $strbidderid==1557 || $strbidderid==1558 || $strbidderid==1560 || $strbidderid==1561 || $strbidderid==1562 || $strbidderid==1338 || $strbidderid==1339 || $strbidderid==1340 || $strbidderid==1343 || $strbidderid==1347 || $strbidderid==1350 || $strbidderid==1342 || $strbidderid==1344 || $strbidderid==1345 || $strbidderid==1346 || $strbidderid==1453 || $strbidderid==1454 || $strbidderid==1351 || $strbidderid==1353 || $strbidderid==1354 || $strbidderid==1355 || $strbidderid==1356 || $strbidderid==1357 || $strbidderid==1463 || $strbidderid==1464 || $strbidderid==1349 || $strbidderid==1352 || $strbidderid==1358 || $strbidderid==1457 || $strbidderid==1460 || $strbidderid==1461 || $strbidderid==1164 || $strbidderid==1165 || $strbidderid==1162 || $strbidderid==1166 || $strbidderid==1167 || $strbidderid==1168 || $strbidderid==1226 || $strbidderid==1597 || $strbidderid==1598 || $strbidderid==1599 || $strbidderid==1600 || $strbidderid==1603 || $strbidderid==1857 || $strbidderid==1858 || $strbidderid==1859 || $strbidderid==1860 || $strbidderid==1025 || $strbidderid==1675 || $strbidderid==2168 || $strbidderid==2296 || $strbidderid==2297 || $strbidderid==2299 || $strbidderid==2300 || $strbidderid==2301 || $strbidderid==2302 || $strbidderid==2303 || $strbidderid==2304 || $strbidderid==2305 || $strbidderid==2335 || $strbidderid==2336 || $strbidderid==2337 || $strbidderid==2338 || $strbidderid==2339 || $strbidderid==2340 || $strbidderid==2341 || $strbidderid==2342 || $strbidderid==2343 || $strbidderid==2280 || $strbidderid==2281 || $strbidderid==2283 || $strbidderid==2284 || $strbidderid==2286 || $strbidderid==2289 || $strbidderid==2290 || $strbidderid==2291 || $strbidderid==3317 || $strbidderid==3318 || $strbidderid==3319 || $strbidderid==3320 || $strbidderid==3316 || $strbidderid==3315 || $strbidderid==3321 || $strbidderid==3322 || $strbidderid==3323 || $strbidderid==3324 || $strbidderid==3325))
	{
		if(strlen(trim($SMSMessagefullsp))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				{
				 SendSMSforLMS($message.$SMSMessagefullsp, $strmobile_no);
				}
			}

	}
	else
	{
		if(strlen(trim($SMSMessage))>0)
		{
			//echo "<br>////FinalMessage////// ".$message."-".$SMSMessage."      ///////////<br>";
			//$rcstrmobile_no=9811215138;
			if(strlen(trim($strmobile_no)) > 0)
			 {
				SendSMSforLMS($message.$SMSMessage, $strmobile_no);
			}
		}

	}
	
	if(($recorcount)>0)
	{
if(strlen($City)>0)
		{
 ExecQuery("update req_plcompaign_smscontact set RequestID=".$request." where (Reply_Type=".$strreply_type." and Bank_Name='".$strbank_name."' and BidderID=".$strbidderid." and City_Wise='".$City_Wise."' and Sms_Flag=1)" );
 //echo "SMS UPDATe<br><br>";
 
		}
		else
		{
ExecQuery("update req_plcompaign_smscontact set RequestID=".$request." where (Reply_Type=".$strreply_type." and Bank_Name='".$strbank_name."' and BidderID=".$strbidderid." and Sms_Flag=1)" );
		}
	}

}
// Function getleadbysms END

function getBidderContactDetailsToCustomers($strProduct,$strbidderid,$leadid,$getBankNameID, $mobileno)
{
	//echo "sms sent to customer";
	$table_NAme=getTableName($strProduct);
	$strmobileSQL = "SELECT Mobile_Number,Name,City FROM ".$table_NAme." WHERE (RequestID=".$leadid.")";
	//echo "bidder contact".$strmobileSQL."<br><br>";
	$mobileresult = ExecQuery($strmobileSQL);
	$Mobrow = mysql_fetch_array($mobileresult);
	$Mobile_number=$Mobrow["Mobile_Number"];
	$strcustname=$Mobrow["Name"];
	$strcustcity=$Mobrow["City"];
//$Phone="9811215138";
$Phone=$Mobile_number;
$GetBidderID = explode(',',$strbidderid);
	$SMSMessage="Dear Customer,Following are contact details of your chosen Banks @ deal4loans: ";
	$SMSMessageBidders="";
	$sms_4barclays="";
	$ctr=1;
	$mvarType = $strProduct;
	$mvarCity = strtoupper($strCity);

	$GetBank_Sql = "select Bank_Name from Bank_Master where BankID  = ".$getBankNameID ."";
	$GetBank_Query = ExecQuery($GetBank_Sql);
	$mvar_Bidder_Bank = mysql_result($GetBank_Query,0,'Bank_Name');
	
	if($mobileno>0)
			{			
			$strmvar_Bidder_Number = "-".$mobileno;
			}
			else
			{
				$strmvar_Bidder_Number="";
			}
			
			$SMSMessageBidders=$SMSMessageBidders."(".$ctr.")".$mvar_Bidder_Bank."".$strmvar_Bidder_Number." ";
			$ctr=$ctr+1;

	if(strlen(trim($SMSMessageBidders))>0)
	{
//		echo $SMSMessage.$SMSMessageBidders."<BR>";
		if(strlen(trim($Phone)) > 0)
		{
			SendSMSforLMS($SMSMessage.$SMSMessageBidders, $Phone);  
		}

	}	
}

function SendMailToCustomers($GetBankID,$CustomerID,$Product,$getBankNameID, $mobileno)
{
	//echo $mobileno;
	//echo "mail sent";
	$GetBidderID = explode(',',$GetBankID);
	$ExpBidderName = "";
	$ExpBidderContact="";
	$BidderName="";
	$GetBank_Sql = "select Bank_Name from Bank_Master where BankID  = ".$getBankNameID ."";
	$GetBank_Query = ExecQuery($GetBank_Sql);
	$BidderName = mysql_result($GetBank_Query,0,'Bank_Name');
	$ExpBidderName[] = $BidderName;
	$arrbiddrbid[] = $GetBankID;
	$ExpBidderContact[] = $mobileno;
	//print_r($ExpBidderContact);
	$Bank_Name = "";
	
	$GetExpBidderContact=" - ".$mobileno;
	$Bank_Name[] = "<b>".$BidderName."".$GetExpBidderContact."</b><br>";

	$FinalBidderName = implode('',$Bank_Name);
		
	$getproductforemailer=getforemailer($Product);
		
	$TableName = getTableName($Product);
	$GetCustIDSql = "select PL_Tenure,Name,Email,City,Net_Salary,City_Other,Mobile_Number,Direct_Allocation from ".$TableName." where RequestID = ".$CustomerID." ";
		
	$GetCustIDQuery = ExecQuery($GetCustIDSql);
	$full_name = mysql_result($GetCustIDQuery,0,'Name');
	$email  = mysql_result($GetCustIDQuery,0,'Email');
	$city  = mysql_result($GetCustIDQuery,0,'City');
	$Net_Salary  = mysql_result($GetCustIDQuery,0,'Net_Salary');
		 
	if($city == "Others")
	{
		$city  = mysql_result($GetCustIDQuery,0,'City_Other');
	}
	$mobile_no  = mysql_result($GetCustIDQuery,0,'Mobile_Number');

	if($Product==1)
	{
		$Account_No  = mysql_result($GetCustIDQuery,0,'PL_Tenure');
	}
	else if($Product==3)
	{
		$Account_No  = mysql_result($GetCustIDQuery,0,'Account_No');
	}
	
	if(((strlen($email)) > 0) && (count($ExpBidderName)>0) ) 
	{
		$aheadTime  = mktime(date("H"), date("i")+15, 0, date("m")  , date("d"), date("Y"));
$dateFormat15min = date("j M y g:i A", $aheadTime);

		if($Net_Salary<240000 && ($Direct_Allocation==1))
			{			
			$BidPL = $arrbiddrbid[0];
	$Message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px; color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style='font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear ".$full_name.",</b></p>
Congratulations. Your Personal Loan Request has been forwarded to the below mentioned Banks as per the email sent to you , as you have given the consent on call and this authorization given by you will override the DND/DNC registration on your number $mobile_no.<br /><br /> 
<table cellpadding='3' cellspacing='0' border=1><tr><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Bank Name</td><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Contact</td></tr>";
for($m=0; $m <count($ExpBidderName);$m++)
			{
	$definetypwcl=ExecQuery("select Associated_Bank,BidderID,Define_PrePost,Bidder_Name from Bidders Where (BidderID=".$arrbiddrbid[$m].")");
	$defrowcl=mysql_fetch_array($definetypwcl);
	if($defrowcl['Define_PrePost'] == "PostPaid")
				{
		if($defrowcl['BidderID']=="2917" || $defrowcl['BidderID']=="2962" || $defrowcl['BidderID']=="2984" || $defrowcl['BidderID']=="2995" || $defrowcl['BidderID']=="3061" || $defrowcl['BidderID']=="3132" || $defrowcl['BidderID']=="3133" || $defrowcl['BidderID']=="3196" || $defrowcl['BidderID']=="3197" || $defrowcl['BidderID']=="3198" || $defrowcl['BidderID']=="3199" || $defrowcl['BidderID']=="3380" || $defrowcl['BidderID']=="3381" || $defrowcl['BidderID']=="3407" || $defrowcl['BidderID']=="3451" || $defrowcl['BidderID']=="3532" || $defrowcl['BidderID']=="3533" || $defrowcl['BidderID']=="3553" || $defrowcl['BidderID']=="3554" || $defrowcl['BidderID']=="3595" || $defrowcl['BidderID']=="3658" || $defrowcl['BidderID']=="3868" || $defrowcl['BidderID']=="3944" || $defrowcl['BidderID']=="3945" || $defrowcl['BidderID']=="4032" || $defrowcl['BidderID']=="4126" || $defrowcl['BidderID']=="4127" || $defrowcl['BidderID']=="4156" || $defrowcl['BidderID']=="4242" || $defrowcl['BidderID']=="4292" || $defrowcl['BidderID']=="4293" || $defrowcl['BidderID']=="4299" || $defrowcl['BidderID']=="4300" || $defrowcl['BidderID']=="4301" || $defrowcl['BidderID']=="4316" || $defrowcl['BidderID']=="4317" || $defrowcl['BidderID']=="4318" || $defrowcl['BidderID']=="4319" || $defrowcl['BidderID']=="4352" || $defrowcl['BidderID']=="4353" || $defrowcl['BidderID']=="4354" || $defrowcl['BidderID']=="4388" || $defrowcl['BidderID']=="4398" || $defrowcl['BidderID']=="4399" || $defrowcl['BidderID']=="4411" || $defrowcl['BidderID']=="4412" || $defrowcl['BidderID']=="4413" || $defrowcl['BidderID']=="4416" || $defrowcl['BidderID']=="4417" || $defrowcl['BidderID']=="4459" || $defrowcl['BidderID']=="4460" || $defrowcl['BidderID']=="4461" || $defrowcl['BidderID']=="4549" || $defrowcl['BidderID']=="4550" || $defrowcl['BidderID']=="4555" || $defrowcl['BidderID']=="4568" || $defrowcl['BidderID']=="4569" || $defrowcl['BidderID']=="4588" || $defrowcl['BidderID']=="4668" || $defrowcl['BidderID']=="4669" || $defrowcl['BidderID']=="4670" || $defrowcl['BidderID']=="4671" || $defrowcl['BidderID']=="4672" || $defrowcl['BidderID']=="4701" || $defrowcl['BidderID']=="4712" || $defrowcl['BidderID']=="4713" || $defrowcl['BidderID']=="4798" || $defrowcl['BidderID']=="4807" || $defrowcl['BidderID']=="4815" || $defrowcl['BidderID']=="4829" || $defrowcl['BidderID']=="4872" || $defrowcl['BidderID']=="4873" || $defrowcl['BidderID']=="5114" || $defrowcl['BidderID']=="5117" || $defrowcl['BidderID']=="5118" || $defrowcl['BidderID']=="2721" || $defrowcl['BidderID']=="2722" || $defrowcl['BidderID']=="2723" || $defrowcl['BidderID']=="3722" || $defrowcl['BidderID']=="2809" || $defrowcl['BidderID']=="2830" || $defrowcl['BidderID']=="2937" || $defrowcl['BidderID']=="3208" || $defrowcl['BidderID']=="3359" || $defrowcl['BidderID']=="3376" || $defrowcl['BidderID']=="3390" || $defrowcl['BidderID']=="3579" || $defrowcl['BidderID']=="4238" || $defrowcl['BidderID']=="4494" || $defrowcl['BidderID']=="5164" || $defrowcl['BidderID']=="3900" || $defrowcl['BidderID']=="3724" || $defrowcl['BidderID']=="3725" || $defrowcl['BidderID']=="3726" || $defrowcl['BidderID']=="3787" || $defrowcl['BidderID']=="3788" || $defrowcl['BidderID']=="3870" || $defrowcl['BidderID']=="3968" || $defrowcl['BidderID']=="4054" || $defrowcl['BidderID']=="4055" || $defrowcl['BidderID']=="4056" || $defrowcl['BidderID']=="4889" || $defrowcl['BidderID']=="5322")
				{ 
$txtvw="Andromeda<br>(As Agent of ".$ExpBidderName[$m].")";
				}
				else
					{
					$txtvw="(Direct Bank Sales Team)";
					}
				}
				else
				{
					if($defrowcl['BidderID']=="2917" || $defrowcl['BidderID']=="2962" || $defrowcl['BidderID']=="2984" || $defrowcl['BidderID']=="2995" || $defrowcl['BidderID']=="3061" || $defrowcl['BidderID']=="3132" || $defrowcl['BidderID']=="3133" || $defrowcl['BidderID']=="3196" || $defrowcl['BidderID']=="3197" || $defrowcl['BidderID']=="3198" || $defrowcl['BidderID']=="3199" || $defrowcl['BidderID']=="3380" || $defrowcl['BidderID']=="3381" || $defrowcl['BidderID']=="3407" || $defrowcl['BidderID']=="3451" || $defrowcl['BidderID']=="3532" || $defrowcl['BidderID']=="3533" || $defrowcl['BidderID']=="3553" || $defrowcl['BidderID']=="3554" || $defrowcl['BidderID']=="3595" || $defrowcl['BidderID']=="3658" || $defrowcl['BidderID']=="3868" || $defrowcl['BidderID']=="3944" || $defrowcl['BidderID']=="3945" || $defrowcl['BidderID']=="4032" || $defrowcl['BidderID']=="4126" || $defrowcl['BidderID']=="4127" || $defrowcl['BidderID']=="4156" || $defrowcl['BidderID']=="4242" || $defrowcl['BidderID']=="4292" || $defrowcl['BidderID']=="4293" || $defrowcl['BidderID']=="4299" || $defrowcl['BidderID']=="4300" || $defrowcl['BidderID']=="4301" || $defrowcl['BidderID']=="4316" || $defrowcl['BidderID']=="4317" || $defrowcl['BidderID']=="4318" || $defrowcl['BidderID']=="4319" || $defrowcl['BidderID']=="4352" || $defrowcl['BidderID']=="4353" || $defrowcl['BidderID']=="4354" || $defrowcl['BidderID']=="4388" || $defrowcl['BidderID']=="4398" || $defrowcl['BidderID']=="4399" || $defrowcl['BidderID']=="4411" || $defrowcl['BidderID']=="4412" || $defrowcl['BidderID']=="4413" || $defrowcl['BidderID']=="4416" || $defrowcl['BidderID']=="4417" || $defrowcl['BidderID']=="4459" || $defrowcl['BidderID']=="4460" || $defrowcl['BidderID']=="4461" || $defrowcl['BidderID']=="4549" || $defrowcl['BidderID']=="4550" || $defrowcl['BidderID']=="4555" || $defrowcl['BidderID']=="4568" || $defrowcl['BidderID']=="4569" || $defrowcl['BidderID']=="4588" || $defrowcl['BidderID']=="4668" || $defrowcl['BidderID']=="4669" || $defrowcl['BidderID']=="4670" || $defrowcl['BidderID']=="4671" || $defrowcl['BidderID']=="4672" || $defrowcl['BidderID']=="4701" || $defrowcl['BidderID']=="4712" || $defrowcl['BidderID']=="4713" || $defrowcl['BidderID']=="4798" || $defrowcl['BidderID']=="4807" || $defrowcl['BidderID']=="4815" || $defrowcl['BidderID']=="4829" || $defrowcl['BidderID']=="4872" || $defrowcl['BidderID']=="4873" || $defrowcl['BidderID']=="5114" || $defrowcl['BidderID']=="5117" || $defrowcl['BidderID']=="5118" || $defrowcl['BidderID']=="2721" || $defrowcl['BidderID']=="2722" || $defrowcl['BidderID']=="2723" || $defrowcl['BidderID']=="3722" || $defrowcl['BidderID']=="2809" || $defrowcl['BidderID']=="2830" || $defrowcl['BidderID']=="2937" || $defrowcl['BidderID']=="3208" || $defrowcl['BidderID']=="3359" || $defrowcl['BidderID']=="3376" || $defrowcl['BidderID']=="3390" || $defrowcl['BidderID']=="3579" || $defrowcl['BidderID']=="4238" || $defrowcl['BidderID']=="4494" || $defrowcl['BidderID']=="5164" || $defrowcl['BidderID']=="3900" || $defrowcl['BidderID']=="3724" || $defrowcl['BidderID']=="3725" || $defrowcl['BidderID']=="3726" || $defrowcl['BidderID']=="3787" || $defrowcl['BidderID']=="3788" || $defrowcl['BidderID']=="3870" || $defrowcl['BidderID']=="3968" || $defrowcl['BidderID']=="4054" || $defrowcl['BidderID']=="4055" || $defrowcl['BidderID']=="4056" || $defrowcl['BidderID']=="4889" || $defrowcl['BidderID']=="5322")
				{ 
$txtvw="Andromeda<br>(As Agent of ".$ExpBidderName[$m].")";
				}
				else
					{
					$txtvw="As Agent of ".$ExpBidderName[$m];
					}
				}
				$BidCL = $defrowcl['BidderID'];
$Message.="<tr><td width='106' height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$defrowcl["Associated_Bank"]."<br>".$txtvw."</td><td width='210' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderContact[$m]."</td></tr>";
 }
$Message.="</table>
<br />
<b>You will receive calls within 4 Working Hours from the Bank/NBFC's representatives, you can compare the rates & choose the best deal.  </b><br />
1) Hear quote from each bank.<br />
2) Compare EMI & other charges.<br />
3) Apply to the bank which provides you the best offer.<br /><br />
<b>Know more about</b><br>
&bull; <a href='http://www.deal4loans.com/personal-loan-interest-rate.php'>Personal Loan Interest Rates</a><br>
&bull; <a href='http://www.deal4loans.com/loans/personal-loan/best-personal-loan-bank-personal-loan-providers-in-india/'>Best Personal loans India</a><br>
&bull; <a href='http://www.deal4loans.com/personal-loan-banks.php'>Personal loan comparison </a><br>
&bull; <a href='http://www.deal4loans.com/personal-loan-emi-calculator.php'>Personal loan emi calculator</a><br /><br />
</td></tr>";
$Message.="
<tr><td style='font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'>Disclaimer: The rate quotes offered by the bank representatives are solely on the bank's discretion. We do not hold any responsibility for any miscommunication|misrepresentation given by the Bank/NBFC's sales representative.<br /><br />
Warm Regards,<br />
Team Deal4Loans
</td></tr></table>";
			}
else
			{
	$Message="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px; color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style='font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear ".$full_name.",</b></p>
	Congratulations. Your Personal Loan Request has been forwarded to the below mentioned Banks as per the email sent to you , as you have given the consent on call and this authorization given by you will override the DND/DNC registration on your number ".$mobile_no.".<br /><br /> 
<table cellpadding='3' cellspacing='0' border=1><tr><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Bank Name</td><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Contact</td></tr>";
for($m=0; $m <count($ExpBidderName);$m++)
			{
	$definetypwcl=ExecQuery("select Associated_Bank,BidderID,Define_PrePost,Bidder_Name from Bidders Where (BidderID=".$arrbiddrbid[$m].")");
	$defrowcl=mysql_fetch_array($definetypwcl);
	if($defrowcl['Define_PrePost'] == "PostPaid")
				{
		if($defrowcl['BidderID']=="2917" || $defrowcl['BidderID']=="2962" || $defrowcl['BidderID']=="2984" || $defrowcl['BidderID']=="2995" || $defrowcl['BidderID']=="3061" || $defrowcl['BidderID']=="3132" || $defrowcl['BidderID']=="3133" || $defrowcl['BidderID']=="3196" || $defrowcl['BidderID']=="3197" || $defrowcl['BidderID']=="3198" || $defrowcl['BidderID']=="3199" || $defrowcl['BidderID']=="3380" || $defrowcl['BidderID']=="3381" || $defrowcl['BidderID']=="3407" || $defrowcl['BidderID']=="3451" || $defrowcl['BidderID']=="3532" || $defrowcl['BidderID']=="3533" || $defrowcl['BidderID']=="3553" || $defrowcl['BidderID']=="3554" || $defrowcl['BidderID']=="3595" || $defrowcl['BidderID']=="3658" || $defrowcl['BidderID']=="3868" || $defrowcl['BidderID']=="3944" || $defrowcl['BidderID']=="3945" || $defrowcl['BidderID']=="4032" || $defrowcl['BidderID']=="4126" || $defrowcl['BidderID']=="4127" || $defrowcl['BidderID']=="4156" || $defrowcl['BidderID']=="4242" || $defrowcl['BidderID']=="4292" || $defrowcl['BidderID']=="4293" || $defrowcl['BidderID']=="4299" || $defrowcl['BidderID']=="4300" || $defrowcl['BidderID']=="4301" || $defrowcl['BidderID']=="4316" || $defrowcl['BidderID']=="4317" || $defrowcl['BidderID']=="4318" || $defrowcl['BidderID']=="4319" || $defrowcl['BidderID']=="4352" || $defrowcl['BidderID']=="4353" || $defrowcl['BidderID']=="4354" || $defrowcl['BidderID']=="4388" || $defrowcl['BidderID']=="4398" || $defrowcl['BidderID']=="4399" || $defrowcl['BidderID']=="4411" || $defrowcl['BidderID']=="4412" || $defrowcl['BidderID']=="4413" || $defrowcl['BidderID']=="4416" || $defrowcl['BidderID']=="4417" || $defrowcl['BidderID']=="4459" || $defrowcl['BidderID']=="4460" || $defrowcl['BidderID']=="4461" || $defrowcl['BidderID']=="4549" || $defrowcl['BidderID']=="4550" || $defrowcl['BidderID']=="4555" || $defrowcl['BidderID']=="4568" || $defrowcl['BidderID']=="4569" || $defrowcl['BidderID']=="4588" || $defrowcl['BidderID']=="4668" || $defrowcl['BidderID']=="4669" || $defrowcl['BidderID']=="4670" || $defrowcl['BidderID']=="4671" || $defrowcl['BidderID']=="4672" || $defrowcl['BidderID']=="4701" || $defrowcl['BidderID']=="4712" || $defrowcl['BidderID']=="4713" || $defrowcl['BidderID']=="4798" || $defrowcl['BidderID']=="4807" || $defrowcl['BidderID']=="4815" || $defrowcl['BidderID']=="4829" || $defrowcl['BidderID']=="4872" || $defrowcl['BidderID']=="4873" || $defrowcl['BidderID']=="5114" || $defrowcl['BidderID']=="5117" || $defrowcl['BidderID']=="5118" || $defrowcl['BidderID']=="2721" || $defrowcl['BidderID']=="2722" || $defrowcl['BidderID']=="2723" || $defrowcl['BidderID']=="3722" || $defrowcl['BidderID']=="2809" || $defrowcl['BidderID']=="2830" || $defrowcl['BidderID']=="2937" || $defrowcl['BidderID']=="3208" || $defrowcl['BidderID']=="3359" || $defrowcl['BidderID']=="3376" || $defrowcl['BidderID']=="3390" || $defrowcl['BidderID']=="3579" || $defrowcl['BidderID']=="4238" || $defrowcl['BidderID']=="4494" || $defrowcl['BidderID']=="5164" || $defrowcl['BidderID']=="3900" || $defrowcl['BidderID']=="3724" || $defrowcl['BidderID']=="3725" || $defrowcl['BidderID']=="3726" || $defrowcl['BidderID']=="3787" || $defrowcl['BidderID']=="3788" || $defrowcl['BidderID']=="3870" || $defrowcl['BidderID']=="3968" || $defrowcl['BidderID']=="4054" || $defrowcl['BidderID']=="4055" || $defrowcl['BidderID']=="4056" || $defrowcl['BidderID']=="4889" || $defrowcl['BidderID']=="5322")
				{
$txtvw="Andromeda<br>(As Agent of ".$ExpBidderName[$m].")";
				}
				else
					{
					$txtvw="(Direct Bank Sales Team)";
					}
				}
				else
				{
					if($defrowcl['BidderID']=="2917" || $defrowcl['BidderID']=="2962" || $defrowcl['BidderID']=="2984" || $defrowcl['BidderID']=="2995" || $defrowcl['BidderID']=="3061" || $defrowcl['BidderID']=="3132" || $defrowcl['BidderID']=="3133" || $defrowcl['BidderID']=="3196" || $defrowcl['BidderID']=="3197" || $defrowcl['BidderID']=="3198" || $defrowcl['BidderID']=="3199" || $defrowcl['BidderID']=="3380" || $defrowcl['BidderID']=="3381" || $defrowcl['BidderID']=="3407" || $defrowcl['BidderID']=="3451" || $defrowcl['BidderID']=="3532" || $defrowcl['BidderID']=="3533" || $defrowcl['BidderID']=="3553" || $defrowcl['BidderID']=="3554" || $defrowcl['BidderID']=="3595" || $defrowcl['BidderID']=="3658" || $defrowcl['BidderID']=="3868" || $defrowcl['BidderID']=="3944" || $defrowcl['BidderID']=="3945" || $defrowcl['BidderID']=="4032" || $defrowcl['BidderID']=="4126" || $defrowcl['BidderID']=="4127" || $defrowcl['BidderID']=="4156" || $defrowcl['BidderID']=="4242" || $defrowcl['BidderID']=="4292" || $defrowcl['BidderID']=="4293" || $defrowcl['BidderID']=="4299" || $defrowcl['BidderID']=="4300" || $defrowcl['BidderID']=="4301" || $defrowcl['BidderID']=="4316" || $defrowcl['BidderID']=="4317" || $defrowcl['BidderID']=="4318" || $defrowcl['BidderID']=="4319" || $defrowcl['BidderID']=="4352" || $defrowcl['BidderID']=="4353" || $defrowcl['BidderID']=="4354" || $defrowcl['BidderID']=="4388" || $defrowcl['BidderID']=="4398" || $defrowcl['BidderID']=="4399" || $defrowcl['BidderID']=="4411" || $defrowcl['BidderID']=="4412" || $defrowcl['BidderID']=="4413" || $defrowcl['BidderID']=="4416" || $defrowcl['BidderID']=="4417" || $defrowcl['BidderID']=="4459" || $defrowcl['BidderID']=="4460" || $defrowcl['BidderID']=="4461" || $defrowcl['BidderID']=="4549" || $defrowcl['BidderID']=="4550" || $defrowcl['BidderID']=="4555" || $defrowcl['BidderID']=="4568" || $defrowcl['BidderID']=="4569" || $defrowcl['BidderID']=="4588" || $defrowcl['BidderID']=="4668" || $defrowcl['BidderID']=="4669" || $defrowcl['BidderID']=="4670" || $defrowcl['BidderID']=="4671" || $defrowcl['BidderID']=="4672" || $defrowcl['BidderID']=="4701" || $defrowcl['BidderID']=="4712" || $defrowcl['BidderID']=="4713" || $defrowcl['BidderID']=="4798" || $defrowcl['BidderID']=="4807" || $defrowcl['BidderID']=="4815" || $defrowcl['BidderID']=="4829" || $defrowcl['BidderID']=="4872" || $defrowcl['BidderID']=="4873" || $defrowcl['BidderID']=="5114" || $defrowcl['BidderID']=="5117" || $defrowcl['BidderID']=="5118" || $defrowcl['BidderID']=="2721" || $defrowcl['BidderID']=="2722" || $defrowcl['BidderID']=="2723" || $defrowcl['BidderID']=="3722" || $defrowcl['BidderID']=="2809" || $defrowcl['BidderID']=="2830" || $defrowcl['BidderID']=="2937" || $defrowcl['BidderID']=="3208" || $defrowcl['BidderID']=="3359" || $defrowcl['BidderID']=="3376" || $defrowcl['BidderID']=="3390" || $defrowcl['BidderID']=="3579" || $defrowcl['BidderID']=="4238" || $defrowcl['BidderID']=="4494" || $defrowcl['BidderID']=="5164" || $defrowcl['BidderID']=="3900" || $defrowcl['BidderID']=="3724" || $defrowcl['BidderID']=="3725" || $defrowcl['BidderID']=="3726" || $defrowcl['BidderID']=="3787" || $defrowcl['BidderID']=="3788" || $defrowcl['BidderID']=="3870" || $defrowcl['BidderID']=="3968" || $defrowcl['BidderID']=="4054" || $defrowcl['BidderID']=="4055" || $defrowcl['BidderID']=="4056" || $defrowcl['BidderID']=="4889" || $defrowcl['BidderID']=="5322")
				{
$txtvw="Andromeda<br>(As Agent of ".$ExpBidderName[$m].")";
				}
				else
					{
					$txtvw="As Agent of ".$ExpBidderName[$m];
					}
				}
				$BidCL = $defrowcl['BidderID'];
$Message.="<tr><td width='106' height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$defrowcl["Associated_Bank"]."<br>".$txtvw."</td><td width='210' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderContact[$m]."</td></tr>";
 }
$Message.="</table>
<br />
<b>You will receive calls within 4 Working Hours from the Bank/NBFC's representatives, you can compare the rates & choose the best deal. </b><br />
1) Hear quote from each bank.<br />
2) Compare EMI & other charges.<br />
3) Apply to the bank which provides you the best offer.<br /><br />
<b>Know more about</b><br>
&bull; <a href='http://www.deal4loans.com/personal-loan-interest-rate.php'>Personal Loan Interest Rates</a><br>
&bull; <a href='http://www.deal4loans.com/loans/personal-loan/best-personal-loan-bank-personal-loan-providers-in-india/'>Best Personal loans India</a><br>
&bull; <a href='http://www.deal4loans.com/personal-loan-banks.php'>Personal loan comparison </a><br>
&bull; <a href='http://www.deal4loans.com/personal-loan-emi-calculator.php'>Personal loan emi calculator</a><br />
</td></tr>";

$Message.="
<tr><td style='font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'>Deal4loans.com- <a href='http://www.youtube.com/watch?v=fyWDCDpRUDs'>Watch us on Youtube on how do we help you crack the best deal</a>.<br><br>Disclaimer: The rate quotes offered by the bank representatives are solely on the bank's discretion. We do not hold any responsibility for any miscommunication|misrepresentation given by the Bank/NBFC's sales representative.<br /><br />
Warm Regards,<br />
Team Deal4Loans
</td></tr></table>";
			}
	
	//echo $Message."<br>";
		$headers = "From: deal4loans <no-reply@deal4loans.com>";
		$semi_rand = md5( time() ); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
		$headers .= "\nMIME-Version: 1.0\n" . 
		"Content-Type: multipart/mixed;\n" . 
		" boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: extra4testingnew@gmail.com "."\n";
		
		$message = "This is a multi-part message in MIME format.\n\n" . 
		"--{$mime_boundary}\n" . 
		"Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
		"Content-Transfer-Encoding: 7bit\n\n" . 
		$Message . "\n\n";

		mail($email,'Thanks for Registering for '.$getproductforemailer.' on deal4loans.com', $message, $headers);
	}
}			  

?>