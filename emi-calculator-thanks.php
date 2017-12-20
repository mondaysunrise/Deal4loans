<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();

if($_POST['monthly_income_sal']!=""){
	
	$monthlyIncome = $_POST['monthly_income_sal'];
	$monthlyObligation = $_POST['obligation_sal'];
	$loanEligibility = (($monthlyIncome - $monthlyObligation) / 2) * 100;
}

if($_POST['itr_paid_SE']!=""){
	
	$monthlyIncome = round($_POST['itr_paid_SE'] / 12);
	$monthlyObligation = $_POST['obligation_SE'];
	$loanEligibility = (($monthlyIncome - $monthlyObligation) / 2) * 100;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	/*
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
	*/
	$showBankQry = "Select rateid, bank_name From personal_loan_interest_rate_chart where rateid='".$_POST['bank_name_emi']."'";
	list($alreadyExist,$showBank)=MainselectfuncNew($CheckSql,$array = array());
	$showBankcontr=count($showBank)-1;
	extract($_POST);
	$loanAmountEmi = FixString($Loan_Amount_Emi);
	$bankNameEmi = FixString($showBank[$showBankcontr]['bank_name']);
	$knowInterestRate = FixString($know_interest_rate);
	$empStatus = FixString($emp_status);
	//echo "Bank Name: ".$bankNameEmi;
	
	if($emp_status=='Salaried'){
		
		$dob_month = FixString($dob_month_sal);
		$dob_year = FixString($dob_year_sal);
		$company_name = FixString($company_name_sal);
		$monthly_income = FixString($monthly_income_sal);
		$annual_income = ($monthly_income * 12);
		$obligation = FixString($obligation_sal);
	}
	if($emp_status=='Self-Employed'){
		
		$dob_month = FixString($dob_month_SE);
		$dob_year = FixString($dob_year_SE);
		$itr_paid_SE = FixString($itr_paid_SE);
		$annual_income = $itr_paid_SE;
		$obligation = FixString($obligation_SE);
	}
	$day = date('d');
	$DOB = $dob_year."-".$dob_month."-".$day;
	$interestRate = $rate;
	$loanTenure = FixString($months);
	
	$monthlyEmi = $pay;
	$totalAmountWithInterest = $tot_amount;
	$totalInterestAmount = $tot_interest;
	$yearlyInterestAmount = $yearly_interest;
	
	$Name = FixString($full_name_emi);
	$Phone = FixString($mobile_emi);
	$Email = FixString($email_emi);
	$City = FixString($city_emi);
	
	$source = $source;
	$IP = getenv("REMOTE_ADDR");
	$IP = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];

	$Type_Loan="Req_Loan_Personal";
	
	if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1)
	{
		$validname=0;
	}
	else
	{
		$validname=1;
	}

	$crap = " ".$Name." ".$Email;
	$crapValue = validateValues($crap);
	$_SESSION['crapValue'] = $crapValue;
	$validMobile = is_numeric($Phone);
	$validYear  = is_numeric($Year);
	$validMonth = is_numeric($Month);
	$validDay = is_numeric($Day);
	
	if(($validMobile==1) && ($Name!="") && strlen($City)>0 && $validname==1)
	{
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";
		
		$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9891118553,9999570210,9810395952) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."' and source not in('PL-EMI-Ccalc-Jan2015','PL main page')) order by RequestID DESC ";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
			$_SESSION['Temp_LID'] = $ProductValue;
			echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";
		}
		else
		{
			$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$emp_status, 'Company_Name'=>$company_name, 'City'=>$City, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$annual_income, 'Loan_Amount'=>$loanAmountEmi, 'DOB'=>$DOB, 'Dated'=>$Dated,'source'=>$source, 'IP_Address'=>$IP);
			$insertEmiQry = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
		}
		/********** Sending email to the Customer ***********/
		$emailTo = $Email;
		$emailSubject = "Calculate EMI of your Personal Loan";
		$emailMessage2 = "
<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='560' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Dear $Name</b>,<br />

              Thanks for visiting Deal4loans.com to calculate your Personal Loan EMI. We are committed to provide you with a platform to compare and choose the best deal for your loan requirement. <br />
              <br />
			  </td>
          </tr>
          <tr>
              <td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; width:300px;'>
                Your <b>Profile Summary</b> as per our records:<br />
                Your Name: $Name<br />
                Location: $City<br />
                Income/Salary: $annual_income<br />
                Email Id: $Email<br />
                Contact :$Phone
                <br /><br />
                
                <strong>Your EMI Calculation:</strong><br />
                Loan Amount: $loanAmountEmi<br />
                Preferred Bank: $bankNameEmi<br />
                <br />
                
                Calculated Monthly EMI: Rs.$monthlyEmi<br />
                Total Amount With Interest: Rs.$totalAmountWithInterest<br />
                Total Interest Amount: Rs.$totalInterestAmount<br />
                Yearly Interest Amount: Rs.$yearlyInterestAmount<br />
                <br />

</td>
</tr>
<tr>  <td width='307' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>

<a href='http://www.deal4loans.com/chat/checklist.pdf' style='color:#0a4988; text-decoration:underline;'><b><br />
Print the checklist documents</b> </a>
<br /><br />
<b>Articles On Business Loans:</b>
<ul>
	<li><a href='http://www.deal4loans.com/personal-loan-interest-rate.php?source=plAM' style='color:#0a4988; text-decoration:underline;'>Business Loan Interest Rates</a></li> 
	
	<li><a href='http://www.deal4loans.com/personal-loan-banks.php?source=plAM' style='color:#0a4988; text-decoration:underline;'>Compare Business Loan Banks</a></li>	
	<li><a href='http://www.deal4loans.in/content/how-to-increase-cibil-score' style='color:#0a4988; text-decoration:underline;'>How to increases your Cibil score</a></li>
</ul>


<b>Banker’s Preferences for an applicant:</b>
<ul>
<li><a href='http://www.deal4loans.in/content/banks-now-refer-cibil-report-sanctioning-a-loan' style='color:#0a4988; text-decoration:underline;'>Cibil Check before sanctioning a Loan</a></li></ul>
</td><td width='243' align='right' valign='top'>
<a href='http://www.bimadeals.com/health-insurance.php?source=plAM' target='_blank'><img src='http://www.bimadeals.com/new-images/healthins250X250.gif' border='0' width='240'></a></td>
</tr>
<tr><td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '>
<b>Other Services from Deal4loans</b>
<ul ><li  ><b>Home Loan:</b> <a href='http://www.deal4loans.com/home-loan-banks.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Check the Banks</a> | <a href='http://www.deal4loans.com/apply-home-loans.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Home Loan</a> | <a href='http://www.deal4loans.com/home-loans-interest-rates.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Current Rate of Interest</a>  | <br /> 
    <a href='http://www.deal4loans.com/Contents_Home_Loan_Mustread.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Home Loan</a> </li> 
	<li  ><b>Life Insurance:</b> <a href='http://www.bimadeals.in/content/life-insurance-policies' target='_blank' style='color:#0a4988; text-decoration:underline;'>Types of life insurance policies</a> | <a href='http://www.bimadeals.com/life-insurance-india/Contents_Life_Insurance_Mustread.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Life Insurance</a>  | <a href='http://www.bimadeals.com/life-insurance-india/Req_Life_Insurance_New.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Life Insurance</a></li> 
	<li><b>Credit Card :</b><a href='http://www.deal4loans.com/credit-card-archives.php' target='_blank' style='color:#0a4988; text-decoration:underline;'> Check the latest offers on your credit card</a> | <a href='http://www.deal4loans.com/Contents_Credit_Card_Mustread.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Read more about Credit card</a> | <a href='http://www.deal4loans.in/content/what-are-different-kind-fees-credit-cards' target='_blank' style='color:#0a4988; text-decoration:underline;'>Different fees on Credit card</a> | <a href='http://www.deal4loans.com/apply-credit-card.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Credit Card</a> | <a href='http://www.deal4loans.com/emailer/cc-mailer09.php' target='_blank' style='color:#0a4988; text-decoration:underline;'>Register yourself for credit card offers.</a></li>
	
	<li  ><b>Health Insurance:</b> <a href='http://www.bimadeals.com/health-insurance-india/Contents_Health_Insurance_Mustread.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>How much Health Insurance you need</a>  | <a href='http://www.bimadeals.com/health-insurance-india/health-insurance-comparison-chart.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Compare Family Health Insurance Plan</a>  | <a href='http://www.bimadeals.com/health-insurance-india/Req_Health_Insurance_New.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Health Insurance</a></li> 
	</ul>
<b>Regards</b> <br />
Team Deal4loans.com<br />
Loans by choice not by chance!!<br />
<div style='text-align:center;'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Blogs</a> | <a href='http://www.deal4loans.com/Contents_Feedback.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Testimonials</a> | <a href='http://www.deal4loans.com/Loan_Query.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>LoanQueries</a></div></td><td width='1'></td>
          </tr>
		  <tr><td colspan='2' height='110' valign='middle'><a href='http://www.deal4loans.com/earn-credit-card.php?source=plAM' target='_blank'><img src='http://www.deal4loans.com/images/crdt-bann-mlr.gif' width='550' height='101' border='0'/></a></td>
		  </tr>
        </table></td>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
      </tr>
    </table></td>
  </tr>
  <tr><td><img src='http://www.deal4loans.com/images/tp_bl-line.gif' width='560' height='20' /></td>
  </tr>
</table>";
		
		$headers = "From: deal4loans <no-reply@deal4loans.com>";
		$semi_rand = md5( time() ); 
		$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
		$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: testthankuse@gmail.com"."\n";
		$emailMessage = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $emailMessage2 . "\n\n";
		
		if(mail($emailTo,$emailSubject,$emailMessage,$headers)){
		
			echo "<script>document.location.href='http://www.deal4loans.com/emi-calculator-thanks.php?full_name_emi=".$full_name_emi."&loan_eligibility=".$loanEligibility."';</script>";
		}else{
			echo "<script>document.location.href='http://www.deal4loans.com/emi-calculator-thanks.php?full_name_emi=".$full_name_emi."&loan_eligibility=".$loanEligibility."';</script>";
		}
		/****************************************************/
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Personal Loan | Online Personal loans India 2015</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="assets/stylesheets/bootstrap.min.css" rel="stylesheet" />
<link type="text/css" rel="stylesheet" href="release/featherlight.min.css" title="Featherlight Styles" />
<link type="text/css" href="css/d4lmenu.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<meta name="keywords" content="Personal Loan, Personal Loans, Personal Loan India, online personal loans, Personal Loans India"/>
<meta name="description" content="Find Personal loan online: Get Latest Trends, Basic information, Benefits, Documents, Eligibility Criteria by Various Banks and Cibil Score Importance at deal4loans."/>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link type="text/css" rel="stylesheet" href="css/easy-responsive-tabs.css" />
<link href="source.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>

<link href="source1.css" rel="stylesheet" type="text/css" />
<link href="css/personal-loans-new-styles.css" type="text/css" rel="stylesheet" />
<script src="js/light-box-jquery-newui.js"></script>
<script type="text/javascript" src="modernizr.custom-90229.js"></script>
</head>
<body>
<header>
	<div class="hide_top_menu"><?php include "top-menu.php"; ?></div>
</header>
<!--top-->
<!--logo navigation-->
<nav><?php include "main-menu-new.php"; ?></nav>
<!--logo navigation--><!--partners-->
<div style="clear:both; height:25px;"></div>

<div class="pl_newuiwrapper">
  <div class="pl_newuiwrapper-inner">
    <div class="new_ui_text2">
    
    Dear <?php echo $_REQUEST['full_name_emi']; ?>,<br><br>
    
    Thank you for visiting www.deal4loans.com.<br><br>
    
    According to your profile you are eligible for the loan amount of Rs.<?php echo $_REQUEST['loan_eligibility']; ?> (Indicative Amount)<br><br>
    
    </div>
  </div>    
</div>

<div style="clear:both; height:10px;"></div>
<?php include "footer.php"; ?>
</body>
</html>