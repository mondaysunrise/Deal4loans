<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
	$$a=$b;
	
	$UserID = $_SESSION['UserID'];
	$Full_Name = FixString($Full_Name);
	$Name= $Full_Name;
	$Email = FixString($Email);
	$Phone = FixString($Phone);
	$CC_Holder = FixString($CC_Holder);
	$City = FixString($City);
	$City_Other = FixString($City_Other);
	$Company_Name = FixString($Company_Name);
	$Net_Salary =FixString($Net_Salary);
	$Day=FixString($day);
	$Month=FixString($month);
	$Year=FixString($year);
	$DOB=$Year."-".$Month."-".$Day;
	$Type_Loan = "CreditCard";
	$source = FixString($source);
	$Employment_Status = FixString($Employment_Status);
	$No_of_Banks = $_REQUEST["No_of_Banks"];
	$Salary_Account = $_REQUEST["salary_account"];
	$getDOB = $Year."".$Month."".$Day;
$gethdfccccompany='select company_category from HDFC_CC_Company_List where hdfc_company_name="'.$Company_Name.'"';
// echo $getcompany;
$getcccompanyresult = ExecQuery($gethdfccccompany);
$grow=mysql_fetch_array($getcccompanyresult);
$recordcounthdfccc = mysql_num_rows($getcccompanyresult);
if($recordcounthdfccc>0)
	{
$hdfc_cccategory = $grow["company_category"];
	}

if($hdfc_cccategory=="Cat AB" || $hdfc_cccategory=="ELITE" || $hdfc_cccategory=="PREFERRED" || $hdfc_cccategory=="SUPERPRIME")
	{
		$Company_HDFC_Cat=1;
	}
	else
	{
		$Company_HDFC_Cat=0;
	}
	
	if($City=="Others")
			{
				$strcity=$City_Other;
			}
			else
			{
				$strcity=$City;
			}

	
	$IP = getenv("REMOTE_ADDR");
	
	$crap = " ".$Name." ".$Email." ".$Company_Name;
	$crapValue = validateValues($crap);
	$_SESSION['crapValue'] = $crapValue;
	if($crapValue=='Put')
	{
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
		
		if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
		{	
			$getdetails="select hdfcccid From hdfccc_leads Where (hdfccc_mobile='".$Phone."' and hdfccc_mobile not in ('9811555306','9971396361','9811215138','9999047207') and hdfccc_date between '".$days30datetime."' and '".$currentdatetime."') order by hdfcccid DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
				
			if($alreadyExist>0)
			{
			}
			else
			{
				$Dated = ExactServerdate();
				$data = array('hdfccc_name'=>$Full_Name, 'hdfccc_email'=>$Email, 'hdfccc_mobile'=>$Phone, 'hdfccc_city'=>$strcity, 'hdfccc_occupation'=>$Employment_Status, 'hdfccc_dob'=>$DOB, 'hdfccc_income'=>$Net_Salary, 'hdfccc_salary_account'=>$Salary_Account, 'hdfccc_company_name'=>$Company_Name, 'hdfccc_comp_cat'=>$Company_HDFC_Cat, 'hdfccc_ccholder'=>$CC_Holder, 'hdfccc_source'=>$source, 'hdfccc_bank_name'=>$No_of_Banks, 'hdfccc_date'=>$Dated );
				$ProductValue = Maininsertfunc ('hdfccc_leads', $data);
			}
		
			}
			
			
			
			
			$_SESSION['Temp_LID'] = $ProductValue;
			
			
		}
	
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you Credit Card</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>

</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->
<div style="margin:auto; width:970px; height:5px; background-color:#88a943; margin-top:1px;"></div>
<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;" align="center">
  <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Credit Card through Deal4loans.com. </h1>

</div>
<div style="clear:both; height:15px;"></div>
<?php include "footer1.php"; ?>
</body>
</html>
