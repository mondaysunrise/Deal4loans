<?php
function hdbfcLoans ($company_name, $net_salary, $account_holder,$age,$other_emi,$Loan_Amount)
{
	$princ = 100000;

	//echo "<br>".$company_name."--".$net_salary."--". $account_holder."--".$age."--".$other_emi."--".$Loan_Amount."<br>";
	//check Company list
	$checkCompanySql = "select * from hdbfc_companylist where company_name = '".$company_name."' and status=1";
	$checkCompanyQuery = ExecQuery($checkCompanySql);
	$category = mysql_result($checkCompanyQuery,0,'category');
	//echo "<br>".$checkCompanySql;
	//echo "<br>".$category;
	list($term,$print_term)=getdob($age);
	//echo "<br>".$term."---".$print_term;
	
	if($category=="Cat A")
	{
		if($net_salary>=75000)
		{
			$interestrate = "16%";
			$intr=16/1200;
			$Processing_Fee = "1 %";
		}
		else if($net_salary>=50000 && $net_salary<75000 )
		{
			$interestrate = "17%";
			$intr=17/1200;
			$Processing_Fee = "1.5 %";
		}
		else if($net_salary>=35000 && $net_salary<50000 )
		{
			$interestrate = "17%";
			$intr=17/1200;
			$Processing_Fee = "2 %";
		}
		else if($net_salary>=25000 && $net_salary<35000 )
		{
			$interestrate = "18%";
			$intr=18/1200;
			$Processing_Fee = "2 %";
		}		
		else if($net_salary>=20000 && $net_salary<25000)
		{
			$interestrate = "18%";
			$intr=18/1200;
			$Processing_Fee = "2 %";
		}		
		else
		{
			$intr="";
		}
	}
	else if($category=="Cat B")
	{
		if($term==60) { $term=48; $print_term = "4";  }
		
		if($net_salary>=75000)
		{
			$interestrate = "16%";
			$intr=16/1200;
			$Processing_Fee = "1 %";
		}
		else if($net_salary>=50000 && $net_salary<75000 )
		{
			$interestrate = "17%";
			$intr=17/1200;
			$Processing_Fee = "1.5 %";
		}
		else if($net_salary>=35000 && $net_salary<50000 )
		{
			$interestrate = "17%";
			$intr=17/1200;
			$Processing_Fee = "2 %";
		}
		else if($net_salary>=25000 && $net_salary<35000 )
		{
			$interestrate = "18%";
			$intr=18/1200;
			$Processing_Fee = "2 %";
		}		
		else if($net_salary>=20000 && $net_salary<25000)
		{
			$interestrate = "18%";
			$intr=18/1200;
			$Processing_Fee = "2 %";
		}		
		else
		{
			$intr="";
		}
	}
	else if($category=="Cat C" || $category=="")
	{
		if($term==60) { $term=36; $print_term = "3";  }
		if($term==48) { $term=36; $print_term = "3";  }
	
		
		if($net_salary>=75000)
		{
			$interestrate = "17%";
			$intr=17/1200;
			$Processing_Fee = "1 %";
		}
		else if($net_salary>=50000 && $net_salary<75000 )
		{
			$interestrate = "18%";
			$intr=18/1200;
			$Processing_Fee = "1.5 %";
		}
		else if($net_salary>=35000 && $net_salary<50000 )
		{
			$interestrate = "18%";
			$intr=18/1200;
			$Processing_Fee = "2 %";
		}
		else if($net_salary>=25000 && $net_salary<35000 )
		{
			$interestrate = "21%";
			$intr=21/1200;
			$Processing_Fee = "2 %";
		}		
		else if($net_salary>=20000 && $net_salary<25000)
		{
			$interestrate = "21%";
			$intr=21/1200;
			$Processing_Fee = "2 %";
		}		
		else
		{
			$intr="";
		}
	}
	else
	{
		$intr="";
		$princ = 0;
	}
	
	
	$emicalc = round(($princ * $intr / (1 - (pow(1/(1 + $intr), $term)))),2);
	//echo "<br>".$term."- emicalc: ".$emicalc."<br>";
	if($category=="Cat A")
	{
	//echo "<br>net_salary: ".$net_salary."<br>";
		if($net_salary>25000)
		{
			//echo "-1-1-";
			if($term==60) { $multiplier = 18; } else if($term==48) { $multiplier = 15; } else if($term==36) { $multiplier = 13; } else if($term==24) {	$multiplier = 9; } else if($term==12) {	$multiplier = 5;}
		///	echo "<br>Term: ".$term."<br>";
		//	echo "<br>net_salary: ".$net_salary."<br>";
		//	echo "<br>other_emi: ".$other_emi."<br>";
			//echo "<br>multiplier: ".$multiplier."<br>";
			$firstnet_salary =(($net_salary - $other_emi) * $multiplier);
			//$firstloanamount=($firstnet_salary)/$emicalc;
			$firstloanamount= $firstnet_salary;
		//echo "<br>firstnet_salary: ".$firstnet_salary."<br>";
		//	echo "<br>firstloanamount: ".$firstloanamount."<br>";
	
		}
		else
		{
			//echo "-3-3-";
			if($term==60) { $multiplier = 15; } else if($term==48) { $multiplier = 13; } else if($term==36) { $multiplier = 11; } else if($term==24) {	$multiplier = 9; } else if($term==12) { $multiplier = 5;	}
			
			$firstnet_salary=(($net_salary - $other_emi) * $multiplier);
			//$firstloanamount=($firstnet_salary)/$emicalc;
			$firstloanamount= $firstnet_salary;
		}

		$firstloan_amount = $firstloanamount; 
	//	echo "<br>firstnet_salary: ".$firstnet_salary."<br>";
	//	echo "<br>firstloanamount: ".$firstloanamount."<br>";
	
		if($Loan_Amount>1500000 )
		{
			if($firstloan_amount>1500000)
			{
				$finalLoanAmount = 1500000;		
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 15;
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
		else
		{
			if($firstloan_amount>1500000)
			{
				$finalLoanAmount = 1500000;		
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 15;
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}

	}
	else if($category=="Cat B")
	{
		
		if($net_salary>25000)
		{
			//echo "-1-1-";
			if($term==48) { $multiplier = 13; } else if($term==36) { $multiplier = 11; } else if($term==24) {	$multiplier = 9; } else if($term==12) {	$multiplier = 5;}
			
			$firstnet_salary=(($net_salary - $other_emi) * $multiplier);
			//$firstloanamount=($firstnet_salary)/$emicalc;
			$firstloanamount= $firstnet_salary;
		}
		else
		{
			//echo "-3-3-";
			if($term==48) { $multiplier = 13; } else if($term==36) { $multiplier = 11; } else if($term==24) {	$multiplier = 9; } else if($term==12) {	$multiplier = 5;}			
			$firstnet_salary=(($net_salary - $other_emi) * $multiplier);
			//$firstloanamount=($firstnet_salary)/$emicalc;
			$firstloanamount= $firstnet_salary;
		}

		
		$firstloan_amount = $firstloanamount; 
		if($Loan_Amount>1500000)
		{
			if($firstloan_amount>1500000)
			{
				
				$finalLoanAmount = 1500000;
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 10;		
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
		else
		{
			if($firstloan_amount>1500000)
			{
				$finalLoanAmount = 1500000;		
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 10;
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
	
	}
	else if($category=="Cat C" || $category=="")
	{
//	echo $net_salary;
	//	echo "<br>";
		if($term==36) { $multiplier = 9; } else if($term==24) {	$multiplier = 7; } else if($term==12) { $multiplier = 5;	}
			
		$firstnet_salary=(($net_salary - $other_emi) * $multiplier);
		//$firstloanamount=($firstnet_salary)/$emicalc;
		$firstloanamount= $firstnet_salary;
		
		$firstloan_amount = $firstloanamount; 
		if($Loan_Amount>1500000)
		{
			if($firstloan_amount>1500000)
			{
				$finalLoanAmount = 1500000;
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 7;		
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
		else
		{
			if($firstloan_amount>1500000)
			{
				$finalLoanAmount = 1500000;		
				$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
				//$finalLoanAmount = 7;
			}
			else
			{
				$finalLoanAmount = $firstloan_amount;
			}
		}
	}
	else
	{
		$finalLoanAmount = 0;
	}
		
		//echo "<br><b>".$interestrate."---".$firstloan_amount."---".$finalLoanAmount."---".$intr."------".$term."</b><br>";
		$emicalc=round($finalLoanAmount * $intr / (1 - (pow(1/(1 + $intr), $term))));
	//echo "<br>firstnet_salary: ".$firstnet_salary."<br>";
		//echo "<br>firstloanamount: ".$firstloanamount."<br>";
	
	$details[]=$interestrate;
	$details[]=$finalLoanAmount;
	$details[]=$emicalc;
	$details[]=$term;
	$details[]=$Processing_Fee;
//print_r($details);

	return($details);

}

function getdob($DOB)
{
	if(($DOB>50 && $DOB<=53) || ($DOB<50 && $DOB>=18))
		{
			$term = 60;
			$print_term = "5";
			//$term = 48;
			//$print_term = "4";
		}
		else if(($DOB>50 && $DOB<=54))
		{
			$term = 60;
			$print_term = "5";
		}
		else if(($DOB>50 && $DOB<=55))
		{
			$term = 60;
			$print_term = "5";
		}
		
		else if($DOB>55 && $DOB<=56)
		{
			$term = 48;
			$print_term = "4";
		}
		else if($DOB>56 && $DOB<=57)
		{
			$term = 36;
			$print_term = "3";
		}
		else if($DOB>57 && $DOB<=58)
		{
			$term = 24;
			$print_term = "2";
		}
		else if($DOB>58 && $DOB<=59)
		{
			$term = 12;
			$print_term = "1";
		}
		else if ($DOB>=60)
		{
			$term = 0;
			$print_term = "0";
		}
		$getterm[]= $term;
		$getterm[]= $print_term;
		return($getterm);
}
?>