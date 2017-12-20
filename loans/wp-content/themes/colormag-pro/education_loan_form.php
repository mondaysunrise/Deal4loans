<?php
if($_SERVER['REQUEST_URI'] != "/loans/" && $_SERVER['REQUEST_URI'] != "/loans/category/education-loan/" && (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/category/")) < 1) && (strlen(strpos($_SERVER['REQUEST_URI'], "/loans/?s=")) < 1))
{
	$d4l_section="Wordpress CMS";
if((strlen(strpos($_SERVER['REQUEST_URI'], "/loans/education-loan/sbi-education-loan-interest-rates-documents-sbi-schemes/")) > 0))
{
	$responsiveTheme = "active";
}	
else
{
	$responsiveTheme = "inactive";
}
//$responsiveTheme = "inactive";
if($responsiveTheme == "active")
{
   $TagLine = "Compare Education Loan";
    //include "education_loan_form1.php";
 }
 else
  {
   ?> 
<?php $npostida=get_the_ID();
?>
<? if($npostida==1916) { $TagLine = "Compare Education Loan"; } else { $TagLine = "Compare Education Loan";}?>
    <?php
	}
		include "../education-loan-widget-wp.php";
	
}
	?>