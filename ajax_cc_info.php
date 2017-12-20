<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$card_category = $_REQUEST['cat_tag'];
//echo "category: ".$card_category."<br>";


$showCardSql = "SELECT * FROM credit_card_banks_eligibility WHERE cc_bank_flag=1 and category_tag in (".$card_category.")";
list($alreadyExist,$showCardRes)=MainselectfuncNew($showCardSql,$array = array());


for($i=0;$i<$alreadyExist;$i++)
{
//echo "imgs: ".$showCardRes['card_image']."<br>";
?>
<div class="table-credit-card">
  <table width="100%" border="0" style="pa" cellspacing="0" cellpadding="10">
    <tr>
      <th width="24%" height="25" align="center" scope="row"><table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="39%" align="left" class="rating-text" scope="row"><em>Rate this Card</em></td>
          <td width="61%" align="left" class="rating-text"><img src="images/rating-green.png" width="90" height="17"></td>
        </tr>
      </table></th>
      <td width="13%" rowspan="2" align="center" bgcolor="#00adeb" class="white-text tablebody-text" style="color:#FFF; background:#00adeb;">Fee : Option I</td>
      <td width="12%" rowspan="2" align="left" class="tablebody-text" style="border-right:#49d9fb solid thin;"><?php echo $showCardRes[$i]['cc_bank_fee_content']; ?>*</td>
      <td width="17%" rowspan="2" align="left" class="tablebody-text2" style="border-right:#49d9fb solid thin;"><?php echo $showCardRes[$i]['cc_bank_features']; ?></td>
      <td width="17%" rowspan="2" align="left" class="tablebody-text" style="border-right:#49d9fb solid thin;"><?php echo $showCardRes[$i]['cc_bank_new_features']; ?></td>
      <td width="17%" rowspan="2" align="left" class="tablebody-text"><?php echo $showCardRes[$i]['cc_other_charges']; ?></td>
    </tr>
    <tr>
      <th height="178" align="center" scope="row">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th width="49%" scope="row"><img src="<?php echo $showCardRes[$i]['card_image']; ?>" width="104" height="70" /></th>
          <td width="51%"><?php echo $showCardRes[$i]['cc_bank_name']; ?></td>
        </tr>
      </table>
      </th>
    </tr>
  </table>
</div>
<?php
}
?>