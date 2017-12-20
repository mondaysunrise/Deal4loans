<?php
ini_set('max_execution_time', 300);
//require 'scripts/session_check_onlinelms.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();

$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}

if ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="122.160.74.241" || $IP=="182.71.109.218")
{

$maxage = date('Y') - 62;
$minage = date('Y') - 18;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $a => $b)
        $$a = $b;
    /* FIX STRINGS */
    $UserID = $_SESSION['UserID'];
    $hlname = $_POST["hlname"];
    $hlrequestid = $_POST["hlrequestid"];
    $producttype = 2;
    $fm_subcategory = $_POST['fm_subcategory'];
    $reg_year = $_POST['reg_year'];
    $reg_month = $_POST['reg_month'];
    $renewal_date = $_POST['renewal_date'];
    $bidderid_details = $_SESSION['bidderid_details'];
    $hlemail = $_POST["hlemail"];
    $hladd_comment = $_POST["hladd_comment"];
    $hlmobile = $_POST["hlmobile"];
    $hlstd_code = $_POST["hlstd_code"];
    $hllandline = $_POST["hllandline"];
    $hlother_city = $_POST["hlother_city"];
    $hldate = $_POST["Dated"];
    $day = $_POST["day"];
    $month = $_POST["month"];
    $year = $_POST["year"];
    $hldob = $year . "-" . $month . "-" . $day;
    $which_khatha = $_POST["which_khatha"];
    $hlemployment_status = $_POST["hlemployment_status"];
    $hllandline_o = $_POST["hllandline_o"];
    $hlstd_code_o = $_POST["hlstd_code_o"];
    $hlnet_salary = $_POST["hlnet_salary"];
    $hlresiaddress = $_POST["hlresiaddress"];
    $hlpincode = $_POST["hlpincode"];
    $hlloanamt = $_POST["hlloanamt"];
    $hlcity = $_POST["hlcity"];
    $hlloantime = $_POST["hlloantime"];
    $hlbudget = $_POST["hlbudget"];
    $hlproperty_loc = $_POST["hlproperty_loc"];
    $hlproperty_identified = $_POST["hlproperty_identified"];
    $Final_Bidder = $_REQUEST['Final_Bidder'];
    $Bidder_Id = $_REQUEST['BidderId'];
    $hlcompany_name = $_REQUEST['hlcompany_name'];
    $selectbidderID = $_REQUEST['selectbidderID'];
    $selectbidderID = explode(',', $selectbidderID);
    //$hlcompany_name = $_REQUEST['hlcompany_name'];
    $realbankID = $_REQUEST['realbankID'];
    $realbankID = explode(',', $realbankID);
    //print_r($realbankID);
    $Accidental_Insurance = $_REQUEST['Accidental_Insurance'];
    $hlProperty_Value = $_REQUEST['hlProperty_Value'];
    $hlTotal_Obligation = $_REQUEST['hlTotal_Obligation'];
    $hlCo_Applicant_Name = $_REQUEST['hlCo_Applicant_Name'];
    $hlCo_Applicant_DOB = $_REQUEST['hlCo_Applicant_DOB'];
    $hlCo_Applicant_Income = $_REQUEST['hlCo_Applicant_Income'];
    $hlCo_Applicant_Obligation = $_REQUEST['hlCo_Applicant_Obligation'];
    $want_Lap = $_REQUEST['want_Lap'];
	$source = $_REQUEST['source'];
    $Existing_Bank = $_REQUEST['hl_Existing_Bank'];
    $Existing_ROI = $_REQUEST['hl_Existing_ROI'];
    $Existing_Loan = $_REQUEST['hl_Existing_Loan'];
      

///////Get common bidder NAme//////////////////////////
    if ($hlemployment_status == "Salaried") {
        $hlemp_stat = 1;
    } elseif ($hlemployment_status == "Self Employed") {
        $hlemp_stat = 0;
    } else {
        $hlemp_stat = 0;
    }

    if (strlen($hlname) > 0 && strlen($hlmobile) > 0) {
        $updatelead = "INSERT INTO Req_Loan_Home set CC_Bank='$which_khatha',Existing_Bank='$Existing_Bank',Existing_Loan='$Existing_Loan',Existing_ROI='$Existing_ROI',Property_Value='$hlProperty_Value',Co_Applicant_Name='$hlCo_Applicant_Name',Co_Applicant_DOB='$hlCo_Applicant_DOB',Co_Applicant_Income='$hlCo_Applicant_Income' ,Co_Applicant_Obligation='$hlCo_Applicant_Obligation',Total_Obligation='$hlTotal_Obligation',Tataaig_Home='$tataaig_home', Tataaig_Health='$tataaig_health',Tataaig_Auto='$tataaig_auto',Company_Name='$hlcompany_name', Name='$hlname',Email='$hlemail', Mobile_Number='$hlmobile',Employment_Status='$hlemployment_status', Std_Code='$hlstd_code',Landline='$hllandline',Std_Code_O='$hlstd_code_o',Landline_O='$hllandline_o',City='$hlcity',City_Other='$hlcity_other',Net_Salary='$hlnet_salary',Residence_Address='$hlresiaddress',Pincode='$hlpincode',Property_Identified='$hlproperty_identified',Loan_Time='$hlloantime',Loan_Amount='$hlloanamt',Budget='$hlbudget',Property_Loc='$hlproperty_loc',DOB='$hldob', Add_Comment='$hladd_comment', Dated=Now(),Updated_Date=Now(), source='$source'";
    
    //echo "query".$updatelead;
    $updateleadresult=ExecQuery($updatelead);
	}
}
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/menu.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="includes/style.css" rel="stylesheet" type="text/css">
        <script language="javascript" type="text/javascript" src="scripts/datetime.js"></script>
        <script language="javascript" type="text/javascript" src="scripts/common.js"></script>
        <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
        <script type="text/JavaScript">
            function killCopy(e){ return false; }
            function reEnable(){return true; }
            document.onselectstart=new Function ("return false");
            if (window.sidebar){ document.onmousedown=killCopydocument.onclick=reEnable }
            function clickIE4(){if (event.button==2){ return false; } }
            function clickNS4(e){ if (document.layers||document.getElementById&&!document.all){ if (e.which==2||e.which==3){ return false;} } }
            if (document.layers){ document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4; } else if (document.all&&!document.getElementById){ document.onmousedown=clickIE4; }
            document.oncontextmenu=new Function("return false")
        </script>
                <script>
            function chkhomeloan(Form)
            {
                var space = /^[\ ]*$/;
                var num = /^[0-9]*$/;

                if (Form.hlname.value == "")
                {
                    alert("Please enter name");
                    Form.hlname.focus();
                    return false;
                }
                var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                if (!hlemail.value.match(mailformat))
                {
                alert("Please enter valid email address");
                Form.hlemail.focus();
                    return false;
                } 
              //alert("hello");
                if ((Form.day.value != "") && (Form.month.value != "") && (Form.year.value != ""))
                {
                    if ((space.test(Form.day.value)) || (Form.day.value == "dd"))
                    {
                        alert("Kindly enter your Date of Birth");
                        Form.day.select();
                        return false;
                    } else if (!num.test(Form.day.value))
                    {
                        alert("Kindly enter your Date of Birth(numbers Only)");
                        Form.day.select();
                        return false;
                    } else if ((Form.day.value < 1) || (Form.day.value > 31))
                    {
                        alert("Kindly Enter your valid Date of Birth(Range 1-31)");
                        Form.day.select();
                        return false;
                    } else if ((space.test(Form.month.value)) || (Form.month.value == "mm"))
                    {
                        alert("Kindly enter your Month of Birth");
                        Form.month.select();
                        return false;
                    } else if (!num.test(Form.month.value))
                    {
                        alert("Kindly enter your Month of Birth(numbers Only)");
                        Form.month.select();
                        return false;
                    } else if ((Form.month.value < 1) || (Form.month.value > 12))
                    {
                        alert("Kindly Enter your valid Month of Birth(Range 1-12)");
                        Form.month.select();
                        return false;
                    } else if ((Form.month.value == 2) && (Form.day.value > 29))
                    {
                        alert("Month February cannot have more than 29 days");
                        Form.day.select();
                        return false;
                    } else if ((space.test(Form.year.value)) || (Form.year.value == "yyyy"))
                    {
                        alert("Kindly enter your Year of Birth");
                        Form.year.select();
                        return false;
                    } else if (!num.test(Form.year.value))
                    {
                        alert("Kindly enter your Year of Birth(numbers Only) !");
                        Form.year.select();
                        return false;
                    } else if ((Form.day.value > 28) && (parseInt(Form.month.value) == 2) && ((Form.year.value % 4) != 0))
                    {
                        alert("February cannot have more than 28 days.");
                        Form.day.select();
                        return false;
                    } else if ((parseInt(Form.day.value) == 31) && ((parseInt(Form.month.value) == 4) || (parseInt(Form.month.value) == 6) || (parseInt(Form.month.value) == 9) || (parseInt(Form.month.value) == 11) || (parseInt(Form.month.value) == 2)))
                    {
                        alert("this month Cannot have 31st Day");
                        Form.day.select();
                        return false;
                    } else if (Form.year.value.length != 4)
                    {
                        alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
                        Form.year.select();
                        return false;
                    }
                }
                if (Form.hlcity.value == "Please Select")
                {
                    alert("Please select city");
                    Form.hlcity.focus();
                    return false;
                }
                if (Form.hlpincode.value == "")
                {
                    alert("Please enter pincode");
                    Form.hlpincode.focus();
                    return false;
                }
                 if (Form.hlresiaddress.value == "")
                {
                    alert("Please enter Residence Address");
                    Form.hlresiaddress.focus();
                    return false;
                }
                if (Form.hlcity.value == "Others")
                {
                    if (Form.hlother_city.value == "")
                    {  
                        alert("Please enter Other City Name");
                        Form.hlother_city.focus();
                        return false;
                    }
                }
                if (Form.hlnet_salary.value == "")
                {
                    alert("Please enter Annual Income");
                    Form.hlnet_salary.focus();
                    return false;
                }
                if (Form.hlcompany_name.value == "")
                {
                    alert("Please enter Company Name");
                    Form.hlcompany_name.focus();
                    return false;
                }
                if (Form.hlloanamt.value == "")
                {
                    alert("Please enter Loan Amount");
                    Form.hlloanamt.focus();
                    return false;
                }
                if (Form.hlloantime.value == "-1")
                {
                    alert("Please select loan time");
                    Form.hlloantime.focus();
                    return false;
                }              
            }

            function isCharsetKey(evt)
            {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if ((charCode > 33) && (charCode < 58))
                    return false;
                return true;
            }

            function numOnly(evt)
            {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 46 || charCode > 57))
                    return false;
                return true;

            }
        </script>
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
            }
        </style>
    </head>
    <body >
        <p align="center"><b>Home loan Lead Details </b></p>
              <form name="loan_form" method="post" action="<? echo $_SERVER['PHP_SELF'] ?>" onSubmit="return chkhomeloan(document.loan_form);">
                  <input type="hidden" name="source" value="HL_LMS_Internal_Refer">
            <table style='border:1px dotted #9C9A9C;'width="700" height="80%" align="center" >
               <tr>
                    <td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Balance Transfer</b></td></tr>
                <tr>
                    <td width="25%"><b>Existing Bank</b></td>
                    <td width="25%"><input type="text" name="hl_Existing_Bank" id="hl_Existing_Bank" ></td>
                    <td ><b>Existing Loan </b></td>
                    <td ><input type="text" name="hl_Existing_Loan" id="hl_Existing_Loan"></td>
                </tr>
                <tr>
                    <td width="25%"><b>Existing ROI</b></td>
                    <td width="25%"><input type="text" name="hl_Existing_ROI" id="hl_Existing_ROI"></td>
                    <td >&nbsp;</td>
                    <td >&nbsp;</td>
                </tr>
                <tr>
                    <td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Personal Details</b></td></tr><tr>	<td ><b>Name</b>
                    </td>
                    <td ><input type="text" name="hlname" id="hlname" onKeyPress="return isCharsetKey(event);"> </td>
                    <td ><b>Email id</b></td>
                    <td ><input type="text" name="hlemail" id="hlemail"></td>
                </tr>
                <tr>
                    <td width="25%"><b>Mobile</b></td>
                    <td width="25%">+91<input type="text" name="hlmobile" size="15" maxlength="10"></td>
                    <td ><b>DOB </b></td>
                    <td ><input type="text" name="day" id="day" size="2" maxlength="2">-<input type="text" name="month" id="month" size="2" maxlength="2">-<input type="text" name="year" id="year" size="4" maxlength="4">(dd-mm-yyyy)</td>
                </tr>
                <tr>
                    <td><b>Residence No.</b></td>
                    <td><input type="text" name="hlstd_code" size="2">-<input type="text" name="hllandline" size="10" ></td>

                    <td ><b>Office No.</b></td>
                    <td ><input type="text" name="hlstd_code_o"  size="2">-<input type="text" name="hllandline_o" size="10" ></td>
                </tr>
                <tr>
                    <td ><b>City</b></td>
                    <td><select size="1" name="hlcity" > <?= getCityList($City) ?></select></td>
                    <td ><b>Pincode</b></td>
                    <td ><input type="text" name="hlpincode" size="10" id="hlpincode" onKeyPress="return numOnly(event);"></td>
                </tr>
                <tr>
                    <td ><b>Residence Address</b></td>
                    <td  ><textarea  name="hlresiaddress" rows="2" cols="18"></textarea></td>
                    <td ><b>Other City</b></td>
                    <td><!--<input type="text" name="hlcity" id="hlcity" value="<? echo $City; ?>"></textarea>--><input type="text" name="hlother_city" id="hlother_city" > </td>
                </tr>
                 <tr>
			<td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Employment Details</b></td></tr>
                <tr>
                    <td><b>Employment Status</b></td>
                    <td><select name="hlemployment_status" id="hlemployment_status">
                            <option value="1" >Salaried</option>
                            <option value="0">Self Employed</option></select>	</td>
                    <td ><b>Annual Income</b></td>
                    <td><input type="text" name="hlnet_salary" id="hlnet_salary" onKeyUp="getDigitToWords('hlnet_salary', 'formatedIncome', 'wordIncome');" onKeyPress=" getDigitToWords('hlnet_salary', 'formatedIncome', 'wordIncome');" style="float: left" onBlur="getDigitToWords('hlnet_salary', 'formatedIncome', 'wordIncome');"></td>
                </tr>
                <tr><td><b>Company Name</b></td><td><input type="text" name="hlcompany_name" id="hlcompany_name"></td><td colspan="2"></td></tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="2" ><span id='formatedIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordIncome' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
                </tr>
                <tr>
                    <td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Other Details</b></td></tr>
                <tr>
                    <td><b>Loan Amount</b></td>
                    <td><input type="text" name="hlloanamt" id="hlloanamt" onKeyUp="getDigitToWords('hlloanamt', 'formatedloan', 'wordloan');" onKeyPress="getDigitToWords('hlloanamt', 'formatedloan', 'wordloan');" style="float: left" onBlur="getDigitToWords('hlloanamt', 'formatedloan', 'wordloan');"></td>
                    <td ><b>Loan Time</b></td>
                    <td ><select name="hlloantime" >
                            <option value="-1">Please select</option>
                            <OPTION value="15 days">15 days</OPTION>
                            <OPTION value="1 month">1 months</OPTION>
                            <OPTION value="2 months">2 months</OPTION>
                            <OPTION value="3 months">3 months</OPTION>
                            <OPTION value="3 months above">more than 3 months</OPTION>
                        </SELECT>	</td>
                </tr>
                <tr>
                    <td colspan="2" ><span id='formatedloan' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;'></span><span id='wordloan' style='font-size:11px; font-weight:bold;color:666699;font-Family:Verdana;text-transform: capitalize;'></span></td>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td><b>Property Identified</b></td>

                    <td ><input type="radio" name="hlproperty_identified" value="1">Yes<input type="radio" name="hlproperty_identified" value="0">No</td>
                    <td><b>Property Location</b></td>
                    <td ><input type="text" name="hlproperty_loc" ></td>
                </tr>
                <tr>
                    <td><b>Property Value</b></td>
                    <td><input type="text" name="hlProperty_Value" id="hlProperty_Value"></td>
                    <td><b>Total Obligation</b></td>
                    <td><input type="text" name="hlTotal_Obligation" id="hlTotal_Obligation"></td>
                </tr>
                <tr>
                    <td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Co applicant Details</b></td></tr>
                <tr>
                    <td><b>Co Applicant Name:</b></td>
                    <td><input type="text" name="hlCo_Applicant_Name" id="hlCo_Applicant_Name" ></td>
                    <td ><b>Co-Applicant DOB</b></td><td><input type="text" name="hlCo_Applicant_DOB" id="hlCo_Applicant_DOB" ></td>
                </tr>
                <tr>
                    <td><b>Co Monthly Income:</b></td>
                    <td><input type="text" name="hlCo_Applicant_Income" id="hlCo_Applicant_Income" ></td>
                    <td ><b>Co Applicant Obligation</b></td><td><input type="text" name="hlCo_Applicant_Obligation" id="hlCo_Applicant_Obligation"></td>
                </tr>
                <tr><td style="border:1px solid black;" colspan="4" bgcolor="#DAEAF9" align="center" class="fontstyle" ><b>Add Comment</b></td></tr>
                <tr>
                    <td><b>Add Comment</b></td>
                    <td><textarea rows="2" cols="20" name="hladd_comment" id="hladd_comment" ></textarea></td>
                </tr> 
                <tr><td colspan="4">&nbsp;</td></tr>
                <tr>
                    <td colspan="4" align="center"><br><input type="submit" class="bluebutton" value="Submit">    </td>
                </tr>
            </table>
        </form>
    </body>
</html>

<? } 
else 
{
	echo "not authorised to access this";
} ?>
