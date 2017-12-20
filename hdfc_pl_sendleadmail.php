<?php
//Commented To and CC
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

function retrivedataforhdfc()
{
	$session_id=session_id();
	$Today = date("Y-m-d"); 
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	$citifinquery="SELECT Name,DOB,Email, Mobile_Number,Std_Code, Landline,Company_Name,City, City_Other,Pincode, Net_Salary, Loan_Any, Loan_Amount, IP_Address,Add_Comment,Allocation_Date, Employment_Status,EMI_Paid,CC_Holder, Card_Vintage FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (1887,1888,1889,1890,1891,1948,1949,1950,1956,1957,1958,1959,1960,2626,2627,2628,2629,3036) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
	echo "i m in else".$citifinquery."<br><br>";
	list($recordcount,$row_result)=MainselectfuncNew($citifinquery,$array = array());
	for($i=0;$i<$recordcount;$i++)
	{	
		if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
			if($row_result[$i]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$i]["CC_Holder"]==0) { $cc_holder="No"; }
	
			if($row_result[$i]["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
			elseif($row_result[$i]["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
			elseif($row_result[$i]["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
			elseif($row_result[$i]["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
			else
			{ $emi_paid="";
			}
			if($row_result[$i]["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($row_result[$i]["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($row_result[$i]["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($row_result[$i]["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}
			
			$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$row_result[$i]['DOB'], 'email'=>$row_result[$i]['Email'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'std_code'=>$row_result[$i]['Std_Code'], 'landline'=>$row_result[$i]['Landline'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'pincode'=>$row_result[$i]['Pincode'], 'cc_holder'=>$cc_holder, 'net_salary'=>$row_result[$i]['Net_Salary'], 'loan_any'=>$row_result[$i]['Loan_Any'], 'emi_paid'=>$emi_paid, 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'card_vintage'=>$card_vintage, 'ip_address'=>$row_result[$i]['IP_Address'], 'add_comment'=>$row_result[$i]['Add_Comment'], 'doe'=>$row_result[$i]['Allocation_Date']);
			$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	
		
		 }
	
	//echo $qry1."<br>";
	
	$qry="select name, dob AS DOB, email AS EmailID, mobile_number AS MobileNo, std_code AS StdCode, landline AS Landline, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, net_salary AS AnnualIncome, loan_any AS LoanRunning, emi_paid AS NoOfEMIPaid, loan_amount AS LoanAmt, card_vintage AS CardVintage, ip_address AS IPAddress,add_comment AS comments,doe AS DateOfEntry  from temp where session_id='".$session_id."' order by doe DESC ";
		
	
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$newdata="";
	list($num_rows,$myrow)=MainselectfuncNew($qry,$array = array());

	 $field_names = getFieldNames($qry);
	
	
	for ($i = 0; $i <count($field_names); $i++){
		$header .= $field_names[$i]."\t";
	}
	
	for($dnld=0;$dnld<count($myrow);$dnld++)
	{
		$myrowarr=$myrow[$dnld];
		
		  $line = '';
		  foreach($myrowarr as $value){	
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
 

//echo $citifincity."hello::";
$newToday = date('d')."".date('m')."".date('y');
//$newToday ="170810";

	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/hdfc/hdfcpl".$newToday.".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id);
			 }
		 
	}

	function sendexcelfileattachment($emailid,$session_id)
	{
		//$newToday ="170810";
		$newToday = date('d')."".date('m')."".date('y');
	
	$to = "PLCrossSell@hdfcbank.com"; 

       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Personal Loan Leads @ deal4loans.com ".$newToday; 
    
       
	   $fileatt = "/home/deal4loans/public_html/hdfc/hdfcpl".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "hdfcpl".$newToday.".xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: diptendu.dey@hdfcbank.com,neha.gupta@deal4loans.com"."\n";

    
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
         
            echo "<p>The email was sent.</p>"; 
         
        }
        else { 
        
            echo "<p>There was an error sending the mail.</p>"; 
         
        }
	$qry1="delete from `temp` where session_id='".$session_id."'";
	Maindeletefunc($qry1,$array = array());
    
    }
main();
function main()
{
	retrivedataforhdfc();
}
?>