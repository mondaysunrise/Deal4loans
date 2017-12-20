<?php
$msg .="<table width='766'  border='0' style='vertical-align:middle; text-align:center; background-color:#C7E8F9;' cellpadding='0' cellspacing='0'><tr><td width='766' align='left' valign='middle'><img src='http://www.deal4loans.com/pdf/images/hdfc/header2.jpg' width='766' ></td></tr>";
$msg .="<tr><td width='766' align='left' valign='top' style='padding-left:1px; padding-right:3px;' ></td></tr>";
$msg .="<tr><td valign='top'  style='padding-left:0px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:1px; color:#F00;' height='20' width='85' align='right'>Title</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:2px;'>&nbsp;Mr&nbsp;</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:12px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:2px;'>&nbsp;Ms&nbsp;</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:2px;'>&nbsp;M/S&nbsp;</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:0px;'>&nbsp;Others_______&nbsp;</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:2px;'>&nbsp;Applicant&nbsp; </td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:2px;'>&nbsp;Co-Applicant&nbsp; </td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:5px;'>&nbsp;Guarantor</td>";
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#F00; padding-right:4px; font-weight:bold;'>&nbsp;Pan No.&nbsp; </td>";
for($i=0;$i<10;$i++)
{
	if($i==9)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF; width:8px; height:12px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_pancard[$i]."&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:8px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$display_pancard[$i]."&nbsp;</td>";
	}
}


$msg .="</tr></table></td></tr>";
$msg .="<tr><td width='766' align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table width='766' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px; color:#F00;' height='20' width='85' align='right'>Applicant Name</td>";
for($i=0;$i<38;$i++)
{
	if($i==37)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#ffffff;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;' >".$display_name[$i]."&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff;  border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$display_name[$i]."&nbsp;</td>";
	}
}

$msg .="</tr></table></td></tr>";

$msg .="<tr><td width='766' align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table width='766' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px; color:#F00;' width='85' align='right'>Father's/<br>Husband's Name</td>";
for($i=0;$i<38;$i++)
{
	if($i==37)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#ffffff;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;' >&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff;  border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr>";

$msg .="<tr><td align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px; color:#F00;' width='85' align='right'>Date of Birth/
Incorporation</td>";
for($i=0;$i<8;$i++)
{
	if($i==7)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#ffffff;  width:15px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;' >".$display_dob[$i]."&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff;  border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$display_dob[$i]."&nbsp;</td>";
	}
}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#F00; font-weight:bold;'>&nbsp;Gender&nbsp; </td>";
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff;  border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$GenderVal."</td>";
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; color:#F00; font-weight:bold;'>&nbsp;Status&nbsp; </td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:0px;'>&nbsp;Single.&nbsp;</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:0px;'>&nbsp;Married.&nbsp;</td>";
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:9px; color:#F00; font-weight:bold;'>&nbsp;&nbsp;&nbsp;No. of Dependents&nbsp; </td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff;  border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#ffffff; width:15px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;' >&nbsp;</td>";
$msg .="</tr></table></td></tr>";


$msg .="<tr><td align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px; color:#F00;' width='85' align='right'>Education Details</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:5px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:0px;'>&nbsp;Undergraduate</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:5px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:0px;'>&nbsp;Graduate</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:5px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:2px;'>&nbsp;PostGraduate & above</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:15px; height:5px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:0px;'>Others____</td>";

$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:0px;'>Religion.______ </td>";
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:2px;'>";

$msg .="<table ><tr> <td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:10px; height:5px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td> <td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:0px;'>&nbsp;SC&nbsp;</td><td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:10px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>  <td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:0px;'>&nbsp;ST&nbsp;</td>   <td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:10px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>  <td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:0px;'>&nbsp;OBC&nbsp;</td> <td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:10px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>  <td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:0px;'>&nbsp;Other____&nbsp;</td>  </tr></table></td>";
$msg .="</tr></table></td></tr>";

$msg .="<tr><td colspan='4' align='right' bgcolor='#080806' class='pdf-red' height='2'></td></tr>";


$msg .="<tr bgcolor='#bfe6f7'><td width='766' align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table width='766' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px; color:#F00;' width='85' align='right'>Present Address</td>";
for($i=0;$i<38;$i++)
{
	if($i==37)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_Residence_Address[$i]."&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$display_Residence_Address[$i]."&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr>";
$msg .="<tr bgcolor='#bfe6f7'><td width='766' align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table width='766' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px; color:#F00;' width='85' align='right'>(Residence)</td>";
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
$msg .="<tr bgcolor='#bfe6f7'><td width='766' align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table width='766' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:7px; color:#F00;' width='85' align='right'>Landmark&nbsp;&nbsp;</td>";
for($i=0;$i<28;$i++)
{
	if($i==27)
	{
		$msg .=" <td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .=" <td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}

$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:2px; '>&nbsp;Years at current city&nbsp;</td>";
for($i=0;$i<4;$i++)
{
	if($i==3)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr>";

$msg .="<tr><td valign='top'  style='padding-left:7px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; padding-right:5px; font-weight:bold; color:#F00;' width='80' align='right'>&nbsp;City&nbsp;</td>";
for($i=0;$i<17;$i++)
{
	if($i==16)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_city[$i]."&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$display_city[$i]."&nbsp;</td>";
	}
}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:2px; '>&nbsp;PIN Code&nbsp;</td>";
for($i=0;$i<6;$i++)
{ 
	if($i==5)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$pinCodeVal[$i]."</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$pinCodeVal[$i]."</td>";
	}
}


$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:1px; '>&nbsp;Years at current residence&nbsp;</td>";
for($i=0;$i<4;$i++)
{
	if($i==3)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr>";
$msg .="<tr><td valign='top'  style='padding-left:2px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; padding-right:5px; font-weight:bold; color:#F00;' width='85' align='right'>&nbsp;State</td>";
for($i=0;$i<14;$i++)
{
	if($i==13)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$Resi_State[$i]."</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$Resi_State[$i]."</td>";
	}
}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:2px; '>&nbsp;Country&nbsp;</td>";
for($i=0;$i<7;$i++)
{
	if($i==6)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;'>&nbsp;</td>";
	}
}

$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:2px; '>&nbsp;Aadhar Card No</td>";
for($i=0;$i<10;$i++)
{
	if($i==9)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;'>&nbsp;</td>";
	}
}

$msg .="</tr></table></td></tr>";

$msg .="<tr><td valign='top'  style='padding-left:7px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; padding-right:0px; font-weight:bold; color:#F00;' width='85' align='right'>&nbsp;Tel (R)&nbsp;</td>";
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

$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:2px; '>&nbsp;Mobile no.&nbsp;</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >91</td>";

for($i=0;$i<10;$i++)
{
	if($i==9)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_mobile[$i]."&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$display_mobile[$i]."&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr>";

$msg .="<tr><td valign='top'  style='padding-left:7px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; padding-right:0px; font-weight:bold; color:#F00;' width='85' align='right'>&nbsp;e-mail ID&nbsp;</td>";

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

$msg .="<tr><td valign='top'  style='padding-left:0px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:1px; color:#F00;' height='20' width='85' align='right'>Present Address is</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:2px;'>&nbsp;Owned&nbsp;</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:12px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:2px;'>&nbsp;Parental&nbsp;</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:2px;'>&nbsp;Company provided&nbsp;</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000; padding-right:0px;'>&nbsp;Rented (Monthly Rent in______)&nbsp;</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#000000;  padding-right:2px;'>&nbsp;Tick if permanent address is same as above&nbsp; </td>";
$msg .="</tr></table></td></tr>";
$msg .="<tr><td colspan='4' align='right' bgcolor='#080806' class='pdf-red' height='2'></td></tr>";


$msg .="<tr bgcolor='#bfe6f7'><td width='766' align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table width='766' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px;' color:#000000; width='85' align='right'>Permanent Address</td>";
for($i=0;$i<38;$i++)
{
	if($i==37)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'></td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' ></td>";
	}
}

$msg .="</tr></table></td></tr>";

$msg .="<tr bgcolor='#bfe6f7'><td width='766' align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table width='766' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px;'  color:#000000; width='85' align='right'>(Residence / Regd Office)</td>";
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
$msg .="<tr bgcolor='#bfe6f7'><td width='766' align='left' valign='top' style='padding-left:0px; padding-top:2px;'><table width='766' border='0' cellpadding='0' cellspacing='0'><tr><td valign='top' style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:7px;' width='85' align='right'>Landmark&nbsp;&nbsp;</td>";
for($i=0;$i<28;$i++)
{
	if($i==27)
	{
		$msg .=" <td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .=" <td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}

$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; color:#F00; padding-right:2px; '>&nbsp;Years at current city&nbsp;</td>";
for($i=0;$i<4;$i++)
{
	if($i==3)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr>";

$msg .="<tr bgcolor='#bfe6f7'><td valign='top'  style='padding-left:7px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; padding-right:5px; font-weight:bold;' width='80' align='right'>&nbsp;City&nbsp;</td>";
for($i=0;$i<17;$i++)
{
	if($i==16)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'></td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' ></td>";
	}
}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold;  color:#000000; padding-right:2px; '>&nbsp;PIN Code&nbsp;</td>";
for($i=0;$i<6;$i++)
{
	if($i==5)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr>";
$msg .="<tr><td valign='top'  style='padding-left:2px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; padding-right:5px; font-weight:bold;' width='85'  color:#000000; align='right'>&nbsp;State</td>";
for($i=0;$i<20;$i++)
{
	if($i==19)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >&nbsp;</td>";
	}
}
$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold;  color:#000000; padding-right:2px; '>&nbsp;Country&nbsp;</td>";
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
$msg .="<tr><td valign='top'  style='padding-left:7px;  background-color:#C7E8F9;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; padding-right:0px; font-weight:bold;' width='85' align='right'>&nbsp;Tel (R)&nbsp;</td>";
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

$msg .="<td style='font-family:Arial, Helvetica, sans-serif; font-size:10px; font-weight:bold; padding-right:2px; '>&nbsp;Mobile no.&nbsp;</td>";
$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >91</td>";

for($i=0;$i<10;$i++)
{
	if($i==9)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'></td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' ></td>";
	}
}
$msg .="</tr></table></td></tr>";

$msg .="<tr><td width='766' align='left' valign='middle'><img src='http://www.deal4loans.com/pdf/images/hdfc/occupation.jpg' width='766' /></td></tr>";


$msg .="<tr><td valign='top'  style='padding-left:2px; background-color:#C7E8F9;  padding-top:2px;' width='766'><table   border='0' cellspacing='0' cellpadding='0'><tr><td style='font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:10px; padding-right:5px; color:#F00;' width='85' align='right'>Company/Employers Name</td>";
for($i=0;$i<36;$i++)
{
	if($i==35)
	{
		$msg .="<td align='center' style='border:1px solid #bfe6f7; background-color:#FFFFFF;  width:11px; height:17px; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; color:#a39ea2;'>".$display_c_name[$i]."&nbsp;</td>";
	}
	else
	{
		$msg .="<td align='center' style='border-bottom:1px solid #bfe6f7; background-color:#ffffff; border-left:1px solid #bfe6f7; border-top:1px solid #bfe6f7; width:11px; height:17px; color:#a39ea2; font-family:Arial; text-align:middle; font-family:Arial; font-weight:bold; font-size:10px; font-weight:bold;' >".$display_c_name[$i]."&nbsp;</td>";
	}
}
$msg .="</tr></table></td></tr>";

$msg .="</table>";
 //echo $msg; 
?>