<?php


$SubjectLine="this is mail from deal4loans.com";
$Message ="hi ranjana, this is to check";

$plemail="ranjana.chauhan@wishfin.com";

$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$headers .= "Cc:".$bfs_ccemailid.""."\n";

 if(mail($plemail,'24 Hour Gurantee Approval Customer', $Message, $headers))
 {
	 echo "mail sent";
 }
?>