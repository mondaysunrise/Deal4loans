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
<?php //include '~Top.php';?>
  <!-- End Main Banner Menu Panel -->
  <!-- Start Main Container Panel -->
    <div id="dvContentPanel">
   <div id="dvMaincontent">
 
 <? $Content ='<table width="720" cellpadding="0" cellspacing="0" align="center" border="1">';
   $Content .='<tr><td colspan="3" bgcolor="pink" align="center"><b> PL LMS Details</b></td></tr>';
$Content .='<tr>';
$Content .='<td class="head1" align="center">Count of leads</td>';
    $Content .='<td class="head1" align="center">Source</td>';
  $Content .='<td class="head1" align="center">Telecaller Name</td>';
    ///////////////FOR PL///////////////////////////////////////
 // $Product_Type=array(1,2);

   $today_date=date('Y-m-d');
  // $today_date="2010-12-09";
   $max_date=$today_date." 23:59:59";
   $min_date=$today_date." 00:00:00";
   //9,10,846,847,854,63,67,68
	$qry="SELECT Count(*) as cont,source,Req_Feedback_PL.BidderID as bid from Req_Loan_Personal LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID= Req_Loan_Personal.RequestID AND Req_Feedback_PL.BidderID in (9,10,11,67,68,63,846,847,854,2748,2783,3621,6255,6256,6257,6258,6259,6260,6261,6262,6263,6264,6265,6266,6267,6268,6269,6270,6276,6277,6278) and Req_Feedback_PL.Feedback='Send Now' WHERE (((Req_Loan_Personal.Bidderid_Details IS NOT  NULL or Req_Loan_Personal.Bidderid_Details!='')) and (Req_Loan_Personal.Dated Between  '".$min_date."' and '".$max_date."' ) and Req_Feedback_PL.BidderID in(9,10,11,67,68,63,846,847,854,2748,2783,3621,6255,6256,6257,6258,6259,6260,6261,6262,6263,6264,6265,6266,6267,6268,6269,6270,6276,6277,6278)) group by source,BidderID with ROLLUP";
	  	   $result=ExecQuery($qry);
		  // echo "hello".$qry;

$recordcount = mysql_num_rows($result);

   if($recordcount>0)
		{
		while($row=mysql_fetch_array($result))
		{
			$cont=$row["cont"];
			$source=$row["source"];
			$bidderID=$row["bid"];
			$total=$row[3];	
		
		$Content .='<tr>';
			$Content .='<td align="center">'.$cont.'</td>';
			$Content .='<td align="center">'.$source.'</td>';
			$Content .='<td align="center">'.$bidderID.'</td>';
			//$Content .='<td align="center">'.$total.'</td>';
			$Content .='</tr>';
}
		}
$Content .='<tr><td colspan="3" align="center" bgcolor="pink"><b> PL Direct Sent</b></td></tr>';
			   $qryds="SELECT Count(*) as cont,source from Req_Loan_Personal WHERE (((Req_Loan_Personal.Bidderid_Details IS NOT  NULL or Req_Loan_Personal.Bidderid_Details!='')) and (Req_Loan_Personal.Dated Between  '".$min_date."' and '".$max_date."' ) and Req_Loan_Personal.IsProcessed=1 and Req_Loan_Personal.Direct_Allocation=1 and Req_Loan_Personal.Allocated=1) group by source with ROLLUP";
	  	   $resultds=ExecQuery($qryds);
		  // echo "hello".$qry;

$recordcountds = mysql_num_rows($resultds);

   if($recordcountds>0)
		{
		while($dsrow=mysql_fetch_array($resultds))
		{
			$dscont=$dsrow["cont"];
			$dssource=$dsrow["source"];
			$dsbidderID=$dsrow["bid"];
			$dstotal=$dsrow[3];	
		
		$Content .='<tr>';
			$Content .='<td align="center">'.$dscont.'</td>';
			$Content .='<td align="center">'.$dssource.'</td>';
			$Content .='<td align="center">Direct Sent</td>';
			//$Content .='<td align="center">'.$total.'</td>';
			$Content .='</tr>';
}
		}

//pl sms
$Content .='<tr><td colspan="3" align="center" bgcolor="pink"><b> PL SMS App model</b></td></tr>';
		 $qryds="SELECT count(`smsapp_leadallocation_log`.RequestID) as cont,source,CallerID FROM `smsapp_leadallocation_log` LEFT JOIN Req_Loan_Personal
ON Req_Loan_Personal.`RequestID` = `smsapp_leadallocation_log`.`RequestID` WHERE (`Sendnow_Date` between '".$min_date."' and '".$max_date."') group by source,CallerID with ROLLUP";
	  	   $resultds=ExecQuery($qryds);
		  // echo "hello".$qry;

$recordcountds = mysql_num_rows($resultds);

   if($recordcountds>0)
		{
		while($dsrow=mysql_fetch_array($resultds))
		{
			$dscont=$dsrow["cont"];
			$dssource=$dsrow["source"];
			$dsbidderID=$dsrow["CallerID"];
			$dstotal=$dsrow[3];	
		
		$Content .='<tr>';
			$Content .='<td align="center">'.$dscont.'</td>';
			$Content .='<td align="center">'.$dssource.'</td>';
			$Content .='<td align="center">'.$dsbidderID.'</td>';
			//$Content .='<td align="center">'.$total.'</td>';
			$Content .='</tr>';
}
		}
			////////////////////////////END HL/////////////

$Content .='<tr><td colspan="3" align="center" bgcolor="pink"><b> HL LMS Details</b></td></tr>';
$Content .='<tr>';
$Content .='<td  align="center">Count of leads</td>';
 $Content .='<td class="head1" align="center">Source</td>';
 $Content .='<td class="head1" align="center">Telecaller Name</td>';
 $Content .='</tr>';
			$Content .='<tr><td colspan="3">';
  ///////////////FOR HL///////////////////////////////////////
 // $Product_Type=array(1,2);
   $hlqry="SELECT Count(*) as cont,source,Req_Feedback_HL.BidderID as bid from Req_Loan_Home LEFT OUTER JOIN Req_Feedback_HL ON Req_Feedback_HL.AllRequestID= Req_Loan_Home.RequestID AND Req_Feedback_HL.BidderID in (732,812,460,207,3635,64,72) and Req_Feedback_HL.Feedback='Send Now' WHERE (((Req_Loan_Home.Bidderid_Details IS NOT  NULL or Req_Loan_Home.Bidderid_Details!='')) and (Req_Loan_Home.Dated Between  '".$min_date."' and '".$max_date."' ) and Req_Feedback_HL.BidderID in(732,812,460,207,64,3635,72)) group by source,BidderID with ROLLUP";
		  $hlresult=ExecQuery($hlqry);
$hlrecordcount = mysql_num_rows($hlresult);

   if($hlrecordcount>0)
		{
		while($hlrow=mysql_fetch_array($hlresult))
		{
			$cont=$hlrow["cont"];
			$source=$hlrow["source"];
			$bidderID=$hlrow["bid"];
			$total=$hlrow[3];		
		$Content .='<tr>';
			$Content .='<td align="center">'.$cont.'</td>';
			$Content .='<td align="center">'.$source.'</td>';
			$Content .='<td align="center">'. $bidderID.'</td>';
			//$Content .='<td align="center">'. $total.'</td>';
			$Content .='</tr>';	
}
		}
			////////////////////////////END HL/////////////
/////////////////////////CC//////////////////////////////////
$Content .='<tr><td colspan="3" align="center" bgcolor="pink"><b> CL LMS Details</b></td></tr>';
$Content .='<tr>';
$Content .='<td  align="center">Count of leads</td>';
 $Content .='<td class="head1" align="center">Source</td>';
 $Content .='<td class="head1" align="center">Telecaller Name</td>';
 $Content .='</tr>';
			$Content .='<tr><td colspan="3">';
  ///////////////FOR CC///////////////////////////////////////
 // $Product_Type=array(1,2);
   $hlqry="SELECT Count(*) as cont,source,Req_Feedback_CL.BidderID as bid from Req_Loan_Car LEFT OUTER JOIN Req_Feedback_CL ON Req_Feedback_CL.AllRequestID= Req_Loan_Car.RequestID AND Req_Feedback_CL.BidderID in (1306,1676) and Req_Feedback_CL.Feedback='Send Now' WHERE (((Req_Loan_Car.Bidderid_Details IS NOT  NULL or Req_Loan_Car.Bidderid_Details!='')) and (Req_Loan_Car.Updated_Date Between  '".$min_date."' and '".$max_date."' ) and Req_Feedback_CL.BidderID in(1306,1676)) group by source,BidderID with ROLLUP";
		
	  	   $hlresult=ExecQuery($hlqry);
		   //echo "hello".$hlqry;

$hlrecordcount = mysql_num_rows($hlresult);

   if($hlrecordcount>0)
		{
		while($ccrow=mysql_fetch_array($hlresult))
		{
			$cont=$ccrow["cont"];
			$source=$ccrow["source"];
			$bidderID=$ccrow["bid"];
			$total=$ccrow[3];
		
		
		$Content .='<tr>';
			$Content .='<td align="center">'.$cont.'</td>';
			$Content .='<td align="center">'.$source.'</td>';
			$Content .='<td align="center">'. $bidderID.'</td>';
			//$Content .='<td align="center">'. $total.'</td>';
			$Content .='</tr>';
			}
		}
		/////////////////////////CC//////////////////////////////////
$Content .='<tr><td colspan="3" align="center" bgcolor="pink"><b> CC LMS Details</b></td></tr>';
$Content .='<tr>';
$Content .='<td  align="center">Count of leads</td>';
 $Content .='<td class="head1" align="center">Source</td>';
 $Content .='<td class="head1" align="center">Telecaller Name</td>';
 $Content .='</tr>';
			$Content .='<tr><td colspan="3">';
  ///////////////FOR CC///////////////////////////////////////
 // $Product_Type=array(1,2);

   $hlqry="SELECT Count(*) as cont,source,Req_Feedback.BidderID as bid from Req_Credit_Card LEFT OUTER JOIN Req_Feedback ON Req_Feedback.AllRequestID= Req_Credit_Card.RequestID AND Req_Feedback.BidderID in (935,936) and Req_Feedback.Feedback='Send Now' WHERE (((Req_Credit_Card.Bidderid_Details IS NOT  NULL or Req_Credit_Card.Bidderid_Details!='')) and (Req_Credit_Card.Updated_Date Between  '".$min_date."' and '".$max_date."' ) and Req_Feedback.BidderID in(935,936)) group by source,BidderID with ROLLUP";
		
	  	   $hlresult=ExecQuery($hlqry);
		   //echo "hello".$hlqry;

$hlrecordcount = mysql_num_rows($hlresult);

   if($hlrecordcount>0)
		{
		while($ccrow=mysql_fetch_array($hlresult))
		{
			$cont=$ccrow["cont"];
			$source=$ccrow["source"];
			$bidderID=$ccrow["bid"];
			$total=$ccrow[3];		
		$Content .='<tr>';
			$Content .='<td align="center">'.$cont.'</td>';
			$Content .='<td align="center">'.$source.'</td>';
			$Content .='<td align="center">'. $bidderID.'</td>';
			//$Content .='<td align="center">'. $total.'</td>';
			$Content .='</tr>';
}
		}
			$Content .='</td></tr></table>';
			
			//echo $Content;
			$Email="mehra3@gmail.com";
			//$Email="ranjana5chauhan@gmail.com";
			/*$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
					$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";*/
					//echo $Type_Loan;
$headers = "From: Deal4loans <no-reply@deal4loans.com>";
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		    $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $Content . "\n\n";
						mail($Email,'LMS MIS -Deal4loans', $message, $headers);
					//}
			?>

	
   </div>
   </div>
   </body>

</html>
