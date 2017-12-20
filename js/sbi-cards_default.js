function sssFormValidate(Form)
            {
                var j;
                var l;
                var r;
                var k;
                var cntr = -1;
                var cnt = -1;
                var cntl = -1;
                var cntlb = -1;
                var cntSa = -1;
                var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
                var dt, mdate;
                dt = new Date();
                var alpha = /^[a-zA-Z\ ]*$/;
                var alphanum = /^[a-zA-Z0-9]*$/;
                var num = /^[0-9]*$/;
                var space = /^[\ ]*$/;
                var iChars = "/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
                if ((Form.first_name.value == "") || (Form.first_name.value == "First Name"))
                {
                    document.getElementById('FirstnameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your First Name</span>";
                    Form.first_name.focus();
                    return false;
                }
                if (Form.Email.value == "")
                {
                    document.getElementById('EmailVal').innerHTML = "<span  class='hintanchor'>Enter Email Address!</span>";
                    Form.Email.focus();
                    return false;
                }

                var str = Form.Email.value
                var aa = str.indexOf("@")
                var bb = str.indexOf(".")
                var cc = str.charAt(aa)

                if (aa == -1)
                {
                    document.getElementById('EmailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";
                    Form.Email.focus();
                    return false;
                } else if (bb == -1)
                {
                    document.getElementById('EmailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";
                    Form.Email.focus();
                    return false;
                }
                if (Form.City.selectedIndex == 0)
                {
                    document.getElementById('CityVal').innerHTML = "<span  class='hintanchor'>Select City!</span>";
                    Form.City.focus();
                    return false;
                }
                if (Form.IncomeAmount.selectedIndex == 0)
                {
                    document.getElementById('IncomeAmountVal').innerHTML = "<span  class='hintanchor'>Select Annual Income!</span>";
                    Form.IncomeAmount.focus();
                    return false;
                }
                if (Form.Phone.value == "")
                {
                    document.getElementById('PhoneVal').innerHTML = "<span  class='hintanchor'>Enter Mobile Number!</span>";
                    Form.Phone.focus();
                    return false;
                }
                if (isNaN(Form.Phone.value) || Form.Phone.value.indexOf(" ") != -1)
                {
                    document.getElementById('PhoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
                    Form.Phone.focus();
                    return false;
                }
                if (Form.Phone.value.length < 10)
                {
                    document.getElementById('PhoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";
                    Form.Phone.focus();
                    return false;
                }
                if ((Form.Phone.value.charAt(0) != "9") && (Form.Phone.value.charAt(0) != "8") && (Form.Phone.value.charAt(0) != "7"))
                {
                    document.getElementById('PhoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";
                    Form.Phone.focus();
                    return false;
                }

                if (Form.otp.value == "")
                {
                    document.getElementById('OTPVal').innerHTML = "<span  class='hintanchor'>Enter OTP!</span>";
                    Form.otp.focus();
                    return false;
                }
                if ((Form.dob.value == ""))
                {
                    document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Select dob!</span>";
                    Form.dob.focus();
                    return false;
                }

                if (Form.qualification.selectedIndex == 0)
                {
                    document.getElementById('qualificationVal').innerHTML = "<span  class='hintanchor'>Select Qualification!</span>";
                    Form.qualification.focus();
                    return false;
                }
                for (j = 0; j < Form.Gender.length; j++)
                {
                    if (Form.Gender[j].checked)
                    {
                        cnt = j;
                    }
                }
                if (cnt == -1)
                {

                    document.getElementById('GenderVal').innerHTML = "<span  class='hintanchor'>Enter Gender!</span>";
                    return false;
                }
                if (Form.occupation.selectedIndex == 0)
                {
                    document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status!</span>";
                    Form.occupation.focus();
                    return false;
                }

                if ((Form.Company_Name.value == ""))
                {
                    document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";
                    Form.Company_Name.focus();
                    return false;
                }

                if (Form.NatureOfCompany.selectedIndex == 0)
                {
                    document.getElementById('NatureOfCompanyVal').innerHTML = "<span  class='hintanchor'>Select Nature of Company!</span>";
                    Form.NatureOfCompany.focus();
                    return false;
                }

                if ((Form.designation.value == ""))
                {
                    document.getElementById('designationVal').innerHTML = "<span  class='hintanchor'>Enter Designation!</span>";
                    Form.designation.focus();
                    return false;
                }
                if ((Form.CurrentEmployment.value == ""))
                {
                    document.getElementById('CurrentEmploymentVal').innerHTML = "<span  class='hintanchor'>Enter Years at Current employment!</span>";
                    Form.CurrentEmployment.focus();
                    return false;
                }
                var a = Form.pancard.value;
                var regex1 = /^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
                if (regex1.test(a) == false)
                {
                    document.getElementById('pancardVal').innerHTML = "<span  class='hintanchor'>Please enter valid pan number</span>";
                    Form.pancard.focus();
                    return false;
                }
                if (Form.pancard.value.charAt(3) != "P" && Form.pancard.value.charAt(3) != "p")
                {
                    document.getElementById('pancardVal').innerHTML = "<span  class='hintanchor'>Please enter valid pan number</span>";
                    Form.pancard.focus();
                    return false;
                }

                if ((Form.pancard.value == ""))
                {
                    document.getElementById('pancardVal').innerHTML = "<span  class='hintanchor'>Please Enter Pan Card Number</span>";
                    Form.pancard.focus();
                    return false;
                }

                if ((Form.residence_address.value == ""))
                {
                    document.getElementById('residenceAddressVal').innerHTML = "<span  class='hintanchor'>Enter Residence Address!</span>";
                    Form.residence_address.focus();
                    return false;
                }

                if (Form.Residencecity.selectedIndex == 0)
                {
                    document.getElementById('ResidencecityVal').innerHTML = "<span  class='hintanchor'>Select Residence City!</span>";
                    Form.Residencecity.focus();
                    return false;
                }

                if (Form.pincode.value == "")
                {
                    document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Please Enter Pincode!</span>";
                    Form.pincode.focus();
                    return false;
                }

                if ((Form.office_address.value == ""))
                {
                    document.getElementById('officeAddressVal').innerHTML = "<span  class='hintanchor'>Enter Office Address!</span>";
                    Form.office_address.focus();
                    return false;
                }

                if (Form.Officecity.selectedIndex == 0)
                {
                    document.getElementById('OfficecityVal').innerHTML = "<span  class='hintanchor'>Select Office City!</span>";
                    Form.Officecity.focus();
                    return false;
                }
                if (Form.office_pincode.value == "")
                {
                    document.getElementById('officePincodeVal').innerHTML = "<span  class='hintanchor'>Please Enter Office Pincode!</span>";
                    Form.office_pincode.focus();
                    return false;
                }

                if (!document.getElementById("terms").checked)
                {
                    document.getElementById('termsVal').innerHTML = "<span class='hintanchor'>Please Check Term and condition to proceed.</span>";
                    Form.terms.focus();
                    return false;
                }

            }

            function validateDiv(div)
            {
                var ni1 = document.getElementById(div);
                ni1.innerHTML = '';
            }
            function ShowOTPField(evt)
            {
                if (document.SssFrm.Phone.value == "")
                {
                    document.getElementById('PhoneVal').innerHTML = "<span  class='hintanchor'>Enter Mobile Number!</span>";
                    document.SssFrm.Phone.focus();
                    return false;
                }
                if (isNaN(document.SssFrm.Phone.value) || document.SssFrm.Phone.value.indexOf(" ") != -1)
                {
                    document.getElementById('PhoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
                    document.SssFrm.Phone.focus();
                    return false;
                }
                if (document.SssFrm.Phone.value.length < 10)
                {
                    document.getElementById('PhoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";
                    document.SssFrm.Phone.focus();
                    return false;
                }
                if ((document.SssFrm.Phone.value.charAt(0) != "9") && (document.SssFrm.Phone.value.charAt(0) != "8") && (document.SssFrm.Phone.value.charAt(0) != "7"))
                {
                    document.getElementById('PhoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";
                    document.SssFrm.Phone.focus();
                    return false;
                }

                var MobileNum = document.getElementById('Phone').value;
                document.getElementById("ShowOTPField").style.display = "block";

                $.ajax({type: 'post', url: '../sendsms.php', data: {MobileNum: MobileNum},
                    success: function (response) {
                        //alert(response);
                        //$('#status').html(response);

                        if (response == "OK") {
                            return true;
                        } else {
                            return false;
                        }
                    }
                });
            }

            function ShowPersonalInfoField(evt)
            {
                if (document.SssFrm.otp.value == "")
                {
                    document.getElementById('OTPVal').innerHTML = "<span  class='hintanchor'>Enter OTP!</span>";
                    document.SssFrm.otp.focus();
                    return false;
                }
                document.getElementById("personalInfo").style.display = "block";
            }
            function ShowOtherInfoField(evt)
            {
                document.getElementById("OtherInfo").style.display = "block";
            }
            function isSpecialChar(e)
            {
                var k;
                document.all ? k = e.keyCode : k = e.which;
                return ((k > 64 && k < 91) || (k > 96 && k < 123) || (k >= 48 && k <= 57) || (k == 35) || (k == 39) || (k == 124) || (k == 44) || (k == 47));
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
                var charCode = (evt.which) ? evt.which : window.event.keyCode;
                if (charCode <= 13)
                {
                    return true;
                } else
                {
                    var keyChar = String.fromCharCode(charCode);
                    var re = /[0-9]/
                    return re.test(keyChar);
                }
            }
