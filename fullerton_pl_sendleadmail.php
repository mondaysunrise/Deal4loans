<?php
//Commented To and CC
session_start();
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';
	
function getReqValue($pKey){
    $titles = array(
		'2972' => 'Venkataramanan.R@fullertonindia.com,b.omprabhakar@fullertonindia.com,intellect.sindhu.k@fullertonindia.com,kavita@deal4loans.com',
  		'3574' => 'prerna.saxena@fullertonindia.com,samresh.kumar@fullertonindia.com,ashish.vijpuria@fullertonindia.com,kavita@deal4loans.com',
		'3558' => 'shazia.khan@fullertonindia.com,kavita@deal4loans.com',
		'3594' => 'kavita@deal4loans.com',
		'6156' => 'intellect.sindhu.k@fullertonindia.com',
		'6157' => 'intellect.sindhu.k@fullertonindia.com',
		'2997' => 'intellect.sindhu.k@fullertonindia.com'
		//'6365' => 'Prerna.Saxena@fullertonindia.com,ashish.vijpuria@fullertonindia.com,kavita@deal4loans.com'
	);
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

 
function getReqCity($pKey){
   $titles = array(
	'2972' => 'Chennai',
		'3574' => 'Delhi',
		'3558' => 'Mumbai',
		'3594' => 'Pune',
		'6156' => 'Coimbatore',
		'6157' => 'Coimbatore',
		'2997' => 'Complete'
		       );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

function retrivedataforfullerton()
	{
	$session_id=session_id();
	$ingvid = array('2972','3574','3558','6156','6157','2997');

	$Today = date("Y-m-d"); 
	
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";

	for($k=0;$k<count($ingvid);$k++)
		 {
		if($ingvid[$k]=="2997")
			 {
				$ingvquery="SELECT Employment_Status,CC_Holder,EMI_Paid,Card_Vintage,Name,DOB,Email,Mobile_Number,Std_Code,Landline,Std_Code_O,Landline_O,Company_Name,City,City_Other,Pincode,Net_Salary,Loan_Any,PL_EMI_Amt,Loan_Amount,Card_Limit,IP_Address,identification_proof,Allocation_Date,Req_Feedback_Bidder1.BidderID AS sentbidder FROM Req_Feedback_Bidder1,Req_Loan_Personal WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID in (1343,1347,1350,1338,1340,1339,1342,1344,1346,1345,1454,1463,1354,1351,1464,1355,1356,1457,1352,1460,1349,6156,6157) and Req_Feedback_Bidder1.Reply_Type=1 and Req_Feedback_Bidder1.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
			 }
			 else
			 {
		
	$ingvquery="SELECT Employment_Status,CC_Holder,EMI_Paid,Card_Vintage,Name,DOB,Email,Mobile_Number,Std_Code,Landline,Std_Code_O,Landline_O,Company_Name,City,City_Other,Pincode,Net_Salary,Loan_Any,PL_EMI_Amt,Loan_Amount,Card_Limit,IP_Address,identification_proof,Allocation_Date FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID = ".$ingvid[$k]." and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."'  ";
			 }
	$search_result=ExecQuery($ingvquery);
	$recordcount = mysql_num_rows($search_result);
	echo "i m in else".$ingvquery."<br><br>"; 
	$asmtype="";
	while($row_result=mysql_fetch_array($search_result))
	{ 
			 	if($row_result['sentbidder']=="1343")		{	$asmtype="Sathish babu";	}
			elseif($row_result['sentbidder']=="6156")	{	$asmtype="Narendran";		}
			elseif($row_result['sentbidder']=="6157")	{	$asmtype="Vijayendran";}

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
							
	$qry1="insert into temp (session_id, name, dob, email, mobile_number, std_code, landline, std_code_o, landline_o, emp_status, c_name, city, city_other, pincode, cc_holder, net_salary, loan_any, emi_paid,is_processed, loan_amount, card_vintage, card_limit, ip_address,Documents ,doe, car_type) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$row_result["Mobile_Number"]."','".$row_result["Std_Code"]."', '".$row_result["Landline"]."','".$row_result["Std_Code_O"]."', '".$row_result["Landline_O"]."','".$emp_status."','".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."','".$row_result["Pincode"]."','".$cc_holder."','".$row_result["Net_Salary"]."','".$row_result["Loan_Any"]."','".$emi_paid."','".$row_result["PL_EMI_Amt"]."','".$row_result["Loan_Amount"]."','".$card_vintage."','".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["identification_proof"]."','".$row_result["Allocation_Date"]."','".$asmtype."')";
			$result1=ExecQuery($qry1);
			//echo "".$qry1."<br>";
		$emailid = getReqValue($ingvid[$k]);
		 }
	
	$qry="select name, dob, email, mobile_number AS MobileNo, std_code, landline, emp_status AS Occupation, c_name AS ComapnyName, city AS City, city_other AS OtherCity, pincode, cc_holder AS CardHolder, net_salary AS AnnualIncome, loan_any AS AnyLoan, emi_paid AS EMIPaid,is_processed AS EMI_Amt, loan_amount AS LoanAmt, card_vintage AS CardVintage, ip_address,Documents AS AvailableDocuments,add_comment AS Comments,car_type AS ASMName, doe AS DOE  from temp where session_id='".$session_id."' order by doe DESC ";
		
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
	$newfileatt = "/home/deal4loans/public_html/pldwnld/ful".$newToday."(".$ingvcity.")".$ingvid[$k].".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id,$ingvcity, $ingvid[$k]);
			 }
		 }
	}

	function sendexcelfileattachment($emailid,$session_id,$ingvcity, $ingvysyaid)
	{
	$newToday = date('d')."".date('m')."".date('y');
	
	$to = $emailid; 
	//$to = "ranjana5chauhan@gmail.com"; 
	       $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Personal Loan Leads @ deal4loans.com".$newToday."(".$ingvcity.")"; 
           
	   $fileatt = "/home/deal4loans/public_html/pldwnld/ful".$newToday."(".$ingvcity.")".$ingvysyaid.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "ful".$newToday."(".$ingvcity.")".$ingvysyaid.".xls";
   
           $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		$semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		if($ingvysyaid=="2997")
		{
		$headers .= "Cc: shalini.rajput@deal4loans.com,balbir.singh@deal4loans.com,venkataramanan.r@fullertonindia.com,jebasubash.r@fullertonindia.com,ks.pathrinarrayanan@fullertonindia.com,intellect.sindhu.k@fullertonindia.com,s.preeti@deal4loans.com"."\n";
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
	retrivedataforfullerton();
}
?>