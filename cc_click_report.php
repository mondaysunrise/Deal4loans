<?php
session_start();
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Login</title>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<link href="includes/style1.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>

  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
    <div id="dvContentPanel">
   <div id="dvMaincontent">
 <? 
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$currentdate=date('Y-m-d',$tomorrow);
$min_date=$currentdate." 00:00:00";
$max_date=$currentdate." 23:59:59";

$arrBidderID = array('Kotak Urbane Gold Card','IndianOil Citibank Titanium Credit Card','HDFC PLatinum Plus Card','HDFC Gold Card');
$Content="Sir ,<br><br>";

for($i=0;$i<count($arrBidderID);$i++)
{
   $ccqry="SELECT RequestID from Req_Credit_Card WHERE (Req_Credit_Card.Updated_Date between '".$min_date."' and '".$max_date."' and (Req_Credit_Card.Descr like '%".$arrBidderID[$i]."%' or Req_Credit_Card.applied_card_name like '%".$arrBidderID[$i]."%')) group by Mobile_Number ";
		
   $ccresult=ExecQuery($ccqry);
 
 $recordcount = mysql_num_rows($ccresult);
 if($recordcount)
		{
			$ccclick = $recordcount;
			$Content.= $arrBidderID[$i]." : ".$ccclick." Leads <br>";
		}

}
$Content.="<br>Regards";
//echo $Content;
		
			
			$Email="mehra3@gmail.com";
			$headers  = 'From: Dealoans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					//echo $Type_Loan;

					if($recordcount)
					{
						mail($Email,'Credit Card Click - d4l', $Content, $headers);
					}
			?>

	
   </div>
   </div>
   </body>

</html>
