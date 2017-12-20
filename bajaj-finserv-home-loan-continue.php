<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//	require 'eligibleBajajfinserv.php';
//print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	$Net_Salary = $_POST['IncomeAmount'];
	$Loan_Amount = $_POST['Loan_Amount'];
	if($Net_Salary>0){} else 	{
		$Net_Salary = $_POST['IncomeAmountbt'];
		$Loan_Amount = $_POST['Loan_Amountbt'];
	}
	$City_Other = $_POST['City_Other'];
	$source = $_POST['source'];
	$Referrer=$_REQUEST['referrer'];
	$IP = getenv("REMOTE_ADDR");
	$Employment_Status = $_REQUEST["Employment_Status"];
	$Existing_Bank = $_POST['Existing_Bank'];
	$Existing_Bank_d = $_POST['Existing_Bank_d'];
	if($Existing_Bank_d =="Others")	{ } else
	{
		$Existing_Bank = $Existing_Bank_d;
	}

	$roi = $_POST['roi'];
	
	$getdetails="select RequestID From Req_Bajaj_HomenBT  Where (Mobile_Number not in (9971396361,9811215138,9811555306) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr = count($myrow)-1;
			
	if($alreadyExist>0)
	{
		$ProductValue = $myrow[$myrowcontr]["RequestID"];
		
		$_SESSION['Temp_LID'] = $ProductValue;
		$msg = "Already applied";
	}
	else
	{	
		$Dated=ExactServerdate();
		$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, 'Property_Type'=>'0', 'Property_Value'=>'0.00', 'Loan_Amount'=>$Loan_Amount, 'Descr'=>'', 'Dated'=>$Dated, 'source'=>$source, 'IP_Address'=>$IP, 'DOB'=>$DOB, 'Updated_Date'=>$Dated, 'Existing_ROI'=>$roi, 'Existing_Bank'=>$Existing_Bank);
		$strRequestID = Maininsertfunc ('Req_Bajaj_HomenBT', $dataInsert);		


	}
	if($City=="Others") {$City=$City_Other;}
	$city_arr = array('Delhi', 'Noida', 'Gurgaon', 'Gaziabad', 'Faridabad', 'Greater Noida', 'Sahibabad', 'Bangalore', 'Chandigarh', 'Jaipur', 'Jodhpur', 'Kolkata', 'Jalandar', 'Hyderabad', 'Cochin', 'Vijaywada', 'Salem', 'Coimbatore', 'Madurai', 'Vizag', 'Mysore', 'Chennai', 'Pune', 'Surat', 'Indore', 'Nagpur', 'Ahmedabad', 'Mumbai', 'Thane', 'Navi Mumbai', 'Ludhiana', 'Bhopal', 'Raipur', 'Karnal', 'Panipat', 'Yamuna Nagar');
	$bidder_id_arr = array(3394,3394,3394,3394,3394,3394,3394,3396,3454,3455,3456,3457,3458,3460,3461,3462,3463,3464,3465,3466,3467,3468,3469,3470,3471,3472,3473,3474,3474,3474,3453,3475,3476,3459,3459,3459);
	$amount_arr = array(7000000,7000000,7000000,7000000,7000000,7000000,7000000,5000000,5000000,3000000,3000000,3000000,3000000,3000000,3000000,3000000,3000000,3000000,3000000,3000000,3000000,5000000,3000000,3000000,3000000,3000000,3000000,7000000,7000000,7000000,3000000,3000000,3000000,3000000,3000000,3000000);
	$key = array_search($City, $city_arr); // $key = 2;
	if (in_array($City, $city_arr)) {
		$bid_id = $bidder_id_arr[$key];
		$eligible_amt = $amount_arr[$key];
	}
	if($bid_id>0 && $Loan_Amount>=$eligible_amt && $Employment_Status==1)
	{	
		$dataUpdate = array('Allocated'=>'1', 'BidderID'=>$bid_id);
		$wherecondition = "(RequestID='".$strRequestID."')";
		Mainupdatefunc ('Req_Bajaj_HomenBT', $dataUpdate, $wherecondition);

//		echo "<br>".$updateSql;
		$sqlSMS = "select Mobile_no from Req_Compaign Where Sms_Flag=1 and Reply_Type=2 and BidderID='".$bid_id."'";
		list($numSMS,$querySMS)=MainselectfuncNew($sqlSMS,$array = array());
		$currentdate=date('d-m-Y');
		for($j=0;$j<$numSMS;$j++)
		{
			$bidderNumber = $querySMS[$j]['Mobile_no'];
	//		echo "<br>Bidder IS".$bid_id;
		//	echo "<br>Bidder Number".$bidderNumber;
			 if(strlen(trim($bidderNumber)) > 0)
               {
					$bidderNumber = 9971396361;
					$message ="Your Home loan Leads on (".$currentdate.") : ";
                    $SMSMessage=$SMSMessage."(1) ".$Name."".$Phone.", sal ".$Net_Salary.", loan amt- ".$Loan_Amount.", Exclusive";
                    SendSMSforLMS($message.$SMSMessage, $bidderNumber);  
               }
		}		
	}

}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bajaj Finserv Home Loan </title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="bajaj-finserv-home-loan-new-lp-styles.css" type="text/css" rel="stylesheet" />
<link type="text/css" rel="stylesheet" href="easy-responsive-tabs.css" />
<script src="jquery-1.6.3.min.js"></script>
<script src="easyResponsiveTabs.js" type="text/javascript"></script>
<style type="text/css">
.demo {width: 980px;margin: 0px auto;}
.demo h1 {margin:33px 0 25px;}
.demo h3 {margin: 10px 0;}
pre{background:#fff;}
@media only screen and (max-width: 780px) {.demo{margin:5%;width: 90%;}
.how-use{float:left;width:300px;display:none;}}
#tabInfo{display:none;}
    </style>
</head>
<body>
<div class="header">
<div class="headerinn">
<div class="logo"><img src="images/bajaj-finserv-new-logo.jpg" width="162" height="43"></div>
<div style="clear:both;"></div>
</div>
</div>
<div class="secondcontainer-fins">
<div class="leftpanel">
<div class="heading-text-fins" style="font-size:20px;">Thank You for applying 
We will call back shortly</div>
 
</div>
<div class="right-panel-bajaj body_text">
<div class="features-text">Features and Benefits</div>
  <p>1)<span class="features-subtext"> Part Prepayment facility</span><br>
   <div style="margin-left:20px;">You can prepay any amount per prepay transaction being not less than 3 EMIs. There is no limit on the maximum amount. This is subject to you clearing your first EMI<br>
    <br></div>
  </p>
  <p>2) <span class="features-subtext">Nil Foreclosure charges</span><br>
   <div style="margin-left:20px;">Now you can choose to foreclose your loan anytime during your loan tenor without paying any foreclosure charges after clearance of first EMI<br></div>
    <br>
</p>
  <p>3)<span class="features-subtext"> Online Account Access</span><br>
    <div style="margin-left:20px;">Get all information about your loan like repayment track, interest certificate, payment schedule etc through our customer portal (Experia) <br></div>
  </p>
</div>
<div style="clear:both; height:5px;"></div>
<div class="discailer-text" style="width:90%; margin-left:5px;"><strong><em>Disclaimer</em></strong><br/>‘Finance at the sole discretion of Bajaj Finance Limited’  </div>
<div class="powered-by" style="margin-top:10px;">Powered by : <span style="color:#0a8bd9;">Deal4loans.com</span></div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', 
            width: 'auto',
            fit: true, 
            closed: 'accordion', 
            activate: function(event) {
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);

                $name.text($tab.text());

                $info.show();
            }
        });

        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });
</script>
</body>
</html>
