<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<style type="text/css"></style>
<meta http-equiv="Content-Language" content="en-us">
<title>Home Loan Interest Rates | Compare Home Loan Rates 2013</title>
<meta name="keywords" content="Home Loan Rates, Home Loan Interest Rates, Home loan rates in India, compare Home loan rates, Home loans at least interest rate">
<meta name="Description" content="Home loan rates comparison with various banks. Know processing fee, Interest rates for salaried and self employed personnel / professionals. Check latest interest rates of SBI, HDFC Ltd, ICICI, Axis Bank, Bank of India, Bank of Baroda, Allahabad Bank, PNB etc.">
<?php
if(strlen($_GET['source'])>0)
{
echo '<link rel="canonical" href="http://www.deal4loans.com/home-loans-interest-rates.php"/>';

}

?>

<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<link href="source.css" rel="stylesheet" type="text/css" />
<link href="css/hl-intrrates.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript">
function chkhomeloan()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	if((document.hlloan_form.Name.value=="") || (Trim(document.hlloan_form.Name.value))==false)
	{        document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";					document.hlloan_form.Name.focus();		return false;	}
	if(document.hlloan_form.Name.value!="")
	{
		if(containsdigit(document.hlloan_form.Name.value)==true)
		{			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>First Name contains numbers!</span>";		document.hlloan_form.Name.focus();	return false;		}	
	}
   
   for (var i = 0; i <document.hlloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.hlloan_form.Name.value.charAt(i)) != -1) 
		{	document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";	document.hlloan_form.Name.focus(); return false;	}  
	}
	  if(document.hlloan_form.Email.value=="")
	  {		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	document.hlloan_form.Email.focus();		return false;	}
	var str=document.hlloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter  Email Address!</span>";	document.hlloan_form.Email.focus();		return false;	}
	else if(bb==-1)
	{		document.getElementById('emailVal').innerHTML = "<span class='hintanchor'>Enter  Email Address!</span>";	document.hlloan_form.Email.focus();		return false;	}
	if (document.hlloan_form.City.selectedIndex==0)
	{		document.getElementById('cityVal').innerHTML = "<span class='hintanchor'>Enter City to Continue!</span>";	document.hlloan_form.City.focus();		return false;	}
	if((document.hlloan_form.City.value=="Others") && ((document.hlloan_form.City_Other.value=="" || document.hlloan_form.City_Other.value=="Other City"  ) || !isNaN(document.hlloan_form.City_Other.value)))
	{		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>"; document.hlloan_form.City_Other.focus();		return false;	}
	for (var i = 0; i <document.hlloan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.hlloan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	document.hlloan_form.City_Other.focus();  		return false;  	}
  }
  if(document.hlloan_form.Phone.value=="")
  {		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";	document.hlloan_form.Phone.focus();		return false;	}
	if(isNaN(document.hlloan_form.Phone.value)|| document.hlloan_form.Phone.value.indexOf(" ")!=-1)
	{		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";	document.hlloan_form.Phone.focus();		return false;  	}
	if (document.hlloan_form.Phone.value.length < 10 )
	{	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	document.hlloan_form.Phone.focus();		return false;	}
	if ((document.hlloan_form.Phone.value.charAt(0)!="9") && (document.hlloan_form.Phone.value.charAt(0)!="8") && (document.hlloan_form.Phone.value.charAt(0)!="7"))
	{	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	document.hlloan_form.Phone.focus();		return false;	}
	if (document.hlloan_form.IncomeAmount.value=="")
	{		document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";	document.hlloan_form.IncomeAmount.focus();		return false;	}	

	if(!document.hlloan_form.accept.checked)
	{
		document.getElementById('acceptVal').innerHTML = "<span  class='hintanchor'>Read and Accept Terms & Conditions!</span>";
		document.hlloan_form.accept.focus();
		return false;
	}		
}

function containsdigit(param){	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false; }
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function othercity1(){
	var ni1 = document.getElementById('othCitDiv');
	var ni2 = document.getElementById('othCitvalDiv');
	if(document.hlloan_form.City.value=='Others')
	{
		ni1.innerHTML = 'Other City';
		ni2.innerHTML = '<input name="City_Other" id="City_Other" type="text" style="width:140px; height:12px;" onKeyDown="validateDiv(\'emailVal\');"  tabindex="6" /><div id="othercityVal"></div>';
	}
	else	
	{
		ni1.innerHTML = '';
		ni2.innerHTML = '';
	}
}
</script>
<style>

</style>
</head>
<body>
<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")); $currentdate=date('d F Y',$tomorrow); ?>
<div class="hli_rates_header"><?php include "top-menu.php"; include "main-menu.php"; ?></div>

<div style="clear:both;"></div>
<div class="intrl_txt">	
<div class="hli_rates_logo"><img src="images/logo.gif" width="243" height="90" /></div>
<div style="clear:both;"></div>
<div class="text12" style="margin:auto; width:100%; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <span class="text12" style="color:#4c4c4c;">>Home Loan Interest Rates </span></div><div style="clear:both;"></div>
<div class="hli_title_wraper"><div class="hli_title_box"><span class="hli_title_text">Home Loan Interest Rates<br />
</span><span class="hli_title_text_a">(Last edited on : <? echo $currentdate; ?>)</span></div>
<div class="hli_ad"><a href="/home-loan-balance-transfer-calculator.php" style="text-decoration:none;"><img src="http://www.deal4loans.com/new-images/hl-baltrnfr.jpg" /></a></div></div>
<div style="clear:both;"></div>
<div class="hli_content_box">
  <p><span class="text11" style="color:#4c4c4c;">Buying your first home can seem intimidating, especially when faced with many different loan types. Don't worry. Use this list to compare and narrow down the choices to know which is the best.
    <br />
  </span><span class="text11" style="color:#4c4c4c;">    To help its customers get the best interest rates on home loans deal4loans has consolidated all the information regarding current rate of interest for all the banks at one place. Please keep visiting this section to check updated rate of interest for home loans.<br />
  </span></p>
  <span class="text11">
  <div style="font-size: 12px; text-align: center; font-style: italic; width:100%; color:#4c4c4c;">Budget Bonanza for Home loan customers 2013 - Additional one lac deduction of interest allowed for home loans upto 25 lacs.</div>
  </span></div>
 <div style="clear:both;"></div>
 <form name="hlloan_form" method="post" action="home-loans-interest-rates-continue.php" onSubmit="return chkhomeloan();">
		<input type="hidden" name="source" value="hl interest rate apply"> 
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
  <div class="hli_form_box">
  <div class="hli_form_title">Get Exact Quote on Home Loan Interest Rates From all Banks</div>
  
  <div class="hli_input_section">
  
    <table width="99%" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td width="37%"><span class="text" style="color:#FFF; font-size:12px; text-transform:none;">Full Name:</span></td>
        <td width="63%" align="left"><input name="Name" id="Name" type="text" style="width:140px; height:12px;" tabindex="1" onKeyDown="validateDiv('nameVal');" /><div id="nameVal"></div>  </td>
      </tr>
      <tr>
        <td><span class="text" style="  color:#FFF; font-size:12px; text-transform:none; padding-top:8px;">Mobile:</span></td>
        <td align="left"><span class="text" style="color:#FFF; font-size:12px; text-transform:none; padding-top:8px;">+91 </span><input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" style="width:115px; height:12px;" onKeyDown="validateDiv('phoneVal');"  tabindex="2"/><div id="phoneVal"></div>  </td>
      </tr>
    </table>
  </div>
   <div class="hli_input_section">
     <table width="99%" border="0" cellspacing="5">
       <tr>
         <td width="37%"><span class="text" style="  color:#FFF; font-size:12px; text-transform:none;">Email:</span></td>
         <td width="63%" align="left"><input name="Email" id="Email" type="text" style="width:140px; height:12px;" onKeyDown="validateDiv('emailVal');" tabindex="3" /><div id="emailVal"></div></td>
       </tr>
       <tr>
         <td><span class="text" style="  color:#FFF; font-size:12px; text-transform:none;">Annual Salary:</span></td>
         <td align="left"><input type="text" name="IncomeAmount" id="IncomeAmount" style="width:140px; height:12px;"  onkeyup="intOnly(this); " onKeyPress="intOnly(this);" tabindex="4" onKeyDown="validateDiv('netSalaryVal');"/><div id="netSalaryVal"></div> </td>
       </tr>
     </table>
   </div>
   <div class="hli_input_section">
     <table width="99%" border="0" cellspacing="5">
       <tr>
         <td width="37%"><span style="font-size: 12px; color: #FFF">City:</span></td>
         <td width="63%" align="left"><select name="City" id="City" style="height:18px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="othercity1(); validateDiv('cityVal');" tabindex="5">
           <?=getCityList($City)?>
          </select><div id="cityVal"></div></td>
       </tr>
      </table>
   </div>
   <div class="hli_input_section">
     <table width="99%" border="0" cellspacing="5">
       <tr>
         <td width="37%" class="text" style="color:#FFF; font-size:12px; text-transform:none;" id="othCitDiv"></td>
         <td width="63%" align="left" id="othCitvalDiv"></td>
       </tr>
     </table>
   </div>

   <div class="term_cont_btn"><input name="submit" type="submit" style="border: 0px none ; background-image: url(http://www.deal4loans.com/images/get1-nw.jpg); background-repeat:no-repeat; width: 104px; height: 30px; margin-bottom: 2px;" value="" tabindex="8" /></div>
   <div class="term_cont_box">
     <table width="300" border="0" cellspacing="5">
       <tr>
         <td><span style="color:#FFF; font-size:11px; text-transform:none;">
           <input name="accept" type="checkbox" tabindex="7"  />
          I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.</span><div id="acceptVal"></div></td>
        </tr>
     </table>
   </div>
   
  </div>
  </form>
  <p class="tbl_txt" align="center"><strong>Check Home Loan Interest Rates</strong></p>
<form name="hlinterest" action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST">
  <div class="hli_check_home">
    <div class="click_input_section">
    <table width="99%" border="0" cellpadding="0" cellspacing="2">
      <tr>
        <td width="49%" class="tbl_txt"><b>Bank Name</b></td>
        </tr>
      <tr>
        <td align="center"><select name="sel_bank_name" class="hli_input_text" id="sel_bank_name"><option value="">ALL</option><? $selectbankresult="select bank_name from `home_loan_interest_rate_chart` where  (flag=1) group by bank_name order by bank_name ASC";
	echo "uihiyuiu".$selectbankresult."<br>";
		$getbankn_result_new=ExecQuery($selectbankresult);
		while($bnkn=mysql_fetch_array($getbankn_result_new))
		{  ?>
  <option value="<? echo $bnkn['bank_name']; ?>" <? if($sel_bank_name==$bnkn['bank_name'] ) { echo "selected";}?>><? echo $bnkn['bank_name']; ?></option>
          <? }
	?>
        </select></td>
        </tr>
    </table>
  </div>
  <div class="click_input_section">
    <table width="99%" border="0" cellpadding="0" cellspacing="2">
      <tr>
        <td width="49%" class="tbl_txt"><b>Loan Amount</b></td>
        </tr>
      <tr>
        <td align="center"><select name="loan_amount" class="hli_input_text">
      <option value="PLease Select">PLease Select</option>
      <option value="upto_20lacs" <? if($loan_amount=="upto_20lacs" ) { echo "selected";}?>>Upto 20lacs</option>
      <option value="upto_30lacs" <? if($loan_amount=="upto_30lacs" ) { echo "selected";} elseif(!isset($msg)) {echo "selected";}?> >above 20lacs to 30lacs</option>
      <option value="above_30lacs" <? if($loan_amount=="above_30lacs") { echo "selected";}?>>above 30lacs to 75lacs</option>
      <option value="above_75lacs" <? if($loan_amount=="above_75lacs" ) { echo "selected";}?>>above 75lacs</option>
    </select></td>
        </tr>
    </table>
  </div>
  <div class="click_input_section">
    <table width="99%" border="0" cellpadding="0" cellspacing="2">
      <tr>
        <td width="49%" class="tbl_txt"><b>Loan Tenure</b></td>
      </tr>
      <tr>
        <td align="center"><select name="loan_tenure" class="hli_input_text"> 
	<option value="PLease Select">PLease Select</option>
	<option value="1" <? if($loan_tenure=="1") { echo "selected";}?>>Upto 5yrs</option>
	<option value="2" <? if($loan_tenure=="2") { echo "selected";}?>>From 5yrs to 10yrs</option>
	<option value="3" <? if($loan_tenure=="3") { echo "selected";}?>>From 10yrs to 15yrs</option>
	<option value="4" <? if($loan_tenure=="4") { echo "selected";} elseif(!isset($msg)) {echo "selected";}?>>From 15yrs to 20yrs</option>
	<option value="5" <?if($loan_tenure=="5") { echo "selected";}?>>From 20yrs to 25yrs</option>
	</select></td>
      </tr>
    </table>
  </div>
  <div class="click_input_btn"><input type="image" src="http://www.deal4loans.com/images/gt-intrate.gif"  style="border:0px;" value="submit" name="none" /></div>
  </div>
  </form>
 
  <div class="continer_boxes">

<div style="width:100%; float:left;">


<table width="98%"   border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">

<tr bgcolor="#E8F0F6"><td width="16%" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Bank Name<br>
</td>
<td width="16%" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Floating Interest rate<br></td>
<td width="16%" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Per lac EMI<br></td>
<td width="14%" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">% Change in Rates</td>
<td width="18%" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Processing Fee</td>
<td width="20%" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Prepayment Charges</td>
</tr>

<tr bgcolor="#F6F4ED"><td width="16%" height="40"  bgcolor="#FFFFFF" class="tbl_txt"><a href="<? echo $urlinfo;?>"><b>DHFL</b> </a><img src="new-images/green-arrow.png" title="% Decrease in Rate" border=0 style="padding-left:5px;"/>

</td>
<td width="16%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b>11%</b></td>
<td width="16%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;">Rs.1032</td>
<td width="14%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b>2.33% <img src="new-images/green-arrow.png" title="% Decrease in Rate" border=0 /></b></td>
<td width="18%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;">1% for Salaried & 1.5% for SENP</td>
<td width="20%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;">NIL</td>
</tr>
<tr bgcolor="#F6F4ED"><td width="16%" height="40" bgcolor="#FFFFFF" class="tbl_txt">
<a href="<? echo $urlinfo;?>"><b>Federal Bank
</b> </a><img src="new-images/red-arrow.png" title="% Increase in Rate" border=0 style="padding-left:5px;"/>

</td>
<td width="16%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><strong>10.48%</strong></td>
<td width="16%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;">Rs.997</td>
<td width="14%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b>2.24% </b><img src="new-images/red-arrow.png" title="% Increase in Rate" border=0 /></td>
<td width="18%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;">10,000 + Service Tax</td>
<td width="20%" align="center" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;">NIL</td>
</tr>
<tr bgcolor="#F6F4ED"><td width="16%" height="40" bgcolor="#FFFFFF" class="tbl_txt">
<a href="<? echo $urlinfo;?>"><b>IDBI</b></a>
</td>
<td width="16%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b>10.25%</b></td>
<td width="16%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;">Rs.982</td>
<td width="14%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b>Same</b></td>
<td width="18%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;">Up to .50%of loan amount
(Rs 2500 to be collected at login and balance at the time of sanction ) </td>
<td width="20%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;">If Balance Transfer then 2% Otherwise Nil</td>
</tr>


	<tr bgcolor="#F6F4ED"><td width="16%" height="40"  bgcolor="#FFFFFF" class="tbl_txt">
<a href="<? echo $urlinfo;?>"><b>Canara Bank

</b> </a><img src="new-images/green-arrow.png" title="% Increase in Rate" border=0 style="padding-left:5px;"/>
</td>
<td width="16%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b>9.95%
</b></td>
<td width="16%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;">Rs.995</td>
<td width="14%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b>2.93%</b><img src="new-images/green-arrow.png" title="% Decrease in Rate" border=0 /></td>
<td width="18%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;">N.A</td>
<td width="20%" align="center"  bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;">N.A</td>
</tr>
</table>
</div>
<div style="clear:both;"></div>
  </div></div>


</div>
<div style="clear:both;"></div>
  <div class="content_c_mobo"> <div  class="content_section_below" ><span class="text11" style="color:#4c4c4c; width:950px;  margin-top:10px;">Before apply for home loan, Calculate your home loan emi with <a href="home-loan-emi-calculator1.php">Home Loan EMI Calculator</a></span></div>
  <div style="margin-top:10px;" class="content_section_below"><span class="text11" style="color:#4c4c4c; width:950px;  margin-top:10px;"><b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br />
Banks/ Financial Institutions can contact us at <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates. </span></div>
  
  </div>
  
<div class="hli_rates_footer"><div align="center" style="padding-top:10px;"><a href="http://www.americanexpressindia.co.in/platinumTravel.aspx?siteid=Deal4loanPlatinumTravelCard&adunit=PlatinumTravelCard_728x90SeptDec&banner=PlatinumTravelCard_SeptDec&campaign=PlatinumTravelCard&marketingagency=interactive" target="_blank" style="text-decoration:none;"><img src="new-images/cc/Amex_banner728x90oct12.jpg" width="728" height="90" border="0" /></a></div></div>
<div style="text-align:center; width:100%;">
<?php
include "responsive_footer.php";
?></div>

</div>

<div class="hli_rates_footer"><?php //include "home_loan_footer_form.php"; ?> 
<?php include "footer1.php"; ?></div>
</body>
</html>