<?php
    require 'scripts/session_check.php';
    require 'scripts/db_init.php';
    require 'scripts/functions.php';
//print_r($_REQUEST);
//exit();
    
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        foreach($_POST as $a=>$b)
            $$a=$b; 

    $Name = FixString($Name);
	$RequestID = FixString($RequestID);
	$Phone = FixString($Phone);
	$ChooseBank = FixString($ChooseBank);
	$City = FixString($City);
	//$City_Other = FixString($City_Other);
	$Allocated =  FixString($Allocated);
	$Bidder_Count = FixString($Bidder_Count);
	$source = FixString($source);
	$Dated = ExactServerdate();
	
//echo "This will update the Home Loan Lead Table and allocate the lead to the specified Bidder (ICICI & HDFC)";
		//exit();

    if($ChooseBank=='1')
	{ 
			$Bidder_Count= $Bidder_Count+2;
	}
	elseif($ChooseBank=='2' || $ChooseBank=='3')
	{
		$Bidder_Count= $Bidder_Count+1;
	}

    if((strlen($Name)>0) && (strlen($Phone)>0))
    {
       // $sql = "UPDATE Req_Loan_Home Set  Mobile_Number ='$Phone ', Allocated=1, Bidder_Count='$Bidder_Count', Referrer ='changed', source='$source', Dated=Now() where RequestID='".$RequestID."'";
       
	   $DataArray = array("Mobile_Number"=>$Phone, "Allocated"=>1, "Bidder_Count"=>$Bidder_Count, "Referrer"=>'changed', "source"=>$source, "Dated"=>$Dated);
		$wherecondition ="RequestID='".$RequestID."'";
		Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);
	    
      //  ExecQuery($sql);
       // echo "<br>query".$sql;

		if($ChooseBank=='1')
		{
				
			//$qryICICI="INSERT INTO Req_Feedback_Bidder1 (AllRequestID, BidderID, Reply_Type, Allocation_Date) 
			//Values('$RequestID',9992, 2, Now())";
			
			$dataInsert = array("AllRequestID"=>$RequestID , "BidderID"=>'9992' , "Reply_Type"=>2 , "Allocation_Date"=>$Dated);
			$table = 'Req_Feedback_Bidder1';
			$insert = Maininsertfunc ($table, $dataInsert);
  
			
			//ExecQuery($qryICICI);
			//echo "<br>Query (Both)ICICI::".$qryICICI;
			if($City=="Delhi" || $City=="Noida" || $City=="Gaziabad" || $City=="Gurgaon")
			{
				$Bidderid=662;
			}
			elseif($City=="Pune")
			{
				$Bidderid=668;
			}
			elseif($City=="Bangalore")
			{
				$Bidderid=663;
			}
			elseif($City=="Kolkata")
			{
				$Bidderid=664;
			}
			elseif($City=="Hyderabad")
			{
				$Bidderid=665;
			}
			elseif($City=="Chennai")
			{
				$Bidderid=669;
			}
			elseif($City=="Ahmedabad")
			{
				$Bidderid=666;
			}
			elseif($City=="Mumbai" || $City=="Thane" || $City=="Navi Mumbai")
			{
				$Bidderid=667;
			}
			
		
			//$qryHDFC="INSERT INTO Req_Feedback_Bidder1 (AllRequestID, BidderID, Reply_Type, Allocation_Date) 
			//Values('$RequestID','$Bidderid', 2, Now())";
			//ExecQuery($qryHDFC);
			
			$dataInsert = array("AllRequestID"=>$RequestID , "BidderID"=>$Bidderid , "Reply_Type"=>2 , "Allocation_Date"=>$Dated);
			$table = 'Req_Feedback_Bidder1';
			$insert = Maininsertfunc ($table, $dataInsert);
			
			//echo "<br>Query (Both)HDFC::".$qryHDFC;
		}
		elseif($ChooseBank=='3')
			{
				$Bidderid=9992;
				//$qry="INSERT INTO Req_Feedback_Bidder1 (AllRequestID, BidderID, Reply_Type, Allocation_Date) 
				//Values('$RequestID','$Bidderid', 2, Now())";
				//ExecQuery($sql);
				$dataInsert = array("AllRequestID"=>$RequestID , "BidderID"=>$Bidderid , "Reply_Type"=>2 , "Allocation_Date"=>$Dated);
				$table = 'Req_Feedback_Bidder1';
				$insert = Maininsertfunc ($table, $dataInsert);
				
				//echo "<br>Query HDFC::".$qry;
			}
		elseif($ChooseBank=='2')
		{
			if($City=="Delhi" || $City=="Noida" || $City=="Gaziabad" || $City=="Gurgaon")
			{
				$Bidderid=662;
			}
			elseif($City=="Pune")
			{
				$Bidderid=668;
			}
			elseif($City=="Bangalore")
			{
				$Bidderid=663;
			}
			elseif($City=="Kolkata")
			{
				$Bidderid=664;
			}
			elseif($City=="Hyderabad")
			{
				$Bidderid=665;
			}
			elseif($City=="Chennai")
			{
				$Bidderid=669;
			}
			elseif($City=="Ahmedabad")
			{
				$Bidderid=666;
			}
			elseif($City=="Mumbai" || $City=="Thane" || $City=="Navi Mumbai")
			{
				$Bidderid=667;
			}
			
		
		//$qry="INSERT INTO Req_Feedback_Bidder1 (AllRequestID, BidderID, Reply_Type, Allocation_Date) 
		//	Values('$RequestID','$Bidderid', 2, Now())";
		//	ExecQuery($qry);
			
			$dataInsert = array("AllRequestID"=>$RequestID , "BidderID"=>$Bidderid , "Reply_Type"=>2 , "Allocation_Date"=>$Dated);
			$table = 'Req_Feedback_Bidder1';
			$insert = Maininsertfunc ($table, $dataInsert);
			
	//	echo "<br>Query HDFC::".$qry;
		}
	
		 echo "<script language=javascript>location.href='Contents_Home_Loan_Mustread.php?source=".$source."'"."</script>";
		//echo "<br>insert query::".$qry;

	}
		
    
    else
            {
                echo "<script language=javascript>location.href='Contents_Home_Loan_Mustread.php?source=".$source."'"."</script>";
         
		// echo "Else Part";      
        }
        
}
        ?>
