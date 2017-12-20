<?php
	require 'scripts/session_check.php';
    require 'scripts/db_init.php';
	require 'scripts/functions.php';
	//session_start();
	function DetermineAgeFromDOB ($YYYYMMDD_In)
	{
	  $yIn=substr($YYYYMMDD_In, 0, 4);
	  $mIn=substr($YYYYMMDD_In, 4, 2);
	  $dIn=substr($YYYYMMDD_In, 6, 2);
	
	  $ddiff = date("d") - $dIn;
	  $mdiff = date("m") - $mIn;
	  $ydiff = date("Y") - $yIn;
	
	  if ($mdiff < 0)
	  {
		$ydiff--;
	  } elseif ($mdiff==0)
	  {
		if ($ddiff < 0)
		{
		  $ydiff--;
		}
	  }
	  return $ydiff;
	}

	if(isset($_POST['submit']))
	{}
?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Loans | Apply for Loan</title>
<meta name="keywords" content="loans, personal loans, personal loan, loans, loan, emi calculator, compare personal loans, debt consolidation , education loans, loan providers, credit cards, loan gyan, loans India, online loan application, loan calculator, loan eligibility, banks India, easy loans, quick loans, Compare loan from ICICI  HDFC SBI and other major banks " />
<meta name="verify-v1" content="iC5qAw9C0E3rRZYbtAKvnPHmBSQU3zWJu5Ooj8hO3Og="/>
<meta name="description" content="Get  Latest Information on Loans, such as Personal Loan, Home Loan, Car Loan etc. Apply Online & Compare Loan rates and Emi of all Nationalized and Multi-national Banks Instantly."/>
<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<link href="style/pl-hl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<!--<script type="text/javascript" src="js/jquery.js"></script>
 --><script type="text/javascript" src="js/easySlider1.5.js"></script>
<link rel="stylesheet" href="home_style.css" type="text/css" />
<!--<script type="text/javascript" src="js/jquery.js"></script>
 -->
<script language="javascript">
function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
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

function Trim(strValue) {
	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}

function check_form(Form)
{
	var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
	var dt,mdate;dt=new Date();
	
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";
	
	if((Form.Name.value=="") || (Form.Name.value=="Full Name")|| (Trim(Form.Name.value))==false)
	{
	alert("Kindly fill in your Name!");
	Form.Name.focus();
	return false;
	}
	else if(containsdigit(Form.Name.value)==true)
	{
	alert("Name contains numbers!");
	Form.Name.focus();
	return false;
	}
	  for (var i = 0; i < Form.Name.value.length; i++) {
		if (iChars.indexOf(Form.Name.value.charAt(i)) != -1) {
		alert ("Name has special characters.\n Please remove them and try again.");
		Form.Name.focus();
		return false;
		}
	  }
	  
	if((Form.Phone.value=='Mobile') || (Form.Phone.value=='') || Trim(Form.Phone.value)==false)
	{
	alert("Kindly fill in your Mobile Number!");
	Form.Phone.focus();
	return false;
	}
	
	if(isNaN(Form.Phone.value)|| Form.Phone.value.indexOf(" ")!=-1)
	{
		  alert("Enter numeric value");
		  Form.Phone.focus();
		  return false;  
	}
	if (Form.Phone.value.length < 10 )
	{
			alert("Please Enter 10 Digits"); 
			 Form.Phone.focus();
			return false;
	}
	if (Form.Phone.value.charAt(0)!="9")
	{
			alert("The number should start only with 9");
			 Form.Phone.focus();
			return false;
	}
	
	if(Form.Email.value!="Email Id")
	{
		if (!validmail(Form.Email.value))
		{
			Form.Email.focus();
			return false;
		}	
	}
	
	if(Form.month.selectedIndex==0)
	{
		alert("Please enter DOB Month");
		Form.month.focus();
		return false;
	}
	if(Form.day.selectedIndex==0)
	{
		alert("Please enter DOB Day");
		Form.day.focus();
		return false;
	}
	if(Form.year.selectedIndex==0)
	{
		alert("Please enter DOB Year");
		Form.year.focus();
		return false;
	}
	if(Form.company_name.value=="")
	{
		alert('Please enter Company Name');
		Form.company_name.focus();
		return false;
	}
	if(Form.Employment_Status.selectedIndex==0)
	{
		alert("Please enter your Employment Status");
		Form.Employment_Status.focus();
		return false;
	}
	if(Form.monthly_income.value=="")
	{
		alert('Please enter Monthly Income');
		Form.monthly_income.focus();
		return false;
	}
	
	if((Form.loan_amount.value==""))
	{
		alert('Please enter Loan Amount');
		Form.loan_amount.focus();
		return false;
	}
	if((Form.loan_amount.value!=""))
	{
		if((Form.loan_amount.value <500000))
		{
			alert('Please enter Loan Amount greater then 500000');
			Form.loan_amount.focus();
			return false;
		}
	}
	
	if(Form.co_appli.checked)
	{

		if((Form.co_name.value=="") || (Form.co_name.value=="Full Name")|| (Trim(Form.co_name.value))==false)
		{
			alert("Kindly fill in Co Applicant Name!");
			Form.co_name.focus();
			return false;
		}
		else if(containsdigit(Form.co_name.value)==true)
		{
			alert("Name contains numbers!");
			Form.co_name.focus();
			return false;
		}
	    for (var i = 0; i < Form.co_name.value.length; i++) 
	    {
			if (iChars.indexOf(Form.co_name.value.charAt(i)) != -1) 
			{
				alert ("Name has special characters.\n Please remove them and try again.");
				Form.co_name.focus();
				return false;
			}
		}
		if(Form.co_month.selectedIndex==0)
		{
			alert("Please enter DOB Month");
			Form.co_month.focus();
			return false;
		}
		if(Form.co_day.selectedIndex==0)
		{
			alert("Please enter DOB Day");
			Form.co_day.focus();
			return false;
		}
		if(Form.co_year.selectedIndex==0)
		{
			alert("Please enter DOB Year");
			Form.co_year.focus();
			return false;
		}
		if(Form.co_monthly_income.value=="")
		{
			alert('Please enter Co Applicant Monthly Income.');
			Form.co_monthly_income.focus();
			return false;
		}
		
		
	}
	/*if(Form.co_income.value=="")
	{
		alert("Please enter Co-Applicant's Annual Income");
		Form.co_income.focus();
		return false;
	}*/
		
}
</script>
<script language="JavaScript">
	  function showdetailsFaq(d,e)
			{			
				for(j=1;j<=e;j++)
					{
						if(d==j)
							{
								if(eval(document.getElementById("divfaq"+j)).style.display=='none')
									{
									
										eval(document.getElementById("divfaq"+j)).style.display=''
										//eval(document.getElementById("imgfaq"+j)).src='images/minus2.gif'
									}
								else
									{
										
										eval(document.getElementById("divfaq"+j)).style.display='none'
										//eval(document.getElementById("imgfaq"+j)).src='images/plus2.gif'
									}
							}
						
					}
			}
							window.onload=showdetailsFaq
</script>
</head>

<body>
<?php include '~Top-new.php';?>
<?php include '~menu.php';?>
<div id="container">
<div align="center">
    <table width="600" border="0" cellpadding="0" cellspacing="0" style="border:5px solid #E9DCB4; background-color:#F4EFE0;">
      <tr>
        <td style="padding:5px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
         
          <tr>
            <td style="padding:5px 0px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" valign="top" background="images/hl_rgt-tp-bg.gif" style="background-repeat:no-repeat; width:272px; height:44px; background-position:top;"><table width="100%" height="260" border="0" cellpadding="0" cellspacing="0">
                 
                  <tr>
                    <td style="padding:5px 0px; background-color:#EFE6CB; border:3px solid #FFFFFF;"><table width="99%" border="0" align="right" cellpadding="0" cellspacing="0">
                       
                        <tr>
                          <td height="30" colspan="2" align="center" valign="middle"  class="heading" style="font-size:18px;">ICICIHFC Features &amp; Benefits </td>
                        </tr>
                        <tr>
                          <td width="17" height="20" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                          <td width="252" height="30" class="subheading" style="font-size:11px;"><strong> Guidance through out the process</strong></td>
                        </tr>
                        <tr>
                          <td width="17" height="20" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                          <td height="30" class="subheading" style="font-weight:normal; font-size:11px;"><b> Assistance in Home Search</b><br>
                (available in select cities).</td>
                        </tr>
                        <tr>
                          <td width="17" height="19" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                          <td height="30" class="subheading" style="font-size:11px;"> Get the Best Deal for your Home Loan. </td>
                        </tr>
                        <tr>
                          <td height="19" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                          <td height="30" class="subheading" style="font-size:11px;">Attractive interest rates.</td>
                        </tr>
                        <tr>
                          <td height="19" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                          <td height="30" class="subheading" style="font-weight:normal; font-size:11px;"><b>Sanction approval prior</b> to selection of property.</td>
                        </tr>
                        <tr>
                          <td height="19" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                          <td height="30" class="subheading"  style="font-weight:normal; font-size:11px;">Home Loan Insurance options <b>at attractive premium.</b></td>
                        </tr>
                        <tr>
                          <td height="19" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                          <td height="30" class="subheading" style="font-size:11px;">Free Personal Accident Insurance.</td>
                        </tr>
                        <tr>
                          <td height="19" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                          <td height="30" class="subheading" style="font-size:11px;">Simplified Documentation.</td>
                        </tr>
                        <tr>
                          <td height="19" align="left" valign="middle"><img src="images/hl_arrow.gif" width="11" height="9" /></td>
                          <td height="30" valign="middle" class="subheading" style="font-size:11px;">Loan amounts ranging from Rs. 10 lakh to Rs. 3 crore.</td>
                        </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td width="">&nbsp;</td>
               
                <td width="303" align="left" valign="top"><table width="100%" height="270" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="600" align="center" valign="middle" background="images/hl_form_bg.gif" style="background-repeat:no-repeat; width:303px; height:44px; background-position:top;"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="40" align="center" class="heading">Get Instant Quote </td>
                          </tr>
                          <tr>
                            <td align="center" style="background-color:#EFE6CB; border:3px solid #FFFFFF; border-top:none; "><form name="loancalc" id="loancalc" method="post" action="eligible-for-home-loan-continue.php" onSubmit="return check_form(document.loancalc);" >     <table width="97%" border="0" align="right" cellpadding="0" cellspacing="0" id="frm">
                  <tr>
                    <td colspan="2" align="center"></td>
                   </tr>
                  <tr>
                    <td height="30" class="formtext">Name</td>
                     <td align="left" class="formtext"><input type="text" name="Name" id="Name" style="width:130px;" maxlength="30" value="<?php echo $name; ?>" ></td>
                   </tr>
                  <tr>
                    <td height="30" class="formtext">Mobile</td>
                    <td align="left" class="formtext">+91
                      <input type="text" name="Phone" id="Phone" style="width:102px;" maxlength="10" value="<?php echo $Phone; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this)"; ></td>
                   </tr>
                    <tr>
                    <td height="30" class="formtext">City</td>
                    <td align="left" class="formtext"><select size="1" name="City" id="City" style="width:132px;" onChange="insertData();"> <option value="-1">Please Select</option>
                    <? $getlocationlist=ExecQuery("Select * From icici_hfc_location_list order by location_name ASC");
                    while($row=mysql_fetch_array($getlocationlist))
                    {
                        $location_name = $row['location_name'];
                        echo  "<option value='".$location_name."'>".ucfirst(strtolower($location_name))."</option>";
                    }
                    ?>
                     <option value="Others">Others</option>
                        <!--<option value="-1">Please Select</option>
                        <option value="1">Salaried</option>
                        <option value="0">Self Employed</option> -->
                    </select></td>
                  </tr>
                  <tr>
                    <td height="30" class="formtext">Email Id</td>
                    <td align="left" class="formtext"><input type="text" name="Email" id="Email" style="width:130px;" maxlength="50" value="<?php echo $Email; ?>" ></td>
                   </tr>
                  <tr>
                    <td height="30" class="formtext">Date of Birth</td>
                    <td align="left" class="formtext"><?php
                        //if(isset($dateofbirth))
                        //{
                            //$dob_display = $dateofbirth;
                        //}
                        //else
                        //{
                            //$dob_display = "1980-01-01";
                        //}
                        ?>
                   <!--  <script>DateInput('dob', true, 'YYYY-MM-DD', '<?php //echo $dob_display; ?>')</script> -->
                    <?php
                    $month_arr = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                    ?>
                    <select name="month" id="month" style="width:47px;">
                    <option value="">mon</option>
                    <?php
                    for($i=0;$i<count($month_arr);$i++)
                    {
                        $count = $i+1;
                        echo "<option value='".$count."'>".$month_arr[$i]."</option>";
                    }
                    ?>
                    </select>
                    <span id="">
                    <select name="day" style="width:43px;">
                    <option value="">day</option>
                    <?php
                    for($i=1;$i<=31;$i++)
                    {
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select>
                    </span>
                    <select name="year" style="width:49px;">
                    <option value="">year</option>
                    <?php
                    for($i=1988;$i>=1949;$i--)
                    {
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select>                </td>
                  </tr>
                  <tr>
                    <td height="30" class="formtext">Company Name </td>
                    <td align="left" class="formtext"><input type="text" name="company_name" id="company_name" style="width:130px;" maxlength="30" value="<?php echo $company_name; ?>" ></td>
                  </tr>
                  <tr>
                    <td height="30" class="formtext">Employment Status</td>
                    <td align="left" class="formtext"><select size="1" name="Employment_Status" style="width:132px;" onChange="insertData();">
                        <option value="-1">Please Select</option>
                        <option value="1">Salaried</option>
                        <option value="0">Self Employed</option>
                    </select></td>
                  </tr>
                  <tr>
                    <td height="30" class="formtext">Net Monthly<br>
     Income </td>
                    <td align="left" class="formtext"><input type="text" name="monthly_income" id="monthly_income" style="width:130px;" value="<?php echo $income; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" ></td>
                  </tr>
                  <tr>
                    <td height="30" class="formtext"> Monthly Obligations </td>
                     <td align="left" class="formtext"><input type="text" name="obligations" id="obligations" style="width:130px;" value="<?php echo $obligations; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" > </td>
                   </tr>
                  <tr>
                    <td height="30" class="formtext">Loan Amount<br>
     Required</td>
                     <td align="left" class="formtext"><input type="text" name="loan_amount" id="loan_amount" style="width:130px;" maxlength="30" value="<?php echo $loan_amount; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" ></td>
                   </tr>
                    <tr>
                    <td height="30" class="formtext">Property Value<br>
     Required</td>
                     <td align="left" class="formtext"><input type="text" name="property_value" id="property_value" style="width:130px;" maxlength="30" value="<?php echo $property_value; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" ></td>
                   </tr>
             
             
                  <tr>
                    <td height="30" align="left" class="formtext" ><input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" style="border:none;">Co- Applicant</td>
                    <td align="left" class="formtext">&nbsp;</td>
                   </tr>
         
                  <tr>
                    <td colspan="2"    ><div style="display: none;" id="divfaq1">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                          <td width="42%" class="formtext" height="30">Name</td>
              <td width="58%" align="left"><span class="formtext">
                <input type="text" name="co_name" id="co_name" style="width:130px;" maxlength="30" value="<?php echo $co_name; ?>" >
                </span></td>
            </tr>
                        <tr>
                          <td class="formtext" height="30">Date of Birth </td>
              <td align="left"><?php
                        //if(isset($dateofbirth))
                        //{
                            //$dob_display = $dateofbirth;
                        //}
                        //else
                        //{
                            //$dob_display = "1980-01-01";
                        //}
                        ?>
              <!--   <script>DateInput('co_dob', true, 'YYYY-MM-DD', '<?php //echo $dob_display; ?>')</script> -->
                <?php
                    $month_arr = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                    ?>
                    <select name="co_month" id="co_month" style="width:47px;">
                    <option value="">mon</option>
                    <?php
                    for($i=0;$i<=count($month_arr);$i++)
                    {
                        $count = $i+1;
                        echo "<option value='".$count."'>".$month_arr[$i]."</option>";
                    }
                    ?>
                    </select>
                    <span id="">
                    <select name="co_day" style="width:43px;">
                    <option value="">day</option>
                    <?php
                    for($i=1;$i<=31;$i++)
                    {
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select>
                    </span>
                    <select name="co_year" style="width:49px;">
                    <option value="">year</option>
                    <?php
                    for($i=1988;$i>=1949;$i--)
                    {
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select>            </td>
            </tr>
                        <tr>
                          <td class="formtext" height="30">Net Monthly<br>
     Income </td>
              <td align="left"><span class="formtext">
                <input type="text" name="co_monthly_income" id="co_monthly_income" style="width:130px;" value="<?php echo $income; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">
                </span></td>
            </tr>
                        <tr>
                          <td class="formtext" height="30">Obligations</td>
              <td align="left"><span class="formtext">
                <input type="text" name="co_obligations" id="co_obligations" style="width:130px;" value="<?php echo $obligations; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);">
                </span></td>
            </tr>
                        </table>
         
                                                         
          </div></td>
                   </tr>
                 
                  <tr>
                    <td colspan="2" align="center" valign="top"><input name="submit" type="submit" class="hlbtn" value="Submit"  /></td>
                   </tr>
                  </table>
            </form></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td valign="top" style=" background-color:#EFE6CB; border:3px solid #FFFFFF; "><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="33" align="left" class="text"><b>Disclaimer:</b> Please note that the interest rates given here are based on the particulars you have given here. Users are advised to recheck the same with the individual companies / organizations. This site does not take any responsibility for any sudden / uninformed changes in interest rates.</td>
          </tr>
        </table></td>
          </tr>
          <tr>
          <td height="5"></td>
          </tr>
        </table></td>
      </tr>
    </table>
</div>	

<?php include '~Bottom-new.php';?>
</div>
</body>
</html>

