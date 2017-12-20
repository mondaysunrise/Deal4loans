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
    <h1>List of all Location</h1>
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
      <form id="form1" method="get" action="">
        <tr>
          <td width="68" align="right" valign="middle"> <!--City Name :--> </td>
          <td width="563">&nbsp;&nbsp;&nbsp;
<!--<select name="CityName">
          <option value="">Select City Name</option>
          <?php echo $CityInfo = $objAdmin->GetCityName($_REQUEST['CityName']);?>
          </select>
            -->
            &nbsp;&nbsp;&nbsp; Branch Location
            <input type="text" value="<?php echo $_REQUEST['BranchLoc'];?>" class="tex_fm" style="width:130px" name="BranchLoc" />
            <input type="submit" name="button" id="button"  class="button small2" value="Search" /></td>
        </tr>
      </form>
        </thead>
      
    </table>
    <table width="717" cellspacing="0" cellpadding="3" border="0" style="border:solid 1px #ccc;" class="table-prolist">
      <thead>
        <tr>
          <td width="90" height="33" bgcolor="#999999"><strong>Sr No</strong></td>
          <td width="190" bgcolor="#999999"><strong>Bank</strong></td>
          <td width="183" bgcolor="#999999"><strong>City</strong></td>
          <td width="183" bgcolor="#999999"><strong>Branch Location</strong></td>
          <td width="98" bgcolor="#999999"><strong>Actions</strong></td>
        </tr>
      </thead>
      <tbody>
        <?php
 $w = 1;
 $color = 1;
$Query = "SELECT * FROM " .TABLE_BRANCH. " WHERE id!=''";
if($_REQUEST['CityName']!="")
{
	$Query .= " AND state_id='".$_REQUEST['CityName']."'";
}
if($_REQUEST['BranchLoc']!="")
{
	$Query .= " AND branch_name LIKE '%".$_REQUEST['BranchLoc']."%'";
}
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
          <td style="text-align:right !important;" colspan="3"><?php echo $pagelinks;?></td>
        </tr>
    </table>
    </td>
    </tr>
   
    </tbody>
    </table>
  </div>
</div>
</body></html>