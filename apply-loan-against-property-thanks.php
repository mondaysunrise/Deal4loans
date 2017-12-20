<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/lap_eligibility_func.php';
	require 'show_quotecount.php';

$R_URL="Contents_Loan_Against_Property_Mustread.php";
$ProductValue = $_SESSION['ProductValue'];

//$ProductValue = $_REQUEST['ProductValue'];

$City = $_SESSION['Temp_City'];
$Reference_Code = $_REQUEST["Reference_Code"];

$activation_code = $_REQUEST["activation_code"];
if($Reference_Code == $activation_code)
{
	$Is_Valid=1;
}
else
{
	$Is_Valid=0;
}

		$DataArray = array("Is_Valid"=>$Is_Valid);
		$wherecondition ="( RequestID=".$ProductValue.")";
		Mainupdatefunc ('Req_Loan_Against_Property', $DataArray, $wherecondition);
	list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("Req_Loan_Against_Property",$ProductValue,$strCity);
	$Final_Bid = "";
	while (list ($key,$val) = @each($bankID)) { 
		$Final_Bid[]= $val; 
	} 
	$FinalBidder=implode(',',$FinalBidder);
	$realbankiD=implode(',',$realbankiD);	

$lapquery="select Employment_Status,source,Loan_Amount,DOB,Property_Value,City,City_Other,Net_Salary from Req_Loan_Against_Property Where (RequestID=".$ProductValue.")";

list($Getnum,$row)=Mainselectfunc($lapquery,$array = array());

$Net_Salary = $row["Net_Salary"];
$monthysalary = $Net_Salary/12;
$Loan_Amount = $row["Loan_Amount"];
$DOB = $row["DOB"];
$Property_Value = $row["Property_Value"];
$mCity = $row["City"];
$City_Other = $row["City_Other"];
$Employment_Status = $row["Employment_Status"];
$source = $row["source"];
$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);

if($mCity=="Others" && strlen($City_Other)>0)
{
	$City = $City_Other;
}
else
{
	$City = $mCity;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<title>Apply and Compare Loans Against Property India</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="Apply Loans Against Property online. Know the schemes from all loans against property providing banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi, Pune etc. Compare Documents, EMI, Interest rates and Fees.">
<meta name="keywords" content="Loan Against Property India, Apply Loan Against Property, Compare Loan Against Property in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mootools.js"></script>
<style type="text/css">
.fontbld10 {
font-size:10px;
font-weight:bold;
line-height:14px;
color:#000000;
}
</style>

</head>
<body>
<?php include "middle-menu.php"; ?>
<div style="clear:both; height:70px;"></div>
<div class="lac-main-wrapper">
<div class="text12" style="margin:auto; color:#000000;">
<table cellpadding="0" cellspacing="0" width="100%">
     <tr>
     <td align="center" valign="middle"  style="font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	font-weight:bold; color:#000000;"><strong>Dear, You are <? echo $total_homeloan_taken; ?> th customer , who have taken quote @deal4loans.com</strong><br />Thanks for applying for Loan Against Property. We will contact you shortly.</td>
      </tr>
	  
	 <?php
	 if(count($FinalBidder)>0 && (strlen($Final_Bid[0])>1))
	 {	?>
	 <tr>
     <td align="center" height="200" valign="middle"  style="font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	font-weight:bold;">
     <div class="overflow-width">
   <table width="100%"  border="0" cellspacing="2" cellpadding="0" bgcolor="#d1ebfd"> 
     <tr><td width="310" align="center"  height="35" class="fontbld10" bgcolor="#d1ebfd">Bank</td><td bgcolor="#d1ebfd" align="center">Loan Amount</td><td bgcolor="#d1ebfd" align="center">Interest Rate</td><td bgcolor="#d1ebfd" align="center">EMI</td><td bgcolor="#d1ebfd" align="center">Tenure</td><td bgcolor="#d1ebfd" align="center">Proc Fee</td><td bgcolor="#d1ebfd">&nbsp;</td></tr>
	 
	<?	for($i=0;$i<count($Final_Bid);$i++)
		{

	 ?>
         
<!--//add Bank alogos-->
<?
	if(($Final_Bid[$i]=="HDFC Bank") || ($Final_Bid[$i]=="HDFC"))
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-hdfc.jpg" />';
	}
else if((strncmp ("Fullerton", $Final_Bid[$i],9))==0 || ($Final_Bid[$i]=="Fullerton"))
		{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-fulrtn.jpg" />';
	}
	else if($Final_Bid[$i]=="Kotak")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-ktk.gif"  />';
	}
	else if($Final_Bid[$i]=="Citibank")
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-citibnk.jpg" />';	
	}
	else if($Final_Bid[$i]=="Barclays Finance" || (strncmp ("Barclays", $Final_Bid[$i],8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-barclays.jpg"/>';	
	}
	else if($Final_Bid[$i]=="Standard Chartered" || (strncmp ("Standard", $Final_Bid[$i],8))==0)
	{
	$imagebank='<img src="http://www.deal4loans.com/new-images/thnk-stanc.jpg"/>';	
	}
	else if($Final_Bid[$i]=="HDBFS")
	{
		$imagebank='<img src="http://www.deal4loans.com/new-images/hdbfs-logo1.jpg"/>';
	}
	else if($Final_Bid[$i]=="IngVysya")
	{
		$imagebank='<img src="http://www.deal4loans.com/new-images/ing-logo1.jpg" />';
	}
	else if($Final_Bid[$i]=="RBL Bank" || $Final_Bid[$i]=="RBL")
	{
		$imagebank='<img src="http://www.deal4loans.com/new-images/rblbnk_bl.jpg" />';
	}
	elseif($Final_Bid[$i]=="Capital First" || $Final_Bid[$i]=="Capital First")
			{
				$imagebank='<img src="http://www.deal4loans.com/new-images/capital-first-logo-pl.png" />';
			}
	else
		{
		$imagebank='';
		}	
////////RBL
	 if($Final_Bid[$i]=="RBL Bank" || $Final_Bid[$i]=="RBL")
		 {			
		 list($viewLoanAmt,$getemicalc,$print_term,$interestrate)= RBLbank($monthysalary,$age,$Property_Value);
 ?>
	<tr align="center">
	 <td width="310" height="55" valign="middle" bgcolor="#FFFFFF" style="color:#000000;" >&nbsp;&nbsp;<img src="images/rblbnk_bl.jpg" width="90" height="27" border="0" /></td>
     <td bgcolor="#FFFFFF" class="fontbld10" style="font-size:14px;" align="center"><? echo "Rs.".$viewLoanAmt; ?></td>
			<td bgcolor="#FFFFFF" class="fontbld10" style="font-size:14px;" align="center">12.50%</td>
            <td bgcolor="#FFFFFF" class="fontbld10" style="font-size:14px;" align="center"><? echo "Rs.".$getemicalc; ?></td>
            <td bgcolor="#FFFFFF" class="fontbld10" style="font-size:14px;" align="center"><? echo $print_term."yrs"; ?></td>
			<td bgcolor="#FFFFFF" class="fontbld10" style="font-size:14px;" align="center"><? echo "1%"; ?></td>
            <td bgcolor="#FFFFFF" class="fontbld10" style="font-size:14px;" align="center">
			<form action="/apply_lap_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="lap_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="lap_bank_name" id="lap_bank_name" value="RBL Bank">
			<input type="image" name="Submit" src="images/home-loan-apply-new-btn-new.png" style="width:98px; height:39px; border:none;" />
	 </form></td>            
            </tr>      
			<? 
		 }
		 else
			{
/////////////////RBL end
	?>
	<tr align="center">
             <td width="310" height="55" valign="middle" bgcolor="#FFFFFF" style="color:#000000;" >&nbsp;&nbsp;<? echo  $imagebank; ?><br />
<? echo $Final_Bid[$i];?></td>
			<td bgcolor="#FFFFFF" class="fontbld10" style="font-size:14px;" align="center" colspan="5">Get Quote on Call</td>
            <td bgcolor="#FFFFFF" class="fontbld10" style="font-size:14px;" align="center"><form action="/apply_lap_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="lap_requestid" value="<? echo $ProductValue; ?>" id="pl_requestid">
		    <input type="hidden" name="lap_bank_name" id="lap_bank_name" value="<? echo $Final_Bid[$i];?>">
			<input type="image" name="Submit" src="images/home-loan-apply-new-btn-new.png" style="width:98px; height:39px; border:none;" />
	 </form></td>            
            </tr>     	
     <?php
	 	}
		}
	}
	else
	{
		$lapselres="select Email,Name from Req_Loan_Against_Property Where (RequestID=".$ProductValue.")";
		list($Getnum,$laprow)=Mainselectfunc($lapselres,$array = array());
		
			//echo "select Email,Name from Req_Loan_Against_Property Where (RequestID=".$ProductValue.")";
			//$laprow=mysql_fetch_array($lapselres);	
			
			if(strlen($laprow['Email'])>0)
			{
			$Email =$laprow['Email'];
			$name=$laprow['Name'];
			$Message="<table width='700' border='0' align='center' cellpadding='0' cellspacing='0' style='border:1px ridge #0099FF;'><tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='40%' valign='top'> <tr>    <td><table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr>     <td width='40%' valign='top'></td>        <td width='60%' align='right' style='padding-top:5px;'><img src='http://www.deal4loans.com/images/cc/crdt-crd-logo.gif'  /><br />          <span style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size: 10px;	color:#0A71D9;'>Loans by Choice not by Chance!</span></td>      </tr>    </table></td>  </tr></table></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#333333; padding-top:20px; padding-left:10px; padding-right:10px;'><b>Dear $name,</b><p>As per your profile, no bank is associated with us to serve your <b>Loan Against Property</b> requirement. We will not be able to service your request and hence we are not sharing your details with any bank.</p><p>&nbsp; <br />
  Regards</p>
Team Deal4loans.com <br /><br /></td></tr><tr><td style=' font-family:Verdana; font-size:12px; color:#ffffff;  padding-left:10px; padding-right:10px; background-color:#248ACA; border-top:1px solid  #0099CC;'><table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td align='center' valign='middle'><a href='http://www.deal4loans.com/Contents_Blogs.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Blogs</a> </td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/quiz.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Loan Quiz</a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.com/debt-consolidation-plans.php?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Loan Guru </a></td><td align='center' valign='middle'> <a href='http://www.deal4loans.in?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Deal4loans.in </a></td><td height='25' align='center' valign='middle'> <a href='http://www.bimadeals.com?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Bimadeals.com </a></td><td align='center' valign='middle'> <a href='http://www.askamitoj.com?source=d4l-noteligi' style=' font-family:Verdana; font-size:12px; color:#ffffff;'>Askamitoj.com</a> </td></tr></table></td></tr></table>
";
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= "Bcc: testing4use@gmail.com"."\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
mail($Email,'Thanks for Registering for Loan Against Property on deal4loans.com', $Message, $headers);
			}
	}	
	 ?>	
     </table>
     </div>
     </td>
      </tr>
    </table>
	
	</div>
     <div style="clear:both; height:15px;"></div>
     <table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" bgcolor="#e6edfd">
<tr>
<td width="196" rowspan="2" align="center" style="color:#000000; font-size:18px; border-right:1px #FFFFFF solid;">Connect With Us</td>
<td width="208" height="30" align="center" style=" color:#000000; font-size:14px; border-right:1px #FFFFFF solid;"><b>Facebook</b></td>
<td width="169" align="center" style="color:#000000; font-size:14px; border-right:1px #FFFFFF solid;"><b>Google +</b></td>
<td width="117" align="center" style="color:#000000; font-size:14px; border-right:1px #FFFFFF solid;"><b>Twitter</b></td></tr>
<tr><td height="40" style="padding-left:20px; color:#000000; border-right:1px #FFFFFF solid;"><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fdeal4loans&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=false&amp;font=tahoma&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></td>
<td align="center" style="padding-left:20px; color:#000000; border-right:1px #FFFFFF solid;"><!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-size="medium" data-href="https://plus.google.com/117667049594254872720"></div>
</td>
<td align="center" height="40" style="padding-left:20px; border-right:1px #FFFFFF solid;"><a href="https://twitter.com/deal4loans" class="twitter-follow-button" data-show-count="false">Follow @deal4loans</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></td></tr></table>
<!-- Place this tag where you want the +1 button to render. -->
<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>
<? 
function DetermineAgeGETDOB ($YYYYMMDD_In)
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
?>
