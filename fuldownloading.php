<?
session_start();	
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
		
	$qry1=str_replace("\'", "'", $qry1);
 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());


	for($i=0;$i<$recordcount;$i++)
	{
		if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
	
	$Net_Salary=$row_result[$i]["Net_Salary"];
	if($row_result[$i]["Annual_Turnover"]==1) { $annual_turnover="0-40 Lacs"; } 
else if($row_result[$i]["Annual_Turnover"]==2) { $annual_turnover="1Cr - 3Crs"; } 
else if($row_result[$i]["Annual_Turnover"]==3) { $annual_turnover="3Crs & above"; } 
else if($row_result[$i]["Annual_Turnover"]==4) { $annual_turnover="40Lacs To 1 Cr"; } 
else { $annual_turnover="";  }

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
if($_SESSION['BidderID']==4254)
		{
			$bidderdetails=$row_result[$i]["Bidderid_Details"];
		}
		else
		{
			$bidderdetails="";
		}


		$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$row_result[$i]['DOB'], 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'loan_any'=>$bidderdetails, 'emi_paid'=>$emi_paid, 'cc_holder'=>$cc_holder, 'card_vintage'=>$card_vintage, 'add_comment'=>$row_result[$i]['Add_Comment'], 'Feedback'=>$row_result[$i]['Feedback'], 'doe'=>$row_result[$i]['Updated_Date'], 'loan_amount'=>$row_result[$i]['Loan_Amount']);
		$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);

	}


	$qry="select  name, dob AS DOB, email AS Email, emp_status AS Occupation, c_name AS CompanyName, city AS City, city_other AS OtherCity,  mobile_number AS Mobileno, net_salary AS AnnualIncome, loan_any AS Loanrunning, emi_paid AS EmiPaid, cc_holder AS CCHolder, card_vintage AS CardVintage, loan_amount AS LoanAmt, add_comment AS Comments,Feedback, doe AS DOE  from temp where session_id='".$session_id."' order by doe DESC ";

//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
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
	  $data .= trim($line)."\n";
	}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	  $data = str_replace("\r", "", $data);
	
	
	# Nice to let someone know that the search came up empty.
	# Otherwise only the column name headers will be output to Excel.
	if ($data == "") {
	  $data = "\nno matching records found\n";
	}
	
	# This line will stream the file to the user rather than spray it across the screen
	header("Content-type: application/octet-stream");
	
	# replace excelfile.xls with whatever you want the filename to default to
	header("Content-Disposition: attachment; filename=data.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $header."\n".$data; 
	
	//Delete data from the temp table
	$qry1="delete from `temp` where session_id='".$session_id."'";
	Maindeletefunc($qry1,$array = array());
	//*/

?>
