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
    $ajaxurl = 'http://www.deal4loans.com/ajax-list-plicicicompanies.php';
}

$pl_requestid = $_REQUEST['pl_requestid'];
$pl_bank_name = $_REQUEST['pl_bank_name'];

if ($pl_requestid > 0) {
    $getpldetails = "select Employment_Status,Mobile_Number,Email,City_Other,City,Company_Name,Name,Net_Salary,DOB,PL_EMI_Amt, Primary_Acc,identification_proof,Company_Type,Loan_Amount,Primary_Acc,Total_Experience,source,EMI_Paid,Card_Vintage,Residential_Status From Req_Loan_Personal Where (RequestID='" . $pl_requestid . "')";
    list($alreadyExist, $plrow) = MainselectfuncNew($getpldetails, $array = array());
    $myrowcontr = count($plrow) - 1;
    //UATlink
    $Loan_Amount = $plrow[$myrowcontr]['Loan_Amount'];
    $Net_Salary = round($plrow[$myrowcontr]['Net_Salary']);
    $City = $plrow[$myrowcontr]['City'];
    $City_Other = $plrow[$myrowcontr]['City_Other'];
    $Name = $plrow[$myrowcontr]['Name'];
    list($first, $middle, $last) = explode(" ", $Name);
    $Mobile_Number = $plrow[$myrowcontr]['Mobile_Number'];
    $Email = $plrow[$myrowcontr]['Email'];
    $Employment_Status = $plrow[$myrowcontr]['Employment_Status'];

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
        <title>ICICI Personal Loan</title>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <link href="http://www.deal4loans.com/css/bootstrap.css" type="text/css" rel="stylesheet" />
        <link href="http://www.deal4loans.com/css/icici-land-page.css" type="text/css" rel="stylesheet" />
        <link href="http://www.deal4loans.com/css/font.min.4.6.3.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="http://www.deal4loans.com/ajax.js"></script>
        <script type="text/javascript" src="http://www.deal4loans.com/ajax-dynamic-icicipllist.js"></script>
        <script src="http://www.deal4loans.com/js/jquery-2.2.js" ></script>
        <style type="text/css">
            /* Big box with list of options */
            #ajax_listOfOptions{
                position:absolute;	/* Never change this one */
                width:500px;	/* Width of box */
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
        <script type="text/javascript">
            // Personal Loan ICICI Landing Page.
            function ValidatePLICICIFrms(Form)
            {
                var i;
                var j;
                var cnt = -1;
                var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
                var dt, mdate;
                dt = new Date();
                var alpha = /^[a-zA-Z\ ]*$/;
                var alphanum = /^[a-zA-Z0-9]*$/;
                var num = /^[0-9]*$/;
                var space = /^[\ ]*$/;
                var iChars = "/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
                if (Form.CompanyName.value == "")
                {
                    Form.CompanyName.style.border = '1px solid #FF0000';
                    Form.CompanyName.focus();
                    return false;
                }
                if (Form.LoanAmount.value == "")
                {
                    Form.LoanAmount.style.border = '1px solid #FF0000';
                    Form.LoanAmount.focus();
                    return false;
                }
                if (Form.NetyearlyIncome.value == "")
                {
                    Form.NetyearlyIncome.style.border = '1px solid #FF0000';
                    Form.NetyearlyIncome.focus();
                    return false;
                }
                if (Form.City.value == "" || Form.City.value == "Please Select")
                {
                    Form.City.style.border = '1px solid #FF0000';
                    Form.City.focus();
                    return false;
                }

                if (Form.Name.value == "")
                {
                    Form.Name.style.border = '1px solid #FF0000';
                    Form.Name.focus();
                    return false;
                }
                if (Form.LastName.value == "")
                {
                    Form.LastName.style.border = '1px solid #FF0000';
                    Form.LastName.focus();
                    return false;
                }
                if (Form.MobileNumber.value == "")
                {
                    Form.MobileNumber.style.border = '1px solid #FF0000';
                    Form.MobileNumber.focus();
                    return false;
                }
                if (isNaN(Form.MobileNumber.value) || Form.MobileNumber.value.indexOf(" ") != -1)
                {
                    Form.MobileNumber.style.border = '1px solid #FF0000';
                    Form.MobileNumber.focus();
                    return false;
                }
                if (Form.MobileNumber.value.length < 10)
                {
                    Form.MobileNumber.style.border = '1px solid #FF0000';
                    Form.MobileNumber.focus();
                    return false;
                }
                if ((Form.MobileNumber.value.charAt(0) != "9") && (Form.MobileNumber.value.charAt(0) != "8") && (Form.MobileNumber.value.charAt(0) != "7"))
                {
                    Form.MobileNumber.style.border = '1px solid #FF0000';
                    Form.MobileNumber.focus();
                    return false;
                }

                if (regMail.test(Form.EmailID.value) == false)
                {
                    Form.EmailID.style.border = '1px solid #FF0000';
                    Form.EmailID.focus();
                    return false;
                }
                if (Form.Occupation.value == "")
                {
                    Form.Occupation.style.border = '1px solid #FF0000';
                    Form.Occupation.focus();
                    return false;
                }
                if (!Form.accept.checked)
                {
                    alert("Accept the Terms and Condition");
                    Form.accept.focus();
                    return false;
                }
            }

        </script>
    </head>
    <body class="body-bg-gray">
        <div class="top-strip"></div>
        <section class="icici-wrapper">
            <div class="container">
                <div class="row mr-top-50">
                    <div class="col-xs-12 col-md-3"><img src="images/icici-logo.png" width="218" height="44" alt="logo"></div>
                    <div class="col-xs-12 col-md-9 h1"><strong>Personal Loan – </strong>  Get Finance for your every need Apne Dum Par</div>
                </div>
                <div class="col-xs-12 col-md-7 col-sm-6 mr-top-30 form-white-bg"><h2>Professional Details</h2>
                    <form method="post" name="PLICICILanging" action="/apply_icicipl_consent_continue.php"  onSubmit="return ValidatePLICICIFrms(document.PLICICILanging);">
					<input type="hidden" value="<?php echo $pl_requestid;?>" name="pl_requestid">
					<input type="hidden" value="<?php echo $pl_bank_name;?>" name="pl_bank_name">
                        <div class="row mr-10">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></div>
                                    <input name="CompanyName" id="CompanyName" type="text" placeholder="Company Name (Please confirm once again)" class="form-control" minlength="0" maxlength="255" data-d-group="2" onkeyup="ajax_showOptions(this, 'getCountriesByLetters', event, '<?php echo $ajaxurl; ?>')" onkeypress="return CharsetKeyOnly(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row mr-10">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    <input name="LoanAmount" id="LoanAmount" type="text" placeholder="Loan Amount" class="form-control NumericFormat" minlength="0" maxlength="10" data-d-group="2" value="<?php echo $Loan_Amount; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row mr-10">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></div>
                                    <input name="NetyearlyIncome" id="NetyearlyIncome" type="text" placeholder="Net yearly Income" class="form-control NumericFormat" minlength="0" maxlength="10" data-d-group="2" value="<?php echo $Net_Salary; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row mr-10">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                    <select name="City" class="form-control">
                                        <?= plgetCityList($City) ?></select>
                                </div>
                            </div>
                        </div>
                        <h2>Personal Information</h2>
                        <div class="row">
                            <div class="col-xs-12 col-md-4 no-padding-right mr-10">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    <input name="Name" id="Name" type="text" placeholder="First Name" class="form-control" minlength="0" maxlength="150" data-d-group="2" value="<?php echo $first; ?>" onkeypress="return CharsetKeyOnly(event)">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4 no-padding-right mr-10">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    <input name="MiddleName" id="MiddleName" type="text" placeholder="Middle Name" class="form-control" minlength="0" maxlength="150" data-d-group="2" value="<?php echo $middle; ?>" onkeypress="return CharsetKeyOnly(event)"></div>
                            </div>
                            <div class="col-xs-12 col-md-4 mr-10">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    <input name="LastName" id="LastName" type="text" placeholder="Last Name" class="form-control" minlength="0" maxlength="150" data-d-group="2" value="<?php echo $last; ?>" onkeypress="return CharsetKeyOnly(event)">
                                </div>
                            </div>
                        </div>
                        <div class="row mr-10">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></div>
                                    <input name="MobileNumber" id="MobileNumber" type="text" placeholder="Mobile Number" class="form-control" minlength="0" maxlength="10" data-d-group="2" value="<?php echo $Mobile_Number; ?>" onkeypress="return numOnly(event);">
                                </div>
                            </div></div>

                        <div class="row mr-10">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope envelop-icon" aria-hidden="true"></i></div>
                                    <input name="EmailID" id="EmailID" type="text" placeholder="E-Mail Id" class="form-control" minlength="0" maxlength="250" data-d-group="2" value="<?php echo $Email; ?>">
                                </div>
                            </div></div>
                        <div class="row mr-10">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-briefcase envelop-icon" aria-hidden="true"></i></div>
                                    <input name="Occupation" id="Occupation" type="text" placeholder="Occupation" class="form-control" minlength="0" maxlength="250" data-d-group="2" value="<?php if($Employment_Status==1) {echo "Salaried";} else { echo "Self Employed";} ?>" onkeypress="return CharsetKeyOnly(event)">
                                </div>
                            </div></div>

                        <div class="row mr-10">
                            <div class="col-xs-12">
                                <label for="check-one" class="small">
                                    <input type="checkbox" name="accept" id="check-one" checked="">
                                    <i></i> <span> I agree to the <a href="privacy.php" class="term-c-new-text" target="_blank" rel="nofollow">Terms &amp; Conditions</a>  </span> </label>
                            </div>
                        </div>

                        <div class="row mr-10">
                            <div class="col-xs-12">
                                <button class="btn" name="submit" type="submit">Get Online In-Principle Approval</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-xs-12 col-md-5 col-sm-6 mr-top-30"><h2>Why ICICI Bank?</h2>
                    <ul>
                        <li>ROI as low as <strong>11.59%</strong><span class="red-text">*</span></li>
                        <li>Loan Amount Up to 20 Lacs</li>
                        <li>Flexible repayment options – <strong>1 To 5 Years</strong></li>
                        <li>Special Offer on Balance Transfer <strong>11.69%</strong><span class="red-text">*</span></li>
                        <li><strong>Zero Pre Payment Charges</strong><span class="red-text">*</span> (Loan Amount 10 Lacs & Above)</li>
                    </ul>
                    <h2>Introduction to ICICI Bank Personal Loan</h2>
                    <ul>
                        <li>Multi-purpose loan</li>
                        <li>Fixed rate of Interest, Interest charged on 
                            monthly reducing basis</li>
                        <li>Flexible tenures up to 60 months</li>
                        <li>No security, no collateral</li>
                        <li>Loan payable in easy installments</li>
                        <li>Repayment through Auto-debit / ECS / PDC</li>
                    </ul>
                    <div class="small-text mr-top-20">End use of the ICICI Bank Personal Loan can be House renovation, 
                        Holidays, Purchase of consumer durables, Education, Marriage, 
                        Short Term loan for equipment purchase, Short Term Working Capital, 
                        Any other personal emergency.</div>
                    <div class="small-text mr-top-20">Note : <span class="red-text">*</span> T&C Apply</div>
                </div>
            </div>
            <hr />
            <div class="container text-right powered-text">Powered by <strong>Deal4loans.com</strong></div>
        </section>
        <script type="text/javascript" src="http://www.deal4loans.com/js/autoNumeric.js"></script>
        <script type="text/javascript">
        $('.form-control').on('keydown change', function () {
            $(this).css('border', '');

        });

        function CharsetKeyOnly(evt)
        {
            var k;
            document.all ? k = evt.keyCode : k = evt.which;
            return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32);
        }
        function numOnly(evt)
        {
            var k;
            document.all ? k = evt.keyCode : k = evt.which;
            return (k == 8 || k == 32 || (k >= 48 && k <= 57));
        }
        $(function () {
    $('.NumericFormat').autoNumeric({mDec: '0', lZero: 'deny'});
});
        </script>
        <script type="text/javascript" src="http://www.deal4loans.com/js/bootstrap.min.js"></script>
        

    </body>
</html>