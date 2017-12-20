<?php

//$msg ='';
$msg .="<table width='750'  border='0'  style='vertical-align:middle; text-align:center;' cellpadding='0' cellspacing='0'><tr><td width='850' align='left' valign='middle'><img width='750' height='23' src='pdf/images/pg3-1.jpg'></td></tr><tr><td width='850' align='left'  valign='top' ><table width='830' border='0' cellpadding='3' cellspacing='0'><tr><td valign='top'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#a39ea2;' width='125'>Name</td>";
	for($i=0;$i<35;$i++)
	{
		if($i==34)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_name[$i]."&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; color:#a39ea2; font-family:Arial; font-size:10px; font-weight:bold;' >".$display_name[$i]."&nbsp;</td>";
    	}
	}
$msg .="	</tr>	</table></td></tr><tr><td valign='top'><img width='728' height='32' src='pdf/images/pg1-3.jpg'></td></tr><tr><td valign='top' style='padding-top:1px;'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px;  color:#969496; color:#a39ea2;' width='142'>Date of Birth</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold; color:#a39ea2;' align='center' >".$display_dob_day[0]."</td><td style='border:1px solid #000000;  width:16px; height:14px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;' align='center'>".$display_dob_day[1]."</td><td width='3'>&nbsp;</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold; color:#a39ea2;' align='center' >".$display_dob_month[0]."</td><td style='border:1px solid #000000; color:#a39ea2;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>".$display_dob_month[1]."</td><td width='3'>&nbsp;</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold; color:#a39ea2;' align='center' >".$display_dob_year[0]."</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold; color:#a39ea2;' align='center' >".$display_dob_year[1]."</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:16px; height:14px; font-family:Arial; color:#a39ea2; text-align:middle; font-size:10px; font-weight:bold;' align='center' >".$display_dob_year[2]."</td> <td style='border:1px solid #000000;  color:#a39ea2; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>".$display_dob_year[3]."</td>    <td width='193'></td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='61'>Gender</td> <td style='border:1px solid #000000;  width:16px; height:14px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='66'>Male</td>  <td style='border:1px solid #000000;  width:16px; height:14px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='217'>Female</td>	</tr>      	</table></td></tr><tr><td valign='top'><img width='750' height='73' src='pdf/images/pg1-4.jpg'></td></tr><tr><td valign='top'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='125'>Residence Address</td>";
	for($i=0;$i<35;$i++)
	{
		if($i==34)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_Residence_Address[$i]."&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-size:10px; color:#a39ea2; font-weight:bold;' >".$display_Residence_Address[$i]."&nbsp;</td>";
    	}
	}
$msg .="	</tr>	</table></td></tr><tr><td style='padding-top:3px;' ><table   border='0' cellspacing='0' cellpadding='0'>	<tr> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px;' width='125'></td>    <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px;  color:#969496;'>District&nbsp;</td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="    <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;State&nbsp;</td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="    <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;'>&nbsp;Pincode&nbsp;</td>";
	for($i=0;$i<6;$i++)
	{
		if($i==5)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="	</tr>	</table></td></tr><tr><td style='padding-top:3px;' ><table   border='0' cellspacing='0' cellpadding='0'>	<tr> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='125'>Nearest Landmark</td> ";
	for($i=0;$i<14;$i++)
	{
		if($i==13)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;STD Code&nbsp;</td>";
	for($i=0;$i<6;$i++)
	{
		if($i==5)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="    <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;'>&nbsp;Tel.&nbsp;</td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="</tr></table></td></tr><tr><td style='padding-top:3px;' ><table   border='0' cellspacing='0' cellpadding='0' width='700'>	<tr> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='125'>Residence in</td>   <td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td><td width='77' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;Self-Owned&nbsp;</td>   <td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td>    <td width='69' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;Rented&nbsp;</td>    <td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td><td width='128' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;Company Provided&nbsp;</td><td style='border:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td><td width='97' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;With Parents&nbsp;</td><td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td> <td width='88' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;With Relatives&nbsp;</td>	</tr>	</table></td></tr><tr><td style='padding-top:3px;' ><table   border='0' cellspacing='0' cellpadding='0'>	<tr> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px;' width='120'>&nbsp;</td>   <td style='border:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td><td width='92' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;With Friends&nbsp;</td><td style='border:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td><td width='48' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;PG&nbsp;</td><td style='border:1px solid #000000;  width:16px; height:14px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td><td width='59' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;Pagadi&nbsp;</td>    <td width='42' align='right' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;'>Other</td>    <td width='252' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px;' >_______________________________________</td>  </tr>	</table></td></tr><tr><td valign='top'><img width='750' height='106' src='pdf/images/pg1-5.jpg'></td></tr><tr><td valign='top' style='padding-top:1px;'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='120'>Mobile No.</td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_mobile[$i]."</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-size:10px; font-weight:bold; color:#a39ea2;' >".$display_mobile[$i]."</td>";
    	}
	}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='46' align='right'>E-mail:</td>";
	for($i=0;$i<25;$i++)
	{
		if($i==24)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_email[$i]."</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-size:10px; font-weight:bold; color:#a39ea2;' >".$display_email[$i]."</td>";
    	}
	}
$msg .="</tr></table></td></tr><tr><td style='padding-top:3px;' ><table   border='0' cellspacing='0' cellpadding='0'>	<tr> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='135'>No. Of Depentents</td> <td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-size:10px; font-weight:bold;' align='center' >&nbsp;</td><td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td>    <td width='81' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;Occupation:&nbsp;</td>    <td align='center'><img src='http://www.deal4loans.com/pdf/images/checked.jpg'></td>    <td width='53' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;Salaried&nbsp;</td>    <td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>    <td width='71' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' >&nbsp;Self-Employed&nbsp;</td>    <td width='42' align='right' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;'>Other</td>    <td width='252' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px;' >____________________________________</td>   </tr>	</table></td></tr><tr><td valign='top' style='padding-top:1px;'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='130'>Gross income: </td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-size:10px; font-weight:bold; color:#a39ea2;' >&nbsp;</td>";
    	}
	}
$msg .="<td width='30'>&nbsp;</td> <td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='right'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-left:5px; color:#969496;' width='55'>P.A. OR </td> <td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-left:5px; color:#969496;' width='91' >PM</td>	</tr>      	</table></td></tr><tr><td valign='top' style='padding-top:1px;'><table   border='0' cellspacing='0' cellpadding='0' >	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='125'>Pancard: </td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_pancard[$i]."</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-size:10px; font-weight:bold; color:#a39ea2;' >".$display_pancard[$i]."</td>";
    	}
	}
$msg .="<td width='2'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-left:2px; color:#969496;' width='63'> or Form 60</td><td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='right'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-left:2px; color:#969496;' width='49' > /Form 61</td> <td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px; padding-left:1px; color:#969496;' width='170' >Nationality,if other than Indian</td>";
	for($i=0;$i<7;$i++)
	{
		if($i==6)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="</tr></table></td></tr><tr><td  align='left' valign='middle'><img width='780' height='44' src='pdf/images/pg3-2.jpg'></td></tr><tr><td valign='top'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='125'>Employer Name</td>";
	for($i=0;$i<37;$i++)
	{
		if($i==36)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_c_name[$i]."&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-size:10px; font-weight:bold; color:#a39ea2;' >".$display_c_name[$i]."&nbsp;</td>";
    	}
	}
$msg .="	</tr>	</table></td></tr><tr><td valign='top' style='padding-top:1px;'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='125'>Emp ID</td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='250' align='right'>Net Salary (P.M./P.A):</td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_annual_income[$i]."&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-size:10px; font-weight:bold; color:#a39ea2;' >".$display_annual_income[$i]."&nbsp;</td>";
    	}
	}
$msg .="</tr></table></td></tr><tr><td valign='top'><table width='622'   border='0' cellpadding='0' cellspacing='0'>	  <tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px;' width='130'><span style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;'>Company Type</span></td> <td style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center'>&nbsp;</td>    <td width='136' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px; color:#969496;' >&nbsp;Public Sector (PSU)&nbsp;</td>    <td style='border:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center'>&nbsp;</td><td width='154' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px; color:#969496;' >&nbsp;&nbsp;Central Government (CTG)</td>    <td style='border:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center'>&nbsp;</td><td width='148' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px; color:#969496;' >&nbsp;State Government (STG)&nbsp;</td>    </tr>	</table></td></tr><tr><td valign='top'><table width='750'   border='0' cellpadding='0' cellspacing='0'>	  <tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px;' width='134'>&nbsp;</td> <td style='border:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center'>&nbsp;</td>    <td width='115' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px; color:#969496;' >&nbsp;Multinational (MNC)&nbsp;</td>    <td style='border:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center'>&nbsp;</td>    <td width='210' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px; color:#969496;' >&nbsp;Public Ltd Co. (PUB) Pvt Ltd Co. (PVT) </td><td style='border:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center'>&nbsp;</td>    <td width='236' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px; color:#969496;' >&nbsp;Partnership(PAR)&nbsp;</td></tr>	</table></td></tr><tr><td valign='top'><table width='750'   border='0' cellpadding='0' cellspacing='0'>	  <tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='130'>Designation</td> <td style='border:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center'>&nbsp;</td>    <td width='136' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px; color:#969496;' >&nbsp;Senior Management(S)&nbsp;</td><td style='border:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center'>&nbsp;</td>    <td width='140' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px; color:#969496;' >&nbsp;&nbsp;Middle Management(M)</td>    <td style='border:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center'>&nbsp;</td>    <td width='131' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px; color:#969496;' >&nbsp;Jonior Management(J)&nbsp;</td>    <td style='border:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center'>&nbsp;</td>    <td width='141' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:11px; color:#969496;' >&nbsp;Clerical Management(C)&nbsp;</td>   	</tr>	</table></td></tr><tr><td style='padding-top:3px;' ><table   border='0' cellspacing='0' cellpadding='0'>	<tr> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px;' width='125'></td>    <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496; '>Others&nbsp;</td>    <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; '>______________________________</td>    </tr>	</table></td></tr><tr><td style='padding-top:3px;' ><table   border='0' cellspacing='0' cellpadding='0'>	<tr> <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='165'>Designation and Department: </td>    <td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center' >&nbsp;</td>    <td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center' >&nbsp;</td>    <td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;' align='center' >&nbsp;</td>    <td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' align='center' >&nbsp;</td><td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' align='center' >&nbsp;</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' align='center' >&nbsp;</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' align='center' >&nbsp;</td><td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-weight:bold; font-size:10px; ' >&nbsp;</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' align='center' >&nbsp;</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' align='center' >&nbsp;</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' align='center' >&nbsp;</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center' >&nbsp;</td><td align='center' style='border:1px solid #000000;  width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-left:3px;  color:#969496;' width='210' align='right'>No of yrs at Current Job&nbsp;</td><td style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center' >&nbsp;</td><td style='border:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' align='center'>&nbsp;</td>                   	</tr>	</table></td></tr><tr><td valign='top'><table   border='0' cellspacing='0' cellpadding='0'>	<tr>  <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='125'>Office Address</td>";
	for($i=0;$i<37;$i++)
	{
		if($i==36)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="	</tr>	</table></td></tr><tr><td valign='top'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px;' width='125'>&nbsp;</td>";
	for($i=0;$i<37;$i++)
	{
		if($i==36)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="	</tr>	</table></td></tr><tr><td valign='top'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px;' width='125'>&nbsp;</td>";
	for($i=0;$i<28;$i++)
	{
		if($i==27)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="    <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;'>&nbsp;Pincode&nbsp;</td>";
	for($i=0;$i<6;$i++)
	{
		if($i==5)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="	</tr>	</table></td></tr><tr><td valign='top'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;' width='125'>Nearest Landmark: </td>";
	for($i=0;$i<17;$i++)
	{
		if($i==16)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="    <td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;'>&nbsp;STD Code:&nbsp;</td>";
	for($i=0;$i<5;$i++)
	{
		if($i==4)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;'>&nbsp;Tel.&nbsp;</td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="	</tr>	</table></td></tr><tr><td valign='top'><table   border='0' cellspacing='0' cellpadding='0'>	<tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px;' width='125'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; padding-right:5px; color:#969496;'>Fax: </td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;'>&nbsp;Mobile:&nbsp;</td>";
	for($i=0;$i<10;$i++)
	{
		if($i==9)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="</tr></table></td></tr><tr><td valign='top'><table border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;' width='180'>Name of previous organisation</td>";
	for($i=0;$i<11;$i++)
	{
		if($i==10)
		{
            $msg .="<td align='center' style='border:1px solid #000000;  width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px;'>&nbsp;</td>";
    	}
		else
		{
			$msg .="<td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
    	}
	}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;'>&nbsp;No. of yrs in previous job :&nbsp;</td><td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;' >&nbsp;</td><td align='center' style='border:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold;'>&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:12px; color:#969496;'>&nbsp;Total yrs of work experience :&nbsp;</td><td align='center' style='border-bottom:1px solid #000000; border-left:1px solid #000000; border-top:1px solid #000000; width:10px; height:9px; font-family:Arial; text-align:middle; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_Total_Experience[0]."</td><td align='center' style='border:1px solid #000000;  width:10px; height:9px; font-family:Arial; text-align:middle; font-size:10px; font-weight:bold; color:#a39ea2;'>".$display_Total_Experience[1]."</td></tr></table></td></tr></table></td></tr><tr><td  align='left' valign='middle'><img width='750' height='252' src='pdf/images/pg3-5.jpg'></td></tr></table>";
?>