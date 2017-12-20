<?php
	require 'scripts/db_init.php';
//	require 'scripts/functions.php';

	$sql = "SELECT * FROM `wp_posts` WHERE `post_title` LIKE 'Yes bank%'";
	 list($numRows,$getrow)=MainselectfuncNew($sql,$array = array());

	for($i=0;$i<$numRows;$i++)
	{
		$title = $getrow[$i]['post_title'];
		$ID = $getrow[$i]['ID'];
	$bodytag = str_replace("Apply", "Information", $title);
			$updateSql = 'update wp_posts set post_status = "trash" where ID = "'.$ID.'"';
			echo $updateSql.";<br>";
	}
?>