<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

 function getReqValue($pKey){
    $titles = array(
       '1' => 'Req_Loan_Personal', 
        '2' =>'Req_Loan_Home', 
       '3' => 'Req_Loan_Car',
       '4' => 'Req_Credit_Card', 
       '5' => 'Req_Loan_Against_Property',
       '6' => 'Req_Business_Loan', 
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }


function getBidderEligibleSms()
{
	$bidderquery="Select * from Req_Compaign Where Sms_Flag=1";
	//echo "query1".$bidderquery."<br>";
	 list($Bidderrecorcount,$getrow)=MainselectfuncNew($bidderquery,$array = array());
		$cntr=0;
	
	while($cntr<count($getrow))
        {
		 $Reply_Type = $getrow[$cntr]['Reply_Type'];
		 $Bank_Name = $getrow[$cntr]['Bank_Name'];
		 $BidderID = $getrow[$cntr]['BidderID'];
	 	 $RequestID = $getrow[$cntr]['RequestID'];
		 $Start_Date = $getrow[$cntr]['Start_Date'];
		 $Mobile_no = $getrow[$cntr]['Mobile_no'];

		 getleadbysms($Reply_Type,$Bank_Name,$BidderID,$RequestID,$Start_Date,$Mobile_no);
	 
	 $cntr=$cntr+1;}

}

function getleadbysms($strreply_type,$strbank_name,$strbidderid,$requestid,$strstart_date,$strmobile_no)
{
	$reply_type=getReqValue($strreply_type);
	
	 $SMSMessage="";
	 $ctr=1;
	If((strlen(trim($requestid))<=0))
	{
	
		$search_query="SELECT * FROM Req_Feedback_Bidder1,".$reply_type." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$reply_type.".RequestID AND Req_Feedback.BidderID= ".$strbidderid." WHERE Req_Feedback_Bidder1.AllRequestID= ".$reply_type.".RequestID and Req_Feedback_Bidder1.BidderID = ".$strbidderid." and (Req_Feedback_Bidder1.Allocation_Date >='".$strstart_date." 00:00:00' and ".$reply_type.".Dated >='".$strstart_date." 00:00:00') ";
	}
	else
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,".$reply_type." LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=".$reply_type.".RequestID AND Req_Feedback.BidderID= ".$strbidderid." WHERE Req_Feedback_Bidder1.Feedback_ID>'$requestid' and Req_Feedback_Bidder1.AllRequestID= ".$reply_type.".RequestID and Req_Feedback_Bidder1.BidderID = ".$strbidderid." and (Req_Feedback_Bidder1.Allocation_Date >='".$strstart_date." 00:00:00' and ".$reply_type.".Dated >='".$strstart_date." 00:00:00') ";
	}
	echo "query2::".$search_query."<br>";

list($recorcount,$myrow)=Mainselectfunc($search_query,$array = array());

	 $currentdate=date('d-m-Y');
	$message ="Leads as on (".$currentdate.") :";

	
	$SMSMessage="";
			
		for($ii=0;$ii<$recorcount;$ii++)
		{
			//$SMSMessage="";
			$request=trim($myrow[$ii]["Feedback_ID"]);
			$Name=trim($myrow[$ii]["Name"]);
			$Phone=trim($myrow[$ii]["Mobile_Number"]);

			$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone." ";
			//echo $SMSMessage;
			$ctr=$ctr+1;
	  }

	//$mobile_no="9811215138";
	if(strlen(trim($SMSMessage))>0)
	{
		if(strlen(trim($strmobile_no)) > 0)
		 SendSMS($message.$SMSMessage, $strmobile_no);
		//if(strlen(trim($mobile_no)) > 0)
		//SendSMS($message.$SMSMessage, $mobile_no);

	}
	
	If(($recorcount)>0)
	{
	$DataArray = array("RequestID"=>$request);
		$wherecondition ="(Reply_Type=".$strreply_type." and Bank_Name='".$strbank_name."' and BidderID=".$strbidderid.")";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	}

}
 



main();

 function main()
 {
	getBidderEligibleSms();
	//getleadbysms2();
 }

?>