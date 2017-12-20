 <?php  
 require 'scripts/db_init.php';
	require 'scripts/functions.php';
//print_r($_POST);
//exit();
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		 $Name = FixString($_POST['Name2']);
		 $Phone= FixString($_POST['Phone2']);
		$source = FixString($_POST['source2']);
		$Age = "25";
	if(strlen($Age)>0)
		{
			$date=date('m-d');
			$year = date('Y')-$Age;
			$DOB = $year."-".$date;
		}
		$IP_Remote = getenv("REMOTE_ADDR");
	if($IP_Remote=='192.99.32.74') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
	else { $IP=$IP_Remote;	}
		
if((strlen($Name)>0) && strlen($Phone)>2)
	{
	
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Credit_Card Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9891118553,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";

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
		$dataInsert = array('Name'=>$Name, 'Employment_Status'=>'1', 'City'=>'Delhi', 'City_Other'=>'', 'Mobile_Number'=>$Phone, 'Dated'=>$Dated, 'source'=>$source, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Net_Salary'=>'360000', 'DOB'=> $DOB);
		$ProductValue = Maininsertfunc ("Req_Credit_Card", $dataInsert);
		$message = "Thank you for applying  for Credit Card through deal4loans. Your application is under process. We will contact you shortly.";
		 //Send SMS
			ProductSendSMStoRegis($Phone);
	}
		
		}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Instant E Apply Credit Cards Online in India</title>
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  <link href="source.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style type="text/css">
.overflow-width{ width:100%;}
@media screen and (max-width: 768px) {
.overflow-width{ width:95%;}
}
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<!--logo navigation-->
<div class="lac-main-wrapper">
<div style="clear:both; height:70px;"></div>
<div class="text12" style="margin:auto;" >
  <h1 style="color:#000000 !important; margin:0px; padding:0px; font-size:16px !important; line-height:22px;">Dear <? echo $Name; ?>,<br /> <?php echo $message; ?></h1><br /><br />
   <div style="color:#000">
   <?php 
  
   ?>
<div style="clear:both; height:250px;"></div>
</div></div>
<div style="clear:both; height:15px;"></div>
<?php  include "footer_sub_menu.php"; ?>
</div>
</body>
</html>