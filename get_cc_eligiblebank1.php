<?php
//ob_start();
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'getlistofeligiblebidders.php';
	error_reporting();
	$page_Name = "LandingPage_PL";

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
	foreach($_POST as $a=>$b)
			$$a=$b;

	$UserID = $_SESSION['UserID'];
		$Full_Name = FixString($Full_Name);
		//$LName = FixString($LName);
		$Name= $Full_Name;
		$Email = FixString($Email);
		$Phone = FixString($Phone);
		$Pancard = FixString($Pancard);
		$CC_Holder = FixString($CC_Holder);
		$Card_Vintage = FixString($Card_Vintage);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Company_Name = FixString($Company_Name);
		$Net_Salary =FixString($Net_Salary);
		$IsPublic =1;
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$Type_Loan = "CreditCard";
		$source = FixString($source);
		$Reference_Code = FixString($Reference_Code);
		$Employment_Status = FixString($Employment_Status);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$Referrer=$_REQUEST['referrer'];
		$source=$_REQUEST['source'];
		$Section=$_REQUEST['section'];
		$Creative=$_REQUEST['creative'];
        $Dated = ExactServerdate();
		
		
if($_SESSION=="")
		{
			$_SERVER['Temp_Type'] = "CreditCard";
			$_SERVER['Temp_Type_Loan']="Req_Credit_Card";
			$_SERVER['Temp_Name'] = $Name;
			$_SERVER['Temp_FName'] = $Name;
			$_SERVER['Temp_Phone'] = $Phone;
			$_SERVER['Temp_Pancard'] = $Pancard;
			$_SERVER['Temp_DOB'] = $DOB;
			$_SERVER['Temp_Email'] = $Email;
			$_SERVER['Temp_Company_Name'] = $Company_Name;
			$_SERVER['Temp_Employment_Status'] = $Employment_Status;
			$_SERVER['Temp_City'] = $City;
			$_SERVER['Temp_City_Other'] = $City_Other;
			$_SERVER['Temp_Net_Salary'] = $Net_Salary;
			$_SERVER['Temp_IsPublic'] = $IsPublic;
			 $_SERVER['Temp_CC_Holder'] = $CC_Holder;
			 $_SERVER['Temp_Reference_Code'] = $Reference_Code;
			 $_SERVER['Temp_Phone'] = $Phone;

		}
	else
		{
			$_SESSION['Temp_Type'] = "CreditCard";
			$_SESSION['Temp_Type_Loan']="Req_Credit_Card";
			$_SESSION['Temp_Name'] = $Name;
			$_SESSION['Temp_Pancard'] = $Pancard;
			$_SESSION['Temp_FName'] = $Name;
			$_SESSION['Temp_Phone'] = $Phone;
			$_SESSION['Temp_DOB'] = $DOB;
			$_SESSION['Temp_Employment_Status'] = $Employment_Status;
			$_SESSION['Temp_Email'] = $Email;
			$_SESSION['Temp_Company_Name'] = $Company_Name;
			$_SESSION['Temp_City'] = $City;
			$_SESSION['Temp_City_Other'] = $City_Other;
			$_SESSION['Temp_Net_Salary'] = $Net_Salary;
			$_SESSION['Temp_CC_Holder'] = $CC_Holder;
			$_SESSION['Temp_Reference_Code'] = $Reference_Code;
			$_SESSION['Temp_Phone'] = $Phone;
		}

$IP = getenv("REMOTE_ADDR");

	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		Maindeletefunc($DeleteIncompleteSql,$array = array());
	}
	
function InsertTataAig($RequestID, $ProductName)
	{
	//	echo "select Dated, City, City_Other from ".$ProductName." where RequestID = $RequestID";
		$GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		 list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;
		
		//$RowGetDate = mysql_fetch_array($GetDateSql);
		
		$TDated = $RowGetDate[$cntr]['Dated'];
		$TCity = $RowGetDate[$cntr]['City'];
		$Mobile = $RowGetDate[$cntr]['Mobile_Number'];
		$Product_Name = "4";
		
		//$Sql = "INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, `Mobile_Number`, `T_Dated` ) VALUES ('".$RequestID."', '".$Product_Name."','".$TCity."', '".$Mobile."' , Now())";
		//$query = mysql_query($Sql);
		
		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
$table = 'tataaig_leads';
$insert = Maininsertfunc ($table, $dataInsert);
		//echo "tataaig:".$Sql."<br>";
		//exit();

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
{		
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			 list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
		$cntr=0;

			
			//$CheckNumRows = mysql_num_rows($CheckQuery);
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$cntr]['UserID'];
			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "DOB"=>$DOB, "IsPublic"=>$IsPublic, "Dated"=>$Dated, " Reference_Code"=>$Reference_Code, "source"=>$source, "Pancard"=>$Pancard, "CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage, "IP_Address"=>$IP, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance);
$table = 'Req_Credit_Card';
$ProductValue = Maininsertfunc ($table, $dataInsert);
			
			}
			else
			{
		$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
		$table = 'wUsers';
		$UserID1 = Maininsertfunc ($table, $dataInsert);
  	
			$dataInsert2 = array("serID"=>$UserID1, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "DOB"=>$DOB, "IsPublic"=>$IsPublic, "Dated"=>$Dated, " Reference_Code"=>$Reference_Code, "source"=>$source, "Pancard"=>$Pancard, "CC_Holder"=>$CC_Holder, "Card_Vintage"=>$Card_Vintage, "IP_Address"=>$IP, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "Accidental_Insurance"=>$Accidental_Insurance);
$table2 = 'Req_Credit_Card';
$ProductValue = Maininsertfunc ($table2, $dataInsert2);	
				
			}
					
		
			$_SESSION['Temp_LID'] = $ProductValue;


			if($Accidental_Insurance=="1")
				{
					InsertTataAig($ProductValue, "Req_Credit_Card");
				}
			//exit();
			  if($Net_Salary>=300000)
   {
			$SMSMessage = "Thanks for your Credit Card Application.Please apply at the choices given to you .If any chance you are busy, the same offers have been sent to your email.Keep your Pan Number handy when you apply.";
					if(strlen(trim($Phone)) > 0)
					SendSMS($SMSMessage, $Phone);
   }
			}
			
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Credit Card";
			else
				$SubjectLine = "Learn to get Best Deal on Credit Card";
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
	
	

}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thank you</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script type="text/javascript" src="scripts/calendardateinput.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
  <div id="txt" style="padding-top:15px;">
  
   <?php
   $Net_Salary=500000;
   $City="Delhi";
   $Full_Name="ranjana";
//echo $Net_Salary;
   if($Net_Salary>=300000)
   {
	   
   $selectccbanks="Select * From credit_card_banks_eligibility where (cc_bank_citylist like '%".$City."%' and cc_bank_flag=1) order by cc_bank_fee ASC";
	
	 list($rowscount,$row)=MainselectfuncNew($selectccbanks,$array = array());
		

if($rowscount >0)
{
		
	?>
<div style="text-align:center; font-weight:bold; line-height:18px; padding-bottom:15px;"> Dear <?echo $Full_Name;?>,<br>
The below mentioned Credit card companies are interested in your profile as per there eligibility.<br>
Choose from the offers below and Apply  at Banks Link for  the best Credit Card as per you !!!!!<br>
The fastest and simplest way to acquire your Credit card.</div>

 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <?php
 
	
$r=0;
	while($r<count($row))
        {
	
	//echo $cc_bank_name  = $row["cc_bank_name"];
       $cc_bank_query  = $row[$r]["cc_bank_query"];
		$cc_bankid  = $row[$r]["cc_bankid"];
		$cc_bank_url  = $row[$r]["cc_bank_url"];
//		  $qry2 = $cc_bank_query." and Req_Credit_Card.RequestID ='".$ProductValue."'";
$qry2 = $cc_bank_query." and Req_Credit_Card.RequestID =227258";
		 list($recordcount,$row)=MainselectfuncNew($qry2,$array = array());
		if($recordcount>0)
		 {
		 	$i=0;
			
			$get_Bank="Select * From credit_card_banks_eligibility Where cc_bankid=".$cc_bankid." order by cc_bank_fee ASC";
			list($getrecordcount,$get_Bankresult)=MainselectfuncNew($get_Bank,$array = array());
			// echo $getrecordcount;
			 //echo "query3 ".$get_Bank."<br><br>";
  
	?>
		
			  <?
			
			  for($j=0;$j<$getrecordcount;$j++)
			  
		 { //echo "i:::  ".$i."<br>";
		 //echo "j:::  ".$getrecordcount."<br>";
			?>
  <!----------------------------->
    <td valign="top" class="crdbg"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" class="crdbhdng"><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank"><? 
		echo $cc_bank_name = $get_Bankresult[$j]['cc_bank_name'];
		//echo $myrow["cc_bank_name"];?></a></td>
      </tr>
      <tr>
        <td height="135" align="center" valign="bottom">
		<? $card_image =$get_Bankresult[$j]['card_image'];
		?><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank"><img src="<? echo $card_image;?>"  height="119" /></a></td>
      </tr>
      <tr>
        <td height="22" valign="bottom" class="crdbold">Features</td>
      </tr>
      <tr>
        <td height="316" valign="top" class="crdtext"><? //echo $myrow["cc_bank_features"];
		echo $cc_bank_features = $get_Bankresult[$j]['cc_bank_features'];
		?></td>
      </tr>
      <tr>
        <td align="center" valign="bottom"><a href="<? if (strlen($cc_bank_url)>0) {echo $cc_bank_url;} else {echo "#";}?>" target="_blank" >
          <input type="image" style="background-image:url(new-images/crds-apply.gif); background-repeat:no-repeat; width:141px; height:65px; border:none;" src="new-images/crds-apply.gif" /></a></td>
      </tr>
    </table></td>
        
		<?
			//echo "heloooooo".$i."<br>";
		

		}

$i=$i+1;


		 }
		
		 //echo "jkh".$r;
if($r==5)
		{
			
		?>
		</tr><tr>
    <td height="20"></td>
    <td height="20"></td>
    <td height="20"></td>
    <td height="20"></td>
  </tr><tr>
		<?
		}
	 $r=$r+1;}
		?>
    
  </tr>
  
  
	 <?
	  }
	  else
	 {
		$filename = "Contents_Credit_Card_Mustread.php";
					//	header("Location: $filename");
						//exit();
	 }
   }
	 else
	 {
		$filename = "Contents_Credit_Card_Mustread.php";
						//header("Location: $filename");
						//exit();
	 }
		 ?>
</table>

  </div>
      <?
  //include '~Right2.php';

  ?>
  <? if ((($_REQUEST['flag'])!=1))
	{ ?>
  <?php include '~Bottom-new.php';?><?php } ?>
</div><!-- </div> -->
</body>
</html>
