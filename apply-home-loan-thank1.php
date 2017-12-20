<?php
//ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/home_loan_eligibility_function.php';

	
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
			$Type_Loan=$_REQUEST['Type_Loan'];
			$Reference_Code1 = $_REQUEST['Reference_Code1'];
			$ProductValue = $_REQUEST['ProductValue'];	
			$Day=$_REQUEST['day'];
			$Month=$_REQUEST['month'];
			$Year=$_REQUEST['year'];
			$DOB=$Year."-".$Month."-".$Day;
			$Residence_Address = $_REQUEST['Residence_Address'];
			$Pincode = $_REQUEST['Pincode'];
			$Employment_Status = $_REQUEST['Employment_Status'];
			$Company_Name = $_REQUEST['Company_Name'];
			$Property_Identified = $_REQUEST['Property_Identified'];
			$Property_Loc = $_REQUEST['Property_Loc'];
			$updateProperty = $_REQUEST['updateProperty'];
			$Loan_Time = $_REQUEST['Loan_Time'];
			$Budget = $_REQUEST['Budget'];
			$Accidental_Insurance = $_REQUEST['Accidental_Insurance'];
			$RePhone = $_REQUEST['RePhone'];
			$Phone = $_REQUEST['Phone'];
			$City = $_REQUEST['City'];
			$Net_Salary = $_REQUEST['Net_Salary'];
			$Net_Salary = $_POST['Net_Salary'];
			$monthly_income = ($Net_Salary /12);
			$obligations = $_POST['obligations'];
			$co_appli = $_POST['co_appli'];
			$co_name = $_POST['co_name'];
			$dob_arr_co[] = $_POST['co_year'];
			$dob_arr_co[] = $_POST['co_month'];
			$dob_arr_co[] = $_POST['co_day'];
			$DOB_co = implode("-", $dob_arr_co);
			$co_monthly_income = $_POST['co_monthly_income'];
			$co_obligations = $_POST['co_obligations'];
			$property_value = $_POST['Property_Value'];
			$getnetAmount = ($monthly_income + $co_monthly_income);
			$total_obligation = $obligations + $co_obligations;
			$netAmount=($getnetAmount - $total_obligation);
			$currentyear=date('Y');
$age=$currentyear-$Year;

			$CheckSql = "select  Reference_Code,Name from ".$Type_Loan." where RequestID =".$ProductValue;
			list($CheckRowNR,$CheckRow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($hlrow)-1;
			$CheckRef = $CheckRow[$myrowcontr]['Reference_Code'];
			$Name = $CheckRow[$myrowcontr]['Name'];
	$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);
//echo $age."<br>";
$agecalc="50";
$exactage = $agecalc- $age;
//echo $exactage."<br>";
//get inflation amount
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;

				
			$crap = " ".$Property_Identified." ".$Property_Loc." ".$company." ".$City_Other." ".$Primary_Acc." ".$Descr." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{
	
				
				if (($Type_Loan=="Req_Loan_Home") || ($product=="HomeLoan"))
					{
						$dataUpdate = array('Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$total_obligation, 'DOB'=>$DOB, 'Residence_Address'=>$Residence_Address, 'Pincode'=>$Pincode, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'Property_Identified'=>$Property_Identified, 'Property_Loc'=>$Property_Loc, 'Loan_Time'=>$Loan_Time, 'Budget'=>$budget);
						$wherecondition = "(RequestID=".$ProductValue.")";
						Mainupdatefunc ('Req_Loan_Home', $dataUpdate, $wherecondition);
				
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
	$_SESSION['ProductValueHL'] = $ProductValue;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
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
<?php
//echo $getnetAmount." - ".$loan_amount." - ".$age." - ".$total_obligation." - ".$strCity." - ".$property_value;
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);

	$Final_Bid = "";
	while (list ($key,$val) = @each($bankID)) { 
	$Final_Bid[]= $val; 
	} 

	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);
	?>
<div id="bodyCenter" align="center">
   <div id="nwcontainer" align="center">
<?php
	if(count($FinalBidder)>0)
	{ ?>   
  <p><strong>Thanks for applying Home Loan through deal4Loans.com. You will soon receive a call from us</strong></p>
  <?php } else { ?>
    <p><strong>Thanks for applying Home Loan through deal4Loans.com. <br />As per your profile, Currently we cannot service any offer from any Bank</strong></p>
<?php } ?>
<?php
	if(count($FinalBidder)>0)
	{ ?>
	<br />

  	<p>We at deal4loans.com believe that its big financial decision that you
are about to take.</p>
    <p>To get best deal, speak to 3 - 4 banks mentioned below and then decide
upon the best deal.</p>
<p>This will help you get best deal & save on Emi & choose best product &
best service.</p>

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
	 if($Final_Bid[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis")
	{		 
	
list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	if($axisviewLoanAmt>0)
		{
	
		?>
		<tr>
		 <td class="banks"><img src="new-images/thnk-axis.gif" width="86" height="20" /><br /> 	  <? echo $Final_Bid[$i]; ?></td>		  
		  <td class="i-rate"><?php echo $axisinter; ?> %</td>
		   <td class="emi">Rs. <?php echo $axisemi; ?> </td>
		  <td class="tenure"><?php echo abs($axisprint_term); ?> yrs.</td>
		  <td class="loan">Rs. <?php echo abs($axisviewLoanAmt); ?></td>
		 <td class="info">
          <form action="apply_hl_consent.php" method="POST" target="_blank" >
		 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height:20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form>
          </td>
		  </tr>
  <? }
  else
		{ ?>
		<tr>
		<td class="banks"><img src="new-images/thnk-axis.gif" width="86" height="20" /><br /> 
              <? echo $Final_Bid[$i]; ?></td>
			  <td colspan="4" class="i-rate">&nbsp;</td>
		<td class="info"><b><form action="apply_hl_consent.php" method="POST" target="_blank" >
			<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
			<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></b></td>
		</tr>
	<? 	}
	}
	elseif(($Final_Bid[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Bank"))
	{ ?>
	<tr>
		<td class="banks"> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate" colspan="4">&nbsp;</td>		
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>
		<? 
	}
	elseif($Final_Bid[$i]=="LIC Housing" || $Final_Bid[$i]=="LIC")
	{?>
	
<tr>
	  <td class="banks"><? echo $Final_Bid[$i]; ?></td>		
	  <td class="i-rate" colspan="4">Check this bank offer via phone</td>
	   <td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>
	<? 	
	}
	elseif($Final_Bid[$i]=="ICICI" || $Final_Bid[$i]=="ICICI Bank")
	{
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
if($iciciviewLoanAmt>0)
		{
?>
<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>	
		<td class="i-rate"><b><? echo $iciciinter; ?> %</b></td>
		<td class="emi"><b> <?php echo $iciciactualemi; ?></b></td>
		 <td class="tenure"><?php echo abs($iciciprint_term); ?> yrs.</td>
		<td class="loan">Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
		 <td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>
	  <?
		}
else
		{ ?>
<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>	
		<td colspan="4" class="i-rate">&nbsp;</td>
		 <td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>

		<? }
	}

elseif($Final_Bid[$i]=="HDFC" || $Final_Bid[$i]=="HDFC Bank" || $Final_Bid[$i]=="HDFC Ltd")
	{
		list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		if($hdfcviewLoanAmt>0)
		{
?>
<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate"><?php echo $hdfcinter; ?></td>
		<td class="emi"><?php echo $hdfcemi; ?></td>
		<td class="tenure"><?php echo abs($hdfcprint_term); ?> yrs.</td>
		<td class="loan">Rs. <?php echo $hdfcviewLoanAmt; ?></td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		  </form></td>
		  </tr>
		  <?
		}
else
		{ ?>
<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate" colspan="4">&nbsp;</td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		  </form></td>
		  </tr>
		<? }
}
elseif($Final_Bid[$i]=="Fedbank" || (strncmp ("Fedbank", $Final_Bid[$i],7))==0)
		{
			list($federalemi,$federalinter,$federalterm,$federalloanamt) = federal_Homeloan($getnetAmount,$age,$obligation,$property_value);
			if($federalloanamt>0)
			{
				?>
				<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/federal_bnksmll.jpg" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate"><?php echo $federalinter; ?> %</td>
		<td class="emi">Rs.<?php echo $federalemi; ?></td>
		<td class="tenure"><?php echo $federalterm; ?> yrs.</td>
		<td class="loan">Rs. <?php echo $federalloanamt; ?></td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		  </form></td>
		  </tr>
			<? }
			else
			{ ?>
				<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/federal_bnksmll.jpg" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate" colspan="4">Check this bank offer via phone</td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(http://www.deal4loans.com/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		  </form></td>
		  </tr>
<?
			}
		}
elseif($Final_Bid[$i]=="First Blue Home Finance" || $Final_Bid[$i]=="First Blue" || (strncmp ("First", $Final_Bid[$i],5))==0)
	{
		if($Employment_Status==0)
		{
		list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSE($getnetAmount,$age,$total_obligation,$property_value,$Property_Identified);
		}
		else
		{
			list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSal($getnetAmount,$age,$total_obligation,$property_value,$Property_Identified);
		}
?>
<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/first-blue-logo.jpg" width="95"  /></td>
		<td class="i-rate"><?php echo $frstblinter; ?> %</td>
		<td class="emi">Rs. <?php echo  $frstblactualemi; ?></td>
		<td class="tenure"><?php echo $frstblterm; ?> yrs.</td>
		<td class="loan">Rs. <?php echo $frstblloan_amount; ?></td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>
	  <?
}
else
	{
		if($Final_Bid[$i]=="Citibank" || $Final_Bid[$i]=="Citi Bank")
	{
		
		$bankwimg='';

	}
	elseif($Final_Bid[$i]=="DHFL")
	{
		
		$bankwimg='';
		
	}
	elseif($Final_Bid[$i]=="Standard Chartered" || (strncmp ("Standard", $Final_Bid[$i],8))==0 )
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-stantc.jpg" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="Reliance capital" || (strncmp ("Reliance", $Final_Bid[$i],8))==0)
	{
		
		$bankwimg='';
		
	}
	elseif($Final_Bid[$i]=="ING VYSYA" || $Final_Bid[$i]=="Ing Vysya" || (strncmp ("ING", $Final_Bid[$i],3))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-ing.gif" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="India Bulls")
	{
		
		$bankwimg='';
		
	}
	elseif($Final_Bid[$i]=="Kotak Bank" || (strncmp ("Kotak", $Final_Bid[$i],5))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif" width="86" height="20" />';
		
	}
	elseif((strncmp ("Barclays", $Final_Bid[$i],8))==0)
	{
		
		$bankwimg='';
		
	}
	elseif($Final_Bid[$i]=="Citifinancial")
	{
		
		$bankwimg='';
		
	}
	elseif($Final_Bid[$i]=="SBI")
	{
		
		$bankwimg='';
		
	}
	else
		{
			$bankwimg='&nbsp;';
		}
		?>
		<tr><td class="banks"><? echo $bankwimg;?><br /> 
              <? echo $Final_Bid[$i]; ?></td>
               <td colspan="4" class="i-rate">Check this bank offer via phone</td>
                           
<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nxt.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
	<? }
	 } //for ends here 
?>
	<tr>
            <td colspan="6" align="right" style="font:bold 11px Arial, Helvetica, sans-serif;"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a><p align="center"> 
				<span style="font-size:10px;">Advertisment</span><br />
			<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=92&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a97316c1' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=92&amp;n=a97316c1' border='0' alt=''></a></noscript>
<?php
$Dated = ExactServerdate();
$dataTrack = array('RequestID'=>$ProductValue ,'PageName'=>$_SERVER['HTTP_REFERER'] ,'Dated'=>$Dated ,'Counter'=>'1');
$insert = Maininsertfunc ("trackBanner", $dataTrack);
?>
</p></td>
          </tr>
</table>
</div>
<? }
		else
		{ ?>
<p align="center" style="vertical-align:bottom; padding-top:100px;"> <br /><br /><br /><br /><br /><br /><br />
				<span style="font-size:10px;">Advertisment</span>
                <div align="center" style=" clear:both; padding:10px; ">
<script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* deal4loan */
google_ad_slot = "8793338166";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div><br />
			<script language='JavaScript' type='text/javascript' src='http://ads.deal4loans.com/adx.js'></script>
<script language='JavaScript' type='text/javascript'>
<!--
   if (!document.phpAds_used) document.phpAds_used = ',';
   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
   
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://ads.deal4loans.com/adjs.php?n=" + phpAds_random);
   document.write ("&amp;clientid=92&amp;target=_blank");
   document.write ("&amp;exclude=" + document.phpAds_used);
   if (document.referrer)
      document.write ("&amp;referer=" + escape(document.referrer));
   document.write ("'><" + "/script>");
//-->
</script><noscript><a href='http://ads.deal4loans.com/adclick.php?n=a97316c1' target='_blank'><img src='http://ads.deal4loans.com/adview.php?clientid=92&amp;n=a97316c1' border='0' alt=''></a></noscript>
<?php

$dataInsert = array("RequestID"=>$ProductValue, "PageName"=>$_SERVER['HTTP_REFERER'], "Dated"=>$Dated, "Counter"=>1);
$table = 'trackBanner';
$insert = Maininsertfunc ($table, $dataInsert);

?>
</p>
		<? } ?>
  </div>
</div>

<!-- Google Code for lead Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1063319470;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "666666";
if (1) {
  var google_conversion_value = 1;
}
var google_conversion_label = "lead";
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1063319470/imp.gif?value=1&label=lead&script=0">
</noscript>
</body>
</html>

