<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

$requestid = $_REQUEST["postid"];

//$updateqry= "DELETE FROM credit_card_mail_logs Where 1";
//$updateqryresult = ExecQuery($updateqry);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['hitApi'] == 'checked'){
	$updateqry= "Update credit_card_mail_logs set customer_consent='2' Where request_id = '".$requestid."'";
	$updateqryresult = ExecQuery($updateqry);
	
	header("Location: http://www.deal4loans.com/Contents_Credit_Card_Mustread.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Credit Card Guide | Credit card articles India | Apply compare offers credit cards- Deal4loans</title>
<meta name="keywords" content="Credit Cards Articles, Credit Cards Must Read, Credit Cards tips, Credit Cards Updates">
<meta name="Description" content="Get online information on best credit cards in India. Read the about the features, basics and tips of credit cards to know APR, default charges, service charge, grace period, credit history, credit card fault etc." />
<link href="css/credit-card-styles.css" rel="stylesheet" type="text/css" />
<script>
function check(){
	if(document.getElementById("hitApi").checked != true){
		alert('Please tick checkbox to submit');
		return false;
	}
	return true;
}
</script>>
</head>
<body >
<?php include "middle-menu.php"; ?>
<div style="clear:both;"></div>
<div class="ccs_inner_wrapper">
  <div style="margin-top:100px;">
	<form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?postid=<? echo $requestid;?>" onsubmit="return check();">
		<table style='border:0px dotted #9C9A9C;' cellspacing="0" cellpadding="5" width="800" align="center" border="0" >
<tr>
				<td style="text-align: center">
					<b><u>Customer Consent</u></b>
				</td>
			</tr>		
	<?php
			$min_date = date('Y-m-d H:i:s', strtotime('-30 minutes'));
			$max_date = date('Y-m-d H:i:s');

			$checkSql = "select * from  credit_card_mail_logs where (request_id = '".$requestid."'  AND (created_date between '".$min_date."' and '".$max_date."'))";
			$checkresult=ExecQuery($checkSql);
			//echo $checkSql."<br>";
			$checkNumRows = mysql_num_rows($checkresult);
			if($checkNumRows==0)
			{
			
			?>
			<tr>
				<td style="text-align: center"  height="400px" valign="top">
					<b>Your Application is already submitted.</b>
				</td>
			</tr>
			
			<?php 
			}
			else
			{
			?>
			
			
			
			<tr>
				<td style="text-align: center">
					<input type="checkbox" id="hitApi" name="hitApi" value="checked"/>In case you do not wish to go ahead with this application right now, you can de-activate the request.
				</td>
			</tr>
			<tr>
				<td style="text-align: center"  height="400px" valign="top">
					<input type="Submit" name="Submit" value="Submit"/>
				</td>
			</tr>
<?php
			}
			?>
			
			
		</table>
	</form>
	</div>
</div>
<div style="clear:both;"></div>
<div class="hide-top">
  <?php include("footer_sub_menu.php"); ?>
</div>
</body>
</html>
