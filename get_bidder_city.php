<?php
require 'scripts/db_init.php';
    require 'scripts/db_init-main.php';
	require 'scripts/functions.php';
	
	
	
	$city = $_REQUEST['city'];
	
//print_r($_REQUEST);
if(strlen($city)>0)
{
		$sql = "select Name from city_area_list where ParentID=".$city." order by Position ASC";
		//$cityresult = ExecQuery($sql);
		 list($recordcount,$row)=MainselectfuncNew($sql,$array = array());
		$cntr=0;


		
		//echo $sql;
		//$last_inserted_id = mysql_insert_id();
		echo "<table>		<tr>";
		while($cntr<count($row))
        {
			$cityname= $row[$cntr]["Name"];

			echo "<td><input type='text' value='$cityname' name='city_$cityname' readonly size='15'></td><td><input tye='text' name='id_$cityname' size='2' maxlength='3'></td></tr>";

$cntr = $cntr+1;
	
	}
	
		echo "<table>";
	}
	
	//echo $last_inserted_id;		
//
?>
