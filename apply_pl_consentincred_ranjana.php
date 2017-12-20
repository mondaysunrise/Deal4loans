<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';


$BankArray = array("47" => "Abhyudaya Cooperative Bank Limited",
"191" => "Abu Dhabi Commercial Bank",
"169" => "Ahmedabad Mercantile Cooperative Bank",
"116" => "Airtel Payments Bank Limited",
"4" => "Akola Janata Commercial Cooperative Bank",
"100" => "Allahabad Bank",
"24" => "Almora Urban Cooperative Bank Limited",
"97" => "Andhra Bank",
"55" => "Andhra Pragathi Grameena Bank",
"23" => "Apna Sahakari Bank Limited",
"164" => "Australia And New Zealand Banking Group Limited",
"101" => "Axis Bank",
"185" => "B N P Paribas",
"77" => "Bandhan Bank Limited",
"143" => "Bank Internasional Indonesia",
"190" => "Bank Of America",
"189" => "Bank Of Baharain And Kuwait Bsc",
"108" => "Bank Of Baroda",
"188" => "Bank Of Ceylon",
"105" => "Bank Of India",
"90" => "Bank Of Maharashtra",
"187" => "Bank Of Tokyo Mitsubishi Limited",
"186" => "Barclays Bank",
"46" => "Bassein Catholic Cooperative Bank Limited",
"33" => "Bharat Cooperative Bank Mumbai Limited",
"3" => "Bharatiya Mahila Bank Limited",
"110" => "Canara Bank",
"22" => "Capital Small Finance Bank Limited",
"68" => "Catholic Syrian Bank Limited",
"104" => "Central Bank Of India",
"184" => "Chinatrust Commercial Bank Limited",
"45" => "Citi Bank",
"44" => "Citizen Credit Cooperative Bank Limited",
"67" => "City Union Bank Limited",
"109" => "COLUMN1",
"156" => "Commonwealth Bank Of Australia",
"93" => "Corporation Bank",
"183" => "Credit Agricole Corporate And Investment Bank Caly",
"163" => "Credit Suisee Ag",
"66" => "Dcb Bank Limited",
"87" => "Dena Bank",
"118" => "Deogiri Nagari Sahakari Bank Ltd. Aurangabad",
"132" => "Deposit Insurance And Credit Guarantee Corporation",
"182" => "Deustche Bank",
"131" => "Development Bank Of Singapore",
"65" => "Dhanalakshmi Bank",
"129" => "Doha Bank",
"130" => "Doha Bank Qsc",
"43" => "Dombivli Nagari Sahakari Bank Limited",
"48" => "Equitas Small Finance Bank Limited",
"128" => "Export Import Bank Of India",
"83" => "Federal Bank",
"181" => "Firstrand Bank Limited",
"36" => "G P Parsik Bank",
"52" => "Gurgaon Gramin Bank",
"107" => "Hdfc Bank",
"49" => "Himachal Pradesh State Cooperative Bank Ltd",
"42" => "Hsbc Bank",
"137" => "Hsbc Bank Oman Saog",
"106" => "Icici Bank Limited",
"96" => "Idbi Bank",
"2" => "Idfc Bank Limited",
"1" => "Idukki District Co Operative Bank Ltd",
"94" => "Indian Bank",
"99" => "Indian Overseas Bank",
"81" => "Indusind Bank",
"142" => "Industrial And Commercial Bank Of China Limited",
"125" => "Industrial Bank Of Korea",
"21" => "Jalgaon Janata Sahakari Bank Limited",
"76" => "Jammu And Kashmir Bank Limited",
"127" => "Janakalyan Sahakari Bank Limited",
"139" => "Janaseva Sahakari Bank Borivli Limited",
"41" => "Janaseva Sahakari Bank Limited",
"20" => "Janata Sahakari Bank Limited",
"147" => "Jp Morgan Bank",
"19" => "Kallappanna Awade Ichalkaranji Janata Sahakari Ban",
"19" => "Kallappanna Awade Ichalkaranji Janata Sahakari Ban",
"32" => "Kalupur Commercial Cooperative Bank",
"30" => "Kalyan Janata Sahakari Bank",
"180" => "Kapol Cooperative Bank Limited",
"75" => "Karnataka Bank Limited",
"74" => "Karnataka Vikas Grameena Bank",
"73" => "Karur Vysya Bank",
"122" => "Keb Hana Bank",
"71" => "Kerala Gramin Bank",
"88" => "Kotak Mahindra Bank Limited",
"63" => "Laxmi Vilas Bank",
"40" => "Mahanagar Cooperative Bank",
"69" => "Maharashtra Gramin Bank",
"39" => "Maharashtra State Cooperative Bank",
"179" => "Mashreqbank Psc",
"178" => "Mizuho Bank Ltd",
"5" => "Nagar Urban Co Operative Bank",
"14" => "Nagpur Nagarik Sahakari Bank Limited",
"145" => "National Australia Bank Limited",
"123" => "National Bank Of Abu Dhabi Pjsc",
"38" => "New India Cooperative Bank Limited",
"37" => "Nkgsb Cooperative Bank Limited",
"56" => "North Malabar Gramin Bank",
"177" => "Nutan Nagarik Sahakari Bank Limited",
"176" => "Oman International Bank Saog",
"92" => "Oriental Bank Of Commerce",
"70" => "Pragathi Krishna Gramin Bank",
"57" => "Prathama Bank",
"17" => "Prime Cooperative Bank Limited",
"117" => "Pt Bank Maybank Indonesia Tbk",
"35" => "Punjab And Maharshtra Cooperative Bank",
"85" => "Punjab And Sind Bank",
"111" => "Punjab National Bank",
"162" => "Rabobank International",
"138" => "Rajgurunagar Sahakari Bank Limited",
"175" => "Rajkot Nagrik Sahakari Bank Limited",
"62" => "Rbl Bank Limited",
"174" => "Reserve Bank Of India, Pad",
"144" => "Sahebrao Deshmukh Cooperative Bank Limited",
"120" => "Samarth Sahakari Bank Ltd",
"61" => "Saraswat Cooperative Bank Limited",
"154" => "Sber Bank",
"124" => "Sbm Bank Mauritius Limited",
"134" => "Shikshak Sahakari Bank Limited",
"173" => "Shinhan Bank",
"119" => "Shivalik Mercantile Co Operative Bank Ltd",
"12" => "Shri Chhatrapati Rajashri Shahu Urban Cooperative",
"172" => "Societe Generale",
"7" => "Solapur Janata Sahakari Bank Limited",
"78" => "South Indian Bank",
"34" => "Standard Chartered Bank",
"82" => "State Bank Of Bikaner And Jaipur",
"89" => "State Bank Of Hyderabad",
"112" => "State Bank Of India",
"171" => "State Bank Of Mauritius Limited",
"79" => "State Bank Of Mysore",
"80" => "State Bank Of Patiala",
"84" => "State Bank Of Travancore",
"149" => "Sumitomo Mitsui Banking Corporation",
"126" => "Surat National Cooperative Bank Limited",
"157" => "Sutex Cooperative Bank Limited",
"102" => "Syndicate Bank",
"64" => "Tamilnad Mercantile Bank Limited",
"115" => "Telangana State Coop Apex Bank",
"16" => "The A.P. Mahesh Cooperative Urban Bank Limited",
"10" => "The Akola District Central Cooperative Bank",
"72" => "The Andhra Pradesh State Cooperative Bank Limited",
"170" => "The Bank Of Nova Scotia",
"54" => "The Cosmos Co Operative Bank Limited",
"6" => "The Delhi State Cooperative Bank Limited",
"146" => "The Gadchiroli District Central Cooperative Bank L",
"168" => "The Greater Bombay Cooperative Bank Limited",
"15" => "The Gujarat State Cooperative Bank Limited",
"133" => "The Hasti Coop Bank Ltd",
"8" => "The Jalgaon Peopels Cooperative Bank Limited",
"53" => "The Kangra Central Cooperative Bank Limited",
"136" => "The Kangra Cooperative Bank Limited",
"26" => "The Karad Urban Cooperative Bank Limited",
"31" => "The Karanataka State Cooperative Apex Bank Limited",
"9" => "The Kurmanchal Nagar Sahakari Bank Limited",
"29" => "The Mehsana Urban Cooperative Bank",
"18" => "The Mumbai District Central Cooperative Bank Limit",
"160" => "The Municipal Cooperative Bank Limited",
"28" => "The Nainital Bank Limited",
"25" => "The Nasik Merchants Cooperative Bank Limited",
"114" => "The Navnirman Co-Operative Bank Limited",
"121" => "The Pandharpur Urban Co Op. Bank Ltd. Pandharpur",
"58" => "The Rajasthan State Cooperative Bank Limited",
"167" => "The Royal Bank Of Scotland N V",
"148" => "The Seva Vikas Cooperative Bank Limited",
"60" => "The Shamrao Vithal Cooperative Bank",
"13" => "The Surat District Cooperative Bank Limited",
"166" => "The Surath Peoples Cooperative Bank Limited",
"165" => "The Tamil Nadu State Apex Cooperative Bank",
"161" => "The Thane Bharat Sahakari Bank Limited",
"11" => "The Thane District Central Cooperative Bank Limite",
"155" => "The Varachha Cooperative Bank Limited",
"159" => "The Vishweshwar Sahakari Bank Limited",
"59" => "The West Bengal State Cooperative Bank",
"135" => "The Zoroastrian Cooperative Bank Limited",
"50" => "Tjsb Sahakari Bank Limited",
"27" => "Tjsb Sahakari Bank Ltd",
"153" => "Tumkur Grain Merchants Cooperative Bank Limited",
"95" => "Uco Bank",
"113" => "Ujjivan Small Finance Bank Limited",
"103" => "Union Bank Of India",
"86" => "United Bank Of India",
"141" => "United Overseas Bank Limited",
"151" => "Vasai Vikas Sahakari Bank Limited",
"152" => "Vasai Vikas Sahakari Bank Ltd",
"91" => "Vijaya Bank",
"150" => "Westpac Banking Corporation",
"158" => "Woori Bank",
"98" => "Yes Bank",
"140" => "Zila Sahakri Bank Limited Ghaziabad");

$pl_requestid = "3062322";
//$pl_bank_name = $_REQUEST['pl_bank_name'];
//$pl_requestid = '2438978';
if ($pl_requestid > 1) {
    $selqry = "select PL_Bank,Loan_Amount,Name,DOB,Company_Name,Net_Salary,City,Mobile_Number,Email,source,Gender,Pancard,Residence_Address,Company_Name,City,Pincode from Req_Loan_Personal Where RequestID=" . $pl_requestid;
    list($Numrows, $plrow) = MainselectfuncNew($selqry, $array = array());
    $countr = count($plrow) - 1;
    $pl_banks = $plrow[$countr]['PL_Bank'];
    $loan_amount = $plrow[$countr]["Loan_Amount"];
    $name = $plrow[$countr]["Name"];
    $DOB = $plrow[$countr]["DOB"];
    $company_name = $plrow[$countr]["Company_Name"];
    $salary = $plrow[$countr]["Net_Salary"] / 12;
    $City = $plrow[$countr]["City"];
    $Mobile_Number = $plrow[$countr]["Mobile_Number"];
	 $Mobile_Number="9812158690";
    $Email = $plrow[$countr]["Email"];
    $source = $plrow[$countr]["source"];
    $Gender = $plrow[$countr]["Gender"];
    $Pancard = $plrow[$countr]["Pancard"];
    $Residence_Address = $plrow[$countr]["Residence_Address"];
    $City = $plrow[$countr]["City"];
    $Pincode = $plrow[$countr]["Pincode"];

    if (strlen($pl_banks) > 1) {
        $newpl_banks = $pl_banks . "," . $pl_bank_name;
        $wherecondition = "(Req_Loan_Personal.RequestID=" . $pl_requestid . ")";
        $dataarray = array("PL_Bank" => $newpl_banks);
    } else {
        $dataarray = array("PL_Bank" => $pl_bank_name);
        $wherecondition = "(Req_Loan_Personal.RequestID=" . $pl_requestid . ")";
    }
    //$rowcount=Mainupdatefunc("Req_Loan_Personal", $dataarray, $wherecondition);
    //echo $plupdate."<br>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
            .heading_text{font: bold 18px/100% Arial, Helvetica, sans-serif; color:#0199cd; margin-left:15px; }
            .sbi_text_c{ color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;}
            #sidebar {
                width: 340px;
                float: right;
                margin: 30px 0 30px;
            }
            #content {
                background: #fff;
                margin: 30px 0 30px 20px;
                padding: 10px;
                width: 570px;
                float: left;
                /* rounded corner */
                -webkit-border-radius: 8px;
                -moz-border-radius: 8px;
                border-radius: 8px;
                /* box shadow */
                -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
                -moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
                box-shadow: 0 1px 3px rgba(0,0,0,.4);
            }

            .widget {
                background: #fff;
                margin: 0 0 30px;
                padding: 10px 20px;
                /* rounded corner */
                -webkit-border-radius: 8px;
                -moz-border-radius: 8px;
                border-radius: 8px;
                /* box shadow */
                -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.4);
                -moz-box-shadow: 0 1px 3px rgba(0,0,0,.4);
                box-shadow: 0 1px 3px rgba(0,0,0,.4);
            }
            .bajaj-fin_input{width:100%; height:25px; border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}
            .bajaj-fin_txtinput{width:100%;  border-radius:5px 5px 5px 5px; border: solid 2px #0199cd;}

            .sbi_text_bullet ul{ padding:0px 0px 0px 0px; margin:0px 0px 0px 0px}
            .sbi_text_bullet li{color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold; list-style: url(/new-images/sbi_bullet1.jpg); margin-left:15px; line-height:25px; }
            .sbi_text_bullet li a{color:#0199cd; font-family:Arial, Helvetica, sans-serif; font-size:14px; font-weight:bold;}
            .bajaj-fin_txtselect {
                width: 100%; height:28px;
                border-radius: 5px 5px 5px 5px;
                border: solid 2px #0199cd;
            }
        </style>


        <link href="source.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            .heading_text1 {font: bold 20px/100% Arial, Helvetica, sans-serif; color:#0199cd; margin-left:20px; }
        </style>
        <script type="text/javascript" src="scripts/mainmenu.js"></script>
        <script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
        <script Language="JavaScript" Type="text/javascript">
            function sameasabove_adress()
            {
                var ni1 = document.cibil_form.caddress.value;
                document.getElementById('paddress').value = ni1;
                var ni2 = document.cibil_form.state.value;
                document.getElementById('pstate').value = ni2;
                var ni3 = document.cibil_form.pincode.value;
                document.getElementById('ppincode').value = ni3;
            }

            function ckhcreditcard(Form)
            {
                if (Form.loan_amount.value == "")
                {
                    alert("Please enter Loan Amount");
                    Form.loan_amount.focus();
                    return false;
                }
                if (Form.name.value == "")
                {
                    alert("Please enter Name");
                    Form.name.focus();
                    return false;
                }
                if (Form.dob.value == "")
                {
                    alert("Please enter Date of birth in yyyy-mm-dd format");
                    Form.dob.focus();
                    return false;
                }
                var GenderVal = Form.gender;
                for (var i = 0; i < GenderVal.length; i++) {
                    if (GenderVal[i].checked)
                        break;
                }
                if (i == GenderVal.length)
                {
                    alert("Please Select Gender");
                    return false;
                }                

                var a = Form.panno.value;
                var regex1 = /^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
                if (regex1.test(a) == false)
                {
                    alert('Please enter valid pan number');
                    Form.panno.focus();
                    return false;
                }
                if (Form.panno.value.charAt(3) != "P" && Form.panno.value.charAt(3) != "p")
                {
                    alert("Please enter valid pan number");
                    Form.panno.focus();
                    return false;
                }
                
                if (Form.ResAddress.value == "")
                {
                    alert("Please enter Residence Address");
                    Form.ResAddress.focus();
                    return false;
                }
               
                if (Form.Respincode.value == "")
                {
                    alert("Please enter Residence Address Pincode");
                    Form.Respincode.focus();
                    return false;
                } else if (Form.Respincode.value.length < 6)
                {
                    alert("Kindly fill in your Pincode(6 Digits)!");
                    Form.Respincode.focus();
                    return false;
                }
                
                if (Form.company_name.value == "")
                {
                    alert("Please enter Employer Name");
                    Form.company_name.focus();
                    return false;
                }
                if (Form.designation.value == "")
                {
                    alert("Please enter Designation");
                    Form.designation.focus();
                    return false;
                } 
                if (Form.joinmonth.value == "")
                {
                    alert("Please Select Join Month");
                    Form.joinmonth.focus();
                    return false;
                }
                if (Form.joinyear.value == "")
                {
                    alert("Please Select Join Year");
                    Form.joinyear.focus();
                    return false;
                }
                if (Form.OfficeAddress.value == "")
                {
                    alert("Please enter Office Address");
                    Form.OfficeAddress.focus();
                    return false;
                }
                if (Form.OfficeCity.value == "" || Form.OfficeCity.value =="Please Select")
                {
                    alert("Please enter Office City");
                    Form.OfficeCity.focus();
                    return false;
                }
                if (Form.office_state.value == "")
                {
                    alert("Please select Office State");
                    Form.office_state.focus();
                    return false;
                }
                if (Form.OfficePincode.value == "")
                {
                    alert("Please enter Office Pincode");
                    Form.OfficePincode.focus();
                    return false;
                }
                if (Form.GrossMonthly.value == "")
                {
                    alert("Please enter Gross Monthly Salary");
                    Form.GrossMonthly.focus();
                    return false;
                }
                if (Form.salary_type.value == "")
                {
                    alert("Please select Salary Type");
                    Form.salary_type.focus();
                    return false;
                }
                if (Form.AccHolderName.value == "")
                {
                    alert("Please enter Account Holder Name");
                    Form.AccHolderName.focus();
                    return false;
                }
                if (Form.AccNumber.value == "")
                {
                    alert("Please enter Account Number");
                    Form.AccNumber.focus();
                    return false;
                }
                if (Form.account_type.value == "")
                {
                    alert("Please select Account Type");
                    Form.account_type.focus();
                    return false;
                }
                if (Form.BankName.value == "")
                {
                    alert("Please enter Bank Name");
                    Form.BankName.focus();
                    return false;
                }
                if (Form.Operatemonth.value == "")
                {
                    alert("Please enter Operating Month");
                    Form.Operatemonth.focus();
                    return false;
                }
				if (Form.Operateyear.value == "")
                {
                    alert("Please enter Operating Year");
                    Form.Operateyear.focus();
                    return false;
                }
                var AccPrimary = Form.PrimaryFlag;
                for (var i = 0; i < AccPrimary.length; i++) {
                    if (AccPrimary[i].checked)
                        break;
                }
                if (i == AccPrimary.length)
                {
                    alert("Please checked Account Primary Yes or No");
                    return false;
                }
              
				if (Form.doc_type.value == "")
                {
                    alert("Please enter Document Type");
                    Form.doc_type.focus();
                    return false;
                }
				if (Form.doc_name.value == "")
                {
                    alert("Please enter Document Name");
                    Form.doc_name.focus();
                    return false;
                }
				
                
            }
        </script>
    </head>
    <body>
        <?php include "middle-menu.php"; ?>
        <div style="clear:both;"></div>
        <div class="cc_inner_wrapper">
            <div style="clear:both;"></div>
            <div class="common-bread-crumb" style="margin:auto; width:74%; margin-top:70px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="#"  class="text12" style="color:#0080d6;"><u>Personal Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Personal Loan</span></div>
            <div style="clear:both; height:15px;"></div>
            <div style="width:995px;  margin:auto;">
                <div id="content"><form name="cibil_form" method="post" action="/apply_pl_consentincred_continue.php" target="_blank" enctype="multipart/form-data" onSubmit="return ckhcreditcard(document.cibil_form);">
                        <input type="hidden" name="requestid" id="requestid" value="<? echo $pl_requestid; ?>"/> 
                        <input type="hidden" name="Email" id="Email" value="<? echo $Email; ?>"/>
                        <input type="hidden" name="City" id="City" value="<? echo $City; ?>"/>
                        <input type="hidden" name="source" id="source" value="<? echo $source; ?>"/>
                        <input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $pl_bank_name; ?>"/>
                        <input type="hidden" name="Mobile_Number" id="Mobile_Number" value="<? echo $Mobile_Number; ?>"/>
                        <table align="center"  cellpadding="5" cellspacing="0"  width="100%">
                            <tr><td colspan="2"   bgcolor="#FFFFFF" class="heading_text" align="left">Fill in the below details to start your loan application process</td></tr>
                            <tr>
                                <td colspan="2" valign="middle" bgcolor="#FFFFFF" class="heading_text" height="40"> &nbsp;Enquiry Details</td></tr>
                            <tr>
                                <td class="sbi_text_c">Enquiry Amount:</td>
                                <td><input type="text" name="loan_amount" id="loan_amount" value="<? echo $loan_amount; ?>" class="bajaj-fin_input" /></td></tr>
                            <tr>
                                <td colspan="2"  class="heading_text" height="40"> &nbsp;Personal Details</td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Name:</td>
                                <td><input type="text" name="name" id="name" value="<? echo $name; ?>" class="bajaj-fin_input"/></td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">DOB:</td>
                                <td><input type="text" name="dob" id="dob" value="<? echo $DOB; ?>" class="bajaj-fin_input"/></td></tr>
                            <tr><td width="205" class="sbi_text_c">Gender:</td>
                                <td width="273" class="sbi_text_c"><input type="radio" name="gender" id="gender" value="<?
                                    if ($Gender == 1) {
                                        echo $Gender;
                                    }
                                    ?>" <?
									  if ($Gender == 1) {
										  echo "checked";
									  }
									  ?> />Male <input type="radio" name="gender" id="gender" value="<?
									  if ($Gender == 2) {
										  echo $Gender;
									  }
									  ?>" <?
									  if ($Gender == 2) {
										  echo "checked";
									  }
									  ?> />female</td></tr>
                            <tr>
                                <td colspan="2" valign="middle" class="heading_text" height="40"> &nbsp;Identification</td></tr>
                            <tr><td class="sbi_text_c" height="25">PAN No:</td><td><input type="text" name="panno" id="panno" maxlength="10" class="bajaj-fin_input" value="<? echo $Pancard; ?>"/></td></tr>
                            <tr>
                                <td class="sbi_text_c" >Residence Address <br />(With Landmark):</td>
                                <td ><textarea rows="3" cols="21" name="ResAddress" id="ResAddress" class="bajaj-fin_txtinput"><? echo $Residence_Address; ?></textarea></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Residence Pincode:</td>
                                <td><input type="text" name="Respincode" id="Respincode" class="bajaj-fin_input" maxlength="6" value="<? echo $Pincode; ?>"/></td></tr>
                            <tr>
                                <td colspan="2" valign="middle" class="heading_text"> &nbsp;Employer Details</td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Employer Name:</td>
                                <td><input type="text" name="company_name" id="company_name" value="<? echo $company_name; ?>" class="bajaj-fin_input"/></td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Designation:</td>
                                <td><input type="text" name="designation" id="designation" class="bajaj-fin_input" value="manager"/></td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">You are working here since ?</td>
                                <td><select name="joinmonth"><option value="">Month</option><?php
                                        for ($iM = 01; $iM <= 12; $iM++) {
                                            echo "<option value=" . $iM . ">" . date("M", strtotime("$iM/12/10")) . "</option>";
                                        }
                                        ?></select>&nbsp;<?php $startY = Date('Y') - 17; ?><select name="joinyear"><option value="">Year</option><?php
                                        $endY = Date('Y');
                                        for ($iY = $startY; $iY <= $endY; $iY++) {
                                            echo "<option value=" . $endY . ">" . $iY . "</option>";
                                        }
                                                                          ?></select></td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Office Address <br />(With Landmark):</td>
                                <td style="font-size:13px;"><textarea rows="3" cols="19" name="OfficeAddress" id="OfficeAddress" class="bajaj-fin_txtinput" ></textarea></td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Office City:</td>
                                <td><select name="OfficeCity" id="OfficeCity" class="bajaj-fin_txtselect" style=" font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" >
                            <?=plgetCityList($City)?>
                        </select></td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Office State</td>
                                <td>	
                                    <select name="office_state" class="bajaj-fin_txtselect">
                                        <option value=""> Please Select </option>
                                        <option value="1"> JAMMU & KASHMIR </option>
                                        <option value="2">HIMACHAL PRADESH </option>
                                        <option value="3">PUNJAB </option>
                                        <option value="4">CHANDIGARH </option>
                                        <option value="5">PUDUCHERRY </option>
                                        <option value="6">HARYANA </option>
                                        <option value="7">DELHI </option>
                                        <option value="8">RAJASTHAN </option>
                                        <option value="9"  selected>UTTAR PRADESH </option>
                                        <option value="10">BIHAR </option>
                                        <option value="11">SIKKIM </option>
                                        <option value="12">ARUNACHAL PRADESH </option>
                                        <option value="13">NAGALAND </option>
                                        <option value="14">MANIPUR </option>
                                        <option value="15">MIZORAM </option>
                                        <option value="16">TRIPURA </option>
                                        <option value="17">MEGHALAYA </option>
                                        <option value="18">ASSAM </option>
                                        <option value="19">WEST BENGAL </option>
                                        <option value="20">JHARKHAND </option>
                                        <option value="21">ORISSA </option>
                                        <option value="22">CHHATTISGARH </option>
                                        <option value="23">MADHYA PRADESH </option>
                                        <option value="24">GUJARAT </option>
                                        <option value="25">DAMAN & DIU </option>
                                        <option value="26">DADRA & NAGAR HAVELI </option>
                                        <option value="27">MAHARASHTRA </option>
                                        <option value="28">ANDHRA PRADESH </option>
                                        <option value="29">KARNATAKA </option>
                                        <option value="30">GOA </option>
                                        <option value="31">LAKSHADWEEP </option>
                                        <option value="32">KERALA </option>
                                        <option value="33">TAMIL NADU </option>
                                        <option value="34">UTTARAKHAND </option>
                                        <option value="35">ANDAMAN & NICOBAR ISLANDS </option>
                                        <option value="36">TELANGANA </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Office Pincode:</td>
                                <td><input type="text" name="OfficePincode" id="OfficePincode" class="bajaj-fin_input" maxlength="6" /></td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Gross Monthly Salary:</td>
                                <td><input type="text" name="GrossMonthly" id="GrossMonthly" value="<? echo round($salary); ?>" class="bajaj-fin_input"/></td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Salary Type:</td>
                                <td><select name="salary_type" class="bajaj-fin_txtselect">
                                        <option value="">Please Select</option>
                                        <option value="CASH">Cash</option>
                                        <option value="CHEQUE">Cheque</option>
                                        <option value="NEFT" selected>Bank Transfer</option>
                                    </select></tr>
                            <tr>
                                <td colspan="2" valign="middle" class="heading_text"> &nbsp;Account Details</td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Account Holder Name:</td>
                                <td><input type="text" name="AccHolderName" id="AccHolderName" class="bajaj-fin_input"/></td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Account Number:</td>
                                <td><input type="text" name="AccNumber" id="AccNumber" class="bajaj-fin_input"/></td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Account Type:</td>
                                <td>
                                    <select name="account_type" class="bajaj-fin_txtselect">
                                        <option value="">Please Select</option>
                                        <option value="SAVING" selected>Saving</option>
                                        <option value="CURRENT">Current</option>
                                        <option value="CC_OD">Cc/Od Account</option>
                                    </select></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Bank Name:</td>
                                <td>
                                    <select name="BankName" id="BankName" class="bajaj-fin_txtselect">
                                        <option value="">Select Bank Name</option>
                                        <?
                                        foreach($BankArray as $key => $value)
                                        {?>
                                         <option value="<? echo $key;?>"><? echo $value;?></option>   
                                       <? }
                                        ?>
                                        
                                    </select>
                                   </td></tr>
                            <tr>
                                <td class="sbi_text_c" height="25">Operating Since:</td>
                                <td>
                                   <select name="Operatemonth"><option value="">Month</option><?php
                                        for ($iM = 01; $iM <= 12; $iM++) {
                                            echo "<option value=" . $iM . ">" . date("M", strtotime("$iM/12/10")) . "</option>";
                                        }
                                        ?></select>&nbsp;<select name="Operateyear"><option value="">Year</option><?php
                                        $endY = Date('Y');
                                         for($y=1965;$y<=date("Y");$y++)
                                        {?>
                                         <option value="<? echo $y;?>"><? echo $y;?></option>   
                                       <? }
										?></select>
                                    </td></tr>
                            <tr><td width="205" class="sbi_text_c">Is this Account Primary? </td>
                                <td width="273" class="sbi_text_c"><input type="radio" name="PrimaryFlag" id="PrimaryFlag" value="1" />Yes <input type="radio" name="PrimaryFlag" id="PrimaryFlag2" value="2"/>No</td></tr>
                            <tr><td width="205" class="sbi_text_c">Last 3 months Bank Statement: </td>
                                <td colspan="2" align="left" valign="top"  style="color:#FF0000; font-size:10px;"> 
                                    <!--<form id="uploadform_4" method="post" enctype="multipart/form-data" action="uploadblue_4.php">
                                    <input type="hidden" name="RequestID" value="<?php echo $RequestID; ?>" />
                                    <input type="hidden" name="Doc_Name" value="<?php echo $Bank_Statement; ?>" />
                                    <input type="file" name="file" id="file" />&nbsp; &nbsp;<input type="submit" name="action" value="Upload" onClick="initUpload_4();" /> <span id="status_4" style="display:none">uploading...</span><iframe id="target_iframe_4" name="target_iframe_4" src="" style="width:0;height:0;border:0px"></iframe>
                                    </form>-->
                                    <input name="uploadFile" id="uploadFile" type="file" style="border:none;" class="filed" /><br />
                                    <label class="font_a" style="color:#F00; font-size:10px;">File size <=2 MB</label>
                                </td></tr>
							<tr>
                                <td class="sbi_text_c" height="25">KYC Document Type:</td>
                                <td>
                                    <select name="doc_type" id="doc_type" class="bajaj-fin_txtselect">
                                        <option value="">Please Select</option>
										<option value="PL_IN_ADR_PRF">Address Proof</option>
										<option value="PL_IN_ID_PRF">ID Proof</option>
                                       </select>
                                   </td></tr>
								<tr>
                                <td class="sbi_text_c" height="25">Choose which Document:</td>
                                <td>
                                    <select name="doc_name" id="doc_name" class="bajaj-fin_txtselect">
                                       </select>
                                   </td></tr>
								<tr><td width="205" class="sbi_text_c">Upload Selected KYC document: </td>
                                <td colspan="2" align="left" valign="top"  style="color:#FF0000; font-size:10px;"> 
                                   <input name="uploadFile_another" id="uploadFile_another" type="file" style="border:none;" class="filed" /><br />
                                    <label class="font_a" style="color:#F00; font-size:10px;">File size <=2 MB</label>
                                </td></tr>								   
                            <tr>
                                <td colspan="2" align="center"><input type="submit" style="border: 0px none ; background-image: url(new-images/submit_details.jpg); width: 153px; height: 47px; margin-bottom: 0px;" value=""/></td></tr>
                                <!--<tr><td colspan="2" class="sbi_text_c" style="color:#333333; font-weight:normal;"><b>Disclaimer</b> : By submitting the above details you are authorizing Bajaj Finserv Lending to run a CIBIL check on your profile
                            </td></tr>-->
                        </table></form>    
                </div>    
                <div id="sidebar">
                    <div class="widget">
                        <table width="100%" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="58%" height="40" class="heading_text1" style="font-size:18px;"><span class="heading_text_b">Why Incred?</span></td>
                                <td width="42%" align="right" class="heading_text1" style="font-size:18px;">
								<img src="/new-images/thumb/incred.png"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="color:#999; font-family:Verdana, Geneva, sans-serif; font-size:12px;">&nbsp;</td>
                            </tr>
                        </table>
                        <div class="sbi_text_bullet">
                    <ul>
                  <li>Rate of Interest : 11% -24%</li><br>
						<li>Loan Size :INR 50,000 -INR 20 Lakhs</li><br>
						<li>Maximum Tenure: 5 Years</li><br>
                  </ul>  
                  </div>
                    </div>
                </div>
            </div>

            <div style="clear:both;"></div>
            <!--partners-->
<?php
$REMOVE_ADD = 1;
include("footer_sub_menu.php");
?>
 <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script> 
 <script>
	function displayVals() {
	 var singleValues = $( "#doc_type" ).val();
	  if(singleValues=="PL_IN_ID_PRF")
		{
		  var response="<option value=''>Please Select</option><option value='PL_PAN_CRD'>Pan Card</option><option value='PL_PASSPRT'>Passport</option><option value='PL_UDID'>Aadhar Unique Id</option><option value='PL_VOTR_ID'>Voter Identity Card</option>";
		  $('#doc_name').html(response);
	  }
	  else if(singleValues=="PL_IN_ADR_PRF")
		{
		   var response="<option value=''>Please Select</option><option value='PL_AADHAAR'>Aadhar Unique Id</option><option value='PL_BBLL_BL'>Post Paid Mobile Bill</option><option value='PL_BNK_STT'>Bank Account Statement</option><option value='PL_ELCT_BL'>Electricity Bill</option><option value='PL_GAS_CON'>Gas Bill</option><option value='PL_PSPRT'>Passport</option><option value='PL_RNT_AGR'>Rent Agreement</option><option value='PL_VTR_CAR'>Voter Identity Card</option><option value='PL_WTR_BL'>Water Bill</option>";
		  $('#doc_name').html(response);
		}
		else
		{	response="<option value=''>Please Select</option>";
			$('#doc_name').html(response);
		}
	}
	 
	$( "#doc_type" ).change( displayVals );
	displayVals();
	</script>

    </body>
</html>