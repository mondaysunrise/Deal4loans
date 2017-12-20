<?php
//$msg ='';
$msg .="<table width='750'  border='0' style='vertical-align:middle; text-align:center;' cellpadding='0' cellspacing='0'><tr><td width='850' align='left' valign='middle'><img width='750' height='140' src='http://www.deal4loans.com/pdf/images/pg1-1a.jpg'></td></tr>";
$msg .="<tr><td valign='top' style='padding-top:1px;'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#a39ea2;' width='137'><img width='137' height='14' src='http://www.deal4loans.com/pdf/images/pg1-1c.jpg'></td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' width='10' align='left'>&nbsp;</td>";
	for($i=0;$i<6;$i++)
	{
		if($i==5)
		{
			$msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$app_code_Str[$i]."</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold; color:#a39ea2;' >".$app_code_Str[$i]."</td>";
    	}
	}
	$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#a39ea2;' width='320' align='right'>Date:</td>";
	for($i=0;$i<8;$i++)
	{
		if($i==7)
		{
	       $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$dt_str[$i]."&nbsp;</td>";
    	}
		else
		{
			$msg  .= "<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; color:#a39ea2; font-weight:bold;' >".$dt_str[$i]."&nbsp;</td>";
    	}
	}
$msg .="</tr></table></td></tr>";

$msg .="<tr><td width='850' align='left' valign='middle'><img width='750' height='113' src='http://www.deal4loans.com/pdf/images/pg1-1b.jpg'></td></tr>
<tr><td width='850' align='left' valign='top' style='padding-left:3px;'><table width='830' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#a39ea2;' width='125'>Name</td>";
for($i=0;$i<35;$i++)
{
	if($i==34)
	{
		$msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_name[$i]."&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$display_name[$i]."&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr><tr><td valign='top'><img width='728' height='32' src='http://www.deal4loans.com/pdf/images/pg1-3.jpg'></td></tr><tr><td valign='top' style='padding-top:1px;'><table border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#a39ea2;' width='142'>Date of Birth</td><td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-size:10px; font-weight:bold; color:#a39ea2;' >".$display_dob_day[0]."</td><td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_dob_day[1]."</td><td width='3'>&nbsp;</td><td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold; color:#a39ea2;' >".$display_dob_month[0]."</td><td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-size:10px; color:#a39ea2;'>".$display_dob_month[1]."</td><td width='3'>&nbsp;</td><td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold; color:#a39ea2;' >".$display_dob_year[0]."</td><td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold; color:#a39ea2;'>".$display_dob_year[1]."</td><td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold; color:#a39ea2;' >".$display_dob_year[2]."</td><td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_dob_year[3]."</td><td width='193'></td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2; padding-right:5px;' width='61'>Gender</td> <td align='center' style='border:1px solid #000000;  width:10px; color:#a39ea2; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>  <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#a39ea2;' width='66'>&nbsp;Male</td>  <td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#a39ea2;' width='185'>&nbsp;Female</td>	</tr>      	</table></td></tr><tr><td valign='top'><img width='750' height='93' src='http://www.deal4loans.com/pdf/images/pg1-4.jpg'></td></tr><tr><td valign='top'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px;' width='125'>Residence Address</td>";

	for($i=0;$i<35;$i++)
	{
		if($i==34)
		{
         	$msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_Residence_Address[$i]."&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold; color:#a39ea2;' >".$display_Residence_Address[$i]."&nbsp;</td>";
    	}
	}
	$msg .="</tr>	</table></td></tr><tr><td style='padding-top:3px;' ><table   border='0' cellspacing='0' cellpadding='0'>	<tr> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px;' width='125'></td>    <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; '>District&nbsp;</td>";
	for($i=0;$i<11;$i++)
	{
		if($i==10)
		{
			$msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; color:#a39ea2; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="    <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;State&nbsp;</td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
           $msg .=" <td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
	$msg .="    <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;'>&nbsp;Pincode&nbsp;</td>";
	for($i=0;$i<6;$i++)
	{
		if($i==5)
		{
	      	$msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold; color:#a39ea2;' >&nbsp;</td>";
    	}
	}
	$msg .="</tr>	</table></td></tr><tr><td style='padding-top:3px;' ><table   border='0' cellspacing='0' cellpadding='0'>	<tr> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#a39ea2;' width='125'>Nearest Landmark</td>"; 
	for($i=0;$i<14;$i++)
	{
		if($i==13)
		{
           $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold; color:#a39ea2;' >&nbsp;</td>";
    	}
	}
$msg .="    <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;STD Code&nbsp;</td>";
	for($i=0;$i<6;$i++)
	{
		if($i==5)
		{
           $msg .=" <td align='center' style='border:1px solid #000000; color:#a39ea2; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; color:#a39ea2; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
	$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#a39ea2; font-size:12px;'>&nbsp;Tel.&nbsp;</td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
           $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; color:#a39ea2; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; color:#a39ea2; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="</tr></table></td></tr><tr><td style='padding-top:3px;'><table border='0' cellspacing='0' cellpadding='0' width='700'>	<tr> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#a39ea2; font-size:12px; padding-right:5px;' width='125'>Residence in</td>   <td align='center' style='border:1px solid #000000; color:#a39ea2; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>    <td width='77' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;Self-Owned&nbsp;</td>   <td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td>    <td width='64' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;Rented&nbsp;</td>    <td style='border:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td><td width='128' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;Company Provided&nbsp;</td><td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td><td width='90' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;With Parents&nbsp;</td>   <td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td>    <td width='100' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;With Relatives&nbsp;</td>	</tr>	</table></td></tr><tr><td style='padding-top:3px;' ><table   border='0' cellspacing='0' cellpadding='0'>	<tr> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px;' width='120'>&nbsp;</td>   <td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td><td width='92' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;With Friends&nbsp;</td><td align='center' style='border:1px solid #000000;  width:10px; height:7px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>    <td width='48' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;PG&nbsp;</td>    <td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td>    <td width='59' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;Pagadi&nbsp;</td>    <td width='42' align='right' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;'>Other</td>    <td width='252' style='font-family:Arial, Helvetica, sans-serif; color:#a39ea2; font-weight:bold; font-size:12px;' >_______________________________________</td>   </tr>	</table></td></tr><tr><td valign='top'><img width='750' height='126' src='http://www.deal4loans.com/pdf/images/pg1-5.jpg'></td></tr><tr><td valign='top' style='padding-top:1px;'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#a39ea2;' width='120'>Mobile No.</td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
			$msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_mobile[$i]."</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold; color:#a39ea2;' >".$display_mobile[$i]."</td>";
    	}
	}
	$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#a39ea2;' width='46' align='right'>E-mail:</td>";
	for($i=0;$i<26;$i++)
	{
		if($i==25)
		{
	       $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_email[$i]."&nbsp;</td>";
    	}
		else
		{
			$msg  .= "<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; color:#a39ea2; font-weight:bold;' >".$display_email[$i]."&nbsp;</td>";
    	}
	}
$msg .="</tr></table></td></tr><tr><td style='padding-top:3px;' ><table border='0' cellspacing='0' cellpadding='0'>	<tr> <td style='font-family:Arial, Helvetica, sans-serif; color:#a39ea2; font-weight:bold; font-size:12px; padding-right:5px;' width='135'>No. Of Depentents</td> <td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td><td width='81' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;Occupation:&nbsp;</td><td align='center'><img  src='http://www.deal4loans.com/pdf/images/checked.jpg'></td>  <td width='53' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;Salaried&nbsp;</td>    <td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' >&nbsp;</td><td width='71' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' >&nbsp;Self-Employed&nbsp;</td><td width='42' align='right' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px;'>Other</td><td width='252' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px;' >____________________________________</td>   </tr>	</table></td></tr><tr><td valign='top' style='padding-top:1px;'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#a39ea2;' width='130'>Gross income: </td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
			$msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; color:#a39ea2; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; color:#a39ea2; font-family:Arial; text-align:middle; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="<td width='3'>&nbsp;</td> <td align='right' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-left:5px; color:#a39ea2;' width='55'>P.A. OR </td> <td align='center' style='border:1px solid #000000; color:#a39ea2;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-left:5px;' width='91' >PM</td>	</tr>      	</table></td></tr><tr><td valign='top' style='padding-top:1px;'><table   border='0' cellspacing='0' cellpadding='0' >	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#a39ea2;' width='125'>Pancard: </td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
			$msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_pancard[$i]."</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; color:#a39ea2; text-align:middle; font-size:10px; font-weight:bold;' >".$display_pancard[$i]."</td>";
    	}
	}
$msg .="<td width='2'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-left:2px; color:#a39ea2;' width='63'> or Form 60</td><td style='border:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='right'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-left:2px; color:#a39ea2;' width='49' > /Form 61</td> <td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px; padding-left:2px; color:#a39ea2;' width='170' >Nationality,if other than Indian</td>";
	for($i=0;$i<7;$i++)
	{
		if($i==6)
		{
			$msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="</tr></table></td></tr></table></td></tr><tr><td  align='left' valign='middle'><img width='780' height='262' src='http://www.deal4loans.com/pdf/images/pg1-2.jpg'></td></tr></table>";
//echo $msg; 
?>