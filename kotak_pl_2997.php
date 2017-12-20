<?php

	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	


function getReqValue($pKey){
    $titles = array(
'2998' => 'utkarsh.chauhan@kotak.com',
'2999' => 'sumitkumar.shah@kotak.com',
'3000' => 'abhilash.chari@kotak.com',
'3001' => 'hariharan.santhana@kotak.com',
'3002' => 'bharat.pathak@kotak.com',
'3003' => 'sandeep.khanna@kotak.com',
'3004' => 'neeraj.srivastava@kotak.com',
'3005' => 'pinal.n.shah@kotak.com',
'3006' => 'mahendra.yadav@kotak.com',
'3007' => 'piyush.ashtekar@kotak.com',
'3008' => 'chatterjee.sumit@kotak.com',
'3009' => 'mohit.makkar@kotak.com',
'3010' => 'ashutosh.upadhyay@kotak.com',
'3011' => 'vinilkumar.t@kotak.com',
'3012' => 'neeraj.vohra@kotak.com',
'3013' => 'rohit.r.gupta@kotak.com',
'3014' => 'mohit.makkar@kotak.com',
'3015' => 'pinkesh.panchal@kotak.com',
'3654' => 'Ghanshyam.rawat@kotak.com',
'2997' => 'vinod.sisodiya@kotak.com,prashant.bakshi@kotak.com,shweta.sharma@deal4loans.com'
		
       		  );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

 // '1633' => 'Balaji.Ramachandran@sc.com,asmathullah.jaffer@sc.com',
  function getReqCity($pKey){
    $titles = array(
       '2998' => 'Pune',
'2999' => 'Ahmedabad',
'3000' => 'Hyderabad',
'3001' => 'Chennai',
'3002' => 'Banglaore',
'3003' => 'Delhi',
'3004' => 'Chandigarh',
'3005' => 'Baroda',
'3006' => 'Surat',
'3007' => 'Nagpur',
'3008' => 'Kolkata',
'3009' => 'Jaipur',
'3010' => 'Ludhiana',
'3011' => 'Mysore',
'3012' => 'Jalandhar',
'3013' => 'Patiala',
'3014' => 'Udaipur',
'3015' => 'Mumbai',
'3654' => 'Delhi1',
'2997' => 'Complete'

		       );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function retrivedataforcitifin()
	{
	$session_id=session_id();
	$citifinid = array('2998','2999','3000','3001','3002','3003','3004','3005','3006','3007','3008','3009','3010','3011','3012','3013','3014','3015','3654','2997');

	$Today = date("Y-m-d"); 
	//$Today = "2010-08-17";
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	for($k=0;$k<count($citifinid);$k++)
		 {
			if($citifinid[$k]=="2997")
			 {
				$citifinquery="SELECT Employment_Status,CC_Holder,EMI_Paid,Card_Vintage,Name,DOB,Email,Mobile_Number,Company_Name,City,City_Other,
Pincode,Net_Salary,Loan_Any,PL_EMI_Amt,Loan_Amount,Card_Limit,Allocation_Date FROM Req_Feedback_Bidder1,Req_Loan_Personal WHERE (Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID in (2998,2999,3000,3001,3002,3003,3004,3005,3006,3007,3008,3009,3010,3011,3012,3013,3014,3015) and Req_Feedback_Bidder1.Reply_Type=1 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";

			 }
		else
			 {
					$citifinquery="SELECT Employment_Status,CC_Holder,EMI_Paid,Card_Vintage,Name,DOB,Email,Mobile_Number,Company_Name,City,City_Other,
Pincode,Net_Salary,Loan_Any,PL_EMI_Amt,Loan_Amount,Card_Limit,Allocation_Date FROM Req_Feedback_Bidder1,Req_Loan_Personal WHERE (Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID in (".$citifinid[$k].") and Req_Feedback_Bidder1.Reply_Type=1 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."' ) ";
			 }
	
	 list($recordcount,$row_result)=MainselectfuncNew($qry2,$array = array());
		$cntr=0;
		
		
	echo "i m in else".$citifinquery."<br><br>";
 
	while($cntr<count($row_result))
        {

		if($row_result[$cntr]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
			
			if($row_result[$cntr]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$cntr]["CC_Holder"]==0) { $cc_holder="No"; }
			
			if($row_result[$cntr]["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
			elseif($row_result[$cntr]["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
			elseif($row_result[$cntr]["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
			elseif($row_result[$cntr]["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
			else
			{ $emi_paid="";
			}
			if($row_result[$cntr]["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($row_result[$cntr]["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($row_result[$cntr]["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($row_result[$cntr]["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}
			

		
		$dataInsert = array("session_id"=>$session_id, "name"=>$row_result[$cntr]["Name"], "dob"=>$row_result[$cntr]["DOB"], "email"=>$row_result[$cntr]["Email"], "mobile_number"=>$row_result[$cntr]["Mobile_Number"], "emp_status"=>$emp_status, "c_name"=>$row_result[$cntr]["Company_Name"], "city"=>$row_result[$cntr]["City"], "city_other"=>$row_result[$cntr]["City_Other"], "pincode"=>$row_result[$cntr]["Pincode"], "cc_holder"=>$cc_holder, "net_salary"=>$row_result[$cntr]["Net_Salary"], "loan_any"=>$row_result[$cntr]["Loan_Any"], "emi_paid"=>$emi_paid, "is_processed"=>$row_result[$cntr]["PL_EMI_Amt"], "loan_amount"=>$row_result[$cntr]["Loan_Amount"], "Feedback"=>$row_result[$cntr]["Feedback"], "card_vintage"=>$card_vintage, "card_limit"=>$row_result[$cntr]["Card_Limit"], "add_comment"=>$row_result[$cntr]["comment_section"], "doe"=>$row_result[$cntr]["Allocation_Date"]);
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);
		
		
			//echo "".$qry1."<br>";

		 $cntr=$cntr+1; }
	
	$emailid = getReqValue($citifinid[$k]);

	//echo $qry1."<br>";
	$qry="select name AS Name, dob AS DOB, email AS EmailId, mobile_number AS MobileNo, emp_status AS Occupation, c_name AS CName, city AS City, city_other AS OtherCity, pincode AS Pincode, cc_holder AS CardHolder, net_salary AS Income, loan_any AS LoanRunning, emi_paid AS EMIPaid, loan_amount AS LoanAmt, card_vintage AS CardVintage, add_comment AS Comments, doe AS DateOfEntry from temp where session_id='".$session_id."' order by doe DESC";

	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$newdata="";
	list($count,$row)=MainselectfuncNew($qry,$array = array());
	$cntr=0;
  $field_names = getFieldNames($qry);
  for ($i = 0; $i <count($field_names); $i++){
		$header .= $field_names[$i]."\t";
	}
  
	
	//$value = '"' . $header . '"' . "\t";
	while($cntr<count($row)){
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
	 $cntr=$cntr+1;}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	$retnewdata = str_replace("\r", "", $header);
	$retnewdata .="\n"; 
	  $retnewdata .= str_replace("\r", "", $newdata);
 

$newToday = date('d')."".date('m')."".date('y');
//$newToday ="280112";

	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/pldwnld/kotak".$newToday."".$citifinid[$k].".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id,$citifinid[$k]);
			 }
		 }
		 
	
	}
	function sendexcelfileattachment($emailid,$session_id,$citifinid)
	{
		
		$newToday = date('d')."".date('m')."".date('y');

	$to = $emailid; 
	//$to = "ranjana5chauhan@gmail.com"; 
	$bdcity=getReqCity($citifinid);
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Kotak Personal Loan Leads @ deal4loans.com(".$bdcity.")".$newToday; 
          
	   $fileatt = "/home/deal4loans/public_html/pldwnld/kotak".$newToday."".$citifinid.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "kotak".$newToday."".$citifinid.".xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		//$headers .= "Cc: shweta.sharma@deal4loans.com"."\n";
	  // $headers .= "Bcc: ranjana5chauhan@gmail.com"."\n";
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
	$result1 = ExecQuery($qry1);
    
    }
main();
function main()
{
	retrivedataforcitifin();
}
?>