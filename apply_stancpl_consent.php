<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';

$urltype = $_REQUEST["urltype"];
if ($urltype == "httpsurl") {
    require 'scripts/functionshttps.php';
    $urltypeval = "httpsurl";
    $ajaxurl = '';
} else {
    require 'scripts/functions.php';
    $urltypeval = "";
    $ajaxurl = 'http://www.deal4loans.com/ajax-list-plcompanies.php';
}

$pl_requestid = $_REQUEST['pl_requestid'];
$pl_bank_name = $_REQUEST['pl_bank_name'];
$aiplead = $_REQUEST['aiplead'];

if ($pl_requestid > 0) {
    $getpldetails = "select Pincode,Pancard,Employment_Status,Mobile_Number,Email,City_Other,City,Company_Name,Name,Net_Salary,DOB, Company_Type,Loan_Amount,Primary_Acc,Total_Experience,Residence_Address,Years_In_Company From Req_Loan_Personal Where (RequestID='" . $pl_requestid . "')";
    list($alreadyExist, $plrow) = MainselectfuncNew($getpldetails, $array = array());
    $myrowcontr = count($plrow) - 1;
    $Loan_Amount = round($plrow[$myrowcontr]['Loan_Amount']);
    $Net_Salary = round($plrow[$myrowcontr]['Net_Salary']);
    $City = $plrow[$myrowcontr]['City'];
    $City_Other = $plrow[$myrowcontr]['City_Other'];
    $Name = $plrow[$myrowcontr]['Name'];
    list($first, $middle, $last) = explode(" ", $Name);
    $lastname=$middle." ".$last;
    $DOB = $plrow[$myrowcontr]['DOB'];
    list($year, $month, $day) = explode("-", $DOB);
    $Mobile_Number = $plrow[$myrowcontr]['Mobile_Number'];
    $Email = $plrow[$myrowcontr]['Email'];
    $Gender = $plrow[$myrowcontr]['Gender'];
    $Employment_Status = $plrow[$myrowcontr]['Employment_Status'];
    $Pancard = $plrow[$myrowcontr]['Pancard'];
    $Company_Name = $plrow[$myrowcontr]['Company_Name'];
    $Residence_Address = $plrow[$myrowcontr]['Residence_Address'];
    $Total_Experience = $plrow[$myrowcontr]['Total_Experience'];
    $Years_In_Company = $plrow[$myrowcontr]['Years_In_Company'];
    $Pincode = $plrow[$myrowcontr]['Pincode'];

    if ($City == "Others") {
        if (strlen($Other_City) > 0) {
            $strCity = $Other_City;
        } else {
            $strCity = $City;
        }
    } else {
        $strCity = $City;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Standard Chartered Bank</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="css/scb-styles.css" type="text/css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>
		<script type="text/javascript" src="ajax.js"></script>
        <script type="text/javascript">
            function scbkpersonalloan(Form)
            {
                var btn2;
                var btn3;
                var myOption;
                var i;
                var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
                var dt, mdate;
                dt = new Date();
                var alpha = /^[a-zA-Z\ ]*$/;
                var alphanum = /^[a-zA-Z0-9]*$/;
                var num = /^[0-9]*$/;
                var space = /^[\ ]*$/;
                var iChars = "/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

                if (Form.FirstName.value == "")
                {
                    document.getElementById('FirstNameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Your first name</span>";
                    Form.FirstName.focus();
                    return false;
                }
                if (Form.LastName.value == "")
                {
                    document.getElementById('LastNameVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Your last name</span>";
                    Form.LastName.focus();
                    return false;
                }

                if (Form.day.selectedIndex == 0)
                {
                    document.getElementById('dayVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select day!</span>";
                    Form.day.focus();
                    return false;
                }
                if (Form.month.selectedIndex == 0)
                {
                    document.getElementById('monthVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Month!</span>";
                    Form.month.focus();
                    return false;
                }
                if (Form.year.selectedIndex == 0)
                {
                    document.getElementById('yearVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select year!</span>";
                    Form.year.focus();
                    return false;
                }
                if (Form.gender.value == "")
                {
                    alert("Select Gender!");
                    return false;
                }
                if (Form.Qualification.selectedIndex == 0)
                {
                    document.getElementById('QualificationVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Qualification!</span>";
                    Form.Qualification.focus();
                    return false;
                }
                if (Form.PAN.value == "")
                {
                    document.getElementById('PANVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Your PAN Number</span>";
                    Form.PAN.focus();
                    return false;
                }
                var Obj = document.getElementById("Pancard");
                if (Obj.value != "") {
                    ObjVal = Obj.value;
                    var panPat = /^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/;
                    if (ObjVal.search(panPat) == -1) {
                        document.getElementById('PANVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Valid PAN Number</span>";
                        Form.PAN.focus();
                        return false;
                    }
                }
                if (Form.ResType.selectedIndex == 0)
                {
                    document.getElementById('ResTypeVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Residential Type!</span>";
                    Form.ResType.focus();
                    return false;
                }
                if (Form.Email.value == "")
                {
                    document.getElementById('EmailVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter  Email Address!</span>";
                    Form.Email.focus();
                    return false;
                }
/*
                var str = Form.Email.value
                var aa = str.indexOf("@")
                var bb = str.indexOf(".")
                var cc = str.charAt(aa)

                if (aa == -1)
                {
                    document.getElementById('EmailVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Valid Email Address!</span>";
                    Form.Email.focus();
                    return false;
                } else if (bb == -1)
                {
                    document.getElementById('EmailVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Enter Valid Email Address!</span>";
                    Form.Email.focus();
                    return false;
                }
*/
                if (Form.ResAddress.value == "")
                {
                    document.getElementById('ResAddressVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Residence Address</span>";
                    Form.ResAddress.focus();
                    return false;
                }
                if (Form.Landmark.value == "")
                {
                    document.getElementById('LandmarkVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Landmark</span>";
                    Form.Landmark.focus();
                    return false;
                }
                if (Form.ResPin.value == "")
                {
                    document.getElementById('ResPinVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Residential PIN</span>";
                    Form.ResPin.focus();
                    return false;
                }
                if (Form.ResCity.selectedIndex == 0)
                {
                    document.getElementById('ResCityVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Residential City</span>";
                    Form.ResCity.focus();
                    return false;
                }
             /*   if (Form.Mobile.value == '')
                {
                    //alert("Kindly fill in your Mobile Number!");
                    document.getElementById('MobileVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Mobile Number</span>";
                    Form.Mobile.focus();
                    return false;
                } else if (isNaN(Form.Mobile.value) || Form.Mobile.value.indexOf(" ") != -1)
                {

                    document.getElementById('MobileVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter Numeric Value</span>";
                    Form.Mobile.focus();
                    return false;
                } else if (Form.Mobile.value.length < 10)
                {
                    //		  alert("Please Enter 10 Digits"); 
                    document.getElementById('MobileVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Enter 10 Digits</span>";
                    Form.Mobile.focus();
                    return false;
                } else if ((Form.Mobile.value.charAt(0) != "9") && (Form.Mobile.value.charAt(0) != "8") && (Form.Mobile.value.charAt(0) != "7"))
                {
                    alert("The number should start only with 9 or 8 or 7");
                    document.getElementById('MobileVal').innerHTML = "<span class='hintanchor' style='color:#CC0000;'>Start with 9 or 8 or 7</span>";
                    Form.Mobile.focus();
                    return false;
                }
*/
                if (Form.EmpType.selectedIndex == 0)
                {
                    document.getElementById('EmpTypeVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Employment Type</span>";
                    Form.EmpType.focus();
                    return false;
                }
                if (Form.Organization.value == "")
                {
                    document.getElementById('OrganizationVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Company Name</span>";
                    Form.Organization.focus();
                    return false;
                }
                if (Form.TypeOfOrg.selectedIndex == 0)
                {
                    document.getElementById('TypeOfOrgVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Company Type</span>";
                    Form.TypeOfOrg.focus();
                    return false;
                }
                if (Form.Industry.selectedIndex == 0)
                {
                    document.getElementById('IndustryVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Industry</span>";
                    Form.Industry.focus();
                    return false;
                }
                if (Form.SalaryBank.selectedIndex == 0)
                {
                    document.getElementById('SalaryBankVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Salary Bank</span>";
                    Form.SalaryBank.focus();
                    return false;
                }
                if (Form.OffAddress.value == "")
                {
                    document.getElementById('OffAddressVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter OffAddress</span>";
                    Form.OffAddress.focus();
                    return false;
                }
                if (Form.OffPIN.value == "")
                {
                    document.getElementById('OffPINVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Office PIN</span>";
                    Form.OffPIN.focus();
                    return false;
                }
                if (Form.OffCity.selectedIndex == 0)
                {
                    document.getElementById('OffCityVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Select Office City</span>";
                    Form.OffCity.focus();
                    return false;
                }

                if (Form.OffPhone.value == "")
                {
                    document.getElementById('OffPhoneVal').innerHTML = "<span  class='hintanchor' style='color:#CC0000;'>Please Enter Office Phone</span>";
                    Form.OffPhone.focus();
                    return false;
                }
            }
            function validateDiv(div)
            {
                var ni1 = document.getElementById(div);
                ni1.innerHTML = '';
            }
            function numOnly(evt)
            {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 46 || charCode > 57))
                    return false;

                return true;
            }
            function isCharsetKey(evt)
            {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if ((charCode > 33) && (charCode < 58))
                    return false;
                return true;
            }
        </script>
		<style type="text/css">
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:300px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
	form{
		display:inline;
	}
	</style>
    </head>
    <body>
        <header class="scb-header">
            <div class="scb-container">
                <div class="logo-scb"><img src="images/scb-logo-lp.jpg"  alt="Standard Chartered Bank"></div>
                <div class="logo-d4l"><img src="images/d4l.jpg" alt="Powered by Deal4loans"></div>
                <div class="clearfix"></div>
            </div>
        </header>
        <section>
            <div class="scb-container pd-top-25">
                <div class="scb-col-left">
                    <form  name="plscb_form" action="/apply_stancpl_continue.php" method="POST" onSubmit="return scbkpersonalloan(document.plscb_form);">
						<input name="Email" type="hidden" id="Email" value="<?php echo $Email; ?>">
						<input name="urltype" type="hidden" id="urltype" value="<?php echo $urltype; ?>">
						<input name="GMI" type="hidden" id="GMI" value="<?php echo $Net_Salary; ?>">
						<input name="LoanAmount" type="hidden" id="LoanAmount" value="<?php echo $Loan_Amount; ?>">
						<input name="Mobile_Number" type="hidden" id="Mobile_Number" value="<?php echo $Mobile_Number; ?>">
						<input name="Total_Experience" type="hidden" id="Total_Experience" value="<?php echo $Total_Experience; ?>">
						<input name="Years_In_Company" type="hidden" id="Years_In_Company" value="<?php echo $Years_In_Company; ?>">
						<input name="pl_bank_name" type="hidden" id="pl_bank_name" value="<?php echo $pl_bank_name; ?>">
						 <input type="hidden" name="pl_requestid" value="<? echo $pl_requestid; ?>" id="pl_requestid">
						<input type="hidden" name="pl_bank_name" id="pl_bank_name" value="<? echo $pl_bank_name; ?>">
                                                <input type="hidden" name="aiplead" id="aiplead" value="<? echo $aiplead; ?>">
						
						  <div class="scb-form">
                            <div class="scb-label-wrapper">First Name</div>
                            <div class="scb-input-wrapper"><input name="FirstName" type="text" id="FirstName" onkeydown="validateDiv('FirstNameVal')" onkeypress="return isCharsetKey(event)" value="<?php echo $first; ?>"><div id="FirstNameVal"></div></div>
                            <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Last Name</div>
                            <div class="scb-input-wrapper"><input name="LastName" type="text" id="LastName" onkeydown="validateDiv('LastNameVal')" onkeypress="return isCharsetKey(event)" value="<?php echo $lastname; ?>"><div id="LastNameVal"></div></div>
                            <div class="clearfix"></div>
                            <div class="scb-label-wrapper">DOB (As per PAN Card)</div>
                            <div class="scb-input-wrapper"><select name="day" class="scb-dd" onchange="validateDiv('dayVal');">
                                    <option>Select day</option>
                                    <?php for ($d = 1; $d <= 31; $d++) { ?>
                                        <option value="<?php echo $d; ?>" <?php if($day==$d) {echo "selected";} ?>><?php echo $d; ?></option>
                                    <?php } ?>
                                </select>
                                <select name="month" class="scb-dd" onchange="validateDiv('monthVal');">
                                    <option>Select Month</option>
                                    <?php for ($m = 1; $m <= 12; $m++) { ?>
                                        <option value="<?php echo $m; ?>" <?php if($month==$m) {echo "selected";} ?>><?php echo $m; ?></option>
                                    <?php } ?>
                                </select>
                                <select name="year" class="scb-dd" onchange="validateDiv('yearVal');">
                                    <option>Select Year</option>
                                    <?php
                                    $curYear = date("Y");
                                    $Date17Before = $curYear - 18;
                                    $Date65Before = $curYear - 62;
                                    for ($y = $Date65Before; $y <= $Date17Before; $y++) {
                                        ?>
                                        <option value="<?php echo $y; ?>" <?php if($year==$y) {echo "selected";} ?>><?php echo $y; ?></option>
                                    <?php } ?>
                                </select> 
                                <div id="dayVal" class="alert_msg"></div>
                                <div id="monthVal" class="alert_msg"></div>
                                <div id="yearVal" class="alert_msg"></div>
                            </div>
                            <div class="scb-label-wrapper">Gender</div>
                            <div class="scb-input-wrapper"><div class="radio-field"><label class="text-left color-blue radio-left-align landing_check_show"><input type="radio" name="gender" id="radio-one" class="required" data-refid="personalDetails" value="1" aria-required="true" <?php if($Gender==1) {echo "checked"; } ?>><i></i> <span> Male </span></label><label class="text-left color-blue radio-left-align landing_check_show"><input type="radio" name="gender" class="required" data-refid="personalDetails" value="0" aria-required="true" <?php if($Gender==2) {echo "checked"; } ?>><i></i> <span> Female </span></label></div></div>
                            <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Qualification</div>
                            <div class="scb-input-wrapper">
                                <select name="Qualification" onchange="validateDiv('QualificationVal');"><option value="0">Select</option>
                                    <option value="1">Matric or below</option>
                                    <option value="2">Higher Secondary</option>
                                    <option value="3">Graduate</option>
                                    <option value="4">Post Graduate & Above</option>
                                </select>
                                <div id="QualificationVal" class="alert_msg"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="scb-label-wrapper">PAN</div>
                            <div class="scb-input-wrapper"><input name="PAN" id="Pancard" type="text" onkeydown="validateDiv('PANVal')" value="<?php echo $Pancard; ?>"><div id="PANVal" class="alert_msg"></div></div>
                            <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Residential Type</div>
                            <div class="scb-input-wrapper"><select name="ResType" onchange="validateDiv('ResTypeVal');">
                                    <option value="0">Select</option>
                                    <option value="1">Self Owned</option>
                                    <option value="2">Parental</option>
                                    <option value="3">Rental</option>
                                    <option value="4">Paying Guest</option>
                                    <option value="5">Working Men/ Women Hostel</option>
                                    <option value="6">Rented with Family</option>
                                    <option value="7">Rented with Friends</option>
                                    <option value="8">Rented - Bachelor Staying alone</option>
                                    <option value="9">Hostel/Guest House/Hotel</option>
                                    <option value="10">Company Provided - Staying Alone</option>
                                    <option value="11">Company Provided - Staying with family</option>
                                </select><div id="ResTypeVal" class="alert_msg"></div></div>
                            <div class="clearfix"></div>
                              <div class="scb-label-wrapper">Residence Address</div>
                            <div class="scb-input-wrapper"><input name="ResAddress" type="text" onkeydown="validateDiv('ResAddressVal')" value="<?php echo $Residence_Address; ?>">
                                <div id="ResAddressVal" class="alert_msg"></div>
                            </div>
							 <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Land Mark</div>
                            <div class="scb-input-wrapper"><input name="Landmark" type="text" maxlength="38" onkeydown="validateDiv('LandmarkVal')">
                            <div id="LandmarkVal" class="alert_msg"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Residential PIN</div>
                            <div class="scb-input-wrapper"><input type="text" name="ResPin"  maxlength="6" onkeydown="validateDiv('ResPinVal')" onkeypress="return numOnly(event)" value="<?php echo $Pincode; ?>">
                                <div id="ResPinVal" class="alert_msg"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Residential City</div>
                            <div class="scb-input-wrapper"><select name="ResCity" onchange="validateDiv('ResCityVal');">
                  <option value="">Select Residence City</option>
                  <option value="22" <?php if($strCity=="Ahmedabad") { echo "Selected";} ?>>Ahmedabad</option>
                                    <option value="707" <?php if($strCity=="Baroda") { echo "Selected";} ?>>Baroda</option>
                                    <option value="19" <?php if($strCity=="Bangalore") { echo "Selected";} ?>>Bengaluru</option>
                                    <option value="623" <?php if($strCity=="Bhopal") { echo "Selected";} ?>>Bhopal</option>
                                    <option value="9" <?php if($strCity=="Chandigarh") { echo "Selected";} ?>>Chandigarh</option>
                                    <option value="21" <?php if($strCity=="Chennai") { echo "Selected";} ?>>Chennai</option>
                                    <option value="241" <?php if($strCity=="Cochin") { echo "Selected";} ?>>Cochin</option>
                                    <option value="69" <?php if($strCity=="Coimbatore") { echo "Selected";} ?>>Coimbatore</option>
                                    <option value="87" <?php if($strCity=="Gaziabad") { echo "Selected";} ?>>Gaziabad</option>
                                    <option value="704" <?php if($strCity=="Greater Noida") { echo "Selected";} ?>>Greater Noida</option>
                                    <option value="7" <?php if($strCity=="Gurgaon") { echo "Selected";} ?>>Gurgaon</option>
                                    <option value="15" <?php if($strCity=="Hyderabad") { echo "Selected";} ?>>Hyderabad</option>
                                    <option value="106" <?php if($strCity=="Indore") { echo "Selected";} ?>>Indore</option>
                                    <option value="100" <?php if($strCity=="Jaipur") { echo "Selected";} ?>>Jaipur</option>
                                    <option value="64" <?php if($strCity=="Kolkata") { echo "Selected";} ?>>Kolkata</option>
                                    <option value="25" <?php if($strCity=="Mumbai") { echo "Selected";} ?>>Mumbai</option>
                                    <option value="135" <?php if($strCity=="Nagpur") { echo "Selected";} ?>>Nagpur</option>
                                    <option value="163" <?php if($strCity=="Navi Mumbai") { echo "Selected";} ?>>Navi mumbai</option>
                                    <option value="318" <?php if($strCity=="Delhi") { echo "Selected";} ?>>Delhi</option>
                                    <option value="78" <?php if($strCity=="Noida") { echo "Selected";} ?>>Noida</option>
                                    <option value="26" <?php if($strCity=="Pune") { echo "Selected";} ?>>Pune</option>
                                    <option value="1035" <?php if($strCity=="Rajkot") { echo "Selected";} ?>>Rajkot</option>
                                    <option value="94" <?php if($strCity=="Secunderabad") { echo "Selected";} ?>>Secunderabad</option>
                                    <option value="190" <?php if($strCity=="Surat") { echo "Selected";} ?>>Surat</option>
                                    <option value="640" <?php if($strCity=="Thane") { echo "Selected";} ?>>Thane</option>
                                </select>
                                <div id="ResCityVal" class="alert_msg"></div>
                            </div>
                           <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Employment Type</div>
                            <div class="scb-input-wrapper">
                                <select name="EmpType" onchange="validateDiv('EmpTypeVal');">
                                    <option value="0">Select</option>
                                    <option value="1" <?php if($Employment_Status==1) {echo "Selected";} ?>>Salaried</option>
                                    <option value="2" <?php if($Employment_Status==0) {echo "Selected";} ?>>Self Employed Business</option>
                                    <option value="3">Self Employed Professional</option>
                                    <option value="4">Student</option>
                                    <option value="5">Retired</option>
                                    <option value="6">Homemaker</option>
                                </select>
                                <div id="EmpTypeVal" class="alert_msg"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Company Name</div>
                            <div class="scb-input-wrapper"><input name="Organization" type="text" onkeydown="validateDiv('OrganizationVal')" value="<?php echo $Company_Name; ?>" onkeyup="ajax_showOptions(this, 'getCountriesByLetters', event, '<?php echo $ajaxurl; ?>')">
                                <div id="OrganizationVal" class="alert_msg"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Company Type</div>
                            <div class="scb-input-wrapper"><select name="TypeOfOrg" onchange="validateDiv('TypeOfOrgVal');">
                                    <option value="0">Select</option>
                                    <option value="1">Proprietor</option>
                                    <option value="2">Partner applying as as individual</option>
                                    <option value="3">Director applying as as individual</option>
                                    <option value="4">Partnership Firm</option>
                                    <option value="5">Employee of company</option>
                                </select>
                                <div id="TypeOfOrgVal" class="alert_msg"></div>
                            </div>
							<div class="clearfix"></div>
                            <div class="scb-label-wrapper">Industry</div>
                            <div class="scb-input-wrapper"><select name="Industry" onchange="validateDiv('IndustryVal');">
                                    <option value="0">Select</option>
                                    <option value="1">ACCOUNTANCY</option>
									<option value="3">ADVERTISING</option>
									<option value="9">AIRLINES</option>
									<option value="11">BPO</option>
									<option value="12">AUTOMOBILES</option>
									<option value="13">BUREAU</option>
									<option value="16">BANKING</option>
									<option value="17">INSURANCE</option>
									<option value="18">CONSUMER GOODS</option>
									<option value="24">ENTERTAINMENT</option>
									<option value="26">COLLEGE INSTITUTE</option>
									<option value="28">HOSPITALS</option>
									<option value="29">NGO</option>
									<option value="31">PETROLEUM</option>
									<option value="32">PHARMA</option>
									<option value="33">OTHERS</option>
									<option value="39">RAILWAYS</option>
									<option value="40">SCHOOLS</option>
									<option value="41">REAL ESTATE</option>
									<option value="40">SOFTWARE / IT</option>
									<option value="42">ENGINEERING/INFRASTRUCTURE</option>
									<option value="43">TELECOM</option>
									<option value="44">TRADING</option>
									<option value="46">EXPORT/ IMPORT</option>
									<option value="47">TRANSPORTATION</option>
									<option value="55">HOTEL</option>
									<option value="56">MANUFACTURING</option>
									<option value="57">MINISTRIES</option>
									<option value="67">POLICE</option>
									<option value="70">POST</option>
									<option value="74">POWER</option>
									<option value="78">SHARE / BROKERAGE</option>
									<option value="90">TRAVEL</option>
									<option value="92">ECOMMERCE</option>
                                </select>
                                <div id="IndustryVal" class="alert_msg"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Salary Bank</div>
                            <div class="scb-input-wrapper"><select name="SalaryBank" onchange="validateDiv('SalaryBankVal');">
									<option value="0">Select</option>
                                    <option value="10">Abhyudaya Co-op. Bank Ltd.</option>
                                    <option value="20">ACE Co-Operative Bank Ltd.</option>
                                    <option value="30">Allahabad Bank</option>
                                    <option value="40">Amanath Co-op. Bank Ltd.</option>
                                    <option value="50">American Express Banking Corporation</option>
                                    <option value="60">Andhra Bank</option>
                                    <option value="70">Apna Sahakari Bank Ltd.</option>
                                    <option value="80">Axis Bank</option>
                                    <option value="90">Bank of America N.A.</option>
                                    <option value="100">Bank of Baroda</option>
                                    <option value="110">Bank of India</option>
                                    <option value="120">Bank of Maharashtra</option>
                                    <option value="130">Barclays Bank</option>
                                    <option value="140">Canara Bank</option>
                                    <option value="150">Capital Local Area Bank Ltd.</option>
                                    <option value="160">Central Bank of India</option>
                                    <option value="170">Citibank N.A.</option>
                                    <option value="180">City Union Bank Ltd.</option>
                                    <option value="190">Coastal Local Area Bank Ltd.</option>
                                    <option value="200">Corporation Bank</option>
                                    <option value="210">Dena Bank</option>
                                    <option value="220">Deutsche Bank AG</option>
                                    <option value="230">Development Credit Bank Ltd.</option>
                                    <option value="240">Dhanlaxmi Bank Ltd.</option>
                                    <option value="250">HDFC Bank</option>
                                    <option value="260">HSBC Bank</option>
                                    <option value="270">ICICI Bank</option>
                                    <option value="280">IDBI Bank Ltd.</option>
                                    <option value="290">Indian Bank</option>
                                    <option value="300">Indian Overseas Bank</option>
                                    <option value="310">IndusInd Bank Ltd.</option>
                                    <option value="320">ING Vysya Bank Ltd.</option>
                                    <option value="330">Jammu &amp; Kashmir Bank Ltd.</option>
                                    <option value="340">Karnataka Bank Ltd.</option>
                                    <option value="350">Karur Vysya Bank Ltd.</option>
                                    <option value="360">Kotak Mahindra Bank Ltd.</option>
                                    <option value="370">Krishna Bhima Samruddhi Local Area Bank Ltd.</option>
                                    <option value="380">New India Co-op. Bank Ltd.</option>
                                    <option value="390">Oriental Bank of Commerce</option>
                                    <option value="400">Punjab & Maharashtra Co-op. Bank Ltd.</option>
                                    <option value="410">Punjab & Sind Bank</option>
                                    <option value="420">Punjab National Bank</option>
                                    <option value="430">Royal Bank of Scotland</option>
                                    <option value="440">SBI Commercial and International</option>
                                    <option value="450">South Indian Bank Ltd.</option>
                                    <option value="460">Standard Chartered Bank</option>
                                    <option value="470">State Bank of Bikaner & Jaipur</option>
                                    <option value="480">State Bank of India</option>
                                    <option value="490">State Bank of Mysore</option>
                                    <option value="500">State Bank of Patiala</option>
                                    <option value="510">State Bank of Travancore</option>
                                    <option value="520">Syndicate Bank</option>
                                    <option value="530">Tamilnad Mercantile Bank Ltd.</option>
                                    <option value="540">The Bank of Rajasthan Ltd.</option>
                                    <option value="550">The Catholic Syrian Bank Ltd.</option>
                                    <option value="560">The Federal Bank Ltd.</option>
                                    <option value="570">The Lakshmi Vilas Bank Ltd.</option>
                                    <option value="580">The Nainital Bank Ltd.</option>
                                    <option value="590">The Ratnakar Bank Ltd.</option>
                                    <option value="600">The Saraswat Co-op. Bank Ltd.</option>
                                    <option value="610">UCO Bank</option>
                                    <option value="620">Union Bank of India</option>
                                    <option value="630">United Bank of India</option>
                                    <option value="640">Vijaya Bank</option>
                                    <option value="650">Yes Bank</option>
                                    <option value="999">Others</option>
                                </select> <div id="SalaryBankVal" class="alert_msg"></div></div>
                            <div class="clearfix"></div>
                              <div class="scb-label-wrapper">Office Address</div>
                            <div class="scb-input-wrapper"><input name="OffAddress" type="text" onkeydown="validateDiv('OffAddressVal')" >
                                <div id="OffAddressVal" class="alert_msg"></div>
                            </div>
							 <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Office PIN</div>
                            <div class="scb-input-wrapper"><input name="OffPIN" type="text" maxlength="6" onkeypress="return numOnly(event)" onkeydown="validateDiv('OffPINVal')" ><div id="OffPINVal" class="alert_msg"></div></div>
                            <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Office City</div>
                            <div class="scb-input-wrapper"><select name="OffCity" onchange="validateDiv('OffCityVal');">
                                    <option value="0">Select</option>
                                    <option value="22" <?php if($strCity=="Ahmedabad") { echo "Selected";} ?>>Ahmedabad</option>
                                    <option value="707" <?php if($strCity=="Baroda") { echo "Selected";} ?>>Baroda</option>
                                    <option value="19" <?php if($strCity=="Bangalore") { echo "Selected";} ?>>Bengaluru</option>
                                    <option value="623" <?php if($strCity=="Bhopal") { echo "Selected";} ?>>Bhopal</option>
                                    <option value="9" <?php if($strCity=="Chandigarh") { echo "Selected";} ?>>Chandigarh</option>
                                    <option value="21" <?php if($strCity=="Chennai") { echo "Selected";} ?>>Chennai</option>
                                    <option value="241" <?php if($strCity=="Cochin") { echo "Selected";} ?>>Cochin</option>
                                    <option value="69" <?php if($strCity=="Coimbatore") { echo "Selected";} ?>>Coimbatore</option>
                                    <option value="87" <?php if($strCity=="Gaziabad") { echo "Selected";} ?>>Gaziabad</option>
                                    <option value="704" <?php if($strCity=="Greater Noida") { echo "Selected";} ?>>Greater Noida</option>
                                    <option value="7" <?php if($strCity=="Gurgaon") { echo "Selected";} ?>>Gurgaon</option>
                                    <option value="15" <?php if($strCity=="Hyderabad") { echo "Selected";} ?>>Hyderabad</option>
                                    <option value="106" <?php if($strCity=="Indore") { echo "Selected";} ?>>Indore</option>
                                    <option value="100" <?php if($strCity=="Jaipur") { echo "Selected";} ?>>Jaipur</option>
                                    <option value="64" <?php if($strCity=="Kolkata") { echo "Selected";} ?>>Kolkata</option>
                                    <option value="25" <?php if($strCity=="Mumbai") { echo "Selected";} ?>>Mumbai</option>
                                    <option value="135" <?php if($strCity=="Nagpur") { echo "Selected";} ?>>Nagpur</option>
                                    <option value="163" <?php if($strCity=="Navi Mumbai") { echo "Selected";} ?>>Navi mumbai</option>
                                    <option value="318" <?php if($strCity=="Delhi") { echo "Selected";} ?>>Delhi</option>
                                    <option value="78" <?php if($strCity=="Noida") { echo "Selected";} ?>>Noida</option>
                                    <option value="26" <?php if($strCity=="Pune") { echo "Selected";} ?>>Pune</option>
                                    <option value="1035" <?php if($strCity=="Rajkot") { echo "Selected";} ?>>Rajkot</option>
                                    <option value="94" <?php if($strCity=="Secunderabad") { echo "Selected";} ?>>Secunderabad</option>
                                    <option value="190" <?php if($strCity=="Surat") { echo "Selected";} ?>>Surat</option>
                                    <option value="640" <?php if($strCity=="Thane") { echo "Selected";} ?>>Thane</option>
                                    <option value="623">Others</option>
                                </select>
                                <div id="OffCityVal" class="alert_msg"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="scb-label-wrapper">Office Phone (without Std Code)</div>
                            <div class="scb-input-wrapper"><input name="OffPhone" type="text" maxlength="8" onkeydown="validateDiv('OffPhoneVal')"onkeypress="return numOnly(event)"><div id="OffPhoneVal" class="alert_msg"></div></div>
                            <div class="clearfix"></div>
                            <div class="text-center"><input type="submit" value="Get Quote" style="padding:5px; background:#0a71d9; color:#FFF; text-align:center; margin:auto; width:217px; border:none; height:57px;"></div>
                        </div>
                    </form>
                </div>
                <div class="scb-col-right">
                    <h2>Features</h2>
                    <h3>Affordable Financing</h3>
                    <p>SCB provide a variety of loans to both salaried and self- employed individuals.</p>
                    <h3>High Loan Amounts</h3>
                    <p>SCB offer loans up to Rs. 30 laks for salaried employees, and up to Rs. 10 lakhs for entrepreneurs.</p>
                    <h3>Low Interest Rates</h3>
                    <p>Standard Chartered offers competitive interest rates on personal loan.</p>
                    <h3>Unsecured loans</h3>
                    <p>You can take out a Personal Loan without the need for security, collateral or guarantors.</p>
                    <h3>Here are some of the other features of the personal loan you can avail of:</h3>
                    <p>
                    <ul>
                        <li>Repayment options vary from ECS, PDCs or Account Debit.</li>
                        <li>Easy documentation and quick processing</li>
                        <li>Existing Standard Chartered Personal Loans can be topped up 
                            with ease</li>
                    </ul>
                    </p>
                </div>
            </div>
        </section>
    </body>
</html>