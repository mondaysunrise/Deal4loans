<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'show_quotecount.php';		

	error_reporting();

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
	  } elseif ($mdiff==0)
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

$pageName = $_REQUEST["pageName"];
$RequestID = $_REQUEST["RequestID"];
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

if(isset($pageName) && $pageName=="page_forcampaign")
{
	$Employment_Status = $_REQUEST["Employment_Status"];
	$salary_account = $_REQUEST["salary_account"];
	if($Reference_Code == $activation_code)
	{
		$Is_Valid=1;
	}
	else
	{
		$Is_Valid=0;
	}
	$upcctble="Update Req_Credit_Card set Salary_Account ='".$salary_account."' ,Employment_Status='".$Employment_Status."',Is_Valid='".$Is_Valid."' Where (RequestID=".$RequestID.")";
	$resultupcctble=ExecQuery($upcctble);
}

if($Is_Valid==1)
{
	$upcctblefrall="Update Req_Credit_Card set Is_Valid='".$Is_Valid."' Where (RequestID=".$RequestID.")";
	
	$resultupcctblefrall=ExecQuery($upcctblefrall);
}

$ProductValue = $_SESSION['Temp_LID'];
if($ProductValue>0)
{
	$getccdtls="Select Pincode,DOB,Name,Mobile_Number,Email,ABMMU_flag,Net_Salary,City,City_Other From Req_Credit_Card Where Req_Credit_Card.RequestID=".$ProductValue;
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

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you Credit Card</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  <link href="source.css" rel="stylesheet" type="text/css" />
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
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
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
.crd_colm { font-family:verdana; font-size:11px; color:#000000; font-weight:bold; border-right:1px solid #fe7e00; background-color:#FDD57E;
}
.crd_colm_txt { style="font-family:verdana; font-size:11px; color:#000000; font-weight:bold; border-right:1px solid #fe7e00;}
</style>
<script src="scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body>
<?php include "top-menu.php"; ?>
<!--top-->
<!--logo navigation-->
<?php include "main-menu-credit-card.php"; ?>
<!--logo navigation-->

<div style="clear:both; height:15px;"></div>
<div class="text12" style="margin:auto; width:970px;" align="center">
  <h1 style="color:#000000 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;">Dear <? echo $full_name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who has taken quote @deal4loans.com.</h1>
   <?php
// print_r($_SESSION);
   if($Net_Salary>=144000)
   {
	echo "entered";
echo $selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and 	cc_bankid in (42,43,44)) order by cc_priority  ASC";

	//echo  $selectccbanks."<br>";
	$ccbankresult = ExecQuery($selectccbanks);
	$rowscount = mysql_num_rows($ccbankresult);
if($rowscount>0)
				 {

?>
<div style="font-size:14px; text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px; color:#000000; !important">
<!--You are Eligible to Select from <? echo $rowscount; ?> Credit Card Offers  !--></div>
<div style="clear:both;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
	 <table width="960" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>      
      <td width="126" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Card Name </td>
      <td width="142" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Image </td>
      <td width="181" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Annual Fee</td>
      <td width="93" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Interest (p.m) </td>
    <td width="234" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Features</td>
	<td width="143" height="25" align="center" valign="middle" style="font-family:verdana; font-size:12px; color:#000000; font-weight:bold; " class="crd_colm">Apply </td>
    </tr>
			<?	 }

if($rowscount >0)
{	
$r=0;
$i=1;
$strcc_bankid="";
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
		//   "query2 ".$qry2."<br><br>";
		  $result1=ExecQuery($qry2);
        $recordcount = mysql_num_rows($result1);
		
		if($recordcount>0)
		 {
			$strcc_bankid[] = $cc_bankid;
			
		
		 
		while($getrow = mysql_fetch_array($result1))
			 {
			//$get_Bank="Select * From credit_card_banks_eligibility Where cc_bankid=".$cc_bankid." order by cc_bank_fee ASC";
			$get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid=".$cc_bankid." ) ";
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
	   <input type="hidden" name="prdct_id" id="prdct_id" value="<? echo $ProductValue;?>">
	  <tr>
           <td width="126" height="85" align="center" class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;"><? $cc_bank_name = mysql_result($get_Bankresult,$j,'cc_bank_name'); ?>
        <input type="hidden" name="crd_nme_<? echo $i; ?>" id="crd_nme_<? echo $i; ?>" value="<? echo $cc_bank_name; ?>"> <b><? if (strlen($cc_bank_url)>0) { ?> 
		<? echo $cc_bank_name; ?><? } else 
		  { 
			echo $cc_bank_name;
		  } ?></b></td>
		
      <td width="142" height="85" align="center" valign="middle" style="border-right:1px solid #fe7e00; color:#000000; padding-top:3px; padding-bottom:3px;"><? $card_image =mysql_result($get_Bankresult,$j,'card_image');
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
      <td height="85" align="center"  class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;"><b><? $cc_bank_rates =mysql_result($get_Bankresult,$j,'cc_bank_rates');	echo $cc_bank_rates;	?></b></td>
     <td height="85" align="left" valign="middle" class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000; padding-left:0px; !important">   <? echo $cc_bank_features = mysql_result($get_Bankresult,$j,'cc_bank_new_features');?></td>
	 
      <td width="143" height="85" align="center" >	
	  <? 
		if($cc_bankid==13)
		  {	
		    ?>
          <a href="https://apply.standardchartered.co.in/credit-card?selectedCardId=5&se=deal4loans&cp=SCB_CreditCards_Display_SCB&ag=SCB_EM&kd=rx_mailer&complete_name=<? echo $full_name; ?>&cityId=<? echo $cityid; ?>&employmentTypeId=1&dateOfBirth=<? echo $Dobn; ?>&annualIncome=<? echo $Net_Salary; ?>&mobileNo=<? echo $Mobile_Number; ?>&pincode=<? echo $Pincode; ?>&emailId=<? echo $Email; ?>&employerName=wrsinfo" target="_blank"><img src="/new-images/cc/crd_apply.jpg" border="0" onClick="insertData(<? echo $i;?>);"/></a>
				<? 
			}
			else if($cc_bankid==19)
			{
			?>
			<a href="https://apply.standardchartered.co.in/credit-card?selectedCardId=4&se=deal4loans&cp=SCB_CreditCards_Display_SCB&ag=SCB_EM&kd=rx_mailer&complete_name=<? echo $full_name; ?>&cityId=<? echo $cityid; ?>&employmentTypeId=1&dateOfBirth=<? echo $Dobn; ?>&annualIncome=<? echo $Net_Salary; ?>&mobileNo=<? echo $Mobile_Number; ?>&pincode=<? echo $Pincode; ?>&emailId=<? echo $Email; ?>&employerName=wrsinfo" target="_blank"><img src="/new-images/cc/crd_apply.jpg" border="0" onClick="insertData(<? echo $i;?>);"/></a>
			<?php
			}
else if($cc_bankid==21)
			{
			?>
			<a href="https://apply.standardchartered.co.in/credit-card?selectedCardId=6&se=deal4loans&cp=SCB_CreditCards_Display_SCB&ag=SCB_EM&kd=rx_mailer&complete_name=<? echo $full_name; ?>&cityId=<? echo $cityid; ?>&employmentTypeId=1&dateOfBirth=<? echo $Dobn; ?>&annualIncome=<? echo $Net_Salary; ?>&mobileNo=<? echo $Mobile_Number; ?>&pincode=<? echo $Pincode; ?>&emailId=<? echo $Email; ?>&employerName=wrsinfo" target="_blank"><img src="/new-images/cc/crd_apply.jpg" border="0" onClick="insertData(<? echo $i;?>);"/></a>
			<?php
			}
			else if (($cc_bankid==10 || $cc_bankid==16 || $cc_bankid==15 || $cc_bankid==28 || $cc_bankid==22 || $cc_bankid==15 || $cc_bankid==30 || $cc_bankid==35 || $cc_bankid==36 || $cc_bankid==37 || $cc_bankid==39 || $cc_bankid==40 || $cc_bankid==41))
		  { ?>
			<form action="apply-hdfc-credit-card1.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
		    <input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
			<input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
			    </form>
		  <? }
		else if ($cc_bankid==20)
		  { ?>
			<form action="dcb_payless_credit_card.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
		    <input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
			<input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
			    </form>
		  <? }
		  else if ($cc_bankid==23 || $cc_bankid==24 || $cc_bankid==25 || $cc_bankid==26 || $cc_bankid==27 || $cc_bankid==29)
		  { ?>
			<form action="apply-icici-credit-cards.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
		    <input type="hidden" name="cityval" id="cityval" value="<? echo $City;?>">
			 <input type="hidden" name="crd_nme" id="crd_nme" value="<? echo $cc_bank_name; ?>">
			<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
			<input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
			    </form>
		  <? }
		    else if ($cc_bankid==42 || $cc_bankid==43 || $cc_bankid==44 )
		  { ?>
			<form action="ratnakar-bank-credit-card.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
		  	<input type="hidden" name="ccrqd" id="ccrqd" value="<? echo $ProductValue;?>">
			<input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
			    </form>
		  <? }
			else
		  {
		  if($cc_bankid==14)
		  	{	?>
		<form action="barclays-platinum-card.php" method="POST" target="_blank" >
		  <input type="hidden" name="Reference_Code" value="<? echo $Reference_Code;?>">
		  <input type="hidden" name="RequestID" value="<? echo $ProductValue;?>">
		  <div style="padding-bottom:5px; color:#AE4212; font-weight:bold;">&nbsp;</div> 
		  <input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); background-repeat:no-repeat; margin-bottom: 0px; " value="" onClick="insertData(<? echo $i;?>);"/></form>
					<? 
			}		  
			else
			{				//echo "hello";
		    ?>		  
			<form action="apply_cc_consent.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
		    <input type="hidden" name="cc_name" id="cc_name" value="<? echo $cc_bank_name;?>">
			<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
			<input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
			    </form>
				<!--<a href="<? //echo $cc_bank_url;?>" target="_blank"><img src="/new-images/cc/crd_apply.jpg" border="0" onClick="insertData(<? //echo $i;?>);"/></a>-->
			  <? 
				}
				} ?></td>	 
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
  <span class="crd_colm_txt" style="border-right:1px solid #fe7e00;"><? echo $cc_bank_features = mysql_result($get_Bankresult,$j,'cc_application_time');?></span></div>
 	<? 
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
</div>

<table width="850" border="0" align="center" cellpadding="1" cellspacing="0" bgcolor="#e6edfd">
<tr>
<td width="196" rowspan="2" align="center" style="color:#000000; font-size:18px; border:1px #FFFFFF solid;">Connect With Us</td>
<td width="208" height="30" align="center" style=" color:#000000; font-size:14px; border-right:1px #FFFFFF solid;"><b>Facebook</b></td>
<td width="169" align="center" style="color:#000000; font-size:14px; border-right:1px #FFFFFF solid;"><b>Google +</b></td>
<td width="117" align="center" style="color:#000000; font-size:14px;"><b>Twitter</b></td></tr>
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
<?php include "footer1.php"; ?>
</body>
</html>
