<?php



		$Name =$_REQUEST["full_name"];
		$Email = $_REQUEST["email"];
		$Loan_Any = FixString($Loan_Any);
		$Phone = $_REQUEST["phone"];
		$Pancard = $_REQUEST["pancard"];
		$CC_Holder = $_REQUEST["ccholder"];
		$Card_Vintage = $_REQUEST["vintage"];
		$City = $_REQUEST["city"];
		$City_Other = $_REQUEST["othercity"];
		$Company_Name = $_REQUEST["company"];
		$Net_Salary =$_REQUEST["salary"];
		$IsPublic =1;
		$DOB=$_REQUEST["dob"];
		$source ="newform";
		$Employment_Status = $_REQUEST["employment"];
		$Accidental_Insurance = $_REQUEST[""];
		/*$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$Section=$_REQUEST['section'];
		$Creative=$_REQUEST['creative'];*/
		$Accidental_Insurance = $_REQUEST["accinsur"];
		$Type_Loan ="CreditCard";
		   $Dated = ExactServerdate();

function InsertTataAig($RequestID, $ProductName)
	{
	//	echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		 list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;

		
	//	$RowGetDate = mysql_fetch_array($GetDateSql);
		
		$TDated = $RowGetDate[$cntr]['Dated'];
		$TCity = $RowGetDate[$cntr]['City'];
		$Mobile = $RowGetDate[$cntr]['Mobile_Number'];
		$Product_Name = "4";
		
		//$Sql = "INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, `Mobile_Number`, `T_Dated` ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";
		//$query = mysql_query($Sql);
		//echo "tataaig:".$Sql."<br>";
		//exit();
		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
		

	}
$validMobile = is_numeric($Phone);

	if(($validMobile==1) && ($Name!=""))
{		
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
	
			 list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
		$i=0;
			
			//echo "<br>".$CheckSql;
			//$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$i]['UserID'];
						
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "DOB"=>$DOB, "IsPublic"=>$IsPublic, "Dated"=>$Dated, " Reference_Code"=>$Reference_Code, "source"=>$source, "Pancard"=>$Pancard, "CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage, "IP_Address"=>$IP, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance, "Loan_Any"=>$Loan_Any);
$table = 'Req_Credit_Card';
$insert = Maininsertfunc ($table, $dataInsert);
			
			}
			else
			{
				//$InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";	
				
				$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$table = 'wUsers';
				$UserID1 = Maininsertfunc ($table, $dataInsert);
			
			$dataInsert2 = array("UserID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "DOB"=>$DOB, "IsPublic"=>$IsPublic, "Dated"=>$Dated, " Reference_Code"=>$Reference_Code, "source"=>$source, "Pancard"=>$Pancard, "CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage, "IP_Address"=>$IP, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance, "Loan_Any"=>$Loan_Any);
$table2 = 'Req_Credit_Card';
$ProductValue = Maininsertfunc ($table2, $dataInsert2);		
				
			}
			
		
			$_SESSION['Temp_LID'] = $ProductValue;
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Credit_Card");
				}
			//exit();
			$SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of card app form to get bidder contacts & quotes. And help us serve you better.";
					if(strlen(trim($Phone)) > 0)
					SendSMS($SMSMessage, $Phone);
			
			}
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
				$SubjectLine = $Name.", Learn to get Best Deal on Credit Card";
			//echo $Type_Loan;
			$Type_Loan ="CreditCard";
			if(isset($Email))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			

		//}
		else
		{
			//echo "Track URI and redirect this to the same page";
			$msg = "NotAuthorised";
			$PostURL ="http://www.deal4loans.com/".$_POST["PostURL"]."?msg=".$msg;
			header("Location: $PostURL");
		}

		echo "hello";
?>