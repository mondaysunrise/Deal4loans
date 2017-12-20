<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistof_ppbidders.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
	
	
	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

		
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

	
if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		    $leadid = $_REQUEST['leadid'];
			
			$_SESSION['leadid'] = $leadid;
			
			$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
			$Company_Type = $_REQUEST['Company_Type'];
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
		
	$getpldetails=("select City_Other,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')");
	list($numrows,$flg)=Mainselectfunc($getflag,$array = array());

$getCompany_Name = $plrow['Company_Name'];
$City = $plrow['City'];
$Name = $plrow['Name'];
$DOB = $plrow['DOB'];
$Net_Salary = $plrow['Net_Salary'];
$Other_City = $plrow['City_Other'];	

$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);
$monthsalary =$Net_Salary/12;


	$crap = $City_Other." ".$Primary_Acc." ".$Years_In_Company." ".$Total_Experience;
	$crapValue = validateValues($crap);

	//exit();
	if($crapValue=="Put")
	{
	
	
if($leadid>0)
	{														
	
	$dataUpdate = array('Company_Type'=>$Company_Type,  'PL_EMI_Amt'=>$PL_EMI_Amt,  'Primary_Acc'=>$Primary_Acc,  'Residential_Status'=>$Residential_Status,  'Card_Limit'=>$Credit_Limit,  'Years_In_Company'=>$Years_In_Company,  'Total_Experience'=>$Total_Experience,  'EMI_Paid'=>$EMI_Paid,  'Loan_Any'=>$Loan_A);
					$wherecondition = "(RequestID=".$leadid.")";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
		
		}
				
			}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();

		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
		
	}//$_POST
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
</head>
<style>
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {margin:0;padding:0;border:0;outline:0;vertical-align:baseline; outline:none;}
body {line-height:1; }
ol, ul {list-style:none;}
blockquote, q {quotes:none;}
blockquote:before, blockquote:after, q:before, q:after {content:'';content:none;}
:focus {outline:0;}
ins {text-decoration:none;}
del{text-decoration:line-through;}
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
<body>
<?php include '~Top-new.php';?>
<div id="bodyCenter" align="center">
   <div id="nwcontainer" align="center">
  <p><strong>Thanks for applying Personal Loan through Deal4loans.com.

<?php 
if ($leadid>0)
 {
 $getcompany='select hdfc_bank,fullerton,standard_chartered,hdbfs,ingvyasya,bajajfinserv from pl_company_list where company_name="'.$getCompany_Name.'"';
list($recordcount,$grow)=Mainselectfunc($getcompany,$array = array());
$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$stanccategory = $grow["standard_chartered"];
$hdbfscategory = $grow["hdbfs"]; 
$ingvyasyacategory = $grow["ingvyasya"]; 
$bajajfinservcategory = $grow["bajajfinserv"]; 

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

			//print_r($FinalBidder);
			//echo "<br>";
			//print_r($realbankiD);
				//		echo "<br>";
			//print_r($finalBidderName);
	$arrFinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);

	

if(count($FinalBidder)>0)
	 {
		
	?>
Please choose and apply from the below Banks</strong></p>
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
for($i=0;$i<count($Final_Bid);$i++)
			{
	//echo $FinalBidder[$i];
	if(((strncmp ("Standard", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Standard Chartered")) && $stanccategory=='')
	{

	}
	else if(((strncmp ("Bajaj Finserv", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Bajaj")) && $bajajfinservcategory=='')
	{

	}

	else
		{  $shownToBidders_Arr[] = $Final_Bid[$i];

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
	
       
 	<? 
		if($Final_Bid[$i]=="Bajaj Finserv" && strlen($bajajfinservcategory)>1)
	{
?>
<td class="banks">&nbsp;&nbsp;<? echo  $imagebank; ?><br /><? echo $Final_Bid[$i]; ?></td>
<td class="i-rate"><? if($bajajfinservcategory=="CAT A") { $bajajrate="16%";} elseif($bajajfinservcategory=="CAT B" || $bajajfinservcategory=="CAT C") { $bajajrate="17%"; } else { $bajajrate="17%"; } echo $bajajrate; ?></td>
		<td class="emi">N.A</td>
		<td class="tenure">N.A</td>
		<td class="loan" valign="middle">Upto 30 Lacs<br><span style="font-size:11px;">(Zero Pre-Payment Charges<br> Part-prepayment facility <br> Prompt Repayment Benefits)</span></td>
   <!--<td colspan="4" class="i-rate"><ul style="text-align:left;"><li>0% Pre-payment Charges</li><li>
Part-Prepayment</li><li>Loan Amount - Upto 30 Lacs</li></ul></td>-->
<td class="info">    
    <form action="pstpd_bdds_pl.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="hidden" name="pl_bidid" value="<? echo $FinalBidder[$i]; ?>" id="pl_bidid">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form>
            
	</td>
	
<?php	
	}
elseif(($Final_Bid[$i]=="HDFC Bank") || ($Final_Bid[$i]=="HDFC"))
	{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);

		if($hdfcgetloanamout>0)
		{
	?>
	<td class="banks">&nbsp;&nbsp;<? echo  $imagebank; ?><br /><? echo $Final_Bid[$i]; ?></td>
	<td class="i-rate"><? echo $hdfcinterestrate; ?></td>
		<td class="emi">Rs. <? echo $hdfcgetemicalc; ?></td>
		<td class="tenure"><? echo $hdfcterm; ?> yrs.</td>
		<td class="loan">Rs. <? echo $hdfcgetloanamout; ?></td>
		<td class="info">    
    <form action="pstpd_bdds_pl.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="hidden" name="pl_bidid" value="<? echo $FinalBidder[$i]; ?>" id="pl_bidid">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form>
            
	</td>
	<?
		}
	else
		{?>
		<td class="banks">&nbsp;&nbsp;<? echo  $imagebank; ?><br /><? echo $Final_Bid[$i]; ?></td>
    <td colspan="4" class="i-rate">Check this bank offer via phone.</td>
	<td class="info">    
    <form action="pstpd_bdds_pl.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="hidden" name="pl_bidid" value="<? echo $FinalBidder[$i]; ?>" id="pl_bidid">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form>
            
	</td>
	<?	}
		
	}
	elseif((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
	{
	list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
	if($fullertongetloanamout>0)
		{
	?>
	<td class="banks">&nbsp;&nbsp;<? echo  $imagebank; ?><br /><? echo $Final_Bid[$i]; ?></td>
	<td class="i-rate"><? echo $fullertoninterestrate; ?></td>
		<td class="emi">Rs. <? echo $fullertongetemicalc; ?></td>
		<td class="tenure"><? echo $fullertonterm; ?> yrs.</td>
		<td class="loan">Rs. <? echo $fullertongetloanamout; ?></td>
		<td class="info">    
    <form action="pstpd_bdds_pl.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="hidden" name="pl_bidid" value="<? echo $FinalBidder[$i]; ?>" id="pl_bidid">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form>
            
	</td>
	<?
		}
	else
		{?>
		<td class="banks">&nbsp;&nbsp;<? echo  $imagebank; ?><br /><? echo $Final_Bid[$i]; ?></td>
   <td colspan="4" class="i-rate">Check this bank offer via phone.</td>
   <td class="info">    
    <form action="pstpd_bdds_pl.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="hidden" name="pl_bidid" value="<? echo $FinalBidder[$i]; ?>" id="pl_bidid">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form>
            
	</td>
		<? }
		
	}
	elseif($Final_Bid[$i]=="HDBFS")
	{
	
	list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= hdbfcLoans ($hdbfscategory, $monthsalary, $Primary_Acc,$age,$PL_EMI_Amt,$Loan_Amount);
	if($getloanamout>0)
		{
	?>
	<td class="banks">&nbsp;&nbsp;<? echo  $imagebank; ?><br /><? echo $Final_Bid[$i]; ?></td>
	<td class="i-rate"><? echo $interestrate; ?></td>
		<td class="emi">Rs. <? echo $getemicalc; ?></td>
		<td class="tenure"><? echo $term; ?> yrs.</td>
		<td class="loan">Rs. <? echo $getloanamout; ?></td>
		<td class="info">    
    <form action="pstpd_bdds_pl.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="hidden" name="pl_bidid" value="<? echo $FinalBidder[$i]; ?>" id="pl_bidid">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form>
            
	</td>
		<?
		}
		else
		{?>
		<td class="banks">&nbsp;&nbsp;<? echo  $imagebank; ?><br /><? echo $Final_Bid[$i]; ?></td>
   <td colspan="4" class="i-rate">Check this bank offer via phone.</td>
   <td class="info">    
    <form action="pstpd_bdds_pl.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="hidden" name="pl_bidid" value="<? echo $FinalBidder[$i]; ?>" id="pl_bidid">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form>
            
	</td>
		<? }
	}
	elseif($Final_Bid[$i]=="IngVysya" && strlen($ingvyasyacategory)>0)
	{
	
if($Primary_Acc=="IngVysya")
{
	$account_holder = 1;
}
	list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= ingVyasyaLoans ($ingvyasyacategory, $monthsalary, $account_holder,$age,$PL_EMI_Amt,$Loan_Amount,$getCompany_Name);
	if($getloanamout>0)
		{
	?>
	<td class="banks">&nbsp;&nbsp;<? echo  $imagebank; ?><br /><? echo $Final_Bid[$i]; ?></td>
	<td class="i-rate"><? echo $interestrate; ?></td>
		<td class="emi">Rs. <? echo $getemicalc; ?></td>
		<td class="tenure"><? echo $term; ?> yrs.</td>
		<td class="loan">Rs. <? echo $getloanamout; ?><br><span style="font-size:11px;">(Prompt Repayment Benefits)</span></td>
		<td class="info">    
    <form action="pstpd_bdds_pl.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="hidden" name="pl_bidid" value="<? echo $FinalBidder[$i]; ?>" id="pl_bidid">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form>
            
	</td>
	
		<?
		}	
	else
		{?>
		<td class="banks">&nbsp;&nbsp;<? echo  $imagebank; ?><br /><? echo $Final_Bid[$i]; ?></td>
   <td colspan="4" class="i-rate">Check this bank offer via phone.</td>
   <td class="info">    
    <form action="pstpd_bdds_pl.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="hidden" name="pl_bidid" value="<? echo $FinalBidder[$i]; ?>" id="pl_bidid">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form>
            
	</td>
		<? }
	}
	
	else
	{
	?>
	
  <!--<td colspan="4" class="i-rate"><b>Check this bank offer via phone.</b></td>-->
		<? 
	}
	?>

	
  </tr>
  <?
			}
	
	$shownToBidders_Str = implode(",",$shownToBidders_Arr);
	$Dated = ExactServerdate();
		$DataArray = array("checked_bidders"=>$shownToBidders_Str);
		$wherecondition ="(RequestID=".$leadid.")";
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
 </strong></p>
	 <? }?>
<? }?>
  </div>
</div>
</body>
</html>