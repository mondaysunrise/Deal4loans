<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';
	require 'getlistofeligiblebidders1.php';
//cho "uh";

function DetermineAgeFromDOB ($YYYYMMDD_In)
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

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
 


 	$ProductValue = $_POST['ProductValue'];
	$strCity=$_POST['strcity'];
	$Name=$_POST['Name'];

	$sql = "select Net_Salary, Co_Applicant_Income, Co_Applicant_Obligation, Total_Obligation, Loan_Amount, DOB, Property_Value, Property_Identified, City, City_Other from Req_Loan_Home where RequestID='".$ProductValue."'";
	//echo $sql."<br>";
	list($alreadyExist,$query)=MainselectfuncNew($sql,$array = array());
	$myrowcontr=count($query)-1;
	$Net_Salary = $query[$myrowcontr]['Net_Salary'];
	$monthly_income = ($Net_Salary /12);
	$co_monthly_income = $query[$myrowcontr]['Co_Applicant_Income'];
	$Co_Applicant_Obligation = $query[$myrowcontr]['Co_Applicant_Obligation'];
	$obligations = $query[$myrowcontr]['Total_Obligation'];
	$getnetAmount = ($monthly_income + $co_monthly_income);
	$loan_amount = $query[$myrowcontr]['Loan_Amount'];
	$dateofbirth = $query[$myrowcontr]['DOB'];
	$DOB = str_replace("-","", $dateofbirth);
	$age = DetermineAgeFromDOB($DOB);
	$total_obligation  = $obligations + $co_obligations;
	$property_value = $query[$myrowcontr]['Property_Value'];
	$Property_Identified = $query[$myrowcontr]['Property_Identified'];
	$netAmount=($getnetAmount - $total_obligation);
	$City =  $query[$myrowcontr]['City'];
	$Other_City =  $query[$myrowcontr]['City_Other'];

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
<div id="bodyCenter" align="center">
   <div id="nwcontainer" align="center">
  <p><strong>Thanks for applying Home Loan through deal4Loans.com. You will soon receive a call from us</strong></p>
<?php
//echo $getnetAmount." - ".$loan_amount." - ".$age." - ".$total_obligation." - ".$strCity." - ".$property_value;
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);

	$Final_Bid = "";
	while (list ($key,$val) = @each($bankID)) { 
	$Final_Bid[]= $val; 
	} 

	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);

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
	{		 list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
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
		<input type="submit" style="width: 49px; height:20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
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
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></b></td>
		</tr>
	<? 	}
	}
	elseif(($Final_Bid[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Bank"))
	{
	list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	if($idbiviewLoanAmt>0)
		{
		?> 
		<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/thnk-idbi.gif" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate"><?php echo $idbiinter; ?> %</td>
		<td class="emi">Rs. <?php echo $idbiemi; ?></td>
		<td class="tenure"><?php echo abs($idbiprint_term); ?> yrs.</td>
		<td class="loan">Rs. <?php echo abs($idbiviewLoanAmt); ?></td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>
		<?
		}
		else
		{ ?>
<tr>
		<td class="banks"><img src="http://www.deal4loans.com/new-images/thnk-idbi.gif" width="86" height="20" /><br /> 
		<? echo $Final_Bid[$i]; ?></td>
		<td class="i-rate" colspan="4">&nbsp;</td>		
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>
		<? }
	}
	elseif($Final_Bid[$i]=="LIC Housing" || $Final_Bid[$i]=="LIC")
	{
	list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	if($licviewLoanAmt>0) 
		{ ?>
	<tr>
	  <td class="banks"><img src="http://www.deal4loans.com/new-images/thnk-lic.gif" width="86" height="20" /><br />  <? echo $Final_Bid[$i]; ?></td>		
	  <td class="i-rate"><?php echo $licinter; ?> %</td>
	  <td class="emi"><?php echo $licemi; ?></td>
	  <td class="tenure"><?php echo $licprint_term; ?> yrs.</td>
	   <td class="loan"><?php echo "Rs.".$licviewLoanAmt; ?></td>
	   <td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>
	<?
		}
	else
		{ ?>
<tr>
	  <td class="banks"><img src="http://www.deal4loans.com/new-images/thnk-lic.gif" width="86" height="20" /><br />  <? echo $Final_Bid[$i]; ?></td>		
	  <td class="i-rate" colspan="4">&nbsp;</td>
	   <td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>
	<? 	}
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
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
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
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
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
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
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
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		  </form></td>
		  </tr>
		<? }
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
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
		</tr>
	  <?
}
else
	{
		if($Final_Bid[$i]=="Citibank" || $Final_Bid[$i]=="Citi Bank")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-citibnk.jpg" width="86" height="20" />';

	}
	elseif($Final_Bid[$i]=="DHFL")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-dhfl.gif" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="Standard Chartered" || (strncmp ("Standard", $Final_Bid[$i],8))==0 )
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-stantc.jpg" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="Reliance capital" || (strncmp ("Reliance", $Final_Bid[$i],8))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-reliance.gif" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="ING VYSYA" || $Final_Bid[$i]=="Ing Vysya" || (strncmp ("ING", $Final_Bid[$i],3))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-ing.gif" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="India Bulls")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-indiabull.gif" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="Kotak Bank" || (strncmp ("Kotak", $Final_Bid[$i],5))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif" width="86" height="20" />';
		
	}
	elseif((strncmp ("Barclays", $Final_Bid[$i],8))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-brclys.jpg" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="Citifinancial")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-citifncl.jpg"" width="86" height="20" />';
		
	}
	elseif($Final_Bid[$i]=="SBI")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-sbi.jpg" width="86" height="20" />';
		
	}
	else
		{
			$bankwimg='&nbsp;';
		}
		?>
		<tr><td class="banks"><? echo $bankwimg;?><br /> 
              <? echo $Final_Bid[$i]; ?></td>
               <td colspan="4" class="i-rate">&nbsp;</td>
                           
<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $Final_Bid[$i]; ?>">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
	<? }
	 } //for ends here 

list($sbiemi,$sbiinter,$sbiprint_term,$sbiloan_amount,$sbiviewLoanAmt,$sbiperlacemi,$sbiterm)=@sbi_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		if($sbiloan_amount>0)
		{
		?>
	<tr align="center">
		<td class="banks"><img src="http://www.deal4loans.com/new-images/hl-thnk-sbi.jpg" width="90" height="40" /><br /> 
		<td class="i-rate"><?php echo $sbiinter; ?> </td>
		<td class="emi"><?php echo $sbiemi; ?></td>
		<td class="tenure"><?php echo $sbiprint_term; ?> yrs.</td>
		<td class="loan"><?php echo "Rs.".$sbiviewLoanAmt; ?></td>
		<td class="info"><form action="apply_hl_consent.php" method="POST" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="SBI">
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
		</form></td>
	</tr>
		 <? }
		?>
	<tr>
            <td colspan="6" align="right" style="font:bold 11px Arial, Helvetica, sans-serif;"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
          </tr>
</table>
</div>
<? }
		else
		{ ?>

		<? } ?>
  </div>
</div>

</body>
</html>
