<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'afiliate_eligiblebidders.php';
			require 'scripts/home_loan_eligibility_function.php';


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


	
   function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Contents_Personal_Loan_Mustread.php',
		'Req_Loan_Home' => 'Contents_Home_Loan_Mustread.php',
		'Req_Loan_Car' => 'Contents_Car_Loan_Mustread.php',
		'Req_Credit_Card' => 'Contents_Credit_Card_Mustread.php',
		'Req_Loan_Against_Property' => 'Contents_Loan_Against_Property_Mustread.php',
		'Req_Life_Insurance' => 'index.php'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
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
					
																
						getEligibleBidders("home","$City","$Mobile");
						
						$qry="Update Req_Loan_Home SET  Co_Applicant_Name='$co_name',Co_Applicant_DOB='$DOB_co',Co_Applicant_Income='$co_monthly_income',Co_Applicant_Obligation='$co_obligations',Property_Value='$property_value', Total_Obligation='$total_obligation',DOB = '$DOB', Residence_Address = '$Residence_Address', Pincode ='$Pincode', Employment_Status ='$Employment_Status', Company_Name='$Company_Name', Property_Identified='$Property_Identified', Property_Loc ='$Property_Loc', Loan_Time='$Loan_Time', Is_Valid='$Is_Valid', Budget='$budget' Where RequestID=".$ProductValue;
				//		echo $qry;
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
		
	}//$_POST
	
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
 
<style>
body{	
background-color:#FFFFFF!important;
background-image:none!important;
}
</style>
<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td  background='http://www.deal4loans.com/images/logutbg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td bgcolor='#FFFFFF'>&nbsp;</td></tr></table></td></tr></table>";
	}
?>
<style>
.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
}
 


.bluebtn{
font-family:Verdana, Arial, Helvetica, sans-serif; 
font-size:12px;
font-weight:bold;
color:#084459;
border:1px solid #084459;
background-color:#FFFFFF;
}

.buttonfordate {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;
	background-color: #45B2D8;
	border: 1px solid #45B2D8;
	font-weight: bold;
}

</style>
</head>
<body>

<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >

<tr>

    <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
	  <td width="200"   valign="top"><?php include '~Partners_Left.php';?></td>
        <td width="600" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table  width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >
			
              <tr>
                <td valign="top"  >
<?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);
$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);

if(count($FinalBidder)>0)
	{
		//echo "hello1: ";
		 
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
}?>


 <?php 
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Home",$ProductValue,$strCity);

$Final_Bid = "";
		while (list ($key,$val) = @each($bankID)) { 
			$Final_Bid[]= $val; 
		} 

   

	$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);

if(count($FinalBidder)>0 )
	 {

	?>
	<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px; color:#FFFFFF; font-size:13px; "> Thanks for applying Home Loan through Deal4loans.com. You will soon receive a Call from us.<br />
Following Banks are interested in your profile, will get back to you & give you the best Deal..</div>
	<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#e8e6d9">
  <tr>
    <td width="11%" height="25" align="center" valign="middle" bgcolor="#494949"><b style=" color:#FFFFFF;">Bank Name</b></td>
	<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">ROI</b></td>
	<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">EMI(Per Lac)</b></td>
	<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">Tenure</b></td>
	<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">Eligible Loan Amt</b></td>

		<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">EMI(Per Month)</b></td>
<!--	<td width="11%" align="center" bgcolor="#494949"><b style=" color:#FFFFFF;">Total Interest Amt</b></td>-->
<!--	<td width="11%" align="center"><b style="font-size:12px;">Information</b></td>-->
   <!-- <td width="6%" colspan="25" align="center" bgcolor="#494949"><b style="color:#FFFFFF;">Apply</b></td>-->
  </tr>
   <form name="check_bidders" action="get_checked_bidders.php" method="POST">
	<input type="hidden" name="reply_product" value="Req_Loan_Home">
	<input type="hidden" name="requestid" value="<? echo $ProductValue;?>">
	<input type="hidden" name="selectbidderID" id="selectbidderID" value="<? echo $FinalBidder ;?>">
		<input type="hidden" name="realbankID" id="realbankID" value="<? echo $realbankiD ;?>">
	<?
for($i=0;$i<count($Final_Bid);$i++)
	{
		?>
  <tr>
    <td height="22" align="center" bgcolor="#FFFFFF"><b><? echo $Final_Bid[$i];?></b></td>
	
    <?
    if($finalBidderName[$i]=="Axis Bank" || $Final_Bid[$i]=="Axis Bank")
	{
	list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	
	//echo "<a href='/home-loan-axis-bank.php' target='_blank'>Know More</a>";
		?>	
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($axisinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo  abs($axisperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($axisprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($axisviewLoanAmt); ?></td>

		<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $axisemi; ?></td>
	<!--<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php 
							    /*  $axisinterestfortwoyr= ($axissemi * 12);
							   $axisremingterm=$axisterm - 12;
						   $axisgetinterestamt=(($axisactualemi * $axisremingterm)); 
						   $axistotalinterestamt= (($axisinterestfortwoyr + $axisgetinterestamt) - $axisviewLoanAmt);
						    echo abs($axistotalinterestamt); */?></td>-->
		
		
	<? }
	elseif($finalBidderName[$i]=="Citibank" || $Final_Bid[$i]=="Citibank")
	{
		echo "<td colspan='6' style='font-size:12px;' align='center' bgcolor='#FFFFFF'><b>Get Quote on call from Bank</b></td>";
	}
	elseif($finalBidderName[$i]=="DHFL" || $Final_Bid[$i]=="DHFL")
	{
		echo "<td colspan='6' align='center' bgcolor='#FFFFFF' style='font-size:12px;'>Get Quote on call from Bank</b></td>";
	}
	elseif(($finalBidderName[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Housing Finance"))
	{
		list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		?>
		 
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo "8.25%(Fixed for 2 yrs)".abs($idbiinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo  $idbiperlacemifortwo."(Fixed For 2 yrs)".abs($idbiperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($idbiprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($idbiviewLoanAmt); ?></td>

		<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $idbiemi; ?></td>
<!--	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php 
							   
							 /*  $idbiinterestfortwoyr= ($idbisemi * 24);
							   $remingterm=$idbiterm - 24;
						   $idbigetinterestamt=($idbiactualemi * $remingterm); 
						   $idbitotalinterestamt= ( ($idbiinterestfortwoyr + $idbigetinterestamt) - $idbiviewLoanAmt);
						   echo abs($idbitotalinterestamt); */?></td>-->
	<?
		//echo "<a href='/home-loan-idbi-homefinance.php' target='_blank'>Know More</a></b></td>";
	}
	elseif($finalBidderName[$i]=="LIC Housing" || $Final_Bid[$i]=="LIC Housing")
	{
		list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	?>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($licinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($licperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($licprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($licviewLoanAmt); ?></td>

		<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $licemi; ?></td>
	<!--<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php //$licgetinterestamt=(($licemi * $licterm)); echo $licgetinterestamt; ?></td>-->
	<?
		//echo "<a href='/lic-housing-home-loan.php' target='_blank'>Know More</a></b></td>";
	}
	elseif($finalBidderName[$i]=="ICICI" || $Final_Bid[$i]=="ICICI")
	{
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
/*if($iciciviewLoanAmt<=2000000)
		{
			$viewinter="8%";
		}
		elseif($iciciviewLoanAmt>2000000)
		{
			$viewinter="8.25%";
		}*/
			?>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><? echo $iciciinter; ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $iciciperlacemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($iciciprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($iciciviewLoanAmt); ?></td>

		<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs <?  echo $iciciactualemi; ?></td>
	<!--<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php /* $iciciinterestfortwoyr= (($icicisemi * 24) );
							   $remingterm=$iciciterm - 24;
						     $icicigetinterestamt=(($iciciactualemi * $remingterm));
						  $icicitotalinterestamt= (($iciciinterestfortwoyr + $icicigetinterestamt) - $iciciviewLoanAmt);
							 echo abs($icicitotalinterestamt)."<br>"; */?></td>-->
	<?
		//echo "<a href='/icici-hfc-home-loan.php' target='_blank'>Know More</a></b></td>";

	}
	elseif($finalBidderName[$i]=="HDFC" || $Final_Bid[$i]=="HDFC")
	{
		
		list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		
		?>
		  
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $hdfcinter; ?>%</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo  $hdfcperlacemi; ?></b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($hdfcprint_term); ?> yrs.</b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($hdfcviewLoanAmt); ?></b></td>

		<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $hdfcemi; ?></td>
<!--	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php 
  /* $hdfcinterestfortwoyr= (($hdfcsemi * 24));
   $remingterm=$hdfcterm - 24;
   $hdfcgetinterestamt=(($hdfcactualemi * $remingterm)); 
   $hdfctotalinterestamt= (($hdfcinterestfortwoyr + $hdfcgetinterestamt) - $hdfcloan_amount);
   echo abs($hdfctotalinterestamt);*/ ?></td>-->
	<?

		//echo "<a href='/hdfc-bank-home-loan.php' target='_blank'>Know More</a></b></td>";
	}
	else
	{
		echo "<td colspan='5' style='font-size:12px;' align='center' bgcolor='#FFFFFF'><b> Get Quote on call from Bank </b></td>";
	}
	?>
    <!--<td bgcolor="#FFFFFF" align="center"><input type='checkbox' value='<? //echo $Final_Bid[$i];?>' name='Final_Bidder[<? //echo $i;?>]' checked style="border:none;" /></td>-->
  </tr>
  <? } ?>
   
	<td colspan="6" align="right" bgcolor="#FFFFFF"><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
    </tr>
</form>
 </table>
 </td>
              </tr>
             
              <tr>
                <td height="10" ></td>
              </tr>
              
            </table></td>
            
          </tr>
        </table></td>
		</tr>
    </table></td>
  </tr>
  <Tr>
  <td>&nbsp;</td>
  </Tr>
</table>

 <? }
	
	 }
	 	 
	 else
	 {
		 ?>
		 <div style="text-align:center; font-weight:bold; line-height:18px; padding-top:35px; color:#FFFFFF; font-size:13px; "> Thanks for applying Home Loan through Deal4loans.com. You will soon receive a Call from us.<br />
Following Banks are interested in your profile, will get back to you & give you the best Deal..</div>
	 <?}?>


</body>
</html>
