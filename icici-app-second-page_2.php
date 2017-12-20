<?php
	require 'scripts/db_init.php';
	require 'scripts/icici_exclusiveapp.php';
	require 'scripts/functions.php';


//print_r($_POST);
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
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$cust_loan = $_POST['cust_loan'];
		$relationship = $_POST["relationship"];
		$City = $_POST["City"];
		//$day = $_POST["day"];
		//$month = $_POST["month"];
		//$year = $_POST["year"];
		//$DOB =$year."-".$month."-".$day;
		$Employment_Status = $_POST["Employment_Status"];
		$Company_Name = $_POST["Company_Name"];
		$Net_Salary = $_POST["Net_Salary"];
		$total_emi = $_POST["total_emi"];
		$other_emi = $_POST["other_emi"];
		//$getDOB = str_replace("-","", $DOB);
		$age =  $_POST["age"];
		$Company_Type=0;
		$IP = getenv("REMOTE_ADDR");
		$monthly_income= $_POST["Net_Salary"];

		if($relationship=="SALARY_ACCOUNT" || $relationship=="SAVINGS_ACCOUNT" || $relationship=="CURRENT_ACCOUNT")
		{
			$Primary_Acc="ICICI";
		}

	$getcompany='select org_type from  icici_organisation_list where organisation_name="'.$Company_Name.'"';
		list($recordcount,$grow)=Mainselectfunc($getcompany,$array = array());

		$org_type = $grow["org_type"];
		$Dated = ExactServerdate();
		$data = array('iciciapp_relation'=>$relationship, 'iciciapp_city'=>$City, 'iciciapp_dob'=>$DOB, 'iciciapp_occupation'=>$Employment_Status, 'iciciapp_company_name'=>$Company_Name, 'iciciapp_salary'=>$Net_Salary, 'iciciapp_secure_emi'=>$total_emi, 'iciciapp_unsecure_emi'=>$other_emi, 'iciciapp_ipaddress'=>$IP, 'iciciapp_dated'=>$Dated, 'customer_loan_amt'=>$cust_loan);
		$table = 'icici_exclusive_app';
		$ProductValue = Maininsertfunc ($table, $data);

$cityList = 'Noida,Noida,Faridabad,Sahibabad,Gaziabad,Gurgaon,Delhi,Pune,Mumbai,Bangalore,Chennai,Hyderabad,kolkata,Thane,Navi mumbai';
$arrCity = explode(",", $cityList);


$City= ucfirst(strtolower($City));

if(($City=="Delhi" || $City=="Thane" || $City=="Mumbai" || $City=="Noida" || $City=="Navi Mumbai" || $City=="Gurgaon" || $City=="Gaziabad") && ((($org_type=="ELITE" || $org_type=="SUPERPRIME") && $monthly_income>=25000) || (($org_type=="PREFERRED" || $org_type=="GOVT") && $monthly_income>=30000) || ($monthly_income>=40000)))
		{
	//echo "enter 1";
list($iciciCAinterestrate,$iciciCAgetloanamout,$iciciCAgetemicalc,$iciciCAterm,$CAperlacemi, $iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)= icicibank($monthly_income,$Company_Name,$org_type,$age,$Company_Type,$Primary_Acc,$total_emi,$other_emi,$cust_loan);
//echo $iciciCAinterestrate."-".$iciciCAgetloanamout."-".$iciciCAgetemicalc."-".$iciciCAterm."-".$CAperlacemi."<br>";
		}
		elseif(($City=="Chennai" || $City=="Hyderabad" || $City=="Bangalore" || $City=="Pune" || $City=="Kolkata") && ((($org_type=="ELITE" || $org_type=="SUPERPRIME") && $monthly_income>=20000) || (($org_type=="PREFERRED" || $org_type=="GOVT") && $monthly_income>=25000) || ($monthly_income>=32000)))
		{
			//echo "enter 2";
			list($iciciCAinterestrate,$iciciCAgetloanamout,$iciciCAgetemicalc,$iciciCAterm,$CAperlacemi, $iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)= icicibank($monthly_income,$Company_Name,$org_type,$age,$Company_Type,$Primary_Acc,$total_emi,$other_emi,$cust_loan);
		}
		elseif(($City!="Delhi" && $City!="Thane" && $City!="Mumbai" && $City!="Noida" && $City!="Navi Mumbai" && $City!="Gurgaon" && $City!="Gaziabad" && $City!="Chennai" && $City!="Hyderabad" && $City!="Bangalore" && $City!="Pune" && $City!="Kolkata" && $City!="Other") && ((($org_type=="ELITE" || $org_type=="SUPERPRIME") && $monthly_income>=17500) || (($org_type=="PREFERRED" || $org_type=="GOVT") && $monthly_income>=20000) || ($monthly_income>=25000)))
		{
			//echo "enter 3";
			list($iciciCAinterestrate,$iciciCAgetloanamout,$iciciCAgetemicalc,$iciciCAterm,$CAperlacemi, $iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)= icicibank($monthly_income,$Company_Name,$org_type,$age,$Company_Type,$Primary_Acc,$total_emi,$other_emi,$cust_loan);
		}
		else
		{
			$msg="not eligible";
		}
			}
	?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ICICI Personal Loan</title>
<link href="icici-app-styles.css" type="text/css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href='progression.min.css' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="tip-yellow.css" type="text/css" />
<link href="app-second-styles.css" type="text/css" rel="stylesheet" />
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="ICICI_CL/jquery.ui.widget.js"></script>
	<script src="ICICI_CL/jquery.ui.mouse.js"></script>
	<script src="ICICI_CL/jquery.ui.slider.js"></script> 
	<!--<script src="scripts/icici_pljquery_new.js"></script>-->
    <script type="text/javascript" src="sliding.form.js"></script>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="ICICI_CL/base/jquery.ui.all.css"> 
<script Language="JavaScript">
$(function() {
			$( "#slider-range-min" ).slider({
			range: "min",
			value:<? if($iciciCAgetloanamout>0) { echo round($iciciCAgetloanamout);} else { echo round($icicigetloanamout); }?>,
			min: 50000,
			step: 10000,
			max:  $("#untouchedla").val(),
			slide: function( event, ui ) {
				$( "#amount" ).val( "" + ui.value );
			}
		});
		$( "#amount" ).val( "" + $( "#slider-range-min" ).slider( "value" ) );
	});
	
$(function() {
		$( "#slider-range-min1" ).slider({
			range: "min",
			value: $("#untouched_tenCA").val(),
			step: 1,
			min: 1,
			max: $("#untouched_ten").val(),
			slide: function( event, ui ) {
				$( "#amount1" ).val( "" + ui.value );
			}
		});
		
		$( "#amount1" ).val( "" + $( "#slider-range-min1" ) .slider( "value" ) );
	});

$(function() {
$("#slider-range-min").mouseup(function(){
	//alert($('#untouched_laCA').val());
 $.post("icici_app_lavalues.php",
  {
   nwLA: $('#amount').val(), 
	salary: $('#salary').val(), 
	company: $('#company').val(), 
	category: $('#category').val(), 
	  dob: $('#age').val()
  },
  function(data){
	 	 $('#new_activate_div').html(data);
  });
});


$("#slider-range-min1").mouseup(function(){
	//alert("hello");
 $.post("icici_app_values.php",
  {
   nwLA: $('#amount').val(), 
	tenure: $('#amount1').val(), 
	intr: $('#interest_rate').val(),
	proc_fee: $('#proc_fee').val()
  },
  function(data){
   
	 $('#new_activate_div').html(data);
  });

});
});
</script>
</head>
<body>
<header>
<div class="top-bx">
<div class="logo"><img src="images/icici-app-logo.jpg" width="189" height="47"></div>
<div class="right-box"><span class="text-a">Powered by</span> <br>
<span class="text-a" style="color:#0f8eda; font-size:18px;">Deal4loans.com</span></div>
<div style="clear:both;"></div>
</div>
</header>
<? if($icicigetloanamout>50000 && $msg!='not eligible')
{ 
?>
<div class="second-wrapper-icici">
<div class="slider-wrapper-one">
 <input type="hidden" name="untouchedla" id="untouchedla" value="<? echo round($icicigetloanamout); ?>" />
 <input type="hidden" name="untouched_ten" id="untouched_ten" value="<? echo $iciciterm; ?>" />
 <input type="hidden" name="untouched_laCA" id="untouched_laCA" value="<? if($iciciCAgetloanamout>0) { echo round($iciciCAgetloanamout);} else { echo round($icicigetloanamout); }?>" />
 <input type="hidden" name="untouched_tenCA" id="untouched_tenCA" value="<? if($iciciCAterm>0) {echo round($iciciCAterm);} else { echo round($iciciterm); } ?>" />
 <input type="hidden" name="salary" id="salary" value="<? echo round($monthly_income); ?>" />
 <input type="hidden" name="company" id="company" value="<? echo trim($Company_Name); ?>" />
 <input type="hidden" name="category" id="category" value="<? echo $org_type; ?>" />
 <input type="hidden" name="age" id="age" value="<? echo $age; ?>" />

<table width="100%" cellpadding="0" border="0" cellspacing="0" height="50">
                      <tr>
                        <td width="300" align="center"><table width="85%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="62%" align="left"  class="<?php echo $model; ?>heading_text_slider"> Eligible Loan Amount:</td>
                                    <td width="37%" align="right"  class="<?php echo $model; ?>heading_text_slider"><input name="text" type="text" class="<?php echo $model; ?>heading_text_slider_box" id="amount" style="border:0px; width:65px;"  /></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="15"><div id="slider-range-min"  class="newdiv"></div></td>
                            </tr>
                            <tr>
                              <td  width="100%" align="center"><table width="100%"  border="0" cellspacing="0" cellpadding="0" align="center">
                                  <tr>
                                    <td width="55%" class="verdblk9" style="padding-top:10px;"><b>Min:</b> Rs.50000</td>
                                    <td width="50%" style="font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b; padding-top:10px;" align="right"><b>Max:</b>
                                        <input name="text" type="text" id="LA_dv" style="border:0px;font-size:9px; font-family:Verdana, Arial, Helvetica, sans-serif; color:#5b5b5b; width:50px;"  value="<? echo round($icicigetloanamout); ?>"/></td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                        <td width="30">&nbsp;</td>
                        <td width="300"><table width="74%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="27"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="62%" align="left" class="<?php echo $model; ?>heading_text_slider"> Tenure in Years</td>
                                    <td width="37%" align="right" class="<?php echo $model; ?>heading_text_slider"><input name="text" type="text" class="<?php echo $model; ?>heading_text_slider_box" id="amount1" style="border:0;width:25px;"/></td>
                                  </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td height="15"><div id="slider-range-min1" ></div></td>
                            </tr>
                            <tr>
                              <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td width="55%"  class="verdblk9" style="padding-top:10px;"><b>Min:</b> 1 Yr</td>
                                    <td width="50%"  class="verdblk9" style="padding-top:10px;" align="right"><b>Max:</b> <? echo $iciciterm; ?>(Years)</td>
                                  </tr>
                              </table></td>
                            </tr>
                        </table></td>
                      </tr>
                  </table>
<!--<div class="left-slider-icici-app"><img src="images/slider1-icici.jpg" width="421" height="68"></div>

<div class="right-slider-icici-app"><img src="images/slider2-icici.jpg" width="175" height="68"></div>-->
<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
<div class="icici-div"></div>
<form action="icici-bankstep3.php" method="POST" name="icici_step2">
<input type="hidden" name="iciciappid" id="iciciappid" value="<? echo $ProductValue; ?>">

<div class="tabular-icici">
 <table width="100%" border="0" cellspacing="1" cellpadding="1">
   <tr>
		<td colspan="5">
		<div  id="new_activate_div">
  <table width="100%" border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">Loan Amount</td>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">Interest Rate</td>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">EMI</td>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">Tenure</td>
      <td width="20%" height="35" align="center" bgcolor="#fe9112" class="tble-text" style="background:url(images/td-img.jpg) repeat-x;">Processing Fee</td>
    </tr> 
	
		<tr><td align="center" bgcolor="#fe9820" class="tble-text padding-td" ><input type="text" id="loan_amt" value="<? if($iciciCAgetloanamout>0){ echo $iciciCAgetloanamout; } else { echo $icicigetloanamout; } ?>" name="loan_amt" style="background:#fe9820; text-align:center; border:none; width:95%;color:#FFFFFF;"></td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td" >
	  <input type="text" value="<? $iciciinterestrate = substr($iciciinterestrate, 0, strlen($iciciinterestrate)-1);
	  if($iciciCAinterestrate>0){ 
		  $iciciCAinterestrate = substr($iciciCAinterestrate, 0, strlen($iciciCAinterestrate)-1);
		  echo $iciciCAinterestrate; } else { echo $iciciinterestrate; } 	  
	  ?>" id="interest_rate" name="interest_rate" style="background:#fe9820;text-align:center; border:none; width:95%; color:#FFFFFF;">
	</td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td" >
	  <input type="text" value="<? 
	  if($iciciCAgetemicalc>0){ echo $iciciCAgetemicalc; } else { echo $icicigetemicalc; }
	  ?>" id="emi" name="emi" style="background:#fe9820; text-align:center; border:none; width:95%; color:#FFFFFF;">
	 </td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td">
	  <input type="text" value="<? echo $iciciterm;?>" id="term" name="term" style="background:#fe9820; text-align:center; border:none; color:#FFFFFF;">
	 </td>
      <td align="center" bgcolor="#fe9820" class="tble-text padding-td"><input type="text" value="<? if($CAperlacemi>0) {echo $CAperlacemi;} else {echo $iciciperlacemi; } ?>" id="proc_fee" name="proc_fee" style="background:#fe9820; width:95%; border:none; color:#FFFFFF; text-align:center;">  </td></tr>
		
  </table>
  </div></td></tr></table>
  
</div>

<div class="tabular-icici-btn">
<input name="image"  value="Submit" type="image" src="images/apply-submit-app.png" width="99" height="40"  style="border:0px;" tabindex="15" />

</div>
</form>
</div>
<? } 
else 
{ ?>
 <div class="second-wrapper-icici"><div style=" width:95%; margin:45px auto; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#992d28; font-weight:bold;">
 
 Sorry, You are not eligible as per the policy.</div></div>
 <? } ?>
</body>
</html>