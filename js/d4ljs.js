// JavaScript Document
$(document).ready(function() {
		$(".bodyoverlay").each(function(){
			    $(this).click(function() {
				if($(".overlay-bg").is(':visible') && $(this).children('.dropdown-menu').is(':visible')){
					$(".overlay-bg").fadeOut(100);
					}
					else{
						$(".overlay-bg").fadeIn(100);
						}
				
			});	
		});
        $('html').on('mouseup', function() {
        $(".overlay-bg").fadeOut(100);
		
    });
 
    $('button[data-loading-text]')
        .click(function () {
            var btn = $(this)
                btn.button('loading')
                setTimeout(function () {
                    btn.button('reset')
                }, 3000)
            });


    //panel1 condtion on radio button clicked
    $("[id^='Employment_Status']").click(function() {
        var currentRadioId = $(this, "id").attr("id");
        $(".panel1").find("button[type='submit']").hide();
        $(".panel2").find("button[type='submit']").show();
        if (currentRadioId == "Employment_Status2") {
            HidePanels();
            $(".panel1").show();
            $(".panel4").show();

        } else {
            HidePanels();
            $(".panel1").show();
            $(".panel2").show();
            $(".second_button_remove").show();

        }
		
		$(".second-city-hide").hide();
    });


    $(".radio-display").click(function() {
        $(".radio-display-box").show();
        $(".radio-display").next("span").removeClass("outer_error");
    });

    $(".radio-display2").click(function() {
        $(".radio-display-box2").show();
        $(".radio-display2").next("span").removeClass("outer_error");
    });

    $(".radio-display3").click(function() {
        $(".radio-display-box3").show();
        $(".radio-display3").next("span").removeClass("outer_error");
    });

    $(".any-credit").click(function() {
        $(".any-credit-display").show();
        $(".existing_loan_display").hide();

    });

    $(".existing_loan").click(function() {
        $(".existing_loan_display").show();
        $(".second_button_remove").hide();
        $(".anycreditcard_main_display").hide();
        $(".loan_type").show();
    });

    // $(".loan_type").click(function() {
    //     $(".emi_paid_display").show();
    // });

    $(".emi_paid").click(function() {
        $(".anycreditcard_main_display").show();
    });

    $(".no_existing_loan").click(function() {
        $(".no_existing_loan").hide();
        $(".existing_loan_display").show();
        $(".loan_type").hide();
        $(".emi_paid_display").hide();
        $(".second_button_remove").hide();
        $(".anycreditcard_main_display").show();
		

    });

    $(".holding-credit-card").click(function() {
        $(".holding-credit-card-display").show();
        $(".panel6").hide();
        $(".third_btn_remove").show();

    });

    $(".no-holding-credit-card").click(function() {
        $(".holding-credit-card-display").hide();
        $(".third_btn_remove").hide();
		$(".second-city-hide").show();
		$(".second-card-hide").hide();
		
    });

    $(".card_holding_duration").click(function() {
        $("#submit_btn5").hide();
        $(".personal_details_display").show();
        $(".first-step-city").show();
        $(".residence_status").show();
        $(".office_status").show();
		$(".personal_details_display_first").show();
		$(".second-card-hide").hide();
		$(".second-city-hide").show();
		
		
    });

    $(".holding-credit-card").click(function() {
        $(".holding-credit-card-display").show();
    });

    $(".no-holding-credit-card").click(function() {
        $(".holding-credit-card-display").hide();
        $(".personal_details_display").show();
		 $(".personal_details_display_first").show();
    });

    $(".city_select").click(function() {
        $(".first-step-card-box").show();
    });

    $(".first_holding_credit-card").click(function() {
        $(".first_holding_credit-card-display").show();
    });

    $(".first_no_credit-card").click(function() {
        $(".first_holding_credit-card-display").hide();
    });

    $(".card_holding_duration_second").click(function() {
        $(".personal_details_display").show();
    });


    function HidePanels() {
        $(".panel1").hide();
        $(".panel2").hide();
        $(".panel3").hide();
        $(".panel4").hide();
        $(".panel5").hide();
        $(".panel6").hide();
    }

});

$(function() {

    $("input[type='text']").keyup(function() {
        if ($(this).val().length > 0) {
            $(this).removeClass("error");
        } else {
            $(this).addClass("error");
        }
    });
    $("#Email,#Email2,#Email3").keyup(function() {
      
        var isValidEmail = ValidateEmail($(this).val());
        if (!isValidEmail) {
            flag = true;
            $(this).addClass("error");
        } else {
            flag = false;
            $(this).removeClass("error");
        }
    });
    $("#Phone").keyup(function() {
        var isValidMobile = PhoneNumber($("#Phone").val());
        if (!isValidMobile) {
            flag = true;
            $(this).addClass("error");
        } else {
            flag = false;
            $(this).removeClass("error");
        }
    });
    $("select").change(function() {
        if ($(this)[0].selectedIndex > 0) {
            flag = true;
            $(this).removeClass("error");
        } else {
            flag = false;
            $(this).addClass("error");
        }

    });
    $("input[type='radio']").click(function() {
        $(this).parents("div").find("input[type='radio']").next("span").removeClass("outer_error");
    });

    $(".custom_checkbox").click(function() {
        if ($(this).prop("checked")) {
            $(this).removeClass("checkbox_error");
        }
    });
    $(".loan_type input[type='checkbox']").click(function() {
       
        var isloan_type = false;

        $(".loan_type input[type='checkbox']").each(function() {
            if ($(this).prop("checked")) {
                isloan_type = true;
                $(".loan_type input[type='checkbox']").removeClass("checkbox_error");
            }
        });
        if (!isloan_type) {
            $(".emi_paid_display").hide();
        } else {
            $(".emi_paid_display").show();
        }

    });


    $("[id^='submit_btn']").click(function(e) {

      

        var Employment_Status = document.getElementById("Employment_Status1");
        var Employment_Status2 = document.getElementById("Employment_Status2");
        var flag = false;



        //condtion on panel1.button1 clicked
        if ($(this).is("#submit_btn")) {
            CommonValidation("panel1");
            if (!Employment_Status.checked && !Employment_Status2.checked) {
                $("[id^='Employment_Status']").next("span").addClass("outer_error");
                flag = true;
            }

        }

        //condtion on panel2.button2 clicked
        else if ($(this).is("#submit_btn2")) {
          
            CommonValidation("panel1");
            CommonValidation("panel2");
            if (!flag) {
                if ($("select#City")[0].selectedIndex > 0) {
                    $(".personal_details_display_first").show();
                    $(".residence_status").hide();
                    $(".office_status").hide();
                    $(this).hide();
                    $(".any-credit-display").hide();
                }
            }
			
			if(!flag){
				return false;
			}

        }
        //condtion on panel3.button3 clicked
        else if ($(this).is("#submit_btn3")) {
            CommonValidation("panel1");
            CommonValidation("panel2");
            CommonValidation("panel3");

            var isValidEmail = ValidateEmail($("#Email").val());
            if (!isValidEmail) {
                $("#Email").addClass("error");
                flag = true;
            } else {
				 flag = false;
                $("#Email").removeClass("error");
            }

            var isValidMobile = PhoneNumber(Phone.value);
            if (!isValidMobile) {
                $("#Phone").addClass("error");
                flag = true;
            } else {
				 flag = false;
                $("#Phone").removeClass("error");
            }

            if (!$(".panel3 .custom_checkbox").prop("checked")) {
                $(".custom_checkbox").addClass("checkbox_error");
                flag = true;
            }
            if (!$(".panel3 .emi_paid").prop("checked")) {
                $(".emi_paid").addClass("checkbox_error");
                flag = true;
            }
            if ($("#CC_Holder").prop("checked")) {
                var isChekedfirst_holding_credit_card_display = false;
                $(".first_holding_credit-card-display input[type='radio']").each(function(e, i) {
                    if ($(this).prop("checked")) {
                        isChekedfirst_holding_credit_card_display = true;
                    }

                });
                if (!isChekedfirst_holding_credit_card_display) {
                    $(".first_holding_credit-card-display input[type='radio']").next("span").addClass("outer_error");
                    flag = true;
                }
            }
 
            if (!flag) {
							
                $("#plfrm").delay(1000).submit();
            }
        }
        //condtion on panel4.button4 clicked
        else if ($(this).is("#submit_btn4")) {
            CommonValidation("panel1");
            CommonRadioValidation(this);
        }
        //condtion on panel5.button5 clicked
        else if ($(this).is("#submit_btn5")) {
            var isChekedanyCreditCard = false;
            var isHoldingcreditcardDisplay = false;
            $(".anycreditcard_main_display input[type='radio']").each(function(el, i) {
                if ($(this).prop("checked")) {
                    isChekedanyCreditCard = true;
                }
            });
            if (!isChekedanyCreditCard) {
                $(".anycreditcard_main_display input[type='radio']").next("span").addClass("outer_error");
                flag = true;
            }


            $(".holding-credit-card-display input[type='radio']").each(function(el, i) {
                if ($(this).prop("checked")) {
                    isHoldingcreditcardDisplay = true;

                }
            });
            if (!isHoldingcreditcardDisplay) {
                $(".holding-credit-card-display input[type='radio']").next("span").addClass("outer_error");
                flag = true;
            }
            var isloan_type = false;
            $(".loan_type input[type='checkbox']").each(function() {
                if ($(this).prop("checked")) {
                    isloan_type = true;

                }
            });
            if (!isloan_type) {
                $(".loan_type input[type='checkbox']").addClass("checkbox_error");
                flag = true;
            }

            var isEmiPaid = false;
            $(".emi_paid_display input[type='radio']").each(function() {
                if ($(this).prop("checked")) {
                    isEmiPaid = true;

                }
            });
            if (!isEmiPaid) {
                $(".emi_paid_display input[type='radio']").next("span").addClass("outer_error");
                flag = true;
            }



        }
        //condtion on panel6.button6 clicked
        else if ($(this).is("#submit_btn6")) {

            if ($("#FullName3").val().trim().length == 0) {
                $("#FullName3").addClass("error");
                flag = true;
            }
            if ($("#MobileNum3").val().trim().length == 0) {
                $("#MobileNum3").addClass("error");
                flag = true;
            }
            if ($("#City3")[0].selectedIndex == 0) {
                $("#City3").addClass("error");
                flag = true;
            }
            if ($("#Email3").val().trim().length == 0) {
                $("#Email3").addClass("error");
                flag = true;
            }

            if ($(".age")[0].selectedIndex == 0) {
                $(".age").addClass("error");
                flag = true;
            }

            var isresidence_status = false;

            $(".residence_status input[type='radio']").each(function(el, i) {
                if ($(this).prop("checked")) {
                    isresidence_status = true;

                }
            });
            if (!isresidence_status) {
                $(".residence_status input[type='radio']").next("span").addClass("outer_error");
                flag = true;
            }

            var isroffice_status = false;

            $(".office_status input[type='radio']").each(function(el, i) {
                if ($(this).prop("checked")) {
                    isroffice_status = true;

                }
            });
            if (!isroffice_status) {
                $(".office_status input[type='radio']").next("span").addClass("outer_error");
                flag = true;
            }
          
            var isAuthorize = false;
            $(".emi_paid").each(function() {
                if ($(this).prop("checked")) {
                    isAuthorize = true;
                }
            });
            if (!isAuthorize) {
                $(".emi_paid").addClass("error");
                flag = true;
            }

        }

        function CommonRadioValidation(button) {
            var index = 0;
            $(".self-employed-box div.col-md-3").each(function(i, element) {
                if (i < 4) {
                    if ($(this).is(":visible")) {
                        index = i + 1;
                    }
                }
            });


            var radioName = $(".self-employed-box div.col-md-3:nth-child(" + index + ")").find("input[type=radio]:first").attr("name");

            $("[name='" + radioName + "']").each(function(index, element) {
                if (!$(this).prop("checked")) {
                    $(this).next("span").addClass("outer_error");
                    flag = true;
                }
            });
            if (!flag) {
                $("[name='" + radioName + "']").next("span").removeClass("outer_error");
            }

        }

        function CommonValidation(panel) {
            $("." + panel + " input[type='text']").each(function(e, i) {
                if ($(this).val().trim().length == 0) {
                    $(this).addClass("error");
                    flag = true;
                } else {
                    $(this).removeClass("error");
                }
            });

            $("." + panel + " select").each(function(i, e) {
                if ($(this)[0].selectedIndex == 0) {
                    $(this).addClass("error");
                    flag = true;
                } else {
                    $(this).removeClass("error");
                }
            });
        }
		
		
		if(!flag){
			return true;
		}
		
		return false;
		
			
	 
		
    });



    $("[name^='Employment_Status']").change(function() {
        $("[name^='Employment_Status']").next("span").removeClass("outer_error");
    });

    function ValidateEmail(mail) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(mail);
    }

    function PhoneNumber(value) {
      
        var phoneno = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
        if (value.match(phoneno)) {
            return true;
        } else {
            return false;
        }


    }
});