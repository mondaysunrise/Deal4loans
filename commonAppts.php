<?php
	require 'scripts/db_init.php';
	//require 'scripts/functions.php';
	
	$mkDate = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));;
	
	$startDate = date("Y-m-d", $mkDate)." 00:00:00";
	$endDate = date("Y-m-d", $mkDate)." 23:59:59";
//$Content ='<p style="text-align:center;"><b>Please check this as every block will go individual to the mentioned email id.</b></p>';
	$sql = "SELECT GlobalID,to_mail,cc_mail FROM Bidders_Mailers WHERE Status=1 group by to_mail";
	$query = ExecQuery($sql);
 	$count = mysql_num_rows($query);

	for($ii=0;$ii<$count;$ii++)
	{
	$Content = '';
		$GlobalID = mysql_result($query,$ii,'GlobalID');
		$to_mail = mysql_result($query,$ii,'to_mail');
		$cc_mail = mysql_result($query,$ii,'cc_mail');
		

		
		 $sql_1 = "SELECT BidderID FROM Bidders_Mailers WHERE Status=1 and GlobalID='".$GlobalID."'";
		//echo $sql_1;
	//	echo "<br>";
		$query_1 = ExecQuery($sql_1);
		$count_1 = mysql_num_rows($query_1);
		$Bidd_ID = '';
		for($j=0;$j<$count_1;$j++)
		{
		 	
			$BidderID = mysql_result($query_1,$j,'BidderID');
			$Bidd_ID[] = $BidderID; 
		
		}
		
		$bid_id = implode(",", $Bidd_ID);
		//print_r($bid_id);
	//	echo "<br>";
			$getDocSql = "select * from fil_appointments left join Req_Feedback_Bidder1 on Req_Feedback_Bidder1.AllRequestID = fil_appointments.RequestID where (Req_Feedback_Bidder1.Allocation_Date between '".$startDate."' and '".$endDate."') and Req_Feedback_Bidder1.BidderID in (".$bid_id.") group by fil_appointments.RequestID";
//echo $getDocSql."<br>";
//	$getDocSql = "select * from fil_appointments where 	Dated between '".$startDate."' and '".$endDate."' group by RequestID";
	$getDocQuery = ExecQuery($getDocSql);
//	echo $getDocSql."<br>";
	$numgetDoc = mysql_num_rows($getDocQuery);
	if($numgetDoc>0)
	{
		for($jj=0;$jj<$numgetDoc;$jj++)
		{
			
			$id = mysql_result($getDocQuery,$jj,'id');
			$address_apt  = mysql_result($getDocQuery,$jj,'address_apt');
			$RequestID = mysql_result($getDocQuery,$jj,'RequestID');
			$appdate  = mysql_result($getDocQuery,$jj,'appdate');
			$changeapp_time  = mysql_result($getDocQuery,$jj,'changeapp_time');
			$docs = mysql_result($getDocQuery,$jj,'docs');
			$Reply_Type = mysql_result($getDocQuery,$jj,'Reply_Type');
			$time = '';
				if($changeapp_time=="08:00:00")
				{
					$time =  "8(am)-9(am)";
				}	
				else if($changeapp_time=="09:00:00")
				{
					$time =  "9(am)-10(am)";
				}
				else if($changeapp_time=="10:00:00")
				{
					$time =  "10(am)-11(am)";
				}
				else if($changeapp_time=="11:00:00")
				{
					$time =  "11(am)-12(pm)";
				}
				else if($changeapp_time=="12:00:00")
				{
					$time =  "12(pm)-1(pm)";
				}
				else if($changeapp_time=="13:00:00")
				{
					$time =  "1(pm)-2(pm)";
				}
				else if($changeapp_time=="14:00:00")
				{
					$time =  "2(pm)-3(pm)";
				}
				else if($changeapp_time=="15:00:00")
				{
					$time =  "3(pm)-4(pm)";
				}
				else if($changeapp_time=="16:00:00")
				{
					$time =  "4(pm)-5(pm)";
				}
				else if($changeapp_time=="17:00:00")
				{
					$time =  "5(pm)-6(pm)";
				}
				else if($changeapp_time=="18:00:00")
				{
					$time =  "6(pm)-7(pm)";
				}
				else if($changeapp_time=="19:00:00")
				{
					$time =  "7(pm)-8(pm)";
				}
			$getBiddersSql = "select Bidders_List.BidderID as BidderID, Req_Feedback_Bidder1.AllRequestID as AllRequestID from Req_Feedback_Bidder1 left join Bidders_List on Bidders_List.BidderID=Req_Feedback_Bidder1.BidderID where Req_Feedback_Bidder1.AllRequestID='".$RequestID."' and Bidders_List.BankID='17' and Req_Feedback_Bidder1.Reply_Type='1'";
			$getBiddersQuery = ExecQuery($getBiddersSql);
			//echo "<br>".$getBiddersSql."<br>";	
			$BidderID = mysql_result($getBiddersQuery,0,'BidderID');
			//echo "<br>".$BidderID;
			$getCustomerSql = "select * FROM Req_Loan_Personal where  RequestID = '".$RequestID."' ";
			$getCustomerQuery = ExecQuery($getCustomerSql);
			$Name = mysql_result($getCustomerQuery,0,'Name');
			$Mobile_Number = mysql_result($getCustomerQuery,0,'Mobile_Number');
			$City = mysql_result($getCustomerQuery,0,'City');
			if($City=="Others")
			{
				$City = mysql_result($getCustomerQuery,0,'City_Other');
			}
			
			$getBidderSql = "select * FROM Bidders where  BidderID = '".$BidderID."' ";
			$getBidderQuery = ExecQuery($getBidderSql);
			$BidderName = mysql_result($getBidderQuery,0,'Bidder_Name');
		
//			$Content .='<tr>';
	//		$Content .='<td class="head1" align="center">'.$Name.'&nbsp;</td>';
		//	$Content .='<td class="head1" align="center">'.$Mobile_Number.'&nbsp;</td>';
			//$Content .='<td class="head1" align="center">'.$City.'&nbsp;</td>';
			//$Content .='<td class="head1" align="center">'.$address_apt.'&nbsp;</td>';
			//$Content .='<td class="head1" align="center">'.$appdate.' - '.$time.'&nbsp;</td>';
			//$Content .='<td class="head1" align="center">'.$docs.'</td>';		
			//$Content .='</tr>';
			
				$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other) values ('".$session_id."', '".$Name."', '".$Mobile_Number."', '".$City."', '".$address_apt."', '".$appdate."', '".$time."', '".$docs."')";
			$result1=ExecQuery($qry1);
		}
		//$Content .='</table>';	
		//echo $Content;	
		$qry="select name as Name, dob as MobileNumber, email as City, emp_status as AppointmentAddress, c_name as ApptDate, city as ApptTime, city_other as Documents  from temp where session_id='".$session_id."' order by doe DESC ";
		//echo "<br>".$qry."<br>";
		$newfileatt = "";		
		$header="";
		$newdata="";
		$result = ExecQuery($qry);
		$num_rows = mysql_num_rows($result);
		
	//	echo "<br>".$num_rows."<br>";
		
		$count = mysql_num_fields($result);
		
		for ($i = 0; $i < $count; $i++){
			$header .= mysql_field_name($result, $i)."\t";
			 
		}
		//$value = '"' . $header . '"' . "\t";
		while($row = mysql_fetch_row($result)){
		  $line = '';
		  foreach($row as $value){
			if(!isset($value) || $value == ""){
			  $value = '"' . $value . '"' . "\t";
			}else{
		# important to escape any quotes to preserve them in the data.
			  $value = str_replace('"', '""', $value);
		# needed to encapsulate data in quotes because some data might be multi line.
		# the good news is that numbers remain numbers in Excel even though quoted.
			  $value = '"' . $value . '"' . "\t";
			}
			$line .= $value;
		  }
		  $newdata .= trim($line)."\n";
		}
		# this line is needed because returns embedded in the data have "\r"
		# and this looks like a "box character" in Excel
		$retnewdata = str_replace("\r", "", $header);
		$retnewdata .="\n"; 
		$retnewdata .= str_replace("\r", "", $newdata);
	 
	
		$newToday = date('d')."".date('m')."".date('y')."".date('s');
		// Open the file and erase the contents if any
		$newfileatt = "/home/deal4loans/public_html/fullerton/Appt".$newToday."(".$City.").xls";
	//	echo "fine".$newfileatt."<br>";
		$newfile = fopen( $newfileatt, 'w+' ); 
		$dataold=fwrite($newfile, $retnewdata);
		fclose( $newfile );
		
		sendexcelfileattachment($to_mail,$session_id,$City, $cc_mail);
		
		
		}	
	//	$Content .='<br>';
	}




function sendexcelfileattachment($emailid,$session_id,$fullecity, $emailid_cc)
	{
		$newToday = date('d')."".date('m')."".date('y')."".date('s');
	//echo $emailid."<br>";
	$to = $emailid; 
	$cc = $emailid_cc;


		echo "City: ".$fullecity;
		echo "<br>";
		echo "To: ".$to;
		echo "<br>";
		echo "Cc: ".$cc;
		echo "<br>";
		echo "--------------------------------------------------------------------------------";
		echo "<br>";
    
	   $from = "Deal4loans <no-reply@deal4loans.com>"; 
       $subject = "Appointments Leads Location-".$fullecity." - Deal4loans"; 
 //   $subject = "test ".$newToday."(".$fullecity.")"; 
 
	   $fileatt = "/home/deal4loans/public_html/fullerton/Appt".$newToday."(".$fullecity.").xls";
        $fileatttype = "application/xls"; 
        $fileattname = "Appt".$newToday."(".$fullecity.").xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
if(strlen($cc)>0)
{
	$headers .= "Cc:".$cc.""."\n";
}
		
    
        $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $message . "\n\n";
    
        $data = chunk_split( base64_encode( $data ) );
                 
        $message .= "--{$mime_boundary}\n" . 
                 "Content-Type: {$fileatttype};\n" . 
                 " name=\"{$fileattname}\"\n" . 
                 "Content-Disposition: attachment;\n" . 
                 " filename=\"{$fileattname}\"\n" . 
                 "Content-Transfer-Encoding: base64\n\n" . 
                 $data . "\n\n" . 
                 "--{$mime_boundary}--\n"; 
                

     if( mail( $to, $subject, $message, $headers ) ) {
             echo "<p>The email was sent.".$fullecity."</p>";  
        }
        else { 
              echo "<p>There was an error sending the mail.".$fullecity."</p>"; 
         
        }

          $qry1="delete from `temp` where session_id='".$session_id."'";
	//	echo "<br>".$qry1;
		
	$result1 = ExecQuery($qry1);
    
    }
	
?>

