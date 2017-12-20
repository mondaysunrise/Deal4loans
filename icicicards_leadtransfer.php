<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';


$datevar = Date('Y-m-d');

$startprocess="Select icicilog_bidderid From  icicilms_loginlog Where ((icicilog_startdatetime between '".$datevar." 00:00:00' and '".$datevar." 11:00:00') and icicilog_bidderid in (936,69)) group by icicilog_bidderid";

echo $startprocess;
list($recordcount,$row)=MainselectfuncNew($startprocess,$array = array());
if($recordcount<2)
{
	echo "<br>";
	$bidderID = $row[0]["icicilog_bidderid"];
	if($bidderID==936)
	{
		$transferid=69;
	}
	elseif($bidderID==69)
	{
		$transferid=936;
	}

	$DataArray = array("icicilog_bidderid"=>$transferid);
	$wherecondition ="(icicilog_bidderid='".$bidderID."')";
	Mainupdatefunc ('icicilms_allocation', $DataArray, $wherecondition);
}
else
{	}


?>