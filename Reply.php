<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";
	$PostedBy = ($_SESSION['UserType']=='User')?1:2;
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		foreach($_GET as $a=>$b)
			$$a=$b;
		$Reply_Type = getCodeValue("ReplyType_$Reply_Type");
		/*$RequestID
		$UserID
		$BidderID*/
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		/* FIX STRING */
		$Message = FixString($Message);
		$result = ExecQuery("INSERT INTO Replies (RequestID, UserID, BidderID, SequenceID, PostedBy, Reply_Type,  Message, Dated) VALUES ( '$RequestID',  '$UserID', '$BidderID', '$UserID', '$PostedBy', '$Reply_Type', '$Message', Now() )");
		//echo $result;
		echo mysql_error();
		if ($result == 1)
			$Msg = getAlert("Your reply has been added. Click OK to continue !!", TRUE, "myRequests.php");
		else
			$Msg = "** There was a problem in adding your reply. Please try again. !! ";
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
 <?php include '~Top.php'; ?>
 <p>&nbsp;</p>
<Script Language="JavaScript">
   function validateMe(theFrm){
	if(!checkData(theFrm.Message, ' Reply ', 10))
		return false;
	return true;
    }
 </Script>
 <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
  
  <input type="hidden" name="Reply_Type" value="<?=$Reply_Type?>">
  <input type="hidden" name="PostedBy" value="<?=$PostedBy?>">
  <input type="hidden" name="UserID" value="<?=$UserID?>">
  <input type="hidden" name="RequestID" value="<?=$RequestID?>">
  <input type="hidden" name="BidderID" value="<?=$BidderID?>">
 <table width="300" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   <tr>
     <td class="head1">Reply</td>
   </tr>
   <tr><td ID="Alert">&nbsp;<?=$Msg?></td></tr>
   <tr>
     <td><textarea name="Message" cols="60" rows="8" class="form"></textarea></td>
   </tr>
   <tr>
     <td align="center"><br><input type="submit" class="bluebutton" value="Submit"></td>
   </tr>
  </table>
 </form>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
 <? //echo "jjjjj".$_SESSION['UserType']; ?>
 <?php include '~Bottom.php'; ?>
 </center>
</div>
</body>

</html>