<?php
require 'scripts/db_init.php';
session_start();

$CC_Holder=$_REQUEST["card_type"];
	

if($CC_Holder>0)
	{
		$selectcard=("select * From creditndebit_card_offer where (ccndc_offer_type=".$CC_Holder." and ccndc_approval=1) group by bank_name ");
	
 list($recordcount,$myrow)=MainselectfuncNew($selectcard,$array = array());
		$cntr=0;

		$getrecordcount = count($myrow);



$i=1;

while($cntr<count($myrow)-1)
        {	
?><table width="300" border="0" cellspacing="0" cellpadding="0" style=" border-bottom:1px dashed #d4edfb;">
  <tr><td class="bldtxt"  align="left" > <img src="images/plus2.gif" alt="" onClick="showdetailsFaqDc(<? echo $i;?>,12)" id="imgfaqdc<? echo $i;?>"  height="13" width="12" style="cursor:pointer;"> <span  onclick="showdetailsFaqDc(<? echo $i;?>,12)" style="cursor:pointer; font-weight:bold; line-height:17px;" ><? echo $myrow[$i]["bank_name"];?></span><div style="display: none;" id="divfaqdc<? echo $i;?>">
<table width="100%" border="0" align="left" cellspacing="0" cellpadding="0">

			
<?
	$selecttype=("select * From creditndebit_card_offer where bank_name='".$myrow[$i]["bank_name"]."' and ccndc_offer_type=".$CC_Holder."");

//echo "select * From creditndebit_card_offer where bank_name='".$myrow["bank_name"]."' and ccndc_offer_type=".$CC_Holder."<br>";

//$recordcount = mysql_num_rows($selecttype);
 list($recordcount,$row)=MainselectfuncNew($selecttype,$array = array());
		$cntr=0;


if($i>1)
		{
 $r=111+$i;
		}
		else
	{

$r=111;
	}
	$p=100;
if($recordcount>0)
	{
while($cntr<count($row))
        {
//echo $row["ccndc_offerid"]."<br>";
//echo $r;
//echo "<br>";
?>

<tr>
<td width="15" align="left" valign="top"><input type="checkbox" value="<? echo $row[$cntr]["ccndc_offerid"];?>_<? echo $row[$cntr]["bank_name"];?>" name="category_dc[]" id="category_dc" style="border:none; cursor:pointer;" onClick="showdetailsFaqDc(<? echo $r;?>,800)" id="imgfaqdc4"/></td>

<td class="nrmltxt" align="left"><span  onclick="showdetailsFaqDc(<? echo $r;?>,800)" style="cursor:pointer;" ><? echo $row[$cntr]["card_name"];?></span><div style="display:none; float:left;" id="divfaqdc<? echo $r;?>"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="left">
<tr>
<td width="15" align="left" valign="top"><input type="checkbox" value="dinning_offers" name="category_dc_<?php	echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt" align="left">Dinning Offers</td>
</tr>
<tr><td width="15" align="left" valign="top"><input type="checkbox" value="travel_offers" name="category_dc_<?php	echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt" align="left">Travel Offer</td>
</tr>
<tr>
<td width="15" align="left" valign="top"><input type="checkbox" value="shopping_offers" name="category_dc_<?php	echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt" align="left">Shopping Offer</td></tr>

<tr><td width="15" align="left" valign="top"><input type="checkbox" value="entertainment_offers" name="category_dc_<?php	echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt" align="left">Entertainment Offer</td>
</tr>
<tr>
<td width="15" align="left" valign="top"><input type="checkbox" value="petrol_offers" name="category_dc_<?php echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt" align="left">Petrol Offer</td></tr>

<tr><td width="15" align="left" valign="top"><input type="checkbox" value="reward_points_offers" name="category_dc_<?php	echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt">Reward Points Offers</td></tr>

<tr><td width="15" align="left" valign="top"><input type="checkbox" value="other_offers" name="category_dc_<?php	echo $row[$cntr]["ccndc_offerid"]; ?>[]" style="border:none"/></td><td class="nrmltxt" align="left">Other Offers</td>
</tr>
</table>
</div></td></tr>

					
					<? $r=$p+$row[$cntr]["ccndc_offerid"];  $cntr = $cntr+1;} ?>	
<? 
					
} ?>
</table></div>
	</td>
  </tr>
	
	
	
	</table></td></tr>
	</table>
<? $i=$i+1; }
	}
?>