<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	session_start();
	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		formHandler();

	function formHandler(){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$result = "select * from Bidders where Email='$Email' and PWD='$PWD' and Is_Verified>1 and BidderID=1743";

				 list($num_rows,$row)=Mainselectfunc($result,$array = array());
		if($num_rows > 0){
			 /* Get Resultset */
			

			 /* Create Session Variables */
			setSessionBidder($Email, $row);
			$_SESSION['Email-sms'] = $Email;
		$result1 = ExecQuery("Select Reply_Type,Dated,City,Query,Max_Dated from Bidders_List where BidderID='".$_SESSION['BidderID']."'");
			
				$_SESSION['Max_Date'] = $row1['Max_Dated'];
				$_SESSION['Date'] = $row1['Dated'];
				$_SESSION['Query'] = $row1['Query'];
				$_SESSION['City'] = $row1['City'];
				$_SESSION['Email-sms'] = $Email;
				$_SESSION['ReplyType'] = $_SESSION['ReplyType'].",".$row1['Reply_Type'];
				$_SESSION['ReplyType'];
		
		
			$IP = getenv("REMOTE_ADDR");
		
		$today = date("Y-m");
			
			$explodeToday = explode("-",date("Y-m-d"));
			$field_date =  $explodeToday[2];
			$fielddate = "Date_".$field_date;
			//$fielddate = "date_02";
			$todayinput =  date("Y-m-d H:i:s");
            $selectDate =$today."-01 00:00:00";
			$inputmonth = date("m");
			header("Location: sms2customer.php");
			exit;
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
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Login(SMS)</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<div id="dvLogo"><img src="<?php echo $WebsitePath;?>images/logo.gif" alt="bimadeals"  onClick="javascript:location.href='<?php echo $WebsitePath;?>index.php'" /></div>

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
 <div align="center">
 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#111111">
 <td align="center" width="100%">
 <table width="100%" border="0">
 <tr><td width="140">&nbsp;</td>
  <tr><td width="140">&nbsp;</td>
 <td align="center">
 <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
<p>&nbsp;</p>
  <p>&nbsp;</p>
 <table width="250" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   <tr>
     <td colspan="2" class="head1">Login</td>
   </tr>
   <tr>
     <td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11"><? echo $Msg ?></span></td>
   </tr>
   <tr>
     <td width="50%" class="bodyarial11">Email</td>
     <td width="50%"><input type="text" name="Email" size="20" maxlength="50"></td>
   </tr>
   <tr>
     <td width="50%" class="bodyarial11">Password</td>
     <td width="50%"><input type="password" name="PWD" size="20" maxlength="50"></td>
   </tr>
   <tr>
     <td width="100%" colspan="2" align="center"><input type="submit" class="bluebutton" value="Submit"></td>
   </tr>
  </table>
 </form></td>
 </table>
	 
    
   
	  </td>
	  

 <tr>
 <td>&nbsp;</td></tr>
 <tr>
 <td>&nbsp;</td></tr>
 <tr>
 <td>&nbsp;</td></tr>
 <tr>
 <td align="center" width="100%">
 <table width="100%" border="0">
 <tr><td width="140">&nbsp;</td>

 </table>
 </td>
 </tr>
</table>
</div>

  </body>
</html>

