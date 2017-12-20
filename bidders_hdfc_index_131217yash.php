<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
//define("ENABLELOGIN", 1);
//for session variables
$limit = 25;
foreach ($_SESSION as $key => $val)
    $sessionVar.= $key . " " . $val . "\n";

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if ($IP_Remote == '192.124.249.12' || $IP_Remote == '185.93.228.12') {
    $IP = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
} else {
    $IP = $IP_Remote;
}

$logfilecontent = "";
$logfilecontent.="********************************************************\n";
$logfilecontent.= "Datetime: " . ExactServerdate() . "\n";
$logfilecontent.="IP Address: " . $IP . "\n";
$logfilecontent.= "Session Variable: " . $sessionVar . "\n";

$todaydt = date('Y-m-d');

$BidderIDstatic = "";
if (isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic']) > 0) {
    $BidderIDstatic = $_REQUEST['BidderIDstatic'];
} else {
    $BidderIDstatic = $_SESSION['BidderID'];
}
$pagename = $BidderIDstatic;

$refernce_no = "";
if (isset($_REQUEST['refernce_no'])) {
    $refernce_no = $_REQUEST['refernce_no'];
}

$mob_num = "";
if (isset($_REQUEST['mob_num'])) {
    $mob_num = $_REQUEST['mob_num'];
}

$product = $_SESSION['ReplyType'];
$date = $_SESSION['Date'];
$Define_PrePost = $_SESSION['DefinePrePost'];


if ($product == 2) {
    $tomorrow = mktime(0, 0, 0, date("m"), date("d") - 90, date("Y"));
} else {
    $tomorrow = mktime(0, 0, 0, date("m"), date("d") - 90, date("Y"));
}

$day45 = date('Y-m-d', $tomorrow);
if (isset($day45) && ($day45 > $date)) {
    $joindate = $day45;
} else {
    $joindate = $date;
}

function getLicBidders($BidderIDstatic){
	$checkLicBiddersQry = "SELECT BidderID FROM `Bidders` WHERE BidderID = '".$BidderIDstatic."' AND `Global_Access_ID` = '5788'";
	$LicBiddersResult = d4l_ExecQuery($checkLicBiddersQry);
	$LicBiddersCount = d4l_mysql_num_rows($LicBiddersResult);

	return $LicBiddersCount;
}

$getLicBidders = '';



$getLicBidders = 0;

if($getLicBidders)
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-60, date("Y"));
	$day60=date('Y-m-d',$tomorrow);
	$joindate60=$day60;
}

$textview = d4l_ExecQuery("select Reply_Type from Bidders_List where BidderID=" . $BidderIDstatic);
$viewtexttype = d4l_mysql_result($textview, 0, "Reply_Type");


function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}
function getReqCode($pKey) {
    $titles = array(
        'Req_Loan_Personal' => '1'
       
    );
    foreach ($titles as $key => $value)
        if ($pKey == $key)
            return $value;

    return "";
}

$val = $_REQUEST['product'];
// echo "bye".$val;
$pro_code = getReqCode($val);

$FeedbackClause = "";
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
$citywise = "";
if (isset($_REQUEST['citywise'])) {
    $citywise = $_REQUEST['citywise'];
}

/*$min_date = "";
if (isset($_REQUEST['min_date'])) {
    $min_date = $_REQUEST['min_date'];
}
*/

$min_date="";
if(isset($_REQUEST['min_date'])){
	$min_date=$_REQUEST['min_date'];
	if($getLicBidders)
	{
		echo $min_date." : ".$joindate60;
		if($min_date<$joindate60)
		{
			$min_date=$joindate60;
		}
		else
		{
			$min_date=$_REQUEST['min_date'];
		}
	}
	else
	{
		$min_date=$_REQUEST['min_date'];
	}
}

$max_date = "";
if (isset($_REQUEST['max_date'])) {
    $max_date = $_REQUEST['max_date'];
}

$varCmbFeedback = "";
if (isset($_REQUEST['cmbfeedback'])) {
    $varCmbFeedback = $_REQUEST['cmbfeedback'];
}

$RequestID = "";
if (isset($_REQUEST['RequestID'])) {
    $RequestID = $_REQUEST['RequestID'];
}
$type = "";
if (isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
}
$Feedback = "";
if (isset($_REQUEST['Feedback'])) {
    $Feedback = $_REQUEST['Feedback'];
}

//Paging
$pagesize = 25;
$startrow = 0;

//Set the page no

if (empty($_GET['pageno'])) {
    if ($startrow == 0) {
        $pageno = $startrow + 1;
    }
} else {
    $pageno = $_GET['pageno'];
    $startrow = ($pageno - 1) * $pagesize;
}

//Set the counter start
if ($pageno / $pagesize == 0) {
    $counterstart = $pageno - ($pagesize - 1);
} else {
    $counterstart = $pageno - ($pageno % $pagesize) + 1;
}
//Counter End
$counterend = $counterstart + ($pagesize - 1);
///
function getCombo($strVal, $strselect) {
    $strSelectedCaption;
    //echo "eeeee".$strselect."<br>";
    $stroption = $strVal;
    if (strlen(trim($stroption)) > 0) {
        $pieces1 = explode(",", $stroption);
        for ($l = 0; $l < count($pieces1); $l++) {
            echo " pieces1[$l] : " . $pieces1[$l] . "<BR>";
            $strSelectedCaption = "";
            switch ($pieces1[$l]) {
                Case "1":
                    if ($strselect == "Req_Loan_Personal") {
                        $strSelectedCaption = "selected";
                    }
                    echo "<option value='Req_Loan_Personal'" . $strSelectedCaption . ">Personal Loan</option>";
                    break;
                
            }
        }
    }
}
?>
<html>
    <head>
        <meta http-equiv="Content-Language" content="en-us">
        <meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
        <title>Login</title>
        <script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
        <link href="includes/style1.css" rel="stylesheet" type="text/css">
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/JavaScript">
            /*
            function killCopy(e){ return false; }
            function reEnable(){return true; }
            document.onselectstart=new Function ("return false");
            if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
            function clickIE4(){if (event.button==2){ return false; } }
            function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
            if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
            document.oncontextmenu=new Function("return false")
            */
        </script>
        <link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="callinglms/css-datepicker/datepicker.css">
		<link rel="stylesheet" type="text/css" href="css-datetimepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css-datetimepicker/jquery-ui-timepicker-addon.css">
		<script src="callinglms/js-datepicker/jquery-1.5.1.js"></script>
		<script src="callinglms/js-datepicker/jquery.ui.core.js"></script>
		<script src="callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
		<script src="js-datetimepicker/jquery-ui-timepicker-addon.js"></script>
		<script> 
			$(function() {
				$("[id^=followup_date_]").datetimepicker({  
					defaultDate: "today",
					changeMonth: true,
					changeYear: true,
					numberOfMonths: 1,
					minDate:0,
					timeFormat: 'hh:mm:ss',
				});
			});
		</script>
<?php
if (isset($_SESSION['UserType'])) {
    echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'><img src='http://www.deal4loans.com/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome " . ucwords($_SESSION['UserType']) . " " . $_SESSION['UName'] . "</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
}
?>
        <!-- End Main Banner Menu Panel -->
        <!-- Start Main Container Panel -->
        <style>
            .bidderclass
            {
                Font-family:Comic Sans MS;
                font-size:13px;
            }
            .style1 {
                font-family: verdana;
                font-size: 12px;
                font-weight: bold;
                color:#084459;
            }
            .style2 {
                font-family: verdana;
                font-size: 11px;
                font-weight: bold;
                color:#084459;
            }
            .style3 {
                font-family: verdana;
                font-size: 11px;
                font-weight: normal;
                color:#084459;
                text-decoration:none;
            }
            .bluebtn{
                font-family:Verdana, Arial, Helvetica, sans-serif; 
                font-size:12px;
                font-weight:bold;
                color:#084459;
                border:1px solid #084459;
                background-color:#FFFFFF;
            }
            .buttonfordate {
                font-family: Verdana, Arial, Helvetica, sans-serif;
                font-size: 11px;
                color: #FFFFFF;
                background-color: #45B2D8;
                border: 1px solid #45B2D8;
                font-weight: bold;
            }
        </style>
        <script type="text/javascript">
            var ajaxRequest;  // The variable that makes Ajax possible!
		function GetajaxFunction(){
			
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
			
			//alert(allLoc);
			
			var queryString = "?get_requestid=" + id;
			ajaxRequest.open("GET", "getfullertonNum.php" + queryString, true);
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
		window.onload = GetajaxFunction;  
        </script>
         <script type="text/javascript">

    function checkCall(RequestID,agent_user)
    {	
	   $.ajax({ type: 'post',  url: '/dialerclick2callpltata.php',  data: {  RequestID:RequestID,agent_user:agent_user, },
			   success: function (response) {
			   //alert(response);
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	}
	</script>

    </head><body>
        <table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
            <tr>
                <td align="center">
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
                        <tr><td style="padding-top:5px; font-size:13px;">&nbsp;&nbsp; <a  href="/change_lms_pwd.php" target="_blank" style="color:#FFFFFF;"><b>Change Password</b></a>
                            </td></tr>
                        <tr>
                           
                        <tr><td>&nbsp;</td></tr>
                        <tr><td align="center">

                                <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="middle" background="images/login-form-login-bg.gif"><form name="frmsearch" action="bidders_hdfc_index_131217yash.php?search=y" method="post" onSubmit="return chkform();"> <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $BidderIDstatic; ?>" /><table width="95%" border="0"  cellpadding="1" cellspacing="0">
                                                    <tr><td colspan="3">&nbsp;</td></tr>
                                                    <tr>
                                                        <td colspan="3" align="center">
                                                            <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
                                                                    <td width="20%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp; From </td>
                                                                    <td width="24%" align="left" valign="middle" class="bidderclass"><? $current_date = date('Y-m-d'); ?> 
                                                                        <input name="min_date" type="text" id="min_date" size="15" <? if ($min_date == "") { ?>value="<? if($getLicBidders){	echo $joindate60;}else{ echo $joindate;} ?>"<? } else { ?>value="<? echo $min_date; ?>" <? } ?>></td>
                                                                    <td width="7%" align="left" valign="middle" class="bidderclass"><input name="b12" type="button" class="buttonfordate" onClick="javascript:pedirFecha(min_date, '');" value="&lt; Insert" /> </td>
                                                                    <td valign="middle" align="center" class="style1" width="8%">To</td>
                                                                    <td align="left" valign="middle" class="style1" width="24%"> <input name="max_date" type="text" id="max_date" size="15" value="<? echo $max_date; ?>"></td>
                                                                    <td align="left" valign="middle" class="style1" width="17%"><input name="b122" type="button" class="buttonfordate" onClick="javascript:pedirFecha(max_date, '');" value="&lt; Insert"></td>
                                                                </tr>
                                                            </table>
                                                        </td></tr>
                                                    <tr>
                                                        <td colspan="3" align="center"><table border="0" cellpadding="0" cellspacing="0" width="85%">
                                                                <td width="30%" valign="middle" class="style1">Product</td>
                                                                <td width="30%"  valign="middle" class="bidderclass">
<? //echo "product".$_SESSION['ReplyType'];  ?>
                                                                    <select name="product" style="width:150px;">

             <? getCombo($_SESSION['ReplyType'], $val) ?>                                                       </select>	</td>
                                                                <td width="10%"  valign="middle" class="bidderclass">&nbsp;</td>
                                                                <td width="30%" valign="middle" class="style1">Feedback:</td>


                                                                    <td width="50%" align="left" valign="middle" class="bidderclass">
                                                                        <select name="cmbfeedback" id="cmbfeedback" style="width:120px;">
                                                                            <option value="All" <? if ($varCmbFeedback == "All") {
                        echo "selected";
                    } ?>>All</option>
                                                                            <option value="" <? if ($varCmbFeedback == "") {
                        echo "selected";
                    } ?>>No Feedback</option>
                                                                            <option value="Not Eligible" <? if ($varCmbFeedback == "Not Eligible") {
                        echo "selected";
                    } ?>>Not Eligible</option>
                                                                            <option value="Not Interested" <? if ($varCmbFeedback == "Not Interested") {
                        echo "selected";
                    } ?>>Not Interested</option>
                                                                            <option value="Callback Later" <? if ($varCmbFeedback == "Callback Later") {
                        echo "selected";
                    } ?>>Callback Later</option>
                                                                            <option value="Wrong Number" <? if ($varCmbFeedback == "Wrong Number") {
                        echo "selected";
                    } ?>>Wrong Number</option>
                    <option value="Process" <? if ($varCmbFeedback == "Process" || $varCmbFeedback == "Login") {
                            echo "selected";
                        } ?>>Process</option>
                                                                                    <option value="Closed" <? if ($varCmbFeedback == "Closed" || $varCmbFeedback == "Disbursed") {
                            echo "selected";
                        } ?>>Closed</option>
                                                                                    <option value="Not Available" <? if ($varCmbFeedback == "Not Available") {
                            echo "selected";
                        } ?>>Not Available</option>
                                                                                    <option value="Ringing" <? if ($varCmbFeedback == "Ringing") {
                            echo "selected";
                        } ?>>Ringing</option> 
                          	
                                                                            <option value="FollowUp" <? if ($varCmbFeedback == "FollowUp") {
                            echo "selected";
                        } ?>>FollowUp</option>
                                                                            <option value="Documents Pick" <? if ($varCmbFeedback == "Documents Pick") {
                            echo "selected";
                        } ?>>Documents Pick</option>
                                                                            <option value="Loan Rejected" <? if ($varCmbFeedback == "Loan Rejected") {
                            echo "selected";
                        } ?>>Loan Rejected</option>
                                                                            <option value="Appointment" <? if ($varCmbFeedback == "Appointment") {
                            echo "selected";
                        } ?>>Appointment</option>
                            
                                                                        </select>	 </td>
                       
                                                    </tr>
                                            </table></td></tr>
                        <? if ($BidderIDstatic == 993) {
                            ?>
                                        <tr>
                                            <td colspan="3" align="center" class="style1">
                                                City Wise 
                                                <select name="citywise" style="width:150px;">
                                                    <option value="-1" >Please Select</option>
                                                    <option value="1" <? if ($citywise == 1) {
                            echo "selected";
                        } ?>>Pan Country</option>
                                                    <option value="2" <? if ($citywise == 2) {
                            echo "selected";
                        } ?>>Other City</option>
                                                </select>
                                            </td></tr>
                        <? } ?>
                                   
                                    <tr><td width="29%" align="center"  valign="middle" class="bidderclass">Search with Reference No</td>
                                        <td width="58%"  valign="middle" class="bidderclass"><input type="text" name="refernce_no" id="refernce_no" value="<?php echo $refernce_no; ?>" >
                                        </td>
                                        <td>City</td>
                                        <td><select name="CityName" id="CityName">
                                            <?php echo plgetCityList($City);?>
                                        </select>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="center" valign="middle"><input name="Submit" type="image" /></td>
                                    </tr>
                                   
                                </table> </form></td>
                        </tr>
                        <tr>
                            <td width="650" height="8" align="center" valign="top"><img src="images/login-bot-pnl.gif" width="650" height="8"></td>
                        </tr>
                        <tr>
                            <td align="center" valign="middle" >&nbsp;</td>
                        </tr>
                    </table>
                        <?
                        $search_date = "";
                        $varmin_date = $min_date;
                        $varmax_date = $max_date;
                        if (strlen(trim($RequestID)) > 0) {
                            $strSQL = "";
                            $Msg = "";
                            $result = d4l_ExecQuery("select FeedbackID from Req_Feedback where AllRequestID=$RequestID and BidderID=" . $BidderIDstatic);
                            $num_rows = d4l_mysql_num_rows($result);
                            $currentdate = date('Y-m-d H:i:s');
                            if ($num_rows > 0) {
                                $row = d4l_mysql_fetch_array($result);
                                $strSQL = "Update Req_Feedback Set Feedback='" . $Feedback . "' , last_update_dated = '".$currentdate."' ";
                                $strSQL = $strSQL . " Where FeedbackID=" . $row["FeedbackID"];
                            } else {
                                $strSQL = "Insert into Req_Feedback(AllRequestID, BidderID, Reply_Type , Feedback, last_update_dated) Values (";
                                $strSQL = $strSQL . $RequestID . "," . $BidderIDstatic . "," . $pro_code . ",'" . $Feedback . "','".$currentdate."')";
                            }
                            //echo $strSQL;
                            $result = d4l_ExecQuery($strSQL);
                            if ($result == 1) {
                                
                            } else {
                                $Msg = "** There was a problem in adding your feedback. Please try again.";
                            }
                        }
                        if ($search == "y") {
                            $min_date = $min_date . " 00:00:00";
                            $max_date = $max_date . " 23:59:59";
                            if (strlen(trim($varCmbFeedback)) == 0) {
                                $FeedbackClause = " AND (Req_Feedback.Feedback IS NULL OR Req_Feedback.Feedback='' OR Req_Feedback.Feedback='No Feedback') ";
                            } else if ($varCmbFeedback == "All") {
                                $FeedbackClause = " ";
                            } else {
                               
                            }
                            if ($mob_num > 0) {
                                $mob_num_clause = " AND `" . $val . "`.Mobile_Number = '" . $mob_num . "' ";
                            }

                            if ($pro_code == 1) {
                                $feedback_tble = "Req_Feedback_Bidder_PL";
                            } elseif ($pro_code == 2) {
                                $feedback_tble = "Req_Feedback_Bidder_HL";
                            } elseif ($pro_code == 3) {
                                $feedback_tble = "Req_Feedback_Bidder_CL";
                            } elseif ($pro_code == 4) {
                                $feedback_tble = "Req_Feedback_Bidder_CC";
                            } elseif ($pro_code == 5) {
                                $feedback_tble = "Req_Feedback_Bidder_LAP";
                            } else {
                                $feedback_tble = "Req_Feedback_Bidder1";
                            }

                            if (strlen($refernce_no) > 3) {
                                if ($pro_code == 1) {
                                    $appdtxt = "PL";
                                } elseif ($pro_code == 2) {
                                    $appdtxt = "HL";
                                } elseif ($pro_code == 3) {
                                    $appdtxt = "CL";
                                } elseif ($pro_code == 4) {
                                    $appdtxt = "CC";
                                } elseif ($pro_code == 5) {
                                    $appdtxt = "LAP";
                                } else {
                                    $appdtxt = "";
                                }
                                list($requestidno, $bidderid) = split('[S]', $refernce_no);
                                $refernce_no_section = str_replace($appdtxt, "", $requestidno);

                                $refernce_no_clause = " AND `" . $feedback_tble . "`.Feedback_ID = '" . $refernce_no_section . "' ";
                            }
                            if($_REQUEST['CityName'])
                            {
                                $CityClause = $_REQUEST['CityName'];
                            }
                            ?>
                        <p class="bodyarial11"><?= $Msg ?></p>
                           <p align="center"><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
                        <table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
                                <?
                                echo $pro_code;
                                if ($pro_code == 1) {
                                    if ($BidderIDstatic == 2609) {
                                        $getfields = "RequestID,City ,Name,Mobile_Number,Allocation_Date,Net_Salary,Company_Name,Loan_Amount,Employment_Status,Feedback,comment_section,Hdfc_Eligibility,Citibank_Eligibility,Barclays_Eligibility,eligible,interest_stat,post_login_stat,Primary_Acc,PL_Tenure";
                                        $getfieldsdwnld = "Employment_Status,Residential_Status,EMI_Paid,Card_Vintage,CC_Holder,eligible,interest_stat,Allocation_Date,Hdfc_Eligibility,Citibank_Eligibility,Barclays_Eligibility,DOB,Name,City, Email,Company_Name,City,City_Other,Years_In_Company,Total_Experience,Mobile_Number,Net_Salary,Loan_Any,Loan_Amount,Feedback,PL_EMI_Amt,Pincode,Card_Limit,IP_Address,comment_section,identification_proof,last_update_dated,post_login_stat,Add_Comment,Existing_ROI, Existing_Loan, Existing_Bank";
                                    } else {
                                        $getfields = "Feedback_ID,Followup_Date,City,RequestID,Name,Mobile_Number,Allocation_Date,Net_Salary,Company_Name,Loan_Amount,Employment_Status,Feedback,comment_section,Hdfc_Eligibility,Citibank_Eligibility,Barclays_Eligibility,eligible,interest_stat,post_login_stat,Primary_Acc,PL_Tenure";
                                        $getfieldsdwnld = "Salary_Drawn,Employment_Status,Residential_Status,EMI_Paid,Card_Vintage,CC_Holder,eligible,interest_stat,Allocation_Date,Hdfc_Eligibility,Citibank_Eligibility,Barclays_Eligibility,DOB,Name,Email,Company_Name,City,City_Other,Years_In_Company,Total_Experience,Mobile_Number,Net_Salary,Loan_Any,Loan_Amount,Feedback,PL_EMI_Amt,Pincode,Card_Limit,IP_Address,comment_section,identification_proof,last_update_dated,post_login_stat,Add_Comment, Existing_ROI, Existing_Loan, Existing_Bank";
                                    }
                                } else {
                                    $getfields = "RequestID,Name,Mobile_Number,Allocation_Date,Net_Salary,Company_Name,Loan_Amount,Employment_Status,Feedback,comment_section,eligible,interest_stat,post_login_stat,Followup_Date,axis_executive_name";
                                  
                                }

                                   
                                    $search_qry = "SELECT *," . $feedback_tble . ".BidderID AS sentbidder";
                                    $search_qry.= " WHERE " . $feedback_tble . ".AllRequestID=`" . $val . "`.RequestID and " . $feedback_tble . ".BidderID = '" . $BidderIDstatic . "' and " . $feedback_tble . ".Reply_Type=" . $pro_code . " and (" . $feedback_tble . ".Allocation_Date  Between '" . ($min_date) . "' and '" . ($max_date) . "' or Req_Feedback.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') ";
                                    
                                    if($checkLicBidders){
										$search_qry = $search_qry . $mob_num_clause . " " . $refernce_no_clause;
									}
									else{
										$search_qry = $search_qry . $FeedbackClause . " " . $mob_num_clause . " " . $refernce_no_clause;
									}

                                    /*Code By Rachit Jain 01-07-2017 Start */
                                  
                                    $search_qry = $search_qry . "group by " . $val . ".Mobile_Number";
                                    $search_qry = $search_qry . " order by " . $val . ".Dated DESC";

                                    $qry = "SELECT RequestID,axis_executive_name ";

									/*Code By Rachit Jain 01-07-2017 Start */
									//Code only for LIC Bidders
                                    
										$qry = $qry . " FROM " . $feedback_tble . ",`" . $val . "` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=" . $val . ".RequestID AND Req_Feedback.BidderID = '" . $BidderIDstatic . "' ";
				 $qry = $qry . "WHERE " . $feedback_tble . ".AllRequestID=`" . $val . "`.RequestID and " . $feedback_tble . ".BidderID = '" . $BidderIDstatic . "' and " . $feedback_tble . ".Reply_Type=" . $pro_code . " and (" . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or Req_Feedback.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') ";
            if($_REQUEST['cmbfeedback']!='All')
              {
              if ($BidderIDstatic == "6734" || $BidderIDstatic == "6975") {
              if($_REQUEST['cmbfeedback']=='') {
                $qry = $qry . " AND Feedback is NULL";  
              }else{
                $qry = $qry . " AND Feedback='".$_REQUEST['cmbfeedback']."'";                 }
                }
             }
									if($checkLicBidders){
										 $qry = $qry . $mob_num_clause . " " . $refernce_no_clause;
									}
									else{
										$qry = $qry . $FeedbackClause . " " . $mob_num_clause . " " . $refernce_no_clause;
									}

                                    
                                    $qry = $qry . "group by " . $val . ".Mobile_Number";
                               
                                //echo $search_qry."<br><br>";
                                echo $qry."<br>";
                                $result = d4l_ExecQuery($qry);

                                $recordcount = d4l_mysql_num_rows($result);
                                ?>
                            
                                <tr>
                                    <td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow + 1; ?> to <? echo min($startrow + $pagesize, $recordcount); ?> Out of <? echo $recordcount; ?> Records </strong>
                                </tr>
                           
                            <tr>
                           
                                    <td width="88" align="center" bgcolor="#FFFFFF" class="style2">Reference No</td>
                            
                                <td width="149" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
                                <?php 
                            if ($BidderIDstatic == 6734) {
                                ?>
                                 <td width="88" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
                                <?php
                            }
                            ?>
                           
                               
                                    <td width="91" align="center" bgcolor="#FFFFFF" class="style2">Net Salary </td>
                               
                                        <td width="100" align="center" bgcolor="#FFFFFF" class="style2">Company Name </td>
                                   
                                        <td width="90" align="center" bgcolor="#FFFFFF" class="style2">Loan Amount </td>
                                
                                    <td width="130" align="center" bgcolor="#FFFFFF" class="style2">City</td>
                                    <td width="71" align="center" bgcolor="#FFFFFF" class="style2">Feedback</td>
                                
                                
                                    <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Add Comment</td>
                                    
                                    <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Followup Date</td>
                                   
                                    
                               
                                        
                                            <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Call Received</td>
                                            <td width="180" align="center" bgcolor="#FFFFFF" class="style2">Customer Experience</td>
                                            <td width="180" align="center" bgcolor="#FFFFFF" class="style2"></td>
                                
                                    

                            </tr>
                                <?php
                                
                                $maxpage = $recordcount % $pagesize;
					if($recordcount % $pagesize == 0)
					{
						$maxpage = $recordcount / $pagesize;
					}
					else
					{
						$maxpage = ceil($recordcount / $pagesize);
					}
                                    if ($pro_code == 1) {
                                        $feedback_tble = "Req_Feedback_Bidder_PL";
                                    }  else {
                                        $feedback_tble = "Req_Feedback_Bidder1";
                                    }
                                    
                                    $qry = "SELECT " . $getfields . " ";

									/*Code By Rachit Jain 01-07-2017 Start */
									//Code only for LIC Bidders
									$checkLicBidders = getLicBidders($BidderIDstatic);
									if($checkLicBidders){
										$ConsolidatedAccountBidderID = '5788';
										$qry = $qry . " FROM " . $feedback_tble . ",`" . $val . "` LEFT OUTER JOIN Req_Feedback ON (Req_Feedback.AllRequestID=`" . $val . "`.RequestID AND Req_Feedback.BidderID IN ('" . $BidderIDstatic . "', '".$ConsolidatedAccountBidderID."') AND IF(Req_Feedback.last_update_dated != '0000-00-00 00:00:00', Req_Feedback.last_update_dated = (SELECT max(last_update_dated) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID)  $FeedbackClause, Req_Feedback.FeedbackID = (SELECT max(FeedbackID) FROM Req_Feedback RF1 WHERE RF1.AllRequestID = Req_Feedback.AllRequestID) $FeedbackClause))";
									}else{
										$qry = $qry . " FROM " . $feedback_tble . ",`" . $val . "` LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID=`" . $val . "`.RequestID AND Req_Feedback.BidderID = '" . $BidderIDstatic . "' ";
									}
									/*Code By Rachit Jain 01-07-2017 End */

                                    $qry = $qry . " WHERE " . $feedback_tble . ".AllRequestID=`" . $val . "`.RequestID and " . $feedback_tble . ".BidderID = '" . $BidderIDstatic . "' and " . $feedback_tble . ".Reply_Type=" . $pro_code . " and ( " . $feedback_tble . ".Allocation_Date Between '" . ($min_date) . "' and '" . ($max_date) . "' or Req_Feedback.Followup_Date Between '" . ($min_date) . "' and '" . ($max_date) . "') ";
                                }
                                
                               
if($_REQUEST['cmbfeedback']!='All')
             {
              
              if($_REQUEST['cmbfeedback']=='') {
                $qry = $qry . " AND Feedback is NULL";  
              }else{
                $qry = $qry . " AND Feedback='".$_REQUEST['cmbfeedback']."'";                 }
              
             
             } 
								/*Code By Rachit Jain 01-07-2017 Start */
                                //Code only for LIC Bidders
                                $checkLicBidders = getLicBidders($BidderIDstatic);
								if($checkLicBidders){
									$qry = $qry . $mob_num_clause . " " . $refernce_no_clause;
								}
								else{
									$qry = $qry . $FeedbackClause . " " . $mob_num_clause . " " . $refernce_no_clause." ".$CityClause;
								}

								                    
								/*Code By Rachit Jain 01-07-2017 End */
                                $qry = $qry . "group by " . $val . ".Mobile_Number";
                                $qry = $qry . " order by " . $val . ".Dated DESC";
                              echo "<br>";
                                echo $qry = $qry . " LIMIT $startrow, $pagesize";
                                $result = d4l_ExecQuery($qry);
								//echo $qry."<br>";
                                $logfilecontent.="Sql Query: " . $qry . "\n";
                                $logfilecontent.="********************************************************";
                                if ($pro_code == 1) {
                                    $feedback_tble = "Req_Feedback_Bidder_PL";
                                    $leadviewpage = "personalloanlead-details.php";
                                } else {
                                    $feedback_tble = "Req_Feedback_Bidder1";
                                }
								$getParameterVal = min($startrow+$limit,$recordcount) % $limit;
                                $i = 1;
                                if ($recordcount > 0) {
                                    while ($row = d4l_mysql_fetch_array($result)) {
                                        ?>
                                    <input type="hidden" name="requestid_<? echo $i; ?>" id="requestid_<? echo $i; ?>" value="<? echo $row["RequestID"]; ?>">
                                    <input type="hidden" name="product_<? echo $i; ?>" id="product_<? echo $i; ?>" value="<? echo $pro_code; ?>">
                                    <input type="hidden" name="bidderid" id="bidderid" value="<? echo $BidderIDstatic; ?>">
                                    
                                    <tr>
                                        <td align="center" bgcolor="#DFF6FF" class="style3"><? echo "PL" . $row["Feedback_ID"] . "S" . $BidderIDstatic; ?></td>
                                        <td align="center" bgcolor="#DFF6FF" class="style3">
                                            <?
                                            $sqlExclusive = "select  BidderID  from " . $feedback_tble . " where (AllRequestID = '" . $row["RequestID"] . "' and Reply_Type='" . $pro_code . "')";
            $queryExclusive = d4l_ExecQuery($sqlExclusive);
            $numRowsExclusive = d4l_mysql_num_rows($queryExclusive);
            if ($numRowsExclusive == 1) {
                echo '<b style="font:Verdana, Arial, Helvetica, sans-serif; color:#FF0000; font-size:9px;"> [Exclusive Lead] </b><br>';
            }
            ?>
                                            <a href="/<? echo $leadviewpage; ?>?postid=<? echo $row["RequestID"]; ?>&biddt=<? echo $BidderIDstatic; ?>" target="_blank">

                    <? echo $row["Name"]; ?></a></td>
                                        <td align="center" bgcolor="#DFF6FF" class="style3">
                                            <? echo $row["Net_Salary"];  ?>
                                        </td> 
                                        <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Company_Name"]; ?></td>
                                        <td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Loan_Amount"]; ?></td>
                                        <td align="center" bgcolor="#DFF6FF" class="style3"><? 
                                        echo $row["City"];
                                        ?></td> 
                                        <td align="center" bgcolor="#DFF6FF" class="style3"><? echo getJumpMenu("bidders_hdfc_index.php", $row["RequestID"], "1", $row["Feedback"], $pageno, $varmin_date, $varmax_date, $varCmbFeedback, $val, $BidderIDstatic) ?>
					</td>
                                         <td align="center" bgcolor="#DFF6FF" class="bodyarial11" ><table width="100%"><tr><td><textarea  name="comment_section_<? echo $i; ?>" id="comment_section_<? echo $i; ?>" cols="15" rows="2"><? echo $row["comment_section"]; ?></textarea></td><td><a onClick="insertData(<? echo $i; ?>);" style="cursor:pointer; color:blue;" class="style3">Save</a></td></tr></table></td>
                                         <td align="center" bgcolor="#DFF6FF" class="bodyarial11" ><table width="100%"><tr><td><input  name="Followup_Date_<? echo $i; ?>" id="Followup_Date_<? echo $i; ?>" value="<? if($row["Followup_Date"]!='0000-00-00 00:00:00' && $row["Followup_Date"]) {echo date("Y-m-d",strtotime($row["Followup_Date"])); } ?>" placeholder="yyyy-mm-dd" /></td><td><a onClick="FollowupDateSave(<? echo $i; ?>);" style="cursor:pointer; color:blue;" class="style3">Save date</a></td></tr>	</table></td>
<script type="text/javascript">
  $(function() {
         $("#Followup_Date_<? echo $i; ?>").datepicker();
         });//this enable the call to datepicker when click on input field

         $(function() {
            $("#datepicker_<? echo $i; ?>").click(function() {
                $('#Followup_Date_<? echo $i; ?>').datepicker().datepicker( "show" )
            });
        }); 
   </script>
   <td align="center" bgcolor="#DFF6FF" class="bodyarial11" ></td>
   <td align="center" bgcolor="#DFF6FF" class="bodyarial11" ></td>
   <td align="center" bgcolor="#DFF6FF" class="bodyarial11" ><input name="chkCall" value="Call" onclick="checkCall(<? echo $row["RequestID"];?>,<? echo $BidderIDstatic;?>)" type="button"></td>
                                    </tr>
               <?
                $i = $i + 1;
            }
        }
        ?>
    </table>
    <br>
    <table width="758"  border="0" cellpadding="5" cellspacing="1">
    <?
    if ($recordcount > 0) {
        ?>
            <tr>
                <td align="center" class="bluelink">
            <?
            $c = 1;
            for ($c = 1; $c <= $maxpage; $c++) {
                if ($pageno == $c) {
                    echo $c . "&nbsp;";
                } else {
                    ?>
                            <a onClick="javascript:sendmail('<? echo "&id=" . $i . "&pageno=" . $c; ?>')" style="cursor:hand"><? echo $c; ?></a>
                <?
            }
        }
        ?>		</td>
            </tr>
            <?
        }
        ?>
    </table>
    <br>
    <?
?>
</td></tr></table>
</td></tr></table>
<?

function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate, $cmbfeedback, $varVal, $BidderIDstatic) {
    $strURL = "";
    $strURL = $varPHPPage . "?search=y&RequestID=" . $varRequestID . "&type=" . $varType . "&pageno=" . $varpageon . "&min_date=" . urlencode($varmindate) . "&max_date=" . urlencode($varmaxdate) . "&cmbfeedback=" . urlencode($cmbfeedback) . "&product=" . $varVal;
    ?>
    <select name="type" id="type" onChange="MM_jumpMenu('parent', this, 0)" class="style3" style="width:110px;">
        <option value="<? echo $strURL . '&Feedback=' ?>" <? if ($varFeedback == "") {
        echo "selected";
    } ?> >No Feedback</option>
    <?
    if ($BidderIDstatic == 2926 || $BidderIDstatic == 2934 || $BidderIDstatic == 2929 || $BidderIDstatic == 2932 || $BidderIDstatic == 2930 || $BidderIDstatic == 2933 || $BidderIDstatic == 2896 || $BidderIDstatic == 3994 || $BidderIDstatic == 3995 || $BidderIDstatic == 3996 || $BidderIDstatic == 3997 || $BidderIDstatic == 3998 || $BidderIDstatic == 3999) {
        ?>
            <option value="<? echo $strURL . '&Feedback=Not Contactable' ?>" <? if ($varFeedback == "Not Contactable" || $varFeedback == "Ringing" || $varFeedback == "Wrong Number" || $varFeedback == "Not Available") {
            echo "selected";
        } ?>>Not Contactable</option>
            <option value="<? echo $strURL . '&Feedback=Login' ?>" <? if ($varFeedback == "Process" || $varFeedback == "Login") {
            echo "selected";
        } ?>>Login</option>
            <option value="<? echo $strURL . '&Feedback=Disbursed' ?>" <? if ($varFeedback == "Closed" || $varFeedback == "Disbursed") {
            echo "selected";
        } ?>>Disbursed</option>
            <option value="<? echo $strURL . '&Feedback=Not Interested' ?>" <? if ($varFeedback == "Not Interested" || $varFeedback == "Roi issue") {
            echo "selected";
        } ?>>Not Interested</option>
            <option value="<? echo $strURL . '&Feedback=Documents Pick' ?>" <? if ($varFeedback == "Appointment" || $varFeedback == "Documents Pick") {
            echo "selected";
        } ?>>Appointment</option>
            <option value="<? echo $strURL . '&Feedback=Loan Rejected' ?>" <? if ($varFeedback == "Loan Rejected") {
            echo "selected";
        } ?>>Loan Rejected</option>
            <option value="<? echo $strURL . '&Feedback=Not Eligible' ?>" <? if ($varFeedback == "Not Eligible") {
            echo "selected";
        } ?>>Not Eligible</option>
            <option value="<? echo $strURL . '&Feedback=FollowUp' ?>" <? if ($varFeedback == "FollowUp" || $varFeedback == "Callback Later") {
            echo "selected";
        } ?>>FollowUp</option>

    <?php } else if ($BidderIDstatic == 5344 || $BidderIDstatic == 5345 || $BidderIDstatic == 5346 || $BidderIDstatic == 5347 || $BidderIDstatic == 5348 || $BidderIDstatic == 5349 || $BidderIDstatic == 5350 || $BidderIDstatic == 5351 || $BidderIDstatic == 5352 || $BidderIDstatic == 5353 || $BidderIDstatic == 5354 || $BidderIDstatic == 5355) { ?>

            <option value="<? echo $strURL . '&Feedback=Not Contactable' ?>" <? if ($varFeedback == "Not Contactable" || $varFeedback == "Ringing" || $varFeedback == "Wrong Number" || $varFeedback == "Not Available") {
            echo "selected";
        } ?>>Not Contactable</option>
            <option value="<? echo $strURL . '&Feedback=Login' ?>" <? if ($varFeedback == "Process" || $varFeedback == "Login") {
            echo "selected";
        } ?>>Login</option>
            <option value="<? echo $strURL . '&Feedback=Loan Rejected' ?>" <? if ($varFeedback == "Loan Rejected") {
            echo "selected";
        } ?>>Login Rejected</option>
            <option value="<? echo $strURL . '&Feedback=Interested' ?>" <? if ($varFeedback == "Interested" || $varFeedback == "Roi issue") {
            echo "selected";
        } ?>>Interested</option>
            <option value="<? echo $strURL . '&Feedback=Not Interested' ?>" <? if ($varFeedback == "Not Interested" || $varFeedback == "Roi issue") {
            echo "selected";
        } ?>>Not Interested</option>
            <option value="<? echo $strURL . '&Feedback=Not Eligible' ?>" <? if ($varFeedback == "Not Eligible") {
            echo "selected";
        } ?>>Not Eligible</option>
            <option value="<? echo $strURL . '&Feedback=FollowUp' ?>" <? if ($varFeedback == "FollowUp") {
            echo "selected";
        } ?>>FollowUp</option>
            <option value="<? echo $strURL . '&Feedback=Callback Later' ?>" <? if ($varFeedback == "Callback Later") {
            echo "selected";
        } ?>>Callback Later</option>
            <option value="<? echo $strURL . '&Feedback=Appointment' ?>" <? if ($varFeedback == "Appointment" || $varFeedback == "Documents Pick") {
            echo "selected";
        } ?>>Appointment</option>
            <option value="<? echo $strURL . '&Feedback=Approved' ?>" <? if ($varFeedback == "Approved") {
            echo "selected";
        } ?>>Approved</option>
            <option value="<? echo $strURL . '&Feedback=Disbursed' ?>" <? if ($varFeedback == "Closed" || $varFeedback == "Disbursed") {
            echo "selected";
        } ?>>Disbursed</option>
            <option value="<? echo $strURL . '&Feedback=Documents Pick' ?>" <? if ($varFeedback == "Documents Pick") {
            echo "selected";
        } ?>>Documents Picked</option>
            <option value="<? echo $strURL . '&Feedback=Wrong Number' ?>" <? if ($varFeedback == "Wrong Number") {
            echo "selected";
        } ?>>Wrong Number</option>

        <?php
    } else if ($BidderIDstatic == 4089 || $BidderIDstatic == 4088 || $BidderIDstatic == 4083 || $BidderIDstatic == 4084 || $BidderIDstatic == 4085 || $BidderIDstatic == 4086 || $BidderIDstatic == 4087 || $BidderIDstatic == 4091 || $BidderIDstatic == 4090 || $BidderIDstatic == 4092) {
        ?>
            <option value="<? echo $strURL . '&Feedback=NI -Applied in Competition' ?>" <? if ($varFeedback == "NI -Applied in Competition") {
            echo "selected";
        } ?>>NI -Applied in Competition</option>
            <option value="<? echo $strURL . '&Feedback=Not Eligible' ?>" <? if ($varFeedback == "Not Eligible") {
            echo "selected";
        } ?>>NE - OTHERS</option>
            <option value="<? echo $strURL . '&Feedback=NE OGL' ?>" <? if ($varFeedback == "NE OGL") {
            echo "selected";
        } ?>>NE- OGL</option>
            <option value="<? echo $strURL . '&Feedback=NE DBRReject' ?>" <? if ($varFeedback == "NE DBRReject") {
            echo "selected";
        } ?>>NE- DBR Reject</option>
            <option value="<? echo $strURL . '&Feedback=Documents Pick' ?>" <? if ($varFeedback == "Documents Pick") {
            echo "selected";
        } ?>>Documents Picked</option>
            <option value="<? echo $strURL . '&Feedback=Pre LoginReject' ?>" <? if ($varFeedback == "Pre LoginReject") {
            echo "selected";
        } ?>>Pre Login Reject</option>
            <option value="<? echo $strURL . '&Feedback=Loan Rejected' ?>" <? if ($varFeedback == "Loan Rejected") {
            echo "selected";
        } ?>>Post Login Reject</option>
            <option value="<? echo $strURL . '&Feedback=Appointment' ?>" <? if ($varFeedback == "Appointment") {
            echo "selected";
        } ?>>Appointment</option>
            <option value="<? echo $strURL . '&Feedback=Approved' ?>" <? if ($varFeedback == "Approved") {
            echo "selected";
        } ?>>Approved</option>
            <option value="<? echo $strURL . '&Feedback=Disbursed' ?>" <? if ($varFeedback == "Disbursed") {
            echo "selected";
        } ?>>Disbursed</option>
            <option value="<? echo $strURL . '&Feedback=Callback Later' ?>" <? if ($varFeedback == "Callback Later") {
            echo "selected";
        } ?>>Callback Later</option>
            <option value="<? echo $strURL . '&Feedback=Ringing' ?>" <? if ($varFeedback == "Ringing") {
            echo "selected";
        } ?>>Ringing</option>
            <option value="<? echo $strURL . '&Feedback=FollowUp' ?>" <? if ($varFeedback == "FollowUp") {
            echo "selected";
        } ?>>FollowUp</option>
            <option value="<? echo $strURL . '&Feedback=Not Interested' ?>" <? if ($varFeedback == "Not Interested") {
            echo "selected";
        } ?>>NI- No requirement</option>
            <option value="<? echo $strURL . '&Feedback=NI due to Loan Amt' ?>" <? if ($varFeedback == "NI due to Loan Amt") {
            echo "selected";
        } ?>>NI due to Loan Amt</option>
            <option value="<? echo $strURL . '&Feedback=NI due to RateOFFER' ?>" <? if ($varFeedback == "NI due to RateOFFER") {
            echo "selected";
        } ?>>NI due to RateOFFER</option>
            <option value="<? echo $strURL . '&Feedback=Login' ?>" <? if ($varFeedback == "Login") {
            echo "selected";
        } ?>>Login|WIP</option>
        <?php
    } else if ($BidderIDstatic == 6391 || $BidderIDstatic == 6452 || $BidderIDstatic == 6492) {
        ?>
            <option value="<? echo $strURL . '&Feedback=Disbursed' ?>" <? if ($varFeedback == "Disbursed") {
            echo "selected";
        } ?>>Disbursed</option>
            <option value="<? echo $strURL . '&Feedback=Login' ?>" <? if ($varFeedback == "Login") {
            echo "selected";
        } ?>>Login</option>
            <option value="<? echo $strURL . '&Feedback=Sanctioned' ?>" <? if ($varFeedback == "Sanctioned") {
            echo "selected";
        } ?>>Sanctioned</option>
            <option value="<? echo $strURL . '&Feedback=Docs Picked' ?>" <? if ($varFeedback == "Docs Picked") {
            echo "selected";
        } ?>>Docs Picked</option>
            <option value="<? echo $strURL . '&Feedback=Appointment' ?>" <? if ($varFeedback == "Appointment") {
            echo "selected";
        } ?>>Appointment</option>
            <option value="<? echo $strURL . '&Feedback=HOT Lead' ?>" <? if ($varFeedback == "HOT Lead") {
            echo "selected";
        } ?>>HOT Lead</option>
            <option value="<? echo $strURL . '&Feedback=COLD Lead' ?>" <? if ($varFeedback == "COLD Lead") {
            echo "selected";
        } ?>>COLD Lead</option>
            <option value="<? echo $strURL . '&Feedback=NI - ROI / Fee issue' ?>" <? if ($varFeedback == "NI - ROI / Fee issue") {
            echo "selected";
        } ?>>NI - ROI / Fee issue</option>
            <option value="<? echo $strURL . '&Feedback=NI - Plan Changed' ?>" <? if ($varFeedback == "NI - Plan Changed") {
            echo "selected";
        } ?>>NI - Plan Changed</option>
            <option value="<? echo $strURL . '&Feedback=NE - Income' ?>" <? if ($varFeedback == "NE - Income") {
            echo "selected";
        } ?>>NE - Income</option>
            <option value="<? echo $strURL . '&Feedback=NE - Property' ?>" <? if ($varFeedback == "NE - Property") {
            echo "selected";
        } ?>>NE - Property</option>
            <option value="<? echo $strURL . '&Feedback=Ringing' ?>" <? if ($varFeedback == "Ringing") {
            echo "selected";
        } ?>>Ringing</option> 
        <? if ($BidderIDstatic == 6492) { ?>
                <option value="<? echo $strURL . '&Feedback=Send for CIBIL' ?>" <? if ($varFeedback == "Send for CIBIL") {
                echo "selected";
            } ?>>Send for CIBIL</option> 
            <?
        }
        ?>
    <?
    } else {
        if ($BidderIDstatic == 2998 || $BidderIDstatic == 2999 || $BidderIDstatic == 3000 || $BidderIDstatic == 3001 || $BidderIDstatic == 3002 || $BidderIDstatic == 3003 || $BidderIDstatic == 3004 || $BidderIDstatic == 3005 || $BidderIDstatic == 3006 || $BidderIDstatic == 3007 || $BidderIDstatic == 3008 || $BidderIDstatic == 3009 || $BidderIDstatic == 3010 || $BidderIDstatic == 3011 || $BidderIDstatic == 3012 || $BidderIDstatic == 3013 || $BidderIDstatic == 3014 || $BidderIDstatic == 3015 || $BidderIDstatic == 5920) {
            ?> 
                <option value="<? echo $strURL . '&Feedback=Login' ?>" <? if ($varFeedback == "Login") {
                echo "selected";
            } ?>>Login</option>
                <option value="<? echo $strURL . '&Feedback=Closed' ?>" <? if ($varFeedback == "Closed") {
                echo "selected";
            } ?>>Disbursed</option>
                <option value="<? echo $strURL . '&Feedback=Not Contactable' ?>" <? if ($varFeedback == "Not Contactable") {
                echo "selected";
            } ?>>Not Contactable</option>
        <?
        } else if ($BidderIDstatic == 5633) {
            ?>
                <option value="<? echo $strURL . '&Feedback=Process' ?>" <? if ($varFeedback == "Process") {
                echo "selected";
            } ?>>Cibil ok </option>
                <option value="<? echo $strURL . '&Feedback=Closed' ?>" <? if ($varFeedback == "Closed") {
                echo "selected";
            } ?>>Cibil Reject</option>
                <option value="<? echo $strURL . '&Feedback=Not Available' ?>" <? if ($varFeedback == "Not Available") {
                echo "selected";
            } ?>>Not Available</option>
                <option value="<? echo $strURL . '&Feedback=Ringing' ?>" <? if ($varFeedback == "Ringing") {
                echo "selected";
            } ?>>Ringing</option>
            <?php
        } else {
            if ($BidderIDstatic == 5752 || $BidderIDstatic == 5753 || $BidderIDstatic == 5754 || $BidderIDstatic == 5755 || $BidderIDstatic == 5756 || $BidderIDstatic == 5757 || $BidderIDstatic == 5758 || $BidderIDstatic == 5759 || $BidderIDstatic == 5760 || $BidderIDstatic == 5761 || $BidderIDstatic == 5762 || $BidderIDstatic == 5763 || $BidderIDstatic == 5764 || $BidderIDstatic == 5765 || $BidderIDstatic == 5766 || $BidderIDstatic == 5767 || $BidderIDstatic == 5768 || $BidderIDstatic == 5769 || $BidderIDstatic == 5770 || $BidderIDstatic == 5771 || $BidderIDstatic == 5772 || $BidderIDstatic == 5773 || $BidderIDstatic == 5774 || $BidderIDstatic == 5775 || $BidderIDstatic == 5776 || $BidderIDstatic == 5777 || $BidderIDstatic == 5778 || $BidderIDstatic == 5779 || $BidderIDstatic == 5780 || $BidderIDstatic == 5781 || $BidderIDstatic == 5782 || $BidderIDstatic == 5783 || $BidderIDstatic == 5784 || $BidderIDstatic == 5785 || $BidderIDstatic == 5786 || $BidderIDstatic == 5787 || $BidderIDstatic == 5788) {
                ?>
                    <option value="<? echo $strURL . '&Feedback=Process' ?>" <? if ($varFeedback == "Process") {
                    echo "selected";
                } ?>>Process</option>
                    <option value="<? echo $strURL . '&Feedback=Closed' ?>" <? if ($varFeedback == "Closed") {
                    echo "selected";
                } ?>>Disbursed</option>	
                    <option value="<? echo $strURL . '&Feedback=Ringing' ?>" <? if ($varFeedback == "Ringing") {
                    echo "selected";
                } ?>>Ringing</option>
            <?
            } elseif ($BidderIDstatic == 6095 || $BidderIDstatic == 6150 || $BidderIDstatic == 6121 || $BidderIDstatic == 6122 || $BidderIDstatic == 6123 || $BidderIDstatic == 6124 || $BidderIDstatic == 6125 || $BidderIDstatic == 6126 || $BidderIDstatic == 6127 || $BidderIDstatic == 6128 || $BidderIDstatic == 6129 || $BidderIDstatic == 6130 || $BidderIDstatic == 6131 || $BidderIDstatic == 6132 || $BidderIDstatic == 6133 || $BidderIDstatic == 6134 || $BidderIDstatic == 6135 || $BidderIDstatic == 6136 || $BidderIDstatic == 6137 || $BidderIDstatic == 6138 || $BidderIDstatic == 6139 || $BidderIDstatic == 6140 || $BidderIDstatic == 6141 || $BidderIDstatic == 6142 || $BidderIDstatic == 6143 || $BidderIDstatic == 6144 || $BidderIDstatic == 6144) {
                ?>
                    <option value="<? echo $strURL . '&Feedback=Login' ?>" <? if ($varFeedback == "Login") {
                    echo "selected";
                } ?>>Login</option>
                    <option value="<? echo $strURL . '&Feedback=Ringing' ?>" <? if ($varFeedback == "Ringing") {
                    echo "selected";
                } ?>>Ringing</option>
                    <option value="<? echo $strURL . '&Feedback=Sanctioned' ?>" <? if ($varFeedback == "Sanctioned") {
                    echo "selected";
                } ?>>Sanctioned</option>
                    <option value="<? echo $strURL . '&Feedback=Disbursed' ?>" <? if ($varFeedback == "Disbursed") {
                    echo "selected";
                } ?>>Disbursed</option>	
            <?
            } else {
                ?>
                    <option value="<? echo $strURL . '&Feedback=Process' ?>" <? if ($varFeedback == "Process") {
                    echo "selected";
                } ?>>Process</option>
                    <option value="<? echo $strURL . '&Feedback=Closed' ?>" <? if ($varFeedback == "Closed") {
                    echo "selected";
                } ?>>Closed</option>
                    <option value="<? echo $strURL . '&Feedback=Not Available' ?>" <? if ($varFeedback == "Not Available") {
                    echo "selected";
                } ?>>Not Available</option>
                    <option value="<? echo $strURL . '&Feedback=Ringing' ?>" <? if ($varFeedback == "Ringing") {
                    echo "selected";
                } ?>>Ringing</option>
            <? }
        }
        ?>
        <?
        $checkLicBidders = getLicBidders($BidderIDstatic);
		if($checkLicBidders){
        ?>
        <option value="<? echo $strURL . '&Feedback=Property Not Identified' ?>" <? if ($varFeedback == "Property Not Identified") {
            echo "selected";
        } ?>>Property Not Identified</option>
        <?
		}
        ?>
            <option value="<? echo $strURL . '&Feedback=Not Eligible' ?>" <? if ($varFeedback == "Not Eligible") {
            echo "selected";
        } ?>>Not Eligible</option>
            <option value="<? echo $strURL . '&Feedback=Not Interested' ?>" <? if ($varFeedback == "Not Interested") {
            echo "selected";
        } ?>>Not Interested</option>
            <option value="<? echo $strURL . '&Feedback=Callback Later' ?>" <? if ($varFeedback == "Callback Later") {
            echo "selected";
        } ?>>Callback Later</option>
            <option value="<? echo $strURL . '&Feedback=Wrong Number' ?>" <? if ($varFeedback == "Wrong Number") {
            echo "selected";
        } ?>>Wrong Number</option>
            <option value="<? echo $strURL . '&Feedback=FollowUp' ?>" <? if ($varFeedback == "FollowUp") {
            echo "selected";
        } ?>>FollowUp</option>

            <option value="<? echo $strURL . '&Feedback=Documents Pick' ?>" <? if ($varFeedback == "Documents Pick") {
            echo "selected";
        } ?>>Documents Pick</option>
            <option value="<? echo $strURL . '&Feedback=Loan Rejected' ?>" <? if ($varFeedback == "Loan Rejected") {
            echo "selected";
        } ?>>Loan Rejected</option>
            <option value="<? echo $strURL . '&Feedback=Appointment' ?>" <? if ($varFeedback == "Appointment") {
            echo "selected";
        } ?>>Appointment</option>
        <?
        if ($BidderIDstatic == 2896 || $BidderIDstatic == 2923 || $BidderIDstatic == 2924 || $BidderIDstatic == 2925 || $BidderIDstatic == 2926 || $BidderIDstatic == 2927 || $BidderIDstatic == 2929 || $BidderIDstatic == 2930 || $BidderIDstatic == 2931 || $BidderIDstatic == 2932 || $BidderIDstatic == 2933 || $BidderIDstatic == 2934 || $BidderIDstatic == 3994 || $BidderIDstatic == 3995 || $BidderIDstatic == 3996 || $BidderIDstatic == 3997 || $BidderIDstatic == 3998 || $BidderIDstatic == 3999) {
            ?>
                <option value="<? echo $strURL . '&Feedback=Roi issue' ?>" <? if ($varFeedback == "Roi issue") {
                echo "selected";
            } ?>>Roi issue</option>
                <option value="<? echo $strURL . '&Feedback=Disbursed' ?>" <? if ($varFeedback == "Disbursed") {
                echo "selected";
            } ?>>Disbursed</option>
        <? } ?>
        <?
        if ($BidderIDstatic == 3179 || $BidderIDstatic == 3183 || $BidderIDstatic == 3184 || $BidderIDstatic == 3185 || $BidderIDstatic == 3186 || $BidderIDstatic == 3187 || $BidderIDstatic == 3188 || $BidderIDstatic == 3189) {
            ?>
                <option value="<? echo $strURL . '&Feedback=Booked' ?>" <? if ($varFeedback == "Booked") {
                echo "selected";
            } ?>>Approved/Booked</option>
        <?
        }
    }
    ?>			
    </select>
    <?
}

//logfile entry
if (ENABLELOGIN == 1) {
    $newFileName = './logfile/' . $pagename . ".txt";
    file_put_contents($newFileName, $logfilecontent, FILE_APPEND);
}

//end of logfile entry
function timeDiff($firstTime, $lastTime) {
    $firstTime = strtotime($firstTime);
    $lastTime = strtotime($lastTime);
    $timeDiff = ($lastTime - $firstTime) / 86400;
    return $timeDiff;
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
    } catch (err) {
    }</script>
        <script type="text/javascript">
            <!--
            //date function complete start here>>>
            nombresMes = Array("","january","february","march","april","may","june","july","august","september","october","november","december");
            var anoInicial = 1900;
            var anoFinal = 2100;
            var ano;
            var mes;
            var dia;
            var campoDeRetorno;
            var titulo;
            function diasDelMes(ano,mes) {
            if ((mes==1)||(mes==3)||(mes==5)||(mes==7)||(mes==8)||(mes==10)||(mes==12)) dias=31
            else if ((mes==4)||(mes==6)||(mes==9)||(mes==11)) dias=31
            else if ((((ano % 100)==0) && ((ano % 400)==0)) || (((ano % 100)!=0) && ((ano % 4)==0))) dias = 29
            else dias = 28;
            return dias;
            };

            function crearSelectorMes(mesActual) {
            var selectorMes = "";
            selectorMes = "<select name='mes' size='1' onChange='javascript:opener.dibujarMes(self.document.Forma1.ano[self.document.Forma1.ano.selectedIndex].value,self.document.Forma1.mes[self.document.Forma1.mes.selectedIndex].value);'>\r\n";
            for (var i=1; i<=12; i++) {
            selectorMes = selectorMes + "  <option value='" + i + "'";
            if (i == mesActual) selectorMes = selectorMes + " selected";
            selectorMes = selectorMes + ">" + nombresMes[i] + "</option>\r\n";
            }
            selectorMes = selectorMes + "</select>\r\n";
            return selectorMes;
            }

            function crearSelectorAno(anoActual) {
            var selectorAno = "";
            selectorAno = "<select name='ano' size='1' onChange='javascript:opener.dibujarMes(self.document.Forma1.ano[self.document.Forma1.ano.selectedIndex].value,self.document.Forma1.mes[self.document.Forma1.mes.selectedIndex].value);'>\r\n";
            for (var i=anoInicial; i<=anoFinal; i++) {
            selectorAno = selectorAno + "  <option value='" + i + "'";
            if (i == anoActual) selectorAno = selectorAno + " selected";
            selectorAno = selectorAno + ">" + i + "</option>\r\n";
            }
            selectorAno = selectorAno + "</select>";
            return selectorAno;
            }

            function crearTablaDias(numeroAno,numeroMes) {
            var tabla = "<table border='0' cellpadding='2' cellspacing='0' bgcolor='#ffffff'>\r\n  <tr>";
            var fechaInicio = new Date();
            fechaInicio.setYear(numeroAno);
            fechaInicio.setMonth(numeroMes-1);
            fechaInicio.setDate(1);
            ajuste = fechaInicio.getDay();
            tabla = tabla + "\r\n <td align='center'>Su</td><td align='center'>Mo</td><td align='center'>Tu</td><td align='center'>We</td><td align='center'>Th</td><td align='center'>Fr</td><td align='center'>Sa</td></div>\r\n  <tr>";
            for (var j=1; j<=ajuste; j++) {
            tabla = tabla + "\r\n <td></td>";
            }
            for (var i=1; i<10; i++) {
            tabla = tabla + "\r\n    <td"
            if ((i == diaHoy()) && (numeroMes == mesHoy()) && (numeroAno == anoHoy())) tabla = tabla + " bgcolor='#ff0000'";
            tabla = tabla + "><input type='button' value='0" + i + "' onClick='javascript:opener.ano=self.document.Forma1.ano[self.document.Forma1.ano.selectedIndex].value; opener.mes=self.document.Forma1.mes[self.document.Forma1.mes.selectedIndex].value; opener.dia=" + i + "; self.close();'></td>";
            if (((i+ajuste) % 7)==0) tabla = tabla + "\r\n  </tr>\r\n\  <tr>";
            }
            for (var i=10; i<=diasDelMes(numeroAno,numeroMes); i++) {
            tabla = tabla + "\r\n    <td"
            if ((i == diaHoy()) && (numeroMes == mesHoy()) && (numeroAno == anoHoy())) tabla = tabla + " bgcolor='#ff0000'";
            tabla = tabla + "><input type='button' value='" + i + "' onClick='javascript:opener.ano=self.document.Forma1.ano[self.document.Forma1.ano.selectedIndex].value; opener.mes=self.document.Forma1.mes[self.document.Forma1.mes.selectedIndex].value; opener.dia=" + i + "; self.close();'></td>";
            if (((i+ajuste) % 7)==0) tabla = tabla + "\r\n  </tr>\r\n\  <tr>";
            }
            tabla = tabla + "\r\n  </tr>\r\n</table>";
            return tabla;
            }

            function dibujarMes(numeroAno,numeroMes) {
            var html = "";
            html = html + "<html>\r\n<head>\r\n  <title>" + titulo + "</title>\r\n</head>\r\n<body bgcolor='#ffffff' onUnload='opener.escribirFecha();'>\r\n  <div align='center'>\r\n  <form name='Forma1'>\r\n";
            html = html + crearSelectorMes(numeroMes);
            html = html + crearSelectorAno(numeroAno);
            html = html + crearTablaDias(numeroAno,numeroMes);
            html = html + "<center><p><input type='button' name='hoy' value='today: " + dia + "/" + mes + "/" + ano + "' onClick='javascript:self.close();'></center>";
            //html = html + "\r\n  </form>\r\n  </div>\r\n</body>\r\n</html>\r\n";
            html = html + "\r\n  </form>\r\n  </div>";
            ventana = open("","calendario","width=360,height=270");
            ventana.document.open();
            ventana.document.writeln(html);
            ventana.document.close();
            ventana.focus();
            }

            function anoHoy() {
            var fecha = new Date();
            if (navigator.appName == "Netscape") return fecha.getYear() + 1900
            else return fecha.getYear();
            }

            function mesHoy() {
            var fecha = new Date();
            return fecha.getMonth()+1;
            }

            function diaHoy() 
            {
            var fecha = new Date();
            return fecha.getDate();
            }

            function pedirFecha(campoTexto,nombreCampo) 
            {
            ano = anoHoy();
            mes = mesHoy();
            dia = diaHoy();
            campoDeRetorno = campoTexto;
            titulo = nombreCampo;
            dibujarMes(ano,mes);
            }

            function escribirFecha() 
            {
            if(dia<10)
            {
            dia="0"+dia;
            }
            if(mes<10)
            {
            mes="0"+mes;
            }
            campoDeRetorno.value = ano + "-" + mes + "-" + dia;
            }

            // date function finish here
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
            document.frmsearch.action="bidders_hdfc_index_131217yash.php?search=y"+gifName;
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

            <?
			if($getLicBidders)
			{
			?>
				if(document.frmsearch.min_date.value<"<? echo $joindate60; ?>")
				{
					alert("Sorry!!!! Your minimum date is <? echo $joindate60; ?>.Please Select.");
					document.frmsearch.min_date.value="";
					document.frmsearch.min_date.focus();
					return false;
				}
			<? 
			}
			else
			{
			?>
				if(document.frmsearch.min_date.value<"<?php echo $joindate; ?>")
				{
					alert("Sorry!!!! Your minimum date is <?php echo $joindate; ?>.Please Select.");
					document.frmsearch.min_date.value="";
					document.frmsearch.min_date.focus();
					return false;
				}
			<?
			}
			?>

            if(document.frmsearch.max_date.value=="")
            {
            alert("Sorry!!!! Please Enter Maximum date.");
            document.frmsearch.max_date.value="";
            document.frmsearch.max_date.focus();
            return false;
            }
            }

            function MM_jumpMenu(targ,selObj,restore){ //v3.0
            //alert( selObj.selectedIndex);
            eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
            if (restore) selObj.selectedIndex=0;
            }

            
            function popitup(url) {
            newwindow=window.open(url,'name','height=280,width=200');
            if (window.focus) {newwindow.focus()}
            return false;
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

            function insertData(id)
            {

            var txt = document.getElementById('comment_section_'+ id).value;
            var re = /^[ A-Za-z0-9(,./#)+-]*$/
            if (re.test(txt)) {
            var get_comment_section = document.getElementById('comment_section_'+ id).value;
            var get_requestid= document.getElementById('requestid_'+ id).value;
            var get_product= document.getElementById('product_'+ id).value;
            var get_bidderid= document.getElementById('bidderid').value;

            var queryString = "?comment_section=" + get_comment_section + "&get_requestid=" + get_requestid + "&get_product=" + get_product + "&get_bidderid=" + get_bidderid;
            //alert(queryString); 
            ajaxRequest.open("GET", "insert_comment_lms.php" + queryString, true);
            // Create a function that will receive data sent from the server
            ajaxRequest.onreadystatechange = function(){
            if(ajaxRequest.readyState == 4)
            {
            if(ajaxRequest.responseText=="insert")
            {
            alert('comment has been saved');
            }
            else
            {
            alert('cant save the comment');
            }
            }
            }
            ajaxRequest.send(null); 
            }else{ 
            alert('please remove Special characters.');
            document.getElementById('comment_section_'+ id).focus();
            return false;
            }
            }

            window.onload = ajaxFunction;
        </script>
    <script type="text/javascript">
    function FollowupDateSave(id)
		{
                    
		var get_requestid= document.getElementById('requestid_'+ id).value;
                
		var get_bidderid= document.getElementById('bidderid').value;
		var get_followup= document.getElementById('Followup_Date_'+ id).value;
                var queryString = "?get_requestid=" + get_requestid + "&get_bidderid=" + get_bidderid + "&get_followup=" + get_followup;
				ajaxRequest.open("GET", "FollowupDateSave.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						if(ajaxRequest.responseText=="insert")
						{
							alert('FollowUp date has been saved');
						}
						else
						{
							alert('Not save the FollowUp date');
						}
					}
				}
				ajaxRequest.send(null); 
		}
    </script>    
</body>
</html>
