<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$Mobile_No = $_REQUEST['get_Mobile'];
	$Full_Name = $_REQUEST['get_Full_Name'];
	$Email = $_REQUEST['get_Email'];
	$city = $_REQUEST['get_City'];
	$UID = $_REQUEST['get_Id'];
	$Product = $_REQUEST['get_product'];
//print_r($_REQUEST);
if((strlen($Mobile_No)>9) || ((strlen($Email)>0) && ($Email!="Email Id")))
{
	if($UID>0)
	{
		$Dated = ExactServerdate();
		$DataArray = array("Name"=>$Full_Name , "Email"=>$Email , "Mobile_Number"=>$Mobile_No, "City"=>$City );
		$wherecondition ="(IncompeletID=".$UID.")";
		Mainupdatefunc ('Req_Incomplete_Lead', $DataArray, $wherecondition);
		$last_inserted_id = $UID;
		//echo $UpdateSql;
	}
	else
	{
			$Dated = ExactServerdate();
		$DataArray = array("Name"=>$Full_Name , "Email"=>$Email, "Mobile_Number"=>$Mobile_No, "City"=>$City, "Dated"=>$Dated, "Product_Type"=>$Product );
		$table = 'Req_Incomplete_Lead';
		$last_inserted_id = Maininsertfunc ($table, $DataArray);
		
	}
	
	echo $last_inserted_id;		
}
?>
