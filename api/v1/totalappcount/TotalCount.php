<?php
require '../../../scripts/db_init.php';

//print_r($_SERVER);
	if($_SERVER['PHP_AUTH_USER']=="deal4loans_service_check" && $_SERVER['PHP_AUTH_PW']=="d4l^^Yq" )
    {
		$inputDataresponse = totalappcount();
	
		if(count($inputDataresponse)>0 && $inputDataresponse["totalcount"]>0)
		{
			$return=json_encode($inputDataresponse);	
		}else
		{
			$return = json_encode(array("error"=>"No Count"));	
		}
	}
	else
	{
		$return = json_encode(array("error"=>"notauthorised"));		
	}
	echo $return;

//insert in table
// check for quotes

function totalappcount()
{	
	$total_amtcntr = "select Amount From totalLoans Where (Name='Totalcountr' and flag=1)";
	list($alreadyExist,$total_amtcntr)=MainselectfuncNew($total_amtcntr,$array = array());
	$myrowcontr=count($total_amtcntr)-1;

	$ttl_countrtaken = $total_amtcntr[$myrowcontr]['Amount'];
	$number=$ttl_countrtaken;
$contstr =$ttl_countrtaken;
	if($contstr>0)
	{
		return (array("totalcount"=>$contstr));
	}
	else
	{
		return (array("error"=>"No Count"));
	}
		 

}
 