<?php
	error_reporting(0);
	$SiteName="Deal4Loans";
	$AdminName="Admin-$SiteName";
   ////////////////////////////////////////Radio Checked
   function AmIChecked($key,$val){
	return ($key==$val)?"Checked":"";
   }
   ////////////////////////////////////////Combo Selected
   function AmISelected($text, $key, $val){
	$Selected = ($key==$val)?" Selected":"";	
	return "<Option value=\"$val\"$Selected>$text</Option>";
   }

   ////////////////////////////////////////

   function getCityList($key){
	   $strCity;
       $strCity = "";
	   $strCity = $strCity.AmISelected("Please Select", $key, "Please Select");
	   $strCity = $strCity.AmISelected("Ahmedabad", $key, "Ahmedabad");
   	   $strCity = $strCity.AmISelected("Aurangabad", $key, "Aurangabad");
	   $strCity = $strCity.AmISelected("Bangalore", $key, "Bangalore");
   	   $strCity = $strCity.AmISelected("Baroda", $key, "Baroda");
	   $strCity = $strCity.AmISelected("Bhubneshwar", $key, "Bhubneshwar");
   	   $strCity = $strCity.AmISelected("Chandigarh", $key, "Chandigarh");
	   $strCity = $strCity.AmISelected("Chennai", $key, "Chennai");
   	   $strCity = $strCity.AmISelected("Cochin", $key, "Cochin");
	   $strCity = $strCity.AmISelected("Coimbatore", $key, "Coimbatore");
   	   $strCity = $strCity.AmISelected("Cuttack", $key, "Cuttack");
	   $strCity = $strCity.AmISelected("Dehradun", $key, "Dehradun");
   	   $strCity = $strCity.AmISelected("Delhi", $key, "Delhi");
	   $strCity = $strCity.AmISelected("Gaziabad", $key, "Gaziabad");
   	   $strCity = $strCity.AmISelected("Gurgaon", $key, "Gurgaon");
	   $strCity = $strCity.AmISelected("Hosur", $key, "Hosur");
   	   $strCity = $strCity.AmISelected("Hyderabad", $key, "Hyderabad");
	   $strCity = $strCity.AmISelected("Indore", $key, "Indore");
   	   $strCity = $strCity.AmISelected("Jaipur", $key, "Jaipur");
	   $strCity = $strCity.AmISelected("Jamshedpur", $key, "Jamshedpur");
   	   $strCity = $strCity.AmISelected("Kanpur", $key, "Kanpur");
	   $strCity = $strCity.AmISelected("Kolkata", $key, "Kolkata");
   	   $strCity = $strCity.AmISelected("Lucknow", $key, "Lucknow");
	   $strCity = $strCity.AmISelected("Ludhiana", $key, "Ludhiana");
   	   $strCity = $strCity.AmISelected("Madurai", $key, "Madurai");
	   $strCity = $strCity.AmISelected("Mangalore", $key, "Mangalore");
   	   $strCity = $strCity.AmISelected("Mysore", $key, "Mysore");
	   $strCity = $strCity.AmISelected("Mumbai", $key, "Mumbai");
   	   $strCity = $strCity.AmISelected("Nagpur", $key, "Nagpur");
	   $strCity = $strCity.AmISelected("Nasik", $key, "Nasik");
   	   $strCity = $strCity.AmISelected("Navi Mumbai", $key, "Navi Mumbai");
	   $strCity = $strCity.AmISelected("Noida", $key, "Noida");
   	   $strCity = $strCity.AmISelected("Pune", $key, "Pune");
	   $strCity = $strCity.AmISelected("Sahibabad", $key, "Sahibabad");
   	   $strCity = $strCity.AmISelected("Surat", $key, "Surat");
	   $strCity = $strCity.AmISelected("Thane", $key, "Thane");
   	   $strCity = $strCity.AmISelected("Trivandrum", $key, "Trivandrum");
	   $strCity = $strCity.AmISelected("Trichy", $key, "Trichy");
   	   $strCity = $strCity.AmISelected("Vishakapatanam", $key, "Vishakapatanam");
	   $strCity = $strCity.AmISelected("Others", $key, "Others");
	   return $strCity;
	}

   ////////////////////////////////////////Yes/No


  function getYesNo($val){
	return ($val==1)?"Yes":"No";
   }

   ////////////////////////////////////////Employment Status
   function getEmpStatus($val){
	return ($val==1)?"Salaried":"Self Employed";
   }

   ////////////////////////////////////////Property Type
   function getPropertyType($val){
	return ($val==1)?"Residential":"Commercial";
   }

   ////////////////////////////////////////Property Type
   function getCodeValue($pKey){
	$titles = array(
		'Marital1' => 'Single',
		'Marital2' => 'Married',
		'Resident1' => 'Single',
		'Resident2' => 'Family',
		'Vehicle0' => '2 Wheeler',
		'Vehicle1' => '4 Wheeler',
		'Vehicle2' => 'Other',
		'Loan0' => 'N/A',
		'Loan1' => 'Personal Loan',
		'Loan2' => 'Home Loan',		
		'Loan3' => 'Car Loan',
		'Loan4' => 'Other',
		'Inv0' => 'One Time',
		'Inv1' => 'Monthly',
		'Inv3' => 'Quarterly',
		'Inv6' => 'Six Monthly',
		'Inv12' => 'Yearly',
		'ReplyType_personal' => '1',
		'ReplyType_home' => '2',
		'ReplyType_car' => '3',
		'ReplyType_cc' => '4',
		'ReplyType_insurance' => '5',
		'PostedBy1' => 'User',
		'PostedBy2' => 'Bidder'
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }

   ////////////////////////////////////////
   function getComboOption($strVal, $val){
	return ("<option selected value=$val>$strVal</option>");
   }
   ////////////////////////////////////////
   function getRowID($i){
	return (($i %2) == 0)?1:2;
   }

   ////////////////////////////////////////
   function getAlert($msg, $redir, $url){
	$txt = "<script language=javascript>alert('".$msg."');";
	if($redir)
		$txt = $txt." location.href='$url'";

	return $txt."</script>";
   }

   ////////////////////////////////////////
   function getBar(){
	$Bar = "";
	if(!isset($_SESSION['UserType']))
		return $Bar;

	$Bar = "Welcome ".ucwords($_SESSION['UserType'])." <b>".$_SESSION['UName']." ( <a href=Logout.php>Logout</a> )</b> | <a href=Welcome.php>Admin Home</a>";
	return $Bar;
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

   ////////////////////////////////////////
   function FixNewLine($strtofix){
	return ereg_replace("<BR>", "\n", $strtofix);
   }

   ////////////////////////////////////////
   function setSessionUser($Email, $row){
	 /* Create Session Variables */
	$_SESSION['Email'] = $Email;

	$_SESSION['UserID'] = $row["UserID"];
	$_SESSION['UName'] = $row["FName"]." ".$row["LName"];
	$_SESSION['FName'] = $row["FName"];
	$_SESSION['LName'] = $row["LName"];
	$_SESSION['Phone'] = $row["Phone"];
	$_SESSION['JoinDate'] = $row["Join_Date"];
	$_SESSION['LastLogin'] = $row["Last_Login"];
	$_SESSION['CountRequests'] = $row["Count_Requests"];
	$_SESSION['IsPublic'] = $row["IsPublic"];
	$_SESSION['UserType'] = "user";
   }

	///////////////////////////////////////////
   function send_mail_new($to_name,$to_email,$from_name,$from_email,$subject,$message)
	{
    global $SiteName;
    get_admin_info($admin);
    $from_name="$SiteName";
    $from_email=$admin[admin_email];
    $text_ver=str_replace("<br>","\n",$message);
    $t = new htmlMimeMail();
    $from="$from_name <$from_email>";
    $cc="$from_name <$Admin_CCMail>";
    $t->setHtml($message,$text_ver);
    $t->setFrom($from);
    $t->setSubject($subject);
    $mail="$to_name <$to_email>";
    return $t->send(array($mail,''));
	}
   ////////////////////////////////////////
   function setSessionBidder($Login, $row){
	 /* Create Session Variables */
	$_SESSION['Login'] = $Login;

	$_SESSION['BidderID'] = $row["BidderID"];
	$_SESSION['UName'] = $row["Bidder_Name"];
	$_SESSION['Associated_Bank'] = $row["Associated_Bank"];
	$_SESSION['Address'] = $row["Address"];
	$_SESSION['Website'] = $row["Website"];
	$_SESSION['Email'] = $row["Email"];
	$_SESSION['Contact_Num'] = $row["Contact_Num"];
	$_SESSION['Profile'] = $row["Profile"];
	$_SESSION['JoinDate'] = $row["Join_Date"];
	$_SESSION['LastLogin'] = $row["Last_Login"];
	$_SESSION['CountReplies'] = $row["Count_Replies"];
	$_SESSION['hasNewReply'] = $row["Has_New_Reply"];
	$_SESSION['UserType'] = "bidder";
   }

	function makecomma($input)
	{
	   // This function is written by some anonymous person - I got it from Google
	   if(strlen($input)<=2)
	   { return $input; }
	   $length=substr($input,0,strlen($input)-2);
	   $formatted_input = makecomma($length).",".substr($input,-2);
	   return $formatted_input;
	}

	function formatInIndianStyle($num){
	   // This is my function
	   $pos = strpos((string)$num, ".");
	   if ($pos === false) { $decimalpart="00";}
	   else { $decimalpart= substr($num, $pos+1, 2); $num = substr($num,0,$pos); }

	   if(strlen($num)>3 & strlen($num) <= 12){
				   $last3digits = substr($num, -3 );
				   $numexceptlastdigits = substr($num, 0, -3 );
				   $formatted = makecomma($numexceptlastdigits);
				   $stringtoreturn = $formatted.",".$last3digits.".".$decimalpart ;
	   }elseif(strlen($num)<=3){
				   $stringtoreturn = $num.".".$decimalpart ;
	   }elseif(strlen($num)>12){
				   $stringtoreturn = number_format($num, 2);
	   }

	   if(substr($stringtoreturn,0,2)=="-,"){$stringtoreturn = "-".substr($stringtoreturn,2 );}
	   return $stringtoreturn;
	}

?>