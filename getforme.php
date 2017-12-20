<?php

require 'scripts/db_init.php';

?>
<html>
<head>
</head>
<body>
<?


$mstrTxtEmailID;

Main();

function Main()
{

	formRetrieveValues();

	if($_POST[submit])
	{
		showListExpressOptions();
		showList();
	}
	else
		showListExpressOptions();
		
}

function showListExpressOptions()
{
	global $mstrTxtEmailID;

	?>
	<script language="JavaScript">
		function Validate()
		{
			var theForm;
			theForm = window.document.frmAP3Shipments;
			
			if(theForm.ap3shipments_rbttype1[2].checked)
			{
				if(Trim(theForm.ap3shipments_txtshipmentid.value).length == 0)
				{
					alert("Please enter the Shipment ID");
					theForm.ap3shipments_txtshipmentid.focus();
					return(false);
				}
			}
		}
		
		
		function DoView()
		{
			document.location.href = "AP3Products.php";
		}

		function AutoCheckRbtType11()
		{
			var theForm;
			theForm = window.document.frmAP3Shipments;
			theForm.ap3shipments_rbttype1[1].checked=true;
		}

		function AutoCheckRbtType12()
		{
			var theForm;
			theForm = window.document.frmAP3Shipments;
			theForm.ap3shipments_rbttype1[2].checked=true;
		}
		
	</script>
	<p><font size="3"><b>User List</b></font><br>
	<hr size="1">
	<br>
	
	<FORM name="frmAP3Shipments" METHOD="POST" ACTION="getforme.php">
	<table border="0" cellpadding="5" cellspacing="0">

	<tr>
		<td><b>Filter:</b></td>
	</tr>
	<tr>
		<td align="left" valign="top"><font size="2" face="Arial">Enter Email ID : </font>	
			<input type="text" name="d4l_txtemailid" value="<? if($mstrTxtEmailID !=NULL) echo $mstrTxtEmailID; ?>">
		</td>	
	<tr>
		<td>
		<CENTER>
				<Input type="submit" name="submit" value="View List">		</CENTER>
		</td>
	</tr>
	</table>
	</form>

	<?php
}


function formRetrieveValues()
{
	global $mstrTxtEmailID;
	
	$mstrTxtEmailID = Trim($_REQUEST['d4l_txtemailid']);
}


function showList()
{
	global $mstrTxtEmailID;

	
	$bolValidList;
	
	$lngRow;
	$strBGColor;
	
	$bolValidList = true;
		
	//============================================
	//Load All Shipments
	//============================================	
	$SQLStr = "SELECT EMAIL, Phone, PWD";
	$SQLStr = $SQLStr." from wUsers";
	$SQLStr = $SQLStr." WHERE EMAIL like '%".$mstrTxtEmailID."%'";
	$SQLStr = $SQLStr." ORDER BY EMAIL";
	
	
    	
	If(bolValidList)
	{
		
		//Display Title
		
		$lngRow = 0;

		$result = ExecQuery($SQLStr);
		echo mysql_error();

		If ($myrow = mysql_fetch_array($result))
		{
			?>			
			<script language="JavaScript">
				function full(url) {
    			if (document.all) {
        		window.open(url,'windowName','fullscreen=yes');
        		return false;
    			}
    			return true;
				}
			</script>
		
			<table cellspacing="0">
				<tr bgcolor="#666699">
					<td align="left" valign="top"><font size="-1" color="#FFFFFF"><b>Email ID</b></font></td>
					<td width="5">&nbsp;</td>
					<td align="left" valign="top"><font size="-1" color="#FFFFFF"><b>Phone</b></font></td>
					<td width="5">&nbsp;</td>					
					<td align="left" valign="top"><font size="-1" color="#FFFFFF"><b>Password</b></font></td>
					<td width="5">&nbsp;</td>					
				</tr>
			<?php

  		    do
			{
				$lngRow = $lngRow + 1;
				
				if ($lngRow % 2)
					$strBGColor = "#FFFFFF";
				else
					$strBGColor = "#EEEEEE";				
			
				$mvar_EMail=$myrow["EMAIL"];
				$mvar_Phone=$myrow["Phone"];
				$mvar_PWD=$myrow["PWD"];

				?>
				<tr bgcolor="<?php echo $strBGColor; ?>">
						<td align="left" valign="top"><font size="-1"><? echo $mvar_EMail; ?></font></td>
						<td width="5">&nbsp;</td>
						<td align="left" valign="top"><font size="-1"><? echo $mvar_Phone; ?></font></td>
						<td width="5">&nbsp;</td>
						<td align="left" valign="top"><font size="-1"><? echo $mvar_PWD; ?></font></td>
						<td width="5">&nbsp;</td>
				</tr>
				<?
		  }while ($myrow = mysql_fetch_array($result));
			  mysql_free_result($result);

		}
		?>
		</table>
		<?
	}
}
?>
</body>
</html>