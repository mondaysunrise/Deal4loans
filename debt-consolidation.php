<?php
header("Location: http://www.deal4loans.com/");
exit();
	require 'scripts/functions.php';
	session_start();

/*******************************************************************************
*  Title: Helpdesk software Hesk
*  Version: 0.94.1 @ October 25, 2007
*  Author: Klemen Stirn
*  Website: http://www.phpjunkyard.com
********************************************************************************
*  COPYRIGHT NOTICE
*  Copyright 2005-2007 Klemen Stirn. All Rights Reserved.
*
*  This script may be used and modified free of charge by anyone
*  AS LONG AS COPYRIGHT NOTICES AND ALL THE COMMENTS REMAIN INTACT.
*  By using this code you agree to indemnify Klemen Stirn from any
*  liability that might arise from it's use.
*
*  Selling the code for this program, in part or full, without prior
*  written consent is expressly forbidden.
*
*  Obtain permission before redistributing this software over the Internet
*  or in any other medium. In all cases copyright and header must remain
*  intact. This Copyright is in full effect in any country that has
*  International Trade Agreements with the United States of America or
*  with the European Union.
*
*  Removing any of the copyright notices without purchasing a license
*  is illegal! To remove PHPJunkyard copyright notice you must purchase a
*  license for this script. For more information on how to obtain a license
*  please visit the site below:
*  http://www.phpjunkyard.com/copyright-removal.php
*******************************************************************************/

define('IN_SCRIPT',1);
$absolutepath = "http://www.deal4loans.com/";

/* Get all the required files and functions */
require_once('helpdesk/hesk_settings.inc.php');
require_once('helpdesk/language/'.$hesk_settings['language'].'.inc.php');
require_once('helpdesk/inc/common.inc.php');
hesk_session_start();



/* Connect to database */
require_once('helpdesk/inc/database.inc.php');
hesk_dbConnect() or hesk_error("$hesklang[cant_connect_db] $hesklang[contact_webmsater] $hesk_settings[webmaster_mail]!");



$trackingID=strtoupper(hesk_input($_GET['loan-guru'],$hesklang['trackID_not_found']));
//$trackingID=strtoupper(hesk_input($_GET['track'],$hesklang['trackID_not_found']));


/* Get ticket info */
$sql = "SELECT * FROM `hesk_tickets` WHERE `trackid`='$trackingID' LIMIT 1";
$result = hesk_dbQuery($sql) or hesk_error("$hesklang[cant_sql]: $sql</p><p>$hesklang[mysql_said]:<br>".mysql_error()."</p><p>$hesklang[contact_webmsater] $hesk_settings[webmaster_mail]");
//$result = mysql_query($sql);
//echo mysql_num_rows($result);
if (hesk_dbNumRows($result) != 1) {hesk_error($hesklang['ticket_not_found']);}

$ticket = hesk_dbFetchAssoc($result);

/* Get category name and ID */
$sql = "SELECT * FROM `hesk_categories` WHERE `id`=$ticket[category] LIMIT 1";
$result = hesk_dbQuery($sql) or hesk_error("$hesklang[cant_sql]: $sql</p><p>$hesklang[mysql_said]:<br>".mysql_error()."</p><p>$hesklang[contact_webmsater] $hesk_settings[webmaster_mail]");
/* If this category has been deleted use the default category with ID 1 */
    if (hesk_dbNumRows($result) != 1)
    {
        $sql = "SELECT * FROM `hesk_categories` WHERE `id`=1 LIMIT 1";
        $result = hesk_dbQuery($sql) or hesk_error("$hesklang[cant_sql]: $sql</p><p>$hesklang[mysql_said]:<br>".mysql_error()."</p><p>$hesklang[contact_webmsater] $hesk_settings[webmaster_mail]");
    }
$category = hesk_dbFetchAssoc($result);

/* Get replies */
$sql = "SELECT * FROM `hesk_replies` WHERE `replyto`='$ticket[id]' ORDER BY `id` ASC";
$result = hesk_dbQuery($sql) or hesk_error("$hesklang[cant_sql]: $sql</p><p>$hesklang[mysql_said]:<br>".mysql_error()."</p><p>$hesklang[contact_webmsater] $hesk_settings[webmaster_mail]");
$replies = hesk_dbNumRows($result);

$Aid = $_GET['ask-amitoj'];
$TitleSql = "select * from hesk_show_transcript where 1=1 and TrackFlag = 1 and HtID= ".$Aid."";
$TitleQuery = hesk_dbQuery($TitleSql);
$TotalTitle = mysql_result($TitleQuery,0,'Subject_Line');
$Title = substr($TotalTitle,0,90);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>debt consolidation Query | Solution Loan Guru | <?php echo $Title;?> </title>
<meta name="keywords" content="debt consolidation, debt consolidation query, debt consolidation solution, debt consolidation cases, debt consolidation requirement, debt consolidation Ask Amitoj" />

<meta content="text/html; charset=<?php echo $hesklang['ENCODING']; ?>">
<meta content="text/html; charset=<?php echo $hesklang['ENCODING']; ?>">
<link href="/style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="/style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="/js/dropdowntabs.js"></script>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="lftbar">
<div class="lfttxtbar">
  <div id="txt">
  <?php
//Start
 $PagingSql = "select * from hesk_show_transcript where 1=1 and TrackFlag = 1";
$PagingQuery = hesk_dbQuery($PagingSql) or hesk_error("$hesklang[cant_sql]: $sql</p><p>$hesklang[mysql_said]:<br>".mysql_error()."</p><p>$hesklang[contact_webmsater] $hesk_settings[webmaster_mail]");

$PagingNumRows = mysql_num_rows($PagingQuery);
 $LastRecord = $PagingNumRows-1;



echo "<h1>Debt Consolidation Solution from Loan Guru</h1>";
echo "<table cellpadding='0' cellspacing='0' width='100%'>";
echo "<tr><td></td>&nbsp;</tr><tr><td>";
$i=1;
$ShowPageRecord = "";
echo "<p align=center><b>";
			$GetPageNo = $_GET['ask-amitoj'];
			$PreviousPageNo = $GetPageNo-1;
			$NextPageNo = $GetPageNo+1; 
			
			
for($i=1;$i<=$PagingNumRows;$i++)
{
	$TrackID = mysql_result($PagingQuery,$i-1,'TrackID');
	$ArrayTrackID[] = $TrackID;
	//$ShowPageNumber = $i+1;
	$pageno = $_GET['ask-amitoj'];

	if($pageno==$i)
	{
	//	echo $i."&nbsp;";
	}
	else		
	{
		$ShowPage = "<a href='debt-consolidation-solution.php?track=".$TrackID."&pageno=".$i."'>".$i."</a>";
		$ShowPageRecord[] = $ShowPage;
		
	}

}
echo "<table border='0' align='center' width='100%'><tr><td align='center'>";
			if($GetPageNo==1)
				echo "<b>Prev</b>";
			else
			{
				$PagePrevious = $ArrayTrackID[$GetPageNo-2];
				//$PreviousPage = "<a href='debt-consolidation-solution.php?track=".$ArrayTrackID[$GetPageNo-2]."&pageno=".$PreviousPageNo."'>Prev</a>";
				$PreviousPage = "<a href='".$absolutepath."debt-consolidation/loan-guru/".$PagePrevious."/ask-amitoj/".$PreviousPageNo."'>Prev</a>";
				echo "<b>".$PreviousPage."</b>";
			}
			echo "</td><td align=center><b>";
			echo $pageno;
			echo "</b></td><td align=center>";
			for($i=0;$i<count($ShowPageRecord);$i++)
			{
				
			//	echo $ShowPageRecord[$i];
			}
			if($GetPageNo==$PagingNumRows)
				echo "<b>Next</b>";
			else
			{
				$PageNext = $ArrayTrackID[$GetPageNo];		
				$NextPage = "<a href='".$absolutepath."debt-consolidation/loan-guru/".$PageNext."/ask-amitoj/".$NextPageNo."'>Next</a>";
				//$NextPage = "<a href='debt-consolidation-solution.php?track=".$ArrayTrackID[$GetPageNo]."&pageno=".$NextPageNo."'>Next</a>";
				echo "<b>".$NextPage."</b>";
			}
echo "</td></tr></table></b></p>";
echo "</td></tr><tr><td>";




/*echo <<<EOC
$hesklang[date]: $ticket[dt]<br>
$hesklang[name]: $ticket[name]<br>
$hesklang[email]: $ticket[email]<br>
$hesklang[ip]: $ticket[ip]<br>

EOC;
*/
/* custom fields */
if ($hesk_settings['use_custom']) {

    foreach ($hesk_settings['custom_fields'] as $k=>$v) {
        if ($v['use']) {echo $v['name'].': '.$ticket[$k].'<br>';}
    }

}

 
$showmessage = $ticket[view_message];

//echo "<hr>";
//echo "<b>Customer's Query:".$showmessage."</b><br>";
list($First,$Last) = split('Query :', $ticket[view_message]);
echo "<b>Customer's Query:</b><br/>".$Last."<br/><br/>";
echo "".$First."";
echo "<hr>";

/*
echo <<<EOC
<b>Query:</b><br>
$ticket[message]

<hr>

EOC;
*/
//echo "</td></tr>";
//echo "<tr><td align=left><b>";
//echo $replies;
//echo "</b></td></tr>";

//while ($reply = hesk_dbFetchAssoc($result))
for($i=0;$i<$replies;$i++)
{
	if ($i%2)
	{
		// if the row number is even
		$bgcolor = "#FFFFFF";
	}
	else
	{
		// if the row number is odd
		$bgcolor = "#FFFFFF";
	}
$replydt = mysql_result($result,$i,'dt');
$replymessage = mysql_result($result,$i,'view_message');
echo "<tr><td align=left bgcolor=".$bgcolor.">";
//echo $hesklang[date].": ".$replydt."<br>";
echo "<br><b>".$hesklang[message].":</b><br>";
echo $replymessage;
echo "<br></td></tr>";
}


?>

<?php
//Code Added By Upendra Dated 21-02-2008


//End 
echo "<tr><td></td>&nbsp;</tr><tr><td>";
$i=1;
$ShowPageRecord = "";
echo "<p align=center><b>";
			$GetPageNo = $_GET['ask-amitoj'];
			$PreviousPageNo = $GetPageNo-1;
			$NextPageNo = $GetPageNo+1; 
			
			
for($i=1;$i<=$PagingNumRows;$i++)
{
	$TrackID = mysql_result($PagingQuery,$i-1,'TrackID');
	$ArrayTrackID[] = $TrackID;
	//$ShowPageNumber = $i+1;
	$pageno = $_GET['ask-amitoj'];

	if($pageno==$i)
	{
	//	echo $i."&nbsp;";
	}
	else		
	{
		$ShowPage = "<a href='debt-consolidation-solution.php?track=".$TrackID."&pageno=".$i."'>".$i."</a>";
		$ShowPageRecord[] = $ShowPage;
		
	}

}
echo "<table border=0 align=center width=90%><tr><td align=center>";
			if($GetPageNo==1)
				echo "<b>Prev</b>";
			else
			{
				$PagePrevious = $ArrayTrackID[$GetPageNo-2];
				//$PreviousPage = "<a href='debt-consolidation-solution.php?track=".$ArrayTrackID[$GetPageNo-2]."&pageno=".$PreviousPageNo."'>Prev</a>";
				$PreviousPage = "<a href='".$absolutepath."debt-consolidation/loan-guru/".$PagePrevious."/ask-amitoj/".$PreviousPageNo."'>Prev</a>";
				echo "<b>".$PreviousPage."</b>";
			}
			echo "</td><td align=center><b>";
			echo $pageno;
			echo "</b></td><td align=center>";
			for($i=0;$i<count($ShowPageRecord);$i++)
			{
				
			//	echo $ShowPageRecord[$i];
			}
			if($GetPageNo==$PagingNumRows)
				echo "<b>Next</b>";
			else
			{
				$PageNext = $ArrayTrackID[$GetPageNo];		
				$NextPage = "<a href='".$absolutepath."debt-consolidation/loan-guru/".$PageNext."/ask-amitoj/".$NextPageNo."'>Next</a>";
				//$NextPage = "<a href='debt-consolidation-solution.php?track=".$ArrayTrackID[$GetPageNo]."&pageno=".$NextPageNo."'>Next</a>";
				echo "<b>".$NextPage."</b>";
			}
echo "</td></tr></table></b></p>";
echo "</td></tr></table>";

/*
$PreviousSql = "select * from hesk_show_transcript where HtID='".$PreviousHtID."' and TrackFlag = 1";
$PreviousQuery = hesk_dbQuery($Previoussql) or hesk_error("$hesklang[cant_sql]: $sql</p><p>$hesklang[mysql_said]:<br>".mysql_error()."</p><p>$hesklang[contact_webmsater] $hesk_settings[webmaster_mail]</p>");
*/



?>

       </div></div>
    <div align="right"><a href="#pg_up">Top<img width="12" height="18" border="0" src="/new-images/top.gif" alt="Top"/></a></div>
	</div> 
<? include '~Right-new2.php';  ?>
  <?php include '~Bottom-new.php';?>
</div></body>
</html>