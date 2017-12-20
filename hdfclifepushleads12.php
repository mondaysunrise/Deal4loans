<?php
//This file not in use
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
	list($nurows,$qrow)=Mainselectfunc($query1,$array = array());
$RequestID = $qrow['RequestID'];
$Dated = $qrow['Dated'];
//$Dated="2014-03-28";

$Dated = date("Y-m-d")." 00:00:00";
//374669
//327938
if($RequestID>0)
{
$search_query = "select * from hdfclife_compleads  where (hdfclife_dated >='".$Dated."' and hdfclifeid>'".$RequestID."')";
	
}
else
{
$search_query = "select * from hdfclife_compleads where (hdfclife_dated between '".$min_date."' and '".$max_date."')";
}
$search_query = "select * from hdfclife_compleads  where (hdfclifeid in (42362,42363,42364,42365,42366,42367,42368,42369,42370,42371,42372,42373,42374,42375,42376,42377,42378,42379,42380,42381,42382,42383,42384,42385,42386,42387,42388,42389,42390,42391,42392,42393,42395,42396,42397,42398,42399,42400,42401,42402,42403,42404,42405,42406,42407,42408,42409,42410,42411,42413,42414,42415,42416,42417,42418,42419,42420,42421,42422,42423,42424,42425,42426,42427,42428,42429,42430,42432,42433,42434,42435,42436,42437,42438,42439,42440,42441,42443,42444,42445,42446,42447,42448,42449,42450,42451,42453,42454,42455,42456,42474,42475,42476,42477,42478,42479,42480,42481,42482,42483,42485,42486,42487,42488,42489,42490,42491,42492,42493,42494,42495,42496,42497,42498,42499,42500,42501,42502,42503,42504,42505,42506,42507,42508,42509,42510,42511,42513,42514,42515,42516,42517,42518,42519,42520,42521,42522,42523,42524,42525,42526,42527,42528,42529,42530,42531,42532,42533,42534,42535,42536,42537,42539,42540,42541,42542,42543,42544,42545,42546,42547,42548,42549,42550,42551,42552,42553,42554,42555,42556,42557,42558,42757,42758,42974))";

echo "Sql - ".$search_query."<br>";
list($recorcount,$result)=MainselectfuncNew($search_query,$array = array());

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