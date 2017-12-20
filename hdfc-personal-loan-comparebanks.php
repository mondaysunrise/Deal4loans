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


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$last_inserted_id = $_POST['hdfc_lead_id'];
	$pl_last_inserted_id = $_POST['pl_lead_id'];
	$city = $_POST['city'];
	$City = $city;
	$monthsalary = $_POST['salary'];
	$eligible_loan = $_POST['eligible_loan'];
	$getCompany_Name = $_POST['Company_Name'];
	$DOB = $_POST['DOB'];
	$getDOB = str_replace("-","", $DOB);
	$age = DetermineAgeGETDOB($getDOB);
	$PL_EMI_Amt = $_POST['clubbed_emi'];
	$CC_Holder = $_POST['CC_Holder'];
	$Card_Vintage = $_POST['Card_Vintage'];
	$Loan_Any = $_POST['Loan_Any'];
	$EMI_Paid = $_POST['EMI_Paid'];
	$nn = count($Loan_Any);
	 $ii  = 0;
	while ($ii < $nn)
	{
	  $Loan_A .= "$Loan_Any[$ii], ";
	 $ii++;
	 }
		$dataUpdate = array('compare_with_banks'=>'1');
		$wherecondition = "(hdfcplid='".$last_inserted_id."')";
		Mainupdatefunc ('hdfc_pl_calc_leads', $dataUpdate, $wherecondition);
		$DataArray = array("CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage, "Loan_Any"=>$Loan_A, "EMI_Paid"=>$EMI_Paid);
		$wherecondition ="(RequestID ='".$pl_last_inserted_id."')";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
        
	

}	

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>HDFC Personal Loan</title>
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
	          
<? 
list($Bnkd,$bidder_id)=getBiddersList("Req_Loan_Personal",$ProductValue,$City);
$finalchk_bid=implode(',',$bidder_id);
$finalBnkd=implode(',',$Bnkd);

?>

	  <tr><td height="35" class="boldtxt" style="color:#103E6B; padding-left:10px; line-height:18px; font-size:12px; "><b>Here are the quotes from all Banks as per information provided by you. <br>If you need more information- Click on the Apply links against the Banks.<br>
You can click on one or more Banks as per your choice for more information from those Banks.
</b></td>
	  </tr>
	     <tr align="center">
             <td height="11"   ><img src="new-images/hl-thnk-tp.jpg"></td>
             </tr>
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
     <!-- <tr>
        <td height="450" align="center" valign="top" class="hdng" style="padding-top:15px; ">	
		
 <table width="949"  align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="66" background="new-images/hdfc-pl/thank-bg.gif" style="background-repeat:no-repeat; ">
	<table width="90%"   border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr><td height="55" align="center" class="boldtxt" style="font-size:13px; line-height:28px;" >Bank Name</td>
	<td height="55" align="center" class="boldtxt" style="font-size:13px; line-height:28px;" > Loan Amount</td>
		<td  width="1" align="left" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="59"></td>
		<td height="25" align="center" class="boldtxt" style="font-size:13px; line-height:28px;">Interest Rate</td>
		<td  width="1" align="left" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="59"></td>
		<td height="25" align="center" class="boldtxt" style="font-size:13px; line-height:28px;">EMI (Per month)</td>
		<td  width="1" align="left" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="59"></td>
		<td height="25" align="center" class="boldtxt" style="font-size:13px; line-height:28px;">Tenure</td>
	</tr>-->
		<? 
		$getData = "select * from  hdfc_pl_calc_leads where hdfcplid ='".$last_inserted_id."'";
	 list($num,$getrow)=MainselectfuncNew($getData,$array = array());
		$cntr=0;
	
		
		if($num>0)
		{
		$getloanamout = $getrow[$cntr]['eligible_loanAmt'];
		$interestrate = $getrow[$cntr]['eligible_interestRate'];
		$get_emi = $getrow[$cntr]['eligible_emi'];
		$getterm = $getrow[$cntr]['eligible_term'];
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
			<!--<tr><td colspan="6" style="color:#103E6B; padding-left:15px; line-height:25px; font-size:12px; " class="boldtxt">Thank You for your Interest. Our representative will get in touch with you shortly for further process. </td></tr>-->
	<? }
		}
	else
	{?>
	<!--<tr>
		<td colspan="7" class="boldtxt" style="color:#103E6B; padding-left:15px; line-height:18px; font-size:12px; ">We're sorry. Our automated system could not locate an offer for you at this time. However our representatives might be able to find you an offer and communicate to you. <? //echo $Feedback; ?></td>
	</tr>-->
	<? } ?>
<?
	$getcompany='select hdfc_bank,fullerton,citibank,barclays,standard_chartered from pl_company_list where company_name="'.$getCompany_Name.'"';
 //echo $getcompany;
 list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
		$r=0;

$hdfccategory= $grow[$r]["hdfc_bank"];
$fullertoncategory= $grow[$r]["fullerton"];
$citicategory= $grow[$r]["citibank"];
$barclayscategory= $grow[$r]["barclays"];
$stanccategory = $grow[$r]["standard_chartered"];
list($Bnkd,$bidder_id)=getBiddersList("Req_Loan_Personal",$pl_last_inserted_id,$city);
$finalchk_bid=implode(',',$bidder_id);
//print_r($bidder_id);
$finalBnkd=implode(',',$Bnkd);
if(strlen($finalchk_bid)>0)
			{
 for($i=0;$i<count($Bnkd);$i++)
			{
$getbankid="select Bank_Name from Bank_Master where BankID=".$Bnkd[$i];
		//echo $getbankid;
		 list($recordcount,$row)=MainselectfuncNew($getbankid,$array = array());
		$s=0;
		
		$bnk_nm= $row[$s]["Bank_Name"];

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
       <!--<td height="57" align="center" background="new-images/pl-thnk-bnkbg2-new.gif" style="background-repeat:no-repeat; ">-->
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
 	<? /*if(($bnk_nm=="HDFC Bank") || ($bnk_nm=="HDFC"))
	{
		list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$age,$Company_Type,$Primary_Acc);

		if($hdfcgetloanamout>0)
		{*/
	?>
	
			<!--<td width="80" class="fontbld10"><? //echo $hdfcinterestrate; ?></td>-->
            <!--<td width="204"  ><? //echo $hdfcperlacemi; ?></td>-->
            <!--<td width="170"  ><? //echo $hdfcgetloanamout; ?></td>
            <td width="112" ><?// echo $hdfcgetemicalc; ?></td>
            <td width="64" ><? //echo $hdfcterm; ?></td>-->	 
	<?
		/*}
	else
		{ */?>
  <!--<td width="299" height="45" colspan="4"   bgcolor="#FFFFFF" class="fontbld10">Get Quote on call from Bank</td>-->
	<?//	}
		//echo "<a href='/hdfc-personal-loan-eligibility.php' target='_blank'>Know More</a>";	
	//}
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

	 <td width="231" class="fontbld10"><input type="image" name="Submit"  src="new-images/apl-yelo1.gif" style="border:0px; " /></td>
	
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
		
	  <!--<tr><td style="font-family:Verdana, Arial, Helvetica, sans-serif; Font-size:11px; color:#FF0000;" colspan="7" >* Terms & Conditions Apply , Credit at the sole discretion  of HDFC Bank </td>
	  </tr>-->
</table></td>
  </tr>
   
</table>
 </body>
</html>
