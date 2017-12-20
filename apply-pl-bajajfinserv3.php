<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
//error_reporting();

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

//print_r($_SESSION);
	$leadid = $_SESSION['leadid'];
	
	$getpldetails="select Mobile_Number,Email,ABMMU_flag,City_Other,City,Company_Name,Name,Net_Salary,DOB,PL_EMI_Amt, Primary_Acc,identification_proof,Company_Type,Loan_Amount,Primary_Acc From Req_Loan_Personal Where (RequestID='".$leadid."')";
	//echo "select Other_City,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')";
	list($CheckNumRows,$plrow)=Mainselectfunc($getpldetails,$array = array());
	
	//$plrow = mysql_fetch_array($getpldetails);
	$getCompany_Name = $plrow['Company_Name'];
	$City = $plrow['City'];
	$Name = $plrow['Name'];
	$DOB = $plrow['DOB'];
	$Mobile_Number = $plrow['Mobile_Number'];
		$Email = $plrow['Email'];
	$PL_EMI_Amt = $plrow['PL_EMI_Amt'];
	$Primary_Acc = $plrow['Primary_Acc'];
	$Net_Salary = $plrow['Net_Salary'];
	$Other_City = $plrow['City_Other'];	
	$Company_Type = $plrow['Company_Type'];
	$Primary_Acc = $plrow['Primary_Acc'];
	$Loan_Amount = $plrow['Loan_Amount'];
	$ABMMU_flag = $plrow['ABMMU_flag'];
	
	$Document_proof_doc = $plrow['identification_proof'];
	$Document_proof = explode(",",$Document_proof_doc);
	$getDOB = str_replace("-","", $DOB);
	$age = DetermineAgeGETDOB($getDOB);
	//echo $age."<br>";
	$agecalc="50";
	$exactage = $agecalc- $age;
	
	//get inflation amount
	$monthsalary =$Net_Salary/12;
	
	list($strFirst,$strLast) = split('[ ]', $Name);
if(strlen($strFirst)>25)
		{
			$shrtfname=strlen($strFirst)-25;
			$First = substr(trim($strFirst), 0, strlen(trim($strFirst))-$shrtfname);

		}
		else
		{
			$First =$strFirst;
		}
if(strlen($strLast)>25)
		{
			$shrtlname=strlen($strLast)-25;
			$Last = substr(trim($strLast), 0, strlen(trim($strLast))-$shrtlname);

		}
		else
		{
			$Last =$strLast;
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Thank you</title>

<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>

<style>
table {border-collapse:collapse;border-spacing:0;}

#bodyCenter #nwcontainer{background:url("http://www.deal4loans.com/new-images/container-bg.png") repeat-x; clear:both; width:850px; min-height:437px; padding:29px 10px 10px 10px;}
#bodyCenter #nwcontainer p strong{font:bold 14px Arial, Helvetica, sans-serif; color:#000; line-height:18px; clear:both; text-align:center;}
#bodyCenter #nwcontainer p{font:normal 12px Arial, Helvetica, sans-serif; color:#5c5e5e; line-height:18px; clear:both; text-align:center;}

#bodyCenter #nwcontainer #data{clear:both; margin:28px 0 15px 0;}
#bodyCenter #nwcontainer #data table{width:846px; margin:0 auto; position:relative;}
#bodyCenter #nwcontainer #data table tr{}
#bodyCenter #nwcontainer #data table tr th{font:bold 12px Arial, Helvetica, sans-serif; color:#3b5586; background:url("http://www.deal4loans.com/new-images/li-bg.jpg") repeat-x; height:33px; padding:3px 0 0 0;}
#bodyCenter #nwcontainer #data table tr th.bank{background:url("http://www.deal4loans.com/new-images/bank-name.png") no-repeat; width:116px;}
#bodyCenter #nwcontainer #data table tr td{border-bottom:2px solid #fff!important; height:80px;}
#bodyCenter #nwcontainer #data table tr td.banks{background:#f1f1f1; width:116px; text-align:center; padding:30px 0 0 0; height:50px; font:bold 10px Arial, Helvetica, sans-serif;}
#bodyCenter #nwcontainer #data table tr td.i-rate{background:#e7e6e6; text-align:center; font:bold 11px Arial, Helvetica, sans-serif; color:#706f6f; width:149px; }
#bodyCenter #nwcontainer #data table tr td.emi{background:#ececec; text-align:center;font:bold 11px Arial, Helvetica, sans-serif; color:#706f6f; width:161px; padding:0 0 0 5px;}
#bodyCenter #nwcontainer #data table tr td.tenure{text-align:center; font:bold 12px Arial, Helvetica, sans-serif; color:#706f6f; width:61px; padding:0 0 0 5px; background:url("http://www.deal4loans.com/new-images/tenure-bg.jpg") repeat-y; text-align:center; }
#bodyCenter #nwcontainer #data table tr td.loan{text-align:left; font:bold 12px Arial, Helvetica, sans-serif; color:#706f6f; width:134px; padding:0 0 0 5px; background:url("http://www.deal4loans.com/new-images/loan-bg.jpg") repeat-y; text-align:center;}
#bodyCenter #nwcontainer #data table tr td.info{text-align:left; font:bold 13px Arial, Helvetica, sans-serif; color:#bf2228; width:100px; padding:0 0 0 5px; background:url("http://www.deal4loans.com/new-images/information.jpg") repeat-y; text-align:center; }
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="cc_inner_wrapper">
<div style="clear:both;"></div>
<div class="common-bread-crumb" style="margin:auto; width:74%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">
<div id="bodyCenter" align="center">
<div id="nwcontainer" align="center">
  
<?php 
if ($leadid>0)
 {
 $getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered,hdbfs,ingvyasya,bajajfinserv,icici_bank from pl_company_list where company_name="'.$getCompany_Name.'"';
 //echo $getcompany;
 list($recordcount,$grow)=Mainselectfunc($getcompany,$array = array());
 
$hdfccategory= $grow[0]["hdfc_bank"];
$fullertoncategory= $grow[0]["fullerton"];
$citicategory= $grow[0]["citibank"];
$barclayscategory= $grow[0]["barclays"];
$stanccategory = $grow[0]["standard_chartered"];
$hdbfscategory = $grow[0]["hdbfs"]; 
$ingvyasyacategory = $grow[0]["ingvyasya"]; 
$bajajfinservcategory = $grow[0]["bajajfinserv"]; 
$icici_bankcategory = $grow[0]["icici_bank"]; 

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
?>

 <?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$leadid,$strCity);
	$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 
	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);

//print_r($Final_Bid);

if(count($FinalBidder)>0)
	 {
		
	?>
	<p><strong>Thanks for applying Personal Loan through Deal4loans.com. You will soon receive a call from us to negotiate better.</strong></p>
	<div align="left">
<span style="float:left; color:#000000; padding-left:4px;line-height:16px;">You are eligible for the below mentioned Banks, They will service you within 24hrs.<br />We at deal4loans.com believe that its big financial decision that you
are about to take.<br />
To get best deal, speak to 3 - 4 banks mentioned below and then decide
upon the best deal.<br />
This will help you get best deal & save on Emi & choose best product &
best service.</span></div>

<div id="data" align="center">
<table border="0" cellpadding="2" cellspacing="0" align="center">
  <tr>
    <th width="50" class="bank">&nbsp;</th>
    <th width="167">Interest Rate</th>
    <th width="189">Emi (per Month)</th>
    <th width="46">Tenure</th>
    <th width="83">Eligible Loan<br /> 
      Amount</th>
    <th width="154">Request for more<br /> 
      Information</th>
  </tr>
     <?
$getrespf="";
$getrespf="";
$getidpf="";
$actual_ident_proof="";
$actual_residence_proof="";
$actual_income_proof="";
$getinpf="";
$getdocpf="";
//print_r($Final_Bid);
for($i=0;$i<count($Final_Bid);$i++)
			{
	if(((strncmp ("Standard", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Standard Chartered")) && $stanccategory=='' && $monthsalary<50000)
	{

	}
	else if(((strncmp ("Citibank", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Citibank")) && $citicategory=='')
	{

	}
	else if(((strncmp ("IngVysya", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="IngVysya")) && (($ingvyasyacategory=='') && ($Company_Type < 4 )))
	{

	}
	else
				{  $shownToBidders_Arr[] = $Final_Bid[$i];

		$getdoc="select document_proof,identification_proof,residence_proof,income_proof from bank_documents_required where bank_name like '%".$Final_Bid[$i]."%'";
		list($recordcount,$myrow)=Mainselectfunc($getdoc,$array = array());
		
if($recordcount>0)
				{
		$identification_prf=$myrow["identification_proof"];
	$residence_prf=$myrow["residence_proof"];
	$income_prf=$myrow["income_proof"];
	$document_prf=$myrow["document_proof"];
//echo $document_prf."<br>";
	$arrid_pf=explode(",",$identification_prf);
	$arrres_pf=explode(",",$residence_prf);
	$arrinc_pf=explode(",",$income_prf);
	$arrdoc_pf=explode(",",$document_prf);


$getidpf=array_intersect($Document_proof,$arrid_pf);
$getrespf=array_intersect($Document_proof,$arrres_pf);
$getinpf=array_intersect($Document_proof,$arrinc_pf);
$getdocpf=array_intersect($Document_proof,$arrdoc_pf);


}
?>
        <tr align="center">
<!--//add Bank alogos-->
<?
	if(($Final_Bid[$i]=="HDFC Bank") || ($Final_Bid[$i]=="HDFC"))
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" />';
	}
else if((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
		{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-fulrtn.jpg" />';
	}
	else if($Final_Bid[$i]=="Kotak")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif"  />';

	}
	else if($Final_Bid[$i]=="ICICI")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/icici_bkpl.jpg"  />';
	}
	else if($Final_Bid[$i]=="Axis Bank")
	{
		$imagebank='<img src="http://www.deal4loans.com/new-images/pl/axisbank.jpg"  />';
	}
	else if($Final_Bid[$i]=="Citibank")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-citibnk.jpg" />';
	}
	else if($Final_Bid[$i]=="Barclays Finance" || (strncmp ("Barclays", $Final_Bid[$i],8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-barclays.jpg"/>';
	
	}
	else if($Final_Bid[$i]=="Standard Chartered" || (strncmp ("Standard", $Final_Bid[$i],8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-stanc.jpg"/>';
	
	}
	else if($Final_Bid[$i]=="HDBFS")
	{
		$imagebank='<img src="http://www.deal4loans.com/new-images/hdbfs-logo1.jpg"/>';
	}
	else if($Final_Bid[$i]=="IngVysya")
	{
		$imagebank='<img src="http://www.deal4loans.com/new-images/ing-logo1.jpg" />';
	}
	else if($Final_Bid[$i]=="Bajaj Finserv")
	{
		$imagebank='<img src="http://www.deal4loans.com/new-images/bajaj-finserv-logo.jpg" />';
	}
	
	else
		{
		$imagebank='';
		}
	
	?>
		<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?><br /><? echo $Final_Bid[$i]; ?></td>
            
 	<? if(($Final_Bid[$i]=="HDFC Bank") || ($Final_Bid[$i]=="HDFC"))
	{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);

		if($hdfcgetloanamout>0)
		{
	?>
	<td class="i-rate"><? echo $hdfcinterestrate; ?></td>
		<td class="emi">Rs. <? echo $hdfcgetemicalc; ?></td>
		<td class="tenure"><? echo $hdfcterm; ?> yrs.</td>
		<td class="loan">Rs. <? echo $hdfcgetloanamout; ?></td>
				 
	<?
		}
	else
		{?>
    <td colspan="4" class="i-rate">Check this bank offer via phone.</td>
	<?	}
		
	}
	else if((($Final_Bid[$i]=="ICICI") || ($Final_Bid[$i]=="ICICI Bank")) && $monthsalary>=30000)
	{
		list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)=icicibank($monthsalary,$getCompany_Name,$icici_bankcategory,$age,$Company_Type,$Primary_Acc);

		if($icicigetloanamout>0)
		{
	?>
	<td class="i-rate"><? echo $iciciinterestrate; ?></td>
		<td class="emi">Rs. <? echo $icicigetemicalc; ?></td>
		<td class="tenure"><? echo $iciciterm; ?> yrs.</td>
		<td class="loan">Rs. <? echo $icicigetloanamout; ?></td>
				 
	<?
		}
	else
		{?>
    <td colspan="4" class="i-rate">Check this bank offer via phone.</td>
	<?	}
		
	}
	elseif((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
	{
	list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
	if($fullertongetloanamout>0)
		{
	?>
	<td class="i-rate"><? echo $fullertoninterestrate; ?></td>
		<td class="emi">Rs. <? echo $fullertongetemicalc; ?></td>
		<td class="tenure"><? echo $fullertonterm; ?> yrs.</td>
		<td class="loan">Rs. <? echo $fullertongetloanamout; ?></td>
	<?
		}
	else
		{?>
   <td colspan="4" class="i-rate">Check this bank offer via phone.</td>
		<? }
		
	}
	elseif($Final_Bid[$i]=="Kotak")
	{
	?>
	  <td colspan="4" class="i-rate"><b>Check this bank offer via phone.</b></td>
	<? 
	}
	elseif((($Final_Bid[$i]=="CITIBANK") ||  ($Final_Bid[$i]=="Citibank")) && (strlen($citicategory)>0))
	{
?>
   <td colspan="4" class="i-rate">Check this bank offer via phone.</td>
		<? //}

	}
	elseif($Final_Bid[$i]=="Barclays")
	{
	list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm,$barclayperlacemi)=@barclays($monthsalary,$PL_EMI_Amt,$getCompany_Name,$barclayscategory,$age,$city);
	if($barclaygetloanamout>0)
		{
	?>
	<td class="i-rate"><? echo $barclayinterestrate; ?></td>
		<td class="emi">Rs. <? echo $barclaygetemicalc; ?></td>
		<td class="tenure"><? echo $barclayterm; ?> yrs.</td>
		<td class="loan">Rs. <? echo $barclaygetloanamout; ?></td>
	
		<?
		}
	else
		{?>
  <td colspan="4" class="i-rate">Check this bank offer via phone.</td>
		<? }
	}
	elseif($Final_Bid[$i]=="HDBFS")
	{
	
//echo $hdbfscategory;
	list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= hdbfcLoans ($hdbfscategory, $monthsalary, $Primary_Acc,$age,$PL_EMI_Amt,$Loan_Amount);

	if($getloanamout>0)
		{
	?>
	<td class="i-rate"><? echo $interestrate; ?></td>
		<td class="emi">Rs. <? echo $getemicalc; ?></td>
		<td class="tenure"><? echo $term; ?> yrs.</td>
		<td class="loan">Rs. <? echo $getloanamout; ?></td>
		<?
		}
		else
		{?>
   <td colspan="4" class="i-rate">Check this bank offer via phone.</td>
		<? }
	}
		elseif($Final_Bid[$i]=="IngVysya")
	{
	
if($Primary_Acc=="IngVysya")
{
	$account_holder = 1;
}
	list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= ingVyasyaLoans_nw ($ingvyasyacategory, $monthsalary, $account_holder,$age,$PL_EMI_Amt,$Loan_Amount,$getCompany_Name,$Company_Type);
	

	if($getloanamout>0)
		{
	?>
	<td class="i-rate"><? echo $interestrate; ?></td>
		<td class="emi">Rs. <? echo $getemicalc; ?></td>
		<td class="tenure"><? echo $term; ?> yrs.</td>
		<td class="loan">Rs. <? echo $getloanamout; ?></td>
	
		<?
		}	
	else
		{?>
   <td colspan="4" class="i-rate">Check this bank offer via phone.</td>
		<? }
	}
	else if($Final_Bid[$i]=="Bajaj Finserv")
	{
?>
   <td colspan="2" class="i-rate"><ul style="text-align:left;"><li>0% Pre-payment Charges</li><li>
Part-Prepayment</li><li>Loan Amount - Upto 25 Lacs</li></ul></td>
<td colspan="2" class="i-rate" height="100"><img src="new-images/get-approval-stamp.png" width="198" height="90" /><br />Else Cashback of Rs. 1,000/- </td>
	
<?php	
	}
	else
	{
	?>
	
  <td colspan="4" class="i-rate"><b>Check this bank offer via phone.</b></td>
		<? 
		
	}
	?>
	<td class="info">
        <?php
if((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))	
		{
   ?>
        <form action="/get-instantquote-submit.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		  <input type="hidden" name="max_loan_amount" value="<?php echo $fullertongetloanamout ; ?>" />
	   <input type="hidden" name="calc_emi" value="<?php echo $fullertongetemicalc ; ?>" />
	    <input type="hidden" name="loan_tenure" value="<?php echo $fullertonterm ; ?>" />
            <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $getbankid[$i]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form>
      <?php
	}
elseif((($Final_Bid[$i]=="CITIBANK") ||  ($Final_Bid[$i]=="Citibank")) && (strlen($citicategory)>0))
{
	?>
        <form action="/get-citibankquote-submit.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		  <input type="hidden" name="max_loan_amount" value="<?php echo $citigetloanamout ; ?>" />
	   <input type="hidden" name="calc_emi" value="<?php echo $citigetemicalc ; ?>" />
	    <input type="hidden" name="loan_tenure" value="<?php echo $cititerm ; ?>" />
            <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $getbankid[$i]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form>
           <?php
	}
	else if($Final_Bid[$i]=="Bajaj Finserv")
		{ ?>
	 <form action="/apply-pl-bajajfinserv4.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		<input type="hidden" name="loan_amount" id="loan_amount" value="<?php echo $Loan_Amount; ?>" />
	   <input type="hidden" name="name" value="<?php echo $Name; ?>" />
	   <input type="hidden" name="DOB" id="DOB" value="<?php echo $DOB; ?>" />
       <input type="hidden" name="Mobile_Number" id="Mobile_Number" value="<?php echo $Mobile_Number; ?>" />
       <input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
       <input type="hidden" name="company_name" id="company_name" value="<? echo $getCompany_Name; ?>">
	   <input type="hidden" name="salary" id="salary" value="<?php echo $Net_Salary; ?>" />
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form>
		<? }
	else
	{
		 if($Final_Bid[$i]=="IngVysya")
		{ ?>
			<div style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#666666;">&bull; 0% Pre-payment Charges<br />&bull; 
Part-Prepayment</div>		<? }
		else
		{

		}
	?>
    
    <form action="/apply_pl_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form>
    <?php
	}
	?>              
         
                  </td>
  </tr>

  <?
			}
	} 
	$shownToBidders_Str = implode(",",$shownToBidders_Arr);

$DataArray = array("checked_bidders"=>$shownToBidders_Str);
$wherecondition ="RequestID='".$leadid."'";
Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
	?>
			<tr>
            <td colspan="6" align="right" style="font:bold 11px Arial, Helvetica, sans-serif;"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
          </tr>
</table>
</div>
 
 <?
 	 }	 

	 else
	 { ?>
 <p><strong>We are not able to find any bank for you.Please contact your local bank. We will contact you, if we find any offer for you.</strong></p>
	 <? }?>
<? }?>
  </div>
 
</div></div>
<div style="clear:both; height:15px;"></div>
<div class="hide-top"><?php include "footer_sub_menu.php"; ?></div>
</body>
</html>