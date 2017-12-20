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
//echo "<pre>";	
//print_r($_SESSION);

if($_REQUEST['ppId'])
{
$objAdmin->processPickupPerson($_REQUEST['id'],$_REQUEST['ppId']);
}
?>

<script>
function loadDoc(id,ppVal,AssBy) {
	if (ppVal == "") {
        document.getElementById("PrintMsg").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("PrintMsg").innerHTML = xmlhttp.responseText;
            }
        };
		
        xmlhttp.open("GET","assignpick_ajax.php?id="+id+"&ppval="+ppVal+"&AssBy="+AssBy,true);
        xmlhttp.send();
    }
}
</script>

<div id="payment_container-dash_page">
  <?php include "includes/left.php";?>
  <div class="content_right">
    <h1>Leads assign to Document Pickup </h1>
    <br />
    <?php 
	if($_REQUEST['msg']!="")
			{
			?>
    <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/><?php echo $_REQUEST['msg'];?></div>
    <?php }?>
    <div id="PrintMsg" style="float:right; color:#0C3; font-weight:bold;"></div>
    <table width="717" cellspacing="0" cellpadding="3" border="1" style="border:solid 1px #ccc;" class="table-prolist">
      <thead>
        <tr>
          <td width="90" height="33" bgcolor="#999999"><strong>Sr No</strong></td>
          <td width="190" bgcolor="#999999"><strong>Name</strong></td>
        
          <td width="183" bgcolor="#999999"><strong>Mobile Num</strong></td>
          <td width="183" bgcolor="#999999"><strong>City</strong></td>
          <td width="98" bgcolor="#999999"><strong>Pickup Person</strong></td>
        </tr>
      </thead>
      <tbody> 
        <?php
$w = 1;
$color = 1;
$Query = "select Req_Loan_Personal.RequestID as AllRequestID, Name,City, Mobile_Number, docpickerid, id from zexternal_appointment_docs LEFT OUTER JOIN Req_Loan_Personal ON Req_Loan_Personal.RequestID= zexternal_appointment_docs.RequestID";
 if($_SESSION['UserType']>1)
 {
  $Query .= " where Req_Loan_Personal.City='".$_SESSION['UserCity']."' ";
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
          
            <td><?php echo $rowsCon->Mobile_Number;?></td>
          <td><?php echo $rowsCon->City;?></td>
          <td>
		  <select name="pickup_person" id="pickup_person"  onchange="loadDoc(<?php echo $rowsCon->id;?>,this.value,'<?php echo $_SESSION['UID'];?>')">
          <option value="">Please Select</option>
		  <?php // Query for pickup Guy.
if($_SESSION['UserType']==1)
 {

	//write query for super admin
		$getPickupSql = "select * from zexternal_appointment_users where UserType =3 and City = '".$rowsCon->City."'  "; 
	
	
	}
else
{
		  	$getPickupSql = "select * from zexternal_appointment_users where Owner = '".$_SESSION['UID']."' "; 

}
$getPickupResult = $obj->fun_db_query($getPickupSql);
			$selected = '';
			while($rowsgetPickup = $obj->fun_db_fetch_rs_object($getPickupResult))
			{
				$selected = '';
				if($rowsgetPickup->id== $rowsCon->docpickerid) {$selected = 'selected';} 
				echo "<option value='".$rowsgetPickup->id."' ".$selected." >".$rowsgetPickup->Name."</option>";
			}
		  ?></select>
          </td>
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