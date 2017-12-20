<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_destroy();
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$Email = $_POST["Email"];
	$PWD = $_POST["PWD"];
	
	$pdo = db_connect_PDO();
	$stmt = $pdo->prepare('SELECT * FROM Bidders WHERE Email = :email and  PWD = :pwd and Is_Verified>1');
	$stmt->execute(array('email' => $Email, 'pwd'=> $PWD));
	$num_rows = $stmt->rowCount();
	$_SESSION['ReplyType']=" ";

	if($num_rows>0)
	{
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$BidderID= $row["BidderID"];
			$Email= $row["Email"];
			$Global_Access_ID = $row['Global_Access_ID'];
			$_SESSION['DefinePrePost'] = $row['Define_PrePost'];
			$_SESSION['product']= $row["Reply_Type"];
			$_SESSION['leadidentifier']= $row["leadidentifier"];
			$_SESSION['Process_Name']= $row["Process_Name"];
			$_SESSION['CallStatus']= $row["CallStatus"];
			setSessionBidder($Email, $row);
			$result1 = d4l_ExecQuery("Select BankID,Reply_Type,Dated,City from Bidders_List where BidderID='".$_SESSION['BidderID']."'");
					
			while($row1=d4l_mysql_fetch_array($result1))
			{
				$_SESSION['Date'] = $row1['Dated'];
				$_SESSION['city'] = $row1['City'];
				$_SESSION['ReplyType'] = $_SESSION['ReplyType'].",".$row1['Reply_Type'];
				$_SESSION['ReplyType'];
				$_SESSION['BankID'] = $row1['BankID'];
			}
			/* Dump Resultset */
			mysql_free_result($result);
			mysql_free_result($result1);
			$IP_Remote = $_SERVER["REMOTE_ADDR"];
			if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
			else { $IP= $IP_Remote;	}
		
			$sqlbidseid = "INSERT INTO bidders_session_details (sessionid, bidderid, product, ip_address, login_date) VALUES ('".$_SESSION["our_session"]."', '".$_SESSION['BidderID']."', '".$row["Reply_Type"]."', '".$IP."', Now())";
			d4l_ExecQuery($sqlbidseid);

			$sql = "INSERT INTO Bidders_Login_Details (BidderID,Bidder_Name, Last_Login_Date, IP_Address, Product_Type, City ) Values ('".$_SESSION['BidderID'] ."', '".$_SESSION['UName']."',  Now(), '$IP', '".$_SESSION['ReplyType']."' ,'".$_SESSION['city']."' )";
			d4l_ExecQuery($sql);
			$last_inserted_value = d4l_mysql_insert_id();

			$_SESSION['last_inserted_value'] = $last_inserted_value;

  			$today = date("Y-m");
			$explodeToday = explode("-",date("Y-m-d"));
			$field_date =  $explodeToday[2];
			$fielddate = "Date_".$field_date;
			$todayinput =  date("Y-m-d H:i:s");
            $selectDate =$today."-01 00:00:00";
			$inputmonth = date("m");
			
			$checkBidderSQL = "select * from BiddersLoginDetails where BidderID ='".$_SESSION['BidderID'] ."' and  First_Login_Date>='".$selectDate."'";
			$checkBidderQUERY = d4l_ExecQuery($checkBidderSQL);
			$checkBidderNumRows = d4l_mysql_num_rows($checkBidderQUERY);
			$checkBidderROW = d4l_mysql_fetch_array($checkBidderQUERY);
			$z = d4l_mysql_result($checkBidderQUERY,0,$fielddate);

			if($z > 0)
				$countofDate = $z+1;
			else 
				$countofDate = 1;
					
			if($checkBidderNumRows>0)
			{
			  	$sqlTrackBidder = "update BiddersLoginDetails set  ".$fielddate." = ".$countofDate." where BidderID = '".$_SESSION['BidderID'] ."' and Month_Details = $inputmonth";
			}
			else 
			{
			 	$sqlTrackBidder = "INSERT INTO BiddersLoginDetails (BidderID, Bidder_Name, First_Login_Date, ".$fielddate.", Month_Details ) Values ('".$_SESSION['BidderID'] ."', '".$_SESSION['UName']."',  '".$todayinput ."', $countofDate, $inputmonth)";
			}

			d4l_ExecQuery($sqlTrackBidder);
			$strDir = dir_name();

			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."sbidocumentotpvalidate.php");
			exit;
		}
	}
	else{
		global $Msg;
		$Msg =  "** Invalid Email. Please try again **";
	}
}
	
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login(Bidder)</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<style>
.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
}

.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
	color:#084459;
}
</style>
<Script Language="JavaScript">
function validateMe(theFrm){
	if(!checkData(theFrm.Email, 'Email', 4))
	{
		return false;
	}
	var str=theFrm.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		alert("Please enter the valid Email Address");
		theFrm.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Please enter the valid Email Address");
		theFrm.Email.focus();
		return false;
	}
	if(!checkData(theFrm.PWD, 'Password', 3))
		return false;
	return true;
}
</Script>
<body style="margin:0px; padding:0px; background-color:#45B2D8;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse" valign="top">
	<tr bgcolor="#FFFFFF">
		<td align="left">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="323" height="93" align="left" valign="top"><img src="images/login-logo.gif" width="323" height="93" /></td>
					<td valign="top">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td height="67" align="right" bgcolor="#C6E3F2">&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center"></td>
	</tr>
	<tr>
		<td bgcolor="#45B2D8" align="center">
			<table width="361"   border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td width="361" height="43" align="center" valign="middle"><img src="images/login-form-topshine-bg.gif" width="361" height="43"></td>
				</tr>
				<tr>
					<td height="156" align="center" valign="middle" background="images/login-form-login-bg.gif">
						<form method="post" action="<? //echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
						<table width="250" border="0" cellpadding="4" cellspacing="0">
							<tr>
								<td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11"><? echo $Msg ?></span></td>
							</tr>
							<tr>
								<td width="100%" class="style1">Username</td>
								<td width="100%"><input type="text" name="Email" size="20" maxlength="50"></td>
							</tr>
							<tr>
								<td width="100%" class="style1">Password</td>
								<td width="100%"><input type="password" name="PWD" size="20" maxlength="50"></td>
							</tr>
							<tr>
								<td width="100%" colspan="2" align="center"><input name="submit" type="image"  src="images/login-form-lgn-sbtn.gif" style="width:111px; height:35px; border:none;"></td>
						   </tr>
						</table>
						</form>
					</td>
				</tr>
				<tr>
					<td width="361" height="70" align="center" valign="middle">
						<img src="images/login-form-bot-shine-bg.jpg" width="361" height="70">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-1312775-1', 'deal4loans.com');
ga('require', 'displayfeatures');
ga('send', 'pageview');
</script>
</body>
</html>

