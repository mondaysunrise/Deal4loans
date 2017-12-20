<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	

	$Msg = "";
	$Item_ID = "";
	if($_SESSION['UserType']== "bidder")
	{
	$Msg = getAlert("Sorry!!!! You are not Authorised to Apply for Loan.", TRUE, "index.php");
	echo $Msg;
	}

	echo "sss".$_SESSION['Temp_Type'];
		$Name= $_SESSION['Temp_Name'];
		$Mobile= $_SESSION['Temp_Phone'];
		$Type_Loan = $_SESSION['Temp_Type'];
		//echo $product;
		$Email= $_SESSION['Temp_Email'];
		$Net_Salary= $_SESSION['Temp_Net_Salary'];
		$Company_Name= $_SESSION['Temp_Company_Name'];
		$City= $_SESSION['Temp_City'];
		$Other_City= $_SESSION['Temp_City_Other'];
		$Pincode= $_SESSION['Temp_Pincode'];
		$Contact_Time= $_SESSION['Temp_Contact_Time'];
		$Employment_Status= $_SESSION['Temp_Employment_Status'];

if ($_SESSION['flag']==1)
	{ 
	echo "<script language=javascript>"."location.href='User_Register_New.php?flag=1'"."</script>"; 
	}

	?>