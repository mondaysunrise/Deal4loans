<?php  require 'scripts/db_init.php';
	require 'scripts/functions.php';
//print_r($_POST);
//exit();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		$Name = $_POST['Name2'];
		$Phone= $_POST['Phone2'];
		$source = $_POST['source2'];
		$IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
		
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9891118553,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());
	if($alreadyExist>0)
	{
		$ProductValue=$myrow['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
	/*	echo "<script language=javascript>"." location.href='update-personal-loan-lead.php'"."</script>";*/
		$message = "Thanks you for sharing your mobile number with us. <br>You are already registered with us.	";
	}
	else
	{
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Employment_Status'=>'1', 'City'=>'', 'City_Other'=>'', 'Mobile_Number'=>$Phone, 'Dated'=>$Dated, 'source'=>$source, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Net_Salary'=>'360000');
		$ProductValue = Maininsertfunc ("Req_Loan_Personal", $dataInsert);
		$message = "Thanks you for sharing your mobile number with us. <br>Our representative will get back to you shortly.	";
	}		
		}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/apply-personal-loans-lp-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link rel="stylesheet" href="css/pl_apply-tab_styles.css">
<title>www.deal4loans.com</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js'></script>
<script src="organictabs.jquery.js"></script>
<script>
	$(function(){
	// Calling the plugin
		$("#example-one").organicTabs();
		$("#example-two").organicTabs({
			"speed": 100,
			"param": "tab"
		});		
	});
</script>
</head>
<body>
<div class="apl_top_wrapper">
<div class="apl_logo_container"><div class="logo_box_b"><img src="d4limages/aplp_d4l-logo.jpg"  height="44" /></div>
<div class="logo_text">Personal Loans by Choice not by Chance!</div>
</div>
</div>
<div class="apl_second_container" style="padding-top:3px;">
 <div class="column_wrapper">
  <div class="column_b" >
  <div class="personal_loan" >Personal Loan Request</div>
  <div id="example-two">		
		<div class="body_apl_text" style="height:150px;">
		<?php echo $message; ?>
	  </div> <!-- END List Wrap -->	
	</div>
   </div> 
 <div style="clear:both;"></div>
  <div class="step" style="margin-top:10px;">
  <img src="d4limages/step-banner.gif" width="252" height="105"></div>
   <div class="rewards" style="margin-top:10px;"><img src="d4limages/welcome-rewards.gif" width="255" height="103"></div>   
   </div>
   <div class="column_a">
  <div class="banks_text"> List of top Personal Loans Banks in India</div>
 <div class="apl_radius">
 <div class="bank_text">
 <ul><li style="color:#083b65;">
 ICICI Bank</li>
 <li style=" color:#041d6f;">
 HDFC Bank</li>
 <li style=" color:#00003d;">
 ING Vysya</li>
 <li style="color:#ed1c24;">
 Kotak</li>
   <li style="color:#cd5a13;">
 Fullerton </li>
    <li style="color:#0076bc;">
 Bajaj Finserv </li>
   <li style="color:#0076bc; line-height:none; border:none; text-align:center;">SBI</li>
 </ul>
 </div>
 </div>
 <div class="row_a"><span class="text_head">Personal Loan for all your Financial needs</span>
   <br>
  <span class="text_b">"Get you Loans at Lowest Rates" Apply to</span> 
 	<br>
<span style=" color:#000;" class="text_head_2"> Compare n Choose</span>
 <br>
<span class="text_head_3"> the Best offers from multiple Banks</span> </span></div>
 <div class="table_bg">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td width="93%" valign="middle" class="text_white"  style="height:28px; background:url(d4limages/aplp_arrow_.jpg) no-repeat;">Sample Personal Loan Quotes</td>
       <td width="7%" align="left" style="height:28px;">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:thin solid #FFF;">
         <tr>
           <td width="15%" height="25" align="center" class="text_white_b" style="border-right: #FFF thin solid;">Bank </td>
           <td width="21%" align="center" class="text_white_b" style="border-right:thin solid #FFF;">Interest Rate</td>
           <td width="24%" align="center" class="text_white_b" style="border-right:thin solid #FFF;">Eligible Loan Amt.</td>
           <td width="19%" align="center" class="text_white_b" style="border-right:thin solid #FFF;">EMI</td>
           <td width="21%" align="center" class="text_white_b">Pre-Payment</td>
         </tr>
       </table></td>
     </tr>
     <tr>
       <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
         <tr>
           <td width="15%" align="center" bgcolor="#FFFFFF" class="text_white_c">Bank A<br>
             Bank B<br>
             Bank C<br>
             Bank D</td>
           <td width="19%" align="center" bgcolor="#FFFFFF" class="text_white_c">14%<br>
             14.25%<br>
             15%<br>
             16%</td>
           <td width="26%" align="center" bgcolor="#FFFFFF" class="text_white_c">Rs. 1,00,000<br>
             Rs. 1,25,000<br>
             Rs. 1,80,000<br>
             Rs. 1,50,000</td>
           <td width="19%" align="center" bgcolor="#FFFFFF" class="text_white_c">Rs. 2,733<br>
             Rs. 3,432<br>
             Rs. 5,010<br>
             Rs. 4,251</td>
           <td width="21%" align="center" bgcolor="#FFFFFF" class="text_white_c">4%<br>
             Nil<br>
             Nil<br>
             4%</td>
         </tr>
         </table></td>
     </tr>
   </table>
   <div style="clear:both;"></div>
   <div class="row_b"><span class="text_white_b" style="font-size:12px;"><strong>Personal Loan</strong> quotes taken this month from <strong>Deal4loans</strong></span>
     <div class="count_wrap"><table width="100" border="0" cellpadding="0" cellspacing="2">
  <tr>
    <td bgcolor="#FFFFFF" class="text_d">5</td>
    <td bgcolor="#FFFFFF" class="text_d">9</td>
    <td bgcolor="#FFFFFF" class="text_d">9</td>
    <td bgcolor="#FFFFFF" class="text_d">0</td>
    <td bgcolor="#FFFFFF" class="text_d">5</td>
  </tr>
</table>
</div>
<div style="clear:both;"></div>
<div class="row_b" style="margin-top:5px;"><span class="text_white_b" style="font-size:12px;">Loans quotes taken from <strong>Deal4loans </strong></span>
  <div class="count_wrap_b"><table width="130" border="0" align="right" cellpadding="0" cellspacing="2">
  <?php 
$total_amtcntr="select Amount From totalLoans Where (Name='Totalcountr' and flag=1)";
//$ttl_countrtaken = mysql_result($total_amtcntr,0,'Amount');
 list($CheckNumRows,$ttl_countrtaken)=Mainselectfunc($total_amtcntr,$array = array());
 ?>
  <tr>
<? 
$number=$ttl_countrtaken;
$revarrnumber=str_split($number);
$contstr=count($revarrnumber);
for($i=0; $i<$contstr; $i++)
{ ?>
<td bgcolor="#FFFFFF" class="text_d"><? echo $revarrnumber[$i]; ?></td>
<? } ?>
  </tr>
</table>
</div>
</div>
<div style="clear:both;"></div>
</div>      
 </div> 
 <div class="why_text_box">
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
       <td class="text_head" style="font-size:20px;">Why Deal4loans.com - Widest Choice of Banks</td>
     </tr>
     <tr>
       <td class="body_apl_text"><ul>
         <li><strong style="color:#454646;">Get free instant quote</strong> on Rates, Emi, Eligibility, <span style="font-size:17px; font-weight:bold;">Fees</span> &amp; Documents from all Banks.</li>
         <li>Pick best Bank as per your requirement.</li>
         </ul></td>
     </tr>
   </table>
 </div> 
  </div>
  <div style="clear:both;"></div>  
</div>

<? if($source=="lowestrateLP_22jan16")
	{ ?>
		<!-- Google Code for display Conversion Page -->
		<script type="text/javascript">
		/* <![CDATA[ */
		var google_conversion_id = 1066264455;
		var google_conversion_language = "en";
		var google_conversion_format = "3";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "9xm0CNvGsGMQh8-3_AM";
		var google_remarketing_only = false;
		/* ]]> */
		</script>
		<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
		</script>
		<noscript>
		<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1066264455/?label=9xm0CNvGsGMQh8-3_AM&amp;guid=ON&amp;script=0"/>
		</div>
		</noscript>
	<? }
	?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script></body>
</html>