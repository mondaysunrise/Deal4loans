<?php
	ob_start( 'ob_gzhandler');
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$loan_amount=trim($_REQUEST["loan_amount"]);
		$loan_tenure = trim($_REQUEST["loan_tenure"]);
		$bank_name = trim($_REQUEST["sel_bank_name"]);
		$sel_bank_name= trim($_REQUEST["sel_bank_name"]);

		if(strlen($bank_name)>0)
		{
			$field="perlac_".$loan_amount;
			$field_nw="percentage_".$loan_amount;
			$selectresult="select  bank_name,".$loan_amount.",".$field.",".$field_nw.",prepayment_charges,processing_fee,bank_url,priority from `home_loan_interest_rate_chart` where  (tenure='".$loan_tenure."' and flag=1 and bank_name='".$bank_name."') order by  priority ASC";
		}
		else
		{
			$field="perlac_".$loan_amount;
			$field_nw="percentage_".$loan_amount;
			$selectresult="select  bank_name,".$loan_amount.",".$field.",".$field_nw.", prepayment_charges,processing_fee,bank_url,priority from `home_loan_interest_rate_chart` where  (tenure='".$loan_tenure."' and flag=1) order by  priority ASC";
		}
		echo $selectresult."<br>";
		 list($recordcount,$multiget[$i])=MainselectfuncNew($selectresult,$array = array());
		$msg="valid";
	}
	else
	{
		$selectgetresult="select  bank_name,upto_30lacs, perlac_upto_30lacs,prepayment_charges,processing_fee,bank_url,percentage_upto_30lacs, priority from `home_loan_interest_rate_chart` where ( tenure='4' and flag=1) order by  priority ASC";
	 list($newrecordcount,$newmultiget)=MainselectfuncNew($selectgetresult,$array = array());
		
	$getmsg="valid";
	}
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
<div style="padding-top:10px;">
<?php
$newsource="hl interest rate apply";
$subjectLine="Get Exact Quote on Home Loan Interest Rates From all Banks";
//include "RightHLS1.php";
include "RightHLS1short.php";
?></div>
<div style="clear:both;"></div>
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
	
	 list($recordcount,$bnkn)=MainselectfuncNew($selectbankresult,$array = array());
		$cntr=0;
		while($cntr<count($bnkn))
        {
 			?>
  <option value="<? echo $bnkn[$cntr]['bank_name']; ?>" <? if($sel_bank_name==$bnkn[$cntr]['bank_name'] ) { echo "selected";}?>><? echo $bnkn[$cntr]['bank_name']; ?></option>
          <?  $cntr = $cntr +1;}
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

<? if($msg=="valid" && (!isset($getmsg)))
{?>
<tr bgcolor="#E8F0F6"><td width="148" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Bank Name<br>
</td>
<td width="163" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Floating Interest rate<br></td>
<td width="164" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Per lac EMI<br></td>
<td width="175" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Processing Fee</td>
<td width="167" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Prepayment Charges</td>
<td width="127" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">% Change in last 6 mths</td>

</tr>
<? $i=0;
		if($recordcount>0)
		{	
			
				while($i<count($multiget))
        {
				if(strlen($multiget[$i]["bank_url"])>0)
				{
					$geturlinfo=$multiget[$i]["bank_url"];
					if($_SESSION['siten']=="ndtv")
					{
						$geturlinfo .= $geturlinfo."?site=ndtv";
					}
				}
				else
				{
					$geturlinfo="#";
				}
			
				if($i%2==0)
				{	
					$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0"  />';	
				}
				else
				{
					$atag = '<img src="images/apl-yelo1.gif" width="87" height="25" border="0"  />';
				}
				?>
                <tr bgcolor="#F6F4ED"><td width="148" height="25" valign="top" bgcolor="#FFFFFF" class="tbl_txt">
        <?php
			if($multiget[$i]["bank_name"]=="ICICI Bank" || $multiget[$i]["bank_name"]=="HDFC Ltd" || $multiget[$i]["bank_name"]=="HSBC Bank" || $multiget[$i]["bank_name"]=="AXIS Bank" || $multiget[$i]["bank_name"]=="ING Vysya" || $multiget[$i]["bank_name"]=="Kotak Bank")
			{
			
		?>    
            <a href="<? echo $geturlinfo;?>"><b><? echo $multiget[$i]["bank_name"];?></b></a>
            <?php
            }
			else if ($multiget[$i]["bank_name"]=="UCO Bank" || $multiget[$i]["bank_name"]=="Canara Bank" || $multiget[$i]["bank_name"]=="Syndicate Bank" || $multiget[$i]["bank_name"]=="Federal Bank" || $multiget[$i]["bank_name"]=="Development Credit Bank")
			{
?>
<strong>			<? echo $multiget[$i]["bank_name"];?></strong>
<?php			
			}

            else
            {
?>
            <a href="<? echo $geturlinfo;?>"><b><? echo $multiget[$i]["bank_name"];?></b></a>
<strong>           <?php 	//echo $multiget[$i]["bank_name"]; ?></strong>
  
  <?php
            }
            ?>
            </td>
			<td width="163" align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b><? echo $multiget[$i]["".$loan_amount.""];?></b></td>
			<td width="164" align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b><? $field="perlac_".$loan_amount;
			echo $multiget[$i]["".$field.""];?></b></td>
			<td width="175" align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? echo $multiget[$i]["prepayment_charges"];?></td>
			<td width="167" align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? echo $multiget[$i]["processing_fee"];?></td>
			<td width="127" align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? $field="percentage_".$loan_amount;
			//echo $multiget[$i]["".$field.""]; 

 if($multiget[$i]["".$field.""]==1)
			{
				echo "<b>No Change</b>";
			}
			elseif($multiget[$i]["".$field.""]=="0.00")
			{
				echo "<b>N.A</b>";
			}
			else
			{
				
				echo "<table cellpadding='2' cellspacing='0' align='center'>
			<tr><td class='tbl_txt' style='text-align:center;'><b>".$multiget[$i]["".$field.""]."</b></td>";			
		
		if($multiget[$i]["bank_name"]=="Federal Bank")
	{
			
			?><td><img src="new-images/red-arrow.png" title="% Increase in Rate" border=0 /></td>
			
			<?
	}
	else
	{
			?><td><img src="new-images/green-arrow.png" title="% Decrease in Rate" border=0 /></td>
			
			<? } echo "</tr></table>";} ?></td>
			
		</tr>
	<?						$i=$i+1;
		}
		}
}	?>
<? if($getmsg=="valid" && (!isset($msg)))
{?>
<tr bgcolor="#E8F0F6"><td width="148" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Bank Name<br>
</td>
<td width="163" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Floating Interest rate<br></td>
<td width="164" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Per lac EMI<br></td>
<td width="175" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Processing Fee</td>
<td width="167" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">Prepayment Charges</td>
<td width="127" height="25" align="center" bgcolor="#88a943" class="tbl_txt" style="font-weight:bold; color:#FFFFFF;">% Change in last 6 mths</td>
</tr>
<? $j=0;
 
			while($j<count($newmultiget))
       	 {
			if(strlen($newmultiget[$j]["bank_url"])>0)
			{
				$urlinfo=$newmultiget[$j]["bank_url"];
			}
			else
			{
				$urlinfo="#";
			}
			
			if($j%2==0)
			{	
				$atag = '<img src="images/apl-yelo.gif" width="87" height="25" border="0" />';	
			}
			else
			{
				$atag = '<img src="images/apl-yelo1.gif" width="87" height="25" border="0" />';
			}
	?>		
		<tr bgcolor="#F6F4ED"><td width="148" height="25" valign="top" bgcolor="#FFFFFF" class="tbl_txt">
            <?php
			if($newmultiget[$j]["bank_name"]=="ICICI Bank" || $newmultiget[$j]["bank_name"]=="HDFC Ltd" || $newmultiget[$j]["bank_name"]=="HSBC Bank" || $newmultiget[$j]["bank_name"]=="AXIS Bank" || $newmultiget[$j]["bank_name"]=="ING Vysya" || $newmultiget[$j]["bank_name"]=="Kotak Bank")
			{
			?>
            <a href="<? echo $urlinfo;?>"><b><? echo $newmultiget[$j][0];?></b></a>
            <?php
			}
			else if ($newmultiget[$j]["bank_name"]=="UCO Bank" || $newmultiget[$j]["bank_name"]=="Canara Bank" || $newmultiget[$j]["bank_name"]=="Syndicate Bank" || $newmultiget[$j]["bank_name"]=="Federal Bank" || $newmultiget[$j]["bank_name"]=="Development Credit Bank")
			{
?>
<strong>			<? echo $newmultiget[$j][0];?></strong>
<?php			
			}
			else
			{
			?>
                  <a href="<? echo $urlinfo;?>"><b><? echo $newmultiget[$j][0];?></b></a>
<strong>			<? //echo $newmultiget[$j][0];?></strong>
            <?php
			}
            ?>
            </td>
		  <td width="163" align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b><? echo $newmultiget[$j][1];?></b></td>
		  <td width="164" align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? echo $newmultiget[$j][2];?></td>
		  <td width="175" align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? echo $newmultiget[$j][3];?></td>
		  <td width="167" align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? echo $newmultiget[$j][4];?></td>
		  <td width="127" align="center" valign="top" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? if($newmultiget[$j][6]==1)
			{
				echo "<b>No Change</b>";
			}
			elseif($newmultiget[$j][6]=="0.00")
			{
				echo "<b>N.A</b>";
			}
			else
			{
				echo "<table cellpadding='2' cellspacing='0' align='center'>
			<tr><td class='tbl_txt' style='text-align:center;'><b>".$newmultiget[$j][6]."</b></td>";			
		
		if($newmultiget[$j]["bank_name"]=="Federal Bank")
	{
			
			?><td><img src="new-images/red-arrow.png" title="% Increase in Rate" border=0 /></td>
			
			<?
	}
	else
	{
			?><td><img src="new-images/green-arrow.png" title="% Decrease in Rate" border=0 /></td>
			
			<? } echo "</tr></table>";} ?></td>
		</tr>
	<?	$j=$j+1;
	}
}?>



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