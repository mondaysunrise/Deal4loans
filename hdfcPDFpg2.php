<?php
$msg .="<tr bgcolor='#bfe6f7'><td width='766' align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table width='766' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px; color:#F00;' height='20' width='85' align='right'>Company / Employers</td>";
for($i=0;$i<38;$i++)
{
	if($i==37)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$CompanyEmpAddress[$i]."&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$CompanyEmpAddress[$i]."&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr>";

$msg .="<tr bgcolor='#bfe6f7'><td width='766' align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table width='766' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px; color:#F00;' width='85' align='right'> Address</td>";
for($i=0;$i<38;$i++)
{
	if($i==37)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}

$msg .="</tr></table></td></tr>";

$msg .="<tr bgcolor='#bfe6f7'><td width='766' align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table width='766' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px; color:#F00;' width='85' align='right'>&nbsp;</td>";
for($i=0;$i<38;$i++)
{
	if($i==37)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr>";

$msg .="<tr bgcolor='#bfe6f7'><td width='766' align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table width='766' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px;' width='85' align='right'>Landmark&nbsp;&nbsp;</td>";
for($i=0;$i<38;$i++)
{
	if($i==37)
	{
		$msg .=" <td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .=" <td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}


$msg .="</tr></table></td></tr>";


$msg .="<tr><td valign='top'  style='padding-left:7px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; padding-right:5px; font-weight:bold; color:#F00;' width='80' align='right'>&nbsp;City&nbsp;</td>";
for($i=0;$i<17;$i++)
{
	if($i==16)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$OffCity[$i]."&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$OffCity[$i]."&nbsp;</td>";
	}
}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:2px; '>&nbsp;PIN Code&nbsp;</td>";
for($i=0;$i<6;$i++)
{
	if($i==5)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$OffPinCode[$i]."</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$OffPinCode[$i]."</td>";
	}
}
$msg .="</tr></table></td></tr>";
$msg .="<tr><td valign='top'  style='padding-left:2px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; padding-right:5px; font-weight:bold; color:#F00;' width='85' align='right'>&nbsp;State</td>";
for($i=0;$i<20;$i++)
{
	if($i==19)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$OffState[$i]."</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$OffState[$i]."</td>";
	}
}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:2px; '>&nbsp;Country&nbsp;</td>";
for($i=0;$i<16;$i++)
{
	if($i==15)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;'>&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr>";

$msg .="<tr><td valign='top'  style='padding-left:7px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; padding-right:0px; font-weight:bold; color:#F00;' width='85' align='right'>&nbsp;Tel (O)&nbsp;</td>";
for($i=0;$i<5;$i++)
{
	if($i==4)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;-&nbsp;</td>";
for($i=0;$i<10;$i++)
{
	if($i==9)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}

$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; padding-right:2px; '>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Preferred Mailing Address.&nbsp;&nbsp;&nbsp;</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' ></td>";
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; padding-right:2px; '>&nbsp;Residence &nbsp;</td>";

$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' ></td>";
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; padding-right:2px; '>&nbsp;Office &nbsp;</td>";

$msg .="</tr></table></td></tr>";
$msg .="<tr><td valign='top'  style='padding-left:7px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; padding-right:0px; font-weight:bold; color:#F00;' width='85' align='right'>&nbsp;Official e-mail ID&nbsp;</td>";

for($i=0;$i<38;$i++)
{
	if($i==37)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_email[$i]."&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$display_email[$i]."&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr>";

$msg .="<tr><td width='766' align='left' valign='middle'><img src='http://www.deal4loans.com/pdf/images/hdfc/pdf.jpg' width='100%'></td></tr>";
$msg .="<tr><td width='766' align='left' valign='middle'><img src='http://www.deal4loans.com/pdf/images/hdfc/mostimp1.jpg' width='100%'></td></tr>";
$msg .="<tr><td width='766' align='left' valign='middle'><img src='http://www.deal4loans.com/pdf/images/hdfc/mostimp2.jpg' width='100%'></td></tr>";
$msg .="<tr><td width='766' align='left' valign='middle'><img src='http://www.deal4loans.com/pdf/images/hdfc/application_ins.jpg' width='100%'></td></tr>";
$msg .="<tr><td width='766' align='left' valign='middle'><img src='http://www.deal4loans.com/pdf/images/hdfc/application_ins2.jpg' width='100%'></td></tr>";
$msg .="<tr><td width='766' align='left' valign='middle'><img src='http://www.deal4loans.com/pdf/images/hdfc/application_ins3.jpg' width='100%'></td></tr>";
?>