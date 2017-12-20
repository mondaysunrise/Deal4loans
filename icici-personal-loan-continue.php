<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	function DetermineAgeGETDOB ($YYYYMMDD_In){  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;   if ($mdiff < 0)  {     $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }
	
$cityList = 
'Agra,Ahmedabad,Surat,Vadodara,Gwalior,Vidisha,Hoshangabad,Itarsi,Ambala,Shimla,Chandigarh,Mandi,Patiala,Baddi,Mohali,Trivandrum,Kochi,Thrissur,Coimbatore,Erode,Ooty,Salem,Namakkal,Udumalpet,Rishikesh,Haridwar,Jamshedpur,Siliguri,Cuttack,Bhubaneshwar,Indore,Bhopal,Ujjain,Dewas,Ratlam,Mandsour,Neemuch,Jabalpur,Katni,Satna,Rewa,Singrauli,Jaipur,Ajmer,Alwar,Jodhpur,Bikaner,Pali,Ganganagar,Sonepat,Bahadhurgarh,Kurukshetra,Hisar,Kanpur,Jhansi,Lucknow,Meerut,Agra,Madurai,Tirunelveli,Nagercoil,Tuticorin,Rajapalayam,Sivakasi,Palani,Ramanathapuram,Nagpur,Nasik,Goa,Panaji,Margao,Vasco,Mapusa,Ponda,Bathinda,Ropar,Ludhiana,Jalandhar,Jammu,Pathankot,Amritsar,Hoshiarpur,Phagwara,Raipur,Rajnandgaon,Bilaspur,Durg,Raigarh,Korba,Rajkot,Ongole,Nellore,Tirupathi,Khammam,Kurnool,Ananthpur,Chittor,Kothagudem,Trichy,Thanjavur,Dindigul,Karur,Kumbakonam,Pudukottai,Tanjore,Karaikudi,Pattukottai,Mayiladuthurai,Udaipur,Bhilwara,Beawar,Banswara,Vellore,Pondicherry,Karaikkal,Kanchipuram,Krishnagiri,Vaniyambadi,Panruti,Tiruvannamalai,Guntur,Eluru,Vijayawada,Bhimavaram,Tenali,Machilipatnam,Tanuku,Palacollu,Rajahmundry,Srikakulam,Vizianagaram,Kakinada,Vizag,Anakapalli,Pitapuram,Tuni,Warangal,Nizamabad,Karimnagar,Ramagundam,Mahaboob Nagar,Armoor,Kodad,Aurangabad,Kolhapur,Ahmednagar,Solapur,Nanded,Latur,Parbhani,Satara,Chandrapur,Ratnagiri,Sangli,Jalna,Amravati,Beed,Nandurbar,Wardha,Akot,Greater Noida,Faridabad,Sahibabad,Dehradun,Rudhrapur,Saharanpur,Kishangarh,Haldwani,Firozabad,Mysore,Hubli,Hosur,Udipi,Mangalore,Belgaum,Hospet,Rishikesh';
$city_List = explode(",", $cityList);
sort($city_List);

$metrosCityList = "Bangalore,Chennai,Delhi,Gaziabad,Gurgaon,Hyderabad,Kolkata,Mumbai,Navi Mumbai,Noida,Pune,Thane";
$metrosCity_List = explode(",", $metrosCityList);
sort($metrosCity_List);



$checkOutput  = '';
$checkOutput  .= '<br><br> ';

	$City = $_POST['City'];
	
	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	
	$DOB = $_POST['DOB'];
	
	$age = $_POST['age'];
	$Loan_Amount = $_POST['Loan_Amount'];
	$Employment_Status = $_POST['Employment_Status'];
	if($Employment_Status==1)
	{
		$Company_Name = $_POST['company_name'];
		$Company_Type = $_POST['Company_Type'];
		$Years_In_Company = $_POST['Years_In_Company'];
		$Total_Experience = $_POST['Total_Experience'];
		$Months_Company = $_POST['Months_Company'];
		$Total_Exp_Month = $_POST['Total_Exp_Month'];
		$Net_Salary1 = $_POST['Net_Salary1'];
		$Net_Salary = $Net_Salary1 * 12;
	}
	else
	{
		$business_running = $_POST['business_running'];
		$Net_Salary1 = $_POST['Net_Salary1'];
		$Total_Experience = $_POST['Total_Experience'];
		$Total_Exp_Month = $_POST['Total_Exp_Month'];
		$Net_Salary = $Net_Salary1;
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
	$source=$_REQUEST['source'];
	$IP = getenv("REMOTE_ADDR");
	$finalLoanAmount = $_POST['finalLoanAmount'];
	$intr_rate = $_POST['intr_rate'];
	$emiperlac = $_POST['emiperlac'];
	$proc_fee = $_POST['proc_fee'];
	$Tenure=$_REQUEST['Tenure'];
	$Residential_Stability = $_POST['Residential_Stability'];
	$Activate = generateNumber(4);
	//$app_code = date('dmy')."".$Activate;	
	
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
	$days30date=date('Y-m-d',$tomorrow);
	$days30datetime = $days30date." 00:00:00";
	$currentdate= date('Y-m-d');
	$currentdatetime = date('Y-m-d')." 23:59:59";
	
	$getdetails="select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9911940202,9891118553,9999570210) and Mobile_Number='".$Phone."' and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
	list($alreadyExist,$myrow)=Mainselectfunc($getdetails,$array = array());

	$getAppcodeQuery = ("SELECT AppID FROM `pl_icici_leads` WHERE 1 =1 ORDER BY `RequestID` DESC LIMIT 0 , 1");
	list($recordcount,$getAppcodeQuery)=MainselectfuncNew($getAppcodeSql,$array = array());
	$AppID = $getAppcodeQuery[0]['AppID'];

	$app_code = $AppID+1;

	$Dated = ExactServerdate();
	$dataInsert = array('Name'=>$Name, 'Email'=>$Email, 'Mobile_Number'=>$Phone, 'City'=>$City, 'DOB'=>$DOB, 'age'=>$age, 'Loan_Amount'=>$Loan_Amount, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'Company_Type'=>$Company_Type, 'Years_In_Company'=>$Years_In_Company, 'Total_Experience'=>$Total_Experience, 'Net_Salary'=>$Net_Salary, 'business_running'=>$business_running, 'Residential_Status'=>$Residential_Status, 'CC_Holder'=>$CC_Holder, 'card_obligation'=>$card_obligation, 'existing_relationship'=>$existing_relationship, 'relationship'=>$relationship, 'LoanAny'=>$LoanAny, 'Loan_Any'=>$Loan_Any, 'EMI_Paid'=>$EMI_Paid, 'other_emi'=>$other_emi, 'source'=>$source, 'IP'=>$IP, 'Dated'=>$Dated, 'finalLoanAmount'=>$finalLoanAmount, 'intr_rate'=>$intr_rate, 'proc_fee'=>$proc_fee, 'Tenure'=>$Tenure, 'AppID'=>$app_code, 'Residential_Stability'=>$Residential_Stability, 'Reference_Code'=>$Activate, 'Years_Company'=>$Years_In_Company, 'Month_Company'=>$Months_Company, 'Total_Exp_Year'=>$Total_Experience, 'Total_Exp_Month'=>$Total_Exp_Month);
		$ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);
		
		
	$SMSMessage = "Please use this code:".$Activate."  to activate you loan request at deal4loans.com";
	SendSMSforLMS($SMSMessage, $Phone);
	//}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ICICI Personal Loan</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
 <script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
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


<style type="text/css">input{	margin:0px;	padding:0px;	border:1px solid #878787;}select{	margin:0px;	padding:0px;	border:1px solid #878787;}#txt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;  	padding-left:25px;	line-height:21px;	padding-top:8px;} .btmboxbg{	background-image:url(images/btm-box.jpg);	width:273px;	height:131px;	background-repeat:no-repeat;	background-position:center;}.redtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:12px;	font-weight:bold;	color:#8b321b;}.blktxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	text-align:left;	line-height:16px;	padding-top:6px;}.frmhdng{	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891;}.frmbg{ 	border-left:1px solid #c2c2c2;	border-bottom:1px solid #c2c2c2;}.frmtxt{	font-family:Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	font-weight:bold; padding-left:3px; padding-bottom:5px;	color:#332d33;}.frmrgtbrdr{	border-bottom:22px solid #802891;	background-color:#fecb09;}/* START CSS NEEDED ONLY IN DEMO */	 </style>
<style>		
.black_overlay{			display: none;			position: absolute;			top: 0%;			left: 0%;			width: 100%;			height: 100%;			background-color: black;			z-index:1001;			-moz-opacity: 0.8;			opacity:.50;			filter: alpha(opacity=50);		}
		.white_content {			display: none;			position: absolute;			top: 25%;			left: 25%;			width: 260;			height: 250;			padding: 6px;			border: 2px solid black;			background-color: white;			z-index:1002;			overflow: auto;		}
.bldtxt {font-weight:bold;
line-height:16px;
color:#4f4d4d;
}
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
	  
	 if(Form.validateMobile.value=='') 
	{
		alert("Kindly validate your Mobile Number!");
		document.loan_form.validateMobile.select();
		return false;
	}
		
	if(Form.validateMobile.value!= <?php echo $Activate; ?>) 
	{
		alert("Kindly enter correct verification code!");
		document.loan_form.validateMobile.select();
		return false;
	}
	if(Form.residence_address.value=="")
	{
		alert("Kindly fill in your Residence Address!");
		document.loan_form.residence_address.focus();
		return false;
	}
	if(Form.pincode.value=="")
	{
		alert("Kindly fill in your Pincode!");
		document.loan_form.pincode.focus();
		return false;
	}
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
	if(Form.office_std.value=="" || Form.office_std.value=="Std")
	{
		alert("Kindly fill in your Office Std Code!");
		document.loan_form.office_std.focus();
		return false;
	}
	if(Form.office_phone.value=="" || Form.office_phone.value=="Number")
	{
		alert("Kindly fill in your Office Number!");
		document.loan_form.office_phone.focus();
		return false;
	}
	if(Form.office_ext.value=="" || Form.office_ext.value=="Ext")
	{
		alert("Kindly fill in your Office Ext. If there is no Ext , kindly put 0!");
		document.loan_form.office_ext.focus();
		return false;
	}
	if(Form.Primary_Acc.value=="")
	{
		alert("Please fill your Salary Account.");
		Form.Primary_Acc.focus();
		return false;
	}
}


</script>
</head>
<body bgcolor="#999999" style="font-family:Arial, Helvetica, sans-serif;">
<form action="icici-personal-loan-thanks.php" name="loan_form" method="post" onSubmit="return submitform(document.loan_form);">
 <input type="hidden" name="ProductValue" value="<?php echo $ProductValue ; ?>" />
   <input type="hidden" name="app_code" value="<?php echo $app_code ; ?>" />
       <input type="hidden" name="emiperlac" value="<?php echo $emiperlac; ?>" />
      <input type="hidden" name="finalLoanAmount" value="<?php echo $finalLoanAmount ; ?>" />
    <input type="hidden" name="intr_rate" value="<?php echo $intr_rate ; ?>" />
    <input type="hidden" name="proc_fee" value="<?php echo $proc_fee ; ?>" />
    <input type="hidden" name="Tenure" value="<?php echo $Tenure; ?>" />
<table cellpadding="0" cellspacing="0" border="0" align="center" width="970" bgcolor="#FFFFFF">
<tr><td align="center">
<table cellpadding="2" cellspacing="0" border="0">
<tr><td width="429" align="left"><img src="new-images/icici-pl-logi.jpg" /></td>
<td width="534" align="right" valign="bottom"><table cellpadding="2" cellspacing="1" width="534" border="0" bgcolor="#666666" >
  <tr>
    <td align="center" valign="middle" bgcolor="#f0ede4" height="35"><strong>Loan Amount</strong> </td>
    <td align="center" valign="middle" bgcolor="#f0ede4"><strong> Rate of Interest</strong> </td>
    <td align="center" valign="middle" bgcolor="#f0ede4"><strong>EMI per Lac</strong> </td>
       <td align="center" valign="middle" bgcolor="#f0ede4"><strong>Processing Fee </strong> </td>
    <td align="center" valign="middle" bgcolor="#f0ede4"><strong>Tenure</strong> </td>
  </tr>
  <tr>
    <td align="center" valign="middle" bgcolor="#f0ede4" height="35"> Rs. <?php echo round($finalLoanAmount) ; ?>/- </td>
    <td align="center" valign="middle" bgcolor="#f0ede4"><?php echo $intr_rate ." %"; ?> </td>
    <td align="center" valign="middle" bgcolor="#f0ede4">Rs. <?php echo $emiperlac; ?>/- </td>
    <td align="center" valign="middle" bgcolor="#f0ede4"><?php echo $proc_fee ." %" ; ?> </td>
    <td align="center" valign="middle" bgcolor="#f0ede4"><?php echo $Tenure ." Years" ;  ?> </td>
  </tr>
</table></td>
</tr>
<tr><td colspan="2"><img src="new-images/hd1.jpg" width="960" /></td></tr>
<tr><td colspan="2" align="center" >
<table width="960" height="112" cellpadding="3" cellspacing="3" bgcolor="#f0ede4" style="border:#dcdacd 2px solid;">
   <tr><td bgcolor="#f0ede4"  width="960"  colspan="5" align="center" ><div id="product_head">
  <h2>Personal Loan Quote</h2>
</div>
  </td></tr>
  <tr>

  <tr>
<td width="255" height="26" align="left" class="frmtxt" style="padding-left:4px;">Full Name <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td width="251" align="left" class="frmtxt"><input style="width:180px;  height:21px;"  name="Name" id="Name" value="<?php echo $Name; ?>" ></td>
	<td width="4" align="center" class="frmtxt">&nbsp;</td>
	<td align="left" valign="top" class="frmtxt">City <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
    <td width="270" align="left">
      <input  style="width:180px;  height:21px;"   name="City" id="City" value="<?php echo $City; ?>"  readonly="readonly"  />
    </td>
  </tr>
   <tr>
	<td height="26" align="left" class="frmtxt">Email <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frmtxt"><input  style="width:180px;  height:21px;"   name="Email" id="Email" value="<?php echo $Email; ?>" readonly  /></td>
	<td align="center" class="frmtxt">&nbsp;</td>
<td width="176" align="left" valign="top"><span class="frmtxt">Mobile No. </span></td>
    <td width="270" align="left" style="font-size:12px;"><input  style="width:180px;  height:21px;" name="Phone" id="Phone" value="<?php echo $Phone; ?>" readonly="readonly"  type="text" ></td>
   </tr>
  <tr>
	<td height="26" align="left" class="frmtxt">&nbsp;</td>
	<td height="26" align="left" class="frmtxt">&nbsp;</td>
	<td align="center" class="frmtxt">&nbsp;</td>
	<td align="left" class="frmtxt">Verification Code</td>
    <td align="left" class="frmtxt">
    <input style="width:180px; height:21px;"  name="validateMobile" id="validateMobile"  maxlength="4" onChange="intOnly(this);"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this); " /></td>
   </tr>
  <tr>
	<td height="26" align="left" class="frmtxt">Resi Address Line 1 <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frmtxt"><input  style="width:180px;  height:21px;"   name="residence_address" id="residence_address"    /></td>
	<td align="center" class="frmtxt">&nbsp;</td>
	<td align="left" class="frmtxt">Resi Address line 2 </td>
    <td align="left" class="frmtxt"><input style="width:180px; height:21px;"  name="office_address" id="office_address" /></td>
   </tr>
    <tr>
	<td height="26" align="left" class="frmtxt">Pincode <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frmtxt"><input  style="width:180px;  height:21px;"   name="pincode" id="pincode"  maxlength="6" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>
	<td align="center" class="frmtxt">&nbsp;</td>
	<td align="left" class="frmtxt">Resi Telephone</td>
    <td align="left" class="frmtxt"><input style="width:40px; height:21px;"  name="home_std" id="home_std" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;<input style="width:130px; height:21px;"  name="home_phone" id="home_phone" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>
   </tr>
   <tr>
	<td height="26" align="left" class="frmtxt">Company Name <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
<td height="26" align="left" class="frmtxt"><input style="width:180px; height:21px;"  name="company_name" id="company_name" value="<?php echo $Company_Name; ?>" readonly /></td>
	<td align="center" class="frmtxt">&nbsp;</td>
	<td align="left" class="frmtxt">Designation</td>
    <td align="left" class="frmtxt"><input style="width:180px; height:21px;"  name="Designation" id="Designation" /></td>
   </tr>
<tr>
	<td height="26" align="left" valign="top" class="frmtxt">Pancard No <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
	<td height="26" align="left" class="frmtxt"><input style="width:180px; height:21px;"  name="Pancard" id="Pancard" maxlength="10" /></td>
	<td align="center" class="frmtxt">&nbsp;</td>
	<td align="left" valign="top"><span class="frmtxt">Office Telephone <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></span></td>
    <td align="left"><span class="frmtxt" style="font-weight:normal; ">
    <input style="width:40px; height:21px;"  name="office_std" id="office_std" value="Std" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;<input style="width:85px; height:21px;"  name="office_phone" id="office_phone" value="Number" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>&nbsp;<input style="width:40px; height:21px;"  name="office_ext" id="office_ext" value="Ext" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/>
    </span></td>
  </tr>

   
      <tr>
	<td height="26" align="left" class="frmtxt"><span class="bldtxt">Primary Account 
                in which bank? </span><span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
<td height="26" align="left" class="frmtxt"><input type="text" style="width:180px; height:21px;" name="Primary_Acc" id="Primary_Acc" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event); getstatementlink();" onchange="getstatementlink();" onkeydown="getstatementlink();" onclick="getstatementlink();"></td>
	<td align="center" class="frmtxt">&nbsp;</td>
	<td align="left" class="frmtxt"><span class="bldtxt">Credit Card Limit?</span></td>
    <td align="left" class="frmtxt"><input style="width:180px; height:21px;" name="Credit_Limit" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onfocus="this.select();"></td>
   </tr>
<tr valign="bottom">
    <td height="40" colspan="5" align="center">
    <input name="submit" type="submit" class="btnclr" value="Submit" /></td>
    </tr>
  </table></td></tr>
</table>
</td></tr></table></form>
</body>
</html>
