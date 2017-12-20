<?php
//Get our database abstraction file
require 'scripts/db_init.php';

if (isset($_GET['search']) && $_GET['search'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = $_GET['search'];
	//echo "SELECT other_city as suggest FROM other_city_list WHERE other_city like('".$search ."%') ORDER BY other_city";
	$suggest_query = ("SELECT other_city as suggest FROM other_city_list WHERE other_city like('" .$search . "%') ORDER BY other_city");
 list($recordcount,$suggest)=MainselectfuncNew($suggest_query,$array = array());
		$cntr=0;
	while($cntr<count($suggest))
        {
		echo $suggest[$cntr]['suggest'] . "\n";
	    $cntr=$cntr+1;
	}
}
//echo "Other";
?>