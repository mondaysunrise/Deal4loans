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
    <h1>Welcome to <?php echo SITE_NAME; ?></h1>
    <div style="height:550px;">
    </div>
  </div>
</div>
