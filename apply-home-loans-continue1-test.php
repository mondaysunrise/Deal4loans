<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';
	require 'getlistofeligiblebidders_hltest.php';
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

$leadid = $_SESSION['Temp_LID'];
$bank_id = $_SESSION['bank_id'];
if($bank_id!='All')
	{
$getnchckbid = substr(trim($bank_id), 0, strlen(trim($bank_id))-1);
	}
	else
	{
		$getnchckbid=$bank_id;
	}


$gethldetails="select City_Other,City,Net_Salary,DOB,Loan_Amount,Property_Value,Co_Applicant_Obligation,Co_Applicant_Income,Total_Obligation From Req_Loan_Home Where (RequestID='".$leadid."')";
	list($chkdlresultcont,$hlrow)=MainselectfuncNew($gethldetails,$array = array());
	$hlrowcontr = count($myrow)-1;
	$City = $hlrow[$hlrowcontr]['City'];
	$Other_City = $hlrow[$hlrowcontr]['City_Other'];
	$DOB = $hlrow[$hlrowcontr]['DOB'];
	$Net_Salary = $hlrow[$hlrowcontr]['Net_Salary'];
	$co_obligations = $hlrow[$hlrowcontr]['Co_Applicant_Obligation'];
	$obligations = $hlrow[$hlrowcontr]['Total_Obligation'];
	$co_monthly_income = $hlrow[$hlrowcontr]['Co_Applicant_Income'];
	$loan_amount = $hlrow[$hlrowcontr]['Loan_Amount'];
	$monthly_income = ($Net_Salary /12);
	$getnetAmount = ($monthly_income + $co_monthly_income);
	$total_obligation = $obligations + $co_obligations;
	$netAmount=($getnetAmount - $total_obligation);
	$DOB = str_replace("-","", $DOB);
	$DOB = DetermineAgeFromDOB($DOB);
	$tenorPossible = 60 - $DOB;
	$age =$DOB;



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script Type="text/javascript">
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

		function taxinsertData()
		{
			var get_netSalary = document.getElementById('netSalary').value;
			var get_DOB = document.getElementById('DOB').value;
			var get_agecalc = document.getElementById('agecalc').value;
			
			
			if(get_netSalary!='')
			{
				var queryString = "?netSalary=" + get_netSalary + "&dob=" + get_DOB + "&agecalc=" + get_agecalc ;
			}
			
			//alert(queryString); 
				ajaxRequest.open("GET", "insert_pension_premimum.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
					
						var ajaxDisplay = document.getElementById('calculate');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					   

				
					}
				}

				ajaxRequest.send(null); 
			 
		}

		window.onload = ajaxFunction;
		</script>

</head>
<style>
.bnk_logo{
	width:105px;
	height:35px;
	padding-left:4px;
	padding-top:0px;
	*padding-top:11px;
}
</style>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">

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
	list($Bnkd,$bidder_id)= getBiddersList("Req_Loan_Home",$leadid,$strCity,$getnchckbid);
$finalchk_bid=implode(',',$bidder_id);
$finalBnkd=implode(',',$Bnkd);

$dataUpdate = array('checked_bidders'=>$finalchk_bid, 'PL_EMI_Amt'=>$finalBnkd);
$wherecondition = "(RequestID='".$leadid."')";
	Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);
if(count($Bnkd)>0 && strlen($finalBnkd)>0)
	 {
		//echo "hello1: ";
		 
	?>


 <?php 
	list($Bnkd,$bidder_id)= getBiddersList("Req_Loan_Home",$leadid,$strCity,$getnchckbid);
$finalchk_bid=implode(',',$bidder_id);
$finalBnkd=implode(',',$Bnkd);
//print_r($Bnkd);
if(count($Bnkd)>0 && strlen($finalBnkd)>0)
	 {

	?>
	<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Home Loan through Deal4loans.com. You will soon receive a call from us.</h1>
<div align="center"><b>Your EMI and Rates Quotes for the Home Loan from partner Banks are listed Below.
</b></div>
	
     <table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#dbf2ff" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="35" background="new-images/hl-thnk-hdr1.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
            <td width="141" height="30" class="fontbld10">Bank Name</td>
            <td width="191" class="fontbld10">Interest Rate </td>
            <td width="205" class="fontbld10">EMI (Per Lac)</td>
            <td width="67" class="fontbld10">Tenure</td>
            <td width="127" class="fontbld10"> 	Eligible Loan Amount</td>
            <td width="229" class="fontbld10">EMI (Per Month)</td>
          </tr>
        </table></td>
      </tr>
    
          <?
for($i=0;$i<count($Bnkd);$i++)
	{
		$getbankid="select Bank_Name from Bank_Master where BankID=".$Bnkd[$i];
		list($rowcont,$row)=MainselectfuncNew($getbankid,$array = array());
		$bnk_nm= $row[0]["Bank_Name"];
	
		?>
		 <td height="63" background="new-images/hl-thnk-bnkbg1.gif" style="background-repeat:no-repeat; "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr align="center">
                  <?
    if($bnk_nm=="Axis Bank" || $bnk_nm=="Axis")
	{
	list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		?>
                  <td width="145" height="30"  ><img src="new-images/thnk-axis.gif" width="86" height="20" /><br /> 
              <? echo $bnk_nm; ?></td>
				  
                  <td width="192" align="left" ><?php echo $axisinter; ?> %</td>
                  <td width="201" align="left" >Rs. <?php echo  $axisperlacemi; ?> </td>
                  <td width="66" ><?php echo abs($axisprint_term); ?> yrs.</td>
                  <td width="132" >Rs. <?php echo abs($axisviewLoanAmt); ?></td>
                  <td width="224" align="left" ><?php echo $axisemi; ?> </td>
                  <? }
	
	elseif(($bnk_nm=="IDBI Housing Finance" || $bnk_nm=="IDBI Bank"))
	{
		list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		?> 
		<td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-idbi.gif" width="86" height="20" /><br /> 
              <? echo $bnk_nm; ?></td>
                 
                  <td width="192" align="left" ><?php echo $idbiinter; ?> %</td>
                  <td width="201" align="left" >Rs. <?php echo  $idbiperlacemi; ?></td>
                 <td width="66" ><?php echo abs($idbiprint_term); ?> yrs.</td>
                  <td width="132" >Rs. <?php echo abs($idbiviewLoanAmt); ?></td>
                  <td width="224" align="left" >Rs. <?php echo $idbiemi; ?></td>
                  <?
		//echo "<a href='/home-loan-idbi-homefinance.php' target='_blank'>Know More</a></b></td>";
	}
	elseif($bnk_nm=="LIC Housing" || $bnk_nm=="LIC")
	{
		list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	?>
                  <td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-lic.gif" width="86" height="20" /><br /> 
              <? echo $bnk_nm; ?></td>
				
                  <td width="192" align="left" ><?php echo abs($licinter); ?> %</td>
                  <td width="201" align="left" >Rs. <?php echo abs($licperlacemi); ?></td>
                   <td width="66" ><?php echo abs($licprint_term); ?> yrs.</td>
                   <td width="132" >Rs. <?php echo abs($licviewLoanAmt); ?></td>
                  <td width="224" align="left" >Rs. <?php echo $licemi; ?></td>
                  <?
		//echo "<a href='/lic-housing-home-loan.php' target='_blank'>Know More</a></b></td>";
	}
	elseif( $bnk_nm=="ICICI" || $bnk_nm=="ICICI Bank")
	{
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
?>
                   <td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" width="86" height="20" /><br /> 
              <? echo $bnk_nm; ?></td>
				
                  <td width="192" align="left" ><? echo $iciciinter; ?> %</td>
                  <td width="201" align="left" >Rs. <?php echo $iciciperlacemi; ?></td>
                 <td width="66" ><?php echo abs($iciciprint_term); ?> yrs.</td>
                  <td width="132" >Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
                   <td width="224" align="left" >Rs
                      <?  echo $iciciactualemi; ?></td>
                  <?
		//echo "<a href='/icici-hfc-home-loan.php' target='_blank'>Know More</a></b></td>";

	}
	elseif($bnk_nm=="HDFC" || $bnk_nm=="HDFC Bank")
	{
		list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		
		?>
                 <td width="145" height="30"  ><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20" /><br /> 
              <? echo $bnk_nm; ?></td>
                  <td width="192" align="left" ><?php echo $hdfcinter; ?>%</td>
                  <td width="201" align="left" >Rs. <?php echo  $hdfcperlacemi; ?></td>
                  <td width="66" ><?php echo abs($hdfcprint_term); ?> yrs.</td>
                  <td width="132" >Rs. <?php echo abs($hdfcviewLoanAmt); ?></td>
                   <td width="224" align="left" >Rs. <?php echo $hdfcemi; ?></td>
                  <?

		//echo "<a href='/hdfc-bank-home-loan.php' target='_blank'>Know More</a></b></td>";
	}
	else
	{
		if($bnk_nm=="Citibank" || $bnk_nm=="Citi Bank")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-citibnk.jpg" width="86" height="20" />';

	}
	elseif($bnk_nm=="DHFL")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-dhfl.gif" height="20" />';
		
	}
	elseif($bnk_nm=="Standard Chartered" || (strncmp ("Standard", $bnk_nm,8))==0 )
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-stantc.jpg" width="86" height="20" />';
		
	}
	elseif($bnk_nm=="Reliance capital" || (strncmp ("Reliance", $bnk_nm,8))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-reliance.gif" width="86" height="20" />';
		
	}
	elseif($bnk_nm=="ING VYSYA" || $bnk_nm=="Ing Vysya" || (strncmp ("ING", $bnk_nm,3))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-ing.gif" width="86" height="20" />';
		
	}
	elseif($bnk_nm=="India Bulls")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-indiabull.gif" width="86" height="20" />';
		
	}
	elseif($bnk_nm=="Kotak Bank" || (strncmp ("Kotak", $bnk_nm,5))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif" width="86" height="20" />';
		
	}
	elseif((strncmp ("Barclays", $bnk_nm,8))==0)
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-brclys.jpg" width="86" height="20" />';
		
	}
	elseif($bnk_nm=="Citifinancial")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-citifncl.jpg"" width="86" height="20" />';
		
	}
	elseif($bnk_nm=="SBI")
	{
		
		$bankwimg='<img src="http://www.deal4loans.com/new-images/hl-thnk-sbi.jpg" width="86" height="20" />';
		
	}
	else
		{
			$bankwimg='&nbsp;';
		}
		?> <td width="145" height="30"  ><? echo $bankwimg;?><br /> 
              <? echo $bnk_nm; ?></td>
                                    
<td   bgcolor="#FFFFFF" height="57" colspan="5"><b>Get Quote on call from Bank</b></td>
	<? }
	?>

                </tr>
            </table></td>
          </tr>
          <? } ?>
          <tr>
            <td colspan="6" align="right" ><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
          </tr>
          <tr>
            <td colspan="6" align="center" bgcolor="#FFFFFF"><img src="new-images/hl-thnk-btm.jpg" width="959" height="11" /></td>
          </tr>
    </table></td>
  </tr>
</table>
    
	<? }
	
	 }
	 	 
	 else
	 {
		 //echo "hello2: ";
		 
		 ?>
    <?
	 }?>
    <?php 

$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if(($Net_Salary>=350000) && (in_array($City, $getciticitydetails))>0)
		{
			 
		  $get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid in (1,3,4,2) and cc_bank_flag =1) order by cc_bank_fee ASC";
		list($alreadyExist,$myrow)=MainselectfuncNew($get_Bank,$array = array());
		$citirecordcount = $alreadyExist;
		if($citirecordcount>0)
			{
		 ?>
<div style="text-align:center; font-weight:bold; line-height:18px; padding:15px 0px;">
		There are some other financial products that are on offer for you on the basis of details you have submitted.
			<br />
		If you are interested, Go ahead and <font color="#5e3307">Apply</font></div>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
		<?
		for($k=0;$k<$citirecordcount;$k++)
		 {?>
				<td valign="top">
					<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" class="crdbg">
						<tr>
							<td height="30" class="crdbhdng"><a href="<? if (strlen($myrow[$k]["cc_bank_url"])>0) {echo $myrow[$k]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><? echo $myrow[$k]["cc_bank_name"];?></a></td>
						</tr>
						<tr>
							<td height="255" align="center" valign="bottom"><a href="<? if (strlen($myrow[$k]["cc_bank_url"])>0) {echo $myrow[$k]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><img src="<? echo $myrow[$k]["card_image"];?>"  width="150" height="244" /></a></td>
						</tr>
						<tr>
							<td height="22" valign="bottom" class="crdbold">Features</td>
						</tr>
						<tr>
							<td class="crdtext" height="325"><? echo $myrow[$k]["cc_bank_features"];?></td>
						</tr>
						<tr>
							<td  align="center" valign="bottom"><a href="<? if (strlen($myrow[$k]["cc_bank_url"])>0) {echo $myrow[$k]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" /></a></td>
						</tr>
					</table>
				</td>
				<? }?>
		<td align="center" valign="top" width="160"><div align="center">

</div>
</td>
			</tr>
		</table>


	<?}
		}
	else
	 {
		if(count($FinalBidder)>0)
	 {?>
		
	<?
	 }}
	


?>

</div>
      
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div>-->
<?// }?>


</body>
</html>

