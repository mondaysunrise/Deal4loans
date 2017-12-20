<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
function Determine_AgeFrom_DOB ($YYYYMMDD_In){  $yIn=substr($YYYYMMDD_In, 0, 4);  $mIn=substr($YYYYMMDD_In, 4, 2);  $dIn=substr($YYYYMMDD_In, 6, 2);  $ddiff = date("d") - $dIn;  $mdiff = date("m") - $mIn;  $ydiff = date("Y") - $yIn;   if ($mdiff < 0)  {    $ydiff--;  } elseif ($mdiff==0)  {    if ($ddiff < 0)    {      $ydiff--;    }  }  return $ydiff; }


//print_r($_REQUEST);


$Name = $_POST['Name'];
$Email = $_POST['Email'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$City = $_POST['City'];
$amount_invest = $_POST['amount_invest'];
$IP = $_SERVER['REMOTE_ADDR'];
$Ibibo_compaign = $_POST['Ibibo_compaign'];

$DOB = $year."-".$month."-".$day;

$getDOB = $year."".$month."".$day;
$age = Determine_AgeFrom_DOB($getDOB);
$mobile_no = $_POST['Phone'];

$tenure = $_POST['tenure'];

function  Insert_ibibo($ProductValue, $Name, $City, $mobile_no, $DOB, $Ibibo_compaign, $Email )
	{
		$Dated = ExactServerdate();		
		$dataInsert = array("ibibo_product"=>'8' , "ibibo_requestid"=>$ProductValue , "ibibo_name"=>$Name , "ibibo_city"=>$City , "ibibo_mobile"=>$Phone, "ibibo_dob"=>$DOB , "ibibo_car_name"=>$Ibibo_compaign , "ibibo_dated"=>$Dated , "ibibo_email"=>$Email );
		$table = 'ibibo_compaign_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
	}

$todayDate = date("Y-m-d")." 23:59:59";
	$lastmonth = mktime(0, 0, 0, date("m"), date("d")-30,   date("Y"));
	$days30ago = date("Y-m-d",$lastmonth)." 00:00:00";
	
$checkDupSql = "select * from fixed_deposit where mobile_number = '".$mobile_no."' and mobile_number not in (9971396361,9871245467,9911940202,9891118553) and (dated between '".$days30ago."' and '".$todayDate."') order by requestid  desc";
list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
$myrowcontr = count($myrow)-1;
if($alreadyExist>0)
{
	$ProductValue = $myrow[$myrowcontr]["RequestID"];
	$_SESSION['LeadResuestID'] = $LeadResuestID;
	header("Location: fixed-deposit-interest-rate.php");
	exit();
	
}
else
{
	if(strlen($Name)>0 && strlen($Email)>0 && strlen($amount_invest)>0)
	{
		$Dated = ExactServerdate();		
		$dataInsert = array('name'=>$Name, 'email'=>$Email, 'dob'=>$DOB, 'mobile_number'=>$mobile_no, 'city'=>$City, 'other_city'=>'', 'investment_duration'=>$tenure, 'investment_amount'=>$amount_invest, 'dated'=>$Dated, 'updated_date'=>$Dated, 'source'=>'', 'ip'=>$IP, 'age'=>$age);
		$last_inset_id = Maininsertfunc ('fixed_deposit', $dataInsert);
		if(strlen($Ibibo_compaign)>0)
		{
			Insert_ibibo($last_inset_id, $Name, $City, $mobile_no, $DOB, $Ibibo_compaign, $Email);
		}
		$city_List = array('Amritsar','Chandigarh','Jalandhar','Ludhiana','Lucknow','Delhi','Gaziabad','Sahibabad','Noida','Faridabad','Gurgaon','Greater Noida','Ranchi','Kolkata','Ahmedabad','Surat','Jaipur','Mumbai','Navi Mumbai','Thane','Pune','Chennai','Hyderbad','Vijaywada','Bangalore');

if (in_array($City, $city_List)) {
		$SMSMessage = "FD Lead: Name-".$Name.",Age-".$age.",Mob-".$mobile_no.",City-".$City.",Term-".$tenure.",Amt-".$amount_invest." ";
		$PhoneNumber = 9818996971;//Gaurav Jain 
	//		$PhoneNumber = 9971396361;
		$nowDate = date("Y-m-d H:i:s");
		$maxDate = date("Y-m-d")." 07:50:00";
		$minDate = date("Y-m-d")." 17:10:00";
			if($nowDate>$maxDate && $nowDate<$minDate)
			{
			}	
		}
	}
}
	
$defineTenure =  '';	
if($tenure<6)
{
	$defineTenure = "7 - 180 days";
	
	if($amount_invest<1500000)
	{
		$orderBy = " 7_180bellow15";
		$valuables = " 7_180bellow15 = '".$roi."' ";
		$fields = " 7_180bellow15 as rate";
		if($age>60)
		{
			$orderBy = " 7_180bellow15sr";
			$valuables = " 7_180bellow15sr = '".$roi."'";
			$fields = " 7_180bellow15sr as rate";
		}	
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$orderBy = " 7_180bet15_50";
		$valuables = " 7_180bet15_50 = '".$roi."' ";
		$fields = " 7_180bet15_50 as rate";
		if($age>60)
		{
			$orderBy = " 7_180bet15_50sr";
			$valuables = "7_180bet15_50sr = '".$roi."' ";
			$fields = "7_180bet15_50sr as rate";
		}	
	}
	else if($amount_invest>=5000000)
	{
		$orderBy = " 7_180above50";
		$valuables = "7_180above50 = '".$roi."' ";
		$fields =  "7_180above50 as rate";
		if($age>60)
		{
			$orderBy = " 7_180above50sr";
			$valuables = " 7_180above50sr = '".$roi."'";
			$fields = " 7_180above50sr as rate";
		}	
	}
}
else if($tenure>=6 && $tenure<12)
{
	$defineTenure =  '181 - 365 days';
	
	if($amount_invest<1500000)
	{
		$orderBy = " 180_364bellow15";	
		$valuables = "180_364bellow15 = '".$roi."' ";
		$fields =  "180_364bellow15 as rate";
		if($age>60)
		{
			$valuables = "180_364bellow15sr = '".$roi."'";
			$fields = "180_364bellow15sr as rate";
			$orderBy = " 180_364bellow15sr";	
		}	
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$orderBy = " 180_364bet15_50";	
		$valuables = "180_364bet15_50 = '".$roi."'";
		$fields = "180_364bet15_50 as rate"; 
		if($age>60)
		{
			$orderBy = " 180_364bet15_50sr";
			$valuables = " 180_364bet15_50sr = '".$roi."'";
			$fields = "180_364bet15_50sr  as rate";
		}	
	}
	else if($amount_invest>=5000000)
	{
		$orderBy = " 180_364above50";
		$valuables = "180_364above50 = '".$roi."' ";
		$fields = "180_364above50 as rate"; 
		if($age>60)
		{
			$orderBy = " 180_364above50sr";
			$valuables = "180_364above50sr = '".$roi."'";
			$fields = "180_364above50sr as rate";
		}	
	}
}
else if($tenure>=12 && $tenure<24)
{
	$defineTenure =  '1 to 2 yrs';
	if($amount_invest<1500000)
	{
		$orderBy = " 1_2yrbellow15";
		$valuables = "1_2yrbellow15 = '".$roi."'";
		$fields = "1_2yrbellow15 as rate";
		if($age>60)
		{
			$orderBy = " 1_2yrbellow15sr";
			$valuables = " 1_2yrbellow15sr = '".$roi."' ";
			$fields = "1_2yrbellow15sr as rate";
		}
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$orderBy = " 1_2yrbet15_50";
		$valuables = "1_2yrbet15_50 = '".$roi."'";
		$fields = "1_2yrbet15_50 as rate";
		if($age>60)
		{
			$orderBy = " 1_2yrbet15_50sr";
			$valuables = " 1_2yrbet15_50sr = '".$roi."'";
			$fields = "1_2yrbet15_50sr as rate";
		}
	}
	else if($amount_invest>=5000000)
	{
		$orderBy = " 1_2yrabove50";
		$valuables = "1_2yrabove50 = '".$roi."'";
		$fields = "1_2yrabove50 as rate";
		if($age>60)
		{
			$orderBy = " 1_2yrabove50sr";
			$valuables = "1_2yrabove50sr = '".$roi."'";
			$fields = "1_2yrabove50sr as rate";
		}	
	}
}
else if($tenure>=24 && $tenure<36)
{
	$defineTenure =  '2 to 3 yrs';	
	if($amount_invest<1500000)
	{
		$orderBy = " 2_3yrbellow15";
		$valuables = "2_3yrbellow15 = '".$roi."'";
		$fields = "2_3yrbellow15 as rate";
		if($age>60)
		{
			$orderBy = " 2_3yrbellow15sr";
			$valuables = " 2_3yrbellow15sr = '".$roi."'";
			$fields = "2_3yrbellow15sr as rate";
		}
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$orderBy = " 2_3yrbet15_50";
		$valuables = "2_3yrbet15_50 = '".$roi."' ";
		$fields = "2_3yrbet15_50 as rate ";
		if($age>60)
		{
			$orderBy = " 2_3yrbet15_50sr";
			$valuables = " 2_3yrbet15_50sr = '".$roi."'";
			$fields = "2_3yrbet15_50sr as rate";
		}	
	}
	else if($amount_invest>=5000000)
	{
		$orderBy = " 2_3yrabove50";
		$valuables = "2_3yrabove50 = '".$roi."' ";
		$fields = "2_3yrabove50 as rate";
		if($age>60)
		{
			$orderBy = " 2_3yrabove50sr";
			$valuables = " 2_3yrabove50sr = '".$roi."'";
			$fields = "2_3yrabove50sr as rate";
		}	
	}
}
else if($tenure>=36 && $tenure<48)
{
	$defineTenure =  '3 to 4 yrs';
	if($amount_invest<1500000)
	{
		$orderBy = " 3_4yrbellow15";
		$valuables = "3_4yrbellow15 = '".$roi."' ";
		$fields = "3_4yrbellow15 as rate";
		if($age>60)
		{
			$orderBy = " 3_4yrbellow15sr";
			$valuables = "3_4yrbellow15sr = '".$roi."'";
			$fields = "3_4yrbellow15sr as rate";
		}
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$orderBy = " 3_4yrbet15_50";
		$valuables = "3_4yrbet15_50 = '".$roi."'";
		$fields = "3_4yrbet15_50 as rate";
		if($age>60)
		{
			$orderBy = " 3_4yrbet15_50sr";
			$valuables = " 3_4yrbet15_50sr = '".$roi."'";
			$fields = "3_4yrbet15_50sr as rate";
		}	
	}
	else if($amount_invest>=5000000)
	{
		$orderBy = " 3_4yrabove50";
		$valuables = "3_4yrabove50 = '".$roi."'";
		$fields = "3_4yrabove50 as rate";
		if($age>60)
		{
			$orderBy = " 3_4yrabove50sr";
			$valuables = " 3_4yrabove50sr = '".$roi."'";
			$fields = "3_4yrabove50sr as rate";
		}
	}
}
else if($tenure>=48 && $tenure<60)
{
	$defineTenure =  '4 to 5 yrs';
	if($amount_invest<1500000)
	{
		$orderBy = " 4_5yrbellow15";
		$valuables = "4_5yrbellow15 = '".$roi."' ";
		$fields = "4_5yrbellow15 as rate";
		if($age>60)
		{
			$orderBy = " 4_5yrbellow15sr";
			$valuables = " 4_5yrbellow15sr = '".$roi."'";
			$fields = "4_5yrbellow15sr as rate";
		}
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$orderBy = " 4_5yrbet15_50";
		$valuables = "4_5yrbet15_50 = '".$roi."'";
		$fields = "4_5yrbet15_50 as rate"; 
		if($age>60)
		{
			$orderBy = " 4_5yrbet15_50sr";
			$valuables = " 4_5yrbet15_50sr = '".$roi."'";
			$fields = " 4_5yrbet15_50sr as rate";
		}
	}
	else if($amount_invest>=5000000)
	{
		$orderBy = " 4_5yrabove50";
		$valuables = "4_5yrabove50 = '".$roi."'";
		$fields = "4_5yrabove50 as rate";
		if($age>60)
		{
			$orderBy = " 4_5yrabove50sr";
			$valuables = " 4_5yrabove50sr = '".$roi."'";
			$fields = "4_5yrabove50sr as rate";
		}
	}
}
else if($tenure>=60)
{
	$defineTenure =  '5 to 10 yrs';
	if($amount_invest<1500000)
	{
		$orderBy = " 5_10yrbellow15";
		$valuables = "5_10yrbellow15 = '".$roi."'";
		$fields = "5_10yrbellow15 as rate"; 
		if($age>60)
		{
			$orderBy = " 5_10yrbellow15sr";
			$valuables = " 5_10yrbellow15sr = '".$roi."'";
			$fields = "5_10yrbellow15sr as rate";
		}
	}
	else if($amount_invest>=1500000 && $amount_invest<5000000)
	{
		$orderBy = " 5_10yrbet15_50";
		$valuables = "5_10yrbet15_50 = '".$roi."'";
		$fields = "5_10yrbet15_50 as rate";
		if($age>60)
		{
			$orderBy = " 5_10yrbet15_50sr";
			$valuables = "5_10yrbet15_50sr = '".$roi."'";
			$fields = "5_10yrbet15_50sr as rate";
		}
	}
	else if($amount_invest>=5000000)
	{
		$orderBy = " 5_10yrabove50";
		$valuables = "5_10yrabove50 = '".$roi."' ";
		$fields = "5_10yrabove50 as rate";
		if($age>60)
		{
			$orderBy = " 5_10yrabove50sr";
			$valuables = "5_10yrabove50sr = '".$roi."'";
			$fields = "5_10yrabove50sr as rate";
		}
		
	}
}

//echo $sql = "select ".$fields.",fd_bankID from fd_interestrates where ".$valuables." and status=1"; 
  $sql = "select ".$fields.",fd_bankID from fd_interestrates where status=1 and ".$orderBy."!=0  order by ".$orderBy." desc"; 
  list($num,$query)=MainselectfuncNew($sql,$array = array());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Fixed Deposit Rates – Compare Fixed Deposit Interest Rates of Various Banks | Deal4Loans India</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="keywords" content="Fixed Deposit, fixed deposit rates, fixed term deposit, term deposit rates, fd rates, fixed deposit interest rates, fixed deposit interest rate, interest rates of fixed deposits, fd interest rates">
<meta name="description" content="Fixed Deposit Rates: Choose Best fixed deposit interest rates. Best returns on Deposits with Highest Interest Rates. Compare various Banks Fixed Deposit rate.">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="css/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<script Language="JavaScript" Type="text/javascript">
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

</script>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="ICICI_CL/base/jquery.ui.all.css">
	<script src="scripts/common.js"></script>
	<script src="ICICI_CL/jquery-1.4.4.js"></script>
	<script src="ICICI_CL/jquery.ui.core.js"></script>
	<script src="ICICI_CL/jquery.ui.widget.js"></script>
	<script src="ICICI_CL/jquery.ui.mouse.js"></script>
	<script src="ICICI_CL/jquery.ui.slider.js"></script>
    <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
	<Script Language="JavaScript">
function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}

var ajaxRequestMain;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
				try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequestMain = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
	
function newcomplete_div()
{
	var get_roi = document.getElementById('get_roi').value;
	var get_tenure = document.getElementById('amount1').value;
	var get_amount_invest = document.getElementById('amount_invest').value;		
	var get_day = document.getElementById('day').value;		
	var get_month = document.getElementById('month').value;		
	var get_year = document.getElementById('year').value;			
			
	var queryString = "?get_roi=" + get_roi +"&get_tenure=" + get_tenure +"&get_amount_invest=" + get_amount_invest +"&get_day=" + get_day +"&get_month=" + get_month  +"&get_year=" + get_year ;
	//alert(queryString);
			
  $('#complete_div').html('<p style="position:absolute; z-index:100; left:550px; top:130px;"><img src="new-images/new-ajax-loader.gif" /></p>');
  $('#complete_div').load("get_slider_info.php" + queryString);
}

window.onload = ajaxFunctionMain;
	
</script>
	<script>
	$(function() {
		$( "#slider-range-min" ).slider({
			range: "min",
			value: 5.5,
			min: 5.5,
			step: .25,
			max:  11,
			slide: function( event, ui ) {
				$( "#get_roi" ).val( "" + ui.value + "" );
			}
		});
		$( "#get_roi" ).val( "" + $( "#slider-range-min" ).slider( "value" ) );
	});
	</script>

	<script>
	$(function() {
		$( "#slider-range-min1" ).slider({
			range: "min",
			value: <?php echo $tenure; ?>,
			step: 1,
			min: 0,
			max: 120,
			slide: function( event, ui ) {
				$( "#amount1" ).val( "" + ui.value );
			}
		});
		$( "#amount1" ).val( "" + $( "#slider-range-min1" ) .slider( "value" ) );
	});

	</script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
 
<div id="container"  >  
  <span><a href="index.php">Home</a> > Fixed Deposit Interest Rate</span>
  <div style="padding-top:15px; ">
  
<font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong>
          <?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?>
          </strong></font>
            <form name="eduloan_form"  action="#" method="POST" onSubmit="return chkeducaionloan(document.eduloan_form);"> 
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5">
	 <tr>
        <td style=" padding:12px;"><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;"> Fixed Deposit </h1></td>
  </tr>
</table></td>
 </tr>
     <tr>
     <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0"  id="frm">
          <tr>
            <td colspan="2" align="center">
            
<input type="hidden" name="source" value="<? echo $source; ?>"> 
<input type="hidden" name="day" id="day" value="<? echo $day; ?>"> 
<input type="hidden" name="month" id="month" value="<? echo $month; ?>"> 
<input type="hidden" name="year" id="year" value="<? echo $year; ?>"> 
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"></td>
	      </tr>
          <tr>
            <td colspan="2" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
               <tr>
                 <td valign="top"><table width="98%"  border="0" cellspacing="0" cellpadding="0">
                   <tr valign="middle">
                     <td width="8%" height="28" class="frmbldtxt" style="padding-top:3px; "> Name :</td>
                     <td width="30%" height="28" class="frmbldtxt"  style="padding-top:3px; "><?php echo $Name; ?></td>
                     <td width="15%" height="28" class="frmbldtxt" style="padding-top:3px; ">Email  :</td>
                     <td width="25%" height="28" class="frmbldtxt"  style="padding-top:3px; "><?php echo $Email; ?></td>
                     <td width="4%" height="28" class="frmbldtxt" style="padding-top:3px; ">Dob  :</td>
                     <td width="18%" height="28" class="frmbldtxt"  style="padding-top:3px; "><?php echo $day."-".$month."-".$year;
 ?>
                     
                     </td>
                   </tr>
                   <tr valign="middle">
                    <td width="8%" height="28" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                     <td width="30%" height="28" class="frmbldtxt"  style="padding-top:3px; "><?php echo $City; ?></td>
                     <td height="28" class="frmbldtxt">Amount to Invest :</td>
                     <td height="28" class="frmbldtxt"><input type="text" name="amount_invest" id="amount_invest" onChange="intOnly(this);"  onkeyup="intOnly(this); getDigitToWords('amount_invest','formatedIncome','wordIncome');" onKeyPress="intOnly(this);" value="<?php echo $amount_invest; ?>"  onblur="getDigitToWords('amount_invest','formatedIncome','wordIncome');" maxlength="10"  tabindex="7" /></td>
                     <td height="28" colspan="2" align="left" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px; color:666699; '></span><span id='wordIncome' style='font-size:11px; color:666699; capitalize;'></span></td>
                     </tr>
                   <tr >
                     <td  colspan="3" class="frmbldtxt" align="left">
                     <table cellpadding="3" cellspacing="3" border="0" width="95%">
                     <tr><td align="left"  height="28" class="frmbldtxt" >Rate of Interest:</td><td align="right"><input type="text" id="get_roi" style="border:0px; width:65px; text-align:right;" readonly class="verdred13" /> %</td></tr>
                       <tr><td colspan="2"  height="32"><div id="slider-range-min" onClick="newcomplete_div();" onChange="newcomplete_div();" onMouseUp="newcomplete_div();"></div></td></tr>
                         <tr><td class="verdblk9" ><b>Min:</b> 5.5%</td><td style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b " align="right"><b>Max:</b> 11%</td></tr>
                     
                     </table>
                     </td>
                     <td  colspan="3" class="frmbldtxt" align="right">
                       <table cellpadding="3" cellspacing="3" border="0" width="100%">
                     <tr><td align="left"  height="28" class="frmbldtxt" >Tenure:</td><td align="right"><input type="text" id="amount1" style="border:0;width:65px; text-align:right;" class="verdred13" readonly /> months</td></tr>
                       <tr><td colspan="2"  height="32"><div id="slider-range-min1" onClick="newcomplete_div();" onChange="newcomplete_div();" onMouseUp="newcomplete_div();"></div></td></tr>
                         <tr><td class="verdblk9"  height="28"><b>Min:</b> 0 Months</td><td style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b " align="right"><b>Max:</b> 120 Months</td></tr>
                     
                     </table>
                     
                     
                     </td>
                 </tr>
                 
                 
                 </table></td>
                 
               </tr>
             </table></td>
          </tr>
             <tr>
            <td class="frmbldtxt" colspan="6" align="left">
         
            <table border="0" align="center" cellpadding="0" cellspacing="0">
        <tr><td valign="top" width="620" >  
         <div style=" float:left;" id="complete_div"> 
      <?php
     if($num>0)
	 { 
          
       ?> 
		 <table width="97%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
	  <tr>
         <td width="430" height="25" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt" style="font-size:12px;" >Company Name</td>
        <td width="162" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt"  style="font-size:12px;">ROI</td>
        <td width="141" align="center" valign="middle" bgcolor="#494949" class="tblwt_txt"  style="font-size:12px;">Tenure</td>
      </tr> 

  <tr><td colspan="5" width="100%" align="center">
  <table cellpadding="3" cellspacing="3"  width="100%">
    <?php
	for($i=0;$i<$num;$i++)
	{
		$fd_bankID = $query[$i]['fd_bankID'];
		$rate = $query[$i]['rate'];

		$bankNameSql = "select * from fd_interestrate_bank where fd_bankID='".$fd_bankID."'";
		  list($numRows,$bankNameQuery)=MainselectfuncNew($bankNameSql,$array = array());

		$bankName = $bankNameQuery[0]['fd_bank'];
		$banklogo = $bankNameQuery[0]['logo'];
		
	?> 
     <tr>
      <td width="430" height="30" align="left" bgcolor="#ffffff" class="tbl_txt" style="font-weight:bold; font-size:13px; color:#02358a; width:430px; ">
	 <img src='<?php echo $banklogo; ?>' border='0'><br />
    <?php echo $bankName; ?>	  </td>
      <td width="162" height="30" align="left" bgcolor="#ffffff" class="tbl_txt" style="font-weight:bold; font-size:13px; color:#02358a; width:162px;"><span class="verdred12" style="padding:2px;"><?php echo $rate; ?> % </span></td>
      <td width="141" height="30" align="center" bgcolor="#ffffff" class="tbl_txt" style="text-align:center; font-weight:bold; font-size:13px; color:#02358a;  width:141px;"><span class="verdred12" style="padding:2px;"><?php echo $defineTenure; ?></span></td>
    </tr>
   <?php
   }
   ?>             
	</table></td></tr>

    </table>
    <?php
	}
	else
	{
	
	}
	
	?>
   </div> 
 </td><td valign="top" width="300"><script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 300x250, created 3/8/11 */
google_ad_slot = "4370078512";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<br /><br />
<script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 300x250, created 3/8/11 */
google_ad_slot = "4370078512";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</td></tr></table>
            
  <?php
//view table grid

?></td>
            </tr> 
	   
          <tr>
            <td>&nbsp;</td>
          </tr>
            </table></td>
      </tr>
	    <tr>
	      <td >&nbsp;</td>
        </tr>
    </table>
	</form><br />
  
   </div>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?> <? } ?>
</div></body>
</html>

