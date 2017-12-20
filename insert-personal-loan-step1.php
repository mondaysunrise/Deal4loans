<?php
ob_start();

require 'scripts/db_init.php';
require 'scripts/functions.php';

function getProductName($pKey){
    $titles = array(
    'Req_Loan_Personal' => 'Personal Loan',
    'Req_Loan_Home' => 'Home Loan',
    'Req_Loan_Car' => 'Car Loan',
    'Req_Credit_Card' => 'Credit Card',
    'Req_Loan_Against_Property' => ' Loan Against property',
    'Req_Life_Insurance' => 'Insurance',
    );

    foreach ($titles as $key=>$value)
    if($pKey==$key)
    return $value;

    return "";
}
	
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $Referrer=$_REQUEST['referrer'];
    $source=$_REQUEST['source'];
    $Section=$_REQUEST['section'];
    $Creative=$_REQUEST['creative'];
    $IP = getenv("REMOTE_ADDR");

    $Name = $_POST['Name'];
    $DOB = $_POST['birth_date'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $City = $_POST['City'];
    $City_Other = $_POST['City_Other'];
    $Pincode = $_POST['Pincode'];
    $Employment_Status = $_POST['Employment_Status'];
    $Company_Name = $_POST['Company_Name'];
    $IncomeAmount = $_POST['IncomeAmount'];
    $Loan_Amount = $_POST['Loan_Amount'];
    $CC_Holder = $_POST['CC_Holder'];
    $accept = $_POST['accept'];
    $URL = $_POST['URL'];
	$Dated=ExactServerdate();

    if($Employment_Status==1)
    {
//        $Net_Salary = $_REQUEST['IncomeAmount'] *12;
		$Net_Salary = $_REQUEST['IncomeAmount'];
    }
    else
    {
        $Net_Salary = $_REQUEST['IncomeAmount'];
    }
    $IsPublic = 1;

    $n       = count($From_Product);
    $i      = 0;
    while ($i < $n)
    {
        $From_Pro .= "$From_Product[$i], ";
        $i++;
    }
    if($Activate>0)
    {
        $DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;
       Maindeletefunc($DeleteIncompleteSql,$array = array());
    }
    function InsertTataAig($RequestID, $ProductName)
    {
        $GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
	    list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;


        $TDated = $RowGetDate[$cntr]['Dated'];
        $TCity = $RowGetDate[$cntr]['City'];
        $Mobile = $RowGetDate[$cntr]['Mobile_Number'];
        $Product_Name = "1";

     
		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
		
    }

    $crap = " ".$Name." ".$Email." ".$Company_Name;
    $crapValue = validateValues($crap);
    $_SESSION['crapValue'] = $crapValue;
    if($crapValue=='Put')
    {
        $validMobile = is_numeric($Phone); 

        if(($validMobile==1) && ($Name!=""))
        {
            $CheckSql = "select UserID from wUsers where Email = '".$Email."'";
           
			
			 list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
			$i=0;
            
           
            if($CheckNumRows>0)
            {
                $UserID = $getrow[$i]['UserID'];
                
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$source, 'CC_Bank'=>$From_Pro, 'Card_Vintage'=>$Card_Vintage, 'Referrer'=>$REFERER_URL, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance);
            }
            else
            {
              
			$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
			$table = 'wUsers';
			$UserID = Maininsertfunc ($table, $dataInsert);

            $dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code1, 'Landline'=>$Phone1, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated'=>$Dated, 'Pincode'=>$Pincode, 'source'=>$source, 'CC_Bank'=>$From_Pro, 'Card_Vintage'=>$Card_Vintage, 'Referrer'=>$REFERER_URL, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance);
            }

            echo "hello>".$InsertProductSql."<br>";
            $ProductValue = Maininsertfunc ('Req_Loan_Personal', $dataInsert);	
			$encryptInsertedID =  base64_encode($ProductValue);
            if($Accidental_Insurance=="1")
            {
                InsertTataAig($ProductValue, "Req_Loan_Personal");
            }
            $_SESSION['Temp_LID'] = $ProductValue;
            $SMSMessage = "Dear $Name,your activation code is: $Reference_Code.Use it in step 2 of loan app form to get bidder contacts & quotes. And help us serve you better.";
            if(strlen(trim($Phone)) > 0)
            {
				//SendSMS($SMSMessage, $Phone);
				//exit();
			}

          //Code Added to mailtocommonscript.php
            $FName = $Name;
            $Checktosend="getthank_individual";
            include "scripts/mailatcommonscript.php";

            $headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
            $headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            if($Name)
            $SubjectLine = $Name.", Learn to get Best Deal on ".getProductName($Type_Loan);
            else
            $SubjectLine = "Learn to get Best Deal on ".getProductName($Type_Loan);
            //echo $Type_Loan;
            if(isset($Type_Loan))
            {
                mail($Email, $SubjectLine, $Message2, $headers);
            }

	//Redirect to the specific page
 			$explodeUrl = explode("/" , $URL);
			$URLPostion = count($explodeUrl)-1;
			$MidURL = $explodeUrl[$URLPostion];
			
			$explodeMidUrl = explode("?" , $MidURL);
			$FinalURL = $explodeMidUrl[0];
			
		//echo $FinalURL;
		
		//exit();
			if($FinalURL == "ndtvmoney-personal-loan.php")
			{
				header("Location: ndtvmoney/ndtvmoney-personal-loan-continue.php?id=$encryptInsertedID");
				exit();
			}

        }
        else
        {
            //echo "Track URI and redirect this to the same page";
            $msg = "NotAuthorised";
            $PostURL ="http://www.deal4loans.com/".$_POST["PostURL"]."?msg=".$msg;
            header("Location: $PostURL");
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