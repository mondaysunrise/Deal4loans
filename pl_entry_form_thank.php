<?php
require 'scripts/db_init.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

 $requestid= $_POST["Requestid"];
 $Final_Bidder = $_REQUEST['Final_Bidder'];
 
	
$Final_Bid = "";
		while (list ($key,$val) = @each($Final_Bidder)) { 
	$Final_Bid = $Final_Bid."$val,"; 
		}
$Final_Bid = substr($Final_Bid, 0, strlen($Final_Bid)-1); //remove the final comma sign from the final array
//echo "hello".$Final_Bid."<br>";
if(strlen($Final_Bid)>0)
	{
	$Allocated=2;
	}
	else 
	{
		$Allocated=0;
	}

			$DataArray = array("Bidderid_Details"=>$Final_Bid, 'Allocated'=>$Allocated);
			$wherecondition ="(RequestID = '".$requestid."')";
			Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);


	echo "<br>";

	echo "Details has beed addaed";
	
		}
?>