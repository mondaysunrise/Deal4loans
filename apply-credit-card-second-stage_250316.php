<?php 
require 'scripts/functions.php';
require 'scripts/db_init.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instant E Apply Credit Cards Online in India</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="ccmobile/css/creditcard-lp-mobile-ui.css" type="text/css" rel="stylesheet">
<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link href="ccmobile/css/font-awesome.css" type="text/css" rel="stylesheet" >
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="application/javascript" src="ccmobile/js/validate.js"></script>
<script>
  $(function() {
    var availableTags = [
     'Ahmedabad','Aurangabad','Bangalore','Baroda','Bhiwadi','Bhopal','Bhubneshwar','Chandigarh','Chennai','Cochin','Coimbatore','Cuttack','Dehradun','Delhi','Faridabad','Gaziabad','Gurgaon','Guwahati','Hosur','Hyderabad','Indore','Jabalpur','Jaipur','Jamshedpur','Kanpur','Kochi','Kolkata','Lucknow','Ludhiana','Madurai','Mangalore','Mysore','Mumbai','Nagpur','Nasik','Navi Mumbai','Pune','Ranchi','Raipur','Rewari','Sahibabad','Surat','Thane','Thiruvananthapuram','Trivandrum','Trichy','Vadodara','Vishakapatanam','Vizag', 'Others',
    ];
    $( "#OfficeCity" ).autocomplete({
      source: availableTags
    });
  });</script>
<style type="text/css">
.hintanchor {
	color: #CC0000;
}

</style>
</head>
<body>
<div class="mobile-header">
  <div class="logo"><img src="ccmobile/images/logo-d4l.jpg" width="133" height="48" alt="logo"></div>
</div>
<div class="mobile-main-wrapper">
  <div class="mobile-form-left">
    <div class="head_2 heading-margin-bottom">Confirm Details as per PAN Card</div>
    <div class="product-listing-new"> </div>
    <div style="clear:both;"></div>
    <form method="post" name="ccstep2frm" id="ccstep2frm" action=""  onSubmit="return validateccstep2frm(document.ccstep2frm); ">
      <div class="annual-income-ui-input-wrapper">
        <input name="FirstName" id="FirstName" type="text" class="annual-income-ui-input man-icon float-left" placeholder="First Name" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('FirstnameVal');">
        <div id="FirstnameVal"></div>
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <input name="MiddleName" id="MiddleName" type="text" class="annual-income-ui-input float-left" placeholder="Middle Name" onKeyPress="return isCharsetKey(event);">
      </div>
      <div class="annual-income-ui-input-wrapper margin-a-left">
        <input name="LastName" id="LastName" type="text" class="annual-income-ui-input float-left" placeholder="Last Name" onKeyPress="return isCharsetKey(event);" onkeydown="validateDiv('LastnameVal');">
        <div id="LastnameVal"></div>
      </div>
      <div style="clear:both;"></div>
      <input name="panno" id="panno" type="text" class="annual-income-ui-input pancard-icon float-left" placeholder="PAN card Number" onkeydown="validateDiv('pannoVal');">
      <div id="pannoVal"></div>
      <div class="gender-box"> <strong>Gender</strong>
        <div class="form-required">
          <label for="radio-one">
            <input type="radio" name="Gender" id="radio-one" value="1"/>
            <i></i> <span>Male</span> </label>
          <label for="radio-two">
            <input type="radio" name="Gender" id="radio-two" value="2"/>
            <i></i> <span>Female</span> </label>
        </div>
      </div>
      <div style="clear:both;"></div>
      <hr>
      <div style="clear:both;"></div>
      <div class="head_2">Professional Details</div>
      <p class="smalltext"><img src="ccmobile/images/privacy-lock.png" width="9" height="10" alt="lock"> Your Information is secure with us and will not be shared without your consent</p>
      <div style="clear:both;"></div>
      <div style="clear:both;"></div>
      <select name="Qualification" id="Qualification" class="mobile-ui-input qualification-icon input-bottom-margin" onchange="validateDiv('QualificationVal');">
        <option value="">Please Select Qualification</option>
        <option  value="10 or below">Metric or below</option>
        <option value="Plus 2 or below">Higher secondary </option>
        <option value="Graduate">Graduation</option>
        <option value="Post graduate">Postgraduate and above</option>
      </select>
      <div id="QualificationVal"></div>
      <div style="clear:both;"></div>
      <input name="OfficeAddress1" type="text" class="mobile-ui-input input-bottom-margin location-icon" placeholder="Office Adress Line 1" onkeydown="validateDiv('OfficeAddressVal');">
      <div id="OfficeAddressVal"></div>
      <div style="clear:both;"></div>
      <input name="OfficeAddress2" type="text" class="mobile-ui-input input-bottom-margin location-icon" placeholder="Office Adress Line 2">
      <div style="clear:both;"></div>
      <select name="OfficeCity" id="OfficeCity" class="mobile-ui-input location-icon input-bottom-margin" onchange="showUser(this.value); validateDiv('OfficeCityVal');">
        <option value="">Select Your Office City</option>
        <?php 
$getCarNameSql = "SELECT * FROM sbi_cc_city_state_list WHERE 1 GROUP BY city";
list($numRowsCarName,$getCarNameQuery)=MainselectfuncNew($getCarNameSql,$array = array());

for($cN=0;$cN<$numRowsCarName;$cN++)
{
	$hdfc_car_manufacturer = $getCarNameQuery[$cN]['city'];
	?>
        <option value="<?php echo $hdfc_car_manufacturer; ?>"><?php echo ucwords(strtolower($hdfc_car_manufacturer)); ?></option>
        <?php
}
?>
      </select>
      <div id="OfficeCityVal"></div>
      <div style="clear:both;"></div>
      <select name="OfficePin" id="txtHint" class="mobile-ui-input location-icon input-bottom-margin" onchange="validateDiv('OfficePinVal');">
        <option >Select Office City First</option>
      </select>
      <div id="OfficePinVal"></div>
      <div style="clear:both;"></div>
      <select name="Land_linenumber" id="Land_linenumber" class="mobile-ui-input landline-icon input-bottom-margin" onchange="validateDiv('Land_linenumberVal');">
        <option value="">Select Landline</option>
        <option value="Office">Office</option>
        <option value="Residence">Residence</option>
      </select>
      <div id="Land_linenumberVal"></div>
      <div style="clear:both;"></div>
      <div class="mobile-ui-input landline-icon input-bottom-margin">
        <div class="landlinetext">Landline Number</div>
        <div class="dobwrapper">
          <input name="STD" type="text" class="stdtext" placeholder="STD" onkeydown="validateDiv('STDVal');" onKeyPress="return numOnly(event);">
          <input name="Phone_Number" type="text" class="stdnumbertext " placeholder="Number"  onkeydown="validateDiv('Land_linenumberVal2');" onKeyPress="return numOnly(event);">
          <div id="STDVal"></div>
          <div id="Land_linenumberVal2"></div>
        </div>
        <div style="clear:both;"></div>
      </div>
      <div style="clear:both;"></div>
      <select name="Designation" class="mobile-ui-input input-bottom-margin designation-icon" placeholder="Designation" onchange="validateDiv('DesignationVal');">
        <option value="">Select Designation</option>
        <option value="2 IN COMMANDANT">2 IN COMMANDANT</option>
        <option value="A C P">A C P</option>
        <option value="ADD DIRECTOR GENERAL">ADD DIRECTOR GENERAL</option>
        <option value="ADD PRIN CHIEF CON FORESTS">ADD PRIN CHIEF CON FORESTS</option>
        <option value="ADDITIONAL COMMISNR OF POLICE">ADDITIONAL COMMISNR OF POLICE</option>
        <option value="ADDITIONAL COMMISSIONER">ADDITIONAL COMMISSIONER</option>
        <option value="ADDITIONAL DEP COMMISNR POLICE">ADDITIONAL DEP COMMISNR POLICE</option>
        <option value="ADDITIONAL DEPUTY COMMISSIONER">ADDITIONAL DEPUTY COMMISSIONER</option>
        <option value="ADDITIONAL DGP">ADDITIONAL DGP</option>
        <option value="ADDITIONAL DIR GENERAL POLICE">ADDITIONAL DIR GENERAL POLICE</option>
        <option value="ADDITIONAL DIRECTOR">ADDITIONAL DIRECTOR</option>
        <option value="ADDITIONAL DIRECTOR GENERAL">ADDITIONAL DIRECTOR GENERAL</option>
        <option value="ADDITIONAL DISTRICT MAGISTRATE">ADDITIONAL DISTRICT MAGISTRATE</option>
        <option value="ADDITIONAL DISTT JUDGE">ADDITIONAL DISTT JUDGE</option>
        <option value="ADDITIONAL ELECTION COMMISNR">ADDITIONAL ELECTION COMMISNR</option>
        <option value="ADDITIONAL PROFESSOR">ADDITIONAL PROFESSOR</option>
        <option value="ADDITIONAL REGISTRAR">ADDITIONAL REGISTRAR</option>
        <option value="ADDITIONAL SECRETARY">ADDITIONAL SECRETARY</option>
        <option value="ADDITIONAL SOLICITOR GENERAL">ADDITIONAL SOLICITOR GENERAL</option>
        <option value="ADDL DIRECTOR GEN OF POLICE">ADDL DIRECTOR GEN OF POLICE</option>
        <option value="ADDL. JUSTICE">ADDL. JUSTICE</option>
        <option value="ADGP">ADGP</option>
        <option value="ADHIKARI">ADHIKARI</option>
        <option value="ADMIRAL">ADMIRAL</option>
        <option value="ADMIRAL (NAVY)">ADMIRAL (NAVY)</option>
        <option value="ADVOCATE">ADVOCATE</option>
        <option value="ADVOCATE GENERAL">ADVOCATE GENERAL</option>
        <option value="AIGP">AIGP</option>
        <option value="AIR CHIEF MARSHAL">AIR CHIEF MARSHAL</option>
        <option value="AIR CHIEF MARSHALL AIR FORCE">AIR CHIEF MARSHALL AIR FORCE</option>
        <option value="AIR COMMANDER">AIR COMMANDER</option>
        <option value="AIR COMMANDER (AIR FORCE)">AIR COMMANDER (AIR FORCE)</option>
        <option value="AIR COMMODORE">AIR COMMODORE</option>
        <option value="AIR HOSTESS">AIR HOSTESS</option>
        <option value="AIR MARSHAL">AIR MARSHAL</option>
        <option value="AIR MARSHALL (AIR FORCE)">AIR MARSHALL (AIR FORCE)</option>
        <option value="AIR VICE MARSHAL">AIR VICE MARSHAL</option>
        <option value="AIR VICE MARSHALL  (AIR FORCE)">AIR VICE MARSHALL  (AIR FORCE)</option>
        <option value="AIRCRAFTSMAN">AIRCRAFTSMAN</option>
        <option value="AMBASSADOR">AMBASSADOR</option>
        <option value="ARADALI">ARADALI</option>
        <option value="ARAKSHAK">ARAKSHAK</option>
        <option value="ARM">ARM</option>
        <option value="ARMED GUARD">ARMED GUARD</option>
        <option value="ARMY COMMANDER">ARMY COMMANDER</option>
        <option value="ARTISAN">ARTISAN</option>
        <option value="ASM">ASM</option>
        <option value="ASSISTANT">ASSISTANT</option>
        <option value="ASSISTANT COMMISSIONER">ASSISTANT COMMISSIONER</option>
        <option value="ASSISTANT COMMISSIONER POLICE">ASSISTANT COMMISSIONER POLICE</option>
        <option value="ASSISTANT DIRECTOR">ASSISTANT DIRECTOR</option>
        <option value="ASSISTANT ELECTION COMMISNR">ASSISTANT ELECTION COMMISNR</option>
        <option value="ASSISTANT GENERAL MANAGER">ASSISTANT GENERAL MANAGER</option>
        <option value="ASSISTANT MANAGER">ASSISTANT MANAGER</option>
        <option value="ASSISTANT PROFESSOR">ASSISTANT PROFESSOR</option>
        <option value="ASSISTANT REGIONAL MANAGER">ASSISTANT REGIONAL MANAGER</option>
        <option value="ASSISTANT VICE PRESIDENT">ASSISTANT VICE PRESIDENT</option>
        <option value="ASSOCIATE">ASSOCIATE</option>
        <option value="ASSOCIATE  GENPACT">ASSOCIATE  GENPACT</option>
        <option value="ASSOCIATE DIRECTOR">ASSOCIATE DIRECTOR</option>
        <option value="ASSOCIATE PROFESSOR">ASSOCIATE PROFESSOR</option>
        <option value="ASSOCIATE VICE PRESIDENT">ASSOCIATE VICE PRESIDENT</option>
        <option value="ASST DIR GENERAL">ASST DIR GENERAL</option>
        <option value="ASST DIRECTOR">ASST DIRECTOR</option>
        <option value="ASST GENERAL MANAGER">ASST GENERAL MANAGER</option>
        <option value="ASST GRADE 2">ASST GRADE 2</option>
        <option value="ASST INSPECTOR GENERAL POLICE">ASST INSPECTOR GENERAL POLICE</option>
        <option value="ASST MACHINE OPERATOR">ASST MACHINE OPERATOR</option>
        <option value="ASST REGIONAL MANAGER">ASST REGIONAL MANAGER</option>
        <option value="ASST VICE PRESIDENT">ASST VICE PRESIDENT</option>
        <option value="ASST. CHIEF MEDICAL OFFICER">ASST. CHIEF MEDICAL OFFICER</option>
        <option value="ASST. COMMANDANT">ASST. COMMANDANT</option>
        <option value="ASST. EXECUTIVE ENGINEER">ASST. EXECUTIVE ENGINEER</option>
        <option value="ASST. GENERAL MANAGER">ASST. GENERAL MANAGER</option>
        <option value="ASST.COMMANDANT">ASST.COMMANDANT</option>
        <option value="ASSTT SUB INSPECTOR">ASSTT SUB INSPECTOR</option>
        <option value="ASTROLOGER">ASTROLOGER</option>
        <option value="ATTENDANT">ATTENDANT</option>
        <option value="ATTENDER">ATTENDER</option>
        <option value="ATTOCTER">ATTOCTER</option>
        <option value="ATTOCTER FITTER">ATTOCTER FITTER</option>
        <option value="ATTORNEY GENERAL OF INDIA">ATTORNEY GENERAL OF INDIA</option>
        <option value="BANK GUARD">BANK GUARD</option>
        <option value="BELDAR">BELDAR</option>
        <option value="BELLBOY">BELLBOY</option>
        <option value="BILL COLLECTOR">BILL COLLECTOR</option>
        <option value="BINDER">BINDER</option>
        <option value="BLACKSMITH">BLACKSMITH</option>
        <option value="BRANCH MANAGER">BRANCH MANAGER</option>
        <option value="BRIGADIER">BRIGADIER</option>
        <option value="BRIGADIER (ARMY)">BRIGADIER (ARMY)</option>
        <option value="BUGLERS RIFLEMEN">BUGLERS RIFLEMEN</option>
        <option value="BUSS DEVELOPER GENPACT">BUSS DEVELOPER GENPACT</option>
        <option value="BUTCHER SHOP">BUTCHER SHOP</option>
        <option value="CABIN CREW">CABIN CREW</option>
        <option value="CABINET SECRETARY">CABINET SECRETARY</option>
        <option value="CABLE MAN">CABLE MAN</option>
        <option value="CABLE OPERATOR">CABLE OPERATOR</option>
        <option value="CAMERAMAN">CAMERAMAN</option>
        <option value="CAPTAIN">CAPTAIN</option>
        <option value="CAPTAIN (NAVY)">CAPTAIN (NAVY)</option>
        <option value="CAPTAIN IN HOTEL">CAPTAIN IN HOTEL</option>
        <option value="CAR CLEANER">CAR CLEANER</option>
        <option value="CAR SERVICE STATION">CAR SERVICE STATION</option>
        <option value="CARETAKER">CARETAKER</option>
        <option value="CARPENTER">CARPENTER</option>
        <option value="CASHIER">CASHIER</option>
        <option value="CENTRAL COMMISSIONER">CENTRAL COMMISSIONER</option>
        <option value="CEO">CEO</option>
        <option value="CFO">CFO</option>
        <option value="CGM">CGM</option>
        <option value="CHAIRMAN">CHAIRMAN</option>
        <option value="CHAIRMAN AND MANAGING DIRECTOR">CHAIRMAN AND MANAGING DIRECTOR</option>
        <option value="CHANCELLOR">CHANCELLOR</option>
        <option value="CHEF">CHEF</option>
        <option value="CHEIF VIGILANCE OFFICER">CHEIF VIGILANCE OFFICER</option>
        <option value="CHIEF">CHIEF</option>
        <option value="CHIEF ACCOUNTANT OFFICER">CHIEF ACCOUNTANT OFFICER</option>
        <option value="CHIEF COMMERCIAL OFFICER">CHIEF COMMERCIAL OFFICER</option>
        <option value="CHIEF COMMISSIONER">CHIEF COMMISSIONER</option>
        <option value="CHIEF CONSERVATOR OF FORESTS">CHIEF CONSERVATOR OF FORESTS</option>
        <option value="CHIEF EDITOR">CHIEF EDITOR</option>
        <option value="CHIEF ELECTION COMMISSIONER">CHIEF ELECTION COMMISSIONER</option>
        <option value="CHIEF ENGINEER">CHIEF ENGINEER</option>
        <option value="CHIEF EXECUTIVE OFFICER">CHIEF EXECUTIVE OFFICER</option>
        <option value="CHIEF FINANCIAL OFFICER">CHIEF FINANCIAL OFFICER</option>
        <option value="CHIEF GENERAL MANAGER">CHIEF GENERAL MANAGER</option>
        <option value="CHIEF GEOPHYSICIST">CHIEF GEOPHYSICIST</option>
        <option value="CHIEF INFORMATION OFFICER">CHIEF INFORMATION OFFICER</option>
        <option value="CHIEF INTERNAL AUDITOR">CHIEF INTERNAL AUDITOR</option>
        <option value="CHIEF JUSTICE">CHIEF JUSTICE</option>
        <option value="CHIEF LEGAL OFFICER">CHIEF LEGAL OFFICER</option>
        <option value="CHIEF MANAGER">CHIEF MANAGER</option>
        <option value="CHIEF MARKETING OFFICER">CHIEF MARKETING OFFICER</option>
        <option value="CHIEF MATERIALS MANAGER">CHIEF MATERIALS MANAGER</option>
        <option value="CHIEF MECHANICHAL ENGINEER">CHIEF MECHANICHAL ENGINEER</option>
        <option value="CHIEF MEDICAL OFFICER">CHIEF MEDICAL OFFICER</option>
        <option value="CHIEF MINISTER">CHIEF MINISTER</option>
        <option value="CHIEF OF ARMY STAFF">CHIEF OF ARMY STAFF</option>
        <option value="CHIEF OPERATING OFFICER">CHIEF OPERATING OFFICER</option>
        <option value="CHIEF PETTY OFFICER">CHIEF PETTY OFFICER</option>
        <option value="CHIEF PROJECT MANAGER">CHIEF PROJECT MANAGER</option>
        <option value="CHIEF REGISTRAR OF COMPANIES">CHIEF REGISTRAR OF COMPANIES</option>
        <option value="CHIEF RISK OFFICER">CHIEF RISK OFFICER</option>
        <option value="CHIEF SAFETY OFFICER">CHIEF SAFETY OFFICER</option>
        <option value="CHIEF SECRETARY">CHIEF SECRETARY</option>
        <option value="CHIEF TECHNICAL OFFICER">CHIEF TECHNICAL OFFICER</option>
        <option value="CHIEF VIGILANCE OFFICER">CHIEF VIGILANCE OFFICER</option>
        <option value="CHILD EVANGELISTS">CHILD EVANGELISTS</option>
        <option value="CHIT FUND">CHIT FUND</option>
        <option value="CIO">CIO</option>
        <option value="CIVIL JUDGE">CIVIL JUDGE</option>
        <option value="CLASS 4 EMPLOYEES">CLASS 4 EMPLOYEES</option>
        <option value="CLEANER">CLEANER</option>
        <option value="CLERICAL">CLERICAL</option>
        <option value="CLERICAL STAFF">CLERICAL STAFF</option>
        <option value="CLERK">CLERK</option>
        <option value="CLO">CLO</option>
        <option value="CMO">CMO</option>
        <option value="COACHING CENTER">COACHING CENTER</option>
        <option value="COLLECTION AGENCIES">COLLECTION AGENCIES</option>
        <option value="COLLECTION AGENT">COLLECTION AGENT</option>
        <option value="COLONEL">COLONEL</option>
        <option value="COLONEL (ARMY)">COLONEL (ARMY)</option>
        <option value="COMI1">COMI1</option>
        <option value="COMI2">COMI2</option>
        <option value="COMI3">COMI3</option>
        <option value="COMI4">COMI4</option>
        <option value="COMMANDANT">COMMANDANT</option>
        <option value="COMMANDER">COMMANDER</option>
        <option value="COMMANDER (NAVY)">COMMANDER (NAVY)</option>
        <option value="COMMISSION AGENT">COMMISSION AGENT</option>
        <option value="COMMISSIONER">COMMISSIONER</option>
        <option value="COMMISSIONER OF POLICE">COMMISSIONER OF POLICE</option>
        <option value="COMMODORE">COMMODORE</option>
        <option value="COMMODORE (NAVY)">COMMODORE (NAVY)</option>
        <option value="COMPANY HAVILDAR MAJOR">COMPANY HAVILDAR MAJOR</option>
        <option value="COMPANY SECRETARY">COMPANY SECRETARY</option>
        <option value="CONDUCTOR">CONDUCTOR</option>
        <option value="CONSERVATOR OF FORESTS">CONSERVATOR OF FORESTS</option>
        <option value="CONSTABLE">CONSTABLE</option>
        <option value="CONSUL">CONSUL</option>
        <option value="CONSUL GENERAL">CONSUL GENERAL</option>
        <option value="CONTRACTOR">CONTRACTOR</option>
        <option value="CONTROLLER">CONTROLLER</option>
        <option value="COO">COO</option>
        <option value="COOLI">COOLI</option>
        <option value="COOLIE">COOLIE</option>
        <option value="CORPORAL">CORPORAL</option>
        <option value="CORRESPONDENT">CORRESPONDENT</option>
        <option value="CORRESPONDENT OF NEWSPAPERS">CORRESPONDENT OF NEWSPAPERS</option>
        <option value="COUNTRY DIRECTOR">COUNTRY DIRECTOR</option>
        <option value="COUNTRY MANAGER">COUNTRY MANAGER</option>
        <option value="CRAFTSMAN">CRAFTSMAN</option>
        <option value="CRANE OPERATOR">CRANE OPERATOR</option>
        <option value="CREATIVE DIRECTOR">CREATIVE DIRECTOR</option>
        <option value="CREATIVE DIRECTOR MEDIA">CREATIVE DIRECTOR MEDIA</option>
        <option value="CREATIVE HEAD">CREATIVE HEAD</option>
        <option value="CREATIVE HEAD ( AD AGENCY)">CREATIVE HEAD ( AD AGENCY)</option>
        <option value="CRO">CRO</option>
        <option value="CTO">CTO</option>
        <option value="CYCLE REPAIR SHOP">CYCLE REPAIR SHOP</option>
        <option value="DAFFADAR">DAFFADAR</option>
        <option value="DAFTARY">DAFTARY</option>
        <option value="DAFTRY">DAFTRY</option>
        <option value="DAFTRYHELPER">DAFTRYHELPER</option>
        <option value="DEAN">DEAN</option>
        <option value="DELIVERY MAN">DELIVERY MAN</option>
        <option value="DEPUTY CHIEF MANAGER">DEPUTY CHIEF MANAGER</option>
        <option value="DEPUTY CHIEF MINISTER">DEPUTY CHIEF MINISTER</option>
        <option value="DEPUTY CHIEF OF MISSION">DEPUTY CHIEF OF MISSION</option>
        <option value="DEPUTY COMMISSIONER">DEPUTY COMMISSIONER</option>
        <option value="DEPUTY COMMISSIONER OF POLICE">DEPUTY COMMISSIONER OF POLICE</option>
        <option value="DEPUTY DIRECTOR">DEPUTY DIRECTOR</option>
        <option value="DEPUTY DIRECTOR GENERAL">DEPUTY DIRECTOR GENERAL</option>
        <option value="DEPUTY ELECTION COMMISSIONER">DEPUTY ELECTION COMMISSIONER</option>
        <option value="DEPUTY EXECUTIVE ENGINEER">DEPUTY EXECUTIVE ENGINEER</option>
        <option value="DEPUTY GENERAL MANAGER">DEPUTY GENERAL MANAGER</option>
        <option value="DEPUTY GOVERNOR">DEPUTY GOVERNOR</option>
        <option value="DEPUTY HIGH COMMISSIONER">DEPUTY HIGH COMMISSIONER</option>
        <option value="DEPUTY INSP GENERAL OF POLICE">DEPUTY INSP GENERAL OF POLICE</option>
        <option value="DEPUTY INSPECTOR GENERAL">DEPUTY INSPECTOR GENERAL</option>
        <option value="DEPUTY MANAGING DIRECTOR">DEPUTY MANAGING DIRECTOR</option>
        <option value="DEPUTY PERM REPRESENTATIVE">DEPUTY PERM REPRESENTATIVE</option>
        <option value="DEPUTY SECRETARY">DEPUTY SECRETARY</option>
        <option value="DEPUTY VICE PRESIDENT">DEPUTY VICE PRESIDENT</option>
        <option value="DEPUTY COMMISSIONER">DEPUTY COMMISSIONER</option>
        <option value="DESIGN">DESIGN</option>
        <option value="DESIGT">DESIGT</option>
        <option value="DESIT">DESIT</option>
        <option value="DESPATCH RIDER">DESPATCH RIDER</option>
        <option value="DETECTIVE">DETECTIVE</option>
        <option value="DGM">DGM</option>
        <option value="DHABA EMPLOYEE">DHABA EMPLOYEE</option>
        <option value="DIRECTOR">DIRECTOR</option>
        <option value="DIRECTOR GENERAL">DIRECTOR GENERAL</option>
        <option value="DIRECTOR GENERAL OF FORESTS">DIRECTOR GENERAL OF FORESTS</option>
        <option value="DIRECTOR GENERAL OF POLICE">DIRECTOR GENERAL OF POLICE</option>
        <option value="DIRECTOR INTELLIGENCE BUREAU">DIRECTOR INTELLIGENCE BUREAU</option>
        <option value="DIRECTOR OF TOURISM">DIRECTOR OF TOURISM</option>
        <option value="DISPATCH RIDER">DISPATCH RIDER</option>
        <option value="DISTRICT COLLECTOR">DISTRICT COLLECTOR</option>
        <option value="DISTRICT JUDGE">DISTRICT JUDGE</option>
        <option value="DISTRICT MAGISTRATE">DISTRICT MAGISTRATE</option>
        <option value="DISTRICT OFFICER">DISTRICT OFFICER</option>
        <option value="DIVISIONAL COMMISSIONER">DIVISIONAL COMMISSIONER</option>
        <option value="DMD">DMD</option>
        <option value="DRESSER">DRESSER</option>
        <option value="DRILLER">DRILLER</option>
        <option value="DRIVER">DRIVER</option>
        <option value="DURBAAN">DURBAAN</option>
        <option value="DY CHIEF MANAGER">DY CHIEF MANAGER</option>
        <option value="DY DIRECTOR ENGINEER">DY DIRECTOR ENGINEER</option>
        <option value="DY GENERAL MANAGER">DY GENERAL MANAGER</option>
        <option value="DY INSPECTOR GENERAL OF POLICE">DY INSPECTOR GENERAL OF POLICE</option>
        <option value="DY REGISTRAR">DY REGISTRAR</option>
        <option value="DY SECRETARY">DY SECRETARY</option>
        <option value="DY. ACCOUNT GENERAL">DY. ACCOUNT GENERAL</option>
        <option value="DY. CHIEF ENGINEER">DY. CHIEF ENGINEER</option>
        <option value="DY. CHIEF MATERIALS MANAGER">DY. CHIEF MATERIALS MANAGER</option>
        <option value="DY. CHIEF PERSONNEL">DY. CHIEF PERSONNEL</option>
        <option value="DY. CHIEF SECTION OFFICER">DY. CHIEF SECTION OFFICER</option>
        <option value="DY. COMMANDANT">DY. COMMANDANT</option>
        <option value="DY. CONTROLLER">DY. CONTROLLER</option>
        <option value="DY. GENERAL MANAGER">DY. GENERAL MANAGER</option>
        <option value="DY. MANAGER">DY. MANAGER</option>
        <option value="DY. SUPERINTENDENT ENGINEER">DY. SUPERINTENDENT ENGINEER</option>
        <option value="DY.CHIEF ACCOUNT">DY.CHIEF ACCOUNT</option>
        <option value="DY.COMMANDANT">DY.COMMANDANT</option>
        <option value="ECONOMIC ADVISOR">ECONOMIC ADVISOR</option>
        <option value="EDITOR">EDITOR</option>
        <option value="EDITORS">EDITORS</option>
        <option value="ELECTION COMMISSIONER">ELECTION COMMISSIONER</option>
        <option value="ELECTRICIAN">ELECTRICIAN</option>
        <option value="ENGINEER SURVEYOR (CAT B)">ENGINEER SURVEYOR (CAT B)</option>
        <option value="ENROLLED FOLLOWER">ENROLLED FOLLOWER</option>
        <option value="EXE DIRECTOR AND COO">EXE DIRECTOR AND COO</option>
        <option value="EXECUTIVE">EXECUTIVE</option>
        <option value="EXECUTIVE CHIEF">EXECUTIVE CHIEF</option>
        <option value="EXECUTIVE DIRECTOR">EXECUTIVE DIRECTOR</option>
        <option value="EXECUTIVE ENGINEER">EXECUTIVE ENGINEER</option>
        <option value="EXECUTIVE GENPACT">EXECUTIVE GENPACT</option>
        <option value="EXECUTIVE PRESIDENT">EXECUTIVE PRESIDENT</option>
        <option value="EXECUTIVE VICE PRESIDENT">EXECUTIVE VICE PRESIDENT</option>
        <option value="EXECUTTIVE CHIEF">EXECUTTIVE CHIEF</option>
        <option value="FACTORY MANAGER">FACTORY MANAGER</option>
        <option value="FIELD MARSHAL">FIELD MARSHAL</option>
        <option value="FIELD SALES EXECUTIVE">FIELD SALES EXECUTIVE</option>
        <option value="FINANCE CONTROLLER">FINANCE CONTROLLER</option>
        <option value="FINANCE DIRECTOR">FINANCE DIRECTOR</option>
        <option value="FINANCIAL COMMISSIONER">FINANCIAL COMMISSIONER</option>
        <option value="FIRE MAN">FIRE MAN</option>
        <option value="FIRE OPERATOR">FIRE OPERATOR</option>
        <option value="FIREMAN">FIREMAN</option>
        <option value="FIREMEN">FIREMEN</option>
        <option value="FITTER">FITTER</option>
        <option value="FLYING LIEUTENANT">FLYING LIEUTENANT</option>
        <option value="FLYING OFFICER">FLYING OFFICER</option>
        <option value="FOLLOWER">FOLLOWER</option>
        <option value="FREELANCER">FREELANCER</option>
        <option value="GANGMEN">GANGMEN</option>
        <option value="GARAGE">GARAGE</option>
        <option value="GARDENER">GARDENER</option>
        <option value="GENERAL">GENERAL</option>
        <option value="GENERAL (ARMY)">GENERAL (ARMY)</option>
        <option value="GENERAL ATTENDANT">GENERAL ATTENDANT</option>
        <option value="GENERAL ATTENDENT">GENERAL ATTENDENT</option>
        <option value="GENERAL COUNSEL">GENERAL COUNSEL</option>
        <option value="GENERAL MANAGER">GENERAL MANAGER</option>
        <option value="GENERAL SECRETARY">GENERAL SECRETARY</option>
        <option value="GM">GM</option>
        <option value="GOVERNOR">GOVERNOR</option>
        <option value="GRADE 1">GRADE 1</option>
        <option value="GRADE 10">GRADE 10</option>
        <option value="GRADE 11">GRADE 11</option>
        <option value="GRADE 2">GRADE 2</option>
        <option value="GRADE 3">GRADE 3</option>
        <option value="GRADE 4">GRADE 4</option>
        <option value="GRADE 5">GRADE 5</option>
        <option value="GRADE 6">GRADE 6</option>
        <option value="GRADE 7">GRADE 7</option>
        <option value="GRADE 8">GRADE 8</option>
        <option value="GRADE 9">GRADE 9</option>
        <option value="GRADE IV">GRADE IV</option>
        <option value="GROUP CAPTAIN">GROUP CAPTAIN</option>
        <option value="GROUP CAPTAIN (AIR FORCE) ">GROUP CAPTAIN (AIR FORCE) </option>
        <option value="GROUP GENERAL COUNSEL">GROUP GENERAL COUNSEL</option>
        <option value="GUARD">GUARD</option>
        <option value="GUN MAN">GUN MAN</option>
        <option value="GUNMAN">GUNMAN</option>
        <option value="GYM EMPLOYEE">GYM EMPLOYEE</option>
        <option value="GYM INSTRUCTOR">GYM INSTRUCTOR</option>
        <option value="HALWAI">HALWAI</option>
        <option value="HAVILDAR">HAVILDAR</option>
        <option value="HAWALDAR">HAWALDAR</option>
        <option value="HEAD">HEAD</option>
        <option value="HEAD CASHIER">HEAD CASHIER</option>
        <option value="HEAD CONSTABLE">HEAD CONSTABLE</option>
        <option value="HEAD MASSENGER">HEAD MASSENGER</option>
        <option value="HEAD MESSENGER">HEAD MESSENGER</option>
        <option value="HEALTH CLUBS EMPLOYEE">HEALTH CLUBS EMPLOYEE</option>
        <option value="HELPER">HELPER</option>
        <option value="HIGH COMMISSIONER">HIGH COMMISSIONER</option>
        <option value="HIGH SKILLED OPERATOR">HIGH SKILLED OPERATOR</option>
        <option value="HOUSE WIFE">HOUSE WIFE</option>
        <option value="IAS">IAS</option>
        <option value="IFS">IFS</option>
        <option value="INDUSTRIAL TRAINEE">INDUSTRIAL TRAINEE</option>
        <option value="INSPECTOR">INSPECTOR</option>
        <option value="INSPECTOR GENERAL">INSPECTOR GENERAL</option>
        <option value="INSPECTOR GENERAL OF POLICE">INSPECTOR GENERAL OF POLICE</option>
        <option value="INSURANCE AGENT">INSURANCE AGENT</option>
        <option value="INTERN 1">INTERN 1</option>
        <option value="INTERN 2">INTERN 2</option>
        <option value="INTERN 3">INTERN 3</option>
        <option value="IPS">IPS</option>
        <option value="JAMAADAR">JAMAADAR</option>
        <option value="JOINT COMMISSIONER">JOINT COMMISSIONER</option>
        <option value="JOINT COMMISSIONER OF POLICE">JOINT COMMISSIONER OF POLICE</option>
        <option value="JOINT DEPUTY DIRECTOR GENERAL">JOINT DEPUTY DIRECTOR GENERAL</option>
        <option value="JOINT DIRECTOR">JOINT DIRECTOR</option>
        <option value="JOINT ELECTION COMMISSIONER">JOINT ELECTION COMMISSIONER</option>
        <option value="JOINT GENERAL MANAGER">JOINT GENERAL MANAGER</option>
        <option value="JOINT PRESIDENT">JOINT PRESIDENT</option>
        <option value="JOINT SECRETARY">JOINT SECRETARY</option>
        <option value="JOURNALISTS">JOURNALISTS</option>
        <option value="JOURNLISTS">JOURNLISTS</option>
        <option value="JT EXECUTIVE PRESIDENT">JT EXECUTIVE PRESIDENT</option>
        <option value="JUDGE">JUDGE</option>
        <option value="JUNIOR EXECUTIVE">JUNIOR EXECUTIVE</option>
        <option value="JUNIOR WARRANT OFFICER">JUNIOR WARRANT OFFICER</option>
        <option value="JUSTICE">JUSTICE</option>
        <option value="KHALASI">KHALASI</option>
        <option value="LAB ATTENDANT">LAB ATTENDANT</option>
        <option value="LABOUR">LABOUR</option>
        <option value="LABOUR DELIVERY MAN">LABOUR DELIVERY MAN</option>
        <option value="LANCE DAFFADAR">LANCE DAFFADAR</option>
        <option value="LANCE NAIK">LANCE NAIK</option>
        <option value="LAWYER">LAWYER</option>
        <option value="LEADING AIRCRAFTSMAN">LEADING AIRCRAFTSMAN</option>
        <option value="LEADING SEAMAN">LEADING SEAMAN</option>
        <option value="LECTURER">LECTURER</option>
        <option value="LIBRARIAN">LIBRARIAN</option>
        <option value="LIEUTENANT">LIEUTENANT</option>
        <option value="LIEUTENANT COMMANDER">LIEUTENANT COMMANDER</option>
        <option value="LIEUTENANT GENERAL">LIEUTENANT GENERAL</option>
        <option value="LIEUTENANT GENERAL (ARMY)">LIEUTENANT GENERAL (ARMY)</option>
        <option value="LIEUTENANT GOVERNOR">LIEUTENANT GOVERNOR</option>
        <option value="LINE MATE">LINE MATE</option>
        <option value="LINEMATE">LINEMATE</option>
        <option value="LOCO PILOT">LOCO PILOT</option>
        <option value="LOCO PILOT TURNER">LOCO PILOT TURNER</option>
        <option value="LT. COLONEL">LT. COLONEL</option>
        <option value="LT. COLONEL (ARMY)">LT. COLONEL (ARMY)</option>
        <option value="LT. GENERAL">LT. GENERAL</option>
        <option value="MACHINE OPERATOR">MACHINE OPERATOR</option>
        <option value="MACHINIST">MACHINIST</option>
        <option value="MAGISTRATE">MAGISTRATE</option>
        <option value="MAID">MAID</option>
        <option value="MAJOR">MAJOR</option>
        <option value="MAJOR GENERAL">MAJOR GENERAL</option>
        <option value="MAJOR GENERAL (ARMY)">MAJOR GENERAL (ARMY)</option>
        <option value="MANAGER">MANAGER</option>
        <option value="MANAGING DIRECTOR">MANAGING DIRECTOR</option>
        <option value="MARRIAGE BUREAU">MARRIAGE BUREAU</option>
        <option value="MASSENGER">MASSENGER</option>
        <option value="MASTER CHIEF PETTY OFF 1ST CLS">MASTER CHIEF PETTY OFF 1ST CLS</option>
        <option value="MASTER CHIEF PETTY OFF 2ND CLS">MASTER CHIEF PETTY OFF 2ND CLS</option>
        <option value="MASTER CHIEF PETTY OFFICER">MASTER CHIEF PETTY OFFICER</option>
        <option value="MASTER WARRANT OFFICER">MASTER WARRANT OFFICER</option>
        <option value="MAZDOOR">MAZDOOR</option>
        <option value="MD">MD</option>
        <option value="MECHANIC">MECHANIC</option>
        <option value="MEMBER">MEMBER</option>
        <option value="MEMBER CUN SPECIAL SECRETARY">MEMBER CUN SPECIAL SECRETARY</option>
        <option value="MEMBER OF PARLIAMENT">MEMBER OF PARLIAMENT</option>
        <option value="MESS ENGER">MESS ENGER</option>
        <option value="MESSENGER">MESSENGER</option>
        <option value="METERREADER">METERREADER</option>
        <option value="MINISTER">MINISTER</option>
        <option value="MISTRY">MISTRY</option>
        <option value="MONOCASTER">MONOCASTER</option>
        <option value="MOULDER">MOULDER</option>
        <option value="MULE DRIVERS">MULE DRIVERS</option>
        <option value="MUNICIPAL CHIEF AUDITOR">MUNICIPAL CHIEF AUDITOR</option>
        <option value="NAIB SUBEDAR">NAIB SUBEDAR</option>
        <option value="NAIK">NAIK</option>
        <option value="NALBAND">NALBAND</option>
        <option value="NATIONAL HEAD">NATIONAL HEAD</option>
        <option value="NATIONAL PROJECT HEAD">NATIONAL PROJECT HEAD</option>
        <option value="NATIONAL SALES MANAGER">NATIONAL SALES MANAGER</option>
        <option value="NATIONAL SERVICES HEAD">NATIONAL SERVICES HEAD</option>
        <option value="NATIONAL TRAINING MANAGER">NATIONAL TRAINING MANAGER</option>
        <option value="NAVIKS">NAVIKS</option>
        <option value="NGO OWNER">NGO OWNER</option>
        <option value="NURSE">NURSE</option>
        <option value="NURSING ORDERLY">NURSING ORDERLY</option>
        <option value="OFFICE ASSISTANT">OFFICE ASSISTANT</option>
        <option value="OFFICERS">OFFICERS</option>
        <option value="OFFICERS I">OFFICERS I</option>
        <option value="OFFICERS III">OFFICERS III</option>
        <option value="OPERATOR">OPERATOR</option>
        <option value="PAAN WALLA">PAAN WALLA</option>
        <option value="PAINTER">PAINTER</option>
        <option value="PARTNER">PARTNER</option>
        <option value="PARTNER ( CONSULTANCY )">PARTNER ( CONSULTANCY )</option>
        <option value="PAWN BROKER">PAWN BROKER</option>
        <option value="PCO BOOTH">PCO BOOTH</option>
        <option value="PEON">PEON</option>
        <option value="PERMANENT REPRESENTATIVE">PERMANENT REPRESENTATIVE</option>
        <option value="PETTY OFFICER">PETTY OFFICER</option>
        <option value="PHONE MECHANIC">PHONE MECHANIC</option>
        <option value="PILOTS">PILOTS</option>
        <option value="PLANT OPERATOR">PLANT OPERATOR</option>
        <option value="PLUMBER">PLUMBER</option>
        <option value="POLICE CONSTABLE">POLICE CONSTABLE</option>
        <option value="POLICE HEAD CONSTABLE">POLICE HEAD CONSTABLE</option>
        <option value="POLICEMEN">POLICEMEN</option>
        <option value="POLITICIANS">POLITICIANS</option>
        <option value="PRADHAN ADHIKARI">PRADHAN ADHIKARI</option>
        <option value="PRADHAN NAVIKS">PRADHAN NAVIKS</option>
        <option value="PRADHAN SAHAYAK ENGINEER">PRADHAN SAHAYAK ENGINEER</option>
        <option value="PRADHAN YANTRIK">PRADHAN YANTRIK</option>
        <option value="PRESIDENT">PRESIDENT</option>
        <option value="PRESIDENT AND CEO">PRESIDENT AND CEO</option>
        <option value="PRESIDENT AND CTO">PRESIDENT AND CTO</option>
        <option value="PRIEST">PRIEST</option>
        <option value="PRIESTS">PRIESTS</option>
        <option value="PRINC CHIEF CONSERVATOR FOREST">PRINC CHIEF CONSERVATOR FOREST</option>
        <option value="PRINC CHIEF GENERAL MANAGER">PRINC CHIEF GENERAL MANAGER</option>
        <option value="PRINCIPAL">PRINCIPAL</option>
        <option value="PRINCIPAL COMMISSIONER">PRINCIPAL COMMISSIONER</option>
        <option value="PRINCIPAL DIRECTOR">PRINCIPAL DIRECTOR</option>
        <option value="PRINCIPAL ENGINEER">PRINCIPAL ENGINEER</option>
        <option value="PRINCIPAL FINANCE OFFICER">PRINCIPAL FINANCE OFFICER</option>
        <option value="PRINCIPAL SCIENTIST">PRINCIPAL SCIENTIST</option>
        <option value="PRINCIPAL SECRETARY">PRINCIPAL SECRETARY</option>
        <option value="PRINICPAL SCIENTIST">PRINICPAL SCIENTIST</option>
        <option value="PRO VICE CHANCELLOR">PRO VICE CHANCELLOR</option>
        <option value="PROBATIONARY OFFICER">PROBATIONARY OFFICER</option>
        <option value="PROC DEVELOPER GENPACT">PROC DEVELOPER GENPACT</option>
        <option value="PROCESS ASSOCIATE GENPACT">PROCESS ASSOCIATE GENPACT</option>
        <option value="PROFESSOR">PROFESSOR</option>
        <option value="PROJECT DIRECTOR">PROJECT DIRECTOR</option>
        <option value="PROPERTY DEALER">PROPERTY DEALER</option>
        <option value="PUMP DRIVER">PUMP DRIVER</option>
        <option value="PUROHITS">PUROHITS</option>
        <option value="QWERT">QWERT</option>
        <option value="RANGER">RANGER</option>
        <option value="READER">READER</option>
        <option value="REAR ADMIRAL">REAR ADMIRAL</option>
        <option value="REAR ADMIRAL (NAVY)">REAR ADMIRAL (NAVY)</option>
        <option value="REGIMENTAL HAVILDAR MAJOR">REGIMENTAL HAVILDAR MAJOR</option>
        <option value="REGIMENTAL QRTR MSTER HAVILDAR">REGIMENTAL QRTR MSTER HAVILDAR</option>
        <option value="REGIONAL COMMISIONER HEAD">REGIONAL COMMISIONER HEAD</option>
        <option value="REGIONAL HEAD">REGIONAL HEAD</option>
        <option value="REGIONAL MANAGER">REGIONAL MANAGER</option>
        <option value="REGISTRAR">REGISTRAR</option>
        <option value="REIKI CENTRES">REIKI CENTRES</option>
        <option value="REPORTER">REPORTER</option>
        <option value="RIGGER">RIGGER</option>
        <option value="SAHAYAK ENGINEER">SAHAYAK ENGINEER</option>
        <option value="SCIENTIFIC OFFICER">SCIENTIFIC OFFICER</option>
        <option value="SCIENTIST">SCIENTIST</option>
        <option value="SCIENTIST A">SCIENTIST A</option>
        <option value="SCIENTIST B">SCIENTIST B</option>
        <option value="SCIENTIST C">SCIENTIST C</option>
        <option value="SCIENTIST D">SCIENTIST D</option>
        <option value="SCIENTIST E">SCIENTIST E</option>
        <option value="SCIENTIST F">SCIENTIST F</option>
        <option value="SCIENTIST I">SCIENTIST I</option>
        <option value="SCIENTIST II">SCIENTIST II</option>
        <option value="SCIENTIST III">SCIENTIST III</option>
        <option value="SCIENTIST IV">SCIENTIST IV</option>
        <option value="SCIENTIST V">SCIENTIST V</option>
        <option value="SCIENTIST VI">SCIENTIST VI</option>
        <option value="SEAMAN I">SEAMAN I</option>
        <option value="SEAMAN II">SEAMAN II</option>
        <option value="SECRETARY">SECRETARY</option>
        <option value="SECRETARY (CAT B)">SECRETARY (CAT B)</option>
        <option value="SECRETARY AND COMMISSIONER">SECRETARY AND COMMISSIONER</option>
        <option value="SECRETARY GENERAL">SECRETARY GENERAL</option>
        <option value="SECURITY ASSISTANTS">SECURITY ASSISTANTS</option>
        <option value="SECURITY GUARD">SECURITY GUARD</option>
        <option value="SECURITY PROVIDERS">SECURITY PROVIDERS</option>
        <option value="SEMI SKILLED OPERATOR">SEMI SKILLED OPERATOR</option>
        <option value="SEMI SKILLED WORKER">SEMI SKILLED WORKER</option>
        <option value="SENIOR ASST COMMISNR OF POLICE">SENIOR ASST COMMISNR OF POLICE</option>
        <option value="SENIOR BRANCH MANAGER">SENIOR BRANCH MANAGER</option>
        <option value="SENIOR DEPUTY DIRECTOR GENERAL">SENIOR DEPUTY DIRECTOR GENERAL</option>
        <option value="SENIOR DIRECTOR">SENIOR DIRECTOR</option>
        <option value="SENIOR EXECUTIVE GENPACT">SENIOR EXECUTIVE GENPACT</option>
        <option value="SENIOR GENERAL MANAGER">SENIOR GENERAL MANAGER</option>
        <option value="SENIOR HEAD MESSENGER">SENIOR HEAD MESSENGER</option>
        <option value="SENIOR MANAGER">SENIOR MANAGER</option>
        <option value="SENIOR OPERATOR">SENIOR OPERATOR</option>
        <option value="SENIOR POLICE CONSTABLE">SENIOR POLICE CONSTABLE</option>
        <option value="SENIOR PROJECT DIRECTOR">SENIOR PROJECT DIRECTOR</option>
        <option value="SENIOR SCIENTIST">SENIOR SCIENTIST</option>
        <option value="SENIOR SECTION ENGINEER">SENIOR SECTION ENGINEER</option>
        <option value="SENIOR SUPERINTNDNT OF POLICE">SENIOR SUPERINTNDNT OF POLICE</option>
        <option value="SENIOR VICE PRESIDENT">SENIOR VICE PRESIDENT</option>
        <option value="SEPOY">SEPOY</option>
        <option value="SERGEANT">SERGEANT</option>
        <option value="SERGENT">SERGENT</option>
        <option value="SKILLED OPERATOR">SKILLED OPERATOR</option>
        <option value="SKILLED WORKER">SKILLED WORKER</option>
        <option value="SMALL DHABA">SMALL DHABA</option>
        <option value="SMALL RESTAURANT">SMALL RESTAURANT</option>
        <option value="SOLICITOR GENERAL">SOLICITOR GENERAL</option>
        <option value="SOWAR">SOWAR</option>
        <option value="SPECIAL ASSISTANT">SPECIAL ASSISTANT</option>
        <option value="SPECIAL COMMISSIONER">SPECIAL COMMISSIONER</option>
        <option value="SPECIAL COMMISSIONER OF POLICE">SPECIAL COMMISSIONER OF POLICE</option>
        <option value="SPECIAL DIRECTOR">SPECIAL DIRECTOR</option>
        <option value="SPECIAL DIRECTOR GENERAL">SPECIAL DIRECTOR GENERAL</option>
        <option value="SPECIAL OR ADDITIONAL DIRECTOR">SPECIAL OR ADDITIONAL DIRECTOR</option>
        <option value="SPECIAL SECRETARY">SPECIAL SECRETARY</option>
        <option value="SPINNING MASTER">SPINNING MASTER</option>
        <option value="SQUADRON LEADER">SQUADRON LEADER</option>
        <option value="SR DEPUTY ACCOUNTANT GENERAL">SR DEPUTY ACCOUNTANT GENERAL</option>
        <option value="SR ECONOMIC ADVISOR">SR ECONOMIC ADVISOR</option>
        <option value="SR HEAD MESSENGER">SR HEAD MESSENGER</option>
        <option value="SR MANAGER">SR MANAGER</option>
        <option value="SR OPERATOR">SR OPERATOR</option>
        <option value="SR PROJECT DIRECTOR">SR PROJECT DIRECTOR</option>
        <option value="SR TECHNICIAN">SR TECHNICIAN</option>
        <option value="SR VICE PRESIDENT">SR VICE PRESIDENT</option>
        <option value="SR. DEPUTY ACCOUNTANT GENERAL">SR. DEPUTY ACCOUNTANT GENERAL</option>
        <option value="SR. DIVISIONAL MANAGER">SR. DIVISIONAL MANAGER</option>
        <option value="SR. ENGINEER">SR. ENGINEER</option>
        <option value="SR. EXECUTIVE">SR. EXECUTIVE</option>
        <option value="STATE ELECTION COMMISSIONER">STATE ELECTION COMMISSIONER</option>
        <option value="STENO">STENO</option>
        <option value="STEWARDS">STEWARDS</option>
        <option value="STUDENT">STUDENT</option>
        <option value="SUB LIEUTENANT">SUB LIEUTENANT</option>
        <option value="SUB STAFF">SUB STAFF</option>
        <option value="SUB-INSPECTOR">SUB-INSPECTOR</option>
        <option value="SUBEDAR">SUBEDAR</option>
        <option value="SUBEDAR MAJOR">SUBEDAR MAJOR</option>
        <option value="SUBORDINATE STAFF">SUBORDINATE STAFF</option>
        <option value="SUBSTAFF">SUBSTAFF</option>
        <option value="SUPERINTENDENT ENGINEER">SUPERINTENDENT ENGINEER</option>
        <option value="SUPERINTENDENT OF POLICE">SUPERINTENDENT OF POLICE</option>
        <option value="SUPERVISOR">SUPERVISOR</option>
        <option value="SWEEPER">SWEEPER</option>
        <option value="TAILOR">TAILOR</option>
        <option value="TEA STALL">TEA STALL</option>
        <option value="TEACHER">TEACHER</option>
        <option value="TECHNICIAN">TECHNICIAN</option>
        <option value="TECHNICIAN - FITTER">TECHNICIAN - FITTER</option>
        <option value="TECHNICIAN FITTER">TECHNICIAN FITTER</option>
        <option value="TECHNICIAN OPERATOR">TECHNICIAN OPERATOR</option>
        <option value="TELLER">TELLER</option>
        <option value="TICKET CHECKER">TICKET CHECKER</option>
        <option value="TICKET EXAMINER">TICKET EXAMINER</option>
        <option value="TICKET INSPECTOR">TICKET INSPECTOR</option>
        <option value="TRACER">TRACER</option>
        <option value="TRAVEL AGENT">TRAVEL AGENT</option>
        <option value="TURNER">TURNER</option>
        <option value="TUTORIAL">TUTORIAL</option>
        <option value="UNDER SECRETARY">UNDER SECRETARY</option>
        <option value="UNSKILLED OPERATOR">UNSKILLED OPERATOR</option>
        <option value="UNSKILLED WORKER">UNSKILLED WORKER</option>
        <option value="UTTAM ADHIKARI">UTTAM ADHIKARI</option>
        <option value="UTTAM NAVIKS">UTTAM NAVIKS</option>
        <option value="UTTAM SAHAYAK ENGINEER">UTTAM SAHAYAK ENGINEER</option>
        <option value="UTTAM YANTRIK">UTTAM YANTRIK</option>
        <option value="VERIFICATION AGENT">VERIFICATION AGENT</option>
        <option value="VICE ADMIRAL">VICE ADMIRAL</option>
        <option value="VICE ADMIRAL (NAVY)">VICE ADMIRAL (NAVY)</option>
        <option value="VICE CHAIRMAN">VICE CHAIRMAN</option>
        <option value="VICE CHANCELLOR">VICE CHANCELLOR</option>
        <option value="VICE CHIEFS">VICE CHIEFS</option>
        <option value="VICE CONSUL">VICE CONSUL</option>
        <option value="VICE PRESIDENT">VICE PRESIDENT</option>
        <option value="VICE PRESIDENT (BAND 2)">VICE PRESIDENT (BAND 2)</option>
        <option value="VICE PRINCIPAL">VICE PRINCIPAL</option>
        <option value="WAITER">WAITER</option>
        <option value="WARD BOY">WARD BOY</option>
        <option value="WARDBOY">WARDBOY</option>
        <option value="WARDEN">WARDEN</option>
        <option value="WARRANT OFFICER">WARRANT OFFICER</option>
        <option value="WATCHMAN">WATCHMAN</option>
        <option value="WELDER">WELDER</option>
        <option value="WINE OWNER">WINE OWNER</option>
        <option value="WING COMMANDER">WING COMMANDER</option>
        <option value="WING COMMANDER (AIR FORCE)">WING COMMANDER (AIR FORCE)</option>
        <option value="WORK ASSISTANT">WORK ASSISTANT</option>
        <option value="WORKER">WORKER</option>
        <option value="WORKMAN">WORKMAN</option>
        <option value="YANTRIK">YANTRIK</option>
        <option value="YOGA INSTRUCTORS">YOGA INSTRUCTORS</option>
        <option value="ZONAL JOINT DIRECTOR GENERAL">ZONAL JOINT DIRECTOR GENERAL</option>
        <option value="ZONAL MANAGER">ZONAL MANAGER</option>
      </select>
      <div id="DesignationVal"></div>
      <div style="clear:both; margin-top:15px;"></div>
      <button class="submit-btn" type="submit">Get Quote Now!</button>
    </form>
  </div>
  <div style="clear:both; margin-top:15px;"></div>
</div>
</body>
</html>