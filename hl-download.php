<?
	session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	
	$session_id=session_id();
	$qry1=$_POST["qry1"];
	
	$qry1=str_replace("\'", "'", $qry1);
	
	 list($recordcount,$row_result)=MainselectfuncNew($qry1,$array = array());
		$cntr=0;
	
	
	while($cntr<count($row_result))
        {
		$Biddername="";
		$biddername = "select  Bidder_Name from Bidders_List where BidderID in (".$row_result[$cntr]["Bidderid_Details"].") ";
	 list($numbidderresult,$row)=MainselectfuncNew($biddername,$array = array());
	$i = 0;
	if(($numbidderresult)>0)
	{
		while($i<count($row))
        {
			$Biddername[]=$row[$i]["Bidder_Name"];
		$i = $i +1;}
	}
			
	$eligiblebidder=implode(',', $Biddername);
	?>
	<?
	 $BidderID="";
	
	$BiddersChurn="SELECT Bidder_Name FROM Req_Feedback_Bidder1 LEFT OUTER JOIN Bidders_List ON Bidders_List.BidderID = Req_Feedback_Bidder1.BidderID WHERE AllRequestID = '".$row_result[$cntr]["RequestID"]."' AND Bidders_List.Reply_Type =2";
	
	 list($NumRowBiddersChurnSql,$newrow)=MainselectfuncNew($BiddersChurn,$array = array());
		$j=0;
	
	while($j<count($newrow))
        {
			$BidderID[]=$newrow[$j]["Bidder_Name"];
				$j = $j+1;
			}
	 $sentbidderarray=implode(',', $BidderID);
	 		
	$sentbidderarray="";
		
$dataInsert = array("session_id"=>$session_id, "bidderid"=>$row_result[$cntr]["BidderID"], "name"=>$row_result[$cntr]["Name"], "city"=>$row_result[$cntr]["City"], "city_other"=>$row_result[$cntr]["City_Other"], "mobile_number"=>$row_result[$cntr]["Mobile_Number"], "property_loc"=>$row_result[$cntr]["Property_Loc"], "property_value"=>$eligiblebidder, "property_type"=>$sentbidderarray);
$table = 'temp';
$insert = Maininsertfunc ($table, $dataInsert);

//		echo "<br>".$qry1;
	 $cntr=$cntr+1;
	 }



	$qry="select bidderid, name, mobile_number, city, city_other,property_loc, property_value AS EligibleBidder from temp where session_id='".$session_id."'";
		
	list($count,$row)=MainselectfuncNew($qry,$array = array());
		$p=0;
	
		
	 $field_names = getFieldNames($qry);	
	
	$header="";
	$data="";

	for ($i = 0; $i < $count; $i++){
		$header .= $field_names($row[$p], $i)."\t";
	}
	
	while($p<count($row))
        {
	  $line = '';
	  foreach($row[$p] as $value){
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
	$p = $p +1;}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	  $data = str_replace("\r", "", $data);
	
	
	# Nice to let someone know that the search came up empty.
	# Otherwise only the column name headers will be output to Excel.
	if ($data == "") {
	  $data = "\nno matching records found\n";
	}
	
	//echo $data;
	///exit();
	
	# This line will stream the file to the user rather than spray it across the screen
	header("Content-type: application/octet-stream");
	
	# replace excelfile.xls with whatever you want the filename to default to
	header("Content-Disposition: attachment; filename=data.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo $header."\n".$data; 
	
	//Delete data from the temp table
	$qry1="delete from `temp` where session_id='".$session_id."'";
	  $deleterowcount=Maindeletefunc($qry1,$array = array());
	//*/


?>
