<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();
$Msg = "";

//$IP_Remote = getenv("REMOTE_ADDR");
//if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
//else { $IP=$IP_Remote;	}

$IP=ExactCustomerIP();
echo $IP;
if(($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.100.29" || $IP=="122.176.104.99" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="1.22.91.57" || $IP=="122.176.77.239" || $IP=="106.202.16.63" || $IP=="113.193.239.185" || $IP=="182.71.109.218" || $IP=="122.176.54.194" || $IP=="192.168.0.100"))
{
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Email = $_POST["Email"];
		$PWD = $_POST["PWD"];
		$uniquecode = $_POST["uniquecode"];
		$pdo = db_connect_PDO();

		$stmt = $pdo->prepare('SELECT * FROM Bidders WHERE Email = :email and  PWD = :pwd and Is_Verified=100 and BidderID in (766,1674)');
		$stmt->execute(array('email' => $Email, 'pwd'=> $PWD));
		$num_rows = $stmt->rowCount();

		if($num_rows>0)
					{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			 $BidderID= $row["BidderID"];
			$Email= $row["BidderID"];

			setSessionBidder($Email, $row);
			
			$sess_id = generateNumber(6);
			$_SESSION['sess_id'] = $sess_id;
			$_SESSION['Caller_Name'] = $Name;
			$sqlTrackBidder = "INSERT INTO  LMSLoginDetails (BidderID ,Bidder_Name ,Start_Time ,End_Time ,SessionID ,IP ,Product_Type) VALUES ( '".$BidderID."',  '".$Name."',  Now(),  '',  '".$sess_id."',  '".$IP."',  '1')";
			ExecQuery($sqlTrackBidder);

				$strDir = dir_name();

					 if($_SESSION['BidderID']==1674)
					{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."newallproduct_index.php");
					exit;
					}
					else
					{
						header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."allproductslogin_index.php");
						exit;
					}	
				}				
		}
		else{
					global $Msg;
					$Msg =  "** Invalid Email. Please try again **";
				}		
	}
}else if($_POST["uniquecode"]=='otst&memOfdl'){
 if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Email = $_POST["Email"];
		$PWD = $_POST["PWD"];
		$uniquecode = $_POST["uniquecode"];
		$pdo = db_connect_PDO();
                
                
		$stmt = $pdo->prepare('SELECT * FROM Bidders WHERE Email = :email and  PWD = :pwd and Is_Verified=100 and BidderID in (766,1674)');
		$stmt->execute(array('email' => $Email, 'pwd'=> $PWD));
		$num_rows = $stmt->rowCount();

		if($num_rows>0)
					{
			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			 $BidderID= $row["BidderID"];
			$Email= $row["BidderID"];

			setSessionBidder($Email, $row);
			
			$sess_id = generateNumber(6);
			$_SESSION['sess_id'] = $sess_id;
			$_SESSION['Caller_Name'] = $Name;
			$sqlTrackBidder = "INSERT INTO  LMSLoginDetails (BidderID ,Bidder_Name ,Start_Time ,End_Time ,SessionID ,IP ,Product_Type) VALUES ( '".$BidderID."',  '".$Name."',  Now(),  '',  '".$sess_id."',  '".$IP."',  '1')";
			ExecQuery($sqlTrackBidder);

				$strDir = dir_name();

					 if($_SESSION['BidderID']==1674)
					{
					header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."newallproduct_index.php");
					exit;
					}
					else
					{
						header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."allproductslogin_index.php");
						exit;
					}	
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login(Bidder)</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<div id="dvMainbanner" style="padding-top:50px;">
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
	if(!checkData(theFrm.PWD, 'Password', 4))
		return false;
	return true;
    }
 </Script>
<div align="center">
 <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse">

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
   <? 
   if($IP!="122.176.100.27" && $IP!="122.176.100.28" && $IP!="122.176.100.29" && $IP!="122.176.104.99" && $IP!="122.176.122.134" && $IP!="122.161.196.68" && $IP!="185.93.228.12" && $IP!="182.71.109.218" && $IP!="122.176.77.239" && $IP!="1.22.91.57")
			{ ?>
<tr>
     <td width="50%" class="bodyarial11">Unique Code</td>
     <td width="50%"><input type="text" name="uniquecode" maxlength="50"></td>
   </tr>
   <? } ?>
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
