<?php include "includes/header.php";
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 10;
$start = ($page - 1) * $limit;

	if(isset($_REQUEST['del'])=="yes")	
	{
		$sql = "DELETE FROM ".TABLE_BRANCH. " WHERE id='".$_REQUEST['id']."'";
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
    <h1>Welcome to IFSC Code Admin Panel</h1>
    <div class="row_cont">
      <div class="iconbox"><a href="view-bank.php"><img border="none" src="<?php echo SITE_IMAGES;?>payee.png" /><br />
        Manage Bank</a></div>
      <div class="iconbox"><a href="view-city.php"><img border="none" src="<?php echo SITE_IMAGES;?>city-icon.png" /><br />
        Manage City</a></div>
   
      <div class="iconbox"><a href="view-location.php"><img border="none" src="<?php echo SITE_IMAGES;?>bank-loc.png" /><br />
        Manage Location</a></div>
      <!-- <div class="iconbox"><a href="view-branch.php"><img border="none" src="<?php echo SITE_IMAGES;?>bank-branch.jpg" /><br />
        Manage Branch </a></div>
        <div class="iconbox"><a href="feedback.php"><img border="none" src="<?php echo SITE_IMAGES;?>feedback.png" /><br />
        Manage FeedBack </a></div>-->
    </div>
    <div class="box-header">View Location List</div>
    <table width="717" cellspacing="0" cellpadding="3" border="0" style="border:solid 1px #ccc;" class="table-prolist">
      <thead>
        <tr class="proHd_bg">
          <td width="106">Sr No</td>
          <td width="141">Bank</td>
          <td width="96">City</td>
          <td width="185">Branch Location</td>
          <td width="71" colspan="3">Actions</td>
        </tr>
      </thead>
      <tbody>
        <?php
 $w = 1;
 $color = 1;
$Query = "SELECT * FROM " .TABLE_BRANCH;
$resultCount = $obj->fun_db_query($Query);
$resCount = $obj->fun_db_get_num_rows($resultCount);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}
$Query.= " ORDER BY id DESC LIMIT $start,$limit ";

$result = $obj->fun_db_query($Query);
while($rowsCon = $obj->fun_db_fetch_rs_object($result))
	{
		$BankInfo = $objAdmin->GetBankInfo($rowsCon->bank_id);
		$StateInfo = $objAdmin->GetStateInfo($rowsCon->state_id);
		
		if($color %2!=0){
				$colorvar = "#FFFFFF";
			}
		else{
				$colorvar = "#DDD";
			}
	
 ?>
        <tr bgcolor="<?php echo $colorvar;?>">
          <td><?php echo $w;?></td>
          <td><?php echo $BankInfo['bank_name'];?></td>
          <td><?php echo $StateInfo['name'];?></td>
          <td><?php echo $rowsCon->branch_name;?></td>
          <td><a href="edit-location.php?id=<?php echo $rowsCon->id;?>"><img src="images/b_edit.png" title="Edit" alt="Edit" /></a> &nbsp;&nbsp; <a href="view-location.php?id=<?php echo $rowsCon->id?>&amp;del=yes" class="form" onClick="return confirm('Are you sure to Delete this Record !!')"><img src="images/delete.png" title="Delete" alt="Delete" /></a></td>
        </tr>
        <?php $w++;$color++;}?>
        <tr>
          <td >&nbsp;</td>
          <td >&nbsp;</td>
          <td style="text-align:right !important;" colspan="3"><?php echo $pagelinks;?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
