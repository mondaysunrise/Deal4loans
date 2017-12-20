<?php
function redirectURL($rurl){
	header("Location: " . $rurl);
	exit;
}

function fun_db_output($str){
	return stripslashes($str);
}
function fun_db_input($str){
	$str = trim($str);
	if(!get_magic_quotes_gpc()){
		return addslashes($str);
	}else{
		return $str;
	}
}

////////////////////////////////////////
   function FixString($strtofix){
	/** ESCAPES SPECIAL CHARACTERS FOR INSERTING INTO SQL **/
	if (get_magic_quotes_gpc()) { $addslash="no"; } else { $addslash="yes"; }
	if ($addslash == "yes") {  $strtofix = addslashes($strtofix); }
	$strtofix = ereg_replace(  "<", "&#60;", $strtofix );
	$strtofix = ereg_replace(  "'", "&#39;", $strtofix );
	$strtofix = ereg_replace(  "(\n)", "<BR>", $strtofix );
	return $strtofix;
   }
//////////////////

function dateformat($date)
	{
		return $dated = date("d M, Y H:i:s",strtotime($date));
	}

function getInvoiceNo($invPrefix, $postFixOrderNo){
	$invoiceNo = $invPrefix . date("mdy");
	$postFixOrderNoLen = strlen($postFixOrderNo);
	if($postFixOrderNoLen==1){
		$invoiceNo .= "00000" . $postFixOrderNo;
	}elseif($postFixOrderNoLen==2){
		$invoiceNo .= "0000" . $postFixOrderNo;
	}elseif($postFixOrderNoLen==3){
		$invoiceNo .= "000" . $postFixOrderNo;
	}elseif($postFixOrderNoLen==4){
		$invoiceNo .= "00" . $postFixOrderNo;
	}elseif($postFixOrderNoLen==5){
		$invoiceNo .= "0" . $postFixOrderNo;
	}else{
		$invoiceNo .= $postFixOrderNo;
	}
	return $invoiceNo;
}

function fun_get_commas_values($str){ // if ,4,2,3,6, will be converted to 4,2,3,6
	$newStr = "";
	$str = trim($str);
	if(str!="" && strlen($str) > 2){
		$newStr = substr($str,1,strlen($str)-2);
	}
	return $newStr;
}


function fun_currency_format($curr=0){
	return number_format($curr, 2);
}
function fun_check_date($yyyy, $mm, $dd){
	$dateCode = array();
	if($mm < 1 || $mm > 12){
		$dateCode['code'] = false;
		$dateCode['codemsg'] = "The month date must be between 1 and 12!";
		return $dateCode;
	}
	if($dd < 1 || $dd > 31){
		$dateCode['code'] = false;
		$dateCode['codemsg'] = "The day date must be between 1 and 31!";
		return $dateCode;
	}
	if($dd==31 && ($mm==4 || $mm==6 || $mm==9 || $mm==11)){
		$dateCode['code'] = false;
		$dateCode['codemsg'] = "The month for your date doesn't have 31 days!";
		return $dateCode;
	}
	if($mm==2){
		$learYear = false;
		if($yyyy % 4 == 0 && ($yyyy % 100 != 0 || $yyyy % 400 == 0)){
			$learYear = true;
		}
		if($dd > 29 || ($dd==29 && !$learYear)){
			$dateCode['code'] = false;
			$dateCode['codemsg'] = "The month for your date doesn't have ".$dd." days for year ".$yyyy."!";
			return $dateCode;
		}
	}
	$dateCode['code'] = true;
	$dateCode['codemsg'] = "";
	return $dateCode;
}
function fun_create_number_options($startVal=0, $endVal=0, $selVal=''){
	$selected = "";
	for($i=$startVal; $i <= $endVal; $i++){
		if($i == $selVal && $selVal!=''){
			$selected = " selected";
		}else{
			$selected = "";
		}
		echo "<option value=\"".$i."\" ".$selected.">" . $i . "</option>\n";
	}
}
function fun_created_month_option($selVal=''){
	$monthsArray = array();
	$monthsArray['1'] = "January";
	$monthsArray['2'] = "February";
	$monthsArray['3'] = "March";
	$monthsArray['4'] = "April";
	$monthsArray['5'] = "May";
	$monthsArray['6'] = "June";
	$monthsArray['7'] = "July";
	$monthsArray['8'] = "August";
	$monthsArray['9'] = "September";
	$monthsArray['10'] = "October";
	$monthsArray['11'] = "November";
	$monthsArray['12'] = "December";
	foreach($monthsArray as $keys => $vals){
		if($keys == $selVal){
			$selected = " selected";
		}else{
			$selected = "";
		}
		echo "<option value=\"".$keys."\" ".$selected.">" . $vals . "</option>\n";
	}
}

function fun_getFileContent($fileName){
	$fileContent = "";
	
	$fp = fopen($fileName, "r");
	if($fp){
		$fileContent = fread($fp, filesize($fileName));
	}
	fclose($fp);
	return $fileContent;
}

function trimBodyText($theText, $lmt=70, $s_chr="\n", $s_cnt=1){
	  $pos = 0;
	  $trimmed = FALSE;
	  for($i=0; $i <= $s_cnt; $i++){
		  if($tmp = strpos($theText, $s_chr, $pos)){
			  $pos = $tmp;
			  $trimmed = TRUE;
		  }else{
			  $pos = strlen($theText);
			  $trimmed = FALSE;
			  break;
		  }
	  }
	  $theText = substr($theText, 0, $pos);
	  if(strlen($theText) > $lmt){
		  $theText = substr($theText, 0, $lmt);
		  $theText = substr($theText, 0, strrpos($theText, ' '));
		  $trimmed = TRUE;
	  }
	  if($trimmed){
		  $theText .= "...";
	  }
	  return $theText;
  }

function paginate($limit, $tot_rows){
	if($limit=="")
	{
	$limit=10;
	}
	 $numrows = $tot_rows;
	$pagelinks = "<div class=\"pagination\">";
	if($numrows > $limit){
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page = 1;
		}

		$currpage = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];
		$currpage = str_replace("&page=".$page,"",$currpage);

		if($page == 1){
			$pagelinks .= "<span class=\"disabled\"><< Previous </span>";
		}else{
			$pageprev = $page - 1;
			$pagelinks .= "<a class=\"pagelinks\" href=\"" . $currpage . "&page=". $pageprev . "\"><< Previous </a>";
		}

		$numofpages = ceil($numrows / $limit);
		/*$range = 3;
		$lrange = max(1, $page-(($range-1)/2));
		$rrange = min($numofpages, $page+(($range-1)/2));*/
		
		$range = 4;
		$lrange = max(1, $page-(($range-1)));
		$rrange = min($numofpages, $page+(($range-1)));
		if(($rrange - $lrange) < ($range - 1)){
			if($lrange == 1){
				$rrange = min($lrange + ($range-1), $numofpages);
			}else{
				$lrange = max($rrange - ($range-1), 0);
			}
		}
		
		if($lrange > 1){
			$pagelinks .= " .. ";
		}else{
			$pagelinks .= " &nbsp;&nbsp; ";
		}
		for($i = 1; $i <= $numofpages; $i++){
			if($i == $page){
				$pagelinks .= "<span class=\"current\">$i</span>";
			}else{
				if($lrange <= $i && $i <= $rrange){
					$pagelinks .= " <a class=\"pagelinks\" href=\"".$currpage."&page=".$i."\">" . $i . "</a>  ";
				}
			}
		}
		
		if($rrange < $numofpages){
			$pagelinks .= " .. ";
		}else{
			$pagelinks .= " &nbsp;&nbsp; ";
		}

		if(($numrows - ($limit * $page)) > 0){
			$pagenext = $page + 1;
			$pagelinks .= "<a class=\"pagelinks\" href=\"". $currpage . "&page=" . $pagenext . "\"> Next >></a>";
		}else{
			$pagelinks .= " <span class=\"disabled\"> Next >></span>";
		}
	}else{
		//$pagelinks .= "<span class=\"pagelinks\">&lt; PREV</span>&nbsp;&nbsp;";
		//$pagelinks .= "<span class=\"pagelinks\">&nbsp;&nbsp;&nbsp;NEXT &gt;</span>&nbsp;&nbsp;";
	}
	$pagelinks .= "</div>";		
return $pagelinks;}


function fun_product_price_range_array(){
	$priceRange = array(
					"1" => "US $1.00 - US $2.99 ",
					"2" => "US $3.00 - US $4.99",
					"3" => "US $5.00 - US $7.99",
					"4" => "US $8.00 - US $10.99",
					"5" => "US $11.00 - US $14.99",
					"6" => "US $15.00 - US $19.99",
					"7" => "US $20.00 and Over"
				);
	return $priceRange;
}		

function fun_product_price_range_option($pr=''){
	$priceRange = fun_product_price_range_array();
	foreach($priceRange as $keys => $vals){
		if($keys==$pr){
			$selected = " selected";
		}else{
			$selected = "";
		}
		echo "<option value=\"".$keys."\" ".$selected.">";
		echo $vals;
		echo "</option>\n";
	}
}

function fun_admin_user_type_array(){
	$auType = array(
					"1" => "Super Admin",
					"2" => "Sub Admin"
				);
	return $auType;
}		

function fun_get_user_type_option($uTypeNo=''){
	$userTypeArray = fun_admin_user_type_array();
	foreach($userTypeArray as $keys => $vals){
		if($keys==$uTypeNo){
			$selected = " selected";
		}else{
			$selected = "";
		}
		echo "<option value=\"".$keys."\" ".$selected.">";
		echo $vals;
		echo "</option>\n";
	}
}

function fun_get_user_type_name($uTypeNo=''){
	$userTypeArray = fun_admin_user_type_array();
	$userTypeName = "";
	foreach($userTypeArray as $keys => $vals){
		if($keys==$uTypeNo){
			$userTypeName = $vals;
		}
	}
	return $userTypeName;
}

function fun_cus_title_option($title){
	echo "<option value=\"Mr.\"";
	if($title=="Mr."){
		echo " selected";
	}
	echo ">Mr.</option>\n";
	
	echo "<option value=\"Mrs.\"";
	if($title=="Mrs."){
		echo " selected";
	}
	echo ">Mrs.</option>\n";
	
	echo "<option value=\"Miss.\"";
	if($title=="Miss."){
		echo " selected";
	}
	echo ">Miss.</option>\n";
	
	echo "<option value=\"Dr.\"";
	if($title=="Dr."){
		echo " selected";
	}
	echo ">Dr.</option>\n";
}

function funGetUSStatesArray(){
	$usStatesArray = array(
						"AL" => "Alabama", "AK" => "Alaska", "AZ" => "Arizona", "AR" => "Arkansas", "CA" => "California", "CO" => "Colorado",
						"CT" => "Connecticut", "DE" => "Delaware", "DC" => "District of Columbia", "FL" => "Florida", "GA" => "Georgia",
						"HI" => "Hawaii", "ID" => "Idaho", "IL" => "Illinois", "IN" => "Indiana", "IA" => "Iowa", "KS" => "Kansas",
						"KY" => "Kentucky", "LA" => "Louisiana", "ME" => "Maine", "MD" => "Maryland", "MA" => "Massachusetts",
						"MI" => "Michigan", "MN" => "Minnesota", "MS" => "Mississippi", "MO" => "Missouri", "MT" => "Montana",
						"NE" => "Nebraska", "NV" => "Nevada", "NH" => "New Hampshire", "NJ" => "New Jersey", "NM" => "New Mexico",
						"NY" => "New York", "NC" => "North Carolina", "ND" => "North Dakota", "OH" => "Ohio", "OK" => "Oklahoma",
						"OR" => "Oregon", "PA" => "Pennsylvania", "RI" => "Rhode Island", "SC" => "South Carolina", "SD" => "South Dakota",
						"TN" => "Tennessee", "TX" => "Texas", "UT" => "Utah", "VT" => "Vermont", "VA" => "Virginia", "WA" => "Washington",
						"WV" => "West Virginia", "WI" => "Wisconsin", "WY" => "Wyoming"
					 );
	return $usStatesArray;
}

function funGetUSStatesOption($statesCode=''){
	$statesArray = funGetUSStatesArray();
	foreach($statesArray as $keys => $vals){
		if($keys==$statesCode){
			$selected = " selected";
		}else{
			$selected = "";
		}
		echo "<option value=\"".$keys."\" ".$selected.">";
		echo $vals;
		echo "</option>\n";
	}
}

function funOrderStatusArray(){
	$osArray = array(
					OS_PENDING => "Pending",
					OS_CONFIRM => "In progress",
					//OS_DELIVER => "Completed",
					//OS_SHIPPED => "Shipped",
					OS_COMPLETE => "Completed",
					//OS_CANCELLED => "Cancelled",
				);
	return $osArray;
}
function funOrderStatusOption($osNo){
	$osArray = funOrderStatusArray();
	foreach($osArray as $keys => $vals){
		if((int)$keys==(int)$osNo){
			$selected = " selected";
		}else{
			$selected = "";
		}
		echo "<option value=\"".$keys."\" ".$selected.">";
		echo $vals;
		echo "</option>\n";
	}
}
function funOrderStatusName($osNo){
	$osArray = funOrderStatusArray();
	$osName = "";
	foreach($osArray as $keys => $vals){
		if((int)$keys==(int)$osNo){
			$osName = $vals;
		}
	}
	return $osName;
}


function funPaymentStatusArray(){
	$psArray = array(
					PS_PENDING => "Not Paid",
					PS_CONFIRM => "Paid",
					//PS_INPROCESS => "In process",
					//PS_CLEAR => "Cleared",
					//PS_CANCELLED => "Cancelled",
				);
	return $psArray;
}
function funPaymentStatusOption($psNo){
	$psArray = funPaymentStatusArray();
	foreach($psArray as $keys => $vals){
		if((int)$keys==(int)$psNo){
			$selected = " selected";
		}else{
			$selected = "";
		}
		echo "<option value=\"".$keys."\" ".$selected.">";
		echo $vals;
		echo "</option>\n";
	}
}
function funPaymentStatusName($psNo){
	$psArray = funPaymentStatusArray();
	$psName = "";
	foreach($psArray as $keys => $vals){
		if((int)$keys==(int)$psNo){
			$psName = $vals;
		}
	}
	return $psName;
}

function funOrderStatusColorArray(){
	$osColorArray = array(
					OS_PENDING => "#ff0000",
					OS_CONFIRM => "#336600",
					//OS_SHIPPED => "#0033CC",
					OS_COMPLETE => "#993399",
					//OS_CANCELLED => "#000000"
	);
	return $osColorArray;
}
function funOrderStatusColor($osNo){
	$ocArray = funOrderStatusColorArray();
	$colorName = "";
	foreach($ocArray as $keys => $vals){
		if((int)$keys==(int)$osNo){
			$colorName = $vals;
		}
	}
	return $colorName;
}

function funPaymentStatusColorArray(){
	$psColorArray = array(
					PS_PENDING => "#ff0000",
					PS_CONFIRM => "#336600",
					//PS_INPROCESS => "#0033CC",
					//PS_CLEAR => "#993399",
					//PS_CANCELLED => "#000000"
	);
	return $psColorArray;
}
function funPaymentStatusColor($psNo){
	$pcArray = funPaymentStatusColorArray();
	$colorName = "";
	foreach($pcArray as $keys => $vals){
		if((int)$keys==(int)$psNo){
			$colorName = $vals;
		}
	}
	return $colorName;
}

function funProductSizeOptions($sizeVals){
	if($sizeVals!=""){
		$sizeArry = explode(",",$sizeVals);
		if(is_array($sizeArry) && sizeof($sizeArry)){
			foreach($sizeArry as $keys => $vals){
				$tmpVal = trim($vals);
				if($tmpVal!=""){
					echo "<option value=\"".$tmpVal."\">";
					echo $tmpVal;
					echo "</option>\n";
				}
			}
		}
	}
	
}

function getDisplayMessage($id)
 	{
		$sql = "SELECT * FROM displaymessage WHERE id=".$id;
		$result = mysql_query($sql);
		$rowsCon = mysql_fetch_array($result);
		$message = $rowsCon['message'];
		return $message;
	}


/**
 * Image resize
 * @param int $width
 * @param int $height
 */
function resize($width, $height){
	/* Get original image x y*/
	list($w, $h) = getimagesize($_FILES['image']['tmp_name']);
	/* calculate new image size with ratio */
	$ratio = max($width/$w, $height/$h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	/* new file name */
	$path = 'uploads/'.$width.'x'.$height.'_'.$_FILES['image']['name'];
	/* read binary data from image file */
	$imgString = file_get_contents($_FILES['image']['tmp_name']);
	/* create image from string */
	$image = imagecreatefromstring($imgString);
	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $image,
  	0, 0,
  	$x, 0,
  	$width, $height,
  	$w, $h);
	/* Save image */
	switch ($_FILES['image']['type']) {
		case 'image/jpeg':
			imagejpeg($tmp, $path, 100);
			break;
		case 'image/png':
			imagepng($tmp, $path, 0);
			break;
		case 'image/gif':
			imagegif($tmp, $path);
			break;
		default:
			exit;
			break;
	}
	return $path;
	/* cleanup memory */
	imagedestroy($image);
	imagedestroy($tmp);
}

 function AmISelected($text, $key, $val){
	$Selected = ($key==$val)?" Selected":"";	
	return "<option value=\"$val\"$Selected>$text</option>";
   }
function plgetCityList($key){
	   $strCity;
       $strCity = "";
	   $strCity = $strCity.AmISelected("Please Select", $key, "Please Select");
	   $strCity = $strCity.AmISelected("Ahmedabad", $key, "Ahmedabad");
		$strCity = $strCity.AmISelected("Bangalore", $key, "Bangalore");
		$strCity = $strCity.AmISelected("Chandigarh", $key, "Chandigarh");
		$strCity = $strCity.AmISelected("Chennai", $key, "Chennai");
		$strCity = $strCity.AmISelected("Cochin", $key, "Cochin");
		$strCity = $strCity.AmISelected("Delhi", $key, "Delhi");
		$strCity = $strCity.AmISelected("Hyderabad", $key, "Hyderabad");
		$strCity = $strCity.AmISelected("Jaipur", $key, "Jaipur");
		$strCity = $strCity.AmISelected("Jalandhar", $key, "Jalandhar");
		$strCity = $strCity.AmISelected("Kolkata", $key, "Kolkata");
		$strCity = $strCity.AmISelected("Lucknow", $key, "Lucknow");
		$strCity = $strCity.AmISelected("Mumbai", $key, "Mumbai");
		$strCity = $strCity.AmISelected("Nagpur", $key, "Nagpur");
		$strCity = $strCity.AmISelected("Pune", $key, "Pune");
		$strCity = $strCity.AmISelected("Surat", $key, "Surat");		
		$strCity = $strCity.AmISelected("Ananthpur", $key, "Ananthpur");
		$strCity = $strCity.AmISelected("Aurangabad", $key, "Aurangabad");
		$strCity = $strCity.AmISelected("Baroda", $key, "Baroda");
		$strCity = $strCity.AmISelected("Bahadurgarh", $key, "Bahadurgarh");
		$strCity = $strCity.AmISelected("Bhimavaram", $key, "Bhimavaram"); 
		$strCity = $strCity.AmISelected("Bhiwadi", $key, "Bhiwadi");
		$strCity = $strCity.AmISelected("Bhopal", $key, "Bhopal");
		$strCity = $strCity.AmISelected("Bhubneshwar", $key, "Bhubneshwar");
		$strCity = $strCity.AmISelected("Calicut", $key, "Calicut");		
		$strCity = $strCity.AmISelected("Coimbatore", $key, "Coimbatore");
		$strCity = $strCity.AmISelected("Cuttack", $key, "Cuttack");
		$strCity = $strCity.AmISelected("Dehradun", $key, "Dehradun");
		$strCity = $strCity.AmISelected("Dindigul", $key, "Dindigul");
		$strCity = $strCity.AmISelected("Eluru", $key, "Eluru");
		$strCity = $strCity.AmISelected("Ernakulam", $key, "Ernakulam");
		$strCity = $strCity.AmISelected("Erode", $key, "Erode");
		$strCity = $strCity.AmISelected("Faridabad", $key, "Faridabad");
		$strCity = $strCity.AmISelected("Gaziabad", $key, "Gaziabad");
		$strCity = $strCity.AmISelected("Guntur", $key, "Guntur");	   
		$strCity = $strCity.AmISelected("Gurgaon", $key, "Gurgaon");
		$strCity = $strCity.AmISelected("Guwahati", $key, "Guwahati");
		$strCity = $strCity.AmISelected("Hosur", $key, "Hosur");
		$strCity = $strCity.AmISelected("Indore", $key, "Indore");
		$strCity = $strCity.AmISelected("Jabalpur", $key, "Jabalpur");		
		$strCity = $strCity.AmISelected("Jamshedpur", $key, "Jamshedpur");
		$strCity = $strCity.AmISelected("Kakinada", $key, "Kakinada");
		$strCity = $strCity.AmISelected("Karaikkal", $key, "Karaikkal");
		$strCity = $strCity.AmISelected("Karimnagar", $key, "Karimnagar");
		$strCity = $strCity.AmISelected("Karur", $key, "Karur");
		$strCity = $strCity.AmISelected("Kanpur", $key, "Kanpur");
		$strCity = $strCity.AmISelected("Khammam", $key, "Khammam");
		$strCity = $strCity.AmISelected("Kishangarh", $key, "Kishangarh");
		$strCity = $strCity.AmISelected("Kochi", $key, "Kochi");
		$strCity = $strCity.AmISelected("Kozhikode", $key, "Kozhikode");
		$strCity = $strCity.AmISelected("Kumbakonam", $key, "Kumbakonam");	
		$strCity = $strCity.AmISelected("Kurnool", $key, "Kurnool");
		$strCity = $strCity.AmISelected("Ludhiana", $key, "Ludhiana");
		$strCity = $strCity.AmISelected("Madurai", $key, "Madurai");
		$strCity = $strCity.AmISelected("Mangalore", $key, "Mangalore");
		$strCity = $strCity.AmISelected("Mysore", $key, "Mysore");
		$strCity = $strCity.AmISelected("Nagerkoil", $key, "Nagerkoil");
		$strCity = $strCity.AmISelected("Nasik", $key, "Nasik");
		$strCity = $strCity.AmISelected("Navi Mumbai", $key, "Navi Mumbai");
		$strCity = $strCity.AmISelected("Nellore", $key, "Nellore");
		$strCity = $strCity.AmISelected("Nizamabad", $key, "Nizamabad");
		$strCity = $strCity.AmISelected("Noida", $key, "Noida");
		$strCity = $strCity.AmISelected("Ongole", $key, "Ongole");
		$strCity = $strCity.AmISelected("Ooty", $key, "Ooty");
		$strCity = $strCity.AmISelected("Patna", $key, "Patna");
		$strCity = $strCity.AmISelected("Pondicherry", $key, "Pondicherry");
		$strCity = $strCity.AmISelected("Pudukottai", $key, "Pudukottai");
		$strCity = $strCity.AmISelected("Rajahmundry", $key, "Rajahmundry");
		$strCity = $strCity.AmISelected("Ramagundam", $key, "Ramagundam");
		$strCity = $strCity.AmISelected("Raipur", $key, "Raipur");
		$strCity = $strCity.AmISelected("Rewari", $key, "Rewari");
		$strCity = $strCity.AmISelected("Sahibabad", $key, "Sahibabad");
		$strCity = $strCity.AmISelected("Salem", $key, "Salem");
		$strCity = $strCity.AmISelected("Srikakulam", $key, "Srikakulam");
		$strCity = $strCity.AmISelected("Thane", $key, "Thane");
		$strCity = $strCity.AmISelected("Thanjavur", $key, "Thanjavur");
		$strCity = $strCity.AmISelected("Thrissur", $key, "Thrissur");
		$strCity = $strCity.AmISelected("Thiruvananthapuram", $key, "Thiruvananthapuram");
		$strCity = $strCity.AmISelected("Tirunelveli", $key, "Tirunelveli");
		$strCity = $strCity.AmISelected("Tirupathi", $key, "Tirupathi");
		$strCity = $strCity.AmISelected("Trivandrum", $key, "Trivandrum");
		$strCity = $strCity.AmISelected("Trichy", $key, "Trichy");
		$strCity = $strCity.AmISelected("Tuticorin", $key, "Tuticorin");
		$strCity = $strCity.AmISelected("Vadodara", $key, "Vadodara");
		$strCity = $strCity.AmISelected("Vellore", $key, "Vellore");
		$strCity = $strCity.AmISelected("Vishakapatanam", $key, "Vishakapatanam");
		$strCity = $strCity.AmISelected("Vizag", $key, "Vizag");
		$strCity = $strCity.AmISelected("Vizianagaram", $key, "Vizianagaram");
		$strCity = $strCity.AmISelected("Warangal", $key, "Warangal");
		$strCity = $strCity.AmISelected("Others", $key, "Others");
	   return $strCity;
	}


?>