<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
//Array ( [referrer] => [Type_Loan] => Req_Loan_Share [creative] => [section] => [source] => dealsin [PostURL] => /deal4loans.in/loan-against-share.php [Name] => fgfgfgfdfgdf [Phone] => 9878687685 [Email] => fgdfgfg#@ghgfhgf.com [City] => Bangalore [portfolio] => 95657 [Loan_Amount] => 5645565 [accept] => on )


	$Name = $_POST['Name'];
	$Phone = $_POST['Phone'];
	$Email = $_POST['Email'];
	$City = $_POST['City'];
    $Loan_Amount = $_POST['Loan_Amount'];
	$Type_Loan = $_POST['Type_Loan'];
	$source = $_POST['source'];
	$Creative = $_POST['creative'];
	$Section = $_POST['section'];
	$Referrer=$_REQUEST['referrer'];
	$IP = getenv("REMOTE_ADDR");
	$URL = $_POST['PostURL'];
	$portfolio = $_POST['portfolio'];
	$IsPublic = 1;
	
 $Dated = ExactServerdate();
		
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
		
			list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
			$cntr=0;
			//$CheckQuery = ExecQuery($CheckSql);
			//echo "<br>".$CheckSql;
			//$CheckNumRows = mysql_num_rows($CheckQuery);
			//echo "<br>".$CheckNumRows;
			
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$cntr]['UserID'];
			//	$InsertProductSql = "INSERT INTO `Req_Loan_Share` (`UserID` , `Name` , `Phone` , `Email` , `City` , `portfolio` , `Loan_Amount` , `source` , `creative` , `section` , `IP` , `referrer`, `Dated` ) VALUES ('".$UserID."','".$Name."', '".$Phone."','".$Email."','".$City."','".$portfolio."','".$Loan_Amount."','".$source."','".$creative."','".$section."','".$IP."','".$referrer."', Now())";
		$dataInsert = array("UserID"=>$UserID , "Name"=>$Name , "Phone"=>$Phone , "Email"=>$Email , "City"=>$City, "portfolio"=>$portfolio , "Loan_Amount"=>$Loan_Amount , "source"=>$source , "creative"=>$creative , "section"=>$section, "IP"=>$IP , "referrer"=>$referrer , "Dated"=>$Dated);
		$table = 'Req_Loan_Share';
		$insert = Maininsertfunc ($table, $dataInsert);
			
				//echo "<br>if ".$InsertProductSql;
			}
			else
			{
				//$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";			
			$dataInsert2 = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
			$table2 = 'wUsers';
			$insert = Maininsertfunc ($table2, $dataInser2t);
				
				//$InsertwUsersQuery = ExecQuery($InsertwUsersSql);
				$UserID = mysql_insert_id();
				//$InsertProductSql = "INSERT INTO `Req_Loan_Share` (`UserID` , `Name` , `Phone` , `Email` , `City` , `portfolio` , `Loan_Amount` , `source` , `creative` , `section` , `IP` , `referrer`, `Dated` ) VALUES ('".$UserID."', '".$Name."', '".$Phone."','".$Email."','".$City."','".$portfolio."','".$Loan_Amount."','".$source."','".$creative."','".$section."','".$IP."','".$referrer."', Now())";
				
				$dataInsert3 = array("UserID"=>$UserID , "Name"=>$Name , "Phone"=>$Phone , "Email"=>$Email , "City"=>$City, "portfolio"=>$portfolio , "Loan_Amount"=>$Loan_Amount , "source"=>$source , "creative"=>$creative , "section"=>$section, "IP"=>$IP , "referrer"=>$referrer , "Dated"=>$Dated);
		$table3 = 'Req_Loan_Share';
		$insert = Maininsertfunc ($table3, $dataInsert3);
				
				
				//echo "<br>else ".$InsertProductSql;
			}
			//$result = ExecQuery($InsertProductSql);
			
			$explodeUrl = explode("/" , $URL);
			$URLPostion = count($explodeUrl)-1;
			$MidURL = $explodeUrl[$URLPostion];
			
			$explodeMidUrl = explode("?" , $MidURL);
			$FinalURL = $explodeMidUrl[0];
			
		//echo $FinalURL;
		
		//exit();
			if($FinalURL == "loan-against-share.php")
			{
				header("Location: http://www.deal4loans.in/loan-against-share-continue.php");
				exit();
			}

		
	
}	
?>