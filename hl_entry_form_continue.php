<?php
require 'scripts/db_init.php';
require 'scripts/db_init_bima.php';
require 'scripts/functions.php';
require 'eligiblebidderfunc.php';
require 'scripts/home_loan_eligibility_function.php';

//print_r($_POST);
$maxage=date('Y')-62;
$minage=date('Y')-18;

function DetermineAgeFromDOB ($YYYYMMDD_In){  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;  if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0) { $ydiff--;  }  }  return $ydiff;}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		
		$producttype=2;
		$hlname = $_POST["hlname"];
		$hlemail = $_POST["hlemail"];
		$hlmobile = $_POST["hlmobile"];
		$day = $_POST["day"];
		$month = $_POST["month"];
		$year = $_POST["year"];
		$hldob = $year."-".$month."-".$day;
		$hlstd_code = $_POST["hlstd_code"];
		$hllandline = $_POST["hllandline"];
		$hlstd_code_o = $_POST["hlstd_code_o"];
		$hllandline_o = $_POST["hllandline_o"];
		$hlcity = $_POST["hlcity"];
		$hlpincode = $_POST["hlpincode"];
		$hlresiaddress = $_POST["hlresiaddress"];
		$hlother_city = $_POST["hlother_city"];
		$hlemployment_status = $_POST["hlemployment_status"];
		$hlnet_salary = $_POST["hlnet_salary"];
		$hlcompany_name = $_REQUEST['hlcompany_name'];
		$hlloanamt = $_POST["hlloanamt"];
		$hlloantime = $_POST["hlloantime"];
		$hlproperty_identified = $_POST["hlproperty_identified"];
		$hlproperty_loc = $_POST["hlproperty_loc"];
		$hlProperty_Value = $_REQUEST['hlProperty_Value'];
		$hlTotal_Obligation = $_REQUEST['hlTotal_Obligation'];
		$hlCo_Applicant_Name = $_REQUEST['hlCo_Applicant_Name'];
		$hlCo_Applicant_DOB = $_REQUEST['hlCo_Applicant_DOB'];
		$hlCo_Applicant_Income = $_REQUEST['hlCo_Applicant_Income'];
		$hlCo_Applicant_Obligation = $_REQUEST['hlCo_Applicant_Obligation'];
		$source = $_REQUEST['source'];
		$IP = getenv("REMOTE_ADDR");
		$Phone=$hlmobile;
		
		
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Loan_Home  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9891118553','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
		//	echo $getdetails."<br>";
			//exit();
			
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
			if($alreadyExist>0)
			{
				$ProductValue=$myrow[$myrowcontr]['RequestID'];
				$_SESSION['Temp_LID'] = $ProductValue;
			/*	echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";*/
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$CheckQuery)=MainselectfuncNew($CheckSql,$array = array());
			$CheckQuerycontr=count($CheckQuery)-1;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $CheckQuery[$CheckQuerycontr]['UserID'];
				$InsertProductSql = "INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code, Updated_Date, Accidental_Insurance, Property_Identified, Employment_Status, DOB, Property_Loc, Co_Applicant_Name, Co_Applicant_DOB, Co_Applicant_Income, Co_Applicant_Obligation, Property_Value, Total_Obligation, Pincode, Privacy, Std_Code, Landline, Std_Code_O, Landline_O, Residence_Address) VALUES ( '".$UserID."', '".$hlname."', '".$hlemail."', '".$hlcity."', '".$hlother_city."', '".$hlmobile."', '".$hlnet_salary."', '".$hlloanamt."', Now(), '".$source."', '".$Referrer."', '".$Creative."' , '".$Section."', '".$IP."', '".$Reference_Code."', Now(), '".$Accidental_Insurance."', '".$hlproperty_identified."', '".$hlemployment_status."', '".$hldob."', '".$hlproperty_loc."','".$hlCo_Applicant_Name."', '".$hlCo_Applicant_DOB."', '".$hlCo_Applicant_Income."', '".$hlCo_Applicant_Obligation."', '".$hlProperty_Value."', '".$hlTotal_Obligation."', '".$hlpincode."', '".$accept."', '".$hlstd_code."', '".$hllandline."', '".$hlstd_code_o."', '".$hllandline_o."', '".$hlresiaddress."')"; 

				$dataInsert = array('UserID'=>$UserID, 'Name'=>$hlname, 'Email'=>$hlemail, 'City'=>$hlcity, 'City_Other'=>$hlother_city, 'Mobile_Number'=>$hlmobile, 'Net_Salary'=>$hlnet_salary, 'Loan_Amount'=>$hlloanamt, 'Dated'=>$Dated, 'source'=>$source, ' Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$hlproperty_identified, 'Employment_Status'=>$hlemployment_status, 'DOB'=>$hldob, 'Property_Loc'=>$hlproperty_loc, 'Co_Applicant_Name'=>$hlCo_Applicant_Name, 'Co_Applicant_DOB'=>$hlCo_Applicant_DOB, 'Co_Applicant_Income'=>$hlCo_Applicant_Income, 'Co_Applicant_Obligation'=>$hlCo_Applicant_Obligation, 'Property_Value'=>$hlProperty_Value, 'Total_Obligation'=>$hlTotal_Obligation, 'Pincode'=>$hlpincode, 'Privacy'=>$accept, 'Std_Code'=>$hlstd_code, 'Landline'=>$hllandline, 'Std_Code_O'=>$hlstd_code_o, 'Landline_O'=>$hllandline_o, 'Residence_Address'=>$hlresiaddress);

			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$dataUserInsert = array('Email'=>$Email,'FName'=>$Name,'Phone'=>$Phone,'Join_Date'=>$Dated,'IsPublic'=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $dataUserInsert);
							
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$hlname, 'Email'=>$hlemail, 'City'=>$hlcity, 'City_Other'=>$hlother_city, 'Mobile_Number'=>$hlmobile, 'Net_Salary'=>$hlnet_salary, 'Loan_Amount'=>$hlloanamt, 'Dated'=>$Dated, 'source'=>$source, ' Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$hlproperty_identified, 'Employment_Status'=>$hlemployment_status, 'DOB'=>$hldob, 'Property_Loc'=>$hlproperty_loc, 'Co_Applicant_Name'=>$hlCo_Applicant_Name, 'Co_Applicant_DOB'=>$hlCo_Applicant_DOB, 'Co_Applicant_Income'=>$hlCo_Applicant_Income, 'Co_Applicant_Obligation'=>$hlCo_Applicant_Obligation, 'Property_Value'=>$hlProperty_Value, 'Total_Obligation'=>$hlTotal_Obligation, 'Pincode'=>$hlpincode, 'Privacy'=>$accept, 'Std_Code'=>$hlstd_code, 'Landline'=>$hllandline, 'Std_Code_O'=>$hlstd_code_o, 'Landline_O'=>$hllandline_o, 'Residence_Address'=>$hlresiaddress);
				//echo "<br>else".$InsertProductSql;
			}
			
			//echo $InsertProductSql."<br>";
			$ProductValue = Maininsertfunc ('Req_Loan_Home', $dataInsert);
			$_SESSION['ProductValue'] = $ProductValue;
			$_SESSION['Name'] = $Name;	
			$post= $ProductValue;
		}

}
$monthly_income = $hlnet_salary/12;
$getnetAmount = ($monthly_income + $Co_Applicant_Income);
$Loan_Amount = $hlloanamt;
$total_obligation = $hlTotal_Obligation + $hlCo_Applicant_Obligation;
$netAmount=($getnetAmount - $total_obligation);
$dateofbirth = str_replace("-","", $hldob);
$dateofbirth = DetermineAgeFromDOB($dateofbirth);
$tenorPossible = 60 - $dateofbirth;
if($hlcity=="Others") { $calcity=$hlother_city;	} else { $calcity=$hlcity; }
$Property_Value = $hlProperty_Value; 
$Property_Identified = $hlproperty_identified;

//echo $getnetAmount." - ".$Loan_Amount." - ".$dateofbirth." - ".$total_obligation." - ".$calcity." - ".$Property_Value; 
//$getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value // HDFC
//$netAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value // ICICI
//$getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value //LIC
//$getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value //Axis
//$getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value //IDBI
//$getnetAmount,$dateofbirth,$total_obligation,$Property_Value,$Property_Identified //First Blue
//Array ( [source] => missed_call [hlname] => Upendra Kumar [hlemail] => [hlmobile] => 9971396361 [day] => 12 [month] => 12 [year] => 1980 [hlstd_code] => 0120 [hllandline] => 2657896 [hlstd_code_o] => 0120 [hllandline_o] => 2657896 [hlcity] => Delhi [hlpincode] => 201007 [hlresiaddress] => fdsdf [hlother_city] => [hlemployment_status] => 1 [hlnet_salary] => 600000 [hlcompany_name] => wrs [hlloanamt] => 2300000 [hlloantime] => 1 month [hlproperty_identified] => 1 [hlproperty_loc] => delhi [hlProperty_Value] => 2800000 [hlTotal_Obligation] => 2300 [hlCo_Applicant_Name] => Nidhi [hlCo_Applicant_DOB] => 12-12-1982 [hlCo_Applicant_Income] => 24000 [hlCo_Applicant_Obligation] => 1000 ) INSERT INTO Req_Loan_Home (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source, Referrer, Creative, Section, IP_Address, Reference_Code, Updated_Date, Accidental_Insurance, Property_Identified, Employment_Status, DOB, Property_Loc, Co_Applicant_Name, Co_Applicant_DOB, Co_Applicant_Income, Co_Applicant_Obligation, Property_Value, Total_Obligation, Pincode, Privacy, Std_Code, Landline, Std_Code_O, Landline_O, Residence_Address) VALUES ( '6699', 'Upendra Kumar', '', 'Delhi', '', '9971396361', '600000', '2300000', Now(), 'missed_call', '', '' , '', '122.176.100.27', '', Now(), '', '1', '1', '1980-12-12', 'delhi','Nidhi', '12-12-1982', '24000', '1000', '2800000', '2300', '201007', '', '0120', '2657896', '0120', '2657896', 'fdsdf')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Entry Form Continue</title>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
if($alreadyExist>0)
{
	echo "Already Applied";
	?>
    <br /><br />
<a href="hl_entry_form.php">Go Back</a>
    <?php
}
?>
<? if($hlcity=="Others" || $hlcity=="Please Select")
{
	$City=$hlother_city;
}
else
{
	$City= $hlcity;
}
list($FinalBidder,$finalBidderName)= geteligibleBiddersList("Req_Loan_Home",$post,$City,$Referral_Flag,$source);
if(count($FinalBidder)>0)
{
?>
<form name='hl_entry' action='hl_entry_form_thank.php' method='post'>
<input type="hidden" value="<? echo $ProductValue; ?>" name="Requestid" id="Requestid">
<table>
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Bidder Details</b></td></tr>

<tr><td><b>Eligible for Bidders</b></td><td id="check" colspan="2">
<? if(strlen($Bidderid_Details)>0){?> already send<? } else {?><? 
   for($i=0;$i<count($FinalBidder);$i++)
	{
echo "<input type='checkbox' value='$FinalBidder[$i]' name='Final_Bidder[$i]' id='Final_Bidder[$i]'>".$finalBidderName[$i]."(".$FinalBidder[$i].") ";
echo "&nbsp;";
	}
}
	
		?>
</td></tr>
	
<tr><td colspan="4">

<table border="1">
<tr> <td width="11%" height="25" align="center" valign="middle"><b style="font-size:12px;">Bank Name</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">ROI</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI(Per Month)</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Tenure</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Eligible Loan Amt</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">EMI(Per Lac)</b></td>
	<td width="11%" align="center"><b style="font-size:12px;">Total Interest Amt</b></td></tr>

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
		 <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $finalBidderName[$ij]; ?> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $hdfcinter; ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $hdfcemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($hdfcprint_term); ?> yrs.</b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($hdfcviewLoanAmt); ?></b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo  $hdfcperlacemi; ?></b></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php 
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
			?>
			<tr>
					 <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $finalBidderName[$ij]; ?> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><? echo $iciciinter; ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs <? echo $iciciactualemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($iciciprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($iciciviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $iciciperlacemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php $iciciinterestfortwoyr= ($icicisemi * 24);
			
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
			 <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $finalBidderName[$ij]; ?> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $licinter; ?> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $licemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $licprint_term; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $licviewLoanAmt; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $licperlacemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><!--Rs. <?php $licgetinterestamt=(($licemi * $licterm)); echo $licgetinterestamt; ?> --></td>
	</tr>
	<?
		}
		elseif($finalBidderName[$ij]=="IDBI")
		{
			list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan(
	$getnetAmount,$Loan_Amount,$dateofbirth,$total_obligation,$calcity,$Property_Value);
		?>
		 <tr>
		 		 <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $finalBidderName[$ij]; ?> </td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo "8.25%(Fixed for 2 yrs)".abs($idbiinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo $idbiemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo abs($idbiprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo abs($idbiviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php echo  $idbiperlacemifortwo."(Fixed For 2 yrs)".abs($idbiperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" class="tbl_txt" >Rs. <?php 
							   
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
				 <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $finalBidderName[$ij]; ?> </td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><?php echo abs($axisinter); ?> %</td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php echo $axisemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><?php echo abs($axisprint_term); ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php echo abs($axisviewLoanAmt); ?></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php echo abs($axisperlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php 
							      //$axisinterestfortwoyr= ($axissemi * 12);
							   $axisremingterm=$axisterm;
						   $axisgetinterestamt=(($axisactualemi * $axisremingterm)); 
						   $axistotalinterestamt= (($axisgetinterestamt) - $axisviewLoanAmt);
						    echo abs($axistotalinterestamt); ?></td>
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
				 <td align="center" bgcolor="#FFFFFF" class="tbl_txt" ><?php echo $finalBidderName[$ij]; ?> </td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><?php echo $frstblinter; ?> %</td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs <?php echo $frstblactualemi; ?></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;"><?php echo $frstblterm; ?> yrs.</td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php echo abs($frstblloan_amount); ?></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php echo abs($perlacemi); ?></td>
	<td align="center" bgcolor="#FFFFFF" style="font-size:12px;">Rs. <?php 
							      ?></td>
							</tr>
	 
	  <?
}
} 
?>
</table>
</td></tr>
<tr>
	<td><!--<b>Feedback</b> --></td>
	<td colspan="4" align="left"><!--<select name="hlfeedback" id="feedback">
		<option value="No Feedback" <? if($Feedback == "") { echo "selected"; }?>>No Feedback</option>
		<option value="Other Product" <? if($Feedback == "Other Product") { echo "selected"; }?>>Other Product</option>
		<option value="Not Interested" <? if($Feedback == "Not Interested") { echo "selected"; }?>>Not Interested</option>
		<option value="Callback Later" <? if($Feedback == "Callback Later") { echo "selected"; }?>>Callback Later</option>
		<option value="Wrong Number" <? if($Feedback == "Wrong Number") { echo "selected"; }?>>Wrong Number</option>
		<option value="Not Contactable" <? if($Feedback == "Not Contactable") { echo "selected"; }?>>Not Contactable</option>
		<option value="Duplicate" <? if($Feedback == "Duplicate") { echo "selected"; }?>>Duplicate</option>
		<option value="Ringing" <? if($Feedback == "Ringing") { echo "selected"; }?>>Ringing</option>
		<option value="Not Eligible" <? if($Feedback == "Not Eligible") { echo "selected"; }?>>Not Eligible</option>
		<option value="Send Now" <? if($Feedback == "Send Now") { echo "selected"; }?>>Send Now</option>
		<option value="FollowUp" <? if($Feedback == "FollowUp") { echo "selected"; }?>>FollowUp</option>
		</select> -->
    </td></tr>
    <tr><td colspan="5" align="center"><input type="submit" name="submit" value="submit"></td></tr>
</table>
</form>
<?php
}
?>
</body>
</html>
