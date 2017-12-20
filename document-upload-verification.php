<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

$Dated=ExactServerdate();
$reqid = $_REQUEST['reqid'];
$status = $_REQUEST['status'];
$requestID = base64_decode($reqid);
$ProcessingStatus = base64_decode($status);

$slct="SELECT * FROM Req_Credit_Card WHERE RequestID='".$requestID."'";
list($Getnum,$row)=Mainselectfunc($slct,$array = array());
$Name = $row['Name'];
$Mobile = $row['Mobile_Number'];

/* Code to deactivate Link After 24 hours Start*/
//Get punch date
$getPunchDetailSql = "SELECT substring_index(substring_index(request_xml, '<Mobile>', -1), '</Mobile>', 1) as Mobile, first_dated FROM sbi_credit_card_5633 WHERE RequestID ='".$requestID."' AND ProcessingStatus=1 AND StatusCode IN (170,120) HAVING Mobile='".$Mobile."'";
list($numRows,$getPunchDetails)=Mainselectfunc($getPunchDetailSql,$array = array());
$first_dated = $getPunchDetails['first_dated'];

//Get time difference in hours
$timediff = abs(strtotime($Dated) - strtotime($first_dated)) / 3600;

// Deactive Link after 24 hours
if($timediff > 24){
	echo 'The page you are looking for cannot be found .The executives will get in touch with you for further support';
	exit;
}
/* Code to deactivate Link After 24 hours Start*/


/* Create and Send OTP*/
$Reference_Code = generatePassword(5);
$SMSMessage = "Please use this code: " . $Reference_Code . "  to activate you loan request at deal4loans.com";
SendSMSforLMS($SMSMessage, $Mobile);

//Update Reference Code in DB
$OtpDataArray = array("Reference_Code"=>$Reference_Code);
$WhereOtpArray ="(RequestID='".$requestID."')";
Mainupdatefunc("Req_Credit_Card", $OtpDataArray, $WhereOtpArray);
/* Create and Send OTP*/


if(isset($_POST["submit"])) {
	
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>SBI Documents</title>
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="css/sbi-document-styles.css?<?php echo time(); ?>" type="text/css" rel="stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<style>
.d4l{}
.d4l .nav>li>a {
   position: relative;
   display: block;
  padding:0px 15px;
}
.d4l .nav>li>a:hover {
  background:none !important;
}
</style>
</head>
<body class="d4l">
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<section class="sbi-document">
	<div class="container">
		<div class="col-md-12">
			<div class="tick"><i class="fa fa-check-circle" aria-hidden="true"></i></div>
			<h1>Congrats <?php echo $Name; ?> !</h1>
			<p class="text-center font14-medium">Your application for the Instant approval has been submitted successfully.</p>
			<p class="font14-gray pd-top-55">Share the documents and get your application processed immediately.</p>
		</div>
		<div class="row">
			<div class="col-md-12">
				<p class="font14-gray pd-top-55">
					Pls validate your registered Mobile Number, enter the OTP to continue the document upload process.
				</p>
				<p class="text-center">Please validate Your Mobile Number</p>
				<form method="POST">
					<div class="otp-main-wrapper">
						<div class="col-md-3 mr-20">Put your OTP</div>
						<div class="col-md-6">
							<input class="sbi-document-input-otp otp" id="reference_code" name="reference_code" />
							<!--OTP - <?php echo $Reference_Code; ?>-->
						</div>
						<div class="col-md-3">
							<input type="button" value="Validate" class="submit-sbi mr-10" id="validate"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<div style="clear:both; height:100px;"></div>
<?php include("footer_sub_menu.php"); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$("#validate").click(function(){
		var bank_reference_code = $('#reference_code').val();
		var request_id = '<?php echo $requestID; ?>';
		if(bank_reference_code == ""){
			$(".otp").addClass("otperror");
		}
		else{
			//Validate OTP
			$.ajax({
				url: 'validate_sbi_otp.php',
				type: 'POST',
				data: {
					bank_reference_code: bank_reference_code,
					request_id: request_id,
				},
				success: function (res) {
					var obj = JSON.parse(res);
					var base_url = window.location.origin;
					if(obj.message == "Verified Successfully")
					{
						//alert('success');
						$(".otp").removeClass("otperror");
						window.location.href = base_url+'/sbi-document-page.php?reqid=<?php echo $reqid; ?>&status=<?php echo $status; ?>';
					}
					else{
						//alert('fail');
						$(".otp").addClass("otperror");
					}
				}
			});
		}
	});
});
</script>
</body>
</html>
