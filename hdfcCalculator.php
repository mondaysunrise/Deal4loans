<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$sql = "select * from hdfc_pl_calc_leads where hdfcplid=702";
	//$query = ExecQuery($sql);
	 list($recordcount,$Myrow)=MainselectfuncNew($sql,$array = array());
		$h=0;
	$city= $Myrow[$h]['city'];
	$age = $Myrow[$h]['age'];
	$net_salary = $Myrow[$h]['net_salary'];
	$clubbed_emi = $Myrow[$h]['clubbed_emi'];
	$company_name = $Myrow[$h]['company_name'];
	
	$caqry='Select hdfc_category from hdfc_pl_company_list where (hdfc_company_name="'.$company_name.'")';
	//echo $qry."<br>";
	 list($recordcount,$carow)=MainselectfuncNew($caqry,$array = array());
		$cntr=0;
	
	//$caresult=ExecQuery($caqry);
	//$carow=mysql_fetch_array($caresult);
	$category=$carow[$cntr]["hdfc_category"];

	if($category=="" && ($company_cate_type==2 || $company_cate_type==3))
	{
		$category="CAT C";
		$virtualcat="CAT C";
	}
	else
	{
		$virtualcat="";
	}
	
	$hdfc_emi_amt =  $Myrow[$h]['pl_emi_amt'];
	$hdfc_loan_tenure = $Myrow[$h]['pl_tenure'];
	$availed_loan_amt = $Myrow[$h]['availed_loan_amt'];	
	$loan_amt_interest= $hdfc_emi_amt * $hdfc_loan_tenure;
	$hdfc_total_outstanding= $loan_amt_interest - $availed_loan_amt;
	
	$clubbed_emi = $Myrow[$h]['clubbed_emi'];	
	
	$DOB = $Myrow[$h]['DOB'];
	$company_type = $Myrow[$h]['company_type'];
	$primary_acc = $Myrow[$h]['primary_acc'];
	$company_cate_type = $Myrow[$h]['company_category'];
	
echo "<b>City:</b> ".$city."<br>";
echo "<b>Salary:</b> ".$net_salary."<br>";
echo "<b>Cate:</b> ".$category."<br>";
echo "<b>age:</b> ".$age."<br>";
echo "<b>Cmp Type: </b> ".$company_type."<br>";
echo "<b>Primary Acc:</b>  ".$primary_acc."<br>";
echo "<b>Cpany :</b>  ".$company_cate_type."<br>";
echo "<b>virtualcat :</b>  ".$virtualcat."<br>";
echo "<br>";
//echo "<b>Cpany :</b>  ".$company_cate_type."<br>";
//echo "<br>";
//echo "<b>Cpany :</b>  ".$company_cate_type."<br>";
//echo "<br>";
echo "h l T: ".$hdfc_loan_tenure;
echo "<br>";
echo "availed_loan_amt - ".$availed_loan_amt;
echo "<br>";
echo "hdfc_emi_amt - ".$hdfc_emi_amt;
echo "<br>";
echo "T EMI ".$clubbed_emi."<br>";
echo "<br>";
echo "O/s".$hdfc_total_outstanding;
echo "<br>";
echo "<br>";



list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Bsc_chck($city,$net_salary,$clubbed_emi,$category,$age,$company_type,$primary_acc,$company_cate_type,$hdfc_total_outstanding,$virtualcat);

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

function  HDFC_Bsc_chck($city,$net_salary,$clubbed_emi,$category,$DOB,$company_type,$primary_acc,$company_cate_type,$hdfc_total_outstanding,$virtualcat)
{
	$exactnet_salary= $net_salary;
list($term,$print_term)=getdob($DOB);

	$qry="Select hdfc_splid from hdfc_spl_city_rates where (hdfc_city='".$city."' and hdfc_net_salary<='".$net_salary."')";
	//$result=ExecQuery($qry);
	 list($recordcount,$getrow)=MainselectfuncNew($qry,$array = array());
		$m=0;
	//$recordcount = mysql_num_rows($result);
//	echo "<br>";
//	echo $qry;
//	echo "<br>";
	if($company_type=="BPO")
	{
		//echo "1<br>";
		if((($category=="Super A" || $category=="CAT A" || $category=="CAT B" || $category=="CSA A" || $category=="CSA B") && $net_salary>=30000) || (($category=="CAT C" || $category=="CSA C") && $net_salary>=20000 ))
		{   
			if($recordcount>0)
			{
				list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat);
			}
			else
			{
				list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding);
			}
		}
		else
		{
			$Feedback="";
		}
	}
	else if($company_type=="Insurance")
	{
		if($net_salary>=25000)
		{
			if($recordcount>0)
			{
				if(strlen($category)>0 && $virtualcat="")
				{
					list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat);
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
		if($city=="Delhi" || $city=="Gurgaon" || $city=="Noida" || $city=="Gaziabad" || $city=="Faridabad")
		{
			if($primary_acc=="HDFC Bank" || (strncmp ("HDFC", $primary_acc,4))==0)
			{
				//echo "3i<br>";
				if(($net_salary>=12000 && ($category=="Super A" || $category=="CAT A" || $category=="CAT B" || ($category=="CAT C" && $virtualcat=""))) || ($net_salary>=15000)) 
				{
					//echo "ex: ".$exactnet_salary."c: ".$category."t: ".$term;
					if($recordcount>0)
					{
						if(strlen($category)>0 && $virtualcat="")
						{
						list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat);
						}
						else
						{	list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
						}
					}
					else
					{
						list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
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
				if(($net_salary>=15000 && ($category=="Super A" || $category=="CAT A" || $category=="CAT B") || ($net_salary>=20000 && ($category=="CAT C" && $virtualcat="")) || ($net_salary>=25000))) 
				{
					if($recordcount>0)
					{
						if(strlen($category)>0 && $virtualcat="")
						{
							list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat);
						}
						else
						{
							list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
						}
					}
					else
					{
						list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
					}
	
				}
				else
				{
					$Feedback="";
					//$Feedback="Company CLAUSE Other without HDfC: NOT ELIGIBLE<br>";
				}
	
			}
		}
		else
		{
			if($primary_acc=="HDFC Bank" || (strncmp ("HDFC", $primary_acc,4))==0)
			{
				//echo "3i<br>";
				if(($net_salary>=12000 && ($city=="Mumbai" || $city=="Chennai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune"))	|| 	($net_salary>=10000 && ($city=="Cochin" || $city=="Kolkata" || $city=="Calcutta" || $city=="Ahmedabad")) ||		($net_salary>=8000 && ($city!="Cochin" && $city!="Kolkata" && $city!="Calcutta" && $city!="Ahmedabad" && $city!="Mumbai" && $city!="Delhi" && $city!="Chennai" && $city!="Hyderabad" && $city!="Bangalore" && $city!="Pune")))
				{
					//echo "ex: ".$exactnet_salary."c: ".$category."t: ".$term;
					if($recordcount>0)
					{
						if(strlen($category)>0 && $virtualcat="")
						{
						list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat);
						}
						else
						{	list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
						}
					}
					else
					{
						list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
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
				if(($net_salary>=15000 && ($city=="Mumbai" || $city=="Delhi" || $city=="Chennai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune")) || ($net_salary>=12000 && ($city=="Cochin" || $city=="Kolkata" || $city=="Calcutta" || $city=="Ahmedabad")) || ($net_salary>=10000 && ($city!="Cochin" && $city!="Kolkata" && $city!="Calcutta" && $city!="Ahmedabad" && $city!="Mumbai" && $city!="Delhi" && $city!="Chennai" && $city!="Hyderabad" && $city!="Bangalore" && $city!="Pune")))
				{
					if($recordcount>0)
					{
						if(strlen($category)>0 && $virtualcat="")
						{
							list($interestrate,$get_emi,$getterm,$getloanamout)=@Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat);
						}
						else
						{
							list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
						}
					}
					else
					{
						list($interestrate,$get_emi,$getterm,$getloanamout)=@HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc);
					}
	
				}
				else
				{
						$Feedback="";
						 //$Feedback="Company CLAUSE Other without HDfC: NOT ELIGIBLE<br>";
				}
			}
		}
	}

	$details[]= $interestrate;
	$details[]= $get_emi;
	$details[]= $getterm;
	$details[]= $getloanamout;
	if($getloanamout>=50000)
	{
		return($details);
	}
}


function  HDFC_Prsnlln($exactnet_salary,$category,$term,$company_cate_type,$clubbed_emi,$hdfc_total_outstanding,$primary_acc)
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

if($company_cate_type==2)
		{
			if($Loan_Amount_Eli>500000)
				{
				$getloanamout=500000;
				}
			else
				{
			$getloanamout=$Loan_Amount_Eli;
				}
		}
	else
		{
			if($primary_acc=="HDFC Bank")
			{
				if($Loan_Amount_Eli>150000)
				{
				$getloanamout=150000;
				}
			else
				{
				$getloanamout=$Loan_Amount_Eli;
				}
			}
			else
			{
				if($Loan_Amount_Eli>75000)
				{
				$getloanamout=75000;
				}
			else
				{
				$getloanamout=$Loan_Amount_Eli;
				}

			}
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
			/*if($Loan_Amount_Eli>150000)
				{
				$getloanamout=150000;
				}
			else
				{
				$getloanamout=$Loan_Amount_Eli;
				}
				*/
		if($company_cate_type==2)
		{
			if($Loan_Amount_Eli>500000)
				{
				$getloanamout=500000;
				}
			else
				{
			$getloanamout=$Loan_Amount_Eli;
				}
		}
		else
		{
			if($primary_acc=="HDFC Bank")
			{
				if($Loan_Amount_Eli>150000)
				{
				$getloanamout=150000;
				}
			else
				{
				$getloanamout=$Loan_Amount_Eli;
				}
			}
			else
			{
				if($Loan_Amount_Eli>75000)
				{
				$getloanamout=75000;
				}
			else
				{
				$getloanamout=$Loan_Amount_Eli;
				}

			}
		}
				//echo "NON-list: <br>";
				//echo $Loan_Amount_Eli."<br>";
				
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


function Major_cities($exactnet_salary,$category,$term,$clubbed_emi,$hdfc_total_outstanding,$virtualcat)
{
$exactnet_salary= $exactnet_salary-$clubbed_emi;

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

if($Loan_Amount_Eli>500000 && (strlen($virtualcat)>0))
	{
	$getloanamout=500000;
	}
	else if (($Loan_Amount_Eli>1500000 && ($virtualcat)==""))
	{
		$getloanamout=1500000;
	}
else
	{
	$getloanamout=$Loan_Amount_Eli;
	}
//echo "loan: ".$getloanamout."<br>";
//echo $intr."<br>";
//echo $term."<br>";
//echo $getterm."<br>";

	$get_emi=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));

$details[]= $interestrate;
	$details[]= $get_emi;
	$details[]= $getterm;
	$details[]= $getloanamout;
	return($details);

}


if($getloanamout>0)
{
?>

<table border="1">
<tr><td height="55" align="center" class="boldtxt" style="font-size:13px; line-height:28px;" > Loan Amount<br>
	    <span style="color:#b04c09; "><? echo "Rs ".number_format($getloanamout) ; ?></span></td>
		<td  width="1" align="left" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="59"></td>
		<td height="25" align="center" class="boldtxt" style="font-size:13px; line-height:28px;">Interest Rate<br>
		  <span style="color:#b04c09; "><? echo $interestrate; ?></span></td>
		<td  width="1" align="left" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="59"></td>
		<td height="25" align="center" class="boldtxt" style="font-size:13px; line-height:28px;">EMI (Per month)<br>
		  <span style="color:#b04c09; "><? echo "Rs ".$get_emi; ?></span></td>
		<td  width="1" align="left" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="59"></td>
		<td height="25" align="center" class="boldtxt" style="font-size:13px; line-height:28px;">Tenure<br>
		  <span style="color:#b04c09; "><? echo $getterm; ?> yrs</span></td>
	</tr>
    </table>
 <?php
 }
 else
 {
 	echo "Not Eligible";
 }
 ?>