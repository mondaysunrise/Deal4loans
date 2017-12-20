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
		$Loan_Any = FixString($Loan_Any);
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
		$Type_Loan ="CreditCard";
		
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
$Type_Loan ="CreditCard";

	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$DeleteIncompleteQuery=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
function InsertTataAig($RequestID, $ProductName)
	{
	$GetDateSql = "select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID";
		list($alreadyExist,$myrow)=MainselectfuncNew($GetDateSql,$array = array());
		$myrowcontr=count($myrow)-1;
		
		$TDated = $myrow[$myrowcontr]["Dated"];
		$TCity = $myrow[$myrowcontr]["City"];
		$Mobile = $myrow[$myrowcontr]["Mobile_Number"];
		$Dated=ExactServerdate();
		$Product_Name = "4";
		
		$data = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $data);
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
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$InsertProductSql = "INSERT INTO Req_Credit_Card( UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Net_Salary, DOB, IsPublic, Dated,  Reference_Code, source, Pancard, CC_Holder,Card_Vintage,IP_Address,Referrer,Creative,Section,Updated_Date,Accidental_Insurance, Loan_Any)	VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Net_Salary', '$DOB', '$IsPublic', Now(), '$Reference_Code', '$source', '$Pancard','$CC_Holder','$Card_Vintage','$IP','$Referrer','$Creative','$Section',Now(),'$Accidental_Insurance','$Loan_Any' )"; 
				$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "DOB"=>$DOB, "Dated"=>$Dated, "IsPublic"=>$IsPublic, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Loan_Any'=>$Loan_Any);
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "DOB"=>$DOB, "Dated"=>$Dated, "IsPublic"=>$IsPublic, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Loan_Any'=>$Loan_Any);
			}
			$ProductValue = Maininsertfunc ('Req_Credit_Card', $dataInsert);
			$_SESSION['Temp_LID'] = $ProductValue;
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Credit_Card");
				}
			//exit();
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
			
			//if($Name)
			//	$SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
			//else
				$SubjectLine = $Name.", Learn to get Best Deal on Credit Card";
			//echo $Type_Loan;
			$Type_Loan ="CreditCard";
			if(isset($Email))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			

		//}
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
<title>Credit Cards</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="stylesheet" href="http://www.deal4loans.com/rnew/creditcards.css" type="text/css" />
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
function intOnly(i) {
		if(i.value.length>0) {
			i.value = i.value.replace(/[^\d]+/g, ''); 
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


function addElement()
{
	
		var ni = document.getElementById('myDiv');
		
		if(ni.innerHTML=="")
		{
			
				ni.innerHTML = '<table border="0" width="100%" align="center"><tr><td align="left" class="bodyarial11" width="250" height="20">Reconfirm Mobile No.</td>	<td align="left" width="250" height="20" ><input size="18" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; name="RePhone" ></td></tr></table>';
			
			
		}
			
		else if(ni.innerHTML!="")
		{
					
				
				ni.innerHTML = '';
			
		}
		
		return true;
		}
</script>

</head>

<body>
<table width="892" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
   <td width="574" valign="top" style="padding-left:1px;"><table width="64%" border="0" align="center" cellpadding="0" cellspacing="0">
     <tr>
 <td width="573" height="60" align="left" valign="middle" style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#8A3712; text-decoration:none; padding-left:10px;"><img src="images/cc/crdt-crd-logo.gif" width="155" height="44" align="absmiddle" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cards by Choice not by Chance !</td>     
     </tr>
     <tr>
       <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
           <td width="255" height="113" align="left" valign="top"><img src="images/cc/crdt-crd-hdr-lft.jpg" width="255" height="113" /></td>
           <td width="318" height="113" align="left" valign="top" background="images/cc/crdt-crd-hdr-rgt.jpg" style="background-repeat:no-repeat; width:318px; height:113px;"><div id="hdng-txt" >3 Easy Steps</div>
		   <div id="sbhdng-txt" >Apply for credit card.<br />
Get & compare  offers.<br />
		   Get the best deal.</div></td>
         </tr>
         <tr>
           <td width="255" height="90" align="left" valign="top"><img src="images/cc/crdt-crd-hdr-lft-bt.jpg" width="255" height="90" /></td>
           <td width="318" height="90" align="left" valign="top"><img src="images/cc/crdt-crd-hdr-rgt-bt.jpg" width="318" height="90" /></td>
         </tr>
         <tr>
  <td height="75" colspan="2" valign="middle" id="txt"><b>www.deal4loans.com</b><br />
The one-stop shop for best on all credit card requirements<br />
      Now get offers from <strong>ICICI, ABN AMRO, Barclays, Citibank, Reliance and SBI</strong><br />
    and choose the best card!</td>         </tr>
         <tr>
           <td colspan="2" align="left" valign="top" id="panel">Safety Tips for using a credit card.</td>
           </tr>
         <tr>
           <td colspan="2" align="left" valign="top" id="txt-brdr"><font  color="#05394A">&bull;</font> Sign your card as soon as you receive it.<br />
             <font  color="#05394A">&bull;</font> You will also receive the PIN number after a few days. Keep your
             PIN/account number safe.<br />
             <font  color="#05394A">&bull;</font> Every time you use your card, be aware when your card is being swiped
             by the cashier so as to ensure no misuse of your card takes place.<br />
             <font  color="#05394A">&bull;</font> When making payment with your card, make sure you check if it is your credit card that the cashier has returned.<br />
             <font  color="#05394A">&bull;</font> Do not forget to verify your purchases with your billing statements.<br />
             <font  color="#05394A">&bull;</font> After using your card at an ATM, do not throw your receipt behind.<br />
 
             <div id="panel-bot"><a href="Contents_Credit_Card_Mustread.php" style="color:#FFFFFF" target="_blank">More</a>...</div></td>
         </tr>
		  <tr>
        <td colspan="2" valign="middle" id="txt"><b>Testimonial</b><br />
          The security tips and the regular updates about
          credit card offers, has helped me drive more
          mileage out of the plastics in my wallet.
          <div style="float:right; margin:0px;"><b>Swati</b></div></td>
      </tr>
         
       </table></td>
     </tr>
   </table></td>
    <td width="328" valign="top" style=" padding-left:5px; padding-top:20px;"><table width="327" border="0" align="right" cellpadding="0" cellspacing="0">
      <tr>
        <td  ><div id="form-top-lft">&nbsp;</div>
            <div id="form-top-bg"><img src="images/cc/spacer.gif" height="29" width="1" />Request for Credit Card</div>
          <div id="form-top-rgt">&nbsp;</div></td>
      </tr>
      <tr>
        <td valign="top" id="form-brdr"><div id="fom-txt">
            <div align="center" style="margin:8px;">Please tell more about yourself</div>
          <form name="loan_form" method="post" action="t_y.php" onSubmit="return submitform(document.loan_form);">
              <div style="padding-left:20px;  text-align:left; ">

			   Activation Code
			  <input style="margin-left:33px; width:35px;padding-left:5px;" name="Reference_Code1"  onFocus="return Decoration('Please enter 4 digit code you have received on your mobile,to activate your card request and to get the bidder contacts.')" onBlur="return Decoration1(' ')"><div id="plantype" style="position:absolute; font-size:10px;width:250px; font-weight:none; left:39%; " ></div></div> 
				                                <br />
												
				    <input  class="noBrdr" type="checkbox"  name="confirm" onClick="addElement();" value="hello" id="validate" >					if you havent received activation code sms <br />
				  <div id="myDiv" ></div>
			  
 <? 
	 if($CC_Holder==1) { ?>
 			  <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>
          <td width="29%" rowspan="7" align="center" valign="middle"  >I have an active credit card from ?</td>
          <td width="7%"  ><input type="checkbox" style="border:none;" id="From_Product" name="From_Product[]" class="noBrdr" value="Abn Ambro"></td>
          <td width="35%"  >ABN AMRO</td>
          <td width="7%" ><input type="checkbox" style="border:none;"  id="From_Product" name="From_Product[]" value="Amex"></td>
          <td width="22%" >Amex</td>
        <tr>
          <td ><input type="checkbox" style="border:none;" name="From_Product[]" class="noBrdr" id="From_Product" value="Canara Bank" ></td>

          <td >Canara Bank</td>
          <td ><input type="checkbox" style="border:none;" name="From_Product[]" id="From_Product" class="noBrdr" value="Citi Bank" ></td>
          <td >Citi Bank</td>
        </tr>
        <tr>
          <td ><input type="checkbox" style="border:none;" name="From_Product[]" class="noBrdr" id="From_Product" value="Deutsche bank"></td>
          <td >Deutsche Bank</td>
          <td ><input type="checkbox" style="border:none;"  id="From_Product" name="From_Product[]" value="HDFC" class="noBrdr"></td>
          <td >HDFC</td>
        </tr>
        <tr>
          <td ><input type="checkbox" style="border:none;" class="noBrdr" value="HSBC" name="From_Product[]" id="From_Product" ></td>
          <td >HSBC</td>
          <td ><input type="checkbox" style="border:none;" id="From_Product" name="From_Product[]" class="noBrdr" value="ICICI"></td>
          <td >ICICI</td>
        </tr>
        <tr>
          <td  ><input type="checkbox" style="border:none;" name="From_Product[]" value="Standard Chartered" id="From_Product" class="noBrdr" ></td>
			<td colspan="3">Standard Chartered</td>
</tr>
        <tr>
          <td ><input type="checkbox" style="border:none;" name="From_Product[]" value="Barclays" id="From_Product" class="noBrdr" ></td>
          <td >Barclays</td>
          <td ><input type="checkbox" style="border:none;" id="From_Product" name="From_Product[]" class="noBrdr" value="SBi"></td>
          <td >SBI</td>
        </tr>
        <tr>
          <td   ><input type="checkbox" style="border:none;" name="From_Product[]" value="Others" id="From_Product" class="noBrdr" ></td>
<td>Others</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
        </tr>
		<tr>
		<td colspan="5">
     Credit Card Limit?
     <select size="1" style="margin-left:8px; width:154px;"  name="Credit_Limit" id="Credit_Limit">
        <option value="0">Please select</option>
        <option value="1">25000 to 50000</option>
        <option value="2">50001 to 75000</option>
        <option value="3">75001 to 1 lakh </option>

        <option value="4">1 lakh & above</option>
      </select>	    </td>
		</tr>
      </table>
<? } ?>
   <br />

			  Residence No.
			  <input type="text"  name="Std_Code" id="Std_Code" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" value="std" onBlur="onBlurDefault(this,'std');" style="margin-left:33px; width:35px;padding-left:5px;">
				<input type="text" style="width:106px;" name="Landline" id="Landline" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
                
                  <br />
				  
				  <div id="formheight" style="width:295px;"><div style="width:125px; float:left; margin-top:18px;">Residence Address</div>
				  <div style="width:170px; float:left;"><textarea name="Residence_Address" id="Residence_Address" style="width:148px; margin-bottom:5px; margin-left:3px; height:55px;"></textarea></div></div>
                
                  <p>&nbsp;</p>
                  <p>Pincode<font color="#FF0000">*</font>
                    <input  type="text" name="Pincode" id="Pincode" value=" Pincode" style="margin-left:64px; width:152px;" maxlength="6"/>
                    <br />
                Office No.
                <input type="text"  name="Std_Code_O" id="Std_Code_O"  style="width:35px; margin-left:60px;padding-left:5px;"  value="std" />
                <input   type="text" name="Landline_O" id="Landline_O"   style="width:107px;" />
                 
                  <div style="width:125px; float:left; margin-top:18px;">Office Address</div>		
               <div style="width:170px; float:left;"><textarea name="Office_Address" id="Office_Address"  style="width:148px; margin-bottom:5px; margin-left:3px; height:55px;"></textarea></div>
			   <?if($Pancard=="Yes"){?>
Pan Number.
                    <input type="text" name="Pancard_no" id="Pancard_no"  style="width:152px; margin-left:40px;"maxlength="10" />

                    <br />
					<? } ?>
					
                    <br />
              </p>
                  <div align="center">
                  <input type="image" name="Submit" src="images/cc/crdt-submit.gif"  style="width:125px; height:31px; border:none; padding-right:30px;" />
                </div>
          
          </form>
        </div></td>
      </tr>
      <tr>
        <td valign="bottom" align="left"><div id="form-l-cor"></div>
            <div id="form-mid-b"></div>
          <div id="form-r-cor"></div></td>
      </tr>
    </table></td>
  </tr>

</table>
<? //}?>
<!-- Google Code for Lead Conversion Page -->
<!-- Google Code for Credit Card Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_GB";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "XREoCNHMhgEQh8-3_AM";
if (1.0) {
  var google_conversion_value = 1.0;
}
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height="1" width="1" border="0" src="http://www.googleadservices.com/pagead/conversion/1066264455/?value=1.0&amp;label=XREoCNHMhgEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</noscript>


</body>
</html>
