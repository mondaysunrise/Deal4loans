<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'scripts/firstblue_func.php';
	
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

//print_r($_POST);

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	$City = $_POST['City'];
	$day = $_POST['day']; 
	$month = $_POST['month'];
	$year = $_POST['year'];
	$dateofbirth =$year."-".$month."-".$day;
	$Employment_Status =  $_POST['Employment_Status'];
	$Monthly_Income = $_POST['Monthly_Income'];
	$Property_Identified = $_POST['Property_Identified'];
	$Total_Emi = $_POST['Total_Emi'];
	$Builder_Name = $_POST['Builder_Name'];
	$Property_Value = $_POST['Property_Value'];
	$Property_Loc = $_POST['Property_Loc'];
	$current_itr =  $_POST['current_itr'];
	$last_itr =  $_POST['last_itr'];
	$Monthly_Income = $_POST['Monthly_Income'];
	$company_name = $_POST['company_name'];

$_SESSION['City']	=	$City; 
$_SESSION['day'] 	=	$day; 
$_SESSION['month']	=	$month; 
$_SESSION['year']	=	$year; 
$_SESSION['Employment_Status']	=	$Employment_Status; 
$_SESSION['Monthly_Income']	=	$Monthly_Income; 
$_SESSION['Property_Identified']	=	$Property_Identified; 
$_SESSION['Total_Emi']	=	$Total_Emi; 
$_SESSION['Builder_Name']	=	$Builder_Name; 
$_SESSION['Property_Value']	=	$Property_Value; 
$_SESSION['Property_Loc']	=	$Property_Loc; 
$_SESSION['current_itr']	=	$current_itr;
$_SESSION['last_itr']	=	$last_itr; 
$_SESSION['Monthly_Income']	=	$Monthly_Income; 
$_SESSION['company_name']	=	$company_name; 


	$DOB = str_replace("-","", $dateofbirth);
	$DOB = DetermineAgeFromDOB($DOB);
$details[]= $loan_amount;
$details[]= $inter;
$details[]= $actualemi;
$details[]= $term;
$averageITR = ((($current_itr + $last_itr) / 2) /12);

$annual_income = $Monthly_Income * 12;

if($Employment_Status=="Self Employed")
	{
		$net_Salary = $averageITR;
		$annual_income = $averageITR *12;
	}
	else
		{
			$net_Salary = $Monthly_Income;
			$annual_income = $Monthly_Income *12;
		}


if($annual_income>=180000)
		{
	
if((($DOB>21 && $DOB<=60) && $Employment_Status=="Salaried") || (($DOB>21 && $DOB<=65) &&  $Employment_Status=="Self Employed"))
		{
	
if($Employment_Status=="Self Employed")
	{
	
			list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSE($averageITR,$DOB,$Total_Emi,$Property_Value,$Property_Identified);
	}
	else
	{
		list($perlacemi,$viewLoanAmt,$frstblloan_amount,$frstblinter,$frstblactualemi,$frstblterm)=firstblue_HomeloanSal($Monthly_Income,$DOB,$Total_Emi,$Property_Value,$Property_Identified);
	}
	
		}
		}


//insert query

if(strlen($City)>0 && strlen($Employment_Status)>0)
{

	$Dated = ExactServerdate();
		
	$dataInsert = array('firstblue_city'=>$City, 'firstblue_property_identified'=>$Property_Identified, 'firstblue_dob'=>$dateofbirth, 'firstblue_emp_stat'=>$Employment_Status, 'firstblue_company_name'=>$company_name, 'firstblue_netsalary'=>$net_Salary, 'firstblue_property_loc'=>$Property_Loc, 'firstblue_property_value'=>$Property_Value, 'firstblue_builder_name'=>$Builder_Name, 'firstblue_obligation'=>$Total_Emi, 'firstblue_dated'=>$Dated, 'firstblue_loanamt'=>$frstblloan_amount, 'firstblue_roi'=>$frstblinter, 'firstblue_emi'=>$frstblactualemi, 'firstblue_tenure'=>$frstblterm);
	$table = 'first_blue_leads';
	$ProductValue = Maininsertfunc ($table, $data);
	
}


$maxTenure=	($frstblterm*12);

	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="icici_car/Functions.js"></script>
<script src="icici_car/AC_ActiveX.js" type="text/javascript"></script>
<script src="icici_car/AC_RunActiveContent.js" type="text/javascript"></script>
	<link rel="stylesheet" href="ICICI_CL/base/jquery.ui.all.css">
	<script src="ICICI_CL/jquery-1.4.4.js"></script>
	<script src="ICICI_CL/jquery.ui.core.js"></script>
	<script src="ICICI_CL/jquery.ui.widget.js"></script>
	<script src="ICICI_CL/jquery.ui.mouse.js"></script>
	<script src="ICICI_CL/jquery.ui.slider.js"></script>
<style>
.frst_cl {
	color:#663300; 
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:12px;
}
.btnclr {
background-color:#006EAB;
border:medium none;
color:#FFFFFF;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:12px;
font-weight:bold;
height:25px;
width:120px;
}

</style>
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
	var get_empstat = document.getElementById('get_empstat').value;
			
	var queryString = "?get_loan_amt=" + get_loan_amt +"&get_tenure=" + get_tenure + "&get_empstat=" + get_empstat;
	//alert(queryString);
	
  $('#complete_div').html('<p style="position:absolute; z-index:100; left:550px; top:130px;"><img src="new-images/new-ajax-loader.gif" /></p>');
  $('#complete_div').load("get_firstblue_hlcalc_pchart.php" + queryString);
}

window.onload = ajaxFunctionMain;
	

function goBack()
  {
  window.history.back()
  }






</script>
	<script>
	$(function() {
		$( "#slider-range-min" ).slider({
			range: "min",
			value: <? echo $frstblloan_amount; ?>,
			min: 100000,
			step: 10000,
			max:  <? echo $frstblloan_amount; ?>,
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
			value: <? echo $frstblterm; ?>,
			step: 1,
			min: 1,
			max: <? echo $frstblterm; ?>,
			slide: function( event, ui ) {
				$( "#amount1" ).val( "" + ui.value );
			}
		});
		$( "#amount1" ).val( "" + $( "#slider-range-min1" ) .slider( "value" ) );
	});

	</script>
</head>

<body bgcolor="#FFFFFF" >
<table width="990" bgcolor="#FFFFFF" align="center" valign="top" style="height:400px;">
	<tr>
		<td  colspan="2" width="100%" valign="top"><table width="100%" style="padding-left:5px; padding-top:5px;" valign="top"><tr>
		<td width="188" height="117"><img src="new-images/first_blue_logo.jpg" width="188" height="117"/></td>
		<td width="782"  style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:26px; color:#F8C301; font-weight:450;">Get competitive offers on First Blue Home finance Ltd</td>
	</tr></table></td>
	</tr>
	<? 
if($annual_income>=180000)
		{
if((($DOB>21 && $DOB<=60) && $Employment_Status=="Salaried") || (($DOB>21 && $DOB<=65) &&  $Employment_Status=="Self Employed"))
		{
		?>
	<tr>
		<td width="626" align="center"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" valign="top">
		 
  <tr>
    <td>
<input type="hidden" name="get_empstat" id="get_empstat" value="<? echo $Employment_Status; ?>">
<table width="100%" cellpadding="0" border="0" valign="top">
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
       <td width="43%" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b "><b>Max:</b> <? echo $maxLoan_Amount; ?></td>
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
  <td><table width="93%" border="0" cellspacing="0" cellpadding="0" valign="top">
    <tr>
      <td width="70%" align="left"  class="verdred13"> Tenure in Yrs:</td>
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
      <td width="60%"  class="verdblk9"><b>Min:</b> 1 Yr</td>
      <td width="40%"  class="verdblk9"><b>Max:</b> <? echo $frstblterm; ?>(Yrs)</td>
    </tr>
  </table></td>
  </tr>
</table>
</td></tr></table></td>
<td width="500"><tr>
	      <td height="71" colspan="2" align="center" background="icici_car/quote-bg.gif" style="background-repeat:no-repeat; background-position:center; ">
		  <div style=" float:left;" id="complete_div">
	

		  <table width="840" align="center"  border="0" cellspacing="0" cellpadding="0" >
      <tr>
	  <td width="6%">&nbsp;</td>
        <td align="center" width="24%" height="30" class="verdbold12">Loan Amount</td>
        <td align="center" width="17%" class="verdbold12">Interest Rate</td>
        <td align="center" width="18%" class="verdbold12">EMI (Per month)</td>
        <td align="center" width="22%" class="verdbold12">Per Lac EMI (Per month) </td>
        <td align="center" width="13%" class="verdbold12">Tenure</td>
      </tr>
	    </table>
			
		  <table width="840" align="center"  border="0" cellspacing="0" cellpadding="0">
		  <tr >
		  <td width="6%">&nbsp;</td>
        <td width="24%" height="35" align="center"  class="verdred12"><? echo $frstblloan_amount; ?></td>
        <td width="17%" align="center"   class="verdred12"><? echo $frstblinter." %"; ?></td>
        <td width="18%" align="center"   class="verdred12"><? echo $frstblactualemi; ?></td>
        <td width="20%" align="center"   class="verdred12"><? echo $perlacemi; ?></td>
        <td width="15%" align="center"   class="verdred12"><? echo $frstblterm." (in Yrs)"; ?></td>
      </tr>
		</table>
	</div>
          </td>
	  </tr>
	   <tr><td colspan='2' align="center">&nbsp;</td></tr>
	   <tr><td colspan='2' align="center"><form action="apply_first_blue_continue_thanks.php" name="hl_details" method="POST">
	   <table width='70%' align="center"><tr><td><input type="button" value="Go Back" onclick="goBack()" class="btnclr"/></td><td style="padding-left:30px;"><input type="hidden" name="get_reqid" id='get_reqid' value="<? echo $ProductValue; ?>">
	   <input name="submit" type="submit" class="btnclr" value="Apply Now" /></td>
	  </tr></table></form></td></tr></td>
	</tr>
<? }
else
{ ?>
	 <tr>
 <td width="626" align="center" valign="top" colspan="2">
	<table width="100%" valign="top">
	<tr>
 <td align="left"  class="verdbold12" > Dear Customer,<br>
Thanks for showing interest in First Blue Home Loans.
As per information provided by you, We cannot offer Home loan at this point of time as per our credit policy.</td>
 </tr></table>
 </td>
   
  </tr>
<? } 
		}
		else
{ ?>
	 <tr>
 <td width="626" align="center" valign="top" colspan="2" >
	<table width="100%" valign="top">
	<tr>
 <td align="left"  class="verdbold12" > Dear Customer,<br>
Thanks for showing interest in First Blue Home Loans.
As per information provided by you, We cannot offer Home loan at this point of time as per our credit policy.</td>
 </tr></table>
 </td>
   
  </tr>
<? }?>	
</table>
</body>
</html>

