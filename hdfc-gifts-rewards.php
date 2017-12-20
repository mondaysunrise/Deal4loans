<?php

include "hdfc-gifts-rewards2.php";
exit();

require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HDFC Car Loan Gifts & Rewards</title>
<script src="facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>
<link href="facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="facefiles/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox() 
    })
</script>
<script language="javascript">
function clickAnchor()
{
	var i;
	i = document.selRange.selectRange.value;
	window.location.href = 'hdfc-gifts-rewards.php#' + i;
}
</script>
<style type="text/css">
.main-wrapper{ width:990px; height:800px; margin: auto;}
.header-box{ width:95%; padding:0px 0px 20px 10px; height:35px;}
.heading_A{ font-family:Arial, Helvetica, sans-serif; font-size:23px; font-weight:bold; color:#9c9898; margin:0px 0px 0px 0px; padding:0px 0px 0px 0px;}
.heading_B{ font-family:Arial, Helvetica, sans-serif; font-size:23px; color:#000; font-weight:bold; margin:0px 0px 0px 0px; padding:0px 0px 0px 0px;}
.heading_C{ font-family:Arial, Helvetica, sans-serif; font-size:16px; color:#3d85cc; font-weight:bold; margin:0px 0px 0px 0px; padding-left:25px; padding-bottom:13px; padding-top:3px; }
.thickstyle{
background: silver;
}
.product_text_A{ font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#5f5e5e; text-align:center; font-weight:bold;}
.product_text_B{ font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#f47317; text-align:center; font-weight:bold;}
.product_text_C{ font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#3d85cc; text-align:center; font-weight:bold;}
</style>
</head>

<body style="background: #ffffff;">
<div class="main-wrapper">
<div class="header-box"><span class="heading_A">Exclusive offers for Deal4loans customers.</span> <br /><span class="heading_B">Get welcome Rewards on successful loan disbursal.</span></div>
<div style="clear:both;"></div>
<div >
<table cellpadding="0" cellspacing="2" border="0" width="990">
  <tr><td class="heading_C" align="right" style="padding-right:120px;">
 <form name="selRange" id="selRange" action="" method="post">
  <select name="selectRange" onchange="clickAnchor();" style="width:175px; height:25px; border-radius:5px 5px 5px 5px; border:thin #bebebf solid;">
  <option value="">Select Loan Range</option>
<?php
$getRangeSql = "select range from hdfc_car_loan_gifts where status=1 group by range order by min_range asc";
list($numRowsRange,$getRangeQuery)=MainselectfuncNew($getRangeSql,$array = array());

for($k=0;$k<$numRowsRange;$k++)
{
	$range = $getRangeQuery[$k]['range'];
	$anchor = $k +1;
	echo  '<option value="range-'.$range.'">'.$range.'</option>';
}  
?>  
  </select>
  </form>
  </td></tr> 

<?php
//$range = $_REQUEST['range'];
$getRangeSql = "select range from hdfc_car_loan_gifts where status=1 group by range order by min_range asc";
list($numRowsRange,$getRangeQuery)=MainselectfuncNew($getRangeSql,$array = array());
for($j=0;$j<$numRowsRange;$j++)
{
	$range = $getRangeQuery[$j]['range'];
	$anchor = $j +1;
	?>
  <tr><td class="heading_C" style="" id="range-<?php echo $range; ?>">Loan Range : <?php echo $range; ?></td></tr> 

<tr><td align="center">
<table cellpadding="0" cellspacing="2" border="0" width="900">
<tr>
<?php
if(strlen($range)>0)
{
	$getProductsSql = "select * from hdfc_car_loan_gifts where range = '".$range."' and status=1";
}
else
{
	$getProductsSql = "select * from hdfc_car_loan_gifts where status=1";
}
list($numRowsProducts,$getProductsQuery)=MainselectfuncNew($getProductsSql,$array = array());
for($i=0;$i<$numRowsProducts;$i++)
{
	$divedend = $i%3;
	$id = $getProductsQuery[$i]['id'];
	$Name = $getProductsQuery[$i]['Name'];
	$image = $getProductsQuery[$i]['image'];
	$estimated_delivery = $getProductsQuery[$i]['estimated_delivery'];
	$manufacturer = $getProductsQuery[$i]['manufacturer'];
	$specifications = $getProductsQuery[$i]['specifications'];
	echo "<td align='center' width='300' valign='top'>";
	echo '<table width="100%" border="0" cellspacing="3" cellpadding="0">  <tr>    <td align="center">';
	echo "<a href='getGiftDetails.php?id=".$id."'  rel='facebox[.thickstyle]'><img src='images/brochure/".$image."' border='1' height='150' width='150' /></a></td>    </tr>";
   echo ' <td  align="center"><span class="product_text_C">'.$Name.'</span></td></tr><tr><td align="center">';
 echo  '<span class="product_text_B" style="padding-bottom:15px;">Delivery in '.$estimated_delivery.'</span></td></tr><tr><td align="center">';
	echo "<a href='getGiftDetails.php?id=".$id."'  onmouseover='getGiftDetails.php?id=".$id."' class='product_text_A'  rel='facebox[.thickstyle]' ><img src='images/brochure/buttton.jpg' border='0'  /></a></td>";
echo '</tr></table>';
	
	echo "<br></td>";
	if($divedend==2 && $i!=0)
	{
		echo "</tr><tr>";
	}
}	
?>
</tr>
</table>

</td></tr>
<?php
}
?>
</table>
</div>
</body>
</html>
