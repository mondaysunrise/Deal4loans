<?php
//session_start();
	require 'scripts/session_checkTM.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//print_r ($_SESSION);

if(isset($_POST['Submit']))
{
	
	$UniqueID = $_POST['BankID'];
	$BaseID = $_POST['UID'];
	$E_ID = $_POST['EID'];
	$Dated = ExactServerdate();
	
			//$UpdateQuery = "update Telecaller_Mgmt_Entry set  TME_UniqueID = '".$UniqueID."', `TME_Date`=Now(), TMU_ID = '".$E_ID."' where TME_ID='".$BaseID."'";
			//echo "<br>".$UpdateQuery;
			//$Result = ExecQuery($UpdateQuery);
			
		$DataArray = array("TME_UniqueID"=>$UniqueID, "TME_Date"=>$Dated, "TMU_ID"=>$E_ID);
		$wherecondition ="TME_ID='".$BaseID."'";
		Mainupdatefunc ('Telecaller_Mgmt_Entry', $DataArray, $wherecondition);
			
			$msg = 'updated';
	
		
}

			$ID = $_REQUEST['ID'];
			$EnteredByID = $_REQUEST['EnteredByID'];			
			$ResultSql = "select * from Telecaller_Mgmt_Entry  where  TME_ID ='".$ID."' ";
			list($recordcount,$getrow)=MainselectfuncNew($ResultSql,$array = array());
			$cntr=0;
			
			//$Result = ExecQuery($ResultSql);
			//$NumRows = mysql_num_rows($Result);
			 $Id =  $getrow[$cntr]['TME_ID'];
			
	?>
				<FORM NAME="frmTMUpdate" action="TMU_UpdateBankID.php" method="post">
				<link href="style.css" rel="stylesheet" type="text/css" />
				<link href="includes/style1.css" rel="stylesheet" type="text/css">
		
		<table  cellpadding="4" cellspacing="1" class="blueborder" width="100%">
		<?php 
		if(isset($msg))
		{
		?>
		
		<tr><td colspan="5" align="center">Updated Susscssfully</td></tr>
		<tr><td colspan="5" align="center"><a href="javascript:window.close()">Close Window</a></td></tr>
		<?php
		}
		else {
		?>
		<tr>
			<td class="head1">Name</td>
			<td class="head1">Mobile</td>
			<td class="head1">Pancard</td>
			<td class="head1">TeleCaller_Name</td>
			<td class="head1">Bank's ID</td>
		</tr>
	
		<tr>
			<td class="bodyarial11"><?php echo $getrow[$cntr]['TME_Name'];  ?></td>
			<td class="bodyarial11"><?php echo $getrow[$cntr]['TME_Mobile']; ?></td>
			<td class="bodyarial11"><?php echo $getrow[$cntr]['TME_Pancard']; ?></td>
			<td class="bodyarial11"><?php echo $getrow[$cntr]['TME_TCaller_Name']; ?></td>
			 <td class="bodyarial11"><input type="text" name="BankID" ></td> 
			<td class="bodyarial11"><input type="hidden" name="UID" value="<?php echo $Id; ?>"  >
			<input type="hidden" name="EID" value="<?php echo $EnteredByID; ?>">
			</td>
		</tr>
		
		<tr>
			<td COLSPAN="4" NOWRAP>
			<DIV ALIGN="right">
			
			<INPUT NAME="Submit" TYPE="submit" CLASS="btnStyle" VALUE="Save">
						</DIV>
			</td>
			<td>&nbsp;</td>
			
		</tr>
		
		</table>
		<?php } ?>
		</form>