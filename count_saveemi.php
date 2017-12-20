<?
require 'scripts/db_init.php';
$total_amtcntrSql="select Amount From totalLoans Where (Name='Totalcountr' and flag=1)";
list($num,$total_amtcntr)=MainselectfuncNew($total_amtcntrSql,$array = array());
$ttl_countrtaken = $total_amtcntr[0]['Amount'];

?>
<table border="0" cellpadding="2" cellspacing="0" style="margin:0px; width:345px;">
<tr>
<td style=" color: #005399; font-family: 'Droid Serif',serif;   font-size: 14px; font-weight: normal;"  width="58%">&nbsp;Quotes taken at Deal4loans
</td>
<td width="42%">
<table border="0" cellpadding="0" cellspacing="0" style="border:#999999 solid 1px; ">
<tr>

<? 
$number=$ttl_countrtaken;
$revarrnumber=str_split($number);
$contstr=count($revarrnumber);
for($i=0; $i<$contstr; $i++)
{ ?>
<td style="height:5px; background-image:url(new-images/Digit-bg.jpg); width:25px; height:30px; font-family:Verdana, Arial, Helvetica, sans-serif;" align="center"><b><? echo $revarrnumber[$i]; ?></b></td>
<? } ?>
</tr>
</table>
</td></tr></table>
