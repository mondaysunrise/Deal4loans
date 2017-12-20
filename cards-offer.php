<?php include 'scripts/functions.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="style/style1.css" rel="stylesheet" type="text/css">
<link href="style/SprySlidingPanels.css" rel="stylesheet" type="text/css">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link rel="stylesheet" href="style/jquery-tabs.css" type="text/css" media="print, projection, screen">
<!-- Additional IE/Win specific style sheet (Conditional Comments) -->
<!--[if lte IE 7]>
<link rel="stylesheet" href="style/jquery-tabs-ie.css" type="text/css" media="projection, screen">
<![endif]-->
<style type="text/css">

.SlidingPanels {
	width: 615px;
	height: 160px;
	overflow:hidden;
}

.SlidingPanelsContent {
	width: 615px;
	height: 160px;
	overflow:hidden;
}

#Maincontent.SlidingPanels {
	float: left;
}
#Maincontent .SlidingPanelsContentGroup {
	float: left;
	width: 1238px;
}
#Maincontent .SlidingPanelsContent {
	float: left;
}
#Maincontent_nav.SlidingPanels {
	float: left;
}
#Maincontent_nav .SlidingPanelsContentGroup {
	float: left;
	width: 1238px;
}
#Maincontent_nav .SlidingPanelsContent {
	float: left;
}
</style>

<script type="text/javascript" src="scripts/SpryDOMUtils.js"></script>
<script type="text/javascript" src="scripts/SpryEffects.js"></script>
<script type="text/javascript" src="scripts/SprySlidingPanels.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script src="js/jquery-1.1.3.1.pack.js" type="text/javascript"></script>
<script src="js/jquery.history_remote.pack.js" type="text/javascript"></script>
<script src="js/jquery.tabs.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {

$('#tabspnl').tabs();
});
</script>

<!--
<link href="tab-script/WebResource.css" type="text/css" rel="stylesheet">
<link media="all" href="tab-script/widget20.css" type="text/css" rel="stylesheet">
<script src="tab-script/menu36.js"></script>-->
<title>Card Offers</title></head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div align="center"><img src="new-images/offers-bann1.gif" width="955" height="74" /></div>
<span><a href="index.php">Home</a> > Cards Offers</span>
<div id="txt">

<table align="center" border="0" cellpadding="0" cellspacing="0" width="970">
  <td>
	<div id="body">	


	<div id="left">
			<div id="left1">
			<p class="pic1"></p>
			<p class="boxTxt1"><a href="#" onmouseover="sp3.showPanel(1); return false;" onclick="sp3.showPanel(1); return false;" style="cursor:pointer;" ><span>Credit Card</span></a></p>
			<br class="spacer">
			</div>
			
			<div id="left2">
			<p class="pic2"></p>
			<p class="boxTxt2"><a href="#" onmouseover="sp3.showPanel(2); return false;" onclick="sp3.showPanel(2); return false;"  style="cursor:pointer;"><span>Debit Card</span></a></p>
			<br class="spacer">
			</div>
				
				
			<div id="left4">
			<p class="pic4"></p>
			<p class="boxTxt4"><a href="#" onmouseover="sp3.showPanel(0); return false;" onclick="sp3.showPanel(0); return false;"  style="cursor:pointer;"><span>Compare Offers</span></a></p>
			<br class="spacer">
			</div>
	
		<br class="spacer">
	</div>
	
<div style="overflow: hidden;" id="Maincontent" class="SlidingPanels SlidingPanelsFocused" tabindex="0">
<div style="left: -615px; top: 0px;" class="SlidingPanelsContentGroup">
	
	<div id="ex3_p1" class="SlidingPanelsContent p1">
	<div id="right1" class="right1bg">
	<table width="400" border="0" align="center" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="4" height="60" align="center" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#000033; font-size:12px;">Compare Offers From</td> </tr>
	<tr>
	  <td  width="127" align="right" valign="middle" ><input type="radio" value="credit_card" name="compare" onclick=" window.open ('compare-offers.php','_self');" style="border:none;" /></td>
	<td width="112" height="77" align="left" valign="middle" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#000033; font-size:12px; padding-left:5px;">Credit Cards</td>
	<td  width="22" align="center" valign="middle" ><input type="radio" value="debit_card" name="compare" onclick=" window.open ('compare-offers.php','_self');" style="border:none;" /></td>
	<td width="139" height="77" align="left" valign="middle" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#000033; font-size:12px;">Debit Cards</td>
	</tr>
	</table>
	</div>
	</div>
	
	<div id="ex3_p2" class="SlidingPanelsContent p2 SlidingPanelsCurrentPanel">
	<div id="right2" class="right2bg">
	<table width="400" border="0" align="center" cellspacing="0" cellpadding="0">
	<tr>
<td height="70" colspan="2" align="center" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#000033; font-size:12px;">To view the Latest Credit Card Offers, Discount & Reward information</td>
	</tr>
	
	<tr>
	<td width="291" height="55" align="right"><input type="text" name="Credit Card" value="Enter your Bank Name"  style="width:250px; padding:5px;" /></td>
	<td align="left" width="109" style="padding-left:10px;"><input type="image" value="" name="" src="new-images/go.gif" width="42" height="31" style="border:none;" /></td>
	</tr>
	</table>
	</div>
	</div>
	
	
	<div id="ex3_p3" class="SlidingPanelsContent p3">
	<div id="right3" class="right3bg">
	<table width="400" border="0" align="center" cellspacing="0" cellpadding="0">
	<tr>
	<td height="70" colspan="2" align="center" valign="bottom" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#000033; font-size:12px;">To view the Latest Debit Card Offers, Discount & Reward information</td>
	</tr>
	
	<tr>
	<td width="291" height="55" align="right"><input type="text" name="Credit Card" value="Enter your Bank Name"  style="width:250px; padding:5px;" /></td>
	<td align="left" width="109" style="padding-left:10px;"><input type="image" value="" name="" src="new-images/go.gif" width="42" height="31"  style="border:none;" /></td>
	</tr>
	</table>
	</div>
	</div>
	
	</div>
	</div>
</div></td>
	</tr>
	</table>
</div>


<div id="tabspnl" style="margin-top:10px;">
<ul>
<li><a href="#credit" class="active"><span>Special Offers on Credit Cards</span></a></li>
<li><a href="#debit"><span>Special Offers on Debit Cards</span></a></li>

</ul>

<div id="credit">
<div class="txt">
<h2>Credit Card</h2>
<b>AbnAmro Bank Credit Card </b>
<ul>
<li> Register yourself for auto bill payment on your Abn Amro Credit Card by 31 Dec. 2009 and earn 100 bonus reward points. </li></ul>
<b>Axis Bank Credit Card</b>
<ul><li> Book your domestic ticket from akbartravelsonline.com and you will get 8% cash back on total fare on Go Air and 5% cash back on base fare for all airlines in the domestic sector.</li>
<div align="left" style="color: #990000;"> *Offer valid on Platinum, Gold Plus, Gold, Silver, Corporate Credit Cards and Easy Credit Cards</div> 
</ul>
<b>American Express Credit Card</b>
<ul>
<li> Now earn 5 times reward points on weekend shopping & dinning.</li>
</ul>
<b>Citibank Credit Card</b><br />
<ul>
<li>Earn 5 times the reward points on weekend shopping.</li>
<li>Shop Online with India’s leading Florist with Citibank Credit Card and get a special offer of 10% at rightflorist.in/citibank</li>
<li> Selected Citibank card holders can get one movie ticket absolutely free while booking one through bookmyshow.com </li> 
<div align="left" style="color: #990000;"> *Offer valid on Citi Titanium Cash Rewards Credit Cards </div> 
</ul>
<b>HDFC Credit Card</b>
<ul>
<li>Get flat 15% Discount on the your air ticket base fare, tickets booked through goindigo.in.</li>
<li> Get 5% discount on international ticket booked online at jetairways.com. use the promocode “EDUJET” while booking your tickets.</li>
<li> Convert your reward points to air miles (Jet Airways/Indian/Kingfisher)</li>
<div align="left" style="color: #990000;"> *Offer valid on till 31st Dec 2009.</div> 
</ul>
<b>Deutsche Bank Festive Promotion 2009</b>
<ul><li> On spend of Rs.25,000 and on minimum swipes of 5 times from 16th Sep to 15 November will qualify you for a quiz. The first 1000 correct response will win Rs.4, 999 cash back.</li></ul>
<b>HSBC Credit Card</b>
<ul>
<li>a) 10 times faster reward points program on HSBC Gold, Platinum, Premier MasterCard till 31st Dec 2009.</li>
<li>b) During the program earn 10 reward points on spend of Rs.100 through Gold Credit Card whereas on regular bases get 1 reward points.</li>
<li>c) During the program earn 20 reward points on spend of Rs.150 through Platinum Credit Card whereas on regular bases get 2 reward points.</li>
<li>d) During the program earn 20 reward points on spend of Rs.100 through Premier Credit Card whereas on regular bases get 2 reward points.</li>
</ul>
<b>SBI Credit Card</b>
<ul>
<li>Get 20% off on upto 10 tickets for FAME cinemas on SBI cards, book your ticket through bookmyshow.com to avail the offer.</li>
</ul>
<b> Standard Chartered Credit Card</b>
<ul><li> Book your movie ticket through bookmyshow.com and get 15% off.</li></ul>
<b>ICICI Bank Credit Card</b>
<ul>
<li>Get amazing discount with ICICI Net Banking transactions</li>
<li>a) Get Rs.200 off on purchase of more than Rs.1,000 through icicipantaloon.futurebazaar.com, to avail the offer use the coupon code SHOPMARTPT</li>
<li> b) Get 10% off up to a maximum discount of Rs.500 through iciciezone.futurebazaar.com, to avail the offer use the coupon code SHOPSMARTEZ.</li>
<li> c) Get Rs. 200 off on purchase of more than Rs.1,000 through icicibigbazaar.futurebazaar.com, to avail the offer use the coupon code SHOPSMARTBB</li>
</ul>
</div>
</div>

<div id="debit">
<div class="txt">
<h2>Debit Card</h2>
<b>AbnAmro Bank Debit Card</b>
<ul>
<li>On spend of Rs.1lac or more in between 01oct to 31 dec09, you can qualify to get a Free Return Air Tickets.(first 75 clients will be eligible for this)</li>
</ul>
<b>Axis Bank Debit Card</b>
<ul><li> Get assured gifts on this festive season with Axis Bank debit cards.</li>
<li> Shop for Rs.20,000 to 40,000 and get a Travel Bag.</li>
<li> Shop for Rs.40,001 to 60,000 an get a Silver Coin.</li>
<li> Shop for Rs.60,001 to 80,000 an get a Travel Trolley Bag.</li>
<li> Shop for Rs.80,001 to 1,00,000 an get a Silver Gift.</li>
<li> Shop for Rs.1,00,001 and above get a Gold Coin.</li>
<div style="color:#990000;" align="left">*Offer valid on all Axis Bank debit card </div></ul>
<b>ICICI Bank Debit Card</b>
<ul>
<li>Shop for Rs.1000 or more and get Rs.200 off at Pantaloons.</li>
<li>Shop for Rs.500 and get 10% off at EZone.</li>
</ul>
<b>Citibank Debit Card</b>
<ul><li> Selected Citibank card holders can get one movie ticket absolutely free while booking one through bookmyshow.com </li></ul>
<b>SBI Debit Card</b>
<ul><li>Get 20% off on upto 10 tickets for FAME cinemas on SBI cards, book your ticket through bookmyshow.com to avail the offer.</li>
</ul>
<b>Standard Chartered Debit Card</b>
<ul><li> Book your movie ticket through bookmyshow.com and get 15% off.</li></ul>
</div>
</div>
</div>

<?php include '~Bottom-new.php';?>
</div>

<script type="text/javascript">
var sp3 = new Spry.Widget.SlidingPanels('Maincontent');
</script>

 </body></html>