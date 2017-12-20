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
		$sql = "DELETE FROM ".TABLE_USER. " WHERE id='".$_REQUEST['id']."'";
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
    <h1>List of Users</h1>
    <br />
    <?php 
	if($_REQUEST['msg']!="")
			{
			?>
    <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/><?php echo $_REQUEST['msg'];?></div>
    <?php }?>
    
    <table width="717" cellspacing="0" cellpadding="3" border="1" style="border:solid 1px #ccc;" class="table-prolist">
      <thead>
        <tr>
          <td width="90" height="33" bgcolor="#999999"><strong>Sr No</strong></td>
          <td width="190" bgcolor="#999999"><strong>Name</strong></td>
          <td width="190" bgcolor="#999999"><strong>Email</strong></td>
          <td width="183" bgcolor="#999999"><strong>Password</strong></td>
          <td width="183" bgcolor="#999999"><strong>Mobile Num</strong></td>
           <td width="183" bgcolor="#999999"><strong>City</strong></td>
          <td width="98" bgcolor="#999999"><strong>Actions</strong></td>
        </tr>
      </thead>
      <tbody>
        <?php
 $w = 1;
 $color = 1;
 if($_SESSION['UserType']==1) {
	$Query = "SELECT * FROM " .TABLE_USER ." where 1=1 "; 
 }
 else {
	$Query = "SELECT * FROM " .TABLE_USER ." where 1=1 and (id = '".$_SESSION['UID']."' or Owner='".$_SESSION['UID']."')"; 
 }
// echo $Query;
// echo "<br><pre>";
// print_r($_SESSION);
$resultCount = $obj->fun_db_query($Query);
$resCount = $obj->fun_db_get_num_rows($resultCount);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}
$Query.= " ORDER BY id ASC LIMIT $start,$limit ";

$result = $obj->fun_db_query($Query);
while($rowsCon = $obj->fun_db_fetch_rs_object($result))
	{
		
		if($color %2!=0){
				$colorvar = "#FFFFFF";
			}
		else{
				$colorvar = "#DDD";
			}
	
	
 ?>
        <tr bgcolor="<?php echo $colorvar;?>">
          <td><?php echo $w;?></td>
          <td><?php echo $rowsCon->Name;?></td>
           <td><?php echo $rowsCon->Email;?></td>
          <td><?php echo $rowsCon->pwd;?></td>
            <td><?php echo $rowsCon->Mobile_Number;?></td>
          <td><?php echo $rowsCon->City;?></td>
          <td><?php if($rowsCon->UserType==2) { } else { ?><a href="edit-user.php?id=<?php echo $rowsCon->id;?>"><img src="images/b_edit.png" title="Edit" alt="Edit" /></a> <?php } ?> &nbsp;&nbsp;<?php if($rowsCon->id!=4700 && $rowsCon->id!=1600) { if($rowsCon->UserType==1  ) { ?> <a href="view-user.php?id=<?php echo $rowsCon->id?>&amp;del=yes" class="form" onClick="return confirm('Are you sure to Delete this Record !!')"><img src="images/delete.png" title="Delete" alt="Delete" /></a><?php } } ?></td>
        </tr>
        <?php $w++;$color++;}?>
       
    </table>
    </td>
    </tr>
   
    </tbody>
    </table>
   <div style="float:right;"> <?php echo $pagelinks;?></div>
  </div>
</div>
</body></html>