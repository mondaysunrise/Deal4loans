<?php
//session_start();
	require 'scripts/session_checkTM.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//print_r ($_SESSION);


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
	
			$ResultSql = "select * from Telecaller_Mgmt_User  where  TMU_ID >=3 and TCallerFlag !=1";
			list($NumRows,$getrow)=MainselectfuncNew($ResultSql,$array = array());
			$cntr=0;
		
			//$Result = ExecQuery($ResultSql);
			//$NumRows = mysql_num_rows($Result);
			
	?>
		<TABLE ALIGN="center" WIDTH="75%" CELLPADDING="0" CELLSPACING="0" BORDER="0">
				<TR>
					<TD>
						<FIELDSET CLASS="textfield">
							<LEGEND>
								<FONT SIZE="2" TYPE="Comic Sans"><I>Entry Report:</I></FONT>
							</LEGEND>
							<table  cellpadding="4" cellspacing="1" class="blueborder" width="100%">
		<tr><td colspan="5"></td></tr>
		<tr>
			<td class="head1">SL No.</td>
			<td class="head1">Name</td>
			<td class="head1">Today's Count</td>
			<td class="head1">Yesterday's Count</td>
			<td class="head1">A Week Count</td>
		</tr>
		<?php
		while($cntr<count($getrow))
        {
			$Id =  $getrow[$cntr]['TMU_ID'];
			$Name =  $getrow[$cntr]['TMU_Name'];
			$Today = date("Y-m-d");
			
	//echo $today = "2007-10-08";
			$explodeToday = explode("-",$Today);
			$yesterday  = mktime(0, 0, 0, date("$explodeToday[1]")  , date("$explodeToday[2]")-1, date("$explodeToday[0]"));
			$yesterdayDate = date("Y-m-d",$yesterday); 
			//echo "<br>".$yesterdayDate;
			
			$daybeforeyesterday  = mktime(0, 0, 0, date("$explodeToday[1]")  , date("$explodeToday[2]")-7, date("$explodeToday[0]"));
		    $weekAgoDate = date("Y-m-d",$daybeforeyesterday); 
		//	echo "<br>".$weekAgoDate;
		?>
		<tr>
			<td class="bodyarial11"><?php echo $i+1;  ?></td>
			<td class="bodyarial11"><?php echo $Name; ?></td>
			<td class="bodyarial11"><?php 
	     	$TodayCountSql = "select * from Telecaller_Mgmt_Entry  where TMU_ID =".$Id." and TME_Date>='".$Today." 00:00:00'";
			
			 list($TodayCountNumRows,$getrow2)=MainselectfuncNew($TodayCountSql,$array = array());
			$cntr2=0;
			
			//$TodayCountResult = ExecQuery($TodayCountSql);
			$TodayCountNumRows = mysql_num_rows($TodayCountResult);
			
			$TodayCountUIDSql = "select * from Telecaller_Mgmt_Entry  where TMU_ID =".$Id." and TME_UniqueID ='' and TME_Date>='".$Today." 00:00:00'";
			 list($TodayCountUIDNumRows,$getrow3)=MainselectfuncNew($TodayCountUIDSql,$array = array());
			$cntr3=0;
			//$TodayCountUIDResult = ExecQuery($TodayCountUIDSql);
			//$TodayCountUIDNumRows = mysql_num_rows($TodayCountUIDResult);
			
			echo $TodayCountNumRows;
			if($TodayCountUIDNumRows>0)
				echo "  <font color='red'>( ".$TodayCountUIDNumRows." )</font>";
			
			 ?></td>
			<td class="bodyarial11"><?php 
			$YesterdayCountSql = "select TME_ID from Telecaller_Mgmt_Entry  where TMU_ID =".$Id." and (TME_Date between '".$yesterdayDate." 00:00:00'  and  '".$yesterdayDate." 23:59:59')";
			
			 list($YesterdayCountNumRows,$getrow3)=MainselectfuncNew($YesterdayCountSql,$array = array());
			$cntr3=0;
			
			//$YesterdayCountResult = ExecQuery($YesterdayCountSql);
			echo $YesterdayCountNumRows = count($getrow3);
			
			$YesterdayCountUIDSql = "select TME_ID from Telecaller_Mgmt_Entry  where TMU_ID =".$Id."  and TME_UniqueID ='' and (TME_Date between '".$yesterdayDate." 00:00:00'  and  '".$yesterdayDate." 23:59:59')";
			//$YesterdayCountUIDResult = ExecQuery($YesterdayCountUIDSql);
			$YesterdayCountNumUIDRows = mysql_num_rows($YesterdayCountUIDResult);
			 list($YesterdayCountNumUIDRows,$getrow4)=MainselectfuncNew($YesterdayCountUIDSql,$array = array());
			$cntr4=0;
				if($YesterdayCountNumUIDRows>0)
				echo "  <font color='red'>( ".$YesterdayCountNumUIDRows." )</font>";
			
			 ?></td>
			 <td class="bodyarial11">
			 <?php 
			$WeekCountSql = "select TME_ID from Telecaller_Mgmt_Entry  where TMU_ID =".$Id." and (TME_Date between '".$weekAgoDate." 00:00:00' and  '".$Today." 23:59:59')";
			//$WeekCountResult = ExecQuery($WeekCountSql);
			list($WeekCountNumRows,$getrow5)=MainselectfuncNew($WeekCountSql,$array = array());
			$cntr5=0;
			
			echo $WeekCountNumRows = count($getrow5); 
			
			$WeekCountUIDSql = "select TME_ID from Telecaller_Mgmt_Entry  where TMU_ID =".$Id." and TME_UniqueID ='' and (TME_Date between '".$weekAgoDate." 00:00:00' and  '".$Today." 23:59:59')";
			//$WeekCountUIDResult = ExecQuery($WeekCountUIDSql);
			list($WeekCountNumRows,$getrow6)=MainselectfuncNew($WeekCountUIDSql,$array = array());
			$cntr6=0;
			
			$WeekCountNumUIDRows = count($getrow6); 
			if($WeekCountNumUIDRows>0)
				echo "  <font color='red'>( ".$WeekCountNumUIDRows." )</font>";
			
			?>
			 </td> 	
		</tr>
		<?php
				$todaytotalSum = $todaytotalSum + $TodayCountNumRows ;
				$todaytotalUID = $todaytotalUID +$TodayCountUIDNumRows;
				
				$yesterdaytotalSum = $yesterdaytotalSum + $YesterdayCountNumRows ;
				$yesterdaytotalUID = $yesterdaytotalUID +$YesterdayCountNumUIDRows;
				
				$weektotalSum = $weektotalSum + $WeekCountNumRows ;
				$weektotalUID = $weektotalUID +$WeekCountNumUIDRows;
				
				
		}
		?>
			<tr>
			<td class="head1" colspan="2">Total</td>
			<td class="head1"><?php echo $todaytotalSum; ?> (<?php echo $todaytotalUID; ?>)</td>
			<td class="head1"><?php echo $yesterdaytotalSum; ?> (<?php echo $yesterdaytotalUID; ?>)</td>
			<td class="head1"><?php echo $weektotalSum; ?> (<?php echo $weektotalUID; ?>)</td>
		</tr>
		<tr>
			<td COLSPAN="4" NOWRAP>
			
			</td>
			<td>&nbsp;</td>
			
		</tr>
		
		</table>
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
