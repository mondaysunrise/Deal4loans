<?php
function getproducttypefrmcode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

function getBiddersList($strProduct,$strRequestID,$strCity)
{   
    $RequestID = $strRequestID;
	$mvarCity = $strCity;
	$mvarType = getproducttypefrmcode($strProduct);
   $qry = "SELECT *,Bidders_List.City as cty FROM Bidders_List LEFT OUTER JOIN Bidders ON Bidders.BidderID=Bidders_List.BidderID WHERE (Bidders_List.Reply_Type=1 and Bidders_List.City LIKE '%".$mvarCity."%' and  Bidders_List.Restrict_Bidder=1 and (Bidders.Define_PrePost= 'PostPaid' or Bidders.Define_PrePost='') and Bidders_List.BankID=17)";
 list($firstcount,$row)=MainselectfuncNew($qry,$array = array());
	$i=0;    $j=0;    $k=0;    $z=0;   $q=0;
   
	for($fc=0;$fc<$firstcount;$fc++)
    {
        $query = $row[$fc]["Query"];
		 $FBidder_Name = $row[$fc]["Bidder_Name"];
        $table = $row[$fc]["Table_Name"];
		$City = $row[$fc]["City"];
		$BankID = $row[$fc]["BankID"];
     //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		//Start For Cap Function
		$TodayYear = date('Y');
		$TodayMonth = date('m');
		$TodayWeek = date('W');
		$TodayDay = date('d');
	$Cap_MinDate = $row[$fc]["Cap_MinDate"];
	
	$CapLead_Count = $row[$fc]["CapLead_Count"];
	$FBidderID = $row[$fc]["BidderID"];	
		
	$Bidderid = $FBidderID;
	$Bidder_Name = $FBidder_Name;

      $City = trim($row["City"]);
		$oldcity = explode(",", $City);
		$newcity = implode ("','",$oldcity) ;
		$propercity="('".$newcity."')";
			
		$query = str_replace("Req_Loan_Personal", " fullerton_exclusivecamp", $query);
		$qry2 = $query." and ".$strProduct.".RequestID ='".$RequestID."'";
		  
        list($recordcount,$result1)=MainselectfuncNew($qry2,$array = array());
        	if($recordcount>0) //(result1)
		{
			$bankid[] = $BankID;
			$BidderID[] = $Bidderid;
			 $BidderName[] = $Bidder_Name;
			}
		}
		
		for($j=0;$j<count($bankid);$j++)
	{
		$getbankid="select * from Bank_Master where BankID=".$bankid[$j];
		   list($rowcount,$bankidresult)=MainselectfuncNew($getbankid,$array = array());
		
		for($jj=0;$jj<$rowcount;$jj++)
		{
			$getbankid =$row[$jj]['Bank_Name'];
			$getbankarr[]=$getbankid;
		
		}
	}
		
	$getbidderID=@array_unique($getbankarr);
	$bidder[]= @array_unique($bankid);
	$bidder[] = @array_unique($getbidderID);

	$bidder[] = @array_unique($BidderID);
	$bidder[] = @array_unique($BidderName);
	
return($bidder);

	}
	?>
