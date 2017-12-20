<?php
require 'scripts/db_init.php';
session_start();

$CC_Holder=$_REQUEST["card_type"];
	

if($CC_Holder>0)
	{
		$selectcard=("select * From creditndebit_card_offer where (ccndc_offer_type=".$CC_Holder."  and ccndc_approval=1) group by bank_name ");
	 list($recordcount,$myrow)=MainselectfuncNew($selectcard,$array = array());
		
		
		
		$getrecordcount = count($myrow);

$i=1;

while($i<count($getrow)-1)
        {
        
	
?><table width="250" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px dashed #d4edfb;" ><tr><td class="bldtxt"  align="left"><img src="images/plus2.gif" alt="" onClick="showdetailsFaq(<? echo $i;?>,13)" id="imgfaq<? echo $i;?>"  height="13" width="12" style="cursor:pointer;"> <span  onclick="showdetailsFaq(<? echo $i;?>,13)" style="cursor:pointer; font-weight:bold;" ><? echo $myrow[$i]["bank_name"];?></span><div style="display: none;" id="divfaq<? echo $i;?>">
<table width="100%" border="0" align="left" cellspacing="0" cellpadding="0">

				
<?
	$selecttype=("select * From creditndebit_card_offer where bank_name='".$myrow[$i]["bank_name"]."' and ccndc_offer_type=".$CC_Holder."");

 list($recordcount,$row)=MainselectfuncNew($selecttype,$array = array());
		$cntr=0;
		
		
//echo "select * From creditndebit_card_offer where bank_name='".$myrow["bank_name"]."' and ccndc_offer_type=".$CC_Holder."<br>";

$recordcount = count($selecttype);
if($i>1)
		{
 $r=100+$i;
		}
		else
	{

$r=100;
	}
	$p=100;
if($recordcount>0)
	{

while($cntr<count($getrow))
        {
//echo $row["ccndc_offerid"]."<br>";
//echo $r;
?>

<tr>
<td width="25" align="left" valign="top"><input type="checkbox" value="<? echo $row["ccndc_offerid"];?>_<? echo $row[$cntr]["bank_name"];?>" name="category_cc[]" id="category_cc" style="border:none; cursor:pointer;" onClick="showdetailsFaq(<? echo $r;?>,800)" id="imgfaq4"/><? //echo $row["ccndc_offerid"];?>

</td>
<td class="nrmltxt" align="left"><span  onclick="showdetailsFaq(<? echo $r;?>,800)" style="cursor:pointer;" ><? echo $row[$cntr]["card_name"];?></span><div style="display:none;" id="divfaq<? echo $r;?>"><table width="100%" border="0" cellspacing="0" cellpadding="0"  align="left">
<tr>
<td width="25" align="left" valign="top"><input type="checkbox" value="dinning_offers" name="category_cc_<?php	 echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt">Dinning Offers </td>
</tr>
<tr><td width="25" align="left" valign="top"><input type="checkbox" value="travel_offers" name="category_cc_<?php echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td align="left" class="nrmltxt">Travel Offer </td>
</tr>
<tr>
<td width="25" align="left" valign="top"><input type="checkbox" value="shopping_offers" name="category_cc_<?php echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt" align="left">Shopping Offer</td></tr><tr><td width="25" align="left" valign="top"><input type="checkbox" value="entertainment_offers" name="category_cc_<?php echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt" align="left">Entertainment Offer</td>
</tr>
<tr>
<td width="25" align="left" valign="top"><input type="checkbox" value="petrol_offers" name="category_cc_<?php echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt" align="left">Petrol Offer</td></tr><tr><td width="25" align="left" valign="top"><input type="checkbox" value="reward_points_offers" name="category_cc_<?php	 echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt" align="left">Reward Points Offers</td></tr><tr><td width="25" align="left" valign="top"><input type="checkbox" value="other_offers" name="category_cc_<?php echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt" align="left">Other Offers</td>
</tr>
</table>
</div></td></tr>


					<? $r=$p+$row[$cntr]["ccndc_offerid"];  $cntr = $cntr+1;} ?>	
<? 
					
} ?>
</table></div>
	</td>
		</tr>
	
	
	
	</table>
<? $i=$i+1; }
	}
?>