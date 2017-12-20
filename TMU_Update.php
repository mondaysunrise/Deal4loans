<?php
//session_start();
	require 'scripts/session_checkTM.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//print_r ($_SESSION);

if(isset($_POST['Submit']))
{
	$UCount = $_POST['UCount'];
	$UniqueID = $_POST['BankID'];
	$BaseID = $_POST['UID'];
	
	for($i=0;$i<$UCount;$i++)
	{
		if(strlen($UniqueID[$i])>0)
		{
			$DataArray = array("TME_UniqueID"=>$UniqueID[$i], "TME_Date"=>$Dated );
			$wherecondition ="(TME_ID='".$BaseID[$i]."')";
			Mainupdatefunc ('citi_appointments', $DataArray, $wherecondition);
		}
	}
		header("Location: TMU_View.php");
		exit();

}


?>

<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/ajaxcodeTMU.js"></script>
<script Language="JavaScript" Type="text/javascript" >
</script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?php include '~TopTM.php';?>


  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">

 <br>
 <br>
  <table width="712" border="0">
 <tr><td align="center" width="100%">
 <div align="center">


	<?php
	
			$ResultSql = "select * from Telecaller_Mgmt_Entry  where  TME_UniqueID = '' and TME_Name!=''  and  TMU_ID='".$_SESSION['TMU_ID']."' ";
		   list($NumRows,$Result)=MainselectfuncNew($ResultSql,$array = array());
			
	?>
		<TABLE ALIGN="center" WIDTH="75%" CELLPADDING="0" CELLSPACING="0" BORDER="0">
				<TR>
					<TD>
						<FIELDSET CLASS="textfield">
							<LEGEND>
								<FONT SIZE="2" TYPE="Comic Sans"><I>User Details:</I></FONT>
							</LEGEND>
							<FORM NAME="frmTMUpdate" action="TMU_Update.php" method="post">
		<table  cellpadding="4" cellspacing="1" class="blueborder" width="100%">
		<tr><td colspan="5"></td></tr>
		<tr>
			<td class="head1">Name</td>
			<td class="head1">Mobile</td>
			<td class="head1">Pancard</td>
			<td class="head1">TeleCaller_Name</td>
			<td class="head1">Bank's ID</td>
		</tr>
		<?php
		for($i=0;$i<$NumRows;$i++)
		{
			$Id =  $Result[$i]['TME_ID'];
			$BId =  $Result[$i]['TME_UniqueID'];
		?>
		<tr>
			<td class="bodyarial11"><?php echo $Result[$i]['TME_Name'];  ?></td>
			<td class="bodyarial11"><?php echo $Result[$i]['TME_Mobile']; ?></td>
			<td class="bodyarial11"><?php echo $Result[$i]['TME_Pancard']; ?></td>
			<td class="bodyarial11"><?php echo $Result[$i]['TME_TCaller_Name']; ?></td>
			 <td class="bodyarial11"><input type="text" name="BankID[]" ></td> 
			<!-- <td class="bodyarial11"><input type="text" name="BankID_<?php echo $ID; ?>" ></td> -->
			<td class="bodyarial11"><input type="hidden" name="UID[]" value="<?php echo $Id; ?>"  ></td>
		</tr>
		<?php
		}
		?>
		<tr>
			<td COLSPAN="4" NOWRAP>
			<DIV ALIGN="right">
			
			<INPUT NAME="Submit" TYPE="submit" CLASS="btnStyle" VALUE="Save">
			<input type="hidden" name="UCount"  value="<?php echo $NumRows; ?>">
			</DIV>
			</td>
			<td>&nbsp;</td>
			
		</tr>
		
		</table>
		</form>
		</FIELDSET>
		</TD>
		</TR></TABLE>
	
 <br>
 
 <br>

 <h3 class="bodyarial11">

    </div>
 </td></tr></table>
  </div>
   </div>
<?php //include '~Bottom.php';?>


</body>

</html>
