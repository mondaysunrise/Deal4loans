<?php
require_once 'dialer_constant.php';
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

function getFeedbackD4l($code)
{
	if($code=="CALLBK")	{ $dFeedback = "Call Back";	}
	else if($code=="fp" || $code=="CBHOLD") { $dFeedback = "Call Back Hold";	}
	else if($code=="NC") { $dFeedback = "Not Contactable";	}
	else if($code=="NI") { $dFeedback = "Not Interested";	}
	else if($code=="OTHRP") { $dFeedback = "Other Product";	}	
	else if($code=="SNDNOW") { $dFeedback = "Send Now";	}
	else if($code=="WN") { $dFeedback = "Wrong Number";	}
	else if($code=="NE") { $dFeedback = "Not Eligible";	}		
	else if($code=="NECNL") { $dFeedback = "NOT ELIGIBLE CNL";	}
	else if($code=="NAPD") { $dFeedback = "Not Applied";	}
	else if($code=="DUP") { $dFeedback = "DUPLICATE";	}
	else if($code=="RING") { $dFeedback = "Ringing";	}
	else if($code=="NAPD") { $dFeedback = "NOT APPLIED";	}	
	else if($code=="LB") { $dFeedback = "LANGUAGE BARRIER";	}
	else if($code=="CFLAP") { $dFeedback = "CFL APPROVED";	}	
	else if($code=="CFLRJ") { $dFeedback = "CFL REJECT";	}	
	else if($code=="B") { $dFeedback = "No Answer AutoDial";	}	
	else if($code=="DC") { $dFeedback = "Disconnected Number";	}	
	else if($code=="DNC") { $dFeedback = "DO NOT CALL";	}	
	else if($code=="DNCL") { $dFeedback = "DO NOT CALL Hopper Match";	}	
	else if($code=="N") { $dFeedback = "No Answer";	}	
	else { $dFeedback = $code; }

	return $dFeedback;
}


function getProductD4l($type)
{
	if($type == 1500) { $Reply_Type=1; }
	return $Reply_Type;
}

$sqlRevert = "select dialer_camp_id, Reply_Type from Req_Dialer_Records_PL where 1=1 and dialer_camp_id not in (0,1500) group by dialer_camp_id";
$checkRevertQuery = ExecQuery($sqlRevert);
$checkRevertNum = mysql_num_rows($checkRevertQuery);
for($i=0;$i<$checkRevertNum;$i++)
{
	$dialer_camp_id = mysql_result($checkRevertQuery, $i ,'dialer_camp_id');
	$Reply_Type = mysql_result($checkRevertQuery, $i ,'Reply_Type');
	getRevertFeedback($dialer_camp_id, $Reply_Type);
}

//getRevertFeedback(1504);
//getRevertFeedback(1507);


function getRevertFeedback($ProductID, $Reply_Type)
{
	if($ProductID == 1500 || $ProductID == 1507 || $ProductID == 1508 || $ProductID == 1509) { $Reply_Type=1; }
	else if($ProductID == 1501 || $ProductID == 1504 ) { $Reply_Type=4; }	

	$dated1 = date("Y-m-d");
	$dated = date("Y-m-d H");
	$start_date = $dated1." 00:00:00";
	$end_date = $dated.":59:59";
	$param = '';
	$param["list_id"] = $ProductID;
	$param["start_date"] = $start_date;
	$param["end_date"] = $end_date;
	$request = '';
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request

    echo $url = "https://".DIALLERIP."/vicidial/send_disposition.php?".$request;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_GET, 1);
	$content = curl_exec ($ch);
	$explode_1 = explode("|", $content);
	for($i=0;$i<count($explode_1);$i++)
	{
		$explode_2 = explode(",", $explode_1[$i]);
		$RequestID = trim($explode_2[0]);
		$DialerID = trim($explode_2[1]);
		$listID = trim($explode_2[2]);
		$mobile = trim($explode_2[3]);
		$AgentID = trim($explode_2[4]);
		$FeedbackID = getFeedbackD4l(trim($explode_2[5]));

		if($explode_2[5]=="CALLBK")
		{
			$followup_dt = trim($explode_2[6]); 
			$dtUpdate = " , FollowupDate='".$followup_dt."' ";
		}	else { $dtUpdate = " "; }
		if($DialerID>0 && is_numeric($DialerID) && is_numeric($AgentID) && $AgentID>0 && $RequestID>0)
		{
			$checkDataSql = "select * from Req_Dialer_Records_PL where RequestID='".$RequestID."'";//and Reply_Type='".$CampaignID."'
			echo $checkDataSql."<br>";
			$checkDataQuery = ExecQuery($checkDataSql);
			$checkDataNum = mysql_num_rows($checkDataQuery);
			if($checkDataNum>0) 
			{
				$getBiddSql = "select Bidder_Name from Bidders where BidderID = '".$AgentID."'";
				$getBiddQuery = ExecQuery($getBiddSql);
				$AgentName = mysql_result($getBiddQuery,0,'Bidder_Name');
				$updateSql = "update Req_Dialer_Records_PL set DialerFeedback='".$FeedbackID."', AgentID='".$AgentID."', AgentName='".$AgentName."' ".$dtUpdate." where RequestID='".$RequestID."'";// and Reply_Type='".$CampaignID."'
				echo $updateSql."; <br>";
				ExecQuery($updateSql);
			}
			else
			{
				if(strlen($FeedbackID)>8)
				{
					$updateSql = "update Req_Dialer_Records_PL set DialerFeedback='".$FeedbackID."' ".$dtUpdate." where RequestID='".$RequestID."'";// and Reply_Type='".$CampaignID."'
					echo $updateSql."; <br>";
					ExecQuery($updateSql);
				}
			}
		}
	}
	curl_close ($ch);	
}
?>