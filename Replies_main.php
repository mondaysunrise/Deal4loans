<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";
	$BidderID = $_REQUEST['BidderID'];
	
	$PostedBy = ($_SESSION['UserType']=='bidder')?2:1;
	$UserSession = $PostedBy;

	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		foreach($_GET as $a=>$b)
			$$a=$b;

		$type = $Reply_Type;
		$Reply_Type = getCodeValue("ReplyType_$Reply_Type");
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		/* FIX STRING */
		$Message = FixString($Message);
	
		$result = ExecQuery("INSERT INTO Replies (RequestID, UserID, BidderID, SequenceID, PostedBy, Reply_Type, Message, Rate, EMI, Tenure, Dated) VALUES ( '$RequestID',  '$UserID', '$BidderID', '0', '$PostedBy', '$Reply_Type', '$Message', '$Rate', '$EMI', '$Tenure', Now() )");
		echo mysql_error();
		if ($result == 1)
			$Msg = "** Your reply has been added. !! ";
		else
			$Msg = "** There was a problem in adding your reply. Please try again. !! ";
	}


   function getReplies(){
	global $type, $Reply_Type, $UserID, $BidderID, $RequestID, $PostedBy, $UserSession;
	$str = ""; $ExtraSql = "";
	static $i=0;

	//Execute Query
	if($UserSession==2)
		$ExtraSql = " And R.BidderID=$BidderID ";

		$sql = "Select R.*, U.FName, U.LName, B.Bidder_Name From Replies R INNER JOIN wUsers U On R.UserID=U.UserID INNER JOIN Bidders B on R.BidderID=B.BidderID Where R.Reply_Type=$Reply_Type And R.RequestID=$RequestID And R.UserID=$UserID $ExtraSql Order By R.BidderID, R.Dated";

	/*$sql= "Select R.*, U.FName, U.LName, B.Bidder_Name From Replies R INNER JOIN wUsers U On R.UserID=U.UserID INNER JOIN Bidders B on R.BidderID=B.BidderID Where R.Reply_Type=$Reply_Type And R.UserID=$UserID $ExtraSql Order By R.Dated";*/
	//echo $sql;
	$result = ExecQuery($sql);
	echo mysql_error();

	if ($myrow = mysql_fetch_array($result)) {
	  do
	  {
		$BidderID=$myrow["BidderID"];
		$User_Name=$myrow["FName"]." ".$myrow["LName"];
		$Bidder_Name=$myrow["Bidder_Name"];
		$ReplyID=$myrow["ReplyID"];
		$Message=$myrow["Message"];
		$Rate=$myrow["Rate"];
		$EMI=$myrow["EMI"];
		$Tenure=$myrow["Tenure"];
		$PostedBy=$myrow["PostedBy"];
		$PostedBy2=getCodeValue("PostedBy".$myrow["PostedBy"]);
		$Dated=$myrow["Dated"];
		//echo "ans".$PostedBy;
		if($_SESSION['UserType']=='user')
		  {
			$str .= "<Div class=Box".getRowID($i++)."><p>Posted on <u>$Dated</u> by <b>$PostedBy2</b><p>$Message<p><b>Rate:</b> $Rate &nbsp; &nbsp; <b>EMI:</b> $EMI &nbsp; &nbsp;<b>Tenure:</b> $Tenure <p><b>User Name</b>: $User_Name; &nbsp; &nbsp; <b>Bidder Name</b>: <a href='Bidder_View.php?BidderID=$BidderID'>$Bidder_Name</a> &nbsp; &nbsp; <a href=\"Reply.php?RequestID=$RequestID&UserID=$UserID&BidderID=$BidderID&Reply_Type=$type&PostedBy=$UserSession\"><b>Reply</b></a></Div>";}
		else
		  {$str .= "<Div class=Box".getRowID($i++)."><p>Posted on <u>$Dated</u> by <b>$PostedBy2</b><p>$Message<p><b>Rate:</b> $Rate &nbsp; &nbsp;<b>EMI:</b> $EMI &nbsp; &nbsp;<b>Tenure:</b> $Tenure <p><b>User Name</b>: $User_Name; &nbsp; &nbsp; <b>Bidder Name</b>: $Bidder_Name  &nbsp; &nbsp;</Div>";}


	  }while ($myrow = mysql_fetch_array($result));
          mysql_free_result($result);
	}
	return $str;
   }
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Replies</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/menu.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div align="center">
 <center>
 <?php include '~Top.php'; ?>
<table border="0" cellspacing="1" width="100%" cellpadding="0"  bgcolor="#F9FAF5">
   <tr>
     <td width="200" align="center" valign="top" bgcolor="#DEE3CE">
<?php if(isset($_SESSION['UserType']))
	{
	include '~Left.php';
	}
	else
	{
	include '~Login.php';
	}
?>    
     </td>
     <td width="1" bgcolor="#636F40"></td>
     <td width="1" bgcolor="#DEE3CE"></td>
     <td width="*" valign="top" align=center>
	<table border="0" cellspacing="0" width="450" cellpadding="4" id="frm">
   		<tr><td colspan="2" id="Title">Replies</td></tr>
	</table>
	<p><?=$Msg?></p>
	<?//echo "kkkkkkkkkk".$PostedBy;?>
	<?=getReplies()?>
	<p>&nbsp;</p>
	<Script Language="JavaScript">
	   function validateMe(theFrm){
		if(!checkData(theFrm.Message, ' Reply ', 10))
			return false;
		return true;
	    }
	 </Script>
	<form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
	  <input type="hidden" name="PostedBy" value="<?=$PostedBy?>">
	  <input type="hidden" name="UserID" value="<?=$UserID?>">
	  <input type="hidden" name="Reply_Type" value="<?=$Reply_Type?>">
	  <input type="hidden" name="RequestID" value="<?=$RequestID?>">
	  <input type="hidden" name="BidderID" value="<?=$BidderID?>">
	 <? if($_SESSION['UserType']=='bidder') {?>
	 <table border="0" cellspacing="0" width="300" cellpadding="4" id="frm">
	   <tr>
	     <td id="Title">Reply</td>
	   </tr>
	   <tr>
	     <td><textarea rows="8" name="Message" cols="60"></textarea><p>Rate :
         <input type="text" name="Rate" size="5" value="00.0">&nbsp; EMI :
         <input type="text" name="EMI" size="6" value="00.0">&nbsp; Tenure :
         <input type="text" name="Tenure" size="6" value="0 Years"></td>
	   </tr>
	   <tr>
	     <td align="center"><br><input type="submit" value="Submit"></td>
	   </tr>
	  </table>
	  <? } ?>
	 </form>
     </td>
   </tr>
 </table>
<?php include '~Bottom.php';?>
 </center>
</div>
</body>
</html>