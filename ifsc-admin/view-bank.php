<?php
include "includes/header.php";
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 10;
$start = ($page - 1) * $limit;
if(isset($_REQUEST['del'])=="yes")	
	{
		$sql = "UPDATE ".TABLE_BANK. " SET flag=3 WHERE id='".$_REQUEST['id']."'";
		$resultDel = $obj->fun_db_query($sql);
		if($resultDel)
			{
				$msg = BANK_DEL_MSG;
			}
	}

?>

<div id="payment_container-dash_page">
  <?php include "includes/left.php";?>
  <div class="content_right">
    <h1>List of all Banks</h1>
    <br />
    <?php 
	if($_REQUEST['msg']!="")
			{
			?>
    <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/><?php echo $_REQUEST['msg'];?></div>
    <?php }?>
    <div class="box-header">Refine list by:</div>
    <table width="633" cellspacing="0" cellpadding="0" border="0" style="border:solid 1px #ccc; margin-bottom:10px;" class="table-prolist">
      <thead>
      <form id="form1" method="post" action="">
        <tr>
          <td width="52" align="right" valign="middle">Bank Name : </td>
          <td width="134"><input type="text" value="<?php echo $_REQUEST['BankName'];?>" class="tex_fm" style="width:130px" name="BankName" />
            <input type="submit" name="button" id="button"  class="button small2" value="Search" /></td>
        </tr>
      </form>
        </thead>
      
    </table>
    <table width="717" cellspacing="0" cellpadding="3" border="0" style="border:solid 1px #ccc;" class="table-prolist">
      <thead>
        <tr>
          <td width="60" height="33" bgcolor="#999999"><strong>Sr No</strong></td>
          <td width="329" bgcolor="#999999"><strong>Bank Name</strong></td>
          <td width="105" bgcolor="#999999"><strong>Status</strong></td>
          <td width="83" bgcolor="#999999"><strong>Actions</strong></td>
        </tr>
      </thead>
      <tbody>
        <?php
 $w = 1;
 $color = 1;
 $Query = "SELECT * FROM " .TABLE_BANK." WHERE flag in (1,0)";
 
 if($_REQUEST['BankName'])
 {
		$Query .= " AND bank_name LIKE '%".$_REQUEST['BankName']."%'"; 
	}
	
 
$result = $obj->fun_db_query($Query);
$resCount = $obj->fun_db_get_num_rows($result);

if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}
$Query .= " ORDER BY id DESC LIMIT $start,$limit ";


if($resCount>0)
			{
while($rowsCon = $obj->fun_db_fetch_rs_object($result))
	{
				if($color %2!=0)
					{
						$colorvar = "#FFFFFF";
					}
				else{
						$colorvar = "#DDD";
					}
 ?>
        <tr bgcolor="<?php echo $colorvar;?>">
          <td><?php echo $w;?></td>
          <td><?php echo $rowsCon->bank_name;?></td>
          <td><?php if($rowsCon->flag==1) {echo "<span style=\"color:#090;\">Active</span>";} else if($rowsCon->flag==0){ echo "<span style=\"color:#F00;\">Inactive</span>";}?></td>
          <td><a href="edit-bank.php?id=<?php echo $rowsCon->id;?>"><img src="images/b_edit.png" title="Edit" alt="Edit" /></a> &nbsp;&nbsp; <a href="view-bank.php?id=<?php echo $rowsCon->id?>&amp;del=yes" class="form" onClick="return confirm('Are you sure to Delete this Record !!')"><img src="images/delete.png" title="Delete" alt="Delete" /></a></td>
        </tr>
        <?php $w++;$color++;}?>
    </table>
    </td>
    </tr>
    <?php  }else
			{	
			?>
     <tr>
        <td colspan="4" class='td_box' align="center"><span style="color:#D9248C"><?php echo RECORD_NOT_FOUND;?></span></td>
      </tr>
      <?php }?>
    <?php if($pagelinks) {?>
    <tr>
      <td align='right' class='td_box' colspan="4">&nbsp;<?php //echo $pagelinks;?></td>
    </tr>
    <?php }?>
    </tbody>
    </table>
  </div>
</div>
</body></html>