<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/personal_loan_eligibility_function.php';
error_reporting('E_ALL');


function DetermineAgeGETDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}

function getsaveagentmapfullertondelhi()
{
	$strstart_date=date('Y-m-d');

	$getagentdetails = "select RequestID From Req_Compaign where (BidderID=1000 and  Reply_Type=1 and Sms_Flag=0 )";
	
	list($alreadyExist,$row)=MainselectfuncNew($getagentdetails,$array = array());
	$rowcontr=count($row)-1;
	$row= mysql_fetch_array($getagentdetails);
	$newrequestid = $row["RequestID"];
	
	if($newrequestid>0)
	{
		//$newrequestid=596832;
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =1000 and Req_Feedback_Bidder1.Feedback_ID>".$newrequestid.") ";
	}
	else
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =1000 and (Req_Feedback_Bidder1.Allocation_Date between '".$strstart_date." 00:00:00' and '".$strstart_date." 23:59:59')) ";
	}
	echo $search_query."<br>";
	echo "<br>";
	
	list($recorcount,$myrow)=MainselectfuncNew($search_query,$array = array());
	$myrowcontr=count($myrow)-1;

	$currentdate=date('d-m-Y');
	$ctr=1;
	
	
$SMSMessage="";
$SMSMessage_new="";
	for($i=0;$i<($recorcount);$i++)
	{
		$SMSMessage="";
$SMSMessage_new="";

		$Name = $myrow[$myrowcontr]['Name'];
		$request = $myrow[$myrowcontr]["Feedback_ID"];
		$Employment_Status = $myrow[$myrowcontr]["Employment_Status"];
		$RequestID=$myrow[$myrowcontr]["RequestID"];
		$Name = $myrow[$myrowcontr]["Name"];
		$City = $myrow[$myrowcontr]["City"];
		$Phone = $myrow[$myrowcontr]["Mobile_Number"];
		$Net_Salary = $myrow[$myrowcontr]["Net_Salary"];
		$Company_Name = $myrow[$myrowcontr]["Company_Name"];
		$Loan_Amount = $myrow[$myrowcontr]["Loan_Amount"];
		$BidderID = "1000";
		$Primary_Acc = $myrow[$myrowcontr]["Primary_Acc"];
		$Add_Comment = $myrow[$myrowcontr]["Add_Comment"];
		$Company_Type = $myrow[$myrowcontr]['Company_Type'];
		$Primary_Acc = $myrow[$myrowcontr]['Primary_Acc'];
		$PL_EMI_Amt = $myrow[$myrowcontr]['PL_EMI_Amt'];
		$company = $Company_Name;
		$EMI_Paid = $myrow[$myrowcontr]['EMI_Paid'];
		$Card_Vintage = $myrow[$myrowcontr]['Card_Vintage'];
		$DOB = $myrow[$myrowcontr]["DOB"];
		$getDOB = DetermineAgeGETDOB($DOB);
		$Bidder_Count = $myrow[$myrowcontr]["Bidder_Count"];
		if($Bidder_Count==1)
		{
				$append="[Exclusive]";
		}
		else
		{
			$append="";
		}
			//get eligibility first/
	$getcompany='select hdfc_bank,fullerton,citibank,barclays  from pl_company_list where company_name="'.$Company_Name.'"';

	list($recorcount1,$grow)=MainselectfuncNew($getcompany,$array = array());
$growcontr = count($grow)-1;


$hdfccategory= $grow[$growcontr]["hdfc_bank"];
$fullertoncategory= $grow[$growcontr]["fullerton"];
$citicategory= $grow[$growcontr]["citibank"];
$barclayscategory = $grow[$growcontr]["barclays"]; 

	$monthsalary = $Net_Salary/12;
	if($monthsalary>=20000)
				{
				}
	if($monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
				{
				}
	if(strlen($citicategory)>0 && $monthsalary>=22000)
				{
				}
				else
				{
					$citigetloanamout="";
					$citiinterestrate="";
				}
							
	if($citigetloanamout>0 || $hdfcgetloanamout>0)
				{
		if($hdfcgetloanamout>0 && $monthsalary>=20000)
				{
		$hdfceligibility=$hdfcgetloanamout." at ".$hdfcinterestrate;
		$hdfcsms="Hdfc -".$hdfceligibility.",";
					}
					else
					{
						$hdfcsms="Hdfc - Not Eligible";
					}

					if($citigetloanamout>0 && $monthsalary>=22000)
					{
		$citibankeligibility=$citigetloanamout." at ".$citiinterestrate;

		$citisms="Citi -".$citibankeligibility.",";
					}
					else
					{
						$citibankeligibility="";
						$citisms="Citibank - Not Eligible";
					}

					if($barclaygetloanamout>0 && $monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
					{
		$barclayseligibility=$barclaygetloanamout." at ".$barclayinterestrate;
		$barclaysms="Barclays -".$barclayseligibility.",";
					}
					else
					{
						$barclaysms="Barclays - Not Eligible";
					}

	

	if(strlen($hdfceligibility)>0 || strlen($citibankeligibility)>0 || strlen($barclayseligibility)>0)
					{
	$compMessage=$hdfcsms."".$citisms."".$barclaysms;
					}
				}
	/*end of */
	if($recorcount>0)
				{
				$message ="Your Personal loan Leads on (".$currentdate.") : ";
				$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",city -".$City.", ".$compMessage;
		
			$SMSMessage = $SMSMessage.$append;
				}

	$getagentdetails_1="select BidderID, Mobile_no, Compaign_ID, Sequence_no, priority From Req_Compaign where (BidderID=1000 and  Reply_Type=1 and Sms_Flag=0 and (priority < Sequence_no))";
		list($recorcount1,$row_1)=Mainselectfunc($getagentdetails_1,$array = array());
	$bid_mobile_no = $row_1['Mobile_no'];
	$bid_compaign_id = $row_1['Compaign_ID'];
	$Sequence_no = $row_1['Sequence_no'];
	$priority = $row_1['priority'];
$Dated = ExactServerdate();

if(strlen(trim($SMSMessage))>0)
		{
			echo "<br>////FinalMessage////// ".$message."-".$SMSMessage."      ///////////<br>";

			if(strlen(trim($bid_mobile_no)) > 0)
				SendSMSforLMS($message.$SMSMessage, $bid_mobile_no);

$newpriority=$priority+1;
		$DataArray = array("RequestID"=>$request , "priority"=>$newpriority);
		$wherecondition ="(Compaign_ID=".$bid_compaign_id.")";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

if(($Sequence_no==$newpriority) && $bid_compaign_id==229)
{
		$DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=928)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	 
}
else if (($Sequence_no==$newpriority) && $bid_compaign_id==928)
{
	$DataArray = array("RequestID"=>$request , "priority"=>'0');
	$wherecondition ="(Compaign_ID=229)";
	Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
}

	$DataArray = array("RequestID"=>$request );
	$wherecondition ="(BidderID=1000 and  Reply_Type=1 and Sms_Flag=0)";
	Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);


	$data = array("BidderID"=>$BidderID , "RequestID"=>$RequestID , "Mobile_Number"=>$bid_mobile_no , "Compaign_ID"=>$bid_compaign_id  );
	$table = 'fullerton_leads_allocation';
	$insert = Maininsertfunc ($table, $data);

		}
		$ctr=$ctr+1;
	}
} //Delhi


	
function getsaveagentmapfullertonmumbai()
{
	$strstart_date=date('Y-m-d');

	$getagentdetails="select RequestID From Req_Compaign where (BidderID=1015 and  Reply_Type=1 and Sms_Flag=0 )";
	
		list($recorcount1,$row)=Mainselectfunc($getagentdetails,$array = array());
	$newrequestid = $row["RequestID"];
	if($newrequestid>0)
	{
		//$newrequestid=596832;
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =1015 and Req_Feedback_Bidder1.Feedback_ID>".$newrequestid.") ";
	}
	else
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =1015 and (Req_Feedback_Bidder1.Allocation_Date between '".$strstart_date." 00:00:00' and '".$strstart_date." 23:59:59')) ";
	}
	list($recorcount,$result)=MainselectfuncNew($search_query,$array = array());
	$currentdate=date('d-m-Y');
	$ctr=1;
	
	
$SMSMessage="";
$SMSMessage_new="";
	for($i=0;$i<($recorcount);$i++)
	{
		$SMSMessage="";
		$SMSMessage_new="";

		$Name = $result[$i]['Name'];
		$request = $result[$i]["Feedback_ID"];
		$Employment_Status = $result[$i]["Employment_Status"];
		$RequestID=$result[$i]["RequestID"];
		$Name = $result[$i]["Name"];
		$City = $result[$i]["City"];
		$Phone = $result[$i]["Mobile_Number"];
		$Net_Salary = $result[$i]["Net_Salary"];
		$Company_Name = $result[$i]["Company_Name"];
		$Loan_Amount = $result[$i]["Loan_Amount"];
		$BidderID = "1015";
		$Primary_Acc = $result[$i]["Primary_Acc"];
		$Add_Comment = $result[$i]["Add_Comment"];
		$Company_Type = $result[$i]['Company_Type'];
		$Primary_Acc = $result[$i]['Primary_Acc'];
		$PL_EMI_Amt = $result[$i]['PL_EMI_Amt'];
		$company = $Company_Name;
		$EMI_Paid = $result[$i]['EMI_Paid'];
		$Card_Vintage = $result[$i]['Card_Vintage'];
		$DOB = $result[$i]["DOB"];
		$getDOB = DetermineAgeGETDOB($DOB);
		$Bidder_Count = $result[$i]["Bidder_Count"];
		if($Bidder_Count==1)
		{
				$append="[Exclusive]";
		}
		else
		{
			$append="";
		}
			//get eligibility first/
	$getcompany='select hdfc_bank,fullerton,citibank,barclays  from pl_company_list where company_name="'.$Company_Name.'"';
	list($recorcount2,$grow)=Mainselectfunc($getcompany,$array = array());
	$hdfccategory= $grow["hdfc_bank"];
	$fullertoncategory= $grow["fullerton"];
	$citicategory= $grow["citibank"];
	$barclayscategory = $grow["barclays"]; 

	$monthsalary = $Net_Salary/12;
	if($monthsalary>=20000)
				{
				}
	if($monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
				{
				}
	if(strlen($citicategory)>0 && $monthsalary>=22000)
				{
				}
				else
				{
					$citigetloanamout="";
					$citiinterestrate="";
				}
							
	if($citigetloanamout>0 || $hdfcgetloanamout>0)
				{
		if($hdfcgetloanamout>0 && $monthsalary>=20000)
				{
		$hdfceligibility=$hdfcgetloanamout." at ".$hdfcinterestrate;
		$hdfcsms="Hdfc -".$hdfceligibility.",";
					}
					else
					{
						$hdfcsms="Hdfc - Not Eligible";
					}

					if($citigetloanamout>0 && $monthsalary>=22000)
					{
		$citibankeligibility=$citigetloanamout." at ".$citiinterestrate;

		$citisms="Citi -".$citibankeligibility.",";
					}
					else
					{
						$citibankeligibility="";
						$citisms="Citibank - Not Eligible";
					}

					if($barclaygetloanamout>0 && $monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
					{
		$barclayseligibility=$barclaygetloanamout." at ".$barclayinterestrate;
		$barclaysms="Barclays -".$barclayseligibility.",";
					}
					else
					{
						$barclaysms="Barclays - Not Eligible";
					}

	
	if(strlen($hdfceligibility)>0 || strlen($citibankeligibility)>0 || strlen($barclayseligibility)>0)
					{
	$compMessage=$hdfcsms."".$citisms."".$barclaysms;
					}
				}
	/*end of */
	if($recorcount>0)
				{
				$message ="Your Personal loan Leads on (".$currentdate.") : ";
				$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",city -".$City.", ".$compMessage;
		
			$SMSMessage = $SMSMessage.$append;
				}

	$getagentdetails_1="select BidderID, Mobile_no, Compaign_ID, Sequence_no, priority From Req_Compaign where (BidderID=1015 and  Reply_Type=1 and Sms_Flag=0 and (priority < Sequence_no))";
	list($recorcount2,$row_1)=Mainselectfunc($getagentdetails_1,$array = array());
	$bid_mobile_no = $row_1['Mobile_no'];
	$bid_compaign_id = $row_1['Compaign_ID'];
	$Sequence_no = $row_1['Sequence_no'];
	$priority = $row_1['priority'];

if(strlen(trim($SMSMessage))>0)
		{
			echo "<br>////FinalMessage////// ".$message."-".$SMSMessage."      ///////////<br>";

			if(strlen(trim($bid_mobile_no)) > 0)
				SendSMSforLMS($message.$SMSMessage, $bid_mobile_no);

$SMSMessage_new=$SMSMessage."-".$bid_mobile_no;
$rc_mobile_no="9811215138";
//if(strlen(trim($rc_mobile_no)) > 0)
				//SendSMS($message.$SMSMessage_new, $rc_mobile_no);

$newpriority=$priority+1;
	 $DataArray = array("RequestID"=>$request , "priority"=>$newpriority);
		$wherecondition ="(Compaign_ID=".$bid_compaign_id.")";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

if(($Sequence_no==$newpriority) && $bid_compaign_id==241)
{
	 $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=929)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	 
}
else if (($Sequence_no==$newpriority) && $bid_compaign_id==929)
{
	 $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=9241)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
}

	 $DataArray = array("RequestID"=>$request);
		$wherecondition ="(BidderID=1015 and  Reply_Type=1 and Sms_Flag=0)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

$data = array("BidderID"=>$BidderID , "RequestID"=>$RequestID , "Mobile_Number"=>$bid_mobile_no , "Compaign_ID"=>$bid_compaign_id  );
	$table = 'fullerton_leads_allocation';
	$insert = Maininsertfunc ($table, $data);

		}
		$ctr=$ctr+1;
	}
	}//Mumbai
	

function getfullertonbangalore()
{
	echo "I M in Bangalore:<br>";
	
$strstart_date=date('Y-m-d');

	$getagentdetails="select RequestID From Req_Compaign where (BidderID=1050 and  Reply_Type=1 and Sms_Flag=0 )";
	list($recorcount1,$row)=Mainselectfunc($getagentdetails,$array = array());
	$newrequestid = $row["RequestID"];
	if($newrequestid>0)
	{
		//$newrequestid=596832;
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =1050 and Req_Feedback_Bidder1.Feedback_ID>".$newrequestid.") ";
	}
	else
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =1050 and (Req_Feedback_Bidder1.Allocation_Date between '".$strstart_date." 00:00:00' and '".$strstart_date." 23:59:59')) ";
	}
		list($recorcount,$result)=MainselectfuncNew($search_query,$array = array());
	$currentdate=date('d-m-Y');
	$ctr=1;
$SMSMessage="";
$SMSMessage_new="";
	for($i=0;$i<($recorcount);$i++)
	{
		$SMSMessage="";
$SMSMessage_new="";

		$Name = $result[$i]['Name'];
		$request = $result[$i]["Feedback_ID"];
		$Employment_Status = $result[$i]["Employment_Status"];
		$RequestID=$result[$i]["RequestID"];
		$Name = $result[$i]["Name"];
		$City = $result[$i]["City"];
		$Phone = $result[$i]["Mobile_Number"];
		$Net_Salary = $result[$i]["Net_Salary"];
		$Company_Name = $result[$i]["Company_Name"];
		$Loan_Amount = $result[$i]["Loan_Amount"];
		$BidderID = "1050";
		$Primary_Acc = $result[$i]["Primary_Acc"];
		$Add_Comment = $result[$i]["Add_Comment"];
		$Company_Type = $result[$i]['Company_Type'];
		$Primary_Acc = $result[$i]['Primary_Acc'];
		$PL_EMI_Amt = $result[$i]['PL_EMI_Amt'];
		$company = $Company_Name;
		$EMI_Paid = $result[$i]['EMI_Paid'];
		$Card_Vintage = $result[$i]['Card_Vintage'];
		$DOB = $result[$i]["DOB"];
		$getDOB = DetermineAgeGETDOB($DOB);
		$Bidder_Count = $result[$i]["Bidder_Count"];
		if($Bidder_Count==1)
		{
				$append="[Exclusive]";
		}
		else
		{
			$append="";
		}
			//get eligibility first/
	$getcompany='select hdfc_bank,fullerton,citibank,barclays  from pl_company_list where company_name="'.$Company_Name.'"';
	list($recorcount2,$grow)=Mainselectfunc($getcompany,$array = array());
	$hdfccategory= $grow["hdfc_bank"];
	$fullertoncategory= $grow["fullerton"];
	$citicategory= $grow["citibank"];
	$barclayscategory = $grow["barclays"]; 

	$monthsalary = $Net_Salary/12;
	if($monthsalary>=20000)
				{
	
				}

	if($monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
				{
	
				}

	if(strlen($citicategory)>0 && $monthsalary>=22000)
				{

				}
				else
				{
					$citigetloanamout="";
					$citiinterestrate="";
				}
							
	if($citigetloanamout>0 || $hdfcgetloanamout>0)
				{
		if($hdfcgetloanamout>0 && $monthsalary>=20000)
				{
		$hdfceligibility=$hdfcgetloanamout." at ".$hdfcinterestrate;
		$hdfcsms="Hdfc -".$hdfceligibility.",";
					}
					else
					{
						$hdfcsms="Hdfc - Not Eligible";
					}

					if($citigetloanamout>0 && $monthsalary>=22000)
					{
		$citibankeligibility=$citigetloanamout." at ".$citiinterestrate;

		$citisms="Citi -".$citibankeligibility.",";
					}
					else
					{
						$citibankeligibility="";
						$citisms="Citibank - Not Eligible";
					}

					if($barclaygetloanamout>0 && $monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
					{
		$barclayseligibility=$barclaygetloanamout." at ".$barclayinterestrate;
		$barclaysms="Barclays -".$barclayseligibility.",";
					}
					else
					{
						$barclaysms="Barclays - Not Eligible";
					}

	
	if(strlen($hdfceligibility)>0 || strlen($citibankeligibility)>0 || strlen($barclayseligibility)>0)
					{
	$compMessage=$hdfcsms."".$citisms."".$barclaysms;
					}
				}
	/*end of */
	if($recorcount>0)
				{
				$message ="Your Personal loan Leads on (".$currentdate.") : ";
				$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",city -".$City.", ".$compMessage;
		
			$SMSMessage = $SMSMessage.$append;
				}

	$getagentdetails_1= "select BidderID, Mobile_no, Compaign_ID, Sequence_no, priority From Req_Compaign where (BidderID=1050 and  Reply_Type=1 and Sms_Flag=0 and (priority < Sequence_no))";
	list($recorcount2,$row_1)=Mainselectfunc($getagentdetails_1,$array = array());
	$bid_mobile_no = $row_1['Mobile_no'];
	$bid_compaign_id = $row_1['Compaign_ID'];
	$Sequence_no = $row_1['Sequence_no'];
	$priority = $row_1['priority'];

if(strlen(trim($SMSMessage))>0)
		{
			echo "<br>////FinalMessage////// ".$message."-".$SMSMessage."      ///////////<br>";

			if(strlen(trim($bid_mobile_no)) > 0)
				SendSMSforLMS($message.$SMSMessage, $bid_mobile_no);

$newpriority=$priority+1;
	 $DataArray = array("RequestID"=>$request , "priority"=>$newpriority);
		$wherecondition ="(Compaign_ID=".$bid_compaign_id.")";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

if(($Sequence_no==$newpriority) && $bid_compaign_id==333)
{
	 $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=930)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

	 
}
else if (($Sequence_no==$newpriority) && $bid_compaign_id==930)
{
	 $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=333)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

}
		$DataArray = array("RequestID"=>$request);
		$wherecondition ="(BidderID=1050 and  Reply_Type=1 and Sms_Flag=0)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);


$data = array("BidderID"=>$BidderID , "RequestID"=>$RequestID , "Mobile_Number"=>$bid_mobile_no , "Compaign_ID"=>$bid_compaign_id  );
	$table = 'fullerton_leads_allocation';
	$insert = Maininsertfunc ($table, $data);


		}
		$ctr=$ctr+1;
	}

	}


function getfullertonpune()
{
	echo "I M in Pune:<br>";
	$strstart_date=date('Y-m-d');

	$getagentdetails= "select BidderID, RequestID, Mobile_no, Compaign_ID, Sequence_no, priority From Req_Compaign where (BidderID=996 and  Reply_Type=1 and Sms_Flag=0 and priority=0)";
		list($recorcount1,$row)=Mainselectfunc($getagentdetails,$array = array());
	$BidderID = $row["BidderID"];
	$newrequestid = $row["RequestID"];
	$Sequence_no = $row["Sequence_no"];
	$priority = $row["priority"];
	$Compaign_ID = $row["Compaign_ID"];
	$strmobile_no=$row["Mobile_no"];

	if($newrequestid>0)
	{
		//$newrequestid=596832;
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =996 and Req_Feedback_Bidder1.Feedback_ID>".$newrequestid.") ";
	}
	else
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =996 and (Req_Feedback_Bidder1.Allocation_Date between '".$strstart_date." 00:00:00' and '".$strstart_date." 23:59:59')) ";
	}

echo $search_query."<br>";
	list($recorcount,$myrow)=Mainselectfunc($search_query,$array = array());
	//echo "get bidder no::".$strmobile_no."<br>";
$recorcount."<br>";
	 $currentdate=date('d-m-Y');
$ctr=1;
	
if ($recorcount>0)
	{
	$SMSMessage="";

	for($i=0;$i<count($recorcount);$i++)
		{

			//$SMSMessage="";
			$request=trim($myrow["Feedback_ID"]);
			$RequestID=trim($myrow["RequestID"]);
			$Name=trim($myrow["Name"]);
			$City=trim($myrow["City"]);
			$Phone=trim($myrow["Mobile_Number"]);
			$Net_Salary=trim($myrow["Net_Salary"]);
			$Company_Name =trim($myrow["Company_Name"]);
			$Loan_Amount=trim($myrow["Loan_Amount"]);
			$BidderID = "996";
			$Primary_Acc=trim($myrow["Primary_Acc"]);
			$Add_Comment=trim($myrow["Add_Comment"]);
			$Company_Type = $myrow['Company_Type'];
			$Primary_Acc = $myrow['Primary_Acc'];
			$PL_EMI_Amt = $myrow['PL_EMI_Amt'];
			$company=$Company_Name;
			$EMI_Paid = $myrow['EMI_Paid'];
			$Card_Vintage = $myrow['Card_Vintage'];
			$DOB=trim($myrow["DOB"]);
			$getDOB =DetermineAgeGETDOB($DOB);
			$Bidder_Count = $myrow["Bidder_Count"];
			if($Bidder_Count==1)
			{
					$append="[Exclusive]";
			}
			else
			{
				$append="";
			}
			
//get eligibility first/
$getcompany='select hdfc_bank,fullerton,citibank,barclays  from pl_company_list where company_name="'.$Company_Name.'"';
list($recorcount2,$grow)=Mainselectfunc($getcompany,$array = array());
$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$citicategory= $grow["citibank"];
$barclayscategory = $grow["barclays"]; 

$monthsalary = $Net_Salary/12;
if($monthsalary>=20000)
			{
//	echo "in hdfc";
//list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm)=@hdfcbank($monthsalary,$PL_EMI_Amt,$Company_Name,$hdfccategory,$getDOB,$Company_Type,$Primary_Acc);
			}

if($monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
			{
//list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm)=@barclays($monthsalary,$PL_EMI_Amt,$Company_Name,$barclayscategory,$getDOB,$City);
			}

if(strlen($citicategory)>0 && $monthsalary>=22000)
			{
//echo "in citi";
	
//for Citibank
//list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm)=@citibank($monthsalary,$PL_EMI_Amt,$Company_Name,$getDOB,$citicategory);
			}
			else
			{
				$citigetloanamout="";
				$citiinterestrate="";
			}
						
if($citigetloanamout>0 || $hdfcgetloanamout>0)
			{
	if($hdfcgetloanamout>0 && $monthsalary>=20000)

				{
	$hdfceligibility=$hdfcgetloanamout." at ".$hdfcinterestrate;
	$hdfcsms="Hdfc -".$hdfceligibility.",";
				}
				else
				{
					$hdfcsms="Hdfc - Not Eligible";
				}

				if($citigetloanamout>0 && $monthsalary>=22000)
				{
	$citibankeligibility=$citigetloanamout." at ".$citiinterestrate;

	$citisms="Citi -".$citibankeligibility.",";
				}
				else
				{
					$citibankeligibility="";
					$citisms="Citibank - Not Eligible";
				}

				if($barclaygetloanamout>0 && $monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
				{
	$barclayseligibility=$barclaygetloanamout." at ".$barclayinterestrate;
	$barclaysms="Barclays -".$barclayseligibility.",";
				}
				else
				{
					$barclaysms="Barclays - Not Eligible";
				}	


if(strlen($hdfceligibility)>0 || strlen($citibankeligibility)>0 || strlen($barclayseligibility)>0)
				{
$compMessage=$hdfcsms."".$citisms."".$barclaysms;
				}
			}
/*end of */
if($recorcount>0)
			{

				$message ="Your Personal loan Leads on (".$currentdate.") : ";
				$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",city -".$City.", ".$compMessage;
			}
			$SMSMessage = $SMSMessage.$append;
			
			$ctr=$ctr+1;

	if(strlen(trim($SMSMessage))>0)
		{
			echo "<br>////FinalMessage////// ".$message."-".$SMSMessage."      ///////////<br>";
			if(strlen(trim($strmobile_no)) > 0)
				SendSMSforLMS($message.$SMSMessage, $strmobile_no);
		}
	
	//if($recorcount>0)
	//	{
//$newpriority=$priority+1;
 $DataArray = array("RequestID"=>$request , "priority"=>'1');
		$wherecondition ="(Compaign_ID=".$Compaign_ID.")";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
if($Compaign_ID==204)
{
		$DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=1226)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

}
else if ($Compaign_ID==1226)
{
		$DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=204)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

		 
}

$data = array("BidderID"=>$BidderID , "RequestID"=>$RequestID , "Mobile_Number"=>$bid_mobile_no , "Compaign_ID"=>$Compaign_ID  );
	$table = 'fullerton_leads_allocation';
	$insert = Maininsertfunc ($table, $data);

		}
}

	}

function getfullertonHyderabad()
{
	echo "I M in Hyderabad:<br>";
	$strstart_date=date('Y-m-d');

	$getagentdetails="select BidderID, RequestID, Mobile_no, Compaign_ID, Sequence_no, priority From Req_Compaign where (BidderID=1012 and  Reply_Type=1 and Sms_Flag=0 and Sequence_no > priority)";
	list($recorcount1,$row)=Mainselectfunc($getagentdetails,$array = array());
	$BidderID = $row["BidderID"];
	$newrequestid = $row["RequestID"];
	$Sequence_no = $row["Sequence_no"];
	$priority = $row["priority"];
	$Compaign_ID = $row["Compaign_ID"];
	$strmobile_no=$row["Mobile_no"];

	if($newrequestid>0)
	{
		//$newrequestid=596832;
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =1012 and Req_Feedback_Bidder1.Feedback_ID>".$newrequestid.") ";
	}
	else
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =1012 and (Req_Feedback_Bidder1.Allocation_Date between '".$strstart_date." 00:00:00' and '".$strstart_date." 23:59:59')) ";
	}

echo $search_query."<br>";
list($recorcount,$myrow)=Mainselectfunc($search_query,$array = array());
 $currentdate=date('d-m-Y');
$ctr=1;
	
if ($recorcount>0)
	{
	$SMSMessage="";

	for($i=0;$i<count($recorcount);$i++)
		{
	//	}
/*	while ($myrow = mysql_fetch_array($result));
		  mysql_free_result($result);
		do
		{*/
			//$SMSMessage="";
			$request=trim($myrow["Feedback_ID"]);
			$RequestID=trim($myrow["RequestID"]);
			$Name=trim($myrow["Name"]);
			$City=trim($myrow["City"]);
			$Phone=trim($myrow["Mobile_Number"]);
			$Net_Salary=trim($myrow["Net_Salary"]);
			$Company_Name =trim($myrow["Company_Name"]);
			$Loan_Amount=trim($myrow["Loan_Amount"]);
			$BidderID = "1012";
			$Primary_Acc=trim($myrow["Primary_Acc"]);
			$Add_Comment=trim($myrow["Add_Comment"]);
			$Company_Type = $myrow['Company_Type'];
			$Primary_Acc = $myrow['Primary_Acc'];
			$PL_EMI_Amt = $myrow['PL_EMI_Amt'];
			$company=$Company_Name;
			$EMI_Paid = $myrow['EMI_Paid'];
			$Card_Vintage = $myrow['Card_Vintage'];
			$DOB=trim($myrow["DOB"]);
			$getDOB =DetermineAgeGETDOB($DOB);
			$Bidder_Count = $myrow["Bidder_Count"];
			if($Bidder_Count==1)
			{
					$append="[Exclusive]";
			}
			else
			{
				$append="";
			}
			
//get eligibility first/
$getcompany='select hdfc_bank,fullerton,citibank,barclays  from pl_company_list where company_name="'.$Company_Name.'"';
list($recorcount2,$grow)=Mainselectfunc($getcompany,$array = array());
$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$citicategory= $grow["citibank"];
$barclayscategory = $grow["barclays"]; 

$monthsalary = $Net_Salary/12;
if($monthsalary>=20000)
			{
			}

if($monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
			{
			}

if(strlen($citicategory)>0 && $monthsalary>=22000)
			{
			}
			else
			{
				$citigetloanamout="";
				$citiinterestrate="";
			}
						
if($citigetloanamout>0 || $hdfcgetloanamout>0)
			{
	if($hdfcgetloanamout>0 && $monthsalary>=20000)

				{
	$hdfceligibility=$hdfcgetloanamout." at ".$hdfcinterestrate;
	$hdfcsms="Hdfc -".$hdfceligibility.",";
				}
				else
				{
					$hdfcsms="Hdfc - Not Eligible";
				}

				if($citigetloanamout>0 && $monthsalary>=22000)
				{
	$citibankeligibility=$citigetloanamout." at ".$citiinterestrate;

	$citisms="Citi -".$citibankeligibility.",";
				}
				else
				{
					$citibankeligibility="";
					$citisms="Citibank - Not Eligible";
				}

				if($barclaygetloanamout>0 && $monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
				{
	$barclayseligibility=$barclaygetloanamout." at ".$barclayinterestrate;
	$barclaysms="Barclays -".$barclayseligibility.",";
				}
				else
				{
					$barclaysms="Barclays - Not Eligible";
				}	

if(strlen($hdfceligibility)>0 || strlen($citibankeligibility)>0 || strlen($barclayseligibility)>0)
				{
$compMessage=$hdfcsms."".$citisms."".$barclaysms;
				}
			}
/*end of */
if($recorcount>0)
			{

				$message ="Your Personal loan Leads on (".$currentdate.") : ";
				$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",city -".$City.", ".$compMessage;
			}
			$SMSMessage = $SMSMessage.$append;
			
			$ctr=$ctr+1;

	if(strlen(trim($SMSMessage))>0)
		{
			echo "<br>////FinalMessage////// ".$message."-".$SMSMessage."      ///////////<br>";
			if(strlen(trim($strmobile_no)) > 0)
				SendSMSforLMS($message.$SMSMessage, $strmobile_no);
		}
	
if($Sequence_no>$priority)
			{
	$newpriority=$priority+1;
	  $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=".$Compaign_ID.")";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

	  if($Sequence_no==$newpriority)
				{
		   if($Compaign_ID==1936)
{
	 $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=247)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

}
else if ($Compaign_ID==247)
{
	 $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=1936)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

	 	 
}
				}
			}
			else
			{
	 	  $DataArray = array("RequestID"=>$request);
		$wherecondition ="(Compaign_ID=".$Compaign_ID.")";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

	 if($Compaign_ID==1936)
{
	 	  $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=247)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

}
else if ($Compaign_ID==247)
{
	 	  $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=1936)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

	 	 
}
			}

$data = array("BidderID"=>$BidderID , "RequestID"=>$RequestID , "Mobile_Number"=>$strmobile_no , "Compaign_ID"=>$Compaign_ID  );
	$table = 'fullerton_leads_allocation';
	$insert = Maininsertfunc ($table, $data);

		}
}

	}

function getfullertonChennai()
{
	echo "I M in Chennai:<br>";
	$strstart_date=date('Y-m-d');

	$getagentdetails= "select BidderID, RequestID, Mobile_no, Compaign_ID, Sequence_no, priority From Req_Compaign where (BidderID=1037 and  Reply_Type=1 and Sms_Flag=0 and Sequence_no > priority)";
	
	list($recorcount,$row)=Mainselectfunc($getagentdetails,$array = array());
	$BidderID = $row["BidderID"];
	$newrequestid = $row["RequestID"];
	$Sequence_no = $row["Sequence_no"];
	$priority = $row["priority"];
	$Compaign_ID = $row["Compaign_ID"];
	$strmobile_no=$row["Mobile_no"];

	if($newrequestid>0)
	{
		//$newrequestid=596832;
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =1037 and Req_Feedback_Bidder1.Feedback_ID>".$newrequestid.") ";
	}
	else
	{
		$search_query="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE (Req_Feedback_Bidder1.AllRequestID= Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID =1037 and (Req_Feedback_Bidder1.Allocation_Date between '".$strstart_date." 00:00:00' and '".$strstart_date." 23:59:59')) ";
	}

echo $search_query."<br>";
list($recorcount,$myrow)=Mainselectfunc($search_query,$array = array());
//echo "get bidder no::".$strmobile_no."<br>";
$recorcount."<br>";
	 $currentdate=date('d-m-Y');
$ctr=1;
	
if ($recorcount>0)
	{
	$SMSMessage="";

	for($i=0;$i<count($recorcount);$i++)
		{

			$request=trim($myrow["Feedback_ID"]);
			$RequestID=trim($myrow["RequestID"]);
			$Name=trim($myrow["Name"]);
			$City=trim($myrow["City"]);
			$Phone=trim($myrow["Mobile_Number"]);
			$Net_Salary=trim($myrow["Net_Salary"]);
			$Company_Name =trim($myrow["Company_Name"]);
			$Loan_Amount=trim($myrow["Loan_Amount"]);
			$BidderID = "1012";
			$Primary_Acc=trim($myrow["Primary_Acc"]);
			$Add_Comment=trim($myrow["Add_Comment"]);
			$Company_Type = $myrow['Company_Type'];
			$Primary_Acc = $myrow['Primary_Acc'];
			$PL_EMI_Amt = $myrow['PL_EMI_Amt'];
			$company=$Company_Name;
			$EMI_Paid = $myrow['EMI_Paid'];
			$Card_Vintage = $myrow['Card_Vintage'];
			$DOB=trim($myrow["DOB"]);
			$getDOB =DetermineAgeGETDOB($DOB);
			$Bidder_Count = $myrow["Bidder_Count"];
			if($Bidder_Count==1)
			{
					$append="[Exclusive]";
			}
			else
			{
				$append="";
			}
			
//get eligibility first/
$getcompany='select hdfc_bank,fullerton,citibank,barclays  from pl_company_list where company_name="'.$Company_Name.'"';
list($recorcount,$grow)=Mainselectfunc($getcompany,$array = array());
$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$citicategory= $grow["citibank"];
$barclayscategory = $grow["barclays"]; 

$monthsalary = $Net_Salary/12;
if($monthsalary>=20000)
			{
//	echo "in hdfc";
//list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm)=@hdfcbank($monthsalary,$PL_EMI_Amt,$Company_Name,$hdfccategory,$getDOB,$Company_Type,$Primary_Acc);
			}

if($monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
			{
//list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm)=@barclays($monthsalary,$PL_EMI_Amt,$Company_Name,$barclayscategory,$getDOB,$City);
			}

if(strlen($citicategory)>0 && $monthsalary>=22000)
			{
//echo "in citi";
	
//for Citibank
//list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm)=@citibank($monthsalary,$PL_EMI_Amt,$Company_Name,$getDOB,$citicategory);
			}
			else
			{
				$citigetloanamout="";
				$citiinterestrate="";
			}
						
if($citigetloanamout>0 || $hdfcgetloanamout>0)
			{
	if($hdfcgetloanamout>0 && $monthsalary>=20000)

				{
	$hdfceligibility=$hdfcgetloanamout." at ".$hdfcinterestrate;
	$hdfcsms="Hdfc -".$hdfceligibility.",";
				}
				else
				{
					$hdfcsms="Hdfc - Not Eligible";
				}

				if($citigetloanamout>0 && $monthsalary>=22000)
				{
	$citibankeligibility=$citigetloanamout." at ".$citiinterestrate;

	$citisms="Citi -".$citibankeligibility.",";
				}
				else
				{
					$citibankeligibility="";
					$citisms="Citibank - Not Eligible";
				}

				if($barclaygetloanamout>0 && $monthsalary>=15000 && ($EMI_Paid>=4 || $Card_Vintage>=4))
				{
	$barclayseligibility=$barclaygetloanamout." at ".$barclayinterestrate;
	$barclaysms="Barclays -".$barclayseligibility.",";
				}
				else
				{
					$barclaysms="Barclays - Not Eligible";
				}	


if(strlen($hdfceligibility)>0 || strlen($citibankeligibility)>0 || strlen($barclayseligibility)>0)
				{
$compMessage=$hdfcsms."".$citisms."".$barclaysms;
				}
			}
/*end of */
if($recorcount>0)
			{

				$message ="Your Personal loan Leads on (".$currentdate.") : ";
				$SMSMessage=$SMSMessage."(".$ctr.") ".$Name."-".$Phone.",Sal- ".$Net_Salary.",Co- ".$Company_Name.",city -".$City.", ".$compMessage;
			}
			$SMSMessage = $SMSMessage.$append;
			
			$ctr=$ctr+1;

	if(strlen(trim($SMSMessage))>0)
		{
			echo "<br>////FinalMessage////// ".$message."-".$SMSMessage."      ///////////<br>";
			if(strlen(trim($strmobile_no)) > 0)
				SendSMSforLMS($message.$SMSMessage, $strmobile_no);
		}
	
	
if($Sequence_no>$priority)
			{
	$newpriority=$priority+1;
	 	  	  $DataArray = array("RequestID"=>$request , "priority"=>$newpriority);
		$wherecondition ="(Compaign_ID=".$Compaign_ID.")";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

	  if($Sequence_no==$newpriority)
				{
		   if($Compaign_ID==2446)
{
	  	  $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=258 and Compaign_ID=2447)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

}
else if ($Compaign_ID==258)
{
	 	 
  	  $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=2446 and Compaign_ID=2447)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

}
elseif($Compaign_ID==2447)
		{
  	  $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=258 and Compaign_ID=2446)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

		}
				}
			}
			else
			{
	 	 	  $DataArray = array("RequestID"=>$request);
		$wherecondition ="(Compaign_ID=".$Compaign_ID.")";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	   if($Compaign_ID==2446)
{
  	  $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=258 and Compaign_ID=2447)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

}
else if ($Compaign_ID==258)
{
	  $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=2446 and Compaign_ID=2447)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
	 	 
}
elseif($Compaign_ID==2447)
		{
 $DataArray = array("RequestID"=>$request , "priority"=>'0');
		$wherecondition ="(Compaign_ID=258 and Compaign_ID=2446)";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);
		}
			}

$data = array("BidderID"=>$BidderID , "RequestID"=>$RequestID , "Mobile_Number"=>$strmobile_no , "Compaign_ID"=>$Compaign_ID  );
	$table = 'fullerton_leads_allocation';
	$insert = Maininsertfunc ($table, $data);

		}
}

	}


main();

function main()
{
	$ShowDate = date("H:i:s");
	$StartTime = "08:00:00";
	$EndTime = "18:00:00";	

if(($ShowDate > $StartTime) && ($ShowDate < $EndTime))			
			{
	//getsaveagentmapfullertondelhi();
	//getsaveagentmapfullertonmumbai();
	//getfullertonbangalore();
	getfullertonpune();
	//getfullertonHyderabad ();
	//getfullertonChennai();

			}
}
?>