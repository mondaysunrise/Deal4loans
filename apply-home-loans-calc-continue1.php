<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';
	require 'getlistofeligiblebidders1.php';
	
//	print_r($_POST);
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
function money_F($number)
{
setlocale(LC_ALL, 'en_IN');
 $strnumber=money_format('%i', $number);
	list($First_num,$Last_num) = split('[ ]', $strnumber);

$money_strnum = substr(trim($Last_num), 0, strlen(trim($Last_num))-3);

$getmoney_term[]= $money_strnum;

return($getmoney_term);
}

   
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$Net_Salary = $_POST['Net_Salary'];
	$getnetAmount = ($Net_Salary /12);
	$loan_amount = $_POST['Loan_Amount'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$dateofbirth = $year."-".$month."-".$day;
	$DOB = str_replace("-","", $dateofbirth);
	$age = DetermineAgeFromDOB($DOB);
	$total_obligation = $_POST['total_obligation'];
	$netAmount=($getnetAmount - $total_obligation);
	$City_Other = $_POST['City_Other'];
	$property_value = $_POST['Property_Value'];
	
	
		$City = $_POST['City'];
		$Property_Identified= $_POST['Property_Identified'];
		$Property_Loc= $_POST['Property_Loc'];
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$dob_arr[] = $_POST['year'];
		$dob_arr[] = $_POST['month'];
		$dob_arr[] = $_POST['day'];
		$dateofbirth = implode("-", $dob_arr);
		$company_name = $_POST['company_name'];
		$Employment_Status = $_POST['Employment_Status'];
		$Net_Salary = $_POST['Net_Salary'];
		$monthly_income = ($Net_Salary /12);
		$getnetAmount = ($Net_Salary /12);
		
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
		$mahindra_life = $_REQUEST["mahindra_life"];
		$Pincode = $_POST['Pincode'];
		$getnetAmount = ($monthly_income + $co_monthly_income);
		$total_obligation = $obligations + $co_obligations;
		$Activate = $_POST['Activate'];
		$Type_Loan = "Req_Loan_Home";
		$source = $_POST['source'];
		$Creative = $_POST['creative'];
		$hdfclife = $_POST['hdfclife'];
		$Section = $_POST['section'];
		$Accidental_Insurance = $_POST['Accidental_Insurance'];
		$Referrer=$_REQUEST['referrer'];
		$IP = getenv("REMOTE_ADDR");
		$IP= $_SERVER['HTTP_X_REAL_IP'];
		$netAmount=($getnetAmount - $total_obligation);
		$accept = $_POST["accept"];
		
		if($City=="Others")
		{
			$strCity = $City;		
		}
		else
		{
			$strCity = $City;
		}
	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
function Insert_clientlead($ProductValue, $Name, $City, $Phone, $Email)
	{
		$Dated=ExactServerdate();
		$data = array("product_type"=>'2' , "requestid"=>$Product_Name , "clientld_name"=>$Name , "clientld_email"=>$Email , "clientld_mobile"=>$Phone, "clientld_city"=>$City , "client_name"=> 'mahindra_lifespace' , "clientld_date"=>$Dated , "client_splcondition"=>$Mobile );
		$table = 'client_campaign_leads';
		$insert = Maininsertfunc ($table, $data);
	}
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
			
			$getdetails="select RequestID From ".$Type_Loan."  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('98925%8553','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
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
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>'1', 'DOB'=>$dateofbirth, '	Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Privacy'=>$accept);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>'1', 'DOB'=>$dateofbirth, '	Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Privacy'=>$accept);
			}
			
			//echo $InsertProductSql."<br>";
			$ProductValue = Maininsertfunc ("Req_Loan_Home", $dataArray);
		if($hdfclife==1)
		{
			$Product=2;
			Insert_HdfcLife($Name, $City, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}
		if(strlen($mahindra_life)>0)
		{
			Insert_clientlead($ProductValue, $Name, $strCity, $Phone, $Email);
		}
			list($First,$Last) = split('[ ]', $Name);

			
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan. You will get a call from us to give you quotes & information to get you best deal for loans.";
			//if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$FName=$Name;
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<title>Home Loan Eligibility Calculator – Calculate Housing loan eligibility </title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="home loan emi calculator, home loan calculator, home loan eligibility calculator, Home loan calculator India, housing loan eligibility, housing loan eligibility calculator, housing loan eligibility India"> 
<meta name="Description" content="Home Loan Eligibility calculator: Use Eligibility calculator to know your loan eligibility & the applicable EMI for your housing loan amount.">
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href="source.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include "middle-menu.php"; ?>
<!--logo navigation-->
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span  class="text12" style="color:#4c4c4c;">Home Loan Eligibility Calculator </span></div>
<div>


<div style="clear:both; height:25px;"></div>
<table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td bgcolor="#dbf2ff" ><div class="overflow-width"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  height="35" class="tbl_txt">
    <div align="center"><b>Thank you for applying for Home Loan through Deal4Loans.com. You will soon receive call from us for further assistance.</b></div>
        </td>
    
    </tr>
      <tr>
        <td height="35" class="tbl_txt" ><table width="100%"  border="0" cellspacing="2" cellpadding="0">
          <tr align="center">
		  <td width="25%" height="30" class="tbl_blutxt" bgcolor="#CCCCCC"><b>Bank Name</b></td>
            <td width="25%" class="tbl_blutxt" bgcolor="#CCCCCC"><b>Interest Rate</b> </td>
			<td width="25%" class="tbl_blutxt" bgcolor="#CCCCCC"><b>EMI (Per Month)</b></td>
			<td width="25%" class="tbl_blutxt" bgcolor="#CCCCCC"><b>Eligible Loan Amount</b></td>
		    <td width="25%" class="tbl_blutxt" bgcolor="#CCCCCC"><b>Tenure</b></td>
			</tr>
        </table></td>
      </tr>
	 <!--  <tr>
            <td colspan="6" align="center" bgcolor="#FFFFFF"><img src="new-images/hl-thnk-btm.jpg" width="959" height="11" /></td>
          </tr>
	   -->

<? $Final_Bid=array('Axis Bank','IDBI Bank','LIC Housing','ICICI Bank','HDFC Bank','Fedbank');

/*for($i=0;$i<count($Final_Bid);$i++)
	{*/
		?>
	
         
                  <?
			
	list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
if($axisloan_amount>0)
		{
		?> 
	<tr>
		 <td height="50" class="tbl_txt" ><table width="100%"  border="0" cellspacing="2" cellpadding="0">
		<tr align="center">
                  <td width="25%" height="30" bgcolor="#FFFFFF"  ><img src="new-images/thnk-axis.gif" width="86" height="20" /><br /> 
              <? echo "Axis Bank"; ?></td>
				 
                  <td width="25%" bgcolor="#FFFFFF"><?php echo $axisinter; ?> %</td>
                  <td width="25%" bgcolor="#FFFFFF" ><?php echo "".$axisemi; ?> </td>
                  <td width="25%" bgcolor="#FFFFFF" >Rs. <?php list($Last_num)=money_F($axisviewLoanAmt);  echo "<b>".$Last_num."</b>"; ?></td>
                  <td width="25%" bgcolor="#FFFFFF" ><?php echo abs($axisprint_term); ?> yrs.</td>
				  
			    </tr>
	        </table></td>
          </tr>
                  <? 
		}
				list($pnbemi,$pnbinter,$pnbterm,$pnbloanamt) = PNB_Homeloan($getnetAmount,$age,$obligation,$property_value);
			if($pnbloanamt>0)
			{
				?>

				<tr>
		 <td height="50" class="tbl_txt" ><table width="100%"  border="0" cellspacing="2" cellpadding="0">
		<tr align="center">
                  <td width="25%" height="30" bgcolor="#FFFFFF"  ><img src="new-images/pnbhfl-logo.jpg" width="105" height="20"  /><br /> 
              <? echo "PNB Housing Finance"; ?></td>
				 
                  <td width="25%" bgcolor="#FFFFFF"><?php echo $pnbinter; ?> %</td>
                  <td width="25%" bgcolor="#FFFFFF" ><?php echo "".$pnbemi; ?> </td>
                  <td width="25%" bgcolor="#FFFFFF" >Rs. <?php list($Last_num)=money_F($pnbloanamt);  echo "<b>".$Last_num."</b>"; ?></td>
                  <td width="25%" bgcolor="#FFFFFF" ><?php echo abs($pnbterm); ?> yrs.</td>
				  
			    </tr>
	        </table></td>
          </tr>
		<? }
				  //}
	
	/*elseif(($Final_Bid[$i]=="IDBI Housing Finance" || $Final_Bid[$i]=="IDBI Bank"))
	{*/
		list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		if($idbiloan_amount>0)
		{
			?> 
			<tr>
		 <td height="63" class="tbl_txt" ><table width="100%"  border="0" cellspacing="2" cellpadding="0">
		 <tr align="center">
		<td width="25%" height="40" bgcolor="#FFFFFF"  >             
		  <? echo "IDBI Bank"; ?></td>
		          <td width="25%" bgcolor="#FFFFFF" ><?php echo $idbiinter; ?> %</td>
				  <td width="25%" bgcolor="#FFFFFF" >Rs. <?php echo $idbiemi; ?></td>
				 <td width="25%" bgcolor="#FFFFFF" >Rs. <?php list($Last_num)=money_F($idbiviewLoanAmt);  echo "<b>".$Last_num."</b>"; ?></td>
                  <td width="25%" bgcolor="#FFFFFF" ><?php echo abs($idbiprint_term); ?> yrs.</td>
				  
		 </tr>
		      </table></td>
          </tr>
                  <?
		}
		 list($federalemi,$federalinter,$federalterm,$federalloanamt) = federal_Homeloannew($getnetAmount,$age,$obligation,$property_value,$loan_amount);
			if($federalloanamt>0)
			{
				?>
				<tr>
		 <td height="63" class="tbl_txt" ><table width="100%"  border="0" cellspacing="2" cellpadding="0">
		 <tr align="center">
		<td width="25%" height="40" bgcolor="#FFFFFF"  >             
		<img src="http://www.deal4loans.com/new-images/federal_bnksmll.jpg" width="86" height="20" /><br><span style="color:#004c9a;">A FEDERAL BANK SUBSIDIARY</span><br /> 
		<? echo "Fedbank"; ?></td>
		          <td width="25%" bgcolor="#FFFFFF" ><?php echo $federalinter; ?> %</td>
				  <td width="25%" bgcolor="#FFFFFF" >Rs. <?php echo $federalemi; ?></td>
				 <td width="25%" bgcolor="#FFFFFF" >Rs. <?php list($Last_num)=money_F($federalloanamt);  echo "<b>".$Last_num."</b>"; ?></td>
                  <td width="25%" bgcolor="#FFFFFF" ><?php echo $federalterm; ?> yrs.</td>
				  
		 </tr>
		      </table></td>
          </tr>

		<?	}
			
	/*}
	elseif($Final_Bid[$i]=="LIC Housing" || $Final_Bid[$i]=="LIC")
	{*/
		list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		if($licviewLoanAmt>0)
		{
	?>
	<tr>
		<td height="63" class="tbl_txt" ><table width="100%"  border="0" cellspacing="2" cellpadding="0">
	 <tr align="center">
                  <td width="25%" height="30" bgcolor="#FFFFFF"  > 
              <? echo "LIC Housing"; ?></td>
			
                  <td width="25%" align="center" bgcolor="#FFFFFF"><?php echo $licinter; ?> %</td>
                  <!--<td width="201" align="left" ><?php //echo $licperlacemi; ?></td>-->
                  
                  <td width="25%" align="center" bgcolor="#FFFFFF" ><?php echo $licemi; ?></td>
				  <td width="25%" bgcolor="#FFFFFF" >Rs. <?php list($Last_num)=money_F($licviewLoanAmt);  echo "<b>".$Last_num."</b>"; ?></td>
				  <td width="25%" bgcolor="#FFFFFF" ><?php echo $licprint_term; ?> yrs.</td>
		
			    </tr>
				  
	        </table></td>
          </tr>
                  <?
}
	/*}
	elseif($Final_Bid[$i]=="ICICI" || $Final_Bid[$i]=="ICICI Bank")
	{*/
	//echo $netAmount."LA ".$loan_amount."A ".$age." TO".$total_obligation."cty".$strCity."PV".$property_value;
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
if($iciciviewLoanAmt>0)
		{
?>
<tr>
		 <td height="63" class="tbl_txt" ><table width="100%"  border="0" cellspacing="2" cellpadding="0">
 <tr align="center">
   <td width="25%" height="30" bgcolor="#FFFFFF"  ><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" width="86" height="20" /><br /> 
              <? echo "ICICI Bank"; ?></td>
			 <td width="25%" bgcolor="#FFFFFF"  ><? echo $iciciinter; ?> %</td>
                  <!--<td width="154" align="left" >Rs. <?php //echo $iciciperlacemi; ?></td>-->
			      <td width="25%" align="left" bgcolor="#FFFFFF" ><?  echo $iciciactualemi; ?></td>
                 <td width="25%" bgcolor="#FFFFFF" >Rs. <?php list($Last_num)=money_F($iciciviewLoanAmt); echo "<b>".$Last_num."<b>"; ?></td>
			    <td width="25%" bgcolor="#FFFFFF" ><?php echo $iciciprint_term; ?> yrs.</td>
				
			    </tr>
	        </table></td>
          </tr>
                  <?
	}
	//}
	//echo $getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value;
		list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	if($hdfcviewLoanAmt>0)
		{
	?>
	<tr>
		<td height="63" class="tbl_txt" ><table width="100%"  border="0" cellspacing="2" cellpadding="0">
	 <tr align="center">
     <td width="25%" height="30" bgcolor="#FFFFFF"  ><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20" /><br /> 
              <? echo "HDFC Bank"; ?></td>
			  	
                  <td width="25%" bgcolor="#FFFFFF" ><?php echo $hdfcinter; ?>%</td>
                  <!--<td width="201" align="left" >Rs. <?php //echo  $hdfcperlacemi; ?></td>-->
				  <td width="25%" bgcolor="#FFFFFF" ><?php echo $hdfcemi; ?></td>
                 <td width="25%" bgcolor="#FFFFFF" >Rs. <?php list($Last_num)=money_F($hdfcviewLoanAmt);  echo "<b>".$Last_num."</b>"; ?> </td>
                  <td width="25%" bgcolor="#FFFFFF" ><?php echo abs($hdfcprint_term); ?> yrs.</td>
				
		        </tr>
	        </table></td>
          </tr>
<?
	}
	?>        
          <? //}
		 
		 list($sbiemi,$sbiinter,$sbiprint_term,$sbiloan_amount,$sbiviewLoanAmt,$sbiperlacemi,$sbiterm)=@sbi_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		if($sbiloan_amount>0)
		{
			//echo "hello";
		?>
		
		<tr>
		<td height="53" class="tbl_txt" ><table width="100%"  border="0" cellspacing="2" cellpadding="0">
		<tr align="center">
		  <td width="25%" bgcolor="#FFFFFF" height="20" >State Bank Of India<br /> </td>
                  <td width="25%" align="center" bgcolor="#FFFFFF" ><?php echo $sbiinter; ?> </td>
                  <!--<td width="151" align="left" ><?php //echo $sbiperlacemi; ?></td>-->
			      <td width="25%" align="center" bgcolor="#FFFFFF"><?php echo "".$sbiemi; ?></td>
                  <td width="25%" align="center" bgcolor="#FFFFFF" >Rs.<?php list($Last_num)=money_F($sbiviewLoanAmt);  echo "<b>".$Last_num."</b>"; ?></td>
                  <td width="25%" bgcolor="#FFFFFF" ><?php echo $sbiprint_term; ?> yrs.</td>
				
		 </tr></table></td></tr>
		<? }
		?>
	 <tr>
            <td align="center" bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
                   	 <tr>
            <td align="center" bgcolor="#FFFFFF">
                   
            </td>
          </tr>
	</table></div></td></tr></table>
</div>
<div style="clear:both; height:45px;"></div>
</div>
<?php include "footer_sub_menu.php"; ?>

</body>
</html>

