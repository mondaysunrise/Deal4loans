function addIdentified()
{
		var ni1 = document.getElementById('myDiv1');
	    ni1.innerHTML = '<div class="blnew-input-box" style="margin-top:10px"><div style="color:#FFF;">Card held since?</div>    <div><select size="1" name="Card_Vintage" class="form-select" onchange="validateDiv(\'vintageVal\');" ><option value="0">Please select</option> <option value="1">Less than 6 months</option> <option value="2">6 to 9 months</option> <option value="3">9 to 12 months</option><option value="4">more than 12 months</option> </select></div><div><div id="vintageVal"></div></div></div>';
					
		return true;
}	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	var ni2 = document.getElementById('myDiv2');
			
	ni1.innerHTML = '';
	ni2.innerHTML = '';
	return true;
}	

function ShowSalaried(){
	var ni1 = document.getElementById('myDiv3');
	ni1.innerHTML = '<div class="salaried-form-wrapper" id="salariedOptions">  <div class="blmainforminn2" id="CompName"><div class="form-css-head">Company Name:</div>  <div class="inputwrapprer"><input name="Company_Name" id="Company_Name" type="text" class="form-input" onkeyup="ajax_showOptions(this,\'getCountriesByLetters\',event, \'http://www.deal4loans.com/ajax-list-plcompanies.php\')" onkeydown="validateDiv(\'companyNameVal\');"  /> </div><div id="companyNameVal"></div></div><div class="blmainforminn2" id="AnnualIncome"><div class="form-css-head">Annual Income:</div><div class="inputwrapprer"><input type="text" name="IncomeAmount" id="IncomeAmount" class="form-input"  onkeyup="intOnly(this); getDiToWordsIncome(\'IncomeAmount\',\'formatedIncome\',\'wordIncome\');" onKeyPress="intOnly(this);"  onblur="getDiToWordsIncome(\'IncomeAmount\',\'formatedIncome\',\'wordIncome\');" onKeyDown="validateDiv(\'IncomeAmountVal\');" autocomplete="off" /><div id="IncomeAmountVal"></div></div><span id=\'formatedIncome\'></span> <span id=\'wordIncome\'></span> </div><div class="blmainforminn2" id="CityOptions"><div class="form-css-head">City </div><div class="inputwrapprer"><select name="City" id="City" class="form-select" onChange="addPersonalDetails(); validateDiv(\'cityVal\'); othercity1(); addhdfclife();"  tabindex="7"><option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bahadurgarh">Bahadurgarh</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Guntur">Guntur</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Noida">Noida</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option><option value="Others">Others</option></select></div><div id="cityVal"></div></div></div>';
	}
function removeSalaried()
	{
		var ni3 = document.getElementById('myDiv3');
		ni3.innerHTML = '';
	}
function addPersonalDetails()
{
	var ni1 = document.getElementById('personalDetails');
	var ni2 = document.getElementById('addPadding');
	var ni3 = document.getElementById('addSubmit');
	var ni5 = document.getElementById('getImageScroll');
	
	 
	ni1.innerHTML = '<div style="clear:both;"></div><div style="text-align:left; text-indent:10px; color:#FFF; "><strong>Personal Details</strong></div><div class="termtext"><img src="/images/security.png" width="14" height="16"> <span style="color:#FFF;">Your Information is secure with us and will not be shared without your consent</span></div></div><div class="blnew-input-box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" style="color:#FFF;">Full Name:</td>    </tr>    <tr>      <td height="25">   <input name="Name" id="Name" type="text"  class="form-input" onkeydown="validateDiv(\'nameVal\');" autocomplete="off" />   <div id="nameVal"></div>  </td>    </tr>    </table></div><div class="blnew-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" style="color:#FFF;">Email ID :</td>    </tr>    <tr>      <td height="25">  <input name="Email" id="Email" type="text" class="form-input" onkeypress="validateDiv(\'emailVal\');" autocomplete="off" />          <div id="emailVal"></div>   </td>    </tr>      </table></div><div class="blnew-input-box">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">    <tr>      <td height="25" colspan="2" style="color:#FFF;">Mobile:</td>    </tr>        <tr>      <td width="4%" height="25"><div style="float:left; margin-top:5px; color:#FFF;"><em>+91</em></div>          </td><td width="96%"><input name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" type="text" class="form-input" onkeydown="validateDiv(\'phoneVal\');" autocomplete="off" /> <div id="phoneVal"></div> </td></tr>    </table></div><div class="blnew-input-box">  <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" style="color:#FFF;">Age:</td></tr><tr><td height="25"><select onchange="validateDiv(\'AgeVal\');" class="form-select" name="Age" id="Age"><option value="">Select Age</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option></select><div id="AgeVal"></div></td>    </tr>    </table></div><div style="clear:both;"></div><div class="blnew-input-box" style="margin-top:10px">  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"><tr><td height="25" width="100%" style="color:#FFF;">Credit Card:</td></tr><tr><td height="25" style="width:60%;"> 	<input type="radio" name="CC_Holder" id="CC_Holder" value="1" class="css-checkbox" onclick="return addIdentified();" /><label for="CC_Holder" class="css-label radGroup2" style="color:#FFF;">Yes</label></td><td height="25"> <input type="radio" name="CC_Holder" id="CC_Holder2" value="0" class="css-checkbox" onclick="removeIdentified();" checked="checked" />            <label for="CC_Holder2" class="css-label radGroup2" style="color:#FFF;">No</label></td>    </tr>    </table></div><div class="form-inputox" id="myDiv1"></div>';
	ni3.innerHTML = '<div style="clear:both; height:5px;"></div><div class="new_terms_box" style="color:#FFF;"><span class="termtext">  <input name="accept" type="checkbox" checked="checked" onclick="validateDiv(\'acceptVal\');" /> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" rel="nofollow" style="text-decoration:underline!important; color:#FFF !important;"> partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow" style="text-decoration:underline; color:#FFF;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style="text-decoration:underline; color:#FFF;">Terms and Conditions</a>.                 <div id="acceptVal"></div></span></div><div style="clear:both;"></div><div id="hdfclife"></div><div style="clear:both;"></div>';
}
function AnyCreditCard()
{
	var ni1 = document.getElementById('PersonalDetailsSelf');
	ni1.innerHTML = '<div id="personal-details" class="personal-details-main-wrapper"><div class="form-css-head margin-top-business-loan"> Personal Details</div><div style="color:#FFF;"><img src="/images/security.png" width="14" height="16" alt="lock"> Your Information is secure with us and will not be shared without your consent</div><div class="blmainforminn2"><div class="form-css-head">Name </div><div class="inputwrapprer"><input name="Name" id="FullName" type="text" class="form-input" onKeyDown="validateDiv(\'FullNameVal\')"/> </div> <div id="FullNameVal"> </div> </div><div class="blmainforminn2 margin-left15"><div class="form-css-head">Mobile Number </div>  <div class="inputwrapprer"> <input name="Phone" id="MobileNum" type="text"  maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" class="form-input" onKeyDown="validateDiv(\'MobileNumVal\')"></div><div id="MobileNumVal"> </div></div><div class="blmainforminn2 margin-left15"><div class="form-css-head">City </div> <div class="inputwrapprer"><select name="City" id="City" class="form-select" onChange="validateDiv(\'City2Val\'); othercity1();"><option value="Please Select">Please Select</option><option value="Ahmedabad">Ahmedabad</option><option value="Bangalore">Bangalore</option><option value="Chandigarh">Chandigarh</option><option value="Chennai">Chennai</option><option value="Cochin">Cochin</option><option value="Delhi">Delhi</option><option value="Hyderabad">Hyderabad</option><option value="Jaipur">Jaipur</option><option value="Jalandhar">Jalandhar</option><option value="Kolkata">Kolkata</option><option value="Lucknow">Lucknow</option><option value="Mumbai">Mumbai</option><option value="Nagpur">Nagpur</option><option value="Pune">Pune</option><option value="Surat">Surat</option><option value="Ananthpur">Ananthpur</option><option value="Aurangabad">Aurangabad</option><option value="Baroda">Baroda</option><option value="Bahadurgarh">Bahadurgarh</option><option value="Bhimavaram">Bhimavaram</option><option value="Bhiwadi">Bhiwadi</option><option value="Bhopal">Bhopal</option><option value="Bhubneshwar">Bhubneshwar</option><option value="Calicut">Calicut</option><option value="Coimbatore">Coimbatore</option><option value="Cuttack">Cuttack</option><option value="Dehradun">Dehradun</option><option value="Dindigul">Dindigul</option><option value="Eluru">Eluru</option><option value="Ernakulam">Ernakulam</option><option value="Erode">Erode</option><option value="Faridabad">Faridabad</option><option value="Gaziabad">Gaziabad</option><option value="Guntur">Guntur</option><option value="Gurgaon">Gurgaon</option><option value="Guwahati">Guwahati</option><option value="Hosur">Hosur</option><option value="Indore">Indore</option><option value="Jabalpur">Jabalpur</option><option value="Jamshedpur">Jamshedpur</option><option value="Kakinada">Kakinada</option><option value="Karaikkal">Karaikkal</option><option value="Karimnagar">Karimnagar</option><option value="Karur">Karur</option><option value="Kanpur">Kanpur</option><option value="Khammam">Khammam</option><option value="Kishangarh">Kishangarh</option><option value="Kochi">Kochi</option><option value="Kozhikode">Kozhikode</option><option value="Kumbakonam">Kumbakonam</option><option value="Kurnool">Kurnool</option><option value="Ludhiana">Ludhiana</option><option value="Madurai">Madurai</option><option value="Mangalore">Mangalore</option><option value="Mysore">Mysore</option><option value="Nagerkoil">Nagerkoil</option><option value="Nasik">Nasik</option><option value="Navi Mumbai">Navi Mumbai</option><option value="Nellore">Nellore</option><option value="Nizamabad">Nizamabad</option><option value="Noida">Noida</option><option value="Ongole">Ongole</option><option value="Ooty">Ooty</option><option value="Patna">Patna</option><option value="Pondicherry">Pondicherry</option><option value="Pudukottai">Pudukottai</option><option value="Rajahmundry">Rajahmundry</option><option value="Ramagundam">Ramagundam</option><option value="Raipur">Raipur</option><option value="Rewari">Rewari</option><option value="Sahibabad">Sahibabad</option><option value="Salem">Salem</option><option value="Srikakulam">Srikakulam</option><option value="Thane">Thane</option><option value="Thanjavur">Thanjavur</option><option value="Thrissur">Thrissur</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Tirunelveli">Tirunelveli</option><option value="Tirupathi">Tirupathi</option><option value="Trivandrum">Trivandrum</option><option value="Trichy">Trichy</option><option value="Tuticorin">Tuticorin</option><option value="Vadodara">Vadodara</option><option value="Vellore">Vellore</option><option value="Vishakapatanam">Vishakapatanam</option><option value="Vizag">Vizag</option><option value="Vizianagaram">Vizianagaram</option><option value="Warangal">Warangal</option><option value="Others">Others</option></select></div><div id="City2Val"> </div> </div>  <div style="clear:both; height:0px;"></div><div class="blmainforminn2">  <div class="form-css-head">E-Mail ID</div><div class="inputwrapprer">  <input name="Email" type="text" class="form-input" onKeyDown="validateDiv(\'EmailIDVal\')">            </div> <div id="EmailIDVal"> </div> </div> <div class="blmainforminn2 margin-left15">    <div class="form-css-head">Age </div> <div class="inputwrapprer">      <select onchange="validateDiv(\'AgeVal\');" class="form-select" name="Age" id="Age"><option value="">Select Age</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option><option value="60">60</option><option value="61">61</option><option value="62">62</option><option value="63">63</option><option value="64">64</option><option value="65">65</option></select><div id="AgeVal"></div> </div> </div> <div class="blmainforminn2 margin-left15"><div class="form-css-head">Residence Status </div> <div class="inputwrapprer"><input type="radio" name="Residential_Status" id="Residence_Status1" value="1" class="css-checkbox" /> <label for="Residence_Status1" class="css-label radGroup2">Owned</label> <input type="radio"name="Residential_Status" id="Residence_Status2" value="0" class="css-checkbox" /> <label for="Residence_Status2" class="css-label radGroup2">Rented</label></div> </div><div style="clear:both;"></div><div class="blmainforminn2 margin-left15"><div class="form-css-head">Office Status</div>  <div class="inputwrapprer"><input type="radio" name="Office_Status" id="Office_Status1" value="1" class="css-checkbox" /><label for="Office_Status1" class="css-label radGroup2">Owned</label><input type="radio"name="Office_Status" id="Office_Status2" value="0" class="css-checkbox" /> <label for="Office_Status2" class="css-label radGroup2">Rented</label> </div><div class="inputwrapprer"></div>  </div><div style="clear:both; height:15px;"></div><input type="checkbox" name="checkbox" id="checkbox" checked /> <span style="color:#FFF;"> I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/pl-partnering-banks.php" target="_blank" style="color:#FFF;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" style="color:#FFF;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" style="color:#FFF;">Terms and Conditions</a>.</span></div>';
	
}

function formValidate()
{
	var i;
	if (document.personalloan_form.Loan_Amount.value=="")
	{
		document.getElementById('loanAmtVal').innerHTML = "<span  class='hintanchor'>Enter Loan Amount!</span>";	
		document.personalloan_form.Loan_Amount.focus();
		return false;
	}	
	
	var myOption = -1;
		for (i=document.personalloan_form.Employment_Status.length-1; i > -1; i--) {
			if(document.personalloan_form.Employment_Status[i].checked) {
				myOption = i;
				
				if(i==0)
				{
					//salaried
					
				if((document.personalloan_form.Company_Name.value==""))
					{
						document.getElementById('companyNameVal').innerHTML = "<span  class='hintanchor'>Fill Company Name!</span>";	
						document.personalloan_form.Company_Name.focus();
						return false;
					}
					
				if (document.getElementById('IncomeAmount').value=="")
					{
						document.getElementById('IncomeAmountVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";
						document.getElementById('IncomeAmount').focus();
						return false;
					}	
					
		if ((document.personalloan_form.City.value=="") || (document.personalloan_form.City.value=="Please Select"))
			{
				document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
				document.personalloan_form.City.focus();
				return false;
			}
			
			if (document.personalloan_form.Name.value=="")
					{
						document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name!</span>";
						document.personalloan_form.Name.focus();
						return false;
					}
					
			if (document.personalloan_form.Email.value=="")
			{
				document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Email Address!</span>";
				document.personalloan_form.Email.focus();
				return false;
			}
			
	var str=document.personalloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)

	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.personalloan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.personalloan_form.Email.focus();
		return false;
	}
			
			if (document.personalloan_form.Phone.value=="")
			{
				document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
				document.personalloan_form.Phone.focus();
				return false;
			}
			
			if(isNaN(document.personalloan_form.Phone.value)|| document.personalloan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
		document.personalloan_form.Phone.focus();
		return false;  
	}
	if (document.personalloan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.personalloan_form.Phone.focus();
		return false;
	}
	if ((document.personalloan_form.Phone.value.charAt(0)!="9") && (document.personalloan_form.Phone.value.charAt(0)!="8") && (document.personalloan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.personalloan_form.Phone.focus();
		return false;
	}
			
			if (document.personalloan_form.Age.value=="")
			{
				document.getElementById('AgeVal').innerHTML = "<span  class='hintanchor'>Please select Age!</span>";
				document.personalloan_form.Age.focus();
				return false;
			}
		}
				else
				{
					if(i==1)
					{
						//self employed
						
						var myOption2 = -1;
						for (i=document.personalloan_form.Total_Experience.length-1; i > -1; i--) {
							if(document.personalloan_form.Total_Experience[i].checked) {
							myOption2 = i;
							
							if(i>=0)
								{
									//Start Annual Income 
							var myOptionAnnualIn = -1;
							for (i=document.personalloan_form.IncomeAmount.length-1; i > -1; i--) {
							if(document.personalloan_form.IncomeAmount[i].checked) {
							myOptionAnnualIn = i;
							if(i>=0)
								{
								   // Start Annual TurnOver
								   
							 var myOptionAnnualTurnOv = -1;
							for (i=document.personalloan_form.Annual_Turnover.length-1; i > -1; i--) {
							if(document.personalloan_form.Annual_Turnover[i].checked) {
							myOptionAnnualTurnOv = i;
							if(i>=0)
								{
								   // Start Any Existing Loan
							var myOptionExistingLoan = -1;
							for (i=document.personalloan_form.Existing_Loan.length-1; i > -1; i--) {
							if(document.personalloan_form.Existing_Loan[i].checked) {
							myOptionExistingLoan = i;
							if(i==0)
								{
								   // Start Loan Type
								   var myOptionLoanAny = -1;
							for (i=document.personalloan_form.Loan_Any.length-1; i > -1; i--) {
							if(document.personalloan_form.Loan_Any[i].checked) {
							myOptionLoanAny = i;
							if(i>=0)
								{
								   // Start EMIs Paid
								   
							var myOptionEMIPaid = -1;
							for (i=document.personalloan_form.EMI_Paid.length-1; i > -1; i--) {
							if(document.personalloan_form.EMI_Paid[i].checked) {
							myOptionEMIPaid = i;
							if(i>=0)
								{
								   // Start Any Credit Card
								   
								   var myOptionCCHolder = -1;
							for (i=document.personalloan_form.CC_Holder.length-1; i > -1; i--) {
							if(document.personalloan_form.CC_Holder[i].checked) {
							myOptionCCHolder = i;
							if(i==0)
								{
								   // Start Holding This Credit Card Since
								   
								   
							var myOptionCardVintage = -1;
							for (i=document.personalloan_form.Card_Vintage.length-1; i > -1; i--) {
							if(document.personalloan_form.Card_Vintage[i].checked) {
							myOptionCardVintage = i;
							if(i==0)
								{
								   // Start Persoanal Details
								   
								   
								   
								   //End Persoanal Details
										
									
								}
							}
						}
						if (myOptionCardVintage == -1) 
						{
						document.getElementById('CardVintageVal').innerHTML = "<span  class='hintanchor'>Please Check Holding This Credit Card Since!</span>";	
						return false;
						}
								   //End  Holding This Credit Card Since
									
								}
							}
						}
						if (myOptionCCHolder == -1) 
						{
						document.getElementById('CCHolderVal').innerHTML = "<span  class='hintanchor'>Please Check Any Credit Card</span>";	
						return false;
						}
								   //End  Any Credit Card
								}
							}
						}
						if (myOptionEMIPaid == -1) 
						{
						document.getElementById('EMIPaidVal').innerHTML = "<span  class='hintanchor'>Please Check EMIs Paid</span>";	
						return false;
						}
								   //End  EMIs Paid 
								}
							}
						}
						if (myOptionLoanAny == -1) 
						{
						document.getElementById('LoanAnyVal').innerHTML = "<span  class='hintanchor'>Please Check Loan Type</span>";	
						return false;
						}
								   //End  Loan Type 
								}
								
								
								if(i==1)
								{
									
							var myOptionCCHolder = -1;
							for (i=document.personalloan_form.CC_Holder.length-1; i > -1; i--) {
							if(document.personalloan_form.CC_Holder[i].checked) {
							myOptionCCHolder = i;
							
							if(i==0)
								{
								   // Start Holding This Credit Card Since
								   
								   var myOptionCardVintage = -1;
							for (i=document.personalloan_form.Card_Vintage.length-1; i > -1; i--) {
							if(document.personalloan_form.Card_Vintage[i].checked) {
							myOptionCardVintage = i;
							if(i>=0)
								{
								   // Start Persoanal Details
							
							
								
								   //End Persoanal Details
										
									
								}
							}
						}
						if (myOptionCardVintage == -1) 
						{
						document.getElementById('CardVintageVal').innerHTML = "<span  class='hintanchor'>Please Check Holding This Credit Card Since!</span>";	
						return false;
						}
								   
								   //End Holding This Credit Card Since
										
									
								}
								//Credit Card No
								if(i==1)
								{
									//Start Personal Details
									
									
									// End Personal Details
									
									
									}
							}
						}
						if (myOptionCCHolder == -1) 
						{
						document.getElementById('CCHolderVal').innerHTML = "<span  class='hintanchor'>Please Check Any Credit Card!</span>";	
						return false;
						}
								}
								
							}
						}
						if (myOptionExistingLoan == -1) 
						{
						document.getElementById('ExistingLoanVal').innerHTML = "<span  class='hintanchor'>Please Check Any Existing Loan!</span>";	
						return false;
						}
							
							
								   //End  Any Existing Loan 
								}
							}
						}
						if (myOptionAnnualTurnOv == -1) 
						{
						document.getElementById('AnnualTurnoverVal').innerHTML = "<span  class='hintanchor'>Please Check Annual Turnover!</span>";	
						return false;
						}
								   //End  Annual Turn Over 
								}
							}
						}
						if (myOptionAnnualIn == -1) 
						{
						document.getElementById('NetSalaryVal').innerHTML = "<span  class='hintanchor'>Please Check Annual Income/ ITR!</span>";	
						return false;
						}
									///End Annual Encome
								}
				
							}
						}
						if (myOption2 == -1) 
						{
						document.getElementById('TotalExperienceVal').innerHTML = "<span  class='hintanchor'>Please Check Running Business Since!</span>";	
						return false;
						}
						
					}
				}
				
				}
		}
	
		if (myOption == -1) 
		{
			document.getElementById('EmpStatus').innerHTML = "<span  class='hintanchor'>Please Check Employment Status!</span>";	
			return false;
		}
		
		// Start Self Employee Personal Details 
		if (document.personalloan_form.Name.value=="")
			{
				document.getElementById('FullNameVal').innerHTML = "<span  class='hintanchor'>Please Enter Your name!</span>";
				document.personalloan_form.Name.focus();
				return false;
			}
		if (document.personalloan_form.Phone.value=="")
			{
				document.getElementById('MobileNumVal').innerHTML = "<span  class='hintanchor'>Fill Mobile Number!</span>";
				document.personalloan_form.Phone.focus();
				return false;
			}
			
		if(isNaN(document.personalloan_form.Phone.value)|| document.personalloan_form.Phone.value.indexOf(" ")!=-1)
			{
				document.getElementById('MobileNumVal').innerHTML = "<span  class='hintanchor'>Enter numeric value!</span>";
				document.personalloan_form.Phone.focus();
				return false;  
			}
		if (document.personalloan_form.Phone.value.length < 10 )
			{
				document.getElementById('MobileNumVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
				document.personalloan_form.Phone.focus();
				return false;
			}
		if ((document.personalloan_form.Phone.value.charAt(0)!="9") && (document.personalloan_form.Phone.value.charAt(0)!="8") && (document.personalloan_form.Phone.value.charAt(0)!="7"))
			{
				document.getElementById('MobileNumVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
				document.personalloan_form.Phone.focus();
				return false;
			}
								
		if ((document.personalloan_form.City.value=="") || (document.personalloan_form.City.value=="Please Select"))
			{
				document.getElementById('City2Val').innerHTML = "<span  class='hintanchor'>Enter City to Continue!</span>";	
				document.personalloan_form.City.focus();
				return false;
			}								
				
	var str=document.personalloan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
		{
			document.getElementById('EmailIDVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
			document.personalloan_form.Email.focus();
			return false;
		}
	else if(bb==-1)
		{
			document.getElementById('EmailIDVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
			document.personalloan_form.Email.focus();
			return false;
		}
		
}
function validateDiv(div)
{
	var ni1 = document.getElementById(div);
	ni1.innerHTML = '';
}