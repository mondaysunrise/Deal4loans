<?php
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$leadid = $_REQUEST['leadid'];
	
	$bnkid = $_REQUEST['bnkid'];
	

if(strlen(trim($leadid))>0 && strlen($bnkid)>0)
	{
		$strSQL="";
		$Msg="";

		$result = ("select Bidderid_Details from Req_Loan_Car where RequestID=".$leadid);		
		 list($num_rows,$row)=MainselectfuncNew($result,$array = array());
		$cntr=0;
		
		//$num_rows = mysql_num_rows($result);
		if($num_rows > 0)
		{
			//$row = mysql_fetch_array($result);
$Bddrd_Dtls= $row[$cntr]['Bidderid_Details'];
$arrBddrd_Dtls= explode(",",$Bddrd_Dtls);
$newBidid="";
for($i=0; $i<count($arrBddrd_Dtls);$i++)
	{
	$getbnkid ="select BankID,BidderID from Bidders_List where BidderID=".$arrBddrd_Dtls[$i];	
	 list($num_rows,$nrow)=MainselectfuncNew($getbnkid,$array = array());
		$j=0;
	
	//$rsltgetbnkid = ExecQuery($getbnkid);
	//$nrow = mysql_fetch_array($rsltgetbnkid);
	
	if($nrow[$j]['BankID'] == $bnkid)
		{
			
		}
		else
		{
			$newBidid[]=$nrow[$j]['BidderID'];
		}
	}
	//print_r($newBidid);

$strFinalBidder= implode(",",$newBidid);
   $Dated = ExactServerdate();
if(strlen($strFinalBidder)>0)
			{
//$strSQL="Update Req_Loan_Car Set Bidderid_Details='".$strFinalBidder."', Dated=Now() Where RequestID=".$leadid;
$DataArray = array("Bidderid_Details"=>$strFinalBidder, "Dated"=>$Dated);
$wherecondition ="RequestID=".$leadid;
Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);

			
			}
			else
			{
$strSQL="Update Req_Loan_Car Set Bidderid_Details='".$strFinalBidder."',Allocated=0, Dated=Now() Where RequestID=".$leadid;
			
		$DataArray = array("Bidderid_Details"=>$strFinalBidder, "Allocated"=>0, "Dated"=>$Dated);
$wherecondition ="RequestID=".$leadid;
Mainupdatefunc ('Req_Loan_Car', $DataArray, $wherecondition);	
			}


//$result = ExecQuery($strSQL);
			
		if ($result == 1)
		{
			echo "insert";
		}
		else
		{
			//$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
	}
	}
?>
