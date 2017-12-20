<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
	$URL=$_REQUEST['url'];
	//$ip =$_REQUEST['ip'];
//echo "ppp".$URL;
//echo "ppp".$ip;

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$rating_name = FixString($rating_name);
		//$rating_dob = FixString($rating_dob);
		$rating_contact = FixString($rating_contact);
		$rating_email = FixString($rating_email);
		$rating_city = FixString($rating_city);
		$rating_net_salary = FixString($rating_netsalary);
		$Day=FixString($day);
		$Month=FixString($month);
		$Year=FixString($year);
		$Pincode = FixString($Pincode);
		$rating_dob=$Year."-".$Month."-".$Day;
	    $Dated = ExactServerdate();

				//$rating_sql = "INSERT INTO Register_Rating( RatingID, Rating_Name, Rating_Email, Rating_DOB, Rating_City, Rating_Net_Salary, Rating_Contact, Dated)
				//VALUES ( '', '$rating_name', '$rating_email', '$rating_dob', '$rating_city', '$rating_net_salary', '$rating_contact',  Now() )";
				//echo $rating_sql;
				
			$dataInsert = array("RatingID"=>'', "Rating_Name"=>$rating_name, "Rating_Email"=>$rating_email, "Rating_DOB"=>$rating_dob, "Rating_City"=>$rating_city, "Rating_Net_Salary"=>$rating_net_salary, "Rating_Contact"=>$rating_contact, "Dated"=>$Dated);
			$table = 'Register_Rating';
			$insert = Maininsertfunc ($table, $dataInsert);
				
				//$rating_result = ExecQuery($rating_sql);
		$last_inserted_id = mysql_insert_id();
				
				//$tataaig_sql = "INSERT INTO `tataaig_leads` ( `T_RequestID` , `T_Product` , `T_City`, `T_Dated`, Mobile_Number ) VALUES ('".$last_inserted_id ."', 0,'$rating_city', Now(), '".$rating_contact."')";
				//echo $tataaig_sql;
				//$tataaig_result = ExecQuery($tataaig_sql);
			$dataInsert = array("T_RequestID"=>$last_inserted_id, "T_Product"=>0, "T_City"=>$rating_city, 'T_Dated'=>$Dated,"Mobile_Number"=>$rating_contact);

			$table = 'tataaig_leads';
			$insert = Maininsertfunc ($table, $dataInsert);
		
			$userresult = ("select Email from wUsers where Email='$rating_email' ");
			//echo "select IsPublic from wUsers where Email='$rating_email'";
			//echo mysql_error();
			 list($usernum_rows,$getrow)=MainselectfuncNew($userresult,$array = array());
			
			$usernum_rows = mysql_num_rows($userresult);
			//echo $usernum_rows;
			if($usernum_rows<=0)
				{
					//$sql = "INSERT INTO wUsers (Email,FName,LName,Phone,DOB,Join_Date,Last_Login,Count_Requests,IsPublic) VALUES ('$rating_email','$rating_name','','$rating_contact','$rating_dob',Now(),Now(),0,'1')";
					
					//$result = ExecQuery($sql);
					
			$dataInsert = array("Email"=>$rating_email, "FName"=>$rating_name, "LName"=>'', "Phone"=>$rating_contact, "DOB"=>$rating_dob, "Join_Date"=>$Dated, "Last_Login"=>$Dated, "Count_Requests"=>0, "IsPublic"=>1);
			$table = 'wUsers';
			$insert = Maininsertfunc ($table, $dataInsert);

				}
		
				

				setSessionUser($Email, $row);
$_SESSION['Email']=$rating_email;
$_SESSION['UName'] = $rating_name;
$_SESSION['UserType'] = "user";
			 /* Dump Resultset */
			mysql_free_result($result);
			/*}
			else
			{
				//echo "<script>alert('Your Rating for this Bank already exist')".."</script>";
			}
		}*/

	

echo "<script>window.close()"."</script>";
	}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<STYLE>

a
{
	cursor:pointer;

}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}</style>
<script>
window.resizeTo(310,580)

function refreshParent() {
 window.opener.location.href = window.opener.location.href;

 if (window.opener.progressWindow)
               
{
   window.opener.progressWindow.close()
 }
 window.close();
}
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}

function checkData(data, msg, reqLen){
	if((data.value == "") || (data.value.length < reqLen)) {
		alert('Please enter '+msg+' with atleast '+reqLen+' characters.');
		data.focus();
		return false;
	}
	return true;
   }

function ratingchkform()
{  
		if(document.rating_form.rating_name.value=="")
	{
			alert("please enter your Name!");
			document.rating_form.rating_name.focus();
				return false;
	}
		if(document.rating_form.rating_email.value=="")
	{
			alert("please enter your email id!");
			document.rating_form.rating_email.focus();
				return false;
	}
	if(document.rating_form.rating_email.value!="")
	{
		if (!validmail(document.rating_form.rating_email.value))
		{
			//alert("Please enter your valid email address!");
			document.rating_form.rating_email.focus();
			return false;
		}

	}
	if(document.rating_form.rating_contact.value=="")
	{   
		alert("Please enter Mobile no");
		document.rating_form.rating_contact.focus();
		return false;
	}
	 if (document.rating_form.rating_contact.value.length < 10 )
		{
                alert("Please Enter 10 Digits"); 
				 document.rating_form.rating_contact.focus();
				return false;
        }
        if (document.rating_form.rating_contact.value.charAt(0)!="9")
		{
                alert("The number should start only with 9");
				 document.rating_form.rating_contact.focus();
                return false;
        }
	if(document.rating_form.day.value=="")
	{
		alert("Please fill your day of birth.");
		document.rating_form.day.focus();
		return false;
	}
	if(document.rating_form.day.value!="")
	{
	 if((document.rating_form.day.value<1) || (document.rating_form.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	document.rating_form.day.focus();
	return false;
	}
	}
	if(!checkData(document.rating_form.day, 'Day', 2))
		return false;
	
	if(document.rating_form.month.value=="")
	{
		alert("Please fill your month of birth.");
		document.rating_form.month.focus();
		return false;
	}
	if(document.rating_form.month.value!="")
	{
	if((document.rating_form.month.value<1) || (document.rating_form.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	document.rating_form.month.focus();
	return false;
	}
	}
	if(!checkData(document.rating_form.month, 'month', 2))
		return false;
	if(document.rating_form.year.value=="")
	{
		alert("Please fill your year of birth.");
		document.rating_form.year.focus();
		return false;
	}
		if(document.rating_form.year.value!="")
	{
	  if((document.rating_form.year.value < "1945") || (document.rating_form.year.value >"1989"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		document.rating_form.year.focus();
		return false;
		}
	}
	if(!checkData(document.rating_form.year, 'Year', 4))
		return false;
	

	if(document.rating_form.rating_netsalary.value=="")
	{
		alert("Please enter Net Salary");
		document.rating_form.rating_netsalary.focus();
		return false;
	}
	if (document.rating_form.rating_city.selectedIndex==0)
	{
		alert("Please select City to continue");
		document.rating_form.rating_city.focus();
		return false;
	}
	}

	function intOnly(i) {
		if(i.value.length>0) {
			i.value = i.value.replace(/[^\d]+/g, ''); 
		}
	}
</script>
</head>
	<!--<body onbeforeunload="HandleOnClose();">-->
<body onUnload="opener.location=('<? echo $URL;?>')">
	<form name="rating_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>?url=<? echo $URL;?>&ip=<? echo $ip;?>" onSubmit="return ratingchkform();">
	
	<table width="300" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #246FE2;">
  
  <tr>
    <td height="22" align="center" valign="middle" bgcolor="#246FE2" style="color:#FFFFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;">Register Here </td>
  </tr>

  <tr>
    <td bgcolor="#DAEAF9"><table width="100%" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td width="37%" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#1B60C8; font-weight:bold; padding-left:8px;">Name</td>
        <td width="63%"><input type='text' name='rating_name' id='rating_name' /></td>
      </tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#1B60C8; font-weight:bold; padding-left:8px;">Email Id </td>
        <td><input type='text' name='rating_email' id='rating_email' /></td>
      </tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#1B60C8; font-weight:bold; padding-left:8px;">Mobile No. </td>
        <td><input name='rating_name3' type='text' id='rating_name3' size="1" value="+91" />
          <input name='rating_contact' type='text' id='rating_contact' size="14" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"/></td>
      </tr>
      <tr>
	   <tr>
       <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#1B60C8; font-weight:bold; padding-left:8px;">DOB<font size="1" color="#FF0000">*</font></td>
       <td><input name="day" type="text" id="day" size="2" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">
         <input name="month" type="text" id="month" size="2" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">
         <input name="year" type="text" id="year" size="2" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">
         (DD-MM-YYYY)</td>
     </tr>
       <!-- <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#1B60C8; font-weight:bold; padding-left:8px;">DOB</td>
				<td><input type='text' name='rating_dob' id='rating_dob' size="20" maxlength="10"  value="yyyy-mm-dd"></td>
      </tr>-->
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#1B60C8; font-weight:bold; padding-left:8px;">Net Salary </td>
        <td><input type='text' name='rating_netsalary' id='rating_netsalary' /></td>
      </tr>
      <tr>
        <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color:#1B60C8; font-weight:bold; padding-left:8px;">City</td>
        <td><select name="rating_city" id="rating_city" style="width:145px;">
				<option >Please select</option>
				<option value="Bangalore">Bangalore</option>
				<option value="Chennai">Chennai</option>
				<option value="Delhi">Delhi</option>
				<option value="Faridabad">Faridabad</option>
				<option value="Gurgaon">Gurgaon</option>
				<option value="Gaziabad">Gaziabad</option>
				<option value="Hyderabad">Hyderabad</option>
				<option value="Kolkata">Kolkata</option>
				<option value="Mumbai">Mumbai</option>
				<option value="Navi Mumbai">Navi Mumbai</option>
				<option value="Noida">Noida</option>
				<option value="Pune">Pune</option>
				<option value="Sahibabad">Sahibabad</option>
				<option value="Thane">Thane</option>
				</select></td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td height="30" align="center" valign="middle" bgcolor="#DAEAF9"><input type='submit' value='submit' class='bluebutton'></td>
  </tr>
  <tr>
    <td align="center" valign="middle"><img src="images/insurance-ban.gif" width="226" height="107" /></td>
  </tr>
</table>
	
	</body>
</html>