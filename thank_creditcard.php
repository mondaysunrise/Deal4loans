<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	
	$page_Name = "LandingPage_PL";

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
		$Reference_Code = generateNumber(4);
		$City_Other = FixString($City_Other);
		$Company_Name = FixString($Company_Name);
		$Net_Salary =FixString($Net_Salary);
		$IsPublic =1;
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$Type_Loan = FixString($Type_Loan);
		$source = FixString($source);
		$Reference_Code = FixString($Reference_Code);
		$Employment_Status = FixString($Employment_Status);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$Section=$_REQUEST['section'];
		$Creative=$_REQUEST['creative'];
		
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


	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
	}
	
function InsertTataAig($RequestID, $ProductName)
	{
	//	echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = ExecQuery("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		$RowGetDate = mysql_fetch_array($GetDateSql);
		
		$TDated = $RowGetDate['Dated'];
		$TCity = $RowGetDate['City'];
		$Mobile = $RowGetDate['Mobile_Number'];
		$Product_Name = "4";
		
		$Sql = "INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, `Mobile_Number`, `T_Dated` ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";
		$query = mysql_query($Sql);
		//echo "tataaig:".$Sql."<br>";
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
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			$CheckQuery = ExecQuery($CheckSql);
			//echo "<br>".$CheckSql;
			$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = mysql_result($CheckQuery, 0, 'UserID');
				$InsertProductSql = "INSERT INTO Req_Credit_Card( UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, DOB, IsPublic, Dated,  Reference_Code, source, Pancard, CC_Holder,Card_Vintage,IP_Address,Referrer,Creative,Section,Updated_Date,Accidental_Insurance)	VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Net_Salary', '$DOB', '$IsPublic', Now(), '$Reference_Code', '$source', '$Pancard','$CC_Holder','$Card_Vintage','$IP','$Referrer','$Creative','$Section',Now(),'$Accidental_Insurance' )"; 
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID1 = mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Credit_Card( UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, DOB, IsPublic, Dated,  Reference_Code, source, Pancard, CC_Holder,Card_Vintage,IP_Address,Referrer,Creative,Section, Updated_Date, Accidental_Insurance)			VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Net_Salary', '$DOB', '$IsPublic', Now(), '$Reference_Code', '$source', '$Pancard','$CC_Holder','$Card_Vintage','$IP','$Referrer','$Creative','$Section',Now(),'$Accidental_Insurance' )";
				//echo "<br>else".$InsertProductSql;
				/*$SMSMessage = "Dear $Name,Thank you for Registering with deal4loans.Your registration details are as follows: EmailID: $Email.";
				if(strlen(trim($Phone)) > 0)
				SendSMS($SMSMessage, $Phone);*/
				
			}
			
			$InsertProductQuery = ExecQuery($InsertProductSql);
			$ProductValue = mysql_insert_id();
			$_SESSION['Temp_LID'] = $ProductValue;
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Credit_Card");
				}
			

$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of card app form to get bidder contacts & quotes. And help us serve you better.";
					if(strlen(trim($Phone)) > 0)
					SendSMS($SMSMessage, $Phone);
			
			
			}
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			else
				$SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			

		//}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://creditcard.deal4loans.com/".$_POST["PostURL"]."?msg=".$msg;
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
<link rel="stylesheet" href="css/creditcard.css" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script>
function valButton2() {
    var cnt = -1;
	var i;
    for(i=0; i<document.loan_form.From_Product.length; i++) 
	{
        if(document.loan_form.From_Product[i].checked)
		{
			cnt=i;
			
		}
    }
    if(cnt > -1)
	{ 
		return true;
	}
    else
	{
		return false;
	}
}


function valButton5() {
		var cnt = -1;
		var i;
		for(i=0; i<document.loan_form.From_Product1.length; i++) 
		{
			if(document.loan_form.From_Product1[i].checked)
			{
				cnt=i;
				
			}
		}
		if(cnt > -1)
		{ 
			return true;
		}
		else
		{
			return false;
		}
	}            
function submitform(FormName)
	{
		var btn2;
		var btn3;
		var myOption;
		var i;
		var btn;
		var btn5;
		var RePhone;
		if(FormName.Reference_Code1.value=="")
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
		}
	
	<? if($CC_Holder==1) {?>
		btn2=valButton2();
					if(!btn2)
					{
						alert('you holding credit card from which bank.');
						return false;
					}
				
		
		if (FormName.Credit_Limit.selectedIndex==0)
		{
			alert("Please Select Credit Limit");
			FormName.Credit_Limit.focus();
			return false;
		}
		<? }
	if($Pancard=="Yes")
		{?>
	if (FormName.Pancard_no.value=='')
		{
			alert("Please enter Pancard no");
			FormName.Pancard_no.focus();
			return false;
		}
		<? }?>
	/*btn5=valButton5();
	if(!btn5)
		{
			alert('Please select have you applied with any of these banks in last 6 months or not');
				return false;
		}*/


		return true;
	}
	
	
	
function addElement()
{
	
		var ni = document.getElementById('MMmyDiv');
var newdiv = document.createElement('div');
		
		if(ni.innerHTML=="")
		{
			
				ni.innerHTML = '<table border="0"><tr><td align="left" class="formtxt" width="200" height="20">Reconfirm Mobile No.</td>	<td colspan="3" align="left" width="300" height="20" ><input  name="RePhone" id="RePhone" size="18" type="text"  maxlength="10"></td></tr></table>';
			
				ni.appendChild(newdiv);
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		return true;
		}
		function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}
function HandleOnClose(filename) { if ((event.clientY < 0)) {	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}


	function Decoration(strPlan)
{
       if (document.getElementById('plantype') != undefined)  
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='Beige';  
       }

       return true;
}
function Decoration1(strPlan)
{
       if (document.getElementById('plantype') != undefined) 
       {
               document.getElementById('plantype').innerHTML = strPlan;
			   document.getElementById('plantype').style.background='';  
			     
               
       }

       return true;
}
</script>


</head>

<body>

<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#BBAF8E" >
  <tr>
    <td valign="middle"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="600" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20" height="155" align="left" valign="top"><img src="images/cc/img-left.jpg" alt="" width="200" height="155" /></td>
            <td width="200" align="left" valign="top"><img src="images/cc/img-middle.jpg" alt="" width="200" height="155" /></td>
            <td align="left"><img src="images/cc/img-right.jpg" alt="" width="200" height="155" /></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="44%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td bgcolor="#796E49"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="265" height="15" align="left" valign="top"><img src="images/cc/top-br.gif" width="265" height="15" /></td>
                      </tr>
                      <tr>
                        <td ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
<td height="100" align="center" class="middlbold" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 36px; font-weight: bold;">Just 3<br />
                  easy steps!</td>                     
				         <td width="5" background="images/cc/top-br-bg.gif" style="background-repeat:repeat-y; width:5px; background-position:right;" >&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                    </tr>
                  
                  
                </table></td>
              </tr>
              <tr>
                <td height="130" valign="top" bgcolor="#E1DFCE"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="45" align="right" valign="middle" style="padding-top:3px;"><img src="images/cc/dark-arrow.gif" width="8" height="5" /></td>
                        <td width="215" height="30" valign="middle" class="heading_bl">Post your credit card requirement.</td>
                      </tr>
                      <tr>
                        <td width="45" align="right" valign="middle" style="padding-bottom:2px;"><img src="images/cc/dark-arrow.gif" width="8" height="5" /></td>
                        <td height="30" class="heading_bl">Get & compare Credit Card offers.</td>
                      </tr>
                      <tr>
                        <td width="45" align="right" valign="top"  style="padding-top:15px;"><img src="images/cc/dark-arrow.gif" alt="" width="8" height="5" /></td>
                        <td height="45" class="heading_bl">Get the best deal for your credit card. </td>
                      </tr>
                    </table></td>
                    <td width="5" height="125" background="images/cc/lgt-skn-bg.gif" style="background-repeat:repeat-y; width:5px; background-position:right;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="261" height="5" align="left" valign="bottom"><img src="images/cc/lgt-skn-corn.gif" width="5" height="5" /></td>
<td width="5" height="5" background="images/cc/lgt-skn-bg.gif" style="background-repeat:repeat-y; width:5px; background-position:right;">&nbsp;</td>                  </tr>
                </table></td>
              </tr>
              <tr>
                <td  valign="top" bgcolor="#B9AD8B"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td height="40" class="smallbold">www.deal4loans.com</td>
                  </tr>
                  <tr>
                    <td>The one-stop shop for best on all credit card requirements <br />
                      Now get offers from <B>ICICI, ABN AMRO, Deutsche, Citibank, Reliance</B> and <B>SBI</B> and choose the best card! </td>
                  </tr>
                  <tr>
                    <td width="260" height="130" align="center" valign="bottom" background="images/cc/lock-img.jpg"  style="background-repeat:no-repeat; background-position:left bottom;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="right" class="middlbold" style="font-size:28px; font-style:italic;">Helpful tips</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" class="smallbold" style="font-size:17px; font-style:italic;">for using a credit card.</td>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                  <tr>
                    <td height="60" valign="top" style="padding-top:10px;"><table width="98%" border="0" align="left" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="12%" align="center" valign="top" style="padding-top:4px;"><img src="images/cc/dark-bg-arrow.gif" width="8" height="5" /></td>
                        <td width="88%">Sign your card as soon as you receive it. </td>
                      </tr> <tr>
                        <td colspan="2" height="10"></td>
                      </tr>
                      <tr>
                        <td width="12%" align="center" valign="top" style="padding-top:3px;"><img src="images/cc/dark-bg-arrow.gif" width="8" height="5" /></td>
                        <td>You will also receive the PIN number after a few days. Keep your PIN/account number safe. </td>
                      </tr> <tr>
                        <td colspan="2" height="10"></td>
                      </tr>
                      <tr>
                        <td width="12%" align="center" valign="top" style="padding-top:3px;"><img src="images/cc/dark-bg-arrow.gif" width="8" height="5" /></td>
                        <td>Every time you use your card, be aware when your card is being swiped by the cashier so as to ensure no misuse of your card takes place.</td>
                      </tr> <tr>
                        <td colspan="2" height="10"></td>
                      </tr>
                      <tr>
                        <td width="12%" align="center" valign="top" style="padding-top:3px;"><img src="images/cc/dark-bg-arrow.gif" width="8" height="5" /></td>
                        <td>When making payment with your card, make sure you check if it is your credit card that the cashier has returned.</td>
                      </tr> <tr>
                        <td colspan="2" height="10"></td>
                      </tr>
                      <tr>
                        <td width="12%" align="center" valign="top" style="padding-top:3px;"><img src="images/cc/dark-bg-arrow.gif" width="8" height="5" /></td>
                        <td>Do not forget to verify your purchases with your billing statements.</td>
                      </tr>
                      <tr>
                        <td colspan="2" height="10"></td>
                      </tr>
                      <tr>
                        <td width="12%" align="center" valign="top" style="padding-top:3px;"><img src="images/cc/dark-bg-arrow.gif" width="8" height="5" /></td>
                        <td>After using your card at an ATM, do not throw your receipt behind.</td>
                      </tr>
                      <tr>
                        <td height="40" colspan="2" align="right" valign="bottom"><img src="images/cc/know-bttn.jpg" width="109" height="30" /></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
    <td align="left" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
            <td height="280"  background="images/cc/drk-skn-bg.gif" style="background-repeat:repeat-y; width:5px; background-position:right;">&nbsp;</td>
      </tr>
      <tr>
        <td width="5" height="20"><img src="images/cc/frm-bot-shd.gif" width="5" height="30" /></td>
      </tr>
    </table></td>
  </tr>
</table></td>
              </tr>
              
            </table>
            </td>
            <td width="56%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="335" height="555" align="right" valign="top"><table width="335" border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="20" height="28" align="left" valign="top"><img src="images/cc/left-top-corn.jpg" width="20" height="28" /></td>
                    <td background="images/cc/top-frm-bg.gif">&nbsp;</td>
                    <td width="16" height="28" align="right" valign="top"><img src="images/cc/frm-rgt-top.jpg" width="16" height="28" /></td>
                  </tr>
                  <tr>
                    <td height="507" background="images/cc/frm-lft-bg.gif">&nbsp;</td>
                    <td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="40" align="center" valign="middle"><b style="font-size:18px; color:#616161;">Request for Credit Card</b></td>
                      </tr>
                      <tr>
                        <td height="30" align="center" valign="middle"><B>Step 2 of 2</B></td>
                      </tr>
                      <tr>
                        <td height="30" align="center" valign="middle"><B>Please tell more about yourself</B></td>
                      </tr>
                      <tr>
                        <td valign="top"> <form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform(document.loan_form);">
<table width="292" border="0" align="right" cellpadding="0" cellspacing="5">
<tr>
      <td class="formtxt">Activation Code</td>
      <td class="formtxt"><input type="text" name="Reference_Code1" size="10" maxlength="4" onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your card request and to get the bidder contacts.')" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute; font-size:10px;width:125px;text-align:center;font-family:verdana;" ></div> </td>
    </tr>
    <tr>
      <td colspan="2" class="formtxt" ><input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();"  value="hello" id="confirm" >
        if you havent received activation code sms. </td>
    </tr>
    <tr>
      <td colspan="2" class="formtxt"><div id="MMmyDiv"></div></td>
    </tr>

    <? if($CC_Holder==1) { ?>
    <tr>
      <td class="formtxt" >I have an active credit card from ? </td>
      <td  class="formtxt" ><table border="0">
        <tr>
          <td class="formtxt" ><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro">
            ABN AMRO</td>
          <td class="formtxt"><input type="checkbox" class="noBrdr" id="From_Product" name="From_Product[]" value="Amex">
            Amex</td>
        <tr>
          <td class="formtxt"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" >
            Canara Bank</td>
          <td class="formtxt"><input type="checkbox" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" >
            Citi Bank</td>
        </tr>
        <tr>
          <td class="formtxt"><input type="checkbox" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank">
            Deutsche Bank</td>
          <td class="formtxt"><input type="checkbox"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr">
            HDFC</td>
        </tr>
        <tr>
          <td class="formtxt"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" >
            HSBC</td>
          <td class="formtxt"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI">
            ICICI</td>
        </tr>
        <tr>
          <td class="formtxt" colspan="2"><input type="checkbox" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" >
            Standard Chartered</td>
        </tr>
        <tr>
          <td class="formtxt"><input type="checkbox" name="From_Product[]" value="Barclays" id="From_Product" class="noBrdr" >
            Barclays</td>
          <td class="formtxt"><input type="checkbox" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi">
            SBI</td>
        </tr>
        <tr>
          <td colspan="2" class="formtxt"><input type="checkbox" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" >
            Others</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td class="formtxt">Credit Card Limit?</td>
      <td  align="left"  colspan="3" width="240" height="25"><select size="1"  name="Credit_Limit">
        <option value="0">Please select</option>
        <option value="1">25000 to 50000</option>
        <option value="2">50001 to 75000</option>
        <option value="3">75001 to 1 lakh </option>
        <option value="4">1 lakh & above</option>
      </select>
      </td>
    </tr>
    <? } ?>
 
   <!-- <tr>
      <td class="formtxt">Have you applied with these Banks in last six months?<font size="1" color="#FF0000">*</font> </td>
      <td  class="formtxt"><table border="0" width="100%">
        <tr>
          <td width="75" class="formtxt"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Abn Ambro">ABN AMRO</td>
          <td width="30" class="formtxt"><input type="checkbox" class="noBrdr" id="From_Product1" name="From_Product1[]" value="Amex">Amex</td>
        </tr>
			<tr>
          <td class="formtxt"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Canara Bank" >Canara Bank</td>
        
          <td class="formtxt"><input type="checkbox" name="From_Product1[]" id="From_Product1" class="noBrdr" value="Citi Bank" >CitiBank</td>
			</tr>
			<tr>
          <td class="formtxt"><input type="checkbox" name="From_Product1[]" class="noBrdr" id="From_Product1" value="Deutsche bank">Deutsche Bank</td>
          <td class="formtxt"><input type="checkbox"  id="From_Product1" name="From_Product1[]" value="HDFC" class="noBrdr">HDFC</td>
        </tr>
        <tr>
          <td class="formtxt"><input type="checkbox" class="noBrdr" value="HSBC" name="From_Product1[]" id="From_Product1" >HSBC</td>
          <td class="formtxt"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="ICICI">ICICI</td></tr>
			<tr>
          <td class="formtxt" colspan="2"><input type="checkbox" name="From_Product1[]" value="Standard Chartered"  id="From_Product1" class="noBrdr" >Standard Chartered</td>
      </tr>
			<tr>
			<td class="formtxt"><input type="checkbox" id="From_Product1" name="From_Product[]" class="noBrdr" value="SBI">
            SBI</td>
          
          <td class="formtxt"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Barclays">
            Barclays</td>
        </tr>
        <tr>
		<td class="formtxt"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="Others">
            Others</td>
          <td class="formtxt" colspan="3"><input type="checkbox" id="From_Product1" name="From_Product1[]" class="noBrdr" value="0">
            No</td>
        </tr>
      </table></td>
    </tr>-->
	
		<tr>
				<td class="formtxt">Residence No.</td>
				<td class="formtxt" align="left"><input type="text"  name="Std_Code" id="Std_Code" size="3" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="std" onBlur="onBlurDefault(this,'std');">
				<input size="11" type="text"  name="Landline" id="Landline" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";></td>

			</tr>
	<tr>
      <td class="formtxt">Residence Address</td>
      <td width="70%" class="formtxt"><textarea name="Residence_Address" id="Residence_Address" cols="20" rows="2"></textarea></td></tr>
	  <tr>
      <td class="formtxt">Pincode</td>
      <td width="70%" class="formtxt"><input type="text" name="Pincode" id="Pincode" maxlength="6"></td>
	  </tr>
    
<tr>
				<td class="formtxt">Office No.</td>
				<td  class="formtxt" align="left"><input type="text"  name="Std_Code_O" id="Std_Code_O" size="3" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="std" onBlur="onBlurDefault(this,'std');">
				
				<input size="11" type="text" name="Landline_O" id="Landline_O" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>

			</tr>
    <tr>
      <td class="formtxt">Office Address</td>
      <td width="70%" class="formtxt"><textarea name="Office_Address" id="Office_Address" cols="20" rows="2"></textarea></td>
    </tr>
	<?if($Pancard=="Yes")
	{?>
	 <tr>
      <td class="formtxt">Pan Number.</td>
      <td width="70%" class="formtxt"><input type="text" name="Pancard_no" id="Pancard_no" maxlength="10"></td>
	  </tr>
	  <? }?>
				
     
    <tr>
      <td height="40" colspan="2" align="center" valign="bottom"><input name="image"  value="Submit" type="image" src="http://www.deal4loans.com/images/cc/submit-bttn.gif" width="84" height="33"  img="img" /></td>
    </tr>
</table></form>
</td>
                      </tr>
                    </table></td>
                    <td background="images/cc/frm-rgt-bg.gif">&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="20" height="20" align="left" valign="bottom"><img src="images/cc/frm-bot-left.jpg" width="20" height="20" /></td>
                    <td background="images/cc/frm-bot-bg.gif">&nbsp;</td>
                    <td width="16" height="20" align="right" valign="bottom"><img src="images/cc/frm-bot-rgt.jpg" width="16" height="20" /></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="60" bgcolor="#796E49"><table width="275" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="42" align="left" valign="middle"><img src="images/cc/sound-crcl.jpg" width="35" height="36" /></td>
                    <td width="222" align="left" valign="middle" class="smallbold" style="font-size:18px;">Testimonials</td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top" bgcolor="#E1DFCE"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td style="padding:20px 15px 0px 15px;">Great! <br />
                      Good way of helping people like me to decide on what banks to choose.Got my Credit card in 15 days.Awesome!!!!! </td>
                  </tr>
                  <tr>
                    <td height="29" align="right" valign="bottom" style="padding-right:15px;"><B>-Ratan</B></td>
                  </tr>
                  <tr>
                    <td style="padding:0px 15px 0px 15px;">Plastic money<br />
                      The security tips and the regular updates about credit card offers, has helped me drive more mileage out of the plastics in my wallet.</td>
                  </tr>
                  <tr>
                    <td height="29" align="right" valign="bottom" style="padding-right:15px;"><B>-Swati</B></td>
                  </tr>
                  <tr>
                    <td align="left" valign="bottom"><img src="images/cc/bottom-left-corn.gif" width="8" height="8" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<? ///}?>
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
