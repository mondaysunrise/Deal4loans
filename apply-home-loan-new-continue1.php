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

	$Name = $_POST['Name'];
	$Activate = $_POST['Activate'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
	$City_Other = $_POST['City_Other'];
	$Net_Salary = $_POST['IncomeAmount'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	$Accidental_Insurance = $_POST['Accidental_Insurance'];
	$Referrer=$_REQUEST['referrer'];
	//$Reference_Code = generateNumber(4);
	$IP = getenv("REMOTE_ADDR");
	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
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
		$Product_Name = "2";
		$data = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $data);
	}


		$crap = " ".$Name." ".$Email." ".$City_Other;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From ".$Type_Loan."  Where (Mobile_Number not in (9971396361,9811215138,9891118553) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
				list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr = count($myrow)-1;
			$checkNum = $alreadyExist;

			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
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
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance);
			//	echo "<br>if".$InsertProductSql;
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance);
				//echo "<br>else".$InsertProductSql;
			}
			
				$ProductValue = Maininsertfunc ($Type_Loan, $data);		
			//exit();
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Home");
				}
			
			list($First,$Last) = split('[ ]', $Name);

			//echo "heelo";
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan.";
			if(strlen(trim($Phone)) > 0)
				//SendSMS($SMSMessage, $Phone);
			NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
			
			
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

<!doctype html>
<html lang="en"><head>
<meta charset="utf-8">
<title>Home Loans India Apply Compare | Housing Mortage Loan</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read and apply online for home loans & Get, Compare and Choose deals from all the leading loan providers / banks. Know the interest rates, EMIs, Loan amount etc choose the Best Deal.">
<meta name="keywords" content="Home loans India, Apply Home Loans, Compare Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/apply-home-loan-new-continue-styles.css" type="text/css" rel="stylesheet">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true
				
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
	</script>
<style type="text/css">
.bldtxt {font-weight:bold; line-height:16px; color:#5e5e5e;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px; }
.nrmltxt {line-height:16px;	color:#5e5e5e;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px; }
.orgtext {color:#d75b10;	line-height:16px;	font-weight:bold;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:10px; }
#slider {width:590px;	margin:0 0 0 50px; }

body{	margin:0px;	padding:0px; font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	line-height:16px;	color:#292323; }
input{	margin:0px;	padding:0px; border:1px solid #878787; }
select{	margin:0px;	padding:0px; border:1px solid #878787; }
.orgtext{	color:#d75b10;	line-height:16px;	font-weight:bold;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:10px; }
.nrmltxt{ font-weight:normal; text-align:justify;	line-height:16px;	color:#5e5e5e;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px; }
.nrmltxt span{font-weight:bold;	color:#a9643a;	font-size:12px; }

.bldtxt{ font-weight:bold; line-height:16px; color:#5e5e5e;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px; }
#mainContainer{	width:660px;	margin:0 auto;	text-align:left;	height:100%;			border-left:3px double #000;	border-right:3px double #000;	}
#formContent{		padding:5px;	}
#ajax_listOfOptions{
	position:absolute;	/* Never change this one */
	width:250px;	/* Width of box */
	height:160px;	/* Height of box */
	overflow:auto;	/* Scrolling features */
	border:1px solid #317082;	/* Dark green border */
	background-color:#FFF;	/* White background color */
	color: black;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	text-align:left;
	font-size:10px;
	z-index:100;
	}
#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
	margin:1px;			padding:1px;	cursor:pointer;	font-size:10px;	}

#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
	background-color:#2375CB;	color:#FFF;	}
#ajax_listOfOptions_iframe{	background-color:#F00;	position:absolute;	z-index:5;	}
form{	display:inline;	}
 #slider{	width:590px;	margin:0 0 0 50px; }	
#slider ul, #slider li{	margin:0;	padding:0;	list-style:none; }
#slider li{ 
	/* 
	define width and height of list item (slide)
	entire slider area will adjust according to the parameters provided here
	*/ 
	width:590px;	height:65px;	overflow:hidden; }
#slider li div{	display:block;	float:left;	width:143px; }
p#controls{	margin:-76px 0 0 15;	position:relative;	width:650px; } 
#prevBtn, #nextBtn{ 	display:block;	overflow:hidden;	text-indent:-8000px;			width:36px;	height:80px;	position:absolute; }	
#nextBtn{ 	left:605px; }														
#prevBtn a, #nextBtn a{ 	display:block;	width:36px;	height:84px;	background: url(new-images/hl/slider/prv-btn.jpg) no-repeat left center; }	
#nextBtn a{ 	background: url(new-images/hl/slider/nxt-btn.jpg) no-repeat left center; }	
</style>

<Script Language="JavaScript">
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

function Trim(strValue) {
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
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
			var newdiv = document.createElement('div');
		if(ni.innerHTML=="")
		{
			ni.innerHTML = '<table border="0"><tr><td height="20" width="50%" align="left" valign="middle" class="nrmltxt"><span class="form-text">Reconfirm Mobile No.</span></td>	<td colspan="3" align="left" width="50%" height="20" ><input type="text" onChange="intOnly(this);" style="width:113px;" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; name="RePhone" id="RePhone"></td></tr></table>';

				ni.appendChild(newdiv);
		
		}
			
		else if(ni.innerHTML!="")
		{
					
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
			
		}
		
		//return true;
}

	
	

function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		var ni1 = document.getElementById('myDiv2');
		
		if(ni.innerHTML=="")
		{
		
			if(document.home_loan.Property_Identified.value="on")
			{
				ni1.innerHTML = '';
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0" cellspacing="0" cellpadding="0" align="left"><tr><td align="left" valign="middle" class="nrmltxt"  style="color:#4b4b4b;" width="120">Property Location</td><td colspan="3" align="left" ><select style="width:140px;" name="Property_Loc" id="Property_Loc"><?=getCityList1($City)?></select><div id="propLocVal" class="alert_msg"></div></td></tr></table>';//
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
		
			if(document.home_loan.Property_Identified.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				ni1.innerHTML = '<table border="0" cellspacing="0" cellpadding="0" align="left"><tr><td height="20" colspan="2" align="left" valign="center" class="nrmltxt"><input type="checkbox" name="updateProperty" style="border:none; color:#4b4b4b;"> Can we tell you about some properties</td></tr></table>';
			}
		}
		
		return true;

}	
	function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

	
	
	function submitform(Form)
	{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var btnvalidate;
	var cnt=-1;
	var i;
	var btn;
	
	if((space.test(Form.day.value)) || (Form.day.value=="dd"))
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		Form.day.select();
		return false;
	}
	
	else if(!num.test(Form.day.value))
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill numeric value!</span>";
		Form.day.focus();
		return false;
	}
	
	else if((Form.day.value<1) || (Form.day.value>31))
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
		Form.day.focus();
		return false;
	}
	
	else if((space.test(Form.month.value)) || (Form.month.value=="mm"))
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		Form.month.focus();
		return false;
	}
	
	else if(!num.test(Form.month.value))
	{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill numeric value!</span>";
	Form.month.focus();
	return false;
	}
	
	else if((Form.month.value<1) || (Form.month.value>12))
	{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
	Form.month.focus();
	return false;
	}
	
	else if((Form.month.value==2) && (Form.day.value>29))
	{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month February not more than 29 days!</span>";	
	Form.day.focus();
	return false;
	}
	
	else if((space.test(Form.year.value)) || (Form.year.value=="yyyy"))
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill year of Birth!</span>";
	Form.year.focus();
	return false;
	}
	
	else if(!num.test(Form.year.value))
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill numeric value!</span>";
	Form.year.focus();
	return false;
	}
	
	else if((Form.day.value > 28) && (parseInt(Form.month.value)==2) && ((Form.year.value%4) != 0))
	{
//	alert("February cannot have more than 28 days.");
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>February not more than 28 days!</span>";
	Form.day.focus();
	return false;
	}
	
	else if(Form.year.value.length != 4)
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill numeric value!</span>";
		Form.year.focus();
		return false;
	}
	else if(Form.year.value > parseInt(mdate-21) || Form.year.value < parseInt(mdate-62))
	{
	document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>age between 18 -62!</span>";
	Form.year.focus();
	return false;
	}
	
	else if((parseInt(Form.day.value)==31) && ((parseInt(Form.month.value)==4)||(parseInt(Form.month.value)==6)||(parseInt(Form.month.value)==9)||(parseInt(Form.month.value)==11)||(parseInt(Form.month.value)==2)))
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Cannot have 31st Day!</span>";
	Form.day.select();
	return false;
	}

	if((Form.Pincode.value=='PinCode') || (Form.Pincode.value=='PinCod') || (Form.Pincode.value=='') || Trim(Form.Pincode.value)==false)
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Fill Pincode!</span>";
		Form.Pincode.focus();
		return false;
	}
	else if(Form.Pincode.value.length < 6)
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Fill 6 digits!</span>";
		Form.Pincode.focus();
		return false;
	}
	else if(containsalph(Form.Pincode.value)==true)
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Fill numeric value!</span>";
		Form.Pincode.focus();
		return false;
	}
	
	 if(Form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		Form.Employment_Status.focus();
		return false;
	}
		if(Form.Company_Name.value=="")
		{
			document.getElementById('companyVal').innerHTML = "<span  class='hintanchor'>Enter Company Name!</span>";
			Form.Company_Name.focus();
			return false;
		}
		
		for(i=0; i<Form.Property_Identified.length; i++) 
		{
			if(Form.Property_Identified[i].checked)
			{
				cnt= i;
			}
		}
		if(cnt == -1) 
		{
			document.getElementById('propLocVal').innerHTML = "<span  class='hintanchor'>Property identified or not!</span>";				
			return false;
		}
		if(cnt ==0)
		{ 
			if(Form.Property_Loc.selectedIndex==0)
			{
			document.getElementById('propEditifiedVal').innerHTML = "<span  class='hintanchor'>Select Property Location!</span>";	
			Form.Property_Loc.focus();
			return false;
			}
		}
		
		if (Form.Loan_Time.selectedIndex==0)
		{
			//alert("Please enter when you are planning to take loan");
			document.getElementById('propPlanVal').innerHTML = "<span  class='hintanchor'>When planning to take loan!</span>";
			Form.Loan_Time.focus();
			return false;
		}
		return true;
	}	

	function showdetailsFaq(d,e)
	{			
		for(j=1;j<=e;j++)
		{
			if(d==j)
			{
				if(eval(document.getElementById("divfaq"+j)).style.display=='none')
				{
				
					eval(document.getElementById("divfaq"+j)).style.display=''
					//eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
				}
				else
				{
					
					eval(document.getElementById("divfaq"+j)).style.display='none'
					//eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
				}
			}
		}
	}

</script>
</head>

<body>
<div id="pagewrap">

  <header id="header_new" style="height:35px;">
<div class="apply-hl_logo"><img src="images/apply-home-loan-new-logo.jpg"></div>
<div class="apply-hl_logotext">Home Loans by Choice not by chance!!</div>
  </header>
  <div style="clear:both;"></div>
	
  <div id="content_new_bnr">
 <!-- <div class="sample_table"><img src="new-images/hl/apply-home-loan-new-continue-sample.jpg"></div> -->

		<article >
		  <div style=" float:left;"> <table width="100%" border="0" cellpadding="0" cellspacing="0">
		    <tr>
		      <td width="100%">
             
              </td>
	        </tr>
	      </table>
          </div>
         <div class="apply-hl_banner"><img src="images/home-loan-new-cont_loading.gif"></div>
                 
          
   	</article>
                  
  </div>
  <div class="apply-hl_why">
  <div style="width:100%;"> <div style="color:#7a8082; font-family:Arial, Helvetica, sans-serif; font-size:15px; font-weight:bold; padding-bottom:15px; width:96%; padding-left: 10px; "><div style="color:#333333; font-family:Arial, Helvetica, sans-serif; font-size:19px; font-weight:bold; padding-bottom:10px;">List of top Home Loans Banks in India</div><span style="font-size:20px; color:#156dd1;">  SBI (State Bank of India), </span><span style="font-size:18px; color:#da251c; font-weight:bold; ">Hdfc Ltd</span>, <span style="font-size:18px; font-weight:bold;  color:#1a5b9b;">LIC Housing</span>, <span style="font-size:18px; font-weight:bold;  color:#942b25;">ICICI Bank</span>, <span style="font-size:18px; font-weight:bold;  color:#aa2a5d;">Axis Bank</span>, <span style="font-size:16px; font-weight:bold;  color:#1c689a;">Bajaj Finserv</span>, <span style="font-size:17px; font-weight:bold;  color:#820606;">PNB Home Finance</span>. </div></div>
  <div style="font-family:Verdana, Geneva, sans-serif; font-size:18px; font-weight:bold; padding:5px;">Why Deal4loans.com</div>
<table width="95%" border="0" align="center" style="padding:5px; border:2px solid #def3f8; " cellpadding="0" cellspacing="0">
        <tr>
          <td bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td bgcolor="#FFFFFF" class="td_bg">Instant EMI &amp; Eligibility offer from all Banks</td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" style="height:10px;" ></td>
        </tr>
        <tr>
          <td width="6%" bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td width="94%" bgcolor="#FFFFFF" class="td_bg">Choose best deal for lowest EMI, Best Eligibility</td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" style="height:10px;"></td>
        </tr>
        <tr>
          <td bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td bgcolor="#FFFFFF" class="td_bg">Home Loan Quotes are free for customers.</td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" style="height:10px;"></td>
        </tr>
        <tr>
          <td bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td bgcolor="#FFFFFF" class="td_bg">Your information will not be shared with anyone without your consent.</td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#FFFFFF" style="height:10px;">&nbsp;</td>
          </tr>
        <tr>
          <td bgcolor="#F6FCFD"><span class="td_bg"><img src="new-images/pl/arrow.gif" /></span></td>
          <td bgcolor="#FFFFFF" class="td_bg">Over 26 lakh customers have taken quote at Deal4loans.com</td>
        </tr>
      </table></div>
      
     
      <div id="sidebar_bnr_apply">
  <div class="widget_b"><img src="new-images/hl/frm-hdng-new.gif" /></div>
  <section class="widget">
    <div class="right-box-b">
      <form  action="apply-home-loan-thank.php" method="post" name="home_loan" id="home_loan" onSubmit="return submitform(document.home_loan);" >
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="42%" height="35" class="form_text_pl"><span class="nrmltxt1" style="color:#4b4b4b; font-weight:normal;">Date of Birth </span></td>
            <td width="58%"><input type="text" value="dd" name="day" id="day" maxlength="2" style="width:30px;"  onchange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'dd');"  onfocus="onFocusBlank(this,'dd');" onKeyDown="validateDiv('dobVal');"/>
              &nbsp;
              <input type="text" name="month" id="month" maxlength="2" style="width:30px;"  onchange="intOnly(this);" value="mm"  onkeyup="intOnly(this);" onKeyPress="intOnly(this)" onBlur="onBlurDefault(this,'mm');"  onfocus="onFocusBlank(this,'mm');" onKeyDown="validateDiv('dobVal');" />
              &nbsp;
              <input type="text" maxlength="4" value="yyyy" name="year" id="year" style="width:50px;"  onchange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" onKeyDown="validateDiv('dobVal');" />            <div id="dobVal" class="alert_msg"></div></td>
          </tr>
          <tr>
            <td height="28" class="form_text_pl"><span class="nrmltxt1" style="color:#4b4b4b;">Pincode</span></td>
            <td><input name="Pincode" type="text" id="Pincode" style="width:140px;" onFocus="this.select();" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"  maxlength="6" onKeyDown="validateDiv('pincodeVal');" /><div id="pincodeVal" class="alert_msg"></div></td>
          </tr>
          <tr>
            <td height="28" class="form_text_pl"><span class="nrmltxt1" style="color:#4b4b4b;">Occupation</span></td>
            <td><select style="width:140px;" name="Employment_Status" id="Employment_Status" onChange="validateDiv('empStatusVal');">
              <option selected="selected" value="-1">Employment Status</option>
              <option  value="1">Salaried</option>
              <option value="0">Self Employed</option>
            </select><div id="empStatusVal" class="alert_msg"></div></td>
          </tr>
          <tr>
            <td height="28" class="form_text_pl"><span class="nrmltxt1" style="color:#4b4b4b;">Company Name</span></td>
            <td><input type="text" name="Company_Name" id="Company_Name" style="width:140px;"/><div id="companyVal" class="alert_msg"></div></td>
          </tr>
          <tr>
            <td height="28" class="form_text_pl"><span class="nrmltxt1" style="color:#4b4b4b;">Property Identified</span></td>
            <td><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onClick="addIdentified();" style="border:none;" />
              Yes&nbsp;&nbsp;
              <input type="radio"  name="Property_Identified" id="Property_Identified" onClick="removeIdentified();" value="0" style="border:none;" />
              No  <div id="propEditifiedVal" class="alert_msg"></div></td>
          </tr>
          <tr>
            <td colspan="2" align="left" class="form_text_pl" id="myDiv1"></td>
          </tr>
          <tr>
            <td colspan="2" align="left" class="nrmltxt" id="myDiv2"></td>
          </tr>
          <tr>
            <td height="28" class="form_text_pl"><span class="nrmltxt1" style="color:#4b4b4b;">Property Value</span></td>
            <td><input type="text" name="Property_Value" id="Property_Value" style="width:140px;" onKeyUp="intOnly(this); getDigitToWords('Property_Value','formatedPV','wordpropertyvalue');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedPV','wordloanAmount');"  onkeydown="getDigitToWords('Property_Value','formatedPV','wordpropertyvalue');" onBlur="getDigitToWords('Property_Value', 'formatedPV', 'wordpropertyvalue'); onBlurDefault(this,'Loan Amount');"/></td>
          </tr>
          <tr>
            <td height="28" align="left"><span class="nrmltxt1" style="color:#4b4b4b;">Total EMIs you currently pay per month (if any)</span></td>
            <td height="0" align="center"><input type="text" name="obligations" id="obligations" style="width:140px;"    onkeyup="intOnly(this);" onKeyPress="intOnly(this);" /></td>
          </tr>
          <tr>
            <td height="0" align="left"><span class="nrmltxt1" style="color:#4b4b4b;">When you are planning to take<br />
              loan</span></td>
            <td height="0" align="center"><select name="Loan_Time" style="width:140px;">
              <option value="-1" selected="selected">Please select</option>
              <option value="15 days">15 days</option>
              <option value="1 month">1 months</option>
              <option value="2 months">2 months</option>
              <option value="3 months">3 months</option>
              <option value="3 months above">more than 3 months</option>
            </select>
                <input type="hidden" name="ProductValue" id="ProductValue" value="<?php echo $ProductValue; ?>" />
                <input type="hidden" name="Type_Loan" value="Req_Loan_Home" />
                <input type="hidden" name="Phone" id="Phone" value="<?php echo $Phone; ?>" />
                <input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
                <input type="hidden" name="Net_Salary" id="Net_Salary" value="<?php echo $Net_Salary; ?>" />
                <input type="hidden" name="Loan_Amount" id="Loan_Amount" value="<?php echo $Loan_Amount; ?>" />
                <input type="hidden" name="City_Other" id="City_Other" value="<?php echo $City_Other; ?>" /><div id="propPlanVal" class="alert_msg"></div></td>
          </tr>
          <tr>
            <td height="35" colspan="2" align="left"><input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" style="border:none;" />
              Co- Applicant</td>
          </tr>
          <tr>
            <td colspan="2"><div style=" display:none; " id="divfaq1">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td width="185" height="30" align="left"  class="nrmltxt" style="color:#4b4b4b;">Name</td>
                  <td width="183" align="left"><input type="text" name="co_name" id="co_name" style="width:140px;"  maxlength="30" />
                  </td>
                </tr>
                <tr>
                  <td width="185" align="left" class="nrmltxt" style="color:#4b4b4b;">DOB </td>
                  <td width="183" align="left"><input type="text" value="dd" name="co_day" id="co_day" maxlength="2" style="width:30px;"  onchange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'dd');"  onfocus="onFocusBlank(this,'dd');"/>
                    &nbsp;
                    <input type="text" name="co_month" id="co_month" maxlength="2" style="width:30px;"  onchange="intOnly(this);" value="mm"  onkeyup="intOnly(this);" onKeyPress="intOnly(this)" onBlur="onBlurDefault(this,'mm');"  onfocus="onFocusBlank(this,'mm');" />
                    &nbsp;
                    <input type="text" maxlength="4" value="yyyy" name="co_year" id="co_year" style="width:50px;"  onchange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this,'yyyy');" onFocus="onFocusBlank(this,'yyyy');" /></td>
                </tr>
                <tr>
                  <td width="185" height="30" align="left" class="nrmltxt" style="color:#4b4b4b;">Net Monthly Income</td>
                  <td width="183" align="left"><input type="text" name="co_monthly_income" id="co_monthly_income" style="width:140px;" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" />
                  </td>
                </tr>
                <tr>
                  <td height="30" align="left" class="nrmltxt" style="color:#4b4b4b;">Consolidated EMI's<br />
                    (Per Month)</td>
                  <td align="left"><input type="text" name="co_obligations" id="co_obligations" style="width:140px;"   onkeyup="intOnly(this);" onKeyPress="intOnly(this);" />
                  </td>
                </tr>
              </table>
            </div></td>
          </tr>
          <tr>
            <td height="0" colspan="2"align="center" class="form_text_pl" style="font-size:10px; text-align:left;"><input type="checkbox"  name="accept" style="border:none;" checked="checked" />
              I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Privacy Policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow">Terms and Conditions</a>.</td>
          </tr>
          <tr>
            <td height="0" colspan="2" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="image" name="Submit"  src="new-images/hl/pl-quote.gif"  style="width:117px; height:29px; border:none; " /></td>
          </tr>
        </table>
      </form>
    </div>
  </section>
</div>
</div>
</div>
<!-- Google Code for Home Loan Conversion Page -->
<script type="text/javascript">
<!--
var google_conversion_id = 1066264455;
var google_conversion_language = "en_US";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "C7FiCLPHkAEQh8-3_AM";
var google_conversion_value = 0;
//-->
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1066264455/?label=C7FiCLPHkAEQh8-3_AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
</body>
</html>