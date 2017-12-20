<?php
session_start();
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

$currentmonth=date('M');

$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
list($year,$month,$date) = split('-', $currentdate);
$interval=  $date;
$dayarr="";
for($d=1; $d<=$date; $d++)
	  {
		if($d<10)
		  {
			$dtfield="date_0".$d;
		  }
		  else
		  {
			$dtfield="date_".$d;
		  }
		  $fieldarr[]=$dtfield;
		  $datarr[]=$d;
	  }

$filedstr=implode(",",$fieldarr);

//$citifinid =array('Delhi n NCR','Mumbai n Suburbs','Hyderabad','Bangalore','Pune','Chennai','Kolkata','Jaipur','Chandigarh','Ahmedabad','Cochin','Surat','Vadodara','Coimbatore','Indore','complete');

$citifinid =array('Ahmedabad','Bangalore','Bhopal','Bhubneshwar','Chandigarh','Chennai','Cochin','Coimbatore','Delhi n NCR','Hyderabad','Indore','Jaipur','Kolkata','Lucknow','Mumbai n Suburbs','Pune','Surat','Vadodara','Vishakapatanam','Total');

$content='<table border="1" cellspacing="1" cellpadding="5" >
<tr><td valign="top" align="center" style="background-color:#666666; color:#ffffff;"></td>';

for($r=0; $r<count($datarr);$r++)
  {
	
	$content.='<td valign="top" align="center" style="background-color:#666666; color:#ffffff;">'.$datarr[$r].''.$currentmonth.''.Date('y').'</td>';
  }

$content.='<td valign="top" align="center" style="background-color:#666666; color:#ffffff;" >Total</td>
</tr>';

$row="";
for($i=0; $i<count($citifinid);$i++)
  {
	  $content.='<tr>';
$slectqry="Select  	icici_city,".$filedstr.",total_count from icicihl_lapreport Where (icici_product=2 and stat_flag=1 and icici_city='".$citifinid[$i]."')";
$result=ExecQuery($slectqry);
$row=mysql_fetch_array($result);

$cont=count($fieldarr) +2; 
for($j=0;$j<$cont;$j++)
	{
		$content.='<td align="center">';
		$content.=$row[$j];
		$content.='</td>';
	}

$content.='</tr>';

  }
 
  $content.='</table>';
  
echo $content;



$email = "s.dhirendra@icicibank.com,nidhi@deal4loans.com,shweta.sharma@deal4loans.com,ahmed.arif@icicibank.com";
//$email="ranjana5chauhan@gmail.com";

$headers = "From: Deal4loans <no-reply@deal4loans.com>";
			 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		////$headers .= "Cc: nitin.mukharya@avivaindia.com"."\n";
		//$headers .= "Bcc: ranjana5chauhan@gmail.com "."\n";
		$message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $content . "\n\n";
//$email="ranjana5chauhan@gmail.com";
mail($email,'ICICI HL MIS Till Date ', $message, $headers);

?>