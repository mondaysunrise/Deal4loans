<?php
	require 'scripts/session_check_online.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	$Msg = "";
	//echo "UserID =".$UserID;
	if($_SESSION['Temp_Flag'] = "1")
	{
	if (($_SESSION['Temp_Type'])=="PersonalLoan")
	{
		$UName = $_SESSION['UName'];
		$Name = $_SESSION['Temp_Name'];
		$UserID = $_SESSION['Temp_UserID'];
		$Email = $_SESSION['Temp_Email'];
		$Employment_Status = $_SESSION['Temp_Employment_Status'];
		$Company_Name = $_SESSION['Temp_Company_Name'];
		$City = $_SESSION['Temp_City'];
		$City_Other = $_SESSION['Temp_City_Other'];
		$Years_In_Company = $_SESSION['Temp_Years_In_Company'];
		$Total_Experience = $_SESSION['Temp_Total_Experience'];
		$Net_Salary = $_SESSION['Temp_Net_Salary'];
		$Marital_Status = $_SESSION['Temp_Marital_Status'];
		$Residential_Status = $_SESSION['Temp_Residential_Status'];
		$Vehicles_Owned = $_SESSION['Temp_Vehicles_Owned'];
		$Loan_Any = $_SESSION['Temp_Loan_Any'];
		$EMI_Paid = $_SESSION['Temp_EMI_Paid'];
		$CC_Holder = $_SESSION['Temp_CC_Holder'];
		$Loan_Amount = $_SESSION['Temp_Loan_Amount'];
		$Net_Salary_Monthly = $_SESSION['Temp_Net_Salary_Monthly'];
		
		$sql = "INSERT INTO Req_Loan_Personal (UserID, Employment_Status, Company_Name, City, City_Other, Years_In_Company, Total_Experience, Net_Salary, Marital_Status, Residential_Status, Vehicles_Owned, Loan_Any, EMI_Paid, CC_Holder, Loan_Amount, Count_Views, Count_Replies, IsModified, IsProcessed, Dated)
		VALUES ( '$UserID', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Years_In_Company', '$Total_Experience', '$Net_Salary', '$Marital_Status', '$Residential_Status', '$Vehicles_Owned', '$Loan_Any', '$EMI_Paid', '$CC_Holder', '$Loan_Amount', 0, 0, 0, 0, Now() )";

		$result = ExecQuery($sql);
		if ($result == 1)
		{
		$sqltest = ExecQuery("Select RequestID from Req_Loan_Personal order by RequestID desc limit 1");
		echo mysql_error();
		if ($myrow = mysql_fetch_array($sqltest)) 
		{
			$Item_ID = $myrow["RequestID"];
		}
		mysql_free_result($sqltest);
		
		$Message = "<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='450' id='AutoNumber1'><tr><td bgcolor='#EEF0E3'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2'><tr><td width='100%' bgcolor='#DEE3CD'><p><font face='Arial' size='2'>Dear $UName,<br>Thanks for using Deal4loans.com for your Personal Loan requirement</font></p><p><font face='Arial' size='2'><b>E-Quote</b> from Neha,<br><b>Associated Bank:</b> Citifinancial</font></p><p><b><font face='Arial' size='2'>Documents Required:</font></b></p><p><font face='Arial' size='2'><b>Other Comments:</b> As per your request for Loans, we would like to introduce ourselves. We represent Citifinancial which is a Citigroup company. Citifinancial Personal loan stands for 72 hrs dispersal time, minimum documents, no guarantors and in all the most hassle free Personal loan in the market.</font></p><p><font face='Arial' size='2'>Our product is designed to suite needs of both Salaried/ Self employed .To give you the best rates we would like that you either call us or give us your contact number so that we can give you the best detail.</font></p><p><font face='Arial' size='2'>With the information provided by you we would still send you a quote with rates and the papers required in next 8 hrs.</font></p><p><font face='Arial' size='2'>Thanking you.</font></p><p><font face='Arial' size='2'>Neha,<br>Citifinancial India<br>22373348 / 9899802807</font></p><p><font face='Arial' size='2'>Assuring you of our Best Service<br><b>Team <a href='http://www.deal4loans.com'>deal4loans.com</a></b> </font></p><form name='frm_deal4loans' method='post' action='http://www.deal4loans.com/reply_email.php'><input type='hidden' name='Reply_Type' value='1'><input type='hidden' name='PostedBy' value='2'><input type='hidden' name='UserID' value='$UserID'><input type='hidden' name='type' value='$type'><input type='hidden' name='RequestID' value='$Item_ID'><input type='hidden' name='BidderID' value='11'><input type='hidden' name='ifbidder' value='possitive'><p align='center'><b><textarea rows='4' name='Message' cols='30'>Post Your Reply to this Bidder Here</textarea></b></p><p align='center'><input type='submit' value='Submit'></p></form></td></tr></table></td></tr></table>";
				
		$Message1 = "<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='450' id='AutoNumber1'><tr><td bgcolor='#EEF0E3'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2'><tr><td width='100%' bgcolor='#DEE3CD'><p><font face='Arial' size='2'>Dear $UName,<br>Thanks for using Deal4loans.com for your Personal Loan requirement</font></p><p><font face='Arial' size='2'><b>E-Quote</b> from Shristy,<br><b>Associated Bank:</b> Citibank</font></p><p><b><font face='Arial' size='2'>Documents Required:</font></b></p><p><font face='Arial' size='2'><b>Other Comments:</b> As per your request for Loans, we would like to introduce ourselves. We represent Citibank N.A. which is the biggest bank in the world. In India also we are the biggest MNC Bank in the retail sector. Citibank personal loan stands for 72 hrs dispersal time, minimum documents, no guarantors and in all the most hassle free Personal loan in the market.</font></p><p><font face='Arial' size='2'>Our product is designed to suite needs of both Salaried/ Self employed .To give you the best rates we would like that you either call us or give us your contact number so that we can give you the best detail.</font></p><p><font face='Arial' size='2'>With the information provided by you we would still send you a quote with rates and the papers required in next 8 hrs.</font></p><p><font face='Arial' size='2'>Thanking you.</font></p><p><font face='Arial' size='2'>Shristy,<br>Citibank Internet Team<br>9899405626</font></p><p><font face='Arial' size='2'>Assuring you of our Best Service<br><b>Team <a href='http://www.deal4loans.com'>deal4loans.com</a></b> </font></p><form name='frm_deal4loans' method='post' action='http://www.deal4loans.com/reply_email.php'><input type='hidden' name='Reply_Type' value='1'><input type='hidden' name='PostedBy' value='2'><input type='hidden' name='UserID' value='$UserID'><input type='hidden' name='type' value='$type'><input type='hidden' name='RequestID' value='$Item_ID'><input type='hidden' name='BidderID' value='10'><input type='hidden' name='ifbidder' value='possitive'><p align='center'><b><textarea rows='4' name='Message' cols='30'>Post Your Reply to this Bidder Here</textarea></b></p><p align='center'><input type='submit' value='Submit'></p></form></td></tr></table></td></tr></table>";
/*
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: '.$UName.' <'.$Email.'>' . "\r\n";
		$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
*/
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		if($Net_Salary_Monthly > 10000)
		mail($Email,'Bidder Reply For Your Request', $Message1, $headers);
		else
		{
		mail($Email,'Bidder Reply For Your Request', $Message, $headers);
		}
		}

		unset($_SESSION['Temp_Name']);
		unset($_SESSION['Temp_UserID']);
		unset($_SESSION['Temp_Email']);
		unset($_SESSION['Temp_Employment_Status']);
		unset($_SESSION['Temp_Company_Name']);
		unset($_SESSION['Temp_City']);
		unset($_SESSION['Temp_City_Other']);
		unset($_SESSION['Temp_Years_In_Company']);
		unset($_SESSION['Temp_Total_Experience']);
		unset($_SESSION['Temp_Net_Salary']);
		unset($_SESSION['Temp_Marital_Status']);
		unset($_SESSION['Temp_Residential_Status']);
		unset($_SESSION['Temp_Vehicles_Owned']);
		unset($_SESSION['Temp_Loan_Any']);
		unset($_SESSION['Temp_EMI_Paid']);
		unset($_SESSION['Temp_CC_Holder']);
		unset($_SESSION['Temp_Loan_Amount']);
	
		}

	if (($_SESSION['Temp_Type'])=="HomeLoan")
	{
		$Name = $_SESSION['Temp_Name'];
		$UserID = $_SESSION['Temp_UserID'];
		$Email = $_SESSION['Temp_Email'];
		$Employment_Status = $_SESSION['Temp_Employment_Status'];
		$Company_Name = $_SESSION['Temp_Company_Name'];
		$City = $_SESSION['Temp_City'];
		$City_Other = $_SESSION['Temp_City_Other'];
		$Total_Experience = $_SESSION['Temp_Total_Experience'];
		$Net_Salary = $_SESSION['Temp_Net_Salary'];
		$Property_Type = $_SESSION['Temp_Property_Type'];
		$Property_Value = $_SESSION['Temp_Property_Value'];
		$Loan_Amount = $_SESSION['Temp_Loan_Amount'];
		$Descr = $_SESSION['Temp_Descr'];
		unset($_SESSION['Temp_Name']);
		unset($_SESSION['Temp_UserID']);
		unset($_SESSION['Temp_Email']);
		unset($_SESSION['Temp_Employment_Status']);
		unset($_SESSION['Temp_Company_Name']);
		unset($_SESSION['Temp_City']);
		unset($_SESSION['Temp_City_Other']);
		unset($_SESSION['Temp_Total_Experience']);
		unset($_SESSION['Temp_Net_Salary']);
		unset($_SESSION['Temp_Property_Type']);
		unset($_SESSION['Temp_Loan_Amount']);
		unset($_SESSION['Temp_Descr']);

		$sql = "INSERT INTO Req_Loan_Home (UserID, Employment_Status, Company_Name, City, City_Other, Total_Experience, Net_Salary, Property_Type, Property_Value, Loan_Amount, Descr, Count_Views, Count_Replies, IsModified, IsProcessed, Dated)
		VALUES ( '$UserID', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Total_Experience', '$Net_Salary', '$Property_Type', '$Property_Value', '$Loan_Amount', '$Descr', 0, 0, 0, 0, Now() )";
		
		$result = ExecQuery($sql);
	}

	if (($_SESSION['Temp_Type'])=="PropertyLoan")
	{
		$Name = $_SESSION['Temp_Name'];
		$UserID = $_SESSION['Temp_UserID'];
		$Email = $_SESSION['Temp_Email'];
		$Employment_Status = $_SESSION['Temp_Employment_Status'];
		$Company_Name = $_SESSION['Temp_Company_Name'];
		$City = $_SESSION['Temp_City'];
		$City_Other = $_SESSION['Temp_City_Other'];
		$Total_Experience = $_SESSION['Temp_Total_Experience'];
		$Net_Salary = $_SESSION['Temp_Net_Salary'];
		$Residential_Status = $_SESSION['Temp_Residential_Status'];
		$Property_Type = $_SESSION['Temp_Property_Type'];
		$Property_Value = $_SESSION['Temp_Property_Value'];
		$Loan_Amount = $_SESSION['Temp_Loan_Amount'];
		$Descr = $_SESSION['Temp_Descr'];
		unset($_SESSION['Temp_Name']);
		unset($_SESSION['Temp_UserID']);
		unset($_SESSION['Temp_Email']);
		unset($_SESSION['Temp_Employment_Status']);
		unset($_SESSION['Temp_Company_Name']);
		unset($_SESSION['Temp_City']);
		unset($_SESSION['Temp_City_Other']);
		unset($_SESSION['Temp_Total_Experience']);
		unset($_SESSION['Temp_Net_Salary']);
		unset($_SESSION['Temp_Residential_Status']);
		unset($_SESSION['Temp_Property_Type']);
		unset($_SESSION['Temp_Property_Value']);
		unset($_SESSION['Temp_Loan_Amount']);
		unset($_SESSION['Temp_Descr']);

		$sql = "INSERT INTO Req_Loan_Against_Property (UserID, Employment_Status, Company_Name, City, City_Other, Total_Experience, Net_Salary, Residential_Status, Property_Type, Property_Value, Loan_Amount, Descr, Count_Views, Count_Replies, IsModified, IsProcessed, Dated)
		VALUES ( '$UserID', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Total_Experience', '$Net_Salary', '$Residential_Status', '$Property_Type', '$Property_Value', '$Loan_Amount', '$Descr', 0, 0, 0, 0, Now() )";
		$result = ExecQuery($sql);
	}

	if (($_SESSION['Temp_Type'])=="CarLoan")
	{
		$Name = $_SESSION['Temp_Name'];
		$UserID = $_SESSION['Temp_UserID'];
		$Email = $_SESSION['Temp_Email'];
		$Employment_Status = $_SESSION['Temp_Employment_Status'];
		$Company_Name = $_SESSION['Temp_Company_Name'];
		$City = $_SESSION['Temp_City'];
		$City_Other = $_SESSION['Temp_City_Other'];
		$Net_Salary = $_SESSION['Temp_Net_Salary'];
		$Car_Make = $_SESSION['Temp_Car_Make'];
		$Car_Model = $_SESSION['Temp_Car_Model'];
		$Car_Type = $_SESSION['Temp_Car_Type'];
		$Loan_Tenure = $_SESSION['Temp_Loan_Tenure'];
		$Loan_Amount = $_SESSION['Temp_Loan_Amount'];
		$Descr = $_SESSION['Temp_Descr'];
		unset($_SESSION['Temp_Name']);
		unset($_SESSION['Temp_UserID']);
		unset($_SESSION['Temp_Email']);
		unset($_SESSION['Temp_Employment_Status']);
		unset($_SESSION['Temp_Company_Name']);
		unset($_SESSION['Temp_City']);
		unset($_SESSION['Temp_City_Other']);
		unset($_SESSION['Temp_Net_Salary']);
		unset($_SESSION['Temp_Car_Make']);
		unset($_SESSION['Temp_Car_Model']);
		unset($_SESSION['Temp_Car_Type']);
		unset($_SESSION['Temp_Loan_Tenure']);
		unset($_SESSION['Temp_Loan_Amount']);
		unset($_SESSION['Temp_Descr']);

		$sql = "INSERT INTO Req_Loan_Car (UserID, Employment_Status, Company_Name, City, City_Other, Net_Salary, Car_Make, Car_Model, Car_Type, Loan_Tenure, Loan_Amount, Descr, Count_Views, Count_Replies, IsModified, IsProcessed, Dated)
		VALUES ( '$UserID', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Net_Salary', '$Car_Make','$Car_Model', '$Car_Type', '$Loan_Tenure','$Loan_Amount', '$Descr', 0, 0, 0, 0, Now() )";
		
		$result = ExecQuery($sql);
	}

	if (($_SESSION['Temp_Type'])=="CreditCard")
	{
		$Name = $_SESSION['Temp_Name'];
		$UserID = $_SESSION['Temp_UserID'];
		$Email = $_SESSION['Temp_Email'];
		$Employment_Status = $_SESSION['Temp_Employment_Status'];
		$Company_Name = $_SESSION['Temp_Company_Name'];
		$City = $_SESSION['Temp_City'];
		$City_Other = $_SESSION['Temp_City_Other'];
		$Total_Experience = $_SESSION['Temp_Total_Experience'];
		$Net_Salary = $_SESSION['Temp_Net_Salary'];
		$Vehicles_Owned = $_SESSION['Temp_Vehicles_Owned'];
		$CC_Holder = $_SESSION['Temp_CC_Holder'];
		$Descr = $_SESSION['Temp_Descr'];
		$Item_ID = $_SESSION['Temp_Item_ID'];
		
		$sql = "INSERT INTO Req_Credit_Card (UserID, Employment_Status, Company_Name, City, City_Other, Total_Experience, Net_Salary, Vehicles_Owned, CC_Holder, Descr, Count_Views, Count_Replies, IsModified, IsProcessed, Dated)
		VALUES ( '$UserID', '$Employment_Status', '$Company_Name', '$City', '$City_Other', '$Total_Experience', '$Net_Salary', '$Vehicles_Owned', '$CC_Holder', '$Descr', 0, 0, 0, 0, Now() )";
		
		$result = ExecQuery($sql);
		if ($result == 1)
		{
			$sqltest = ExecQuery("Select RequestID from Req_Credit_Card order by RequestID desc limit 1");
			echo mysql_error();
			if ($myrow = mysql_fetch_array($sqltest)) 
			{
				$Item_ID = $myrow["RequestID"];
			}
		mysql_free_result($sqltest);

		$Message = "<table border='0' cellpadding='4' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='450' id='AutoNumber1'><tr><td bgcolor='#EEF0E3'><table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' bordercolor='#111111' width='100%' id='AutoNumber2'><tr><td width='100%' bgcolor='#DEE3CD'><p><font face='Arial' size='2'>Dear $Name,<br>Thanks for using Deal4loans.com for your Credit Card requirement</font></p><p><font face='Arial' size='2'><b>E-Quote</b> from Manish,<br><b>Associated Bank:</b> Citibank</font></p><p><b><font face='Arial' size='2'>Documents Required:</font></b></p><p><font face='Arial' size='2'><b>Other Comments:</b> As per your request for Credit Card, we would like to introduce ourselves. We represent Citibank N.A. which is the biggest bank in the world. In India also we are the biggest MNC Bank in the retail sector. Citibank Credit cards is absolutely free for life and has so many other features to suite your needs. With our reward points schemes and other offers we not only provide services but save while you spend.</font></p><p><font face='Arial' size='2'>Citibank has no many Co branded credit cards which would help you to choose what kind of product you are looking in the market.</font></p><p><font face='Arial' size='2'>Our product is designed to suite needs of both Salaried / Self employed .To give you more information of the product and the papers required we would like you to call us or reply by your contact number.</font></p><p><font face='Arial' size='2'>With the information provided by you we would still send you a quote with and the papers required in next 4 hrs.</font></p><p><font face='Arial' size='2'>Thanking you.</font></p><p><font face='Arial' size='2'>Manish,<br>Citibank Credit Card Internet Team<br>9873315900</font></p><p><font face='Arial' size='2'>Assuring you of our Best Service<br><b>Team <a href='http://www.deal4loans.com'>deal4loans.com</a></b> </font></p><form name='frm_deal4loans' method='post' action='http://www.deal4loans.com/reply_email.php'><input type='hidden' name='Reply_Type' value='4'><input type='hidden' name='PostedBy' value='2'><input type='hidden' name='UserID' value='$UserID'><input type='hidden' name='type' value='$type'><input type='hidden' name='RequestID' value='$Item_ID'><input type='hidden' name='BidderID' value='9'><input type='hidden' name='ifbidder' value='possitive'><p align='center'><b><textarea rows='4' name='Message' cols='30'>Post Your Reply to this Bidder Here</textarea></b></p><p align='center'><input type='submit' value='Submit'></p></form></td></tr></table></td></tr></table>";
/*
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'To: '.$Name.' <'.$Email.'>' . "\r\n";
		$headers .= 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
*/
		$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
		$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		mail($Email,'Bidder Reply For Your Request', $Message, $headers);
		}

		unset($_SESSION['Temp_Name']);
		unset($_SESSION['Temp_UserID']);
		unset($_SESSION['Temp_Email']);
		unset($_SESSION['Temp_Employment_Status']);
		unset($_SESSION['Temp_Company_Name']);
		unset($_SESSION['Temp_City']);
		unset($_SESSION['Temp_City_Other']);
		unset($_SESSION['Temp_Total_Experience']);
		unset($_SESSION['Temp_Net_Salary']);
		unset($_SESSION['Temp_Vehicles_Owned']);
		unset($_SESSION['Temp_CC_Holder']);
		unset($_SESSION['Temp_Descr']);
		unset($_SESSION['Item_ID']);

	}
	}


	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
		unset($_SESSION['Temp_Type']);
		foreach($_GET as $a=>$b)
			$$a=$b;
		
		if(isset($view)){
			$result = ExecQuery("UPDATE Req_$ReqType SET IsModified='0' WHERE RequestID=$RequestID");
	    		echo mysql_error();
		}

		$UserID = $_SESSION['UserID'];

	}
   function getRequest($table, $extraCols, $UserID, $type){
	$GridData = "";
	$i = 0;
	///////////////////////////////////////
	
	////////////////////////////////////////
	//Execute Query
	$result = ExecQuery("Select RequestID, UserID, $extraCols, Count_Replies, IsProcessed, Count_Views, Dated From Req_$table Where UserID='$UserID' Order By Dated DESC");
	echo mysql_error();

	if ($myrow = mysql_fetch_array($result)) {
	   do{
		$RequestID=$myrow["RequestID"];
		$UserID=$myrow["UserID"];
		$Loan_Amount=$myrow["Loan_Amount"];
		$Count_Replies=$myrow["Count_Replies"];
		$IsProcessed=$myrow["IsProcessed"];
		$Count_Views=$myrow["Count_Views"];
		$Dated=$myrow["Dated"];

		$sql = ExecQuery("Select *  from Req_$table where RequestID='".$RequestID."'");
		echo mysql_error();
		if ($row = mysql_fetch_array($sql)) 
		{
			$IsModified=$row["IsModified"];

		}
		mysql_free_result($sql);

		$GridData .= "<tr  id=row".getRowID($i++).">";
		$GridData .= "<td><input class=NoBrdr type=radio name=radioID value='RequestID=$RequestID&UserID=$UserID&Reply_Type=$type' onClick='setValue(this.value)'></td>"; 
		$GridData .= "<td>$i</td>";
		$GridData .= "<td id=right>$RequestID</td>";
		$GridData .= "<td id=right>$Loan_Amount</td>"; 
		$GridData .= "<td>".getYesNo($IsProcessed)."</td>";
		$GridData .= "<td>$Count_Replies".getimage($IsModified)."</td>";
		$GridData .= "<td>".substr($Dated,0,16)."</td>"; 
		$GridData .= "</tr>"; 

	    }while ($myrow = mysql_fetch_array($result));

	mysql_free_result($result);
	}
	return 	$GridData;
   }

   function getRequests($table, $title, $ColName, $extraCols, $UserID, $type){

        echo '<table border="1" cellpadding="0" cellspacing="0" width="99%" style="border-collapse: collapse" bordercolor="#000000">
	 <caption>'.$title.' Requests</Caption>
         <tr>
           <td width="100%" align="center">
            <table border="0" cellpadding="0" cellspacing="1" width="100%" id="Grid">
             <tr id="HD">
		<td width="%"></td>
		<td width="%">##</td>
		<td width="%">Request ID</td>
		<td width="%">'.$ColName.'</td>
		<td width="%">Is Processed</td>
		<td width="17%">Replies</td>
		<td width="%">Dated</td>
            </tr>
            <tr><td class="Brdr" colspan="10"></td></tr>';

	echo getRequest($table, $extraCols, $UserID, $type);

        echo '</table>
        </td>
       </tr>
      </table>
	<Div align=left><input type=button id="grad" value="View Replies" onClick="return setAction(\'view\',\''.$table.'\');"> <input type=button id="grad" value="Edit" onClick="return setAction(\'edit\',\''.$table.'\');"></Div>
	';
   }
?>

<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="Description" content="Welcome to Deal4Loans">
<meta name="keywords" content="Best Personal Loans in India, Best Loan Quotes in India, Compare Loans in India, Compare Home Loans in India, Compare Home in India, Compare Car loans in India, Car Loans, Compare Personal loans in India, Personal , Compare Credit Cards in India, Compare Loans Against Property in India">
<meta http-equiv="refresh" content="900">
<title>Welcome to Deal4Loans</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<!--<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">-->

<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
//-->
</script>
<?php include '~Top.php'; ?>


<div id="dvMainbanner">
   <?php include '~Upper.php';?>

    <div id="dvbannerContainer"> <img src="images/main_banner1.gif"  /> </div>
  </div>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
<div id="dvContentPanel">
<div id="dvMaincontent">
<table border="0" cellspacing="1" width="520" cellpadding="0">
   <tr>
     <td width="202" align="left" valign="top" bgcolor="">
 <?php if(isset($_SESSION['UserType']))
	{
	include '~Left.php';
	}
	
?>
</td></tr></table>

    </div>
</div>  
	  <?php include '~Bottom.php';?>  
	  </div>
</body>
</html>