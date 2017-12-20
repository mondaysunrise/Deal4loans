<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
session_start();
$currentDt = date("j");
$content="<table width='520' cellspacing='0' cellpadding='0' border='1'>";
$content.="
<tr><td  height='29' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#FFFFFF;background-color: #FCAA00;' >&nbsp;&nbsp;Datewise &nbsp;&nbsp;&nbsp;&nbsp;Till &nbsp;".date('d-M-Y')."</td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#FFFFFF;background-color: #FCAA00;' align='center'>Count of Leads</td></tr>";
$crArr = '';
for($i=2;$i<=$currentDt;$i++)
{
	if($i%2==0)
			{	
				$bgcolor = "#CCCCCC";	
			}
			else
			{
				$bgcolor = "#FFFFFF";
			}


	$CountLeads = '';
	$dt = mktime(0, 0, 0, date("m")  , date($i), date("Y"));
	$min_date = date("Y-m-d",$dt)." 00:00:00";
	$max_date = date("Y-m-d",$dt)." 23:59:59";
	$date = date("d-m-Y",$dt);
	$sql = "select count(*) as CountLeads from Req_Feedback_Bidder_CC where ((Allocation_Date Between '".($min_date)."' and '".($max_date)."') and (Req_Feedback_Bidder_CC.BidderID in (3662,3663,3664,3665,3666,3778,3820,3821,3822,3823,4499,4500,4501,4502,4503)))";

	list($recordcount,$query)=MainselectfuncNew($sql,$array = array());
	$CountLeads = $query[0]['CountLeads'];

	if($CountLeads>0)
	{
	
$content.="<tr bgcolor='".$bgcolor."'><td height='25' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#1F68B2;' >&nbsp;&nbsp;Count of leads ".$date."</td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#1F68B2;' align='center'>".$CountLeads."</td>
</tr>";
		$crArr[] = $CountLeads;
	}

}
$content.="<tr bgcolor='#FFFFCC'><td height='25' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#1F68B2;'  >&nbsp;&nbsp;Total Leads</td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#1F68B2;' align='center'>".array_sum($crArr)."</td>
</tr>";
$content.="</table>";
//echo $content;
$email = "shabbir.khan@andromedabpo.in,akbar.khan@andromedabpo.in,santoshsanglikar@andromedabpo.in,chumki.neogi@andromedabpo.in,nishant.mandal@icicibank.com";
//$email = "ranjana5chauhan@gmail.com";


$headers = "From: Deal4loans <no-reply@deal4loans.com>";
			$semi_rand = md5( time() ); 
			$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
			$headers .= "\nMIME-Version: 1.0\n" . 
			"Content-Type: multipart/mixed;\n" . 
			" boundary=\"{$mime_boundary}\""."\n";
			$headers .= "Cc: shweta.sharma@deal4loans.com"."\n";		
			//$headers .= "Bcc: upendraparallel@gmail.com"."\n";
			$message = "This is a multi-part message in MIME format.\n\n" . 
			"--{$mime_boundary}\n" . 
			"Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
			"Content-Transfer-Encoding: 7bit\n\n" . 
                $content . "\n\n";
mail($email,'ICICI CC MIS Till Date ', $message, $headers);

?>
