<?php
//Get Call URL
class getExternalCallAPI 
{
	var $callUrl = "http://103.12.135.98:8080/iCallMateWebSvc";// new

	function getExternalCallAPI()
	{
		return(true);
	}
	
	function funGetCall($AgentId, $ClientId)
	{
		$param = '';
		$param["AgentId"] = $AgentId;
		$param["ClientId"] = $ClientId;
		$request = '';
		foreach($param as $key=>$val)
		{ 
		  $request.= $key."=".urlencode($val);
		  $request.= "&"; 
		}
		$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
		
		$getUrl = $this->callUrl;
		$url = $getUrl."/resources/getCall?".$request;
	//	echo $url; 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt ($ch, CURLOPT_POST, 1);
		$content = curl_exec ($ch);
		//echo $content;
		//echo "<br>";
		if((strlen(strpos($content, "FAILURE")) > 0))
		{
			echo $returnValue = $content;
		}
		else
		{
			$explodeVal = explode('|',$content);
		//	print_r($explodeVal);
			
			$SuccessMsg = $explodeVal[0];
			$CallId = $explodeVal[1];
			$ClientId = $explodeVal[2];
			$PhoneNumber = $explodeVal[3];
			$DNIS = $explodeVal[4];
		}
	}
	//echo funGetCall('4524','4214');
	
	// Make Call API
	function funMakeCall($RequestID, $MobileNum, $AgentId, $CampId, $leadId, $leadidentifier)
	{
	//	http://115.249.245.30:8080/iCallMateWebSvc/resources/MakeCall?clientid=0 <http://115.249.245.30:8080/iCallMateWebSvc/resources/MakeCall?clientid=0&dialno=9958202041&transferto=6358&campid=86&leadid=540&crmcallid=2722222222222222> &dialno=9958202041&transferto=6358&campid=86&leadid=540&crmcallid=2722222222222222
		
	//	clientid=0&dialno=9958202041&transferto=6825&campid=92&leadid=2674&crmcallid=2722222222222222
		$param = '';
		$param["clientid"] = $RequestID;
		//$param["clientid"] = 0;
		$param["dialno"] = $MobileNum;
		$param["transferto"] = $AgentId;
		$param["campid"] = $CampId;
		$param["leadid"] = $leadId;
		$param["crmcallid"] = $leadidentifier;
		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; 
		}
		$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
		//$request ="AgentId=".$AgentId."&ClientId=".$ClientId;

		$getUrl = $this->callUrl;
		$url = $getUrl."/resources/MakeCall?".$request;
		//echo $url; 
		//echo "<br>";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt ($ch, CURLOPT_POST, 1);
		$content = curl_exec ($ch);
		//echo $content;
	//echo "<br>";
		if((strlen(strpos($content, "FAILURE")) > 0))
		{
			echo $returnValue = $content;
		}
		else
		{
			$explodeVal = explode('|',$content);
		//	print_r($explodeVal);
			
			$SuccessMsg = $explodeVal[0];
			$CallId = $explodeVal[1];
			$ClientId = $explodeVal[2];
			$PhoneNumber = $explodeVal[3];
			$DNIS = $explodeVal[4];
			echo "dialling";
			//echo '<input type="checkbox" name="notTakenCall" id="notTakenCall" value="1" /> (Check If not attended) <input type="button" name="cancelCall" value="Disconnect" onClick="disconnectCall('.$RequestID.', '.$AgentId.')" />';
			if($CampId==86 || $CampId==97)
			{
				echo '<div class="discennect-row"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>  <td>Disposition &nbsp;<select name="disConnectStatus" id="disConnectStatus" class="diler-status-select"><option value="1423">Ringing</option><option value="1427">Follow up</option><option value="1429">Not Eligible - FOIR</option><option value="1436">Not Eligible â€“ Salary</option><option value="1438">Not Eligible â€“ Others</option><option value="1448">Not Interested â€“ Direct</option><option value="1450">Not Interested â€“ Offer (ROI/PF etc)</option><option value="1451">Not Interested â€“ Loan Amount</option><option value="1475">Not Contactable</option><option value="1455">TU Approved</option><option value="1453">TU Referred</option><option value="1454">TU Declined</option></select>&nbsp; <input type="button" name="cancelCall" value="Disconnect" onClick="disconnectCall('.$RequestID.', '.$AgentId.')" /></td>  </tr></table></div>';
			}
			else if($CampId==91)
			{
				echo '<div class="discennect-row"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>  <td>Disposition &nbsp;<select name="disConnectStatus" id="disConnectStatus" class="diler-status-select"><option value="1464">Ringing</option><option value="1427">Follow up</option><option value="1456">Other Product</option><option value="1416">Not Interested</option><option value="1417">Callback Later</option><option value="1418">Wrong Number</option><option value="1473">Not Eligible</option><option value="1463">Not Contactable</option><option value="1421">Duplicate</option><option value="1460">Send Now</option><option value="1466">Not Applied</option><option value="1490">Cibil ok</option><option value="1491">Cibil Reject</option></select>&nbsp; <input type="button" name="cancelCall" value="Disconnect" onClick="disconnectCall('.$RequestID.', '.$AgentId.')" /></td>  </tr></table></div>';	
			}
			else
			{
				echo '<div class="discennect-row"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>  <td>Disposition &nbsp;<select name="disConnectStatus" id="disConnectStatus" class="diler-status-select"><option value="1423">Ringing</option><option value="1415">Other Product</option><option value="1416">Not Interested</option><option value="1417">Callback Later</option><option value="1396">Wrong Number</option><option value="1419">Send Now</option><option value="1420">Not Eligible</option><option value="1421">Duplicate</option><option value="1422">Not Contactable</option><option value="1424">FollowUp</option><option value="1425">Not Applied</option></select>&nbsp; <input type="button" name="cancelCall" value="Disconnect" onClick="disconnectCall('.$RequestID.', '.$AgentId.')" /></td>  </tr></table></div>';
			}
		}
	}
		
	//Drop Call API
	function funDropCall($RequestID, $AgentId, $CallInvokeID, $State)
	{
		$param = '';
		$param["clientid"] = $RequestID;
		$param["AgentNo"] = $AgentId;
		$param["CallInvokeID"] = $CallInvokeID;
		$param["State"] = $State;
		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; 
		}
		$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
		//$request ="AgentId=".$AgentId."&ClientId=".$ClientId;
		$getUrl = $this->callUrl;
		$url = $getUrl."/resources/ChangeExtState?".$request;
	//	echo $url; 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt ($ch, CURLOPT_POST, 1);
		$content = curl_exec ($ch);
		//echo $content;
	//echo "<br>";
	//	print_r($content);
	//echo "<br>";
		if((strlen(strpos($content, "FAILURE")) > 0))
		{
			echo $returnValue = $content;
		}
		else
		{
			$explodeVal = explode('|',$content);
			echo "Call Disconnected";	
		}
	
	}
	
	function funDisposeCall($RequestID, $CallId, $dispId, $dispRemarks, $AgentID)
	{
	//	http://43.252.243.14:8080/iCallMateWebSvCC/resources/DisposeCall?clientid=0&callid=0&dispid=182&dispremarks=test%20remarks&custremarks=cust%20remarks&otherremarks=other%20remarks&cb=0&cbtime=&cbassignedto=0&nxtnumtype=0&dncl=0&agentid=3010
		
		$param = '';
		$param["clientid"] = $RequestID;
		$param["callid"] = $CallId;
		$param["dispid"] = $dispId;
		$param["dispremarks"] = $dispRemarks;
		$param["custremarks"] = " ";
		$param["otherremarks"] = "";
		$param["cb"] = 0;
		$param["cbtime"] = "";
		$param["cbassignedto"] = "";
		$param["nxtnumtype"] = "";
		$param["dncl"] = "";
		$param["agentid"] = $AgentID;
		
		$request = '';
		foreach($param as $key=>$val) //traverse through each member of the param array
		{ 
		  $request.= $key."=".urlencode($val); //we have to urlencode the values
		  $request.= "&"; 
		}
		$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
		$getUrl = $this->callUrl;
		$url = $getUrl."/resources/DisposeCall?".$request;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt ($ch, CURLOPT_POST, 1);
		$content = curl_exec ($ch);
		//echo $content;
	//echo "<br>";
		if((strlen(strpos($content, "FAILURE")) > 0))
		{
			echo $returnValue = $content;
		}
		else
		{
			$explodeVal = explode('|',$content);
			//print_r($explodeVal);
			if($dispId==182) 
			{
				echo $dispRemarks = '<br>Customer Not Taken Call<br>';
			}
		}
	
	}
	
}
?>


<!--<a href="#" style="background:#06C; border-radius:5px; text-align:center; padding:10px; font-weight:bold;">Disconnect</a>-->