<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	session_start();
	$Msg = "";
$IP_Remote = getenv("REMOTE_ADDR");
if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
else { $IP=$IP_Remote;	}

if(($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68"))
{
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		formHandler();

	function formHandler(){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$result = "select *  from Bidders where Email='$Email' and PWD='$PWD'";
		list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$rowcontr=count($row)-1;
		
		if($num_rows > 0){
			 /* Get Resultset */
	//		$row = mysql_fetch_array($result);

			 /* Create Session Variables */
			setSessionBidder($Email, $row[$rowcontr]); // We will have to cross check this once. Upendra 14-09-2015

			 /* Dump Resultset */
			mysql_free_result($result);
			
			 /* Redirect browser */
			 $strDir = dir_name();
			 $IP_Remote = getenv("REMOTE_ADDR");
	if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP=$IP_Remote;	}
			if(($row["BidderID"]==935) && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134"))
			{
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."icicilms_index.php");
			exit;
			}
			elseif(($row[$rowcontr]["BidderID"]==69 || $row["BidderID"]==936))
			{
			//	$icicilogqry="INSERT INTO icicilms_loginlog (`icicilog_bidderid`, `icicilog_startdatetime`, `icicilog_product`) VALUES ('".$row["BidderID"]."', Now(), '4')";
			$Dated = ExactServerdate();
					
			$dataInsert = array('icicilog_bidderid'=>$row[$rowcontr]['BidderID'], 'icicilog_startdatetime'=>$Dated, 'icicilog_product'=>'4');
			$insert = Maininsertfunc ('icicilms_loginlog', $data);
			//	$icicilogresult = ExecQuery($icicilogqry);

			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."icicicardslms_view.php");
			exit;
			}
			elseif($row["BidderID"]==4883)
			{
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."icicicardslms_verifyview.php");
				exit;
			}
			elseif($row["BidderID"]==4884)
			{
				header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."icicicardslms_adminview.php");
				exit;
			}

			else{
			global $Msg;
			$Msg =  "** Invalid Email. Please try again **";
		}
		}
		else{
			global $Msg;
			$Msg =  "** Invalid Email. Please try again **";
		}
	}
}
?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
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
 <td>&nbsp</td></tr>
 <tr>
 <td>&nbsp</td></tr>
 <tr>
 <td>&nbsp</td></tr>
 <tr>
 <td align="center" width="100%">
 <table width="100%" border="0">
 <tr><td width="140">&nbsp</td>

 </table>
 </td>
 </tr>
</table>

</div>
  <?php //include '~Right1.php';?>
  </div>
  </div>
<?php include '~Bottom.php';?>
  </body>
</html>

</html>