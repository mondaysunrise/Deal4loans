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
	function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'applyhere_pl.php',
		'Req_Loan_Home' => 'applyhere_hl.php',
		'Req_Loan_Car' => 'applyhere.php',
		'Req_Credit_Card' => 'applyhere_cc.php',
		'Req_Loan_Against_Property' => 'applyhere.php',

	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	
	
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$Type_Loan = FixString($Type_Loan);
		$fullname = FixString($fullname);
		$mobile = FixString($mobile);
		$email_id = FixString($email_id);
	    $Dated = ExactServerdate();
		
		
		$_SESSION['Temp_Name'] = $fullname;
		$_SESSION['Temp_mobile'] = $mobile;
		$_SESSION['Temp_email'] = $email_id;
		$_SESSION['Temp_loan_type'] = $Type_Loan;

		if((strlen($fullname)>0) && (strlen($mobile)>0))
	{
		//$sql = "INSERT INTO Req_Apply_Here( ApplyID, Name, Email, Contact, Product_Type, Dated )
		//VALUES ( '', '$fullname', '$email_id', '$mobile', '$Type_Loan', Now() )";
		
		$dataInsert = array("ApplyID"=>'', "Name"=>$fullname , "Email"=>$email_id , "Contact"=>$mobile , "Product_Type"=>$Type_Loan,  "Dated"=>$Dated);
		$table = 'Req_Apply_Here';
		$insert = Maininsertfunc ($table, $dataInsert);
		//ExecQuery($sql);
		//exit();
		$last_inserted_id = mysql_insert_id();
		$_SESSION['Temp_Last_Inserted'] = $last_inserted_id;

		if(strlen($Type_Loan)>0)
		{
		echo "<script language=javascript>location.href='".getTransferURL($Type_Loan)."?source=QuickApply'"."</script>";
		}
		else
			{
			echo "<script language=javascript>location.href='index.php?source=QuickApply'"."</script>";
		}
	}
	else
			{
			echo "<script language=javascript>location.href='index.php?source=QuickApply'"."</script>";
		}
	
	
		

	}
		?>