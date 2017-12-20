<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

$uniqueName =$_SESSION['uniqueName'];
if($uniqueName=="team_priya1" || $uniqueName=="team_balbir")
{
	$given_to=1;
}
elseif($uniqueName=="team_rakhi2")
{
	$given_to=2;
}
else
{
	if(isset($_REQUEST['type']))
	{
		$given_to=$_REQUEST['type'];
	}
}
	$FeedbackClause="";
	
	$search="";
	if(isset($_GET['search']))
	{
		$search=$_GET['search'];
	}
	
	$min_date="";
	if(isset($_REQUEST['min_date']))
	{
		$min_date=$_REQUEST['min_date'];
	}
	
	$max_date="";
	if(isset($_REQUEST['max_date']))
	{
		$max_date=$_REQUEST['max_date'];
	}

	$varCmbFeedback="";
	if(isset($_REQUEST['cmbfeedback']))
	{
		$varCmbFeedback=$_REQUEST['cmbfeedback'];
	}

	$RequestID="";
	if(isset($_REQUEST['RequestID']))
	{
		$RequestID=$_REQUEST['RequestID'];
	}
	
	$Feedback="";
	if(isset($_REQUEST['Feedback']))
	{
		$Feedback=$_REQUEST['Feedback'];

}

	//Paging
	$pagesize=25;
	$startrow=0;
	
	//Set the page no

	if(empty($_GET['pageno']))
	{
		if($startrow == 0)
		{
			$pageno = $startrow + 1;
		}
	}
	else
	{
		$pageno = $_GET['pageno'];
		$startrow = ($pageno - 1) * $pagesize;
	}
	
	//Set the counter start
	if($pageno/$pagesize == 0)
	{
		$counterstart = $pageno - ($pagesize - 1);
	}
	else
	{
		$counterstart = $pageno - ($pageno % $pagesize) + 1;
	}
	//Counter End
	$counterend = $counterstart + ($pagesize - 1);
	///
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="lms/css-datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="lms/css-datepicker/datepicker.css">
		<script src="lms/js-datepicker/jquery-1.5.1.js"></script>
		<script src="lms/js-datepicker/jquery.ui.core.js"></script>
		<script src="lms/js-datepicker/jquery.ui.datepicker.js"></script>
		<script> 
			$(function() {
				var dates = $( "#min_date, #max_date" ).datepicker({
					defaultDate: "+1w",
					changeMonth: true,
					changeYear: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						var option = this.id == "min_date" ? "minDate" : "maxDate",
							instance = $( this ).data( "datepicker" ),
							date = $.datepicker.parseDate(
								instance.settings.dateFormat ||
								$.datepicker._defaults.dateFormat,
								selectedDate, instance.settings );
						dates.not( this ).datepicker( "option", option, date );
					}
				});
			});
//ebable disable button
function disableIt(obj)
{
	obj.disabled = !(obj.disabled);
	var z = (obj.disabled) ? 'disabled' : 'enabled';
	//alert(obj.type + ' now ' + z);
}
// enable disable finish here		
//-->
function sendmail(form)
{
	var gifName = form;
	document.frmsearch.action="ebbusiness_leadview.php?search=y"+gifName;
	document.frmsearch.submit();
}
function chkform()
{
	var ss=document.frmsearch.min_date.value;
	
	if(ss.length<10 || ss.length>10)
	{
		alert("Please fill correct date in YYYY-MM-DD format");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
		if(document.frmsearch.min_date.value<"2014-08-01")
	{
		alert("Sorry!!!! Your minimum date is 2014-08-01.Please Select.");
		document.frmsearch.min_date.value="";
		document.frmsearch.min_date.focus();
		return false;
	}
	
	if(document.frmsearch.max_date.value=="")
	{
		alert("Sorry!!!! Please Enter Maximum date.");
		document.frmsearch.max_date.value="";
		document.frmsearch.max_date.focus();
		return false;
	}
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}

function submitform()
{
 document.bidder_array.submit();
}   
</script>
     </head><body >
<?php include '~Top12.php';?>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
   <div id="dvMaincontent">
 <br>
 <br>
  <table width="712" border="0">
 
 <tr><td align="center" width="100%">
 <div align="center">
 <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <form name="frmsearch" action="ebbusiness_leadview.php?search=y" method="post" onSubmit="return chkform();">
 <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"];?>">
   <tr>
     <td colspan="2" class="head1">Search</td>
     </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>   
   <tr>
     <td width="20%"><strong>Date:</strong></td>
     <td width="80%">From 
	   <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="") { ?>value="2011-01-01"<? } else { ?>value="<? echo $min_date; ?>" <? }?>>		
       <!--<input name="b12" id="b12" type="button" class="bluebutton" value="&lt; Insert">  -->   
         &nbsp;&nbsp;&nbsp;To <span class="bodyarial11">
         <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>">
         <!--<input name="b122" id="b122" type="button" class="bluebutton" value="&lt; Insert">-->
        </span></td>
   </tr>
     <tr>
     <td width="20%"><strong>Feedback:</strong></td>
     <td width="80%">
	<select name="cmbfeedback" id="cmbfeedback">
		<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
		<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
		<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="Not Eligible" <?if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Ringing" <?if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Contactable" <?if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Duplicate" <?if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Send Now" <? if($varCmbFeedback == "Send Now") { echo "selected"; } ?>>Send Now</option>
		<option value="Not Applied" <? if($varCmbFeedback == "Not Applied") { echo "selected"; } ?>>Not Applied</option>
		<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
	</select>
	 </td>
   </tr>
  
   <tr>
     <td colspan="2" align="center"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
     </tr>
   </form>
 </table>
 <p>&nbsp;</p>
	<?
	$search_date="";
	$varmin_date=$min_date;
	$varmax_date=$max_date;

	if(strlen(trim($RequestID))>0)
	{
		$strSQL="";
		$Msg="";

		$result = ExecQuery("select custfbvdid from Req_EBBusiness_Leads where (custfbvdid='".$RequestID."')");		
		$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			$row = mysql_fetch_array($result);
			$strSQL="Update Req_EBBusiness_Leads Set eb_feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where custfbvdid=".$row["custfbvdid"];
		}
		
//		echo $strSQL;
		$result = ExecQuery($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}

	if($search=="y")
	{
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
		
		if(strlen(trim($varCmbFeedback))==0)
		{
			$FeedbackClause=" AND (Req_EBBusiness_Leads.eb_feedback IS NULL OR Req_EBBusiness_Leads.eb_feedback='') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND Req_EBBusiness_Leads.eb_feedback='".$varCmbFeedback."' ";
		}

	?>
 <p class="bodyarial11"><?=$Msg?></p>
 <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder">
 <? 
if($_SESSION['BidderID']==99)
	{
		$qry="Select * from  Req_EBBusiness_Leads Where ((eb_dated between '".$min_date."' and '".$max_date."') or ( followup_date between '".$min_date."' and '".$max_date."')) ";
		$qry=$qry.$FeedbackClause;
}		
		else
		{
		echo "not authoried to view the details";
		}

	//echo"hello".$qry."<br>";
		$changedresult=ExecQuery($qry);
		$recordcount = mysql_num_rows($changedresult);
		for($i=0;$i<$recordcount;$i++)
		{
		$lead = mysql_result($changedresult,$i,'RequestID');
		$leadsid[] =$lead;
		}
 ?>
   <tr>
     <td colspan="11"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong></td>
     </tr>
   <tr>
   <td class="head1">Name</td>
	<td class="head1">Mobile</td>
	<td class="head1">Salary</td>
	<td class="head1">City</td>
	<td class="head1">Eligible Bidders</td>
     <td class="head1">Feedback</td><?
	if((($varFeedback=="FollowUp")|| ($varFeedback=="Callback Later")) || ($varCmbFeedback == "FollowUp")) { ?> <td class="head1">FollowUp date</td><? } ?>
	
	</tr>
	<?
		//Set Maximum Page start
		$maxpage = $recordcount % $pagesize;
		if($recordcount % $pagesize == 0)
		{
			$maxpage = $recordcount / $pagesize;
		}
		else
		{
			$maxpage = ceil($recordcount / $pagesize);
		}
	
if($_SESSION['BidderID']==99)
{
	 $qry="Select * from  Req_EBBusiness_Leads Where ((eb_dated between '".$min_date."' and '".$max_date."') or ( followup_date between '".$min_date."' and '".$max_date."'))";
		$qry=$qry.$FeedbackClause;
		$qry=$qry." order by eb_dated DESC";
		$qry=$qry." LIMIT $startrow, $pagesize";
}
		else
		{
			echo "not authoried to view the details";
		}

		$result=ExecQuery($qry);

		$i=1;
		if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
			$Followup_Date = $row['Followup_Date'];				
			$exptodayformat = explode(" ",$Followup_Date);
			$explodeTime = explode(":",$exptodayformat[1]);
			$explodeHr = $explodeTime[0] - 1; 
			$FinalMinDate = '"'.$exptodayformat[0].' '.$explodeHr.':'.$explodeTime[1].':'.$explodeTime[2].'"';
			$FinalMaxDate ='"'.$exptodayformat[0].' 23:59:59"';
			$TodayFormat = date("Y-m-d");
			$FinalDay = $exptodayformat[0];
	?>
<tr>
<td class="bodyarial11"><a href="ebbusiness_leadetails.php?id=<? echo urlencode($row['ebleadid']); ?>" target="_blank"><? echo $row["eb_name"]; ?></a></td>
<td class="bodyarial11"><img src="gButt.php?text=<? echo $row["eb_mobile_number"]; ?>" /></td>
<td class="bodyarial11"><? echo $row["eb_net_salary"]; ?></td>
<td class="bodyarial11"><? echo $row["eb_city"]; ?></td>
<td class="bodyarial11">
<b>	 <? echo getJumpMenu("ebbusiness_leadview.php",$row["ebleadid"],$given_to,$row["eb_feedback"],$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val) ?>
     </td>
	
<td><input name="followup_date_<? echo $i;?>" type="text" id="followup_date_<? echo $i;?>" size="10" value="<? echo $row["followup_date"];?>"></td>
</tr>
  <!------------///////////////////////////------------->
	<?
			$i=$i+1;
		}
		
		}
	?>
 </table>
 <br>
 <table width="758"  border="0" cellpadding="5" cellspacing="1">
	<? 
	if($recordcount>0)
	{
	?>
   <tr>
     <td align="center" class="bluelink">
	 <? 
		$c=1;
		for($c=1;$c<=$maxpage;$c++)
		{	
			if( $pageno==$c)
			{
				
				echo $c."&nbsp;";
			}
			else
			{
			?>
				<a onClick="javascript:sendmail('<? echo "&id=".$i."&pageno=".$c; ?>')" style="cursor:hand"><? echo $c; ?></a>
			<?
			}
		
		} 
		?>		</td>
   </tr>
   <? 
   } 
   ?>
 </table>
 <? if($_SESSION['uniqueName']=="team_balbir")
		{ ?>
		
 <form name="frmdownload" action="downloadcustomerfedbk.php" method="post">
<table width="500" border="0" cellspacing="1" cellpadding="4">
   <tr>
     <td align="center">
	   <input type="hidden" name="qry1" value="<? echo $qry; ?>">
	   <input type="hidden" name="qry2" value="<? echo $val; ?>">	 
	    <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	   <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
	 </td>
   </tr>
 </table> 
 </form>
   <?
 }
	}
 ?>
    </div>
 </td></tr></table>
  </div>
   </div>
<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=".$varVal;
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Other Product'?>" <? if($varFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="<? echo $strURL.'&Feedback=Not Contactable'?>" <? if($varFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="<? echo $strURL.'&Feedback=Send Now'?>" <? if($varFeedback == "Send Now") { echo "selected"; } ?> >Send Now</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; } ?> >Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?> >Ringing</option>
		<option value="<? echo $strURL.'&Feedback=Duplicate'?>" <? if($varFeedback == "Duplicate") { echo "selected"; } ?> >Duplicate</option>
		<option value="<? echo $strURL.'&Feedback=Not Applied'?>" <? if($varFeedback == "Not Applied") { echo "selected"; } ?> >Not Applied</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>		
	</select>	
<?
}
?>
</form>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
