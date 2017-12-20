<?php
include "includes/header.php";

if(isset($_POST['Submit']))
{
	
	$Query = "SELECT * FROM " .TABLE_STATE_LOC." WHERE sub_id!=0 AND name='".$_REQUEST['CityName']."'";
	$result = $obj->fun_db_query($Query);
	$resCount = $obj->fun_db_get_num_rows($result);
	$rowsCon = $obj->fun_db_fetch_rs_object($result);
	print_r($rowsCon);
	if($resCount!=1)
	{
	$addBank = $objAdmin->processAddCity();
		if($addBank)
			{
				$rUrl = SITE_URL."add-city.php?msg=yes";
				$objAdmin->redirectURL($rUrl);
			}
	}
	else{
		$rUrl = SITE_URL."add-city.php?msg=Dup";
		$objAdmin->redirectURL($rUrl);
	}
}
?>
<div id="payment_container-dash_page">
  <?php include "includes/left.php";?>
  <div class="content_right">
    <div class="content-outer_form">
      <h1>Add City</h1>
      <div class="contentBox">
        <form action="" method="post" name="CityFrm" onsubmit="return valAddCity();">
          <div class="field_text2">Please fill the folllowing fields: <span class="require_fields">* Required Fields</span></div>
           <?php if($_REQUEST['msg']=='yes')
			{
		?>
             <div class="msg_payee"><img src="./images/approved-new.png" align="absmiddle"/><?php  echo "Record Added";?></div> 
             <?php }?>
             
              <?php if($_REQUEST['msg']=='Dup')
			{
		?>
             <div class="msg_error"><img src="./images/error.png" align="absmiddle"/><?php  echo "Duplicate City";?></div> 
             <?php }?>
             
          <div class="row">
            <label>State Name:<span style="color:#F00">*</span></label>
            <select name="stateName" id="stateName">
                  <option value="">Please Select State</option>
                  
                  <?php echo $objAdmin->GetStateName($_REQUEST['stateName']);?>
                  </select>
          </div>
           <div class="row">
            <label>City Name:</label>
           <input name="CityName" type="text" id="CityName" size="15" value="" />
          </div>
         
         <div class="row">
            <label>Latitude:</label>
           <input name="CityLatitude" type="text" id="CityLatitude" value="" />
          </div>
           <div class="row">
            <label>Longitude:</label>
           <input name="CityLongitude" type="text" id="CityLongitude" value="" />
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
