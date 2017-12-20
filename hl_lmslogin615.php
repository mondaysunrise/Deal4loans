<?php

	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	session_start();
	$Msg = "";
$IP_Remote = getenv("REMOTE_ADDR");
	if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP=$IP_Remote;	}
	$getIPSql = "select ip from ip_whitelist where ip='".$IP."' and status=1";
	 list($getIPNum,$getrow)=MainselectfuncNew($getIPSql,$array = array());
		$cntr=0;
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		formHandler();

	function formHandler(){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$result = ("select *  from Bidders where Email='".$Email."' and PWD='".$PWD."' and BidderID='3635'");
		list($num_rows,$row)=Mainselectfunc($result,$array = array());
		

	$IP_Remote = getenv("REMOTE_ADDR");
	if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP=$IP_Remote;	}
	$getIPSql = "select ip from ip_whitelist where ip='".$IP."' and status=1";
		list($getIPNum,$Myrow)=MainselectfuncNew($getIPSql,$array = array());
	

 if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.177.167.80" || $IP=="122.177.217.1" || $IP=="122.176.122.134" || $IP=="123.238.19.52" || $IP=="115.245.226.31" || $IP=="101.62.210.140" || $IP=="101.62.149.199" || ($getIPNum>0))
			{
		if($num_rows > 0){
			 /* Get Resultset */
		

			 /* Create Session Variables */
			setSessionBidder($Email, $row);
			$IP = getenv("REMOTE_ADDR");	
			$sess_id = generateNumber(6);
			$_SESSION['sess_id'] = $sess_id;
			$_SESSION['Caller_Name'] = $Name;
			$Dated = ExactServerdate();
			
			$dataInsert = array("BidderID"=>$row[0]['BidderID'], "Bidder_Name"=>$Name, "Start_Time"=>$Dated, "End_Time"=>'', "SessionID"=>$sess_id, "IP"=>$IP, "Product_Type"=>2);
			$table = 'LMSLoginDetails';
			$insert = Maininsertfunc ($table, $dataInsert);

			 /* Dump Resultset */
			mysql_free_result($result);
			
			 /* Redirect browser */
			 $strDir = dir_name();
			
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."hl_lms615.php");
			exit;	
		
		}
		else{
			global $Msg;
			$Msg =  "** Invalid Email. Please try again **";
		}
			}
			else{
			global $Msg;
			$Msg =  "** Your are not Authorized **";
		}
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
 </head>
<?php include '~Top.php';?>
  <div id="dvContentPanel">
   <div id="dvMaincontent">
  <div align="center">
 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#111111">

 <td align="center" width="100%">
 <table width="100%" border="0">
 <tr><td width="140">&nbsp</td>
  <tr><td width="140">&nbsp</td>
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
     <td width="50%" class="bodyarial11">Name</td>
     <td width="50%"><input type="text" name="Name" size="20" maxlength="50"></td>
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
 <td>&nbsp; </td></tr>
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
  </body>
</html>