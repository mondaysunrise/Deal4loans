<?php
	require 'scripts/session_check.php';
	require 'scripts/functions.php';
	require 'scripts/db_init.php';
	
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
	$IsPublic =1;
	$Day=FixString($day);
	$Month=FixString($month);
	$Year=FixString($year);
	$DOB=$Year."-".$Month."-".$Day;
	$Type_Loan = "CreditCard";
	$source = FixString($source);
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
	$Reference_Code = generateNumber(5);
	$No_of_Banks = $_REQUEST["No_of_Banks"];
	$ABMMU_flag = $_REQUEST["adty_brl"];
	$Salary_Account = $_REQUEST["salary_account"];
	$accept = $_REQUEST["accept"];

	$getDOB = $Year."".$Month."".$Day;
	$Age = DetermineAgeFromDOB($getDOB);
	
	$checkPincodeSql = "select * from barclays_pincode_list where pincode='".$Pincode."' and status=1"; 
list($checkPincode,$checkPincodeQuery)=MainselectfuncNew($checkPincodeSql,$array = array());
	
	$gethdfccccompany='select company_category from HDFC_CC_Company_List where hdfc_company_name="'.$Company_Name.'"';
// echo $getcompany;
list($recordcounthdfccc,$grow)=MainselectfuncNew($gethdfccccompany,$array = array());
if($recordcounthdfccc>0)
	{
$hdfc_cccategory = $grow[0]["company_category"];
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
		Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
	function  Insertcpp($ProductValue, $Name,$City, $Phone, $DOB, $Email, $CC_Holder )
	{
		$Dated = ExactServerdate();	
		$dataInsert = array('CPP_RequestID'=>$ProductValue, 'CPP_Product'=>'4', 'CPP_Name'=>$Name, 'CPP_City'=>$City, 'CPP_Mobile_Number'=>$Phone, 'CPP_DOB'=>$DOB, 'CPP_Dated'=>$Dated, 'CPP_Email'=>$Email, 'CPP_CC_Holder'=>$CC_Holder);
		$table = 'cpp_card_protection_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
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
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr = count($myrow)-1;
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-credit-card-lead.php'"."</script>";
			}
			else
			{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Cpp_Compaign'=>$cpp_card_protect, 'Pincode'=>$Pincode, 'No_of_Banks'=>$No_of_Banks, 'Company_HDFC_Cat'=>$Company_HDFC_Cat, 'ABMMU_flag'=>$ABMMU_flag, 'Company_ICICI_Cat'=>$Company_ICICI_Cat, 'Salary_Account'=>$Salary_Account, 'Privacy'=>$accept);

				//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Cpp_Compaign'=>$cpp_card_protect, 'Pincode'=>$Pincode, 'No_of_Banks'=>$No_of_Banks, 'Company_HDFC_Cat'=>$Company_HDFC_Cat, 'ABMMU_flag'=>$ABMMU_flag, 'Company_ICICI_Cat'=>$Company_ICICI_Cat, 'Salary_Account'=>$Salary_Account, 'Privacy'=>$accept);
						
			}
			
			$ProductValue = Maininsertfunc ("Req_Credit_Card", $dataInsert);
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

			$_SESSION['Temp_LID'] = $ProductValue;
			//echo $Net_Salary; 
			if($Net_Salary<100)
			{
				header ("Location: apply-credit-card-salary-correction.php");
				exit();
			}
			else
			{
			$SMSMessage = "Please use this code: ".$Reference_Code."  to activate you loan request at deal4loans.com";

			if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMSMessage, $Phone);
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Credit Card</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="stylesheet" href="css/creditcards1.css" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-cclist.js"></script>
 <style type="text/css">
.bldtxt{
font-weight:bold;
line-height:11px;
color:#4f4d4d;
font-family:verdana;
font-size:11px;
}
input{
	margin:0px;
	padding:0px;
	border:1px solid #878787;
}

select{
	margin:0px;
	padding:0px;
	border:1px solid #878787;

}

.field{
font-family:verdana;
font-size:11px;
color:#000000;
}
body {
color:#292323;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
line-height:16px;
}

</style>
<script>

function ckhcreditcard(Form)
{	
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
var myOption;


if((Form.activation_code.value=='Mobile') || (Form.activation_code.value=='') || Trim(Form.activation_code.value)==false)
{
alert("Kindly fill in your Activation Code!");
Form.activation_code.focus();
return false;
}

if(Form.City.selectedIndex==0)
{
	alert("Please enter City Name to Continue");
	Form.City.focus();
	return false;
}

if(Form.salary_account.selectedIndex==0)
{
	alert("Please select Salary Account in which bank ");
	Form.salary_account.focus();
	return false;
}
  
	
	if(Form.Email.value=="Email Id")
	{
		Form.Email.value=" ";
	}

}

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}


function addtooltip()
{

		var ni = document.getElementById('myDiv');
		if(ni.innerHTML=="")
		{
				ni.innerHTML = 'Enter Activation code sent on your mobile.';
		}
		return true;
}


</script>

</head>
<body>
<table width="1004" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
        
		   <tr>            <td colspan="4"><img src="/new-images/d4l-sml-logo.gif" alt="Deal4loans"  onclick="javascript:location.href='http://www.deal4loans.com/'" height="73px"/></td></tr>
         
          <tr>
            <td colspan="4"><table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #CCCCCC;">
              <tr>
                <td class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; " >&nbsp;</td>
              </tr>
              <tr>
                <td height="30" bgcolor="#FDF4AE" class="bldtxt" style="font-size:17px; font-family:Arial, Helvetica, sans-serif; color:#000000; padding-left:20px;" >Why Deal4loans.com</td>
              </tr>
              <tr>
                <td><table width="550" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td style="padding-left:15px; "><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="35" height="25" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="15" height="17" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; line-height:24px;  ">Over 6 lakh customers have taken quote at Deal4loans.com</div></td>
                      </tr>
                      
                      <tr>
                        <td width="30" height="25" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="15" height="17" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; line-height:24px;  ">Credit Card Offers are free for customers.</div></td>
                      </tr>
					                      <tr>
                        <td width="30" height="25" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="15" height="17" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; line-height:24px;  ">Deal4loans.com has tie ups with all Credit Card Banks in India.</div></td>
                      </tr>
					   <tr>
                        <td width="30" height="25" align="center" valign="middle"><img src="new-images/pl/arrow.gif" width="15" height="17" /></td>
                        <td><div style="color:#7e5a09; font-size:13px; font-weight:bold; line-height:24px;  ">Your details will not be shared with any bank unless you opt for it.</div></td>
                      </tr>
                      
                    </table></td>
                  </tr>
                </table></td>
              </tr>
			  <tr>
                <td width="550" height="10" align="left" valign="middle" bgcolor="#FFFFFF" style="font-family:verdana; font-size:16px; color:#000000; font-weight:bold;"></td>
              </tr>
			  
              <tr>
                <td height="45" bgcolor="#FDF4AE" style="font-family:arial; font-size:16px; color:#000000; font-weight:bold; padding-left:20px;">
                       Instant Online Credit Card applications from Hdfc Bank, Standard Chartered, ICICI Bank, Sbi, Amex</td>
              </tr>
			  <tr><td align="left" valign="middle" height="auto" style="font-family:arial; font-size:12px; color:#000000; padding:5px;"><table width="100%"><tr><td><img src="/new-images/thumb/hdfc-logo.jpg" height="67" width="146" /></td><td><img src="/new-images/thumb/icici.jpg" height="67" width="146" /></td><td><img src="/new-images/thumb/stanchart.jpg" height="67" width="146" /></td><td><img src="/new-images/thumb/amex-logo.jpg" height="67" width="146" /></td></tr></table></td></tr>
              <tr>
                <td  height="30" bgcolor="#FDF4AE" style="font-family:arial; font-size:17px; color:#000000; font-weight:bold; padding-left:20px;">Safety Tips for using a Credit Card.</td>
              </tr>
                           <tr>
                <td align="left" valign="middle" height="auto" style="font-family:arial; font-size:12px; color:#000000; padding:10px;"><font  color="#05394A">&bull;</font> Sign your card as soon as you receive it.<br />
                  <font  color="#05394A">&bull;</font> You will also receive the PIN number after a few days. Keep your
             PIN/account number safe.<br />
             <font  color="#05394A">&bull;</font> Every time you use your card, be aware when your card is being swiped
             by the cashier so as to ensure no misuse &nbsp;&nbsp;of your card takes place.<br />
             <font  color="#05394A">&bull;</font> When making payment with your card, make sure you check if it is your credit card that the cashier has returned.<br />
             <font  color="#05394A">&bull;</font> Do not forget to verify your purchases with your billing statements.<br />
             <font  color="#05394A">&bull;</font> After using your card at an ATM, do not throw your receipt behind.</td>
              </tr>
              <tr>
                <td height="5" align="center" valign="middle"></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
        <td width="322" valign="top"><table  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table width="289"  border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td width="296" height="88" align="left" valign="top"><img src="new-images/cc/cc_bnrstep2.gif" width="289" height="88" /></td>
              </tr>
              <tr>
                <td valign="top" style="border-left:1px solid #c2c2c2; border-right:1px solid #c2c2c2;">
				     
			
<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
			 <form name="car_loan_verify" action="credit-card-thank.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); ">
         <input type="hidden" name="RequestID" id="RequestID"  value="<? echo $ProductValue; ?>" >
	 <input type="hidden" name="Reference_Code" id="Reference_Code" value="<? echo $Reference_Code; ?>">  
	 <input type="hidden" name="pageName" id="pageName" value="page_forcampaign"> 
			
				
				<tr><Td width="112" height="26" class="bldtxt">Activation Code</Td>
				<td><input name="activation_code" id="activation_code" type="text" style="width:100px; height:18px;" maxlength="5" onfocus="addtooltip();"/></td></tr>
				<tr><td colspan="2" class="bldtxt"><div id="myDiv" style="color:#7d0606; font-family:Verdana; font-size:11px;"></div></td></tr>
				<tr align="left">
				  <Td width="112" height="26" class="bldtxt">Occupation</Td>
				  <Td width="161"><select   style="width:140px;"  name="Employment_Status" id="Employment_Status" class="field" >
        <option selected value="-1">Employment Status</option>
        <option  value="1">Salaried</option>
        <option value="0">Self Employed</option>
      </select></Td>
				  </tr>
				
<tr align="left">
				  <Td width="112" height="26" class="bldtxt">Salary Account</Td>
				  <Td width="161"><select style="width:142px; height:18px;  " class="field"  name="salary_account" id="salary_account">
          <option name="">Please Select</option>
				  <option value="HDFC Bank">HDFC Bank</option>
				  <option value="ICICI Bank">ICICI Bank</option>
				  <option value="Kotak Bank">Kotak Bank</option>
				  <option value="Standard Chartered">Standard Chartered</option>
				  <option value="Others">Others</option>
      </select>	  </Td>
				  </tr>
				
				<tr align="center">
				  <Td colspan="2"><br /><input type="image" name="Submit"  src="new-images/choose-cc.jpg"  style="width:200px; height:29px; border:none; " /></Td>
				  </tr>
				   <tr><td class="bldtxt" colspan="2">&nbsp;</td></tr>
			  <tr><td class="bldtxt" colspan="2">&nbsp;</td></tr>
				  </form>
                </table>
				</td>
              </tr>
			 
              <tr>
                <td height="53" valign="top"><img src="images/cl/frm-btm.gif" width="289"   height="21"></td>
              </tr>
              <tr>
                <td valign="middle" height="120">&nbsp;</td>
              </tr>
            </table></td>
           
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <Tr>
  <td>&nbsp;</td>
  </Tr>
</table>
<? if($source=="komlicc" && ($Net_Salary>=360000) && ( $City=="Ahmedabad" || $City=="Kolkata" || $City=="Jaipur" || $City=="Chandigarh" || $City=="Lucknow" || $City=="Jalandhar" || $City=="Cochin" || $City=="Nagpur" || $City=="Delhi" || $City=="Noida" || $City=="Gurgaon" || $City=="Mumbai" || $City=="Thane" || $City=="Bangalore" || $City=="Chennai" || $City=="Hyderabad" || $City=="Pune" || $City=="Surat" || $City=="Coimbatore" || $City=="Gaziabad" ) && $City!="Others" && $City!="" && $City_Other=="")
{ $uniqueid=$ProductValue."cc"; $Email
?>
<script src="http://partners.komli.com/lead_third/10204/mobileno,<? echo $uniqueid; ?>,<? echo $Email; ?>"></script>
<noscript><img src="http://partners.komli.com/track_lead/10204/mobileno,<? echo $uniqueid; ?>,<? echo $Email; ?>"></noscript>
<? } ?>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
