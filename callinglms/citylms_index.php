<?php
require_once("includes/application-top-inner.php");
//require_once("includes/application-top-inner.php");
//require '../eligiblebidderfuncPL.php';
$qryCheck = "SELECT * FROM Bidders where leadidentifier in ('CallerAccountCity') and BidderID='".$_SESSION["BidderID"]."'";
$resCountCheck = $objAdmin->fun_get_num_rows($qryCheck);
$qryCheckResult = $obj->fun_db_query($qryCheck);
if($resCountCheck>0)
{
	$rowqryCheck = $obj->fun_db_fetch_rs_object($qryCheckResult);
 	$source = $rowqryCheck->source;
	//echo "<br>";
	$standard_fields = $rowqryCheck->standard_fields;
}
else {
		echo "Not a Valid User";
		echo '<meta http-equiv="refresh" content="5; URL=http://www.deal4loans.com/callinglms/lmslogin.php">';
		die(); 
	 }
define("NoOFLMS", 2);
$time = date("G");
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;

function cleanSpace($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
}

function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

$BidderIDstatic=$_SESSION["BidderID"];

$salaryclause="";
if(isset($_REQUEST['salaryrange']))
{
		$salaryclause=$_REQUEST['salaryrange'];

}
   
  $val = "Req_Loan_Personal";
  
	$FeedbackClause="";
	//$OrderBy=" order by Req_Loan_Personal.Dated desc";
	$mob_num="";
	if(isset($_REQUEST['mob_num']))
	{
		$mob_num = $_REQUEST['mob_num'];
	}
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
	
	$cc_type="";
	if(isset($_REQUEST['cc_type']))
	{
		$cc_type=$_REQUEST['cc_type'];
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
	$type="";
	if(isset($_REQUEST['type']))
	{
		$type=$_REQUEST['type'];
	}
	$Feedback="";
	if(isset($_REQUEST['Feedback']))
	{
		$Feedback=$_REQUEST['Feedback'];
	}	

?>
<html>
		<head>
  		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
		<title>Login</title>
		<script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
		<link href="../includes/style1.css" rel="stylesheet" type="text/css">
		<link href="../style.css" rel="stylesheet" type="text/css" />
		<script language="javascript" type="text/javascript" src="../scripts/datetime.js"></script>
		<style>
/* Pagination*/
div.pagination {
	padding: 3px;
	margin: 3px;
}
div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #AAAADD;
	text-decoration: none; /* no underline */
	color: #000099;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;
	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #000099;
	font-weight: bold;
	background-color: #2b62b5;
	color: #FFF;
}
div.pagination span.disabled {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #CCC;
	color: #CCC;
}
</style>
		<!--DatePicker Start-->
		<link rel="stylesheet" type="text/css" href="css-datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css-datepicker/datepicker.css">
		<script src="js-datepicker/jquery-1.5.1.js"></script>
		<script src="js-datepicker/jquery.ui.core.js"></script>
		<script src="js-datepicker/jquery.ui.datepicker.js"></script>
		<script> 
			$(function() {
				var dates = $( "#min_date, #max_date" ).datepicker({
					defaultDate: "today",
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

		function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}
		</script>
		<!--DatePicker End-->
       <!-- <script type="text/javascript" src="/js/jquery.js"></script>-->
<script type="text/javascript">
	  function checkCall(RequestID,agent_user)
    {	
		var funcVal = 'call';
	   $.ajax({ type: 'post',  url: '/external_dialer_c2c_city.php',  data: {  RequestID:RequestID,agent_user:agent_user, functionC:funcVal },
			   success: function (response) {
			   //alert(response);
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	  
	}
	
	function disconnectCall(RequestID,agent_user)
    {	
		var checkCallValue;
		var funcVal = 'disconnect';
		var dispID = $( "#disConnectStatus" ).val();
	   $.ajax({ type: 'post',  url: '/external_dialer_c2c_city.php',  data: {  RequestID:RequestID,agent_user:agent_user, functionC:funcVal, disPos:dispID },
			   success: function (response) {
			   //alert(response);
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	}
	</script>
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
	  <tr><td align="right"><a href="/commonlms_report.php?bidderid=<?php echo $_SESSION['BidderID'];?>&product=1" target="_blank">today's Report</a></td></tr>
              <tr>
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="citylms_index.php" method="get" onSubmit="return chkform();">
                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"];?>">
                <input type="hidden" name="search" id="search" value="y">
                <tr>
                  <td colspan="4" class="head1">Search</td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="12%"><strong>Date:</strong></td>
                  <td width="29%">From
                    <input name="min_date" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>" ></td>
                  <td width="13%" style="text-align:right;">To</td>
                  <td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
                </tr>
                <tr>
                  <td width="12%"><strong>Feedback:</strong></td>
                  <td width="29%"><select name="cmbfeedback" id="cmbfeedback">
                	<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
		<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="Other Product" <? if($varCmbFeedback == "Other Product") { echo "selected"; } ?>>Other Product</option>
		<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; } ?>>Not Interested</option>
		<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; } ?>>Wrong Number</option>
		<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Duplicate" <? if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Not Applied" <? if($varCmbFeedback == "Not Applied") { echo "selected"; } ?>>Not Applied</option>
		<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
              <option value="Send Now" <? if($varCmbFeedback == "Send Now") { echo "selected"; } ?>>Send Now</option>
                    </select></td>
      <td width="29%" align="center"  valign="middle" class="bidderclass">&nbsp;</td>
	  <td width="58%"  valign="middle" class="bidderclass">&nbsp;
</td>
                </tr>
                 <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
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
		$fbqry="select FeedbackID from Req_Feedback_PL where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']." AND Reply_Type=1";
		$result = $obj->fun_db_query($fbqry);	
				
		$num_rows = $obj->fun_db_get_num_rows($result);
		if($num_rows > 0)
		{
			$row = $obj->fun_db_fetch_rs_array($result);
			$strSQL="Update Req_Feedback_PL Set Feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",'1','".$Feedback."')";
		}

//echo $strSQL;
		$result = $obj->fun_db_query($strSQL);
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
		$min_dateonly=$min_date;
		$max_dateonly=$max_date;

		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";

		if(strlen(trim($varCmbFeedback))==0)
		{
			$FeedbackClause=" AND (Req_Feedback_PL.Feedback IS NULL OR Req_Feedback_PL.Feedback='' OR Req_Feedback_PL.Feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND Req_Feedback_PL.Feedback='".$varCmbFeedback."' ";
		}	
		
		if($salaryclause=="1")
		{
			$salaryfilter="AND (Net_Salary>='0' and Net_Salary<'240000')";
		}
		elseif($salaryclause=="2")
		{
			$salaryfilter="AND (Net_Salary>='240000' and Net_Salary<'360000')";	
		}
		elseif($salaryclause=="3")
		{
			$salaryfilter="AND (Net_Salary>='360000')";
		}
		else
		{
			$salaryfilter="";
		}	
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
             <p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? $srh_qry=""; 
	//		  echo "BidderIDstatic - ".$BidderIDstatic;
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_LOAN_PERSONAL.".Mobile_Number = '".$mob_num."' ";
		}
		if($BidderIDstatic!="")
		{
			//echo "hello";
			$feedback_tble="lead_allocate";
	//		$qry=$qry.$FeedbackClause." ".$mob_num_clause ." ".$salaryfilter." group by ".TABLE_REQ_LOAN_PERSONAL.".Mobile_Number " ;
		
			$qry="SELECT * FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID AND Req_Feedback_PL.BidderID= '".$BidderIDstatic."' WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID = '".$BidderIDstatic."' and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_PL.Followup_Date Between '".($min_date)."' and '".($max_date)."') ";
		$qry=$qry.$FeedbackClause." ".$mob_num_clause." group by ".TABLE_REQ_LOAN_PERSONAL.".Mobile_Number ";
		}		
	$srh_qry = $qry;

//echo $qry;
$resCount = $objAdmin->fun_get_num_rows($qry);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}

$qry.= " order by ".$feedback_tble.".Allocation_Date DESC LIMIT $start,$limit ";
//echo $qry;
//echo "<br>".$resCount;
$result = $obj->fun_db_query($qry);
 ?>
              <tr>
                <td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
              </tr>
              <tr>
                <td class="head1">Name</td>
                <td class="head1">Mobile</td>
                <td class="head1">Salary</td>
                <td class="head1">City</td>
             <!--   <td class="head1">Eligible Bidders</td>-->
                <td class="head1">Feedback</td>                
                <td class="head1">FollowUp date</td>               
            
                <td class="head1">Call</td>
              </tr>
              <?			
	if($resCount>0)
			{
				$color = 1;		
				
		while($row = $obj->fun_db_fetch_rs_object($result))
		{
			//print_r($obj->fun_db_fetch_rs_object($result));
			$Followup_Date = $row->Followup_Date;				
			$exptodayformat = explode(" ",$Followup_Date);
			$explodeTime = explode(":",$exptodayformat[1]);
			$explodeHr = $explodeTime[0] - 1; 
			$FinalMinDate = '"'.$exptodayformat[0].' '.$explodeHr.':'.$explodeTime[1].':'.$explodeTime[2].'"';
			$FinalMaxDate ='"'.$exptodayformat[0].' 23:59:59"';
			$TodayFormat = date("Y-m-d");
			$FinalDay = $exptodayformat[0];		
			$Employment_Status=$row->Employment_Status;
			
			if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
				else{
						$colorvar = "#EEE";
					}
	?>
                 <tr  bgcolor="<?php echo $colorvar;?>">			 
                <td class="bodyarial11">
                <a href="/editlead_city.php?id=<? echo urlencode($row->RequestID); ?>&Bid=<? echo $BidderIDstatic;?>&to=<? echo $min_date;?>&from=<? echo $max_date;?>" target="_blank"><? echo $row->Name; ?></a></td>
                <td class="bodyarial11"><?php echo ccMasking($row->Mobile_Number); ?></td>
                <td class="bodyarial11"><? echo $row->Net_Salary; ?></td>
                <td class="bodyarial11"><? echo $row->City; ?></td>
		<!--		<td class="bodyarial11"><?php 
				list($FinalBidder,$finalBidderName) = $objeligiblebidderfuncPL->getBiddersList("Req_Loan_Personal",$row->RequestID,$row->City,$row->Referral_Flag,$row->source);

   for($i=0;$i<count($FinalBidder);$i++)
			{
		
	//	echo $finalBidderName[$i].","; // 2140293
			}
		?></td>-->
       
		<td class="bodyarial11">
                 <? echo getJumpMenu("citylms_index.php",$row->RequestID,"1",$row->Feedback,$page,$varmin_date,$varmax_date,$varCmbFeedback, $val) ?>
      
     </td>
         <td class="bodyarial11"><input type="text" name="Followup_Date" id="Followup_Date" value="<? echo $Followup_Date; ?>"></td>
  
  <td class="bodyarial11">
           <input type="button" name="chkCall" value="Call" onClick="checkCall(<?php echo $row->RequestID ?>,<?php echo $_SESSION['BidderID'] ?>)" />        </td>
	               </tr>
                <?
		$color++;
		}		
		}
	?>
           </table>
            <br>
            <table  border="0" cellpadding="5" cellspacing="1" align="center">
              <tr>
                <td style="color:#FFF;" align="center" bgcolor="#FFFFFF"><?php echo $pagelinks;?></td>
              </tr>
            </table>
            <?
 }
 ?>            </div></td>
      </tr>

            </table>
        </div>
		<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
//www.deal4loans.com/callinglms/citylms_index.php?search=y&RequestID=2115107&type=1&pageno=&min_date=2016-05-01&max_date=2016-06-01&cmbfeedback=All&product=Req_Loan_Personal&Feedback=Not%20Applied 
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