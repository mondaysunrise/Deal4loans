<?php
require 'scripts/db_init.php';
require 'scripts/functions_nw.php';

function DetermineAgeFromDOB ($YYYYMMDD_In)
{	  $yIn=substr($YYYYMMDD_In, 0, 4);	  $mIn=substr($YYYYMMDD_In, 4, 2);	  $dIn=substr($YYYYMMDD_In, 6, 2);	  $ddiff = date("d") - $dIn;	  $mdiff = date("m") - $mIn;	  $ydiff = date("Y") - $yIn;	  if ($mdiff < 0)	  {		$ydiff--;	  } elseif ($mdiff==0)	  {		if ($ddiff < 0)		{		  $ydiff--;		}	  }	  return $ydiff;	}


function hdfclife_li()
{
$yesterday  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
$Today = date("Y-m-d", $yesterday); 
//$Today="2014-03-28";
$min_date=$Today." 00:00:00";
$max_date=$Today." 23:59:59";

echo $query1="select RequestID, Dated from Req_Compaign Where (Bank_Name='hdfclife' and Compaign_ID=4743)";
echo "<br>";
$result = ExecQuery($query1);
$qrow = mysql_fetch_array($result);
$RequestID = $qrow['RequestID'];
$Dated = $qrow['Dated'];
//$Dated="2014-03-28";

$Dated = date("Y-m-d")." 00:00:00";
//374669
//327938
if($RequestID>0)
{
$search_query = "select * from hdfclife_compleads  where (hdfclife_city in ('Ahmedabad','Bangalore','Bhubaneswar','Chandigarh','Chennai','Coimbatore','Delhi','Gurgaon','Noida','Gaziabad','Guwahati','Hyderabad','Indore','Kochi','Kolkata','Lucknow','Mumbai','','Pune','Vishakapatnam') and hdfclife_income>=300000 and  (hdfclife_dated >='".$Dated."' and hdfclifeid>'".$RequestID."'))";
	
}
else
{
$search_query = "select * from hdfclife_compleads where (hdfclife_city in ('Ahmedabad','Bangalore','Bhubaneswar','Chandigarh','Chennai','Coimbatore','Delhi','Gurgaon','Noida','Gaziabad','Guwahati','Hyderabad','Indore','Kochi','Kolkata','Lucknow','Mumbai','','Pune','Vishakapatnam') and hdfclife_income>=300000 and (hdfclife_dated between '".$min_date."' and '".$max_date."'))";
}
//$search_query = "select * from hdfclife_compleads  where (hdfclifeid ='42473')";

echo "Sql - ".$search_query."<br>";
list($recorcount,$result)=MainselectfuncNew($search_query,$array = array());
	echo  $recorcount."<br>";
	
	//$recorcount = 1;
//	$recorcount = 0;
if($recorcount>0)
{
	//while($row = mysql_fetch_array($result))
	for($j=0;$j<$recorcount;$j++)
	{

		$RequestID= $result[$j]['hdfclifeid']; //$row["Feedback_ID"];
		$first = $result[$j]['hdfclife_name']; //$row["Name"];
		$mobile= $result[$j]['hdfclife_mobile_number']; //$row["Phone"];
		$dob= $result[$j]['hdfclife_dob']; //$row["DOB"];
		$email= $result[$j]['hdfclife_email']; //$row["Email"];
		$city= $result[$j]['hdfclife_city'];
		$Pincode= '';
		$Net_Salary= $result[$j]['hdfclife_income'];
		 	$trim_age = str_replace("-", "", $dob);
		$age = DetermineAgeFromDOB($trim_age);
		
		$dated = $result[$j]['hdfclife_dated']; //$row["Allocation_Date"];
		$param["Userid"] = "Serco";
		$param["pwd"] = "serco@123";
		$param["SourceId"] = "3";
		$param["PolicyNo"] = "";
		$param["FirstName"] = $first;
		$param["LastName"] = "";
		$param["Address"] = "BimaDeals";
		$param["PinCode"] = $Pincode;
		$param["City"] = $city;
		$param["Mobile"] = $mobile;
		$param["Phone1"] = "";		
		$param["Phone2"] = "";
		$param["Gender"] = ""; 
		$param["DOB"] = $dob;
		$param["Married"] = "";
		$param["Age"] =$age;
		$param["PolicyName"] = "D4L";
		$param["Income"] = $Net_Salary;	 
		//print_r($param);
$request = '';
	foreach($param as $key=>$val) //traverse through each member of the param array
	{ 
	  $request.= $key."=".urlencode($val); //we have to urlencode the values
	  $request.= "&"; //append the ampersand (&) sign after each paramter/value pair
	}
	$request = substr($request, 0, strlen($request)-1); //remove the final ampersand sign from the request
//http://115.113.224.164/tadpushdata/tadpushdatalogic.aspx
	$host = "115.113.224.164";
			$script = "//tadpushdata/tadpushdatalogic.aspx";
			$request_length = strlen($request);
			$method = "GET"; // must be POST if sending multiple messages
			if ($method == "GET") 
			{
			  $script .= "?$request";
			}
			$header = "$method $script HTTP/1.1\r\n";
			$header .= "Host: $host\r\n";
			$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$header .= "Content-Length: $request_length\r\n";
			$header .= "Connection: close\r\n\r\n";
			$header .= "$request\r\n";
		
			//echo $header;
			//echo "<br>";
		
			//Now we open up the connection
			$socket = @fsockopen($host, 80, $errno, $errstr); 
			if ($socket) //if its open, then...
			{ 
			  fputs($socket, $header); // send the details over
			  while(!feof($socket))
			  {
				$output[] = fgets($socket); //get the results 
			  }
			  fclose($socket); 
			}
			echo "<br>fddsd - "; 
	print_r($output);
		$Dated = ExactServerdate();		
			echo "<br>";	
		
		$data = array("leadid"=>$RequestID , "product"=>'1', "feedback"=>$output[11], "bidderid"=>'1176',  "doe"=>$Dated );
		$insert = Maininsertfunc ('webservice_bidder_details', $data);	
		
		
		$DataArray = array("RequestID"=>$RequestID, "Dated"=>$Dated );
		$wherecondition ="(Compaign_ID='4743')";
		Mainupdatefunc ('Req_Compaign', $DataArray, $wherecondition);

			echo "<br>";
	}


		
}
}

main();
function main()
{
	hdfclife_li();

}
?>