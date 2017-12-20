<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//require 'getlistofeligiblebidders.php';
	error_reporting();
	$page_Name = "LandingPage_PL";
		function generateNumberNEWc($plength) {
	    if (!is_numeric($plength) || $plength <= 0) {
	        $plength = 8;
	    }
	    if ($plength > 32) {
	        $plength = 32;
	    }
	
	    $chars = '123456789ABCDEFGHJKLMNPQRSTUVWXYZ';
	    mt_srand(microtime() * 1000000);
	    for ($i = 0; $i < $plength; $i++) {
	        $key = mt_rand(0, strlen($chars) - 1);
	        $pwd = $pwd . $chars{$key};
	    }
	    for ($i = 0; $i < $plength; $i++) {
	        $key1 = mt_rand(0, strlen($pwd) - 1);
	        $key2 = mt_rand(0, strlen($pwd) - 1);
	
	        $tmp = $pwd{$key1};
	        $pwd{$key1} = $pwd{$key2};
	        $pwd{$key2} = $tmp;
	    }
	
	    return $pwd;
	}
function DetermineAgeFromDOB ($YYYYMMDD_In)
	{
	  $yIn=substr($YYYYMMDD_In, 0, 4);
	  $mIn=substr($YYYYMMDD_In, 4, 2);
	  $dIn=substr($YYYYMMDD_In, 6, 2);
	  $ddiff = date("d") - $dIn;
	  $mdiff = date("m") - $mIn;
	  $ydiff = date("Y") - $yIn;
	  if ($mdiff < 0)
	  {
		$ydiff--;
	  } elseif ($mdiff==0)
	  {
		if ($ddiff < 0)
		{
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


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
	$$a=$b;
	
	$UserID = $_SESSION['UserID'];
	$Full_Name = FixString($Full_Name);
	//$LName = FixString($LName);
	$Name= $Full_Name;
	$Email = FixString($Email);
	$Phone = FixString($Phone);
	$Pancard = FixString($Pancard);
	$CC_Holder = FixString($CC_Holder);
	$Card_Vintage = FixString($Card_Vintage);
	$City = FixString($City);
	$City_Other = FixString($City_Other);
	$Company_Name = FixString($Company_Name);
	$Net_Salary =FixString($Net_Salary);
	$Credit_Limit =FixString($Credit_Limit);	
	$IsPublic =1;
	$Day=FixString($day);
	$Month=FixString($month);
	$Year=FixString($year);
	$Age = FixString($Age);
	if(strlen($Age)>0)
		{
			$date=date('m-d');
			$year = date('Y')-$Age;
			$DOB = $year."-".$date;
		}
		else
		{
			$DOB=$Year."-".$Month."-".$Day;
		}

	$Type_Loan = "CreditCard";
	$source = FixString($source);
	$card_category = FixString($card_category);
	$Reference_Code = generateNumberNEWc(5);
	$Employment_Status = FixString($Employment_Status);
	$Accidental_Insurance = FixString($Accidental_Insurance);
	$cpp_card_protect = FixString($cpp_card_protect);
	$Ibibo_compaign = FixString($Ibibo_compaign);
	$hdfclife = FixString($hdfclife);
	$Referrer = FixString($referrer);
	$source = FixString($source);
	$Section = FixString($section);
	$Creative = FixString($creative);
	$Pincode = FixString($Pincode);
	$Loan_Any = $_REQUEST["Loan_Any"];
	$nn = count($Loan_Any);
	$ii  = 0;
	
	while ($ii < $nn)
	{
	  $Loan_A .= "$Loan_Any[$ii], ";
	  $ii++;
	}
	
	$Salary_Account = FixString($salary_account);
	$n = count($Salary_Account);
	$i = 0;
	while ($i < $n)
	{
		$Salary_Arr .= "$Salary_Account[$i], ";
		$i++;
	}

	if(count($Salary_Account)>0)
	{
		$Salary_A = $Salary_Arr;
	}
	else
	{
		$Salary_A = FixString($salary_account);
	}
	$loanbank_name = $_REQUEST["loanbank_name"];	// 	Applied_With_Banks
	$u = count($loanbank_name);
	 $p  = 0;
	while ($p < $u)
	{
	  $loanbank_n .= "$loanbank_name[$p], ";
	 $p++;
	 }

	$No_of_Banks = FixString($No_of_Banks);
	$ABMMU_flag = FixString($adty_brl);
	
	$accept = FixString($accept);

	$getDOB = $Year."".$Month."".$Day;
	$Age = DetermineAgeFromDOB($getDOB);
	
	
	$gethdfccccompany='select company_category from HDFC_CC_Company_List where hdfc_company_name="'.$Company_Name.'"';
// echo $getcompany;
	list($recordcounthdfccc,$myrow)=MainselectfuncNew($gethdfccccompany,$array = array());
	$myrowcontr=count($myrow)-1;

if($recordcounthdfccc>0)
	{
$hdfc_cccategory = $myrow[$myrowcontr]["company_category"];
	}

if($hdfc_cccategory=="Cat AB" || $hdfc_cccategory=="PREFERRED" )
	{
		$Company_HDFC_Cat=1;
	}
	else if($hdfc_cccategory=="ELITE" || $hdfc_cccategory=="SUPERPRIME")
	{
		$Company_ICICI_Cat=1;
		$Company_HDFC_Cat=1;
	}
	else
	{
		$Company_ICICI_Cat=0;
		$Company_HDFC_Cat=0;
	}
	
	
	//$IP = getenv("REMOTE_ADDR");
	//$IP= $_SERVER['HTTP_X_REAL_IP'];
        $IP=ExactCustomerIP();

	
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
		function Insert_iciciprulead($ProductValue, $Name, $City, $Phone, $Email)
	{
		$Dated = ExactServerdate();
		$datInsert = array('product_type'=>'1', 'requestid'=>$ProductValue, 'clientld_name'=>$Name, 'clientld_email'=>$Email, 'clientld_mobile'=>$Phone, 'clientld_city'=>$City, 'client_name'=>'iciciprulife', 'clientld_date'=>$Dated, 'client_splcondition'=>'');
		$table = 'client_campaign_leads';
		$insert = Maininsertfunc ($table, $datInsert);
		//echo "Edelweiss:".$Sql."<br>";
		//exit();
	}
	
	
	
	$crap = " ".$Name." ".$Email." ".$Company_Name;
	$crapValue = validateValues($crap);
	$_SESSION['crapValue'] = $crapValue;
	if($crapValue=='Put')
	{
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
		
		if(($validMobile==1) && ($Name!=""))
		{		
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Credit_Card Where (Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9971396361','9811215138','9999047207','9873678914','9999570210','9555060388') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($checkDupNum,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;

			if($checkDupNum>0)
			{
				$ProductValue = $myrow[$myrowcontr]['RequestID'];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-credit-card-lead.php'"."</script>";
			}
			else
			{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section ,'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Cpp_Compaign'=>$cpp_card_protect, 'Pincode'=>$Pincode, 'No_of_Banks'=>$No_of_Banks, 'Company_HDFC_Cat'=>$Company_HDFC_Cat, 'ABMMU_flag'=>$ABMMU_flag, 'Company_ICICI_Cat'=>$Company_ICICI_Cat, 'Salary_Account'=>$Salary_A, 'Privacy'=>$accept,  'Credit_Limit'=>$Credit_Limit, 'Loan_Any'=>$Loan_A, 'Applied_With_Banks'=>$loanbank_n);
			}
			else
			{
					$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
					$UserID = Maininsertfunc ('wUsers', $wUsersdata);	
				
					$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Cpp_Compaign'=>$cpp_card_protect, 'Pincode'=>$Pincode, 'No_of_Banks'=>$No_of_Banks, 'Company_HDFC_Cat'=>$Company_HDFC_Cat, 'ABMMU_flag'=>$ABMMU_flag, 'Company_ICICI_Cat'=>$Company_ICICI_Cat, 'Salary_Account'=>$Salary_A, 'Privacy'=>$accept,  'Credit_Limit'=>$Credit_Limit, 'Loan_Any'=>$Loan_A, 'Applied_With_Banks'=>$loanbank_n);					
			}
				$ProductValue = Maininsertfunc ("Req_Credit_Card", $dataInsert);
				
			 //Send SMS
			ProductSendSMStoRegis($Phone);
						
			if($City=="Others")
			{
				$strcity=$City_Other;
			}
			else
			{
				$strcity=$City;
			}
			
			if($hdfclife==1)
			{
			$Product=1;
			//Insert_HdfcLife($Name, $strcity, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
			Insert_iciciprulead($ProductValue, $Name, $City, $Phone, $Email);
			}

			$_SESSION['Temp_LID'] = $ProductValue;
			//echo $Net_Salary; 
			if($Net_Salary<100)
			{
				header ("Location: apply-credit-card-salary-correction.php");
				exit();
			}
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailtocommonproduct.php";
			
			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Bcc: newtestthankuse@gmail.com"."\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
			$SubjectLine = $Name.", Learn to get Best Deal on Credit Card";
			else
			$SubjectLine = "Learn to get Best Deal on Credit Card";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
		
			//SBI Cards Mailer
			/*
			if(($City=="Mumbai" || $City=="Chennai" || $City=="Bangalore" || $City=="Pune" || $City=="Ahmadabad" || $City=="Hyderabad" || $City=="Jaipur" || $City=="Surat" || $City=="Kolkata" || $City=="Coimbatore" || $City=="Delhi" || $City=="Noida" || $City=="Gurgaon" || $City=="Gaziabad" || $City=="Greater Noida")  && $Net_Salary>=200000)
			{
				include "emailer/sbi_card_GoldnMore.php";
				$headerss  = 'From: SBI Card <no-reply@deal4loans.com>' . "\r\n";
				$headerss .= "Bcc: testthankuse@gmail.com"."\n";
				$headerss .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
				$headerss .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				 
				$SubjectLinecc = "0% fuel surcharge only with SBI Gold & More Credit Card";
				
				if(isset($Email))
				{
					mail($Email, $SubjectLinecc, $sbiccMessage, $headerss);
				}
	
			}
			*/		
				$ProductValueencode = urlencode($ProductValue);
				$SMSMessage = "Please use this code: " . $Reference_Code . "  to activate you loan request at deal4loans.com";
				SendSMSforLMS($SMSMessage,$Phone);
				//header("Location: credit-card-thank.php?id=".$ProductValueencode);
				header("Location: credit-card-continue.php?rqid=".$ProductValue."&category_tag=".$card_category);
				exit();				
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
//exit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<META HTTP-EQUIV="Refresh" CONTENT="8;URL=credit-card-thank.php">-->
<title>Credit Card Processing</title>

</head>
<body style="margin:0px; padding:0px;">

 <? if((strlen(strpos($_SERVER['HTTP_REFERER'], "sbi-credit-cards-apply.php")) > 0))
	 {?>
	 
<!-- Google Code for SBi Credit Card Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "SPFnCIXr0wEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=SPFnCIXr0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


	 <?  }
 elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "credit-cards-apply.php")) > 0))
	 {?>

 <script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "p-B1CLH8iAEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=p-B1CLH8iAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<? } ?>
<? if($source=="apply-for-cc-new")
{ ?>
<!-- Google Code for Deal4loans Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "jeuMCI2c2QEQh8-3_AM";
var google_conversion_value = 0;
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1066264455/?value=0&amp;label=jeuMCI2c2QEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<? } ?>	 
</body>
</html>




