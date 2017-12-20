<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";
	if($_SESSION['UserType']=='user')
	$PostedBy = 1;
	else
	$PostedBy = 2;
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		foreach($_GET as $a=>$b)
			$$a=$b;

	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$RequestID = $_SESSION['Temp_RequestID'];
		$BidderID = $_SESSION['Temp_BidderID'];
		$Reply_Type = $_SESSION['Temp_Reply_Type'];
		//$Reply_Type = getCodeValue("ReplyType_$Reply_Type");
		$RequestID = FixString($RequestID);
		$BidderID = FixString($BidderID);
		$Reply_Type = FixString($Reply_Type);
		$Email = FixString($Email);

		if($_SESSION['UserType']=='user'){
		$PostedBy = 1;
		/* FIX STRING */
		$Message = FixString($Message);
		$result = ExecQuery("INSERT INTO Replies (RequestID, UserID, BidderID, SequenceID, PostedBy, Reply_Type,  Message, Dated) VALUES ( '$RequestID',  '$UserID', '$BidderID', '0', '$PostedBy', '$Reply_Type', '$Message', Now() )");
		//echo $result;
		echo mysql_error();
		if ($result == 1)
		{
			$sql = ExecQuery("Select *  from Bidders where BidderID='".$BidderID."'");
				echo mysql_error();
				if ($myrow = mysql_fetch_array($sql)) 
				{
					$Bidder_Name=$myrow["Bidder_Name"];
					$EmailID=$myrow["Email"];

				}
				//echo "EmailID == ".$EmailID."<BR>";
				
				mysql_free_result($sql);
			$sql = ExecQuery("Select *  from wUsers where UserID='".$UserID."'");
				echo mysql_error();
				if ($myrow = mysql_fetch_array($result)) {
				do
				{
					$EmailID_user=$myrow["Email"];
					$Fname=$myrow["FName"];
				}while ($myrow = mysql_fetch_array($result));

				}
				mysql_free_result($result);

			$Message1= "<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#529BE4' width='450' id='AutoNumber1'><tr><td bgcolor='#529BE4'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#529BE4' width='100%' id='AutoNumber2'><tr><td width='100%' bgcolor='#FFFFFF'><p><font face='Arial' size='2'>Dear $Bidder_Name,<br>For your bid on user $Fname has following comments:</font></p><p><font face='Arial' size='2'><b>$Message</b></font></p><p><font face='Arial' size='2'>Thanking you.</font></p><p><font face='Arial' size='2'>Assuring you of our Best Service<br><b>Team deal4loans.com</b></font></p></td></tr></table> </td></tr></table>";
/*
			<!--<br><br><b><a href='http://www.deal4loans.com/LoginB_Email.php?RequestID=$RequestID&UserID=$UserID&BidderID=$BidderID&Reply_Type=$Reply_Type'>Reply to This Mail</a></b>-->
*/
/*
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'To: '.$Bidder_Name.' <'.$EmailID.'>' . "\r\n";
			$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
*/
			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			mail($EmailID,'User Reply For Request', $Message1, $headers);
			$Msg = getAlert("Your reply has been added. Click OK to continue !!", TRUE, "myRequests.php");
			}
			else
			$Msg = "** There was a problem in adding your reply. Please try again. !! ";
	}

		if($_SESSION['UserType']=='bidder'){
		$PostedBy = 2;
		/* FIX STRING */
		$Message = FixString($Message);
		$result = ExecQuery("INSERT INTO Replies (RequestID, UserID, BidderID, SequenceID, PostedBy, Reply_Type,  Message, Dated) VALUES ( '$RequestID',  '$UserID', '$BidderID', '0', '$PostedBy', '$Reply_Type', '$Message', Now() )");
		//echo $result;
		echo mysql_error();
		if ($result == 1)
		{
			$sql = ExecQuery("Select *  from Bidders where BidderID='".$BidderID."'");
				echo mysql_error();
				if ($myrow = mysql_fetch_array($sql)) 
				{
					$Bidder_Name=$myrow["Bidder_Name"];
					$EmailID=$myrow["Email"];

				}
				//echo "EmailID == ".$EmailID."<BR>";
				
				mysql_free_result($sql);
			$sql = ExecQuery("Select *  from wUsers where UserID='".$UserID."'");
				echo mysql_error();
				if ($myrow = mysql_fetch_array($result)) {
				do
				{
					$EmailID_user=$myrow["Email"];
					$Fname=$myrow["FName"];
				}while ($myrow = mysql_fetch_array($result));

				}
				mysql_free_result($result);

			//$Message1= "<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='450' id='AutoNumber1'><tr><td bgcolor='#EEF0E3'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2'><tr><td width='100%' bgcolor='#DEE3CD'><p><font face='Arial' size='2'>Dear $Fname,<br>For your bid on user $Fname has following comments:</font></p><p><font face='Arial' size='2'><b>$Message</b></font></p><p><font face='Arial' size='2'>Thanking you.</font></p><p><font face='Arial' size='2'>Assuring you of our Best Service<br><b>Team deal4loans.com</b><br><br><b><a href='http://www.deal4loans.com/LoginB_Email.php?RequestID=$RequestID&UserID=$UserID&BidderID=$BidderID&Reply_Type=$Reply_Type'>Reply to This Mail</a></b></font></p></td></tr></table> </td></tr></table>";

			$Message1= "<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#529BE4' width='450' id='AutoNumber1'><tr><td bgcolor='#529BE4'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#529BE4' width='100%' id='AutoNumber2'><tr><td width='100%' bgcolor='#FFFFFF'><p><font face='Arial' size='2'>Dear $Fname,<br>Thanks for using Deal4loans.com for your $Title_Request requirement</font></p><p><font face='Arial' size='2'><b>E-Quote</b> from <a href='http://www.deal4loans.com/Bidder_View_Window.php?BidderID=$BidderID'>$Bidder_Name</a>,<br><b>Associated Bank:</b> $Associated_Bank</font></p><p><b><font face='Arial' size='2'>Documents Required:<br></font></b><font face='Arial' size='2'>$Message</font></p><p><font face='Arial' size='2'><b>Other Comments:</b>$Other_Comments<br><br><strong>ROI:</strong> $Rate%<br><strong>EMI:</strong> Rs.$EMI <br><strong>TENURE:</strong> $Tenure Years</font></p><p><font face='Arial' size='2'>Thanking you.</font></p><p><font face='Arial' size='2'>Assuring you of our Best Service<br><b>Team <a href='http://www.deal4loans.com'>deal4loans.com</a></b> </font></p><form name='frm_deal4loans' method='post' action='http://www.deal4loans.com/reply_email.php'><input type='hidden' name='Fname' value='$Fname'><input type='hidden' name='Bidder_Name' value='$Bidder_Name'><input type='hidden' name='Reply_Type' value='$Reply_Type'><input type='hidden' name='PostedBy' value='2'><input type='hidden' name='UserID' value='$UserID'><input type='hidden' name='type' value='$type'><input type='hidden' name='RequestID' value='$RequestID'><input type='hidden' name='BidderID' value='$BidderID'><input type='hidden' name='ifbidder' value='possitive'><p align='center'><b><textarea rows='4' name='Message' cols='30'>Post Your Reply to this Bidder Here</textarea></b></p><p align='center'><input type='submit' value='Submit'></p></form></td></tr></table></td></tr></table>";
/*
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'To: '.$Fname.' <'.$EmailID_user.'>' . "\r\n";
			$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
*/
			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

//			mail($EmailID_user,'Bidder Reply For Request', $Message1, $headers);
			$Msg = getAlert("Your reply has been added. Click OK to continue !!", TRUE, "myRequests.php");
			}
			else
			$Msg = "** There was a problem in adding your reply. Please try again. !! ";
			}
	}
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Reply</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div align="center">
 <center>
 <p>&nbsp;</p>
<Script Language="JavaScript">
   function validateMe(theFrm){
	if(!checkData(theFrm.Message, ' Reply ', 10))
		return false;
	return true;
    }
 </Script>
 <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
 <table width="300" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   <tr>
     <td class="head1">Reply</td>
   </tr>
   <tr><td ID="Alert">&nbsp;<?=$Msg?></td></tr>
   <tr> <td align="center">Reply from here to Bidder</td></tr>
   <tr>
    <td><textarea rows="8" name="Message" cols="60"></textarea></td>
   </tr>
   <tr>
     <td align="center"><br>
       <input name="submit" type="submit" class="bluebutton" value="Submit"></td>
   </tr>
  </table>
 </form>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 </center>
</div>
</body>

</html>