<?php require 'scripts/db_init.php';
require 'eligiblebidderfuncPL.php';
require 'scripts/personal_loan_eligibility_function_form.php';
require 'scripts/pl_interest_rate_view.php';

$plcustid = $_REQUEST["plcustid"];
if($plcustid>1)
{
$getplqry='select Name, PL_EMI_Amt, Company_Name,Primary_Acc,Loan_Amount,Company_Type,Net_Salary,DOB,City,City_Other,source, Referral_Flag, Employment_Status from Req_Loan_Personal where ((RequestID="'.$plcustid.'"))';

list($alreadyExist,$plrow)=MainselectfuncNew($getplqry,$array = array());
$plrowcontr = count($plrow)-1;
$Name = $plrow[$plrowcontr]["Name"];
$Net_Salary = $plrow[$plrowcontr]["Net_Salary"];
$monthsalary = round($Net_Salary/12);
$PL_EMI_Amt = $plrow[$plrowcontr]["PL_EMI_Amt"];
$Company_Name = $plrow[$plrowcontr]["Company_Name"];
$DOB = $plrow[$plrowcontr]["DOB"];
$getDOB = DetermineAgeGETDOB($DOB);
$Company_Type = $plrow[$plrowcontr]["Company_Type"];
$Primary_Acc = $plrow[$plrowcontr]["Primary_Acc"];
$Loan_Amount = $plrow[$plrowcontr]["Loan_Amount"];
$DOB = $plrow[$plrowcontr]["DOB"];
$source = $plrow[$plrowcontr]["source"];
$City = $plrow[$plrowcontr]["City"];
$Referral_Flag = $plrow[$plrowcontr]["Referral_Flag"];
$Employment_Status = $plrow[$plrowcontr]["Employment_Status"];
$City_Other = $plrow[$plrowcontr]["City_Other"];
if($City=="Others" && strlen($City_Other)>0)
	{
		$strcity = $City_Other;
	}
	else
	{
		$strcity = $City;
	}
list($FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$plcustid,$strcity,$Referral_Flag,$source);

$icici_bankcmp="";
$stanc_account="";
$ingvyasyacategory="";
$bajajfinservcategory="";
$hdbfscategorycmp="";
$hdfccategory="";
$standard_charteredcategory="";
$bajajfinserv="";
$Indusind="";
$citicategorycmp="";
$stanc_category="";
$getcompany='select * from pl_company_list where ((company_name="'.$Company_Name.'"))';
list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
$growcontr = count($grow)-1;

$hdfccategory= $grow[$growcontr]["hdfc_bank"];
$fullertoncategory= $grow[$growcontr]["fullerton"];
$bajajfinservcategory= $grow[$growcontr]["bajajfinserv"];
$citicategorycmp= $grow[$growcontr]["citibank"];
$hdbfscategorycmp = $grow[$growcontr]["hdbfs"];
$icici_bankcmp = $grow[$growcontr]["icici_bank"];
$ingvyasyacategory = $grow[$growcontr]["ingvyasya"];
$kotakcategory = $grow[$growcontr]["kotak"];
$stanc_category= $grow[$growcontr]["standard_chartered"];
$tatacapitalcomp = $grow[$growcontr]["tatacapital"];
$Indusind = $grow[$growcontr]["Indusind"];
if(($Primary_Acc=="Citibank" || $Primary_Acc=="citibank" || $Primary_Acc=="Citi Bank") || (strlen($citicategorycmp)>2))
{
	$citicategory= "Done";
	$citicategory_n= "Done";
}
else
{
	$citicategory= "";
	$citicategory_n="";
}
//echo $citicategory."<br>";
$barclayscategory= $grow[$growcontr]["barclays"];

if($Primary_Acc=="Standard Chartered")
{
	$standard_charteredcategory= "Done";
	$stanc_account="Done";
}
else
{
$standard_charteredcategory = $stanc_category;
	$stanc_account="";
}

//$finalBidderName = explode(",",$strfinalBidderName);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<table>
<tr><td colspan="4">Name - <? echo $Name; ?></td></tr>
<tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Banks calculation Details </b></td></tr>
<tr><td colspan="4"><table border="1" width="100%" cellpadding="5" cellspacing="0">
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:14px;">Bank Name</b></td>
	<td width="11%" align="center"><b style="font-size:14px;">Loan Amount</b></td>
	<td width="11%" align="center"><b style="font-size:14px;">ROI</b></td>
	<td width="11%" align="center"><b style="font-size:14px;">Tenure</b></td>
	<td width="11%" align="center"><b style="font-size:14px;">EMI</b></td>
	<td width="11%" align="center"><b style="font-size:14px;">EMI(Per Lac)</b></td>
	<td width="11%" align="center"><b style="font-size:14px;">Company Cat</b></td>
	<td width="11%" align="center"><b style="font-size:14px;">Pre. charges</b></td>
	<td width="11%" align="center"><b style="font-size:14px;">prco. feee</b></td>
	</tr>
<? 
$finalBidderName_unique = array_unique($finalBidderName);
//print_r($finalBidderName_unique);
$finalBidderName_unique1=implode(",",$finalBidderName_unique);
$finalBidderName = explode(",",$finalBidderName_unique1);
//print_r($finalBidderName);

//echo $monthsalary." - ".$PL_EMI_Amt." - ".trim($Company_Name)." - ".$hdfccategory." - ".$getDOB." - ".$Company_Type." - ".$Primary_Acc."<br>";
for($ij=0;$ij<count($finalBidderName);$ij++)
{
	//echo "ff";
	if(($finalBidderName[$ij]=="Stanc" || $finalBidderName[$ij]=="Standard Chartered"))
	{ 
		list($stancinterestrate,$stancgetloanamout,$stancgetemicalc,$stancterm,$stancperfee,$stancprocfee)=Stanc($monthsalary,$PL_EMI_Amt,$Company_Name,$stanc_category,$getDOB,$Company_Type,$Primary_Acc);
		?>
		<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:14px;"><? echo $finalBidderName[$ij]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo round($stancgetloanamout); ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? if(isset($stancinterestrate)) { echo $stancinterestrate; } else { echo $hdfcrate ;} ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $stancterm." yrs";?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $stancgetemicalc; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? 
$stancrateexact=str_replace("%","",$stancinterestrate);
$stancintr = trim($stancrateexact)/1200;
			echo $emicalc=round(100000 * $stancintr / (1 - (pow(1/(1 + $stancintr), ($stancterm*12)))));
			?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $stanc_category; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo "0 - 4%" ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $stancperfee; ?></b></td>
	</tr><?
	}
		elseif($finalBidderName[$ij]=="HDFC" || $finalBidderName[$ij]=="HDFC Bank")
		{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperfee,$hdfcprocfee)=hdfcbank($monthsalary,$PL_EMI_Amt,trim($Company_Name),$hdfccategory,$getDOB,$Company_Type,$Primary_Acc);
if($hdfcgetloanamout>1000000)
			{$hdfcprepay="NIL";} else { $hdfcprepay="4%";}
//list($hdfcrate,$hdfcprepay_chrge,$hdfcpro_fee)=hdfcIR($monthsalary,$hdfccategory);
			?>
	<tr><td width="11%" height="25" align="center" valign="middle"><b style="font-size:14px;"><? echo $finalBidderName[$ij]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $hdfcgetloanamout; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? if(isset($hdfcinterestrate)) { echo $hdfcinterestrate; } else { echo $hdfcrate ;} ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $hdfcterm." yrs";?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $hdfcgetemicalc; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? 
$hdfcrateexact=str_replace("%","",$hdfcinterestrate);
$hdfcintr = trim($hdfcrateexact)/1200;
			echo $emicalc=round(100000 * $hdfcintr / (1 - (pow(1/(1 + $hdfcintr), ($hdfcterm*12)))));
			?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $hdfccategory; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $hdfcprepay; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $hdfcprocfee; ?></b></td>
	</tr>	
	<? }
	elseif(($finalBidderName[$ij]=="Citibank" || $finalBidderName[$ij]=="Citibank" || $finalBidderName[$ij]=="CitiBank") && ($citicategory!='' || $citicategory_n!=''))
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlac,$citiproc_Fee)=citibank($monthsalary,$PL_EMI_Amt,$Company_Name,$getDOB,$citicategorycmp);
	list($citirate,$citiprepay_chrge,$citipro_fee)=citiIR($monthsalary,$grow[$growcontr]["citibank"]);
			?>
		<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:14px;"><? echo $finalBidderName[$ij]; ?></b></td>
		<td width="11%" align="center"><b style="font-size:14px;"><? echo $citigetloanamout; ?></b></td>
		<td width="11%" align="center"><b style="font-size:14px;"><? if(isset($citiinterestrate)) { echo $citiinterestrate; } else { echo $citirate ;} ?></b></td>
		<td width="11%" align="center"><b style="font-size:14px;"><? echo $cititerm; ?></b></td>
		<td width="11%" align="center"><b style="font-size:14px;"><? echo $citigetemicalc; ?></b></td>
		<td width="11%" align="center"><b style="font-size:14px;"><? 
$citirateexact=str_replace("%","",$citiinterestrate);
$citiintr = trim($citirateexact)/1200;
			echo $emicalc=round(100000 * $citiintr / (1 - (pow(1/(1 + $citiintr), ($cititerm*12)))));
			?></b></td>
		<td width="11%" align="center"><b style="font-size:14px;"><? echo $citicategorycmp; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? if($citicategorycmp=="CAT A" && $monthsalary>=100000 && $citigetloanamout>=500000) { echo "0";} else
		{echo "1%"; } ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $citiproc_Fee; ?></b></td>
		</tr>	
	<?
	}
elseif($finalBidderName[$ij]=="Fullerton" || $finalBidderName[$ij]=="Fullerton" || $finalBidderName[$ij]=="Fullerton (Chattisgarh)")
{
list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm)=fullerton($monthsalary,$PL_EMI_Amt,$Company_Name,$fullertoncategory,$getDOB,$City);
list($fulrate,$fulprepay_chrge,$fulpro_fee)=fullertonIR($monthsalary,$grow[$growcontr]["fullerton"]);
	?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:14px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $fullertongetloanamout; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? if(isset($fullertoninterestrate)) { echo $fullertoninterestrate; } else { echo $fulrate ;} ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $fullertonterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $fullertongetemicalc; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? 
$fulrateexact=str_replace("%","",$fullertoninterestrate);
$fulintr = trim($fulrateexact)/1200;
			echo $emicalc=round(100000 * $fulintr / (1 - (pow(1/(1 + $fulintr), ($fullertonterm*12)))));
			?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $grow[$growcontr]["fullerton"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $fulprepay_chrge; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $fulpro_fee; ?></b></td>
</tr>	
<?
}
elseif($finalBidderName[$ij]=="ICICI" || $finalBidderName[$ij]=="ICICI Bank")
{
list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi,$profee)=icicibank($monthsalary,$Company_Name,$icici_bankcmp,$getDOB,$Company_Type,$Primary_Acc);
list($icicirate,$iciciprepay_chrge,$icicipro_fee)=iciciIR($monthsalary,$grow[$growcontr]["icici_bank"]);
	?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:14px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $icicigetloanamout; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $iciciinterestrate; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $iciciterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $icicigetemicalc; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? 
$icicirateexact=str_replace("%","",$iciciinterestrate);
$iciciintr = trim($icicirateexact)/1200;
	echo $emicalc=round(100000 * $iciciintr / (1 - (pow(1/(1 + $iciciintr), ($iciciterm*12)))));
			?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $grow[$growcontr]["icici_bank"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;">5%</b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $profee; ?></b></td>
</tr>	
<?
}
elseif((($finalBidderName[$ij]=="INDUS IND bank") || ($finalBidderName[$ij]=="INDUS IND bank")) && $Employment_Status==1)
	{
		list($indusindrate,$indusindloanamt,$indusindemi,$indusindterm,$indusindperlacemi)=@indusindbank($monthsalary,$Company_Name,$Indusind,$getDOB,$PL_EMI_Amt);

		if($indusindloanamt>0)
		{
	?>
	<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:14px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $indusindloanamt; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $indusindrate; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $indusindterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $indusindemi; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? 
$indusrateexact=str_replace("%","",$indusindrate);
$indusintr = trim($indusrateexact)/1200;
	echo $emicalc=round(100000 * $indusintr / (1 - (pow(1/(1 + $indusintr), ($indusindterm*12)))));
			?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $grow[$growcontr]["Indusind"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;">4%</b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? if($indusindrate=="12.99%") {echo "0.99%";} else {echo "1% -2%";}?></b></td>
</tr>	
<?	
	}
	}

	elseif(($finalBidderName[$ij]=="Kotak Bank" || $finalBidderName[$ij]=="Kotak"))
	{
		list($kotakrate,$kotakloanamt,$kotakemi,$kotakterm,$kotakperlacemi,$kotakproc_fee)=kotakbank($monthsalary,$Company_Name,$kotakcategory,$getDOB,$Company_Type,$Primary_Acc);
		//list($kotakrate,$kotakprepay_chrge,$kotakpro_fee)=kotakIR($monthsalary,$grow[$growcontr]["kotak"]);
		?>
		<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:14px;"><? echo $finalBidderName[$ij]; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $kotakloanamt; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $kotakrate; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $kotakterm; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $kotakemi; ?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? 
$kotakrateexact=str_replace("%","",$kotakrate);
$kotakintr = trim($kotakrateexact)/1200;
	echo $emicalc=round(100000 * $kotakintr / (1 - (pow(1/(1 + $kotakintr), ($kotakterm*12)))));
			?></b></td>
<td width="11%" align="center"><b style="font-size:14px;"><? echo $grow[$growcontr]["kotak"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;">4% - 5%</b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $kotakproc_fee; ?></b></td>
</tr>	
<?	}
	elseif(($finalBidderName[$ij]=="Bajaj Finserv") && $grow[$growcontr]["bajajfinserv"]!='')
	{	 list($bajajrate,$bajajprepay_chrge,$bajajpro_fee)=bajajIR($monthsalary,$grow[$growcontr]["bajajfinserv"]); 
	?>
<tr> <td colspan="2" height="25" align="center" valign="middle"><b style="font-size:14px;">for Bajaj Finserv</b></td>
		<td align="center"><? echo $bajajrate; ?></td>
		<td colspan="2">&nbsp;</td>
		<td align="center"><? echo $grow[$growcontr]["bajajfinserv"]; ?></td>
		<td align="center"><? echo $bajajprepay_chrge; ?></td>
		<td align="center"><? echo $bajajpro_fee; ?></td>
		</tr>
<?	}
	elseif(($finalBidderName[$ij]=="HDBFS") && $grow[$growcontr]["hdbfs"]!='')
	{
		list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= hdbfcLoans($hdbfscategorycmp, $monthsalary, $Primary_Acc,$getDOB,$PL_EMI_Amt,$Loan_Amount);

		list($hdbfsrate,$hdbfsprepay_chrge,$hdbfspro_fee)=hdbfsIR($monthsalary,$grow[$growcontr]["hdbfs"]); 
	?>
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:14px;"><? echo $finalBidderName[$ij]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $getloanamout; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? if(isset($interestrate)) { echo $interestrate; } else { echo $hdbfsrate ;} ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $term; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $getemicalc; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? 
$hdbfsrateexact=str_replace("%","",$interestrate);
$hdbfsintr = trim($hdbfsrateexact)/1200;
	echo $emicalc=round(100000 * $hdbfsintr / (1 - (pow(1/(1 + $hdbfsintr), ($term*12)))));
			?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $grow[$growcontr]["hdbfs"]; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $hdbfsprepay_chrge; ?></b></td>
	<td width="11%" align="center"><b style="font-size:14px;"><? echo $hdbfspro_fee; ?></b></td>
	</tr>	
<?	}
}?>
</table></td></tr>

</table>
</body>
</html>
<? 
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
?>