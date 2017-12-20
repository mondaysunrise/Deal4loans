<?php
	ob_start();
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//	require 'scripts/personal_loan_eligibility_function.php';
require 'ingFunction.php';
	//error_reporting('E_ALL');

//		error_reporting();

	function filter_blank($var) 

	{

		return !(empty($var) || is_null($var));

	}



	//print_r($_POST);

function DetermineAgeGETDOB ($YYYYMMDD_In)

{

  $yIn=substr($YYYYMMDD_In, 0, 4);

  $mIn=substr($YYYYMMDD_In, 4, 2);

  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;

  $mdiff = date("m") - $mIn;

  $ydiff = date("Y") - $yIn;

  if ($mdiff < 0)

  {

    $ydiff--;

  } elseif ($mdiff==0)

  {

    if ($ddiff < 0)

    {

      $ydiff--;

    }

  }

  return $ydiff;

}



	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		foreach($_POST as $a=>$b)
			$$a=$b;
		$UserID = $_SESSION['UserID'];
		$finalurl=$_POST["PostURL"];

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

		$Type_Loan = FixString($Type_Loan);

		

		$Company_Name = FixString($Company_Name);

		$Accidental_Insurance = FixString($Accidental_Insurance);

		$City = FixString($City);

		$From_Product = $_REQUEST['From_Product'];

		$City_Other = FixString($City_Other);

		$Net_Salary = $_REQUEST['Net_Salary1'];

		$CC_Holder = FixString($CC_Holder);

		$Card_Vintage = FixString($Card_Vintage);


		$_SESSION['Temp_CC_Holder'] = $CC_Holder;

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

		$Employment_Status=$_REQUEST['Employment_Status'];

		$Company_Name=$_REQUEST['company_name'];

		$getCompany_Name = $Company_Name;

		$business_running=$_REQUEST['business_running'];

		$Type_Loan="Req_Loan_Personal";

		$crap = " ".$Name." ".$Email;

		$crapValue = validateValues($crap);

		$_SESSION['crapValue'] = $crapValue;

		$validMobile = is_numeric($Phone);

		$validYear  = is_numeric($Year);

		$validMonth = is_numeric($Month);

		$validDay = is_numeric($Day);

		//list($year,$month,$day) = split('[-]', $DOB);

		$currentyear=date('Y');
		$strDOB = $Year."".$Month."".$Day;
		$age=DetermineAgeGETDOB($strDOB);

		

		$loan_running = $_REQUEST['loan_running'];

	

		$monthsalary = $Net_Salary;

	
			if($Employment_Status==1)

			{

				$Annual_Salary = $Net_Salary * 12;

			}

			else

			{

				$Annual_Salary = $Net_Salary;

			}

			$exceptionMobiles = "99719396361,9899802807,9811215138";


				$leadid = $ProductValue;
				
//echo				ingVyasyaLoans ($Company_Name, $Net_Salary, $account_holder,$age,$other_emi,$Loan_Amount);
				list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= ingVyasyaLoans ($company_name, $Net_Salary, $account_holder,$age,$other_emi,$Loan_Amount);
			//	echo "<br>&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&<br>";
				//echo $interestrate."--".$getloanamout."--".$getemicalc."--".$term;

				//echo "<br>&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&<br>";
				
				$_SESSION['Temp_LID'] = $ProductValue;

				list($First,$Last) = split('[ ]', $Name);
	
	}	 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Personal Loans :: Business Loans</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list.js"></script>
<style type="text/css">
body{	margin:0px;	padding:0px;	color:#2e2e2e;}input{	margin:0px;	padding:0px;	border:1px solid #878787;}select{	margin:0px;	padding:0px;	border:1px solid #878787;}form{margin:0px;padding:0px;}.hdr{	background-image:url(images/hdr.gif);	background-repeat:no-repeat;	height:75px;}.hdng-bg{	background-image:url(images/top-bg.jpg);	background-repeat:no-repeat;	height:36px;	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#ff6d03; 	text-indent:15px;}.yelobrder{	border-left:1px solid #fde37a;	border-right:1px solid #fde37a;}#txt{	font-family:Arial, Helvetica, sans-serif;	font-size:13px;	font-weight:bold; 	padding-left:25px;	line-height:21px;	padding-top:8px;}.yelobrder ul{	margin:5px 0px 0px 10px;	padding:5px 0px 0px 10px;}.yelobrder ul li{	background-image:url(images/arow.jpg) ;	background-repeat:no-repeat;	list-style-type:none; 	padding-left:18px; 	padding-right:0; 	padding-top:0; 	padding-bottom:4px;	font-family:Arial, Helvetica, sans-serif;	line-height:18px;	font-size:13px;	font-weight:bold; }.imgpostn{	padding-left:31px;	padding-top:10px;} .btmboxbg{	background-image:url(images/btm-box.jpg);	width:273px;	height:131px;	background-repeat:no-repeat;	background-position:center;}.redtxt{	font-family:Arial, Helvetica, sans-serif;	font-size:13px;	font-weight:bold;	color:#8b321b;}.blktxt{	font-family:Arial, Helvetica, sans-serif;	font-size:12px;	text-align:left;	line-height:17px;	padding-top:8px;}.frmhdng{	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#ff6d03;}.nrmltxt{	font-family:Arial, Helvetica, sans-serif;	font-size:12px;	text-align:left;	line-height:17px;}.frmbg{ 	border-left:1px solid #c2c2c2;	border-bottom:1px solid #c2c2c2;}.frmtxt{	font-family:Arial, Helvetica, sans-serif;	font-size:13px;	font-weight:bold;	color:#332d33;}.frmrgtbrdr{	border-bottom:22px solid #ff6d03;	background-color:#fecb09;}/* START CSS NEEDED ONLY IN DEMO */		#mainContainer{		width:660px;		margin:0 auto;		text-align:left;		height:100%;				border-left:3px double #000;		border-right:3px double #000;	}	#formContent{		padding:5px;	}	/* END CSS ONLY NEEDED IN DEMO */			/* Big box with list of options */	#ajax_listOfOptions{		position:absolute;	/* Never change this one */		width:195px;	/* Width of box */		height:100px;	/* Height of box */		overflow:auto;	/* Scrolling features */		border:1px solid #666666;	/* Dark green border */		background-color:#FFFFFF;	/* White background color */   		color: #333333;		text-align:left;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-transform: lowercase;		font-size:11px;			z-index:100;	}	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */		margin:1px;				padding:1px;		cursor:pointer;		font-family:Verdana, Arial, Helvetica, sans-serif;		font-size:11px;		}	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */			}	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */		background-color:#3d87d4;		line-height:20px;		color:#FFFFFF;	}	#ajax_listOfOptions_iframe{		background-color:#F00;		position:absolute;		z-index:5;	}	.btnclr {    background-color: #1273AB;    border: medium none;    color: #FFFFFF;    font-family: Verdana,Arial,Helvetica,sans-serif;    font-size: 12px;    font-weight: bold;    height: 30px;    width: 250px;}		 </style>
<Script Language="JavaScript" Type="text/javascript">
function HandleOnClose(filename) {
   if ((event.clientY < 0)) {
	   myWindow = window.open(filename, "tinyWindow", 'resizable width=510,height=390, scrollbars')
	   myWindow.document.bgColor=""
	   myWindow.document.close() 
   }
}
</script>
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
  
  
if(document.loan_form.Phone.value=="")
{
	alert("Please Enter Mobile Number");
	document.loan_form.Phone.focus();
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

	
	
	return true;
}

</script>
</head>
<body>
<table width="1004" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
       <td height="75" ><table width="1004" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="450" height="75" align="left" valign="top"><img src="images/ing-logo.jpg" width="450" height="75" border="0" /></td>
    <td width="387" >&nbsp;</td>
    <td width="167" height="95">&nbsp;</td>
  </tr>
</table></td>

      </tr>

 	  <tr><td height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#ff6d03;">Personal Loan Quote</td>

 	  </tr>

  <tr>

   <td>

<?php
$city = $City;
if($City=="Others")
{
	$checkCity = $City_Other;
}
else
{
	$checkCity = $City;
}
$cityList = 'Greater Noida,Faridabad,Sahibabad,Gaziabad,Gurgaon,Delhi,Pune,Mumbai,Bangalore,Chennai,Hyderabad';
$arrCity = explode(",", $cityList);
if($Employment_Status==1 && ( $Residential_Status!="RENTED_AND_STAYING_WITH_FRIENDS" && $Residential_Status!="PAYING_GUEST" && $Residential_Status!="HOSTEL" ) && (in_array($checkCity, $arrCity)))
{


		if($interestrate>0 && $getloanamout>0 && $getemicalc>0 && $term>0)
		{

		?>
		<table width="661"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#333333" >
	<tr>
	<td width="185" height="45"  align="center" bgcolor="#FFFFFF"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Maximum Loan Eligibility</b></td>

		<td width="138"  align="center"  bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">EMI</b>(Per Month)</td>
        
		<td width="138"  align="center"  bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">ROI</b></td>
		<td width="205"  align="center"  bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Tenure</b>(yrs)</td>
        <td width="205"  align="center"  bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Processing Fee</b></td>
		</tr>
	<tr>

		<td height="45" align="center" bgcolor="#FFFFFF"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;"><img src="/new-images/rupees.gif" alt="" border="0" /> <? echo $getloanamout; ?></b></td>
	    <td align="center" bgcolor="#FFFFFF"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;"><img src="/new-images/rupees.gif" alt="" border="0" /> <? echo round($getemicalc); ?></b></td>
          <td align="center" bgcolor="#FFFFFF"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;"><? echo $interestrate; ?></b></td>
			<td align="center" bgcolor="#FFFFFF"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;"><? echo $term; ?></b></td>
            			<td align="center" bgcolor="#FFFFFF"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;"><? echo $Processing_Fee; ?></b></td>
	</tr>
    <tr>
		<td height="45" align="right" bgcolor="#FFFFFF" colspan="5" style="padding-right:7px;">&nbsp;
   <?php
    if($Employment_Status==1 )
	{
    ?>
    <form action="#" method="post" name="loan_form"  onSubmit="return submitform(document.loan_form);" >
    <input type="hidden" name="Employment_Status" value="<?php echo $Employment_Status ; ?>" />
    <input type="hidden" name="Company_Name" value="<?php echo $Company_Name ; ?>" />
    <input type="hidden" name="City" value="<?php echo $City ; ?>" />
    <input type="hidden" name="City_Other" value="<?php echo $City_Other ; ?>" />
    <input type="hidden" name="Annual_Salary" value="<?php echo $Annual_Salary ; ?>" />
    <input type="hidden" name="CC_Holder" value="<?php echo $CC_Holder ; ?>" />
    <input type="hidden" name="Loan_Amount" value="<?php echo $Loan_Amount ; ?>" />
    <input type="hidden" name="DOB" value="<?php echo $DOB ; ?>" />
    <input type="hidden" name="todayDate" value="<?php echo $todayDate ; ?>" />
    <input type="hidden" name="Pincode" value="<?php echo $Pincode ; ?>" />
    <input type="hidden" name="source" value="<?php echo $source ; ?>" />
    <input type="hidden" name="From_Pro" value="<?php echo $From_Pro ; ?>" />
    <input type="hidden" name="Card_Vintage" value="<?php echo $Card_Vintage ; ?>" />
    <input type="hidden" name="Referrer" value="<?php echo $Referrer ; ?>" />
    <input type="hidden" name="Creative" value="<?php echo $Creative ; ?>" />
    <input type="hidden" name="Section" value="<?php echo $Section ; ?>" />
    <input type="hidden" name="IP" value="<?php echo $IP ; ?>" />
    <input type="hidden" name="Residential_Status" value="<?php echo $Residential_Status ; ?>" />
    <input type="hidden" name="business_running" value="<?php echo $business_running ; ?>" />
    <input type="hidden" name="loan_running" value="<?php echo $loan_running ; ?>" />

	  <input type="hidden" name="max_loan_amount" value="<?php echo $getloanamout ; ?>" />
	   <input type="hidden" name="calc_emi" value="<?php echo $getemicalc ; ?>" />
	    <input type="hidden" name="loan_tenure" value="<?php echo $term ; ?>" />

    <input name="submit1" type="button" class="btnclr" value="Apply and Share your information" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'" />
   <div id="light" class="white_content" style="text-align:right"><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" style="text-decoration:none; font-size:14px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold;">X</a>
   <table cellpadding="2" cellspacing="2" border="0" width="260">
   <tr><td colspan="2" align="center"><b style="font-size:14px; font-family:Verdana, Arial, Helvetica, sans-serif;">Fill Details</b></td></tr>
   <tr><td><b style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif;">Name</b></td><td><input type="text" name="Name" id="Name"  /></td></tr>
      <tr><td><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Mobile</b></td><td><input type="text" name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"   /></td></tr>
      <tr><td><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Email</b></td><td><input type="text" name="Email" id="Email"    /></td></tr>
         <tr><td>&nbsp;</td><td align="left"><input type="button" name="submit" id="Submit" value="Submit" style="background-color: #1273AB;    border: medium none;    color: #FFFFFF;    font-family: Verdana,Arial,Helvetica,sans-serif;    font-size: 12px;    font-weight: bold;    height: 30px;    width: 80px;"  /></td></tr>
       
   </table>
   
   </div>
		<div id="fade" class="black_overlay"></div>
      </form>
      <?php
	  }
	  ?>  
        </td>
    </tr>
    </table>
		<?
			}
		else
			{ ?>
			<table width="661"  border="0" align="center" cellpadding="0" cellspacing="1" >
	 <tr><td height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#ff6d03;">Sorry You are not eligible as per the policy.</td>
		  </tr></table>
			<? }

	

	}

else // Self Employed

{

$cityList = 
'Agra,Ahmedabad,Surat,Vadodara,Gwalior,Vidisha,Hoshangabad,Itarsi,Ambala,Shimla,Chandigarh,Mandi,Patiala,Baddi,Mohali,Trivandrum,Kochi,Thrissur,Coimbatore,Erode,Ooty,Salem,Namakkal,Udumalpet,Rishikesh,Haridwar,Jamshedpur,Siliguri,Cuttack,Bhubaneshwar,Indore,Bhopal,Ujjain,Dewas,Ratlam,Mandsour,Neemuch,Jabalpur,Katni,Satna,Rewa,Singrauli,Jaipur,Ajmer,Alwar,Jodhpur,Bikaner,Pali,Ganganagar,Sonepat,Bahadhurgarh,Kurukshetra,Hisar,Kanpur,Jhansi,Lucknow,Meerut,Agra,Madurai,Tirunelveli,Nagercoil,Tuticorin,Rajapalayam,Sivakasi,Palani,Ramanathapuram,Nagpur,Nasik,Goa,Panaji,Margao,Vasco,Mapusa,Ponda,Bathinda,Ropar,Ludhiana,Jalandhar,Jammu,Pathankot,Amritsar,Hoshiarpur,Phagwara,Raipur,Rajnandgaon,Bilaspur,Durg,Raigarh,Korba,Rajkot,Ongole,Nellore,Tirupathi,Khammam,Kurnool,Ananthpur,Chittor,Kothagudem,Trichy,Thanjavur,Dindigul,Karur,Kumbakonam,Pudukottai,Tanjore,Karaikudi,Pattukottai,Mayiladuthurai,Udaipur,Bhilwara,Beawar,Banswara,Vellore,Pondicherry,Karaikkal,Kanchipuram,Krishnagiri,Vaniyambadi,Panruti,Tiruvannamalai,Guntur,Eluru,Vijayawada,Bhimavaram,Tenali,Machilipatnam,Tanuku,Palacollu,Rajahmundry,Srikakulam,Vizianagaram,Kakinada,Vizag,Anakapalli,Pitapuram,Tuni,Warangal,Nizamabad,Karimnagar,Ramagundam,Mahaboob Nagar,Armoor,Kodad,Aurangabad,Kolhapur,Ahmednagar,Solapur,Nanded,Latur,Parbhani,Satara,Chandrapur,Ratnagiri,Sangli,Jalna,Amravati,Beed,Nandurbar,Wardha,Akot,Greater Noida,Faridabad,Sahibabad,Bangalore,Chennai,Delhi,Gaziabad,Gurgaon,Hyderabad,Kolkata,Mumbai,Navi Mumbai,Noida,Pune,Thane';



$city_List = explode(",", $cityList);

	$currentYear = date("Y");

 		$business_running_since = $currentYear - $_REQUEST['business_running'];

	if((($age>=23) && ($age<=60)) && (in_array($City, $city_List)) && ($CC_Holder==1 || $loan_running==1 )  && $Employment_Status==0 && $Annual_Salary>=150000 && $business_running_since>3 )

	{

	?>

    	<table width="661"  border="0" align="center" cellpadding="0" cellspacing="1" >

 <tr>
   <td height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#ff6d03;">Thank You for registering with us, our representative will call you shortly.</td>

 	  </tr></table>

	<?php	

	}

	else // Not Eligible

	{

	?>

    	<table width="661"  border="0" align="center" cellpadding="0" cellspacing="1" >

 <tr><td height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#ff6d03;">Sorry You are not eligible as per the policy.</td>

 	  </tr></table>

    <?php

	}



}

	

		?>







		







	







	</td>







  </tr>







</table>



<?php //include "analtyics.php"; ?>


</body>

</html>







