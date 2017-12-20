<?
session_start();	

	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
//echo "hello".$_SESSION['BidderID'];
	$qry1=$_POST["qry1"];
	$qry2=$_POST["qry2"];
	//$value=explode(",", $_POST["qry2"]);
       // $qry2=$value[1];
//echo "gff=".$qry2;
       
    $mindate=$_POST["min_date"];
	$maxdate=$_POST["max_date"];
	
	
	$qry1=str_replace("\'", "'", $qry1);
	
		list($recordcount,$row)=MainselectfuncNew($qry1,$array = array());
		$i=0;
	
	      
	while($i<count($row))
        {
		$id = $row[$i]["id"];
			$address_apt  = $row[$i]["address_apt"]; 
			$RequestID = $row[$i]["RequestID"]; 
			$appdate  = $row[$i]["appdate"]; 
			$changeapp_time  = $row[$i]["changeapp_time"];
			$docs = $row[$i]["docs"]; 
			$Reply_Type = $row[$i]["Reply_Type"]; 
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
		list($recordcount,$getrow)=MainselectfuncNew($getBiddersSql,$array = array());
		$cntr=0;
		
		//echo "<br>".$getBiddersSql."<br>";	
		$BidID = $getrow[$cntr]['BidderID'];
		//echo "<br>".$BidderID;
		$getCustomerSql = "select * FROM Req_Loan_Personal where  RequestID = '".$RequestID."' ";
		list($recordcountRow,$Arrrow)=MainselectfuncNew($getCustomerSql,$array = array());
		$j=0;

		$Name = $Arrrow[$j]['Name'];
		$Mobile_Number = $Arrrow[$j]['Mobile_Number'];
		$City = $Arrrow[$j]['City'];
		if($City=="Others")
		{
			$City = $Arrrow[$j]['City_Other'];
		}
		
		$getBidderSql = "select * FROM Bidders where  BidderID = '".$BidID."' ";
			
		list($recordcount,$Myrow)=MainselectfuncNew($getBidderSql,$array = array());
		$k=0;
		
		$BidderName = $Myrow[$k]['Bidder_Name'];
	
		$getSmsSql = "SELECT * FROM `Req_Compaign` where BidderID = '".$BidID."'";	
	list($recordcount,$MyrowSms)=MainselectfuncNew($getSmsSql,$array = array());
		$s=0;
		
		$BidMobile_no = $MyrowSms[$s]['Mobile_no'];
	
		$aptTime = $appdate.' - '.$time;
		$dataInsert = array("session_id"=>$session_id, "name"=>$BidID, "dob"=>$BidderName, "email"=>$BidMobile_no, "emp_status"=>$Name, "c_name"=>$Mobile_Number, "city"=>$City, "city_other"=>$address_apt, "year_in_comp"=>$aptTime, "total_exp"=>$docs);
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);
	
		
					$i=$i+1;
	}
	

		$qry="select  name as BidderID, dob as BidderName, email as BidderMobile, emp_status as Name, c_name as MobileNumber, city as City, city_other as Address, year_in_comp as AppointmentTime, total_exp as Documents from temp where session_id='".$session_id."' order by doe DESC";
	
	
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
?>