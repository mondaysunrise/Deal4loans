<?php
	require 'scripts/session_check.php';
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'scripts/home_loan_eligibility_function.php';
//	require 'getlistofeligiblebidders1.php';
//cho "uh";

function DetermineAgeFromDOB ($YYYYMMDD_In)
{
  $yIn=substr($YYYYMMDD_In, 0, 4);
  $mIn=substr($YYYYMMDD_In, 4, 2);
  $dIn=substr($YYYYMMDD_In, 6, 2);

  $ddiff = date("d") - $dIn;
  $mdiff = date("m") - $mIn;
  $ydiff = date("Y") - $yIn;

  // Check If Birthday Month Has Been Reached
  if ($mdiff < 0)
  {
    // Birthday Month Not Reached
    // Subtract 1 Year From Age
    $ydiff--;
  } elseif ($mdiff==0)
  {
    // Birthday Month Currently
    // Check If BirthdayDay Passed
    if ($ddiff < 0)
    {
      //Birthday Not Reached
      // Subtract 1 Year From Age
      $ydiff--;
    }
  }
  return $ydiff;
}

function getProductName($pKey){
	$titles = array(
		'Req_Loan_Personal' => 'Personal Loan',
		'Req_Loan_Home' => 'Home Loan',
		'Req_Loan_Car' => 'Car Loan',
		'Req_Credit_Card' => 'Credit Card',
		'Req_Loan_Against_Property' => ' Loan Against property',
		'Req_Life_Insurance' => 'Insurance',
	);

	foreach ($titles as $key=>$value)
	    if($pKey==$key)
		return $value;

	return "";
   }
 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
		$City = $_POST['City'];
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		$Net_Salary = $_POST['Net_Salary'];
		$monthly_income = ($Net_Salary /12);
		$loan_amount = $_POST['Loan_Amount'];
		$Type_Loan = "Req_Loan_Home";
		$source = $_POST['source'];
		$Creative = $_POST['creative'];
		$Section = $_POST['section'];
		$Accidental_Insurance = $_POST['Accidental_Insurance'];
		$Referrer=$_REQUEST['referrer'];
		$IP = getenv("REMOTE_ADDR");
		$DOB = str_replace("-","", $dateofbirth);
		$DOB = DetermineAgeFromDOB($DOB);
		$tenorPossible = 60 - $DOB;
		$edelweiss = $_POST["edelweiss"];
		$accept = $_POST['accept'];
		$Ibibo_compaign = $_POST['Ibibo_compaign'];
		//$getDOB = str_replace("-","", $dateofbirth);
$age =$DOB;
//echo $age."<br>";
$agecalc="50";
$exactage = $agecalc- $age;
//echo $exactage."<br>";
//get inflation amount
$getinflation = $Net_Salary *(5/100);
$getinflationage = $getinflation * $exactage;
$getexactvalue = $getinflationage + $Net_Salary;
$getexactvaluemonthly = $getexactvalue/12;
	
	$IsPublic = 1;
	if($Activate>0)
	{
		$DeleteIncompleteSql = "Delete from Req_Incomplete_Lead where IncompeletID=".$Activate;		
		$deleterowcount=Maindeletefunc($DeleteIncompleteSql,$array = array());
	}

function  Insert_ibibo($ProductValue, $Name, $City, $Phone, $DOB, $Ibibo_compaign, $Email )
	{
		$Dated = ExactServerdate();		
		$dataInsert = array("ibibo_product"=>'2' , "ibibo_requestid"=>$ProductValue , "ibibo_name"=>$Name , "ibibo_city"=>$City , "ibibo_mobile"=>$Phone, "ibibo_dob"=>$DOB , "ibibo_car_name"=>$Ibibo_compaign , "ibibo_dated"=>$Dated , "ibibo_email"=>$Email );
		$table = 'ibibo_compaign_leads';
		$insert = Maininsertfunc ($table, $dataInsert);
	}

		$crap = " ".$Name." ".$Email;
		//echo $crap,"<br>";
		$crapValue = validateValues($crap);
		$_SESSION['crapValue'] = $crapValue;
		//exit();
		if($crapValue=='Put')
		{
			$tomorrow  = mktime(0, 0, 0, date("m")  , date("d")-30, date("Y"));
			$days30date=date('Y-m-d',$tomorrow);
			$days30datetime = $days30date." 00:00:00";
			$currentdate= date('Y-m-d');
			$currentdatetime = date('Y-m-d')." 23:59:59";
			
			$getdetails="select RequestID From ".$Type_Loan."  Where ((Mobile_Number='".$Phone."' and Mobile_Number not in ('9891118553','9811215138','9971396361')) and Updated_Date between '".$days30datetime."' and '".$currentdatetime."') order by RequestID DESC";
			list($alreadyExist,$myrow)=MainselectfuncNew($getdetails,$array = array());
			$myrowcontr=count($myrow)-1;
			if($alreadyExist>0)
			{
				$ProductValue = $myrow[$myrowcontr]["RequestID"];
				$_SESSION['Temp_LID'] = $ProductValue;
				echo "<script language=javascript>"." location.href='update-home-loan-lead.php'"."</script>";
			}
			else
			{			
			$CheckSql = "select UserID from wUsers where Email = '".$Email."'";
			list($alreadyExist,$myrow)=MainselectfuncNew($CheckSql,$array = array());
			$myrowcontr=count($myrow)-1;
			$CheckNumRows = $alreadyExist;
			$Dated = ExactServerdate();
			if($CheckNumRows>0)
			{
				$UserID = $myrow[$myrowcontr]["UserID"];
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>'1', 'DOB'=>$dateofbirth, '	Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Privacy'=>$accept);
			}
			else
			{
				$wUsersdata = array("Email"=>$Email, "FName"=>$Name, "Phone"=>$Phone, "Join_Date"=>$Dated, "IsPublic"=>$IsPublic);
				$UserID = Maininsertfunc("wUsers", $wUsersdata);
				$dataArray = array('UserID'=>$UserID, 'Name'=>$Name, 'Email'=>$Email, 'City'=>$City, 'City_Other'=>$City_Other, 'Mobile_Number'=>$Phone, 'Net_Salary'=>$Net_Salary, 'Loan_Amount'=>$loan_amount, 'Dated'=>$Dated, 'source'=>$source, 'Referrer'=>$Referrer, 'Creative'=>$Creative, 'Section'=>$Section, 'IP_Address'=>$IP, 'Reference_Code'=>$Reference_Code, 'Updated_Date'=>$Dated, 'Accidental_Insurance'=>$Accidental_Insurance, 'Property_Identified'=>$Property_Identified, 'Employment_Status'=>'1', 'DOB'=>$dateofbirth, '	Property_Loc'=>$Property_Loc, 'Co_Applicant_Name'=>$co_name, 'Co_Applicant_DOB'=>$DOB_co, 'Co_Applicant_Income'=>$co_monthly_income, 'Co_Applicant_Obligation'=>$co_obligations, 'Property_Value'=>$property_value, 'Total_Obligation'=>$obligations, 'Edelweiss_Compaign'=>$edelweiss, 'Pincode'=>$Pincode, 'Privacy'=>$accept);
				//echo "<br>else".$InsertProductSql;
			}
			
			//echo $InsertProductSql."<br>";
			$ProductValue = Maininsertfunc ("Req_Loan_Home", $dataArray);
			$_SESSION['Temp_LID'] = $ProductValue;
			$_SESSION['ProductValue'] = $ProductValue;
			$_SESSION['strcity'] = $City;
			$_SESSION['Name'] = $Name;

			if($City=="Others")
		{
			$strcity = $City_Other;
		}
		else
		{
			$strcity=$City;
		}
if($hdfclife==1)
		{
			$Product=2;
			Insert_HdfcLife($Name, $City, $Phone, $dateofbirth, $Email, $Net_Salary, $Product, $ProductValue );
		}

		if(strlen($Ibibo_compaign)>0)
		{
			Insert_ibibo($ProductValue, $Name, $strcity, $Phone, $DOB, $Ibibo_compaign, $Email);
		}
			
			list($First,$Last) = split('[ ]', $Name);

			
			$SMSMessage = "Dear $First,Thanks for applying at Deal4loans for Home loan";
			
			if(strlen(trim($Phone)) > 0)
			{
				//SendSMS($SMSMessage, $Phone);
				NewAir2webSendSMS($SMSMessage, $Phone, 2, $ProductValue);
			}
			//Code Added to mailtocommonscript.php
			$FName = $Name;
			$Checktosend="getthank_individual";
			include "scripts/mailatcommonscript.php";

			$headers  = 'From: Deal4loans <no-reply@deal4loans.com>' . "\r\n";
			$headers .= "Return-Path: <no-reply@deal4loans.com>\r\n";  // Return path for errors
			$headers .= "Bcc: testthankuse@gmail.com"."\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$FName=$Name;
			if($Name)
				$SubjectLine = $Name.", Learn to get Best Deal on Home Loan";
			else
				$SubjectLine = "Learn to get Best Deal on Home Loan";
			//echo $Type_Loan;
			if(isset($Type_Loan))
			{
				mail($Email, $SubjectLine, $Message2, $headers);
			}
			
			
			}
		}//$crap Check
		else if($crapValue=='Discard')
		{
			header("Location: Redirect.php");
			exit();
		}
		else
		{
			header("Location: Redirect.php");
			exit();
		}
}

$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>  
<title>Apply Home Loan - Compare interest Rates, Eligibility, Banks and Apply Home Loans online</title>
<meta name="keywords" content="apply home loan, housing loan, Apply Home Loans, online home loans, online home loan, Housing Loans, apply Home loans India,">
<meta name="description" content="Home Loan apply : Apply for home loans Online and get quotes from all home loan provider of India like Mumbai, Delhi, Noida, Kolkata, Gurgaon, Bangalore, Chennai, Hyderabad, Pune etc.">
<link rel="canonical" href="http://www.deal4loans.com/apply-home-loans.php"/>
<link href="source.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="scripts/mainmenu.js"></script>
  <link href="css/slider.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="js/easySlider1.5.js"></script>
 <script type="text/javascript" src="scripts/common.js"></script>
 <script language="JavaScript" type="text/javascript" src="http://www.deal4loans.com/suggest.js"></script>
 
<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				controlsBefore:	'<p id="controls">',
				controlsAfter:	'</p>',
				auto: false, 
				continuous: true
				
			});
			$("#slider2").easySlider({
				controlsBefore:	'<p id="controls2">',
				controlsAfter:	'</p>',		
				prevId: 'prevBtn2',
				nextId: 'nextBtn2',
				auto: true, 
				continuous: true	
			});		
		});	
	</script>
<style type="text/css">
<!--
 
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #203f5f;
	overflow-x:hidden;
	background-color:#FFF;
}
.red {
	color: #F00;
}
-->
</style>
<link href="source.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="/scripts/common.js"></script>
<script language="javascript">
function onFocusBlank(element,defaultVal){
	if(element.value==defaultVal){
		element.value="";
	}
}

function onBlurDefault(element,defaultVal){
	if(element.value==""){
		element.value = defaultVal;
	}
}

function cityother()
{
	if(document.loan_form.City.value=="Others")
	{
		document.loan_form.City_Other.disabled = false;
	}
	else
	{
		document.loan_form.City_Other.disabled = true;
	}
} 

function Trim(strValue) 
{
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}

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


function chkform()
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	//var i;
	var cnt;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
		
	if(document.loan_form.day.value=="" || document.loan_form.day.value=="dd")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		document.loan_form.day.focus();
		return false;
	}
	if(document.loan_form.day.value!="")
	{
		if((document.loan_form.day.value<1) || (document.loan_form.day.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			document.loan_form.day.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.day, 'Day', 2))
		return false;
	
	if(document.loan_form.month.value=="" || document.loan_form.month.value=="mm")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		document.loan_form.month.focus();
		return false;
	}
	if(document.loan_form.month.value!="")
	{
		if((document.loan_form.month.value<1) || (document.loan_form.month.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			document.loan_form.month.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.month, 'month', 2))
		return false;

	if(document.loan_form.year.value=="" || document.loan_form.year.value=="yyyy")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		document.loan_form.year.focus();
		return false;
	}
	if(document.loan_form.year.value!="")
	{
		if((document.loan_form.year.value < "<?php echo $maxage;?>") || (document.loan_form.year.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			document.loan_form.year.focus();
			return false;
		}
	}
	if(!checkData(document.loan_form.year, 'Year', 4))
		return false;

<?php
if($City == "Others")
{
?>
	if( ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	for (var i = 0; i <document.loan_form.City_Other.value.length; i++) {
  	if (iChars.indexOf(document.loan_form.City_Other.value.charAt(i)) != -1) {
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Remove Special Characters!</span>";	
		document.loan_form.City_Other.focus();
  		return false;
  	}
  }
<?php
}
?>		
	
	if (document.loan_form.Pincode.value=="")
	{
		document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode!</span>";	
		document.loan_form.Pincode.focus();
		return false;
	}
	if (document.loan_form.Pincode.value!="")
	{
		if(document.loan_form.Pincode.value.length < 6)
		{
			document.getElementById('pincodeVal').innerHTML = "<span  class='hintanchor'>Enter Pincode(6 Digits)!</span>";	
			document.loan_form.Pincode.focus();
			return false;
		}
	}

	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}

	for(j=0; j<document.loan_form.Property_Identified.length; j++) 
	{
        if(document.loan_form.Property_Identified[j].checked)
		{
   	 		cnt= j;
		}
	}
	if(cnt == -1) 
	{
		document.getElementById('propEditifiedVal').innerHTML = "<span  class='hintanchor'>Select Property identified or not!</span>";	
		return false;
	}
	if(cnt ==0)
	{ 
		if(document.loan_form.Property_Loc.selectedIndex==0)
		{
			document.getElementById('propEditifiedVal').innerHTML = "<span  class='hintanchor'>Select Property Location!</span>";	
			document.loan_form.Property_Loc.focus();
			return false;
		}
	}
	
}  


function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
	{
		if(d==j)
		{
			if(eval(document.getElementById("divfaq"+j)).style.display=='none')
			{
				eval(document.getElementById("divfaq"+j)).style.display=''
			}
			else
			{
				eval(document.getElementById("divfaq"+j)).style.display='none'
			}
		}
			
	}
}

function addIdentified()
{
		var ni1 = document.getElementById('myDiv1');
	 ni1.innerHTML = '<div style=" float:left; width:183px; height:47px;  margin-top:5px;"><div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Location</div>    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><select name="Property_loc" id="Property_loc" style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;"><?=getCityList1($City)?></select></div><div id="vintageVal"></div></div>';
		
		return true;
}	
	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';
				
		return true;

}	

function validateDiv(div)
{

	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}




  </script>
<style type="text/css">
<!--
.style1 {font-family: 'Droid Sans', sans-serif}
.style2 {font-size: 12px; font-variant: normal; color: #666666; text-decoration: none; @import url(http://fonts.googleapis.com/css?family=Droid+Sans);font-family: 'Droid Sans', sans-serif;}
-->
</style>
</head>

<body>
<!--top-->
<form name="loan_form" method="post" action="insert_home_loan_stage2.php" onSubmit="return chkform();">
<!--   <form name="loan_form" method="post" action="homeloanthanks.php" onSubmit="return chkform();"> -->

<?php include "top-menu.php"; ?>
<!--top-->

<!--logo navigation-->
<?php include "main-menu.php"; ?>
<!--logo navigation-->


<div class="text12" style="margin:auto; width:970px; height:11px; margin-top:11px; color:#0a8bd9;"><u><a href="index.php" class="text12" style="color:#0080d6;" >Home</a></u> > <a href="home-loans.php"  class="text12" style="color:#0080d6;"><u>Home Loan</u></a> <span class="text12" style="color:#4c4c4c;">> Apply for Home Loan</span></div>
<div style="clear:both; height:15px;"></div>

<table width="663" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td  align="left" valign="top" ><table width="960" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="14" align="left" valign="top"><img src="images/bgtop1.jpg" width="960" height="14" /></td>
      </tr>
      <tr>
        <td height="35" align="left" valign="top" bgcolor="#21405F"><table width="955" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="24">&nbsp;</td>
            <td width="735"><div class="text3" style=" color:#FFF; font-size:16px; text-transform:none; "><strong><span style="color:#8dae48;">Step 2</span> - To get  online quotes from all Banks-Please Input further details</strong></div></td>
            <td width="196" rowspan="2" valign="top">&nbsp;</td>
          </tr>
          
          </table></td>
      </tr>
      <tr>
        <td  align="center" valign="top" bgcolor="#21405F"><table width="943" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="11" rowspan="2" align="left" valign="top">&nbsp;</td>
            <td width="183" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
              
                <tr>
                  <td height="55" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">DOB:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                        <div class="text" style=" float:left; clear:right;">
                       <input type="hidden" value="<? echo $Net_Salary;?>" name="Net_Salary" />
        <input type="hidden" value="<? echo $_SESSION['Temp_LID'];?>" name="leadid" />
            <input type="hidden" value="<? echo $Name;?>" name="Name" />
                        <input name="day" id="day" type="text" style="width:43px; height:18px;" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="1" />&nbsp;
                        </div>
                      <div class="text" style=" float:left; clear:right;">
                        <input name="month" id="month" type="text" style="width:43px; height:18px;" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="2" />&nbsp;
                        </div>
                      <div class="text" style=" float:left; clear:right;">
                        	<input name="year" id="year" type="text" style="width:60px; height:18px;" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" onkeydown="validateDiv('dobVal');" tabindex="3" />
                        </div>
                           <div id="dobVal"></div>   
                    </div>
                  </div></td>
                </tr>
                
                <tr>
                  <td height="58"><div style=" float:left; width:183px; margin-left:0px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:11px; text-transform:none; margin-top:5px;">                      Total Monthly EMI for all running 
                      loans : </div>
                  </div>
                  </td>
                </tr>
               
               
            </table></td>
            <td width="58" align="left" valign="top">&nbsp;</td>
            <td width="185" align="left" valign="top"><table width="192" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Other City:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                    <?php 
				  if($City=="Others")
                  {
                  ?>
                   <input name="City_Other" id="City_Other" type="text" style="width:180px; height:16px;" onKeyUp="searchSuggest();" onkeydown="validateDiv('othercityVal');"  tabindex="4" />
                  <?php
                  }
                  else
                  { ?>
                       <input name="City_Other" id="City_Other" type="text" style="width:180px; height:16px;" disabled onKeyUp="searchSuggest();" onkeydown="validateDiv('othercityVal');"  />
                   <?php
                   }
                   ?>
                       
                        <div id="othercityVal"></div>   
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="58"><div style=" float:left; width:183px; height:40px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input  name="obligations" id="obligations" onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" style="width:180px; height:18px;" tabindex="7" /></div></div></td>
              </tr>
            </table></td>
            <td width="50" align="left" valign="top">&nbsp;</td>
            <td width="186" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="183" height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Pincode:</div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;"><input name="Pincode" id="Pincode" maxlength="6" onkeypress="intOnly(this);" onkeyup="intOnly(this);"  onkeydown="validateDiv('pincodeVal');" type="text" style="width:180px; height:18px;" tabindex="5" />
         <div id="pincodeVal"></div>
                    </div>
                </div></td>
              </tr>
              <tr>
                <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"><span class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Occupation: </span></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                 <select name="Employment_Status" id="Employment_Status"  onchange="validateDiv('empStatusVal');"  style="width:180px; height:24px; font-family:Verdana, Geneva, sans-serif; font-size:11px; color:#4c4c4c;" tabindex="8" >
                           <option value="-1">Please Select</option>
                           <option value="1">Salaried</option>
                           <option value="0">Self Employment</option>
                     </select>
                       <div id="empStatusVal"></div>
                    </div>
                </div></td>
              </tr>
           
            </table></td>
            <td width="56" align="left" valign="top">&nbsp;</td>
            <td width="214" align="left" valign="top"><table width="183" border="0" cellspacing="0" cellpadding="0">
              <tr>
                  <td height="58" align="left" valign="top"><div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                      <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Property Value:</div>
                    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
                    <input  name="property_value"  id="property_value" maxlength="10"   onkeyup="intOnly(this);" onkeypress="intOnly(this);" type="text" style="width:180px; height:18px;" onkeydown="validateDiv('propertyValueVal');"  tabindex="6" />
         <div id="propertyValueVal"></div>   
                      </div>
                  </div></td>
                </tr>
                <tr>
                  <td height="58">
                 <div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:5px;">
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;"></div>
                  <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:17px;">
                    <div style=" float:left; width:70px; height:auto; clear:right; ">Property Identified:</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:0px; margin-top:5px; ">
                   <input type="radio" name="Property_Identified" id="Property_Identified" value="1" onclick="return addIdentified();" style="border:none;" />
                    </div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:8px; margin-top:8px; "> Yes</div>
                    <div style=" float:left; width:15px; height:auto; clear:right; margin-left:13px; margin-top:5px; ">
                  <input type="radio"  name="Property_Identified" id="Property_Identified" onclick="removeIdentified();" value="0" style="border:none;" checked="checked" />
                    </div>
                    <div style=" float:left; width:10px; height:auto; clear:right; margin-left:5px; margin-top:8px; "> No</div>
                     <div id="propEditifiedVal"></div>   
                  </div>
                </div></td>
                </tr>
                 <tr>
                <td  id="myDiv1" >
          </td>
            </table></td>
          </tr>
          <tr>
            <td colspan="7" align="left" valign="top" ><div style="display:none; " id="divfaq1">
<div style=" float:left; width:881px; height:auto; margin-left:5px; margin-top:7px;">
  <div style=" float:left; width:183px; height:47px; margin-left:0px; margin-top:0px;">
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Co-applicant Name:</div>
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
      <input name="co_name" id="co_name" type="text" style="width:180px; height:18px;" />
     
    </div>
  </div>
  <div style=" float:left; width:183px; height:44px; margin-left:55px; margin-top:0px;">
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Co-applicant DOB:</div>
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
        <div class="text" style=" float:left; clear:right; padding-right:6px;">
          <input name="co_day" id="co_day" type="text" style="width:45px; height:18px;" value="dd" onblur="onBlurDefault(this,'dd');" onfocus="onFocusBlank(this,'dd');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);"/>
        </div>
        <div class="text" style=" float:left; clear:right; padding-right:6px;">
          <input name="co_month" id="co_month" type="text" style="width:45px; height:18px;" value="mm" onblur="onBlurDefault(this,'mm');" onfocus="onFocusBlank(this,'mm');" maxlength="2" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
        </div>
        <div class="text" style=" float:left; clear:right;">
          <input name="co_year" id="co_year" type="text" style="width:66px; height:18px;" value="yyyy" onblur="onBlurDefault(this,'yyyy');" onfocus="onFocusBlank(this,'yyyy');" maxlength="4" onkeyup="intOnly(this);" onkeypress="intOnly(this);" />
        </div>
        <div id="co_dobVal"></div>
      

    </div>
  </div>
  <div style=" float:left; width:183px; height:47px; margin-left:52px; margin-top:0px;" class="text" >
     <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Gross Annual Salary:</div>
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
      
        <input type="text" name="co_monthly_income" id="co_monthly_income" style="width:180px; height:18px;"  onkeyup="intOnly(this); getDigitToWords('Net_Salary','formatedIncome','wordIncome');" onkeypress="intOnly(this);"  onblur="getDigitToWords('Net_Salary','formatedIncome','wordIncome');"  onchange="ShowHide('incomeShow','Net_Salary');" />
      </div>
      <div id="co_incomeVal"></div>   
      </div>
  
  
  <div style=" float:left; width:183px; height:47px; margin-left:35px; margin-top:0px;">
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none;">Monthly EMIs :</div>
    <div class="text" style=" float:left; width:180px; height:auto; color:#FFF; font-size:12px; text-transform:none; margin-top:5px;">
    <input name="co_obligations" id="co_obligations" maxlength="8" onkeypress="intOnly(this);" onkeyup="intOnly(this);" type="text" style="width:180px; height:18px;" />
    </div>
  </div>
</div>
</div>
<!-- End-->

       </td>
       </tr>
          <tr>
            <td height="40" colspan="9" align="left" valign="top">
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="109"  height="44" align="left" valign="top" class="text" style=" float:left; height:auto; color:#FFF; font-size:11px; text-transform:none; clear:right; margin-top:7px; ">
                      <input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" >
                                Co - applicant
                </td>
                <td width="662" align="left" valign="top" class="text" >
                   <? /*if(($City!="Ahmedabad") && ($City!="Allahabad") && ($City!="Bangalore") && ($City!="Baroda") && ($City!="Bhubaneshwar") && ($City!="Chandigarh") && ($City!="Chennai") && ($City!="Cochin") && ($City!="Cuttack") && ($City!="Delhi") && ($City!="Faridabad") && ($City!="Gaziabad") && ($City!="Greater Noida") && ($City!="Gurgaon") && ($City!="Guwahati") && ($City!="Hyderabad") && ($City!="Indore") && ($City!="Jaipur") && ($City!="Kanpur") && ($City!="Kochi") && ($City!="Kolkata") && ($City!="Lucknow") && ($City!="Mumbai") && ($City!="Noida") && ($City!="Pune") && ($City!="Sahibabad") &&
($City!="Surat") && ($City!="Thane") && ($City!="Vadodara") && $City!="Vijaywada" && ($City!="Vishakapatanam") && ($City!="Vizag" ))  { */
	?>
	<!--<table  style="border:1px solid #FFFFFF; padding:2px;"><tr><td colspan="2" class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " height="20"><u><b>Special service only for Deal4loans customers:</b></u></td></tr> <tr><td class="frmbldtxt" style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " colspan="2"> You are now a step closer to selecting the right Loan Deal for yourself! All you need is a complete picture of all your finances from MyUniverse!. <br><b>90 days free trial of MyUniverse</b></td></tr> <tr><td width="21"><input type="radio" name="adty_brl" id="adty_brl" value="1" checked/></td><td style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " width="611">Yes, Please register me in MyUniverse</td></tr><tr><td width="21"><input type="radio" name="adty_brl" id="adty_brl" value="2"/></td><td style="font-family:verdana; font-size:10px; color:#FFFFFF; font-weight:normal; " width="611">No, Thank you</td></tr>	 </table>-->
 <? //} ?>
               </td>
                <td width="120" align="right" valign="top"><div style=" float:right; width:114px; height:47px; margin-top:0px; clear:right; margin-left:0px;"> <input type="submit" style="border: 0px none ; background-image: url(images/get1.gif); width: 114px; height: 52px; margin-bottom: 0px;" value=""/></div></td>
              </tr>
            </table>
            </td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td height="14" align="center" valign="top"><img src="images/bgbottom1.jpg" width="960" height="14" /></td>
      </tr>
    </table></td>
  </tr>
</table>

<!--partners-->
<div class="text11" style="margin:auto; width:962px; height:auto; margin-top:15px; color:#88a943; font-size:17px; font-weight:bold;">Quotes available from following Banks - Maximum Home loan Bank Tie ups in online space<br />
</div>
<div style="margin:auto; width:949px; height:85px;; margin-top:10px;">
<div class="sldrpnl" >
	<div id="slider">
		<ul>				
			        <li>
<div><img src="/new-images/slider/thumb/hdfc-h.jpg" alt="HDFC" width="126" height="52"  style="border:none;"/></div>
<div><img src="/new-images/slider/thumb/axis.jpg" alt="Axis Bank" width="140" height="42"  style="border:none;"/></div>
<div><img src="/new-images/slider/thumb/hfc_logo.jpg" alt="ICICI HFC" width="147" height="37"  style="border:none;"/></div>
<div><img src="/new-images/slider/thumb/fblue.gif" alt="First Blue" width="126" height="41"  style="border:none;"/></div>

            </li>
            <li>
<div><img src="/new-images/slider/thumb/hdfc-h.jpg" alt="HDFC" width="126" height="52"  style="border:none;"/></div>
<div><img src="/new-images/slider/thumb/axis.jpg" alt="Axis Bank" width="140" height="42"  style="border:none;"/></div>
<div><img src="/new-images/slider/thumb/hfc_logo.jpg" alt="ICICI HFC" width="147" height="37"  style="border:none;"/></div>
<div><img src="/new-images/slider/thumb/fblue.gif" alt="First Blue" width="126" height="41"  style="border:none;"/></div>       </li>
		</ul>
	</div>
</div>
</div>
<!--partners-->
<?php include "footer1.php"; ?>
</form>
</body>
</html>