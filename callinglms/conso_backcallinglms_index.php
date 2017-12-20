<?php
require_once("includes/application-top-inner-plcalling.php");

define('TABLE_REQ_PL_BACKCALLING', 'Req_PL_BackCalling');
//print_r($_SESSION);
$queryGlobal = "SELECT BidderID,Associated_Bank FROM Bidders where Global_Access_ID LIKE '%".$_SESSION['BidderID']."%'";
$qryGLobalResult = $obj->fun_db_query($queryGlobal);

while($ResGlobalBackCall = $obj->fun_db_fetch_rs_object($qryGLobalResult))
{
    $AgentBidID[] = $ResGlobalBackCall->BidderID;
}
 $AgentBidderId = implode(",", $AgentBidID);

//echo $AgentBidderId;


$qryhdfcCheck = "SELECT BidderID FROM Bidders where leadidentifier in ('hdfcbackcalling', 'fullertonbackcalling', 'kotakbackcallingDelhi', 'kotakbackcallingJCK', 'kotakbackcallingOthers', 'hdfcback_calling') AND Global_Access_ID='".$_SESSION["BidderID"]."'";

$qryCheckhdfcResult = $obj->fun_db_query($qryhdfcCheck);

while($Reshdfcback = $obj->fun_db_fetch_rs_object($qryCheckhdfcResult))
{
    $BidID[] = $Reshdfcback->BidderID;
}
 $BidderId = implode(",", $BidID);
 
if($_SESSION["BidderID"]==6976 || $_SESSION["BidderID"]==7237 || $_SESSION["BidderID"]==7239)
{
$BidderIDstatic = $BidderId;    
}else{
    $BidderIDstatic=$_SESSION["BidderID"];
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
	return substr($number, 0, 6) . str_repeat($maskingCharacter, strlen($number) - 6);
}

  if($_SESSION["BidderID"]==7219){
  $CallStatus = 1;
  }
// $CallStatus = 2;

  $val = "Req_Loan_Home";
  
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
	$refer_no="";
	if(isset($_REQUEST['refer_no']))
		{
			$refer_no=$_REQUEST['refer_no'];
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
        $City="";
	if(isset($_REQUEST['City']))
	{
		$City=$_REQUEST['City'];
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
			ajaxRequest.open("GET", "/getBackCNum.php" + queryString, true);
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
		
		<!--DatePicker End-->
  	</script><style type="text/css">
		.lms-top-container{ margin:auto; width:1170px;}
		.lms-text-wrapper{ float:left; width:90%; text-align:center; font-size:35px;}
		.lms-btn-wrapper{ float:right; text-align:right; width:10%;}
		.logout-btn{ float:left; margin-left:5px; margin-right:5px; padding:10px; color:#FFF; text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:14px; border-radius:5px; background:#F00; text-decoration:none;}
		.logout-btn1{ float:left; margin-left:2px; margin-right:2px; padding:4px; color:#FFF; text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px; border-radius:5px; background:#F00; text-decoration:none; vertical-align:baseline;}

		</style>

 <script type="text/javascript">

    function checkCall(RequestID,agent_user)
    {	
	   $.ajax({ type: 'post',  url: '/dialerclick2callbackcalling.php',  data: {  RequestID:RequestID,agent_user:agent_user, },
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
<!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;">
<div class="lms-top-container"> 
    <div class="lms-text-wrapper"> Back Calling Process  LMS - <span style="font-size: initial; vertical-align: middle;"><? echo $_SESSION['Bidder_Name'];?></span></div>
<div class="lms-btn-wrapper">
<a href="logout.php" class="logout-btn">Logout</a></div>
 </div>


<div style="clear:both;"></div>

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
             <form name="frmsearch" action="conso_backcallinglms_index.php" method="get" onSubmit="return chkform();">
                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"];?>">
                <input type="hidden" name="search" id="search" value="y">
                <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
             
                <tr>
                  <td colspan="4" class="head1">Search</td>
                </tr>
                  <tr>
                  <td><strong>Date:</strong></td>
                  <td><strong>From:</strong>
                    <input name="min_date" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>" ></td>
                  <td style="text-align:right;"><strong>To:</strong></td>
                  <td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
                </tr>
                <tr>
                  <td style="text-align:right;"><strong>Feedback:</strong></td>
                  <td><select name="cmbfeedback" id="cmbfeedback">
                	<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
		<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="Not Eligible" <? if($varCmbFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Not Interested Direct" <? if($varCmbFeedback == "Not Interested Direct") { echo "selected"; } ?>>Not Interested Direct</option>
		<option value="Not Interested Offer" <? if($varCmbFeedback == "Not Interested Offer") { echo "selected"; } ?>>Not Interested Offer</option>
		<option value="Taken From Competition" <? if($varCmbFeedback == "Taken From Competition") { echo "selected"; } ?>>Taken From Competition</option>
		<option value="Already Applied In HDFC" <? if($varCmbFeedback == "Already Applied In HDFC") { echo "selected"; } ?>>Already Applied In HDFC</option>
		<option value="Callback Later" <? if($varCmbFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="FollowUp" <? if($varCmbFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
		<option value="Login" <? if($varCmbFeedback == "Login") { echo "selected"; } ?>>Login</option>
		<option value="Documents Pick" <? if($varCmbFeedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
        <option value="Post Login Reject" <? if($varCmbFeedback == "Post Login Reject") { echo "selected"; }?>>Post Login Reject</option>
        <option value="Disbursed" <? if($varCmbFeedback == "Disbursed") { echo "selected"; }?>>Disbursed</option>
        <option value="Approved" <? if($varCmbFeedback == "Approved") { echo "selected"; }?>>Approved</option>
		
		           </select></td>
				    <td style="text-align:right;"><strong>Search Mobile:</strong></td>
	  <td><input name="MobileNum" type="text" id="MobileNum" size="15" value="<? echo $_REQUEST['MobileNum']; ?>" ></td>
                      </tr>
                 <tr>
                   <td align="center"  valign="middle" class="bidderclass">City</td>
                                        <td   valign="middle" class="bidderclass"><select name="City">
                                                <?php echo plgetCityList($_REQUEST['City']);?>
                                            </select></td>
                  <td align="center"  valign="middle" class="bidderclass">Agents</td>
                                        <td   valign="middle" class="bidderclass"><select name="AgentsID">
                                                <option value="All">All</option>
                                                <?php 
                                                $qryGLobalResult2 = $obj->fun_db_query($queryGlobal);
                                                while($ResGlobalBackCall2 = $obj->fun_db_fetch_rs_object($qryGLobalResult2))
{
                                                   
                               ?>
                                                <option value="<?php echo $ResGlobalBackCall2->BidderID;?>" <? if($ResGlobalBackCall2->BidderID == $_REQUEST['AgentsID']) { echo "selected"; } ?>><?php echo $ResGlobalBackCall2->BidderID;?>[<?echo $ResGlobalBackCall2->Associated_Bank;?>]</option>
                                                <?php 
                                                }
                                                ?>
                                            </select></td>
                 </tr><tr>
                     <td align='right'>Search with Reference No</td>
                  <td><input type="text" name="refer_no" id="refer_no" value="<?php echo $refer_no; ?>" class="input-lead" ></td>
                  <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search"></td>
                </tr>
              
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
		$fbqry="select FeedbackID from Req_Feedback_BCalling where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']." AND Reply_Type=12";
		$result = $obj->fun_db_query($fbqry);	
				
		$num_rows = $obj->fun_db_get_num_rows($result);
		if($num_rows > 0)
		{
			$row = $obj->fun_db_fetch_rs_array($result);
			$strSQL="Update Req_Feedback_BCalling Set Feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into Req_Feedback_BCalling(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",'12','".$Feedback."')";
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
			$FeedbackClause=" AND (Req_Feedback_BCalling.Feedback IS NULL OR Req_Feedback_BCalling.Feedback='' OR Req_Feedback_BCalling.Feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND Req_Feedback_BCalling.Feedback='".$varCmbFeedback."' ";
		}	
		?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
             <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? $srh_qry=""; 
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_PL_BACKCALLING.".Mobile_Number = '".$mob_num."' ";
		}
                
                if($City=="Please Select")
                {
                    $City_clause = " ";
                }else{
                    $City_clause = " AND ".TABLE_REQ_PL_BACKCALLING.".City = '".$City."' ";
                }
                if($_REQUEST['AgentsID']=="All")
                {
                    $AgentBidderId;
                }else{
                    $AgentBidderId=$_REQUEST['AgentsID'];
                }
		if($refer_no)
		{
			$referno_clause = " AND ".TABLE_REQ_PL_BACKCALLING.".ReferenceID = '".$refer_no."' ";
		}
		if($BidderIDstatic!="")
		{
			$feedback_tble="lead_allocate";
			$qry="SELECT * FROM ".$feedback_tble.",".TABLE_REQ_PL_BACKCALLING." LEFT OUTER JOIN Req_Feedback_BCalling ON Req_Feedback_BCalling.AllRequestID=".TABLE_REQ_PL_BACKCALLING.".RequestID AND Req_Feedback_BCalling.BidderID IN (".$AgentBidderId.") WHERE ".$feedback_tble.".AllRequestID=".TABLE_REQ_PL_BACKCALLING.".RequestID and ".$feedback_tble.".BidderID IN (".$AgentBidderId.") and ((".$feedback_tble.".Allocation_Date Between '".($min_date)."' and '".($max_date)."') or (Req_Feedback_BCalling.Followup_Date Between '".($min_date)."' and '".($max_date)."')) ";
			
                        if($_REQUEST['MobileNum']!="")
                        {
                            $qry=  $qry." AND ".TABLE_REQ_PL_BACKCALLING.".Mobile_Number ='".$_REQUEST['MobileNum']."'";
                        }
                        $qry=$qry. $City_clause." ".$FeedbackClause." ".$mob_num_clause ." ".$referno_clause." group by ".TABLE_REQ_PL_BACKCALLING.".Mobile_Number ";
		}		
	$srh_qry = $qry;
	//echo $qry;
	$resCount = $objAdmin->fun_get_num_rows($qry);
	if($resCount>$limit)
	{
	$pagelinks = paginate($limit, $resCount);
	}
$getParameterVal = min($start+$limit,$resCount) % $limit;
	$qry.= " order by ".$feedback_tble.".Allocation_Date DESC LIMIT $start,$limit ";
	$result = $obj->fun_db_query($qry);
 ?>
              <tr>
                <td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong><?php //print_r($_SESSION);?></td>
              </tr>
              <tr>
                  <td class="head1">Reference No</td>
                <td class="head1">Agent ID</td>
                <td class="head1">CRM Number</td>
                <td class="head1">Name</td>
                <td class="head1">Mobile</td>
                <td class="head1">Salary</td>
                <td class="head1">City</td>
                <td class="head1">Feedback</td>                
                <td class="head1">FollowUp date</td>        
				 <td class="head1">Comments</td>   
				  
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
			$RequestID=$row->RequestID;
			
			if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
				else{
						$colorvar = "#EEE";
					}
	?>
			 <tr  bgcolor="<?php echo $colorvar;?>">			 
			 <td class="bodyarial11"><?php echo $row->ReferenceID; ?></td>
                         <td class="bodyarial11"><?php 
                         if($row->BidderID=="")
                            {
                        $QBidId = "SELECT BidderID FROM lead_allocate WHERE leadid='".$row->leadid."'";
                       $Qres = $obj->fun_db_query($QBidId);
                       $Qrow = $obj->fun_db_fetch_rs_object($Qres);
                      echo $Qrow->BidderID;
                    }else{
                    echo $row->BidderID;} ?></td>
			 <td class="bodyarial11"><?php echo $row->CRMNumber; ?></td>
			<td class="bodyarial11"><? echo $row->Name; ?></td>
			<td class="bodyarial11">
			  <?php 
                if($CallStatus==1) {
                ?>
                  <span id="clik4Num_<?php echo $color; ?>"><?php echo ccMasking($row->Mobile_Number); ?></span>

                
                <?php } else {  echo ccMasking($row->Mobile_Number); } ?>

</td>
			<td class="bodyarial11"> <? 
                  if($CallStatus==1) {
                ?>
<span id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $row->RequestID; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $row->Net_Salary; ?></span> <?php } else {  echo $row->Net_Salary; } ?>
</td>
			<td class="bodyarial11"><? echo $row->City; ?></td>
			
		<td class="bodyarial11">
                 <? echo getJumpMenu("conso_backcallinglms_index.php",$row->RequestID,"2",$row->Feedback,$page,$varmin_date,$varmax_date,$varCmbFeedback, $val) ?>
       </td>
         <td class="bodyarial11"><input type="text" name="Followup_Date" id="Followup_Date" value="<? echo $Followup_Date; ?>"></td>
		  <td class="bodyarial11"><textarea rows="2" cols="10"><? echo $row->Add_Comment; ?></textarea></td>
		
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
            <?php  if($_SESSION["BidderID"]==7449)
          {
          ?>
              <br>
  <table  border="0" cellpadding="5" cellspacing="1" align="center">
              <tr>
                <td style="color:#FFF;" align="center" bgcolor="#FFFFFF">
                <form name="frmdownload" action="/back_calling_pl_download-excel.php" method="post">
	 <input type="hidden" name="qry1" value="<? echo $srh_qry; ?>">
	    <input type="hidden" name="BidderIDstatic" value="<? echo $_SESSION['BidderID']; ?>">
	 <input type="hidden" name="qry2" value="<?php echo TABLE_REQ_PL_BACKCALLING;?>">
	 <input type="hidden" name="min_date" value="<? echo $min_date; ?>">
	 <input type="hidden" name="max_date" value="<? echo $max_date; ?>">
	 <input name="Submit2" type="submit" class="bluebtn" value="Export List To Excel">
 </form>

                
</td>
              </tr>
            </table>
                    

            <?
  		}?>
            
            <?
 }
 ?>            </div></td>
      </tr>

            </table>
        </div>
		<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
//www.deal4loans.com/callinglms/backcallinglms_index.php?search=y&RequestID=2115107&type=1&pageno=&min_date=2016-05-01&max_date=2016-06-01&cmbfeedback=All&product=Req_Loan_Personal&Feedback=Not%20Applied 
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=".$varVal;
?>
	<select name="type" id="type" onChange="MM_jumpMenu_('parent',this,0)">
		<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?>>No Feedback</option>
		<option value="<? echo $strURL.'&Feedback=Not Eligible'; ?>" <? if($varFeedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested Direct'; ?>" <? if($varFeedback == "Not Interested Direct") { echo "selected"; } ?>>Not Interested Direct</option>
		<option value="<? echo $strURL.'&Feedback=Not Interested Offer'; ?>" <? if($varFeedback == "Not Interested Offer") { echo "selected"; } ?>>Not Interested Offer</option>
		<option value="<? echo $strURL.'&Feedback=Taken From Competition'; ?>" <? if($varFeedback == "Taken From Competition") { echo "selected"; } ?>>Taken From Competition</option>
		<option value="<? echo $strURL.'&Feedback=Already Applied In HDFC'; ?>" <? if($varFeedback == "Already Applied In HDFC") { echo "selected"; } ?>>Already Applied In HDFC</option>
		<option value="<? echo $strURL.'&Feedback=Callback Later'; ?>" <? if($varFeedback == "Callback Later") { echo "selected"; } ?>>Callback Later</option>
		<option value="<? echo $strURL.'&Feedback=Ringing'; ?>" <? if($varFeedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="<? echo $strURL.'&Feedback=FollowUp'; ?>" <? if($varFeedback == "FollowUp") { echo "selected"; } ?>>FollowUp</option>
		<option value="<? echo $strURL.'&Feedback=Appointment'; ?>" <? if($varFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
		<option value="<? echo $strURL.'&Feedback=Login'; ?>" <? if($varFeedback == "Login") { echo "selected"; } ?>>Login</option>
		<option value="<? echo $strURL.'&Feedback=Documents Pick'; ?>" <? if($varFeedback == "Documents Pick") { echo "selected"; } ?>>Documents Pick</option>
        <option value="<? echo $strURL.'&Feedback=Post Login Reject'; ?>" <? if($varFeedback == "Post Login Reject") { echo "selected"; }?>>Post Login Reject</option>
        <option value="<? echo $strURL.'&Feedback=Disbursed'; ?>" <? if($varFeedback == "Disbursed") { echo "selected"; }?>>Disbursed</option>
        <option value="<? echo $strURL.'&Feedback=Approved'; ?>" <? if($varFeedback == "Approved") { echo "selected"; }?>>Approved</option>
		
		
		
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
