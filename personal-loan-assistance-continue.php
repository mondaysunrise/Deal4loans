<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

//print_r($_SESSION);
function DetermineAgeFromDOB ($YYYYMMDD_In) {  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;  if ($mdiff < 0)   {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;     }  }  return $ydiff; }


$HLRequestID = $_SESSION['ProductValueHL'];

	$sql = "select * from Req_Loan_Home where RequestID='".$HLRequestID."'";
list($num,$query)=MainselectfuncNew($sql,$array = array());
	
	$Name = $query[0]['Name'];
	$Mobile_Number = $query[0]['Mobile_Number'];
	$Phone = $query[0]['Mobile_Number'];
	$DOB =  $query[0]['DOB'];
	$Email = $query[0]['Email'];
	$City =  $query[0]['City'];
	$Other_City =  $query[0]['City_Other'];
	$Employment_Status  = $query[0]['Employment_Status'];
	$Net_Salary = $query[0]['Net_Salary'];
	$IP = $query[0]['IP_Address'];
	$Pincode = $query[0]['Pincode'];
	$source = "margin money";
	$Company_Name = $query[0]['Company_Name'];
	
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9911940202,9891118553,9999570210) and Mobile_Number='".$Mobile_Number."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr = count($myrow)-1;
	$checkNum = $alreadyExist;

			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];

		$_SESSION['Temp_LID'] = $ProductValue;
		echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";

	}
	else
	{
		$Dated=ExactServerdate();
		$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$source, 'CC_Bank'=>$From_Pro, 'Card_Vintage'=>$Card_Vintage, 'Referrer'=>$REFERER_URL, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance, 'Reference_Code'=>$Reference_Code, 'Direct_Allocation'=>$Direct_Allocation, 'IsProcessed'=>$IsProcessed, 'Edelweiss_Compaign'=>$edelweiss, 'Cpp_Compaign'=>$cpp_card_protect, 'Annual_Turnover'=>$Annual_Turnover);
		$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
	}
	//echo $InsertProductSql;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply for Personal Loan | Online Personal Loan Apply India |Deal4Loans India</title>
<meta name="keywords" content="Apply Personal Loans, personal loans apply, online personal loan apply, apply personal loan india">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans banks like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad.">

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
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
</head>
<body>
<?php include "top-menu.php"; ?>
<?php include "main-menu.php"; ?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="personal-loans.php"  class="text12" style="color:#0080d6;"><u>Personal loans</u></a><span class="text12" style="color:#4c4c4c;"><u> </u>> Personal Loan </span></div>
<div class="intrl_txt" style="margin:auto;">

<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;">
  <div style="padding-top:8px; ">
<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; text-align:center;"> Thanks for applying Personal Loan through Deal4loans.com. You will soon receive a call from us to negotiate better.</h1>

<p style="height:200px;">
</p>
  </div>
 
</div>
</div>
<?php include "footer_pl.php"; ?>
</body>
</html>