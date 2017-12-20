<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
 $city = $_REQUEST['q'];
 ?>
 <select name="ResiPin" id="ResiPin" class="d4l-select" >
 <!--<option value="">Please Select</option>-->
 <?php
 $getPinSql = "SELECT pincode FROM icici_city_cc_list WHERE (city like '%".$city."%' or cityalias like '%".$city."%') and status=1 ORDER BY pincode ASC ";
				 
				list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getPinSql,$array = array());
				for($cN=0;$cN<$numRowsCarName;$cN++)
				{
					$Pincode = $getCarNameQuery[$cN]['pincode'];
					?>
					<option value="<?php echo $Pincode; ?>"><?php echo $Pincode; ?></option>   
					<?php
				}

 
?></select>