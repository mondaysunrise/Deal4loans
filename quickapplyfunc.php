<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';


function getQuickApplyData()
{
	$currentdate =Date('Y-m-d')." 00:00:00";
	echo $currentdate;
	$search_query="Select * from Req_Apply_Here where Dated >= '$currentdate' and Now()";
	 list($recordcount,$row)=MainselectfuncNew($search_query,$array = array());
		$cntr=0;
	
	
	//$result = ExecQuery($search_query);

	$RetriveValues="";
while($cntr<count($row))
        {
        
		$ApplyID = $row[$cntr]["ApplyID"];
		$Name = $row[$cntr]["Name"];
		$Contact= $row[$cntr]["Contact"];
		$Email = $row[$cntr]["Email"];
		$Product_Type = $row[$cntr]["Product_Type"];
		
		$qry ="Select Name,Mobile_Number,Email from ".$Product_Type." where Email='$Email' and Mobile_Number='$Contact' and Dated between '$currentdate' and Now()";
		list($recordcount,$getrow)=MainselectfuncNew($qry,$array = array());
		
		
		 if($recordcount > 0)
		{
			
			$RetriveValues=$RetriveValues.$Name.", ".$Contact.", ".$Product_Type."<BR>";
			$query="Delete from Req_Apply_Here where Email='$Email' and Contact='$Contact' and Dated >='$currentdate' ";
			$deleterowcount=Maindeletefunc($query,$array = array());
		
		}
	 $cntr=$cntr+1;
	 }
	

	 $headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
	$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		mail('globeact@gmail.com','Deleted Lead in Quick Apply',$RetriveValues , $headers);
}

main();

Function main()
{
     getQuickApplyData();
	 
	
}?>



