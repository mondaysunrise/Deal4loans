<?php
require_once("includes/application-top-inner.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
		foreach($_POST as $a=>$b)
			$$a=$b;
		 $BidderID = FixString($_POST['BidderID']);
		$numberupdate = FixString($_POST['numberupdate']);
		$Bank_Name = FixString($_POST['contact_name']);

		if($numberupdate==1)
		{
			$sendtocontact=FixString($_POST["sendtocontact"]);
			if($sendtocontact=="newNumber")
			{
				$finalcontactno = FixString($_POST["newcontact"]);
				if($finalcontactno>0)
				{
				$sqlqry="update `req_plcompaign_smscontact` set Sms_Flag=1, Mobile_no=".$finalcontactno.", Bank_Name='".$Bank_Name."' where (BidderID=".$BidderID.") order by Compaign_ID DESC";
				$sqlqryreult= $obj->fun_db_query($sqlqry);
				}
			}
			else
			{
				$finalcontactno = $sendtocontact;
			}
			//echo $finalcontactno;
			$sqllist="select * from req_plcompaign_smscontact where (BidderID=".$BidderID." and Sms_Flag=1) order by Compaign_ID DESC";
			$sqllistreult= $obj->fun_db_query($sqllist);
			$numrows = $obj->fun_db_get_num_rows($sqllistreult);

			//echo "r ".$sqllistreult= $objn->fun_db_query($sqllist);
			//echo "d".$numrows = $objn->fun_db_get_num_rows($sqllistreult);
			if($numrows>0)
			{	
				while($rownw = $obj->fun_db_fetch_rs_object($sqllistreult))
					{					
					$Mobile_no = $rownw->Mobile_no;
					
						if($Mobile_no==$finalcontactno)
						{
							$sql2="update `req_plcompaign_smscontact` set Sms_Flag=1,Bank_Name='".$Bank_Name."' where (Mobile_no=".$finalcontactno." and BidderID=".$BidderID.")";
							$sql2reult= $obj->fun_db_query($sql2);
						}
						else
						{
							$sql2="update `req_plcompaign_smscontact` set Sms_Flag=0 where (Mobile_no!=".$finalcontactno." and BidderID=".$BidderID.")";
							$sql2reult= $obj->fun_db_query($sql2);
						}	
						
						//echo $sql2."<br>";
					}
			}
			else
			{
				//insert
			}
		}
	
		  $sqlecontact="Select Mobile_no, BidderID, Reply_Type,Bank_Name From `req_plcompaign_smscontact` Where Sms_Flag=1 and BidderID=".$BidderID;
		$sqlecontactreult= $obj->fun_db_query($sqlecontact);
		$num_rows = $obj->fun_db_get_num_rows($sqlecontactreult);
}
  ?> 
<html>
		<head>
		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
		<title>Login</title>
		<script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
		<link href="../includes/style1.css" rel="stylesheet" type="text/css">
		<link href="../style.css" rel="stylesheet" type="text/css" />
		<script language="javascript" type="text/javascript" src="../scripts/datetime.js"></script>
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
<div style="clear:both;"></div>
<form name="bidderform" action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST">
<table cellpadding="5" cellspacing="5" align="center">
<tr><td colspan="2"></td></tr>
<tr>
<br>
<td>Enter BidderID</td> <td><input type="text" maxlength="4" name="BidderID" value="<? echo $BidderID; ?>"></td>
</tr>
<tr><td colspan="2" align="center"><input type="submit" name="submit" style="background-color:#fff; color:#000;" ></td></tr>
</table>
<? if($num_rows>0)
{  $numberupdate=1; ?> 
<input type="hidden" name="numberupdate" value="1">
<table border="1" cellpadding="3" cellspacing="1" align="center" >
<tr align="center"><td><b>Select</b></td><td><b>Bank Name</b><td><b>Mobile No</b></td><td><b>BidderID</b></td></tr>	
<? while($row = $obj->fun_db_fetch_rs_object($sqlecontactreult))
		{ ?> 
			<tr align="center"><td><input type="radio" value="<? echo $row->Mobile_no; ?>" name="sendtocontact"></td><td><input type="text" name="contact_name" id="contact_name" value="<? echo $row->Bank_Name; ?>"></td><td><? echo $row->Mobile_no; ?></td><td><? echo $row->BidderID; ?></td></tr>
		<? } 
		?>
	<tr><td align="center" colspan="3"><table id="myTableContact" border="1" cellpadding="3" cellspacing="1" align="center" ></table></td></tr>	 
	
		<tr><td align="right" colspan="3"><input type="button" name="button" value="add new" onclick="myFunction();"></td></tr>
 <tr><td align="center"colspan="3"><input type="submit" name="submit"></td></tr>
 <table>
  <? }
 ?>
 </form>
</div>
<script>
function myFunction() {
    var table = document.getElementById("myTableContact");
	 var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);
	var cell0 = row.insertCell(0);
    var cell1 = row.insertCell(1);
    var cell2 = row.insertCell(2);
	var cell3 = row.insertCell(3);
	cell0.innerHTML = "<input type='radio' name='sendtocontact' value='newNumber'>";
	cell1.innerHTML = "<input type='text' name='contact_name'>";
    cell2.innerHTML = '+91 <input type="text" name="newcontact" maxlength="10">';
	cell3.innerHTML = "enter mobile number";	
}
</script>
</body>
</html>