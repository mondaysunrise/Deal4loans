<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functionshttps.php';
	require 'getlistofeligiblebidders.php';
	require 'scripts/personal_loan_eligibility_function_form.php';
	
	function getProductCode($pKey){
	$titles = array(
		'Req_Loan_Personal' => '1',
		'Req_Loan_Home' => '2',
		'Req_Loan_Car' => '3',
		'Req_Credit_Card' => '4',
		'Req_Loan_Against_Property' => '5',
		'Req_Business_Loan' => '6',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	
function DetermineAgeGETDOB ($YYYYMMDD_In)
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

	
$getCompany_Name = $Company_Name;
		list($year,$month,$day) = split('[-]', $DOB);

$currentyear=date('Y');
$age=$currentyear-$year;

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		    $leadid = $_REQUEST['leadid'];
			
			$_SESSION['leadid'] = $leadid;
			
			$PL_EMI_Amt = $_REQUEST['PL_EMI_Amt'];
			$professional_details = $_REQUEST['professional_details'];
			$Company_Type = $_REQUEST['Company_Type'];
			$Residential_Status = $_REQUEST['Residential_Status'];
			$Primary_Acc= $_REQUEST['Primary_Acc'];
			$Loan_Any = $_REQUEST['Loan_Any'];
			$EMI_Paid = $_REQUEST['EMI_Paid'];
			$Credit_Limit = $_REQUEST['Credit_Limit'];
			$Total_Experience = $_REQUEST['Total_Experience'];
			$Years_In_Company = $_REQUEST['Years_In_Company'];
			$Document_proof=$_REQUEST['Document_proof'];
			$Document_proof_doc=implode(",",$Document_proof);
			$ABMMU_flag = $_REQUEST["adty_brl"];
			
	
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
		
	$getpldetails="select City_Other,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')";
	//echo "select Other_City,City,Company_Name,Name,Net_Salary,DOB From Req_Loan_Personal Where (RequestID='".$leadid."')";
	list($alreadyExist,$plrow)=MainselectfuncNew($getpldetails,$array = array());
	$myrowcontr=count($plrow)-1;
$getCompany_Name = $plrow[$myrowcontr]['Company_Name'];
$City = $plrow[$myrowcontr]['City'];
$Name = $plrow[$myrowcontr]['Name'];
$DOB = $plrow[$myrowcontr]['DOB'];
$Net_Salary = $plrow[$myrowcontr]['Net_Salary'];
$Other_City = $plrow[$myrowcontr]['City_Other'];	

$getDOB = str_replace("-","", $DOB);
$age = DetermineAgeGETDOB($getDOB);
//echo $age."<br>";
$agecalc="50";
$exactage = $agecalc- $age;

$monthsalary =$Net_Salary/12;
	
				
			$crap = $City_Other." ".$Primary_Acc." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{
			
if($leadid>0)
{														
		$dataUpdate = array('CC_Age'=>$professional_details, 'ABMMU_flag'=>$ABMMU_flag, 'Company_Type'=>$Company_Type, 'PL_EMI_Amt'=>$PL_EMI_Amt, 'Primary_Acc'=>$Primary_Acc, 'Residential_Status'=>$Residential_Status, 'Card_Limit'=>$Credit_Limit, 'Years_In_Company'=>$Years_In_Company, 'Total_Experience'=>$Total_Experience, 'EMI_Paid'=>$EMI_Paid, 'Loan_Any'=>$Loan_A, 'identification_proof'=>$Document_proof_doc);
		$wherecondition = "(RequestID=".$leadid.")";
		Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
		
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
		
	}//$_POST
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<link href="http://www.deal4loans.com/css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
<title>Personal Loan Processing</title>
</head>
<body style="margin:0px; padding:0px;">
<div class="lac-main-wrapper">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="100%" align="center" valign="middle" style="background:url(/images/logos/bg1.gif) repeat;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="80" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="20%" height="80" align="center" valign="middle"><img src="/new-images/d4l-logo.gif" /></td>
            <td width="80%" height="80" align="right" valign="bottom" style="padding-right:15px; font-family:'trebuchet MS'; font-size:16px; font-weight:bold; color:#000000;">Personal Loan Request</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="100%" height="470" align="center" style="font-family:verdana; font-size:14px; color:#0099FF; ">
        <table cellpadding="2" cellspacing="2" border="0">
        <tr><td align="center" style="padding-top:3px;">
             <img src="/images/progress-bar.gif" width="220" height="19" /><br />
          Search in Progress<br /><br /><br />
           Thanks for applying on deal4loans.com. Your Loan Request is being scanned with the following Banks.
          </td></tr>
          <tr>
        <td width="100%" height="80" align="center" valign="middle">
        <div class="loans_Silder">
		<script language="JavaScript1.2">
var marqueewidth="950px"
//Specify the marquee's height
var marqueeheight="80px"
//Specify the marquee's marquee speed (larger is faster 1-10)
var marqueespeed=8
//configure background color:
var marqueebgcolor="#ffffff"
//Pause marquee onMousever (0=no. 1=yes)?
var pauseit=1
var marqueecontent='<nobr><img src="/new-images/slider/thumb/hdfc_pllogo.jpg" />&nbsp;&nbsp;<img src="/new-images/thumb/hdb-logo.jpg" />&nbsp;&nbsp;<img src="/new-images/thumb/fullrton.jpg" />&nbsp;&nbsp;<img src="/new-images/citibank-logo-d4l.jpg" />&nbsp;&nbsp;<img src="/new-images/thumb/bajaj-finserv1.jpg" />&nbsp;&nbsp;<img src="/new-images/thumb/stndc.jpg" />&nbsp;&nbsp;<img src="/new-images/thumb/ing-vysya-lg.jpg" />&nbsp;&nbsp;<img src="/new-images/thumb/icici.jpg" />&nbsp;&nbsp;<img src="/new-images/thumb/kotak-pl.jpg" />&nbsp;&nbsp;<img src="/new-images/thumb/indusind.jpg" /></nobr>'
////NO NEED TO EDIT BELOW THIS LINE////////////
marqueespeed=(document.all)? marqueespeed : Math.max(1, marqueespeed-1) //slow speed down by 1 for NS
var copyspeed=marqueespeed
var pausespeed=(pauseit==0)? copyspeed: 0
var iedom=document.all||document.getElementById
if (iedom)
document.write('<span id="temp" style="visibility:hidden;position:absolute;top:-100px;left:-9000px">'+marqueecontent+'</span>')
var actualwidth=''
var cross_marquee, ns_marquee

function populate(){
if (iedom){
cross_marquee=document.getElementById? document.getElementById("iemarquee") : document.all.iemarquee
cross_marquee.style.left=parseInt(marqueewidth)+8+"px"
cross_marquee.innerHTML=marqueecontent
actualwidth=document.all? temp.offsetWidth : document.getElementById("temp").offsetWidth
}
else if (document.layers){
ns_marquee=document.ns_marquee.document.ns_marquee2
ns_marquee.left=parseInt(marqueewidth)+8
ns_marquee.document.write(marqueecontent)
ns_marquee.document.close()
actualwidth=ns_marquee.document.width
}
lefttime=setInterval("scrollmarquee()",15)
}
window.onload=populate

function scrollmarquee(){
if (iedom){
if (parseInt(cross_marquee.style.left)>(actualwidth*(-1)+8))
cross_marquee.style.left=parseInt(cross_marquee.style.left)-copyspeed+"px"
else
cross_marquee.style.left=parseInt(marqueewidth)+8+"px"

}
else if (document.layers){
if (ns_marquee.left>(actualwidth*(-1)+8))
ns_marquee.left-=copyspeed
else
ns_marquee.left=parseInt(marqueewidth)+8
}
}

if (iedom||document.layers){
with (document){
document.write('<table border="0" cellspacing="0" cellpadding="0"><td>')
if (iedom){
write('<div style="position:relative;width:'+marqueewidth+';height:'+marqueeheight+';overflow:hidden">')
write('<div style="position:absolute;width:'+marqueewidth+';height:'+marqueeheight+';background-color:'+marqueebgcolor+'" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">')
write('<div id="iemarquee" style="position:absolute;left:0px;top:0px"></div>')
write('</div></div>')
}
else if (document.layers){
write('<ilayer width='+marqueewidth+' height='+marqueeheight+' name="ns_marquee" bgColor='+marqueebgcolor+'>')
write('<layer name="ns_marquee2" left=0 top=0 onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed"></layer>')
write('</ilayer>')
}
document.write('</td></table>')
}
}
</script>	</div>	</td>
      </tr>
          
          </table>
</td>
      </tr>
</table></td>
  </tr>
</table>
</div>
</body>
</html>