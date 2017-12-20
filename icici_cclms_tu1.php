<?
require 'scripts/db_init.php';
require 'scripts/functions.php';

$reqdid = $_REQUEST["reqdid"];
$teleid = $_REQUEST["teleid"];

$tudetails="Select * from credit_card_cibil_check Where (RequestID=".$reqdid." and TelecallerID=".$teleid.")"; 
list($firstcount,$turow)=MainselectfuncNew($tudetails,$array = array());
$City = $turow[0]["City"];
?>
<html>
<body>
<table width="500" align="center" style="border:1px #000000 solid;">
<tr><td align="center">TU Process Fill Details</td></tr>
<tr><td>
<form name="icici_cc" action="icici_cclms_tu1_continue.php" method="POST" onSubmit="return ckhcreditcard(document.icici_cc); "><input type="hidden" name="RequestID" value="<? echo $reqdid;?>">	
<input type="hidden" name="telecallerid" id="telecallerid" value="<? echo $teleid;?>">
			<table width="90%">		       
         <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">Pancard</td>
		<td width="48%" align="left" class="frmbldtxt">
         <input type="text" name="Pancard" id="Pancard" class="input-bx12"  maxlength="10" tabindex="1" autocomplete="off" value="<? echo $turow["PanNo"]; ?>"  />
        </td>
	</tr>
        	<tr><td class="frmbldtxt" align="bottom">Existing Relationship With Bank ?</td>	   <td class="frmbldtxt"><select name="existing_rel" id="existing_rel">	   
			<option value="">Please Select</option>	   
			<option value="Salary" <? if($turow[0]["existing_relation"]=="Salary") { echo "Selected";} ?>>Salary Account</option>	   
			<option value="Saving" <? if($turow[0]["existing_relation"]=="Saving") { echo "Selected";} ?>>Saving Account</option>	   
			<option value="Current" <? if($turow[0]["existing_relation"]=="Current") { echo "Selected";} ?>>Current Account</option>	   </select></td>     </tr>
    <tr>
       <td class="frmbldtxt" align="bottom" colspan="2" id="myDiv"></td></tr>
       <tr>
		<td width="52%" height="28" align="left" >Address</td>
		<td width="48%" align="left" >
          <textarea rows="2" cols="20" name="Residence_Address_line1" id="Residence_Address_line1" ><? echo $turow["Address"]; ?></textarea>
        </td>
	</tr>
  
      <tr>
		<td width="52%" height="28" align="left" class="frmbldtxt">Pincode</td>
		<td width="48%" align="left" class="frmbldtxt">
          <input type="text" name="Pincode" id="Pincode" value="<? echo $turow[0]["Pincode"]; ?>">
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
	   $stateArr =array('Andaman & Nicobar Islands','Andhra Pradesh','Arunachal Pradesh','Assam','Bihar','Chandigarh','Chhattisgarh','Dadra & Nagar Haveli','Daman & Diu','Delhi','Goa','Gujarat','Haryana','Himachal Pradesh','Jammu & Kashmir','Jharkhand','Karnataka','Kerala','Lakshadweep','Madhya Pradesh','Maharashtra','Manipur','Meghalaya','Mizoram','Nagaland','Orissa','Pondicherry','Punjab','Rajasthan','Sikkim','Tamil Nadu','Tripura','Uttar Pradesh','Uttaranchal','West Bengal');
		   for($stat=0;$stat<count($stateArr);$stat++)
			 {
				 if($stateArr[$stat]==$turow["State"])
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
		<td width="52%" height="28" align="left"  colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><input type="checkbox" name="icicicheck1" id="icicicheck1" value="1" /> I agree that i have applied for selected ICICI Bank credit card and i understand that the following fees will be lived on my selected ICICI Bank credit card.
        </td>
	</tr>
      <tr>
		<td width="52%" height="28" align="left" colspan="2" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><input type="checkbox" name="icicicheck2" id="icicicheck2" value="1" /> I accept the term and condition of the credit card and accept to pay the related card fees on card issurance.
        </td>
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