<?php
$Loan_Amount = $_REQUEST["get_loan_amt"];
 $tenure = $_REQUEST["get_tenure"];
  $nroi = $_REQUEST["get_roi"];
 $get_cpc = $_REQUEST["get_cpc"];
 $rate_flag = $_REQUEST["get_rf"];
  $car_price = $_REQUEST["get_carprice"];
 

list($mroi,$lroi) = split('[%]', $nroi);
 if($get_cpc==1)
{
	$car_price_category="A+";
}
if($get_cpc==2)
{
	$car_price_category="A";
}
if($get_cpc==3)
{
	$car_price_category="B+";
}
if($get_cpc==4)
{
	$car_price_category="B";
}
if($get_cpc==5)
{
	$car_price_category="C";
}

if(($Loan_Amount > 0) && ($tenure)>0)
{
	//Calculate the ROI
if($rate_flag==1)
	{
	if($car_price_category =='A+' )
		{
			if($tenure>=12 && $tenure<24)
			{
				$inter = 14.25;
				$interest = $inter / 1200;
				$roi = "14.25%";
				
			}
			else if ($tenure>=24 && $tenure<36)
			{
				$inter = 12.25;
				$interest = $inter / 1200;
				$roi = "12.25%";
			}
			else if ($tenure>=36 && $tenure<60)
			{
				$inter = 10;
				$interest = $inter / 1200;
				$roi = "10%";
			}
			else
			{
				$inter = 10;
				$interest = $inter / 1200;
				$roi = "10%";
			}
		}
	else if($car_price_category =='A')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.25;
					$interest = $inter / 1200;
					$roi = "14.25%";
					
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 12.25;
					$interest = $inter / 1200;
					$roi = "12.25%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 10.25;
					$interest = $inter / 1200;
					$roi = "10.25%";
				}
				else
				{
					$inter = 10.25;
					$interest = $inter / 1200;
					$roi = "10.25%";
				}
		}
		else if($car_price_category =='B+' )
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.25;
					$interest = $inter / 1200;
					$roi = "14.25%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 12.50;
					$interest = $inter / 1200;
					$roi = "12.50%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 10.50;
					$interest = $inter / 1200;
					$roi = "10.50%";
				}
				else
				{
					$inter = 10.50;
					$interest = $inter / 1200;
					$roi = "10.50%";
				}
		}
		
		else if($car_price_category =='B')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.25;
					$interest = $inter / 1200;
					$roi = "14.25%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 12.50;
					$interest = $inter / 1200;
					$roi = "12.50%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 11.25;
					$interest = $inter / 1200;
					$roi = "11.25%";
				}
				else
				{
					$inter = 11.25;
					$interest = $inter / 1200;
					$roi = "11.25%";
				}
		}
		else if($car_price_category =='C')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.25;
					$interest = $inter / 1200;
					$roi = "14.25%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 13.25;
					$interest = $inter / 1200;
					$roi = "13.25%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 11.75;
					$interest = $inter / 1200;
					$roi = "11.75%";
				}
				else
				{
					$inter = 11.75;
					$interest = $inter / 1200;
					$roi = "11.75%";
				}
		}
	}
	else
	{
		if($car_price_category =='A+')
		{
			if($tenure>=12 && $tenure<24)
			{
				$inter = 14.75;
				$interest = $inter / 1200;
				$roi = "14.75%";
				
			}
			else if ($tenure>=24 && $tenure<36)
			{
				$inter = 12.75;
				$interest = $inter / 1200;
				$roi = "12.75%";
			}
			else if ($tenure>=36 && $tenure<60)
			{
				$inter = 10.50;
				$interest = $inter / 1200;
				$roi = "10.50%";
			}
			else
			{
				$inter = 10.50;
				$interest = $inter / 1200;
				$roi = "10.50%";
			}
		}
	else if($car_price_category =='A')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.75;
					$interest = $inter / 1200;
					$roi = "14.75%";
					
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 12.75;
					$interest = $inter / 1200;
					$roi = "12.75%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 10.75;
					$interest = $inter / 1200;
					$roi = "10.75%";
				}
				else
				{
					$inter = 10.75;
					$interest = $inter / 1200;
					$roi = "10.75%";
				}
		}
		else if($car_price_category =='B+')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.75;
					$interest = $inter / 1200;
					$roi = "14.75%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 12.50;
					$interest = $inter / 1200;
					$roi = "13%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 11;
					$interest = $inter / 1200;
					$roi = "11%";
				}
				else
				{
					$inter = 11;
					$interest = $inter / 1200;
					$roi = "11%";
				}
		}
		
		else if($car_price_category =='B')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.75;
					$interest = $inter / 1200;
					$roi = "14.75%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 13;
					$interest = $inter / 1200;
					$roi = "13%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 11.75;
					$interest = $inter / 1200;
					$roi = "11.75%";
				}
				else
				{
					$inter = 11.75;
					$interest = $inter / 1200;
					$roi = "11.75%";
				}
		}
		else if($car_price_category =='C')
		{
			if($tenure>=12 && $tenure<24)
				{
					$inter = 14.7;
					$interest = $inter / 1200;
					$roi = "14.75%";
				}
				else if ($tenure>=24 && $tenure<36)
				{
					$inter = 13.75;
					$interest = $inter / 1200;
					$roi = "13.75%";
				}
				else if ($tenure>=36 && $tenure<60)
				{
					$inter = 12.25;
					$interest = $inter / 1200;
					$roi = "12.25%";
				}
				else
				{
					$inter = 12.25;
					$interest = $inter / 1200;
					$roi = "12.25%";
				}
		}

	}
	
	//$interest= $mroi / 1200;
	
	$emiPerLac = round($Loan_Amount * $interest / (1 - (pow(1/(1 + $interest), $tenure))));

	if($Loan_Amount<=250000)
	{
		$processing_fee=2500;
	}
	else if($Loan_Amount>250000 && $Loan_Amount<=500000)
	{
		$processing_fee=3100;
	}
	else if($Loan_Amount>500000 && $Loan_Amount<=1000000)
	{
		$processing_fee=4000;
	}
	else if($Loan_Amount>1000000)
	{
		$processing_fee=5000;
	}
	else
	{	
		$processing_fee=5000;
	}

$total_cost = ($emiPerLac*$tenure) + $processing_fee;
$total_interest = ($emiPerLac*$tenure) - $Loan_Amount;
$lapercent= ($Loan_Amount / $total_cost) *100;
$Inpercent= ($total_interest / $total_cost) *100;
$pfpercent= ($processing_fee / $total_cost) *100;
$lnpre = substr($lapercent, 0,4);
$inper = substr($Inpercent, 0,4);
$pfper = substr($pfpercent, 0,3);
?>
<div style='position:absolute; z-index:100; margin-left:480px; top:30px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;   color:#a41c2b;'>
	<div><b>PIE CHART</b></div>
<? $total_cost = ($emiPerLac*$tenure) + $processing_fee;
$total_interest = ($emiPerLac*$tenure) - $Loan_Amount;
$lapercent= ($Loan_Amount / $total_cost) *100;
$Inpercent= ($total_interest / $total_cost) *100;
$pfpercent= ($processing_fee / $total_cost) *100;
$lnpre = substr($lapercent, 0,4);
$inper = substr($Inpercent, 0,4);
$pfper = substr($pfpercent, 0,3);
?>
	<!--<div id="p3d_activate">-->
<img src="http://chart.apis.google.com/chart?chs=250x100&cht=p3&chd=t:<? echo $lnpre; ?>,<? echo $inper; ?>,<? echo $pfper; ?>&chxt=x,y&chds=0,100&chxr=0,0,90|1,0,90&chxl=0:|<? echo $lnpre." %"; ?>|<? echo $inper." %"; ?>|<? echo $pfper." %"; ?>&chco=A2D7F6,F4E46C,A56119"/>
<div id="sign">
<ul style="margin:0px; ">
<li style=" background:url(icici_car/amount_sign.gif) no-repeat 0px 4px; ">Loan Amount - <? echo "Rs. ".number_format($Loan_Amount);?></li>
<li style=" background:url(icici_car/interest_sign.gif) no-repeat 0px 4px;">Interest Rate - <? echo "Rs. ".number_format($total_interest); ?></li>
<li style=" background:url(icici_car/fee_sign.gif) no-repeat 0px 4px; ">Fees + Taxes - <? echo "Rs. ".$processing_fee;?></li>
</ul>
</div>
</div>

		  <table width="740" align="center"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" width="27%" height="30" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">Bank Name </td>
        <td align="center" width="15%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">Total Cost </td>
        <td align="center" width="20%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">Monthly Payment </td>
        <td align="center" width="17%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">ROI </td>
        <td align="center" width="21%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#6e3a3f; ">Ex.showroom price</td>
      </tr>
	    </table>
	  <table width="740" align="center"  border="0" cellspacing="0" cellpadding="0">
		  <tr >
        <td width="27%" height="35" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; ">ICICI Bank Car Loan </td>
        <td width="15%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; "><? echo "Rs. ".number_format($total_cost); ?></td>
        <td width="20%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; "><? echo "Rs. ".number_format($emiPerLac); ?></td>
        <td width="17%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; "><? echo $roi;?></td>
        <td width="21%" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; width:176px; "><? echo "Rs. ".number_format($car_price);?></td>
      </tr>
		</table>
<?
//echo number_format($Loan_Amount)."\n".$roi."\n".$tenure."\n".$emiPerLac."\n".$processing_fee;
}

?>
