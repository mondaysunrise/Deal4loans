<?php

	require 'scripts/session_check.php';

	require 'scripts/db_init.php';

	require 'scripts/functions.php';

	require 'scripts/htmlMimeMail.php';

	session_start();

	$Msg = "";

	$PostedBy = $_REQUEST['PostedBy'];

	$Message = $_REQUEST['Message'];

	//$Other_Comments = $_REQUEST['Other_Comments'];

	$Reply_Type = $_REQUEST['Reply_Type'];

	$UserID = $_REQUEST['UserID'];

	$RequestID = $_REQUEST['RequestID'];

	$BidderID = $_REQUEST['BidderID'];

	$ifbidder = $_REQUEST['ifbidder'];

	$ifbidder = "possitive";

	

	if ($ifbidder == 'possitive')

	{

	$sql = ("Select *  from Bidders where BidderID='".$BidderID."'");

	list($recordcount,$myrow)=MainselectfuncNew($sql,$array = array());
	$cntr=0;
	if ($myrow[$cntr]) 
	{

		$Bidder_Name=$myrow[$cntr]["Bidder_Name"];
		$EmailID=$myrow[$cntr]["Email"];

	}

		$sql = "Select *  from wUsers where UserID='".$UserID."'";

		list($recordrowscount,$myrow)=MainselectfuncNew($sql,$array = array());
	$k=0;
		
		if ($myrow[$k]) 
			{	
				while($k<count($myrow))
        		{
					$EmailID_user=$myrow[$k]["Email"];
					$Fname=$myrow[$k]["FName"];
					$k = $k +1;
				}
			}

				//mysql_free_result($result);

				//echo "UserID = ".$UserID."<BR>";



	if($Reply_Type=='1'||$Reply_Type=='2'||$Reply_Type=='3'||$Reply_Type=='5') {

	$Message1= "<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#529BE4' width='450' id='AutoNumber1'><tr><td bgcolor='#529BE4'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#529BE4' width='100%' id='AutoNumber2'><tr><td width='100%' bgcolor='#FFFFFF'><p><font face='Arial' size='2'>Dear $Bidder_Name,<br>For your bid on user $Fname has following comments:</font></p><p><font face='Arial' size='2'><b>$Message</b></font></p><form name='frm_deal4loans' method='post' action='http://www.deal4loans.com/reply_email_via_bidder.php'><input type='hidden' name='Fname' value='$Fname'><input type='hidden' name='Bidder_Name' value='$Bidder_Name'><input type='hidden' name='Reply_Type' value='$Reply_Type'><input type='hidden' name='PostedBy' value='2'><input type='hidden' name='UserID' value='$UserID'><input type='hidden' name='RequestID' value='$RequestID'><input type='hidden' name='BidderID' value='$BidderID'><input type='hidden' name='ifbidder' value='possitive'><div align='center'><center><table border='0' cellspacing='0' width='400' cellpadding='3' id='frm' style='border-collapse: collapse' bordercolor='#111111'><tr><td colspan='2' height='19'>Post your comments here to this user:</td></tr><tr><td height='68'><p>Documents Required:</td><td height='68'> <textarea rows='4' name='Message' cols='30'></textarea></td></tr><tr><td height='22'>Rate :</td><td height='22'> <input type='text' name='Rate' size='5' value='0'>%</td></tr><tr><td height='22'>EMI :</td><td height='22'> <input type='text' name='EMI' size='5' value='0'></td></tr><tr><td height='22'>Tenure :</td><td height='22'> <input type='text' name='Tenure' size='5' value='0'>Years</td></tr><tr><td height='68'>Other Comments:</td><td height='68'> <textarea rows='4' name='Other_Comments' cols='30'></textarea></td></tr><tr><td width='30%' colspan='2' height='19'></td></tr><tr align='Center'><td colspan='2' height='45'><br><input type='submit' value='Submit'></td></tr></table></center></div><p><font face='Arial' size='2'>Thanking you.</font></p><p><font face='Arial' size='2'>Assuring you of our Best Service<br><b>Team deal4loans.com</b></font></p></form></td></tr></table> </td></tr></table>";

	}

	else

	{

	$Message1= "<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#529BE4' width='450' id='AutoNumber1'><tr><td bgcolor='#529BE4'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#529BE4' width='100%' id='AutoNumber2'><tr><td width='100%' bgcolor='#FFFFFF'><p><font face='Arial' size='2'>Dear $Bidder_Name,<br>For your bid on user $Fname has following comments:</font></p><p><font face='Arial'><b><font face='Arial' size='2'><font face='Arial' size='2'>$Message</font></font></b></font></p><form name='frm_deal4loans' method='post' action='http://www.deal4loans.com/reply_email_via_bidder.php'><input type='hidden' name='Fname' value='$Fname'><input type='hidden' name='Bidder_Name' value='$Bidder_Name'><input type='hidden' name='Reply_Type' value='$Reply_Type'><input type='hidden' name='PostedBy' value='2'><input type='hidden' name='UserID' value='$UserID'><input type='hidden' name='RequestID' value='$RequestID'><input type='hidden' name='BidderID' value='$BidderID'><input type='hidden' name='ifbidder' value='possitive'><div align='center'><center><table border='0' cellspacing='0' width='400' cellpadding='3' id='frm' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td colspan='2' height='19'>Post your comments here to this user:</td></tr><tr><td height='68'><p>Documents Required:</td><td height='68'> <textarea rows='4' name='Message' cols='30'></textarea></td></tr><tr><td height='22'><p></td><td height='22'> </td></tr><tr><td height='68'>Other Comments:</td><td height='68'> <textarea rows='4' name='Other_Comments' cols='30'></textarea></td></tr><tr><td width='30%' colspan='2' height='19'></td></tr><tr align='center'><td colspan='2' height='45'><br><input type='submit' value='Submit'></td></tr></table></center></div><p><font face='Arial' size='2'>Thanking you.</font></p><p><font face='Arial' size='2'>Assuring you of our Best Service<br><b>Team deal4loans.com</b></font></p><p></p></form></td></tr></table> </td></tr></table>";

	}


/*
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	// Additional headers
	$headers .= 'To: '.$Bidder_Name.' <'.$EmailID.'>' . "\r\n";
	$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
*/
	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

//	mail($EmailID,'User Reply For Request', $Message1, $headers);

	}

	//send_mail_new($Bidder_Name,$EmailID,$Fname,$EmailID_user,'User Reply',$Message1);

	//$PostedBy = ($_SESSION['UserType']=='User')?1:2;

	if ($_SERVER['REQUEST_METHOD'] == 'GET'){

		foreach($_GET as $a=>$b)

			$$a=$b;

		$Reply_Type = getCodeValue("ReplyType_$Reply_Type");

		/*$RequestID

		$UserID

		$BidderID*/

	}



	if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		if ($ifbidder == 'possitive')

		$PostedBy = 1;



		foreach($_POST as $a=>$b)

			$$a=$b;



		/* FIX STRING */

		$Message = FixString($Message);
		$Dated = ExactServerdate();

		$dataInsert = array("RequestID"=>$RequestID, "UserID"=>$UserID, "BidderID"=>$BidderID, "SequenceID"=>'0', "PostedBy"=>'1', "Reply_Type"=>$Reply_Type, "Message"=>$Message, "Dated"=>$Dated);
$table = 'Replies';
$insert = Maininsertfunc ($table, $dataInsert);
		
		//echo $result;

		echo mysql_error();

		if ($result == 1)

			$Msg = getAlert("Your reply has been added. Click OK to continue !!", TRUE, "Requests.php?type=loan_home");

		else

			$Msg = "** There was a problem in adding your reply. Please try again. !! ";

	}

?>



<html>

<head>

<meta http-equiv="Content-Language" content="en-us">

<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title>Thank You</title>

<script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>

<link rel="stylesheet" type="text/css" href="../css/style.css">

<script language="javascript">setTimeout("self.close()",2000);</script>

<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>



<body>

<div align="center">

 <center>

     <table border="0" cellspacing="0" width="450" cellpadding="4" id="frm">

	 <tr>

	 <br>

	 <br>

	 <br>

	 <br>

	 <br>

	 <br>

	 <br>

	 <br><br><br>

	 <td colspan="2" class="bluebutton">Thank You, Your Mail has been Sent Successfully to the Bidder!!</td>

   </tr>

   </table>

 </center>

</div>

</body>

</html>