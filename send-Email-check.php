<?php
error_reporting(E_ALL); 
//require 'scripts/db_init.php';
//	require 'scripts/functions.php';
include "send-Email-Text.php";

		$emailmessage = "<html>
<head>
  <title>Test</title>
</head>
<body><table border='0' cellspacing='0' width='100%' cellpadding='0'bgcolor='#529BE4' style='border-collapse: collapse' bordercolor='#529BE4'><tr><td valign='top' align=center>fgdfgfdgfd
	<img src='http://www.deal4loans.com/images/logo.gif' alt='Deal4Loans'/>
	<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0' type='application/x-shockwave-flash' width='170px' height='423px' id='InsertWidget_681de507-8db6-4aea-b8c4-996ef9aa8634' align='middle'><param name='movie' value='http://www.widgetserver.com/syndication/flash/wrapper/InsertWidget.swf?r=1&appId=681de507-8db6-4aea-b8c4-996ef9aa8634'/><param name='quality' value='high' /><param name='wmode' value='transparent' /><param name='menu' value='false' /> <embed src='http://www.widgetserver.com/syndication/flash/wrapper/InsertWidget.swf?r=1&appId=681de507-8db6-4aea-b8c4-996ef9aa8634'  name='InsertWidget_681de507-8db6-4aea-b8c4-996ef9aa8634'  width='170px' height='423px' quality='high' menu='false' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' wmode='transparent' align='middle' /></object><img style='visibility:hidden;width:0px;height:0px;' border='0' width='0' height='0' src='http://runtime.widgetbox.com/syndication/track/681de507-8db6-4aea-b8c4-996ef9aa8634.gif' /></td></tr></table>
	</body>
</html>";

	echo $emailmessage;
		      
			    $sent_from = "tech@deal4loans.com";	    
				$headers  = 'From: deal4loans <'.$sent_from.'>' . "\r\n";
				
				$headers .= 'Return-Path: <'.$sent_from.'>'."\r\n";  // Return path for errors
				//$headers .= 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				$subject = "Check widgit";
				mail($Email, $subject, $emailmessage, $headers);

				echo "<script>window.close()"."</script>";
	
?>

