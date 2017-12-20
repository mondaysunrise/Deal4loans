<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functionshttps.php';
	require 'scripts/hlratesnw.php';
	require 'scripts/home_loan_eligibility_function.php';
	require 'getlistofeligiblebidders1.php';
	require 'show_quotecount.php';
	error_reporting();

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
     $ydiff--;
  } elseif ($mdiff==0)
  {
    if ($ddiff < 0)
    {
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
		'Req_Loan_Against_Property' => 'Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

 	$ProductValue = FixString($_POST['ProductValue']);
	$strCity=FixString($_POST['strcity']);
	$Name=FixString($_POST['Name']);
	if(strlen($ProductValue)>1)
	{
		$ProductValue = FixString($_POST['ProductValue']);
		$strCity=FixString($_POST['strcity']);
		$Name=FixString($_POST['Name']);
	}
	else
	{
		$ProductValue = $_SESSION['ProductValue'];
		$strCity=$_SESSION['strcity'];
		$Name=$_SESSION['Name'];
	}


 $sql = "select Mobile_Number,Email,Name,ABMMU_flag, Net_Salary, Co_Applicant_Income, Co_Applicant_Obligation, Total_Obligation, Loan_Amount, DOB, Property_Value, Property_Identified, City, City_Other,source,Employment_Status from Req_Loan_Home where RequestID='".$ProductValue."'";
list($alreadyExist,$myrow)=MainselectfuncNew($sql,$array = array());
$myrowcontr=count($myrow)-1;
	$Net_Salary = $myrow[$myrowcontr]["Net_Salary"];
	$monthly_income = ($Net_Salary /12);
	$co_monthly_income = $myrow[$myrowcontr]["Co_Applicant_Income"];
	$Co_Applicant_Obligation = $myrow[$myrowcontr]["Co_Applicant_Obligation"];
	$obligations = $myrow[$myrowcontr]["Total_Obligation"];
	$getnetAmount = ($monthly_income + $co_monthly_income);
	$loan_amount = $myrow[$myrowcontr]["Loan_Amount"];
	$dateofbirth = $myrow[$myrowcontr]["DOB"];
	$DOB = str_replace("-","", $dateofbirth);
	$age = DetermineAgeFromDOB($DOB);
	$total_obligation  = $obligations + $Co_Applicant_Obligation;
	$property_value = $myrow[$myrowcontr]["Property_Value"];
	$Property_Identified = $myrow[$myrowcontr]["Property_Identified"];
	$netAmount=($getnetAmount - $total_obligation);
	$City =  $myrow[$myrowcontr]["City"];
	$Other_City =  $myrow[$myrowcontr]["City_Other"];
	$ABMMU_flag =  $myrow[$myrowcontr]["ABMMU_flag"];
	$full_name =  $myrow[$myrowcontr]["Name"];
	$Mobile_Number  =  $myrow[$myrowcontr]["Mobile_Number"];
	$Email  =  $myrow[$myrowcontr]["Email"];
	$source  =  $myrow[$myrowcontr]["source"];
	$Employment_Status  =  $myrow[$myrowcontr]["Employment_Status"];
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
	$Dated=ExactServerdate();

$_SESSION['ProductValueHL'] = $ProductValue;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='//fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply Home Loan - Compare interest Rates, Eligibility, Banks and Apply Home Loans online</title>
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India,">
<meta name="description" content="Home Loan apply : Apply for home loans Online and get quotes from all home loan provider of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad, Pune etc.">
<link rel="canonical" href="https://www.deal4loans.com/apply-home-loans.php"/>
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
 <script type="text/javascript" src="scripts/common.js"></script>
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
.data-middle_wrapper{ width:977px; margin:auto; background:#f0f0f0; padding:5px; border:#bababa solid thin; border-radius:10px;}
.inbox-text{ width:99%; margin:auto; background:#0f8eda; padding:10px 5px 10px 5px; font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#FFF; line-height:18px;}
.data-middle_wrapper2{ width:977px; margin:5px auto; padding:5px 0px 0px 0px; background:#fcfbfb;}
.head-font-text{font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#FFF;}
.head-font-text-b{font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#000;}

@media screen and (max-width: 768px) {.data-middle_wrapper{ width:98%; margin:auto; background:#f0f0f0; padding:5px; border:#bababa solid thin; border-radius:10px;}
.data-middle_wrapper2{ width:98%; margin:5px auto; padding:5px 0px 0px 0px; background:#fcfbfb;}
}
-->
</style>
</head>
<body>
<!--top-->
<!--top-->
<!--logo navigation-->
<?php include "middle-menu.php"; ?>
<!--logo navigation-->
<div class="lac-main-wrapper">
<div style="clear:both; height:70px;"></div>
<div>
<div>
<div><strong>Dear <? echo $full_name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who have taken quote @deal4loans.com<br /><br />
    Thanks for applying Home Loan through deal4Loans.com. You will soon receive call from us to help you to find the best deal.</strong><br />
</div>
</div>
<div style="clear:both;"></div>
<div>
<div id="bodyCenter">
 <div id="nwcontainer">
<?php
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);
	$Final_Bid = "";
	while (list ($key,$val) = @each($bankID)) { 
	$Final_Bid[]= $val; 
	} 
	$FinalBidder=implode(',',$FinalBidder);
	$FinalBidderarr = explode(",",$FinalBidder);
	$realbankiD=implode(',',$realbankiD);

//print_r($Final_Bid);
	if(count($FinalBidder)>0)
	{ ?>
    <div class="data-middle_wrapper">
<div class="inbox-text">The below mentioned banks are eager to give you a Home Loan.<br>
  We at deal4loans.com believe that its big financial decision that you are about to take.<br>
  To get best deal, speak to 3-4 banks mentioned below and then decide upon the best deal<br>
  This will help you get best deal &amp; save on Emi &amp; choose best product &amp; best service.<br>
</div>
<div class="data-middle_wrapper2">
<div class="overflow-width">
<table border="0" cellpadding="2" cellspacing="0" align="center" width="100%">
<tr>
  <td width="10%" height="41" align="center" bgcolor="#88a943" class="head-font-text">Bank Name</td>
  <td width="20%" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Interest Rate</td>
  <td width="20%" height="41" align="center" bgcolor="#0172b2" class="head-font-text">EMI(Per Month)</td>
  <td width="20%" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Tenure</td>
  <td width="20%" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Eligible Loan Amount</td>
  <td width="10%" height="41" align="center" bgcolor="#0172b2" class="head-font-text">Request for more <br>
    Information</td>
</tr>
<?

for($i=0;$i<count($Final_Bid);$i++)
	{
		//echo $Final_Bid[$i];
	 if($Final_Bid[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis")
	{		 
		 $axisimg="new-images/slider/thumb/axis.jpg";
		list($axisprocfee,$axisemi,$axisinter,$axisprint_term,$axisviewLoanAmt)  = Axisbank($netAmount,$loan_amount,$age,$total_obligation,$property_value,$Employment_Status);
		if($axisviewLoanAmt>0 && $axisemi>0 && $axisprint_term>0)
		{ 
			$axisqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>"Axis Bank" , "hl_bankrate"=>$axisinter , "hl_bankemi"=>$axisemi , "hl_banktenure"=>$axisprint_term , "hl_loanamount"=>$axisviewLoanAmt , "hl_dated"=>$Dated , "hl_img"=> $axisimg);
			$axisValue = Maininsertfunc("hl_quote_shown", $axisqry);
		}
 	}
	elseif($Final_Bid[$i]=="Bank Of Baroda" || $Final_Bid[$i]=="Bank Of Baroda")
			{
				list($bobprocfee,$bobemi,$bobinter,$bobprint_term,$bobviewLoanAmt) =BankOfBaroda_Homeloan($netAmount,$age,$total_obligation,$property_value); 
			
				if($bobviewLoanAmt>0)
				{
					$bobimg="new-images/slider/thumb/bank-of-baroda.jpg";
					$bobqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>"Bank Of Baroda" , "hl_bankrate"=>"9.50" , "hl_bankemi"=>$bobemi , "hl_banktenure"=>$bobprint_term , "hl_loanamount"=>$bobviewLoanAmt , "hl_dated"=>$Dated , "hl_img"=> $bobimg);
					//print_r($bobqry);
					$bobValue = Maininsertfunc("hl_quote_shown", $bobqry);

				}
			}
	elseif(($Final_Bid[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Bank"))
	{
		 $idbiimg="";
		list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		if($idbiviewLoanAmt>0 && $idbiemi>0 && $idbiprint_term>0)
		{
			$idbiqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$idbiinter , "hl_bankemi"=>$idbiemi , "hl_banktenure"=>$idbiprint_term , "hl_loanamount"=>$idbiviewLoanAmt , "hl_dated"=>$Dated , "hl_img"=> $idbiimg);
			$idbiValue = Maininsertfunc("hl_quote_shown", $idbiqry);
		}		
	}
			elseif($Final_Bid[$i]=="ICICI" || $Final_Bid[$i]=="ICICI Bank")
			{
				list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
				if($iciciviewLoanAmt>0 && $iciciprint_term>0 && $iciciactualemi>0) 
				{
					$iciciimg="new-images/slider/thumb/hfc_logo.jpg";
					$iciciqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$iciciinter , "hl_bankemi"=>$iciciactualemi , "hl_banktenure"=>$iciciprint_term , "hl_loanamount"=>$iciciviewLoanAmt , "hl_dated"=>$Dated , "hl_img"=> $iciciimg);
					$iciciValue = Maininsertfunc("hl_quote_shown", $iciciqry);
				}
			}
			elseif($Final_Bid[$i]=="Citibank" || $Final_Bid[$i]=="Citibank")
			{
				
				list($citiemi,$citiinter,$cititerm,$citiloanamt)=Citibank_hl($netAmount,$age,$property_value,$Employment_Status); 
				if($citiloanamt>0 && $citiemi>0 && $cititerm>0)
				{
					$citiimg="homeimages/logo_citybank.jpg";
					$citiqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$citiinter , "hl_bankemi"=>$citiemi , "hl_banktenure"=>$cititerm , "hl_loanamount"=>$citiloanamt , "hl_dated"=>$Dated , "hl_img"=> $citiimg);
					$citiValue = Maininsertfunc("hl_quote_shown", $citiqry);
				}
			}
			elseif($Final_Bid[$i]=="HDFC" || $Final_Bid[$i]=="HDFC Bank" || $Final_Bid[$i]=="HDFC Ltd")
			{
				$hdfcimg="new-images/slider/thumb/hdfc-h.jpg";
				list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);

			if($hdfcviewLoanAmt>0 && $hdfcemi>0 && $hdfcprint_term>0)
			{	
				$hdfcqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$hdfcinter , "hl_bankemi"=>$hdfcemi , "hl_banktenure"=>$hdfcprint_term , "hl_loanamount"=>$hdfcviewLoanAmt , "hl_dated"=>$Dated , "hl_img"=> $hdfcimg);
					$hdfcValue = Maininsertfunc("hl_quote_shown", $hdfcqry);
			}
			}
			elseif($Final_Bid[$i]=="Fedbank" || (strncmp ("Fedbank", $Final_Bid[$i],7))==0)
			{
				list($federalemi,$federalinter,$federalterm,$federalloanamt) = federal_Homeloannew($getnetAmount,$age,$obligation,$property_value,$loan_amount);
				if($federalloanamt>0 && $federalemi>0 && $federalterm>0)
				{
					$fedbnkimg="new-images/fedbank-nw.jpg";
					$fedbankqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$federalinter , "hl_bankemi"=>$federalemi , "hl_banktenure"=>$federalterm , "hl_loanamount"=>$federalloanamt , "hl_dated"=>$Dated , "hl_img"=> $fedbnkimg);
					$fedValue = Maininsertfunc("hl_quote_shown", $fedbankqry);
				}				
			}
			elseif($Final_Bid[$i]=="PNB Housing Finance" || $Final_Bid[$i]=="Punjab National Bank" || $Final_Bid[$i]=="PNB housing")
			{
				$pnbimg="new-images/pnbhfl-logo1.jpg";
				list($pnbemi,$pnbinter,$pnbterm,$pnbloanamt) = PNB_Homeloan($getnetAmount,$age,$obligation,$property_value);
				if($pnbloanamt>0 && $pnbemi>0 && $pnbterm>0)
				{
					$pnbqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$pnbinter , "hl_bankemi"=>$pnbemi , "hl_banktenure"=>$pnbterm , "hl_loanamount"=>$pnbloanamt , "hl_dated"=>$Dated , "hl_img"=> $pnbimg);
					$pnbvalue = Maininsertfunc("hl_quote_shown", $pnbqry);
				}			
			}
			elseif($Final_Bid[$i]=="Tata Capital" || $Final_Bid[$i]=="TATA Capital")
			{
				$tataimg="new-images/tatacapital_pllogo.jpg";
				list($tataprocfee,$tataemi,$tatainter,$tataterm,$tataloanamt) = TATACapital_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$property_value,$Employment_Status);
				if($tataloanamt>0 && $tataloanamt>200000 && $tataemi>0 && $tataterm>0)
				{
					$tataqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$pnbinter , "hl_bankemi"=>$tataemi , "hl_banktenure"=>$tataterm , "hl_loanamount"=>$tataloanamt , "hl_dated"=>$Dated , "hl_img"=> $tataimg);
					$tatavalue = Maininsertfunc("hl_quote_shown", $tataqry);
				}			
			}
			elseif($Final_Bid[$i]=="SBI")
			{
				$sbiimg="new-images/sbi-logo-quote.jpg";
				list($sbiprocfee,$sbiemi,$sbiinter,$sbiterm,$sbiloanamt,$sbiterm) = sbi_homeloan($netAmount,$loan_amount,$age,$obligations,$City,$property_value);
				if($sbiloanamt>300000 && $sbiterm>0 && $sbiemi>0)
				{
					$sbiqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$sbiinter , "hl_bankemi"=>$sbiemi , "hl_banktenure"=>$sbiterm , "hl_loanamount"=>$sbiloanamt , "hl_dated"=>$Dated , "hl_img"=> $sbiimg);
					$sbivalue = Maininsertfunc("hl_quote_shown", $sbiqry);
				}			
			}
			elseif($Final_Bid[$i]=="LIC Housing")
			{
				$licimg="new-images/lichfl_oct2015.jpg";
				list($licprocfee,$licemi,$licinter,$licpterm,$licloanamt,$licterm) = lic_homeloan($netAmount,$loan_amount,$age,$obligations,$City,$property_value);
				if($licloanamt>100000 && $licterm>0 && $licemi>0)
				{
					$licqry=array("hl_leadid"=>$ProductValue , "hl_bankname"=>$Final_Bid[$i] , "hl_bankrate"=>$licinter , "hl_bankemi"=>$licemi , "hl_banktenure"=>$licpterm , "hl_loanamount"=>$licloanamt , "hl_dated"=>$Dated , "hl_img"=> $licimg);
					$licvalue = Maininsertfunc("hl_quote_shown", $licqry);
				}			
			}
			elseif($Final_Bid[$i]=="Shubham Housing Finance")
			{//echo "i m here";
				list($shfmemi,$shfinter,$shfterm,$shfloanamt) = shubham_housing($getnetAmount,$age,$obligation,$property_value,$loan_amount);
				if($shfloanamt>=25000 && $shfterm>0 && $shfmemi>0)
				{
					$licqry=ExecQuery("INSERT INTO hl_quote_shown (`hl_leadid`, `hl_bankname`, `hl_bankrate`, `hl_bankemi`, `hl_banktenure`, `hl_loanamount`, `hl_dated`, hl_img) VALUES ('".$ProductValue."', '".$Final_Bid[$i]."', '".$shfinter."', '".$shfmemi."', '".$shfterm."', '".$shfloanamt."', Now(),'')");
				}	
			}
			else
			{ 	} 
			} 
			
			//for ends here 
			$hlshowquotes="Select * from hl_quote_shown Where (hl_leadid=".$ProductValue.") order by hl_loanamount DESC";
			list($hlquotecount,$hlquote)=MainselectfuncNew($hlshowquotes,$array = array());
			
			$cntr=0;
			if($hlquotecount>0)
			{
			while($cntr<count($hlquote))
			{
			if(strlen($hlquote[$cntr]["hl_bankname"])>2)
					 {
				$deselect.= $hlquote[$cntr]["hl_bankname"].",";
					 }
			if(strlen($hlquote[$cntr]["hl_img"])>5)
					 {
			$imagebank ='<img src="/'.$hlquote[$cntr]["hl_img"].'"/>';
					 }
					 else
					 {
				$imagebank=$hlquote[$cntr]["hl_bankname"];
					 }					
			?>
			<tr>
			 <td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><? echo $imagebank; ?></td>		  
			  <td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><?php 
			if($hlquote[$cntr]["hl_bankname"]=="Bank Of Baroda" || $hlquote[$cntr]["hl_bankname"]=="Bank Of Baroda")
					 {
						echo "9.05% - 9.55";
					 }
					 else
					 {
			echo $hlquote[$cntr]["hl_bankrate"]; } ?> %</td>
			   <td align="center" bgcolor="#ececec" class="head-font-text-b"><?php 
			   if($hlquote[$cntr]["hl_bankname"]=="Bank Of Baroda" || $hlquote[$cntr]["hl_bankname"]=="Bank Of Baroda")
					 {
						$loan_amount=$hlquote[$cntr]["hl_loanamount"];
						$term=$hlquote[$cntr]["hl_banktenure"]*12;
						$interestrate1=9.05/1200;
						$interestrate2=9.55/1200;
						$actualemi1 = round($loan_amount * $interestrate1 / (1 - (pow(1/(1 + $interestrate1),$term))),0);
						$actualemi2 = round($loan_amount * $interestrate2 / (1 - (pow(1/(1 + $interestrate2),$term))),0);
						echo $bobemi = "Rs.".$actualemi1." - Rs.".$actualemi2;
					 }
					 else
					 {
			   if(strlen($hlquote[$cntr]["hl_bankemi"])>2) { echo "Rs.".round($hlquote[$cntr]["hl_bankemi"]);} else { echo "N.A";} }?> </td>
			  <td align="center" bgcolor="#dedede" class="head-font-text-b"><?php if($hlquote[$cntr]["hl_banktenure"]>0) { echo $hlquote[$cntr]["hl_banktenure"]."yrs";} else { echo "N.A";} ?> </td>
			  <td align="center" bgcolor="#d1d1d1" class="head-font-text-b"><?php if($hlquote[$cntr]["hl_loanamount"]>1) { echo "Rs.".abs($hlquote[$cntr]["hl_loanamount"]);} else { echo "N.A";} ?></td>
			 <td align="center" bgcolor="#e2e2e2">
			  <? if(($hlquote[$cntr]["hl_bankname"]=="Axis Bank" || $hlquote[$cntr]["hl_bankname"]=="Axis") && in_array("5651", $FinalBidderarr, true))
					 {

				?>
				<form action="/apply_axishl_consent.php" method="POST" target="_blank" >
				<input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
				<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $hlquote[$cntr]["hl_bankname"]; ?>">
				<input type="hidden" name="bidderid" id="bidderid" value="5651">
				<input type="hidden" name="urltype" id="urltype" value="https">
				<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
				</form>
				<?	 }
					 else
					 { ?>
			  <form action="/apply_hl_httpsconsent.php" method="POST" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
			<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo  $hlquote[$cntr]["hl_bankname"]; ?>">
			<input name="image" type="image" src="/new-images/th-apply-btn.png" width="75" height="28" tabindex="14"/>
			</form>
			<? } ?>
			  </td>
		  </tr>
			<?	 $cntr=$cntr+1;}
		}
			$deselect = substr(trim($deselect), 0, strlen(trim($deselect))-1);
			$deslectarr = explode(",",$deselect);
			$str="";
			for($p=0;$p<count($deslectarr);$p++)
				{	
				if((count($deslectarr)) - $p==1)
					{				
						$str.= "bank_name not like '%".$deslectarr[$p]."%'";
					}
					else
					{
					$str.= "bank_name not like '%".$deslectarr[$p]."%' and ";
					}
				}
				
				$finalstr="(".$str.")";
			$restOfBanks="Select * from home_loan_interest_rate_chart Where (".$finalstr." and flag=1) group by bank_name";
			list($rstbnkcount,$rstbnk)=MainselectfuncNew($restOfBanks,$array = array());
			$cntr2=0;
			if($rstbnkcount>0)
			{
				while($cntr2<count($rstbnk))
				{  
					list($bnkhlrates)=bankrates($rstbnk[$cntr2]["bank_name"],$loan_amount,$age);
					if(strlen($bnkhlrates)>2)
					{
							if($rstbnk[$cntr2]["bank_name"]=="Citibank")
							{ ?>
								<tr>
								<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><? echo $rstbnk[$cntr2]["bank_name"]; ?></td>		
								<td align="center" bgcolor="#e6e6e6" class="head-font-text-b" colspan="4">9.85% - 9.95%		</td>
								<td align="center" bgcolor="#e2e2e2"></td>
								</tr>
							 <? }
							else
							{
							?>
								<tr>
								<td height="67" align="center" bgcolor="#f1f1f1" class="head-font-text-b"><? echo $rstbnk[$cntr2]["bank_name"]; ?></td>
								<td align="center" bgcolor="#e6e6e6" class="head-font-text-b"><? echo $bnkhlrates; ?></td>
								<td align="center" bgcolor="#ececec" class="head-font-text-b">N.A</td>
								<td align="center" bgcolor="#dedede" class="head-font-text-b">N.A</td>
								<td align="center" bgcolor="#d1d1d1" class="head-font-text-b">N.A</td>	
								<td align="center" bgcolor="#e2e2e2"></td>
								</tr>
							<? }
						}
					$cntr2=$cntr2+1;
					}
				}
				//echo "imhere".$deselect."<br>";
				?>			
				</table>
				</div>            
				</div>
				<?  $hlshowquotesdel="Delete from hl_quote_shown Where hl_leadid=".$ProductValue; 
					Maindeletefunc($hlshowquotesdel,$array = array());
				}
						else
		{ }?>
         </div>         
         <div style="margin-top:15px;">
         <table width="100%" border="1" align="center" cellpadding="2" cellspacing="0" bgcolor="#e6edfd"><tr><td width="20%" rowspan="2" align="center" style="border:1px #FFFFFF solid;" ><table ><tr><td height="10">&nbsp;</td></tr><tr><td style="color:#000000; font-size:18px; ">Connect With Us</td></tr></table></td><td width="208" height="30" align="center" style=" color:#000000; font-size:14px; border:1px #666666 solid; border-top:1px #FFFFFF solid;"><b>Facebook</b></td><td width="169" align="center" style="color:#000000; font-size:14px; border-bottom:1px #666666 solid; "><b>Google +</b></td><td width="117" align="center" style="color:#000000; font-size:14px; border:1px #666666 solid; border-top:1px #FFFFFF solid; border-right:1px #FFFFFF solid;"><b>Twitter</b></td></tr><tr><td height="40" style="padding-left:20px; padding-top:10px; color:#000000; border:1px #666666 solid;"><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font=tahoma&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></td><td align="center" style="padding-left:20px; color:#000000; border:1px #666666 solid;"><!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-size="medium" data-href="https://plus.google.com/117667049594254872720"></div>
</td><td align="center" height="40" style="padding-left:20px; border:1px #666666 solid; border-right:1px #FFFFFF solid;"><a href="https://twitter.com/deal4loans" class="twitter-follow-button" data-show-count="false">Follow @deal4loans</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></td></tr></table></div>
<!-- Place this tag where you want the +1 button to render. -->
<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</div>
</div>
<div style="clear:both;"></div>
  <div class="content_c_mobo"> 
  <div style="margin-top:25px;" class="content_section_below"><span class="text11" style="color:#4c4c4c; width:100%;  margin-top:10px;"><b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br />
Banks/ Financial Institutions can contact us at <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates. </span></div>  
  </div>
</div>
</div></div><br />
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6880092259094596"
     data-ad-slot="2010764844"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>