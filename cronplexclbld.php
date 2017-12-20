<?php
ini_set('max_execution_time', 600);
//require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';


$bldReqID = $_REQUEST['bldReqID'];
$Source = $_REQUEST['Source'];//
$ExistingLoan_Amount = $_REQUEST['Existing_Loan'];//
$Existing_Rate = $_REQUEST['Existing_ROI'];//
$Existing_Bank = $_REQUEST['Existing_Bank'];
$No_of_emipaid = $_REQUEST['Existing_EMIPaid'];//
$Employment_Status = $_REQUEST['Employment_Status'];//
$IncomeAmount = $_REQUEST['Net_Salary'];//
$Name = $_REQUEST['Name'];//
$City = $_REQUEST['City'];//
$City_Other  = $_REQUEST['City_Other'];//
$Phone = $_REQUEST['Phone'];//
$Email = $_REQUEST['Email'];//
$accept = $_REQUEST['accept'];
$IP = $_REQUEST['IP'];
$Is_Valid =  $_REQUEST["Is_Valid"];

if(strlen($City)>2 && strlen($Phone)>9)
		{
//			echo "i m here <br><br>";
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Loan_Personal_ICICI  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9999042489')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
				list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		$myrowcontr=count($myrow)-1;
		
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$Duplicate = "Duplicate";
			}
			else
			{		
				$Dated = ExactServerdate();
				$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$IncomeAmount, 'Loan_Amount'=>$Loan_Amount, 'Dated'=>$Dated, 'source'=>$source, 'IP_Address'=>$IP, 'Updated_Date'=>$Dated, 'Annual_Turnover'=>$Annual_Turnover, 'panel'=>$panel, 'Reference_Code'=>$Reference_Code, 'Existing_Bank'=>$Existing_Bank, 'Existing_Loan'=>$ExistingLoan_Amount, 'Existing_ROI'=>$Existing_Rate, 'Existing_EMIPaid'=>$No_of_emipaid, 'Is_Valid'=>$Is_Valid);
				$ID = Maininsertfunc ('Req_Loan_Personal_ICICI', $dataInsert);
				$ProductValue = $ID;
				$Duplicate = "";

				if($City=="Others" && strlen($City_Other)>0)
				{
					$strcity = $City_Other;
				}
				else
				{
					$strcity = $City;
				}
				if($Employment_Status==1 && $ExistingLoan_Amount>50000 && ((($Existing_Bank=="Axis Bank" || $Existing_Bank=="Bajaj Finserv") && $No_of_emipaid>=1) || (($Existing_Bank=="HDFC Bank" || $Existing_Bank=="INGVysya Bank" || $Existing_Bank=="Kotak Bank" || $Existing_Bank=="Fullerton India" || $Existing_Bank=="Other") && $No_of_emipaid>=12)))
				{
					
					//valid lead
					$fndbidders="Select * from Bidders_List Where (BankID=66 and City like '%".$strcity."%' and Restrict_Bidder=1)";
					list($biddercount,$rowbd)=MainselectfuncNew($fndbidders,$array = array());
				if($biddercount>1)
				{
					$sequenceid = "Select * from lead_allocation_table Where (BidderID=2920 and Citywise like '%".$strcity."%')";
					//echo "Select * from lead_allocation_table Where (BidderID=2920 and Citywise like '%".$strcity."%')";
					list($seqidcount,$seqid)=MainselectfuncNew($sequenceid,$array = array());
					$last_allocated_to = $seqid[0]["last_allocated_to"];
					$total_no_agents = $seqid[0]["total_no_agents"];
				if($strcity=="Delhi" || $strcity=="Noida" || $strcity=="Gurgaon" || $strcity=="Gaziabad" || $strcity=="Sahibabad" || $strcity=="Greater Noida" || $strcity=="Faridabad")
						{
							$strBidID="3407,4412,4292,4293,4300";
						}
				if($strcity=="Mumbai" || $strcity=="Thane" || $strcity=="Navi Mumbai")
						{
							$strBidID="4555,3658,4318,4352";
						}
				if($strcity=="Bangalore")
						{
							$strBidID="4712,4713"; 
						}
					if($total_no_agents>$last_allocated_to)
						{
							$differnce=$last_allocated_to+1;
							//select sequence wise bidderID
							$bidseq="Select * from Req_Compaign Where (BidderID in (".$strBidID.") and Sms_Flag=1 and priority=1 and Sequence_no=".$differnce.")";
						}
						else
						{
							$bidseq= "Select * from Req_Compaign Where (BidderID in (".$strBidID.") and Sms_Flag=1 and priority=1 and Sequence_no=1)";
						}

				list($rowseqcount,$rowseq)=MainselectfuncNew($bidseq,$array = array());
				$BidID = $rowseq[0]["BidderID"];
				$Sequence_no = $rowseq[0]["Sequence_no"];
				if($Sequence_no>0)
					{
						$DataArray = array("last_allocated_to"=>$Sequence_no , "total_lead_count"=>$last_inserted_id);
						$wherecondition ="(BidderID=2920 and Citywise like '%".$strcity."%')";
						Mainupdatefunc ('lead_allocation_table', $DataArray, $wherecondition);
					}
					}
					else
					{
						$bidseq="Select * from Req_Compaign Where (BidderID='".$rowbd[0]["BidderID"]."' and Sms_Flag=1)";
						list($rowseqcount,$rowseq)=MainselectfuncNew($bidseq,$array = array());
						$BidID = $rowseq[0]["BidderID"];
					}
					
					//once we have BIdderID
					if($BidID>0)
					{
					$getSMSSql = "select * from Req_Compaign where (BidderID= '".$BidID."' and Sms_Flag=1)";
			list($numgetSMS,$getSMSQuery)=MainselectfuncNew($getSMSSql,$array = array());
			$SMSMessage='';
			for($z=0;$z<$numgetSMS;$z++)
			{
				$BMobile_no = $getSMSQuery[$z]['Mobile_no'];	
				$currentdate=date('d-m-Y');
				$message ="Your Personal loan Leads on (".$currentdate.") : ";	
				$SMSMessage=$SMSMessage."(1) ".$Name."-".$Phone.",Sal- ".$IncomeAmount.",Co- ".$Company_Name.",Acc-".$Primary_Acc;
				
				if(strlen(trim($BMobile_no)) > 0)
				{
					$strmobile_no = $BMobile_no;
						$appnd="Exclusive BT";

					//$strmobile_no="9811215138";
				 	SendSMSforLMS($message.$SMSMessage.$appnd, $strmobile_no.", ".$BMobile_no);
					
				}
			}
		$Dated = ExactServerdate();
		$DataArray = array("status"=>'1' , "allocated_bidderid"=>$BidID);
		$wherecondition ="(RequestID='".$ProductValue."')";
		Mainupdatefunc ('Req_Loan_Personal_ICICI', $DataArray, $wherecondition);

					}
					//Send SMS
				}

			}
		}//$crap Check
	echo $ProductValue;
	echo ",".$bldReqID;
	echo ",".$Duplicate;
	echo ",".$Allocated;

?>