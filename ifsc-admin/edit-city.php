<?php
include "includes/header.php";
$sql = "SELECT * FROM " . TABLE_STATE_LOC." WHERE id='".$_REQUEST['id']."'";
	$result = $obj->fun_db_query($sql);
	$rowsCon = $obj->fun_db_fetch_rs_object($result);
if(isset($_POST['Submit']))
	{
		$editBank = $objAdmin->processAddCity($_REQUEST['id'],"EDIT");
		
		if($editBank)
			{
				$rUrl = SITE_URL."edit-city.php?id=".$_REQUEST['id']."&msg=edit";
				$objAdmin->redirectURL($rUrl);		
			}
	}
?>
<div id="payment_container-dash_page">
  <?php include "includes/left.php";?>
  <div class="content_right">
    <h1>Edit City Name</h1>
    <br />
    <?php if($_REQUEST['msg'])
			{
		?>
    <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/ ><?php  echo "Record Updated";?></div>
    <?php }?>
    <div class="mid_part">
      <div class="contentBox">
      <form action="" method="post" name="CityFrm"  onsubmit="return valAddCity();">
     
        <div class="row">
          <label>State Name :</label>
         <select name="stateName" id="stateName">
                  <option value="">Please Select State</option>
                  
                  <?php echo $objAdmin->GetStateName($rowsCon->sub_id);?>
                  </select>
        </div>
        <div class="row">
          <label>City Name :</label>
          <input name="CityName" type="text" id="CityName" size="15" value="<?php echo $rowsCon->name; ?>" />
        </div>
        <div class="row">
            <label>Latitude:</label>
           <input name="CityLatitude" type="text" id="CityLatitude" value="<?php echo $rowsCon->city_latitude; ?>" />
          </div>
           <div class="row">
            <label>Longitude:</label>
           <input name="CityLongitude" type="text" id="CityLongitude" value="<?php echo $rowsCon->city_longitide; ?>" />
          </div>
         
        
        <div class="row">
          <label> <span><a href="view-city.php" class="button small">Back<img src="./images/back-btn.png" align="absmiddle" /></a></span></label>
         <input name="Submit" type="submit" class="button" value="Submit" border="0">
        </div>
      </form>
    </div>
  </div>
</div>
</div>     
</body>
</html>
