<?php
//This file is not in use now.
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	require 'hdfcplMails.php';	
	
//$LeadID = 405904;

$arrBidderID = array(4649);
$today= date('Y-m-d');
$min_date="2014-07-07 00:00:00";
$max_date="2014-07-07 23:59:59";
for($arr=0;$arr<count($arrBidderID);$arr++)
{
	echo "select  RequestID from Req_Compaign where (Reply_Type=1 and BidderID='".$arrBidderID[$arr]."' and  Sms_Flag=0 and Bank_Name='HDFCB' and  City_Wise='' and  Mobile_no='')";
	echo "<br>";
	$getrequestID=ExecQuery("select  RequestID from Req_Compaign where (Reply_Type=1 and BidderID='".$arrBidderID[$arr]."' and  Sms_Flag=0 and Bank_Name='HDFCB' and  City_Wise='' and  Mobile_no='')");
	$req= mysql_fetch_array($getrequestID);
	echo "<br>";
	$requestrecordcount = mysql_num_rows($getrequestID);
	/*if($req["RequestID"]>0)
	{
		$qry="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = '".$arrBidderID[$arr]."' and Req_Feedback_Bidder1.Reply_Type=1 and Req_Feedback_Bidder1.Feedback_ID>".$req["RequestID"]."  and (Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
		$qry=$qry."group by Req_Loan_Personal.Mobile_Number";
	}
	else
	{*/
		$qry="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal  WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = '".$arrBidderID[$arr]."' and Req_Feedback_Bidder1.Reply_Type=1 and (Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
		$qry=$qry."group by Req_Loan_Personal.Mobile_Number";
	//}
		echo $qry."<br>";
	
		$getLeadDetailsQuery = ExecQuery($qry);
		$getAllocatedLeadNum = mysql_num_rows($getLeadDetailsQuery);
		if($getAllocatedLeadNum>0)
		{
			$smsText = "Started to HDFCB: ".$RequestID."--".$lastInserted;	
			$PhoneNumber = 9971396361;
		//	SendSMS($smsText, $PhoneNumber);
		}

		for($i=0;$i<$getAllocatedLeadNum;$i++)
		{
			echo "<br>*********************************************************************************<br>";
			
			$RequestID = mysql_result($getLeadDetailsQuery,$i,'RequestID');
			$Feedback_ID = mysql_result($getLeadDetailsQuery,$i,'Feedback_ID');
			$BidderID = mysql_result($getLeadDetailsQuery,$i,'BidderID');
		//	$RequestID = 405904;
			getEligibleLead($RequestID,$BidderID);
			
			$updateleadSql = "update Req_Compaign set RequestID='".$Feedback_ID."' where (Reply_Type=1 and BidderID='".$arrBidderID[$arr]."' and  Sms_Flag=0 and Bank_Name='HDFCB' and  City_Wise='' and  Mobile_no='')";
			//$updateleadQuery = ExecQuery($updateleadSql);
			echo "<br>".$updateleadSql;
			
			
			echo "<br>*********************************************************************************<br>";
		}
}	



function getEligibleLead($LeadID,$BidderID)
{
	$sql = "select * from Req_Loan_Personal where RequestID='".$LeadID."'";
	$query = ExecQuery($sql);
	
	$RequestID = mysql_result($query,0,'RequestID');
	$full_name = mysql_result($query,0,'Name');
	$mobile_number = mysql_result($query,0,'Mobile_Number');
	$email_id = mysql_result($query,0,'Email');
	$Company_Name = mysql_result($query,0,'Company_Name');
		
	$city = mysql_result($query,0,'City');
	
	$salary = mysql_result($query,0,'Net_Salary');
	 $primary_acc = mysql_result($query,0,'Primary_Acc');
	if($primary_acc=='')
	{
		$primary_acc = "Others";
	}
	
	$Employment_Status = mysql_result($query,0,'Employment_Status');
	$net_salary = round($salary /12);
	$DOB = mysql_result($query,0,'DOB');
	$Dated = mysql_result($query,0,'Dated');
	$expDOB = explode ("-",$DOB);
	//print_r($expDOB);
	 $getDOB = $expDOB[0]."".$expDOB[1]."".$expDOB[2];
	//echo "<br>";
	 $age = DetermineAgeFromDOB($getDOB);
	
	$Activate = generateNumber(4);
	$app_code = date('dmy')."".$Activate;
	
	$company_cate_type = 3;
	$company_type = "Others";
	
	
	$caqry='Select hdfc_category from hdfc_pl_company_list where (hdfc_company_name="'.$Company_Name.'")';
	$caresult=ExecQuery($caqry);
	$carow=mysql_fetch_array($caresult);
	$category=$carow["hdfc_category"];
	//
	echo $caqry ; 
	echo "<br>";
	if($age<21 || $age>59 )
	{
		$Feedback="because of Age issue<br>";
	}
	else if ($no_of_loans>3)
	{
		$Feedback="because more than 3 loans r running<br>";
	}
	else if($no_emi_paid<2 && $loan_running==2 && $availed_loan_amt>0)
	{
		$Feedback="because Less EMI paid in HDFC pl<br>";
	}
	else
	{
		if($category=="" && $primary_acc=="HDFC Bank" && ($company_cate_type==2 || $company_cate_type==1))
		{
			$category="CAT C";
		}
	
		$hdfcpl="INSERT INTO hdfc_pl_calc_leads (name,age,mobile_number,email_id,company_name,city,company_category,company_type,net_salary,primary_acc,no_of_loan_running,clubbed_emi,availed_loan_amt,pl_emi_amt,pl_tenure,pl_no_of_emi,Dated,AppID,DOB,Employment_Status,RequestID) VALUES ('".$full_name."','".$age."','".$mobile_number."','".$email_id."','".$Company_Name."','".$city."','".$company_cate_type."','".$company_type."','".$salary."','".$primary_acc."','".$no_of_loans."','".$clubbed_emi."','".$availed_loan_amt."','".$hdfc_emi_amt."','".$hdfc_loan_tenure."','".$no_emi_paid."', '".$Dated."','".$app_code."', '".$DOB."','".$Employment_Status."','".$RequestID."')";
	$hdfcresult=ExecQuery($hdfcpl);
	echo $hdfcpl."<br>";
		$last_inserted_id = mysql_insert_id();
	
		list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Bsc_chck($city,$net_salary,$clubbed_emi,$category,$age,$company_type,$primary_acc,$company_cate_type,$hdfc_total_outstanding);
	
	
		
		if($getloanamout>0)// ELIGIBLE LEAD
		{
			//update
			 $updateSql = "update hdfc_pl_calc_leads set eligible='Yes', eligible_loanAmt ='".$getloanamout."', eligible_interestRate ='".$interestrate."',  eligible_emi ='".$get_emi."', eligible_term ='".$getterm."', MAIL_SENT='Sent' where hdfcplid ='".$last_inserted_id."'";
			$updateQuery = ExecQuery($updateSql);	
		
			$sendMailsBidders = getCityMails($city,$last_inserted_id);	
		
		}
		else
		{
			//update Not Eligible
			 $updateSql = "update hdfc_pl_calc_leads set eligible='No' where hdfcplid ='".$last_inserted_id."'";
			$updateQuery = ExecQuery($updateSql);	
		}
		echo "<br>".$updateSql;
		
	}

}

function DetermineAgeFromDOB ($YYYYMMDD_In)
	{
	  $yIn=substr($YYYYMMDD_In, 0, 4);
	  $mIn=substr($YYYYMMDD_In, 4, 2);
	  $dIn=substr($YYYYMMDD_In, 6, 2);
	  $ddiff = date("d") - $dIn;
	  $mdiff = date("m") - $mIn;
	  $ydiff = date("Y") - $yIn;
	  if ($mdiff < 0)
	  {
		$ydiff--;
	  } elseif ($mdiff==0)
	  {
		if ($ddiff < 0)
		{
		  $ydiff--;
		}
	  }
	  return $ydiff;
	}

function getdob($DOB)
{
	if(($DOB>50 && $DOB<=53) || ($DOB<50 && $DOB>=18)){	$term = 60; $print_term = "5"; }
	else if(($DOB>50 && $DOB<=54))	{ $term = 60;	$print_term = "5";	}
	else if(($DOB>50 && $DOB<=55)) { $term = 60; $print_term = "5";	}		
	else if($DOB>55 && $DOB<=56) { $term = 48; $print_term = "4"; }
	else if($DOB>56 && $DOB<=57) { $term = 36; $print_term = "3"; }
	else if($DOB>57 && $DOB<=58) { $term = 24;	$print_term = "2";}
	else if($DOB>58 && $DOB<=59) { $term = 12;	$print_term = "1"; }
	else if ($DOB>=60)	{ $term = 0; $print_term = "0"; }
	$getterm[]= $term;		$getterm[]= $print_term;		return($getterm);
}

function  HDFC_Bsc_chck($city,$net_salary,$clubbed_emi,$category,$DOB,$company_type,$primary_acc,$company_cate_type,$hdfc_total_outstanding)
{
	$exactnet_salary= $net_salary;
list($term,$print_term)=getdob($DOB);

	$qry="Select hdfc_splid from hdfc_spl_city_rates where (hdfc_city='".$city."' and hdfc_net_salary<='".$net_salary."')";
	$result=ExecQuery($qry);
	$recordcount = mysql_num_rows($result);
echo $qry;
echo "<br>";
	if($company_type=="BPO")
	{
		//echo "1<br>";
		if((($category=="Super A" || $category=="CAT A" || $category=="CAT B" || $category=="CSA A" || $category=="CSA B") && $net_salary>=30000) || (($category=="CAT C" || $category=="CSA C") && $net_salary>=20000 ))
		{   
			if($recordcount>0)
			{
				list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding);
			}
			else
			{
				list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding);
			}
		}
		else
		{
			$Feedback="";
			//echo "<br>Company CLAUSE BPO: NOT ELIGIBLE<br>";
		}
	}
	else if($company_type=="Insurance")
	{
		//echo "2<br>";
		if($net_salary>=25000)
		{
		if($recordcount>0)
			{
	if(strlen($category)>0)
{
list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding);
}
else
{
	list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding);
}
			}
			else
			{
				list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding);
			}
		}
		else
		{	$Feedback="";
				//echo "<br>Company CLAUSE Insurance: NOT ELIGIBLE<br>";
		}
	}
	else
	{

		if($primary_acc=="HDFC Bank" || (strncmp ("HDFC", $primary_acc,4))==0)
		{
			//echo "3i<br>";
			//echo $city ;
			//echo $net_salary;
			if(($net_salary>=12000 && ($city=="Mumbai" || $city=="Delhi" || $city=="Chennai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune")) 
			|| 
			($net_salary>=10000 && ($city=="Cochin" || $city=="Kolkata" || $city=="Calcutta" || $city=="Ahmedabad"))
			||
			($net_salary>=8000 && ($city!="Cochin" && $city!="Kolkata" && $city!="Calcutta" && $city!="Ahmedabad" && $city!="Mumbai" && $city!="Delhi" && $city!="Chennai" && $city!="Hyderabad" && $city!="Bangalore" && $city!="Pune")))
			{
				//echo "ex: ".$exactnet_salary."c: ".$category."t: ".$term;
				if($recordcount>0)
				{
	if(strlen($category)>0)
{
list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding);
}
else
{	list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding);
}
				}
				else
				{
list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding);
				}
			}
			else
			{
				//Company CLAUSE Other with AccHDfC: NOT ELIGIBLE
				 $Feedback="";
			}
			
		}
		else
		{
			//echo "3j<br>";
			if(($net_salary>=15000 && ($city=="Mumbai" || $city=="Delhi" || $city=="Chennai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune")) 
			|| 
			($net_salary>=12000 && ($city=="Cochin" || $city=="Kolkata" || $city=="Calcutta" || $city=="Ahmedabad"))
			||
			($net_salary>=10000 && ($city!="Cochin" && $city!="Kolkata" && $city!="Calcutta" && $city!="Ahmedabad" && $city!="Mumbai" && $city!="Delhi" && $city!="Chennai" && $city!="Hyderabad" && $city!="Bangalore" && $city!="Pune")))
			{
				if($recordcount>0)
				{
					if(strlen($category)>0)
{
list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding);
}
else
{
	list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding);
}
				}
				else
				{
					list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding);
				}

			}
			else
			{
					$Feedback="";
					 //$Feedback="Company CLAUSE Other without HDfC: NOT ELIGIBLE<br>";
			}

		}
	}

	$details[]= $interestrate;
	$details[]= $get_emi;
	$details[]= $getterm;
	$details[]= $getloanamout;
	return($details);
}


Function  HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding)
{
	
	if($clubbed_emi>0)
	{
		$net_salary=$exactnet_salary-$clubbed_emi;
	}
	/*echo "basic calc";
	echo "<br>";
	echo $exactnet_salary."c: ".$category." ".$term;
	echo "<br>";*/

if($category=="Super A" || $category=="Cat A" || $category=="CAT A" || $category=="CSA A")
	{
		if($exactnet_salary < 35000)
			{
			$interestrate = "18%";
			$intr=18/1200;
			}
		else if($exactnet_salary>= 35000 && $exactnet_salary< 50000)
			{
			$interestrate = "17%";
			$intr=17/1200;
			}
		else if($exactnet_salary>= 50000 && $exactnet_salary< 75000)
			{
			$interestrate = "16%";
			$intr=16/1200;
			}
		else
			{
			$interestrate = "15.5%";
			$intr=15.5/1200;
			}

		if($exactnet_salary>=25000)
		{
			if($term==12)
			{
				if($net_salary>0)
				{
					$Loan_Amount_Eli=$net_salary * 5;
				}
				else
				{
					$Loan_Amount_Eli=$exactnet_salary * 5;
				}
				$getterm=1;
			}
			else if($term==24)
			{
				if($net_salary>0)
				{
					$Loan_Amount_Eli=$net_salary * 9;
				}
				else
				{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				}
				$getterm=2;
			}
			else if($term==36)
			{
				if($net_salary>0)
				{
					$Loan_Amount_Eli=$net_salary * 13;
				}
				else
				{
					$Loan_Amount_Eli=$exactnet_salary * 13;
				}

				$getterm=3;
			}
			else if($term==48)
			{
				if($net_salary>0)
				{
					$Loan_Amount_Eli=$net_salary * 15;
				}
				else
				{
				$Loan_Amount_Eli=$exactnet_salary * 15;
				}
				$getterm=4;
			}
			else if($term==60)
			{
				if($net_salary>0)
				{
					$Loan_Amount_Eli=$net_salary * 18;
				}
				else
				{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				}
				$getterm=5;
			}
			else
			{
				if($net_salary>0)
				{
					$Loan_Amount_Eli=$net_salary * 18;
				}
				else
				{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				}
				$getterm=5;
			}
		}
		else// Salary less then 25 k
		{
			if($category=="Super A")
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
						$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 11;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 11;
						}
					$getterm=3;
					}
				else if($term==48)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 13;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 13;
						}
						$getterm=4;
					}
				else if($term==60)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 15;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 15;
						}
					$getterm=5;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 15;
						}
						else
						{
						$Loan_Amount_Eli=$exactnet_salary * 15;
						}
					$getterm=5;
					}
			}
			else
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 11;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 11;
						}
					$getterm=3;
					}
				else if($term==48)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 13;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 13;
						}
					$getterm=4;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 13;

						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 13;
						}
					$getterm=4;
					}
			}


		}
		if($Loan_Amount_Eli>1500000)
			{
			$getloanamout=1500000;
			}
		else
			{
			$getloanamout=$Loan_Amount_Eli;
			}

		if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}
	}//Super A, CAT A, CSA A 
	else if($category=="CAT B")
	{
		if($exactnet_salary < 35000)
			{
			$interestrate = "18%";
			$intr=18/1200;
			}
		else if($exactnet_salary>= 35000 && $exactnet_salary< 50000)
			{
			$interestrate = "17%";
			$intr=17/1200;
			}
		else if($exactnet_salary>= 50000 && $exactnet_salary< 75000)
			{
			$interestrate = "16%";
			$intr=16/1200;
			}
		else
			{
			$interestrate = "15.5%";
			$intr=15.5/1200;
			}
		if($exactnet_salary>=25000)
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 12;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 12;
						}
							$getterm=3;
					}
				else if($term==48)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 14;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 14;
						}
					$getterm=4;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 14;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 14;
						}
					$getterm=4;
					}
			}
		else
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 7;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 7;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 10;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 10;
						}
					$getterm=3;
					}
				else if($term==48)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 12;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 12;
						}
					$getterm=4;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 12;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 12;
						}
					$getterm=4;
					}
			}
			if($Loan_Amount_Eli>1500000)
					{
					$getloanamout=1500000;
					}
				else
					{
					$getloanamout=$Loan_Amount_Eli;
					}

			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}
	} //CAT B
	else if($category=="CSA B")
	{
		if($exactnet_salary < 35000)
			{
			$interestrate = "18%";
			$intr=18/1200;
			}
		else if($exactnet_salary>= 35000 && $exactnet_salary< 50000)
			{
			$interestrate = "17%";
			$intr=17/1200;
			}
		else if($exactnet_salary>= 50000 && $exactnet_salary< 75000)
			{
			$interestrate = "16%";
			$intr=16/1200;
			}
		else
			{
			$interestrate = "15.5%";
			$intr=15.5/1200;
			}
		if($exactnet_salary>=20000)
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 12;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 12;
						}
					$getterm=3;
					}
				else if($term==48)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 14;
						}
						else
						{
						 $Loan_Amount_Eli=$exactnet_salary * 14;
						}
					$getterm=4;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 14;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 14;
						}
					$getterm=4;
					}
			}
		else
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 7;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 7;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 10;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 10;
						}
					$getterm=3;
					}
				else if($term==48)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 12;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 12;
						}
					$getterm=4;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 12;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 12;
						}
					$getterm=4;
					}
			}
			if($Loan_Amount_Eli>1500000)
					{
					$getloanamout=1500000;
					}
				else
					{
					$getloanamout=$Loan_Amount_Eli;
					}

			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}
	}//CSA B
	else if($category=="CSA C")
	{
		if($exactnet_salary < 35000)
			{
			$interestrate = "18%";
			$intr=18/1200;
			}
		else if($exactnet_salary>= 35000 && $exactnet_salary< 50000)
			{
			$interestrate = "17%";
			$intr=17/1200;
			}
		else if($exactnet_salary>= 50000 && $exactnet_salary< 75000)
			{
			$interestrate = "16%";
			$intr=16/1200;
			}
		else
			{
			$interestrate = "15.5%";
			$intr=15.5/1200;
			}
		if($exactnet_salary>=20000)
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 11;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 11;
						}
					$getterm=3;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 11;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 11;
						}
					$getterm=3;
					}
			}
		else
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 7;
						}
						else
						{
						$Loan_Amount_Eli=$exactnet_salary * 7;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
			}

			if($Loan_Amount_Eli>500000)
					{
					$getloanamout=500000;
					}
				else
					{
					$getloanamout=$Loan_Amount_Eli;
					}

			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}
	}//CSA C
	else if($category=="CAT C" || $category=="Cat C")
	{
			if($exactnet_salary < 35000)
			{
			$interestrate = "18%";
			$intr=18/1200;
			}
		else if($exactnet_salary>= 35000 && $exactnet_salary< 50000)
			{
			$interestrate = "17%";
			$intr=17/1200;
			}
		else if($exactnet_salary>= 50000 && $exactnet_salary< 75000)
			{
			$interestrate = "16%";
			$intr=16/1200;
			}
		else
			{
			$interestrate = "15.5%";
			$intr=15.5/1200;
			}
		if($exactnet_salary>=20000)
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 11;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 11;
						}
					$getterm=3;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 11;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 11;
						}
					$getterm=3;
					}
			}
		else
			{
				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 7;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 7;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
			}


			if($Loan_Amount_Eli>500000)
					{
					$getloanamout=500000;
					}
				else
					{
					$getloanamout=$Loan_Amount_Eli;
					}

			
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}

		}//CAT C
	else if($category=="CSA D" || $category=="CAT D")
	{
			$interestrate = "22%";
			$intr=22/1200;

				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 7;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 7;
						}
					$getterm=2;
					}
				else if($term==36)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
				else
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
			if($Loan_Amount_Eli>150000)
				{
				$getloanamout=150000;
				}
			else
				{
				$getloanamout=$Loan_Amount_Eli;
				}
				
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}

		} //CAT D or CSA D
		else
		{
			
			$interestrate = "22%";
			$intr=22/1200;

				if($term==12)
					{
						if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 5;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 5;
						}
					$getterm=1;
					}
				else if($term==24)
					{
					if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 7;
						}
						else
						{
						$Loan_Amount_Eli=$exactnet_salary * 7;
						}
					$getterm=2;
					}
				else if($term==36)
					{
					if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
				else
					{
					if($net_salary>0)
						{
							$Loan_Amount_Eli=$net_salary * 9;
						}
						else
						{
							$Loan_Amount_Eli=$exactnet_salary * 9;
						}
					$getterm=3;
					}
			if($Loan_Amount_Eli>150000)
				{
				$getloanamout=150000;
				}
			else
				{
				$getloanamout=$Loan_Amount_Eli;
				}
				
			if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}

	}//Non Listed Company

//echo "Loan AMt: ".$getloanamout."<br>";
//echo "HTO".$hdfc_total_outstanding."<br>";
if($getloanamout>$hdfc_total_outstanding && ($hdfc_total_outstanding>0))
	{
	
	$getloanamout = $getloanamout - $hdfc_total_outstanding;
	}
	else if($getloanamout<$hdfc_total_outstanding && ($hdfc_total_outstanding>0))
	{
		$getloanamout=0;
	}
	else
	{
			$getloanamout=$getloanamout;
	}

		$get_emi=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
//echo "loan: ".$getloanamout."<br>";
//echo $intr."<br>";
//echo $term."<br>";
	
	$details[]= $interestrate;
	$details[]= $get_emi;
	$details[]= $getterm;
	$details[]= $getloanamout;
	return($details);
}

function Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding)
{
$exactnet_salary= $exactnet_salary-$clubbed_emi;
//echo "major city calc";
	//echo "<br>";

	if($category=="Super A" || $category=="CSA A" || $category=="CAT A" || $category=="CSA B" || $category=="CAT B" || $category=="CAT C" || $category=="CSA C")
	{
		$interestrate = "15.5%";
			$intr=15.5/1200;
	}
	else if($category=="CAT D")
	{
		$interestrate = "22%";
			$intr=22/1200;
	}

	if($term==12)
			{
				$Loan_Amount_Eli=$exactnet_salary * 5;
				$getterm=1;
			}
			else if($term==24)
			{
				$Loan_Amount_Eli=$exactnet_salary * 9;
				$getterm=2;
			}
			else if($term==36)
			{
				$Loan_Amount_Eli=$exactnet_salary * 13;
				$getterm=3;
			}
			else if($term==48)
			{
				$Loan_Amount_Eli=$exactnet_salary * 15;
				$getterm=4;
			}
			else if($term==60)
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}
			else
			{
				$Loan_Amount_Eli=$exactnet_salary * 18;
				$getterm=5;
			}

$getloanamout=$Loan_Amount_Eli;

if($getloanamout>$hdfc_total_outstanding && ($hdfc_total_outstanding>0))
	{
	 $getloanamout = $getloanamout - $hdfc_total_outstanding;
	}
	else if($getloanamout<$hdfc_total_outstanding && ($hdfc_total_outstanding>0))
	{
		$getloanamout=0;
	}
	else
	{
			$getloanamout=$getloanamout;
	}


//echo "loan: ".$getloanamout."<br>";
//echo $intr."<br>";
//echo $term."<br>";
//echo $getterm."<br>";

	$get_emi=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
echo $get_emi."<br>";
$details[]= $interestrate;
	$details[]= $get_emi;
	$details[]= $getterm;
	$details[]= $getloanamout;
	return($details);
}

?>