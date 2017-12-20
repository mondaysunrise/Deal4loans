<?php
	//require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();


	function getReqValue($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'personal',
		'Req_Loan_Home' => 'home',
		'Req_Loan_Car' => 'car',
		'Req_Loan_Car' => 'cc',
		'Req_Loan_Against_Property' => 'property',
		'Req_Life_Insurance' => 'insurance'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
	
   function getTransferURL($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Contents_Personal_Loan_Mustread.php',
		'Req_Loan_Home' => 'Contents_Home_Loan_Mustread.php',
		'Req_Loan_Car' => 'Contents_Car_Loan_Mustread.php',
		'Req_Loan_Car' => 'Contents_Credit_Card_Mustread.php',
		'Req_Loan_Against_Property' => 'Contents_Loan_Against_Property_Mustread.php',
		'Req_Life_Insurance' => 'index.php'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

	

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		//$UserID = $_SESSION['UserID'];
		
		$Name = FixString($Name);
		//$LName = FixString($LName);
		
		//$Name=$FName." ".$LName;
		//$last_id = FixString($last_id);
		
		$Dated = ExactServerdate();
		
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		
		$DOB=$Year."-".$Month."-".$Day;
		$last_id = FixString($last_id);
		$Phone = FixString($Phone);
		$Std_Code = FixString($Std_Code);
		$Std_Code_O = FixString($Std_Code_O);
		$Landline_O = FixString($Landline_O);
		$Phone1 = FixString($Phone1);
		$Email = FixString($Email);
		$Item_ID = FixString($Item_ID);
		$Activate = FixString($Activate);
		$Company_Name = FixString($Company_Name);
		$City = FixString($City);
		$Car_Type = FixString($Car_Type);
		$Reference_Code = FixString($reference_code);
		$activation_code = FixString($activation_code);
		$CC_Holder = FixString($CC_Holder);
		$Employment_Status = FixString($Employment_Status);
		$Car_Insurance = FixString($Car_Insurance);
		$City_Other = FixString($City_Other);
		$Pincode = FixString($Pincode);
		$Contact_Time = FixString($Contact_Time);
		$Pincode = FixString($Pincode);
		$Net_Salary = FixString($IncomeAmount);
		$Residence_Address = FixString($Residence_Address);
		$Marital_Status = FixString($Marital_Status);
		$Pancard = FixString($Pancard);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$Car_Model = FixString($Car_Model);
		$Car_Varient = FixString($Car_Varient);
		$From_Product = $_REQUEST['From_Product'];
		//echo "hello".$From_Product."<br>";
		$Net_Salary_Monthly = $Net_Salary / 12;
		//if(!isset($IsPublic))
		   $IsPublic = 1;
		$LName = "";
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$n       = count($From_Product);
		$i      = 0;
		//echo $n."<br>";
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }
		  // echo "bye".$From_Pro."<br>";

		  /*if($Reference_Code==$activation_code)
		{
			$Is_Valid=1;
		}
		else
		{
			$Is_Valid=0;
		}*/

			
		$IP = getenv("REMOTE_ADDR");

		$Creative=$_REQUEST['creative'];
		$Section=$_REQUEST['section'];
		$_SESSION['Temp_Type'] = "PersonalLoan";
		$_SESSION['Temp_Name'] = $Name;
		$_SESSION['Temp_Pancard'] = $Pancard;
		//$_SESSION['Temp_PWD1'] = $PWD1;
		$_SESSION['Temp_FName'] = $FName;
		$_SESSION['Temp_Reference_Code'] = $Reference_Code;
		$_SESSION['Temp_LName'] = $LName;
		$_SESSION['Temp_From_Pro'] = $From_Pro;
		$_SESSION['Temp_Residence_Address'] = $Residence_Address;
		$_SESSION['Temp_Phone'] = $Phone;
		$_SESSION['Temp_Phone1'] = $Phone1;
		$_SESSION['Temp_DOB'] = $DOB;
		$_SESSION['Temp_Std_Code_O'] = $Std_Code_O;
		$_SESSION['Temp_Std_Code'] = $Std_Code;
		$_SESSION['Temp_Landline_O'] = $Landline_O;
		$_SESSION['Temp_Type_Loan'] = $Type_Loan;
		$_SESSION['Temp_Message'] = $Message;
		$_SESSION['Temp_Message1'] = $Message1;
		$_SESSION['Temp_Flag'] = "0";
		$_SESSION['Temp_Email'] = $Email;
		$_SESSION['Temp_Email_New'] = $Email_New;
		$_SESSION['Temp_Net_Salary_Monthly'] = $Net_Salary_Monthly;
		$_SESSION['Temp_Item_ID'] = $Item_ID;
		$_SESSION['Temp_Name_New'] = $Name_New;
		$_SESSION['Temp_Flag_Message'] = "0";
		$_SESSION['Temp_Company_Name'] = $Company_Name;
		$_SESSION['Temp_City'] = $City;
		$_SESSION['Temp_City_Other'] = $City_Other;
		$_SESSION['Temp_Pincode'] = $Pincode;
		$_SESSION['Temp_Contact_Time'] = $Contact_Time;
		//$_SESSION['Temp_Years_In_Company'] = $Years_In_Company;
		$_SESSION['Temp_Employment_Status'] = $Employment_Status;
		$_SESSION['Temp_Employment_Status'] = $Employment_Status;
		$_SESSION['Temp_Net_Salary'] = $Net_Salary;
		//$_SESSION['Temp_CC_Holder'] = $CC_Holder ;
		$_SESSION['Temp_Loan_Amount'] = $Loan_Amount;
		$_SESSION['Temp_IsPublic'] = $IsPublic;
		$Loan_Amount = FixString($Loan_Amount);
		$Count_Views = 0;
		$Count_Replies = 0;
		$IsModified = 0;
		$IsProcessed = 0;	

$Type_Loan="Req_Loan_Car";


$R_URL=$_REQUEST['r_url'];
	if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
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
		$Product_Name = "3";
		
			$dataInsert = array("T_RequestID"=>$RequestID , "T_Product"=>$Product_Name , "T_City"=>$TCity , "Mobile_Number"=>$Mobile , "T_Dated"=>$Dated );
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
	
	}

		$crap = " ".$Name." ".$Email." ".$Company_Name;
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		if($crapValue=='Put')
		{
			$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
			
if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{		//echo "njh";
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
					 list($recordcount,$getrow)=MainselectfuncNew($CheckSql,$array = array());
			 
			 $CheckNumRows = count($getrow);
		     $cntr=0;
			
			if($CheckNumRows>0)
			{
				$UserID = $getrow[0]['UserID'];
			
					$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code_O, "Landline_O"=>$Landline_O, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Car_Type"=>$Car_Type, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "Pincode"=>$Pincode, "Contact_Time"=>$Contact_Time, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP, "DOB"=>$DOB, "CC_Holder"=>$CC_Holder, "Reference_Code"=>$Reference_Code, "Car_Insurance"=>$Car_Insurance, "Accidental_Insurance"=>$Accidental_Insurance, "Is_Valid"=>$Is_Valid, "Car_Varient"=>$Car_Varient, "Car_Model"=>$Car_Model, "Updated_Date"=>$Dated);
		$table = 'Req_Loan_Car';
		$insert = Maininsertfunc ($table, $dataInsert);

			
			
			}
			else
			{
				$dataInsert = array("Email"=>$Email , "FName"=>$Name , "Phone"=>$Phone , "Join_Date"=>$Dated , "IsPublic"=>$IsPublic );
		$table = 'wUsers';
		$UserID1 = Maininsertfunc ($table, $dataInsert);
							
			$dataInsert = array("UserID"=>$UserID1, "Name"=>$Name, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code, "Landline"=>$Phone1, "Std_Code_O"=>$Std_Code_O, "Landline_O"=>$Landline_O, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "Car_Type"=>$Car_Type, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "source"=>$source, "Pincode"=>$Pincode, "Contact_Time"=>$Contact_Time, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "IP_Address"=>$IP, "DOB"=>$DOB, "CC_Holder"=>$CC_Holder, "Reference_Code"=>$Reference_Code, "Car_Insurance"=>$Car_Insurance, "Accidental_Insurance"=>$Accidental_Insurance, "Is_Valid"=>$Is_Valid, "Car_Varient"=>$Car_Varient, "Car_Model"=>$Car_Model, "Updated_Date"=>$dated);
		$table = 'Req_Loan_Car';
		$insert = Maininsertfunc ($table, $dataInsert);
			
				
			}
					
			
			$ProductValue = $insert;
			$_SESSION['Temp_LID'] = $ProductValue;


			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Loan_Car");
				}
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
				$SubjectLine = $Name.", Learn to get Best Deal on Car Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Car Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
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
	
		$filename = "Contents_Car_Loan_Mustread.php";
						header("Location: $filename");
						exit();

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thank you</title>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
<?php 

$getciticitydetails =array('Bangalore','Chandigarh','Chennai','Delhi','Gurgaon','Hyderabad','Kolkata','Mumbai','Noida','Pune');
	if(($Net_Salary>=350000) && (in_array($City, $getciticitydetails))>0)
		{
		 ?>
		<div style="text-align:center; font-weight:bold; line-height:18px; padding:15px 0px;">
		There are some other financial products that are on offer for you on the basis of details you have submitted.
		<br />
		If you are interested, Go ahead and <font color="#5e3307">Apply</font></div>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
		 <?
		  $get_Bank="Select * From credit_card_banks_eligibility Where (cc_bankid in (1,3,4,2) and cc_bank_flag =1) order by cc_bank_fee ASC";
		 list($recordcount,$myrow)=MainselectfuncNew($get_Bank,$array = array());
		$cntr=0;
		

		while($cntr<count($myrow))
        {?>
				<td valign="top">
					<table width="97%" border="0" align="center" cellpadding="0" cellspacing="0" class="crdbg">
						<tr>
							<td height="30" class="crdbhdng"><a href="<? if (strlen($myrow[$cntr]["cc_bank_url"])>0) {echo $myrow[$cntr]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><? echo $myrow[$cntr]["cc_bank_name"];?></a></td>
						</tr>
						<tr>
							<td height="255" align="center" valign="bottom"><a href="<? if (strlen($myrow[$cntr]["cc_bank_url"])>0) {echo $myrow[$cntr]["cc_bank_url"];} else {echo "#";}?>" target="_blank"><img src="<? echo $myrow[$cntr]["card_image"];?>" width="150" height="244" /></a></td>
						</tr>
						<tr>
							<td height="22" valign="bottom" class="crdbold">Features</td>
						</tr>
						<tr>
							<td class="crdtext" height="270"><? echo $myrow[$cntr]["cc_bank_features"];?></td>
						</tr>
						<tr>
							<td  align="center" valign="bottom"><a href="<? if (strlen($myrow[$cntr]["cc_bank_url"])>0) {echo $myrow["cc_bank_url"];} else {echo "#";}?>" target="_blank"><input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" /></a></td>
						</tr>
					</table>
				</td>
				<?    $cntr=$cntr+1; }?>
			</tr>
		</table>
		</div>

	<? }
	?>

 </div>
 
      
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div>-->
<?// }?>

</body>
</html>