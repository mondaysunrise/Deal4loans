<?php
	require 'scripts/functions.php';
		require 'scripts/db_init.php';
	session_start();
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Compare Offers</title>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link rel="stylesheet" href="style/jquery-tabs.css" type="text/css" media="print, projection, screen">
<!-- Additional IE/Win specific style sheet (Conditional Comments) -->
<!--[if lte IE 7]>
<link rel="stylesheet" href="style/jquery-tabs-ie.css" type="text/css" media="projection, screen">
<![endif]-->
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<script src="js/jquery-1.1.3.1.pack.js" type="text/javascript"></script>
<script src="js/jquery.history_remote.pack.js" type="text/javascript"></script>
<script src="js/jquery.tabs.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {

$('#tabs').tabs();
});
</script>

</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<span><a href="index.php">Home</a> > <a href="cards-offer.php">Compare Offers</a> > Credit Card</span>
<div id="tabs" style="margin-top:10px;">
<ul>
<li><a href="#dining" class="active"><span>Dining Offers</span></a></li>
<li><a href="#travel"><span>Travel Offers</span></a></li>
<li><a href="#petrol"><span>Petrol Offers</span></a></li>
<li><a href="#shopping"><span>Shopping Offers</span></a></li>
<li><a href="#entermnt"><span>Entertainment Offers</span></a></li>
<li><a href="#rewards"><span>Rewards Points Offers</span></a></li>
<li><a href="#other"><span>Other Offers</span></a></li>
</ul>

<div id="dining"><img src="new-images/dining.jpg" width="914" height="79" border="0" />

<FIELDSET style="border:1px solid #cccccc;">
     <legend class="brdr3">Select your Card</legend>
         <LABEL >  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
           
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>

  </LABEL>
      </FIELDSET>
</div>

<div id="travel"><img src="new-images/travel.jpg" width="914" height="79" border="0" />

<FIELDSET style="border:1px solid #cccccc;">
     <legend class="brdr3">Select your Card</legend>
         <LABEL > 
		 <?
		 $gettravelbank=("Select * from creditndebit_card_offer Where (travel_offers!='') group by bank_name order by 'select count() from creditndebit_card_offer where 1=1 group by bank_name' asc ");
		list($recordcount,$trave)=MainselectfuncNew($gettravelbank,$array = array());
		$i=0;
			
			while($i<count($trave))
        {
			//echo $i;
			$bank_name = $trave[$i]['bank_name'];
			
		 ?>
		 <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><!--<input value="" name="" type="checkbox" style="border:none;" /> --></td>
      <td width="187" height="21" align="left"><b><? echo $bank_name; ?></b></td>
    </tr>
	<?
		 	$getdiningoffers=("Select * from creditndebit_card_offer Where (travel_offers!='' and bank_name='".$bank_name."')");
			
			list($recordcountRows,$din)=MainselectfuncNew($getdiningoffers,$array = array());
			
			$cntr=0;
			while($cntr<count($din))
        {
			
			$ccndc_offerid = $din[$cntr]['ccndc_offerid'];
			
			$card_name = $din[$cntr]['card_name'];
			$dinning_offers = $din[$cntr]['dinning_offers'];   	
			 ?>			
			
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="<? echo $ccndc_offerid; ?>" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left"><? echo $card_name; ?></td>
    </tr>
			
			
		 <? 
		$cntr=$cntr+1;
		 }
		 $i=$i+1;
		 if($i==4)
		 {
		 echo $i;
		 	?>
			 </table>new table<br />
			<?
		 }
		 }
		 ?>
		 </table>
		  <!--<table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
           
  </table> -->  <!--<table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table> -->  <!--<table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table> -->  <!--<table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table> -->

  </LABEL>
      </FIELDSET>
</div>

<div id="petrol"><img src="new-images/petrol.jpg" width="914" height="79" border="0" />

<FIELDSET style="border:1px solid #cccccc;">
     <legend class="brdr3">Select your Card</legend>
         <LABEL >  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
           
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>

  </LABEL>
      </FIELDSET>
</div>

<div id="shopping"><img src="new-images/shpping.jpg" width="914" height="79" border="0" />

<FIELDSET style="border:1px solid #cccccc;">
     <legend class="brdr3">Select your Card</legend>
         <LABEL >  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
           
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>

  </LABEL>
      </FIELDSET>
</div>

<div id="entermnt"><img src="new-images/entrmnt.jpg" width="914" height="79" border="0" />

<FIELDSET style="border:1px solid #cccccc;">
     <legend class="brdr3">Select your Card</legend>
         <LABEL >  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
           
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>

  </LABEL>
      </FIELDSET>
</div>

<div id="rewards"><img src="new-images/rwrds.jpg" width="914" height="79" border="0" />

<FIELDSET style="border:1px solid #cccccc;">
     <legend class="brdr3">Select your Card</legend>
         <LABEL >  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
           
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    
    
    
  </table>

  </LABEL>
      </FIELDSET>
</div>

<div id="other"><img src="new-images/other.jpg" width="914" height="79" border="0" />

<FIELDSET style="border:1px solid #cccccc;">
     <legend class="brdr3">Select your Card</legend>
         <LABEL >  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top">&nbsp;</td>
      <td height="21" align="left">&nbsp;</td>
    </tr>
           
  </table>  
         <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top">&nbsp;</td>
      <td height="21" align="left">&nbsp;</td>
    </tr>
  </table>  
         <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top">&nbsp;</td>
      <td height="21" align="left">&nbsp;</td>
    </tr>
  </table>  
         <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top">&nbsp;</td>
      <td height="21" align="left">&nbsp;</td>
    </tr>
  </table>
  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top">&nbsp;</td>
      <td height="21" align="left">&nbsp;</td>
    </tr>
  </table>
    <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">MakeMyTrip Go Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Titanium One Card          </td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Smart Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">New Gold Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input2" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">One Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Freedom Card          </td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
    <tr>
      <td height="21" align="left" valign="top">&nbsp;</td>
      <td height="21" align="left">&nbsp;</td>
    </tr>
  </table>

  </LABEL>
      </FIELDSET>
</div>
</div>
</div>
</div>
</body>
</html>