<?php
require 'scripts/db_init.php';
	session_start();

$CC_content=$_REQUEST["cardcontent"];
$city_name = $_REQUEST["city"];
	
	if($CC_content>0)
	{
		if((strlen($city_name)>0) && $city_name!="Please Select")
		{
			$selectcard="select bank_name,card_name,dinning_offers,shopping_offers,entertainment_offers,travel_offers,petrol_offers,reward_points_offers,other_offers From creditndebit_card_offer where (ccndc_offerid=".$CC_content." and ccndc_approval=1 and city_list='".$city_name."')";
		}
		else
		{
		$selectcard="select bank_name,card_name,dinning_offers,shopping_offers,entertainment_offers,travel_offers,petrol_offers,reward_points_offers,other_offers From creditndebit_card_offer where (ccndc_offerid=".$CC_content." and ccndc_approval=1)";
		}		
	}

 list($recordcount,$row)=MainselectfuncNew($selectcard,$array = array());
for($i=0;$i<count($recordcount);$i++)
{
	$myrow = $row[$i];
	//echo $i;
	//print_r(array_keys($myrow));
	//print_r($myrow);
	

?><table><tr><td colspan="3"  valign="top">
	<table border="0" align="left" cellspacing="0" cellpadding="0" style="border:1px dashed #999999;">
	<tr>
    <td colspan="3" class="bnkbg" height="27"><? echo $myrow["bank_name"]; ?></td>
  </tr>
    <tr>
    <td colspan="3" class="bldtxt" style="padding-left:15px;"><b><? echo $myrow["card_name"]; ?></b></td>
    </tr>
  <tr>
  <tr> <td colspan="3" class="nrmltxt" style="line-height:16px; padding-left:15px;">
  <?

  $value = "";
$arrval=array('bank_name','card_name','dinning_offers','shopping_offers','entertainment_offers','travel_offers','petrol_offers','reward_points_offers','other_offers');
//for($j=2;$j<count($myrow)-2;$j++)
		for($j=2;$j<count($myrow);$j++)
		{
			if($j==2 || $j==9)
			{
				if(strlen($myrow[$arrval[9]])>0 && $j==2)
				{
					$value = $myrow[$arrval[9]];
				}
				else
				{
					if($j==2)
					{
						$value = $myrow[$arrval[2]];
					}
				}

			}
			else
			{
				$value = $myrow[$arrval[$j]];
			}
			//$keyarr=in_array($myrow[$j], $myrow) ;
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
				if($j!=9)
				{
				echo  "<b>".ucfirst($card_offers_type)."</b> :  ".$value;
				}				
			}	
		
		}
		?>
		</td>
		</tr>
		<tr>

    <td colspan="3" class="nrmltxt" style="line-height:16px; padding-left:15px;"><?// echo $myrow["ccndc_features"]; ?></td>
  </tr>  
			
	</table></td><td valign="top"><iframe width="180" height="620" src ="http://www.deal4loans.com/adsense_ccndc.php" border="0" style="border-color:#FFFFFF;"></iframe></td></tr>
	</table>
<? }
?>