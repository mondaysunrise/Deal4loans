<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//echo $_SESSION['BidderID'];
		//$product =$_REQUEST['pro'];	
		$Phone = $_REQUEST['Mobile'];
		$id = $_REQUEST['RequestID'];
		$product =$_REQUEST['pro'];
		$followupdate = $_GET['followupdate'];

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$SMSMessage = FixString($SMSMessage);



if(strlen(trim($SMSMessage))>0)
	{
		$strSQL="";
		$Msg="";

		$result = ("select FeedbackID from Req_Feedback where AllRequestID=$id and BidderID=".$_SESSION['BidderID']." AND Reply_Type=".$product);	
				
		 list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$cntr=0;
		
				
				//$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			//$row = mysql_fetch_array($result);
			//$strSQL="Update Req_Feedback Set SmsSent=1";
			//$strSQL=$strSQL." Where FeedbackID=".$row[$cntr]["FeedbackID"];
			
			$DataArray = array("SmsSent"=>1);
			$wherecondition ="FeedbackID=".$row[$cntr]["FeedbackID"];
			Mainupdatefunc ('Req_Feedback', $DataArray, $wherecondition);
		}
		else
		{
			//$strSQL="Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , SmsSent) Values (";
			//$strSQL=$strSQL.$id.",".$_SESSION['BidderID'].",".$product.",'1')";
			
			$dataInsert = array("AllRequestID"=>$id , "BidderID"=>$_SESSION['BidderID'] , "Reply_Type"=>$product, "SmsSent"=>1);
		$table = 'Req_Feedback';
		$insert = Maininsertfunc ($table, $dataInsert);
			
		}

		//echo $strSQL;
		//$result = ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}
		
	//$sql1 = "Update `".$product."` set Sms_Sent=1 where RequestID=$id ";
     // echo "ddd".$sql1;
	//$result = ExecQuery($sql1);

	if(strlen(trim($Phone)) > 0)
			SendSMSforLMS($SMSMessage, $Phone);
	echo "<script>window.close()"."</script>";
	}


?>
<style>
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}
.bodyarial11 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #333333;
	text-decoration: none;
}
.blueborder {
	border: 1px solid #529BE4;
}
.head2 {
	font-family: Century Gothic;
	font-size: 18px;
	color:0F74D4;
	text-decoration: none;
	font-weight: bold;
}
</style>
<script>
function countit(what){

//Character count script
formcontent=what.form.SMSMessage.value
what.form.displaycount.value=formcontent.length
}
</script>
<?
		//$qry = "select Sms_Sent from `".$product."` where RequestID=$id ";
        // echo "ddd".$qry;
	//$smsquery = ExecQuery($qry);
	//$sms_sent = mysql_result($smsquery,$i,'Sms_Sent');
	//if($sms_sent !=1)
	//{

	?>
	<form name="sms_text" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?Mobile=<?echo $Phone;?>&RequestID=<? echo urlencode($id);?>&pro=<? echo urlencode($product);?>">
	<table width="80%" cellpadding="1" height="50%" cellspacing="0" class="blueborder">
	<tr>
	<td colspan="2" align="center"><b>SMS Message</b></td>

	</tr>
	<tr><td class="bodyarial11"><b>Message for Sms(Should not exceed 160 characters)<br>character count(<input style="border:0px;" type="text" name="displaycount" size="1">)</b>
	</td>
	<td class="bodyarial11"><textarea name="SMSMessage" rows="2" cols="50" id="SMSMessage" onKeyup="countit(displaycount)"></textarea></td></tr>
	<tr>
     <td colspan="2" align="center"><input name="Submit" type="submit" class="bluebutton" value="Submit" border="0"></td>
     </tr>
	</table>
</form>
<?// } 
//else {?>
<!--<table width="80%" cellpadding="1" height="50%" cellspacing="0" class="blueborder">
	<tr>
	<td  align="center"><font class="head2"> You have already sent an sms to this customer.</font></td>
	</tr>-->

<? //}?>


			
		
		


