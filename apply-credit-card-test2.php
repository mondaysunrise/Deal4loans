<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//	print_r($_SESSION);
	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Credit Cards Online | Online Credit card Application | Credit card Comparison</title>
<meta name="keywords" content="Credit cards, online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application">
<meta name="description" content="Apply for Credit Cards: Online Credit Card application forms for Apply credit cards. Compare Credit cards and apply credit cards for Various Banks such as SBI, HDFC, Barclays, Kotak Mahindra, Citibank and Many more.">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<Script Language="JavaScript">

function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}
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
function containsalph(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
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


function onFocusBlank(element,defaultVal){ if(element.value==defaultVal){ element.value="";	} }
function onBlurDefault(element,defaultVal){	if(element.value==""){ element.value = defaultVal; }}
</Script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <span><a href="index.php">Home</a> > <a href="credit-cards.php">Credit Card</a> > Apply Credit Card</span>
  <div id="txt" style="padding-top:15px;">
   <font face="Verdana, Arial, Helvetica, sans-serif" color="#FF0000"><strong><?php if(isset($_GET['msg']) && ($_GET['msg']=="NotAuthorised")) echo "Kindly give Valid Details"; ?></strong></font>
  
<form  name="creditcard_form" id="creditcard_form" action="get_cc_eligiblebank-test2.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
<input type="hidden" name="Activate" id="Activate" >
<input type="hidden" name="RequestID" value="<? echo $_SESSION['Temp_LID']; ?>">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="brdr5" >
  <tr>
    <td><table width="98%" border="0" align="right" cellpadding="0" cellspacing="0" >
      <tr>
        <td colspan="3" align="center" ></td>
      </tr>
      <tr>
        <td colspan="3" style="padding:12px;" ><table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30"  bgcolor="#FFFFFF" class="frmbldtxt" ><h1 style="margin:0px; padding:0px;"><a name="frm"></a>Apply Credit Card</h1></td>
          </tr>
        </table></td>
      </tr>
      
      <tr>
        <td colspan="3" valign="top" align="center" style="color:#FF0000;">Your Annual Income shows an unrealistic number. Please re-enter  your yearly annual income.</td>
      </tr>
      <tr>
        <td colspan="3" valign="top" class="frmbldtxt"></td>
      </tr>
      <tr>
        <td  colspan="3" align="left" class="frmbldtxt"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
            <?php
			
			$getDataSql = "select * from Req_Credit_Card where RequestID='".$_SESSION['Temp_LID']."'";
			$getDataQuery = ExecQuery($getDataSql);
			$Name = mysql_result($getDataQuery,0,'Name');
			$Company_Name = mysql_result($getDataQuery,0,'Company_Name');
			$Net_Salary = mysql_result($getDataQuery,0,'Net_Salary');
			
			$Employment_Status = mysql_result($getDataQuery,0,'Employment_Status');
			if($Employment_Status ==1)
			{
				$Employment_Status = "Salaried";
			}
			else
			{
				$Employment_Status = "Self Employed"; 
			}
			$Mobile_Number = mysql_result($getDataQuery,0,'Mobile_Number');
			$Pincode = mysql_result($getDataQuery,0,'Pincode');
			$City  = mysql_result($getDataQuery,0,'City');
			$Email = mysql_result($getDataQuery,0,'Email');
			$DOB = mysql_result($getDataQuery,0,'DOB');
			$DOB_arr = explode("-", $DOB);
			list($yyyy, $mm, $dd) = $DOB_arr;
			
            ?>
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr valign="middle">
                <td width="21%" height="28" class="frmbldtxt" style="padding-top:3px; ">Full Name :</td>
                <td width="31%" height="28" class="frmbldtxt"  style="padding-top:3px; "><?php echo $Name;?></td>
                <td height="28" class="frmbldtxt">Email ID :</td>
                <td height="28" class="frmbldtxt"><?php echo $Email;?></td>
              </tr>
              <tr valign="middle">
                <td height="28" class="frmbldtxt">DOB :</td>
                <td height="28" class="frmbldtxt"><?php echo $dd;?>-
                          <?php echo $mm;?>-<?php echo $yyyy;?></td>
                <td width="12%" height="28" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                <td width="36%" height="28" class="frmbldtxt"  style="padding-top:3px; "><?php echo $City;?></td>
              </tr>
              <tr valign="middle">
                <td height="28" class="frmbldtxt">Mobile :</td>
                <td height="28" class="frmbldtxt">+91
                 <?php echo $Mobile_Number;?></td>
                <td height="28" align="left" class="frmbldtxt">Pincode : </td>
                <td height="28" class="frmbldtxt"> <?php echo $Pincode;?></td>
              </tr>
            </table></td>
            <td width="310" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              <tr valign="middle">
                <td height="28" class="frmbldtxt">Occupation :</td>
                <td height="28" class="frmbldtxt">
                <?php echo $Employment_Status;?>
                </td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Company Name </td>
                <td class="frmbldtxt"><?php echo $Company_Name; ?></td>
              </tr>
              <tr>
                <td height="28" class="frmbldtxt">Annual Income :</td>
                <td class="frmbldtxt"><input type="text" name="Net_Salary" id="Net_Salary" value="<?php echo number_format($Net_Salary); ?>"  style="width:154px;" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="11" />                </td>
              </tr>
              <tr>
                <td   colspan="2" class="frmbldtxt"><span id='formatedIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;'></span> <span id='wordIncome' style='font-size:11px;
font-weight:normal; color:#333333;font-Family:Verdana;text-transform: capitalize;'></span></td>
              </tr>
              <tr>
                <td colspan="2" class="frmbldtxt">&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td height="25"  colspan="2" align="left" class="frmbldtxt" style="font-weight:normal; "><input type="checkbox" name="accept" style="border:none;" checked />
          I have read the <a href="Privacy.php" target="_blank">Privacy Policy</a> and agree to the <a href="Privacy.php" target="_blank">Terms And Condition</a>.</td>
        <td width="25%" rowspan="2" align="left" class="frmbldtxt" style="font-weight:normal; ">&nbsp;&nbsp;
              <input name="submit" type="submit" style="border: 0px none ; background-image: url(new-images/quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td>
      </tr>
      <tr>
        <td width="47%"  align="left" ><div id="getibibo"> </div></td>
        <td width="28%" colspan="-1">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
</table>
<br />
	</form>
<div style="clear:both;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng"><a href="https://www.online.citibank.co.in/products-services/IOC-SEM-Short-Page/IOC-SEM-Short-Page.htm?site=DEAL4LOANS&creative=DISPLAY&section=D4LIODPY&agencyCode=IAPL&campaignCode=CARDSO&productCode=CARDS&eOfferCode=D4LIODPY" target="_blank"> IndianOil Citibank Titanium Credit Card</a></td>
          </tr>
          <tr>
          <td align="center"><a href="https://www.online.citibank.co.in/products-services/IOC-SEM-Short-Page/IOC-SEM-Short-Page.htm?site=DEAL4LOANS&creative=DISPLAY&section=D4LIODPY&agencyCode=IAPL&campaignCode=CARDSO&productCode=CARDS&eOfferCode=D4LIODPY" target="_blank"><img src="http://www.deal4loans.com/new-images/cc/IOCkeepDriving_160x600.jpg" /></a></td>
        </tr>
          <tr>
            <td align="center" valign="bottom"><input name="image22" type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none; outline:none;" src="new-images/crds-apply.gif" onclick="javascript:window.open('https://www.online.citibank.co.in/products-services/IOC-SEM-Short-Page/IOC-SEM-Short-Page.htm?site=DEAL4LOANS&creative=DISPLAY&section=D4LIODPY&agencyCode=IAPL&campaignCode=CARDSO&productCode=CARDS&eOfferCode=D4LIODPY')" /></td>
          </tr>
      </table></td>
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">SBI Platinum Card </td>
          </tr><tr><td align="center"><img src="http://www.deal4loans.com/new-images/cc/sbi_true_travel_160x600.jpg" /></td></tr>
		  <tr>
            <td align="center" valign="bottom"><a href="#pg_up"><img src="new-images/crds-apply.gif" onmouseover="return Decorate('To Apply please Fill your Details in above Form.',7);"  onmouseout="return Decorate1('',7);" border="0"/></a>
                <div id="plantype2_7" style="position:relative;font-size:11px; width:215px; font-weight:bold; height:30px; color:#FFFFFFF;" ></div></td>
          </tr></table></td>
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">HDFC Gold Card </td>
          </tr>
          <tr>
            <td height="135" align="center" valign="bottom"><img src="new-images/hdfc-gold-crd.jpg" width="160" height="119" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Features</td>
          </tr>
          <tr>
            <td height="445" valign="top" class="crdtext"><ul>
<li><b>Fee-Rs 199 P.a</b></li>
<li><b>No Fee-If you spend more than 5000 in first three month.</b></li>
<li><b>Earn 1 Reward Point for every Rs.150 spends.</b></li>
<li><b>From 1st April 2011, earn 50% more Reward Points (i.e total 1.5 Reward Points per Rs. 150) on incremental spends above Rs. 20,000 per statement cycle.</b></li>
<li><b>Revolving Credit Facility </b><br />
Pay a minimum Amount, which is 5% (subject to a minimum amount of Rs.200) of your total bill amount or any higher amount whichever is convenient and carry forward the balance to a better financial month. For this facility you pay a nominal charge of just 3.25% per month (39.0% annually).</li>
<li><b>Free Add-on Card</b><br />
You can share these wonderful features with your loved ones too - we offer the facility of an add-on card for your spouse, children or parents. Allow us to offer add-on cards to you FREE OF COST with our compliments.</li>
</ul></td>
          </tr>
          <tr>
            <td align="center" valign="bottom"><a href="#pg_up"><img src="new-images/crds-apply.gif" onmouseover="return Decorate('To Apply please Fill your Details in above Form.',9);" onmouseout="return Decorate1('',9);" border="0" /></a>
                <div id="plantype2_9" style="position:relative;font-size:11px; width:215px; font-weight:bold; height:30px; color:#FFFFFFF;" ></div></td>
          </tr>
      </table></td>
      <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">Kotak Urbane Gold Card</td>
          </tr>
          <tr>
            <td height="135" align="center" valign="bottom" ><img src="new-images/ktk-urbane.gif" width="79" height="125" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Features</td>
          </tr>
          <tr>
            <td height="444" valign="top" class="crdtext"><ul>
                <li><b>Apply online and basic documents required.</b></li>
              <li><b>No interest, No fee for 3 months.</b></li>
              <li><b>No annual fee.</b></li>
              <li>Minimum yearly income required Rs.3lakh.</li>
              <li>Interest rate charges 3.30% p.m.</li>
              <li>3X REWARD POINTSon every Rs.100 spent</li>
              <li>Redeem reward points against apparel, grocery or other purchases.</li>
              <li>Purchase Eternity Pure Gold Bars and Coins from Kotak Mahindra Bank on your Kotak Credit Card.
                Convert to No-charge 3 EMI option and enjoy easy payments.</li>
              <li>5% Cash Back on domestic holiday packages booked on www.makemytrip.com.
                6 Month No Charge EMI on transaction of Rs 5000 or more on MMT.</li>
              <li>Redeeming made easy:  To redeem, simply SMS URBANE followed by the number of points to be redeemed to 5676788.</li>
            </ul></td>
          </tr>
          <tr>
            <td align="center" valign="bottom"><input name="image23" type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none; outline:none;" src="new-images/crds-apply.gif"onclick="javascript:window.open('https://www.kotakcards.com/kotak/px/kotak/applyonline.do?csmcode=WEBS')" /></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td height="20"></td>
      <td height="20"></td>
      <td height="20"></td>
      <td height="20"></td>
    </tr>
    <tr>
        <td valign="top"  class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">Kotak Velocity Platinum Card</td>
          </tr>
          <tr>
            <td height="135" align="center" valign="bottom" ><img src="new-images/ktk-velocity.gif" width="73" height="118" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Features</td>
          </tr>
          <tr>
            <td height="444" valign="top" class="crdtext"><ul>
                <li><b>Apply online and basic documents required.</b></li>
              <li><b>Get FREE FUEL on every spend, first time in India</b></li>
              <li><b>Annual Fee Rs 499.<br />waived off for first year</b></li>
              <li>Minimum yearly income required Rs. 6 lakh.</li>
              <li>Interest rate charges 3.10% p.m.</li>
              <li>5 Reward Points on every Rs.100 spent</li>
              <li>Redeem Reward points against fuel spends</li>
              <li>Spend Rs.1,25,000 every 6 months and get a complimentary IndiGo Air Ticket (base fare only) each time.</li>
              <li>Get a free cinema ticket with every one you buy on bookmyshow.com on weekends(Fri-Sun)( This offer is valid till 30th September 2011.) </li>
              <li>2.5% fuel surcharge wavier across all petrol pumps.</li>
            </ul></td>
          </tr>
          <tr>
            <td align="center" valign="bottom"><input name="image24" type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none; outline:none;" src="new-images/crds-apply.gif"onclick="javascript:window.open('https://www.kotakcards.com/kotak/px/kotak/applyonline.do?csmcode=WEBS')" />
            </td>
          </tr>
      </table></td>
	  <td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">American Express</td>
          </tr><tr><td align="center"><img src="http://www.deal4loans.com/new-images/cc/amex_160x600.jpg" /></td></tr>
		  <tr>
            <td align="center" valign="bottom"><a href="#pg_up"><img src="new-images/crds-apply.gif" onmouseover="return Decorate('To Apply please Fill your Details in above Form.',7);"  onmouseout="return Decorate1('',7);" border="0"/></a>
                <div id="plantype2_7" style="position:relative;font-size:11px; width:215px; font-weight:bold; height:30px; color:#FFFFFFF;" ></div></td>
          </tr></table></td><td valign="top" class="crdbg"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="30" class="crdbhdng">Kotak Trump Card</td>
          </tr>
          <tr>
            <td height="135" align="center" valign="bottom" ><img src="new-images/kotk-trump.jpg" width="74" height="119" /></td>
          </tr>
          <tr>
            <td height="22" valign="bottom" class="crdbold">Features</td>
          </tr>
          <tr>
            <td height="445" valign="top" class="crdtext"><ul>
                <li><b>Apply online and basic documents required.</b></li>
              <li><b>No interest, no fee in first 3 months.</b></li>
              <li><b>Annual Fee Rs.499</b></li>
              <li>Minimum yearly Income - Rs.3 Lacs.</li>
              <li>Interest rate charges 3.30% p.m.</li>
              <li> Enjoy 10% Cash back across all restaurants, movies &amp; plays. </li>
              <li>Get 25% off on making charges of Gold jewellery and 3% off on MRP of Diamond jewellery at Tribhovandas Bhimji Zaveri (TBZ)</li>
              <li>Book your air ticket and hotels through yatra.com and getRs.199 off on all domestic airline tickets, Rs.499 off on all international airlines tickets, Rs.499 off on all domestic hotel bookings. </li>
              <li>Enjoy higher cash limit upto 50% of your credit limit upto 48 days.</li>
              <li>2.5% fuel surcharge wavier across all petrol pumps. </li>
              <li>1.8% railway surcharge wavier on offline and online railway transaction.</li>
            </ul></td>
          </tr>
          <tr>
            <td align="center" valign="bottom"><a href="#pg_up"><img src="new-images/crds-apply.gif" onmouseover="return Decorate('To Apply please Fill your Details in above Form.',6);"  onmouseout="return Decorate1('',6);"  border="0" /></a>
                <div id="plantype2_6" style="position:relative;font-size:11px; width:215px; font-weight:bold; height:30px; color:#FFFFFFF;" ></div></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
 

  </div>
      <?
  //include '~Right2.php';

  ?>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>