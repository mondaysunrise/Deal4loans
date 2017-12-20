<?
session_start();	
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	$session_id=session_id();
	$qry1=$_POST["qry1"];
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
		
	$qry1=str_replace("\'", "'", $qry1);
    $exclusiveLead = '';

	list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());

	for($i=0;$i<$recordcount;$i++)
	{
		$tugetdetails ="Select * from icici_pl_cibili_check where icicirequestID=".$row_result[$i]["icicirequestID"];
	  list($turowcount,$rowtu)=Mainselectfunc($tugetdetails,$array = array());
 	$identification_proof = $row_result[$i]["identification_proof"].",";
		 	$salary_proof = $row_result[$i]["salary_proof"].",";
		$experience_proof = $row_result[$i]["experience_proof"].",";
		$bankstat_proof = $row_result[$i]["bankstat_proof"].",";

if($row_result[$i]["cuurentadd_proof"]=="0") {$cuurentadd_proof="";}
 elseif($row_result[$i]["cuurentadd_proof"]=="1") { $cuurentadd_proof="Water Bill";}
 elseif($row_result[$i]["cuurentadd_proof"]=="2") { $cuurentadd_proof="Electricity Bill";}
 elseif($row_result[$i]["cuurentadd_proof"]=="3") { $cuurentadd_proof="LL/Postpaid Phone (Not Broadband) Bill";}
 elseif($row_result[$i]["cuurentadd_proof"]=="4") { $cuurentadd_proof="House Tax Receipt";}
 elseif($row_result[$i]["cuurentadd_proof"]=="5") { $cuurentadd_proof="Gas Bill";}

		$Documents = $identification_proof."".$salary_proof."".$experience_proof."".$bankstat_proof."".$cuurentadd_proof;
$campaign="Deal4Loans";
$LoginCode="WRS Info India Pvt Ltd";
$pickupsource="Andro";
$month = Date('F');

		$dataInsert = array('session_id'=>$session_id, 'source'=>$campaign, 'referred_page'=>$LoginCode, 'name'=>$row_result[$i]['Name'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'c_name'=>$row_result[$i]['Company_Name'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'city'=>$row_result[$i]['City'], 'is_processed'=>$rowtu["appointment_place"], 'address_apt'=>$rowtu["appointment_address"], 'Documents'=>$Documents, 'add_comment'=>$row_result[$i]['Add_Comment'], 'loan_time'=>$rowtu["appointment_time"], 'constitution'=>$pickupsource, 'doe'=>$row_result[$i]['Dated'], 'apt_dt'=>$rowtu['appointment_date'], 'residential_status'=>$rowtu['PLResult'], 'count_views'=>$month);
	$table = 'temp';
			$insert = Maininsertfunc ($table, $dataInsert);	
			}			
$qry="select  source AS Campaign,referred_page AS LoginCode,residential_status AS CibilStatus,count_views AS Month,name AS CustomerName, mobile_number AS ContactNo, c_name AS CompanyName, net_salary AS NetAnnualIncome, loan_amount AS LoanAmount, city AS Location, is_processed AS ApptPlace, address_apt AS ApptAddress, Documents, add_comment AS Remarks, loan_time AS ApptTime, constitution AS PickupSource, doe AS LeadDate, apt_dt AS ApptDate  from temp where session_id='".$session_id."' order by doe DESC";
//echo $qry."<br>";
	//Written by Dan Zarrella. Some additional tweaks provided by JP Honeywell
	//pear excel package has support for fonts and formulas etc.. more complicated
	//this is good for quick table dumps (deliverables)
	$header="";
	$data="";
	list($num_rows,$myrow)=MainselectfuncNew($qry,$array = array());
	$dataBidder = array('BidderID'=>$_SESSION['BidderID'], 'BidderName'=>$_SESSION['UName'], 'BidderProduct'=>$_SESSION['ReplyType'], 'BidderTable'=>$qry2, 'BidderSession'=>$session_id, 'NoofRecords'=>$num_rows, 'Dated'=>$Dated, 'MinDate'=>$mindate, 'MaxDate'=>$maxdate);
    Maininsertfunc ("BidderDownloadCount", $dataBidder);	
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
?>
