<?php
	require 'scripts/db_init.php';
	


if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
	$Company_Name = $_POST["Company_Name"];
	$city = $_POST["City"];
	$company_type = $_POST["company_type"];
	$salary = $_POST["net_salary"];
	$primary_acc = $_POST["primary_acc"];
	$age = $_POST["age"];
	$clubbed_emi = $_POST["clubbed_emi"];
	$company_cate_type = $_POST["company_cate_type"];
	$no_of_loans = $_POST["no_of_loans"];
	$availed_loan_amt = $_POST["availed_loan_amt"];
	$hdfc_loan_tenure = $_POST["hdfc_loan_tenure"];
	$hdfc_emi_amt = $_POST["hdfc_emi_amt"];
	$no_emi_paid = $_POST["no_emi_paid"];

//HDFC OUtStanding
$loan_amt_interest= $hdfc_emi_amt * $hdfc_loan_tenure;

$hdfc_total_outstanding= $loan_amt_interest - $availed_loan_amt;

if($hdfc_emi_amt>0)
		{
$clubbed_emi = $clubbed_emi - $hdfc_emi_amt;
		}

$caqry='Select hdfc_category from hdfc_pl_company_list where (hdfc_company_name="'.$Company_Name.'")';
	//echo $qry."<br>";
 list($recordcount,$carow)=MainselectfuncNew($caqry,$array = array());
		$cntr=0;

	//$caresult=ExecQuery($caqry);
//$carow=mysql_fetch_array($caresult);

$category=$carow[$cntr]["hdfc_category"];
/*echo "<b>City:</b> ".$city."<br>";
echo "<b>Salary:</b> ".$net_salary."<br>";
echo "<b>Cate:</b> ".$category."<br>";
echo "<b>age:</b> ".$age."<br>";
echo "<b>Cmp Type: </b> ".$company_type."<br>";
echo "<b>Primary Acc:</b>  ".$primary_acc."<br>";
echo "<b>Cpany :</b>  ".$company_cate_type."<br>";
echo "<br>";
echo "h l T: ".$hdfc_loan_tenure;
echo "<br>";
echo $availed_loan_amt;
echo "<br>";
echo $hdfc_emi_amt;
echo "<br>";
echo "T EMI ".$clubbed_emi."<br>";
echo "<br>";
echo "O/s".$hdfc_total_outstanding;*/

if($age<21 || $age>59 )
		{
			echo "Not Eligible bcoz of Age issue<br>";
		}
		else if ($no_of_loans>3)
		{
			echo "Not Eligible bcoz more than 3 loans r running<br>";
		}
		else if($no_emi_paid<2)
		{
			echo "Not Eligible bcoz Less EMi paid in HDFC pl<br>";
		}
		else
		{
			if($category=="" && $primary_acc=="HDFC Bank" && ($company_cate_type==2 || $company_cate_type==1))
			{
				$category="CAT C";
			}
			HDFC_Bsc_chck($city,$net_salary,$clubbed_emi,$category,$age,$company_type,$primary_acc,$company_cate_type,$hdfc_total_outstanding);
		}
		
	}	
function getdob($DOB)
{
	if(($DOB>50 && $DOB<=53) || ($DOB<50 && $DOB>=18))
		{
			$term = 60;
			$print_term = "5";
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

Function  HDFC_Bsc_chck($city,$net_salary,$clubbed_emi,$category,$DOB,$company_type,$primary_acc,$company_cate_type,$hdfc_total_outstanding)
{
	$exactnet_salary= $net_salary;
list($term,$print_term)=getdob($DOB);

	$qry="Select hdfc_splid from hdfc_spl_city_rates where (hdfc_city='".$city."' and hdfc_net_salary<='".$net_salary."')";
	 list($recordcount,$getrow)=MainselectfuncNew($qry,$array = array());
		$cntr=0;
	
	//$result=ExecQuery($qry);
	//$recordcount = mysql_num_rows($result);
	//echo $qry;
	//echo "<br>";
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
			echo "<br>Company CLAUSE BPO: NOT ELIGIBLE<br>";
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
		{
				echo "<br>Company CLAUSE Insurance: NOT ELIGIBLE<br>";
		}
	}
	else
	{

		if($primary_acc=="HDFC Bank" || (strncmp ("HDFC", $primary_acc,4))==0)
		{
			//echo "3i<br>";
			if(($net_salary>=12000 && ($city=="Mumbai" || $city=="Delhi" || $city=="Chennai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune")) 
			|| 
			($net_salary>=10000 && ($city=="Cochin" || $city=="Kolkata" || $city=="Calcutta" || $city=="Ahmedabad"))
			||
			($net_salary>=8000 && ($city!="Cochin" || $city!="Kolkata" || $city!="Calcutta" || $city!="Ahmedabad" || $city!="Mumbai" || $city!="Delhi" || $city!="Chennai" || $city!="Hyderabad" || $city!="Bangalore" || $city!="Pune")))
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
				echo "<br>Company CLAUSE Other with AccHDfC: NOT ELIGIBLE<br>";
			}
			
		}
		else
		{
			//echo "3j<br>";
			if(($net_salary>=15000 && ($city=="Mumbai" || $city=="Delhi" || $city=="Chennai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune")) 
			|| 
			($net_salary>=12000 && ($city=="Cochin" || $city=="Kolkata" || $city=="Calcutta" || $city=="Ahmedabad"))
			||
			($net_salary>=10000 && ($city!="Cochin" || $city!="Kolkata" || $city!="Calcutta" || $city!="Ahmedabad" || $city!="Mumbai" || $city!="Delhi" || $city!="Chennai" || $city!="Hyderabad" || $city!="Bangalore" || $city!="Pune")))
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
					echo "<br>Company CLAUSE Other widout HDfC: NOT ELIGIBLE<br>";
			}

		}
	}
?>
<table cellpadding="2" border="1">
	<tr>
		<td>Loan Amount</td>
		<td>Inter rate</td>
		<td>EMI (Per month)</td>
		<td>Tenure</td>
	</tr>
	<tr>
		<td><? echo $getloanamout ; ?></td>
		<td><? echo $interestrate; ?></td>
		<td><? echo $get_emi; ?></td>
		<td><? echo $getterm; ?></td>
	</tr>
</table>
	
<? }


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


echo "loan: ".$getloanamout."<br>";
echo $intr."<br>";
echo $term."<br>";
echo $getterm."<br>";

	$get_emi=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
echo $get_emi."<br>";
$details[]= $interestrate;
	$details[]= $get_emi;
	$details[]= $getterm;
	$details[]= $getloanamout;
	return($details);

}


?>