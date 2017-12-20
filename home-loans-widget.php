<?php if (substr_count($_SERVER[‘HTTP_ACCEPT_ENCODING’], ‘gzip’)) ob_start(“ob_gzhandler”); else ob_start(); ?>
<?
	$Cfcount=0;
?>
<link href="css/styles-home-loan.css" type="text/css" rel="stylesheet"  />
<link rel="stylesheet" href="css-range-slider/rangeslider.css">
<script Language="JavaScript" Type="text/javascript" src="scripts/common.js"></script>
<script src='scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script>
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
{	var j=strValue.length-1;i=0;
	while(strValue.charAt(i++)==' ');
	while(strValue.charAt(j--)==' ');
	return strValue.substr(--i,++j-i+1);
}

function containsdigit(param)
{mystrLen = param.length;
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
	var j;
	var cnt=-1;
	var alpha=/^[a-zA-Z\ ]*$/;
	var alphanum=/^[a-zA-Z0-9]*$/;
	var num=/^[0-9]*$/;
	var space=/^[\ ]*$/;
	var iChars ="/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

	
	if (document.loan_form.Employment_Status.selectedIndex==0)
	{
		document.getElementById('empStatusVal').innerHTML = "<span  class='hintanchor'>Select Employment Status to Continue!</span>";	
		document.loan_form.Employment_Status.focus();
		return false;
	}	
	if (document.loan_form.Net_Salary.value=="" || document.loan_form.Net_Salary.value=="Annual Income")
		{ 
		
			document.getElementById('netSalaryVal').innerHTML = "<span  class='hintanchor'>Enter Annual Income!</span>";
			document.loan_form.Net_Salary.focus();
		return false;
		}	
	if (document.loan_form.City.selectedIndex==0)
	{		
		document.getElementById('cityVal').innerHTML = "<span  class='hintanchor'>Select City to Continue!</span>";			
		document.loan_form.City.focus();		
		return false;	
	}
	
	if((document.loan_form.City.value=="Others") && ((document.loan_form.City_Other.value=="" || document.loan_form.City_Other.value=="Other City"  ) || !isNaN(document.loan_form.City_Other.value)))
	{
		document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";		
		document.loan_form.City_Other.focus();
		return false;
	}
	if(document.loan_form.Name.value=="" || document.loan_form.Name.value=="Full Name")
	{
		document.getElementById('nameVal').innerHTML = "<span class='hintanchor'>Please Enter Your name</span>";		
		document.loan_form.Name.focus();
		return false;
	}
   for (var i = 0; i <document.loan_form.Name.value.length; i++) 
   {
		if (iChars.indexOf(document.loan_form.Name.value.charAt(i)) != -1) 
		{
			document.getElementById('nameVal').innerHTML = "<span  class='hintanchor'>Contains special characters!</span>";
			document.loan_form.Name.focus();
			return false;
		}
   }

	if(document.loan_form.Email.value=="" || document.loan_form.Email.value=="E-mail Id")
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter  Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	var str=document.loan_form.Email.value
	var aa=str.indexOf("@")
	var bb=str.indexOf(".")
	var cc=str.charAt(aa)
	if(aa==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	else if(bb==-1)
	{
		document.getElementById('emailVal').innerHTML = "<span  class='hintanchor'>Enter Valid Email Address!</span>";	
		document.loan_form.Email.focus();
		return false;
	}
	
	
	if(isNaN(document.loan_form.Phone.value) || document.loan_form.Phone.value=="Mobile No." ||  document.loan_form.Phone.value.indexOf(" ")!=-1)
	{
		document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter Mobile No.!</span>";
		document.loan_form.Phone.focus();
		return false;  
	}
	if (document.loan_form.Phone.value.length < 10 )
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>Enter 10 Digits!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	if ((document.loan_form.Phone.value.charAt(0)!="9") && (document.loan_form.Phone.value.charAt(0)!="8") && (document.loan_form.Phone.value.charAt(0)!="7"))
	{
	  	document.getElementById('phoneVal').innerHTML = "<span  class='hintanchor'>should start with 9 or 8 or 7!</span>";	
		document.loan_form.Phone.focus();
		return false;
	}
	

	if(!document.getElementById("checkboxG2").checked)
	{
		document.getElementById('TermConditionVal').innerHTML = "<span class='hintanchor'>Please Check Term and condition to proceed.</span>";
		document.loan_form.accept.focus();
		return false;
	}
	
}  

function addIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	 ni1.innerHTML = '<div class="form-input-wrapper form-box-left-margin"><div>Property Location</div>    <div><select name="Property_loc" id="Property_loc" class="form-select" onchange="validateDiv(\'PropLocationVal\');"><?=getCityList1($City)?></select></div><div id="PropLocationVal"></div></div>';
	  var cfdiv = document.getElementById('commonfloorlogo');
	//alert(cfdiv);
	cfdiv.innerHTML='';
		return true;		
}	
function removeIdentified()
{
	var ni1 = document.getElementById('myDiv1');
	ni1.innerHTML = '';				
		return true;
}	
function showdetailsFaq(d,e)
{			
	for(j=1;j<=e;j++)
	{
		if(d==j)
		{
			if(eval(document.getElementById("divfaq"+j)).style.display=='none')
			{				eval(document.getElementById("divfaq"+j)).style.display=''			}
			else			{				eval(document.getElementById("divfaq"+j)).style.display='none'			}
		}
			
	}
}
function validateDiv(div) {	var ni1 = document.getElementById(div); 	ni1.innerHTML = ''; }


</script>
<script type="text/javascript">
function addPersonalDetails()
	{
		if(document.loan_form.City.value!="")
			{
				row = document.getElementById('PersonalDetails').style.display='block';	
			}
			
		if(document.loan_form.City.value=="")
			{
				row = document.getElementById('PersonalDetails').style.display='none';	
			}
	
	}
	
	function othercity1()
	{
		if(document.loan_form.City.value=="Others")
			{
				row = document.getElementById('otherCityDisp').style.display='block';	
			}
			
		if(document.loan_form.City.value!="Others")
			{
				row = document.getElementById('otherCityDisp').style.display='none';	
			}
	
	}
	
</script>
    <?php 
if((!strlen(strpos($_SERVER['REQUEST_URI'], "/home-loan-emi-calculator1.php")) > 0) && (!strlen(strpos($_SERVER['REQUEST_URI'], "/calculate-home-loan-emi.php")) > 0))
{
?>
<script src="js-range-slider/range-slider-jquery-min.js"></script>
<?php }?>
<script src="js-range-slider/rangeslider.min.js"></script>
<script>
	
	$('input[type="range"]').rangeslider();
	
	$('input[type="range"]').rangeslider('destroy');
</script>
<script>
$(function() {

	var $document = $(document),
		selector = '[data-rangeslider]',
		$element = $(selector);

	// Example functionality to demonstrate a value feedback
	function valueOutput(element) {
		var svalue = element.value,
		output = element.parentNode.getElementsByTagName('output')[0];
		document.getElementById('Loan_Amount').value=svalue;
	
	}
	for (var i = $element.length - 1; i >= 0; i--) {
		valueOutput($element[i]);
	};
	$document.on('change', 'input[type="range"]', function(e) {
		valueOutput(e.target);
	});

	
	$document.on('change', '#js-example-change-value input[type="number"]', function(e) {
			var $inputRange = $('input[type="range"]', e.target.parentNode),
			value = $('input[type="number"]', e.target.parentNode)[0].value;

		$inputRange.val(value).change();
	});

	// Basic rangeslider initialization
	$element.rangeslider({

		// Deactivate the feature detection
		polyfill: false,

		// Callback function
		onInit: function() {},

		// Callback function
		onSlide: function(position, value) {
			console.log('onSlide');
			console.log('position: ' + position, 'value: ' + value);
		},

		// Callback function
		onSlideEnd: function(position, value) {
			console.log('onSlideEnd');
			console.log('position: ' + position, 'value: ' + value);
		}
	});

});
</script>

<div class="form-ui-main-wrapper">
  <div class="form-ui-main-wrapper-inner">
    <form name="loan_form" method="post" action="apply-home-loans-step1.php" onSubmit="return chkform();">
      <input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
      <input type="hidden" name="Cfcount" id="Cfcount" value="<?php echo $Cfcount; ?>">
      <input type="hidden" name="Activate" id="Activate" >
      <input type="hidden" name="source" value="<?php echo $newsource; ?>">
      <div>
        <strong class="hl-h2" style="float:left;"><?php echo $subjectLine;?></strong>
        <?php if($subjectLine2!=""){?>
        <div style="padding-top:10px;  float:left;"><strong>&nbsp;<?php echo $subjectLine2;?></strong>&nbsp;</div>
        <?php }?>
        <?php if($subjectLine3!=""){?>
        <div style="padding-top:10px;"><?php echo $subjectLine3;?></div>
        <?php }?>
      </div>
      <div class="form-clear"></div>
      <div >Loan Amount</div>
      <div class="form-clear" style="height:25px;"></div>
      <!--- Range Slider start--->
      
      <div id="js-example-change-value">
        <input type="range" min="800000" max="15000000" step="100000" value="2000000"  onChange="intOnly(this); getDiToWordsIncome('Loan_Amount_Range','RangeFormatedIncome', 'RangeWordIncome'); " id="Loan_Amount_Range" data-rangeslider>
        <output></output>
        <input type="number" value="2000000" step="100000" name="Loan_Amount" id="Loan_Amount" onkeyup="intOnly(this); getDiToWordsIncome('Loan_Amount','RangeFormatedIncome', 'RangeWordIncome'); " class="form-output">
      </div>
      <div id="RangeFormatedIncome" style="display: none;"></div>
      <div id="RangeWordIncome" style="display: none;"></div>
      
      <!-- Range Slider End-->
      <div class="form-clear"></div>
      <div class="nagative-margin-new">
        <div class="form-input-wrapper">
          <div class="form-icon"><img src="test-newui/images-newui/occupation-frm-icon.png" width="45" height="45" alt="Occupation" /></div>
          <div class="form-clear"></div>
          <select name="Employment_Status" onchange="validateDiv('empStatusVal');" class="form-select" >
            <option value="-1">Select Occupation</option>
            <option value="1">Salaried</option>
            <option value="0">Self Employed</option>
          </select>
          <div id="empStatusVal"></div>
        </div>
        <div class="form-input-wrapper form-box-left-margin">
          <div class="form-icon"><img src="test-newui/images-newui/rupee-symbol-form.png" width="45" height="45" alt="Annual income" /></div>
          <div class="form-clear"></div>
          <input type="text" name="Net_Salary" id="Net_Salary" value="Annual Income" class="form-input" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome', 'wordIncome'); " onkeypress="intOnly(this);" onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome'); if (this.value == '') {this.value = 'Annual Income';}"   onfocus="if (this.value == 'Annual Income') {this.value = '';}" onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');" autocomplete="off">
          <div id="netSalaryVal"></div>
          <span id="formatedIncome" style="display: none;"></span> <span id="wordIncome" style="display: none;"></span> </div>
        <div class="form-input-wrapper form-box-left-margin">
          <div class="form-icon"><img src="test-newui/images-newui/loaction-icon.png" alt="location icon" /></div>
                    <select name="City" id="City" onchange="addPersonalDetails(); othercity1(); validateDiv('cityVal'); addhdfclife();" class="form-select">
            <option value="">Select City</option>
            <?=getCityList($City)?>
          </select>
          <div id="cityVal"></div>
          <div style="display:none;" id="otherCityDisp">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25"><span style="color:#183cb8"></span></td>
              </tr>
              <tr>
                <td height="25"><input name="City_Other" id="City_Other" type="text" class="form-input  ui-body-c ui-corner-all ui-shadow-inset" onkeydown="validateDiv('othercityVal');" placeholder="Other City" />
                  <div id="othercityVal"></div></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="form-clear"></div>
        <div style="display:none;" id="PersonalDetails">
          <div class="form-clear"></div>
          <div class="form-sub-head form-special-top-margin">Personal Details</div>
          <div class="termtext"><img src="images/security.png" width="14" height="16">Your Information is secure with us and will not be shared without your consent</div>
          <div class="form-clear margin-top-symbol"></div>
          <div class="form-input-wrapper">
            <div class="form-icon"><img src="test-newui/images-newui/name-icon.png" width="45" height="45" alt="Name" /></div>
            <div class="form-clear"></div>
            <input type="text" class="form-input" value="Full Name"  name="Name" id="Name" onblur="if (this.value == '') {this.value = 'Full Name';}" onfocus="if (this.value == 'Full Name') {this.value = '';}" onkeydown="validateDiv('nameVal');" autocomplete="off"  />
            <div id="nameVal"></div>
          </div>
          <div class="form-input-wrapper form-box-left-margin">
            <div class="form-icon"><img src="test-newui/images-newui/mail-id-icon.png" width="45" height="45" alt="Email-id" /></div>
            <div class="form-clear"></div>
            <input  type="text" class="form-input"  value="E-mail Id" name="Email" id="Email" onblur="if (this.value == '') {this.value = 'E-mail Id';}" onfocus="if (this.value == 'E-mail Id') {this.value = '';}"  onkeydown="validateDiv('emailVal');" autocomplete="off" />
            <div id="emailVal"></div>
          </div>
          <div class="form-input-wrapper form-box-left-margin">
            <div class="form-icon"><img src="test-newui/images-newui/mobile-icon.png" width="45" height="45" alt="Contact Number" /></div>
            <div class="form-clear"></div>
            <input type="text" class="form-input"  value="Mobile No." name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onkeydown="validateDiv('phoneVal');" onblur="if (this.value == '') {this.value = 'Mobile No.';}" onfocus="if (this.value == 'Mobile No.') {this.value = '';}" />
            <div id="phoneVal"></div>
          </div>
          <div class="form-clear"></div>
          
          <div class="bottom-margin-new">
            <input type="checkbox" name="accept" id="checkboxG2" value="1" class="css-checkbox" checked="checked" onclick="validateDiv('TermConditionVal');" />
            <label for="checkboxG2" class="css-label-check">I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#3671d5; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  style=" color:#3671d5; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#3671d5; text-decoration:underline;">Terms and Conditions</a>.</label>
           <div id="TermConditionVal"></div>
          </div> 
		  <div id="other_processes"></div>
        </div>        
        <div style="clear:both !important; padding-top:5px; padding-bottom:15px;"></div>
        <div class="form-white-text bntnew-topmargin"><strong class="quote-form_a">54 ,</strong><strong class="quote-form_b">02 ,</strong><strong class="quote-form_c"> 013</strong> Loan quotes taken till now
          <div class="button-right-align">
            <input type="submit" value="Get Quote" class="form-ui-quote-button"  onClick="ga('send', 'event', 'Get Home Loan Quote', 'Get Quote Home');" />
          </div>
        </div>
        <div style="clear:both !important;"></div>
        <div id="commonfloorlogo"></div>
           <div style="clear:both !important;"></div>
        <div class="form-white-text form-special-top">&bull; 54 lakh customers serviced to get  best Loan deals with deal4loans. Deal4loans views Published @ yourstory .com<br />
          &bull; As RBI cuts rate, should you go for fixed home loan Deal4loans views Published @ Economic Times online </div>
        <div class="form-clear"></div>
        <div></div>
      </div>
    </form>
  </div>
</div>
<!--<script src="js/jquery-2.1.4.min.js" type="text/javascript"></script> -->
<script type="text/javascript">
	$(document).ready(function () {
				$('#City').on('change',function(){
				var Residencecity = $('#City').val();
				//alert(Residencecity);
				var Income = $('#Net_Salary').val();
				//alert(Income);
				$.ajax({
						type: 'POST',
						url: 'otherprocesses/widget_sbicards_process.php',
						data: {
							city: Residencecity,
							income: Income
						},
						success: function (response) {						
						$('#other_processes').html(response);
						}
					});	
				});
				});
</script>