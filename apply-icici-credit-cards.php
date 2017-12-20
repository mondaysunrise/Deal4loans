<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	//print_r($_POST);

	$ccuserid = $_POST['RequestID'];
	$cc_bankid = $_POST['cc_bankid'];
	$City = $_POST["cityval"];
	$crd_nme = $_POST["crd_nme"];
	//$ccuserid =	691931;
	//$cc_bankid = 25;
	//$crd_nme="ICICI Bank HPCL coral Credit Card";

if((strlen(trim($crd_nme))>0) && $cc_bankid >1)
{
	$slct="select applied_card_name,Descr from Req_Credit_Card Where (RequestID='".$ccuserid."')";
	//$row=mysql_fetch_array($slct);
	list($Getnum,$row)=Mainselectfunc($slct,$array = array());
	
	if(strlen($row['applied_card_name'])>0)
	{
	$strcrd_nme=$row['applied_card_name'].",".$crd_nme;
	}
	else
	{
		$strcrd_nme=$crd_nme;
	}

if(strlen($hdfcrow['Descr'])>0)
	{	$hdfrd_nme=$hdfcrow['Descr'].",".$crd_nme;}
	else
	{	$hdfrd_nme=$crd_nme;}


$slctccelb="select cc_bank_features,card_image_view,cc_bank_name from credit_card_banks_eligibility Where (cc_bankid='".$cc_bankid."')";
	list($Getnum,$rownew)=Mainselectfunc($slctccelb,$array = array());

//$getcc_option=ExecQuery("Update Req_Credit_Card Set applied_card_name ='".$strcrd_nme."',Descr='".$hdfrd_nme."' Where (RequestID='".$ccuserid."')");

$DataArray = array("applied_card_name" =>$strcrd_nme,"Descr"=>$hdfrd_nme);
$wherecondition ="(RequestID='".$ccuserid."')";
Mainupdatefunc ('Req_Credit_Card', $DataArray, $wherecondition);

	}


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	foreach($_POST as $a=>$b)
			$$a=$b;
	
	$existing_rel = $_POST["existing_rel"];
	$Residence_Address_line1 = $_POST["Residence_Address_line1"];
	$Residence_Address_line2 = $_POST["Residence_Address_line2"];
	$Address_City = $_POST["Address_City"];
	$Pincode = $_POST["Pincode"];
	$existing_relationship = $_POST['existing_relationship'];
	$cc_bankid_nw = $_POST["cc_bankid_nw"];
	
	$Residence_Address = $Residence_Address_line1." | ".$Residence_Address_line2." ".$Address_City;
	

	if($cc_bankid_nw>0)
	{
		header("Location: apply-icici-credit-card-continue.php?req=".$ccuserid."&ccid=".$cc_bankid."&exstrl=".$existing_rel);
		exit();
	}
	//echo $ccupdate."<br>";
}
//$Descr = "ICICI Bank Platinum Chip Credit Card";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apply for Credit Card | Credit Card Application | Credit Cards Comparison Chart</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/ICICI-Credit-Card-lp-styles-new.css" type="text/css" rel="stylesheet" />
<script >
function addElement()
{
	var ni = document.getElementById('myDiv');
	ni.innerHTML = '<table cellspacing="0" border="0" align="center" width="100%"><tr>      <td colspan="3" height="10"></td>      </tr><tr><td class="form_text" width="50%" align="center">Existing Relationship With Bank ?</td>	   <td width="50%"><select name="existing_rel" id="existing_rel" class="credit-card_select">	   <option value="">Please Select</option>	   <option value="Salary">Salary Account</option>	   <option value="Saving">Saving Account</option>	   <option value="Current">Current Account</option><option value="Loan">Loan Running</option>	   </select></td>     </tr><tr>      <td colspan="3" height="10"></td>      </tr></table>';
		return true;
}

function removeElement()
{
	var ni = document.getElementById('myDiv');
	ni.innerHTML = '';
	return true;
}

function ckhcreditcard(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	 if (Form.Pancard.value == "") {
    	alert("Fill Valid Pan No.");
		Form.Pancard.focus();
		return false;
	}
   if (Form.Pancard.value != "") {
            ObjVal = Form.Pancard.value;
            var panPat = /^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/;
            if (ObjVal.search(panPat) == -1) {
			   	alert("Fill Valid Pan No.");
			    Form.Pancard.focus();
                return false;
            }
        }

	if(Form.Residence_Address_line1.value=="")
	{
		alert("Fill Residence Address");
		Form.Residence_Address_line1.focus();
		return false;
	}
	if(Form.Residence_Address_line2.value=="")
	{
		alert("Fill Residence Address");
		Form.Residence_Address_line2.focus();
		return false;
	}

	if(Form.Pincode.value=="")
	{
		alert("Fill Residence Pincode");
		Form.Pincode.focus();
		return false;
	}
	
	if (Form.Address_City.selectedIndex==0)
	{
		alert("Enter City to Continue!");
		Form.Address_City.focus();
		return false;
	}
	if(Form.Address_State.value=="")
	{
		alert("Fill Residence State");
		Form.Address_State.focus();
		return false;
	}
	if (Form.Gender.selectedIndex==0)
	{
		alert("Enter Gender to Continue!");
		Form.Gender.focus();
		return false;
	}	
}
</script>
</head>
<body>
<div id="header">You are almost done with your ICICI Bank Credit Card application.<br />
Please fill in few more details for "<em>Instant Eligibility</em>" check from ICICI Bank.</div>
<div class="stip">
<div class="stip_inn">
You are applying for a
<div class="text_head_icici"><? echo $rownew["cc_bank_name"];?></div>
</div>
</div>
<div class="wrapper-new">
<div class="wrapper">
<div class="left_box">
<form name="icici_cc" action="icici_card_chktransunion.php" method="POST" onSubmit="return ckhcreditcard(document.icici_cc); ">
<input type="hidden" name="RequestID" value="<? echo $ccuserid;?>">
				<input type="hidden" name="cc_bankid" value="<? echo $cc_bankid;?>">
				<input type="hidden" name="cc_bankid_nw" value="<? echo $cc_bankid;?>">
  <table width="99%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="3" align="left" class="applicant_details" >APPLICANT DETAILS</td>
      </tr>
    <tr>
      <td width="48%" align="right" class="form_text" >Pan Card</td>
      <td width="2%" align="right" >&nbsp;</td>
      <td width="50%">
<input type="text" name="Pancard" id="Pancard" class="credit-card_input"  maxlength="10" tabindex="1" autocomplete="off"   />
      </td>
    </tr>
    <tr>
      <td colspan="3" height="10"></td>
      </tr>
    <tr>
      <td align="right" class="form_text" >Existing Relationship with ICICI Bank</td>
      <td align="right" class="form_text" >&nbsp;</td>
      <td class="form_text"><input type="radio" name="existing_relationship" id="existing_relationship" value="1"   onClick="addElement();" />Yes  <input type="radio" name="existing_relationship" id="existing_relationship" value="0"   onClick="removeElement();" /> No</td>
    </tr>
    <tr>
      <td colspan="3" height="10" id="myDiv" width="100%"></td>
      </tr>
    <tr>
      <td align="right" class="form_text" >Address</td>
      <td align="right" class="form_text" >&nbsp;</td>
      <td>
        <textarea rows="1" cols="20" name="Residence_Address_line1" id="Residence_Address_line1"  class="credit-card_textarea" maxlength="40"></textarea>
        </td>
    </tr>
    <tr>
      <td colspan="3" height="10"></td>
    </tr>
    <tr>
      <td align="right" class="form_text" >Pin Code</td>
      <td align="right" class="form_text" >&nbsp;</td>
      <td> <input type="text" name="Pincode" id="Pincode" class="credit-card_input"></td>
    </tr>
    <tr>
      <td colspan="3" height="10"></td>
      </tr>
    <tr>
      <td align="right" class="form_text" >City</td>
      <td align="right" class="form_text" >&nbsp;</td>
      <td> <select name="Address_City" id="Address_City"  class="credit-card_select">
                            <?=plgetCityList($City)?>                 
                        </select></td>
    </tr>
    <tr>
      <td colspan="3" height="10"></td>
      </tr>
    <tr>
      <td align="right" class="form_text" >State</td>
      <td align="right" class="form_text" >&nbsp;</td>
      <td><select name="Address_State" id="Address_State" class="credit-card_select">
        <option value="">Select</option>
        <?php 
		   
		   $stateArr = array('Rajasthan', 'Madhya Pradesh', 'Maharashtra', 'Andhra Pradesh', 'Uttar Pradesh', 'Jammu and Kashmir', 'Gujarat', 'Karnataka', 'Odisha', 'Chhattisgarh', 'Tamil Nadu', 'Bihar', 'West Bengal', 'Arunachal Pradesh', 'Jharkhand', 'Assam', 'Himachal Pradesh', 'Uttarakhand', 'Punjab', 'Haryana', 'Kerala', 'Meghalaya', 'Manipur', 'Mizoram', 'Nagaland', 'Tripura', 'Andaman & Nicobar Islands', 'Sikkim', 'Goa', 'Delhi', 'Puducherry', 'Dadra and Nagar Haveli', 'Chandigarh', 'Daman and Diu', 'Lakshadweep');
		   for($stat=0;$stat<count($stateArr);$stat++)
			 {
			 	echo "<option value='".$stateArr[$stat]."'>".$stateArr[$stat]."</option>";
			 }
		   ?>
      </select></td>
    </tr>
    <tr>
      <td colspan="3" height="10"></td>
      </tr>
    <tr>
      <td align="right" class="form_text" >Gender</td>
      <td align="right" class="form_text" >&nbsp;</td>
      <td><select name="Gender" id="Gender" class="credit-card_select">
        <option value="">Select</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="3" height="10" ></td>
      </tr>
    <tr>
      <td colspan="3" class="form_text" style="font-size:10px;" ><input type="checkbox" name="icicicheck1" id="icicicheck1" value="1" /> I agree that i have applied for selected ICICI Bank credit card and i understand that the following fees will be levied on my selected ICICI Bank credit card.</td>
      </tr>
    <tr>
      <td colspan="3" height="5"></td>
      </tr>
    <tr>
<td colspan="3" class="form_text" style="font-size:10px;"><input type="checkbox" name="icicicheck2" id="icicicheck2" value="1" /> I accept the term and condition of the credit card and accept to pay the related card fees on card issuance.</td>
 </tr>
<tr>
<td colspan="3" align="center" >&nbsp;</td>
</tr>
<tr>
<td align="center" ></td>
<td align="center" >&nbsp;</td>
<td align="left" >
<input type="image" name="submit" src="images/apply_credit-card_lp.png" style="width:119px; height:37px; border:none;" />
</td>
</tr>
<tr>
<td colspan="2">&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
</form>
</div>
<div class="right">
<div class="card">
<div class="icici-bank_credit_card_icon">
<img src="/<? echo $rownew["card_image_view"];?>" width="204" height="129"></div></div>
<? echo $rownew["cc_bank_features"];?></div><div class="lining-icici_divider"><img src="images/lining-img141.png" width="1" alt="lining" height="100%"></div>
<div class="clear_fix"></div>
</div></div>
</body>
</html>