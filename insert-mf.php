<?php

require 'scripts/db_init.php';
require 'scripts/functions.php';
session_start();

if (strlen($_REQUEST['Name']) > 1) {
    $Name = $_REQUEST['Name'];
    $Phone = $_REQUEST['Phone'];
    $Email = $_REQUEST['Email'];
    $City = $_REQUEST['City'];
    $City_Other = $_REQUEST['City_Other'];
    $source = $_REQUEST['source'];
    $accept = $_REQUEST['accept'];
    //$IPAddress = getenv("REMOTE_ADDR");
    $IPAddress=ExactCustomerIP();
    $d = strtotime("+330 min");
    $Dated = date("Y-m-d H:i:s");

    $InsertProductSql = "INSERT INTO Req_Mutual_Fund (Name, Email, City, City_Other, Mobile_Number, Dated, source, IP_Address,Updated_Date) VALUES ('$Name', '$Email', '$City', '$City_Other', '$Phone', '$Dated', '$source', '$IPAddress','$Dated')";
    $InsertProductQuery = ExecQuery($InsertProductSql);


    /* $to = $Email;
      $subject = "deal4loans.com - Mutual Fund";
      $Message = "Thank you applying for Mutual Fund. We will contact you shortly.!";
      $from="contactus@deal4loans.com.com";
      $fromContent="Deal4loans";
      $headers = 'From: '.$fromContent.'<' . $from  . ">";
      $mailSentStatus = mail($to, $subject, $Message, $headers); */
    if ($InsertProductQuery) {
        header("location:http://www.deal4loans.com/mfthanks.php");
    }
}
?>