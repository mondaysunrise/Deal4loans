<?php
require 'scripts/session_check_online.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

//Get All Source Code except superadmin
$getSourceCodeSql = "SELECT BidderID,Profile FROM Bidders WHERE leadidentifier = 'sbidocslms' AND Selection_Category != 2";
$getSourceCodeResult = d4l_ExecQuery($getSourceCodeSql);
while($getSourceCodeResponse = d4l_mysql_fetch_assoc($getSourceCodeResult))
{
	$SourceCodeArr[] = $getSourceCodeResponse['Profile'];
	$BidderIDArr[] = $getSourceCodeResponse['BidderID'];
}

$BidderIDstatic="";
if(isset($_REQUEST['BidderIDstatic']) && !empty($_REQUEST['BidderIDstatic']))
{
	 $BidderIDstatic=$_REQUEST['BidderIDstatic'];
}
else
{
	$BidderIDstatic=$_SESSION['BidderID'];
}

$source_code = "";
if(isset($_REQUEST['source_code']) && !empty($_REQUEST['source_code']))
{
	$source_code=$_REQUEST['source_code'];
	
	if($source_code == 'All'){
		$source_code = implode("','", $SourceCodeArr);
	}
}
else
{
	$source_code=$_SESSION['Profile'];
}

$search="";
if(isset($_REQUEST['search']))
{
	$search = $_REQUEST['search'];
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

//Paging
$pagesize=25;
$startrow=0;

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


//Check if superadmin Login
$checkSuperAdminSql = "SELECT * FROM `Bidders` WHERE BidderID = '".$BidderIDstatic."' AND leadidentifier = 'sbidocslms' AND Selection_Category = 2";
$checkSuperAdminResult = d4l_ExecQuery($checkSuperAdminSql);
$checkSuperAdminRows = d4l_mysql_num_rows($checkSuperAdminResult);

?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body{ background:#45B2D8;}
.lead-d4l-logo{ float:left; margin-left:2%; margin-top:25px;}
.wrapper-leads{width:63%; margin:2px auto; padding:10px 10px 10px 20px; background:#FFF; border-radius:10px;}
.input-lead{ border-radius:5px; width:150px; border:thin solid #CCC; height:22px;}
hr{ border-top:thin solid #CCC;}
.welcometext{ font-size:24px; color:#FFF; font-family:Arial, Helvetica, sans-serif;}
.heading-lead{ font-size:16px; text-align:left; color:#084459; font-family:Arial, Helvetica, sans-serif;}
.div-lead-left{ float:left; width:336px;}
.div-lead-left-small{ float:left; width:250px;}
.div-lead-left-smallest{ float:left; width:300px;}

.div-lead-left-button{ float:left; width:100px; margin-top:-5px;}
.div-lead-left-big{float:left; width:387px;}
</style>
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
	font-size: 14px;
	font-weight: bold;
	color:#084459;
}
.style3 {
	font-family: verdana;
	font-size: 13px;
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
p{ margin-top:2px; margin-bottom:2px;}
</style>
<!--DatePicker Start-->
<link rel="stylesheet" type="text/css" href="/callinglms/css-datepicker/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="/callinglms/css-datepicker/datepicker.css">
<script src="/callinglms/js-datepicker/jquery-1.5.1.js"></script>
<script src="/callinglms/js-datepicker/jquery.ui.core.js"></script>
<script src="/callinglms/js-datepicker/jquery.ui.datepicker.js"></script>
<script> 
	$(function() {
		var dates = $( "#min_date, #max_date" ).datepicker({
			defaultDate: "-1d",
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
</script>
<script type="text/JavaScript">		

function pagingdata(form)
{
	var gifName = form;
	document.frmsearch.action="sbi_docs_index.php?search=y"+gifName;
	document.frmsearch.submit();
}

function chkform()
{
	if(document.frmsearch.min_date.value=="")
	{
		alert("Sorry!!!! Please Enter Minimum date.");
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
	return true;
}

</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="323" height="93" align="left" valign="top">
			<img src="http://www.deal4loans.com/images/login-logo.gif" width="323" height="93" />
		</td>
		<td align="left" valign="top" style="color:#0B6FCC;" >
			<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#0A92C0">
				<tr>
					<td height="67" align="right" valign="middle" bgcolor="#C8E3F3" style="padding-right:10px;">
						<table border="0" align="right" cellpadding="0" cellspacing="0" bgcolor="#0A92C0">
							<tr>
								<td width="6" height="32" align="left" valign="top">
									<img  src="http://www.deal4loans.com/images/login-form-logut-lft.gif" width="6" height="32" />
								</td>
								<td background="http://www.deal4loans.com/images/login-form-logut-bg.gif" style=" background-repeat:repeat-x; height:32px;">
									<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
											<td align="left" valign="middle" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;" > Welcome <?php echo $_SESSION["UName"]; ?></td>
											<td align="left" style="padding-right:2px;" width="22">
												<img src="http://www.deal4loans.com/images/login-logut-btn.gif" />
											</td>
											<td align="right" class="style1" style="color:#FFFFFF; font-weight:bold;">
												<div align="right" class="style1" style="color:#FFFFFF; font-weight:bold;">
													<a href="sbidocumentlogout.php" style="color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;">Logout</a>
												</div>
											</td>
										</tr>
									</table>
								</td>
								<td width="6" height="32">
									<img src="http://www.deal4loans.com/images/login-form-logut-rgt.gif" width="6" height="32" />
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
	<tr>
    <td align="center">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
			<!--<tr>
				<td style="padding-top:5px; font-size:13px;">&nbsp;&nbsp; <a  href="/change_lms_pwd.php" target="_blank" style="color:#FFFFFF;"><b>Change Password</b></a></td>
			</tr>-->
			<?php 
			if($checkSuperAdminRows){
			?>
			<tr>
				<td style="padding-top:5px; font-size:13px;">&nbsp;&nbsp; <a  href="sbi-admin-credentials.php" target="_blank" style="color:#FFFFFF;"><b>SBI Credentials</b></a></td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td style="padding-top:10px;">
					<table  width="750" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >
						<tr>
							<td width="646"  align="left" valign="top" bgcolor="#FFFFFF" style="background-repeat:no-repeat;" >
								<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
								  <tr>
										<td height="20" align="center">
											<h1 style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Welcome to Deal4Loans LMS</h1>
										</td>
								  </tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<form name="frmsearch" action="sbi_docs_index.php?search=y" method="post" onSubmit="return chkform();">
						<input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $BidderIDstatic;?>">
						<div class="wrapper-leads">
							<p class="heading-lead"><strong>Select date range</strong></p>
							<div class="div-lead-left">
								<table width="80%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td width="30%" class="style1">From</td>
									<td width="50%">
										<input name="min_date" class="input-lead" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>">
									</td>
								  </tr>
								</table>
							</div>
							<div class="div-lead-left">
								<table width="80%" border="0" cellspacing="0" cellpadding="0">
								  <tr>
									<td width="30%" class="style1">To</td>
									<td width="50%"><input name="max_date" class="input-lead" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
								  </tr>
								</table>
							</div>
							<div style="clear:both;"></div>
							<hr>
							<?php 
							if($checkSuperAdminRows){
							?>
							<p class="heading-lead"><strong>Add Filter</strong></p>
							<div class="div-lead-left-small">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td width="47%" class="style1">Source Code</td>
										<td width="53%">
											<select name="source_code" class="input-lead" id="source_code">
												<option value="All">All</option>
												<?
												foreach($SourceCodeArr as $val)
												{
												?>
													<option value="<?php echo $val; ?>" <? if($val == $source_code) {echo "Selected";} ?>><?php echo $val; ?></option>
												<? 
												}
												?>
											</select>
										</td>
									</tr>
								</table>
							</div>
							<div style="clear:both;"></div>
							<hr>
							<p class="heading-lead"><strong>Search</strong></p>
							<?php
							}
							?>
							<div class="div-lead-left-button">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td class="style1"><input name="Submit" type="image" src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0">
										</td>
									</tr>
								</table>
							</div>
							<div style="clear:both;"></div>
						</div>
					</form>
				</td>
			</tr>
		</table>
<?

if($search=="y")
{
	/*
	if($mob_num>0)
	{
		$mob_num_clause = " AND `".$val."`.Mobile_Number = '".$mob_num."' ";
	}
	*/
?>
		<p class="bodyarial11"><?=$Msg?></p>
		<table width="950" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF" >
	<? 

	$qry="SELECT sd.RequestID, sd.source_code, rcc.Name, rcc.Mobile_Number, rcc.City, rcc.Employment_Status, scc.LeadRefNumber FROM sbi_documents as sd LEFT JOIN Req_Credit_Card as rcc ON(rcc.RequestID = sd.RequestID) JOIN sbi_credit_card_5633 as scc ON(scc.RequestID = rcc.RequestID) WHERE source_code IN ('".$source_code."') AND DATE(created_date) BETWEEN '".$min_date."' AND '".$max_date."' GROUP BY RequestID";
	$result=d4l_ExecQuery($qry);
	$recordcount = d4l_mysql_num_rows($result);
	?>
			<tr>
				<td colspan="11" style="border-bottom:1px solid #45B2D8;"><strong><? echo $startrow+1; ?> to <? echo min($startrow+$pagesize,$recordcount); ?> Out of <? echo $recordcount; ?> Records </strong>
			</tr>	
			<tr>
				<td width="50" align="center" bgcolor="#FFFFFF" class="style2">S.No.</td>
				<td width="150" align="center" bgcolor="#FFFFFF" class="style2">LeadRefNumber</td>
				<td width="150" align="center" bgcolor="#FFFFFF" class="style2">Name</td>
				<td width="100" align="center" bgcolor="#FFFFFF" class="style2">Mobile</td>
				<td width="100" align="center" bgcolor="#FFFFFF" class="style2">City</td>     
				<td width="100" align="center" bgcolor="#FFFFFF" class="style2">Occupation </td>
				<td width="150" align="center" bgcolor="#FFFFFF" class="style2">Details</td>
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

	$qry.= " ORDER BY created_date DESC LIMIT $startrow,$pagesize";
	//echo $qry;
	$result=d4l_ExecQuery($qry);

	$i=1;
	if($recordcount>0)
	{
		while($row=d4l_mysql_fetch_array($result))
		{
	?>
			<tr>
				<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $i; ?></td>
				<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["LeadRefNumber"]; ?></td>
				<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["Name"]; ?></td>     
				<td align="center" bgcolor="#DFF6FF" class="style3"><? echo ccMasking($row["Mobile_Number"]); ?></td>
				<td align="center" bgcolor="#DFF6FF" class="style3"><? echo $row["City"]; ?></td>
				<td align="center" bgcolor="#DFF6FF" class="style3"><? if($row["Employment_Status"]==1) { echo "Salaried";} else { echo "Self Employed";} ?></td>
				<td align="center" bgcolor="#DFF6FF" class="style3"><a href="/sbi-documents-details.php?reqid=<? echo $row["RequestID"]; ?>&biddt=<? echo $BidderIDstatic; ?>" target="_blank">View Details</a></td>
			</tr>
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
					<a onClick="javascript:pagingdata('<? echo "&id=".$i."&pageno=".$c; ?>')" style="cursor:hand"><? echo $c; ?></a>
				<?
				}
			} 
			?>
			</td>
		</tr>
		<? 
		}
		?>
		</table>
		<br>
<? 
}
?>
</td></tr></table>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
	var pageTracker = _gat._getTracker("UA-1312775-1");
	pageTracker._trackPageview();
} catch(err) {}
</script>
</body>
</html>
<?php
function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

?>
