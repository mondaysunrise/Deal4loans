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
		Maindeletefunc($DeleteIncompleteSql,$array = array());
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
		$Product_Name = 1;
		
		//$Sql = "INSERT INTO `tataaig_leads` ( T_RequestID , T_Product , T_City, Mobile_Number, T_Dated ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";

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
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Count_Views'=>'0', 'Count_Replies'=>'0', 'IsModified'=>'0', 'IsProcessed'=>'0', 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'CC_Bank'=>$CC_Bank, 'Card_Vintage'=>$Card_Vintage, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance);
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Count_Views'=>'0', 'Count_Replies'=>'0', 'IsModified'=>'0', 'IsProcessed'=>'0', 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'CC_Bank'=>$CC_Bank, 'Card_Vintage'=>$Card_Vintage, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance);
				//echo "<br>else".$InsertProductSql;
				
				
			}
			//echo "hello>".$InsertProductSql."<br>";
			$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);	
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Personal");
				}
			$_SESSION['Temp_LID'] = $ProductValue;
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get bidder contacts & quotes. And help us serve you better.";
			//if(strlen(trim($Phone)) > 0)
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
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="stylesheet" href="css/personal-loan1.css" type="text/css" />
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style type="text/css">
		/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
		height:50px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>
<style>
h3{
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	text-decoration:none;
	color:#660000;
	padding:0px;
	margin:0px 0px 0px 0px;
	text-align:left;
	cursor:pointer;
}

.faqContainer .toggler {
	padding:5px 0px 0px 15px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:17px;
	font-weight:bold;
	text-align:justify;
	cursor:pointer;
}

.elementInside{
	border-bottom:1px dashed #6a290d;
	margin:0px 0px 4px 0px;
	padding:0px 0px 6px 0px; 
}
</style>

<script type="text/javascript">
window.addEvent('domready', function(){
var accordion = new Accordion('h3.atStart', 'div.atStart', {
opacity: false,
onActive: function(toggler, element){
toggler.setStyle('color', '#330101');
},

onBackground: function(toggler, element){
toggler.setStyle('color', '#330101');
}
}, $('accordion'));

//This is for default selected optio		
var newTog = new Element('h3', {'class': 'toggler1'}).setHTML('');

var newEl = new Element('div', {'class': 'element1'}).setHTML('');

accordion.addSection(newTog, newEl, 0);
}); 

//
</script>
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
		
			
				ni.innerHTML = ' <tr> <td colspan="2" align="left"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td width="200"  height="20" align="left" ><font color="#330101">Any type of loan(s) running?</font> </td><td colspan="3" align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td    height="20" align="left" ><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /><font color="#330101">Home</font></td><td align="left"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /><font color="#330101">Personal</font></td><td align="left">&nbsp;</td></tr><tr> <td  width="71" height="20" align="left" ><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /><font color="#330101">Car</font></td><td width="93" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /><font color="#330101">Property</font></td><td width="160" align="left"  ><input type="checkbox" style="border:none;" name="Loan_Any[]2" id="Loan_Any[]"  value="other" /><font color="#330101">Other</font></td></tr></table></td></tr><tr><td align="left" height="25" ><font color="#330101">How many EMI paid?</font>  </td> <td colspan="3" align="left" width="324" height="18" ><select name="EMI_Paid" style="width:200px;"  > <option value="0">Please select</option><option value="1"><font color="#330101">Less than 6 months</font></option> <option value="2"><font color="#330101">6 to 9 months</font></option> <option value="3">9 to 12 months</option> <option value="4"><font color="#330101">more than 12 months</font></option ></select></td></tr></table></td>  </tr>';
			
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
	var incpf;
	
	
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
incpf=incomeproof();


if((!incpf))
		{
			alert('please select the documents that you have or can arrange.');
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

function incomeproof() {
    var cnt = -1;
	var i;
    for(i=0; i<document.personalloan_form.Document_proof.length; i++) 
	{
        if(document.personalloan_form.Document_proof[i].checked)
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

		
/*********************************************************************************************************/
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

		function getstatementlink()
		{
			var primary_acc=document.getElementById('Primary_Acc').value;		
			//alert(primary_acc);
			//if((document.getElementById('Primary_Acc').value>0))
			//{
				var queryString = "?primary_acc=" + primary_acc;
		//alert(queryString); 
				ajaxRequest.open("GET", "get_statement_link.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{				
						// alert(ajaxRequest.responseText);
						var ajaxDisplay = document.getElementById('myDivstatement');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}
				ajaxRequest.send(null); 
			 //}
			
		}
		
		
		
	window.onload = ajaxFunction;
	/*********************************************************************************************************/
	
	

function askfordoc()
{
var answer = confirm ("Please select the documents that you have or can arrange.")
	if (answer)
	{
	}
	else
	{
	form.submit();
	}
}

</script>

</head>

<body>
<div id="container">
<div id="prsnl-top"></div>
 
<div id="prsnl-brdr" class="brder2">
  <div class="logo"></div>
 
  <form name="personalloan_form"  action="t_y.php" method="POST" onsubmit="return submitform(document.personalloan_form); ">
   
    <div style="clear:both;" align="center" id="form-str">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><div id="form-bld-text">Personal Loan Quote Request</div></td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="71%" align="right" style="font-size:13px;">50% Of your Loan Quote Application is Complete </td>
              <td width="29%" align="left" style="padding-left:5px;"><!--<img src="images/bar.gif" width="220" height="19" /> -->
                  <img src="images/loader.gif" width="24" height="24" /></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="25" align="center"><span style="font-size:13px;">Please Share your Profile to Help you give your&nbsp; Eligibility and EMI Offers from Banks</span></td>
        </tr>
        <tr>
          <td style="padding-top:10px;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
            
            <tr>
              <td width="275" height="35" align="left"><font color="#330101">Primary Account 
                in which bank? </font> </td>
              <td width="375" height="20"  align="left"><input type="text" style="width:200px;" name="Primary_Acc" id="Primary_Acc" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onchange="getstatementlink();" onkeydown="getstatementlink();" onclick="getstatementlink();"></td>
            </tr>
            <tr>
              <td align="left" height="20"><font color="#330101">Residential Status</font> </td>
              <td  align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="23%" ><input type="radio" style="border:none;" value="1" name="Residential_Status"  checked="checked" />
                        <font color="#330101">Owned</font></td>
                    <td width="26%" ><input type="radio" style="border:none;" value="2" name="Residential_Status">
                        <font color="#330101">Rented</font></td>
                    <td width="51%" ><input type="radio" style="border:none;" value="3" name="Residential_Status" />
                        <font color="#330101"> Company Provided</font></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="35" align="left" ><font color="#330101">No. of years in  
                this Company</font></td>
              <td align="left" ><input type="text" name="Years_In_Company" style="width:200px;" maxlength="15"></td>
            </tr>
            <tr>
              <td height="42" align="left" ><font color="#330101">Total Experience (Years)/
                Total Years <br />
                in Business</font></td>
              <td align="left" ><input style="width:200px;"  name="Total_Experience" onfocus="this.select();">              </td>
            </tr>
            <tr>
              <td colspan="2"><input type="hidden" value="PersonalLoan" name="type" /></td>
            </tr>
            <? if ($_SESSION['Temp_CC_Holder']==1 || $_SERVER['Temp_CC_Holder']==1)
			{?>
            <tr>
              <td height="30" align="left" ><font color="#330101">Credit Card Limit?</font></td>
              <td align="left" ><input style="width:200px;" name="Credit_Limit" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onfocus="this.select();">              </td>
            </tr>
            <? } ?>
            <tr>
              <td height="30" align="left" ><font color="#330101">Any Loan running?</font></td>
              <td align="left" ><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan(); addDiv();" />
                  <font color="#330101"> Yes</font>
                  <input size="10" type="radio" style="border:none;" name="LoanAny"  onclick="removeElementLoan();" value="0">
                <font color="#330101"> No</font></td>
            </tr>
            <tr>
              <td colspan="2" id="myDivLoan"></td>
            </tr>
            <? 
				//if(($_SESSION['Temp_Net_Salary']<=200000) || ($Net_Salary<=200000))
				//{?>
            <!--<tr>
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
<? //}?></td>
  </tr> -->
            <tr>
              <td height="35" colspan="2" align="left" style="font-weight:normal; line-height:17px;"><div ><b>Documentation Wizard-</b></div>
                Please share which of the following documents that you have or can arrange , so that we can let you know what more documents are required by each bank.This will help you to choose your Personal Loan Provider better.</td>
              </tr>
           <tr>
              <td height="25"  align="left" colspan="2"><font color="#330101">Which of the following Documents you Have?</font></td>
            <tr>
              <td colspan="2"><!--      <h3>FAQs</h3>-->
              
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="4%" height="20" align="center" valign="middle"><input type="checkbox" value="Appointment Letter" name="Document_proof[]" id="Document_proof" style="border:none;"/></td>
                            <td width="38%" align="left">Appointment Letter </td>
                            <td width="4%" align="center" valign="middle"><input type="checkbox" value="Form16" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td width="54%" align="left">Form -16</td>
                          </tr>
                          <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="Latest 3 months salary slip" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Latest 3 months Salary Slip</td>
							<td width="4%" align="center" valign="middle"><input type="checkbox" value="6 months bank statement" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
							<td align="left">6 months Bank Statement</td>
                          </tr>
                          <!--<tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="6 months Bank Statement" name="income_proof[]" id="income_proof" style="border:none;" /></td>
                            <td colspan="3" align="left">6 months Bank Statement </td>
                          </tr>-->
                        
                        
                          <tr>
                            <td width="4%" height="20" align="center" valign="middle"><input type="checkbox" value="Pancard" name="Document_proof[]" id="Document_proof"style="border:none;" /></td>
                            <td width="38%" align="left">Pan Card </td>
                            <td width="4%" align="center" valign="middle"><input type="checkbox" value="Voterid" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td width="54%" align="left">Voter Id </td>
                          </tr>
                          <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="Passport" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Passport</td>
                            <td align="center" valign="middle"><input type="checkbox" value="Driving License" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Driving License </td>
                          </tr>
                          <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="photo" name="identification_proof[]" id="identification_proof"  style="border:none;"/></td>
                            <td align="left">Passport size photo </td>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="LIC Policy" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">LIC Policy 
                       
                          
                          <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="Telephone Bill" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Telphone Bill </td>
                            <td align="center" valign="middle"><input type="checkbox" value="Electricity Bill" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Electricity Bill </td>
                          </tr>
						  <tr>
                            <td height="20" align="center" valign="middle"><input type="checkbox" value="Loan Track" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Loan Track </td>
                            <td align="center" valign="middle"><input type="checkbox" value="Credit Card photocopy" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                            <td align="left">Credit Card photocopy</td>
                          </tr>
						
                        </table>
                     
                    </td>
            </tr>
            <tr>
              <td  colspan="2" align="left"  >&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="2" align="center"><input type="submit" name="Submit" style="height:25px; background-color:#c25b12; color:#FFFFFF; border:none;" value="Get Quote"></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
  <div align="center">
  </div>
  </form>
  
</div><div id="mynewDiv" ></div>
<div id="prsnl-bot"></div>
</div>

<!-- Google Code for brandPL Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "3Qh4CJ-bogEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=3Qh4CJ-bogEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>
