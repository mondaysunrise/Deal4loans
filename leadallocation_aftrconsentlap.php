<?php
require 'scripts/db_init.php';
//require 'scripts/db_init-rnew.php';
require 'scripts/functions_nw.php';

transfer_tofinalallocation();

function transfer_tofinalallocation()
{
	$conpprosuct=ExecQuery("select * from  Req_Compaign Where Bank_Name='LoanAP' and Compaign_ID=4104");
	$row=mysql_fetch_array($conpprosuct);
	$RequestID = $row["RequestID"];
	$today= date('Y-m-d');
	$today_date = $today." 00:00:00";
	if(strlen($RequestID)>0)
	{
		$qry1= "select AllRequestID from Req_Feedback_Bidder_LAP1 Where ((Consent=1 and final_allocate=0) and (DATE_SUB( NOW() , INTERVAL '00:15' HOUR_MINUTE ) >= Allocation_Date) and (Allocation_Date>'".$today_date."' )) group by AllRequestID";
	}
	else
	{
		$qry1= "select AllRequestID from Req_Feedback_Bidder_LAP1 Where ((Consent=1 and (DATE_SUB( NOW() , INTERVAL '00:15' HOUR_MINUTE ) >= Allocation_Date) and final_allocate=0) and (Allocation_Date>'".$today_date."' )) group by AllRequestID";
	}
//	$qry1= "select AllRequestID from Req_Feedback_Bidder_LAP1 Where (Consent=1 and AllRequestID = '1109265') group by AllRequestID";

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
echo 	"Select City, City_Other from Req_Loan_Against_Property Where RequestID=".$AllRequestID;
	 	$cust_city=ExecQuery("Select City, City_Other from Req_Loan_Against_Property Where RequestID=".$AllRequestID);
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
		//end to get city
echo $AllRequestID."--".$Customer_City;
		leadallocation($AllRequestID, $Customer_City);
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

function leadallocation($LeadID, $Customer_City)
{
	echo $LeadID."----".$Customer_City;
	echo "<br>";
	echo $today = date('Y-m-d');
	

$qry2= "select * from Req_Feedback_Bidder_LAP1 Where (Consent=1 and final_allocate=0 and AllRequestID='".$LeadID."') order by Allocation_Date DESC Limit 0,4";
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
				
			$checkfinal_alocate=ExecQuery("select AllRequestID from Req_Feedback_Bidder1 where (Reply_Type=1 and AllRequestID='".$AllRequestID."' and BidderID='".$BidderID."' and Allocation_Date between '".$today." 00:00:00' and '".$today." 23:59:59')");
			$recordcount_alocate = mysql_num_rows($checkfinal_alocate);
			echo "<br>select AllRequestID from Req_Feedback_Bidder1 where (AllRequestID='".$AllRequestID."' and BidderID='".$BidderID."' and Allocation_Date between '".$today." 00:00:00' and '".$today." 23:59:59')<br>";
			
			if($recordcount_alocate>0)
			{}
			else
			{
			echo	$InsertFeedBackSql = "Insert into Req_Feedback_Bidder1 (AllRequestID,BidderID,Reply_Type,Allocation_Date) Values ('".$AllRequestID."', '".$BidderID."','".$ProductType."', Now())";
			
			$InsertFeedBackResult = ExecQuery($InsertFeedBackSql);
			 $final_allocation="INSERT Req_Feedback_Bidder_LAP (AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('".$AllRequestID."','".$BidderID."','".$ProductType."', Now())";
			$final_allocationresult = ExecQuery($final_allocation);
			$recordLastInserted = mysql_insert_id();
			$recordcountA[] = $recordLastInserted;
			
			/////
	echo "<br>";
		//echo "181";
		echo $updateFeedbackSql = "Update Req_Compaign set RequestID='".$Feedback_ID."' Where Bank_Name='LoanAP' and Compaign_ID=4104";
		$updateFeedbackQuery = ExecQuery($updateFeedbackSql);
		$updateFinalAllocate = "Update Req_Feedback_Bidder_LAP1 set final_allocate=1 Where (AllRequestID='".$AllRequestID."' and BidderID='".$BidderID."')";
		ExecQuery($updateFinalAllocate);
	echo "<br>";
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
	//$strmobile_no=9811215138;
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
			$Loan_Amount=trim($myrow["Loan_Amount"]);
			
			$Add_Comment=trim($myrow["Add_Comment"]);
			
				$message ="Your Leads for ".$getforsms." on (".$currentdate.") : ";
				$SMSMessage=$SMSMessage."Name - ".$Name.", Mobile - ".$Phone;
				$SMSMessagewcty=$SMSMessage."Name - ".$Name.", Mobile - ".$Phone.", ".$City;

				$SMSMessage1688=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.", ".$CarType.", ".$Car_Model;
				
				$SMSMessagefor1512=$SMSMessagefor1512."(".$ctr.") ".$Name."-".$Phone."-".$Email;
				
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
	if($strbidderid==5573 || $strbidderid==5574 || $strbidderid==5961)
	{
		if(strlen(trim($SMSMessage))>0)
		{
				if(strlen(trim($strmobile_no)) > 0)
				SendSMSforLMS($message.$SMSMessagewcty, $strmobile_no);
		}
	}
	else
	{
		if(strlen(trim($SMSMessage))>0)
		{
				if(strlen(trim($strmobile_no)) > 0)
				SendSMSforLMS($message.$SMSMessage, $strmobile_no);
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
			
			$SMSMessageBidders=$SMSMessageBidders."(".$ctr.") ".$mvar_Bidder_Bank."".$strmvar_Bidder_Number." ";
			$ctr=$ctr+1;

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

	$GetCustIDSql = "select Name,Email,City,Net_Salary,City_Other,Mobile_Number from ".$TableName." where RequestID = ".$CustomerID." ";
	
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
		$Message = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'>  <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'></td><td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />  <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td></tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><p><b>Dear  ".$full_name.",</b></p> <p>
Congratulations. Your LAP  Request has been forwarded to the below mentioned Banks as per the email sent to you , as you have given the consent via sms validation for your mobile number and this authorization given by you will override the DND/DNC registration on your number ".$mobile_no.".</p>
<p> <table cellpadding='0' cellspacing='0' border='1'>
<tr>
<td height='27' bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:5px; text-align:center;'>Bank Name</td>
<td  bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>Contact no </td>
<td bgcolor='#494949' style='color:#FFFFFF; font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>&nbsp;</td></tr>";
		for($hl=0; $hl <count($ExpBidderName);$hl++)
		{
	$definetypw=ExecQuery("select Associated_Bank,BidderID,Define_PrePost,Bidder_Name from Bidders Where (BidderID=".$arrbiddrbid[$hl].")");
	$defrow=mysql_fetch_array($definetypw);
	if($defrow['Define_PrePost'] == "PostPaid")
			{
			$Message.="<tr><td height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$ExpBidderName[$hl]."<br>(Direct Bank Sales Team)</td><td align='center'>";
			if(strlen($ExpBidderContact[$hl])>1) {
			$Message.="".$ExpBidderContact[$hl].""; } else { $Message.="N.A"; }
			$Message.="</td><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px;padding:2px; '>&nbsp;</td></tr>";
			
			}
			else
			{
				$Message.="<tr><td height='24' style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px; font-weight:bold; padding:2px; text-align:center;'>".$defrow["Associated_Bank"]."<br>As Agent of ".$ExpBidderName[$hl]."</td><td align='center'>".$ExpBidderContact[$hl]."</td><td style='font-family:Verdana,Arial,Helvetica,sans-serif; font-size:11px;padding:2px; '>Please give Documents for ".$ExpBidderName[$hl]." only</td></tr>";
			}
		}
//<b>".$FinalBidderName."</b><br /><br />
$Message.="</table> <br>You will receive calls within 24 hours from the Companies executives,
you can compare the rates & choose the best deal. <br />
1) Hear quote from each bank.<br />
2) Compare EMI & other charges.<br />
3)	Apply to the bank which provides you the best offer.<br />
<br />
<b>Know more about</b><br>
&bull; <a href='http://www.deal4loans.com/loan-against-property-interest-rate.php'>Loan Against Property Interest Rates</a><br>
&bull; <a href='http://www.deal4loans.com/Contents_Loan_Against_Property_Eligibility.php'>Loan Against Property Eligibility</a><br>
&bull; <a href='http://www.deal4loans.com/loans/loan-against-property/loan-against-property-eligibility-calculator-calculate-your-eligibility/'>Loan Against Property Eligibility Calculator</a><br>
<br>
<font style='font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;'>Deal4loans.com- <a href='http://www.youtube.com/watch?v=fyWDCDpRUDs'>Watch us on Youtube on how do we help you crack the best deal</a>.<br><br><b>Disclaimer: The rate quotes offered by the bank representatives are solely on the bank's discretion. We do not hold any responsibility for any miscommunication|misrepresentation given by the bank's sales representative.</b></font></p><p>Warm Regards,<br />Team Deal4Loans<br /></p> </td></tr>  <tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-aug08' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Quiz</a></td><td align='center' valign='middle' style='color:#ffffff; font-family:Verdana; font-size:12px;'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Loan Guru </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-sendnow' style='color:#ffffff; font-family:Verdana; font-size:12px;'>Bimadeals.com </a></td><td align='center' valign='middle'> </td> <td valign='middle'>&nbsp;</td> </tr></table></td></tr></table>";
	
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