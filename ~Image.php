<?php  if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Car_Loan")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Request_Loan_Car")) > 0))
	 {
		 if((($_REQUEST['flag'])!=1)) { ?>
	 <img src="/images/Car_loan2.gif" usemap="#map_name2" alt="Compare & Choose Car Loan on Deal4Loans">
	 <map name="map_name2">
  <area shape="rect" coords="17,52,120,70" hrEF="/Contents_Car_Loan_Eligibility.php">
   <area shape="rect" coords="17,75,100,95" hrEF="/Request_Loan_Car_New.php">
   <area shape="rect" coords="17,100,100,119" hrEF="/Contents_Car_Loan_Mustread.php">
   <area shape="rect"coords="17,140,80,100" hrEF="/Contents_Car_Loan_Faqs.php">
         </map><? } 
		 else { ?>
		 <img src="/images/Car_loan2.gif" usemap="#map_name2" alt="Compare & Choose Car Loan on Deal4Loans">
	 <map name="map_name2">
  <area shape="rect" coords="17,52,120,70" hrEF="/Contents_Car_Loan_Eligibility.php?flag=1">
   <area shape="rect" coords="17,75,100,95" hrEF="/Request_Loan_Car_New.php?flag=1">
   <area shape="rect" coords="17,100,100,119" hrEF="/Contents_Car_Loan_Mustread.php?flag=1">
   <area shape="rect"coords="17,140,80,100" hrEF="/Contents_Car_Loan_Faqs.php?flag=1">
         </map>
		 <?}?>

	 <? } ?>
	 <?php if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Personal_Loan")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Request_Loan_Personal")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "personal-loan")) > 0))
	 {
		 if((($_REQUEST['flag'])!=1)) { ?>
		 <img src="/images/personal_loan1.gif" usemap="#map_name5" alt="Compare & Choose Personal Loan on Deal4Loans">
	<map name="map_name5">
  <area shape="rect" coords="17,52,120,70" hrEF="/Contents_Personal_Loan_Eligibility.php">
   <area shape="rect" coords="17,75,100,95" hrEF="/Request_Loan_Personal_New.php">
   <area shape="rect" coords="17,100,100,119" hrEF="/Contents_Personal_Loan_Mustread.php">
    <area shape="rect"coords="17,140,80,100" hrEF="/Contents_Personal_Loan_Faqs.php">
        </map><? } 
		 else { ?>
		 <img src="/images/personal_loan1.gif" usemap="#map_name5" alt="Compare & Choose Personal Loan on Deal4Loans">
		<map name="map_name5">
  <area shape="rect" coords="17,52,120,70" hrEF="/Contents_Personal_Loan_Eligibility.php?flag=1">
   <area shape="rect" coords="17,75,100,95" hrEF="/Request_Loan_Personal_New.php?flag=1">
   <area shape="rect" coords="17,100,100,119" hrEF="/Contents_Personal_Loan_Mustread.php?flag=1">
    <area shape="rect"coords="17,140,80,100" hrEF="/Contents_Personal_Loan_Faqs.php?flag=1">
        </map>
		 <?}?>

	 <? } ?>
	 <?php if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Home_Loan")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Request_Loan_Home")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Interest_Rate_Hl")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Contents_home_loan"))) || (strlen(strpos($_SERVER['REQUEST_URI'], "Interest-Rate-Home-Loans")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "home-loan")) > 0) )
	 {
		 if((($_REQUEST['flag'])!=1)) { ?>
		 <img src="/images/Home_loan1.gif" usemap="#map_name6" alt="Compare & Choose Home Loan on Deal4Loans">
	 <map name="map_name6">
  <area shape="rect" coords="17,52,120,70" hrEF="/Contents_Home_Loan_Eligibility.php">
   <area shape="rect" coords="17,75,100,95" hrEF="/Request_Loan_Home_New.php">
   <area shape="rect" coords="17,100,100,119" hrEF="/Contents_Home_Loan_Mustread.php">
   <area shape="rect" coords="17,140,80,100" hrEF="/Contents_Home_Loan_Faqs.php">
        </map><? } 
		 else { ?>
		<img src="/images/Home_loan1.gif" usemap="#map_name6" alt="Compare & Choose Home Loan on Deal4Loans">
	 <map name="map_name6">
  <area shape="rect" coords="17,52,120,70" hrEF="/Contents_Home_Loan_Eligibility.php?flag=1">
   <area shape="rect" coords="17,75,100,95" hrEF="/Request_Loan_Home_New.php?flag=1">
   <area shape="rect" coords="17,100,100,119" hrEF="/Contents_Home_Loan_Mustread.php?flag=1">
   <area shape="rect" coords="17,140,80,100" hrEF="/Contents_Home_Loan_Faqs.php?flag=1">
        </map>
		 <?}?>

	 <? } ?>
	  <?php if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Credit_Card")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Request_Credit_Card")) > 0) )
	 {
		 if((($_REQUEST['flag'])!=1)) { ?>
		 <img src="/images/Credit_card1.gif" usemap="#map_name3" alt="Compare & Choose Credit Card on Deal4Loans">
	 <map name="map_name3">
  <area shape="rect" coords="17,52,120,70" hrEF="/Contents_Credit_Card_Eligibility.php">
   <area shape="rect" coords="17,75,100,95" hrEF="/Request_Credit_Card_New.php">
   <area shape="rect" coords="17,100,100,119" hrEF="/Contents_Credit_Card_Mustread.php">
 <area shape="rect"coords="17,140,80,100" hrEF="/Contents_Credit_Card_Faqs.php">
         </map><? } 
		 else { ?>
		<img src="/images/Credit_card1.gif" usemap="#map_name3"  alt="Compare & Choose Credit Card on Deal4Loans">
	 <map name="map_name3">
  <area shape="rect" coords="17,52,120,70" hrEF="/Contents_Credit_Card_Eligibility.php?flag=1">
   <area shape="rect" coords="17,75,100,95" hrEF="/Request_Credit_Card_New.php?flag=1">
   <area shape="rect" coords="17,100,100,119" hrEF="/Contents_Credit_Card_Mustread.php?flag=1">
 <area shape="rect"coords="17,140,80,100" hrEF="/Contents_Credit_Card_Faqs.php?flag=1">
         </map>
		 <?}?>

	 <? } ?>
	  <?php if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Loan_Against_Property")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Request_Loan_Against_Property")) > 0) )
	 {
		 if((($_REQUEST['flag'])!=1)) { ?>
		<img src="/images/lap1.gif" usemap="#map_name1" alt="Compare & Choose Loan Against Property on Deal4Loans">
	 <map name="map_name1">
  <area shape="rect" coords="17,52,120,70" hrEF="/Contents_Loan_Against_Property_Eligibility.php">
   <area shape="rect" coords="17,75,100,95" hrEF="/Request_Loan_Against_Property_New.php">
   <area shape="rect" coords="17,100,100,119" hrEF="/Contents_Loan_Against_Property_Mustread.php">
        </map><? } 
		 else { ?>
		<img src="/images/lap1.gif" usemap="#map_name1" alt="Compare & Choose Loan Against Property on Deal4Loans">
	 <map name="map_name1">
  <area shape="rect" coords="17,52,120,70" hrEF="/Contents_Loan_Against_Property_Eligibility.php?flag=1">
   <area shape="rect" coords="17,75,100,95" hrEF="/Request_Loan_Against_Property_New.php?flag=1">
   <area shape="rect" coords="17,100,100,119" hrEF="/Contents_Loan_Against_Property_Mustread.php?flag=1">
        </map>
		 <? }?>

	 <? } ?>
	  <?php if((strlen(strpos($_SERVER['REQUEST_URI'], "Contents_Business_Loan")) > 0) || (strlen(strpos($_SERVER['REQUEST_URI'], "Req_Business_Loan")) > 0) )
	 {
		 if((($_REQUEST['flag'])!=1)) { ?>
		<img src="/images/business_loan.gif" usemap="#map_name5" alt="Compare & Choose Business Loan on Deal4Loans">
	<? } 
		 else { ?>
		<img src="/images/business_loan.gif" usemap="#map_name5" alt="Compare & Choose Business Loan on Deal4Loans">
	 
		 <?}?>

	 <? } ?>

