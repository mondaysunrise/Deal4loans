<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		foreach($_POST as $a=>$b)
			$$a=$b;
	
		$Email = $_POST["ccemail"];
		$Name=$_POST['ccname'];
		$Phone = $_POST["ccmobile"];
		
		$Employment_Status = $_POST["ccemployment_status"];
		
		$Net_Salary = $_POST["ccnet_salary"];
		$CC_Holder = $_POST["cccc_holder"];
		$Company_Name = $_POST["cccompany_name"];
		$Pincode = $_POST["ccpincode"];
		$City = $_POST["cccity"];
		$City_Other = $_POST["cccity_other"];
		$No_of_Banks =$_POST["No_of_Banks"];
		$ccadd_comment= $_REQUEST['ccadd_comment'];
		$Credit_Limit = $_REQUEST["Credit_Limit"];
		$Card_Vintage = $_REQUEST["Card_Vintage"];
		$Salary_Account = $_REQUEST["salary_account"];
		 $n = count($Salary_Account);
				 $i  = 0;
				while ($i < $n)
				{
				  $Salary_Arr .= "$Salary_Account[$i], ";
				 $i++;
				 }

$validMobile = is_numeric($Phone);
		$validYear  = is_numeric($Year);
		$validMonth = is_numeric($Month);
		$validDay = is_numeric($Day);
		
		if(($validMobile==1) && ($Name!=""))
{
$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From Req_Credit_Card Where (Mobile_Number='".$Phone."' and Mobile_Number not in ('9811555306','9971396361','9811215138','9999047207','9873678914','9999570210') and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
	$myrowcontr=count($myrow)-1;
		
	if($alreadyExist>0)
	{
		$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				//echo "<script language=javascript>"." location.href='update-credit-card-lead.php'"."</script>";
			}
			else
			{
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr = count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated=ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Cpp_Compaign'=>$cpp_card_protect, 'Pincode'=>$Pincode, 'No_of_Banks'=>$No_of_Banks, 'Company_HDFC_Cat'=>$Company_HDFC_Cat, 'ABMMU_flag'=>$ABMMU_flag, 'Company_ICICI_Cat'=>$Company_ICICI_Cat, 'Salary_Account'=>$Salary_A, 'Privacy'=>$accept, 'Credit_Limit'=>$Credit_Limit, 'Loan_Any'=>$Loan_A, 'Applied_With_Banks'=>$loanbank_n, 'Add_Comment'=>$ccadd_comment, 'applied_card_name'=>'ICICI Bank', 'Allocated'=>'1');
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc ('wUsers', $wUsersdata);
				$dataInsert = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'Employment_Status'=>$Employment_Status, 'Company_Name'=>$Company_Name, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'DOB'=>$DOB, 'IsPublic'=>$IsPublic, 'Dated'=>$Dated, 'Reference_Code'=>$Reference_Code, 'source'=>$source, 'Pancard'=>$Pancard, 'CC_Holder'=>$CC_Holder, 'Card_Vintage'=>$Card_Vintage, 'IP_Address'=>$IP, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Cpp_Compaign'=>$cpp_card_protect, 'Pincode'=>$Pincode, 'No_of_Banks'=>$No_of_Banks, 'Company_HDFC_Cat'=>$Company_HDFC_Cat, 'ABMMU_flag'=>$ABMMU_flag, 'Company_ICICI_Cat'=>$Company_ICICI_Cat, 'Salary_Account'=>$Salary_A, 'Privacy'=>$accept, 'Credit_Limit'=>$Credit_Limit, 'Loan_Any'=>$Loan_A, 'Applied_With_Banks'=>$loanbank_n, 'Add_Comment'=>$ccadd_comment, 'applied_card_name'=>'ICICI Bank', 'Allocated'=>'1');
			}
			//echo "".$InsertProductSql."<br>";
			$ProductValue = Maininsertfunc ('Req_Credit_Card', $dataInsert);	
			}
}
			else
			{
			echo "Wrong entry";
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
<script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
<script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-cclist.js"></script>
<STYLE>
a
{	cursor:pointer;
}
.bluebutton {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: blue;
	font-weight: bold;
}

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
</head>
<body>
<p align="center"><b>Credit Card Lead Details </b></p>
<style>
.fontstyle
	{
		font-family:Verdana Arial, Helvetica, sans-serif;
		font-size:12px;
	}
</style>
<form name="ccleadentry_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" >
<table style='border:1px dotted #9C9A9C;' cellspacing="2" cellpadding="5" width="600" height="80%" align="center" border="0" >
<tr>
	<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr>
		<tr>
			<td class="fontstyle" width="150"><b> Name</b></td>
			<td class="fontstyle" width="150"><input type="text" name="ccname" id="ccname" ></td>
			<td class="fontstyle" width="150"><b>Email id</b></td>
			<td class="fontstyle" width="150"><input type="text" name="ccemail" id="ccemail" ></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>DOB</b></td>
			<td class="fontstyle"><input type="text" name="ccdob" size="15" value="<?echo $DOB;?>"></td>
			<td class="fontstyle"><b>Mobile</b></td>
			<td class="fontstyle">+91<input type="text" name="ccmobile" size="15" value="<?echo $Mobile;?>"></td>
			</tr>			
		<tr>
			<td class="fontstyle"><b>Residence No</b></td>
			<td class="fontstyle"><input type="text" name="ccstd_code" size="1" >-<input type="text" name="cclandline" size="8" value="<?echo $Landline;?>"></td>
			<td class="fontstyle" ><b>Office No.</b></td>
			<td class="fontstyle"><input type="text" name="ccstd_code_o"  size="1" >-<input type="text" name="cclandline_o" size="9" value="<?echo $Landline_O;?>"></td>
		</tr>				
		<tr>
			<td class="fontstyle"><b>City</b></td>
			<td class="fontstyle"><select size="1" name="cccity" id="cccity"> <?=getCityList($City)?></select></td>
			<td class="fontstyle"><b>Other City</b></td>
			<td class="fontstyle"><input type="text" name="cccity_other" id="cccity_other" size="10"  ></td>
		</tr>
		<tr>
		<td class="fontstyle"><b>Pincode</b></td><td><input type="text" name="ccpincode" size="10" ></td>
        <td class="fontstyle"><b>Salary Account</b></td><td><select  name="Salary_Account" id="Salary_Account" multiple><option value="">Please Select</option> <? $bnknm=ExecQuery("select Bank_Name from Bank_Master group by Bank_Name "); 
	while($plbnk=mysql_fetch_array($bnknm))
	{ ?>
			<option value="<? echo $plbnk["Bank_Name"]; ?>" 
			<?php if((strlen(strpos($Salary_Account, $plbnk["Bank_Name"])) > 0)) echo "Selected"; ?>><? echo $plbnk["Bank_Name"]; ?></option>
	<? }
	?>
<option value="Other" <? if(strtoupper($Primary_Acc)=="OTHER") { echo "Selected";} ?>>Other</option></select></td>
				</tr>		
		
	<tr>
		<td colspan="4" bgcolor="#DAEAF9" align="center" style="border:1px solid black;"><b>Employment Details</b></td></tr>
	<tr>
		<td class="fontstyle"><b>Employment Status</b></td>
		<td class="fontstyle"><select class="fontstyle" name="ccemployment_status" id="ccemployment_status">
			<option value="1" <?if($Employment_Status ==1){echo "selected"; }?>>Salaried</option>
			<option value="0" <?if($Employment_Status ==0) {echo "selected"; }?>>Self Employed</option></select>
		</td>
		<td class="fontstyle"><b>Annual Income</b></td>
		<td class="fontstyle"><input type="text" name="ccnet_salary" id="ccnet_salary" value="<?echo $Net_Salary;?>"  onKeyUp="getDigitToWords('ccnet_salary','formatedIncome','wordIncome');" onKeyPress="getDigitToWords('ccnet_salary','formatedIncome','wordIncome');" style="float: left" onBlur="getDigitToWords('ccnet_salary','formatedIncome','wordIncome');"></td>
	</tr>
	<tr><td class="fontstyle"><b>Company Name</b></td>
	<td class="fontstyle"><input type="text" name="cccompany_name" id="cccompany_name" ></td>

	<td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px;
font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
</tr>
<tr>
<td><label for="country">check Company Name </label></td>
<td><input name="company" id="company"   type="text" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" value="<? echo $Company_Name;?>" size=45/>                                   
</td><td colspan="2">&nbsp;</td></tr>
<tr>
<td colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" style="border:1px solid black;"><b>Surrogate Details</b></td></tr>
<tr>
	<td class="fontstyle"><b>Credit Card Holder </b></td>
	<td class="fontstyle"><input type="radio" value="1" name="cccc_holder" id="cccc_holder" <? if($CC_Holder==1){ echo "checked";}?> class="NoBrdr" checked>Yes
     <input type="radio" value="0" name="cccc_holder"  id="cccc_holder" class="NoBrdr" <? if($CC_Holder==0){ echo "checked";}?>>No</td> 
					<td class="fontstyle"><b>Bank Name</b></td>
					<td class="fontstyle"><select size="1" name="No_of_Banks" id="No_of_Banks" >
					<option value="0" <? if($No_of_Banks==0) {echo "Selected"; } ?>>Please select</option> 
					<option value="HDFC Bank" <? if($No_of_Banks=="HDFC Bank") { echo "Selected"; } ?>>HDFC Bank</option> 
					<option value="Standard Chartered" <? if($No_of_Banks=="Standard Chartered") { echo "Selected"; } ?>>Standard Chartered</option>
					 <option value="Kotak Bank" <? if($No_of_Banks=="Kotak Bank") { echo "Selected"; } ?>>Kotak Bank</option>
					 <option value="ICICI Bank" <? if($No_of_Banks=="ICICI Bank") { echo "Selected"; } ?>>ICICI Bank</option>
					 <option value="Other" <? if($No_of_Banks=="Other") {echo "Selected"; } ?>>Other</option></select></td>
			   </tr>
               <tr>
	<td class="fontstyle"><b>Card Vintage </b></td>
	<td class="fontstyle"><select size="1" name="Card_Vintage" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
    <option value="0" <? if($Card_Vintage==0) { echo "Selected"; } ?>>Please select</option> 
    <option value="1" <? if($Card_Vintage==1) { echo "Selected"; } ?>>Less than 6 months</option> 
    <option value="2" <? if($Card_Vintage==2) { echo "Selected"; } ?>>6 to 9 months</option> 
    <option value="3" <? if($Card_Vintage==3) { echo "Selected"; } ?>>9 to 12 months</option>
    <option value="4" <? if($Card_Vintage==4) { echo "Selected"; } ?>>more than 12 months</option> </select></td>	 
		<td class="fontstyle"><b>Credit Limit</b></td>
		 <td class="fontstyle"><select size="1" name="Credit_Limit" id="Credit_Limit" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >                     
            <option value="0" <? if($Credit_Limit==0) { echo "Selected"; } ?>>Please select</option>                        
            <option value="1"  <? if($Credit_Limit==1) { echo "Selected"; } ?>>Upto 75,000</option>                       
             <option value="2" <? if($Credit_Limit==2) { echo "Selected"; } ?>>75,000 to 1,50,000 </option> 
                                    <option value="3" <? if($Credit_Limit==3) { echo "Selected"; } ?>>1,50,000 & Above</option>                       </select>
					</td>
			   </tr>  

	<tr><td class="fontstyle"><b>Source</b></td>
		<td><input type="hidden" name="source" value="manual_entry" ></td>
		<td><b>Add Comment</b></td>
		<td><textarea rows="2" cols="20" name="ccadd_comment" id="ccadd_comment" ><? echo $Add_Comment; ?></textarea></td>
	</tr>

 <tr>
     <td colspan="4" align="center"><p>
       <input type="submit" class="bluebutton" value="Submit">
     </p>       
      </td>
   </tr>
</table>
</form>
</body>
</html>