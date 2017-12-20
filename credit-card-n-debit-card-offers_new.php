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
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Credit Card Cash Back Offers - Check Latest Cash Back, Discounts, Reward points, offers on Credit Card and Debit Cards</title>

<meta name="keywords" content="credit card offers, credit cards eligibility, credit cards online information, credits cards schemes, credit card benefits, discounts on credits cards, compare credit cards in india, best credit card providers, apply online for credit cards, credit cards, credit card plans, online credit card, convenient credit card, Co branded credit cards, free credit cards, Cash back offers on cards">

<link href="source.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script type="text/javascript" src="scripts/mootools.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-list_cc.js"></script>
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>
<style type="text/css">
	
	/* START CSS NEEDED ONLY IN DEMO */
	
	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;
		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:175px;	/* Width of box */
		height:50px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #666666;	/* Dark green border */
		background-color:#FFFFFF;	/* White background color */
   		color: #333333;
		text-align:left;
		font-size:11px;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:11px;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#3d87d4;
		line-height:20px;
		color:#FFFFFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>


	<style type="text/css">
.content{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	vertical-align:top; }

.content table td
	{ font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:11px;
	vertical-align:top; }


.nrmltxt{
	text-decoration:none;
	color:#4d4d4d;
	font-weight:normal;
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px;
}
.bldtxt img{
	margin-right:6px;
	vertical-align:middle;
}

.bldtxt{
	text-decoration:none;
	line-height:20px;
	padding-left:8px;
	color:#7b4501;
	font-weight:bold;
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px;
}

.bnkbg{
	background-color:#f4f4f4; 
	border-left:5px solid #b2b2b2; 
	padding-left:8px;
	margin-top:10px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#444444;
	font-weight:bold;
	line-height:30px;

}
	.bldtxt1 {	text-decoration:none;
	line-height:20px;
	padding-left:8px;
	color:#7b4501;
	font-weight:bold;
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:11px;
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
	//alert("helo");
	//window.location.href = "http://www.deal4loans.com/credit-card-n-debit-card-offers.php";
	window.location.replace( "http://www.deal4loans.com/newdesign/credit-card-n-debit-card-offers.php" );


}


function getdetails(r)
		{
		//alert('cetogary_'+ r );	
			var new_CC_details=document.getElementById('cetogary_'+ r ).value;		
			var new_city=document.getElementById('city').value;
		//alert(document.getElementById('cetogary_'+ r ).value);


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
					   //alert(ajaxRequest.responseText);

					   
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}

	window.onload = ajaxFunction;
</script>
<script type="text/javascript" src="scripts/jquery.js"></script>
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

<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->


<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#4c4c4c;">Credit Card and Debit Card Offers</a></u></div>
<div class="intrl_txt">
<div style="width:970px; height:33; margin-top:25px; float:left; clear:right;">
<h1 class="text3"  style="width:850px; height:33; margin-top:0px; float:left; clear:right; font-size:32px; text-transform:none; color:#88a943; margin-left:15px;">Credit Card and Debit Card Offers for <?php echo date("F, Y"); ?></h1>
</div>
<div style=" margin-left:15px; float:left; width:850px; height:1px;; margin-top:1px; "><img src="images/point5.gif" width="850" height="1" /></div>

<div style="clear:both; height:5px;"></div>
  <div id="txt">
   <div class="faqContainer">
          <!--      <h3>FAQs</h3>-->
              <div id="serach" style="cursor:pointer; display:none; font-size:13px; text-align:left;"><b><u>Search More</u></b></div>
			  <? if ($_SERVER['REQUEST_METHOD'] == 'POST')
			  {
			  ?>
			  <div style="cursor:pointer; font-size:13px; text-align:right;"><b><u><a onclick="return modify_search();">Modify Search</a></u></b></div>
			  <? } ?>
				
				<div class="element atStart"><div id="panel">
				  <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="3" align="center" valign="middle" style="padding-bottom:15px;"><table width="100%" align="left" cellpadding="0" cellspacing="0"  style="border:1px dashed #7b4501;">
                          <tr>
                            <td height="60" colspan="3" valign="top"><form name="ccndc_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" >
                                <table width="100%" align="center" cellpadding="0" cellspacing="0" class="quick1">
                                  <input name="city" id="city"  type="hidden" value="<? echo $city_name; ?>"/>
                                  <input type="hidden" name="section" value="" />
                                  <input type="hidden" name="Source" value="health-insurance" />
                                  <tr>
                                    <td width="138" height="35" class="bldtxt1">Bank Name</td>
                                    <td align="left" valign="middle" colspan="5"><input name="Bank_name" id="Bank_name"   type="text" onkeyup="ajax_showOptions(this,'getCountriesByLetters',event)"  value="<? echo $Bank_name;?>"/>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="138" height="35" class="bldtxt1">Select your Type of Card</td>
                                    <td width="22" align="center" valign="middle"><input name="CC_Holder" id="CC_Holder" value="1" <? if($CC_Holder==1){ echo "checked";}?> type="radio"  style="border:none;" />
                                    </td>
                                    <td width="78" height="20" align="left" class="bldtxt1"> Credit Card </td>
                                    <td width="20" align="center" valign="middle"><input name="CC_Holder" id="CC_Holder" value="2"  <? if($CC_Holder==2){ echo "checked";}?> type="radio"  style="border:none;"/>
                                    </td>
                                    <td width="197" align="left" class="bldtxt1"> Debit Card</td>
                                    <td width="62" align="left" >&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td width="138" height="35" class="bldtxt1">Select City</td>
                                    <td align="left" colspan="5"><select id="card_city" name="card_city" style="width:150px;">
                                        <option value="All">Please Select</option>
                                        <option value="Ahmedabad" <? if($city_name=="Ahmedabad") { echo "Selected"; } ?>>Ahmedabad</option>
                                        <option value="Bangalore" <? if($city_name=="Bangalore") { echo "Selected"; } ?>>Bangalore</option>
                                        <option value="Chennai" <? if($city_name=="Chennai") { echo "Selected"; } ?>>Chennai</option>
                                        <option value="Delhi" <? if($city_name=="Delhi") { echo "Selected"; } ?>>Delhi & NCR</option>
                                        <option value="Hyderabad" <? if($city_name=="Hyderabad") { echo "Selected"; } ?>>Hyderabad</option>
                                        <option value="Kolkata" <? if($city_name=="Kolkata") { echo "Selected"; } ?>>Kolkata</option>
                                        <option value="Mumbai" <? if($city_name=="Mumbai") { echo "Selected"; } ?>>Mumbai</option>
                                        <option value="Pune" <? if($city_name=="Pune") { echo "Selected"; } ?>>Pune</option>
                                        <option value="All" <? if($city_name=="All") { echo "Selected"; } ?>>All</option>
                                      </select>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td colspan="7">&nbsp;</td>
                                  </tr>
                                  <? if ($_SERVER['REQUEST_METHOD'] != 'POST')
{
	?>
                                  <tr>
                                    <td colspan="7" id="myDiv" bgcolor="#fffbf6" align="center" height="40"><input name="Submit" class="btnclr" type="Submit" value="Submit" /></td>
                                  </tr>
                                  <? } ?>
                                </table>
                            </form></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td colspan="6" valign="top"><table width="100%" cellpadding="0" cellspacing="0">
                          <? if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	?>
                          <tr>
                            <td colspan="2" class="bnkbg"><? echo $Bank_name;?></td>
                          </tr>
                          <?
if($CC_Holder>0)
	{
			
		$selectcard = "select * From creditndebit_card_offer where (ccndc_offer_type=".$CC_Holder." and bank_name='".$Bank_name."' and ccndc_approval=1 and city_list='".$city_name."')";
		list($recordcount,$row)=MainselectfuncNew($selectcard,$array = array());
		if($recordcount<1)
		{
			$selectcard= "select * From creditndebit_card_offer where (ccndc_offer_type=".$CC_Holder." and bank_name='".$Bank_name."' and ccndc_approval=1 and city_list='All')";
			list($recordcount,$row)=MainselectfuncNew($selectcard,$array = array());
		}
		
	}
$i=0;
for($j=0;$j<$recordcount;$j++)
{
	//echo $i;
?>
                          <tr>
                            <td width="25" align="left"><? if($i==0) {?>
                                <!--<h3 class="toggler atStart">bye</h3>-->
                                <? } ?>
                                <input type="radio" value="<? echo $row[$j]["ccndc_offerid"];?>" name="cetogary" id="cetogary_<? echo $i;?>" style="border:none"   <?php if((strlen(strpos($strcategory, $row[$j]["ccndc_offerid"])) > 0)) echo "checked"; ?> onclick="getdetails(<? echo $i;?>);" class="flip"/></td>
                            <td height="26" class="nrmltxt"><b><? echo $row[$j]["card_name"];?></b></td>
                          </tr>
                          <?  $i=$i+1;
					} ?>
                          <? 
} 
else
{
	?>
                          <tr>
                            <td colspan="2" valign="top"><table class="font2">
                                <tr>
                                  <td align="left" style="font-size:14px; font-weight:bold;"><u>Best Offers for <?php echo date("F, Y"); ?>: </u> </td>
                                </tr>
                                <tr>
                                  <td><strong>SBI Credit Card</strong>:
                                     <ul>
            <li>50% free!!! Get <strong>Choco Rocks Drink</strong> Free on bill of Rs.150 & above. Choco Rocks Value: Rs.76 (as per menu card). Offer valid till 30th Sept. 2012. </li>
            <li>Get 25% off on movie tickets at <strong>www.bookmyshow.com</strong>. Offer valid on weekends (Fri-Sun). Offer valid till 31st October 2012  .</li>
          </ul><br />
                                    <strong>HDFC Credit Card</strong>:
                                    <ul>
          <li>Save up to 32% with&nbsp;<strong>Kingsize meals&nbsp;</strong>(pre-set) around&nbsp;<strong>Pizza, Pasta &amp; Tuscani Singles</strong>&nbsp;through using your&nbsp;<a href="http://www.deal4loans.com/loans/credit-card/hdfc-credit-card-eligibility-apply/" title="HDFC Credit Card">HDFC Credit Card</a>, Offer Valid up to 31st December 2012.</li>
          <li>Flat 20% Off on rack rates @&nbsp;<strong>Keys Hotels</strong>, India. Offer valid till 31st Dec 2012.</li>
        </ul><br />
                                    <strong>CITI Bank Card</strong>:
                                     <ul>
          <li>15% off&nbsp;on Food &amp; Soft Beverages through&nbsp;<a href="http://www.deal4loans.com/loans/credit-card/citibank-gold-credit-card-features-benefits-fees-and-charges-apply/" title="Citibank Gold Credit Card">Citibank Gold Credit Card</a>&nbsp;at&nbsp;<strong>The Embassy Restaurant</strong>. Offer validity: Till 31st December 2012. Offer available in Delhi only.</li>
          <li>Save 15% on food & soft beverages through Citi Titanium Cash Rewards Credit Card at <strong>The Great Kabab Factory</strong>. Offer validity: Till December 2012 </li>
        </ul><br />
                                    <strong>Kotak Mahindra Bank Card</strong>:
                                    <ul>
          <li>10% off on purchases worth Rs. 1000 and above at&nbsp;<strong>Tantra</strong>&nbsp;throug using&nbsp;<a href="http://www.deal4loans.com/loans/credit-card/kotak-mahindra-credit-cards-eligibility-offers-documents-apply/" title="Kotak Bank Credit Card">Kotak Bank Credit Card</a>. Offer valid till: 31st Dec 2012</li>
          <li>15% discount on food &amp; soft beverages at&nbsp;<strong>Jing, Ikko, Curry Leaf, Sliac, earth Italian Lounge Bar, Edesia, 56 Restorante Italiano, Zook, Sushi Cuisine from the orient, Stone Italiano Cuisine, Den and Chaobella</strong>. This offer valid till 30th September, 2012.</li>
        </ul><br />
                                    <strong>Standard Chartered Bank:</strong>
                                     <ul>
          <li>Enjoy 25% discount on movie tickets at&nbsp;<strong>www.bookmyshow.com</strong>. Offer valid on weekends (Fri-Sun). On all cinemas available at&nbsp;<strong>www.bookmyshow.com</strong>. This offer is valid till 31st Oct 2012. Valid only for&nbsp;<a href="http://www.deal4loans.com/loans/credit-card/standard-chartered-platinum-elite-card-offers-eligibility-apply-online/" title="Standard chartered Platinum Elite credit card">Standard chartered Platinum Elite credit card</a>.</li>
          <li>Discount upto 70% from a wide range of Diamonds Precious, Semi Precious and Artificial Jewellery at <strong>Surat Diamond Jewellery</strong>. </li>
        </ul><br />
                                    <strong>Axis Bank</strong>:
                                   <ul>
          <li>Save up to 30% with exclusive customized meals for 2 /4 people - Choice of sandwiches, beverage and dessert at&nbsp;<strong>Barista</strong>through using your Axis Bank Priority Debit Card.</li>
          <li>Get 25% off on Platinum Cards. Valid on weekends (Fri, Sat, Sun).Valid on all cinemas available at&nbsp;<strong>www.bookmyshow.com</strong>. The Promotion Period is up to 31st October 2012.</li>
        </ul><br />
                                    <strong>ICICI Bank Card:</strong>
                                     <ul>
          <li>Get 15% discount at&nbsp;<strong>Diti Jewellery stores</strong>&nbsp;on purchases made using your ICICI Bank Credit Card.&nbsp; Offer valid till August 31, 2012</li>
          <li>Book your railway tickets through&nbsp;<strong>Irctc.com</strong>&nbsp;&amp; pay in 3 to 6 easy EMIs.(Processing fees will be applicable). This offer is available on<a href="http://www.deal4loans.com/loans/credit-card/icici-bank-visa-signature-credit-card-eligibility-features-offers-apply/" title="ICICI Visa Signature Credit Card">ICICI Visa Signature Credit Card</a>.<br>
          </li>
        </ul><br />
                                    <strong>HSBC Bank Card:</strong>
                                       <ul>
          <li>5% cash back* on Domestic Holidays (Maximum cash back per card 2000 per booking) at <strong>makemytrip.com</strong>.Offer valid till 31 March 2013.</li>
          <li>15% discount on Food & Beverages at <strong>Kwality Restaurant</strong>. Offer valid till 31st December 2012</li>
        </ul></td>
                                </tr>
                            </table></td>
                          </tr>
                          <?php
}
?>
                      </table></td>
                      <td valign="top"><script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 160x600, created 6/28/10 */
google_ad_slot = "8134438230";
google_ad_width = 160;
google_ad_height = 600;
//-->
                  </script>
                          <script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
                    </script>
                      </td>
                    </tr>
                  </table>
				</div>

	<div id="get_details">
	</div>

<div align="left"><script type="text/javascript"><!--
google_ad_client = "pub-6880092259094596";
/* 728x90, created 09/07/11 */
google_ad_slot = "9537748699";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>

</div></div></div>


<div style="clear:both; height:15px;"></div>
</div>
<!--partners-->
<!--partners-->
<?php include "footer1.php"; ?>

</body>
</html>
