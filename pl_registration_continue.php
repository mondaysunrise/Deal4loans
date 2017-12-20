<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	



	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
			
		$UserID = $_SESSION['UserID'];
		$finalurl=$_POST["PostURL"];
		$bidderid =$_POST['bidderid'];
		$Name = FixString($Name);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Loan_Amount= FixString($Loan_Amount);
		$Pincode = FixString($Pincode);
		$DOB=$Year."-".$Month."-".$Day;
		$Phone = FixString($Phone);
		$Employment_Status = FixString($Employment_Status);
		$Card_Vintage = FixString($Card_Vintage);
		$Email = FixString($Email);
		$Company_Name = FixString($Company_Name);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$City = FixString($City);
		$From_Product = $_REQUEST['From_Product'];
		$City_Other = FixString($City_Other);
		$Net_Salary = $_REQUEST['IncomeAmount'];
		$CC_Holder = FixString($CC_Holder);
		$Card_Vintage = FixString($Card_Vintage);
		$_SESSION['Temp_CC_Holder'] = $CC_Holder;
		$Dated = ExactServerdate();

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


$Type_Loan="Req_Partner_PL";


if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
	    $DeleteIncompleteQuery=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	


		$crap = " ".$Name." ".$Email;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
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
	
	$getdetails="select RequestID From Req_Partner_PL Where (Mobile_Number not in (9971396361,9999570210,9811215138,9811555306,9873678914) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	
	 list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		$cntr=0;
	if($alreadyExist>0)
	{

		$ProductValue=$myrow[$cntr]['RequestID'];
		$_SESSION['Temp_LID'] = $ProductValue;
	$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");

	}
	else
	{
			$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Dated"=>$Dated, "Pincode"=>$Pincode, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance, "Referral_Flag"=>1, "Referral_ID"=>$_SESSION['BidderID']);
$table = 'Req_Partner_PL';
$insert = Maininsertfunc ($table, $dataInsert);
			
			
			$ProductValue = $insert;
			
			$_SESSION['Temp_LID'] = $ProductValue;
			list($First,$Last) = split('[ ]', $Name);

			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Personal Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Personal Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				//mail($Email, $SubjectLine, $Message2, $headers);
			}

	
			/*echo "<script language=javascript>"." location.href='apply-for-personal-loans-continue.php'"."</script>";	*/
		

	}

		}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}


}
?>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Personal Loans India Apply Compare</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<link href="style/new-bima.css" rel="stylesheet" type="text/css" />
 

<?php 
	 if(isset($_SESSION['UserType']))
	{
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td  background='http://www.deal4loans.com/images/logutbg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".ucwords($_SESSION['UserType'])." ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='Logout.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td bgcolor='#FFFFFF'>&nbsp;</td></tr></table></td></tr></table>";
	}
?>



  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->

<style>
 
body{	

background-color:#FFFFFF!important;
background-image:none!important;
}

h1{	font-family:Arial,Helvetica,sans-serif;
	font-size:17px;
	text-align:center;
	color:#443133;
	margin:0px;
	padding:15px 0px 3px 0px;
	line-height:19px;
	margin-bottom:10px;
	font-weight: bold;
} 
 
/* extra div*/
.expandeddiv{
height:138px;
width:auto;
border-left:2px solid #5578C8;
border-right:2px solid #5578C8;
}
.addexpandeddiv{
height:150px;
width:auto;
border-left:2px solid #5578C8;
border-right:2px solid #5578C8;
}

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
 
</style>

<script type="text/javascript">
window.addEvent('domready', function(){
var accordion = new Accordion('h3.atStart', 'div.atStart', {
opacity: false,
onActive: function(toggler, element){
toggler.setStyle('color', '#0b3154');
},

onBackground: function(toggler, element){
toggler.setStyle('color', '#0b3154');
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
		
			
				ni.innerHTML = '<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr><td width="160"  height="20" align="left" class="frmbldtxt">Any type of loan(s)<br>running?<br><img src="http://www.deal4loans.com/images/spacer.gif" width="170" height="1" border="0"></td><td colspan="3" align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0"><tr> <td    height="20" align="left"  class="tbl_txt" style="padding:0px;"><input type="checkbox" style="border:none;" id="Loan_Any" name="Loan_Any[]"  value="hl" /> Home</td><td align="left"class="tbl_txt" style="padding:0px;"><input type="checkbox" style="border:none;"  id="Loan_Any" name="Loan_Any[]" value="pl" /> Personal</td><td align="left">&nbsp;</td></tr><tr> <td  width="204" height="20" align="left" class="tbl_txt"  style="padding:0px;"><input type="checkbox" style="border:none;"  name="Loan_Any[]"  id="Loan_Any" value="cl" /> Car</td><td width="238" align="left" class="tbl_txt" style="padding:0px;" ><input type="checkbox" style="border:none;" name="Loan_Any[]" id="Loan_Any"  value="lap" /> Property</td><td width="372" align="left"  class="tbl_txt"><input type="checkbox" style="border:none;" name="Loan_Any[]2" id="Loan_Any[]"  value="other" /> Other</td></tr></table></td></tr><tr><td align="left" height="30" class="frmbldtxt">How many EMI paid?  </td> <td colspan="3"  align="left" ><select name="EMI_Paid" style="width:143px;"  > <option value="0">Please select</option><option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option> <option value="4">more than 12 months</option ></select></td></tr></table>';
			
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
	if(Form.Company_Type.selectedIndex==0)
{
	alert("Please enter Company Type to Continue");
	Form.Company_Type.focus();
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
//incpf=incomeproof();


//if((!incpf))
	//	{
		//	alert('please select the documents that you have or can arrange.');
			//			return false;
//		}
		
		
		
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
			
				ni.innerHTML = '<table border="0"><tr><td height="25">Reconfirm Mobile No.</td>	<td width="158" ><input size="18" type="text" style="margin-left:8px;" maxlength="10"  name="RePhone" id="RePhone"></td></tr></table>';
			
			ni.appendChild(newdiv);
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		//return true;
		}

		


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
<body onbeforeunload="HandleOnClose('closedby_hl.php')">
<table width="100%" border="0"  align="center" cellpadding="0" cellspacing="0" >
<tr>
   <td align="center">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
	  <td width="200" valign="top"><?php include '~Partners_Left.php';?></td>
        <td width="600" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table  width="600" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >
              <tr>
                <td valign="top"  >
				<table  width="438" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8" >
			<tr align="left">
			  <td height="10" colspan="2" ></td>
			  </tr>
			<tr align="left">
				  <td height="58" colspan="2" align="center" background="images/logintop_bg.gif"><h1> Personal Loan Quote Request</h1></td>
				  </tr>
              <tr>
                <td valign="top"  background="images/login-form-login-bg.gif" ><form name="personalloan_form"  action="pl_registration_thank.php" method="POST" onSubmit="return submitform(document.personalloan_form); ">
                <input type="hidden" name="leadid" value="<?php echo $ProductValue; ?>" readonly>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="10" colspan="3" ></td>
            </tr>
            <tr>
              <td width="25" align="left" class="frmbldtxt">&nbsp;</td>
              <td width="165" height="35" align="left" class="frmbldtxt">Primary Account in which bank?</td>
              <td width="226" height="20"  align="left"><input type="text" style="width:140px;" name="Primary_Acc" id="Primary_Acc" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onChange="getstatementlink();" onKeyDown="getstatementlink();" onClick="getstatementlink();"></td>
            </tr>
            <tr>
              <td align="left" class="frmbldtxt">&nbsp;</td>
              <td height="20" align="left" class="frmbldtxt">Residential Status </td>
              <td  align="left" ><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                  <tr class="tbl_txt">
                    <td width="11%" ><input type="radio" style="border:none;" value="1" name="Residential_Status"  checked="checked" /></td>
                    <td width="32%" height="22"  class="tbl_txt" style="padding-left:0px;"> Owned</td>
                    <td width="9%" height="22" ><input type="radio" style="border:none;" value="2" name="Residential_Status" /></td>
                    <td width="48%" height="22"  class="tbl_txt" style="padding-left:0px;"> Rented</td>
                    </tr>
                  <tr>
                    <td ><input type="radio" style="border:none;" value="3" name="Residential_Status" /></td>
                    <td height="22" colspan="3"  class="tbl_txt" style="padding-left:0px;"> Company Provided</td>
                    </tr>
              </table></td>
            </tr>
			<tr>
			  <td class="frmbldtxt">&nbsp;</td>
                <td height="35" class="frmbldtxt">Company Type</td>
          <td class="frmtxt"><select name="Company_Type" id="Company_Type" style="width:143px;">
		  <option value="0">Please Select</option>
		  	<option value="1">Pvt Ltd</option>
			<option value="2">MNC Pvt Ltd</option>
			<option value="3">Limited</option>
			</select></td>
        </tr>  
            <tr>
              <td align="left" class="frmbldtxt" >&nbsp;</td>
              <td height="35" align="left" class="frmbldtxt" >No. of years in  
                Current Company</td>
              <td align="left" ><input type="text" name="Years_In_Company" style="width:140px;" maxlength="15"></td>
            </tr>
            <tr>
              <td align="left" class="frmbldtxt" >&nbsp;</td>
              <td height="42" align="left" class="frmbldtxt" >Total Experience (Years)/
                Total Years  
                in Business</td>
              <td align="left" ><input style="width:140px;"  name="Total_Experience" onFocus="this.select();">              </td>
            </tr>
            <tr>
              <td colspan="3"><input type="hidden" value="PersonalLoan" name="type" /></td>
            </tr>
            <? if ($_SESSION['Temp_CC_Holder']==1 || $_SERVER['Temp_CC_Holder']==1)
			{?>
            <tr>
              <td align="left" class="frmbldtxt" >&nbsp;</td>
              <td height="30" align="left" class="frmbldtxt" >Credit Card Limit?</td>
              <td align="left" ><input style="width:140px;" name="Credit_Limit" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onFocus="this.select();">              </td>
            </tr>
            <? } ?>
            <tr>
              <td align="left" class="frmbldtxt" >&nbsp;</td>
              <td height="30" align="left" class="frmbldtxt" >Any Loan running?</td>
              <td align="left" class="tbl_txt" ><input type="radio" style="border:none;"  value="1"  name="LoanAny"  onclick="addElementLoan(); addDiv();" /> Yes &nbsp;&nbsp; <input size="10" type="radio" style="border:none;" name="LoanAny"  onclick="removeElementLoan();" value="0"> No</td>
            </tr>
            <tr>
			<td>&nbsp;</td>
              <td colspan="2" id="myDivLoan"></td>
            </tr>
           
            <tr>
			<td>&nbsp;</td>
              <td height="35" colspan="2" align="left"  class="frmbldtxt" style="font-weight:normal; line-height:17px;"><b> Documentation Wizard-<br> 
                </b>
                Please share which of the following documents that you have or can arrange , so that we can let you know what more documents are required by each bank. This will help you to choose your Personal Loan Provider better.</td>
              </tr>
           <tr>
		   <td>&nbsp;</td>
              <td height="25" colspan="2"  align="left" class="frmbldtxt">Which of the following Documents you Have? [<span style="color:#FF0000;">Optional</span>]</td>
            <tr>
              <td>&nbsp;</td>
              <td height="25" colspan="2"  align="left" class="frmbldtxt"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="5%" height="20" align="center" valign="middle"><input type="checkbox" value="Appointment Letter" name="Document_proof[]" id="Document_proof" style="border:none;"/></td>
                  <td width="44%" align="left" class="tbl_txt">Appointment Letter </td>
                  <td width="6%" align="center" valign="middle" class="tbl_txt"><input type="checkbox" value="Form16" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                  <td width="45%" align="left" class="tbl_txt">Form -16</td>
                </tr>
                <tr>
                  <td height="20" align="center" valign="middle"><input type="checkbox" value="Latest 3 months salary slip" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                  <td align="left" class="tbl_txt">Latest 3 months Salary Slip</td>
                  <td width="6%" align="center" valign="middle" class="tbl_txt"><input type="checkbox" value="6 months bank statement" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                  <td align="left" class="tbl_txt">6 months Bank Statement</td>
                </tr>
                <tr>
                  <td width="5%" height="20" align="center" valign="middle"><input type="checkbox" value="Pancard" name="Document_proof[]" id="Document_proof"style="border:none;" /></td>
                  <td width="44%" align="left" class="tbl_txt">Pan Card </td>
                  <td width="6%" align="center" valign="middle" class="tbl_txt"><input type="checkbox" value="Voterid" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                  <td width="45%" align="left" class="tbl_txt">Voter Id </td>
                </tr>
                <tr>
                  <td height="20" align="center" valign="middle"><input type="checkbox" value="Passport" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                  <td align="left" class="tbl_txt">Passport</td>
                  <td align="center" valign="middle" class="tbl_txt"><input type="checkbox" value="Driving License" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                  <td align="left" class="tbl_txt">Driving License </td>
                </tr>
                <tr>
                  <td height="20" align="center" valign="middle"><input type="checkbox" value="photo" name="identification_proof[]" id="identification_proof"  style="border:none;"/></td>
                  <td align="left" class="tbl_txt">Passport size photo </td>
                  <td height="20" align="center" valign="middle" class="tbl_txt"><input type="checkbox" value="LIC Policy" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                  <td align="left" class="tbl_txt">LIC Policy 
                             
                          
                            <tr>
                              <td height="20" align="center" valign="middle"><input type="checkbox" value="Telephone Bill" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                              <td align="left" class="tbl_txt">Telphone Bill </td>
                              <td align="center" valign="middle" class="tbl_txt"><input type="checkbox" value="Electricity Bill" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                              <td align="left" class="tbl_txt">Electricity Bill </td>
                            </tr>
                            <tr>
                              <td height="20" align="center" valign="middle"><input type="checkbox" value="Loan Track" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                              <td align="left" class="tbl_txt">Loan Track </td>
                              <td align="center" valign="middle" class="tbl_txt"><input type="checkbox" value="Credit Card photocopy" name="Document_proof[]" id="Document_proof"  style="border:none;"/></td>
                              <td align="left" class="tbl_txt">Credit Card photocopy</td>
                            </tr>
              </table></td>
            <tr>
              <td colspan="3">&nbsp; 
              
                        </td>
            </tr>
            <tr>
              <td  colspan="3" align="left"  >&nbsp;</td>
            </tr>
            <tr>
              <td height="35" colspan="3" align="center"><input type="image" name="Submit"  src="new-images/pl/quote.gif"  style="width:115px; height:29px; border:none; " /></td>
            </tr>
          </table>
				</form>
					</td>
              </tr>
             
              <tr>
                <td width="438" height="16" align="left" valign="top" ><img src="images/loginbt_bg.gif" width="438" height="16" /></td>
              </tr>
			  <tr align="left">
			  <td height="10" colspan="2" ></td>
			  </tr>
              
            </table>
				
		  
		 </td>
              </tr>
             
              <tr>
                <td height="10" ></td>
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


</body>
</html>
