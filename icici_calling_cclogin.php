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
		$result = ("select *  from Bidders where Email='$Email' and PWD='".trim($PWD)."'");		
	 list($num_rows,$row)=Mainselectfunc($result,$array = array());
	

	$IP_Remote = getenv("REMOTE_ADDR");
	if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP=$IP_Remote;	}
	$getIPSql = "select ip from ip_whitelist where ip='".$IP."' and status=1";
	 list($getIPNum,$getrow)=MainselectfuncNew($result,$array = array());
		$p=0;

	//if(($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || ($getIPNum>0)))
		//	{			
		if($num_rows > 0){
			 /* Get Resultset */
		
			 /* Create Session Variables */
			setSessionBidder($Email, $row);
			$IP = getenv("REMOTE_ADDR");	
			$sess_id = generateNumber(6);
			$_SESSION['sess_id'] = $sess_id;						
			 /* Dump Resultset */
			mysql_free_result($result);
			 /* Redirect browser */
			 $strDir = dir_name();
			if($row['BidderID']==77 || $row[$cntr]['BidderID']==78 || $row[$cntr]['BidderID']==79)
			{
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."icici_cardscallingview.php");
				exit;
			}
			else{
			global $Msg;
			$Msg =  "** Invalid Email. Please try again **";
		}	
			}		
		/*}
		else{
			global $Msg;
			$Msg =  "** Invalid Email. Please try again **";
		}	*/		
	}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login(Bidder)</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<?php include '~Top.php';?>

<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="images/main_banner1.gif" /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">

<Script Language="JavaScript">
   function validateMe(theFrm){
   if(!checkData(theFrm.Name, 'Name', 4))
	{
		return false;
	}
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
	if(!checkData(theFrm.PWD, 'Password', 5))
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
     <td colspan="2" class="head1">Login (Bidders)</td>
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
   </div>
  </div>
<?php include '~Bottom.php';?>
  </body>
</html>