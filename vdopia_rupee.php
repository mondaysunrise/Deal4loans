<?php
$subject="The Economist Subscription for only Rs 88 per week";
$message="<table id='Table_01' width='480' height='601' border='0' cellpadding='0' cellspacing='0' align='center'>
	<tr>
		<td colspan='2'>
			<img src='http://www.deal4loans.com/emailer/economist-mailer/480x600_01.gif' alt='' width='364' height='291' border='0' usemap='#Map'></td>
<td rowspan='3' style='border-right:1px solid #CCCCCC'><img src='http://www.deal4loans.com/emailer/economist-mailer/480x600_02.gif' alt='' width='115' height='532' border='0' usemap='#Map2'>
  <map name='Map2'>
    <area shape='rect' coords='4,9,96,521' href='http://www.neo.co.in/neo/economist/lms_new/hitpage_jan09edms.asp?cid=338' target='_blank'>
  </map></td>
</tr>
	<tr>
		<td rowspan='2'>
			<img src='http://www.deal4loans.com/emailer/economist-mailer/480x600_03.gif' width='1' height='241' alt=''></td>
		<td>
			<img src='http://www.deal4loans.com/emailer/economist-mailer/480x600_04.gif' alt='' width='363' height='105' border='0' usemap='#Map5'></td>
  </tr>
	<tr>
		<td>
			<img src='http://www.deal4loans.com/emailer/economist-mailer/480x600_05.gif' alt='' width='363' height='136' border='0' usemap='#Map3'></td>
  </tr>
	<tr>
		<td colspan='2' rowspan='2'><img src='http://www.deal4loans.com/emailer/economist-mailer/480x600_06.gif' alt='' width='363' height='69' border='0' usemap='#Map4'>
		  <map name='Map4'>
		    <area shape='rect' coords='30,4,113,26' href='http://www.neo.co.in/neo/economist/lms_new/hitpage_jan09edms.asp?cid=338' target='_blank'>
          </map>
	    <img src='http://www.neo.co.in/neo/economist/lms_new/proactivemails.asp?edmid=338' height='1px' width='1' /></td>
<td style='border-right:1px solid #CCCCCC;'>
			<img src='http://www.deal4loans.com/emailer/economist-mailer/480x600_07.gif' width='115' height='68' alt=''></td>
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
<map name='Map'>
<area shape='rect' coords='32,123,107,146' href='http://www.neo.co.in/neo/economist/lms_new/hitpage_jan09edms.asp?cid=338' target='_blank'>
</map>
<map name='Map3'><area shape='rect' coords='30,1,113,29' href='http://www.neo.co.in/neo/economist/lms_new/hitpage_jan09edms.asp?cid=338' target='_blank'>
</map>
<map name='Map5'>
<area shape='rect' coords='30,27,325,101' href='http://www.neo.co.in/neo/economist/lms_new/hitpage_jan09edms.asp?cid=338' target='_blank'>
</map>";
$headers  = 'MIME-Version: 1.0' . "\r\n";				
				$headers  = 'From: The Economist <no-reply@deal4loans.com>' . "\r\n";
				$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$EmailID="ranjana5chauhan@gmail.com,ranjanachauhan5@yahoo.com,ranjana.chauhan@rediffmail.com,ranjana5chauhan@hotmail.com";
mail($EmailID,$subject, $message, $headers);
?>

