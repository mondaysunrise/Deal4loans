<?php
require 'scripts/db_init.php';
//require 'scripts/db_init-rnew.php';
require 'scripts/functions_nw.php';

transfer_tofinalallocation();

function transfer_tofinalallocation()
{
	$conpprosuct=ExecQuery("select * from  Req_Compaign Where Bank_Name='HomeLoan' and Compaign_ID=4047");
	$row=mysql_fetch_array($conpprosuct);
	$RequestID = $row["RequestID"];
	$today= date('Y-m-d');
	$today_date = $today." 00:00:00";
	if(strlen($RequestID)>0)
	{
		$qry1= "select AllRequestID from Req_Feedback_Bidder_HL1 Where ((Consent=1 and final_allocate=0) and (DATE_SUB( NOW() , INTERVAL '00:15' HOUR_MINUTE ) >= Allocation_Date) and (Allocation_Date>'".$today_date."' )) group by AllRequestID";
	}
	else
	{
		$qry1= "select AllRequestID from Req_Feedback_Bidder_HL1 Where ((Consent=1 and (DATE_SUB( NOW() , INTERVAL '00:15' HOUR_MINUTE ) >= Allocation_Date) and final_allocate=0) and (Allocation_Date>'".$today_date."' )) group by AllRequestID";
	}
//	$qry1= "select AllRequestID from Req_Feedback_Bidder_HL1 Where (Consent=1 and AllRequestID = '1109265') group by AllRequestID";

		$result = ExecQuery($qry1);
		$recordcount = mysql_num_rows($result);
		
	echo $qry1;	
	echo "<br>";
	echo $recordcount;
//$recordcount=0;
if($recordcount>0)
{
	while($cust=mysql_fetch_array($result))
	{
		$AllRequestID = $cust["AllRequestID"];
		//to get city
echo 	"Select City, City_Other from Req_Loan_Home Where RequestID=".$AllRequestID;
	 	$cust_city=ExecQuery("Select City, City_Other,Loan_Amount from Req_Loan_Home Where RequestID=".$AllRequestID);
		$custrow=mysql_fetch_array($cust_city);
	    echo "<br>";
		if($custrow["City"]=="Others" && strlen($custrow["City_Other"])>0)
        {
            $Customer_City= $custrow["City_Other"];
        }
        else
        {
            $Customer_City= $custrow["City"];
        }
		$Loan_Amount = $custrow["Loan_Amount"];
		//end to get city
echo $AllRequestID."--".$Customer_City;
		leadallocation($AllRequestID, $Customer_City, $Loan_Amount);
	}
}
}

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

function leadallocation($LeadID, $Customer_City, $CustLoan_Amount)
{
	echo $LeadID."----".$Customer_City;
	echo "<br>";
	echo $today = date('Y-m-d');
	

$qry2= "select * from Req_Feedback_Bidder_HL1 Where (Consent=1 and final_allocate=0 and AllRequestID='".$LeadID."') order by Allocation_Date DESC Limit 0,4";
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
			$Feedback_ID = $cust2["Feedback_ID"];
			$BidderID = $cust2["BidderID"];
			$ProductType = $cust2["Reply_Type"];
				
			$checkfinal_alocate=ExecQuery("select AllRequestID from Req_Feedback_Bidder1 where (Reply_Type=2 and AllRequestID='".$AllRequestID."' and BidderID='".$BidderID."' and Allocation_Date between '".$today." 00:00:00' and '".$today." 23:59:59')");
			$recordcount_alocate = mysql_num_rows($checkfinal_alocate);
			echo "<br>select AllRequestID from Req_Feedback_Bidder1 where (AllRequestID='".$AllRequestID."' and BidderID='".$BidderID."' and Allocation_Date between '".$today." 00:00:00' and '".$today." 23:59:59')<br>";
			
			if($recordcount_alocate>0)
			{}
			else
			{
				$InsertFeedBackSql = "Insert into Req_Feedback_Bidder1 (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('".$AllRequestID."', '".$BidderID."','".$ProductType."', Now())";
			
			$InsertFeedBackResult = ExecQuery($InsertFeedBackSql);
			 $final_allocation="INSERT Req_Feedback_Bidder_HL (AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$AllRequestID."','".$BidderID."','".$ProductType."', Now())";
			$final_allocationresult = ExecQuery($final_allocation);
			$recordLastInserted = mysql_insert_id();

			$getglobalidSql = ExecQuery("select Global_Access_ID from Bidders where (BidderID ='".$BidderID."')");
			$getglobal = mysql_fetch_array($getglobalidSql);   
			if($getglobal[0]==6319) //SBI HL 
				{
					$checkfinal_alocatecont=ExecQuery("select AllRequestID from Req_Feedback_Bidder1 where (Reply_Type=2 and BidderID='".$BidderID."' and Allocation_Date between '".$today." 00:00:00' and '".$today." 23:59:59')");
					$recordcount_alocatecont = mysql_num_rows($checkfinal_alocatecont);
					if($recordcount_alocatecont>2)
					{
						$final_allocationsbi="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date, sbitelecaller) VALUE ('".$recordLastInserted."','".$AllRequestID."','".$BidderID."','".$ProductType."', Now(),'1')";
						$final_allocationsbiresult = ExecQuery($final_allocationsbi);
					}
					else
					{
						$final_allocationsbi="INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date,sbitelecaller) VALUE ('".$recordLastInserted."','".$AllRequestID."','".$BidderID."','".$ProductType."', Now(),'1')";
						$final_allocationsbiresult = ExecQuery($final_allocationsbi);
					}
				}
			$recordcountA[] = $recordLastInserted;
			
			/////
	echo "<br>";
		//echo "181";
		echo $updateFeedbackSql = "Update Req_Compaign set RequestID='".$Feedback_ID."' Where Bank_Name='HomeLoan' and Compaign_ID=4047";
		$updateFeedbackQuery = ExecQuery($updateFeedbackSql);
		$updateFinalAllocate = "Update Req_Feedback_Bidder_HL1 set final_allocate=1 Where (AllRequestID='".$AllRequestID."' and BidderID='".$BidderID."')";
		ExecQuery($updateFinalAllocate);

			$UpdateBidders = "UPDATE `Bidders_List` SET `Last_allocation` = '1', `Last_set_select` = '1' WHERE `BidderID` = '".$BidderID."' and Reply_Type=".$ProductType;
			//echo "<br><br>";
			
			ExecQuery($UpdateBidders);
			$getConflictBidderSql = ExecQuery("select Conflict_Bidder from Bidders_List where  BidderID ='".$BidderID."'and Reply_Type='".$ProductType."'");
			$getConflictBidderFetch = mysql_fetch_array($getConflictBidderSql);   
//		   echo "<br><br>";
			$getConflictBidder = $getConflictBidderFetch[0];
		   
			$arrayConflictBidder = explode(",",$getConflictBidder);
		   
			for($i=0;$i<count($arrayConflictBidder);$i++)
			{
				 $SqlConflictUpdate = "UPDATE `Bidders_List` SET `Last_allocation` = '0', `Last_set_select` = '1' WHERE `BidderID` = '".$arrayConflictBidder[$i]."' and Reply_Type='".$ProductType."'";
				  ExecQuery($SqlConflictUpdate);
				//  echo "<br><br>";
			}
			//clause for HDFC Ltd bidderID: 1329 loan amount :50 Lacs and Cities : Delhi,Chennai,Hyderabad,Lucknow,Chandigarh
			if($BidderID==1329 && ($Customer_City=="Delhi" || $Customer_City=="Chennai" || $Customer_City=="Hyderabad" || $Customer_City=="Lucknow" || $Customer_City=="Chandigarh") && $CustLoan_Amount>=5000000)
				{
				$HDFCLtdqry= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_city) VALUES('".$LeadID."','".$ProductType."','email','1329',NOW(), '".$Customer_City."')");
				}//End of clause for HDFC Ltd bidderID: 1329
			if($BidderID==5897 || $BidderID==5896 || $BidderID==5900 || $BidderID==5898 || $BidderID==5899 || $BidderID==5895 || $BidderID==5894 || $BidderID==5893)
				{
				$LNT_HLqry= ExecQuery("INSERT INTO webservice_bidder_details (leadid,product,feedback,bidderid,doe, cust_city) VALUES('".$LeadID."','".$ProductType."','email','".$BidderID."',NOW(), '".$Customer_City."')");
				}
			
$getValidBiddersForSmsCityWise=ExecQuery("Select City_Wise from Req_Compaign Where Sms_Flag=1 and Reply_Type=".$ProductType." and BidderID='".$BidderID."'");
$citwisesms=mysql_fetch_array($getValidBiddersForSmsCityWise);
$strcitywise= $citwisesms['City_Wise'];
if(strlen($strcitywise)>0)
			{
	//echo "I M INSIDE CITY WISE IF BLOCK";
	$getValidBiddersForSms="Select * from Req_Compaign Where Sms_Flag=1 and Reply_Type=".$ProductType." and BidderID='".$BidderID."'and City_Wise like '%".$Customer_City."%'";

			}
else
			{
	//echo "I M INSIDE CITY WISE IN ELSE BLOCK";
 $getValidBiddersForSms="Select * from Req_Compaign Where Sms_Flag=1 and Reply_Type=".$ProductType." and BidderID='".$BidderID."' and City_Wise='' ";
// echo "<br><br>";
			}
echo "<br><br>";
	echo "query1".$bidderquery."<br>";
	$getbidderresult=ExecQuery($getValidBiddersForSms);
	$Bidderrecorcount = mysql_num_rows($getbidderresult);
	if($Bidderrecorcount>0 || ($BidderID==1329 && $Customer_City=="Delhi"))
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
				echo "<br>".$Reply_Type."--".$Bank_Name."--".$BidderID."--".$RequestID."--".$Start_Date."--".$Mobile_no."--".$City_Wise."--".$BiddersList."<br>";
				getleadbysms($Reply_Type,$Bank_Name,$BidderID,$RequestID,$Start_Date,$Mobile_no,$City_Wise,$BiddersList);
			
			}
			else
			{
				$getsmslead="INSERT INTO Req_Sms_Delivery (Reply_Type, BidderID, RequestID, Mobile_Number, City_Wise, Sms_Dated) VAlues ('".$Reply_Type."', '".$BidderID."', '".$recordLastInserted."', '".$Mobile_no."', '".$City_Wise."', Now())";
				ExecQuery($getsmslead);
			}
		}
	}
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
				echo "247 -  - ".$GetBidderID."--".$LeadID."--".$ProductType;
				getBidderContactDetailsToCustomers($ProductType,$GetBidderID,$LeadID);
				SendMailToCustomers($GetBidderID,$LeadID,$ProductType);
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
	
	$updateBidderCount= "update ".$Table." set Allocated='1', Bidder_Count='$RecordCount' where RequestID='".$LeadID."'";
	echo "bidder count: ".$updateBidderCount."<br><br>";
    ExecQuery($updateBidderCount);
}
//function updateBidderCountinProduct End

function getleadbysms ($strreply_type, $strbank_name, $strbidderid, $requestid, $strstart_date, $strmobile_no,$City_Wise,$BiddersList)
{
//	$strmobile_no=9811215138;
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

$fldssms="Feedback_ID,Name,Email,City,Mobile_Number,Net_Salary,Company_Name,Loan_Amount,Add_Comment,Employment_Status";

	$feedback_tble="Req_Feedback_Bidder1";

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
	echo "query2::".$search_query."<br>";
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
	$SMSMessage3511="";
	 $SMSMegWidBankName="";
	 $appendMsg = ""; 
			
		do
		{
			//$SMSMessage="";
			$request=trim($myrow["Feedback_ID"]);
			$Name=trim($myrow["Name"]);
			$Email=trim($myrow["Email"]);
			$City=trim($myrow["City"]);
			$Phone=trim($myrow["Mobile_Number"]);
			$Net_Salary=trim($myrow["Net_Salary"]);
			$Company_Name =trim($myrow["Company_Name"]);
			$Loan_Amt=trim($myrow["Loan_Amount"]);

			list($Loan_Amount,$extra) = split('[.]', $Loan_Amt);
			
			$Add_Comment=trim($myrow["Add_Comment"]);
			
			if($reply_type=="Req_Loan_Home")
			{
				//Dear Subscriber, Your Home loan Leads on ({v1}) : Name={v2}, Mobile - {v3}, Salary - {v4}, Loan Amount = {v5}, City= {v6},Comment = {v7}

				$message ="Your Home loan Leads on (".$currentdate.") : ";
				$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.", sal- ".$Net_Salary.", loan amt- ".$Loan_Amount.", property type flat";

				$SMSMessage3511=$SMSMessage3511."(".$ctr.") ".$Name."-".$Phone.", sal- ".$Net_Salary.", loan amt- ".$Loan_Amount.",".$strbank_name;

				$SMSMessagecitifin=$SMSMessagecitifin."(".$ctr.") ".$Name."-".$Phone." sal- ".$Net_Salary." loan amt- ".$Loan_Amount." ".$Add_Comment."city-".$City;

				$SMSMessage1697=$SMSMessage1697."(".$ctr.") ".$Name."-".$Phone.",sal- ".$Net_Salary.",Co- ".$Company_Name.",loan amt- ".$Loan_Amount.", ".$Add_Comment;

				$SMSMessage2843=$SMSMessage2843."(".$ctr.") ".$Name."-".$Phone.",sal- ".$Net_Salary.",Co- ".$Company_Name.",loan amt- ".$Loan_Amount.", for PNB";

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
			 SendSMSforLMS($message.$SMSMessagecitibank, $strmobile_no);
			

		}

	}
	
	elseif($strbidderid=="1160")
	{
		if(strlen(trim($smsforbidderid1160))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$smsforbidderid1160, $strmobile_no);

			//if(strlen(trim($mobile_no)) > 0)
			// SendSMS($message.$SMSMessageCiti, $mobile_no);
		}
	}
	elseif ($strbidderid=="2422" || $strbidderid=="2423" || $strbidderid=="2424" || $strbidderid=="2425" || $strbidderid=="3645" || $strbidderid=="2426" || $strbidderid=="2427" || $strbidderid=="2428" || $strbidderid=="2429" || $strbidderid=="3335" || $strbidderid=="2430" || $strbidderid=="2431" || $strbidderid=="2432" || $strbidderid=="2433" || $strbidderid=="2434" || $strbidderid=="2435" || $strbidderid=="2436" || $strbidderid=="2437" || $strbidderid=="2438" || $strbidderid=="2439" || $strbidderid=="2440" || $strbidderid=="2441" || $strbidderid=="2442" || $strbidderid=="2443" || $strbidderid=="2444" || $strbidderid=="2445" || $strbidderid=="2446" || $strbidderid=="2447" || $strbidderid=="2449" || $strbidderid=="2450" || $strbidderid=="2451" || $strbidderid=="2476" || $strbidderid=="3629" || $strbidderid=="3842")
	{
		if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMessagecitibank, $strmobile_no);
	}
	elseif($strbidderid=="1110" || $strbidderid=="1111" || $strbidderid=="1112" || $strbidderid=="1113" || $strbidderid=="1114" || $strbidderid=="1115" || $strbidderid=="1116" || $strbidderid=="1482" || $strbidderid=="1483" || $strbidderid=="1477" || $strbidderid=="1476" || $strbidderid=="1447" || $strbidderid=="1466" || $strbidderid=="1631" || $strbidderid=="2943" || $strbidderid=="4507"  || $strbidderid=="5625" || $strbidderid=="5629" || $strbidderid=="6092" || $strbidderid=="5498" )
	{
		if(strlen(trim($SMSMessagecitifin))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMessagecitifin, $strmobile_no);
		}
	}
	else if ($strbidderid=="2917" || $strbidderid=="3254" || $strbidderid=="3255" || $strbidderid=="2962" || $strbidderid=="3256" || $strbidderid =="3257" || $strbidderid =="2983" || $strbidderid =="2984" || $strbidderid =="3258" || $strbidderid =="3259" || $strbidderid=="3061" || $strbidderid =="3132" || $strbidderid =="3133" || $strbidderid =="3134" || $strbidderid=="3195" ||  $strbidderid=="3196" ||  $strbidderid=="3197" ||  $strbidderid=="3198" || $strbidderid=="3199" || $strbidderid=="3216" || $strbidderid=="3241" ||  $strbidderid=="2919" || $strbidderid=="2963" || $strbidderid=="3364" ||  $strbidderid=="3371" || $strbidderid=="3372" || $strbidderid=="3381" || $strbidderid=="3380" || $strbidderid=="3382" || $strbidderid=="3383" || $strbidderid=="2995" || $strbidderid=="3407" || $strbidderid=="3449" || $strbidderid=="3450" || $strbidderid=="3451" || $strbidderid=="3452" || $strbidderid=="3532" || $strbidderid=="3533" || $strbidderid=="3537" || $strbidderid=="3553" || $strbidderid=="3554" || $strbidderid=="3576" || $strbidderid=="3581" || $strbidderid=="3595" || $defrow['BidderID']=="3658" || $strbidderid=="3754" || $strbidderid=="3753" || $strbidderid=="3868" || $strbidderid=="3944" || $strbidderid=="3945")
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
	else if($strbidderid=="3724" || $strbidderid=="3726" || $strbidderid=="3725" || $strbidderid=="3787" || $strbidderid=="3788")
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
	else if($strbidderid=="3003" || $strbidderid=="3654" || $strbidderid=="3002" || $strbidderid=="3801")
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
	elseif(($strbidderid=="1510" || $strbidderid=="2941" || $strbidderid=="1930" || $strbidderid=="3650" || $strbidderid=="2790" || $strbidderid=="3698" || $strbidderid=="3692" || $strbidderid=="3691" || $strbidderid=="3433" || $strbidderid=="3652" || $strbidderid=="3716" || $strbidderid=="2986" || $strbidderid=="3828" || $strbidderid=="3169") && ($reply_type=="Req_Loan_Personal") )
	{
		if(strlen(trim($SMSMegWidBankName))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMegWidBankName, $strmobile_no);
		}
	}
	elseif($strbidderid=="1537")
	{
		if(strlen(trim($SMSMessage1537))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMessage1537, $strmobile_no);
		}
	}
	elseif($strbidderid=="1037" || $strbidderid=="3118")
	{
		if(strlen(trim($SMSMessageful))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMessageful, $strmobile_no);
		}
	}
	elseif($strbidderid=="996" || $strbidderid=="997" || $strbidderid=="998" || $strbidderid=="1000" || $strbidderid=="1012" || $strbidderid=="1015" || $strbidderid=="1050")
	{
		if(strlen(trim($SMSMessagefullteron))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMessagefullteron, $strmobile_no);
		}
	}
	elseif($strbidderid=="1512")
	{
		if(strlen(trim($SMSMessagefor1512))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMSforLMS($message.$SMSMessagefor1512, $strmobile_no);
			}
	} 
	elseif($strbidderid=="2973" || $strbidderid=="2974" || $strbidderid=="2975" || $strbidderid=="2932" || $strbidderid=="2930" || $strbidderid=="2896" || $strbidderid=="2933" || $strbidderid=="2929")
	{
		if(strlen(trim($SMSMessage1596))>0)
		{
			if(strlen(trim($strmobile_no)) > 0)
			 	SendSMSforLMS($message.$SMSMessage1596, $strmobile_no);
		}
	}
	elseif($strbidderid=="1688")
	{
		if(strlen(trim($SMSMessage1688))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMSforLMS($message.$SMSMessage1688, $strmobile_no);
			}
	}
	elseif($strbidderid=="2650" || $strbidderid=="2651" || $strbidderid=="2652" || $strbidderid=="2653" || $strbidderid=="2654" || $strbidderid=="2655" || $strbidderid=="2656" || $strbidderid=="2657" || $strbidderid=="2658")
	{
		if(strlen(trim($SMSMessage1596)) > 0)
				 SendSMSforLMS($message.$SMSMessage1596, $strmobile_no);
		
	}
	elseif($strbidderid=="1697")
	{
		if(strlen(trim($SMSMessage1697))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMSforLMS($message.$SMSMessage1697, $strmobile_no);
			}
	}
	elseif($strbidderid=="1705")
	{
		if(strlen(trim($SMSMessage1705))>0)
			{
				if(strlen(trim($strmobile_no)) > 0)
				 SendSMSforLMS($message.$SMSMessage1705, $strmobile_no);
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
				 SendSMSforLMS($message.$SMSMessagefullsp, $strmobile_no);
			}
	}
	elseif($strbidderid==3511 || $strbidderid==5366 || $strbidderid==5360 || $strbidderid==5462 || $strbidderid==5463 || $strbidderid==5652)
	{
		if(strlen(trim($strmobile_no)) > 0)
			 SendSMSforLMS($message.$SMSMessage3511, $strmobile_no);
	}
	elseif($Loan_Amount>=5000000 && $strbidderid==1329 && $City=="Delhi")
	{
		$strmobile_no=9818327381;
		if(strlen(trim($strmobile_no)) > 0)
			SendSMSforLMS($message.$SMSMessage, $strmobile_no);
	}
	
	elseif($strbidderid==5773 && $City=="Nagpur")
	{
		$strmobile_no=8888876756;
		if(strlen(trim($strmobile_no)) > 0)
			SendSMSforLMS($message.$SMSMessage, $strmobile_no);
	}
	else
	{
	 	if($reply_type=="Req_Loan_Home")
		{
		//	$strmobile_no=9811215138;
			if(strlen(trim($strmobile_no)) > 0)
			 	SendSMSforLMS($message.$SMSMessage, $strmobile_no);
			//SendSMSforLMS($message.$SMSMessage, $rcstrmobile_no);
		}
		else
		{
			if(strlen(trim($SMSMessage))>0)
			{
				echo "<br>////FinalMessage////// ".$message."-".$SMSMessage."      ///////////<br>";
				//$rcstrmobile_no=9811215138;
				if(strlen(trim($strmobile_no)) > 0)
					SendSMSforLMS($message.$SMSMessage, $strmobile_no);
					//SendSMSforLMS($message.$SMSMessage, $rcstrmobile_no);
			}
		}
	}
	
	if(($recorcount)>0)
	{
		if(strlen($City)>0)
		{
 			ExecQuery("update Req_Compaign set RequestID=".$request." where (Reply_Type=".$strreply_type." and Bank_Name='".$strbank_name."' and BidderID=".$strbidderid." and City_Wise='".$City_Wise."' and Sms_Flag=1)" );
 echo "SMS UPDATe<br><br>";
 
		}
		else
		{
			ExecQuery("update Req_Compaign set RequestID=".$request." where (Reply_Type=".$strreply_type." and Bank_Name='".$strbank_name."' and BidderID=".$strbidderid." and Sms_Flag=1)" );
		}
	}


}
// Function getleadbysms END

function getBidderContactDetailsToCustomers($strProduct,$strbidderid,$leadid)
{
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

//	echo "mavrType : ".$mvarType."<BR>";
//	echo "mvarCity : ".$mvarCity."<BR>";

	$strSQL = "SELECT Bank_Name,Banker_Contact,BidderID,Bankers_Name  FROM Bidder_Contact_To_Customers WHERE (BidderID in (".$strbidderid.") AND Reply_Type=".$mvarType." AND Sms_Flag=1)";

	//echo "SQL : ".$strSQL."<BR>";
	$result = ExecQuery($strSQL);
	echo mysql_error();

	
	if ($myrow = mysql_fetch_array($result))
	{
		do
		{
			$mvar_Bidder_Bank=trim($myrow["Bank_Name"]);
			$mvar_Bankers_Name=trim($myrow["Bankers_Name"]);
			$mvar_Bidder_Number=trim($myrow["Banker_Contact"]);
			$mvar_BidderID= trim($myrow["BidderID"]);

			if($mvar_Bidder_Number>0)
			{			
				$strmvar_Bidder_Number = "-".$mvar_Bidder_Number;
			}
			else
			{
				$strmvar_Bidder_Number="";
			}
			
			$SMSMessageBidders=$SMSMessageBidders."(".$ctr.") 
			".$mvar_Bidder_Bank."".$strmvar_Bidder_Number." ";
			$ctr=$ctr+1;

		if(($mvar_BidderID==1535 || $mvar_BidderID==1536  || $mvar_BidderID==1542  || $mvar_BidderID==1537 || $mvar_BidderID==1538 || $mvar_BidderID==1139 || $mvar_BidderID==1129 || $mvar_BidderID==1130 || $mvar_BidderID==1137 ||  $mvar_BidderID==1140 ||  $mvar_BidderID==1244 || $mvar_BidderID==1249 || $mvar_BidderID==1975) && $strProduct==1)
			{
			
			$sms_4barclays="Dear ".$strcustname.", you will get a call from this Authorized Barclays Finance representative.".$mvar_Bankers_Name."".$strmvar_Bidder_Number.". Pls do not submit your application for Barclays Finance to any other person.";

if($mvar_BidderID==1535 || $mvar_BidderID==1536  || $mvar_BidderID==1542)
				{
			$sms_4barclaysBid="Dear ".$strcustname.", you will get a call from this Authorized Barclays Finance representative.".$mvar_Bankers_Name."".$strmvar_Bidder_Number.". Pls do not submit your application for Barclays Finance to any other person. ".$strcustcity;
				}

			}
	  }while ($myrow = mysql_fetch_array($result));
		  mysql_free_result($result);
		  $strmvar_Bidder_Number="";
	}
	//echo "<br><br>bidderssms:";
	//echo $SMSMessageBidders."<br>";
	//$Phone = 9811215138;
	if(strlen(trim($SMSMessageBidders))>0)
	{
//		echo $SMSMessage.$SMSMessageBidders."<BR>";
		if(strlen(trim($Phone)) > 0)
		{
			SendSMSforLMS($SMSMessage.$SMSMessageBidders, $Phone);  
		}

	}
	if(strlen(trim($sms_4barclays))>0)
	{
		//$rcPhone=9811215138;

		if(strlen(trim($Phone)) > 0)
		{
			SendSMSforLMS($sms_4barclays, $Phone);
		}

	}
	if(strlen(trim($sms_4barclaysBid))>0)
	{
	//	$bdPhone=9920022193;
		//$bdPhone=9811215138;

		if(strlen(trim($bdPhone)) > 0)
		{
			SendSMSforLMS($sms_4barclaysBid, $bdPhone);
			//SendSMS($sms_4barclaysBid, $rcPhone);   
		}
	}
}

function SendMailToCustomers($GetBankID,$CustomerID,$Product)
{
	$GetBidderID = explode(',',$GetBankID);
	$ExpBidderName = "";
	$ExpBidderContact="";
	for($bid=0;$bid<count($GetBidderID);$bid++)	
	{
		$GetBankSql = "select Bidders_List.BidderID AS biddrbid,BankID,Banker_Contact,Bidder_Contact_To_Customers.BidderID AS contbid from Bidders_List LEFT OUTER JOIN Bidder_Contact_To_Customers ON Bidder_Contact_To_Customers.BidderID=Bidders_List.BidderID AND Bidder_Contact_To_Customers.Sms_Flag=1 and Bidder_Contact_To_Customers.Reply_Type=".$Product." where (Bidders_List.BidderID =".$GetBidderID[$bid]." and Bidders_List.Reply_Type =".$Product." )";
		$GetBankQuery = ExecQuery($GetBankSql);
		$GetBankCount = mysql_num_rows($GetBankQuery);
		$NameID = mysql_result($GetBankQuery,0,'BankID');
		$BankerContact = mysql_result($GetBankQuery,0,'Banker_Contact');

		if($GetBankCount>0)
		{
			$GetBank_Sql = "select * from Bank_Master where BankID  = ".$NameID ."";
			$GetBank_Query = ExecQuery($GetBank_Sql);
			$BidderName = mysql_result($GetBank_Query,0,'Bank_Name');
			$ExpBidderName[] = $BidderName;
			$ExpBidderContact[] = $BankerContact;
			$bdrBidderID = mysql_result($GetBankQuery,0,'biddrbid');
			$arrbiddrbid[] = $bdrBidderID;
		}
	}

	$Bank_Name = "";
	for($exp=0;$exp<count($ExpBidderName);$exp++)
	{	
		$Count = $exp +1;
		$GetExpBidderContact=" - ".$ExpBidderContact[$exp];
		$Bank_Name[] = "<b>".$ExpBidderName[$exp]."".$GetExpBidderContact."</b><br>";

	}
	$FinalBidderName = implode('',$Bank_Name);
	
	$getproductforemailer=getforemailer($Product);
		
	$TableName = getTableName($Product);
	if($Product==1)
	{
		$GetCustIDSql = "select PL_Tenure,Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	}
	else if($Product==3)
	{
	$GetCustIDSql = "select Account_No,Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	}
	else
	{
		$GetCustIDSql = "select Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	}
	
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
	
	if(((strlen($email)) > 0) && (count($ExpBidderName)>0) ) 
	{
		if($Product==2)
		{
			
$Message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  ".$full_name.",</b></p> 
<p>
Congratulations. Your Home Loan Request has been forwarded to the below mentioned Banks/NBFC as per the email sent to you , as you have given the consent on call and this authorization given by you will override the DND/DNC registration on your number ".$mobile_no.".</p>
<p> <table cellpadding='0' cellspacing='0' border='1'>
<tr>
<td height='27' bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:5px; text-align:center;'>Bank Name</td>
<td  bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Contact no </td>
<td bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>&nbsp;</td></tr>";
		for($hl=0; $hl <count($ExpBidderName);$hl++)
		{
	$definetypw=ExecQuery("select BidderID,Define_PrePost,Bidder_Name from Bidders Where (BidderID=".$arrbiddrbid[$hl].")");
	$defrow=mysql_fetch_array($definetypw);
	if($defrow['Define_PrePost'] == "PostPaid")
			{
		if(($defrow['BidderID']=="2720" || $defrow['BidderID']=="2718" || $defrow['BidderID']=="2719" || $defrow['BidderID']=="2730" || $defrow['BidderID']=="2843" || $defrow['BidderID']=="2846" || $defrow['BidderID']=="2958" || $defrow['BidderID']=="3082" || $defrow['BidderID']=="3601" || $defrow['BidderID']=="3602" || $defrow['BidderID']=="3758"  || $defrow['BidderID']=="3759" || $defrow['BidderID']=="4343" || $defrow['BidderID']=="4344"))
				{
				$Message.="<tr><td height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Andromeda<br>(As Agent of ".$ExpBidderName[$hl].")</td><td align='center'>";
			if(strlen($ExpBidderContact[$hl])>1) {
			$Message.="".$ExpBidderContact[$hl].""; } else { $Message.="N.A"; }
			$Message.="</td><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px;padding:2px; '>&nbsp;</td></tr>";

				}
				else
				{
			$Message.="<tr><td height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderName[$hl]."<br>(Direct Bank Sales Team)</td><td align='center'>";
			if(strlen($ExpBidderContact[$hl])>1) {
			$Message.="".$ExpBidderContact[$hl].""; } else { $Message.="N.A"; }
			$Message.="</td><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px;padding:2px; '>&nbsp;</td></tr>";
			}
			}
			else
			{
				$Message.="<tr><td height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$defrow["Bidder_Name"]."<br>As Agent of ".$ExpBidderName[$hl]."</td><td align='center'>".$ExpBidderContact[$hl]."</td><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px;padding:2px; '>Please give Documents for ".$ExpBidderName[$hl]." only</td></tr>";
			}
		}
//<b>".$FinalBidderName."</b><br /><br />
$Message.="</table> <br>You will receive calls within 24 hours from the Companies executives,
you can compare the rates & choose the best deal. <br />
1) Hear quote from each bank/NBFC.<br />
2) Compare EMI & other charges.<br />
3)	Apply to the bank/NBFC which provides you the best offer.<br />
<br />
<b>Know more about</b><br>
&bull; <a href='http://www.deal4loans.com/home-loans-interest-rates.php'>Home Loan Interest Rates</a><br>
&bull; <a href='http://www.deal4loans.com/home-loan-eligibility-calculator.php'>Home loan Eligibility Calculator</a><br>
&bull; <a href='http://www.deal4loans.com/home-loan-emi-calculator1.php'>Home Loan EMI Calculator</a><br>
&bull; <a href='http://www.deal4loans.com/loans/home-loan/best-home-loan-bank-housing-loan-banks/'>Best Home Loans in India</a><br>
&bull; <a href='http://www.deal4loans.com/home-loan-balance-transfer-calculator.php'>Home Loan Balance Transfer</a><br><br>
<font style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'><b>Disclaimer: The rate quotes offered by the bank/NBFC representatives are solely on the bank's/NBFC's discretion. We do not hold any responsibility for any miscommunication|misrepresentation given by the bank's/NBFC's sales representative.</b></font></p><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Quiz</a></td><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Guru </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Bimadeals.com </a></td><td align='center' valign='middle'> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";
				
		}
		else
		{ 
			$Message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  ".$full_name.",</b></p> 
<p>
Thank you for choosing Deal4loans.com, we are pleased to inform you
that your registration for ".$getproductforemailer." has been successful and we
have forwarded your request to the following ".$getproductforemailer." bank service providers:</p>
<p> <table cellpadding='0' cellspacing='0' border='1'>
<tr>
<td height='27' bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:5px; text-align:center;'>Bank Name</td>
<td  bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Contact no </td>
<td bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>&nbsp;</td></tr>";
		for($lap=0; $lap <count($ExpBidderName);$lap++)
		{
	$definetypw=ExecQuery("select Define_PrePost,Bidder_Name from Bidders Where (BidderID=".$arrbiddrbid[$lap].")");
	$defrow=mysql_fetch_array($definetypw);
	if($defrow['Define_PrePost'] == "PostPaid")
			{
			$Message.="<tr><td height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderName[$lap]."<br>(Direct Bank Sales Team)</td><td align='center'>";
			if(strlen($ExpBidderContact[$lap])>1) {
			$Message.="".$ExpBidderContact[$lap].""; } else { $Message.="N.A"; }
			$Message.="</td><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px;padding:2px; '>&nbsp;</td></tr>";
			}
			else
			{
				$Message.="<tr><td height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$defrow["Bidder_Name"]."<br>As Agent of ".$ExpBidderName[$lap]."</td><td align='center'>".$ExpBidderContact[$lap]."</td><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px;padding:2px; '>Please give Documents for ".$ExpBidderName[$lap]." only</td></tr>";
			}
		}
//<b>".$FinalBidderName."</b><br /><br />
$Message.="</table> <br>
You will receive calls within 24 hours from the Companies executives,
you can compare the rates & choose the best deal. <br />
1) Hear quote from each bank/NBFC.<br />
2) Compare EMI & other charges.<br />
3)	Apply to the bank/NBFC which provides you the best offer.<br />
<br />
<b>Tips for Best loan deal</b><br />
1) Compare exact Emi|Processing fee | Tenure| Documents before choosing bank.<br />
2) Never pay any fee/cash to any person to get your Home Loan sanctioned.<br />
3) Only give documents to one bank and check whether he is authorized Bank employee or vendor.<br /><br />
<b>Please ensure that you process your application with the concerned bank respective only. Do not entertain multiple offers from one single person, compare yourself and choose the best. <br><br>Deal4loans do not sell any loans on its own. We act as a comparison online platform to choose the best deal. For any product, process related issue please contact your Bank where you have submitted your application</b>
<br><br>
<font style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>Deal4loans.com- <a href='http://www.youtube.com/watch?v=fyWDCDpRUDs'>Watch us on Youtube on how do we help you crack the best deal</a>.<br><br><b>Disclaimer: The rate quotes offered by the bank/NBFC representatives are solely on the bank's/NBFC's discretion. We do not hold any responsibility for any miscommunication|misrepresentation given by the bank's/NBFC's sales representative.</b></font></p><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Quiz</a></td><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Guru </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Bimadeals.com </a></td><td align='center' valign='middle'> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";
		}


	/*$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	//$headers .= 'To: '.$full_name.' ' . "\r\n";
	$headers .= 'From: deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Bcc: extra4testingnew@gmail.com' . "\r\n";*/
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

	//echo $Message;	
}			  

?>