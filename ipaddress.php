<?php
if (!empty($_SERVER['REMOTE_ADDR']))
{
        exit; 
}
else
{

$IP_Remote=$_SERVER['REMOTE_ADDR'];
$Content="cron Ip updated".$IP_Remote;

	$Email="ranjana5chauhan@gmail.com";
	$headers = "From: Deal4loans <no-reply@deal4loans.com>";
	$semi_rand = md5( time() ); 
	$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
	$headers .= "\nMIME-Version: 1.0\n" . 
		"Content-Type: multipart/mixed;\n" . 
		" boundary=\"{$mime_boundary}\""."\n";
	$message = "This is a multi-part message in MIME format.\n\n" . 
	"--{$mime_boundary}\n" . 
	"Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
	"Content-Transfer-Encoding: 7bit\n\n" . 
	$Content . "\n\n";
			mail($Email,'Deal4loans', $message, $headers);

}
?>