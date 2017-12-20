<link href="css/styles-home-loan.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="css-range-slider/rangeslider.css">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript">
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

    function cityother()
    {
        if (document.loan_form.City.value == "Others")
        {
            document.loan_form.City_Other.disabled = false;
        } else
        {
            document.loan_form.City_Other.disabled = true;
        }
    }
    function Trim(strValue)
    {
        var j = strValue.length - 1;
        i = 0;
        while (strValue.charAt(i++) == ' ')
            ;
        while (strValue.charAt(j--) == ' ')
            ;
        return strValue.substr(--i, ++j - i + 1);
    }

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
    function chkform()
    {
        var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
        var dt, mdate;
        dt = new Date();
        var j;
        var cnt = -1;
        var alpha = /^[a-zA-Z\ ]*$/;
        var alphanum = /^[a-zA-Z0-9]*$/;
        var num = /^[0-9]*$/;
        var space = /^[\ ]*$/;
        var iChars = "/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";


        if (document.loan_form.Age.value == "")
        {
            document.getElementById('AgeVal').innerHTML = "<span class='hintanchor'>Select Age!</span>";
            document.loan_form.Age.focus();
            return false;
        }

        if (document.loan_form.property_value.value == "" || document.loan_form.property_value.value == "Property Value")
        {
            document.getElementById('propertyValueVal').innerHTML = "<span  class='hintanchor'>Enter Property Value!</span>";
            document.loan_form.property_value.focus();
            return false;
        }
        if ((document.loan_form.Gender[0].checked == false) && (document.loan_form.Gender[1].checked == false))
        {
            alert("Please choose your Gender: Male or Female");
            return false;
        }
        if (document.loan_form.Residence_Address.value == "")
        {
            document.getElementById('ResiAddVal').innerHTML = "<span class='hintanchor'>Please enter residence Address</span>";
            document.loan_form.Residence_Address.focus();
            return false;
        }
        if (document.loan_form.Pincode.value == "")
        {
            document.getElementById('PincodeVal').innerHTML = "<span class='hintanchor'>Please enter Pincode</span>";

            document.loan_form.Pincode.focus();
            return false;
        }
        var a = document.loan_form.Pancard.value;
        var regex1 = /^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
        if (regex1.test(a) == false)
        {
            document.getElementById('PancardVal').innerHTML = "<span class='hintanchor'>Please enter correct PAN number</span>";

            document.loan_form.Pancard.focus();
            return false;
        }
        if (document.loan_form.Pancard.value.charAt(3) != "P" && Form.Pancard.value.charAt(3) != "p")
        {
            document.getElementById('PancardVal').innerHTML = "<span class='hintanchor'>Please enter correct PAN number</span>";

            document.loan_form.Pancard.focus();
            return false;
        }

        if ((document.loan_form.Pancard.value == ""))
        {
            document.getElementById('PancardVal').innerHTML = "<span class='hintanchor'>Please enter PAN number</span>";

            document.loan_form.Pancard.focus();
            return false;
        }
        for (i = 0; i < document.loan_form.Property_Identified.length; i++)
        {
            if (document.loan_form.Property_Identified[i].checked)
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
            if (document.loan_form.Property_loc.selectedIndex == 0)
            {
                document.getElementById('PropLocationVal').innerHTML = "<span class='hintanchor'>Plese select city where property is located</span>";
                document.loan_form.Property_loc.focus();
                return false;
            }
        }

        if (!document.getElementById("checkboxG2").checked)
        {
            document.getElementById('TermConditionVal').innerHTML = "<span class='hintanchor'>Please Check Term and condition to proceed.</span>";
            document.loan_form.accept.focus();
            return false;
        }

    }


    function addIdentified()
    {
        var ni1 = document.getElementById('myDiv1');
        ni1.innerHTML = '<div class="form-input-wrapper form-box-left-margin"><div>Property Location</div>    <div><select name="Property_loc" id="Property_loc" class="form-select" onchange="validateDiv(\'PropLocationVal\');"><?= getCityList1($City) ?></select></div><div id="PropLocationVal"></div></div>';
        var cfdiv = document.getElementById('commonfloorlogo');
        //alert(cfdiv);
        cfdiv.innerHTML = '';
        return true;
    }
    function removeIdentified()
    {
        var ni1 = document.getElementById('myDiv1');
        ni1.innerHTML = '';
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
                } else {
                    eval(document.getElementById("divfaq" + j)).style.display = 'none'
                }
            }

        }
    }
    function validateDiv(div) {
        var ni1 = document.getElementById(div);
        ni1.innerHTML = '';
    }


</script>
<div class="form-ui-main-wrapper">
    <div class="form-ui-main-wrapper-inner">
        <form name="loan_form" method="post" action="apply-home-loanscontinue-step2.php" onSubmit="return chkform();">
            <?php
            $newsource = "Home Loan Calc";
            $subjectLine = "Home Loan Eligibility Calculator";
            $subjectLine2 = " - Get Instant Free Quote from Top 10 Banks. ";
            $subjectLine3 = " Minimum Tenure - 6 Months ";
            ?>
            <input type="hidden" name="ProductValue" value="<?php echo $_SESSION['ProductValue']; ?>">
            <input type="hidden" name="Name" value="<?php echo $Name; ?>">
            <input type="hidden" name="Phone" value="<?php echo $Phone; ?>">
            <input type="hidden" name="City" value="<?php echo $City; ?>">
            <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <input type="hidden" name="Cfcount" id="Cfcount" value="<?php echo $Cfcount; ?>">
            <input type="hidden" name="Activate" id="Activate" >
            <input type="hidden" name="source" value="<?php echo $newsource; ?>">
            <div class="nagative-margin-new">
                <h3>90% of your application for quote from all banks is complete. Share few more details to get exact quote on Emi,Rates & Loan Amount.</h3>

                <div class="form-clear"></div>
                <div id="PersonalDetails">
                    <div class="form-clear"></div>
                    <div class="form-sub-head form-special-top-margin">Personal Details</div>
                    <div class="termtext"><img src="images/security.png" width="14" height="16">Your Information is secure with us and will not be shared without your consent</div>
                    <div class="form-clear margin-top-symbol"></div>
                    <div class="form-clear"></div>
                    <div class="form-input-wrapper">
                        <div class="form-icon"><img src="test-newui/images-newui/age-icon.png" width="45" height="45" alt="Age" /></div>
                        <div class="form-clear"></div>
                        <select onchange="validateDiv('AgeVal');"  name="Age" id="Age" class="form-select">
                            <option value="">Select Age</option>
                            <?php for ($a = 18; $a <= 65; $a++) { ?>
                                <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                            <?php } ?>
                        </select>
                        <div id="AgeVal"></div>
                    </div>
                    <div class="form-input-wrapper form-box-left-margin">
                        <div class="form-icon"><img src="test-newui/images-newui/property-value.png" width="45" height="45" alt="Property Value" /></div>
                        <div class="form-clear"></div>
                        <input type="text" class="form-input" name="property_value"  id="property_value" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this);" placeholder="Property Value" onkeydown="validateDiv('propertyValueVal');" />
                        <div id="propertyValueVal"></div>
                    </div>
                    <div class="form-input-wrapper form-box-left-margin">
                        <div class="form-icon"><img src="test-newui/images-newui/running-emi.png" width="45" height="45" alt="Running EMI" /></div>
                        <div class="form-clear"></div>
                        <input type="text" class="form-input" name="obligations" id="obligations" onkeyup="intOnly(this);" onkeypress="intOnly(this);"  placeholder="Monthly EMI for all running loans" />
                    </div>
                    <div class="form-clear"></div>
                    <div class="form-input-wrapper">
                        <div class="form-sub-head form-special-top-margin">Gender:</div>
                        <div >
                            <input type="radio" name="Gender" id="Gender" value="1" class="css-checkbox" selected />
                            <label for="Gender" class="css-label radGroup2" >Male</label>
                            <input type="radio" name="Gender" id="Gender2" value="2" class="css-checkbox" />
                            <label for="Gender2" class="css-label radGroup2">Female</label>
                        </div>
                        <div class="form-clear"></div>
                    </div>
                    <div class="form-input-wrapper form-box-left-margin"><div>Residence Address</div>
                        <div><textarea name="Residence_Address" id="Residence_Address" maxlength="250" onkeypress="return blockSpecialChar(event)" onkeydown="validateDiv('ResiAddVal');"  class="form-input"></textarea></div><div id="ResiAddVal"></div></div>
                    <div class="form-input-wrapper form-box-left-margin"><div>Residence Pincode</div><div><input type="text" name="Pincode" id="Pincode" maxlength="6" onkeydown="validateDiv('PincodeVal');" class="form-input" /></div><div id="PincodeVal"></div></div>
                    <div class="form-clear"></div>
                    <div class="form-input-wrapper"><div>PAN No</div>    <div><input type="text" name="Pancard" id="Pancard" maxlength="10" onkeydown="validateDiv('PancardVal');" class="form-input" style="text-transform: uppercase" onkeypress="return blockAllSpecialChar(event)"  /></div><div id="PancardVal"></div></div>
                    <div class="form-clear"></div>
                    <div class="form-input-wrapper">
                        <div class="form-sub-head form-special-top-margin">Property Identified:</div>
                        <div >
                            <input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="return addIdentified();" class="css-checkbox" />
                            <label for="Property_Identified" class="css-label radGroup2" >yes</label>
                            <input type="radio"name="Property_Identified" id="Property_Identified2" onclick="removeIdentified();" value="0" class="css-checkbox" />
                            <label for="Property_Identified2" class="css-label radGroup2">No</label>
                        </div>
                        <div class="form-clear"></div>
                    </div>
                    <div id="myDiv1" style="margin-top:6px;"></div>
                    <div class="form-clear"></div>
                    <div class="form-input-wrapper">
                        <div style="height:15px;"></div>
                        <div class="form-input-wrapper" style=" margin-top:-10px; width:100%;">
                            <input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1, 12);" class="css-checkbox"  />
                            <label for="co_appli" class="css-label-check">Co - applicants</label>
                        </div>
                        <div class="form-clear"></div>
                    </div>
                    <div class="form-clear"> </div>
                    <div style="display:none; " id="divfaq1">
                        <div class="form-input-wrapper">
                            <div class="form-icon"></div>
                            <div class="form-clear"></div>
                            <input  type="text" class="form-input" name="co_name" id="Co-applicant Name" placeholder="Co-applicant Name"/>
                        </div>
                        <div class="form-input-wrapper form-box-left-margin">
                            <div class="form-icon"></div>
                            <div class="form-clear"></div>
                            <select onkeydown="validateDiv('AgeVal');" class="form-select" name="CoAge" id="CoAge">
                                <option value="">Select Age</option>
                                <?php for ($a = 18; $a <= 65; $a++) { ?>
                                    <option value="<?php echo $a; ?>"><?php echo $a; ?></option>
                                <?php } ?>
                            </select>                 </div>
                        <div class="form-input-wrapper form-box-left-margin">
                            <div class="form-icon"></div>
                            <div class="form-clear"></div>
                            <input type="text" class="form-input" name="co_monthly_income" id="co_monthly_income" placeholder="Net Monthly Income" />
                        </div>
                        <div class="form-input-wrapper">
                            <div class="form-icon"></div>
                            <div class="form-clear"></div>
                            <input type="text" class="form-input" name="co_obligations" id="co_obligations" placeholder="Monthly EMIs" />
                        </div>
                    </div>
                    <div class="form-clear"></div>
                    <div class="bottom-margin-new">
                        <input type="checkbox" name="accept" id="checkboxG2" value="1" class="css-checkbox" checked="checked" onclick="validateDiv('TermConditionVal');" />
                        <label for="checkboxG2" class="css-label-check">I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#3671d5; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  style=" color:#3671d5; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#3671d5; text-decoration:underline;">Terms and Conditions</a>.</label>
                        <div id="TermConditionVal"></div>
                    </div>

                </div>

                <div style="clear:both !important; padding-top:5px;"></div>
                <div class="form-white-text bntnew-topmargin"><strong class="quote-form_a">54 ,</strong><strong class="quote-form_b">02 ,</strong><strong class="quote-form_c"> 013</strong> Loan quotes taken till now
                    <div class="button-right-align">
                        <input type="submit" value="Get Quote" class="form-ui-quote-button"  onClick="ga('send', 'event', 'Get Home Loan Quote', 'Get Quote Home');" />
                    </div>
                </div>
                <div style="clear:both !important;"></div>
                <div id="commonfloorlogo"></div>
                <div style="clear:both !important;"></div>
                <div class="form-white-text form-special-top">&bull; 54 lakh customers serviced to get  best Loan deals with deal4loans. Deal4loans views Published @ yourstory .com<br />
                    &bull; As RBI cuts rate, should you go for fixed home loan Deal4loans views Published @ Economic Times online </div>
                <div class="form-clear"></div>
                <div></div>
            </div>
        </form>
    </div>
</div>
