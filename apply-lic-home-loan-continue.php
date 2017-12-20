<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';
	require 'eligiblebidderfunc.php';
	require 'eligiblebidderfunc_lic.php';

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
		$City = $_POST['City'];
		$Other_City = $_POST['City_Other'];
		$Property_Identified= $_POST['Property_Identified'];
		$Property_Loc= $_POST['Property_Loc'];
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$dob_arr[] = $_POST['year'];
		$dob_arr[] = $_POST['month'];
		$dob_arr[] = $_POST['day'];
		$dateofbirth = implode("-", $dob_arr);
		$Employment_Status = $_POST['Employment_Status'];
		$Net_Salary = $_POST['Net_Salary'];
		$monthly_income = ($Net_Salary /12);
		$obligations = $_POST['obligations'];
		$loan_amount = $_POST['Loan_Amount'];
		$co_appli = $_POST['co_appli'];
		$co_name = $_POST['co_name'];
		$dob_arr_co[] = $_POST['co_year'];
		$dob_arr_co[] = $_POST['co_month'];
		$dob_arr_co[] = $_POST['co_day'];
		$DOB_co = implode("-", $dob_arr_co);
		$co_monthly_income = $_POST['co_monthly_income'];
		$co_obligations = $_POST['co_obligations'];
		$property_value = $_POST['property_value'];
		$Pincode = $_POST['Pincode'];

		$getnetAmount = ($monthly_income + $co_monthly_income);
		$total_obligation = $obligations + $co_obligations;
		$Type_Loan = "Req_Loan_Home";
		$source = $_POST['source'];
		$IP = getenv("REMOTE_ADDR");
		$netAmount=($getnetAmount - $total_obligation);
		$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$tenorPossible = 60 - $DOB;
		$edelweiss = $_POST["edelweiss"];
		$Dated = ExactServerdate();
		
			$crap = " ".$Name." ".$Email." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From ".$Type_Loan."  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9891118553','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr = count($myrow)-1;
			$checkNum = $alreadyExist;

			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
				list($CheckNumRows,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
							
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$loan_amount, "Dated"=>$Dated, "source"=>$source, " Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP, "Reference_Code"=>$Reference_Code, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance, "Property_Identified"=>$Property_Identified, "Employment_Status"=>$Employment_Status, "DOB"=>$dateofbirth, "Property_Loc"=>$Property_Loc, "Co_Applicant_Name"=>$co_name, "Co_Applicant_DOB"=>$DOB_co, "Co_Applicant_Income"=>$co_monthly_income, "Co_Applicant_Obligation"=>$co_obligations, "Property_Value"=>$property_value, "Total_Obligation"=>$obligations, "Edelweiss_Compaign"=>$edelweiss, "Pincode"=>$Pincode);

			
			}
			else
			{
				//$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$dataInsertsql = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$tablesql = 'wUsers';
				$UserID = Maininsertfunc ($tablesql, $dataInsertsql);
				
				
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$loan_amount, "Dated"=>$Dated, "source"=>$source, " Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP, "Reference_Code"=>$Reference_Code, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance, "Property_Identified"=>$Property_Identified, "Employment_Status"=>$Employment_Status, "DOB"=>$dateofbirth, "Property_Loc"=>$Property_Loc, "Co_Applicant_Name"=>$co_name, "Co_Applicant_DOB"=>$DOB_co, "Co_Applicant_Income"=>$co_monthly_income, "Co_Applicant_Obligation"=>$co_obligations, "Property_Value"=>$property_value, "Total_Obligation"=>$obligations, "Edelweiss_Compaign"=>$edelweiss, "Pincode"=>$Pincode);
$table = 'Req_Loan_Home';
			
			}
			
			
			$table = 'Req_Loan_Home';
			$ProductValue = Maininsertfunc ($table, $dataInsert);
			list($First,$Last) = split('[ ]', $Name);
		
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan. You will get a call from us to give you quotes & information to get you best deal for loans.";
			if(strlen(trim($Phone)) > 0)
			SendSMS($SMSMessage, $Phone);
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$FName=$Name;
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Home Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Home Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			
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
><h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Home Loan through Deal4loans.com. You will soon receive a call from us.</h1>
<div align="center"><b>Your EMI and Rates Quotes for the Home Loan from partner Banks are listed Below.
</b></div>
</td>
</tr>
<tr><td>
<table>
<tr><td>

<table width="960"  border="0" align="center" cellpadding="0" cellspacing="0">
<? 

if($licloan_amount>0 && $Net_Salary>=180000) { ?>
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
		   <tr>
            <td colspan="6" align="right" ><a href="http://www.deal4loans.com/rate-disclaimer.php" target="_blank">Disclaimer</a></td>
          </tr>
          <tr>
            <td colspan="6" align="center" bgcolor="#FFFFFF"><img src="new-images/hl-thnk-btm.jpg" width="959" height="11" /></td>
          </tr>
	  <!-------------------->
	  
	  </table>
	 
	  </td></tr>
	  
<?	  if($strCity==$Property_Loc || (($strCity=="Delhi" || $strCity=="Noida" || $strCity=="Gurgaon" || $strCity=="Faridabad" || $strCity=="Gaziabad") && ($Property_Loc=="Delhi" || $Property_Loc=="Noida" || $Property_Loc=="Gurgaon" || $Property_Loc=="Faridabad" || $Property_Loc=="Gaziabad")) || (($strCity=="Mumbai" || $strCity=="Thane" || $strCity=="Navi Mumbai") && ($Property_Loc=="Mumbai" || $Property_Loc=="Thane" || $Property_Loc=="Navi Mumbai")))
		{
list($FinalBidder_lic,$finalBidderName_lic)= geteligibleBidders_lic("Req_Loan_Home",$ProductValue,$strCity);	
$getbidstr=implode(",",$FinalBidder_lic);
//print_r($FinalBidder_lic);


//print_r($FinalBidder);
//echo "<br>";
		}
	if(count($FinalBidder_lic)>0)
	{
?>
	 <tr>
	  <td colspan="7" height="53" style="color:#103E6B;line-height:25px; font-size:12px; background-repeat:no-repeat; background-position:center;   " background="new-images/blu-bordrbg.gif" class="boldtxt" >
	  <form action="apply-lic-housing-thanks.php" name="Sub" method="post">
	  <input type="hidden" name="lead_id" value="<?php echo $ProductValue; ?>">
	<input type="hidden" name="city" value="<?php echo $strCity; ?>">
	<input type="hidden" name="Bidderid_Details" value="<?php echo $getbidstr; ?>">
	<input type="hidden" name="code" value="lic_lp">
	  <table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="80%">Do you wish LIC Housing Team to contact you for more information on loan and process : </td>
            <td width="20%"><input type="image" name="Yes" value="" src="new-images/apply-btn1.jpg" border="0" style="border:0px;"></td>
          </tr>
<? }
else 
	{
	list($FinalBidder,$finalBidderName)= geteligibleBiddersList("Req_Loan_Home",$ProductValue,$strCity);
	 if(count($FinalBidder)>0)
		{?>
	 <tr>
	  <td colspan="7" height="53" style="color:#103E6B;line-height:25px; font-size:12px; background-repeat:no-repeat; background-position:center;   " background="new-images/blu-bordrbg.gif" class="boldtxt" >
	  <form action="apply-lic-housing-thanks.php" name="Sub" method="post">
	  <input type="hidden" name="lead_id" value="<?php echo $ProductValue; ?>">
	<input type="hidden" name="city" value="<?php echo $strCity; ?>">
		<input type="hidden" name="code" value="LIC_lms">
	  <table width="720" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="80%">Do you wish to compare rates with other Banks, then Apply: </td>
            <td width="20%"><input type="image" name="Yes" value="" src="new-images/apply-btn1.jpg" border="0" style="border:0px;"></td>
          </tr>
<?	}
	}
?>
      </table></form></td>
	  </tr>
	  <? }

else
{
	?>
<tr>
		<td colspan="7" class="boldtxt" style="color:#103E6B; padding-left:15px; line-height:18px; font-size:12px; ">We're sorry. Our automated system could not locate an offer for you at this time. However our representatives might be able to find you an offer and communicate to you. <? //echo $Feedback; ?></td>
	</tr>
<? } ?>
</table> 
</td></tr></table>
</td>
</tr>
</table>
</body>
</html>
