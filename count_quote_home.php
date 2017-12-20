<?
//require 'scripts/db_init.php';
$total_amtcntr = "select Amount From totalLoans Where (Name='Totalcountr' and flag=1)";
list($alreadyExist,$total_amtcntr)=MainselectfuncNew($total_amtcntr,$array = array());
$myrowcontr=count($total_amtcntr)-1;

$ttl_countrtaken = $total_amtcntr[$myrowcontr]['Amount'];
$number=$ttl_countrtaken;
$revarrnumber=str_split($number);
$contstr=count($revarrnumber);
?><div class="counterbox">
 <ul>
 <?
for($i=0; $i<$contstr; $i++)
{ 
	if(($contstr-$i)==1)
	{ ?>
		<li class="last"><? echo $revarrnumber[$i]; ?></li>
	<? }
	else
	{?>
<li><? echo $revarrnumber[$i]; ?></li>
<? } 
}?>
</ul>
 </div>
