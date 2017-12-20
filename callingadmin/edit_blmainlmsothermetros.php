<?php
include "includes/header.php";
?>
<div id="payment_container-dash_page">
  <?php include "includes/agentleft.php";?>
  <div class="content_right">
    <h1>List of Bidders in blmainlmsothermetros LMS</h1>
    <br />
    <?php 
	if($_REQUEST['msg']!="")
			{
			?>
    <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/><?php echo $_REQUEST['msg'];?></div>
    <?php }?>
    
    <table width="633" cellspacing="0" cellpadding="0" border="0" style="border:solid 1px #ccc; margin-bottom:10px;" class="table-prolist">
      <thead>
      <form id="form1" method="post" action="edit_blmainlmsothermetros_continue.php">
        <tr>
          <td  align="left" valign="middle" colspan="4">Agents 1 : </td></tr>
          <tr>
          <td align="left">
          <table width="300" border="1">
          <tr><td>Serial No.</td>
          <td> </td>
          <td>UserName/Email</td>
          <td>Password</td>
          <td>Name [Profile ID]</td>
          </tr>
       <?php
	    $w = 1;
        $Query = "SELECT `BidderID`, `Email`, `PWD`, `Bidder_Name`, `Associated_Bank`, `Profile`, `leadidentifier`, `Status` FROM Bidders WHERE leadidentifier='blmainlmsothermetros'";
		$result = $obj->fun_db_query($Query);
		while($rowsCon = $obj->fun_db_fetch_rs_object($result))
		{
		$status = '';
		$status = $rowsCon->Status;
		 ?>
        <tr bgcolor="<?php echo $colorvar;?>">
          <td><?php echo $w;?></td>
          <td>          <input type="checkbox" value="<?php echo $rowsCon->BidderID; ?>" name="toActivate[]" <?php if($status==1) {echo "checked";} ?> /></td>
          <td><?php echo $rowsCon->Email; ?></td>
          <td><?php echo $rowsCon->PWD; ?></td>
          <td><?php echo $rowsCon->Bidder_Name;?> <span style="color:#00C;">[ <?php echo $rowsCon->Profile; ?> ]</span> [<?php echo $rowsCon->BidderID; ?>]</td>
        </tr>
        <?php $w++;}?>
<tr><td colspan="4" align="right">       

            <input type="submit" name="button" id="button"  class="button small2" value="Submit" /></td></tr>
        </table>
        </td>
        </tr>
      </form>
        </thead>
      
    </table>

  </div>
</div>
</body></html>