<?php
//Commented To and CC
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
	

// for delhi Parvez.Alam@sc.com,Reeti.PAL.Brar@sc.com	
function getReqValue($pKey){
    $titles = array(
	//	'1646' => 'Amit.Bhatnagar@sc.com,Shweta.gupta2@sc.com',
		'1646' => 'neha.sharma@sc.com',
        '1632' => 'mansibipin.shah@sc.com',
        '1633' => 'Anbalagan.Sinnasamy@sc.com',
		'1634' => 'selva.kumar@sc.com,dhanya.rai@sc.com ',
		'1635' => 'mansibipin.shah@sc.com',
		'1636' => 'Shruti.Kajaria@sc.com,Singh.Ritesh@sc.com',
		'1759' => 'mayank.ashar@sc.com',
		'1760' => 'Jacqualine.david@sc.com',
		'2020' => 'DharmendraBishansingh.Bishan@sc.com,soumit.goswami@sc.com',
		'2021' => 'selva.kumar@sc.com,dhanya.rai@sc.com'
		
       		  );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

 // '1633' => 'Balaji.Ramachandran@sc.com,asmathullah.jaffer@sc.com',
  function getReqCity($pKey){
    $titles = array(
		'1646' => 'Delhi',
        '1632' => 'Mumbai',
        '1633' => 'Chennai',
		'1634' => 'Bangalore',
		'1635' => 'Pune',
		'1636' => 'Kolkata',	
		'1759' => 'Ahmedabad',
		'1760' => 'Hyderabad',
		'2020' => 'Mansi',
		'2021' => 'Selva'

		       );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function retrivedataforcitifin()
	{
	$session_id=session_id();
	$citifinid = array('1646','1632','1633','1634','1635','1636','1759','1760','2020','2021');

	$Today = date("Y-m-d"); 
	//$Today = "2010-08-17";
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	for($k=0;$k<count($citifinid);$k++)
		 {
			 
	$citifinquery="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID = ".$citifinid[$k]." and Req_Feedback_Bidder1.Reply_Type=1 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
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
					
	$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$row_result[$i]['DOB'], 'email'=>$row_result[$i]['Email'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'std_code'=>$row_result[$i]['Std_Code'], 'landline'=>$row_result[$i]['Landline'], 'std_code_o'=>$row_result[$i]['Std_Code_O'], 'landline_o'=>$row_result[$i]['Landline_O'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'pincode'=>$row_result[$i]['Pincode'], 'cc_holder'=>$cc_holder, 'net_salary'=>$row_result[$i]['Net_Salary'], 'loan_any'=>$row_result[$i]['Loan_Any'], 'emi_paid'=>$emi_paid, 'is_processed'=>$row_result[$i]['PL_EMI_Amt'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'Feedback'=>$row_result[$i]['Feedback'], 'card_vintage'=>$card_vintage, 'card_limit'=>$row_result[$i]['Card_Limit'], 'ip_address'=>$row_result[$i]['IP_Address'], 'Documents'=>$row_result[$i]['identification_proof'], 'add_comment'=>$row_result[$i]['comment_section'], 'doe'=>$row_result[$i]["Allocation_Date"]);

	$table = 'temp';
	$insert = Maininsertfunc ($table, $dataInsert);
	$emailid=getReqValue($citifinid[$k]);

		 }
	
	//echo $qry1."<br>";
	
	$qry="select name, dob, email, mobile_number, std_code, landline, std_code_o, landline_o, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid,is_processed AS EMI_Amt, loan_amount, Feedback, card_vintage, card_limit, ip_address,Documents AS AvailableDocuments,add_comment,doe  from temp where session_id='".$session_id."' order by doe DESC ";
		
	
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
 

$citifincity=getReqCity($citifinid[$k]);
//echo $citifincity."hello::";
$newToday = date('d')."".date('m')."".date('y');
//$newToday ="170810";

	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/StandardCharteredpl/stanc".$newToday."(".$citifincity.").xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id,$citifincity);
			 }
		 }
		 
	
	}
	function sendexcelfileattachment($emailid,$session_id,$citifincity)
	{
		//$newToday ="170810";
		$newToday = date('d')."".date('m')."".date('y');
	echo $emailid."<br>";
	$to = $emailid; 
	
       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Personal Loan Leads @ deal4loans.com".$newToday."(".$citifincity.")"; 
    
       
	   $fileatt = "/home/deal4loans/public_html/StandardCharteredpl/stanc".$newToday."(".$citifincity.").xls";
        $fileatttype = "application/xls"; 
        $fileattname = "stanc".$newToday."(".$citifincity.").xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: soumit.goswami@sc.com,gosainkavi81@gmail.com"."\n";
	    //$headers .= "Bcc: ranjana5chauhan@gmail.com"."\n";
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
        
		echo $to ;          
 
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
	retrivedataforcitifin();
}
?>