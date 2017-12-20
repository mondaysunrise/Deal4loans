<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

//echo "ddd";
//print_r($_REQUEST);
		$RequestID = $_REQUEST['RequestID'];
		$getdetails="delete from Req_Loan_Home  Where RequestID='".$RequestID."'";
Maindeletefunc($getdetails,$array = array());
	echo		$getdetails.";<br>";
			//echo $getdetails."<br>";
			//exit();
//	echo $ProductValue;
	//echo ",".$bldReqID;
	
		//	header('Location: http://www.bestloansdeal.com/cronHL.php?ProductValue='.$ProductValue.'&bldReqID='.$bldReqID);
			//exit();
		

 ?>