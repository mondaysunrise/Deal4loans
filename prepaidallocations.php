<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
error_reporting();
function getforemailer($pKey){
    $titles = array(
        '1' => 'Personal Loan',
        '2' => 'Home Loan',
        '3' => 'Car Loan',
        '4' => 'Credit Card',
        '5' => 'Loan Against Property',
        '6' => 'Business Loan'
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

  $today_date=date('Y-m-d');
   //$today_date="2010-09-08";
   $max_date=$today_date." 23:59:59";
   $min_date=$today_date." 00:00:00";
  // $max_date="2010-10-11 23:59:59";
   //$min_date="2010-10-11 00:00:00";
   $prods = array(1,2,3,4,5,6);
   $Content = '';
   
for($z=0;$z<count($prods);$z++)
{
	if($prods==4)
	{
		$fdbck_allocate="Req_Feedback_Bidder_CC";
	}
	elseif($prods==1)
	{
		$fdbck_allocate="Req_Feedback_Bidder_PL";
	}
	elseif($prods==2)
	{
		$fdbck_allocate="Req_Feedback_Bidder_HL";
	}
	elseif($prods==3)
	{
		$fdbck_allocate="Req_Feedback_Bidder_CL";
	}
	elseif($prods==5)
	{
		$fdbck_allocate="Req_Feedback_Bidder_LAP";
	}
	else
	{
		$fdbck_allocate="Req_Feedback_Bidder1";
	}

	$sql = "SELECT ".$fdbck_allocate.".BidderID as Bid, Bidders.Bidder_Name as Bname, count( ".$fdbck_allocate.".AllRequestID ) AS Count, Bidders.Define_PrePost AS TYPE , Bidders.City as City,  Bidders_List.Reply_Type as Product,  Bidders_List.BankID as BankID FROM ".$fdbck_allocate." LEFT JOIN (Bidders, Bidders_List) ON ( Bidders.BidderID = ".$fdbck_allocate.".BidderID AND Bidders_List.BidderID = ".$fdbck_allocate.".BidderID and Bidders_List.Reply_Type = ".$fdbck_allocate.".Reply_Type ) WHERE Bidders.Define_PrePost = 'PrePaid' AND Bidders_List.Restrict_Bidder = '1' AND (".$fdbck_allocate.".Allocation_Date BETWEEN '".$min_date."' AND '".$max_date."') and ".$fdbck_allocate.".Reply_Type='".$prods[$z]."'   GROUP BY ".$fdbck_allocate.".BidderID";
	
	$query = ExecQuery($sql);
	//echo $sql;
	//echo "<br>";
	$numRows = mysql_num_rows($query);
	if($numRows>0)
	{
		$Content .='<table width="720" cellpadding="0" cellspacing="0" align="center" border="1">';
		$Content .='<tr><td colspan="6" bgcolor="pink" align="center"><b> Prepaid Leads Count Details ['.getforemailer($prods[$z]).']</b></td></tr>';
		$Content .='<tr>';
		$Content .='<td class="head1" align="center"><b>BidderID</b></td>';
		$Content .='<td class="head1" align="center"><b>Bidder Name</b></td>';
		//$Content .='<td class="head1" align="center"><b>Product</b></td>';
		$Content .='<td class="head1" align="center"><b>Bank Name</b></td>';
		$Content .='<td class="head1" align="center"><b>City</b></td>';
		$Content .='<td class="head1" align="center"><b>Count</b></td>';
		$Content .='</tr>';
		$countArray='';
		for($i=0;$i<$numRows;$i++)
		{
			$Bid = mysql_result($query,$i,'Bid');
			$Bname = mysql_result($query,$i,'Bname');
			$Count = mysql_result($query,$i,'Count');
			$TYPE = mysql_result($query,$i,'TYPE');
			$City = mysql_result($query,$i,'City');
			$Product = mysql_result($query,$i,'Product');
			$ProductName = getforemailer($Product);
			$BankID = mysql_result($query,$i,'BankID');
			$sql1 = "select * from Bank_Master where BankID='".$BankID."'";
			$query1 = ExecQuery($sql1);
			$Bank_Name = mysql_result($query1,0,'Bank_Name');
				
			$Content .='<tr>';
			$Content .='<td class="head1" align="center">'.$Bid.'</td>';
			$Content .='<td class="head1" align="center">'.$Bname.'</td>';
			//$Content .='<td class="head1" align="center">'.$ProductName.'</td>';
			$Content .='<td class="head1" align="center">'.$Bank_Name.'</td>';
			$Content .='<td class="head1" align="center">'.$City.'</td>';
			$Content .='<td class="head1" align="center">'.$Count.'</td>';
			$Content .='</tr>';
			$countArray[] = $Count; 
		}
		$Content .='<tr  bgcolor="#CCFFFF" >';
		$Content .='<td class="head1" align="right" colspan="4"><b>SUM:</b> </td>';
		$Content .='<td class="head1" align="center" ><b>'.array_sum($countArray).'</b></td>';
		$Content .='</tr>';	
		
		$Content .='</table>';
		
	}
}
echo $Content;

$Email="mehra3@gmail.com";

/*$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";*/
$headers = "From: deal4loans <no-reply@deal4loans.com>";
			 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
         $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Bcc: extra4testing@gmail.com "."\n";
	    $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/html; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $Content . "\n\n";
mail($Email,'Prepaid Leads -Deal4loans', $message, $headers);

?>