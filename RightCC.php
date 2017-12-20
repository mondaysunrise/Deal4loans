<?php
//ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
    require 'scripts/db_init_in.php';	
//print_r($_REQUEST);
	$Msg = "";
	$Item_ID = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}
	function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'applyhere_pl.php',
		'Req_Loan_Home' => 'applyhere_hl.php',
		'Req_Loan_Car' => 'applyhere.php',
		'Req_Credit_Card' => 'applyhere_cc.php',
		'Req_Loan_Against_Property' => 'applyhere.php',
		'Req_Business_Loan' => 'Req_Business_Loan_New.php',

	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
		$$a=$b;

	$Type_Loan = FixString($Type_Loan);
	$fullname = FixString($fullname);
	$mobile = FixString($mobile);
	$email_id = FixString($email_id);
	$city = FixString($city);
	$source = FixString($source);
	$IP = getenv("REMOTE_ADDR"); 
	
	$_SESSION['Temp_Name'] = $fullname;
	$_SESSION['Temp_mobile'] = $mobile;
	$_SESSION['Temp_email'] = $email_id;
	$_SESSION['Temp_city'] = $email_id;
	$_SESSION['Temp_loan_type'] = $Type_Loan;

	if((strlen($fullname)>0) && (strlen($mobile)>0))
	{
		$mobile = "0".$mobile;
		$ProductType = 16;
		$Day = date("l");
		$ShowDate = date("Y-m-d H:i:s"); 
		$StartTime = date("Y-m-d 10:10:00");
		$EndTime = date("Y-m-d 17:55:59");
		
		$From_City_List = "Delhi,Gurgaon,Gaziabad,Noida,Faridabad,Greater Noida,Mumbai,Thane,Navi mumbai,Ahmedabad,Pune,Bangalore,Chennai,Kolkata,Hyderabad";
		if((strlen(strpos($From_City_List, $city)) > 0))
		{
			if($ShowDate > $StartTime && $ShowDate < $EndTime && $Day!='Sunday' && isset($source) && $Type_Loan=="Req_Credit_Card")			
			{
				$RetrieveBidder = "select BidderID, BidderContact, Bidder_Name, Query, Always from PLivrBiddersList where City like '%".$City."%' and BlockBidder =1 and Reply_Type='".$ProductType."'";
				$RetrieveBidderQuery = ExecQuery($RetrieveBidder);
				
				$RetrieveNumRows = mysql_num_rows($RetrieveBidderQuery);
				$BidderID = mysql_result($RetrieveBidderQuery,0,'BidderID');
				$BidderContact = mysql_result($RetrieveBidderQuery,0,'BidderContact');
				$Prompt = mysql_result($RetrieveBidderQuery,0,'Bidder_Name');
				$Prompt = $Prompt."D"; 	
				
				$SqlCall="INSERT INTO Req_CC_ivr (Name, Email, Phone, City, Dated, Source, IP_Address) Values ('$fullname', '$email_id', '$mobile', '$city', Now(), '$source', '$IP')";
				$QueryCall=ExecQuery($SqlCall);
				$Customerid = mysql_insert_id();
				//echo $SqlCall;				
				
				$sql_call = "INSERT INTO `call` (`Customer_Id` ,`Prompt` ,`Number`, `Customer_product`, `Prompt_id`, `Prompt_city`, `BicID`) VALUES ('".$Customerid."', '".$Prompt."', '".$BidderContact."', '".$ProductType."', '".$BidderID."', '".$city."','".$BidderID."')";
				$query_call = ExecQuery_in($sql_call);
			//echo "<br>";
		//	echo $sql_call;
	
				$sql_call_log = "INSERT INTO `call_log` (`Customer_Id`, `CustomerNumber`, `Customer_product`) VALUES ('".$Customerid."', '".$mobile."', '".$ProductType."' )";
				$query_call_log = ExecQuery_in($sql_call_log); 
		//	echo "<br>";
		//	echo $sql_call_log;
			}
		}		
		
		$sql = "INSERT INTO Req_Apply_Here( ApplyID, Name, Email, Contact, Product_Type, Dated )
		VALUES ( '', '$fullname', '$email_id', '$mobile', '$Type_Loan', Now() )";
		
		ExecQuery($sql);
		//echo $sql;
		//exit();
		$last_inserted_id = mysql_insert_id();
		$_SESSION['Temp_Last_Inserted'] = $last_inserted_id;

		if(strlen($Type_Loan)>0)
		{
		echo "<script language=javascript>location.href='".getTransferURL($Type_Loan)."?source=".$source."'"."</script>";
		}
		else
			{
			echo "<script language=javascript>location.href='index.php?source=".$source."'"."</script>";
		}
	}
	else
	{
		if(strlen($Type_Loan)>0)
		{
			echo "<script language=javascript>location.href='".getTransferURL($Type_Loan)."?source=".$source."'"."</script>";
		}
		else
		{
			echo "<script language=javascript>location.href='index.php?source=".$source."'"."</script>";

		}
	}
}

?>