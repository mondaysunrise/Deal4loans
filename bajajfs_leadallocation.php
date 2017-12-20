<?php

function bajajfs($city,$net_salary,$mobile,$name,$bajajvalue,$Company_Name,$Loan_Amount)
{
		$strbidderid="";
		$getbid="select BidderID from Bidders_List Where (City like '%".$city."%' and Reply_Type=1 and Restrict_Bidder=1 and BidderID in (2428,2437,2423,2444,2450,5074,2439,2422,2438,2447,2426,4912,2424,2435,2442,2441,2451,2443,2448,2427,2440,2432,4928,3629,3842,2446,5078,2436,4911,2445,4910,3335,2449,2434,2433,4631,2430,2431))";
		list($numRows,$bidrow)=MainselectfuncNew($getbid,$array = array());
		//$bidrow=mysql_fetch_array($getbid);
	
		
		/*$bidno=ExecQuery("select * from Req_Compaign Where (BidderID=".$bidrow["BidderID"]." and Sms_Flag=1)");
		
		if($bidrow["BidderID"]=="2425"){$asmname=" VS";}elseif($bidrow["BidderID"]=="3842"){$asmname=" SB";}elseif($bidrow["BidderID"]=="2429"){$asmname=" KD";}elseif($bidrow["BidderID"]=="3335"){$asmname=" SN";}

		while($bidcno=mysql_fetch_array($bidno))
	{
		 $bidcontactno = $bidcno["Mobile_no"];
		 $currentdate=date('d-m-Y');
		 $smstext="Your Leads for pl on (".$currentdate.") : ".$name."-".$mobile.",cty- ".$city.",sal- ".$net_salary.",LA -".$Loan_Amount." CN-ExclusiveMailer";

			if(strlen(trim($bidcontactno)) > 0)
		{
			 SendSMSforLMS($smstext.$asmname, $bidcontactno);		
		}

		 $smstextrc="Your Leads for pl on (".$currentdate.") : ".$name."-".$mobile.",cty- ".$city.",sal- ".$net_salary.",LA -".$Loan_Amount." CN-Exclusivemailer".$bidcontactno;
	}*/
	
		$sentflag=1;

	
	return($sentflag);
}


?>