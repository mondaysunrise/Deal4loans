<?php
include "includes/header.php";

if(isset($_POST['Submit']))
{
	$addBank = $objAdmin->processAddBankName();
		if($addBank)
			{
				$rUrl = SITE_URL."add-bank.php?msg=yes";
				$objAdmin->redirectURL($rUrl);
			}
	}

?>
<div id="payment_container-dash_page">
  <?php include "includes/left.php";?>
  <div class="content_right">
    <div class="content-outer_form">
      <h1>Add Bank</h1>
      <div class="contentBox">
        <form action="" method="post" name="Frm" onsubmit="return valAddBank();">
          <div class="field_text2">Please fill the folllowing fields: <span class="require_fields">* Required Fields</span></div>
           <?php if($_REQUEST['msg']=='yes')
			{
		?>
             <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/><?php  echo "Record Added";?></div> 
             <?php }?>
          <div class="row">
            <label>Bank Name :<span style="color:#F00">*</span></label>
            <input name="bankName" type="text" id="bankName" size="15" value="" />
          </div>
           <div class="row">
            <label>Status :</label>
           <input type="checkbox" name="flag" id="flag" value="1" checked="checked" style="float:none;" />
          </div>
         
         
         
          <div class="row">
            <div class="submit_btn2" >
              <input name="Submit" type="submit" class="button" value="Submit" border="0">
            </div>
          </div>
          
        </form>
      </div>
      
    </div>
  </div>
</div>     
</body>
</html>
