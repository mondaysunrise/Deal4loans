<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	$post=$_REQUEST['PostID'];
	//echo "ppp".$post;
//	echo "<br>";
	//print_r($_POST);
//	echo "<br>";
//	print_r($_SESSION);
//	echo "<br>";


	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$Name = FixString($Name);
		$Email = FixString($Email);
		$content = FixString($content);
		$subject = FixString($subject);

	
	if(strlen($Name)>2 && (strrpos($Email, "@"))>0 && (strrpos($content, "<a href="))=== false)
	{
		if(($_SESSION['captcha']==$_POST['captcha']) && ($post>0))
		{
			if (!preg_match("/^[a-zA-Z ]*$/",$Name)) {
				$Err = "Valid";
			}
			else {
				$Err = "Not Valid";
			}
			echo "".$Err."<br>";
			$IP = getenv("REMOTE_ADDR");
			$IP= $_SERVER['HTTP_X_REAL_IP'];
			$Dated = ExactServerdate();
			$dataInsert = array('PostID'=>$post,'IP_Address'=>$IP,'Name'=>$Name, 'Email'=>$Email, 'Dated'=>$Dated, 'Message'=>$content);
			$insert = Maininsertfunc ('req_reply_message', $dataInsert);
		}
	}
	$_SESSION['Msg'] = "Thank You for Replying to Blog";
	header("Location: postreply.php");
/*
	echo '<p align="center"><strong>Thank You for Replying to Blog</strong></p>';
	echo "<script>window.close()"."</script>";
*/		
	
	}
?>