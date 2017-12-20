<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	
	$get_requestid = $_REQUEST['reqtid'];
	$get_product = $_REQUEST['pro'];
	$affliate_id = $_REQUEST['affid'];
	$loan_disbursed = $_REQUEST['loan_dis'];
	$bidid= $_REQUEST['bidid'];
			

if(strlen(trim($get_requestid))>0)
	{

		//$strSQL1="Update Req_Feedback_Bidder Set Allocated_BidderID='".$bidid."',Loan_Disbursed ='".$loan_disbursed."' Where ( AllRequestID=".$get_requestid." and Reply_Type=".$get_product.")";
		//echo $strSQL;
		//$result11 = ExecQuery($strSQL1);
		$DataArray = array("Allocated_BidderID"=>$bidid, "Loan_Disbursed"=>$loan_disbursed);
		$wherecondition ="(AllRequestID=".$get_requestid." and Reply_Type=".$get_product.")";
		Mainupdatefunc ('Req_Feedback_Bidder', $DataArray, $wherecondition);

		$mindate=date('Y-m')." 00:00:00";
$maxdate=date('Y-m-d')." 23:59:59";

$gettotal_count="select sum(Loan_Disbursed) as total_disbursed from Req_Feedback_Bidder Where  Allocated_BidderID like '%".$bidid."%' and Reply_Type=".$get_product." and BidderID=".$affliate_id." and Allocation_Date between '".$mindate."' and '".$maxdate."'";
list($CheckNumRows,$row)=Mainselectfunc($gettotal_count,$array = array());

//echo "select sum(Loan_Disbursed) as total_disbursed from Req_Feedback_Bidder Where  Allocated_BidderID like '%".$bidid."%' and Reply_Type=".$get_product." and BidderID=".$affliate_id." and Allocation_Date between '".$mindate."' and '".$maxdate."'";
//echo "<br>";
//$row = mysql_fetch_array($gettotal_count);
$total_disbursed = $row['total_disbursed'];

//echo "<br>";
		if($get_product==1)
		{
			//echo "1";
			//echo $bidid;
			//echo "<br>";
			if(($bidid=="Citifinancial" || $bidid=="citifinancial") || $bidid=="citi financial")
			{
				if($total_disbursed<=2500000)
				{

					$total_cost=$loan_disbursed* (0.005);
				}
				elseif($total_disbursed>2500000 && $total_disbursed<=4000000)
				{	
					
					$total_cost=$loan_disbursed * (0.0075);
				}
				elseif($total_disbursed>4000000)
				{
					$total_cost=$loan_disbursed * (0.02);
				}
				

				
			}
			elseif(($bidid=="Barclays" || (strncmp ("barclays", $bidid,8))==0) || (strncmp ("Fullerton", $bidid,8))==0 || (strncmp ("Fullerton", $bidid,9))==0 || ($bidid=="Fullerton") || $bidid=="Barclays Finance")
			{
				if($total_disbursed<=2500000)
				{

					$total_cost=$loan_disbursed * (0.01);
				}
				elseif($total_disbursed>2500000 && $total_disbursed<=4000000)
				{	
					$total_cost=$loan_disbursed * (0.015);
				}

				elseif($total_disbursed>4000000)
				{
					$total_cost=$loan_disbursed * (0.02);
				}
			}
			elseif($bidid=="Citibank" || $bidid=="citibank" || $bidid=="Barclays Finance" || $bidid=="Standard Chartered" || (strncmp ("Standard", $bidid,8))==0)
			{
				
					$total_cost=$loan_disbursed * (0.0075);
				
			}
			elseif(($bidid=="Standard Chartered" || (strncmp ("Standard", $bidid,8))==0))
			{
				
					$total_cost=$loan_disbursed * (0.0075);
				
			}


		}
		elseif($get_product==2)
		{
			if(($bidid=="Axis Bank" || (strncmp ("Axis", $bidid,4))==0) || ($bidid=="Standard Chartered" || (strncmp ("Standard", $bidid,8))==0))
			{
				if($total_disbursed<=4000000)
				{
					$total_cost=$loan_disbursed * (0.002);
				}
				elseif($total_disbursed>4000000)
				{
					$total_cost=$loan_disbursed * (0.0025);
				}
			}
		}


		//$strSQL="Update Req_Feedback_Bidder Set Total_Cost='".$total_cost."',Allocated_BidderID='".$bidid."',Loan_Disbursed ='".$loan_disbursed."' Where ( AllRequestID=".$get_requestid." and Reply_Type=".$get_product.")";
		
		$DataArray2 = array("Total_Cost"=>$total_cost, "Allocated_BidderID"=>$bidid, "Loan_Disbursed"=>$loan_disbursed);
		$wherecondition2 ="( AllRequestID=".$get_requestid." and Reply_Type=".$get_product.")";
		$result = Mainupdatefunc ('Req_Feedback_Bidder', $DataArray2, $wherecondition2);
		
		//echo $strSQL;
		//$result = ExecQuery($strSQL);
		echo $total_cost;	
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}
?>