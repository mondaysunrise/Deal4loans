<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';
	require 'getlistofeligiblebidders1.php';
	

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
   
function getNumberFormat($number) {
	if($number > 10000000)	{		$num = ((float)$number) / 10000000;	$num = $num.' Crores';	}
	else if($number > 100000)	{	$num = ((float)$number) / 100000;	$num = $num.' Lacs';	}
	else if($number > 1000)	{		$num = ((float)$number) / 1000;		$num = $num.' Thousands';}
	return $num;
}   
   
function DetermineAgeFromDOB ($YYYYMMDD_In)
{  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;
  if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }
function money_F($number)
{setlocale(LC_ALL, 'en_IN');  $strnumber=money_format('%i', $number);	list($First_num,$Last_num) = split('[ ]', $strnumber);
 $money_strnum = substr(trim($Last_num), 0, strlen(trim($Last_num))-3);$getmoney_term[]= $money_strnum; return($getmoney_term); }
   
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$Net_Salary = $_POST['Net_Salary'];
	$getnetAmount = ($Net_Salary /12);
	$getnetAmount = 100000;
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
	$property_value = 6000000;
	
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
		
		
//		$City = "Delhi";
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
//				mail($Email, $SubjectLine, $Message2, $headers);
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
/*
$ProductValue = 879254;
$getnetAmount = 70000;
$loan_amount = 6000000;
$age = 33;
$total_obligation = 0;
$strCity = 'Delhi';
$City = 'Delhi';
$property_value = 7700000;
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Home Loan Eligibility Calculator – Calculate Housing loan eligibility </title>
<meta name="keywords" content="home loan emi calculator, home loan calculator, home loan eligibility calculator, Home loan calculator India, housing loan eligibility, housing loan eligibility calculator, housing loan eligibility India"> 
<meta name="Description" content="Home Loan Eligibility calculator: Use Eligibility calculator to know your loan eligibility & the applicable EMI for your housing loan amount.">
<style type="text/css">
<!-- 
body {	margin-left: 0px;margin-top: 0px;	margin-right: 0px;	margin-bottom: 0px;	background-color: #203f5f;	overflow-x:hidden;	background-color:#FFF; }
.red {	color: #F00;}

.boxmagic-main-wrapper{width:310px; margin:auto;}
.boxmagic-main{ width:310px; float:left; border:#CCCCCC thin solid; margin-right:3px; margin-bottom:5px; background-color:#FFFFFF;}
.textmag-head{ font-family:Verdana, Geneva, sans-serif; font-size:12px; color:#0066cc; text-indent:5px; font-weight:bold; background-color:#CCCCCC;} 
.price-text{ color:#c3262d; font-size:12px; font-family:Verdana, Geneva, sans-serif; font-weight:bold;}
.textmagbody{ font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333;}
.buttonmag{ font-family:Verdana, Geneva, sans-serif; text-align:center; color:#FFF; font-size:12px; background:#F60; border:none; width:137px; height:29px; border:#b04b1f solid thin;}
.wrapper_contined_second{ width:995px; margin:auto;}
.textcontineshead{ font-family:Arial, Helvetica, sans-serif; font-size:21px; color:#72942b; font-weight:bold; text-align:center;}
.radish_color{ color:#c20303; font-size:17px; font-weight:normal;}
.continue_left_box{ float:left; width:720px; margin-top:5px; text-align:left;}
.tdcontined{ background:url(images/tdcontined.jpg) repeat-x; height:26px; border:#CCC thin solid; color:#203f5f; font-size:12px; text-align:center; font-family:Verdana, Geneva, sans-serif;}
.celltext{ thin solid; color:#203f5f; font-size:12px; text-align:center; font-family:Verdana, Geneva, sans-serif;}
.right_continued{ float:right; width:260px; margin-top:5px;}
.right_continuedinn{width:260px;}
.right_continuedinnhead{width:250px; padding:5px 0px 5px 5px; background:#f6f4eb; border-bottom:#dddddd solid thin; font-family: Verdana, Geneva, sans-serif; font-size:13px; font-weight:bold; color:#0964c1;}
.right_continuedinnbelow{width:100%; padding:10px 0px 10px 5px; background:#def2fd; border-bottom:#dddddd solid thin; font-family: Verdana, Geneva, sans-serif; font-size:12px;}
.righttexbx{font-family: Verdana, Geneva, sans-serif; font-size:14px; color:#b1420c; font-weight:bold;}
.buttonmag {
font-family: Verdana, Geneva, sans-serif;
text-align: center;
color: #FFF;
font-size: 12px;
background: #F60;
border: none;
width: 137px;
height: 29px;
border: #b04b1f solid thin;
}
.right_continuedinnsecond{width:330px; float:left; margin-top:10px; margin-right:25px;}
.right_continuedinnhead{width:100%; padding:5px 0px 5px 5px; background:#f6f4eb; border-bottom:#dddddd solid thin; font-family: Verdana, Geneva, sans-serif; font-size:13px; font-weight:bold; color:#0964c1;}
@media screen and (max-width: 768px) {
.boxmagic-main-wrapper{width:600px; margin:auto;}
.boxmagic-main{ width:100%; float:none; border:#CCCCCC thin solid; margin-right:3px; margin-bottom:5px;}
.textmag-head{ font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#0066cc; text-indent:5px; font-weight:bold;} 
.price-text{ color:#c3262d; font-size:14px; font-family:Verdana, Geneva, sans-serif; font-weight:bold;}
.textmagbody{ font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333;}
.buttonmag{ font-family:Verdana, Geneva, sans-serif; text-align:center; color:#FFF; font-size:14px; background:#F60; border:none; width:137px; height:29px; border:#b04b1f solid thin;}
}

-->
</style>
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
</head>
<body>

<?php include "top-menu.php"; ?>
<?php include "main-menu.php"; ?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span  class="text12" style="color:#4c4c4c;">Home Loan Eligibility Calculator </span></div>
<div class="intrl_txt" style="margin:auto;">
<div style="clear:both; height:5px;"></div>
<div class="wrapper_contined_second">
<div class="textcontineshead">	<?php //print_r($_POST); ?>Thank you for applying for Home Loan through Deal4Loans.com<br /><div class="radish_color">You will soon receive call from us for further assistance.</div>
<div style="clear:both;"></div>
</div>
<div class="continue_left_box">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#dddddd">
  <tr>
    <td width="21%" class="tdcontined">Bank Name</td>
    <td width="20%" class="tdcontined">Interest Rate</td>
    <td width="22%" class="tdcontined">EMI (Per Month)</td>
    <td width="23%" class="tdcontined">Eligible Loan Amount</td>
    <td width="14%" class="tdcontined">Tenure</td>
  </tr>
  <?php
	$Final_Bid=array('Axis Bank','IDBI Bank','LIC Housing','ICICI Bank','HDFC Bank','Fedbank');
	$eligibileLoanAmtArr = '';
  
  	list($axisactualemi,$axisemi,$axisinter,$axisprint_term,$axisloan_amount,$axisviewLoanAmt,$axisperlacemi,$axisperlacemifortwo,$axisterm,$axissemi)=Axis_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
if($axisloan_amount>0)
		{
		$eligibileLoanAmtArr[] = $axisviewLoanAmt;
		?> 
  <tr>
    <td height="60" colspan="5" align="center" valign="middle" bgcolor="#dddddd" class="tdborder">
    
    <table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td width="21%" height="60" align="center" valign="middle" bgcolor="#FFFFFF" class="tdborder"><img src="new-images/thnk-axis.gif" width="86" height="20" /><br /> 
              <? //echo "Axis Bank"; ?></td>
        <td width="20%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo $axisinter; ?> %</td>
        <td width="22%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo "".$axisemi; ?></td>
        <td width="23%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php list($Last_num)=money_F($axisviewLoanAmt);  echo "<b>".$Last_num."</b>"; ?></td>
        <td width="14%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo abs($axisprint_term); ?> yrs.</td>
      </tr>
    </table>
    
    </td>
    </tr>
  <?php
  }
  	list($pnbemi,$pnbinter,$pnbterm,$pnbloanamt) = PNB_Homeloan($getnetAmount,$age,$obligation,$property_value);
			if($pnbloanamt>0)
			{
					$eligibileLoanAmtArr[] = $pnbloanamt;
				?>
  
  <tr>
    <td height="60" colspan="5" align="center" bgcolor="#dddddd" class="tdborder"><table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td width="21%" height="60" align="center" valign="middle" bgcolor="#FFFFFF" class="tdborder celltext"><img src="new-images/pnbhfl-logo.jpg" width="105" height="20"  /><br /> 
              <? echo "PNB Housing Finance"; ?></td>
        <td width="20%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo $pnbinter; ?> %</td>
        <td width="22%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo "".$pnbemi; ?></td>
        <td width="23%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php list($Last_num)=money_F($pnbloanamt);  echo "<b>".$Last_num."</b>"; ?></td>
        <td width="14%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo abs($pnbterm); ?> yrs.</td>
      </tr>
    </table></td>
    </tr>
    	<? }
				
		list($idbiactualemi,$idbiemi,$idbiinter,$idbiprint_term,$idbiloan_amount,$idbiviewLoanAmt,$idbiperlacemi,$idbiperlacemifortwo,$idbiterm,$idbisemi)=IDBI_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		if($idbiloan_amount>0)
		{
		$eligibileLoanAmtArr[] = $idbiviewLoanAmt;
			?> 
    
  <tr>
    <td height="60" colspan="5" align="center" bgcolor="#dddddd" class="tdborder"><table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td width="21%" height="60" align="center" valign="middle" bgcolor="#FFFFFF" class="tdborder celltext"> <? echo "IDBI Bank"; ?></td>
        <td width="20%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo $idbiinter; ?> %</td>
        <td width="22%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php echo $idbiemi; ?></td>
        <td width="23%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php list($Last_num)=money_F($idbiviewLoanAmt);  echo "<b>".$Last_num."</b>"; ?></td>
        <td width="14%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo abs($idbiprint_term); ?> yrs.</td>    
      </tr>
    </table></td>
    </tr>
     <?
		}
		 list($federalemi,$federalinter,$federalterm,$federalloanamt) = federal_Homeloannew($getnetAmount,$age,$obligation,$property_value,$loan_amount);
			if($federalloanamt>0)
			{
				$eligibileLoanAmtArr[] = $federalloanamt;
				?>
  <tr>
    <td height="60" colspan="5" align="center" bgcolor="#dddddd" class="tdborder"><table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td width="21%" height="60" align="center" valign="middle" bgcolor="#FFFFFF" class="tdborder celltext">	<img src="http://www.deal4loans.com/new-images/federal_bnksmll.jpg" width="86" height="20" /><br><span style="color:#004c9a;">A FEDERAL BANK SUBSIDIARY</span><br /> 
		<? //echo "Fedbank"; ?></td>
        <td width="20%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo $federalinter; ?> %</td>
        <td width="22%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php echo $federalemi; ?></td>
        <td width="23%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php list($Last_num)=money_F($federalloanamt);  echo "<b>".$Last_num."</b>"; ?></td>
        <td width="14%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo $federalterm; ?> yrs.</td>
       </tr>
    </table></td>
    </tr>
    	<?	}
		list($licemi,$licinter,$licprint_term,$licloan_amount,$licviewLoanAmt,$licperlacemi,$licterm)=lic_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		if($licviewLoanAmt>0)
		{
		$eligibileLoanAmtArr[] = $licviewLoanAmt;
	?>
  <tr>
    <td height="60" colspan="5" align="center" bgcolor="#dddddd" class="tdborder"><table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td width="21%" height="60" align="center" valign="middle" bgcolor="#FFFFFF" class="tdborder celltext"> <? echo "LIC Housing"; ?></td>
        <td width="20%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo $licinter; ?> %</td>
        <td width="22%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php echo $licemi; ?></td>
        <td width="23%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php list($Last_num)=money_F($licviewLoanAmt);  echo "<b>".$Last_num."</b>"; ?></td>
        <td width="14%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo $licprint_term; ?> yrs.</td>
      </tr>
    </table></td>
    </tr>
                      <?
}
	
list($iciciactualemi,$iciciemi,$iciciinter,$iciciprint_term,$iciciloan_amount,$iciciviewLoanAmt,$iciciperlacemi,$perlacemifortwo,$iciciterm,$icicisemi)=ICICI_Homeloan($netAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value); 
if($iciciviewLoanAmt>0)
		{
		$eligibileLoanAmtArr[] = $iciciviewLoanAmt;
?>
  <tr>
    <td height="60" colspan="5" align="center" bgcolor="#dddddd" class="tdborder"><table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td width="21%" height="60" align="center" valign="middle" bgcolor="#FFFFFF" class="tdborder celltext"><img src="http://www.deal4loans.com/new-images/thnk-icici-h.gif" width="86" height="20" /><br /> 
              <? echo "ICICI Bank"; ?></td>
        <td width="20%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><? echo $iciciinter; ?> %</td>
        <td width="22%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?  echo $iciciactualemi; ?></td>
        <td width="23%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php list($Last_num)=money_F($iciciviewLoanAmt); echo "<b>".$Last_num."<b>"; ?></td>
        <td width="14%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo $iciciprint_term; ?> yrs.</td>
      </tr>
    </table></td>
    </tr>
    <?
	}
		list($hdfcactualemi,$hdfcemi,$hdfcinter,$hdfcprint_term,$hdfcloan_amount,$hdfcviewLoanAmt,$hdfcperlacemi,$hdfcperlacemifortwo,$hdfcterm,$hdfcsemi)=HDFC_Homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
	if($hdfcviewLoanAmt>0)
		{
		$eligibileLoanAmtArr[] = $hdfcviewLoanAmt;
	?>
  <tr>
    <td height="60" colspan="5" align="center" bgcolor="#dddddd" class="tdborder"><table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td width="21%" height="60" align="center" valign="middle" bgcolor="#FFFFFF" class="tdborder celltext"><img src="http://www.deal4loans.com/new-images/thnk-hdfc-l.jpg" width="86" height="20" /><br /> 
              <? //echo "HDFC Bank"; ?></td>
        <td width="20%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo $hdfcinter; ?>%</td>
        <td width="22%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php echo $hdfcemi; ?></td>
        <td width="23%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php list($Last_num)=money_F($hdfcviewLoanAmt);  echo "<b>".$Last_num."</b>"; ?></td>
        <td width="14%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo abs($hdfcprint_term); ?> yrs.</td>   
      </tr>
    </table></td>
    </tr>
    <?php } ?>
       <? 
		 
		 list($sbiemi,$sbiinter,$sbiprint_term,$sbiloan_amount,$sbiviewLoanAmt,$sbiperlacemi,$sbiterm)=@sbi_homeloan($getnetAmount,$loan_amount,$age,$total_obligation,$strCity,$property_value);
		if($sbiloan_amount>0)
		{
			//echo "hello";
			$eligibileLoanAmtArr[] = $sbiviewLoanAmt;
		?>
      <tr>
    <td height="60" colspan="5" align="center" bgcolor="#dddddd" class="tdborder"><table width="100%" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td width="21%" height="60" align="center" valign="middle" bgcolor="#FFFFFF" class="tdborder celltext">State Bank Of India</td>
        <td width="20%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo $sbiinter; ?>%</td>
        <td width="22%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php echo $sbiemi; ?></td>
        <td width="23%" height="60" align="center" bgcolor="#FFFFFF" class="celltext">Rs. <?php list($Last_num)=money_F($sbiviewLoanAmt);  echo "<b>".$Last_num."</b>"; ?></td>
        <td width="14%" height="60" align="center" bgcolor="#FFFFFF" class="celltext"><?php echo abs($sbiprint_term); ?> yrs.</td>   
        
     
      </tr>
    </table></td>
    </tr>
        <?php } ?>
</table>
<div style="clear:both;"></div>
<?php 
$MAXvAL = max($eligibileLoanAmtArr);
$totalEligibleAmt = round($MAXvAL + ($MAXvAL * 15/100));

$getPageSql = "select * from property_details_hl where City ='".$City."' and Price<= ".$totalEligibleAmt." and Title!='' and Status =1  order by Dated desc  limit 0,5";
list($num,$getPageQuery)=MainselectfuncNew($getPageSql,$array = array());

$pid_arr = '';
for($i=0;$i<$num;$i++)
{
	$pid_arr[] = ucwords($getPageQuery[$i]['PID']);
}
$arrFirst = '';
$arrSecond = '';
for($cou=0;$cou<count($pid_arr);$cou++)
{
	if($cou>2)
	{
		$arrSecond[] = $pid_arr[$cou];
	}
	else
	{
		$arrFirst[] = $pid_arr[$cou];
	}
}

$strFirst = implode(',' , $arrFirst);
$strSecond = implode(',' , $arrSecond);
?>

<div>
<?php
$getPageSql = "select * from property_details_hl where PID in (".$strSecond.")  order by Dated desc";
list($num,$getPageQuery)=MainselectfuncNew($getPageSql,$array = array());
for($i=0;$i<$num;$i++)
{
$PID = ucwords($getPageQuery[$i]['PID']);
$State = ucwords($getPageQuery[$i]['State']);
$City = ucfirst($getPageQuery[$i]['City']);
$Price = $getPageQuery[$i]['Price'];
$TitleContent = $getPageQuery[$i]['Title'];
$Rate = $getPageQuery[$i]['Rate'];
$CoveredArea = $getPageQuery[$i]['CoveredArea'];
$Facilities = $getPageQuery[$i]['Facilities'];
$Description = $getPageQuery[$i]['Description'];
$ApprovedBy = $getPageQuery[$i]['ApprovedBy'];
$BuilderName = $getPageQuery[$i]['BuilderName'];
$Status = $getPageQuery[$i]['Status'];
$AgentName = $getPageQuery[$i]['AgentName'];
$AgentEmail = $getPageQuery[$i]['AgentEmail'];
$AgentMobile = $getPageQuery[$i]['AgentMobile'];
$AgentPwd = $getPageQuery[$i]['AgentPwd'];

?>
<?php if(strlen($TitleContent)>1) { ?>
<div class="right_continuedinnsecond">
<div class="right_continuedinnhead"><?php echo $TitleContent; echo $PID; ?></div>
<div class="right_continuedinnbelow">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  
    <tr>
      <td width="5%" height="25" valign="middle" class="righttexbx"><strong><img src="new-images/ruppesmbl.png" width="9" height="13"></strong></td>
      <td width="95%" valign="middle" class="righttexbx"><strong><?php echo getNumberFormat($Price); ?></strong></td>
    </tr>
    <tr>
      <td colspan="2">  <?php if(strlen($Rate)>1) { ?>      <strong>Price per Sq-ft.:</strong> <img src="/new-images/rupees.gif" border="0" width="8" height="10" /><?php echo $Rate; ?> <br> <?php } ?>
       <?php if(strlen($CoveredArea)>1) { ?> <strong>Covered Area -</strong> <?php echo $CoveredArea; ?> Sq-ft.<br><?php } ?>
       <?php if(strlen($BuilderName)>1) { ?> <strong>Builder -</strong> <?php echo $BuilderName; ?> <br><?php } ?>
       <?php  $ApprovedBy='HDFC'; if(strlen($ApprovedBy)>1) { ?> <strong>Approved By</strong> - <?php echo $ApprovedBy; ?><?php } ?>
        
        </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">
     <form action="get-property-submit.php" method="POST" target="_blank" >
       	 <input type="hidden" name="Reply_Type" value="2" id="Reply_Type">
		 <input type="hidden" name="RequestID" value="<? echo $leadid; ?>" id="RequestID">
		 <input type="hidden" name="max_loan_amount" value="<?php echo $citigetloanamout ; ?>" />
	     <input type="hidden" name="calc_emi" value="<?php echo $citigetemicalc ; ?>" />
         <input type="submit" name="button" id="button" value="Contact Agent" class="buttonmag" onClick="alert( 'Please Fill the Form to get Agents Details!' )">
       </form>
  </td>
    </tr>
  </table>
</div>
<div><img src="new-images/shadow12121new.jpg" width="100%" height="16"></div>
</div>

<?php
} 
}
?>
</div>
</div>
<div class="right_continued">
<?php
$getPageSql = "select * from property_details_hl where PID in (".$strFirst.")  order by Dated desc";
list($num,$getPageQuery)=MainselectfuncNew($getPageSql,$array = array());
for($i=0;$i<$num;$i++)
{
$PID = ucwords($getPageQuery[$i]['PID']);
$State = ucwords($getPageQuery[$i]['State']);
$City = ucfirst($getPageQuery[$i]['City']);
$Price = $getPageQuery[$i]['Price'];
$TitleContent = $getPageQuery[$i]['Title'];
$Rate = $getPageQuery[$i]['Rate'];
$CoveredArea = $getPageQuery[$i]['CoveredArea'];
$Facilities = $getPageQuery[$i]['Facilities'];
$Description = $getPageQuery[$i]['Description'];
$ApprovedBy = $getPageQuery[$i]['ApprovedBy'];
$BuilderName = $getPageQuery[$i]['BuilderName'];
$Status = $getPageQuery[$i]['Status'];
$AgentID = $getPageQuery[$i]['AgentID'];
$AgentName = $getPageQuery[$i]['AgentName'];
$AgentEmail = $getPageQuery[$i]['AgentEmail'];
$AgentMobile = $getPageQuery[$i]['AgentMobile'];
$AgentPwd = $getPageQuery[$i]['AgentPwd'];

?>
<?php if(strlen($TitleContent)>1) { ?>



<div class="right_continuedinn">
<div class="right_continuedinnhead"><?php echo $TitleContent; echo $PID; ?></div>
<div class="right_continuedinnbelow">
   <table width="100%" border="0" cellspacing="0" cellpadding="0">
  
    <tr>
      <td width="5%" height="25" valign="middle" class="righttexbx"><strong><img src="new-images/ruppesmbl.png" width="9" height="13"></strong></td>
      <td width="95%" valign="middle" class="righttexbx"><strong><?php echo getNumberFormat($Price); ?></strong></td>
    </tr>
    <tr>
      <td colspan="2">  <?php if(strlen($Rate)>1) { ?>      <strong>Price per Sq-ft.:</strong> <img src="/new-images/rupees.gif" border="0" width="8" height="10" /><?php echo $Rate; ?> <br> <?php } ?>
       <?php if(strlen($CoveredArea)>1) { ?> <strong>Covered Area -</strong> <?php echo $CoveredArea; ?> Sq-ft.<br><?php } ?>
       <?php if(strlen($BuilderName)>1) { ?> <strong>Builder -</strong> <?php echo $BuilderName; ?> <br><?php } ?>
       <?php  $ApprovedBy='HDFC'; if(strlen($ApprovedBy)>1) { ?> <strong>Approved By</strong> - <?php echo $ApprovedBy; ?><?php } ?>
        
        </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">
       <input type="submit" name="button" id="button" value="Contact Agent" class="buttonmag" onClick="alert( 'Please Fill the Form to get Agents Details!' )">
  </td>
    </tr>
  </table>

</div>
<div><img src="new-images/shadow12121new.jpg" width="100%" height="16"></div>
</div>
<div style="clear:both;"></div>
<?php
} 
}
?>

</div>
</div>
</div>

<div style="clear:both; height:15px;"></div>
<?php include "footer1.php"; ?>
</body>
</html>