<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';

	function getReqemailValue($pKey){
    $titles = array(
		'5247' => 'UmeshKumar.A@Tata-bss.com,Anirban.Chakraborty@Tata-bss.com',
		'5235' => 'Nirav.Joshi@Tata-bss.com,Anirban.Chakraborty@Tata-bss.com',
		'5237' => 'Shishir.S@Tata-bss.com,Anirban.Chakraborty@Tata-bss.com',
		'5237' => 'namrata.singhal@tatacapital.com,prasoon.prabhakar@tatacapital.com',
		'5243' => 'Mahendra.Puppala@Tata-bss.com,Anirban.Chakraborty@Tata-bss.com',
		'5242' => 'HarshVardhan.Pandey@Tata-bss.com,Anirban.Chakraborty@Tata-bss.com',
		'5245' => 'Amit.Roy@Tata-bss.com,Anirban.Chakraborty@Tata-bss.com',
		'5241' => 'Mageshkumar.kp@Tata-bss.cata-bss.comom,Anirban.chakrab-bss.com',
		'5264' => 'kiran.b@tatacapital.com,Anirban.Chakraborty@Tata-bss.com'		
		 );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

  function getReqcityValue($pKey){
    $titles = array(
		'5235' => 'Ahmedabad',
		'5237' => 'Bangalore',
		'5242' => 'Delhi',
		'5243' => 'Hyderabad',
		'5245' => 'Kolkata',
		'5247' => 'Mumbai',
		'5241' => 'Chennai',
		'5264' => 'Complete'
				 );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function retrivedatafortata()
{
	$session_id=session_id();
	$todayd=Date('Y-m-d');
	$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	$Today=date('Y-m-d',$tomorrow);
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	//$tatacappl = array('5247','5250','5235','5236','5319','5237','5243','5241','5242','5240','5320','5245','5321','5239','5422','5264');
	$tatacappl = array('5235','5237','5242','5243','5245','5247','5241','5264');

 for($k=0;$k<count($tatacappl);$k++)
		 {
	 if($tatacappl[$k]==5264)
			 {
		$citifinquery="SELECT Name,DOB,Email, Mobile_Number,Std_Code, Landline,Company_Name,City, City_Other,Pincode, Net_Salary, Loan_Any, Loan_Amount, IP_Address,Add_Comment,Allocation_Date, Employment_Status,EMI_Paid,CC_Holder, Card_Vintage,Total_Experience, Years_In_Company,BidderID FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE (Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (5235,5236,5237,5239,5240,5241,5242,5243,5245,5247,5250,5319,5320,5321,5422) and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."')";
			 }
			 else
			 {
	$citifinquery="SELECT Name,DOB,Email, Mobile_Number,Std_Code, Landline,Company_Name,City, City_Other,Pincode, Net_Salary, Loan_Any, Loan_Amount, IP_Address,Add_Comment,Allocation_Date, Employment_Status,EMI_Paid,CC_Holder, Card_Vintage, Total_Experience, Years_In_Company FROM Req_Feedback_Bidder_PL,Req_Loan_Personal WHERE (Req_Feedback_Bidder_PL.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder_PL.BidderID in (".$tatacappl[$k].") and Req_Feedback_Bidder_PL.Reply_Type=1 and Req_Feedback_Bidder_PL.Allocation_Date Between '".($min_date)."' and '".($max_date)."')";
			 }
	$search_result=ExecQuery($citifinquery);
	$recordcount = mysql_num_rows($search_result);
	echo "i m in else".$citifinquery."<br><br>";

	while($row_result=mysql_fetch_array($search_result))
	{	
		if(strlen($row_result["BidderID"])>0)
		{
			if($row_result["BidderID"]=="5247")
			{
				$smname="Umesh Kumar Adhikari";
			}
			elseif($row_result["BidderID"]=="5250")
			{
				$smname="Suyesh Dubey";
			}
			elseif($row_result["BidderID"]=="5235" || $row_result["BidderID"]=="5236")
			{
				$smname="Nirav Joshi";
			}
			elseif($row_result["BidderID"]=="5319")
			{
				$smname="Sandeep Pawar";
			}
			elseif($row_result["BidderID"]=="5237")
			{
				$smname="Shishir";
			}
			elseif($row_result["BidderID"]=="5243")
			{
				$smname="Mahendra Puppala";
			}
			elseif($row_result["BidderID"]=="5241")
			{
				$smname="Deepak Raj";
			}
			elseif($row_result["BidderID"]=="5242")
			{
				$smname="Harsh Vardhan Pandey";
			}
			elseif($row_result["BidderID"]=="5714")
			{
				$smname="Ashutosh";
			}
			elseif($row_result["BidderID"]=="5240")
			{
				$smname="Neeraj Kumar";
			}
			elseif($row_result["BidderID"]=="5320")
			{
				$smname="Manish wadhwani";
			}
			elseif($row_result["BidderID"]=="5245")
			{
				$smname="Amit Roy";
			}
			elseif($row_result["BidderID"]=="5321")
			{
				$smname="Mantosh Rout";
			}
			elseif($row_result["BidderID"]=="5239")
			{
				$smname="Puneet Jain";
			}
		}

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
		
	$qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, pincode, doe, card_vintage, card_limit,ip_address,add_comment,bidderid ) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$row_result["City"]."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$residential_status."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."',  '".$row_result["Pincode"]."', '".$row_result["Allocation_Date"]."', '".$card_vintage."', '".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$row_result["Add_Comment"]."','".$smname."')";
		$result1=ExecQuery($qry1);
		 }
	
	$emailid=getReqemailValue($tatacappl[$k]);
	$cityname=getReqcityValue($tatacappl[$k]);
	
	$qry="select name AS Name, email AS Emailid, mobile_number AS MobileNo, dob AS DOB, emp_status AS Occupation, c_name AS Company_Name, city AS City, city_other AS OtherCity, year_in_comp AS CurrentExp, total_exp AS TotalExp,  net_salary AS AnnualIncome, residential_status AS ResiStatus, loan_any AS LoanAny, emi_paid AS EMIPaid, cc_holder AS CardHolder ,card_vintage AS CardVintage, loan_amount AS LoanAmount, pincode AS Pincode, doe AS DateOfEntry, ip_address AS IPaddress, bidderid AS SMName from temp where session_id='".$session_id."' order by doe DESC ";		
	
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
	$newToday = date('d')."".date('m')."".date('y');

	// Open the file and erase the contents if any
	$newfileatt = "/home/deal4loans/public_html/pldwnld/tatacapital".$cityname."".$newToday.".xls";
	//echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
if($recordcount>0)
			 {
	sendexcelfileattachment( $emailid,$session_id, $emailid,$cityname);
			 }
		 }		 
	}

	function sendexcelfileattachment($emailid,$session_id,$emailid,$cityname)
	{
		$newToday = date('d')."".date('m')."".date('y');
		$to = $emailid; 
		//$to="ranjana5chauhan@gmail.com";
	     $from = "Deal4loans <no-reply@deal4loans.com>"; 
        $subject = "Personal Loan Leads @ deal4loans.com ".$cityname."".$newToday; 
       $fileatt = "/home/deal4loans/public_html/pldwnld/tatacapital".$cityname."".$newToday.".xls";
        $fileatttype = "application/xls"; 
        $fileattname = "tatacapital".$cityname."".$newToday.".xls";
           
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		$headers .= "Cc: swastika.biswas@deal4loans.com,shweta.sharma@deal4loans.com,balbir.singh@deal4loans.com"."\n";		   
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

	//$to="ranjana5chauhan@gmail.com";

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
	retrivedatafortata();
}
?>