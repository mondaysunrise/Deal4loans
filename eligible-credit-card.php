<?php
ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	error_reporting();
//	$page_Name = "LandingPage_PL";
function DetermineAgeFromDOB ($YYYYMMDD_In)
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
	
	$RequestID	= $_POST['RequestID'];
	$Net_Salary	= $_POST['Net_Salary'];
	$ProductValue = $RequestID;
	$getDataSql = "select * from Req_Credit_Card where RequestID='".$RequestID."'";
	//$getDataQuery = ExecQuery($getDataSql);
	
	list($rowscount,$ArrRow)=MainselectfuncNew($getDataSql,$array = array());
		$i=0;
	
	$Name = $ArrRow[$i]['Name'];
	$Company_Name = $ArrRow[$i]['Company_Name'];
	$Employment_Status = $ArrRow[$i]['Employment_Status'];
	
	$Mobile_Number = $ArrRow[$i]['Mobile_Number'];
	$Phone = $Mobile_Number;
	$Pincode = $ArrRow[$i]['Pincode'];
	$City  = $ArrRow[$i]['City'];
	$Email = $ArrRow[$i]['Email'];
	$DOB = $ArrRow[$i]['DOB'];
	$DOB_arr = explode("-", $DOB);
	list($yyyy, $mm, $dd) = $DOB_arr;	
	$Reference_Code = $ArrRow[$i]['Reference_Code'];
	
	if($City=="Others")
	{
		$strcity=$City_Other;
		$City_Other  = $ArrRow[$i]['City_Other'];
		$City=$City_Other;
	}
	else
	{
		$strcity=$City;
	}

	//$updateSql = "update Req_Credit_Card set Reference_Code=".$Reference_Code.",Net_Salary = '".$Net_Salary."' where RequestID = '".$RequestID."'";
	//$updateQuery = ExecQuery($updateSql); 
	
	$DataArray = array("Reference_Code"=>$Reference_Code, "Net_Salary"=>$Net_Salary);
$wherecondition ="RequestID = '".$RequestID."'";
Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);
	
	//echo $Net_Salary; 
	//exit();
	if($Net_Salary<100)
   {
   // header location
 	 $_SESSION['Temp_LID'] = $RequestID;
   	  header ("Location: apply-credit-card-salary-correction.php");
  	  exit();
   }
	

	$SMSMessage = "Please use this code: ".$Reference_Code." to activate your card request at deal4loans.com";
		
				if(strlen(trim($Phone)) > 0)
				SendSMSforLMS($SMSMessage, $Phone);	
	
	

}

//exit();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<META HTTP-EQUIV="Refresh" CONTENT="8;URL=credit-card-thank.php">-->
<title>Credit Card Processing</title>
 <script language="javascript">
function validateFrm ()
{
	if(document.validate.activation_code.value=="")
	{
		alert("Please fill the activation code.");
		document.validate.activation_code.focus();
		return false;
	}

	if(document.validate.activation_code.value!="")
	{
		if(document.validate.activation_code.value!=<?php echo $Reference_Code; ?>)
		{
			alert("Please fill the correct activation code.");
			document.validate.activation_code.focus();
			return false;
		}
	}

}

</script>
</head>
<body style="margin:0px; padding:0px;">

<table width="1008" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="1008" align="center" valign="middle" style="background:url(/images/logos/bg1.gif) repeat;"><table width="980" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="80" align="center" valign="middle"><table width="980" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="200" height="80" align="center" valign="middle"><img src="new-images/d4l-sml-logo.gif" /></td>
            <td width="776" height="80" align="right" valign="bottom" style="padding-right:15px; font-family:'trebuchet MS'; font-size:16px; font-weight:bold; color:#000000;">Credit Card Request</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="980" height="400" align="center" style="font-family:verdana; font-size:14px; color:#0099FF; " valign="top">
        <table cellpadding="2" cellspacing="2" border="0">
        <tr><td align="center" style="padding-top:5px;" height="50">
                     Thanks for applying on deal4loans.com. Your Card Request is being scanned with the following Banks.
          </td></tr>
          <tr>
        <td width="980" height="70" align="center" valign="middle">
		<script language="JavaScript1.2">
var marqueewidth="950px"
//Specify the marquee's height
var marqueeheight="150px"
//Specify the marquee's marquee speed (larger is faster 1-10)
var marqueespeed=5
//configure background color:
var marqueebgcolor="#ffffff"
//Pause marquee onMousever (0=no. 1=yes)?
var pauseit=1
var marqueecontent='<nobr><table width="950" cellpadding="4"><tr><td  align="center"><table width="100" style="border:#0099FF solid 1px;"><tr><td align="center"><img src="http://www.deal4loans.com/new-images/stanc_palitinum.jpg" height="90" width="145"/></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">Standard Chartered Platinum Rewards Card </td></tr></table></td><td align="center" ><table style="border:#0099FF solid 1px;"><tr><td><img src="http://www.deal4loans.com/new-images/hdfc-gold-crd.jpg" height="90" /></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">HDFC Gold Card</td></tr></table></td><td  align="center"><table style="border:#0099FF solid 1px;"><tr><td><img src="http://www.deal4loans.com/new-images/hdfc_solitaire_crd.jpg" height="90"/></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">HDFC Bank Solitaire Womens Card </td></tr></table></td><td align="center" ><table style="border:#0099FF solid 1px;"><tr><td><img src="http://www.deal4loans.com/new-images/supervalue-titanium-card.png" /></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">Standard Chartered Super Value Titanium Card</td></tr></table></td><td width="135" align="center"><table style="border:#0099FF solid 1px;"><tr><td><img src="http://www.deal4loans.com/new-images/sbi-pltnm.jpg" /></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">SBI Platinum Card</td></tr></table></td><td align="center" ><table style="border:#0099FF solid 1px;"><tr><td><img src="http://www.deal4loans.com/new-images/manhattanplatinum-card.png" /></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">Standard Chartered Manhattan Platinum Card</td></tr></table></td><td align="center" ><table width="100" style="border:#0099FF solid 1px;"><tr><td align="center"><img src="http://www.deal4loans.com/new-images/hdfc-superia-crd.jpg" height="91"/></td></tr><tr><td height="25" align="center" style="font-family:verdana; font-size:11px; color:#0000ee; ">HDFC Bank Superia Credit Card</td></tr></table></td></tr></table></nobr>'
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
lefttime=setInterval("scrollmarquee()",10)
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
</script>		</td>
      </tr>
      
                     <tr valign="middle">
                                  <td height="28" class="frmbldtxt" style="padding-top:3px; font-weight:normal; font-size:13px; " align="center"><span style="float:left; padding-left:5px;">Dear <?php echo $Name ; ?>,</span>Please validate your mobile number.	</td>                   
                     </tr>
  <tr>
    <td colspan="2" style="color: #D02037; font-size:12px;" height="20" align="center"><b>We have sent an activation code on 
    <span style="color: #D02037;"><? echo $mobile_no; ?></span></b></td>
  </tr>
                   <tr><td colspan="2" align="center" style="padding:5px;">
				  </td></tr>
                  <tr><td colspan="2" align="center" style="padding:5px; ">
                  <form action="credit-card-thank.php" method="post" name="validate" onsubmit="return validateFrm();">
<div class="activation_box"><table  border="0" cellpadding="5" cellspacing="2" style="border:#666666 1px solid;">
				    <tr><td width="148" height="30" style="color: #D02037; font-size:12px; padding-left:10px; " > <strong>Activation Code</strong></td>
				    <td width="223"  style="padding-right:2px;"> 
           <input type="hidden" name="RequestID" id="RequestID" value="<?php echo $ProductValue; ?>">
		   <input type="hidden" name="Reference_Code" id="Reference_Code" value="<?php echo $Reference_Code; ?>">
        <input type="text" name="activation_code" id="activation_code" onChange="intOnly(this);" onKeyPress="intOnly(this)" onKeyUp="intOnly(this);"  maxlength="4"  />     </td></tr>
                        <tr><td>&nbsp;</td> <td > <input type="submit" name="val" value="Get Quote" style="width:154px; background-color: #D02037; color:#FFFFFF; font-weight:700; height:25px;" />
				  </td></tr>
                      <tr>
                        <td colspan="2" align="center" style="padding:5px;">To choose best suited card</td>
                      </tr>
                 </table></div>
        </form>        
     </td>
      </tr>      
          </table>
</td>
      </tr>
      
    </table></td>
  </tr>
</table>
	 
</body>
</html>

