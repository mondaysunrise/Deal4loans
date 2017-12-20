<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//print_r($_REQUEST);
	
	$RequestID = $_REQUEST['Lid'];
	$ProductID = $_REQUEST['Prid'];
    $getAppointmentSql = "SELECT * FROM citi_appointments where RequestID='".$RequestID."'";
    list($getAppointmentNum,$getAppointmentQuery)=MainselectfuncNew($getAppointmentSql,$array = array());

      if($getAppointmentNum>0)
	  {
	   		$address_apt = $getAppointmentQuery[0]['address_apt'];	
			$changeapp_time = $getAppointmentQuery[0]['changeapp_time'];
			$time = '';
			if($changeapp_time=="08:00:00")
			{
				$time =  "8(am)-9(am)";
			}	
			else if($changeapp_time=="09:00:00")
			{
				$time =  "9(am)-10(am)";
			}
			else if($changeapp_time=="10:00:00")
			{
				$time =  "10(am)-11(am)";
			}
			else if($changeapp_time=="11:00:00")
			{
				$time =  "11(am)-12(pm)";
			}
			else if($changeapp_time=="12:00:00")
			{
				$time =  "12(pm)-1(pm)";
			}
			else if($changeapp_time=="13:00:00")
			{
				$time =  "1(pm)-2(pm)";
			}
			else if($changeapp_time=="14:00:00")
			{
				$time =  "2(pm)-3(pm)";
			}
			else if($changeapp_time=="15:00:00")
			{
				$time =  "3(pm)-4(pm)";
			}
			else if($changeapp_time=="16:00:00")
			{
				$time =  "4(pm)-5(pm)";
			}
			else if($changeapp_time=="17:00:00")
			{
				$time =  "5(pm)-6(pm)";
			}
			else if($changeapp_time=="18:00:00")
			{
				$time =  "6(pm)-7(pm)";
			}
			else if($changeapp_time=="19:00:00")
			{
				$time =  "7(pm)-8(pm)";
			}
			
			$appdate = $getAppointmentQuery[0]['appdate'];	
			$docs = $getAppointmentQuery[0]['docs'];
			
			$message = '';
			$message .= "<table width='88%' border='0' align='center' cellpadding='3' cellspacing='2'>
	<tr><td width='100%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><hr></td></tr><tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:15px; color:#061c33; line-height:18px; ' colspan='2'><strong>Appointment</strong> </td></tr>";
	$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><b>Address:</b> ".$address_apt." </td></tr>";
		$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><b>Date & Time:</b> ".$appdate."&nbsp;&nbsp;&nbsp;".$time." </td></tr>";
	
	if(strlen($docs)>0)
	{
		$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><b>Documents:</b> ".$docs."</td></tr>";
	}
	
	
	$message .= "<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; ' colspan='2'><hr></td></tr>
	</table>";
	echo $message;
		
			
	  }
	?>