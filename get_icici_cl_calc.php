<?php
$Loan_Amount = $_REQUEST["get_loan_amt"];
 $tenure = $_REQUEST["get_tenure"];
  $nroi = $_REQUEST["get_roi"];
 $get_cpc = $_REQUEST["get_cpc"];
 $rate_flag = $_REQUEST["get_rf"];
 

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

//$total_cost= ($emiPerLac*$tenure) + $processing_fee;

//echo number_format($Loan_Amount)."\n".$roi."\n".$tenure."\n".$emiPerLac."\n".$processing_fee;

?>
<table width="840" align="center" border="0" cellspacing="0" cellpadding="0">
	 <tr align="center">

	    <td width="27%" height="35" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; ">ICICI Bank Car Loan </td>
        <td width="15%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; "><? echo number_format($Loan_Amount);?></td>
        <td width="20%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; "><? echo $emiPerLac;?></td>
        <td width="17%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b; "><? echo $roi;?></td>
        <td width="21%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#a41c2b;  width:176px;"><img src="http://www.deal4loans.com/new-images/spacer.gif" width="176" height="8" border="0"></td>
  </tr>
</table>
<?
}

?>
