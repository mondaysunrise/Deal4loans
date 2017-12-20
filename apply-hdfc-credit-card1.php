<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$Dated = ExactServerdate();
//print_r($_POST);

	$ccuserid = $_REQUEST['RequestID'];
$cc_bankid = $_REQUEST['cc_bankid'];


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
			$$a=$b;

	$company_cate_type = $_POST["company_cate_type"];
	$Std_Code1= $_POST["Std_Code1"];
	$Std_Code2= $_POST["Std_Code2"];
	$Phone1= $_POST["Phone1"];
	$Phone2= $_POST["Phone2"];
	$ext= $_POST["ext"];
	$existing_rel = $_POST["existing_rel"];
	$landline_o=$Phone2."-".$ext;	
if($cc_bankid==10)
	{
	$Descr="HDFC Gold Card";
}
else if ($cc_bankid==28)
	{
$Descr="HDFC Bank Titanium Edge Card";
	}
	else if ($cc_bankid==15)
	{
$Descr="HDFC Platinum Plus Card";
	}
	else if ($cc_bankid==30)
	{
$Descr="HDFC Bank Titanium Times Card";
	}
	else if ($cc_bankid==35)
	{
$Descr="HDFC Bank Platinum Edge";
	}
	else if ($cc_bankid==36)
	{
$Descr="HDFC Bank Diners Club Premium";
	}
	else if ($cc_bankid==37)
	{
$Descr="HDFC Bank Diners Club Rewardz";
	}

$hdfcd="select Descr,applied_card_name from Req_Credit_Card Where (RequestID='".$ccuserid."')";
//$hdfcrow=mysql_fetch_array($hdfcd);
list($GetnumVal,$hdfcrow)=Mainselectfunc($hdfcd,$array = array());

if(strlen($hdfcrow['applied_card_name'])>0)
	{
	$strcrd_nme=$hdfcrow['applied_card_name'].",".$Descr;
	}
	else
	{
		$strcrd_nme=$Descr;
	}

if(strlen($hdfcrow['Descr'])>0)
	{	$hdfrd_nme=$hdfcrow['Descr'].",".$Descr;}
	else
	{	$hdfrd_nme=$Descr;}

//$ccupdate= "Update Req_Credit_Card  set Company_Type='".$company_cate_type."',Std_Code_O='".$Std_Code2."' ,Landline_O='".$Phone2."',Landline='".$Phone1."' ,Std_Code='".$Std_Code1."',Descr='".$hdfrd_nme."',applied_card_name='".$strcrd_nme."',Dated=Now(),Existing_Relationship='".$existing_rel."'  Where (Req_Credit_Card.RequestID=".$ccuserid.")";
	
	
$DataArray = array("Company_Type"=>$company_cate_type, "Std_Code_O"=>$Std_Code2, "Landline_O"=>$Phone2, "Landline"=>$Phone1,"Std_Code"=>$Std_Code1, "Descr"=>$hdfrd_nme, "applied_card_name"=>$strcrd_nme, "Dated"=>$Dated, "Existing_Relationship"=>$existing_rel);
$wherecondition ="(Req_Credit_Card.RequestID=".$ccuserid.")";
Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);
	//ExecQuery($ccupdate);
	//echo $ccupdate."<br>";

	if($existing_rel>0)
	{
		//header("Location: apply-hdfc-credit-card-continue.php?req=".$ccuserid."&ccid=".$cc_bankid."&exstrl=".$existing_rel);
		//exit();
	}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Credit Card | Credit Card Application | Credit Cards Comparison Chart</title>
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="css/credit-card-styles.css" type="text/css" rel="stylesheet">
<script>
function ckhcreditcard(Form)
{
	if(Form.company_cate_type.selectedIndex==0)
	{
		alert("Please enter Company Type Name to Continue");
		Form.company_cate_type.focus();
		return false;
	}
	if(Form.Std_Code1.value=='' || Form.Std_Code1.value=='std' )
	{
	alert("Kindly fill Std Code.");
	Form.Std_Code1.focus();
	return false;
	}
	if(Form.Phone1.value=='')
	{
	alert("Kindly fill Lanline no.");
	Form.Phone1.focus();
	return false;
	}
}
</script>
</head>
<body>
<?php include "middle-menu.php"; ?>

<div style="height:50px;"></div>
<div class="cc_inner_wrapper">
  <!--<span><a href="index.php">Home</a> > <a href="credit-cards.php">Credit Card</a> </span>-->
  <div id="txt" style="padding-top:15px;">
  <? if($company_cate_type>0)
{ ?>
 <h1 class="h1ccnew"> Thanks for applying HDFC Credit Card through Deal4loans.com </h1>
 <? } 
 else
 {?>
 <h1 class="h1ccnew"> Your application for Hdfc Card is 90% complete.<br />
Please fill in few more details for your online application.</h1>

 <? } ?>
  <div style="clear:both;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" >
	<? if($company_cate_type==4 || $company_cate_type==5)
	{ ?>
		<h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; text-align:left;"> We're sorry. As per eligibility criteria of HDFC Bank, We will not be able to offer Credt card Product.</h1>
	<? }
	else
	{ ?>
	<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="border:#edc4b2 solid thin;">
        <tr>
          <td height="35" valign="middle"   class="crdhorizonbg"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="35" colspan="2" bgcolor="#daf5fa" class="thanks-head"><?	if($cc_bankid==28)
				{ ?>
				HDFC Bank Titanium Edge Card
			<? 	}
				else if($cc_bankid==15)
		{ ?>
			HDFC Platinum Plus Card 
	<? }
		else if($cc_bankid==30)
		{ ?>
			HDFC Bank Titanium Times Card
	<? }
	else if ($cc_bankid==35)
	{ ?>
	HDFC Bank Platinum Edge
	<? }
	else if ($cc_bankid==36)
	{ ?>
	HDFC Bank Diners Club Premium
	<? }
	else if ($cc_bankid==37)
	{ ?>
 HDFC Bank Diners Club Rewardz
 <? 
	}
		else 
		{ ?>
				HDFC Credit Card 
				<? } ?></td>
                </tr>
          </table></td>
        </tr>
        <tr>
          <td>
            <div class="thankbox-one">
              <table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="185" align="center" valign="middle" bgcolor="#fffef9">
                    <?	if($cc_bankid==28)
				{ ?>
                    <img src="http://www.deal4loans.com/new-images/hdfc_titanium_edge.jpg"  width="140" height="85"/> 
                    <? 	}
				else if($cc_bankid == 15)
				{ ?>
                    <img src="http://www.deal4loans.com/new-images/hdfc_plt_plus.jpg"  width="140" height="85"/> 
                    <? }
				else if($cc_bankid == 30)
				{ ?>
                    <img src="http://www.deal4loans.com/new-images/hdfc_titatimes_crd.gif"  width="158" height="100"/> 
                    <? }
				else if ($cc_bankid==35)
	{ ?>
                    <img src="http://www.deal4loans.com/new-images/hdfcplatinum_creditcard.jpg"  width="150" height="95"/> 
                    <? }
	else if ($cc_bankid==36)
	{ ?>
                    <img src="http://www.deal4loans.com/new-images/hdfc_dinerprenium.jpg"  width="150" height="95"/> 
                    <? }
	else if ($cc_bankid==37)
	{ ?>
                    <img src="http://www.deal4loans.com/new-images/hdfc_dinersblue.jpg"  width="150" height="95"/> 
                    <? }
				else
		{ echo $Descr; } ?>
                    </td>
                  
                  <? if($company_cate_type>0)
				{

				}
				else {
					?>
                  <? } ?>
  </tr>
  </table>
              
  </div>
  <div class="thankbox-two">
  <table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="369" valign="middle"  bgcolor="#fffef9"><div style="height:7px;"></div>
        <b>Features :</b>
        <? if($cc_bankid==15) 
		{?>
        <div class="thankstext">
          <ul >
            <li>Fee-Rs 399 P.a</li>
            <li>Get 1000 Bonus Reward Points on 1st transaction + 3X Reward Points on online spends.</li>
            <li>2 Reward Points per Rs.150 spent</li>
            <li>50% more Reward Points on incremental spends above Rs.50,000 per statement cycle</li>
            <li>Fuel surcharge waiver of 2.5% across any petrol pump in India</li>
            </ul>
          </div>
        <? } 
		elseif($cc_bankid==28)
		{?>
        <div class="thankstext">
          <ul>
            <li>Fee-Rs 599 P.a</li>
            <li>2 Reward Points for every Rs. 150 you spend.</li>
            <li>Get 1000 Bonus Reward Points on 1st transaction + 3X Reward Points on online spends.</li>
            </ul>
          </div>
        <? }
	elseif($cc_bankid==30)
		{?>
        <div class="thankstext">
          <ul>
            <li>Fee-Rs 500 P.a</li>
            <li>Get movie discounts of Rs. 1,800/- or more in a year!</li>
            <li>Earn big discounts of Rs. 4,500/- or more every year on dining!</li>
            <li>Save Rs. 1,500/- in a year on your fuel transactions!</li>
            <li> 2 Reward Points on every Rs 150 spent.</li>
            <li> 5 Reward Points on every Rs 150 of Dining spends on weekdays </li>
            </ul>
          </div>
        <? }
	elseif($cc_bankid==35)
		{?>
        <div class="thankstext">
          <ul>
            <li>Fee- Life time free</li>
            <li>REDEEM REWARD POINTS AGAINST THE OUTSTANDING BALANCE ON YOUR CREDIT CARD.</li>
            <li> 2 REWARD POINTS PER RS 150 SPENT + 50% MORE REWARD POINTS ON DINING SPENDS </li>
            <li> 100 REWARD POINTS = RS 40 CASHBACK </li>
            <li> ZERO FUEL SURCHARGE FOR TRANSACTIONS BETWEEN RS. 400 AND RS. 5000</li>
            </ul>
          </div>
        <? }
	elseif($cc_bankid==36)
		{?>
        <div class="thankstext">
          <ul>
            <li>Fee- Life time free</li>
            <li>A PREFERRED REWARDS CREDIT CARD FOR FREQUENT SHOPPING </li>
            <li>6 REWARD POINTS PER RS 150 ON GROCERY, SUPERMARKETS, DINING, AIRLINE TICKETING AND ON ALL INCREMENTAL SPENDS GREATER THAN 10000 PER STATEMENT CYCLE </li>
            <li>1000 REWARD POINTS = RS. 400 ( TRAVEL VOUCHERS) REDEEM FOR AIRLINES TICKETS, HOTELS AND MOVIES AT  WWW.HDFCBANKDINERSCLUB.COM </li>
            <li>GLOBAL CONCIERGE 24/7 CALL 01140608635 OR 1800118887</li>
            </ul>
          </div>
        <? }
	elseif($cc_bankid==37)
		{?>
        <div class="thankstext">
          <ul>
            <li>Fee- Life time free</li>
            <li> A PREFERRED REWARDS CREDIT CARD FOR FREQUENT SHOPPING</li>
            <li>6 REWARD POINTS PER RS 150 ON GROCERY, SUPERMARKETS, DINING, AIRLINE TICKETING AND ON ALL INCREMENTAL SPENDS GREATER THAN 10000 PER STATEMENT CYCLE </li>
            <li>1000 REWARD POINTS = RS. 400 ( TRAVEL VOUCHERS) REDEEM FOR AIRLINES TICKETS, HOTELS AND MOVIES AT  WWW.HDFCBANKDINERSCLUB.COM</li>
            <li> GLOBAL CONCIERGE 24/7 CALL 01140608635 OR 1800118887.</li>
            </ul>
          </div>
        <? }
				else 
		{ ?>
        <div class="thankstext">
          <ul>
            <li>From 1st April 2011, earn 50% more Reward Points (i.e total 1.5 Reward Points per Rs. 150) on incremental spends above Rs. 20,000 per statement cycle. </li>
            <li>Annual Fee : 199 Rs. </li>
            <li><b>Spend condition for waiver of annual charges.</b><br />
              1st year fee waiver condition: Rs. 5,000 retail spends in 1st 3 months from the card setup date.Renewal fee (2nd year onwards) waiver condition: Rs.15,000 retail spends in 12 months from card renewal date. </li>
            </ul>
          </div>
        <? }?></td>
      <? if($company_cate_type>0)
				{

				}
				else {
					?>
      <? } ?>
      </tr>
  </table>
  </div>
            
  <div class="thankbox-three">
  <form action="<? echo $_SERVER['PHP_SELF'] ?>" method="post" name="hdfc_cc" id="hdfc_cc" onsubmit="return ckhcreditcard(document.hdfc_cc); ">
    <input type="hidden" name="RequestID" value="<? echo $ccuserid;?>" />
    <input type="hidden" name="cc_bankid" value="<? echo $cc_bankid;?>" />
    <table width="98%">
      <tr>
        <td width="52%" height="28" align="left" class="thankstext">Company Type </td>
        <td width="48%" align="left" class="frmbldtxt"><select name="company_cate_type" id="company_cate_type" class="thanksinput" tabindex="10">
          <option value="0">Please Select</option>
          <option value="1">Pvt Ltd</option>
          <option value="2">MNC Pvt Ltd</option>
          <option value="3">Limited</option>
          <option value="4">Partnership</option>
          <option value="5">Sole Proprietor</option>
          </select></td>
        </tr>
      <tr>
        <td class="thankstext" align="bottom">Residence Landline no / Office Landline no</td>
        <td class="thankstext"><input type="text" name="Std_Code1" id="Std_Code1" class="thanksstd_a" maxlength="5" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; value="std" />
          &nbsp;
          <input type="text" name="Phone1"  class="thanksstd_b" maxlength="10" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; /></td>
        </tr>
      <tr>
        <td class="thankstext" align="bottom">Existing Relationship With Bank ?</td>
        <td class="thankstext"><select name="existing_rel" id="existing_rel" class="thanksinput">
          <option value="">Please Select</option>
          <option value="1">Account</option>
          <option value="2">Loan Running</option>
          <option value="3">Credit Card</option>
          </select></td>
        </tr>
      <tr>
        <td colspan="2" align="center"><input name="submit" type="submit" style="width:105px; height:37px; border: 0px none ; background: url(images/thanksapply.png); margin-bottom: 0px;" value=""/></td>
        </tr>
      </table>
    </form>
  </div>
            
  </td>
</tr>
</table>
<? } ?>
</td>  
    </tr>
</table></div></div>

</div><!-- </div> -->
<?php include "footer_sub_menu.php"; ?>
</body>
</html>