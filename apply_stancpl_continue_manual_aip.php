<?php
require 'scripts/session_check.php';
require 'scripts/db_init.php';
$urltype = $_REQUEST["urltype"];
if ($urltype == "httpsurl") {
    require 'scripts/functionshttps.php';
    $urltypeval = "httpsurl";
} else {
    require 'scripts/functions.php';
    $urltypeval = "";
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $FirstName = $_REQUEST['FirstName'];
    $LastName = $_REQUEST['LastName'];
    echo $Name = $FirstName . " " . $LastName;
    $day = $_REQUEST['day'];
    if (strlen($day) == 1) {
        $day = "0" . $day;
    }
    $month = $_REQUEST['month'];
    if (strlen($month) == 1) {
        $month = "0" . $month;
    }
    $year = $_REQUEST['year'];
    $DOB = $day . "-" . $month . "-" . $year;
    $Gender = $_REQUEST['gender'];
    $Qualification = $_REQUEST['Qualification'];
    $Pancard = $_REQUEST['PAN'];
    $Residential_Status = $_REQUEST['ResType'];
    $Email = trim($_REQUEST['Email']);
    $ResAddress = trim($_REQUEST['ResAddress']);
    $strresiadd = round((strlen($ResAddress) / 2));
    $resiadd = str_split($ResAddress, $strresiadd);
    $ResAddress1 = substr($resiadd[0], 0, 38);
    $ResAddress2 = substr($resiadd[1], 0, 38);
    $Landmark = trim($_REQUEST['Landmark']);
    $ResPin = $_REQUEST['ResPin'];
    $ResCity = $_REQUEST['ResCity'];

    if ($ResCity == "Others") {
        $City = $City_Other;
    }else{
        $City = $ResCity;
    }
    $EmpType = $_REQUEST['EmpType'];
    $Company_Name = $_REQUEST['Organization'];
    $TypeOfOrg = $_REQUEST['TypeOfOrg'];
    $Industry = $_REQUEST['Industry'];
    $SalaryBank = $_REQUEST['SalaryBank'];
    $OffAddress = $_REQUEST['OffAddress'];
    $stroffadd = round((strlen($OffAddress) / 2));
    $officeadd = str_split($OffAddress, $stroffadd);
    $OffAddress1 = substr($officeadd[0], 0, 38);
    $OffAddress2 = substr($officeadd[1], 0, 38);
    $GMI = round($_REQUEST['GMI'] / 12);
    $OffPIN = $_REQUEST['OffPIN'];
    $OffCity = $_REQUEST['OffCity'];
    $OffPhone = $_REQUEST['OffPhone'];
    $Phone = $_REQUEST['Mobile_Number'];
    $Total_Experience = round($_REQUEST['Total_Experience']);
    $MonthsCurrentOrg = round($_REQUEST['Years_In_Company']) * 12;
    $LoanAmount = $_REQUEST['LoanAmount'];
    
    $source = "scb_manual_aip";
    $IsPublic = 1;
    $Allocated = 2;
    $Net_Salary = 300000;
    $Employment_Status=1;
    $Dated=ExactServerdate();
    $Loan_Amount = 500000;
    $IP=ExactCustomerIP();

    $validMobile = is_numeric($Phone);
    if (strlen($Name) > 0 && (preg_match("/1/", $Name) == 1 || preg_match("/0/", $Name) == 1) || preg_match("/!/", $Name) == 1) {
        $validname = 0;
    } else {
        $validname = 1;
    }
    echo "<br>";
    echo strlen($City);

    if (($validMobile == 1) && ($Name != "") && strlen($City) > 0 && $validname == 1) {
        $tomorrow = mktime(0, 0, 0, date("m"), date("d") - 30, date("Y"));
        $days30date = date('Y-m-d', $tomorrow);
        $days30datetime = $days30date . " 00:00:00";
        $currentdate = date('Y-m-d');
        $currentdatetime = date('Y-m-d') . " 23:59:59";

      echo  $getdetails = "select RequestID From Req_Loan_Personal Where ( Mobile_Number not in (9971396361,9811215138,9999047207,9891118553,9999570210,9555060388,9311773341) and Mobile_Number='" . $Phone . "' and Updated_Date between '" . $days30datetime . "' and '" . $currentdatetime . "') order by RequestID DESC"; 
        list($alreadyExist, $myrow) = Mainselectfunc($getdetails, $array = array());
        if ($alreadyExist > 0) {
            $ProductValue = $myrow['RequestID'];
            $_SESSION['Temp_LID'] = $ProductValue;
            echo "Mobile number already exist";
            
            //echo "<script language=javascript>" . " location.href='update-personal-loan-lead.php'" . "</script>";
        } else {
            $CheckSql = "select UserID from wUsers where Email = '" . $Email . "'";
            list($CheckNumRows, $myrow1) = Mainselectfunc($CheckSql, $array = array());
            if ($CheckNumRows > 0) {
                $UserID = $myrow1["UserID"];
                $data = array("UserID" => $UserID, "Name" => $Name, "Email" => $Email, "Employment_Status" => $Employment_Status, "Gender"=>$Gender, "Pancard"=>$Pancard, "Residence_Address"=>$resiadd, "Company_Name" => $Company_Name, "City" => $City, "Mobile_Number" => $Phone, "Net_Salary" => $Net_Salary, "Loan_Amount" => $Loan_Amount, "DOB" => $DOB, "Pincode" => $ResPin, "source" => $source, "IP_Address" => $IP, "Residential_Status" => $Residential_Status, "Dated" => $Dated,"Allocated"=>$Allocated);
            } else {
                $wUsersdata = array("Email" => $Email, "FName" => $Name, "Phone" => $Phone, "Join_Date" => $Dated, "IsPublic" => $IsPublic);
              $UserID1 = Maininsertfunc("wUsers", $wUsersdata);

                $data = array("UserID" => $UserID1, "Name" => $Name, "Email" => $Email, "Employment_Status" => $Employment_Status, "Gender"=>$Gender, "Pancard"=>$Pancard, "Residence_Address"=>$resiadd, "Company_Name" => $Company_Name, "City" => $City, "Mobile_Number" => $Phone,  "Net_Salary" => $Net_Salary, "Loan_Amount" => $Loan_Amount, "DOB" => $DOB, "Pincode" => $ResPin, "source" => $source, "IP_Address" => $IP, "Residential_Status" => $Residential_Status, "Dated" => $Dated,"Allocated"=>$Allocated);
            }
            //echo "<pre>";
            //print_r($data);
            $ProductValue = Maininsertfunc("Req_Loan_Personal", $data);
            //Send SMS
            //ProductSendSMStoRegis($Phone);

        }
    }
}
//die;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Standard Chartered Bank</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/scb-styles.css" type="text/css" rel="stylesheet"  />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" type="text/css" />
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
                    Thank you for applying  for Standard Chartered Bank through deal4loans, we will get back to you soon.

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
                    <ul>
                        <li>Repayment options vary from ECS, PDCs or Account Debit.</li>
                        <li>Easy documentation and quick processing</li>
                        <li>Existing Standard Chartered Personal Loans can be topped up with ease</li>
                    </ul>
                </div>

            </div>
        </section>

    </body>
</html>