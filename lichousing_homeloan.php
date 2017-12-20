<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
		//$Name=$Full_Name;
		$Full_Name=FixString($Full_Name);
		$Day=FixString($day);
		$Email=FixString($Email);
		$Month=FixString($month);
		$Year=FixString($year);
		$DOB=$Year."-".$Month."-".$Day;
		$Mobile_Number = FixString($Mobile_Number);
		$Phone1 = FixString($Phone1);
		$Std_Code1 = FixString($Std_Code1);
		$Pincode = FixString($Pincode);
		$Residence_Address = FixString($Residence_Address);
		$Employment_Status = FixString($Employment_Status);
		$City = FixString($City);
		$City_Other = FixString($City_Other);
		$Net_Salary = FixString($Net_Salary);
		$Property_Identified = FixString($Property_Identified);
		$Property_Location = FixString($Property_Location);
		$Loan_Amount = FixString($Loan_Amount);
		$Dated = ExactServerdate();
		//$Bidderid_Details="794";
		//$Allocated= 2;
		$source="calling";

$licselect="select RequestID From Req_Loan_Home where Mobile_Number=".$Mobile_Number." or Email='$Email'" ;
//echo $licselect."<br>";
 list($recordcount,$row)=MainselectfuncNew($licselect,$array = array());
		$cntr=0;

//$licselectresult=ExecQuery($licselect);
//$recordcount = mysql_num_rows($licselectresult);
while($cntr<count($row))
        {
			$newRequestID=$row[$cntr]['RequestID'];
			$cntr = $cntr +1;
		}
if(($recordcount)>0)
		{
		//$lichousingquery="UPDATE Req_Loan_Home Name='$Full_Name', Email='$Email', Employment_Status='$Employment_Status', City='$City', City_Other='$City_Other', Mobile_Number=$Mobile_Number, Std_Code='$Std_Code1', Landline='$Phone1', Net_Salary='$Net_Salary', Loan_Amount='$Loan_Amount', DOB='$DOB', Pincode='$Pincode', Residence_Address='$Residence_Address', source='$source',Property_Identified='$Property_Location', Property_Loc='$Property_Location' where RequestID=".$newRequestID;
		echo "hello".$lichousingquery."<br>";
		
		//$lichousingresult= ExecQuery($lichousingquery);
		$DataArray = array("Name"=>$Full_Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Mobile_Number, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Pincode"=>$Pincode, "Residence_Address"=>$Residence_Address, "source"=>$source, "Property_Identified"=>$Property_Location, "Property_Loc"=>$Property_Location);
		$wherecondition ="RequestID=".$newRequestID;
		Mainupdatefunc ('Req_Loan_Home', $DataArray, $wherecondition);
		
		//$licleadentry="Insert into Req_Feedback_Bidder1 (AllRequestID,BidderID,Reply_Type,Allocation_Date)
		//Values ('$newRequestID', 794, 2, Now())";
		//echo $licleadentry."<br>";
		//$licleadentryresult= ExecQuery($licleadentry);
		
			$dataInsert = array("AllRequestID"=>$newRequestID, "BidderID"=>794, "Reply_Type"=>2, "Allocation_Date"=>$Dated);
			$table = 'Req_Feedback_Bidder1';
			$insert = Maininsertfunc ($table, $dataInsert);
		
		}

		
	}

?>
<html>
<head>

<link href="includes/style1.css" rel="stylesheet" type="text/css">
<script>
function addIdentified()
{
		var ni = document.getElementById('myDiv1');
				
		if(ni.innerHTML=="")
		{
		
			if(document.lic_housing.Property_Identified.value="on")
			{
				ni.innerHTML = '';
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '<table border="0" width="70%"><tr><td class="bodyarial11"> Property Location</td><td class="bodyarial11" ><select size="1" align="center"   name="Property_Location">	  <?=getCityList1($City)?>	 </select>			</td>			</tr>	</table>';
			}
			
		}
			
		return true;
	}
	function removeIdentified()
{
		var ni = document.getElementById('myDiv1');
		
		if(ni.innerHTML!="")
		{
		
			if(document.lic_housing.Property_Identified.value="on")
			{
				//alert(document.loan_form.CC_Holder.value);
				ni.innerHTML = '';
				
			}
		}
		
		return true;

	}
	function cityother()
{
	if(lic_housing.City.value=="Others")
	{
		lic_housing.City_Other.disabled = false;
	}
	else
	{
		lic_housing.City_Other.disabled = true;
	}
} 
</script>
</head>
<body>
<form name="lic_housing" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>">
<table align="center" width="500" cellpadding="4" cellspacing="3" border="0" class="blueborder"> 
<tr><td colspan="2" align="center"><b>LIC HOUSING FORM</b></td></tr>
<tr>
     <td class="bodyarial11">Your Email Address</td>
     <td width="70%" class="bodyarial11">
     <input type="text" name="Email" size="30"  onFocus="return Decoration('*')" onBlur="return Decoration1(' ')"></td>
   </tr>
 
   <tr>
       <td class="bodyarial11">First Name<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input type="text" name="Full_Name" size="20" maxlength="30"></td>
     </tr>
     
     <tr>
       <td class="bodyarial11">DOB<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11"><input name="day" type="text" id="day" size="2" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
         <input name="month" type="text" id="month" size="2" maxlength="2" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
         <input name="year" type="text" id="year" size="2" maxlength="4" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";>
         (DD-MM-YYYY)</td>
     </tr>
     <tr>
       <td class="bodyarial11">Mobile (For SMS Alerts)<font size="1" color="#FF0000">*</font></td>
       <td class="bodyarial11">+91<input type="text" name="Mobile_Number" size="18" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
     </tr>
	<tr>
       <td class="bodyarial11" align="bottom">Landline No</td>
	   <td class="bodyarial11"><input type="text" name="Std_Code1" size="1" maxlength="5" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)";><input type="text" name="Phone1" size="15" maxlength="10" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
     </tr>
   <tr>
     <td class="bodyarial11">Employment Status</td>
     <td width="70%" class="bodyarial11"><select size="1" name="Employment_Status">
		<option value="-1">Please Select</option>
     	<option value="1">Salaried</option>
     	<option value="0">Self Employed</option>
     </select></td>
   </tr>
   <tr>
     <td valign="top" class="bodyarial11">Residence Address<font size="1" color="#FF0000">*</font></td>
     <td width="70%" class="bodyarial11"><textarea rows="3" name="Residence_Address" cols="40"></textarea></td>
   </tr>
   <tr>
     <td class="bodyarial11">City Name<font size="1" color="#FF0000">*</font></td>
	 <td width="70%" class="bodyarial11"><select size="1" name="City" onChange="cityother()">
     <?=getCityList($City)?>
	 </select></td>
   </tr>
   <tr>
     <td class="bodyarial11">Others</td>
     <td width="70%" class="bodyarial11"><input type="text" name="City_Other" disabled value="Other City" onFocus="this.select();" size="10"></td>
     </td>
   </tr>
    <tr>
     <td class="bodyarial11">Pincode<font size="1" color="#FF0000">*</font></td>
     <td width="70%" class="bodyarial11"><input type="text" name="Pincode" onFocus="this.select();" size="10" maxlength="6" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"></td>
     </td>
   </tr>
 			 <tr>
     <td class="bodyarial11">Net Salary(Yearly)<font size="1" color="#FF0000">*</font></td>
     <td width="70%" class="bodyarial11">
       <input type="text" name="Net_Salary" id="Net_Salary" size="15" ></td>
   </tr>
  
    <tr>
     <td class="bodyarial11">Loan Amount Required<font size="1" color="#FF0000">*</font></td>
     <td width="70%" class="bodyarial11">
    <input type="text"  id="Loan_Amount" name="Loan_Amount" size="15" maxlength="30" ></td>
   </tr>
     <tr>
		<td class="bodyarial11">Property Identified</td>
		<td ><input type="radio"  name="Property_Identified"  class="NoBrdr"  value="1" onClick="addIdentified();">Yes
		<input size="10" type="radio" class="NoBrdr" name="Property_Identified" onClick="removeIdentified();" value="0" >No</td>
		</tr>
	<tr><td colspan="2" id="myDiv1"></td></tr>
	
   <tr>
     <td colspan="2" align="center" class="bodyarial11"><br><input type="submit" class="bluebutton" value="Submit"><input type="reset" class="bluebutton" value="Reset" ></td>
   </tr>
   </table>
   </form>
   </body>
   </html>