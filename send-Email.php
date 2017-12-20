<?php
require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	$Email=$_REQUEST['Email'];
	$Name=$_REQUEST['Name'];
	$RequestID =$_REQUEST['cust'];	
	$product =$_REQUEST['pro'];

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		//$foot = FixString($foot);
		$subject = FixString($subject);
		//$head = FixString($head);
		$message = FixString($message);
		$sent_from = FixString($sent_from);

	$emailmessage="<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2' bgcolor='#529BE4'><tr><td align='center'>&nbsp;</td></tr><tr><td><table border='0' cellspacing='5' width='99%' cellpadding='6' id='frm' bgcolor='#FFFFFF'><tr><td bgcolor='#FFFFFF'colspan='2'><tr><td>&nbsp;</td><td align='right' ><img src='http://www.deal4loans.com/images/D4L_Logo.gif' height='40'></td></tr><tr><td colspan='2'><font face='Verdana' size='2'><p>$message</p></td></tr></table></td></tr></table>";
	//echo "hello".$Email;

	            $headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers  = 'From: deal4loans <'.$sent_from.'>' . "\r\n";
				//$headers .= 'Bcc: ranjana5chauhan@gmail.com '."\r\n";
				$headers .= 'Return-Path: <'.$sent_from.'>'."\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				mail($Email, $subject, $emailmessage, $headers);

if(strlen(trim($message))>0)
	{
		$strSQL="";
		$Msg="";

		$result = ("select FeedbackID from Req_Feedback where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']." AND Reply_Type=".$product);		
		list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$cntr=0;
		if($num_rows > 0)
		{
			$DataArray = array("SentEmail"=>'1');
			$wherecondition ="(FeedbackID=".$row[$cntr]["FeedbackID"].")";
			Mainupdatefunc ('Req_Feedback', $DataArray, $wherecondition);
		}
		else
		{
			$data = array("AllRequestID"=>$RequestID , "BidderID"=>$_SESSION['BidderID'], "Reply_Type"=>$product, 'SentEmail'=>'1');
			$table = 'Req_Feedback';
			$insert = Maininsertfunc ($table, $data);	
		}

		//echo $strSQL;

		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}


				echo "<script>window.close()"."</script>";
	}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<STYLE>
a
{
	cursor:pointer;

}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}</style>
<script>
window.resizeTo(600,600);

function tooltipstart(strPlan)
{
       if (document.getElementById('tooltip') != undefined)  
       {
               document.getElementById('tooltip').innerHTML = strPlan;
			   document.getElementById('tooltip').style.background='Beige';  
       }

       return true;
}
function tooltipend(strPlan)
{
       if (document.getElementById('tooltip') != undefined) 
       {
               document.getElementById('tooltip').innerHTML = strPlan;
			   document.getElementById('tooltip').style.background='';  
			       
       }

       return true;
}
</script>
</head>

<body >
<p align="center"><b> Send Email </b></p>


<table style='border:1px dotted #9C9A9C;'width="600" height="80%" align="center">
<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?Name=<? echo urlencode($Name); ?>&Email=<? echo urlencode($Email);?>&cust=<? echo urlencode($RequestID); ?>&pro=<? echo urlencode($product);?>" ><tr>	<td ><b>Name</b>
	</td>
	<td ><? echo $Name;?></td>
	
</tr>
<tr>
	<td ><b>Email id</b></td>
	<td ><?echo $Email;?></td>
</tr>
<tr>
	<td ><b>Email Sent From -</b></td>
	<td ><input type="text" id="sent_from" size="30" name="sent_from" onFocus="return tooltipstart('Kindly mention your mail ID so that Customer can reply you back.')" style="float: left" onBlur="return tooltipend(' ')" id="subject"><div id="tooltip" style="position:static;font-size:10px;width:200px;text-align:center;font-family:verdana;" ></div></td>
</tr>
<tr><td><b>Subject</b></td>
<td><input type="text" name="subject" ></td></tr>
<tr>
	<td ><b>Message</b></td><td>
<textarea rows="10" cols="80" name="message"></textarea></td>
</tr>
<tr>
<td colspan='2' align='center'><input type='submit' value='submit' class='bluebutton'></td>
</tr>
</table>
</body>
</html>