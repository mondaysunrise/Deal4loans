<?
require 'scripts/db_init.php';
require 'scripts/functions.php';

$reqdid = $_REQUEST["reqdid"];

$tudetails="Select * from icici_pl_cibili_check Where  	icicirequestID=".$reqdid; 
list($firstcount,$turow)=MainselectfuncNew($tudetails,$array = array());
$City = $turow[0]["City"];

?>
<html>
<body>
<table width="500" align="center" style="border:1px #000000 solid;">
<tr><td align="center">TU Process Fill Details</td></tr>
<tr><td>
<form name="icici_cc" action="icicipl_chktransunion_lms.php" method="POST" onSubmit="return ckhcreditcard(document.icici_cc); "><input type="hidden" name="RequestID" value="<? echo $reqdid;?>">
				
			<table width="90%">		       
         <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">Pancard</td>
		<td width="48%" align="left" class="frmbldtxt">
         <input type="text" name="Pancard" id="Pancard" class="input-bx12"  maxlength="10" tabindex="1" autocomplete="off" value="<? echo $turow["Panno"]; ?>"  />
        </td>
	</tr>
        	<tr><td class="frmbldtxt" align="bottom">Existing Relationship With ICICI Bank ?</td>	   <td class="frmbldtxt"><select name="existing_rel" id="existing_rel">	   
			<option value="">Please Select</option>        
			<option value="Salary Account" <? if($turow["Existing_Relation"]=="Salary") { echo "Selected";} ?>>Salary Account</option>	   
            <option value="Auto Loan" <? if($turow["Existing_Relation"]=="Auto Loan") { echo "Selected";} ?>>Auto Loan</option>	   
            <option value="Personal Loan" <? if($turow["Existing_Relation"]=="Personal Loan") { echo "Selected";} ?>>Personal Loan</option>	   
            <option value="Home Loan" <? if($turow["Existing_Relation"]=="Home Loan") { echo "Selected";} ?>>Home Loan</option>	   
            <option value="Fixed deposit" <? if($turow["Existing_Relation"]=="Fixed deposit") { echo "Selected";} ?>>Fixed deposit</option>	   
            <option value="Current Account" <? if($turow["Existing_Relation"]=="Current Account") { echo "Selected";} ?>>Current Account</option>	   
			<option value="Savings Account" <? if($turow["Existing_Relation"]=="Savings Account") { echo "Selected";} ?>>Savings Account</option>	   
			<option value="Credit card" <? if($turow["Existing_Relation"]=="Credit card") { echo "Selected";} ?>>Credit card</option>
            <option value="New to Bank" <? if($turow["Existing_Relation"]=="New to Bank") { echo "Selected";} ?>>New to Bank</option>	   </select></td>     </tr>
    <tr>
       <td class="frmbldtxt" align="bottom" colspan="2" id="myDiv"></td></tr>
       <tr>
		<td width="52%" height="28" align="left" >Address 1 </td>
		<td width="48%" align="left" >
          <textarea rows="2" cols="20" name="Residence_Address_line1" id="Residence_Address_line1" maxlength="40"><? echo $turow["Address"]; ?></textarea>
        </td>
	</tr>
	<tr>
		<td width="52%" height="28" align="left" >Address 2 </td>
		<td width="48%" align="left" >
          <textarea rows="2" cols="20" name="Residence_Address_line2" id="Residence_Address_line2" maxlength="40"><? echo $turow["Address"]; ?></textarea>
        </td>
	</tr>  
      <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">Pincode</td>
		<td width="48%" align="left" class="frmbldtxt">
          <input type="text" name="Pincode" id="Pincode" value="<? echo $turow["Pincode"]; ?>">
        </td>
	</tr>
     <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">City</td>
		<td width="48%" align="left" class="frmbldtxt">
          <select name="Address_City" id="Address_City" >
                            <?=plgetCityList($City)?>                 
                        </select>
        </td>
	</tr>
	
     <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">State</td>
		<td width="48%" align="left" class="frmbldtxt">
         <select name="Address_State" id="Address_State">
            <option value="">Select</option>
            <?php 
		   
		   		   $stateArr =array('Jammu and Kashmir','Himachal Pradesh','Punjab','Chandigarh','Uttaranchal','Haryana','Delhi','Rajasthan','Uttar Pradesh','Bihar','Sikkim','Arunachal Pradesh','Nagaland','Manipur','Mizoram','Tripura','Meghalaya','Assam','West Bengal','Jharkhand','Orissa','Chhattisgarh','Madhya Pradesh','Gujarat','Daman and Diu','Dadra and Nagar Haveli','Maharashtra','Andhra Pradesh','Karnataka','Goa','Lakshadweep','Kerala','TamilNadu','Pondicherry','Andaman and Nicobar Islands','APO Address');
		   for($stat=0;$stat<count($stateArr);$stat++)
			 {
				 if($stateArr[$stat]==$turow["Resistate"])
				 {
					 $selectd="Selected";
				 }
				 else
				 {
						$selectd="";
				 }
			 	echo "<option value='".$stateArr[$stat]."' ".$selectd.">".$stateArr[$stat]."</option>";
			 }
		   ?>
           </select>
        </td>
	</tr>
       <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">Gender</td>
		<td width="48%" align="left" class="frmbldtxt">
             <select name="Gender" id="Gender"  >
             <option value="">Select</option>
             <option value="Male" <? if($turow["Gender"]=="Male") { echo "Selected";} ?>>Male</option>
             <option value="Female" <? if($turow["Gender"]=="Female") { echo "Selected";} ?>>Female</option>
             </select>
        </td>
	</tr>
	
     <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">Duration Of Stay</td>
		<td width="48%" align="left" class="frmbldtxt"> <select name="staymonth">
        <option value="Jan" <? if($turow["DurationofStayMonth"]=="Jan") { echo "Selected";} ?>>Jan</option>
        <option value="Feb" <? if($turow["DurationofStayMonth"]=="Feb") { echo "Selected";} ?>>Feb</option>
        <option value="Mar" <? if($turow["DurationofStayMonth"]=="Mar") { echo "Selected";} ?>>Mar</option>
        <option value="Apr" <? if($turow["DurationofStayMonth"]=="Apr") { echo "Selected";} ?>>Apr</option>
        <option value="May" <? if($turow["DurationofStayMonth"]=="May") { echo "Selected";} ?>>May</option>
        <option value="Jun" <? if($turow["DurationofStayMonth"]=="Jun") { echo "Selected";} ?>>Jun</option>
        <option value="Jul" <? if($turow["DurationofStayMonth"]=="Jul") { echo "Selected";} ?>>Jul</option>
        <option value="Aug" <? if($turow["DurationofStayMonth"]=="Aug") { echo "Selected";} ?>>Aug</option>
        <option value="Sep" <? if($turow["DurationofStayMonth"]=="Sep") { echo "Selected";} ?>>Sep</option>
        <option value="Oct" <? if($turow["DurationofStayMonth"]=="Oct") { echo "Selected";} ?>>Oct</option>
        <option value="Nov" <? if($turow["DurationofStayMonth"]=="Nov") { echo "Selected";} ?>>Nov</option>
        <option value="Dec" <? if($turow["DurationofStayMonth"]=="Dec") { echo "Selected";} ?>>Dec</option>
        </select> <input type="text" name="stayyear" id="stayyear" maxlength="4" size="10" value="<? echo $turow["DurationofStayYear"]; ?>">           
        </td>
	</tr>
    <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">Current Employer</td>
		<td width="48%" align="left" class="frmbldtxt"> <select name="employmonth">
        <option value="Jan" <? if($turow["CurrentEmployerMonth"]=="Jan") { echo "Selected";} ?>>Jan</option>
        <option value="Feb" <? if($turow["CurrentEmployerMonth"]=="Feb") { echo "Selected";} ?>>Feb</option>
        <option value="Mar" <? if($turow["CurrentEmployerMonth"]=="Mar") { echo "Selected";} ?>>Mar</option>
        <option value="Apr" <? if($turow["CurrentEmployerMonth"]=="Apr") { echo "Selected";} ?>>Apr</option>
        <option value="May" <? if($turow["CurrentEmployerMonth"]=="May") { echo "Selected";} ?>>May</option>
        <option value="Jun" <? if($turow["CurrentEmployerMonth"]=="Jun") { echo "Selected";} ?>>Jun</option>
        <option value="Jul" <? if($turow["CurrentEmployerMonth"]=="Jul") { echo "Selected";} ?>>Jul</option>
        <option value="Aug" <? if($turow["CurrentEmployerMonth"]=="Aug") { echo "Selected";} ?>>Aug</option>
        <option value="Sep" <? if($turow["CurrentEmployerMonth"]=="Sep") { echo "Selected";} ?>>Sep</option>
        <option value="Oct" <? if($turow["CurrentEmployerMonth"]=="Oct") { echo "Selected";} ?>>Oct</option>
        <option value="Nov" <? if($turow["CurrentEmployerMonth"]=="Nov") { echo "Selected";} ?>>Nov</option>
        <option value="Dec" <? if($turow["CurrentEmployerMonth"]=="Dec") { echo "Selected";} ?>>Dec</option>
        </select> <input type="text" name="employyear" id="employyear" maxlength="4" size="10" value="<? echo $turow["CurrentEmployerYear"]; ?>">           
        </td>
	</tr>
    <tr>
    <td>Industry Sector</td>
    <td><select name="industry_sector" id="industry_sector">
 <option value="Automobile" <? if($turow["Industry_sector"]=="Automobile") { echo "Selected";} ?>>Automobile</option>
  <option value="Agriculture Based" <? if($turow["Industry_sector"]=="Agriculture Based") { echo "Selected";} ?>>Agriculture Based</option>
  <option value="Banking" <? if($turow["Industry_sector"]=="Banking") { echo "Selected";} ?>>Banking</option>
  <option value="BPO" <? if($turow["Industry_sector"]=="BPO") { echo "Selected";} ?>>BPO</option>
  <option value="Capital Goods" <? if($turow["Industry_sector"]=="Capital Goods") { echo "Selected";} ?>>Capital Goods</option>
  <option value="Telecom" <? if($turow["Industry_sector"]=="Telecom") { echo "Selected";} ?>>Telecom</option>
  <option value="IT" <? if($turow["Industry_sector"]=="IT") { echo "Selected";} ?>>IT</option>
  <option value="Retail" <? if($turow["Industry_sector"]=="Retail") { echo "Selected";} ?>>Retail</option>
  <option value="Real Estates" <? if($turow["Industry_sector"]=="Real Estates") { echo "Selected";} ?>>Real Estates</option>
  <option value="Consumer Durables" <? if($turow["Industry_sector"]=="Consumer Durables") { echo "Selected";} ?>>Consumer Durables</option>
  <option value="FMCG" <? if($turow["Industry_sector"]=="FMCG") { echo "Selected";} ?>>FMCG</option>
  <option value="NBFC" <? if($turow["Industry_sector"]=="NBFC") { echo "Selected";} ?>>NBFC</option>
  <option value="Marketing/Adv" <? if($turow["Industry_sector"]=="Marketing/Adv") { echo "Selected";} ?>>Marketing/Adv</option>
  <option value="Aviation" <? if($turow["Industry_sector"]=="Aviation") { echo "Selected";} ?>>Aviation</option>
  <option value="Brokerage" <? if($turow["Industry_sector"]=="Brokerage") { echo "Selected";} ?>>Brokerage</option>
  <option value="Insurance" <? if($turow["Industry_sector"]=="Insurance") { echo "Selected";} ?>>Insurance</option>
  <option value="Other" <? if($turow["Industry_sector"]=="Other") { echo "Selected";} ?>>Other</option>
        </select></td>
    </tr>
    
	 <tr>
	   <td colspan="2" align="center">&nbsp; </td>
	 </tr>
	 <tr>
	   <td colspan="2" align="center"> <input type="submit" class="bluebutton" value="Submit"></td>
	 </tr>
				</table>
					</form>
					</td></tr>
					</table>
</body>
</html>