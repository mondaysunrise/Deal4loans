<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';

	 $cl_requestid = $_REQUEST['cl_requestid'];
$cl_bank_name = $_REQUEST['cl_bank_name'];


if (strlen($cl_bank_name)>1 && $cl_requestid>1)
{
	$selqry="select CL_Bank from Req_Loan_Car Where RequestID=".$cl_requestid;
$restselqry= ExecQuery($selqry);
$plrow=mysql_fetch_array($restselqry);
$cl_banks=$plrow['CL_Bank'];

if(strlen($cl_banks)>1)
	{
		$newpl_banks= $cl_banks.",".$cl_bank_name;
$plupdate= "Update Req_Loan_Car  set CL_Bank='".$newpl_banks."' Where (Req_Loan_Car.RequestID=".$cl_requestid.")";
	
	}
	else
	{
		$plupdate= "Update Req_Loan_Car  set CL_Bank='".$cl_bank_name."' Where (Req_Loan_Car.RequestID=".$cl_requestid.")";
	
	}
	ExecQuery($plupdate);
	//echo $plupdate."<br>";

}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["appointment"] =="Fix an Appointment")
{
	
	$existing_rel = $_REQUEST['existing_rel'];
	$residence_address = $_REQUEST['residence_address'];
	$address .= $residence_address;
	$office_address = $_REQUEST['office_address'];
	if(strlen($office_address)>0)
	{
		$address .= ", ".$office_address;
	}
	$pincode = $_REQUEST['pincode'];
	if(strlen($pincode)>0)
	{
		$address .= ", ".$pincode;
	}
	$RequestIDVal= $_REQUEST['RequestID'];
	$appdate= $_REQUEST['appdate'];
	$changeapp_time=$_REQUEST['changeapp_time'];
	$product=3;
	
	$checkSql = "select * from hdfc_cl_appointments where RequestID='".$RequestIDVal."' and Reply_Type=3";
	$checkQuery = ExecQuery($checkSql);
	$checkNum = mysql_num_rows($checkQuery);
	
	if($checkNum>0)
	{
		$sql2 = "update hdfc_cl_appointments set address_apt = '".$address."', appdate = '".$appdate."', changeapp_time='".$changeapp_time."' where RequestID='".$RequestIDVal."' and  Reply_Type=3";
		$query = ExecQuery($sql2);
		$message="done";
	}
	else
	{
		$sql2 = "INSERT INTO hdfc_cl_appointments ( address_apt , RequestID , appdate , changeapp_time , Reply_Type, Dated )
VALUES ( '".$address."', '".$RequestIDVal."', '".$appdate."', '".$changeapp_time."', '".$product."', Now() )";
		$query = ExecQuery($sql2);
		$message="done";


		
	}

if($existing_rel>0)
		{
			$upcldate="Update Req_Loan_Car set Existing_Relation=".$existing_rel." Where (RequestID=".$RequestIDVal.")";

			$queryupcldate = ExecQuery($upcldate);
		}
	
}
else if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["cc_bankname"] =="Magma Fincorp")
{

	$Pancard = $_POST['Pancard'];
	$residence_address = $_POST['residence_address'];
	$office_address = $_POST['office_address'];
	$RequestID = $_POST['RequestID'];
	$cc_bankid = $_POST['cc_bankid'];
	$cc_bankname = $_POST['cc_bankname'];
	$cl_bank_name = $_POST['cc_bankname'];
	$cl_requestid = $_POST['RequestID']; 
	
	$plupdate= "Update Req_Loan_Car  set Pancard='".$Pancard."', Residence_Address='".$residence_address."', Office_address='".$office_address."'  Where (Req_Loan_Car.RequestID=".$cl_requestid.")";
	ExecQuery($plupdate);	
	$message="done";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'> 
<title>Apply for Car Loan  | Car Loan Application | Car Loans Comparison Chart</title>
<meta name="description" content="Apply for Credit Cards online: Get facility to apply directly for credit cards in all banks. Online Credit Card application form to get information about credit card schemes from all credit cards provider banks located in major cities of India like Mumbai, Delhi, Gurgaon, Bangalore, Ahmedabad, Chennai, Hyderabad, Navi Mumbai, Kochi etc.">
<meta name="keywords" content="Credit Card Application, Apply Credit Cards, Compare Credit Cards in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>

 <link href="source.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript" src="http://www.bimadeals.com/scripts/datetime.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<style type="text/css">
 .btnclr1 {
    background-color: #1273AB;
    border: medium none;
    color: #FFFFFF;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 14px;
    font-weight: bold;
    height: 40px;
    width: 180px;
}
</style>
<script language="javascript">
function submitform(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	

	var a=Form.Pancard.value;
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(regex1.test(a)== false)
	{
	  alert('Please enter valid pan number');
	  Form.Pancard.focus();
	  return false;
	}
	if (Form.Pancard.value.charAt(3)!="P" && Form.Pancard.value.charAt(3)!="p")
	{
			alert("Please enter valid pan number");
			Form.Pancard.focus();
			return false;
	}
	
	if(Form.residence_address.value=="")
	{
		alert("Kindly fill in your Residence Address!");
		Form.residence_address.focus();
		return false;
	}

	if(Form.office_address.value=="")
	{
		alert("Kindly fill in your Office Address!");
		Form.office_address.focus();
		return false;
	}
	return true;	
}

</script>
</head>
<body>
<!--top-->

<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->

<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <span class="text12" style="color:#4c4c4c;">> Apply Car Loan</span></div>
<div class="intrl_txt">
<div style="clear:both; height:15px;"></div>
   <h1 style="color:#ae4212 !important; margin:0px; padding:0px; font-size:13px !important; line-height:22px; padding-left:20px;" align="center"> Thanks for applying Car Loan for <? echo $cl_bank_name; ?> through Deal4loans.com </h1>
<?php  // echo $plupdate; ?>
   <? if($cl_bank_name=="HDFC" && $message=="") 
   { ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" class="crdtext">
	
	<table width="90%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="35" valign="middle"   class="crdhorizonbg"></td>
        </tr>
        <tr>
          <td class="yelobordr"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
              
				
             
                <td width="430" valign="top" class="crdtext"><b>Features and Benefits of HDFC Car Loan:</b>
				
<ul>

    <li>HDFC Car Loan Interest Rate 11.50% to 16.50%</li>
<li>    Processing Fees Up to Rs. 5,000</li>
<li>    HDFC Car Loan Tenure 1 year to 7 years</li>
<li>    Pre-closure Charges 6 % of foreclosed amount in year one. 5% in year two. 3% afterwards</li>
<li>    Foreclosure not allowed for first 6 months</li>
<li>    HDFC Car Loan Amount Varies based on car model. Up to 100% financing for pre-approved customers.</li>
<li>    Guarantor Requirement No guarantor required</li>

                      </ul>
		
				    </td>
<td width="20" align="center"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>
				
                <td width="481" align="center" valign="middle"  class="crdtext"><form name="hdfc_cc" action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST" onSubmit="return ckhcreditcard(document.hdfc_cc); ">
				<input type="hidden" name="cc_bankid" value="<? echo $cc_bankid;?>">
  		  	<table width="89%">
						
		 	<tr>
       <td  class="frmtxt"><b>Existing Relationship With Bank ?</b></td>
	   <td class="frmbldtxt"><select name="existing_rel" id="existing_rel">
	   <option value="">Please Select</option>
	   <option value="1">Account</option>
	   <option value="2">Loan Running</option>
	   <option value="3">Credit Card</option>
	   <option value="4">Other</option>
	   </select></td>
     </tr>
	 <tr>

		<td class="frmtxt"><b>Appointment Date<span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></b></td>

		<td>
		<input type="hidden" name="RequestID" id="RequestID" value="<?php echo $cl_requestid; ?>" />
		<input type="hidden" name="cl_bank_name" id="cl_bank_name" value="<?php echo $cl_bank_name; ?>" />
        <?php
		$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")+1, date("Y"));

		$appointment_date = date ("Y-m-d" , $tomorrow);
        ?>
	    <input type='Text'  name='appdate' id='appdate' maxlength='25' size='15' value="<? echo $appointment_date;?>">

		  <a href="javascript:NewCal('appdate','yyyymmdd',false,'');" ><img src='images/cal.gif' width='16' height='16' border='0' alt='Pick a date'></a></td>
		</tr>

		<tr>

		<td class="frmtxt"><b>Appointment Time<span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></b></td>

		<td class="frmtxt">

		  <select name="changeapp_time" id="changeapp_time">

		    <option value="please select">Time slab</option>

		    <option <? if($appointment_time=="08:00:00") echo "selected"; ?> value="08:00:00">8(am)-9(am)</option>

		    <option <? if($appointment_time=="09:00:00") echo "selected"; ?> value="09:00:00">9(am)-10(am)</option>

		    <option <? if($appointment_time=="10:00:00") echo "selected"; ?> value="10:00:00">10(am)-11(am)</option>

		    <option <? if($appointment_time=="11:00:00") echo "selected"; ?> value="11:00:00">11(am)-12(am)</option>

		    <option value="12:00:00" <? if($appointment_time=="12:00:00") echo "selected"; ?>>12(am)-1(pm)</option>

		    <option <? if($appointment_time=="13:00:00") echo "selected"; ?> value="13:00:00">1(pm)-2(pm)</option>

		    <option value="14:00:00" <? if($appointment_time=="14:00:00") echo "selected"; ?>>2(pm)-3(pm)</option>

		    <option <? if($appointment_time=="15:00:00") echo "selected"; ?> value="15:00:00">3(pm)-4(pm)</option>

		    <option value="16:00:00" <? if($appointment_time=="16:00:00") echo "selected"; ?>>4(pm)-5(pm)</option>

		    <option <? if($appointment_time=="17:00:00") echo "selected"; ?> value="17:00:0">5(pm)-6(pm)</option>

		    <option <? if($appointment_time=="18:00:00") echo "selected"; ?> value="18:00:00">6(pm)-7(pm)</option>

		    <option <? if($appointment_time=="19:00:00") echo "selected"; ?> value="19:00:00">7(pm)-8(pm)</option>
	    </select>		 </td>
		</tr>
        
		<tr>

		<td class="frmtxt"><b>Appointment Address  Line 1</b><span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

		<td>
		<input type="text" name="residence_address" id="residence_address" style="width:200px;  height:21px;" ></td>
		</tr>
        
		<tr>

		<td class="frmtxt"><b>Appointment Address  Line 2</b><span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

		<td>
        <input type="text" name="office_address" id="office_address" style="width:200px;  height:21px;" ></td>
		</tr>
		<tr>

		<td class="frmtxt"><b>Pincode</b><span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

		<td>
       <input  style="width:150px;  height:21px;" maxlength="6"  name="Pincode" id="Pincode" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td>
		</tr>


        <tr>

		<td colspan="2" align="center" class="frmtxt" > <div align="center"><input name="appointment" type="submit" class="btnclr1" value="Fix an Appointment"  /></div></td>
		</tr>

					</table>
					</form>
	</td>

              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="20" valign="top"><img src="new-images/crds-h-botbg.gif" width="960" height="20" /></td>
        </tr>
      </table>
	     
	  </td>
  </tr>
</table>


<? }
else if($cl_bank_name=="Magma Fincorp"  && $message=="")
{

?>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" class="crdtext">
	
	<table width="90%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="35" valign="middle"   class="crdhorizonbg"></td>
        </tr>
        <tr>
          <td class="yelobordr"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                  <td width="430" valign="top" class="crdtext"><b>Features and Benefits of Magma Fincorp Loan :</b>

&nbsp;		
				    </td>
                    <td width="20" align="center"><img src="new-images/crd-shado.gif" width="10" height="80" /></td>
				
                <td width="481" align="center" valign="middle"  class="crdtext"><form name="magma_cc" action="<? echo $_SERVER['PHP_SELF'] ?>" method="POST"onSubmit="return submitform(document.magma_cc);"><input type="hidden" name="RequestID" value="<? echo $ccuserid;?>">
				<input type="hidden" name="cc_bankid" value="<? echo $cc_bankid;?>">
                <input type="hidden" name="cc_bankname" value="Magma Fincorp">
                <input type="hidden" name="RequestID" id="RequestID" value="<?php echo $cl_requestid; ?>" />
  		  	<table width="89%">
		<tr>
		<td class="frmtxt"><b>Pancard</b><span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
		<td>
       <input  style="width:150px;  height:21px;" maxlength="10"  name="Pancard" id="Pancard" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" /></td>
		</tr>
        	
		<tr>

		<td class="frmtxt"><b>Residence Address</b><span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

		<td>
		<input type="text" name="residence_address" id="residence_address" style="width:200px;  height:21px;" ></td>
		</tr>
        
		<tr>

		<td class="frmtxt"><b>Office Address</b><span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>

		<td>
        <input type="text" name="office_address" id="office_address" style="width:200px;  height:21px;" ></td>
		</tr>
	
        <tr>

		<td colspan="2" align="center" class="frmtxt" > <div align="center"><input name="appointment" type="submit" class="btnclr1" value="Submit"  /></div></td>
		</tr>

					</table>
					</form>
	</td>

              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="20" valign="top"><img src="new-images/crds-h-botbg.gif" width="960" height="20" /></td>
        </tr>
      </table>
	     
	  </td>
  </tr>
</table>
<?php

}

	  ?>
<div style="clear:both; height:85px;"></div></div>
<?php include "footer1.php"; ?>

</body>
</html>
