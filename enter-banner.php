<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
//print_r($_GET);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$fullname = $_POST['fullname'];
	$mobile = $_POST['mobile'];
	$email_id = $_POST['email_id'];
	$city = $_POST['city'];
	$source = $_POST['source'];
	$company_name = $_POST['company_name'];
	$net_salary = $_POST['net_salary'];
	$IP = getenv("REMOTE_ADDR");
	$Type_Loan = "Req_Loan_Personal";
	if((strlen($fullname)>0) && (strlen($mobile)>0) && (strlen($Type_Loan)>0))
	{
			/*************************************************************************************/
			$CheckSql = "select UserID from wUsers where Email = '".$email_id."'";
			list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
			$cntr=0;
		
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$cntr]['UserID'];
			
					$dataInsert = array("UserID"=>$UserID, "Name"=>$fullname, "Email"=>$email_id, "Employment_Status"=>'1', "Company_Name"=>$company_name, "City"=>$City, "Mobile_Number"=>$mobile, "Net_Salary"=>$net_salary, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated);


			}
			else
			{
				
				$dataInsert = array("Email"=>$email_id , "FName"=>$fullname , "Phone"=>$mobile , "Join_Date"=>$Dated , "IsPublic"=>$IsPublic );
				$table = 'wUsers';
				$UserID = Maininsertfunc ($table, $dataInsert);
				
				$dataInsert = array("UserID"=>$UserID, "Name"=>$fullname, "Email"=>$email_id, "Employment_Status"=>'1', "Company_Name"=>$company_name, "City"=>$City, "Mobile_Number"=>$mobile, "Net_Salary"=>$net_salary, "Dated"=>$Dated, "source"=>$source, "IP_Address"=>$IP, "Updated_Date"=>$Dated);
			}
//			echo $InsertProductSql;
		$insert = Maininsertfunc ($Type_Loan, $dataInsert);
	}
	header("Location: Contents_Personal_Loan_Mustread.php");
	exit();	
}
else
{
	header("Location: index.php");
	exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Deal4Loans</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<script type="text/javascript" src="js/dropdowntabs.js"></script>
</head>
<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
 
<div id="container">
<div id="lftbar">
<div class="lfttxtbar">
   <div id="txt"><h1  >
 
	</h1>
Thank You for Applying on Deal4loans.com
    </div>

</div></div>

<?php include '~Right-new.php'; ?>

<? if ((($_REQUEST['flag'])!=1))
	{ ?>
<?php include '~Bottom-new1.php';?> <? } ?>
</div>
<script type='text/javascript'><!--//<![CDATA[
    var OA_p=location.protocol=='https:'?'https:':'http:';
    var OA_r=Math.floor(Math.random()*999999);
    document.write ("<" + "script language='JavaScript' ");
    document.write ("type='text/javascript' src='"+OA_p);
    document.write ("//n.admagnet.net/panda/www/delivery/tjs.php");
    document.write ("?trackerid=10&amp;r="+OA_r+"'><" + "/script>");
//]]>--></script><noscript><div id='m3_tracker_10' style='position: absolute; left: 0px; top: 0px; visibility: hidden;'><img src='http://n.admagnet.net/panda/www/delivery/ti.php?trackerid=10&amp;adid=&amp;sname=%%SNAME_VALUE%%&amp;Order_ID=%%ORDER_ID_VALUE%%&amp;OrderID=%%ORDERID_VALUE%%&amp;Quantity=%%QUANTITY_VALUE%%&amp;Value=%%VALUE_VALUE%%&amp;Transactionid=%%TRANSACTIONID_VALUE%%&amp;cb=%%RANDOM_NUMBER%%' width='0' height='0' alt='' /></div></noscript>
</body>
</html>

