<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hdfc Car Loan Rewards</title>
<link href="hadf-rewards-styles.css" rel="stylesheet" type="text/css" />
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
	window.location.href = 'hdfc-giftsrewards.php#' + i;
}
</script>
<style>
.hdfc-rewards_topbox{ width:100%; height:95px; margin:auto; background:url(images/brochure/rewards-top-bg.jpg) repeat-x; }
.hdfc-rewards_top_contentbox{ width:1000px; margin:auto;  }
</style>
</head>

<body><div class="hdfc-rewards_topbox">
<div class="hdfc-rewards_top_contentbox">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr><td width="23%" ><img src="images/newimages/eligibility-check-hdfc-logo.jpg" border="0" height="95" width="208"></td>
    <td width="77%"  align="right">
      <span class="hdfc-rewards_text_B" ><br /><br />Get Welcome Rewards on successful Referral Disbursal&nbsp;</span></td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><br />
  <div class="hdfc-rewards_select_box">
   <form name="selRange" id="selRange" action="" method="post">
    <select name="selectRange" id="selectRange" onChange="clickAnchor();" class="select-menu_text" style="height:25px; padding:2px; width:150px; border-radius:5px 5px 5px 5px; border:thin solid #CCCCCC;">
  <option value="">Select Loan Range</option>
<?php
$getRangeSql = "select range from hdfc_car_loan_gifts where status=1 group by range order by min_range asc";
list($numRowsRange,$getRangeQuery)=MainselectfuncNew($getRangeSql,$array = array());
for($j=0;$j<$numRowsRange;$j++)
{
	$range = $getRangeQuery[$j]['range'];
	$anchor = $k +1;
	echo  '<option value="range-'.$range.'">'.$range.'</option>';
}  
?>  
            </select>
            </form>
         </div>   </td>
  </tr>
</table>
  </div>
</div>
<div class="hdfc-rewards_content_box_B" style="padding-top:40px;">
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
$range = $_REQUEST['range'];
$getRangeSql = "select range from hdfc_car_loan_gifts where status=1 group by range order by min_range asc";
list($numRowsRange,$getRangeQuery)=MainselectfuncNew($getRangeSql,$array = array());
for($j=0;$j<$numRowsRange;$j++)
{
	$range = $getRangeQuery[$j]['range'];
	$anchor = $j +1;
	?>
  <tr><td align="left" class="hdfc-rewards_product_heading" style="padding-bottom:10px; font-size:13px;" id="range-<?php echo $range; ?>">Loan Range : <?php echo $range; ?></td></tr> 

<tr><td>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<?php
if(strlen($range)>0)
{
	$getProductsSql = "select * from hdfc_car_loan_gifts where range = '".$range."' and status=1 order by id asc";
}
else
{
	$getProductsSql = "select * from hdfc_car_loan_gifts where status=1  order by id asc";
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
?>        
          <td width="451" valign="top"><table width="403" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>
          <table width="403" border="0" cellpadding="0" cellspacing="0" style="border:#CCCCCC thin solid; padding:5px;">
            <tr>
              <td colspan="2" align="left" class="hdfc-rewards_product_heading" style="color:#048ed6;"><?php echo $Product_Name; ?></td>
            </tr>
            <tr>
              <td width="104" align="center"><img src="images/brochure/<?php echo $image; ?>" width="103" height="124" /></td>
              <td width="295" valign="top"><p class="select-menu_text"><?php echo $specifications; ?></p></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td style=" background:url(images/brochure/rewards-top-shadow.jpg) no-repeat; ">&nbsp; </td>
        </tr>
      </table></td>
<?php
if($divedend==1 && $i!=0)
{
	echo "</tr><tr>";
}
}
?>
</tr>

    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
