<?php
	
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
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
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Pincode = FixString($Pincode);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Employment_Status = FixString($Employment_Status);
		$Phone1 = FixString($Phone1);
		$Std_Code1 = FixString($Std_Code1);
		$Card_Vintage = FixString($Card_Vintage);
		$Reference_Code = generateNumber(4);
		$Email = FixString($Email);
		$Item_ID = FixString($Item_ID);
		$Type_Loan = FixString($Type_Loan);
		$Company_Name = FixString($Company_Name);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$City = FixString($City);
		$From_Product = $_REQUEST['From_Product'];
		$City_Other = FixString($City_Other);
		  $Dated = ExactServerdate();
		if($Employment_Status==1)
		{
			$Net_Salary = $_REQUEST['IncomeAmount'] *12;
		}
		else
		{
			$Net_Salary = $_REQUEST['IncomeAmount'];
		}
	$IsPublic = 1;

		$n       = count($From_Product);
		   $i      = 0;
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$Section=$_REQUEST['section'];
		$Creative=$_REQUEST['creative'];
		$IP = getenv("REMOTE_ADDR");
		
if($_SESSION=="")
		{
			$_SERVER['Temp_Type'] = "PersonalLoan";
			$_SESSION['Temp_Type_Loan']="Req_Loan_Personal";
			$_SERVER['Temp_Name'] = $Name;
			$_SERVER['Temp_FName'] = $Name;
			$_SERVER['Temp_Employment_Status'] = $Employment_Status;
			$_SERVER['Temp_Phone'] = $Phone;
			$_SERVER['Temp_Phone1'] = $Phone1;
			$_SERVER['Temp_DOB'] = $DOB;
			$_SERVER['Temp_Reference_Code'] = $Reference_Code;
			$_SERVER['Temp_Email'] = $Email;
			$_SERVER['Temp_Company_Name'] = $Company_Name;
			$_SERVER['Temp_City'] = $City;
			$_SERVER['Temp_City_Other'] = $City_Other;
			$_SERVER['Temp_Net_Salary'] = $Net_Salary;
			$_SERVER['Temp_CC_Holder'] = $CC_Holder;
		}
	else
		{
			$_SESSION['Temp_Type'] = "PersonalLoan";
			$_SESSION['Temp_Type_Loan']="Req_Loan_Personal";
			$_SESSION['Temp_Name'] = $Name;
			$_SESSION['Temp_Employment_Status'] = $Employment_Status;
			$_SESSION['Temp_FName'] = $Name;
			$_SESSION['Temp_Phone'] = $Phone;
			$_SESSION['Temp_Phone1'] = $Phone1;
			$_SESSION['Temp_Std_Code1'] = $Std_Code1;
			$_SESSION['Temp_DOB'] = $DOB;
			$_SESSION['Temp_Reference_Code'] = $Reference_Code;
			$_SESSION['Temp_Email'] = $Email;
			$_SESSION['Temp_Company_Name'] = $Company_Name;
			$_SESSION['Temp_City'] = $City;
			$_SESSION['Temp_City_Other'] = $City_Other;
			$_SESSION['Temp_Net_Salary'] = $Net_Salary;
			$_SESSION['Temp_CC_Holder'] = $CC_Holder;
		}


	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		Maindeletefunc($DeleteIncompleteSql,$array = array());
	}


	function InsertTataAig($RequestID, $ProductName)
	{
	//	echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = "select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID";
		//$RowGetDate = mysql_fetch_array($GetDateSql);
		list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;
		
		$TDated = $RowGetDate[$cntr]['Dated'];
		$TCity = $RowGetDate[$cntr]['City'];
		$Mobile = $RowGetDate[$cntr]['Mobile_Number'];
		$Product_Name = "1";
		
		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
		$table = 'tataaig_leads';
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
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
					list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
		$k=0;
		
			
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$k]['UserID'];
			
				$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status,"Company_Name"=>$Company_Name,  "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "Pincode"=>$Pincode, "Reference_Code"=>$Reference_Code, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance);
			$table = 'Req_Loan_Personal';
			$insert = Maininsertfunc ($table, $dataInsert);
			
			
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
			
				
				$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$table = 'wUsers';
				$UserID1 = Maininsertfunc ($table, $dataInsert);
				
				$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status,"Company_Name"=>$Company_Name,  "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "Pincode"=>$Pincode, "Reference_Code"=>$Reference_Code, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance);
			$table = 'Req_Loan_Personal';
			$insert = Maininsertfunc ($table, $dataInsert);
				
			}
			
			$ProductValue = $insert;
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Personal");
				}
			$_SESSION['Temp_LID'] = $ProductValue;
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get bidder contacts & quotes. And help us serve you better.";
			if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			//exit();
			
			
			
			
			
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
<title>Personal Loan</title>
<link rel="stylesheet" href="css/personal-loan.css" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>


<Script Language="JavaScript" Type="text/javascript">

function addDiv()
{
		var ni = document.getElementById('mynewDiv');
		
		if(ni.innerHTML=="")
		{
		
			if(document.personalloan_form.LoanAny.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<div id="expanddiv" class="expandeddiv" ></div>';
				

			}
		}
		
		return true;

	}
function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}


function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	
	   
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}

function addElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML=="")
		{
		
			
				ni.innerHTML = ' <tr> <td colspan="2" align="left"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td width="152"  height="20" align="left" ><font color="#330101">Any type of loan(s) running?</font> </td>  <td colspan="3" align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td    height="20" colspan="2" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> <font color="#330101">Home</font><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /><font color="#330101">Personal</font></td></tr>        <tr> <td  width="60" height="20" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /><font color="#330101">Car</font></td>          <td  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /><font color="#330101">Property</font></td></tr><tr><td height="22"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="other" />            <font color="#330101">Other</font></td></tr></table></td></tr>		 <tr>    <td align="left" height="25" ><font color="#330101">How many EMI paid?</font>  </td>           <td colspan="3" align="left" width="158" height="18" ><select name="EMI_Paid" style="width:120px;"  > <option value="0">Please select</option><option value="1"><font color="#330101">Less than 6 months</font></option> <option value="2"><font color="#330101">6 to 9 months</font></option> <option value="3">9 to 12 months</option> <option value="4"><font color="#330101">more than 12 months</font></option ></select>  </td>	</tr></table></td>  </tr>';
			
		}
		
		return true;
}

function removeElementLoan()
{
		var ni = document.getElementById('myDivLoan');
		
		if(ni.innerHTML!="")
		{
		
			
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			
		}
		
		return true;

	}

	function submitform(Form)
	{

var btn2;
	var btn3;
	var myOption;
	var i;
	/*if(Form.Reference_Code1.value=="")
		{
		if(!Form.confirm.checked)
			{
				alert("if you havnt received activation code click check box.");
				document.personalloan_form.confirm.focus();
				return false;
		}
		else if(Form.confirm.checked)
			{
				if(Form.RePhone.value=="")
			{
				alert("Please Re confirm your mobile number again");
				Form.RePhone.focus();
				return false;
			}
			else if(isNaN(Form.RePhone.value)|| Form.RePhone.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value in ");
			  Form.RePhone.focus();
			  return false;  
		}
        else if (Form.RePhone.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 Form.RePhone.focus();
				return false;
        }
else if (Form.RePhone.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 Form.RePhone.focus();
                return false;
        }
			
		}
	}*/
	if(Form.Primary_Acc.value=="")
		{
			alert("Please fill your Salary Account.");
			Form.Primary_Acc.focus();
			return false;
		}
	
	if (Form.Years_In_Company.value=="")
	{
		alert("Please enter Years in Company.");
		Form.Years_In_Company.focus();
		return false;

	}	
	if(!checkNum(Form.Years_In_Company, 'No of years in current company',0))
		return false;

	if (Form.Total_Experience.value=="")
	{
		alert("Please enter Total Experience.");
		Form.Total_Experience.focus();
		return false;
	}	
	if(!checkNum(Form.Total_Experience, 'Total Experience',0))
		return false;

	myOption = -1;
		for (i=Form.LoanAny.length-1; i > -1; i--) {
			if (Form.LoanAny[i].checked) {
				if(i==0)
				{
					btn2=valButtonLoan();
					if(!btn2)
					{
						alert('Type of loan running.');
						return false;
					}
					if(Form.EMI_Paid.selectedIndex==0)
					{
						alert('No of EMI paid.');
						Form.EMI_Paid.focus();
						return false;
					}

				}
				myOption = i;
			}
		}
		if(myOption == -1) 
		{
			alert("You must select a Loan Any button");
			return false;
		}
		
return true;
}
function valButtonLoan() {
    var cnt = -1;
	var i;
    for(i=0; i<document.personalloan_form.Loan_Any.length; i++) 
	{
        if(document.personalloan_form.Loan_Any[i].checked)
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
function addElement()
{
	
		var ni = document.getElementById('myDiv');
		 var newdiv = document.createElement('div');
		
		if(ni.innerHTML=="")
		{
			
				ni.innerHTML = '<table border="0"><tr><td height="25"><font color="#330101">Reconfirm Mobile No.</font></td>	<td width="158" ><input size="18" type="text" style="margin-left:8px;" maxlength="10"  name="RePhone" id="RePhone"></td></tr></table>';
			
			ni.appendChild(newdiv);
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		//return true;
		}
</script>

</head>

<body>
<div id="container">
<div id="prsnl-top"></div>

<div id="prsnl-brdr" class="brder2">

<div id="left-content">
<div class="logo"></div>

<div id="txt-bld">Personal Loans by Choice not by Chance !</div>

<div id="img-lft"></div>
<div id="img-rgt"></div>

<div class="content-pnl">Just 3 Easy Steps!</div>
<div id="steps1">Post your Personal loan requirement</div>
<div id="steps2">Get & compare Personal loan offers from all Banks</div>
<div id="steps3">Get the best deal for your Personal loan Instanly.</div>
<div class="content-pnl" style="width:470px;">Best Deal in Personal Loans at Haryana, Punjab and Himachal Pradesh.</div>
<div class="content-pnl">www.deal4loans.com</div>
<div  class="content-deal">The one-stop shop for Best on all Personal Loan requirements
 Now get Offers from SBI,  ICICI, HDFC, Deutsche, Citibank, HSBC,
 Kotak and Standard Chartered and Choose the Best Deal!</div>
 <div class="content-pnl">Testimonial</div>
<div  class="content-deal">I think that the launch of a service like www.deal4loans.com
will ease the loan seeking and deal hunting process for the
likes of me. I wish u guys all the success.<div style="float:right; color:#4C2306;"><b>Divya</b></div></div>
</div>
<form name="personalloan_form"  action="t_y.php" method="POST" onsubmit="return submitform(document.personalloan_form);">

<div id="form-str">

<div id="form-top-lft">&nbsp;</div>
<div id="form-top-rgt">&nbsp;</div>
<div id="form-bld-text">Personal Loan Request</div>
<table width="310" border="0" align="center" cellpadding="0" cellspacing="0">
 <!-- <tr>
  <td height="25"><font color="#330101">Activation Code</font></td>
  <td width="158">
  <input   type="text" name="Reference_Code1" id="Reference_Code1"  size="18"  /></td>
  </tr>
 
  <tr>
  <td height="25" colspan="2" valign="top"><input   type="checkbox" style="border:none;"  name="confirm" value="hello"  id="confirm"  onClick="addElement();" > <font color="#330101"> If you havent received activation code sms</font></td>
  </tr>
   <tr><td colspan="2"><div id="myDiv"></div></td></tr>-->
  <tr>
   <td width="152" height="35" align="left"><font color="#330101">Primary Account<br />
 in which bank?		</font>		</td>
	<td height="20"  align="left"><input type="text" size="18"  name="Primary_Acc" ></td>
  </tr>
  <tr>
   <td align="left" height="20"><font color="#330101">Residential Status</font>			</td>
     <td  align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
       <tr><td ><input type="radio" style="border:none;" value="1" name="Residential_Status"  checked> <font color="#330101">Owned</font></td><td >
     <input type="radio" style="border:none;" value="2" name="Residential_Status" > <font color="#330101">Rented</font></td></tr>
	 <tr>
	 <td colspan="2"><input type="radio" style="border:none;" value="3" name="Residential_Status" ><font color="#330101"> Company Provided</font></td></tr></table></td>
  </tr>
  <tr>
    <td height="35" align="left" ><font color="#330101">No. of years in<br /> 
      this Company</font></td>

					 <td align="left" >
					<input type="text" name="Years_In_Company"  size="18" maxlength="15" ></td>
  </tr>
  <tr>
   <td height="42" align="left" ><font color="#330101">Total Experience (Years)/
					 Total Years<br /> 
			  in Business</font></td>
					 <td align="left" ><input size="18"  name="Total_Experience" onFocus="this.select();" >					</td>
  </tr>
  <tr><td colspan="2"><input type="hidden" value="PersonalLoan" name="type"></td></tr>
   <? if ($_SESSION['Temp_CC_Holder']==1 || $_SERVER['Temp_CC_Holder']==1)
			{?>
  <tr>
    <td height="30" align="left" ><font color="#330101">Credit Card Limit?</font></td>
					 <td align="left" ><input size="18"  name="Credit_Limit" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="this.select();" >					</td>
  </tr>
  <? } ?>
  <tr>
  <td height="30" align="left" ><font color="#330101">Any Loan running?</font></td>

					<td align="left" ><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onClick="addElementLoan(); addDiv();"><font color="#330101"> Yes</font> <input size="10" type="radio" style="border:none;" name="LoanAny"  onClick="removeElementLoan();" value="0" ><font color="#330101"> No</font></td>
  </tr>
  <tr><td colspan="2" id="myDivLoan"></td></tr>
 <? 
				if(($_SESSION['Temp_Net_Salary']<=200000) || ($Net_Salary<=200000))
				{?>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">


						 	<tr>
					<td align="left"  width="149" height="30"><font color="#330101">Mobile Connection?</font></td>
					<td width="155" colspan="3" align="left"><input type="radio" style="border:none;"  value="1"  name="Mobile_Connection"  >					  <font color="#330101">Yes</font> <input size="10" type="radio" style="border:none; margin-left:25px;" name="Mobile_Connection"  id="Mobile_Connection" value="2" ><font color="#330101"> No</font></td>
				</tr>
					<tr>

					<td align="left"  width="149" height="35"><font color="#330101">Do you have landline at your Residence?</font></td>
					<td align="left"  height="35" colspan="3"><input type="radio" style="border:none;"  value="1"  name="Landline_Connection" > <font color="#330101"> Prepaid </font><input size="10" type="radio" style="border:none;" name="Landline_Connection"   value="2" ><font color="#330101"> Postpaid</font></td>
				</tr>
				<tr>
					<td  width="149" rowspan="2" align="left"><font color="#330101"> Salary Drawn?</font></td>

				  <td height="30"  colspan="3" align="left" valign="bottom"><input type="radio" style="border:none;"  value="1"  name="Salary_Drawn" > <font color="#330101">Cash</font> <input size="10" type="radio" style="border:none; margin-left:20px;" name="Salary_Drawn"   value="3" ><font color="#330101"> Cheque</font> </td>
				</tr>
				<tr>
				  <td colspan="3" align="left" valign="top">
					<input size="10" type="radio" style="border:none;" name="Salary_Drawn"   value="2" >
				  <font color="#330101">Account Transfer</font></td>
			    </tr>
</table>
<? }?></td>
  </tr>
   
  <tr>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>
<div align="center"><input type="image" name="Submit"  src="images/pl/prsnl-sbtn.gif"  style="width:119px; height:34px; border:none; " /></div>
<div id="form-bt-lft" >&nbsp;</div>
<div id="form-bt-rgt">&nbsp;</div>
</div>
</form>

</div>
<div id="mynewDiv" ></div>
<div id="prsnl-bot"></div>
</div>


<!-- Google Code for Personal Loan Conversion Page -->

<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1056387586;

var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
if (1.0) {
  var google_conversion_value = 1.0;
}
var google_conversion_label = "lead";

//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height="1" width="1" border="0" src="http://www.googleadservices.com/pagead/conversion/1056387586/?value=1.0&amp;label=lead&amp;script=0"/>
</noscript>


</noscript>

</body>
</html>
