<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//require 'getlistofeligiblebidders.php';
	error_reporting();
	
//	print_r($_REQUEST);
	
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


	
	$UserID = $_SESSION['UserID'];
	$Full_Name = $_REQUEST["Full_Name"];
	//$LName = $_REQUEST["LName"];
	$Name= $Full_Name;
	$Email = $_REQUEST["Email"];
	$Phone = $_REQUEST["Phone"];
	$Pancard = $_REQUEST["Pancard"];
	$CC_Holder = $_REQUEST["CC_Holder"];
	$Card_Vintage = $_REQUEST["Card_Vintage"];
	$City = $_REQUEST["City"];
	$City_Other = $_REQUEST["City_Other"];
	$Company_Name = $_REQUEST["Company_Name"];
	if(is_numeric($Company_Name))
	{
		$getCompanySql = "select company_name from cl_company_list_hdfc where clcomplistid= '".$plcompanyid."'";
		$getCompanyQuery = ExecQuery($getCompanySql);
		$Company_Name = mysql_result($getCompanyQuery,0,'company_name');
	}
		
	
	$Net_Salary =$_REQUEST["Net_Salary"];
	$IsPublic =1;
	$Day=$_REQUEST["day"];
	$Month=$_REQUEST["month"];
	$Year=$_REQUEST["year"];
	$DOB=$Year."-".$Month."-".$Day;
	$Type_Loan = "CreditCard";
	$source = $_REQUEST["source"];
	$Reference_Code = $_REQUEST["Reference_Code"];
	$Employment_Status = $_REQUEST["Employment_Status"];
	$Accidental_Insurance = $_REQUEST["Accidental_Insurance"];
	$cpp_card_protect = $_REQUEST["cpp_card_protect"];
	$Ibibo_compaign = $_REQUEST["Ibibo_compaign"];
	$hdfclife = $_REQUEST["hdfclife"];
	$Referrer = $_REQUEST['referrer'];
	$source = $_REQUEST['Source'];
	$Section = $_REQUEST['section'];
	$Creative = $_REQUEST['creative'];
	$Pincode = $_REQUEST["Pincode"];
	$Reference_Code = generateNumber(4);
	$No_of_Banks = $_REQUEST["No_of_Banks"];
	$ABMMU_flag = $_REQUEST["adty_brl"];
	$Salary_Account = $_REQUEST["Salary_Account"];
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
	

	if($_SESSION=="")
	{
		$_SERVER['Temp_Type'] = "CreditCard";
		$_SERVER['Temp_Type_Loan']="Req_Credit_Card";
		$_SERVER['Temp_Name'] = $Name;
		$_SERVER['Temp_FName'] = $Name;
		$_SERVER['Temp_Phone'] = $Phone;
		$_SERVER['Temp_Pancard'] = $Pancard;
		$_SERVER['Temp_DOB'] = $DOB;
		$_SERVER['Temp_Email'] = $Email;
		$_SERVER['Temp_Company_Name'] = $Company_Name;
		$_SERVER['Temp_Employment_Status'] = $Employment_Status;
		$_SERVER['Temp_City'] = $City;
		$_SERVER['Temp_City_Other'] = $City_Other;
		$_SERVER['Temp_Net_Salary'] = $Net_Salary;
		$_SERVER['Temp_IsPublic'] = $IsPublic;
		$_SERVER['Temp_CC_Holder'] = $CC_Holder;
		$_SERVER['Temp_Reference_Code'] = $Reference_Code;
		$_SERVER['Temp_Phone'] = $Phone;
	
	}
	else
	{
		$_SESSION['Temp_Type'] = "CreditCard";
		$_SESSION['Temp_Type_Loan']="Req_Credit_Card";
		$_SESSION['Temp_Name'] = $Name;
		$_SESSION['Temp_Pancard'] = $Pancard;
		$_SESSION['Temp_FName'] = $Name;
		$_SESSION['Temp_Phone'] = $Phone;
		$_SESSION['Temp_DOB'] = $DOB;
		$_SESSION['Temp_Employment_Status'] = $Employment_Status;
		$_SESSION['Temp_Email'] = $Email;
		$_SESSION['Temp_Company_Name'] = $Company_Name;
		$_SESSION['Temp_City'] = $City;
		$_SESSION['Temp_City_Other'] = $City_Other;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		$_SESSION['Temp_CC_Holder'] = $CC_Holder;
		$_SESSION['Temp_Reference_Code'] = $Reference_Code;
		$_SESSION['Temp_Phone'] = $Phone;
	}
	
	$IP = getenv("REMOTE_ADDR");
	
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}
	
	function  Insertcpp($ProductValue, $Name,$City, $Phone, $DOB, $Email, $CC_Holder )
	{
		$Sql = "INSERT INTO cpp_card_protection_leads ( CPP_RequestID , `CPP_Product` , `CPP_Name`, `CPP_City`, `CPP_Mobile_Number`, `CPP_DOB` , `CPP_Dated`, CPP_Email, CPP_CC_Holder  ) VALUES ('".$ProductValue."', '4','".$Name."','".$City."', '".$Phone."' ,'".$DOB."', Now(), '".$Email."','".$CC_Holder."')";
		$query = mysql_query($Sql);
		//echo "Edelweiss:".$Sql."<br>";
		//exit();
	}
	function  Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email )
	{
		$Sql = "INSERT INTO ibibo_compaign_leads ( ibibo_product , ibibo_requestid , ibibo_name,  ibibo_city, ibibo_mobile, ibibo_dob , ibibo_car_name,  ibibo_dated,ibibo_email ) VALUES ( '4','".$ProductValue."','".$Name."','".$City."', '".$Phone."' ,'".$DOB."', '".$Ibibo_compaign."', Now(),'".$Email."')";
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
			
			$getdetails="select RequestID From Req_Credit_Card Where (Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9971396361','9811215138','9999047207','9891601984') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
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
				$InsertProductSql = "INSERT INTO Req_Credit_Card( UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, DOB, IsPublic, Dated,  Reference_Code, source, Pancard, CC_Holder,Card_Vintage,IP_Address,Referrer,Creative,Section,Updated_Date,Accidental_Insurance, Cpp_Compaign, Pincode, No_of_Banks,Company_HDFC_Cat,ABMMU_flag,Company_ICICI_Cat,Salary_Account,Privacy)	VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Net_Salary', '$DOB', '$IsPublic', Now(), '$Reference_Code', '$source', '$Pancard','$CC_Holder','$Card_Vintage','$IP','$Referrer','$Creative','$Section',Now(),'$Accidental_Insurance','".$cpp_card_protect."', '".$Pincode."','".$No_of_Banks."','".$Company_HDFC_Cat."','".$ABMMU_flag."','".$Company_HDFC_Cat."','".$Salary_Account."','".$accept."' )"; 
				//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID1 = mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Credit_Card( UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, DOB, IsPublic, Dated,  Reference_Code, source, Pancard, CC_Holder,Card_Vintage,IP_Address,Referrer,Creative,Section, Updated_Date, Accidental_Insurance, Cpp_Compaign, Pincode, No_of_Banks, Company_HDFC_Cat, ABMMU_flag, Salary_Account,Privacy, Company_ICICI_Cat)			VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Net_Salary', '$DOB', '$IsPublic', Now(), '$Reference_Code', '$source', '$Pancard','$CC_Holder','$Card_Vintage','$IP','$Referrer','$Creative','$Section',Now(),'$Accidental_Insurance','".$cpp_card_protect."','".$Pincode."' ,'".$No_of_Banks."','".$Company_HDFC_Cat."', '".$ABMMU_flag."', '".$Salary_Account."','".$accept."','".$Company_HDFC_Cat."')";
				//echo "<br>else".$InsertProductSql;
				
				
				$SMSMessage = "Thanks for your Credit Card Application.Please apply at the choices given to you .If any chance you are busy, the offers have been sent to your email.Keep your Pan Number handy when you apply.";
				
				//if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
				
			}
		//	echo $InsertProductSql;
			$InsertProductQuery = ExecQuery($InsertProductSql);
			
			$ProductValue = mysql_insert_id();
			
			if($cpp_card_protect=="1" && $CC_Holder==1)
			{
				Insertcpp($ProductValue, $Name,$City, $Phone, $DOB,$Email, $CC_Holder);
			}
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
			$Product=4;
			Insert_HdfcLife($Name, $strcity, $Phone, $DOB, $Email, $Net_Salary, $Product, $ProductValue );
		}

			if(strlen($Ibibo_compaign)>0)
			{
				Insert_ibibo($ProductValue, $Name, $strcity, $Phone, $DOB, $Ibibo_compaign, $Email);
			}
			
			$_SESSION['Temp_LID'] = $ProductValue;
			//echo $Net_Salary; 
			if($Net_Salary<100)
			{
				header ("Location: apply-credit-card-salary-correction.php");
				exit();
			}
			if($Net_Salary>=300000)
			{
				$SMSMessage = "Thanks for your Credit Card Application.Please apply at the choices given to you .If any chance you are busy, the same offers have been sent to your email. Keep your Pan Number handy when you apply.";
				if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);
			}
		}
		}
		
		
		
		//Code Added to mailtocommonscript.php
		$FName = $Name;
		$Checktosend="getthank_individual";
		include "scripts/mailatcommonscript.php";
		
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		if($Name)
		$SubjectLine = $Name.", Learn to get Best Deal on Credit Card";
		else
		$SubjectLine = "Learn to get Best Deal on Credit Card";
		//echo $Type_Loan;
		if(isset($Type_Loan))
		{
		//	mail($Email, $SubjectLine, $Message2, $headers);
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


//exit();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META HTTP-EQUIV="Refresh" CONTENT="8;URL=credit-card-thank.php"> 
<title>Credit Card Processing</title>
</head>
<body style="margin:0px; padding:0px;">
<table width="1008" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="1008" align="center" valign="middle" style="background:url(/images/logos/bg1.gif) repeat;"><table width="980" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="80" align="center" valign="middle"><table width="980" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="200" height="80" align="center" valign="middle"><img src="/new-images/d4l-logo.gif" /></td>
            <td width="776" height="80" align="right" valign="bottom" style="padding-right:15px; font-family:'trebuchet MS'; font-size:16px; font-weight:bold; color:#000000;">Credit Card Request</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="980" height="400" align="center" style="font-family:verdana; font-size:14px; color:#0099FF; ">
        <table cellpadding="2" cellspacing="2" border="0">
        <tr><td align="center" style="padding-top:3px;">
             <img src="/images/progress-bar.gif" width="220" height="19" /><br />
          Search in Progress<br /><br /><br />
           Thanks for applying on deal4loans.com. Your Card Request is being scanned with the following Banks.
          </td></tr>
          <tr>
        <td width="980" height="80" align="center" valign="middle">
		<script language="JavaScript1.2">
var marqueewidth="950px"
//Specify the marquee's height
var marqueeheight="170px"
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


