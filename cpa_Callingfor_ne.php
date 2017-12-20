<?php
require 'scripts/db_init.php';

function CallingCRMProcess($GlobalId,$LeadAllocationLogic,$SourceVal) {
$arr = array('CallerAccountCFL,CallerAccountIIFL',
        'CallerAccountRBLDH,CallerAccountINDUSINDBCH,CallerAccountINDUSINDDMP,CallerAccountRBLBHC,CallerAccountRBLDMP,CallerAccountOICICI,CallerAccountMTata,CallerAccountCICICI,CallerAccountMICICI,CallerAccountBTata,CallerAccountICICI');
//City
if($GlobalId==6943)
{
   $CityVal = "'Delhi','Gaziabad','Gurgaon','Noida','Faridabad','Greater Noida','Mumbai','Thane','Navi mumbai','Pune'"; 
}else if($GlobalId==6944)
{
 $CityVal = "'Bangalore','Chennai ','Hyderabad'";    
}

foreach($arr as $value) {
        $source = $SourceVal;
        $lead_allocation_logic = $LeadAllocationLogic; 
        $Global_Access_ID = $GlobalId;
        $currentdate = Date('Y-m-d');
        //$currentdate="2017-04-20";
        $min_date = $currentdate . " 00:00:00";
        $max_date = $currentdate . " 23:59:59";

        $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
        //echo "query 1".$startprocess . "<br><br>";
        $startprocessresult = ExecQuery($startprocess);
        $recordcount = mysql_num_rows($startprocessresult);
        $row = mysql_fetch_array($startprocessresult);
        $total_lead_count = $row["total_lead_count"];

             $ArrVal = str_replace(",","','",$value);
            $getAgentIDSql = "select BidderID from Bidders where leadidentifier in ('$ArrVal')";
			 //echo "query 2".$getAgentIDSql . "<br><br>";
                $getBiddersIDQry = ExecQuery($getAgentIDSql);
                $recordCountBidd = mysql_num_rows($getBiddersIDQry);
                $BiddIDArr = '';
                $counterValA = 1;
                for ($i = 0; $i < $recordCountBidd; $i++) {
                    $BidderID = mysql_result($getBiddersIDQry, $i, 'BidderID');
                    $BiddIDArr[$counterValA] = $BidderID;
                    $counterValA = $counterValA + 1;
                }
                $BiddIDStr = implode(',', $BiddIDArr);
				//echo "<br><br>";
           if ($total_lead_count > 0) {     
if ($value=='CallerAccountCFL,CallerAccountIIFL') {
              $Cpaplqry = "SELECT * FROM Req_Feedback_Bidder_PL,`Req_Loan_Personal` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in(" . $BiddIDStr . ") WHERE Req_Feedback_Bidder_PL.AllRequestID=`Req_Loan_Personal`.RequestID and Req_Feedback_Bidder_PL.BidderID  in(" . $BiddIDStr . ") and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Feedback_ID >".$total_lead_count." ) AND Req_Feedback.Feedback  IN ('Not Eligible - FOIR','Not Eligible - Salary','Not Eligible - Others','Not Interested - Direct','Not Interested - Offer','Not Interested - Loan Amount','Not Contactable','Not Eligible','Not Interested') AND Req_Loan_Personal.City IN ($CityVal) order by Feedback_ID ASC LIMIT 0,5";
            } else {
                $Cpaplqry = "SELECT * FROM client_lead_allocate,Req_Loan_Personal  WHERE (client_lead_allocate.BidderID in(" . $BiddIDStr . ") and client_lead_allocate.Reply_Type=1 and client_lead_allocate.AllRequestID=Req_Loan_Personal.RequestID and (client_lead_allocate.Feedback_ID >".$total_lead_count.") AND client_lead_allocate.Feedback IN ('Not Eligible - FOIR','Not Eligible - Salary','Not Eligible - Others','Not Interested - Direct','Not Interested - Offer','Not Interested - Loan Amount','Not Contactable','Not Eligible','Not Interested') AND Req_Loan_Personal.City IN ($CityVal)) order by Feedback_ID ASC LIMIT 0,5";
            }
       }
	   else
	{
		   if ($value=='CallerAccountCFL,CallerAccountIIFL') {
              $Cpaplqry = "SELECT * FROM Req_Feedback_Bidder_PL,`Req_Loan_Personal` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in(" . $BiddIDStr . ") WHERE Req_Feedback_Bidder_PL.AllRequestID=`Req_Loan_Personal`.RequestID and Req_Feedback_Bidder_PL.BidderID  in(" . $BiddIDStr . ") and Req_Feedback_Bidder_PL.Reply_Type=1 and (Req_Feedback_Bidder_PL.Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' ) AND Req_Feedback.Feedback  IN ('Not Eligible - FOIR','Not Eligible - Salary','Not Eligible - Others','Not Interested - Direct','Not Interested - Offer','Not Interested - Loan Amount','Not Contactable','Not Eligible','Not Interested') AND Req_Loan_Personal.City IN ($CityVal) order by Feedback_ID ASC  LIMIT 0,5";
            } else {
                $Cpaplqry = "SELECT * FROM client_lead_allocate,Req_Loan_Personal  WHERE (client_lead_allocate.BidderID in(" . $BiddIDStr . ") and client_lead_allocate.Reply_Type=1 and client_lead_allocate.AllRequestID=Req_Loan_Personal.RequestID and (client_lead_allocate.Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') AND client_lead_allocate.Feedback IN ('Not Eligible - FOIR','Not Eligible - Salary','Not Eligible - Others','Not Interested - Direct','Not Interested - Offer','Not Interested - Loan Amount','Not Contactable','Not Eligible','Not Interested') AND Req_Loan_Personal.City IN ($CityVal)) order by Feedback_ID ASC LIMIT 0,5";
            }
	}
      // echo $Cpaplqry . "<br><br>";
        $Cpaplqryresult = ExecQuery($Cpaplqry);
        $recordcount1 = mysql_num_rows($Cpaplqryresult);
        $bidderID = "";

        $counterVal = 1;
        $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='" . $source . "' and Status=1) order by BidderID ASC");
        while ($rowcal = mysql_fetch_array($arrcallerqry)) {
            $arrCallerrID[$counterVal] = $rowcal["BidderID"];
            $counterVal = $counterVal + 1;
        }
        //print_r($arrCallerrID)."<br><br>";

        while ($row2 = mysql_fetch_array($Cpaplqryresult)) {
            $Feedback_ID = $row2["Feedback_ID"];
            $AllRequestID = $row2["AllRequestID"];
            $BidderID = $row2["BidderID"];
            $Allocation_Date = $row2["Updated_Date"];

            if ($AllRequestID > 0) {
                $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')");
				echo "Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')<br><br>";

				echo "i m here";
                $seqid = mysql_fetch_array($sequenceid);
                $last_allocated_to = $seqid["last_allocated_to"];
                $total_no_agents = $seqid["total_no_agents"];

                if ($total_no_agents > $last_allocated_to) {
                    $sequence = $last_allocated_to + 1;
                } else {
                    $sequence = 1;
                }

                $getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '" . $Feedback_ID . "' and BidderID=" . $BidderID . ")";

                $getCheckQuery = ExecQuery($getCheckSQl);
                $getCheckNum = mysql_num_rows($getCheckQuery);
                if ($getCheckNum > 0) {
					echo "already existing<br><br>";
                    //Already Existing Lead
                } else {
                    $callerID = $arrCallerrID[$sequence];
                    if ($AllRequestID > 0 && $callerID > 1) {
                        //insert allocation
                        echo $final_allocationciti = "INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('" . $Feedback_ID . "','" . $AllRequestID . "','" . $callerID . "','1', Now())";
						echo "<br><br>";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
                        echo $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
                        //echo "<br>" . $final_allocationciti . "<br>";
						echo "<br><br>";
						 $updateqryresult = ExecQuery($updateqry);
                       // echo "<br><br>";
                    }
                }
                $getCheckNum = '';
            }
        }
    }
}
//CallingCRMProcess(6943,'107','CallerAccountDialingDMP');

//CallingCRMProcess(6944,'108','CallerAccountDialingBCH');

// Updated functions


function CallingCRMProcessnew($GlobalId,$LeadAllocationLogic,$SourceVal) {
$arr = array('CallerAccountCICICI,CallerAccountMICICI,CallerAccountPICICI,CallerAccountICICI,CallerAccountICICIBangalore,CallerAccountICICIHyderabad');
//City
if($GlobalId==6943)
{
   $CityVal = "'Delhi','Gaziabad','Gurgaon','Noida','Faridabad','Greater Noida','Mumbai','Thane','Navi mumbai','Pune'"; 
}else if($GlobalId==6944)
{
 $CityVal = "'Bangalore','Chennai ','Hyderabad'";    
}

foreach($arr as $value) {
        $source = $SourceVal;
        $lead_allocation_logic = $LeadAllocationLogic; 
        $Global_Access_ID = $GlobalId;
        $currentdate = Date('Y-m-d');
        //$currentdate="2017-04-20";
        $min_date = $currentdate . " 00:00:00";
        $max_date = $currentdate . " 23:59:59";

        $startprocess = "Select total_lead_count From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
        //echo "query 1".$startprocess . "<br><br>";
        $startprocessresult = ExecQuery($startprocess);
        $recordcount = mysql_num_rows($startprocessresult);
        $row = mysql_fetch_array($startprocessresult);
        $total_lead_count = $row["total_lead_count"];

             $ArrVal = str_replace(",","','",$value);
            $getAgentIDSql = "select BidderID from Bidders where leadidentifier in ('$ArrVal')";
			 echo "query 2".$getAgentIDSql . "<br><br>";
                $getBiddersIDQry = ExecQuery($getAgentIDSql);
                $recordCountBidd = mysql_num_rows($getBiddersIDQry);
                $BiddIDArr = '';
                $counterValA = 1;
                for ($i = 0; $i < $recordCountBidd; $i++) {
                    $BidderID = mysql_result($getBiddersIDQry, $i, 'BidderID');
                    $BiddIDArr[$counterValA] = $BidderID;
                    $counterValA = $counterValA + 1;
                }
                $BiddIDStr = implode(',', $BiddIDArr);
				echo "<br><br>";
           if ($total_lead_count > 0) {     
                //$Cpaplqry = "SELECT * FROM client_lead_allocate,Req_Loan_Personal  WHERE (client_lead_allocate.BidderID in(" . $BiddIDStr . ") and client_lead_allocate.Reply_Type=1 and client_lead_allocate.AllRequestID=Req_Loan_Personal.RequestID and (client_lead_allocate.Feedback_ID >".$total_lead_count.") AND client_lead_allocate.Feedback IN ('Not Eligible - FOIR','Not Eligible - Salary','Not Eligible - Others','Not Interested - Direct','Not Interested - Offer','Not Interested - Loan Amount','Not Contactable','Not Eligible','Not Interested') AND Req_Loan_Personal.City IN ($CityVal)) order by Feedback_ID ASC LIMIT 0,5";

				$Cpaplqry = "SELECT * FROM client_lead_allocate,Req_Loan_Personal  WHERE (client_lead_allocate.BidderID in(" . $BiddIDStr . ") and client_lead_allocate.Reply_Type=1 and client_lead_allocate.AllRequestID=Req_Loan_Personal.RequestID and (client_lead_allocate.Allocation_Date Between '2017-04-01 00:00:00' and '2017-04-31 23:59:59') AND client_lead_allocate.Feedback IN ('Not Eligible - FOIR','Not Eligible - Salary','Not Eligible - Others','Not Interested - Direct','Not Interested - Offer','Not Interested - Loan Amount','Not Contactable','Not Eligible','Not Interested') and Req_Loan_Personal.Net_Salary>= 420000 AND Req_Loan_Personal.City IN ($CityVal) and (client_lead_allocate.Feedback_ID >".$total_lead_count.")) order by Feedback_ID ASC LIMIT 0,20";
       }
	   else
		{
			   //$Cpaplqry = "SELECT * FROM client_lead_allocate,Req_Loan_Personal  WHERE (client_lead_allocate.BidderID in(" . $BiddIDStr . ") and client_lead_allocate.Reply_Type=1 and client_lead_allocate.AllRequestID=Req_Loan_Personal.RequestID and (client_lead_allocate.Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') AND client_lead_allocate.Feedback IN ('Not Eligible - FOIR','Not Eligible - Salary','Not Eligible - Others','Not Interested - Direct','Not Interested - Offer','Not Interested - Loan Amount','Not Contactable','Not Eligible','Not Interested') AND Req_Loan_Personal.City IN ($CityVal)) order by Feedback_ID ASC LIMIT 0,5";

			   $Cpaplqry = "SELECT * FROM client_lead_allocate,Req_Loan_Personal  WHERE (client_lead_allocate.BidderID in(" . $BiddIDStr . ") and client_lead_allocate.Reply_Type=1 and client_lead_allocate.AllRequestID=Req_Loan_Personal.RequestID and (client_lead_allocate.Allocation_Date Between '2017-04-01 00:00:00' and '2017-04-31 23:59:59') AND client_lead_allocate.Feedback IN ('Not Eligible - FOIR','Not Eligible - Salary','Not Eligible - Others','Not Interested - Direct','Not Interested - Offer','Not Interested - Loan Amount','Not Contactable','Not Eligible','Not Interested') and Req_Loan_Personal.Net_Salary>= 420000 AND Req_Loan_Personal.City IN ($CityVal)) order by Feedback_ID ASC LIMIT 0,20";
			   
		}
       echo $Cpaplqry . "<br><br>";
        $Cpaplqryresult = ExecQuery($Cpaplqry);
        $recordcount1 = mysql_num_rows($Cpaplqryresult);
        $bidderID = "";

        $counterVal = 1;
        $arrcallerqry = ExecQuery("Select BidderID from Bidders Where (leadidentifier='" . $source . "' and Status=1) order by BidderID ASC");
        while ($rowcal = mysql_fetch_array($arrcallerqry)) {
            $arrCallerrID[$counterVal] = $rowcal["BidderID"];
            $counterVal = $counterVal + 1;
        }
        //print_r($arrCallerrID)."<br><br>";

        while ($row2 = mysql_fetch_array($Cpaplqryresult)) {
            $Feedback_ID = $row2["Feedback_ID"];
            $AllRequestID = $row2["AllRequestID"];
            $BidderID = $row2["BidderID"];
            $Allocation_Date = $row2["Updated_Date"];

            if ($AllRequestID > 0) {
                $sequenceid = ExecQuery("Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')");
				echo "Select last_allocated_to,total_no_agents From lead_allocation_table Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";

				echo "<br><bR>i m here<br><bR>";
                $seqid = mysql_fetch_array($sequenceid);
                $last_allocated_to = $seqid["last_allocated_to"];
                $total_no_agents = $seqid["total_no_agents"];

                if ($total_no_agents > $last_allocated_to) {
                    $sequence = $last_allocated_to + 1;
                } else {
                    $sequence = 1;
                }
				echo "hello<br><bR>";
                echo $getCheckSQl = "select Feedback_ID from client_lead_allocate where (Feedback_ID = '" . $Feedback_ID . "' and BidderID=" . $GlobalId . ")";

                $getCheckQuery = ExecQuery($getCheckSQl);
                $getCheckNum = mysql_num_rows($getCheckQuery);
                if ($getCheckNum > 0) {
                    //Already Existing Lead
                } else {
                    $callerID = $arrCallerrID[$sequence];
                    if ($AllRequestID > 0 && $callerID > 1) {
                        //insert allocation
                        echo $final_allocationciti = "INSERT client_lead_allocate (Feedback_ID, AllRequestID, BidderID, Reply_Type, Allocation_Date) VALUE ('" . $Feedback_ID . "','" . $AllRequestID . "','" . $callerID . "','1', Now())";
						echo "<br><br>";
						$final_allocationcitiresult = ExecQuery($final_allocationciti);
                        echo $updateqry = "Update lead_allocation_table set last_allocated_to='" . $sequence . "' , total_lead_count='" . $Feedback_ID . "' Where (Citywise='" . $source . "' and lead_allocation_logic='" . $lead_allocation_logic . "')";
                        //echo "<br>" . $final_allocationciti . "<br>";
						echo "<br><br>";
						$updateqryresult = ExecQuery($updateqry);
                       // echo "<br><br>";
                    }
                }
                $getCheckNum = '';
            }
        }
    }
}


CallingCRMProcessnew(6943,'107','CallerAccountDialingDMP');
CallingCRMProcessnew(6944,'108','CallerAccountDialingBCH');

//SELECT * FROM client_lead_allocate,Req_Loan_Personal  WHERE (client_lead_allocate.BidderID in(6483,6358,6359,6360,6361,6362,6482,6514) and client_lead_allocate.Reply_Type=1 and client_lead_allocate.AllRequestID=Req_Loan_Personal.RequestID and (client_lead_allocate.Allocation_Date Between '2017-04-01 00:00:00' and '2017-04-10 23:59:59') AND client_lead_allocate.Feedback IN ('Not Eligible - FOIR','Not Eligible - Salary','Not Eligible - Others','Not Interested - Direct','Not Interested - Offer','Not Interested - Loan Amount','Not Contactable','Not Eligible','Not Interested') AND Req_Loan_Personal.City IN ('Delhi','Gaziabad','Gurgaon','Noida','Faridabad','Greater Noida','Mumbai','Thane','Navi mumbai','Pune')) order by Feedback_ID ASC

?>
