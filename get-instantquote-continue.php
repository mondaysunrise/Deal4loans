<?php
	ob_start();
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//	require 'pl_fullerton.php';
	require 'scripts/personal_loan_eligibility_function.php';
	function filter_blank($var) 
	{
		return !(empty($var) || is_null($var));
	}
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
body{	margin:0px;	padding:0px;	color:#2e2e2e;}input{	margin:0px;	padding:0px;	border:1px solid #878787;}select{	margin:0px;	padding:0px;	border:1px solid #878787;}form{margin:0px;padding:0px;}.hdr{	background-image:url(images/hdr.gif);	background-repeat:no-repeat;	height:75px;}.hdng-bg{	background-image:url(images/top-bg.jpg);	background-repeat:no-repeat;	height:36px;	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891; 	text-indent:15px;}.yelobrder{	border-left:1px solid #fde37a;	border-right:1px solid #fde37a;}#txt{	font-family:Arial, Helvetica, sans-serif;	font-size:13px;	font-weight:bold; 	padding-left:25px;	line-height:21px;	padding-top:8px;}.yelobrder ul{	margin:5px 0px 0px 10px;	padding:5px 0px 0px 10px;}.yelobrder ul li{	background-image:url(images/arow.jpg) ;	background-repeat:no-repeat;	list-style-type:none; 	padding-left:18px; 	padding-right:0; 	padding-top:0; 	padding-bottom:4px;	font-family:Arial, Helvetica, sans-serif;	line-height:18px;	font-size:13px;	font-weight:bold; }.imgpostn{	padding-left:31px;	padding-top:10px;} .btmboxbg{	background-image:url(images/btm-box.jpg);	width:273px;	height:131px;	background-repeat:no-repeat;	background-position:center;}.redtxt{	font-family:Arial, Helvetica, sans-serif;	font-size:13px;	font-weight:bold;	color:#8b321b;}.blktxt{	font-family:Arial, Helvetica, sans-serif;	font-size:12px;	text-align:left;	line-height:17px;	padding-top:8px;}.frmhdng{	font-family:Arial, Helvetica, sans-serif;	font-size:17px;	font-weight:bold;	color:#802891;}.nrmltxt{	font-family:Arial, Helvetica, sans-serif;	font-size:12px;	text-align:left;	line-height:17px;}.frmbg{ 	border-left:1px solid #c2c2c2;	border-bottom:1px solid #c2c2c2;}.frmtxt{	font-family:Arial, Helvetica, sans-serif;	font-size:13px;	font-weight:bold;	color:#332d33;}.frmrgtbrdr{	border-bottom:22px solid #802891;	background-color:#fecb09;}/* START CSS NEEDED ONLY IN DEMO */		#mainContainer{		width:660px;		margin:0 auto;		text-align:left;		height:100%;				border-left:3px double #000;		border-right:3px double #000;	}	#formContent{		padding:5px;	}	/* END CSS ONLY NEEDED IN DEMO */			/* Big box with list of options */	#ajax_listOfOptions{		position:absolute;	/* Never change this one */		width:195px;	/* Width of box */		height:100px;	/* Height of box */		overflow:auto;	/* Scrolling features */		border:1px solid #666666;	/* Dark green border */		background-color:#FFFFFF;	/* White background color */   		color: #333333;		text-align:left;		font-family:Verdana, Arial, Helvetica, sans-serif;		text-transform: lowercase;		font-size:11px;			z-index:100;	}	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */		margin:1px;				padding:1px;		cursor:pointer;		font-family:Verdana, Arial, Helvetica, sans-serif;		font-size:11px;		}	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */			}	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */		background-color:#3d87d4;		line-height:20px;		color:#FFFFFF;	}	#ajax_listOfOptions_iframe{		background-color:#F00;		position:absolute;		z-index:5;	}	.btnclr {    background-color: #1273AB;    border: medium none;    color: #FFFFFF;    font-family: Verdana,Arial,Helvetica,sans-serif;    font-size: 12px;    font-weight: bold;    height: 30px;    width: 250px;}		 </style>
<style>		.black_overlay{			display: none;			position: absolute;			top: 0%;			left: 0%;			width: 100%;			height: 100%;			background-color: black;			z-index:1001;			-moz-opacity: 0.8;			opacity:.50;			filter: alpha(opacity=50);		}
		.white_content {			display: none;			position: absolute;			top: 25%;			left: 25%;			width: 260;			height: 250;			padding: 6px;			border: 2px solid black;			background-color: white;			z-index:1002;			overflow: auto;		}
	</style>
</head>
<body>
<table width="1004" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
       <td height="75" ><table width="1004" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="450" height="75" align="left" valign="top"><a href="http://www.fullertonindia.com/" target="_blank"><img src="images/lft-fullrtonlogo.gif" width="450" height="75" border="0" /></a></td>

              <td width="387"><img src="images/hdr-bg.gif" width="387" height="75" /></td>

              <td width="167" height="75"><a href="http://www.deal4loans.com/" target="_blank"><img src="images/rgt-d4logo.gif" width="167" border="0" height="75" /></a></td>

            </tr>

        </table></td>

      </tr>

 	  <tr><td height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#802891;">Personal Loan Quote</td>

 	  </tr>
 	 <?php
$city = $City;
$leadid = 550114;

 $sqlResdenCheck = "select * from Req_Loan_Personal Where RequestID=".$leadid."";
list($alreadyExist,$queryResdenCheck)=MainselectfuncNew($sqlResdenCheck,$array = array());
$myrowcontr = count($queryResdenCheck)-1;
$Employment_Status= $queryResdenCheck[0]['Employment_Status'];
$DOB =  $queryResdenCheck[0]['DOB'];
$strDOB = str_replace("-","",$DOB);
$age = DetermineAgeGETDOB($strDOB);
$Residential_Status =  $queryResdenCheck[0]['Residential_Status'];
$monthsalary =  ($queryResdenCheck[0]['Net_Salary']) / 12 ;
$PL_EMI_Amt =  $queryResdenCheck[0]['get-instantquote'];
$getCompany_Name =  $queryResdenCheck[0]['Company_Name'];
$Name =  $queryResdenCheck[0]['Name'];
$getcompany='select fullerton,citibank from pl_company_list where company_name="'.$getCompany_Name.'"';
list($recordcount,$grow)=MainselectfuncNew($getcompany,$array = array());
$fullertoncategory= $grow[0]["fullerton"];

$city = $City;
$leadid = 550114;
?>
     
      <tr><td style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; ">Dear <?php echo $Name; ?>,</td>

 	  </tr>
  <tr>

   <td>

<?php
if($Employment_Status==1)
{
//echo "1";
		list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm)=fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);

$aa  =fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$age,$City);
//print_r($aa);

		if($fullertongetloanamout>0 && $fullertongetemicalc>0 && $fullertonterm>0)
		{
		?>
		<table width="661"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#333333" >
	<tr>
	<td width="185" height="45"  align="center" bgcolor="#FFFFFF"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Maximum Loan Eligibility</b></td>
	<?php
	if(($city=="Delhi" || $city=="Mumbai" || $city=="Hyderabad" || $city=="Bangalore" || $city=="Pune" || $city=="Chennai"))

	{?>
	<?php } ?>
		<td width="138"  align="center"  bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">EMI</b>(Per Month)</td>
		<td width="205"  align="center"  bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif;"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Tenure</b>(yrs)</td>
		</tr>
	<tr>
		<td height="45" align="center" bgcolor="#FFFFFF"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;"><? echo $fullertongetloanamout; ?></b></td>
	    <td align="center" bgcolor="#FFFFFF"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;"><? echo $fullertongetemicalc; ?></b></td>
			<td align="center" bgcolor="#FFFFFF"><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;"><? echo $fullertonterm; ?></b></td>
	</tr>
    <tr>
		<td height="45" align="right" bgcolor="#FFFFFF" colspan="3" style="padding-right:7px;">
   <?php
    if($Employment_Status==1 )
	{
    ?>
    <form action="get-instantquote-submit.php" method="post" name="loan_form"  onSubmit="return submitform(document.loan_form);">
    <input type="hidden" name="pl_requestid" value="<?php echo $leadid ; ?>" />
     <input type="hidden" name="RequestID" value="<?php echo $leadid ; ?>" />
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

	  <input type="hidden" name="max_loan_amount" value="<?php echo $fullertongetloanamout ; ?>" />
	   <input type="hidden" name="calc_emi" value="<?php echo $fullertongetemicalc ; ?>" />
	    <input type="hidden" name="loan_tenure" value="<?php echo $fullertonterm ; ?>" />

    <input name="submit1" type="submit" class="btnclr" value="Apply and Share your information" >
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
	 <tr><td height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#802891;">Sorry You are not eligible as per the policy.</td>
		  </tr></table>
			<? }

	

	}

else // Self Employed

{

$cityList = 

'Agra,Ahmedabad,Surat,Vadodara,Gwalior,Vidisha,Hoshangabad,Itarsi,Ambala,Shimla,Chandigarh,Mandi,Patiala,Baddi,Mohali,Trivandrum,Kochi,Thrissur,Coimbatore,Erode,Ooty,Salem,Namakkal,Udumalpet,Rishikesh,Haridwar,Jamshedpur,Siliguri,Cuttack,Bhubaneshwar,Indore,Bhopal,Ujjain,Dewas,Ratlam,Mandsour,Neemuch,Jabalpur,Katni,Satna,Rewa,Singrauli,Jaipur,Ajmer,Alwar,Jodhpur,Bikaner,Pali,Ganganagar,Sonepat,Bahadhurgarh,Kurukshetra,Hisar,Kanpur,Jhansi,Lucknow,Meerut,Agra,Madurai,Tirunelveli,Nagercoil,Tuticorin,Rajapalayam,Sivakasi,Palani,Ramanathapuram,Nagpur,Nasik,Goa,Panaji,Margao,Vasco,Mapusa,Ponda,Bathinda,Ropar,Ludhiana,Jalandhar,Jammu,Pathankot,Amritsar,Hoshiarpur,Phagwara,Raipur,Rajnandgaon,Bilaspur,Durg,Raigarh,Korba,Rajkot,Ongole,Nellore,Tirupathi,Khammam,Kurnool,Ananthpur,Chittor,Kothagudem,Trichy,Thanjavur,Dindigul,Karur,Kumbakonam,Pudukottai,Tanjore,Karaikudi,Pattukottai,Mayiladuthurai,Udaipur,Bhilwara,Beawar,Banswara,Vellore,Pondicherry,Karaikkal,Kanchipuram,Krishnagiri,Vaniyambadi,Panruti,Tiruvannamalai,Guntur,Eluru,Vijayawada,Bhimavaram,Tenali,Machilipatnam,Tanuku,Palacollu,Rajahmundry,Srikakulam,Vizianagaram,Kakinada,Vizag,Anakapalli,Pitapuram,Tuni,Warangal,Nizamabad,Karimnagar,Ramagundam,Mahaboob Nagar,Armoor,Kodad,Aurangabad,Kolhapur,Ahmednagar,Solapur,Nanded,Latur,Parbhani,Satara,Chandrapur,Ratnagiri,Sangli,Jalna,Amravati,Beed,Nandurbar,Wardha,Akot,Greater Noida,Faridabad,Sahibabad,Bangalore,Chennai,Delhi,Gaziabad,Gurgaon,Hyderabad,Kolkata,Mumbai,Navi Mumbai,Noida,Pune,Thane';



$city_List = explode(",", $cityList);

/*

if(in_array($City, $city_List))

{

	echo "True<br>";

}

echo $age;

echo "<br>";

echo $Residential_Status;

echo "<br>";

echo $_REQUEST['business_running'];

echo "<br>";

echo $CC_Holder;

echo "<br>";

echo $Annual_Salary;

echo "<br>";

*/		$currentYear = date("Y");

 		$business_running_since = $currentYear - $_REQUEST['business_running'];

	if((($age>=23) && ($age<=60)) && (in_array($City, $city_List)) && ($CC_Holder==1 || $loan_running==1 )  && $Employment_Status==0 && $Annual_Salary>=150000 && $business_running_since>3 )

	{
		$DataArray = array("eligible"=>'1', "allocated_sms"=>'2');
		$wherecondition ="(RequestID='".$leadid."')";
		Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);

	?>

    	<table width="661"  border="0" align="center" cellpadding="0" cellspacing="1" >

 <tr><td height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#802891;">Thank You for registering with fullertonindialoans.com, our representative will call you shortly.</td>

 	  </tr></table>

	<?php	

	}

	else // Not Eligible

	{

	?>

    	<table width="661"  border="0" align="center" cellpadding="0" cellspacing="1" >

 <tr><td height="70" align="center" style="color:#000099; font-family: Arial, Helvetica, sans-serif; font-size:17px; font-weight:bold; color:#802891;">Sorry You are not eligible as per the policy.</td>

 	  </tr></table>

    <?php

	}



}

	

		?>







		







	







	</td>







  </tr>







</table>



<?php include "analtyics.php"; ?>


</body>

</html>







