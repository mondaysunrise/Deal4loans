<?php

require 'scripts/db_init.php';
require 'scripts/functions.php';

if (strlen($_REQUEST['Name']) > 1) {

    $ProductName = $_REQUEST['Type_Loan'];
    $Name = $_REQUEST['Name'];
    $Phone = $_REQUEST['Phone'];
    $Email = $_REQUEST['Email'];
    $City = $_REQUEST['City'];
    $City_Other = $_REQUEST['OtherCity'];
    $source = $_POST['source'];
    $EmploymentStatus=1;
    $NetSalary = "300000.00";
    $accept = $_POST['accept'];
   	$IP=ExactCustomerIP();
    $Dated = ExactServerdate();
    $tomorrow = mktime(0, 0, 0, date("m"), date("d") - 30, date("Y"));
    $days30date = date('Y-m-d', $tomorrow);
    $days30datetime = $days30date . " 00:00:00";
    $currentdate = date('Y-m-d');
    $currentdatetime = date('Y-m-d') . " 23:59:59";
    
	$dob_year = mktime(0, 0, 0, date("m")  , date("d"), date("Y")-22);
	$dob= date('Y-m-d',$dob_year);


    $getdetails = d4l_ExecQuery("select RequestID From " . $ProductName . " Where ((Mobile_Number='".$Phone."' AND Mobile_Number NOT IN ('9811555306','9971396361','9811215138','9999047207','9873678914','9999570210','9555060388','9311773341','8447380827')) and Updated_Date between '" . $days30datetime . "' and '" . $currentdatetime . "') order by RequestID DESC");
    $alreadyExist = d4l_mysql_num_rows($getdetails);
    $myrow = d4l_mysql_fetch_array($getdetails);
    $cntr = 0;
    if ($alreadyExist > 0) {

        $ProductValue = $myrow[$cntr]['RequestID'];
        $_SESSION['Temp_LID'] = $ProductValue;
       
        echo "<script language=javascript>" . " location.href='http://www.deal4loans.com/quick_apply_thanks.php'" . "</script>";
    } else {
        $CheckSql = d4l_ExecQuery("select UserID from wUsers where Email = '" . $Email . "'");
        $CheckNumRows = d4l_mysql_num_rows($CheckSql);
        $Arrrow = d4l_mysql_fetch_array($CheckSql);

        if ($CheckNumRows > 0) {
            $InsertProductSql = "INSERT INTO $ProductName (Name, Email,Employment_Status, City, City_Other, Mobile_Number, Net_Salary, Dated, source, Updated_Date, IP_Address,DOB) VALUES ('$Name', '$Email', '$EmploymentStatus', '$City', '$City_Other', '$Phone', '$NetSalary','$Dated', '$source','$Dated' ,'$IP', '".$dob."')";
        } else {
            $InsertProductSql = "INSERT INTO $ProductName (Name, Email,Employment_Status, City, City_Other, Mobile_Number, Net_Salary, Dated, source, Updated_Date, IP_Address,DOB) VALUES ('$Name', '$Email', '$EmploymentStatus', '$City', '$City_Other', '$Phone', '$NetSalary', '$Dated', '$source','$Dated' ,'$IP', '".$dob."')";

        }
        $InsertProductQuery = d4l_ExecQuery($InsertProductSql);
        if ($InsertProductQuery) {
            header("location:http://www.deal4loans.com/quick_apply_thanks.php");
        }
    }
}
?>