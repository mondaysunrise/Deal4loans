<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
require 'eligiblebidderfuncPL.php';
//for PL salary < 298000

$qry="Select RequestID,Email,City,Updated_Date,City_Other from Req_Loan_Personal Where ((Net_Salary>10000 and Net_Salary<=298000) and Direct_Allocation=1 and  Employment_Status=1 and  Total_Experience=0 and Years_In_Company=0 and (DATE_SUB( NOW() , INTERVAL '00:07' HOUR_MINUTE ) >= Req_Loan_Personal.Updated_Date) and Allocated=0 and (Updated_Date >=DATE_SUB(CURDATE(),INTERVAL 1 DAY))) ";
//$qry="Select * from Req_Loan_Personal Where (RequestID=1200691)";
echo "hello".$qry."<br><br>";
echo "<br><br>";
$result=ExecQuery($qry);
$recordcount = mysql_num_rows($result);
if($recordcount>0)
{
	$arrfinal_bidders="";
	while($row=mysql_fetch_array($result))
	{
		$RequestID = $row["RequestID"];
		$Email = $row["Email"];
		$City = $row["City"];
		$Updated_Date = $row["Updated_Date"];
		$Other_City = $row["City_Other"];

	//update pl table
		echo $updateqry="Update Req_Loan_Personal Set Years_In_Company=1, Total_Experience=1, Is_Permit=1,Dated=Now() Where (RequestID=".$RequestID." and Allocated=0)";
		$updateresult=ExecQuery($updateqry);
	//END update pl table
echo "<br><br>";

		if($City=="Others")
			{
				if(strlen($Other_City)>0)
				{
					$strCity=$Other_City;
				}
				else
				{
					$strCity=$City;
				}
			}
			else
			{
				$strCity=$City;
			}
$Referral_Flag="";
	$source="";
//echo "hello ".$RequestID." - ".$strCity."<br>";
echo "<br><br>";
	//add bidders now	
		list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$RequestID,$strCity,$Referral_Flag,$source);
		$arrFinal_Bid = "";
		while (list ($key,$val) = @each($FinalBidder)) { 
			$arrFinal_Bid[]= $val; 
		} 
	 $getarrfinal_bidders=implode(',',$arrFinal_Bid);

if(strlen($getarrfinal_bidders)>0)
	{
	$Allocated=2;
	}
	else 
	{
		$Allocated=0;
	}


		if(strlen($getarrfinal_bidders)>1)
		{
			echo $qry1="Update Req_Loan_Personal SET Bidderid_Details='".$getarrfinal_bidders."',Allocated='".$Allocated."' Where RequestID=".$RequestID;	
			$result1 = ExecQuery($qry1);
		}
		else
		{
			$product="Personal Loan";	
			$feedback="Not Eligible";
			$plname = $Name;
			include "scripts/feedbackmailerscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: testing4use@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					
		if(($feedback=="Not Eligible") && (strlen($Email)>0))
		{
			mail($Email,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
		}

		}

		//insert updated leads
		echo $insertqry="INSERT INTO pl_salaryclause (plRequestID, plUpdated_Date, pldated, plbidders) VALUE('".$RequestID."', '".$Updated_Date."', NOW(), '".$getarrfinal_bidders."')";
		$insertresult=ExecQuery($insertqry);
//END insert updated leads
	}
	
}

?>