<?php
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions_nw.php';
if (!empty($_SERVER['REMOTE_ADDR']))
{
        exit; 
}
else
{
	main();
}
	function getReqemailValue($pKey){
    $titles = array(
		'5752' => 'leads.agra@lichflfinserv.com',
		'5753,6506' => 'leads.blor@lichflfinserv.com',
		'5754' => 'leads.blga@lichflfinserv.com',
		'5755' => 'leads.bhop@lichflfinserv.com',
		'5756' => 'leads.bbnw@lichflfinserv.com',
		'5757' => 'leads.chna@lichflfinserv.com',
		'6286' => 'leads.chna@lichflfinserv.com',
		'5758' => 'leads.cbtr@lichflfinserv.com',
		'5759' => 'leads.ndel@lichflfinserv.com',
		'5760' => 'leads.erkl@lichflfinserv.com',
		'5761' => 'leads.gntu@lichflfinserv.com',
		'5762' => 'leads.grgo@lichflfinserv.com',
		'5763' => 'leads.hosu@lichflfinserv.com',
		'5764' => 'leads.hdba@lichflfinserv.com',
		'5765' => 'leads.indr@lichflfinserv.com',
		'5766' => 'leads.japu@lichflfinserv.com',
		'5767' => 'leads.jdhp@lichflfinserv.com',
		'5768,6505' => 'leads.klkt@lichflfinserv.com',
		'5769' => 'leads.lkno@lichflfinserv.com',
		'5770' => 'leads.mdra@lichflfinserv.com',
		'5771' => 'leads.mumb@lichflfinserv.com',
		'5772' => 'leads.mysr@lichflfinserv.com',
		'5773' => 'leads.ngpu@lichflfinserv.com',
		'5774' => 'leads.nasi@lichflfinserv.com',
		'5775' => 'leads.nlor@lichflfinserv.com',
		'5776' => 'leads.noid@lichflfinserv.com',
		'5777' => 'leads.ptna@lichflfinserv.com',
		'5778' => 'leads.pune@lichflfinserv.com',
		'5779' => 'leads.rjhr@lichflfinserv.com',
		'5780' => 'leads.sale@lichflfinserv.com',
		'5781' => 'leads.hdba2@lichflfinserv.com',
		'5782' => 'leads.trch@lichflfinserv.com',
		'5783' => 'leads.triv@lichflfinserv.com',
		'5784,6089' => 'leads.vash@lichflfinserv.com',
		'5785' => 'leads.vell@lichflfinserv.com',
		'5786' => 'leads.vjwd@lichflfinserv.com',
		'5787' => 'leads.vskp@lichflfinserv.com',
		'6297' => 'leads.mumb@lichflfinserv.com',
		'6393' => 'leads.blor@lichflfinserv.com',
		'7600' => 'leads.dehra@lichflfinserv.com',
		'5788' => 'pankaj.pol@lichflfinserv.com,rohan@lichflfinserv.com,harshita.jain@deal4loans.com,shweta.sharma@deal4loans.com,rajiv.prasad@deal4loans.com'
		 );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

  function getReqcityValue($pKey){
    $titles = array(
		'5752' => 'AGRA',
		'5753' => 'BANGALORE',
		'5754' => 'BELGAUM',
		'5755' => 'BHOPAL',
		'5756' => 'BHUBANESHWAR',
		'5757' => 'CHENNAI',
		'6286' => 'CHENNAI II',
		'5758' => 'COIMBATORE',
		'5759' => 'DELHI',
		'5760' => 'ERNAKULAM',
		'5761' => 'GUNTUR',
		'5762' => 'GURGAON',
		'5763' => 'HOSUR',
		'5764' => 'HYDERABAD',
		'5765' => 'INDORE',
		'5766' => 'JAIPUR',
		'5767' => 'JODHPUR',
		'5768' => 'KOLKATTA',
		'5769' => 'LUCKNOW',
		'5770' => 'MADURAI',
		'5771' => 'MUMBAI',
		'5772' => 'MYSORE',
		'5773' => 'NAGPUR',
		'5774' => 'NASIK',
		'5775' => 'NELLORE',
		'5776' => 'NOIDA',
		'5777' => 'PATNA',
		'5778' => 'PUNE',
		'5779' => 'RAJAHMUNDRY',
		'5780' => 'SALEM',
		'5781' => 'SECUNDRABAD',
		'5782' => 'TRICHY',
		'5783' => 'TRIVANDRUM',
		'5784,6089' => 'VASHI',
		'5785' => 'VELLORE',
		'5786' => 'VIJAYAWADA',
		'5787' => 'VISHAKHAPATNAM',
		'6297' => 'THANE',
		'6393' => 'BANGALORE II',
		'6505' => 'KOLKATA II',
		'6506' => 'FARIDABAD',
        '6598' => 'Chandigarh',
        '7110' => 'Meerut',
        '7111' => 'Raipur',
        '7600' => 'Dehradun',

		'5788' => 'Consolidated'
		 );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;
    return "";
  }

function retrivedatafortata()
{
	$session_id=session_id();
	$Today=Date('Y-m-d');
	//$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
	//$Today=date('Y-m-d',$tomorrow);
	$min_date=$Today." 00:00:00";
	$max_date=$Today." 23:59:59";
	$hdfchl = array('5752','5753','5754','5755','5756','5757','6286','5758','5759','5760','5761','5762','5763','5764','5765','5766','5767','5768','5769','5770','5771','5772','5773','5774','5775','5776','5777','5778','5779','5780','5781','5782','5783','5784,6089','5785','5786','5787','6297','6393','5788','7600');

	for($k=0;$k<count($hdfchl);$k++)
	{
	 	if($hdfchl[$k]==5788)
		{
			$citifinquery="SELECT Name,DOB,Email, Mobile_Number,Std_Code, Landline,Company_Name,City, City_Other,Pincode, Net_Salary, Loan_Any, Loan_Amount, IP_Address,Add_Comment,Allocation_Date, Employment_Status,AllRequestID,BidderID FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE (Req_Feedback_Bidder_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in (5752,5753,5754,5755,5756,5757,6286,5758,5759,5760,5761,5762,5763,5764,5765,5766,5767,5768,5769,5770,5771,5772,5773,5774,5775,5776,5777,5778,5779,5780,5781,5782,5783,5784,5785,5786,5787,6089,6297,6393,6471,6472,6473,6505,6506,6598,7110,7111,7600) and Req_Feedback_Bidder_HL.Reply_Type=2 and Req_Feedback_Bidder_HL.Allocation_Date Between '".($min_date)."' and '".($max_date)."')";
		}
		else
		{
			$citifinquery="SELECT Name,DOB,Email, Mobile_Number,Std_Code, Landline,Company_Name,City, City_Other,Pincode, Net_Salary, Loan_Any, Loan_Amount, IP_Address,Add_Comment,Allocation_Date, Employment_Status,AllRequestID,BidderID FROM Req_Feedback_Bidder_HL,Req_Loan_Home WHERE (Req_Feedback_Bidder_HL.AllRequestID=Req_Loan_Home.RequestID and Req_Feedback_Bidder_HL.BidderID in (".$hdfchl[$k].") and Req_Feedback_Bidder_HL.Reply_Type=2 and Req_Feedback_Bidder_HL.Allocation_Date Between '".($min_date)."' and '".($max_date)."')";
		}
		$search_result=ExecQuery($citifinquery);
		$recordcount = mysql_num_rows($search_result);
		//echo "i m in else".$citifinquery."<br><br>";
$strCity="";
	while($row_result=mysql_fetch_array($search_result))
	{	
		$strBidderID=$row_result["BidderID"];
		if($row_result["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result["CC_Holder"]==0) { $cc_holder="No"; }
		if($row_result["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
		elseif($row_result["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
		elseif($row_result["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
		elseif($row_result["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
		else
		{ 
			$emi_paid="";
		}
		if($row_result["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
		elseif($row_result["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
		elseif($row_result["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
		elseif($row_result["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
		else
		{
			$card_vintage="";
		}
		if($row_result["City"]=="Others" && strlen($row_result["City_Other"])>0)
		{
			$strCity=$row_result["City_Other"];
		}
		else
		{
			$strCity=$row_result["City"];
		}
		if($hdfchl[$k]==5788)
		{
			$comment="DEAL 4 LOANS.COM";
		}
		else
		{
			$comment=$row_result["Add_Comment"];
		}
		
		if($strCity=="Hubli")
		{
			$strFSL="BELGAUM";
		}
		elseif($strCity=="Mumbai" && $strBidderID=="5771")
		{
			$strFSL="MUMBAI";
		}
		elseif($strCity=="Vashi" || $strCity=="Navi Mumbai" || $strCity=="Thane" || ($strCity=="Mumbai" && $strBidderID=="6089"))
		{
			$strFSL="NAVI MUMBAI";
		}
		elseif(($strCity=="Thane" || $strCity=="Mumbai" || $strCity=="Navi Mumbai") && $strBidderID=="6297")
		{
			$strFSL="THANE";
		}
		elseif($strCity=="Hyderabad")
		{
			$strFSL="HYDERABAD I";
		}
		elseif($strCity=="Secundrabad" || $strCity=="Secunderabad")
		{
			$strFSL="HYDERABAD II";
		}
		elseif($strCity=="Delhi")
		{
			$strFSL="NEW DELHI";
		}
		elseif($strCity=="Vishakapatanam" || $strCity=="Vizag")
		{
			$strFSL="VISHAKHAPATNAM";
		}
		elseif($strCity=="Trivandrum")
		{
			$strFSL="THIRUVANANTHAPURAM";
		}
		elseif($strCity=="Gaziabad" || $strCity=="Ghaziabad")
		{
			$strFSL="NOIDA";
		}
		else
		{
			$strFSL=strtoupper($strCity);
		}
		if($strBidderID==5781)
		{
			$strFSL="HYDERABAD II";
		}
	if($strBidderID==6286)
		{
			$strFSL="Chennai II";
		}
 if($strBidderID==5754)
		{
			$strFSL="Belgaum";
		}
	if($strBidderID==5759)
		{
			$strFSL="New Delhi";
		}
	if($strBidderID=="6297")
		{
			$strFSL="Thane";
		}
		if($strBidderID=="6393")
		{
			$strFSL="BANGALORE II";
		}
	if($strBidderID=="5776")
		{
			$strFSL="NOIDA";
		}
		if($strBidderID=="5762")
		{
			$strFSL="GURGAON";
		}
		if($strBidderID=="5773")
		{
			$strFSL="NAGPUR";
		}
		if($strBidderID=="5756")
		{
		    $strFSL="BHUBANESHWAR";
		}
		if($strBidderID=="6471")
		{
			$strFSL="SURAT";
		}
        if($strBidderID=="6472")
		{
			$strFSL="AHMEDABAD";
		}
        if($strBidderID=="6473")
		{
			$strFSL="VADODARA";
		}
		if($strBidderID=="6505")
		{
			$strFSL="KOLKATA II";
		}
		if($strBidderID=="6506")
		{
			$strFSL="FARIDABAD";
		}
        if($strBidderID=="6598")
		{
			$strFSL="CHANDIGARH";
		}
		 if($strBidderID=="5775")
		{
			$strFSL="NELLORE";
		}
		if($strBidderID=="5763")
		{
			$strFSL="HOSUR";
		}
		if($strBidderID=="5760")
		{
			$strFSL="ERNAKULAM";
		}
     
        if($strBidderID=="5752")
		{
			$strFSL="AGRA";
		}
        if($strBidderID=="5779")
		{
			$strFSL="RAJAMUNDRY";
		}
		if($strBidderID=="7110")
		{
			$strFSL="MEERUTt";
		}
        if($strBidderID=="7111")
		{
			$strFSL="RAIPUR";
		}
		if($strBidderID=="5777")
		{
			$strFSL="PATNA";
		}
        if($strBidderID=="5787")
		{
			$strFSL="VISHAKHAPATNAM";
		}
        if($strBidderID=="7600")
		{
			$strFSL="DEHRADUN";
		}









    $qry1="insert into temp (session_id, name, dob, email, emp_status, c_name, city, city_other, year_in_comp, total_exp, mobile_number, net_salary, residential_status, loan_any, emi_paid, cc_holder, loan_amount, pincode, doe, card_vintage, card_limit,ip_address,add_comment,request_id,property_type ) values ('".$session_id."', '".$row_result["Name"]."', '".$row_result["DOB"]."', '".$row_result["Email"]."', '".$emp_status."', '".$row_result["Company_Name"]."', '".$strCity."', '".$row_result["City_Other"]."', '".$row_result["Years_In_Company"]."', '".$row_result["Total_Experience"]."', '".$row_result["Mobile_Number"]."', '".$row_result["Net_Salary"]."', '".$residential_status."', '".$row_result["Loan_Any"]."', '".$emi_paid."', '".$cc_holder."', '".$row_result["Loan_Amount"]."',  '".$row_result["Pincode"]."', '".$row_result["Allocation_Date"]."', '".$card_vintage."', '".$row_result["Card_Limit"]."','".$row_result["IP_Address"]."','".$comment."','".$row_result["AllRequestID"]."','".$strFSL."')";
		$result1=ExecQuery($qry1);
	}
	
	$emailid=getReqemailValue($hdfchl[$k]);
	$cityname=getReqcityValue($hdfchl[$k]);
	
	if($hdfchl[$k]==5788)
		{
			$qry="select property_type AS FSLTO, city AS PROPERTY_CITY_NAME, request_id AS LEAD_ID, add_comment AS LEAD_SOURCE, name AS CUSTOMER_Name, mobile_number AS MOBILE_NO, email AS EMAIL_ID from temp where session_id='".$session_id."' order by doe DESC ";
		}
		else
		{
	$qry="select name AS Name, email AS Emailid, mobile_number AS MobileNo, dob AS DOB, emp_status AS Occupation, c_name AS Company_Name, city AS City, city_other AS OtherCity, net_salary AS AnnualIncome, residential_status AS ResiStatus, loan_amount AS LoanAmount, pincode AS Pincode, doe AS DateOfEntry, ip_address AS IPaddress from temp where session_id='".$session_id."' order by doe DESC ";
		}	
	
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
	$newfileatt = "/home/deal4loans/public_html/hldwnld/lic5788".$cityname."".$newToday.".xls";
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
		//$to = 'santoshk.php@gmail.com';
		$to = $emailid; 
		$from = "Deal4loans <no-reply@deal4loans.com>"; 
		$subject = "Home Loan Leads @ deal4loans.com ".$cityname."".$newToday; 
		$fileatt = "/home/deal4loans/public_html/hldwnld/lic5788".$cityname."".$newToday.".xls";
		$fileatttype = "application/xls"; 
		$fileattname = "lic5788".$cityname."".$newToday.".xls";
           
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
		//$headers .= "Cc: rajiv.prasad@deal4loans.com"."\n";		   
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



function main()
{
	retrivedatafortata();
}
?>