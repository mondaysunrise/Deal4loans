<?php
	require 'scripts/db_init.php';

	require 'scripts/functions.php';
//print_r($_POST);
	function DetermineAgeGETDOB ($YYYYMMDD_In){  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;   if ($mdiff < 0)  {     $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }
	
$cityList = 
'Agra,Ahmedabad,Surat,Vadodara,Gwalior,Vidisha,Hoshangabad,Itarsi,Ambala,Shimla,Chandigarh,Mandi,Patiala,Baddi,Mohali,Trivandrum,Kochi,Thrissur,Coimbatore,Erode,Ooty,Salem,Namakkal,Udumalpet,Rishikesh,Haridwar,Jamshedpur,Siliguri,Cuttack,Bhubaneshwar,Indore,Bhopal,Ujjain,Dewas,Ratlam,Mandsour,Neemuch,Jabalpur,Katni,Satna,Rewa,Singrauli,Jaipur,Ajmer,Alwar,Jodhpur,Bikaner,Pali,Ganganagar,Sonepat,Bahadhurgarh,Kurukshetra,Hisar,Kanpur,Jhansi,Lucknow,Meerut,Agra,Madurai,Tirunelveli,Nagercoil,Tuticorin,Rajapalayam,Sivakasi,Palani,Ramanathapuram,Nagpur,Nasik,Goa,Panaji,Margao,Vasco,Mapusa,Ponda,Bathinda,Ropar,Ludhiana,Jalandhar,Jammu,Pathankot,Amritsar,Hoshiarpur,Phagwara,Raipur,Rajnandgaon,Bilaspur,Durg,Raigarh,Korba,Rajkot,Ongole,Nellore,Tirupathi,Khammam,Kurnool,Ananthpur,Chittor,Kothagudem,Trichy,Thanjavur,Dindigul,Karur,Kumbakonam,Pudukottai,Tanjore,Karaikudi,Pattukottai,Mayiladuthurai,Udaipur,Bhilwara,Beawar,Banswara,Vellore,Pondicherry,Karaikkal,Kanchipuram,Krishnagiri,Vaniyambadi,Panruti,Tiruvannamalai,Guntur,Eluru,Vijayawada,Bhimavaram,Tenali,Machilipatnam,Tanuku,Palacollu,Rajahmundry,Srikakulam,Vizianagaram,Kakinada,Vizag,Anakapalli,Pitapuram,Tuni,Warangal,Nizamabad,Karimnagar,Ramagundam,Mahaboob Nagar,Armoor,Kodad,Aurangabad,Kolhapur,Ahmednagar,Solapur,Nanded,Latur,Parbhani,Satara,Chandrapur,Ratnagiri,Sangli,Jalna,Amravati,Beed,Nandurbar,Wardha,Akot,Greater Noida,Faridabad,Sahibabad,Dehradun,Rudhrapur,Saharanpur,Kishangarh,Haldwani,Firozabad,Mysore,Hubli,Hosur,Udipi,Mangalore,Belgaum,Hospet,Rishikesh';
$city_List = explode(",", $cityList);
sort($city_List);

$metrosCityList = "Bangalore,Chennai,Delhi,Gaziabad,Gurgaon,Hyderabad,Kolkata,Mumbai,Navi Mumbai,Noida,Pune,Thane";
$metrosCity_List = explode(",", $metrosCityList);
sort($metrosCity_List);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ICICI Personal Loan</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-icicicompanies.js"></script>
<style>
/* Big box with list of options */

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
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
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
	
	
.formfield
{
font-family:Arial, Helvetica, sans-serif;
font-size:13px;
color:#FFFFFF;
margin-top:4px;
}
.w175{width: 175px;}
.w230{width: 230px;}
.btnclr {    background-color: #1273AB;    border: medium none;    color: #FFFFFF;    font-family: Verdana,Arial,Helvetica,sans-serif;    font-size: 12px;    font-weight: bold;    height: 30px;    width: 250px;}	
</style>


<style type="text/css">input{	margin:0px;	padding:0px;	border:1px solid #878787;}select{	margin:0px;	padding:0px;	border:1px solid #878787;}#txt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;  	padding-left:25px;	line-height:21px;	padding-top:8px;} .btmboxbg{	background-image:url(images/btm-box.jpg);	width:273px;	height:131px;	background-repeat:no-repeat;	background-position:center;}.redtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#8b321b;}.blktxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	text-align:left;	line-height:16px;	padding-top:6px;}.frmhdng{	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891;}.frmbg{ 	border-left:1px solid #c2c2c2;	border-bottom:1px solid #c2c2c2;}.frmtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	font-weight:bold;	color:#332d33;}.frmrgtbrdr{	border-bottom:22px solid #802891;	background-color:#fecb09;}/* START CSS NEEDED ONLY IN DEMO */	 </style>
<style>		.black_overlay{			display: none;			position: absolute;			top: 0%;			left: 0%;			width: 100%;			height: 100%;			background-color: black;			z-index:1001;			-moz-opacity: 0.8;			opacity:.50;			filter: alpha(opacity=50);		}
		.white_content {			display: none;			position: absolute;			top: 25%;			left: 25%;			width: 260;			height: 250;			padding: 6px;			border: 2px solid black;			background-color: white;			z-index:1002;			overflow: auto;		}
</style>

<script language="javascript">
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
function Trim(strValue) {

var j=strValue.length-1;i=0;

while(strValue.charAt(i++)==' ');

while(strValue.charAt(j--)==' ');

return strValue.substr(--i,++j-i+1);

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
		Form.Name.select();
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
    
	if(Form.Phone.value=="")
	{
		alert("Please Enter Mobile Number");
		Form.Phone.focus();
		return false;
	}

	if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
	{
		  alert("Enter numeric value");
		  Form.Phone.focus();
		  return false;  
	}

	if (Form.Phone.value.length < 10 )
	{
		alert("Please Enter 10 Digits"); 
		Form.Phone.focus();
		return false;
	}
	if (Form.Phone.value.charAt(0)!="9" && Form.Phone.value.charAt(0)!="8" && Form.Phone.value.charAt(0)!="7")
	{
		alert("The number should start only with 9 or 8");
		Form.Phone.focus();
		return false;
	}
	if(Form.Email.value=="")
	{
		alert("Please enter  Email Address");
		Form.Email.focus();
		return false;
	}
	var str=Form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{
		alert("Please enter the valid Email Address");
		Form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		alert("Please enter the valid Email Address");
		Form.Email.focus();
		return false;
	}
	/*
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
*/
	return true;
}

</script>
</head>
<body bgcolor="#999999"  style="font-family:Arial, Helvetica, sans-serif;">
<table cellpadding="0" cellspacing="0" border="0" align="center" width="960" bgcolor="#FFFFFF">
<tr><td align="center">
<table cellpadding="2" cellspacing="0" border="0">
<tr><td width="581" align="left"><img src="new-images/icici-pl-logi.jpg" /></td>
<td width="420" align="right" valign="bottom"><img src="new-images/poweredby.png" /></td></tr>
<tr><td colspan="2"><img src="new-images/hd1.jpg" width="960" /></td></tr>
<tr><td colspan="2" align="center"  >
  <table width="552" height="112" cellpadding="0" cellspacing="0" bgcolor="#f0ede4" style="border:#dcdacd 2px solid;">
  <tr><td bgcolor="#f0ede4"  width="548" align="center" ><div id="product_head">
  <h2>Personal Loan Quote</h2>
</div>
  </td></tr>
  <tr><td bgcolor="#f0ede4"  width="548" align="center">
  <?php
$checkOutput  = '';
$checkOutput  .= '<br><br> ';

$City = $_POST['City'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$DOB = $year."-".$month."-".$day;
$DOBStr = $year."".$month."".$day;
$age = DetermineAgeGETDOB($DOBStr);
$Loan_Amount = $_POST['Loan_Amount'];
$Employment_Status = $_POST['Employment_Status'];

if($Employment_Status==1)
{
	$company_name = $_POST['company_name'];
	$Company_Type = $_POST['Company_Type'];
	$Years_In_Company = $_POST['Years_In_Company'];
	$Total_Experience = $_POST['Total_Exp_Year'];
	$Net_Salary1 = $_POST['Net_Salary1'];
}
else
{
	$business_running = $_POST['business_running'];
	$Net_Salary1 = $_POST['Net_Salary1'];
	$Total_Experience = $_POST['Total_Exp_Year'];
}

$Residential_Status = $_POST['Residential_Status'];

$CC_Holder = $_POST['CC_Holder'];
$card_obligation = $_POST['card_obligation'];
$existing_relationship = $_POST['existing_relationship'];
$relationship = $_POST['relationship'];
$LoanAny = $_POST['LoanAny'];
$Loan_Any = $_POST['Loan_Any'];
$EMI_Paid = $_POST['EMI_Paid'];
$other_emi = $_POST['other_emi'];
$Residential_Stability = $_POST['Residential_Stability'];
$LoansRunning = implode(",", $Loan_Any);

$checkCompanyListSql = "select * from pl_company_icici where company_name='".$company_name."'";
list($checkCompanyListNumRows,$checkCompanyListQuery)=MainselectfuncNew($checkCompanyListSql,$array = array());

$category = $checkCompanyListQuery[0]['icici'];
$Specialinterest_rate = $checkCompanyListQuery[0]['interest_rate'];
$Specialprocessing_fee = $checkCompanyListQuery[0]['processing_fee'];

if($category=="Elite" || $category=="Super Prime" || $Company_Type==6)
{	$checkAge = 23;	}
else if($category=="Preferred" || $Company_Type==4)  {	$checkAge = 25;	}
else	{	$checkAge = 25;		}

if($Company_Type==6 )
{
	$minLoanAmount = 20000;
}
else
{
	$minLoanAmount = 50000;
}
$checkOutput  .= '<br>Monthly Sal - '.$Net_Salary1."<br>";

if($category=="Elite")	
{ 
	//$maxLoanAmount = 1500000;	
	$loanCalc = $Net_Salary1 * 18;

	if($loanCalc>1500000)
	{
		$maxLoanAmount = 1500000;				
	}
	else
	{
		$maxLoanAmount = $loanCalc;						
	}
	$checkOutput  .= 'maxLoanAmount Elite - '.$maxLoanAmount;
}
else if($category=="Super Prime" && $existing_relationship==1 && ($relationship==1 || $relationship==2) )	
{
	//$maxLoanAmount = 1500000;	
	$loanCalc = $Net_Salary1 * 18;
	if($loanCalc>1500000)
	{
		$maxLoanAmount = 1500000;				
	}
	else
	{
		$maxLoanAmount = $loanCalc;						
	}
		$checkOutput  .= 'maxLoanAmount Super Prime - '.$maxLoanAmount;
}
else if($category=="Super Prime" && $existing_relationship==0 && ($relationship==1 || $relationship==2) ) 
{
	//$maxLoanAmount = 1000000;	
	$loanCalc = $Net_Salary1 * 18;
	if($loanCalc>1000000)
	{
		$maxLoanAmount = 1000000;				
	}
	else
	{
		$maxLoanAmount = $loanCalc;						
	}
	$checkOutput  .= 'maxLoanAmount Elite - - '.$maxLoanAmount;
}
else if($category=="Preferred" ) 
{
	//$maxLoanAmount = 1000000;	
	$loanCalc = $Net_Salary1 * 13;
	if($loanCalc>1000000)
	{
		$maxLoanAmount = 1000000;				
	}
	else
	{
		$maxLoanAmount = $loanCalc;						
	}
	$checkOutput  .= 'maxLoanAmount Preferred - '.$maxLoanAmount;
}

else if($existing_relationship==1 && ($relationship==1 || $relationship==2))	
{
//	$maxLoanAmount = 1000000;	
	$loanCalc = $Net_Salary1 * 9;
	if($loanCalc>1000000)
	{
		$maxLoanAmount = 1000000;				
	}
	else
	{
		$maxLoanAmount = $loanCalc;						
	}
		$checkOutput  .= 'maxLoanAmount Relation1 - '.$maxLoanAmount;
}
else 
{
//	$maxLoanAmount = 700000;	
	$loanCalc = $Net_Salary1 * 9;
	if($loanCalc>700000)
	{
		$maxLoanAmount = 700000;				
	}
	else
	{
		$maxLoanAmount = $loanCalc;						
	}
	$checkOutput  .= 'maxLoanAmount Relation0 - '.$maxLoanAmount;
}
//if($checkCompanyListNumRows>0 && $Total_Experience>2)	{	$Total_Experience = 2;		}
//else {		$Total_Experience = 5;		}

if(($category=="Elite" || $category=="Super Prime" ) && $existing_relationship==0)
{
	if($City=='Delhi'|| $City=='Gurgaon' || $City=='Gaziabad' || $City=='Faridabad' || $City=='Sahibabad' || $City=='Noida' || $City=='Greater Noida' || $City=='Mumbai' || $City=='Thane' || $City=='Navi mumbai')
	{
		$minimumSalary = 25000;
	}
	else
	{
		$minimumSalary = 20000;
	}
}	
else if(($category=="Elite" || $category=="Super Prime" ) && ($existing_relationship==1 && ($relationship==1 || $relationship==2) ))
{	
	if($City=='Delhi'|| $City=='Gurgaon' || $City=='Gaziabad' || $City=='Faridabad' || $City=='Sahibabad' || $City=='Noida' || $City=='Greater Noida' || $City=='Mumbai' || $City=='Thane' || $City=='Navi mumbai')
	{
		$minimumSalary = 25000;
	}
	else
	{
		$minimumSalary = 20000;
	}
}
else if(($Company_Type==4 || $Company_Type==5  ) && $existing_relationship==0)
{
	$minimumSalary = 40000;
}
else if(($Company_Type==4 || $Company_Type==5 ) && ($existing_relationship==1 && ($relationship==2) ))
{
	$minimumSalary = 35000;
}
else if(($Company_Type==4 || $Company_Type==5 ) && ($existing_relationship==1 && ($relationship==1) ))
{
	$minimumSalary = 35000;
}
else if(($category=="Preferred") &&  ($existing_relationship==1 && ($relationship==1 || $relationship==2) ))
{
	$minimumSalary = 25000;
}
else if($existing_relationship==1 && ($relationship==1 || $relationship==2))
{
	$minimumSalary = 30000;
}
else if(($category=="Preferred"))
{
	$minimumSalary = 40000;
}
else
{	
	$minimumSalary = 40000;
}
//echo "1: here i m:<br><br>";

$checkOutput  .= 'category - '.$category;
$checkOutput .= "<br>";
$checkOutput  .= 'existing_relationship - '.$existing_relationship;
$checkOutput .= "<br>";
$checkOutput  .= 'relationship - '.$relationship;
$checkOutput .= "<br>";
$checkOutput .= "<br>";
$checkOutput .= "minimumSalary - ".$minimumSalary;
$checkOutput .= "<br>";
$checkOutput .= "No of Loans - ". count($Loan_Any);
$checkOutput .= "<br>";

//echo $checkOutput."<br><br>";


if((in_array('pl', $Loan_Any)) && count($Loan_Any)==1)
{
		//$other_emi

	if($Net_Salary1>=50000)
	{
		$eligibleEMIAmt = $Net_Salary1 * (50/100);	
	}
	else
	{
		$eligibleEMIAmt = $Net_Salary1 * (40/100);	
	}
	
	if($other_emi>$eligibleEMIAmt)
	{
		$eligiblewrtLoanAmt = "No";
		$checkOutput .= "<br>";
		$checkOutput  .= 'DUE TO LOAN EMI PARAMATER';
		$checkOutput .= "<br>";
	}
	else
	{
		$eligiblewrtLoanAmt = "Yes";
	}
}
else
{
	//echo "have eneterd:<br><br>";
	if($Net_Salary1>=50000)
	{
	
		//$other_emi
		$eligibleEMIAmt = $Net_Salary1 * (65/100);
		if($other_emi>$eligibleEMIAmt)	{	$eligiblewrtLoanAmt = "No";	 }
		else	{ 	$eligiblewrtLoanAmt = "Yes";	}
	}	
	else
	{
		//$other_emi
		$eligibleEMIAmt = $Net_Salary1 * (55/100);
		if($other_emi>$eligibleEMIAmt)	{ 	$eligiblewrtLoanAmt = "No";		}
		else { 	$eligiblewrtLoanAmt = "Yes";	}
	}	
}
	if($eligiblewrtLoanAmt == "No")
	{
	$checkOutput .= "<br>";
	$checkOutput  .= 'DUE TO eligiblewrtLoanAmt PARAMATER';
	$checkOutput .= "<br>";
	}
$checkOutput .=  "<br>";
$checkOutput .= "eligibleEMIAmt ".$eligibleEMIAmt;
$checkOutput .= "<br>";
$checkOutput .= "eligiblewrtLoanAmt ".$eligiblewrtLoanAmt;
$checkOutput .= "<br>";
//$card_obligation
if($card_obligation>15000)
{
	$cc_obligation = ($card_obligation - 15000) * 10/100;
}
$checkOutput .= "cc_obligation ".$cc_obligation;
$checkOutput .= "<br>";

if($category=="Elite" || $category=="Super Prime" )
{
	$maxTenure = 60;
}

else if($category=="Preffered")//Added
{
	$maxTenure = 48;//Added
}

else
{
	$maxTenure = 36;//Added
}

if($age>=$checkAge && $age<59)
{
}
else
{
	$checkOutput .= "<br>";
	$checkOutput  .= 'DUE TO Age PARAMATER';
	$checkOutput .= "<br>";

}

if(($Employment_Status==1) && ($age>=$checkAge && $age<59) &&  ($Net_Salary1>$minimumSalary) && ($eligiblewrtLoanAmt == "Yes") && ($Company_Type!=6) && ($Residential_Status==2 || $Residential_Status==1))
{
	//echo "entered:<br><br>";
//	echo "<br>";
	//echo "Final";
	if($Specialinterest_rate>0)
	{
		$intr_rate = $Specialinterest_rate;
		$proc_fee = $Specialprocessing_fee;
	}
	else if(($category=="Elite" || $category=="Preferred" || $category=="Super Prime" || $Company_Type==4 || $Company_Type==5) && ($existing_relationship==1 && ($relationship==1 || $relationship==2)))
	{
	  	if($Net_Salary1>75000)
		{
			$intr_rate = 15.5;
			$proc_fee = 2;
		}
		else if($Net_Salary1>=50000 && $Net_Salary1<75000)
		{
			$intr_rate = 16;
			$proc_fee = 2;
		}
		else if($Net_Salary1>=30000 && $Net_Salary1<50000)
		{
			$intr_rate = 17;
			$proc_fee = 2;
		}
		else if($Net_Salary1>=20000 && $Net_Salary1<30000)
		{
			$intr_rate = 18.25;
			$proc_fee = 2.25;
		}
				
	}
	else if ($category=="Elite" || $category=="Preferred" || $category=="Super Prime" || $Company_Type==4 || $Company_Type==5 && ($existing_relationship==0))
	{
		if($Net_Salary1>75000)
		{
			$intr_rate = 15.5;
			if($category=="Elite" || $category=="Super Prime")
			{
				$proc_fee = 2;
			}
			else
			{
			$proc_fee = 2.25;
			}
		}
		else if($Net_Salary1>=50000 && $Net_Salary1<75000)
		{
			$intr_rate = 16;
			if($category=="Elite" || $category=="Super Prime")
			{
				$proc_fee = 2;
			}
			else
			{
			$proc_fee = 2.25;
			}
		}
		else if($Net_Salary1>=30000 && $Net_Salary1<50000)
		{
			$intr_rate = 17;
			if($category=="Elite" || $category=="Super Prime")
			{
				$proc_fee = 2;
			}
			else
			{
			$proc_fee = 2.25;
			}
		}
		else if($Net_Salary1>=20000 && $Net_Salary1<30000)
		{
			$intr_rate = 18.25;
			$proc_fee = 2.25;
		}
	}
	else if($existing_relationship==1 && ($relationship==1 || $relationship==2))
	{
		if($Net_Salary1>75000)
		{
			$intr_rate = 15.5;
			$proc_fee = 2.25;
		}
		else if($Net_Salary1>=50000 && $Net_Salary1<75000)
		{
			$intr_rate = 16;
			$proc_fee = 2.25;
		}
		else if($Net_Salary1>=30000 && $Net_Salary1<50000)
		{
			$intr_rate = 17;
			$proc_fee = 2.25;
		}
		else if($Net_Salary1>=20000 && $Net_Salary1<30000)
		{
			$intr_rate = 18.25;
			$proc_fee = 2.25;
		}
	}
	else
	{
		if($Net_Salary1>75000)
		{
			$intr_rate = 15.5;
			$proc_fee = 2.25;
		}
		else if($Net_Salary1>=50000 && $Net_Salary1<75000)
		{
			$intr_rate = 16;
			$proc_fee = 2.25;
		}
		else if($Net_Salary1>=30000 && $Net_Salary1<50000)
		{
			$intr_rate = 17;
			$proc_fee = 2.25;
		}
		else if($Net_Salary1>=20000 && $Net_Salary1<30000)
		{
			$intr_rate = 18.25;
			$proc_fee = 2.25;
		}
	}
	
//echo "here i m:<br><br>";
	$intr_rate_cal = $intr_rate / 1200;
	//Calculate per lac EMI
//	$emiperlac = 100000 * $maxTenure * $intr_rate_cal; 
	//echo "<br>";
	//echo "intr_rate_cal ".$intr_rate_cal ; 
	//echo "<br>";
	//echo "maxTenure ".$maxTenure ; 
	//echo "<br>";	
	$checkOutput .= "<br>";
	$checkOutput .=	"intr_rate ".$intr_rate;
	$checkOutput .= "<br>";
	$checkOutput .= "maxTenure - ".$maxTenure;
	$checkOutput .= "<br>";
	$emiperlac = round(100000 * ($intr_rate_cal / (1 - (pow(1/(1 + $intr_rate_cal), $maxTenure)))));
	$finalEMI = $eligibleEMIAmt - $cc_obligation - $other_emi;
	
	$checkOutput .= "<br>";
	$checkOutput .=	"emiperlac".$emiperlac;
	$checkOutput .= "<br>";
	$checkOutput .= "finalEMI".$finalEMI;
	$checkOutput .= "<br>";
	
	if($emiperlac>$finalEMI)
	{
		// not Eligible
		$notEligible = "YES";
	}
	else
	{
		$finalLoanAmount = $finalEMI / $emiperlac * 100000;
		if($finalLoanAmount>$maxLoanAmount)
		{
			$finalLoanAmount = $maxLoanAmount ;
		}
		
	}
	if($finalLoanAmount>0)
	{
	?>
       <table cellpadding="2" cellspacing="1" width="100%" border="0" bgcolor="#666666" >
    <tr><td align="center" valign="middle" bgcolor="#f0ede4" height="35">
<strong>Loan Amount</strong>		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
	<strong>	Rate of Interest</strong>		</td>
         <td align="center" valign="middle" bgcolor="#f0ede4">
	<strong>	EMI per Lac</strong>		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
	<strong>Processing Fee </strong>		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
<strong>Tenure</strong>        </td>
    </tr>

    <tr><td align="center" valign="middle" bgcolor="#f0ede4" height="35">
    
		Rs. <?php echo round($finalLoanAmount) ; ?>/-
		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
		<?php echo $intr_rate ." %"; ?>		</td>
     <td align="center" valign="middle" bgcolor="#f0ede4">
		Rs. <?php echo $emiperlac; ?>/- </td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
		<?php echo $proc_fee ." %" ; ?>		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
	<?php echo $maxTenure/12 ." Years" ;  ?>  </td>
    </tr>
    </table>
     
      <?php  
	}
	else
	{
		$notEligible = "Not Eligible";
	}

}
else if(($Employment_Status==1) && ($Company_Type==6) && ($Residential_Status==2 || $Residential_Status==1) && ($Total_Experience>5))
{
	$intr_rate = 16;
	$proc_fee = 0;
	$intr_rate_cal = $intr_rate / 1200;
	$maxTenure = 36;
	$maxLoanAmount = 1000000;
	$eligibleEMIAmt = $Net_Salary1 * (50/100);
	
	$checkOutput .= "<br>";
	$checkOutput .=	"eligibleEMIAmt ".$eligibleEMIAmt;
	
	if($other_emi>$eligibleEMIAmt)	{	$eligiblewrtLoanAmt = "No";	 }
	else	{ 	$eligiblewrtLoanAmt = "Yes";	}
	if($eligiblewrtLoanAmt == "Yes")
	{
		$emiperlac = round(100000 * ($intr_rate_cal / (1 - (pow(1/(1 + $intr_rate_cal), $maxTenure)))));
		$finalEMI = $eligibleEMIAmt - $cc_obligation - $other_emi;	
		$finalLoanAmount = 7 * $Net_Salary1 ;
		$checkOutput .= "<br>";
		$checkOutput .=	"finalLoanAmount ".$finalLoanAmount;
					
		if($finalLoanAmount>$maxLoanAmount)
		{
			$finalLoanAmount = $maxLoanAmount ;
		}
		
		if($finalLoanAmount>0)
		{
		?>
       <table cellpadding="2" cellspacing="1" width="100%" border="0" bgcolor="#666666" >
    <tr><td align="center" valign="middle" bgcolor="#f0ede4" height="35">
<strong>Loan Amount</strong>		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
	<strong>	Rate of Interest</strong>		</td>
         <td align="center" valign="middle" bgcolor="#f0ede4">
	<strong>	EMI per Lac</strong>		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
	<strong>Processing Fee </strong>		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
<strong>Tenure</strong>        </td>
    </tr>
    <tr><td align="center" valign="middle" bgcolor="#f0ede4" height="35">
		Rs. <?php echo round($finalLoanAmount) ; ?>/-
		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
		<?php echo $intr_rate ." %"; ?>		</td>
            <td align="center" valign="middle" bgcolor="#f0ede4">
		Rs. <?php echo $emiperlac; ?>/- </td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
		<?php echo $proc_fee ." %" ; ?>		</td>
    <td align="center" valign="middle" bgcolor="#f0ede4">
	<?php echo $maxTenure/12 ." Years" ;  ?>     </td>
    </tr>
    </table>		  <?php  
		}
		else
		{
			$notEligible = "Not Eligible";
		}	
	}
}
else
{
	$notEligible = "Not Eligible";
}
echo "<br>";
echo $checkOutput;   
echo "<br>";
 if($notEligible== "Not Eligible")
  {
  	echo "<b>Sorry You Are Not Eligible As Per Policy</b>";
  }   
?>
  </td></tr>
  <?php
  if($notEligible!= "Not Eligible")
  {
  ?>
  <tr><td align="right" style="padding-right:20px; padding-top:20px;">

  <form name="loan_form" method="post" action="icici-personal-loan-continue.php" onSubmit="return submitform(document.loan_form);" >
     <input type="hidden" name="Employment_Status" value="<?php echo $Employment_Status ; ?>" />
    <input type="hidden" name="company_name" value="<?php echo $company_name ; ?>" />
     <input type="hidden" name="Company_Type" value="<?php echo $Company_Type ; ?>" />
    <input type="hidden" name="City" value="<?php echo $City ; ?>" />
    <input type="hidden" name="Years_In_Company" value="<?php echo $Years_In_Company ; ?>" />
    <input type="hidden" name="Total_Experience" value="<?php echo $Total_Experience ; ?>" />
    <input type="hidden" name="Net_Salary1" value="<?php echo $Net_Salary1 ; ?>" />
    <input type="hidden" name="Loan_Amount" value="<?php echo $Loan_Amount ; ?>" />
    <input type="hidden" name="DOB" value="<?php echo $DOB; ?>" />
    <input type="hidden" name="age" value="<?php echo $age ; ?>" />

    <input type="hidden" name="business_running" value="<?php echo $business_running ; ?>" />
    <input type="hidden" name="Net_Salary1" value="<?php echo $Net_Salary1 ; ?>" />
    <input type="hidden" name="Total_Experience" value="<?php echo $Total_Experience ; ?>" />
    <input type="hidden" name="Residential_Status" value="<?php echo $Residential_Status ; ?>" />
    <input type="hidden" name="CC_Holder" value="<?php echo $CC_Holder ; ?>" />
    <input type="hidden" name="card_obligation" value="<?php echo $card_obligation ; ?>" />
    <input type="hidden" name="existing_relationship" value="<?php echo $existing_relationship ; ?>" />
    <input type="hidden" name="relationship" value="<?php echo $relationship ; ?>" />

   <input type="hidden" name="LoanAny" value="<?php echo $LoanAny ; ?>" />
    <input type="hidden" name="Loan_Any" value="<?php echo $LoansRunning ; ?>" />
    <input type="hidden" name="EMI_Paid" value="<?php echo $EMI_Paid ; ?>" />
    <input type="hidden" name="other_emi" value="<?php echo $other_emi ; ?>" />
   
   
    <input type="hidden" name="finalLoanAmount" value="<?php echo round($finalLoanAmount) ; ?>" />
    <input type="hidden" name="intr_rate" value="<?php echo $intr_rate ; ?>" />
    <input type="hidden" name="proc_fee" value="<?php echo $proc_fee ; ?>" />

    <input type="hidden" name="emiperlac" value="<?php echo $emiperlac; ?>" />
    <input type="hidden" name="Tenure" value="<?php echo $maxTenure/12 ; ?>" />
        <input type="hidden" name="Residential_Stability" value="<?php echo $Residential_Stability ; ?>" />
    


    <input name="submit1" type="button" class="btnclr" value="Apply and Share your information" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'" />
   <div id="light" class="white_content" style="text-align:right"><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" style="text-decoration:none; font-size:14px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold;">X</a>
   <table cellpadding="2" cellspacing="2" border="0" width="360">
   <tr><td colspan="2" align="center"><b style="font-size:14px; font-family:Verdana, Arial, Helvetica, sans-serif;">Fill Details</b></td></tr>
   <tr><td><b style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif;">Name</b></td><td><input type="text" name="Name" id="Name"  /></td></tr>
      <tr><td><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Mobile</b></td><td><input type="text" name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"   /></td></tr>
      <tr><td><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Email</b></td><td><input type="text" name="Email" id="Email"    /></td></tr>
           <!--  <tr><td><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Pancard</b></td><td><input name="Pancard" id="Pancard" maxlength="10" /></td></tr> -->
         <tr><td>&nbsp;</td><td align="left"><input type="submit" name="submit" id="Submit" value="Submit" style="background-color: #1273AB;    border: medium none;    color: #FFFFFF;    font-family: Verdana,Arial,Helvetica,sans-serif;    font-size: 12px;    font-weight: bold;    height: 30px;    width: 80px;"  /></td></tr>
   </table>
   </div>
	<div id="fade" class="black_overlay"></div>
  </form>
  </td></tr>
  <?php
  }
 
  ?>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p><p>&nbsp;</p>
  <p>&nbsp;</p><p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p></td></tr>
</table>
</td></tr></table>
</body>
</html>
