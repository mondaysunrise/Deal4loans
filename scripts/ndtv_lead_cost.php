<?php

function checktotalcost($strgetBidderID,$pro_code)
{
	$getMultiplier=ExecQuery("Select Multiplier From Bidders_List Where (BidderID in (".$strgetBidderID.") and Reply_Type=".$pro_code.")");
	$getexactMultiplier=0;
	$newMultiplier = "";
	while($row = mysql_fetch_array($getMultiplier))
	{
		$Multiplier=$row['Multiplier'];
		$newMultiplier[]=$Multiplier; 

	}

	//print_r($newMultiplier);
$getsumcost=array_sum($newMultiplier);
$getsumcost = $getsumcost / 2;
//echo $getsumcost;
		$details[]= $getsumcost;
				
return($details);
}

?>