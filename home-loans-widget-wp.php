<?php 
include "scripts/functions.php";
#if (substr_count($_SERVER[‘HTTP_ACCEPT_ENCODING’], ‘gzip’)) ob_start(“ob_gzhandler”); else ob_start(); ?>
<?
	$Cfcount=0;
?><link href="http://www.deal4loans.com/css/styles-home-loan.css" type="text/css" rel="stylesheet"  /><link rel="stylesheet" href="http://www.deal4loans.com/css-range-slider/rangeslider.css"><link href="http://www.deal4loans.com/css/home-loan-styles.css" type="text/css" rel="stylesheet"  /><style>.form-ui-quote-button {    margin: auto !important;
    background: #fccb2a !important;
    border-radius: 5px;
    width: 110px;
    font-size: 18px!important;
    padding: 5px;
    color: #000 !important;
    border: none;
    height: 40px;
}</style>
<script src="http://www.deal4loans.com/js-range-slider/range-slider-jquery-min.js"></script> <script src="http://www.deal4loans.com/js-range-slider/rangeslider.min.js"></script><script src='http://www.deal4loans.com/home-loan-validate.js' type='text/javascript' language='javascript'></script><script src='http://www.deal4loans.com/scripts/digitToWordConvert.js' type='text/javascript' language='javascript'></script><script type="text/javascript" src="http://www.deal4loans.com/scripts/common.js"></script><div class="form-ui-main-wrapper"><div class="form-ui-main-wrapper-inner">  <form name="loan_form" method="post" action="/apply-home-loans-step1.php" onSubmit="return chkform();"> <input type="hidden" name="Cfcount" id="Cfcount" value="<?php echo $Cfcount; ?>"><input type="hidden" name="PostURL" value="<?php echo $_SERVER['REQUEST_URI']; ?>"><input type="hidden" name="Activate" id="Activate" ><?  if($d4l_section=="Wordpress CMS"){ ?> <input type="hidden" name="source" value="SEO_D4L_<? the_title(); ?>"><? } else { ?>  <input type="hidden" name="source" value="<? echo $newsource; ?>"><? } ?> <div>        <strong style="float:left;"><?php echo $subjectLine;?></strong> <?php if($subjectLine2!=""){?><div style="padding-top:10px;  float:left;"><strong>&nbsp;<?php echo $subjectLine2;?></strong>&nbsp;</div> <?php }?> <?php if($subjectLine3!=""){?><div style="padding-top:10px;"><?php echo $subjectLine3;?></div><?php }?></div>
    <div class="form-clear"></div>
    <div style="text-align:left;">Loan Amount</div>
      <div class="form-clear" style="height:25px;"></div>
      <!--- Range Slider start--->
      
      <div id="js-example-change-value"><input type="range" min="800000" max="15000000" step="100000" value="2000000"  onChange="intOnly(this); getDiToWordsIncome('Loan_Amount_Range','RangeFormatedIncome', 'RangeWordIncome'); " id="Loan_Amount_Range" data-rangeslider><output></output><input type="number" value="2000000" step="100000" name="Loan_Amount" id="Loan_Amount" onkeyup="intOnly(this); getDiToWordsIncome('Loan_Amount','RangeFormatedIncome', 'RangeWordIncome'); " class="form-output">
      </div>
      <div id="RangeFormatedIncome" style="display: none;"></div>
      <div id="RangeWordIncome" style="display: none;"></div>
      
      <!-- Range Slider End-->
      <div class="form-clear"></div>
      <div class="nagative-margin-new">
        <div class="form-input-wrapper">
          <div class="form-icon"><img src="http://www.deal4loans.com/test-newui/images-newui/occupation-frm-icon.png" width="45" height="45" alt="Occupation" /></div>
          <div class="form-clear"></div>
          <select name="Employment_Status" onchange="validateDiv('empStatusVal');" class="form-select" >
            <option value="-1">Select Occupation</option>
            <option value="1">Salaried</option>
            <option value="0">Self Employed</option>
          </select>
          <div id="empStatusVal"></div>
        </div>
        <div class="form-input-wrapper form-box-left-margin">
          <div class="form-icon"><img src="http://www.deal4loans.com/test-newui/images-newui/rupee-symbol-form.png" width="45" height="45" alt="Annual income" /></div>
          <div class="form-clear"></div>
          <input type="text" name="Net_Salary" id="Net_Salary" value="Annual Income" class="form-input" onkeyup="intOnly(this); getDiToWordsIncome('Net_Salary','formatedIncome', 'wordIncome'); " onkeypress="intOnly(this);" onblur="getDiToWordsIncome('Net_Salary','formatedIncome','wordIncome'); if (this.value == '') {this.value = 'Annual Income';}"   onfocus="if (this.value == 'Annual Income') {this.value = '';}" onchange="ShowHide('incomeShow','Net_Salary');" onkeydown="validateDiv('netSalaryVal');" autocomplete="off">
          <div id="netSalaryVal"></div>
          <span id="formatedIncome" style="display: none;"></span> <span id="wordIncome" style="display: none;"></span> </div>
        <div class="form-input-wrapper form-box-left-margin">
          <div class="form-icon"><img src="http://www.deal4loans.com/test-newui/images-newui/loaction-icon.png" alt="location icon" /></div>
                   <select name="City" id="City" onchange="addPersonalDetails(); othercity1(); validateDiv('cityVal'); addhdfclife();" class="form-select">
            <option value="">Select City</option>
			<?php echo getCityList($City)?>
          </select>
          <div id="cityVal"></div>
          <div style="display:none;" id="otherCityDisp">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25"><span style="color:#183cb8"></span></td>
              </tr>
              <tr>
                <td height="25"><input name="City_Other" id="City_Other" type="text" class="form-input  ui-body-c ui-corner-all ui-shadow-inset" placeholder="Other City" />
                  <div id="othercityVal"></div></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="form-clear"></div>
        <div style="display:none;" id="PersonalDetails">
          <div class="form-clear"></div>
          <div class="form-sub-head form-special-top-margin">Personal Details</div>
          <div class="termtext"><img src="http://www.deal4loans.com/images/security.png" width="14" height="16">Your Information is secure with us and will not be shared without your consent</div>
          <div class="form-clear margin-top-symbol"></div>
          <div class="form-input-wrapper">
            <div class="form-icon"><img src="http://www.deal4loans.com/test-newui/images-newui/name-icon.png" width="45" height="45" alt="Name" /></div>
            <div class="form-clear"></div>
            <input type="text" class="form-input" value="Full Name"  name="Name" id="Name" onblur="if (this.value == '') {this.value = 'Full Name';}" onfocus="if (this.value == 'Full Name') {this.value = '';}" onkeydown="validateDiv('nameVal');" autocomplete="off"  />
            <div id="nameVal"></div>
          </div>
          <div class="form-input-wrapper form-box-left-margin">
            <div class="form-icon"><img src="http://www.deal4loans.com/test-newui/images-newui/mail-id-icon.png" width="45" height="45" alt="Email-id" /></div>
            <div class="form-clear"></div>
            <input  type="text" class="form-input"  value="E-mail Id" name="Email" id="Email" onblur="if (this.value == '') {this.value = 'E-mail Id';}" onfocus="if (this.value == 'E-mail Id') {this.value = '';}"  onkeydown="validateDiv('emailVal');" autocomplete="off" />
            <div id="emailVal"></div>
          </div>
          
         
          <div class="form-input-wrapper form-box-left-margin">
            <div class="form-icon"><img src="http://www.deal4loans.com/test-newui/images-newui/mobile-icon.png" width="45" height="45" alt="Contact Number" /></div>
            <div class="form-clear"></div>
            <input type="text" class="form-input"  value="Mobile No." name="Phone" id="Phone" maxlength="10" onkeyup="intOnly(this);" onkeypress="intOnly(this)"; onchange="intOnly(this);" onkeydown="validateDiv('phoneVal');" onblur="if (this.value == '') {this.value = 'Mobile No.';}" onfocus="if (this.value == 'Mobile No.') {this.value = '';}" />
            <div id="phoneVal"></div>
          </div>
         
          <div class="form-clear"></div>
          <div class="bottom-margin-new"><input type="checkbox" name="accept" id="checkboxG2" value="1" class="css-checkbox" checked="checked" onclick="validateDiv('TermConditionVal');" /><label for="checkboxG2" class="css-label-check">I authorize Deal4loans.com & its <a href="http://www.deal4loans.com/hl-partnering-banks.php" target="_blank" rel="nofollow"  class="text" style=" color:#3671d5; text-decoration:underline;">partnering banks</a> to contact me to explain the product & I Agree to <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  style=" color:#3671d5; text-decoration:underline;">Privacy policy</a> and <a href="http://www.deal4loans.com/Privacy.php" target="_blank" rel="nofollow"  class="text" style=" color:#3671d5; text-decoration:underline;">Terms and Conditions</a>.</label>
           <div id="TermConditionVal"></div>
          </div>
      </div>
        
        <div style="clear:both !important; padding-top:5px;"></div>
        <div class="form-white-text bntnew-topmargin"><strong class="quote-form_a">54 ,</strong><strong class="quote-form_b">02 ,</strong><strong class="quote-form_c"> 013</strong> Loan quotes taken till now <div class="button-right-align"> <input type="submit" value="Get Quote" class="form-ui-quote-button" onClick="ga('send', 'event', 'Get Home Loan Quote', 'Get Quote Home');" />  </div>
        </div>
        <div style="clear:both !important;"></div>
        <div id="commonfloorlogo"></div>
           <div style="clear:both !important;"></div>
        <div class="form-white-text form-special-top">&bull; 54 lakh customers serviced to get  best Loan deals with deal4loans. Deal4loans views Published @ yourstory .com<br />
          &bull; As RBI cuts rate, should you go for fixed home loan Deal4loans views Published @ Economic Times online </div>
        <div class="form-clear"></div>
       </div>
     
    </form>
  </div>
</div>
