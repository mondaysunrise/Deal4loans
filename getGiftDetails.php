<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
$id = $_REQUEST['id'];


$getCarSql = "select * from hdfc_car_loan_gifts where id = '".$id."'";
list($getCarNumRows,$getProductsQuery)=MainselectfuncNew($getCarSql,$array = array());
$i = 0;
$id = $getProductsQuery[$i]['id'];
$Name = $getProductsQuery[$i]['Name'];
$image = $getProductsQuery[$i]['image'];
$estimated_delivery = $getProductsQuery[$i]['estimated_delivery'];
$manufacturer = $getProductsQuery[$i]['manufacturer'];
$specifications = $getProductsQuery[$i]['specifications'];
?>
<style type="text/css">
.view_text-headign{ font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#14aadb; font-weight:bold;}
.Sub_text{ font-family:Arial, Helvetica, sans-serif; font-size:14px; color: #FF9933; font-weight:bold;}
.Sub_text_b{ font-family:Arial, Helvetica, sans-serif; font-size:14px; color: #666666; font-weight:normal;}
</style>
<table cellpadding="3" cellspacing="0" border="0" bgcolor="#FFFFFF" >
<tr><td class="view_text-headign"><?php echo $Name; ?></td></tr>
<tr><td align="center"><img src='images/brochure/<?php echo $image; ?>' border=0 height=200 width=200 /></td></tr>
<tr><td class="Sub_text"><?php echo $manufacturer; ?></td></tr>
<tr><td class="Sub_text_b"><?php echo $specifications; ?></td></tr>
<tr><td class="Sub_text_b"><b>Delivery in <?php echo $estimated_delivery; ?></b></td></tr>
</table>