<?php  
require 'scripts/db_init.php'; 
require 'scripts/functions.php'; 
require 'scripts/personal_loan_eligibility_function_form.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$Loan_Amount = FixString($_POST["Loan_Amount"]);
	$Employment_Status = FixString($_POST["Employment_Status"]);
	$Company_Name = FixString($_POST["Company_Name"]);
	$IncomeAmount = FixString($_POST["IncomeAmount"]);
	$Total_Obligation = FixString($_POST["Total_Obligation"]);
	$City = FixString($_POST["City"]);
	$City_Other = FixString($_POST["City_Other"]);
	$Name = FixString($_POST["Name"]);
	$Phone = FixString($_POST["Phone"]);
	$Email = FixString($_POST["Email"]);
	$age = FixString($_POST["age"]);
	$source = FixString($_POST["source"]);
	$Dated=ExactServerdate();
	
	if($City=="Others" && strlen($City_Other)>1)
	{
		$strcity = $City_Other;
	}
	else
	{
		$strcity = $City;
	}

$getCompany_Name = trim($Company_Name);
	
		$todayDate = date("Y-m-d")." 23:59:59";
$lastmonth = mktime(0, 0, 0, date("m"), date("d")-30, date("Y"));
$days30ago = date("Y-m-d",$lastmonth)." 00:00:00";

 $checkDupSql = "select indusbnkid from indusbank_exclusive_leads where indusbnk_mobileno = '".$Phone."' and indusbnk_mobileno not in (9711722615,9811555306,9717594462,9811215138) and (indusbnk_dated between '".$days30ago."' and '".$todayDate."')";
list($alreadyExist,$myrow)=MainselectfuncNew($checkDupSql,$array = array());
$myrowcontr = count($myrow)-1;
$checkDupNum = $alreadyExist;

if($alreadyExist>0)
{
}
else
{
	if(strlen($City)>0 && strlen($Name)>0 && strlen($Phone)>0)
	{
	
	$dataInsert = array('indusbnk_name'=>$Name, 'indusbnk_email'=>$Email, 'indusbnk_mobileno'=>$Phone, 'indusbnk_city'=>$City, 'indusbnk_city_other'=>$City_Other, 'indusbnk_occupation'=>$Employment_Status, 'indusbnk_companyname'=>$Company_Name, 'indusbnk_monthlyincome'=>$IncomeAmount, 'indusbnk_loanamount'=>$Loan_Amount, 'indusbnk_totalobligation'=>$Total_Obligation, 'indusbnk_source'=>$source, 'indusbnk_dated'=>$Dated, 'indusbnk_age'=>$age);
	echo $ProductValue = Maininsertfunc ("indusbank_exclusive_leads", $dataInsert);
	
	$getcompany='select indusind from pl_company_indusind where company_name="'.$getCompany_Name.'"';
	list($alreadyExist1,$grow)=MainselectfuncNew($getcompany,$array = array());
	$growcontr = count($grow)-1;
	$Indusind = strtoupper($grow[$growcontr]["indusind"]); 
	
	//echo $IncomeAmount." - ".$getCompany_Name." - ".$Indusind." - ".$age." - ".$Total_Obligation."<br><br>";

	if(((strlen($Indusind)>1 && $IncomeAmount>=25000) || $IncomeAmount>=40000) && $Employment_Status==1 && $Loan_Amount>=100000)
	{
		//echo $IncomeAmount." - ".$getCompany_Name." - ".$Indusind." - ".$age." - ".$Total_Obligation."<br><br>";
	list($indusindrate,$indusindloanamt,$indusindemi,$indusindterm,$indusindperlacemi)=@indusindbank($IncomeAmount,$getCompany_Name,$Indusind,$age,$Total_Obligation);

		if($indusindloanamt>0 && $indusindemi>1)
		{
			$msg="eligible";
		}
		//Lead allocation
	$getBiddSql =  "select BidderID from Bidders_List where (BidderID in (4083,4084,4085,4086,4087,4088,4089,4090,4091,4092,5168,5409,5410,5411,5412,5413,5414,5415) and Reply_Type=1 and Restrict_Bidder=1 and City like '%".$strcity."%')";
		list($numgetBidd,$rowseq)=MainselectfuncNew($getBiddSql,$array = array());
	$rowseqcontr = count($rowseq)-1;
		$BidID = $rowseq[$rowseqcontr]["BidderID"];
		
		if($BidID>0)
		{
			$currentdate=date('d-m-Y');
			$message ="Your Personal loan Leads on (".$currentdate.") : ";
			$getSMSSql = "select * from Req_Compaign where (BidderID= '".$BidID."' and Sms_Flag=1)";
			list($numgetSMS,$getSMSQuery)=MainselectfuncNew($getSMSSql,$array = array());
			
			$SMSMessage='';
			for($z=0;$z<$numgetSMS;$z++)
			{
				$BMobile_no = $getSMSQuery[$z]['Mobile_no'];								
				$SMSMessage=$SMSMessage."(1) ".$Name."-".$Phone.",Sal- ".$IncomeAmount.",Co- ".$Company_Name;

				if(strlen(trim($BMobile_no)) > 0)
				{
					$strmobile_no = $BMobile_no;
					
					$appnd=" exclusive";
					//$strmobile_no="9811215138";
				 //	SendSMSforLMS($message.$SMSMessage.$appnd, $strmobile_no);
								
					$dataBnk = array('bid'=>$BidID, 'rid'=>$ProductValue, 'city'=>$strcity, 'mobile'=>$strmobile_no, 'Dated'=>$Dated);
					Maininsertfunc ("indusbnk_msging", $dataBnk);
				}
			}

			$dataBnk = array('indusbnk_status'=>'1');
			$wherecondition = "(indusbnkid='".$ProductValue."')";
			Mainupdatefunc ('indusbank_exclusive_leads', $dataBnk, $wherecondition);
		}
	
		// End of lead allocation
	}
	else
	{
		$msg="Not eligible";
	}
	}
}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>IndusInd Bank Personal Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="indusind-pl-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="header">
<div class="header_inn">
<div class="logo"><img src="images/indusind-logo.jpg" width="215" height="40"></div>
<div class="right_top_text">Powered by: <span style="color:#0e8cc6;">Deal4loans.com</span></div>
</div>
</div>
<div class="form_main-wrapper">
<div class="form_main_wrapper-inn">
<div class="left-wrapper-new">
<h1>Professional Details</h1>
<div class="left-form-wrapper-new">
<? if($msg=="eligible")
{
?>
<table width="949"  align="center" border="0" cellspacing="0" cellpadding="0">
 <tr><td height="35" style="color:#FFFFFF; padding-left:15px; line-height:18px; font-size:12px; font-weight:bold; font-family:Verdana, Arial, Helvetica, sans-serif;"><b>Dear Customer ,<br>
	    Based on the information furnished by you, we are   pleased to offer you a Tentative Personal Loan Eligibility Quote as per details   mentioned: <br><br>Offer Details: </b></td>
	  </tr>
  <tr>
    <td height="85" ><table width="98%"   border="0" align="center" cellpadding="0" cellspacing="0" style="border:thin solid #6d0200;">
          <tr>
        <td height="27" align="center"  bgcolor="#6d0200" class="boldtxt" style="font-size:14px; line-height:28px; color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;" > Loan Amount<br>
            </td>
        <td  width="1" rowspan="2" align="left" bgcolor="#6d0200" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="85"></td>
        <td height="27" align="center" bgcolor="#6d0200" class="boldtxt" style="font-size:14px; line-height:28px; color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">Interest Rate<br>
           </td>
        <td  width="1" rowspan="2" align="left" bgcolor="#6d0200" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="85"></td>
        <td height="27" align="center"  bgcolor="#6d0200" class="boldtxt" style="font-size:14px; line-height:28px; color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">EMI (Per month)<br>
           </td>
        <td  width="1" rowspan="2" align="left" bgcolor="#6d0200" ><img src="new-images/hdfc-pl/sprt-line.gif" width="1" height="85"></td>
        <td height="27" align="center" bgcolor="#6d0200" class="boldtxt" style="font-size:14px; line-height:28px; color:#FFFFFF; font-family:Arial, Helvetica, sans-serif;">Tenure<br>
           </td>
           </tr>
          <tr>
            <td height="28" align="center"  bgcolor="#fce0e0" class="boldtxt" style="font-size:13px; line-height:28px;" ><span style="color:#b04c09; "><? echo "Rs ".number_format($indusindloanamt) ; ?></span></td>
            <td height="28" align="center" bgcolor="#fce0e0" class="boldtxt" style="font-size:13px; line-height:28px;"> <span style="color:#b04c09; "><? echo $indusindrate; ?></span></td>
            <td height="28" align="center" bgcolor="#fce0e0" class="boldtxt" style="font-size:13px; line-height:28px;"> <span style="color:#b04c09; "><? echo "Rs ".$indusindemi; ?></span></td>
            <td height="28" align="center" bgcolor="#fce0e0" class="boldtxt" style="font-size:13px; line-height:28px;"> <span style="color:#b04c09; "><? echo $indusindterm; ?> yrs</span></td>
          </tr>
    </table></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  </table>
  <? } 
  else
  { ?>
<table width="949"  align="center" border="0" cellspacing="0" cellpadding="0">
<tr><td>
Sorry You are not eligible as per the policy.
</td></tr></table>
  <? } ?>
</div>
</div>
<div class="right_box_new">
<h2>Features of <span style="font-style:italic; font-size:24px;">IndusInd Bank</span> Personal Loan</h2>
<div class="bullet_text">
<ul>
<li>Loan up to 15 Lac*
</li>
<li>Attractive Interest Rate &amp; Processing charges</li>
<li>Hassle free loans - No security/collateral required.<br>
</li>
<li>Choose a loan tenure as per your convenience ranging from 1 to 5 years<br>
</li>
</ul>
</div>
</div>
<div style="clear:both;"></div>
</div>
</div>
<div class="bottom"></div>
</body>
</html>