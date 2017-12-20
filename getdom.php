<style>
.txt_hdbold{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
	font-size:12px;
	color:#0F74D4;
}

.tblpdng_txt{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#000000;
	padding:3px 0px 3px 10px;
}
.txt-hd{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-weight:bold;
	font-size:11px;
	color:#0F74D4;
	padding-left:10px;

}
</style>
<?php

$handle = @fopen("hdfc-personal-loan-eligibility.php", "r");
if ($handle) {
$content="";
    while (!feof($handle)) {
        $buffer = fgets($handle, 4096);
		$content[]=$buffer;
   }
	//print_r($content);

	$getcontent = implode(" ",$content);
	//$getcontent .= $getcontent;
	list($First,$Last) = split('<div id="This_is_for_email">', $getcontent);
//echo $Last;
list($main,$extra) = split('<div id="This_IS_To_Remove"></div>',$Last);
	//$maincontent="<table"
	$getmaincontent ="<table align='center' border='0'> <tr><td align='right'><img src='http://www.deal4loans.com/images/cclogo.gif'></td></tr><tr><td align='center'>";
	$getmaincontent .=$main;
	$getmaincontent .="</td><tr><table>";
echo $getmaincontent;

		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail("ranjana5chauhan@gmail.com",'Welcome to Deal4loans', $getmaincontent, $headers);
    fclose($handle);
}
//fclose($handle);

?> 

