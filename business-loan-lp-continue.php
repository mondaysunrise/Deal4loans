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
		$City2 = $_POST['City2'];
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
	/*	echo "<script language=javascript>"." location.href='update-Business-loan-lead.php'"."</script>";*/
		$message = "Thanks you for sharing your mobile number with us. <br>You are already registered with us.	";
	}
	else
	{
		$Dated = ExactServerdate();
		$dataInsert = array('Name'=>$Name, 'Employment_Status'=>'0', 'City'=>$City2, 'City_Other'=>'', 'Mobile_Number'=>$Phone, 'Dated'=>$Dated, 'source'=>$source, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Net_Salary'=>'400000');
		$ProductValue = Maininsertfunc ("Req_Loan_Personal", $dataInsert);
		$message = "Thanks you for sharing your mobile number with us. <br>Our representative will get back to you shortly.	";
	}		
		}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/apply-Business-loans-lp-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<link rel="stylesheet" href="css/pl_apply-tab_styles.css">
<title>www.deal4loans.com</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>
<body>
<div class="apl_top_wrapper">
<div class="apl_logo_container"><div class="logo_box_b"><img src="d4limages/aplp_d4l-logo.jpg"  height="44" /></div>
<div class="logo_text">Business Loans by Choice not by Chance!</div>
</div>
</div>
<div class="apl_second_container" style="padding-top:3px;">
 <div class="column_wrapper">
  <div class="column_b" >
  <div class="Business_loan" >Business Loan Request</div><br><br>
  <div >		
		<div class="body_apl_text" style="height:150px;">
		<?php echo $message; ?>
	  </div> <!-- END List Wrap -->	
	</div>
   </div> 
 <div style="clear:both;"></div>
   <div class="column_a">
   <h5>Best Business Loan Banks - <strong>ICICI Bank, Hdfc Bank, Fullerton India, RBL, Religare</strong> </h5>

 
 <div class="row_a">
   <br>
  <span class="text_b">"Get you Loans at Lowest Rates" Apply to</span> 
 	<br>
<span style=" color:#000;" class="text_head_2"> Compare n Choose</span>
 <br>
<span class="text_head_3"> the Best offers from multiple Banks</span> </span></div>

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