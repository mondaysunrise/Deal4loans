<?php

 function AlffliaTotalCost($get_product,$bidid,$total_disbursed)
{
	echo $get_product;
	echo $bidid; 
	echo $total_disbursed;
	if($get_product==1)
		{
			
			if(($bidid=="Citifinancial" || $bidid=="citifinancial") || $bidid=="citi financial")
			{
				if($total_disbursed<=2500000)
				{

					$total_cost=$total_disbursed* (0.005);
				}
				elseif($total_disbursed>2500000 && $total_disbursed<=4000000)
				{	
					
					$total_cost=$total_disbursed * (0.0075);
				}
				elseif($total_disbursed>4000000)
				{
					$total_cost=$total_disbursed * (0.02);
				}
				

				
			}
			elseif(($bidid=="Barclays" || (strncmp ("barclays", $bidid,8))==0) || (strncmp ("Fullerton", $bidid,8))==0 || (strncmp ("Fullerton", $bidid,9))==0 || ($bidid=="Fullerton") || $bidid=="Barclays Finance")
			{
				if($total_disbursed<=2500000)
				{

					$total_cost=$total_disbursed * (0.01);
				}
				elseif($total_disbursed>2500000 && $total_disbursed<=4000000)
				{	
					$total_cost=$total_disbursed * (0.015);
				}

				elseif($total_disbursed>4000000)
				{
					$total_cost=$total_disbursed * (0.02);
				}
			}
			elseif($bidid=="Citibank" || $bidid=="citibank" || $bidid=="Barclays Finance" || $bidid=="Standard Chartered" || (strncmp ("Standard", $bidid,8))==0)
			{
				
					$total_cost=$total_disbursed * (0.0075);
				
			}
			elseif(($bidid=="Standard Chartered" || (strncmp ("Standard", $bidid,8))==0))
			{
				
					$total_cost=$total_disbursed * (0.0075);
				
			}


		}
		elseif($get_product==2)
		{
			if(($bidid=="Axis Bank" || (strncmp ("Axis", $bidid,4))==0) || ($bidid=="Standard Chartered" || (strncmp ("Standard", $bidid,8))==0))
			{
				if($total_disbursed<=4000000)
				{
					$total_cost=$total_disbursed * (0.002);
				}
				elseif($total_disbursed>4000000)
				{
					$total_cost=$total_disbursed * (0.0025);
				}
			}
		}

echo $total_cost;
return($total_cost);
}


?>
