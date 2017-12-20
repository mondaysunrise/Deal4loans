<?php
    require 'scripts/db_init.php';
	require 'scripts/db_init-main.php';
	//require 'scripts/functions.php';
	
	  $Dated = ExactServerdate();
	
	$Mobile_No = $_REQUEST['get_Mobile'];
	$Full_Name = $_REQUEST['get_Full_Name'];
	$Email = $_REQUEST['get_Email'];
	$city = $_REQUEST['get_City'];
	$UID = $_REQUEST['get_Id'];
	$Product = $_REQUEST['get_product'];
//print_r($_REQUEST);
if((strlen($Mobile_No)>9) || (strlen($Email)>0))
{
	if($UID>0)
	{
		//update 
	//	$UpdateSql = "update Req_Incomplete_Lead set Name='$Full_Name', Email = '$Email', Mobile_Number = '$Mobile_No',City = '$city' where  IncompeletID=".$UID;		
	//	$QueryUser = ExecQuery($UpdateSql);
		//echo "gdfsfsdfd";
	$DataArray = array("Name"=>$Full_Name, "Email"=>$Email, "Mobile_Number"=>$Mobile_No, "City"=>$city);
		$wherecondition ="IncompeletID=".$UID;
		Mainupdatefunc ('Req_Incomplete_Lead', $DataArray, $wherecondition);
	
	
		$last_inserted_id = $UID;
		echo $UpdateSql;
	}
	else
	{
		
		//$sql = "INSERT INTO Req_Incomplete_Lead (Name, Email, Mobile_Number, City, Dated, Product_Type) VALUES ('$Full_Name', '$Email', '$Mobile_No','$city', Now(),'$Product')";
		//$result = ExecQuery($sql);
		
		
$dataInsert = array("Name"=>$Full_Name , "Email"=>$Email , "Mobile_Number"=>$Mobile_No , "City"=>$city , "Dated"=>$Dated, "Product_Type"=>$Product );
		$table = 'Req_Incomplete_Lead';
		$insert = Maininsertfunc ($table, $dataInsert);
      
		$last_inserted_id = $insert;
		//$last_inserted_id = mysql_insert_id();
		//echo $sql;
//	echo "Upendra";
	
	}
	
	echo $last_inserted_id;		
}
?>
