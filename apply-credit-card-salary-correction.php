<?php
ob_start( 'ob_gzhandler' );
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<link href="css/acreditc.css" type="text/css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Credit Cards Online | Online Credit card Application | Credit card Comparison</title>
<meta name="keywords" content="Credit cards, online credit cards, online credit cards applications, Credit card comparison, online application of credit card, apply online credit cards, online credit card application">
<meta name="description" content="Apply for Credit Cards: Online Credit Card application forms for Apply credit cards. Compare Credit cards and apply credit cards for Various Banks such as SBI, HDFC, Barclays, Kotak Mahindra, Citibank and Many more.">
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og=">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<!--<script type="text/javascript" src="js/dropdowntabs.js"></script>-->
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-cclist.js"></script>
<link href="source.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.crdtext ul li {
	background: url(../new-images/bt-arrow.gif) no-repeat 5px 5px !important;
	list-style-type: none;
	padding-left: 12px;
	margin-right: 5px;
	padding-right: 0;
	padding-top: 0;
	padding-bottom: 4px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	line-height: 15px;
	text-align: left;
	color: #492704;
}
ul li {
	list-style-type: none;
	padding-left: 15px;
	padding-right: 0;
	padding-top: 0;
	padding-bottom: 4px
}
.crdtext ul {
	margin: 2px 0px 0px 0px;
	padding: 2px 0px 0px 0px;
}
.crdbg_n {
	background-image: url(http://www.deal4loans.com/new-images/crds-bg-big.gif);
	background-repeat: no-repeat;
	width: 240px;
	height: 675px;
}
-->
</style>
</head>
<body>
<?php include "middle-menu.php"; ?>
<div class="text12" style="margin:auto; width:70%; height:11px; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="credit-cards.php"  class="text12" style="color:#0080d6;"><u>Credit Card</u></a> <span  class="text12" style="color:#4c4c4c;">> Apply Credit Card</span></div>
<div style="clear:both; height:15px;"></div>
<div class="intrl_txt" style="margin:auto;">
  <div style="width:100%; height:33; margin-top:0px; float:left; clear:right;">
    <div style="width:100%; height:33; margin-top:15px; float:left; clear:right;">
      <form  name="creditcard_form" id="creditcard_form" action="eligible-credit-card.php" method="post" onSubmit="return ckhcreditcard(document.creditcard_form); " >
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
			list($GetnumVal,$GetRows)=Mainselectfunc($getDataSql,$array = array());
			//$getDataQuery = ExecQuery($getDataSql);
			$Name =$GetRows['Name'];
			$Company_Name =$GetRows['Company_Name'];
			$Net_Salary =$GetRows['Net_Salary'];
			
			$Employment_Status =$GetRows['Employment_Status'];
			if($Employment_Status ==1)
			{
				$Employment_Status = "Salaried";
			}
			else
			{
				$Employment_Status = "Self Employed"; 
			}
			$Mobile_Number =$GetRows['Mobile_Number'];
			$Pincode =$GetRows['Pincode'];
			$City  =$GetRows['City'];
			$Email =$GetRows['Email'];
			$DOB =$GetRows['DOB'];
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
                              <td height="28" class="frmbldtxt"><?php echo $dd;?>- <?php echo $mm;?>-<?php echo $yyyy;?></td>
                              <td width="12%" height="28" class="frmbldtxt" style="padding-top:3px; ">City :</td>
                              <td width="36%" height="28" class="frmbldtxt"  style="padding-top:3px; "><?php echo $City;?></td>
                            </tr>
                            <tr valign="middle">
                              <td height="28" class="frmbldtxt">Mobile :</td>
                              <td height="28" class="frmbldtxt">+91 <?php echo $Mobile_Number;?></td>
                              <td height="28" align="left" class="frmbldtxt">Pincode : </td>
                              <td height="28" class="frmbldtxt"><?php echo $Pincode;?></td>
                            </tr>
                          </table></td>
                        <td width="310" valign="top"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                            <tr valign="middle">
                              <td height="28" class="frmbldtxt">Occupation :</td>
                              <td height="28" class="frmbldtxt"><?php echo $Employment_Status;?></td>
                            </tr>
                            <tr>
                              <td height="28" class="frmbldtxt">Company Name </td>
                              <td class="frmbldtxt"><?php echo $Company_Name; ?></td>
                            </tr>
                            <tr>
                              <td height="28" class="frmbldtxt">Annual Income :</td>
                              <td class="frmbldtxt"><input type="text" name="Net_Salary" id="Net_Salary" value="<?php echo number_format($Net_Salary); ?>"  style="width:154px;" onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" tabindex="11" /></td>
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
    </div>
  </div>
  <div style="clear:both;"></div>
  <div class="ac_table_box" style="margin-top:10px;">
    <div class="ac_card_colum">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng" style="border-right: #FFF thin solid;">Standard Chartered <br />
            Platinum Rewards Card </td>
        </tr>
        <tr>
          <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/stanc_palitinum.jpg" width="150" height="94"/></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>Fee- Nil</li>
              <br />
            </ul></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>3.10%(per month)</li>
            </ul></td>
        </tr>
        <tr>
          <td valign="top" class="crdtext" id="ac_card_hide_row"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="22" valign="bottom" class="crdbold">Reward Points</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext"><ul>
                    <li>5 points on every 100 spent on dining, hotels and fuel</li>
                    <li>base rewards: of 2 points per 100 spent across other categories</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Other Features</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" ><ul>
                    <li>Visa Platinum offers across movies, dining and travel</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
              </tr>
              <tr>
                <td valign="top" class="crdtext"><ul>
                    <li>Nil</li>
                  </ul></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <div class="ac_card_colum">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng" style="border-right: #FFF thin solid;">HDFC Bank <br />
            Platinum Plus Credit Card </td>
        </tr>
        <tr>
          <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/hdfc_plt_plus.jpg" width="150" height="94"/></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>Fee-Rs 399</li>
              <br />
            </ul></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>3.15% (per month)</li>
            </ul></td>
        </tr>
        <tr>
          <td valign="top" class="crdtext" id="ac_card_hide_row"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="22" valign="bottom" class="crdbold">Reward Points</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext"><ul>
                    <li>2 Reward Points per Rs.150 spent</li>
                    <li>50% more Reward Points on incremental spends above Rs.50,000 per statement cycle</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Other Features</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" ><ul>
                    <li> Revolving Credit facility + Free add-on cards + Zero liability on lost card</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
              </tr>
              <tr>
                <td valign="top" class="crdtext"><ul>
                    <li>Fuel surcharge waiver of 2.5% across any petrol pump in India </li>
                  </ul></td>
              </tr>
              <tr>
                <td  height="22" valign="bottom" class="crdbold">Special Offers</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" height="77"><ul>
                    <li>Get 1000 Bonus Reward Points on 1st transaction + 3X Reward Points on online spends.</li>
                  </ul></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <div class="ac_card_colum" style="margin-top:2px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng">ICICI Bank <br />
            Coral Credit Card </td>
        </tr>
        <tr>
          <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/icici_coralcc.jpg" width="150" height="100"/></td>
        </tr>
        <tr>
          <td  valign="bottom" class="crdbold"><div style="float:left;">Fee : Option I </div>
            <div style="font-size:9px; float:right; padding-left:10px; background-color:#FFFF00; width:30px; color:#FF0000; width:80px;" >*Limited offer</div></td>
        </tr>
        <tr>
          <td valign="top" class="crdtext" style="padding-bottom:6px;"><ul>
              <li><b>Joining Fee</b> – Rs.<span style="text-decoration:line-through;">1,000</span> Rs.500*</li>
              <li><b>Annual Fee</b> – Rs. 500 (2nd Year onwards; waived off if spends cross Rs. 1,25,000 in the previous year) </li>
              <li><b>Welcome Gift:</b> <u>Satya Paul gifts worth Rs.5,000</u></li>
            </ul></td>
        </tr>
        <tr>
          <td  valign="bottom" class="crdbold" height="22">Option II</td>
        </tr>
        <tr>
          <td class="crdtext"><ul>
              <li><b>Lifetime Fee </b> – Rs. 5,000</li>
              <li><b>Welcome Gift:</b> <u>Bose Headphones </u></li>
            </ul></td>
        </tr>
        <tr>
          <td align="center" valign="bottom" id="ac_card_hide_row"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="22" valign="bottom" class="crdbold">Reward Points</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" height="55"><ul>
                    <li>2 PAYBACK points per Rs 100 spent, 4 PAYBACK points per Rs 100 spent on dining, groceries and supermarkets </li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Other Features</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" height="240"><ul>
                    <li>Up to 4 free movie tickets per month (buy 1 get 1 free) – 2 each on BookMyShow.com and Cinemax on any day of week. </li>
                    <li>Minimum 15% savings at participating restaurants</li>
                    <li>2.5% surcharge waiver on fuel purchase upto Rs. 4000 at select HPCL outlets (the card should be swiped at ICICI Merchant Services terminal only)</li>
                    <li> Upto 2 complementary lounge visits per quarter at Visa Airport Lounges in India and Abroad</li>
                  </ul></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <div class="ac_card_colum">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng">American Express<br />
            Platinum Travel Credit Card</td>
        </tr>
        <tr>
          <td align="center" valign="bottom" style="padding-top:10px;"><input name="image25" type="image" style="background-image:url(/new-images/amex_plttrvlcrd_160x600.jpg); background-repeat:no-repeat; width:160px; height:600px; border:none; outline:none;" src="/new-images/amex_plttrvlcrd_160x600.jpg"onclick="javascript:window.open('https://americanexpressindia.co.in/lp.aspx?siteid=Deal4loanPlatinumTravelCard&adunit=160x600_PlatinumTravelCard_Junejuly&banner=160x600_PlatinumTravelCard_Junejuly&campaign=PlatinumTravelCard&marketingagency=interactive')" /></td>
        </tr>
      </table>
    </div>
    <div style="clear:both;"></div>
    <div class="ac_card_colum" style="margin-top:2px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng">ICICI Bank<br />
            Sapphiro Credit Cards </td>
        </tr>
        <tr>
          <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/icici_sappire160x102.gif" width="160" height="102" /></td>
        </tr>
        <tr>
          <td  valign="bottom" class="crdbold">Fee :  Option I</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li><b>Joining Fee</b> – Rs. 25,000</li>
              <li><b>Annual Fee</b> - Rs. 3,500 (2nd Year onwards; waived off if spends cross Rs. 5,00,000 in the previous year) </li>
              <li><b>Welcome Gift:</b> <u>Apple iPad2 </u></li>
            </ul></td>
        </tr>
        <tr>
          <td  valign="bottom" class="crdbold" height="22">Option II</td>
        </tr>
        <tr>
          <td class="crdtext"><ul>
              <li><b>Lifetime Fee </b> – Rs. 75,000</li>
              <li><b>Welcome Gift:</b> <u>Apple Macbook Air </u></li>
            </ul></td>
        </tr>
        <tr>
          <td id="ac_card_hide_row" ><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="22" valign="bottom" class="crdbold">Reward Points</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext"><ul>
                    <li>2 PAYBACK Points on Domestic Spends, 4 PAYBACK Points on  International Spends. 50% more reward points  on American Express.</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Other Features</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" height="261"><ul>
                    <li>One year complimentary membership to 'Leaders Club' of the Leading Hotels of the World</li>
                    <li>Gold Elite tier membership of the Flying Blue frequent flier programme </li>
                    <li>8 complimentary rounds p/m at over 100 of the finest Golf Courses in the world</li>
                    <li>Priority Pass membership, complimentary access to Lounges of AirFrance, KLM &amp; SkyTeam at over 300 international airports, Altitude Lounge access at Mumbai &amp; Delhi airports, access to select Clipper &amp; Plaza lounges </li>
                  </ul></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <div class="ac_card_colum" style="margin-top:2px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng">HDFC Bank Solitaire Credit Card <br />
            Exclusively For Women </td>
        </tr>
        <tr>
          <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/hdfc_solitaire_crd.jpg" width="156" height="102"/></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>Fee- 999</li>
              <br />
            </ul></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>3.15%(per month)</li>
            </ul></td>
        </tr>
        <tr>
          <td align="center" valign="bottom" id="ac_card_hide_row"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="22" valign="bottom" class="crdbold">Reward Points</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext"><ul>
                    <li>3 Reward Points per Rs. 150</li>
                    <li>50% additional Reward Points on Grocery &amp; dining spends</li>
                    <li>1000 Reward Point benefits on card Renewal </li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Other Features</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" ><ul>
                    <li>One-time free Wellness package from Thyrocare</li>
                    <li>Reward Point redemption across Multiple domestic airlines</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" ><ul>
                    <li>Fuel surcharge waiver of 2.5% across any petrol pump in India </li>
                  </ul></td>
              </tr>
              <tr>
                <td  height="22" valign="bottom" class="crdbold">Special Offers</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" height="77"><ul>
                    <li>Get 1000 Bonus Reward Points on 1st transaction + 3X Reward Points on online spends.</li>
                  </ul></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <div class="ac_card_colum" style="margin-top:2px;">
      <table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng">ICICI Bank <br />
            Platinum Chip Credit Card</td>
        </tr>
        <tr>
          <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/icici_pltchipcrd.jpg" width="150" height="95"/></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold"><div style="float:left;">Joining Fee </div>
            <div style="font-size:9px; float:right; padding-left:10px; background-color:#FFFF00; width:30px; color:#FF0000; width:80px;" >Exclusive offer</div></td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>Fee- Rs-<span style="text-decoration:line-through;">199</span>&nbsp;  Nil **</li>
            </ul></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Annual Fee (2nd year onwards)</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>Fee- Rs. 99 (waived off if spends cross Rs. 50,000 during previous year)</li>
            </ul></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>3.4% (per month)</li>
            </ul></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Reward Points</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>2 PAYBACK points for every Rs. 100 spent (except on fuel)</li>
            </ul></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Other Features</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext" ><ul>
              <li> Minimum 15% discount on dining at over 800 restaurants all over India</li>
            </ul></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
        </tr>
        <tr>
          <td valign="top" class="crdtext" ><ul>
              <li>2.5% fuel surcharge waiver on fuel transactions (of maximum Rs. 4,000) at HPCL pumps when the card is swiped on ICICI Merchant Services Swipe machines.</li>
            </ul></td>
        </tr>
        <tr>
          <td  height="22" valign="bottom" class="crdbold">Special Feature</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext" height="60"><ul>
              <li>The card comes with a micro-chip that is difficult to duplicate.</li>
            </ul>
            <span style="font-size:11px;"><br />
            ** Only for deal4loans customers</span></td>
        </tr>
        <tr>
          <td align="center" valign="bottom"></td>
        </tr>
      </table>
    </div>
    <div class="ac_card_colum" style="margin-top:2px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng">Standard Chartered <br />
            Super Value Titanium Card</td>
        </tr>
        <tr>
          <td height="135" align="center"  ><img src="http://www.deal4loans.com/new-images/supervalue-titanium-card.png" width="120" height="75" /></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>Fee- 750</li>
              <br />
            </ul></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>3.10% (per month)</li>
            </ul></td>
        </tr>
        <tr>
          <td valign="top" class="crdtext" id="ac_card_hide_row"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="22" valign="bottom" class="crdbold">Reward Points</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext"><ul>
                    <li>Nil</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Other Features</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" ><ul>
                    <li>5% Cashback on all fuel spends at any petrol pump</li>
                    <li>5% Cashback on mobile and telephone bills</li>
                    <li>5% Cashback on utility bill payments</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" height="177"><ul>
                    <li>2.5% surcharge reversal on all petrol pumps </li>
                  </ul></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <div style="clear:both;"></div>
    <div class="ac_card_colum" style="margin-top:2px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng" style="border-right: #FFF thin solid;">HDFC Bank <br />
            Titanium Edge Card</td>
        </tr>
        <tr>
          <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/hdfc_titanium_edge.jpg" width="150" height="94" /></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>Fee- 599</li>
              <br />
            </ul></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>3.15% (per month)</li>
            </ul></td>
        </tr>
        <tr>
          <td valign="top" class="crdtext" id="ac_card_hide_row"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="22" valign="bottom" class="crdbold">Reward Points</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext"><ul>
                    <li>2 Reward Points for every Rs. 150 you spend.</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Other Features</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" ><ul>
                    <li>Enjoy 50% more reward points* on all your Dining spends. Now every meal will be more rewarding.</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" ><ul>
                    <li>Enjoy complete freedom from fuel surcharge when you purchase fuel between Rs. 400 and Rs. 5000 across fuel stations. </li>
                  </ul></td>
              </tr>
              <tr>
                <td  height="22" valign="bottom" class="crdbold">Special Offers</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" height="55"><ul>
                    <li>Get 1000 Bonus Reward Points on 1st transaction + 3X Reward Points on online spends.</li>
                  </ul></td>
              </tr>
              <tr>
                <td style="font-size:9px; font-weight:normal!important;"  class="crdbold">* 50% more Reward Points are offered to the Cardholders only on those transactions which are classified under the 'Restaurant' Merchant Category Code (MCC) as defined by VISA/ MasterCard. Merchant Category Code (MCC) classified under ‘Hotel’ categories will not qualify for 50% more Reward Points.</td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <div class="ac_card_colum" style="margin-top:2px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng">ICICI Bank <br />
            Rubyx Credit Cards </td>
        </tr>
        <tr>
          <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/icici_ruby160x102.gif" width="160" height="102" /></td>
        </tr>
        <tr>
          <td  valign="bottom" class="crdbold">Fee : Option I</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li><b>Joining Fee</b> – Rs. 5,000</li>
              <li><b>Annual Fee</b> – Rs. 2,000 (2nd Year onwards; waived off if spends cross Rs. 2,50,000 in the previous year) </li>
              <li><b>Welcome Gift:</b> <u>Bose Headphones </u></li>
            </ul></td>
        </tr>
        <tr>
          <td  valign="bottom" class="crdbold" height="22">Option II</td>
        </tr>
        <tr>
          <td class="crdtext"><ul>
              <li><b>Lifetime Fee </b> – Rs. 25,000</li>
              <li><b>Welcome Gift:</b> <u>Apple iPad2 </u></li>
            </ul></td>
        </tr>
        <tr>
          <td align="center" valign="bottom" id="ac_card_hide_row"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="22" valign="bottom" class="crdbold">Reward Points</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" height="55" style="padding-bottom:2px;"><ul>
                    <li>4 PAYBACK Points on selected categories, 2 PAYBACK Points on others. 50% more reward points on American Express</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Other Features</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" height="259" ><ul>
                    <li>India's first dual Platinum Credit Card</li>
                    <li>Benefits from American Express &amp; MasterCard</li>
                    <li>4 complimentary rounds per month at over 100 of the finest Golf Courses in the world</li>
                    <li>Up to 4 free movie tickets per month (buy 1 get 1 free) – 2 each on BookMyShow.com and Cinemax on any day of week</li>
                    <li>Complimentary access to select Clipper &amp; Plaza lounges across various domestic and international airports.</li>
                  </ul></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <div class="ac_card_colum">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng" style="border-right: #FFF thin solid;">ICICI Bank<br />
            HPCL Platinum Credit Card </td>
        </tr>
        <tr>
          <td height="135" align="center"  ><img src="http://www.deal4loans.com/new-images/icici_pltcc.jpg" width="150" height="100"/></td>
        </tr>
        <tr>
          <td  valign="bottom" class="crdbold">Annual Fee</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext" height="50" style="padding-bottom:6px;"><ul>
              <li><b>Joining Fee</b> – Nil </li>
              <li><b>Annual Fee</b> –   Rs. 500 (1st year)<br />
                – Rs. 500 (Reversed in case spends exceed Rs. 50,000 in the previous year)(2nd year onwards)<br />
              </li>
              <li><b>Joining Benefit</b> - Cashback of Rs 500 if purchases exceed Rs. 5,000 within 60 days of card set   up. </li>
            </ul></td>
        </tr>
        <tr>
          <td valign="top" height="0" style="padding-bottom:6px;" id="ac_card_hide_row"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="22" valign="bottom" class="crdbold">Reward Points</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext"  style="padding-bottom:2px;"><ul>
                    <li>5 PAYBACK points on fuel purchases at HPCL on ICICI Merchant  Services swipe   machines, 2 PAYBACK points on all other purchases.</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Other Features</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext"><ul>
                    <li>Up to Rs.200 off every month on movie tickets booked through www.bookmyshow.com.</li>
                    <li>Minimum 15% savings at participating restaurants with ICICI Bank Culinary Treats programme.</li>
                    <li>Reduce fuel bills with 2.5% cash back (maximum of Rs. 100 per month) &amp; 2.5%   surcharge waiver on fuel purchase upto Rs. 4000 at select HPCL outlets (the card   should be swiped at ICICI Merchant Services terminal only)</li>
                  </ul></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
 
    <div class="ac_card_colum" style="margin-top:2px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng">HDFC Bank <br />
            Superia Credit Card</td>
        </tr>
        <tr>
          <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/hdfc-superia-crd.jpg" width="139" height="91" /></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Annual Fee</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>Fee- 3499</li>
              <br />
            </ul></td>
        </tr>
        <tr>
          <td height="22" valign="bottom" class="crdbold">Interest Rate </td>
        </tr>
        <tr>
          <td valign="top" class="crdtext"><ul>
              <li>3.05% (per month)</li>
            </ul></td>
        </tr>
        <tr>
          <td valign="top" class="crdtext" id="ac_card_hide_row"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="22" valign="bottom" class="crdbold">Reward Points</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext"><ul>
                    <li>Welcome Benefit of 3500 Points + Renewal Benefit of 1,000 points</li>
                    <li>3 Points per Rs.150 spent + 50% more Reward Points on Dining spends </li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Other Features</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" ><ul>
                    <li>Reward Points redemption against airlines tickets booked</li>
                    <li>zero liability on any fraudulent transactions on your card</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Fuel Surcharge Waiver </td>
              </tr>
              <tr>
                <td valign="top" class="crdtext"><ul>
                    <li>No fuel surcharge on fuel purchase between Rs.400 - Rs5000 across all fuel stations. </li>
                  </ul></td>
              </tr>
              <tr>
                <td  height="22" valign="bottom" class="crdbold">Special Offers</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" height="77"><ul>
                    <li>Get 1000 Bonus Reward Points on 1st transaction + 3X Reward Points on online spends.</li>
                  </ul></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
    <div class="ac_card_colum" style="margin-top:2px;">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="30" bgcolor="#ECD77B" class="crdbhdng">ICICI Bank<br />
            HPCL Titanium Credit Card </td>
        </tr>
        <tr>
          <td height="135" align="center" ><img src="http://www.deal4loans.com/new-images/icici_titanmcc.jpg" width="150" height="100" /></td>
        </tr>
        <tr>
          <td  valign="bottom" class="crdbold">Annual Fee</td>
        </tr>
        <tr>
          <td valign="top" class="crdtext" style="padding-bottom:6px;"><ul>
              <li><b>Joining Fee</b> – Nil </li>
              <li><b>Annual Fee</b> –   Rs. 500 (1st year)<br />
                – Rs. 500 (Reversed in case spends exceed Rs. 50,000 in the previous year)(2nd year onwards)<br />
              </li>
              <li><b>Joining Benefit</b> - Cashback of Rs 500 if purchases exceed Rs. 5,000 within 60 days of card set   up. </li>
            </ul></td>
        </tr>
        <tr>
          <td valign="top" class="crdtext" id="ac_card_hide_row" style="padding-bottom:6px;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="22" valign="bottom" class="crdbold">Reward Points</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" height="55" style="padding-bottom:14px;"><ul>
                    <li>5 PAYBACK points on fuel purchases at HPCL on ICICI Merchant  Services swipe   machines, 2 PAYBACK points on all other purchases.</li>
                  </ul></td>
              </tr>
              <tr>
                <td height="22" valign="bottom" class="crdbold">Other Features</td>
              </tr>
              <tr>
                <td valign="top" class="crdtext" ><ul>
                    <li>Up to Rs.200 off every month on movie tickets booked through www.bookmyshow.com.</li>
                    <li>Minimum 15% savings at participating restaurants with ICICI Bank Culinary Treats programme.</li>
                    <li>Reduce fuel bills with 2.5% cash back (maximum of Rs. 100 per month) &amp; 2.5%   surcharge waiver on fuel purchase upto Rs. 4000 at select HPCL outlets (the card   should be swiped at ICICI Merchant Services terminal only)</li>
                  </ul></td>
              </tr>
            </table></td>
        </tr>
      </table>
    </div>
  </div>
  <div style="clear:both; height:20px; width:100%; margin:auto; margin-top:10px; padding-top:10px;"><a href="/Contents_Calculators.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/emi2.gif',1)"><img src="images/emi1.gif" alt="EMI Calculator" name="Image3" width="95" height="20" border="0" id="Image3" hspace="5px" /></a></div>
</div>
<?php include "footer_sub_menu.php"; ?>
</body>
</html>