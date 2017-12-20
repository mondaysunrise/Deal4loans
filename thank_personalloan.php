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
		$Product_Name = "1";
		
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
				$InsertProductSql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Pincode, Reference_Code, source, CC_Bank, Card_Vintage,Referrer,Creative,Section, Updated_Date, IP_Address,Accidental_Insurance)
				VALUES ( '$UserID', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Pincode', '$Reference_Code','$source','$From_Pro','$Card_Vintage','$Referrer','$Creative','$Section', Now(),'$IP','$Accidental_Insurance')";
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
				$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID1 = mysql_insert_id();
				$InsertProductSql = "INSERT INTO Req_Loan_Personal (UserID, Name, Email, Employment_Status, Company_Name, City, City_Other, Mobile_Number, Std_Code, Landline, Net_Salary, CC_Holder, Loan_Amount, DOB, Count_Views, Count_Replies, IsModified, IsProcessed, IsPublic, Dated, Pincode, Reference_Code, source, CC_Bank, Card_Vintage,Referrer,Creative,Section, Updated_Date, IP_Address,Accidental_Insurance)
				VALUES ( '$UserID1', '$Name', '$Email', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Phone', '$Std_Code1', '$Phone1', '$Net_Salary', '$CC_Holder', '$Loan_Amount', '$DOB', 0, 0, 0, 0, '$IsPublic', Now(), '$Pincode', '$Reference_Code','$source','$From_Pro','$Card_Vintage','$Referrer','$Creative','$Section', Now(),'$IP','$Accidental_Insurance')";
				//echo "<br>else".$InsertProductSql;
				
				
			}
			//echo "hello>".$InsertProductSql."<br>";
			$InsertProductQuery = ExecQuery($InsertProductSql);
			$ProductValue = mysql_insert_id();
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
			$PostURL =$_POST["PostURL"]."?msg=".$msg;
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
<HTML>
<HEAD>
<title>Deal4Loans Personal Loan: Compare Personal Loans in India</title>
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read online information on home loans, car loans, personal loans, loans against property, loan providers and credit cards. Just fill in a simple form, Get, Compare and Choose deals from all the leading loan providers / banks">
<meta name="keywords" content="personal loan, personal loans, compare personal loan, compare personal loans, compare personal loan India, compare personal loans India, personal loan india, personal loan in india, personal loans india, personal loans in india, personal loan delhi, personal loan in delhi, personal loan mumbai, personal loan in mumbai, personal loan chennai, personal loan in chennai, personal loan bangalore, personal loan in bangalore">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<style>
.style4{
font-size:10px;
font-weight:bold;
color:#666699;
font-Family:Verdana;
}
h1.head1{ color:#FFFFFF; font-family:News Gothic std; font-size:40px; margin-left:20px; font-weight:bold;}
.text{font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; line-height:17px;  }
li{font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; font-weight:bold; }

input, select {font:12px Verdana; padding:2px; margin:0px; border: 1px solid #68718A;}
input.NoBrdr	{font:12px Verdana; padding:0px; margin:0px; border: 0px}
.style5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 20px;
	font-weight: bold;
	color: #FFFFFF;
}
.style6 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 14px;
}
</style>
<Script Language="JavaScript">


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
		
			
				ni.innerHTML = '<table border="0"><tr> <td align="left" class="style4" width="220" height="20" >Any type of loan(s) running? </td> <td colspan="3" class="style4" width="300" ><table border="0">	 <tr><td class="style4" width="60" height="20" ><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl">Home</td><td class="style4"  width="60" height="20"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl">Personal</td><tr><td  width="60" height="20" class="style4"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" id="Loan_Any" value="cl" >Car</td><td class="style4" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap">Property</td></tr><tr><td class="style4" ><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other">Other</td></tr> </table></td></tr><tr><td width="400" height="5" colspan="4">&nbsp;	 </td> </tr> <tr>    <td align="left"  width="200" height="20" class="style4">How many EMI paid?  </td>   <td colspan="3" align="left" width="300" height="18" ><select name="EMI_Paid" class="style4" style="float: left"> <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option </select>  </td>	</tr></table>';
			
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
			
				ni.innerHTML = '<table border="0"><tr><td align="left" class="style4" width="200" height="20">Reconfirm Mobile No.</td>	<td colspan="3" align="left" width="300" height="20" ><input size="18" type="text"  maxlength="10" class="style4"  name="RePhone" id="RePhone"></td></tr></table>';
			
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

</HEAD>
<BODY BGCOLOR="#EBF5FE" LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<!-- ImageReady Slices (Personal_Loan_landing_page1.psd) -->
<form name="personalloan_form"  action="t_y.php" method="POST" onsubmit="return submitform(document.personalloan_form);">
<TABLE WIDTH=1000 BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD ROWSPAN=11 width=200 height=1000 alt="" bgcolor="#EBF5FE">&nbsp;</TD>
		<TD COLSPAN=4>
			<IMG SRC="images/pl/Personal_Loan_landing_pa-03.jpg" WIDTH=600 HEIGHT=155 ALT=""></TD>
		<TD ROWSPAN=11 WIDTH=200 HEIGHT=1000 ALT="" bgcolor="#EBF5FE">&nbsp;</TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=155 ALT=""></TD>
	</TR>
	<TR>
		<TD ROWSPAN=2 WIDTH=265 HEIGHT=115 ALT="" bgcolor="#456688"><h1 class="head1">Just 3<br> easy steps!</h1></TD>
		<TD COLSPAN=3>
			<IMG SRC="images/pl/Personal_Loan_landing_pa-06.jpg" WIDTH=335 HEIGHT=14 ALT=""></TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=14 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=15 HEIGHT=566 ROWSPAN=5 background="images/pl/background-left.jpg" ALT="">&nbsp;</TD>
		<TD ROWSPAN=5 WIDTH=308 HEIGHT=566 ALT="" valign="top" style="background-image:url(images/pl/background.jpg)">
		
		<div style="margin-top:20px;" align="center">
		 <span style="font-size:18px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#6C6A6A; text-align:center; font-weight:bold;">Personal Loan Resquest</span>
		</div>
		<BR><div>
		  <div align="center" class="style6"> Step 2 of 2</div>
		</div>
		
		<table border="0" width="278" align="center" cellpadding="0" cellspacing="8" >
				
			    <tr align="center">
			      <td colspan="4" height="18" class="style6"><b>Please tell more about yourself</b>
		              <br>
</td>
			    </tr>
			<!--<tr>
				    <td width="230" height="30" align="left" ><font class="style4">Activation Code? </font>	  </td>
				   <td width="124" height="18" colspan="3" align="right"><input size="10"  maxlength="4" name="Reference_Code1" id="Reference_Code1"  class="style4" ></td>
				</tr>

				<tr>
				    <td colspan="4" align="left"  class="style4"  height="30" ><input   type="checkbox"  name="confirm" value="hello"  id="confirm" class="NoBrdr" onClick="addElement();" ><font class="style4"> if you havent received activation code sms </font> </td>
				</tr>
			<tr><td colspan="4"><div id="myDiv"></div></td></tr>-->
			<tr><td><input type="hidden" value="PersonalLoan" name="type"></td></tr>
		 <tr>
					<td align="left"  class="style4" width="230" height="20"><font class="style4">Primary Account in which bank?</font> 					</td>
					<td  align="left" colspan="3" width="270" height="20"><input type="text" size="18"  name="Primary_Acc"  class="style4" style="float: left" >
					</td>
		  </tr>	
				<tr>
					<td align="left"  class="style4" width="230" height="20"><font class="style4">Residential Status</font>			</td>
     <td class="style4" align="left" colspan="3" width="270" height="20"><table><tr><td class="style4"><input type="radio" value="1" name="Residential_Status" class="NoBrdr" checked>Owned</td><td class="style4">
     <input type="radio" value="2" name="Residential_Status" class="NoBrdr">Rented</td></tr><tr><td colspan="2" class="style4"><input type="radio" value="3" name="Residential_Status" class="NoBrdr">Company Provided</td></tr></table></td>
   </tr>
			
				 <tr>
					<td align="left" class="style4" width="230" height="20"><font class="style4">No. of years in this Company</font></td>
					 <td align="left" colspan="3" width="270" height="20">
					<input type="text" name="Years_In_Company" class="style4" size="18" maxlength="15" ></td>
				</tr>
				<tr>
					<td align="left" class="style4" width="230" height="20"><font class="style4">Total Experience(Years)/
					 Total Years in Business</font></td>
					 <td align="left" colspan="3" width="270" height="20"><input size="18" class="style4" name="Total_Experience" onFocus="this.select();" style="float: left">
					</td>
			   </tr>
			   <? if ($_SESSION['Temp_CC_Holder']==1 || $_SERVER['Temp_CC_Holder']==1)
			{?>
					<tr>
					<td align="left" class="style4" width="230" height="20"><font class="style4">Credit Card Limit?</font></td>
					 <td align="left" colspan="3" width="270" height="20"><input size="18" class="style4" name="Credit_Limit" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="this.select();" style="float: left">
					</td>
			   </tr>

						 <? }
						 ?>
				
						<tr>
					<td align="left" class="style4" width="280" height="20"><font class="style4">Any Loan running?</font></td>
					<td align="left" width="50" height="20"><input type="radio"  value="1"  name="LoanAny" class="NoBrdr" onClick="addElementLoan();"><font class="style4">Yes</font></td>
					<td align="left" width="50" height="18"  >
					<input size="10" type="radio" name="LoanAny" class="NoBrdr" onClick="removeElementLoan();" value="0" ><font class="style4">No</font></td><td >&nbsp;</td>
				</tr>
				<tr><td colspan="4" id="myDivLoan"></td></tr>
				<? //echo "hello".$_SESSION['Temp_Net_Salary'];
				if($_SESSION['Temp_Net_Salary']<=200000)
				{?>
		 	<tr>
					<td align="left" class="style4" width="280" height="20"><font class="style4">Mobile Connection?</font></td>
					<td align="left" width="50" height="20"><input type="radio"  value="1"  name="Mobile_Connection" class="NoBrdr" ><font class="style4">Yes</font></td>
					<td align="left" width="50" height="18"  >
					<input size="10" type="radio" name="Mobile_Connection" class="NoBrdr" id="Mobile_Connection" value="2" ><font class="style4">No</font></td><td >&nbsp;</td>
		  </tr>
					<tr>
					<td align="left" class="style4" width="280" height="20"><font class="style4">Do you have landline at your Residence?</font></td>
					<td align="left" width="50" height="20"><input type="radio"  value="1"  name="Landline_Connection" class="NoBrdr"><font class="style4">Prepaid</font></td>
					<td align="left" width="50" height="18"  >
					<input size="10" type="radio" name="Landline_Connection" class="NoBrdr"  value="2" ><font class="style4">Postpaid</font></td><td >&nbsp;</td>
				</tr>
				<tr>
					<td align="left" class="style4" width="280" height="20"><font class="style4">Salary Drawn?</font></td>
					<td align="left" width="50" height="20"><input type="radio"  value="1"  name="Salary_Drawn" class="NoBrdr"><font class="style4">Cash</font></td>
					<td align="left" width="50" height="20"  >
					<input size="10" type="radio" name="Salary_Drawn" class="NoBrdr"  value="2" ><font class="style4">Account Transfer</font></td><td ><input size="10" type="radio" name="Salary_Drawn" class="NoBrdr"  value="3" ><font class="style4">Cheque </font></td>
				</tr>
				<? } ?>
			<tr><td colspan="2" id="myDivLoan"></td></tr>
	
	
		  </table>
		<br>


		
		<div align="center" ><input  type="image" src="images/pl/submit99.jpg" style="border: 0px;"></div>
			
		</TD>
		</form>
		<TD WIDTH=12 HEIGHT=566 ROWSPAN=5 background="images/pl/background-right.jpg" ALT="">&nbsp;</TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=101 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=265 HEIGHT=129 ALT="" bgcolor="#749EC9">
	<ul style="list-style-image:url(images/pl/arrow2.jpg); padding:2px; line-height:20px; margin:0; margin-left:40px; ">
	  <li >Post your Personal loan requirement.</li>
<li>Get & compare Personal loan offers from all Banks.</li>
<li>Get the best deal for your Personal loan.</li></ul></TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=129 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=265 HEIGHT=123 ALT="" bgcolor="#EBF5FE" valign="top">
	 <div align="justify" style="margin-top:10px; margin-right:5px; margin-left:5px;"><span style="margin-top:15px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; color:#456688;">www.deal4loans.com</span><br><br>
		<span class="text"> The one-stop shop for best on all Personal loan requirements
Now get offers from ICICI, HDFC, Deutsche, Citibank, HSBC, Kotak, Standard Chartered ,and IDBI and choose the best deal!</span>
		</div>
		
		&nbsp;</TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=123 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=265 HEIGHT=96 ALT="" bgcolor="#EBF5FE"><div style="margin-left:5px; "><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:36px; color:#456688; font-weight:bold"><i>Helpful tips</i></span> <br><span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:20px; color:#456688; font-weight:bold"><i>to get the best</i></span><br> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:25px; color:#456688; font-weight:bold"><i>personal loan</i></span> <span style="font:Verdana, Arial, Helvetica, sans-serif; font-size:20px; color:#456688; font-weight:bold"><i>deal.</i></span></div></TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=96 ALT=""></TD>
	</TR>
	<TR>
	  <TD ROWSPAN=5 WIDTH=265 HEIGHT=382 ALT="" bgcolor="#EBF5FE" valign="top"><div align="justify" style=" margin-top:5px; margin-right:5px; margin-left:5px;"><span class="text" style="margin-top:10px;">Your eligibility & rates for Personal loans are provided on the basis of income, track record with any bank, credit card usage/payments and many more. To get the critical information for personal loan, Apply Now!
As it is an unsecured loan so banks try gauging your intention to pay loan. Customers tend to make mistakes while entering into deals, which is not beneficial to them, so its better to compare all the variables given by different banks before signing a loan agreement. The parameters on the basis of which you can compre a Personal Loan are:</span></div>

<ul style="list-style-image:url(images/pl/arrow3.jpg); line-height:20px; padding:2px; margin:0; margin-left:40px; font:Verdana; font-size:12px;">
	  <li> Eligibility.</li>
   <li>Interest rates best suited.</li>
<li>Processing Fees.</li>
<li>Pre-payment/Foreclosure charges.</li>
<li>Document required.</li>
<li>Turn Around Time.</li>
</ul>
<span style="float:right"><a href="http://www.deal4loans.com/Contents_Personal_Loan_Mustread.php"><img src="images/pl/know-more.jpg" border="0"></a></span></TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=117 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=3 bgcolor="#456689" valign="top">
			<IMG SRC="images/pl/Personal_Loan_landing_pa-14.jpg" WIDTH=335 HEIGHT=12 ALT="" ></TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=12 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=335 HEIGHT=71 COLSPAN=3 valign="middle"  ALT="" bgcolor="#456688">
		  <div align="center"><span class="style5"><img src="images/pl/announcement.jpg" width="31" height="31"> Testimonials</span> </div></TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=71 ALT=""></TD>
	</TR>
	<TR>
		<TD WIDTH=335 HEIGHT=160 COLSPAN=3 valign="top" background="images/pl/Personal_Loan_landing_pa-16.jpg" style="background-repeat:no-repeat" ALT="">
		
		<div style="margin-left:5px; margin-right:5px; margin-top:10px;"><span class="text">I think that the launch of a service like <a href="http://www.deal4loans.com/">www.deal4loans.com</a> will ease the loan seeking and deal hunting process for the likes of me. I wish u guys all the success.</span></div>
        <div><span style="float:right; font-weight:bold; margin-right :5px;">- Divya</span></div>
	  </TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=160 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=3 WIDTH=335 HEIGHT=22 ALT="" bgcolor="#EBF5FE">&nbsp;</TD>
		<TD>
			<IMG SRC="images/pl/spacer.gif" WIDTH=1 HEIGHT=22 ALT=""></TD>
	</TR>
</TABLE>
<!-- End ImageReady Slices --
GOOGLE CONVERSION CODE-->

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
<!--End of Google code-->
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
</BODY>
</HTML>