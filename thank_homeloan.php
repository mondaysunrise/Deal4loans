<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$page_Name = "LandingPage_HL";

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
	

	function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'personal',
		'Req_Loan_Home' => 'home',
		'Req_Loan_Car' => 'car',
		'Req_Credit_Card' => 'cc',
		'Req_Loan_Against_Property' => 'property',
		'Req_Life_Insurance' => 'insurance'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

	$Name = $_POST['Full_Name'];
	$Activate = $_POST['Activate'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	$Net_Salary = $_POST['Net_Salary'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	$Referrer=$_REQUEST['referrer'];
	$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");
	$IsPublic = 1;


	function InsertTataAig($RequestID, $ProductName)
	{
	//	echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = ExecQuery("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		$RowGetDate = mysql_fetch_array($GetDateSql);
		
		$TDated = $RowGetDate['Dated'];
		$TCity = $RowGetDate['City'];
		$Mobile = $RowGetDate['Mobile_Number'];
		$Product_Name = "2";
		
		$Sql = "INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, `Mobile_Number`, `T_Dated` ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";
		$query = mysql_query($Sql);
		//echo "tataaig:".$Sql."<br>";
		//exit();

	}
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where RequestID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}
	
		$crap = " ".$Name." ".$Email." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			$CheckQuery = ExecQuery($CheckSql);
			//echo "<br>".$CheckSql;
			$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = mysql_result($CheckQuery, 0, 'UserID');
				$InsertProductSql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$Net_Salary', '$Loan_Amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(),'$Accidental_Insurance' )"; 
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID = mysql_insert_id();
				$InsertProductSql = "INSERT INTO ".$Type_Loan." (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$Net_Salary', '$Loan_Amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(),'$Accidental_Insurance' )";
				//echo "<br>else".$InsertProductSql;
			}
			
			$InsertProductQuery = ExecQuery($InsertProductSql);
			$ProductValue = mysql_insert_id();
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Home");
				}
			//exit();
			
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get banks contacts & quotes. And help us serve you better.";
			if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($FName)
				$SubjectLine = $FName.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
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
<title>Untitled Document</title>
<link href="css/homeloan.css" rel="stylesheet" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript">
function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if(ni.innerHTML=="")
		{
		
			if(document.homeloan_form.Property_Identified.value="on")
			{
				ni1.innerHTML = '';
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0" width="100%"><tr><td>&nbsp;</td><td class="form-text" align="left"  width="200"  height="20">Property Location 	</td><td  class="form-text" width="196" align="right"  height="20"><select size="1" align="center"  name="Property_Loc" >	<?=getCityList1($Property_Loc)?></select></td></tr>	</table>';
			}
			
		}
			
		return true;
	}
function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if((ni.innerHTML!="")|| (ni1.innerHTML==""))
		{
		
			if(document.homeloan_form.Property_Identified.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				ni1.innerHTML = '';
			}
		}
		
		return true;

	}
function addElement()
{
	
		var ni = document.getElementById('MMmyDiv');
var newdiv = document.createElement('div');
		
		if(ni.innerHTML=="")
		{
			
				ni.innerHTML = '<table border="0"><tr><td>&nbsp;</td><td align="left" class="form-text" width="200" height="20">Reconfirm Mobile No.</td>	<td colspan="3" align="left" width="300" height="20" ><input  name="RePhone" id="RePhone" size="18" type="text"  maxlength="10"></td></tr></table>';
			
				ni.appendChild(newdiv);
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		//return true;
		}
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}
		function ckhhomeloan(FormName)
	{
		var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
var myOption;
		var btn2;
		var btn3;
		var myOption;
		var i;
		var btn;
		var btn5;
		var RePhone;
		var cnt;
		/*if(FormName.Reference_Code1.value=="")
		{
			if(!FormName.confirm.checked)
			{
				alert("if you havnt received activation code click check box.");
				FormName.confirm.focus();
				return false;
			}
			else if(FormName.confirm.checked)
			{
				if(FormName.RePhone.value=="")
				{
					alert("Please Re confirm your mobile number again");
					FormName.RePhone.focus();
					return false;
				}
			}
		}*/

		if((space.test(FormName.day.value)) || (FormName.day.value=="dd")  )
{
alert("Kindly enter your Date of Birth");
FormName.day.select();
return false;
}

else if(!num.test(FormName.day.value))
{
alert("Kindly enter your Date of Birth(numbers Only)");
FormName.day.select();
return false;
}

else if((FormName.day.value<1) || (FormName.day.value>31))
{
alert("Kindly Enter your valid Date of Birth(Range 1-31)");
FormName.day.select();
return false;
}

else if((space.test(FormName.month.value)) || (FormName.month.value=="mm"))
{
alert("Kindly enter your Month of Birth");
FormName.month.select();
return false;
}

else if(!num.test(FormName.month.value))
{
alert("Kindly enter your Month of Birth(numbers Only)");
FormName.month.select();
return false;
}

else if((FormName.month.value<1) || (FormName.month.value>12))
{
alert("Kindly Enter your valid Month of Birth(Range 1-12)");
FormName.month.select();
return false;
}

else if((FormName.month.value==2) && (FormName.day.value>29))
{
alert("Month February cannot have more than 29 days");
FormName.day.select();
return false;
}

else if((space.test(FormName.year.value)) || (FormName.year.value=="yyyy"))
{
alert("Kindly enter your Year of Birth");
FormName.year.select();
return false;
}

else if(!num.test(FormName.year.value))
{
alert("Kindly enter your Year of Birth(numbers Only) !");
FormName.year.select();
return false;
}

else if((FormName.day.value > 28) && (parseInt(FormName.month.value)==2) && ((FormName.year.value%4) != 0))
{
alert("February cannot have more than 28 days.");
FormName.day.select();
return false;
}

else if(FormName.year.value.length != 4)
{
alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
FormName.year.select();
return false;
}
else if((FormName.year.value < "1945") || (FormName.year.value >"1989"))
{
alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
FormName.year.select();
return false;
}
else if(FormName.year.value > parseInt(mdate-21) || FormName.year.value < parseInt(mdate-62))
{
alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
FormName.year.select();
return false;
}

else if((parseInt(FormName.day.value)==31) && ((parseInt(FormName.month.value)==4)||(parseInt(FormName.month.value)==6)||(parseInt(FormName.month.value)==9)||(parseInt(FormName.month.value)==11)||(parseInt(FormName.month.value)==2)))
{
alert("Cannot have 31st Day");
FormName.day.select();
return false;
}
if(FormName.Residence_Address.value=="")
{
alert("Kindly fill in your Residence address!");
FormName.Residence_Address.focus();
return false;
}
if (FormName.Pincode.value=="" || FormName.Pincode.value=='Pincode' || FormName.Pincode.value=='Pincod')
	{
		alert("Please enter Pincode.");
		FormName.Pincode.focus();
		return false;
	}
	if (FormName.Pincode.value!="")
	{
		if(FormName.Pincode.value.length < 6)
	{
		alert("Kindly fill in your Pincode(6 Digits)!");
		FormName.Pincode.focus();
		return false;
	}
	}
	if(FormName.Employment_Status.selectedIndex==0)
{
	alert("Please select employment status ");
	FormName.Employment_Status.focus();
	return false;
}

		if(FormName.Company_Name.value=="")
				{
					alert("Please fill Company Name ");
					FormName.Company_Name.focus();
					return false;
				}

	
	myOption = -1;
		for (i=FormName.Property_Identified.length-1; i > -1; i--) {
			if(FormName.Property_Identified[i].checked) {
				if(i==0)
				{
					if(FormName.Property_Loc.selectedIndex==0)
					{
						alert('Plese select city where property is located');
						FormName.Property_Loc.focus();
						return false;
					}

					
				}
					myOption = i;

				
			}
		}
	
		if (myOption == -1) 
		{
			alert("please select you have identified any property or not");
			return false;
		}
	

		if (FormName.Budget.selectedIndex==0)
			{
				alert("Please estimated market value of the property");
				FormName.Budget.focus();
				return false;
			}
		if (FormName.Loan_Time.selectedIndex==0)
			{
				alert("Please enter when you are planning to take loan");
				FormName.Loan_Time.focus();
				return false;
			}
	
		return true;
	}
	
	function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}
	function containsdigit(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
{
return true;
}
}
return false;
}
function containsalph(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
{
return true;
}
}
return false;
}
</script>
</head>

<body bgcolor="#FEF8E2">

<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top"><img src="images/hl/top-header.jpg" width="600" height="169" /></td>
  </tr>
  <tr>
    <td valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><table width="258" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2"><img src="images/hl/3-steps-top.jpg" width="258" height="10" /></td>
          </tr>
          <tr>
            <td width="22" height="105" bgcolor="#A06E36">&nbsp;</td>
            <td width="236" height="90" bgcolor="#A06E36" class="easy-steps">Just 3<br />
              easy steps!</td>
          </tr>
          <tr>
            <td height="121" bgcolor="#E0C563">&nbsp;</td>
            <td bgcolor="#E0C563" ><table width="200" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="24" align="center" valign="top" bgcolor="#E0C563">&raquo;</td>
                <td width="180" bgcolor="#E0C563" class="step" >Post your Home loan requirement. </td>
              </tr>
              <tr>
                <td align="center" valign="top" bgcolor="#E0C563">&raquo;</td>
                <td bgcolor="#E0C563" class="step">Get &amp; compare Home Loan offers.</td>
              </tr>
              <tr>
                <td align="center" valign="top" bgcolor="#E0C563">&raquo;</td>
                <td bgcolor="#E0C563" class="step">Get the best deal for your home loan.</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#E0C563"><img src="images/hl/3-steps-bottom.jpg" width="258" height="10" /></td>
          </tr>
          <tr>
            <td colspan="2" ><table width="258" border="0" cellpadding="0" cellspacing="0" bgcolor="#FEF8E2">
              <tr>
                <td width="22" height="30" bgcolor="#FEF8E2">&nbsp;</td>
                <td height="40" colspan="2" bgcolor="FEF8E2" style=" font-family:Verdana, Arial, Helvetica, sans-serif;  font-size:15px; font-weight:bold; color:#A06E36">www.deal4loans.com</td>
              </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td colspan="2" bgcolor="FEF8E2" class="points">The one-stop shop for best on <img src="images/hl/key.jpg" width="106" height="66" align="right" />Home loan requirements 
                  Now get offers from ICICI, HDFC, UTI, Citibank, Kotak, LIC and IDBI and choose the best deal!</td>
              </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td colspan="2" bgcolor="FEF8E2"  style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-style:italic; font-weight:bold; font-size:32px; font-weight:bold; color:#86551D;">Helpful tips</td>
              </tr>
              <tr>
                <td height="25" bgcolor="#FEF8E2">&nbsp;</td>
                <td height="30" colspan="2" bgcolor="FEF8E2"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-style:italic; font-size:13px; font-weight:bold;">to get the best Home Loan deal. </td>
              </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td colspan="2" bgcolor="FEF8E2" class="text-help">Home loans are provided based on the market value, mainly estimation given by banks or the registration value of the property. Home loan is not a one-time decision; do review the market periodically before availing them. Customers tend to make mistakes while entering into deals, which may not be beneficial for them, so better compare all the variables before signing a loan agreement by different banks. The various parameters that you need to compare on Home loan are</td>
              </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td width="23" align="center" bgcolor="FEF8E2">&raquo;</td>
                <td width="213" bgcolor="FEF8E2" class="points">Eligibility</td>
              </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td align="center" bgcolor="FEF8E2">&raquo;</td>
                <td bgcolor="FEF8E2" class="points">Interest rates best suited. </td>
              </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td align="center" bgcolor="FEF8E2">&raquo;</td>
                <td bgcolor="FEF8E2" class="points">Fixed interest loans or Floating.</td>
              </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td align="center" bgcolor="FEF8E2">&raquo;</td>
                <td bgcolor="FEF8E2" class="points">Other costs.</td>
              </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td align="center" bgcolor="FEF8E2">&raquo;</td>
                <td bgcolor="FEF8E2" class="points">Document required.</td>
              </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td align="center" bgcolor="FEF8E2">&raquo;</td>
                <td bgcolor="FEF8E2" class="points">Penalties.</td>
              </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td align="center" bgcolor="FEF8E2">&nbsp;</td>
                <td bgcolor="FEF8E2"><div align="right"><a href="http://www.deal4loans.com/Contents_Home_Loan_Mustread.php"><img src="images/hl/know-more.jpg" width="98" height="20" border="0" /></a></div></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td valign="top"><table width="258" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24" height="29" colspan="3" align="left" valign="top"><table width="342" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="342" height="32" align="left" valign="top"><img src="images/hl/frm-top-bg.jpg" width="342" height="32" /></td>
              </tr>
              <tr>
                <td><table width="342" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="24" align="left" valign="top"><table width="9%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="24" height="214" align="left" valign="top"><img src="images/hl/frm-lf-tp.jpg" width="24" height="214" /></td>
                      </tr>
                      <tr>
                        <td width="24" height="200" background="images/hl/frm-bot-bg.gif" style="background-repeat:repeat-y;">&nbsp;</td>
                      </tr>
                    </table></td>
                    <td width="302" valign="top" bgcolor="#FFFFFF">
					
					<form  name="homeloan_form" id="homeloan_form" action="apply-home-loan-thank.php" method="post" onSubmit="return ckhhomeloan(document.homeloan_form); " >
					<table width="284" align="center" cellpadding="0" cellspacing="4">
					
                      <tr>
                        <td height="30" colspan="3" align="center" style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-size:18px; color:#666666; font-weight:bold;">Home Loan Request </td>
                      </tr>
                      <tr>
                        <td height="25" colspan="3" align="center" style="font-size:16px; color:#999999; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold;">Step 2 of 2 </td>
                      </tr>
                      <tr>
                        <td width="5">&nbsp;</td>
                        <td height="25" colspan="2" align="center" style="font-size:15px; color:#999999; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold;">Please tell more about yourself </td>
                      </tr>
					   <tr>
					   <td><input type="hidden" value="HomeLoan" name="type"></td></tr>
                     <!-- <tr>
                        <td>&nbsp;</td>
                        <td width="117" height="25" class="form-text">Activation Code? </td>
                        <td width="173" align="right"><input name="Reference_Code1" id="Reference_Code1" type="text" style="width:120px;"/></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td height="25" colspan="2" align="left" class="form-text"><input name="confirm" id="confirm" type="checkbox" style="width:auto" value="hello" onClick="addElement();"/>
                          if you havent received activation code sms </td>
                      </tr>
					  <tr>
					        <td colspan="3" class="formtxt"><div id="MMmyDiv"></div></td>-->
    </tr>
	<tr>
                          <td>&nbsp;</td>
                          <td width="68" class="form-text">DOB</td>
                          <td width="222" align="right"><input name="day" type="text" id="day" style="width:42px;" value="dd" onBlur="onBlurDefault(this,'dd');" onFocus="onFocusBlank(this,'dd');"  onKeyPress="intOnly(this);"/>
                              <input name="month" type="text" style="width:42px;" value="mm" id="month" onBlur="onBlurDefault(this,'mm');"  onKeyPress="intOnly(this);" onFocus="onFocusBlank(this,'mm');"/>
                              <input name="year" type="text" maxlength="4" onKeyPress="intOnly(this);" style="width:42px;" id="year" value="yyyy" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');"/></td>
                        </tr>
						  <tr>
                          <td>&nbsp;</td>
                          <td class="form-text">Current Residence Address</td>
                          <td align="right"><input name="Residence_Address" id="Residence_Address" type="text" style="width:155px; height:35px" /></td>
                        </tr>
						 <tr>
                          <td>&nbsp;</td>
                          <td colspan="2" class="form-text"><input name="Pincode" id="Pincode" maxlength="6" type="text" value="Pincode" style="width:265px;" onBlur="onBlurDefault(this,'Pincod');" onFocus="onFocusBlank(this,'Pincod');"  onKeyPress="intOnly(this);"/></td>
                        </tr>
						<tr>
                          <td>&nbsp;</td>
                          <td colspan="2" class="form-text"><select name="Employment_Status" style="width:265px;">
                              <option value="-1">Employment status</option>
                              <option value="1">Salaried</option>
							  <option value="0">Self Employed</option>
                            </select>
                          </td>
                        </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td height="25" class="form-text">Company Name</td>
                        <td align="right"><input name="Company_Name" id="Company_Name" type="text" style="width:120px;" /></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td height="25" class="form-text">Property Identified</td>
                        <td align="right" class="form-text">
						<input type="radio"  name="Property_Identified" value="1" onClick="addIdentified();">Yes
						<input size="10" type="radio"  name="Property_Identified" onClick="removeIdentified();" value="0" >No</td>
						<!--<input type="radio" name="Property_Identified" value="1" id="Property_Identified" onClick="addIdentified();" style="width:auto" />
                          Yes
                          <input type="radio" style="width:auto" name="Property_Identified" id="Property_Identified" value="0" onClick="removeIdentified();"/>
                          No </td>-->
                      </tr>

					  <tr><td colspan="3" id="myDiv1">&nbsp;</td></tr>
						<tr><td colspan="3" id="myDiv2">&nbsp;</td></tr>
	<tr><td>
			<input type="hidden" name="ProductValue" id="ProductValue" value="<?php echo $ProductValue; ?>" />
							<input type="hidden" name="Type_Loan" value="Req_Loan_Home">
							
							<input type="hidden" name="Phone" id="Phone" value="<?php echo $Phone; ?>" />
							<input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
							<input type="hidden" name="Net_Salary" id="Net_Salary" value="<?php echo $Net_Salary; ?>" />
</td>
			</tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td height="40" class="form-text">Estimated market value of the property?</td>
                        <td align="right"  class="form-text" ><select name="Budget" id="Budget">
						<option value="-1" selected>Please Select</option>
						<option value="Upto 7 Lakhs">Upto 7 Lakhs </option>
						<option value="7-15 Lakhs">7-15 Lakhs </option>
						<option value="15-20 Lakhs">15-20 Lakhs </option>
						<option value="20-25 Lakhs">20-25 Lakhs </option>
						<option value="Above 25 Lakhs">Above 25 Lakhs</option>
						</select></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td height="40" class="form-text">When you are planning to take loan?</td>
                        <td align="right"  class="form-text" ><select name="Loan_Time" id="Loan_Time" >
           <OPTION value="-1" selected>Please select</OPTION>
			<OPTION value="15 days">15 days</OPTION>
			<OPTION value="1 month">1 months</OPTION>
			<OPTION value="2 month">2 months</OPTION>
			<OPTION value="3 month">3 months</OPTION>
			<OPTION value="3 months above">more than 3 months</OPTION></SELECT>
                        </td>
							
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td class="form-text">&nbsp;</td>
                        <td align="left" valign="top"><input type="image" src="images/hl/submit.gif" width="66" height="20" /></td>
                      </tr>
                    </table>
					</form>
					</td>
                    <td width="16" background="images/hl/frm-rgt-bg.gif">&nbsp;</td>
                  </tr>
                </table>
				
				</td>
              </tr>
              <tr>
                <td width="342" height="27" align="left" valign="top"><input type="image" src="images/hl/frm-bot-bg.jpg" width="342" height="27" /></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td colspan="3"><table width="342" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="7" bgcolor="#FEF8E2">&nbsp;</td>
                <td width="335" height="70" valign="middle" bgcolor="#A06E36" class="testi"><div  style="margin-left:20px;"><img src="images/hl/accounce.gif" width="36" height="35" align="absmiddle" />Testimonials</div></td>
              </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td bgcolor="#E0C563" class="texti-text" valign="top"><div  style="margin-left:20px; margin-right:15px; margin-top:10px">Blore Housing Loan <br />
                  I am glad that i could get 3 quotes on my loan requirement within just 48 hrs that too w/o stepping out of home. I can now close out my property also. Only thing is that I came across your site accidentally- you should promote ur value-adding services better.. </div></td>
              </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td bgcolor="#E0C563" class="texti-text" valign="top"><div align="right" style="margin-right:15px;">- By <b>Jeffrey</b></div></td>
              </tr>
			  <tr><td>&nbsp;</td>
  			  <td bgcolor="#E0C563" class="texti-text"><div  style="margin-left:20px; margin-right:15px; margin-top:10px">I got this site accidently and found very interesting. earlier i was  not able to decide and had lot of questions in mind. By accessing this  site it has solved most of my problems and finally i will say, i am  confident for next action. </div></td>
			  </tr>
			  <tr>
			  <td>&nbsp;</td>
                <td bgcolor="#E0C563" class="texti-text" valign="top"><div align="right" style="margin-right:15px;">- By <b>D S Negi </b></div></td>
			  
			  </tr>
              <tr>
                <td bgcolor="#FEF8E2">&nbsp;</td>
                <td bgcolor="FEF8E2" class="texti-text" valign="top"><img src="images/hl/testi-bottom.jpg" width="335" height="15" /></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

<!-- Google Code for Lead Conversion Page -->

<script language="JavaScript" type="text/javascript">

<!--

var google_conversion_id = 1056387586;

var google_conversion_language = "en_US";

var google_conversion_format = "1";

var google_conversion_color = "ffffff";

if (1) {

  var google_conversion_value = 1;

}

var google_conversion_label = "lead";

//-->

</script>

<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">

</script>

<noscript>

<img height="1" width="1" border="0" src="http://www.googleadservices.com/pagead/conversion/1056387586/?value=1&amp;label=lead&amp;script=0">

</noscript>
<SCRIPT language="JavaScript" type="text/javascript">
<!-- Yahoo!
window.ysm_customData = new Object();
window.ysm_customData.conversion = "transId=,currency=,amount=";
var ysm_accountid  = "135AHO229GAA5G7GKVUE46C65OO";
document.write("<SCR" + "IPT language='JavaScript' type='text/javascript' " 
+ "SRC=//" + "srv1.wa.marketingsolutions.yahoo.com" + "/script/ScriptServlet" + "?aid=" + ysm_accountid 
+ "></SCR" + "IPT>");
// -->
</SCRIPT>
</body>
</html>
