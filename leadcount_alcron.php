<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

$today=Date('Y-m-d');
//$today ="2012-03-22";
	$mindate=$today." 00:00:00";
	$maxdate=$today." 23:59:59";
$currDate = Date('D');
//if($currDate!="Sun")
//{
	$counthdfc="SELECT sum(`hdfc_leadcount`) AS HDFCsm FROM `hdfc_hlnlap_cronlog` WHERE ((`run_date` BETWEEN '".$mindate."' and '".$maxdate."') AND `hdfc_product` =2 AND `hdfc_bidderid` =1329)";
	$hdfcquery=ExecQuery($counthdfc);
	$hdfcrow=mysql_fetch_array($hdfcquery);
	$ttlsm=$hdfcrow['HDFCsm'];
if($ttlsm>0)
	{
	$hContent ="Total HDFC HL Lead count pushed in Today : ".$ttlsm;
	}

	$counthdfclp="SELECT sum(`hdfc_leadcount`) AS HDFCsm FROM `hdfc_hlnlap_cronlog` WHERE ((`run_date` BETWEEN '".$mindate."' and '".$maxdate."') AND `hdfc_product` =5 AND `hdfc_bidderid` =2245)";
	$hdfclpquery=ExecQuery($counthdfclp);
	$hdfclprow=mysql_fetch_array($hdfclpquery);
	$ttlsmlp=$hdfclprow['HDFCsm'];
if($ttlsmlp>0)
	{
	$lapContent ="Total HDFC LAP Lead count pushed in Today : ".$ttlsmlp;
	}

	$counthsbclp="SELECT sum(`hdfc_leadcount`) AS HDFCsm FROM `hdfc_hlnlap_cronlog` WHERE ((`run_date` BETWEEN '".$mindate."' and '".$maxdate."') AND `hdfc_product` =2 AND `hdfc_bidderid` =2456)";
	$hsbclpquery=ExecQuery($counthsbclp);
	$hsbclprow=mysql_fetch_array($hsbclpquery);
	$ttlsmhshl=$hsbclprow['HDFCsm'];
if($ttlsmhshl>0)
	{
	$hshlContent ="Total HSBC HL Lead count pushed in Today : ".$ttlsmhshl;
	}



if($ttlsm>0 || $ttlsmlp>0 || $hshlContent>0)
	{
	$finalcntent=$hContent."<br>".$lapContent."<br>".$hshlContent;
	$Email="mehra3@gmail.com,ranjana@deal4loans.com,rishi@deal4loans.com";
	//$Email="ranjana5chauhan@gmail.com";
	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	mail($Email,'Cron report -Deal4loans', $finalcntent, $headers);
}

//}

?>