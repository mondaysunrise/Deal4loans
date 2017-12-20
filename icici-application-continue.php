<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblefuncICICIPLdigicall.php';
require 'scripts/personal_loan_eligibility_function_form.php';

function DetermineAgeGETDOB ($YYYYMMDD_In) {  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;   if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }	

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$cust_loan = $_POST['cust_loan'];
		$relationship = $_POST["relationship"];
		$City = $_POST["City"];
		$Employment_Status = $_POST["Employment_Status"];
		$Company_Name = $_POST["Company_Name"];
		$Net_Salary = $_POST["Net_Salary"];
		$monthsalary = $_POST["Net_Salary"]/12;
		$total_emi = $_POST["total_emi"];
		$other_emi = $_POST["other_emi"];
		$Phone = $_POST["Phone"];
		$source = $_POST["source"];
		$Name = $_POST["Name"];
		$Email = $_POST["Email"];
		$City_Other = $_POST["City_Other"];
		$getDOB = str_replace("-","", $DOB);
		$age = $_POST['age'];
		$year = date("Y") - $age;
		$DOB =$year."-".date("m")."-".date("d");
		$Company_Type= $_POST["Company_Type"];
		$IP_Remote = getenv("REMOTE_ADDR");
	if($IP_Remote=='192.99.32.74') { $IP_Address= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP_Address=$IP_Remote;	}
		
		if($relationship=="SALARY_ACCOUNT" || $relationship=="SAVINGS_ACCOUNT" || $relationship=="CURRENT_ACCOUNT")
		{
			$Primary_Acc="ICICI";
		}
	
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select icicirequestID,Updated_Date From ICICI_Allocated_Leads  Where ( Mobile_Number not in (9811215138,9999047207,9891118553,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by icicirequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			if($alreadyExist>0)
			{
				header('Location: https://www.deal4loans.com/icici-bankstep4.php');
				exit();
			}
			else
			{
				$Dated = ExactServerdate();
				$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Residential_Status'=>$Residential_Status, 'Loan_Any'=>$Loan_Any, 'EMI_Paid'=>$EMI_Paid, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'Card_Limit'=>$Card_Limit, 'Loan_Amount'=>$cust_loan, 'Pincode'=>$Pincode, 'Dated'=>$Dated, 'CC_Age'=>$CC_Age, 'CC_Bank'=>$CC_Bank, 'Primary_Acc'=>$Primary_Acc, 'PL_EMI_Amt'=>$PL_EMI_Amt, 'PL_Bank'=>$PL_Bank, 'PL_Tenure'=>$PL_Tenure, 'PL_EMI_Paid'=>$PL_EMI_Paid, 'IP_Address'=>$IP, 'DOB'=>$DOB, 'Salary_Drawn'=>$Salary_Drawn, 'Updated_Date'=>$Dated, 'Add_Comment'=>$Add_Comment, 'identification_proof'=>$identification_proof, 'Company_Type'=>$Company_Type, 'Annual_Turnover'=>$Annual_Turnover, 'Years_In_Company'=>'1', 'Total_Experience'=>'3');
				$ProductValue = Maininsertfunc ('ICICI_Allocated_Leads', $dataInsert);
		}

	if($City=="Others" || $City=="Please Select")
	{
		$strCity=$City_Other;
	}
	else
	{
		$strCity= $City;
	}

	$getcompany='select icici_bank from pl_company_list where ((company_name="'.$Company_Name.'"))';
	list($num_rows,$grow)=Mainselectfunc($getcompany,$array = array());

	$icici_bankcmp = $grow["icici_bank"];

		list($FinalBidder,$finalBidderName)= getBiddersList("ICICI_Allocated_Leads",$ProductValue,$strCity);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Personal Loan</title>
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link href="newicici-pl-styles-12.css" type="text/css" rel="stylesheet" />
<style type="text/css">
.heading-tbtd{ font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#06396b;}
.heading-tbtd2{ font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;}
</style>

 <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
        <script type="text/javascript" src="scripts/common.js"></script>
	<!-- jQuery and the Poshy Tip plugin files -->
	
</head>
<body>	
<hr>
<div class="header">
<div class="header-inner">
<div class="logo" style="font-family:Arial, Helvetica, sans-serif; color:#06396b; font-size:22px; font-weight:bold; width:600px !important;">Get Instant Quote on ICICI Bank Personal Loans</div><!--<div class="logo"><img src="images/icici-app-logo.jpg" width="189" height="47"></div>-->
<div class="right-box-app"><span class="text-a">Powered by</span> <br>
<span class="text-a" style="color:#0f8eda; font-size:18px;">Deal4loans.com</span></div>
<div style="clear:both;"></div>
</div>
</div>
<div class="wrapper">
<div class="left-container">
<div style="clear:both"></div>
<div id="wrapper">
   <div id="container">
   <p><strong>Thank you</strong></p>
     <? if($FinalBidder[0]>0)
   {
	   if(((($icici_bankcmp=="" && ((strncmp("ICICI", $Primary_Acc,5))!=0) && $Net_Salary<396000) || ($icici_bankcmp=="" && ((strncmp("ICICI", $Primary_Acc,5))==0) && $Net_Salary<264000)) && ($FinalBidder[0]==4900)))
	   {
	   }
	   else
	   {
	   ?>
   <table width="876" border="1" cellpadding="0" cellspacing="0">
   <tr style="background-color:#fe9515;">
    <th width="163" align="center" valign="middle" class="heading-tbtd">Bank Name</th>
	   <th width="121" align="center" valign="middle" class="heading-tbtd">Eligible Loan<br /> 
      Amount</th>
    <th width="114" align="center" valign="middle" class="heading-tbtd">Interest Rate</th>
    <th width="114" align="center" valign="middle" class="heading-tbtd">Emi (per Month)</th>
    <th width="91" align="center" valign="middle" class="heading-tbtd">Tenure</th>
 
       <th width="118" align="center" valign="middle" class="heading-tbtd">Processing Fee</th>
      <th width="139" align="center" valign="middle" class="heading-tbtd">Pre-Payment charges</th>
	
      </tr>
 <?
list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi,$profee)=icicibank($monthsalary,$Company_Name,$icici_bankcmp,$age,$Company_Type,$Primary_Acc);
	?>
<tr> <td width="163" height="25" align="center" valign="middle"><b style="font-size:12px;"><img src="/new-images/thumb/icici.jpg" width="146" height="67"></b></td>
<td width="121" align="center" class="heading-tbtd2"><? echo "Rs. ".$icicigetloanamout; ?></td>
<td width="114" align="center" class="heading-tbtd2"><? echo $iciciinterestrate; ?></td>
<td width="114" align="center" class="heading-tbtd2"><? echo "Rs.".$icicigetemicalc; ?></td>
<td width="91" align="center"><b style="font-size:12px;"><? echo $iciciterm." yrs"; ?></td>
	<td width="118" align="center" class="heading-tbtd2"><? echo $profee; ?></td>
	<td width="139" align="center" class="heading-tbtd2">5%</td>
</tr>	
<?
   }
   }
	else
	{
	}
			?>
			</table>
    </div>
  </div>

</div>

</div>
</body>
</html>