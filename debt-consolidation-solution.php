<?php
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

/* Get all the required files and functions */
require_once('helpdesk/hesk_settings.inc.php');
require_once('helpdesk/language/'.$hesk_settings['language'].'.inc.php');
require_once('helpdesk/inc/common.inc.php');
hesk_session_start();



/* Connect to database */
require_once('helpdesk/inc/database.inc.php');
hesk_dbConnect() or hesk_error("$hesklang[cant_connect_db] $hesklang[contact_webmsater] $hesk_settings[webmaster_mail]!");




$trackingID=strtoupper(hesk_input($_GET['track'],$hesklang['trackID_not_found']));


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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>Loan Guru India | Debt Consolidation |Personalized advice from Deal4loans </title>
<meta name="keywords" content="loan guru, debt consolidation,bank loan calculator, bank loan interest rate, loan interest rate in india , loan emi calculator, loan eligibility calculator, credit card query, home loans India, credit cards in india, personal loan emi calculator," />

<meta content="text/html; charset=<?php echo $hesklang['ENCODING']; ?>">
<style type="text/css">
body,p,td {
    color : black;
    font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
    font-size : <?php echo $hesk_settings['print_font_size']; ?>px;
}
</style>
 <link href="includes/style1.css" rel="stylesheet" type="text/css">

<?php include '~Top.php'; ?>
<div id="dvMainbanner">
    <div id="dvbannerContainer"><table width="777" height="161" border="0" Background="images/plain copy.gif" ><tr><td width="30%" align="center"><img src="images/amitojsir.gif"></td><td width="70%" align="left" valign="top"><font style="font-size:20px;font-family:Century Gothic;float:center;" color="FFFFF"><b>Ask Amitoj</b></font><p><font style="font-size:12px;font-family:Arial, Helvetica, sans-serif;" color="FFFFF"><b>Profile :- </b> Masters in Marketing from JBIMS, Amitoj has worked with Citibank
for more than 9 years in the areas of Operations, Credit, Sales and
Marketing. He has more than 4 years of exposure to Personal Loans and more
than 3 years to Credit Cards in the areas of product development,
acquisition channel enhancement and credit underwriting.</p>
</td></tr><tr><td align="center"><font color="FFFFF" style="font-size:12px;font-family:Arial, Helvetica, sans-serif"><b>Amitoj Sethi (Director)</b></font></td><td><font color="FFFFF" style="font-size:18px;font-family:Century Gothic; float:right;" ><b>Loans by choice not by chance!!</b></font></td></tr></table> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
  <div id="dvContentPanel">
    <div id="dvMaincontent">
	 
		<p align="left">


<?php

echo "<table cellpadding=4 cellspacing=0><tr><td>";
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

echo "<h2><b><font color='#0F74D4' face='Century Gothic'>Debt Consolidation Solution from Loan Guru </font></b></h2>";
 
$showmessage = $ticket[view_message];

//echo "<hr>";
//echo "<b>Customer's Query:".$showmessage."</b><br>";
list($First,$Last) = split('Query :', $ticket[view_message]);
echo "<b>Customer's Query:<br/>".$Last."</b><br>";
echo "<b>".$First."</b>";

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
		$bgcolor = "#DDDDDD";
	}
	else
	{
		// if the row number is odd
		$bgcolor = "#CCCCCC";
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
//Start
 $PagingSql = "select * from hesk_show_transcript where 1=1 and TrackFlag = 1";
$PagingQuery = hesk_dbQuery($PagingSql) or hesk_error("$hesklang[cant_sql]: $sql</p><p>$hesklang[mysql_said]:<br>".mysql_error()."</p><p>$hesklang[contact_webmsater] $hesk_settings[webmaster_mail]");

$PagingNumRows = mysql_num_rows($PagingQuery);
 $LastRecord = $PagingNumRows-1;


//End 
echo "<tr><td></td>&nbsp;</tr><tr><td>";
$i=1;
$ShowPageRecord = "";
echo "<p align=center><b>";
			$GetPageNo = $_GET['pageno'];
			$PreviousPageNo = $GetPageNo-1;
			$NextPageNo = $GetPageNo+1; 
			
			
for($i=1;$i<=$PagingNumRows;$i++)
{
	$TrackID = mysql_result($PagingQuery,$i-1,'TrackID');
	$ArrayTrackID[] = $TrackID;
	//$ShowPageNumber = $i+1;
	$pageno = $_GET['pageno'];

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
				$PreviousPage = "<a href='debt-consolidation-solution.php?track=".$ArrayTrackID[$GetPageNo-2]."&pageno=".$PreviousPageNo."'>Prev</a>";
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
				$NextPage = "<a href='debt-consolidation-solution.php?track=".$ArrayTrackID[$GetPageNo]."&pageno=".$NextPageNo."'>Next</a>";
				echo "<b>".$NextPage."</b>";
			}
echo "</td></tr></table></b></p>";
echo "</td></tr></table>";

/*
$PreviousSql = "select * from hesk_show_transcript where HtID='".$PreviousHtID."' and TrackFlag = 1";
$PreviousQuery = hesk_dbQuery($Previoussql) or hesk_error("$hesklang[cant_sql]: $sql</p><p>$hesklang[mysql_said]:<br>".mysql_error()."</p><p>$hesklang[contact_webmsater] $hesk_settings[webmaster_mail]</p>");
*/



?>
</p>
</p>
 </div>

<?
  include '~Right2.php';

  ?>
  </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom.php';?><? } ?>
  </body>
</html>

</body>
</html>
