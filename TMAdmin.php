<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//	require 'scripts/session_checkTM.php';
session_start();
	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
		formHandler();

	function formHandler(){
		foreach($_POST as $a=>$b)
			$$a=$b;
		$sql = "select * from Telecaller_Mgmt_User where TMU_UserName='$UserName' and TMU_Password='$PWD'";
		
		 list($num_rows,$row)=MainselectfuncNew($sql,$array = array());
		 $cntr=0;
		//$result = ExecQuery($sql);
		
		//$num_rows = count($result);
		
		if($num_rows > 0){
			 /* Get Resultset */
			//$row = mysql_fetch_array($result);
		
				$_SESSION['UserName'] = $row[$cntr]['TMU_UserName'];
				$_SESSION['Name'] = $row[$cntr]['TMU_Name'];
				$_SESSION['TMU_ID'] = $row[$cntr]['TMU_ID'];	
				$_SESSION['TeleCaller'] = "TeleCallerModule";	
				$_SESSION['TMName'] = $row[$cntr]['TMU_Name'];
			$IP = getenv("REMOTE_ADDR");
			
		

//echo $sql;
		//	echo $_SESSION['ReplyType'];
			 /* Redirect browser */
			 $strDir = dir_name();
			 
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."TMU_Entry.php");
	
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
<title>Login(TeleCaller Administration)</title>
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
   function validateMe(Form){
	if(Form.UserName.value=="")
	{
		alert("Kindly fill in your UserName!");
		Form.UserName.focus();
		return false;
	}
	if(Form.PWD.value=="")
	{
		alert("Kindly fill in your PWD!");
		Form.PWD.focus();
		return false;
	}


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
 <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(document.AdminValue);" name="AdminValue">
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