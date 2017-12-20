<?php require 'scripts/db_init.php';
function getratesdob($DOB)
{
if ($DOB>=60)
	{
		$term = 0;
		$print_term = "0";
	}
	else if($DOB>58 && $DOB<=59)
		{
			$term = 12;
			$print_term = "1";
		}
		else if($DOB>57 && $DOB<=58)
		{
			$term = 24;
			$print_term = "2";
		}
	else if($DOB>56 && $DOB<=57)
		{
			$term = 36;
			$print_term = "3";
		}
	else if($DOB>55 && $DOB<=56)
		{
			$term = 48;
			$print_term = "4";
		}
	else if($DOB>50 && $DOB<=55)
		{
			$term = 60;
			$print_term = "5";
		}
else if($DOB>50 && $DOB<=55)
		{
			$term = 60;
			$print_term = "5";
		}
	else if($DOB>45 && $DOB<=50)
		{
			$term = 120;
			$print_term = "10";
		}
else if($DOB>40 && $DOB<=45)
		{
			$term = 180;
			$print_term = "15";
		}
	else if($DOB<=40)
		{
			$term = 240;
			$print_term = "20";
		}
		$getterm[]= $term;
		$getterm[]= $print_term;
		return($getterm);
}
list($hlrates)=bankrates("LIC Housing","3000000","30");
echo "rate : ".$hlrates."<br>";
function bankrates($bank_name,$loan_amount,$age)
{	
	list($term,$print_term)=getratesdob($age);
	//5,5-10,10-15,15-20
	if($term>240)
	{
		$tenure = 5; 
	}
	elseif($term>180 && $term<=240)
	{
		$tenure = 4;
	}
	elseif($term>120 && $term<=180)
	{
		$tenure = 3;
	}
	elseif($term>60 && $term<=120)
	{
		$tenure = 2; 
	}
	elseif($term<=60)
	{
		$tenure = 1;
	}

	if($loan_amount>75000000)
	{
		$loanreq = "above_75lacs";
	}
	elseif($loan_amount>3000000 && $loan_amount<=75000000)
	{
		$loanreq = "above_30lacs";
	}
	elseif($loan_amount>2000000 && $loan_amount<=3000000)
	{
		$loanreq = "upto_30lacs";
	}
	elseif($loan_amount<=2000000)
	{
		$loanreq = "upto_20lacs";
	}
	else
	{
		$loanreq = "upto_20lacs";
	}
	echo "<br><br>";
	$getrates = "Select ".$loanreq." as uptolimit from home_loan_interest_rate_chart Where (flag=1 and tenure=".$tenure." and bank_name like '".$bank_name."%')";
	echo "Select ".$loanreq." as uptolimit from home_loan_interest_rate_chart Where (flag=1 and tenure=".$tenure." and bank_name like '".$bank_name."%')";
	list($numRows,$hlratedt)=MainselectfuncNew($getrates,$array = array());
$HLrates_details[]= $hlratedt[0]['uptolimit'];
print_r($HLrates_details);
echo "<br><br>";
return($HLrates_details);
}

?>