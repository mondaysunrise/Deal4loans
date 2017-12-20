<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init_bima.php';
	require 'scripts/functions.php';
	function appendzero($number, $digits=2)	{  $output = str_pad($number, $digits, "0", STR_PAD_LEFT);	   return $output;	} 
	
	$day="";
	if(isset($_REQUEST['day']))
	{
		$day=$_REQUEST['day'];
	}
	$month="";
	if(isset($_REQUEST['month']))
	{
		$month=$_REQUEST['month'];
	}
	$year="";
	if(isset($_REQUEST['year']))
	{
		$year = $_REQUEST['year'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Life Insurance MIS Report</title>
<style type="text/css">
.data_text_a{ font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333;}
.data_text_b{ font-family:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold; color:#C33;}
.data_text_c{ font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#6C6; font-weight: bold;}
table{border:0px solid #CCC; margin:0px 0px 0px 0px; padding:0px 0px 0px 0px;} 
.bidderclass {Font-family:Comic Sans MS;font-size:13px;}
.style1 {	font-family: verdana;	font-size: 12px;	font-weight: bold;	color:#084459;}
.style2 {	font-family: verdana;	font-size: 11px;	font-weight: bold;	color:#084459;}
.style3 {	font-family: verdana;	font-size: 11px;	font-weight: normal;	color:#084459;	text-decoration:none;}
.bluebtn{font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold;color:#084459;border:1px solid #084459;background-color:#FFFFFF;}
.buttonfordate {	font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 11px;	color: #FFFFFF;	background-color: #45B2D8;	border: 1px solid #45B2D8;	font-weight: bold;}
</style>

</head>
<body>
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}

include "mishead.php";
?>


<table width="100%" border="0" cellspacing="2" cellpadding="2">
<tr>
    <td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold;">
Life Insurance</td></tr>
  <tr>
    <td align="center">
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border:#0033CC 1px solid;">
   <tr>
     <td height="30" align="center" valign="middle"><img src="images/login-srch-pnl.gif" width="650" height="30"></td>
   </tr>
   <tr>
     <td align="center" valign="middle" background="images/login-form-login-bg.gif"><table width="95%" border="0"  cellpadding="1" cellspacing="0">
 <form name="frmsearch" action="li_mis_report.php?search=y" method="post" >
   <tr><td colspan="3">&nbsp;</td></tr>

   <tr>
   <td colspan="3" align="center">
   <table border="0" width="90%" cellpadding="0" cellspacing="0"><tr>
     <td width="25%" valign="middle" class="style1">&nbsp;&nbsp;Date&nbsp;&nbsp;  </td>
     <td width="12%" align="left" valign="middle" class="bidderclass">
	 
	 <?php
	
	 $currDate = date("j");
	  echo "<select name='day'>";
	 echo "<option value=''>Select</option>";
	 $selected = "";
for($i=1;$i<=31;$i++)
{
 $selected = "";
	if($_GET['search']!='y')
	{
		if($i==$currDate) $selected = "selected";
	}
	else
	{
		if($i==$day ) $selected = "selected";
	}
	echo "<option value='".$i."' ".$selected.">&nbsp;&nbsp;&nbsp;".$i."&nbsp;&nbsp;&nbsp;</option>";
}
echo "</select>"; ?></td>
     <td width="10%" align="left" valign="middle" class="bidderclass">
<?php

$numMonths = date("n");
$monthsArr = array("January","February","March","April","May","Jume","July","August","September","October", "November","December");
echo "<select name='month'>";
for($i=$numMonths;$i>0;$i--)
{
 $selected = "";
	if($i==$month ) $selected = "selected";

	$mon = $i-1;
	echo "<option value='".$i."' ".$selected.">".$monthsArr[$mon]."</option>";
}
echo "</select>";
?></td>
  
     <td valign="middle" align="left" class="style1" width="53%"><select name="year"><option value="2013">2013</option></select></td>
      <td width="33%" colspan="3" align="center" valign="middle"><input name="Submit" type="image"  src="images/login-form-lgn-srch.gif" style="width:111px; height:35px; border:none;" border="0"></td>
	   </tr>
	   </table>
	   </td></tr>
    </form>
 </table></td>
   </tr>
   
   <tr>
     <td width="650" height="8" align="center" valign="top" ><img src="images/login-bot-pnl.gif" width="650" height="8"></td>
   </tr>
  
 </table>


</td></tr>


  <tr>
    <td align="center">


<?php
if($_GET['search']=='y')
{
	$day = $_REQUEST['day'];
	$month = $_REQUEST['month'];
	$year = $_REQUEST['year'];
}
else
{
	$day = date("d");
	$month = date("m");
	$year = date("Y");

}

$currentHr = date("H");
if($currentHr>18)
{
	$currentHr = 19;
}
$BidderID = array(28,80,232,1453,5);

$seq = array(0,1,2,3,4);

//$BidderID = array(9);
$table ='';
$table .= "<table border='1' style='border:thin solid #CCC;' cellspacing='3' cellpadding='0' align='center'>";
$table .= "<tr>";
for($j=0;$j<count($BidderID);$j++)
{
	$table .= "<td colspan='2' valign='top'>";
	$bidderDetailsSql = "select Bidder_Name from Bidders where BidderID='".$BidderID[$j]."'";
	$bidderDetailsQuery = ExecQuery_bima($bidderDetailsSql);
	$Bidder_Name = mysql_result($bidderDetailsQuery,0,'Bidder_Name');
	$table .= "<table border='0' cellspacing='3' cellpadding='0'>";
	$table .= "<tr><td colspan='2'  bgcolor='#EDFCD8' class='data_text_b'><b>";
	$table .= $Bidder_Name." [".$BidderID[$j]."]"; 
	$table .= "</b></td></tr>";
	$table .= "<tr><td colspan='2'>";
	for($i=9;$i<=$currentHr;$i++)
	{
		if($i==9)
		{
		
			//$start_time = date("Y-m-d")." 09:00:00";
			$startHr = $day-1;
			$start_time = $year."-".appendzero($month)."-".appendzero($startHr)." 19:00:00";
			$end_time = $year."-".appendzero($month)."-".appendzero($day)." 09:59:59";
			$startTime = " 09:00:00";
			$endTime = " 09:59:59";
		}
		else
		{
			$start_time =  $year."-".appendzero($month)."-".appendzero($day)." ".$i.":00:00";
			$end_time = $year."-".appendzero($month)."-".appendzero($day)." ".$i.":59:59";		
			$startTime = $i.":00:00";
			$endTime = $i.":59:59";
		}
		$min_date = $start_time;
		$max_date = $end_time;
	
	$totalLeadsSql = "SELECT Req_Life_Insurance.RequestID from  Req_Life_Insurance LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Life_Insurance.RequestID AND Req_Feedback.BidderID= '".$BidderID[$j]."' and Req_Feedback.Reply_Type=1 WHERE ((MOD(Req_Life_Insurance.RequestID,5)='".$seq[$j]."' ) and Req_Life_Insurance.Source!='SMS' and Req_Life_Insurance.Source!='test' and ((Req_Life_Insurance.Updated_Date Between '".$min_date."' and '".$max_date."') or (Req_Feedback.Followup_Date Between '".$min_date."' and '".$max_date."'))) ".$FeedbackClause." group by Req_Life_Insurance.Phone";
	if($i==10)
	{
	//	echo $totalLeadsSql."<br>";
	}
	
	$totalLeadsQuery = ExecQuery_bima($totalLeadsSql);
	
	$totalNumLeads = mysql_num_rows($totalLeadsQuery);

		$table .= "<table border='1' cellspacing='0' cellpadding='1'>";
		$table .= "<tr><td colspan='2' class='data_text_a' >";
		$table .= "Start : <b>".$startTime."</b> - End : <b>".$endTime."</b>";
		$table .= "</td></tr>";
		$table .= "<tr><td colspan='2' class='data_text_c'><b>";
		$table .= "Leads in this hour - ".$totalNumLeads;
		$table .= "</b></td></tr>";
	
		$sql_PL = "select Req_Feedback.Feedback as Feedback, count(*) as CountLeads from Req_Feedback left join Req_Life_Insurance on Req_Life_Insurance.RequestID = Req_Feedback.AllRequestID where (Req_Life_Insurance.Dated between '".$start_time."' and '".$end_time."') and  Req_Feedback.BidderID='".$BidderID[$j]."' and Req_Feedback.Reply_Type=1 group by Req_Feedback.Feedback";
		$sql_Query = ExecQuery_bima($sql_PL);
		$count_Leads = mysql_num_rows($sql_Query);
		$countArr = '';
		for($k=0;$k<$count_Leads;$k++)
		{
			$Feedback = mysql_result($sql_Query,$k,'Feedback');
			$CountLeads = mysql_result($sql_Query,$k,'CountLeads');
			$table .= '<tr><td width="99" height="25" class="data_text_a">';
			$table .= $Feedback;
			$table .= '</td><td width="80" height="25" align="center" class="data_text_a">';
			$table .= $CountLeads;
			$table .= "</td></tr>";
			$countArr[] = $CountLeads; 
		}
		$countLeads = array_sum($countArr);
		$table .= "<tr><td colspan='2' class='data_text_c'><b>";
		$table .= "Total Leads - ".$countLeads;
		$table .= "</b></td></tr>";
	//	echo "<br>////////////////////////////////////////////<br>";
		//echo $sqlPL;
		//echo "<br>////////////////////////////////////////////<br>";
		$table .= "</table>";
	
	}
	$table .= "</td></tr>";
	$table .= "</table>";
	$table .= "</td>";
}
$table .= "</tr>";
$table .= "</table>";
echo $table;

?>
</td></tr></table>
</body>
</html>
