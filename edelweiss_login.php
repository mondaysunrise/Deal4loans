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

		$pdo = db_connect_PDO();
		$stmt = $pdo->prepare('SELECT * FROM Bidders WHERE Email = :email and  PWD = :pwd and Is_Verified=1718');
		$stmt->execute(array('email' => $Email, 'pwd'=> $PWD));
		$num_rows = $stmt->rowCount();
		
		if($num_rows > 0){
			 /* Get Resultset */
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			 /* Create Session Variables */
			setSessionBidder($Email, $row);

			 /* Dump Resultset */
			 
			mysql_free_result($result);
			
			 /* Redirect browser */
			 $strDir = dir_name();
			
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."edelweiss_countleads.php");
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
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login(Bidder)</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />


<img src="images/logo.gif" alt="Deal4Loans" onClick="javascript:location.href='index.php?flag=1'"/>
    
   <style>
.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
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
 <table align="center" border="0" valign="top" cellspacing="0" cellpadding="0" style="border-collapse: collapse" bordercolor="#111111">
	 	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
	<td align="center">
		 <form method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return validateMe(this);">
			<table width="250" border="0" cellpadding="4" cellspacing="0" class="blueborder" id="frm">
			   <tr>
				 <td colspan="2" class="head1">Login (Bidders)</td>
			   </tr>
			   <tr>
				 <td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11"><? echo $Msg ?></span></td>
			   </tr>
			   <tr>
				 <td width="50%" class="bidderclass">Email</td>
				 <td width="50%"><input type="text" name="Email" size="20" maxlength="50"></td>
			   </tr>
			   <tr>
				 <td width="50%" class="bidderclass">Password</td>
				 <td width="50%"><input type="password" name="PWD" size="20" maxlength="50"></td>
			   </tr>
			   <tr>
				 <td width="100%" colspan="2" align="center"><input type="submit" class="bluebutton" value="Submit"></td>
			   </tr>
		  </table>
		 </form>
	 </td>
	 </tr>
 </table>
 
  </body>
</html>

