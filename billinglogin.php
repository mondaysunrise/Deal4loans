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

		$result = ("select *  from Bidders where Email='$Email' and PWD='$PWD' and Is_Verified=35");
		 list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$cntr=0;
		
		
		//$num_rows = mysql_num_rows($result);

		if($num_rows > 0){
			 /* Get Resultset */
			//$row = mysql_fetch_array($result);

			 /* Create Session Variables */
			setSessionBidder($Email, $row);

			 /* Dump Resultset */
			mysql_free_result($result);
			
			 /* Redirect browser */
			 $strDir = dir_name();
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."billing_index.php");
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
<title>Login(Bidder)</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div align="center">
 <center>
 <?php include '~Top.php'; ?>

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
 <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
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
     <td width="100%" colspan="2" align="center">&nbsp;<p><input type="submit" class="bluebutton" value="Submit"></td>
   </tr>
  </table>
 </form>
 <h3>&nbsp;</h3>
 <h3 class="bodyarial11">Not registered yet?<br>
     <a href="Bidder_Register.php">Register Here !!</a></h3>
 <p><br>
 <br>
&nbsp;</p>
 <?php include '~Bottom.php'; ?>
 </center>
</div>
</body>

</html>