<?php
require 'scripts/db_init.php';
	require 'scripts/functions.php';




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

$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);

if(($validMobile==1) && ($validMonth==1) && ($validDay==1) && ($validYear==1) && ($Name!=""))
{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "DOB"=>$DOB, "Dated"=>$Dated, "IsPublic"=>$IsPublic, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance);
			}
			else
			{
				$dataInsert = array("Email"=>$Email , "FName"=>$Name , "Phone"=>$Phone , "Join_Date"=>$Dated , "IsPublic"=>$IsPublic );
				$table = 'wUsers';
				$UserID = Maininsertfunc ($table, $dataInsert);
      			$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Net_Salary"=>$Net_Salary, "DOB"=>$DOB, "Dated"=>$Dated, "IsPublic"=>$IsPublic, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance);
	
				
			}
			$ProductValue = Maininsertfunc ('Req_Credit_Card', $dataInsert);
			$_SESSION['Temp_LID'] = $ProductValue;

			$R_URL="Contents_Credit_Card_Mustread.php";
//exit();
if(strlen($R_URL)>0)
	{
		Header("Refresh: 5 URL=".$R_URL);
	}
}
}
else
	{
	header("Location: Contents_Credit_Card_Mustread.php");
			exit();
	}

		?>
		<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Credit Card</title>
<meta name="keywords" content="Apply Personal Loans, Compare Personal Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<meta name="description" content="Apply Online Personal Loans through Deal4loans.com Get instant information on personal loans from all personal loan provider banks located in major cities of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc. ">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div id="txt" align="center">
      <table width="777"  border="1" cellspacing="0" cellpadding="0" height="300">
		<tr>
		<td align="center"><div style="Font-size:12px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; padding-bottom:10px; padding-top:10px;">
		<? $getciticitydetails =array('Ahmedabad','Aurangabad','Bangalore','Baroda','Bhopal','Chandigarh','Chennai','Coimbatore ','Delhi','Hyderabad','Indore','Jaipur','Kanpur','Lucknow','Ludhiana','Mangalore','Mumbai','Mysore','Nagpur','Nasik','Pune','Surat','Trivandrum','VIZAG');
	if(($Net_Salary>=400000) && (in_array($City, $getciticitydetails))>0)
		{
		 ?>
		Thanks for applying Barcalys Credit Card through Deal4loans.com.<br>
		
		<? } 
		else
		{?>
			At your current profile, we cannot offer you Barclays Platinum Card.<br>
	<?	}?></div>
</td>
			  
			  </tr>
			  </table>
   </div>
 

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