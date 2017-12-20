<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//	require 'scripts/session_checkBilling.php';
session_start();
	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		formHandler();

	function formHandler(){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$sql = "select * from Billing_User where (Billing_UserName='$UserName' and Billing_Password='$PWD' and Billing_ID=2)";
		list($num_rows,$row) = Mainselectfunc($result,$array = array());

		
		if($num_rows > 0){
		
				$_SESSION['UserName'] = $row['Billing_UserName'];
				$_SESSION['Name'] = $row['Billing_Name'];
				$_SESSION['UName'] = $row['Billing_Name'];
				$_SESSION['TMU_ID'] = $row['Billing_ID'];				
						
			$IP = getenv("REMOTE_ADDR");
			
			 $strDir = dir_name();
		header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."billingindexprepaid.php");
			exit;
		}
		else{
			global $Msg;
			$Msg =  "** Invalid UserName. Please try again **";
		}
	}
?>
<?php
$agent = getenv("HTTP_USER_AGENT");
if (preg_match("/MSIE/i", $agent)) {
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Login(Billing Administration)</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?php include '~TopTM.php';?>


<div id="dvMainbanner">
    
 
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent"><Script Language="JavaScript">
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
 
<tr>
 <td align="center" width="100%">
 <table width="100%" border="0">
<?php
		if(isset($_GET['lv']))
		{
		 		echo "<tr><td>".$_GET['lv']."</td></tr>";
		}
 ?>
   <tr><td width="140">&nbsp;</td>
 <td align="center">
 <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
<p>&nbsp;</p>
  <p>&nbsp;</p>
 <table width="250" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
   <tr>
     <td colspan="2" class="head1">Login </td>
   </tr>
   <tr>
     <td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11"><? echo $Msg ?></span></td>
   </tr>
   <tr>
     <td width="50%" class="bodyarial11">User Name</td>
     <td width="50%"><input type="text" name="UserName" size="20" maxlength="50"></td>
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
  <?php //include '~Right1.php';?>
  </div>
  </div>
<?php // include '~Bottom.php';?>
  </body>
</html>

</html>

<?php
 } else {
    echo "Browser Specific Viewed Only on Internet Explorer";
}
?>