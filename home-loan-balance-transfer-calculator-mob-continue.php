<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	if(isset($_POST['submit']) || $_SERVER['REQUEST_METHOD'] == 'POST')
	{

		$Name = $_POST['Name2'];
		$Phone = $_POST['Phone2'];
		$Email = $_POST['Email2'];
		$source = $_POST['source'];
		$City = $_POST['City2'];
		$Type_Loan = "Req_Loan_Home";
		$IP = getenv("REMOTE_ADDR");
		$validMobile = is_numeric($Phone);	
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
		$days30date=date('Y-m-d',$tomorrow);
		$days30datetime = $days30date." 00:00:00";
		$currentdate= date('Y-m-d');
		$currentdatetime = date('Y-m-d')." 23:59:59";
		//$Employment_Status =1;
//		$Net_Salary=650000;
		if(strlen($Name)>0 && (preg_match("/1/", $Name)==1 || preg_match("/0/", $Name)==1) || preg_match("/!/", $Name)==1)
		{
		  $validname=0;
		}
		else
		{
			$validname=1;
		}
		
		if(($validMobile==1) && ($Name!="") && strlen($City)>0 && $validname==1)
		{
		

		$getdetails="select RequestID From ".$Type_Loan."  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
		list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
		$myrowcontr=count($myrow)-1;
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{			
						$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$data = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Dated"=>$Dated, "source"=>$source, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP_Address, "Reference_Code"=>$Reference_Code,"Updated_Date"=>$Dated,"Accidental_Insurance"=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>$Employment_Status, 'DOB'=>$dateofbirth, 'Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Existing_ROI'=>$Existing_ROI, 'Existing_Loan'=>$Existing_Loan, 'Existing_Bank'=>$Existing_Bank);
						
				$ProductValue = Maininsertfunc ('Req_Loan_Home', $data);
			}
		}					
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"> 
<link href="css/home-loan-balance-transfer-styles13.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Balance Transfer Calculator</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="http://www.deal4loans.com/style/sliderbaltrans.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://www.deal4loans.com/style/jquery_ui_css.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
<script src="scripts/highcharts.js"></script>
<script src="jscript-marquee.js" type="text/javascript" ></script>
<link href="marquee.css" type="text/css" rel="stylesheet"  />

<style type="text/css">
.sagscroller {
width: 100%!important;
height: 100px;
overflow: hidden;
position: relative;
border: 2px solid black;
border-radius: 8px;
-moz-border-radius: 8px;
-webkit-border-radius: 8px;
}

#mysagscroller2 ul li{
border-width:0;
display:block; /*this causes each image to be flush against each other*/
}

</style>

<script>
var sagscroller1=new sagscroller({
	id:'mysagscroller',
	mode: 'manual' })

var sagscroller2=new sagscroller({
	id:'mysagscroller2',
	mode: 'auto',
	pause: 2500,
	animatespeed: 400 //<--no comma following last option
})

</script>
<script src="amort1.js"></script>
<script>
//loan amount
$(function() {
			$( "#slider_la" ).slider({
			range: "min",
			value: 2000000,
			min: 100000,
			step: 100000,
			max:  20000000,
			slide: function( event, ui ) {
				$( "#amount_1a" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_1a" ).val( "" + $( "#slider_la" ).slider( "value" ) );
	});

//interest rate
$(function() {
			$( "#slider_intr" ).slider({
			range: "min",
			value: 10.25,
			min: 8.5,
			step: .25,
			max:  15,
			slide: function( event, ui ) {
				$( "#amount_intr" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_intr" ).val( "" + $( "#slider_intr" ).slider( "value" ) );
	});

//loan tenure
/*
$(function() {
			$( "#slider_intrnew" ).slider({
			range: "min",
			value: 10,
			min: 8.5,
			step: .25,
			max:  15,
			slide: function( event, ui ) {
				$( "#amount_intrnew" ).val( "" + ui.value );
			}
			,change:function(){EMI_calc()}
		});
		$( "#amount_intrnew" ).val( "" + $( "#slider_intrnew" ).slider( "value" ) );
	});
*/	
	function EMI_calc()
	{
		//alert("sdfsfd");
		var emiPrincipal=jQuery("#amount_1a").val();
		var initRate = jQuery("#amount_intr").val();
		if(initRate>0)
		{ 
			var emiRate=jQuery("#amount_intr").val()/12/100;
		}
		else
		{
			var emiRate=10.5/12/100;
			$( "#amount_intr" ).val( "10.5" );
		}
		var emiTenure=20 * 12;
		var emi=emiPrincipal*emiRate*(Math.pow(1+emiRate,emiTenure)/(Math.pow(1+emiRate,emiTenure)-1));
		var intrRateFixed = 10.5;
		var emiRateFixed=10.5/12/100;
		var emiFixed=emiPrincipal*emiRateFixed*(Math.pow(1+emiRateFixed,emiTenure)/(Math.pow(1+emiRateFixed,emiTenure)-1));
		var totalAmtPaidFixed = (emiFixed * emiTenure);
		var excessAmountFixed = totalAmtPaidFixed - emiPrincipal;
		
		var totalAmtPaid = (emi * emiTenure);
		var excessAmount = totalAmtPaid - emiPrincipal;
		
		if(initRate>10.5)
		{
			var finalAmt = excessAmount - excessAmountFixed;
			jQuery("#excess_amt_Label span").text("You will be in loss");
			//jQuery("#reducedLabel span").text("Increased Interest");
		}
		else
		{
			var finalAmt = excessAmountFixed - excessAmount;		
			jQuery("#excess_amt_Label span").text("You will Save ");
		//	jQuery("#reducedLabel span").text("Reduced Interest");
			
		}	
		jQuery("#excess_Amount span").text(number_format(Math.round(finalAmt)));
		jQuery("#otherCalcVal span").text(" % Per Annum");	
	}
</script>
 
<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	overflow-x:hidden;
	background-color:#FFF;
}
-->
.alert_msg{color:#FF0000; font-weight:bold; font-size:12px; font-family: Verdana, Geneva, sans-serif;}
input,select{border:1px solid #878787;margin:0;padding:0}
select:focus, input:focus
{
border:#FF0000 1px solid; 
}
.font22 {
font-family: 'Droid Sans', sans-serif;
font-size: 17px;
font-weight: bold;
font-variant: normal;
color: #666666;
text-decoration: none;
}
</style>

</head>

<body>
<div class="main_container">
<div class="hlb_left_box-new">
<div class="hlb_logo_box"><img src="images/logo.gif" width="243" height="90" /></div>
<div class="hlb_top_head_box-new"><span class="title_box"><span class="hlb_text_head"
>Home Loan Balance Transfer Calculator</span><br />
</span></div>

</div><div style="clear:both;"></div>
</div>
<div class="wrapper-second">
  <div class="new-right-pane2">
    <div style="padding-top:8px;">
    <div class="newformwrapper"><div class="hlb_right_box-wrappernew">
    <div class="hlbt-newformbox">
    
    <div class="hlb_img_box"><img src="images/hl-bt-cal-img.jpg" width="300" height="54" /></div>

</div>
<div class="hlbt-newform-mobo-box">

<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" colspan="2" align="center" class="hlb_form_text" style="font-size:13px; font-weight:bold; color:#349c09; padding-top:6px; padding-bottom:6px;">Thank You for applying. <br />We will get back to you shortly</td>
  </tr>
  <tr>
    <td height="25" colspan="2" class="hlb_form_text"    style="font-size:15px; font-weight:bold; color:#156dd1; padding-top:6px; padding-bottom:6px; ">&nbsp;</td>
  </tr>
    <td height="10" colspan="2"></td>
  </tr>
 
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="0" colspan="2" align="center" class="hlb_form_text" style="font-size:11px; font-weight:normal;">&nbsp;</td>
  </tr>
</table></form></div>
</div>
<div style="clear:both;"></div>
<div class="logos-wrapper-new" style="background:#FFFFFF;">
<div class="tptext">Top Home Loan Balance Transfer Banks</div>
<div style="color:#0033FF; font-size:18px; font-weight:bold;"> <span style="font-size:18px;">Sbi (State Bank), </span></span><span style="font-size:16px; color:#f8c001;">PNB Home Finance</span>, <span style="font-size:15px; color:#00529c;">LIC Housing</span>,  <span style="font-size:15px; color:#da251c;">Hdfc Ltd</span>,  <span style="font-size:15px; color:#ff6600;">ICICI</span>, <span style="font-size:15px; color:#a50032;">Axis Bank</span>, <span style="font-size:15px; color:#004e96;">Fedbank</span> & <span style="font-size:15px; color:#ec2028;">Citibank</span></div>


 </div>
 <div style="clear:both; height:4px;"></div>
 
 </div>
 <div class="left-new-wrapper"><div class="calci-wrapper" style="border:1px solid #666666;">
<table height="168" border="0" align="center" cellpadding="3" cellspacing="2">
<tr><td colspan="3" align="center"  style="color:#333333; font-weight:bold; font-size:16px; font-family:Arial, Helvetica, sans-serif;"><u>Sample Calcuator</u></td></tr>
<tr><td width="148" height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;"> Home Loan Amount </td>
<td width="95"><span style="font-weight:normal;">Rs.</span>
  <input type="text" value="0" name="amount_1a" id="amount_1a" size="11" onchange=" EMI_calc();" style="border:none; width:50px;"/></td>
<td width="77" style="color:#333333; font-weight:bold; font-size:10px; font-family:Arial, Helvetica, sans-serif;">Duration 20Yrs</td>
</tr>
<tr><td colspan="3" height="20"><div id="slider_la"></div></td></tr><tr><td height="20" colspan="3" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Reduce the Interest rate to see savings<!--Interest Rate</td><td colspan="2" align="right"><input type="text" name="amount_intr1" id="amount_intr1" size="11" readonly="readonly" value="10.5" style="border:none; width:40px; text-align:right;"/> <span style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">% Per Annum</span>--> </td></tr>
<tr><td colspan="3" height="52" valign="middle" style="background:url(new-images/bg-sliger.jpg) repeat;"><div id="slider_intr"></div></td><tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;" id="reducedLabel"><span></span></td><td colspan="2" align="right"><input type="text" value="0" name="amount_intr" id="amount_intr" size="11" readonly="readonly" onchange=" EMI_calc();"  style="border:none; width:40px; text-align:right"/> <span style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;" id="otherCalcVal"><span>% Per Annum</span></span> </td></tr>
<!--
<tr><td height="20" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">Duration</td><td colspan="2" align="left" style="color:#333333; font-weight:bold; font-size:13px; font-family:Arial, Helvetica, sans-serif;">20 Years</td><tr>-->
	    <td align="center" bgcolor="#88a943" class="font22"  style="color:#FFFFFF;" colspan="3" id="excess_amt_Label"><span>You will Save</span></td>
   </tr>
<tr>		<td align='center' bgcolor='#FFFFFF' class='font22' colspan="3" id="excess_Amount"><span>Rs. 80,335</span></td>
</tr>

</table>
</div>
<div style="clear:both;"></div>
<div class="right-panelnew2"><div class="hlb_why_tex_box"><div class="hlb_why_text">Why Deal4loans.com</div>
<div style="clear:both;"></div>
<div class="hlb_why_text_b" style="margin-top:10px;"><ul>
<li>Instant Balance Transfer Quotes from all Banks.</li>
<li>Choose best deal or lowest EMI.</li>
<li>Home Loan Balance Transfer Quotes are free for customers.</li>
<li>Your information will not be shared with anyone without your consent.</li>
<li>Over 26 lakh customers have taken quote at Deal4loans.com</li>
</ul>
</div>
</div>
<div style="clear:both;"></div>

</div>
</div>


 </div>
<div style="clear:both;"></div>
<div class="hlb_text_section" style="margin-top:10px;">


</div>
  </div>
 </div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>