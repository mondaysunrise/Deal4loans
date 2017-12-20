<?php
require 'scripts/functions.php';
require 'scripts/session_check.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script language="javascript" type="text/javascript" src="icici_car/Functions.js"></script>
<script language="javascript" src="icici_car/Functions_002.js"></script>
<script type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
<script language="javascript" src="icici_car/FormCheck.js"></script>


<script type="text/javascript" src="ajax.js"></script>
<script type="text/javascript" src="ajax-dynamic-pllist.js"></script>

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

<script>
function addIdentified()
{
		var ni = document.getElementById('myDiv1');
		if(document.getElementById('Property_Identified').value>0)
	{
		ni.innerHTML = '<table width="100%" align="left" border="0"><tr><td class="frst_cl" align="left" width="50%">Property Location <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>	<td  width="50%" align="left"  ><select style="width:147px;" name="Property_Loc" id="Property_Loc" class="frst_cl"><?=getCityList1($City)?></select></td></tr><tr><td class="frst_cl" align="left">Property Value <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>	<td align="left" ><input type="text" style="width:145px;" name="Property_Value" id="Property_Value" ></td></tr><tr><td class="frst_cl" align="left">Builders Name (Optional)</td>	<td align="left" height="20" ><input type="text" style="width:145px;" name="Builder_Name" id="Builder_Name"></td></tr>';
	}
	else
	{
		ni.innerHTML = '';
	}
			
		return true;
}	


function addITR()
{
	//alert("hello");
		var ni1 = document.getElementById('myDiv2');
		
	if(document.getElementById('Employment_Status').value=="Self Employed")
	{
		ni1.innerHTML = '<table width="100%" align="left" border="0"><tr><td class="frst_cl" align="left" width="50%">Current Yr ITR <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>	<td  width="50%" align="left"  ><input type="text" style="width:145px;" name="current_itr" id="current_itr" ></td></tr><tr><td class="frst_cl" align="left">Last Yr ITR <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>	<td align="left" ><input type="text" style="width:145px;" name="last_itr" id="last_itr" ></td></tr></table>';
	}
	else
	{	ni1.innerHTML ='<table width="100%"  align="left">							<tr>							<td class="frst_cl" align="left" width="50%">Fixed Monthly Income <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>							<td class="frst_cl" align="left"  width="50%"><input type="text" name="Monthly_Income" id="Monthly_Income" style="width:145px;"> </td>							</tr>						</table>';

	}
			
		return true;
}	

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

function chkform()
{
	if (document.firstblue_form.City.selectedIndex==0)
	{
		alert("Please enter City Name to Continue");
		document.firstblue_form.City.focus();
		return false;
	}
	if (document.firstblue_form.Property_Identified.selectedIndex==0)
	{
		alert("Please enter Purpose Of Loan to Continue");
		document.firstblue_form.Property_Identified.focus();
		return false;
	}
	
	 if(document.firstblue_form.day.selectedIndex==0 && document.firstblue_form.day.value=="")
		{
		alert("Kindly enter your Date of Birth");
		document.firstblue_form.day.focus();
		return false;
	}
	if(document.firstblue_form.month.selectedIndex==0)
		{
		alert("Kindly enter your Month of Birth");
		document.firstblue_form.month.focus();
		return false;
	}
	if(document.firstblue_form.year.selectedIndex==0)
		{
		alert("Kindly enter your Year of Birth");
		document.firstblue_form.year.focus();
		return false;
	}

	
if (document.firstblue_form.Employment_Status.selectedIndex==0)
	{
		alert("Please enter Type Of Employment to Continue");
		document.firstblue_form.Employment_Status.focus();
		return false;
	}
if((document.firstblue_form.company_name.value=="") )
		{
			alert("Please fill your Company Name.");
			document.firstblue_form.company_name.focus();
			return false;
		}
if (document.getElementById('Employment_Status').value=="Salaried")
{
	if((document.firstblue_form.Monthly_Income.value=="") )
		{
			alert("Please fill your Monthly Income.");
			document.firstblue_form.Monthly_Income.focus();
			return false;
		}
}
else if (document.getElementById('Employment_Status').value=="Self Employed")
	{
	if((document.firstblue_form.current_itr.value=="") )
		{
			alert("Please fill your Current Year ITR.");
			document.firstblue_form.current_itr.focus();
			return false;
		}
	if((document.firstblue_form.last_itr.value=="") )
	{
		alert("Please fill your Last Year ITR.");
		document.firstblue_form.last_itr.focus();
		return false;
	}

	}
if (document.firstblue_form.Property_Identified.value==1 || document.firstblue_form.Property_Identified.value==2)
	{
		if(document.firstblue_form.Property_Loc.selectedIndex==0)
		{
			alert("Please enter Property Loc to Continue");
			document.firstblue_form.Property_Loc.focus();
			return false;
		}
	if((document.firstblue_form.Property_Value.value=="") )
		{
			alert("Please fill your Property Value.");
			document.firstblue_form.Property_Value.focus();
			return false;
		}
	}

}
</script>
<style>
.frst_cl {
	color:#663300; 
	font-family:Verdana, Arial, Helvetica, sans-serif; 
	font-size:12px;
}
</style>
</head>

<body >
<table width="990" align="center">
	<tr>
		<td width="188" height="117"><img src="new-images/first_blue_logo.jpg" width="188" height="117"/></td>
		<td width="790" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:26px; color:#F8C301; font-weight:450;">Get competitive offers on First Blue Home finance Ltd.</td>
	</tr>
	<tr>
		<td colspan="2" valign="top"> 
			<table width="100%" valign="top">
				<tr>
					<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#676767; padding-top:20px;" valign="top"><div valign="top" style="color:#0067AC; font-size:12px; font-weight:bold;" ><img src="new-images/frstbl-step1.jpg" /><span valign="top" style="padding-bottom:20px;">Get Eligibility &nbsp;&nbsp;</span> <img src="new-images/frstbl-step2.jpg" /><span valign="top" style="padding-bottom:20px;">Complete application &nbsp;&nbsp;</span><img src="new-images/frstbl-step3.jpg" /><span valign="top" style="padding-bottom:20px;">Get Approval &nbsp;&nbsp;</span></div>
<span style="color:#0067AC; font-size:13px;"><br /><br /><b>First Blue Home Finance Ltd. ensures to provide:</b></span><br /><br />

<ul>
<li> Innovative approach to home loans.<br />&nbsp;</li>
<li> Assistance in identifying property.<br />&nbsp;</li>
<li> Doorstep accessibility to its customers.<br />&nbsp;</li>
<li> Widest-available range of home loan products.<br />&nbsp;</li>
<li> Loan approval even before a property is selected. <br />&nbsp;</li>
<li> Full range of contemporarily fixed and variable interest rate home loan schemes.<br />&nbsp;</li>
<li> Customized products across various income groups, tenures and  customer segments.<br />&nbsp;</li>
</ul>
</td>
<td width="395" valign="top" align="center">
<table width="100%" cellpadding="4" cellspacing="1" style="border:#676767 solid 1px;">
	<tr>
		<td height="30" bgcolor="#F08600" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; color:#FFFFFF;" align="center"><b>Apply Now
</b></td>
		</tr>
		<tr>
			<td align="center" bgcolor="#F8C301">
			<form name="firstblue_form" action="apply_first_blue_continue.php" method="POST" onSubmit="return chkform();">
			<table bgcolor="#F8C301" width="90%" cellpadding="2" cellspacing="1" align="center" border="0">
			<tr>
			<td width="50%" align="left" class="frst_cl">City <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
			<td width="50%" class="frst_cl" align="left"><select name="City" id="City" style="width:145px;" tabindex="1" class="frst_cl">
		   <?=getCityList($City)?>
	   </select></td>
		</tr>
		<tr>
				<td class="frst_cl" align="left">Purpose of loan <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span>
</td>
				<td class="frst_cl" align="left"><select style="width:160px; font-size:12px;" class="frst_cl" name="Property_Identified" id="Property_Identified" onChange="addIdentified();">
					<option value="Please Select">Please Select</option>
					<option value="1">Purchase/construct on identified property</option>
					<option value="2">Purchase not yet identified property</option>
					<option value="3">Purchase of Plot</option>
					</select>
				
			</tr>
						<tr>
							<td class="frst_cl" align="left">DOB <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
							<td class="frst_cl" align="left" >
							<span id="">
                    <select name="day" style="width:44px;" id="day" class="frst_cl">
                    <option value="">dd</option>
                    <?php
                    for($i=1;$i<=31;$i++)
                    { 
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select>
                    </span>
                    <?php
                    $month_arr = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
                    ?>
                    <select name="month" id="month" style="width:49px;" class="frst_cl">
                    <option value="">mm</option>
                    <?php
                    for($i=0;$i<count($month_arr);$i++)
                    {
                        $count = $i+1;
                        echo "<option value='".$count."'>".$month_arr[$i]."</option>";
                    }
                    ?>
                    </select>
                    
                    <select name="year" style="width:56px;" id="year" class="frst_cl">
                    <option value="">yyyy</option>
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
							<td class="frst_cl" align="left">Type Of Employment <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
							<td class="frst_cl" align="left"><select style="width:145px;" class="frst_cl" name="Employment_Status" id="Employment_Status" onChange="addITR();">
								<option value="Please Select">Please Select</option>
								<option value="Salaried" <? if($_SESSION['Employment_Status']=="Salaried") echo "Selected" ;?>>Salaried</option>
								<option value="Self Employed" <? if($_SESSION['Employment_Status']=="Self Employed") echo "Selected" ;?>>Self Employed</option>
								</select></td>
						</tr>
					
						<tr>
							<td class="frst_cl" align="left">Company Name <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
							<td class="frst_cl" align="left"><input type="text" name="company_name" id="company_name" style="width:145px;"  class="txtbox" tabindex="4" onKeyUp="ajax_showOptions(this,'getCountriesByLetters',event)"  <? if(strlen($_SESSION['company_name'])>0) echo "value=".$_SESSION['company_name'].""; ?> /></td>
						</tr>
						<tr>
						<td colspan="2" >
						<div id="myDiv2" width="100%" >
<? if($_SESSION['Employment_Status']=="Self Employed") 
							{ 
						 ?>
							<table width="100%" align="left" border="0"><tr><td class="frst_cl" align="left" width="50%">Current Yr ITR <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>	<td  width="50%" align="left"  ><input type="text" style="width:145px;" name="current_itr" id="current_itr" ></td></tr><tr><td class="frst_cl" align="left">Last Yr ITR <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>	<td align="left" ><input type="text" style="width:145px;" name="last_itr" id="last_itr" ></td></tr></table>
						<? } else
						{?>
						<table width="100%"align="left">
							<tr>
							<td class="frst_cl" align="left" width="50%">Fixed Monthly Income <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>
							<td width="50%" align="left" class="frst_cl">
													
							<input type="text" name="Monthly_Income" id="Monthly_Income" style="width:145px;"> </td>
							</tr>
						</table>
					<? 	}
							?>
						</div>
						</td>

							
						</tr>
						
						 <tr>
                <td colspan="2" class="frst_cl" align="left">
				<div id="myDiv1"><? if($_SESSION['Property_Identified']>0)
								{
							 ?>
						<table width="100%" align="left" border="0"><tr><td class="frst_cl" align="left" width="50%">Property Location <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>	<td  width="50%" align="left"  ><select style="width:147px;" name="Property_Loc" id="Property_Loc" class="frst_cl"><?=getCityList1($_SESSION['Property_Loc'])?></select></td></tr><tr><td class="frst_cl" align="left">Property Value <span style="font-weight:normal; color:#FF0000; font-size:9;">*</span></td>	<td align="left" ><input type="text" style="width:145px;" name="Property_Value" id="Property_Value" value="<? echo  $_SESSION['Property_Value']; ?>" ></td></tr><tr><td class="frst_cl" align="left">Builders Name (Optional)</td>	<td align="left" height="20" ><input type="text" style="width:145px;" name="Builder_Name" id="Builder_Name" value="<? echo  $_SESSION['Builder_Name']; ?>"></td></tr>
							<?	}
								else
								{

								}?></div>
                  </td>
              </tr>
						<tr>
							<td class="frst_cl" align="left">Total EMIs you currently pay per month. (if any)</td>
							<td class="frst_cl" align="left"><input type="text" name="Total_Emi" id="Total_Emi" style="width:142px;" value="<? echo $_SESSION['Total_Emi']; ?>"></td>
						</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
						<tr><td colspan="2" align="center"><input type="submit" style="border: 0px none ; background-image: url(new-images/frst-quote-btn.jpg); width: 128px; height: 31px; margin-bottom: 0px;" value=""/></td></tr>
						</table>
						</form>
					</td>
						</tr>
					</table>
				
			</td>
		</tr>
	</table>
		</td>
	</tr>
</table>
</body>
</html>
