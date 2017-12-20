<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/hlicici_eligibility_function.php';
	error_reporting();

function number_pad($number,$n) {
return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}
	//require 'scripts/db_init.php';
	function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}

		$City = $_POST['City'];
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$dob_arr[] = $_POST['year'];
		$dob_arr[] = number_pad($_POST['month'],2);
		$dob_arr[] = number_pad($_POST['day'],2);
		$dateofbirth = implode("-", $dob_arr);
		$company_name = $_POST['company_name'];
		$Employment_Status = $_POST['Employment_Status'];
		$occupation = $_POST['Employment_Status'];
		$monthly_income = $_POST['monthly_income'];
		$obligations = $_POST['obligations'];
		$getloan_amount = $_POST['loan_amount'];
		$co_appli = $_POST['co_appli'];
		$source="icicihltest";
		$co_name = $_POST['co_name'];
		$dob_arr_co[] = $_POST['co_year'];
		$dob_arr_co[] = $_POST['co_month'];
		$dob_arr_co[] = $_POST['co_day'];
		$DOB_co = implode("-", $dob_arr_co);
		$co_monthly_income = $_POST['co_monthly_income'];
		$co_obligations = $_POST['co_obligations'];
		$property_value = $_POST['property_value'];
	
		$builder_name = $_POST['builder_name'];
		$propertyConstruction_Type = $_POST['propertyConstruction_Type'];
		 $Dated = ExactServerdate();
	
		
		
		if($getloan_amount<800000)
		{
			$loan_amount=800000;
		}
		else
		{
			$loan_amount=$getloan_amount;
		}

		//echo $loan_amount."<br>";
		
		//if($Employment_Status==2)
		//{
			//$monthly_income = ceil($monthly_income /12) ;
		//}
		$getnetAmount = ($monthly_income + $co_monthly_income);
		$total_obligation = $obligations + $co_obligations;
		$netAmount=($getnetAmount - $total_obligation);
	//echo	$obligations;
	//echo "<br>";
	//echo	"dsfd - ".$netAmount;
	//echo "<br>";
	
		$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$tenorPossible = 60 - $DOB;
		
		list($emi1st, $perlacemifor1, $inter1st, $yr1st, $emi2ndn3rd, $perlacemifor2, $inter2ndn3rd, $yr2nd, $actualemi, $exactinter, $iciciloan_amount, $exactperlacemi, $iciciprint_term) = ICICI_Homeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value,$Employment_Status);
		
		//echo "<br>";
	//	$aa = ICICI_Homeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value,$Employment_Status);
		//print_r($aa);
		$IP = getenv("REMOTE_ADDR");
		//echo "<br>";
		
		
	$Reference_Code = generateNumber(4);
	$app_code = date('dmy')."".$Reference_Code;
	
	$SMSMessage = "Dear Customer, the activation code - $Reference_Code for ICICI Home Loan Process. Use in activation code box to verify your mobile number.";
	if(strlen(trim($Phone)) > 0)
	{
		SendSMS($SMSMessage, $Phone);
	}
$dataInsert = array("Name"=>$Name, "Phone"=>$Phone, "Email"=>$Email, "DOB"=>$dateofbirth, "Company_Name"=>$company_name, "Loan_Amt"=>$loan_amount, "Employment_Status"=>$Employment_Status, "Net_Salary"=>$monthly_income, "Obligations"=>$obligations, "Co_Name"=>$co_name, "Co_DOB"=>$DOB_co, "Co_Salary"=>$co_monthly_income, "Co_Obligation"=>$co_obligations, "emi"=>$emi, "tenure"=>$print_term, "roi"=>$inter, "documents"=>'', "Dated"=>$Dated, "IP"=>$IP, "AppID"=>$app_code, "Reference_Code"=>$Reference_Code, "builder_name"=>$builder_name, "propertyConstruction"=>$propertyConstruction_Type);
$table = 'home_loan_eligibility';
$insert = Maininsertfunc ($table, $dataInsert);

$Net_Salary= $monthly_income *12;
	
//CODE FOR SITE
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
			$cntr=0;

			
			$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$cntr]['UserID'];
		
		$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$loan_amount, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "Employment_Status"=>$Employment_Status, "DOB"=>$dateofbirth, "Reference_Code"=>$Reference_Code);

		
			}
			else
			{
		$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
		$table = 'wUsers';
		$insert = Maininsertfunc ($table, $dataInsert);
		
		$UserID = $insert;
		$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$loan_amount, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated, "Employment_Status"=>$Employment_Status, "DOB"=>$dateofbirth, "Reference_Code"=>$Reference_Code);

			}
			
			//echo "<br>".$InsertProductSql."<br>";
			
			$table = 'Req_Loan_Home';
$insert = Maininsertfunc ($table, $dataInsert);
			
			$ProductValue = $insert;
//CODE END FOR SITE
		list($firstn,$lastn) = split(" ",$Name);
	//}
?>	
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ICICI Bank Home Loan</title>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<style type="text/css">
	
	/* START CSS NEEDED ONLY IN DEMO */
	
	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}

	form{
		display:inline;
	}
	</style>
<style>		
.black_overlay{			display: none;			position: absolute;			top: 0%;			left: 0%;			width: 100%;			height: 100%;			background-color: black;			z-index:1001;			-moz-opacity: 0.8;			opacity:.50;			filter: alpha(opacity=50);		}
		.white_content {			display: none;			position: absolute;			top: 25%;			left: 25%;			width: 260;			height: 250;			padding: 6px;			border: 2px solid black;			background-color: white;			z-index:1002;			overflow: auto;		}
		.btnclr {    background-color: #1273AB;    border: medium none;    color: #FFFFFF;    font-family: Verdana,Arial,Helvetica,sans-serif;    font-size: 12px;    font-weight: bold;    height: 30px;    width: 250px;}		 
	</style>
    
<style type="text/css">
body{	margin:0px;	padding:0px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#2e2e2e;}input{	margin:0px;	padding:0px;	border:1px solid #878787;}select{	margin:0px;	padding:0px;	border:1px solid #878787;}form{margin:0px;padding:0px;}.hdr{	background-image:url(images/hdr.gif);	background-repeat:no-repeat;	height:75px;}.hdng-bg{	background-image:url(images/bgn.jpg);	background-repeat:no-repeat;	height:36px;	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891; 	text-indent:15px;}.yelobrder{	border-left:1px solid #fde37a;	border-right:1px solid #fde37a;}#txt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;  	padding-left:25px;	line-height:21px;	padding-top:8px;}.yelobrder ul{	margin:0px 0px 0px 10px;	padding:0px 0px 0px 10px;}.yelobrder ul li{	background-image:url(images/arow.jpg) ;	background-repeat:no-repeat;	list-style-type:none; 	padding-left:18px; 	padding-right:0; 	padding-top:0; 	padding-bottom:4px;	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	line-height:18px; }.imgpostn{	padding-left:31px;	padding-top:10px;	padding-bottom:4px;} .btmboxbg{	background-image:url(images/btm-box.jpg);	width:273px;	height:131px;	background-repeat:no-repeat;	background-position:center;}.redtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#8b321b;}.blktxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	text-align:left;	line-height:16px;	padding-top:6px;}.frmhdng{	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891;}.frmbg{ 	border-left:1px solid #c2c2c2;	border-bottom:1px solid #c2c2c2;}.frmtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#332d33;}.frmrgtbrdr{	border-bottom:22px solid #802891;	background-color:#fecb09;}/* START CSS NEEDED ONLY IN DEMO */		#mainContainer{		width:660px;		margin:0 auto;		text-align:left;		height:100%;				border-left:3px double #000;		border-right:3px double #000;	}	#formContent{		padding:5px;	}	/* END CSS ONLY NEEDED IN DEMO */			/* Big box with list of options */	#ajax_listOfOptions{		position:absolute;	/* Never change this one */		width:195px;	/* Width of box */		height:100px;	/* Height of box */		overflow:auto;	/* Scrolling features */		border:1px solid #666666;	/* Dark green border */		background-color:#FFFFFF;	/* White background color */   		color: #333333;		text-align:left;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-transform: lowercase;		font-size:11px;			z-index:100;	}	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */		margin:1px;				padding:1px;		cursor:pointer;		font-family:Verdana, Arial, Helvetica, sans-serif;		font-size:11px;		}	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */			}	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */		background-color:#3d87d4;		line-height:20px;		color:#FFFFFF;	}	#ajax_listOfOptions_iframe{		background-color:#F00;		position:absolute;		z-index:5;	}				#dhtmlgoodies_tooltip{		background-color:#ffe688;		border:1px solid #000;		position:absolute;		color:#000000;		display:none;		margin-left:-13px;		z-index:20000;		padding:0px;		font-size:0.9em;		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif;			}	#dhtmlgoodies_tooltipShadow{		position:absolute;		background-color:#555;		display:none;		margin-left:-13px;		z-index:10000;		opacity:0.7;		filter:alpha(opacity=70);		-khtml-opacity: 0.7;		-moz-opacity: 0.7;	} 
    .btnclr {
    background-color: #1273AB;
    border: medium none;
    color: #FFFFFF;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 12px;
    font-weight: bold;
    height: 30px;
    width: 90px;
}

.frmtxt1 {font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	color:#332d33;}

.loginboxdiv{
margin:0px;
height:21px;
width:172px;
background:url(login_bg1.jpg) no-repeat bottom;
}
/* attributes of the input box */
.loginbox
{
background:none;
border:none;
width:160px;
height:15px;
margin:0;
padding: 2px 7px 0px 7px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;
}		 
</style>

<Script Language="JavaScript">

function validmail(email1) 
{
	invalidChars = " /:,;";

	if (email1 == "")

	{// cannot be empty

		alert("Invalid E-mail ID.");

		return false;	

	}

	for (i=0; i<invalidChars.length; i++) 

	{	// does it contain any invalid characters?

		badChar = invalidChars.charAt(i);

		if (email1.indexOf(badChar,0) > -1) 

		{

			return false;

		}

	}

	atPos = email1.indexOf("@",1)// there must be one "@" symbol

	if (atPos == -1) 

	{

		alert("Invalid E-mail ID.");

		return false;

	}

	if (email1.indexOf("@",atPos+1) != -1) 

	{	// and only one "@" symbol

		alert("Invalid E-mail ID.");

		return false;

	}

	periodPos = email1.indexOf(".",atPos)

	if (periodPos == -1) 

	{// and at least one "." after the "@"

		alert("Invalid E-mail ID.");

		return false;

	}

	//alert(periodPos);

	//alert(email.length);

	if (periodPos+3 > email1.length)	

	{		// must be at least 2 characters after the "."

		alert("Invalid E-mail ID.");

		return false;

	}

	return true;

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


if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
{
	alert("Kindly fill in your Name!");
	document.loan_form.Name.select();
	return false;
}
else if(containsdigit(Form.Name.value)==true)
{
	alert("Name contains numbers!");
	Form.Name.select();
	return false;
}

 for (var i = 0; i < Form.Name.value.length; i++) {
  	if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
  	alert ("Name has special characters.\n Please remove them and try again.");
	Form.Name.select();
  	return false;
  	}
  }
  
  
	if(Form.verify_code.value=="" && Form.verify_code.value!="verified")
	{
		alert("Please Enter correct Verification code");
		Form.verify_code.focus();
		return false;
	}  
  
  if(Form.residence_address.value=="")
	{
		alert("Kindly fill in your Residence Address!");
		Form.residence_address.focus();
		return false;
	}
	
if(Form.Pincode.value=="")
	{
		alert("Kindly fill in your Pincode!");
		Form.Pincode.focus();
		return false;
	}
  
	if(Form.office_std.value=="" || Form.office_std.value=="Std")
	{
		alert("Kindly fill in your Office Std Code!");
		Form.office_std.focus();
		return false;
	}
	if(Form.office_phone.value=="" || Form.office_phone.value=="Number")
	{
		alert("Kindly fill in your Office Number!");
		Form.office_phone.focus();
		return false;
	}

	if(Form.office_ext.value=="" || Form.office_ext.value=="Ext")
	{
		alert("Kindly fill in your Office Ext. If there is no Ext , kindly put 0!");
		Form.office_ext.focus();
		return false;
	}

	if(Form.Employment_Status.value==1)
	{
  
		var a=Form.Pancard.value;
		
		var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
		if(regex1.test(a)== false)
		{
		  alert('Please enter valid pan number');
		   Form.Pancard.focus();
		  return false;
		}
		
		if (Form.Pancard.value.charAt(3)!="P" && Form.Pancard.value.charAt(3)!="p")
		{
				alert("Please enter valid pan number");
				 Form.Pancard.focus();
				return false;
		}
	
	}
	else if(Form.Employment_Status.value==2)
	{
  
		var a=Form.Pancard.value;
		
		var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
		if(regex1.test(a)== false)
		{
		  alert('Please enter valid pan number');
		   Form.Pancard.focus();
		  return false;
		}
		
		if (Form.Pancard.value.charAt(3)!="C" && Form.Pancard.value.charAt(3)!="c")
		{
				alert("Please enter valid pan number");
				 Form.Pancard.focus();
				return false;
		}
	
	}

	
	
	
	
	
	
	if ( ( Form.Defaulted[0].checked == false ) && ( Form.Defaulted[1].checked == false ) )
	{
	  alert ( "Please choose defaulted on any loan or credit card" ); 
	  return false; 
	}
	
	if ( ( Form.declined[0].checked == false ) && ( Form.declined[1].checked == false ) )
	{
	  alert ( "Please choose loan application declined in last month?" ); 
	  return false; 
	}
	
	
}

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

function HandleOnClose(filename) {

   if ((event.clientY < 0)) {

	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')

	   myWindow.document.bgColor=""

	   myWindow.document.close() 

   }
}
</script>

  <script>

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

	window.onload = ajaxFunction;

</script>

<script language="javascript">

function verification()

{
//alert("gfdfg");
		var get_RequestID = document.loan_form.RequestID.value;
			//var get_full_name = document.getElementById('full_name').value;
		var get_insertedID = document.loan_form.insertedID.value;			
			var get_Phone = document.loan_form.Phone.value;
			//var get_mobile_no = document.getElementById('mobile_no').value;
			
			var get_id = document.loan_form.verify_code.value;
			//var get_id = document.getElementById('Activate').value;

				var queryString = "?get_Mobile=" + get_Phone +"&get_RequestID=" + get_RequestID +"&get_id=" + get_id +"&get_insertedID=" + get_insertedID ;
	//			alert(queryString); 
				ajaxRequest.open("GET", "verifyMobileHL.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
					   var ajaxDisplay = document.getElementById('displayVerify');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}

				ajaxRequest.send(null); 
		

	}

</script>

</head>
<body>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="886">
 <tr>
    <td background="icici_car/main_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="872">
      <tr>
        <td>
			<table>
				<tr>
					<td><img src="icici_car/top_logo1_small.jpg" height="104" width="285"></td>
					<td valign="bottom">
						<table width="575" bgcolor="#EFEFE0" height="94" cellpadding="0" cellspacing="0" style="border:#000000 solid 1px;">
						<tr>
						  <td colspan="4" bgcolor="#CC541F" align="center" class="verdred13" style="color:#FFFFFF; border-bottom:#D2CECC solid 1px; ">ICICI Bank Home Loan Quote</td>
						</tr>
						<tr><td width="173" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Max Loan Amount</td>
						<td width="184" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Interest Rate</td>
						<td width="129" align="center" class="frmtxt" style="color:#CC541F; border-right:#D2CECC solid 1px; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Per Month EMI</td>
						<td width="87" align="center" class="frmtxt" style="color:#CC541F; border-bottom:#D2CECC solid 1px; font-size:13px;" bgcolor="#EFEFE0">Tenure</td>
						</tr>
<?php                        
                   //     list($emi1st, $perlacemifor1, $inter1st, $yr1st, $emi2ndn3rd, $perlacemifor2, $inter2ndn3rd, $yr2nd, $actualemi, $exactinter, $iciciloan_amount, $exactperlacemi, $iciciprint_term) = ICICI_Homeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value,$Employment_Status);
//	$aa = ICICI_Homeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value,$Employment_Status);
	//print_r($aa);
						?>
						<tr>
						  <td style="border-right:#D2CECC solid 1px; font-weight:normal;" align="center" class="frmtxt">Rs. <? echo abs($iciciloan_amount); ?></td>
						  <td style=" border-right:#D2CECC solid 1px; font-weight:normal;" align="center" class="frmtxt"><? echo $inter1st; ?>%&nbsp;<br><span style="font-size:9px;">(Monthly Reducing)</span></td><td style="color:#000000; border-right:#D2CECC solid 1px; font-weight:normal;" align="center"class="frmtxt">Rs. <? echo $exactperlacemi; ?></td><td style="font-weight:normal;" align="center" class="frmtxt"><? echo ceil($iciciprint_term/12); ?>&nbsp;<span style="font-size:9px;">(years)</span></td></tr>
					  </table></td></tr></table>
		</td>
      </tr>
    <tr><td height="15">&nbsp;</td></tr>     
      <tr>
        <td><img src="icici_car/body_top.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td background="icici_car/body_bg.gif"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" >
				
                    <tr>
                      <td height="40" align="center" valign="top" class="heading">
                      
<form name="loan_form" method="post" action="icici-hlthanks.php" onSubmit="return submitform(document.loan_form);" enctype="multipart/form-data">
<input type="hidden" name="RequestID" value="<?php echo $ProductValue ; ?>" />
<input type="hidden" name="insertedID" value="<?php echo $insertedID ; ?>" />
<input type="hidden" name="Employment_Status" value="<?php echo $Employment_Status ; ?>" />
<input type="hidden" name="iciciactualemi" value="<?php echo $exactperlacemi ; ?>" />
<input type="hidden" name="iciciprint_term" value="<?php echo ($iciciprint_term/12) ; ?>" />
<input type="hidden" name="iciciinter" value="<?php echo $inter1st ; ?>" />
<input type="hidden" name="iciciviewLoanAmt" value="<?php echo abs($iciciloan_amount) ; ?>" />
<table width="98%"  border="0" align="center" cellpadding="4" cellspacing="4">

  <tr align="center">

    <td colspan="4"></td>
  </tr>

 
  <tr>


	<td width="177" align="left" class="frmtxt">Full Name <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

	<td width="210" align="left" class="frmtxt"><div class="loginboxdiv">
                      <input class="loginbox" type="text" style="width:180px;  height:21px;"  name="Name" id="Name" value="<?php echo $firstn; ?>" ></div></td>
	<td width="145" align="left" class="frmtxt">Last Name <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

	<td width="254" align="left"  class="frmtxt" style="font-weight:normal;"><span class="frmtxt1">
	 <div class="loginboxdiv">
                      <input class="loginbox"  type="text" style="width:150px;  height:21px;"  name="l_Name" id="l_Name" value="<?php echo $lastn; ?>" ></div>
	</span></td></tr>
   <tr>


	<td width="177" align="left" class="frmtxt">Email <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

	<td width="210" align="left" class="frmtxt"><div class="loginboxdiv">
                      <input class="loginbox" style="width:180px;  height:21px;"   name="Email" id="Email" value="<?php echo $Email; ?>" readonly  /></div></td>
	<td width="145" align="left" class="frmtxt"><span class="frmtxt">Mobile No. </span></td>

	<td width="254" align="left"  class="frmtxt" style="font-weight:normal;"><input   name="Phone" id="Phone" value="<?php echo $Phone; ?>"  type="hidden" >+91 <?php echo $Phone; ?> <span id="displayVerify"><input type="text" name="verify_code" maxlength="4" style="width:35px;" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /> <a href="#" onClick="return verification();" style="font-size:10px; font-family:Verdana, Arial, Helvetica, sans-serif; text-decoration:none;">Verify</a>
<div style="font-weight:normal; color:#FF0000; font-size:9; text-align:left">Enter Verification code to validate  mobile.</div>
</span></td>
  </tr>
  
   <tr>

	<td align="left" class="frmtxt">City <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

	<td align="left" class="frmtxt"><div class="loginboxdiv">
                      <input class="loginbox"  style="width:180px;  height:21px;"   name="City" id="City" value="<?php echo $City; ?>"  readonly  /></div></td>
	<td align="center" class="frmtxt">&nbsp;</td>
<td align="left" class="frmtxt">&nbsp;</td>
   </tr>
    <tr>
	<td align="left" valign="top" class="frmtxt">Resi Address Line 1 <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td align="left" class="frmtxt"><div class="loginboxdiv">
                      <input class="loginbox"  type="text" name="residence_address" id="residence_address" style="width:150px;  height:21px;" ></div></td>
	<td align="left" class="frmtxt">Resi Address Line 2</td>
	<td align="left"><span class="frmtxt" style="font-weight:normal; ">
     <div class="loginboxdiv">
                      <input class="loginbox"  type="text" name="office_address" id="office_address" style="width:150px;  height:21px;" ></div>
    </span></td>
  </tr>
   <tr>
	<td align="left" valign="top" class="frmtxt">Pincode <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td align="left" class="frmtxt"><div class="loginboxdiv">
                      <input class="loginbox"  type="text"  style="width:150px;  height:21px;" maxlength="6"  name="Pincode" id="Pincode" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td>
	<td align="left" class="frmtxt">Resi Telephone</td>
	<td align="left"><span class="frmtxt" style="font-weight:normal; ">
      <input style="width:40px;  height:21px;" name="home_std" id="home_std" value="Std" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input style="width:130px; height:21px;" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" name="home_phone" id="home_phone"/>
    </span></td>
  </tr>
   <tr>
	<td align="center" valign="top" colspan="4" >----------------------------------------------------------------------------------------------------------------</td>
  </tr>
   <tr>
	<td align="left" class="frmtxt">
	<?php    if($Employment_Status==1)    {        echo "Employer";    }    else    {        echo "Business Name";    }   ?>    
     <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td align="left" class="frmtxt"><div class="loginboxdiv">
                      <input class="loginbox" style="width:150px; height:21px;"  name="company_name" id="company_name" value="<?php echo $company_name; ?>" readonly /></div></td>
	<td align="left" class="frmtxt"><?php    if($Employment_Status==1)    {  echo "Designation"; } ?>&nbsp;</td>
	<td align="left" class="frmtxt"><?php    if($Employment_Status==1)    {  ?><div class="loginboxdiv">                      <input class="loginbox"  type="text" style="width:180px; height:21px;"  name="Designation" id="Designation" /></div><?php } ?>&nbsp;</td>
   </tr>
    <tr>
	<td align="left" class="frmtxt">Office Telephone <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td align="left" class="frmtxt"><input style="width:40px; height:21px;" value="Std" name="office_std" id="office_std" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/> <input style="width:80px; height:21px;" onKeyUp="intOnly(this);" onKeyPress="intOnly(this); " value="Number" name="office_phone" id="office_phone"/> <input style="width:40px; height:21px;" value="Extn" name="office_ext" id="office_ext" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>
	<td align="left" class="frmtxt">Pancard <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td align="left" class="frmtxt"><div class="loginboxdiv">
                      <input class="loginbox" style="width:180px; height:21px;"  name="Pancard" id="Pancard" maxlength="10" /></div></td>
   </tr>
     <tr>
	<td align="center" valign="top" colspan="4" >----------------------------------------------------------------------------------------------------------------</td>
  </tr>
      <tr>
	<td colspan="2" align="left" class="frmtxt">Ever defaulted on any loan or credit card? <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td align="center" class="frmtxt"><input type="radio" name="Defaulted" id="Defaulted" value="true" >
	  Yes
        <input type="radio" name="Defaulted" id="Defaulted" value="false" />
        No</td>
	<td align="left" class="frmtxt">&nbsp;</td>
   </tr>
         <tr>
	<td colspan="2" align="left" class="frmtxt">Had loan application declined in last month? <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td align="center" class="frmtxt"><input type="radio" name="declined" id="declined" value="true" >
	  Yes
        <input type="radio" name="declined" id="declined" value="false" />
        No</td>
	<td align="left" class="frmtxt">&nbsp;</td>
   </tr>

  
<tr>
	<td align="left" valign="top" class="frmtxt" colspan="4">Select one document in each section below that you will provide as proof</td>
  </tr>
  
  <tr>
	<td align="left" valign="top" class="frmtxt">Proof of Income</td>
	<td ><select name="Income_Proof" id="Income_Proof"style="width:210px;" >
    <option value=""
    >Select</option>
    <option value="Latest ITR">Latest ITR</option>
    <option value="Form 16">Form 16</option>
 <?php    if($Employment_Status==1)    {?>
    <option value="Salary ceritificate for last 3 months">Salary ceritificate for last 3 months</option>

    <option value="Pay slip - last 3 months">Pay slip - last 3 months</option>
<?php } ?>

</select></td>
<td colspan="2">&nbsp;</td>
  </tr>
  <tr>
	<td align="left" valign="top" class="frmtxt">Proof of Address</td>
    <td>
    <select name="Address_Proof" id="Address_Proof" style="width:210px;">
    <option value="">Select</option>
    <option value="Ration Card">Ration Card</option>
    <option value="Telephone, electricity, water or gas bill less than 2 months old (incl downloaded)">Telephone, electricity, water or gas bill less than 2 months old (incl downloaded)</option>
    <option value="Latest Life Insurance policy premium receipts (paid)">Latest Life Insurance policy premium receipts (paid)</option>

    <option value="Post-paid mobile phone bill in your name">Post-paid mobile phone bill in your name</option>
    <option value="Letter from Employer certifying current mailing address">Letter from Employer certifying current mailing address</option>
    <option value="Passport">Passport</option>
    <option value="Election ID card">Election ID card</option>
    <option value="Registered Rental / Lease Agreement">Registered Rental / Lease Agreement</option>
    <option value="Property Registration documents/Ownership proof copy">Property Registration documents/Ownership proof copy</option>

    <option value="Passbook">Passbook</option>
    <option value="Bank statement (last 3 months)">Bank statement (last 3 months)</option>
    <option value="Driving License">Driving License</option>
    <option value="Loan repayment track record">Loan repayment track record</option>
    <option value=" Registration certificate (RC) of 4-wheeler in applicant's name"> Registration certificate (RC) of 4-wheeler in applicant's name</option>
</select></td>
<td colspan="2">&nbsp;</td>
  </tr>
   <tr>
	<td align="left" valign="top" class="frmtxt">Proof of Identity</td>
	<td ><select name="Identity_Proof" id="Identity_Proof"  style="width:210px;">
    <option value=""
    >Select</option>
    <option value="Passport">Passport</option>
    <option value="Election ID card">Election ID card</option>
    <option value="Driving License">Driving License</option>
    <option value="Photo Credit/Debit/ATM Card">Photo Credit/Debit/ATM Card</option>
    <option value="Government organisation ID card with signature and photo">Government organisation ID card with signature and photo</option>

    <option value="PAN Card">PAN Card</option>
    <option value="Company ID card">Company ID card</option>
    <option value="Insurance / Mediclaim Photo Card">Insurance / Mediclaim Photo Card</option>
    <option value="Ration Card">Ration Card</option>
    <option value="Home property papers (registered deed">Home property papers (registered deed</option>
    <option value="Registration certificate (RC) of vehicle in applicant's name">Registration certificate (RC) of vehicle in applicant's name</option>


</select></td>
<td colspan="2">&nbsp;</td>
  </tr>
   <tr>
	<td align="left" valign="top" class="frmtxt">Bank Statement</td>
	<td ><select name="Bank_Statement" id="Bank_Statement"  style="width:210px;" >
    <option value="">Select</option>
   <?php    if($Employment_Status==1)    {?>
    <option value="Salary account bank statement - last 6 months">Salary account bank statement - last 6 months</option>
	<?php } else {?>     <option value="Bank statement - last 6 months">Bank statement - last 6 months</option><?php } ?>
</select></td>
<td colspan="2">&nbsp;</td>
  </tr> 

  <tr valign="bottom">

    <td colspan="4" align="center">
    

    <input name="submit" type="submit" class="btnclr" value="Submit" /></td>
    </tr>

  <tr valign="bottom">

    <td colspan="4" align="center">&nbsp;</td>
  </tr>
</table>

			</form>

                      
                      </td>
                  </tr>
                     <?php
					if($total_obligation>$netAmount)
					{
					?>
					 <tr>
                          <td colspan="2" align="center" class="bldtxt" valign="top" height="200">&nbsp;</td>
                  </tr>
					<?php
					}
					

					else
					{?>
					
					<tr>
					
                      <td class="text" colspan="2" align="center">&nbsp;</td>
                  </tr>
					<? }
						?>
                </table>
        
         </td>
      </tr>
      <tr>
        <td><img src="icici_car/body_btm.gif" height="10" width="872"></td>
      </tr> 
      <tr>
        <td height="35">&nbsp;</td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>


<!--</form>-->

</body></html>