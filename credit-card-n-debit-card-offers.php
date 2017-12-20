<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	foreach($_POST as $a=>$b)
		$$a=$b;
	$Bank_name= $_REQUEST["Bank_name"];
	$CC_Holder=$_REQUEST["CC_Holder"];
	$city_name= $_REQUEST["card_city"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css' />
<title>Latest Credit Card offers 2015 | Cash Back, Discounts, Reward points, offers on Debit Cards</title>
<meta name="keywords" content="credit card offers, discounts on credits cards, Cash back offers on cards, debit card offers, credit card entertainment offers" />
<meta name="description" content="Credit Card Offers: Check updated Offers on your Credit & Debit Cards of HDFC Bank, SBI, ICICI Bank, Axis Bank, IDBI, Citibank, Standard chartered, HSBC, PNB, bank of india, bank of baroda etc at deal4loans.com" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://www.deal4loans.com/scripts/mootools.js"></script>
<script Language="JavaScript" Type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-list_cc.js"></script>
<style type="text/css">
/* START CSS NEEDED ONLY IN DEMO */
	

#mainContainer {
	width: 660px;
	margin: 0 auto;
	text-align: left;
	height: 100%;
	border-left: 3px double #000;
	border-right: 3px double #000;
}
#formContent {
	padding: 5px;
}
/* END CSS ONLY NEEDED IN DEMO */
	
	/* Big box with list of options */
#ajax_listOfOptions {
	position: absolute;	/* Never change this one */
	width: 175px;	/* Width of box */
	height: 50px;	/* Height of box */
	overflow: auto;	/* Scrolling features */
	border: 1px solid #666666;	/* Dark green border */
	background-color: #FFFFFF;	/* White background color */
	color: #333333;
	text-align: left;
	font-size: 11px;
	z-index: 100;
}
#ajax_listOfOptions div {	/* General rule for both .optionDiv and .optionDivSelected */
	margin: 1px;
	padding: 1px;
	cursor: pointer;
	font-size: 11px;
}
#ajax_listOfOptions .optionDiv {	/* Div for each item in list */
}
#ajax_listOfOptions .optionDivSelected { /* Selected item in the list */
	background-color: #3d87d4;
	line-height: 20px;
	color: #FFFFFF;
}
#ajax_listOfOptions_iframe {
	background-color: #F00;
	position: absolute;
	z-index: 5;
}
form {
	display: inline;
}
</style>
<style type="text/css">
.content {
	font-family: 'Droid Sans', sans-serif!important;
	font-size: 11px;
	vertical-align: top;
}
.content table td {
	font-family: 'Droid Sans', sans-serif!important;
	font-size: 11px;
	vertical-align: top;
}
.nrmltxt {
	text-decoration: none;
	color: #4d4d4d;
	font-weight: normal;
	font-family: 'Droid Sans', sans-serif!important;
	font-size: 11px;
}
.bldtxt img {
	margin-right: 6px;
	vertical-align: middle;
}
.bldtxt {
	text-decoration: none;
	line-height: 20px;
	padding-left: 8px;
	color: #000;
	font-family: 'Droid Sans', sans-serif!important;
	font-size: 16px;
}
.bnkbg {
	background-color: #f4f4f4;
	border-left: 5px solid #b2b2b2;
	padding-left: 8px;
	margin-top: 10px;
	font-family: 'Droid Sans', sans-serif!important;
	font-size: 12px;
	color: #444444;
	font-weight: bold;
	line-height: 30px;
}
.bldtxt1 {
	text-decoration: none;
	line-height: 20px;
	padding-left: 8px;
	color: #FFF;
	font-family: 'Droid Sans', sans-serif!important;
	font-size: 16px;
}
.cc-get-quotebtn-right {
	background: #06b2a0;
    width: 110px;
    border: solid 2px #FFF;
	height: 39px;
	border-radius: 5px;
	font-size: 16px;
	margin-bottom: 5px;
	color:#FFF;
	margin-top: 10px;
}
</style>
<script>

var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
		try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

function modify_search()
{
	window.location.replace( "http://www.deal4loans.com/credit-card-n-debit-card-offers.php" );
}

function getdetails(r)
		{
			var new_CC_details=document.getElementById('cetogary_'+ r ).value;		
			var new_city=document.getElementById('city').value;
		if((new_CC_details!=""))
			{
				var queryString = "?cardcontent=" + new_CC_details + "&city=" + new_city;
		//alert(queryString); 
				ajaxRequest.open("GET", "get_cardcontentdetails.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{				
						var ajaxDisplay = document.getElementById('get_details');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
					}
				}

				ajaxRequest.send(null); 
			 }
		}
	window.onload = ajaxFunction;
</script>
<script type="text/javascript" src="http://www.deal4loans.com/scripts/jquery.js"></script>
<script type="text/javascript"> 
$(document).ready(function(){
$(".flip").click(function(){
    $("#panel").hide("slow");
	$("#get_details").show("slow");
    $("#serach").show("slow");
  });
});

$(document).ready(function(){
$("#serach").click(function(){
    $("#get_details").hide("slow");
	$("#panel").show("slow");
	//$("#serach").hide("slow");
  });
});
</script>
</head>
<body>
<!--top-->
<?php include "middle-menu.php"; ?>
<div class="text12" style="margin:auto; width:70%px; height:11px; margin-top:70px; margin-left:220px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span class="text12" style="color:#4c4c4c;">Credit Card and Debit Card Offers</span></u></div>
<div class="intrl_txt">
  <div style="width:100%; height:33; margin-top:25px; float:left; clear:right;">
    <h1 class="text3"  style="width:100%; height:33; margin-top:0px; float:left; clear:right; font-size:28px; text-transform:none; color:#000; margin-left:0px;">Credit Card and Debit Card Offers for <?php echo date("F, Y"); ?></h1>
  </div>
  <div style="clear:both; height:5px;"></div>
  <div id="txt">
    <div class="faqContainer"> 
      <!--      <h3>FAQs</h3>-->
      <div id="serach" style="cursor:pointer; display:none; font-size:13px; text-align:left;"><b><u>Search More</u></b></div>
      <?php if ($_SERVER['REQUEST_METHOD'] == 'POST')
			  {
			  ?>
      <div style="cursor:pointer; font-size:13px; text-align:right;"><b><u><a onclick="return modify_search();">Modify Search</a></u></b></div>
      <?php } ?>
      <div class="element atStart">
        <div id="panel">
          <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="3" align="center" valign="middle" style="padding-bottom:15px;"><table width="100%" align="left" cellpadding="0" cellspacing="0"  style="border:1px dashed #7b4501; background-color:#0e79b9">
                  <tr>
                    <td height="60" colspan="3" valign="top"><form name="ccndc_form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
                        <table width="100%" align="center" cellpadding="0" cellspacing="0" class="quick1">
                          <input name="city" id="city"  type="hidden" value="<?php echo $city_name; ?>"/>
                          <input type="hidden" name="section" value="" />
                          <input type="hidden" name="Source" value="health-insurance" />
                          <tr>
                            <td width="138" height="35" class="bldtxt1">Bank Name</td>
                            <td align="left" valign="middle" colspan="5"><input name="Bank_name" id="Bank_name"   type="text" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)"  value="<?php echo $Bank_name;?>"/></td>
                          </tr>
                          <tr>
                            <td width="138" height="35" class="bldtxt1">Select your Type of Card</td>
                            <td width="22" align="center" valign="middle"><input name="CC_Holder" id="CC_Holder" value="1" <?php if($CC_Holder==1){ echo "checked";}?> type="radio"  style="border:none;" /></td>
                            <td width="78" height="20" align="left" class="bldtxt1"> Credit Card </td>
                            <td width="20" align="center" valign="middle"><input name="CC_Holder" id="CC_Holder" value="2"  <?php if($CC_Holder==2){ echo "checked";}?> type="radio"  style="border:none;"/></td>
                            <td width="197" align="left" class="bldtxt1"> Debit Card</td>
                            <td width="62" align="left" >&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="138" height="35" class="bldtxt1">Select City</td>
                            <td align="left" colspan="5"><select id="card_city" name="card_city" style="width:150px;">
                                <option value="All">Please Select</option>
                                <option value="Ahmedabad" <?php if($city_name=="Ahmedabad") { echo "Selected"; } ?>>Ahmedabad</option>
                                <option value="Bangalore" <?php if($city_name=="Bangalore") { echo "Selected"; } ?>>Bangalore</option>
                                <option value="Chennai" <?php if($city_name=="Chennai") { echo "Selected"; } ?>>Chennai</option>
                                <option value="Delhi" <?php if($city_name=="Delhi") { echo "Selected"; } ?>>Delhi & NCR</option>
                                <option value="Hyderabad" <?php if($city_name=="Hyderabad") { echo "Selected"; } ?>>Hyderabad</option>
                                <option value="Kolkata" <?php if($city_name=="Kolkata") { echo "Selected"; } ?>>Kolkata</option>
                                <option value="Mumbai" <?php if($city_name=="Mumbai") { echo "Selected"; } ?>>Mumbai</option>
                                <option value="Pune" <?php if($city_name=="Pune") { echo "Selected"; } ?>>Pune</option>
                                <option value="All" <?php if($city_name=="All") { echo "Selected"; } ?>>All</option>
                              </select></td>
                          </tr>
                          <tr>
                            <td colspan="7">&nbsp;</td>
                          </tr>
                          <?php if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
	?>
                          <tr>
                            <td colspan="7" id="myDiv" bgcolor="#0e79b9" align="center" height="40"><input name="Submit" class="cc-get-quotebtn-right" type="Submit" value="Submit" /></td>
                          </tr>
                          <?php } ?>
                        </table>
                      </form></td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td colspan="6" valign="top"><table width="100%" cellpadding="0" cellspacing="0">
                  <?php if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	?>
                  <tr>
                    <td colspan="2" class="bnkbg"><?php echo $Bank_name;?></td>
                  </tr>
                  <?php
if($CC_Holder>0)
	{
			
		$selectcard=("select * From creditndebit_card_offer where (ccndc_offer_type=".$CC_Holder." and bank_name='".$Bank_name."' and ccndc_approval=1 and city_list='".$city_name."')");
		//$recordcount = mysql_num_rows($selectcard);
		//echo $selectcard;
		list($recordcount,$row)=MainselectfuncNew($selectcard,$array = array());
	$Cctr=0;
		
		if($recordcount<1)
		{
			$selectcard=("select * From creditndebit_card_offer where (ccndc_offer_type=".$CC_Holder." and bank_name='".$Bank_name."' and ccndc_approval=1 and city_list='All')");
		list($rowscount,$row)=MainselectfuncNew($selectcard,$array = array());
		$Cctr=0;
		
		}
		
	}
$i=0;
$j=0;
while($j<count($row))
		{


	//echo $i;
?>
                  <tr>
                    <td width="25" align="left"><?php if($i==0) {?>
                      
                      <!--<h3 class="toggler atStart">bye</h3>-->
                      
                      <?php } ?>
                      <input type="radio" value="<?php echo $row[$j]["ccndc_offerid"];?>" name="cetogary" id="cetogary_<?php echo $i;?>" style="border:none"   <?php if((strlen(strpos($strcategory, $row[$j]["ccndc_offerid"])) > 0)) echo "checked"; ?> onclick="getdetails(<?php echo $i;?>);" class="flip"/></td>
                    <td height="26" class="nrmltxt"><b><?php echo $row[$j]["card_name"];?></b></td>
                  </tr>
                  <?php  $i=$i+1;
				  $j=$j+1;
					} ?>
                  <?php
} 
else
{
	?>
                  <tr>
                    <td colspan="2" valign="top"><table class="font2">
                        <tr>
                          <td align="left" style="font-size:16px; font-weight:bold;"></td>
                        </tr><strong> <u>Best Offers for <?php echo date("F, Y"); ?>: </u></strong>
                        
        	
				<p style="font-family: 'Droid Sans', sans-serif; font-size: 16px; line-height: 20.8px;">
			<strong style="line-height: normal;">SBI Credit Card</strong></p>
		<ul style="margin: 5px 0px 0px; padding: 5px 0px 0px; font-family: 'Droid Sans', sans-serif; font-size: 16px;">
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Get 5% cashback on min. transaction of Rs 3000 and above <strong>More Megastore Stores</strong>. This offer is valid till 10th July 2016</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Get 20% discount applicable on Base Fare at <strong>www.airasia.com</strong>. The offer is valid till March 31, 2017</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				₹300 cashback on minimum booking amount ₹4,000 to ₹6,000 on domestic flight. The cashback is applicable on booking through website <strong>www.makemytrip.com.</strong> This offer is valid till 30th September, 2016</li>
		</ul>
		<p style="font-family: 'Droid Sans', sans-serif; font-size: 16px; line-height: 20.8px;">
			<strong style="line-height: normal;">HDFC Bank</strong></p>
		<ul style="margin: 5px 0px 0px; padding: 5px 0px 0px; font-family: 'Droid Sans', sans-serif; font-size: 16px;">
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				25% off on min purchase of&nbsp;₹1999 at&nbsp;<strong>Jabong.com</strong>. Use Code HDFC25. Offer valid till September 30, 2016</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Shop for Rs.2000 or more at&nbsp;<strong>Big Bazaar</strong>&nbsp;on Wednesdays and get 5% discount. Offer valid till March 31, 2017</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				10% off on Food and Soft beverage bill at&nbsp;<strong>Olive Bar</strong>. Offer valid till July 31, 2016</li>
		</ul>
		<p style="font-family: 'Droid Sans', sans-serif; font-size: 16px; line-height: 20.8px;">
			<strong style="line-height: normal;">HSBC Bank</strong></p>
		<ul style="margin: 5px 0px 0px; padding: 5px 0px 0px; font-family: 'Droid Sans', sans-serif; font-size: 16px;">
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				₹300 gift voucher on a bill of ₹1,600 to ₹2,499 (both values inclusive) at&nbsp;<strong>Mainland China, Oh! Calcutta, Mainland China Asia Kitchen, Sigree and Sigree Global Grill</strong>. Offer valid from 1 May 2016 to 30 April 2017</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				5% cash back on minimum order value of Rs. 1500 at&nbsp;<strong>BigBasket.com</strong>&nbsp;or the&nbsp;<strong>BigBasket Mobile App.</strong>&nbsp;The offer is valid till 30 September 2016</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Get a discount of ₹ 100* by booking movie tickets on the&nbsp;<strong>BookMyShow Mobile Application</strong>&nbsp;with your HSBC Credit and Debit Card. This offer is valid till 19 August 2016.</li>
		</ul>
		<p style="font-family: 'Droid Sans', sans-serif; font-size: 16px; line-height: 20.8px;">
			<strong style="line-height: normal;">Kotak Mahindra Bank</strong></p>
		<ul style="margin: 5px 0px 0px; padding: 5px 0px 0px; font-family: 'Droid Sans', sans-serif; font-size: 16px;">
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Additional 10% OFF* on all products at <strong>www.makemyhome.com</strong>. Offer valid till 31.01.2017</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				15% on Food Bill at <strong>Moti Mahal Delux</strong>. Not Valid on Alcoholic &amp; Non Alcoholic Beverages. Offers valid till 31.08.2016</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Buy 1 movie ticket at <strong>www.pvrcinemas.com</strong>, and get 1 movie ticket absolutely Free. This offer can be availed by booking tickets for Saturdays show on any day. Offer valid till 01-04-2017</li>
		</ul>
		<p style="font-family: 'Droid Sans', sans-serif; font-size: 16px; line-height: 20.8px;">
			<strong style="line-height: normal;">American Express Gold Card</strong></p>
		<ul style="margin: 5px 0px 0px; padding: 5px 0px 0px; font-family: 'Droid Sans', sans-serif; font-size: 16px;">
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				4,000 Bonus Membership Rewards® Points, to be awarded on using the Card 3 times within the first 60 days of Cardmembership, upon payment of annual fee.</li>
				<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				1,000 Bonus Membership Rewards Points for simply using your Card 6 times on transactions of Rs. 1,000 and above every month.</li>
     			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				With the American Express<sup>&#174;</sup> Gold Card, your next movie is on us</li>

		</ul>
		<p style="font-family: 'Droid Sans', sans-serif; font-size: 16px; line-height: 20.8px;">
			<strong style="line-height: normal;">Axis Bank</strong></p>
		<ul style="margin: 5px 0px 0px; padding: 5px 0px 0px; font-family: 'Droid Sans', sans-serif; font-size: 16px;">
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				15% Off on Food Bill at&nbsp;<strong>Pizza Hut</strong>. This offer is valid till 31.12.2017</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				15% Off on Total Bill at&nbsp;<strong>Caf&eacute; Coffee Day</strong>. Offer valid until 31.10.2016</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				14% off on non-electronics on ShopClues. Minimum spend Rs. 500, maximum discount Rs. 500 at&nbsp;<strong>Shopclues.com</strong>. This offer is valid till September 30, 2016</li>
		</ul>
		<p style="font-family: 'Droid Sans', sans-serif; font-size: 16px; line-height: 20.8px;">
			<strong style="line-height: normal;">Citibank</strong></p>
		<ul style="margin: 5px 0px 0px; padding: 5px 0px 0px; font-family: 'Droid Sans', sans-serif; font-size: 16px;">
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Save 15% on food at&nbsp;<strong>Berco&#39;s</strong>. Offer valid till August 31, 2016</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Instant saving of 15%* up to Rs 3500 on first booking on <strong>Airbnb</strong> with Citi cards. your card. This offer is valid till Jul 31, 2016</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Save 15% on bill at&nbsp;<strong>Moti Mahal Delux</strong>. This offer is valid till 30th September 2016</li>
		</ul>
		<div style="text-align:center;"><a href="http://www.mTuzo.com/download.php" target="_blank"><img src="images/300-BY-250--Blue-color.png" border="0" width="300" height="250" alt="mTuzo" /></a></div>

       <p style="font-family: 'Droid Sans', sans-serif; font-size: 16px; line-height: 20.8px;">
			<strong style="line-height: normal;">ICICI Bank</strong></p>
		<ul style="margin: 5px 0px 0px; padding: 5px 0px 0px; font-family: 'Droid Sans', sans-serif; font-size: 16px;">
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Flat 15% Off on using Pockets Card at <strong>Caf&eacute; Coffee Day</strong>. The offer is valid till December 31, 2016</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Get an additional 25% off on minimum purchase of Rs 1599 at <strong>www.jabong.com</strong>. Offer valid up to September 30, 2016</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Get up to Rs. 1200 off on domestic flight bookings at <strong>Flywidus.com</strong>. This offer is valid till July 31, 2016</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Get Rs. 1000 off per booking on Domestic Holiday Packages on min. spend of Rs 30000 at <strong>www.yatra.com</strong>. Offer valid up to September 30, 2016</li>
		</ul>
		<p style="font-family: 'Droid Sans', sans-serif; font-size: 16px; line-height: 20.8px;">
			<br style="line-height: normal;" />
			<strong style="line-height: normal;">Standard Chartered Bank</strong></p>
		<ul style="margin: 5px 0px 0px; padding: 5px 0px 0px; font-family: 'Droid Sans', sans-serif; font-size: 16px;">
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Get 20% off on a minimum bill of Rs. 400 at&nbsp;<strong>Cookie Man</strong>. The offer is valid until July 31 2016</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				12% off over a minimum transaction of Rs. 999 on website, mobile app and mobile site at&nbsp;<strong>Trendin.com</strong>. Promo code - SCBTRENDIN. Valid till 1 August, 2016</li>
			<li style="margin: 0px; padding: 0px 0px 4px 15px; list-style-type: none; background-image: url(&quot;http://www.bimadeals.com/new-images/blk-aro.gif&quot;); background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: 0px 4px; background-repeat: no-repeat;">
				Get 15% off on a minimum bill of ₹300 at&nbsp;<strong>Barista</strong>. Valid until July 31 2016.</li>
		</ul>
	

                        </td></tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
                  </tr>
                  <?php
}
?>
                </table></td>
            </tr>
          </table>
        </div>
        <div id="get_details"> </div>
      </div>
    </div>
  </div>
  <div style="clear:both; height:15px;"></div>
</div>
<!--partners-->
<?php include("footer_sub_menu.php"); ?>
</body>
</html>