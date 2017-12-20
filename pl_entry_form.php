<?php
ob_start();
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderfuncPL.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
			$$a=$b;

		$request = FixString($request);
		$Name = FixString($Name);
		$DOB=FixString($DOB);
		$Pincode = FixString($Pincode);
		$Phone = FixString($Mobile_Number);
		$Employment_Status = FixString($Employment_Status);
		$Phone1 = FixString($Landline);
		$Std_Code1 = FixString($Std_Code);
		$Card_Vintage = FixString($Card_Vintage);
		$CC_Holder = FixString($CC_Holder);
		$EMI_Paid = FixString($EMI_Paid);
		$Net_Salary = FixString($Net_Salary);
		$Card_Limit = FixString($Card_Limit);
		$Email = FixString($Email);
		$Primary_Acc = FixString($Primary_Acc);
		$Type_Loan = "Req_Loan_Personal";
		$Company_Name = FixString($Company_Name);
		$Loan_Amount = FixString($Loan_Amount);
		$Accidental_Insurance = FixString($Accidental_Insurance);
		$City = FixString($City);
		$Primary_Acc = FixString($Primary_Acc);
		$Final_Bidder = $_REQUEST['Final_Bidder'];
		$Residential_Status =FixString($Residential_Status);
		$Loan_Any = $_REQUEST['Loan_Any'];
		$Total_Experience = FixString($Total_Experience);
		$Years_In_Company = FixString($Years_In_Company);
		$City_Other = FixString($City_Other);

		$Final_Bid = "";
		while (list ($key,$val) = @each($Final_Bidder)) { 
			$Final_Bid = $Final_Bid."$val,"; 
		} 

$Final_Bid = substr($Final_Bid, 0, strlen($Final_Bid)-1); //remove the final comma sign from the final array
//echo "hello".$Final_Bid."<br>";
if(strlen($Final_Bid)>0)
	{
	$Allocated=2;
	}
	else 
	{
		$Allocated=0;
	}

		
	$IsPublic = 1;

		$n       = count($Loan_Any);
		   $i      = 0;
		   while ($i < $n)
		   {
			  $From_Pro .= "$Loan_Any[$i], ";
			 $i++;
		   }
		$source=$_REQUEST['source'];
		$IP = getenv("REMOTE_ADDR");

function InsertTataAig($RequestID, $ProductName)
	{
		$GetDateSql = ("select Dated, City, City_Other, Mobile_Number from ".$ProductName." where RequestID = $RequestID");
		 list($recordcount,$RowGetDate)=MainselectfuncNew($GetDateSql,$array = array());
		$cntr=0;
		
		$TDated = $RowGetDate[$cntr]['Dated'];
		$TCity = $RowGetDate[$cntr]['City'];
		$Mobile = $RowGetDate[$cntr]['Mobile_Number'];
		$Product_Name =1;
		$dataInsert = array("T_RequestID"=>$RequestID, "T_Product"=>$Product_Name, "T_City"=>$TCity, "Mobile_Number"=>$Mobile, "T_Dated"=>$Dated);
		$table = 'tataaig_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
	}


		$validMobile = is_numeric($Phone);
		

		if(($validMobile==1) )
{		
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			 list($CheckNumRows,$getrow)=MainselectfuncNew($CheckSql,$array = array());
			$k=0;
			if($CheckNumRows>0)
			{
				$UserID = $getrow[$k]['UserID'];
					$dataInsert = array("UserID"=>$UserID, "Name"=>$Name, "Email"=>$Email, "Employment_Status"=>$Employment_Status, "Company_Name"=>$Company_Name, "City"=>$City, "City_Other"=>$City_Other, "Mobile_Number"=>$Phone, "Std_Code"=>$Std_Code1, "Landline"=>$Phone1, "Net_Salary"=>$Net_Salary, "CC_Holder"=>$CC_Holder, "Loan_Amount"=>$Loan_Amount, "DOB"=>$DOB, "Count_Views"=>0, "Count_Replies"=>0, "IsModified"=>0, "IsProcessed"=>0, "IsPublic"=>$IsPublic, "Dated"=>$Dated, "Pincode"=>$Pincode, "Reference_Code"=>$Reference_Code, "source"=>$source, "CC_Bank"=>$From_Pro, "Card_Vintage"=>$Card_Vintage, "Referrer"=>$Referrer, "Creative"=>$Creative, "Section"=>$Section, "Updated_Date"=>$Dated, "IP_Address"=>$IP, "Accidental_Insurance"=>$Accidental_Insurance, 'Residential_Status'=>$Residential_Status, 'EMI_Paid'=>$EMI_Paid, 'Total_Experience'=>$Total_Experience, 'Years_In_Company'=>$Years_In_Company);
			$table = 'Req_Loan_Personal';
$Insertvalue = Maininsertfunc ($table, $dataInsert);
			}
			else
			{
				$dataInsert = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$table = 'wUsers';
				$UserID = Maininsertfunc ($table, $dataInsert);
				
				$dataUpdate = array('Card_Limit'=>$Card_Limit, 'Total_Experience'=>$Total_Experience, 'Years_In_Company'=>$Years_In_Company, 'Primary_Acc'=>$Primary_Acc, 'Bidderid_Details'=>$Final_Bid, 'Allocated'=>$Allocated, 'UserID'=>$UserID1, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Std_Code'=>$Std_Code, 'Landline'=>$Landline, 'Net_Salary'=>$Net_Salary, 'CC_Holder'=>$CC_Holder, 'Loan_Amount'=>$Loan_Amount, 'DOB'=>$DOB, 'Dated=Now(),Pincode'=>$Pincode, 'source'=>$source, 'Loan_Any'=>$From_Pro, 'Card_Vintage'=>$Card_Vintage, 'Updated_Date=Now(),IP_Address'=>$IP, 'Accidental_Insurance'=>$Accidental_Insurance, 'Residential_Status'=>$Residential_Status, 'EMI_Paid'=>$EMI_Paid);
				$wherecondition = "(RequestID=".$request.")";
	Mainupdatefunc ('Req_Loan_Personal', $dataUpdate, $wherecondition);
			}
		
			if($Accidental_Insurance=="1")
				{
					InsertTataAig($Insertvalue, "Req_Loan_Personal");
				}
			//$_SESSION['Temp_LID'] = $ProductValue;
		
			
			
			
			
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Personal Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Personal Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
}

		}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="includes/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
<style type="text/css">
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:280px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    color: black;
		text-align:left;
		font-size:0.9em;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:0.9em;
	}
	#ajax_listOfOptions .optionDiv{	/* Div for each item in list */
		
	}
	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>
<script>
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
////////////////To view bidders after clicking contactable //////////////////
		function insertEligibleBidder()
		{
			var new_mobile = document.getElementById('Mobile_Number').value;
			//alert(new_mobile);
			var queryString = "?mobile=" + new_mobile;
			//alert(queryString); 
				ajaxRequest.open("GET", "get_plmobile_details.php" + queryString, true);
				// Create a function that will receive data sent from the server
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4)
					{
						var ajaxDisplay = document.getElementById('mob_det');
						ajaxDisplay.innerHTML = ajaxRequest.responseText;
						alert("Now check");
						//alert(ajaxRequest.responseText);
					
					}
				}

				ajaxRequest.send(null); 
			 }
			 	window.onload = ajaxFunction;
		
			</script>
</head>
<body>
<form name="loan_form" method="post" action="pl_entry_form_continue.php" >
<input type="hidden" name="source" id="source" value="missed_call"/>
<table width="500" cellpadding="2" cellspacing="0" style="border:1px solid;" align="center">

<tr>
	<td style="border:1px solid black;" colspan="2" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b> Name</b></td>
			<td class="fontstyle" width="150"><input type="text" name="Name" id="Name" ></td>
			</tr>
			<tr>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><input type="text" name="Email" id="Email" ></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><input type="text" name="DOB" id="DOB"size="15" >(yyyy-mm-dd)</td>
			</tr>
			<tr>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<input type="text" name="Mobile_Number" id="Mobile_Number" size="15" > <a onClick="insertEligibleBidder();" style="cursor:pointer;"> view Details</a></td>
			</tr>
				
		<tr>
			<td class="fontstyle"><b>City</b></td>
			<td class="fontstyle"><select size="1" name="City" id="City"> <?=getCityList($City)?></select></td></tr>
			<tr>
			<td class="fontstyle"><b>Other City</b></td>
			<td class="fontstyle"><input type="text" name="City_Other" id="City_Other" size="10"  ></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>Pincode</b></td><td><input type="text" name="Pincode" id="Pincode" size="10"  ></td></tr>
		<tr>
			<td class="fontstyle"><b>Residence Status</b></td>
			<td  class="fontstyle"><select name="Residential_Status" id="Residential_Status" style="width: 203px;">
		  <option value="0">Please Select</option>
		  	<option value="4" >Owned By Self/Spouse</option>
			<option value="1" >Owned By Parent/Sibling</option>
			<option value="3" >Company Provided</option>
			<option value="5"  >Rented - With Family</option>
			<option value="6" >Rented - With Friends</option>
			<option value="2" >Rented - Staying Alone</option>
			<option value="7">Paying Guest</option>
			<option value="8">Hostel</option>
			</select></td>
			
		</tr>
		
		
	
		<tr>
			<td class="fontstyle" ><b>Primary Account in which bank?</b>			</td>
	<td><select  name="Primary_Acc" id="Primary_Acc"><option value="">Please Select</option> <?
	$bnknm=("select Bank_Name from Bank_Master group by Bank_Name "); 
	list($CheckNumRows,$plbnk)=MainselectfuncNew($bnknm,$array = array());
	for($ii=0;$ii<$CheckNumRows;$ii++)
	{ ?>
			<option value="<? echo $plbnk[$ii]["Bank_Name"]; ?>" <? if(strtoupper($Primary_Acc)==strtoupper($plbnk[$ii]["Bank_Name"])) { echo "Selected";} ?>><? echo $plbnk[$ii]["Bank_Name"]; ?></option>
	<? }
	?>
<option value="Other" <? if(strtoupper($Primary_Acc)=="OTHER") { echo "Selected";} ?>>Other</option></select></td>
</tr>
			
	
	<tr>
		<td class="fontstyle"><b>Employment Status</b></td>
		<td class="fontstyle"><select class="fontstyle" name="Employment_Status" id="Employment_Status">
			<option value="1" >Salaried</option>
			<option value="0" >Self Employed</option></select>
		</td>
		</tr>
		<tr>
		<td class="fontstyle"><b>Annual Income</b></td>
		<td class="fontstyle"><input type="text" name="Net_Salary" id="Net_Salary"   onKeyUp="getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onKeyPress="getDigitToWords('Net_Salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"></td>
	</tr>
	
	<tr>
	<td class="fontstyle"><b>Company Name</b></td>
	<td class="fontstyle"><input type="text" name="Company_Name" id="Company_Name" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)"></td></tr>
	

	<tr>
		<td class="fontstyle"><b>Total Experience</b></td>
		<td class="fontstyle"><input type="text" name="Total_Experience" id="Total_Experience" size="5" ><b>(years)</b>
		</td></tr>
		<tr>
		<td class="fontstyle"><b>Current experience in company</b></td>
		<td class="fontstyle"><input type="text" name="Years_In_Company" id="Years_In_Company"  size="5"><b>(years)</b></td>
	</tr>
	



<tr>
	<td class="fontstyle"><b>Credit Card Holder </b></td>
	<td class="fontstyle"><input type="radio" value="1" name="CC_Holder" id="CC_Holder"  class="NoBrdr">Yes
     <input type="radio" value="0" name="CC_Holder"  id="CC_Holder" class="NoBrdr" >No</td>
	 </tr>
	 
<tr>
	<td class="fontstyle"><b>Card held since?</b></td><td class="fontstyle"><select  class="fontstyle" size="1" name="Card_Vintage" id="Card_Vintage">
	<option value="0" >Please select</option>
	<option value="1" >Less than 6 months</option>
	<option value="2" >6 to 9 months</option> 
	<option value="3" >9 to 12 months</option>
	<option value="4" >more than 12 months</option>
	</select></td>	</tr>
	<tr>
	<td class="fontstyle"><b>Loan Amount Required</b></td>
	<td class="fontstyle"><input type="text" name="Loan_Amount" id="Loan_Amount"   onKeyUp="getDigitToWords('Loan_Amount','formatedloan','wordloan');" onKeyPress="getDigitToWords('Loan_Amount','formatedloan','wordloan');" style="float: left" onBlur="getDigitToWords('Loan_Amount','formatedloan','wordloan');"></td>
</tr>

<tr>
	<td class="fontstyle"><b>Any Loan Running ?</b></td>
	
	<td >
		<table border="0">	
			<tr>
				<td class="fontstyle"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr" value="hl" >Home</td>
				<td class="fontstyle"><input type="checkbox" class="noBrdr" id="Loan_Any" name="Loan_Any[]" value="pl" >Personal</td>
			</tr>
			<tr>
				<td class="fontstyle"><input type="checkbox" id="Loan_Any" name="Loan_Any[]" class="noBrdr"  value="cl" >Car</td>
				<td class="fontstyle"><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="lap" >Property</td>
			</tr>
			<tr>
				<td colspan="2" class="fontstyle"><input type="checkbox" name="Loan_Any[]" id="Loan_Any" class="noBrdr" value="other" >Other</td>
			</tr> 
		</table>
	</td>
</tr><tr>
		<td class="fontstyle"><b>No of Emis Paid for oldest loan</b></td>
		<td class="fontstyle">
			<select name="EMI_Paid" id="EMI_Paid" class="fontstyle">
				<option value="0">Please select</option>
				<option value="1" >Less than 6 months</option>
				<option value="2" >6 to 9 months</option> 
				<option value="3" >9 to 12 months</option>
				<option value="4" >more than 12 months</option> 
			</select>
		</td>
		
	</tr>
	
<tr>
	<td colspan="2" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Mobile Details </b></td></tr>
</tr>
<tr><td  colspan="2">
	<table width="100%">
	<tr>
			<td width="59"><div align="center">RequestID</div></td>
			<td width="48"><div align="center">Name</div></td>
			<td width="75"><div align="center">Mobile Number</div></td>
			<td width="45"><div align="center">Salary</div></td>
			<td width="79"><div align="center">City</div></td>
			<td width="62"><div align="center">No of Bidders</div></td>
			<td width="94"><div align="center">DOE</div></td>
		</tr>
		<tr><td colspan="7"> <div id="mob_det">
		<table cellpadding="0" cellspacing="0" width="100%"><tr>
			<td><div align="center"><?php echo $row["RequestID"]; ?></div></td>
			<td><div align="center"><?php echo $row["Name"]; ?></div></td>
			<td><div align="center"><?php echo $row["Mobile_Number"];?></div></td>
			<td><div align="center"><?php echo  $row["Net_Salary"];?></div></td>
			<td><div align="center"><?php echo $row["City"]; ?></div></td>
			<td><div align="center"><?php echo $row["Bidder_Count"]; ?></div></td>
			<td><div align="center"><?php echo $row["Updated_Date"]; ?></div></td>
		</tr></table></div></td>
		
	</table></td></tr>
	
<tr><td colspan="2" align="center">&nbsp;</td></tr>
<tr><td colspan="2" align="center"><div id="checkdiv"></div></td></tr>

	
<tr><td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td></tr>
</table>
</form>
</body>
</html>
