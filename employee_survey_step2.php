<?php
ob_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

if(isset($_POST['submit']))
{
	$celebrate_events = $_POST['celebrate_events'];
	$last_resort = $_POST['last_resort'];
	$avoid_politicking = $_POST['avoid_politicking'];
	$balance_work = $_POST['balance_work'];
	$treated_fair_orientation = $_POST['treated_fair_orientation'];
	$competent_running_busines = $_POST['competent_running_busines'];
	$fair_shake = $_POST['fair_shake'];
	$su_benefits = $_POST['su_benefits'];
	$in_this_together = $_POST['in_this_together'];
	$honest_ethical = $_POST['honest_ethical'];
	$sincere_interest = $_POST['sincere_interest'];
	$work_long = $_POST['work_long'];
	$treated_full_member = $_POST['treated_full_member'];
	$take_time_off = $_POST['take_time_off'];
	$make_difference = $_POST['make_difference'];	
	$feel_welcome = $_POST['feel_welcome'];
	$fun_place = $_POST['fun_place'];
	$fit_well_here = $_POST['fit_well_here'];
	$great_place = $_POST['great_place'];
	$leaders_right_thing = $_POST['leaders_right_thing'];
	$values_entrepreneurship = $_POST['values_entrepreneurship'];	
	$leaders_consistent = $_POST['leaders_consistent'];
	$value_integrity = $_POST['value_integrity'];
	$value_teamwork = $_POST['value_teamwork'];
	$leadership_team_work = $_POST['leadership_team_work'];
	$openness_trust = $_POST['openness_trust'];
	$satisfied_management = $_POST['satisfied_management'];
	$satisfied_culture = $_POST['satisfied_culture'];
	$expect_to_work = $_POST['expect_to_work'];
	$rate_wrs = $_POST['rate_wrs'];
	$age = $_POST['age'];
	$service = $_POST['service'];
	$gender = $_POST['gender'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$company_great_place = $_POST['company_great_place'];
	$improved_compnay = $_POST['improved_compnay'];
	
	$e_id = $_POST['e_id'];
	$DataArray = array('celebrate_events'=>$celebrate_events, 'last_resort'=>$last_resort, 'avoid_politicking'=>$avoid_politicking, 'balance_work'=>$balance_work, 'treated_fair_orientation'=>$treated_fair_orientation, 'competent_running_busines'=>$competent_running_busines, 'fair_shake'=>$fair_shake, 'su_benefits'=>$su_benefits, 'in_this_together'=>$in_this_together, 'honest_ethical'=>$honest_ethical, 'sincere_interest'=>$sincere_interest, 'work_long'=>$work_long, 'treated_full_member'=>$treated_full_member, 'take_time_off'=>$take_time_off, 'make_difference'=>$make_difference, 'feel_welcome'=>$feel_welcome, 'fun_place'=>$fun_place, 'fit_well_here'=>$fit_well_here, 'great_place'=>$great_place, 'leaders_right_thing'=>$leaders_right_thing, 'values_entrepreneurship'=>$values_entrepreneurship, 'leaders_consistent'=>$leaders_consistent, 'value_integrity'=>$value_integrity, 'value_teamwork'=>$value_teamwork, 'leadership_team_work'=>$leadership_team_work, 'openness_trust'=>$openness_trust, 'satisfied_management'=>$satisfied_management, 'satisfied_culture'=>$satisfied_culture, 'expect_to_work'=>$expect_to_work, 'rate_wrs'=>$rate_wrs, 'age'=>$age, 'gender'=>$gender, 'service'=>$service, 'state'=>$state, 'city'=>$city, 'company_great_place'=>$company_great_place, 'improved_compnay'=>$improved_compnay);
	$wherecondition ="(e_id=".$eid.")";
	Mainupdatefunc ('employee_survey', $DataArray, $wherecondition);

	header("Location: employee_survey_thankyou.php");
	exit();
		
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Survey</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<style>
.lfttxtbar {
color:#373737;
font-family:Verdana,Arial,Helvetica,sans-serif;
font-size:11px;
line-height:15px;
text-align:justify;
font-weight:bold;
}
</style>
<script language="javascript">
function chkform()
{
//alert("gdffsdfds");

var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
var dt,mdate;dt=new Date();
var alpha=/^[a-zA-Z\ ]*$/;
var alphanum=/^[a-zA-Z0-9]*$/;
var num=/^[0-9]*$/;
var space=/^[\ ]*$/;
var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	if(document.employee.celebrate_events.selectedIndex==0)
	{
		alert("Please select Celebre events");
		document.employee.celebrate_events.focus();
		return false;
	}
	
	if(document.employee.last_resort.selectedIndex==0)
	{
		alert("Please select management would lay people");
		document.employee.last_resort.focus();
		return false;
	}
	
	if(document.employee.avoid_politicking.selectedIndex==0)
	{
		alert("Please select People avoid politicking");
		document.employee.avoid_politicking.focus();
		return false;
	}
	
	if(document.employee.balance_work.selectedIndex==0)
	{
		alert("Please select People are encouraged");
		document.employee.balance_work.focus();
		return false;
	}
	
	if(document.employee.treated_fair_orientation.selectedIndex==0)
	{
		alert("Please select People here are treated fairly ");
		document.employee.treated_fair_orientation.focus();
		return false;
	}

 	if(document.employee.competent_running_busines.selectedIndex==0)
	{
		alert("Please select Management is competent");
		document.employee.competent_running_busines.focus();
		return false;
	}
	
	if(document.employee.fair_shake.selectedIndex==0)
	{
		alert("Please select am unfairly treated");
		document.employee.fair_shake.focus();
		return false;
	}
	if(document.employee.su_benefits.selectedIndex==0)
	{
		alert("Please select special and unique benefits ");
		document.employee.su_benefits.focus();
		return false;
	}
	

	if(document.employee.in_this_together.selectedIndex==0)
	{
		alert("Please select We're all in this together ");
		document.employee.in_this_together.focus();
		return false;
	}
	if(document.employee.honest_ethical.selectedIndex==0)
	{
		alert("Please select its business practices");
		document.employee.honest_ethical.focus();
		return false;
	}
	if(document.employee.sincere_interest.selectedIndex==0)
	{
		alert("Please select shows a sincere interest");
		document.employee.sincere_interest.focus();
		return false;
	}
	if(document.employee.work_long.selectedIndex==0)
	{
		alert("Please select work here for a long time");
		document.employee.work_long.focus();
		return false;
	}
	if(document.employee.treated_full_member.selectedIndex==0)
	{
		alert("Please select treated as a full member");
		document.employee.treated_full_member.focus();
		return false;
	}
	if(document.employee.take_time_off.selectedIndex==0)
	{
		alert("Please select able to take time off from work when required.");
		document.employee.take_time_off.focus();
		return false;
	}
	if(document.employee.make_difference.selectedIndex==0)
	{
		alert("Please select I feel I make a difference here");
		document.employee.make_difference.focus();
		return false;
	}
	
	if(document.employee.feel_welcome.selectedIndex==0)
	{
		alert("Please select you are made to feel welcome");
		document.employee.feel_welcome.focus();
		return false;
	}
	
	if(document.employee.fun_place.selectedIndex==0)
	{
		alert("Please select This is a fun place to work");
		document.employee.fun_place.focus();
		return false;
	}
	if(document.employee.fit_well_here.selectedIndex==0)
	{
		alert("Please select people who fit in well here");
		document.employee.fit_well_here.focus();
		return false;
	}
	
	if(document.employee.great_place.selectedIndex==0)
	{
		alert("Please select this is a great place to work");
		document.employee.great_place.focus();
		return false;
	}
	if(document.employee.leaders_right_thing.selectedIndex==0)
	{
		alert("Please select right thing for the business");
		document.employee.leaders_right_thing.focus();
		return false;
	}
	if(document.employee.values_entrepreneurship.selectedIndex==0)
	{
		alert("Please select values of Entrepreneurship");
		document.employee.values_entrepreneurship.focus();
		return false;
	}
	if(document.employee.leaders_consistent.selectedIndex==0)
	{
		alert("Please select Leaders are consistent");
		document.employee.leaders_consistent.focus();
		return false;
	}
	if(document.employee.value_integrity.selectedIndex==0)
	{
		alert("Please select stated value of Integrity");
		document.employee.value_integrity.focus();
		return false;
	}
	
	if(document.employee.value_teamwork.selectedIndex==0)
	{
		alert("Please select stated value of Teamwork");
		document.employee.value_teamwork.focus();
		return false;
	}
	if(document.employee.leadership_team_work.selectedIndex==0)
	{
		alert("Please select works collaboratively with each other");
		document.employee.leadership_team_work.focus();
		return false;
	}
	if(document.employee.openness_trust.selectedIndex==0)
	{
		alert("Please select stated value of Openness an Trust");
		document.employee.openness_trust.focus();
		return false;
	}
	
	if(document.employee.satisfied_management.selectedIndex==0)
	{
		alert("Please select satisfied with the management ");
		document.employee.satisfied_management.focus();
		return false;
	}

	if(document.employee.satisfied_culture.selectedIndex==0)
	{
		alert("Please select satisfied with the culture");
		document.employee.satisfied_culture.focus();
		return false;
	}
	if(document.employee.expect_to_work.selectedIndex==0)
	{
		alert("Please select How much longer you expect to work");
		document.employee.expect_to_work.focus();
		return false;
	}
	if(document.employee.rate_wrs.selectedIndex==0)
	{
		alert("Please select rate WRS ");
		document.employee.rate_wrs.focus();
		return false;
	}
	

	if(document.employee.age.selectedIndex==0)
	{
		alert("Please select Age ");
		document.employee.age.focus();
		return false;
	}
	if(document.employee.gender.selectedIndex==0)
	{
		alert("Please select Gender ");
		document.employee.gender.focus();
		return false;
	}
	
	if(document.employee.gender.selectedIndex==0)
	{
		alert("Please select Gender ");
		document.employee.gender.focus();
		return false;
	}
	
	if(document.employee.state.selectedIndex==0)
	{
		alert("Please select State ");
		document.employee.state.focus();
		return false;
	}
	if(document.employee.city.selectedIndex==0)
	{
		alert("Please select City ");
		document.employee.city.focus();
		return false;
	}
	
	if(document.employee.company_great_place.value=="")
	{
		alert("Please fill Company Great Place.");
		document.employee.company_great_place.focus();
		return false;
	}
	
	if(document.employee.improved_compnay.value=="")
	{
		alert("Please fill.");
		document.employee.improved_compnay.focus();
		return false;
	}

}

</script>
</head>

<body>
<form action="employee_survey_step2.php" method="post" name="employee"  onsubmit="return chkform();">
<table width="85%" border="0" cellspacing="1" cellpadding="3" bgcolor="#333333"  align="center">
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><b>WRS Employee Alignment Survey - 2010</b></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF">Please answer all questions by selecting the option beside your choice.</td>
  </tr>
  <tr>
    <td width="65%" bgcolor="#FFFFFF" class="lfttxtbar">People celebrate special events around here.</td>
    <td width="35%" bgcolor="#FFFFFF">
	<select name="celebrate_events" id="celebrate_events">
    <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">I believe management would lay people off only as a last resort.</td>
    <td><select name="last_resort" id="last_resort">
    <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">People avoid politicking and backstabbing as ways to get things done.</td>
    <td width="35%"><select name="avoid_politicking" id="avoid_politicking">
    <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">People are encouraged to balance their work life and personal life.</td>
    <td><select name="balance_work" id="balance_work">
    <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">People here are treated fairly regardless of their sexual orientation.</td>
    <td width="35%"><select name="treated_fair_orientation" id="treated_fair_orientation">
    <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Management is competent at running the business.</td>
    <td><select name="competent_running_busines" id="competent_running_busines">
    <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">If I am unfairly treated, I believe I'll be given a fair shake if I appeal.</td>
    <td width="35%"><select name="fair_shake" id="fair_shake"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">We have special and unique benefits here.</td>
    <td><select name="su_benefits" id="su_benefits">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">We're all in this together.</td>
    <td width="35%"><select name="in_this_together" id="in_this_together">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Management is honest and ethical in its business practices.</td>
    <td><select name="honest_ethical" id="honest_ethical">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">Management shows a sincere interest in me as a person, not just an employee.</td>
    <td width="35%"><select name="sincere_interest" id="sincere_interest">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">I want to work here for a long time.</td>
    <td><select name="work_long" id="work_long">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">I am treated as a full member here regardless of my position.</td>
    <td width="35%"><select name="treated_full_member" id="treated_full_member">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">I am able to take time off from work when I think it's necessary.</td>
    <td><select name="take_time_off" id="take_time_off">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">I feel I make a difference here.</td>
    <td width="35%"><select name="make_difference" id="make_difference">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">When you join the organization, you are made to feel welcome.</td>
    <td><select name="feel_welcome" id="feel_welcome">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">This is a fun place to work.</td>
    <td width="35%"><select name="fun_place" id="fun_place">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Management hires people who fit in well here.</td>
    <td><select name="fit_well_here" id="fit_well_here">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">Taking everything into account, I would say this is a great place to work.</td>
    <td width="35%"><select name="great_place" id="great_place">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr>
    <td bgcolor="#f2f2f2" class="lfttxtbar">WRS leaders want to do the right thing for the business.</td>
    <td bgcolor="#f2f2f2"><select name="leaders_right_thing" id="leaders_right_thing">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">I believe that management acts according to WRS's stated values of Entrepreneurship.</td>
    <td width="35%"><select name="values_entrepreneurship" id="values_entrepreneurship">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Leaders are consistent in what they say and do.</td>
    <td><select name="leaders_consistent" id="leaders_consistent">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">I believe that management acts according to the WRS's stated value of Integrity.</td>
    <td width="35%"><select name="value_integrity" id="value_integrity">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">I believe that management acts according to the WRS's stated value of Teamwork.</td>
    <td><select name="value_teamwork" id="value_teamwork">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">I feel that WRS's senior leadership team works collaboratively with each other.</td>
    <td width="35%"><select name="leadership_team_work" id="leadership_team_work">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">I believe that management acts according to WRS's stated value of Openness an Trust. </td>
    <td><select name="openness_trust" id="openness_trust">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">Overall, I am satisfied with the management style of WRS's leaders.</td>
    <td width="35%"><select name="satisfied_management" id="satisfied_management">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Overall, I am satisfied with the culture and values at WRS.</td>
    <td><select name="satisfied_culture" id="satisfied_culture">
      <option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">How much longer you expect to work for WRS:</td>
    <td width="35%"><select name="expect_to_work" id="expect_to_work">
      <option value="">Select</option>
<option value="less than 3 years">less than 3 years</option>
      <option value="3 - 5 years">3 - 5 years</option>
	        <option value="5 - 10 years">5 - 10 years</option>
			      <option value="greater than 10 years">greater than 10 years</option>
				        <option value="until I retire">until I retire</option>
						
</select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Compared to other companies, how would you rate WRS as a place to work?</td>
    <td><select name="rate_wrs" id="rate_wrs">
      <option value="">Select</option>
 <option value="Lower">Lower</option>
 <option value="About the same">About the same</option>
  <option value="Higher">Higher</option>
</select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">Your age?</td>
    <td width="35%"><select name="age"><option value="">Select</option>
	<option value="21 years or younger">21 years or younger</option>	
	<option value="21 years 25 years">21 years 25 years</option>
	<option value="26 years to 34 years">26 years to 34 years</option>
	<option value="35 years to 44 years">35 years to 44 years</option>
	<option value="45 years to 54 years">45 years to 54 years</option>
	<option value="55 years or older">55 years or older</option>
</select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">What is your gender?</td>
    <td><select name="gender"><option value="">Select</option>
	<option value="Male">Male</option>
	<option value="Female">Female</option>
</select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">How many years of service do you have with this organization?</td>
    <td width="35%"><select name="service"><option value="">Select</option>
	<option value="0.5 yrs">0.5 yrs</option>
	<option value="1.0 yrs">1.0 yrs</option>
	<option value="1.5 yrs">1.5 yrs</option>
	<option value="2.0 yrs">2.0 yrs</option>
	<option value="2.5 yrs">2.5 yrs</option>
	<option value="3.0 yrs">3.0 yrs</option>
	<option value="3.5 yrs">3.5 yrs</option>
	<option value="4.0 yrs">4.0 yrs</option>
	<option value="4.5 yrs">4.5 yrs</option>
	<option value="5.0 yrs">5.0 yrs</option>
	<option value="5.5 yrs">5.5 yrs</option>
	<option value="6.0 yrs">6.0 yrs</option>	
	<option value="5.5 yrs">4.5 yrs</option>
	
	</select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">State</td>
    <td><select name="state">
	<option value="">Select</option>
	<option value="Andhra Pradesh">Andhra Pradesh</option>
	<option value="Arunachal Pradesh">Arunachal Pradesh</option>
	<option value="Assam">Assam</option>
	<option value="Bihar">Bihar</option>
	<option value="Chhattisgarh">Chhattisgarh</option>
	<option value="Delhi">Delhi</option>
	<option value="Goa">Goa</option>
	<option value="Gujarat">Gujarat</option>
	<option value="Haryana">Haryana</option>
	<option value="Himachal Pradesh">Himachal Pradesh</option>
	<option value="Jammu and Kashmir">Jammu and Kashmir</option>
	<option value="Jharkhand">Jharkhand</option>
	<option value="Karnataka">Karnataka</option>
	<option value="Kerala">Kerala</option>
	<option value="Madhya Pradesh">Madhya Pradesh</option>
	<option value="Maharashtra">Maharashtra</option>
	<option value="Manipur">Manipur</option>
	<option value="Meghalaya">Meghalaya</option>
	<option value="Mizoram">Mizoram</option>
<option value="Nagaland">Nagaland</option>
	<option value="Orissa">Orissa</option>
	<option value="Punjab">Punjab</option>
	<option value="Rajasthan">Rajasthan</option>
	<option value="Sikkim">Sikkim</option>
	<option value="Tamil Nadu">Tamil Nadu</option>
	<option value="Tripura">Tripura</option>
<option value="Uttar Pradesh">Uttar Pradesh</option>
<option value="Uttarakhand">Uttarakhand</option>
<option value="West Bengal">West Bengal</option>
</select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">City</td>
    <td width="35%"><input type="text" name="city" id="city" size="24" /></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">What makes your company a great place to work?</td>
    <td><textarea name="company_great_place"></textarea></td>
  </tr>

  <tr bgcolor="#FFFFFF">
    <td class="lfttxtbar">What needs to be improved in your company?</td>
    <td><textarea name="improved_compnay"></textarea></td>
  </tr>

 
  <tr><td bgcolor="#FFFFFF" class="lfttxtbar">&nbsp;</td>
  <td bgcolor="#FFFFFF">
  <input type="hidden" name="e_id" id="e_id" value="<?php echo $_SESSION['aid']; ?>" size="24" />
  <input type="submit" name="submit" value="Submit" /></td></tr>
</table>
</form>
</body>
</html>
