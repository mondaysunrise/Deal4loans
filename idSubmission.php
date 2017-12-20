<?php

	require 'scripts/session_check.php';

	require 'scripts/db_init.php';

	require 'scripts/functions.php';
	print_r ($_SESSION);
	exit();
	
echo "<script language=javascript>"."location.href='User_Register_New.php?flag=1'"."</script>"; 

	//header("Location:User_Register_New.php?flag=1");

?>