<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

$page_Name = "LandingPage_HL";

function getProductName($pKey) {
    $titles = array(
        'Req_Loan_Personal' => 'Personal Loan',
        'Req_Loan_Home' => 'Home Loan',
        'Req_Loan_Car' => 'Car Loan',
        'Req_Credit_Card' => 'Credit Card',
        'Req_Loan_Against_Property' => ' Loan Against property',
        'Req_Life_Insurance' => 'Insurance',
    );

    foreach ($titles as $key => $value)
        if ($pKey == $key)
            return $value;

    return "";
}

function getReqValue($pKey) {
    $titles = array(
        'Req_Loan_Personal' => 'personal',
        'Req_Loan_Home' => 'home',
        'Req_Loan_Car' => 'car',
        'Req_Credit_Card' => 'cc',
        'Req_Loan_Against_Property' => 'property',
        'Req_Life_Insurance' => 'insurance'
    );

    foreach ($titles as $key => $value)
        if ($pKey == $key)
            return $value;

    return "";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Name = $_POST['Name'];
    $Activate = $_POST['Activate'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $City = $_POST['City'];
    $City_Other = $_POST['City_Other'];
    $Net_Salary = $_POST['IncomeAmount'];
    $Loan_Amount = $_POST['Loan_Amount'];
    $Type_Loan = $_POST['Type_Loan'];
    $source = $_POST['source'];
    $Creative = $_POST['creative'];
    $Employment_Status = $_POST['Employment_Status'];
    $Section = $_POST['section'];
    $Accidental_Insurance = $_POST['Accidental_Insurance'];
    $Referrer = $_REQUEST['referrer'];
    $Reference_Code = generateNumber(4);
    $IP_Remote = getenv("REMOTE_ADDR");
    if ($IP_Remote == '192.99.32.74') {
        $IP = $_SERVER['HTTP_X_REAL_IP'];
    } else {
        $IP = $IP_Remote;
    }


    $IsPublic = 1;
    if ($Activate > 0) {
        $DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=" . $Activate;
        $DeleteIncompleteQuery = ExecQuery($DeleteIncompleteSql);
    }


    $crap = " " . $Name . " " . $Email . " " . $City_Other;
    //echo $crap,"<br>";
    $crapValue = validateValues($crap);
    $_SESSION['crapValue'] = $crapValue;
    //exit();
    if ($crapValue == 'Put') {
        $tomorrow = mktime(0, 0, 0, date("m"), date("d") - 30, date("Y"));
        $days30date = date('Y-m-d', $tomorrow);
        $days30datetime = $days30date . " 00:00:00";
        $currentdate = date('Y-m-d');
        $currentdatetime = date('Y-m-d') . " 23:59:59";

        $getdetails = "select RequestID From " . $Type_Loan . "  Where (Mobile_Number not in (9971396361,9811215138,9999047207,9891118553,9999570210,9555060388) and Mobile_Number='" . $Phone . "' and Updated_Date between '" . $days30datetime . "' and '" . $currentdatetime . "') order by RequestID DESC";
        //echo $getdetails."<br>";
        //exit();
        $checkavailability = ExecQuery($getdetails);
        $alreadyExist = mysql_num_rows($checkavailability);
        $myrow = mysql_fetch_array($checkavailability);

        if ($alreadyExist > 0) {
            $ProductValue = $myrow['RequestID'];
            $_SESSION['Temp_LID'] = $ProductValue;
            echo "<script language=javascript>" . " location.href='update-home-loan-lead.php'" . "</script>";
        } else {
            $CheckSql = "select UserID from wUsers where Email = '" . $Email . "'";
            $CheckQuery = ExecQuery($CheckSql);
            //echo "<br>".$CheckSql;
            $CheckNumRows = mysql_num_rows($CheckQuery);
            if ($CheckNumRows > 0) {
                $UserID = mysql_result($CheckQuery, 0, 'UserID');
                $InsertProductSql = "INSERT INTO " . $Type_Loan . " (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance, Employment_Status) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$Net_Salary', '$Loan_Amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(),'$Accidental_Insurance', '$Employment_Status' )";
                //	echo "<br>if".$InsertProductSql;
            } else {
                $InsertwUsersSql = "INSERT INTO wUsers (Email,FName,Phone,Join_Date,IsPublic) VALUES  ('$Email', '$Name', '$Phone', Now(), '$IsPublic')";
                $InsertwUsersQuery = ExecQuery($InsertwUsersSql);
                $UserID = mysql_insert_id();
                $InsertProductSql = "INSERT INTO " . $Type_Loan . " (UserID, Name, Email, City, City_Other, Mobile_Number, Net_Salary, Loan_Amount, Dated, source,  Referrer, Creative, Section, IP_Address, Reference_Code,Updated_Date,Accidental_Insurance, Employment_Status) VALUES ( '$UserID', '$Name', '$Email', '$City', '$City_Other', '$Phone', '$Net_Salary', '$Loan_Amount', Now(), '$source', '$Referrer', '$Creative' , '$Section', '$IP', '$Reference_Code', Now(),'$Accidental_Insurance','$Employment_Status' )";
                //echo "<br>else".$InsertProductSql;
            }

            $InsertProductQuery = ExecQuery($InsertProductSql);
            $ProductValue = mysql_insert_id();

            //Send SMS
            ProductSendSMStoRegis($Phone);


            //exit();
            if ($Accidental_Insurance == "1") {
                InsertTataAig($ProductValue, "Req_Loan_Home");
            }

            list($First, $Last) = split('[ ]', $Name);

            //echo "heelo";
            $SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan. You will get a call from us to give you quotes & information to get you best deal for loans.";
            //if(strlen(trim($Phone)) > 0)
            //SendSMS($SMSMessage, $Phone);
            //Code Added to mailtocommonscript.php
            $FName = $Name;
            $Checktosend = "getthank_individual";
            include "scripts/mailatcommonscript.php";

            $headers = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
            $headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
            $headers .= "Bcc: newtestthankuse@gmail.com" . "\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            if ($FName)
                $SubjectLine = $FName . ", Learn to get Best Deal on " . getProductName($Type_Loan);
            else
                $SubjectLine = "Learn to get Best Deal on " . getProductName($Type_Loan);
            //echo $Type_Loan;
            if (isset($Type_Loan)) {
                mail($Email, $SubjectLine, $Message2, $headers);
            }
        }
    }//$crap Check
    else if ($crapValue == 'Discard') {
        header("Location: Redirect.php");
        exit();
    } else {
        header("Location: Redirect.php");
        exit();
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Home Loans India Apply Compare | Housing Mortage Loan</title>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
            <meta name="description" content="Deal4Loans is an online loan information portal, provides valuable information on all types of loans in India offered by top banks. Read and apply online for home loans & Get, Compare and Choose deals from all the leading loan providers / banks. Know the interest rates, EMIs, Loan amount etc choose the Best Deal.">
                <meta name="keywords" content="Home loans India, Apply Home Loans, Compare Home Loans in Mumbai Hyderabad Pune kolkata Delhi Noida Bangalore">
                    <script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
                    <script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>

                    <link rel="stylesheet" href="home_style.css" type="text/css" />
                    <style>
                        .formtext{
                            padding-left:20px;
                            color:#3A0D04;
                            font-family:Verdana,Arial,Helvetica,sans-serif;
                            font-size:11px;
                            font-weight:normal;
                            text-align:left;
                            text-decoration:none;
                        }
                    </style>
                    <Script Language="JavaScript">
                        function containsdigit(param)
                        {
                            mystrLen = param.length;
                            for (i = 0; i < mystrLen; i++)
                            {
                                if ((param.charAt(i) == "0") || (param.charAt(i) == "1") || (param.charAt(i) == "2") || (param.charAt(i) == "3") || (param.charAt(i) == "4") || (param.charAt(i) == "5") || (param.charAt(i) == "6") || (param.charAt(i) == "7") || (param.charAt(i) == "8") || (param.charAt(i) == "9") || (param.charAt(i) == "/"))
                                {
                                    return true;
                                }
                            }
                            return false;
                        }
                        function containsalph(param)
                        {
                            mystrLen = param.length;
                            for (i = 0; i < mystrLen; i++)
                            {
                                if ((param.charAt(i) < "0") || (param.charAt(i) > "9"))
                                {
                                    return true;
                                }
                            }
                            return false;
                        }

                        function Trim(strValue) {
                            var j = strValue.length - 1;
                            i = 0;
                            while (strValue.charAt(i++) == ' ')
                                ;
                            while (strValue.charAt(j--) == ' ')
                                ;
                            return strValue.substr(--i, ++j - i + 1);
                        }


                        function onFocusBlank(element, defaultVal) {
                            if (element.value == defaultVal) {
                                element.value = "";
                            }
                        }


                        function onBlurDefault(element, defaultVal) {
                            if (element.value == "") {
                                element.value = defaultVal;
                            }
                        }



                        function Decoration(strPlan)
                        {
                            if (document.getElementById('plantype') != undefined)
                            {
                                document.getElementById('plantype').innerHTML = strPlan;
                                document.getElementById('plantype').style.background = 'Beige';
                            }

                            return true;
                        }
                        function Decoration1(strPlan)
                        {
                            if (document.getElementById('plantype') != undefined)
                            {
                                document.getElementById('plantype').innerHTML = strPlan;
                                document.getElementById('plantype').style.background = '';

                            }

                            return true;
                        }

                        function addElement()
                        {
                            var ni = document.getElementById('myDiv');
                            var newdiv = document.createElement('div');
                            if (ni.innerHTML == "")
                            {
                                ni.innerHTML = '<table border="0"><tr><td height="20" width="50%" align="left" valign="middle" class="formtext"><span class="form-text">Reconfirm Mobile No.</span></td>	<td colspan="3" align="left" width="50%" height="20" ><input type="text" onChange="intOnly(this);" style="width:113px;" maxlength="10" onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; name="RePhone" id="RePhone"></td></tr></table>';

                                ni.appendChild(newdiv);

                            } else if (ni.innerHTML != "")
                            {

                                //alert(document.loan_form.CC_Holder.value);
                                ni.innerHTML = '';

                            }

                            //return true;
                        }




                        function addIdentified()
                        {
                            var ni = document.getElementById('myDiv1');
                            var ni1 = document.getElementById('myDiv2');

                            if (ni.innerHTML == "")
                            {

                                if (document.home_loan.Property_Identified.value = "on")
                                {
                                    ni1.innerHTML = '';
                                    //alert(document.loan_form.CC_Holder.value);
                                    ni.innerHTML = '<table border="0"><tr><td height="20"  align="left" valign="middle" class="formtext" width="172"><span class="form-text">Property Location</span></td>	<td colspan="3" align="left" height="20" >&nbsp;&nbsp;&nbsp;<select style="width:147px;" name="Property_Loc" id="Property_Loc"><?= getCityList1($City) ?></select></td></tr></table>';
                                }

                            }

                            return true;
                        }

                        function removeIdentified()
                        {
                            var ni = document.getElementById('myDiv1');
                            var ni1 = document.getElementById('myDiv2');

                            if ((ni.innerHTML != "") || (ni1.innerHTML == ""))
                            {

                                if (document.home_loan.Property_Identified.value = "on")
                                {
                                    //alert(document.loan_form.CC_Holder.value);
                                    ni.innerHTML = '';
                                    ni1.innerHTML = '<table border="0"><tr><td height="20" colspan="2" align="left" valign="center" class="formtext"><input type="checkbox" name="updateProperty" style="border:none;"><span class="form-text">&nbsp;Can we tell you about some properties</font></td></tr></table>';
                                }
                            }

                            return true;

                        }



                        function submitform(Form)
                        {
                            var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
                            var dt, mdate;
                            dt = new Date();
                            var alpha = /^[a-zA-Z\ ]*$/;
                            var alphanum = /^[a-zA-Z0-9]*$/;
                            var num = /^[0-9]*$/;
                            var space = /^[\ ]*$/;
                            var iChars = "/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";


                            var btnvalidate;
                            var cnt = -1;
                            var i;
                            var btn;
                            //	btn=valButton(Form.Property_Identified);
                            //	btnvalidate=valvalidate();

                            /*if(Form.Reference_Code1.value=="")
                             {
                             if(!Form.confirm.checked)
                             {
                             alert("if you havnt received activation code click check box.");
                             Form.confirm.focus();
                             return false;
                             }
                             else if(Form.confirm.checked)
                             {
                             if(Form.RePhone.value=="")
                             {
                             alert("Please Re confirm your mobile number again");
                             Form.RePhone.focus();
                             return false;
                             }
                             if(isNaN(Form.RePhone.value)|| Form.RePhone.value.indexOf(" ")!=-1)
                             {
                             alert("Enter numeric value");
                             Form.RePhone.focus();
                             return false;  
                             }
                             if (Form.RePhone.value.length < 10 )
                             {
                             alert("Please Enter 10 Digits"); 
                             Form.RePhone.focus();
                             return false;
                             }
                             if (Form.RePhone.value.charAt(0)!="9")
                             {
                             alert("The number should start only with 9");
                             Form.RePhone.focus();
                             return false;
                             }
                             
                             }
                             }*/

                            if ((space.test(Form.day.value)) || (Form.day.value == "dd"))
                            {
                                alert("Kindly enter your Date of Birth");
                                Form.day.select();
                                return false;
                            } else if (!num.test(Form.day.value))
                            {
                                alert("Kindly enter your Date of Birth(numbers Only)");
                                Form.day.focus();
                                return false;
                            } else if ((Form.day.value < 1) || (Form.day.value > 31))
                            {
                                alert("Kindly Enter your valid Date of Birth(Range 1-31)");
                                Form.day.focus();
                                return false;
                            } else if ((space.test(Form.month.value)) || (Form.month.value == "mm"))
                            {
                                alert("Kindly enter your Month of Birth");
                                Form.month.focus();
                                return false;
                            } else if (!num.test(Form.month.value))
                            {
                                alert("Kindly enter your Month of Birth(numbers Only)");
                                Form.month.focus();
                                return false;
                            } else if ((Form.month.value < 1) || (Form.month.value > 12))
                            {
                                alert("Kindly Enter your valid Month of Birth(Range 1-12)");
                                Form.month.focus();
                                return false;
                            } else if ((Form.month.value == 2) && (Form.day.value > 29))
                            {
                                alert("Month February cannot have more than 29 days");
                                Form.day.focus();
                                return false;
                            } else if ((space.test(Form.year.value)) || (Form.year.value == "yyyy"))
                            {
                                alert("Kindly enter your Year of Birth");
                                Form.year.focus();
                                return false;
                            } else if (!num.test(Form.year.value))
                            {
                                alert("Kindly enter your Year of Birth(numbers Only) !");
                                Form.year.focus();
                                return false;
                            } else if ((Form.day.value > 28) && (parseInt(Form.month.value) == 2) && ((Form.year.value % 4) != 0))
                            {
                                alert("February cannot have more than 28 days.");
                                Form.day.focus();
                                return false;
                            } else if (Form.year.value.length != 4)
                            {
                                alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
                                Form.year.focus();
                                return false;
                            } else if ((Form.year.value < "1945") || (Form.year.value > "1989"))
                            {
                                alert("Age Criteria! \n Applicants between age group 18 - 62 only are elgibile.");
                                Form.year.focus();
                                return false;
                            } else if (Form.year.value > parseInt(mdate - 21) || Form.year.value < parseInt(mdate - 62))
                            {
                                alert("Age Criteria! \n Applicants between age group 21 - 62 only are elgibile.");
                                Form.year.focus();
                                return false;
                            } else if ((parseInt(Form.day.value) == 31) && ((parseInt(Form.month.value) == 4) || (parseInt(Form.month.value) == 6) || (parseInt(Form.month.value) == 9) || (parseInt(Form.month.value) == 11) || (parseInt(Form.month.value) == 2)))
                            {
                                alert("Cannot have 31st Day");
                                Form.day.select();
                                return false;
                            }
                            if ((Form.Gender[0].checked == false) && (Form.Gender[1].checked == false))
                            {
                                alert("Please choose your Gender: Male or Female");
                                return false;
                            }
                            if (Form.Residence_Address.value == '')
                            {
                                alert("Kindly fill in your Residence Address!");
                                Form.Residence_Address.focus();
                                return false;
                            }

                            if ((Form.Pincode.value == 'PinCode') || (Form.Pincode.value == 'PinCod') || (Form.Pincode.value == '') || Trim(Form.Pincode.value) == false)
                            {
                                alert("Kindly fill in your Pincode!");
                                Form.Pincode.focus();
                                return false;
                            } else if (Form.Pincode.value.length < 6)
                            {
                                alert("Kindly fill in your Pincode(6 Digits)!");
                                Form.Pincode.focus();
                                return false;
                            } else if (containsalph(Form.Pincode.value) == true)
                            {
                                alert("Kindly fill in your Correct Pincode (Numeric Only)!");
                                Form.Pincode.focus();
                                return false;
                            }
                            var a = Form.Pancard.value;
                            var regex1 = /^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
                            if (regex1.test(a) == false)
                            {
                                alert("Kindly enter correct PAN Card");

                                Form.Pancard.focus();
                                return false;
                            }
                            if (Form.Pancard.value.charAt(3) != "P" && Form.Pancard.value.charAt(3) != "p")
                            {
                                alert("Kindly enter correct PAN Card");

                                Form.Pancard.focus();
                                return false;
                            }

                            if ((Form.Pancard.value == ""))
                            {
                                alert("Kindly enter correct PAN Card");

                                Form.Pancard.focus();
                                return false;
                            }

                            if (Form.Employment_Status.selectedIndex == 0)
                            {
                                alert("Please select emplyment status ");
                                Form.Employment_Status.focus();
                                return false;
                            }



                            if (Form.Company_Name.value == "")
                            {
                                alert("Please fill your Company Name.");
                                Form.Company_Name.focus();
                                return false;
                            }

                            for (i = 0; i < Form.Property_Identified.length; i++)
                            {
                                if (Form.Property_Identified[i].checked)
                                {
                                    cnt = i;
                                }
                            }
                            if (cnt == -1)
                            {
                                alert("please select you have identified any property or not");
                                return false;
                            }
                            if (cnt == 0)
                            {
                                if (Form.Property_Loc.selectedIndex == 0)
                                {
                                    alert("Plese select city where property is located");
                                    Form.Property_Loc.focus();
                                    return false;
                                }
                            }


                            if (Form.Budget.selectedIndex == 0)
                            {
                                alert("Please estimated market value of the property");
                                Form.Budget.focus();
                                return false;
                            }
                            if (Form.Loan_Time.selectedIndex == 0)
                            {
                                alert("Please enter when you are planning to take loan");
                                Form.Loan_Time.focus();
                                return false;
                            }
                            return true;
                        }


                        function showdetailsFaq(d, e)
                        {
                            for (j = 1; j <= e; j++)
                            {
                                if (d == j)
                                {
                                    if (eval(document.getElementById("divfaq" + j)).style.display == 'none')
                                    {

                                        eval(document.getElementById("divfaq" + j)).style.display = ''
                                        //eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
                                    } else
                                    {

                                        eval(document.getElementById("divfaq" + j)).style.display = 'none'
                                        //eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
                                    }
                                }

                            }
                        }

                    </script>

                    </head>

                    <body>
                        <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border:5px solid #E9DCB4; background-color:#F4EFE0;">
                            <tr>
                                <td style="padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="150" height="55" align="center" valign="middle" ><img src="images/hl_logo.gif" width="140" height="45" /></td>
                                                        <td width="420" align="left" valign="middle" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#3A0303; font-size:13px; text-decoration:none; font-weight:bold;	">Home Loans by choice not by chance!!</td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                        <tr>
                                            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                                                <tr>
                                                                    <td width="80%" height="30" align="right" class="heading" style="font-style:normal; font-size:13px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#7d0606; " >50% Of your Loan Quote Application is Complete </td>
                                                                    <td width="20%" height="30" align="left" style="padding-left:5px;"><!--<img src="images/bar.gif" width="220" height="19" /> -->
                                                                        <img src="new-images/loader.gif" width="24" height="24" /></td>
                                                                </tr>
                                                                <tr align="center">
                                                                    <td height="40" colspan="2" class="text" style="text-align:center; font-size:12px; line-height:18px; ">The one-stop shop for Best on Home loan 
                                                                        requirements Now get offers from<br /> 
                                                                        <b style="color:#7d0606;"> SBI,
                                                                            HDFC Ltd,
                                                                            ICICI HFC,
                                                                            IDBI, Axis and LIC</b></td>
                                                                </tr>
                                                                <tr align="center">
                                                                    <td colspan="2" height="10"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="35" colspan="2" align="center" class="text" ><form name="home_loan"  action="apply-home-loan-thank.php" method="post" onSubmit="return submitform(document.home_loan);" >
                                                                            <table width="400" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px dashed #CCCCCC; ">
                                                                                <tr align="center">
                                                                                    <td height="40" colspan="2"><span class="heading">Home Loan Quote Request</span></td>
                                                                                </tr>

                                                                                <tr>
                                                                                    <td width="149" height="24" align="left" valign="middle" class="formtext">Date of Birth<font color="#FF0000">&nbsp;</font></td>
                                                                                    <td width="151" align="left">
                                                                                        <input type="text" value="dd" name="day" id="day" maxlength="2" style="width:28px;"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this, 'dd');"  onFocus="onFocusBlank(this, 'dd');"/>&nbsp;<input type="text" name="month" id="month" maxlength="2" style="width:28px;"  onChange="intOnly(this);" value="mm"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)" onBlur="onBlurDefault(this, 'mm');"  onFocus="onFocusBlank(this, 'mm');" />&nbsp;<input type="text" maxlength="4" value="yyyy" name="year" id="year" style="width:64px;"  onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" onBlur="onBlurDefault(this, 'yyyy');" onFocus="onFocusBlank(this, 'yyyy');" /></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="149" height="24" align="left" valign="middle" class="formtext">Gender<font color="#FF0000">&nbsp;</font></td>
                                                                                    <td width="151" align="left">
                                                                                        <input type="radio" name="Gender" id="Gender" value="1" style="border:none;" /> Male&nbsp;&nbsp;<input type="radio"  name="Gender" id="Gender2" value="2" style="border:none;" /> Female</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="149" height="24" align="left" valign="middle" class="formtext">Residence Address<font color="#FF0000">&nbsp;</font></td>
                                                                                    <td width="151" align="left">
                                                                                        <input name="Residence_Address" type="text" id="Residence_Address" style="width:140px;" /></td>
                                                                                </tr>
                                                                                
                                                                                <tr>
                                                                                    <td width="149" height="24" align="left" valign="middle" class="formtext">Pincode<font color="#FF0000">&nbsp;</font></td>
                                                                                    <td align="left"><input name="Pincode" type="text" id="Pincode" style="width:140px;" onFocus="this.select();" onChange="intOnly(this);" onKeyPress="intOnly(this);" onKeyUp="intOnly(this);"  maxlength="6" /></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td width="149" height="24" align="left" valign="middle" class="formtext">PAN No<font color="#FF0000">&nbsp;</font></td>
                                                                                    <td width="151" align="left">
                                                                                        <input name="Pancard" type="text" id="Pancard" style="width:140px; text-transform: uppercase"  maxlength="10"   /></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td height="30" align="left" valign="middle" class="formtext">Employement 
                                                                                        Status</td>
                                                                                    <td align="left"><select style="width:146px;" name="Employment_Status" id="Employment_Status">
                                                                                            <option selected value="-1">Employment Status</option>
                                                                                            <option  value="1">Salaried</option>
                                                                                            <option value="0">Self Employed</option>
                                                                                        </select>                                </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td height="25" align="left" valign="middle" class="formtext">Company Name <font color="#FF0000">&nbsp;</font></td>
                                                                                    <td align="left"><input type="text" name="Company_Name" id="Company_Name" style="width:140px;"/></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td height="23" align="left" valign="middle" class="formtext">Property
                                                                                        Identified</td>
                                                                                    <td align="left"><input type="radio" name="Property_Identified" id="Property_Identified" value="1" onClick="addIdentified();" style="border:none;" /> Yes&nbsp;&nbsp;<input type="radio"  name="Property_Identified" id="Property_Identified" onClick="removeIdentified();" value="0" style="border:none;" /> No                                </td>
                                                                                </tr>

                                                                                <tr><td colspan="2" id="myDiv1"></td></tr>
                                                                                <tr><td colspan="2" id="myDiv2"></td></tr>

                                                                                <tr>
                                                                                    <td width="149" height="25" align="left" valign="middle" class="formtext">Property Value <font color="#FF0000">&nbsp;</font></td>
                                                                                    <td align="left"><input type="text" name="Property_Value" id="Property_Value" style="width:140px;" onKeyUp="intOnly(this);
                                                                                            getDigitToWords('Property_Value', 'formatedPV', 'wordpropertyvalue');" onKeyPress="intOnly(this); getDigitToWords('Loan_Amount', 'formatedPV', 'wordloanAmount');" onKeyDown="getDigitToWords('Property_Value', 'formatedPV', 'wordpropertyvalue');" onBlur="getDigitToWords('Property_Value', 'formatedPV', 'wordpropertyvalue'); "/>                 </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="2" align="left" valign="middle" class="formtext"><span id='formatedPV' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span><span id='wordpropertyvalue' style='font-family: Verdana, Arial, Helvetica, sans-serif;	font-size:11px;	color:#3A0D04; text-decoration:none; font-weight:bold; text-align:left;'></span> </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td height="23" align="left" valign="middle" class="formtext">Total Amount of EMI's<br /> 
                                                                                        (Per Month)</td>
                                                                                    <td align="left"><input type="text" name="obligations" id="obligations" style="width:140px;"    onkeyup="intOnly(this);" onkeypress="intOnly(this);" />                                </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td height="45" align="left" valign="middle" class="formtext">When you are planning<br /> 
                                                                                        to take loan?</td>
                                                                                    <td align="left"><select name="Loan_Time" style="width:146px;">
                                                                                            <OPTION value="-1" selected>Please select</OPTION>
                                                                                            <OPTION value="15 days">15 days</OPTION>
                                                                                            <OPTION value="1 month">1 months</OPTION>
                                                                                            <OPTION value="2 months">2 months</OPTION>
                                                                                            <OPTION value="3 months">3 months</OPTION>
                                                                                            <OPTION value="3 months above">more than 3 months</OPTION>
                                                                                        </select>

                                                                                        <input type="hidden" name="ProductValue" id="ProductValue" value="<?php echo $ProductValue; ?>" />
                                                                                        <input type="hidden" name="Type_Loan" value="Req_Loan_Home">

                                                                                            <input type="hidden" name="Phone" id="Phone" value="<?php echo $Phone; ?>" />
                                                                                            <input type="hidden" name="City" id="City" value="<?php echo $City; ?>" />
                                                                                            <input type="hidden" name="Net_Salary" id="Net_Salary" value="<?php echo $Net_Salary; ?>" />	
                                                                                            <input type="hidden" name="Loan_Amount" id="Loan_Amount" value="<?php echo $Loan_Amount; ?>" />
                                                                                            <input type="hidden" name="City_Other" id="City_Other" value="<?php echo $City_Other; ?>" /></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td height="25" colspan="2" align="left" valign="middle" class="formtext"><input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1, 12);" style="border:none;" tabindex="18">
                                                                                            Co- Applicant</td>
                                                                                </tr>
                                                                                <tr><td colspan="2">
                                                                                        <div style=" display:none;" id="divfaq1">
                                                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                                                                                <tr>
                                                                                                    <td width="185" height="30" align="left"  class="formtext">Name</td>
                                                                                                    <td width="183" align="left"> 
                                                                                                        <input type="text" name="co_name" id="co_name" style="width:140px;" tabindex="19" maxlength="30" >
                                                                                                    </td></tr>
                                                                                                <tr>
                                                                                                    <td width="185" align="left" class="formtext">DOB </td>
                                                                                                    <td width="183" align="left"><input onfocus="insertData();" name="co_day" type="text" id="co_day" style="width:28px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; value="DD" tabindex="20" />
                                                                                                        <input name="co_month" type="text" id="co_month" style="width:28px;" maxlength="2" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="MM" tabindex="21" />
                                                                                                        <input name="co_year" type="text" id="co_year" style="width:64px;" maxlength="4" onchange="intOnly(this);" onkeyup="intOnly(this);" onkeypress="intOnly(this);" value="YYYY" tabindex="22" /></td></tr>
                                                                                                <tr>
                                                                                                    <td width="185" height="30" align="left" class="formtext">Net Monthly Income</td>
                                                                                                    <td width="183" align="left">            <input type="text" name="co_monthly_income" id="co_monthly_income" style="width:140px;" onkeyup="intOnly(this);" onkeypress="intOnly(this);" tabindex="23" />          </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td height="30" align="left" class="formtext">Consolidated EMI's<br /> 
                                                                                                        (Per Month) </td>
                                                                                                    <td align="left">            <input type="text" name="co_obligations" id="co_obligations" tabindex="24" style="width:140px;"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" />          </td>

                                                                                                </tr>
                                                                                            </table>

                                                                                        </div></td></tr>
                                                                                <tr>
                                                                                    <td colspan="2" id="tataaig_compaign" class="subheading" ></td></tr>
                                                                                <tr>
                                                                                    <td height="40" colspan="2" align="center" valign="middle"><input value="Get Quotes" name="submit" type="submit" class="hlbtn" style="font-size:13px; border:none;" /></td>
                                                                                </tr>
                                                                            </table>
                                                                        </form></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" align="center" class="text" >&nbsp;</td>
                                                                </tr>
                                                            </table></td>
                                                    </tr>
                                                </table></td>
                                        </tr>
                                        <tr>
                                            <td height="5"></td>
                                        </tr>
                                    </table></td>
                            </tr>
                        </table>

                        <!-- Google Code for lead Conversion Page -->
                        <script type="text/javascript">
                            /* <![CDATA[ */
                            var google_conversion_id = 1066264455;
                            var google_conversion_language = "en";
                            var google_conversion_format = "3";
                            var google_conversion_color = "ffffff";
                            var google_conversion_label = "UcZECLrjrlYQh8-3_AM";
                            var google_remarketing_only = false;
                            /* ]]> */
                        </script>
                        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
                        </script>
                        <noscript>
                            <div style="display:inline;">
                                <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1066264455/?label=UcZECLrjrlYQh8-3_AM&amp;guid=ON&amp;script=0"/>
                            </div>
                        </noscript>

                    </body>
                    </html>
