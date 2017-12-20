<?php
	require 'scripts/db_init.php';
	require 'scripts/db_init_in.php';
	require 'ivrfunction.php';

	$ShowDate = date("Y-m-d H:i:s");
	$StartTime = "10:00:00";
	$EndTime = "10:40:59";	
//	$EndTime = "17:59:59";
	$Day = date("l");
	 
	$ExpStartDate = explode(":",$StartTime);
	
	$varTime1  = mktime($ExpStartDate[0],$ExpStartDate[1], $ExpStartDate[2], date("m")  , date("d"), date("Y"));
	$checkTime1 = date("Y-m-d H:i:s", $varTime1);
	$varTime2  = mktime($ExpStartDate[0]+1,$ExpStartDate[1], $ExpStartDate[2], date("m")  , date("d"), date("Y"));
	$checkTime2 = date("Y-m-d H:i:s", $varTime2);
	$varTime3  = mktime($ExpStartDate[0]+2,$ExpStartDate[1], $ExpStartDate[2], date("m")  , date("d"), date("Y"));
	$checkTime3 = date("Y-m-d H:i:s", $varTime3);
	$varTime4  = mktime($ExpStartDate[0]+3,$ExpStartDate[1], $ExpStartDate[2], date("m")  , date("d"), date("Y"));
	$checkTime4 = date("Y-m-d H:i:s", $varTime4);
	$varTime5  = mktime($ExpStartDate[0]+4,$ExpStartDate[1], $ExpStartDate[2], date("m")  , date("d"), date("Y"));
	$checkTime5 = date("Y-m-d H:i:s", $varTime5);
	$varTime6  = mktime($ExpStartDate[0]+5,$ExpStartDate[1], $ExpStartDate[2], date("m")  , date("d"), date("Y"));
	$checkTime6 = date("Y-m-d H:i:s", $varTime6);
	$varTime7  = mktime($ExpStartDate[0]+6,$ExpStartDate[1], $ExpStartDate[2], date("m")  , date("d"), date("Y"));
	$checkTime7 = date("Y-m-d H:i:s", $varTime7);
	$varTime8  = mktime($ExpStartDate[0]+7,$ExpStartDate[1], $ExpStartDate[2], date("m")  , date("d"), date("Y"));
	$checkTime8 = date("Y-m-d H:i:s", $varTime8);
	$varTime9  = mktime($ExpStartDate[0]+8,$ExpStartDate[1], $ExpStartDate[2], date("m")  , date("d"), date("Y"));
	$checkTime9 = date("Y-m-d H:i:s", $varTime9);

	if($ShowDate > $checkTime1 && $ShowDate < $checkTime2 && $Day!='Sunday')			
	{
		$TimeSlab = 1;
		$Durationecho =  "Time Calling Between".$checkTime1." - ".$checkTime2 ; 	
	}
	else if($ShowDate > $checkTime2 && $ShowDate < $checkTime3 && $Day!='Sunday')			
	{
		$TimeSlab = 2;
		$Durationecho =  "Time Calling Between".$checkTime2." - ".$checkTime3 ; 	
	} 
	else if($ShowDate > $checkTime3 && $ShowDate < $checkTime4 && $Day!='Sunday')			
	{
		$TimeSlab = 3;
		$Durationecho =  "Time Calling Between".$checkTime3." - ".$checkTime4 ; 	
	}
	else if($ShowDate > $checkTime4 && $ShowDate < $checkTime5 && $Day!='Sunday')			
	{
		$TimeSlab = 4;
		$Durationecho =  "Time Calling Between".$checkTime4." - ".$checkTime5 ; 	
	}
	else if($ShowDate > $checkTime5 && $ShowDate < $checkTime6 && $Day!='Sunday')			
	{
		$TimeSlab = 5;
		$Durationecho =  "Time Calling Between".$checkTime5." - ".$checkTime6 ; 	
	}
	else if($ShowDate > $checkTime6 && $ShowDate < $checkTime7 && $Day!='Sunday')			
	{
		$TimeSlab = 6;
		$Durationecho =  "Time Calling Between".$checkTime6." - ".$checkTime7 ; 	
	}
	else if($ShowDate > $checkTime7 && $ShowDate < $checkTime8 && $Day!='Sunday')			
	{
		$TimeSlab = 7;
		$Durationecho =  "Time Calling Between".$checkTime7." - ".$checkTime8 ; 	
	}
	else if($ShowDate > $checkTime8 && $ShowDate < $checkTime9 && $Day!='Sunday')			
	{
		$TimeSlab = 8;
		$Durationecho =  "Time Calling Between".$checkTime8." - ".$checkTime9 ; 	
	}
	
	//echo $Durationecho;

$CustomerSql = "select * from Req_PL_ivr where Allocated !=1 and TimeSlab = '$TimeSlab' and  CallonDay = '$Day'";
echo $CustomerSql;
 list($CustomerNumRows,$getrow)=MainselectfuncNew($CustomerSql,$array = array());
		$cntr=0;
//$CustomerQuery = ExecQuery($CustomerSql);
//$CustomerNumRows = mysql_num_rows($CustomerQuery);
//if($CustomerNumRows>0)
//{
	while($cntr<count($getrow))
        {
		echo "hi";
		$RequestID = $getrow[$cntr]['RequestID'];
		$City = $getrow[$cntr]['City'];
		$Product = "Req_PL_ivr";
	//	getBidders($RequestID,$Product,$City);
	 $cntr=$cntr+1;
	 }
//}

?>
