<?php
//Less than 2.4 lacs
//ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function_form.php';

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

//	print_r($_POST);
	if ($_REQUEST['RequestID']> 0)
	{
		    $leadid = $_REQUEST['RequestID'];
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
			$Document_proof=$_REQUEST['Document_proof'];
			$CC_Holder = $_REQUEST['CC_Holder'];
			$Card_Vintage = $_REQUEST['Card_Vintage'];
			$Day=$_REQUEST['day'];
			$Month=$_REQUEST['month'];
			$Year=$_REQUEST['year'];
			$DOB=$Year."-".$Month."-".$Day;
			$Pincode = $_REQUEST['Pincode'];
			$Company_Name = $_REQUEST['Company_Name'];
			$Employment_Status = $_REQUEST['Employment_Status'];
			$City_Other = $_REQUEST['City_Other'];
			$Document_proof_doc=implode(",",$Document_proof);
			$reference_code=$_SESSION['cap_code'];
			$is_permit = $_REQUEST['is_permit'];
			$LoanAny = $_REQUEST['LoanAny'];
			$Pincode = $_REQUEST['Pincode'];
			$CC_Holder = $_REQUEST['CC_Holder'];
			$Card_Vintage = $_REQUEST['Card_Vintage'];
			
			if($_POST['captcha'] == $_SESSION['cap_code'])
			{
				$Is_Valid=1;
			}
			else
			{
				$Is_Valid=0;
			}
	
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
			
			$crap = $Primary_Acc." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{
				if($leadid>0)
				{														
					$dataUpdate = array('Is_Permit'=>$is_permit, 'Reference_Code'=>$reference_code, 'Company_Type'=>$Company_Type, 'PL_EMI_Amt'=>$PL_EMI_Amt, 'Primary_Acc'=>$Primary_Acc, 'Residential_Status'=>$Residential_Status, 'Card_Limit'=>$Credit_Limit, 'Years_In_Company'=>$Years_In_Company, 'Total_Experience'=>$Total_Experience, 'EMI_Paid'=>$EMI_Paid, 'Loan_Any'=>$Loan_A, 'identification_proof'=>$Document_proof_doc, 'Is_Valid'=>$Is_Valid, 'Bidderid_Details'=>$strFinal_Bid, 'Allocated'=>$Allocated, 'Salary_Drawn'=>$Salary_Drawn, 'Direct_Allocation'=>'1', 'HL_Bank'=>$Activation_Code, 'DOB'=>$DOB, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'Pincode'=>$Pincode);
					$wherecondition = "(RequestID=".$leadid.")";
					Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
				}
			}//$crap Check
			else if($crapValue=='Discard')
			{
				//	header("Location: Redirect.php");
				//exit();
			}
			else
			{
				//header("Location: Redirect.php");
				//exit();
			}

	$getpldetails = "select Email,City_Other,City,Company_Name,Name,Net_Salary,DOB,Reference_Code From Req_Loan_Personal Where (RequestID='".$leadid."')";
list($plrowrecordcount, $plrow)=MainselectfuncNew($getpldetails,$array = array());
	$plrowcontr = count($plrow)-1;
$getCompany_Name = $plrow[$plrowcontr]['Company_Name'];
$City = $plrow[$plrowcontr]['City'];
$Name = $plrow[$plrowcontr]['Name'];
$DOB = $plrow[$plrowcontr]['DOB'];
$Net_Salary = $plrow[$plrowcontr]['Net_Salary'];
$Other_City = $plrow[$plrowcontr]['City_Other'];	
$Email = $plrow[$plrowcontr]['Email'];
$Reference_Code = $plrow[$plrowcontr]['Reference_Code'];

$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);

$monthsalary =$Net_Salary/12;


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
	
	if($strCity=="Delhi" || $strCity=="Mumbai" || $strCity=="Chennai" || $strCity=="Kolkata" || $strCity=="Bangalore" || $strCity=="Hyderabad" || $strCity=="Pune" || $strCity=="Noida" || $strCity=="Gurgaon" || $strCity=="Gaziabad" || $strCity=="Faridabad" || $strCity=="Thane" || $strCity=="Navi Mumbai")
		{
			if($CC_Holder==1 || $is_permit==1 || ($LoanAny==1 && $EMI_Paid>0))
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
		
	}//$_POST
	
	
	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
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
	overflow-x: hidden;
	background-color: #FFF;
}
.red {
	color: #F00;
}
-->
</style>
<style>
table {
	border-collapse: collapse;
	border-spacing: 0;
}
#bodyCenter #nwcontainer {
	background: url("http://www.deal4loans.com/new-images/container-bg.png") repeat-x;
	clear: both;
	width: 850px;
	min-height: 437px;
	padding: 29px 10px 10px 10px;
}
#bodyCenter #nwcontainer p strong {
	font: bold 14px Arial, Helvetica, sans-serif;
	color: #000;
	line-height: 18px;
	clear: both;
	text-align: center;
}
#bodyCenter #nwcontainer p {
	font: normal 12px Arial, Helvetica, sans-serif;
	color: #5c5e5e;
	line-height: 18px;
	clear: both;
	text-align: center;
}
#bodyCenter #nwcontainer #data {
	clear: both;
	margin: 28px 0 15px 0;
}
#bodyCenter #nwcontainer #data table {
	width: 846px;
	margin: 0 auto;
	position: relative;
}
#bodyCenter #nwcontainer #data table tr {
}
#bodyCenter #nwcontainer #data table tr th {
	font: bold 12px Arial, Helvetica, sans-serif;
	color: #3b5586;
	background: url("http://www.deal4loans.com/new-images/li-bg.jpg") repeat-x;
	height: 33px;
	padding: 3px 0 0 0;
}
#bodyCenter #nwcontainer #data table tr th.bank {
	background: url("http://www.deal4loans.com/new-images/bank-name.png") no-repeat;
	width: 116px;
}
#bodyCenter #nwcontainer #data table tr td {
	border-bottom: 2px solid #fff!important;
	height: 80px;
}
#bodyCenter #nwcontainer #data table tr td.banks {
	background: #f1f1f1;
	width: 116px;
	text-align: center;
	padding: 30px 0 0 0;
	height: 50px;
	font: bold 10px Arial, Helvetica, sans-serif;
}
#bodyCenter #nwcontainer #data table tr td.i-rate {
	background: #e7e6e6;
	text-align: center;
	font: bold 11px Arial, Helvetica, sans-serif;
	color: #706f6f;
	width: 149px;
}
#bodyCenter #nwcontainer #data table tr td.emi {
	background: #ececec;
	text-align: center;
	font: bold 11px Arial, Helvetica, sans-serif;
	color: #706f6f;
	width: 161px;
	padding: 0 0 0 5px;
}
#bodyCenter #nwcontainer #data table tr td.tenure {
	text-align: center;
	font: bold 12px Arial, Helvetica, sans-serif;
	color: #706f6f;
	width: 61px;
	padding: 0 0 0 5px;
	background: url("http://www.deal4loans.com/new-images/tenure-bg.jpg") repeat-y;
	text-align: center;
}
#bodyCenter #nwcontainer #data table tr td.loan {
	text-align: left;
	font: bold 12px Arial, Helvetica, sans-serif;
	color: #706f6f;
	width: 134px;
	padding: 0 0 0 5px;
	background: url("http://www.deal4loans.com/new-images/loan-bg.jpg") repeat-y;
	text-align: center;
}
#bodyCenter #nwcontainer #data table tr td.info {
	text-align: left;
	font: bold 13px Arial, Helvetica, sans-serif;
	color: #bf2228;
	width: 100px;
	padding: 0 0 0 5px;
	background: url("http://www.deal4loans.com/new-images/information.jpg") repeat-y;
	text-align: center;
}
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="margin:auto; width:70%; margin-top:70px; height:5px; background-color:#88a943; margin-top:1px;"></div>
<div style="margin:auto; width:70%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;">Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto;">
  <div id="bodyCenter" align="center">
    <div id="nwcontainer" align="center">
      <p><strong>Thanks for applying Personal Loan through Deal4loans.com. </strong></p>
      <?php 
if($Is_Valid==1)
		{
	//echo "entered";
	//echo "<br>";
list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Personal",$leadid,$strCity);
$arrFinal_Bid = "";
		while (list ($key,$val) = @each($FinalBidder)) { 
			$arrFinal_Bid[]= $val; 
		} 

$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			} 

	$strFinal_Bid=implode(',',$arrFinal_Bid);

	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);



if($leadid>0 && ((strlen($strFinal_Bid)>0) && (($Salary_Drawn==2) || ($Salary_Drawn==3))) && $permited==1)
	{

$arrfinal_bidders="";
$getbankid="";
for($i=0;$i<count($arrFinal_Bid);$i++)
		{	
			if(((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton")) && ($Residential_Status==1 || $Residential_Status==3 || $Residential_Status==4 || $Residential_Status==5))
			{
				$arrfinal_bidders[]=$arrFinal_Bid[$i];
				$getbankid[]=$Final_Bid[$i];
			}
			else if(((strncmp ("Citifinancial", $Final_Bid[$i],12))==0 || ($Final_Bid[$i]=="Citifinancial")))
			{
				$arrfinal_bidders[]=$arrFinal_Bid[$i];
				$getbankid[]=$Final_Bid[$i];
			}
			

		}
		//print_r($arrfinal_bidders);
		//print_r($getbankid);


		$getarrfinal_bidders=implode(',',$arrfinal_bidders);

	if(strlen($getarrfinal_bidders)>0)
	{
	$Allocated=2;
	}
	else 
	{
		$Allocated=0;
	}

if(strlen($getarrfinal_bidders)>1)
		{

//$qry1="Update Req_Loan_Personal SET Bidderid_Details='".$getarrfinal_bidders."',Allocated='".$Allocated."' Where RequestID=".$leadid;
//$result1 = ExecQuery($qry1);
$dataUpdate = array('Bidderid_Details'=>$getarrfinal_bidders, 'Allocated'=>$Allocated);
$wherecondition = "(RequestID=".$leadid.")";
Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);

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
	//		mail($Email,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
		}

		}

		
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
		//	mail($Email,'Thanks for Registering for '.$product.' on deal4loans.com', $Message, $headers);
		}

			}
		}

	

if ($leadid>0 && $Is_Valid==1 && (($Salary_Drawn==2) || ($Salary_Drawn==3)) && $permited==1)
 {?>
      <?

 $getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered from pl_company_list where company_name="'.$getCompany_Name.'"';
list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
$growcontr = count($grow)-1;

$hdfccategory= $grow[$growcontr]["hdfc_bank"];
$fullertoncategory= $grow[$growcontr]["fullerton"];
$citicategory= $grow[$growcontr]["citibank"];
$barclayscategory= $grow[$growcontr]["barclays"];
$stanccategory = $grow[$growcontr]["standard_chartered"];

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


if(count($FinalBidder)>0 && (strlen($strFinal_Bid)>1))
	 {
	?>
      <div align="center" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; line-height:22px; color:#000000;"><b>Your application has been scanned under below mentioned Banks for Personal Loan Eligibility:<br />
        <table>
          <tr>
            <td style="color:#000000;">&nbsp; 1) &nbsp;</td>
            <td width="97"><img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" height="26"/></td>
            <td style="color:#000000;">&nbsp;&nbsp; 2) &nbsp;</td>
            <td width="86"><img src="http://www.deal4loans.com/new-images/thnk-axis.gif" /></td>
            <td  style="color:#000000;">&nbsp;&nbsp; 3) &nbsp;</td>
            <td width="74"><img src="http://www.deal4loans.com/new-images/thnk-citibnk.jpg" /></td>
            <td style="color:#000000;">&nbsp;&nbsp; 4) &nbsp;</td>
            <td width="56"><img src="http://www.deal4loans.com/new-images/thnk-stanc.jpg" /></td>
            <td style="color:#000000;">&nbsp;&nbsp;5)&nbsp;</td>
            <td width="103"><img src="http://www.deal4loans.com/new-images/thnk-barclays.jpg" /></td>
            <td style="color:#000000;">&nbsp;&nbsp;6)&nbsp;</td>
            <td width="100"><img src="http://www.deal4loans.com/new-images/hl-thnk-sbi.jpg" width="100" height="35" /></td>
          </tr>
        </table>
        <font style="color:#000000;">--------------------------------------------------------------------------------------------------------------------------------------------<br />
        </font> We have found as per your details you are eligibile for :<br />
        <br />
        </b></div>
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
   
if(count($FinalBidder)>0)
	 {
	?>
          <?
$getrespf="";
$getrespf="";
$getidpf="";
$actual_ident_proof="";
$actual_residence_proof="";
$actual_income_proof="";
$getinpf="";
$getdocpf="";
for($i=0;$i<count($arrfinal_bidders);$i++)
			{
	if(((strncmp ("Standard", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Standard Chartered")) && $stanccategory=='')
	{

	}
	else if(((strncmp ("Citibank", $Final_Bid[$i],8))==0 ||  ($Final_Bid[$i]=="Citibank")) && $citicategory=='')
	{

	}
	else
				{ $shownToBidders_Arr[] = $Final_Bid[$i];
//echo $Final_Bid[$i];
		//
		$getdoc="select document_proof,identification_proof,residence_proof,income_proof from bank_documents_required where bank_name like '%".$Final_Bid[$i]."%'";
		//echo "select identification_proof,residence_proof,income_proof from bank_documents_required where bank_name like '%".$Final_Bid[$i]."%'";
		list($recordcount,$myrow)=MainselectfuncNew($getdoc,$array = array());
		$myrowcontr = count($myrow)-1;
	if($recordcount>0)
	{
		$identification_prf=$myrow[$myrowcontr]["identification_proof"];
		$residence_prf=$myrow[$myrowcontr]["residence_proof"];
		$income_prf=$myrow[$myrowcontr]["income_proof"];
		$document_prf=$myrow[$myrowcontr]["document_proof"];
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
	if(($getbankid[$i]=="HDFC Bank") || ($getbankid[$i]=="HDFC"))
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" />';
	}
else if((strncmp ("Fullerton", $getbankid[$i],9))==0 || ($getbankid[$i]=="Fullerton"))
		{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-fulrtn.jpg" />';
	}
	else if($getbankid[$i]=="Kotak")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif"  />';

	}
	else if($getbankid[$i]=="Citibank")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-citibnk.jpg" />';
	
	}
	else if($getbankid[$i]=="Barclays Finance" || (strncmp ("Barclays", $getbankid[$i],8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-barclays.jpg"/>';
	
	}
	else if($getbankid[$i]=="Standard Chartered" || (strncmp ("Standard", $getbankid[$i],8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-stanc.jpg"/>';
	
	}
	else
		{
		$imagebank='';
		}
	
	?>
            <td class="banks">&nbsp;&nbsp;<? echo  $imagebank; ?><br /></td>
            <? if(($getbankid[$i]=="HDFC Bank") || ($getbankid[$i]=="HDFC"))
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
            <td colspan="4" class="i-rate" >Check this bank offer via phone</td>
            <?	}
		//echo "<a href='/hdfc-personal-loan-eligibility.php' target='_blank'>Know More</a>";	
	}
	else if((strncmp ("Fullerton", $getbankid[$i],9))==0 || ($getbankid[$i]=="Fullerton"))
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
            <td colspan="4" class="i-rate" >Check this bank offer via phone</td>
            <? }
		
	}
	elseif($Final_Bid[$i]=="Kotak")
	{
	?>
            <td colspan="4" class="i-rate" >Check this bank offer via phone</td>
            <? //echo "<a href='/kotak-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif((($getbankid[$i]=="CITIBANK") ||  ($getbankid[$i]=="Citibank")) && (strlen($citicategory)>0))
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlacemi)=citibank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$age,$citicategory,$getCompany_Name);
	if($citigetloanamout>0)
		{
		?>
            <td class="i-rate"><? echo $citiinterestrate; ?></td>
            <td class="emi">Rs. <? echo $citigetemicalc; ?></td>
            <td class="tenure"><? echo $cititerm; ?> yrs.</td>
            <td class="loan">Rs. <? echo $citigetloanamout; ?></td>
            <?
		}
	else
		{
		?>
            <td colspan="4" class="i-rate" >Check this bank offer via phone</td>
            <? }

	}
	elseif($getbankid[$i]=="Barclays")
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
            <td colspan="4" class="i-rate" >Check this bank offer via phone</td>
            <? }
	}
	else
	{
	?>
            <td colspan="4" class="i-rate" >Check this bank offer via phone</td>
            <? 
		
	}
	?>
            <td width="141"><?php
	
	if((strncmp ("Fullerton", $getbankid[$i],9))==0 || ($getbankid[$i]=="Fullerton"))
		{
		
    ?>
              <form action="get-instantquote-submit.php" method="POST" target="_blank" >
                <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
                <input type="hidden" name="max_loan_amount" value="<?php echo $fullertongetloanamout ; ?>" />
                <input type="hidden" name="calc_emi" value="<?php echo $fullertongetemicalc ; ?>" />
                <input type="hidden" name="loan_tenure" value="<?php echo $fullertonterm ; ?>" />
                <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $getbankid[$i]; ?>">
                <input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
              </form>
              <?php
	}
	else
	{
	?>
              <form action="apply_pl_consent.php" method="POST" target="_blank" >
                <input type="hidden" name="pl_requestid" value="<? echo $leadid; ?>" id="pl_requestid">
                <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $getbankid[$i]; ?>">
                <input type="submit" style="width: 49px; height: 20px; border: 0px none ; cursor:pointer; background-image: url(/new-images/apl-yelo-nw.jpg); margin-bottom: 0px; margin-top:10px; background-repeat:no-repeat; background-color:#FFFFFF;" value=""  />
              </form>
              <?php } ?></td>
          </tr>
          <?
			}} ?>
          <tr>
            <td colspan="6" align="right" style="font:bold 11px Arial, Helvetica, sans-serif;"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
          </tr>
        </table>
      </div>
      <? 	$shownToBidders_Str = implode(",",$shownToBidders_Arr);
		$DataArray = array("checked_bidders"=>$shownToBidders_Str );
		$wherecondition ="(RequestID=".$leadid.")";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
}
 	 }
	 else
	 {?>
      <div align="center" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; line-height:22px; color:#000000; font-weight:bold;">As per your profile, no bank is associated with us to serve your Personal loan requirement.</div>
      <div align="center" style=" clear:both; padding:20px; "> 
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
</script></div>
      <? }

      }
	  else 
	  { ?>
      <div align="center" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; line-height:22px; color:#000000; font-weight:bold;">As per your profile, no bank is associated with us to serve your Personal loan requirement.</div>
      <div align="center" style=" clear:both; padding:20px; "> 
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
</script></div>
      <? } ?>
    </div>
  </div>
</div>
</div>
<div style="clear:both; height:15px;"></div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>