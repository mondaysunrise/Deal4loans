<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';
	require 'getlistofeligiblebidders1.php';
	$Dated = ExactServerdate();

//print_r($_POST);

$maxage=date('Y')-62;
$minage=date('Y')-18;

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
  {   // Birthday Month Not Reached  // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently   // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached     // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$lead_id = $_POST['lead_id'];
		$City = $_POST['city'];
		$strCity = $City;
$Bidderid_Details = $_POST['Bidderid_Details'];
$code = $_POST['code'];
$gethldetails="Select DOB,Net_Salary,Total_Obligation,Loan_Amount,Co_Applicant_DOB,Co_Applicant_Income,Co_Applicant_Obligation,Property_Value From Req_Loan_Home Where (RequestID=".$lead_id.")";
//echo $gethldetails."<br>";
list($Getnum,$row)=Mainselectfunc($gethldetails,$array = array());

		$dateofbirth = $row['DOB'];
		
		
		$Net_Salary = $row['Net_Salary'];
		$monthly_income = ($Net_Salary /12);
		$obligations = $row['Total_Obligation'];
		$loan_amount = $row['Loan_Amount'];
		$DOB_co = $_POST['Co_Applicant_DOB'];
		$co_monthly_income = $row['Co_Applicant_Income'];
		$co_obligations = $row['Co_Applicant_Obligation'];
		$property_value = $row['Property_Value'];
		$getnetAmount = ($monthly_income + $co_monthly_income);
		$total_obligation = $obligations + $co_obligations;
		$Type_Loan = "Req_Loan_Home";
		$netAmount=($getnetAmount - $total_obligation);
		$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$tenorPossible = 60 - $DOB;
		
	if($lead_id>0 && $code=="lic_lp")
	{
		$DataArray = array("Allocated" =>2, "Bidderid_Details"=>$Bidderid_Details, "Dated"=>$Dated);
		$wherecondition ="(RequestID=".$lead_id.")";
	}
	else
	{
		$UpdateProductSql = "Update Req_Loan_Home set source='".$code."', Dated=Now() Where (RequestID=".$lead_id.")";
		$DataArray = array("source" =>$code, "Dated"=>$Dated);
$wherecondition ="(RequestID=".$lead_id.")";
	}
		Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);
				

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="scripts/common.js"></script>
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<style>
.tbltext {
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
}
</style>
</head>

<body>
<?php 
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
list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
//print_r(list);
?>
<table align="center">
<tr>
<td height="30" align="center" style="background-image:url(new-images/lic-bckgrnd.jpg); background-repeat:repeat; width:979px; border:none;"> <img src="new-images/logon.jpg" /><img src="new-images/d4l_sml_logo.jpg" /></td></tr>
<tr>
<td height="15" align="center" style="background-color:#B50722; padding:10px;"></td></tr>
<tr>
<td height="15" align="center" 
>
<div align="center"><b>Your EMI and Rates Quotes From LIC Housing.
</b></div>
</td>
</tr>
<tr><td>
<table>
<tr><td>
<table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#dbf2ff" >
	
	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" background="new-images/hl-thnk-hdr1.gif" style="background-repeat:no-repeat; " align="center">
		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center" >
            <td width="141" height="30" class="frmbldtxt" style="padding-left:10px;"><b>Bank Name</b></td>
            <td width="191" class="frmbldtxt" style="padding-left:10px;"><b>Interest Rate</b> </td>
            <td width="205" class="frmbldtxt" style="padding-left:10px;"><b>EMI (Per Lac)</b></td>
            <td width="65" class="frmbldtxt" style="padding-left:10px;"><b>Tenure</b></td>
            <td width="127" class="frmbldtxt" style="padding-left:10px;"><b>Eligible Loan Amount</b></td>
            <td width="229" class="frmbldtxt" style="padding-left:10px;"><b>EMI (Per Month)</b></td>
          </tr>
        </table>
		</td>
      </tr>
	  <!---------------->
	  <tr>
	   <td height="63" background="../new-images/hl-thnk-bnkbg1.gif" style="background-repeat:no-repeat; " align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
<? if($licloan_amount>0 && $code=="lic_lp") { ?>
          <tr align="center">
		  <td width="133" height="30" class="frmbldtxt" style="padding-left:10px;"><img src="http://www.deal4loans.com/new-images/thnk-lic.gif" width="86" height="20" /><br />               
		   LIC Housing</td>
			       <td width="187" align="left" class="tbltext"><?php echo $licinter; ?> %</td>
                  <td width="198" align="left" class="tbltext"><?php echo $licperlacemi; ?></td>
                   <td width="68" class="tbltext"><?php echo $licprint_term; ?> yrs.</td>
                   <td width="127" class="tbltext"><?php echo "Rs.".$licviewLoanAmt; ?></td>
                 <td width="218" align="left" class="tbltext"><?php echo $licemi; ?></td>
		  </tr></table></td>
		  </tr>
		  <? }
		  else
		  { list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$lead_id,$strCity);
		      //   print_r($FinalBidder);
		$Final_Bid = "";
		while (list ($key,$val) = @each($bankID)) { 
			$Final_Bid[]= $val; 
		} 
	$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);
		//print_r($Final_Bid);

		//echo "<br>";

for($i=0;$i<count($Final_Bid);$i++)
	{
	  ?>
		 <td height="63" background="new-images/hl-thnk-bnkbg1.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
                  <?
    if($Final_Bid[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis")
	{
	list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	
	
		?>
                  <td width="145" height="30"  ><img src="new-images/thnk-axis.gif" width="86" height="20" /><br /> 
              <? echo $Final_Bid[$i]; ?></td>
			  <? if($axisviewLoanAmt>0)
		{ ?>
				  <td width="192" ><?php echo $axisinter; ?> %</td>
                  <td width="201" align="left" >Rs. <?php echo  $axisperlacemi; ?> </td>
                  <td width="66" ><?php echo abs($axisprint_term); ?> yrs.</td>
                  <td width="132" >Rs. <?php echo abs($axisviewLoanAmt); ?></td>
                  <td width="224" align="left" >Rs.<?php echo $axisemi; ?> </td>
                  <? }
		else
		{?>
<td   bgcolor="#FFFFFF" height="57" colspan="5"><b>Get Quote on call from Bank</b></td>
		<? }
	}
	
	elseif(($Final_Bid[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Bank"))
	{
		list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);


		?> 
		<td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-idbi.gif" width="86" height="20" /><br /> 
              <? echo $Final_Bid[$i]; ?></td>
			  <? if($idbiviewLoanAmt>0)
		{ ?>
                 <td width="192"  ><?php echo $idbiinter; ?> %</td>
                  <td width="201" align="left" >Rs. <?php echo  $idbiperlacemi; ?></td>
                 <td width="66" ><?php echo abs($idbiprint_term); ?> yrs.</td>
                  <td width="132" >Rs. <?php echo abs($idbiviewLoanAmt); ?></td>
                  <td width="224" align="left" >Rs. <?php echo $idbiemi; ?></td>
                  <?
		}
		else
		{?>
<td   bgcolor="#FFFFFF" height="57" colspan="5"><b>Get Quote on call from Bank</b></td>
		<? }
		//echo "<a href='/home-loan-idbi-homefinance.php' target='_blank'>Know More</a></b></td>";
	}
	
	elseif($Final_Bid[$i]=="ICICI" || $Final_Bid[$i]=="ICICI Bank")
	{
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 

?>
                   <td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" width="86" height="20" /><br /> 
              <? echo $Final_Bid[$i]; ?></td>
			  <? if($iciciviewLoanAmt>0)
		{
	?>
				  <td width="192" ><? echo $iciciinter; ?> %</td>
                  <td width="201" align="left" >Rs. <?php echo $iciciperlacemi; ?></td>
                 <td width="66" ><?php echo abs($iciciprint_term); ?> yrs.</td>
                  <td width="132" >Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
                   <td width="224" align="left" >Rs
                      <?  echo $iciciactualemi; ?></td>
                  <?
		}
else
		{?>
<td   bgcolor="#FFFFFF" height="57" colspan="5"><b>Get Quote on call from Bank</b></td>
		<? }
		//echo "<a href='/icici-hfc-home-loan.php' target='_blank'>Know More</a></b></td>";

	}
	elseif($Final_Bid[$i]=="HDFC" || $Final_Bid[$i]=="HDFC Bank")
	{
		//echo "IC:".$getnetAmount."LA:".$loan_amount."Age:".$age."TO:".$total_obligation."Cty:".$strCity."PV:".$property_value."<br>";
			list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
			
		
		?>
                 <td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20" /><br /> 
              <? echo $Final_Bid[$i]; ?></td>
			  <? if($hdfcviewLoanAmt>0)
		{?>
                  <td width="192"><?php echo $hdfcinter; ?>%</td>
                  <td width="201" align="left" >Rs. <?php echo  $hdfcperlacemi; ?></td>
                  <td width="66" ><?php echo abs($hdfcprint_term); ?> yrs.</td>
                  <td width="132" >Rs. <?php echo $hdfcviewLoanAmt; ?></td>
                   <td width="224" align="left" >Rs. <?php echo $hdfcemi; ?></td>
                  <?
		}
		else
		{?>
<td   bgcolor="#FFFFFF" height="57" colspan="5"><b>Get Quote on call from Bank</b></td>
		<? }

		//echo "<a href='/hdfc-bank-home-loan.php' target='_blank'>Know More</a></b></td>";
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
		?> <td width="145" height="30"  ><? echo $bankwimg;?><br /> 
              <? echo $Final_Bid[$i]; ?></td>
                                    
<td   bgcolor="#FFFFFF" height="57" colspan="5"><b>Get Quote on call from Bank</b></td>
	<? }
	?>

                </tr>
            </table></td>
          </tr>
          <? }
		 } ?>
		   <tr>
            <td colspan="6" align="right" ><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
          </tr>
          <tr>
            <td colspan="6" align="center" bgcolor="#FFFFFF"><img src="new-images/hl-thnk-btm.jpg" width="959" height="11" /></td>
          </tr>
	  <!-------------------->
	  
	  </table>
	 
	  </td></tr>
	  	
</table>
</td></tr></table>
</td>
</tr>
</table>
</body>
</html>
