<?php
	require 'scripts/db_init.php';
	require 'scripts/functionshttps.php';

	session_start();
	$Msg = "";
//print_r($_POST);
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Email = $_POST['L_email'];
		$pwd = $_POST['L_pwd'];
		if(strlen($Email)>0 && strlen($pwd)>0)
		{
			//echo "select * from Req_Agent_Pay where A_Email='$Email' and PWD='$pwd'";
			$sql = "select * from Req_Agent_Pay where A_Email like '$Email%' and PWD='$pwd'";
			list($num_rows,$row)=MainselectfuncNew($sql,$array = array());
			if($num_rows > 0)
			{
				$_SESSION['Aid'] = $row[0]['A_ID'];
				$_SESSION['Email'] = $Email;
				$_SESSION['pwd'] = $pwd;
				$_SESSION['A_Mobile'] = $row[0]['A_Mobile'];
				$_SESSION['A_Name'] = $row[0]['A_Name'];
				
				//header("Location: agent_packages.php");
				header("Location: agentregistration.php");
				exit;
			}	
			else
			{
				$_SESSION['Msg'] = "incorect details";
				header("Location: agentregistration.php");
				exit;
			}
		}
		else
		{
			$_SESSION['Msg'] = "incorect details";
			header("Location: agentregistration.php");
			exit;
		}
		
	}

?>