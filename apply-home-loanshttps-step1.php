<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
require 'scripts/home_loan_eligibility_function.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $Age = $_REQUEST['Age'];

    if (strlen($Age) > 0) {
        $date = date('m-d');
        $year = date('Y') - $Age;
        $dateofbirth = $year . "-" . $date;
    } else {
        $timestamp = strtotime('-30 years');
        $dateofbirth = date('Y-m-d', $timestamp);
    }
    $property_value = $_REQUEST['property_value'];
    $obligations = $_REQUEST['obligations'];
    $Property_Identified = $_REQUEST['Property_Identified'];
    $Property_loc = $_REQUEST['Property_loc'];
    $co_appli = $_REQUEST['co_appli'];
    $co_name = $_REQUEST['co_name'];

    $CoAge = $_REQUEST['CoAge'];
    if (strlen($CoAge) > 0) {
        $date = date('m-d');
        $year = date('Y') - $CoAge;
        $DOB_co = $year . "-" . $date;
    } else {
        $DOB_co = implode("-", $dob_arr_co);
    }

    $co_monthly_income = $_REQUEST['co_monthly_income'];
    $co_obligations = $_REQUEST['co_obligations'];

    $Gender = $_REQUEST['Gender'];
    $Residence_Address = $_REQUEST['Residence_Address'];
    $Pancard = strtoupper($_REQUEST['Pancard']);
    $Pincode = $_REQUEST['Pincode'];

    $InsertProductSql = array("Property_Identified" => $Property_Identified, "DOB" => $dateofbirth, "Property_Loc" => $Property_Loc, "Co_Applicant_Name" => $co_name, "Co_Applicant_DOB" => $DOB_co, "Co_Applicant_Income" => $co_monthly_income, "Co_Applicant_Obligation" => $co_obligations, "Property_Value" => $property_value, "Total_Obligation" => $obligations, "Pincode"=>$Pincode, "Gender"=> $Gender, "Residence_Address"=> $Residence_Address, "Pancard"=> $Pancard);

    $wherecondition = "(RequestID=" . $_REQUEST['ProductValue'] . ")";
    $ProductValue = Mainupdatefunc("Req_Loan_Home", $InsertProductSql, $wherecondition);

    header("Location: apply-homeloanshtpscontinue.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:ice="http://ns.adobe.com/incontextediting">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Home Loan Eligibility Calculator | Housing Loan Eligibility - Deal4loans</title>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
            <meta name="keywords" content="home loan eligibility calculator, housing loan eligibility calculator, home loan eligibility, home loan eligibility calc, best home loan calculator" />
            <meta name="Description" content="Housing Loan Eligibility: Use Deal4loans.com Home Loan Eligibility calculator to know your loan eligibility & the applicable EMI for your home loan amount. Compare home loan eligibility for Top Banks of India online within seconds.">
                <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
                    <link href="css/common-d4l-styles.css" type="text/css" rel="stylesheet"  />
                    <link href="css/home-loan-styles.css" type="text/css" rel="stylesheet"  />
                    <style type="text/css">
                        .auto-style1 {
                            line-height: 120%;
                            font-size: 12.0pt;
                            font-family: "Liberation Serif", serif;
                            margin-left: 0in;
                            margin-right: 0in;
                            margin-top: 0in;
                            margin-bottom: 7.0pt;
                        }
                    </style>
                    </head>
                    <body>
<?php include "middle-menu.php"; ?>
                        <div  class="hl_inner_wrapper">
                            <div style="clear:both;"></div>
                            <div class="d4l_inner_wrapper">
                                <div style="margin:auto; width:100%; margin-top:70px; color:#0a8bd9;">
                                    <div class="common-bread-crumb"><a href="index.php">Home</a> > <a href="home-loans.php">Home Loan</a> > <span>Home Loan Eligibility Calculator </span></div>
                                    <h1 class="hl-h1">Home Loan Eligibility Calculator</h1>
                                </div>
                                <div style="clear:both; height:15px;"></div>
                        <?php
                        include "home-loans-widgethttps-step2.php";
                        ?>
                                <div style="clear:both;"></div>

                            </div>
                        </div>
                        <div style="clear:both; height:15px;"></div>
<?php //include "responsive_footer.php";  ?>
                        </div>
                        <div class="hide_top_menu">
                                <?php
#include "footer_pl.php";
                                include("footer_sub_menu.php");
                                ?>
                        </div>
                    </body>
                    </html>