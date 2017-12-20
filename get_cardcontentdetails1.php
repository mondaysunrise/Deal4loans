<?php
require 'scripts/db_init.php';
	session_start();

$CC_content=$_REQUEST["cardcontent"];
$city_name = $_REQUEST["city"];
	
	if($CC_content>0)
	{
		if((strlen($city_name)>0) && $city_name!="Please Select")
		{
			$selectcard="select bank_name,card_name,dinning_offers,shopping_offers,entertainment_offers,travel_offers,petrol_offers,reward_points_offers,other_offers,ccndc_diningcity.Dining_".$city_name." AS  newdinning_offers From creditndebit_card_offer LEFT OUTER JOIN ccndc_diningcity ON ccndc_diningcity.allccndc_offerid=creditndebit_card_offer.ccndc_offerid AND ccndc_diningcity.flag=1 where (ccndc_offerid=".$CC_content." and ccndc_approval=1)";
		}
		else
		{
		$selectcard= "select bank_name,card_name,dinning_offers,shopping_offers,entertainment_offers,travel_offers,petrol_offers,reward_points_offers,other_offers From creditndebit_card_offer where (ccndc_offerid=".$CC_content." and ccndc_approval=1)";
		}
	list($CheckRowNR,$myrow)=MainselectfuncNew($selectcard,$array = array());

	}
//$i=1;
for($k=0;$k<$CheckRowNR;$k++)
	{
	//echo $i;
	//print_r(array_keys($myrow));

?><table><tr><td colspan="3"  valign="top">
	<table border="0" align="left" cellspacing="0" cellpadding="0" style="border:1px dashed #999999;">
	<tr>
    <td colspan="3" class="bnkbg" height="27"><? echo $myrow[$k]["bank_name"]; ?></td>
  </tr>
    <tr>
    <td colspan="3" class="bldtxt" style="padding-left:15px;"><b><? echo $myrow[$k]["card_name"]; ?></b></td>
    </tr>
  <tr>
  <tr> <td colspan="3" class="nrmltxt" style="line-height:16px; padding-left:15px;">
  <?
//print_r($myrow[$k]);
  $value = "";
  $j=0;
		for($j=2;$j<count($myrow[$k])-2;$j++)
		{
			//echo "value j :: ".$j."<br>";
			if($j==2 || $j==9)
			{
				if(strlen($myrow[$k][9])>0)
				{
					$value = $myrow[$k][9];
				}
				else
				{
					$value = $myrow[$k][2];
				}

			}
			else
			{
			$value = $myrow[$k][$j];
			}
			//$keyarr=in_array($myrow[$k][$j], $myrow[$k]) ;
			if($j==2 || $j==9)
				{
					//echo "hello";
					$card_offers_type="Dinning Offer";
				}
				elseif($j==3)
				{
					$card_offers_type="Shopping Offers";
				}
				elseif($j==4)
				{
					$card_offers_type="Entertainment Offers";
				}
				elseif($j==5)
				{
					$card_offers_type="Travel Offers";
				}
				elseif($j==6)
				{
					$card_offers_type="Petrol Offers";
				}
				elseif($j==7)
				{
					$card_offers_type="Reward Points Offers";
				}
				elseif($j==8)
				{
					$card_offers_type="Other Offers";
				}
				

			if(strlen($value)>0)
			{
							
				echo  "<b>".ucfirst($card_offers_type)."</b> :  ".$value;
				

				
								//echo "<br>".$explode_card_offers[$j]." :  ".$value."<br>";
			}
			
		
		}
		?>
		</td>
		</tr>
		<tr>

    <td colspan="3" class="nrmltxt" style="line-height:16px; padding-left:15px;"><?// echo $myrow[$k]["ccndc_features"]; ?></td>
  </tr>  
		
	
	
	
	</table></td><td valign="top"><iframe width="180" height="620" src ="http://www.deal4loans.com/adsense_ccndc.php" border="0" style="border-color:#FFFFFF;"></iframe></td></tr>
	</table>
<? }
?>