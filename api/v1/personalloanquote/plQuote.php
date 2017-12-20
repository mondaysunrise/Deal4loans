<?php
require '../../../scripts/db_init.php';
require '../../../scripts/functions.php';
require '../../../getlistofeligiblebidders.php';
require '../../../scripts/personal_loan_eligibility_function_form.php';

	if($_SERVER['PHP_AUTH_USER']=="deal4loans_service_check" && $_SERVER['PHP_AUTH_PW']=="d4l^^Yq" )
    {
		$plinputData = $_POST['inputdata'];
		//$validationBanks = new validationBanks();
		$plinputDataresponse = PLQuoteCalc($plinputData);
	
		if(count($plinputDataresponse)>0 && count($plinputDataresponse[0])>0)
		{
			$return=json_encode($plinputDataresponse);	
		}else
		{
			$return = json_encode(array("error"=>"No Quote"));	
		}
	}
	else
	{
		$return = json_encode(array("error"=>"notauthorised"));		
	}
	echo $return;

//insert in table
// check for quotes

function PLQuoteCalc($plinputData)
{	
	$userdata=json_decode($plinputData);

	$wfid = $userdata->id;
	$first_name = $userdata->first_name;
	$middle_name = $userdata->middle_name;
	$last_name = $userdata->last_name;
	$Name=$first_name." ".$middle_name." ".$last_name;
	$gender = $userdata->gender;
	$Net_Salary = $userdata->annual_income;
	$monthsalary= $Net_Salary/12;
	$getCompany_Name = $userdata->company_name;
	$DOB = $userdata->date_of_birth;
	$getDOB = str_replace("-","", $DOB);
	$age = DetermineAgeGETDOB($getDOB);
	$Company_Type = $userdata->company_type;
	$Primary_Acc = $userdata->primary_bankaccount;
	$PL_EMI_Amt = $userdata->total_monthly_obligation;
	$City = $userdata->city_name;
	$Other_City= $userdata->other_city_name;
	$Employment_Status = $userdata->occupation;
	$pagename = $userdata->pagename;
	$email_id = $userdata->email_id;
	$sep_details = $userdata->sep_details;
	$annual_turnover = $userdata->annual_turnover;
	$current_experience = $userdata->current_experience;
	$total_experience = $current_experience+1;
	$residence_status = $userdata->residence_status;
	$residence_pincode = $userdata->residence_pincode;
	$card_holder = $userdata->card_holder;
	$card_vintage = $userdata->card_vintage;
	$is_loan_any = $userdata->is_loan_any;
	$emi_paid = $userdata->emi_paid;
	$loan_amount = $userdata->loan_amount;
	
	/*$wfplqry="INSERT INTO `wishfin_quote_loan` (`wfid`, `Name`, `Email`, `Employment_Status`, `Company_Name`, `City`, `City_Other`, `Mobile_Number`, `Years_In_Company`, `Total_Experience`, `Net_Salary`, `Residential_Status`, `Loan_Any`, `EMI_Paid`, `CC_Holder`, `Card_Vintage`, `Card_Limit`, `Loan_Amount`, `Pincode`,  `CC_Age`, `Primary_Acc`, `Gender`, `source`, `DOB`, `Residence_Address`, `Add_Comment`, `Company_Type`, `Existing_Bank`, `Existing_Loan`, `Existing_ROI`, `Pancard`) VALUES ('".$wfid."', '".$Name."', '".$email_id."', '".$Employment_Status."', '".$getCompany_Name."', '".$City."', '".$Other_City."', '', '".$current_experience."', '".$total_experience."', '".$Net_Salary."', '".$residence_status."', '".$is_loan_any."', '".$emi_paid."', '".$card_holder."', '".$card_vintage."', '', '".$loan_amount."','', '".$sep_details."', '".$Primary_Acc."', '".$gender."', '".$pagename."', '".$DOB."', NULL, '', '".$Company_Type."', '', '', '', '')";
*/

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
	$pldata = array("wishfin_id"=> $wfid, "Name"=> $Name,  "Email"=> $email_id,  "Employment_Status"=> $Employment_Status,  "Company_Name"=> $getCompany_Name, "City"=> $City, "City_Other"=> $Other_City, "Mobile_Number"=>'0', "Years_In_Company"=> $current_experience, "Total_Experience"=> $total_experience, "Net_Salary"=> $Net_Salary, "Residential_Status"=> $residence_status, "Loan_Any"=> $is_loan_any, "EMI_Paid"=> $emi_paid, "CC_Holder"=> $card_holder, "Card_Vintage"=> $card_vintage, "Card_Limit"=>'0', "Loan_Amount"=> $loan_amount, "Pincode"=>'0',  "CC_Age"=> $sep_details, "Primary_Acc"=> $Primary_Acc, "Gender"=> $gender, "source"=> $pagename, "DOB"=> $DOB, "Company_Type"=> $Company_Type);
	//print_r($pldata);
	$ProductValue = Maininsertfunc("wishfin_quote_loan", $pldata);
	$getcompany='select * from pl_company_list where company_name="'.$getCompany_Name.'"';
	list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
	$growcontr=count($grow)-1;

	$hdfccategory= $grow[$growcontr]["hdfc_bank"];
	$fullertoncategory= $grow[$growcontr]["fullerton"];
	$citicategory= $grow[$growcontr]["citibank"];
	$stanccategory = $grow[$growcontr]["standard_chartered"];
	$hdbfscategory = $grow[$growcontr]["hdbfs"]; 
	$ingvyasyacategory = $grow[$growcontr]["ingvyasya"]; 
	$bajajfinservcategory = $grow[$growcontr]["bajajfinserv"]; 
	$icici_bankcategory = $grow[$growcontr]["icici_bank"]; 
	$Indusind = $grow[$growcontr]["Indusind"]; 
	$kotakcomp = $grow[$growcontr]["kotak"];
	$tatacapitalcomp = $grow[$growcontr]["tatacapital"];
	$capitalfirstcomp = $grow[$growcontr]["capitalfirst"];
	$rblbankcomp = $grow[$growcontr]["rblbank"];
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

		//echo $ProductValue."-".$strCity;

	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("wishfin_quote_loan",$ProductValue,$strCity);
		$Final_Bid = "";
				while (list ($key,$val) = @each($bankID)) { 
					$Final_Bid[]= $val; 
				} 
				
		$FinalBidder=implode(',',$FinalBidder);
		$realbankiD=implode(',',$realbankiD);

	if(count($FinalBidder)>0)
		 {
	for($i=0;$i<count($Final_Bid);$i++)
		{
		//echo $Final_Bid[$i];
		
			if(((strncmp ("Citibank", $Final_Bid[$i],8))==0 || ($Final_Bid[$i]=="CitiBank")) && ($citicategory=='' && $Primary_Acc!="Citibank"))
			{
			}
			else if(((strncmp ("INDUS", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="INDUS IND bank")) && (($Indusind=='') && $Net_Salary<480000))
			{
			}
			else if(((strncmp ("Bajaj", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="Bajaj Finserv")) && (($bajajfinservcategory=='') && $Net_Salary<480000))
			{
			}
			else if(((strncmp ("Kotak", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="Kotak Bank")) && (($kotakcomp=='') && $Net_Salary<480000))
			{
			}
			else
				{ $shownToBidders_Arr[] = $Final_Bid[$i];
			}
		}
		$Dated = ExactServerdate();	
		
	for($r=0;$r<count($shownToBidders_Arr);$r++)
			 {
			//HDFC Bank
		if(($shownToBidders_Arr[$r]=="HDFC Bank") || ($shownToBidders_Arr[$r]=="HDFC") && $Employment_Status==1)
		{
			list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi,$hdfcprocfee)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);
				if($hdfcgetloanamout>50000 && strlen($hdfcgetemicalc)>2)
				{
				 $hdfcbankarr=  array('bank_code'=>"240", 'interest_rate'=>$hdfcinterestrate, 'emi'=>$hdfcgetemicalc, 'tenure'=> $hdfcterm, 'loan_amount'=> $hdfcgetloanamout, 'processing_fee'=>$hdfcprocfee, 'bank_name'=>$shownToBidders_Arr[$r]);
				 $plquotearr[] = $hdfcbankarr;
				}
				else
				{
					$hdfcbankarr=array('bank_code'=>"240","message"=>"Check this bank offer via phone.",'bank_name'=>$shownToBidders_Arr[$r]);
					$plquotearr[] = $hdfcbankarr;
				}
			}
		//ICICI Bank
		elseif(((trim($shownToBidders_Arr[$r])=="ICICI") || (trim($shownToBidders_Arr[$r])=="ICICI Bank")) && $Employment_Status==1)
		{	
			list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi,$iciciprocfee)=icicibank($monthsalary,$getCompany_Name,$icici_bankcategory,$age,$Company_Type,$Primary_Acc);

			if($icicigetloanamout>50000 && strlen($icicigetemicalc)>2)
				{
				 $icicibankarr=  array('bank_code'=>"229", 'interest_rate'=>$iciciinterestrate, 'emi'=>$icicigetemicalc, 'tenure'=> $iciciterm, 'loan_amount'=> $icicigetloanamout, 'processing_fee'=>$iciciprocfee, 'bank_name'=>$shownToBidders_Arr[$r]);
				 $plquotearr[] = $icicibankarr;
				}
				else
				{
					$icicibankarr=array('bank_code'=>"229","message"=>"Check this bank offer via phone.",'bank_name'=>$shownToBidders_Arr[$r]);
					$plquotearr[] = $icicibankarr;
				}
		}
	//Standard Chartered
		elseif((($shownToBidders_Arr[$r]=="Stanc") || ($shownToBidders_Arr[$r]=="Standard Chartered")) && $Employment_Status==1)
		{
			list($stancinterestrate,$stancgetloanamout,$stancgetemicalc,$stancterm,$stancperfee,$stancprocfee)=Stanc($monthsalary,$PL_EMI_Amt,$getCompany_Name,$stanccategory,$age,$Company_Type,$Primary_Acc);
			if($stancgetloanamout>50000 && strlen($stancgetemicalc)>2)
				{
				 $scbarr=  array('bank_code'=>"036", 'interest_rate'=>$stancinterestrate, 'emi'=>$stancgetemicalc, 'tenure'=> $stancterm, 'loan_amount'=> $stancgetloanamout, 'processing_fee'=>$stancprocfee, 'bank_name'=>$shownToBidders_Arr[$r]);
				 $plquotearr[] = $scbarr;
				}
				else
				{
					$scbarr=array('bank_code'=>"036","message"=>"Check this bank offer via phone.",'bank_name'=>$shownToBidders_Arr[$r]);
					$plquotearr[] = $scbarr;
				}
		}
		//CItibank
		elseif((($shownToBidders_Arr[$r]=="Citibank") || ($shownToBidders_Arr[$r]=="CitiBank")) && $Employment_Status==1)
		{
		list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlac,$citiproc_Fee)=citibank($monthsalary,$clubbed_emi,$getCompany_Name,$age,$citicategory);
			if($citigetloanamout>50000 && strlen($citigetemicalc)>2)
				{
				 $citibankarr=  array('bank_code'=>"037", 'interest_rate'=>$citiinterestrate, 'emi'=>$citigetemicalc, 'tenure'=> $cititerm, 'loan_amount'=> $citigetloanamout, 'processing_fee'=>$citiproc_Fee, 'bank_name'=>$shownToBidders_Arr[$r]);
				 $plquotearr[] = $citibankarr;
				}
				else
				{
					$citibankarr=array('bank_code'=>"037","message"=>"Check this bank offer via phone.",'bank_name'=>$shownToBidders_Arr[$r]);
					$plquotearr[] = $citibankarr;
				}
		}
		//INdusInd Bank
		elseif((($shownToBidders_Arr[$r]=="INDUS IND bank") || ($shownToBidders_Arr[$r]=="INDUS IND bank")) && $Employment_Status==1)
		{
			list($indusindrate,$indusindloanamt,$indusindemi,$indusindterm,$indusindperlacemi,$indusproc_Fee)=@indusindbank($monthsalary,$getCompany_Name,$Indusind,$age,$clubbed_emi,$strCity);
			if($indusindloanamt>50000 && strlen($indusindemi)>2)
				{
				 $indusindbankarr=  array('bank_code'=>"234", 'interest_rate'=>$indusindrate, 'emi'=>$indusindemi, 'tenure'=> $indusindterm, 'loan_amount'=> $indusindloanamt, 'processing_fee'=>$indusproc_Fee, 'bank_name'=>$shownToBidders_Arr[$r]);
				 $plquotearr[] = $indusindbankarr;
				}
				else
				{
					$indusindbankarr=array('bank_code'=>"234","message"=>"Check this bank offer via phone.",'bank_name'=>$shownToBidders_Arr[$r]);
					$plquotearr[] = $indusindbankarr;
				}
		}
		//Fullerton
		elseif(((strncmp ("Fullerton", $shownToBidders_Arr[$r],9))==0 || ($shownToBidders_Arr[$r]=="Fullerton")) && $Employment_Status==1)
		{
			list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
			if($fullertongetloanamout>0  && strlen($fullertongetemicalc)>2)
				{
				$fullertonprofee="2 - 2.5";
				$fullertonarr=  array('bank_code'=>"m017", 'interest_rate'=>$fullertoninterestrate, 'emi'=>$fullertongetemicalc, 'tenure'=> $fullertonterm, 'loan_amount'=> $fullertongetloanamout, 'processing_fee'=>$fullertonprofee, 'bank_name'=>$shownToBidders_Arr[$r]);
				 $plquotearr[] = $fullertonarr;
			}
			else
			{
				$fullertonarr=array('bank_code'=>"234","message"=>"Check this bank offer via phone.",'bank_name'=>$shownToBidders_Arr[$r]);
				$plquotearr[] = $fullertonarr;
			}
		}
		//Kotak Bank
		elseif($shownToBidders_Arr[$r]=="Kotak" || $shownToBidders_Arr[$r]=="Kotak Bank" && $Employment_Status==1)
		{
			list($kotakrate,$kotakloanamt,$kotakemi,$kotakterm,$kotakperlacemi,$kotakproc_fee)=kotakbank($monthsalary,$getCompany_Name,$kotakcomp,$age,$Company_Type,$Primary_Acc);
			if($kotakloanamt>50000 && strlen($kotakemi)>2)
				{
				 $kotakbankarr=  array('bank_code'=>"m011", 'interest_rate'=>$kotakrate, 'emi'=>$kotakemi, 'tenure'=> $kotakterm, 'loan_amount'=> $kotakloanamt, 'processing_fee'=>$kotakproc_fee, 'bank_name'=>$shownToBidders_Arr[$r]);
				 $plquotearr[] = $kotakbankarr;
				}
				else
				{
					$kotakbankarr=array('bank_code'=>"m011","message"=>"Check this bank offer via phone.",'bank_name'=>$shownToBidders_Arr[$r]);
					$plquotearr[] = $kotakbankarr;
				}
		}
		//TATA Capital
		elseif($shownToBidders_Arr[$r]=="Tata Capital" && $Employment_Status==1)
		{
			list($tcinterestrate,$tcgetloanamout,$tcgetemicalc,$tcterm,$tcProcessing_Fee)= tatacapital($monthsalary,$getCompany_Name,$tatacapitalcomp,$age,$Company_Type,$Primary_Acc);
			if($tcgetloanamout>50000 && strlen($tcgetemicalc)>2)
				{
				 $tatacapitalarr=  array('bank_code'=>"m016", 'interest_rate'=>$tcinterestrate, 'emi'=>$tcgetemicalc, 'tenure'=> $tcterm, 'loan_amount'=> $tcgetloanamout, 'processing_fee'=>$tcProcessing_Fee, 'bank_name'=>$shownToBidders_Arr[$r]);
				 $plquotearr[] = $tatacapitalarr;
				}
				else
				{
					$tatacapitalarr=array('bank_code'=>"m016","message"=>"Check this bank offer via phone.",'bank_name'=>$shownToBidders_Arr[$r]);
					$plquotearr[] = $tatacapitalarr;
				}
		}
		//CapitalFirst
		elseif($shownToBidders_Arr[$r]=="Capital First" && $Employment_Status==1)
		{
			list($cfinterestrate,$cfgetloanamout,$cfgetemicalc,$cfterm,$cfProcessing_Fee)= capitalFirst($monthsalary,$getCompany_Name,$capitalfirstcomp,$age,$Company_Type,$Employment_Status);
			if($cfgetloanamout>50000 && strlen($cfgetemicalc)>2)
				{
				 $capfirstarr=  array('bank_code'=>"m020", 'interest_rate'=>$cfinterestrate, 'emi'=>$cfgetemicalc, 'tenure'=> $cfterm, 'loan_amount'=> $cfgetloanamout, 'processing_fee'=>$cfProcessing_Fee, 'bank_name'=>$shownToBidders_Arr[$r]);
				 $plquotearr[] = $capfirstarr;
				}
				else
				{
					$capfirstarr=array('bank_code'=>"m020","message"=>"Check this bank offer via phone.",'bank_name'=>$shownToBidders_Arr[$r]);
					$plquotearr[] = $capfirstarr;
				}
		}
		
		elseif($shownToBidders_Arr[$r]=="Bajaj Finserv")
					 {
							$bflloansmtcalc= round($monthsalary*10); 
							if($bflloansmtcalc>3000000)
							 {
								$bflloansmt="3000000";
							 }
							 else
							 {
								 $bflloansmt=$bflloansmtcalc;
							 }
							$bfltenuremth=60;					 				 
							 $bflintr1=11.99/1200;
							 $bflintr2=16/1200;
							 $bflintrte="11.99% - 16%";
							 $getemi1=round($bflloansmt * $bflintr1 / (1 - (pow(1/(1 + $bflintr1), $bfltenuremth)))); 
							 $getemi2=round($bflloansmt * $bflintr2 / (1 - (pow(1/(1 + $bflintr2), $bfltenuremth)))); 
							 $getemi = $getemi1." - ".$getemi2;
							 $bflterm="5 yrs";
							 $bflProc_Fee="Upto 2%";
			if($bflloansmt>50000 && strlen($getemi)>2)
				{
				 $bflarr=  array('bank_code'=>"m015", 'interest_rate'=>$bflintrte, 'emi'=>$getemi, 'tenure'=> $bflterm, 'loan_amount'=> $bflloansmt, 'processing_fee'=>$bflProc_Fee, 'bank_name'=>$shownToBidders_Arr[$r]);
				 $plquotearr[] = $bflarr;
				}
				else
				{
					$bflarr=array('bank_code'=>"m015","message"=>"Check this bank offer via phone.",'bank_name'=>$shownToBidders_Arr[$r]);
					$plquotearr[] = $bflarr;
				}
		}
		elseif($shownToBidders_Arr[$r]=="InCred")
				{
				list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= incred ($monthsalary,$PL_EMI_Amt, $getCompany_Name, $category,$age,$Company_Type);
				if($getloanamout>50000 && strlen($getemicalc)>2)
					{
					 $incredarr=  array('bank_code'=>"m031", 'interest_rate'=>$interestrate, 'emi'=>$getemicalc, 'tenure'=> $term, 'loan_amount'=> $getloanamout, 'processing_fee'=>$Processing_Fee, 'bank_name'=>$shownToBidders_Arr[$r]);
					 $plquotearr[] = $incredarr;
					}
					else
					{
						$incredarr=array('bank_code'=>"m031","message"=>"Check this bank offer via phone.",'bank_name'=>$shownToBidders_Arr[$r]);
						$plquotearr[] = $incredarr;
					}
		}
		else
		 {
			 $getbankcode='select bank_code from xkyknzl5dwfyk4hg_master_bank where bank_name_prosa like "'.$shownToBidders_Arr[$r].'%"';
			list($recordcount,$bkrow)=MainselectfuncNew($getbankcode,$array = array());
			$growbkcontr=count($bkrow)-1;

			$bankcode= $bkrow[$growbkcontr]["bank_code"];
			$otherbankarr=array('bank_code'=>$bankcode,"message"=>"Check this bank offer via phone.",'bank_name'=>$shownToBidders_Arr[$r]);
			$plquotearr[] = $otherbankarr;
		 }			
		}
		 }

	$plQuoteArrString=$plquotearr;
	$responsejson=json_encode($plQuoteArrString);
	$dataUpdate = array("quote_response"=>$responsejson);
		$wherecondition = "(RequestID='".$ProductValue."')";
		Mainupdatefunc ('wishfin_quote_loan', $dataUpdate, $wherecondition);
		
	if(count($plquotearr)>0)
	{
		return $plQuoteArrString;
	}
	else
	{
		return (array("error"=>"No Quote"));
	}
		 

}
 function DetermineAgeGETDOB ($YYYYMMDD_In) {
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
    