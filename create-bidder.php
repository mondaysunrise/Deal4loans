<?php
include "scripts/session_bidders.php"; 
require 'scripts/db_init.php';
require 'scripts/functions.php';

function getTableName($pKey)
{
    $titles = array(
        1=> 'Req_Loan_Personal',
        2=> 'Req_Loan_Home',
        3=> 'Req_Loan_Car',
        4=> 'Req_Credit_Card',
        5=> 'Req_Loan_Against_Property',
        6=> 'Req_Business_Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
}

function getTableCode($pKey)
{
    $titles = array(
        1=> 'pl',
        2=> 'hl',
        3=> 'cl',
        4=> 'cc',
        5=> 'lap',
        6=> 'bl'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
}


$bank_master = "Bank_Master";

if(isset($_POST['submit']))
{
	//echo "<pre>";
	//print_r($_POST);
		//echo "<br><br>";
	$lead_cost = $_POST['lead_cost'];	
	$business_manager = $_POST['business_manager'];
	$bdSql = "select * from BD_List where BD_ID='".$business_manager."'";
	$bdQuery = ExecQuery($bdSql);
	$BD_Name = mysql_result($bdQuery,0,'BD_Name');
	$BD_Manager = mysql_result($bdQuery,0,'BD_Manager');
	$BD_Number = mysql_result($bdQuery,0,'BD_Number');	
		
	$Associated_Bank = $_POST['bank_name'];
	$Reply_type = $_POST['Reply_type'];
	$Table_Name = getTableName($Reply_type);
	$Bidder_Name = $_POST['Bidder_Name'];
	$Email = $_POST['email_id'];
	$Address = $_POST['Address'];
	$Contact_Number = $_POST['Contact_Number'];
	$conflict_set = $_POST['conflict_set'];
	if(strlen($conflict_set)>0)
	{
		$sequenceSql = " SELECT max(Sequence_no) as Sequence FROM `bidders_list`WHERE BidderID in ( ".$conflict_set." ) ";
		$sequenceQuery = ExecQuery($sequenceSql);
		$sequence = mysql_result($sequenceQuery,0,'Sequence');	
	}
	$sequence = $sequence + 1;
	$Join_Date = $_POST['Join_Date'];
	$activate_sms = $_POST['activate_sms'];
	
	$sms_two_way = $_POST['sms_two_way'];	
	$mobile_sms = $_POST['mobile_sms'];
			
	$Daily = $_POST['Daily'];
	$Monthly = $_POST['Monthly'];
	$Weekly = $_POST['Weekly'];
	$Yearly = $_POST['Yearly'];		
	
	if($Daily>0)
	{
		$Daily_Cap = $Daily;
	}
	else
	{
		$Daily_Cap = 0;
	}
	
	if($Monthly>0)
	{
		$Monthly_Cap = $Monthly;
	}
	else
	{
		$Monthly_Cap = 0;
	}
	
	if($Weekly>0)
	{
		$Weekly_Cap = $Weekly;
	}
	else
	{
		$Weekly_Cap = 0;
	}
	
	if($Yearly>0)
	{
		$Yearly_Cap = $Yearly;
	}
	else
	{
		$Yearly_Cap = 0;
	}
	
	$CAP = 	$Daily_Cap.",".$Weekly_Cap.",".$Monthly_Cap.",".$Yearly_Cap;
			
	$type_of = $_POST['type_of']; 
			
	$City = $_POST['City'];

	if($City[0]=="Delhi,Noida,Gurgaon,Gaziabad,Sahibabad,Greater Noida")
	{
		$Bidder_City = "Delhi";
	}
	else if($City[0]=="Mumbai,Navi Mumbai,Thane")
	{
		$Bidder_City = "Mumbai";
	}
	else
	{
		$Bidder_City = $City[0];
	}

	$imp_City = implode(",", $City);
	$Other_City = $_POST['Other_City'];
	if(strlen($Other_City)>0)
	{
		//$imp_Other_City = implode(",", $Other_City);
		$imp_Other_City = $Other_City;
		$Put_City = $imp_City.",".$imp_Other_City;
	}
	else
	{
		$Put_City = $imp_City;
	}
	
	if($Reply_type==1)
	{
		$Employment_Status = $_POST['Employment_Status'];
		
		if($Employment_Status==1)
		{
			$Put_Employment_Status = " and ( ".$Table_Name.".Employment_Status=".$Employment_Status." ) ";
		}
		
		$Minimum_Age = $_POST['Minimum_Age'];
		
		if(strlen($Minimum_Age)>0)
		{
			$Put_Minimum_Age = " and (".$Table_Name.".DOB!=\'\'  and DATE_SUB(CURDATE(),INTERVAL ".$Minimum_Age." YEAR) >= ".$Table_Name.".DOB ) ";
		}
		
		$Maximum_Age = $_POST['Maximum_Age'];
		
		if(strlen($Maximum_Age)>0)
		{
			$Put_Maximum_Age = " and (".$Table_Name.".DOB!=\'\'  and DATE_SUB(CURDATE(),INTERVAL ".$Maximum_Age." YEAR) <= ".$Table_Name.".DOB ) ";
		}
		
		$Is_Valid = $_POST['Is_Valid'];
		
		if($Is_Valid==1)
		{
			$Put_Is_Valid = " and ( ".$Table_Name.".Is_Valid=".$Is_Valid." ) ";
		}
		
		$Pincodes = $_POST['Pincodes'];
		
		$min_Loan_Amount = $_POST['min_Loan_Amount'];
		if(strlen($min_Loan_Amount)>0)
		{
			$Put_min_Loan_Amount = " and ( ".$Table_Name.".Loan_Amount>=".$min_Loan_Amount." ) ";	
		}
		
		$max_Loan_Amount = $_POST['max_Loan_Amount'];
		if(strlen($max_Loan_Amount)>0)
		{
			$Put_max_Loan_Amount = " and ( ".$Table_Name.".Loan_Amount<=".$max_Loan_Amount." ) ";	
		}
		
		$LoanRunning = $_POST['LoanRunning'];
		
		$EMI_Paid = $_POST['EMI_Paid'];
			
		if($EMI_Paid > 0)
		{
			$Put_EMI_Paid = " and ( ".$Table_Name.".EMI_Paid=".$EMI_Paid." ) ";
		}
		
		$CC_Holder = $_POST['CC_Holder'];
		if($CC_Holder==1)
		{
			$Put_CCHolder = " and ( ".$Table_Name.".CC_Holder=".$CC_Holder." ) ";
		}
					
		$min_NetSalary = $_POST['min_NetSalary'];
		if(strlen($min_NetSalary)>0)
		{
			$Put_min_NetSalary = " and ( ".$Table_Name.".Net_Salary>=".$min_NetSalary." ) ";
		}
		
		$max_NetSalary = $_POST['max_NetSalary'];
		if(strlen($max_NetSalary)>0)
		{
			$Put_max_NetSalary = " and ( ".$Table_Name.".Net_Salary<=".$max_NetSalary." ) ";
		}
		
		$Total_Experience = $_POST['Total_Experience'];
		if(strlen($Total_Experience)>0)
		{
			$Put_Total_Experience = " and ( ".$Table_Name.".Total_Experience>=".$Total_Experience." ) ";
		}
		
		$Current_Experience = $_POST['Current_Experience'];
		if(strlen($Current_Experience)>0)
		{
			$Put_Current_Experience = " and ( ".$Table_Name.".Years_In_Company>=".$Current_Experience." ) ";
		}
		
		$Card_Vintage = $_POST['Card_Vintage'];
		if(strlen($Card_Vintage)>0)
		{
			$Put_Card_Vintage = " and ( ".$Table_Name.".Card_Vintage>=".$Card_Vintage." ) ";
		}
		
		$Card_Limit = $_POST['Card_Limit'];
		if(strlen($Card_Limit)>0)
		{
			$Put_Card_Limit = " and ( ".$Table_Name.".Card_Limit>=".$Card_Limit." ) ";
		}
		
		$create_Sql = "Select RequestID From ".$Table_Name."  where 1=1 ".$Put_min_NetSalary." ".$Put_max_NetSalary." ".$Put_Is_Valid." ".$Put_Minimum_Age." ".$Put_Maximum_Age."  ".$Put_Employment_Status." ".$Put_min_Loan_Amount	."  ".$Put_max_Loan_Amount." ".$Put_EMI_Paid." ".$Put_CCHolder." ".$Put_Total_Experience." ".$Put_Current_Experience." ".$Put_Card_Vintage." ".$Put_Card_Limit."   ";
		//echo $create_Sql;
		//echo "<br><br>";
		
		$trimName = strtolower (substr($Bidder_Name, 0,6));
		 $trimName = str_replace(" ","", $trimName);
		$prod_code = getTableCode($Reply_type);
		$sqlUsd = "select * from Bank_Master where BankID = '".$Associated_Bank."'";
		$queryUsd = ExecQuery($sqlUsd);
		$abbr = mysql_result($queryUsd,0,'abbr');
		$Bank_Name = mysql_result($queryUsd,0,'Bank_Name');
		$username = $trimName."_".$abbr."_".$prod_code."@d4l.com";
		$pwd_date = date("dmy");	
		$password = $trimName."".$pwd_date."".$Reply_type;
			//echo "<br><br>";
		$Bidder_Insert = "insert into Bidders set Bidder_Name='".$Bidder_Name."' , Associated_Bank='".$Bank_Name."' ,  BidderEmailID='".$Email."' , City='".$Bidder_City."', Address='".$Address."' , Join_Date='".$Join_Date."' , Reply_type='".$Reply_type."',  Email='".$username."', PWD='".$password."', Contact_Num='".$Contact_Number."', Is_Verified=2, Define_PrePost= '".$type_of."', BD_Number= '".$BD_Number."',  Manager_Name= '".$Manager_Name."',  BD_Name= '".$BD_Name."' ";
		//echo $Bidder_Insert;
		$Query_Bidder_Insert = ExecQuery($Bidder_Insert);
		$Last_Inserted_ID = mysql_insert_id();
		//echo "<br><br><br>";
		$Bidder_List_Insert = "insert into Bidders_List set BidderID='".$Last_Inserted_ID."', Bidder_Name='".$Bank_Name."' , Reply_type='".$Reply_type."', City='".$Put_City."', Query='".$create_Sql."' , Dated='".$Join_Date."', Table_Name='".$Table_Name."', Restrict_Bidder=0, Conflict_bidder ='".$conflict_set."', BankID='".$Associated_Bank."',  CapLead_Count = '".$CAP."', Multiplier='".$lead_cost."' , Sequence_no = '".$sequence."'";
		//echo $Bidder_List_Insert;
		$Query_Bidder_List_Insert = ExecQuery($Bidder_List_Insert);
		
		$exp_conflict_set = explode(',',$conflict_set);
		$ConflictBidder ="";
		for($exp=0;$exp<count($exp_conflict_set);$exp++)
		{
			$getConflictSql = "select * from Bidders_List where BidderID='".$exp_conflict_set[$exp]."'";
			$getConflictQuery = ExecQuery($getConflictSql);
			$ConflictBidder = mysql_result($getConflictQuery,0,'Conflict_bidder');
			if(strlen($ConflictBidder)>0)
			{
				$NewConflictSet = $ConflictBidder.",".$Last_Inserted_ID; 
			}
			else
			{
				$NewConflictSet = $Last_Inserted_ID;
			}
			$updateSql = "update Bidders_List set Conflict_bidder = '".$NewConflictSet."' where BidderID ='".$exp_conflict_set[$exp]."'";
		//	$updateQuery = ExecQuery($updateSql);
			//echo "<br>".$updateSql."<br>";
		}
		
		
		
		if($activate_sms==1)
		{
			$biddersms_Sql = "INSERT INTO `Req_Compaign` (`Reply_Type` , `Bank_Name` , `BidderID` , `Start_Date` , `Sms_Flag` , `Mobile_no` ) VALUES ('".$Reply_type."', '".$Bank_Name."', '".$Last_Inserted_ID."', '".$Join_Date."', '1', '".$Contact_Number."')";
			$biddersms_Query = ExecQuery($biddersms_Sql);
		//echo "<br>".$biddersms_Sql;		
		//echo "<br>";
		}
		
		if($sms_two_way==1)
		{	
			$customers_bidders_Sql = "INSERT INTO `Bidder_Contact_To_Customers` ( `Reply_Type` , `Bank_Name` , `Bankers_Name` , `Banker_Contact` , `BidderID` , `Sms_Flag`  ) VALUES ('".$Reply_type."', '".$Bank_Name."', '".$Bank_Name."', '".$mobile_sms."', '".$Last_Inserted_ID."', '1')";
			$customers_bidders_Query = ExecQuery($customers_bidders_Sql);
			//echo "<br>".$customers_bidders_Sql;		
			//echo "<br>";
		}
	}//End PL
	if($Reply_type==2)
	{
		$Minimum_Age = $_POST['Minimum_Age'];//
		$Maximum_Age = $_POST['Maximum_Age'];//
		$Is_Valid = $_POST['Is_Valid'];//
		$Property_Identified = $_POST['Property_Identified'];
		$Loan_Time = $_POST['Loan_Time'];
		$Property_Location = $_POST['Property_Location'];
		$Property_Value = $_POST['Property_Value'];//optional
		$min_Loan_Amount = $_POST['min_Loan_Amount'];//
		$max_Loan_Amount = $_POST['max_Loan_Amount'];//
		
		if($Property_Identified==1)
		{
			$Put_Property_Identified = " and ( ".$Table_Name.".Property_Identified=\'".$Property_Identified."\' ) ";
		}
		
		if(strlen($Loan_Time)>0)
		{
			$Put_Loan_Time = " and ( ".$Table_Name.".Loan_Time = \'".$Loan_Time."\' ) ";
		}
		
		if(strlen($Property_Location)>0)
		{
			$Put_Property_Location = " and ( ".$Table_Name.".Property_Loc like \'%".$Property_Location."%\' ) ";
		}
		
		if(strlen($Minimum_Age)>0)
		{
			$Put_Minimum_Age = " and (".$Table_Name.".DOB!=\'\'  and DATE_SUB(CURDATE(),INTERVAL ".$Minimum_Age." YEAR) >= ".$Table_Name.".DOB ) ";
		}
		
		if(strlen($Maximum_Age)>0)
		{
			$Put_Maximum_Age = " and (".$Table_Name.".DOB!=\'\'  and DATE_SUB(CURDATE(),INTERVAL ".$Maximum_Age." YEAR) <= ".$Table_Name.".DOB ) ";
		}
		
		
		if(strlen($min_Loan_Amount)>0)
		{
			$Put_min_Loan_Amount = " and ( ".$Table_Name.".Loan_Amount>=".$min_Loan_Amount." ) ";	
		}
		
		
		if(strlen($max_Loan_Amount)>0)
		{
			$Put_max_Loan_Amount = " and ( ".$Table_Name.".Loan_Amount<=".$max_Loan_Amount." ) ";	
		}
		
		$min_NetSalary = $_POST['min_NetSalary'];
		if(strlen($min_NetSalary)>0)
		{
			$Put_min_NetSalary = " and ( ".$Table_Name.".Net_Salary>=".$min_NetSalary." ) ";
		}
		
		$max_NetSalary = $_POST['max_NetSalary'];
		if(strlen($max_NetSalary)>0)
		{
			$Put_max_NetSalary = " and ( ".$Table_Name.".Net_Salary<=".$max_NetSalary." ) ";
		}
		
		$create_Sql = "Select RequestID From ".$Table_Name."  where 1=1 ".$Put_min_NetSalary." ".$Put_max_NetSalary." ".$Put_Is_Valid." ".$Put_Minimum_Age." ".$Put_Maximum_Age."  ".$Put_Employment_Status." ".$Put_min_Loan_Amount	."  ".$Put_max_Loan_Amount." ".$Put_Property_Location." ".$Put_Loan_Time." ".$Put_Property_Identified." ";
		//echo $create_Sql;
		//echo "<br><br>";
		
		$trimName = strtolower (substr($Bidder_Name, 0,6));
		 $trimName = str_replace(" ","", $trimName);
		$prod_code = getTableCode($Reply_type);
		$sqlUsd = "select * from Bank_Master where BankID = '".$Associated_Bank."'";
		$queryUsd = ExecQuery($sqlUsd);
		$abbr = mysql_result($queryUsd,0,'abbr');
		$Bank_Name = mysql_result($queryUsd,0,'Bank_Name');
		$username = $trimName."_".$abbr."_".$prod_code."@d4l.com";
		$pwd_date = date("dmy");	
		$password = $trimName."".$pwd_date."".$Reply_type;
		//echo "<br><br>";
		$Bidder_Insert = "insert into Bidders set Bidder_Name='".$Bidder_Name."' , Associated_Bank='".$Bank_Name."' ,  BidderEmailID='".$Email."' , City='".$Bidder_City."', Address='".$Address."' , Join_Date='".$Join_Date."' , Reply_type='".$Reply_type."',  Email='".$username."', PWD='".$password."', Contact_Num='".$Contact_Number."', Is_Verified=2, Define_PrePost= '".$type_of."', BD_Number= '".$BD_Number."',  Manager_Name= '".$Manager_Name."',  BD_Name= '".$BD_Name."'";
		//echo $Bidder_Insert;
		$Query_Bidder_Insert = ExecQuery($Bidder_Insert);
		$Last_Inserted_ID = mysql_insert_id();
		//echo "<br><br><br>";
		$Bidder_List_Insert = "insert into Bidders_List set BidderID='".$Last_Inserted_ID."', Bidder_Name='".$Bank_Name."' , Reply_type='".$Reply_type."', City='".$Put_City."', Query='".$create_Sql."' , Dated='".$Join_Date."', Table_Name='".$Table_Name."', Restrict_Bidder=0, Conflict_bidder ='".$conflict_set."', BankID='".$Associated_Bank."',  CapLead_Count = '".$CAP."', Multiplier='".$lead_cost."' , Sequence_no = '".$sequence."'";
		//echo $Bidder_List_Insert;
		$Query_Bidder_List_Insert = ExecQuery($Bidder_List_Insert);
		
		$exp_conflict_set = explode(',',$conflict_set);
		$ConflictBidder ="";
		for($exp=0;$exp<count($exp_conflict_set);$exp++)
		{
			$getConflictSql = "select * from Bidders_List where BidderID='".$exp_conflict_set[$exp]."'";
			$getConflictQuery = ExecQuery($getConflictSql);
			$ConflictBidder = mysql_result($getConflictQuery,0,'Conflict_bidder');
			if(strlen($ConflictBidder)>0)
			{
				$NewConflictSet = $ConflictBidder.",".$Last_Inserted_ID; 
			}
			else
			{
				$NewConflictSet = $Last_Inserted_ID;
			}
			$updateSql = "update Bidders_List set Conflict_bidder = '".$NewConflictSet."' where BidderID ='".$exp_conflict_set[$exp]."'";
		//	$updateQuery = ExecQuery($updateSql);
			echo "<br>".$updateSql."<br>";
		}
		
		
		
		if($activate_sms==1)
		{
			$biddersms_Sql = "INSERT INTO `Req_Compaign` (`Reply_Type` , `Bank_Name` , `BidderID` , `Start_Date` , `Sms_Flag` , `Mobile_no` ) VALUES ('".$Reply_type."', '".$Bank_Name."', '".$Last_Inserted_ID."', '".$Join_Date."', '1', '".$Contact_Number."')";
			$biddersms_Query = ExecQuery($biddersms_Sql);
		//echo "<br>".$biddersms_Sql;		
		//echo "<br>";
		}
		
		if($sms_two_way==1)
		{	
			$customers_bidders_Sql = "INSERT INTO `Bidder_Contact_To_Customers` ( `Reply_Type` , `Bank_Name` , `Bankers_Name` , `Banker_Contact` , `BidderID` , `Sms_Flag`  ) VALUES ('".$Reply_type."', '".$Bank_Name."', '".$Bank_Name."', '".$mobile_sms."', '".$Last_Inserted_ID."', '1')";
			$customers_bidders_Query = ExecQuery($customers_bidders_Sql);
			//echo "<br>".$customers_bidders_Sql;		
			//echo "<br>";
		}
		
	}//End HL
	echo "Bidder Created";
}

//$BidderID=$_SESSION['BidderID'];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Create Bidder</title>
<link rel="stylesheet" href="mostyle.css" type="text/css" />
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />

<?php 
	 if(isset($_SESSION['UserType']))
	{
		echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'><tr><td width='323' height='93' align='left' valign='top'  ><img src='http://www.deal4loans.com/rnew/images/login-logo.gif' width='323' height='93' /></td><td align='left' valign='top' style='color:#0B6FCC;' ><table width='100%' border='0' cellspacing='0' cellpadding='0' bgcolor='#0A92C0'><tr><td height='67' align='right' valign='middle' bgcolor='#C8E3F3' style='padding-right:10px;'><table border='0' align='right' cellpadding='0' cellspacing='0' bgcolor='#0A92C0'><tr><td width='6' height='32' align='left' valign='top'><img  src='http://www.deal4loans.com/rnew/images/login-form-logut-lft.gif' width='6' height='32' /></td><td background='http://www.deal4loans.com/rnew/images/login-form-logut-bg.gif' style=' background-repeat:repeat-x; height:32px;'><table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td align='left' valign='middle' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF; font-weight:bold; padding-right:15px;' > Welcome ".$_SESSION['UName']."</td><td align='left' style='padding-right:2px;' width='22'><img src='http://www.deal4loans.com/rnew/images/login-logut-btn.gif' /></td><td align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'><div align='right' class='style1' style='color:#FFFFFF; font-weight:bold;'> <a href='LogoutC.php' style='color:#FFFFFF; font-size:13px; text-decoration:none; font-family:Verdana, Arial, Helvetica, sans-serif;'>Logout</a></div></td></tr></table></td><td width='6' height='32'><img src='http://www.deal4loans.com/rnew/images/login-form-logut-rgt.gif' width='6' height='32' /></td></tr></table></td></tr><tr><td>&nbsp;</td></tr></table></td></tr></table>";
	}
?>
<style>
.bidderclass
{
Font-family:Comic Sans MS;
font-size:13px;
}
.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
	color:#084459;
}
.style2 {
	font-family: verdana;
	font-size: 11px;
	font-weight: bold;
	color:#084459;
}

.style3 {
	font-family: verdana;
	font-size: 11px;
	font-weight: normal;
	color:#084459;
	text-decoration:none;
}


.bluebtn{
font-family:Verdana, Arial, Helvetica, sans-serif; 
font-size:12px;
font-weight:bold;
color:#084459;
border:1px solid #084459;
background-color:#FFFFFF;
}

.buttonfordate {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #FFFFFF;

	background-color: #45B2D8;
	border: 1px solid #45B2D8;
	font-weight: bold;
}
.regdalert{
	font-size:10px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	color:#FF0033;
	text-decoration:none;
}

</style>
<Script Language="JavaScript" Type="text/javascript">
var ajaxRequestMain;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequestMain = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

		function getConflictSet()
		{
			var total="";
			var get_city = "";
			for(var i=0; i < document.BidderInsert.City.length; i++){
			if(document.BidderInsert.City[i].selected)
			total +=document.BidderInsert.City[i].value + ",";
			}
/*
			if(total=="")
				alert("select scripts") 
			else
				alert (total);
*/
			get_city = total;
			var get_bank_name = document.getElementById('bank_name').value;
			var get_Reply_type = document.getElementById('Reply_type').value;
			//var get_city = document.getElementById('City').value;
			var get_Other_City = document.getElementById('Other_City').value;
		
			var queryString = "?get_bank_name=" + get_bank_name +"&get_city=" + get_city + "&get_Reply_type=" + get_Reply_type + "&get_Other_City=" + get_Other_City ;
//			alert(queryString); 
			ajaxRequestMain.open("GET", "getConflictSet.php" + queryString, true);
			// Create a function that will receive data sent from the server
			ajaxRequestMain.onreadystatechange = function(){
				if(ajaxRequestMain.readyState == 4)
				{
		//			alert(ajaxRequestMain.responseText);
					var ajaxDisplay = document.getElementById('MyDivConflict');
					ajaxDisplay.innerHTML = ajaxRequestMain.responseText;
					
				}
			}
			ajaxRequestMain.send(null); 
		}
	window.onload = ajaxFunctionMain;
</script>
<Script Language="JavaScript">

function addSMSElement()
{
	var ni = document.getElementById('smsDiv');
	if(ni.innerHTML=="")
	{
		ni.innerHTML = '<table border="0" width="100%"><tr><td align="left" class="frmtxt" width="180" height="20">Mobile No.</td><td class="frmtxt" colspan="3" align="left" width="350" height="20" ><input size="18" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; name="mobile_sms" id="mobile_sms"></td></tr><tr><td align="left" class="frmtxt" width="180" height="20">CC Mobile No.</td><td class="frmtxt" colspan="3" align="left" width="350" height="20" ><input size="18" type="text" onChange="intOnly(this);" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; name="cc_mobile_sms" id="cc_mobile_sms"></td></tr></table>';
	}
	else if(ni.innerHTML!="")
	{
			ni.innerHTML = '';
	}
	return true;
}

function addCondition()
{
	var ni = document.getElementById('MyDiv');
	if(document.BidderInsert.Reply_type.value=="1")
	{
		ni.innerHTML = '<table width="75%" border="0" align="left" style="border:2px solid grey;"><tr><td colspan="2"><strong>Personal Loan Conditions on which Leads to be distributed</strong></td></tr><tr><td>City</td>    <td><select size="4" align="left" name="City[]" id="City" multiple onchange="return getConflictSet();">      <option value="">Please Select</option>      <option value="Mumbai,Navi Mumbai,Thane">Mumbai Total</option>      <option value="Delhi,Noida,Gurgaon,Gaziabad,Sahibabad,Greater Noida">Delhi Total</option><option value="Bangalore">Bangalore</option><option value="Chennai">Chennai</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Kolkata">Kolkata</option><option value="Mumbai">Mumbai</option><option value="Pune">Pune</option><option value="Ahmedabad">Ahmedabad</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Chandigarh">Chandigarh</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Guntur">Guntur</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nagpur">Nagpur</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Noida">Noida</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option><option value="Others">Others</option></select>          (Multiple Select)</td>  </tr>  <tr>     <td>Other City</td><td><input type="text" name="Other_City" id="Other_City" onChange="return getConflictSet();" >      Comma Seperated</td></tr><tr><td>Employment Status</td><td><select size="1" name="Employment_Status">        <option value="" selected>Please select</option>        <option  value="1">Salaried</option>        <option value="0">Self Employed</option>      </select> </td>  </tr>  <tr>     <td>Minimum Age</td>    <td><input type="text" name="Minimum_Age"></td>  </tr>  <tr>     <td>Maximum Age</td>    <td><input type="text" name="Maximum_Age"></td>  </tr> <tr>     <td>PinCodes</td>    <td><input type="text" name="Pincodes">      Can Be Comma Seperated</td>  </tr>  <tr>     <td>Loan Amount</td>    <td>Min <input type="text" name="min_Loan_Amount" id="min_Loan_Amount"> Max <input type="text" name="max_Loan_Amount" id="max_Loan_Amount"></td>  </tr><tr><td>Any Loan Running</td>    <td><select size="1" name="LoanRunning">        <option value="" selected>Please select</option><option  value="Yes">Yes</option>        <option value="No">No</option>      </select></td>  </tr>  <tr>     <td>How many Emi Paid</td><td><select name="EMI_Paid" style="width:200px;"  > <option value="">Please select</option><option value="1"><font color="#330101">Less than 6 months</font></option> <option value="2"><font color="#330101">6 to 9 months</font></option> <option value="3">9 to 12 months</option> <option value="4"><font color="#330101">more than 12 months</font></option ></select></td>  </tr>  <tr>     <td>Credit Card Holder</td>    <td><select size="1" name="CC_Holder"><option value="" selected>Please select</option>        <option  value="Yes">Yes</option>        <option value="No">No</option></select> </td>  </tr> <tr><td>Card Vintage </td><td><select class="style4" size="1" name="Card_Vintage" style="width:140px; margin-top:2px;"><option value="">Please select</option> <option value="1">Less than 6 months</option>		 <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option>				<option value="4">more than 12 months</option> </select></td></tr> <tr>     <td>Net Salary</td>    <td>Min <input type="text" name="min_NetSalary" id="min_NetSalary"> Max <input type="text" name="max_NetSalary" id="max_NetSalary"></td>  </tr>  <tr><td>Any other Condition</td>    <td> <textarea name="MiscConditions" cols="30" rows="3"></textarea> </td>  </tr><tr><td>Total Experience </td><td><input type="text" name="Total_Experience" id="Total_Experience"></td></tr>  <tr><td>Current Experience </td><td><input type="text" name="Current_Experience" id="Current_Experience"></td></tr></table>';
	}
	else if(document.BidderInsert.Reply_type.value=="2")
	{
		ni.innerHTML = '<table width="85%" border="0" align="left" style="border:2px solid grey;"><tr><td colspan="2"><strong>Home Loan Conditions on which Leads to be distributed</strong></td></tr><tr><td>City</td><td><select size="4" align="left" name="City[]" id="City" multiple  onChange="return getConflictSet();"><option value="">Please Select</option><option value="Mumbai,Navi Mumbai,Thane">Mumbai Total</option><option value="Delhi,Noida,Gurgaon,Gaziabad,Sahibabad,Greater Noida">Delhi Total</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Noida">Noida</option><option value="Patna">Patna</option><option value="Pune">Pune</option><option value="Ranchi">Ranchi</option><option value="Sahibabad">Sahibabad</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Vadodara">Vadodara</option><option value="Vishakapatanam">Vishakapatanam</option></select>(Multiple Select)</td></tr><tr><td>Other City</td> <td><input type="text" name="Other_City" id="Other_City"  onChange="return getConflictSet();">Comma Seperated</td></tr><tr><td>Minimum Age</td> <td><input type="text" name="Minimum_Age" id="Minimum_Age"></td></tr><tr><td>Maximum Age</td> <td><input type="text" name="Maximum_Age" id="Maximum_Age"></td></tr><tr><td>IsValid (SMS)</td> <td><select size="1" name="Is_Valid" id="Is_Valid"><option value="0" selected>Please select</option><option  value="1">Yes</option><option value="0">No</option></select> </td></tr><tr><td>Loan Amount</td> <td>Min <input type="text" name="min_Loan_Amount" id="min_Loan_Amount"> Max <input type="text" name="max_Loan_Amount" id="max_Loan_Amount"></td></tr><tr><td>Property Identified<br></td> <td><select size="1" name="Property_Identified" id="Property_Identified"><option value="">No</option><option  value="1">Yes</option></select> </td></tr><tr><td>When you are planning to take loan?</td> <td><select name="Loan_Time"  class="style4" ><OPTION value="" selected>Please select</OPTION><OPTION value="15 days">15 days</OPTION><OPTION value="1 month">1 months</OPTION><OPTION value="2 months">2 months</OPTION><OPTION value="3 months">3 months</OPTION><OPTION value="3 months & above">more than 3 months</OPTION></SELECT></td></tr><tr>     <td>Net Salary</td>    <td>Min <input type="text" name="min_NetSalary" id="min_NetSalary"> Max <input type="text" name="max_NetSalary" id="max_NetSalary"></td>  </tr><tr><td>Any other Condition</td><td><textarea name="MiscConditions" cols="30" rows="3"></textarea></td></tr><tr><td>Property Location</td><td><select align="left" name="Property_Location" id="Property_Location" ><option value="">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Noida">Noida</option><option value="Patna">Patna</option><option value="Pune">Pune</option><option value="Ranchi">Ranchi</option><option value="Sahibabad">Sahibabad</option><option value="Surat">Surat</option><option value="Thane">Thane</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Vadodara">Vadodara</option><option value="Vishakapatanam">Vishakapatanam</option></select></td></tr></table>';
	}
	else if(document.BidderInsert.Reply_type.value=="3")
	{
		ni.innerHTML = '<table width="75%" border="0" align="left"><tr><td colspan="2"><strong>Conditions on which Leads to be distributed</strong></td></tr><tr><td>City</td><td><select size="4" align="left" name="City[]" id="City" multiple  onChange="return getConflictSet();"><option value="Please Select">Please Select</option><option value="Mumbai,Navi Mumbai,Thane">Mumbai Total</option><option value="Delhi,Noida,Gurgaon,Gaziabad,Sahibabad,Greater Noida">Delhi Total</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option>  <option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option>        <option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option>        <option value="Mangalore">Mangalore</option>        <option value="Mysore">Mysore</option>        <option value="Mumbai">Mumbai</option>        <option value="Nagpur">Nagpur</option>        <option value="Nasik">Nasik</option>        <option value="Navi Mumbai">Navi Mumbai</option>        <option value="Noida">Noida</option>        <option value="Patna">Patna</option>        <option value="Pune">Pune</option>        <option value="Ranchi">Ranchi</option>        <option value="Sahibabad">Sahibabad</option>        <option value="Surat">Surat</option>        <option value="Thane">Thane</option>        <option value="Thiruvananthapuram">Thiruvananthapuram</option>        <option value="Trivandrum">Trivandrum</option>        <option value="Trichy">Trichy</option>        <option value="Vadodara">Vadodara</option>        <option value="Vishakapatanam">Vishakapatanam</option>   </select>      (Multiple Select)</td>  </tr>  <tr>     <td>Other City</td>    <td><input type="text" name="Other_City" id="Other_City"  onChange="return getConflictSet();">      Comma Seperated</td>  </tr><tr>     <td>Minimum Age</td>    <td><input type="text" name="Minimum_Age"></td>  </tr>  <tr>     <td>Maximum Age</td>    <td><input type="text" name="Maximum_Age"></td>  </tr>  <tr>     <td>IsValid (SMS)</td>    <td><select size="1" name="Is_Valid">        <option value="0" selected>Please select</option>        <option  value="1">Yes</option>        <option value="0">No</option>      </select> </td>  </tr>  <tr>     <td>Loan Amount</td>    <td><input type="text" name="Loan_Amount"></td>  </tr>   <tr>     <td>Car Type</td>    <td> <select size="1" name="Car_Type">	<?=AmISelected("New", $Car_Type, "1")?>	<?=AmISelected("Used", $Car_Type, "0")?>     </select></td>  </tr>      <tr>     <td>Any other Condition</td>    <td> <textarea name="MiscConditions" cols="30" rows="3"></textarea> </td>  </tr></table>';
	}
	else if(document.BidderInsert.Reply_type.value=="4")
	{
		ni.innerHTML = '<table width="75%" border="0" align="left"><tr><td colspan="2"><strong>Conditions on which Leads to be distributed</strong></td></tr><tr><td>City</td><td><select size="4" align="left" name="City[]" id="City" multiple  onChange="return getConflictSet();"><option value="Please Select">Please Select</option><option value="Mumbai,Navi Mumbai,Thane">Mumbai Total</option><option value="Delhi,Noida,Gurgaon,Gaziabad,Sahibabad,Greater Noida">Delhi Total</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option>  <option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option>        <option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option>        <option value="Mangalore">Mangalore</option>        <option value="Mysore">Mysore</option>        <option value="Mumbai">Mumbai</option>        <option value="Nagpur">Nagpur</option>        <option value="Nasik">Nasik</option>        <option value="Navi Mumbai">Navi Mumbai</option>        <option value="Noida">Noida</option>        <option value="Patna">Patna</option>        <option value="Pune">Pune</option>        <option value="Ranchi">Ranchi</option>        <option value="Sahibabad">Sahibabad</option>        <option value="Surat">Surat</option>        <option value="Thane">Thane</option>        <option value="Thiruvananthapuram">Thiruvananthapuram</option>        <option value="Trivandrum">Trivandrum</option>        <option value="Trichy">Trichy</option>        <option value="Vadodara">Vadodara</option>        <option value="Vishakapatanam">Vishakapatanam</option> </select>      (Multiple Select)</td>  </tr>  <tr>     <td>Other City</td>    <td><input type="text" name="Other_City" id="Other_City"  onChange="return getConflictSet();">      Comma Seperated</td>  </tr>  <tr>     <td>Employment Status</td>    <td><select size="1" name="Employment_Status">        <option value="0" selected>Please select</option>        <option  value="1">Salaried</option>        <option value="0">Self Employed</option>      </select> </td>  </tr>  <tr>     <td>Minimum Age</td>    <td><input type="text" name="Minimum_Age"></td>  </tr>  <tr>     <td>Maximum Age</td>    <td><input type="text" name="Maximum_Age"></td>  </tr>  <tr>     <td>IsValid (SMS)</td>    <td><select size="1" name="Is_Valid">        <option value="0" selected>Please select</option>        <option  value="1">Yes</option>        <option value="0">No</option>      </select> </td>  </tr>  <tr>     <td>PinCodes</td>    <td><input type="text" name="Pincodes">      Can Be Comma Seperated</td>  </tr>  <tr>     <td>PanCard</td>    <td><select size="1" name="Pancard">        <option value="0" selected>Please select</option>        <option  value="Yes">Yes</option>        <option value="No">No</option>      </select> </td>  </tr>  <tr>     <td>Credit Card Holder</td>    <td><select size="1" name="CC_Holder">        <option value="0" selected>Please select</option>        <option  value="Yes">Yes</option>        <option value="No">No</option>      </select> </td>  </tr>  <tr>     <td>Credit Card Vintage</td>    <td><select size="1" class="style4" name="CC_Vintage">        <option value="0">Please select</option>        <option value="1">Less than 6 months</option>        <option value="2">6 to 9 months</option>        <option value="3">9 to 12 months</option>        <option value="4">more than 12 months</option>      </select> </td>  </tr>  <tr>     <td>Net Salary</td>    <td>Min <input type="text" name="min_NetSalary" id="min_NetSalary"> Max <input type="text" name="max_NetSalary" id="max_NetSalary"></td>  </tr>  <tr>     <td>Any other Condition</td>    <td> <textarea name="MiscConditions" cols="30" rows="3"></textarea> </td>  </tr></table>';
	}
	else if(document.BidderInsert.Reply_type.value=="5")
	{
		ni.innerHTML = '<table width="75%" border="0" align="left"><tr><td colspan="2"><strong>Conditions on which Leads to be distributed</strong></td></tr><tr><td>City</td><td><select size="4" align="left" name="City[]" id="City" multiple  onChange="return getConflictSet();"><option value="Please Select">Please Select</option><option value="Mumbai,Navi Mumbai,Thane">Mumbai Total</option><option value="Delhi,Noida,Gurgaon,Gaziabad,Sahibabad,Greater Noida">Delhi Total</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option>  <option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option>        <option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option>        <option value="Mangalore">Mangalore</option>        <option value="Mysore">Mysore</option>        <option value="Mumbai">Mumbai</option>        <option value="Nagpur">Nagpur</option>        <option value="Nasik">Nasik</option>        <option value="Navi Mumbai">Navi Mumbai</option>        <option value="Noida">Noida</option>        <option value="Patna">Patna</option>        <option value="Pune">Pune</option>        <option value="Ranchi">Ranchi</option>        <option value="Sahibabad">Sahibabad</option>        <option value="Surat">Surat</option>        <option value="Thane">Thane</option>        <option value="Thiruvananthapuram">Thiruvananthapuram</option>        <option value="Trivandrum">Trivandrum</option>        <option value="Trichy">Trichy</option>        <option value="Vadodara">Vadodara</option>        <option value="Vishakapatanam">Vishakapatanam</option> </select>      (Multiple Select)</td>  </tr>  <tr>     <td>Other City</td>    <td><input type="text" name="Other_City" id="Other_City"  onChange="return getConflictSet();" >      Comma Seperated</td>  </tr><tr><td>Minimum Age</td>    <td><input type="text" name="Minimum_Age"></td>  </tr>  <tr>     <td>Maximum Age</td>    <td><input type="text" name="Maximum_Age"></td>  </tr>  <tr>     <td>IsValid (SMS)</td>    <td><select size="1" name="Is_Valid">        <option value="0" selected>Please select</option>        <option  value="1">Yes</option>        <option value="0">No</option>      </select> </td>  </tr>  <tr>     <td>Loan Amount</td><td><input type="text" name="Loan_Amount"></td>  </tr>  <tr>     <td>Market Value of property</td>    <td><input type="text" name="Property_Value"></td>  </tr>  <tr>     <td>Any other Condition</td>    <td> <textarea name="MiscConditions" cols="30" rows="3"></textarea> </td>  </tr></table>';
	}
	else if(document.BidderInsert.Reply_type.value=="6")
	{
		ni.innerHTML = '<table width="75%" border="0" align="left"><tr><td colspan="2"><strong>Conditions on which Leads to be distributed</strong></td></tr><tr><td>City</td><td><select size="4" align="left" name="City[]" id="City" multiple  onChange="return getConflictSet();"><option value="Please Select">Please Select</option><option value="Mumbai,Navi Mumbai,Thane">Mumbai Total</option><option value="Delhi,Noida,Gurgaon,Gaziabad,Sahibabad,Greater Noida">Delhi Total</option><option value="Ahmedabad">Ahmedabad</option><option value="Aurangabad">Aurangabad</option><option value="Bangalore">Bangalore</option><option value="Baroda">Baroda</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Delhi">Delhi</option>  <option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Hyderabad">Hyderabad</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jaipur">Jaipur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kanpur">Kanpur</option><option value="Kochi">Kochi</option><option value="Kolkata">Kolkata</option>        <option value="Lucknow">Lucknow</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option>        <option value="Mangalore">Mangalore</option>        <option value="Mysore">Mysore</option>        <option value="Mumbai">Mumbai</option>        <option value="Nagpur">Nagpur</option>        <option value="Nasik">Nasik</option>        <option value="Navi Mumbai">Navi Mumbai</option>        <option value="Noida">Noida</option>        <option value="Patna">Patna</option>        <option value="Pune">Pune</option>        <option value="Ranchi">Ranchi</option>        <option value="Sahibabad">Sahibabad</option>        <option value="Surat">Surat</option>        <option value="Thane">Thane</option>        <option value="Thiruvananthapuram">Thiruvananthapuram</option>        <option value="Trivandrum">Trivandrum</option>        <option value="Trichy">Trichy</option>        <option value="Vadodara">Vadodara</option>        <option value="Vishakapatanam">Vishakapatanam</option>  </select>      (Multiple Select)</td>  </tr>  <tr>     <td>Other City</td>    <td><input type="text" name="Other_City" id="Other_City"  onChange="return getConflictSet();">      Comma Seperated</td>  </tr> <tr>     <td>Employment Status</td>    <td><select size="1" name="Employment_Status">        <option value="0" selected>Please select</option>        <option  value="1">Salaried</option>        <option value="0">Self Employed</option>      </select> </td>  </tr>  <tr>     <td>Minimum Age</td>    <td><input type="text" name="Minimum_Age"></td>  </tr>  <tr>     <td>Maximum Age</td>    <td><input type="text" name="Maximum_Age"></td>  </tr>  <tr>     <td>IsValid (SMS)</td>    <td><select size="1" name="Is_Valid">        <option value="0" selected>Please select</option>        <option  value="1">Yes</option>        <option value="0">No</option>      </select> </td>  </tr>  <tr>     <td>Loan Amount</td>    <td><input type="text" name="Loan_Amount"></td>  </tr>  <tr>     <td>Any Loan Running</td>    <td><select size="1" name="LoanRunning">        <option value="0" selected>Please select</option>        <option  value="Yes">Yes</option>        <option value="No">No</option>      </select></td>  </tr>  <tr>     <td>How many Emis Paid</td>    <td><input type="text" name="EMI_Paid"></td>  </tr>  <tr>     <td>Credit Card Holder</td>    <td><select size="1" name="CC_Holder">        <option value="0" selected>Please select</option>        <option  value="Yes">Yes</option>        <option value="No">No</option>      </select> </td>  </tr>  <tr>     <td>Credit Card Limit</td>    <td><input type="text" name="CC_Limit"></td>  </tr>  <tr>     <td>Net Salary</td>    <td><input type="text" name="NetSalary"></td>  </tr>  <tr>     <td>Any other Condition</td>    <td> <textarea name="MiscConditions" cols="30" rows="3"></textarea> </td>  </tr></table>';
	}
	else
	{
		ni.innerHTML = ' ' ;
	}
	return true;
}
</script>
<script Language="javaScript">
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
function check_list(Form)
{
var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();

var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(Form.bank_name.selectedIndex==0)
	{
		alert("Please enter Bank Name to Continue");
		Form.bank_name.focus();
		return false;
	}
	if(Form.Reply_type.selectedIndex==0)
	{
		alert("Please enter Product Type to Continue");
		Form.Reply_type.focus();
		return false;
	}	

	if(Form.Bidder_Name.value=="")
	{
		alert('Please enter Bidder Name');
		Form.Bidder_Name.focus();
		return false;
	}

	if(Form.email_id.value!="")
	{
		if (!validmail(Form.email_id.value))
		{
			//alert("Please enter your valid email address!");
			Form.email_id.focus();
			return false;
		}
	}
	if(Form.Address.value=="")
	{
		alert('Please enter Address');
		Form.Address.focus();
		return false;
	}


if((Form.Contact_Number.value=='Mobile') || (Form.Contact_Number.value=='') || Trim(Form.Contact_Number.value)==false)
{
alert("Kindly fill in your Mobile Number!");
Form.Contact_Number.focus();
return false;
}
 else if(isNaN(Form.Contact_Number.value)|| Form.Contact_Number.value.indexOf(" ")!=-1)
		{
              alert("Enter numeric value");
			  Form.Contact_Number.focus();
			  return false;  
		}
        else if (Form.Contact_Number.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 Form.Contact_Number.focus();
				return false;
        }
 else if (Form.Contact_Number.value.charAt(0)!="9" && Form.Contact_Number.value.charAt(0)!="8")
		{
                alert("Should start with 9 or 8!");
				 Form.Contact_Number.focus();
                return false;
		}




}
</script>


</head>
<body>
	<table width="669" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#45B2D8">
      <tr>
          <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; color:#052733; line-height:18px; font-weight:bold;">Create Bidder</td>
      </tr>
				<tr>
    
	      <td  class="blktxt" style="padding-top:5px;" align="left" valign="top" >
		<form name="BidderInsert" action="create-bidder.php" method="post" onsubmit="return check_list(document.BidderInsert);" >
		<table cellpadding="2" cellspacing="4" style="border:1px solid #2187c1;" width="100%" bgcolor="#FFFFFF">
		<tr><td>Bank</td><td>
		<select name="bank_name" id="bank_name" onChange="return getConflictSet();">
		<option value="">Please Select</option>
		<?php 
		$getBanksql = "select * from Bank_Master order by Bank_Name asc";
		$getBankquery = ExecQuery($getBanksql);
		$numRows = mysql_num_rows($getBankquery);
		for($i=0;$i<$numRows;$i++)
		{
			$BankID = mysql_result($getBankquery,$i,'BankID');
			$Bank_Name = mysql_result($getBankquery,$i,'Bank_Name');
			if(strlen($Bank_Name)>0)
			{
			echo "<option value=".$BankID.">".$Bank_Name."</option>";
			}
		}
		?>
		</select>
		</td></tr>
		<tr><td>Product</td><td><select style="width:138px;" name="Reply_type" id="Reply_type" onChange="return addCondition();">
	  <option value="0">Please select</option>
	  <option value="1">Personal Loan</option>
	   <option value="2">Home Loan</option>
	  <option value="3">Car loan</option>
	   <option value="5">Loan against Property</option>
	   <option value="4">Credit Card</option>
	  <!--<option value="6">Business Loan</option>-->
	 </select></td></tr>
		<tr><td>Bidder Name</td><td><input type="text" name="Bidder_Name" id="Bidder_Name" /></td></tr>
		<tr><td>Email ID</td><td><input type="text" name="email_id" id="email_id" /></td></tr>
		<tr> 
      <td>Address</td>
      <td><textarea name="Address" id="Address" cols="30" rows="3"></textarea>
      </td>
    </tr>
    <tr> 
      <td>Contact Number</td>
      <td><input type="text" name="Contact_Number" id="Contact_Number" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);"></td>
    </tr>
	<tr> 
      <td>Activate SMS</td>
      <td><input type="checkbox" name="activate_sms" id="activate_sms" value="1" checked></td>
    </tr>
	    <tr> 
      <td>2 way sms Functionality</td>
      <td><input type="checkbox" name="sms_two_way" id="sms_two_way" value="1" onclick="addSMSElement();" ></td>
    </tr>
	<tr>
              <td colspan="2" class="frmtxt" id="smsDiv" ></td>
            </tr>
    <tr> 
      <td>Joined Date</td>
      <td>
	 	 <input type="hidden" name="Join_Date" value="<?php echo date("Y-m-d"); ?>">Assuming Today(Or Mention in the Description Below) </td>
    </tr>
	  <tr> 
      <td>Define CAP </td>
      <td>
	 	Daily <input type="text" name="Daily" id="Daily" size="4" /> Weekly <input type="text" name="Weekly" id="Weekly" size="4" />
		 Monthly <input type="text" name="Monthly" id="Monthly" size="4" /> Yearly <input type="text" name="Yearly" id="Yearly" size="4" />
		 </td>
    </tr>
	 <tr> 
      <td>Business Manager</td>
      <td>
	 	<select name="business_manager" id="business_manager">
		<option value="">Please Select</option>
		<?php 
		$getBdsql = "select * from BD_List order by BD_Manager asc";
		$getBdquery = ExecQuery($getBdsql);
		$numdRows = mysql_num_rows($getBdquery);
		for($i=0;$i<$numdRows;$i++)
		{
			$BdID = mysql_result($getBdquery,$i,'BD_ID');
			$Bd_Name = mysql_result($getBdquery,$i,'BD_Manager');
			echo "<option value=".$BdID.">".$Bd_Name."</option>";
		}
		?>
		</select>
	  </td>
    </tr>
	<tr> 
      <td>Cost</td>
      <td>
	 	<input type="text" name="lead_cost" id="lead_cost" size="8" />
	  </td>
    </tr>
	 <tr> 
      <td>Type of </td>
      <td>
	 	<select name="type_of" id="type_of">
		<option value="PrePaid">PrePaid</option>
		<option value="PostPaid">PostPaid</option>
		</select> 
	  </td>
    </tr>
	 <tr><td colspan="2" id="MyDiv" > </td></tr>
	  <tr><td colspan="2" ><div id="MyDivConflict"></div></td></tr>
		<tr><td>&nbsp;</td><td><input type="submit" name="submit" value="Save..." /></td></tr>
		</table>
	    </form>
	  </td>
	  </tr>
 </table>
</body>
</html>
