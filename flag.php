<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

main();

Function main()
{
    
	getRequestpl();
}

function getRequestpl()
{
	
	$search_query="Select * from Req_Loan_Personal where Bidder_Flag IS NULL and (City Like '%Delhi%' or City Like '%Gurgaon%' or City Like '%Gaziabad%' or City Like '%Noida%') and ( Dated >=DATE_SUB(CURDATE(),INTERVAL 1 DAY) or (Dated >='2007-07-11 00:00:00')) ";
	//$result = ExecQuery($search_query);
	list($recordcount,$row)=MainselectfuncNew($search_query,$array = array());
		$cntr=0;
	
	while($cntr<count($row))
        {
		$Customerid = $row[$cntr]["RequestID"];
	
		if(($Customerid %2)==0)
		{
	
		 //ExecQuery("Update Req_Loan_Personal Set Bidder_Flag='1' Where RequestID='".$Customerid."'");
		 
		  $DataArray = array("Bidder_Flag"=>'1');
		$wherecondition ="RequestID='".$Customerid."'";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
        
		 
		}
		else
		{
	
				//$qry="Update Req_Loan_Personal Set Bidder_Flag='0' Where RequestID='".$Customerid."'";
	
				//ExecQuery($qry);
				$DataArray = array("Bidder_Flag"=>'0');
				$wherecondition ="RequestID='".$Customerid."'";
				Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
		}



	}
}