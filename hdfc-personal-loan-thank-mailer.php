<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders_test.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
	//print_r($_POST);
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

HdfcThank_mailer ();
//$monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City;

//$="select Net_Salary,Company_Name,DOB,City,PL_EMI_Amt";

function HdfcThank_mailer()
{
$query="Select * from Req_Compaign Where (Reply_Type=1 and Bank_Name='HDFC PL' and BidderID=1908)";
	list($num,$row1)=MainselectfuncNew($query,$array = array());
	 $requestid= $row1[0]["RequestID"];
	 $requestid = 1427;
	 
	if((strlen(trim($requestid))<=0))
	{
		$search_query="SELECT * FROM hdfc_pl_calc_leads,Req_Loan_Personal WHERE hdfc_pl_calc_leads.hdfcplid= Req_Loan_Personal.Referrer and (hdfc_pl_calc_leads.Dated >='2011-02-18 00:00:00') ORDER BY hdfc_pl_calc_leads.mobile_number ASC ";
	}
	else
	{
		$search_query="SELECT * FROM hdfc_pl_calc_leads,Req_Loan_Personal WHERE hdfc_pl_calc_leads.hdfcplid= Req_Loan_Personal.Referrer and hdfc_pl_calc_leads.hdfcplid='".$requestid."'and (hdfc_pl_calc_leads.Dated >='2011-02-18 00:00:00') ORDER BY hdfc_pl_calc_leads.mobile_number ASC";
	}
	echo "hello1".$search_query."<br>";
	list($recorcount,$row)=MainselectfuncNew($search_query,$array = array());
	for($i=0;$i<$recorcount;$i++)
	{
		$monthsalary = $row[$i]["net_salary"];
		$getCompany_Name = $row[$i]["Company_Name"];
		$DOB = $row[$i]['DOB'];
		$getDOB = str_replace("-","", $DOB);
		$age = DetermineAgeGETDOB($getDOB);
		$city = $row[$i]["City"];
		$pl_last_inserted_id = $row[$i]["RequestID"];
		$PL_EMI_Amt = $row[$i]["PL_EMI_Amt"];
		$getloanamout = $row[$i]["eligible_loanAmt"];
		$interestrate = $row[$i]["eligible_interestRate"];
		$get_emi = $row[$i]["eligible_emi"];
		$getterm = $row[$i]["eligible_term"];
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HDFC Personal Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/hdfc_pl.css" rel="stylesheet" type="text/css">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="960" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="6" class="lftshado">&nbsp;</td>
    <td bgcolor="#FFFFFF"><table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><div id="dvtpbg">
<div id="logo">
	<img src="/new-images/d4l-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'"/>
</div>	 
</div></td>
      </tr>
          <tr>
        <td height="3"></td>
      </tr>
	             <tr align="center">
             <td height="11"   ><img src="new-images/hl-thnk-tp.jpg"></td>
             </tr>
<? 
list($Bnkd,$bidder_id)=getBiddersList("Req_Loan_Personal",$ProductValue,$City);
$finalchk_bid=implode(',',$bidder_id);
$finalBnkd=implode(',',$Bnkd);

if($getloanamout>0  && (strlen($finalchk_bid)>0))
		{ ?>
	  <tr><td height="35" class="boldtxt" style="color:#103E6B; padding-left:15px; line-height:18px; font-size:12px; "><b>Dear Customer ,<br>
	    Based on the information furnished by you, we are  pleased to offer you a Tentative Personal Loan Eligibility Quote as per details   mentioned: <br><br>Offer Details: </b></td>
	  </tr>
	  <? } ?>
	   <tr>
          <td height="40" background="new-images/sixbox-hdng.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">

           <tr align="center">
            <td width="141" height="35" class="fontbld10">Bank Name</td>
            <td width="190" class="fontbld10">Interest Rate</td>
            <td width="154" class="fontbld10"> Loan Amount</td>
            <td width="119" class="fontbld10">EMI (Per month)</td>
            <td width="126" class="fontbld10">Tenure</td>
			 <td width="230" class="fontbld10">Apply</td>
		  </tr>
        </table></td>
      </tr>
    
		<? 
	if($getloanamout>0)
			{
		?>
		<tr>
          <td height="63" background="new-images/sixbox.gif" style="background-repeat:no-repeat; ">
		  <form name="hdfc_form" action="hdfc-personal-loan-newthanks-test.php" method="Post" target="_blank">
		  <input type="hidden" name="lead_id" value="<? echo $last_inserted_id; ?>">
		  <input type="hidden" name="city" value="<? echo $city; ?>">
		  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
           <tr align="center">
		<td width="141" height="30" style="font-weight:bold; " >HDFC</td>
<td width="190" class="fontbld10"><? echo $interestrate; ?></td>
          <td width="152"  ><? echo "Rs ".number_format($getloanamout) ;?></td>
            <td width="121" ><? echo "Rs ".$get_emi; ?></td>
            <td width="125" ><? echo $getterm; ?> yrs</td>
			<td width="231" ><!--<img src="http://www.deal4loans.com/new-images/apl-yelo.gif">--><input type="image" name="Submit"  src="new-images/apl-yelo.gif"  style="border:0px; "/></td>
		  </tr></table></form></td></tr>
			
	<? }

	
$getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered from pl_company_list where company_name="'.$getCompany_Name.'"';
list($recorcount,$grow)=MainselectfuncNew($getcompany,$array = array());
$growcontr=count($grow)-1;

$hdfccategory= $grow[$growcontr]["hdfc_bank"];
$fullertoncategory= $grow[$growcontr]["fullerton"];
$citicategory= $grow[$growcontr]["citibank"];
$barclayscategory= $grow[$growcontr]["barclays"];
$stanccategory = $grow[$growcontr]["standard_chartered"];
list($Bnkd,$bidder_id)=getBiddersList("Req_Loan_Personal",$pl_last_inserted_id,$city);
$finalchk_bid=implode(',',$bidder_id);
//print_r($bidder_id);
$finalBnkd=implode(',',$Bnkd);
if(strlen($finalchk_bid)>0)
			{
 for($i=0;$i<count($Bnkd);$i++)
{
	$getbankid="select Bank_Name from Bank_Master where BankID=".$Bnkd[$i];
	list($recorcount,$row1)=MainselectfuncNew($getbankid,$array = array());
	$row1contr=count($row1)-1;
	$bnk_nm= $row[$row1contr]["Bank_Name"];

		//echo $monthsalary." ".$PL_EMI_Amt." ".$getCompany_Name." ".$fullertoncategory." ".$age." ".$City."<br>";
//echo
	if(((strncmp ("Standard", $bnk_nm,8))==0 ||  ($bnk_nm=="Standard Chartered")) && $stanccategory=='')
	{
	}
	else if(((strncmp ("Citibank", $bnk_nm,8))==0 ||  ($bnk_nm=="Citibank")) && $citicategory=='')
	{

	}
	else
	{
		?>
<tr>
          <td height="63" background="new-images/sixbox.gif"  style="background-repeat:no-repeat; "> <form name="hdfc_form" action="hdfc-personal-loan-comparebanks-newthanks.php" method="Post" target="_blank">
		  <input type="hidden" name="choosenBid_id" value="<? echo $bidder_id[$i]; ?>">
		  <input type="hidden" name="pl_last_inserted" value="<? echo $pl_last_inserted_id; ?>">
		  <input type="hidden" name="bank_name" value="<? echo $bnk_nm; ?>">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
           <tr align="center">
      
<!--//add Bank alogos-->
<?
	if(($bnk_nm=="HDFC Bank") || ($bnk_nm=="HDFC"))
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" />';
	}
else if((strncmp ("Fullerton", $bnk_nm,9))==0 || ($bnk_nm=="Fullerton"))
		{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-fulrtn.jpg" />';
	}
	else if($bnk_nm=="Kotak")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif"  />';

	}
	else if($bnk_nm=="Citibank")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-citibnk.jpg" />';
	
	}
	else if($bnk_nm=="Barclays Finance" || (strncmp ("Barclays", $bnk_nm,8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-barclays.jpg"/>';
	
	}
	else if($bnk_nm=="Standard Chartered" || (strncmp ("Standard", $bnk_nm,8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-stanc.jpg"/>';
	
	}
	else
		{
		$imagebank='';
		}
	
	?>
	<td width="141" height="40"  style="font-weight:bold; "> <? echo  $imagebank; ?><br>  
<? //echo $bnk_nm;?></td>
 	<?
if((strncmp ("Fullerton", $bnk_nm,9))==0 || ($bnk_nm=="Fullerton"))
	{
list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
	if($fullertongetloanamout>0)
		{
	?>
	
<td width="190" class="fontbld10"> <? echo $fullertoninterestrate; ?></td>
	<td width="152" class="fontbld10"><? echo "Rs ".number_format($fullertongetloanamout); ?></td>
		<td width="121" class="fontbld10"><? echo "Rs ".$fullertongetemicalc; ?></td>
		<td width="113" class="fontbld10"><? echo $fullertonterm; ?> yrs</td>
	<?
		}
	else
		{?>
 <td width="299" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>
 	<?}
	}
	elseif($bnk_nm=="Kotak")
	{
	?>
	<td width="299"  colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>
	<? //echo "<a href='/kotak-personal-loan-eligibility.php' target='_blank'>Know More</a>";
	}
	elseif((($bnk_nm=="CITIBANK") ||  ($bnk_nm=="Citibank")) && (strlen($citicategory)>0))
	{
	list($citiinterestrate,$citigetloanamout,$citigetemicalc,$cititerm,$citiperlacemi)=citibank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$age,$citicategory,$getCompany_Name);
	if($citigetloanamout>0)
		{
		?>
	
		<td width="190" class="fontbld10"> <? echo $citiinterestrate; ?></td>
		<td width="152" class="fontbld10"><? echo "Rs ".number_format($citigetloanamout) ; ?></td>
		<td width="121" class="fontbld10"><? echo "Rs ".$citigetemicalc; ?></td>
				<td width="113" class="fontbld10"><? echo $cititerm; ?> yrs</td>
		<?
		}
	else
		{
		?>
<td width="290"  colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>
		<? }

	}
	elseif($bnk_nm=="Barclays")
	{
	list($barclayinterestrate,$barclaygetloanamout,$barclaygetemicalc,$barclayterm,$barclayperlacemi)=@barclays($monthsalary,$PL_EMI_Amt,$getCompany_Name,$barclayscategory,$age,$city);
	if($barclaygetloanamout>0)
		{ ?>
			
		<td width="190" class="fontbld10"><? echo $barclayinterestrate; ?> </td>
		<td width="152" class="fontbld10"><? echo "Rs ".number_format($barclaygetloanamout) ; ?></td>
		<td width="121" class="fontbld10"><? echo "Rs ".$barclaygetemicalc; ?></td>
		<td width="113" class="fontbld10"><? echo $barclayterm; ?> yrs</td>
		<?
		}
	else
		{?>
 <td  height="25" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>

		<? }
	}
	else
	{
	?>
	
  <td width="299"  colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>

		<? 
	}
	?>

	 <td width="231" class="fontbld10"><input type="image" name="Submit" src="new-images/apl-yelo1.gif" style="border:0px; " /></td>
	 </tr>
</table>
</form></td></tr>
		     <tr align="center">
             <td height="11"   ><img src="new-images/hl-thnk-btm.jpg" width="959" height="11"></td>
             </tr>
  <?
			}}
  
		}?>

	<tr>
		<td class="boldtxt" colspan="7" >&nbsp;</td>
	</tr>
	 <tr><td style="font-family:Verdana, Arial, Helvetica, sans-serif; Font-size:11px; color:#FF0000;" colspan="7" >&nbsp;</td>
	  </tr>
</table></td>
  </tr>
   
</table>
 </body>
</html>
