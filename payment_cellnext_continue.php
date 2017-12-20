<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

$refid = $_POST['refid'];
$mobno = $_POST['mobno'];
$amt = $_POST['amt'];

	$Dated = ExactServerdate();
	$DataArray = array("name"=>$Full_Name , "mobile"=>$Email, "Amount"=>$Mobile_No, "dated"=>$Dated);
	$table = 'payment_cellnext_details';
	$lastID = Maininsertfunc ($table, $DataArray);

echo " ";
?>
<form action="https://Cellpay.co.in/CellPayWeb20/Merchant/MIP.aspx" method="post" name="cellll">
                 <input id="refid" name="refid" type="hidden" value="<?php echo $refid; ?>"  />
                 <input id="mobno" name="mobno" type="hidden"  value="<?php echo $mobno; ?>" />
		<input id="amt" name="amt" type="hidden"  value="<?php echo $amt; ?>"  /> 
		               <input id="mtranid" name="mtranid" type="hidden" value="wrsinfo"/>                
                 <input id="merchshortname" name="merchshortname" type="hidden" value="wrs" />
                 <input id="prodcode" name="prodcode" type="hidden" value="" />
                 <input id="returnurl" name="returnurl" type="hidden" Value="http://www.deal4loans.com/payment_cellnext_thanks.php?uid=<?php echo $lastID; ?>"  />
				 		<script language="JavaScript">document.cellll.submit();</script>	
 </form>
