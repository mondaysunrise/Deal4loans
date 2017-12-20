<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//require 'getlistofeligiblebidders.php';
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


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
	$$a=$b;
	
	$UserID = $_SESSION['UserID'];
	$Full_Name = FixString($Full_Name);
	//$LName = FixString($LName);
	$Name= $Full_Name;
	$Email = FixString($Email);
	$Phone = FixString($Phone);
	$Pancard = FixString($Pancard);
	$CC_Holder = FixString($CC_Holder);
	$Card_Vintage = FixString($Card_Vintage);
	$City = FixString($City);
	$City_Other = FixString($City_Other);
	$Company_Name = FixString($Company_Name);
	$Net_Salary =FixString($Net_Salary);
	$Credit_Limit =FixString($Credit_Limit);	
	$IsPublic =1;
	$Day=FixString($day);
	$Month=FixString($month);
	$Year=FixString($year);
	$DOB=$Year."-".$Month."-".$Day;
	$Type_Loan = "CreditCard";
	$source = FixString($source);
	$Reference_Code = FixString($Reference_Code);
	$Employment_Status = FixString($Employment_Status);
	$Accidental_Insurance = FixString($Accidental_Insurance);
	$cpp_card_protect = FixString($cpp_card_protect);
	$Ibibo_compaign = FixString($Ibibo_compaign);
	$hdfclife = FixString($hdfclife);
	$Referrer = $_REQUEST['referrer'];
	$source = $_REQUEST['source'];
	$Section = $_REQUEST['section'];
	$Creative = $_REQUEST['creative'];
	$Pincode = FixString($Pincode);
	$Reference_Code = generateNumber(4);
	
	$No_of_Banks = $_REQUEST["No_of_Banks"];
	$ABMMU_flag = $_REQUEST["adty_brl"];
	$Salary_Account = $_REQUEST["salary_account"];
	$accept = $_REQUEST["accept"];

	$getDOB = $Year."".$Month."".$Day;
	$Age = DetermineAgeFromDOB($getDOB);
	
	$checkPincodeSql = "select * from barclays_pincode_list where pincode='".$Pincode."' and status=1"; 
	$checkPincodeQuery = ExecQuery($checkPincodeSql);
	$checkPincode = mysql_num_rows($checkPincodeQuery);
	
	$gethdfccccompany='select company_category from HDFC_CC_Company_List where hdfc_company_name="'.$Company_Name.'"';
// echo $getcompany;
$getcccompanyresult = ExecQuery($gethdfccccompany);
$grow=mysql_fetch_array($getcccompanyresult);
$recordcounthdfccc = mysql_num_rows($getcccompanyresult);
if($recordcounthdfccc>0)
	{
$hdfc_cccategory = $grow["company_category"];
	}

if($hdfc_cccategory=="Cat AB" || $hdfc_cccategory=="ELITE" || $hdfc_cccategory=="PREFERRED" || $hdfc_cccategory=="SUPERPRIME")
	{
		$Company_HDFC_Cat=1;
	}
	else
	{
		$Company_HDFC_Cat=0;
	}
	
	
	$IP = getenv("REMOTE_ADDR");
	
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}
	
		function Insert_iciciprulead($ProductValue, $Name, $City, $Phone, $Email)
	{
		$Sql = "INSERT INTO client_campaign_leads ( product_type, requestid, clientld_name, clientld_email, clientld_mobile, clientld_city, client_name, clientld_date,client_splcondition ) VALUES ( '1', '".$ProductValue."', '".$Name."', '".$Email."', '".$Phone."' , '".$City."',  'iciciprulife', Now(),'')";
		$query = mysql_query($Sql);
		//echo "Edelweiss:".$Sql."<br>";
		//exit();
	}
	
	
	
	$crap = " ".$Name." ".$Email." ".$Company_Name;
	$crapValue = validateValues($crap);
	$_SESSION['crapValue'] = $crapValue;
	if($crapValue=='Put')
	{
		$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
		
		if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
		{		
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Credit_Card Where (Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9971396361','9811215138','9999047207','9891601984','9999570210') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			//echo $getdetails."<br>";
			//exit();
			$checkavailability = ExecQuery($getdetails);
			$alreadyExist = mysql_num_rows($checkavailability);
			$myrow = mysql_fetch_array($checkavailability);
		
			if($alreadyExist>0)
			{
				$ProductValue=$myrow['RequestID'];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-credit-card-lead.php'"."</script>";
			}
			else
			{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			$CheckQuery = ExecQuery($CheckSql);
			//echo "<br>".$CheckSql;
			$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = mysql_result($CheckQuery, 0, 'UserID');
				$InsertProductSql = "INSERT INTO Req_Credit_Card( UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, DOB, IsPublic, Dated,  Reference_Code, source, Pancard, CC_Holder,Card_Vintage,IP_Address,Referrer,Creative,Section,Updated_Date,Accidental_Insurance, Cpp_Compaign, Pincode, No_of_Banks,Company_HDFC_Cat,ABMMU_flag,Company_ICICI_Cat,Salary_Account,Privacy,Credit_Limit)	VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Net_Salary', '$DOB', '$IsPublic', Now(), '$Reference_Code', '$source', '$Pancard','$CC_Holder','$Card_Vintage','$IP','$Referrer','$Creative','$Section',Now(),'$Accidental_Insurance','".$cpp_card_protect."', '".$Pincode."','".$No_of_Banks."','".$Company_HDFC_Cat."','".$ABMMU_flag."','".$Company_HDFC_Cat."','".$Salary_Account."','".$accept."','".$Credit_Limit."' )"; 
				//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID1 = mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Credit_Card( UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, DOB, IsPublic, Dated,  Reference_Code, source, Pancard, CC_Holder,Card_Vintage,IP_Address,Referrer,Creative,Section, Updated_Date, Accidental_Insurance, Cpp_Compaign, Pincode, No_of_Banks, Company_HDFC_Cat, ABMMU_flag, Salary_Account,Privacy, Company_ICICI_Cat,Credit_Limit)			VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Net_Salary', '$DOB', '$IsPublic', Now(), '$Reference_Code', '$source', '$Pancard','$CC_Holder','$Card_Vintage','$IP','$Referrer','$Creative','$Section',Now(),'$Accidental_Insurance','".$cpp_card_protect."','".$Pincode."' ,'".$No_of_Banks."','".$Company_HDFC_Cat."', '".$ABMMU_flag."', '".$Salary_Account."','".$accept."','".$Company_HDFC_Cat."','".$Credit_Limit."')";
									
			}
			
			$InsertProductQuery = ExecQuery($InsertProductSql);
			$ProductValue = mysql_insert_id();
			
			
			if($City=="Others")
			{
				$strcity=$City_Other;
			}
			else
			{
				$strcity=$City;
			}
			
			if($hdfclife==1)
		{
			$Product=1;
			//Insert_HdfcLife($Name, $strcity, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
			Insert_iciciprulead($ProductValue, $Name, $City, $Phone, $Email);
		}

					
			$_SESSION['Temp_LID'] = $ProductValue;
			//echo $Net_Salary; 
			if($Net_Salary<100)
			{
				header ("Location: apply-credit-card-salary-correction.php");
				exit();
			}
			
			//if($Net_Salary>=144000)
			//{
				$SMSMessage = "Please use this code: ".$Reference_Code." to activate your card request at deal4loans.com";
		
				if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMSMessage, $Phone);
			//}
		}
		}
		
		//Code Added to mailtocommonscript.php
		$FName = $Name;
		$Checktosend="getthank_individual";
		include "scripts/mailtocommonproduct.php";
		
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Bcc: testthankuse@gmail.com"."\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		if($Name)
		$SubjectLine = $Name.", Learn to get Best Deal on Credit Card";
		else
		$SubjectLine = "Learn to get Best Deal on Credit Card";
		//echo $Type_Loan;
		if(isset($Type_Loan))
		{
			mail($Email, $SubjectLine, $Message2, $headers);
		}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com/".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}
	}//$crap Check
	else if($crapValue=='Discard')
	{
		header("Location: Redirect.php");
		exit();
	}
	else
	{
		header("Location: Redirect.php");
		exit();
	}

}
//exit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<META HTTP-EQUIV="Refresh" CONTENT="8;URL=credit-card-thank.php">-->
<title>Credit Card Processing</title>
 <script language="javascript">
function validateFrm ()
{
	if(document.validate.activation_code.value=="")
	{
		alert("Please fill the activation code.");
		document.validate.activation_code.focus();
		return false;
	}

	if(document.validate.activation_code.value!="")
	{
		if(document.validate.activation_code.value!=<?php echo $Reference_Code; ?>)
		{
			alert("Please fill the correct activation code.");
			document.validate.activation_code.focus();
			return false;
		}
	}

}

</script>
</head>
<body style="margin:0px; padding:0px;">

<table width="1008" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="1008" align="center" valign="middle" style="background:url(/images/logos/bg1.gif) repeat;"><table width="980" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="80" align="center" valign="middle"><table width="980" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="200" height="80" align="center" valign="middle"><img src="new-images/d4l-sml-logo.gif" /></td>
            <td width="776" height="80" align="right" valign="bottom" style="padding-right:15px; font-family:'trebuchet MS'; font-size:16px; font-weight:bold; color:#000000;">Credit Card Request</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="980" height="400" align="center" style="font-family:verdana; font-size:14px; color:#0099FF; " valign="top">
        <table cellpadding="2" cellspacing="2" border="0">
        <tr><td align="center" style="padding-top:5px;" height="50">
                     Thanks for applying on deal4loans.com. Your Card Request is being scanned with the following Banks.
          </td></tr>
          <tr>
        <td width="980" height="70" align="center" valign="middle">
		<script language="JavaScript1.2">
var marqueewidth="950px"
//Specify the marquee's height
var marqueeheight="150px"
//Specify the marquee's marquee speed (larger is faster 1-10)
var marqueespeed=5
//configure background color:
var marqueebgcolor="#ffffff"
//Pause marquee onMousever (0=no. 1=yes)?
var pauseit=1
var marqueecontent='<nobr><table width="950" cellpadding="4"><tr><td  align="center"><table width="100" style="border:#0099FF solid 1px;"><tr><td align="center"><img src="http://www.deal4loans.com/new-images/stanc_palitinum.jpg" height="90" width="145"/></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">Standard Chartered Platinum Rewards Card </td></tr></table></td><td align="center" ><table style="border:#0099FF solid 1px;"><tr><td><img src="http://www.deal4loans.com/new-images/hdfc-gold-crd.jpg" height="90" /></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">HDFC Gold Card</td></tr></table></td><td  align="center"><table style="border:#0099FF solid 1px;"><tr><td><img src="http://www.deal4loans.com/new-images/hdfc_solitaire_crd.jpg" height="90"/></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">HDFC Bank Solitaire Womens Card </td></tr></table></td><td align="center" ><table style="border:#0099FF solid 1px;"><tr><td><img src="http://www.deal4loans.com/new-images/supervalue-titanium-card.png" /></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">Standard Chartered Super Value Titanium Card</td></tr></table></td><td width="135" align="center"><table style="border:#0099FF solid 1px;"><tr><td><img src="http://www.deal4loans.com/new-images/sbi-pltnm.jpg" /></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">SBI Platinum Card</td></tr></table></td><td align="center" ><table style="border:#0099FF solid 1px;"><tr><td><img src="http://www.deal4loans.com/new-images/manhattanplatinum-card.png" /></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">Standard Chartered Manhattan Platinum Card</td></tr></table></td><td align="center" ><table width="100" style="border:#0099FF solid 1px;"><tr><td align="center"><img src="http://www.deal4loans.com/new-images/hdfc-superia-crd.jpg" height="91"/></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">HDFC Bank Superia Credit Card</td></tr></table></td></tr></table></nobr>'
////NO NEED TO EDIT BELOW THIS LINE////////////
marqueespeed=(document.all)? marqueespeed : Math.max(1, marqueespeed-1) //slow speed down by 1 for NS
var copyspeed=marqueespeed
var pausespeed=(pauseit==0)? copyspeed: 0
var iedom=document.all||document.getElementById
if (iedom)
document.write('<span id="temp" style="visibility:hidden;position:absolute;top:-100px;left:-9000px">'+marqueecontent+'</span>')
var actualwidth=''
var cross_marquee, ns_marquee

function populate(){
if (iedom){
cross_marquee=document.getElementById? document.getElementById("iemarquee") : document.all.iemarquee
cross_marquee.style.left=parseInt(marqueewidth)+8+"px"
cross_marquee.innerHTML=marqueecontent
actualwidth=document.all? temp.offsetWidth : document.getElementById("temp").offsetWidth
}
else if (document.layers){
ns_marquee=document.ns_marquee.document.ns_marquee2
ns_marquee.left=parseInt(marqueewidth)+8
ns_marquee.document.write(marqueecontent)
ns_marquee.document.close()
actualwidth=ns_marquee.document.width
}
lefttime=setInterval("scrollmarquee()",10)
}
window.onload=populate

function scrollmarquee(){
if (iedom){
if (parseInt(cross_marquee.style.left)>(actualwidth*(-1)+8))
cross_marquee.style.left=parseInt(cross_marquee.style.left)-copyspeed+"px"
else
cross_marquee.style.left=parseInt(marqueewidth)+8+"px"

}
else if (document.layers){
if (ns_marquee.left>(actualwidth*(-1)+8))
ns_marquee.left-=copyspeed
else
ns_marquee.left=parseInt(marqueewidth)+8
}
}

if (iedom||document.layers){
with (document){
document.write('<table border="0" cellspacing="0" cellpadding="0"><td>')
if (iedom){
write('<div style="position:relative;width:'+marqueewidth+';height:'+marqueeheight+';overflow:hidden">')
write('<div style="position:absolute;width:'+marqueewidth+';height:'+marqueeheight+';background-color:'+marqueebgcolor+'" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">')
write('<div id="iemarquee" style="position:absolute;left:0px;top:0px"></div>')
write('</div></div>')
}
else if (document.layers){
write('<ilayer width='+marqueewidth+' height='+marqueeheight+' name="ns_marquee" bgColor='+marqueebgcolor+'>')
write('<layer name="ns_marquee2" left=0 top=0 onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed"></layer>')
write('</ilayer>')
}
document.write('</td></table>')
}
}
</script>		</td>
      </tr>
      
                     <tr valign="middle">
                                  <td height="28" class="frmbldtxt" style="padding-top:3px; font-weight:normal; font-size:13px; " align="center"><span style="float:left; padding-left:5px;">Dear <?php echo $Name ; ?>,</span>Please validate your mobile number.	</td>                   
                     </tr>
  <tr>
    <td colspan="2" style="color: #D02037; font-size:12px;" height="20" align="center"><b>We have sent an activation code on 
    <span style="color: #D02037;"><? echo $mobile_no; ?></span></b></td>
  </tr>
                   <tr><td colspan="2" align="center" style="padding:5px;">
				  </td></tr>
                  <tr><td colspan="2" align="center" style="padding:5px; ">
                  <form action="credit-card-thank.php" method="post" name="validate" onsubmit="return validateFrm();">
<div class="activation_box"><table  border="0" cellpadding="5" cellspacing="2" style="border:#666666 1px solid;">
				    <tr><td width="148" height="30" style="color: #D02037; font-size:12px; padding-left:10px; " > <strong>Activation Code</strong></td>
				    <td width="223"  style="padding-right:2px;"> 
           <input type="hidden" name="RequestID" id="RequestID" value="<?php echo $ProductValue; ?>">
		   <input type="hidden" name="Reference_Code" id="Reference_Code" value="<?php echo $Reference_Code; ?>">
        <input type="text" name="activation_code" id="activation_code" onChange="intOnly(this);" onKeyPress="intOnly(this)" onKeyUp="intOnly(this);"  maxlength="4"  />     </td></tr>
                        <tr><td>&nbsp;</td> <td > <input type="submit" name="val" value="Get Quote" style="width:154px; background-color: #D02037; color:#FFFFFF; font-weight:700; height:25px;" />
				  </td></tr>
                      <tr>
                        <td colspan="2" align="center" style="padding:5px;">To choose best suited card</td>
                      </tr>
                 </table></div>
        </form>        
     </td>
      </tr>      
          </table>
</td>
      </tr>
      
    </table></td>
  </tr>
</table>
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
<? } ?>
	 
</body>
</html>


