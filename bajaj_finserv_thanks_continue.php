<?php
session_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	require 'bajajfs_leadallocation.php';

$maxage=date('Y')-62;
$minage=date('Y')-18;
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}
$Dated = ExactServerdate();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

		$RequestID= FixString($_POST["RequestID"]);
		$first_name = FixString($_POST["first_name"]);
		$middle_name = FixString($_POST["middle_name"]);
		$last_name = FixString($_POST["last_name"]);
		$Name= $first_name." ".$middle_name." ".$last_name;
		$Email = FixString($_POST["Email"]);
		$Mobile_Number = FixString($_POST["mobile"]);
		$City = FixString($_POST["City"]);
		$Employment_Status = FixString($_POST["Employment_Status"]);
		$Net_Salary = FixString($_POST["IncomeAmount"]);
		$Loan_Amount = FixString($_POST["Loan_Amount"]);
		$Company_Name = FixString($_POST["Company_Name"]);
		$bajajf_source = FixString($_POST["Source"]);
		$bajajf_section = FixString($_POST["section"]);

		$pr_product=0;
		$Pincode=0;
		$City_Other="";
		$Dated = ExactServerdate();
$getcompany='select * from pl_company_list where (company_name="'.$Company_Name.'")';
 list($alreadyExist,$grow)=MainselectfuncNew($getcompany,$array = array());
$growcontr=count($grow)-1;
	 $bajajfinservcomp = $grow[$growcontr]["bajajfinserv"];


				if(strlen($Name)>0 && strlen($Mobile_Number>10))
				{
					$selbjaj_fin="select bajajf_mobile From bajaj_finserv_mailer_leads Where (bajajf_mobile='".$Mobile_Number."' and bajajf_mobile not in ('9811215138','9999570210','9717594462'))";
				
					list($bjrecordcount,$bjresult)=MainselectfuncNew($selbjaj_fin,$array = array());
		
					if($bjrecordcount>0)
					{
						$mailerval="Alreadyexist";
					}
					else
					{
						$Dated = ExactServerdate();
						$dataInsert = array('bajajf_requestid'=>$RequestID, 'bajajf_product'=>$pr_product, 'bajajf_name'=>$Name, 'bajajf_email'=>$Email, 'bajajf_mobile'=>$Mobile_Number, 'bajajf_city'=>$City, 'bajajf_city_other'=>$City_Other, 'bajajf_net_salary'=>$Net_Salary, 'bajajf_loan_amount'=>$Loan_Amount, 'bajajf_pincode'=>$Pincode, 'bajajf_dated'=>$Dated, 'bajajf_company_name'=>$Company_Name, 'bajajf_source'=>$bajajf_source, 'bajajf_employment_status'=>$Employment_Status, 'ip_address'=>$IP, 'bajajf_section'=>$bajajf_section);	

//print_r($dataInsert);
						$bajajvalue = Maininsertfunc ('bajaj_finserv_mailer_leads', $dataInsert);
						$mailerval="Inserted";
						if($City=="Others" && strlen($City_Other)>0)
						{
							$marvcity=$City_Other;
						}
						else
						{
							$marvcity=$City;
						}

						$city=$marvcity;
						if(strlen($bajajfinservcomp)>2 && $Employment_Status==1 && $Net_Salary>=300000)
						{
							$sentflag=bajajfs($marvcity,$Net_Salary,$Mobile_Number,$Name,$bajajvalue,$Company_Name,$Loan_Amount);
						//direct allocation clause
	if((($city=="Ahmedabad" || $city=="Bangalore" || $city=="Chandigarh" || $city=="Chennai" || $city=="Cochin" || $city=="Coimbatore" || $city=="Delhi" || $city=="Hyderabad" || $city=="Jaipur" || $city=="Kolkata" || $city=="Ludhiana" || $city=="Mumbai" || $city=="Navi Mumbai" || $city=="Thane" || $city=="Nagpur" || $city=="Pune" || $city=="Surat" || $city=="Bharuch" || $city=="Ankleshwar" || $city=="Vapi" || $city=="Navsari" || $city=="Valsad" || $city=="Silvassa" || $city=="Daman" || $city=="Noida" || $city=="Gurgaon" || $city=="Faridabad" || $city=="Gaziabad") && $Net_Salary>=480000) || (($city=="Agra" || $city=="Anand" || $city=="Baroda" || $city=="Vadodara" || $city=="Aurangabad" || $city=="Bhopal" || $city=="Bhubaneswar" || $city=="Cuttack" || $city=="Bilaspur" || $city=="Durgapur" || $city=="Goa" || $city=="Vasco" || $city=="Ponda" || $city=="Panjim" || $city=="Masa" || $city=="" || $city=="Indore" || $city=="jalandhar" || $city=="Hoshiarpur" || $city=="Kapurthala" || $city=="Phagwara" || $city=="Jamnagar" || $city=="Jamshedpur" || $city=="Jodhpur" || $city=="Kakinada" || $city=="Kanpur" || $city=="Kolhapur" || $city=="Sangli" || $city=="Kota" || $city=="Lucknow" || $city=="Madurai" || $city=="Mangalore" || $city=="Udipi" || $city=="Mysore" || $city=="Nasik" || $city=="Nellore" || $city=="Panipat" || $city=="Karnal" || $city=="Kurukshetra" || $city=="Patiala" || $city=="Patna" || $city=="Raipur" || $city=="Bhilai" || $city=="Rajahmundry" || $city=="Ranchi" || $city=="Salem" || $city=="Tirupati" || $city=="Trichy" || $city=="Trivandrum" || $city=="Udaipur" || $city=="Vijaywada" || $city=="Guntur" || $city=="Vizag" || $city=="Vishakapatanam" ) && $Net_Salary>=360000))
				{
					$bajajInsert = array('bajajf_plrequestid'=>$RequestID, 'bajajf_name'=>$Name, 'bajajf_loan_amt'=>$Loan_Amount, 'bajajf_cpincode'=>$Pincode, 'bajajf_company_name'=>$Company_Name, 'bajajf_salary'=>$Net_Salary, 'bajaj_dated'=>$Dated, 'bajajf_city'=>$City, 'bajajf_mobile'=>$Mobile_Number, 'bajajf_source'=>$bajajf_source, 'ip_address'=>$IP, 'bajajf_section'=>$bajajf_section);
				$bajajvaluecibil = Maininsertfunc ('bajaj_cibildetails', $bajajInsert);
					$dataUpdate = array('bajajf_sent'=>'1');
					$wherecondition = "(bajaj_finservid=".$bajajvalue.")";
					Mainupdatefunc ('bajaj_finserv_mailer_leads', $dataUpdate, $wherecondition);
				}
						
						}
						else
						{
							if($Employment_Status==1 && $Net_Salary>=900000)
							{
								
	$bajajInsert = array('bajajf_plrequestid'=>$RequestID, 'bajajf_name'=>$Name, 'bajajf_loan_amt'=>$Loan_Amount, 'bajajf_cpincode'=>$Pincode, 'bajajf_company_name'=>$Company_Name, 'bajajf_salary'=>$Net_Salary, 'bajaj_dated'=>$Dated, 'bajajf_city'=>$City, 'bajajf_mobile'=>$Mobile_Number, 'bajajf_source'=>$bajajf_source, 'ip_address'=>$IP, 'bajajf_section'=>$bajajf_section);
	//echo $bajajcibil."<br>";
					$bajajvaluecibil = Maininsertfunc ('bajaj_cibildetails', $bajajInsert);

						$dataUpdate = array('bajajf_sent'=>'1');
					$wherecondition = "(bajaj_finservid=".$bajajvalue.")";
					Mainupdatefunc ('bajaj_finserv_mailer_leads', $dataUpdate, $wherecondition);
							
							}

						}
						//direct allocation ends here
		//echo $sentflag;
					}
					
				}
			}

if($_POST)
{
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Bajaj Finserv Personal Loans | Personal Loan Rates | Personal Loan EMI</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link href="css/bajaj-finserv-pl-styles.css" rel="stylesheet" type="text/css">
<link href="css/bajaj-finserv-pl-media.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script type="text/javascript">
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

function ckhcreditcard(Form)
{
var a=Form.panno.value;
	var regex1=/^[a-zA-Z]{5}\d{4}[a-zA-Z]{1}$/;  //this is the pattern of regular expersion
	if(Form.dd.value=="" || Form.dd.value=="DD")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Day of Birth!</span>";
		Form.dd.focus();
		return false;
	}
	if(Form.dd.value!="")
	{
		if((Form.dd.value<1) || (Form.dd.value>31))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Date of Birth(Range 1-31)!</span>";
			Form.dd.focus();
			return false;
		}
	}
	if(!checkData(Form.dd, 'Day', 2))
		return false;
	
	if(Form.mm.value=="" || Form.mm.value=="MM")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill month of Birth!</span>";
		Form.mm.focus();
		return false;
	}
	if(Form.mm.value!="")
	{
		if((Form.mm.value<1) || (Form.mm.value>12))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Month of Birth(Range 1-12)!</span>";
			Form.mm.focus();
			return false;
		}
	}
	if(!checkData(Form.mm, 'month', 2))
		return false;

	if(Form.yyyy.value=="" || Form.yyyy.value=="YYYY")
	{
		document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Fill Year of Birth!</span>";
		Form.yyyy.focus();
		return false;
	}
	if(Form.yyyy.value!="")
	{
		if((Form.yyyy.value < "<?php echo $maxage;?>") || (Form.yyyy.value >"<?php echo $minage;?>"))
		{
			document.getElementById('dobVal').innerHTML = "<span  class='hintanchor'>Age between 18 -62!</span>";
			Form.yyyy.focus();
			return false;
		}
	}
	if(!checkData(Form.yyyy, 'Year', 4)){
		return false;
	}

	if(regex1.test(a)== false)
	{
	  alert('Please enter valid pan number');
	  Form.panno.focus();
	  return false;
	}
	if (Form.panno.value.charAt(3)!="P" && Form.panno.value.charAt(3)!="p")
	{
			alert("Please enter valid pan number");
			Form.panno.focus();
			return false;
	}
	if (Form.purpse_loan.selectedIndex==0)
	{
		alert("Please Select Purpose of Loan");
			Form.purpse_loan.focus();
			return false;
	}	
	if(Form.qualification.value=="")
	{
			alert("Please enter Qualification");
			Form.qualification.focus();
			return false;
	}
	if (Form.no_of_dependent.selectedIndex==0)
	{
		alert("Please Select Number Of Dependent");
			Form.no_of_dependent.focus();
			return false;
	}
	if (Form.residence_type.selectedIndex==0)
	{
		alert("Please Select Number Of Dependent");
			Form.residence_type.focus();
			return false;
	}
	
}

function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}

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

</script>
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="css/bajaj-finserv-pl-styles-ie8.css">
<![endif]-->
</head>
<body>
<div id="pagewrap">
<div id="header">
<div class="heading_text">Best Personal Loan from Bajaj Finserv.<span style="float:right;">Powered by Deal4loans </span></div>
	<div class="bajaj-finserv_box" style="margin-right:25px;"><img src="new-images/bajaj-finserv1.jpg"></div>
		<div class="lining"></div>
  </div>
	<div id="content-new">
  <div id="content">
     
<form name="loan_form" action="bajaj_finserv_thankyou.php" method="post" onSubmit="return ckhcreditcard(document.loan_form);">
<input type="hidden" value="<? echo $bajajvaluecibil; ?>"  name="bajajf_cibilreqid" id="bajajf_cibilreqid"/>
<input type="hidden" value="<? echo $bajajvalue; ?>"  name="bajajf_reqid" id="bajajf_reqid"/>
		  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
		    <tr>
			    <td height="35" colspan="2" valign="middle" bgcolor="#FFFFFF" class="heading_text">Professional Details</td>
		      </tr>
			  <tr>
			    <td width="49%" height="25" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Date Of Birth </td>
			    <td width="51%" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">
		        <input type="text" name="dd" id="dd" class="dd-bajaj_new_input" value="DD" onKeyDown="validateDiv('dobVal');" onBlur="onBlurDefault(this,'DD');" onFocus="onFocusBlank(this,'DD');">
		        <input type="text" name="mm" id="mm" class="dd-bajaj_new_input" value="MM" onKeyDown="validateDiv('dobVal');" onBlur="onBlurDefault(this,'MM');" onFocus="onFocusBlank(this,'MM');">
		        <input type="text" name="yyyy" id="yyyy" class="dd-bajaj_new_input" value="YYYY" onKeyDown="validateDiv('dobVal');" onBlur="onBlurDefault(this,'YYYY');" onFocus="onFocusBlank(this,'YYYY');">
				<div id="dobVal"></div>
				</td>
		      </tr>
			  <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="alert_msg"> </td>
		    </tr>
			 
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c" id="chnge_empstst_label">PAN Card Number</td>
<td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c" id="chnge_empstst_label">
<input type="text" class="dd-bajaj_new_inputbox" name="panno" id="panno"></td>
		      </tr>
			  <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="alert_msg"></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Purpose of Loan</td>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">
			      <select name="purpse_loan" id="purpse_loan" class="dd-bajaj_new_selectbox">
				  <option value="">Please Select</option>
                  <option value="Personal Use">Personal Use </option>
                  <option value="Home Renovation">Home Renovation </option>
                  <option value="Property Purchase">Property Purchase  </option>
                  <option value="Debt Consolidation">Debt Consolidation  </option>
                  <option value="Travel">Travel  </option>
	            </select></td>
	        </tr>
			  <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Qualification</td>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">
				<select name="qualification" id="qualification" class="dd-bajaj_new_selectbox">
						  <option value="">Please Select</option>
						  <option value="Graduate">Graduate</option>
						<option value="Post Graduate">Post Graduate</option>
						<option value="Professionally Qualified">Professionally Qualified</option>
						<option value="Other">Other</option>
						</select>
			</td>
		      </tr>
			   <tr>
			  <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi-bank">Gender:</td>
			  <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg" style="color:#999;"><input type="radio" name="gender" id="gender" value="1" />
				Male
				<input type="radio" name="gender" id="gender" value="2"/>
				Female</td>
        </tr>
			  <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="alert_msg"></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi-bank"> Married</td>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="alert_msg" style="color:#999;"><input type="radio" name="marital_stat" id="marital_stat" value="1" checked> 
			      Yes 
	            <input type="radio" name="marital_stat" id="marital_stat" value="2">
	           No</td>
	        </tr>
			  <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="alert_msg"></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi-bank">No. of Dependents</td>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">
			      <select name="no_of_dependent" id="no_of_dependent" class="dd-bajaj_new_selectbox">
			         <option value="0">0</option
                    ><option value="1">1</option>
			        <option value="2">2</option>
			        <option value="3">3</option>
			        <option value="4">4</option>
			        <option value="5">5</option>
                </select>
			   </td>
	        </tr>
            <tr>
                <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"></td>
            </tr>
            <tr>
                <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Residence Type</td>
                <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><select name="residence_type" id="residence_type" class="dd-bajaj_new_selectbox">
				<option value="">Please Select</option>
                  <option value="Self Owned">Self Owned</option>
                  <option value="Parental Owned">Parental Owned</option>
                  <option value="Rented With Family">Rented With Family</option>
                  <option value="Rented Alone/with Friends">Rented Alone/with Friends</option>
                </select></td>
            </tr>
            <tr>
                <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"></td>
            </tr>
            <tr>
              <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Residing Since</td>
              <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><select name="rs_year" id="rs_year" class="year1-bajaj_new_input">
			  <option>Year</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="Before 2010">Before 2010</option>
              </select>
                <select name="rs_month" id="rs_month" class="year1-bajaj_new_input">
                  <option>Months</option>
				  <option value="Jan">January</option>
					<option value="Feb">February</option>
					<option value="Mar">March</option>
					<option value="Apr">April</option>
					<option value="May">May</option>
					<option value="Jun">June</option>
					<option value="Jul">July</option>
					<option value="Aug">August</option>
					<option value="Sep">September</option>
					<option value="Oct">October</option>
					<option value="Nov">November</option>
					<option value="Dec">December</option>
              </select></td>
            </tr>
            <tr>
              <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF"></td>
            </tr>
            <tr>
              <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Residence Address </td>
              <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><input type="text" class="dd-bajaj_new_inputbox" name="residence_address" id="residence_address"></td>
            </tr>
			<tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"></td>
		    </tr>
			<tr>
              <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Residence PinCode</td>
              <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><input type="text" class="dd-bajaj_new_inputbox" name="Resi_Pincode" id="Resi_Pincode" maxlength="6"></td>
            </tr>
            <tr>
                <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF"></td>
            </tr>
            <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Residence Land Line </td>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><input type="text" name="residence_landline" id="residence_landline" class="landline-bajaj_new_input">
                <input type="text" name="residence_landline" id="residence_landline" class="landline-bajaj_new_input2"></td>
		    </tr>
			  <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF"></td>
		    </tr>
			    <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Designation</td>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><input type="text" class="dd-bajaj_new_inputbox" name="designation" id="designation"></td>
	        </tr>
			  <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Department </td>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><input type="text" class="dd-bajaj_new_inputbox" name="department" id="department"></td>
	        </tr>
			  <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Current Company Exp.</td>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><select name="ce_year" id="ce_year" class="year1-bajaj_new_input">
			      <option>Year</option>
                   <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="Before 2010">Before 2010</option>
                </select>
				     <select name="ce_month" id="ce_month" class="year1-bajaj_new_input">
			        <option>Months</option>
					<option value="Jan">January</option>
					<option value="Feb">February</option>
					<option value="Mar">March</option>
					<option value="Apr">April</option>
					<option value="May">May</option>
					<option value="Jun">June</option>
					<option value="Jul">July</option>
					<option value="Aug">August</option>
					<option value="Sep">September</option>
					<option value="Oct">October</option>
					<option value="Nov">November</option>
					<option value="Dec">December</option>
                </select></td>
	        </tr>
			  <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Total Experience</td>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><select name="te_year" id="te_year" class="year1-bajaj_new_input">
			      <option>Year</option>
                   <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="Before 2010">Before 2010</option>
			      </select>
                  <select name="te_month" id="te_month" class="year1-bajaj_new_input">
			        <option>Months</option>
					<option value="Jan">January</option>
					<option value="Feb">February</option>
					<option value="Mar">March</option>
					<option value="Apr">April</option>
					<option value="May">May</option>
					<option value="Jun">June</option>
					<option value="Jul">July</option>
					<option value="Aug">August</option>
					<option value="Sep">September</option>
					<option value="Oct">October</option>
					<option value="Nov">November</option>
					<option value="Dec">December</option>
                </select>
               </td>
	        </tr>
			  <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Office Address</td>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><input type="text" class="dd-bajaj_new_inputbox" name="office_address" id="office_address"></td>
	        </tr>
			<tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"></td>
		    </tr>
			<tr>
              <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Office PinCode</td>
              <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><input type="text" class="dd-bajaj_new_inputbox" name="Offi_Pincode" id="Offi_Pincode" maxlength="6"></td>
            </tr>
			  <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Office Landline</td>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><input type="text" name="office_landline" id="office_landline" class="landline-bajaj_new_input">
                <input type="text" name="office_landline" id="office_landline" class="landline-bajaj_new_input2"></td>
	        </tr>
			  <tr>
			    <td height="10" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"></td>
		    </tr>
			  <tr>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">Official E-Mail ID</td>
			    <td height="35" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c"><input type="text" class="dd-bajaj_new_inputbox" name="office_email" id="office_email"></td>
	        </tr>
			  <tr>
			    <td height="35" colspan="2" valign="middle" bgcolor="#FFFFFF" class="sbi_text_c">&nbsp;</td>
		    </tr>
			 <tr>
			    <td colspan="2" bgcolor="#FFFFFF" id="viewform_part_here"></td>
		    </tr>			 
			  <tr>
			    <td height="0" colspan="2" align="center" valign="middle" bgcolor="#FFFFFF" >  
                <input type="submit" style="border: 0px none ; background-image: url(new-images/sbi_get_quote_btn.png); width: 153px; height: 47px; margin-bottom: 0px;" value=""/>
                </td>
		    </tr>
		  </table>
          </form>
<div style="clear:both"></div>
	</div>
   
    </div>
	<div id="sidebar">
		<div class="widget">
		 	  <div class="right-box-d">
		 	    <h4 class="heading_text_b">Why Bajaj Finserv?</h4>
	 	  </div>
	 	  <div class="sbi_text_bullet">
  <ul>
<li>Loans up to Rs.18 Lacs<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Bold dreams need big means. We offer the highest ticket size of up to 18 lacs so that you can pursue your bold dreams. This is the highest ticket size that anyone offers in this category.</div>
</li>
<li>Nil Foreclosure charges
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Now you can choose to foreclose your loan anytime during your loan tenor without paying any foreclosure charges. </div>
</li>
<li>Step Down Interest Rate
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">0.20% reduction in IRR in year 2 and year 3 (only for 2 yrs).
</div>
</li>
<li>Flexi Loans
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Flexibility to not only prepay but to withdraw as per your requirement. And You can also operate the loan account in a very easy & convenient way.
</div>
</li>
<li>Part Prepayment facility
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">You can prepay upto 6 times in a calendar year at any interval with the minimum amount per prepay transaction being not less than 3 EMIs. There is no limit on the maximum amount. This is subject to your clearing your first EMI. 
</div>
</li>
<li>Prompt Repayment Benefit<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Get rewarded for keeping your Secures. Enjoy the exclusive Prompt Repayment benefit for paying your EMIs on time. If you clear your first 12 EMIs without any delays, you will get 1% of the annualized interest amount paid back to you. <br>
  This facility will be available for the entire period of your loan tenor and will be paid at the end of every 12 months, subject to your EMIs paid on time.
</div>
</li>

<li>Access to best Relationship Manager
<br/>
<div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">Get best service from quality sales representative.
</div>
</li>
</ul>  
</div>
		</div>
  <div class="widget clearfix">
						
        <img src="http://www.deal4loans.com/new-images/pl/diwali-welcome-rewards.jpg"><div style="font-size:11px; color:#999; font-weight:normal; line-height:15px;">* Refer to terms & Conditions - www.deal4loans.com/personal-loan-offers.php</div></div>							
  </div>
	<div style="clear:both; "></div>
    <div class="table_bajaj_fin_details">
      <table border="0" cellspacing="0" cellpadding="0" width="100%" >
        <tr>
          <td width="172" valign="bottom" style="border:1px #0199cd solid;border-right:1px #FFFFFF solid; color:#FFFFFF; background-color:#0199cd;"><p align="center"><strong>Bank A<br>
            (Without Partpayment<br>
            Option)</strong></p></td>
          <td width="130" valign="bottom" style="border:1px #0199cd solid;border-right:1px #FFFFFF solid; color:#FFFFFF; background-color:#0199cd;"><p align="center"><strong>Actual Interest<br>
            (Bank A)</strong></p></td>
          <td width="196" valign="bottom" style="border:1px #0199cd solid;border-right:1px #FFFFFF solid; color:#FFFFFF; background-color:#0199cd;"><p align="center"><strong>Bank B<br>
            (With Partpayment<br>
            Option)</strong></p></td>
          <td width="186" valign="bottom" style="border:1px #0199cd solid;border-right:1px #FFFFFF solid; color:#FFFFFF; background-color:#0199cd;"><p align="center"><strong>Part Payment<br>
            (Amount)</strong></p></td>
          <td width="173" valign="bottom" style="border:1px #0199cd solid;border-right:1px #FFFFFF solid; color:#FFFFFF; background-color:#0199cd;"><p align="center"><strong>Acutual Interest<br>
            (After Partpayment)</strong></p></td>
          <td width="123" valign="bottom" style="border:1px #0199cd solid; color:#FFFFFF; background-color:#0199cd;"><p align="center"><strong>Net Saving<br>
            (With Part Payment)</strong></p></td>
        </tr>
        <tr>
          <td width="172" nowrap rowspan="2" valign="bottom" style="border:1px #0199cd solid;"><p align="center">14.50%</p></td>
          <td width="130" nowrap rowspan="2" valign="bottom" style="border:1px #0199cd solid;"><p align="center">31167</p></td>
          <td width="196" nowrap rowspan="2" valign="bottom" style="border:1px #0199cd solid;"><p align="center">15.50%</p></td>
          <td width="186" nowrap valign="bottom" style="border:1px #0199cd solid;"><p align="center">25,000 in 1st Year</p></td>
          <td width="173" nowrap valign="bottom" style="border:1px #0199cd solid;"><p align="center">22342</p></td>
          <td width="123" nowrap valign="bottom" style="border:1px #0199cd solid;"><p align="center">8825</p></td>
        </tr>
        <tr>
          <td width="186" nowrap valign="bottom" style="border:1px #0199cd solid;"><p align="center">25,000 in 2nd Year</p></td>
          <td width="173" nowrap valign="bottom" style="border:1px #0199cd solid;"><p align="center">27029</p></td>
          <td width="123" nowrap valign="bottom" style="border:1px #0199cd solid;"><p align="center">4138</p></td>
        </tr>

<tr>
<td nowrap colspan="6" valign="bottom"><p>* Calculation Basis 1,00,000    Loan Amount &amp; 25,000 part payment after 1st &amp; 2nd Year</p></td>
        </tr>
      </table>
    </div>	
</div>
</body>
</html>
<? } ?>