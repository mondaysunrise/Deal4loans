<?php
require_once("includes/application-top-inner.php");
define("NoOFLMS", 2);
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;
//print_r($_SESSION);
//echo "<br>".$_SESSION["BidderID"];
function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}
$BidderIDstatic="";
	if(isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic'])>0 )
	{
		 $BidderIDstatic=$_REQUEST['BidderIDstatic'];
	}
	
	if(isset($BidderIDstatic) && strlen($_REQUEST['BidderIDstatic'])>0)
	{
$_SESSION["BidderID"] = $BidderIDstatic;
	}

$dwlndtomorrow  = mktime(0, 0, 0, date("m")  , date("d")-60, date("Y"));
	 $daydwlnd=date('Y-m-d',$dwlndtomorrow);

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
		
	
$feedback_tble="client_lead_allocate";
$qryCity="SELECT * FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID AND Req_Feedback_PL.BidderID= '".$_SESSION['BidderID']."' WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID = '".$_SESSION['BidderID']."' and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."' or Req_Feedback_PL.Followup_Date Between '".($min_date)."' and '".($max_date)."')   group by ".TABLE_REQ_LOAN_PERSONAL.".City";     
$resCountCity = $objAdmin->fun_get_num_rows($qryCity);   
$resultCity = $obj->fun_db_query($qryCity);

$DisplayNumber="";
if( $_SESSION['BidderID']==7493)
        {
            $DisplayNumber = 1; // Displaying Numbers
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
        <script type="text/javascript">

    function checkCall(RequestID,agent_user)
    {	
	   $.ajax({ type: 'post',  url: '/dialerclick2callplbajaj.php',  data: {  RequestID:RequestID,agent_user:agent_user, },
			   success: function (response) {
			   //alert(response);
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	  
	}
	
		var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

			
		function getNumValue(iLoc,id, parameterVal)
		{
			//alert(iLoc);
			var allLoc = [];
			if(parameterVal>0 )
			{
				for(var iTrav=1; iTrav <= parameterVal; iTrav++) { allLoc.push(iTrav); }
			}
			else
			{
				for(var iTrav=1; iTrav <= <?php echo $limit; ?>; iTrav++) { allLoc.push(iTrav); }
			}
			var iRemove = allLoc.indexOf(iLoc);
			if(iRemove != -1) { allLoc.splice(iRemove, 1); }
			
		//	alert(allLoc);
			
			var queryString = "?get_requestid=" + id;
			ajaxRequest.open("GET", "/getfullertonNum.php" + queryString, true);
			ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4)
				{
					document.getElementById('clik4Num_'+ iLoc).innerHTML = "<b style='font-size:12px;'>"+ajaxRequest.responseText+"</b>";
						for(var iTraverse = allLoc.length; iTraverse--;)
						{ document.getElementById('clik4Num_'+ allLoc[iTraverse]).innerHTML = 'XXXXXXXXXX';	}
				}
			}
				ajaxRequest.send(null); 
		}
		window.onload = ajaxFunction;
	</script>

		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
                    <!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="font-size:30px; float: left; width: 60%;">Fullerton Calling LMS</div><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
	  <!--<tr><td align="right"><a href="/commonlms_report.php?bidderid=<?php echo $_SESSION['BidderID'];?>&product=4" target="_blank">today's Report</a></td></tr>
       <tr><td align="right"><a href="/bidders_update_feedback_ref.php">Upload Feedback</a></td></tr>
              <tr>
        <td align="right"></td>
      </tr>-->
              <tr>
        <td align="center" width="100%"><div align="center">
            <form name="frmsearch" action="fullertonlms_index.php" method="get" onSubmit="return chkform();">
                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"];?>">
                <input type="hidden" name="search" id="search" value="y">
                <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              
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
                    <input name="min_date" type="text" id="min_date" <? if($min_date=="" || $min_date<$daydwlnd) { ?>value="<? echo $daydwlnd; ?>"<? } else { ?>value="<? echo $min_date; ?>" <? } ?> ></td>
                  <td width="13%" style="text-align:right;">To</td>
                  <td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
                </tr>
                <tr>
                  <td width="12%"><strong>Feedback:</strong></td>
                  <td width="29%"><select name="cmbfeedback" id="cmbfeedback">
                      <option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
					  <option value="" <? if($varCmbFeedback == "") { echo "selected"; }?>>No Feedback</option>
					<option value="Process" <? if($varCmbFeedback == "Process") { echo "selected"; }?>>Process</option>
					<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
					<option value="Not Interested" <? if($varCmbFeedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
					<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
					<option value="Wrong Number" <? if($varCmbFeedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
					<option value="Closed" <? if($varCmbFeedback == "Closed") { echo "selected"; }?>>Closed</option>
				<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; }?> >FollowUp</option>
				<option value="Not Available" <? if($varCmbFeedback == "Not Available") { echo "selected"; }?> >Not Available</option>
					<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; }?> >Ringing</option>
					<option value="Documents Pick" <? if($varCmbFeedback == "Documents Pick") { echo "selected"; }?> >Documents Pick</option>
					<option value="Loan Rejected" <? if($varCmbFeedback == "Loan Rejected") { echo "selected"; }?> >Loan Rejected</option>
                                        
                                        
                                        <option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; }?> >Appointment</option>
                                        <option value="Not interested for ROI" <? if($varCmbFeedback == "Not interested for ROI") { echo "selected"; }?> >Not interested for ROI</option>
                                        <option value="Not interested for LoanAmt" <? if($varCmbFeedback == "Not interested for LoanAmt") { echo "selected"; }?> >Not interested for LoanAmt</option>
                                        
                                        <option value="CRM Done - Green" <? if($varCmbFeedback == "CRM Done - Green") { echo "selected"; }?> >CRM Done - Green</option>
                                        <option value="CRM Done - Amber" <? if($varCmbFeedback == "CRM Done - Amber") { echo "selected"; }?> >CRM Done - Amber</option>
                                        <option value="CRM Done - Red" <? if($varCmbFeedback == "CRM Done - Red") { echo "selected"; }?> >CRM Done - Red</option>
                                        
                    </select></td>
                   <td width="29%" align="center"  valign="middle" class="bidderclass">Search with Mobile No</td>
	  <td width="58%"  valign="middle" class="bidderclass"><input type="text" name="mob_num" id="mob_num" value="<?php echo $mob_num; ?>" >
</td>
                </tr>
                 <tr>
                  <td colspan="2">
</td>
                  <?php if($_SESSION['BidderID']=='6252' || $_SESSION['BidderID']=='6253' || $_SESSION['BidderID']=='6290' || $_SESSION['BidderID']=='6684'){?>
                <td><strong>City</strong></td>
                <td align="left"><select name="city" id="city">
                <option value="">Please Select City</option> 
                    <?php 
                while($rowCity = $obj->fun_db_fetch_rs_object($resultCity))
		{
    
                        ?>
                        <option value="<?php echo $rowCity->City?>" <?php if($_REQUEST['city']==$rowCity->City) { echo "Selected";}?>><?php echo $rowCity->City?></option> 
                        <?php }?>
                </select></td>
<? }?>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><input name="Submit" type="submit" class="bluebutton" value="Search" /></td></tr>
              
            </table>
                </form>
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
			$FeedbackClause=" AND (client_lead_allocate.Feedback IS NULL OR client_lead_allocate.Feedback='' OR client_lead_allocate.Feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND client_lead_allocate.Feedback='".$varCmbFeedback."' ";
		}
		
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
                         <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? $srh_qry=""; 
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_LOAN_PERSONAL.".Mobile_Number = '".$mob_num."' ";
		}
		
		
		if($_SESSION['BidderID']!="")
		{
			$feedback_tble="client_lead_allocate";

$qry="SELECT * FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." LEFT OUTER JOIN Req_Feedback_Bidder_PL ON Req_Feedback_Bidder_PL.AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID AND Req_Feedback_Bidder_PL.BidderID= '".$_SESSION['BidderID']."' WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".$feedback_tble.".BidderID = '".$_SESSION['BidderID']."' and ".$feedback_tble.".Reply_Type=1 and ( ".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."') ";
if($_REQUEST['city'])
    {
        $qry.=  " AND City='".$_REQUEST['city']."'"; 
    }	
$qry=$qry.$FeedbackClause." ".$mob_num_clause. " group by ".TABLE_REQ_LOAN_PERSONAL.".Mobile_Number  ";
			
		}		
$srh_qry = $qry;

//echo $srh_qry;
$resCount = $objAdmin->fun_get_num_rows($qry);
if($resCount>$limit)
{
	$pagelinks = paginate($limit, $resCount);
}

if($_SESSION['BidderID']==5633)
			{
	if($cc_type==3)
				{
		$qry.= " order by sbicc_dated DESC LIMIT $start,$limit ";
	}
	else
				{
	$qry.= " order by Updated_Date DESC LIMIT $start,$limit ";
				}
			}
			else
		{
$qry.= " order by $feedback_tble.Allocation_Date DESC LIMIT $start,$limit ";
		}
//echo $qry."<br>";
$result = $obj->fun_db_query($qry);
$getParameterVal = min($start+$limit,$resCount) % $limit;
 ?>
              <tr>
                <td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
              </tr>
              <tr>
                <td class="head1">Name</td>
                <td class="head1">Mobile</td>
                <td class="head1">Salary</td>
                <td class="head1">City</td>
                <td class="head1">Emp stat</td>
                <td class="head1">Feedback</td>                
                <!--<td class="head1">FollowUp date</td>        -->       
                <td class="head1">Comments</td> 
				<?php if($varCmbFeedback=="Send Now" || $varCmbFeedback=="Closed" || $varCmbFeedback=="Process")
				{ ?>  
				 <td class="head1">Application No</td> 
				 <td class="head1">Status</td>
					<?  } ?>	
                <!--<td class="head1">Call</td>-->
              </tr>
              <?			
		if($resCount>0)
			{
				$color = 1;		
		while($row = $obj->fun_db_fetch_rs_object($result))
		{
			//print_r($row);
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
              <!--///////////////////////-->
		  <tr  bgcolor="<?php echo $colorvar;?>">			 
			<td class="bodyarial11"><?php
			 $RequestID= $row->RequestID;

			?><a href="/editlead_fullerton_pl_agents.php?id=<? echo urlencode($row->RequestID); ?>&bid=<? echo $_SESSION['BidderID'];?>" target="_blank"><? echo $row->Name; ?></a></td>
			<td class="bodyarial11">
			<?php 
                if($DisplayNumber==1) {
                ?>
                  <span id="clik4Num_<?php echo $color; ?>">XXXXXXXXXX</span>

                
                <?php } else {  echo ccMasking($row->Mobile_Number); } ?>
</td>
			<td class="bodyarial11">
<?php
			  if($DisplayNumber==1) {
                ?>
<span id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $row->RequestID; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $row->Net_Salary; ?></span> <?php } else {  echo $row->Net_Salary; } ?>

			</td>
			<td class="bodyarial11"><? echo $row->City; ?></td>
			<td class="bodyarial11"><? if($Employment_Status==1) { echo "Salaried";} else { echo "Self Employed";} ?></td>
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
		<td class="bodyarial11">
<? echo getJumpMenu("fullertonlms_index.php",$row->RequestID,"4",$row->Feedback,$pageno,$varmin_date,$varmax_date,$varCmbFeedback, $val); ?>
     </td>
         <!--<td class="bodyarial11"><input type="text" name="Followup_Date" id="Followup_Date" value="<? echo $Followup_Date; ?>"></td>-->
	 <td class="bodyarial11"><textarea rows="2" cols="10"><? echo $row->Add_Comment; ?></textarea></td>
	  <?php 
	 $RequestID= $row->RequestID;
 ?>	
                      <!--<td class="bodyarial11">
           <input type="button" name="chkCall" value="Call" onClick="checkCall(<?php echo $row->RequestID ?>,<?php echo $_SESSION['BidderID'] ?>)" />        </td>-->
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
      <?php if($search=="y") {?>
     <!--- <tr><td colspan="2" align="center"> <form name="xlsdownload" action="/bidder_download_ref.php" method="post"><table border="0" cellspacing="0" cellpadding="0">
 
   <tr>
     <td align="center">
       <input type="hidden" name="BidderIDstatic" value="<? echo $_SESSION['BidderID'];?>">
	   <input type="hidden" name="qry1" value="<? echo $srh_qry; ?>">
	   <input type="hidden" name="qry2" value="<? echo $val; ?>">
	   <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	   <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	   <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
	 </td>
   </tr>
 </table></form></td></tr>-->
    <?php }?>  

            </table>
        </div>
		<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=4";
?>
	<select name="type" id="type" onChange="MM_jumpMenu_flrtn('parent',this,0)">
			  <option value="" <? if($varFeedback == "") { echo "selected"; }?>>No Feedback</option>
					<option value="<? echo $strURL.'&Feedback=Process' ?>" <? if($varFeedback == "Process") { echo "selected"; }?>>Process</option>
					<option value="<? echo $strURL.'&Feedback=Not Eligible'?>" <? if($varFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
					<option value="<? echo $strURL.'&Feedback=Not Interested'?>" <? if($varFeedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
					<option value="<? echo $strURL.'&Feedback=Callback Later'?>" <? if($varFeedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
					<option value="<? echo $strURL.'&Feedback=Wrong Number'?>" <? if($varFeedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
					<option value="<? echo $strURL.'&Feedback=Closed'?>" <? if($varFeedback == "Closed") { echo "selected"; }?>>Closed</option>
				<option value="<? echo $strURL.'&Feedback=FollowUp'?>" <? if($varFeedback == "FollowUp") { echo "selected"; }?> >FollowUp</option>
				<option value="<? echo $strURL.'&Feedback=Not Available'?>" <? if($varFeedback == "Not Available") { echo "selected"; }?> >Not Available</option>
					<option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; }?> >Ringing</option>
					<option value="<? echo $strURL.'&Feedback=Documents Pick'?>" <? if($varFeedback == "Documents Pick") { echo "selected"; }?> >Documents Pick</option>
					<option value="<? echo $strURL.'&Feedback=Loan Rejected'?>" <? if($varFeedback == "Loan Rejected") { echo "selected"; }?> >Loan Rejected</option>
                                        
                                        <option value="<? echo $strURL.'&Feedback=Appointment'?>" <? if($varFeedback == "Appointment") { echo "selected"; }?> >Appointment</option>
                                        <option value="<? echo $strURL.'&Feedback=Not interested for ROI'?>" <? if($varFeedback == "Not interested for ROI") { echo "selected"; }?> >Not interested for ROI</option>
                                        <option value="<? echo $strURL.'&Feedback=Not interested for LoanAmt'?>" <? if($varFeedback == "Not interested for LoanAmt") { echo "selected"; }?> >Not interested for LoanAmt</option>
                                        <option value="<? echo $strURL.'&Feedback=CRM Done - Green'?>" <? if($varFeedback == "CRM Done - Green") { echo "selected"; }?> >CRM Done - Green</option>
                                        <option value="<? echo $strURL.'&Feedback=CRM Done - Amber'?>" <? if($varFeedback == "CRM Done - Amber") { echo "selected"; }?> >CRM Done - Amber</option>
                                        <option value="<? echo $strURL.'&Feedback=CRM Done - Red'?>" <? if($varFeedback == "CRM Done - Red") { echo "selected"; }?> >CRM Done - Red</option>
                                        
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
