<?php
session_start();
require 'scripts/db_init.php';
//require 'scripts/functions_nw.php';

echo $currentDt = date("j");
$content="<table width='520' cellspacing='0' cellpadding='0' border='1'>";
$content.="
<tr><td  height='29' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#FFFFFF;background-color: #FCAA00;' >&nbsp;&nbsp;Datewise &nbsp;&nbsp;&nbsp;&nbsp;Till &nbsp;".date('d-M-Y')."</td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;font-weight:bold; color:#FFFFFF;background-color: #FCAA00;' align='center'>Count of Leads</td></tr>";
$crArr = '';
for($i=1;$i<=$currentDt;$i++)
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
	$sql = "SELECT hdfclife_name from hdfclife_compleads WHERE (hdfclife_compleads.hdfclife_dated  Between '".($min_date)."' and '".($max_date)."' ) group by hdfclife_mobile_number";	
	$query = ExecQuery($sql);
//	$CountLeads = mysql_result($query,0,'CountLeads');
	$CountLeads = mysql_num_rows($query);
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
echo $content;

$email = "prabhjott@hdfclife.com,ssivaraman@hdfclife.com,anirudhsingh@hdfclife.com";

$headers = "From: Deal4loans <no-reply@deal4loans.com>";
			 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		
		$message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $content . "\n\n";
mail($email,'HDFC Standard Life online MIS Till Date ', $message, $headers);

?>