<?
$get_email = $_REQUEST["get_email"];

if(strlen($get_email)>2)
{
		include "emailer/sbi_card_GoldnMore.php";
		$headerss  = 'From: SBI Card <no-reply@deal4loans.com>' . "\r\n";
		$headerss .= "Bcc: testthankuse@gmail.com"."\n";
		$headerss .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
		$headerss .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		$SubjectLinecc = "0% fuel surcharge only with SBI Gold & More Credit Card";
		
		if(isset($get_email))
		{
			mail($get_email, $SubjectLinecc, $sbiccMessage, $headerss);
		}

		if(strlen($get_email)>2)
		{
			echo "<script>window.close()"."</script>";
		}
}


?>
