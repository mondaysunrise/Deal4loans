<?php
include "includes/header.php";
$sql = "SELECT * FROM " . TABLE_BANK." WHERE id='".$_REQUEST['id']."'";
	$result = $obj->fun_db_query($sql);
	$rowsCon = $obj->fun_db_fetch_rs_object($result);
	
if(isset($_POST['Submit']))
	{
		$editBank = $objAdmin->processAddBankName($_REQUEST['id'],"EDIT");
		
		if($editBank)
			{
				$rUrl = SITE_URL."edit-bank.php?id=".$_REQUEST['id']."&msg=edit";
				$objAdmin->redirectURL($rUrl);		
			}
	}
?>
<div id="payment_container-dash_page">
  <?php include "includes/left.php";?>
  <div class="content_right">
    <h1>Edit Bank Name</h1>
    <br />
    <?php if($_REQUEST['msg'])
			{
		?>
    <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/ ><?php  echo "Record Updated";?></div>
    <?php }?>
    <div class="mid_part">
      <div class="contentBox">
      <form action="" method="post" name="Frm"  onsubmit="return valAddBank();">
     
        <div class="row">
          <label>Bank Name :</label>
         <input name="bankName" type="text" id="bankName" size="15" value="<?php echo $rowsCon->bank_name;?>" >
        </div>
        <div class="row">
          <label>Status :</label>
           <input type="checkbox" name="flag" id="flag" value="1" checked="checked" style="float:none;" />
        </div>
        
        <div class="row">
          <label> <span><a href="view-bank.php" class="button small">Back<img src="./images/back-btn.png" align="absmiddle" /></a></span></label>
         <input name="Submit" type="submit" class="button" value="Submit" border="0">
        </div>
      </form>
    </div>
  </div>
</div>
</div>     
</body>
</html>
