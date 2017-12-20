<? $hlamtcnt="select Amount,countr_amt From totalLoans Where (Name='Totalcountr' and flag=1)";
list($numtotal_amtcntr,$hlamtcntQuery)=MainselectfuncNew($hlamtcnt,$array = array());
$ttl_hltaken = $hlamtcntQuery[0]['Amount'];

$revarrnumber=str_split($ttl_hltaken);
$contstr=count($revarrnumber);
 for($i=0;$i<$contstr;$i++)
{
if($i == $contstr-3 || $i== ($contstr-1) || $i==($contstr-2))
	{
		$lasttxt.='<span style="color:#954D03; font-family:Arial, Helvetica, sans-serif; font-size:19px; font-weight:bold;">'.$revarrnumber[$i].'</span>';
	 }
	else if($i == $contstr-4 || $i== ($contstr-5))
	{	
		$middletxt.='<span style="color:#FEAB0D; font-family:Arial, Helvetica, sans-serif; font-size:26px; font-weight:bold;">'.$revarrnumber[$i].'</span>';
	}
	else
	{
		$starttxt.='<span style="color:#148FD5; font-family:Arial, Helvetica, sans-serif; font-size:24px; font-weight:bold;">'.$revarrnumber[$i].'</span>';
	 }
}
$linkup='<span style="color:#FEAB0D; font-family:Arial, Helvetica, sans-serif; font-size:26px; font-weight:bold;">,</span>';
$linkup2='<span style="color:#148FD5; font-family:Arial, Helvetica, sans-serif; font-size:26px; font-weight:bold;">,</span>';
$total_homeloan_taken= $starttxt."".$linkup2."".$middletxt."".$linkup."".$lasttxt;

?>