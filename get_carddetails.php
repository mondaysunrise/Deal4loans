<?php
require 'scripts/db_init.php';
	session_start();
//print_r($_GET);
$CC_Holder=$_REQUEST["cardtype"];
	
//$CC_Holder=1;

	/*if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$CC_Holder=$_REQUEST["CC_Holder"];*/

		if($CC_Holder>0)
	{
		$selectcard=("select * From creditndebit_card_offer where ccndc_offer_type=".$CC_Holder." group by bank_name ");
		
		 list($recordcount,$myrow)=MainselectfuncNew($selectcard,$array = array());
		
		
		
		//echo "select * From creditndebit_card_offer where ccndc_offer_type=".$CC_Holder."<br>";
		

	}
		
//}

$i=1;
while ($i<count($myrow)-1)
{
	//echo $i;
?><table align="center" ><tr><td colspan="3">
	<table width="250" border="0" align="center" cellspacing="0" cellpadding="0" style="border:1px solid #999999;">
		<tr>
			<td class="bldtxt" valign="middle"><a name="SavingsonFuelSpends"></a><div  onload="showdetailsFaq(<? echo $i; ?>,8)" style="background-color: #CCCCCC;"><img src="images/plus.gif" alt="" onload="showdetailsFaq(<? echo $i; ?>,8)" id="imgfaq4"  height="13" width="10"><? echo $myrow[$i]["bank_name"];?></div><div style="display:none; width:600px; overflow:auto; height:70px;" id="divfaq<? echo $i; ?>">
				<table border="0" align="left" cellspacing="0" cellpadding="0">
				<!-------CODE TO VIEW TYPES OF CARDS---------->
<?
	$selecttype=("select * From creditndebit_card_offer where bank_name='".$myrow[$i]["bank_name"]."' and ccndc_offer_type=".$CC_Holder."");
	
	 list($recordcount,$row)=MainselectfuncNew($selecttype,$array = array());

//echo "select * From creditndebit_card_offer where bank_name=".$myrow["bank_name"]."<br>";

$recordcount = count($row);
if($recordcount>0)
	{
while($cntr<count($row))
        {
		
?><!--<input type="text" name="bank_name" id="bank_name" value="<? echo $myrow[$cntr]["bank_name"];?>">-->

		<tr>
			<td width="25" align="left"><input type="checkbox" value="<? echo $row[$cntr]["ccndc_offerid"];?>" name="cetogary[]" id="cetogary" style="border:none" onload="getdetails(this.value);"/></td><td class="nrmltxt"><? echo $row[$cntr]["card_name"];?></td>
		</tr>
				
					<!------------------>
					<? $cntr = $cntr+1;} ?>	
<? $i=$i+1; 
} ?>
</table></div>
	</td>
		</tr>
	
	
	
	</table></td></tr>
	</table>
<? }
?>