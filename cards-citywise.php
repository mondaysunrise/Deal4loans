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

<div id="dining">

<!--<FIELDSET style="border:1px solid #cccccc;">
     <legend class="brdr3">Select your Card</legend>
         <LABEL >-->  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>Dining offer </b></td>
    </tr>
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Platinum Card          </td>
    </tr>
   
   
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
           
  </table>     

 <!--</LABEL>
      </FIELDSET>-->
</div>

<div id="travel">

<FIELDSET style="border:1px solid #cccccc;">
     <legend class="brdr3">Select your Card</legend>
         <LABEL > 
		
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
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
           
  </table>
  
  </LABEL>
      </FIELDSET>
</div>

<div id="petrol">

<FIELDSET style="border:1px solid #cccccc;">
     <legend class="brdr3">Select your Card</legend>
         <LABEL >  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
   
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
           
  </table>  

  </LABEL>
      </FIELDSET>
</div>

<div id="shopping">

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
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
           
  </table>  

  </LABEL>
      </FIELDSET>
</div>

<div id="entermnt">

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
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
           
  </table>  

  </LABEL>
      </FIELDSET>
</div>

<div id="rewards">

<FIELDSET style="border:1px solid #cccccc;">
     <legend class="brdr3">Select your Card</legend>
         <LABEL >  <table width="230" align="left" cellpadding="0" cellspacing="0"   >
<tr>
      <td height="21" align="left" valign="top"><input value="" name="" type="checkbox" style="border:none;" /></td>
      <td width="187" height="21" align="left"><b>ABN AMRO Bank </b></td>
    </tr>
   
    <tr>
      <td width="21" height="21" align="left" valign="top"><input value="" name="Input3" type="checkbox" style="border:none;" /></td>
      <td height="21" align="left">Barista Card</td>
    </tr>
           
  </table>  
  </LABEL>
      </FIELDSET>
</div>

<div id="other">

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