<?php
require 'scripts/session_check.php';
	require 'scripts/db_init-main.php';
	require 'scripts/functions.php';
	//require 'get_eligible_list.php';

function getcitydetails($pKey){
    $titles = array(
       '1' => 'Delhi', 
        '2' =>'Mumbai', 
       '3' => 'Punjab',
       
       
    );
    foreach ($titles as $key=>$value)
        if($pKey==$key)
        return $value;

    return "";
  }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;

		$getsubmit = $_REQUEST['submit'];
		$getname = $_REQUEST['getname'];
		//$contact = $_REQUEST['contact'];
		$std = $_REQUEST['std'];
		$mobile = $_REQUEST['mobile'];
		$net_salary = $_REQUEST['net_salary'];
		$city = $_REQUEST['city'];
		//$sub_area = $_REQUEST['sub_area'];
		$pincode = $_REQUEST['pincode'];
		$From_Product = $_REQUEST['From_Product'];
		//print_r($From_Product);
		$cityvalue = getcitydetails($city);
		   $Dated = ExactServerdate();

if($getsubmit=="check for appointment")
	{
		$getsubmitflag=1;
	}
	else
	{
		$getsubmitflag=0;
	}


	 $n       = count($From_Product);
		   $i      = 0;
		   while ($i < $n)
		   {
			  $From_Pro .= "$From_Product[$i], ";
			 $i++;
		   }

		   //$getalldetails="insert into insurance_customer_details (name,mobile_no,insurance_plan,city,insurance_date,check_for_appointment) value('$getname','$mobile','$From_Pro','$cityvalue',Now(),'$getsubmitflag')";
		   //$getalldetailsresult=ExecQuery($getalldetails);
		  
		  $dataInsert = array("name"=>$getname, "mobile_no"=>$mobile, "insurance_plan"=>$From_Pro, "city"=>$cityvalue, "insurance_date"=>$Dated, "check_for_appointment"=>$getsubmitflag);
$table = 'insurance_customer_details';
$insert = Maininsertfunc ($table, $dataInsert);
		  
		   $last_inserted_id = mysql_insert_id();
		 // echo "hello".$getalldetails."<br>";
		  // echo "".$last_inserted_id."<br>";
		   //exit();
		  // $getsubmit="check for appointment";

}
?>

<html>
<head>
<style type="text/css">
<!--
.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
}
-->
</style>
<script language="javascript" type="text/javascript" src="http://www.bimadeals.com/scripts/datetime.js"></script>
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>

<script Language="JavaScript" Type="text/javascript">
function datevalidate(id)
{
	var followdate;
	followdate=document.insurance.FollowupDate_+ id.value;
if (followdate=="")
	{
		alert("Please enter.");
		document.insurance.followdate.focus();
		return false;
	}	
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
function insuranceform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	

if(document.insurance.email.value=="")
		{
				alert("Please enter your email address!");
				document.insurance.email.focus();
				return false;
			
		}
	if(document.insurance.email.value!="")
		{
			if (!validmail(document.insurance.email.value))
			{
				//alert("Please enter your email address!");
				document.insurance.email.focus();
				return false;
			}
		}
		/*
		if(document.insurance.password1.value=="")
		{
			alert("Please enter your Password!");
				document.insurance.password1.focus();
				return false;
		}
		if(document.insurance.cfpassword.value=="")
		{
			alert("Please enter your confirm Password!");
				document.insurance.cfpassword.focus();
				return false;
		}
		if(document.insurance.password1.value!=document.insurance.cfpassword.value)
	{
		alert("Both password must be same.");
		document.insurance.password1.focus();
		return false;
	}*/
	

if((document.insurance.day.value=="") || (document.insurance.day.value=="DD"))
	{
		alert("Please fill your day of birth.");
		document.insurance.day.focus();
		return false;
	}
	if(document.insurance.day.value!="")
	{
	 if((document.insurance.day.value<1) || (document.insurance.day.value>31))
	{
	alert("Kindly Enter your valid Date of Birth(Range 1-31)");
	document.insurance.day.focus();
	return false;
	}
	}

	if(!checkData(document.insurance.day, 'Day', 2))
		return false;
	
	if((document.insurance.month.value=="") || (document.insurance.month.value=="MM"))
	{
		alert("Please fill your month of birth.");
		document.insurance.month.focus();
		return false;
	}
	if(document.insurance.month.value!="")
	{
	if((document.insurance.month.value<1) || (document.insurance.month.value>12))
	{
	alert("Kindly Enter your valid Month of Birth(Range 1-12)");
	document.insurance.month.focus();
	return false;
	}
	}
	if(!checkData(document.insurance.month, 'month', 2))
		return false;
	if((document.insurance.year.value=="") || (document.insurance.year.value=="YYYY"))
	{
		alert("Please fill your year of birth.");
		document.insurance.year.focus();
		return false;
	}
		if(document.insurance.year.value!="")
	{
	  if((document.insurance.year.value < "1945") || (document.insurance.year.value >"1989"))
	{
		alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
		document.insurance.year.focus();
		return false;
		}
	}
	if(!checkData(document.insurance.year, 'Year', 4))
		return false;

	if(document.insurance.net_salary.value=="")
	{
		alert("Please enter net salary no");
			document.insurance.net_salary.focus();
			return false;
	}
	if(document.insurance.residence_address.value=="")
	{
		alert("Please enter Address ");
			document.insurance.residence_address.focus();
			return false;
	}
	/*var myOption = -1;
		for (i=insurance.appointment_address.length-1; i > -1; i--) {
			if(insurance.appointment_address[i].checked) {
				if(i==0)
				{
					if (document.insurance.residence_address.value=="")
					{
						alert("Please residence address");
						document.insurance.residence_address.focus();
						return false;
					}


				}
				else if (document.insurance.office_address.value=="")
				{
					alert("Please office address");
						document.insurance.office_address.focus();
						return false;
				}
				else if (document.insurance.other_address.value=="")
				{
					alert("Please other address");
						document.insurance.other_address.focus();
						return false;
				}
					myOption = i;
	
			}
		}
	
		if (myOption == -1) 
		{
			alert("Please select where you want to have an appointment");
			return false;
		}
		*/
		
	/*if(document.insurance.validate.value==1)
	{
		//alert(document.insurance.validate.value);
		if(document.insurance.email.value=="")
		{
				alert("Please enter your email address!");
				document.insurance.email.focus();
				return false;
			
		}
	if(document.insurance.email.value!="")
		{
			if (!validmail(document.insurance.email.value))
			{
				//alert("Please enter your email address!");
				document.insurance.email.focus();
				return false;
			}
		}
		if(document.insurance.password1.value=="")
		{
			alert("Please enter your Password!");
				document.insurance.password1.focus();
				return false;
		}
		if(document.insurance.cfpassword.value=="")
		{
			alert("Please enter your confirm Password!");
				document.insurance.cfpassword.focus();
				return false;
		}
		if(document.insurance.password1.value!=document.insurance.cfpassword.value)
	{
		alert("Both password must be same.");
		document.insurance.password1.focus();
		return false;
	}

	if(document.insurance.password1.value==document.insurance.cfpassword.value)
	{
		//ert(document.insurance.calculateid.value);
		for(i=1;i<document.insurance.calculateid.value;i++)
		{
			followup="FollowupDate_" + i;
			alert(followup);
			//return false;
				//document.insurance.followup.disabled = false;	
		}
			return false;

		}
	}*/

}

function addresidenceaddress()
{
		var niresidence = document.getElementById('resiaddress');
		var nioffice = document.getElementById('offiaddress');
		var niother = document.getElementById('otheraddress');
		
		if(niresidence.innerHTML=="")
		{ 
			nioffice.innerHTML='';
			niother.innerHTML='';
		
			if(document.insurance.appointment_address.value="on")
			{

		niresidence.innerHTML = '<table border="0" width="100%"><tr> <td class="style1" width="40%">Residence Address</td> <td><textarea cols="20" rows="3" name="residence_address" id="residence_address"/></textarea></td> </tr></table>';
			
		}
		}
		return true;

	}


function addofficeaddress()
{
		var niresidence = document.getElementById('resiaddress');
		var nioffice = document.getElementById('offiaddress');
		var niother = document.getElementById('otheraddress');
		
		if(nioffice.innerHTML=="")
		{
			niresidence.innerHTML='';
			niother.innerHTML='';
		
			if(document.insurance.appointment_address.value="on")
			{
		nioffice.innerHTML = '<table border="0" width="100%"><tr> <td class="style1" width="40%">Office Address</td> <td><textarea cols="20" rows="3" name="office_address" id="office_address" /></textarea></td> </tr></table>';
			
		}
		}
		return true;

	}
	function addotheraddress()
{
		var niresidence = document.getElementById('resiaddress');
		var nioffice = document.getElementById('offiaddress');
		var niother = document.getElementById('otheraddress');
		
		if(niother.innerHTML=="")
		{
			niresidence.innerHTML='';
			nioffice.innerHTML='';
		
			if(document.insurance.appointment_address.value="on")
			{
		niother.innerHTML = '<table border="0" width="100%"><tr>  <td class="style1" width="40%">other Address</td>  <td><textarea cols="20" rows="3" name="other_address" id="other_address" /></textarea></td>  </tr></table>';
			
		}
		}
		return true;

	}


/*function addregister()
{
		var calcid = document.getElementById('calculateid');
		//alert(calcid);
		var ni = document.getElementById('addfields');
	//if(ni.innerHTML != '')
	//{
			ni.innerHTML = '<table width="100%"><tr><td class="style1" width="40%">Email</td><td><input type="text" name="email" id="email" /><input type="hidden" name="validate" id="validate" value="1"></td></tr><tr><td class="style1">Password</td><td><input type="password" name="password1" id="password1"/></td></tr><tr><td class="style1" >Confirm password </td><td><input type="password" name="cfpassword" id="cfpassword" onFocus="insertforapppointment();"/></td></tr></table>';	
			return true;
	
		

	}
*/



/*function addenabled()
{
	var id =9;
	var i;
	var followup;
	//sssalert(id);

	if (document.insurance.email.value!="")
	{
			
	for(i=1;i<id;i++)
	{
		followup=FollowupDate_+i;
		alert(followup);
			document.insurance.followup.disabled = false;	
	}
	}
	else
	{
		alert("else");
			for(i=1;i<id;i++)
	{

		followup=FollowupDate_+i;
		alert(followup);
			document.insurance.followup.disabled = true;	
		
	}
	}

	}   */

	</script>
	<script Language="JavaScript" Type="text/javascript">
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
//this function store customer details and gives eligible bidder list

function insertTemp()
		{
			
			var new_city = document.getElementById('city').value;
			var new_net_salary = document.getElementById('net_salary').value;
			var new_day = document.getElementById('day').value;
			var new_month = document.getElementById('month').value;
			var new_year = document.getElementById('year').value;
			var newDOB =new_day + "-" + new_month + "-" + new_year;
			var new_resquestid = document.getElementById('customerid').value;
					
			if((new_city!=""))
			{

				var queryString = "?city=" + new_city + "&net_salary=" + new_net_salary + "&DOB=" + newDOB + "&customerid=" + new_resquestid;
				//alert(queryString); 
				ajaxRequest.open("GET", "get_bidderslist_only.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						var ajaxDisplay = document.getElementById('checkdiv');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
				
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}
//This function will store appointment details
		function getbidderdata(id,k)
		{
			var getselect="biddercount_" +id + "_" + k ;
			var getaddress="officeaddress_" +id + "_" + k ;
			var newid=id + "_" + k ;
			var gettime="timeslab_" +id + "_" + k
			if(document.insurance.getaddress.value="on")
			{
				var new_address="1";
			}
			else
			{
				 var new_address="2";
			}
			var new_select = document.getElementById(getselect).value;
			//var new_address = document.getElementById(getaddress).value;
			var new_time = document.getElementById(gettime).value;
			var new_city = document.getElementById('city').value;
			var new_resquestid = document.getElementById('customerid').value;
		
			alert(getselect);
			
					
			if((new_select!=""))
			{
				var queryString = "?select=" + new_select + "&resquestid=" +  new_resquestid + "&city=" + new_city + "&address=" + new_address + "&newid=" + newid + "&time=" + new_time ;
				alert(queryString); 
				ajaxRequest.open("GET", "get_bidderappointment_details.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						var ajaxDisplay = document.getElementById('getcontent');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
				
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}

//this function will show appointment status and details of bidders
		function getbiddergrid(id)
		{
			var new_bidderid = document.getElementById(id).value;
			var new_resquestid = document.getElementById('customerid').value;
				alert(new_bidderid);	
			if((new_bidderid!=""))
			{

				var queryString = "?bidderid=" + new_bidderid + "&resquestid=" +  new_resquestid ;
				alert(queryString); 
				ajaxRequest.open("GET", "get_eligible_grid.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						var ajaxDisplay = document.getElementById('getgrid');
					   ajaxDisplay.innerHTML = ajaxRequest.responseText;
				
					}
				}

				ajaxRequest.send(null); 
			 }
			
		
		}

	window.onload = ajaxFunction;

</script>

	<script Language="JavaScript" Type="text/javascript">


		


</script>
</head>
<body>


<div class="style1" align="center">fill the form</div>
<form name="insurance" action="viewcomplete_customerdetails.php" method="Post" onSubmit="return insuranceform();">
<table width="500" border="0" cellspacing="2" cellpadding="3" align="center" style="border:1px solid;">
<tr><td colspan="2">&nbsp;</td></tr>
<!--<tr><td colspan="2" class="style1"><a onclick="addElementdetails();" style="cursor:pointer; color:#0F74D4;">Check the details you have already filled</a></td></tr>
<tr><td colspan="2" class="style1"><div id="getdetails" class="style1"></div></td></tr>-->
<tr>
       <td class="style1">Email</td>
       <td class="style1"><input name="email" type="text" id="email">
       </td>
</tr>
<tr>
       <td class="style1">DOB</td>
       <td class="style1"><input name="day" type="text" id="day" size="2" maxlength="2" value="DD">
         <input name="month" type="text" id="month" size="2" maxlength="2;" value="MM">
         <input name="year" type="text" id="year" size="4" maxlength="4" value="YYYY">
        </td>
     </tr>
	 	<tr>
  	<td class="style1">Net  Salary</td>
  	<td><input type="text" name="net_salary" id="net_salary" onChange="insertTemp();"  ></td>
  </tr>
  <tr>
  	<td class="style1">Total Loans outstanding</td>
  	<td><input type="text" name="total_loans" id="total_loans" onChange="insertTemp();"  ></td>
  </tr>
	 <tr><td colspan="2"><input type="hidden" name="customerid" id="customerid" value="<? echo $last_inserted_id;?>"></td></tr>
<tr><td colspan="2"><input type="hidden" name="city" id="city" value="<?echo $cityvalue;?>"><input type="hidden" name="mobile" id="mobile" value="<?echo $mobile;?>"></td></tr>
<tr>
<td class="style1">Residence Address</td>
<td class="style1"><textarea cols="20" rows="3" name="residence_address" id="residence_address" value="Address" onChange="insertTemp();"></textarea></td>
</tr>
<tr>
<td class="style1">Office Address</td>
<td class="style1"><textarea cols="20" rows="3" name="office_address" id="office_address" value="Address" ></textarea></td>
</tr>
<tr><td colspan="2" class="style1" align="center"><div id="getcontent" name="getcontent"></div></td></tr>

<tr><td colspan="2" class="style1" align="center"><div id="checkdiv" name="checkdiv"></div></td></tr>
<tr><td colspan="2" class="style1" align="center"><div id="getgrid" name="getgrid" style="color:red;"></div></td></tr>


<tr><td colspan="2">&nbsp;</td></tr>
<tr><td colspan="2" class="style1" align="center"><input name="submit" type="submit" class="style1" value="submit"/></td></tr>

  </table>
  </form>


</body>


</html>