<?php
require 'scripts/db_init.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$requestid= $_POST["Requestid"];
	$Final_Bidder = $_REQUEST['Final_Bidder'];
	$Final_Bid = implode(",", $Final_Bidder);
	//echo "hello".$Final_Bid."<br>";
	if(strlen($Final_Bid)>0)
	{
		$Allocated=2;
	}
	else 
	{
		$Allocated=0;
	}
	$DataArray = array("Allocated"=>$Allocated, "Bidderid_Details"=>$Final_Bid);
	$wherecondition ="(RequestID=".$requestid.")";
	Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);
	echo "<br>";
	echo "Details has beed added";
}
?>
<br /><br />
<a href="hl_entry_form.php">Go Back</a>