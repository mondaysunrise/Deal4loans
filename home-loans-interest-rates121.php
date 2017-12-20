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
			$selectresult="select  bank_name,".$loan_amount.", prepayment_charges,processing_fee,bank_url,priority from `home_loan_interest_rate_chart` where  (tenure='".$loan_tenure."' and flag=1 and bank_name='".$bank_name."') order by  priority ASC";
		}
		else
		{
			$selectresult="select  bank_name,".$loan_amount.", prepayment_charges,processing_fee,bank_url,priority from `home_loan_interest_rate_chart` where  (tenure='".$loan_tenure."' and flag=1) order by  priority ASC";
		}
		list($recordcount,$multiget)=MainselectfuncNew($selectresult,$array = array());

		$msg="valid";
	}
	else
	{
		$selectgetresult="select  bank_name,upto_30lacs, prepayment_charges,processing_fee,bank_url, priority from `home_loan_interest_rate_chart` where ( tenure='4' and flag=1) order by  priority ASC";
list($newrecordcount,$newmultiget)=MainselectfuncNew($selectgetresult,$array = array());
	$getmsg="valid";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home Loan Rates | Home Loan Interest Rates | Home Loan Comparison Rate | Deal4loans</title>
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<meta http-equiv="Content-Language" content="en-us">
<meta name="keywords" content="Home Loan Rates, Home Loan Interest Rates, Home loans, Home loan, Home loans India, Home loan in India, Home loan interest rates,  Home loan rates in India, Home finance loans, compare Home loan rates, Home loans at least interest rate">
<meta name="Description" content="Home loan rates comparison with various banks. Know processing fee, Special Interest rates for salaried and self employed personnel / professionals. Compare home loan interest rates from Allahabad Bank, AXIS Bank , Barclays Bank, Corporation Bank, Dena Bank, DHFL HFC, Deutsche Post, Federal Bank, HDFC, ICICI Home Finance, Bank of Baroda, IDBI Bank, ING VYSYA, Oriental Bank of Commerce, Kotak, LIC housing, Punjab National Bank, Standard Chartered, SBI, Union Bank of India, Vijaya Bank.">
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<link href="source.css" rel="stylesheet" type="text/css" />
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
	{        alert("Please Enter Your name");				document.hlloan_form.Name.focus();		return false;	}
	if(document.hlloan_form.Name.value!="")
	{
		if(containsdigit(document.hlloan_form.Name.value)==true)
		{			alert("Full Name contains numbers!");			document.hlloan_form.Name.focus();	return false;		}	
	}
   
   for (var i = 0; i <document.hlloan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.hlloan_form.Name.value.charAt(i)) != -1) 
		{			alert("Contains special characters!");	document.hlloan_form.Name.focus(); return false;	}  
	}
	  if(document.hlloan_form.Email.value=="")
	  {		alert("Enter  Email Address!");			document.hlloan_form.Email.focus();		return false;	}
	var str=document.hlloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{		alert("Enter Valid Email Address!");			document.hlloan_form.Email.focus();		return false;	}
	else if(bb==-1)
	{		alert("Enter Valid Email Address!");			document.hlloan_form.Email.focus();		return false;	}
	if (document.hlloan_form.City.selectedIndex==0)
	{		alert("Enter City to Continue!");			document.hlloan_form.City.focus();		return false;	}
	if((document.hlloan_form.City.value=="Others") && ((document.hlloan_form.City_Other.value=="" || document.hlloan_form.City_Other.value=="Other City"  ) || !isNaN(document.hlloan_form.City_Other.value)))
	{		alert("Enter Other City to Continue!");				document.hlloan_form.City_Other.focus();		return false;	}
	for (var i = 0; i <document.hlloan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.hlloan_form.City_Other.value.charAt(i)) != -1) {
		alert("Remove Special Characters!");			document.hlloan_form.City_Other.focus();  		return false;  	}
  }
  if(document.hlloan_form.Phone.value=="")
  {		alert("Fill Mobile Number!");		document.hlloan_form.Phone.focus();		return false;	}
	if(isNaN(document.hlloan_form.Phone.value)|| document.hlloan_form.Phone.value.indexOf(" ")!=-1)
	{		alert("Enter numeric value!");		document.hlloan_form.Phone.focus();		return false;  	}
	if (document.hlloan_form.Phone.value.length < 10 )
	{	  	alert("Enter 10 Digits!");			document.hlloan_form.Phone.focus();		return false;	}
	if ((document.hlloan_form.Phone.value.charAt(0)!="9") && (document.hlloan_form.Phone.value.charAt(0)!="8") && (document.hlloan_form.Phone.value.charAt(0)!="7"))
	{	  	alert("should start with 9 or 8 or 7!");			document.hlloan_form.Phone.focus();		return false;	}
	if (document.hlloan_form.IncomeAmount.value=="")
	{		alert("Enter Annual Income!");			document.hlloan_form.IncomeAmount.focus();		return false;	}	
	if(!checkNum(document.hlloan_form.IncomeAmount, 'Annual Income',0))
		return false;
}

function containsdigit(param){	mystrLen = param.length;	for(i=0;i<mystrLen;i++)	{		if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))		{			return true;		}	}	return false; }
function Trim(strValue) {	var j=strValue.length-1;i=0;	while(strValue.charAt(i++)==' ');	while(strValue.charAt(j--)==' ');	return strValue.substr(--i,++j-i+1); }
function othercity1(){	if(document.hlloan_form.City.value=='Others')		document.hlloan_form.City_Other.disabled=false;	else		document.hlloan_form.City_Other.disabled=true; }
</script>
</head>
<body>
<?php include "top-menu.php"; include "main-menu.php"; ?>
<? $tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")); $currentdate=date('d F Y',$tomorrow); ?>
<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <span class="text12" style="color:#4c4c4c;">>Home Loan Interest Rates </span></div>
<div style="clear:both; height:15px;"></div>
<div class="intrl_txt">
<table align="center" ><tr><td width="72%" >
<h1 class="text3" style="width:500px; height:33; margin-top:0px; float:left; clear:right; font-size:36px; text-transform:none; color:#88a943;"><strong>Home Loan Interest Rates</strong><br />
<span style="font-size:12px; font-weight:normal; ">(Last edited on : <? echo $currentdate; ?>)</span></h1></td><td width="28%"><a href="/home-loan-balance-transfer-calculator.php" style="text-decoration:none;"><img src="http://www.deal4loans.com/new-images/hl-baltrnfr.jpg" /></a></td>
   </tr></table>
<div style=" margin-left:15px; float:left; width:970px; height:2px;; margin-top:1px; "><img src="images/point5.gif" width="970" height="2" /></div>
<div class="text11" style="color:#4c4c4c; width:950px; margin-left:20px; margin-top:10px;">
Buying your first home can seem intimidating, especially when faced with many different loan types. Don't worry. Use this list to compare and narrow down the choices to know which is the best.<br>
To help its customers get the best interest rates on <a href="home-loans.php">home loans</a> deal4loans has consolidated all the information regarding current rate of interest for all the banks at one place. Please keep visiting this section to check updated rate of interest for home loans.<br /><div id="wd_id"></div><script type="text/javascript" src="http://www.admissioncorner.com/discussions/widet.js"></script><script type="text/javascript">init_widget()</script>
<table width="663" border="0" align="center" cellpadding="0" cellspacing="0" style="padding-top:10px;">
<tr>
   <td align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="10" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="10" /></td>
      </tr>
      <tr>
        <td height="30" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="text3" style=" color:#FFF; font-size:16px; text-transform:none; font-weight:bold;" align="center">Get Exact Quote on Home Loan Interest Rates From all Banks</td>
          </tr>
          </table></td>
      </tr>
      <tr>
        <td  align="center" valign="top" bgcolor="#21405F">
		<form name="hlloan_form" method="post" action="home-loans-interest-rates-continue.php" onSubmit="return chkhomeloan();">
		<input type="hidden" name="source" value="hl interest rate apply"> 
<input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<table width="943" border="0" cellpadding="0" cellspacing="8">
		<tr>
			<td class="text" style="color:#FFF; font-size:12px; text-transform:none;">Full Name:</td>
			<td><input name="Name" id="Name" type="text" style="width:140px; height:12px;" tabindex="1" /></td>
		   <td class="text" style="  color:#FFF; font-size:12px; text-transform:none;">Email:</td>
			<td> <input name="Email" id="Email" type="text" style="width:140px; height:12px;" onKeyDown="validateDiv('emailVal');"  tabindex="3" /></td>
			<td class="text" style="  color:#FFF; font-size:12px; text-transform:none;">City:</td>
			<td> <select name="City" id="City" style="width:140px; height:18px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"  onchange="othercity1();" tabindex="5">
                            <?=getCityList($City)?>
                                       </select></td>		 
<td class="text" style="  color:#FFF; font-size:12px; text-transform:none;" width="80">Other City:</td>
<td> <input name="City_Other" id="City_Other" type="text" style="width:140px; height:12px;" disabled="disabled" tabindex="6"/></td>
		</tr>
		<tr> <td class="text" style="  color:#FFF; font-size:12px; text-transform:none; padding-top:8px;">Mobile:</td><td class="text" style="width:26px;  color:#FFF; font-size:12px; text-transform:none; clear:right; margin-top:3px; "> +91&nbsp;<input name="Phone" id="Phone" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; onChange="intOnly(this);" type="text" style="width:117px; height:12px;" onKeyDown="validateDiv('phoneVal');"  tabindex="2"/></td><td class="text" style="  color:#FFF; font-size:12px; text-transform:none;" >Annual Salary:</td>
		  <td><input type="text" name="IncomeAmount" id="IncomeAmount" style="width:140px; height:12px;"  onkeyup="intOnly(this); " onkeypress="intOnly(this);" tabindex="4"/></td>
		  <td colspan="4" valign="top"><table cellpadding="0" cellspacing="0" width="100%">
<tr><td  style="color:#FFF; font-size:11px; text-transform:none;" width="314">
<input name="accept" type="checkbox" checked="checked" />            
                   I Agree to&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">privacy policy</a> and&nbsp;<a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#88a943; font-size:11px; text-decoration:underline;">Terms and Conditions</a>.</td>
  <td width="115"><input name="submit" type="submit" style="border: 0px none ; background-image: url(images/get1-nw.jpg); background-repeat:no-repeat; width: 104px; height: 30px; margin-bottom: 2px;" value=""/></td>
</tr></table></td></tr>
		  <tr><td colspan="2"></td><td colspan="2" width="160"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#ffffff;font-Family:Verdana;text-transform: capitalize;'></span></td>
<td colspan="4"></td>
</tr>
		</table>
		</form>
		</td>
      </tr>
     <tr>
        <td height="10" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="10" /></td>
      </tr>
    </table></td>
  </tr>
</table> 
	<div style="padding:10px 0px;"><div style="font-size:12px; font-weight:bold; text-align:center; line-height:20px;">Check Home Loan Interest Rates</div>
<form name="hlinterest" action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <table width="710" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="75"><img src="images/lft-int-corn.gif" width="10" height="75"></td>
    <td align="center" valign="middle" style="border-top:1px solid  #d2d2d2; border-bottom:1px solid  #d2d2d2;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
	  <td width="94" height="22" align="center" valign="middle"><b>Bank Name</b></td>
        <td width="216" height="22" align="center" valign="middle"><b>Loan Amount</b></td>
        <td width="200" align="center" valign="middle"><b>Loan Tenure</b></td>
        <td width="200" height="52" rowspan="2" style="padding:2px;"><input type="image" src="images/gt-intrate.gif"  style="border:0px;" value="submit" name="none" /></td>
      </tr>
      <tr>
	  <td height="22" align="center" valign="middle" style="padding:2px;"><select name="sel_bank_name" id="sel_bank_name"><option value="">ALL</option><? 
	  
	  $selectbankresult="select bank_name from `home_loan_interest_rate_chart` where  (flag=1) group by bank_name order by bank_name ASC";
	echo "uihiyuiu".$selectbankresult."<br>";
list($num,$bnkn)=MainselectfuncNew($selectbankresult,$array = array());


	for($i=0;$i<$num;$i++)
		{ echo "hello"; ?>
<option value="<? echo $bnkn['bank_name']; ?>" <? if($sel_bank_name==$bnkn[$i]['bank_name'] ) { echo "selected";}?>><? echo $bnkn[$i]['bank_name']; ?></option>
		<? }
	?>
	</select>
	  </td>
        <td height="30" align="center" valign="middle" style="padding:2px;"><select name="loan_amount"> 
	<option value="PLease Select">PLease Select</option>
	<option value="upto_20lacs" <? if($loan_amount=="upto_20lacs" ) { echo "selected";}?>>Upto 20lacs</option>
	<option value="upto_30lacs" <? if($loan_amount=="upto_30lacs" ) { echo "selected";} elseif(!isset($msg)) {echo "selected";}?> >above 20lacs to 30lacs</option>
	<option value="above_30lacs" <? if($loan_amount=="above_30lacs") { echo "selected";}?>>above 30lacs to 75lacs</option>
	<option value="above_75lacs" <? if($loan_amount=="above_75lacs" ) { echo "selected";}?>>above 75lacs</option>
	</select></td>
        <td align="center" valign="middle" style="padding:2px;"><select name="loan_tenure"> 
	<option value="PLease Select">PLease Select</option>
	<option value="1" <? if($loan_tenure=="1") { echo "selected";}?>>Upto 5yrs</option>
	<option value="2" <? if($loan_tenure=="2") { echo "selected";}?>>From 5yrs to 10yrs</option>
	<option value="3" <? if($loan_tenure=="3") { echo "selected";}?>>From 10yrs to 15yrs</option>
	<option value="4" <? if($loan_tenure=="4") { echo "selected";} elseif(!isset($msg)) {echo "selected";}?>>From 15yrs to 20yrs</option>
	<option value="5" <?if($loan_tenure=="5") { echo "selected";}?>>From 20yrs to 25yrs</option>
	</select></td>
        </tr>
    </table></td>
    <td width="10" height="75"><img src="images/rgt-int-corn.gif" width="10" height="75"></td>
  </tr>
</table>
</form>
</div>
<table width="100%"   border="0" cellpadding="0" cellspacing="1" bgcolor="#d5cfb1">
<? if($msg=="valid" && (!isset($getmsg)))
{?>
<tr bgcolor="#88a943"><td width="20%" height="25" align="center" bgcolor="#88a943" class="text11" style="font-weight:bold; color:#FFFFFF;"> Bank Name<br>
<img src="images/spacer.gif" width="150" height="1" border="0" ></td>
<td width="34%" height="25" align="center" bgcolor="#88a943" class="text11" style="font-weight:bold; color:#FFFFFF; clear:both">Floating Interest rate<br>
<img src="images/spacer.gif" width="120" height="1" border="0" ></td>
<td width="20%" height="25" align="center" bgcolor="#88a943" class="text11" style="font-weight:bold; color:#FFFFFF;">Processing Fee</td>
<td width="26%" height="25" align="center" bgcolor="#88a943" class="text11" style="font-weight:bold; color:#FFFFFF;">Prepayment Charges</td>

<!--<td width="26%" height="25" align="center" bgcolor="#88a943" class="text11" style="font-weight:bold; color:#FFFFFF;">Apply</td> -->
</tr>
<? $i=0;
		if($recordcount>0)
		{	
			for($jj=0;$jj<$newrecordcount;$jj++)
			{
				if(strlen($multiget[$jj]["bank_url"])>0)
				{
					$geturlinfo=$multiget[$jj]["bank_url"];
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
			<tr bgcolor="#F6F4ED"><td height="25" bgcolor="#FFFFFF" class="text11">
        <?php
			if($multiget[$jj]["bank_name"]=="ICICI Bank" || $multiget[$jj]["bank_name"]=="HDFC Ltd" || $multiget[$jj]["bank_name"]=="HSBC Bank" || $multiget[$jj]["bank_name"]=="AXIS Bank" || $multiget[$jj]["bank_name"]=="ING Vysya" || $multiget[$jj]["bank_name"]=="Kotak Bank")
			{
			
		?>    
            <a href="<? echo $geturlinfo;?>"><b><? echo $multiget[$jj]["bank_name"];?></b></a>
            <?php
            }
			else if ($multiget[$jj]["bank_name"]=="UCO Bank" || $multiget[$jj]["bank_name"]=="Bank of Baroda" || $multiget[$jj]["bank_name"]=="Canara Bank" || $multiget[$jj]["bank_name"]=="Syndicate Bank" || $multiget[$jj]["bank_name"]=="Federal Bank" || $multiget[$jj]["bank_name"]=="Development Credit Bank")
			{
?>
<strong>			<? echo $multiget[$jj]["bank_name"];?></strong>
<?php			
			}

            else
            {
?>
            <a href="<? echo $geturlinfo;?>"><b><? echo $multiget[$jj]["bank_name"];?></b></a>
<strong>           <?php 	//echo $multiget[$jj]["bank_name"]; ?></strong>
  
  <?php
            }
            ?>
            </td>
			<td align="center" bgcolor="#FFFFFF" class="text11" style="text-align:center;"><b><? echo $multiget[$jj]["".$loan_amount.""];?></b></td>
			<td align="center" bgcolor="#FFFFFF" class="text11" style="text-align:center;"><? echo $multiget[$jj]["prepayment_charges"];?></td>
			<td align="center" bgcolor="#FFFFFF" class="text11" style="text-align:center;"><? echo $multiget[$jj]["processing_fee"];?></td>
			<!--<td height="35" align="center" valign="middle" bgcolor="#FFFFFF" > -->
			<?php
			if($multiget[$jj]["bank_name"]=="ICICI Bank" || $multiget[$jj]["bank_name"]=="HDFC Ltd" || $multiget[$jj]["bank_name"]=="HSBC Bank" || $multiget[$jj]["bank_name"]=="AXIS Bank" || $multiget[$jj]["bank_name"]=="ING Vysya" || $multiget[$jj]["bank_name"]=="Kotak Bank")
			{
			
				if($multiget[$jj]["priority"]==3)
				{ ?>
				<? }
				else
				{
				?>
				
				<?php
				}
				
			}
			?>
			
           <!-- </td> -->
			</tr>
	<?						$i=$i+1;
		}
		}
}	?>
<? if($getmsg=="valid" && (!isset($msg)))
{?>
<tr bgcolor="#E8F0F6"><td height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; color:#FFFFFF;">Bank Name<br>
<img src="images/spacer.gif" width="150" height="1" border="0" ></td>
<td height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; color:#FFFFFF;">Floating Interest rate<br><img src="images/spacer.gif" width="120" height="1" border="0" ></td>
<td height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; color:#FFFFFF;">Processing Fee</td>
<td height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; color:#FFFFFF;">Prepayment Charges</td>
<!--<td height="25" align="center" bgcolor="#88a943" class="tbletext" style="font-weight:bold; color:#FFFFFF;">Apply</td> -->
</tr>
<? $j=0;
for($jj=0;$jj<$newrecordcount;$jj++)
		{
			if(strlen($newmultiget[$jj]["bank_url"])>0)
			{
				$urlinfo=$newmultiget[$jj]["bank_url"];
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
			<tr bgcolor="#F6F4ED"><td height="25" bgcolor="#FFFFFF" class="tbl_txt">
            <?php
			if($newmultiget[$jj]["bank_name"]=="ICICI Bank" || $newmultiget[$jj]["bank_name"]=="HDFC Ltd" || $newmultiget[$jj]["bank_name"]=="HSBC Bank" || $newmultiget[$jj]["bank_name"]=="AXIS Bank" || $newmultiget[$jj]["bank_name"]=="ING Vysya" || $newmultiget[$jj]["bank_name"]=="Kotak Bank")
			{
			?>
            <a href="<? echo $urlinfo;?>"><b><? echo $newmultiget[$jj][0];?></b></a>
            <?php
			}
			else if ($newmultiget[$jj]["bank_name"]=="UCO Bank" || $newmultiget[$jj]["bank_name"]=="Bank of Baroda" || $newmultiget[$jj]["bank_name"]=="Canara Bank" || $newmultiget[$jj]["bank_name"]=="Syndicate Bank" || $newmultiget[$jj]["bank_name"]=="Federal Bank" || $newmultiget[$jj]["bank_name"]=="Development Credit Bank")
			{
?>
<strong>			<? echo $newmultiget[$jj][0];?></strong>
<?php			
			}
			else
			{
			?>
                  <a href="<? echo $urlinfo;?>"><b><? echo $newmultiget[$jj][0];?></b></a>
<strong>			<? //echo $newmultiget[$jj][0];?></strong>
            <?php
			}
            ?>
            </td>
			<td align="center" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><b><? echo $newmultiget[$jj][1];?></b></td>
			<td align="left" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? echo $newmultiget[$jj][2];?></td>
			<td align="center" bgcolor="#FFFFFF" class="tbl_txt" style="text-align:center;"><? echo $newmultiget[$jj][3];?></td>
			<!--<td height="35" align="center" valign="middle" bgcolor="#FFFFFF" > -->
			<?php
			if($newmultiget[$jj]["bank_name"]=="ICICI Bank" || $newmultiget[$jj]["bank_name"]=="HDFC Ltd" || $newmultiget[$jj]["bank_name"]=="HSBC Bank" || $newmultiget[$jj]["bank_name"]=="AXIS Bank" || $newmultiget[$jj]["bank_name"]=="ING Vysya" || $newmultiget[$jj]["bank_name"]=="Kotak Bank")
			{
				if($newmultiget[$jj][5]==3)
				{ ?>
			
				<? }
				else
				{
				?>
			
				<?php
				}
			}
			?>
			<!--</td> -->
			</tr>
	<?	$j=$j+1;
	}
}?>
</table>
	   <div style="height:30px; padding-top:10px;">Before apply for home loan, Calculate your home loan emi with <a href="/home-loan-emi-calculator1.php">Home Loan EMI Calculator</a></div>     <br /> 
    <b>Disclaimer:</b> Please note that the interest rates given here are based on the market research. To enable the comparisons certain set of data has been reorganized / restructured / tabulated .Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.<br>
Banks/ Financial Institutions can contact us at  <a href="mailto:customercare@deal4loans.com" style="color:#0F74D4;">customercare@deal4loans.com</a> for inclusions or updates.  
</div></div>
<?php include "home_loan_footer_form.php"; ?> 
<?php include "footer_hl.php"; ?>
</body>
</html>