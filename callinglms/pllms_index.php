<?php
require_once("includes/application-top-inner.php");
define("NoOFLMS", 7);
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;
//print_r($_SESSION);
//echo "<br>".$_SESSION["BidderID"];
$BidderIDstatic="";
	if(isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic'])>0 )
	{
		 $BidderIDstatic=$_REQUEST['BidderIDstatic'];
	}
	
	if(isset($BidderIDstatic) && strlen($_REQUEST['BidderIDstatic'])>0)
	{
$_SESSION["BidderID"] = $BidderIDstatic;
	}

	
$salaryclause="";
if(isset($_REQUEST['salaryrange']))
{
		$salaryclause=$_REQUEST['salaryrange'];

}
   
  $val = "Req_Loan_Personal";
  
	$FeedbackClause="";
	//$OrderBy=" order by Req_Loan_Personal.Dated desc";

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

		function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}
		</script>
		<!--DatePicker End-->
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel --><div style="width:100%; background:#036; padding:0px 0px 2px 0px;">
<img src="http://www.deal4loans.com/homeimages/dea4lonasnew-logo.png" width="158" height="62"  >
<div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:25px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
              <tr>
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="pllms_index.php" method="get" onSubmit="return chkform();">
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
                      <option value="Not Eligible" <?if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
                      <option value="Ringing" <?if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
                      <option value="Not Contactable" <?if($varCmbFeedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
                      <option value="Duplicate" <?if($varCmbFeedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
                      <option value="Send Now" <? if($varCmbFeedback == "Send Now") { echo "selected"; } ?>>Send Now</option>
                      <option value="Not Applied" <? if($varCmbFeedback == "Not Applied") { echo "selected"; } ?>>Not Applied</option>
                      <option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
                    </select></td>
                  <td width="13%"><strong>Net Salary</strong></td>
                  <td width="46%"><select name="salaryrange" id="salaryrange">
                      <option value="-1" <?if($salaryclause=="-1") echo "selected"; ?>>Please select</option>
                      <option value="1" <?if($salaryclause=="1") echo "selected"; ?>>0- 2.4 lacs</option>
                      <option value="2" <?if($salaryclause=="2") echo "selected"; ?>>2.4 lacs - 3.6 lacs</option>
                      <option value="3" <?if($salaryclause=="3") echo "selected"; ?>>3.6 lacs & above</option>
                    </select></td>
                </tr>
                <tr> </tr>
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
		
		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";

		if(strlen(trim($varCmbFeedback))==0)
		{
			$FeedbackClause=" AND (Req_Feedback_PL.Feedback IS NULL OR Req_Feedback_PL.Feedback='') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND Req_Feedback_PL.Feedback='".$varCmbFeedback."' ";
		}
			
	?>
            <p class="bodyarial11">
              <?=$Msg?>
            </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? 
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
		
		if($_SESSION['BidderID']!="")
		{
			if($_SESSION['BidderID']==846){	$pllms =0;	} 
			elseif($_SESSION['BidderID']==847) {$pllms =1;}
			elseif($_SESSION['BidderID']==854) {$pllms =2;} 
			elseif($_SESSION['BidderID']==9) {$pllms =3;} 
			elseif($_SESSION['BidderID']==10) {$pllms =4;} 
			elseif($_SESSION['BidderID']==63) {$pllms =5;} 
			elseif($_SESSION['BidderID']==67) {$pllms =6;} 
			elseif($_SESSION['BidderID']==68) {$pllms =7;}
		
		$qry="SELECT * from ".TABLE_REQ_LOAN_PERSONAL." LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_PL.BidderID='".$_SESSION['BidderID']."'  WHERE (((MOD(Req_Loan_Personal.RequestID,".NoOFLMS.")=".$pllms." and ".TABLE_REQ_LOAN_PERSONAL.".Direct_Allocation=0))
and ((".TABLE_REQ_LOAN_PERSONAL.".Updated_Date Between '".$min_date."' and '".$max_date."' ) or
((Req_Feedback_PL.Followup_Date Between '".$min_date."' and '".$max_date."' ) and Req_Feedback_PL.BidderID='".$_SESSION['BidderID']."')) and (".TABLE_REQ_LOAN_PERSONAL.".source!='hdfc_plmlr' and ".TABLE_REQ_LOAN_PERSONAL.".source!='PlUploadibibo' and ".TABLE_REQ_LOAN_PERSONAL.".source!='postpaid-mailer' and ".TABLE_REQ_LOAN_PERSONAL.".ex_source!='below60k' and ".TABLE_REQ_LOAN_PERSONAL.".source!='HDFC Bank PL NEW' and ".TABLE_REQ_LOAN_PERSONAL.".source!='HDFC Bank PL' and ".TABLE_REQ_LOAN_PERSONAL.".source!='incoming_call' and ".TABLE_REQ_LOAN_PERSONAL.".source!='fullertonmlr' and ".TABLE_REQ_LOAN_PERSONAL.".source!='bajajfinserv_testing' and ".TABLE_REQ_LOAN_PERSONAL.".source!='Businessloan RBl test' and ".TABLE_REQ_LOAN_PERSONAL.".source!='mywishbankPL' and ".TABLE_REQ_LOAN_PERSONAL.".source!='mywishbankchat') and ".TABLE_REQ_LOAN_PERSONAL.".Allocated=0 ".$salaryfilter." )";
		$qry=$qry.$FeedbackClause;
			
		}
		

$resCount = $objAdmin->fun_get_num_rows($qry);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}

$qry.= " order by Updated_Date DESC LIMIT $start,$limit ";
//echo $qry;
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
                <!--<td class="head1">stat</td>-->
                <td class="head1">Eligible Bidders</td>
                <td class="head1">Feedback</td>
                <?
	if((($varFeedback=="FollowUp")|| ($varFeedback=="Callback Later")) || ($varCmbFeedback == "FollowUp")) { ?>
                <td class="head1">FollowUp date</td>
                <? } ?>
                <td class="head1">Feedback Date</td>
                <td class="head1">View history</td>
                <!--  <td class="head1">Feedbackfrom Other LMS</td>--> 
              </tr>
              <?			
		if($resCount>0)
			{
				$color = 1;		
		while($row = $obj->fun_db_fetch_rs_object($result))
		{
			$Followup_Date = $row->Followup_Date;				
			$exptodayformat = explode(" ",$Followup_Date);
			$explodeTime = explode(":",$exptodayformat[1]);
			$explodeHr = $explodeTime[0] - 1; 
			$FinalMinDate = '"'.$exptodayformat[0].' '.$explodeHr.':'.$explodeTime[1].':'.$explodeTime[2].'"';
			$FinalMaxDate ='"'.$exptodayformat[0].' 23:59:59"';
			$TodayFormat = date("Y-m-d");
			$FinalDay = $exptodayformat[0];		
			
			if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
				else{
						$colorvar = "#EEE";
					}
	?>
              <!--///////////////////////-->
              <tr  bgcolor="<?php echo $colorvar;?>">
                <td class="bodyarial11"><a href="pleditlead.php?id=<? echo urlencode($row->RequestID); ?>&Bid=<? echo $_SESSION['BidderID'];?>&to=<? echo $min_date;?>&from=<? echo $max_date;?>" target="_blank"><? echo $row->Name; ?></a></td>
                <td class="bodyarial11"><img src="gButt.php?text=<? echo $row->Mobile_Number; ?>" /></td>
                <td class="bodyarial11"><? echo $row->Net_Salary; ?></td>
                <td class="bodyarial11"><? echo $row->City; ?></td>
                <?
	    if($row->City=="Others")
        {
            $City= $row->City_Other;
        }
        else
        {
            $City= $row->City;
        }
	   ?>
                <td><?
				
			 list($FinalBidder,$finalBidderName)= $objeligiblebidderfuncPL->getBiddersList("Req_Loan_Personal",$row->RequestID,$City,$row->Referral_Flag,$row->source);
   for($i=0;$i<count($FinalBidder);$i++)
			{
		echo $finalBidderName[$i].",";
			}
		?></td>
		<td class="bodyarial11">
               <b>	<?php
	$getFedbackQuery =$obj->fun_db_query("select FeedbackID, Feedback from Req_Feedback_PL where AllRequestID='".$row->RequestID."' and BidderID='3621' AND Reply_Type=1");
	$num_rows = $obj->fun_db_get_num_rows($getFedbackQuery);
		if($num_rows > 0)
		{
			$Feedback3621 = $obj->fun_get_mysql_result($getFedbackQuery,0,'Feedback');
			$originalFeedback = $Feedback_c;
	echo "<br>";
			$followup_date3621 = $obj->fun_get_mysql_result($getFedbackQuery,0,'Followup_Date');
		}
	?></b>
    <? echo getJumpMenu("pllms_index.php",$row->RequestID,"1",$row->Feedback,$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val) ?>
     </td>
       <?php if(($Followup_Date>$FinalMinDate || $Followup_Date<$FinalMaxDate) && ($Followup_Date !='0000-00-00 00:00:00') &&  ($TodayFormat==$FinalDay) )  { if($row->updated_flag==1)
		{ ?> 
       <td bgcolor="#33CCCC"> <? } else
		{?><td bgcolor="#FF0000"> <?php } } else { ?>	
	 <td class="bodyarial11">
	 <?php } ?>
     <?php  echo $followup_date3621; ?>
	 <form action="agents_followup.php" name="FollowupForm" method="post" onSubmit="return followup_form();">
	 <input type="Text"  name="FollowupDate-<?php echo $row->RequestID; ?>" maxlength="25" size="15" <?php if($Followup_Date !='0000-00-00 00:00:00') { ?>value="<?php  echo $Followup_Date; ?>" <?php } ?>>
	 <a href="javascript:NewCal('FollowupDate-<?php echo $row->RequestID; ?>','yyyymmdd',true,24)">
	 <img src="../images/cal.gif" width="16" height="16" border="0" alt="Pick a date">
	 </a>
	 <input type="hidden" name="aid-<?php echo $row->RequestID; ?>" value="<?php  echo $row->RequestID; ?>">
	 <input type="hidden" name="a_count" value="<?php  echo $recordcount; ?>">
	 <input type="hidden" name="varmin_date" value="<?php  echo $varmin_date; ?>">
	 <input type="hidden" name="varmax_date" value="<?php  echo $varmax_date; ?>">
	 <input type="submit" name="submit" value="  "></form></td> 
                <td><a HREF="javascript:void(0)"
onclick="window.open('http://www.deal4loans.com/get_complete_details.php?mob=<? echo urlencode($row->Mobile_Number); ?>&pt=Req_Loan_Personal')" >View</a></td>
              </tr>
              <!------------///////////////////////////------------->
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
 ?>
            <br>
            <br>
            <br>
            <br>
          </div></td>
      </tr>
            </table>

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
