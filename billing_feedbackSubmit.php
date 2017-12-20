<?php
require 'scripts/session_checkBilling.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

if(isset($_POST['submit']))
{
	//print_r($_POST);
	$RecordCount = $_POST['RecordCount'];
	for($i=0;$i<$RecordCount;$i++)
	{
		$Payment_Received = $_POST["Payment_Received_".$i."N"];
		$bid = $_POST["BidderID_".$i];
		$Payment_By = $_POST["Payment_By_".$i];
		$Payment_Mode = $_POST["Payment_Mode_".$i];
		$Payment_TDS = $_POST["Payment_TDS_".$i."N"];
		//echo $Payment_Received.",".$bid.",".$Payment_By.",".$Payment_Mode.",".$Payment_TDS."<br>";
		$Payment_Date = $_POST["Payment_Date_".$i];

	//$Payment_Received = $_POST['Payment_Received'];
		$mindate = $_POST['min_date'];
		$explodeMinDate = explode(" ", $mindate);
		$min_date = $explodeMinDate[0];

		if($Payment_Received>0)
		{
			//$sql = "update Bill_Record set Payment_Received='".$Payment_Received."', Payment_Mode='".$Payment_Mode."', Payment_TDS = '".$Payment_TDS."', Payment_By ='".$Payment_By."', Payment_Date ='".$Payment_Date."'  where BID=".$bid;
			//$query = ExecQuery($sql);
		//echo $sql."<br>";
		
		 $DataArray = array("Payment_Received"=>$Payment_Received, "Payment_Mode"=>$Payment_Mode, "Payment_TDS"=>$Payment_TDS, "Payment_By"=>$Payment_By, "Payment_Date"=>$Payment_Date);
		$wherecondition =" BID=".$bid;
		Mainupdatefunc ('Bill_Record', $DataArray, $wherecondition);
		
	
	//exit();	
	}
	}
	header("Location:billing_feedbackDisplay.php?min_date=$min_date");
	exit();
}

?>