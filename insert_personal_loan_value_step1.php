<?php
//ob_start();
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
  //print_r($_POST);
$_SESSION['Temp_LID']="";

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		
		$BankName = implode(',',$banks);
		$BankNameStr = str_replace("-"," ",$BankName);
		$_SESSION['BankNameStr'] = $BankNameStr;
		
		$UserID = $_SESSION['UserID'];
		$finalurl=$_POST["PostURL"];
		
		if(isset($_POST["Name"]))
		{
			$Name = FixString($Name);
			$namearr=explode(" ",$Name);
			$first_name = $namearr[0];
			if(count($namearr)>1)
			{
				if(!empty($namearr[1]) && empty($namearr[2]))
				{
					$middle_name = $namearr[2];
					$last_name = $namearr[1];
				}
				else
				{
					$middle_name = $namearr[1];
					$last_name = $namearr[2];
				}
			}
			else
			{
				$middle_name = "";
				$last_name = "";
			}
			
			$full_name = trim($first_name).",".trim($middle_name).",".trim($last_name);
		}
		else
		{
			$first_name = FixString($first_name);
			$middle_name = FixString($middle_name);
			$last_name = FixString($last_name);
			$full_name = trim($first_name).",".trim($middle_name).",".trim($last_name);
			$Name = trim($first_name)." ".trim($middle_name)." ".trim($last_name);
		}
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Age=FixString($Age);
		$Loan_Amount= FixString($Loan_Amount);
		$Pincode = FixString($Pincode);
		$Phone = FixString($Phone);
		$Employment_Status = FixString($Employment_Status);
		$Card_Vintage = FixString($Card_Vintage);
		$Email = FixString($Email);
		$Type_Loan = FixString($Type_Loan);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$From_Product = $_REQUEST['From_Product'];
		$City_Other = FixString($City_Other);
		$Net_Salary = $_REQUEST['IncomeAmount'];
		$CC_Holder = FixString($CC_Holder);
		$Card_Vintage = FixString($Card_Vintage);
		$_SESSION['Temp_CC_Holder'] = $CC_Holder;
		$Annual_Turnover = FixString($Annual_Turnover);
		$Holding_Current_Account = FixString($Holding_Current_Account);
		$REFERER_URL = $_POST["REFERER_URL"];
		$hdfclife = FixString($hdfclife);
		$EMI_Paid = FixString($EMI_Paid);
		$accept = FixString($accept);
		$_SESSION['finalurl']=$finalurl;
		$Dated=ExactServerdate();
		$Updated_Date=ExactServerdate();
		$edelweiss="";
		$cpp_card_protect="";
		if($Employment_Status==0)
		{
			$Total_Experience = $_POST["Total_Experience"];
			$Loan_A = $_POST["Loan_Any"];
			$Residential_Status = $_POST["Residential_Status"];

			$nn = count($Loan_A);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_Any .= "$Loan_A[$ii], ";
			 $ii++;
			 }						
		}
		else
		{
			$Total_Experience = "";
			$Loan_A = "";
			$Residential_Status = "";
		}
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
		
		$PL_Tenure = $_POST['Tenure'];
		$PL_Bank = implode(",",$_POST['banks']);
		if((strlen(strpos($finalurl, "apply-personal-loans-bnrcamp.php")) > 0))
		{
			$Reference_Code = generateNumber(4);	
		}
		else
		{
		if($Net_Salary<=270000 || $Employment_Status==0)
		{	
		$Reference_Code = generateNumber(4);
		$Direct_Allocation =1;
		$IsProcessed=1;		
		}
	else
		{
			$Reference_Code = "";
			$Direct_Allocation =0;
			$IsProcessed=0;
		}
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
		//$IP = getenv("REMOTE_ADDR");
		//$IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
                $IP=ExactCustomerIP();
	$_SESSION['Temp_LID']="";
			
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
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9891118553,9999570210,9555060388,9311773341) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	
	if($alreadyExist>0)
	{
		$ProductValue=$myrow['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";
	}
	else
	{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$myrow1)=Mainselectfunc($CheckSql,$array = array());
			
			if($CheckNumRows>0)
			{
				$UserID = $myrow1["UserID"];
				$data = array("UserID" => $UserID,"Name" => $Name,"full_name" => $full_name, "Email" => $Email,  "Employment_Status" => $Employment_Status,  "Company_Name" => $Company_Name,  "City" => $City,  "City_Other" => $City_Other,  "Mobile_Number" => $Phone, "Std_Code" => "NULL", "Landline" => "NULL","Net_Salary" => $Net_Salary,  "CC_Holder" => $CC_Holder,  "Loan_Amount" => $Loan_Amount,  "DOB" => $DOB, "Pincode" => $Pincode,  "source" => $source,  "CC_Bank" => $From_Product,  "Card_Vintage" => $Card_Vintage,  "Referrer" => $Referrer, "Creative" => $Creative,  "Section" => $Section,  "IP_Address" => $IP,"Accidental_Insurance" => "","Reference_Code" =>$Reference_Code, "Direct_Allocation"=> $Direct_Allocation, "IsProcessed"=> $IsProcessed, "Edelweiss_Compaign"=>$edelweiss,"Cpp_Compaign"=> $cpp_card_protect, "Annual_Turnover" => $Annual_Turnover,  "Privacy" => $accept,  "EMI_Paid" => $EMI_Paid,  "PL_Bank" => $PL_Bank,  "PL_Tenure" => $PL_Tenure,  "Total_Experience" => $Total_Experience,  "Loan_Any" => $Loan_A,  "Residential_Status"=>$Residential_Status,"Dated"=>$Dated,"Updated_Date"=>$Updated_Date, "Holding_Current_Account"=>$Holding_Current_Account);			
				
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID1 = Maininsertfunc("wUsers", $wUsersdata);
						
				$data = array("UserID" => $UserID1, "Name" => $Name, "full_name" => $full_name, "Email" => $Email,  "Employment_Status" => $Employment_Status,  "Company_Name" => $Company_Name,  "City" => $City,  "City_Other" => $City_Other,  "Mobile_Number" => $Phone, "Std_Code" => "", "Landline" => "","Net_Salary" => $Net_Salary,  "CC_Holder" => $CC_Holder,  "Loan_Amount" => $Loan_Amount,  "DOB" => $DOB, "Pincode" => $Pincode,  "source" => $source,  "CC_Bank" => $From_Product,  "Card_Vintage" => $Card_Vintage,  "Referrer" => $Referrer, "Creative" => $Creative,  "Section" => $Section,  "IP_Address" => $IP,"Accidental_Insurance" => "","Reference_Code" =>$Reference_Code, "Direct_Allocation"=> $Direct_Allocation, "IsProcessed"=> $IsProcessed, "Edelweiss_Compaign"=>$edelweiss,"Cpp_Compaign"=> $cpp_card_protect, "Annual_Turnover" => $Annual_Turnover,  "Privacy" => $accept,  "EMI_Paid" => $EMI_Paid,  "PL_Bank" => $PL_Bank,  "PL_Tenure" => $PL_Tenure,  "Total_Experience" => $Total_Experience,  "Loan_Any" => $Loan_A,  "Residential_Status"=>$Residential_Status,"Dated"=>$Dated,"Updated_Date"=>$Updated_Date, "Holding_Current_Account"=>$Holding_Current_Account);
			}			
			//print_r($data);
			 $ProductValue = Maininsertfunc("Req_Loan_Personal", $data);
			
			//Send SMS
			ProductSendSMStoRegis($Phone);
			
if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}

		if($hdfclife==1)
		{
			$Product=1;
			Insert_HdfcLife($Name, $strcity, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}

			$_SESSION['Temp_LID'] = $ProductValue;			
			list($First,$Last) = split('[ ]', $Name);
	
	if((strlen(strpos($finalurl, "apply-personal-loans-bnrcamp.php")) > 0))
		{
			$SMScampMessage = "Please use this code: ".$Reference_Code."  to activate you loan request at deal4loans.com";

			if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMScampMessage, $Phone);
		}

if($Net_Salary<=270000)//changed on 20Jan14
		{
if((strlen(strpos($finalurl, "apply-personal-loans-new.php")) > 0) || (strlen(strpos($finalurl, "apply-personal-loan-quote.php")) > 0))
		{
		}
		else if((strlen(strpos($finalurl, "apply-business-loans-new.php")) > 0) || (strlen(strpos($finalurl, "business-loans.php")) > 0))
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
		else if((strlen(strpos($finalurl, "apply-business-loans-new.php")) > 0) || (strlen(strpos($finalurl, "business-loans.php")) > 0))
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
			//NewAir2webSendSMS($SMSMessage, $Phone, 1 , $ProductValue);
		}
		
		if((strlen(strpos($finalurl, "apply-business-loans-new.php")) > 0) || (strlen(strpos($finalurl, "business-loans.php")) > 0))
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

Don’t give documents to agents who say they can get it done from multiple banks.</li></ol>
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
	<li><b>Health Insurance:</b> <a href='http://www.bimadeals.com/health-insurance-india/Contents_Health_Insurance_Mustread.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>How much Health Insurance you need</a>  | <a href='http://www.bimadeals.com/health-insurance-india/health-insurance-comparison-chart.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Compare Family Health Insurance Plan</a>  | <a href='http://www.bimadeals.com/health-insurance-india/Req_Health_Insurance_New.php?source=plAM' target='_blank' style='color:#0a4988; text-decoration:underline;'>Apply for Health Insurance</a></li> 
	</ul>
	</td></tr>
	<tr><td>
			<tr>
  <td colspan='2' bgcolor='#fff' style='border-bottom:thin solid #f2f2f2;'>
  <table cellpadding='0' cellspacing='0' border='0' width='588' align='center' style='max-width:588px; width:98%;'>
<tr>
  <td colspan='2' bgcolor='#FFFFFF' style='font-size:11px; font-weight:normal; font-family:Verdana, Geneva, sans-serif;'><b>Important Tips</b></td>
</tr>
<tr>    
          <td width='16' valign='top'  style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>Never pay any cash or any sort of payment/fee to anyone to get any loan approved.</td></tr>
          <tr>
         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
No Banks ask for any processing fee upfront</td></tr>
<tr>         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall prey to agents who ask for a fee for a loan approval at very cheap interest rates.
</td>
    </tr>
    <tr>         
          <td width='16' valign='top' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px;'>&bull;</td>
          <td width='1341' style='color:#000; font-family: Arial, Helvetica, sans-serif; font-size:12px; text-align:justify;'>
Do not fall for offers that guarantee loan approvals with any kind of advance fee payment to any individual in general or even particularly acting on our behalf.
</td>
    </tr>
    </table>
    </td></tr>
	<tr><td colspan='2'>&nbsp;</td></tr>
		<tr><td>		
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
			include "scripts/mailtocommonproduct.php";
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
		}

		$headers = "From: deal4loans <no-reply@deal4loans.com>";
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: newtestthankuse@gmail.com"."\n";
	    $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $Message2 . "\n\n";
	
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $message, $headers);
			}

if((strlen(strpos($finalurl, "personal-loan.php")) > 0))
		{
			header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/apply-for-personal-loans-continue-cibil.php");
				 exit;
			}

if($Net_Salary<=270000 && $Employment_Status!=0 && $Employment_Status!=2)//changed on 20jan14
		{
			if(($Employment_Status==0 || $Employment_Status==2) && $Section=="BL16June15")
			{
				 header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/thank_blloans.php?ctrq=".$ProductValue);
				 exit;
			}
			else
			{
			if((strlen(strpos($finalurl, "apply-personal-loans-new.php")) > 0) || (strlen(strpos($finalurl, "apply-personal-loan-quote.php")) > 0))
			{
				echo "<script language=javascript>"." location.href='apply-personal-loans-new-continue.php'"."</script>";	
			}
		else if((strlen(strpos($finalurl, "apply-personal-loan-new.php")) > 0))
			{
				echo "<script language=javascript>"." location.href='apply-personal-loan-less-new.php'"."</script>";	
			}
			else if((strlen(strpos($finalurl, "get-personal-loan.php")) > 0))
			{
				echo "<script language=javascript>"." location.href='get-personal-loan-lesscontinue.php'"."</script>";	
			}
			else if((strlen(strpos($finalurl, "get-personal-loan1.php")) > 0))
			{
				echo "<script language=javascript>"." location.href='get-personal-loan-lesscontinue.php'"."</script>";	
			}
			else if((strlen(strpos($finalurl, "apply-personal-loan-continue-test.php")) > 0))
			{
				echo "<script language=javascript>"." location.href='apply-personal-loan-less-test.php'"."</script>";	
			}
			else if((strlen(strpos($finalurl, "apply-business-loans-new.php")) > 0) || (strlen(strpos($finalurl, "business-loans.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-for-business-loans-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loans-bnrcamp.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-bnrcampcontinue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loans-bnr.php")) > 0) || (strlen(strpos($finalurl, "plbanner160x600")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-bnrcontinue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loans-bnr1.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-bnrcontinue1.php'"."</script>";	
		}

		else if((strlen(strpos($finalurl, "hdfc-personal-loan-apply.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='hdfc-personal-loan-apply-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "personal-loans-apply-n.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='personal-loans-apply-ncontinue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "personalloan-application.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='personalloan-application-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-for-personal-loans.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-for-personal-loanscontinue1.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-business-loans-n.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-for-business-loans-continue.php'"."</script>";		
		}
		else if((strlen(strpos($finalurl, "apply-personal-loans.php")) > 0) || (strlen(strpos($finalurl, "personal-loan-emi-calculator.php")) > 0) || (strlen(strpos($finalurl, "personal-loan-sbi.php")) > 0) || (strlen(strpos($finalurl, "personal-loan-axis-bank.php")) > 0) || (strlen(strpos($finalurl, "hdfc-personal-loan-eligibility.php")) > 0) || (strlen(strpos($finalurl, "apply-personal-loans-fb.php")) > 0) || (strlen(strpos($finalurl, "request-for-personal-loans.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-for-personal-loanscontinue1.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loan-lowest-rates.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loan-less.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "personal-loan-lowest-rates.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loan-less-forcad.php'"."</script>";	
		}
		else
		{
			echo "<script language=javascript>"." location.href='apply-personal-loan-less.php'"."</script>";	
		}
		
		}
		}
		else
			{
			if(($Employment_Status==0 || $Employment_Status==2) && $Section=="BL16June15")
			{
				 header("Location: http://".$_SERVER['HTTP_HOST'].$strDir."/thank_blloans.php?ctrq=".$ProductValue);
				 exit;
			}
			else
				{
		if((strlen(strpos($finalurl, "apply-personal-loans.php")) > 0) || (strlen(strpos($finalurl, "personal-loan-emi-calculator.php")) > 0) || (strlen(strpos($finalurl, "personal-loan-sbi.php")) > 0) || (strlen(strpos($finalurl, "personal-loan-axis-bank.php")) > 0) || (strlen(strpos($finalurl, "hdfc-personal-loan-eligibility.php")) > 0) || (strlen(strpos($finalurl, "apply-personal-loans-fb.php")) > 0) || (strlen(strpos($finalurl, "request-for-personal-loans.php")) > 0))
		{
			/*echo "<script language=javascript>"." location.href='apply-personal-loans-continue.php'"."</script>";	*/
			echo "<script language=javascript>"." location.href='apply-for-personal-loans-continue1.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-business-loans-n.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-for-business-loans-continue.php'"."</script>";		
		}
		else if((strlen(strpos($finalurl, "get-personal-loan.php")) > 0))
			{
				echo "<script language=javascript>"." location.href='get-personalloanscontinue.php'"."</script>";	
			}
			else if((strlen(strpos($finalurl, "get-personal-loan1.php")) > 0))
			{
				echo "<script language=javascript>"." location.href='get-personalloanscontinue1.php'"."</script>";	
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
		else if((strlen(strpos($finalurl, "hdfc-personal-loan-apply.php")) > 0) && $source=="hdfc_plmlr")
		{
			echo "<script language=javascript>"." location.href='hdfc-personal-loan-apply-continue.php'"."</script>";	
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
		else if((strlen(strpos($finalurl, "apply-business-loans-new.php")) > 0) || (strlen(strpos($finalurl, "business-loans.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-for-business-loans-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "Youmint_Mailer")) > 0))
		{

echo "<script language=javascript>"." location.href='thank_youmint.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loans-bnr.php")) > 0) || ((strlen(strpos($finalurl, "plbanner160x600")) > 0)))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-bnrcontinue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loans-bnrcamp.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-bnrcampcontinue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-pl-bajajfinserv.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-pl-bajajfinserv1.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loans-bnr1.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-personal-loans-bnrcontinue1.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "personal-loans-apply-n.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='personal-loans-apply-ncontinue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "personalloan-application.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='personalloan-application-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-for-personal-loans.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-for-personal-loans-continue1.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "apply-personal-loan-lowest-rates.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-for-personal-loans-continue.php'"."</script>";	
		}
		else if((strlen(strpos($finalurl, "personal-loan-lowest-rates.php")) > 0))
		{
			echo "<script language=javascript>"." location.href='apply-for-personal-loans-continue-forcad.php'"."</script>";	
		}		
		else
		{
			echo "<script language=javascript>"." location.href='apply-for-personal-loans-continue.php'"."</script>";
	       /* echo "<script language=javascript>"." location.href='apply-personal-loans-continue.php'"."</script>";	*/
		}
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