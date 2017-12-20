<?php
require_once 'scripts/db_init.php';
    /**
     * PLQuoteCalc is used to return eligible bank based on specific conditions
     * salary,company name,age,company category,company type,primary acc,obligation,city,employment status
     * @param array $inputData
     * @return array
     * @date 17/11/2016
     */
/*$plquotearray=PLQuoteCalc("0","0");
echo "<br>";
for($r=0;$r<count($plquotearray);$r++)
{
	print_r($plquotearray[$r])."<br><br>";
	echo "<br><br>";
}*/
    function PLQuoteCalc($inputData,$EligibileBidderArr) {
	    $annualIncome = $inputData["annual_income"];
        $monthlyIncome =  $annualIncome/12;
        $companyName = $inputData["company_name"];
        $dob = $inputData["date_of_birth"];
        $getDOB = str_replace("-","", $dob);
        $age = DetermineAgeGET_DOB_Prod($getDOB);
        $companyType = $inputData["company_type"];
        $primaryAcc = $inputData["primary_bankaccount"];
        $totalObligation = $inputData["total_monthly_obligation"];
        $city = $inputData["city_name"];
        $otherCity = $inputData["other_city_name"];
		$occupation = $inputData["occupation"];       
		if($city=="Others" && strlen($otherCity)>2) {
            $finalCity=$otherCity;
        } else {
            $finalCity=$city;
        }
        $reqloanamount=$inputData["loan_amount"]; 
        $reqtenure =$inputData["reqtenure"];
		
	//	print_r($inputData);
		
        /*
		$annualIncome = "900000";
        $monthlyIncome =  $annualIncome/12;
        $companyName = "ABBOTT PHARMACEUTICALS LTD";
        $dob = "1983-05-02";
        $getDOB = str_replace("-","", $dob);
        $age = DetermineAgeGET_DOB_Prod($getDOB);
        $companyType = "3";
        $primaryAcc = "HDFC Bank";
        $totalObligation = 0;
        $city = "Delhi";
        $otherCity = "";
        if($city=="Others" && strlen($otherCity)>2) {
            $finalCity=$otherCity;
        } else {
            $finalCity=$city;
        }
        $occupation = 1;
        $reqtenure =1;*/
	//	 $reqloanamount=500000;
        /* salary,company name,age,company category,company type,primary acc,
           obligation,city,employment status
           call all banks functions here
           Bank code,Interest Rate,EMI (per month),Tenure,Eligible Loan Amount,
           Processing Fee, Bank Name
         */
		//'71', '39', '8', '13', '51', '27', '17', '4', '1', '50'
		/*1,4,8,13,17,27,39,50,51,71
		Citibank,HDFC,StanC,Kotak,Fullerton,ICICI,Tata Capital,Bajaj Finserv,INDUS IND bank,Capital First*/

        $capitalFirstPL= CapitalFirstPL($monthlyIncome, $companyName, PlCompanyCategory($companyName, "capitalfirst"), $age, $companyType, $occupation, $reqtenure, $reqloanamount);
        if($capitalFirstPL['loan_amount']>50000 && strlen($capitalFirstPL['emi'])>2) {
      //      $capitalFirstPL['bank_name'] = $resultbankListArr[$capitalFirstPL['bank_code']];
            $plquotearr[] = $capitalFirstPL;
        }
       $tataCapitalPL=TataCapitalPL($monthlyIncome, $companyName, PlCompanyCategory($companyName, "tatacapital"), $age, $companyType, $primaryAcc, $reqtenure, $reqloanamount);
        if ($tataCapitalPL['loan_amount']>50000 && strlen($tataCapitalPL['emi'])>2) {
           // $tataCapitalPL['bank_name'] = $resultbankListArr[$tataCapitalPL['bank_code']];
            $plquotearr[] = $tataCapitalPL;
        }
         $stanCPL = StanCPL($monthlyIncome, $totalObligation, $companyName, PlCompanyCategory($companyName, "standard_chartered"), $age, $companyType, $primaryAcc, $reqtenure, $reqloanamount);
        if($stanCPL['loan_amount']>50000 && strlen($stanCPL['emi'])>2) {
          //  $stanCPL['bank_name'] = $resultbankListArr[$stanCPL['bank_code']];
            $plquotearr[] = $stanCPL;
        }
        $kotakBankPL = KotakBankPL($monthlyIncome, $companyName, PlCompanyCategory($companyName, "kotak"), $age, $companyType, $primaryAcc, $reqtenure, $reqloanamount);
        if ($kotakBankPL['loan_amount']>50000 && strlen($kotakBankPL['emi'])>2) {
           // $kotakBankPL['bank_name'] = $resultbankListArr[$kotakBankPL['bank_code']];
            $plquotearr[] = $kotakBankPL;
        }
        $indusIndPL = IndusIndPL($monthlyIncome, $companyName, PlCompanyCategory($companyName, "Indusind"), $age, $totalObligation, $finalCity, $reqtenure, $reqloanamount);
		  if ($indusIndPL['loan_amount']>50000 && strlen($indusIndPL['emi'])>2) {
            //$indusIndPL['bank_name'] = $resultbankListArr[$indusIndPL['bank_code']];
            $plquotearr[] = $indusIndPL;
        }
        $iciciBankPL = IciciBankPL($monthlyIncome, $companyName, PlCompanyCategory($companyName, "icici_bank"), $age, $companyType, $primaryAcc, $reqtenure, $reqloanamount);
		if ($iciciBankPL['loan_amount']>50000 && strlen($iciciBankPL['emi'])>2) {
            //$iciciBankPL['bank_name'] = $resultbankListArr[$iciciBankPL['bank_code']];
            $plquotearr[] = $iciciBankPL;
        }
        $fullertonPL = FullertonPL($monthlyIncome, $totalObligation, $companyName, PlCompanyCategory($companyName, "fullerton"), $age, $finalCity, $reqtenure, $reqloanamount);
        if ($fullertonPL['loan_amount']>50000 && strlen($fullertonPL['emi'])>2) {
            //$fullertonPL['bank_name'] = $resultbankListArr[$fullertonPL['bank_code']];
            $plquotearr[] = $fullertonPL;
        }
        $hdfcBankPL = HdfcBankPL($monthlyIncome, $totalObligation, $companyName, PlCompanyCategory($companyName, "hdfc_bank"), $age, $companyType, $primaryAcc, $reqtenure, $reqloanamount);
        if ($hdfcBankPL['loan_amount']>50000 && strlen($hdfcBankPL['emi'])>2) {
           // $hdfcBankPL['bank_name'] = $resultbankListArr[$hdfcBankPL['bank_code']];
            $plquotearr[] = $hdfcBankPL;
        }
		
		$citibankPL = CitibankPL($monthlyIncome, $totalObligation, $companyName, $age, PlCompanyCategory($companyName, "citibank"), $reqtenure, $reqloanamount);
			if ($citibankPL['loan_amount']>50000 && strlen($citibankPL['emi'])>2) {
			//	$citibankPL['bank_name'] = $resultbankListArr[$citibankPL['bank_code']];
				$plquotearr[] = $citibankPL;
			} 
	
        $BajajFinservPL = BajajFinservPL($monthlyIncome, $companyName, PlCompanyCategory($companyName, "bajajfinserv"), $age, $totalObligation, $reqtenure, $reqloanamount);
        if ($BajajFinservPL['loan_amount'] > 50000 && strlen($BajajFinservPL['emi']) > 2) {
           $plquotearr[] = $BajajFinservPL;
        }
		
		 $RblBankPL = RBLBankPL($monthlyIncome, $totalObligation, $companyName, PlCompanyCategory($companyName, "rblbank"), $age, $companyType, $primaryAcc, $reqtenure, $reqloanamount);
        if ($RblBankPL['loan_amount'] > 50000 && strlen($RblBankPL['emi']) > 2) {
           $plquotearr[] = $RblBankPL;
        }

		$IIFLbankPL = IIFLbankPL($monthlyIncome, $totalObligation, $companyName, PlCompanyCategory($companyName, "iifl"), $age, $companyType, $reqtenure, $reqloanamount);
        if ($IIFLbankPL['loan_amount'] > 50000 && strlen($IIFLbankPL['emi']) > 2) {
           $plquotearr[] = $IIFLbankPL;
        }

          return ($plquotearr);
    }
    
    /**
     * Get personal loan company category
     * @param string $CompanyName
     * @param string $BankName
     * @return type

     * @date 17/11/2016
     */
    function PlCompanyCategory($companyName,$bankName) {
			$getdetails='select '.$bankName.' From pl_company_list Where ( company_name="'.$companyName.'")';
		list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
		if($alreadyExist>0)
		{
			$CompanyCat=$myrow[$bankName];
		}
		else
		{
			$CompanyCat="";
		}
    
        return($CompanyCat);
    }

    /**
     * Get age using date of birth
     * @param string $YYYYMMDD_In
     * @return int

     * @date 17/11/2016
     */
    function DetermineAgeGET_DOB_Prod ($YYYYMMDD_In) {
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
    
    /**
     * Calculate_Tenure is used to return tenure in month 
     * @param int $age
     * @param int $maxtenure
     * @param int $maxage
     * @return int

     * @date 17/11/2016
     */
    function Calculate_Tenure($age, $maxtenure, $maxage) {
        $maxterm = $maxage - $age;
        if ($maxterm > $maxtenure) {
            $print_term = $maxtenure;
            $term = $print_term * 12;
        } else {
            if ($maxterm > 0) {
                $print_term = $maxterm;
                $term = $print_term * 12;
            } else {
                $print_term = 0;
                $term = 0;
            }
        }

        $finalarrReturnValue[] = $term;
        $finalarrReturnValue[] = $print_term;

        return $finalarrReturnValue;
    }

    /**
     * Get Bank code,Interest Rate, EMI (per month),Tenure,Eligible Loan Amount,
     * Processing Feefor Capital First Personal Loan
     * @param int $net_salary
     * @param string $company
     * @param string $category
     * @param datetime $DOB
     * @param int $Company_Type
     * @param int $Employment_Status
     * @return array

     * @date 17/11/2016
     */
    function CapitalFirstPL($net_salary, $company, $category, $DOB, $Company_Type, $Employment_Status, $reqtenure, $reqloanamount) {
		 list($calterm, $calprint_term) = Calculate_Tenure($DOB, "5", "62");
		//for reqd tenure////////////////////////////////////////////////////////////////////////
		if($reqtenure>0)
		{
			if($reqtenure>$calprint_term)
			{
			$term = $calterm;
			$print_term = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$print_term = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$print_term = $calprint_term;
		}
		//for reqd tenure end////////////////////////////////////////////////////////////////////////
        if ($Employment_Status == 1) {
            /* if ($term > 60) {
              $calcterm = 60;
              $print_term = 5;
              } else {
              $calcterm = $term;
              $print_term = $print_term;
              } */
            //for term
            if ($category == "CAT SA" || $category == "CAT A") {
                if ($term > 60) {
                    $calcterm = 60;
                    $getterm = 5;
                } else {
                    $calcterm = $term;
                    $getterm = $print_term;
                }
            } else {
                if ($term > 48) {
                    $calcterm = 48;
                    $getterm = 4;
                } else {
                    $calcterm = $term;
                    $getterm = $print_term;
                }
            }
            //for term end
            //multiplier for loan amount
            if ($category == "CAT SA") {
                if ($net_salary > 75000) {//salary
                    if ($calcterm >= 49 && $calcterm <= 60) {
                        $loan_amt = $net_salary * 28;
                    } elseif ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 26;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 23;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 16;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 9;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "13";
                        $intr = 13;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "13.25";
                        $intr = 13.25;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "14";
                        $intr = 14;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($net_salary >= 50000 && $net_salary <= 75000) {//salary
                    if ($calcterm >= 49 && $calcterm <= 60) {
                        $loan_amt = $net_salary * 26;
                    } elseif ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 23;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 20;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 15;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 9;
                    } else {
                        $loan_amt = 0;
                    }
					
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////

                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "13.50";
                        $intr = 13.50;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "13.75";
                        $intr = 13.75;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "14.25";
                        $intr = 14.25;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($net_salary < 50000) {//salary
                    if ($calcterm >= 49 && $calcterm <= 60) {
                        $loan_amt = $net_salary * 24;
                    } elseif ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 21;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 20;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 13;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 8;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "14";
                        $intr = 14;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "14.50";
                        $intr = 14.50;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "15";
                        $intr = 15;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } else {
                    
                }
            }//CAT SA
            elseif ($category == "CAT A") {
                if ($net_salary > 75000) {//salary
                    if ($calcterm >= 49 && $calcterm <= 60) {
                        $loan_amt = $net_salary * 28;
                    } elseif ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 23;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 20;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 14;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 9;
                    } else {
                        $loan_amt = 0;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "13";
                        $intr = 13;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "13.25";
                        $intr = 13.25;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "14";
                        $intr = 14;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($net_salary >= 50000 && $net_salary <= 75000) {//salary
                    if ($calcterm >= 49 && $calcterm <= 60) {
                        $loan_amt = $net_salary * 25;
                    } elseif ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 22;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 19;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 14;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 8;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "13.50";
                        $intr = 13.50;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "13.75";
                        $intr = 13.75;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "14.25";
                        $intr = 14.25;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($net_salary < 50000) {//salary
                    if ($calcterm >= 49 && $calcterm <= 60) {
                        $loan_amt = $net_salary * 24;
                    } elseif ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 21;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 18;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 13;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 8;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "14";
                        $intr = 14;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "14.50";
                        $intr = 14.50;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "15";
                        $intr = 15;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } else {
                    
                }
            }//CAT A
            elseif ($category == "CAT B") {
                if ($net_salary > 75000) {//salary
                    if ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 19;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 17;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 12;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 7;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "14";
                        $intr = 14;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "14.50";
                        $intr = 14.50;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "15";
                        $intr = 15;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($net_salary >= 50000 && $net_salary <= 75000) {//salary
                    if ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 19;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 16;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 12;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 6;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "14.50";
                        $intr = 14.50;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "14.75";
                        $intr = 14.75;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "15.25";
                        $intr = 15.25;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($net_salary < 50000) {//salary
                    if ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 18;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 16;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 11;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 6;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "15.25";
                        $intr = 15.25;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "15.75";
                        $intr = 15.75;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "16.25";
                        $intr = 16.25;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } else {
                    
                }
            } elseif ($category == "CAT C") {
                if ($net_salary > 75000) {//salary
                    if ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 13;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 11;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 9;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 5;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "15";
                        $intr = 15;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "15.50";
                        $intr = 15.50;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "16";
                        $intr = 16;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($net_salary >= 50000 && $net_salary <= 75000) {//salary
                    if ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 13;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 11;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 9;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 5;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "15.25";
                        $intr = 15.25;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "15.75";
                        $intr = 15.75;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "16.25";
                        $intr = 16.25;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($net_salary < 50000) {//salary
                    if ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 11;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 9;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 7;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 5;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "16.25";
                        $intr = 16.25;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "16.75";
                        $intr = 16.75;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "17";
                        $intr = 17;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } else {
                    $interestrate = 0;
                    $intr = 0;
                }
            } elseif ($category == "CAT D") {
                if ($net_salary > 75000) {//salary
                    if ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 13;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 11;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 9;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 5;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "17";
                        $intr = 17;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "17.50";
                        $intr = 17.50;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "18";
                        $intr = 18;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($net_salary >= 50000 && $net_salary <= 75000) {//salary
                    if ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 13;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 11;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 9;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 5;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "17.50";
                        $intr = 17.50;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "18";
                        $intr = 18;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "19";
                        $intr = 19;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($net_salary < 50000) {//salary
                    if ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 11;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 9;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 7;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 5;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "17.75";
                        $intr = 17.75;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "19";
                        $intr = 19;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "20";
                        $intr = 20;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } else {
                    $interestrate = 0;
                    $intr = 0;
                }
            } else {
                if ($net_salary > 75000) {//salary
                    if ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 13;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 11;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 9;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 5;
                    } else {
                        $loan_amt = 0;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "17";
                        $intr = 17;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "17.50";
                        $intr = 17.50;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "18";
                        $intr = 18;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($net_salary >= 50000 && $net_salary <= 75000) {//salary
                    if ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 13;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 11;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 9;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 5;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    if ($loan_amt > 0) {
                        //rategrid //
                        if ($loan_amt > 400000) {
                            $interestrate = "17.50";
                            $intr = 17.50;
                        } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                            $interestrate = "18";
                            $intr = 18;
                        } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                            $interestrate = "19";
                            $intr = 19;
                        } else {
                            $interestrate = 0;
                            $intr = 0;
                        }
                    }
                } elseif ($net_salary < 50000) {//salary
                    if ($calcterm >= 37 && $calcterm <= 48) {
                        $loan_amt = $net_salary * 11;
                    } elseif ($calcterm >= 25 && $calcterm <= 36) {
                        $loan_amt = $net_salary * 9;
                    } elseif ($calcterm >= 24 && $calcterm <= 13) {
                        $loan_amt = $net_salary * 7;
                    } elseif ($calcterm <= 12) {
                        $loan_amt = $net_salary * 5;
                    }
					////////////////////////////////////////////////////////
					if($reqloanamount>0)
					{
						if($reqloanamount>$loan_amt)
						{
							$loan_amt=$loan_amt;
						}
						else
						{
							$loan_amt=$reqloanamount;
						}
					}
					else
					{
						$loan_amt=$loan_amt;
					}
					///////////////////////////////////////////////////////
                    //rategrid //
                    if ($loan_amt > 400000) {
                        $interestrate = "17.75";
                        $intr = 17.75;
                    } elseif ($loan_amt >= 200000 && $loan_amt <= 400000) {
                        $interestrate = "19";
                        $intr = 19;
                    } elseif ($loan_amt >= 100000 && $loan_amt <= 200000) {
                        $interestrate = "20";
                        $intr = 20;
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } else {
                    $loan_amt = 0;
                    $interestrate = 0;
                    $intr = 0;
                }
            }

            //rate calculation
            if ($loan_amt > 1500000) {
                $getloanamout = 1500000;
            } else {
                $getloanamout = $loan_amt;
            }

            $proc_Fee = "2%";
        } else { //self employed
            if ($term > 48) {
                $calcterm = 48;
                $getterm = 4;
            } else {
                $calcterm = $term;
                $getterm = $print_term;
            }
            // as per foir
            $applicableFOIR = $net_salary * (.60);
           // $intrcalc = 18;
            $princ = 100000;
            $emicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $calcterm))));//getController()->Common()->getEMI($princ, $intrcalc, $calcterm);
            $loanPossible = ($emicalc > 0) ? ($applicableFOIR / $emicalc) : 0;
            $viewLoanAmt = round($loanPossible * 100000);
            $loan_amt_asfoir = $viewLoanAmt;
            //as per multiplier
            $loan_amt_asmultiplier = $net_salary * 2;
            if ($loan_amt_asmultiplier > $loan_amt_asfoir) {
                $loan_amt = $loan_amt_asfoir;
            } else {
                $loan_amt = $loan_amt_asmultiplier;
            }

            if ($loan_amt > 1000000) {
                $getloanamout = 1000000;
            } else {
                $getloanamout = $loan_amt;
            }
			////////////////////////////////////////////////////////
				if($reqloanamount>0)
				{
					if($reqloanamount>$loan_amt)
					{
						$loan_amt=$loan_amt;
					}
					else
					{
						$loan_amt=$reqloanamount;
					}
				}
				else
				{
					$loan_amt=$loan_amt;
				}
			///////////////////////////////////////////////////////
            if ($loan_amt > 700000) {
                $interestrate = "22";
                $intr = 22;
            } elseif ($loan_amt >= 300000 && $loan_amt <= 700000) {
                $interestrate = "23";
                $intr = 23;
            } elseif ($loan_amt < 300000) {
                $interestrate = "25";
                $intr = 25;
            } else {
                $interestrate = 0;
                $intr = 0;
            }
            $print_term = $getterm;
            $proc_Fee = "3%";
        }

        //emi
        if ($getloanamout > 0 && $intr > 0) {
            $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $calcterm))));//getController()->Common()->getEMI($getloanamout, $intr, $calcterm);
        } else {
            $getemicalc = 0;
            $interestrate = 0;
        }
        
        $emiperlac = round(100000 * ($interestrate/1200) / (1 - (pow(1/(1 + ($interestrate/1200)), $calcterm))));
        $details['bank_code'] = "CapitalFirst";
        $details['interest_rate'] = interestRateFormat($interestrate);
        $details['emi'] = $getemicalc;
        $details['emiperlac'] = $emiperlac;
        $details['tenure'] = $getterm;
        $details['loan_amount'] = round($getloanamout);
        $details['processing_fee'] = $proc_Fee;
        $details['category'] = $category;

        return($details);
    }

    /**
     * Get Bank code,Interest Rate, EMI (per month),Tenure,Eligible Loan Amount,
     * Processing Fee for Tata Capital Personal Loan
     * @param int $net_salary
     * @param string $company
     * @param string $category
     * @param datetime $DOB
     * @param int $Company_Type
     * @param int $Employment_Status
     * @return array

     * @date 17/11/2016
     */
    function TataCapitalPL($net_salary, $company, $category, $DOB, $Company_Type, $Primary_Acc, $reqtenure, $reqloanamount) {
		 $exactnet_salary = $net_salary;
        list($calterm, $calprint_term) = Calculate_Tenure($DOB, "4", "62");
		//for reqd tenure////////////////////////////////////////////////////////////////////////
		if($reqtenure>0)
		{
			if($reqtenure>$calprint_term)
			{
			$term = $calterm;
			$print_term = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$print_term = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$print_term = $calprint_term;
		}
		//for reqd tenure end////////////////////////////////////////////////////////////////////////

        if ($category == "TATA Group" || $category == "TATA GROUP") {
            if ($net_salary >= 60000) {
                $interestrate = "12.50";
                $intr = 12.50;
            } else if ($net_salary >= 30000 && $net_salary < 60000) {
                $interestrate = "12.75";
                $intr = 12.75;
            } else if ($net_salary >= 20000 && $net_salary < 30000) {
                $interestrate = "12.75";
                $intr = 12.75;
            } else {
                $interestrate = 0;
                $intr = 0;
            }
            $proc_Fee = "1.25%";
        } else if ($category == "Super Cat A" || $category == "Super CAT A" || $category == "SUPER CAT A") {
			   if ($net_salary >= 100000) {
                $interestrate = 12.50;
                $intr = $interestrate;
                $proc_Fee = "Rs. 999";
            } else if ($net_salary >= 60000 && $net_salary < 100000) {
                $interestrate = "12.99";
                $intr = 12.99;
            } else if ($net_salary >= 30000 && $net_salary < 60000) {
                $interestrate = "12.99";
                $intr = 12.99;
                $proc_Fee = "1.25%";
            } else if ($net_salary <= 30000) {
                $interestrate = "12.99";
                $intr = 12.99;
                $proc_Fee = "1.25%";
            } else {
                $interestrate = 0;
                $intr = 0;
            }
        } else if ($category == "CAT A") {
            if ($net_salary >= 100000) {
                $interestrate = 13.90;
                $intr = $interestrate;
                $proc_Fee = "Rs. 999";
            } else if ($net_salary >= 60000 && $net_salary < 100000) {
                $interestrate = 14.35;
                $intr = $interestrate;
                $proc_Fee = "Rs. 999";
            } else if ($net_salary >= 30000 && $net_salary < 60000) {
                $interestrate = 16.50;
                $intr = $interestrate;
                $proc_Fee = "1.50%";
            } else if ($net_salary <= 30000) {
                $interestrate = 17;
                $intr = $interestrate;
                $proc_Fee = "1.50%";
            } else {
                $interestrate = 0;
                $intr = 0;
            }
        } else if ($category == "CAT B") {
            if ($net_salary >= 100000) {
                $interestrate = 14.50;
                $intr = $interestrate;
                $proc_Fee = "1%";
            } else if ($net_salary >= 60000 && $net_salary < 100000) {
                $interestrate = 15;
                $intr = $interestrate / 1200;
                $proc_Fee = "1%";
            } else if ($net_salary >= 30000 && $net_salary < 60000) {
                $interestrate = 17;
                $intr = $interestrate;
                $proc_Fee = "1.75%";
            } else {
                $interestrate = 0;
                $intr = 0;
            }
        } else if ($category == "CAT C") {
            if ($net_salary >= 60000) {
                $interestrate = "17";
                $intr = 17;
            } else if ($net_salary >= 30000 && $net_salary < 60000) {
                $interestrate = "17";
                $intr = 17;
            } else {
                $interestrate = 0;
                $intr = 0;
            }
            $proc_Fee = "2%";
        } else if ($category == "GOVT") {
            if ($net_salary >= 60000) {
                $interestrate = "16.50";
                $intr = 16.5;
            } else if ($net_salary >= 30000 && $net_salary < 60000) {
                $interestrate = "17";
                $intr = 17;
            } else {
                $interestrate = 0;
                $intr = 0;
            }
            $proc_Fee = "2%";
        } else {
            if ($net_salary >= 60000) {
                $interestrate = "19";
                $intr = 19;
            } else if ($net_salary >= 30000 && $net_salary < 60000) {
                $interestrate = "19.50";
                $intr = 19.50;
            } else {
                $interestrate = 0;
                $intr = 0;
            }
        }
		        //special Clause 
        /*if (($category == "TATA Group" || $category == "TATA GROUP" || $category == "Super Cat A" || $category == "Super CAT A" || $category == "CAT A" || $category == "CAT B") && $net_salary >= 100000) {
            $interestrate = "14.99";
            $intr = 14.99;
            $proc_Fee = "1.25%";
        } else {
            $interestrate = "15.99";
            $intr = 15.99;
            $proc_Fee = "1.50%";
        }*/

        //Calculate Tenure
        if ($category == "TATA Group" || $category == "Super Cat A" || $category == "Super CAT A") {
            if ($term > 72) {
                $calcterm = 66;
                $getterm = 5.5;
            } else {
                $calcterm = $term;
                $getterm = $print_term;
            }
        } else if ($category == "CAT A" || $category == "CAT B" || $category == "GOVT") {
            if ($term > 48) {
                $calcterm = 48;
                $getterm = 4;
            } else {
                $calcterm = $term;
                $getterm = $print_term;
            }
        } else {
            if ($term > 36) {
                $calcterm = 36;
                $getterm = 3;
            } else {
                $calcterm = $term;
                $getterm = $print_term;
            }
        }
		
        // Multiplier
        if ($category == "TATA Group" || $category == "Super Cat A" || $category == "Super CAT A") {
            if ($calcterm >= 49 && $calcterm <= 66) {
                $loan_amt = $net_salary * 18;
            } else if ($calcterm >= 37 && $calcterm <= 48) {
                $loan_amt = $net_salary * 15;
            } else if ($calcterm >= 25 && $calcterm <= 36) {
                $loan_amt = $net_salary * 12;
            } else if ($calcterm >= 24 && $calcterm <= 13) {
                $loan_amt = $net_salary * 10;
            } else if ($calcterm <= 12) {
                $loan_amt = $net_salary * 5;
            }
        } else if ($category == "CAT A") {
            if ($calcterm >= 49 && $calcterm <= 60) {
                $loan_amt = "";
            } else if ($calcterm >= 37 && $calcterm <= 48) {
                $loan_amt = $net_salary * 14;
            } else if ($calcterm >= 25 && $calcterm <= 36) {
                $loan_amt = $net_salary * 11;
            } else if ($calcterm >= 24 && $calcterm <= 13) {
                $loan_amt = $net_salary * 9;
            } else if ($calcterm <= 12) {
                $loan_amt = $net_salary * 5;
            }
        } else if ($category == "CAT B" || $category == "GOVT") {
            if ($calcterm >= 49 && $calcterm <= 60) {
                $loan_amt = "";
            } else if ($calcterm >= 37 && $calcterm <= 48) {
                $loan_amt = $net_salary * 13;
            } else if ($calcterm >= 25 && $calcterm <= 36) {
                $loan_amt = $net_salary * 11;
            } else if ($calcterm >= 24 && $calcterm <= 13) {
                $loan_amt = $net_salary * 8;
            } else if ($calcterm <= 12) {
                $loan_amt = $net_salary * 5;
            }
        } else if ($category == "CAT C") {
            if ($calcterm >= 25 && $calcterm <= 36) {
                $loan_amt = $net_salary * 11;
            } else if ($calcterm >= 24 && $calcterm <= 13) {
                $loan_amt = $net_salary * 8;
            } else if ($calcterm <= 12) {
                $loan_amt = $net_salary * 5;
            }
        } else {
            if ($calcterm >= 25 && $calcterm <= 36) {
                $loan_amt = $net_salary * 11;
            } else if ($calcterm >= 24 && $calcterm <= 13) {
                $loan_amt = $net_salary * 8;
            } else if ($calcterm <= 12) {
                $loan_amt = $net_salary * 5;
            } else {
                $loan_amt = 0;
            }
        }
		////////////////////////////////////////////////////////
			if($reqloanamount>0)
			{
				if($reqloanamount>$loan_amt)
				{
					$loan_amt=$loan_amt;
				}
				else
				{
					$loan_amt=$reqloanamount;
				}
			}
			else
			{
				$loan_amt=$loan_amt;
			}
			///////////////////////////////////////////////////////
		if($loan_amt >= 600000)
		{
        if (($category == "TATA Group" || $category == "TATA GROUP" || $category == "Super Cat A" || $category == "Super CAT A") && $loan_amt >= 600000) {
            $interestrate = 12.50;
            $intr = $interestrate;
            $proc_Fee = "Rs. 999";
        } elseif (($category == "CAT A" || $category == "CAT B") && $loan_amt >= 600000) {
            $interestrate = 13.90;
            $intr = $interestrate;
            $proc_Fee = "Rs. 999";
        } else {
            $interestrate = 17;
            $intr = 17;
            $proc_Fee = "2%";
        }
		}
        //MAx Loan Amount
        if ($intr > 0) {
            if ($category == "TATA Group" || $category == "TATA GROUP" || $category == "Super Cat A" || $category == "Super CAT A" || $category == "CAT A") {
                if ($loan_amt >= 1500000) {
                    $loan_amount = 1500000;
                } else {
                    $loan_amount = $loan_amt;
                }
            } else {
                if ($loan_amt >= 1500000) {
                    $loan_amount = 1500000;
                } else {
                    $loan_amount = $loan_amt;
                }
            }
            $getemicalc = round($loan_amount * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $calcterm))));//getController()->Common()->getEMI($loan_amount, $intr, $calcterm);
            $fterm = $calcterm / 12;
        }
		$emiperlac = round(100000 * ($interestrate/1200) / (1 - (pow(1/(1 + ($interestrate/1200)), $calcterm))));
        $details['bank_code'] = "Tata Capital";
        $details['interest_rate'] = interestRateFormat($interestrate);
        $details['emi'] = $getemicalc;
        $details['emiperlac'] = $emiperlac;
        $details['tenure'] = $getterm;
        $details['loan_amount'] = round($loan_amount);
        $details['processing_fee'] = $proc_Fee;
        $details['category'] = $category;
        return($details);
    }

    /**
     * Get Bank code,Interest Rate, EMI (per month),Tenure,Eligible Loan Amount,
     * Processing Fee for Standard Chartered Bank Personal Loan
     * @param int $net_salary
     * @param int $clubbed_emi
     * @param string $company
     * @param string $category
     * @param datetime $DOB
     * @param int $Company_Type
     * @param string $Primary_Acc
     * @return array

     * @date 18/11/2016
     */
    function StanCPL($net_salary, $clubbed_emi, $company, $category, $DOB, $Company_Type, $Primary_Acc, $reqtenure, $reqloanamount) {
        $exactnet_salary = $net_salary;
        $exactnet_salaryTO = $net_salary - $clubbed_emi;
        list($calterm, $calprint_term) = Calculate_Tenure($DOB, "5", "62");
		//for reqd tenure////////////////////////////////////////////////////////////////////////
		if($reqtenure>0)
		{
			if($reqtenure>$calprint_term)
			{
			$term = $calterm;
			$print_term = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$print_term = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$print_term = $calprint_term;
		}
		//for reqd tenure end////////////////////////////////////////////////////////////////////////
        if ($print_term == 1) {
            $term = 12;
            $getterm = 1;
        } elseif ($print_term == 2) {
            $term = 24;
            $getterm = 2;
        } elseif ($print_term == 3) {
            $term = 36;
            $getterm = 3;
        } elseif ($print_term == 4) {
            $term = 48;
            $getterm = 4;
        } elseif ($print_term == 5 || $print_term > 5) {
            $term = 60;
            $getterm = 5;
        }
        $LoanAmount = ($net_salary * 10) - $clubbed_emi;
		////////////////////////////////////////////////////////
			if($reqloanamount>0)
			{
				if($reqloanamount>$LoanAmount)
				{
					$LoanAmount=$LoanAmount;
				}
				else
				{
					$LoanAmount=$reqloanamount;
				}
			}
			else
			{
				$LoanAmount=$LoanAmount;
			}
		if($category=="CAT A" || $category=="CAT A +" || $category=="CAT B")
		{
			if($exactnet_salaryTO>=200000)
			{
				$interestrate = "10.99%";
				$intr=10.99;
				$Processing_Fee = "0%";
			}
			elseif($exactnet_salaryTO>=150000 && $exactnet_salaryTO<200000)
			{
				$interestrate = "11.25%";
				$intr=11.25;
				$Processing_Fee = "0%";
			}
		  else if($exactnet_salaryTO>=75000 && $exactnet_salaryTO<150000)
			{
				$interestrate = "11.49%";
				$intr=11.49;
				$Processing_Fee = "0%";
			}
			else if($exactnet_salaryTO>=50000 && $exactnet_salaryTO<75000)
			{
				$interestrate = "11.99%";
				$intr=11.99;
				$Processing_Fee = "0%";
			}
			elseif($exactnet_salaryTO<50000)
			{
				$interestrate = "13.49%";
				$intr=13.49;
				$Processing_Fee = "0%";
			}
			else
			{
				$interestrate = "13.49%";
				$intr=13.49;
				$Processing_Fee = "0%";
			}	
		}
		elseif($category=="CAT C" || $category=="CAT D")
		{
			if($exactnet_salaryTO>=200000)
			{
				$interestrate = "10.99%";
				$intr=10.99;
				$Processing_Fee = "0%";
			}
			elseif($exactnet_salaryTO>=150000 && $exactnet_salaryTO<200000)
			{
				$interestrate = "11.25%";
				$intr=11.25;
				$Processing_Fee = "0%";
			}
		  else if($exactnet_salaryTO>=75000 && $exactnet_salaryTO<150000)
			{
				$interestrate = "11.49%";
				$intr=11.49;
				$Processing_Fee = "0%";
			}
			else if($exactnet_salaryTO>=50000 && $exactnet_salaryTO<75000)
			{
				$interestrate = "11.99%";
				$intr=11.99;
				$Processing_Fee = "0%";
			}
			elseif($exactnet_salaryTO<50000)
			{
				$interestrate = "13.49%";
				$intr=13.49;
				$Processing_Fee = "0%";
			}
			else
			{
				$interestrate = "13.49%";
				$intr=13.49;
				$Processing_Fee = "0%";
			}	
		}
		else
		{
			if($exactnet_salaryTO>=200000)
			{
				$interestrate = "10.99%";
				$intr=10.99;
				$Processing_Fee = "0%";
			}
			elseif($exactnet_salaryTO>=150000 && $exactnet_salaryTO<200000)
			{
				$interestrate = "11.25%";
				$intr=11.25;
				$Processing_Fee = "0%";
			}
		  else if($exactnet_salaryTO>=75000 && $exactnet_salaryTO<150000)
			{
				$interestrate = "11.99%";
				$intr=11.99;
				$Processing_Fee = "0%";
			}
			else if($exactnet_salaryTO>=50000 && $exactnet_salaryTO<75000)
			{
				$interestrate = "12.99%";
				$intr=12.99;
				$Processing_Fee = "0%";
			}
			elseif($exactnet_salaryTO<50000)
			{
				$interestrate = "14.49%";
				$intr=14.49;
				$Processing_Fee = "0%";
			}
			else
			{
				$interestrate = "14.49%";
				$intr=14.49;
				$Processing_Fee = "0%";
			}	
		}

        if ($LoanAmount > 3000000) {
            $getloanamout = 3000000;
        } else {
            $getloanamout = $LoanAmount;
        }
		$emiperlac = round(100000 * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));
        $emicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));
        $details['bank_code'] = "Standard Chartered";
        $details['interest_rate'] = interestRateFormat($interestrate);
        $details['emi'] = $emicalc;
		$details['emiperlac'] = $emiperlac;
        $details['tenure'] = $print_term;
        $details['loan_amount'] = round($getloanamout);
        $details['processing_fee'] = $Processing_Fee;
        $details['category'] = $category;
        return($details);
    }

    /**
     * Get Bank code,Interest Rate, EMI (per month),Tenure,Eligible Loan Amount,
     * Processing Fee for Kotak Bank Personal Loan 
     * @param int $net_salary
     * @param string $company
     * @param string $category
     * @param datetime $DOB
     * @param int $Company_Type
     * @param string $Primary_Acc
     * @return array

     * @date 18/11/2016
     */
     function KotakBankPL($net_salary, $company, $category, $DOB, $Company_Type, $Primary_Acc, $reqtenure, $reqloanamount) {
        list($calterm, $calprint_term) = Calculate_Tenure($DOB, "5", "62");
		//for coorperate
		$kotakcmpqry="Select  * from pl_company_kotak Where (company_name like '%".$company."%')";
		list($recordcount,$grow)=MainselectfuncNew($kotakcmpqry,$array = array());
		$growcontr=count($grow)-1;
		if(strlen($kotakrow["company_name"])>2)
			{
				$spinterest_rate = $grow[$growcontr]["interest_rate"];
				$spprocessing_fee = $grow[$growcontr]["processing_fee"];
				$category="CAT A";
			}
		//for reqd tenure////////////////////////////////////////////////////////////////////////
		if($reqtenure>0)
		{
			if($reqtenure>$calprint_term)
			{
			$term = $calterm;
			$getterm = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$getterm = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$getterm = $calprint_term;
		}
		//for reqd tenure end////////////////////////////////////////////////////////////////////////
		if(strlen($kotakrow["company_name"])>2)
		{
			$interestrate = $spinterest_rate."%";
			$intr=$spinterest_rate;
			$proc_fee=$spprocessing_fee;
			$princ=100000;

			$perlacemi=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));
			if($net_salary<=40000)
				{
					$firstnet_salary=($net_salary* (60/100));
					$newnet_salary= $firstnet_salary;
					$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
				}
			else if($net_salary>40000 && $net_salary<=69999)
				{
					$firstnet_salary=($net_salary* (65/100));
					$newnet_salary= $firstnet_salary;
					$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
				}
				else if($net_salary>=70000)
				{
					$firstnet_salary=($net_salary* (70/100));
					$newnet_salary= $firstnet_salary;
					$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
				}
			else
			{}
		}
	else
	{ 
        if ($category == "CAT A" || $category == "CAT B" || $category == "CAT C") {
            
                if ($net_salary > 35000) {
                    $interestrate = 14.65;
                    $intr = $interestrate;
                } elseif ($net_salary > 20000 && $net_salary <= 35000) {
                    $interestrate = 16.80;
                    $intr = $interestrate;
                } elseif ($net_salary <= 20000) {
                    $interestrate = 16.99;
                    $intr = $interestrate;
                } else {
                    $interestrate = 0;
                    $intr = 0;
                }
			if($Primary_Acc=='Kotak Bank')
				{
				$pro_fee="2%";
				}
				else
				{
					$pro_fee="2.5%";
				}	
            $princ = 100000;
			 $perlacemi = round($princ * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));
            if ($net_salary <= 40000) {
                $firstnet_salary = ($net_salary * (60 / 100));
                $newnet_salary = $firstnet_salary;
                $finalloanamount_dbr = ($perlacemi > 0) ? ($newnet_salary / $perlacemi * 100000) : 0;
            } else if ($net_salary > 40000 && $net_salary <= 69999) {
                $firstnet_salary = ($net_salary * (65 / 100));
                $newnet_salary = $firstnet_salary;
                $finalloanamount_dbr = ($perlacemi > 0) ? ($newnet_salary / $perlacemi * 100000) : 0;
            } else if ($net_salary >= 70000) {
                $firstnet_salary = ($net_salary * (70 / 100));
                $newnet_salary = $firstnet_salary;
                $finalloanamount_dbr = ($perlacemi > 0) ? ($newnet_salary / $perlacemi * 100000) : 0;
            } else {
                $finalloanamount_dbr = 0;
            }
        } elseif ($category == "CAT D") {
            if ($net_salary >= 20000) {
                $interestrate = "18.85";
                $intr = 18.85;
                $proc_fee = "2%";
            } else {
                $interestrate = 0;
                $intr = 0;
            }
			if($Primary_Acc=='Kotak Bank')
				{
				$pro_fee="2%";
				}
				else
				{
					$pro_fee="2.5%";
				}
            $princ = 100000;
             $perlacemi = round($princ * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));
            if ($net_salary <= 40000) {
                $firstnet_salary = ($net_salary * (50 / 100));
                $newnet_salary = $firstnet_salary;
                $finalloanamount_dbr = ($perlacemi > 0) ? ($newnet_salary / $perlacemi * 100000) : 0;
            } else if ($net_salary > 40000 && $net_salary <= 69999) {
                $firstnet_salary = ($net_salary * (60 / 100));
                $newnet_salary = $firstnet_salary;
                $finalloanamount_dbr = ($perlacemi > 0) ? ($newnet_salary / $perlacemi * 100000) : 0;
            } else if ($net_salary > 70000) {
                $firstnet_salary = ($net_salary * (65 / 100));
                $newnet_salary = $firstnet_salary;
                $finalloanamount_dbr = ($perlacemi > 0) ? ($newnet_salary / $perlacemi * 100000) : 0;
            } else {
                $finalloanamount_dbr = 0;
            }
        } else {
             if ($net_salary >= 20000) {
                $interestrate = "18.85";
                $intr = 18.85;
                $proc_fee = "2%";
            } else {
                $interestrate = 0;
                $intr = 0;
            }
            $princ = 100000;
            $perlacemi = round($princ * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));
            if ($net_salary <= 40000) {
                $firstnet_salary = ($net_salary * (50 / 100));
                $newnet_salary = $firstnet_salary;
                $finalloanamount_dbr = ($perlacemi > 0) ? ($newnet_salary / $perlacemi * 100000) : 0;
            } else if ($net_salary > 40000 && $net_salary <= 69999) {
                $firstnet_salary = ($net_salary * (60 / 100));
                $newnet_salary = $firstnet_salary;
                $finalloanamount_dbr = ($perlacemi > 0) ? ($newnet_salary / $perlacemi * 100000) : 0;
            } else if ($net_salary > 70000) {
                $firstnet_salary = ($net_salary * (65 / 100));
                $newnet_salary = $firstnet_salary;
                $finalloanamount_dbr = ($perlacemi > 0) ? ($newnet_salary / $perlacemi * 100000) : 0;
            } else {
                $finalloanamount_dbr = 0;
            }
        }
	}
        if ($finalloanamount_dbr > 2000000) {
            $getloanamout = 2000000;
        } else {
            $getloanamout = $finalloanamount_dbr;
        }
		
		//loan amouont clause
	if($category=="CAT A" || $category=="CAT C" || $category=="CAT B" || $category=="CAT D")
		{
	if($getloanamout>=1000000 && $getloanamout<1500000)
		{
			if($category=="CAT A" || $category=="CAT C" || $category=="CAT B")
			{
				$interestrate = 13.30;
					$intr=$interestrate;
					$proc_fee="Rs.3999";
				if(strlen($kotakrow["company_name"])>2)
				{
					if($spinterest_rate>$interestrate)
					{
						$interestrate = 13.30;
						$intr=$interestrate;
						$proc_fee="Rs.3999";	
					}
					else
					{
						$interestrate = $spinterest_rate;
						$intr=$interestrate;
						$proc_fee=$spprocessing_fee;
					}
				}
			}
			else
			{
				$interestrate = 13.30;
				$intr=$interestrate;
				$proc_fee="2%";
			}
		}
	elseif($getloanamout>=1500000 && $getloanamout<1700000)
		{
			if($category=="CAT A" || $category=="CAT C" || $category=="CAT B")
			{			
				$interestrate = 12.80;
				$intr=$interestrate;
				$proc_fee="Rs.3999";

				if(strlen($kotakrow["company_name"])>2)
				{
					if($spinterest_rate>$interestrate)
					{
						$interestrate = 12.80;
						$intr=$interestrate;
						$proc_fee="Rs.3999";	
					}
					else
					{
						$interestrate = $spinterest_rate;
						$intr=$interestrate;
						$proc_fee=$spprocessing_fee;
					}
				}
			}
			else
			{
				$interestrate = 12.99;
				$intr=$interestrate/1200;
				$proc_fee="2%";
			}
		}
	elseif($getloanamout>=1700000)
		{
			if($category=="CAT A" || $category=="CAT C" || $category=="CAT B")
			{
				$interestrate = 11.70;
				$intr=$interestrate;
				$proc_fee="Rs.4999";

				if(strlen($kotakrow["company_name"])>2)
				{
					if($spinterest_rate>$interestrate)
					{
						$interestrate = 11.70;
						$intr=$interestrate;
						$proc_fee="Rs.4999";
					}
					else
					{
						$interestrate = $spinterest_rate;
						$intr=$interestrate;
						$proc_fee=$spprocessing_fee;
					}
				}						
			}
			else
			{
				$interestrate = 11.99;
				$intr=$interestrate;
				$proc_fee="2%";
			}
		}
			}
        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);

		$emiperlac = round(100000 * ($interestrate/1200) / (1 - (pow(1/(1 + ($interestrate/1200)), $term))));
        $details['bank_code'] = "Kotak Bank";
        $details['interest_rate'] = interestRateFormat($interestrate);
        $details['emi'] = $getemicalc;
        $details['emiperlac'] = $emiperlac;
        $details['tenure'] = $getterm;
        $details['loan_amount'] = round($getloanamout);
        $details['processing_fee'] = $proc_fee;
        $details['category'] = $category;
        return($details);
    }

    /**
     * Get Bank code,Interest Rate, EMI (per month),Tenure,Eligible Loan Amount,
     * Processing Fee for IndusInd Bank Personal Loan
     * @param int $strnet_salary
     * @param string $company
     * @param string $category
     * @param datetime $DOB
     * @param int $clubbed_emi
     * @return array

     * @date 18/11/2016
     */
     function IndusIndPL($strnet_salary, $company, $category, $DOB, $clubbed_emi, $city, $reqtenure, $reqloanamount) {
        $net_salary = $strnet_salary;

        list($calterm, $calprint_term) = Calculate_Tenure($DOB, "5", "62");
		//for reqd tenure////////////////////////////////////////////////////////////////////////
		if($reqtenure>0)
		{
			if($reqtenure>$calprint_term)
			{
				$term = $calterm;
				$print_term = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$print_term = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$print_term = $calprint_term;
		}
		//for reqd tenure end////////////////////////////////////////////////////////////////////////

        if ($category == "A+" || $category == "CAT A") {
            if ($city == "Delhi" || $city == "Noida" || $city == "Faridabad" || $city == "Gurgaon" || $city == "Gaziabad" || $city == "Navi Mumbai" || $city == "Mumbai" || $city == "Thane" || $city == "Bangalore" || $city == "Chennai") {
                if ($net_salary > 100000) {
                    $interestrate = "12.99";
                    $intr = $interestrate;
                    $proc_fee = "0.50%";
                } else if ($net_salary > 50000 && $net_salary <= 100000) {
                    $interestrate = "13.75";
                    $intr = $interestrate ;
                    $proc_fee = "1.25%";
                } else if ($net_salary >= 25000 && $net_salary <= 50000) {
                    $interestrate = "14.75";
                    $intr = $interestrate;
                    $proc_fee = "1.50%";
                } else {
                    $interestrate = 0;
                    $intr = 0;
                    $proc_fee = 0;
                }
            } else {
                if ($net_salary > 100000) {
                    $interestrate = "13.50";
                    $intr = $interestrate;
                    $proc_fee = "1%";
                } else if ($net_salary > 50000 && $net_salary <= 100000) {
                    $interestrate = "14.25";
                    $intr = $interestrate;
                    $proc_fee = "1.75%";
                } else if ($net_salary >= 25000 && $net_salary <= 50000) {
                    $interestrate = "15.25";
                    $intr = $interestrate;
                    $proc_fee = "2%";
                } else {
                    $interestrate = 0;
                    $intr = 0;
                    $proc_fee = 0;
                }
            }
            if ($term == 12) {
                $getterm = 1;
            } elseif ($term == 24) {
                $getterm = 2;
            } elseif ($term == 36) {
                $getterm = 3;
            } elseif ($term == 48) {
                $getterm = 4;
            } elseif ($term == 60) {
                $getterm = 5;
            } else {
                $getterm = 5;
            }
        } else if ($category == "CAT B" || $category == "CAT G" || $category == "C1000") {
            if ($city == "Delhi" || $city == "Noida" || $city == "Faridabad" || $city == "Gurgaon" || $city == "Gaziabad" || $city == "Navi Mumbai" || $city == "Mumbai" || $city == "Thane" || $city == "Bangalore" || $city == "Chennai") {
                if ($net_salary > 100000) {
                    $interestrate = 14.00;
                    $intr = $interestrate;
                    $proc_fee = "1%";
                } else if ($net_salary > 50000 && $net_salary <= 100000) {
                    $interestrate = 15.00;
                    $intr = $interestrate;
                    $proc_fee = "1.50%";
                } else if ($net_salary >= 25000 && $net_salary <= 50000) {
                    $interestrate = 16.00;
                    $intr = $interestrate;
                    $proc_fee = "1.75%";
                } else {
                    $interestrate = 0;
                    $intr = 0;
                    $proc_fee = 0;
                }
            } else {
                if ($net_salary > 100000) {
                    $interestrate = "14.50";
                    $intr = $interestrate;
                    $proc_fee = "1.50%";
                } else if ($net_salary > 50000 && $net_salary <= 100000) {
                    $interestrate = "14.50";
                    $intr = $interestrate;
                    $proc_fee = "2%";
                } else if ($net_salary >= 25000 && $net_salary <= 50000) {
                    $interestrate = "15.25";
                    $intr = $interestrate;
                    $proc_fee = "2.25%";
                } else {
                    $interestrate = 0;
                    $intr = 0;
                    $proc_fee = 0;
                }
            }
            if ($term == 12) {
                $getterm = 1;
            } elseif ($term == 24) {
                $getterm = 2;
            } elseif ($term == 36) {
                $getterm = 3;
            } elseif ($term == 48) {
                $getterm = 4;
            } else {
                $getterm = 4;
            }
        } else if ($category == "CAT C") {
            if ($city == "Delhi" || $city == "Noida" || $city == "Faridabad" || $city == "Gurgaon" || $city == "Gaziabad" || $city == "Navi Mumbai" || $city == "Mumbai" || $city == "Thane" || $city == "Bangalore" || $city == "Chennai") {
                if ($net_salary > 100000) {
                    $interestrate = 17.50;
                    $intr = $interestrate;
                    $proc_fee = "1.25%";
                } else if ($net_salary > 50000 && $net_salary <= 100000) {
                    $interestrate = 18;
                    $intr = $interestrate;
                    $proc_fee = "1.75%";
                } else if ($net_salary >= 25000 && $net_salary <= 50000) {
                    $interestrate = 19;
                    $intr = $interestrate;
                    $proc_fee = "2%";
                } else {
                    $interestrate = 0;
                    $intr = 0;
                    $proc_fee = 0;
                }
            } else {
                if ($net_salary > 100000) {
                    $interestrate = "18.50";
                    $intr = $interestrate;
                    $proc_fee = "1.75%";
                } else if ($net_salary > 50000 && $net_salary <= 100000) {
                    $interestrate = "19";
                    $intr = $interestrate;
                    $proc_fee = "2.25%";
                } else if ($net_salary >= 25000 && $net_salary <= 50000) {
                    $interestrate = "20";
                    $intr = $interestrate;
                    $proc_fee = "2.50%";
                } else {
                    $interestrate = 0;
                    $intr = 0;
                    $proc_fee = 0;
                }
            }
            if ($term == 12) {
                $getterm = 1;
            } elseif ($term == 24) {
                $getterm = 2;
            } elseif ($term == 36) {
                $getterm = 3;
            } elseif ($term == 48) {
                $getterm = 4;
            } else {
                $getterm = 4;
            }
        } else {
           /* if ($net_salary >= 100000) {
                $interestrate = "17";
                $intr = 17;
                $proc_fee = "1.25%";
            } else if ($net_salary >= 50000 && $net_salary < 100000) {
                $interestrate = "17.5";
                $intr = 17.5;
                $proc_fee = "1.75%";
            } else if ($net_salary >= 25000 && $net_salary <= 50000) {
                $interestrate = "18";
                $intr = 18;
                $proc_fee = "2%";
            } else {
                $interestrate = 0;
                $intr = 0;
                $proc_fee = 0;
            }
            if ($term == 12) {
                $getterm = 1;
            } elseif ($term == 24) {
                $getterm = 2;
            } elseif ($term == 36) {
                $getterm = 3;
            } elseif ($term == 48) {
                $getterm = 4;
            } else {
                $getterm = 4;
            }*/
        }

        if ($getterm == 1) {
            $term = 12;
        } elseif ($getterm == 2) {
            $term = 24;
        } elseif ($getterm == 3) {
            $term = 36;
        } elseif ($getterm == 4) {
            $term = 48;
        } elseif ($getterm == 5) {
            $term = 60;
        }

        $princ = 100000;
        if ($intr > 0) {
            $perlacemi = round($princ * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($princ, $intr, $term);
            //Calculate Loan Amount
            if ($net_salary >= 50000) {
                $firstnet_salary = ($net_salary * (70 / 100));
                $newnet_salary = $firstnet_salary - $clubbed_emi;
                $finalloanamount_dbr = ($perlacemi > 0) ? ($newnet_salary / $perlacemi * 100000) : 0;
            } else if ($net_salary >= 25000 && $net_salary < 50000) {
                $firstnet_salary = ($net_salary * (50 / 100));
                $newnet_salary = $firstnet_salary - $clubbed_emi;
                $finalloanamount_dbr = ($perlacemi > 0) ? ($newnet_salary / $perlacemi * 100000) : 0;
            } else {
                $finalloanamount_dbr = 0;
            }
        } else {
            $finalloanamount_dbr = 0;
        }
        //other eiligibility
        if ($net_salary >= 50000) {
            $finalloanamount_other = $net_salary * 18;
        } else {
            $finalloanamount_other = $net_salary * 18;
        }
        $finalloanamount = 0;
        if ($finalloanamount_other < $finalloanamount_dbr) {
            $finalloanamount = $finalloanamount_other;
        } else {
            $finalloanamount = $finalloanamount_dbr;
        }
        if ($finalloanamount > 2500000) {
            if (strlen($category) > 1) {
                $getloanamout = 2500000;
            } else {
                $getloanamout = 700000;
            }
        } else {
            if (strlen($category) > 1) {
                $getloanamout = $finalloanamount;
            } else {
                if ($finalloanamount > 700000) {
                    $getloanamout = 700000;
                } else {
                    $getloanamout = $finalloanamount;
                }
            }
        }
		////////////////////////////////////////////////////////
			if($reqloanamount>0)
			{
				if($reqloanamount>$getloanamout)
				{
					$getloanamout=$getloanamout;
				}
				else
				{
					$getloanamout=$reqloanamount;
				}
			}
			else
			{
				$getloanamout=$getloanamout;
			}
			///////////////////////////////////////////////////////
        if ($intr > 0) {
            if (($category == "A+" || $category == "CAT A" || $category == "CAT B" || $category == "CAT G") && $getloanamout >= 700000 && $getloanamout < 1500000 && $net_salary >= 75000) {
                $interestrate = "13.49";
                $intr = 13.49;
                $proc_fee = "0.49%";
                $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
            } elseif (($category == "A+" || $category == "CAT A" || $category == "CAT B" || $category == "CAT G") && $getloanamout >= 1500000 && $net_salary >= 100000) {
                $interestrate = "12.99";
                $intr = 12.99;
                $proc_fee = "Rs. 4999";
                $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
            } else {
                $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
            }
        } else {
            $getemicalc = 0;
        }
		
		$emiperlac = round(100000 * ($interestrate/1200) / (1 - (pow(1/(1 + ($interestrate/1200)), $term))));
        $details['bank_code'] = "Indus Ind Bank";
        $details['interest_rate'] = interestRateFormat($interestrate);
        $details['emi'] = $getemicalc;
        $details['emiperlac'] = $emiperlac;
        $details['tenure'] = $getterm;
        $details['loan_amount'] = round($getloanamout);
        $details['processing_fee'] = $proc_fee;
        $details['category'] = $category;
        return($details);
    }

    /**
     * Get Bank code,Interest Rate, EMI (per month),Tenure,Eligible Loan Amount,
     * Processing Fee for ICICI Bank Personal Loan
     * @param int $net_salary
     * @param type $company
     * @param string $category
     * @param datetime $DOB
     * @param int $Company_Type
     * @pgetaram string $Primary_Acc
     * @return array

     * @date 18/11/2016
     */
    function IciciBankPL($net_salary, $company, $category, $DOB, $Company_Type, $Primary_Acc, $reqtenure, $reqloanamount) {
        $exactnet_salary = $net_salary;
        list($calterm, $calprint_term) = Calculate_Tenure($DOB, "5", "62");
		//for reqd tenure////////////////////////////////////////////////////////////////////////
		if($reqtenure>0)
		{
			if($reqtenure>$calprint_term)
			{
				$term = $calterm;
				$print_term = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$print_term = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$print_term = $calprint_term;
		}
		//for reqd tenure end////////////////////////////////////////////////////////////////////////
        $calcterm = $term;
        $getterm = $print_term;
		$gtcropcomp="Select interest_rate,	processing_fee From pl_company_icici Where (company_name like '%".$company."%' and interest_rate>0)";
		list($alreadyExist,$icicirowar)=Mainselectfunc($gtcropcomp,$array = array());
	
		if (count($icicirowar) > 0) {
            $icicirow = array("interest_rate" => $icicirowar["interest_rate"], "processing_fee" => $icicirowar["processing_fee"]);
        } else {
            $icicirow = array("interest_rate" => 0, "processing_fee" => 0);
        }

        if ($icicirow["interest_rate"] > 0) {
            $crprecordcount = $icicirow["interest_rate"];
        } else {
            $crprecordcount = 0;
        }
        if ($crprecordcount > 0) {
            list($main, $gen) = explode('.', $icicirow["interest_rate"]);
            if ($gen == 00) {
                $interestrate = $main;
            } else {
                $interestrate = $icicirow["interest_rate"];
            }
            $intr = $icicirow["interest_rate"];
            $proc_Fee = $icicirow["processing_fee"];
        } else {
            if (strlen($category) > 1) {
                if ($net_salary >= 75000) {
                    $interestrate = 15.35;
                    $intr = $interestrate;
                } else if ($net_salary >= 50000 && $net_salary < 75000) {
                    $interestrate = 15.40;
                    $intr = $interestrate;
                } else if ($net_salary >= 35000 && $net_salary < 50000) {
                    $interestrate = 15.45;
                    $intr = $interestrate;
                } else if ($net_salary >= 20000 && $net_salary <= 35000) {
                    $interestrate = 16.75;
                    $intr = $interestrate;
                } elseif ($net_salary <= 20000) {
                    $interestrate = 16.99;
                    $intr = $interestrate;
                } else {
                    $interestrate = 16.99;
                    $intr = $interestrate;
                }
                if ((strncmp("ICICI", $Primary_Acc, 5)) == 0) {
                    $proc_Fee = "2%";
                } else {
                    $proc_Fee = "2.25%";
                }
            } else {
                /*if ($Company_Type == 4 || $Company_Type == 6) {
                    if ($net_salary >= 50000) {
                        $interestrate = 15.49;
                        $intr = $interestrate;
                        $proc_Fee = "1.49%";
                    } else if ($net_salary >= 35000 && $net_salary < 50000) {
                        $interestrate = 15.75;
                        $intr = $interestrate;
                        $proc_Fee = "1.70%";
                    } else if ($net_salary >= 20000 && $net_salary < 35000) {
                        $interestrate = 16.99;
                        $intr = $interestrate;
                        $proc_Fee = "1.70%";
                    } elseif ($net_salary < 20000) {
                        $interestrate = 17.99;
                        $intr = $interestrate;
                        $proc_Fee = "1.99%";
                    } else {
                        $interestrate = 17.99;
                        $intr = $interestrate;
                        $proc_Fee = "1.99%";
                    }
                } else { */
                    if ($net_salary >= 75000) {
                        $interestrate = 16.99;
                        $intr = $interestrate;
                        if ((strncmp("ICICI", $Primary_Acc, 5)) == 0) {
							$proc_Fee = "2%";
						} else {
							$proc_Fee = "2.25%";
						}
                    } else if ($net_salary >= 50000 && $net_salary < 75000) {
                        $interestrate = 17.49;
                        $intr = $interestrate;
                        if ((strncmp("ICICI", $Primary_Acc, 5)) == 0) {
							$proc_Fee = "2%";
						} else {
							$proc_Fee = "2.25%";
						}
                    } else if ($net_salary >= 35000 && $net_salary < 50000) {
                        $interestrate = 17.99;
                        $intr = $interestrate;
                        $proc_Fee = "2.25%";
                    } else if ($net_salary >= 20000 && $net_salary < 35000) {
                        $interestrate = 17.99;
                        $intr = $interestrate;
                        $proc_Fee = "2.25%";
                    } elseif ($net_salary < 20000) {
                        $interestrate = 18.49;
                        $intr = $interestrate;
                        $proc_Fee = "2.25%";
                    } else {
                        $interestrate = 18.49;
                        $intr = $interestrate;
                        $proc_Fee = "2.25%";
                    }
                //}//else
            }
        }

        $princ = 100000;
        $perlacemi = round($princ * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($princ, $intr, $calcterm);

        //Calculate Loan Amount 
        if ($net_salary >= 50000) {
            $firstnet_salary = ($net_salary * (65 / 100));
            $loan_amt1 = ($perlacemi > 0) ? ($firstnet_salary / $perlacemi * 100000) : 0;
        } else if ($net_salary < 50000) {
            $firstnet_salary = ($net_salary * (55 / 100));
            $loan_amt1 = ($perlacemi > 0) ? ($firstnet_salary / $perlacemi * 100000) : 0;
        } else {
            
        }

        // other method
        if ($category == "Elite" || $category == "SuperPrime") {
            if ($calcterm >= 49 && $calcterm <= 60) {
                $loan_amt = $net_salary * 18;
            } elseif ($calcterm >= 37 && $calcterm <= 48) {
                $loan_amt = $net_salary * 15;
            } elseif ($calcterm >= 25 && $calcterm <= 36) {
                $loan_amt = $net_salary * 13;
            } elseif ($calcterm >= 24 && $calcterm <= 13) {
                $loan_amt = $net_salary * 9;
            } elseif ($calcterm <= 12) {
                $loan_amt = $net_salary * 5;
            }
        } else if ($category == "Preferred") {
            if ($calcterm >= 49 && $calcterm <= 60) {
                $loan_amt = "";
            } elseif ($calcterm >= 37 && $calcterm <= 48) {
                $loan_amt = $net_salary * 13;
            } elseif ($calcterm >= 25 && $calcterm <= 36) {
                $loan_amt = $net_salary * 11;
            } elseif ($calcterm >= 24 && $calcterm <= 13) {
                $loan_amt = $net_salary * 9;
            } elseif ($calcterm <= 12) {
                $loan_amt = $net_salary * 5;
            }
        } else {
            if ($calcterm >= 49 && $calcterm <= 60) {
                $loan_amt = "";
            } elseif ($calcterm >= 37 && $calcterm <= 48) {
                $loan_amt = "";
            } elseif ($calcterm >= 25 && $calcterm <= 36) {
                $loan_amt = $net_salary * 9;
            } elseif ($calcterm >= 24 && $calcterm <= 13) {
                $loan_amt = $net_salary * 7;
            } elseif ($calcterm <= 12) {
                $loan_amt = $net_salary * 5;
            } else {
                $loan_amt = 0;
            }
        }
        if ($loan_amt > 0 && $loan_amt1 > 0) {
            if ($loan_amt >= $loan_amt1) {
                $finalloanamount = $loan_amt1;
            } else {
                $finalloanamount = $loan_amt;
            }
        } else {
            if ($loan_amt > 0) {
                $finalloanamount = $loan_amt;
            }
            if ($loan_amt1 > 0) {
                $finalloanamount = $loan_amt1;
            }
        }

        //Exact Loan Amount
        if ($category == "Elite" || ($category == "SuperPrime" && (strncmp("ICICI", $Primary_Acc, 5)) == 0)) {
            if ($finalloanamount >= 2000000) {
                $loan_amount = 2000000;
            } else {
                $loan_amount = $finalloanamount;
            }
        } else if (($category == "SuperPrime" && (strncmp("ICICI", $Primary_Acc, 5)) != 0) || ($category == "Preferred" && (strncmp("ICICI", $Primary_Acc, 5)) == 0)) {
            if ($finalloanamount >= 2000000) {
                $loan_amount = 2000000;
            } else {
                $loan_amount = $finalloanamount;
            }
        } else {
            if ((strncmp("ICICI", $Primary_Acc, 5)) == 0) {
                if ($finalloanamount >= 2000000) {
                    $loan_amount = 2000000;
                } else {
                    $loan_amount = $finalloanamount;
                }
            } else {
                if ($finalloanamount >= 2000000) {
                    $loan_amount = 2000000;
                } else {
                    $loan_amount = $finalloanamount;
                }
            }
        }
		////////////////////////////////////////////////////////
			if($reqloanamount>0)
			{
				if($reqloanamount>$loan_amount)
				{
					$loan_amount=$loan_amount;
				}
				else
				{
					$loan_amount=$reqloanamount;
				}
			}
			else
			{
					$loan_amount=$loan_amount;
			}
			///////////////////////////////////////////////////////
        // Special Clause
        if (strlen($category) > 0) {
            if ($loan_amount >= 2000000 && (strlen($category) > 0)) {
                    $interestrate = 11.59;
                    $intr = $interestrate;
                    $proc_Fee = "4999";
              
            } elseif (($loan_amount >= 1500000 && $loan_amount < 2000000) && (strlen($category) > 0)) {
               
                    $interestrate = 11.99;
                    $intr = $interestrate;
                    $proc_Fee = "3999";
               
            } elseif (($loan_amount >= 1000000 && $loan_amount < 1500000) && (strlen($category) > 0)) {
               
                    $interestrate = 12.49;
                    $intr = $interestrate;
                    $proc_Fee = "3999";
              
            } elseif (($loan_amount >= 500000 && $loan_amount < 1000000) && (strlen($category) > 0)) {
               
                    $interestrate = 14.49;
                    $intr = $interestrate;
                    $proc_Fee = "0.99%";
            }
        } else {
            if ($loan_amount >= 2000000) {
                $interestrate = 14.99;
                $intr = $interestrate;
                $proc_Fee = "1%";
            } elseif (($loan_amount >= 1500000 && $loan_amount < 2000000)) {
                $interestrate = 15.99;
                $intr = $interestrate;
                $proc_Fee = "1%";
            } elseif (($loan_amount >= 1000000 && $loan_amount < 1500000)) {
                $interestrate = 16.49;
                $intr = $interestrate;
                $proc_Fee = "1%";
            } elseif (($loan_amount >= 500000 && $loan_amount < 1000000)) {
                $interestrate = 16.99;
                $intr = $interestrate;
                $proc_Fee = "1.49%";
            }
        }

        $getemicalc = round($loan_amount * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $calcterm))));//getController()->Common()->getEMI($loan_amount, $intr, $calcterm);
		$emiperlac = round(100000 * ($interestrate/1200) / (1 - (pow(1/(1 + ($interestrate/1200)), $calcterm))));
        
        $details['bank_code'] = "ICICI Bank";
        $details['interest_rate'] = interestRateFormat($interestrate);
        $details['emi'] = $getemicalc;
        $details['emiperlac'] = $emiperlac;
        $details['tenure'] = $getterm;
        $details['loan_amount'] = round($loan_amount);
        $details['processing_fee'] = $proc_Fee;
        $details['category'] = $category;
        return($details);
    }

    /**
     * Get Bank code,Interest Rate, EMI (per month),Tenure,Eligible Loan Amount,
     * Processing Fee for Fullerton India Bank Personal Loan
     * @param int $net_salary
     * @param int $clubbed_emi
     * @param string $company
     * @param string $category
     * @param datetime $DOB
     * @param string $city
     * @return array

     * @date 18/11/2016
     */
    function FullertonPL($net_salary, $clubbed_emi, $company, $category, $DOB, $city, $reqtenure, $reqloanamount) {
        if ($clubbed_emi > 0) {
            $exactnet_salary = ($net_salary * (.60)) - $clubbed_emi;
        } else {
            $exactnet_salary = round($net_salary * 60 / 100);
        }
        list($calterm, $calprint_term) = Calculate_Tenure($DOB, "4", "60");
		//for reqd tenure////////////////////////////////////////////////////////////////////////
		if($reqtenure>0)
		{
			if($reqtenure>$calprint_term)
			{
				$term = $calterm;
				$print_term = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$print_term = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$print_term = $calprint_term;
		}
		//for reqd tenure end////////////////////////////////////////////////////////////////////////

        $getterm = 0;
        $term = 0;
        if ($print_term == 1) {
            $term = 12;
            $getterm = 1;
        } elseif ($print_term == 2) {
            $term = 24;
            $getterm = 2;
        } elseif ($print_term == 3) {
            $term = 36;
            $getterm = 3;
        } elseif ($print_term == 4 || $print_term > 4) {
            $term = 48;
            $getterm = 4;
        }

        if ($exactnet_salary > 0) {
            if ($net_salary >= 10000 && $net_salary <= 18000) {
                $interestrate = 32;
                $intr = $interestrate;
            } elseif ($net_salary > 18000 && $net_salary <= 25000) {
                $interestrate = 28;
                $intr = $interestrate;
            } elseif ($net_salary > 25000 && $net_salary <= 35000) {
                $interestrate = 22;
                $intr = $interestrate;
            } elseif ($net_salary > 35000 && $net_salary <= 50000) {
                $interestrate = 19;
                $intr = $interestrate;
            } elseif ($net_salary > 50000 && $net_salary <= 75000) {
                $interestrate = 16.5;
                $intr = $interestrate;
            } elseif ($net_salary > 75000 && $net_salary <= 100000) {
                $interestrate = 16.5;
                $intr = $interestrate;
            } elseif ($net_salary >= 100000) {
                $interestrate = 16.5;
                $intr = $interestrate;
            } else {
                $interestrate = 32;
                $intr = $interestrate;
            }

            $applicableFOIR = $exactnet_salary;

            $princ = 100000;
            $emicalc = round($princ * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($princ, $intr, $term);
            $loanPossible = ($emicalc > 0) ? ($applicableFOIR / $emicalc) : 0;
            $viewLoanAmt = round($loanPossible * 100000);
            $Loan_Amount_Eli = $viewLoanAmt;

            if ($city == 'Delhi' || $city == 'Faridabad' || $city == 'Noida' || $city == 'Gurgaon' || $city == 'Gaziabad') {
                if ($Loan_Amount_Eli > 1500000) {
                    $getloanamout = 1500000;
                } else {
                    $getloanamout = $Loan_Amount_Eli;
                }
            } else { //	other cities
                if ($Loan_Amount_Eli > 1500000) {
                    $getloanamout = 1500000;
                } else {
                    $getloanamout = $Loan_Amount_Eli;
                }
            }
			////////////////////////////////////////////////////////
			if($reqloanamount>0)
			{
				if($reqloanamount>$getloanamout)
				{
					$getloanamout=$getloanamout;
				}
				else
				{
					$getloanamout=$reqloanamount;
				}
			}
			else
			{
					$getloanamout=$getloanamout;
			}
			///////////////////////////////////////////////////////

            if ($getterm == 1) {
                $term = 12;
            } elseif ($getterm == 2) {
                $term = 24;
            } elseif ($getterm == 3) {
                $term = 36;
            } elseif ($getterm == 4) {
                $term = 48;
            }
            $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
        }
        $alac = 100000;
        $peremicalc = round($alac * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($alac, $intr, $term);

        if ($net_salary > 50000) {
            $interestrate = "21% - 32%";
        } else {
            $interestrate = "21% - 32%";
        }

        $proc_fee = "N.A";
		$emiperlac = round(100000 * ($interestrate/1200) / (1 - (pow(1/(1 + ($interestrate/1200)), $term))));

        $details['bank_code'] = "Fullerton India";
        $details['interest_rate'] = interestRateFormat($interestrate);
        $details['emi'] = $getemicalc;
        $details['emiperlac'] = $emiperlac;
        $details['tenure'] = $getterm;
        $details['loan_amount'] = round($getloanamout);
        $details['processing_fee'] = $proc_fee;
        $details['category'] = $category;
        return($details);
    }

    /**
     * Get Bank code,Interest Rate, EMI (per month),Tenure,Eligible Loan Amount,
     * Processing Fee for HDFC Bank Personal Loan
     * @param int $strnet_salary
     * @param string $company
     * @param int $category
     * @param date $DOB
     * @param int $clubbed_emi
     * @return array

     * @date 24/11/2016
     */
    function BajajFinservPL($strnet_salary, $company, $category, $DOB, $clubbed_emi, $reqtenure, $reqloanamount) {
        list($calterm, $calprint_term) = Calculate_Tenure($DOB, "5", "62");
		//for reqd tenure////////////////////////////////////////////////////////////////////////
		if($reqtenure>0)
		{
			if($reqtenure>$calprint_term)
			{
				$term = $calterm;
				$print_term = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$print_term = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$print_term = $calprint_term;
		}
		//for reqd tenure end////////////////////////////////////////////////////////////////////////
        $bflloansmt = round($strnet_salary * 10);
		////////////////////////////////////////////////////////
			if($reqloanamount>0)
			{
				if($reqloanamount>$bflloansmt)
				{
					$bflloansmt=$bflloansmt;
				}
				else
				{
					$bflloansmt=$reqloanamount;
				}
			}
			else
			{
					$bflloansmt=$bflloansmt;
			}
			///////////////////////////////////////////////////////
        $intr1 = 14.50;
        $intr2 = 15.50;
        $bflintr1 = $intr1;
        $bflintr2 = $intr2;
        $bflintrte = "$intr1% - $intr2%";
        $getemi1 = round($bflloansmt * ($bflintr1/1200) / (1 - (pow(1/(1 + ($bflintr1/1200)), $term))));//getController()->Common()->getEMI($bflloansmt, $bflintr1, $term);
        $getemi2 = round($bflloansmt * ($bflintr2/1200) / (1 - (pow(1/(1 + ($bflintr2/1200)), $term))));//getController()->Common()->getEMI($bflloansmt, $bflintr2, $term);
        $getemi = "Rs. " . $getemi1 . " - Rs. " . $getemi2;
        $getterm = $print_term;
        $proc_fee = "Upto 2%";
		$emiperlac = round(100000 * ($bflintrte/1200) / (1 - (pow(1/(1 + ($bflintrte/1200)), $term))));

        $details['bank_code'] = "Bajaj Finserv";
        $details['interest_rate'] = interestRateFormat($bflintrte);
        $details['emi'] = $getemi;
        $details['emiperlac'] = $emiperlac;
        $details['tenure'] = $getterm;
        $details['loan_amount'] = round($bflloansmt);
        $details['processing_fee'] = $proc_fee;
        $details['category'] = $category;
        return($details);
    }

    /**
     * Get Bank code,Interest Rate, EMI (per month),Tenure,Eligible Loan Amount,
     * Processing Fee for HDFC Bank Personal Loan
     * @param int $net_salary
     * @param int $clubbed_emi
     * @param string $company
     * @param string $category
     * @param datetime $DOB
     * @param int $Company_Type
     * @param string $Primary_Acc
     * @return array

     * @date 18/11/2016
     */
     function HdfcBankPL($net_salary, $clubbed_emi, $company, $category, $DOB, $Company_Type, $Primary_Acc, $reqtenure, $reqloanamount) {
        $exactnet_salary = $net_salary;
        $exactnet_salaryTO = $net_salary - $clubbed_emi;
        list($calterm, $calprint_term) = Calculate_Tenure($DOB, "5", "62");
		//for reqd tenure////////////////////////////////////////////////////////////////////////
		if($reqtenure>0)
		{
			if($reqtenure>$calprint_term)
			{
				$term = $calterm;
				$print_term = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$print_term = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$print_term = $calprint_term;
		}
		//for reqd tenure end////////////////////////////////////////////////////////////////////////
        $interestrate = '';
        $getemicalc = 0;
        $pro_fee = '';
        $getterm = 0;
        $getloanamout = 0;
        $crprecordcount = 0;
		$gtcropcomp="Select interest_rate_csa ,interest_rate_noncsa From  pl_company_hdfc Where (company_name like '%".$company."%' and status=1)";
		list($alreadyExist,$hdfcrowar)=Mainselectfunc($gtcropcomp,$array = array());

            if (count($hdfcrowar) > 0) {
                    $icicirow = array("interest_rate_csa" => $hdfcrowar["interest_rate_csa"], "interest_rate_noncsa" => $hdfcrowar["interest_rate_noncsa"]);
                    $crprecordcount = $icicirow["interest_rate_csa"];
                }
				else
			{
					$crprecordcount=0;
			}
        
            if ($crprecordcount > 0) {
                if ($Primary_Acc == "HDFC" || $Primary_Acc == "HDFC Bank" || $Primary_Acc == "hdfc") {
                    list($main, $gen) = explode('.', $icicirow["interest_rate_csa"]);
                    if ($gen == 00) {
                        $interestrate = $main . " ";
                    } else {
                        $interestrate = $icicirow["interest_rate_csa"] . " ";
                    }

                    $intr = $icicirow["interest_rate_csa"];
                } else {
                    list($main, $gen) = explode('.', $icicirow["interest_rate_noncsa"]);
                    if ($gen == 00) {
                        $interestrate = $main . "";
                    } else {
                        $interestrate = $icicirow["interest_rate_noncsa"];
                    }

                    $intr = $icicirow["interest_rate_noncsa"];
                }
                if ($term >= 12 && $term < 24) {
                    $Loan_Amount_Eli = $exactnet_salary * 5;
                    $getterm = 1;
                } elseif ($term >= 24 && $term < 36) {
                    $Loan_Amount_Eli = $exactnet_salary * 10;
                    $getterm = 2;
                } elseif ($term >= 36 && $term < 48) {
                    $Loan_Amount_Eli = $exactnet_salary * 14;
                    $getterm = 3;
                } elseif (($term >= 48 && $term < 60)) {
                    $Loan_Amount_Eli = $exactnet_salary * 16;
                    $getterm = 4;
                } elseif ($term == 60) {
                    $Loan_Amount_Eli = $exactnet_salary * 19;
                    $getterm = 5;
                } else {
                    $Loan_Amount_Eli = $exactnet_salary * 19;
                    $getterm = 5;
                }

                $getloanamout = $Loan_Amount_Eli;

                if ($getterm == 1) {
                    $term = 12;
                } elseif ($getterm == 2) {
                    $term = 24;
                } elseif ($getterm == 3) {
                    $term = 36;
                } elseif ($getterm == 4) {
                    $term = 48;
                } elseif ($getterm == 5) {
                    $term = 60;
                }
                $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                $pro_fee = "Rs. 1000 - 1.75%";
            } else {
                $getloanamout = 0;
                if ($category == "Super A" || $category == "SUPER A") {
                    if ($exactnet_salary <= 35000) {
                        $interestrate = "17.85";
                        $intr = 17.85;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 10;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 14;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 16;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 19;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 19;
                            $getterm = 5;
                        }


                        $getloanamout = $Loan_Amount_Eli;
                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }
                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary > 35000 && $exactnet_salary <= 50000) {
                        $interestrate = "15.75";
                        $intr = 15.75;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 6;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 10;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 16;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 16;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 20;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 20;
                            $getterm = 5;
                        }

                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }
                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary > 50000 && $exactnet_salary <= 75000) {
                        $interestrate = "15.75";
                        $intr = 15.75;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 12;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 16;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 21;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 21;
                            $getterm = 5;
                        }

                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }
                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary > 75000) {
                        $interestrate = "15.65";
                        $intr = 15.65;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 13;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 21;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 22;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 22;
                            $getterm = 5;
                        }

                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }
                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } else {
                        $interestrate = 0;
                        $int = 0;
                        $getloanamout = 0;
                    }
                }//SUPER A
                elseif ($category == "Cat A" || $category == "CAT A" || $category == "CSA A") {
                    if ($exactnet_salary <= 35000) {
                        $interestrate = "17.85";
                        $intr = 17.85;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 10;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 14;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 16;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 19;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 19;
                            $getterm = 5;
                        }

                        $getloanamout = $Loan_Amount_Eli;
                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }
                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary > 35000 && $exactnet_salary <= 50000) {
                        $interestrate = "15.85";
                        $intr = 15.85;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 6;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 10;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 14;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 17;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 20;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 20;
                            $getterm = 5;
                        }

                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }

                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary > 50000 && $exactnet_salary <= 75000) {
                        $interestrate = "15.75";
                        $intr = 15.75;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 11;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 15;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 20;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 20;
                            $getterm = 5;
                        }

                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }

                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary > 75000) {
                        $interestrate = "15.65";
                        $intr = 15.65;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 11;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 16;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 22;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 22;
                            $getterm = 5;
                        }

                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }

                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } else {
                        $interestrate = 0;
                        $int = 0;
                        $getloanamout = 0;
                    }
                }//CAT A CSA A
                elseif ($category == "CAT GB" || $category == "GOVT" || $Company_Type == 4 || $Company_Type == 5 || $Company_Type == 6) {
                    if ($exactnet_salary >= 75000) {
                        if (($company == "ALLAHABAD BANK" || $company == "ANDHRA BANK" || $company == "BANK OF BARODA" || $company == "BANK OF INDIA" || $company == "CANARA BANK" || $company == "CORPORATION BANK" || $company == "KARNATAKA BANK LTD" || $company == "PUNJAB NATIONAL BANK" || $company == "STATE BANK OF INDIA" || $company == "SYNDICATE BANK" || $company == "VIJAYA BANK" || $company == "UNION BANK OF INDIA")) {
                            $interestrate = "15.5";
                            $intr = 15.5;
                        } else {
                            $interestrate = "15.5";
                            $intr = 15.5;
                        }

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 10;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 15;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 17;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 19;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 19;
                            $getterm = 5;
                        }

                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }

                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } else {
                        $interestrate = 0;
                        $int = 0;
                        $getloanamout = 0;
                    }
                    if ($exactnet_salary >= 50000 && $exactnet_salary < 75000) {
                        if (($company == "ALLAHABAD BANK" || $company == "ANDHRA BANK" || $company == "BANK OF BARODA" || $company == "BANK OF INDIA" || $company == "CANARA BANK" || $company == "CORPORATION BANK" || $company == "KARNATAKA BANK LTD" || $company == "PUNJAB NATIONAL BANK" || $company == "STATE BANK OF INDIA" || $company == "SYNDICATE BANK" || $company == "VIJAYA BANK" || $company == "UNION BANK OF INDIA")) {
                            $interestrate = "15.5";
                            $intr = 15.5;
                        } else {
                            $interestrate = "15.5";
                            $intr = 15.5;
                        }

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 10;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 15;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 17;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 19;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 19;
                            $getterm = 5;
                        }

                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }

                        $getemicalc = round($getloanamout * ($intr1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary >= 35000 && $exactnet_salary < 50000) {
                        if (($company == "ALLAHABAD BANK" || $company == "ANDHRA BANK" || $company == "BANK OF BARODA" || $company == "BANK OF INDIA" || $company == "CANARA BANK" || $company == "CORPORATION BANK" || $company == "KARNATAKA BANK LTD" || $company == "PUNJAB NATIONAL BANK" || $company == "STATE BANK OF INDIA" || $company == "SYNDICATE BANK" || $company == "VIJAYA BANK" || $company == "UNION BANK OF INDIA")) {
                            $interestrate = "15.75";
                            $intr = 15.75;
                        } else {
                            $interestrate = "15.75";
                            $intr = 15.75;
                        }

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 13;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 15;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 5;
                        }

                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }

                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary < 35000) {
                        if (($company == "ALLAHABAD BANK" || $company == "ANDHRA BANK" || $company == "BANK OF BARODA" || $company == "BANK OF INDIA" || $company == "CANARA BANK" || $company == "CORPORATION BANK" || $company == "KARNATAKA BANK LTD" || $company == "PUNJAB NATIONAL BANK" || $company == "STATE BANK OF INDIA" || $company == "SYNDICATE BANK" || $company == "VIJAYA BANK" || $company == "UNION BANK OF INDIA") && $exactnet_salary >= 20000) {
                            $interestrate = "17.75";
                            $intr = 17.75;
                        } else {
                            $interestrate = "17.75";
                            $intr = 17.75;
                        }

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 13;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 15;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 5;
                        }
                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        }

                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } else {
                        $interestrate = 0;
                        $int = 0;
                        $getloanamout = 0;
                    }
                    if ($Primary_Acc == 'HDFC') {
                        $pro_fee = "2%";
                    } else {
                        $pro_fee = "2.5%";
                    }
                } elseif ($category == "CAT B" || $category == "CSA B") {
                    if ($exactnet_salary <= 35000) {
                        $interestrate = "17.85";
                        $intr = 17.85;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 13;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 15;
                            $getterm = 4;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 15;
                            $getterm = 4;
                        }

                        $getloanamout = $Loan_Amount_Eli;


                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        }
                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary > 35000 && $exactnet_salary <= 50000) {
                        $interestrate = "15.85";
                        $intr = 15.85;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 13;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 15;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 5;
                        }
                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        }

                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary > 50000 && $exactnet_salary <= 75000) {
                        $interestrate = "15.75";
                        $intr = 15.75;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 13;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 15;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 5;
                        }

                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        }

                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary > 75000) {
                        $interestrate = "15.65";
                        $intr = 15.65;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 13;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 15;
                            $getterm = 4;
                        } elseif ($term == 60) {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 5;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 18;
                            $getterm = 5;
                        }
                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        }

                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } else {
                        $interestrate = 0;
                        $int = 0;
                        $getloanamout = 0;
                    }
                } elseif ($category == "CAT C" || $category == "CSA C") {
                    if ($exactnet_salary >= 75000) {
                        $interestrate = "15.65";
                        $intr = 15.65;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 6;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 11;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 13;
                            $getterm = 4;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 13;
                            $getterm = 4;
                        }
                    } elseif ($exactnet_salary >= 50000 && ($exactnet_salary < 75000)) {
                        $interestrate = "15.75";
                        $intr = 15.75;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 11;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 13;
                            $getterm = 4;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 13;
                            $getterm = 4;
                        }
                    } elseif ($exactnet_salary >= 35000 && ($exactnet_salary < 50000)) {
                        $interestrate = "15.85";
                        $intr = 15.85;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 11;
                            $getterm = 4;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 11;
                            $getterm = 4;
                        }
                    } elseif ($exactnet_salary >= 25000 && ($exactnet_salary < 35000)) {
                        $interestrate = "17.85";
                        $intr = 17.85;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 3;
                        } elseif (($term >= 48 && $term < 60)) {
                            $Loan_Amount_Eli = $exactnet_salary * 11;
                            $getterm = 4;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 11;
                            $getterm = 4;
                        }
                    } else {
                        $interestrate = 0;
                        $int = 0;
                        $getloanamout = 0;
                    }

                    $getloanamout = $Loan_Amount_Eli;

                    if ($getterm == 1) {
                        $term = 12;
                    } elseif ($getterm == 2) {
                        $term = 24;
                    } elseif ($getterm == 3) {
                        $term = 36;
                    } elseif ($getterm == 4) {
                        $term = 48;
                    }

                    $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                }//CAT C
                elseif ($category == "Cat D" || $category == "CAT D" || $category == "CSA D") {
                    if ($exactnet_salary < 35000) {
                        $interestrate = "17.85";
                        $intr = 17.85;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 3;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 3;
                        }

                        $getloanamout = $Loan_Amount_Eli;
                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }
                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary >= 35000 && $exactnet_salary <= 50000) {
                        $interestrate = "15.85";
                        $intr = 15.85;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 3;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 3;
                        }

                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }

                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary > 50000 && $exactnet_salary <= 75000) {
                        $interestrate = "15.75";
                        $intr = 15.75;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 3;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 3;
                        }

                        $getloanamout = $Loan_Amount_Eli;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }

                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } elseif ($exactnet_salary > 75000) {
                        $interestrate = "15.65";
                        $intr = 15.65;

                        if ($term >= 12 && $term < 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term >= 24 && $term < 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 2;
                        } elseif ($term >= 36 && $term < 48) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 3;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 3;
                        }
                        $getloanamout = $Loan_Amount_Eli;
                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        } elseif ($getterm == 5) {
                            $term = 60;
                        }
                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    } else {
                        $interestrate = 0;
                        $int = 0;
                        $getloanamout = 0;
                    }
                } else {
                    if ($exactnet_salary >= 25000) {
                        $interestrate = "19.50";
                        $intr = 19.50;

                        if ($term == 12) {
                            $Loan_Amount_Eli = $exactnet_salary * 5;
                            $getterm = 1;
                        } elseif ($term == 24) {
                            $Loan_Amount_Eli = $exactnet_salary * 7;
                            $getterm = 2;
                        } elseif ($term == 36) {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 3;
                        } else {
                            $Loan_Amount_Eli = $exactnet_salary * 9;
                            $getterm = 3;
                        }
                        // ASK//
                        if ($Primary_Acc == 'HDFC') {
                            if ($Loan_Amount_Eli > 150000) {
                                $getloanamout = 150000;
                            } else {
                                $getloanamout = $Loan_Amount_Eli;
                            }
                            $pro_fee = "2%";
                        } else {
                            if ($Loan_Amount_Eli > 75000) {
                                $getloanamout = 75000;
                            } else {
                                $getloanamout = $Loan_Amount_Eli;
                            }
                            $pro_fee = "2.5%";
                        }
                    } else {
                        $getloanamout = 0;
                        $intr = 0;
                        $interestrate = 0;
                    }
                }
            } //special companies
			
			////////////////////////////////////////////////////////
			if($reqloanamount>0)
			{
				if($reqloanamount>$getloanamout)
				{
					$getloanamout=$getloanamout;
				}
				else
				{
					$getloanamout=$reqloanamount;
				}
			}
			else
			{
					$getloanamout=$getloanamout;
			}
			///////////////////////////////////////////////////////
            $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
			
            //for clause above 10lacs
            if (($category == "CAT A" || $category == "CAT B" || $category == "CAT C" || $category == "CAT D " || $category == "CAT GB" || $category == "CSA A" || $category == "CSA B" || $category == "CSA C" || $category == "CSA D" || $category == "GOVT" || $category == "Super A" || $Company_Type == 4 || $Company_Type == 5 || $Company_Type == 6)) {
                if ($getloanamout >= 1000000 && $exactnet_salary >= 75000) {
                    if ($getloanamout >= 2000000) {
                        $interestrate = "11.49";
                        $intr = 11.49;
                        $pro_fee = "Rs. 2999";
                    } elseif ($getloanamout >= 1500000 && $getloanamout < 2000000) {
                        $interestrate = "12.75";
                        $intr = 12.75;
                        $pro_fee = "Rs. 3999";
                    } elseif ($getloanamout >= 1000000 && $getloanamout < 1500000) {
                        $interestrate = "12.99";
                        $intr = 12.99;
                        $pro_fee = "Rs. 4999";
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }

                    if ($getterm == 1) {
                        $term = 12;
                    } elseif ($getterm == 2) {
                        $term = 24;
                    } elseif ($getterm == 3) {
                        $term = 36;
                    } elseif ($getterm == 4) {
                        $term = 48;
                    }

                    $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                    $spl_category = 1;
                } else {
                    $chkclause = 14.5 / 1200;
                    if ((($exactnet_salary >= 40000 && $exactnet_salary < 75000) && ($getloanamout >= 500000 && $getloanamout <= 1000000)) && ($category == "CAT B" || $category == "CAT A" || $category == "Super A" || $category == "CSA A" || $category == "CSA B" || $category == "CAT C" || $category == "CSA C") && $intr > $chkclause) {
                        $interestrate = "14.5";
                        $intr = 14.5;
                        $pro_fee = "0.8%";
                    } else {
                        $getloanamout = $getloanamout;

                        if ($getterm == 1) {
                            $term = 12;
                        } elseif ($getterm == 2) {
                            $term = 24;
                        } elseif ($getterm == 3) {
                            $term = 36;
                        } elseif ($getterm == 4) {
                            $term = 48;
                        }

                        $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
                        if ($Primary_Acc == 'HDFC') {
                            $pro_fee = "2%";
                        } else {
                            $pro_fee = "Rs. 999";
                        }
                    }
                }
            }
       
        if (($category == "CAT A" || $category == "CAT B" || $category == "CAT C" || $category == "CAT D " || $category == "CAT GB" || $category == "CSA A" || $category == "CSA B" || $category == "CSA C" || $category == "CSA D" || $category == "GOVT" || $category == "Super A") && $spl_category = "") {
            if ($exactnet_salary >= 50000) {
                $pro_fee = "0.80%";
            } else {
                $pro_fee = "Rs. 999";
            }
        }

        $alac = 100000;
        $peremicalc = round($alac * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($alac, $intr, $term);
        $tilldate = Date('Y-m-d');
        if ($tilldate <= '2016-08-16') {
            $pro_fee = "0% (Till 16th Aug*)";
        }
		$emiperlac = round(100000 * ($interestrate/1200) / (1 - (pow(1/(1 + ($interestrate/1200)), $term))));
        $details['bank_code'] = "HDFC Bank";
        $details['interest_rate'] = interestRateFormat($interestrate);
        $details['emi'] = $getemicalc;
        $details['emiperlac'] = $emiperlac;
        $details['tenure'] = $getterm;
        $details['loan_amount'] = round($getloanamout);
        $details['processing_fee'] = $pro_fee;
        $details['category'] = $category;
        return($details);
		}
	

    /**
     * Get Bank code,Interest Rate, EMI (per month),Tenure,Eligible Loan Amount,
     * Processing Fee for City Bank Personal Loan
     * @param int $net_salary
     * @param int $clubbed_emi
     * @param string $company
     * @param datetime $DOB
     * @param string $category
     * @return array
     * @date 18/11/2016
     */
    function CitibankPL($net_salary, $clubbed_emi, $company, $DOB, $category, $reqtenure, $reqloanamount) {
        $princ = "100000";
        list($calterm, $calprint_term) = Calculate_Tenure($DOB, "4", "62");
		//for reqd tenure////////////////////////////////////////////////////////////////////////
		if($reqtenure>0)
		{
			if($reqtenure>$calprint_term)
			{
				$term = $calterm;
				$print_term = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$print_term = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$print_term = $calprint_term;
		}
		//for reqd tenure end////////////////////////////////////////////////////////////////////////
        if ($term == 12) {
            $getterm = 1;
        } elseif ($term == 24) {
            $getterm = 2;
        } elseif ($term == 36) {
            $getterm = 3;
        } elseif ($term == 48) {
            $getterm = 4;
        } else {
            $getterm = 4;
        }

        if ($getterm == 1) {
            $term = 12;
        } elseif ($getterm == 2) {
            $term = 24;
        } elseif ($getterm == 3) {
            $term = 36;
        } elseif ($getterm == 4) {
            $term = 48;
        } elseif ($getterm == 5) {
            $term = 60;
        }

        // Calculate loan amount for CAT A
        if (strlen($category) > 0 && $getterm > 0) {
            if ($category == "CAT A") {
                if ($term <= 60 && $term >= 49) {
                    if ($net_salary > 83334) {
                        $interestrate = "14.75";
                        $intr = 14.75;
                        $proc_Fee = "0%";
                    } elseif ($net_salary > 41667 && $net_salary <= 83334) {
                        $interestrate = "15";
                        $intr = 15;
                        $proc_Fee = "0.50%";
                    } elseif ($net_salary <= 41667) {
                        $interestrate = "15";
                        $intr = 15;
                        $proc_Fee = "0.50%";
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($term <= 48 && $term >= 37) {
                    if ($net_salary > 83334) {
                        $interestrate = "14.25";
                        $intr = 14.25;
                        $proc_Fee = "0%";
                    } elseif ($net_salary > 41667 && $net_salary <= 83334) {
                        $interestrate = "14.50";
                        $intr = 14.50;
                        $proc_Fee = "0.25%";
                    } elseif ($net_salary <= 41667) {
                        $interestrate = "14.75";
                        $intr = 14.75;
                        $proc_Fee = "0.50%";
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($term <= 36 && $term >= 12) {
                    if ($net_salary > 83334) {
                        $interestrate = "14.25";
                        $intr = 14.25;
                        $proc_Fee = "0%";
                    } elseif ($net_salary > 41667 && $net_salary <= 83334) {
                        $interestrate = "14.50";
                        $intr = 14.50;
                        $proc_Fee = "0.25%";
                    } elseif ($net_salary <= 41667) {
                        $interestrate = "14.75";
                        $intr = 14.75;
                        $proc_Fee = "0.50%";
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                }
            }//CAT A
            if ($category == "CAT B") {
                if ($term <= 60 && $term >= 49) {
                    if ($net_salary > 83334) {
                        $interestrate = "15.25";
                        $intr = 15.25;
                        $proc_Fee = "0.25%";
                    } elseif ($net_salary > 41667 && $net_salary <= 83334) {
                        $interestrate = "15.35";
                        $intr = 15.35;
                        $proc_Fee = "0.50%";
                    } elseif ($net_salary <= 41667) {
                        $interestrate = "15.50";
                        $intr = 15.50;
                        $proc_Fee = "0.50%";
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($term <= 48 && $term >= 37) {
                    if ($net_salary > 83334) {
                        $interestrate = "14.85";
                        $intr = 14.85;
                        $proc_Fee = "0.25%";
                    } elseif ($net_salary > 41667 && $net_salary <= 83334) {
                        $interestrate = "15.25%";
                        $intr = 15.25;
                        $proc_Fee = "0.50%";
                    } elseif ($net_salary <= 41667) {
                        $interestrate = "15.35";
                        $intr = 15.35;
                        $proc_Fee = "0.50%";
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                } elseif ($term <= 36 && $term >= 12) {
                    if ($net_salary > 83334) {
                        $interestrate = "14.85";
                        $intr = 14.85;
                        $proc_Fee = "0.25%";
                    } elseif ($net_salary > 41667 && $net_salary <= 83334) {
                        $interestrate = "15.25%";
                        $intr = 15.25;
                        $proc_Fee = "0.50%";
                    } elseif ($net_salary <= 41667) {
                        $interestrate = "15.35";
                        $intr = 15.35;
                        $proc_Fee = "0.50%";
                    } else {
                        $interestrate = 0;
                        $intr = 0;
                    }
                }
            }//CAT B
            $emicalc = round($princ * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($princ, $intr, $term, 2);

            //calculate loan amout
            $firstnet_salary = ($net_salary * (60 / 100));
            $firstloanamount = ($emicalc > 0) ? (($firstnet_salary - $clubbed_emi) / $emicalc) : 0;
            $loanamount = round($firstloanamount * 100000);
			////////////////////////////////////////////////////////
			if($reqloanamount>0)
			{
				if($reqloanamount>$loanamount)
				{
					$loanamount=$loanamount;
				}
				else
				{
					$loanamount=$reqloanamount;
				}
			}
			else
			{
					$loanamount=$loanamount;
			}
			///////////////////////////////////////////////////////

            if (($category == "CAT A") && ($loanamount >= 500000) && ($net_salary > 100000)) {

                $interestrate = "13.50";
                $intr = 13.50;
                $proc_Fee = "0";
            }
        } else {
            
        }
        //clause

        if (strlen($category) > 0) {
            if ($loanamount > 2000000) {
                $getloanamout = "2000000";
            } else {
                $getloanamout = $loanamount;
            }
        } else {
            $getloanamout = 0;
        }

        if ($getloanamout > 0 && $intr > 0) {
            $getemicalc = round($getloanamout * ($intr/1200) / (1 - (pow(1/(1 + ($intr/1200)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
        } else {
            $getemicalc = 0;
            $interestrate = 0;
            $proc_Fee = 0;
        }

        $alac = 100000;

		$emiperlac = round(100000 * ($interestrate/1200) / (1 - (pow(1/(1 + ($interestrate/1200)), $term))));
        $details['bank_code'] = "Citibank";
        $details['interest_rate'] = interestRateFormat($interestrate);
        $details['emi'] = $getemicalc;
        $details['emiperlac'] = $emiperlac;
        $details['tenure'] = $getterm;
        $details['loan_amount'] = round($getloanamout);
        $details['processing_fee'] = $proc_Fee;
        $details['category'] = $category;
        return($details);
    }

//$monthlyIncome, $totalObligation, $companyName, PlCompanyCategory($companyName, "rblbank"), $age, $companyType, $primaryAcc, $reqtenure, $reqloanamount

function RBLBankPL($net_salary,$clubbed_emi,$company,$rblcategory,$DOB,$Company_Type,$Primary_Acc, $reqtenure, $reqloanamount)
	{
		 $net_salary= $net_salary - $clubbed_emi;
		 list($calterm, $calprint_term) = Calculate_Tenure($DOB, "5", "62");
		 if(strlen($rblcategory)>1)
		{
			 $category=$rblcategory;
		}
		else
		{
			$category=RBLcompanyCategorize($company);
		}
		 
		//foir for all
		//multiplier for pvt ltd
		//compay catgory wise rates
		//for reqd tenure////////////////////////////////////////////////////////////////////////
		if($reqtenure>0)
		{
			if($reqtenure>$calprint_term)
			{
				$term = $calterm;
				$print_term = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$print_term = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$print_term = $calprint_term;
		}
		if($term>0)
		{
			if($net_salary>35000)
			{
				if($print_term>60)
				{
					$term=60*12;
					$print_term=60;
				}
				else
				{
					$term=$print_term*12;
					$print_term=$print_term;
				}

			}
			else
			{
				if($print_term>48)
				{
					$term=48*12;
					$print_term=48;
				}
				else
				{
					$term=$print_term*12;
					$print_term=$print_term;
				}
			}
		}
		//for reqd tenure////////////////////////////////////////////////////////////////////////
		if($reqtenure>0)
		{
			$calterm=$term;
			$calprint_term=$print_term;
			if($reqtenure>$calprint_term)
			{
				$term = $calterm;
				$print_term = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$print_term = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$print_term = $calprint_term;
		}
		//end

		if($category=="CAT A")
		{
			if($net_salary>75000)
				{
					$interestrate = 14;
					$intr=$interestrate/1200;
					}
				elseif($net_salary>50000 && $net_salary<=75000)
				{
					$interestrate = 14.50;
					$intr=$interestrate/1200;
				}
				elseif($net_salary<=50000)
				{
					$interestrate = 15;
					$intr=$interestrate/1200;
				}
		}
		elseif($category=="CAT B")
		{
			if($net_salary>75000)
				{
					$interestrate = 14;
					$intr=$interestrate/1200;
					}
				elseif($net_salary>50000 && $net_salary<=75000)
				{
					$interestrate = 15;
					$intr=$interestrate/1200;
				}
				elseif($net_salary<=50000)
				{
					$interestrate = 15.50;
					$intr=$interestrate/1200;
				}
		}//CAT B
		elseif($category=="CAT C")
		{
			$Loan_Amount=$reqloanamount;
			if($Loan_Amount>=300000)
			{
			if($net_salary>75000)
				{
					$interestrate = 15;
					$intr=$interestrate/1200;
					}
				elseif($net_salary>50000 && $net_salary<=75000)
				{
					$interestrate = 15.50;
					$intr=$interestrate/1200;
				}
				elseif($net_salary<=50000)
				{
					$interestrate = 17;
					$intr=$interestrate/1200;
				}
			}
			else
			{
				if($net_salary>75000)
				{
					$interestrate = 15.50;
					$intr=$interestrate/1200;
					}
				elseif($net_salary>50000 && $net_salary<=75000)
				{
					$interestrate = 16;
					$intr=$interestrate/1200;
				}
				elseif($net_salary<=50000)
				{
					$interestrate = 17.50;
					$intr=$interestrate/1200;
				}
			}
		}//CAT C
		elseif($category=="CAT D")
		{
			$Loan_Amount=$reqloanamount;
			if($Loan_Amount>=300000)
			{
			if($net_salary>75000)
				{
					$interestrate = 16;
					$intr=$interestrate/1200;
					}
				elseif($net_salary>50000 && $net_salary<=75000)
				{
					$interestrate = 16.50;
					$intr=$interestrate/1200;
				}
				elseif($net_salary<=50000)
				{
					$interestrate = 19;
					$intr=$interestrate/1200;
				}
			}
			else
			{
				if($net_salary>75000)
				{
					$interestrate = 20;
					$intr=$interestrate/1200;
					}
				elseif($net_salary>50000 && $net_salary<=75000)
				{
					$interestrate = 17.50;
					$intr=$interestrate/1200;
				}
				elseif($net_salary<=50000)
				{
					$interestrate = 20;
					$intr=$interestrate/1200;
				}
			}
		}
		else
		{
			$Loan_Amount=$reqloanamount;
			if($Loan_Amount>=300000)
			{
			if($net_salary>75000)
				{
					$interestrate = 16;
					$intr=$interestrate/1200;
					}
				elseif($net_salary>50000 && $net_salary<=75000)
				{
					$interestrate = 16.50;
					$intr=$interestrate/1200;
				}
				elseif($net_salary<=50000)
				{
					$interestrate = 19;
					$intr=$interestrate/1200;
				}
			}
			else
			{
				if($net_salary>75000)
				{
					$interestrate = 20;
					$intr=$interestrate/1200;
					}
				elseif($net_salary>50000 && $net_salary<=75000)
				{
					$interestrate = 17.50;
					$intr=$interestrate/1200;
				}
				elseif($net_salary<=50000)
				{
					$interestrate = 20;
					$intr=$interestrate/1200;
				}
			}
		}
		//CAT D//rates

		//foir
		$princ=100000;
		$perlacemi=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));
				if($net_salary>=100000)
			{
				$firstnet_salary=($net_salary* (70/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
			}
		else if($net_salary>=50000 && $net_salary<100000)
			{
				$firstnet_salary=($net_salary* (65/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
			}
		else if($net_salary>35000 && $net_salary<50000)
			{
				$firstnet_salary=($net_salary* (60/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
			}
			else if($net_salary<=35000)
			{
				$firstnet_salary=($net_salary* (55/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
			}
			else
			{
				$firstnet_salary=($net_salary* (55/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
			} //foir end

			//multiplier for pvt. ltd companies only
			if($Company_Type==1)
			{
				if($net_salary>=100000)
				{
					if($term>=12 && $term<24)
					{
						$Loan_Amount_Eli=$exactnet_salary * 6;
					}
					elseif($term>=24 && $term<36)
					{
						$Loan_Amount_Eli=$exactnet_salary * 12;
					}
					elseif($term>=36 && $term<48)
					{
						$Loan_Amount_Eli=$exactnet_salary * 15;
					}
					elseif(($term>=48 && $term<60))
					{
						$Loan_Amount_Eli=$exactnet_salary * 18;
					}
					elseif($term==60)
					{
						$Loan_Amount_Eli=$exactnet_salary * 18;
					}
					else
					{
						$Loan_Amount_Eli=$exactnet_salary * 18;
					}
				}
				elseif($net_salary>50000 && $net_salary<100000)
				{
					if($term>=12 && $term<24)
					{
						$Loan_Amount_Eli=$exactnet_salary * 4;
					}
					elseif($term>=24 && $term<36)
					{
						$Loan_Amount_Eli=$exactnet_salary * 11;
					}
					elseif($term>=36 && $term<48)
					{
						$Loan_Amount_Eli=$exactnet_salary * 14;
					}
					elseif(($term>=48 && $term<60))
					{
						$Loan_Amount_Eli=$exactnet_salary * 15;

					}
					elseif($term==60)
					{
						$Loan_Amount_Eli=$exactnet_salary * 15;
					}
					else
					{
						$Loan_Amount_Eli=$exactnet_salary * 15;
					}
				}
				elseif($net_salary<50000)
				{
					if($term>=12 && $term<24)
					{
						$Loan_Amount_Eli=$exactnet_salary * 3;
					}
					elseif($term>=24 && $term<36)
					{
						$Loan_Amount_Eli=$exactnet_salary * 8;
					}
					elseif($term>=36 && $term<48)
					{
						$Loan_Amount_Eli=$exactnet_salary * 11;
					}
					elseif(($term>=48 && $term<60))
					{
						$Loan_Amount_Eli=$exactnet_salary * 13;
					}
					elseif($term==60)
					{
						$Loan_Amount_Eli=$exactnet_salary * 13;
					}
					else
					{
						$Loan_Amount_Eli=$exactnet_salary * 13;
					}
				}
					if($finalloanamount_dbr>1 && $Loan_Amount_Eli>1)
					{
						if($finalloanamount_dbr>$Loan_Amount_Eli)
						{
							$getloanamout = $Loan_Amount_Eli;
						}
						else
						{
							$getloanamout = $finalloanamount_dbr;	
						}
					}
					else
					{
						$getloanamout = $finalloanamount_dbr;
					}
				}
				else
				{
						$getloanamout = $finalloanamount_dbr;
				}
				
			if($reqloanamount>0)
					{
						if($reqloanamount>$getloanamout)
						{
							$getloanamout=$getloanamout;
						}
						else
						{
							$getloanamout=$reqloanamount;
						}
					}
					else
					{
						$getloanamout=$getloanamout;
					}
			
		if ($getloanamout > 0 && $intr > 0) {
            $getemicalc = round($getloanamout * ($intr) / (1 - (pow(1/(1 + ($intr)), $term))));//getController()->Common()->getEMI($getloanamout, $intr, $term);
        } else {
            $getemicalc = 0;
            $interestrate = 0;
            $proc_Fee = 0;
        }
$getterm=$print_term;
	$pro_fee="2%";
			 $details['bank_code'] = "RBL Bank";
			$details['interest_rate'] = interestRateFormat($interestrate);
			$details['emi'] = $getemicalc;
			$details['emiperlac'] = $emiperlac;
			$details['tenure'] = $getterm;
			$details['loan_amount'] = round($getloanamout);
			$details['processing_fee'] = $pro_fee;
			$details['category'] = $category;
			return($details);
	}//RBL

	/****************************************/
	/**IIFL func start***/
	/**************************************/
	function IIFLbankPL($net_salary,$clubbed_emi,$company,$category,$DOB,$Company_Type, $reqtenure, $reqloanamount)
	{
		 $net_salary= $net_salary - $clubbed_emi;
		list($calterm, $calprint_term) = Calculate_Tenure($DOB, "5", "60");

	if($category=="SUPER CAT A")
		{
			if($net_salary>65000)
				{
					$interestrate = 13;
					$intr=$interestrate/1200;
					}
				elseif($net_salary>50000 && $net_salary<=65000)
				{
					$interestrate = 13.50;
					$intr=$interestrate/1200;
				}
				elseif($net_salary>35000 && $net_salary<=50000)
				{
					$interestrate = 14;
					$intr=$interestrate/1200;
				}
				else
				{
					$interestrate = 0;
					$intr=0;
				}
				$proc_Fee="1%";

			}
		elseif($category=="CAT A" || $category=="CAT B")
		{
			if($net_salary>65000)
				{
					$interestrate = 13.50;
					$intr=$interestrate/1200;
				}
				elseif($net_salary>50000 && $net_salary<=65000)
				{
					$interestrate = 14;
					$intr=$interestrate/1200;
				}
				elseif($net_salary>35000 && $net_salary<=50000)
				{
					$interestrate = 14.50;
					$intr=$interestrate/1200;
				}
				else
				{
					$interestrate = 0;
					$intr=0;
				}
				$proc_Fee="1%";
				//tenure
				if($category=="CAT A")
				{
					if($calterm>48)
					{
						$calterm=48;
						$calprint_term=4;
					}
					else
					{
						$calterm=$calterm;
						$calprint_term=$calprint_term;
					}
				}
				if($category=="CAT B")
				{
					if($calterm>36)
					{
						$calterm=36;
						$calprint_term=3;
					}
					else
					{
						$calterm=$calterm;
						$calprint_term=$calprint_term;
					}
				}
		}//CAT B
		else
		{
			if($net_salary>65000)
				{
					$interestrate = 15;
					$intr=$interestrate/1200;
					}
				elseif($net_salary>50000 && $net_salary<=65000)
				{
					$interestrate = 15.50;
					$intr=$interestrate/1200;
				}
				elseif($net_salary>35000 && $net_salary<=50000)
				{
					$interestrate = 16;
					$intr=$interestrate/1200;
				}
				else
				{
					$interestrate = 16;
					$intr=$interestrate/1200;
				}
				$proc_Fee="1.50%";
				if($calterm>36)
					{
						$calterm=36;
						$calprint_term=3;
					}
					else
					{
						$calterm=$calterm;
						$calprint_term=$calprint_term;
					}
		}
		//non cat company
		$term=$calterm;
		$print_term=$calprint_term;
		
		if($reqtenure>0)
		{
			if($reqtenure>$calprint_term)
			{
				$term = $calterm;
				$print_term = $calprint_term;
			}
			else
			{
				$term = $reqtenure*12;
				$print_term = $reqtenure;
			}
		}
		else
		{
			$term = $calterm;
			$print_term = $calprint_term;
		}
		//foir
		$princ=100000;
		$perlacemi=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));

		if($category=="SUPER CAT A" || $category=="CAT A")
		{
				$firstnet_salary=($net_salary* (60/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
		}elseif($category=="CAT B")
		{
				$firstnet_salary=($net_salary* (55/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
		}
		else
		{
			$firstnet_salary=($net_salary* (50/100));
				$newnet_salary= $firstnet_salary;
				$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
		}//foir end
		
		if($category=="SUPER CAT A")
		{
			if($finalloanamount_dbr>2500000)
				{
					$getloanamout = 2500000;
				}
				else
				{
					$getloanamout = $finalloanamount_dbr;	
				}
		}
		elseif($category=="CAT A")
		{
			if($finalloanamount_dbr>2000000)
				{
					$getloanamout = 2000000;
				}
				else
				{
					$getloanamout = $finalloanamount_dbr;	
				}
		}
		else
		{
			if($finalloanamount_dbr>1500000)
				{
					$getloanamout = 1500000;
				}
				else
				{
					$getloanamout = $finalloanamount_dbr;	
				}
		}

		if($reqloanamount>0)
			{
				if($reqloanamount>$getloanamout)
				{
					$getloanamout=$getloanamout;
				}
				else
				{
					$getloanamout=$reqloanamount;
				}
			}
			else
			{
				$getloanamout=$getloanamout;
			}

		$getterm=$print_term;
		$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
			
			$details['bank_code'] = "IIFL";
			$details['interest_rate'] = interestRateFormat($interestrate);
			$details['emi'] = $getemicalc;
			$details['emiperlac'] = $emiperlac;
			$details['tenure'] = $getterm;
			$details['loan_amount'] = round($getloanamout);
			$details['processing_fee'] = $proc_Fee;
			$details['category'] = $category;
			return($details);
	}
	/***************IIFL Func END****************/
	
	
	/*************************
	****************/
	function RBLcompanyCategorize($company)
	{
		$getcompany='select icici_bank,Indusind,kotak,bajajfinserv,hdfc_bank,fullerton,standard_chartered from pl_company_list where company_name="'.$company.'"';
		list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
		$growcontr=count($grow)-1;
		//ICICI Bank	IndusInd Bank	Kotak Bank	Bajaj Finserv	HDFC Bank	Fullerton	SCB Bank
		$icici_bankcategory = $grow[$growcontr]["icici_bank"]; 
		$Indusind = $grow[$growcontr]["Indusind"];
		$kotakcomp = $grow[$growcontr]["kotak"];
		$bajajfinservcategory = $grow[$growcontr]["bajajfinserv"];
		$hdfccategory= $grow[$growcontr]["hdfc_bank"];
		$fullertoncategory= $grow[$growcontr]["fullerton"];
		$stanccategory = $grow[$growcontr]["standard_chartered"];
		$rblcategory="";

		if($icici_bankcategory=="CAT A" || $icici_bankcategory=="Elite" || $Indusind=="CAT A" || $kotakcomp=="CAT A"  || $bajajfinservcategory=="CAT A" || $hdfccategory=="CAT A" || $hdfccategory=="Super CAT A" || $hdfccategory=="Super A" || $fullertoncategory=="CAT A" || $fullertoncategory=="CSA A" || $fullertoncategory=="Super A" || $stanccategory=="CAT A" || $stanccategory=="CAT A+")
			{
				$rblcategory="CAT A";
			}
		elseif(($icici_bankcategory=="Super Prime" || $Indusind=="CAT B" || $kotakcomp=="CAT B" || $bajajfinservcategory=="CAT B" || $hdfccategory=="CAT B" || $hdfccategory=="Govt" || $fullertoncategory=="CAT B" || $stanccategory=="CAT B") && $rblcategory=="")
			{
			$rblcategory="CAT B";
			}
		elseif(($icici_bankcategory=="Preferred" || $Indusind=="CAT C" || $kotakcomp=="CAT C" || $bajajfinservcategory=="CAT C" || $hdfccategory=="CAT C" || $fullertoncategory=="CAT C" || $stanccategory=="CAT C") && $rblcategory=="")
			{
			$rblcategory="CAT D";
			}

		return($rblcategory);
	}
      /**
     * format interest rates
     * @param string $num
     * @return string

     * @date 07/12/2016
     */
     function interestRateFormat($num) {
        if (strpos($num, "-") !== false) {
            $numArr = explode("-", $num);
            
            $interestRateVal = ((string)number_format(floatval(trim($numArr[0])), 2)). "% - " . ((string)number_format(floatval(trim($numArr[1])), 2)). "%";
        } else {
            $numFormat = floatval(trim($num));
            $numFormat = number_format($numFormat, 2);
            $interestRateVal= (string)$numFormat. "%";
        }
        return $interestRateVal;
    }
?>

