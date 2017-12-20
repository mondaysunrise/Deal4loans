<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
$product_name = "PersonalLoan";
//print_r($_POST);

function DetermineAgeGETDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;
  if ($mdiff < 0)
  {
    $ydiff--;
  } elseif ($mdiff==0)
  {
     if ($ddiff < 0)
    {
      $ydiff--;
    }
  }
  return $ydiff;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$Residential_Status = $_REQUEST['Residential_Status'];
		$Years_In_Company = $_REQUEST['Years_In_Company'];
		$LoanAny = $_REQUEST['LoanAny'];
		$Loan_Any = $_REQUEST['Loan_Any'];
		$EMI_Paid = $_POST['EMI_Paid'];
		$URL = $_POST['URL'];
		$RequestID = $_POST['RequestID'];
			
		$Document_proof=$_REQUEST['Document_proof'];
		$Document_proof_doc=implode(",",$Document_proof);
		$encryptInsertedID =  base64_encode($RequestID);
		
			$nn = count($Loan_Any);
			 $ii  = 0;
			while ($ii < $nn)
			{
			  $Loan_A .= "$Loan_Any[$ii], ";
			 $ii++;
			 }
			//echo $Loan_A."<br>";
			if(($Reference_Code0 == $Reference_Code1) || ($Mobile == $RePhone ))
			{
			
			$Is_Valid=1;
			
			}
		else
			{
			$Is_Valid=0;
			}

		$getDOB = str_replace("-","", $DOB);
		$age = DetermineAgeGETDOB($getDOB);
		//echo $age."<br>";
		$agecalc="50";
		$exactage = $agecalc- $age;
		
		//get inflation amount
		$getinflation = $Net_Salary *(5/100);
		$getinflationage = $getinflation * $exactage;
		$getexactvalue = $getinflationage + $Net_Salary;
		$getexactvaluemonthly = $getexactvalue/12;
			
				
			$crap = " ".$Property_Identified." ".$Property_Loc." ".$company." ".$City_Other." ".$Primary_Acc." ".$Descr." ".$Years_In_Company." ".$Total_Experience;
		//echo $crap,"<br>";
			$crapValue = validateValues($crap);
		
			//exit();
			if($crapValue=="Put")
			{
		
				if (($product=="PersonalLoan") || ($product_name=="PersonalLoan"))
					{
								if($Accidental_Insurance==1)
								{
									$RequestID = $_SESSION['Temp_LID'];
									$ProductName = "Req_Loan_Personal";
									InsertTataAig($RequestID, $ProductName);
								}
								
								//exit();
						getEligibleBidders("personal","$City","$Mobile");
							if(strlen($Residential_Status)>0)	
							{	
					$DataArray = array("Primary_Acc"=>$Primary_Acc, "Residential_Status"=>$Residential_Status, "Card_Limit"=>$Credit_Limit, "Years_In_Company"=>$Years_In_Company, "Is_Valid"=>$Is_Valid, "Total_Experience"=>$Total_Experience, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_A, "Mobile_Connection"=>$Mobile_Connection, "Landline_Connection"=>$Landline_Connection, "Salary_Drawn"=>$Salary_Drawn, "identification_proof"=>$Document_proof_doc);
					$wherecondition ="RequestID='".$RequestID."'";
					Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
					
						}
						else {
						
					$DataArray = array("Primary_Acc"=>$Primary_Acc, "Years_In_Company"=>$Years_In_Company, "Is_Valid"=>$Is_Valid, "Card_Limit"=>$Credit_Limit, "Total_Experience"=>$Total_Experience, "EMI_Paid"=>$EMI_Paid, "Loan_Any"=>$Loan_A, "Mobile_Connection"=>$Mobile_Connection, "Landline_Connection"=>$Landline_Connection, "Salary_Drawn"=>$Salary_Drawn, "identification_proof"=>$Document_proof_doc);
					$wherecondition ="RequestID='".$RequestID."'";
					Mainupdatefunc ('Req_Loan_Personal', $DataArray, $wherecondition);
					
						
						}
					
			
						if($Net_Salary>=200000)
						{
							$productname = "plsalaryclause";
						}
						else
						{
						$productname = "PersonalLoan";
						}
						
					
					}
				
				//Redirect to specified thank you page
				$explodeUrl = explode("/" , $URL);
				$URLPostion = count($explodeUrl)-1;
				$MidURL = $explodeUrl[$URLPostion];
				
				$explodeMidUrl = explode("?" , $MidURL);
				$FinalURL = $explodeMidUrl[0];
				
			//echo $FinalURL;
			
			//exit();
				if($FinalURL == "ndtvmoney-personal-loan-continue.php")
				{
					header("Location: ndtvmoney/ndtvmoney-personal-loan-thanks.php?id=$encryptInsertedID");
					exit();
				}
				if($FinalURL == "fullerton-personal-loan.php")
				{
					header("Location: /Contents_Personal_Loan_Mustread.php?id=$encryptInsertedID");
					exit();
				}
				
			}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
		
	}
?>