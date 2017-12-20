<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'show_quotecount.php';		

$page_Name = "LandingPage_PL";
function DetermineAgeFromDOB ($YYYYMMDD_In)
{
	$yIn=substr($YYYYMMDD_In, 0, 4);
	$mIn=substr($YYYYMMDD_In, 4, 2);
	$dIn=substr($YYYYMMDD_In, 6, 2);
	$ddiff = date("d") - $dIn;
	$mdiff = date("m") - $mIn;
	$ydiff = date("Y") - $yIn;
	if ($mdiff < 0)
	{
		$ydiff--;
	}
	elseif ($mdiff==0)
	{
		if ($ddiff < 0)
		{
			$ydiff--;
		}
	}
	return $ydiff;
}

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;
	return "";
}

$ProductValue = $_REQUEST["rqid"];

if($ProductValue>0)
{
	$getccdtls="Select Pincode,DOB,Name,Mobile_Number,Email,ABMMU_flag,Net_Salary,City,City_Other,source,Reference_Code From Req_Credit_Card Where Req_Credit_Card.RequestID=".$ProductValue;
	//echo "sssssssssssssssssss<br><br>".$getccdtls;
	$resultgetccdtls=ExecQuery($getccdtls);
	$ccrow=mysql_fetch_array($resultgetccdtls);
	$full_name= $ccrow['Name'];
	$Mobile_Number= $ccrow['Mobile_Number'];
	$Email= $ccrow['Email'];
	$Net_Salary= $ccrow['Net_Salary'];
	$City= $ccrow['City'];
	$City_Other= $ccrow['City_Other'];
	$ABMMU_flag_vl = $ccrow["ABMMU_flag"];
	$DOB = $ccrow["DOB"];
	$source = $ccrow["source"];
	$Reference_Code = $ccrow["Reference_Code"];
	list($year,$mm,$dd) = split('[-]', $DOB);
	$Dobn=$dd."-".$mm."-".$year;

	if($City=="Others" && strlen($City_Other)>0)
	{
		$strcity=$City_Other;
	}
	else
	{
		$strcity=$City;
	}
	list($strFirst,$strLast) = split('[ ]', $full_name);
	if(strlen($strFirst)>25)
	{
		$shrtfname=strlen($strFirst)-25;
		$First = substr(trim($strFirst), 0, strlen(trim($strFirst))-$shrtfname);
	}
	else
	{
		$First =$strFirst;
	}
	if(strlen($strLast)>25)
	{
		$shrtlname=strlen($strLast)-25;
		$Last = substr(trim($strLast), 0, strlen(trim($strLast))-$shrtlname);
	}
	else
	{
		$Last =$strLast;
	}

	if($City=="Chandigarh")
	{	$cityid=1 ; }
	if($City=="Gurgaon")
	{ $cityid=3; }
	if($City=="Ahmedabad")
	{ $cityid=8; }
	if($City=="Bangalore")
	{ $cityid=12; }
	if($City=="Chennai")
	{ $cityid=13;} 
	if($City=="Hyderabad" || $City=="Secunderabad")
	{ $cityid=14; }
	if($City=="Mumbai" ||$City=="Navi Mumbai" || $City=="Thane")
	{ $cityid=15; }
	if($City=="Pune")
	{ $cityid=16; } 
	if($City=="Coimbatore")
	{ $cityid=34; }
	if($City=="Jaipur")
	{ $cityid=49; }
	if($City=="Kolkata")
	{ $cityid=58; }
	if($City=="Noida" || $City=="Greater Noida")
	{ $cityid=71; }
	if($City=="Surat")
	{ $cityid=91; }
	if($City=="Delhi")
	{ $cityid=157; }
	if($City=="Baroda")
	{ $cityid=351; }
			
		
	//Send OTP Code to Customer Mobile Number
	//$otp = rand(1000,9999);
	//$InsertProductSql= array("Reference_Code"=>$otp);
	//$wherecondition ="(RequestID='".$ProductValue."')";
	//Mainupdatefunc("Req_Credit_Card", $InsertProductSql, $wherecondition);
}

if($_REQUEST['category_tag']!=""){
	$srchCategory = " and category_tag in (".$_REQUEST['category_tag'].") ";
}else{
	$srchCategory = '';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Instant E Apply Credit Cards Online in India</title>
<meta name="viewport" content="width=device-width, initial-scale=1" /> 
<link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css' />  <link href="source.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link rel="stylesheet" href="css/jquery.popdown.css" />
<style type="text/css">
.overflow-width{ width:100%;}
.main-box-otp{ border:1px gray solid; padding:10px; }
.main-box-otp p{ padding-top:0px; margin-top:0px;
}
.otp-box{float: left;
    margin-right: 10px;
    width: 311px; color:#000;}
.validate-btn{ background:#0c4669;  border:none; padding:4px; font-weight:bold; color:#FFF;}
@media screen and (max-width: 768px) {
.overflow-width{ width:95%;}
}
</style>
<script language="javascript">

function Decorate(strPlan)
{
       if (document.getElementById('plantype2') != undefined)  
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='Beige';  
       }

       return true;
}

function Decorate1(strPlan)
{
       if (document.getElementById('plantype2') != undefined) 
       {
               document.getElementById('plantype2').innerHTML = strPlan;
			   document.getElementById('plantype2').style.background='';  
       }

       return true;
}

var ajaxRequestMain;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequestMain = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
		function insertData(id)
		{
			//alert(id);
			var crd_nme = document.getElementById('crd_nme_'+ id).value;
			var prdct_id = document.getElementById('prdct_id').value;
			var queryString = "?crd_nme=" + crd_nme +"&prdct_id=" + prdct_id ;
				//alert(queryString); 
				ajaxRequestMain.open("GET", "insert_card_name.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequestMain.onreadystatechange = function(){
					}
				ajaxRequestMain.send(null); 
		}

	window.onload = ajaxFunctionMain;
</script>
<style>
.crd_colm {font-family:'Droid Sans', sans-serif !important; font-size:14px; color:#000000; font-weight:bold; border-right:1px solid #fe7e00; background-color:#FDD57E;
}
.crd_colm_txt {font-family:'Droid Sans', sans-serif !important; font-size:14px; color:#000000; font-weight:bold; border-right:1px solid #fe7e00;}
</style>
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body>
<?php include "middle-menu.php"; ?>
<!--logo navigation-->
<div class="lac-main-wrapper" style="border:none;">
<div style="clear:both; height:70px;"></div>
<div class="text12" style="margin:auto;" >
  <h1 style="color:#000000 !important; margin:0px; padding:0px; font-size:16px !important; line-height:22px;">Dear <? echo $full_name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who has taken quote @deal4loans.com.</h1><br /><br />
   <div style="color:#000">
  <?php 
  if($Net_Salary<200000){ echo "Oops We are sorry that we didn't  find any  offer for you  at this time .<br><br>
We will try to get in touch with you if we have offers for your desired product.<br><br>
";
  }
  ?>
  <!--<a href="javascript: history.go(-1);"><img src="images/go-back.png" alt="back-btn" height="53" width="157" border="0" /></a>-->


	<?php
	// print_r($_SESSION);
	if($Net_Salary>=144000)
	{
		//$source = 'UAT_AMEXCARDS';
	 	
		if($Net_Salary>=1000000)
		{
			$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and cc_bank_flag=1 ".$srchCategory.") order by cc_priority  ASC";
			//$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and cc_bank_flag=1) order by cc_priority  ASC";
		}
		else
		{
			$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and cc_bank_flag=1 ".$srchCategory." ) order by cc_priority  ASC";
			//$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and cc_bank_flag=1) order by cc_priority  ASC";
		}
		//echo  $selectccbanks."<br>";
	//	echo  $selectccbanks."<br>";
		if($source=="UAT_AMEXCARDS")
	 	{
			$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and cc_bank_flag=1 ".$srchCategory." ) AND cc_bankid=71 order by cc_priority  ASC";	 	
	 	}
		if($source=="UAT_YESBANK")
	 	{
			$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and cc_bank_name LIKE 'Yes%') order by cc_priority  ASC";	 	
	 	}
		//echo  $selectccbanks."<br>";
		$ccbankresult = ExecQuery($selectccbanks);
		$rowscount = mysql_num_rows($ccbankresult);
		if($rowscount>0)
		{
	?>
<!--<div style="font-size:14px; text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px; color:#000000; !important">
You are Eligible to Select from <? //echo $rowscount; ?> Credit Card Offers  !</div>-->
<div style="clear:both; height:10px;">

  <div class="text12" style="margin:auto;" >
  <div class="main-box-otp">
  <p style="color:#ff0000; font-weight:bold;" id="validateMsg"></p>
  <p style="color:#000;"><strong>Please validate Your Mobile Number</strong></p>
	<form action="#" method="POST" target="_blank">
		<div class="otp-box">
		<input type="hidden" name="request_id" id="request_id" value="<? echo $ProductValue;?>" />
		<input type="text" name="bank_reference_code" id="bank_reference_code" maxlength="5" /><br><b style="color:#000;">Put your OTP</b>
		<br> The OTP - <?php echo $Reference_Code; ?> <br>
		</div>
		<div class="otp-box">
		<input type="button" class="validate-btn" value="Validate" onclick="return validateOtpForm();"/>
		</div>
	
		<div style="clear:both;"></div>
	</form>

</div>

  </div>

<div style="clear:both; height:10px;">
<div class="overflow-width">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
    
    
	 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>      
      <td width="107" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Card Name </td>
	  	<td width="100" height="25" align="center" valign="middle" style="font-family:verdana; font-size:12px; color:#000000; font-weight:bold; " class="crd_colm">Apply </td>
		 <td width="171" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Image </td> 
      <td width="257" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Annual Fee</td>
	      
    <td width="255" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Features</td>
	<td width="70" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Interest (p.m) </td>
    </tr>
	<? 
		 }
if($rowscount >0)
{	
$r=0;
$i=1;
$strcc_bankid="";
	$sbiBankID_Array='';
	  while($row = mysql_fetch_array($ccbankresult))
    {
	
	//echo $cc_bank_name  = $row["cc_bank_name"];
       $cc_bank_query  = $row["cc_bank_query"];
	   if($source=="QuickApply")
	   {	   
	   	$cc_bank_query  = $row["other_query"];
	   }
	   
	   	$cc_bankid  = $row["cc_bankid"];
		$cc_bank_url  = $row["cc_bank_url"];
		if($_SESSION['siten']=="ndtv")
		{
			$cc_bank_url  = $row["cc_bank_url_ndtv"];
		}
		
	  $qry2 = $cc_bank_query." and Req_Credit_Card.RequestID ='".$ProductValue."'";
//$qry2 = $cc_bank_query." and Req_Credit_Card.RequestID =227258";
		// echo  "query2 ".$qry2."<br><br>";
		  $result1=ExecQuery($qry2);
        $recordcount = mysql_num_rows($result1);
		
		if($recordcount>0)
		 {
			$strcc_bankid[] = $cc_bankid;	
		 
		while($getrow = mysql_fetch_array($result1))
			 {
			//2 -4 lac 		4- 6 lac 		6 Above 

			//for UAT
			//if($source=="UAT_SCBCARDS" || $source=="UAT_AMEXCARDS" || $source=="sbitest")
			if($Net_Salary>=600000)
				 {
			$get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid=".$cc_bankid." and cc_bank_flag =1) order by cc_priority ASC";
				 }
				 elseif($Net_Salary<600000 && $Net_Salary>=400000)
				 { 
			$get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid=".$cc_bankid." and cc_bank_flag =1) order by cc_priority_4to6lac ASC";
				 }
			 elseif($Net_Salary<400000 && $Net_Salary>=200000)
				 { 
			$get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid=".$cc_bankid." and cc_bank_flag =1) order by cc_priority_2to4lac ASC";
				 }
				 else
				 {
			$get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid=".$cc_bankid." and cc_bank_flag =1) order by cc_priority ASC";
				 }
			$get_Bankresult=ExecQuery($get_Bank);
			 $getrecordcount = mysql_num_rows($get_Bankresult);
		
  for($j=0;$j<$getrecordcount;$j++)
 { 
	if($cc_bankid==12)
	{
	?>	
<? }
	  else
	  {
	  ?>
	   <input type="hidden" name="prdct_id" id="prdct_id" value="<? echo $ProductValue;?>" />
	  <tr>
           <td width="107" height="85" align="left" class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;"><? $cc_bank_name = mysql_result($get_Bankresult,$j,'cc_bank_name'); ?>
        <input type="hidden" name="crd_nme_<? echo $i; ?>" id="crd_nme_<? echo $i; ?>" value="<? echo $cc_bank_name; ?>" /> <b><? if (strlen($cc_bank_url)>0) { ?> 
		<? echo $cc_bank_name; ?><? } else 
		  { 
			echo $cc_bank_name;
		  } ?></b></td>
		    
		 <td  align="center" style="border-right:1px solid #fe7e00; color:#000000;">	
	  <? 
		 if (($cc_bankid==10 || $cc_bankid==16 || $cc_bankid==15 || $cc_bankid==28 || $cc_bankid==22 || $cc_bankid==15 || $cc_bankid==30 || $cc_bankid==35 || $cc_bankid==36 || $cc_bankid==37 || $cc_bankid==39 || $cc_bankid==40 || $cc_bankid==41))
		  { ?>
			<form action="apply-hdfc-credit-card1.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
		    <input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>" />
			<input type="submit" style="width:84px; height:38px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
			    </form>
		  <? }
		else if ($cc_bankid==20)
		  { ?>
			<form action="dcb_payless_credit_card.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid" />
		    <input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>" />
			<input type="submit" style="width:84px; height:38px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
			    </form>
		  <? }
		  else if ($cc_bankid==23 || $cc_bankid==24 || $cc_bankid==25 || $cc_bankid==26 || $cc_bankid==27 || $cc_bankid==29 || $cc_bankid==69 || $cc_bankid==70)//23,69,24,26,25,27,29,70
		  { ?>
			<form action="icici-credit-card-continue.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid" />
		    <input type="hidden" name="cityval" id="cityval" value="<? echo $City;?>" />
			 <input type="hidden" name="crd_nme" id="crd_nme" value="<? echo $cc_bank_name; ?>" />
			<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>" />
			<input type="submit" style="width:84px; height:38px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
			    </form>
		  <? }
		  else if($cc_bankid==42 || $cc_bankid==43 || $cc_bankid==44)//42,43,44
		  { ?>
			<form action="rbl-credit-card-continue.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid" />
		    <input type="hidden" name="cityval" id="cityval" value="<? echo $City;?>">
			 <input type="hidden" name="crd_nme" id="crd_nme" value="<? echo $cc_bank_name; ?>" />
			<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>" />
			<input type="submit" style="width:84px; height:38px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
			    </form>
		  <? }
		    else if(($cc_bankid==4 || $cc_bankid==18 || $cc_bankid==45 || $cc_bankid==63))
				{  ?>
					<form action="citibank-credit-card-continue.php" method="POST" target="_blank" >
					 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid" />
					<input type="hidden" name="cc_name" id="cc_name" value="<? echo $cc_bank_name;?>" />
					<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>" />
					<input type="submit" style="width:84px; height:38px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
						</form>
				<? 	
				}
			else
		  {
		  
				if($cc_bankid==52 || $cc_bankid==53 || $cc_bankid==54 || $cc_bankid==59 || $cc_bankid==60 || $cc_bankid==61 || $cc_bankid==62 || $cc_bankid==64 || $cc_bankid==65 || $cc_bankid==66)
				{ 
					$sbiBankID_Array[]=$cc_bankid;
			?>
			<span name="sbi_card_frm_<?php echo $cc_bankid; ?>" id="sbi_card_frm_<?php echo $cc_bankid; ?>" style="display:none;" >
					<form action="sbi-credit-card-continue_UAT.php" method="POST" target="_blank" >
					 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid" />
					<input type="hidden" name="cc_name" id="cc_name" value="<? echo $cc_bank_name;?>" />
					<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>" />
					<input type="submit" style="width:84px; height:56px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/online-approval.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
						</form></span>
						<span name="sbi_card_disable_<?php echo $cc_bankid; ?>" id="sbi_card_disable_<?php echo $cc_bankid; ?>"  style="display:block;" ><img src="/new-images/cc/online-approval-disabled.jpg" border="0" /></span>
				<? 	
				}
			elseif(($cc_bankid==13 || $cc_bankid==19 || $cc_bankid==21 || $cc_bankid==67))
				{  ?>
					<form action="scb-credit-card-continue.php" method="POST" target="_blank" >
					 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid" />
					<input type="hidden" name="cc_name" id="cc_name" value="<? echo $cc_bank_name;?>" />
					<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>" />
					<input type="submit" style="width:84px; height:56px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/online-approval.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
						</form>
				<? 	
				}
			elseif(($cc_bankid==46 || $cc_bankid==47 || $cc_bankid==50 || $cc_bankid==71))
				{  ?>
					<form action="amex-credit-card-continue.php" method="POST" target="_blank" >
					 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid" />
					<input type="hidden" name="cc_name" id="cc_name" value="<? echo $cc_bank_name;?>" />
					<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>" />
					<input type="submit" style="width:84px; height:56px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/online-approval.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
						</form>
				<? 	
				}
				else if(($cc_bankid==72 || $cc_bankid==73 || $cc_bankid==74 ))
				{  ?>
					<form action="yesbank-continue.php" method="POST" target="_blank" >
					 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
					<input type="hidden" name="cc_name" id="cc_name" value="<? echo $cc_bank_name;?>">
					<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
					<input type="submit" style="width:84px; height:56px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/online-approval.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
						</form>
				<? 	
				}	
				else
				{ //echo "hello";
		    ?>		  
			<form action="apply_cc_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid" />
		    <input type="hidden" name="cc_name" id="cc_name" value="<? echo $cc_bank_name;?>" />
			<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
			<input type="submit" style="width:84px; height:38px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
			    </form>
				<!--<a href="<? //echo $cc_bank_url;?>" target="_blank"><img src="/new-images/cc/crd_apply.jpg" border="0" onClick="insertData(<? //echo $i;?>);"/></a>-->
			  <? 
				}
		
				} ?></td>	 
      <td width="171" height="85" align="center" valign="middle" style="border-right:1px solid #fe7e00; color:#000000; padding-top:3px; padding-bottom:3px;"><? $card_image =mysql_result($get_Bankresult,$j,'card_image');
		?>
		<? if(strlen($card_image)>0)
		  {  ?>
		<img src="/<? echo $card_image;?>"  width="140" height="84"/>
		<? 
		  }
		
		else {
echo $cc_bank_name;
		}?>		</td>
 <td height="85" align="center"  class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;"><? $cc_bank_fee =mysql_result($get_Bankresult,$j,'cc_bank_fee');	
	 $cc_bank_fee_content = mysql_result($get_Bankresult,$j,'cc_bank_fee_content');
		 
		 if(strlen($cc_bank_fee_content)>5)
		  {
			 echo $cc_bank_fee_content;
		  }
	  else
	  {
	  echo "<b>Rs.".$cc_bank_fee."</b>"; }	?></td>
     
     <td height="85" align="left" valign="middle" class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000; padding-left:0px; !important">   <? echo $cc_bank_features = mysql_result($get_Bankresult,$j,'cc_bank_new_features');?></td>
	  <td height="85" align="center"  class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;"><b><? $cc_bank_rates =mysql_result($get_Bankresult,$j,'cc_bank_rates');	echo $cc_bank_rates;	?></b></td> 
     
    </tr>	
	 <tr>
      <td height="3" colspan="6" align="center" valign="middle" style="background:url(/new-images/cc/crd-line.jpg);"></td>
	  <td width="1" height="3" align="left" valign="middle" style="background:url(/new-images/cc/crd-line.jpg);"></td>
    </tr>
<?
}
}

}
?>
<?
	if(count($strcc_bankid)>1)
				 {
		$arrcc_bankid=implode(',',$strcc_bankid);
$getcc_option=ExecQuery("Update Req_Credit_Card Set Eligible_Card_Option ='".$arrcc_bankid."' Where (RequestID='".$ProductValue."')");
				 }
	 }//if
	 $i=$i+1;
	}
?>
   </table> 
   
</td>
  </tr>
 </table>
  <span><? echo $cc_bank_features = mysql_result($get_Bankresult,$j,'cc_application_time');?></span><br /></div>
 	<?
//SBI END
    }
  else
	   {
  		$filename = "Contents_Credit_Card_Mustread.php";
						header("Location: $filename");
						exit();
	   }
   }
	 else
		 {
		$filename = "Contents_Credit_Card_Mustread.php";
						header("Location: $filename");
						exit();
	 }
		 ?>



<?php /*?><table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" bgcolor="#e6edfd">
<tr>
<td width="10%" rowspan="2" align="center" style="color:#000000; font-size:18px; border:1px #FFFFFF solid;">Connect With Us</td>
<td width="10%" height="30" align="center" style=" color:#000000; font-size:14px; border-right:1px #FFFFFF solid;"><b>Facebook</b></td>
<td width="20%" align="center" style="color:#000000; font-size:14px; border-right:1px #FFFFFF solid;"><b>Google +</b></td>
<td width="10%" align="center" style="color:#000000; font-size:14px;"><b>Twitter</b></td></tr>
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
</script><?php */?>

<div style="clear:both; height:15px;"></div>
<?php  //include "footer_sub_menu.php"; ?>
</div>
</body>
<script language="javascript">
function validateOtpForm(){
	var bank_reference_code = document.getElementById('bank_reference_code').value;
	var request_id = document.getElementById('request_id').value;
	if (bank_reference_code == ''){
		alert("Please enter OTP");
	}
	else{
		$.ajax({
			url: 'http://www.deal4loans.com/validate_sbi_otp.php',
			type: 'POST',
			dataType:'JSON',
			data: {
				bank_reference_code: bank_reference_code,
				request_id: request_id,
			},
			success: function (res) {
				
				 document.getElementById('validateMsg').innerHTML = res.message;
				 //if($cc_bankid==52 || $cc_bankid==53 || $cc_bankid==54 || $cc_bankid==59 || $cc_bankid==60 || $cc_bankid==61 || $cc_bankid==62 || $cc_bankid==64 || $cc_bankid==65 || $cc_bankid==66 )
				if(res.message=="Verified Successfully")
				{	
					<?php
					for($i=0;$i<count($sbiBankID_Array);$i++)
					{
						?>
							document.getElementById('sbi_card_disable_<?php echo $sbiBankID_Array[$i]; ?>').innerHTML ='';
							document.getElementById('sbi_card_frm_<?php echo $sbiBankID_Array[$i]; ?>').style.display='block';
						<?php
					}	
					?>
					
				}
			//$('#sbi_card_frm').show();
				//alert(res.message);
			}
		});
	}
}

</script>
</html>
