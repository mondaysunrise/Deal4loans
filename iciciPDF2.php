<?php
//$msg ='';
$msg .="<table width='750'  border='0' style='vertical-align:middle; text-align:center;' cellpadding='0' cellspacing='0'><tr><td width='750' align='left' valign='middle'><img width='750' height='30' src='http://www.deal4loans.com/pdf/images/pg2-111.jpg'></td></tr>";


$msg .="<tr><td valign='top' style='padding-top:1px;'><table border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial; font-size:11px; padding-right:5px; color:#000;' width='45' align='right'>Occupation</td><td width='18'></td>";
if($Employment_Status==1)
{
	$msg .="<td align='right' style='border:0px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'><img src='http://www.deal4loans.com/pdf/images/checked.jpg' ></td><td style='font-family:Arial; font-size:11px; padding-right:5px; color:#000; padding-left:5px;' width='40'>Salaried</td>";

	$msg .="<td align='right' style='border:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td><td style='font-family:Arial; font-size:11px; padding-right:5px; color:#000; padding-left:5px;' width='75'>Self Salaried</td>";
}
else
{
	$msg .="<td align='right' style='border:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td><td style='font-family:Arial; font-size:11px; padding-right:5px; color:#000; padding-left:5px;' width='40'>Salaried</td>";

	$msg .="<td align='right' style='border:0px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'><img src='http://www.deal4loans.com/pdf/images/checked.jpg' ></td><td style='font-family:Arial; font-size:11px; padding-right:5px; color:#000; padding-left:5px;' width='75'>Self Salaried</td>";


}

$msg .="<td align='right' style='border:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td><td style='font-family:Arial; font-size:11px; padding-right:5px; color:#000; padding-left:5px;' width='135'>Self Salaried Professional</td>";

$msg .="<td align='right' style='border:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td><td style='font-family:Arial; font-size:11px; padding-right:5px; color:#000; padding-left:5px;' width='35'>Retired</td>";

$msg .="<td align='right' style='border:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td><td style='font-family:Arial; font-size:11px; padding-right:5px; color:#000; padding-left:5px;' width='55'>Housewife</td>";

$msg .="<td align='right' style='border:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td><td style='font-family:Arial; font-size:11px; padding-right:5px; color:#000; padding-left:5px;' width='30'>Student</td>";

$msg .="<td style='font-family:Arial; font-size:11px; padding-right:5px; color:#000; padding-left:5px;' width='25'>Others</td><td align='right' style='width:40px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>___________</td>";

$msg .="</tr></table></td></tr>";

$msg.="<tr><td valign='top'><img width='730' height='155' src='http://www.deal4loans.com/pdf/images/pg2-112.jpg'></td></tr>";



$msg .="<tr><td width='750' align='left' valign='top' style='padding-left:6px;'><table width='730' border='0' cellpadding='3' cellspacing='0'><tr><td valign='top'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial; font-size:11px; padding-right:5px; color:#000;' width='90' align='right'>Company Employers Name</td>";
	for($i=0;$i<35;$i++)
	{
		if($i==34)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#000000;'>".$display_c_name[$i]."&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold; color:#000000;' >".$display_c_name[$i]."&nbsp;</td>";
    	}
	}
$msg .="</tr></table></td></tr>";
$msg .="<tr><td align='left' valign='middle'><img width='750' height='762' src='http://www.deal4loans.com/pdf/images/pg2-113.jpg'></td></tr>";
$msg .="</table></td></tr></table>";
?>