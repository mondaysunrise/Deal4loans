<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	error_reporting();
//	$page_Name = "LandingPage_PL";
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


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	
	$RequestID	= $_POST['RequestID'];
	$Net_Salary	= $_POST['Net_Salary'];
	$ProductValue = $RequestID;
	$getDataSql = "select * from Req_Credit_Card where RequestID='".$RequestID."'";
	$getDataQuery = ExecQuery($getDataSql);
	$Name = mysql_result($getDataQuery,0,'Name');
	$Company_Name = mysql_result($getDataQuery,0,'Company_Name');
	$Employment_Status = mysql_result($getDataQuery,0,'Employment_Status');
	
	$Mobile_Number = mysql_result($getDataQuery,0,'Mobile_Number');
	$Phone = $Mobile_Number;
	$Pincode = mysql_result($getDataQuery,0,'Pincode');
	$City  = mysql_result($getDataQuery,0,'City');
	$Email = mysql_result($getDataQuery,0,'Email');
	$DOB = mysql_result($getDataQuery,0,'DOB');
	$DOB_arr = explode("-", $DOB);
	list($yyyy, $mm, $dd) = $DOB_arr;	
	
	if($City=="Others")
	{
		$strcity=$City_Other;
		$City_Other  = mysql_result($getDataQuery,0,'City_Other');
		$City=$City_Other;
	}
	else
	{
		$strcity=$City;
	}

	$updateSql = "update Req_Credit_Card set Net_Salary = '".$Net_Salary."' where RequestID = '".$RequestID."'";
	$updateQuery = ExecQuery($updateSql); 
	//echo $Net_Salary; 
	//exit();
	if($Net_Salary<100)
   {
   // header location
 	 $_SESSION['Temp_LID'] = $RequestID;
   	  header ("Location: apply-credit-card-test2.php");
  	  exit();
   }
	if($Net_Salary>=300000)
   {
		$SMSMessage = "Thanks for your Credit Card Application.Please apply at the choices given to you .If any chance you are busy, the same offers have been sent to your email. Keep your Pan Number handy when you apply.";
		if(strlen(trim($Phone)) > 0)
			SendSMS($SMSMessage, $Phone);
   }

		
	
	

}

//exit();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Thank you</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
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
			alert(id);
			var crd_nme = document.getElementById('crd_nme_'+ id).value;
			var prdct_id = document.getElementById('prdct_id').value;
			var queryString = "?crd_nme=" + crd_nme +"&prdct_id=" + prdct_id ;
				
				//alert(queryString); 
				ajaxRequestMain.open("GET", "insert_card_name.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequestMain.onreadystatechange = function(){
					/*if(ajaxRequestMain.readyState == 4)
					{
						document.getElementById('Activate').value=ajaxRequestMain.responseText;
					}*/
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
</head>
<body>
<?php include '~Top-new.php';?>
<?php //include '~menu.php'; ///url(new-images/cc/crd_gradient.jpg);?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
  <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px;"> Thanks for applying Credit Card through Deal4loans.com. </h1>
   <?php
 
   if($Net_Salary>=144000)
   {
	   
   $selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$City."%' and cc_bank_flag=1) ORDER BY cc_priority ASC";
	//echo  $selectccbanks."<br>";
	$ccbankresult = ExecQuery($selectccbanks);
	 $rowscount = mysql_num_rows($ccbankresult);

if($rowscount >0)
{
		
	?>
<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;">
You are Eligible for following cards.Choose from the offers below and Apply  at Banks Link for  the best Credit Card as per you !!!</div>
<div style="clear:both;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top">
	 <table width="950" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
      
      <td width="93" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Card Name </td>
      <td width="150" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Image </td>
      <td width="79" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Annual Fee</td>
      <td width="99" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Interest (p.m) </td>
    <td width="146" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Features</td>
	<td width="225" height="25" align="center" valign="middle" bgcolor="#0c68ff" class="crd_colm">Aprox time to Complete application form</td>
	  
      <td width="154" height="25" align="center" valign="middle" style="font-family:verdana; font-size:12px; color:#000000; font-weight:bold; " class="crd_colm">Apply </td>
     
    </tr>
  <?php
 
	
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
	//	echo    "query2 ".$qry2."<br><br>";
		  $result1=ExecQuery($qry2);
        $recordcount = mysql_num_rows($result1);
		
		if($recordcount>0)
		 {
			$strcc_bankid[] = $cc_bankid;
			
		while($getrow = mysql_fetch_array($result1))
			 {
			//$get_Bank="Select * From credit_card_banks_eligibility Where cc_bankid=".$cc_bankid." order by cc_bank_fee ASC";
			$get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid=".$cc_bankid.") ";
			$get_Bankresult=ExecQuery($get_Bank);
			 $getrecordcount = mysql_num_rows($get_Bankresult);
			
//echo $i;
  for($j=0;$j<$getrecordcount;$j++)
 { 

if($cc_bankid==12)

	{
	?>
	<!--<td valign="top" width="240" class="crdbg" align="center">
<table width="240" border="0" align="center" cellpadding="0" cellspacing="0" >
          <tr>
            <td height="30" class="crdbhdng">American Express Kingfisher First Card</td>
          </tr>
		  <tr><td align="center"><img src="new-images/amex_160X600.jpg" onclick="javascript:window.open('http://ad-apac.doubleclick.net/clk;232259950;56152312;b?https://www152.americanexpress.com/EformsWeb/un/viewLeadGenHandler.do?loc_str=en_IN&sitename=deal4loans&adunit=window160x600&channel=ROS&campaign=amex_kf_nov10')" style="cursor:pointer;"/></td></tr>
          -->
<? }
	  else
	  {
	  ?>
	   <input type="hidden" name="prdct_id" id="prdct_id" value="<? echo $ProductValue;?>">
	  
    <tr>
      
      <td width="93" height="85" align="center" class="crd_colm_txt" style="border-right:1px solid #fe7e00;"><? $cc_bank_name = mysql_result($get_Bankresult,$j,'cc_bank_name'); ?><input type="hidden" name="crd_nme_<? echo $i; ?>" id="crd_nme_<? echo $i; ?>" value="<? echo $cc_bank_name; ?>"> <b><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank"><? 
		echo $cc_bank_name; ?></a></b></td>
      <td width="150" height="85" align="center" valign="middle" style="border-right:1px solid #fe7e00;  padding-top:3px;"><? $card_image =mysql_result($get_Bankresult,$j,'card_image');
			  
		?><a <? if (strlen($cc_bank_url)>0) { ?> href="<? echo $cc_bank_url; ?> " target="_blank" <? } ?> >
		<? if(strlen($card_image)>0)
		  {  if(($cc_bankid==5 || $cc_bankid==7 || $cc_bankid==8 || $cc_bankid==9))
			  {
			?>
		<a <? if (strlen($cc_bank_url)>0) { ?> href="<? echo $cc_bank_url; ?> " target="_blank" <? } ?> ><img src="<? echo $card_image;?>"  width="53" height="84"/></a>
		<? }
			else if ($cc_bankid==18)
			  { ?>
			  <img src="<? echo $card_image;?>"  />
			  <? }
			  else
			  {?>
		<img src="<? echo $card_image;?>"  width="140" height="84"/>
		<? }
		  }
		else {
echo $cc_bank_name;
		}?></a>		</td>
      <td height="85" align="center"  class="crd_colm_txt" style="border-right:1px solid #fe7e00;"><b><? $cc_bank_fee =mysql_result($get_Bankresult,$j,'cc_bank_fee');	echo "Rs.".$cc_bank_fee;	?></b></td>
      <td height="85" align="center"  class="crd_colm_txt" style="border-right:1px solid #fe7e00;"><b><? $cc_bank_rates =mysql_result($get_Bankresult,$j,'cc_bank_rates');	echo $cc_bank_rates;	?></b></td>
     <td height="85" align="center" valign="middle" class="crd_colm_txt" style="border-right:1px solid #fe7e00;">   <? echo $cc_bank_features = mysql_result($get_Bankresult,$j,'cc_bank_new_features');?></td>
	 <td height="85" align="center" valign="middle" class="crd_colm_txt" style="border-right:1px solid #fe7e00;"><? echo $cc_bank_features = mysql_result($get_Bankresult,$j,'cc_application_time');?></td>
      <td height="85" align="center" >	
	  <? 
			if($cc_bankid==13)

		  {	?><form action="standard_chartered_credit_card.php" method="POST" target="_blank" >
		 
		  <input type="hidden" name="Reference_Code" value="<? echo $Reference_Code;?>">
			<input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat;" value=""/>
					</form>
					<? 
			}
				else if (($cc_bankid==10 || $cc_bankid==16 || $cc_bankid==15) && $Employment_Status==1 )
		  { ?>
			<form action="apply-hdfc-credit-card.php" method="POST" target="_blank" >
			 <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid; ?>" id="cc_bankid">
		    <input type="hidden" name="RequestID" id="RequestID" value="<? echo $ProductValue;?>">
			<input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(new-images/cc/crd_apply.jpg); margin-bottom: 0px; background-repeat:no-repeat; background-color:#FFFFFF;" value="" onClick="insertData(<? echo $i;?>);"/>
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
		  <input type="submit" style="width: 143px; height: 63px; border: 0px none ; cursor:pointer; background-image: url(new-images/cc/crd_apply.jpg); background-repeat:no-repeat; margin-bottom: 0px; " value="" onClick="insertData(<? echo $i;?>);"/></form>
					<? 
			}
			else
			{
		    ?>		  
				<a href="<? echo $cc_bank_url;?>" target="_blank"><img src="new-images/cc/crd_apply.jpg" border="0" onClick="insertData(<? echo $i;?>);"/></a>
				<? 
				}
				} ?></td>
	 
    </tr>
    <tr>
      <td height="3" colspan="8" align="center" valign="middle" style="background:url(new-images/cc/crd-line.jpg);"></td>
	  <td width="3" height="3" align="left" valign="middle" style="background:url(new-images/cc/crd-line.jpg);"></td>
    </tr>
 
	   
<?
}
}

	}
	
	//print_r($strcc_bankid);
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
  
	  <? if((strlen(strpos($_SERVER['HTTP_REFERER'], "sbi-credit-cards-apply.php")) > 0))
	 {?>
	 
<!-- Google Code for SBi Credit Card Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "SPFnCIXr0wEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=SPFnCIXr0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


	 <?  }
 elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "credit-cards-apply.php")) > 0))
	 {?>

 <script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "p-B1CLH8iAEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=p-B1CLH8iAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<? } 
	  }
	  else
	 {
 if((strlen(strpos($_SERVER['HTTP_REFERER'], "sbi-credit-cards-apply.php")) > 0))
	 {?>
	 
<!-- Google Code for SBi Credit Card Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "SPFnCIXr0wEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=SPFnCIXr0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


	 <?  }
 elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "credit-cards-apply.php")) > 0))
	 {?>

 <script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "p-B1CLH8iAEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=p-B1CLH8iAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<? } 
if((strlen(strpos($_SERVER['HTTP_REFERER'], "sbi-credit-cards-apply.php")) > 0))
	 {?>
	 
<!-- Google Code for SBi Credit Card Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "SPFnCIXr0wEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=SPFnCIXr0wEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


	 <?  }
 elseif((strlen(strpos($_SERVER['HTTP_REFERER'], "credit-cards-apply.php")) > 0))
	 {?>

 <script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "p-B1CLH8iAEQh8-3_AM";
var google_conversion_value = 0;
if (1.0) {
  google_conversion_value = 1.0;
}
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=p-B1CLH8iAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<? } 

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

  
<div align="center"><script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* deal4loan */
google_ad_slot = "8793338166";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>

  </div>

  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->


</body>
</html>
