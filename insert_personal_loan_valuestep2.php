<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
	require 'show_quotecount.php';

	$Msg = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	function getProductCode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;
	return "";
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

$getCompany_Name = $Company_Name;
list($year,$month,$day) = split('[-]', $DOB);
$currentyear=date('Y');
$age=$currentyear-$year;

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
		   $leadid = $_REQUEST['leadid'];
			$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
			$Company_Type = $_REQUEST['Company_Type'];
			$Salary_Drawn = $_REQUEST['Salary_Drawn'];
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$Activation_Code = $_REQUEST['activation_code'];
			$Document_proof=$_REQUEST['Document_proof'];
			$is_permit = $_REQUEST['is_permit'];
			$fullerton_loan = $_REQUEST["fullerton_loan"];			
			$LoanAny = $_REQUEST["LoanAny"];
			$Document_proof_doc=implode(",",$Document_proof);			
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
		
	$getpldetails=ExecQuery("select Employment_Status,CC_Holder,Email,City_Other,City,Company_Name,Name,Net_Salary,DOB,Reference_Code,source From Req_Loan_Personal Where (RequestID='".$leadid."')");	
	$plrow = mysql_fetch_array($getpldetails);
	$getCompany_Name = $plrow['Company_Name'];
	$City = $plrow['City'];
	$Name = $plrow['Name'];
	$DOB = $plrow['DOB'];
	$Net_Salary = $plrow['Net_Salary'];
	$Other_City = $plrow['City_Other'];	
	$Email = $plrow['Email'];
	$Reference_Code = $plrow['Reference_Code'];
	$CC_Holder = $plrow['CC_Holder'];
	$source = $plrow['source'];
	$Employment_Status = $plrow['Employment_Status'];
	$getDOB = str_replace("-","", $DOB);
	$age = DetermineAgeGETDOB($getDOB);
	$monthsalary =$Net_Salary/12;
				
	$crap = $City." ".$Primary_Acc." ".$Years_In_Company." ".$Total_Experience;
	$crapValue = validateValues($crap);

	if($crapValue=="Put")
	{		
	if($leadid>0)
	{														
		$qry="Update Req_Loan_Personal SET Is_Permit='$is_permit',Reference_Code='$reference_code',Company_Type='$Company_Type',PL_EMI_Amt='$PL_EMI_Amt',Primary_Acc='$Primary_Acc', Residential_Status='$Residential_Status' ,Card_Limit= '$Credit_Limit', Years_In_Company='$Years_In_Company', Total_Experience='$Total_Experience',EMI_Paid='$EMI_Paid', Loan_Any='$Loan_A',identification_proof='$Document_proof_doc',Is_Valid='$Is_Valid',Bidderid_Details='$strFinal_Bid',Allocated='$Allocated',Salary_Drawn='$Salary_Drawn',Direct_Allocation=1,HL_Bank='$Activation_Code' Where RequestID=".$leadid;
		$result = ExecQuery($qry);
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

	if($strCity=="Delhi" || $strCity=="Mumbai" || $strCity=="Chennai" || $strCity=="Kolkata" || $strCity=="Bangalore" || $strCity=="Hyderabad" || $strCity=="Pune" || $strCity=="Noida" || $strCity=="Gurgaon" || $strCity=="Gaziabad" || $strCity=="Faridabad" || $strCity=="Thane" || $strCity=="Navi Mumbai")
		{
			if($CC_Holder==1 || $is_permit==1 || ($EMI_Paid>0))
			{
				$permited=1;
			}
				else
			{
				$permited=0;
			}
		}
		else
		{
			$permited=1;
		}

		if($fullerton_loan==1)
		{
			$permited=0;
		}
		
	}//$_POST
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<title>Thank you</title>
<style>
table {border-collapse:collapse;border-spacing:0;}
#bodyCenter #nwcontainer{background:url("/new-images/container-bg.png") repeat-x; clear:both; width:850px; min-height:437px; padding:29px 10px 10px 10px;}
#bodyCenter #nwcontainer p strong{font:bold 14px Arial, Helvetica, sans-serif; color:#000; line-height:18px; clear:both; text-align:center;}
#bodyCenter #nwcontainer p{font:normal 12px Arial, Helvetica, sans-serif; color:#5c5e5e; line-height:18px; clear:both; text-align:center;}
#bodyCenter #nwcontainer #data{clear:both; margin:28px 0 15px 0;}
#bodyCenter #nwcontainer #data table{width:846px; margin:0 auto; position:relative;}
#bodyCenter #nwcontainer #data table tr{}
#bodyCenter #nwcontainer #data table tr th{font:bold 12px Arial, Helvetica, sans-serif; color:#3b5586; background:url("/new-images/li-bg.jpg") repeat-x; height:33px; padding:3px 0 0 0;}
#bodyCenter #nwcontainer #data table tr th.bank{background:url("/new-images/bank-name.png") no-repeat; width:150px;}
#bodyCenter #nwcontainer #data table tr td{border-bottom:2px solid #fff!important; height:80px;}
#bodyCenter #nwcontainer #data table tr td.banks{background:#f1f1f1; width:116px; text-align:center; padding:10px 0 0 0; height:50px; font: 12px Arial, Helvetica, sans-serif;}
#bodyCenter #nwcontainer #data table tr td.i-rate{background:#e7e6e6; text-align:center; font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:149px; }
#bodyCenter #nwcontainer #data table tr td.emi{background:#ececec; text-align:center;font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:161px; padding:0 0 0 5px;}
#bodyCenter #nwcontainer #data table tr td.tenure{text-align:center; font: 14px Arial, Helvetica, sans-serif; color:#706f6f; width:61px; padding:0 0 0 5px; background:url("/new-images/tenure-bg.jpg") repeat-y; text-align:center; }
#bodyCenter #nwcontainer #data table tr td.loan{text-align:left; font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:134px; padding:0 0 0 5px; background:url("/new-images/loan-bg.jpg") repeat-y; text-align:center;}
#bodyCenter #nwcontainer #data table tr td.info{text-align:left; font:14px Arial, Helvetica, sans-serif; color:#bf2228; width:100px; padding:0 0 0 5px; background:url("/new-images/information.jpg") repeat-y; text-align:center;
}
#bodyCenter #nwcontainer #data table tr td.i-pfrate{background:#e7e6e6; text-align:center; font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:100px; }
#bodyCenter #nwcontainer #data table tr td.prepay{background:#ececec; text-align:center;font:14px Arial, Helvetica, sans-serif; color:#706f6f; width:100px; padding:0 0 0 5px;}

@media screen and (max-width: 768px) {#bodyCenter #nwcontainer{background: #E0F2F3; width:100%; min-height:437px; padding:29px 10px 10px 10px;}
}
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto;  height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div id="bodyCenter" align="center">
   <div id="nwcontainer" align="center" style="color:#000000;">
  <p><strong>Dear <? echo $full_name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who have taken quote @deal4loans.com</strong></p>
<?php 
if ($leadid>0)
 {
 $getcompany='select * from pl_company_list where company_name="'.$getCompany_Name.'"';
 //echo $getcompany;
$getcompanyresult = ExecQuery($getcompany);
$grow=mysql_fetch_array($getcompanyresult);
$recordcount = mysql_num_rows($getcompanyresult);
$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$citicategory= $grow["citibank"];
$stanccategory = $grow["standard_chartered"];
$hdbfscategory = $grow["hdbfs"]; 
$ingvyasyacategory = $grow["ingvyasya"]; 
$bajajfinservcategory = $grow["bajajfinserv"]; 
$icici_bankcategory = $grow["icici_bank"]; 
$Indusind = $grow["Indusind"]; 
$kotakcomp = $grow["kotak"];

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

list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$leadid,$strCity);
	$FinalBidder=implode(',',$FinalBidder);
	$FinalBidderarr=explode(',',$FinalBidder);
$cmpBDName="";
for($q=0;$q<count($FinalBidderarr);$q++)
	{
	$getbdnme=ExecQuery('select BankID from Bidders_List where BidderID="'.$FinalBidderarr[$q].'"');
	$bdnm=mysql_fetch_array($getbdnme);
	$getbdnmeex=ExecQuery('select Bank_Name from Bank_Master where BankID="'.$bdnm["BankID"].'"');
	$bdnmbnk=mysql_fetch_array($getbdnmeex);
	$Final_Bid[]=$bdnmbnk["Bank_Name"];
	}
//for capitalfirst
if(($City=="Ahmedabad" || $City=="Bangalore" || $City=="Baroda" || $City=="Vadodara" || $City=="Bhopal" || $City=="Bhubaneswar" || $City=="Bhubneshwar" || $City=="Chandigarh" || $City=="Chennai" || $City=="Coimbatore" || $City=="Cuttack" || $City=="Delhi" || $City=="Ghaziabad" || $City=="Gurgaon" || $City=="Noida" || $City=="Faridabad" || $City=="Hyderabad" || $City=="Indore" || $City=="Jaipur" || $City=="Jalandhar" || $City=="Jodhpur" || $City=="Kolkata" || $City=="Lucknow" || $City=="Ludhiana" || $City=="Mumbai" || $City=="Navi Mumbai" || $City=="Thane" || $City=="Nagpur" || $City=="Nasik" || $City=="Pune" || $City=="Surat" || $City=="Udaipur" || $City=="Vijaywada" || $City=="Vishakapatnam" || $City=="Vizag" || $City=="Madurai" || $City=="Ambala" || $City=="Anand")  && $Net_Salary>=180000 && $Net_Salary<=360000 && $age>=18)
	 {
			$approvedcapitalfirst=1;
	 }

//for capital first

if(count($FinalBidderarr)>0 || $approvedcapitalfirst==1)
	 {
for($i=0;$i<count($FinalBidderarr);$i++)
	{
		if(((strncmp ("Standard", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Standard Chartered")) && $stanccategory=='' && $Primary_Acc!="Standard Chartered")
		{
		}
		elseif(((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton")) && ($Residential_Status!=1 && $Residential_Status!=3 && $Residential_Status!=4 && $Residential_Status!=5))
		{
		}
		else if(((strncmp ("Citibank", $Final_Bid[$i],8))==0 || ($Final_Bid[$i]=="CitiBank")) && ($citicategory=='' && $Primary_Acc!="Citibank"))
		{
		}
		else if(((strncmp ("HDBFS", $Final_Bid[$i],5))==0 || ($Final_Bid[$i]=="HDBFS")) && ($hdbfscategory==''))
		{
		}
		else if(((strncmp ("IngVysya", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="IngVysya")) && (($ingvyasyacategory=='') && ($Company_Type < 4 )))
		{
		}
		else if(((strncmp ("ICICI", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="ICICI Bank")) && ((strncmp("ICICI", $Primary_Acc,5))!=0 && $Net_Salary<300000))
		{
		}
		else if(((strncmp ("INDUS", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="INDUS IND bank")) && (($Indusind=='') && $Net_Salary<480000))
		{
		}
		else if(((strncmp ("Bajaj", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="Bajaj Finserv")) && (($bajajfinservcategory=='') && $Net_Salary<900000))
		{
		}
		else if(((strncmp ("Kotak", $Final_Bid[$i],5))==0 ||  ($Final_Bid[$i]=="Kotak Bank")) && (($kotakcomp=='') && $Net_Salary<480000))
		{
		}
		else if(($Final_Bid[$i]=="HappyRupee") && ($hdfccategory==''))
		{
		}		
		else
		{ 
			if((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
			{
				if((((($Salary_Drawn==2) || ($Salary_Drawn==3)) && $Employment_Status==1) || ($Employment_Status==0)) && $permited==1)
				{
					$shownToBiddersArr[] = trim($Final_Bid[$i]);
					$shownToBidders_Arrbidid[] = $FinalBidderarr[$i];
				}
				else
				{
				}
			}
			else
			{
				$shownToBiddersArr[] = trim($Final_Bid[$i]);
				$shownToBidders_Arrbidid[] = $FinalBidderarr[$i];
			
			}			
		}
	}
	 }
$getarrfinal_bidders=implode(',',$shownToBidders_Arrbidid);
if(strlen($getarrfinal_bidders)>1)
		{
	$Allocated=2;
$qry1="Update Req_Loan_Personal SET Bidderid_Details='".$getarrfinal_bidders."',Allocated='".$Allocated."' Where RequestID=".$leadid;
$result1 = ExecQuery($qry1);
		}
		else
		{
			$product="Personal Loan";	
				$feedback="Not Eligible";
				$plname = $Name;
					include "scripts/feedbackmailerscript.php";

$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= "Bcc: testing4use@gmail.com"."\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					
		if(($feedback=="Not Eligible") && (strlen($Email)>0))
		{
			mail($Email,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
		}

		}

$shownToBiddersArr = @array_unique($shownToBiddersArr);

	$shownToBidders_Arr = "";
			while (list ($key,$val) = @each($shownToBiddersArr)) { 
				$shownToBidders_Arr[]= $val; 
			}
	
for($r=0;$r<count($shownToBidders_Arr);$r++)
		 {
	if(strlen($shownToBidders_Arr[$r])>2)
			 {
	//HDFC Bank
	if(($shownToBidders_Arr[$r]=="HDFC Bank") || ($shownToBidders_Arr[$r]=="HDFC") && $Employment_Status==1)
	{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi,$hdfcprocfee)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);
		if($hdfcgetloanamout>0)
		{
			if($hdfcgetloanamout>1000000)
			{$hdfcprepay="NIL";} else { $hdfcprepay="4%";}
			$hdfcenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_bankemi`, `pl_banktenure`, `pl_loanamount`, `pl_bankpf`, `pl_bankppc`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '".$hdfcinterestrate."', '".$hdfcgetemicalc."', '".$hdfcterm."', '".$hdfcgetloanamout."', '".$hdfcprocfee."', '".$hdfcprepay."', Now())");
		}
		else
			{
				$hdfcenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '100', Now())");
			}
	}
	//ICICI Bank
	elseif((($shownToBidders_Arr[$r]=="ICICI") || ($shownToBidders_Arr[$r]=="ICICI Bank")) && $Employment_Status==1)
	{
		list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi,$iciciprocfee)=icicibank($monthsalary,$getCompany_Name,$icici_bankcategory,$age,$Company_Type,$Primary_Acc);
		if($icicigetloanamout>0)
		{
			$icicienter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_bankemi`, `pl_banktenure`, `pl_loanamount`, `pl_bankpf`, `pl_bankppc`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '".$iciciinterestrate."', '".$icicigetemicalc."', '".$iciciterm."', '".$icicigetloanamout."', '".$iciciprocfee."', '5%', Now())");
		}
		else
			{
				$icicienter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '100', Now())");
			}
	}
	//CItibank
	elseif((($shownToBidders_Arr[$r]=="Citibank") || ($shownToBidders_Arr[$r]=="CitiBank")) && $Employment_Status==1)
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlac,$citiproc_Fee)=citibank($monthsalary,$clubbed_emi,$getCompany_Name,$age,$citicategory);
	if($citigetloanamout>0)
		{
			$citienter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_bankemi`, `pl_banktenure`, `pl_loanamount`, `pl_bankpf`, `pl_bankppc`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '".$citiinterestrate."', '".$citigetemicalc."', '".$cititerm."', '".$citigetloanamout."', '".$citiproc_Fee."', '1%', Now())");
		}
		else
			{
				$citienter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '100', Now())");
			}
	}
	//INdusInd Bank
	elseif((($shownToBidders_Arr[$r]=="INDUS IND bank") || ($shownToBidders_Arr[$r]=="INDUS IND bank")) && $Employment_Status==1)
	{
		list($indusindrate,$indusindloanamt,$indusindemi,$indusindterm,$indusindperlacemi)=@indusindbank($monthsalary,$getCompany_Name,$Indusind,$age,$clubbed_emi);
		if($indusindloanamt>0)
		{
			$INdusenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_bankemi`, `pl_banktenure`, `pl_loanamount`, `pl_bankpf`, `pl_bankppc`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '".$indusindrate."', '".$indusindemi."', '".$indusindterm."', '".$indusindloanamt."', '1% - 2%', '4%', Now())");
		}
		else
			{
				$INdusenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '100', Now())");
			}
	}
	//Fullerton
	elseif(((strncmp ("Fullerton", $shownToBidders_Arr[$r],9))==0 || ($shownToBidders_Arr[$r]=="Fullerton")) && $Employment_Status==1)
	{
		list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
		if($fullertongetloanamout>0)
			{
				$fullertonprepay="4% before 3yr after 3yr 0%";
				$fullertonprofee="2 - 2.5";
				$fullertonenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_bankemi`, `pl_banktenure`, `pl_loanamount`, `pl_bankpf`, `pl_bankppc`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '".$fullertoninterestrate."', '".$fullertongetemicalc."', '".$fullertonterm."', '".$fullertongetloanamout."', '".$fullertonprofee."', '".$fullertonprepay."', Now())");
			}
			else
			{
				$fullertonenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '100', Now())");
			}
	}
	//Kotak Bank
	elseif($shownToBidders_Arr[$r]=="Kotak" || $shownToBidders_Arr[$r]=="Kotak Bank" && $Employment_Status==1)
	{
		list($kotakrate,$kotakloanamt,$kotakemi,$kotakterm,$kotakperlacemi)=kotakbank($monthsalary,$getCompany_Name,$kotakcomp,$age,$Company_Type,$Primary_Acc);
		//echo $monthsalary." - ".$getCompany_Name." - ".$kotakcomp." - ".$age." - ".$Company_Type." - ".$Primary_Acc;
		if(strlen($kotakloanamt)>1)
		{
			$kotakenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_bankemi`, `pl_banktenure`, `pl_loanamount`, `pl_bankpf`, `pl_bankppc`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '".$kotakrate."', '".$kotakemi."', '".$kotakterm."', '".$kotakloanamt."', '1.50% - 2%', '5%', Now())");
		}
		else
		{
			$fullertonenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '100', Now())");
		}
	}
	//HDBFS
	elseif($shownToBidders_Arr[$r]=="HDBFS" && $Employment_Status==1)
	{
		list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= hdbfcLoans ($hdbfscategory, $monthsalary, $Primary_Acc,$age,$PL_EMI_Amt,$Loan_Amount);
		if($getloanamout>0)
			{
				$hdbfsenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_bankemi`, `pl_banktenure`, `pl_loanamount`, `pl_bankpf`, `pl_bankppc`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '".$interestrate."', '".$getemicalc."', '".$term."', '".$getloanamout."', '".$Processing_Fee."', '".$hdbfsprepay."', Now())");
			}
			else
			{
				$hdbfsenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '100', Now())");
			}
	}
	//ING vysya
	elseif(($shownToBidders_Arr[$r]=="IngVysya" || $shownToBidders_Arr[$r]=="ING Vysya") && $Employment_Status==1)
	{	if($Primary_Acc=="IngVysya"){$account_holder = 1;}
		list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= ingVyasyaLoans_nw ($ingvyasyacategory, $monthsalary, $account_holder,$age,$PL_EMI_Amt,$Loan_Amount,$getCompany_Name,$Company_Type);
		if($getloanamout>0)
			{
			$ingvysyaprepay="0%";
				$ingvysyaenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_bankemi`, `pl_banktenure`, `pl_loanamount`, `pl_bankpf`, `pl_bankppc`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '".$interestrate."', '".$getemicalc."', '".$term."', '".$getloanamout."', '".$Processing_Fee."', '".$ingvysyaprepay."', Now())");
			}
		else
			{
				$ingvysyaenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '100', Now())");
			}		
	}
	elseif($shownToBidders_Arr[$r]=="Bajaj Finserv")
				 {
			$bajajenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '15', Now())");
				 }
	else
			 {
				$otherenter=ExecQuery("INSERT INTO pl_quote_shown (`pl_leadid`, `pl_bankname`, `pl_bankrate`, `pl_dated`) VALUES ('".$leadid."', '".$shownToBidders_Arr[$r]."', '100', Now())");		
			 }	
		 }
	}

if(strlen($getarrfinal_bidders)>1 || $approvedcapitalfirst==1)
		 {
?>
<div class="lac-left-box" style="color:#000; text-align:left;">
<span>You are eligible for the below mentioned Banks, They will service you within 24hrs.<br />We at deal4loans.com believe that,it is big financial decision that you
are about to take.<br />
To get best deal, speak to 3 - 4 banks mentioned below and then decide upon the best deal.<br />
This will help you get best deal & save on Emi & choose best product &
best service.<br /><br /></span></div><br>
<div class="overflow-width">
<div id="data" align="center">
<table border="0" cellpadding="2" cellspacing="0" align="center">
<tr>
    <th width="160" class="bank">&nbsp;</th>
    <th width="167">Interest Rate</th>
    <th width="189">Emi (per Month)</th>
    <th width="46">Tenure</th>
    <th width="83">Eligible Loan<br /> 
      Amount</th>
       <th width="100" valign="">Processing Fee</th>
      <th width="100" valign="">Pre-Payment charges</th>
	    <th width="154">Request for more<br /> 
      Information</th>
      </tr>
<? $plshowquotes=ExecQuery("Select * from pl_quote_shown Where pl_leadid=".$leadid." order by pl_bankrate ASC");
while($plquote=mysql_fetch_array($plshowquotes))
		 {
	$shwlogo=ExecQuery("select logo from Bank_Master Where Bank_Name like '%".$plquote["pl_bankname"]."%'");
	$plqtelogo=mysql_fetch_array($shwlogo);
	if(strlen($plqtelogo["logo"])>5)
			 {
	$imagebank ='<img src="/'.$plqtelogo["logo"].'" width="135" height="60"/>';
			 }
			 else
			 {
				$imagebank="";
			 }
	?><tr><?
	if($plquote["pl_bankrate"]=="100.00")
			 { if($plquote["pl_bankname"]=="Citibank")
				 { ?>
				 <td class="banks" style="color:#000000;">&nbsp;&nbsp;<? if(strlen($imagebank)>5) {echo  $imagebank;}else { echo $plquote["pl_bankname"]; } ?></td>
 <td colspan="6" class="i-rate"><ul style="text-align:left;" ><li>Loans up to 30 lakhs *</li>
<li>Transfer your high cost dues & save on your monthly Payout</li>
<li>24X7 online account management</li>
    </ul> <br />* <a href="/citipl-disclaimer.php" target="_blank">T&C apply</a> </td>
	<td class="info">
	 <form action="/get-citibankquote-submit.php" method="GET" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		  <input type="hidden" name="max_loan_amount" value="<?php echo $plquote["pl_loanamount"]; ?>" />
	   <input type="hidden" name="calc_emi" value="<?php echo $plquote["pl_bankemi"]; ?>" />
	    <input type="hidden" name="loan_tenure" value="<?php echo $plquote["pl_banktenure"]; ?>" />
            <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form>
				  </td>
				 <? }
				 elseif($plquote["pl_bankname"]=="Bajaj Finserv" && $Employment_Status==1)
				 { ?>
				 <td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?></td>
					 <td colspan="3" class="i-rate"><ul style="text-align:left;"><li>0% Prepayment Charges (After 1st EMI)</li><li>Part Pre-payment (After 1st EMI)</li>
    <li>Loan Amount - Upto 25 Lacs</li>
    </ul></td>
<td colspan="3" class="i-rate" height="100"><? if(($strCity=='Delhi' || $strCity=='Noida' || $strCity=='Gaziabad' || $strCity=='Gurgaon' || $strCity=='Kolkata' || $strCity=='Chandigarh' || $strCity=='Jaipur' || $strCity=='Mumbai' || $strCity=='Navi Mumbai' || $strCity=='Thane' || $strCity=='Pune' || $strCity=='Ahmedabad' || $strCity=='Surat' || $strCity=='Baroda' || $strCity=='Indore' || $strCity=='Bangalore' || $strCity=='Hyderabad' || $strCity=='Chennai' || $strCity=='Coimbatore' || $strCity=='Vizag' || $strCity=='Cochin' || $strCity=='Faridabad') && strlen($bajajfinservcategory)>1 && $Employment_Status==1) { ?><img src="new-images/get-approval-stamp.png" width="198" height="90" /><br />*Else Cashback of Rs. 1,000/-<? } ?> </td>
<td class="info"><form action="/apply-pl-bajajfinserv4.php" method="GET" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		<input type="hidden" name="loan_amount" id="loan_amount" value="<?php echo $Loan_Amount; ?>" />
	   <input type="hidden" name="name" value="<?php echo $Name; ?>" />
	   <input type="hidden" name="DOB" id="DOB" value="<?php echo $DOB; ?>" />
       <input type="hidden" name="Mobile_Number" id="Mobile_Number" value="<?php echo $Mobile_Number; ?>" />
       <input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
       <input type="hidden" name="company_name" id="company_name" value="<? echo $getCompany_Name; ?>">
	   <input type="hidden" name="salary" id="salary" value="<?php echo $Net_Salary; ?>" />
	    <input type="hidden" name="Email" id="Email" value="<?php echo $Email; ?>" />	  
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td>
				<? }
				 else
				 {
					 ?>
			 
		<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?></td>
		<td colspan="6" class="i-rate">Check this bank offer via phone.</td>
		<td class="info"><form action="/apply_pl_consent.php" method="GET" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form></td>
			 <? 
			 }
			  }			 
			 else
			 {
				 if($plquote["pl_bankname"]=="Citibank")
				 { ?>
				 	<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?></td>
 <td colspan="6" class="i-rate"><ul style="text-align:left;" ><li>Loans up to 30 lakhs *</li>
<li>Transfer your high cost dues & save on your monthly Payout</li>
<li>24X7 online account management</li>
    </ul> <br />* <a href="/citipl-disclaimer.php" target="_blank">T&C apply</a> </td>
	<td class="info">
	 <form action="/get-citibankquote-submit.php" method="GET" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		  <input type="hidden" name="max_loan_amount" value="<?php echo $plquote["pl_loanamount"]; ?>" />
	   <input type="hidden" name="calc_emi" value="<?php echo $plquote["pl_bankemi"]; ?>" />
	    <input type="hidden" name="loan_tenure" value="<?php echo $plquote["pl_banktenure"]; ?>" />
            <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form>
				  </td>
				 <? }
				 elseif($plquote["pl_bankname"]=="Bajaj Finserv" && $Employment_Status==1)
				 { ?>
				 <td class="banks" style="color:#000000;">&nbsp;&nbsp;<? echo  $imagebank; ?></td>
					 <td colspan="3" class="i-rate"><ul style="text-align:left;"><li>0% Prepayment Charges (After 1st EMI)</li><li>Part Pre-payment (After 1st EMI)</li>
    <li>Loan Amount - Upto 25 Lacs</li>
    </ul></td>
<td colspan="3" class="i-rate" height="100"><? if(($strCity=='Delhi' || $strCity=='Noida' || $strCity=='Gaziabad' || $strCity=='Gurgaon' || $strCity=='Kolkata' || $strCity=='Chandigarh' || $strCity=='Jaipur' || $strCity=='Mumbai' || $strCity=='Navi Mumbai' || $strCity=='Thane' || $strCity=='Pune' || $strCity=='Ahmedabad' || $strCity=='Surat' || $strCity=='Baroda' || $strCity=='Indore' || $strCity=='Bangalore' || $strCity=='Hyderabad' || $strCity=='Chennai' || $strCity=='Coimbatore' || $strCity=='Vizag' || $strCity=='Cochin' || $strCity=='Faridabad') && strlen($bajajfinservcategory)>1 && $Employment_Status==1) { ?><img src="new-images/get-approval-stamp.png" width="198" height="90" /><br />*Else Cashback of Rs. 1,000/-<? } ?> </td>
<td class="info"><form action="/apply-pl-bajajfinserv4.php" method="GET" target="_blank" >
		<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		<input type="hidden" name="loan_amount" id="loan_amount" value="<?php echo $Loan_Amount; ?>" />
	   <input type="hidden" name="name" value="<?php echo $Name; ?>" />
	   <input type="hidden" name="DOB" id="DOB" value="<?php echo $DOB; ?>" />
       <input type="hidden" name="Mobile_Number" id="Mobile_Number" value="<?php echo $Mobile_Number; ?>" />
       <input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
       <input type="hidden" name="company_name" id="company_name" value="<? echo $getCompany_Name; ?>">
	   <input type="hidden" name="salary" id="salary" value="<?php echo $Net_Salary; ?>" />
	    <input type="hidden" name="Email" id="Email" value="<?php echo $Email; ?>" />	  
		<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td>
				<? }
				 else
				 {	
					 ?>
		<td class="banks" style="color:#000000;">&nbsp;&nbsp;<? if(strlen($imagebank)>5) {echo  $imagebank;}else { echo $plquote["pl_bankname"]; } ?></td>
		<td class="i-rate"><? if($plquote["pl_bankname"]=="Fullerton") {echo "21% - 32%";} else {echo $plquote["pl_bankrate"]."%";} ?></td>
		<td class="emi">Rs.<? echo $plquote["pl_bankemi"]; ?></td>
		<td class="tenure"><? echo $plquote["pl_banktenure"]; ?> yrs.</td>
		<td class="loan">Rs. <? echo substr(trim($plquote["pl_loanamount"]), 0, strlen(trim($plquote["pl_loanamount"]))-3);  ?></td>
		<td class="i-pfrate"> <? echo $plquote["pl_bankpf"]; ?></td>
		<td class="prepay"> <? echo $plquote["pl_bankppc"]; ?></td>
		<td class="info"><form action="/apply_pl_consent.php" method="GET" target="_blank" >
			 <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		    <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $plquote["pl_bankname"]; ?>">
			<input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
	 </form></td>
		<?	 }
	?>	 
	</tr>
	<?		 }
		 }
		 		  
		  //put capital first here
		 if(($City=="Ahmedabad" || $City=="Bangalore" || $City=="Baroda" || $City=="Vadodara" || $City=="Bhopal" || $City=="Bhubaneswar" || $City=="Bhubneshwar" || $City=="Chandigarh" || $City=="Chennai" || $City=="Coimbatore" || $City=="Cuttack" || $City=="Delhi"  || $City=="Gurgaon" || $City=="Faridabad" || $City=="Hyderabad" || $City=="Indore" || $City=="Jaipur" || $City=="Jalandhar" || $City=="Jodhpur" || $City=="Kolkata" || $City=="Lucknow" || $City=="Ludhiana" || $City=="Pune" || $City=="Surat" || $City=="Udaipur" || $City=="Vijaywada" || $City=="Vishakapatnam" || $City=="Vizag" || $City=="Madurai" || $City=="Ambala" || $City=="Anand")  && $Net_Salary>=180000 && $Net_Salary<=360000 && $age>=18)
		 {			
		?> <tr><td class="banks" style="color:#000000;">&nbsp;&nbsp;<img src="/new-images/thumb/capital-first-logo.jpg" /></td>
					 <td class="i-rate"><? echo "20% (Flat Rate)"; ?></td>
		<td class="emi">Rs.<? echo "2,222/- To Rs.17,778/-"; ?></td>
		<td class="tenure"><? echo "3"; ?> yrs.</td>
		<td class="loan">Rs. <? echo "50,000 To 4,00,000";  ?></td>
		<td class="i-pfrate"> <? echo "2%"; ?></td>
		<td class="prepay"> <? echo "5%"; ?></td>
		<td class="info"><? if($source=="CFL_UAT") 
			 { ?> <form action="/apply-pl-capitalfirst-uat.php" method="POST" target="_blank" ><? } else 
			 { ?>
			  <form action="/apply-pl-capitalfirst.php" method="POST" target="_blank" >
			 <? } ?>
		<input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
		 <input type="hidden" name="name" value="<?php echo $Name; ?>" />      
       <input type="hidden" name="company_name" id="company_name" value="<? echo $getCompany_Name; ?>">
	   <input type="hidden" name="salary" id="salary" value="<?php echo $Net_Salary; ?>" />
	    <input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
				  </form></td></tr>

		 <? } //put capital first end here
	?>
	<tr>
	<td colspan="8" align="right" style="font:bold 11px Arial, Helvetica, sans-serif; height:20px;"><a href="/rate-disclaimer.php" target="_blank" >Disclaimer</a></td>
   </tr>
	</table>
	</div>
    </div>
	<?
	$plshowquotesdel=ExecQuery("Delete from pl_quote_shown Where pl_leadid=".$leadid."");
	$shownToBidders_Str = implode(",",$shownToBidders_Arr);
	$updtepltbl="Update Req_Loan_Personal Set checked_bidders='".$shownToBidders_Str."' where RequestID='".$leadid."'";
 //echo $getcompany;
$updtepltblresult = ExecQuery($updtepltbl);
	 }
	 
	 else
	 { ?>
 <p><strong>We are not able to find any bank for you.Please contact your local bank. We will contact you, if we find any offer for you.</strong></p>
	 <? }
 }
 ?>
  </div> 
</div>
<div style="clear:both; height:15px;"></div>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>