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
$Gender = $_REQUEST["Gender"];
$panno = $_REQUEST["panno"];
$City = $_REQUEST["City"];
$City_Other = $_REQUEST["City_Other"];
$State = $_REQUEST["State"];
$resiaddress1 = $_REQUEST["resiaddress1"];
$resiaddress2 = $_REQUEST["resiaddress2"];
$resiaddress3 = $_REQUEST["resiaddress3"];
$pincode = $_REQUEST["pincode"];
$Residence_Address = $resiaddress1." | ".$resiaddress2." | ".$resiaddress3;

if(strlen($City)>0)
{
	$cityclause=", City='".$City."'";
	if(strlen($City_Other)>0)
	{
		$othercityclause=", City_Other='".$City_Other."'";
	}
}

$upcctblenw="Update Req_Credit_Card set Gender='".$Gender."',Residence_Address ='".$Residence_Address."' ,State='".$State."', Pancard='".$panno."',Pincode='".$pincode."' ".$cityclause." ".$othercityclause." Where (RequestID=".$RequestID.")";
	$resulupcctblenw=ExecQuery($upcctblenw);

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
$ProductValue=$RequestID;
if($ProductValue>0)
{
	$getccdtls="Select Pincode,DOB,Name,Mobile_Number,Email,ABMMU_flag,Net_Salary,City,City_Other,source From Req_Credit_Card Where Req_Credit_Card.RequestID=".$ProductValue;
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
<div class="lac-main-wrapper">
<div style="clear:both; height:70px;"></div>
<div class="text12" style="margin:auto;" >
  <h1 style="color:#000000 !important; margin:0px; padding:0px; font-size:16px !important; line-height:22px;">Dear <? echo $full_name; ?>, You are <? echo $total_homeloan_taken; ?> th customer , who has taken quote @deal4loans.com.</h1><br /><br />
   <div style="color:#000">
   <form action="https://www.deal4loans.com/yesbank-continue.php" method="POST" target="_blank" >
					 <input type="hidden" name="cc_bankid" value="72" id="cc_bankid">
					<input type="hidden" name="cc_name" id="cc_name" value="Yes Bank">
					<input type="hidden" name="RequestID" id="RequestID" value="1238208">
					<input type="submit" style="width:84px; height:56px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/online-approval.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
						</form>
  <?php 
 /* if($Net_Salary<200000){ echo "Oops We are sorry that we didn’t  find any  offer for you  at this time .<br><br>
We will try to get in touch with you if we have offers for your desired product.<br><br>
";
  }*/
  ?>
  <!--<a href="javascript: history.go(-1);"><img src="images/go-back.png" alt="back-btn" height="53" width="157" border="0" /></a>-->
  </div>
	<?php
	// print_r($_SESSION);
	if($Net_Salary>=144000)
	{
		if($Net_Salary>=1000000)
		{
			$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and cc_bank_flag=1 ".$srchCategory.") order by cc_priority  ASC";
			//$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and cc_bank_flag=1) order by cc_priority  ASC";
		}
		else
		{
			$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and cc_bank_flag=1 ".$srchCategory.") order by cc_priority  ASC";
			//$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and cc_bank_flag=1) order by cc_priority  ASC";
		}
		$selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$strcity."%' and cc_bank_name LIKE 'Yes%') order by cc_priority  ASC";
		echo  $selectccbanks."<br>";
		
		$ccbankresult = ExecQuery($selectccbanks);
		$rowscount = mysql_num_rows($ccbankresult);
		if($rowscount>0)
		{
	?>
<!--<div style="font-size:14px; text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px; color:#000000; !important">
You are Eligible to Select from <? //echo $rowscount; ?> Credit Card Offers  !</div>-->
<div style="clear:both; height:10px;">
<div class="overflow-width">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
    
    
	 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>      
      <td width="107" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Card Name </td>
      <td width="171" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Image </td>
      <td width="257" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Annual Fee</td>
      <td width="70" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Interest (p.m) </td>
    <td width="205" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Features</td>
	<td width="159" height="25" align="center" valign="middle" style="font-family:verdana; font-size:12px; color:#000000; font-weight:bold; " class="crd_colm">Apply </td>
    </tr>
	<? 
			 }

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
			$get_Bank="Select * From credit_card_banks_eligibility Where cc_bankid='72' order by cc_bank_fee ASC";
			//$get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid=".$cc_bankid." and cc_bank_flag =1) ";
			$get_Bankresult=ExecQuery($get_Bank);
			 $getrecordcount = mysql_num_rows($get_Bankresult);
			
  for($j=0;$j<$getrecordcount;$j++)
 { 
	 echo $source."<br>";
	  ?>
	   <input type="hidden" name="prdct_id" id="prdct_id" value="<? echo $ProductValue;?>">
	  <tr>
           <td width="107" height="85" align="left" class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;"><? $cc_bank_name = mysql_result($get_Bankresult,$j,'cc_bank_name'); ?>
        <input type="hidden" name="crd_nme_<? echo $i; ?>" id="crd_nme_<? echo $i; ?>" value="<? echo $cc_bank_name; ?>"> <b><? if (strlen($cc_bank_url)>0) { ?> 
		<? echo $cc_bank_name; ?><? } else 
		  { 
			echo $cc_bank_name;
		  } ?></b></td>
		
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
      <td height="85" align="center"  class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000;"><b><? $cc_bank_rates =mysql_result($get_Bankresult,$j,'cc_bank_rates');	echo $cc_bank_rates;	?></b></td>
     <td height="85" align="left" valign="middle" class="crd_colm_txt" style="border-right:1px solid #fe7e00; color:#000000; padding-left:0px; !important">   <? echo $cc_bank_features = mysql_result($get_Bankresult,$j,'cc_bank_new_features');?></td>
	 
      <td width="159" height="85" align="center" >	
	  <? 
		 if (($cc_bankid==10 || $cc_bankid==16 || $cc_bankid==15 || $cc_bankid==28 || $cc_bankid==22 || $cc_bankid==15 || $cc_bankid==30 || $cc_bankid==35 || $cc_bankid==36 || $cc_bankid==37 || $cc_bankid==39 || $cc_bankid==40 || $cc_bankid==41))
		  { ?>
			<form action="apply-hdfc-credit-card1.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
		    <input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
			<input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
			    </form>
		  <? }
		  else if($cc_bankid==23 || $cc_bankid==24 || $cc_bankid==25 || $cc_bankid==26 || $cc_bankid==27 || $cc_bankid==29)
		  { ?>
			<form action="apply-icici-credit-cards.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
		    <input type="hidden" name="cityval" id="cityval" value="<? echo $City;?>">
			 <input type="hidden" name="crd_nme" id="crd_nme" value="<? echo $cc_bank_name; ?>">
			<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
			<input type="submit" style="width:143px; height:63px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
			    </form>
		  <? }
		  else if(($cc_bankid==4 || $cc_bankid==18 || $cc_bankid==45))
				{  ?>
					<form action="citibank-credit-card-continue.php" method="POST" target="_blank" >
					 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
					<input type="hidden" name="cc_name" id="cc_name" value="<? echo $cc_bank_name;?>">
					<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
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
		  {
		 		 if($cc_bankid==52 || $cc_bankid==53 || $cc_bankid==54 || $cc_bankid==59 || $cc_bankid==60 || $cc_bankid==61 || $cc_bankid==62)
				{  ?>
					<form action="sbi-credit-card-continue.php" method="POST" target="_blank" >
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
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
		    <input type="hidden" name="cc_name" id="cc_name" value="<? echo $cc_bank_name;?>">
			<input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
			<input type="submit" style="width:143px; height:63px; border: 0px none ; cursor:pointer; background-image: url(/new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
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
</html>