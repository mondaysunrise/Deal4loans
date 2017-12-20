<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/hlicici_eligibility_function.php';
	error_reporting();
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

//	if(isset($_POST['submit']))
	//{
	//	print_r($_POST); echo "<br>";
		//Array ( [Name] => upendra [Phone] => 9971396361 [Email] => allproduct@ac.com [month] => 4 [day] => 4 [year] => 1973 [company_name] => gdgdfgddfffg [Employment_Status] => 1 [monthly_income] => 43433432 [obligations] => 3232 [loan_amount] => 2322121213 [co_appli] => 1 [co_name] => sddsasdasd [co_month] => 2 [co_day] => 18 [co_year] => 1970 [co_monthly_income] => 32332121 [co_obligations] => 23 [submit] => Submit ) 
		$City = $_POST['City'];
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$dob_arr[] = $_POST['year'];
		$dob_arr[] = $_POST['month'];
		$dob_arr[] = $_POST['day'];
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
	
		
		if($getloan_amount<800000)
		{
			$loan_amount=800000;
		}
		else
		{
			$loan_amount=$getloan_amount;
		}

		//echo $loan_amount."<br>";
		if($Employment_Status==2)
		{
			$monthly_income = ceil($monthly_income /12) ;
		}
		$getnetAmount = ($monthly_income + $co_monthly_income);
		$total_obligation = $obligations + $co_obligations;
		$netAmount=($getnetAmount - $total_obligation);
		$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$tenorPossible = 60 - $DOB;
		if($tenorPossible>20)
		{
			$tenorPossible = 20;
		}
		
	//	echo "<br>Outside -- ".$netAmount."--".$loan_amount."--".$DOB."--".$obligations."--".$City."--".$property_value."<br>";
		list($emi1st, $perlacemifor1, $inter1st, $yr1st, $emi2ndn3rd, $perlacemifor2, $inter2ndn3rd, $yr2nd, $actualemi, $exactinter, $iciciloan_amount, $exactperlacemi, $iciciprint_term) = ICICI_Homeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value,$Employment_Status); 
		
	//$aa = ICICI_Homeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value,$Employment_Status); 
		//print_r($aa);
		
		
		$IP = getenv("REMOTE_ADDR");
		if($Employment_Status==2)
		{
			$Net_Salary = $monthly_income;
		}
		else
		{
			$Net_Salary = $monthly_income *12;
		}
		
		$Loan_Amount = $iciciloan_amount;
		$tenure = $iciciprint_term;
		$interest = $inter1st;

	    $emi_fixed =  $emi1st * ($yr1st * 12);
	    $leftTerm = $iciciprint_term - ($yr1st * 12);
	    $emi_left = $actualemi * $leftTerm;
	    $totalEmi = $emi_fixed + $emi_left;
	   
	    $icicigetinterestamt=($totalEmi - $loan_amount);

	    $totalinterestamt= floor($icicigetinterestamt);
		
?>	
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ICICI Bank Home Loan</title>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">

<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<style type="text/css">
	/* START CSS NEEDED ONLY IN DEMO */
	#mainContainer{		width:660px;		margin:0 auto;		text-align:left;		height:100%;				border-left:3px double #000;		border-right:3px double #000;	}	#formContent{		padding:5px;	}	form{		display:inline;	}	</style>
<style>		.black_overlay{			display: none;			position: absolute;			top: 0%;			left: 0%;			width: 100%;			height: 100%;			background-color: black;			z-index:1001;			-moz-opacity: 0.8;			opacity:.50;			filter: alpha(opacity=50);		}
		.white_content {			display: none;			position: absolute;			top: 25%;			left: 25%;			width: 260;			height: 250;			padding: 6px;			border: 2px solid black;			background-color: white;			z-index:1002;			overflow: auto;		}
		.btnclr {    background-color: #1273AB;    border: medium none;    color: #FFFFFF;    font-family: Verdana,Arial,Helvetica,sans-serif;    font-size: 12px;    font-weight: bold;    height: 30px;    width: 250px;}
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
           
                  
	<link rel="stylesheet" href="ICICI_CL/base/jquery.ui.all.css">
	<script src="ICICI_CL/jquery-1.4.4.js"></script>
	<script src="ICICI_CL/jquery.ui.core.js"></script>
	<script src="ICICI_CL/jquery.ui.widget.js"></script>
	<script src="ICICI_CL/jquery.ui.mouse.js"></script>
	<script src="ICICI_CL/jquery.ui.slider.js"></script>
    
    
			<Script Language="JavaScript">
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
	var get_loan_amt = document.getElementById('amount').value;
	var get_tenure = document.getElementById('amount1').value;
	var netAmount= document.getElementById('netAmount').value;
	var DOB= document.getElementById('DOB').value;
	var City= document.getElementById('City').value;
	var property_value= document.getElementById('property_value').value;
	var total_obligation= document.getElementById('total_obligation').value;
	var eligible_loan_amt= document.getElementById('eligible_loan_amt').value;
	var Employment_Status= document.getElementById('Employment_Status').value;
			
	var queryString = "?get_loan_amt=" + get_loan_amt +"&get_tenure=" + get_tenure + "&netAmount=" + netAmount + "&DOB=" + DOB + "&City=" + City + "&property_value=" + property_value + "&total_obligation=" + total_obligation + "&eligible_loan_amt=" + eligible_loan_amt + "&Employment_Status=" + Employment_Status;
	//alert(queryString);		
  $('#complete_div').html('<p style="position:absolute; z-index:100; left:550px; top:130px;"><img src="new-images/new-ajax-loader.gif" /></p>');
  $('#complete_div').load("get_icici_hl_calc_pchart.php" + queryString);
}

window.onload = ajaxFunctionMain;
	
</script>
	<script>
	$(function() {
		$( "#slider-range-min" ).slider({
			range: "min",
			value: <? echo $getloan_amount; ?>,
			min: 100000,
			step: 10000,
			max:  <? echo $iciciloan_amount; ?>,
			slide: function( event, ui ) {
				$( "#amount" ).val( "" + ui.value );
			}
		});
		$( "#amount" ).val( "" + $( "#slider-range-min" ).slider( "value" ) );
	});
	</script>

	<script>
	$(function() {
		$( "#slider-range-min1" ).slider({
			range: "min",
			value: <? echo $iciciprint_term; ?>,
			step: 1,
			min: 5,
			max: <? echo $tenorPossible; ?>,
			slide: function( event, ui ) {
				$( "#amount1" ).val( "" + ui.value );
			}
		});
		$( "#amount1" ).val( "" + $( "#slider-range-min1" ) .slider( "value" ) );
	});

	</script>

</head><body>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="886">
  <tr>
    <td background="icici_car/main_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="872">
      <tbody><tr>
        <td><img src="icici_car/top_logo1.gif" height="104" width="872"></td>
      </tr>
    <tr><td height="15">&nbsp;</td></tr>     
      <tr>
        <td><img src="icici_car/body_top.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td background="icici_car/body_bg.gif">
        <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" >
				
                  
                     <?php
					if($total_obligation>$netAmount)
					{
					?>
					 <tr>
                          <td colspan="2" align="center" class="bldtxt" valign="top" height="200"></td>
                        </tr>
					<?php
					}
					

					else
					{
					?>
					
                     <tr>
	  	  
        <td align="center" colspan="2" ><table width="850" border="0" cellspacing="0" cellpadding="0">
 <!--D4l Here-->
<? if($iciciloan_amount>0)
{
?>
 <tr>
 <td width="626" align="center" valign="top" background="icici_car/calc-bg1.gif" style="background-repeat:no-repeat;    height:180px; background-position: top;">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
<form name="iciciform" action="icici_homeloan_func.php" onSubmit="return submit_form(document.iciciform);" method="post">
<input type="hidden" name="netAmount" id="netAmount" value="<? echo $netAmount; ?>">
<input type="hidden" name="DOB" id="DOB" value="<? echo $dateofbirth; ?>">
<input type="hidden" name="total_obligation" id="total_obligation" value="<? echo $total_obligation; ?>">
<input type="hidden" name="City" id="City" value="<? echo $City; ?>">
<input type="hidden" name="property_value" id="property_value" value="<? echo $property_value; ?>">
<input type="hidden" name="eligible_loan_amt" id="eligible_loan_amt" value="<? echo $iciciloan_amount; ?>">
<input type="hidden" name="Employment_Status" id="Employment_Status" value="<? echo $Employment_Status; ?>">

<table width="100%" cellpadding="0" border="0">
 <tr>
   <td height="30">&nbsp;</td>
   <td width="57%" align="right" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td align="left" >&nbsp;</td>
       <td align="right">&nbsp;</td>
     </tr>
     <tr>
       <td width="62%" align="left"  class="verdred13"> Eligible Loan Amount:</td>
       <td width="37%" align="right"><input type="text" id="amount" style="border:0px; width:65px;" class="verdred13" /></td>
     </tr>
   </table></td>
   <td align="left" style="font-size:9px; "></td>
 </tr>
 <tr><td width="19%"></td><td height="15">
<div id="slider-range-min" onClick="newcomplete_div();" onChange="newcomplete_div();" onMouseUp="newcomplete_div();"></div>
</td><td width="24%" align="right"></td></tr>
 <tr>
   <td>&nbsp;</td>
   <td colspan="2" align="left" ><table width="100%"  border="0" cellspacing="0" cellpadding="0">
     <tr>
       <td width="57%" class="verdblk9"><b>Min:</b> Rs.100000</td>
       <td width="43%" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b "><b>Max:</b> <? echo $iciciloan_amount; ?></td>
     </tr>
   </table></td>
   </tr>
<tr>
   <td>&nbsp;</td>
   <td>&nbsp;</td>
   <td align="right">&nbsp;</td>
 </tr>
 <tr>
  <td>&nbsp;</td>
  <td><table width="93%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="70%" align="left"  class="verdred13"> Tenure in Year:</td>
      <td width="29%" align="right"><input type="text" id="amount1" style="border:0;width:25px;" class="verdred13"/></td>
    </tr>
  </table></td>
  <td align="right">&nbsp;</td>
</tr>
<tr><td width="19%">&nbsp;</td><td>
<div id="slider-range-min1" onClick="newcomplete_div();" onChange="newcomplete_div();" onMouseUp="newcomplete_div();"></div>
</td><td width="24%" align="right">&nbsp;</td></tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="2" align="left" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif;  color:#5b5b5b "><table width="100%"  border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="60%"  class="verdblk9"><b>Min:</b> 5 Years</td>
      <td width="40%"  class="verdblk9"><b>Max:</b> <? echo $tenorPossible; ?>(Years)</td>
    </tr>
  </table></td>
  </tr>
</table>
</form></td></tr></table>
<table width="100%"  border="0" align="center">
<tr>
<td align="center" style="text-align:center; ">

</td>
  </tr>
</table>
</td>
    <td width="328" align="center" valign="top"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#a41c2b; ">
	
</td>
  </tr>
		<? }
	else
	{?>
	 <tr>
 <td width="626" align="center" valign="top">
	<table width="100%">
	<tr>
 <td align="left"  class="verdred13"> Dear Customer,<br>
Thanks for showing interest in Icici Home Loans.
As per information provided by you, We cannot offer Home loan at this point of time as per our credit policy.</td>
 </tr></table>
 </td>
    <td width="328" align="center" valign="top"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold; color:#a41c2b; ">
	
</td>
  </tr>
	<? }?>
	
 <tr>
    <td align="center" valign="top" colspan="2" height="10" ></td>
  </tr>
</table>
</td>
      </tr>
              
               <? if($iciciloan_amount>0)
{

?>  
<tr>
          <td height="71" colspan="2" align="center" background="icici_car/quote-bg.gif" style="background-repeat:no-repeat; background-position:center; ">
		  <div style=" float:left;" id="complete_div">
	<div style="position:absolute; z-index:100; margin-left:550px; top:165px; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px;   color:#a41c2b;">
	<div><b>PIE CHART [Scheme I]</b></div><?php 
 $total_cost =  $iciciloan_amount + $totalinterestamt;
 $lapercent= ($iciciloan_amount / $total_cost) *100;
 $Inpercent = ($totalinterestamt / $total_cost) *100;
$lnpre = substr($lapercent, 0,4);
$inper = substr($Inpercent, 0,4);
?>
<img src="http://chart.apis.google.com/chart?chs=250x100&cht=p3&chd=t:<? echo $lnpre; ?>,<? echo $inper; ?>&chxt=x,y&chds=0,100&chxr=0,0,90|1,0,90&chxl=0:|<? echo $lnpre." %"; ?>|<? echo $inper." %"; ?>&chco=A2D7F6,F4E46C"/>
<div id="sign">
<ul style="margin:0px; ">
<li style=" background:url(icici_car/amount_sign.gif) no-repeat 0px 4px; ">Loan Amount -  <? echo "Rs. ".number_format($Loan_Amount);?></li>
<li style=" background:url(icici_car/interest_sign.gif) no-repeat 0px 4px;">Interest Amount - <? echo "Rs. ".number_format($totalinterestamt); ?></li>
</ul>
</div>
</div>
<table width="870" align="center"  border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="text" colspan="2" align="center">
<table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="#E9DCB4" class="bldtxt">
                   <tr>
                          <td height="35" bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Bank Name</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rate of Interest </td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">EMI(Per Month)</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Tenure</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Required Loan Amount</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Maximum Eligible Loan Amount</td>
						  <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">EMI(Per Lac)</td>
						   <td bgcolor="#fcf7e8" style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Total Interest Amount</td>
</tr>
					<?
						if(strlen($iciciloan_amount)>0)
						{
						
						//list($emi1st, $perlacemifor1, $inter1st, $yr1st, $emi2ndn3rd, $perlacemifor2, $inter2ndn3rd, $yr2nd, $actualemi, $exactinter, $iciciloan_amount, $exactperlacemi, $iciciprint_term) = ICICI_Homeloan($netAmount,$loan_amount,$DOB,$total_obligation,$City,$property_value); 
					?>
					 <tr>
                          <td height="35" bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">SchemeI</td>
						  <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">

						  <?php echo $inter1st; ?>%(Fixed for 1yr), then  <?php echo $inter1st; ?>%</td>
                         <td bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">
                         
                         Rs.<?php echo $emi1st; ?>(Fixed for 1yr), then Rs.<?php echo $actualemi; ?></td>
						 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; "><?php echo ceil($iciciprint_term/12); ?> yrs.</td>
						 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo $loan_amount; ?></td>
						   <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo $iciciloan_amount; ?></td>
						    <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">
                             Rs. <?php echo $perlacemifor1; ?> (Fixed for 1yr), then Rs. <?php echo $exactperlacemi; ?></td>
							 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php
							   
							   $emi_fixed =  $emi1st * ($yr1st * 12);
							   $leftTerm = $iciciprint_term - ($yr1st * 12);
							   $emi_left = $actualemi * $leftTerm;
							   $totalEmi = $emi_fixed + $emi_left;
							   
						     $icicigetinterestamt=($totalEmi - $loan_amount);

							  $totalinterestamt= floor($icicigetinterestamt);
							 echo floor($totalinterestamt);
							 
							 //$a = ($iciciactualemi * $iciciprint_term) - $iciciviewLoanAmt;
							 //echo abs($a);
							 ?></td>
                        </tr>
                         <tr>
                          <td height="35" bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">SchemeII</td>
						  <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">
						  	  <?php echo $inter2ndn3rd; ?>%(Fixed for 2yr), then  <?php echo $inter1st; ?>%
						  </td>
                         <td bgcolor="#FFFFFF"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">
                         Rs.<?php echo $emi2ndn3rd; ?>(Fixed for 2yr), then Rs.<?php echo $actualemi; ?>
</td>
						 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; "><?php echo ceil($iciciprint_term/12); ?> yrs.</td>
						 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo $loan_amount; ?></td>
						   <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php echo $iciciloan_amount; ?></td>
						    <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">
                              Rs. <?php echo $perlacemifor2; ?> (Fixed for 2yr), then Rs. <?php echo $exactperlacemi; ?>
                            </td>
							 <td bgcolor="#FFFFFF" style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; text-align:left; padding:4px; ">Rs. <?php
							   
							   $emi_fixed =  $emi2ndn3rd * ($yr2nd * 12);
							   $leftTerm = $iciciprint_term - ($yr2nd * 12);
							   $emi_left = $actualemi * $leftTerm;
							   $totalEmi = $emi_fixed + $emi_left;
							   
						      //$iciciinterestfortwoyr= (($perlacemifortwo * 2) - $iciciloan_amount);

							   //$remingterm=$idbiterm - 2;
						     $icicigetinterestamt=($totalEmi - $iciciloan_amount);

							  $totalinterestamt= ($icicigetinterestamt);
							 echo floor($totalinterestamt);
						 ?></td>
                        </tr>
                           
                    </table>
                    
</div>
          </td>
	  </tr>
       
	  
	  <? } ?>      
				  </table>
        
    </td>
      </tr>
       <tr>
                          <td height="45"  style="font-size:11px; font-family:Verdana, Arial, Helvetica, sans-serif; padding-right:19px;" colspan="8" align="right" valign="middle" >
                              <form action="icici-home-loan-submit.php" method="post" name="loan_form"  onSubmit="return submitform(document.loan_form);">
                                                                
    <input type="hidden" name="builder_name" value="<?php echo $builder_name ; ?>" />
    <input type="hidden" name="propertyConstruction_Type" value="<?php echo $propertyConstruction_Type ; ?>" />

    <input type="hidden" name="City" value="<?php echo $City ; ?>" />
    <input type="hidden" name="month" value="<?php echo $month ; ?>" />
    <input type="hidden" name="day" value="<?php echo $day ; ?>" />
    <input type="hidden" name="year" value="<?php echo $year ; ?>" />
    <input type="hidden" name="company_name" value="<?php echo $company_name ; ?>" />
    <input type="hidden" name="Employment_Status" value="<?php echo $Employment_Status ; ?>" />
    <input type="hidden" name="monthly_income" value="<?php echo $monthly_income ; ?>" />
    <input type="hidden" name="obligations" value="<?php echo $obligations ; ?>" />
    <input type="hidden" name="loan_amount" value="<?php echo $loan_amount ; ?>" />
    <input type="hidden" name="property_value" value="<?php echo $property_value ; ?>" />
    <input type="hidden" name="source" value="<?php echo $source ; ?>" />
    <input type="hidden" name="co_month" value="<?php echo $co_month ; ?>" />
    <input type="hidden" name="co_day" value="<?php echo $co_day ; ?>" />
    <input type="hidden" name="co_year" value="<?php echo $co_year ; ?>" />
    <input type="hidden" name="co_monthly_income" value="<?php echo $co_monthly_income ; ?>" />
    <input type="hidden" name="co_obligations" value="<?php echo $co_obligations ; ?>" />
    <input name="submit1" type="button" class="btnclr" value="Apply and Share your information" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'" />
   <div id="light" class="white_content" style="text-align:right"><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" style="text-decoration:none; font-size:14px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold;">X</a>
   <table cellpadding="2" cellspacing="2" border="0" width="260">
   <tr><td colspan="2" align="center"><b style="font-size:14px; font-family:Verdana, Arial, Helvetica, sans-serif;">Fill Details</b></td></tr>
   <tr><td><b style="font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif;">Name</b></td><td><div class="loginboxdiv">
                      <input class="loginbox"  type="text" name="Name" id="Name"  /></div></td></tr>
      <tr><td><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Mobile</b></td><td><div class="loginboxdiv">
                      <input class="loginbox"  type="text" name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"   /></div></td></tr>
      <tr><td><b style="font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif;">Email</b></td><td><div class="loginboxdiv">
                      <input class="loginbox" type="text" name="Email" id="Email"    /></div></td></tr>
         <tr><td>&nbsp;</td><td align="left"><input type="submit" name="submit" id="Submit" value="Submit" style="background-color: #1273AB;    border: medium none;    color: #FFFFFF;    font-family: Verdana,Arial,Helvetica,sans-serif;    font-size: 12px;    font-weight: bold;    height: 30px;    width: 80px;"  /></td></tr>
         <tr><td style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif;" colspan="2" align="left">ICICI Home Loans will SMS you a verification code which you will need to enter in the next page.</td></tr>
   </table>
   
   </div>
		<div id="fade" class="black_overlay"></div>
        </form>
                          </td></tr>	
                    <?php }
					
					}
						?>
        <tr>
        <td height="35">&nbsp;</td>
      </tr>      
      <tr>
        <td><img src="icici_car/body_btm.gif" height="10" width="872"></td>
      </tr>
      
    </table></td>
  </tr>
</table>
<!--</form>-->
</body></html>