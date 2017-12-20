<? 
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderfunc.php';
require 'scripts/home_loan_eligibility_function.php';
error_reporting();
//print_r($_POST);
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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 	$Mobile_Number = $_POST["Mobile_Number"];
	$source = $_POST["source"];
	$Name = $_POST["Name"];
	$Email = $_POST["Email"];
	$Employment_Status = $_POST["Employment_Status"];
	$Day = $_POST["day"];
	$Month = $_POST["month"];
	$Year = $_POST["year"];
	$DOB=$Year."-".$Month."-".$Day;
	$age = str_replace("-","", $DOB);
	//$getDOB = DetermineAgeGETDOB($age);
	$City = $_POST["City"];
	$City_Other = $_POST["City_Other"];
	$Company_Name = $_POST["Company_Name"];
	$IncomeAmount = $_POST["IncomeAmount"];
	$Loan_Amount = $_POST["Loan_Amount"];
	$hlresiaddress = $_POST["hlresiaddress"];
	$hlpincode = $_POST["hlpincode"];
	$hlstd_code = $_POST["hlstd_code"];
	$hllandline = $_POST["hllandline"];
	$hlstd_code_o = $_POST["hlstd_code_o"];
	$hllandline_o = $_REQUEST['hllandline_o'];
	$hlproperty_identified = $_POST["hlproperty_identified"];
	$hlproperty_loc = $_POST["hlproperty_loc"];
	$hlProperty_Value = $_POST["hlProperty_Value"];
	$hlTotal_Obligation = $_POST["hlTotal_Obligation"];
	$hlloantime = $_POST["hlloantime"];
	$hlCo_Applicant_Name = $_POST["hlCo_Applicant_Name"];
	$hlCo_Applicant_DOB = $_REQUEST['hlCo_Applicant_DOB'];
	$hlCo_Applicant_Income = $_POST["hlCo_Applicant_Income"];
	$hlCo_Applicant_Obligation = $_POST["hlCo_Applicant_Obligation"];
	
	$Existing_Bank = $_POST['hl_Existing_Bank'];
	$Existing_Loan = $_POST['hl_Existing_Loan'];
	$Existing_ROI = $_POST['hl_Existing_ROI'];		

	$nn = count($Loan_Any);
	$ii  = 0;
	while ($ii < $nn)
	{
	$Loan_A .= "$Loan_Any[$ii], ";
	$ii++;
	}
	$IP = getenv("REMOTE_ADDR");

	
	$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
	list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
	$myrowcontr=count($myrow)-1;
	$CheckNumRows = $alreadyExist;
	$Dated = ExactServerdate();
	if($CheckNumRows>0)
	{
		$UserID = $myrow[$myrowcontr]["UserID"];
		$dataInsert = array('UserID'=>$UserID, 'Existing_Bank'=>$Existing_Bank, 'Existing_Loan'=>$Existing_Loan, 'Existing_ROI'=>$Existing_ROI, 'Property_Value'=>$hlProperty_Value, 'Co_Applicant_Name'=>$hlCo_Applicant_Name, 'Co_Applicant_DOB'=>$hlCo_Applicant_DOB, 'Co_Applicant_Income'=>$hlCo_Applicant_Income, 'Co_Applicant_Obligation'=>$hlCo_Applicant_Obligation, 'Total_Obligation'=>$hlTotal_Obligation, 'Company_Name'=>$Company_Name, 'Name'=>$Name, 'Email'=>$Email, 'Mobile_Number'=>$Mobile_Number, 'Employment_Status'=>$Employment_Status, 'Std_Code'=>$hlstd_code, 'Landline'=>$hllandline, 'Std_Code_O'=>$hlstd_code_o, 'Landline_O'=>$hllandline_o, 'City'=>$City, 'City_Other'=>$City_Other, 'Net_Salary'=>$IncomeAmount, 'Residence_Address'=>$hlresiaddress, 'Pincode'=>$hlpincode, 'Property_Identified'=>$hlproperty_identified, 'Loan_Time'=>$hlloantime, 'Loan_Amount'=>$Loan_Amount, 'Budget'=>$hlbudget, 'Property_Loc'=>$hlproperty_loc, 'Bidderid_Details'=>$Final_Bid, 'Allocated'=>$Allocated, 'DOB'=>$DOB, 'Add_Comment'=>$hladd_comment, 'Dated'=>$Dated, 'source'=>$source, 'Updated_Date'=>$Dated);

		//	echo "<br>if".$InsertProductSql;
	}
	else
	{
		$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
		$UserID = Maininsertfunc("wUsers", $wUsersdata);
		$dataInsert = array('UserID'=>$UserID, 'Existing_Bank'=>$Existing_Bank, 'Existing_Loan'=>$Existing_Loan, 'Existing_ROI'=>$Existing_ROI, 'Property_Value'=>$hlProperty_Value, 'Co_Applicant_Name'=>$hlCo_Applicant_Name, 'Co_Applicant_DOB'=>$hlCo_Applicant_DOB, 'Co_Applicant_Income'=>$hlCo_Applicant_Income, 'Co_Applicant_Obligation'=>$hlCo_Applicant_Obligation, 'Total_Obligation'=>$hlTotal_Obligation, 'Company_Name'=>$Company_Name, 'Name'=>$Name, 'Email'=>$Email, 'Mobile_Number'=>$Mobile_Number, 'Employment_Status'=>$Employment_Status, 'Std_Code'=>$hlstd_code, 'Landline'=>$hllandline, 'Std_Code_O'=>$hlstd_code_o, 'Landline_O'=>$hllandline_o, 'City'=>$City, 'City_Other'=>$City_Other, 'Net_Salary'=>$IncomeAmount, 'Residence_Address'=>$hlresiaddress, 'Pincode'=>$hlpincode, 'Property_Identified'=>$hlproperty_identified, 'Loan_Time'=>$hlloantime, 'Loan_Amount'=>$Loan_Amount, 'Budget'=>$hlbudget, 'Property_Loc'=>$hlproperty_loc, 'Bidderid_Details'=>$Final_Bid, 'Allocated'=>$Allocated, 'DOB'=>$DOB, 'Add_Comment'=>$hladd_comment, 'Dated'=>$Dated, 'source'=>$source, 'Updated_Date'=>$Dated);
		//echo "<br>else".$InsertProductSql;
	}
	//echo $InsertProductSql."<br>";
	$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
}
//$ProductValue = 748375;
$post = $ProductValue;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Calling Process</title>
<style type="text/css">
<!--
.style1 {font-family: Arial, Helvetica, sans-serif}
.style4 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; font-weight: bold; }
.style6 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.style7 {font-size: 14px}
-->
</style>
</head>
<body>
<?php
$viewqry="select Creative,Updated_Date,Dated,RequestID,  Referral_Flag, Property_Value, Co_Applicant_Name, Co_Applicant_DOB, Co_Applicant_Income , Co_Applicant_Obligation, Total_Obligation, Req_Loan_Home.checked_bidders, Req_Loan_Home.Tataaig_Home, Req_Loan_Home.Tataaig_Auto, Req_Loan_Home.Tataaig_Health,  Req_Loan_Home.Company_Name,  Req_Loan_Home.Dated, Req_Loan_Home.Name, Req_Loan_Home.Accidental_Insurance, Req_Loan_Home.source, Req_Loan_Home.Add_Comment, Req_Loan_Home.Landline, Req_Loan_Home.Std_Code, Req_Loan_Home.Residence_Address, Req_Loan_Home.Net_Salary, Req_Loan_Home.Sms_Sent, Req_Loan_Home.Email_Sent, Req_Loan_Home.Landline_O, Req_Loan_Home.Std_Code_O, Req_Loan_Home.Mobile_Number, Req_Loan_Home.Employment_Status, Req_Loan_Home.City, Req_Loan_Home.City_Other,  Req_Loan_Home.PL_Bank,  Req_Loan_Home.Loan_Amount,  Req_Loan_Home.Email, Req_Loan_Home.DOB, Req_Loan_Home.Budget, Req_Loan_Home.Property_Loc, Req_Loan_Home.Pincode, Req_Loan_Home.Loan_Time, Req_Loan_Home.Hl_mailer, Req_Loan_Home.Property_Identified, Req_Feedback_HL.Feedback, Req_Feedback_HL.BidderID, Req_Feedback_HL.Followup_Date, Req_Loan_Home.Bidderid_Details, Req_Loan_Home.Existing_Loan, Req_Loan_Home.Existing_Bank , Req_Loan_Home.Existing_ROI from Req_Loan_Home LEFT OUTER JOIN Req_Feedback_HL ON Req_Feedback_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_HL.BidderID in (732, 812, 460, 207, 64) where Req_Loan_Home.RequestID=".$ProductValue." "; 

//echo "dd".$qry;
list($viewleadscount,$row)=MainselectfuncNew($viewqry,$array = array());
		$cntr=0;

$Name = $row[$cntr]['Name'];
$Tataaig_Home=  $row[$cntr]['Tataaig_Home'];
$Company_Name = $row[$cntr]['Company_Name'];
$Hl_mailer = $row[$cntr]['Hl_mailer'];
$Dated = $row[$cntr]['Dated'];
$Tataaig_Health=  $row[$cntr]['Tataaig_Health'];
$Tataaig_Auto=  $row[$cntr]['Tataaig_Auto'];
$Mobile = $row[$cntr]['Mobile_Number'];
$Landline = $row[$cntr]['Landline'];
$Landline_O = $row[$cntr]['Landline_O'];
$Std_Code = $row[$cntr]['Std_Code'];
$Std_Code_O = $row[$cntr]['Std_Code_O'];
$Net_Salary = $row[$cntr]['Net_Salary'];
$Residence_Address = $row[$cntr]['Residence_Address'];
$City = $row[$cntr]['City'];
$City_Other = $row[$cntr]['City_Other'];
$Employment_Status = $row[$cntr]['Employment_Status'];
$Loan_Amount = $row[$cntr]['Loan_Amount'];
$Email = $row[$cntr]['Email'];
$source = $row[$cntr]['source'];
$add_comment = $row[$cntr]['Add_Comment'];
$Pincode = $row[$cntr]['Pincode'];
$Property_Loc = $row[$cntr]['Property_Loc'];
$Loan_Time = $row[$cntr]['Loan_Time'];
$followup_date = $row[$cntr]['Followup_Date'];
$Feedback = $row[$cntr]['Feedback'];
$Email_Sent = $row[$cntr]['Email_Sent'];
$Sms_Sent = $row[$cntr]['Sms_Sent'];
$Budget = $row[$cntr]['Budget']; 
$Bidderid_Details = $row[$cntr]['Bidderid_Details'];
$Property_Identified = $row[$cntr]['Property_Identified'];
$DOB = $row[$cntr]['DOB'];
$Accidental_Insurance = $row[$cntr]['Accidental_Insurance'];
$checked_bidders = $row[$cntr]['checked_bidders'];
$checked_bidders = explode(",",$checked_bidders);
$Property_Value = $row[$cntr]['Property_Value'];
$Co_Applicant_Name = $row[$cntr]['Co_Applicant_Name'];
$Co_Applicant_DOB = $row[$cntr]['Co_Applicant_DOB'];
$Co_Applicant_Income = $row[$cntr]['Co_Applicant_Income'];
$Co_Applicant_Obligation = $row[$cntr]['Co_Applicant_Obligation'];
$Total_Obligation = $row[$cntr]['Total_Obligation'];
$Referral_Flag = $row[$cntr]['Referral_Flag'];
if($Referral_Flag==0)
{
	$Referral_Flag = $row[$cntr]['Creative'];
}
$PL_Bank = $row[$cntr]['PL_Bank'];
$Existing_Bank = $row[$cntr]['Existing_Bank'];
$Existing_ROI = $row[$cntr]['Existing_ROI'];
$Existing_Loan = $row[$cntr]['Existing_Loan'];


list($year,$mm,$dd) = split('[-]', $DOB);

$monthly_income = $Net_Salary/12;

	$getnetAmount = ($monthly_income + $Co_Applicant_Income);
		$total_obligation = $Total_Obligation + $Co_Applicant_Obligation;
		$netAmount=($getnetAmount - $total_obligation);
		$dateofbirth = str_replace("-","", $DOB);
		$dateofbirth = DetermineAgeFromDOB($dateofbirth);
		$tenorPossible = 60 - $dateofbirth;



if($City=="Others")
	{
		$calcity=$City_Other;
		}
		else
	{
		$calcity=$City;
	}
    ?>

<form method="post" name="incoming_form2" action="leadentry_hl_thank_final.php">
<input type="hidden" name="leadid" id="leadid" value="<? echo $ProductValue; ?>"/>


<table cellpadding="6" cellspacing="0" border="1" align="center">
<tr><td colspan="3">
<table border="1" cellpadding="3" cellspacing="0" align="center"><tr>
		<td class="style4">Requestid</td>
			<td class="style4">Name</td>
			<td class="style4">Email</td>
			<td class="style4">Mobile</td>
			<td class="style4">Net_Salary</td>
			<td class="style4">City</td>
			<td class="style4">DOB</td>
			<td class="style4">Doe</td>
            
		</tr>
<tr>
		<td class="bodyarial11"><span class="style1"><?php echo $row[$cntr]["RequestID"]; ?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row[$cntr]["Name"]; ?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row[$cntr]["Email"]; ?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row[$cntr]["Mobile_Number"];?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo  $row[$cntr]["Net_Salary"];?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row[$cntr]["City"]; ?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo  $row[$cntr]["DOB"];?></span></td>
			<td class="bodyarial11"><span class="style1"><?php echo $row[$cntr]["Updated_Date"];?></span></td>
  </tr>
</table>
</td></tr>
<!--<tr><td colspan="3" valign="top" height="33"><span class="style6"><b>Eligible for Bidders</b></span></td></tr> -->
<tr><td  colspan="3" valign="top" align="center" class="style6" id="check">
<table border="1" width="80%">
<tr><td>Bank Name</td><td align='center'>Contact</td><td>Submit</td><td align='center'>Missed Call</td></tr>
<? if(strlen($Bidderid_Details)>0){?> already send<? } else {?><? list($FinalBidder,$finalBidderName)= geteligibleBiddersList("Req_Loan_Home",$post,$City,$Referral_Flag,$source);

//$a = geteligibleBiddersList("Req_Loan_Home",$post,$City,$Referral_Flag,$source);;
//print_r($a);
	for($i=0;$i<count($FinalBidder);$i++)
	{
	
		$getcontactin=("select Mobile_no From Req_Compaign Where (BidderID=".$FinalBidder[$i]." and Reply_Type=2 and Sms_Flag=1)");
		list($recordcount,$rowcontctin)=MainselectfuncNew($getcontactin,$array = array());
		$k=0;
		
		while($k<count($rowcontctin))
        {
			 $bidmobilein[] = $rowcontctin[$k]["Mobile_no"]; $k = $k +1;}
		$strbidmobile = implode(",",$bidmobilein);
	
		echo "<tr><td>".$finalBidderName[$i]."(".$FinalBidder[$i].")</td><td align='center'>$strbidmobile</td><td align='center'><input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'></td><td align='center'><input type='checkbox' value='$FinalBidder[$i]' name='FinalBidder_mcl[$i]' id='FinalBidder_mcl[$i]'></td></tr>";
	
	}
}
	?>
    
    </table>
    </td>
</tr>
<tr><td colspan="3"><table border="1" width="100%">


<tr> <td width="16%" height="25" align="center" valign="middle"><span style="font-family: Arial, Helvetica, sans-serif"><b style="font-size:12px;">Bank Name</b></span></td>
	<td width="15%" align="center"><span style="font-family: Arial, Helvetica, sans-serif"><b style="font-size:12px;">ROI</b></span></td>
	<td width="15%" align="center"><span style="font-family: Arial, Helvetica, sans-serif"><b style="font-size:12px;">EMI(Per Month)</b></span></td>
	<td width="9%" align="center"><span style="font-family: Arial, Helvetica, sans-serif"><b style="font-size:12px;">Tenure</b></span></td>
	<td width="15%" align="center"><span style="font-family: Arial, Helvetica, sans-serif"><b style="font-size:12px;">Eligible Loan Amt</b></span></td>
	<td width="15%" align="center"><span style="font-family: Arial, Helvetica, sans-serif"><b style="font-size:12px;">EMI(Per Lac)</b></span></td>
	<td width="15%" align="center"><span style="font-family: Arial, Helvetica, sans-serif"><b style="font-size:12px;">Total Interest Amt</b></span></td>
</tr>

<? 
$finalBidderName_unique = array_unique($finalBidderName);
$finalBidderName_unique1=implode(",",$finalBidderName_unique);
$finalBidderName = explode(",",$finalBidderName_unique1);


for($ij=0;$ij<count($finalBidderName);$ij++)
{
//	echo $finalBidderName[$ij];
		if($finalBidderName[$ij]=="HDFC" || $finalBidderName[$ij]=="HDFC Bank")
		{
			list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan(
	$getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value);
		?>
		 <tr> 
		 <td height="28" align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="style6"><?php echo $finalBidderName[$ij]; ?></span> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" ><?php echo $hdfcinter; ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="style6"><?php echo $hdfcemi; ?></span></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" ><?php echo abs($hdfcprint_term); ?> yrs.</b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" >Rs. <?php echo abs($hdfcviewLoanAmt); ?></b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" >Rs. <?php echo  $hdfcperlacemi; ?></b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" >Rs. <?php 
   $hdfcinterestfortwoyr= (($hdfcsemi * 24));
   $remingterm=$hdfcterm - 24;
   $hdfcgetinterestamt=(($hdfcactualemi * $remingterm)); 
   $hdfctotalinterestamt= (($hdfcinterestfortwoyr + $hdfcgetinterestamt) - $hdfcloan_amount);
   echo abs($hdfctotalinterestamt); ?></td>
   </tr>
   <?
		}
		elseif($finalBidderName[$ij]=="ICICI" || $finalBidderName[$ij]=="ICICI Bank")
		{
		list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan(
	$netAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value); 
		/*if($iciciviewLoanAmt<=2000000)
		{
			$viewinter="8%";
		}
		elseif($iciciviewLoanAmt>2000000)
		{
			$viewinter="8.25%";
		}*/
			?>
			<tr>
					 <td height="28" align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="style6"><?php echo $finalBidderName[$ij]; ?></span> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" ><? echo $iciciinter; ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="style6"><? echo $iciciactualemi; ?></span></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" ><?php echo abs($iciciprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" >Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" >Rs. <?php echo $iciciperlacemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" >Rs. <?php $iciciinterestfortwoyr= ($icicisemi * 24);
			
 $remingterm=$iciciterm - 24;
 							   
						   $icicigetinterestamt=(($iciciactualemi * $remingterm));
						  $icicitotalinterestamt= (($iciciinterestfortwoyr + $icicigetinterestamt) - $iciciviewLoanAmt);
							 echo abs($icicitotalinterestamt); ?></td>
							 </tr>
							 <?
	}
		elseif($finalBidderName[$ij]=="LIC Housing")
		{
		list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan(
	$getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value);
	?>
	<tr>
			 <td height="28" align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="style6"><?php echo $finalBidderName[$ij]; ?></span> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" ><?php echo abs($licinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="style6"><?php echo $licemi; ?></span></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" ><?php echo abs($licprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" >Rs. <?php echo abs($licviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" >Rs. <?php echo abs($licperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" >Rs. <?php $licgetinterestamt=(($licemi * $licterm)); echo $licgetinterestamt; ?></td>
	</tr>
	<?
		}
		elseif($finalBidderName[$ij]=="IDBI")
		{
			list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan(
	$getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value);
		?>
		 <tr>
		 		 <td height="28" align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="style6"><?php echo $finalBidderName[$ij]; ?></span> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" ><?php echo "8.25%(Fixed for 2 yrs)".abs($idbiinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="style6"><?php echo $idbiemi; ?></span></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" ><?php echo abs($idbiprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" >Rs. <?php echo abs($idbiviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" >Rs. <?php echo  $idbiperlacemifortwo."(Fixed For 2 yrs)".abs($idbiperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt style1 style7" >Rs. <?php 
							   
							   $idbiinterestfortwoyr= ($idbisemi * 24);
							   $remingterm=$idbiterm - 24;
						   $idbigetinterestamt=($idbiactualemi * $remingterm); 
						   $idbitotalinterestamt= ( ($idbiinterestfortwoyr + $idbigetinterestamt) - $idbiviewLoanAmt);
						   echo abs($idbitotalinterestamt); ?></td>
						   </tr>
						   <?
		}
	   elseif($finalBidderName[$ij]=="Axis Bank")
	{
	list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value);
	
	//echo "<a href='/home-loan-axis-bank.php' target='_blank'>Know More</a>";
		?>	
		<tr>
				 <td height="28" align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="style6"><?php echo $finalBidderName[$ij]; ?></span> </td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><span class="style6"><?php echo abs($axisinter); ?> %</span></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><span class="style6"><?php echo $axisemi; ?></span></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><span class="style6"><?php echo abs($axisprint_term); ?> yrs.</span></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><span class="style6">Rs. <?php echo abs($axisviewLoanAmt); ?></span></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><span class="style6">Rs. <?php echo abs($axisperlacemi); ?></span></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><span class="style6">Rs. 
	  <?php 
							      //$axisinterestfortwoyr= ($axissemi * 12);
							   $axisremingterm=$axisterm;
						   $axisgetinterestamt=(($axisactualemi * $axisremingterm)); 
						   $axistotalinterestamt= (($axisgetinterestamt) - $axisviewLoanAmt);
						    echo abs($axistotalinterestamt); ?>
	</span></td>
							</tr>
							<?
	}
elseif($finalBidderName[$ij]=="First Blue Home Finance" || $finalBidderName[$ij]=="First Blue" || (strncmp ("First", $finalBidderName[$ij],5))==0)
	{
	
		if($Employment_Status==0)
		{
			list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSE($getnetAmount,$dateofbirth,$total_obligation,$Property_Value,$Property_Identified);
		}
		else
		{
			list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSal($getnetAmount,$dateofbirth,$total_obligation,$Property_Value,$Property_Identified);
		}
		
?>
<tr>
				 <td height="28" align="center" bgcolor="#FFFFFF" class="tbl_txt" ><span class="style6"><?php echo $finalBidderName[$ij]; ?></span> </td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><span class="style6"><?php echo $frstblinter; ?> %</span></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><span class="style6"><?php echo $frstblactualemi; ?></span></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><span class="style6"><?php echo $frstblterm; ?> yrs.</span></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><span class="style6">Rs. <?php echo abs($frstblloan_amount); ?></span></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><span class="style6">Rs. <?php echo abs($perlacemi); ?></span></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><span class="style6">Rs. 
	  <?php 
							      ?>
	</span></td>
							</tr>
	 
	  <?
}
} 
?>
</table>
</td></tr>
<tr><td colspan="3" align="center"><input type="submit" name="submit" value="Final Send" /></td></tr>
</table>
</form>
</body>
</html>
