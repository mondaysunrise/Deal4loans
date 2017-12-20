<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
	    if($_GET["edit"] == 'profile'){

		/* FIX STRINGS */
		//$Email = FixString($Email);
		$FName = FixString(ucwords($FName));
		$LName = FixString(ucwords($LName));
		$Phone = FixString($Phone);
		$Day = FixString($day);
		$Month = FixString($month);
		$Year = FixString($year);
		$DOB = $Day."-".$Month."-".$Year;
			
		if(!isset($IsPublic))
		   $IsPublic = 0;

		$sql = "UPDATE wUsers SET FName='$FName', LName='$LName', Phone='$Phone', DOB='$DOB', IsPublic='$IsPublic' WHERE UserID=$UserID";
		$result = ExecQuery($sql);
		echo mysql_error();

		if ($result == 1) 
			$Msg = getAlert("Your profile has been edited Successfully. !!", TRUE, "Welcome.php");
		else
			$Msg = "** There is a problem in editing your profile. **";

		 /* Reset Session Variables */
		//$_SESSION['Email'] = $Email;
		$_SESSION['FName'] = $FName;
		$_SESSION['LName'] = $LName;
		$_SESSION['Day'] = $Day;
		$_SESSION['Month'] = $Month;
		$_SESSION['Year'] = $Year;
		$_SESSION['Phone'] = $Phone;
		$_SESSION['IsPublic'] = $IsPublic;
	    }
		
		else if($_GET["edit"] == 'pwd'){
		/* FIX STRINGS */
		$PWDO = FixString($PWDO);
		$PWD1 = FixString($PWD1);
		$sql = ExecQuery("Select * from wUsers where PWD='".$PWDO."'");
		if ($myrow = mysql_fetch_array($sql)) 
			{
				$Flag = "1";
			}mysql_free_result($sql);
		if($Flag == 1)
			{
		$result = ExecQuery("UPDATE wUsers SET PWD='$PWD1' WHERE UserID=$UserID");
		echo mysql_error();
			}
		else
			$Msg = getAlert("Please Enter Correct Old Password", TRUE, "User_Edit.php?edit=pwd");

	
		if ($result == 1) 
			$Msg = getAlert("Your password has been changed Successfully. !!", TRUE, "Welcome.php");
		else
			$Msg = "** There is a problem in changing your password. **";

	    }
		
	}else{
		$UserID = $_SESSION['UserID'];
		$FName = $_SESSION['FName'];
		$LName = $_SESSION['LName'];
		$Day = $_SESSION['Day'];
		$Month = $_SESSION['Month'];
		$Year = $_SESSION['Year'];
		$Phone = $_SESSION['Phone'];
		$IsPublic = $_SESSION['IsPublic'];
	}
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Edit profile</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
 <center>
<link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php';?>


<div id="dvMainbanner">
    <?php include '~Upper.php';?>
    <div id="dvbannerContainer"> <img src="images/banner_persobal_loan.gif" /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
  <table border="0">
  <tr><td valign="top"><?php include '~Left.php';?>
  </td>
<td>
	<form method="post" action="<?=$_SERVER['PHP_SELF']."?edit=".$_GET["edit"]?>" onSubmit="return validateMe(this);">
	<? include "User_Edit_".$_GET["edit"].".htm"?>
	</form>
	
     </td>
	
   </tr>
 </table>
 <p>&nbsp;</p>
 </div>
 </div>
<?php include '~Bottom.php';?>    
 </center>
</div>
</body>

</html>