<?php
$conn = mysql_connect("localhost","root","");
$db = mysql_select_db("deal4loans_primary",$conn);
//include "../scripts/db_init.php";
$page_url = $_SERVER['REQUEST_URI'];
$page_arr = explode("/",$page_url);
$page_arr_length = count($page_arr);
$third_last_element = ($page_arr_length-2);
$page_name_arr = $page_arr[$third_last_element];

$page_name = $page_name_arr;

$arrBankName = explode("-",$page_name);

$bankListSql = "select abbr from Bank_Master";
$bankListQry = mysql_query($bankListSql);

while($bankListRes=mysql_fetch_array($bankListQry)){
	
	$bankListAbbr[] = $bankListRes['abbr'];
}

$Bank_name_arr = array_intersect($arrBankName,$bankListAbbr);
$Bank_name = implode("",$Bank_name_arr);

$bnkNameQry = mysql_query("select Bank_Name,abbr from Bank_Master where abbr='".$Bank_name."'");
$bnkNameRes = mysql_fetch_array($bnkNameQry);
$BankFullName = $bnkNameRes['Bank_Name'];
//echo "Bank Name: ".$BankFullName;

$showCardInfoSql = "select bank_name,card_name,dinning_offers,shopping_offers,entertainment_offers,travel_offers,petrol_offers,reward_points_offers,other_offers From creditndebit_card_offer where (bank_name like '%".$Bank_name."%' and ccndc_approval=1 and ccndc_offer_type=1 and city_list='All') group by card_name limit 0,1";
$showCardInfoQry = mysql_query($showCardInfoSql);
//echo $Bank_Full_Name = mysql_result($showCardInfoQry,0,'bank_name');

?>

<style>
.bnkbg{
	background-color: #D5EAFF; 
	border-left:5px solid #0066CC; 
	padding-left:8px;
	margin-top:10px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#444444;
	font-weight:bold;
	line-height:30px;
}
.bnkbg_sub{
	background-color: #DDFFBB; 
	border-left:5px solid #0066CC; 
	padding-left:8px;
	margin-top:10px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#444444;
	font-weight:bold;
	line-height:30px;
}
.no_record{
	font-size:14px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	color:#CC3300;
	padding:5px;
	text-align:center;
	text-decoration:none;
}
.heading_text{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#444444;
	font-weight:bold;
	line-height:30px;
}
.general_text{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#444444;
	line-height:30px;
}
</style>
<table width="100%" border="0" cellpadding="10" cellspacing="0">
  <tr>
  	<td style="height:2px;"></td>
  </tr>
  <tr>
  	<td class="bnkbg"><h3>Latest Offers on <?php echo $BankFullName." Bank"; ?> Credit Cards - <?php echo date('d F Y') ?></h3></td>
  </tr>
  <tr>
  	<td>
    <table width="100%" border="1" cellpadding="5" cellspacing="0">
		<?php if(mysql_num_rows($showCardInfoQry)<=0){ ?>
        <tr>
            <td colspan="2" class="no_record"> No records found! </td>
        </tr>
        <?php 
		}else{ 
			while($showCardInfoRow=mysql_fetch_array($showCardInfoQry)){
			
				//$findStr = '<strong>6:- </strong>';
		?>
        <tr>
            <td colspan="2" class="bnkbg_sub"><h4><?php echo $showCardInfoRow['card_name']; ?></h4></td>
        </tr>
        <?php if(trim($showCardInfoRow['dinning_offers'])!=""){ ?>
        <tr>
        	<td width="15%" valign="top" class="heading_text"><h4>Dinning Offers</h4></td>
       	    <td width="85%" class="general_text">
			<?php
			//echo $showCardInfoRow['dinning_offers'];
			//$position = strpos($showCardInfoRow['dinning_offers'],$findStr);
			//echo "position".$position."<br>";
			
			echo substr($showCardInfoRow['dinning_offers'],0,1450);
			echo "<br /><br />";
			echo "<div style='width:100%; text-align:right;'><a href='http://www.deal4loans.com/credit-card-n-debit-card-offers.php' target='_blank'>read more...</a></div>"; 
			?>
            </td>
        </tr>
        <?php } ?>
        <?php if(trim($showCardInfoRow['shopping_offers'])!=""){ ?>
        <tr>
        	<td valign="top" class="heading_text"><h4>Shopping Offers</h4></td>
        	<td class="general_text">
			<?php 
			//echo $showCardInfoRow['shopping_offers']; 
			echo substr($showCardInfoRow['shopping_offers'],0,800);
			echo "<br /><br />";
			echo "<div style='width:100%; text-align:right;'><a href='http://www.deal4loans.com/credit-card-n-debit-card-offers.php' target='_blank'>read more...</a></div>";
			?>
            </td>
        </tr>
        <?php } ?>
        <?php if(trim($showCardInfoRow['entertainment_offers'])!=""){ ?>
        <tr>
        	<td valign="top" class="heading_text"><h4>Entertainment Offers</h4></td>
        	<td class="general_text">
			<?php 
			#echo $showCardInfoRow['entertainment_offers'];
			echo substr($showCardInfoRow['entertainment_offers'],0,800);
			echo "<br /><br />";
			echo "<div style='width:100%; text-align:right;'><a href='http://www.deal4loans.com/credit-card-n-debit-card-offers.php' target='_blank'>read more...</a></div>";
			?>
            </td>
        </tr>
        <?php } ?>
        <?php if(trim($showCardInfoRow['travel_offers'])!=""){ ?>
        <tr>
        	<td valign="top" class="heading_text"><h4>Travel Offers</h4></td>
        	<td class="general_text">
			<?php 
			#echo $showCardInfoRow['travel_offers']; 
			echo substr($showCardInfoRow['travel_offers'],0,800);
			echo "<br /><br />";
			echo "<div style='width:100%; text-align:right;'><a href='http://www.deal4loans.com/credit-card-n-debit-card-offers.php' target='_blank'>read more...</a></div>";
			?>
            </td>
        </tr>
        <?php } ?>
        <?php if(trim($showCardInfoRow['petrol_offers'])!=""){ ?>
        <tr>
        	<td valign="top" class="heading_text"><h4>Petrol Offers</h4></td>
        	<td class="general_text">
			<?php 
			#echo $showCardInfoRow['petrol_offers']; 
			echo substr($showCardInfoRow['petrol_offers'],0,800);
			echo "<br /><br />";
			echo "<div style='width:100%; text-align:right;'><a href='http://www.deal4loans.com/credit-card-n-debit-card-offers.php' target='_blank'>read more...</a></div>";
			?>
            </td>
        </tr>
        <?php } ?>
        <?php if(trim($showCardInfoRow['reward_points_offers'])!=""){ ?>
        <tr>
        	<td valign="top" class="heading_text"><h4>Reward Point Offers</h4></td>
        	<td class="general_text">
			<?php 
			#echo $showCardInfoRow['reward_points_offers'];
			echo substr($showCardInfoRow['reward_points_offers'],0,800);
			echo "<br /><br />";
			echo "<div style='width:100%; text-align:right;'><a href='http://www.deal4loans.com/credit-card-n-debit-card-offers.php' target='_blank'>read more...</a></div>";
			?>
            </td>
        </tr>
        <?php } ?>
        <?php if(trim($showCardInfoRow['other_offers'])!=""){ ?>
        <tr>
        	<td valign="top" class="heading_text"><h4>Other Offers</h4></td>
        	<td class="general_text">
			<?php 
			#echo $showCardInfoRow['other_offers'];
			echo substr($showCardInfoRow['other_offers'],0,800);
			echo "<br /><br />";
			echo "<div style='width:100%; text-align:right;'><a href='http://www.deal4loans.com/credit-card-n-debit-card-offers.php' target='_blank'>read more...</a></div>";
			?>
            </td>
        </tr>
        <?php } ?>
        <?php if(trim($showCardInfoRow['ccndc_features'])!=""){ ?>
        <tr>
        	<td valign="top" class="heading_text"><h4>Other Features</h4></td>
        	<td class="general_text">
			<?php 
			#echo $showCardInfoRow['ccndc_features']; 
			echo substr($showCardInfoRow['ccndc_features'],0,800);
			echo "<br /><br />";
			echo "<div style='width:100%; text-align:right;'><a href='http://www.deal4loans.com/credit-card-n-debit-card-offers.php' target='_blank'>read more...</a></div>";
			?>
            </td>
        </tr>
        <?php } ?>
        <?php
			}
		}
		?>
    </table>
    </td>
  </tr>
</table>