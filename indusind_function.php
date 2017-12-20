<? 
require 'scripts/db_init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$net_salary = $_POST["Net_salary"];
$company = $_POST["Company_Name"];
$DOB = $_POST["age"];
$clubbed_emi = $_POST["emi_month"];

$getcompany='select Indusind from pl_company_list where company_name="'.$company.'"';
 //echo $getcompany;
 list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
$growcontr=count($grow)-1;
$Indusind = $grow[$growcontr]["Indusind"];

}

function getdob($DOB)
{
	if(($DOB>50 && $DOB<=53) || ($DOB<50 && $DOB>=18))
		{
			$term = 84;
			$print_term = "7";
		}
	else if(($DOB>50 && $DOB<=54))
		{
			$term = 72;
			$print_term = "6";
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

function indusindbank($net_salary,$company,$category,$DOB,$clubbed_emi)
{
	 
	list($term,$print_term)=getdob($DOB);
	
	if($category=="A+" || $category=="CAT A")
		{
			if($net_salary>150000)
			{
				$interestrate = "14.75%";
				$intr=14.75/1200;
			}
			else if($net_salary>100000 && $net_salary<=150000)
			{
				$interestrate = "15.25%";
				$intr=15.25/1200;
			}
			else if($net_salary>40000 && $net_salary<=100000)
			{
				$interestrate = "15.75%";
				$intr=15.75/1200;
			}
			else if($net_salary>=25000 && $net_salary<=40000)
			{
				$interestrate = "16.50%";
				$intr=16.50/1200;
			}
			else
			{	}
			if($term==12)
			{
				$getterm=1;
			}
			elseif($term==24)
			{
				$getterm=2;
			}
			elseif($term==36)
			{
				$getterm=3;
			}
			elseif($term==48)
			{
				$getterm=4;
			}
			elseif($term==60)
			{
				$getterm=5;
			}
			else
			{
				$getterm=5;
			}

		}
		else if($category=="CAT G" || $category=="CAT B" || $category=="C1000")
		{
			if($net_salary>150000)
			{
				$interestrate = "15%";
				$intr=15/1200;
			}
			else if($net_salary>100000 && $net_salary<=150000)
			{
				$interestrate = "15.50%";
				$intr=15.50/1200;
			}
			else if($net_salary>40000 && $net_salary<=100000)
			{
				$interestrate = "16%";
				$intr=16/1200;
			}
			else if($net_salary>=25000 && $net_salary<=40000)
			{
				$interestrate = "16.50%";
				$intr=16.50/1200;
			}
			else
			{			}
				if($term==12)
				{
					$getterm=1;
				}
				elseif($term==24)
				{
					$getterm=2;
				}
				elseif($term==36)
				{
					$getterm=3;
				}
				elseif($term==48)
				{
					$getterm=4;
				}
				else
					{
					$getterm=4;
					}
		}
		else if($category=="CAT C")
		{
			if($net_salary>150000)
			{
				$interestrate = "15.25%";
				$intr=15.25/1200;
			}
			else if($net_salary>100000 && $net_salary<=150000)
			{
				$interestrate = "15.75%";
				$intr=15.75/1200;
			}
			else if($net_salary>40000 && $net_salary<=100000)
			{
				$interestrate = "16.50%";
				$intr=16.50/1200;
			}
			else if($net_salary=40000)
			{
				$interestrate = "16.50%";
				$intr=16.50/1200;
			}
			else
			{
			}
				if($term==12)
				{
					$getterm=1;
				}
				elseif($term==24)
				{
					$getterm=2;
				}
				elseif($term==36)
				{
					$getterm=3;
				}
				elseif($term==48)
				{
					$getterm=4;
				}
				else
					{
					$getterm=4;
					}
			}


if($getterm==1)	{$term=12;}	elseif($getterm==2)	{$term=24;}	elseif($getterm==3){$term=36;}elseif($getterm==4){	$term=48;}elseif($getterm==5){	$term=60;}
		
$princ=100000;

	$perlacemi=round($princ * $intr / (1 - (pow(1/(1 + $intr), $term))));
	//echo $perlacemi."<br>";
//Calculate Loan Amount
	if($net_salary<=50000)
		{
			$firstnet_salary=($net_salary* (50/100));
			$newnet_salary= $firstnet_salary - $clubbed_emi;
			$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
		}
	else if($net_salary>50000 && $net_salary<=75000)
		{
			$firstnet_salary=($net_salary* (60/100));
			$newnet_salary= $firstnet_salary - $clubbed_emi;
			$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
		}
		else if($net_salary>75000)
		{
			$firstnet_salary=($net_salary* (70/100));
			$newnet_salary= $firstnet_salary - $clubbed_emi;
			$finalloanamount_dbr=$newnet_salary/$perlacemi * 100000;
		}
	else
	{}
	//other eiligibility
$finalloanamount_other=$net_salary*10;
	
	if($finalloanamount_other<$finalloanamount_dbr)
	{
		$finalloanamount=$finalloanamount_other;
	}
	else
	{
		$finalloanamount=$finalloanamount_dbr;
	}
		if($finalloanamount>1500000)
			{
				$getloanamout=1500000;
			}
			else
			{
				$getloanamout=$finalloanamount;
			}

$getemicalc=round($getloanamout * $intr / (1 - (pow(1/(1 + $intr), $term))));
$details[]=$interestrate;
	$details[]=round($getloanamout);
	$details[]=$getemicalc;
	$details[]=$getterm;
	$details[]=$perlacemi;

	return($details);

}//IndusiNd BANK

?>
<html>
<head>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<style type="text/css">
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
	
	form{
		display:inline;
	}
</style>
</head>
<body>
<?
if($recordcount>0 && strlen($Indusind)>1)
{
list($indusindrate,$indusindloanamt,$indusindemi,$indusindterm,$indusindperlacemi)=@indusindbank($net_salary,$company,$Indusind,$DOB,$clubbed_emi);

if($indusindloanamt>0 && $indusindemi>0)
	{
	}
	else
	{
		echo "company Not listed";
	}
}

if(strlen($net_salary)>1 && strlen($company)>1 && strlen($DOB)>1 && strlen($Indusind)>1 && $indusindloanamt>0)
{
?>
<table border="1" cellpadding="10" cellspacing="0" align="center">
<tr><td colspan="4" align="center">Indus bank Calculation</td></tr>
<tr>
<td align="center">Loan Amount</td><td align="center">Inter rate</td><td align="center">EMI</td><td align="center">Tenure</td ></tr>
<tr>
<td align="center"><? echo $indusindloanamt; ?></td><td align="center"><? echo $indusindrate; ?></td><td align="center"><? echo $indusindemi; ?></td><td align="center"><? echo $indusindterm." yrs"; ?></td></tr>
</table>
<? }
else
{
	if(strlen($net_salary)>1 && strlen($company)>1 && strlen($DOB)>1)
	{
		echo "<div align='center'>company Not listed</div>";
	}
	
?>
<table align="center" cellpadding="5" cellspacing="5" width="900" height="688">
<tr><td height="87" valign="top"><img src="http://www.deal4loans.com/emailer/images/d4l-logo-pl.jpg"></td>
</tr>
<tr><td valign="top">
<form name="indusind_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>">
<table align="center" cellpadding="0" cellspacing="15" style="border:1px solid #000000;">
<tr>
<td colspan="2" align="center">IndusInd Bank</td>
</tr>
<tr>
<td>Company Name</td>
<td> <input name="Company_Name" id="Company_Name" type="text"  style="width:180px;"  onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event, 'http://www.deal4loans.com/ajax-list-plcompanies.php')" /></td>
</tr>
<tr>
<td>Net Salary (per month)</td>
<td><input type="text" name="Net_salary" id="Net_salary"></td>
</tr>
<tr>
<td>Total Obligation (per month)</td>
<td><input type="text" name="emi_month" id="emi_month"></td>
</tr>
<tr>
<td>Age</td>
<td><input type="text" name="age" id="age"></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Get Quote"></td>
</tr>
</table>
</form>
</td></tr></table>
<? } ?>
</body>
</html>