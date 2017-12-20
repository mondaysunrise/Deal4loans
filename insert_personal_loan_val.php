<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

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

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		$UserID = $_SESSION['UserID'];
		$finalurl=$_POST["PostURL"];
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Loan_Amount= FixString($Loan_Amount);
		$Pincode = FixString($Pincode);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Employment_Status = FixString($Employment_Status);
		$Card_Vintage = FixString($Card_Vintage);
		$Email = FixString($Email);
		$Type_Loan = FixString($Type_Loan);
		$Company_Name = FixString($Company_Name);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$City = FixString($City);
		$From_Product = $_REQUEST['From_Product'];
		$City_Other = FixString($City_Other);
		$Net_Salary = $_REQUEST['IncomeAmount'];
		$CC_Holder = FixString($CC_Holder);
		$Card_Vintage = FixString($Card_Vintage);
		$_SESSION['Temp_CC_Holder'] = $CC_Holder;
		$edelweiss = FixString($edelweiss);
		$cpp_card_protect = FixString($cpp_card_protect);
		$Ibibo_compaign = FixString($Ibibo_compaign);
		$Annual_Turnover = FixString($Annual_Turnover);
		$Dated = ExactServerdate();
		if($Net_Salary<=239000)
		{
		if((strlen(strpos($finalurl, "apply-personal-loans-new.php")) > 0) || (strlen(strpos($finalurl, "apply-personal-loan-quote.php")) > 0))
		{
				$Reference_Code = "";
			$Direct_Allocation =0;
			$IsProcessed=0;
		}
		else
			{
		$Reference_Code = generateNumber(4);
		$Direct_Allocation =1;
		$IsProcessed=1;
			}
		}
		
		else
		{
			$Reference_Code = "";
			$Direct_Allocation =0;
			$IsProcessed=0;
		}

		$IsPublic = 1;
		$n       = count($From_Product);
		   $i      = 0;
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$Section=$_REQUEST['section'];
		$Creative=$_REQUEST['creative'];
		$IP = getenv("REMOTE_ADDR");


$Type_Loan="Req_Loan_Personal";


if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
	Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
function  Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email )
	{
	$dataInsert = array("ibibo_product"=>1, "ibibo_requestid"=>$ProductValue, "ibibo_name"=>$Name, "ibibo_city"=>$City, "ibibo_mobile"=>$Phone, "ibibo_dob"=>$DOB, "ibibo_car_name"=>$Ibibo_compaign, " ibibo_dated"=>$Dated, "ibibo_email"=>$Email);
$table = 'ibibo_compaign_leads';
$insert = Maininsertfunc ($table, $dataInsert);
	
	}

		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9911940202,9891118553) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	//echo $getdetails."<br>";
	//exit();
	 list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		$cntr=0;

	if($alreadyExist>0)
	{

		$ProductValue=$myrow[$cntr]['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";

	}
	else
	{
	
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
		$i=0;
			
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$i]['UserID'];
			
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Dated"=>$Dated, "Pincode"=>$Pincode, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance, "Reference_Code"=>$Reference_Code, "Direct_Allocation"=>$Direct_Allocation, "IsProcessed"=>$IsProcessed, "Edelweiss_Compaign"=>$edelweiss, "Cpp_Compaign"=>$cpp_card_protect, "Annual_Turnover"=>$Annual_Turnover);
			
			}
			else
			{
				$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$table = 'wUsers';
				$UserID = Maininsertfunc ($table, $dataInsert);
				
				$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Dated"=>$Dated, "Pincode"=>$Pincode, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance, "Reference_Code"=>$Reference_Code, "Direct_Allocation"=>$Direct_Allocation, "IsProcessed"=>$IsProcessed, "Edelweiss_Compaign"=>$edelweiss, "Cpp_Compaign"=>$cpp_card_protect, "Annual_Turnover"=>$Annual_Turnover);
			
			}
			
			$table = 'Req_Loan_Personal';
$ProductValue = Maininsertfunc ($table, $dataInsert);
		
			if($edelweiss=="1")
				{
				 //InsertEdelweiss($ProductValue, $Name,$City, $Phone, $DOB,$Pincode  );
				}

				if($cpp_card_protect=="1")
				{
				// Insertcpp($ProductValue, $Name,$City, $Phone, $DOB,$Email);
				}
if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}

		if(strlen($Ibibo_compaign)>0)
		{
			Insert_ibibo($ProductValue, $Name, $strcity, $Phone, $DOB, $Ibibo_compaign, $Email);
		}

			$_SESSION['Temp_LID'] = $ProductValue;
			list($First,$Last) = split('[ ]', $Name);

	
if($Net_Salary<=239000)
		{
if((strlen(strpos($finalurl, "apply-personal-loans-new.php")) > 0) || (strlen(strpos($finalurl, "apply-personal-loan-quote.php")) > 0))
		{
			/*$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan. You will get a call from us to give you quotes & information to get you best deal for loans.";*/
		}
		else if((strlen(strpos($finalurl, "apply-business-loans-new.php")) > 0))
			{
$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Business loan.";
			}
			else
			{
			//$SMSMessage="";
$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan.";
			}
		}
		else
		{
			if((strlen(strpos($finalurl, "apply-personal-loans-new.php")) > 0) || (strlen(strpos($finalurl, "apply-personal-loan-quote.php")) > 0))
		{
			/*$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan. You will get a call from us to give you quotes & information to get you best deal for loans.";*/
		}
		else if((strlen(strpos($finalurl, "apply-business-loans-new.php")) > 0))
			{
$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Business loan.";
			}
		else
			{
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Personal loan. ";
			}
		}
		if(strlen(trim($Phone)) > 0 && strlen(trim($SMSMessage)) > 0 )
		{	
			NewAir2webSendSMS($SMSMessage, $Phone, 1 , $ProductValue);
		}
		
		if((strlen(strpos($finalurl, "apply-business-loans-new.php")) > 0))
		{
			$FName = $Name;
			$Message2="<table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
  <tr>
    <td width='560' height='101' align='center' valign='top'><img src='http://www.deal4loans.com/images/mlr-hdr.jpg' width='560' height='101' /></td>
  </tr>
  <tr>
    <td><table width='560' border='0' align='center' cellpadding='0' cellspacing='0'>
      <tr>
        <td width='1' bgcolor='#7cabda'><img src='http://www.deal4loans.com/images/spacer.gif' width='1'  height='1' border='0' /></td>
        <td><table width='98%' border='0' align='center' cellpadding='0' cellspacing='0'>
          <tr>
            <td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; '><b>Dear $FName</b>,<br />

              Thanks for applying for a Business Loan on Deal4loans.com. We are committed to provide you with a platform to compare choose the best deal for your loan requirement. <br />
              <br />
			  </td></tr>
			  <tr><td colspan='2' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#061c33; line-height:18px; width:300px;'>
 Your <b>Profile Summary</b> as per our records:<br />
 Your Name: $FName<br />
Location: $City<br />
Income/Salary: $Net_Salary<br />
Email Id: $Email<br />
Contact :$Phone
<br /><br />
<b><u>Things to take care before taking Business Loan</u></b>
<ol>
<li>You should do a complete and detailed market survey of the various options like the interest rates they offer, the pre-payment charges they levy, terms and conditions. </li>

<li>Interest rates are the most critical of all the costs that you pay. Therefore you should go for the cheapest option. Beware of banking terms like flat <a href='http://www.deal4loans.com/personal-loan-interest-rate.php'>Business loan interest rates</a> that appear to be cheaper but are in fact the most expensive. For example a 7% flat rate would come out to an effective cost of around 13%. Therefore its better to choose a monthly reducing balance option than a half-yearly reducing option or flat-rate option. This means lower effective cost for the same stated interest rate. Interest-free loans are sometimes too good to be true but view them with suspicion. </li>

<li>There will also be other costs such as processing charges. You should try to negotiate on the processing fees and go for the least option available. Make sure you work out as to how much these other costs add up to. So even though the interest rate may be lower, it usually adds up to being expensive.</li>
<li>Usually the EMIs may come out a lot more than what you can afford on a monthly basis. But keep in mind that you should know that lower tenure will reduce the loan amount and lower loan amount will reduce the tenure. </li>
<li>Make sure that all deals and offers agreed upon are supported by relevant papers. So make sure you always ask for a letter in a banks letter-head mentioning the likes of, exact rate of interests, processing fees, pre-payment charges along with interest-schedule. Also before signing the documents, make sure you recheck all terms and conditions.</li>

<li><b>Do not give any cheque, cash as processing fee to any Bank, Dsa  employee. No Bank authorizes any cash or processing fee collection before the loan.   They will deduct processing fee from your loan amount only.</b></li>

<li> Do not sign any blank documents. Even if it takes you a few hours to fill-up the form, please do so. Do not leave anything for the executive to fill-up.<br />

When you give documents to any associate, check his employee id or card etc.This will ensure your documents are not handed over to a broker etc.<br />

Check whether he is associated with the bank for which you give documents to.<br />

Don�t give documents to agents who say they can get it done from multiple banks.</li></ol>
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


<b>Banker�s Preferences for an applicant:</b>
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
if($Name)
			{
	$SubjectLine = $Name.", Learn to get Best Deal on Business Loan";
			}
			else
			{
				$SubjectLine = "Learn to get Best Deal on Business Loan";
			}

		}
		else
		{
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
		}

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}

//echo $finalurl."<br>";

if($Net_Salary<=239000)
		{
			if((strlen(strpos($finalurl, "apply-personal-loans-new.php")) > 0) || (strlen(strpos($finalurl, "apply-personal-loan-quote.php")) > 0))
			{
				echo "<script language=javascript>"." location.href='apply-personal-loans-new-continue.php'"."</script>";	
			}
		else if((strlen(strpos($finalurl, "apply-personal-loan-new.php")) > 0))
			{
				echo "<script language=javascript>"." location.href='apply-personal-loan-less-new.php'"."</script>";	
			}
			else if((strlen(strpos($finalurl, "apply-personal-loan-continue-test.php")) > 0))
			{
				echo "<script language=javascript>"." location.href='apply-personal-loan-less-test.php'"."</script>";	
			}
			else if((strlen(strpos($finalurl, "apply-business-loans-new.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-for-business-loans-continue.php'"."</script>";	
		}
			else
			{
				echo "<script language=javascript>"." location.href='apply-personal-loan-less.php'"."</script>";	
			}
			
		}
		else
			{
		if((strlen(strpos($finalurl, "apply-personal-loans.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "personal-loans-apply.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='personal-loans-apply-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loans-new.php")) > 0) || (strlen(strpos($finalurl, "apply-personal-loan-quote.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-new-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loans2.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-sbi-personal-loans.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-sbi-personal-loans-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "personal-loan-apply.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='personal-loan-apply-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "personal-loan-application.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='personal-loan-application-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loan-continue2.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-continue2-test.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loan-new.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-for-personal-loan-new.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-business-loans-new.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-for-business-loans-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "Youmint_Mailer")) > 0))
		{

echo "<script language=javascript>"." location.href='thank_youmint.php'"."</script>";	
		}
		else
		{
			echo "<script language=javascript>"." location.href='apply-for-personal-loans-continue.php'"."</script>";	
		}

	}

	}

		}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}


}
?>