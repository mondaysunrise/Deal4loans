<?php
//require 'scripts/functions.php';
require 'scripts/db_init.php';
require 'scripts/session_check.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ICICI Bank Car Loan</title>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="icici_car/Functions.js"></script>
<script src="icici_car/AC_ActiveX.js" type="text/javascript"></script>
<script src="icici_car/AC_RunActiveContent.js" type="text/javascript"></script>
<script language="javascript" src="icici_car/Functions_002.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript" src="icici_car/FormCheck.js"></script>
<script src="icici_car/Default.htm" type="text/javascript"></script>
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/contact.js'></script>
<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />
<Script Language="JavaScript">
var ajaxRequestMain;  // The variable that makes Ajax possible!
var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunctionMain(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				//ajaxRequestMain = new XMLHttpRequest();
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					//ajaxRequestMain = new ActiveXObject("Msxml2.XMLHTTP");
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						//ajaxRequestMain = new ActiveXObject("Microsoft.XMLHTTP");
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}
function activatecode()
		{
			
			var get_full_name = document.getElementById('full_name').value;
			
			var get_mobile_no = document.getElementById('mobile').value;
			
			var get_reference_code = document.getElementById('reference_code').value;
			
		if(get_reference_code=="" && get_mobile_no>0)
					{
						var queryString = "?get_Mobile=" + get_mobile_no + "&get_name=" + get_full_name ;
					//alert(queryString); 
						ajaxRequest.open("GET", "get_activation_codeicicicl.php" + queryString, true);
						// Create a function that will receive data sent from the server
						ajaxRequest.onreadystatechange = function(){
							if(ajaxRequest.readyState == 4)
							{
								document.getElementById('reference_code').value=ajaxRequest.responseText;
							}
						}
					}

				ajaxRequest.send(null); 
				
			 
		}
		
		
	function activaterequest()
		{
			//alert("hello");
			var cty = document.getElementById('city').value;
			var fll_nm = document.getElementById('full_name').value;
			//alert(fll_nm);
			var mbl = document.getElementById('mobile').value;
			//alert(mbl);
			var cmpy_nm = document.getElementById('company_name').value;
			//alert(cmpy_nm);
			var occptn = document.getElementById('occupation').value;
			//alert(occptn);
			var anl_inc = document.getElementById('annual_income').value;
			//alert(anl_inc);
			var crnt_exp = document.getElementById('current_experience').value;
			//alert(crnt_exp);
			var ttl_exp = document.getElementById('total_experience').value;
			//alert(ttl_exp);
			var dd = document.getElementById('day').value;
			//alert(dd);
			var mm = document.getElementById('month').value;
			//alert(mm);
			var yr = document.getElementById('year').value;
			//alert(yr);
			var cr_ctgry = document.getElementById('fm_category_id').value;
			//alert(cr_ctgry);
			var sb_ctgry = document.getElementById('sub_category').value;
			//alert(sb_ctgry);
			var dob = yr + "-" + mm + "-" + dd;
			var req_id = document.getElementById('req_id').value;
			if(document.getElementById('activation_code').value == document.getElementById('reference_code').value )
			{
				var is_valid=1;
			}
			else
			{
				var is_valid=0;
			}
			
	if(cty!="" && fll_nm!="" && mbl>0 && cmpy_nm!="" && occptn>0 && anl_inc>0 && crnt_exp>0 && ttl_exp>0 && dob!="" && cr_ctgry>0 &&  sb_ctgry!="")
		{
			var queryString = "?cty=" + cty + "&cmpy_nm=" + cmpy_nm + "&occptn=" + occptn + "&anl_inc=" + anl_inc + "&crnt_exp=" + crnt_exp + "&ttl_exp=" + ttl_exp + "&dob=" + dob + "&cr_ctgry=" + cr_ctgry + "&sb_ctgry=" + sb_ctgry + "&fll_nm=" + fll_nm + "&mbl=" + mbl + "&req_id=" + req_id + "&is_valid=" + is_valid;
//alert(queryString); 
			ajaxRequest.open("GET", "get_icici_cl_details1.php" + queryString, true);
			// Create a function that will receive data sent from the server
			ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4)
				{

					document.getElementById('req_id').value=ajaxRequest.responseText;
					document.getElementById('get_newcalc').style.visibility="hidden";
					document.getElementById('get_calc').style.visibility="";
									
				}
			}
				}

				ajaxRequest.send(null); 
		}

	window.onload = ajaxFunctionMain;
</script>
<script>

function chkcarloan_frm()
{
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var ni = document.getElementById('get_calc');

	if((document.getElementById('full_name').value=="") || (document.getElementById('full_name').value=="Name")|| (Trim(document.getElementById('full_name').value))==false)
	{
		alert("Kindly fill in your Name!");
		document.getElementById('full_name').focus();
		return false;
	}
	else if(containsdigit(document.getElementById('full_name').value)==true)
	{
		alert("Name contains numbers!");
		document.getElementById('full_name').focus();
		return false;
	}
	  for (var i = 0; i < document.getElementById('full_name').value.length; i++) {
		if (iChars.indexOf(document.getElementById('full_name').value.charAt(i)) != -1) {
		alert ("Name has special characters.\n Please remove them and try again.");
		document.getElementById('full_name').focus();
		return false;
		}
	  }
	if((document.getElementById('mobile').value=='Mobile No') || (document.getElementById('mobile').value=='') || Trim(document.getElementById('mobile').value)==false)
		{
			alert("Kindly fill in your Mobile Number!");
			document.getElementById('mobile').focus();
			return false;
		}
	else if(isNaN(document.getElementById('mobile').value)|| document.getElementById('mobile').value.indexOf(" ")!=-1)
		{
			alert("Enter numeric value in ");
			document.getElementById('mobile').focus();
			return false;  
		}
	else if (document.getElementById('mobile').value.length < 10 )
		{
			alert("Please Enter 10 Digits"); 
			document.getElementById('mobile').focus();
			return false;
		}
	else if ((document.getElementById('mobile').value.charAt(0)!="9") && (document.getElementById('mobile').value.charAt(0)!="8") && (document.getElementById('mobile').value.charAt(0)!="7"))
		{
			alert("The number should start only with 9 or 8 or 7");
			document.getElementById('mobile').focus();
			return false;
		}
	if(document.getElementById('city').selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		document.getElementById('city').focus();
		return false;
	}
	if((document.getElementById('company_name').value=="") || (document.getElementById('company_name').value=="Company Name")|| (Trim(document.getElementById('company_name').value))==false)
	{
		alert("Kindly fill in your Company Name!");
		document.getElementById('company_name').focus();
		return false;
	}
	if(document.getElementById('occupation').selectedIndex==0)
	{
		alert("Please select occupation ");
		document.getElementById('occupation').focus();
		return false;
	}
	if((document.getElementById('annual_income').value=='')||(document.getElementById('annual_income').value=="Annual Income"))
	{
		alert("Please enter Annual Income to Continue");
		document.getElementById('annual_income').focus();
		return false;
	}
	if (document.getElementById('current_experience').value=="" || (document.getElementById('current_experience').value=="(in Yrs)"))
	{
		alert("Please enter Years in Company.");
		document.getElementById('current_experience').focus();
		return false;

	}	
	if(!checkNum(document.getElementById('current_experience'), 'No of years in current company',0))
		return false;

	if (document.getElementById('total_experience').value=="" || (document.getElementById('total_experience').value=="(in Yrs)"))
	{
		alert("Please enter Total Experience.");
		document.getElementById('total_experience').focus();
		return false;
	}	
	if(!checkNum(document.getElementById('total_experience'), 'Total Experience',0))
		return false;

	if((space.test(document.getElementById('day').value)) || (document.getElementById('day').value=="DD"))
	{
		alert("Kindly enter your Date of Birth");
		document.getElementById('day').select();
		return false;
	}

	else if(!num.test(document.getElementById('day').value))
	{
		alert("Kindly enter your Date of Birth(numbers Only)");
		document.getElementById('day').select();
		return false;
	}

	else if((document.getElementById('day').value<1) || (document.getElementById('day').value>31))
	{
		alert("Kindly Enter your valid Date of Birth(Range 1-31)");
		document.getElementById('day').select();
		return false;
	}

	else if((space.test(document.getElementById('month').value)) || (document.getElementById('month').value=="MM"))
	{
		alert("Kindly enter your Month of Birth");
		document.getElementById('month').select();
		return false;
	}

	else if(!num.test(document.getElementById('month').value))
	{
		alert("Kindly enter your Month of Birth(numbers Only)");
		document.getElementById('month').select();
		return false;
	}

	else if((document.getElementById('month').value<1) || (document.getElementById('month').value>12))
	{
		alert("Kindly Enter your valid Month of Birth(Range 1-12)");
		document.getElementById('month').select();
		return false;
	}

	else if((document.getElementById('month')) && (document.getElementById('month').value>29))
	{
		alert("Month February cannot have more than 29 days");
		document.getElementById('month').select();
		return false;
	}

	else if((space.test(document.getElementById('year').value)) || (document.getElementById('year').value=="YYYY"))
	{
		alert("Kindly enter your Year of Birth");
		document.getElementById('year').select();
		return false;
	}

	else if(!num.test(document.getElementById('year').value))
	{
		alert("Kindly enter your Year of Birth(numbers Only) !");
		document.getElementById('year').select();
		return false;
	}

	else if((document.getElementById('day').value > 28) && (parseInt(document.getElementById('month').value)==2) && ((document.getElementById('year').value%4) != 0))
	{
		alert("February cannot have more than 28 days.");
		document.getElementById('day').select();
		return false;
	}

	else if(document.getElementById('year').value.length != 4)
	{
		alert("Kindly enter your correct 4 digit Year of Birth.(Numeric ONLY)!");
		document.getElementById('year').select();
		return false;
	}
	else if((document.getElementById('year').value < "1945") || (document.getElementById('year').value >"1987"))
	{
		alert("Age Criteria! \n Applicants between age group 23 - 65 only are elgibile.");
		document.getElementById('year').select();
		return false;
	}
	else if((parseInt(document.getElementById('day').value)==31) && ((parseInt(document.getElementById('month').value)==4)||(parseInt(document.getElementById('month').value)==6)||(parseInt(document.getElementById('month').value)==9)||(parseInt(document.getElementById('month').value)==11)||(parseInt(document.getElementById('month').value)==2)))
	{
		alert("Cannot have 31st Day");
		document.getElementById('day').select();
		return false;
	}

	if(document.getElementById('fm_category_id').selectedIndex==0)
	{
		alert("Please select Car Manufacturer ");
		document.getElementById('fm_category_id').focus();
		return false;
	}

	if(document.getElementById('sub_category').selectedIndex==0)
	{
		alert("Please select Car Model ");
		document.getElementById('sub_category').focus();
		return false;
	}
	
	if((document.getElementById('activation_code').value=='') || Trim(document.getElementById('activation_code').value)==false)
		{
			alert("Kindly fill in your Activation Code!");
			document.getElementById('activation_code').focus();
			return false;
		}
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
function Trim(strValue)
	{
		var j=strValue.length-1;i=0;
		while(strValue.charAt(i++)==' ');
		while(strValue.charAt(j--)==' ');

		return strValue.substr(--i,++j-i+1);
	}
</script>
<style>
		.black_overlay{
			display: none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			background-color: black;
			z-index:1001;
			-moz-opacity: 0.8;
			opacity:.80;
			filter: alpha(opacity=80);
		}
		.white_content {
			display: none;
			position: absolute;
			top: 25%;
			left: 25%;
			width: 50%;
			height: 50%;
			padding: 16px;
			border: 16px solid orange;
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
	</style>

</head><body>

<table align="center" border="0" cellpadding="0" cellspacing="0" width="886">
  <tbody><tr>
    <td background="icici_car/main_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="872">
      <tbody><tr>
        <td><img src="icici_car/top_logo.gif" height="104" width="872"></td>
      </tr>
      <tr>
        <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="872" height="250">
          <param name="movie" value="icici_car/banner.swf">
          <param name="quality" value="high">
          <embed src="icici_car/banner.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="872" height="250"></embed>
        </object></td>
      </tr>
      <tr>
        <td height="13"></td>
      </tr>
      <tr>
        <td><img src="icici_car/body_top.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td background="icici_car/body_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="96%">
          <tbody><tr>
            <td valign="top"><table border="0" cellpadding="0" cellspacing="0" width="523">
              <tbody><tr>
                <td class="content_title">ICICI Bank Car Loans</td>
              </tr>
              <tr>
                <td height="3"></td>
              </tr>
              <tr>
                <td>
                  <div id="content_holder">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tbody><tr>
                        <td class="subhead" id="122">Advantages*</td>
                      </tr>
                      <tr>
                        <td class="adv_bullet_minus" id="1"><ul>
                            <li><span class="adv_title">Attractive Rate of Interest:</span>
                              <div id="divContent1" style="display: block; padding-top: 5px;">Comprehensive services and competitive interest rates.</div>
                            </li>
                        </ul></td>
                      </tr>
                      <tr>
                        <td class="adv_bullet" id="2"><ul>
                            <li><span class="adv_title">Ease of Documentation:</span>
                              <div id="divContent2" style="padding-top: 5px;">Minimal paperwork involved in availing car loans.</div>
                            </li>
                        </ul></td>
                      </tr>
                      <tr>
                        <td class="adv_bullet" id="3"><ul>
                            <li><span class="adv_title">Prompt Processing:</span>
                            <div id="divContent3" style="padding-top: 5px;">Hassle-free service and quick processing.</div>
                            </li>
                        </ul></td>
                      </tr>
                      <tr>
                        <td class="adv_bullet" id="4"><ul>
                            <li><span class="adv_title">Flexible Loan Repayment Option:</span>
                              <div id="divContent4" style="padding-top: 5px;">A variety to choose from, in terms of finance options for your new /  used car.</div>
                              </li>
                        </ul></td>
                      </tr>
                    </tbody></table>
                  </div></td>
              </tr>
              <tr>
                <td height="3"></td>
              </tr>
              <tr>
                <td height="10"></td>
              </tr>
              <tr>
                <td align="center" valign="middle"><table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tbody><tr>
                    <td><img src="icici_car/feature_unit.gif" height="66" width="225"></td>
                    <td align="right"><img src="icici_car/emi_unit.gif" alt="" style="cursor: pointer;" onClick="popup('http://www.icicibank.com/Pfsuser/loanatclick/calculateemi.html','emi','left=120,top=100,scrollbars=no,width=627,height=378'); pageTracker._trackPageview('/virtual/Google/EMICalculator');" border="0"></td>
                  </tr>
                </tbody></table></td>
              </tr>
            </tbody></table></td>
            <td align="center" valign="top" width="11"><img src="icici_car/vr_brk.gif" height="378" width="1"></td>
            <td valign="top"><table border="0" cellpadding="0" cellspacing="0" width="300">
              <tbody><tr>
                <td><img src="icici_car/form_title.gif" height="76" width="300"></td>
              </tr>
              <tr>
                <td background="icici_car/form_bg.gif" height="286" valign="top"><table style="height: 404px;" align="right" border="0" cellpadding="0" cellspacing="0" width="96%">
                  <tbody>
				 
                  <tr>
                    <td class="form_txt" align="left" valign="middle">&nbsp;</td>
                    <td class="form_txt" align="left" valign="middle">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="form_txt" align="left" valign="middle" width="39%"><b>Name<sup></sup></b></td>
                    <td class="form_txt" align="left" valign="middle" width="61%">
					<input type="text" name="full_name" id="full_name" style="width:130px;"  class="txtbox" tabindex="1"/></td>
                  </tr> <tr>
                    <td colspan="2" height="5" ></td>
                  </tr>
                
                <tr>
                    <td class="form_txt" align="left" valign="middle"><b>Mobile No.<sup></sup></b></td>
                    <td class="form_txt" align="left" valign="middle"><input gtbfieldid="6" name="mobilestd" class="txtbox" id="mobilestd" value="91" style="width: 20px; background-color: rgb(229, 229, 229); text-align: center;" readonly type="text"><input type="text" name="mobile" id="mobile" maxlength="10"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" style="width:110px;"  class="txtbox" tabindex="2" onChange="activatecode();"/></td>
                  </tr> <tr>
                    <td colspan="2" height="5" ></td>
                  </tr>
                   <tr>
                    <td class="form_txt" align="left" valign="middle"><b>City<sup></sup></b></td>
                    <td class="form_txt" align="left" valign="middle"><select name="city" id="city" style="width:130px;"  class="txtbox" tabindex="3" onChange="activatecode();">
				<option value="">Please select</option>
<option value="Mumbai" >Mumbai</option>
<option value="Delhi" >Delhi</option>
<option value="Chennai" >Chennai</option>
<option value="Bangalore" >Bangalore</option>
<option value="Hyderabad" >Hyderabad</option>
<option value="Pune" >Pune</option>
<option value="Ahmedabad" >Ahmedabad</option>
<option value="Jaipur" >Jaipur</option>
<option value="Noida" >Noida</option>
<option value="Gurgaon" >Gurgaon</option>
<option value="Gaziabad" >Gaziabad</option>
<option value="Faridabad" >Faridabad</option>
<option value="Thane" >Thane</option>
<option value="Navi Mumbai" >Navi Mumbai</option>
<option value="Secunderabad" >Secunderabad</option>
<option value="Baroda" >Baroda</option>
<option value="Surat" >Surat</option>
<option value="Chandigarh" >Chandigarh</option>
<option value="Kolkata" >Kolkata</option>
<option value="Others" >Others</option>
	</select></td>
                  </tr>
                   <tr>
                     <td  align="left" valign="middle" height="5"></td>
                     <td  align="left" valign="middle" height="5"></td>
                   </tr>
                   <tr>
                     <td align="left" valign="middle" class="form_txt"><b>Company Name </b></td>
                     <td class="form_txt" align="left" valign="middle"><input type="text" name="company_name" id="company_name" style="width:130px;"  class="txtbox" tabindex="4"/></td>
                   </tr> <tr>
                    <td colspan="2" height="5" ></td>
                  </tr>
                   <tr>
                     <td align="left" valign="middle" class="form_txt"><b>Occupation</b></td>
                     <td class="form_txt" align="left" valign="middle"><select name="occupation" id="occupation" style="width:130px;"  class="txtbox" tabindex="5">
				<option value="">Please Select</option>
				<option value="1">Salaried</option>
				<option value="2">Self Employed</option>
				</select></td>
                   </tr> <tr>
                    <td colspan="2" height="5" ></td>
                  </tr>
                   <tr>
                     <td align="left" valign="middle" class="form_txt"><b>Annual Income</b></td>
                     <td class="form_txt" align="left" valign="middle"><input type="text" name="annual_income" id="annual_income" onChange="intOnly(this);"  onkeypress="intOnly(this);" onBlur="getDigitToWords('annual_income','formatedSalary','wordSalary');" onKeyUp="getDigitToWords('annual_income','formatedSalary','wordSalary'); intOnly(this);" style="width:130px;"  class="txtbox" tabindex="6"/></td>
                   </tr>
                   <tr>
                     <td colspan="2" align="left" valign="middle" class="form_txt"><span id='formatedSalary' style='font-size:11px; font-weight:bold;color:#671212;font-Family:Verdana;'></span><span id='wordSalary' style='font-size:11px;
font-weight:bold;color:#671212;font-Family:Verdana;text-transform: capitalize;'></span></td>
                     </tr>
                   <tr>
                     <td align="left" valign="middle" class="form_txt"><b>Current Experience</b></td>
                     <td class="form_txt" align="left" valign="middle"><input type="text" name="current_experience" id="current_experience" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" style="width:130px;"  class="txtbox" value="(in Yrs)" tabindex="7"/> 
                      </td>
                   </tr> <tr>
                    <td colspan="2" height="5" ></td>
                  </tr>
                   <tr>
                     <td align="left" valign="middle" class="form_txt"><b>Total Experience</b></td>
                     <td class="form_txt" align="left" valign="middle"><input type="text" name="total_experience" id="total_experience" onChange="intOnly(this);" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  style="width:130px;"  class="txtbox" tabindex="8" value="(in Yrs)"/>
                       </td>
                   </tr> <tr>
                    <td colspan="2" height="5" ></td>
                  </tr>
                   <tr>
                    <td class="form_txt" align="left" valign="middle"><b>DOB<sup></sup></b></td>
                    <td class="form_txt" align="left" valign="middle"><input name="day" type="text" id="day"  value="DD"   maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  style="width:32px;"  class="txtbox" tabindex="9"/>
			 <input  name="month" type="text" id="month"   value="MM"  maxlength="2" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  style="width:32px;"  class="txtbox" tabindex="9"/>
			 <input name="year" type="text" id="year"   value="YYYY" maxlength="4" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"  style="width:60px;"  class="txtbox" tabindex="10"/></td>
                  </tr>
                  <tr>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                  </tr>
				   <tr>
                    <td class="form_txt" align="left" height="5" valign="middle"><b>Activation Code</b></td>
                    <td class="form_txt" align="left" height="5" valign="middle"><input type="hidden" name="reference_code" id="reference_code" value=""/><input type="text" name="activation_code" id="activation_code" onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" style="width:120px;"  class="txtbox" tabindex="11"></td>
                  </tr>
				  
                  <tr>
                    <td class="form_txt" align="left" valign="middle">&nbsp;</td>
                    <td class="form_txt" align="left" valign="middle">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="form_txt" align="left" valign="middle"><b>Car Manufacturer</b></td>
                    <td class="form_txt" align="left" valign="middle"><select name="fm_category_id" id='fm_category_id' onChange="getSubCategory(this.value)"   style="width:170px;"  class="txtbox" tabindex="12">
   <option value="-1" selected> Please Select </option> 
   <?
		   $query = ("SELECT * from fs_category where ParentID='-1' order by Name");
		 //  $num_rows = mysql_num_rows($query);
		   list($num_rows,$getrow)=MainselectfuncNew($query,$array = array());
		$cntr=0;
		
		    while($cntr<count($getrow))
		   {        
				   $id = $getrow[$cntr]['CategoryID']; 
				$Name = $getrow[$cntr]['Name']; 
				echo "<option value=".$id.">".$Name."</option>";
					//$selected = ($iPACategoryID == $iCatInfo["CategoryID"])? " Selected":""; 
		 $cntr =$cntr +1;   		   //echo "<option value='$iCatInfo[CategoryID]' $selected>$iCatInfo[Name]</option>\n";
		   } 
   ?>
</select></td>
                  </tr>
                  <tr>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                  </tr>
                  <tr>
                    <td class="form_txt" align="left" valign="middle"><b>Car Models</b></td>
                    <td class="form_txt" align="left" valign="middle"> <?php
						   $query1 = ("SELECT b.ParentID, b.CategoryID as CatID, a.Name as SubCatText, b.Name as CatText  FROM fs_category AS a RIGHT JOIN fs_category AS b ON a.CategoryID = b.ParentID where b.Name Is Null OR a.ParentID='-1' order by b.Position ASC  ");
			 list($recordcount,$iSubCatInfo)=MainselectfuncNew($query1,$array = array());
						$k=0;	 
						   while($k<count($iSubCatInfo))
       						 {
					   if($iPACategoryID == $iSubCatInfo[$k]["CatID"])
					   { 
							   $iParentCat = $iSubCatInfo[$k]["ParentID"];
					   }
					   $ParentID[]="'".$iSubCatInfo[$k]["ParentID"]."'";                        
					   $CatID[]="'".$iSubCatInfo[$k]["CatID"]."'";                        
					   $SubCatText[]="'".$iSubCatInfo[$k]["CatText"]."'";                        
				   $k = $k +1;  }
                                       ?>
 <Script Language="javascript">
		   var parent_id =[<? echo implode(",",$ParentID)?>]; 
		   var cat_id =[<? echo implode(",",$CatID)?>];
		   var subcat_text =[<? echo implode(",",$SubCatText)?>]; 
		   
		   function getSubCategory(ids)
		   {
				   var subcat = document.getElementById("sub_category")
				   for (i = subcat.length - 1; i>=0; i--) subcat.remove(i);
				   for(var i=0;i<parent_id.length;i++){ 
						   if(parent_id[i] == ids){
								   var lcOpObj = document.createElement("OPTION") 
								   lcOpObj.value=subcat_text[i];
								   lcOpObj.text=subcat_text[i];
								   if(document.all) subcat.add(lcOpObj);
								   else subcat.add(lcOpObj,null); 
						   }
				   }
		   }
</Script> 
      
<select name='fm_subcategory' id='sub_category' style='width:170px' tabindex="13" class="txtbox" onChange="activaterequest();"></select></td>
                  </tr>
                                       
                  <tr>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                  </tr>                 
                  <tr>
                    <td colspan="2" align="center" valign="middle">
                    <div id="mobMessage" style="padding: 5px; display: none; font-size: 11px; width: 245px; border: 1px solid rgb(195, 142, 199); background-color: rgb(244, 251, 254); font-family: Arial,Helvetica,sans-serif;" align="center">You
 will recieve a verification code on your mobile no. Please enter this 
on submission of the form. In case of network delay, you have to wait up
 to 5 mins.</div>                                                                            
                    </td>
                  </tr>
                  <tr>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                  </tr>
                  <tr>
				 <td colspan="2" class="form_txt" align="center" height="60" valign="bottom">
	  <div id="get_calc" style="visibility:hidden; height:10px;">
		<div id='contact-form'>
			<input type='hidden' name='req_id' id ='req_id' value=""/>
			<input src="icici_car/but_quote.gif" name="contact" class='contact demo' id="contact" type="image">
		</div>
	  </div>
                   <div id="get_newcalc">
				 <input src="icici_car/but_quote.gif" name="Submit" onClick="return chkcarloan_frm();"  type="image">
				 </div>
				 </td>
                  </tr>
                </tbody></table></td>
              </tr>
              <tr>
                <td><img src="icici_car/form_btmimg.gif" height="15" width="300"></td>
              </tr>
            </tbody></table></td>
          </tr>
        </tbody></table></td>
      </tr>
      <tr>
        <td><img src="icici_car/body_btm.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td height="35"><table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
          <tbody><tr>
            <td class="disclaimer" height="10"></td>
          </tr>
           <tr>
             <td class="cnbc" height="103" valign="bottom" width="850"><table border="0" cellpadding="0" cellspacing="6" width="100%">
               <tbody>
                 <tr>
                   <td width="500">&nbsp;</td>
                   <td class="cnbc_link">www.consumerawards.moneycontrol.com/categories.php</td>
                 </tr>
               </tbody>
             </table></td>
           </tr>
          <tr>
            <td class="disclaimer"><a href="javascript:void(0);" onClick="javascript:showHideDiv(0);" class="disclaimer"><b><u>Disclaimer</u></b></a></td>
          </tr>
          <tr>
            <td class="disclaimer">&nbsp;</td>
          </tr>
        </tbody></table></td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>

<div id="disclaimer" class="disclaimerdiv">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody><tr>
    <td align="left" height="10" valign="top" width="1%"><img src="icici_car/tl.png" height="10" width="10"></td>
    <td align="left" background="icici_car/b.png" valign="top" width="98%"></td>
    <td align="right" height="10" valign="top" width="1%"><img src="icici_car/tr.png" height="10" width="10"></td>
  </tr>
  <tr>
    <td align="left" background="icici_car/b.png" valign="top">&nbsp;</td>
    <td align="center" bgcolor="#ffffff" valign="top"><table bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" width="100%">
  <tbody><tr>
    <td class="disctxt" align="left" valign="top"><b><u>Disclaimer</u></b>:<br>
          The information provided herein is on the website of  
Communicate 2 at http://www.loanforcar.in/,  which is neither owned, 
controlled nor endorsed by ICICI Bank. The use of this information is 
subject to the terms and conditions governing such products, services 
and offers as specified by ICICI Bank at www.icicibank.com; and third 
party from time to time. All Loans are offered at the sole discretion of
 ICICI Bank, subject to submission of documentation and fulfillment of 
such requisites to the sole and absolute satisfaction of ICICI Bank. 
Associated benefits / features / interest rates / applicable fees and 
charges / application process mentioned herein are as on date and may be
 subject to change/ modification from time to time. Eligibility criteria
 and Documentation are indicative and not exhaustive. Nothing contained 
herein shall constitute
or be deemed to constitute an advice, invitation or solicitation to 
purchase any products or services of ICICI Bank or such other third 
party. ICICI Bank does not accept any responsibility for the details, 
accuracy, completeness or correct sequence of any content or information
 provided on the website of the third party; and/ or any errors whether 
caused by negligence or otherwise; and/ or for any loss or damage 
incurred by anyone in reliance on anything set out herein. "ICICI Bank" 
and "I-man" logos are trademark and property of ICICI Bank Ltd. Misuse 
of any intellectual property, or any other content displayed herein is 
strictly prohibited.<br>
          <br>
          <b>EMI Calculator</b><br>This application ("the 
"Application") is for your personal information, education and 
communication of an estimation of equated monthly installment ("EMI") 
and expected changes in it as well as tenure in case of floating rate of
 interest, and is not an offer; invitation or solicitation of any kind 
to avail the facility is not intended to create any rights or 
obligations. Please note that the equated monthly installment ("EMI") 
calculated through this calculator is rounded off to the nearest upper 
integer. Further, the EMI calculated is indicative based solely on the 
data fed by you on the screen and does not envisage any changes that 
might occur due to any discounts, schemes or other promotional 
activities introduced by ICICI Bank from time to time through its own 
channel or in association with a third party.
<p>No reliance may be placed for any purpose whatsoever on the 
information contained in this presentation or on its completeness. The 
information set out herein may be subject to updating, completion, 
revision, verification and amendment and such information may change 
materially. Such information is provided only for the convenience of the
 customers and ICICI Bank does not undertake any liability or 
responsibility for the details, accuracy, completeness or correct 
sequence of any content or information provided through the application.</p>
          <p>The intellectual property in respect of the Application 
belongs to ICICI Bank and any form of reproduction, dissemination, 
copying, disclosure, modification, and/or publication of this document 
is strictly prohibited. The contents of this document are solely meant 
to provide information and ICICI Bank is not representing or giving you 
any assurance that your expectations, objectives, needs and wishes will 
be met with the facility availed and ICICI Bank disclaims all 
responsibility and accepts no liability for the consequences of any 
person acting, or refraining from acting, on such information. ICICI 
Bank Group or any of its officers, employees, personnel, directors shall
 not be liable for any loss, damage, liability whatsoever for any direct
 or indirect loss arising from the use or access of any information that
 may be displayed in through this Application.</p>
          The information provided hereinabove is for information 
purposes only and is subject to Terms and Conditions which are uploaded 
on www.icicibank.com and all applicable laws. By accessing and browsing 
the Application, you accept, without limitation or qualification, the 
Terms and Conditions and acknowledge that any other agreement between 
you and ICICI Bank are superseded and of no force or effect.
          <div align="right"><img src="icici_car/closelabel.gif" onClick="javascript:showHideDiv(1);" style="cursor: pointer;"></div>          </td>
  </tr>
</tbody></table></td>
    <td align="right" background="icici_car/b.png" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="bottom"><img src="icici_car/bl.png" height="10" width="10"></td>
    <td align="left" background="icici_car/b.png" valign="top"></td>
    <td align="right" valign="bottom"><img src="icici_car/br.png" height="10" width="10"></td>
  </tr>
</tbody></table>
</div>
<!--</form>-->

</body></html>