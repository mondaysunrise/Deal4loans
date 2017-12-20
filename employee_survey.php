<?php
ob_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functions.php';

if(isset($_POST['submit']))
{
	//print_r($_POST);
	$fname = $_POST['fname'];
	$department = $_POST['department'];
	$friendly_place = $_POST['friendly_place'];
	$resources = $_POST['resources'];
	$physically_safe = $_POST['physically_safe'];
	$special_recognition = $_POST['special_recognition'];
	$give_extra = $_POST['give_extra'];
	$people_coorperate = $_POST['people_coorperate'];
	$expectation_clear = $_POST['expectation_clear'];
	$straight_answer = $_POST['straight_answer'];
	$training_personally = $_POST['training_personally'];
	$appreciation = $_POST['appreciation'];
	$paid_fairly = $_POST['paid_fairly'];
	$just_job = $_POST['just_job'];
	$feel_home = $_POST['feel_home'];
	$easy_talk = $_POST['easy_talk'];
	$honest_mistakes = $_POST['honest_mistakes'];
	$respond_suggestions = $_POST['respond_suggestions'];
	$sense_pride = $_POST['sense_pride'];
	$fair_share = $_POST['fair_share'];
	$informed_issues = $_POST['informed_issues'];
	$clear_view = $_POST['clear_view'];	
	$trust_people = $_POST['trust_people'];
	$involves_people = $_POST['involves_people'];
	$avoid_playing = $_POST['avoid_playing'];
	$ways_contribute = $_POST['ways_contribute'];
	$assigning_coordinating = $_POST['assigning_coordinating'];
	$given_responsibility = $_POST['given_responsibility'];
	$emotionally_healthy = $_POST['emotionally_healthy'];
	$treated_fairly = $_POST['treated_fairly'];
	$best_deserve = $_POST['best_deserve'];
	$coming_to_work = $_POST['coming_to_work'];
	$myself_here = $_POST['myself_here'];
	$delivers_promise = $_POST['delivers_promise'];
	$treated_fair_race = $_POST['treated_fair_race'];
	$care_each_other = $_POST['care_each_other'];
	$action_match = $_POST['action_match'];
	$good_working = $_POST['good_working'];
	$treated_fair_sex = $_POST['treated_fair_sex'];
	$tell_others = $_POST['tell_others'];
	$ft_feeling = $_POST['ft_feeling'];
	
	//$sqlInsert = "insert into employee_survey (fname , department , friendly_place , resources , physically_safe , special_recognition , give_extra , people_coorperate , expectation_clear , straight_answer , training_personally , appreciation , paid_fairly , just_job , feel_home , easy_talk , honest_mistakes , respond_suggestions , sense_pride , fair_share , informed_issues , clear_view , trust_people , involves_people , avoid_playing , ways_contribute , assigning_coordinating , given_responsibility , emotionally_healthy , treated_fairly , best_deserve , coming_to_work , myself_here , delivers_promise , treated_fair_race , care_each_other , action_match , good_working , treated_fair_sex , tell_others , ft_feeling) values ('".$fname."', '".$department."', '".$friendly_place."', '".$resources."', '".$physically_safe."', '".$special_recognition."', '".$give_extra."', '".$people_coorperate."', '".$expectation_clear."', '".$straight_answer."', '".$training_personally."', '".$appreciation."', '".$paid_fairly."', '".$just_job."', '".$feel_home."', '".$easy_talk."', '".$honest_mistakes."', '".$respond_suggestions."', '".$sense_pride."', '".$fair_share."', '".$informed_issues."', '".$clear_view."', '".$trust_people."', '".$involves_people."', '".$avoid_playing."', '".$ways_contribute."', '".$assigning_coordinating."', '".$given_responsibility."', '".$emotionally_healthy."', '".$treated_fairly."', '".$best_deserve."', '".$coming_to_work."', '".$myself_here."', '".$delivers_promise."', '".$treated_fair_race."', '".$care_each_other."', '".$action_match."', '".$good_working."', '".$treated_fair_sex."', '".$tell_others."', '".$ft_feeling."')";
	//$queryInsert = ExecQuery($sqlInsert);
	
	$dataInsert = array("fname"=>$fname, "department"=>$department, "friendly_place"=>$friendly_place, "resources"=>$resources, "physically_safe"=>$physically_safe, "special_recognition"=>$special_recognition, "give_extra"=>$give_extra, "people_coorperate"=>$people_coorperate, "expectation_clear"=>$expectation_clear, "straight_answer"=>$straight_answer, "training_personally"=>$training_personally, "appreciation"=>$appreciation, "paid_fairly"=>$paid_fairly, "just_job"=>$just_job, "feel_home"=>$feel_home, "easy_talk"=>$easy_talk, "honest_mistakes"=>$honest_mistakes, "respond_suggestions"=>$respond_suggestions, "sense_pride"=>$sense_pride, "fair_share"=>$fair_share, "informed_issues"=>$informed_issues, "clear_view"=>$clear_view, "trust_people"=>$trust_people, "involves_people"=>$involves_people, "avoid_playing"=>$avoid_playing, "ways_contribute"=>$ways_contribute, "assigning_coordinating"=>$assigning_coordinating, "given_responsibility"=>$given_responsibility, "emotionally_healthy"=>$emotionally_healthy, "treated_fairly"=>$treated_fairly, "best_deserve"=>$best_deserve, "coming_to_work"=>$coming_to_work, "myself_here"=>$myself_here, "delivers_promise"=>$delivers_promise, "treated_fair_race"=>$treated_fair_race, "care_each_other"=>$care_each_other, "action_match"=>$action_match, "good_working"=>$good_working, "treated_fair_sex"=>$treated_fair_sex, "tell_others"=>$tell_others, "ft_feeling"=>$ft_feeling);
$table = 'employee_survey';
$insert = Maininsertfunc ($table, $dataInsert);
	
	$_SESSION['aid'] = mysql_insert_id(); 
//	echo $sqlInsert;	
	
	header("Location: employee_survey_step2.php");
	exit();
		
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Survey</title>
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
function containsdigit(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)=="0") || (param.charAt(i)=="1") || (param.charAt(i)=="2") || (param.charAt(i)=="3") || (param.charAt(i)=="4") || (param.charAt(i)=="5") || (param.charAt(i)=="6") || (param.charAt(i)=="7") || (param.charAt(i)=="8") || (param.charAt(i)=="9") || (param.charAt(i)=="/"))
{
return true;
}
}
return false;
}
function containsalph(param)
{
mystrLen = param.length;
for(i=0;i<mystrLen;i++)
{
if((param.charAt(i)<"0")||(param.charAt(i)>"9"))
{
return true;
}
}
return false;
}
function Trim(strValue) {
var j=strValue.length-1;i=0;
while(strValue.charAt(i++)==' ');
while(strValue.charAt(j--)==' ');
return strValue.substr(--i,++j-i+1);
}
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



	if(document.employee.fname.value=="")
	{
		alert("Please fill your Full name.");
		document.employee.fname.focus();
		return false;
	}
	if(document.employee.fname.value!="")
	{
		 if(containsdigit(document.employee.fname.value)==true)
		{
			alert("Full Name contains numbers!");
			document.employee.fname.focus();
			return false;
		}
	}
  for (var i = 0; i <document.employee.fname.value.length; i++) {
  	if (iChars.indexOf(document.employee.fname.value.charAt(i)) != -1) {
  	alert ("Full Name has special characters.\n Please remove them and try again.");
	document.employee.fname.focus();

  	return false;
  	}
  }

	if(document.employee.department.selectedIndex==0)
	{
		alert("Please select Department ");
		document.employee.department.focus();
		return false;
	}
	
	if(document.employee.friendly_place.selectedIndex==0)
	{
		alert("Please select Friendly Place ");
		document.employee.friendly_place.focus();
		return false;
	}
	
	if(document.employee.resources.selectedIndex==0)
	{
		alert("Please select resources and equipment to do a job");
		document.employee.resources.focus();
		return false;
	}
	
	if(document.employee.physically_safe.selectedIndex==0)
	{
		alert("Please select physically safe place ");
		document.employee.physically_safe.focus();
		return false;
	}
	
	if(document.employee.special_recognition.selectedIndex==0)
	{
		alert("Please select opportunity to get special recognition ");
		document.employee.special_recognition.focus();
		return false;
	}
	
	if(document.employee.give_extra.selectedIndex==0)
	{
		alert("Please select give extra to get the job done ");
		document.employee.give_extra.focus();
		return false;
	}
	
	if(document.employee.people_coorperate.selectedIndex==0)
	{
		alert("Please select people to cooperate ");
		document.employee.people_coorperate.focus();
		return false;
	}
	
	if(document.employee.expectation_clear.selectedIndex==0)
	{
		alert("Please select Management makes expectations clear ");
		document.employee.expectation_clear.focus();
		return false;
	}
	
	if(document.employee.straight_answer.selectedIndex==0)
	{
		alert("Please select get a straight answer ");
		document.employee.straight_answer.focus();
		return false;
	}
	
	if(document.employee.training_personally.selectedIndex==0)
	{
		alert("Please select training or development ");
		document.employee.training_personally.focus();
		return false;
	}
	
	if(document.employee.appreciation.selectedIndex==0)
	{
		alert("Please select Management shows appreciation ");
		document.employee.appreciation.focus();
		return false;
	}
	
	if(document.employee.paid_fairly.selectedIndex==0)
	{
		alert("Please select People here are paid fairly");
		document.employee.paid_fairly.focus();
		return false;
	}
	
	if(document.employee.just_job.selectedIndex==0)
	{
		alert("Please select this is not 'just a job' ");
		document.employee.just_job.focus();
		return false;
	}
	
	if(document.employee.feel_home.selectedIndex==0)
	{
		alert("Please select feel right at home ");
		document.employee.feel_home.focus();
		return false;
	}
	
	if(document.employee.easy_talk.selectedIndex==0)
	{
		alert("Please select easy to talk with ");
		document.employee.easy_talk.focus();
		return false;
	}
	
	if(document.employee.honest_mistakes.selectedIndex==0)
	{
		alert("Please select part of doing business");
		document.employee.honest_mistakes.focus();
		return false;
	}
	
	if(document.employee.respond_suggestions.selectedIndex==0)
	{
		alert("Please select responds to suggestions and ideas ");
		document.employee.respond_suggestions.focus();
		return false;
	}
	
	if(document.employee.sense_pride.selectedIndex==0)
	{
		alert("Please select sense of pride");
		document.employee.sense_pride.focus();
		return false;
	}
	
	if(document.employee.fair_share.selectedIndex==0)
	{
		alert("Please select fair share of the profits");
		document.employee.fair_share.focus();
		return false;
	}
	
	if(document.employee.informed_issues.selectedIndex==0)
	{
		alert("Please select important issues and changes ");
		document.employee.informed_issues.focus();
		return false;
	}
	
	if(document.employee.clear_view.selectedIndex==0)
	{
		alert("Please select clear view");
		document.employee.clear_view.focus();
		return false;
	}
	
	if(document.employee.trust_people.selectedIndex==0)
	{
		alert("Please select Management trusts people ");
		document.employee.trust_people.focus();
		return false;
	}
	
	if(document.employee.involves_people.selectedIndex==0)
	{
		alert("Please select Management involves people");
		document.employee.involves_people.focus();
		return false;
	}
	
	if(document.employee.avoid_playing.selectedIndex==0)
	{
		alert("Please select Managers avoid playing favorites ");
		document.employee.avoid_playing.focus();
		return false;
	}
	
	if(document.employee.ways_contribute.selectedIndex==0)
	{
		alert("Please select contribute to the community ");
		document.employee.ways_contribute.focus();
		return false;
	}
	
	if(document.employee.assigning_coordinating.selectedIndex==0)
	{
		alert("Please select assigning and coordinating people ");
		document.employee.assigning_coordinating.focus();
		return false;
	}
	
	if(document.employee.given_responsibility.selectedIndex==0)
	{
		alert("Please select given a lot of responsibility ");
		document.employee.given_responsibility.focus();
		return false;
	}
	
	if(document.employee.emotionally_healthy.selectedIndex==0)
	{
		alert("Please select healthy place to work ");
		document.employee.emotionally_healthy.focus();
		return false;
	}
	
	
	if(document.employee.treated_fairly.selectedIndex==0)
	{
		alert("Please select People here are treated fairly ");
		document.employee.treated_fairly.focus();
		return false;
	}
	
	if(document.employee.best_deserve.selectedIndex==0)
	{
		alert("Please select best deserve ");
		document.employee.best_deserve.focus();
		return false;
	}
	
	if(document.employee.coming_to_work.selectedIndex==0)
	{
		alert("Please select coming to work here ");
		document.employee.coming_to_work.focus();
		return false;
	}
	
	if(document.employee.myself_here.selectedIndex==0)
	{
		alert("Please select myself around here ");
		document.employee.myself_here.focus();
		return false;
	}
	
	if(document.employee.delivers_promise.selectedIndex==0)
	{
		alert("Please select Management delivers on its promise ");
		document.employee.delivers_promise.focus();
		return false;
	}
	
	if(document.employee.treated_fair_race.selectedIndex==0)
	{
		alert("Please select treated fairly ");
		document.employee.treated_fair_race.focus();
		return false;
	}
	
	if(document.employee.care_each_other.selectedIndex==0)
	{
		alert("Please select People care about each other here ");
		document.employee.care_each_other.focus();
		return false;
	}
	
	if(document.employee.action_match.selectedIndex==0)
	{
		alert("Please select Management's action match its words ");
		document.employee.action_match.focus();
		return false;
	}
	
	if(document.employee.good_working.selectedIndex==0)
	{
		alert("Please select good working environment ");
		document.employee.good_working.focus();
		return false;
	}
	
	if(document.employee.treated_fair_sex.selectedIndex==0)
	{
		alert("Please select treated fairly regardless of their sex ");
		document.employee.treated_fair_sex.focus();
		return false;
	}
	
	if(document.employee.tell_others.selectedIndex==0)
	{
		alert("Please select tell others I work here ");
		document.employee.tell_others.focus();
		return false;
	}
	
	if(document.employee.ft_feeling.selectedIndex==0)
	{
		alert("Please select There is a family or team feeling here");
		document.employee.ft_feeling.focus();
		return false;
	}


}
</script>

</head>
<body>
<form action="employee_survey.php" method="post" name="employee" onsubmit="return chkform();">
<table width="85%" border="0" cellspacing="1" cellpadding="3" bgcolor="#333333" align="center">
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><b>WRS Employee Alignment Survey - 2010</b></td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFFF">Please answer all questions by selecting the option beside your choice.</td>
  </tr>
  <tr>
    <td width="65%" bgcolor="#FFFFFF" class="lfttxtbar">Name</td>
    <td width="35%" align="right" valign="middle" bgcolor="#FFFFFF"><input type="text" name="fname" size="24"  />&nbsp;&nbsp;</td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td width="65%" class="lfttxtbar">Department</td>
    <td width="35%" align="right" valign="middle">
	  <select name="department">
	  <option value="">Select</option>
	<option value="Call Center">Call Center</option>
	<option value="Business Developemnt">Business Developemnt</option>
	<option value="Operations">Operations</option>
	<option value="SEO">SEO</option>	
	<option value="Technical">Technical</option>
	<option value="Others">Others</option>	
	</select>&nbsp;&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">This is a friendly place to work.</td>
    <td width="35%" align="center" valign="middle"><select name="friendly_place"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">I am given the resources and equipment to do my job.</td>
    <td align="center" valign="middle"><select name="resources"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">This is a physically safe place to work.</td>
    <td width="35%" align="center" valign="middle"><select name="physically_safe"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Everyone has an opportunity to get special recognition.</td>
    <td align="center" valign="middle"><select name="special_recognition"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">People here are willing to give extra to get the job done.</td>
    <td width="35%" align="center" valign="middle"><select name="give_extra"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">You can count on people to cooperate.</td>
    <td align="center" valign="middle"><select name="people_coorperate"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">Management makes its expectations clear.</td>
    <td width="35%" align="center" valign="middle"><select name="expectation_clear"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">I can ask management any reasonable question and get a straight answer.</td>
    <td align="center" valign="middle"><select name="straight_answer"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">I am offered training or development to further myself personally.</td>
    <td width="35%" align="center" valign="middle"><select name="training_personally"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Management shows appreciation for good work and extra effort.</td>
    <td align="center" valign="middle"><select name="appreciation"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">People here are paid fairly for the work they do.</td>
    <td width="35%" align="center" valign="middle"><select name="paid_fairly"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">My work has special meaning: this is not "just a job".</td>
    <td align="center" valign="middle"><select name="just_job"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">When people change jobs or work units, they are made to feel right at home.</td>
    <td width="35%" align="center" valign="middle"><select name="feel_home"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Management is approachable, easy to talk with.</td>
    <td align="center" valign="middle"><select name="easy_talk"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">Management recognizes honest mistakes as part of doing business.</td>
    <td width="35%" align="center" valign="middle"><select name="honest_mistakes"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Management genuinely seeks and responds to suggestions and ideas.</td>
    <td align="center" valign="middle"><select name="respond_suggestions"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">When I look at what we accomplish, I feel a sense of pride.</td>
    <td width="35%" align="center" valign="middle"><select name="sense_pride"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">I feel I receive fair share of the profits made by this organization.</td>
    <td align="center" valign="middle"><select name="fair_share"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">Management keeps me informed about important issues and changes.</td>
    <td width="35%" align="center" valign="middle"><select name="informed_issues"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Management has a clear view of where the organization is going and how to get there.</td>
    <td align="center" valign="middle"><select name="clear_view"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">Management trusts people to do a good job without watching over their shoulders</td>
    <td width="35%" align="center" valign="middle"><select name="trust_people"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Management involves people in decisions that affect their jobs or work environment.</td>
    <td align="center" valign="middle"><select name="involves_people"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">Managers avoid playing favorites.</td>
    <td width="35%" align="center" valign="middle"><select name="avoid_playing"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">I feel good about the ways we contribute to the community.</td>
    <td align="center" valign="middle"><select name="ways_contribute"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">Management does a good job of assigning and coordinating people.</td>
    <td width="35%" align="center" valign="middle"><select name="assigning_coordinating"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">People here are given a lot of responsibility.</td>
    <td align="center" valign="middle"><select name="given_responsibility"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">This is psychologically and emotionally healthy place to work.</td>
    <td width="35%" align="center" valign="middle"><select name="emotionally_healthy"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">People here are treated fairly regardless of their age.</td>
    <td align="center" valign="middle"><select name="treated_fairly"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">Promotion goes to those who best deserve them.</td>
    <td width="35%" align="center" valign="middle"><select name="best_deserve"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">People look forward to coming to work here.</td>
    <td align="center" valign="middle"><select name="coming_to_work"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">I can be myself around here.</td>
    <td width="35%" align="center" valign="middle"><select name="myself_here"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Management delivers on its promise.</td>
    <td align="center" valign="middle"><select name="delivers_promise"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">People here are treated fairly regardless of their race or ethnic origin.</td>
    <td width="35%" align="center" valign="middle"><select name="treated_fair_race"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">People care about each other here.</td>
    <td align="center" valign="middle"><select name="care_each_other"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
    <tr bgcolor="#FFFFFF">
    <td width="65%" class="lfttxtbar">Management's action match its words.</td>
    <td width="35%" align="center" valign="middle"><select name="action_match"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">Our facilities contribute to a good working environment.</td>
    <td align="center" valign="middle"><select name="good_working"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>

  <tr bgcolor="#FFFFFF">
    <td class="lfttxtbar">People here are treated fairly regardless of their sex.</td>
    <td align="center" valign="middle"><select name="treated_fair_sex"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>

  <tr bgcolor="#f2f2f2">
    <td class="lfttxtbar">I'm proud to tell others I work here.</td>
    <td align="center" valign="middle"><select name="tell_others"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>

  <tr bgcolor="#FFFFFF">
    <td class="lfttxtbar">There is a "family" or "team" feeling here.</td>
    <td align="center" valign="middle"><select name="ft_feeling"><option value="">Select</option>
<option value="I always agree">I always agree</option><option value="I often agree">I often agree</option><option value="Sometimes I agree, sometimes I disagree">Sometimes I agree, sometimes I disagree</option><option value="I often disagree">I often disagree</option><option value="I always disagree">I always disagree</option></select></td>
  </tr>
  <tr bgcolor="#FFFFFF"><td>&nbsp;</td>
  <td><input type="submit" name="submit" value="Submit" /></td></tr>


</table>





</form>
</body>
</html>
