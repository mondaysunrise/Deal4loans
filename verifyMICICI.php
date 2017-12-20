<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
		
	$Mobile_No = $_REQUEST['get_Mobile'];
	$stat_code = $_REQUEST['stat_code'];
$Reference_Code = generateNumberNEWc(5);
	

if((strlen($Mobile_No)>9) && (strlen($Reference_Code)>0) && strlen($stat_code)<=0)
{
	$SMSMessage = "Please use this code: ".$Reference_Code."  to activate you loan request at deal4loans.com";

			if(strlen(trim($Mobile_No)) > 0)
			{
				SendSMSforLMS($SMSMessage, $Mobile_No);
			}
	echo $Reference_Code;		
}

function generateNumberNEWc($plength)
{
	if(!is_numeric($plength) || $plength <= 0)
	{
	    $plength = 8;
	}
	if($plength > 32)
	{
	    $plength = 32;
	}

	$chars = '0123456789';
	mt_srand(microtime() * 1000000);
	for($i = 0; $i < $plength; $i++)
	{
	   $key = mt_rand(0,strlen($chars)-1);
	   $pwd = $pwd . $chars{$key};
	}
	   for($i = 0; $i < $plength; $i++)
	{
	    $key1 = mt_rand(0,strlen($pwd)-1);
	    $key2 = mt_rand(0,strlen($pwd)-1);

	    $tmp = $pwd{$key1};
	    $pwd{$key1} = $pwd{$key2};
	    $pwd{$key2} = $tmp;
	}

	return $pwd;
}
?>
