<?php
$txtdate=date('j F y');
$Message2="Dear Team,<br><br><a href='http://deal4loans.com/citibankhl4165/citibank4165dwnld.php' target='_blank'>Click Here</a> to download the Citibank data file as on ".$txtdate."<br> <br>Regards<br>Deal4loans.com";
$to = "shweta.sharma@deal4loans.com,Pratish.yadava@citi.com,b.sridevi@citi.com,Ayush.kumar@citi.com, Ajatasatru.sahoo@citi.com";
$SubjectLine="Citibank Leads on ".$txtdate."";
//$to="ranjana5chauhan@gmail.com";
$headers = "From: deal4loans <no-reply@deal4loans.com>";
$semi_rand = md5( time() ); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
$headers .= "\nMIME-Version: 1.0\n" . 
	"Content-Type: multipart/mixed;\n" . 
	" boundary=\"{$mime_boundary}\""."\n";
//$headers .= "Cc: shweta.sharma@deal4loans.com,Pratish.yadava@citi.com,b.sridevi@citi.com,Ayush.kumar@citi.com, Ajatasatru.sahoo@citi.com"."\n";
$headers .= "Bcc: ranjana5chauhan@gmail.com"."\n";
$message = "This is a multi-part message in MIME format.\n\n" . 
			"--{$mime_boundary}\n" . 
			"Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
			"Content-Transfer-Encoding: 7bit\n\n" . 
			$Message2 . "\n\n";

mail($to, $SubjectLine, $message, $headers);

?>