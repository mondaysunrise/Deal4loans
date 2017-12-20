<?php
//require 'scripts/functions.php';
require 'scripts/db_init.php';
require 'scripts/session_check.php';
$maxage=date('Y')-62;
$minage=date('Y')-18;
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ICICI Bank Home Loan</title>
<link href="icici_car/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />
<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>

<link href="style/new-bima.css" rel="stylesheet"  type="text/css" />
<link href="style/glowing.css" rel="stylesheet"  type="text/css" />
<link href="style/slider.css" rel="stylesheet" type="text/css" />
<link href="style/pl-hl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script language="JavaScript" type="text/javascript" src="images/rollovers.js"></script>
<script type="text/javascript" src="js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="js/sprinkle.js"></script>
<script type="text/javascript" src="/scripts/common.js"></script>
<script type="text/javascript" src="js/dropdowntabs.js"></script>
<!--<script type="text/javascript" src="js/jquery.js"></script>
 --><script type="text/javascript" src="js/easySlider1.5.js"></script>
<link rel="stylesheet" href="home_style.css" type="text/css" />

<style type="text/css">
	
	/* START CSS NEEDED ONLY IN DEMO */
	
	#mainContainer{
		width:660px;
		margin:0 auto;
		text-align:left;
		height:100%;		
		border-left:3px double #000;
		border-right:3px double #000;
	}
	#formContent{
		padding:5px;
	}
	/* END CSS ONLY NEEDED IN DEMO */
	
	
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:100;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:absolute;
		z-index:5;
	}
	
	form{
		display:inline;
	}
	</style>
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

	

	window.onload = ajaxFunctionMain;
</script>
<script>


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
	
	if(Form.City.selectedIndex==0)
	{
		alert("Please enter City");
		Form.City.focus();
		return false;
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
	
	
	
	if(Form.propertyConstruction_Type.value=="")
	{
		alert('Please enter Property Details');
		Form.propertyConstruction_Type.focus();
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
	
		
}
</script>
<script language="JavaScript">


function addElement()
{

	var ni = document.getElementById('myDivRS');
	if(document.loancalc.propertyConstruction_Type.value=="CONSTRUCTED")
	{
		ni.innerHTML = '<table align="right" border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>&nbsp;</td></tr><tr><td class="form_txt" align="left" valign="middle" width="183"><b>Name of builder</b></td><td class="form_txt" align="left" valign="middle"><input type="text" name="builder_name" id="builder_name" style="width:150px;" /></td></tr><tr><td>&nbsp;</td></tr></table>';
	}
	else if(document.loancalc.propertyConstruction_Type.value=="UNDER_CONSTRUCTION")
	{
		ni.innerHTML = '<table align="right" border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td>&nbsp;</td></tr><tr><td class="form_txt" align="left" valign="middle"  width="183"><b>Name of builder</b></td><td class="form_txt" align="left" valign="middle"><input type="text" name="builder_name" id="builder_name" style="width:150px;" /></td></tr><tr><td>&nbsp;</td></tr></table>';
	}
	else
	{
		ni.innerHTML ='';
	}

	return true;

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
        <td><img src="icici_car/top_logo1.gif" height="104" width="872"></td>
      </tr>
         
      <tr>
        <td><img src="icici_car/body_top.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td background="icici_car/body_bg.gif"><table align="center" border="0" cellpadding="0" cellspacing="0" width="96%">
          <tbody><tr>
            <td align="center" valign="top">
            <form name="loancalc" id="loancalc" method="post" action="icici-home-loan-get-rates.php" onSubmit="return check_form(document.loancalc);" >
            <table border="0" cellpadding="0" cellspacing="0" width="450">
              <tr>
                <td align="center"><img src="icici_car/ee.jpg" height="59"></td>
              </tr>
              <tr>
                <td bgcolor="#dddddd" height="286" valign="top" style="padding:8px;" >
                
                <table style="height:404px;" align="right" border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tbody>
				 
                 
                   <tr>
                    <td class="form_txt" align="left" valign="middle"><b>City<sup></sup></b></td>
                    <td class="form_txt" align="left" valign="middle"><span class="formtext">
                      <select size="1" name="City" id="City" style="width:152px;" onChange="insertData();">
                        <option value="-1">Please Select</option>
                        <? $getlocationlist=("Select * From icici_hfc_location_list order by location_name ASC");
                    
					 list($recordcount,$row)=MainselectfuncNew($getlocationlist,$array = array());
					$cntr=0;
					
					while($cntr<count($row))
							{
                        $location_name = $row[$cntr]['location_name'];
                        echo  "<option value='".$location_name."'>".ucfirst(strtolower($location_name))."</option>";
                   $cntr = $cntr +1; }
                    ?>
                        <option value="Others">Others</option>
                       
                      </select>
                    </span></td>
                  </tr>
                   <tr>
                     <td  align="left" valign="middle" height="5"></td>
                     <td  align="left" valign="middle" height="5"></td>
                   </tr>
                     <tr>
                    <td class="form_txt" align="left" valign="middle"><b>DOB<sup></sup></b></td>
                    <td class="form_txt" align="left" valign="middle">
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
                    <select name="year" style="width:56px;">
                    <option value="">year</option>
                    <?php
                    for($i=1988;$i>=1949;$i--)
                    {
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select>
                   </td>
                  </tr>
                   <tr>
                     <td  align="left" valign="middle" height="5"></td>
                     <td  align="left" valign="middle" height="5"></td>
                   </tr>
                   <tr>
                     <td align="left" valign="middle" class="form_txt"><b>Company Name </b></td>
                     <td class="form_txt" align="left" valign="middle"><input type="text" name="company_name" id="company_name" style="width:150px;"  class="txtbox" tabindex="4" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)" /></td>
                   </tr> <tr>
                    <td colspan="2" height="5" ></td>
                  </tr>
                   <tr>
                     <td align="left" valign="middle" class="form_txt"><b>Property Details</b></td>
                     <td class="form_txt" align="left" valign="middle">
                     <select name="propertyConstruction_Type" id="propertyConstruction_Type" style="width:152px;" onChange="addElement();">
                        <option value="">Select</option>
                        <option value="CONSTRUCTED">Already built home/flat</option>
                        <option value="UNDER_CONSTRUCTION">Home/flat under construction by builder</option>
                        <option value="CONSTRUCT_ON_OWN_LAND">Construction on land you own</option>
                        <option value="PURCHASE_LAND_AND_CONSTRUCT">Construction on land you wish to purchase</option>
                        <option value="PURCHASE_LAND">Purchase a plot</option>
                    </select>
                     </td>
                   </tr> 
                   
                   <tr>
                    <td colspan="2" height="5" id="myDivRS" ></td>
                  </tr>
                  
                   <tr>
                     <td align="left" valign="middle" class="form_txt"><b>Occupation</b></td>
                     <td class="form_txt" align="left" valign="middle"><select name="occupation" id="occupation" style="width:150px;"  class="txtbox" tabindex="5">
				<option value="">Please Select</option>
				<option value="1">Salaried</option>
				<option value="2">Self Employed</option>
				</select></td>
                   </tr> <tr>
                    <td colspan="2" height="5" ></td>
                  </tr>
                   <tr>
                     <td align="left" valign="middle" class="form_txt"><b>Monthly Income</b></td>
                     <td class="form_txt" align="left" valign="middle"><input type="text" name="monthly_income" id="monthly_income" style="width:150px;" value="<?php echo $income; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" ></td>
                   </tr>
                   
                   <tr>
                     <td align="left" valign="middle" class="form_txt"><b>Monthly Obligations</b></td>
                     <td class="form_txt" align="left" valign="middle"><input type="text" name="obligations" id="obligations" style="width:150px;" value="<?php echo $obligations; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" ></td>
                   </tr>
                   
                  <tr>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                  </tr>
                  <tr>
                    <td class="form_txt" align="left" valign="middle"><b>Loan Amount</b></td>
                    <td class="form_txt" align="left" valign="middle">
      <input type="text" name="loan_amount" id="loan_amount" style="width:150px;" maxlength="30" value="<?php echo $loan_amount; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" ></td>
                  </tr>
                 
                  <tr>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                  </tr>
               <tr>
                    <td class="form_txt" align="left" valign="middle"><b>Property Value</b></td>
                    <td class="form_txt" align="left" valign="middle">
     <input type="text" name="property_value" id="property_value" style="width:150px;" maxlength="30" value="<?php echo $property_value; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);" ></td>
                  </tr>
                  <tr>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                  </tr>      
                
                    <tr>
                    <td class="form_txt" align="left" valign="middle"><input type="checkbox" name="co_appli" id="co_appli" value="1" onClick="return showdetailsFaq(1,12);" style="border:none;"> 
                    <b>Co- Applicant</b></td>
                    <td class="form_txt" align="left" valign="middle">
     </td>
                  </tr>    
                  <tr>
                    <td class="form_txt" align="left" height="5" valign="middle" colspan="2">
                  <div style="display: none;" id="divfaq1">
                    <table align="right" border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                  </tr>  
                      <tr>
                    <td class="form_txt" align="left" valign="middle"><b>Date of Birth</b></td>
                    <td class="form_txt" align="left" valign="middle">
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
                    <select name="co_year" style="width:55px;">
                    <option value="">year</option>
                    <?php
                    for($i=1988;$i>=1949;$i--)
                    {
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select> 
                    </td>
                  </tr>    
                   <tr>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                  </tr>  
                    <tr>
                    <td class="form_txt" align="left" valign="middle"><b>Net Monthly Income</b></td>
                    <td class="form_txt" align="left" valign="middle">
   <input type="text" name="co_monthly_income" id="co_monthly_income" style="width:150px;" value="<?php echo $income; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
                  </tr>    
                   <tr>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                  </tr>  
                    <tr>
                    <td class="form_txt" align="left" valign="middle"><b>Obligations</b></td>
                    <td class="form_txt" align="left" valign="middle">
    <input type="text" name="co_obligations" id="co_obligations" style="width:150px;" value="<?php echo $obligations; ?>"  onKeyUp="intOnly(this);" onKeyPress="intOnly(this);"></td>
                  </tr>    
                    
                    </table>
                    </div>
                    </td>
                  </tr>      
                            
                  <tr>
                    <td colspan="2" align="center" valign="middle">
                    <div id="mobMessage" style="padding: 5px; display: none; font-size: 11px; width: 245px; border: 1px solid rgb(195, 142, 199); background-color: rgb(244, 251, 254); font-family: Arial,Helvetica,sans-serif;" align="center">You
 will recieve a verification code on your mobile no. Please enter this 
on submission of the form. In case of network delay, you have to wait up
 to 5 mins.</div>                    </td>
                  </tr>
                  <tr>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                    <td class="form_txt" align="left" height="5" valign="middle"></td>
                  </tr>
                  <tr>
				 <td colspan="2" class="form_txt" align="center" height="60" valign="bottom">
	
				 <input src="icici_car/but_quote.gif" name="Submit" type="image">
						 </td>
                  </tr>
                </table></td>
              </tr>
             
            </table>
            </form>
            </td>
          </tr>
        </table></td>
      </tr>
     <tr>
        <td><img src="icici_car/body_btm.gif" height="10" width="872"></td>
      </tr>
      <tr>
        <td height="35">&nbsp;</td>
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