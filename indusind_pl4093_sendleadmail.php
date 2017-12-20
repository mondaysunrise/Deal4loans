<?php
//Commented To and CC
session_start();
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
	
function getReqValue($pKey){
    $titles = array(
		'4083' => 'kumar.rishikesh@indusind.com,ishrat.sheikh@deal4loans.com',
		'4084' => 'dipakkumar.roy@indusind.com,ishrat.sheikh@deal4loans.com',
		'4085' => 'raman.jha@indusind.com,shubham.rawat@indusind.com,mishra.alok@indusind.com,goutam.bala@indusind.com,ishrat.sheikh@deal4loans.com',
		'4086' => 'harvinder.butasingh@indusind.com,ishrat.sheikh@deal4loans.com',
		'4087' => 'srikantha.sannayya@indusind.com',		
		'6045' => 'manjunath.basavarajun@indusind.com',
		'6046' => 'srikantha.sannayya@indusind.com',
		'6047' => 'manjunath.basavarajun@indusind.com',
		'6048' => 'manjunath.basavarajun@indusind.com',
		'4088' => 'deepak.venugopal@indusind.com',
		'4090' => 'ramesh.airani@indusind.com',
		'4091' => 'Vicky.surve@indusind.com',
		'4092' => 'kumar.vazirani@indusind.com,ishrat.sheikh@deal4loans.com',
		'5168' => 'ramesh.airani@indusind.com,ishrat.sheikh@deal4loans.com',
		'5409' => 'raj.shantanu@indusind.com,ishrat.sheikh@deal4loans.com',
		'5410' => 'sunny.masih@indusind.com,ishrat.sheikh@deal4loans.com',
		'5411' => 'mandeep.pawar@indusind.com,ishrat.sheikh@deal4loans.com',
		'5412' => 'swapnil.nawani@indusind.com,ishrat.sheikh@deal4loans.com',
		'5413' => 'putreyv.murty@indusind.com,ishrat.sheikh@deal4loans.com',
		'5414' => 'ninan.george@indusind.com',
		'5415' => 'swamynathan.subramanian@indusind.com',
		'5815' => 'rathore.bhanwarsingh@indusind.com',
		'5884' => 'rahul.nanda@indusind.com',
		'5890' => 'piyushkumar.gupta@indusind.com,ishrat.sheikh@deal4loans.com',
		'5937' => 'vicky.surve@indusind.com',
		'6496' => 'mishra.alok@indusind.com',
		'6497' => 'goutam.bala@indusind.com',
		'6498' => 'manisha.gahukar@indusind.com',
        '6645' => 'kumar.rishikesh@indusind.com,ishrat.sheikh@deal4loans.com',
        '6646' => 'kumar.rishikesh@indusind.com,ishrat.sheikh@deal4loans.com',
        '6647' => 'srikantha.sannayya@indusind.com',
        '6648' => 'srikantha.sannayya@indusind.com',
        '6649' => 'srikantha.sannayya@indusind.com',
        '6650' => 'srikantha.sannayya@indusind.com',
        '6651' => 'srikantha.sannayya@indusind.com',
        '6652' => 'srikantha.sannayya@indusind.com',
        
	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function getReqValuecc($pKey){
    $titles = array(		
'4083' => 'sulabh.rastogi@indusind.com,neha.gupta@deal4loans.com',
'4084' => 'shyamasree.de@indusind.com,arijit.banerjee@indusind.com,neha.gupta@deal4loans.com',
'4085' => 'shubham.rawat@indusind.com,neha.gupta@deal4loans.com',
'4086' => 'vikram.kohli@indusind.com,pardeep.kumar@indusind.com,neha.gupta@deal4loans.com',
'4087' => 'shijil.phalgunan@indusind.com,neha.gupta@deal4loans.com',
'4088' => 'yuvaraj.rajasekar@indusind.com,neha.gupta@deal4loans.com',
'4090' => 'sushant.kadoo@indusind.com,neha.gupta@deal4loans.com',
'4091' => 'upendra.Thakare@indusind.com,alok.raina@indusind.com,ishrat.sheikh@deal4loans.com',
'4092' => 'Rahul.roychowdhury@indusind.com,neha.gupta@deal4loans.com',
'5168' => 'vicky.surve@indusind.com,neha.gupta@deal4loans.com,ishrat.sheikh@deal4loans.com',
'5409' => 'neha.gupta@deal4loans.com',
'5410' => 'sunny.masih@indusind.com,gaurav.aggarwal@indusind.com',
'5411' => 'neha.gupta@deal4loans.com,Rahul.roychowdhury@indusind.com',
'5412' => 'neha.gupta@deal4loans.com,Rahul.roychowdhury@indusind.com',
'5413' => 'neha.gupta@deal4loans.com',
'5414' => 'narayanan.gireeshbabu@indusind.com',
'5415' => 'jaya.chaturvedi@indusind.com,saravanan.govindarajan@indusind.com,neha.gupta@deal4loans.com',
'5815' => 'himanshu.arora@indusind.com,neha.gupta@deal4loans.com',
'5884' => 'neha.gupta@deal4loans.com',
'5890' => 'Rahul.roychowdhury@indusind.com,neha.gupta@deal4loans.com',
'5937' => 'sushant.kadoo@indusind.com,neha.gupta@deal4loans.com',
'4089' => 'turpu.vamshitrao@indusind.com,ishrat.sheikh@deal4loans.com',
'6113' => 'phanikalyan.chittyboyina@indusind.com,ishrat.sheikh@deal4loans.com',
'6653' => 'vicky.surve@indusind.com,ishrat.sheikh@deal4loans.com',
'6654' => 'vicky.surve@indusind.com,ishrat.sheikh@deal4loans.com',
'6655' => 'vicky.surve@indusind.com,ishrat.sheikh@deal4loans.com',
'6656' => 'upendra.Thakare@indusind.com,ishrat.sheikh@deal4loans.com',
		  );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }
 
function getReqCity($pKey){
   $titles = array(
'4083' => 'Delhi',
'4084' => 'Kolkata',
'4085' => 'Jaipur',
'4086' => 'Chandigarh',
'4087' => 'Bangalore',
'4088' => 'Chennai',
'4089' => 'Hyderabad',
'4090' => 'Mumbai',
'4091' => 'Pune',
'4092' => 'Ahmedabad',
'5168' => 'Mumbai 1',
 '5409' => 'Lucknow',
'5410' => 'Ludhiana',
'5411' => 'Baroda',
'5412' => 'Surat',
'5413' => 'Vizag',
'5414' => 'Cochin',
'5415' => 'Coimbatore',
'5815' => 'Jodhpur',
'5884' => 'Amritsar',
'5890' => 'Indore',
'6496' => 'Kanpur',
'6497' => 'Bhubaneswar',
'6498' => 'Nagpur'

		       );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function retrivedataforindusind()
	{
	$session_id=session_id();
	$ingvid = array('4083','4084','4085','4086','4087','4088','4089','4090','4091','4092','5409','5410','5411','5412','5413','5414','5415','5815','5884','5890');

	$Today = date("Y-m-d"); 
		$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	for($k=0;$k<count($ingvid);$k++)
		 {
	$ingvquery="SELECT Employment_Status,CC_Holder,EMI_Paid,Card_Vintage,Name,DOB,Email,Mobile_Number,Std_Code,Landline,Std_Code_O,Landline_O,Company_Name,City,City_Other,Pincode,Net_Salary,Loan_Any,PL_EMI_Amt,Loan_Amount,Card_Limit,IP_Address,identification_proof,Allocation_Date FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID = ".$ingvid[$k]." and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
	$search_result=ExecQuery($ingvquery);
	$recordcount = mysql_num_rows($search_result);
	echo "i m in else".$ingvquery."<br><br>"; 
	while($row_result=mysql_fetch_array($search_result))
	{ 
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result["CC_Holder"]==0) { $cc_holder="No"; }
			
			if($row_result["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
			elseif($row_result["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
			elseif($row_result["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
			elseif($row_result["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
			else
			{ $emi_paid="";
			}
			if($row_result["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
			elseif($row_result["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($row_result["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($row_result["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
			{
				$card_vintage="";
			}
							
	$qry1="insert into temp (session_id, name, dob, email, mobile_number, std_code, landline, std_code_o, landline_o, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid,is_processed, loan_amount, card_vintage, card_limit, ip_address,Documents ,doe) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$row_result["Mobile_Number"]."','".$row_result["Std_Code"]."', '".$row_result["Landline"]."','".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."','".$emp_status."','".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."','".$row_result["Pincode"]."','".$cc_holder."','".$row_result["Net_Salary"]."','".$row_result["Loan_Any"]."','".$emi_paid."','".$row_result["PL_EMI_Amt"]."','".$row_result["Loan_Amount"]."','".$card_vintage."','".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["identification_proof"]."','".$row_result["Allocation_Date"]."')";
			$result1=ExecQuery($qry1);
			//echo "".$qry1."<br>";
		$emailid = getReqValue($ingvid[$k]);
		$emailidcc = getReqValuecc($ingvid[$k]);

		 }
	
	$qry="select name, dob, email, mobile_number AS MobileNo, std_code, landline, emp_status AS Occupation, c_name AS ComapnyName, city AS City, city_other AS OtherCity, pincode, cc_holder AS CardHolder, net_salary AS AnnualIncome, loan_any AS AnyLoan, emi_paid AS EMIPaid,is_processed AS EMI_Amt, loan_amount AS LoanAmt, card_vintage AS CardVintage, ip_address,Documents AS AvailableDocuments,add_comment AS Comments,doe AS DOE  from temp where session_id='".$session_id."' order by doe DESC ";
		
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$newdata="";
	$result = ExecQuery($qry);
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
$ingvcity=getReqCity($ingvid[$k]);
//echo $ingvcity."hello::";
$newToday = date('d')."".date('m')."".date('y');
//$newToday ="170810";
	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/pldwnld/indusind".$newToday."(".$ingvcity.")".$ingvid[$k].".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id,$ingvcity, $ingvid[$k],$emailidcc );
			 }
		 }
	}

	function sendexcelfileattachment($emailid,$session_id,$ingvcity, $ingvysyaid,$emailidcc)
	{
	$newToday = date('d')."".date('m')."".date('y');
	
	$to = $emailid; 
	//$to = "ranjana5chauhan@gmail.com"; 
	       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Personal Loan Leads @ deal4loans.com".$newToday."(".$ingvcity.")"; 
           
	   $fileatt = "/home/deal4loans/public_html/pldwnld/indusind".$newToday."(".$ingvcity.")".$ingvysyaid.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "indusind".$newToday."(".$ingvcity.")".$ingvysyaid.".xls";
   
           $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		$semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		 if(strlen($emailidcc)>0)
		{
		$headers .= "Cc: ".$emailidcc.""."\n";
		}
	$headers .= "Bcc: nehag.deal4loans@gmail.com"."\n";
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
	$result1 = ExecQuery($qry1);
      }

main();
function main()
{
	retrivedataforindusind();
}
?>